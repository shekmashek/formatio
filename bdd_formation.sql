-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 03, 2022 at 08:46 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdd_suivi_formation_version_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `abonnements`
--

CREATE TABLE `abonnements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_demande` date NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `mode_financement_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_abonnement_role_id` bigint(20) UNSIGNED NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `categorie_paiement_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `abonnement_cfps`
--

CREATE TABLE `abonnement_cfps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_demande` date NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `mode_paiement` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_abonnement_role_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `categorie_paiement_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `annee_plans`
--

CREATE TABLE `annee_plans` (
  `id` bigint(20) NOT NULL,
  `entreprise_id` bigint(20) NOT NULL,
  `etat` varchar(255) NOT NULL,
  `annee` year(4) NOT NULL,
  `cfp_id` bigint(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `archive_modules`
--

CREATE TABLE `archive_modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_module` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `formation_id` bigint(20) UNSIGNED NOT NULL,
  `prix` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `duree_jour` int(11) NOT NULL,
  `prerequis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectif` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `modalite_formation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_id` bigint(20) NOT NULL,
  `materiel_necessaire` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cible` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `version` int(10) NOT NULL DEFAULT 1,
  `date_creation` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `archive_modules`
--

INSERT INTO `archive_modules` (`id`, `module_id`, `reference`, `nom_module`, `formation_id`, `prix`, `duree`, `duree_jour`, `prerequis`, `objectif`, `modalite_formation`, `description`, `niveau_id`, `materiel_necessaire`, `cible`, `version`, `date_creation`, `created_at`, `updated_at`) VALUES
(1, 9, 'MOD_EX01', 'NI.Fondamentaux', 1, 300000, 12, 4, '', '', 'Presentielle ou a distance', '', 1, 'pc', 'RH', 1, '2022-01-18 12:45:06', NULL, NULL),
(2, 9, 'MOD_EX01', 'NI.Fondamentaux', 1, 300000, 12, 4, 'prerequis ', 'objectif', 'Presentielle ou a distance', 'desc', 1, 'pc', 'RH', 1, '2022-01-20 11:11:22', NULL, NULL),
(5, 9, 'MOD_EX01', 'NI.Fondamentaux', 1, 300000, 12, 4, 'prerequis ', 'objectif', 'Presentielle ou a distance', 'desc', 1, 'pc', 'RH', 2, '2022-01-20 12:33:59', NULL, NULL),
(6, 9, 'MOD_EX01', 'NI.Fondamentaux', 1, 300000, 12, 4, 'prerequis', 'objectif', 'Presentielle ou a distance', 'formation excel avancee', 1, 'pc', 'RH', 2, '2022-01-20 12:56:58', NULL, NULL),
(7, 9, 'MOD_EX01', 'NI.Fondamentaux', 1, 300000, 12, 4, 'prerequis MOD_EX01', 'objectif', 'Presentielle ou a distance', 'formation excel avancee', 1, 'pc,cahier', 'RH,SI', 2, '2022-01-20 13:14:51', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE `avis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `note` decimal(5,2) NOT NULL DEFAULT 0.00,
  `commentaire` text DEFAULT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_avis` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`id`, `stagiaire_id`, `module_id`, `note`, `commentaire`, `status`, `date_avis`, `created_at`, `updated_at`) VALUES
(4, 1, 9, '9.00', 'point fort', 'Fini', '2021-12-21', NULL, NULL),
(5, 1, 9, '7.00', 'test', 'Fini', '2021-12-22', NULL, NULL),
(6, 1, 9, '5.00', 'test note', 'Fini', '2021-12-22', NULL, NULL),
(8, 1, 9, '7.00', 'test 45', 'Fini', '2021-12-22', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `but_objectif`
--

CREATE TABLE `but_objectif` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `but_objectif`
--

INSERT INTO `but_objectif` (`id`, `description`, `cfp_id`, `created_at`, `updated_at`) VALUES
(1, 'Objectifs globaux de la formation :', 1, NULL, NULL),
(2, 'Objectif pédagogique de la formation Compétences clé :', 1, NULL, NULL),
(3, 'Objectif pédagogique de la formation Business Intelligence :', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categorie_paiements`
--

CREATE TABLE `categorie_paiements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categorie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categorie_paiements`
--

INSERT INTO `categorie_paiements` (`id`, `categorie`, `created_at`, `updated_at`) VALUES
(1, 'Mensuel', '2021-11-25 02:37:35', '2021-11-25 02:37:35'),
(2, 'Annuel', '2021-11-25 02:37:35', '2021-11-25 02:37:35');

-- --------------------------------------------------------

--
-- Stand-in structure for view `cfpcours`
-- (See below for the actual view)
--
CREATE TABLE `cfpcours` (
`module_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`prix` int(11)
,`duree` int(11)
,`modalite_formation` varchar(255)
,`duree_jour` int(11)
,`objectif` varchar(255)
,`prerequis` varchar(255)
,`description` text
,`materiel_necessaire` varchar(255)
,`cible` varchar(255)
,`niveau_id` bigint(20)
,`niveau` varchar(191)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`domaine_id` int(11)
,`cfp_id` bigint(20)
,`nom` varchar(191)
,`logo` varchar(191)
,`email` varchar(191)
,`telephone` varchar(10)
,`id_programme` bigint(20) unsigned
,`titre_programme` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `cfps`
--

CREATE TABLE `cfps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_lot` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_ville` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse_region` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domaine_de_formation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nif` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stat` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rcs` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cif` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activiter` tinyint(1) NOT NULL DEFAULT 1,
  `site_cfp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cfps`
--

INSERT INTO `cfps` (`id`, `nom`, `adresse_lot`, `adresse_ville`, `adresse_region`, `email`, `telephone`, `domaine_de_formation`, `nif`, `stat`, `rcs`, `cif`, `created_at`, `updated_at`, `logo`, `activiter`, `site_cfp`, `user_id`) VALUES
(1, 'Numerika Center', 'Analamahitsy', 'Antananarivo', 'Analamanga', 'contact@numerika.center', '0323205252', 'Specialiser en formation EXCEL,PBI et Access', 'nif-numerika', 'stat-numerika', 'rcs-numerika', 'cif-numerika', '2021-12-10 05:46:44', '2021-12-10 05:46:44', 'Numerika_Center23-12-2021.png', 1, 'numerika.center', 2);

-- --------------------------------------------------------

--
-- Table structure for table `chef_departements`
--

CREATE TABLE `chef_departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_chef` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_chef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre_chef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fonction_chef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_chef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_chef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cin_chef` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activiter` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chef_departements`
--

INSERT INTO `chef_departements` (`id`, `nom_chef`, `prenom_chef`, `genre_chef`, `fonction_chef`, `mail_chef`, `telephone_chef`, `cin_chef`, `entreprise_id`, `user_id`, `photos`, `activiter`, `created_at`, `updated_at`) VALUES
(1, 'RAKOTO', 'Paul', 'Homme', 'DSI', 'rakotopaul@gmail.com', '0323545404', NULL, 1, 10, 'RAKOTO13-12-2021.png', 1, '2021-12-13 03:30:28', '2021-12-13 03:30:28');

-- --------------------------------------------------------

--
-- Table structure for table `chef_dep_entreprises`
--

CREATE TABLE `chef_dep_entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `departement_entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `chef_departement_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chef_dep_entreprises`
--

INSERT INTO `chef_dep_entreprises` (`id`, `departement_entreprise_id`, `chef_departement_id`, `created_at`, `updated_at`) VALUES
(1, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `choix_pour_questions`
--

CREATE TABLE `choix_pour_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `reponse` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `points` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `choix_pour_questions`
--

INSERT INTO `choix_pour_questions` (`id`, `question_id`, `reponse`, `points`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cliquer droit sur la souris puis « Ajouter un commentaire »', 0, NULL, NULL),
(2, 1, 'Cliquer droit sur la souris puis « Insérer un commentaire »', 1, NULL, NULL),
(3, 1, 'Fichier -> Commentaires', 0, NULL, NULL),
(4, 1, 'View -> Commentaires', 0, NULL, NULL),
(5, 2, 'Accès', 0, NULL, NULL),
(6, 2, 'Référencement', 1, NULL, NULL),
(7, 2, 'Mise à jour', 0, NULL, NULL),
(8, 2, 'Fonctionnement', 0, NULL, NULL),
(9, 3, 'Number', 0, NULL, NULL),
(10, 3, 'Character', 0, NULL, NULL),
(11, 3, 'Label', 0, NULL, NULL),
(12, 3, 'Date/Time', 1, NULL, NULL),
(13, 4, 'Contenu', 0, NULL, NULL),
(14, 4, 'Objets', 0, NULL, NULL),
(15, 4, 'Scénarios', 0, NULL, NULL),
(16, 4, 'Tout les réponses sont vrais', 1, NULL, NULL),
(17, 5, 'Apostrophe (‘)', 1, NULL, NULL),
(18, 5, 'Exclamation (!)', 0, NULL, NULL),
(19, 5, 'Dièse (#)', 0, NULL, NULL),
(20, 5, 'Tilde (~)', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `competence_formateurs`
--

CREATE TABLE `competence_formateurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `competence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formateur_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `domaine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `competence_formateurs`
--

INSERT INTO `competence_formateurs` (`id`, `competence`, `formateur_id`, `created_at`, `updated_at`, `domaine`) VALUES
(1, 'Merys', 1, '2021-12-10 08:45:18', '2021-12-10 08:45:18', 'Conception'),
(2, 'excel', 2, '2022-02-01 04:54:59', '2022-02-01 04:54:59', 'Bureautique');

-- --------------------------------------------------------

--
-- Table structure for table `conclusion`
--

CREATE TABLE `conclusion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cours`
--

CREATE TABLE `cours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre_cours` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programme_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cours`
--

INSERT INTO `cours` (`id`, `titre_cours`, `programme_id`, `created_at`, `updated_at`) VALUES
(8, '$', 3, '2021-10-18 06:55:04', '2021-10-18 06:55:04'),
(12, 'Référence nommée', 3, '2021-10-18 07:56:11', '2021-10-18 07:56:11'),
(15, 'Mathématique', 4, '2021-10-19 00:45:41', '2021-10-19 00:45:41'),
(16, 'Comparaison', 4, '2021-10-19 00:45:51', '2021-10-19 00:45:51'),
(17, 'Concaténation', 4, '2021-10-19 00:45:59', '2021-10-19 00:45:59'),
(18, 'Référence', 4, '2021-10-19 00:46:08', '2021-10-19 00:46:08'),
(19, 'Erreur', 5, '2021-10-19 00:46:27', '2021-10-19 00:46:27'),
(20, 'Vide', 5, '2021-10-19 00:46:35', '2021-10-19 00:46:35'),
(21, 'Logique', 5, '2021-10-19 00:46:47', '2021-10-19 00:46:47'),
(22, 'Texte', 5, '2021-10-19 00:46:56', '2021-10-19 00:46:56'),
(23, 'Numérique', 5, '2021-10-19 00:47:06', '2021-10-19 00:47:06'),
(24, 'Syntaxe', 7, '2021-10-19 00:47:31', '2021-10-19 00:47:31'),
(25, 'Fonctions de bases', 7, '2021-10-19 00:47:40', '2021-10-19 00:47:40'),
(26, 'SI() simple', 7, '2021-10-19 00:47:49', '2021-10-19 00:47:49'),
(27, 'Format', 9, '2021-10-19 00:48:05', '2021-10-19 00:48:05'),
(28, 'Diverses fonctions', 9, '2021-10-19 00:48:13', '2021-10-19 00:48:13'),
(29, 'Comparaison', 76, '2021-10-19 00:49:50', '2021-10-19 00:49:50'),
(30, 'Diverses fonctions logiques', 76, '2021-10-19 00:49:58', '2021-10-19 00:49:58'),
(31, 'SI() imbriquée', 77, '2021-10-19 00:50:12', '2021-10-19 00:50:12'),
(32, 'NB.SI() / NB.SI.ENS()', 77, '2021-10-19 00:50:21', '2021-10-19 00:50:21'),
(33, 'SOMME.SI() / SOMME.SI.ENS()', 77, '2021-10-19 00:50:30', '2021-10-19 00:50:30'),
(34, 'RECHERCHEV()', 78, '2021-10-19 00:50:46', '2021-10-19 00:50:46'),
(35, 'RECHERCHEH()', 78, '2021-10-19 00:50:56', '2021-10-19 00:50:56'),
(36, 'INDEX() et EQUIV()', 78, '2021-10-19 00:51:04', '2021-10-19 00:51:04'),
(37, 'Validation de données', 18, '2021-10-19 00:51:26', '2021-10-19 00:51:26'),
(38, 'Tri simple et avancé', 20, '2021-10-19 00:51:41', '2021-10-19 00:51:41'),
(39, 'Filtre simple et avancé', 20, '2021-10-19 00:51:50', '2021-10-19 00:51:50'),
(40, 'Mise en forme conditionnelle prédéfinie', 19, '2021-10-19 00:52:02', '2021-10-19 00:52:02'),
(41, 'Création de propre règle', 19, '2021-10-19 00:52:11', '2021-10-19 00:52:11'),
(42, 'Base TCD', 23, '2021-10-19 00:52:33', '2021-10-19 00:52:33'),
(43, 'Divers TCD', 23, '2021-10-19 00:52:42', '2021-10-19 00:52:42'),
(44, 'Base Graphique', 24, '2021-10-19 00:52:53', '2021-10-19 00:52:53'),
(46, 'Divers Graphiques', 24, '2021-10-19 00:53:09', '2021-10-19 00:53:09'),
(47, 'Graphiques personnalisés', 24, '2021-10-19 00:53:21', '2021-10-19 00:53:21'),
(48, 'Connexion de liaison', 79, '2021-10-19 00:53:35', '2021-10-19 00:53:35'),
(49, 'Excel', 80, '2021-10-19 00:53:59', '2021-10-19 00:53:59'),
(50, 'Texte', 80, '2021-10-19 00:54:07', '2021-10-19 00:54:07'),
(51, 'CSV', 80, '2021-10-19 00:54:15', '2021-10-19 00:54:15'),
(52, 'Base de données', 80, '2021-10-19 00:54:22', '2021-10-19 00:54:22'),
(53, 'Web', 80, '2021-10-19 00:54:31', '2021-10-19 00:54:31'),
(54, 'Dossier', 80, '2021-10-19 00:54:40', '2021-10-19 00:54:40'),
(55, 'Fraction', 81, '2021-10-19 00:54:53', '2021-10-19 00:54:53'),
(56, 'Fusion', 81, '2021-10-19 00:55:01', '2021-10-19 00:55:01'),
(57, 'Reduction des lignes', 81, '2021-10-19 00:55:09', '2021-10-19 00:55:09'),
(58, 'Gérer les colonnes', 81, '2021-10-19 00:55:18', '2021-10-19 00:55:18'),
(59, 'En tête promus', 81, '2021-10-19 00:55:25', '2021-10-19 00:55:25'),
(60, 'Nettoyage', 81, '2021-10-19 00:55:33', '2021-10-19 00:55:33'),
(61, 'Typage', 81, '2021-10-19 00:55:40', '2021-10-19 00:55:40'),
(62, 'Filtre', 81, '2021-10-19 00:55:49', '2021-10-19 00:55:49'),
(63, 'Ajouter des requêtes', 82, '2021-10-19 00:56:02', '2021-10-19 00:56:02'),
(64, 'Fusionner des requêtes', 82, '2021-10-19 00:56:11', '2021-10-19 00:56:11'),
(65, 'Combiner des fichiers', 82, '2021-10-19 00:56:21', '2021-10-19 00:56:21'),
(66, 'Pivoter', 83, '2021-10-19 00:56:33', '2021-10-19 00:56:33'),
(67, 'Dépivoter', 83, '2021-10-19 00:56:43', '2021-10-19 00:56:43'),
(68, 'Transposer', 83, '2021-10-19 00:56:50', '2021-10-19 00:56:50'),
(69, 'Remplissage', 83, '2021-10-19 00:56:58', '2021-10-19 00:56:58'),
(70, 'TXT', 80, NULL, NULL),
(71, 'Extraction', 81, NULL, NULL),
(72, 'Ajout colonne d\'exemple', 50, NULL, NULL),
(73, 'Ajout colonne conditionnelle', 50, NULL, NULL),
(74, 'Ajout colonne conditionnelle', 50, NULL, NULL),
(75, 'Ajout colonne d\'index', 50, NULL, NULL),
(76, 'Ajout colonne personalisé', 50, NULL, NULL),
(77, 'IF', 61, NULL, NULL),
(78, 'Switch', 61, NULL, NULL),
(79, 'OR', 61, NULL, NULL),
(80, 'AND', 61, NULL, NULL),
(81, 'SUM', 62, NULL, NULL),
(82, 'MIN', 62, NULL, NULL),
(83, 'MAX', 62, NULL, NULL),
(84, 'AVERAGE', 62, NULL, NULL),
(85, 'COUNT', 63, NULL, NULL),
(86, 'COUNTBLANK', 63, NULL, NULL),
(87, 'COUNTROWS', 63, NULL, NULL),
(88, 'DISTINCTCOUNT', 63, NULL, NULL),
(89, 'SUMX', 64, NULL, NULL),
(90, 'AVERAGEX', 64, NULL, NULL),
(91, 'MAXX', 64, NULL, NULL),
(92, 'MINX', 64, NULL, NULL),
(93, 'FIND', 99, NULL, NULL),
(94, 'LEFT', 99, NULL, NULL),
(95, 'CONCATENATE', 99, NULL, NULL),
(96, 'SEARCH', 99, NULL, NULL),
(97, 'LEN', 99, NULL, NULL),
(98, 'FORMAT', 99, NULL, NULL),
(99, 'CALCULATE', 91, NULL, NULL),
(100, 'ALL', 91, NULL, NULL),
(101, 'DISTINCT', 91, NULL, NULL),
(102, 'FILTER', 91, NULL, NULL),
(103, 'ALLSELECTED', 91, NULL, NULL),
(104, 'ALLEXCEPT', 91, NULL, NULL),
(105, 'DATEADD', 92, NULL, NULL),
(106, 'DATEYTD', 92, NULL, NULL),
(107, 'DATEMTD', 92, NULL, NULL),
(108, 'DATEQTD', 92, NULL, NULL),
(109, 'DATEDIFF', 92, NULL, NULL),
(110, 'TOTALMTD', 92, NULL, NULL),
(111, 'TOTALYTD', 92, NULL, NULL),
(112, 'PREVIOUSMONTH', 92, NULL, NULL),
(113, 'PREVIOUSQUARTER', 92, NULL, NULL),
(114, 'PREVIOUSDAY', 92, NULL, NULL),
(115, 'CALENDAR', 93, NULL, NULL),
(116, 'YEAR', 93, NULL, NULL),
(117, 'MONTH', 93, NULL, NULL),
(118, 'DAY', 93, NULL, NULL),
(119, 'QUARTER', 93, NULL, NULL),
(120, 'WEEKDAY', 93, NULL, NULL),
(121, 'WEEKNUM', 93, NULL, NULL),
(122, 'HOUR', 93, NULL, NULL),
(123, 'MINUTE', 93, NULL, NULL),
(124, 'SECOND', 93, NULL, NULL),
(125, 'Filtre sur le visuel', 65, NULL, NULL),
(126, 'Filtre sur le rapport', 65, NULL, NULL),
(127, 'Filtre sur les pages', 65, NULL, NULL),
(128, 'Modifier interactions', 66, NULL, NULL),
(129, 'Couleur arrière-plan', 67, NULL, NULL),
(130, 'Couleur police', 67, NULL, NULL),
(131, 'Barres de données', 67, NULL, NULL),
(132, 'Icônes', 67, NULL, NULL),
(133, 'Tableau', 68, NULL, NULL),
(134, 'Matrice', 68, NULL, NULL),
(135, 'Segment', 69, NULL, NULL),
(136, 'Barre et Histogramme', 69, NULL, NULL),
(137, 'Secteur', 69, NULL, NULL),
(138, 'Anneau', 69, NULL, NULL),
(139, 'Treemap', 69, NULL, NULL),
(140, 'Graphiques combinés', 69, NULL, NULL),
(141, 'Entonnoir', 71, NULL, NULL),
(142, 'Cascade', 71, NULL, NULL),
(143, 'Jauge', 72, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cour_dans_detail`
--

CREATE TABLE `cour_dans_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cours_id` bigint(20) UNSIGNED NOT NULL,
  `programme_id` bigint(20) UNSIGNED NOT NULL,
  `detail_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demande_test_niveaux`
--

CREATE TABLE `demande_test_niveaux` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description_test` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `formation_id` bigint(20) UNSIGNED NOT NULL,
  `date_creation` date DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `demande_test_niveaux`
--

INSERT INTO `demande_test_niveaux` (`id`, `description_test`, `entreprise_id`, `cfp_id`, `formation_id`, `date_creation`, `created_at`, `updated_at`) VALUES
(1, 'Demande de test de niveau Ms Power BI', 1, 1, 1, '2021-12-16', '2021-12-16 03:35:27', '2021-12-16 03:35:27');

-- --------------------------------------------------------

--
-- Table structure for table `demmande_cfp_etp`
--

CREATE TABLE `demmande_cfp_etp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `demmandeur_cfp_id` bigint(20) UNSIGNED NOT NULL,
  `inviter_etp_id` bigint(20) UNSIGNED NOT NULL,
  `activiter` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demmande_cfp_formateur`
--

CREATE TABLE `demmande_cfp_formateur` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `demmandeur_cfp_id` bigint(20) UNSIGNED NOT NULL,
  `inviter_formateur_id` bigint(20) UNSIGNED NOT NULL,
  `activiter` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `demmande_cfp_formateur`
--

INSERT INTO `demmande_cfp_formateur` (`id`, `demmandeur_cfp_id`, `inviter_formateur_id`, `activiter`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `demmande_etp_cfp`
--

CREATE TABLE `demmande_etp_cfp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `demmandeur_etp_id` bigint(20) UNSIGNED NOT NULL,
  `inviter_cfp_id` bigint(20) UNSIGNED NOT NULL,
  `activiter` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `demmande_formateur_cfp`
--

CREATE TABLE `demmande_formateur_cfp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `demmandeur_formateur_id` bigint(20) UNSIGNED NOT NULL,
  `inviter_cfp_id` bigint(20) UNSIGNED NOT NULL,
  `activiter` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `demmande_formateur_cfp`
--

INSERT INTO `demmande_formateur_cfp` (`id`, `demmandeur_formateur_id`, `inviter_cfp_id`, `activiter`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_departement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`id`, `nom_departement`, `created_at`, `updated_at`) VALUES
(1, 'Achat', NULL, NULL),
(2, 'Administration,comptabilité et finance', NULL, NULL),
(3, 'IT et Télécommunications ', NULL, NULL),
(4, 'Ingénierie et Technique', NULL, NULL),
(5, 'Management et Direction', NULL, NULL),
(6, 'Marketing, Publicité et Evénement', NULL, NULL),
(7, 'Production', NULL, NULL),
(8, 'Recherche et développement', NULL, NULL),
(9, 'Ressources humaines', NULL, NULL),
(10, 'Secrétariat et Support Administratif', NULL, NULL),
(11, 'Service légal', NULL, NULL),
(12, 'Transport et Logistique', NULL, NULL),
(13, 'Vente', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departement_entreprises`
--

CREATE TABLE `departement_entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departement_entreprises`
--

INSERT INTO `departement_entreprises` (`id`, `departement_id`, `entreprise_id`, `created_at`, `updated_at`) VALUES
(1, 6, 1, '2021-12-10 06:05:48', '2021-12-10 06:05:48'),
(2, 8, 1, '2021-12-10 06:05:48', '2021-12-10 06:05:48'),
(3, 9, 1, '2021-12-10 06:05:48', '2021-12-10 06:05:48'),
(4, 13, 1, '2021-12-10 06:05:48', '2021-12-10 06:05:48');

-- --------------------------------------------------------

--
-- Table structure for table `description_champ_reponse`
--

CREATE TABLE `description_champ_reponse` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descr_champs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_qst_fille` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) NOT NULL,
  `nb_max` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `description_champ_reponse`
--

INSERT INTO `description_champ_reponse` (`id`, `descr_champs`, `id_qst_fille`, `cfp_id`, `nb_max`, `created_at`, `updated_at`) VALUES
(1, 'Note sur 10', 1, 1, 10, NULL, NULL),
(2, 'Note sur 10', 2, 1, 10, NULL, NULL),
(3, 'Pas de Tout', 3, 1, NULL, NULL, NULL),
(4, 'Insuffisamment', 3, 3, NULL, NULL, NULL),
(5, 'En partie', 3, 1, NULL, NULL, NULL),
(6, 'Totalement', 3, 1, NULL, NULL, NULL),
(7, 'Pas de Tout', 4, 1, NULL, NULL, NULL),
(8, 'Insuffisamment', 4, 1, NULL, NULL, NULL),
(9, 'En partie', 4, 1, NULL, NULL, NULL),
(10, 'Totalement', 4, 1, NULL, NULL, NULL),
(11, 'Pas de Tout', 5, 1, NULL, NULL, NULL),
(12, 'Insuffisamment', 5, 1, NULL, NULL, NULL),
(13, 'En partie', 5, 1, NULL, NULL, NULL),
(14, 'Totalement', 5, 1, NULL, NULL, NULL),
(15, 'Pas de Tout', 6, 1, NULL, NULL, NULL),
(16, 'Insuffisamment', 6, 1, NULL, NULL, NULL),
(17, 'En partie', 6, 1, NULL, NULL, NULL),
(18, 'Totalement', 6, 1, NULL, NULL, NULL),
(19, 'Pas de Tout', 7, 1, NULL, NULL, NULL),
(20, 'Insuffisamment', 7, 1, NULL, NULL, NULL),
(21, 'En partie', 7, 1, NULL, NULL, NULL),
(22, 'Totalement', 7, 1, NULL, NULL, NULL),
(23, 'Pas de Tout', 8, 1, NULL, NULL, NULL),
(24, 'Insuffisamment', 8, 1, NULL, NULL, NULL),
(25, 'En partie', 8, 1, NULL, NULL, NULL),
(26, 'Totalement', 8, 1, NULL, NULL, NULL),
(27, 'Pas de Tout', 9, 1, NULL, NULL, NULL),
(28, 'Insuffisamment', 9, 1, NULL, NULL, NULL),
(29, 'En partie', 9, 1, NULL, NULL, NULL),
(30, 'Totalement', 9, 1, NULL, NULL, NULL),
(31, 'Adapté', 10, 1, NULL, NULL, NULL),
(32, 'Trop rapide', 10, 1, NULL, NULL, NULL),
(33, 'Trop lent', 10, 1, NULL, NULL, NULL),
(34, 'Pas de Tout', 11, 1, NULL, NULL, NULL),
(35, 'Insuffisamment', 11, 1, NULL, NULL, NULL),
(36, 'En partie', 11, 1, NULL, NULL, NULL),
(37, 'Totalement', 11, 1, NULL, NULL, NULL),
(38, 'Pas de Tout', 12, 1, NULL, NULL, NULL),
(39, 'Insuffisamment', 12, 1, NULL, NULL, NULL),
(40, 'En partie', 12, 1, NULL, NULL, NULL),
(41, 'Totalement', 12, 1, NULL, NULL, NULL),
(42, 'Pas de Tout', 13, 1, NULL, NULL, NULL),
(43, 'Insuffisamment', 13, 1, NULL, NULL, NULL),
(44, 'En partie', 13, 1, NULL, NULL, NULL),
(45, 'Totalement', 13, 1, NULL, NULL, NULL),
(46, 'Pas de Tout', 14, 1, NULL, NULL, NULL),
(47, 'Insuffisamment', 14, 1, NULL, NULL, NULL),
(48, 'En partie', 14, 1, NULL, NULL, NULL),
(49, 'Totalement', 14, 1, NULL, NULL, NULL),
(50, 'Non', 15, 1, NULL, NULL, NULL),
(51, 'Un peu', 15, 1, NULL, NULL, NULL),
(52, 'Beaucoup', 15, 1, NULL, NULL, NULL),
(53, 'Non', 16, 1, NULL, NULL, NULL),
(54, 'Un peu', 16, 1, NULL, NULL, NULL),
(55, 'Beaucoup', 16, 1, NULL, NULL, NULL),
(56, 'Oui', 17, 1, NULL, NULL, NULL),
(57, 'Non', 17, 1, NULL, NULL, NULL),
(58, 'rédigez votre commentaire', 18, 1, NULL, NULL, NULL),
(59, '', 19, 1, NULL, NULL, NULL),
(60, '', 20, 1, NULL, NULL, NULL),
(61, '', 21, 1, NULL, NULL, NULL),
(62, '', 22, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `h_debut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `h_fin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_detail` date NOT NULL,
  `formateur_id` bigint(20) UNSIGNED NOT NULL,
  `groupe_id` bigint(20) UNSIGNED NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `lieu`, `h_debut`, `h_fin`, `date_detail`, `formateur_id`, `groupe_id`, `projet_id`, `cfp_id`, `created_at`, `updated_at`) VALUES
(11, 'Analamahitsy', '14:00', '17:00', '2022-02-02', 2, 1, 2, 1, NULL, NULL),
(12, 'Analamahitsy', '08:00', '10:00', '2022-02-03', 2, 1, 2, 1, NULL, NULL),
(13, 'Analamahitsy', '14:00', '16:15', '2022-02-03', 2, 1, 2, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `detail_evaluation_action_formation`
--

CREATE TABLE `detail_evaluation_action_formation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pourcent` decimal(5,2) NOT NULL,
  `evaluation_action_formation_id` bigint(20) UNSIGNED NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_recommandation`
--

CREATE TABLE `detail_recommandation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `recommandation_id` bigint(20) UNSIGNED NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `domaines`
--

CREATE TABLE `domaines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_domaine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `domaines`
--

INSERT INTO `domaines` (`id`, `nom_domaine`, `created_at`, `updated_at`) VALUES
(1, 'Bureautique', '2021-11-16 07:22:43', '2021-11-16 07:22:43'),
(2, 'Développement Personnel', '2021-11-16 07:22:43', '2021-11-16 07:22:43'),
(3, 'Management', '2021-11-16 07:22:43', '2021-11-16 07:22:43'),
(4, 'Projet', '2021-11-16 07:22:43', '2021-11-16 07:22:43'),
(5, 'Ressources Humaines', '2021-11-16 07:22:43', '2021-11-16 07:22:43'),
(6, 'Communication - WebMarketing', '2021-11-16 07:22:43', '2021-11-16 07:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `encaissements`
--

CREATE TABLE `encaissements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `montant_facture` decimal(15,2) DEFAULT 0.00,
  `libelle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payement` decimal(15,2) DEFAULT 0.00,
  `montant_ouvert` decimal(15,2) DEFAULT NULL,
  `date_encaissement` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `num_facture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cfp_id` bigint(20) NOT NULL,
  `mode_financement_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_etp` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rcs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secteur_id` bigint(20) UNSIGNED NOT NULL,
  `email_etp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_etp` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activiter` tinyint(1) NOT NULL DEFAULT 1,
  `telephone_etp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom_etp`, `adresse`, `logo`, `created_at`, `updated_at`, `nif`, `stat`, `rcs`, `cif`, `secteur_id`, `email_etp`, `site_etp`, `activiter`, `telephone_etp`) VALUES
(1, 'TROPIC MAD', 'Tanjombato', 'TROPIC_MAD10-12-2021.png', '2021-12-10 05:41:12', '2021-12-10 05:41:12', 'nif-tropicmad', 'stat-tropicmad', 'rcs-tropicmad', 'cif-tropicmad', 6, 'tropicmad@gmail.com', 'tropicmad.mg', 1, '0349828394');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_action_formation`
--

CREATE TABLE `evaluation_action_formation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluation_action_formation`
--

INSERT INTO `evaluation_action_formation` (`id`, `titre`, `cfp_id`, `created_at`, `updated_at`) VALUES
(1, 'Animation de la formation', 1, NULL, NULL),
(2, 'Pertinence de la formation', 1, NULL, NULL),
(3, 'Organisation de la formation', 1, NULL, NULL),
(4, 'Contenu de la formation', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_resultat`
--

CREATE TABLE `evaluation_resultat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events_table`
--

CREATE TABLE `events_table` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `start` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `experience_formateurs`
--

CREATE TABLE `experience_formateurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_entreprise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poste_occuper` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `debut_travail` date NOT NULL,
  `fin_travail` date NOT NULL,
  `taches` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formateur_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `experience_formateurs`
--

INSERT INTO `experience_formateurs` (`id`, `nom_entreprise`, `poste_occuper`, `debut_travail`, `fin_travail`, `taches`, `formateur_id`, `created_at`, `updated_at`) VALUES
(1, 'Numerika', 'Back-end', '2021-10-02', '2021-12-02', 'Gestion de formation collaborative', 1, '2021-12-10 08:45:18', '2021-12-10 08:45:18'),
(2, 'Numerika', 'Formateur excel', '2020-07-10', '2024-10-16', 'Formation', 2, '2022-02-01 04:54:59', '2022-02-01 04:54:59');

-- --------------------------------------------------------

--
-- Table structure for table `factures`
--

CREATE TABLE `factures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bon_de_commande` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_bc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#----',
  `devise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` bigint(20) UNSIGNED DEFAULT NULL,
  `groupe_id` bigint(20) UNSIGNED NOT NULL,
  `type_financement_id` bigint(20) UNSIGNED NOT NULL,
  `type_payement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_facture_id` bigint(20) UNSIGNED NOT NULL,
  `tax_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pu` int(11) NOT NULL DEFAULT 1,
  `qte` int(11) NOT NULL DEFAULT 1,
  `hors_taxe` decimal(15,2) DEFAULT 0.00 CHECK (`hors_taxe` >= 0),
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `num_facture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#0000',
  `activiter` tinyint(1) NOT NULL DEFAULT 0,
  `remise` int(11) DEFAULT 0,
  `other_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cfp_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feed_back`
--

CREATE TABLE `feed_back` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `formateurs`
--

CREATE TABLE `formateurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_formateur` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activiter` tinyint(1) NOT NULL DEFAULT 1,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `formateurs`
--

INSERT INTO `formateurs` (`id`, `nom_formateur`, `prenom_formateur`, `mail_formateur`, `numero_formateur`, `photos`, `created_at`, `updated_at`, `genre`, `date_naissance`, `adresse`, `cin`, `specialite`, `niveau`, `activiter`, `user_id`) VALUES
(1, 'Ranjelison', 'Vonjy', 'vonjitahinaranjelison@gmail.com', '0332211122', 'RAHARIFETRANicole16-11-2021.png', '2021-12-10 08:45:18', '2021-12-10 09:10:22', 'homme', '2001-10-10', 'Anosy', '099123456722', 'Back-end', 'BACC+3', 1, 9),
(2, 'Andrianiaina', 'Fernand', 'andria95@gmail.com', '0343123204', 'AndrianiainaFernand01-02-2022.png', '2022-02-01 04:54:59', '2022-02-01 04:54:59', 'homme', '1995-06-08', 'Amboditsiry', '099123456542', 'Excel', 'BACC+3', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `formations`
--

CREATE TABLE `formations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domaine_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cfp_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `formations`
--

INSERT INTO `formations` (`id`, `nom_formation`, `domaine_id`, `created_at`, `updated_at`, `cfp_id`) VALUES
(1, 'MS Excel', 1, NULL, NULL, 1),
(2, 'Ms Power BI', 1, NULL, NULL, 1),
(5, 'Autres logiciels', 1, '2021-11-17 01:00:01', '2021-11-17 01:00:01', 1),
(6, 'Affirmation de soi et changement', 2, '2021-11-17 01:00:27', '2021-11-17 01:00:27', 1),
(7, 'Gestion du stress et des émotions', 2, '2021-11-17 01:00:41', '2021-11-17 01:00:41', 1),
(8, 'Leadership', 2, '2021-11-17 01:06:54', '2021-11-17 01:06:54', 1),
(9, 'Management d\'équipe', 3, '2021-11-17 01:07:18', '2021-11-17 01:07:18', 1),
(10, 'Leadership, changement, gestion des conflits', 3, '2021-11-17 01:07:28', '2021-11-17 01:07:28', 1),
(11, 'Gestion de projet', 4, '2021-11-17 01:07:45', '2021-11-17 01:07:45', 1),
(12, 'Management de projet', 4, '2021-11-17 01:07:55', '2021-11-17 01:07:55', 1),
(13, 'Paie', 5, '2021-11-17 01:08:21', '2021-11-17 01:08:21', 1),
(14, 'Droit social', 5, '2021-11-17 01:08:31', '2021-11-17 01:08:31', 1),
(15, 'Webmarketing', 6, '2021-11-17 01:08:53', '2021-11-17 01:08:53', 1),
(16, 'PAO et Multimédia', 6, '2021-11-17 01:09:04', '2021-11-17 01:09:04', 1);

-- --------------------------------------------------------

--
-- Table structure for table `frais_annexes`
--

CREATE TABLE `frais_annexes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `frais_annexes`
--

INSERT INTO `frais_annexes` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'frais de deplacement', NULL, NULL),
(2, 'frais d\'hebergement', NULL, NULL),
(3, 'frais de restauration', NULL, NULL),
(4, 'frais de logistique', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `frais_annexe_formation`
--

CREATE TABLE `frais_annexe_formation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `montant` decimal(20,2) NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `groupe_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `frais_annexe_formation`
--

INSERT INTO `frais_annexe_formation` (`id`, `description`, `montant`, `entreprise_id`, `groupe_id`) VALUES
(18, 'Frais de déplacement', '1.00', 1, 1),
(19, 'Hébergement', '2.00', 1, 1),
(20, 'Restauration', '3.00', 1, 1),
(21, 'Location de salle', '4.00', 1, 1),
(22, 'Location matérielle', '5.00', 1, 1),
(23, 'test', '6.00', 1, 1),
(24, 'Frais de déplacement', '0.00', 1, 1),
(25, 'Hébergement', '0.00', 1, 1),
(26, 'Restauration', '0.00', 1, 1),
(27, 'Location de salle', '0.00', 1, 1),
(28, 'Location matérielle', '0.00', 1, 1),
(29, 'er', '0.00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `froid_evaluations`
--

CREATE TABLE `froid_evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cours_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `froid_evaluations`
--

INSERT INTO `froid_evaluations` (`id`, `cours_id`, `status`, `projet_id`, `stagiaire_id`, `cfp_id`, `created_at`, `updated_at`) VALUES
(1, 8, '0', 2, 1, 1, NULL, NULL),
(2, 12, '0', 2, 1, 1, NULL, NULL),
(3, 15, '1', 2, 1, 1, NULL, NULL),
(4, 16, '1', 2, 1, 1, NULL, NULL),
(5, 17, '2', 2, 1, 1, NULL, NULL),
(6, 18, '2', 2, 1, 1, NULL, NULL),
(7, 19, '3', 2, 1, 1, NULL, NULL),
(8, 20, '3', 2, 1, 1, NULL, NULL),
(9, 21, '3', 2, 1, 1, NULL, NULL),
(10, 22, '4', 2, 1, 1, NULL, NULL),
(11, 23, '4', 2, 1, 1, NULL, NULL),
(12, 24, '4', 2, 1, 1, NULL, NULL),
(13, 25, '4', 2, 1, 1, NULL, NULL),
(14, 26, '4', 2, 1, 1, NULL, NULL),
(15, 27, '2', 2, 1, 1, NULL, NULL),
(16, 28, '2', 2, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `groupes`
--

CREATE TABLE `groupes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `max_participant` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_participant` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_groupe` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activiter` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groupes`
--

INSERT INTO `groupes` (`id`, `max_participant`, `min_participant`, `nom_groupe`, `projet_id`, `module_id`, `date_debut`, `date_fin`, `status`, `activiter`, `created_at`, `updated_at`) VALUES
(1, '4', '10', 'G1', 2, 9, '2021-12-13', '2021-12-17', 'En cours', 1, NULL, NULL),
(2, '15', '2', 'G2', 2, 3, '2021-12-14', '2021-12-17', 'En cours', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mode_financements`
--

CREATE TABLE `mode_financements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mode_financements`
--

INSERT INTO `mode_financements` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Virement banquaire', NULL, NULL),
(2, 'Chèque', NULL, NULL),
(3, 'Espece', NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `moduleformation`
-- (See below for the actual view)
--
CREATE TABLE `moduleformation` (
`module_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`prix` int(11)
,`duree` int(11)
,`modalite_formation` varchar(255)
,`duree_jour` int(11)
,`objectif` varchar(255)
,`prerequis` varchar(255)
,`description` text
,`materiel_necessaire` varchar(255)
,`cible` varchar(255)
,`niveau_id` bigint(20)
,`niveau` varchar(191)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`domaine_id` int(11)
,`cfp_id` bigint(20)
,`nom` varchar(191)
,`logo` varchar(191)
,`email` varchar(191)
,`telephone` varchar(10)
,`pourcentage` decimal(28,1)
);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reference` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formation_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `prix` int(11) NOT NULL,
  `duree` int(11) NOT NULL,
  `duree_jour` int(11) NOT NULL,
  `prerequis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modalite_formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_id` bigint(20) NOT NULL,
  `materiel_necessaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cible` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `reference`, `nom_module`, `formation_id`, `created_at`, `updated_at`, `prix`, `duree`, `duree_jour`, `prerequis`, `objectif`, `modalite_formation`, `description`, `niveau_id`, `materiel_necessaire`, `cible`, `status`) VALUES
(2, 'MOD_EX02', 'NII.Calculs et Fonctions', 1, NULL, NULL, 300000, 12, 4, '', '', '', '', 1, 'pc', 'RH', 1),
(3, 'MOD_EX03', 'NIII.Organisation et gestion des données', 1, NULL, NULL, 300000, 12, 4, '', '', '', '', 1, 'pc', 'RH', 1),
(4, 'MOD_EX04', 'NIV.Business Intelligence', 1, NULL, NULL, 350000, 12, 4, '', '', '', '', 1, 'pc', 'RH', 1),
(5, 'MOD_EX05', 'NV.VBA', 1, NULL, NULL, 450000, 18, 4, '', '', '', '', 1, 'pc', 'RH', 1),
(6, 'MOD_BI01', 'NI.Fondamentaux', 2, NULL, '2021-08-31 06:07:56', 450000, 18, 5, '', '', '', '', 1, 'pc', 'RH', 1),
(7, 'MOD_BI02', 'NII.Perfectionnement Dax', 2, NULL, NULL, 450000, 18, 5, '', '', '', '', 1, 'pc', 'RH', 1),
(8, 'MOD_BI03', 'NIII.Dataviz et analytics', 2, NULL, NULL, 450000, 18, 5, '', '', '', '', 1, 'pc', 'RH', 1),
(9, 'MOD_EX01', 'NI.Fondamentaux', 1, '2021-09-01 00:25:44', '2022-01-20 10:14:51', 300000, 12, 4, 'prerequis MOD_EX01', 'objectif', 'Presentielle ou a distance', 'formation excel avancee', 1, 'pc,cahier', 'RH,SI', 1);

-- --------------------------------------------------------

--
-- Table structure for table `montant_frais_annexes`
--

CREATE TABLE `montant_frais_annexes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `frais_annexe_id` bigint(20) UNSIGNED NOT NULL,
  `num_facture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#0000FCT',
  `montant` decimal(15,2) DEFAULT 0.00 CHECK (`montant` >= 0),
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_frais_annexe` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `hors_taxe` decimal(15,2) DEFAULT 0.00 CHECK (`hors_taxe` >= 0),
  `qte` int(11) NOT NULL DEFAULT 1,
  `pu` int(11) NOT NULL DEFAULT 1,
  `projet_id` bigint(20) UNSIGNED DEFAULT NULL,
  `cfp_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `niveaux`
--

CREATE TABLE `niveaux` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `niveau` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `niveaux`
--

INSERT INTO `niveaux` (`id`, `niveau`, `created_at`, `updated_at`) VALUES
(1, 'débutant', '2021-12-10 08:29:17', '2021-12-10 08:29:17'),
(2, 'intermédiaire', '2021-12-10 08:29:17', '2021-12-10 08:29:17'),
(3, 'avancé', '2021-12-10 08:29:17', '2021-12-10 08:29:17');

-- --------------------------------------------------------

--
-- Table structure for table `nombre`
--

CREATE TABLE `nombre` (
  `nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nombre`
--

INSERT INTO `nombre` (`nombre`) VALUES
(1),
(2),
(3),
(4),
(5);

-- --------------------------------------------------------

--
-- Table structure for table `objectif_globaux`
--

CREATE TABLE `objectif_globaux` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `but_objectif_id` bigint(20) UNSIGNED NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `objectif_pedagogique`
--

CREATE TABLE `objectif_pedagogique` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `pedagogique_id` bigint(20) UNSIGNED NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participant_groupe`
--

CREATE TABLE `participant_groupe` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `groupe_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `participant_groupe`
--

INSERT INTO `participant_groupe` (`id`, `stagiaire_id`, `groupe_id`, `created_at`, `updated_at`) VALUES
(59, 1, 1, '2022-01-27 09:24:34', '2022-01-27 09:24:34'),
(60, 2, 1, '2022-02-01 09:08:57', '2022-02-01 09:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('vonjitahinaranjelison@gmail.com', '$2y$10$WBvMIOZ4/QLHQOxhGqFXR.WpLHaLWA3TyCEF5h9eymkz/JZ/jeYeK', '2022-02-01 04:42:48');

-- --------------------------------------------------------

--
-- Table structure for table `pedagogique`
--

CREATE TABLE `pedagogique` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pedagogique`
--

INSERT INTO `pedagogique` (`id`, `titre`, `description`, `cfp_id`, `created_at`, `updated_at`) VALUES
(1, '4. METHODE PEDAGOGIQUE', '', 1, NULL, NULL),
(2, '4.1.MOYEN PEDAGOGIQUE', 'Pour une action de formation optimale, nous avons besoin des moyens suivantes :', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plan_formations`
--

CREATE TABLE `plan_formations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `typologie_formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectif_attendu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cout_previsionnel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode_financement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recueil_information_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cfp_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `annee_plan_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `presences`
--

CREATE TABLE `presences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` int(2) NOT NULL,
  `detail_id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `h_entree` time DEFAULT NULL,
  `h_sortie` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programmes`
--

CREATE TABLE `programmes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programmes`
--

INSERT INTO `programmes` (`id`, `titre`, `module_id`, `created_at`, `updated_at`) VALUES
(3, 'Reference', 9, NULL, NULL),
(4, 'Operateur', 9, NULL, NULL),
(5, 'Valeurs', 9, NULL, NULL),
(7, 'Fonctions ', 9, NULL, NULL),
(9, 'Date et heure', 9, NULL, NULL),
(18, 'Validation des donnees', 3, NULL, NULL),
(19, 'Mise en forme conditionnelle', 3, NULL, NULL),
(20, 'Tri et filtre', 3, NULL, NULL),
(23, 'Tableau croise dynamique', 3, NULL, NULL),
(24, 'Graphique', 3, NULL, NULL),
(32, 'Variables', 5, NULL, NULL),
(33, 'Procedures', 5, NULL, NULL),
(34, 'Fonctions', 5, NULL, NULL),
(41, 'Enregistreur macro', 5, NULL, NULL),
(42, 'Boucle', 5, NULL, NULL),
(43, 'Conditions', 5, NULL, NULL),
(44, 'Feuille cellule', 5, NULL, NULL),
(45, 'Boites de dialogue', 5, NULL, NULL),
(46, 'Evenements', 5, NULL, NULL),
(47, 'Formulaire', 5, NULL, NULL),
(48, 'Extraction via une source de donnees', 6, NULL, NULL),
(49, 'Transformation de données ', 6, NULL, NULL),
(50, 'Ajout de colonne', 6, NULL, NULL),
(51, 'Data cleansing', 6, NULL, NULL),
(52, 'Database structure', 6, NULL, NULL),
(53, 'combinaison de requetes', 6, NULL, NULL),
(54, 'Optimisation de traitement de donnees', 6, NULL, NULL),
(55, 'Language M', 6, NULL, NULL),
(56, 'Modelisation de donnees ', 6, NULL, NULL),
(57, 'Notion de table', 6, NULL, NULL),
(58, 'Notion de cle', 6, NULL, NULL),
(59, 'Colonne calculee', 6, NULL, NULL),
(60, 'Mesure', 6, NULL, NULL),
(61, 'Fonctions logiques', 7, NULL, NULL),
(62, 'Fonction agregateur', 7, NULL, NULL),
(63, 'Fonctions statistiques', 7, NULL, NULL),
(64, 'Fonctions iteratives', 7, NULL, NULL),
(65, 'Notion de filtre', 8, NULL, NULL),
(66, 'Interaction des visuels', 8, NULL, NULL),
(67, 'Mise en forme Conditionnelle', 8, NULL, NULL),
(68, 'Tableau', 8, NULL, NULL),
(69, 'Filtre', 8, NULL, NULL),
(70, 'Comparaison', 8, NULL, NULL),
(71, 'Synthèse', 8, NULL, NULL),
(72, 'Visuel d\'indicateur', 8, NULL, NULL),
(73, 'Analyse en fonction de temps', 8, NULL, NULL),
(74, 'Visuel a valeur unique', 8, NULL, NULL),
(75, 'Cartes', 8, NULL, NULL),
(76, 'Test Logique', 2, NULL, NULL),
(77, 'Condition', 2, NULL, NULL),
(78, 'Recupération', 2, NULL, NULL),
(79, 'Segment', 3, NULL, NULL),
(80, 'Extraction de données', 4, NULL, NULL),
(81, 'Transformation de base', 4, NULL, NULL),
(82, 'Combinaison de requêtes', 4, NULL, NULL),
(83, 'Structuration de données', 4, NULL, NULL),
(84, 'AJOUT COLONNE', 4, '2021-10-20 02:36:51', '2021-10-20 02:36:51'),
(88, 'Segment', 3, NULL, NULL),
(89, 'Organisation de données', 4, NULL, NULL),
(90, 'Initiation Dataviz', 6, NULL, NULL),
(91, 'Fonctions filtres', 7, NULL, NULL),
(92, 'Time intelligence', 7, NULL, NULL),
(93, 'Date,time', 7, NULL, NULL),
(94, 'Visuels intelligent', 8, NULL, NULL),
(95, 'Info bulle', 8, NULL, NULL),
(96, 'Insertion d\'objet', 8, NULL, NULL),
(97, 'Format', 8, NULL, NULL),
(98, 'Analytique', 8, NULL, NULL),
(99, 'Fonctions textes', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `projets`
--

CREATE TABLE `projets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_projet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activiter` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projets`
--

INSERT INTO `projets` (`id`, `nom_projet`, `entreprise_id`, `cfp_id`, `status`, `activiter`, `created_at`, `updated_at`) VALUES
(2, '1_TROPIC MAD_10-12-2021', 1, 1, 'En Cours', 1, '2021-12-10 10:41:05', '2021-12-10 10:41:05');

-- --------------------------------------------------------

--
-- Table structure for table `question_evaluations`
--

CREATE TABLE `question_evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `formation_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_evaluations`
--

INSERT INTO `question_evaluations` (`id`, `question`, `cfp_id`, `formation_id`, `created_at`, `updated_at`) VALUES
(1, 'Des commentaires peuvent être ajoutés aux cellules en utilisant?', 1, 1, NULL, NULL),
(2, 'Obtenir des données d’une cellule située dans une autre feuille s’appelle', 1, 1, NULL, NULL),
(3, 'Lequel des éléments suivants n’est pas un type de données valide dans Excel?', 1, 1, NULL, NULL),
(4, 'Quels éléments d’une feuille de calcul peuvent être protégés contre toute modification accidentelle?', 1, 1, NULL, NULL),
(5, 'Une valeur numérique peut être traitée comme valeur d’étiquette s’il est précédé par', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_fille`
--

CREATE TABLE `question_fille` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qst_fille` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type_champs` bigint(20) UNSIGNED NOT NULL,
  `id_qst_mere` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_fille`
--

INSERT INTO `question_fille` (`id`, `qst_fille`, `id_type_champs`, `id_qst_mere`, `created_at`, `updated_at`) VALUES
(1, 'Qualité Globale de la formation', 1, 1, NULL, NULL),
(2, 'Qualité Globale de la formation', 1, 2, NULL, NULL),
(3, 'Les objectifs de la formation ont-ils été clairement annoncés ?', 2, 3, NULL, NULL),
(4, 'Avez-vous eu une discussion avec notre hiérarchie concernant cette formation ?', 2, 3, NULL, NULL),
(5, 'Etes-vous satisfait de l\'organisation du logistique et matériels utilisé (salle,ordinateur,vidéoprojecteur) ?', 2, 4, NULL, NULL),
(6, 'La durée du stage de 12 heures vous a-telle semblé adaptée ?', 2, 4, NULL, NULL),
(7, 'Le formateur étail-il clair et dynamique ?', 2, 5, NULL, NULL),
(8, 'les exercices et activités étaient-ils pertinents ?', 2, 5, NULL, NULL),
(9, 'Le formateur a-t-il adapté la formation aux stagiaires ?', 2, 5, NULL, NULL),
(10, '', 2, 6, NULL, NULL),
(11, 'Le programme étail-il clair et précis ?', 2, 7, NULL, NULL),
(12, 'Le programme étail-il adapté à vos besoins ?', 2, 7, NULL, NULL),
(13, 'Les supports de la formation étaient-ils clairs et utiles ?', 2, 7, NULL, NULL),
(14, 'Les objectifs du programme de formation sont-ils atteints ?', 2, 8, NULL, NULL),
(15, 'Cette formation améliore-t-elle compétences ?', 2, 9, NULL, NULL),
(16, 'Ces nouvelles compétences vont-elles etre applicables dans votre travail ?', 2, 9, NULL, NULL),
(17, '', 2, 10, NULL, NULL),
(18, 'Vos commentaires: ', 3, 10, NULL, NULL),
(19, '', 3, 11, NULL, NULL),
(20, '', 3, 12, NULL, NULL),
(21, '', 3, 13, NULL, NULL),
(22, '', 3, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_mere`
--

CREATE TABLE `question_mere` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qst_mere` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_reponse` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cfp_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `question_mere`
--

INSERT INTO `question_mere` (`id`, `qst_mere`, `desc_reponse`, `cfp_id`, `created_at`, `updated_at`) VALUES
(1, 'Qualité global de la formation', 'Donnez une note sur 10 pour votre évaluation globale de la formation:', 1, NULL, NULL),
(2, 'Qualité pédagoqique du formation', 'Donnez une note sur 10 pour votre évaluation globale de la qualité pédagogique de la formation:', 1, NULL, NULL),
(3, 'Préparation de la formation', 'Cochez une case par ligne', 1, NULL, NULL),
(4, 'Organisation de la formation', 'Cochez une case par ligne', 1, NULL, NULL),
(5, 'Déroulement de la formation', 'Cochez une case par ligne', 1, NULL, NULL),
(6, 'Le rythme de la formation était-il?', '', 1, NULL, NULL),
(7, 'Contenu de la formation', 'Cochez une case par ligne', 1, NULL, NULL),
(8, 'Les objectifs du programme vont-ils atteints', 'Cochez une case par ligne', 1, NULL, NULL),
(9, 'Efficacité de la formation', 'Cochez une case par ligne', 1, NULL, NULL),
(10, 'Recommanderiez-vous cette formation?', '', 1, NULL, NULL),
(11, 'Quels sont vos attentes pour cette formation?', 'Repondre au question', 1, NULL, NULL),
(12, 'Quels sont les points forts de cette formation', 'Repondre au question', 1, NULL, NULL),
(13, 'Quels sont les points faibles de cette formation', 'Repondre au question', 1, NULL, NULL),
(14, 'Autres remarques', 'Repondre au question', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `receuil_informations`
--

CREATE TABLE `receuil_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `duree_formation` bigint(20) UNSIGNED DEFAULT NULL,
  `mois_previsionnelle` bigint(20) UNSIGNED DEFAULT NULL,
  `annee_formation` bigint(20) UNSIGNED DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_demmande` date NOT NULL,
  `formation_id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `annee_plan_id` bigint(20) NOT NULL,
  `typologie_formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectif_attendu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recommandation`
--

CREATE TABLE `recommandation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cfp_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `recommandation`
--

INSERT INTO `recommandation` (`id`, `titre`, `cfp_id`, `created_at`, `updated_at`) VALUES
(1, 'De la part des participants :', 1, NULL, NULL),
(2, 'De la part des formateurs :', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recueil_informations`
--

CREATE TABLE `recueil_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `duree_formation` bigint(20) UNSIGNED DEFAULT NULL,
  `mois_previsionnelle` bigint(20) UNSIGNED DEFAULT NULL,
  `annee_previsionnelle` bigint(20) UNSIGNED DEFAULT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_demande` date NOT NULL,
  `formation_id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `annee_plan_id` bigint(20) NOT NULL,
  `typologie_formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectif_attendu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reponse_evaluationchaud`
--

CREATE TABLE `reponse_evaluationchaud` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reponse_desc_champ` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_desc_champ` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `groupe_id` bigint(20) UNSIGNED NOT NULL,
  `cfp_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reponse_evaluationchaud`
--

INSERT INTO `reponse_evaluationchaud` (`id`, `reponse_desc_champ`, `id_desc_champ`, `stagiaire_id`, `groupe_id`, `cfp_id`, `created_at`, `updated_at`) VALUES
(111, '10', 1, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(112, '3', 2, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(113, 'Insuffisamment', 4, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(114, 'Insuffisamment', 8, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(115, 'Insuffisamment', 12, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(116, 'Insuffisamment', 16, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(117, 'Insuffisamment', 20, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(118, 'Insuffisamment', 24, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(119, 'Insuffisamment', 28, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(120, 'Trop rapide', 32, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(121, 'Insuffisamment', 35, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(122, 'Insuffisamment', 39, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(123, 'Insuffisamment', 43, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(124, 'Insuffisamment', 47, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(125, 'Un peu', 51, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(126, 'Un peu', 54, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(127, 'Non', 57, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(128, 'wrqrw', 58, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(129, 'qwrqw', 59, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(130, 'point fort', 60, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(131, 'werer', 61, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00'),
(132, 'ertr', 62, 1, 1, 1, '2021-12-21 14:14:00', '2021-12-21 14:14:00');

-- --------------------------------------------------------

--
-- Table structure for table `reponse_pour_questions`
--

CREATE TABLE `reponse_pour_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `points` bigint(20) UNSIGNED NOT NULL,
  `demande_tn_id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reponse_pour_questions`
--

INSERT INTO `reponse_pour_questions` (`id`, `points`, `demande_tn_id`, `question_id`, `stagiaire_id`, `created_at`, `updated_at`) VALUES
(6, 0, 1, 1, 1, NULL, NULL),
(7, 0, 1, 2, 1, NULL, NULL),
(8, 0, 1, 3, 1, NULL, NULL),
(9, 0, 1, 4, 1, NULL, NULL),
(10, 0, 1, 5, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `responsables`
--

CREATE TABLE `responsables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_resp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fonction_resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin_resp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `activiter` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `responsables`
--

INSERT INTO `responsables` (`id`, `nom_resp`, `prenom_resp`, `fonction_resp`, `email_resp`, `cin_resp`, `telephone_resp`, `user_id`, `photos`, `entreprise_id`, `activiter`, `created_at`, `updated_at`) VALUES
(1, 'TROPCI', 'laureen', 'Marketing', 'laureen@gmail.com', '0123456789', '0328683725', 5, 'TROPCIlaureen.png', 1, 1, '2021-12-10 05:58:37', '2021-12-10 06:01:55');

-- --------------------------------------------------------

--
-- Table structure for table `ressources`
--

CREATE TABLE `ressources` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text DEFAULT NULL,
  `demandeur` varchar(255) NOT NULL,
  `groupe_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ressources`
--

INSERT INTO `ressources` (`id`, `description`, `demandeur`, `groupe_id`) VALUES
(28, 'un pc par apprenant', 'Numerika Center', 1),
(32, 'zavatra', 'Numerika Center', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2021-10-26 02:45:24', '2021-10-26 02:45:24'),
(2, 'referent', '2021-10-26 02:45:24', '2021-10-26 02:45:24'),
(3, 'stagiaire', '2021-10-26 02:45:24', '2021-10-26 02:45:24'),
(4, 'formateur', '2021-10-26 02:45:24', '2021-10-26 02:45:24'),
(5, 'manager', '2021-11-08 02:47:18', '2021-11-08 02:47:18'),
(6, 'SuperAdmin', '2021-11-09 23:59:59', '2021-11-09 23:59:59'),
(7, 'CFP', '2021-11-22 06:27:38', '2021-11-22 06:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `secteurs`
--

CREATE TABLE `secteurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_secteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `secteurs`
--

INSERT INTO `secteurs` (`id`, `nom_secteur`) VALUES
(1, 'BTP & Ressources stratégiques(BTP/DS)'),
(2, 'Développement Rural(DR)'),
(3, 'Technologies de l\'Information&Communication(TIC)'),
(4, 'Textile,Habillements&Accessoires(THA)'),
(5, 'Tourisme,Hôtellerie&Restauration(THR)'),
(6, 'Multi Sectoriel'),
(7, 'Formation équité MPE');

-- --------------------------------------------------------

--
-- Table structure for table `stagiaires`
--

CREATE TABLE `stagiaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matricule` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre_stagiaire` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fonction_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_stagiaire` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `cin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_etude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activiter` tinyint(1) NOT NULL DEFAULT 1,
  `lieu_travail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stagiaires`
--

INSERT INTO `stagiaires` (`id`, `matricule`, `nom_stagiaire`, `prenom_stagiaire`, `genre_stagiaire`, `fonction_stagiaire`, `mail_stagiaire`, `telephone_stagiaire`, `entreprise_id`, `user_id`, `photos`, `created_at`, `updated_at`, `departement_id`, `cin`, `date_naissance`, `adresse`, `niveau_etude`, `activiter`, `lieu_travail`) VALUES
(1, 'ETU001', 'ANDRIA', 'Laureen', 'femme', 'Marketing', 'laureenparticipant@gmail.com', '0321122233', 1, 8, 'portrait1.jpeg', '2021-12-10 06:34:47', '2021-12-10 06:34:47', 1, '0112345678', '1998-02-26', 'Amboditsiry', 'Bacc+4', 1, 'Antananarivo'),
(2, 'ETU002', 'Rakoto', 'Paul', 'homme', 'DRH', 'paul01@gmail.com', '0332214322', 1, 12, 'RakotoPaulETU002.png', '2022-02-01 06:03:16', '2022-02-01 06:03:16', 3, '099903456542', '2001-06-13', 'Tanjombato', 'Licence', 1, 'Analakely');

-- --------------------------------------------------------

--
-- Table structure for table `stagiaire_pour_test_niveaux`
--

CREATE TABLE `stagiaire_pour_test_niveaux` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `demande_tn_id` bigint(20) UNSIGNED NOT NULL,
  `etat` bigint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stagiaire_pour_test_niveaux`
--

INSERT INTO `stagiaire_pour_test_niveaux` (`id`, `stagiaire_id`, `demande_tn_id`, `etat`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tarif_categories`
--

CREATE TABLE `tarif_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_abonnement_role_id` bigint(20) UNSIGNED NOT NULL,
  `categorie_paiement_id` bigint(20) UNSIGNED NOT NULL,
  `tarif` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pourcent` decimal(5,2) DEFAULT NULL CHECK (`pourcent` >= 0),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxes`
--

INSERT INTO `taxes` (`id`, `description`, `pourcent`, `created_at`, `updated_at`) VALUES
(1, 'TVA', '20.00', '2021-11-23 03:55:50', '2021-11-23 03:55:50'),
(2, 'Hors Taxe', '0.00', '2021-11-23 03:55:50', '2021-11-23 03:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `type_abonnements`
--

CREATE TABLE `type_abonnements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_abonnements`
--

INSERT INTO `type_abonnements` (`id`, `nom_type`, `logo`, `created_at`, `updated_at`) VALUES
(51, 'Premium', 'Premium.png', '2021-11-28 23:54:23', '2021-11-28 23:54:23');

-- --------------------------------------------------------

--
-- Table structure for table `type_abonnement_roles`
--

CREATE TABLE `type_abonnement_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_abonne_id` bigint(20) UNSIGNED NOT NULL,
  `type_abonnement_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_abonnes`
--

CREATE TABLE `type_abonnes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `abonne_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_abonnes`
--

INSERT INTO `type_abonnes` (`id`, `abonne_name`, `created_at`, `updated_at`) VALUES
(1, 'entreprises', '2021-11-23 06:06:31', '2021-11-23 06:06:31'),
(2, 'cfps', '2021-11-23 06:06:31', '2021-11-23 06:06:31');

-- --------------------------------------------------------

--
-- Table structure for table `type_champs`
--

CREATE TABLE `type_champs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_champ` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_champ` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_champs`
--

INSERT INTO `type_champs` (`id`, `nom_champ`, `desc_champ`, `created_at`, `updated_at`) VALUES
(1, 'Champs type Nombre', 'NOMBRE', NULL, NULL),
(2, 'Champs type Case a Cocher', 'CASE', NULL, NULL),
(3, 'Champs type Text ou commentaire', 'TEXT', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type_facture`
--

CREATE TABLE `type_facture` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_facture`
--

INSERT INTO `type_facture` (`id`, `description`, `reference`, `created_at`, `updated_at`) VALUES
(1, 'Facture Définitive', 'Facture', '2021-12-10 08:30:49', '2021-12-10 08:30:49'),
(2, 'Facture d\'Avoir', 'Avoir', '2021-12-10 08:30:49', '2021-12-10 08:30:49'),
(3, 'Facture d\'Acompte', 'Acompte', '2021-12-10 08:30:49', '2021-12-10 08:30:49');

-- --------------------------------------------------------

--
-- Table structure for table `type_payement`
--

CREATE TABLE `type_payement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_payement`
--

INSERT INTO `type_payement` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'FP', NULL, NULL),
(2, 'FMFP', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Nicole', 'nicrah16@gmail.com', NULL, '$2y$10$9i0uUmJpIwVtYX1dlEdM5.bNcYXU8CrD8QXDS5loPVAurII6BmbFm', NULL, '2021-08-04 02:53:44', '2021-08-04 02:53:44', 6),
(2, 'Numerika Center', 'contact@numerika.center', NULL, '$2y$10$Yaj3PRRMUR9IG9FzMV6TNuvv4qrn1LpqyYRMeTQeDA/SHCpKZ4EQi', NULL, '2021-12-10 05:46:44', '2021-12-10 05:46:44', 7),
(5, 'TROPCI', 'laureen@gmail.com', NULL, '$2y$10$uvEdkJFRtQ3z2eWGbcayS.U/o9WrcAcgpEpvOe1NadcFXBa2W8hmu', NULL, '2021-12-10 05:58:37', '2021-12-10 06:01:55', 2),
(6, 'ANDRIA', 'laureen@gmail.com', NULL, '$2y$10$VDJw/cSp4JvtoHTkxKUAg.u2dkGhSRB6mv9lgwI0zNRDYZ9PGn5ne', NULL, '2021-12-10 06:27:39', '2021-12-10 06:27:39', 3),
(8, 'ANDRIA', 'laureenparticipant@gmail.com', NULL, '$2y$10$xIQK6JGizBj6Kw.S4QKM.OX0.i7piMYFMkjTtCkBWQpjjEPZRIsp2', NULL, '2021-12-10 06:34:47', '2021-12-10 06:34:47', 3),
(9, 'Foramteur', 'vonjitahinaranjelison@gmail.com', NULL, '$2y$10$Zn09Yn/kpdUUp3nzW6UhOujne0Q7na.CmKZnHSKUkSstjKYpOKRaa', 'TT3NepjY1v2jXHSCRMgvqq68QP4WvZpp3Kc9lhTOaxsfu9Uk8bYxUZDyl4IN', '2021-12-10 08:45:18', '2021-12-17 04:25:45', 4),
(10, 'RAKOTO', 'rakotopaul@gmail.com', NULL, '$2y$10$mX7J8I.5w7KnU0XN1x0QBu04NFKcghWlPLPAdbsy6veUOrI/Z2rW2', NULL, '2021-12-13 03:30:28', '2021-12-13 03:30:28', 5),
(11, 'Andrianiaina Fernand', 'andria95@gmail.com', NULL, '$2y$10$0r0/7dmJ79ZpWmdFP1/JoOfxdNwsNr4HytmWAUpmLcoqlFPNOlTNm', NULL, '2022-02-01 04:54:59', '2022-02-01 04:54:59', 4),
(12, 'Rakoto', 'paul01@gmail.com', NULL, '$2y$10$NuD3p.6rdTnLLGxVdKLAFeoiFOB5QfB56Dw6USEt./hpD5ZFCRpAS', NULL, '2022-02-01 06:03:16', '2022-02-01 06:03:16', 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_acompte_facture`
-- (See below for the actual view)
--
CREATE TABLE `v_acompte_facture` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`num_facture` varchar(255)
,`montant_brut_ht` decimal(38,2)
,`remise` decimal(36,4)
,`net_commercial` decimal(41,4)
,`net_ht` decimal(41,4)
,`tva` decimal(50,10)
,`net_ttc` decimal(51,10)
,`type_facture_id` bigint(20) unsigned
,`description_type_facture` varchar(255)
,`reference_type_facture` varchar(255)
,`due_date` date
,`invoice_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_avant_dernier_encaissement`
-- (See below for the actual view)
--
CREATE TABLE `v_avant_dernier_encaissement` (
`cfp_id` bigint(20)
,`num_facture` varchar(255)
,`net_ttc` decimal(51,10)
,`rest_payer` decimal(65,10)
,`payement` decimal(37,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_avis`
-- (See below for the actual view)
--
CREATE TABLE `v_avis` (
`module_id` bigint(20) unsigned
,`pourcentage` decimal(5,1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_categorie_abonnements_cfp`
-- (See below for the actual view)
--
CREATE TABLE `v_categorie_abonnements_cfp` (
`type_abonnement_role_id` bigint(20) unsigned
,`type_abonne_id` bigint(20) unsigned
,`type_abonnement_id` bigint(20) unsigned
,`abonnement_id` bigint(20) unsigned
,`date_demande` date
,`date_debut` date
,`date_fin` date
,`status` varchar(191)
,`cfp_id` bigint(20) unsigned
,`categorie_paiement_id` bigint(20) unsigned
,`categorie` varchar(191)
,`tarif` decimal(10,2)
,`nom_type` varchar(191)
,`Logo` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_categorie_abonnement_etp`
-- (See below for the actual view)
--
CREATE TABLE `v_categorie_abonnement_etp` (
`type_abonnement_role_id` bigint(20) unsigned
,`type_abonne_id` bigint(20) unsigned
,`type_abonnement_id` bigint(20) unsigned
,`abonnement_id` bigint(20) unsigned
,`date_demande` date
,`date_debut` date
,`date_fin` date
,`status` varchar(191)
,`entreprise_id` bigint(20) unsigned
,`categorie_paiement_id` bigint(20)
,`categorie` varchar(191)
,`tarif` decimal(10,2)
,`nom_type` varchar(191)
,`Logo` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_compte_facture_actif`
-- (See below for the actual view)
--
CREATE TABLE `v_compte_facture_actif` (
`cfp_id` bigint(20)
,`totale` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_compte_facture_en_cour`
-- (See below for the actual view)
--
CREATE TABLE `v_compte_facture_en_cour` (
`cfp_id` bigint(20)
,`totale` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_compte_facture_inactif`
-- (See below for the actual view)
--
CREATE TABLE `v_compte_facture_inactif` (
`cfp_id` bigint(20)
,`totale` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_compte_facture_payer`
-- (See below for the actual view)
--
CREATE TABLE `v_compte_facture_payer` (
`cfp_id` bigint(20)
,`totale` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_coursfroidevaluation`
-- (See below for the actual view)
--
CREATE TABLE `v_coursfroidevaluation` (
`cours_id` bigint(20) unsigned
,`titre_cours` varchar(255)
,`programme_id` bigint(20) unsigned
,`status` varchar(255)
,`cfp_id` bigint(20) unsigned
,`projet_id` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
,`matricule` varchar(25)
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`fonction_stagiaire` varchar(255)
,`genre_stagiaire` varchar(100)
,`mail_stagiaire` varchar(255)
,`telephone_stagiaire` varchar(10)
,`user_id` bigint(20) unsigned
,`photos` varchar(255)
,`departement_id` bigint(20) unsigned
,`cin` varchar(255)
,`date_naissance` varchar(255)
,`adresse` varchar(255)
,`niveau_etude` varchar(255)
,`activiter_stagiaire` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_cours_programme`
-- (See below for the actual view)
--
CREATE TABLE `v_cours_programme` (
`cours_id` bigint(20) unsigned
,`titre_cours` varchar(255)
,`programme_id` bigint(20) unsigned
,`titre` varchar(255)
,`module_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`formation_id` bigint(20) unsigned
,`prix` int(11)
,`duree` int(11)
,`prerequis` varchar(255)
,`objectif` varchar(255)
,`modalite_formation` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_date_formation`
-- (See below for the actual view)
--
CREATE TABLE `v_date_formation` (
`lieu` varchar(255)
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`date_debut` date
,`date_fin` date
,`cfp_id` bigint(20) unsigned
,`status` varchar(100)
,`activiter` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_demmande_cfp_etp`
-- (See below for the actual view)
--
CREATE TABLE `v_demmande_cfp_etp` (
`activiter_demande` tinyint(1)
,`cfp_id` bigint(20) unsigned
,`nom` varchar(191)
,`adresse_lot` varchar(191)
,`adresse_ville` varchar(191)
,`adresse_region` varchar(191)
,`email` varchar(191)
,`telephone` varchar(10)
,`domaine_de_formation` varchar(191)
,`nif_cfp` varchar(191)
,`stat_cfp` varchar(191)
,`rcs_cfp` varchar(191)
,`cif_cfp` varchar(191)
,`logo_cfp` varchar(191)
,`activiter_cfp` tinyint(1)
,`site_cfp` varchar(255)
,`user_id_cfp` bigint(20) unsigned
,`entreprise_id` bigint(20) unsigned
,`nom_etp` varchar(200)
,`adresse` varchar(255)
,`logo_etp` varchar(255)
,`nif_etp` varchar(255)
,`stat_etp` varchar(255)
,`cif_etp` varchar(255)
,`rcs_etp` varchar(255)
,`secteur_id` bigint(20) unsigned
,`email_etp` varchar(191)
,`site_etp` varchar(191)
,`activer_etp` tinyint(1)
,`telephone_etp` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_demmande_cfp_formateur`
-- (See below for the actual view)
--
CREATE TABLE `v_demmande_cfp_formateur` (
`activiter_demande` tinyint(1)
,`cfp_id` bigint(20) unsigned
,`nom` varchar(191)
,`adresse_lot` varchar(191)
,`adresse_ville` varchar(191)
,`adresse_region` varchar(191)
,`email` varchar(191)
,`telephone` varchar(10)
,`domaine_de_formation` varchar(191)
,`nif` varchar(191)
,`stat` varchar(191)
,`rcs` varchar(191)
,`cif` varchar(191)
,`logo` varchar(191)
,`activiter_cfp` tinyint(1)
,`site_cfp` varchar(255)
,`user_id_cfp` bigint(20) unsigned
,`formateur_id` bigint(20) unsigned
,`nom_formateur` varchar(191)
,`prenom_formateur` varchar(191)
,`mail_formateur` varchar(191)
,`numero_formateur` varchar(191)
,`photos` varchar(191)
,`genre` varchar(255)
,`date_naissance` varchar(255)
,`adresse` varchar(255)
,`cin` varchar(255)
,`specialite` varchar(255)
,`niveau` varchar(255)
,`activiter_formateur` tinyint(1)
,`user_id_formateur` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_demmande_cfp_pour_etp`
-- (See below for the actual view)
--
CREATE TABLE `v_demmande_cfp_pour_etp` (
`id` bigint(20) unsigned
,`activiter_` tinyint(1)
,`inviter_etp_id` bigint(20) unsigned
,`nom_etp` varchar(200)
,`adresse_etp` varchar(255)
,`logo_etp` varchar(255)
,`nif_etp` varchar(255)
,`nif_stat` varchar(255)
,`nif_rcs` varchar(255)
,`cif_rcs` varchar(255)
,`secteur_id` bigint(20) unsigned
,`secteur_activite` varchar(255)
,`jours` int(7)
,`attente` varchar(15)
,`date_demmande` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_demmande_cfp_pour_formateur`
-- (See below for the actual view)
--
CREATE TABLE `v_demmande_cfp_pour_formateur` (
`id` bigint(20) unsigned
,`demmandeur_cfp_id` bigint(20) unsigned
,`inviter_formateur_id` bigint(20) unsigned
,`nom_formateur` varchar(191)
,`prenom_formateur` varchar(191)
,`mail_formateur` varchar(191)
,`photo_formateur` varchar(191)
,`adresse_formateur` varchar(255)
,`cin_formateur` varchar(255)
,`specialite_formateur` varchar(255)
,`niveau_formateur` varchar(255)
,`numero_formateur` varchar(191)
,`jours` int(7)
,`attente` varchar(15)
,`date_demmande` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_demmande_etp_cfp`
-- (See below for the actual view)
--
CREATE TABLE `v_demmande_etp_cfp` (
`activiter_demande` tinyint(1)
,`cfp_id` bigint(20) unsigned
,`nom` varchar(191)
,`adresse_lot` varchar(191)
,`adresse_ville` varchar(191)
,`adresse_region` varchar(191)
,`email` varchar(191)
,`telephone` varchar(10)
,`domaine_de_formation` varchar(191)
,`nif_cfp` varchar(191)
,`stat_cfp` varchar(191)
,`rcs_cfp` varchar(191)
,`cif_cfp` varchar(191)
,`logo_cfp` varchar(191)
,`activiter_cfp` tinyint(1)
,`site_cfp` varchar(255)
,`user_id_cfp` bigint(20) unsigned
,`entreprise_id` bigint(20) unsigned
,`nom_etp` varchar(200)
,`adresse` varchar(255)
,`logo_etp` varchar(255)
,`nif_etp` varchar(255)
,`stat_etp` varchar(255)
,`cif_etp` varchar(255)
,`rcs_etp` varchar(255)
,`secteur_id` bigint(20) unsigned
,`email_etp` varchar(191)
,`site_etp` varchar(191)
,`activer_etp` tinyint(1)
,`telephone_etp` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_demmande_etp_pour_cfp`
-- (See below for the actual view)
--
CREATE TABLE `v_demmande_etp_pour_cfp` (
`id` bigint(20) unsigned
,`demmandeur_etp_id` bigint(20) unsigned
,`inviter_cfp_id` bigint(20) unsigned
,`nom_cfp` varchar(191)
,`adresse_lot_cfp` varchar(191)
,`adresse_ville_cfp` varchar(191)
,`adresse_region_cfp` varchar(191)
,`mail_cfp` varchar(191)
,`tel_cfp` varchar(10)
,`domaine_de_formation` varchar(191)
,`nif_cfp` varchar(191)
,`stat_cfp` varchar(191)
,`rcs_cfp` varchar(191)
,`cif_cfp` varchar(191)
,`logo_cfp` varchar(191)
,`user_id` bigint(20) unsigned
,`jours` int(7)
,`attente` varchar(15)
,`date_demmande` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_demmande_formateur_cfp`
-- (See below for the actual view)
--
CREATE TABLE `v_demmande_formateur_cfp` (
`activiter_demande` tinyint(1)
,`cfp_id` bigint(20) unsigned
,`nom` varchar(191)
,`adresse_lot` varchar(191)
,`adresse_ville` varchar(191)
,`adresse_region` varchar(191)
,`email` varchar(191)
,`telephone` varchar(10)
,`domaine_de_formation` varchar(191)
,`nif` varchar(191)
,`stat` varchar(191)
,`rcs` varchar(191)
,`cif` varchar(191)
,`logo` varchar(191)
,`activiter_cfp` tinyint(1)
,`site_cfp` varchar(255)
,`user_id_cfp` bigint(20) unsigned
,`formateur_id` bigint(20) unsigned
,`nom_formateur` varchar(191)
,`prenom_formateur` varchar(191)
,`mail_formateur` varchar(191)
,`numero_formateur` varchar(191)
,`photos` varchar(191)
,`genre` varchar(255)
,`date_naissance` varchar(255)
,`adresse` varchar(255)
,`cin` varchar(255)
,`specialite` varchar(255)
,`niveau` varchar(255)
,`activiter_formateur` tinyint(1)
,`user_id_formateur` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_demmande_formateur_pour_cfp`
-- (See below for the actual view)
--
CREATE TABLE `v_demmande_formateur_pour_cfp` (
`id` bigint(20) unsigned
,`demmandeur_formateur_id` bigint(20) unsigned
,`inviter_cfp_id` bigint(20) unsigned
,`nom_cfp` varchar(191)
,`adresse_lot_cfp` varchar(191)
,`adresse_ville_cfp` varchar(191)
,`adresse_region_cfp` varchar(191)
,`mail_cfp` varchar(191)
,`tel_cfp` varchar(10)
,`domaine_de_formation` varchar(191)
,`nif_cfp` varchar(191)
,`stat_cfp` varchar(191)
,`rcs_cfp` varchar(191)
,`cif_cfp` varchar(191)
,`logo_cfp` varchar(191)
,`user_id` bigint(20) unsigned
,`jours` int(7)
,`attente` varchar(15)
,`date_demmande` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_departement`
-- (See below for the actual view)
--
CREATE TABLE `v_departement` (
`departement_id` bigint(20) unsigned
,`entreprise_id` bigint(20) unsigned
,`nom_departement` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_dernier_encaissement`
-- (See below for the actual view)
--
CREATE TABLE `v_dernier_encaissement` (
`cfp_id` bigint(20)
,`num_facture` varchar(255)
,`net_ttc` decimal(51,10)
,`rest_payer` decimal(65,10)
,`montant_facture` decimal(65,10)
,`payement` decimal(37,2)
,`due_date` date
,`invoice_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detailmodule`
-- (See below for the actual view)
--
CREATE TABLE `v_detailmodule` (
`detail_id` bigint(20) unsigned
,`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`formateur_id` bigint(20) unsigned
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`cfp_id` bigint(20) unsigned
,`max_participant` varchar(100)
,`min_participant` varchar(100)
,`nom_groupe` varchar(100)
,`module_id` bigint(20) unsigned
,`date_debut` date
,`date_fin` date
,`status` varchar(100)
,`activiter` tinyint(1)
,`reference` varchar(50)
,`nom_module` varchar(255)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`nom_formateur` varchar(191)
,`prenom_formateur` varchar(191)
,`mail_formateur` varchar(191)
,`numero_formateur` varchar(191)
,`nom_projet` varchar(255)
,`entreprise_id` bigint(20) unsigned
,`nom_cfp` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detailmoduleformation`
-- (See below for the actual view)
--
CREATE TABLE `v_detailmoduleformation` (
`detail_id` bigint(20) unsigned
,`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`formateur_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`duree` int(11)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`cfp_id` bigint(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detailmoduleformationprojet`
-- (See below for the actual view)
--
CREATE TABLE `v_detailmoduleformationprojet` (
`detail_id` bigint(20) unsigned
,`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`formateur_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`duree` int(11)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`cfp_id` bigint(20)
,`nom_projet` varchar(255)
,`entreprise_id` bigint(20) unsigned
,`nom_etp` varchar(200)
,`adresse` varchar(255)
,`logo` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detailmoduleformationprojetformateur`
-- (See below for the actual view)
--
CREATE TABLE `v_detailmoduleformationprojetformateur` (
`detail_id` bigint(20) unsigned
,`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`formateur_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`duree` int(11)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`cfp_id` bigint(20)
,`nom_projet` varchar(255)
,`entreprise_id` bigint(20) unsigned
,`nom_etp` varchar(200)
,`adresse` varchar(255)
,`logo` varchar(255)
,`nom_formateur` varchar(191)
,`prenom_formateur` varchar(191)
,`photos` varchar(191)
,`mail_formateur` varchar(191)
,`numero_formateur` varchar(191)
,`genre` varchar(255)
,`date_naissance` varchar(255)
,`adresse_formateur` varchar(255)
,`cin` varchar(255)
,`specialite` varchar(255)
,`niveau` varchar(255)
,`activiter_formateur` tinyint(1)
,`user_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detail_cour`
-- (See below for the actual view)
--
CREATE TABLE `v_detail_cour` (
`detail_id` bigint(20) unsigned
,`cfp_id` bigint(20) unsigned
,`cours_id` bigint(20) unsigned
,`titre_cours` varchar(255)
,`programme_id` bigint(20) unsigned
,`titre_programme` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detail_groupe_module_projet`
-- (See below for the actual view)
--
CREATE TABLE `v_detail_groupe_module_projet` (
`duree` int(11)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`cfp_id` bigint(20)
,`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`detail_id` bigint(20) unsigned
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`module_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`nom_groupe` varchar(100)
,`date_debut` date
,`date_fin` date
,`status_groupe` varchar(100)
,`activiter_groupe` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detail_groupe_stagaire`
-- (See below for the actual view)
--
CREATE TABLE `v_detail_groupe_stagaire` (
`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`detail_id` bigint(20) unsigned
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`module_id` bigint(20) unsigned
,`cfp_id` bigint(20)
,`reference` varchar(50)
,`nom_module` varchar(255)
,`nom_groupe` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_detail_projet_groupe`
-- (See below for the actual view)
--
CREATE TABLE `v_detail_projet_groupe` (
`detail_id` bigint(20) unsigned
,`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`formateur_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`projet_id` bigint(20) unsigned
,`cfp_id` bigint(20) unsigned
,`nom_projet` varchar(255)
,`entreprise_id` bigint(20) unsigned
,`status_projet` varchar(100)
,`activiter_projet` tinyint(1)
,`max_participant` varchar(100)
,`min_participant` varchar(100)
,`nom_groupe` varchar(100)
,`module_id` bigint(20) unsigned
,`date_debut` date
,`date_fin` date
,`status_groupe` varchar(100)
,`activiter_groupe` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_encaissement`
-- (See below for the actual view)
--
CREATE TABLE `v_encaissement` (
`id` bigint(20) unsigned
,`montant_facture` decimal(15,2)
,`libelle` text
,`payement` decimal(15,2)
,`montant_ouvert` decimal(15,2)
,`date_encaissement` timestamp
,`created_at` timestamp
,`updated_at` timestamp
,`num_facture` varchar(255)
,`cfp_id` bigint(20)
,`mode_financement_id` bigint(20) unsigned
,`description` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_entreprise_par_projet`
-- (See below for the actual view)
--
CREATE TABLE `v_entreprise_par_projet` (
`cfp_id` bigint(20) unsigned
,`entreprise_id` bigint(20) unsigned
,`nom_etp` varchar(200)
,`projet_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_evaluation_action_formation`
-- (See below for the actual view)
--
CREATE TABLE `v_evaluation_action_formation` (
`action_formation_id` bigint(20) unsigned
,`titre` varchar(255)
,`pourcent` decimal(5,2)
,`projet_id` bigint(20) unsigned
,`cfp_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_exportcatalogue`
-- (See below for the actual view)
--
CREATE TABLE `v_exportcatalogue` (
`reference` varchar(50)
,`nom_module` varchar(255)
,`prerequis` varchar(255)
,`objectif` varchar(255)
,`modalite_formation` varchar(255)
,`prix` int(11)
,`duree` int(11)
,`nom_formation` varchar(255)
,`domaine_id` int(11)
,`cfp_id` bigint(20)
,`nom_domaine` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_exportparticipant`
-- (See below for the actual view)
--
CREATE TABLE `v_exportparticipant` (
`matricule` varchar(25)
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`fonction_stagiaire` varchar(255)
,`genre_stagiaire` varchar(100)
,`mail_stagiaire` varchar(255)
,`telephone_stagiaire` varchar(10)
,`user_id` bigint(20) unsigned
,`photos` varchar(255)
,`departement_id` bigint(20) unsigned
,`cin` varchar(255)
,`date_naissance` varchar(255)
,`adresse_stagiaire` varchar(255)
,`niveau_etude` varchar(255)
,`activiter_stagiaire` tinyint(1)
,`entreprise_id` bigint(20) unsigned
,`nom_etp` varchar(200)
,`adresse_etp` varchar(255)
,`logo` varchar(255)
,`nif` varchar(255)
,`stat` varchar(255)
,`rcs` varchar(255)
,`cif` varchar(255)
,`secteur_id` bigint(20) unsigned
,`secteur_activite` varchar(255)
,`email_etp` varchar(191)
,`site_etp` varchar(191)
,`activiter_etp` tinyint(1)
,`telephone_etp` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_exportresponsable`
-- (See below for the actual view)
--
CREATE TABLE `v_exportresponsable` (
`nom_resp` varchar(255)
,`prenom_resp` varchar(255)
,`fonction_resp` varchar(255)
,`email_resp` varchar(255)
,`user_id` bigint(20) unsigned
,`activiter_resp` tinyint(1)
,`entreprise_id` bigint(20) unsigned
,`nom_etp` varchar(200)
,`adresse` varchar(255)
,`logo` varchar(255)
,`nif` varchar(255)
,`stat` varchar(255)
,`rcs` varchar(255)
,`cif` varchar(255)
,`secteur_id` bigint(20) unsigned
,`secteur_activite` varchar(255)
,`email_etp` varchar(191)
,`site_etp` varchar(191)
,`activiter_etp` tinyint(1)
,`telephone_etp` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_facture`
-- (See below for the actual view)
--
CREATE TABLE `v_facture` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`num_facture` varchar(255)
,`montant_brut_ht` decimal(38,2)
,`remise` decimal(36,4)
,`net_commercial` decimal(41,4)
,`net_ht` decimal(41,4)
,`tva` decimal(50,10)
,`net_ttc` decimal(51,10)
,`type_facture_id` bigint(20) unsigned
,`description_type_facture` varchar(255)
,`reference_type_facture` varchar(255)
,`due_date` date
,`invoice_date` date
,`sum_acompte` decimal(65,10)
,`rest_payer` decimal(65,10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_facture_actif`
-- (See below for the actual view)
--
CREATE TABLE `v_facture_actif` (
`cfp_id` bigint(20)
,`num_facture` varchar(255)
,`other_message` text
,`totale_jour` int(7)
,`jour_restant` int(7)
,`facture_encour` varchar(8)
,`due_date` date
,`invoice_date` date
,`projet_id` bigint(20) unsigned
,`montant_brut_ht` decimal(38,2)
,`remise` decimal(36,4)
,`net_commercial` decimal(41,4)
,`net_ht` decimal(41,4)
,`tva` decimal(50,10)
,`net_ttc` decimal(51,10)
,`type_facture_id` bigint(20) unsigned
,`reference_type_facture` varchar(255)
,`rest_payer` decimal(65,10)
,`montant_total` decimal(65,10)
,`payement_totale` decimal(37,2)
,`dernier_montant_ouvert` decimal(65,10)
,`date_facture` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_facture_existant`
-- (See below for the actual view)
--
CREATE TABLE `v_facture_existant` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`num_facture` varchar(255)
,`montant_brut_ht` decimal(38,2)
,`remise` decimal(36,4)
,`net_commercial` decimal(41,4)
,`net_ht` decimal(41,4)
,`tva` decimal(50,10)
,`net_ttc` decimal(51,10)
,`type_facture_id` bigint(20) unsigned
,`description_type_facture` varchar(255)
,`reference_type_facture` varchar(255)
,`due_date` date
,`invoice_date` date
,`sum_acompte` decimal(65,10)
,`rest_payer` decimal(65,10)
,`montant_total` decimal(65,10)
,`payement_totale` decimal(37,2)
,`dernier_montant_ouvert` decimal(65,10)
,`date_facture` date
,`facture_encour` varchar(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_facture_existant_tmp`
-- (See below for the actual view)
--
CREATE TABLE `v_facture_existant_tmp` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`num_facture` varchar(255)
,`montant_brut_ht` decimal(38,2)
,`remise` decimal(36,4)
,`net_commercial` decimal(41,4)
,`net_ht` decimal(41,4)
,`tva` decimal(50,10)
,`net_ttc` decimal(51,10)
,`type_facture_id` bigint(20) unsigned
,`description_type_facture` varchar(255)
,`reference_type_facture` varchar(255)
,`due_date` date
,`invoice_date` date
,`sum_acompte` decimal(65,10)
,`rest_payer` decimal(65,10)
,`montant_total` decimal(65,10)
,`payement_totale` decimal(37,2)
,`dernier_montant_ouvert` decimal(65,10)
,`date_facture` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_facture_inactif`
-- (See below for the actual view)
--
CREATE TABLE `v_facture_inactif` (
`cfp_id` bigint(20)
,`num_facture` varchar(255)
,`other_message` text
,`totale_jour` int(7)
,`jour_restant` int(7)
,`facture_encour` varchar(8)
,`due_date` date
,`invoice_date` date
,`projet_id` bigint(20) unsigned
,`montant_brut_ht` decimal(38,2)
,`remise` decimal(36,4)
,`net_commercial` decimal(41,4)
,`net_ht` decimal(41,4)
,`tva` decimal(50,10)
,`net_ttc` decimal(51,10)
,`type_facture_id` bigint(20) unsigned
,`reference_type_facture` varchar(255)
,`rest_payer` decimal(65,10)
,`montant_total` decimal(65,10)
,`payement_totale` decimal(37,2)
,`dernier_montant_ouvert` decimal(65,10)
,`date_facture` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_froid_evaluations`
-- (See below for the actual view)
--
CREATE TABLE `v_froid_evaluations` (
`id` bigint(20) unsigned
,`cfp_id` bigint(20) unsigned
,`cours_id` bigint(20) unsigned
,`status` varchar(255)
,`projet_id` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
,`couleur` varchar(7)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_groupe_projet`
-- (See below for the actual view)
--
CREATE TABLE `v_groupe_projet` (
`cfp_id` bigint(20)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`status_groupe` varchar(100)
,`activiter_groupe` tinyint(1)
,`lieu` varchar(255)
,`projet_id` bigint(20) unsigned
,`nom_projet` varchar(255)
,`groupe_id` bigint(20) unsigned
,`module_id` bigint(20) unsigned
,`nom_module` varchar(255)
,`nom_groupe` varchar(100)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_groupe_projet_entreprise`
-- (See below for the actual view)
--
CREATE TABLE `v_groupe_projet_entreprise` (
`groupe_id` bigint(20) unsigned
,`max_participant` varchar(100)
,`min_participant` varchar(100)
,`nom_groupe` varchar(100)
,`module_id` bigint(20) unsigned
,`date_debut` date
,`date_fin` date
,`status_groupe` varchar(100)
,`activiter_groupe` tinyint(1)
,`projet_id` bigint(20) unsigned
,`nom_projet` varchar(255)
,`date_projet` timestamp
,`totale_session` bigint(21)
,`entreprise_id` bigint(20) unsigned
,`cfp_id` bigint(20) unsigned
,`status` varchar(100)
,`activiter` tinyint(1)
,`created_at` timestamp
,`nom_etp` varchar(200)
,`adresse` varchar(255)
,`logo` varchar(255)
,`nif` varchar(255)
,`stat` varchar(255)
,`rcs` varchar(255)
,`cif` varchar(255)
,`secteur_id` bigint(20) unsigned
,`secteur_activite` varchar(255)
,`email_etp` varchar(191)
,`site_etp` varchar(191)
,`activiter_etp` tinyint(1)
,`telephone_etp` varchar(191)
,`nom_cfp` varchar(191)
,`logo_cfp` varchar(191)
,`adresse_ville_cfp` varchar(191)
,`adresse_region_cfp` varchar(191)
,`email_cfp` varchar(191)
,`telephone_cfp` varchar(10)
,`domaine_de_formation_cfp` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_group_num_facture`
-- (See below for the actual view)
--
CREATE TABLE `v_group_num_facture` (
`cfp_id` bigint(20)
,`num_facture` varchar(255)
,`invoice_date` date
,`due_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_invitation_cfp_pour_etp`
-- (See below for the actual view)
--
CREATE TABLE `v_invitation_cfp_pour_etp` (
`id` bigint(20) unsigned
,`inviter_cfp_id` bigint(20) unsigned
,`demmandeur_etp_id` bigint(20) unsigned
,`nom_etp` varchar(200)
,`adresse_etp` varchar(255)
,`logo_etp` varchar(255)
,`nif_etp` varchar(255)
,`nif_stat` varchar(255)
,`nif_rcs` varchar(255)
,`cif_rcs` varchar(255)
,`secteur_id` bigint(20) unsigned
,`secteur_activite` varchar(255)
,`jours` int(7)
,`attente` varchar(15)
,`date_demmande` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_invitation_cfp_pour_formateur`
-- (See below for the actual view)
--
CREATE TABLE `v_invitation_cfp_pour_formateur` (
`id` bigint(20) unsigned
,`inviter_cfp_id` bigint(20) unsigned
,`demmandeur_formateur_id` bigint(20) unsigned
,`nom_formateur` varchar(191)
,`prenom_formateur` varchar(191)
,`mail_formateur` varchar(191)
,`photo_formateur` varchar(191)
,`adresse_formateur` varchar(255)
,`cin_formateur` varchar(255)
,`specialite_formateur` varchar(255)
,`niveau_formateur` varchar(255)
,`numero_formateur` varchar(191)
,`jours` int(7)
,`attente` varchar(15)
,`date_demmande` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_invitation_etp_pour_cfp`
-- (See below for the actual view)
--
CREATE TABLE `v_invitation_etp_pour_cfp` (
`id` bigint(20) unsigned
,`inviter_etp_id` bigint(20) unsigned
,`demmandeur_cfp_id` bigint(20) unsigned
,`nom_cfp` varchar(191)
,`adresse_lot_cfp` varchar(191)
,`adresse_ville_cfp` varchar(191)
,`adresse_region_cfp` varchar(191)
,`mail_cfp` varchar(191)
,`tel_cfp` varchar(10)
,`domaine_de_formation` varchar(191)
,`nif_cfp` varchar(191)
,`stat_cfp` varchar(191)
,`rcs_cfp` varchar(191)
,`cif_cfp` varchar(191)
,`logo_cfp` varchar(191)
,`user_id` bigint(20) unsigned
,`jours` int(7)
,`attente` varchar(15)
,`date_demmande` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_invitation_formateur_pour_cfp`
-- (See below for the actual view)
--
CREATE TABLE `v_invitation_formateur_pour_cfp` (
`id` bigint(20) unsigned
,`inviter_formateur_id` bigint(20) unsigned
,`demmandeur_cfp_id` bigint(20) unsigned
,`nom_cfp` varchar(191)
,`adresse_lot_cfp` varchar(191)
,`adresse_ville_cfp` varchar(191)
,`adresse_region_cfp` varchar(191)
,`mail_cfp` varchar(191)
,`tel_cfp` varchar(10)
,`domaine_de_formation` varchar(191)
,`nif_cfp` varchar(191)
,`stat_cfp` varchar(191)
,`rcs_cfp` varchar(191)
,`cif_cfp` varchar(191)
,`logo_cfp` varchar(191)
,`user_id` bigint(20) unsigned
,`jours` int(7)
,`attente` varchar(15)
,`date_demmande` timestamp
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_liste_avis`
-- (See below for the actual view)
--
CREATE TABLE `v_liste_avis` (
`module_id` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
,`commentaire` text
,`note` decimal(5,1)
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`date_avis` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_liste_facture`
-- (See below for the actual view)
--
CREATE TABLE `v_liste_facture` (
`cfp_id` bigint(20)
,`facture_id` bigint(20) unsigned
,`projet_id` bigint(20) unsigned
,`nom_projet` varchar(255)
,`entreprise_id` bigint(20) unsigned
,`type_payement_id` bigint(20) unsigned
,`description_type_payement` varchar(100)
,`bon_de_commande` varchar(255)
,`facture` varchar(255)
,`hors_taxe` decimal(15,2)
,`invoice_date` date
,`due_date` date
,`tax_id` bigint(20) unsigned
,`nom_taxe` varchar(255)
,`pourcent` decimal(5,2)
,`description_facture` text
,`other_message` text
,`qte` int(11)
,`num_facture` varchar(255)
,`activiter` tinyint(1)
,`groupe_id` bigint(20) unsigned
,`nom_groupe` varchar(100)
,`pu` int(11)
,`type_financement_id` bigint(20) unsigned
,`description_financement` varchar(255)
,`nom_etp` varchar(200)
,`adresse` varchar(255)
,`logo` varchar(255)
,`reference_bc` varchar(255)
,`remise` int(11)
,`type_facture_id` bigint(20) unsigned
,`description_type_facture` varchar(255)
,`reference_facture` varchar(255)
,`NIF` varchar(255)
,`STAT` varchar(255)
,`RCS` varchar(255)
,`CIF` varchar(255)
,`secteur_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_liste_formateur_projet`
-- (See below for the actual view)
--
CREATE TABLE `v_liste_formateur_projet` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`formateur_id` bigint(20) unsigned
,`nom_projet` varchar(255)
,`nom_formateur` varchar(191)
,`prenom_formateur` varchar(191)
,`photos` varchar(191)
,`mail_formateur` varchar(191)
,`numero_formateur` varchar(191)
,`genre` varchar(255)
,`activiter_formateur` tinyint(1)
,`user_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_liste_stagiaire_groupe`
-- (See below for the actual view)
--
CREATE TABLE `v_liste_stagiaire_groupe` (
`cfp_id` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`groupe_id` bigint(20) unsigned
,`nom_groupe` varchar(100)
,`date_debut` date
,`date_fin` date
,`status_groupe` varchar(100)
,`activiter_groupe` tinyint(1)
,`module_id` bigint(20) unsigned
,`nom_module` varchar(255)
,`reference` varchar(50)
,`projet_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_moduleformation`
-- (See below for the actual view)
--
CREATE TABLE `v_moduleformation` (
`module_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`prix` int(11)
,`duree` int(11)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`cfp_id` bigint(20)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_module_nombre`
-- (See below for the actual view)
--
CREATE TABLE `v_module_nombre` (
`id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`nombre` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_montant_brut_facture`
-- (See below for the actual view)
--
CREATE TABLE `v_montant_brut_facture` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`num_facture` varchar(255)
,`montant_brut_ht` decimal(38,2)
,`due_date` date
,`invoice_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_montant_facture`
-- (See below for the actual view)
--
CREATE TABLE `v_montant_facture` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`num_facture` varchar(255)
,`montant_brut_ht` decimal(38,2)
,`remise` decimal(36,4)
,`net_commercial` decimal(41,4)
,`net_ht` decimal(41,4)
,`tva` decimal(50,10)
,`net_ttc` decimal(51,10)
,`type_facture_id` bigint(20) unsigned
,`description_type_facture` varchar(255)
,`reference_type_facture` varchar(255)
,`due_date` date
,`invoice_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_montant_frais_annexe`
-- (See below for the actual view)
--
CREATE TABLE `v_montant_frais_annexe` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`num_facture` varchar(255)
,`qte_totale` decimal(32,0)
,`hors_taxe` decimal(37,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_montant_pedagogique_facture`
-- (See below for the actual view)
--
CREATE TABLE `v_montant_pedagogique_facture` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`num_facture` varchar(255)
,`qte_totale` decimal(32,0)
,`hors_taxe` decimal(37,2)
,`due_date` date
,`invoice_date` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_moyenne_avis_module`
-- (See below for the actual view)
--
CREATE TABLE `v_moyenne_avis_module` (
`module_id` bigint(20) unsigned
,`moyenne_avis` decimal(31,5)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_nombre_avis_par_module`
-- (See below for the actual view)
--
CREATE TABLE `v_nombre_avis_par_module` (
`module_id` bigint(20) unsigned
,`nombre` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_nombre_note`
-- (See below for the actual view)
--
CREATE TABLE `v_nombre_note` (
`module_id` bigint(20) unsigned
,`note` decimal(5,1)
,`nombre_note` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_notification_demande`
-- (See below for the actual view)
--
CREATE TABLE `v_notification_demande` (
`stagiaire_id` bigint(20) unsigned
,`demande_tn_id` bigint(20) unsigned
,`description_test` text
,`entreprise_id` bigint(20) unsigned
,`cfp_id` bigint(20) unsigned
,`formation_id` bigint(20) unsigned
,`date_creation` date
,`etat` bigint(1)
,`nom_formation` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_notification_test_niveaux`
-- (See below for the actual view)
--
CREATE TABLE `v_notification_test_niveaux` (
`stagiaire_id` bigint(20) unsigned
,`demande_tn_id` bigint(20) unsigned
,`etat` bigint(1)
,`description_test` text
,`entreprise_id` bigint(20) unsigned
,`cfp_id` bigint(20) unsigned
,`formation_id` bigint(20) unsigned
,`date_creation` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_participantsession`
-- (See below for the actual view)
--
CREATE TABLE `v_participantsession` (
`projet_id` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`nom_groupe` varchar(100)
,`date_debut` date
,`date_fin` date
,`status_groupe` varchar(100)
,`activiter_groupe` tinyint(1)
,`matricule` varchar(25)
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`fonction_stagiaire` varchar(255)
,`genre_stagiaire` varchar(100)
,`mail_stagiaire` varchar(255)
,`telephone_stagiaire` varchar(10)
,`user_id` bigint(20) unsigned
,`photos` varchar(255)
,`departement_id` bigint(20) unsigned
,`cin` varchar(255)
,`date_naissance` varchar(255)
,`adresse` varchar(255)
,`niveau_etude` varchar(255)
,`activiter_stagiaire` tinyint(1)
,`nom_projet` varchar(255)
,`entreprise_id` bigint(20) unsigned
,`cfp_id` bigint(20) unsigned
,`status_projet` varchar(100)
,`activiter_projet` tinyint(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_participant_groupe`
-- (See below for the actual view)
--
CREATE TABLE `v_participant_groupe` (
`detail_id` bigint(20) unsigned
,`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`formateur_id` bigint(20) unsigned
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`cfp_id` bigint(20) unsigned
,`max_participant` varchar(100)
,`min_participant` varchar(100)
,`nom_groupe` varchar(100)
,`module_id` bigint(20) unsigned
,`date_debut` date
,`date_fin` date
,`status` varchar(100)
,`activiter` tinyint(1)
,`reference` varchar(50)
,`nom_module` varchar(255)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`nom_formateur` varchar(191)
,`prenom_formateur` varchar(191)
,`mail_formateur` varchar(191)
,`numero_formateur` varchar(191)
,`nom_projet` varchar(255)
,`entreprise_id` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
,`matricule` varchar(25)
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`genre_stagiaire` varchar(100)
,`fonction_stagiaire` varchar(255)
,`mail_stagiaire` varchar(255)
,`telephone_stagiaire` varchar(10)
,`user_id_stagiaire` bigint(20) unsigned
,`photos` varchar(255)
,`departement_id` bigint(20) unsigned
,`cin` varchar(255)
,`date_naissance` varchar(255)
,`adresse` varchar(255)
,`niveau_etude` varchar(255)
,`activiter_stagiaire` tinyint(1)
,`lieu_travail` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pourcentage_avis`
-- (See below for the actual view)
--
CREATE TABLE `v_pourcentage_avis` (
`module_id` bigint(20) unsigned
,`note` int(6)
,`nombre_note` bigint(21)
,`pourcentage_note` decimal(24,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pourcentage_status`
-- (See below for the actual view)
--
CREATE TABLE `v_pourcentage_status` (
`cfp_id` bigint(20) unsigned
,`projet_id` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
,`pourcentage` double
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_pourcent_globale_evaluation_action_formation`
-- (See below for the actual view)
--
CREATE TABLE `v_pourcent_globale_evaluation_action_formation` (
`globale` decimal(6,2)
,`projet_id` bigint(20) unsigned
,`cfp_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_presence_detail`
-- (See below for the actual view)
--
CREATE TABLE `v_presence_detail` (
`status` int(2)
,`detail_id` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
,`matricule` varchar(25)
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`genre_stagiaire` varchar(100)
,`fonction_stagiaire` varchar(255)
,`mail_stagiaire` varchar(255)
,`telephone_stagiaire` varchar(10)
,`user_id_stagiaire` bigint(20) unsigned
,`photos` varchar(255)
,`departement_id` bigint(20) unsigned
,`cin` varchar(255)
,`date_naissance` varchar(255)
,`adresse_stg` varchar(255)
,`niveau_etude` varchar(255)
,`activiter_stagiaire` tinyint(1)
,`lieu_travail` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_programme`
-- (See below for the actual view)
--
CREATE TABLE `v_programme` (
`cfp_id` bigint(20)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`id_module` bigint(20) unsigned
,`nom_module` varchar(255)
,`reference` varchar(50)
,`prix_module` int(11)
,`duree_module` int(11)
,`id_programme` bigint(20) unsigned
,`titre_programme` varchar(255)
,`prerequis` varchar(255)
,`objectif` varchar(255)
,`modalite_formation` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_programme_detail_activiter`
-- (See below for the actual view)
--
CREATE TABLE `v_programme_detail_activiter` (
`detail_id` bigint(20) unsigned
,`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`formateur_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`duree` int(11)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`cfp_id` bigint(20)
,`cours_id` bigint(20) unsigned
,`titre_cours` varchar(255)
,`programme_id` bigint(20) unsigned
,`titre_programme` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_projet`
-- (See below for the actual view)
--
CREATE TABLE `v_projet` (
`id` bigint(20) unsigned
,`nom_projet` varchar(255)
,`entreprise_id` bigint(20) unsigned
,`cfp_id` bigint(20) unsigned
,`status` varchar(100)
,`activiter` tinyint(1)
,`created_at` timestamp
,`updated_at` timestamp
,`nom_etp` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_projetentreprise`
-- (See below for the actual view)
--
CREATE TABLE `v_projetentreprise` (
`projet_id` bigint(20) unsigned
,`nom_projet` varchar(255)
,`date_projet` timestamp
,`totale_session` bigint(21)
,`entreprise_id` bigint(20) unsigned
,`cfp_id` bigint(20) unsigned
,`status` varchar(100)
,`activiter` tinyint(1)
,`created_at` timestamp
,`nom_etp` varchar(200)
,`adresse` varchar(255)
,`logo` varchar(255)
,`nif` varchar(255)
,`stat` varchar(255)
,`rcs` varchar(255)
,`cif` varchar(255)
,`secteur_id` bigint(20) unsigned
,`secteur_activite` varchar(255)
,`email_etp` varchar(191)
,`site_etp` varchar(191)
,`activiter_etp` tinyint(1)
,`telephone_etp` varchar(191)
,`nom_cfp` varchar(191)
,`logo_cfp` varchar(191)
,`adresse_ville_cfp` varchar(191)
,`adresse_region_cfp` varchar(191)
,`email_cfp` varchar(191)
,`telephone_cfp` varchar(10)
,`domaine_de_formation_cfp` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_question_fille`
-- (See below for the actual view)
--
CREATE TABLE `v_question_fille` (
`id` bigint(20) unsigned
,`qst_fille` text
,`id_type_champs` bigint(20) unsigned
,`desc_champ` varchar(100)
,`id_qst_mere` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_question_reponse_test_niveau`
-- (See below for the actual view)
--
CREATE TABLE `v_question_reponse_test_niveau` (
`id` bigint(20) unsigned
,`question_id` bigint(20) unsigned
,`reponse` text
,`points` int(11)
,`created_at` timestamp
,`updated_at` timestamp
,`cfp_id` bigint(20) unsigned
,`formation_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_remise_facture`
-- (See below for the actual view)
--
CREATE TABLE `v_remise_facture` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`num_facture` varchar(255)
,`remise` decimal(36,4)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_reponse_evaluationchaud`
-- (See below for the actual view)
--
CREATE TABLE `v_reponse_evaluationchaud` (
`reponse_desc_champ` text
,`id_desc_champ` bigint(20) unsigned
,`desc_champ` text
,`nb_max` int(11)
,`id_qst_fille` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_responsable_entreprise`
-- (See below for the actual view)
--
CREATE TABLE `v_responsable_entreprise` (
`responsable_id` bigint(20) unsigned
,`nom_resp` varchar(255)
,`prenom_resp` varchar(255)
,`fonction_resp` varchar(255)
,`email_resp` varchar(255)
,`cin_resp` varchar(255)
,`telephone_resp` varchar(255)
,`user_id_responsable` bigint(20) unsigned
,`photos` varchar(255)
,`entreprise_id_responsable` bigint(20) unsigned
,`activiter_responsable` tinyint(1)
,`entreprise_id` bigint(20) unsigned
,`nom_etp` varchar(200)
,`adresse_etp` varchar(255)
,`logo_entreprise` varchar(255)
,`nif_etp` varchar(255)
,`stat_etp` varchar(255)
,`rcs_etp` varchar(255)
,`cif_etp` varchar(255)
,`secteur_id_etp` bigint(20) unsigned
,`email_etp` varchar(191)
,`site_etp` varchar(191)
,`activiter_etp` tinyint(1)
,`telephone_etp` varchar(191)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_resultat_test_niveau`
-- (See below for the actual view)
--
CREATE TABLE `v_resultat_test_niveau` (
`total_points` decimal(42,0)
,`nombre_question` bigint(21)
,`pourcentage` decimal(49,4)
,`demande_tn_id` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_stagiaire_entreprise`
-- (See below for the actual view)
--
CREATE TABLE `v_stagiaire_entreprise` (
`stagiaire_id` bigint(20) unsigned
,`matricule` varchar(25)
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`genre_stagiaire` varchar(100)
,`fonction_stagiaire` varchar(255)
,`mail_stagiaire` varchar(255)
,`telephone_stagiaire` varchar(10)
,`entreprise_id` bigint(20) unsigned
,`user_id` bigint(20) unsigned
,`photos` varchar(255)
,`departement_id` bigint(20) unsigned
,`cin` varchar(255)
,`date_naissance` varchar(255)
,`adresse` varchar(255)
,`lieu_travail` varchar(255)
,`niveau_etude` varchar(255)
,`activiter` tinyint(1)
,`nom_etp` varchar(200)
,`nom_departement` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_stagiaire_groupe`
-- (See below for the actual view)
--
CREATE TABLE `v_stagiaire_groupe` (
`groupe_id` bigint(20) unsigned
,`max_participant` varchar(100)
,`min_participant` varchar(100)
,`nom_groupe` varchar(100)
,`projet_id` bigint(20) unsigned
,`module_id` bigint(20) unsigned
,`date_debut` date
,`date_fin` date
,`status` varchar(100)
,`activiter_groupe` tinyint(1)
,`stagiaire_id` bigint(20) unsigned
,`matricule` varchar(25)
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`genre_stagiaire` varchar(100)
,`fonction_stagiaire` varchar(255)
,`mail_stagiaire` varchar(255)
,`telephone_stagiaire` varchar(10)
,`entreprise_id` bigint(20) unsigned
,`user_id` bigint(20) unsigned
,`photos` varchar(255)
,`departement_id` bigint(20) unsigned
,`cin` varchar(255)
,`date_naissance` varchar(255)
,`adresse` varchar(255)
,`niveau_etude` varchar(255)
,`activiter_stagiaire` tinyint(1)
,`lieu_travail` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_statistique_avis`
-- (See below for the actual view)
--
CREATE TABLE `v_statistique_avis` (
`module_id` bigint(20) unsigned
,`nombre` int(11)
,`pourcentage_note` decimal(24,0)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_sum_acompte_facture`
-- (See below for the actual view)
--
CREATE TABLE `v_sum_acompte_facture` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`sum_acompte` decimal(65,10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_sum_encaissement`
-- (See below for the actual view)
--
CREATE TABLE `v_sum_encaissement` (
`cfp_id` bigint(20)
,`num_facture` varchar(255)
,`payement` decimal(37,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_taxe_facture`
-- (See below for the actual view)
--
CREATE TABLE `v_taxe_facture` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`num_facture` varchar(255)
,`pourcent` decimal(5,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_temp_facture`
-- (See below for the actual view)
--
CREATE TABLE `v_temp_facture` (
`cfp_id` bigint(20)
,`num_facture` varchar(255)
,`net_ttc` decimal(51,10)
,`rest_payer` decimal(65,10)
,`montant_facture` decimal(65,10)
,`payement` decimal(37,2)
,`due_date` date
,`invoice_date` date
,`montant_ouvert` decimal(65,10)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_totale_session`
-- (See below for the actual view)
--
CREATE TABLE `v_totale_session` (
`projet_id` bigint(20) unsigned
,`totale_session` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_trie_detail_date`
-- (See below for the actual view)
--
CREATE TABLE `v_trie_detail_date` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_trie_detail_programme`
-- (See below for the actual view)
--
CREATE TABLE `v_trie_detail_programme` (
`cfp_id` bigint(20)
,`projet_id` bigint(20) unsigned
,`programme_id` bigint(20) unsigned
,`titre_programme` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_type_abonnement_role_cfp`
-- (See below for the actual view)
--
CREATE TABLE `v_type_abonnement_role_cfp` (
`type_abonnement_role_id` bigint(20) unsigned
,`type_abonne_id` bigint(20) unsigned
,`type_abonnement_id` bigint(20) unsigned
,`abonnement_id` bigint(20) unsigned
,`date_demande` date
,`date_debut` date
,`date_fin` date
,`status` varchar(191)
,`cfp_id` bigint(20) unsigned
,`categorie_paiement_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_type_abonnement_role_etp`
-- (See below for the actual view)
--
CREATE TABLE `v_type_abonnement_role_etp` (
`type_abonnement_role_id` bigint(20) unsigned
,`type_abonne_id` bigint(20) unsigned
,`type_abonnement_id` bigint(20) unsigned
,`abonnement_id` bigint(20) unsigned
,`date_demande` date
,`date_debut` date
,`date_fin` date
,`status` varchar(191)
,`entreprise_id` bigint(20) unsigned
,`categorie_paiement_id` bigint(20)
);

-- --------------------------------------------------------

--
-- Structure for view `cfpcours`
--
DROP TABLE IF EXISTS `cfpcours`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cfpcours`  AS SELECT `m`.`id` AS `module_id`, `m`.`reference` AS `reference`, `m`.`nom_module` AS `nom_module`, `m`.`prix` AS `prix`, `m`.`duree` AS `duree`, `m`.`modalite_formation` AS `modalite_formation`, `m`.`duree_jour` AS `duree_jour`, `m`.`objectif` AS `objectif`, `m`.`prerequis` AS `prerequis`, `m`.`description` AS `description`, `m`.`materiel_necessaire` AS `materiel_necessaire`, `m`.`cible` AS `cible`, `m`.`niveau_id` AS `niveau_id`, `n`.`niveau` AS `niveau`, `f`.`id` AS `formation_id`, `f`.`nom_formation` AS `nom_formation`, `f`.`domaine_id` AS `domaine_id`, `f`.`cfp_id` AS `cfp_id`, `cfps`.`nom` AS `nom`, `cfps`.`logo` AS `logo`, `cfps`.`email` AS `email`, `cfps`.`telephone` AS `telephone`, `p`.`id` AS `id_programme`, `p`.`titre` AS `titre_programme` FROM ((((`modules` `m` join `formations` `f` on(`m`.`formation_id` = `f`.`id`)) join `cfps` on(`f`.`cfp_id` = `cfps`.`id`)) join `niveaux` `n` on(`n`.`id` = `m`.`niveau_id`)) join `programmes` `p` on(`p`.`module_id` = `m`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `moduleformation`
--
DROP TABLE IF EXISTS `moduleformation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `moduleformation`  AS SELECT `m`.`id` AS `module_id`, `m`.`reference` AS `reference`, `m`.`nom_module` AS `nom_module`, `m`.`prix` AS `prix`, `m`.`duree` AS `duree`, `m`.`modalite_formation` AS `modalite_formation`, `m`.`duree_jour` AS `duree_jour`, `m`.`objectif` AS `objectif`, `m`.`prerequis` AS `prerequis`, `m`.`description` AS `description`, `m`.`materiel_necessaire` AS `materiel_necessaire`, `m`.`cible` AS `cible`, `m`.`niveau_id` AS `niveau_id`, `n`.`niveau` AS `niveau`, `f`.`id` AS `formation_id`, `f`.`nom_formation` AS `nom_formation`, `f`.`domaine_id` AS `domaine_id`, `f`.`cfp_id` AS `cfp_id`, `cfps`.`nom` AS `nom`, `cfps`.`logo` AS `logo`, `cfps`.`email` AS `email`, `cfps`.`telephone` AS `telephone`, round(ifnull(`a`.`moyenne_avis`,0),1) AS `pourcentage` FROM ((((`modules` `m` join `formations` `f` on(`m`.`formation_id` = `f`.`id`)) join `cfps` on(`f`.`cfp_id` = `cfps`.`id`)) join `niveaux` `n` on(`n`.`id` = `m`.`niveau_id`)) left join `v_moyenne_avis_module` `a` on(`m`.`id` = `a`.`module_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_acompte_facture`
--
DROP TABLE IF EXISTS `v_acompte_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_acompte_facture`  AS SELECT `v_montant_facture`.`cfp_id` AS `cfp_id`, `v_montant_facture`.`projet_id` AS `projet_id`, `v_montant_facture`.`num_facture` AS `num_facture`, `v_montant_facture`.`montant_brut_ht` AS `montant_brut_ht`, `v_montant_facture`.`remise` AS `remise`, `v_montant_facture`.`net_commercial` AS `net_commercial`, `v_montant_facture`.`net_ht` AS `net_ht`, `v_montant_facture`.`tva` AS `tva`, `v_montant_facture`.`net_ttc` AS `net_ttc`, `v_montant_facture`.`type_facture_id` AS `type_facture_id`, `v_montant_facture`.`description_type_facture` AS `description_type_facture`, `v_montant_facture`.`reference_type_facture` AS `reference_type_facture`, `v_montant_facture`.`due_date` AS `due_date`, `v_montant_facture`.`invoice_date` AS `invoice_date` FROM `v_montant_facture` WHERE ucase(`v_montant_facture`.`reference_type_facture`) = ucase('acompte') ;

-- --------------------------------------------------------

--
-- Structure for view `v_avant_dernier_encaissement`
--
DROP TABLE IF EXISTS `v_avant_dernier_encaissement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_avant_dernier_encaissement`  AS SELECT `v_facture`.`cfp_id` AS `cfp_id`, `v_facture`.`num_facture` AS `num_facture`, `v_facture`.`net_ttc` AS `net_ttc`, `v_facture`.`rest_payer` AS `rest_payer`, ifnull(`v_sum_encaissement`.`payement`,0) AS `payement` FROM (`v_facture` left join `v_sum_encaissement` on(`v_facture`.`cfp_id` = `v_sum_encaissement`.`cfp_id` and `v_facture`.`num_facture` = `v_sum_encaissement`.`num_facture`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_avis`
--
DROP TABLE IF EXISTS `v_avis`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_avis`  AS SELECT `avis`.`module_id` AS `module_id`, round(avg(`avis`.`note`) / count(`avis`.`module_id`),1) AS `pourcentage` FROM `avis` GROUP BY `avis`.`module_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_categorie_abonnements_cfp`
--
DROP TABLE IF EXISTS `v_categorie_abonnements_cfp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_categorie_abonnements_cfp`  AS SELECT `ta`.`type_abonnement_role_id` AS `type_abonnement_role_id`, `ta`.`type_abonne_id` AS `type_abonne_id`, `ta`.`type_abonnement_id` AS `type_abonnement_id`, `ta`.`abonnement_id` AS `abonnement_id`, `ta`.`date_demande` AS `date_demande`, `ta`.`date_debut` AS `date_debut`, `ta`.`date_fin` AS `date_fin`, `ta`.`status` AS `status`, `ta`.`cfp_id` AS `cfp_id`, `ta`.`categorie_paiement_id` AS `categorie_paiement_id`, `cp`.`categorie` AS `categorie`, `tc`.`tarif` AS `tarif`, `t`.`nom_type` AS `nom_type`, `t`.`logo` AS `Logo` FROM (((`v_type_abonnement_role_cfp` `ta` join `categorie_paiements` `cp` on(`ta`.`categorie_paiement_id` = `cp`.`id`)) join `tarif_categories` `tc` on(`ta`.`type_abonnement_role_id` = `tc`.`type_abonnement_role_id` and `ta`.`categorie_paiement_id` = `tc`.`categorie_paiement_id`)) join `type_abonnements` `t` on(`t`.`id` = `ta`.`type_abonnement_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_categorie_abonnement_etp`
--
DROP TABLE IF EXISTS `v_categorie_abonnement_etp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_categorie_abonnement_etp`  AS SELECT `ta`.`type_abonnement_role_id` AS `type_abonnement_role_id`, `ta`.`type_abonne_id` AS `type_abonne_id`, `ta`.`type_abonnement_id` AS `type_abonnement_id`, `ta`.`abonnement_id` AS `abonnement_id`, `ta`.`date_demande` AS `date_demande`, `ta`.`date_debut` AS `date_debut`, `ta`.`date_fin` AS `date_fin`, `ta`.`status` AS `status`, `ta`.`entreprise_id` AS `entreprise_id`, `ta`.`categorie_paiement_id` AS `categorie_paiement_id`, `cp`.`categorie` AS `categorie`, `tc`.`tarif` AS `tarif`, `t`.`nom_type` AS `nom_type`, `t`.`logo` AS `Logo` FROM (((`v_type_abonnement_role_etp` `ta` join `categorie_paiements` `cp` on(`ta`.`categorie_paiement_id` = `cp`.`id`)) join `tarif_categories` `tc` on(`ta`.`type_abonnement_role_id` = `tc`.`type_abonnement_role_id` and `ta`.`categorie_paiement_id` = `tc`.`categorie_paiement_id`)) join `type_abonnements` `t` on(`t`.`id` = `ta`.`type_abonnement_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_compte_facture_actif`
--
DROP TABLE IF EXISTS `v_compte_facture_actif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_compte_facture_actif`  AS SELECT `v_facture_actif`.`cfp_id` AS `cfp_id`, count(`v_facture_actif`.`num_facture`) AS `totale` FROM `v_facture_actif` GROUP BY `v_facture_actif`.`cfp_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_compte_facture_en_cour`
--
DROP TABLE IF EXISTS `v_compte_facture_en_cour`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_compte_facture_en_cour`  AS SELECT `v_facture_existant`.`cfp_id` AS `cfp_id`, count(`v_facture_existant`.`num_facture`) AS `totale` FROM `v_facture_existant` WHERE `v_facture_existant`.`facture_encour` = 'en_cour' GROUP BY `v_facture_existant`.`cfp_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_compte_facture_inactif`
--
DROP TABLE IF EXISTS `v_compte_facture_inactif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_compte_facture_inactif`  AS SELECT `v_facture_inactif`.`cfp_id` AS `cfp_id`, count(`v_facture_inactif`.`num_facture`) AS `totale` FROM `v_facture_inactif` GROUP BY `v_facture_inactif`.`cfp_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_compte_facture_payer`
--
DROP TABLE IF EXISTS `v_compte_facture_payer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_compte_facture_payer`  AS SELECT `v_facture_existant`.`cfp_id` AS `cfp_id`, count(`v_facture_existant`.`num_facture`) AS `totale` FROM `v_facture_existant` WHERE `v_facture_existant`.`facture_encour` = 'terminer' GROUP BY `v_facture_existant`.`cfp_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_coursfroidevaluation`
--
DROP TABLE IF EXISTS `v_coursfroidevaluation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_coursfroidevaluation`  AS SELECT `c`.`id` AS `cours_id`, `c`.`titre_cours` AS `titre_cours`, `c`.`programme_id` AS `programme_id`, ifnull(`fe`.`status`,0) AS `status`, `fe`.`cfp_id` AS `cfp_id`, `fe`.`projet_id` AS `projet_id`, `fe`.`stagiaire_id` AS `stagiaire_id`, `s`.`matricule` AS `matricule`, `s`.`nom_stagiaire` AS `nom_stagiaire`, `s`.`prenom_stagiaire` AS `prenom_stagiaire`, `s`.`fonction_stagiaire` AS `fonction_stagiaire`, `s`.`genre_stagiaire` AS `genre_stagiaire`, `s`.`mail_stagiaire` AS `mail_stagiaire`, `s`.`telephone_stagiaire` AS `telephone_stagiaire`, `s`.`user_id` AS `user_id`, `s`.`photos` AS `photos`, `s`.`departement_id` AS `departement_id`, `s`.`cin` AS `cin`, `s`.`date_naissance` AS `date_naissance`, `s`.`adresse` AS `adresse`, `s`.`niveau_etude` AS `niveau_etude`, `s`.`activiter` AS `activiter_stagiaire` FROM ((`cours` `c` left join `froid_evaluations` `fe` on(`c`.`id` = `fe`.`cours_id`)) join `stagiaires` `s` on(`fe`.`stagiaire_id` = `s`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_cours_programme`
--
DROP TABLE IF EXISTS `v_cours_programme`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cours_programme`  AS SELECT `c`.`id` AS `cours_id`, `c`.`titre_cours` AS `titre_cours`, `c`.`programme_id` AS `programme_id`, `p`.`titre` AS `titre`, `p`.`module_id` AS `module_id`, `m`.`reference` AS `reference`, `m`.`nom_module` AS `nom_module`, `m`.`formation_id` AS `formation_id`, `m`.`prix` AS `prix`, `m`.`duree` AS `duree`, `m`.`prerequis` AS `prerequis`, `m`.`objectif` AS `objectif`, `m`.`modalite_formation` AS `modalite_formation` FROM ((`cours` `c` left join `programmes` `p` on(`c`.`programme_id` = `p`.`id`)) join `modules` `m` on(`m`.`id` = `p`.`module_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_date_formation`
--
DROP TABLE IF EXISTS `v_date_formation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_date_formation`  AS SELECT `details`.`lieu` AS `lieu`, `groupes`.`projet_id` AS `projet_id`, `details`.`groupe_id` AS `groupe_id`, `groupes`.`date_debut` AS `date_debut`, `groupes`.`date_fin` AS `date_fin`, `details`.`cfp_id` AS `cfp_id`, `groupes`.`status` AS `status`, `groupes`.`activiter` AS `activiter` FROM (`details` join `groupes`) WHERE `details`.`groupe_id` = `groupes`.`id` GROUP BY `groupes`.`projet_id`, `details`.`lieu`, `details`.`groupe_id`, `groupes`.`date_debut`, `groupes`.`date_fin`, `details`.`cfp_id`, `groupes`.`status`, `groupes`.`activiter` ;

-- --------------------------------------------------------

--
-- Structure for view `v_demmande_cfp_etp`
--
DROP TABLE IF EXISTS `v_demmande_cfp_etp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demmande_cfp_etp`  AS SELECT `d`.`activiter` AS `activiter_demande`, `c`.`id` AS `cfp_id`, `c`.`nom` AS `nom`, `c`.`adresse_lot` AS `adresse_lot`, `c`.`adresse_ville` AS `adresse_ville`, `c`.`adresse_region` AS `adresse_region`, `c`.`email` AS `email`, `c`.`telephone` AS `telephone`, `c`.`domaine_de_formation` AS `domaine_de_formation`, `c`.`nif` AS `nif_cfp`, `c`.`stat` AS `stat_cfp`, `c`.`rcs` AS `rcs_cfp`, `c`.`cif` AS `cif_cfp`, `c`.`logo` AS `logo_cfp`, `c`.`activiter` AS `activiter_cfp`, `c`.`site_cfp` AS `site_cfp`, `c`.`user_id` AS `user_id_cfp`, `e`.`id` AS `entreprise_id`, `e`.`nom_etp` AS `nom_etp`, `e`.`adresse` AS `adresse`, `e`.`logo` AS `logo_etp`, `e`.`nif` AS `nif_etp`, `e`.`stat` AS `stat_etp`, `e`.`cif` AS `cif_etp`, `e`.`rcs` AS `rcs_etp`, `e`.`secteur_id` AS `secteur_id`, `e`.`email_etp` AS `email_etp`, `e`.`site_etp` AS `site_etp`, `e`.`activiter` AS `activer_etp`, `e`.`telephone_etp` AS `telephone_etp` FROM ((`demmande_cfp_etp` `d` join `cfps` `c` on(`d`.`demmandeur_cfp_id` = `c`.`id`)) join `entreprises` `e` on(`d`.`inviter_etp_id` = `e`.`id`)) WHERE `d`.`activiter` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `v_demmande_cfp_formateur`
--
DROP TABLE IF EXISTS `v_demmande_cfp_formateur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demmande_cfp_formateur`  AS SELECT `d`.`activiter` AS `activiter_demande`, `c`.`id` AS `cfp_id`, `c`.`nom` AS `nom`, `c`.`adresse_lot` AS `adresse_lot`, `c`.`adresse_ville` AS `adresse_ville`, `c`.`adresse_region` AS `adresse_region`, `c`.`email` AS `email`, `c`.`telephone` AS `telephone`, `c`.`domaine_de_formation` AS `domaine_de_formation`, `c`.`nif` AS `nif`, `c`.`stat` AS `stat`, `c`.`rcs` AS `rcs`, `c`.`cif` AS `cif`, `c`.`logo` AS `logo`, `c`.`activiter` AS `activiter_cfp`, `c`.`site_cfp` AS `site_cfp`, `c`.`user_id` AS `user_id_cfp`, `f`.`id` AS `formateur_id`, `f`.`nom_formateur` AS `nom_formateur`, `f`.`prenom_formateur` AS `prenom_formateur`, `f`.`mail_formateur` AS `mail_formateur`, `f`.`numero_formateur` AS `numero_formateur`, `f`.`photos` AS `photos`, `f`.`genre` AS `genre`, `f`.`date_naissance` AS `date_naissance`, `f`.`adresse` AS `adresse`, `f`.`cin` AS `cin`, `f`.`specialite` AS `specialite`, `f`.`niveau` AS `niveau`, `f`.`activiter` AS `activiter_formateur`, `f`.`user_id` AS `user_id_formateur` FROM ((`demmande_cfp_formateur` `d` join `cfps` `c` on(`c`.`id` = `d`.`demmandeur_cfp_id`)) join `formateurs` `f` on(`f`.`id` = `d`.`inviter_formateur_id`)) WHERE `d`.`activiter` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `v_demmande_cfp_pour_etp`
--
DROP TABLE IF EXISTS `v_demmande_cfp_pour_etp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demmande_cfp_pour_etp`  AS SELECT `demmande_cfp_etp`.`id` AS `id`, `demmande_cfp_etp`.`activiter` AS `activiter_`, `demmande_cfp_etp`.`inviter_etp_id` AS `inviter_etp_id`, `entreprises`.`nom_etp` AS `nom_etp`, `entreprises`.`adresse` AS `adresse_etp`, `entreprises`.`logo` AS `logo_etp`, `entreprises`.`nif` AS `nif_etp`, `entreprises`.`stat` AS `nif_stat`, `entreprises`.`rcs` AS `nif_rcs`, `entreprises`.`cif` AS `cif_rcs`, `entreprises`.`secteur_id` AS `secteur_id`, `secteurs`.`nom_secteur` AS `secteur_activite`, to_days(current_timestamp()) - to_days(`demmande_cfp_etp`.`created_at`) AS `jours`, CASE WHEN to_days(current_timestamp()) - to_days(`demmande_cfp_etp`.`created_at`) > 0 THEN concat(to_days(current_timestamp()) - to_days(`demmande_cfp_etp`.`created_at`),' jour(s)') ELSE 'aujourd\'huit' END AS `attente`, `demmande_cfp_etp`.`created_at` AS `date_demmande` FROM ((`demmande_cfp_etp` join `secteurs`) join `entreprises`) WHERE `demmande_cfp_etp`.`inviter_etp_id` = `entreprises`.`id` AND `entreprises`.`secteur_id` = `secteurs`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_demmande_cfp_pour_formateur`
--
DROP TABLE IF EXISTS `v_demmande_cfp_pour_formateur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demmande_cfp_pour_formateur`  AS SELECT `demmande_cfp_formateur`.`id` AS `id`, `demmande_cfp_formateur`.`demmandeur_cfp_id` AS `demmandeur_cfp_id`, `demmande_cfp_formateur`.`inviter_formateur_id` AS `inviter_formateur_id`, `formateurs`.`nom_formateur` AS `nom_formateur`, `formateurs`.`prenom_formateur` AS `prenom_formateur`, `formateurs`.`mail_formateur` AS `mail_formateur`, `formateurs`.`photos` AS `photo_formateur`, `formateurs`.`adresse` AS `adresse_formateur`, `formateurs`.`cin` AS `cin_formateur`, `formateurs`.`specialite` AS `specialite_formateur`, `formateurs`.`niveau` AS `niveau_formateur`, `formateurs`.`numero_formateur` AS `numero_formateur`, to_days(`demmande_cfp_formateur`.`created_at`) - to_days(current_timestamp()) AS `jours`, CASE WHEN to_days(current_timestamp()) - to_days(`demmande_cfp_formateur`.`created_at`) > 0 THEN concat(to_days(current_timestamp()) - to_days(`demmande_cfp_formateur`.`created_at`),' jour(s)') ELSE 'aujourd\'huit' END AS `attente`, `demmande_cfp_formateur`.`created_at` AS `date_demmande` FROM (`demmande_cfp_formateur` join `formateurs`) WHERE `demmande_cfp_formateur`.`inviter_formateur_id` = `formateurs`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_demmande_etp_cfp`
--
DROP TABLE IF EXISTS `v_demmande_etp_cfp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demmande_etp_cfp`  AS SELECT `d`.`activiter` AS `activiter_demande`, `c`.`id` AS `cfp_id`, `c`.`nom` AS `nom`, `c`.`adresse_lot` AS `adresse_lot`, `c`.`adresse_ville` AS `adresse_ville`, `c`.`adresse_region` AS `adresse_region`, `c`.`email` AS `email`, `c`.`telephone` AS `telephone`, `c`.`domaine_de_formation` AS `domaine_de_formation`, `c`.`nif` AS `nif_cfp`, `c`.`stat` AS `stat_cfp`, `c`.`rcs` AS `rcs_cfp`, `c`.`cif` AS `cif_cfp`, `c`.`logo` AS `logo_cfp`, `c`.`activiter` AS `activiter_cfp`, `c`.`site_cfp` AS `site_cfp`, `c`.`user_id` AS `user_id_cfp`, `e`.`id` AS `entreprise_id`, `e`.`nom_etp` AS `nom_etp`, `e`.`adresse` AS `adresse`, `e`.`logo` AS `logo_etp`, `e`.`nif` AS `nif_etp`, `e`.`stat` AS `stat_etp`, `e`.`cif` AS `cif_etp`, `e`.`rcs` AS `rcs_etp`, `e`.`secteur_id` AS `secteur_id`, `e`.`email_etp` AS `email_etp`, `e`.`site_etp` AS `site_etp`, `e`.`activiter` AS `activer_etp`, `e`.`telephone_etp` AS `telephone_etp` FROM ((`demmande_etp_cfp` `d` join `cfps` `c` on(`d`.`inviter_cfp_id` = `c`.`id`)) join `entreprises` `e` on(`d`.`demmandeur_etp_id` = `e`.`id`)) WHERE `d`.`activiter` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `v_demmande_etp_pour_cfp`
--
DROP TABLE IF EXISTS `v_demmande_etp_pour_cfp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demmande_etp_pour_cfp`  AS SELECT `demmande_etp_cfp`.`id` AS `id`, `demmande_etp_cfp`.`demmandeur_etp_id` AS `demmandeur_etp_id`, `demmande_etp_cfp`.`inviter_cfp_id` AS `inviter_cfp_id`, `cfps`.`nom` AS `nom_cfp`, `cfps`.`adresse_lot` AS `adresse_lot_cfp`, `cfps`.`adresse_ville` AS `adresse_ville_cfp`, `cfps`.`adresse_region` AS `adresse_region_cfp`, `cfps`.`email` AS `mail_cfp`, `cfps`.`telephone` AS `tel_cfp`, `cfps`.`domaine_de_formation` AS `domaine_de_formation`, `cfps`.`nif` AS `nif_cfp`, `cfps`.`stat` AS `stat_cfp`, `cfps`.`rcs` AS `rcs_cfp`, `cfps`.`cif` AS `cif_cfp`, `cfps`.`logo` AS `logo_cfp`, `cfps`.`user_id` AS `user_id`, to_days(`demmande_etp_cfp`.`created_at`) - to_days(current_timestamp()) AS `jours`, CASE WHEN to_days(current_timestamp()) - to_days(`demmande_etp_cfp`.`created_at`) > 0 THEN concat(to_days(current_timestamp()) - to_days(`demmande_etp_cfp`.`created_at`),' jour(s)') ELSE 'aujourd\'huit' END AS `attente`, `demmande_etp_cfp`.`created_at` AS `date_demmande` FROM (`demmande_etp_cfp` join `cfps`) WHERE `demmande_etp_cfp`.`inviter_cfp_id` = `cfps`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_demmande_formateur_cfp`
--
DROP TABLE IF EXISTS `v_demmande_formateur_cfp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demmande_formateur_cfp`  AS SELECT `d`.`activiter` AS `activiter_demande`, `c`.`id` AS `cfp_id`, `c`.`nom` AS `nom`, `c`.`adresse_lot` AS `adresse_lot`, `c`.`adresse_ville` AS `adresse_ville`, `c`.`adresse_region` AS `adresse_region`, `c`.`email` AS `email`, `c`.`telephone` AS `telephone`, `c`.`domaine_de_formation` AS `domaine_de_formation`, `c`.`nif` AS `nif`, `c`.`stat` AS `stat`, `c`.`rcs` AS `rcs`, `c`.`cif` AS `cif`, `c`.`logo` AS `logo`, `c`.`activiter` AS `activiter_cfp`, `c`.`site_cfp` AS `site_cfp`, `c`.`user_id` AS `user_id_cfp`, `f`.`id` AS `formateur_id`, `f`.`nom_formateur` AS `nom_formateur`, `f`.`prenom_formateur` AS `prenom_formateur`, `f`.`mail_formateur` AS `mail_formateur`, `f`.`numero_formateur` AS `numero_formateur`, `f`.`photos` AS `photos`, `f`.`genre` AS `genre`, `f`.`date_naissance` AS `date_naissance`, `f`.`adresse` AS `adresse`, `f`.`cin` AS `cin`, `f`.`specialite` AS `specialite`, `f`.`niveau` AS `niveau`, `f`.`activiter` AS `activiter_formateur`, `f`.`user_id` AS `user_id_formateur` FROM ((`demmande_formateur_cfp` `d` join `cfps` `c` on(`c`.`id` = `d`.`inviter_cfp_id`)) join `formateurs` `f` on(`f`.`id` = `d`.`demmandeur_formateur_id`)) WHERE `d`.`activiter` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `v_demmande_formateur_pour_cfp`
--
DROP TABLE IF EXISTS `v_demmande_formateur_pour_cfp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_demmande_formateur_pour_cfp`  AS SELECT `demmande_formateur_cfp`.`id` AS `id`, `demmande_formateur_cfp`.`demmandeur_formateur_id` AS `demmandeur_formateur_id`, `demmande_formateur_cfp`.`inviter_cfp_id` AS `inviter_cfp_id`, `cfps`.`nom` AS `nom_cfp`, `cfps`.`adresse_lot` AS `adresse_lot_cfp`, `cfps`.`adresse_ville` AS `adresse_ville_cfp`, `cfps`.`adresse_region` AS `adresse_region_cfp`, `cfps`.`email` AS `mail_cfp`, `cfps`.`telephone` AS `tel_cfp`, `cfps`.`domaine_de_formation` AS `domaine_de_formation`, `cfps`.`nif` AS `nif_cfp`, `cfps`.`stat` AS `stat_cfp`, `cfps`.`rcs` AS `rcs_cfp`, `cfps`.`cif` AS `cif_cfp`, `cfps`.`logo` AS `logo_cfp`, `cfps`.`user_id` AS `user_id`, to_days(`demmande_formateur_cfp`.`created_at`) - to_days(current_timestamp()) AS `jours`, CASE WHEN to_days(current_timestamp()) - to_days(`demmande_formateur_cfp`.`created_at`) > 0 THEN concat(to_days(current_timestamp()) - to_days(`demmande_formateur_cfp`.`created_at`),' jour(s)') ELSE 'aujourd\'huit' END AS `attente`, `demmande_formateur_cfp`.`created_at` AS `date_demmande` FROM (`demmande_formateur_cfp` join `cfps`) WHERE `demmande_formateur_cfp`.`inviter_cfp_id` = `cfps`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_departement`
--
DROP TABLE IF EXISTS `v_departement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_departement`  AS SELECT `departement_entreprises`.`departement_id` AS `departement_id`, `departement_entreprises`.`entreprise_id` AS `entreprise_id`, `departements`.`nom_departement` AS `nom_departement` FROM (`departement_entreprises` join `departements`) WHERE `departement_entreprises`.`departement_id` = `departements`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_dernier_encaissement`
--
DROP TABLE IF EXISTS `v_dernier_encaissement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dernier_encaissement`  AS SELECT `v_facture`.`cfp_id` AS `cfp_id`, `v_facture`.`num_facture` AS `num_facture`, `v_facture`.`net_ttc` AS `net_ttc`, `v_facture`.`rest_payer` AS `rest_payer`, CASE WHEN `v_facture`.`num_facture` = `v_avant_dernier_encaissement`.`num_facture` AND `v_facture`.`rest_payer` > 0 THEN `v_facture`.`rest_payer` ELSE `v_facture`.`net_ttc` END AS `montant_facture`, `v_avant_dernier_encaissement`.`payement` AS `payement`, `v_facture`.`due_date` AS `due_date`, `v_facture`.`invoice_date` AS `invoice_date` FROM (`v_facture` join `v_avant_dernier_encaissement` on(`v_avant_dernier_encaissement`.`cfp_id` = `v_facture`.`cfp_id` and `v_avant_dernier_encaissement`.`num_facture` = `v_facture`.`num_facture`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_detailmodule`
--
DROP TABLE IF EXISTS `v_detailmodule`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detailmodule`  AS SELECT `d`.`id` AS `detail_id`, `d`.`lieu` AS `lieu`, `d`.`h_debut` AS `h_debut`, `d`.`h_fin` AS `h_fin`, `d`.`date_detail` AS `date_detail`, `d`.`formateur_id` AS `formateur_id`, `d`.`projet_id` AS `projet_id`, `d`.`groupe_id` AS `groupe_id`, `d`.`cfp_id` AS `cfp_id`, `g`.`max_participant` AS `max_participant`, `g`.`min_participant` AS `min_participant`, `g`.`nom_groupe` AS `nom_groupe`, `g`.`module_id` AS `module_id`, `g`.`date_debut` AS `date_debut`, `g`.`date_fin` AS `date_fin`, `g`.`status` AS `status`, `g`.`activiter` AS `activiter`, `mf`.`reference` AS `reference`, `mf`.`nom_module` AS `nom_module`, `mf`.`formation_id` AS `formation_id`, `mf`.`nom_formation` AS `nom_formation`, `f`.`nom_formateur` AS `nom_formateur`, `f`.`prenom_formateur` AS `prenom_formateur`, `f`.`mail_formateur` AS `mail_formateur`, `f`.`numero_formateur` AS `numero_formateur`, `p`.`nom_projet` AS `nom_projet`, `p`.`entreprise_id` AS `entreprise_id`, `c`.`nom` AS `nom_cfp` FROM (((((`details` `d` join `groupes` `g` on(`d`.`groupe_id` = `g`.`id`)) join `moduleformation` `mf` on(`mf`.`module_id` = `g`.`module_id`)) join `formateurs` `f` on(`f`.`id` = `d`.`formateur_id`)) join `projets` `p` on(`d`.`projet_id` = `p`.`id`)) join `cfps` `c` on(`p`.`cfp_id` = `c`.`id`)) GROUP BY `d`.`id`, `d`.`lieu`, `d`.`h_debut`, `d`.`h_fin`, `d`.`date_detail`, `d`.`formateur_id`, `d`.`projet_id`, `d`.`groupe_id`, `d`.`cfp_id`, `g`.`max_participant`, `g`.`min_participant`, `g`.`nom_groupe`, `g`.`module_id`, `g`.`date_debut`, `g`.`date_fin`, `g`.`status`, `g`.`activiter`, `mf`.`reference`, `mf`.`nom_module`, `mf`.`formation_id`, `mf`.`nom_formation`, `f`.`nom_formateur`, `f`.`prenom_formateur`, `f`.`mail_formateur`, `f`.`numero_formateur`, `p`.`nom_projet`, `c`.`nom`, `p`.`entreprise_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_detailmoduleformation`
--
DROP TABLE IF EXISTS `v_detailmoduleformation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detailmoduleformation`  AS SELECT `d`.`id` AS `detail_id`, `d`.`lieu` AS `lieu`, `d`.`h_debut` AS `h_debut`, `d`.`h_fin` AS `h_fin`, `d`.`date_detail` AS `date_detail`, `d`.`projet_id` AS `projet_id`, `d`.`groupe_id` AS `groupe_id`, `d`.`formateur_id` AS `formateur_id`, `mf`.`reference` AS `reference`, `mf`.`nom_module` AS `nom_module`, `mf`.`duree` AS `duree`, `mf`.`formation_id` AS `formation_id`, `mf`.`nom_formation` AS `nom_formation`, `mf`.`cfp_id` AS `cfp_id` FROM (`details` `d` join `v_moduleformation` `mf`) WHERE `d`.`cfp_id` = `mf`.`cfp_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_detailmoduleformationprojet`
--
DROP TABLE IF EXISTS `v_detailmoduleformationprojet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detailmoduleformationprojet`  AS SELECT `dmf`.`detail_id` AS `detail_id`, `dmf`.`lieu` AS `lieu`, `dmf`.`h_debut` AS `h_debut`, `dmf`.`h_fin` AS `h_fin`, `dmf`.`date_detail` AS `date_detail`, `dmf`.`projet_id` AS `projet_id`, `dmf`.`groupe_id` AS `groupe_id`, `dmf`.`formateur_id` AS `formateur_id`, `dmf`.`reference` AS `reference`, `dmf`.`nom_module` AS `nom_module`, `dmf`.`duree` AS `duree`, `dmf`.`formation_id` AS `formation_id`, `dmf`.`nom_formation` AS `nom_formation`, `dmf`.`cfp_id` AS `cfp_id`, `pe`.`nom_projet` AS `nom_projet`, `pe`.`entreprise_id` AS `entreprise_id`, `pe`.`nom_etp` AS `nom_etp`, `pe`.`adresse` AS `adresse`, `pe`.`logo` AS `logo` FROM (`v_detailmoduleformation` `dmf` join `v_projetentreprise` `pe`) WHERE `dmf`.`projet_id` = `pe`.`projet_id` AND `dmf`.`cfp_id` = `pe`.`cfp_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_detailmoduleformationprojetformateur`
--
DROP TABLE IF EXISTS `v_detailmoduleformationprojetformateur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detailmoduleformationprojetformateur`  AS SELECT `dmfp`.`detail_id` AS `detail_id`, `dmfp`.`lieu` AS `lieu`, `dmfp`.`h_debut` AS `h_debut`, `dmfp`.`h_fin` AS `h_fin`, `dmfp`.`date_detail` AS `date_detail`, `dmfp`.`projet_id` AS `projet_id`, `dmfp`.`groupe_id` AS `groupe_id`, `dmfp`.`formateur_id` AS `formateur_id`, `dmfp`.`reference` AS `reference`, `dmfp`.`nom_module` AS `nom_module`, `dmfp`.`duree` AS `duree`, `dmfp`.`formation_id` AS `formation_id`, `dmfp`.`nom_formation` AS `nom_formation`, `dmfp`.`cfp_id` AS `cfp_id`, `dmfp`.`nom_projet` AS `nom_projet`, `dmfp`.`entreprise_id` AS `entreprise_id`, `dmfp`.`nom_etp` AS `nom_etp`, `dmfp`.`adresse` AS `adresse`, `dmfp`.`logo` AS `logo`, `f`.`nom_formateur` AS `nom_formateur`, `f`.`prenom_formateur` AS `prenom_formateur`, `f`.`photos` AS `photos`, `f`.`mail_formateur` AS `mail_formateur`, `f`.`numero_formateur` AS `numero_formateur`, `f`.`genre` AS `genre`, `f`.`date_naissance` AS `date_naissance`, `f`.`adresse` AS `adresse_formateur`, `f`.`cin` AS `cin`, `f`.`specialite` AS `specialite`, `f`.`niveau` AS `niveau`, `f`.`activiter` AS `activiter_formateur`, `f`.`user_id` AS `user_id` FROM (`v_detailmoduleformationprojet` `dmfp` join `formateurs` `f` on(`dmfp`.`formateur_id` = `f`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_detail_cour`
--
DROP TABLE IF EXISTS `v_detail_cour`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_cour`  AS SELECT `details`.`id` AS `detail_id`, `details`.`cfp_id` AS `cfp_id`, `cour_dans_detail`.`cours_id` AS `cours_id`, `cours`.`titre_cours` AS `titre_cours`, `cour_dans_detail`.`programme_id` AS `programme_id`, `programmes`.`titre` AS `titre_programme` FROM (((`cour_dans_detail` join `details`) join `cours`) join `programmes`) WHERE `cour_dans_detail`.`cours_id` = `cours`.`id` AND `cour_dans_detail`.`programme_id` = `programmes`.`id` AND `cour_dans_detail`.`detail_id` = `details`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_detail_groupe_module_projet`
--
DROP TABLE IF EXISTS `v_detail_groupe_module_projet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_groupe_module_projet`  AS SELECT `v_detailmoduleformation`.`duree` AS `duree`, `v_detailmoduleformation`.`formation_id` AS `formation_id`, `v_detailmoduleformation`.`nom_formation` AS `nom_formation`, `v_detailmoduleformation`.`cfp_id` AS `cfp_id`, `v_detailmoduleformation`.`lieu` AS `lieu`, `v_detailmoduleformation`.`h_debut` AS `h_debut`, `v_detailmoduleformation`.`h_fin` AS `h_fin`, `v_detailmoduleformation`.`date_detail` AS `date_detail`, `v_detailmoduleformation`.`detail_id` AS `detail_id`, `v_detailmoduleformation`.`projet_id` AS `projet_id`, `v_detailmoduleformation`.`groupe_id` AS `groupe_id`, `groupes`.`module_id` AS `module_id`, `v_detailmoduleformation`.`reference` AS `reference`, `v_detailmoduleformation`.`nom_module` AS `nom_module`, `groupes`.`nom_groupe` AS `nom_groupe`, `groupes`.`date_debut` AS `date_debut`, `groupes`.`date_fin` AS `date_fin`, `groupes`.`status` AS `status_groupe`, `groupes`.`activiter` AS `activiter_groupe` FROM (`v_detailmoduleformation` join `groupes`) WHERE `v_detailmoduleformation`.`groupe_id` = `groupes`.`id` AND `v_detailmoduleformation`.`projet_id` = `groupes`.`projet_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_detail_groupe_stagaire`
--
DROP TABLE IF EXISTS `v_detail_groupe_stagaire`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_groupe_stagaire`  AS SELECT `v_detail_groupe_module_projet`.`lieu` AS `lieu`, `v_detail_groupe_module_projet`.`h_debut` AS `h_debut`, `v_detail_groupe_module_projet`.`h_fin` AS `h_fin`, `v_detail_groupe_module_projet`.`date_detail` AS `date_detail`, `v_detail_groupe_module_projet`.`detail_id` AS `detail_id`, `v_detail_groupe_module_projet`.`projet_id` AS `projet_id`, `v_detail_groupe_module_projet`.`groupe_id` AS `groupe_id`, `v_detail_groupe_module_projet`.`module_id` AS `module_id`, `v_detail_groupe_module_projet`.`cfp_id` AS `cfp_id`, `v_detail_groupe_module_projet`.`reference` AS `reference`, `v_detail_groupe_module_projet`.`nom_module` AS `nom_module`, `v_detail_groupe_module_projet`.`nom_groupe` AS `nom_groupe` FROM `v_detail_groupe_module_projet` ;

-- --------------------------------------------------------

--
-- Structure for view `v_detail_projet_groupe`
--
DROP TABLE IF EXISTS `v_detail_projet_groupe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_projet_groupe`  AS SELECT `d`.`id` AS `detail_id`, `d`.`lieu` AS `lieu`, `d`.`h_debut` AS `h_debut`, `d`.`h_fin` AS `h_fin`, `d`.`date_detail` AS `date_detail`, `d`.`formateur_id` AS `formateur_id`, `d`.`groupe_id` AS `groupe_id`, `d`.`projet_id` AS `projet_id`, `d`.`cfp_id` AS `cfp_id`, `p`.`nom_projet` AS `nom_projet`, `p`.`entreprise_id` AS `entreprise_id`, `p`.`status` AS `status_projet`, `p`.`activiter` AS `activiter_projet`, `g`.`max_participant` AS `max_participant`, `g`.`min_participant` AS `min_participant`, `g`.`nom_groupe` AS `nom_groupe`, `g`.`module_id` AS `module_id`, `g`.`date_debut` AS `date_debut`, `g`.`date_fin` AS `date_fin`, `g`.`status` AS `status_groupe`, `g`.`activiter` AS `activiter_groupe` FROM ((`details` `d` join `projets` `p` on(`d`.`projet_id` = `p`.`id`)) join `groupes` `g` on(`d`.`groupe_id` = `g`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_encaissement`
--
DROP TABLE IF EXISTS `v_encaissement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_encaissement`  AS SELECT `encaissements`.`id` AS `id`, `encaissements`.`montant_facture` AS `montant_facture`, `encaissements`.`libelle` AS `libelle`, `encaissements`.`payement` AS `payement`, `encaissements`.`montant_ouvert` AS `montant_ouvert`, `encaissements`.`date_encaissement` AS `date_encaissement`, `encaissements`.`created_at` AS `created_at`, `encaissements`.`updated_at` AS `updated_at`, `encaissements`.`num_facture` AS `num_facture`, `encaissements`.`cfp_id` AS `cfp_id`, `encaissements`.`mode_financement_id` AS `mode_financement_id`, `mf`.`description` AS `description` FROM (`encaissements` join `mode_financements` `mf` on(`encaissements`.`mode_financement_id` = `mf`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_entreprise_par_projet`
--
DROP TABLE IF EXISTS `v_entreprise_par_projet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_entreprise_par_projet`  AS SELECT `v_projet`.`cfp_id` AS `cfp_id`, `v_projet`.`entreprise_id` AS `entreprise_id`, `v_projet`.`nom_etp` AS `nom_etp`, `v_projet`.`id` AS `projet_id` FROM `v_projet` GROUP BY `v_projet`.`cfp_id`, `v_projet`.`entreprise_id`, `v_projet`.`nom_etp`, `v_projet`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_evaluation_action_formation`
--
DROP TABLE IF EXISTS `v_evaluation_action_formation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_evaluation_action_formation`  AS SELECT `evaluation_action_formation`.`id` AS `action_formation_id`, `evaluation_action_formation`.`titre` AS `titre`, `detail_evaluation_action_formation`.`pourcent` AS `pourcent`, `detail_evaluation_action_formation`.`projet_id` AS `projet_id`, `evaluation_action_formation`.`cfp_id` AS `cfp_id` FROM (`detail_evaluation_action_formation` join `evaluation_action_formation`) WHERE `detail_evaluation_action_formation`.`evaluation_action_formation_id` = `evaluation_action_formation`.`id` AND `evaluation_action_formation`.`cfp_id` = `evaluation_action_formation`.`cfp_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_exportcatalogue`
--
DROP TABLE IF EXISTS `v_exportcatalogue`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_exportcatalogue`  AS SELECT `modules`.`reference` AS `reference`, `modules`.`nom_module` AS `nom_module`, `modules`.`prerequis` AS `prerequis`, `modules`.`objectif` AS `objectif`, `modules`.`modalite_formation` AS `modalite_formation`, `modules`.`prix` AS `prix`, `modules`.`duree` AS `duree`, `formations`.`nom_formation` AS `nom_formation`, `formations`.`domaine_id` AS `domaine_id`, `formations`.`cfp_id` AS `cfp_id`, `domaines`.`nom_domaine` AS `nom_domaine` FROM ((`modules` join `formations`) join `domaines`) WHERE `modules`.`formation_id` = `formations`.`id` AND `formations`.`domaine_id` = `domaines`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_exportparticipant`
--
DROP TABLE IF EXISTS `v_exportparticipant`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_exportparticipant`  AS SELECT `s`.`matricule` AS `matricule`, `s`.`nom_stagiaire` AS `nom_stagiaire`, `s`.`prenom_stagiaire` AS `prenom_stagiaire`, `s`.`fonction_stagiaire` AS `fonction_stagiaire`, `s`.`genre_stagiaire` AS `genre_stagiaire`, `s`.`mail_stagiaire` AS `mail_stagiaire`, `s`.`telephone_stagiaire` AS `telephone_stagiaire`, `s`.`user_id` AS `user_id`, `s`.`photos` AS `photos`, `s`.`departement_id` AS `departement_id`, `s`.`cin` AS `cin`, `s`.`date_naissance` AS `date_naissance`, `s`.`adresse` AS `adresse_stagiaire`, `s`.`niveau_etude` AS `niveau_etude`, `s`.`activiter` AS `activiter_stagiaire`, `s`.`entreprise_id` AS `entreprise_id`, `entreprises`.`nom_etp` AS `nom_etp`, `entreprises`.`adresse` AS `adresse_etp`, `entreprises`.`logo` AS `logo`, `entreprises`.`nif` AS `nif`, `entreprises`.`stat` AS `stat`, `entreprises`.`rcs` AS `rcs`, `entreprises`.`cif` AS `cif`, `entreprises`.`secteur_id` AS `secteur_id`, `secteurs`.`nom_secteur` AS `secteur_activite`, `entreprises`.`email_etp` AS `email_etp`, `entreprises`.`site_etp` AS `site_etp`, `entreprises`.`activiter` AS `activiter_etp`, `entreprises`.`telephone_etp` AS `telephone_etp` FROM ((`stagiaires` `s` join `secteurs`) join `entreprises`) WHERE `entreprises`.`id` = `s`.`entreprise_id` AND `entreprises`.`secteur_id` = `secteurs`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_exportresponsable`
--
DROP TABLE IF EXISTS `v_exportresponsable`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_exportresponsable`  AS SELECT `responsables`.`nom_resp` AS `nom_resp`, `responsables`.`prenom_resp` AS `prenom_resp`, `responsables`.`fonction_resp` AS `fonction_resp`, `responsables`.`email_resp` AS `email_resp`, `responsables`.`user_id` AS `user_id`, `responsables`.`activiter` AS `activiter_resp`, `responsables`.`entreprise_id` AS `entreprise_id`, `entreprises`.`nom_etp` AS `nom_etp`, `entreprises`.`adresse` AS `adresse`, `entreprises`.`logo` AS `logo`, `entreprises`.`nif` AS `nif`, `entreprises`.`stat` AS `stat`, `entreprises`.`rcs` AS `rcs`, `entreprises`.`cif` AS `cif`, `entreprises`.`secteur_id` AS `secteur_id`, `secteurs`.`nom_secteur` AS `secteur_activite`, `entreprises`.`email_etp` AS `email_etp`, `entreprises`.`site_etp` AS `site_etp`, `entreprises`.`activiter` AS `activiter_etp`, `entreprises`.`telephone_etp` AS `telephone_etp` FROM ((`responsables` join `secteurs`) join `entreprises`) WHERE `entreprises`.`id` = `responsables`.`entreprise_id` AND `entreprises`.`secteur_id` = `secteurs`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_facture`
--
DROP TABLE IF EXISTS `v_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_facture`  AS SELECT `v_montant_facture`.`cfp_id` AS `cfp_id`, `v_montant_facture`.`projet_id` AS `projet_id`, `v_montant_facture`.`num_facture` AS `num_facture`, `v_montant_facture`.`montant_brut_ht` AS `montant_brut_ht`, `v_montant_facture`.`remise` AS `remise`, `v_montant_facture`.`net_commercial` AS `net_commercial`, `v_montant_facture`.`net_ht` AS `net_ht`, `v_montant_facture`.`tva` AS `tva`, `v_montant_facture`.`net_ttc` AS `net_ttc`, `v_montant_facture`.`type_facture_id` AS `type_facture_id`, `v_montant_facture`.`description_type_facture` AS `description_type_facture`, `v_montant_facture`.`reference_type_facture` AS `reference_type_facture`, `v_montant_facture`.`due_date` AS `due_date`, `v_montant_facture`.`invoice_date` AS `invoice_date`, `v_sum_acompte_facture`.`sum_acompte` AS `sum_acompte`, CASE WHEN `v_montant_facture`.`projet_id` = `v_sum_acompte_facture`.`projet_id` AND ucase(`v_montant_facture`.`reference_type_facture`) = ucase('facture') THEN `v_montant_facture`.`net_ttc`- `v_sum_acompte_facture`.`sum_acompte` ELSE 0 END AS `rest_payer` FROM (`v_montant_facture` left join `v_sum_acompte_facture` on(`v_montant_facture`.`cfp_id` = `v_sum_acompte_facture`.`cfp_id` and `v_montant_facture`.`projet_id` = `v_sum_acompte_facture`.`projet_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_facture_actif`
--
DROP TABLE IF EXISTS `v_facture_actif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_facture_actif`  AS SELECT `factures`.`cfp_id` AS `cfp_id`, `factures`.`num_facture` AS `num_facture`, `factures`.`other_message` AS `other_message`, to_days(`v_facture_existant`.`due_date`) - to_days(`v_facture_existant`.`invoice_date`) AS `totale_jour`, ifnull(to_days(`v_facture_existant`.`due_date`) - to_days(current_timestamp()),0) AS `jour_restant`, `v_facture_existant`.`facture_encour` AS `facture_encour`, `v_facture_existant`.`due_date` AS `due_date`, `v_facture_existant`.`invoice_date` AS `invoice_date`, `v_facture_existant`.`projet_id` AS `projet_id`, `v_facture_existant`.`montant_brut_ht` AS `montant_brut_ht`, `v_facture_existant`.`remise` AS `remise`, `v_facture_existant`.`net_commercial` AS `net_commercial`, `v_facture_existant`.`net_ht` AS `net_ht`, `v_facture_existant`.`tva` AS `tva`, `v_facture_existant`.`net_ttc` AS `net_ttc`, `v_facture_existant`.`type_facture_id` AS `type_facture_id`, `v_facture_existant`.`reference_type_facture` AS `reference_type_facture`, `v_facture_existant`.`rest_payer` AS `rest_payer`, `v_facture_existant`.`montant_total` AS `montant_total`, `v_facture_existant`.`payement_totale` AS `payement_totale`, `v_facture_existant`.`dernier_montant_ouvert` AS `dernier_montant_ouvert`, `v_facture_existant`.`date_facture` AS `date_facture` FROM (`v_facture_existant` join `factures`) WHERE `v_facture_existant`.`cfp_id` = `factures`.`cfp_id` AND `v_facture_existant`.`projet_id` = `factures`.`projet_id` AND `v_facture_existant`.`num_facture` = `factures`.`num_facture` AND `factures`.`activiter` = 1 GROUP BY `factures`.`cfp_id`, `factures`.`num_facture`, `factures`.`other_message`, `v_facture_existant`.`facture_encour`, `v_facture_existant`.`due_date`, `v_facture_existant`.`invoice_date`, `v_facture_existant`.`projet_id`, `v_facture_existant`.`montant_brut_ht`, `v_facture_existant`.`remise`, `v_facture_existant`.`net_commercial`, `v_facture_existant`.`net_ht`, `v_facture_existant`.`tva`, `v_facture_existant`.`net_ttc`, `v_facture_existant`.`type_facture_id`, `v_facture_existant`.`reference_type_facture`, `v_facture_existant`.`rest_payer`, `v_facture_existant`.`montant_total`, `v_facture_existant`.`payement_totale`, `v_facture_existant`.`dernier_montant_ouvert`, `v_facture_existant`.`date_facture` ;

-- --------------------------------------------------------

--
-- Structure for view `v_facture_existant`
--
DROP TABLE IF EXISTS `v_facture_existant`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_facture_existant`  AS SELECT `v_facture_existant_tmp`.`cfp_id` AS `cfp_id`, `v_facture_existant_tmp`.`projet_id` AS `projet_id`, `v_facture_existant_tmp`.`num_facture` AS `num_facture`, `v_facture_existant_tmp`.`montant_brut_ht` AS `montant_brut_ht`, `v_facture_existant_tmp`.`remise` AS `remise`, `v_facture_existant_tmp`.`net_commercial` AS `net_commercial`, `v_facture_existant_tmp`.`net_ht` AS `net_ht`, `v_facture_existant_tmp`.`tva` AS `tva`, `v_facture_existant_tmp`.`net_ttc` AS `net_ttc`, `v_facture_existant_tmp`.`type_facture_id` AS `type_facture_id`, `v_facture_existant_tmp`.`description_type_facture` AS `description_type_facture`, `v_facture_existant_tmp`.`reference_type_facture` AS `reference_type_facture`, `v_facture_existant_tmp`.`due_date` AS `due_date`, `v_facture_existant_tmp`.`invoice_date` AS `invoice_date`, `v_facture_existant_tmp`.`sum_acompte` AS `sum_acompte`, `v_facture_existant_tmp`.`rest_payer` AS `rest_payer`, `v_facture_existant_tmp`.`montant_total` AS `montant_total`, `v_facture_existant_tmp`.`payement_totale` AS `payement_totale`, `v_facture_existant_tmp`.`dernier_montant_ouvert` AS `dernier_montant_ouvert`, `v_facture_existant_tmp`.`date_facture` AS `date_facture`, CASE WHEN `v_facture_existant_tmp`.`payement_totale` - `v_facture_existant_tmp`.`montant_total` < 0 AND `v_facture_existant_tmp`.`payement_totale` <= 0 THEN 'valider' WHEN `v_facture_existant_tmp`.`payement_totale` - `v_facture_existant_tmp`.`montant_total` < 0 AND `v_facture_existant_tmp`.`payement_totale` > 0 THEN 'en_cour' WHEN `v_facture_existant_tmp`.`payement_totale` - `v_facture_existant_tmp`.`montant_total` >= 0 THEN 'terminer' END AS `facture_encour` FROM `v_facture_existant_tmp` ;

-- --------------------------------------------------------

--
-- Structure for view `v_facture_existant_tmp`
--
DROP TABLE IF EXISTS `v_facture_existant_tmp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_facture_existant_tmp`  AS SELECT `v_facture`.`cfp_id` AS `cfp_id`, `v_facture`.`projet_id` AS `projet_id`, `v_facture`.`num_facture` AS `num_facture`, `v_facture`.`montant_brut_ht` AS `montant_brut_ht`, `v_facture`.`remise` AS `remise`, `v_facture`.`net_commercial` AS `net_commercial`, `v_facture`.`net_ht` AS `net_ht`, `v_facture`.`tva` AS `tva`, `v_facture`.`net_ttc` AS `net_ttc`, `v_facture`.`type_facture_id` AS `type_facture_id`, `v_facture`.`description_type_facture` AS `description_type_facture`, `v_facture`.`reference_type_facture` AS `reference_type_facture`, `v_facture`.`due_date` AS `due_date`, `v_facture`.`invoice_date` AS `invoice_date`, `v_facture`.`sum_acompte` AS `sum_acompte`, `v_facture`.`rest_payer` AS `rest_payer`, `v_temp_facture`.`montant_facture` AS `montant_total`, `v_temp_facture`.`payement` AS `payement_totale`, `v_temp_facture`.`montant_ouvert` AS `dernier_montant_ouvert`, `v_temp_facture`.`due_date` AS `date_facture` FROM (`v_facture` join `v_temp_facture`) WHERE `v_facture`.`cfp_id` = `v_temp_facture`.`cfp_id` AND `v_facture`.`num_facture` = `v_temp_facture`.`num_facture` ;

-- --------------------------------------------------------

--
-- Structure for view `v_facture_inactif`
--
DROP TABLE IF EXISTS `v_facture_inactif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_facture_inactif`  AS SELECT `factures`.`cfp_id` AS `cfp_id`, `factures`.`num_facture` AS `num_facture`, `factures`.`other_message` AS `other_message`, to_days(`v_facture_existant`.`due_date`) - to_days(`v_facture_existant`.`invoice_date`) AS `totale_jour`, ifnull(to_days(`v_facture_existant`.`due_date`) - to_days(current_timestamp()),0) AS `jour_restant`, `v_facture_existant`.`facture_encour` AS `facture_encour`, `v_facture_existant`.`due_date` AS `due_date`, `v_facture_existant`.`invoice_date` AS `invoice_date`, `v_facture_existant`.`projet_id` AS `projet_id`, `v_facture_existant`.`montant_brut_ht` AS `montant_brut_ht`, `v_facture_existant`.`remise` AS `remise`, `v_facture_existant`.`net_commercial` AS `net_commercial`, `v_facture_existant`.`net_ht` AS `net_ht`, `v_facture_existant`.`tva` AS `tva`, `v_facture_existant`.`net_ttc` AS `net_ttc`, `v_facture_existant`.`type_facture_id` AS `type_facture_id`, `v_facture_existant`.`reference_type_facture` AS `reference_type_facture`, `v_facture_existant`.`rest_payer` AS `rest_payer`, `v_facture_existant`.`montant_total` AS `montant_total`, `v_facture_existant`.`payement_totale` AS `payement_totale`, `v_facture_existant`.`dernier_montant_ouvert` AS `dernier_montant_ouvert`, `v_facture_existant`.`date_facture` AS `date_facture` FROM (`v_facture_existant` join `factures`) WHERE `v_facture_existant`.`cfp_id` = `factures`.`cfp_id` AND `v_facture_existant`.`projet_id` = `factures`.`projet_id` AND `v_facture_existant`.`num_facture` = `factures`.`num_facture` AND `factures`.`activiter` = 0 GROUP BY `factures`.`cfp_id`, `factures`.`num_facture`, `factures`.`other_message`, `v_facture_existant`.`facture_encour`, `v_facture_existant`.`due_date`, `v_facture_existant`.`invoice_date`, `v_facture_existant`.`projet_id`, `v_facture_existant`.`montant_brut_ht`, `v_facture_existant`.`remise`, `v_facture_existant`.`net_commercial`, `v_facture_existant`.`net_ht`, `v_facture_existant`.`tva`, `v_facture_existant`.`net_ttc`, `v_facture_existant`.`type_facture_id`, `v_facture_existant`.`reference_type_facture`, `v_facture_existant`.`rest_payer`, `v_facture_existant`.`montant_total`, `v_facture_existant`.`payement_totale`, `v_facture_existant`.`dernier_montant_ouvert`, `v_facture_existant`.`date_facture` ;

-- --------------------------------------------------------

--
-- Structure for view `v_froid_evaluations`
--
DROP TABLE IF EXISTS `v_froid_evaluations`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_froid_evaluations`  AS SELECT `froid_evaluations`.`id` AS `id`, `froid_evaluations`.`cfp_id` AS `cfp_id`, `froid_evaluations`.`cours_id` AS `cours_id`, `froid_evaluations`.`status` AS `status`, `froid_evaluations`.`projet_id` AS `projet_id`, `froid_evaluations`.`stagiaire_id` AS `stagiaire_id`, CASE WHEN `froid_evaluations`.`status` = 4 THEN '#018001' WHEN `froid_evaluations`.`status` = 3 THEN '#3CFF01' WHEN `froid_evaluations`.`status` = 2 THEN '#FFE601' WHEN `froid_evaluations`.`status` = 1 THEN '#FF8801' WHEN `froid_evaluations`.`status` = 0 THEN '#FF0000' END AS `couleur` FROM `froid_evaluations` ;

-- --------------------------------------------------------

--
-- Structure for view `v_groupe_projet`
--
DROP TABLE IF EXISTS `v_groupe_projet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_groupe_projet`  AS SELECT `v_detail_groupe_module_projet`.`cfp_id` AS `cfp_id`, `v_detail_groupe_module_projet`.`formation_id` AS `formation_id`, `v_detail_groupe_module_projet`.`nom_formation` AS `nom_formation`, `v_detail_groupe_module_projet`.`status_groupe` AS `status_groupe`, `v_detail_groupe_module_projet`.`activiter_groupe` AS `activiter_groupe`, `v_detail_groupe_module_projet`.`lieu` AS `lieu`, `v_detail_groupe_module_projet`.`projet_id` AS `projet_id`, `projets`.`nom_projet` AS `nom_projet`, `v_detail_groupe_module_projet`.`groupe_id` AS `groupe_id`, `v_detail_groupe_module_projet`.`module_id` AS `module_id`, `v_detail_groupe_module_projet`.`nom_module` AS `nom_module`, `v_detail_groupe_module_projet`.`nom_groupe` AS `nom_groupe` FROM (`v_detail_groupe_module_projet` join `projets`) WHERE `v_detail_groupe_module_projet`.`projet_id` = `projets`.`id` AND `v_detail_groupe_module_projet`.`cfp_id` = `projets`.`cfp_id` GROUP BY `v_detail_groupe_module_projet`.`cfp_id`, `v_detail_groupe_module_projet`.`formation_id`, `v_detail_groupe_module_projet`.`nom_formation`, `v_detail_groupe_module_projet`.`status_groupe`, `v_detail_groupe_module_projet`.`activiter_groupe`, `v_detail_groupe_module_projet`.`lieu`, `v_detail_groupe_module_projet`.`projet_id`, `v_detail_groupe_module_projet`.`groupe_id`, `v_detail_groupe_module_projet`.`module_id`, `v_detail_groupe_module_projet`.`nom_module`, `v_detail_groupe_module_projet`.`nom_groupe`, `projets`.`nom_projet` ;

-- --------------------------------------------------------

--
-- Structure for view `v_groupe_projet_entreprise`
--
DROP TABLE IF EXISTS `v_groupe_projet_entreprise`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_groupe_projet_entreprise`  AS SELECT `g`.`id` AS `groupe_id`, `g`.`max_participant` AS `max_participant`, `g`.`min_participant` AS `min_participant`, `g`.`nom_groupe` AS `nom_groupe`, `g`.`module_id` AS `module_id`, `g`.`date_debut` AS `date_debut`, `g`.`date_fin` AS `date_fin`, `g`.`status` AS `status_groupe`, `g`.`activiter` AS `activiter_groupe`, `vpe`.`projet_id` AS `projet_id`, `vpe`.`nom_projet` AS `nom_projet`, `vpe`.`date_projet` AS `date_projet`, `vpe`.`totale_session` AS `totale_session`, `vpe`.`entreprise_id` AS `entreprise_id`, `vpe`.`cfp_id` AS `cfp_id`, `vpe`.`status` AS `status`, `vpe`.`activiter` AS `activiter`, `vpe`.`created_at` AS `created_at`, `vpe`.`nom_etp` AS `nom_etp`, `vpe`.`adresse` AS `adresse`, `vpe`.`logo` AS `logo`, `vpe`.`nif` AS `nif`, `vpe`.`stat` AS `stat`, `vpe`.`rcs` AS `rcs`, `vpe`.`cif` AS `cif`, `vpe`.`secteur_id` AS `secteur_id`, `vpe`.`secteur_activite` AS `secteur_activite`, `vpe`.`email_etp` AS `email_etp`, `vpe`.`site_etp` AS `site_etp`, `vpe`.`activiter_etp` AS `activiter_etp`, `vpe`.`telephone_etp` AS `telephone_etp`, `vpe`.`nom_cfp` AS `nom_cfp`, `vpe`.`logo_cfp` AS `logo_cfp`, `vpe`.`adresse_ville_cfp` AS `adresse_ville_cfp`, `vpe`.`adresse_region_cfp` AS `adresse_region_cfp`, `vpe`.`email_cfp` AS `email_cfp`, `vpe`.`telephone_cfp` AS `telephone_cfp`, `vpe`.`domaine_de_formation_cfp` AS `domaine_de_formation_cfp` FROM (`groupes` `g` join `v_projetentreprise` `vpe` on(`g`.`projet_id` = `vpe`.`projet_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_group_num_facture`
--
DROP TABLE IF EXISTS `v_group_num_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_group_num_facture`  AS SELECT `factures`.`cfp_id` AS `cfp_id`, `factures`.`num_facture` AS `num_facture`, `factures`.`invoice_date` AS `invoice_date`, `factures`.`due_date` AS `due_date` FROM `factures` GROUP BY `factures`.`cfp_id`, `factures`.`num_facture`, `factures`.`invoice_date`, `factures`.`due_date` ;

-- --------------------------------------------------------

--
-- Structure for view `v_invitation_cfp_pour_etp`
--
DROP TABLE IF EXISTS `v_invitation_cfp_pour_etp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_invitation_cfp_pour_etp`  AS SELECT `demmande_etp_cfp`.`id` AS `id`, `demmande_etp_cfp`.`inviter_cfp_id` AS `inviter_cfp_id`, `demmande_etp_cfp`.`demmandeur_etp_id` AS `demmandeur_etp_id`, `entreprises`.`nom_etp` AS `nom_etp`, `entreprises`.`adresse` AS `adresse_etp`, `entreprises`.`logo` AS `logo_etp`, `entreprises`.`nif` AS `nif_etp`, `entreprises`.`stat` AS `nif_stat`, `entreprises`.`rcs` AS `nif_rcs`, `entreprises`.`cif` AS `cif_rcs`, `entreprises`.`secteur_id` AS `secteur_id`, `secteurs`.`nom_secteur` AS `secteur_activite`, to_days(current_timestamp()) - to_days(`demmande_etp_cfp`.`created_at`) AS `jours`, CASE WHEN to_days(current_timestamp()) - to_days(`demmande_etp_cfp`.`created_at`) > 0 THEN concat(to_days(current_timestamp()) - to_days(`demmande_etp_cfp`.`created_at`),' jour(s)') ELSE 'aujourd\'huit' END AS `attente`, `demmande_etp_cfp`.`created_at` AS `date_demmande` FROM ((`demmande_etp_cfp` join `secteurs`) join `entreprises`) WHERE `demmande_etp_cfp`.`demmandeur_etp_id` = `entreprises`.`id` AND `entreprises`.`secteur_id` = `secteurs`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_invitation_cfp_pour_formateur`
--
DROP TABLE IF EXISTS `v_invitation_cfp_pour_formateur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_invitation_cfp_pour_formateur`  AS SELECT `demmande_formateur_cfp`.`id` AS `id`, `demmande_formateur_cfp`.`inviter_cfp_id` AS `inviter_cfp_id`, `demmande_formateur_cfp`.`demmandeur_formateur_id` AS `demmandeur_formateur_id`, `formateurs`.`nom_formateur` AS `nom_formateur`, `formateurs`.`prenom_formateur` AS `prenom_formateur`, `formateurs`.`mail_formateur` AS `mail_formateur`, `formateurs`.`photos` AS `photo_formateur`, `formateurs`.`adresse` AS `adresse_formateur`, `formateurs`.`cin` AS `cin_formateur`, `formateurs`.`specialite` AS `specialite_formateur`, `formateurs`.`niveau` AS `niveau_formateur`, `formateurs`.`numero_formateur` AS `numero_formateur`, to_days(`demmande_formateur_cfp`.`created_at`) - to_days(current_timestamp()) AS `jours`, CASE WHEN to_days(current_timestamp()) - to_days(`demmande_formateur_cfp`.`created_at`) > 0 THEN concat(to_days(current_timestamp()) - to_days(`demmande_formateur_cfp`.`created_at`),' jour(s)') ELSE 'aujourd\'huit' END AS `attente`, `demmande_formateur_cfp`.`created_at` AS `date_demmande` FROM (`demmande_formateur_cfp` join `formateurs`) WHERE `demmande_formateur_cfp`.`demmandeur_formateur_id` = `formateurs`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_invitation_etp_pour_cfp`
--
DROP TABLE IF EXISTS `v_invitation_etp_pour_cfp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_invitation_etp_pour_cfp`  AS SELECT `demmande_cfp_etp`.`id` AS `id`, `demmande_cfp_etp`.`inviter_etp_id` AS `inviter_etp_id`, `demmande_cfp_etp`.`demmandeur_cfp_id` AS `demmandeur_cfp_id`, `cfps`.`nom` AS `nom_cfp`, `cfps`.`adresse_lot` AS `adresse_lot_cfp`, `cfps`.`adresse_ville` AS `adresse_ville_cfp`, `cfps`.`adresse_region` AS `adresse_region_cfp`, `cfps`.`email` AS `mail_cfp`, `cfps`.`telephone` AS `tel_cfp`, `cfps`.`domaine_de_formation` AS `domaine_de_formation`, `cfps`.`nif` AS `nif_cfp`, `cfps`.`stat` AS `stat_cfp`, `cfps`.`rcs` AS `rcs_cfp`, `cfps`.`cif` AS `cif_cfp`, `cfps`.`logo` AS `logo_cfp`, `cfps`.`user_id` AS `user_id`, to_days(`demmande_cfp_etp`.`created_at`) - to_days(current_timestamp()) AS `jours`, CASE WHEN to_days(current_timestamp()) - to_days(`demmande_cfp_etp`.`created_at`) > 0 THEN concat(to_days(current_timestamp()) - to_days(`demmande_cfp_etp`.`created_at`),' jour(s)') ELSE 'aujourd\'huit' END AS `attente`, `demmande_cfp_etp`.`created_at` AS `date_demmande` FROM (`demmande_cfp_etp` join `cfps`) WHERE `demmande_cfp_etp`.`demmandeur_cfp_id` = `cfps`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_invitation_formateur_pour_cfp`
--
DROP TABLE IF EXISTS `v_invitation_formateur_pour_cfp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_invitation_formateur_pour_cfp`  AS SELECT `demmande_cfp_formateur`.`id` AS `id`, `demmande_cfp_formateur`.`inviter_formateur_id` AS `inviter_formateur_id`, `demmande_cfp_formateur`.`demmandeur_cfp_id` AS `demmandeur_cfp_id`, `cfps`.`nom` AS `nom_cfp`, `cfps`.`adresse_lot` AS `adresse_lot_cfp`, `cfps`.`adresse_ville` AS `adresse_ville_cfp`, `cfps`.`adresse_region` AS `adresse_region_cfp`, `cfps`.`email` AS `mail_cfp`, `cfps`.`telephone` AS `tel_cfp`, `cfps`.`domaine_de_formation` AS `domaine_de_formation`, `cfps`.`nif` AS `nif_cfp`, `cfps`.`stat` AS `stat_cfp`, `cfps`.`rcs` AS `rcs_cfp`, `cfps`.`cif` AS `cif_cfp`, `cfps`.`logo` AS `logo_cfp`, `cfps`.`user_id` AS `user_id`, to_days(`demmande_cfp_formateur`.`created_at`) - to_days(current_timestamp()) AS `jours`, CASE WHEN to_days(current_timestamp()) - to_days(`demmande_cfp_formateur`.`created_at`) > 0 THEN concat(to_days(current_timestamp()) - to_days(`demmande_cfp_formateur`.`created_at`),' jour(s)') ELSE 'aujourd\'huit' END AS `attente`, `demmande_cfp_formateur`.`created_at` AS `date_demmande` FROM (`demmande_cfp_formateur` join `cfps`) WHERE `demmande_cfp_formateur`.`demmandeur_cfp_id` = `cfps`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_liste_avis`
--
DROP TABLE IF EXISTS `v_liste_avis`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_liste_avis`  AS SELECT `a`.`module_id` AS `module_id`, `a`.`stagiaire_id` AS `stagiaire_id`, `a`.`commentaire` AS `commentaire`, round(`a`.`note` / 2,1) AS `note`, `s`.`nom_stagiaire` AS `nom_stagiaire`, `s`.`prenom_stagiaire` AS `prenom_stagiaire`, `a`.`date_avis` AS `date_avis` FROM (`avis` `a` join `stagiaires` `s` on(`a`.`stagiaire_id` = `s`.`id`)) ORDER BY `a`.`date_avis` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `v_liste_facture`
--
DROP TABLE IF EXISTS `v_liste_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_liste_facture`  AS SELECT `factures`.`cfp_id` AS `cfp_id`, `factures`.`id` AS `facture_id`, `factures`.`projet_id` AS `projet_id`, `projets`.`nom_projet` AS `nom_projet`, `projets`.`entreprise_id` AS `entreprise_id`, `factures`.`type_payement_id` AS `type_payement_id`, `type_payement`.`type` AS `description_type_payement`, `factures`.`bon_de_commande` AS `bon_de_commande`, `factures`.`devise` AS `facture`, `factures`.`hors_taxe` AS `hors_taxe`, `factures`.`invoice_date` AS `invoice_date`, `factures`.`due_date` AS `due_date`, `factures`.`tax_id` AS `tax_id`, `taxes`.`description` AS `nom_taxe`, `taxes`.`pourcent` AS `pourcent`, `factures`.`description` AS `description_facture`, `factures`.`other_message` AS `other_message`, `factures`.`qte` AS `qte`, `factures`.`num_facture` AS `num_facture`, `factures`.`activiter` AS `activiter`, `factures`.`groupe_id` AS `groupe_id`, `groupes`.`nom_groupe` AS `nom_groupe`, `factures`.`pu` AS `pu`, `factures`.`type_financement_id` AS `type_financement_id`, `mode_financements`.`description` AS `description_financement`, `entreprises`.`nom_etp` AS `nom_etp`, `entreprises`.`adresse` AS `adresse`, `entreprises`.`logo` AS `logo`, `factures`.`reference_bc` AS `reference_bc`, `factures`.`remise` AS `remise`, `factures`.`type_facture_id` AS `type_facture_id`, `type_facture`.`description` AS `description_type_facture`, `type_facture`.`reference` AS `reference_facture`, `entreprises`.`nif` AS `NIF`, `entreprises`.`stat` AS `STAT`, `entreprises`.`rcs` AS `RCS`, `entreprises`.`cif` AS `CIF`, `entreprises`.`secteur_id` AS `secteur_id` FROM (((((((`factures` join `type_payement`) join `taxes`) join `projets`) join `groupes`) join `entreprises`) join `mode_financements`) join `type_facture`) WHERE `factures`.`type_payement_id` = `type_payement`.`id` AND `factures`.`type_financement_id` = `mode_financements`.`id` AND `factures`.`tax_id` = `taxes`.`id` AND `factures`.`cfp_id` = `projets`.`cfp_id` AND `factures`.`projet_id` = `projets`.`id` AND `factures`.`groupe_id` = `groupes`.`id` AND `projets`.`entreprise_id` = `entreprises`.`id` AND `factures`.`type_facture_id` = `type_facture`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_liste_formateur_projet`
--
DROP TABLE IF EXISTS `v_liste_formateur_projet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_liste_formateur_projet`  AS SELECT `v_detailmoduleformationprojetformateur`.`cfp_id` AS `cfp_id`, `v_detailmoduleformationprojetformateur`.`projet_id` AS `projet_id`, `v_detailmoduleformationprojetformateur`.`formateur_id` AS `formateur_id`, `v_detailmoduleformationprojetformateur`.`nom_projet` AS `nom_projet`, `v_detailmoduleformationprojetformateur`.`nom_formateur` AS `nom_formateur`, `v_detailmoduleformationprojetformateur`.`prenom_formateur` AS `prenom_formateur`, `v_detailmoduleformationprojetformateur`.`photos` AS `photos`, `v_detailmoduleformationprojetformateur`.`mail_formateur` AS `mail_formateur`, `v_detailmoduleformationprojetformateur`.`numero_formateur` AS `numero_formateur`, `v_detailmoduleformationprojetformateur`.`genre` AS `genre`, `v_detailmoduleformationprojetformateur`.`activiter_formateur` AS `activiter_formateur`, `v_detailmoduleformationprojetformateur`.`user_id` AS `user_id` FROM `v_detailmoduleformationprojetformateur` GROUP BY `v_detailmoduleformationprojetformateur`.`cfp_id`, `v_detailmoduleformationprojetformateur`.`projet_id`, `v_detailmoduleformationprojetformateur`.`formateur_id`, `v_detailmoduleformationprojetformateur`.`nom_projet`, `v_detailmoduleformationprojetformateur`.`nom_formateur`, `v_detailmoduleformationprojetformateur`.`prenom_formateur`, `v_detailmoduleformationprojetformateur`.`photos`, `v_detailmoduleformationprojetformateur`.`mail_formateur`, `v_detailmoduleformationprojetformateur`.`numero_formateur`, `v_detailmoduleformationprojetformateur`.`genre`, `v_detailmoduleformationprojetformateur`.`activiter_formateur`, `v_detailmoduleformationprojetformateur`.`user_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_liste_stagiaire_groupe`
--
DROP TABLE IF EXISTS `v_liste_stagiaire_groupe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_liste_stagiaire_groupe`  AS SELECT `v_participantsession`.`cfp_id` AS `cfp_id`, `v_participantsession`.`stagiaire_id` AS `stagiaire_id`, `stagiaires`.`nom_stagiaire` AS `nom_stagiaire`, `stagiaires`.`prenom_stagiaire` AS `prenom_stagiaire`, `v_participantsession`.`groupe_id` AS `groupe_id`, `groupes`.`nom_groupe` AS `nom_groupe`, `groupes`.`date_debut` AS `date_debut`, `groupes`.`date_fin` AS `date_fin`, `groupes`.`status` AS `status_groupe`, `groupes`.`activiter` AS `activiter_groupe`, `groupes`.`module_id` AS `module_id`, `v_detailmoduleformation`.`nom_module` AS `nom_module`, `v_detailmoduleformation`.`reference` AS `reference`, `v_detailmoduleformation`.`projet_id` AS `projet_id` FROM (((`stagiaires` join `v_participantsession`) join `groupes`) join `v_detailmoduleformation`) WHERE `v_participantsession`.`stagiaire_id` = `stagiaires`.`id` AND `v_detailmoduleformation`.`projet_id` = `v_participantsession`.`projet_id` AND `v_participantsession`.`groupe_id` = `groupes`.`id` AND `v_participantsession`.`cfp_id` = `v_detailmoduleformation`.`cfp_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_moduleformation`
--
DROP TABLE IF EXISTS `v_moduleformation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_moduleformation`  AS SELECT `m`.`id` AS `module_id`, `m`.`reference` AS `reference`, `m`.`nom_module` AS `nom_module`, `m`.`prix` AS `prix`, `m`.`duree` AS `duree`, `f`.`id` AS `formation_id`, `f`.`nom_formation` AS `nom_formation`, `f`.`cfp_id` AS `cfp_id` FROM (`modules` `m` join `formations` `f` on(`m`.`formation_id` = `f`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_module_nombre`
--
DROP TABLE IF EXISTS `v_module_nombre`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_module_nombre`  AS SELECT `m`.`id` AS `id`, `m`.`reference` AS `reference`, `m`.`nom_module` AS `nom_module`, `n`.`nombre` AS `nombre` FROM (`modules` `m` join `nombre` `n`) ;

-- --------------------------------------------------------

--
-- Structure for view `v_montant_brut_facture`
--
DROP TABLE IF EXISTS `v_montant_brut_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_montant_brut_facture`  AS SELECT `mpf`.`cfp_id` AS `cfp_id`, `mpf`.`projet_id` AS `projet_id`, `mpf`.`num_facture` AS `num_facture`, `mpf`.`hors_taxe`+ ifnull(`mfa`.`hors_taxe`,0) AS `montant_brut_ht`, `mpf`.`due_date` AS `due_date`, `mpf`.`invoice_date` AS `invoice_date` FROM (`v_montant_pedagogique_facture` `mpf` left join `v_montant_frais_annexe` `mfa` on(`mpf`.`num_facture` = `mfa`.`num_facture` and `mpf`.`projet_id` = `mfa`.`projet_id` and `mpf`.`cfp_id` = `mfa`.`cfp_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_montant_facture`
--
DROP TABLE IF EXISTS `v_montant_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_montant_facture`  AS SELECT `mbr`.`cfp_id` AS `cfp_id`, `mbr`.`projet_id` AS `projet_id`, `mbr`.`num_facture` AS `num_facture`, `mbr`.`montant_brut_ht` AS `montant_brut_ht`, `rf`.`remise` AS `remise`, `mbr`.`montant_brut_ht`- `rf`.`remise` AS `net_commercial`, `mbr`.`montant_brut_ht`- `rf`.`remise` AS `net_ht`, (`mbr`.`montant_brut_ht` - `rf`.`remise`) * `tf`.`pourcent` / 100 AS `tva`, (`mbr`.`montant_brut_ht` - `rf`.`remise`) * `tf`.`pourcent` / 100 + (`mbr`.`montant_brut_ht` - `rf`.`remise`) AS `net_ttc`, `fact`.`type_facture_id` AS `type_facture_id`, `typ_fact`.`description` AS `description_type_facture`, `typ_fact`.`reference` AS `reference_type_facture`, `mbr`.`due_date` AS `due_date`, `mbr`.`invoice_date` AS `invoice_date` FROM ((((`v_montant_brut_facture` `mbr` join `v_remise_facture` `rf`) join `v_taxe_facture` `tf`) join `factures` `fact`) join `type_facture` `typ_fact`) WHERE `mbr`.`num_facture` = `rf`.`num_facture` AND `tf`.`num_facture` = `mbr`.`num_facture` AND `fact`.`type_facture_id` = `typ_fact`.`id` AND `mbr`.`num_facture` = `fact`.`num_facture` AND `mbr`.`cfp_id` = `rf`.`cfp_id` AND `tf`.`cfp_id` = `mbr`.`cfp_id` AND `mbr`.`cfp_id` = `fact`.`cfp_id` GROUP BY `mbr`.`cfp_id`, `mbr`.`projet_id`, `mbr`.`num_facture`, `mbr`.`montant_brut_ht`, `rf`.`remise`, `fact`.`type_facture_id`, `typ_fact`.`description`, `typ_fact`.`reference`, `mbr`.`due_date`, `mbr`.`invoice_date`, `tf`.`pourcent` ;

-- --------------------------------------------------------

--
-- Structure for view `v_montant_frais_annexe`
--
DROP TABLE IF EXISTS `v_montant_frais_annexe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_montant_frais_annexe`  AS SELECT `montant_frais_annexes`.`cfp_id` AS `cfp_id`, `montant_frais_annexes`.`projet_id` AS `projet_id`, `montant_frais_annexes`.`num_facture` AS `num_facture`, sum(`montant_frais_annexes`.`qte`) AS `qte_totale`, sum(`montant_frais_annexes`.`hors_taxe`) AS `hors_taxe` FROM `montant_frais_annexes` GROUP BY `montant_frais_annexes`.`cfp_id`, `montant_frais_annexes`.`projet_id`, `montant_frais_annexes`.`num_facture` ;

-- --------------------------------------------------------

--
-- Structure for view `v_montant_pedagogique_facture`
--
DROP TABLE IF EXISTS `v_montant_pedagogique_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_montant_pedagogique_facture`  AS SELECT `factures`.`cfp_id` AS `cfp_id`, `factures`.`projet_id` AS `projet_id`, `factures`.`num_facture` AS `num_facture`, sum(`factures`.`qte`) AS `qte_totale`, sum(`factures`.`hors_taxe`) AS `hors_taxe`, `factures`.`due_date` AS `due_date`, `factures`.`invoice_date` AS `invoice_date` FROM `factures` GROUP BY `factures`.`cfp_id`, `factures`.`num_facture`, `factures`.`projet_id`, `factures`.`due_date`, `factures`.`invoice_date` ;

-- --------------------------------------------------------

--
-- Structure for view `v_moyenne_avis_module`
--
DROP TABLE IF EXISTS `v_moyenne_avis_module`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_moyenne_avis_module`  AS SELECT `v_nombre_note`.`module_id` AS `module_id`, sum(`v_nombre_note`.`note`) / count(`v_nombre_note`.`module_id`) AS `moyenne_avis` FROM `v_nombre_note` GROUP BY `v_nombre_note`.`module_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_nombre_avis_par_module`
--
DROP TABLE IF EXISTS `v_nombre_avis_par_module`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_nombre_avis_par_module`  AS SELECT `avis`.`module_id` AS `module_id`, count(0) AS `nombre` FROM `avis` GROUP BY `avis`.`module_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_nombre_note`
--
DROP TABLE IF EXISTS `v_nombre_note`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_nombre_note`  AS SELECT `avis`.`module_id` AS `module_id`, round(`avis`.`note` / 2,1) AS `note`, count(`avis`.`note`) AS `nombre_note` FROM `avis` GROUP BY `avis`.`module_id`, `avis`.`note` ;

-- --------------------------------------------------------

--
-- Structure for view `v_notification_demande`
--
DROP TABLE IF EXISTS `v_notification_demande`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_notification_demande`  AS SELECT `n`.`stagiaire_id` AS `stagiaire_id`, `n`.`demande_tn_id` AS `demande_tn_id`, `n`.`description_test` AS `description_test`, `n`.`entreprise_id` AS `entreprise_id`, `n`.`cfp_id` AS `cfp_id`, `n`.`formation_id` AS `formation_id`, `n`.`date_creation` AS `date_creation`, `n`.`etat` AS `etat`, `f`.`nom_formation` AS `nom_formation` FROM (`v_notification_test_niveaux` `n` join `formations` `f` on(`n`.`formation_id` = `f`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_notification_test_niveaux`
--
DROP TABLE IF EXISTS `v_notification_test_niveaux`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_notification_test_niveaux`  AS SELECT `s`.`stagiaire_id` AS `stagiaire_id`, `s`.`demande_tn_id` AS `demande_tn_id`, `s`.`etat` AS `etat`, `d`.`description_test` AS `description_test`, `d`.`entreprise_id` AS `entreprise_id`, `d`.`cfp_id` AS `cfp_id`, `d`.`formation_id` AS `formation_id`, `d`.`date_creation` AS `date_creation` FROM (`stagiaire_pour_test_niveaux` `s` join `demande_test_niveaux` `d` on(`d`.`id` = `s`.`demande_tn_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_participantsession`
--
DROP TABLE IF EXISTS `v_participantsession`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_participantsession`  AS SELECT `g`.`projet_id` AS `projet_id`, `ps`.`stagiaire_id` AS `stagiaire_id`, `ps`.`groupe_id` AS `groupe_id`, `g`.`nom_groupe` AS `nom_groupe`, `g`.`date_debut` AS `date_debut`, `g`.`date_fin` AS `date_fin`, `g`.`status` AS `status_groupe`, `g`.`activiter` AS `activiter_groupe`, `s`.`matricule` AS `matricule`, `s`.`nom_stagiaire` AS `nom_stagiaire`, `s`.`prenom_stagiaire` AS `prenom_stagiaire`, `s`.`fonction_stagiaire` AS `fonction_stagiaire`, `s`.`genre_stagiaire` AS `genre_stagiaire`, `s`.`mail_stagiaire` AS `mail_stagiaire`, `s`.`telephone_stagiaire` AS `telephone_stagiaire`, `s`.`user_id` AS `user_id`, `s`.`photos` AS `photos`, `s`.`departement_id` AS `departement_id`, `s`.`cin` AS `cin`, `s`.`date_naissance` AS `date_naissance`, `s`.`adresse` AS `adresse`, `s`.`niveau_etude` AS `niveau_etude`, `s`.`activiter` AS `activiter_stagiaire`, `pe`.`nom_projet` AS `nom_projet`, `pe`.`entreprise_id` AS `entreprise_id`, `pe`.`cfp_id` AS `cfp_id`, `pe`.`status` AS `status_projet`, `pe`.`activiter` AS `activiter_projet` FROM (((`participant_groupe` `ps` join `stagiaires` `s`) join `projets` `pe`) join `groupes` `g`) WHERE `ps`.`stagiaire_id` = `s`.`id` AND `ps`.`groupe_id` = `g`.`id` AND `g`.`projet_id` = `pe`.`id` AND `s`.`entreprise_id` = `pe`.`entreprise_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_participant_groupe`
--
DROP TABLE IF EXISTS `v_participant_groupe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_participant_groupe`  AS SELECT `dm`.`detail_id` AS `detail_id`, `dm`.`lieu` AS `lieu`, `dm`.`h_debut` AS `h_debut`, `dm`.`h_fin` AS `h_fin`, `dm`.`date_detail` AS `date_detail`, `dm`.`formateur_id` AS `formateur_id`, `dm`.`projet_id` AS `projet_id`, `dm`.`groupe_id` AS `groupe_id`, `dm`.`cfp_id` AS `cfp_id`, `dm`.`max_participant` AS `max_participant`, `dm`.`min_participant` AS `min_participant`, `dm`.`nom_groupe` AS `nom_groupe`, `dm`.`module_id` AS `module_id`, `dm`.`date_debut` AS `date_debut`, `dm`.`date_fin` AS `date_fin`, `dm`.`status` AS `status`, `dm`.`activiter` AS `activiter`, `dm`.`reference` AS `reference`, `dm`.`nom_module` AS `nom_module`, `dm`.`formation_id` AS `formation_id`, `dm`.`nom_formation` AS `nom_formation`, `dm`.`nom_formateur` AS `nom_formateur`, `dm`.`prenom_formateur` AS `prenom_formateur`, `dm`.`mail_formateur` AS `mail_formateur`, `dm`.`numero_formateur` AS `numero_formateur`, `dm`.`nom_projet` AS `nom_projet`, `dm`.`entreprise_id` AS `entreprise_id`, `pg`.`stagiaire_id` AS `stagiaire_id`, `s`.`matricule` AS `matricule`, `s`.`nom_stagiaire` AS `nom_stagiaire`, `s`.`prenom_stagiaire` AS `prenom_stagiaire`, `s`.`genre_stagiaire` AS `genre_stagiaire`, `s`.`fonction_stagiaire` AS `fonction_stagiaire`, `s`.`mail_stagiaire` AS `mail_stagiaire`, `s`.`telephone_stagiaire` AS `telephone_stagiaire`, `s`.`user_id` AS `user_id_stagiaire`, `s`.`photos` AS `photos`, `s`.`departement_id` AS `departement_id`, `s`.`cin` AS `cin`, `s`.`date_naissance` AS `date_naissance`, `s`.`adresse` AS `adresse`, `s`.`niveau_etude` AS `niveau_etude`, `s`.`activiter` AS `activiter_stagiaire`, `s`.`lieu_travail` AS `lieu_travail` FROM ((`participant_groupe` `pg` join `v_detailmodule` `dm` on(`pg`.`groupe_id` = `dm`.`groupe_id`)) join `stagiaires` `s` on(`s`.`id` = `pg`.`stagiaire_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_pourcentage_avis`
--
DROP TABLE IF EXISTS `v_pourcentage_avis`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pourcentage_avis`  AS SELECT `nn`.`module_id` AS `module_id`, ceiling(`nn`.`note`) AS `note`, `nn`.`nombre_note` AS `nombre_note`, round(`nn`.`nombre_note` * 100 / `na`.`nombre`,0) AS `pourcentage_note` FROM (`v_nombre_note` `nn` join `v_nombre_avis_par_module` `na` on(`nn`.`module_id` = `na`.`module_id`)) ORDER BY `nn`.`module_id` ASC, `nn`.`note` DESC ;

-- --------------------------------------------------------

--
-- Structure for view `v_pourcentage_status`
--
DROP TABLE IF EXISTS `v_pourcentage_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pourcentage_status`  AS SELECT `froid_evaluations`.`cfp_id` AS `cfp_id`, `froid_evaluations`.`projet_id` AS `projet_id`, `froid_evaluations`.`stagiaire_id` AS `stagiaire_id`, sum(`froid_evaluations`.`status`) / (4 * count(`froid_evaluations`.`cours_id`)) * 100 AS `pourcentage` FROM `froid_evaluations` GROUP BY `froid_evaluations`.`cfp_id`, `froid_evaluations`.`projet_id`, `froid_evaluations`.`stagiaire_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_pourcent_globale_evaluation_action_formation`
--
DROP TABLE IF EXISTS `v_pourcent_globale_evaluation_action_formation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pourcent_globale_evaluation_action_formation`  AS SELECT round(avg(`v_evaluation_action_formation`.`pourcent`),2) AS `globale`, `v_evaluation_action_formation`.`projet_id` AS `projet_id`, `v_evaluation_action_formation`.`cfp_id` AS `cfp_id` FROM `v_evaluation_action_formation` GROUP BY `v_evaluation_action_formation`.`projet_id`, `v_evaluation_action_formation`.`cfp_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_presence_detail`
--
DROP TABLE IF EXISTS `v_presence_detail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_presence_detail`  AS SELECT `p`.`status` AS `status`, `p`.`detail_id` AS `detail_id`, `p`.`stagiaire_id` AS `stagiaire_id`, `s`.`matricule` AS `matricule`, `s`.`nom_stagiaire` AS `nom_stagiaire`, `s`.`prenom_stagiaire` AS `prenom_stagiaire`, `s`.`genre_stagiaire` AS `genre_stagiaire`, `s`.`fonction_stagiaire` AS `fonction_stagiaire`, `s`.`mail_stagiaire` AS `mail_stagiaire`, `s`.`telephone_stagiaire` AS `telephone_stagiaire`, `s`.`user_id` AS `user_id_stagiaire`, `s`.`photos` AS `photos`, `s`.`departement_id` AS `departement_id`, `s`.`cin` AS `cin`, `s`.`date_naissance` AS `date_naissance`, `s`.`adresse` AS `adresse_stg`, `s`.`niveau_etude` AS `niveau_etude`, `s`.`activiter` AS `activiter_stagiaire`, `s`.`lieu_travail` AS `lieu_travail` FROM (`presences` `p` join `stagiaires` `s` on(`p`.`stagiaire_id` = `s`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_programme`
--
DROP TABLE IF EXISTS `v_programme`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_programme`  AS SELECT `module`.`cfp_id` AS `cfp_id`, `module`.`formation_id` AS `formation_id`, `module`.`nom_formation` AS `nom_formation`, `module`.`id_module` AS `id_module`, `module`.`nom_module` AS `nom_module`, `module`.`reference` AS `reference`, `module`.`prix` AS `prix_module`, `module`.`duree` AS `duree_module`, `programmes`.`id` AS `id_programme`, `programmes`.`titre` AS `titre_programme`, `module`.`prerequis` AS `prerequis`, `module`.`objectif` AS `objectif`, `module`.`modalite_formation` AS `modalite_formation` FROM ((select `modules`.`id` AS `id_module`,`modules`.`reference` AS `reference`,`modules`.`nom_module` AS `nom_module`,`formations`.`domaine_id` AS `domaine_id`,`formations`.`cfp_id` AS `cfp_id`,`modules`.`formation_id` AS `formation_id`,`formations`.`nom_formation` AS `nom_formation`,`modules`.`prix` AS `prix`,`modules`.`duree` AS `duree`,`modules`.`prerequis` AS `prerequis`,`modules`.`objectif` AS `objectif`,`modules`.`modalite_formation` AS `modalite_formation` from (`modules` join `formations`) where `modules`.`formation_id` = `formations`.`id`) `module` join `programmes` on(`module`.`id_module` = `programmes`.`module_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_programme_detail_activiter`
--
DROP TABLE IF EXISTS `v_programme_detail_activiter`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_programme_detail_activiter`  AS SELECT `v_detailmoduleformation`.`detail_id` AS `detail_id`, `v_detailmoduleformation`.`lieu` AS `lieu`, `v_detailmoduleformation`.`h_debut` AS `h_debut`, `v_detailmoduleformation`.`h_fin` AS `h_fin`, `v_detailmoduleformation`.`date_detail` AS `date_detail`, `v_detailmoduleformation`.`projet_id` AS `projet_id`, `v_detailmoduleformation`.`groupe_id` AS `groupe_id`, `v_detailmoduleformation`.`formateur_id` AS `formateur_id`, `v_detailmoduleformation`.`reference` AS `reference`, `v_detailmoduleformation`.`nom_module` AS `nom_module`, `v_detailmoduleformation`.`duree` AS `duree`, `v_detailmoduleformation`.`formation_id` AS `formation_id`, `v_detailmoduleformation`.`nom_formation` AS `nom_formation`, `v_detailmoduleformation`.`cfp_id` AS `cfp_id`, `v_detail_cour`.`cours_id` AS `cours_id`, `v_detail_cour`.`titre_cours` AS `titre_cours`, `v_detail_cour`.`programme_id` AS `programme_id`, `v_detail_cour`.`titre_programme` AS `titre_programme` FROM (`v_detailmoduleformation` join `v_detail_cour`) WHERE `v_detailmoduleformation`.`detail_id` = `v_detail_cour`.`detail_id` AND `v_detailmoduleformation`.`cfp_id` = `v_detail_cour`.`cfp_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_projet`
--
DROP TABLE IF EXISTS `v_projet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_projet`  AS SELECT `projets`.`id` AS `id`, `projets`.`nom_projet` AS `nom_projet`, `projets`.`entreprise_id` AS `entreprise_id`, `projets`.`cfp_id` AS `cfp_id`, `projets`.`status` AS `status`, `projets`.`activiter` AS `activiter`, `projets`.`created_at` AS `created_at`, `projets`.`updated_at` AS `updated_at`, `entreprises`.`nom_etp` AS `nom_etp` FROM (`projets` join `entreprises`) WHERE `projets`.`entreprise_id` = `entreprises`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_projetentreprise`
--
DROP TABLE IF EXISTS `v_projetentreprise`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_projetentreprise`  AS SELECT `p`.`id` AS `projet_id`, `p`.`nom_projet` AS `nom_projet`, `p`.`created_at` AS `date_projet`, `t_se`.`totale_session` AS `totale_session`, `p`.`entreprise_id` AS `entreprise_id`, `p`.`cfp_id` AS `cfp_id`, `p`.`status` AS `status`, `p`.`activiter` AS `activiter`, `p`.`created_at` AS `created_at`, `e`.`nom_etp` AS `nom_etp`, `e`.`adresse` AS `adresse`, `e`.`logo` AS `logo`, `e`.`nif` AS `nif`, `e`.`stat` AS `stat`, `e`.`rcs` AS `rcs`, `e`.`cif` AS `cif`, `e`.`secteur_id` AS `secteur_id`, `se`.`nom_secteur` AS `secteur_activite`, `e`.`email_etp` AS `email_etp`, `e`.`site_etp` AS `site_etp`, `e`.`activiter` AS `activiter_etp`, `e`.`telephone_etp` AS `telephone_etp`, `cf`.`nom` AS `nom_cfp`, `cf`.`logo` AS `logo_cfp`, `cf`.`adresse_ville` AS `adresse_ville_cfp`, `cf`.`adresse_region` AS `adresse_region_cfp`, `cf`.`email` AS `email_cfp`, `cf`.`telephone` AS `telephone_cfp`, `cf`.`domaine_de_formation` AS `domaine_de_formation_cfp` FROM ((((`projets` `p` join `entreprises` `e`) join `secteurs` `se`) join `v_totale_session` `t_se`) join `cfps` `cf`) WHERE `p`.`entreprise_id` = `e`.`id` AND `e`.`secteur_id` = `se`.`id` AND `p`.`id` = `t_se`.`projet_id` AND `p`.`cfp_id` = `cf`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_question_fille`
--
DROP TABLE IF EXISTS `v_question_fille`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_question_fille`  AS SELECT `question_fille`.`id` AS `id`, `question_fille`.`qst_fille` AS `qst_fille`, `question_fille`.`id_type_champs` AS `id_type_champs`, `type_champs`.`desc_champ` AS `desc_champ`, `question_fille`.`id_qst_mere` AS `id_qst_mere` FROM (`question_fille` join `type_champs`) WHERE `question_fille`.`id_type_champs` = `type_champs`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_question_reponse_test_niveau`
--
DROP TABLE IF EXISTS `v_question_reponse_test_niveau`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_question_reponse_test_niveau`  AS SELECT `c`.`id` AS `id`, `c`.`question_id` AS `question_id`, `c`.`reponse` AS `reponse`, `c`.`points` AS `points`, `c`.`created_at` AS `created_at`, `c`.`updated_at` AS `updated_at`, `q`.`cfp_id` AS `cfp_id`, `q`.`formation_id` AS `formation_id` FROM (`question_evaluations` `q` join `choix_pour_questions` `c` on(`c`.`question_id` = `q`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_remise_facture`
--
DROP TABLE IF EXISTS `v_remise_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_remise_facture`  AS SELECT `factures`.`cfp_id` AS `cfp_id`, `factures`.`projet_id` AS `projet_id`, `factures`.`num_facture` AS `num_facture`, sum(`factures`.`remise`) / count(`factures`.`num_facture`) AS `remise` FROM `factures` GROUP BY `factures`.`num_facture`, `factures`.`projet_id`, `factures`.`cfp_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_reponse_evaluationchaud`
--
DROP TABLE IF EXISTS `v_reponse_evaluationchaud`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_reponse_evaluationchaud`  AS SELECT `reponse_evaluationchaud`.`reponse_desc_champ` AS `reponse_desc_champ`, `reponse_evaluationchaud`.`id_desc_champ` AS `id_desc_champ`, `description_champ_reponse`.`descr_champs` AS `desc_champ`, `description_champ_reponse`.`nb_max` AS `nb_max`, `description_champ_reponse`.`id_qst_fille` AS `id_qst_fille`, `reponse_evaluationchaud`.`stagiaire_id` AS `stagiaire_id` FROM (`reponse_evaluationchaud` join `description_champ_reponse`) WHERE `reponse_evaluationchaud`.`id_desc_champ` = `description_champ_reponse`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_responsable_entreprise`
--
DROP TABLE IF EXISTS `v_responsable_entreprise`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_responsable_entreprise`  AS SELECT `r`.`id` AS `responsable_id`, `r`.`nom_resp` AS `nom_resp`, `r`.`prenom_resp` AS `prenom_resp`, `r`.`fonction_resp` AS `fonction_resp`, `r`.`email_resp` AS `email_resp`, `r`.`cin_resp` AS `cin_resp`, `r`.`telephone_resp` AS `telephone_resp`, `r`.`user_id` AS `user_id_responsable`, `r`.`photos` AS `photos`, `r`.`entreprise_id` AS `entreprise_id_responsable`, `r`.`activiter` AS `activiter_responsable`, `e`.`id` AS `entreprise_id`, `e`.`nom_etp` AS `nom_etp`, `e`.`adresse` AS `adresse_etp`, `e`.`logo` AS `logo_entreprise`, `e`.`nif` AS `nif_etp`, `e`.`stat` AS `stat_etp`, `e`.`rcs` AS `rcs_etp`, `e`.`cif` AS `cif_etp`, `e`.`secteur_id` AS `secteur_id_etp`, `e`.`email_etp` AS `email_etp`, `e`.`site_etp` AS `site_etp`, `e`.`activiter` AS `activiter_etp`, `e`.`telephone_etp` AS `telephone_etp` FROM (`responsables` `r` join `entreprises` `e` on(`e`.`id` = `r`.`entreprise_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_resultat_test_niveau`
--
DROP TABLE IF EXISTS `v_resultat_test_niveau`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_resultat_test_niveau`  AS SELECT sum(`reponse_pour_questions`.`points`) AS `total_points`, count(`reponse_pour_questions`.`question_id`) AS `nombre_question`, sum(`reponse_pour_questions`.`points`) / count(`reponse_pour_questions`.`question_id`) * 100 AS `pourcentage`, `reponse_pour_questions`.`demande_tn_id` AS `demande_tn_id`, `reponse_pour_questions`.`stagiaire_id` AS `stagiaire_id` FROM `reponse_pour_questions` GROUP BY `reponse_pour_questions`.`stagiaire_id`, `reponse_pour_questions`.`demande_tn_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_stagiaire_entreprise`
--
DROP TABLE IF EXISTS `v_stagiaire_entreprise`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stagiaire_entreprise`  AS SELECT `stg`.`id` AS `stagiaire_id`, `stg`.`matricule` AS `matricule`, `stg`.`nom_stagiaire` AS `nom_stagiaire`, `stg`.`prenom_stagiaire` AS `prenom_stagiaire`, `stg`.`genre_stagiaire` AS `genre_stagiaire`, `stg`.`fonction_stagiaire` AS `fonction_stagiaire`, `stg`.`mail_stagiaire` AS `mail_stagiaire`, `stg`.`telephone_stagiaire` AS `telephone_stagiaire`, `stg`.`entreprise_id` AS `entreprise_id`, `stg`.`user_id` AS `user_id`, `stg`.`photos` AS `photos`, `stg`.`departement_id` AS `departement_id`, `stg`.`cin` AS `cin`, `stg`.`date_naissance` AS `date_naissance`, `stg`.`adresse` AS `adresse`, `stg`.`lieu_travail` AS `lieu_travail`, `stg`.`niveau_etude` AS `niveau_etude`, `stg`.`activiter` AS `activiter`, `etp`.`nom_etp` AS `nom_etp`, `dept`.`nom_departement` AS `nom_departement` FROM ((`stagiaires` `stg` join `entreprises` `etp`) join `departements` `dept`) WHERE `stg`.`entreprise_id` = `etp`.`id` AND `stg`.`departement_id` = `dept`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_stagiaire_groupe`
--
DROP TABLE IF EXISTS `v_stagiaire_groupe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stagiaire_groupe`  AS SELECT `g`.`id` AS `groupe_id`, `g`.`max_participant` AS `max_participant`, `g`.`min_participant` AS `min_participant`, `g`.`nom_groupe` AS `nom_groupe`, `g`.`projet_id` AS `projet_id`, `g`.`module_id` AS `module_id`, `g`.`date_debut` AS `date_debut`, `g`.`date_fin` AS `date_fin`, `g`.`status` AS `status`, `g`.`activiter` AS `activiter_groupe`, `s`.`id` AS `stagiaire_id`, `s`.`matricule` AS `matricule`, `s`.`nom_stagiaire` AS `nom_stagiaire`, `s`.`prenom_stagiaire` AS `prenom_stagiaire`, `s`.`genre_stagiaire` AS `genre_stagiaire`, `s`.`fonction_stagiaire` AS `fonction_stagiaire`, `s`.`mail_stagiaire` AS `mail_stagiaire`, `s`.`telephone_stagiaire` AS `telephone_stagiaire`, `s`.`entreprise_id` AS `entreprise_id`, `s`.`user_id` AS `user_id`, `s`.`photos` AS `photos`, `s`.`departement_id` AS `departement_id`, `s`.`cin` AS `cin`, `s`.`date_naissance` AS `date_naissance`, `s`.`adresse` AS `adresse`, `s`.`niveau_etude` AS `niveau_etude`, `s`.`activiter` AS `activiter_stagiaire`, `s`.`lieu_travail` AS `lieu_travail` FROM ((`participant_groupe` `p` join `groupes` `g` on(`g`.`id` = `p`.`groupe_id`)) join `stagiaires` `s` on(`s`.`id` = `p`.`stagiaire_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_statistique_avis`
--
DROP TABLE IF EXISTS `v_statistique_avis`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_statistique_avis`  AS SELECT `mn`.`id` AS `module_id`, `mn`.`nombre` AS `nombre`, ifnull(`pa`.`pourcentage_note`,0) AS `pourcentage_note` FROM (`v_module_nombre` `mn` left join `v_pourcentage_avis` `pa` on(`mn`.`id` = `pa`.`module_id` and `mn`.`nombre` = `pa`.`note`)) ORDER BY `mn`.`id` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_sum_acompte_facture`
--
DROP TABLE IF EXISTS `v_sum_acompte_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sum_acompte_facture`  AS SELECT `v_acompte_facture`.`cfp_id` AS `cfp_id`, `v_acompte_facture`.`projet_id` AS `projet_id`, sum(`v_acompte_facture`.`net_ttc`) AS `sum_acompte` FROM `v_acompte_facture` GROUP BY `v_acompte_facture`.`cfp_id`, `v_acompte_facture`.`projet_id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_sum_encaissement`
--
DROP TABLE IF EXISTS `v_sum_encaissement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sum_encaissement`  AS SELECT `encaissements`.`cfp_id` AS `cfp_id`, `encaissements`.`num_facture` AS `num_facture`, sum(ifnull(`encaissements`.`payement`,0)) AS `payement` FROM `encaissements` GROUP BY `encaissements`.`cfp_id`, `encaissements`.`num_facture` ;

-- --------------------------------------------------------

--
-- Structure for view `v_taxe_facture`
--
DROP TABLE IF EXISTS `v_taxe_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_taxe_facture`  AS SELECT `f`.`cfp_id` AS `cfp_id`, `f`.`projet_id` AS `projet_id`, `f`.`num_facture` AS `num_facture`, `t`.`pourcent` AS `pourcent` FROM (`factures` `f` join `taxes` `t` on(`f`.`tax_id` = `t`.`id`)) GROUP BY `f`.`cfp_id`, `f`.`num_facture`, `f`.`projet_id`, `t`.`pourcent` ;

-- --------------------------------------------------------

--
-- Structure for view `v_temp_facture`
--
DROP TABLE IF EXISTS `v_temp_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_temp_facture`  AS SELECT `v_dernier_encaissement`.`cfp_id` AS `cfp_id`, `v_dernier_encaissement`.`num_facture` AS `num_facture`, `v_dernier_encaissement`.`net_ttc` AS `net_ttc`, `v_dernier_encaissement`.`rest_payer` AS `rest_payer`, `v_dernier_encaissement`.`montant_facture` AS `montant_facture`, `v_dernier_encaissement`.`payement` AS `payement`, `v_dernier_encaissement`.`due_date` AS `due_date`, `v_dernier_encaissement`.`invoice_date` AS `invoice_date`, `v_dernier_encaissement`.`montant_facture`- `v_dernier_encaissement`.`payement` AS `montant_ouvert` FROM `v_dernier_encaissement` ;

-- --------------------------------------------------------

--
-- Structure for view `v_totale_session`
--
DROP TABLE IF EXISTS `v_totale_session`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_totale_session`  AS SELECT `projets`.`id` AS `projet_id`, count(`groupes`.`id`) AS `totale_session` FROM (`projets` left join `groupes` on(`groupes`.`projet_id` = `projets`.`id`)) GROUP BY `projets`.`id` ;

-- --------------------------------------------------------

--
-- Structure for view `v_trie_detail_date`
--
DROP TABLE IF EXISTS `v_trie_detail_date`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_trie_detail_date`  AS SELECT `v_programme_detail_activiter`.`cfp_id` AS `cfp_id`, `v_programme_detail_activiter`.`projet_id` AS `projet_id`, `v_programme_detail_activiter`.`h_debut` AS `h_debut`, `v_programme_detail_activiter`.`h_fin` AS `h_fin`, `v_programme_detail_activiter`.`date_detail` AS `date_detail` FROM `v_programme_detail_activiter` GROUP BY `v_programme_detail_activiter`.`cfp_id`, `v_programme_detail_activiter`.`projet_id`, `v_programme_detail_activiter`.`h_debut`, `v_programme_detail_activiter`.`h_fin`, `v_programme_detail_activiter`.`date_detail` ;

-- --------------------------------------------------------

--
-- Structure for view `v_trie_detail_programme`
--
DROP TABLE IF EXISTS `v_trie_detail_programme`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_trie_detail_programme`  AS SELECT `v_programme_detail_activiter`.`cfp_id` AS `cfp_id`, `v_programme_detail_activiter`.`projet_id` AS `projet_id`, `v_programme_detail_activiter`.`programme_id` AS `programme_id`, `v_programme_detail_activiter`.`titre_programme` AS `titre_programme` FROM `v_programme_detail_activiter` GROUP BY `v_programme_detail_activiter`.`cfp_id`, `v_programme_detail_activiter`.`projet_id`, `v_programme_detail_activiter`.`programme_id`, `v_programme_detail_activiter`.`titre_programme` ;

-- --------------------------------------------------------

--
-- Structure for view `v_type_abonnement_role_cfp`
--
DROP TABLE IF EXISTS `v_type_abonnement_role_cfp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_type_abonnement_role_cfp`  AS SELECT `t`.`id` AS `type_abonnement_role_id`, `t`.`type_abonne_id` AS `type_abonne_id`, `t`.`type_abonnement_id` AS `type_abonnement_id`, `a`.`id` AS `abonnement_id`, `a`.`date_demande` AS `date_demande`, `a`.`date_debut` AS `date_debut`, `a`.`date_fin` AS `date_fin`, `a`.`status` AS `status`, `a`.`cfp_id` AS `cfp_id`, `a`.`categorie_paiement_id` AS `categorie_paiement_id` FROM (`type_abonnement_roles` `t` join `abonnement_cfps` `a` on(`t`.`id` = `a`.`type_abonnement_role_id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `v_type_abonnement_role_etp`
--
DROP TABLE IF EXISTS `v_type_abonnement_role_etp`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_type_abonnement_role_etp`  AS SELECT `t`.`id` AS `type_abonnement_role_id`, `t`.`type_abonne_id` AS `type_abonne_id`, `t`.`type_abonnement_id` AS `type_abonnement_id`, `a`.`id` AS `abonnement_id`, `a`.`date_demande` AS `date_demande`, `a`.`date_debut` AS `date_debut`, `a`.`date_fin` AS `date_fin`, `a`.`status` AS `status`, `a`.`entreprise_id` AS `entreprise_id`, `a`.`categorie_paiement_id` AS `categorie_paiement_id` FROM (`type_abonnement_roles` `t` join `abonnements` `a` on(`t`.`id` = `a`.`type_abonnement_role_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abonnements`
--
ALTER TABLE `abonnements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `abonnement_cfps`
--
ALTER TABLE `abonnement_cfps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `annee_plans`
--
ALTER TABLE `annee_plans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `archive_modules`
--
ALTER TABLE `archive_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `but_objectif`
--
ALTER TABLE `but_objectif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorie_paiements`
--
ALTER TABLE `categorie_paiements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cfps`
--
ALTER TABLE `cfps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chef_departements`
--
ALTER TABLE `chef_departements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chef_dep_entreprises`
--
ALTER TABLE `chef_dep_entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `choix_pour_questions`
--
ALTER TABLE `choix_pour_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `competence_formateurs`
--
ALTER TABLE `competence_formateurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conclusion`
--
ALTER TABLE `conclusion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Indexes for table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cour_dans_detail`
--
ALTER TABLE `cour_dans_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demande_test_niveaux`
--
ALTER TABLE `demande_test_niveaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `entreprise_id` (`entreprise_id`),
  ADD KEY `cfp_id` (`cfp_id`),
  ADD KEY `formations_id` (`formation_id`);

--
-- Indexes for table `demmande_cfp_etp`
--
ALTER TABLE `demmande_cfp_etp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `demmandeur_cfp_id` (`demmandeur_cfp_id`),
  ADD KEY `inviter_etp_id` (`inviter_etp_id`);

--
-- Indexes for table `demmande_cfp_formateur`
--
ALTER TABLE `demmande_cfp_formateur`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inviter_formateur_id` (`inviter_formateur_id`),
  ADD KEY `demmandeur_cfp_id` (`demmandeur_cfp_id`);

--
-- Indexes for table `demmande_etp_cfp`
--
ALTER TABLE `demmande_etp_cfp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inviter_cfp_id` (`inviter_cfp_id`),
  ADD KEY `demmandeur_etp_id` (`demmandeur_etp_id`);

--
-- Indexes for table `demmande_formateur_cfp`
--
ALTER TABLE `demmande_formateur_cfp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `demmandeur_formateur_id` (`demmandeur_formateur_id`),
  ADD KEY `inviter_cfp_id` (`inviter_cfp_id`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departement_entreprises`
--
ALTER TABLE `departement_entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `description_champ_reponse`
--
ALTER TABLE `description_champ_reponse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_evaluation_action_formation`
--
ALTER TABLE `detail_evaluation_action_formation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluation_action_formation_id` (`evaluation_action_formation_id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Indexes for table `detail_recommandation`
--
ALTER TABLE `detail_recommandation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recommandation_id` (`recommandation_id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Indexes for table `domaines`
--
ALTER TABLE `domaines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `encaissements`
--
ALTER TABLE `encaissements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_action_formation`
--
ALTER TABLE `evaluation_action_formation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `evaluation_resultat`
--
ALTER TABLE `evaluation_resultat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Indexes for table `events_table`
--
ALTER TABLE `events_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience_formateurs`
--
ALTER TABLE `experience_formateurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feed_back`
--
ALTER TABLE `feed_back`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Indexes for table `formateurs`
--
ALTER TABLE `formateurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frais_annexes`
--
ALTER TABLE `frais_annexes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frais_annexe_formation`
--
ALTER TABLE `frais_annexe_formation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `froid_evaluations`
--
ALTER TABLE `froid_evaluations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mode_financements`
--
ALTER TABLE `mode_financements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `montant_frais_annexes`
--
ALTER TABLE `montant_frais_annexes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `niveaux`
--
ALTER TABLE `niveaux`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `objectif_globaux`
--
ALTER TABLE `objectif_globaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `but_objectif_id` (`but_objectif_id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Indexes for table `objectif_pedagogique`
--
ALTER TABLE `objectif_pedagogique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedagogique_id` (`pedagogique_id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Indexes for table `participant_groupe`
--
ALTER TABLE `participant_groupe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pedagogique`
--
ALTER TABLE `pedagogique`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plan_formations`
--
ALTER TABLE `plan_formations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `presences`
--
ALTER TABLE `presences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_evaluations`
--
ALTER TABLE `question_evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cfp_id` (`cfp_id`),
  ADD KEY `formation_id` (`formation_id`);

--
-- Indexes for table `question_fille`
--
ALTER TABLE `question_fille`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_mere`
--
ALTER TABLE `question_mere`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receuil_informations`
--
ALTER TABLE `receuil_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recommandation`
--
ALTER TABLE `recommandation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recueil_informations`
--
ALTER TABLE `recueil_informations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reponse_evaluationchaud`
--
ALTER TABLE `reponse_evaluationchaud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reponse_pour_questions`
--
ALTER TABLE `reponse_pour_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stagiaire_id` (`stagiaire_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `demande_tn_id` (`demande_tn_id`);

--
-- Indexes for table `responsables`
--
ALTER TABLE `responsables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ressources`
--
ALTER TABLE `ressources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secteurs`
--
ALTER TABLE `secteurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stagiaires`
--
ALTER TABLE `stagiaires`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stagiaire_pour_test_niveaux`
--
ALTER TABLE `stagiaire_pour_test_niveaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stagiaire_id` (`stagiaire_id`),
  ADD KEY `demande_tn_id` (`demande_tn_id`);

--
-- Indexes for table `tarif_categories`
--
ALTER TABLE `tarif_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_abonnements`
--
ALTER TABLE `type_abonnements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_abonnement_roles`
--
ALTER TABLE `type_abonnement_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_abonnes`
--
ALTER TABLE `type_abonnes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_champs`
--
ALTER TABLE `type_champs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_facture`
--
ALTER TABLE `type_facture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_payement`
--
ALTER TABLE `type_payement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_role_unique` (`email`,`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abonnements`
--
ALTER TABLE `abonnements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `abonnement_cfps`
--
ALTER TABLE `abonnement_cfps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `annee_plans`
--
ALTER TABLE `annee_plans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `archive_modules`
--
ALTER TABLE `archive_modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `but_objectif`
--
ALTER TABLE `but_objectif`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categorie_paiements`
--
ALTER TABLE `categorie_paiements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cfps`
--
ALTER TABLE `cfps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chef_departements`
--
ALTER TABLE `chef_departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `chef_dep_entreprises`
--
ALTER TABLE `chef_dep_entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `choix_pour_questions`
--
ALTER TABLE `choix_pour_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `competence_formateurs`
--
ALTER TABLE `competence_formateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `conclusion`
--
ALTER TABLE `conclusion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `cour_dans_detail`
--
ALTER TABLE `cour_dans_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `demande_test_niveaux`
--
ALTER TABLE `demande_test_niveaux`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `demmande_cfp_etp`
--
ALTER TABLE `demmande_cfp_etp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `demmande_cfp_formateur`
--
ALTER TABLE `demmande_cfp_formateur`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `demmande_etp_cfp`
--
ALTER TABLE `demmande_etp_cfp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `demmande_formateur_cfp`
--
ALTER TABLE `demmande_formateur_cfp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `departement_entreprises`
--
ALTER TABLE `departement_entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `description_champ_reponse`
--
ALTER TABLE `description_champ_reponse`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `detail_evaluation_action_formation`
--
ALTER TABLE `detail_evaluation_action_formation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_recommandation`
--
ALTER TABLE `detail_recommandation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `domaines`
--
ALTER TABLE `domaines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `encaissements`
--
ALTER TABLE `encaissements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `evaluation_action_formation`
--
ALTER TABLE `evaluation_action_formation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `evaluation_resultat`
--
ALTER TABLE `evaluation_resultat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events_table`
--
ALTER TABLE `events_table`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `experience_formateurs`
--
ALTER TABLE `experience_formateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feed_back`
--
ALTER TABLE `feed_back`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `formateurs`
--
ALTER TABLE `formateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `formations`
--
ALTER TABLE `formations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `frais_annexes`
--
ALTER TABLE `frais_annexes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `frais_annexe_formation`
--
ALTER TABLE `frais_annexe_formation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `froid_evaluations`
--
ALTER TABLE `froid_evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mode_financements`
--
ALTER TABLE `mode_financements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `montant_frais_annexes`
--
ALTER TABLE `montant_frais_annexes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `niveaux`
--
ALTER TABLE `niveaux`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `objectif_globaux`
--
ALTER TABLE `objectif_globaux`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `objectif_pedagogique`
--
ALTER TABLE `objectif_pedagogique`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `participant_groupe`
--
ALTER TABLE `participant_groupe`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `pedagogique`
--
ALTER TABLE `pedagogique`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plan_formations`
--
ALTER TABLE `plan_formations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `presences`
--
ALTER TABLE `presences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question_evaluations`
--
ALTER TABLE `question_evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `question_fille`
--
ALTER TABLE `question_fille`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `question_mere`
--
ALTER TABLE `question_mere`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `receuil_informations`
--
ALTER TABLE `receuil_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recommandation`
--
ALTER TABLE `recommandation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recueil_informations`
--
ALTER TABLE `recueil_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reponse_evaluationchaud`
--
ALTER TABLE `reponse_evaluationchaud`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `reponse_pour_questions`
--
ALTER TABLE `reponse_pour_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `responsables`
--
ALTER TABLE `responsables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ressources`
--
ALTER TABLE `ressources`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `secteurs`
--
ALTER TABLE `secteurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stagiaires`
--
ALTER TABLE `stagiaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stagiaire_pour_test_niveaux`
--
ALTER TABLE `stagiaire_pour_test_niveaux`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tarif_categories`
--
ALTER TABLE `tarif_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_abonnements`
--
ALTER TABLE `type_abonnements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `type_abonnement_roles`
--
ALTER TABLE `type_abonnement_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_abonnes`
--
ALTER TABLE `type_abonnes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_champs`
--
ALTER TABLE `type_champs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_facture`
--
ALTER TABLE `type_facture`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `type_payement`
--
ALTER TABLE `type_payement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choix_pour_questions`
--
ALTER TABLE `choix_pour_questions`
  ADD CONSTRAINT `choix_pour_questions_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `question_evaluations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `conclusion`
--
ALTER TABLE `conclusion`
  ADD CONSTRAINT `conclusion_ibfk_1` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `demande_test_niveaux`
--
ALTER TABLE `demande_test_niveaux`
  ADD CONSTRAINT `demande_test_niveaux_ibfk_1` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `demande_test_niveaux_ibfk_2` FOREIGN KEY (`cfp_id`) REFERENCES `cfps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `demande_test_niveaux_ibfk_3` FOREIGN KEY (`formation_id`) REFERENCES `formations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `demmande_cfp_etp`
--
ALTER TABLE `demmande_cfp_etp`
  ADD CONSTRAINT `demmande_cfp_etp_ibfk_1` FOREIGN KEY (`demmandeur_cfp_id`) REFERENCES `cfps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `demmande_cfp_etp_ibfk_2` FOREIGN KEY (`inviter_etp_id`) REFERENCES `entreprises` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `demmande_cfp_formateur`
--
ALTER TABLE `demmande_cfp_formateur`
  ADD CONSTRAINT `demmande_cfp_formateur_ibfk_1` FOREIGN KEY (`inviter_formateur_id`) REFERENCES `formateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `demmande_cfp_formateur_ibfk_2` FOREIGN KEY (`demmandeur_cfp_id`) REFERENCES `cfps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `demmande_etp_cfp`
--
ALTER TABLE `demmande_etp_cfp`
  ADD CONSTRAINT `demmande_etp_cfp_ibfk_1` FOREIGN KEY (`inviter_cfp_id`) REFERENCES `cfps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `demmande_etp_cfp_ibfk_2` FOREIGN KEY (`demmandeur_etp_id`) REFERENCES `entreprises` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `demmande_formateur_cfp`
--
ALTER TABLE `demmande_formateur_cfp`
  ADD CONSTRAINT `demmande_formateur_cfp_ibfk_1` FOREIGN KEY (`demmandeur_formateur_id`) REFERENCES `formateurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `demmande_formateur_cfp_ibfk_2` FOREIGN KEY (`inviter_cfp_id`) REFERENCES `cfps` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_evaluation_action_formation`
--
ALTER TABLE `detail_evaluation_action_formation`
  ADD CONSTRAINT `detail_evaluation_action_formation_ibfk_1` FOREIGN KEY (`evaluation_action_formation_id`) REFERENCES `evaluation_action_formation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_evaluation_action_formation_ibfk_2` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_recommandation`
--
ALTER TABLE `detail_recommandation`
  ADD CONSTRAINT `detail_recommandation_ibfk_1` FOREIGN KEY (`recommandation_id`) REFERENCES `recommandation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_recommandation_ibfk_2` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `evaluation_resultat`
--
ALTER TABLE `evaluation_resultat`
  ADD CONSTRAINT `evaluation_resultat_ibfk_1` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feed_back`
--
ALTER TABLE `feed_back`
  ADD CONSTRAINT `feed_back_ibfk_1` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `objectif_globaux`
--
ALTER TABLE `objectif_globaux`
  ADD CONSTRAINT `objectif_globaux_ibfk_1` FOREIGN KEY (`but_objectif_id`) REFERENCES `but_objectif` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `objectif_globaux_ibfk_2` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `objectif_pedagogique`
--
ALTER TABLE `objectif_pedagogique`
  ADD CONSTRAINT `objectif_pedagogique_ibfk_1` FOREIGN KEY (`pedagogique_id`) REFERENCES `pedagogique` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `objectif_pedagogique_ibfk_2` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `question_evaluations`
--
ALTER TABLE `question_evaluations`
  ADD CONSTRAINT `question_evaluations_ibfk_1` FOREIGN KEY (`cfp_id`) REFERENCES `cfps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `question_evaluations_ibfk_2` FOREIGN KEY (`formation_id`) REFERENCES `formations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reponse_pour_questions`
--
ALTER TABLE `reponse_pour_questions`
  ADD CONSTRAINT `reponse_pour_questions_ibfk_1` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reponse_pour_questions_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `question_evaluations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reponse_pour_questions_ibfk_3` FOREIGN KEY (`demande_tn_id`) REFERENCES `demande_test_niveaux` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stagiaire_pour_test_niveaux`
--
ALTER TABLE `stagiaire_pour_test_niveaux`
  ADD CONSTRAINT `stagiaire_pour_test_niveaux_ibfk_1` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stagiaire_pour_test_niveaux_ibfk_2` FOREIGN KEY (`demande_tn_id`) REFERENCES `demande_test_niveaux` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
