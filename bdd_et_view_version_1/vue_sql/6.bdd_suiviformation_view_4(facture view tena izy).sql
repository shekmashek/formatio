CREATE OR REPLACE VIEW v_montant_pedagogique_facture AS SELECT
    cfp_id,
    projet_id,
    factures.entreprise_id,
    type_facture_id,
    num_facture,
    SUM(qte) AS qte_totale,
    SUM(hors_taxe) AS hors_taxe,
    due_date,
    (type_financement_id) mode_financement_id,
    (mode_financements.description) description_financement,
    other_message,
    activiter,
    invoice_date
FROM
    factures,mode_financements WHERE type_financement_id = mode_financements.id
GROUP BY
    cfp_id,
    num_facture,
    projet_id,
    type_financement_id,
    mode_financements.description,
    type_facture_id,
    factures.entreprise_id,
    due_date,
    activiter,
    other_message,
    invoice_date;


CREATE OR REPLACE VIEW v_montant_frais_annexe AS SELECT
    cfp_id,
    projet_id,
    entreprise_id,
    num_facture,
    SUM(qte) AS qte_totale,
    SUM(hors_taxe) AS hors_taxe
FROM
    montant_frais_annexes
GROUP BY
    cfp_id,
    projet_id,
    entreprise_id,
    num_facture;



CREATE OR REPLACE VIEW v_montant_brut_facture AS SELECT
    mpf.cfp_id,
    mpf.projet_id,
    mpf.entreprise_id,
    mpf.type_facture_id,
    mpf.num_facture,
    mpf.activiter,
    mpf.mode_financement_id,
    mpf.description_financement,
    mpf.other_message,
     (
        mpf.hors_taxe + IFNULL(mfa.hors_taxe, 0)
    ) AS montant_brut_ht,
    mpf.due_date,
    mpf.invoice_date
FROM
    v_montant_frais_annexe mfa
RIGHT JOIN v_montant_pedagogique_facture mpf ON
    mpf.num_facture = mfa.num_facture  AND mpf.cfp_id = mfa.cfp_id AND mpf.entreprise_id = mfa.entreprise_id AND  mpf.projet_id = mfa.projet_id

    GROUP BY
    mpf.cfp_id,
    mpf.projet_id,
    mpf.entreprise_id,
    mpf.type_facture_id,
    mpf.mode_financement_id,
    mpf.description_financement,
    mpf.num_facture,
    mpf.activiter,
    mpf.other_message,
    mpf.hors_taxe,mfa.hors_taxe,mpf.due_date,
    mpf.invoice_date
    ;



CREATE OR REPLACE VIEW v_taxe_facture AS SELECT
	cfp_id,
    projet_id,
    entreprise_id,
    num_facture,
    other_message,
    activiter,
    pourcent
FROM
    factures f
JOIN taxes t ON
    f.tax_id = t.id
GROUP BY
	cfp_id,
    num_facture,
    projet_id,
    other_message,
    activiter,
    entreprise_id,
    pourcent;


CREATE OR REPLACE VIEW v_remise_facture_tmp AS SELECT
	cfp_id,
    projet_id,
    entreprise_id,
    type_facture_id,
    num_facture,
    (remise) valeur_remise,
    remise_id,
    (type_remise.description) description_remise,
    (type_remise.reference) reference_remise
FROM
factures,type_remise WHERE factures.remise_id = type_remise.id
GROUP BY
    cfp_id,
    projet_id,
    entreprise_id,
    type_facture_id,
    num_facture,
    remise,
    remise_id,
    type_remise.description,
    type_remise.reference;


CREATE OR REPLACE VIEW v_remise_facture AS SELECT
	v_montant_brut_facture.cfp_id,
    v_montant_brut_facture.projet_id,
    v_montant_brut_facture.mode_financement_id,
    v_montant_brut_facture.description_financement,
    v_montant_brut_facture.entreprise_id,
    v_montant_brut_facture.type_facture_id,
    v_montant_brut_facture.num_facture,
    remise_id,
    valeur_remise,
    description_remise,
    reference_remise,
    (CASE
        WHEN  description_remise="%" THEN ((montant_brut_ht*valeur_remise/100))
        ELSE valeur_remise
    END ) remise
FROM
v_montant_brut_facture,v_remise_facture_tmp
WHERE
v_montant_brut_facture.cfp_id = v_remise_facture_tmp.cfp_id AND
v_montant_brut_facture.num_facture = v_remise_facture_tmp.num_facture AND
v_montant_brut_facture.entreprise_id = v_remise_facture_tmp.entreprise_id AND
v_montant_brut_facture.projet_id = v_remise_facture_tmp.projet_id;


