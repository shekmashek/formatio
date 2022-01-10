

create or replace view v_group_num_facture as select num_facture,invoice_date,due_date from factures group by num_facture,invoice_date,due_date;

-- view facture pour encaissement
create or replace view v_montant_pedagogique_facture as
    select projet_id,num_facture,sum(qte) as qte_totale,sum(hors_taxe) as hors_taxe, due_date,invoice_date from factures group by num_facture,projet_id, due_date,invoice_date;

create or replace view v_montant_frais_annexe as
    select num_facture,sum(qte) as qte_totale,sum(hors_taxe) as hors_taxe from montant_frais_annexes group by num_facture;


create or replace view v_montant_brut_facture as
    select
        mpf.projet_id,mpf.num_facture,(mpf.hors_taxe+IFNULL(mfa.hors_taxe,0)) as montant_brut_ht,mpf.due_date,mpf.invoice_date
    from
        v_montant_frais_annexe mfa
    right join  v_montant_pedagogique_facture mpf
    on mpf.num_facture=mfa.num_facture;

create or replace view v_remise_facture as
    select projet_id,num_facture,sum(remise)/count(num_facture) as remise from factures group by num_facture,projet_id;

create or replace view v_taxe_facture as
    select projet_id,num_facture,pourcent from factures f join taxes t on f.tax_id=t.id group by num_facture,projet_id,pourcent;



create or replace view v_montant_facture as
   SELECT
    mbr.projet_id,
    mbr.num_facture,
    mbr.montant_brut_ht,
    rf.remise,
    (mbr.montant_brut_ht - rf.remise) AS net_commercial,
    (mbr.montant_brut_ht - rf.remise) AS net_ht,
    (
        (
            (mbr.montant_brut_ht - rf.remise) * tf.pourcent
        ) / 100
    ) AS tva,
    (
        (
            (
                (mbr.montant_brut_ht - rf.remise) * tf.pourcent
            ) / 100
        ) +(mbr.montant_brut_ht - rf.remise)
    ) AS net_ttc,
    fact.type_facture_id,
    (typ_fact.description) description_type_facture,
    (typ_fact.reference) reference_type_facture,
    mbr.due_date,
    mbr.invoice_date
FROM
    v_montant_brut_facture mbr,
    v_remise_facture rf,
    v_taxe_facture tf,
    factures fact,
    type_facture typ_fact
WHERE
    mbr.num_facture = rf.num_facture AND tf.num_facture = mbr.num_facture AND fact.type_facture_id = typ_fact.id AND mbr.num_facture = fact.num_facture
GROUP BY
    mbr.projet_id,
    mbr.num_facture,
    mbr.montant_brut_ht,
    rf.remise,
    fact.type_facture_id,
    typ_fact.description,
    typ_fact.reference,
    mbr.due_date,
    mbr.invoice_date,
    tf.pourcent;

create or replace view v_acompte_facture as select v_montant_facture.* from v_montant_facture where UPPER(reference_type_facture)=UPPER('acompte');


create or replace view v_sum_acompte_facture as select projet_id,(sum(net_ttc)) sum_acompte from v_acompte_facture group by projet_id;

create or replace view v_facture as
select
        v_montant_facture.*,
        v_sum_acompte_facture.sum_acompte,
        (
            case
            when
                v_montant_facture.projet_id = v_sum_acompte_facture.projet_id
                and
                UPPER(v_montant_facture.reference_type_facture) = UPPER('facture')
                then (v_montant_facture.net_ttc - v_sum_acompte_facture.sum_acompte)
                else 0 end
        ) as rest_payer

from
    v_montant_facture left join v_sum_acompte_facture
on
    v_montant_facture.projet_id = v_sum_acompte_facture.projet_id;
-- ------------------ suivant------------------------


CREATE OR REPLACE VIEW v_sum_encaissement AS
SELECT num_facture,  (SUM(IFNULL(payement,0))) payement FROM  encaissements group by num_facture;

CREATE OR REPLACE VIEW v_avant_dernier_encaissement AS
select
v_facture.num_facture,v_facture.net_ttc,v_facture.rest_payer,(IFNULL(payement,0)) payement
from v_facture left join v_sum_encaissement on v_facture.num_facture = v_sum_encaissement.num_facture;



