CREATE TABLE `type_facture` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into type_facture(description,reference,created_at,updated_at) values
("Facture Définitive","Facture",NOW(),NOW()),
("Facture d'Avoir","Avoir",NOW(),NOW()),
("Facture d'Acompte","Acompte",NOW(),NOW());

CREATE TABLE `type_remise` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into type_remise(id,description,reference)
values(1,"MGA","AR"),(2,"%","POURCENT");

CREATE TABLE `frais_annexes` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

alter table frais_annexes add column entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE;


CREATE TABLE `factures` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `bon_de_commande` varchar(255) COLLATE utf8mb4_unicode_ci,
  `reference_bc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '####',
  `devise` varchar(255) COLLATE utf8mb4_unicode_ci,
  `projet_id` bigint(20) UNSIGNED DEFAULT NULL REFERENCES projets(id) ON DELETE CASCADE,
  `groupe_entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES groupe_entreprises(id) ON DELETE CASCADE,
  `type_financement_id` bigint(20) UNSIGNED NOT NULL REFERENCES mode_financements(id) ON DELETE CASCADE,
  `type_facture_id` bigint(20) UNSIGNED NOT NULL REFERENCES type_facture(id) ON DELETE CASCADE,
  `tax_id` bigint(20) UNSIGNED NOT NULL REFERENCES taxes(id) ON DELETE CASCADE,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT 'aucun description',
  `pu` int(11) NOT NULL DEFAULT 0,
  `qte` int(11) NOT NULL DEFAULT 0,
  `hors_taxe` decimal(15,2) DEFAULT 0.00 CHECK (`hors_taxe` >= 0),
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `num_facture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#0000',
  `activiter` boolean not null default false,
  `remise` int(11) DEFAULT 0,
  `remise_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1 REFERENCES type_remise(id) ON DELETE CASCADE,
  `other_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cfp_id` bigint(20) NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprise_id(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `encaissements` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `montant_facture` decimal(15,2) DEFAULT 0.00,
  `libelle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payement` decimal(15,2) DEFAULT 0.00,
  `montant_ouvert` decimal(15,2) DEFAULT 0,
  `date_encaissement` DATE NOT NULL DEFAULT NOW(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `num_facture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cfp_id` bigint(20) NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `resp_cfp_id` bigint(20) NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  `nom_resp_cfp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `qte` int(11) NOT NULL DEFAULT 0,
  `pu` int(11) NOT NULL DEFAULT 0,
  `projet_id` bigint(20) UNSIGNED DEFAULT NULL REFERENCES projets(id) ON DELETE CASCADE,
  `entreprise_id` bigint(20) NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `cfp_id` bigint(20) NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
