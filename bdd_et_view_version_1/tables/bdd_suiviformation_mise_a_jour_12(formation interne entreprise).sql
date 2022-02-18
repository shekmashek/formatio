
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

