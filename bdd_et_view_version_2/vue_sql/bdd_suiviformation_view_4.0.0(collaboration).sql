
CREATE OR REPLACE VIEW v_demmande_formateur_cfp AS SELECT
    d.activiter AS activiter_demande,
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    c.email,
    c.telephone,
    c.slogan,
    c.nif,
    c.stat,
    c.rcs,
    c.cif,
    c.logo,
    c.activiter AS activiter_cfp,
    c.site_web,
    f.id AS formateur_id,
    f.nom_formateur,
    f.prenom_formateur,
    f.mail_formateur,
    f.numero_formateur,
    f.photos,
    f.genre_id,
    f.date_naissance,
    f.adresse,
    f.cin,
    f.specialite,
    f.niveau,
    f.activiter AS activiter_formateur,
    f.user_id AS user_id_formateur
FROM
    demmande_formateur_cfp d
JOIN cfps c ON
    c.id = d.inviter_cfp_id
JOIN formateurs f ON
    f.id = d.demmandeur_formateur_id
WHERE
    d.activiter = 1;

CREATE OR REPLACE VIEW v_demmande_cfp_formateur AS SELECT
    d.activiter AS activiter_demande,
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    c.email,
    c.telephone,
    c.slogan,
    c.nif,
    c.stat,
    c.rcs,
    c.cif,
    c.logo,
    c.activiter AS activiter_cfp,
    c.site_web,
    f.user_id,
    f.id AS formateur_id,
    f.nom_formateur,
    f.prenom_formateur,
    f.mail_formateur,
    f.numero_formateur,
    f.photos,
    f.genre_id,
    (IFNULL(g.genre,1)) genre,
    f.date_naissance,
    f.adresse,
    f.cin,
    f.specialite,
    f.niveau,
    f.activiter AS activiter_formateur,
    f.user_id AS user_id_formateur
FROM
    demmande_cfp_formateur d,cfps c,formateurs f,genre g
WHERE
    c.id = d.demmandeur_cfp_id AND
    f.id = d.inviter_formateur_id AND
    g.id = IFNULL(f.genre_id,1) AND d.activiter = 1;




CREATE OR REPLACE VIEW v_demmande_cfp_etp AS SELECT
    d.activiter AS activiter_demande,
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    c.email,
    c.telephone,
    c.slogan,
    c.nif AS nif_cfp,
    c.stat AS stat_cfp,
    c.rcs AS rcs_cfp,
    c.cif AS cif_cfp,
    c.logo AS logo_cfp,
    c.specialisation AS specialisation,
    c.presentation AS presentation,
    c.activiter AS activiter_cfp,
    c.site_web,
    e.id AS entreprise_id,
    e.nom_etp,
    e.adresse_rue  AS adresse_rue_etp,
    e.adresse_quartier  AS adresse_quartier_etp,
    e.adresse_code_postal  AS adresse_code_etp,
    e.adresse_ville  AS adresse_ville_etp,
    e.adresse_region  AS adresse_region_etp,
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
    e.telephone_etp,
    r.id AS responsable_id,
    r.nom_resp AS nom_resp,
    r.prenom_resp AS prenom_resp,
    r.email_resp AS email_responsable,
    r.photos AS photos_resp,
    rc.id AS responsable_cfp_id,
    rc.nom_resp_cfp,
    rc.prenom_resp_cfp,
    rc.photos_resp_cfp

FROM
    demmande_cfp_etp d
JOIN cfps c ON
    d.demmandeur_cfp_id = c.id
JOIN entreprises e ON
    d.inviter_etp_id = e.id
JOIN secteurs se ON
    e.secteur_id = se.id
JOIN responsables r ON
    r.entreprise_id = e.id
JOIN responsables_cfp rc ON
    rc.cfp_id = c.id
WHERE
    d.activiter = 1 and r.prioriter = 1 and rc.prioriter = 1;


CREATE OR REPLACE VIEW v_demmande_etp_cfp AS SELECT
    d.activiter AS activiter_demande,
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    c.email,
    c.telephone,
    c.slogan,
    c.nif AS nif_cfp,
    c.stat AS stat_cfp,
    c.rcs AS rcs_cfp,
    c.cif AS cif_cfp,
    c.logo AS logo_cfp,
    c.specialisation AS specialisation,
    c.presentation AS presentation,
    c.activiter AS activiter_cfp,
    c.site_web,
    e.id AS entreprise_id,
    e.nom_etp,
    (e.adresse_rue) adresse,
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
    e.telephone_etp,
    r.id AS responsable_id,
    r.nom_resp AS nom_resp,
    r.prenom_resp AS prenom_resp,
    r.email_resp AS email_responsable,
    r.photos AS photos_resp,
    rc.id AS responsable_cfp_id,
    rc.nom_resp_cfp,
    rc.prenom_resp_cfp,
    rc.photos_resp_cfp
FROM
    demmande_etp_cfp d
JOIN cfps c ON
    d.inviter_cfp_id = c.id
JOIN entreprises e ON
    d.demmandeur_etp_id = e.id
JOIN secteurs se ON
    e.secteur_id = se.id
JOIN responsables r ON
    r.entreprise_id = e.id
JOIN responsables_cfp rc ON
    rc.cfp_id = c.id
WHERE
    d.activiter = 1 and r.prioriter = 1 and rc.prioriter = 1;


CREATE OR REPLACE VIEW v_refuse_demmande_cfp_etp AS SELECT
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    (c.email) email_cfp,
    (c.telephone) telephone_cfp,
    c.slogan,
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
    c.slogan,
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