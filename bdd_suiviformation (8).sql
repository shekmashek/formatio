-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 05 oct. 2021 à 13:01
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.19

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
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY auto_increment,
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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `details`
--

INSERT INTO `details` (`id`, `lieu`, `h_debut`, `h_fin`, `date_detail`, `projet_id`, `groupe_id`, `session_id`, `module_id`, `formateur_id`, `created_at`, `updated_at`) VALUES
(1, 'Tamatave', '7', '12', '2021-09-02', 2, 3, 1, 6, 1, '2021-09-10 04:54:00', '2021-09-10 04:54:00'),
(2, 'Tamatave', '7', '9', '2021-09-17', 1, 2, 2, 2, 1, '2021-09-10 05:49:58', '2021-09-10 05:49:58'),
(3, 'Tamatave', '14', '16', '2021-09-04', 2, 4, 1, 6, 1, '2021-09-13 05:22:31', '2021-09-13 05:22:31'),
(4, 'Tamatave', '14', '16', '2021-09-08', 2, 3, 1, 6, 1, '2021-09-13 06:28:01', '2021-09-13 06:28:01'),
(5, 'Tanà', '14', '16', '2021-09-02', 1, 3, 1, 6, 1, '2021-09-23 09:30:34', '2021-09-23 09:30:34');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom_etp`, `adresse`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'Bolloré', 'Tamatave', '/XE31CYlSiJECTPTzddjOVqV0YWfHnDmSIbUsyWsW.png', '2021-09-08 05:05:32', '2021-09-08 05:05:32'),
(2, 'Ocean trade', 'Andraharo', '/Qx1BzA05e0N84tuldMXOrbdGzJVNXQQWlizrjvMj.png', '2021-09-09 04:23:22', '2021-09-09 04:23:22');

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
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formateurs`
--

