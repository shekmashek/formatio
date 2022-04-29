
CREATE TABLE valeur_TVA
(
 `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
 `tva` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE devise
(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    devise varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
    reference varchar(255) COLLATE utf8mb4_unicode_ci  NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into devise values
(1,"Ariary","AR");


