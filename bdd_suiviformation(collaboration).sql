create table demmande_cfp_etp(
    id bigint(20) unsigned primary key not null auto_increment,
    demmandeur_cfp_id bigint(20) unsigned not null,
    inviter_etp_id bigint(20) unsigned not null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(demmandeur_cfp_id) references cfps(id) on delete cascade,
    foreign key(inviter_etp_id) references entreprises(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table demmande_etp_cfp(
    id bigint(20) unsigned primary key not null auto_increment,
    demmandeur_etp_id bigint(20) unsigned not null,
    inviter_cfp_id bigint(20) unsigned not null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(inviter_cfp_id) references cfps(id) on delete cascade,
    foreign key(demmandeur_etp_id) references entreprises(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table demmande_cfp_formateur(
    id bigint(20) unsigned primary key not null auto_increment,
    demmandeur_cfp_id bigint(20) unsigned not null,
    inviter_formateur_id bigint(20) unsigned not null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(inviter_formateur_id) references formateurs(id) on delete cascade,
    foreign key(demmandeur_cfp_id) references cfps(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table demmande_formateur_cfp(
    id bigint(20) unsigned primary key not null auto_increment,
    demmandeur_formateur_id bigint(20) unsigned not null,
    inviter_cfp_id bigint(20) unsigned not null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(demmandeur_formateur_id) references formateurs(id) on delete cascade,
    foreign key(inviter_cfp_id) references cfps(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- ======================== demmande et invitation de CFP pour etp et pour formateur ====================================
CREATE OR REPLACE VIEW v_demmande_cfp_pour_etp AS SELECT
    demmande_cfp_etp.id,
    demmandeur_cfp_id,
    inviter_etp_id,
    entreprises.nom_etp,
    (entreprises.adresse) adresse_etp,
    (entreprises.logo) logo_etp,
    (entreprises.secteur_activite) secteur_activite,
    email_etp,
    telephone_etp,
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
            demmande_cfp_etp,
            entreprises
        WHERE
            inviter_etp_id = entreprises.id;



CREATE OR REPLACE VIEW v_invitation_cfp_pour_etp AS SELECT
    demmande_etp_cfp.id,
    inviter_cfp_id,
    demmandeur_etp_id,
    entreprises.nom_etp,
    (entreprises.adresse) adresse_etp,
    (entreprises.logo) logo_etp,
    (entreprises.secteur_activite) secteur_activite,
    entreprises.NIF,
    entreprises.STAT,
    entreprises.RCS,
    entreprises.CIF,
    entreprises.email_etp,
    entreprises.site_etp,
    entreprises.telephone_etp,
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
            demmande_etp_cfp,
            entreprises
        WHERE
            demmandeur_etp_id = entreprises.id;


CREATE OR REPLACE VIEW v_demmande_cfp_pour_formateur AS SELECT
    demmande_cfp_formateur.id,
    demmandeur_cfp_id,
    inviter_formateur_id,
    formateurs.nom_formateur,
    formateurs.prenom_formateur,
    formateurs.mail_formateur,
    (formateurs.photos) photo_formateur,
    (formateurs.adresse) adresse_formateur,
    (formateurs.CIN) cin_formateur,
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
            inviter_formateur_id = formateurs.id;


CREATE OR REPLACE VIEW v_invitation_cfp_pour_formateur AS SELECT
    demmande_formateur_cfp.id,
    inviter_cfp_id,
    demmandeur_formateur_id,
    formateurs.nom_formateur,
    formateurs.prenom_formateur,
    formateurs.mail_formateur,
    (formateurs.photos) photo_formateur,
    (formateurs.adresse) adresse_formateur,
    (formateurs.CIN) cin_formateur,
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
            demmandeur_formateur_id = formateurs.id;

-- ================================= demmande et invitation de Formateur pour CFP ====================================

CREATE OR REPLACE VIEW v_demmande_formateur_pour_cfp AS SELECT
    demmande_formateur_cfp.id,
    demmandeur_formateur_id,
    inviter_cfp_id,
    (cfps.nom) nom_cfp,
    (cfps.adresse) adresse_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.domaine_de_formation,
    (cfps.NIF) NIF_cfp,
    (cfps.STAT) STAT_cfp,
    (cfps.RCS) RCS_cfp,
    (cfps.CIF) CIF_cfp,
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
            inviter_cfp_id = cfps.id;


CREATE OR REPLACE VIEW v_invitation_formateur_pour_cfp AS SELECT
    demmande_cfp_formateur.id,
    inviter_formateur_id,
    demmandeur_cfp_id,
    (cfps.nom) nom_cfp,
    (cfps.adresse) adresse_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.domaine_de_formation,
    (cfps.NIF) NIF_cfp,
    (cfps.STAT) STAT_cfp,
    (cfps.RCS) RCS_cfp,
    (cfps.CIF) CIF_cfp,
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
            demmandeur_cfp_id = cfps.id;


--=====================================  demmande et invitation de Entreprise pour CFP =====================================


CREATE OR REPLACE VIEW v_demmande_etp_pour_cfp AS SELECT
    demmande_etp_cfp.id,
    demmandeur_etp_id,
    inviter_cfp_id,
    (cfps.nom) nom_cfp,
    (cfps.adresse) adresse_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.domaine_de_formation,
    (cfps.NIF) NIF_cfp,
    (cfps.STAT) STAT_cfp,
    (cfps.RCS) RCS_cfp,
    (cfps.CIF) CIF_cfp,
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
            inviter_cfp_id = cfps.id;


CREATE OR REPLACE VIEW v_invitation_etp_pour_cfp AS SELECT
    demmande_cfp_etp.id,
    inviter_etp_id,
    demmandeur_cfp_id,
    (cfps.nom) nom_cfp,
    (cfps.adresse) adresse_cfp,
    (cfps.email) mail_cfp,
    (cfps.telephone) tel_cfp,
    cfps.domaine_de_formation,
    (cfps.NIF) NIF_cfp,
    (cfps.STAT) STAT_cfp,
    (cfps.RCS) RCS_cfp,
    (cfps.CIF) CIF_cfp,
    (cfps.logo) logo_cfp,
    cfps.user_id,
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
            cfps
        WHERE
            demmandeur_cfp_id = cfps.id;

