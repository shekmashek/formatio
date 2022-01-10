-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 23 nov. 2021 à 08:43
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_suiviformation`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `admins`
--

INSERT INTO `admins` (`id`, `nom`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Nicole', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `annee_plans`
--

CREATE TABLE `annee_plans` (
  `id` bigint(20) NOT NULL,
  `entreprise_id` bigint(20) NOT NULL,
  `Etat` varchar(255) NOT NULL,
  `Annee` year(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `annee_plans`
--

INSERT INTO `annee_plans` (`id`, `entreprise_id`, `Etat`, `Annee`, `created_at`, `updated_at`) VALUES
(1, 8, 'Ouvert', 2021, '2021-11-19 07:47:54', '0000-00-00 00:00:00'),
(2, 8, 'Ouvert', 2020, '2021-11-19 07:47:54', '0000-00-00 00:00:00'),
(4, 8, 'Ouvert', 2019, '2021-11-19 04:48:18', '2021-11-19 04:48:18'),
(5, 1, 'Ouvert', 2017, '2021-11-19 05:10:21', '2021-11-19 05:10:21');

-- --------------------------------------------------------

--
-- Structure de la table `but_objectif`
--

CREATE TABLE `but_objectif` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `but_objectif`
--

INSERT INTO `but_objectif` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Objectifs globaux de la formation :', NULL, NULL),
(2, 'Objectif pédagogique de la formation Compétences clé :', NULL, NULL),
(3, 'Objectif pédagogique de la formation Business Intelligence :', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `categorie_paiements`
--

CREATE TABLE `categorie_paiements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categorie` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `categorie_paiements`
--

INSERT INTO `categorie_paiements` (`id`, `categorie`, `created_at`, `updated_at`) VALUES
(1, 'Mensuel', '2021-11-22 06:01:06', '2021-11-22 06:01:06'),
(2, 'Annuel', '2021-11-22 06:01:06', '2021-11-22 06:01:06');

-- --------------------------------------------------------

--
-- Structure de la table `cfps`
--

CREATE TABLE `cfps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Nom` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Adresse` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Telephone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Domaine_de_formation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NIF` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `STAT` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RCS` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CIF` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `chef_departements`
--

CREATE TABLE `chef_departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_chef` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_chef` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre_chef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fonction_chef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_chef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_chef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chef_departements`
--

INSERT INTO `chef_departements` (`id`, `nom_chef`, `prenom_chef`, `genre_chef`, `fonction_chef`, `mail_chef`, `telephone_chef`, `entreprise_id`, `user_id`, `photos`, `created_at`, `updated_at`) VALUES
(43, 'qscd', 'qsd', 'Femme', 'qsdf', 'fheuesseghjyd@yahoo.fr', '54321', 1, 131, 'qscd16-11-2021.png', '2021-11-16 09:01:38', '2021-11-16 09:01:38'),
(44, 'Gael', 'gdf', 'Femme', 'fdg', 'rasoazerta@yahoo.fr', '1234356', 8, 132, 'Gael16-11-2021.png', '2021-11-16 09:07:12', '2021-11-16 09:07:12'),
(45, 'Rakoto', 'Randria', 'H', 'Chef de projet', 'Rakoto@gmail.com', '0341234566', 8, 62, 'manager.jpg', '2021-11-16 10:22:12', '2021-11-16 10:22:12'),
(46, 'Rakoto', 'Randria', 'H', 'Chef de projet', 'Rakoto@gmail.com', '0341234566', 8, 62, 'manager.jpg', '2021-11-16 10:22:43', '2021-11-16 10:22:43'),
(47, 'Rakoto', 'Randria', 'H', 'Chef de projet', 'Rakoto@gmail.com', '0341234566', 8, 62, 'manager.jpg', '2021-11-22 06:00:48', '2021-11-22 06:00:48'),
(48, 'Rakoto', 'Randria', 'H', 'Chef de projet', 'Rakoto@gmail.com', '0341234566', 8, 62, 'manager.jpg', '2021-11-22 06:01:06', '2021-11-22 06:01:06'),
(49, 'Rakoto', 'Randria', 'H', 'Chef de projet', 'Rakoto@gmail.com', '0341234566', 8, 62, 'manager.jpg', '2021-11-22 09:27:38', '2021-11-22 09:27:38'),
(50, 'Rakoto', 'Randria', 'H', 'Chef de projet', 'Rakoto@gmail.com', '0341234566', 8, 62, 'manager.jpg', '2021-11-22 10:34:27', '2021-11-22 10:34:27');

-- --------------------------------------------------------

--
-- Structure de la table `chef_dep_entreprises`
--

CREATE TABLE `chef_dep_entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `departement_entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `chef_departement_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `chef_dep_entreprises`
--

