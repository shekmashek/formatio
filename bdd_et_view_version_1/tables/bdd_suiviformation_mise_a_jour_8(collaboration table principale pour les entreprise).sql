-- Active: 1656573946460@@127.0.0.1@3306@mahafaly

create table demmande_cfp_etp(
    id bigint(20) unsigned primary key not null auto_increment,
    demmandeur_cfp_id bigint(20) unsigned not null,
    inviter_etp_id bigint(20) unsigned not null,
    resp_cfp_id bigint(20) unsigned not null references employers(id) on delete cascade,
    resp_etp_id bigint(20) unsigned,
    activiter boolean not null default false,
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT current_timestamp(),
    foreign key(demmandeur_cfp_id) references entreprises(id) on delete cascade,
    foreign key(inviter_etp_id) references entreprises(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



create table demmande_etp_cfp(
    id bigint(20) unsigned primary key not null auto_increment,
    demmandeur_etp_id bigint(20) unsigned not null,
    inviter_cfp_id bigint(20) unsigned not null,
    activiter boolean not null default false,
    resp_etp_id bigint(20) unsigned not null references responsables(id) on delete cascade,
    resp_cfp_id bigint(20) unsigned,
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT current_timestamp(),
    foreign key(inviter_cfp_id) references entreprises(id) on delete cascade,
    foreign key(demmandeur_etp_id) references entreprises(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table demmande_cfp_formateur(
    id bigint(20) unsigned primary key not null auto_increment,
    demmandeur_cfp_id bigint(20) unsigned not null,
    inviter_formateur_id bigint(20) unsigned not null,
    resp_cfp_id bigint(20) unsigned not null references employers(id) on delete cascade,
    activiter boolean not null default false,
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT current_timestamp(),
    foreign key(inviter_formateur_id) references formateurs(id) on delete cascade,
    foreign key(demmandeur_cfp_id) references entreprises(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table demmande_formateur_cfp(
    id bigint(20) unsigned primary key not null auto_increment,
    demmandeur_formateur_id bigint(20) unsigned not null,
    inviter_cfp_id bigint(20) unsigned not null,
    resp_cfp_id bigint(20) unsigned not null references employers(id) on delete cascade,
    activiter boolean not null default false,
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT current_timestamp(),
    foreign key(demmandeur_formateur_id) references formateurs(id) on delete cascade,
    foreign key(inviter_cfp_id) references entreprises(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table refuse_demmande_cfp_etp(
    id bigint(20) unsigned primary key not null auto_increment,
    demmandeur_cfp_id bigint(20) unsigned not null,
    inviter_etp_id bigint(20) unsigned not null,
    resp_etp_id bigint(20) unsigned not null references responsables(id) on delete cascade,
    resp_cfp_id bigint(20) unsigned not null references employers(id) on delete cascade,
    activiter boolean not null default false,
    created_at timestamp NULL DEFAULT current_timestamp(),
    foreign key(demmandeur_cfp_id) references entreprises(id) on delete cascade,
    foreign key(inviter_etp_id) references entreprises(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table refuse_demmande_etp_cfp(
    id bigint(20) unsigned primary key not null auto_increment,
    demmandeur_etp_id bigint(20) unsigned not null,
    inviter_cfp_id bigint(20) unsigned not null,
    resp_etp_id bigint(20) unsigned not null references responsables(id) on delete cascade,
    resp_cfp_id bigint(20) unsigned not null references employers(id) on delete cascade,
    activiter boolean not null default false,
    created_at timestamp NULL DEFAULT current_timestamp(),
    foreign key(inviter_cfp_id) references entreprises(id) on delete cascade,
    foreign key(demmandeur_etp_id) references entreprises(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS collaboration_etp_cfp;
CREATE table collaboration_etp_cfp (
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `etp_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
    `cfp_id` bigint(20) UNSIGNED NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
    `statut` int(11) NOT NULL DEFAULT 0,
    `demmandeur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    `created_at` timestamp default current_timestamp(),
    `updated_at` timestamp default current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