CREATE OR REPLACE VIEW v_dernier_encaissement AS
SELECT
    v_facture.num_facture,v_facture.net_ttc,v_facture.rest_payer,
     ( CASE WHEN v_facture.num_facture = v_avant_dernier_encaissement.num_facture and
                    v_facture.rest_payer>0
                   THEN v_facture.rest_payer  ELSE v_facture.net_ttc
            END) montant_facture,
payement,
v_facture.due_date,
v_facture.invoice_date
FROM
    v_facture
 JOIN v_avant_dernier_encaissement ON v_avant_dernier_encaissement.num_facture = v_facture.num_facture;


-- CREATE OR REPLACE VIEW v_dernier_encaissement AS
-- SELECT
--     v_facture.num_facture,v_facture.net_ttc,v_facture.rest_payer,
--      ( CASE WHEN v_facture.num_facture = v_avant_dernier_encaissement.num_facture and
--                     v_facture.rest_payer>0 and payement>0
--                    THEN v_facture.rest_payer  ELSE v_facture.net_ttc
--             END) montant_facture,
-- payement,
-- v_facture.due_date,
-- v_facture.invoice_date
-- FROM
--     v_facture
--  JOIN v_avant_dernier_encaissement ON v_avant_dernier_encaissement.num_facture = v_facture.num_facture;


CREATE OR REPLACE VIEW v_temp_facture AS
SELECT v_dernier_encaissement.*, (montant_facture-payement) montant_ouvert from v_dernier_encaissement;


CREATE OR REPLACE VIEW v_liste_facture AS SELECT
    (factures.id) facture_id,
    (factures.projet_id) as projet_id,
    nom_projet,
    entreprise_id,
    type_payement_id,
    (type_payement.type) description_type_payement,
    bon_de_commande,
    facture,
    factures.hors_taxe,
    invoice_date,
    due_date,
    tax_id,
    (taxes.description) nom_taxe,
    taxes.pourcent,
    (factures.description) description_facture,
    other_message,
    qte,
    num_facture,
    activiter,
    groupe_id,
    groupes.nom_groupe,
    pu,
    type_financement_id,
    (mode_financements.description) description_financement,
    nom_etp,
    adresse,
    logo,
    reference_bc,
    remise,
    type_facture_id,
    (type_facture.description) description_type_facture,
    (type_facture.reference) reference_facture,
    NIF,
    STAT,
    RCS,
    CIF,
    Secteur_activite
FROM
    factures,
    type_payement,
    taxes,
    projets,
    groupes,
    entreprises,
    mode_financements,
    type_facture
WHERE
    factures.type_payement_id = type_payement.id AND
    type_financement_id = mode_financements.id AND
    factures.tax_id = taxes.id AND factures.projet_id = projets.id AND
    groupe_id = groupes.id AND entreprise_id = entreprises.id AND type_facture_id = type_facture.id;


CREATE OR REPLACE VIEW v_facture_existant_tmp AS SELECT
    v_facture.*,
    (v_temp_facture.montant_facture) montant_total,
    (v_temp_facture.payement) payement_totale,
    (v_temp_facture.montant_ouvert) dernier_montant_ouvert,
    (v_temp_facture.due_date) date_facture
FROM
    v_facture,
    v_temp_facture
WHERE
    v_facture.num_facture = v_temp_facture.num_facture;

CREATE OR REPLACE VIEW v_facture_existant AS SELECT
    v_facture_existant_tmp.*,
    (
        CASE WHEN(payement_totale - montant_total) < 0 AND payement_totale <= 0 THEN 'valider' WHEN(payement_totale - montant_total) < 0 AND payement_totale > 0 THEN 'en_cour' WHEN(payement_totale - montant_total) >= 0 THEN 'terminer'
    END
) facture_encour
FROM
    v_facture_existant_tmp;


