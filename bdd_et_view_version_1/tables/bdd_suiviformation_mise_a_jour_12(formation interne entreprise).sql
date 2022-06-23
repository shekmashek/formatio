
CREATE TABLE formateurs_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_formateur varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  prenom_formateur varchar(191) COLLATE utf8mb4_unicode_ci,
  mail_formateur varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  numero_formateur varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  photos varchar(191) COLLATE utf8mb4_unicode_ci,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  genre varchar(255) COLLATE utf8mb4_unicode_ci,
  date_naissance varchar(255) COLLATE utf8mb4_unicode_ci,
  adresse varchar(255) COLLATE utf8mb4_unicode_ci ,
  cin varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  specialite varchar(255) COLLATE utf8mb4_unicode_ci,
  niveau varchar(255) COLLATE utf8mb4_unicode_ci,
  activiter boolean not null default true,
  user_id bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- ts de ilaina ^


CREATE TABLE projets_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_projet varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  status varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  activiter boolean not null default true,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE groupes_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  max_participant varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  min_participant varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  nom_groupe varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  projet_interne_id  bigint(20) UNSIGNED  NOT NULL REFERENCES projets_interne(id) ON DELETE CASCADE,
  module_former  varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  date_debut date NOT NULL,
  date_fin date NOT NULL,
  status varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  activiter boolean not null default true,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE participant_groupe_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  stagiaire_id bigint(20) UNSIGNED NOT NULL REFERENCES stagiaires(id) ON DELETE CASCADE,
  groupe_interne_id bigint(20) UNSIGNED NOT NULL REFERENCES groupes_interne(id) ON DELETE CASCADE,
  created_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE details_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  lieu varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  h_debut varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  h_fin varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  date_detail date NOT NULL,
  formateur_interne_id bigint(20) UNSIGNED NOT NULL REFERENCES formateurs_interne(id) ON DELETE CASCADE,
  groupe_interne_id bigint(20) UNSIGNED NOT NULL REFERENCES groupes_interne(id) ON DELETE CASCADE,
  projet_interne_id bigint(20) UNSIGNED NOT NULL REFERENCES projets_interne(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE presences_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  status varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  detail_interne_id bigint(20) UNSIGNED NOT NULL REFERENCES details_interne(id) ON DELETE CASCADE,
  stagiaire_id bigint(20) UNSIGNED NOT NULL REFERENCES stagiaires(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `domaines_interne` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_domaine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `domaines_interne` (`id`, `nom_domaine`, `created_at`, `updated_at`) VALUES
(1, 'Achat, Logistique', NULL, NULL),
(2, 'Animaux, Nature', NULL, NULL),
(3, 'Art, Design, Décoration\r\n', NULL, NULL),
(4, 'Artisanat, Petit Commerce\r\n', NULL, NULL),
(5, 'Banque, Finance, Assurance\r\n', NULL, NULL),
(6, 'Bien-Être, Relaxation\r\n', NULL, NULL),
(7, 'Bilan De Compétences, VAE\r\n\r\n', NULL, NULL),
(8, 'BTP, Travaux, Architecture\r\n', NULL, NULL),
(9, 'Bureautique, Office\r\n', NULL, NULL),
(10, 'Commerce, Marketing\r\n', NULL, NULL),
(11, 'Communication, Événementiel\r\n', NULL, NULL),
(12, 'Comptabilité, Gestion\r\n', NULL, NULL),
(13, 'Défense, Sécurité, Secourisme\r\n', NULL, NULL),
(14, 'Développement Personnel, Épanouissement\r\n', NULL, NULL),
(15, 'Digital, Internet\r\n', NULL, NULL),
(16, 'Enseignement, Coaching', NULL, NULL),
(17, 'Esthétique, Coiffure\r\n', NULL, NULL),
(18, 'Fonction Publique, Citoyenneté, Droit\r\n\r\n', NULL, NULL),
(19, 'Hôtellerie, Restauration, Cuisine\r\n\r\n', NULL, NULL),
(20, 'Immobilier, Urbanisme\r\n\r\n', NULL, NULL),
(21, 'Industrie, Matériaux, Énergie\r\n', NULL, NULL),
(22, 'Informatique, DATA, SIG\r\n', NULL, NULL),
(23, 'Langues\r\n', NULL, NULL),
(24, 'Management, Direction\r\n\r\n', NULL, NULL),
(25, 'Petite Enfance, Puériculture\r\n', NULL, NULL),
(26, 'Qualité Hygiène Sécurité Environnement\r\n\r\n', NULL, NULL),
(27, 'Réseaux, Telecom\r\n', NULL, NULL),
(28, 'Ressources Humaines, Paie\r\n\r\n', NULL, NULL),
(29, 'Santé, Médecine\r\n', NULL, NULL),
(30, 'Sciences\r\n\r\n', NULL, NULL),
(31, 'Secrétariat, Accueil\r\n', NULL, NULL),
(32, 'Social, Services à la Personne\r\n', NULL, NULL),
(33, 'Tourisme, Loisirs\r\n\r\n', NULL, NULL),
(34, 'Transport, Permis\r\n', NULL, NULL);

ALTER TABLE `domaines_interne`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `domaines_interne`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
COMMIT;

alter table domaines_interne add etp_id bigint(20) NOT NULL DEFAULT 0 REFERENCES entreprises(id) ON DELETE CASCADE;


CREATE TABLE `formations_interne` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom_formation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domaine_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `etp_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `formations_interne` ( `nom_formation`, `domaine_id`, `created_at`, `updated_at`, `etp_id`) VALUES( 'Stock', 1, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),( 'Import-export', 1, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),( 'Agriculture', 2, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),( 'Soins Vétérinaires', 2, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),( 'Fleuriste', 2, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),( 'Déco', 3, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),( 'Photographie', 3, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),( 'Couture', 3, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),( 'Graphisme', 3, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),
( 'Menuiserie', 4, '2021-11-17 04:00:27', '2021-11-17 04:00:27', 1),
( 'Plomberie', 4, '2021-11-17 04:00:27', '2021-11-17 04:00:27', 1),
( 'Serrurerie', 4, '2021-11-17 04:00:27', '2021-11-17 04:00:27', 1),
( 'Services', 4, '2021-11-17 04:00:27', '2021-11-17 04:00:27', 1),
( 'Banque', 5, '2021-11-17 04:00:41', '2021-11-17 04:00:41', 1),
( 'Assurance', 5, '2021-11-17 04:00:41', '2021-11-17 04:00:41', 1),
( 'Trading', 5, '2021-11-17 04:00:41', '2021-11-17 04:00:41', 1),
( 'Naturopathie', 6, '2021-11-17 04:06:54', '2021-11-17 04:06:54', 1),
( 'Sophrologie', 6, '2021-11-17 04:06:54', '2021-11-17 04:06:54', 1),
( 'Massage', 6, '2021-11-17 04:06:54', '2021-11-17 04:06:54', 1),
( 'Hypnose', 6, '2021-11-17 04:06:54', '2021-11-17 04:06:54', 1),
( 'Orientation', 7, '2021-11-17 04:07:18', '2021-11-17 04:07:18', 1),
( 'Bilan Professionnel', 7, '2021-11-17 04:07:18', '2021-11-17 04:07:18', 1),
( 'Conduite de Travaux', 8, '2021-11-17 04:07:28', '2021-11-17 04:07:28', 1),
( 'Électricité', 8, '2021-11-17 04:07:28', '2021-11-17 04:07:28', 1),
( 'Autocad', 8, '2021-11-17 04:07:28', '2021-11-17 04:07:28', 1),
( 'Excel', 9, '2021-11-17 04:07:45', '2021-11-17 04:07:45', 1),
( 'Word', 9, '2021-11-17 04:07:45', '2021-11-17 04:07:45', 1),
( 'Google Docs', 9, '2021-11-17 04:07:45', '2021-11-17 04:07:45', 1),
( 'Vente', 10, '2021-11-17 04:07:55', '2021-11-17 04:07:55', 1),
( 'Relation Client', 10, '2021-11-17 04:07:55', '2021-11-17 04:07:55', 1),
( 'Wedding Planner', 11, '2021-11-17 04:08:21', '2021-11-17 04:08:21', 1),
( 'Événement', 11, '2021-11-17 04:08:21', '2021-11-17 04:08:21', 1),
( 'Journalisme', 11, '2021-11-17 04:08:21', '2021-11-17 04:08:21', 1),
( 'Gestion', 12, '2021-11-17 04:08:31', '2021-11-17 04:08:31', 1),
( 'DCG', 12, '2021-11-17 04:08:31', '2021-11-17 04:08:31', 1),
( 'Ciel Compta', 12, '2021-11-17 04:08:31', '2021-11-17 04:08:31', 1),
( 'Paie', 12, '2021-11-17 04:08:31', '2021-11-17 04:08:31', 1),
( 'Agent de Sécurité', 13, '2021-11-17 04:08:53', '2021-11-17 04:08:53', 1),
( 'Incendie', 13, '2021-11-17 04:08:53', '2021-11-17 04:08:53', 1),
( 'SST', 13, '2021-11-17 04:08:53', '2021-11-17 04:08:53', 1),
( 'Gendarmerie', 13, '2021-11-17 04:08:53', '2021-11-17 04:08:53', 1),
( 'Gestion du Stress', 14, '2021-11-17 04:09:04', '2021-11-17 04:09:04', 1),
( 'PNL', 14, '2021-11-17 04:09:04', '2021-11-17 04:09:04', 1),
( 'Prise de Parole', 14, '2021-11-17 04:09:04', '2021-11-17 04:09:04', 1),
( 'Webdesign', 15, NULL, NULL, 1),
( 'Community Management', 15, NULL, NULL, 1),
( 'SEO', 15, NULL, NULL, 1),
( 'SEA', 15, NULL, NULL, 1),
( 'Formateur', 16, NULL, NULL, 1),
( 'Coach Sportif', 16, NULL, NULL, 1),
( 'Coach de Vie', 16, NULL, NULL, 1),
( 'Prothésiste Ongulaire', 17, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),
( 'Maquillage', 17, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),
( 'Manucure', 17, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),
( 'Politique', 18, '2021-11-17 04:00:27', '2021-11-17 04:00:27', 1),
( 'RGPD', 18, '2021-11-17 04:00:27', '2021-11-17 04:00:27', 1),
( 'Juridique', 18, '2021-11-17 04:00:27', '2021-11-17 04:00:27', 1),
( 'Pâtisserie', 19, '2021-11-17 04:00:41', '2021-11-17 04:00:41', 1),
( 'Barman', 19, '2021-11-17 04:00:41', '2021-11-17 04:00:41', 1),
( 'Diététique', 19, '2021-11-17 04:00:41', '2021-11-17 04:00:41', 1),
( 'Boulanger', 19, '2021-11-17 04:00:41', '2021-11-17 04:00:41', 1),
( 'Agent Immobilier', 20, '2021-11-17 04:06:54', '2021-11-17 04:06:54', 1),
( 'Gestion Locative', 20, '2021-11-17 04:06:54', '2021-11-17 04:06:54', 1),
( 'Mécanique', 21, '2021-11-17 04:07:18', '2021-11-17 04:07:18', 1),
( 'Soudure', 21, '2021-11-17 04:07:18', '2021-11-17 04:07:18', 1),
( 'Agroalimentaire', 21, '2021-11-17 04:07:18', '2021-11-17 04:07:18', 1),
( 'Electronique', 21, '2021-11-17 04:07:18', '2021-11-17 04:07:18', 1),
( 'Développeur Web', 22, '2021-11-17 04:07:28', '2021-11-17 04:07:28', 1),
( 'Data', 22, '2021-11-17 04:07:28', '2021-11-17 04:07:28', 1),
( 'Cybersécurité', 22, '2021-11-17 04:07:28', '2021-11-17 04:07:28', 1),
( 'Anglais', 23, '2021-11-17 04:07:45', '2021-11-17 04:07:45', 1),
( 'Français', 23, '2021-11-17 04:07:45', '2021-11-17 04:07:45', 1),
( 'Langue des Signes', 23, '2021-11-17 04:07:45', '2021-11-17 04:07:45', 1),
( 'Gestion d''entreprise', 24, '2021-11-17 04:07:55', '2021-11-17 04:07:55', 1),
( 'Entrepreneuriat', 24, '2021-11-17 04:07:55', '2021-11-17 04:07:55', 1),
( 'Puériculture', 25, '2021-11-17 04:08:21', '2021-11-17 04:08:21', 1),
( 'Jeunes Enfants', 25, '2021-11-17 04:08:21', '2021-11-17 04:08:21', 1),
( 'Crèche', 25, '2021-11-17 04:08:21', '2021-11-17 04:08:21', 1),

( 'QHSE', 26, '2021-11-17 04:08:31', '2021-11-17 04:08:31', 1),
( 'Nettoyage', 26, '2021-11-17 04:08:31', '2021-11-17 04:08:31', 1),
( 'Fibre Optique', 27, '2021-11-17 04:08:53', '2021-11-17 04:08:53', 1),
( 'Télécommunication', 27, '2021-11-17 04:08:53', '2021-11-17 04:08:53', 1),
( 'Gestion des Ressources Humaines', 28, '2021-11-17 04:09:04', '2021-11-17 04:09:04', 1),
( ' CSE', 28, '2021-11-17 04:09:04', '2021-11-17 04:09:04', 1),
( 'Médecine', 29, NULL, NULL, 1),
( ' Soignants', 29, NULL, NULL, 1),
( 'Spécialistes', 29, NULL, NULL, 1),
( 'Chimie', 30, NULL, NULL, 1),
( 'Biologie', 30, NULL, NULL, 1),
( 'Mathématiques', 30, NULL, NULL, 1),
( 'Administration', 31, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),
( 'Secrétariat Médical', 31, '2021-11-17 04:00:01', '2021-11-17 04:00:01', 1),
( 'Auxiliaire de Vie', 32, '2021-11-17 04:00:27', '2021-11-17 04:00:27', 1),
( 'Educateur', 32, '2021-11-17 04:00:27', '2021-11-17 04:00:27', 1),
( 'Animation', 33, '2021-11-17 04:00:41', '2021-11-17 04:00:41', 1),
( 'Hôtesse de l''Air', 33, '2021-11-17 04:00:41', '2021-11-17 04:00:41', 1),
( 'Steward', 33, '2021-11-17 04:00:41', '2021-11-17 04:00:41', 1),
( 'Sport', 33, '2021-11-17 04:00:41', '2021-11-17 04:00:41', 1),
( 'Caces', 34, '2021-11-17 04:06:54', '2021-11-17 04:06:54', 1),
( 'Permis B', 34, '2021-11-17 04:06:54', '2021-11-17 04:06:54', 1),
( 'Chauffeur de Bus', 34, '2021-11-17 04:06:54', '2021-11-17 04:06:54', 1),
( 'VTC', 34, '2021-11-17 04:06:54', '2021-11-17 04:06:54', 1);


CREATE TABLE modules_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  reference varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  nom_module varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  formation_id bigint(20) UNSIGNED NOT NULL REFERENCES formations(id) ON DELETE CASCADE,
  etp_id bigint(20) NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp(),
  duree int(11) NOT NULL,
  duree_jour int(11) NOT NULL,
  prerequis TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  objectif TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  modalite_formation varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  description TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  niveau_id bigint(20) NOT NULL REFERENCES niveaux(id) ON DELETE CASCADE,
  materiel_necessaire varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  cible varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  min int(11) NOT NULL,
  max int(11) NOT NULL,
  bon_a_savoir TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  prestation TEXT COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

alter table modules_interne add status int(11) default 0;
alter table modules_interne add etat_id bigint(20) NOT NULL DEFAULT 1 REFERENCES etats(id) ON DELETE CASCADE;

CREATE TABLE programmes_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  titre varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  module_id bigint(20) UNSIGNED NOT NULL REFERENCES modules(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE cours_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  titre_cours varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  programme_id bigint(20) UNSIGNED NOT NULL REFERENCES programmes(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `competence_a_evaluers_interne` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `titre_competence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL REFERENCES modules(id) ON DELETE CASCADE,
  `objectif` int(10) UNSIGNED not null DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `niveaux_interne` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `niveau` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `progression` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT  current_timestamp(),
  `updated_at` timestamp NULL DEFAULT  current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `niveaux_interne` (`id`,`niveau`,`progression`, `created_at`, `updated_at`) VALUES
(1,'Débutant',1,NOW(),NOW()),
(2,'intermédiaire',3,NOW(),NOW()),
(3,'avancé',4,NOW(),NOW()),
(4,'avancé',5,NOW(),NOW());

CREATE TABLE avis_interne(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    stagiaire_id bigint(20) UNSIGNED NOT NULL REFERENCES stagiaires(id) ON DELETE CASCADE,
    module_id bigint(20) UNSIGNED NOT NULL REFERENCES modules_interne(id) ON DELETE CASCADE,
    note decimal(5,2) not null default 0,
    commentaire text,
    status varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    date_avis date NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
);