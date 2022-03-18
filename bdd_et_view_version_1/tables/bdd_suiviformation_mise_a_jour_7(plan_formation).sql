CREATE TABLE `annee_plans` (
  `id` bigint(20) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `entreprise_id` bigint(20) NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `etat` varchar(255) NOT NULL,
  `annee` year(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `recueil_informations` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `duree_formation` bigint(20) UNSIGNED,
  `mois_previsionnelle` bigint(20) UNSIGNED,
  `annee_previsionnelle` bigint(20) UNSIGNED,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_demande` date NOT NULL,
  `formation_id` bigint(20) UNSIGNED NOT NULL REFERENCES formations(id) ON DELETE CASCADE,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL REFERENCES stagiaires(id) ON DELETE CASCADE,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `annee_plan_id` bigint(20) NOT NULL REFERENCES annee_plans(id) ON DELETE CASCADE,
  `typologie_formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectif_attendu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `plan_formations` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `cout_previsionnel`  decimal(15,2) DEFAULT 0.00,
  `mode_financement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recueil_information_id` bigint(20) UNSIGNED NOT NULL REFERENCES receuil_informations(id) ON DELETE CASCADE,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `annee_plan_id` bigint(20) NOT NULL REFERENCES annee_plans(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `budgetisation` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `departement_entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES departement_entreprises(id) ON DELETE CASCADE,
  `budget_total`  decimal(15,2) DEFAULT 0.00,
  `date_creation` date NOT NULL,
   `annee` year NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