CREATE OR REPLACE VIEW v_montant_facture AS
SELECT
    mbr.cfp_id,
    mbr.projet_id,
    mbr.entreprise_id,
    mbr.num_facture,
    mbr.montant_brut_ht,
    mbr.activiter,
    rf.mode_financement_id,
    rf.description_financement,
    rf.remise,
    rf.remise_id,
    rf.valeur_remise,
    rf.description_remise,
    rf.reference_remise,
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
    mbr.type_facture_id,
    (typ_fact.description) description_type_facture,
    (typ_fact.reference) reference_type_facture,
    mbr.due_date,
    mbr.invoice_date,
    mbr.other_message
FROM
    v_montant_brut_facture mbr,
    v_remise_facture rf,
    v_taxe_facture tf,
    type_facture typ_fact
WHERE
    mbr.num_facture = rf.num_facture AND tf.num_facture = mbr.num_facture AND mbr.type_facture_id = typ_fact.id
    AND mbr.cfp_id = rf.cfp_id AND tf.cfp_id = mbr.cfp_id  AND tf.cfp_id = rf.cfp_id
    AND mbr.entreprise_id = rf.entreprise_id AND mbr.entreprise_id = tf.entreprise_id
GROUP BY
    mbr.cfp_id,
    mbr.projet_id,
    mbr.activiter,
    mbr.entreprise_id,
    mbr.num_facture,
    mbr.montant_brut_ht,
    rf.mode_financement_id,
    rf.description_financement,
    rf.remise,
    rf.remise_id,
    rf.valeur_remise,
    rf.description_remise,
    rf.reference_remise,
    mbr.type_facture_id,
    typ_fact.description,
    typ_fact.reference,
    mbr.due_date,
    mbr.invoice_date,
    tf.pourcent,
    mbr.other_message;


CREATE OR REPLACE VIEW v_acompte_facture AS SELECT
    v_montant_facture.*
FROM
    v_montant_facture
WHERE
    UPPER(reference_type_facture) = UPPER('acompte');


CREATE OR REPLACE VIEW v_sum_acompte_facture AS SELECT
    cfp_id,
    projet_id,
    entreprise_id,
    other_message,
    (SUM(net_ttc)) sum_acompte
FROM
    v_acompte_facture
GROUP BY
    cfp_id,
    entreprise_id,other_message,
    projet_id;


CREATE OR REPLACE VIEW v_facture AS SELECT
    v_montant_facture.*,
    v_sum_acompte_facture.sum_acompte,
    (
        CASE
        WHEN v_montant_facture.projet_id = v_sum_acompte_facture.projet_id AND UPPER(
            v_montant_facture.reference_type_facture
        ) = UPPER('facture') THEN(
            v_montant_facture.net_ttc - v_sum_acompte_facture.sum_acompte
        ) ELSE 0
    END
) AS rest_payer
FROM
    v_montant_facture LEFT JOIN
    v_sum_acompte_facture
ON
    v_montant_facture.cfp_id = v_sum_acompte_facture.cfp_id AND v_montant_facture.projet_id = v_sum_acompte_facture.projet_id;



CREATE OR REPLACE VIEW v_sum_encaissement AS SELECT
    cfp_id,
    num_facture,
    (SUM(IFNULL(payement, 0))) payement
FROM
    encaissements
GROUP BY
    cfp_id,
    num_facture;



CREATE OR REPLACE VIEW v_avant_dernier_encaissement AS SELECT
    v_facture.cfp_id,
    v_facture.entreprise_id,
    v_facture.num_facture,
    v_facture.net_ttc,
    v_facture.rest_payer,
    v_facture.other_message,
    (IFNULL(payement, 0)) payement
FROM
    v_facture
LEFT JOIN v_sum_encaissement ON v_facture.cfp_id = v_sum_encaissement.cfp_id AND v_facture.num_facture = v_sum_encaissement.num_facture;


CREATE OR REPLACE VIEW v_dernier_encaissement AS SELECT
    v_facture.cfp_id,
    v_facture.entreprise_id,
    v_facture.num_facture,
    v_facture.net_ttc,
    v_facture.rest_payer,
    v_facture.other_message,
    (
        CASE WHEN v_facture.num_facture = v_avant_dernier_encaissement.num_facture AND v_facture.rest_payer > 0 THEN v_facture.rest_payer ELSE v_facture.net_ttc
    END
) montant_facture,
payement,
v_facture.due_date,
v_facture.invoice_date
FROM
    v_facture
