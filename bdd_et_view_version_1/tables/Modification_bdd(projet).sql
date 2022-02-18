create table type_formations(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  type_formation varchar(250) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `type_formations` (`type_formation`) VALUES ('Intra entreprise'),('Inter entreprise');

CREATE TABLE projets (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_projet varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  cfp_id bigint(20) UNSIGNED NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
  type_formation_id bigint(20) UNSIGNED NOT NULL REFERENCES type_formations(id) ON DELETE CASCADE,
  status varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  activiter boolean not null default true,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE groupes (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  max_participant varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  min_participant varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  nom_groupe varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  projet_id  bigint(20) UNSIGNED  NOT NULL REFERENCES projets(id) ON DELETE CASCADE,
  module_id  bigint(20) UNSIGNED  NOT NULL REFERENCES modules(id) ON DELETE CASCADE,
  type_payement_id  bigint(20) UNSIGNED  NOT NULL REFERENCES type_payement(id) ON DELETE CASCADE,
  date_debut date NOT NULL,
  date_fin date NOT NULL,
  status varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  activiter boolean not null default true,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE groupe_entreprises (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  groupe_id  bigint(20) UNSIGNED  NOT NULL REFERENCES groupes(id) ON DELETE CASCADE,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create table status(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  status varchar(100) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into status('Prévisionnel');
insert into status('A venir');
insert into status('En cours');
insert into status('Terminé');