INSERT INTO `chef_dep_entreprises` (`id`, `departement_entreprise_id`, `chef_departement_id`, `created_at`, `updated_at`) VALUES
(1, 4, 38, NULL, NULL),
(2, 2, 43, NULL, NULL),
(3, 5, 44, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `competence_formateurs`
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
-- Déchargement des données de la table `competence_formateurs`
--

INSERT INTO `competence_formateurs` (`id`, `competence`, `formateur_id`, `created_at`, `updated_at`, `domaine`) VALUES
(8, 'Merise,UML', 18, '2021-11-16 11:18:16', '2021-11-16 11:18:16', 'modelisation'),
(9, 'laravel', 18, '2021-11-16 11:18:17', '2021-11-16 11:18:17', 'Web'),
(10, 'python', 18, '2021-11-16 11:18:17', '2021-11-16 11:18:17', 'native'),
(11, 'angular,nodeJs', 18, '2021-11-16 11:18:17', '2021-11-16 11:18:17', 'framework'),
(12, 'Merise', 1, '2021-11-22 04:14:25', '2021-11-22 04:14:25', 'Conception'),
(13, 'php laravel', 2, '2021-11-22 04:20:22', '2021-11-22 04:20:22', 'Developpement'),
(14, 'Merise', 2, '2021-11-22 04:20:22', '2021-11-22 04:20:22', 'Conception'),
(15, 'Javascript', 2, '2021-11-22 04:20:22', '2021-11-22 04:20:22', 'Front');

-- --------------------------------------------------------

--
-- Structure de la table `conclusion`
--

CREATE TABLE `conclusion` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `conclusion`
--

INSERT INTO `conclusion` (`id`, `description`, `projet_id`, `created_at`, `updated_at`) VALUES
(1, 'Les participants souhaitent pouvoir assister davantage à d’autres modules de formation EXCEL pour ne rien rater des astuces, des méthodes et tactiques. L’atmosphère de la formation a été également conviviale et agréable.', 14, NULL, NULL),
(2, 'L’atelier était assez animé, il avait une approche participative, et régnait un climat d’ambiance amicale. Mais surtout que les participants qui sont en majorité intéressés par les outils de Reporting, d’analyse et des fonctions avancées et de la communication évoquée sauront tirer le meilleur profit des résultats de ces sessions.', 14, NULL, NULL),
(3, 'Les participants félicitent Ocean Trade pour avoir organiser cet atelier qui à leur avis a atteint ses objectifs. Ils expriment toute leur satisfaction pour les résultats auxquels ils sont parvenus au cours de ces sessions de travail et souhaitent qu’il y ait une continuité pour l’atelier Excel.', 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

CREATE TABLE `cours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre_cours` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `programme_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `titre_cours`, `programme_id`, `created_at`, `updated_at`) VALUES
(8, '$', 3, '2021-10-18 09:55:04', '2021-10-18 09:55:04'),
(12, 'Référence nommée', 3, '2021-10-18 10:56:11', '2021-10-18 10:56:11'),
(15, 'Mathématique', 4, '2021-10-19 03:45:41', '2021-10-19 03:45:41'),
(16, 'Comparaison', 4, '2021-10-19 03:45:51', '2021-10-19 03:45:51'),
(17, 'Concaténation', 4, '2021-10-19 03:45:59', '2021-10-19 03:45:59'),
(18, 'Référence', 4, '2021-10-19 03:46:08', '2021-10-19 03:46:08'),
(19, 'Erreur', 5, '2021-10-19 03:46:27', '2021-10-19 03:46:27'),
(20, 'Vide', 5, '2021-10-19 03:46:35', '2021-10-19 03:46:35'),
(21, 'Logique', 5, '2021-10-19 03:46:47', '2021-10-19 03:46:47'),
(22, 'Texte', 5, '2021-10-19 03:46:56', '2021-10-19 03:46:56'),
(23, 'Numérique', 5, '2021-10-19 03:47:06', '2021-10-19 03:47:06'),
(24, 'Syntaxe', 7, '2021-10-19 03:47:31', '2021-10-19 03:47:31'),
(25, 'Fonctions de bases', 7, '2021-10-19 03:47:40', '2021-10-19 03:47:40'),
(26, 'SI() simple', 7, '2021-10-19 03:47:49', '2021-10-19 03:47:49'),
(27, 'Format', 9, '2021-10-19 03:48:05', '2021-10-19 03:48:05'),
(28, 'Diverses fonctions', 9, '2021-10-19 03:48:13', '2021-10-19 03:48:13'),
(29, 'Comparaison', 76, '2021-10-19 03:49:50', '2021-10-19 03:49:50'),
(30, 'Diverses fonctions logiques', 76, '2021-10-19 03:49:58', '2021-10-19 03:49:58'),
(31, 'SI() imbriquée', 77, '2021-10-19 03:50:12', '2021-10-19 03:50:12'),
(32, 'NB.SI() / NB.SI.ENS()', 77, '2021-10-19 03:50:21', '2021-10-19 03:50:21'),
(33, 'SOMME.SI() / SOMME.SI.ENS()', 77, '2021-10-19 03:50:30', '2021-10-19 03:50:30'),
(34, 'RECHERCHEV()', 78, '2021-10-19 03:50:46', '2021-10-19 03:50:46'),
(35, 'RECHERCHEH()', 78, '2021-10-19 03:50:56', '2021-10-19 03:50:56'),
(36, 'INDEX() et EQUIV()', 78, '2021-10-19 03:51:04', '2021-10-19 03:51:04'),
(37, 'Validation de données', 18, '2021-10-19 03:51:26', '2021-10-19 03:51:26'),
(38, 'Tri simple et avancé', 20, '2021-10-19 03:51:41', '2021-10-19 03:51:41'),
(39, 'Filtre simple et avancé', 20, '2021-10-19 03:51:50', '2021-10-19 03:51:50'),
(40, 'Mise en forme conditionnelle prédéfinie', 19, '2021-10-19 03:52:02', '2021-10-19 03:52:02'),
(41, 'Création de propre règle', 19, '2021-10-19 03:52:11', '2021-10-19 03:52:11'),
(42, 'Base TCD', 23, '2021-10-19 03:52:33', '2021-10-19 03:52:33'),
(43, 'Divers TCD', 23, '2021-10-19 03:52:42', '2021-10-19 03:52:42'),
(44, 'Base Graphique', 24, '2021-10-19 03:52:53', '2021-10-19 03:52:53'),
(46, 'Divers Graphiques', 24, '2021-10-19 03:53:09', '2021-10-19 03:53:09'),
(47, 'Graphiques personnalisés', 24, '2021-10-19 03:53:21', '2021-10-19 03:53:21'),
(48, 'Connexion de liaison', 79, '2021-10-19 03:53:35', '2021-10-19 03:53:35'),
(49, 'Excel', 80, '2021-10-19 03:53:59', '2021-10-19 03:53:59'),
(50, 'Texte', 80, '2021-10-19 03:54:07', '2021-10-19 03:54:07'),
(51, 'CSV', 80, '2021-10-19 03:54:15', '2021-10-19 03:54:15'),
(52, 'Base de données', 80, '2021-10-19 03:54:22', '2021-10-19 03:54:22'),
(53, 'Web', 80, '2021-10-19 03:54:31', '2021-10-19 03:54:31'),
(54, 'Dossier', 80, '2021-10-19 03:54:40', '2021-10-19 03:54:40'),
(55, 'Fraction', 81, '2021-10-19 03:54:53', '2021-10-19 03:54:53'),
(56, 'Fusion', 81, '2021-10-19 03:55:01', '2021-10-19 03:55:01'),
(57, 'Reduction des lignes', 81, '2021-10-19 03:55:09', '2021-10-19 03:55:09'),
(58, 'Gérer les colonnes', 81, '2021-10-19 03:55:18', '2021-10-19 03:55:18'),
(59, 'En tête promus', 81, '2021-10-19 03:55:25', '2021-10-19 03:55:25'),
(60, 'Nettoyage', 81, '2021-10-19 03:55:33', '2021-10-19 03:55:33'),
(61, 'Typage', 81, '2021-10-19 03:55:40', '2021-10-19 03:55:40'),
(62, 'Filtre', 81, '2021-10-19 03:55:49', '2021-10-19 03:55:49'),
(63, 'Ajouter des requêtes', 82, '2021-10-19 03:56:02', '2021-10-19 03:56:02'),
(64, 'Fusionner des requêtes', 82, '2021-10-19 03:56:11', '2021-10-19 03:56:11'),
(65, 'Combiner des fichiers', 82, '2021-10-19 03:56:21', '2021-10-19 03:56:21'),
(66, 'Pivoter', 83, '2021-10-19 03:56:33', '2021-10-19 03:56:33'),
(67, 'Dépivoter', 83, '2021-10-19 03:56:43', '2021-10-19 03:56:43'),
(68, 'Transposer', 83, '2021-10-19 03:56:50', '2021-10-19 03:56:50'),
(69, 'Remplissage', 83, '2021-10-19 03:56:58', '2021-10-19 03:56:58'),
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
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_departement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `nom_departement`, `created_at`, `updated_at`) VALUES
(1, 'Direction et administration générale', '2021-11-08 06:00:36', '2021-11-08 06:00:36'),
(2, 'Achat', '2021-11-08 06:00:36', '2021-11-08 06:00:36'),
(3, 'Finance et comptabilité', '2021-11-08 06:00:36', '2021-11-08 06:00:36'),
(4, 'Logistique', '2021-11-08 06:00:36', '2021-11-08 06:00:36'),
(5, 'Marketing et commerciale', '2021-11-08 06:00:36', '2021-11-08 06:00:36'),
(6, 'Production', '2021-11-08 06:00:36', '2021-11-08 06:00:36'),
(7, 'Recherche et développement', '2021-11-08 06:00:36', '2021-11-08 06:00:36'),
(8, 'Ressources humaines', '2021-11-08 06:00:36', '2021-11-08 06:00:36'),
(9, 'Achet', '2021-11-08 10:01:13', '2021-11-08 10:01:13'),
(10, 'Administratio,comptabilité et finance', '2021-11-08 10:01:13', '2021-11-08 10:01:13'),
(11, 'IT et Télécommunications ', '2021-11-08 10:01:13', '2021-11-08 10:01:13'),
(12, 'Ingénierie et Technique', '2021-11-08 10:01:13', '2021-11-08 10:01:13'),
(13, 'Management et Direction', '2021-11-08 10:01:13', '2021-11-08 10:01:13'),
(14, 'Marketing, Publicité et Evénement', '2021-11-08 10:01:13', '2021-11-08 10:01:13'),
(15, 'Secrétariat et Support Administratif', '2021-11-08 10:01:13', '2021-11-08 10:01:13'),
(16, 'Service légal', '2021-11-08 10:01:13', '2021-11-08 10:01:13'),
(17, 'Transport et Logistique', '2021-11-08 10:01:13', '2021-11-08 10:01:13'),
(18, 'Vente', '2021-11-08 10:01:13', '2021-11-08 10:01:13');

-- --------------------------------------------------------

--
-- Structure de la table `departement_entreprises`
--

CREATE TABLE `departement_entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departement_entreprises`
--

INSERT INTO `departement_entreprises` (`id`, `departement_id`, `entreprise_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2021-11-09 07:58:01', '2021-11-09 07:58:01'),
(2, 2, 1, '2021-11-09 07:58:01', '2021-11-09 07:58:01'),
(3, 6, 1, '2021-11-09 07:58:01', '2021-11-09 07:58:01'),
(4, 11, 8, '2021-11-09 07:59:07', '2021-11-09 07:59:07'),
(5, 12, 8, '2021-11-09 07:59:07', '2021-11-09 07:59:07');

-- --------------------------------------------------------

--
-- Structure de la table `description_champ_reponse`
--

CREATE TABLE `description_champ_reponse` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `descr_champs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_qst_fille` bigint(20) UNSIGNED NOT NULL,
  `nb_max` int(11) DEFAULT 1000,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `description_champ_reponse`
--

INSERT INTO `description_champ_reponse` (`id`, `descr_champs`, `id_qst_fille`, `nb_max`, `created_at`, `updated_at`) VALUES
(1, 'Note sur 10', 1, 10, NULL, NULL),
(2, 'Note sur 10', 2, 10, NULL, NULL),
(3, 'Pas de Tout', 3, NULL, NULL, NULL),
(5, 'En partie', 3, NULL, NULL, NULL),
(6, 'Totalement', 3, NULL, NULL, NULL),
(7, 'Pas de Tout', 4, NULL, NULL, NULL),
(8, 'Insuffisamment', 4, NULL, NULL, NULL),
(9, 'En partie', 4, NULL, NULL, NULL),
(10, 'Totalement', 4, NULL, NULL, NULL),
(11, 'Pas de Tout', 5, NULL, NULL, NULL),
(12, 'Insuffisamment', 5, NULL, NULL, NULL),
(13, 'En partie', 5, NULL, NULL, NULL),
(14, 'Totalement', 5, NULL, NULL, NULL),
(15, 'Pas de Tout', 6, NULL, NULL, NULL),
(16, 'Insuffisamment', 6, NULL, NULL, NULL),
(17, 'En partie', 6, NULL, NULL, NULL),
(18, 'Totalement', 6, NULL, NULL, NULL),
(19, 'Pas de Tout', 7, NULL, NULL, NULL),
(20, 'Insuffisamment', 7, NULL, NULL, NULL),
(21, 'En partie', 7, NULL, NULL, NULL),
(22, 'Totalement', 7, NULL, NULL, NULL),
(23, 'Pas de Tout', 8, NULL, NULL, NULL),
(24, 'Insuffisamment', 8, NULL, NULL, NULL),
(25, 'En partie', 8, NULL, NULL, NULL),
(26, 'Totalement', 8, NULL, NULL, NULL),
(27, 'Pas de Tout', 9, NULL, NULL, NULL),
(28, 'Insuffisamment', 9, NULL, NULL, NULL),
(29, 'En partie', 9, NULL, NULL, NULL),
(30, 'Totalement', 9, NULL, NULL, NULL),
(31, 'Adapté', 10, NULL, NULL, NULL),
(32, 'Trop rapide', 10, NULL, NULL, NULL),
(33, 'Trop lent', 10, NULL, NULL, NULL),
(34, 'Pas de Tout', 11, NULL, NULL, NULL),
(35, 'Insuffisamment', 11, NULL, NULL, NULL),
(36, 'En partie', 11, NULL, NULL, NULL),
(37, 'Totalement', 11, NULL, NULL, NULL),
(38, 'Pas de Tout', 12, NULL, NULL, NULL),
(39, 'Insuffisamment', 12, NULL, NULL, NULL),
(40, 'En partie', 12, NULL, NULL, NULL),
(41, 'Totalement', 12, NULL, NULL, NULL),
(42, 'Pas de Tout', 13, NULL, NULL, NULL),
(43, 'Insuffisamment', 13, NULL, NULL, NULL),
(44, 'En partie', 13, NULL, NULL, NULL),
(45, 'Totalement', 13, NULL, NULL, NULL),
(46, 'Pas de Tout', 14, NULL, NULL, NULL),
(47, 'Insuffisamment', 14, NULL, NULL, NULL),
(48, 'En partie', 14, NULL, NULL, NULL),
(49, 'Totalement', 14, NULL, NULL, NULL),
(50, 'Non', 15, NULL, NULL, NULL),
(51, 'Un peu', 15, NULL, NULL, NULL),
(52, 'Beaucoup', 15, NULL, NULL, NULL),
(53, 'Non', 16, NULL, NULL, NULL),
(54, 'Un peu', 16, NULL, NULL, NULL),
(55, 'Beaucoup', 16, NULL, NULL, NULL),
(56, 'Oui', 17, NULL, NULL, NULL),
(57, 'Non', 17, NULL, NULL, NULL),
(58, 'rédigez votre commentaire', 18, NULL, NULL, NULL),
(59, '', 19, NULL, NULL, NULL),
(60, '', 20, NULL, NULL, NULL),
(61, '', 21, NULL, NULL, NULL),
(62, '', 22, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `details`
--

CREATE TABLE `details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `h_debut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `h_fin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_detail` date NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `groupe_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `formateur_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `cours_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `details`
--

INSERT INTO `details` (`id`, `lieu`, `h_debut`, `h_fin`, `date_detail`, `projet_id`, `groupe_id`, `session_id`, `module_id`, `formateur_id`, `created_at`, `updated_at`, `cours_id`) VALUES
(9, 'Numerika Analamahintsy', '9', '11', '2021-10-18', 14, 5, 5, 9, 6, '2021-11-03 08:33:47', '2021-11-03 08:33:47', 0),
(10, 'Numerika Analamahintsy', '14', '16', '2021-10-20', 14, 5, 5, 9, 5, '2021-11-03 08:35:53', '2021-11-03 08:35:53', 0),
(11, 'Numerika Analamahintsy', '8', '11', '2021-10-28', 15, 6, 6, 2, 6, '2021-11-03 08:44:40', '2021-11-03 08:44:40', 0);

-- --------------------------------------------------------

--
-- Structure de la table `detail_evaluation_action_formation`
--

CREATE TABLE `detail_evaluation_action_formation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pourcent` decimal(5,2) NOT NULL,
  `evaluation_action_formation_id` bigint(20) UNSIGNED NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `detail_evaluation_action_formation`
--

INSERT INTO `detail_evaluation_action_formation` (`id`, `pourcent`, `evaluation_action_formation_id`, `projet_id`, `created_at`, `updated_at`) VALUES
(1, '90.00', 1, 14, NULL, NULL),
(2, '96.00', 2, 14, NULL, NULL),
(3, '84.00', 3, 14, NULL, NULL),
(4, '94.00', 4, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `detail_evaluation_apprenants`
--

CREATE TABLE `detail_evaluation_apprenants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `note_avant` decimal(4,2) NOT NULL DEFAULT 0.00,
  `note_apres` decimal(4,2) NOT NULL DEFAULT 0.00,
  `participant_groupe_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `detail_evaluation_apprenants`
--

INSERT INTO `detail_evaluation_apprenants` (`id`, `note_avant`, `note_apres`, `participant_groupe_id`, `created_at`, `updated_at`) VALUES
(1, '1.50', '2.75', 1, NULL, NULL),
(2, '0.60', '4.40', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `detail_recommandation`
--

CREATE TABLE `detail_recommandation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recommandation_id` bigint(20) UNSIGNED NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `detail_recommandation`
--

INSERT INTO `detail_recommandation` (`id`, `description`, `recommandation_id`, `projet_id`, `created_at`, `updated_at`) VALUES
(1, 'Les participants souhaitent la continuité de la formation.', 1, 14, NULL, NULL),
(2, 'Il faut éviter les absences. Car qu’on est absent, on ne peut plus suivre efficacement le cours.', 2, 14, NULL, NULL),
(3, 'Il est plus facile pour les participants de renforcer leurs compétences si les matériels utilisés lors des études de cas, proviennent vraiment de leurs fichiers de travail actuels.', 2, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `domaines`
--

CREATE TABLE `domaines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_domaine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `domaines`
--

INSERT INTO `domaines` (`id`, `nom_domaine`, `created_at`, `updated_at`) VALUES
(1, 'Bureautique', '2021-11-16 10:22:43', '2021-11-16 10:22:43'),
(2, 'Développement Personnel', '2021-11-16 10:22:43', '2021-11-16 10:22:43'),
(3, 'Management', '2021-11-16 10:22:43', '2021-11-16 10:22:43'),
(4, 'Projet', '2021-11-16 10:22:43', '2021-11-16 10:22:43'),
(5, 'Ressources Humaines', '2021-11-16 10:22:43', '2021-11-16 10:22:43'),
(6, 'Communication - WebMarketing', '2021-11-16 10:22:43', '2021-11-16 10:22:43');

-- --------------------------------------------------------

--
-- Structure de la table `encaissements`
--

CREATE TABLE `encaissements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facture_id` bigint(20) UNSIGNED NOT NULL,
  `montant_facture` decimal(15,2) DEFAULT 0.00,
  `libelle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payement` decimal(15,2) DEFAULT 0.00,
  `montant_ouvert` decimal(15,2) DEFAULT NULL,
  `date_encaissement` timestamp NOT NULL DEFAULT current_timestamp(),
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `encaissements_frais_annexe`
--

CREATE TABLE `encaissements_frais_annexe` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facture_id` bigint(20) UNSIGNED NOT NULL,
  `montant_frais_annexe_id` bigint(20) UNSIGNED NOT NULL,
  `montant_frais_annexe` decimal(15,2) DEFAULT 0.00 CHECK (`montant_frais_annexe` >= 0),
  `libelle` text COLLATE utf8mb4_unicode_ci DEFAULT '',
  `payement` decimal(15,2) DEFAULT 0.00 CHECK (`payement` >= 0),
  `montant_ouvert` decimal(15,2) DEFAULT 0.00 CHECK (`montant_ouvert` >= 0),
  `date_encaissement` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_etp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `NIF` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `STAT` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `RCS` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CIF` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `TVA` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Secteur_activite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom_etp`, `adresse`, `logo`, `created_at`, `updated_at`, `NIF`, `STAT`, `RCS`, `CIF`, `TVA`, `Secteur_activite`) VALUES
(1, 'Bolloré', 'Tamatave', '/XE31CYlSiJECTPTzddjOVqV0YWfHnDmSIbUsyWsW.png', '2021-09-08 05:05:32', '2021-09-08 05:05:32', '', '', '', '', '', ''),
(2, 'Ocean trade', 'Andraharo', '/Qx1BzA05e0N84tuldMXOrbdGzJVNXQQWlizrjvMj.png', '2021-09-09 04:23:22', '2021-09-09 04:23:22', '', '', '', '', '', ''),
(8, 'AXIAN', 'Tanjombato', '/nu6A18i0wk14FQxFBPrRWy3p2mlDFktkO9UZtgZp.png', '2021-10-26 06:24:01', '2021-10-26 06:24:01', '', '', '', '', '', ''),
(12, 'TROPICMAD', 'Bat TITAN III Zone Galaxy Andraharo Antananarivo', '/t5ysi7Ifejnn2VnbtnQNSULVMJcKjfA8io6xQsrR.png', '2021-11-03 05:57:01', '2021-11-03 05:57:01', '', '', '', '', '', ''),
(13, 'TEST', 'RTYUI', 'TEST15-11-2021.png', '2021-11-15 03:26:08', '2021-11-15 03:26:08', '12345', '1234', '1234567', '234567', '23456', 'CALL');

-- --------------------------------------------------------

--
-- Structure de la table `evaluation_action_formation`
--

CREATE TABLE `evaluation_action_formation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `evaluation_action_formation`
--

INSERT INTO `evaluation_action_formation` (`id`, `titre`, `created_at`, `updated_at`) VALUES
(1, 'Animation de la formation', NULL, NULL),
(2, 'Pertinence de la formation', NULL, NULL),
(3, 'Organisation de la formation', NULL, NULL),
(4, 'Contenu de la formation', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `evaluation_resultat`
--

CREATE TABLE `evaluation_resultat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `evaluation_resultat`
--

INSERT INTO `evaluation_resultat` (`id`, `description`, `projet_id`, `created_at`, `updated_at`) VALUES
(1, 'Tous les participants sont satisfaits de la formation.', 14, NULL, NULL),
(2, 'Globalement cette formation a répondu aux attentes des participants', 14, NULL, NULL),
(3, 'Le module traité pendant la formation a répondu aux attentes.', 14, NULL, NULL),
(4, 'Les méthodologies pédagogiques étaient adaptées, les présentations étaient claires,', 14, NULL, NULL),
(5, 'La théorie et la pratique étaient équilibrées, le rythme des cours était adéquat, la durée de la formation était trop juste.', 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `events_table`
--

CREATE TABLE `events_table` (
  `id` int(11) NOT NULL,
  `start` date NOT NULL,
  `title` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `events_table`
--

INSERT INTO `events_table` (`id`, `start`, `title`) VALUES
(1, '2021-09-16', 'OCEAN2021'),
(2, '2021-09-14', 'BOLLORE');

-- --------------------------------------------------------

--
-- Structure de la table `executions`
--

CREATE TABLE `executions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qualite_formation` int(11) NOT NULL,
  `evaluation_formateur` int(11) NOT NULL,
  `msexcel_fondamentaux` int(11) NOT NULL,
  `msexcel_calculsFonctions` int(11) NOT NULL,
  `msexcel_gestionDonnées` int(11) NOT NULL,
  `msexcel_BI` int(11) NOT NULL,
  `msexcel_VBA` int(11) NOT NULL,
  `msBI_fondamentaux` int(11) NOT NULL,
  `mseBI_dax` int(11) NOT NULL,
  `msBI_dataviz` int(11) NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `session_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `executions`
--

INSERT INTO `executions` (`id`, `qualite_formation`, `evaluation_formateur`, `msexcel_fondamentaux`, `msexcel_calculsFonctions`, `msexcel_gestionDonnées`, `msexcel_BI`, `msexcel_VBA`, `msBI_fondamentaux`, `mseBI_dax`, `msBI_dataviz`, `stagiaire_id`, `session_id`, `created_at`, `updated_at`) VALUES
(1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, '2021-09-14 04:45:23', '2021-09-14 04:45:23');

-- --------------------------------------------------------

--
-- Structure de la table `experience_formateurs`
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
-- Déchargement des données de la table `experience_formateurs`
--

INSERT INTO `experience_formateurs` (`id`, `nom_entreprise`, `poste_occuper`, `debut_travail`, `fin_travail`, `taches`, `formateur_id`, `created_at`, `updated_at`) VALUES
(6, 'Numerika', 'chef de projet', '2021-11-13', '2021-11-17', 'Responsable projet', 18, '2021-11-16 11:18:17', '2021-11-16 11:18:17'),
(7, 'Axian', 'Stagiaire', '2021-11-18', '2021-11-19', 'Responsable design', 18, '2021-11-16 11:18:17', '2021-11-16 11:18:17'),
(8, 'Numerika', 'Stagiaire', '2021-11-19', '2021-11-20', 'Responsable design', 18, '2021-11-16 11:18:17', '2021-11-16 11:18:17'),
(9, 'Numerika', 'Developpeur', '2021-11-03', '2021-11-06', 'developpement', 1, '2021-11-22 04:14:25', '2021-11-22 04:14:25'),
(10, 'Numerika', 'Developpeur Front', '2021-10-06', '2021-11-01', 'Design', 2, '2021-11-22 04:20:22', '2021-11-22 04:20:22'),
(11, 'IFT', 'Developpeur', '2021-11-06', '2021-11-08', 'Intégration', 2, '2021-11-22 04:20:22', '2021-11-22 04:20:22');

-- --------------------------------------------------------

--
-- Structure de la table `factures`
--

CREATE TABLE `factures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bon_de_commande` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facture` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant_total` decimal(15,2) DEFAULT NULL,
  `date_facture` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `projet_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type_payement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `tax_id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `other_message` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hors_taxe` decimal(15,2) DEFAULT 0.00 CHECK (`hors_taxe` >= 0),
  `qte` int(11) NOT NULL DEFAULT 1,
  `num_facture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#0000FCT',
  `type_financement_id` bigint(20) UNSIGNED NOT NULL,
  `groupe_id` bigint(20) UNSIGNED NOT NULL,
  `pu` int(11) NOT NULL DEFAULT 1,
  `activiter` tinyint(1) NOT NULL DEFAULT 0,
  `reference_bc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#-------',
  `remise` int(11) DEFAULT 0,
  `type_facture_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `factures`
--

INSERT INTO `factures` (`id`, `bon_de_commande`, `facture`, `montant_total`, `date_facture`, `projet_id`, `type_payement_id`, `created_at`, `updated_at`, `invoice_date`, `due_date`, `tax_id`, `description`, `other_message`, `hors_taxe`, `qte`, `num_facture`, `type_financement_id`, `groupe_id`, `pu`, `activiter`, `reference_bc`, `remise`, `type_facture_id`) VALUES
(4, 'Bon_commande_Facture/6_2/BonCommande_Projet_6_2.pdf', 'Bon_commande_Facture/6_2/Facture_Projet_6_2.pdf', '500000.00', '2021-11-23 07:09:58', 15, 1, '2021-11-23 07:09:47', '2021-11-23 07:09:47', '2021-11-23', '2021-11-23', 2, 'facture d\'avoir', 'facture d\'avoir session 1', '500000.00', 5, 'ETU000976', 1, 6, 100000, 1, 'R-13', 0, 2),
(5, 'Bon_commande_Facture/6_1/BonCommande_Projet_6_1.pdf', 'Bon_commande_Facture/6_1/Facture_Projet_6_1.pdf', '6600000.00', '2021-11-23 07:25:30', 15, 1, '2021-11-23 07:25:21', '2021-11-23 07:25:21', '2021-11-23', '2021-11-30', 1, 'facture définitive', 'Facture definitive de AXIAN', '5500000.00', 11, 'ETU0001', 1, 6, 500000, 1, 'R-14', 20000, 1),
(6, 'Bon_commande_Facture/6_3/BonCommande_Projet_6_3.pdf', 'Bon_commande_Facture/6_3/Facture_Projet_6_3.pdf', '1000000.00', '2021-11-23 07:27:46', 15, 1, '2021-11-23 07:27:37', '2021-11-23 07:27:37', '2021-12-22', '2021-11-23', 2, 'facture d\'acompte', NULL, '1000000.00', 2, 'ETU0002', 1, 6, 500000, 1, 'R-15', 0, 3);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `feed_back`
--

CREATE TABLE `feed_back` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `feed_back`
--

INSERT INTO `feed_back` (`id`, `description`, `projet_id`, `created_at`, `updated_at`) VALUES
(1, 'L’initiative de Ocean trade a été très appréciée pour avoir organiser cet atelier de formation Excel. En général, l’atelier de formation sur Excel a été vraiment utile, et l’atelier a permis de faire ressortir le point faible du système mis en place actuellement au sein de l’organisation qu’il faut impérativement combler.\r\nIl est évident que ces employés ont besoins de maîtriser Excel, mais pour plus d’efficacité dans la résolution de leur problème, il est fortement recommandé de compléter les modules de formations afin qu’ils puissent être en mesure de résoudre des problèmes complexes de manière autonome et avec efficacité. Aussi être capable de mettre en place un tableau de bord interactif dans Excel.\r\n', 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `formateurs`
--

CREATE TABLE `formateurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero_formateur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photos` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CIN` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formateurs`
--

INSERT INTO `formateurs` (`id`, `nom_formateur`, `prenom_formateur`, `mail_formateur`, `numero_formateur`, `photos`, `created_at`, `updated_at`, `genre`, `date_naissance`, `adresse`, `CIN`, `specialite`, `niveau`) VALUES
(1, 'RAHARIFETRA', 'Holy Nicole', 'nicole@gmail.com', '0342456799', 'RAHARIFETRAHoly_Nicole22-11-2021.png', '2021-11-22 04:14:25', '2021-11-22 04:14:25', 'femme', '2021-11-02', 'Antanimena', '301012020162', 'Developpeur Back end', 'Bacc +4'),
(2, 'Rhumer', 'Nico Ralison', 'nicroh@gmail.com', '0332456700', 'RhumerNico_Ralison22-11-2021.png', '2021-11-22 04:20:22', '2021-11-22 04:20:22', 'homme', '1997-08-10', 'Lot IIId 41 Ambohipo,Antananarivo 101', '301987654345', 'Design', 'Bacc +3');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domaine_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `nom_formation`, `domaine_id`, `created_at`, `updated_at`) VALUES
(1, 'MS Excel', 1, NULL, NULL),
(2, 'Ms Power BI', 1, NULL, NULL),
(5, 'Autres logiciels', 1, '2021-11-17 04:00:01', '2021-11-17 04:00:01'),
(6, 'Affirmation de soi et changement', 2, '2021-11-17 04:00:27', '2021-11-17 04:00:27'),
(7, 'Gestion du stress et des émotions', 2, '2021-11-17 04:00:41', '2021-11-17 04:00:41'),
(8, 'Leadership', 2, '2021-11-17 04:06:54', '2021-11-17 04:06:54'),
(9, 'Management d\'équipe', 3, '2021-11-17 04:07:18', '2021-11-17 04:07:18'),
(10, 'Leadership, changement, gestion des conflits', 3, '2021-11-17 04:07:28', '2021-11-17 04:07:28'),
(11, 'Gestion de projet', 4, '2021-11-17 04:07:45', '2021-11-17 04:07:45'),
(12, 'Management de projet', 4, '2021-11-17 04:07:55', '2021-11-17 04:07:55'),
(13, 'Paie', 5, '2021-11-17 04:08:21', '2021-11-17 04:08:21'),
(14, 'Droit social', 5, '2021-11-17 04:08:31', '2021-11-17 04:08:31'),
(15, 'Webmarketing', 6, '2021-11-17 04:08:53', '2021-11-17 04:08:53'),
(16, 'PAO et Multimédia', 6, '2021-11-17 04:09:04', '2021-11-17 04:09:04');

-- --------------------------------------------------------

--
-- Structure de la table `frais_annexes`
--

CREATE TABLE `frais_annexes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `frais_annexes`
--

INSERT INTO `frais_annexes` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'frais de deplacement', NULL, NULL),
(2, 'frais d\'hebergement', NULL, NULL),
(3, 'frais de restauration', NULL, NULL),
(4, 'frais de logistique', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `froid_evaluations`
--

CREATE TABLE `froid_evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cours_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `froid_evaluations`
--

INSERT INTO `froid_evaluations` (`id`, `cours_id`, `status`, `projet_id`, `stagiaire_id`, `created_at`, `updated_at`) VALUES
(33, 8, '3', 14, 8, NULL, NULL),
(34, 12, '3', 14, 8, NULL, NULL),
(35, 15, '4', 14, 8, NULL, NULL),
(36, 16, '4', 14, 8, NULL, NULL),
(37, 17, '4', 14, 8, NULL, NULL),
(38, 18, '4', 14, 8, NULL, NULL),
(39, 19, '2', 14, 8, NULL, NULL),
(40, 20, '2', 14, 8, NULL, NULL),
(41, 21, '3', 14, 8, NULL, NULL),
(42, 22, '3', 14, 8, NULL, NULL),
(43, 23, '4', 14, 8, NULL, NULL),
(44, 24, '1', 14, 8, NULL, NULL),
(45, 25, '1', 14, 8, NULL, NULL),
(46, 26, '1', 14, 8, NULL, NULL),
(47, 27, '0', 14, 8, NULL, NULL),
(48, 28, '0', 14, 8, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `froid_evaluation_tables`
--

CREATE TABLE `froid_evaluation_tables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cours_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `groupes`
--

CREATE TABLE `groupes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_groupe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `groupes`
--

INSERT INTO `groupes` (`id`, `nom_groupe`, `projet_id`, `created_at`, `updated_at`) VALUES
(5, 'G1', 14, '2021-11-03 06:39:29', '2021-11-03 06:39:29'),
(6, 'G1', 15, '2021-11-03 06:39:39', '2021-11-03 06:39:39');

-- --------------------------------------------------------

--
-- Structure de la table `limite_user_abonnements`
--

CREATE TABLE `limite_user_abonnements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre_limite` int(11) NOT NULL,
  `type_abonnement_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_07_19_122239_create_formations_table', 1),
(5, '2021_07_19_122454_create_modules_table', 1),
(6, '2021_07_22_060001_create_projets_table', 1),
(7, '2021_07_28_072732_create_entreprises_table', 1),
(8, '2021_07_28_072832_create_stagiaires_table', 1),
(9, '2021_07_28_073309_create_details_table', 1),
(10, '2021_07_28_073348_create_executions_table', 1),
(11, '2021_08_03_062548_create_responsables_table', 1),
(12, '2021_08_04_084221_create_admins_table', 1),
(13, '2021_09_02_091238_create_events_table', 2),
(14, '2021_09_02_105117_create_bookings_table', 3),
(15, '2021_09_03_084928_create_events_table', 4),
(16, '2021_09_06_063111_create_formateurs_table', 5),
(17, '2021_09_06_064903_create_details_table', 6),
(18, '2021_09_06_065957_create_executions_table', 6),
(19, '2021_09_06_072727_create_formateurs_table', 7),
(20, '2021_09_06_072901_create_details_table', 7),
(21, '2021_09_06_073225_create_executions_table', 7),
(22, '2021_09_08_070709_create_entreprises_table', 8),
(23, '2021_09_08_071113_create_stagiaires_table', 8),
(24, '2021_09_08_071259_create_responsables_table', 8),
(26, '2021_09_08_071508_create_projets_table', 8),
(27, '2021_09_08_071547_create_groupes_table', 8),
(28, '2021_09_08_071642_create_sessions_table', 8),
(29, '2021_09_08_071800_create_details_table', 8),
(30, '2021_09_08_072247_create_executions_table', 8),
(31, '2021_09_08_073011_create_executions_table', 9),
(32, '2021_09_13_114242_create_participant_sessions_table', 10),
(33, '2021_10_05_081706_create_programmes_table', 11),
(34, '2021_10_06_124350_create_cours_table', 12),
(35, '2021_10_14_064949_create_presence_table', 13),
(36, '2021_10_14_065454_create_presences_table', 14),
(37, '2021_10_14_070557_create_presences_table', 15),
(38, '2021_10_14_084023_create_presences_table', 16),
(39, '2021_10_15_082102_create_presences_table', 17),
(40, '2021_10_20_074056_create_froid_evaluations_table', 18),
(41, '2021_10_26_083910_create_roles_table', 19),
(42, '2021_11_03_073212_create_froid_evaluations_table', 20),
(43, '2021_11_03_074040_create_froid_evaluations_table', 21),
(44, '2021_11_03_093409_add_numero_session_column_in_sessions_table', 22),
(45, '2021_10_27_083615_create_froid_evaluation_tables', 23),
(46, '2021_11_08_084929_create_departements_table', 24),
(47, '2021_11_08_082816_create_frais_annexes_table', 25),
(48, '2021_11_08_122957_create_departement_entreprises_table', 26),
(49, '2021_11_08_123353_create_chef_departements_table', 27),
(50, '2021_11_08_123626_create_chef_dep_entreprises_table', 28),
(51, '2021_11_08_124321_add_cin_column_in_stagiaires_table', 29),
(52, '2021_11_11_110826_add_column_in_stagiaires_table', 30),
(53, '2021_11_12_114021_add_column_in_modules_table', 31),
(54, '2021_11_11_132019_add_column_in_formateurs_table', 32),
(55, '2021_11_14_100536_create_recueil_informations_table', 33),
(56, '2021_11_14_100629_create_plan_formations_table', 33),
(57, '2021_11_16_093129_create_chef_dep_entreprises_table', 34),
(58, '2021_11_16_093615_create_chef_dep_entreprises_table', 35),
(59, '2021_11_16_121427_add_column_in_recueil_informations_table', 36),
(60, '2021_11_16_122708_add_column_in_recueil_informations_table', 37),
(61, '2021_11_16_131502_create_domaines_table', 37),
(62, '2021_11_12_061328_create_competence_formateurs_table', 38),
(63, '2021_11_12_061713_create_experience_formateurs_table', 38),
(64, '2021_11_12_072415_add_column_in_formateurs_table', 38),
(65, '2021_11_12_074204_add_column_in_competence_formateurs_table', 38),
(66, '2021_09_08_071408_create_formateurs_table', 39),
(67, '2021_11_22_081050_create_categorie_paiements_table', 40),
(68, '2021_11_22_081125_create_type_abonnements_table', 40),
(69, '2021_11_22_081210_create_tarif_categories_table', 40),
(70, '2021_11_22_082722_create_limite_user_abonnements_table', 40),
(71, '2021_11_22_091055_create_limite_user_abonnements_table', 41),
(72, '2021_11_22_133302_create_cfps_table', 42),
(73, '2021_11_22_133729_add_column_in_cfps_table', 43),
(74, '2021_11_22_134203_add_column_user_id_in_cfps_table', 44);

-- --------------------------------------------------------

--
-- Structure de la table `mode_financements`
--

CREATE TABLE `mode_financements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `mode_financements`
--

INSERT INTO `mode_financements` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Virement banquaire', NULL, NULL),
(2, 'Check', NULL, NULL),
(3, 'Espece', NULL, NULL),
(4, 'Mobile Money', NULL, NULL);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `moduleformation`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `moduleformation` (
`module_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`prix` int(11)
,`duree` int(11)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
);

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE `modules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Reference` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formation_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `Prix` int(11) NOT NULL,
  `Duree` int(11) NOT NULL,
  `prerequis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modalite_formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `modules`
--

INSERT INTO `modules` (`id`, `Reference`, `nom_module`, `formation_id`, `created_at`, `updated_at`, `Prix`, `Duree`, `prerequis`, `objectif`, `modalite_formation`) VALUES
(2, 'MOD_EX02', 'NII.Calculs et Fonctions', 1, NULL, NULL, 300000, 12, '', '', ''),
(3, 'MOD_EX03', 'NIII.Organisation et gestion des données', 1, NULL, NULL, 300000, 12, '', '', ''),
(4, 'MOD_EX04', 'NIV.Business Intelligence', 1, NULL, NULL, 350000, 12, '', '', ''),
(5, 'MOD_EX05', 'NV.VBA', 1, NULL, NULL, 450000, 18, '', '', ''),
(6, 'MOD_BI01', 'NI.Fondamentaux', 2, NULL, '2021-08-31 09:07:56', 450000, 18, '', '', ''),
(7, 'MOD_BI02', 'NII.Perfectionnement Dax', 2, NULL, NULL, 450000, 18, '', '', ''),
(8, 'MOD_BI03', 'NIII.Dataviz et analytics', 2, NULL, NULL, 450000, 18, '', '', ''),
(9, 'MOD_EX01', 'NI.Fondamentaux', 1, '2021-09-01 03:25:44', '2021-09-01 03:25:44', 300000, 12, '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `montant_frais_annexes`
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `montant_frais_annexes`
--

INSERT INTO `montant_frais_annexes` (`id`, `frais_annexe_id`, `num_facture`, `montant`, `description`, `date_frais_annexe`, `hors_taxe`, `qte`, `pu`, `created_at`, `updated_at`) VALUES
(1, 1, 'ETU000976', '3000.00', 'bus', '2021-11-23 07:09:47', '3000.00', 3, 1000, '2021-11-23 07:09:47', '2021-11-23 07:09:47'),
(2, 3, 'ETU000976', '10000.00', 'vary+Loaka', '2021-11-23 07:09:47', '10000.00', 2, 5000, '2021-11-23 07:09:47', '2021-11-23 07:09:47'),
(3, 4, 'ETU0001', '216000.00', 'PC+ facture definitive', '2021-11-23 07:25:21', '180000.00', 9, 20000, '2021-11-23 07:25:21', '2021-11-23 07:25:21');

-- --------------------------------------------------------

--
-- Structure de la table `objectif_globaux`
--

CREATE TABLE `objectif_globaux` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `but_objectif_id` bigint(20) UNSIGNED NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `objectif_globaux`
--

INSERT INTO `objectif_globaux` (`id`, `description`, `but_objectif_id`, `projet_id`, `created_at`, `updated_at`) VALUES
(1, 'Se perfectionner et élargir ses connaissances sur Excel', 1, 14, NULL, NULL),
(2, 'Maîtriser les techniques de calculs (avancés) qu’importe la difficulté et la complexité des formules', 1, 14, NULL, NULL),
(3, 'Être en mesure de concevoir et analyser les données', 1, 14, NULL, NULL),
(4, 'Gagner du temps et augmenter sa productivité', 1, 14, NULL, NULL),
(5, 'Acquérir les fondamentaux sine qua non à la bonne pratique d’utilisation du logiciel Microsoft Excel.', 2, 14, NULL, NULL),
(6, 'Savoir créer et comprendre une formule qu’importe la complexité et la longueur', 2, 14, NULL, NULL),
(7, 'Organiser et synthétiser les données.', 2, 14, NULL, NULL),
(8, 'Acquérir les fondamentaux de la transformation et de l’automatisation des tâches avec Power QueryAcquérir les fondamentaux sine qua non à la bonne pratique d’utilisation du logiciel Microsoft Excel.', 3, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `objectif_pedagogique`
--

CREATE TABLE `objectif_pedagogique` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pedagogique_id` bigint(20) UNSIGNED NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `objectif_pedagogique`
--

INSERT INTO `objectif_pedagogique` (`id`, `description`, `pedagogique_id`, `projet_id`, `created_at`, `updated_at`) VALUES
(1, 'Formation présentielle et en ligne', 1, 14, NULL, NULL),
(2, 'Apport de connaissance théorique', 1, 14, NULL, NULL),
(3, 'Alternance théorie/pratique', 1, 14, NULL, NULL),
(4, 'Mode opératoire', 1, 14, NULL, NULL),
(5, 'Exercices de mise en pratique', 1, 14, NULL, NULL),
(6, 'Quiz de révision', 1, 14, NULL, NULL),
(7, 'Questions/réponses', 1, 14, NULL, NULL),
(8, 'Support numérique Excel et Pdf', 1, 14, NULL, NULL),
(9, 'Un ordinateur pour chaque apprenant', 2, 14, NULL, NULL),
(10, 'Logiciel Excel, au minimum une version 2016', 2, 14, NULL, NULL),
(11, 'Un cahier et un stylo pour chacun d’eux.', 2, 14, NULL, NULL),
(12, 'Un vidéo projecteur', 2, 14, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `participantsessions`
--

CREATE TABLE `participantsessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `detail_id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `participantsessions`
--

INSERT INTO `participantsessions` (`id`, `detail_id`, `stagiaire_id`, `created_at`, `updated_at`) VALUES
(10, 9, 8, '2021-11-03 08:36:25', '2021-11-03 08:36:25'),
(11, 11, 9, '2021-11-03 08:45:11', '2021-11-03 08:45:11');

-- --------------------------------------------------------

--
-- Structure de la table `participant_groupe`
--

CREATE TABLE `participant_groupe` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `stagaire_id` bigint(20) UNSIGNED NOT NULL,
  `groupe_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `participant_groupe`
--

INSERT INTO `participant_groupe` (`id`, `stagaire_id`, `groupe_id`, `created_at`, `updated_at`) VALUES
(1, 8, 5, '2021-11-05 10:47:48', '2021-11-05 10:47:48'),
(2, 9, 5, '2021-11-05 10:47:48', '2021-11-05 10:47:48');

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('nicrah16@gmail.com', '$2y$10$kzWG6iExT.bKcj6LlmQiPeCqWKQfXkwSyoRDaBsNMLreXS1uRKdM2', '2021-10-26 03:14:12');

-- --------------------------------------------------------

--
-- Structure de la table `pedagogique`
--

CREATE TABLE `pedagogique` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `pedagogique`
--

INSERT INTO `pedagogique` (`id`, `titre`, `description`, `created_at`, `updated_at`) VALUES
(1, '4. METHODE PEDAGOGIQUE', '', NULL, NULL),
(2, '4.1.MOYEN PEDAGOGIQUE', 'Pour une action de formation optimale, nous avons besoin des moyens suivantes :', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `plan_formations`
--

CREATE TABLE `plan_formations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `typologie_formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectif_attendu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cout_previsionnel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mode_financement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recueil_information_id` bigint(20) UNSIGNED NOT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `annee_plan_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `plan_formations`
--

INSERT INTO `plan_formations` (`id`, `entreprise_id`, `typologie_formation`, `objectif_attendu`, `cout_previsionnel`, `mode_financement`, `recueil_information_id`, `statut`, `created_at`, `updated_at`, `annee_plan_id`) VALUES
(1, 1, 'Adaptation au poste', 'SDFGH', '123456', 'Fonds propre', 4, 'A venir', '2021-11-19 09:40:20', '2021-11-19 09:40:20', 1),
(2, 1, 'Développement de compétences', 'TFYGHJIKO', '123000', 'FMFP', 5, 'A venir', '2021-11-19 09:48:26', '2021-11-19 09:48:26', 1),
(3, 1, 'Adaptation au poste', 'ERTY', '120000', 'Fonds propre', 7, 'A venir', '2021-11-19 10:08:59', '2021-11-19 10:08:59', 1);

-- --------------------------------------------------------

--
-- Structure de la table `presences`
--

CREATE TABLE `presences` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `presences`
--

INSERT INTO `presences` (`id`, `status`, `detail_id`, `stagiaire_id`, `created_at`, `updated_at`) VALUES
(17, 'Présent', 1, 1, NULL, NULL),
(18, 'Absent', 1, 2, NULL, NULL),
(21, 'Présent', 11, 9, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `programmes`
--

CREATE TABLE `programmes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `programmes`
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
(84, 'AJOUT COLONNE', 4, '2021-10-20 05:36:51', '2021-10-20 05:36:51'),
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
-- Structure de la table `projets`
--

CREATE TABLE `projets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_projet` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `projets`
--

INSERT INTO `projets` (`id`, `nom_projet`, `entreprise_id`, `created_at`, `updated_at`) VALUES
(14, '14_TROPICMAD_03/11/2021', 12, '2021-11-03 06:29:19', '2021-11-03 06:29:19'),
(15, '15_AXIAN_03/11/2021', 8, '2021-11-03 06:29:54', '2021-11-03 06:29:54');

-- --------------------------------------------------------

--
-- Structure de la table `question_fille`
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
-- Déchargement des données de la table `question_fille`
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
-- Structure de la table `question_mere`
--

CREATE TABLE `question_mere` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qst_mere` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_reponse` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `question_mere`
--

INSERT INTO `question_mere` (`id`, `qst_mere`, `desc_reponse`, `created_at`, `updated_at`) VALUES
(1, 'Qualité global de la formation', 'Donnez une note sur 10 pour votre évaluation globale de la formation:', NULL, NULL),
(2, 'Qualité pédagoqique du formation', 'Donnez une note sur 10 pour votre évaluation globale de la qualité pédagogique de la formation:', NULL, NULL),
(3, 'Préparation de la formation', 'Cochez une case par ligne', NULL, NULL),
(4, 'Organisation de la formation', 'Cochez une case par ligne', NULL, NULL),
(5, 'Déroulement de la formation', 'Cochez une case par ligne', NULL, NULL),
(6, 'Le rythme de la formation était-il?', '', NULL, NULL),
(7, 'Contenu de la formation', 'Cochez une case par ligne', NULL, NULL),
(8, 'Les objectifs du programme vont-ils atteints', 'Cochez une case par ligne', NULL, NULL),
(9, 'Efficacité de la formation', 'Cochez une case par ligne', NULL, NULL),
(10, 'Recommanderiez-vous cette formation?', '', NULL, NULL),
(11, 'Quels sont vos attentes pour cette formation?', 'Repondre au question', NULL, NULL),
(12, 'Quels sont les points forts de cette formation', 'Repondre au question', NULL, NULL),
(13, 'Quels sont les points faibles de cette formation', 'Repondre au question', NULL, NULL),
(14, 'Autres remarques', 'Repondre au question', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recommandation`
--

CREATE TABLE `recommandation` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recommandation`
--

INSERT INTO `recommandation` (`id`, `titre`, `created_at`, `updated_at`) VALUES
(1, 'De la part des participants :', NULL, NULL),
(2, 'De la part des formateurs :', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recueil_informations`
--

CREATE TABLE `recueil_informations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `duree_formation` bigint(20) DEFAULT NULL,
  `mois_previsionnelle` bigint(20) DEFAULT NULL,
  `annee_previsionnelle` bigint(20) DEFAULT NULL,
  `statut` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_demande` date DEFAULT NULL,
  `formation_id` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `annee_plan_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `recueil_informations`
--

INSERT INTO `recueil_informations` (`id`, `duree_formation`, `mois_previsionnelle`, `annee_previsionnelle`, `statut`, `date_demande`, `formation_id`, `stagiaire_id`, `entreprise_id`, `created_at`, `updated_at`, `annee_plan_id`) VALUES
(3, 2, 3, 2021, 'Acceptée', '2021-11-17', 16, 9, 8, '2021-11-19 05:46:14', '2021-11-17 08:24:02', 2),
(4, 6, 12, 2021, 'Refusée', '2021-11-18', 12, 18, 8, '2021-11-23 06:21:35', '2021-11-18 06:03:14', 1),
(5, 3, 12, 2021, 'Refusée', '2021-11-19', 12, 9, 8, '2021-11-23 06:21:34', '2021-11-19 02:35:10', 1),
(6, 5, 11, 2021, 'Acceptée', '2021-11-19', 14, 9, 8, '2021-11-19 13:07:20', '2021-11-19 02:35:40', 1),
(7, 45, 11, 2021, 'Acceptée', '2021-11-19', 5, 9, 8, '2021-11-19 06:37:21', '2021-11-19 03:37:12', 1);

-- --------------------------------------------------------

--
-- Structure de la table `reponse_evaluationchaud`
--

CREATE TABLE `reponse_evaluationchaud` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `reponse_desc_champ` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_desc_champ` bigint(20) UNSIGNED NOT NULL,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL,
  `detail_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reponse_evaluationchaud`
--

INSERT INTO `reponse_evaluationchaud` (`id`, `reponse_desc_champ`, `id_desc_champ`, `stagiaire_id`, `detail_id`, `created_at`, `updated_at`) VALUES
(1, '2', 1, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(2, '4', 2, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(3, 'Pas de Tout', 3, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(4, 'Pas de Tout', 7, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(5, 'Insuffisamment', 12, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(6, 'En partie', 17, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(7, 'En partie', 21, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(8, 'Totalement', 26, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(9, 'Totalement', 30, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(10, 'Adapté', 31, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(11, 'Pas de Tout', 34, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(12, 'Totalement', 41, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(13, 'Totalement', 45, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(14, 'Totalement', 49, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(15, 'Beaucoup', 52, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(16, 'Beaucoup', 55, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(17, 'Oui', 56, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(18, 'GG', 58, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(19, 'gg', 59, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(20, 'gg', 60, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(21, 'gg', 61, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41'),
(22, 'gg', 62, 1, 1, '2021-10-21 12:58:41', '2021-10-21 12:58:41');

-- --------------------------------------------------------

--
-- Structure de la table `responsables`
--

CREATE TABLE `responsables` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fonction_resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `responsables`
--

INSERT INTO `responsables` (`id`, `nom_resp`, `prenom_resp`, `fonction_resp`, `email_resp`, `telephone_resp`, `user_id`, `entreprise_id`, `created_at`, `updated_at`) VALUES
(18, 'Randrianalison', 'Zo Hery', 'HR Learning&  Development Officer', 'aaa@yahoo.com', '034 12 006 28', 62, 12, '2021-11-03 06:00:31', '2021-11-16 04:15:24'),
(19, 'Randria', 'Rakoto', 'RRH', 'rrh@yahoo.com', '0342345677', 134, 1, '2021-11-19 05:05:30', '2021-11-19 05:05:30');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', '2021-10-26 05:45:24', '2021-10-26 05:45:24'),
(2, 'referent', '2021-10-26 05:45:24', '2021-10-26 05:45:24'),
(3, 'stagiaire', '2021-10-26 05:45:24', '2021-10-26 05:45:24'),
(4, 'formateur', '2021-10-26 05:45:24', '2021-10-26 05:45:24'),
(5, 'manager', '2021-11-08 05:47:18', '2021-11-08 05:47:18'),
(6, 'SuperAdmin', '2021-11-10 02:59:59', '2021-11-10 02:59:59'),
(7, 'CFP', '2021-11-22 09:27:38', '2021-11-22 09:27:38');

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `numero_session` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `date_debut`, `date_fin`, `created_at`, `updated_at`, `numero_session`) VALUES
(5, '2021-10-18', '2021-10-29', '2021-11-03 06:37:17', '2021-11-03 06:37:17', 'SES5'),
(6, '2021-10-28', '2021-10-29', '2021-11-03 06:38:06', '2021-11-03 06:38:06', 'SES6');

-- --------------------------------------------------------

--
-- Structure de la table `stagiaires`
--

CREATE TABLE `stagiaires` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matricule` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `genre_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fonction_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `CIN` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_etude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stagiaires`
--

INSERT INTO `stagiaires` (`id`, `matricule`, `nom_stagiaire`, `prenom_stagiaire`, `genre_stagiaire`, `fonction_stagiaire`, `mail_stagiaire`, `telephone_stagiaire`, `entreprise_id`, `user_id`, `photos`, `created_at`, `updated_at`, `departement_id`, `CIN`, `date_naissance`, `adresse`, `niveau_etude`) VALUES
(8, '00156', 'RAKOTOMALALA', 'Benjamina Nomenjanahary', 'homme', 'HR Administration', 'vonjitahinaranjelison@gmail.com', '034 11 334 55', 12, 65, '/CyqPi0LCs86r6m9w1XdyBFwb7qTiZNRaPv1IQYLN.png', '2021-11-03 06:06:21', '2021-11-03 06:06:21', 5, '', '', '', ''),
(9, '17419', 'ANDRIANIAINA', 'Oliravaka', 'femme', 'Quality clerk (secretaire qualité)', 'antoenjara1998@gmail.com', '0325423439', 8, 66, '/ktI9KeX1h9QUuVp6EkLp07HMgUa2nT4kpsWcgde6.png', '2021-11-03 06:10:14', '2021-11-03 06:10:14', 5, '', '', '', ''),
(14, '12345', 'gyfzgyifg', 'ugiuzgriué', 'homme', 'egeh', 'n@yahoo.fr', '1234567', 8, 82, 'gyfzgyifgugiuzgriué12345.jpg', '2021-11-11 11:02:15', '2021-11-11 11:02:15', 5, '234567890', '2021-11-13', 'tyuk', 'Doctorat'),
(17, '12345678', 'test', 'test', 'homme', 'tyu', 'stagiaire@gmail.com', '0326412146', 8, 85, 'testtest12345678.png', '2021-11-15 04:19:57', '2021-11-15 04:19:57', 5, '123456789', '2021-11-11', '12345678', 'Ingénieur'),
(18, '070100', 'RAHARIFETRA', 'Holy Nicole', 'femme', 'Chef de projet', 'rahary@yahoo.com', '0341372944', 8, 133, 'RAHARIFETRAHoly_Nicole070100.png', '2021-11-18 06:02:19', '2021-11-18 06:02:19', 4, '301012020162', '2000-01-07', 'Antanimena', 'Bacc+4');

-- --------------------------------------------------------

--
-- Structure de la table `tarif_categories`
--

CREATE TABLE `tarif_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_abonnement_id` bigint(20) UNSIGNED NOT NULL,
  `categorie_paiement_id` bigint(20) UNSIGNED NOT NULL,
  `tarif` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `taxes`
--

CREATE TABLE `taxes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pourcent` decimal(5,2) DEFAULT NULL CHECK (`pourcent` >= 0),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `taxes`
--

INSERT INTO `taxes` (`id`, `description`, `pourcent`, `created_at`, `updated_at`) VALUES
(1, 'TVA', '20.00', '2021-11-23 06:55:50', '2021-11-23 06:55:50'),
(2, 'Hors Taxe', '0.00', '2021-11-23 06:55:50', '2021-11-23 06:55:50');

-- --------------------------------------------------------

--
-- Structure de la table `type_abonnements`
--

CREATE TABLE `type_abonnements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `NomType` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_champs`
--

CREATE TABLE `type_champs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_champ` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_champ` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_champs`
--

INSERT INTO `type_champs` (`id`, `nom_champ`, `desc_champ`, `created_at`, `updated_at`) VALUES
(1, 'Champs type Nombre', 'NOMBRE', NULL, NULL),
(2, 'Champs type Case a Cocher', 'CASE', NULL, NULL),
(3, 'Champs type Text ou commentaire', 'TEXT', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_facture`
--

CREATE TABLE `type_facture` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_facture`
--

INSERT INTO `type_facture` (`id`, `description`, `reference`, `created_at`, `updated_at`) VALUES
(1, 'Facture Définitive', 'Facture', '2021-11-23 06:48:49', '2021-11-23 06:48:49'),
(2, 'Facture d\'Avoir', 'Avoir', '2021-11-23 06:48:49', '2021-11-23 06:48:49'),
(3, 'Facture d\'Acompte', 'Acompte', '2021-11-23 06:48:49', '2021-11-23 06:48:49');

-- --------------------------------------------------------

--
-- Structure de la table `type_payement`
--

CREATE TABLE `type_payement` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_payement`
--

INSERT INTO `type_payement` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'FP', NULL, NULL),
(2, 'FMFP', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
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
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`) VALUES
(1, 'Nicole', 'nicrah16@gmail.com', NULL, '$2y$10$9i0uUmJpIwVtYX1dlEdM5.bNcYXU8CrD8QXDS5loPVAurII6BmbFm', NULL, '2021-08-04 05:53:44', '2021-08-04 05:53:44', 1),
(62, 'Randrianalison', 'aaa@yahoo.com', NULL, '$2y$10$em6MzHf0vsJOYyauNh4SlOT7S7tohL/xxMK3ph32yidBZB9/Yypme', NULL, '2021-11-03 06:00:31', '2021-11-16 04:15:24', 5),
(63, 'Urluc Urluc', 'luc@numerika.mg', NULL, '$2y$10$9/tbY7Cwe3dLNNjV9lICGuxjIIAANy0O6AiIxjUI0xv35/ZtG.Lta', NULL, '2021-11-03 06:03:43', '2021-11-03 06:03:43', 4),
(64, 'Iary Iary', 'iary@numerika.mg', NULL, '$2y$10$6paHVtbGKjQr2DrGF0fDZeNd2Mb.0OzXvq1uL.SwaDLcREu.i8Yyi', NULL, '2021-11-03 06:04:50', '2021-11-03 06:04:50', 4),
(65, 'RAKOTOMALALA', 'vonjitahinaranjelison@gmail.com', NULL, '$2y$10$l4/97UCvaZzDVjsQ3BMAz.FaJF/mAAejw1E72kkiMnf7uLoUxN9Xi', NULL, '2021-11-03 06:06:21', '2021-11-03 06:06:21', 3),
(66, 'ANDRIANIAINA', 'antoenjara1998@gmail.com', NULL, '$2y$10$QA/TfnnpQATZiCsxHiD72.gZKxmfoTTEGF34/vcnYX1Q6ZUXY03NG', NULL, '2021-11-03 06:10:14', '2021-11-03 06:10:14', 3),
(67, 'Rakoto', 'a@gmail.com', NULL, '$2y$10$0IY63tgUwwY1fJpc0MtCmuhqMpZqLH.ZZnENZsL6daa8H8j/b6vee', NULL, '2021-11-11 06:24:35', '2021-11-11 06:24:35', 3),
(131, 'qscd', 'fheuesseghjyd@yahoo.fr', NULL, '$2y$10$06wEUGo0jElzg6j31nCfAeihVv.qgYI5bc0KOPX1w76I9yMqfgAra', NULL, '2021-11-16 09:01:38', '2021-11-16 09:01:38', 3),
(132, 'Gael', 'rasoazerta@yahoo.fr', NULL, '$2y$10$9boDrKICzHjUCwAktSP42OK8WQV0aaeSAm.CJydvbHLBUBW3R15ie', NULL, '2021-11-16 09:07:12', '2021-11-16 09:07:12', 3),
(133, 'RAHARIFETRA', 'rahary@yahoo.com', NULL, '$2y$10$Bl9gV8vgb3GFLSdwMLO04uYLLS3k2tjFuyR1iF3Njg2Ue9R9Pw3rm', NULL, '2021-11-18 06:02:19', '2021-11-18 06:02:19', 3),
(134, 'Randria', 'rrh@yahoo.com', NULL, '$2y$10$3ltvsioLUjwdBO9ZtQdiAeMULf6xKQwHZvKiN5acXK1q2XsTRUaU.', NULL, '2021-11-19 05:05:30', '2021-11-19 05:05:30', 2),
(135, 'RAHARIFETRA Holy Nicole', 'nicole@gmail.com', NULL, '$2y$10$iND558OSp5cUjS66j41m4e7JIHovL/R9cmltoGVx0QlNqjF6v7J6y', NULL, '2021-11-22 04:14:25', '2021-11-22 04:14:25', 4),
(136, 'Rhumer Nico Ralison', 'nicroh@gmail.com', NULL, '$2y$10$7BCo1SqXoca0Tvw3GN24R.UaoXSrt4MYr.RQSbcUYA4GMpGMPTFlC', NULL, '2021-11-22 04:20:22', '2021-11-22 04:20:22', 4),
(141, 'KENTIA', 'kentia@yahoo.com', NULL, '$2y$10$BzKlsBBSZXnvPj65gE5RJOryYvLqJR4P.QVMRvShySKCMRwwv0an.', NULL, '2021-11-22 10:42:50', '2021-11-22 10:42:50', 7);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_compte_facture_actif`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_compte_facture_actif` (
`totale` bigint(21)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_compte_facture_en_cour`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_compte_facture_en_cour` (
`totale` bigint(21)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_compte_facture_inactif`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_compte_facture_inactif` (
`totale` bigint(21)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_compte_facture_payer`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_compte_facture_payer` (
`totale` bigint(21)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_cours`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_cours` (
`programme_id` bigint(20) unsigned
,`titre` varchar(255)
,`module_id` bigint(20) unsigned
,`cour_id` bigint(20) unsigned
,`titre_cours` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_coursfroidevaluation`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_coursfroidevaluation` (
`cours_id` bigint(20) unsigned
,`titre_cours` varchar(255)
,`programme_id` bigint(20) unsigned
,`STATUS` varchar(255)
,`projet_id` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_coursmodules`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_coursmodules` (
`nom_formation` varchar(255)
,`nom_module` varchar(255)
,`titre` varchar(255)
,`titre_cours` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_coursprogramme`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_coursprogramme` (
`cours_id` bigint(20) unsigned
,`titre_cours` varchar(255)
,`programme_id` bigint(20) unsigned
,`titre` varchar(255)
,`module_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_cours_programme`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_cours_programme` (
`cours_id` bigint(20) unsigned
,`titre_cours` varchar(255)
,`programme_id` bigint(20) unsigned
,`titre` varchar(255)
,`module_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_date_formation`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_date_formation` (
`lieu` varchar(255)
,`projet_id` bigint(20) unsigned
,`session_id` bigint(20) unsigned
,`date_debut` date
,`date_fin` date
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_dernier_date_encaissement`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_dernier_date_encaissement` (
`facture_id` bigint(20) unsigned
,`montant_facture` decimal(15,2)
,`date_encaissement` datetime
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_dernier_date_encaissement_frais_annexe`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_dernier_date_encaissement_frais_annexe` (
`montant_frais_annexe_id` bigint(20) unsigned
,`montant_frais_annexe` decimal(15,2)
,`date_encaissement` datetime
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_dernier_encaissement`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_dernier_encaissement` (
`facture_id` bigint(20) unsigned
,`montant_facture` decimal(15,2)
,`payement` decimal(15,2)
,`dernier_montant_ouvert` decimal(16,2)
,`date_encaissement` datetime
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_dernier_encaissement_frais_annexe`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_dernier_encaissement_frais_annexe` (
`montant_frais_annexe_id` bigint(20) unsigned
,`montant_frais_annexe` decimal(15,2)
,`payement` decimal(15,2)
,`dernier_montant_ouvert` decimal(16,2)
,`date_encaissement` datetime
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_detailmoduleformation`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_detailmoduleformation` (
`detail_id` bigint(20) unsigned
,`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`session_id` bigint(20) unsigned
,`module_id` bigint(20) unsigned
,`formateur_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`duree` int(11)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_detailmoduleformationprojet`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_detailmoduleformationprojet` (
`detail_id` bigint(20) unsigned
,`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`session_id` bigint(20) unsigned
,`module_id` bigint(20) unsigned
,`formateur_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`duree` int(11)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`nom_projet` varchar(255)
,`entreprise_id` int(11)
,`nom_etp` varchar(255)
,`adresse` varchar(255)
,`logo` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_detailmoduleformationprojetformateur`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_detailmoduleformationprojetformateur` (
`detail_id` bigint(20) unsigned
,`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`session_id` bigint(20) unsigned
,`module_id` bigint(20) unsigned
,`formateur_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`duree` int(11)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`nom_projet` varchar(255)
,`entreprise_id` int(11)
,`nom_etp` varchar(255)
,`adresse` varchar(255)
,`logo` varchar(255)
,`nom_formateur` varchar(191)
,`prenom_formateur` varchar(191)
,`photos` varchar(191)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_detail_cour`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_detail_cour` (
`detail_id` bigint(20) unsigned
,`cours_id` bigint(20) unsigned
,`titre_cours` varchar(255)
,`programme_id` bigint(20) unsigned
,`titre_programme` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_detail_groupe_module_projet`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_detail_groupe_module_projet` (
`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`detail_id` bigint(20) unsigned
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`module_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`nom_groupe` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_detail_groupe_stagaire`
-- (Voir ci-dessous la vue réelle)
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
,`reference` varchar(50)
,`nom_module` varchar(255)
,`nom_groupe` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_encaissement`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_encaissement` (
`facture_id` bigint(20) unsigned
,`projet_id` bigint(20) unsigned
,`payement` decimal(15,2)
,`montant_total` decimal(15,2)
,`date_facture` datetime
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_encaissement_frais_annexe`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_encaissement_frais_annexe` (
`montant_frais_annexe_id` bigint(20) unsigned
,`num_facture` varchar(255)
,`payement` decimal(15,2)
,`montant_total` decimal(15,2)
,`date_frais_annexe` datetime
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_evaluation_action_formation`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_evaluation_action_formation` (
`action_formation_id` bigint(20) unsigned
,`titre` varchar(255)
,`pourcent` decimal(5,2)
,`projet_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_evaluation_apprenant`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_evaluation_apprenant` (
`id` bigint(20) unsigned
,`participant_groupe_id` bigint(20) unsigned
,`stagaire_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`nom_groupe` varchar(255)
,`projet_id` int(11)
,`note_avant` decimal(4,2)
,`note_apres` decimal(4,2)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_exportcatalogue`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_exportcatalogue` (
`reference` varchar(50)
,`nom_module` varchar(255)
,`prix` int(11)
,`duree` int(11)
,`nom_formation` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_exportparticipant`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_exportparticipant` (
`matricule` varchar(25)
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`genre_stagiaire` varchar(255)
,`fonction_stagiaire` varchar(255)
,`mail_stagiaire` varchar(255)
,`telephone_stagiaire` varchar(255)
,`nom_etp` varchar(255)
,`adresse` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_exportresponsable`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_exportresponsable` (
`nom_resp` varchar(255)
,`prenom_resp` varchar(255)
,`fonction_resp` varchar(255)
,`email_resp` varchar(255)
,`telephone_resp` varchar(255)
,`nom_etp` varchar(255)
,`adresse` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_facture`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_facture` (
`projet_id` bigint(20) unsigned
,`facture_id` bigint(20) unsigned
,`montant_total` decimal(15,2)
,`payement_totale` decimal(37,2)
,`dernier_montant_ouvert` decimal(16,2)
,`date_facture` datetime
,`nom_projet` varchar(255)
,`entreprise_id` int(11)
,`type_payement_id` bigint(20) unsigned
,`description_type_payement` varchar(100)
,`bon_de_commande` varchar(254)
,`facture` varchar(254)
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
,`nom_groupe` varchar(255)
,`pu` int(11)
,`type_financement_id` bigint(20) unsigned
,`description_financement` varchar(255)
,`nom_etp` varchar(255)
,`adresse` varchar(255)
,`logo` varchar(255)
,`reference_bc` varchar(255)
,`remise` int(11)
,`payement_cours` decimal(38,2)
,`facture_encour` varchar(8)
,`type_facture_id` bigint(20) unsigned
,`description_type_facture` varchar(255)
,`reference_facture` varchar(255)
,`NIF` varchar(255)
,`STAT` varchar(255)
,`RCS` varchar(255)
,`CIF` varchar(255)
,`Secteur_activite` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_factureencaissement`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_factureencaissement` (
`encaissement_id` bigint(20) unsigned
,`facture_id` bigint(20) unsigned
,`montant_facture` decimal(15,2)
,`libelle` text
,`payement` decimal(15,2)
,`montant_ouvert` decimal(15,2)
,`date_encaissement` timestamp
,`admin_id` bigint(20) unsigned
,`bon_de_commande` varchar(254)
,`facture` varchar(254)
,`montant_total` decimal(15,2)
,`date_facture` timestamp
,`projet_id` bigint(20) unsigned
,`type_payement_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_facture_actif`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_facture_actif` (
`num_facture` varchar(255)
,`other_message` text
,`due_date` date
,`invoice_date` date
,`totale_jour` int(7)
,`jour_restant` int(7)
,`facture_encour` varchar(8)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_facture_inactif`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_facture_inactif` (
`num_facture` varchar(255)
,`other_message` text
,`due_date` date
,`invoice_date` date
,`totale_jour` int(7)
,`jour_restant` int(7)
,`facture_encour` varchar(8)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_frais_annexe`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_frais_annexe` (
`num_facture` varchar(255)
,`montant_frais_annexe_id` bigint(20) unsigned
,`montant_total` decimal(15,2)
,`payement_totale` decimal(37,2)
,`dernier_montant_ouvert` decimal(16,2)
,`date_frais_annexe` datetime
,`frais_annexe_description` varchar(255)
,`description` text
,`hors_taxe` decimal(15,2)
,`qte` int(11)
,`pu` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_froid_evaluations`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_froid_evaluations` (
`id` bigint(20) unsigned
,`cours_id` bigint(20) unsigned
,`status` varchar(255)
,`projet_id` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
,`couleur` varchar(7)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_groupe`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_groupe` (
`groupe_id` bigint(20) unsigned
,`nom_groupe` varchar(255)
,`projet_id` int(11)
,`nom_projet` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_groupe_projet`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_groupe_projet` (
`lieu` varchar(255)
,`projet_id` bigint(20) unsigned
,`nom_projet` varchar(255)
,`groupe_id` bigint(20) unsigned
,`module_id` bigint(20) unsigned
,`nom_module` varchar(255)
,`nom_groupe` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_liste_formateur_projet`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_liste_formateur_projet` (
`projet_id` bigint(20) unsigned
,`formateur_id` bigint(20) unsigned
,`nom_projet` varchar(255)
,`nom_formateur` varchar(191)
,`prenom_formateur` varchar(191)
,`photos` varchar(191)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_liste_stagiaire_groupe`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_liste_stagiaire_groupe` (
`stagiaire_id` bigint(20) unsigned
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`groupe_id` bigint(20) unsigned
,`nom_groupe` varchar(255)
,`module_id` bigint(20) unsigned
,`nom_module` varchar(255)
,`reference` varchar(50)
,`projet_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_modules`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_modules` (
`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`module_id` bigint(20) unsigned
,`nom_module` varchar(255)
,`Reference` varchar(50)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_participantsession`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_participantsession` (
`detail_id` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
,`matricule` varchar(25)
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`fonction_stagiaire` varchar(255)
,`genre_stagiaire` varchar(255)
,`mail_stagiaire` varchar(255)
,`telephone_stagiaire` varchar(255)
,`entreprise_id` bigint(20) unsigned
,`user_id` bigint(20) unsigned
,`photos` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_participant_groupe`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_participant_groupe` (
`participant_groupe_id` bigint(20) unsigned
,`stagaire_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`nom_stagiaire` varchar(255)
,`prenom_stagiaire` varchar(255)
,`nom_groupe` varchar(255)
,`projet_id` int(11)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_pourcentage_status`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_pourcentage_status` (
`projet_id` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
,`pourcentage` double
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_pourcent_globale_evaluation_action_formation`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_pourcent_globale_evaluation_action_formation` (
`globale` decimal(6,2)
,`projet_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_programme`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_programme` (
`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`id_module` bigint(20) unsigned
,`nom_module` varchar(255)
,`reference` varchar(50)
,`prix_module` int(11)
,`duree_module` int(11)
,`id_programme` bigint(20) unsigned
,`titre_programme` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_programme_detail_activiter`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_programme_detail_activiter` (
`detail_id` bigint(20) unsigned
,`lieu` varchar(255)
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
,`projet_id` bigint(20) unsigned
,`groupe_id` bigint(20) unsigned
,`session_id` bigint(20) unsigned
,`module_id` bigint(20) unsigned
,`formateur_id` bigint(20) unsigned
,`reference` varchar(50)
,`nom_module` varchar(255)
,`duree` int(11)
,`formation_id` bigint(20) unsigned
,`nom_formation` varchar(255)
,`cours_id` bigint(20) unsigned
,`titre_cours` varchar(255)
,`programme_id` bigint(20) unsigned
,`titre_programme` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_projetentreprise`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_projetentreprise` (
`projet_id` bigint(20) unsigned
,`nom_projet` varchar(255)
,`entreprise_id` int(11)
,`nom_etp` varchar(255)
,`adresse` varchar(255)
,`logo` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_question_fille`
-- (Voir ci-dessous la vue réelle)
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
-- Doublure de structure pour la vue `v_reponse_evaluationchaud`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_reponse_evaluationchaud` (
`reponse_desc_champ` text
,`id_desc_champ` bigint(20) unsigned
,`desc_champ` text
,`nb_max` int(11)
,`id_qst_fille` bigint(20) unsigned
,`stagiaire_id` bigint(20) unsigned
,`detail_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_sum_encaissement`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_sum_encaissement` (
`facture_id` bigint(20) unsigned
,`projet_id` bigint(20) unsigned
,`payement_totale` decimal(37,2)
,`montant_total` decimal(15,2)
,`date_facture` datetime
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_sum_encaissement_frais_annexe`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_sum_encaissement_frais_annexe` (
`montant_frais_annexe_id` bigint(20) unsigned
,`num_facture` varchar(255)
,`payement_totale` decimal(37,2)
,`montant_total` decimal(15,2)
,`date_frais_annexe` datetime
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_temp_facture`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_temp_facture` (
`projet_id` bigint(20) unsigned
,`facture_id` bigint(20) unsigned
,`montant_total` decimal(15,2)
,`payement_totale` decimal(37,2)
,`dernier_montant_ouvert` decimal(16,2)
,`date_facture` datetime
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_temp_frais_annexe`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_temp_frais_annexe` (
`num_facture` varchar(255)
,`montant_frais_annexe_id` bigint(20) unsigned
,`montant_total` decimal(15,2)
,`payement_totale` decimal(37,2)
,`dernier_montant_ouvert` decimal(16,2)
,`date_frais_annexe` datetime
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_tmp_verify_evaluaction_action_formation`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_tmp_verify_evaluaction_action_formation` (
`evaluation_action_formation_id` bigint(20) unsigned
,`pourcent` decimal(5,2)
,`projet_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_trie_detail_date`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_trie_detail_date` (
`projet_id` bigint(20) unsigned
,`h_debut` varchar(255)
,`h_fin` varchar(255)
,`date_detail` date
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_trie_detail_programme`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_trie_detail_programme` (
`projet_id` bigint(20) unsigned
,`programme_id` bigint(20) unsigned
,`titre_programme` varchar(255)
);

-- --------------------------------------------------------

--
-- Doublure de structure pour la vue `v_verify_evaluaction_action_formation`
-- (Voir ci-dessous la vue réelle)
--
CREATE TABLE `v_verify_evaluaction_action_formation` (
`verify` bigint(21)
,`evaluation_action_formation_id` bigint(20) unsigned
,`projet_id` bigint(20) unsigned
);

-- --------------------------------------------------------

--
-- Structure de la vue `moduleformation`
--
DROP TABLE IF EXISTS `moduleformation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `moduleformation`  AS SELECT `m`.`id` AS `module_id`, `m`.`Reference` AS `reference`, `m`.`nom_module` AS `nom_module`, `m`.`Prix` AS `prix`, `m`.`Duree` AS `duree`, `f`.`id` AS `formation_id`, `f`.`nom_formation` AS `nom_formation` FROM (`modules` `m` join `formations` `f` on(`m`.`formation_id` = `f`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_compte_facture_actif`
--
DROP TABLE IF EXISTS `v_compte_facture_actif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_compte_facture_actif`  AS SELECT count(`v_facture_actif`.`num_facture`) AS `totale` FROM `v_facture_actif` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_compte_facture_en_cour`
--
DROP TABLE IF EXISTS `v_compte_facture_en_cour`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_compte_facture_en_cour`  AS SELECT count(`v_facture`.`num_facture`) AS `totale` FROM `v_facture` WHERE `v_facture`.`facture_encour` = 'en_cour' ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_compte_facture_inactif`
--
DROP TABLE IF EXISTS `v_compte_facture_inactif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_compte_facture_inactif`  AS SELECT count(`v_facture_inactif`.`num_facture`) AS `totale` FROM `v_facture_inactif` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_compte_facture_payer`
--
DROP TABLE IF EXISTS `v_compte_facture_payer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_compte_facture_payer`  AS SELECT count(`v_facture`.`num_facture`) AS `totale` FROM `v_facture` WHERE `v_facture`.`facture_encour` = 'terminer' ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_cours`
--
DROP TABLE IF EXISTS `v_cours`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cours`  AS SELECT `cours`.`programme_id` AS `programme_id`, `programmes`.`titre` AS `titre`, `programmes`.`module_id` AS `module_id`, `cours`.`id` AS `cour_id`, `cours`.`titre_cours` AS `titre_cours` FROM (`programmes` join `cours`) WHERE `programmes`.`id` = `cours`.`programme_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_coursfroidevaluation`
--
DROP TABLE IF EXISTS `v_coursfroidevaluation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_coursfroidevaluation`  AS SELECT `c`.`id` AS `cours_id`, `c`.`titre_cours` AS `titre_cours`, `c`.`programme_id` AS `programme_id`, ifnull(`fe`.`status`,0) AS `STATUS`, `fe`.`projet_id` AS `projet_id`, `fe`.`stagiaire_id` AS `stagiaire_id`, `s`.`nom_stagiaire` AS `nom_stagiaire`, `s`.`prenom_stagiaire` AS `prenom_stagiaire` FROM ((`cours` `c` left join `froid_evaluations` `fe` on(`c`.`id` = `fe`.`cours_id`)) join `stagiaires` `s` on(`fe`.`stagiaire_id` = `s`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_coursmodules`
--
DROP TABLE IF EXISTS `v_coursmodules`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_coursmodules`  AS SELECT `v_modules`.`nom_formation` AS `nom_formation`, `v_modules`.`nom_module` AS `nom_module`, `v_cours`.`titre` AS `titre`, `v_cours`.`titre_cours` AS `titre_cours` FROM (`v_modules` join `v_cours`) WHERE `v_modules`.`module_id` = `v_cours`.`module_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_coursprogramme`
--
DROP TABLE IF EXISTS `v_coursprogramme`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_coursprogramme`  AS SELECT `c`.`id` AS `cours_id`, `c`.`titre_cours` AS `titre_cours`, `c`.`programme_id` AS `programme_id`, `p`.`titre` AS `titre`, `p`.`module_id` AS `module_id` FROM (`programmes` `p` left join `cours` `c` on(`c`.`programme_id` = `p`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_cours_programme`
--
DROP TABLE IF EXISTS `v_cours_programme`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_cours_programme`  AS SELECT `c`.`id` AS `cours_id`, `c`.`titre_cours` AS `titre_cours`, `c`.`programme_id` AS `programme_id`, `p`.`titre` AS `titre`, `p`.`module_id` AS `module_id`, `m`.`Reference` AS `reference`, `m`.`nom_module` AS `nom_module` FROM ((`cours` `c` left join `programmes` `p` on(`c`.`programme_id` = `p`.`id`)) join `modules` `m` on(`m`.`id` = `p`.`module_id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_date_formation`
--
DROP TABLE IF EXISTS `v_date_formation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_date_formation`  AS SELECT `details`.`lieu` AS `lieu`, `details`.`projet_id` AS `projet_id`, `details`.`session_id` AS `session_id`, `sessions`.`date_debut` AS `date_debut`, `sessions`.`date_fin` AS `date_fin` FROM (`details` join `sessions`) WHERE `details`.`session_id` = `sessions`.`id` GROUP BY `details`.`projet_id`, `details`.`lieu`, `details`.`session_id`, `sessions`.`date_debut`, `sessions`.`date_fin` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_dernier_date_encaissement`
--
DROP TABLE IF EXISTS `v_dernier_date_encaissement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dernier_date_encaissement`  AS SELECT `factures`.`id` AS `facture_id`, ifnull(`encaissements`.`montant_facture`,`factures`.`montant_total`) AS `montant_facture`, ifnull(max(`encaissements`.`date_encaissement`),current_timestamp()) AS `date_encaissement` FROM (`factures` left join `encaissements` on(`encaissements`.`facture_id` = `factures`.`id`)) GROUP BY `factures`.`id`, ifnull(`encaissements`.`montant_facture`,`factures`.`montant_total`) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_dernier_date_encaissement_frais_annexe`
--
DROP TABLE IF EXISTS `v_dernier_date_encaissement_frais_annexe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dernier_date_encaissement_frais_annexe`  AS SELECT `montant_frais_annexes`.`id` AS `montant_frais_annexe_id`, ifnull(`encaissements_frais_annexe`.`montant_frais_annexe`,`montant_frais_annexes`.`montant`) AS `montant_frais_annexe`, ifnull(max(`encaissements_frais_annexe`.`date_encaissement`),current_timestamp()) AS `date_encaissement` FROM (`montant_frais_annexes` left join `encaissements_frais_annexe` on(`encaissements_frais_annexe`.`montant_frais_annexe_id` = `montant_frais_annexes`.`id`)) GROUP BY `montant_frais_annexes`.`id`, ifnull(`encaissements_frais_annexe`.`montant_frais_annexe`,`montant_frais_annexes`.`montant`) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_dernier_encaissement`
--
DROP TABLE IF EXISTS `v_dernier_encaissement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dernier_encaissement`  AS SELECT `v_dernier_date_encaissement`.`facture_id` AS `facture_id`, `v_dernier_date_encaissement`.`montant_facture` AS `montant_facture`, ifnull(`encaissements`.`payement`,0) AS `payement`, ifnull(`encaissements`.`montant_ouvert`,`v_dernier_date_encaissement`.`montant_facture` - ifnull(`encaissements`.`payement`,0)) AS `dernier_montant_ouvert`, `v_dernier_date_encaissement`.`date_encaissement` AS `date_encaissement` FROM (`v_dernier_date_encaissement` left join `encaissements` on(`v_dernier_date_encaissement`.`facture_id` = `encaissements`.`facture_id` and `v_dernier_date_encaissement`.`date_encaissement` = `encaissements`.`date_encaissement`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_dernier_encaissement_frais_annexe`
--
DROP TABLE IF EXISTS `v_dernier_encaissement_frais_annexe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dernier_encaissement_frais_annexe`  AS SELECT `v_dernier_date_encaissement_frais_annexe`.`montant_frais_annexe_id` AS `montant_frais_annexe_id`, `v_dernier_date_encaissement_frais_annexe`.`montant_frais_annexe` AS `montant_frais_annexe`, ifnull(`encaissements_frais_annexe`.`payement`,0) AS `payement`, ifnull(`encaissements_frais_annexe`.`montant_ouvert`,`v_dernier_date_encaissement_frais_annexe`.`montant_frais_annexe` - ifnull(`encaissements_frais_annexe`.`payement`,0)) AS `dernier_montant_ouvert`, `v_dernier_date_encaissement_frais_annexe`.`date_encaissement` AS `date_encaissement` FROM (`v_dernier_date_encaissement_frais_annexe` left join `encaissements_frais_annexe` on(`v_dernier_date_encaissement_frais_annexe`.`montant_frais_annexe_id` = `encaissements_frais_annexe`.`montant_frais_annexe_id` and `v_dernier_date_encaissement_frais_annexe`.`date_encaissement` = `encaissements_frais_annexe`.`date_encaissement`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_detailmoduleformation`
--
DROP TABLE IF EXISTS `v_detailmoduleformation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detailmoduleformation`  AS SELECT `d`.`id` AS `detail_id`, `d`.`lieu` AS `lieu`, `d`.`h_debut` AS `h_debut`, `d`.`h_fin` AS `h_fin`, `d`.`date_detail` AS `date_detail`, `d`.`projet_id` AS `projet_id`, `d`.`groupe_id` AS `groupe_id`, `d`.`session_id` AS `session_id`, `d`.`module_id` AS `module_id`, `d`.`formateur_id` AS `formateur_id`, `mf`.`reference` AS `reference`, `mf`.`nom_module` AS `nom_module`, `mf`.`duree` AS `duree`, `mf`.`formation_id` AS `formation_id`, `mf`.`nom_formation` AS `nom_formation` FROM (`details` `d` join `moduleformation` `mf` on(`d`.`module_id` = `mf`.`module_id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_detailmoduleformationprojet`
--
DROP TABLE IF EXISTS `v_detailmoduleformationprojet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detailmoduleformationprojet`  AS SELECT `dmf`.`detail_id` AS `detail_id`, `dmf`.`lieu` AS `lieu`, `dmf`.`h_debut` AS `h_debut`, `dmf`.`h_fin` AS `h_fin`, `dmf`.`date_detail` AS `date_detail`, `dmf`.`projet_id` AS `projet_id`, `dmf`.`groupe_id` AS `groupe_id`, `dmf`.`session_id` AS `session_id`, `dmf`.`module_id` AS `module_id`, `dmf`.`formateur_id` AS `formateur_id`, `dmf`.`reference` AS `reference`, `dmf`.`nom_module` AS `nom_module`, `dmf`.`duree` AS `duree`, `dmf`.`formation_id` AS `formation_id`, `dmf`.`nom_formation` AS `nom_formation`, `pe`.`nom_projet` AS `nom_projet`, `pe`.`entreprise_id` AS `entreprise_id`, `pe`.`nom_etp` AS `nom_etp`, `pe`.`adresse` AS `adresse`, `pe`.`logo` AS `logo` FROM (`v_detailmoduleformation` `dmf` join `v_projetentreprise` `pe` on(`dmf`.`projet_id` = `pe`.`projet_id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_detailmoduleformationprojetformateur`
--
DROP TABLE IF EXISTS `v_detailmoduleformationprojetformateur`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detailmoduleformationprojetformateur`  AS SELECT `dmfp`.`detail_id` AS `detail_id`, `dmfp`.`lieu` AS `lieu`, `dmfp`.`h_debut` AS `h_debut`, `dmfp`.`h_fin` AS `h_fin`, `dmfp`.`date_detail` AS `date_detail`, `dmfp`.`projet_id` AS `projet_id`, `dmfp`.`groupe_id` AS `groupe_id`, `dmfp`.`session_id` AS `session_id`, `dmfp`.`module_id` AS `module_id`, `dmfp`.`formateur_id` AS `formateur_id`, `dmfp`.`reference` AS `reference`, `dmfp`.`nom_module` AS `nom_module`, `dmfp`.`duree` AS `duree`, `dmfp`.`formation_id` AS `formation_id`, `dmfp`.`nom_formation` AS `nom_formation`, `dmfp`.`nom_projet` AS `nom_projet`, `dmfp`.`entreprise_id` AS `entreprise_id`, `dmfp`.`nom_etp` AS `nom_etp`, `dmfp`.`adresse` AS `adresse`, `dmfp`.`logo` AS `logo`, `f`.`nom_formateur` AS `nom_formateur`, `f`.`prenom_formateur` AS `prenom_formateur`, `f`.`photos` AS `photos` FROM (`v_detailmoduleformationprojet` `dmfp` join `formateurs` `f` on(`dmfp`.`formateur_id` = `f`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_detail_cour`
--
DROP TABLE IF EXISTS `v_detail_cour`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_cour`  AS SELECT `details`.`id` AS `detail_id`, `details`.`cours_id` AS `cours_id`, `cours`.`titre_cours` AS `titre_cours`, `cours`.`programme_id` AS `programme_id`, `programmes`.`titre` AS `titre_programme` FROM ((`details` join `cours`) join `programmes`) WHERE `details`.`cours_id` = `cours`.`id` AND `cours`.`programme_id` = `programmes`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_detail_groupe_module_projet`
--
DROP TABLE IF EXISTS `v_detail_groupe_module_projet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_groupe_module_projet`  AS SELECT `v_detailmoduleformation`.`lieu` AS `lieu`, `v_detailmoduleformation`.`h_debut` AS `h_debut`, `v_detailmoduleformation`.`h_fin` AS `h_fin`, `v_detailmoduleformation`.`date_detail` AS `date_detail`, `v_detailmoduleformation`.`detail_id` AS `detail_id`, `v_detailmoduleformation`.`projet_id` AS `projet_id`, `v_detailmoduleformation`.`groupe_id` AS `groupe_id`, `v_detailmoduleformation`.`module_id` AS `module_id`, `v_detailmoduleformation`.`reference` AS `reference`, `v_detailmoduleformation`.`nom_module` AS `nom_module`, `groupes`.`nom_groupe` AS `nom_groupe` FROM (`v_detailmoduleformation` join `groupes`) WHERE `v_detailmoduleformation`.`groupe_id` = `groupes`.`id` AND `v_detailmoduleformation`.`projet_id` = `groupes`.`projet_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_detail_groupe_stagaire`
--
DROP TABLE IF EXISTS `v_detail_groupe_stagaire`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_detail_groupe_stagaire`  AS SELECT `v_detail_groupe_module_projet`.`lieu` AS `lieu`, `v_detail_groupe_module_projet`.`h_debut` AS `h_debut`, `v_detail_groupe_module_projet`.`h_fin` AS `h_fin`, `v_detail_groupe_module_projet`.`date_detail` AS `date_detail`, `v_detail_groupe_module_projet`.`detail_id` AS `detail_id`, `v_detail_groupe_module_projet`.`projet_id` AS `projet_id`, `v_detail_groupe_module_projet`.`groupe_id` AS `groupe_id`, `v_detail_groupe_module_projet`.`module_id` AS `module_id`, `v_detail_groupe_module_projet`.`reference` AS `reference`, `v_detail_groupe_module_projet`.`nom_module` AS `nom_module`, `v_detail_groupe_module_projet`.`nom_groupe` AS `nom_groupe` FROM `v_detail_groupe_module_projet` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_encaissement`
--
DROP TABLE IF EXISTS `v_encaissement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_encaissement`  AS SELECT `factures`.`id` AS `facture_id`, `factures`.`projet_id` AS `projet_id`, ifnull(`encaissements`.`payement`,0) AS `payement`, ifnull(`factures`.`montant_total`,0) AS `montant_total`, ifnull(`factures`.`date_facture`,current_timestamp()) AS `date_facture` FROM (`factures` left join `encaissements` on(`factures`.`id` = `encaissements`.`facture_id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_encaissement_frais_annexe`
--
DROP TABLE IF EXISTS `v_encaissement_frais_annexe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_encaissement_frais_annexe`  AS SELECT `montant_frais_annexes`.`id` AS `montant_frais_annexe_id`, `montant_frais_annexes`.`num_facture` AS `num_facture`, ifnull(`encaissements_frais_annexe`.`payement`,0) AS `payement`, ifnull(`montant_frais_annexes`.`montant`,0) AS `montant_total`, ifnull(`montant_frais_annexes`.`date_frais_annexe`,current_timestamp()) AS `date_frais_annexe` FROM (`montant_frais_annexes` left join `encaissements_frais_annexe` on(`montant_frais_annexes`.`id` = `encaissements_frais_annexe`.`montant_frais_annexe_id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_evaluation_action_formation`
--
DROP TABLE IF EXISTS `v_evaluation_action_formation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_evaluation_action_formation`  AS SELECT `evaluation_action_formation`.`id` AS `action_formation_id`, `evaluation_action_formation`.`titre` AS `titre`, `detail_evaluation_action_formation`.`pourcent` AS `pourcent`, `detail_evaluation_action_formation`.`projet_id` AS `projet_id` FROM (`detail_evaluation_action_formation` join `evaluation_action_formation`) WHERE `detail_evaluation_action_formation`.`evaluation_action_formation_id` = `evaluation_action_formation`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_evaluation_apprenant`
--
DROP TABLE IF EXISTS `v_evaluation_apprenant`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_evaluation_apprenant`  AS SELECT `detail_evaluation_apprenants`.`id` AS `id`, `v_participant_groupe`.`participant_groupe_id` AS `participant_groupe_id`, `v_participant_groupe`.`stagaire_id` AS `stagaire_id`, `v_participant_groupe`.`groupe_id` AS `groupe_id`, `v_participant_groupe`.`nom_stagiaire` AS `nom_stagiaire`, `v_participant_groupe`.`prenom_stagiaire` AS `prenom_stagiaire`, `v_participant_groupe`.`nom_groupe` AS `nom_groupe`, `v_participant_groupe`.`projet_id` AS `projet_id`, `detail_evaluation_apprenants`.`note_avant` AS `note_avant`, `detail_evaluation_apprenants`.`note_apres` AS `note_apres` FROM (`v_participant_groupe` join `detail_evaluation_apprenants`) WHERE `v_participant_groupe`.`participant_groupe_id` = `detail_evaluation_apprenants`.`participant_groupe_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_exportcatalogue`
--
DROP TABLE IF EXISTS `v_exportcatalogue`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_exportcatalogue`  AS SELECT `modules`.`Reference` AS `reference`, `modules`.`nom_module` AS `nom_module`, `modules`.`Prix` AS `prix`, `modules`.`Duree` AS `duree`, `formations`.`nom_formation` AS `nom_formation` FROM (`modules` join `formations`) WHERE `modules`.`formation_id` = `formations`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_exportparticipant`
--
DROP TABLE IF EXISTS `v_exportparticipant`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_exportparticipant`  AS SELECT `stagiaires`.`matricule` AS `matricule`, `stagiaires`.`nom_stagiaire` AS `nom_stagiaire`, `stagiaires`.`prenom_stagiaire` AS `prenom_stagiaire`, `stagiaires`.`genre_stagiaire` AS `genre_stagiaire`, `stagiaires`.`fonction_stagiaire` AS `fonction_stagiaire`, `stagiaires`.`mail_stagiaire` AS `mail_stagiaire`, `stagiaires`.`telephone_stagiaire` AS `telephone_stagiaire`, `entreprises`.`nom_etp` AS `nom_etp`, `entreprises`.`adresse` AS `adresse` FROM (`stagiaires` join `entreprises`) WHERE `entreprises`.`id` = `stagiaires`.`entreprise_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_exportresponsable`
--
DROP TABLE IF EXISTS `v_exportresponsable`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_exportresponsable`  AS SELECT `responsables`.`nom_resp` AS `nom_resp`, `responsables`.`prenom_resp` AS `prenom_resp`, `responsables`.`fonction_resp` AS `fonction_resp`, `responsables`.`email_resp` AS `email_resp`, `responsables`.`telephone_resp` AS `telephone_resp`, `entreprises`.`nom_etp` AS `nom_etp`, `entreprises`.`adresse` AS `adresse` FROM (`responsables` join `entreprises`) WHERE `entreprises`.`id` = `responsables`.`entreprise_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_facture`
--
DROP TABLE IF EXISTS `v_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_facture`  AS SELECT `v_temp_facture`.`projet_id` AS `projet_id`, `v_temp_facture`.`facture_id` AS `facture_id`, `v_temp_facture`.`montant_total` AS `montant_total`, `v_temp_facture`.`payement_totale` AS `payement_totale`, `v_temp_facture`.`dernier_montant_ouvert` AS `dernier_montant_ouvert`, `v_temp_facture`.`date_facture` AS `date_facture`, `projets`.`nom_projet` AS `nom_projet`, `projets`.`entreprise_id` AS `entreprise_id`, `factures`.`type_payement_id` AS `type_payement_id`, `type_payement`.`type` AS `description_type_payement`, `factures`.`bon_de_commande` AS `bon_de_commande`, `factures`.`facture` AS `facture`, `factures`.`hors_taxe` AS `hors_taxe`, `factures`.`invoice_date` AS `invoice_date`, `factures`.`due_date` AS `due_date`, `factures`.`tax_id` AS `tax_id`, `taxes`.`description` AS `nom_taxe`, `taxes`.`pourcent` AS `pourcent`, `factures`.`description` AS `description_facture`, `factures`.`other_message` AS `other_message`, `factures`.`qte` AS `qte`, `factures`.`num_facture` AS `num_facture`, `factures`.`activiter` AS `activiter`, `factures`.`groupe_id` AS `groupe_id`, `groupes`.`nom_groupe` AS `nom_groupe`, `factures`.`pu` AS `pu`, `factures`.`type_financement_id` AS `type_financement_id`, `mode_financements`.`description` AS `description_financement`, `entreprises`.`nom_etp` AS `nom_etp`, `entreprises`.`adresse` AS `adresse`, `entreprises`.`logo` AS `logo`, `factures`.`reference_bc` AS `reference_bc`, `factures`.`remise` AS `remise`, `v_temp_facture`.`payement_totale`- `factures`.`hors_taxe` AS `payement_cours`, CASE WHEN `v_temp_facture`.`payement_totale` - `factures`.`hors_taxe` < 0 AND `v_temp_facture`.`payement_totale` <= 0 THEN 'valider' WHEN `v_temp_facture`.`payement_totale` - `factures`.`hors_taxe` < 0 AND `v_temp_facture`.`payement_totale` > 0 THEN 'en_cour' WHEN `v_temp_facture`.`payement_totale` - `factures`.`hors_taxe` >= 0 THEN 'terminer' END AS `facture_encour`, `factures`.`type_facture_id` AS `type_facture_id`, `type_facture`.`description` AS `description_type_facture`, `type_facture`.`reference` AS `reference_facture`, `entreprises`.`NIF` AS `NIF`, `entreprises`.`STAT` AS `STAT`, `entreprises`.`RCS` AS `RCS`, `entreprises`.`CIF` AS `CIF`, `entreprises`.`Secteur_activite` AS `Secteur_activite` FROM ((((((((`v_temp_facture` join `factures`) join `type_payement`) join `taxes`) join `projets`) join `groupes`) join `entreprises`) join `mode_financements`) join `type_facture`) WHERE `v_temp_facture`.`facture_id` = `factures`.`id` AND `factures`.`type_payement_id` = `type_payement`.`id` AND `factures`.`type_financement_id` = `mode_financements`.`id` AND `factures`.`tax_id` = `taxes`.`id` AND `v_temp_facture`.`projet_id` = `projets`.`id` AND `factures`.`groupe_id` = `groupes`.`id` AND `projets`.`entreprise_id` = `entreprises`.`id` AND `factures`.`type_facture_id` = `type_facture`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_factureencaissement`
--
DROP TABLE IF EXISTS `v_factureencaissement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_factureencaissement`  AS SELECT `e`.`id` AS `encaissement_id`, `e`.`facture_id` AS `facture_id`, `e`.`montant_facture` AS `montant_facture`, `e`.`libelle` AS `libelle`, `e`.`payement` AS `payement`, `e`.`montant_ouvert` AS `montant_ouvert`, `e`.`date_encaissement` AS `date_encaissement`, `e`.`admin_id` AS `admin_id`, `f`.`bon_de_commande` AS `bon_de_commande`, `f`.`facture` AS `facture`, `f`.`montant_total` AS `montant_total`, `f`.`date_facture` AS `date_facture`, `f`.`projet_id` AS `projet_id`, `f`.`type_payement_id` AS `type_payement_id` FROM (`encaissements` `e` join `factures` `f` on(`e`.`facture_id` = `f`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_facture_actif`
--
DROP TABLE IF EXISTS `v_facture_actif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_facture_actif`  AS SELECT `v_facture`.`num_facture` AS `num_facture`, `v_facture`.`other_message` AS `other_message`, `v_facture`.`due_date` AS `due_date`, `v_facture`.`invoice_date` AS `invoice_date`, to_days(`v_facture`.`due_date`) - to_days(`v_facture`.`invoice_date`) AS `totale_jour`, ifnull(to_days(`v_facture`.`due_date`) - to_days(current_timestamp()),0) AS `jour_restant`, `v_facture`.`facture_encour` AS `facture_encour` FROM `v_facture` WHERE `v_facture`.`activiter` = 1 GROUP BY `v_facture`.`num_facture`, `v_facture`.`other_message`, `v_facture`.`due_date`, `v_facture`.`invoice_date`, `v_facture`.`facture_encour` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_facture_inactif`
--
DROP TABLE IF EXISTS `v_facture_inactif`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_facture_inactif`  AS SELECT `v_facture`.`num_facture` AS `num_facture`, `v_facture`.`other_message` AS `other_message`, `v_facture`.`due_date` AS `due_date`, `v_facture`.`invoice_date` AS `invoice_date`, to_days(`v_facture`.`due_date`) - to_days(`v_facture`.`invoice_date`) AS `totale_jour`, ifnull(to_days(`v_facture`.`due_date`) - to_days(current_timestamp()),0) AS `jour_restant`, `v_facture`.`facture_encour` AS `facture_encour` FROM `v_facture` WHERE `v_facture`.`activiter` = 0 GROUP BY `v_facture`.`num_facture`, `v_facture`.`other_message`, `v_facture`.`due_date`, `v_facture`.`invoice_date`, `v_facture`.`facture_encour` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_frais_annexe`
--
DROP TABLE IF EXISTS `v_frais_annexe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_frais_annexe`  AS SELECT `v_temp_frais_annexe`.`num_facture` AS `num_facture`, `v_temp_frais_annexe`.`montant_frais_annexe_id` AS `montant_frais_annexe_id`, `v_temp_frais_annexe`.`montant_total` AS `montant_total`, `v_temp_frais_annexe`.`payement_totale` AS `payement_totale`, `v_temp_frais_annexe`.`dernier_montant_ouvert` AS `dernier_montant_ouvert`, `v_temp_frais_annexe`.`date_frais_annexe` AS `date_frais_annexe`, `frais_annexes`.`description` AS `frais_annexe_description`, `montant_frais_annexes`.`description` AS `description`, `montant_frais_annexes`.`hors_taxe` AS `hors_taxe`, `montant_frais_annexes`.`qte` AS `qte`, `montant_frais_annexes`.`pu` AS `pu` FROM ((`v_temp_frais_annexe` join `montant_frais_annexes`) join `frais_annexes`) WHERE `v_temp_frais_annexe`.`montant_frais_annexe_id` = `montant_frais_annexes`.`id` AND `montant_frais_annexes`.`frais_annexe_id` = `frais_annexes`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_froid_evaluations`
--
DROP TABLE IF EXISTS `v_froid_evaluations`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_froid_evaluations`  AS SELECT `froid_evaluations`.`id` AS `id`, `froid_evaluations`.`cours_id` AS `cours_id`, `froid_evaluations`.`status` AS `status`, `froid_evaluations`.`projet_id` AS `projet_id`, `froid_evaluations`.`stagiaire_id` AS `stagiaire_id`, CASE WHEN `froid_evaluations`.`status` = 4 THEN '#018001' WHEN `froid_evaluations`.`status` = 3 THEN '#3CFF01' WHEN `froid_evaluations`.`status` = 2 THEN '#FFE601' WHEN `froid_evaluations`.`status` = 1 THEN '#FF8801' WHEN `froid_evaluations`.`status` = 0 THEN '#FF0000' END AS `couleur` FROM `froid_evaluations` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_groupe`
--
DROP TABLE IF EXISTS `v_groupe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_groupe`  AS SELECT `groupes`.`id` AS `groupe_id`, `groupes`.`nom_groupe` AS `nom_groupe`, `groupes`.`projet_id` AS `projet_id`, `projets`.`nom_projet` AS `nom_projet` FROM (`groupes` join `projets`) WHERE `groupes`.`projet_id` = `projets`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_groupe_projet`
--
DROP TABLE IF EXISTS `v_groupe_projet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_groupe_projet`  AS SELECT `v_detail_groupe_module_projet`.`lieu` AS `lieu`, `v_detail_groupe_module_projet`.`projet_id` AS `projet_id`, `projets`.`nom_projet` AS `nom_projet`, `v_detail_groupe_module_projet`.`groupe_id` AS `groupe_id`, `v_detail_groupe_module_projet`.`module_id` AS `module_id`, `v_detail_groupe_module_projet`.`nom_module` AS `nom_module`, `v_detail_groupe_module_projet`.`nom_groupe` AS `nom_groupe` FROM (`v_detail_groupe_module_projet` join `projets`) WHERE `v_detail_groupe_module_projet`.`projet_id` = `projets`.`id` GROUP BY `v_detail_groupe_module_projet`.`lieu`, `v_detail_groupe_module_projet`.`projet_id`, `v_detail_groupe_module_projet`.`groupe_id`, `v_detail_groupe_module_projet`.`module_id`, `v_detail_groupe_module_projet`.`nom_module`, `v_detail_groupe_module_projet`.`nom_groupe`, `projets`.`nom_projet` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_liste_formateur_projet`
--
DROP TABLE IF EXISTS `v_liste_formateur_projet`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_liste_formateur_projet`  AS SELECT `v_detailmoduleformationprojetformateur`.`projet_id` AS `projet_id`, `v_detailmoduleformationprojetformateur`.`formateur_id` AS `formateur_id`, `v_detailmoduleformationprojetformateur`.`nom_projet` AS `nom_projet`, `v_detailmoduleformationprojetformateur`.`nom_formateur` AS `nom_formateur`, `v_detailmoduleformationprojetformateur`.`prenom_formateur` AS `prenom_formateur`, `v_detailmoduleformationprojetformateur`.`photos` AS `photos` FROM `v_detailmoduleformationprojetformateur` GROUP BY `v_detailmoduleformationprojetformateur`.`projet_id`, `v_detailmoduleformationprojetformateur`.`formateur_id`, `v_detailmoduleformationprojetformateur`.`nom_projet`, `v_detailmoduleformationprojetformateur`.`nom_formateur`, `v_detailmoduleformationprojetformateur`.`prenom_formateur`, `v_detailmoduleformationprojetformateur`.`photos` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_liste_stagiaire_groupe`
--
DROP TABLE IF EXISTS `v_liste_stagiaire_groupe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_liste_stagiaire_groupe`  AS SELECT `participantsessions`.`stagiaire_id` AS `stagiaire_id`, `stagiaires`.`nom_stagiaire` AS `nom_stagiaire`, `stagiaires`.`prenom_stagiaire` AS `prenom_stagiaire`, `v_detailmoduleformation`.`groupe_id` AS `groupe_id`, `groupes`.`nom_groupe` AS `nom_groupe`, `v_detailmoduleformation`.`module_id` AS `module_id`, `v_detailmoduleformation`.`nom_module` AS `nom_module`, `v_detailmoduleformation`.`reference` AS `reference`, `v_detailmoduleformation`.`projet_id` AS `projet_id` FROM (((`stagiaires` join `participantsessions`) join `groupes`) join `v_detailmoduleformation`) WHERE `participantsessions`.`stagiaire_id` = `stagiaires`.`id` AND `v_detailmoduleformation`.`detail_id` = `participantsessions`.`detail_id` AND `v_detailmoduleformation`.`groupe_id` = `groupes`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_modules`
--
DROP TABLE IF EXISTS `v_modules`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_modules`  AS SELECT `modules`.`formation_id` AS `formation_id`, `formations`.`nom_formation` AS `nom_formation`, `modules`.`id` AS `module_id`, `modules`.`nom_module` AS `nom_module`, `modules`.`Reference` AS `Reference` FROM (`formations` join `modules`) WHERE `formations`.`id` = `modules`.`formation_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_participantsession`
--
DROP TABLE IF EXISTS `v_participantsession`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_participantsession`  AS SELECT `ps`.`detail_id` AS `detail_id`, `ps`.`stagiaire_id` AS `stagiaire_id`, `s`.`matricule` AS `matricule`, `s`.`nom_stagiaire` AS `nom_stagiaire`, `s`.`prenom_stagiaire` AS `prenom_stagiaire`, `s`.`fonction_stagiaire` AS `fonction_stagiaire`, `s`.`genre_stagiaire` AS `genre_stagiaire`, `s`.`mail_stagiaire` AS `mail_stagiaire`, `s`.`telephone_stagiaire` AS `telephone_stagiaire`, `s`.`entreprise_id` AS `entreprise_id`, `s`.`user_id` AS `user_id`, `s`.`photos` AS `photos` FROM (`participantsessions` `ps` join `stagiaires` `s` on(`ps`.`stagiaire_id` = `s`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_participant_groupe`
--
DROP TABLE IF EXISTS `v_participant_groupe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_participant_groupe`  AS SELECT `participant_groupe`.`id` AS `participant_groupe_id`, `participant_groupe`.`stagaire_id` AS `stagaire_id`, `participant_groupe`.`groupe_id` AS `groupe_id`, `stagiaires`.`nom_stagiaire` AS `nom_stagiaire`, `stagiaires`.`prenom_stagiaire` AS `prenom_stagiaire`, `groupes`.`nom_groupe` AS `nom_groupe`, `groupes`.`projet_id` AS `projet_id` FROM ((`participant_groupe` join `stagiaires`) join `groupes`) WHERE `participant_groupe`.`stagaire_id` = `stagiaires`.`id` AND `participant_groupe`.`groupe_id` = `groupes`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_pourcentage_status`
--
DROP TABLE IF EXISTS `v_pourcentage_status`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pourcentage_status`  AS SELECT `froid_evaluations`.`projet_id` AS `projet_id`, `froid_evaluations`.`stagiaire_id` AS `stagiaire_id`, sum(`froid_evaluations`.`status`) / (4 * count(`froid_evaluations`.`cours_id`)) * 100 AS `pourcentage` FROM `froid_evaluations` GROUP BY `froid_evaluations`.`projet_id`, `froid_evaluations`.`stagiaire_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_pourcent_globale_evaluation_action_formation`
--
DROP TABLE IF EXISTS `v_pourcent_globale_evaluation_action_formation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_pourcent_globale_evaluation_action_formation`  AS SELECT round(avg(`v_evaluation_action_formation`.`pourcent`),2) AS `globale`, `v_evaluation_action_formation`.`projet_id` AS `projet_id` FROM `v_evaluation_action_formation` GROUP BY `v_evaluation_action_formation`.`projet_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_programme`
--
DROP TABLE IF EXISTS `v_programme`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_programme`  AS SELECT `module`.`formation_id` AS `formation_id`, `module`.`nom_formation` AS `nom_formation`, `module`.`id_module` AS `id_module`, `module`.`nom_module` AS `nom_module`, `module`.`reference` AS `reference`, `module`.`prix` AS `prix_module`, `module`.`duree` AS `duree_module`, `programmes`.`id` AS `id_programme`, `programmes`.`titre` AS `titre_programme` FROM ((select `modules`.`id` AS `id_module`,`modules`.`Reference` AS `reference`,`modules`.`nom_module` AS `nom_module`,`modules`.`formation_id` AS `formation_id`,`formations`.`nom_formation` AS `nom_formation`,`modules`.`Prix` AS `prix`,`modules`.`Duree` AS `duree` from (`modules` join `formations`) where `modules`.`formation_id` = `formations`.`id`) `module` join `programmes` on(`module`.`id_module` = `programmes`.`module_id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_programme_detail_activiter`
--
DROP TABLE IF EXISTS `v_programme_detail_activiter`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_programme_detail_activiter`  AS SELECT `v_detailmoduleformation`.`detail_id` AS `detail_id`, `v_detailmoduleformation`.`lieu` AS `lieu`, `v_detailmoduleformation`.`h_debut` AS `h_debut`, `v_detailmoduleformation`.`h_fin` AS `h_fin`, `v_detailmoduleformation`.`date_detail` AS `date_detail`, `v_detailmoduleformation`.`projet_id` AS `projet_id`, `v_detailmoduleformation`.`groupe_id` AS `groupe_id`, `v_detailmoduleformation`.`session_id` AS `session_id`, `v_detailmoduleformation`.`module_id` AS `module_id`, `v_detailmoduleformation`.`formateur_id` AS `formateur_id`, `v_detailmoduleformation`.`reference` AS `reference`, `v_detailmoduleformation`.`nom_module` AS `nom_module`, `v_detailmoduleformation`.`duree` AS `duree`, `v_detailmoduleformation`.`formation_id` AS `formation_id`, `v_detailmoduleformation`.`nom_formation` AS `nom_formation`, `v_detail_cour`.`cours_id` AS `cours_id`, `v_detail_cour`.`titre_cours` AS `titre_cours`, `v_detail_cour`.`programme_id` AS `programme_id`, `v_detail_cour`.`titre_programme` AS `titre_programme` FROM (`v_detailmoduleformation` join `v_detail_cour`) WHERE `v_detailmoduleformation`.`detail_id` = `v_detail_cour`.`detail_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_projetentreprise`
--
DROP TABLE IF EXISTS `v_projetentreprise`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_projetentreprise`  AS SELECT `p`.`id` AS `projet_id`, `p`.`nom_projet` AS `nom_projet`, `p`.`entreprise_id` AS `entreprise_id`, `e`.`nom_etp` AS `nom_etp`, `e`.`adresse` AS `adresse`, `e`.`logo` AS `logo` FROM (`projets` `p` join `entreprises` `e` on(`p`.`entreprise_id` = `e`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_question_fille`
--
DROP TABLE IF EXISTS `v_question_fille`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_question_fille`  AS SELECT `question_fille`.`id` AS `id`, `question_fille`.`qst_fille` AS `qst_fille`, `question_fille`.`id_type_champs` AS `id_type_champs`, `type_champs`.`desc_champ` AS `desc_champ`, `question_fille`.`id_qst_mere` AS `id_qst_mere` FROM (`question_fille` join `type_champs`) WHERE `question_fille`.`id_type_champs` = `type_champs`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_reponse_evaluationchaud`
--
DROP TABLE IF EXISTS `v_reponse_evaluationchaud`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_reponse_evaluationchaud`  AS SELECT `reponse_evaluationchaud`.`reponse_desc_champ` AS `reponse_desc_champ`, `reponse_evaluationchaud`.`id_desc_champ` AS `id_desc_champ`, `description_champ_reponse`.`descr_champs` AS `desc_champ`, `description_champ_reponse`.`nb_max` AS `nb_max`, `description_champ_reponse`.`id_qst_fille` AS `id_qst_fille`, `reponse_evaluationchaud`.`stagiaire_id` AS `stagiaire_id`, `reponse_evaluationchaud`.`detail_id` AS `detail_id` FROM (`reponse_evaluationchaud` join `description_champ_reponse`) WHERE `reponse_evaluationchaud`.`id_desc_champ` = `description_champ_reponse`.`id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_sum_encaissement`
--
DROP TABLE IF EXISTS `v_sum_encaissement`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sum_encaissement`  AS SELECT `v_encaissement`.`facture_id` AS `facture_id`, `v_encaissement`.`projet_id` AS `projet_id`, sum(`v_encaissement`.`payement`) AS `payement_totale`, `v_encaissement`.`montant_total` AS `montant_total`, `v_encaissement`.`date_facture` AS `date_facture` FROM `v_encaissement` GROUP BY `v_encaissement`.`facture_id`, `v_encaissement`.`montant_total`, `v_encaissement`.`projet_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_sum_encaissement_frais_annexe`
--
DROP TABLE IF EXISTS `v_sum_encaissement_frais_annexe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_sum_encaissement_frais_annexe`  AS SELECT `v_encaissement_frais_annexe`.`montant_frais_annexe_id` AS `montant_frais_annexe_id`, `v_encaissement_frais_annexe`.`num_facture` AS `num_facture`, sum(`v_encaissement_frais_annexe`.`payement`) AS `payement_totale`, `v_encaissement_frais_annexe`.`montant_total` AS `montant_total`, `v_encaissement_frais_annexe`.`date_frais_annexe` AS `date_frais_annexe` FROM `v_encaissement_frais_annexe` GROUP BY `v_encaissement_frais_annexe`.`montant_frais_annexe_id`, `v_encaissement_frais_annexe`.`montant_total`, `v_encaissement_frais_annexe`.`num_facture` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_temp_facture`
--
DROP TABLE IF EXISTS `v_temp_facture`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_temp_facture`  AS SELECT `v_sum_encaissement`.`projet_id` AS `projet_id`, `v_sum_encaissement`.`facture_id` AS `facture_id`, `v_sum_encaissement`.`montant_total` AS `montant_total`, `v_sum_encaissement`.`payement_totale` AS `payement_totale`, `v_dernier_encaissement`.`dernier_montant_ouvert` AS `dernier_montant_ouvert`, `v_sum_encaissement`.`date_facture` AS `date_facture` FROM (`v_sum_encaissement` join `v_dernier_encaissement`) WHERE `v_sum_encaissement`.`facture_id` = `v_dernier_encaissement`.`facture_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_temp_frais_annexe`
--
DROP TABLE IF EXISTS `v_temp_frais_annexe`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_temp_frais_annexe`  AS SELECT `v_sum_encaissement_frais_annexe`.`num_facture` AS `num_facture`, `v_sum_encaissement_frais_annexe`.`montant_frais_annexe_id` AS `montant_frais_annexe_id`, `v_sum_encaissement_frais_annexe`.`montant_total` AS `montant_total`, `v_sum_encaissement_frais_annexe`.`payement_totale` AS `payement_totale`, `v_dernier_encaissement_frais_annexe`.`dernier_montant_ouvert` AS `dernier_montant_ouvert`, `v_sum_encaissement_frais_annexe`.`date_frais_annexe` AS `date_frais_annexe` FROM (`v_sum_encaissement_frais_annexe` join `v_dernier_encaissement_frais_annexe`) WHERE `v_sum_encaissement_frais_annexe`.`montant_frais_annexe_id` = `v_dernier_encaissement_frais_annexe`.`montant_frais_annexe_id` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_tmp_verify_evaluaction_action_formation`
--
DROP TABLE IF EXISTS `v_tmp_verify_evaluaction_action_formation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_tmp_verify_evaluaction_action_formation`  AS SELECT `evaluation_action_formation`.`id` AS `evaluation_action_formation_id`, `detail_evaluation_action_formation`.`pourcent` AS `pourcent`, `detail_evaluation_action_formation`.`projet_id` AS `projet_id` FROM (`evaluation_action_formation` left join `detail_evaluation_action_formation` on(`evaluation_action_formation`.`id` = `detail_evaluation_action_formation`.`evaluation_action_formation_id`)) ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_trie_detail_date`
--
DROP TABLE IF EXISTS `v_trie_detail_date`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_trie_detail_date`  AS SELECT `v_programme_detail_activiter`.`projet_id` AS `projet_id`, `v_programme_detail_activiter`.`h_debut` AS `h_debut`, `v_programme_detail_activiter`.`h_fin` AS `h_fin`, `v_programme_detail_activiter`.`date_detail` AS `date_detail` FROM `v_programme_detail_activiter` GROUP BY `v_programme_detail_activiter`.`projet_id`, `v_programme_detail_activiter`.`h_debut`, `v_programme_detail_activiter`.`h_fin`, `v_programme_detail_activiter`.`date_detail` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_trie_detail_programme`
--
DROP TABLE IF EXISTS `v_trie_detail_programme`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_trie_detail_programme`  AS SELECT `v_programme_detail_activiter`.`projet_id` AS `projet_id`, `v_programme_detail_activiter`.`programme_id` AS `programme_id`, `v_programme_detail_activiter`.`titre_programme` AS `titre_programme` FROM `v_programme_detail_activiter` GROUP BY `v_programme_detail_activiter`.`projet_id`, `v_programme_detail_activiter`.`programme_id`, `v_programme_detail_activiter`.`titre_programme` ;

-- --------------------------------------------------------

--
-- Structure de la vue `v_verify_evaluaction_action_formation`
--
DROP TABLE IF EXISTS `v_verify_evaluaction_action_formation`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_verify_evaluaction_action_formation`  AS SELECT count(`v_tmp_verify_evaluaction_action_formation`.`pourcent`) AS `verify`, `v_tmp_verify_evaluaction_action_formation`.`evaluation_action_formation_id` AS `evaluation_action_formation_id`, `v_tmp_verify_evaluaction_action_formation`.`projet_id` AS `projet_id` FROM `v_tmp_verify_evaluaction_action_formation` GROUP BY `v_tmp_verify_evaluaction_action_formation`.`projet_id`, `v_tmp_verify_evaluaction_action_formation`.`evaluation_action_formation_id` ;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admins_user_id_foreign` (`user_id`);

--
-- Index pour la table `annee_plans`
--
ALTER TABLE `annee_plans`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `but_objectif`
--
ALTER TABLE `but_objectif`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categorie_paiements`
--
ALTER TABLE `categorie_paiements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cfps`
--
ALTER TABLE `cfps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cfps_email_unique` (`Email`),
  ADD UNIQUE KEY `cfps_telephone_unique` (`Telephone`),
  ADD UNIQUE KEY `cfps_nif_unique` (`NIF`),
  ADD UNIQUE KEY `cfps_stat_unique` (`STAT`),
  ADD UNIQUE KEY `cfps_rcs_unique` (`RCS`),
  ADD UNIQUE KEY `cfps_cif_unique` (`CIF`),
  ADD KEY `cfps_user_id_foreign` (`user_id`);

--
-- Index pour la table `chef_departements`
--
ALTER TABLE `chef_departements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chef_departements_entreprise_id_foreign` (`entreprise_id`),
  ADD KEY `chef_departements_user_id_foreign` (`user_id`);

--
-- Index pour la table `chef_dep_entreprises`
--
ALTER TABLE `chef_dep_entreprises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chef_dep_entreprises_departement_entreprise_id_foreign` (`departement_entreprise_id`),
  ADD KEY `chef_dep_entreprises_chef_departement_id_foreign` (`chef_departement_id`);

--
-- Index pour la table `competence_formateurs`
--
ALTER TABLE `competence_formateurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `competence_formateurs_formateur_id_foreign` (`formateur_id`);

--
-- Index pour la table `conclusion`
--
ALTER TABLE `conclusion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Index pour la table `cours`
--
ALTER TABLE `cours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cours_programme_id_foreign` (`programme_id`);

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `departement_entreprises`
--
ALTER TABLE `departement_entreprises`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departement_entreprises_departement_id_foreign` (`departement_id`),
  ADD KEY `departement_entreprises_entreprise_id_foreign` (`entreprise_id`);

--
-- Index pour la table `description_champ_reponse`
--
ALTER TABLE `description_champ_reponse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_qst_fille` (`id_qst_fille`);

--
-- Index pour la table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `details_projet_id_foreign` (`projet_id`),
  ADD KEY `details_groupe_id_foreign` (`groupe_id`),
  ADD KEY `details_session_id_foreign` (`session_id`),
  ADD KEY `details_module_id_foreign` (`module_id`),
  ADD KEY `details_formateur_id_foreign` (`formateur_id`);

--
-- Index pour la table `detail_evaluation_action_formation`
--
ALTER TABLE `detail_evaluation_action_formation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluation_action_formation_id` (`evaluation_action_formation_id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Index pour la table `detail_evaluation_apprenants`
--
ALTER TABLE `detail_evaluation_apprenants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participant_groupe_id` (`participant_groupe_id`);

--
-- Index pour la table `detail_recommandation`
--
ALTER TABLE `detail_recommandation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recommandation_id` (`recommandation_id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Index pour la table `domaines`
--
ALTER TABLE `domaines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `encaissements`
--
ALTER TABLE `encaissements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facture_id` (`facture_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Index pour la table `encaissements_frais_annexe`
--
ALTER TABLE `encaissements_frais_annexe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facture_id` (`facture_id`),
  ADD KEY `montant_frais_annexe_id` (`montant_frais_annexe_id`);

--
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `evaluation_action_formation`
--
ALTER TABLE `evaluation_action_formation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `evaluation_resultat`
--
ALTER TABLE `evaluation_resultat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Index pour la table `events_table`
--
ALTER TABLE `events_table`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `executions`
--
ALTER TABLE `executions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `executions_stagiaire_id_foreign` (`stagiaire_id`),
  ADD KEY `executions_detail_id_foreign` (`session_id`);

--
-- Index pour la table `experience_formateurs`
--
ALTER TABLE `experience_formateurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `experience_formateurs_formateur_id_foreign` (`formateur_id`);

--
-- Index pour la table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projet_id` (`projet_id`),
  ADD KEY `type_payement_id` (`type_payement_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `feed_back`
--
ALTER TABLE `feed_back`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Index pour la table `formateurs`
--
ALTER TABLE `formateurs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `formateurs_mail_formateur_unique` (`mail_formateur`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `frais_annexes`
--
ALTER TABLE `frais_annexes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `froid_evaluations`
--
ALTER TABLE `froid_evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `froid_evaluations_cours_id_foreign` (`cours_id`),
  ADD KEY `froid_evaluations_projet_id_foreign` (`projet_id`),
  ADD KEY `froid_evaluations_stagiaire_id_foreign` (`stagiaire_id`);

--
-- Index pour la table `froid_evaluation_tables`
--
ALTER TABLE `froid_evaluation_tables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `froid_evaluation_tables_cours_id_foreign` (`cours_id`),
  ADD KEY `froid_evaluation_tables_projet_id_foreign` (`projet_id`),
  ADD KEY `froid_evaluation_tables_stagiaire_id_foreign` (`stagiaire_id`);

--
-- Index pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `limite_user_abonnements`
--
ALTER TABLE `limite_user_abonnements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `limite_user_abonnements_type_abonnement_id_foreign` (`type_abonnement_id`),
  ADD KEY `limite_user_abonnements_role_id_foreign` (`role_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `mode_financements`
--
ALTER TABLE `mode_financements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modules_formation_id_foreign` (`formation_id`);

--
-- Index pour la table `montant_frais_annexes`
--
ALTER TABLE `montant_frais_annexes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `frais_annexe_id` (`frais_annexe_id`);

--
-- Index pour la table `objectif_globaux`
--
ALTER TABLE `objectif_globaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `but_objectif_id` (`but_objectif_id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Index pour la table `objectif_pedagogique`
--
ALTER TABLE `objectif_pedagogique`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedagogique_id` (`pedagogique_id`),
  ADD KEY `projet_id` (`projet_id`);

--
-- Index pour la table `participantsessions`
--
ALTER TABLE `participantsessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participantsessions_detail_id_foreign` (`detail_id`),
  ADD KEY `participantsessions_stagiaire_id_foreign` (`stagiaire_id`);

--
-- Index pour la table `participant_groupe`
--
ALTER TABLE `participant_groupe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stagaire_id` (`stagaire_id`),
  ADD KEY `groupe_id` (`groupe_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `pedagogique`
--
ALTER TABLE `pedagogique`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `plan_formations`
--
ALTER TABLE `plan_formations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plan_formations_entreprise_id_foreign` (`entreprise_id`),
  ADD KEY `plan_formations_recueil_information_id_foreign` (`recueil_information_id`);

--
-- Index pour la table `presences`
--
ALTER TABLE `presences`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CONSTRAINT_NAME` (`detail_id`,`stagiaire_id`),
  ADD KEY `presences_detail_id_foreign` (`detail_id`),
  ADD KEY `presences_stagiaire_id_foreign` (`stagiaire_id`);

--
-- Index pour la table `programmes`
--
ALTER TABLE `programmes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `programmes_module_id_foreign` (`module_id`);

--
-- Index pour la table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `question_fille`
--
ALTER TABLE `question_fille`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_type_champs` (`id_type_champs`),
  ADD KEY `id_qst_mere` (`id_qst_mere`);

--
-- Index pour la table `question_mere`
--
ALTER TABLE `question_mere`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recommandation`
--
ALTER TABLE `recommandation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `recueil_informations`
--
ALTER TABLE `recueil_informations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stagiaire_id` (`stagiaire_id`),
  ADD KEY `formation_id` (`formation_id`),
  ADD KEY `entreprise_id` (`entreprise_id`);

--
-- Index pour la table `reponse_evaluationchaud`
--
ALTER TABLE `reponse_evaluationchaud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_desc_champ` (`id_desc_champ`),
  ADD KEY `stagiaire_id` (`stagiaire_id`),
  ADD KEY `detail_id` (`detail_id`);

--
-- Index pour la table `responsables`
--
ALTER TABLE `responsables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responsables_user_id_foreign` (`user_id`),
  ADD KEY `responsables_entreprise_id_foreign` (`entreprise_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stagiaires_entreprise_id_foreign` (`entreprise_id`),
  ADD KEY `stagiaires_user_id_foreign` (`user_id`);

--
-- Index pour la table `tarif_categories`
--
ALTER TABLE `tarif_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tarif_categories_type_abonnement_id_foreign` (`type_abonnement_id`),
  ADD KEY `tarif_categories_categorie_paiement_id_foreign` (`categorie_paiement_id`);

--
-- Index pour la table `taxes`
--
ALTER TABLE `taxes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `description` (`description`);

--
-- Index pour la table `type_abonnements`
--
ALTER TABLE `type_abonnements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_champs`
--
ALTER TABLE `type_champs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_facture`
--
ALTER TABLE `type_facture`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_payement`
--
ALTER TABLE `type_payement`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `annee_plans`
--
ALTER TABLE `annee_plans`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `but_objectif`
--
ALTER TABLE `but_objectif`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `categorie_paiements`
--
ALTER TABLE `categorie_paiements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `cfps`
--
ALTER TABLE `cfps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `chef_departements`
--
ALTER TABLE `chef_departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT pour la table `chef_dep_entreprises`
--
ALTER TABLE `chef_dep_entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `competence_formateurs`
--
ALTER TABLE `competence_formateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `conclusion`
--
ALTER TABLE `conclusion`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `cours`
--
ALTER TABLE `cours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `departement_entreprises`
--
ALTER TABLE `departement_entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `description_champ_reponse`
--
ALTER TABLE `description_champ_reponse`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT pour la table `details`
--
ALTER TABLE `details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `detail_evaluation_action_formation`
--
ALTER TABLE `detail_evaluation_action_formation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `detail_evaluation_apprenants`
--
ALTER TABLE `detail_evaluation_apprenants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `detail_recommandation`
--
ALTER TABLE `detail_recommandation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `domaines`
--
ALTER TABLE `domaines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `encaissements`
--
ALTER TABLE `encaissements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `encaissements_frais_annexe`
--
ALTER TABLE `encaissements_frais_annexe`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT pour la table `evaluation_action_formation`
--
ALTER TABLE `evaluation_action_formation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `evaluation_resultat`
--
ALTER TABLE `evaluation_resultat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `events_table`
--
ALTER TABLE `events_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `executions`
--
ALTER TABLE `executions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `experience_formateurs`
--
ALTER TABLE `experience_formateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `feed_back`
--
ALTER TABLE `feed_back`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `formateurs`
--
ALTER TABLE `formateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `frais_annexes`
--
ALTER TABLE `frais_annexes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `froid_evaluations`
--
ALTER TABLE `froid_evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `froid_evaluation_tables`
--
ALTER TABLE `froid_evaluation_tables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `limite_user_abonnements`
--
ALTER TABLE `limite_user_abonnements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT pour la table `mode_financements`
--
ALTER TABLE `mode_financements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `montant_frais_annexes`
--
ALTER TABLE `montant_frais_annexes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `objectif_globaux`
--
ALTER TABLE `objectif_globaux`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `objectif_pedagogique`
--
ALTER TABLE `objectif_pedagogique`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `participantsessions`
--
ALTER TABLE `participantsessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `participant_groupe`
--
ALTER TABLE `participant_groupe`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `pedagogique`
--
ALTER TABLE `pedagogique`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `plan_formations`
--
ALTER TABLE `plan_formations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `presences`
--
ALTER TABLE `presences`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `question_fille`
--
ALTER TABLE `question_fille`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `question_mere`
--
ALTER TABLE `question_mere`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `recommandation`
--
ALTER TABLE `recommandation`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `recueil_informations`
--
ALTER TABLE `recueil_informations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `reponse_evaluationchaud`
--
ALTER TABLE `reponse_evaluationchaud`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `responsables`
--
ALTER TABLE `responsables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `tarif_categories`
--
ALTER TABLE `tarif_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `taxes`
--
ALTER TABLE `taxes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `type_abonnements`
--
ALTER TABLE `type_abonnements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_champs`
--
ALTER TABLE `type_champs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_facture`
--
ALTER TABLE `type_facture`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `type_payement`
--
ALTER TABLE `type_payement`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `cfps`
--
ALTER TABLE `cfps`
  ADD CONSTRAINT `cfps_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `chef_departements`
--
ALTER TABLE `chef_departements`
  ADD CONSTRAINT `chef_departements_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `chef_departements_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `chef_dep_entreprises`
--
ALTER TABLE `chef_dep_entreprises`
  ADD CONSTRAINT `chef_dep_entreprises_chef_departement_id_foreign` FOREIGN KEY (`chef_departement_id`) REFERENCES `chef_departements` (`id`),
  ADD CONSTRAINT `chef_dep_entreprises_departement_entreprise_id_foreign` FOREIGN KEY (`departement_entreprise_id`) REFERENCES `departement_entreprises` (`id`);

--
-- Contraintes pour la table `conclusion`
--
ALTER TABLE `conclusion`
  ADD CONSTRAINT `conclusion_ibfk_1` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `cours_programme_id_foreign` FOREIGN KEY (`programme_id`) REFERENCES `programmes` (`id`);

--
-- Contraintes pour la table `departement_entreprises`
--
ALTER TABLE `departement_entreprises`
  ADD CONSTRAINT `departement_entreprises_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`),
  ADD CONSTRAINT `departement_entreprises_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `description_champ_reponse`
--
ALTER TABLE `description_champ_reponse`
  ADD CONSTRAINT `description_champ_reponse_ibfk_1` FOREIGN KEY (`id_qst_fille`) REFERENCES `question_fille` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `details`
--
ALTER TABLE `details`
  ADD CONSTRAINT `details_formateur_id_foreign` FOREIGN KEY (`formateur_id`) REFERENCES `formateurs` (`id`),
  ADD CONSTRAINT `details_groupe_id_foreign` FOREIGN KEY (`groupe_id`) REFERENCES `groupes` (`id`),
  ADD CONSTRAINT `details_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `details_projet_id_foreign` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `details_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`);

--
-- Contraintes pour la table `detail_evaluation_action_formation`
--
ALTER TABLE `detail_evaluation_action_formation`
  ADD CONSTRAINT `detail_evaluation_action_formation_ibfk_1` FOREIGN KEY (`evaluation_action_formation_id`) REFERENCES `evaluation_action_formation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_evaluation_action_formation_ibfk_2` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `detail_evaluation_apprenants`
--
ALTER TABLE `detail_evaluation_apprenants`
  ADD CONSTRAINT `detail_evaluation_apprenants_ibfk_1` FOREIGN KEY (`participant_groupe_id`) REFERENCES `participant_groupe` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `detail_recommandation`
--
ALTER TABLE `detail_recommandation`
  ADD CONSTRAINT `detail_recommandation_ibfk_1` FOREIGN KEY (`recommandation_id`) REFERENCES `recommandation` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_recommandation_ibfk_2` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `encaissements`
--
ALTER TABLE `encaissements`
  ADD CONSTRAINT `encaissements_ibfk_1` FOREIGN KEY (`facture_id`) REFERENCES `factures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `encaissements_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admins` (`id`);

--
-- Contraintes pour la table `encaissements_frais_annexe`
--
ALTER TABLE `encaissements_frais_annexe`
  ADD CONSTRAINT `encaissements_frais_annexe_ibfk_1` FOREIGN KEY (`facture_id`) REFERENCES `factures` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `encaissements_frais_annexe_ibfk_2` FOREIGN KEY (`montant_frais_annexe_id`) REFERENCES `montant_frais_annexes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `evaluation_resultat`
--
ALTER TABLE `evaluation_resultat`
  ADD CONSTRAINT `evaluation_resultat_ibfk_1` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `feed_back`
--
ALTER TABLE `feed_back`
  ADD CONSTRAINT `feed_back_ibfk_1` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `froid_evaluation_tables`
--
ALTER TABLE `froid_evaluation_tables`
  ADD CONSTRAINT `froid_evaluation_tables_cours_id_foreign` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`),
  ADD CONSTRAINT `froid_evaluation_tables_projet_id_foreign` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`),
  ADD CONSTRAINT `froid_evaluation_tables_stagiaire_id_foreign` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`);

--
-- Contraintes pour la table `limite_user_abonnements`
--
ALTER TABLE `limite_user_abonnements`
  ADD CONSTRAINT `limite_user_abonnements_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `limite_user_abonnements_type_abonnement_id_foreign` FOREIGN KEY (`type_abonnement_id`) REFERENCES `type_abonnements` (`id`);

--
-- Contraintes pour la table `montant_frais_annexes`
--
ALTER TABLE `montant_frais_annexes`
  ADD CONSTRAINT `montant_frais_annexes_ibfk_1` FOREIGN KEY (`frais_annexe_id`) REFERENCES `frais_annexes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `objectif_globaux`
--
ALTER TABLE `objectif_globaux`
  ADD CONSTRAINT `objectif_globaux_ibfk_1` FOREIGN KEY (`but_objectif_id`) REFERENCES `but_objectif` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `objectif_globaux_ibfk_2` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `objectif_pedagogique`
--
ALTER TABLE `objectif_pedagogique`
  ADD CONSTRAINT `objectif_pedagogique_ibfk_1` FOREIGN KEY (`pedagogique_id`) REFERENCES `pedagogique` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `objectif_pedagogique_ibfk_2` FOREIGN KEY (`projet_id`) REFERENCES `projets` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `participant_groupe`
--
ALTER TABLE `participant_groupe`
  ADD CONSTRAINT `participant_groupe_ibfk_1` FOREIGN KEY (`stagaire_id`) REFERENCES `stagiaires` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `participant_groupe_ibfk_2` FOREIGN KEY (`groupe_id`) REFERENCES `groupes` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `plan_formations`
--
ALTER TABLE `plan_formations`
  ADD CONSTRAINT `plan_formations_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `plan_formations_recueil_information_id_foreign` FOREIGN KEY (`recueil_information_id`) REFERENCES `recueil_informations` (`id`);

--
-- Contraintes pour la table `recueil_informations`
--
ALTER TABLE `recueil_informations`
  ADD CONSTRAINT `recueil_informations_ibfk_1` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`),
  ADD CONSTRAINT `recueil_informations_ibfk_2` FOREIGN KEY (`formation_id`) REFERENCES `formations` (`id`),
  ADD CONSTRAINT `recueil_informations_ibfk_3` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`);

--
-- Contraintes pour la table `tarif_categories`
--
ALTER TABLE `tarif_categories`
  ADD CONSTRAINT `tarif_categories_categorie_paiement_id_foreign` FOREIGN KEY (`categorie_paiement_id`) REFERENCES `categorie_paiements` (`id`),
  ADD CONSTRAINT `tarif_categories_type_abonnement_id_foreign` FOREIGN KEY (`type_abonnement_id`) REFERENCES `type_abonnements` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
