CREATE OR REPLACE VIEW v_demmande_cfp_pour_etp AS SELECT
    demmande_cfp_etp.id,
    demmandeur_cfp_id,
    (cfps.nom) nom_cfp,
    (cfps.adresse_lot) adresse_lot_cfp,
    (cfps.adresse_ville) adresse_ville_cfp,
    (cfps.adresse_region) adresse_region_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.slogan,
    (cfps.nif) nif_cfp,
    (cfps.stat) stat_cfp,
    (cfps.rcs) rcs_cfp,
    (cfps.cif) cif_cfp,
    (cfps.logo) logo_cfp,
    (cfps.specialisation) specialisation,
    (cfps.presentation) presentation,
    (demmande_cfp_etp.activiter) activiter_cfp ,
    inviter_etp_id,
    entreprises.nom_etp,
    telephone_etp,
    email_etp,
    (entreprises.adresse_rue) adresse_etp,
    (entreprises.logo) logo_etp,
    (entreprises.nif) nif_etp,
    (entreprises.stat) nif_stat,
    (entreprises.rcs) nif_rcs,
    (entreprises.cif) cif_rcs,
    secteur_id,
    resp_cfp_id,
    resp_etp_id,
    responsables_cfp.nom_resp_cfp,
    responsables_cfp.prenom_resp_cfp,
    responsables_cfp.email_resp_cfp,
   secteurs.nom_secteur,
    (
        DATEDIFF(
            NOW(), demmande_cfp_etp.created_at)
        ) jours,
        (
            CASE WHEN DATEDIFF(
                NOW(), demmande_cfp_etp.created_at) > 0 THEN CONCAT(
                    DATEDIFF(
                        NOW(), demmande_cfp_etp.created_at),
                        ' jour(s)'
                    ) ELSE "aujourd'huit"
                END
            ) attente,
            (demmande_cfp_etp.created_at) date_demmande
        FROM
            demmande_cfp_etp,secteurs,
            entreprises,cfps,responsables_cfp
        WHERE
            inviter_etp_id = entreprises.id and secteur_id = secteurs.id  and
            demmandeur_cfp_id = cfps.id and
            cfps.id = responsables_cfp.cfp_id and responsables_cfp.id =resp_cfp_id
            and demmande_cfp_etp.activiter = 0;



CREATE OR REPLACE VIEW v_demmande_etp_pour_cfp AS SELECT
    demmande_etp_cfp.id,
    demmandeur_etp_id,
    inviter_cfp_id,
    (cfps.nom) nom_cfp,
    (cfps.adresse_lot) adresse_lot_cfp,
    (cfps.adresse_ville) adresse_ville_cfp,
    (cfps.adresse_region) adresse_region_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.slogan,
    (cfps.nif) nif_cfp,
    (cfps.stat) stat_cfp,
    (cfps.rcs) rcs_cfp,
    (cfps.cif) cif_cfp,
    (cfps.logo) logo_cfp,
    (cfps.specialisation) specialisation,
    (cfps.presentation) presentation,
    (demmande_etp_cfp.activiter) activiter_etp ,
    entreprises.nom_etp,
    telephone_etp,
    email_etp,
    (entreprises.adresse_rue) adresse_etp,
    (entreprises.logo) logo_etp,
    (entreprises.nif) nif_etp,
    (entreprises.stat) nif_stat,
    (entreprises.rcs) nif_rcs,
    (entreprises.cif) cif_rcs,
    secteur_id,
    resp_cfp_id,
    resp_etp_id,
    responsables.nom_resp,
    responsables.prenom_resp,
    responsables.email_resp,
    secteurs.nom_secteur,
    (
        DATEDIFF(
            demmande_etp_cfp.created_at,
            NOW())
        ) jours,
        (
            CASE WHEN DATEDIFF(
                NOW(), demmande_etp_cfp.created_at) > 0 THEN CONCAT(
                    DATEDIFF(
                        NOW(), demmande_etp_cfp.created_at),
                        ' jour(s)'
                    ) ELSE "aujourd'huit"
                END
            ) attente,
            (
                demmande_etp_cfp.created_at
            ) date_demmande
        FROM
            demmande_etp_cfp,secteurs,
            entreprises,cfps,responsables
        WHERE
            demmandeur_etp_id = entreprises.id and secteur_id = secteurs.id  and
            inviter_cfp_id = cfps.id  and
            entreprises.id = responsables.entreprise_id and responsables.id =resp_etp_id
            and demmande_etp_cfp.activiter = 0;


