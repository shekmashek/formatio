CREATE TABLE `type_facture` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into type_facture(description,reference,created_at,updated_at) values
("Facture Définitive","Facture",NOW(),NOW()),
("Facture d'Avoir","Avoir",NOW(),NOW()),
("Facture d'Acompte","Acompte",NOW(),NOW());


CREATE TABLE `frais_annexes` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into frais_annexes(description) values
('frais de deplacement'),
("frais d'hebergement"),
('frais de restauration'),
('frais de logistique'),
('frais de location de salle');


CREATE TABLE `factures` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `bon_de_commande` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_bc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#----',
  `devise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` bigint(20) UNSIGNED DEFAULT NULL REFERENCES projets(id) ON DELETE CASCADE,
  `groupe_id` bigint(20) UNSIGNED NOT NULL REFERENCES groupes(id) ON DELETE CASCADE,
  `type_financement_id` bigint(20) UNSIGNED NOT NULL REFERENCES mode_financements(id) ON DELETE CASCADE,
  `type_payement_id` bigint(20) UNSIGNED DEFAULT NULL REFERENCES type_payement(id) ON DELETE CASCADE,
  `type_facture_id` bigint(20) UNSIGNED NOT NULL REFERENCES type_facture(id) ON DELETE CASCADE,
  `tax_id` bigint(20) UNSIGNED NOT NULL REFERENCES taxes(id) ON DELETE CASCADE,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pu` int(11) NOT NULL DEFAULT 1,
  `qte` int(11) NOT NULL DEFAULT 1,
  `hors_taxe` decimal(15,2) DEFAULT 0.00 CHECK (`hors_taxe` >= 0),
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `num_facture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#0000',
  `activiter` boolean not null default false,
  `remise` int(11) DEFAULT 0,
  `other_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cfp_id` bigint(20) NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `encaissements` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `montant_facture` decimal(15,2) DEFAULT 0.00,
  `libelle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payement` decimal(15,2) DEFAULT 0.00,
  `montant_ouvert` decimal(15,2) DEFAULT NULL,
  `date_encaissement` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `num_facture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cfp_id` bigint(20) NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
  `mode_financement_id` bigint(20) UNSIGNED NOT NULL REFERENCES mode_financements(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `montant_frais_annexes` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `frais_annexe_id` bigint(20) UNSIGNED NOT NULL REFERENCES frais_annexes(id) ON DELETE CASCADE,
  `num_facture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#0000FCT',
  `montant` decimal(15,2) DEFAULT 0.00 CHECK (`montant` >= 0),
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_frais_annexe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `hors_taxe` decimal(15,2) DEFAULT 0.00 CHECK (`hors_taxe` >= 0),
  `qte` int(11) NOT NULL DEFAULT 1,
  `pu` int(11) NOT NULL DEFAULT 1,
  `projet_id` bigint(20) UNSIGNED DEFAULT NULL REFERENCES projets(id) ON DELETE CASCADE,
  `cfp_id` bigint(20) NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
