
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
    foreign key(cfp_id) references cfps(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE OR REPLACE VIEW entreprise_iframe as SELECT
    e.id as entreprise_id,
    e.nom_etp,
    i.iframe
FROM iframe_entreprise i
RIGHT JOIN entreprises e ON e.id = i.entreprise_id;

CREATE OR REPLACE VIEW cfp_iframe as SELECT
    c.id as cfp_id,
    c.nom,
    i.iframe
FROM iframe_cfp i
RIGHT JOIN cfps c ON c.id = i.cfp_id;