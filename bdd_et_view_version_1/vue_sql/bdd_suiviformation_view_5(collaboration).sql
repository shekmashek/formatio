CREATE OR REPLACE VIEW v_demmande_cfp_pour_etp AS SELECT
    demmande_cfp_etp.id,
    demmandeur_cfp_id,
    (demmande_cfp_etp.activiter) activiter_cfp ,
    inviter_etp_id,
    entreprises.nom_etp,
    telephone_etp,
    email_etp,
    (entreprises.adresse) adresse_etp,
    (entreprises.logo) logo_etp,
    (entreprises.nif) nif_etp,
    (entreprises.stat) nif_stat,
    (entreprises.rcs) nif_rcs,
    (entreprises.cif) cif_rcs,
    secteur_id,
    responsables.nom_resp,
    responsables.prenom_resp,
    responsables.email_resp,
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
            entreprises,responsables
        WHERE
            inviter_etp_id = entreprises.id and secteur_id = secteurs.id  and
            entreprises.id = responsables.entreprise_id and demmande_cfp_etp.activiter = 0;



CREATE OR REPLACE VIEW v_invitation_cfp_pour_etp AS SELECT
    demmande_etp_cfp.id,
    inviter_cfp_id,
    demmandeur_etp_id,
    (cfps.nom) nom_cfp,
    (cfps.adresse_lot) adresse_lot_cfp,
    (cfps.adresse_ville) adresse_ville_cfp,
    (cfps.adresse_region) adresse_region_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.domaine_de_formation,
    (cfps.nif) nif_cfp,
    (cfps.stat) stat_cfp,
    (cfps.rcs) rcs_cfp,
    (cfps.cif) cif_cfp,
    (cfps.logo) logo_cfp,
    entreprises.nom_etp,
    (entreprises.adresse) adresse_etp,
    (entreprises.logo) logo_etp,
    (entreprises.nif) nif_etp,
    (entreprises.stat) nif_stat,
    (entreprises.rcs) nif_rcs,
    (entreprises.cif) cif_rcs,
    entreprises.telephone_etp,
    entreprises.email_etp,
    secteur_id,
    responsables.nom_resp,
    responsables.prenom_resp,
    responsables.email_resp,
    secteurs.nom_secteur,
    (
        DATEDIFF(
            NOW(), demmande_etp_cfp.created_at)
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
            (demmande_etp_cfp.created_at) date_demmande
        FROM
            demmande_etp_cfp,secteurs,
            entreprises,responsables,cfps
        WHERE
            demmandeur_etp_id = entreprises.id and secteur_id = secteurs.id  and
            entreprises.id = responsables.entreprise_id and inviter_cfp_id = cfps.id
            and  demmande_etp_cfp.activiter = 0;


CREATE OR REPLACE VIEW v_demmande_cfp_pour_formateur AS SELECT
    demmande_cfp_formateur.id,
    demmandeur_cfp_id,
    inviter_formateur_id,
    formateurs.nom_formateur,
    formateurs.prenom_formateur,
    formateurs.mail_formateur,
    (formateurs.photos) photo_formateur,
    (formateurs.adresse) adresse_formateur,
    (formateurs.cin) cin_formateur,
    (formateurs.specialite) specialite_formateur,
    (formateurs.niveau) niveau_formateur,
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
            demmande_cfp_formateur,
            formateurs
        WHERE
            inviter_formateur_id = formateurs.id  and  demmande_cfp_formateur.activiter = 0;


CREATE OR REPLACE VIEW v_invitation_cfp_pour_formateur AS SELECT
    demmande_formateur_cfp.id,
    inviter_cfp_id,
    demmandeur_formateur_id,
    formateurs.nom_formateur,
    formateurs.prenom_formateur,
    formateurs.mail_formateur,
    (formateurs.photos) photo_formateur,
    (formateurs.adresse) adresse_formateur,
    (formateurs.cin) cin_formateur,
    (formateurs.specialite) specialite_formateur,
    (formateurs.niveau) niveau_formateur,
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
            demmande_formateur_cfp,
            formateurs
        WHERE
            demmandeur_formateur_id = formateurs.id and  demmande_formateur_cfp.activiter = 0;


CREATE OR REPLACE VIEW v_demmande_formateur_pour_cfp AS SELECT
    demmande_formateur_cfp.id,
    demmandeur_formateur_id,
    inviter_cfp_id,
    (cfps.nom) nom_cfp,
    (cfps.adresse_lot) adresse_lot_cfp,
    (cfps.adresse_ville) adresse_ville_cfp,
    (cfps.adresse_region) adresse_region_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.domaine_de_formation,
    (cfps.nif) nif_cfp,
    (cfps.stat) stat_cfp,
    (cfps.rcs) rcs_cfp,
    (cfps.cif) cif_cfp,
    (cfps.logo) logo_cfp,
    cfps.user_id,
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
            demmande_formateur_cfp,
            cfps
        WHERE
            inviter_cfp_id = cfps.id  and  demmande_formateur_cfp.activiter = 0;


CREATE OR REPLACE VIEW v_invitation_formateur_pour_cfp AS SELECT
    demmande_cfp_formateur.id,
    inviter_formateur_id,
    demmandeur_cfp_id,
    (cfps.nom) nom_cfp,
    (cfps.adresse_lot) adresse_lot_cfp,
    (cfps.adresse_ville) adresse_ville_cfp,
    (cfps.adresse_region) adresse_region_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.domaine_de_formation,
    (cfps.nif) nif_cfp,
    (cfps.stat) stat_cfp,
    (cfps.rcs) rcs_cfp,
    (cfps.cif) cif_cfp,
    (cfps.logo) logo_cfp,
    cfps.user_id,
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
            demmande_cfp_formateur,
            cfps
        WHERE
            demmandeur_cfp_id = cfps.id and  demmande_cfp_formateur.activiter = 0;




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
    cfps.domaine_de_formation,
    (cfps.nif) nif_cfp,
    (cfps.stat) stat_cfp,
    (cfps.rcs) rcs_cfp,
    (cfps.cif) cif_cfp,
    (cfps.logo) logo_cfp,
    cfps.user_id,
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
            demmande_etp_cfp,
            cfps
        WHERE
            inviter_cfp_id = cfps.id and  demmande_etp_cfp.activiter = 0;


CREATE OR REPLACE VIEW v_invitation_etp_pour_cfp AS SELECT
    demmande_cfp_etp.id,
    inviter_etp_id,
    demmandeur_cfp_id,
    (cfps.nom) nom_cfp,
    (cfps.adresse_lot) adresse_lot_cfp,
    (cfps.adresse_ville) adresse_ville_cfp,
    (cfps.adresse_region) adresse_region_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.domaine_de_formation,
    (cfps.nif) nif_cfp,
    (cfps.stat) stat_cfp,
    (cfps.rcs) rcs_cfp,
    (cfps.cif) cif_cfp,
    (cfps.logo) logo_cfp,
    cfps.user_id,
    (entreprises.adresse) adresse_etp,
    (entreprises.logo) logo_etp,
    (entreprises.nif) nif_etp,
    (entreprises.stat) nif_stat,
    (entreprises.rcs) nif_rcs,
    (entreprises.cif) cif_rcs,
    entreprises.telephone_etp,
    entreprises.email_etp,
    (
        DATEDIFF(
            demmande_cfp_etp.created_at,
            NOW())
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
            (
                demmande_cfp_etp.created_at
            ) date_demmande
        FROM
            demmande_cfp_etp,
            cfps,entreprises
        WHERE
            demmandeur_cfp_id = cfps.id and inviter_etp_id = entreprises.id and  demmande_cfp_etp.activiter = 0;


CREATE OR REPLACE VIEW v_demmande_formateur_cfp AS SELECT
    d.activiter AS activiter_demande,
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    c.email,
    c.telephone,
    c.domaine_de_formation,
    c.nif,
    c.stat,
    c.rcs,
    c.cif,
    c.logo,
    c.activiter AS activiter_cfp,
    c.site_cfp,
    c.user_id AS user_id_cfp,
    f.id AS formateur_id,
    f.nom_formateur,
    f.prenom_formateur,
    f.mail_formateur,
    f.numero_formateur,
    f.photos,
    f.genre,
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


CREATE OR REPLACE VIEW v_detailmodule AS SELECT
    d.id AS detail_id,
    d.lieu,
    d.h_debut,
    d.h_fin,
    d.date_detail,
    d.formateur_id,
    d.projet_id,
    d.groupe_id,
    d.cfp_id,
    g.max_participant,
    g.min_participant,
    g.nom_groupe,
    g.module_id,
    g.date_debut,
    g.date_fin,
    g.status,
    g.activiter,
    mf.reference,
    mf.nom_module,
    mf.formation_id,
    mf.nom_formation,
    f.nom_formateur,
    f.prenom_formateur,
    f.mail_formateur,
    f.numero_formateur,
    p.nom_projet,
    p.entreprise_id,
    (c.nom) nom_cfp
FROM
    details d
JOIN groupes g ON
    d.groupe_id = g.id
JOIN moduleformation mf ON
    mf.module_id = g.module_id
JOIN formateurs f ON
    f.id = d.formateur_id
JOIN projets p ON
    d.projet_id = p.id
JOIN cfps c ON
    p.cfp_id = c.id
GROUP BY
 d.id,
d.lieu,
d.h_debut,
d.h_fin,
d.date_detail,
d.formateur_id,
d.projet_id,
d.groupe_id,
d.cfp_id,
g.max_participant,
g.min_participant,
g.nom_groupe,
g.module_id,
g.date_debut,
g.date_fin,
g.status,
g.activiter,
mf.reference,
mf.nom_module,
mf.formation_id,
mf.nom_formation,
f.nom_formateur,
f.prenom_formateur,
f.mail_formateur,
f.numero_formateur,
p.nom_projet,
c.nom,
p.entreprise_id
;




CREATE OR REPLACE VIEW v_demmande_cfp_formateur AS SELECT
    d.activiter AS activiter_demande,
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    c.email,
    c.telephone,
    c.domaine_de_formation,
    c.nif,
    c.stat,
    c.rcs,
    c.cif,
    c.logo,
    c.activiter AS activiter_cfp,
    c.site_cfp,
    c.user_id AS user_id_cfp,
    f.id AS formateur_id,
    f.nom_formateur,
    f.prenom_formateur,
    f.mail_formateur,
    f.numero_formateur,
    f.photos,
    f.genre,
    f.date_naissance,
    f.adresse,
    f.cin,
    f.specialite,
    f.niveau,
    f.activiter AS activiter_formateur,
    f.user_id AS user_id_formateur
FROM
    demmande_cfp_formateur d
JOIN cfps c ON
    c.id = d.demmandeur_cfp_id
JOIN formateurs f ON
    f.id = d.inviter_formateur_id
WHERE
    d.activiter = 1;





CREATE OR REPLACE VIEW v_participant_groupe AS SELECT
    dm.*,
    pg.stagiaire_id,
    s.matricule,
    s.nom_stagiaire,
    s.prenom_stagiaire,
    s.genre_stagiaire,
    s.fonction_stagiaire,
    s.mail_stagiaire,
    s.telephone_stagiaire,
    s.user_id AS user_id_stagiaire,
    s.photos,
    s.departement_id,
    s.cin,
    s.date_naissance,
    s.adresse,
    s.niveau_etude,
    s.activiter AS activiter_stagiaire,
    s.lieu_travail
FROM
    participant_groupe pg
JOIN v_detailmodule dm ON
    pg.groupe_id = dm.groupe_id
JOIN stagiaires s ON
    s.id = pg.stagiaire_id;


CREATE OR REPLACE VIEW v_presence_detail AS SELECT
    p.status,
    p.detail_id,
    p.stagiaire_id,
    s.matricule,
    s.nom_stagiaire,
    s.prenom_stagiaire,
    s.genre_stagiaire,
    s.fonction_stagiaire,
    s.mail_stagiaire,
    s.telephone_stagiaire,
    s.user_id AS user_id_stagiaire,
    s.photos,
    s.departement_id,
    s.cin,
    s.date_naissance,
    s.adresse AS adresse_stg,
    s.niveau_etude,
    s.activiter AS activiter_stagiaire,
    s.lieu_travail
FROM
    presences p
JOIN stagiaires s ON
    p.stagiaire_id = s.id;



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