CREATE OR REPLACE VIEW v_facture_actif AS SELECT
    factures.num_facture,
    other_message,
    (
        DATEDIFF(
            v_facture_existant.due_date,
            v_facture_existant.invoice_date
        )
    ) totale_jour,
    (
        IFNULL(
            (
                DATEDIFF(v_facture_existant.due_date, NOW())),
                0
            )
        ) jour_restant,
        v_facture_existant.facture_encour,
        v_facture_existant.due_date,v_facture_existant.invoice_date,
        v_facture_existant.projet_id,v_facture_existant.montant_brut_ht,v_facture_existant.remise,v_facture_existant.net_commercial,v_facture_existant.net_ht,
        v_facture_existant.tva,v_facture_existant.net_ttc,v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,v_facture_existant.rest_payer,v_facture_existant.montant_total,
        v_facture_existant.payement_totale,v_facture_existant.dernier_montant_ouvert,v_facture_existant.date_facture
    FROM
        v_facture_existant,
        factures
    WHERE
        v_facture_existant.num_facture = factures.num_facture AND factures.activiter = TRUE
    GROUP BY
        factures.num_facture,
        factures.other_message,
        facture_encour,
        v_facture_existant.due_date,v_facture_existant.invoice_date,
        v_facture_existant.projet_id,v_facture_existant.montant_brut_ht,v_facture_existant.remise,v_facture_existant.net_commercial,v_facture_existant.net_ht,
        v_facture_existant.tva,v_facture_existant.net_ttc,v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,v_facture_existant.rest_payer,v_facture_existant.montant_total,
        v_facture_existant.payement_totale,v_facture_existant.dernier_montant_ouvert,v_facture_existant.date_facture;


CREATE OR REPLACE VIEW v_facture_inactif AS SELECT
    factures.num_facture,
    other_message,
    (
        DATEDIFF(
            v_facture_existant.due_date,
            v_facture_existant.invoice_date
        )
    ) totale_jour,
    (
        IFNULL(
            (
                DATEDIFF(v_facture_existant.due_date, NOW())),
                0
            )
        ) jour_restant,
        facture_encour,
        v_facture_existant.due_date,v_facture_existant.invoice_date,
        v_facture_existant.projet_id,v_facture_existant.montant_brut_ht,v_facture_existant.remise,v_facture_existant.net_commercial,v_facture_existant.net_ht,
        v_facture_existant.tva,v_facture_existant.net_ttc,v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,v_facture_existant.rest_payer,v_facture_existant.montant_total,
        v_facture_existant.payement_totale,v_facture_existant.dernier_montant_ouvert,v_facture_existant.date_facture
    FROM
        v_facture_existant,
        factures
    WHERE
        v_facture_existant.num_facture = factures.num_facture AND factures.activiter = FALSE
    GROUP BY
        factures.num_facture,
        factures.other_message,
        facture_encour,
        v_facture_existant.due_date,v_facture_existant.invoice_date,
        v_facture_existant.projet_id,v_facture_existant.montant_brut_ht,v_facture_existant.remise,v_facture_existant.net_commercial,v_facture_existant.net_ht,
        v_facture_existant.tva,v_facture_existant.net_ttc,v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,v_facture_existant.rest_payer,v_facture_existant.montant_total,
        v_facture_existant.payement_totale,v_facture_existant.dernier_montant_ouvert,v_facture_existant.date_facture;

create or replace view v_compte_facture_actif as select (COUNT(num_facture)) totale from v_facture_actif;
create or replace view v_compte_facture_inactif as select (COUNT(num_facture)) totale from v_facture_inactif;
create or replace view v_compte_facture_en_cour as select (COUNT(num_facture)) totale from v_facture_existant where facture_encour='en_cour';
create or replace view v_compte_facture_payer as select (COUNT(num_facture)) totale from v_facture_existant where facture_encour='terminer';

-- ALTER TABLE encaissements
-- ADD column mode_financement_id bigint(20) unsigned not null,
-- ADD FOREIGN KEY (mode_financement_id) REFERENCES mode_financements(id) ON DELETE CASCADE;

create or replace view v_encaissement as
    select encaissements.*,mf.description from encaissements join mode_financements mf on encaissements.mode_financement_id = mf.id;

create or replace view v_coursprogramme as
SELECT `c`.`id` AS `cours_id`, `c`.`titre_cours` AS `titre_cours`, `c`.`programme_id` AS `programme_id`, `p`.`titre` AS `titre`, `p`.`module_id` AS `module_id` FROM (`programmes` `p` left join `cours` `c` on(`c`.`programme_id` = `p`.`id`)) ;
