CREATE OR REPLACE VIEW v_refuse_demmande_cfp_etp AS SELECT
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    (c.email) email_cfp,
    (c.telephone) telephone_cfp,
    c.domaine_de_formation,
    c.user_id AS user_id_cfp,
    e.id AS entreprise_id,
    e.secteur_id,
    se.nom_secteur,
    e.nom_etp,
    (e.adresse_rue) adresse,
    e.email_etp,
    (d.created_at) date_refuse,
    e.telephone_etp
FROM
    refuse_demmande_cfp_etp d
JOIN cfps c ON
    d.demmandeur_cfp_id = c.id
JOIN entreprises e ON
    d.inviter_etp_id = e.id
JOIN secteurs se ON
    e.secteur_id = se.id;



CREATE OR REPLACE VIEW v_refuse_demmande_etp_cfp AS SELECT
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    (c.email) email_cfp,
    (c.telephone) telephone_cfp,
    c.domaine_de_formation,
    c.user_id AS user_id_cfp,
    e.id AS entreprise_id,
    e.secteur_id,
    se.nom_secteur,
    e.nom_etp,
    (e.adresse_rue) adresse,
    e.email_etp,
    (d.created_at) date_refuse,
    e.telephone_etp
FROM
    refuse_demmande_etp_cfp d
JOIN cfps c ON
    d.inviter_cfp_id = c.id
JOIN entreprises e ON
    d.demmandeur_etp_id = e.id
JOIN secteurs se ON
    e.secteur_id = se.id;