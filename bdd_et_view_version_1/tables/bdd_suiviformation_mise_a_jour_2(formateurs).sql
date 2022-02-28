CREATE TABLE `formateurs` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_formateur` varchar(191) COLLATE utf8mb4_unicode_ci,
  `mail_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT '0000-00-00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00',
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activiter` boolean not null default true,
  `user_id` bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `competence_formateurs` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `competence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formateur_id` bigint(20) UNSIGNED NOT NULL REFERENCES formateurs(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT '0000-00-00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00',
  `domaine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `experience_formateurs` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_entreprise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poste_occuper` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut_travail` date NOT NULL,
  `fin_travail` date default '0000-00-00',
  `taches` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formateur_id` bigint(20) UNSIGNED NOT NULL REFERENCES formateurs(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT '0000-00-00',
  `updated_at` timestamp NULL DEFAULT '0000-00-00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
