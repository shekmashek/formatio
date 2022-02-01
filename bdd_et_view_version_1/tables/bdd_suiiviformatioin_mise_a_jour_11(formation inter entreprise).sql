CREATE TABLE projets_inter (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_projet varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  cfp_id bigint(20) UNSIGNED NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
  status varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  activiter boolean not null default true,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE entreprises_inter_projets (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  projet_id bigint(20) UNSIGNED NOT NULL REFERENCES projets_inter(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE groupes_inter (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  max_participant varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  min_participant varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  nom_groupe varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  projet_inter_id  bigint(20) UNSIGNED  NOT NULL REFERENCES projets_inter(id) ON DELETE CASCADE,
  module_id  bigint(20) UNSIGNED  NOT NULL REFERENCES modules(id) ON DELETE CASCADE,
  date_debut date NOT NULL,
  date_fin date NOT NULL,
  status varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  activiter boolean not null default true,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE participant_groupe_inter (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  stagiaire_id bigint(20) UNSIGNED NOT NULL REFERENCES stagiaires(id) ON DELETE CASCADE,
  groupe_inter_id bigint(20) UNSIGNED NOT NULL REFERENCES groupes_inter(id) ON DELETE CASCADE,
   entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  created_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  updated_at timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE details_inter (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  lieu varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  h_debut varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  h_fin varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  date_detail date NOT NULL,
  formateur_id bigint(20) UNSIGNED NOT NULL REFERENCES formateurs(id) ON DELETE CASCADE,
  groupe_inter_id bigint(20) UNSIGNED NOT NULL REFERENCES groupes_inter(id) ON DELETE CASCADE,
  projet_inter_id bigint(20) UNSIGNED NOT NULL REFERENCES projets_inter(id) ON DELETE CASCADE,
  cfp_id bigint(20) UNSIGNED NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE presences_inter (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  status varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  detail_inter_id bigint(20) UNSIGNED NOT NULL REFERENCES details_inter(id) ON DELETE CASCADE,
  stagiaire_id bigint(20) UNSIGNED NOT NULL REFERENCES stagiaires(id) ON DELETE CASCADE,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

