create table appel_offres(
    id bigint(20) unsigned primary key not null auto_increment,
    tdr_url text COLLATE utf8mb4_unicode_ci not null,
    reference_soumission text COLLATE utf8mb4_unicode_ci not null,
    description_court text COLLATE utf8mb4_unicode_ci not null,
    description text COLLATE utf8mb4_unicode_ci not null,
    date_fin date not null,
    hr_fin time not null,
    entreprise_id bigint(20) unsigned not null  references entreprises(id) on delete cascade,
    formation_id bigint(20) unsigned not null  references formations(id) on delete cascade,
    created_at timestamp NOT NULL,
    updated_at timestamp NULL DEFAULT current_timestamp(),
    publier boolean not null default false
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create or replace view v_appel_offre as
SELECT
    appel_offres.*,
    formations.nom_formation,
    formations.domaine_id,
    domaines.nom_domaine,
    DATE_FORMAT(date_fin, "%d %M  %Y") date_name,
    entreprises.nom_etp,
    entreprises.telephone_etp,
    entreprises.logo,
    entreprises.site_etp,
    entreprises.email_etp,
    entreprises.secteur_id,
    secteurs.nom_secteur
FROM
    appel_offres,
    entreprises,
    secteurs,
    formations,domaines
WHERE
    appel_offres.entreprise_id = entreprises.id AND entreprises.secteur_id = secteurs.id and appel_offres.formation_id = formations.id and formations.domaine_id = domaines.id;