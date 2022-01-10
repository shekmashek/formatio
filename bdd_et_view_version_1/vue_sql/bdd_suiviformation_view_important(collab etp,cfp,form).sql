CREATE OR REPLACE VIEW v_demmande_cfp_etp AS SELECT
    d.activiter AS activiter_demande,
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    c.email,
    c.telephone,
    c.domaine_de_formation,
    c.nif AS nif_cfp,
    c.stat AS stat_cfp,
    c.rcs AS rcs_cfp,
    c.cif AS cif_cfp,
    c.logo AS logo_cfp,
    c.activiter AS activiter_cfp,
    c.site_cfp,
    c.user_id AS user_id_cfp,
    e.id AS entreprise_id,
    e.nom_etp,
    e.adresse,
    e.logo AS logo_etp,
    e.nif AS nif_etp,
    e.stat AS stat_etp,
    e.cif AS cif_etp,
    e.rcs AS rcs_etp,
    e.secteur_id,
    se.nom_secteur,
    e.email_etp,
    e.site_etp,
    e.activiter AS activer_etp,
    e.telephone_etp
FROM
    demmande_cfp_etp d
JOIN cfps c ON
    d.demmandeur_cfp_id = c.id
JOIN entreprises e ON
    d.inviter_etp_id = e.id
JOIN secteurs se ON
    e.secteur_id = se.id
WHERE
    d.activiter = 1;


CREATE OR REPLACE VIEW v_demmande_etp_cfp AS SELECT
    d.activiter AS activiter_demande,
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    c.email,
    c.telephone,
    c.domaine_de_formation,
    c.nif AS nif_cfp,
    c.stat AS stat_cfp,
    c.rcs AS rcs_cfp,
    c.cif AS cif_cfp,
    c.logo AS logo_cfp,
    c.activiter AS activiter_cfp,
    c.site_cfp,
    c.user_id AS user_id_cfp,
    e.id AS entreprise_id,
    e.nom_etp,
    e.adresse,
    e.logo AS logo_etp,
    e.nif AS nif_etp,
    e.stat AS stat_etp,
    e.cif AS cif_etp,
    e.rcs AS rcs_etp,
    e.secteur_id,
    se.nom_secteur,
    e.email_etp,
    e.site_etp,
    e.activiter AS activer_etp,
    e.telephone_etp
FROM
    demmande_etp_cfp d
JOIN cfps c ON
    d.inviter_cfp_id = c.id
JOIN entreprises e ON
    d.demmandeur_etp_id = e.id
JOIN secteurs se ON
    e.secteur_id = se.id
WHERE
    d.activiter = 1;
