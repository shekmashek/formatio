CREATE OR REPLACE VIEW v_montant_pedagogique_facture AS SELECT
    cfp_id,
    projet_id,
    entreprise_id,
    type_facture_id,
    num_facture,
    SUM(qte) AS qte_totale,
    SUM(hors_taxe) AS hors_taxe,
    due_date,
    other_message,
    activiter,
    invoice_date
FROM
    factures
GROUP BY
    cfp_id,
    num_facture,
    projet_id,
    type_facture_id,
    entreprise_id,
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
    mpf.other_message,
    (
        mpf.hors_taxe + IFNULL(mfa.hors_taxe, 0)
    ) AS montant_brut_ht,
    mpf.due_date,
    mpf.invoice_date
FROM
    v_montant_frais_annexe mfa
RIGHT JOIN v_montant_pedagogique_facture mpf ON
    mpf.num_facture = mfa.num_facture  AND mpf.cfp_id = mfa.cfp_id AND mpf.entreprise_id = mfa.entreprise_id AND  mpf.projet_id = mfa.projet_id;


CREATE OR REPLACE VIEW v_remise_facture AS SELECT
	cfp_id,
    projet_id,
    entreprise_id,
    type_facture_id,
    num_facture,
    other_message,
    activiter,
    SUM(remise) / COUNT(num_facture) AS remise
FROM
    factures
GROUP BY
    num_facture,
    projet_id,
    type_facture_id,
    activiter,
    other_message,
    entreprise_id,
    cfp_id;


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


