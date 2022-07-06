
CREATE TABLE valeur_TVA
(
 `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `tva` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE devises
(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    description varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    reference varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into devises values
(1,"Ariary","AR"),
(2,"Euro","€"),
(3,"Dollar","$");

CREATE TABLE taux_devises
(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    devise_id bigint(20)  UNSIGNED NOT NULL  REFERENCES devises(id) ON DELETE CASCADE,
    valeur_default int NOT NULL default 1,
    valeur_ariary int not null default 1,
    created_at date NOT NULL,
    updated_at date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


insert into taux_devises(devise_id,valeur_default,valeur_ariary,created_at,updated_at ) values
(1,1,1,NOW(),NOW()),
(2,1,4200,"2022-01-01",NOW()),
(3,1,4500,"2022-01-01",NOW()),
(2,1,4200,NOW(),NOW()),
(3,1,4500,NOW(),NOW());



CREATE OR REPLACE VIEW v_devise AS SELECT
   (taux_devises.id) taux_devise_id,
    taux_devises.devise_id,
    valeur_default,
    description,
    reference,
    valeur_ariary,
    created_at,
    updated_at
FROM
    devises,
    taux_devises
WHERE
    devises.id = taux_devises.devise_id;

CREATE OR REPLACE VIEW v_dernier_devise AS SELECT
    devise_id,
    valeur_default,
    description,
    reference,
    valeur_ariary,
    MAX(created_at),
    updated_at
FROM
    v_devise
GROUP BY
    devise_id,
    valeur_default,
    description,
    reference,
    valeur_ariary,
    updated_at;
/*
    //table chef departement */

ALTER TABLE chef_departements
  add column `updated_at` timestamp NULL DEFAULT current_timestamp();
  ALTER TABLE chef_departements
 add column  genre_id bigint(20) unsigned


 CREATE TABLE `demande_devis`(
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  `etp_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `resp_etp_id` bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  `cfp_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `module_id` bigint(20) UNSIGNED NOT NULL REFERENCES modules(id) ON DELETE CASCADE,
  `vue` boolean not null default false,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