CREATE OR REPLACE VIEW v_invitation_cfp_pour_etp AS SELECT
   demmande_etp_cfp.id,
    demmandeur_etp_id,
    inviter_cfp_id,
    (cfps.nom) nom_cfp,
    (cfps.adresse_lot) adresse_lot_cfp,
    (cfps.adresse_ville) adresse_ville_cfp,
    (cfps.adresse_region) adresse_region_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.slogan,
    (cfps.nif) nif_cfp,
    (cfps.stat) stat_cfp,
    (cfps.rcs) rcs_cfp,
    (cfps.cif) cif_cfp,
    (cfps.logo) logo_cfp,
    (cfps.specialisation) specialisation,
    (cfps.presentation) presentation,
    (demmande_etp_cfp.activiter) activiter_etp ,
    entreprises.nom_etp,
    telephone_etp,
    email_etp,
    (entreprises.adresse_rue) adresse_etp,
    (entreprises.logo) logo_etp,
    (entreprises.nif) nif_etp,
    (entreprises.stat) nif_stat,
    (entreprises.rcs) nif_rcs,
    (entreprises.cif) cif_rcs,
    secteur_id,
    resp_cfp_id,
    resp_etp_id,
    responsables.nom_resp,
    responsables.prenom_resp,
    responsables.email_resp,
    secteurs.nom_secteur,
    (
        DATEDIFF(
            demmande_etp_cfp.created_at,
            NOW())
        ) jours,
        (
            CASE WHEN DATEDIFF(
                NOW(), demmande_etp_cfp.created_at) > 0 THEN CONCAT(
                    DATEDIFF(
                        NOW(), demmande_etp_cfp.created_at),
                        ' jour(s)'
                    ) ELSE "aujourd'huit"
                END
            ) attente,
            (
                demmande_etp_cfp.created_at
            ) date_demmande
        FROM
            demmande_etp_cfp,secteurs,
            entreprises,cfps,responsables
        WHERE
            demmandeur_etp_id = entreprises.id and secteur_id = secteurs.id  and
            inviter_cfp_id = cfps.id  and
            entreprises.id = responsables.entreprise_id and responsables.id =resp_etp_id
            and demmande_etp_cfp.activiter = 0;


CREATE OR REPLACE VIEW v_invitation_etp_pour_cfp AS SELECT
    demmande_cfp_etp.id,
    demmandeur_cfp_id,
    (cfps.nom) nom_cfp,
    (cfps.adresse_lot) adresse_lot_cfp,
    (cfps.adresse_ville) adresse_ville_cfp,
    (cfps.adresse_region) adresse_region_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.slogan,
    (cfps.nif) nif_cfp,
    (cfps.stat) stat_cfp,
    (cfps.rcs) rcs_cfp,
    (cfps.cif) cif_cfp,
    (cfps.logo) logo_cfp,
    (cfps.specialisation) specialisation,
    (cfps.presentation) presentation,
    (demmande_cfp_etp.activiter) activiter_cfp ,
    inviter_etp_id,
    entreprises.nom_etp,
    telephone_etp,
    email_etp,
    (entreprises.adresse_rue) adresse_etp,
    (entreprises.logo) logo_etp,
    (entreprises.nif) nif_etp,
    (entreprises.stat) nif_stat,
    (entreprises.rcs) nif_rcs,
    (entreprises.cif) cif_rcs,
    secteur_id,
    resp_cfp_id,
    resp_etp_id,
    responsables_cfp.nom_resp_cfp,
    responsables_cfp.prenom_resp_cfp,
    responsables_cfp.email_resp_cfp,
   secteurs.nom_secteur,
    (
        DATEDIFF(
            NOW(), demmande_cfp_etp.created_at)
        ) jours,
        (
            CASE WHEN DATEDIFF(
                NOW(), demmande_cfp_etp.created_at) > 0 THEN CONCAT(
                    DATEDIFF(
                        NOW(), demmande_cfp_etp.created_at),
                        ' jour(s)'
                    ) ELSE "aujourd'huit"
                END
            ) attente,
            (demmande_cfp_etp.created_at) date_demmande
        FROM
            demmande_cfp_etp,secteurs,
            entreprises,cfps,responsables_cfp
        WHERE
            inviter_etp_id = entreprises.id and secteur_id = secteurs.id  and
            demmandeur_cfp_id = cfps.id and
            cfps.id = responsables_cfp.cfp_id and responsables_cfp.id =resp_cfp_id
            and demmande_cfp_etp.activiter = 0;




