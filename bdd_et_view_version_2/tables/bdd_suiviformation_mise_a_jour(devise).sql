
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

ALTER TABLE chef_departements
  add column `updated_at` timestamp NULL DEFAULT current_timestamp();
  ALTER TABLE chef_departements
 add column  genre_id bigint(20) unsigned