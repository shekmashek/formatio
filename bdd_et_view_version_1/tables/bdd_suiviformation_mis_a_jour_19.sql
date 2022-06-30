CREATE TABLE `besoin_stagiaire` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` int(11) NOT NULL,
  `entreprise_id` int(11) NOT NULL,
  `domaines_id` int(11) NOT NULL,
  `thematique_id` int(11) NOT NULL,
  `anneePlan_id` int(11) NOT NULL,
  `objectif` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_previsionnelle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisme` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `plan_formation_valide` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `AnneePlan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut_rec` date NOT NULL,
  `fin_rec` date NOT NULL,
  `entreprise_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
