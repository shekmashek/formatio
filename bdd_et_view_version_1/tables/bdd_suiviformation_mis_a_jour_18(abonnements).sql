
--abonnement pour entreprise
CREATE TABLE `type_abonnements_etp` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif`  decimal(15,2),
  `nb_utilisateur` int(5) NOT NULL,
  `nb_formateur` int(5) NOT NULL,
  `nb_projet` int(5) NOT NULL,
  `illimite`  boolean not null default false,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--abonnement pour of
CREATE TABLE `type_abonnements_of` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  `tarif`  decimal(15,2),
  `nb_utilisateur` int(5) NOT NULL,
  `nb_formateur` int(5) NOT NULL,
  `min_emp` int(5) NOT NULL,
  `max_emp` int(5) NOT NULL,
  `illimite`  boolean not null default false,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `factures_abonnements` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `abonnement_id` bigint(20) UNSIGNED NOT NULL REFERENCES abonnements(id) ON DELETE CASCADE,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `num_facture` bigint(20) NOT NULL,
  `statut` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Non payé',
   `montant_facture` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `factures_abonnements_cfp` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `abonnement_cfps_id` bigint(20) UNSIGNED NOT NULL REFERENCES abonnements(id) ON DELETE CASCADE,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `num_facture` bigint(20) NOT NULL,
  `statut` varchar(55) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Non payé',
   `montant_facture` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `encaissements_abonnements` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date_encaissement` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `factures_abonnements_id` bigint(20) NOT NULL REFERENCES factures_abonnements(id) ON DELETE CASCADE,
  `type_paiement_id` bigint(20) NOT NULL REFERENCES type_payement(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `encaissements_abonnements_cfps` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date_encaissement` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `factures_abonnements_cfp_id` bigint(20) NOT NULL REFERENCES factures_abonnements_cfp(id) ON DELETE CASCADE,
  `type_paiement_id` bigint(20) NOT NULL REFERENCES type_payement(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


--Add column : entreprises / OF and create table assujetti
CREATE TABLE `assujetti` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `assujetti` boolean not null default false,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `assujetti` (`assujetti`) VALUES
(1),
(0);

ALTER TABLE entreprises
    add column assujetti_id bigint(20) unsigned,
    ADD CONSTRAINT FOREIGN KEY(assujetti_id) REFERENCES assujetti(id);

ALTER TABLE cfps
    add column assujetti_id bigint(20) unsigned,
    ADD CONSTRAINT FOREIGN KEY(assujetti_id) REFERENCES assujetti(id);

ALTER TABLE abonnement_cfps
    add column activite boolean not null default true;

ALTER TABLE abonnements
    add column activite boolean not null default true;

ALTER TABLE abonnements
  add column type_arret varchar(50) COLLATE utf8mb4_unicode_ci;

ALTER TABLE abonnement_cfps
  add column type_arret varchar(50) COLLATE utf8mb4_unicode_ci;