CREATE TABLE `formateurs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_formateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_formateur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE formateurs ADD COLUMN mail_formateur VARCHAR(200) UNIQUE;
--
-- Déchargement des données de la table `formateurs`
--

INSERT INTO `formateurs` (`id`, `nom_formateur`, `prenom_formateur`, `photos`, `created_at`, `updated_at`) VALUES
(1, 'RAHARIFETRA', 'Holy Nicole', '/rdrBF0Cl5qXhMcoaE1Eshx3vM3LBDWBYzgY4dnIJ.png', '2021-09-09 05:19:54', '2021-09-09 05:19:54');

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `nom_formation`, `created_at`, `updated_at`) VALUES
(1, 'MS Excel', NULL, NULL),
(2, 'Ms Power BI', NULL, NULL);

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
(2, 'G2', 1, '2021-09-08 08:01:09', '2021-09-08 08:12:04'),
(3, 'G1', 2, '2021-09-09 04:45:05', '2021-09-09 04:45:05'),
(4, 'G2', 2, '2021-09-13 05:21:28', '2021-09-13 05:21:28');

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
(25, '2021_09_08_071408_create_formateurs_table', 8),
(26, '2021_09_08_071508_create_projets_table', 8),
(27, '2021_09_08_071547_create_groupes_table', 8),
(28, '2021_09_08_071642_create_sessions_table', 8),
(29, '2021_09_08_071800_create_details_table', 8),
(30, '2021_09_08_072247_create_executions_table', 8),
(31, '2021_09_08_073011_create_executions_table', 9),
(32, '2021_09_13_114242_create_participant_sessions_table', 10),
(33, '2021_10_05_081706_create_programmes_table', 11);

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
  `Duree` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `modules`
--

INSERT INTO `modules` (`id`, `Reference`, `nom_module`, `formation_id`, `created_at`, `updated_at`, `Prix`, `Duree`) VALUES
(2, 'MOD_EX02', 'NII.Calculs et Fonctions', 1, NULL, NULL, 300000, 12),
(3, 'MOD_EX03', 'NIII.Organisation et gestion des données', 1, NULL, NULL, 300000, 12),
(4, 'MOD_EX04', 'NIV.Business Intelligence', 1, NULL, NULL, 350000, 12),
(5, 'MOD_EX05', 'NV.VBA', 1, NULL, NULL, 450000, 18),
(6, 'MOD_BI01', 'NI.Fondamentaux', 2, NULL, '2021-08-31 09:07:56', 450000, 18),
(7, 'MOD_BI02', 'NII.Perfectionnement Dax', 2, NULL, NULL, 450000, 18),
(8, 'MOD_BI03', 'NIII.Dataviz et analytics', 2, NULL, NULL, 450000, 18),
(9, 'MOD_EX01', 'NI.Fondamentaux', 1, '2021-09-01 03:25:44', '2021-09-01 03:25:44', 300000, 12);

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

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'Efficience', 9, NULL, NULL),
(2, 'Methode de calcul', 9, NULL, NULL),
(3, 'Reference', 9, NULL, NULL),
(4, 'Operateur', 9, NULL, NULL),
(5, 'Valeurs', 9, NULL, NULL),
(6, 'Syntaxe', 9, NULL, NULL),
(7, 'Fonctions statiques', 9, NULL, NULL),
(8, 'Cumul', 9, NULL, NULL),
(9, 'Date', 9, NULL, NULL),
(10, 'Heure', 9, NULL, NULL),
(11, 'References nommes', 9, NULL, NULL),
(12, 'Fonctions SI simple', 9, NULL, NULL),
(13, 'Fonction SI imbriquee', 2, NULL, NULL),
(14, 'Fonctions logiques', 2, NULL, NULL),
(15, 'Combinaison de texte', 2, NULL, NULL),
(16, 'Extraction de texte', 2, NULL, NULL),
(17, 'Recherche de donnees', 2, NULL, NULL),
(18, 'Validation des donnees', 3, NULL, NULL),
(19, 'Mise en forme conditionnelle', 3, NULL, NULL),
(20, 'Tri et filtre', 3, NULL, NULL),
(21, 'Base de donnees', 3, NULL, NULL),
(22, 'Tableau vs plage', 3, NULL, NULL),
(23, 'Tableau croise dynamique', 3, NULL, NULL),
(24, 'Graphique', 3, NULL, NULL),
(25, 'Connexion', 4, NULL, NULL),
(26, 'Chargement', 4, NULL, NULL),
(27, 'Transformation', 4, NULL, NULL),
(29, 'Typage', 4, NULL, NULL),
(30, 'Fusion', 4, NULL, NULL),
(31, 'Variables', 4, NULL, NULL),
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
(75, 'Cartes', 8, NULL, NULL);

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
(1, 'BOLLORÉ LOGISTICS 7/2021_131', 1, '2021-09-08 05:07:23', '2021-09-08 05:09:45'),
(2, 'OCEAN20201', 2, '2021-09-09 04:23:41', '2021-09-09 04:23:41');

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

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `date_debut`, `date_fin`, `created_at`, `updated_at`) VALUES
(1, '2021-09-02', '2021-09-09', '2021-09-08 09:58:53', '2021-09-08 09:58:53'),
(2, '2021-09-17', '2021-09-24', '2021-09-10 05:11:52', '2021-09-10 05:11:52');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `stagiaires`
--

INSERT INTO `stagiaires` (`id`, `matricule`, `nom_stagiaire`, `prenom_stagiaire`, `genre_stagiaire`, `fonction_stagiaire`, `mail_stagiaire`, `telephone_stagiaire`, `entreprise_id`, `user_id`, `photos`, `created_at`, `updated_at`) VALUES
(1, '001235', 'Aina', 'Harifidy Anderson', 'femme', 'DRH', 'rivo.rakotonirina@bollore.com', '0333785122', 2, 33, '/nzFZlEXefseXMinpizfAlRYmb7uHwGV06tyPpMyn.png', '2021-09-10 05:45:32', '2021-10-04 08:52:57'),
(2, 'OO111', 'RAHOLIARINORO', 'Monjison Nirina', 'homme', 'Responsable affaires en douane TRANSIT', 'nic@yahoo.com', '0346633837', 2, 35, '/9npodO5QGcjVeBL76UfJ4VXSHOStyFhGjh5liTLY.png', '2021-10-05 04:02:19', '2021-10-05 04:02:19');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nicole', 'nicrah16@gmail.com', NULL, '$2y$10$9i0uUmJpIwVtYX1dlEdM5.bNcYXU8CrD8QXDS5loPVAurII6BmbFm', NULL, '2021-08-04 05:53:44', '2021-08-04 05:53:44'),
(25, 'RAHARIFETRA', 'harifidy.andrianisa@bollore.com', NULL, '$2y$10$lbh/eouuxjHA4ZMxnQ.BYurLHrv2reNjGCxtCKnNOq6LWarRG.d.G', NULL, '2021-08-31 04:49:36', '2021-08-31 04:49:36'),
(26, 'Ainamalala', 'monique.tonga@yahoo.com', NULL, '$2y$10$Ggbv4RZgzas3W5Vt/zZEYOhTfVbz7XjfgGlGewoO1p/XtJV9OwSUC', NULL, '2021-08-31 05:03:39', '2021-08-31 06:07:48'),
(28, 'Andrianisa', 'rivo.rakotonirina@gmail.com', NULL, '$2y$10$N7Q9GKGodEcJAuUgx4AAL.4lU378cZaH5GHFYSF775snK7G9369f2', NULL, '2021-08-31 05:23:42', '2021-08-31 06:05:56'),
(29, 'Ainamalala', 'monique.tonga@bollore.com', NULL, '$2y$10$DBcnR5lTAQs4cdOFXUNMk.LY832sxckRFBqGQPmVsExlg46HF6cOC', NULL, '2021-09-10 05:41:47', '2021-09-10 05:41:47'),
(31, 'Ainamalala', 'andry@gmail.com', NULL, '$2y$10$X5eJgON5kSS2TtYmBqIdGuM7iHcwzNzko4fSwuuoPghFsPEHO9PY.', NULL, '2021-09-10 05:43:59', '2021-09-10 05:43:59'),
(33, 'Aina', 'rivo.rakotonirina@bollore.com', NULL, '$2y$10$GserBvaOtYnUBkQvQ8I4G.oj2YxtX.pg5rsssVg3bH5mgNuwi9PCq', NULL, '2021-09-10 05:45:32', '2021-10-04 08:52:58'),
(35, 'RAHOLIARINORO', 'nic@yahoo.com', NULL, '$2y$10$1yebgjtXjhVTWdj13tg0.e96YQpUgQDCCFA3Ok0OA3DKBbEJsppFu', NULL, '2021-10-05 04:02:18', '2021-10-05 04:02:18');

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
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`);

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
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formateurs`
--
ALTER TABLE `formateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modules_formation_id_foreign` (`formation_id`);

--
-- Index pour la table `participantsessions`
--
ALTER TABLE `participantsessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `participantsessions_detail_id_foreign` (`detail_id`),
  ADD KEY `participantsessions_stagiaire_id_foreign` (`stagiaire_id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Index pour la table `responsables`
--
ALTER TABLE `responsables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `responsables_user_id_foreign` (`user_id`),
  ADD KEY `responsables_entreprise_id_foreign` (`entreprise_id`);

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
-- AUTO_INCREMENT pour la table `details`
--
ALTER TABLE `details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `formateurs`
--
ALTER TABLE `formateurs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `participantsessions`
--
ALTER TABLE `participantsessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `programmes`
--
ALTER TABLE `programmes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT pour la table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `responsables`
--
ALTER TABLE `responsables`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `admins`
--
ALTER TABLE `admins`
  ADD CONSTRAINT `admins_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
-- Contraintes pour la table `executions`
--
ALTER TABLE `executions`
  ADD CONSTRAINT `executions_detail_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `details` (`id`),
  ADD CONSTRAINT `executions_stagiaire_id_foreign` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`);

--
-- Contraintes pour la table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_formation_id_foreign` FOREIGN KEY (`formation_id`) REFERENCES `formations` (`id`);

--
-- Contraintes pour la table `participantsessions`
--
ALTER TABLE `participantsessions`
  ADD CONSTRAINT `participantsessions_detail_id_foreign` FOREIGN KEY (`detail_id`) REFERENCES `details` (`id`),
  ADD CONSTRAINT `participantsessions_stagiaire_id_foreign` FOREIGN KEY (`stagiaire_id`) REFERENCES `stagiaires` (`id`);

--
-- Contraintes pour la table `programmes`
--
ALTER TABLE `programmes`
  ADD CONSTRAINT `programmes_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`);

--
-- Contraintes pour la table `responsables`
--
ALTER TABLE `responsables`
  ADD CONSTRAINT `responsables_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `responsables_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `stagiaires`
--
ALTER TABLE `stagiaires`
  ADD CONSTRAINT `stagiaires_entreprise_id_foreign` FOREIGN KEY (`entreprise_id`) REFERENCES `entreprises` (`id`),
  ADD CONSTRAINT `stagiaires_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
