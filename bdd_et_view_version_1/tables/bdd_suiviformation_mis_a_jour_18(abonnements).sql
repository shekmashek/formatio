

DROP TABLE IF EXISTS tarif_categories;
DROP TABLE IF EXISTS type_abonnements;
DROP TABLE IF EXISTS type_abonnement_roles;
DROP TABLE IF EXISTS type_abonnes;
DROP TABLE IF EXISTS abonnements;
DROP TABLE  IF EXISTS abonnement_cfps;
DROP TABLE IF EXISTS factures_abonnements;
DROP TABLE IF EXISTS factures_abonnements_cfp;
DROP TABLE IF EXISTS type_abonnements_of;
DROP TABLE IF EXISTS type_abonnements_etp;
DROP TABLE IF EXISTS encaissements_abonnements;
DROP TABLE IF EXISTS encaissements_abonnements_cfps;

CREATE TABLE `type_abonnements_of` (
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


CREATE TABLE `type_abonnements_etp` (
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

CREATE TABLE `abonnements` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date_demande` date default current_timestamp(),
  `date_debut` date DEFAULT current_timestamp(),
  `date_fin` date DEFAULT current_timestamp(),
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_abonnement_id` bigint(20) UNSIGNED NOT NULL  REFERENCES type_abonnements_etp(id) ON DELETE CASCADE,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL  REFERENCES entreprises(id) ON DELETE CASCADE,
  `type_arret` varchar(50) COLLATE utf8mb4_unicode_ci,
  `activite` boolean not null default true,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `abonnement_cfps` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date_demande` date DEFAULT current_timestamp(),
  `date_debut` date DEFAULT current_timestamp(),
  `date_fin` date DEFAULT current_timestamp(),
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_abonnement_id` bigint(20) UNSIGNED NOT NULL REFERENCES type_abonnements_of(id) ON DELETE CASCADE,
  `cfp_id` bigint(20) UNSIGNED NOT NULL  REFERENCES cfps(id) ON DELETE CASCADE,
  `type_arret` varchar(50) COLLATE utf8mb4_unicode_ci,
  `activite` boolean not null default true,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
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
  `abonnement_cfps_id` bigint(20) UNSIGNED NOT NULL REFERENCES abonnement_cfps(id) ON DELETE CASCADE,
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


INSERT INTO `type_abonnements_of` (`id`, `nom_type`, `description`, `tarif`, `nb_utilisateur`, `nb_formateur`, `nb_projet`, `illimite`, `created_at`, `updated_at`) VALUES

(1, 'Invité', 'Vous avez accès aux projets de l\'entreprise qui vous a invité mais par contre vous ne pouvez pas envoyer une demande de collaboration', '0.00', 0, 0, 0, 1, '2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(2, 'INDEP', 'Une offre unique dédiée aux formateurs indépendants', '100000.00', 1, 1, 50, 0, '2022-05-10 07:11:13', '2022-05-10 07:11:13'),
(3, 'EQUIPE', 'La seule plateforme tout intégrée pour les petites équipes de formation', '200000.00', 2, 4, 200, 0, '2022-05-10 07:12:47', '2022-05-10 07:12:47'),
(4, 'ORGA', 'La plateforme pour les organismes à la pointe de la transformation digitale', '300000.00', 3, 10, 1000, 0, '2022-05-10 07:13:55', '2022-05-10 07:13:55'),
(5, 'ORGA +', 'Gestion administrative illimitée pour les organismes', '400000.00', 0, 0, 0, 1, '2022-05-10 07:15:07', '2022-05-10 07:15:07');

INSERT INTO `type_abonnements_etp` (`id`, `nom_type`, `description`, `tarif`, `nb_utilisateur`, `nb_formateur`, `min_emp`, `max_emp`, `illimite`, `created_at`, `updated_at`) VALUES
(1, 'Invité', 'Vous avez accès aux projets de l\'entreprise qui vous a invité mais par contre vous ne pouvez pas envoyer une demande de collaboration', '0.00', 0, 0, 0, 0,1, '2022-05-17 11:56:28', '2022-05-17 11:56:28'),
(2, 'TPE', 'Une offre unique dédiée aux Très Petite Entreprise', '100000.00', 1, 1, 1, 9, 0, '2022-05-10 07:16:26', '2022-05-10 07:16:26'),
(3, 'PME', 'Offre spéciale pour les Petites et Moyennes Entreprise', '200000.00', 2, 2, 10, 49, 0, '2022-05-10 07:17:28', '2022-05-10 07:17:28'),
(4, 'EI', 'La seule plateforme tout integrée pour les Entreprise Intermediaire', '300000.00', 3, 4, 50, 249, 0, '2022-05-10 07:18:46', '2022-05-10 07:18:46'),
(5, 'GE', 'La plateforme pour les Grandes Entreprises à la pointe de la transformation digitale', '400000.00', 0, 0, 0, 0, 1, '2022-05-10 07:27:16', '2022-05-10 07:27:16');




CREATE TABLE `statut_compte` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_statut` varchar(55) COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `statut_compte` (`id`, `nom_statut`) VALUES
(1, 'Invité'),
(2, 'Premium'),
(3, 'Pending');

ALTER TABLE entreprises
  add column statut_compte_id bigint(20) unsigned NOT NULL DEFAULT 1,
  ADD CONSTRAINT FOREIGN KEY(statut_compte_id) REFERENCES statut_compte(id);

ALTER TABLE cfps
  add column statut_compte_id bigint(20) unsigned NOT NULL DEFAULT 1,
  ADD CONSTRAINT FOREIGN KEY(statut_compte_id) REFERENCES statut_compte(id);



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
    add column assujetti_id bigint(20) unsigned default 1,
    ADD CONSTRAINT FOREIGN KEY(assujetti_id) REFERENCES assujetti(id);

ALTER TABLE cfps
    add column assujetti_id bigint(20) unsigned default 1,
    ADD CONSTRAINT FOREIGN KEY(assujetti_id) REFERENCES assujetti(id);

drop table if exists coupon;
CREATE TABLE `coupon` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `coupon` varchar(55) COLLATE utf8mb4_unicode_ci not null,
  `valeur` int(3) NOT NULL,
  `utilise` boolean not null default false,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


ALTER TABLE abonnements
  add column coupon_id bigint(20) unsigned default 0;
ALTER TABLE abonnement_cfps
  add column coupon_id bigint(20) unsigned default 0;