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
    a.categorie_paiement_id
FROM
    type_abonnement_roles t
JOIN abonnements a ON
    t.id = a.type_abonnement_role_id;


CREATE OR REPLACE VIEW v_categorie_abonnement_etp AS SELECT
    ta.*,
    cp.categorie,
    tc.tarif,
    t.nom_type,
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
    a.categorie_paiement_id
FROM
    type_abonnement_roles t
JOIN abonnement_cfps a ON
    t.id = a.type_abonnement_role_id;


-- CREATE OR REPLACE VIEW v_type_abonnement_role_cfp AS SELECT
--     t.id AS type_abonnement_role_id,
--     t.type_abonne_id,
--     t.type_abonnement_id,
--     a.id AS abonnement_id,
--     a.date_demande,
--     a.date_debut,
--     a.date_fin,
--     a.status,
--     a.cfp_id,
--     a.categorie_paiement_id,
--     typeAb.nom_type
-- FROM
--     type_abonnement_roles t
-- JOIN abonnement_cfps a ON
--     t.id = a.type_abonnement_role_id
-- JOIN type_abonnements typeAb ON
--     t.type_abonnement_id = typeAb.id;
CREATE OR REPLACE VIEW v_categorie_abonnements_cfp AS SELECT
    ta.*,
    cp.categorie,
    tc.tarif,
    t.nom_type,
    t.logo
FROM
    v_type_abonnement_role_cfp ta
JOIN categorie_paiements cp ON
    ta.categorie_paiement_id = cp.id
JOIN tarif_categories tc ON
    ta.type_abonnement_role_id = tc.type_abonnement_role_id AND ta.categorie_paiement_id = tc.categorie_paiement_id
JOIN type_abonnements t ON
    t.id = ta.type_abonnement_id;