CREATE OR REPLACE VIEW v_demmande_cfp_etp AS SELECT
    d.activiter AS activiter_demande,
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_quartier,
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
    rc.email_resp_cfp,
    rc.nom_resp_cfp,
    rc.prenom_resp_cfp,
    rc.photos_resp_cfp,
      concat(SUBSTRING(rc.nom_resp_cfp, 1, 1),SUBSTRING(rc.prenom_resp_cfp, 1, 1)) as initial,
    d.resp_cfp_id,
    d.resp_etp_id
FROM
    demmande_cfp_etp d
JOIN cfps c ON
    d.demmandeur_cfp_id = c.id
JOIN entreprises e ON
    d.inviter_etp_id = e.id
JOIN secteurs se ON
    e.secteur_id = se.id
JOIN responsables r ON
    r.id = d.resp_etp_id
JOIN responsables_cfp rc ON
    rc.id = d.resp_cfp_id
Where
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
    rc.email_resp_cfp,
    rc.nom_resp_cfp,
    rc.prenom_resp_cfp,
    rc.photos_resp_cfp,
    d.resp_cfp_id,
    d.resp_etp_id,
    concat(SUBSTRING(rc.nom_resp_cfp, 1, 1),SUBSTRING(rc.prenom_resp_cfp, 1, 1)) as initial
FROM
    demmande_etp_cfp d
JOIN cfps c ON
    d.inviter_cfp_id = c.id
JOIN entreprises e ON
    d.demmandeur_etp_id = e.id
JOIN secteurs se ON
    e.secteur_id = se.id
JOIN responsables r ON
    r.id = d.resp_etp_id
JOIN responsables_cfp rc ON
    rc.id = d.resp_cfp_id
WHERE
    d.activiter = 1;



CREATE OR REPLACE VIEW v_demmande_cfp_pour_formateur AS SELECT
    demmande_cfp_formateur.id,
    demmandeur_cfp_id,
    inviter_formateur_id,

    responsables_cfp.id AS responsable_cfp_id,
    responsables_cfp.email_resp_cfp,
    responsables_cfp.nom_resp_cfp,
    responsables_cfp.prenom_resp_cfp,
    responsables_cfp.photos_resp_cfp,
    cfps.id AS cfp_id,
    cfps.nom,
    cfps.adresse_lot,
    cfps.adresse_ville,
    cfps.adresse_region,
    cfps.email,
    cfps.telephone,
    cfps.slogan,
    cfps.nif AS nif_cfp,
    cfps.stat AS stat_cfp,
    cfps.rcs AS rcs_cfp,
    cfps.cif AS cif_cfp,
    cfps.logo AS logo_cfp,
    cfps.specialisation AS specialisation,
    cfps.presentation AS presentation,
    cfps.activiter AS activiter_cfp,
    cfps.site_web,
    formateurs.nom_formateur,
    formateurs.prenom_formateur,
    formateurs.mail_formateur,
    (formateurs.photos) photo_formateur,
    (formateurs.adresse) adresse_formateur,
    (formateurs.cin) cin_formateur,
    (formateurs.specialite) specialite_formateur,
    (formateurs.niveau_etude_id) niveau_formateur,
    formateurs.numero_formateur,
    (
        DATEDIFF(
            demmande_cfp_formateur.created_at,
            NOW())
        ) jours,
        (
            CASE WHEN DATEDIFF(
                NOW(), demmande_cfp_formateur.created_at) > 0 THEN CONCAT(
                    DATEDIFF(
                        NOW(), demmande_cfp_formateur.created_at),
                        ' jour(s)'
                    ) ELSE "aujourd'huit"
                END
            ) attente,
            (
                demmande_cfp_formateur.created_at
            ) date_demmande
        FROM
            demmande_cfp_formateur,responsables_cfp,cfps,
            formateurs
        WHERE
            demmandeur_cfp_id = cfps.id and inviter_formateur_id = formateurs.id  and

              demmande_cfp_formateur.activiter = 0;



