CREATE OR REPLACE VIEW v_type_abonnement_etp AS SELECT
    t.id AS type_abonnements_etp_id,
    t.nom_type,
    t.description,
    t.tarif,
    t.nb_utilisateur,
    t.nb_formateur,
    t.min_emp,
    t.max_emp,
    t.illimite,
    a.id AS abonnement_id,
    a.date_demande,
    a.date_debut,
    a.date_fin,
    a.status,
    a.entreprise_id,
    e.nom_etp as nom_entreprise,
    a.activite,
    a.created_at,
    a.type_arret,
    a.coupon_id,
    cp.coupon,
    cp.valeur,
    cp.utilise
FROM
    type_abonnements_etp t
JOIN abonnements a ON
    t.id = a.type_abonnement_id
JOIN entreprises e ON
    e.id = a.entreprise_id
LEFT JOIN coupon cp ON
    cp.id = a.coupon_id;

CREATE OR REPLACE VIEW v_type_abonnement_cfp AS SELECT
    t.id AS type_abonnements_cfp_id,
    t.nom_type,
    t.description,
    t.tarif,
    t.nb_utilisateur,
    t.nb_formateur,
    t.nb_projet,
    t.illimite,
    a.id AS abonnement_id,
    a.date_demande,
    a.date_debut,
    a.date_fin,
    a.status,
    a.cfp_id,
    c.nom as nom_of,
    a.activite,
    a.created_at,
    a.type_arret,
    a.coupon_id,
    cp.coupon,
    cp.valeur,
    cp.utilise
FROM
    type_abonnements_of t
JOIN abonnement_cfps a ON
    t.id = a.type_abonnement_id
JOIN cfps c ON
    c.id = a.cfp_id
LEFT JOIN coupon cp ON
    cp.id = a.coupon_id;

CREATE OR REPLACE VIEW v_abonnement_facture as SELECT
    factures.id as facture_id,
    factures.num_facture,
    factures.invoice_date,
    factures.due_date,
    factures.statut as status_facture,
    factures.montant_facture,
    factures.abonnement_cfps_id,
    v_ab_cfp.*
FROM
    factures_abonnements_cfp factures
JOIN v_type_abonnement_cfp v_ab_cfp ON v_ab_cfp.abonnement_id = factures.abonnement_cfps_id;

CREATE OR REPLACE VIEW v_abonnement_facture_entreprise as SELECT
    factures.id as facture_id,
    factures.num_facture,
    factures.invoice_date,
    factures.due_date,
    factures.statut as status_facture,
    factures.montant_facture,
    v_ab_etp.*
FROM
    factures_abonnements factures
JOIN v_type_abonnement_etp v_ab_etp ON v_ab_etp.abonnement_id = factures.abonnement_id;


CREATE OR REPLACE VIEW v_statut_compte_entreprise as SELECT
    etp.*,
    st.nom_statut
FROM
    entreprises as etp
JOIN statut_compte st ON st.id = etp.statut_compte_id;

CREATE OR REPLACE VIEW v_statut_compte_cfp as SELECT
    cfp.*,
    st.nom_statut
FROM
    cfps as cfp
JOIN statut_compte st ON st.id = cfp.statut_compte_id;