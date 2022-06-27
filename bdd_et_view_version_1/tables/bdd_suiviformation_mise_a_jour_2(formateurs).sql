CREATE TABLE `formateurs` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_formateur` varchar(191) COLLATE utf8mb4_unicode_ci,
  `mail_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  genre_id bigint(20) unsigned REFERENCES genre(id),
  `date_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text not null default "",
  `niveau_etude_id` bigint(20) UNSIGNED  DEFAULT 1 REFERENCES niveau_etude(id) ON DELETE CASCADE ,
  `activiter` boolean not null default true,
  `user_id` bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


alter table formateurs
Modify column  `prenom_formateur` varchar(191) COLLATE utf8mb4_unicode_ci not null,
Modify column  `mail_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
Modify column  `numero_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NULL,
Modify column  `photos` varchar(191) COLLATE utf8mb4_unicode_ci NULL,
Modify column `created_at` timestamp NULL DEFAULT current_timestamp(),
Modify column  `updated_at` timestamp NULL DEFAULT current_timestamp(),
Modify column  genre_id bigint(20) unsigned,
Modify column  `date_naissance` varchar(255) COLLATE utf8mb4_unicode_ci  NULL,
Modify column  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci  NULL,
Modify column  `cin` varchar(255) COLLATE utf8mb4_unicode_ci  NULL,
Modify column  `specialite` varchar(255) COLLATE utf8mb4_unicode_ci  NULL,
Modify column  `niveau_etude_id` varchar(255) COLLATE utf8mb4_unicode_ci  NULL,
Modify column `activiter` boolean  null default true;

CREATE TABLE `competence_formateurs` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `competence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formateur_id` bigint(20) UNSIGNED NOT NULL REFERENCES formateurs(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `domaine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `experience_formateurs` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_entreprise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poste_occuper` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut_travail` date NOT NULL,
  `fin_travail` date default current_timestamp(),
  `taches` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formateur_id` bigint(20) UNSIGNED NOT NULL REFERENCES formateurs(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