CREATE OR REPLACE VIEW v_demmande_formateur_pour_cfp AS SELECT
    demmande_formateur_cfp.id,
    demmandeur_formateur_id,
    inviter_cfp_id,
    resp_cfp_id,
    responsables_cfp.id AS responsable_cfp_id,
    responsables_cfp.email_resp_cfp,
    responsables_cfp.nom_resp_cfp,
    responsables_cfp.prenom_resp_cfp,
    responsables_cfp.photos_resp_cfp,
    cfps.id AS cfp_id,
    cfps.activiter AS activiter_cfp,
    cfps.site_web,
    (cfps.nom) nom_cfp,
    (cfps.adresse_lot) adresse_lot_cfp,
    (cfps.adresse_ville) adresse_ville_cfp,
    (cfps.adresse_region) adresse_region_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.slogan,
    (cfps.nif) nif_cfp,
    (cfps.stat) stat_cfp,
    (cfps.rcs) rcs_cfp,
    (cfps.cif) cif_cfp,
    (cfps.logo) logo_cfp,
    (cfps.specialisation) specialisation,
    (cfps.presentation) presentation,
    (
        DATEDIFF(
            demmande_formateur_cfp.created_at,
            NOW())
        ) jours,
        (
            CASE WHEN DATEDIFF(
                NOW(), demmande_formateur_cfp.created_at) > 0 THEN CONCAT(
                    DATEDIFF(
                        NOW(), demmande_formateur_cfp.created_at),
                        ' jour(s)'
                    ) ELSE "aujourd'huit"
                END
            ) attente,
            (
                demmande_formateur_cfp.created_at
            ) date_demmande
        FROM
            demmande_formateur_cfp,responsables_cfp,formateurs,
            cfps
        WHERE
            inviter_cfp_id = cfps.id and demmandeur_formateur_id = formateurs.id  and
            resp_cfp_id =responsables_cfp.id and inviter_cfp_id =responsables_cfp.cfp_id
            and  demmande_formateur_cfp.activiter = 0;




CREATE OR REPLACE VIEW v_invitation_cfp_pour_formateur AS SELECT
    demmande_formateur_cfp.id,
    inviter_cfp_id,
    demmandeur_formateur_id,
    resp_cfp_id,
    responsables_cfp.id AS responsable_cfp_id,
    responsables_cfp.email_resp_cfp,
    responsables_cfp.nom_resp_cfp,
    responsables_cfp.prenom_resp_cfp,
    responsables_cfp.photos_resp_cfp,
    cfps.id AS cfp_id,
    cfps.nom,
    cfps.adresse_lot,
    cfps.adresse_ville,
    cfps.adresse_region,
    cfps.email,
    cfps.telephone,
    cfps.slogan,
    cfps.nif AS nif_cfp,
    cfps.stat AS stat_cfp,
    cfps.rcs AS rcs_cfp,
    cfps.cif AS cif_cfp,
    cfps.logo AS logo_cfp,
    cfps.specialisation AS specialisation,
    cfps.presentation AS presentation,
    cfps.activiter AS activiter_cfp,
    cfps.site_web,
    formateurs.nom_formateur,
    formateurs.prenom_formateur,
    formateurs.mail_formateur,
    (formateurs.photos) photo_formateur,
    (formateurs.adresse) adresse_formateur,
    (formateurs.cin) cin_formateur,
    (formateurs.specialite) specialite_formateur,
    (formateurs.niveau_etude_id) niveau_formateur,
    formateurs.numero_formateur,
    (
        DATEDIFF(
            demmande_formateur_cfp.created_at,
            NOW())
        ) jours,
        (
            CASE WHEN DATEDIFF(
                NOW(), demmande_formateur_cfp.created_at) > 0 THEN CONCAT(
                    DATEDIFF(
                        NOW(), demmande_formateur_cfp.created_at),
                        ' jour(s)'
                    ) ELSE "aujourd'huit"
                END
            ) attente,
            (
                demmande_formateur_cfp.created_at
            ) date_demmande
        FROM
            demmande_formateur_cfp,responsables_cfp,cfps,
            formateurs
        WHERE
            inviter_cfp_id = cfps.id and demmandeur_formateur_id = formateurs.id
            and resp_cfp_id =responsables_cfp.id and inviter_cfp_id =responsables_cfp.cfp_id
            and  demmande_formateur_cfp.activiter = 0;


