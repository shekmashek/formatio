create table iframe_entreprise(
    id bigint(20) unsigned primary key not null auto_increment,
    entreprise_id bigint(20) unsigned not null,
    iframe TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT current_timestamp(),
    foreign key(entreprise_id) references entreprises(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table iframe_cfp(
    id bigint(20) unsigned primary key not null auto_increment,
    cfp_id bigint(20) unsigned not null,
    iframe TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT current_timestamp(),
    foreign key(cfp_id) references entreprises(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table iframe_invite(
    id bigint(20) unsigned primary key not null auto_increment,
    iframe TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
