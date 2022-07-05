DROP TABLE IF EXISTS formateurs_interne;
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

DROP TABLE IF EXISTS projets_interne;
CREATE TABLE projets_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_projet varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  status varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  activiter boolean not null default true,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
DROP TABLE IF EXISTS groupes_interne;
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

DROP TABLE IF EXISTS participant_groupe_interne;
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


DROP TABLE IF EXISTS modules_interne;
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
  modalite_formation TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  description TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  niveau_id bigint(20) NOT NULL REFERENCES niveaux(id) ON DELETE CASCADE,
  materiel_necessaire TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  cible TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  min int(11) NOT NULL,
  max int(11) NOT NULL,
  bon_a_savoir TEXT COLLATE utf8mb4_unicode_ci NOT NULL,
  prestation TEXT COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

alter table modules_interne add status int(11) default 2;
alter table modules_interne add etat_id bigint(20) NOT NULL DEFAULT 1 REFERENCES etats(id) ON DELETE CASCADE;

DROP TABLE IF EXISTS programmes_interne;
CREATE TABLE programmes_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  titre varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  module_id bigint(20) UNSIGNED NOT NULL REFERENCES modules(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS cours_interne;
CREATE TABLE cours_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  titre_cours varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  programme_id bigint(20) UNSIGNED NOT NULL REFERENCES programmes(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS competence_a_evaluers_interne;
CREATE TABLE `competence_a_evaluers_interne` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `titre_competence` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_id` bigint(20) UNSIGNED NOT NULL REFERENCES modules(id) ON DELETE CASCADE,
  `objectif` int(10) UNSIGNED not null DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
DROP TABLE IF EXISTS avis_interne;
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