create or replace view v_montant_facture as
SELECT
    mbr.cfp_id,
    mbr.projet_id,
    mbr.entreprise_id,
    mbr.num_facture,
    mbr.montant_brut_ht,
    mbr.activiter,
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
    rf.remise,
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
        CASE WHEN v_montant_facture.projet_id = v_sum_acompte_facture.projet_id AND UPPER(
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


-- CREATE OR REPLACE VIEW v_liste_facture AS SELECT
--     factures.cfp_id,
--     (factures.id) facture_id,
--     (factures.projet_id) as projet_id,
--     nom_projet,
--     factures.type_payement_id,
--     (type_payement.type) description_type_payement,
--     bon_de_commande,
--     (factures.devise) facture,
--     factures.hors_taxe,
--     invoice_date,
--     due_date,
--     tax_id,
--     (taxes.description) nom_taxe,
--     taxes.pourcent,
--     (factures.description) description_facture,
--     other_message,
--     qte,
--     num_facture,
--     factures.activiter,
--     factures.groupe_entreprise_id,
--     groupes.groupe_id,
--     groupes.entreprise_id,
--     groupes.nom_groupe,
--     pu,
--     type_financement_id,
--     (mode_financements.description) description_financement,
--     entreprises.nom_etp,
--     (entreprises.adresse_rue) adresse,
--     entreprises.logo,
--     reference_bc,
--     remise,
--     type_facture_id,
--     (type_facture.description) description_type_facture,
--     (type_facture.reference) reference_facture,
--     entreprises.nif,
--     entreprises.stat,
--     entreprises.rcs,
--     entreprises.cif,
--     entreprises.secteur_id,
--     (secteurs.nom_secteur) secteur_activite,
--     entreprises.site_etp,
--     entreprises.email_etp,
--     entreprises.telephone_etp
-- FROM
--     factures,
--     type_payement,
--     taxes,
--     projets,
--     v_groupe_entreprise groupes,
--     entreprises,
--     secteurs,
--     mode_financements,
--     type_facture
-- WHERE
--     factures.type_payement_id = type_payement.id AND entreprises.secteur_id = secteurs.id AND
--     type_financement_id = mode_financements.id AND
--     factures.tax_id = taxes.id AND factures.cfp_id = projets.cfp_id  AND factures.projet_id = projets.id AND
--     factures.groupe_entreprise_id = groupes.groupe_entreprise_id AND groupes.entreprise_id = entreprises.id AND type_facture_id = type_facture.id;


CREATE OR REPLACE VIEW v_liste_facture AS SELECT
    factures.cfp_id,
    (factures.projet_id) as projet_id,
    factures.entreprise_id,
    bon_de_commande,
    factures.type_facture_id,
    (type_facture.description) description_type_facture,
    (type_facture.reference) reference_facture,
    (factures.devise) facture,
    factures.hors_taxe,
    factures.groupe_entreprise_id,
    v_groupe_projet_entreprise_module.nom_projet,
    v_groupe_projet_entreprise_module.groupe_id,
    v_groupe_projet_entreprise_module.nom_groupe,
    (v_groupe_projet_entreprise_module.date_debut) date_debut_session,
    v_groupe_projet_entreprise_module.reference,
    v_groupe_projet_entreprise_module.nom_module,
    v_groupe_projet_entreprise_module.modalite_formation,
    v_groupe_projet_entreprise_module.duree_jour,
    invoice_date,
    due_date,
    tax_id,
    (taxes.description) nom_taxe,
    taxes.pourcent,
    (factures.description) description_facture,
    other_message,
    qte,
    num_facture,
    factures.activiter,
    pu,
    entreprises.nom_etp,
    entreprises.adresse_rue,
    entreprises.adresse_quartier,
    entreprises.adresse_code_postal,
    entreprises.adresse_ville,
    entreprises.adresse_region,
    entreprises.logo,
    reference_bc,
    remise,
    entreprises.nif,
    entreprises.stat,
    entreprises.rcs,
    entreprises.cif,
    entreprises.secteur_id,
    (secteurs.nom_secteur) secteur_activite,
    entreprises.site_etp,
    entreprises.email_etp,
    entreprises.telephone_etp
FROM
    factures,
    v_groupe_projet_entreprise_module,type_facture,
    taxes,
    entreprises,
    secteurs
WHERE
    factures.entreprise_id = entreprises.id AND entreprises.secteur_id = secteurs.id AND
    factures.tax_id = taxes.id AND factures.groupe_entreprise_id = v_groupe_projet_entreprise_module.groupe_entreprise_id  AND type_facture_id = type_facture.id
GROUP BY
    entreprises.adresse_rue,
    entreprises.adresse_quartier,
    entreprises.adresse_code_postal,
    entreprises.adresse_ville,
    entreprises.adresse_region,
    factures.cfp_id,
    factures.projet_id,
    factures.entreprise_id,
    factures.type_facture_id,
    type_facture.description,
    type_facture.reference,
    factures.groupe_entreprise_id,
    v_groupe_projet_entreprise_module.nom_projet,
    v_groupe_projet_entreprise_module.groupe_id,
    v_groupe_projet_entreprise_module.nom_groupe,
    v_groupe_projet_entreprise_module.date_debut,
    v_groupe_projet_entreprise_module.reference,
    v_groupe_projet_entreprise_module.nom_module,
    v_groupe_projet_entreprise_module.modalite_formation,
    v_groupe_projet_entreprise_module.duree_jour,
    bon_de_commande,
    factures.devise,
    factures.hors_taxe,
    invoice_date,
    due_date,
    tax_id,
    taxes.description,
    taxes.pourcent,
    factures.description,
    other_message,
    qte,
    num_facture,
    factures.activiter,
    pu,
    entreprises.nom_etp,
    entreprises.adresse_rue,
    entreprises.logo,
    reference_bc,
    remise,
    entreprises.nif,
    entreprises.stat,
    entreprises.rcs,
    entreprises.cif,
    entreprises.secteur_id,
    secteurs.nom_secteur,
    entreprises.site_etp,
    entreprises.email_etp,
    entreprises.telephone_etp;


-- CREATE OR REPLACE VIEW v_facture_existant_tmp AS SELECT
--     v_facture.*,
--     (v_temp_facture.montant_facture) montant_total,
--     (v_temp_facture.payement) payement_totale,
--     (v_temp_facture.montant_ouvert) dernier_montant_ouvert,
--     (v_temp_facture.due_date) date_facture
-- FROM
--     v_facture,
--     v_temp_facture
-- WHERE
--     v_facture.cfp_id = v_temp_facture.cfp_id AND  v_facture.num_facture = v_temp_facture.num_facture;


-- CREATE OR REPLACE VIEW v_facture_existant AS SELECT
--     v_facture_existant_tmp.*,
--     projets.entreprise_id,
--      entreprises.nom_etp,
--     (
--         CASE WHEN(payement_totale - montant_total) < 0 AND payement_totale <= 0 THEN 'valider' WHEN(payement_totale - montant_total) < 0 AND payement_totale > 0 THEN 'en_cour' WHEN(payement_totale - montant_total) >= 0 THEN 'terminer'
--     END
-- ) facture_encour
-- FROM
--     v_facture_existant_tmp, v_groupe_projet_entreprise projets,entreprises
-- where
--     v_facture_existant_tmp.projet_id = projets.projet_id and projets.entreprise_id = entreprises.id;


CREATE OR REPLACE VIEW v_facture_existant_tmp AS SELECT
    v_facture.*,
    (v_temp_facture.montant_facture) montant_total,
    (v_temp_facture.payement) payement_totale,
    (v_temp_facture.montant_ouvert) dernier_montant_ouvert,
    (v_temp_facture.due_date) date_facture,
     (
        CASE WHEN(payement - montant_ouvert) < 0 AND payement <= 0 THEN 'valider' WHEN(payement - montant_ouvert) < 0 AND payement > 0 THEN 'en_cour' WHEN(payement - montant_ouvert) >= 0 THEN 'terminer'
    END
) facture_encour
FROM
    v_facture,
    v_temp_facture
WHERE
    v_facture.cfp_id = v_temp_facture.cfp_id AND  v_facture.num_facture = v_temp_facture.num_facture
    AND v_facture.entreprise_id = v_temp_facture.entreprise_id ;


CREATE OR REPLACE VIEW v_facture_existant AS SELECT
    v_facture_existant_tmp.*
FROM
   v_facture_existant_tmp
GROUP BY
    cfp_id,entreprise_id,projet_id,num_facture,montant_brut_ht,remise,net_commercial,net_commercial,net_ht,
    tva,net_ttc,type_facture_id,description_type_facture,reference_type_facture,due_date,invoice_date,
    sum_acompte,rest_payer,montant_total,payement_totale,dernier_montant_ouvert,date_facture,entreprise_id,
    other_message,facture_encour,activiter;



-- CREATE OR REPLACE VIEW v_facture_projet AS SELECT
-- (factures.id) facture_id,
-- factures.groupe_entreprise_id,
-- factures.projet_id,
-- projets.nom_projet,
-- projets.type_formation_id,
-- type_formations.type_formation,
-- groupe_entreprises.groupe_id,
-- groupes.nom_groupe
-- FROM
-- factures,groupe_entreprises,projets,groupes,type_formations
-- WHERE
-- factures.projet_id = projets.id AND factures.groupe_entreprise_id = groupe_entreprises.id AND
-- groupe_entreprises.groupe_id = groupes.id AND projets.id = groupes.projet_id AND projets.type_formation_id = type_formations.id;


-- CREATE OR REPLACE VIEW v_facture_actif_tmp AS SELECT
--     factures.cfp_id,
--     (cfps.nom) nom_cfp,
--     factures.entreprise_id,
--     v_facture_existant.nom_etp,
--     (factures.id) facture_id,
--     factures.num_facture,
--     other_message,
--     (
--         DATEDIFF(
--             v_facture_existant.due_date,
--             v_facture_existant.invoice_date
--         )
--     ) totale_jour,
--     (
--         IFNULL(
--             (
--                 DATEDIFF(v_facture_existant.due_date, NOW())),
--                 0
--             )
--         ) jour_restant,
--         v_facture_existant.facture_encour,
--         v_facture_existant.description_type_facture,
--         v_facture_existant.due_date,v_facture_existant.invoice_date,
--         v_facture_existant.projet_id,v_facture_existant.montant_brut_ht,v_facture_existant.remise,v_facture_existant.net_commercial,v_facture_existant.net_ht,
--         v_facture_existant.tva,v_facture_existant.net_ttc,v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,v_facture_existant.rest_payer,v_facture_existant.montant_total,
--         v_facture_existant.payement_totale,v_facture_existant.dernier_montant_ouvert,v_facture_existant.date_facture
--     FROM
--         v_facture_existant,cfps,
--         factures
--     WHERE
--         v_facture_existant.cfp_id = factures.cfp_id AND  v_facture_existant.projet_id = factures.projet_id  AND  v_facture_existant.num_facture = factures.num_facture AND factures.activiter = TRUE AND factures.cfp_id = cfps.id AND  v_facture_existant.cfp_id = cfps.id
--     GROUP BY
--         factures.id,
--         cfps.nom,
--         factures.cfp_id,
--         factures.entreprise_id,
--          v_facture_existant.nom_etp,
--         factures.num_facture,
--         factures.other_message,
--         facture_encour,
--         v_facture_existant.description_type_facture,
--         v_facture_existant.due_date,v_facture_existant.invoice_date,
--         v_facture_existant.projet_id,v_facture_existant.montant_brut_ht,v_facture_existant.remise,v_facture_existant.net_commercial,v_facture_existant.net_ht,
--         v_facture_existant.tva,v_facture_existant.net_ttc,v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,v_facture_existant.rest_payer,v_facture_existant.montant_total,
--         v_facture_existant.payement_totale,v_facture_existant.dernier_montant_ouvert,v_facture_existant.date_facture;


-- CREATE OR REPLACE VIEW v_facture_inactif_tmp AS SELECT
--     (factures.id) facture_id,
--     factures.cfp_id,
--     (cfps.nom) nom_cfp,
--     factures.num_facture,
--     factures.entreprise_id,
--     v_facture_existant.nom_etp,
--     other_message,
--     (
--         DATEDIFF(
--             v_facture_existant.due_date,
--             v_facture_existant.invoice_date
--         )
--     ) totale_jour,
--     (
--         IFNULL(
--             (
--                 DATEDIFF(v_facture_existant.due_date, NOW())),
--                 0
--             )
--         ) jour_restant,
--         facture_encour,
--         v_facture_existant.description_type_facture,
--         v_facture_existant.due_date,v_facture_existant.invoice_date,
--         v_facture_existant.projet_id,v_facture_existant.montant_brut_ht,v_facture_existant.remise,v_facture_existant.net_commercial,v_facture_existant.net_ht,
--         v_facture_existant.tva,v_facture_existant.net_ttc,v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,v_facture_existant.rest_payer,v_facture_existant.montant_total,
--         v_facture_existant.payement_totale,v_facture_existant.dernier_montant_ouvert,v_facture_existant.date_facture
--     FROM
--         v_facture_existant,cfps,
--         factures
--     WHERE
--        v_facture_existant.cfp_id = factures.cfp_id AND  v_facture_existant.projet_id = factures.projet_id  AND   v_facture_existant.num_facture = factures.num_facture AND factures.activiter = FALSE  AND factures.cfp_id = cfps.id AND  v_facture_existant.cfp_id = cfps.id
--     GROUP BY
--         factures.id,
--         factures.cfp_id,
--         cfps.nom,
--         factures.num_facture,
--         factures.entreprise_id,
--         v_facture_existant.nom_etp,
--         factures.other_message,
--         facture_encour,
--         v_facture_existant.description_type_facture,
--         v_facture_existant.due_date,v_facture_existant.invoice_date,
--         v_facture_existant.projet_id,v_facture_existant.montant_brut_ht,v_facture_existant.remise,v_facture_existant.net_commercial,v_facture_existant.net_ht,
--         v_facture_existant.tva,v_facture_existant.net_ttc,v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,v_facture_existant.rest_payer,v_facture_existant.montant_total,
--         v_facture_existant.payement_totale,v_facture_existant.dernier_montant_ouvert,v_facture_existant.date_facture;

-- CREATE OR REPLACE VIEW v_facture_actif AS SELECT
-- v_facture_actif_tmp.*,
-- v_facture_projet.groupe_entreprise_id,
-- v_facture_projet.nom_projet,
-- v_facture_projet.type_formation_id,
-- v_facture_projet.type_formation,
-- v_facture_projet.groupe_id,
-- v_facture_projet.nom_groupe
-- FROM
-- v_facture_actif_tmp,v_facture_projet
-- WHERE v_facture_actif_tmp.facture_id = v_facture_projet.facture_id;

-- CREATE OR REPLACE VIEW v_facture_inactif AS SELECT
-- v_facture_inactif_tmp.*,
-- v_facture_projet.groupe_entreprise_id,
-- v_facture_projet.nom_projet,
-- v_facture_projet.type_formation_id,
-- v_facture_projet.type_formation,
-- v_facture_projet.groupe_id,
-- v_facture_projet.nom_groupe
-- FROM
-- v_facture_inactif_tmp,v_facture_projet
-- WHERE v_facture_inactif_tmp.facture_id = v_facture_projet.facture_id;




CREATE OR REPLACE VIEW v_facture_actif_tmp AS SELECT
    v_facture_existant.cfp_id,
    v_facture_existant.activiter,
    (cfps.nom) nom_cfp,
    entreprises.nom_etp,
    projets.nom_projet,
    v_facture_existant.entreprise_id,
    v_facture_existant.num_facture,
    v_facture_existant.other_message,
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
        v_facture_existant.description_type_facture,
        v_facture_existant.due_date,v_facture_existant.invoice_date,
        v_facture_existant.projet_id,v_facture_existant.montant_brut_ht,v_facture_existant.remise,v_facture_existant.net_commercial,v_facture_existant.net_ht,
        v_facture_existant.tva,v_facture_existant.net_ttc,v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,v_facture_existant.rest_payer,v_facture_existant.montant_total,
        v_facture_existant.payement_totale,v_facture_existant.dernier_montant_ouvert,v_facture_existant.date_facture
    FROM
        v_facture_existant,cfps,entreprises,projets
    WHERE
      v_facture_existant.activiter = TRUE AND  v_facture_existant.cfp_id = cfps.id AND v_facture_existant.entreprise_id = entreprises.id AND v_facture_existant.projet_id = projets.id
    GROUP BY
        cfps.nom,
        entreprises.nom_etp,
        projets.nom_projet,
        v_facture_existant.activiter,
        v_facture_existant.cfp_id,
        v_facture_existant.entreprise_id,
        v_facture_existant.num_facture,
        v_facture_existant.other_message,
        facture_encour,
        v_facture_existant.description_type_facture,
        v_facture_existant.due_date,v_facture_existant.invoice_date,
        v_facture_existant.projet_id,v_facture_existant.montant_brut_ht,v_facture_existant.remise,v_facture_existant.net_commercial,v_facture_existant.net_ht,
        v_facture_existant.tva,v_facture_existant.net_ttc,v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,v_facture_existant.rest_payer,v_facture_existant.montant_total,
        v_facture_existant.payement_totale,v_facture_existant.dernier_montant_ouvert,v_facture_existant.date_facture;


CREATE OR REPLACE VIEW v_facture_inactif_tmp AS SELECT
    v_facture_existant.cfp_id,
    v_facture_existant.activiter,
    (cfps.nom) nom_cfp,
    entreprises.nom_etp,
    projets.nom_projet,
    v_facture_existant.entreprise_id,
    v_facture_existant.num_facture,
    v_facture_existant.other_message,
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
        v_facture_existant.projet_id,v_facture_existant.montant_brut_ht,v_facture_existant.remise,v_facture_existant.net_commercial,v_facture_existant.net_ht,
        v_facture_existant.tva,v_facture_existant.net_ttc,v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,v_facture_existant.rest_payer,v_facture_existant.montant_total,
        v_facture_existant.payement_totale,v_facture_existant.dernier_montant_ouvert,v_facture_existant.date_facture
    FROM
        v_facture_existant,cfps,entreprises,projets
    WHERE
        v_facture_existant.activiter = FALSE  AND  v_facture_existant.cfp_id = cfps.id AND v_facture_existant.entreprise_id = entreprises.id AND v_facture_existant.projet_id = projets.id
    GROUP BY
        v_facture_existant.cfp_id,
        v_facture_existant.activiter,
        cfps.nom,
        projets.nom_projet,
        entreprises.nom_etp,
        v_facture_existant.entreprise_id,
        v_facture_existant.num_facture,
        v_facture_existant.other_message,
        facture_encour,
        v_facture_existant.description_type_facture,
        v_facture_existant.due_date,v_facture_existant.invoice_date,
        v_facture_existant.projet_id,v_facture_existant.montant_brut_ht,v_facture_existant.remise,v_facture_existant.net_commercial,v_facture_existant.net_ht,
        v_facture_existant.tva,v_facture_existant.net_ttc,v_facture_existant.type_facture_id,v_facture_existant.reference_type_facture,v_facture_existant.rest_payer,v_facture_existant.montant_total,
        v_facture_existant.payement_totale,v_facture_existant.dernier_montant_ouvert,v_facture_existant.date_facture;


create or replace view v_facture_actif as
select
    cfp_id,
    activiter,
    nom_cfp,
    nom_etp,
    nom_projet,
    num_facture,
    entreprise_id,
    other_message,
    facture_encour,
    description_type_facture,
    due_date,invoice_date,
    jour_restant,
    projet_id,montant_brut_ht,remise,net_commercial,net_ht,
    tva,net_ttc,type_facture_id,reference_type_facture,rest_payer,montant_total,
    payement_totale,dernier_montant_ouvert,date_facture
from v_facture_actif_tmp
group by
    cfp_id,
    activiter,
    nom_cfp,
    nom_etp,
    nom_projet,
    num_facture,
    entreprise_id,
    other_message,
    facture_encour,
    description_type_facture,
    jour_restant,
    due_date,invoice_date,
    projet_id,montant_brut_ht,remise,net_commercial,net_ht,
    tva,net_ttc,type_facture_id,reference_type_facture,rest_payer,montant_total,
    payement_totale,dernier_montant_ouvert,date_facture;


create or replace view v_facture_inactif as
select
    cfp_id,
    nom_cfp,
    nom_etp,
    nom_projet,
    activiter,
    num_facture,
    entreprise_id,
    other_message,
    facture_encour,
    description_type_facture,
    jour_restant,
    due_date,invoice_date,
    projet_id,montant_brut_ht,remise,net_commercial,net_ht,
    tva,net_ttc,type_facture_id,reference_type_facture,rest_payer,montant_total,
    payement_totale,dernier_montant_ouvert,date_facture
from v_facture_inactif_tmp
group by
    cfp_id,
    nom_cfp,
    nom_etp,
    nom_projet,
    activiter,
    num_facture,
    entreprise_id,
    other_message,
    facture_encour,
    description_type_facture,
    jour_restant,
    due_date,invoice_date,
    projet_id,montant_brut_ht,remise,net_commercial,net_ht,
    tva,net_ttc,type_facture_id,reference_type_facture,rest_payer,montant_total,
    payement_totale,dernier_montant_ouvert,date_facture;



create or replace view v_compte_facture_actif as select cfp_id,entreprise_id, (COUNT(IFNULL(num_facture,0))) totale from v_facture_actif group by entreprise_id,cfp_id;
create or replace view v_compte_facture_inactif as select cfp_id,entreprise_id, (COUNT(IFNULL(num_facture,0))) totale from v_facture_inactif group by entreprise_id,cfp_id;
create or replace view v_compte_facture_en_cour as select cfp_id,entreprise_id, (COUNT(IFNULL(num_facture,0))) totale from v_facture_existant where facture_encour='en_cour' group by entreprise_id,cfp_id;
create or replace view v_compte_facture_payer as select cfp_id,entreprise_id, (COUNT(IFNULL(num_facture,0))) totale from v_facture_existant where facture_encour='terminer' group by entreprise_id,cfp_id;

create or replace view v_compte_facture_actif_cfp as select cfp_id, (COUNT(totale)) totale from v_compte_facture_actif group by cfp_id;
create or replace view v_compte_facture_inactif_cfp as select cfp_id, (COUNT(totale)) totale from v_compte_facture_inactif group by cfp_id;
create or replace view v_compte_facture_en_cour_cfp as select cfp_id, (COUNT(totale)) totale from v_compte_facture_en_cour group by cfp_id;
create or replace view v_compte_facture_payer_cfp as select cfp_id, (COUNT(totale)) totale from v_compte_facture_payer  group by cfp_id;


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
