CREATE OR REPLACE VIEW v_type_abonnement_role_etp AS SELECT
    t.id AS type_abonnement_role_id,
    t.type_abonne_id,
    t.type_abonnement_id,
    a.id AS abonnement_id,
    a.date_demande,
    a.date_debut,
    a.date_fin,
    a.status,
    a.entreprise_id,
    e.nom_etp as nom_entreprise,
    a.categorie_paiement_id,
    a.activite,
    a.type_arret,
    t_ab.nom_type,
    cat_p.categorie

FROM
    type_abonnement_roles t
JOIN abonnements a ON
    t.id = a.type_abonnement_role_id
JOIN type_abonnements t_ab ON
    t_ab.id = t.type_abonnement_id
JOIN categorie_paiements cat_p ON
    cat_p.id = a.categorie_paiement_id
JOIN entreprises e ON
    e.id = a.entreprise_id;

CREATE OR REPLACE VIEW v_categorie_abonnement_etp AS SELECT
    ta.*,
    cp.categorie as nom_categorie,
    tc.tarif,
    t.Logo
FROM
    v_type_abonnement_role_etp ta
JOIN categorie_paiements cp ON
    ta.categorie_paiement_id = cp.id
JOIN tarif_categories tc ON
    ta.type_abonnement_role_id = tc.type_abonnement_role_id AND ta.categorie_paiement_id = tc.categorie_paiement_id
JOIN type_abonnements t ON
    t.id = ta.type_abonnement_id;


CREATE OR REPLACE VIEW v_type_abonnement_role_cfp AS SELECT
    t.id AS type_abonnement_role_id,
    t.type_abonne_id,
    t.type_abonnement_id,
    a.id AS abonnement_id,
    a.date_demande,
    a.date_debut,
    a.date_fin,
    a.status,
    a.cfp_id,
    c.nom as nom_of,
    a.categorie_paiement_id,
    a.activite,
    a.type_arret,
    cat_p.categorie,
    t_ab.nom_type
FROM
    type_abonnement_roles t
JOIN abonnement_cfps a ON
    t.id = a.type_abonnement_role_id
JOIN type_abonnements t_ab ON
    t_ab.id = t.type_abonnement_id
JOIN categorie_paiements cat_p ON
    cat_p.id = a.categorie_paiement_id
JOIN cfps c ON
    c.id = a.cfp_id ;

CREATE OR REPLACE VIEW v_categorie_abonnements_cfp AS SELECT
    ta.*,
    tc.tarif,
    t.logo
FROM
    v_type_abonnement_role_cfp ta

JOIN tarif_categories tc ON
    ta.type_abonnement_role_id = tc.type_abonnement_role_id AND ta.categorie_paiement_id = tc.categorie_paiement_id
JOIN type_abonnements t ON
    t.id = ta.type_abonnement_id;

CREATE OR REPLACE VIEW v_abonnement_role as SELECT
    types.id as types_id,
    type_ab.id as types_abonnement_id,
    type_ab.nom_type,
    abonne.id as abonne_id,
    abonne.abonne_name
FROM type_abonnement_roles types
JOIN type_abonnements type_ab ON type_ab.id = types.type_abonnement_id
JOIN type_abonnes abonne ON abonne.id = types.type_abonne_id;

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
JOIN v_type_abonnement_role_cfp v_ab_cfp ON v_ab_cfp.abonnement_id = factures.abonnement_cfps_id;

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
JOIN v_type_abonnement_role_etp v_ab_etp ON v_ab_etp.abonnement_id = factures.abonnement_id;