JOIN v_avant_dernier_encaissement ON v_avant_dernier_encaissement.cfp_id = v_facture.cfp_id AND
v_avant_dernier_encaissement.num_facture = v_facture.num_facture AND v_facture.entreprise_id = v_avant_dernier_encaissement.entreprise_id;


CREATE OR REPLACE VIEW v_temp_facture AS SELECT
    v_dernier_encaissement.*,
    (montant_facture - payement) montant_ouvert
FROM
    v_dernier_encaissement;



CREATE OR REPLACE VIEW v_totale_participant_session AS SELECT
(groupes.id) groupe_id,(COUNT(stagiaire_id)) nbre_participant
FROM groupes LEFT JOIN  participant_groupe ON groupes.id = groupe_id GROUP BY groupes.id;




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
    v_facture.cfp_id = v_temp_facture.cfp_id AND  v_facture.num_facture = v_temp_facture.num_facture
    AND v_facture.entreprise_id = v_temp_facture.entreprise_id ;


CREATE OR REPLACE VIEW v_facture_existant AS SELECT
    v_facture_existant_tmp.*,
    ROUND((
        CASE WHEN description_remise = '%' THEN valeur_remise ELSE(valeur_remise * 100) / montant_brut_ht
    END
),2) valeur_remise_pourcent,
(
    CASE WHEN(
        payement_totale - montant_total
    ) < 0 AND payement_totale <= 0 THEN 'valider' WHEN(
        payement_totale - montant_total
    ) < 0 AND payement_totale > 0 THEN 'en_cour' WHEN(
        payement_totale - montant_total
    ) >= 0 THEN 'terminer'
END
) facture_encour
FROM
    v_facture_existant_tmp;


CREATE OR REPLACE VIEW v_liste_facture_tmp AS SELECT
   factures.cfp_id,
    (factures.projet_id) as projet_id,
    factures.entreprise_id,
    factures.type_facture_id,
    (type_facture.description) description_type_facture,
    (type_facture.reference) reference_facture,
    factures.hors_taxe,
    factures.groupe_entreprise_id,
    v_groupe_projet_module.nom_projet,
    v_groupe_projet_module.groupe_id,
    v_groupe_projet_module.nom_groupe,
    (v_groupe_projet_module.date_debut) date_debut_session,
    v_groupe_projet_module.reference,
    v_groupe_projet_module.nom_module,
    v_totale_participant_session.nbre_participant,
    invoice_date,
    due_date,
    tax_id,
    (taxes.description) nom_taxe,
    taxes.pourcent,
    factures.devise,
    (factures.description) description_facture,
    other_message,
    qte,
    num_facture,
    factures.activiter,
    pu,
    reference_bc,
    type_financement_id,
    (mode_financements.description) description_financement
FROM
    factures,
    v_groupe_projet_module,type_facture,v_totale_participant_session,
    taxes,mode_financements
WHERE
    factures.tax_id = taxes.id AND
    factures.groupe_entreprise_id = v_groupe_projet_module.groupe_entreprise_id AND
    v_groupe_projet_module.groupe_id = v_totale_participant_session.groupe_id AND
    type_facture_id = type_facture.id AND factures.type_financement_id = mode_financements.id;






CREATE OR REPLACE VIEW v_facture_existant_tmp AS SELECT
  v_facture.cfp_id,
   v_facture.sum_acompte,
    v_facture.activiter,
     v_facture.entreprise_id,
    v_facture.num_facture,
    v_facture.other_message,
    v_facture.mode_financement_id,
    v_facture.description_financement,
        v_facture.description_type_facture,
        v_facture.due_date,v_facture.invoice_date,
        v_facture.projet_id,
        (ROUND(v_facture.montant_brut_ht)) montant_brut_ht,
        (ROUND(v_facture.remise)) remise,
        (ROUND(v_facture.valeur_remise)) valeur_remise,
        v_facture.description_remise,
        v_facture.remise_id,
        v_facture.reference_remise,
        (ROUND(v_facture.net_commercial)) net_commercial,
        (ROUND(v_facture.net_ht)) net_ht,
        (ROUND(v_facture.tva)) tva,
        (ROUND(v_facture.net_ttc)) net_ttc,
        v_facture.type_facture_id,v_facture.reference_type_facture,
        (ROUND(v_facture.rest_payer)) rest_payer,
    (v_temp_facture.montant_facture) montant_total,
    (v_temp_facture.payement) payement_totale,
    (v_temp_facture.montant_ouvert) dernier_montant_ouvert,
    (v_temp_facture.due_date) date_facture
