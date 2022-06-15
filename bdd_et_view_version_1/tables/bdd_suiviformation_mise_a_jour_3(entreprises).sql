

CREATE TABLE `secteurs` (
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `nom_secteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `secteurs` (`nom_secteur`) VALUES
('BTP & Ressources stratégiques(BTP/DS)'),
('Développement Rural(DR)'),
("Technologies de l\'Information&Communication(TIC)"),
('Textile,Habillements&Accessoires(THA)'),
('Tourisme,Hôtellerie&Restauration(THR)'),
('Multi Sectoriel'),
('Formation équité MPE');

CREATE TABLE entreprises (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_etp varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  adresse_rue varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_quartier varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_code_postal varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_ville varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_region varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  logo varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp(),
  nif varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  stat varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  rcs varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  cif varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  secteur_id bigint(20) UNSIGNED NOT NULL  REFERENCES secteurs(id),
  email_etp varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  site_etp varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  activiter boolean not null default true,
  telephone_etp varchar(191) COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `departement_entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_departement`  varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL  PRIMARY KEY AUTO_INCREMENT,
  departement_entreprise_id bigint(20) unsigned not null,
  `nom_service` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  foreign key(departement_entreprise_id) references departement_entreprises (id) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL  PRIMARY KEY AUTO_INCREMENT,
  entreprise_id bigint(20) unsigned not null,
  `nom_branche` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  foreign key(entreprise_id) references entreprises (id) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE chef_departements (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  matricule varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  nom_chef varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  prenom_chef varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
 genre_id bigint(20) unsigned DEFAULT 1 REFERENCES genre(id),
   fonction_chef varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'XXXXX',
  mail_chef varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'XXXXX',
  telephone_chef varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'XXXXX',
  cin_chef varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  user_id bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE,
  photos varchar(255) COLLATE utf8mb4_unicode_ci,
  activiter boolean not null default true,
  created_at timestamp  DEFAULT current_timestamp(),
  updated_at timestamp  DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `chef_dep_entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `departement_entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES departement_entreprises(id) ON DELETE CASCADE,
  `chef_departement_id` bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  `created_at` timestamp default current_timestamp(),
  `updated_at` timestamp default current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE responsables (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  matricule varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  nom_resp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  prenom_resp varchar(255) COLLATE utf8mb4_unicode_ci,
 date_naissance_resp date default current_timestamp(),
  cin_resp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  email_resp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  telephone_resp varchar(255) COLLATE utf8mb4_unicode_ci,
  fonction_resp varchar(255) COLLATE utf8mb4_unicode_ci,
  poste_resp varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  departement_entreprises_id bigint(20) UNSIGNED,
  service_id bigint(20) UNSIGNED,
  branche_id bigint(20) UNSIGNED,
  genre_id bigint(20) unsigned DEFAULT 1 REFERENCES genre(id),
  adresse_quartier varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_code_postal varchar(3) COLLATE utf8mb4_unicode_ci  default 'XXX',
  adresse_lot varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_ville varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_region varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  user_id bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE,
  photos varchar(255) COLLATE utf8mb4_unicode_ci,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  activiter boolean not null default true,
  prioriter boolean not null default false,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE stagiaires (
   id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  matricule varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  nom_stagiaire varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  prenom_stagiaire varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  genre_stagiaire varchar(100) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  titre varchar(225) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  fonction_stagiaire varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  mail_stagiaire varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  telephone_stagiaire varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  entreprise_id bigint(20) UNSIGNED NOT NULL references entreprises(id) on delete cascade,
  user_id bigint(20) UNSIGNED NOT NULL,
  photos varchar(255) COLLATE utf8mb4_unicode_ci,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp(),
  service_id bigint(20) UNSIGNED  not null references services(id) on delete cascade,
  cin varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  date_naissance varchar(255) COLLATE utf8mb4_unicode_ci default current_timestamp(),
  niveau_etude varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  activiter tinyint(1) NOT NULL DEFAULT '1',
  branche_id bigint(20) UNSIGNED ,
  quartier varchar(225) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  code_postal varchar(225) COLLATE utf8mb4_unicode_ci  default 'XXX',
  ville varchar(225) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  region varchar(225) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  lot varchar(225) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE `historique_stagiaires` (
  `id` bigint(20) UNSIGNED NOT NULL  PRIMARY KEY AUTO_INCREMENT,
  stagiaire_id bigint(20) unsigned not null references stagiaires(id) on delete cascade,
  ancien_entreprise_id bigint(20) unsigned not null references entreprises(id) on delete cascade,
  ancien_departement_id bigint(20) unsigned not null references departement_entreprises(id) on delete cascade,
  nouveau_entreprise_id bigint(20) unsigned not null,
  nouveau_departement_id bigint(20) unsigned not null,
  `ancien_matricule` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
   `nouveau_matricule` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_depart` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_arrivee` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `particulier` boolean not null default true
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE employers (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  matricule_emp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  nom_emp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  prenom_emp varchar(255) COLLATE utf8mb4_unicode_ci,
  date_naissance_emp date DEFAULT current_timestamp(),
  cin_emp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  email_emp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  telephone_emp varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT 'XXXXXX',
  fonction_emp varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'XXXXXX',
  poste_emp varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  service_id bigint(20) UNSIGNED,
  branche_id bigint(20) UNSIGNED ,
  genre_id bigint(20) unsigned DEFAULT 1  REFERENCES genre(id),
  departement_entreprises_id bigint(20) UNSIGNED,
  adresse_quartier varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_code_postal varchar(30) COLLATE utf8mb4_unicode_ci  default 'XXX',
  adresse_lot varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_ville varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_region varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  user_id bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE,
  photos varchar(255) COLLATE utf8mb4_unicode_ci,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
 niveau_etude_id bigint(20) UNSIGNED NOT NULL DEFAULT 1 REFERENCES niveau_etude(id) ON DELETE CASCADE,
  activiter boolean not null default true,
  prioriter boolean not null default false,
  url_photo VARCHAR(155),
  created_at timestamp  DEFAULT current_timestamp(),
  updated_at timestamp  DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