CREATE OR REPLACE VIEW v_invitation_formateur_pour_cfp AS SELECT
    demmande_cfp_formateur.id,
    inviter_formateur_id,
    demmandeur_cfp_id,
    resp_cfp_id,
    responsables_cfp.id AS responsable_cfp_id,
    responsables_cfp.email_resp_cfp,
    responsables_cfp.nom_resp_cfp,
    responsables_cfp.prenom_resp_cfp,
    responsables_cfp.photos_resp_cfp,
    cfps.id AS cfp_id,
    cfps.nom,
    cfps.adresse_lot,
    cfps.adresse_ville,
    cfps.adresse_region,
    cfps.email,
    cfps.telephone,
    cfps.slogan,
    cfps.nif AS nif_cfp,
    cfps.stat AS stat_cfp,
    cfps.rcs AS rcs_cfp,
    cfps.cif AS cif_cfp,
    cfps.logo AS logo_cfp,
    cfps.specialisation AS specialisation,
    cfps.presentation AS presentation,
    cfps.activiter AS activiter_cfp,
    cfps.site_web,
    formateurs.nom_formateur,
    formateurs.prenom_formateur,
    formateurs.mail_formateur,
    (formateurs.photos) photo_formateur,
    (formateurs.adresse) adresse_formateur,
    (formateurs.cin) cin_formateur,
    (formateurs.specialite) specialite_formateur,
    (formateurs.niveau_etude_id) niveau_formateur,
    formateurs.numero_formateur,
    (
        DATEDIFF(
            demmande_cfp_formateur.created_at,
            NOW())
        ) jours,
        (
            CASE WHEN DATEDIFF(
                NOW(), demmande_cfp_formateur.created_at) > 0 THEN CONCAT(
                    DATEDIFF(
                        NOW(), demmande_cfp_formateur.created_at),
                        ' jour(s)'
                    ) ELSE "aujourd'huit"
                END
            ) attente,
            (
                demmande_cfp_formateur.created_at
            ) date_demmande
        FROM
            demmande_cfp_formateur,responsables_cfp,cfps,
            formateurs
        WHERE
            demmandeur_cfp_id = cfps.id  and inviter_formateur_id = formateurs.id
            and resp_cfp_id =responsables_cfp.id and demmandeur_cfp_id =responsables_cfp.cfp_id
            and  demmande_cfp_formateur.activiter = 0;




CREATE OR REPLACE VIEW v_demmande_formateur_cfp AS SELECT
    d.activiter AS activiter_demande,
    rsp.email_resp_cfp,
    rsp.nom_resp_cfp,
    rsp.prenom_resp_cfp,
    rsp.photos_resp_cfp,
    d.resp_cfp_id,
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
    f.niveau_etude_id,
    f.activiter AS activiter_formateur,
    f.user_id AS user_id_formateur
FROM
    demmande_formateur_cfp d
JOIN cfps c ON
    c.id = d.inviter_cfp_id
JOIN formateurs f ON
    f.id = d.demmandeur_formateur_id
JOIN responsables_cfp rsp ON
    d.resp_cfp_id =rsp.id
WHERE
    d.activiter = 1;


CREATE OR REPLACE VIEW v_demmande_cfp_formateur AS SELECT
    d.activiter AS activiter_demande,
    rsp.email_resp_cfp,
    rsp.nom_resp_cfp,
    rsp.prenom_resp_cfp,
    rsp.photos_resp_cfp,

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
    f.niveau_etude_id,
    f.activiter AS activiter_formateur,
    f.user_id AS user_id_formateur
FROM
    demmande_cfp_formateur d,cfps c,formateurs f,genre g,responsables_cfp rsp
WHERE
    c.id = d.demmandeur_cfp_id AND
    f.id = d.inviter_formateur_id AND
    g.id = IFNULL(f.genre_id,1) AND d.activiter = 1 AND rsp.prioriter = 1;






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
    e.telephone_etp,
    r.id AS responsable_id,
    r.nom_resp AS nom_resp,
    r.prenom_resp AS prenom_resp,
    r.email_resp AS email_resp,
    r.photos AS photos_resp,
    rc.id AS responsable_cfp_id,
    rc.email_resp_cfp,
    rc.nom_resp_cfp,
    rc.prenom_resp_cfp,
    rc.photos_resp_cfp,
    d.resp_cfp_id,
    d.resp_etp_id
FROM
    refuse_demmande_cfp_etp d
JOIN cfps c ON
    d.demmandeur_cfp_id = c.id
JOIN entreprises e ON
    d.inviter_etp_id = e.id
JOIN secteurs se ON
    e.secteur_id = se.id
JOIN responsables r ON d.resp_etp_id = r.id
JOIN responsables_cfp rc ON d.resp_cfp_id = rc.id;



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
    e.telephone_etp,
    r.id AS responsable_id,
    r.nom_resp AS nom_resp,
    r.prenom_resp AS prenom_resp,
    r.email_resp AS email_resp,
    r.photos AS photos_resp,
    rc.id AS responsable_cfp_id,
    rc.email_resp_cfp,
    rc.nom_resp_cfp,
    rc.prenom_resp_cfp,
    rc.photos_resp_cfp,
    d.resp_cfp_id,
    d.resp_etp_id
FROM
    refuse_demmande_etp_cfp d
JOIN cfps c ON
    d.inviter_cfp_id = c.id
JOIN entreprises e ON
    d.demmandeur_etp_id = e.id
JOIN secteurs se ON
    e.secteur_id = se.id
JOIN responsables r ON d.resp_etp_id = r.id
JOIN responsables_cfp rc ON d.resp_cfp_id = rc.id;