FROM
    v_facture,
    v_temp_facture
WHERE
    v_facture.cfp_id = v_temp_facture.cfp_id AND  v_facture.num_facture = v_temp_facture.num_facture
    AND v_facture.entreprise_id = v_temp_facture.entreprise_id ;

CREATE OR REPLACE VIEW v_liste_facture AS SELECT
    v_liste_facture_tmp.*,
    ROUND((
        v_liste_facture_tmp.hors_taxe * v_facture_existant.valeur_remise_pourcent
    ) / 100) AS valeur_remise_par_session,
v_facture_existant.remise_id,
v_facture_existant.valeur_remise,
v_facture_existant.description_remise,
v_facture_existant.valeur_remise_pourcent
FROM
    v_liste_facture_tmp,
    v_facture_existant
WHERE
    v_liste_facture_tmp.projet_id = v_facture_existant.projet_id AND v_liste_facture_tmp.num_facture = v_facture_existant.num_facture;

CREATE OR REPLACE VIEW v_facture_actif AS SELECT
    v_facture_existant.cfp_id,
    v_facture_existant.activiter,
    (cfps.nom) nom_cfp,
    entreprises.nom_etp,
    projets.nom_projet,
    v_facture_existant.entreprise_id,
    v_facture_existant.num_facture,
    v_facture_existant.other_message,
    v_facture_existant.mode_financement_id,
    v_facture_existant.description_financement,
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
        v_facture_existant.description_type_facture,
        v_facture_existant.due_date,v_facture_existant.invoice_date,
        v_facture_existant.projet_id,
        (ROUND(v_facture_existant.montant_brut_ht)) montant_brut_ht,
        (ROUND(v_facture_existant.remise)) remise,
        (ROUND(v_facture_existant.valeur_remise)) valeur_remise,
        v_facture_existant.description_remise,
        v_facture_existant.remise_id,
        v_facture_existant.reference_remise,
        (ROUND(v_facture_existant.net_commercial)) net_commercial,
        (ROUND(v_facture_existant.net_ht)) net_ht,
        (ROUND(v_facture_existant.tva)) tva,
        (ROUND(v_facture_existant.net_ttc)) net_ttc,
        v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,
        (ROUND(v_facture_existant.rest_payer)) rest_payer,
        (ROUND(v_facture_existant.montant_total)) montant_total,
        (ROUND(v_facture_existant.payement_totale)) payement_totale,
        (ROUND(v_facture_existant.dernier_montant_ouvert)) dernier_montant_ouvert,
        v_facture_existant.date_facture
    FROM
        v_facture_existant,cfps,entreprises,projets
    WHERE
        v_facture_existant.activiter = TRUE AND  v_facture_existant.cfp_id = cfps.id AND v_facture_existant.entreprise_id = entreprises.id AND v_facture_existant.projet_id = projets.id;


CREATE OR REPLACE VIEW v_facture_inactif AS SELECT
    v_facture_existant.cfp_id,
    v_facture_existant.activiter,
    (cfps.nom) nom_cfp,
    entreprises.nom_etp,
    projets.nom_projet,
    v_facture_existant.entreprise_id,
    v_facture_existant.num_facture,
    v_facture_existant.other_message,
    v_facture_existant.mode_financement_id,
    v_facture_existant.description_financement,
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
        v_facture_existant.description_type_facture,
        v_facture_existant.due_date,v_facture_existant.invoice_date,
        v_facture_existant.projet_id,
        (ROUND(v_facture_existant.montant_brut_ht)) montant_brut_ht,
        (ROUND(v_facture_existant.remise)) remise,
        (ROUND(v_facture_existant.valeur_remise)) valeur_remise,
        v_facture_existant.description_remise,
        v_facture_existant.remise_id,
        v_facture_existant.reference_remise,
        (ROUND(v_facture_existant.net_commercial)) net_commercial,
        (ROUND(v_facture_existant.net_ht)) net_ht,
        (ROUND(v_facture_existant.tva)) tva,
        (ROUND(v_facture_existant.net_ttc)) net_ttc,
        v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,
        (ROUND(v_facture_existant.rest_payer)) rest_payer,
        (ROUND(v_facture_existant.montant_total)) montant_total,
        (ROUND(v_facture_existant.payement_totale)) payement_totale,
        (ROUND(v_facture_existant.dernier_montant_ouvert)) dernier_montant_ouvert,
        v_facture_existant.date_facture
    FROM
        v_facture_existant,cfps,entreprises,projets
    WHERE
        v_facture_existant.activiter = FALSE  AND  v_facture_existant.cfp_id = cfps.id AND v_facture_existant.entreprise_id = entreprises.id AND v_facture_existant.projet_id = projets.id;


