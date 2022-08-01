-- Active: 1656573946460@@127.0.0.1@3306@mahafaly
CREATE TABLE genre (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  genre varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO genre (id,genre, created_at, updated_at) VALUES
(1,'Femme', '2021-10-26 05:45:24', '2021-10-26 05:45:24'),
(2,'Homme', '2021-10-26 05:45:24', '2021-10-26 05:45:24');

CREATE TABLE roles (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  role_name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  role_description varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO roles (id,role_name,role_description, created_at, updated_at) VALUES
(1,'admin','Admnistrateur', '2021-10-26 05:45:24', '2021-10-26 05:45:24'),
(2,'referent',"Référent", '2021-10-26 05:45:24', '2021-10-26 05:45:24'),
(3,'stagiaire',"Employé" ,'2021-10-26 05:45:24', '2021-10-26 05:45:24'),
(4,'formateur',"Formateur", '2021-10-26 05:45:24', '2021-10-26 05:45:24'),
(5,'manager',"Manager", '2021-11-08 05:47:18', '2021-11-08 05:47:18'),
(6,'SuperAdmin',"Super Admin", '2021-11-10 02:59:59', '2021-11-10 02:59:59'),
(7,'CFP',"Organisme de Formation", '2021-11-22 09:27:38', '2021-11-22 09:27:38'),
(8,'service','chef de service', '2021-10-26 05:45:24', '2021-10-26 05:45:24');

INSERT INTO roles (id,role_name,role_description, created_at, updated_at) VALUES (9,'formateur_interne','Formateur interne', '2021-10-26 05:45:24', '2021-10-26 05:45:24');


CREATE TABLE `niveaux` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `niveau` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `progression` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `niveaux` (`id`,`niveau`,`progression`, `created_at`, `updated_at`) VALUES
(1,'Débutant',1,NOW(),NOW()),
(2,'Intermédiaire',3,NOW(),NOW()),
(3,'Avancé',4,NOW(),NOW()),
(4,'Expert',5,NOW(),NOW());


CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pourcent` decimal(5,2) DEFAULT 20 CHECK (`pourcent` >= 0),
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `taxes` (`description`, `pourcent`, `created_at`, `updated_at`) VALUES
('TVA', '20.00', '2021-11-23 06:55:50', '2021-11-23 06:55:50'),
('Hors Taxe', '0.00', '2021-11-23 06:55:50', '2021-11-23 06:55:50');

CREATE TABLE `type_payement` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `type_payement` (`type`, `created_at`, `updated_at`) VALUES
('FP', NULL, NULL),
('FMFP', NULL, NULL);

  CREATE TABLE `offre_gratuits` (
      `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
      `limite` INT,
      `type_abonne_id` bigint(20) UNSIGNED NOT NULL REFERENCES type_abonnes(id) ON DELETE CASCADE
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
  INSERT INTO `offre_gratuits` (`limite`, `type_abonne_id`) VALUES
  (5, 1),
  (2, 2);

CREATE TABLE `mode_financements` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `mode_financements` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Virement bancaire', NULL, NULL),
(2, 'Chèque', NULL, NULL),
(3, 'Espece', NULL, NULL);


CREATE TABLE users (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  email varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
  cin varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  telephone varchar(100) COLLATE utf8mb4_unicode_ci ,
  email_verified_at timestamp NULL DEFAULT NULL,
  password varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  remember_token varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  created_at timestamp NULL DEFAULT  current_timestamp(),
  updated_at timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users (id, name, email, email_verified_at, password, remember_token, created_at, updated_at,cin,telephone) VALUES
(4, 'Levy', 'contact@formation.mg', NULL, '$2y$10$9i0uUmJpIwVtYX1dlEdM5.bNcYXU8CrD8QXDS5loPVAurII6BmbFm', NULL, '2021-08-04 05:53:44', '2021-08-04 05:53:44','301051027178','0321122233');

CREATE TABLE role_users(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE,
   `role_id` bigint(20) UNSIGNED NOT NULL REFERENCES roles(id) ON DELETE CASCADE,
  prioriter boolean not null default false,
   activiter boolean not null default false
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO role_users(user_id,role_id,activiter) VALUES (4,6,1);

CREATE TABLE `type_abonnes` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `abonne_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `type_abonnes` (`id`, `abonne_name`, `created_at`, `updated_at`) VALUES
(1, 'entreprises', '2021-11-23 09:06:31', '2021-11-23 09:06:31'),
(2, 'cfps', '2021-11-23 09:06:31', '2021-11-23 09:06:31');

CREATE TABLE `categorie_paiements` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `categorie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categorie_paiements` (`id`, `categorie`, `created_at`, `updated_at`) VALUES
(1, 'Mensuel', '2021-11-25 05:37:35', '2021-11-25 05:37:35'),
(2, 'Annuel', '2021-11-25 05:37:35', '2021-11-25 05:37:35');

CREATE TABLE `tarif_categories` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `type_abonnement_role_id` bigint(20) UNSIGNED NOT NULL REFERENCES type_abonnement_roles(id) ON DELETE CASCADE,
  `categorie_paiement_id` bigint(20) UNSIGNED NOT NULL REFERENCES categorie_paiements(id) ON DELETE CASCADE,
  `tarif` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;





CREATE TABLE IF NOT EXISTS niveau_etude(
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `niveau_etude` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `niveau_etude` (`id`, `niveau_etude`) VALUES
(1, 'CEPE'),
(2, 'BEPC'),
(3, 'BACC'),
(4,'Bacc + 1'),
(5,'Bacc + 2'),
(6,'Licence'),
(7,'Bacc + 4'),
(8,'Master'),
(9,'Bacc + 6'),
(10,'Bacc + 7'),
(11,'Doctorat');




