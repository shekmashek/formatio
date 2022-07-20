CREATE TABLE `plan_formation_valide` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `AnneePlan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut_rec` date NOT NULL,
  `fin_rec` date NOT NULL,
  `entreprise_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cloture` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
ALTER TABLE `plan_formation_valide`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `plan_formation_valide`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

CREATE TABLE `besoin_stagiaire` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` int(11) NOT NULL,
  `entreprise_id` int(11) NOT NULL,
  `domaines_id` int(11) NOT NULL,
  `thematique_id` int(11) NOT NULL,
  `anneePlan_id` int(11) NOT NULL,
  `objectif` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_previsionnelle` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organisme` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `statut` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `arbitrage` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `reponse_stagiaire` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cout` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `dure` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_demande` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `priorite` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `besoin_stagiaire`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `besoin_stagiaire`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;


CREATE TABLE `arbitrage` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `departement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thematique` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cout` int(191) DEFAULT 300000,
  `stagiaire_id` int(11) DEFAULT NULL,
  `Plan_id` int(11) DEFAULT NULL,
  `besoin_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `departement_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `thematique_id` int(11) DEFAULT NULL,
  `budget` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `arbitrage`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `arbitrage`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=384;

CREATE TABLE `budget_plan` (
  `id` bigint(20) NOT NULL,
  `departement_id` int(11) DEFAULT NULL,
  `thematique_id` int(11) DEFAULT NULL,
  `plan_id` int(11) DEFAULT NULL,
  `budget` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE `budget_plan`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `budget_plan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;