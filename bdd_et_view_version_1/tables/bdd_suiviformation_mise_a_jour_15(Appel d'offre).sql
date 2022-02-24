create table appel_offres(
    id bigint(20) unsigned primary key not null auto_increment,
    tdr_url text COLLATE utf8mb4_unicode_ci not null,
    reference_soumission text COLLATE utf8mb4_unicode_ci not null,
    dossier_fournir text COLLATE utf8mb4_unicode_ci not null,
    date_fin date not null,
    hr_fin time not null,
    prestation_demande text COLLATE utf8mb4_unicode_ci not null,
    contexte_prestation text COLLATE utf8mb4_unicode_ci not null,
    information_generale text COLLATE utf8mb4_unicode_ci not null,
    exigence_soumission text COLLATE utf8mb4_unicode_ci not null,
    publier boolean not null default false,
    entreprise_id bigint(20) unsigned not null  references entreprises(id) on delete cascade,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