CREATE OR REPLACE VIEW v_full_facture AS SELECT
    v_facture_existant.cfp_id,
    v_facture_existant.activiter,
    (cfps.nom) nom_cfp,
    entreprises.nom_etp,
    projets.nom_projet,
    v_facture_existant.entreprise_id,
    v_facture_existant.num_facture,
    v_facture_existant.other_message,
    v_facture_existant.mode_financement_id,
    v_facture_existant.description_financement,
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
        v_facture_existant.description_type_facture,
        v_facture_existant.due_date,v_facture_existant.invoice_date,
        v_facture_existant.projet_id,
        (ROUND(v_facture_existant.montant_brut_ht)) montant_brut_ht,
        (ROUND(v_facture_existant.remise)) remise,
        (ROUND(v_facture_existant.valeur_remise)) valeur_remise,
        v_facture_existant.description_remise,
        v_facture_existant.remise_id,
        v_facture_existant.reference_remise,
        (ROUND(v_facture_existant.net_commercial)) net_commercial,
        (ROUND(v_facture_existant.net_ht)) net_ht,
        (ROUND(v_facture_existant.tva)) tva,
        (ROUND(v_facture_existant.net_ttc)) net_ttc,
        v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,
        (ROUND(v_facture_existant.rest_payer)) rest_payer,
        (ROUND(v_facture_existant.montant_total)) montant_total,
        (ROUND(v_facture_existant.payement_totale)) payement_totale,
        (ROUND(v_facture_existant.dernier_montant_ouvert)) dernier_montant_ouvert,
        v_facture_existant.date_facture
    FROM
        v_facture_existant,cfps,entreprises,projets
    WHERE
       v_facture_existant.cfp_id = cfps.id AND v_facture_existant.entreprise_id = entreprises.id AND v_facture_existant.projet_id = projets.id;


CREATE OR REPLACE VIEW v_encaissement AS SELECT
    encaissements.*,
    mf.description
FROM
    encaissements
JOIN mode_financements mf ON
    encaissements.mode_financement_id = mf.id;


CREATE OR REPLACE VIEW v_frais_annexe AS SELECT
    montant_frais_annexes.*,
    (frais_annexes.description )frais_annexe_description
FROM
    montant_frais_annexes,frais_annexes
WHERE
    frais_annexe_id = frais_annexes.id;


CREATE OR REPLACE VIEW v_pagination_facture AS SELECT
    cfp_id,
    (
        ROUND(COUNT(num_facture)/10)
) totale_pagination
FROM
    v_montant_facture
GROUP BY
    cfp_id;





CREATE OR REPLACE view v_count_session_facturer as
SELECT
    (COUNT(factures.groupe_entreprise_id)) session_facturer,
    v_groupe_entreprise.projet_id,
    v_groupe_entreprise.entreprise_id
FROM
    v_groupe_entreprise
LEFT JOIN factures ON v_groupe_entreprise.groupe_entreprise_id = factures.groupe_entreprise_id
GROUP BY
    v_groupe_entreprise.projet_id,
    v_groupe_entreprise.entreprise_id;

CREATE OR REPLACE VIEW v_count_session_projet AS SELECT
    (COUNT(groupe_entreprise_id)) session_non_facturer,
    projet_id,
    entreprise_id
FROM
    v_groupe_entreprise
GROUP BY
    projet_id,
    entreprise_id;

CREATE OR REPLACE VIEW v_projet_facturer_tmp AS SELECT
    (
        ROUND(
            (
                (session_facturer * 100) / session_non_facturer
            ),
            0
        )
    ) pourcent_facturer,
    v_count_session_projet.projet_id,
    v_count_session_projet.entreprise_id,
    projets.nom_projet,
    projets.cfp_id
FROM
    v_count_session_facturer,
    v_count_session_projet,
    projets
WHERE
    v_count_session_facturer.projet_id = v_count_session_projet.projet_id AND
    v_count_session_facturer.entreprise_id = v_count_session_projet.entreprise_id AND
    v_count_session_facturer.projet_id = projets.id AND
    v_count_session_projet.projet_id = projets.id;


CREATE OR REPLACE view v_projet_facture as
select * from v_projet_facturer_tmp where pourcent_facturer <100 order by pourcent_facturer asc;