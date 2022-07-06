-- Active: 1656400043423@@127.0.0.1@3306@bdd_nicole


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

INSERT INTO `secteurs` (`nom_secteur`) VALUES ('Autres');

CREATE TABLE `type_entreprise` (
    `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `type_entreprise` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `type_entreprise` (`type_entreprise`) VALUES
('entreprise'),
('of');

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
  telephone_etp varchar(191) COLLATE utf8mb4_unicode_ci,
  url_logo varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `entreprises` CHANGE `secteur_id` `secteur_id` BIGINT(20) UNSIGNED NOT NULL DEFAULT '8';



ALTER TABLE entreprises
    ADD slogan varchar(255) COLLATE utf8mb4_unicode_ci default null,
    ADD presentation text COLLATE utf8mb4_unicode_ci default NULL,
    ADD specialisation text COLLATE utf8mb4_unicode_ci default NULL,
    ADD type_entreprise_id bigint(20) UNSIGNED default 1  REFERENCES type_entreprise(id);

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
alter TABLE services add COLUMN `entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE;

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL  PRIMARY KEY AUTO_INCREMENT,
  entreprise_id bigint(20) unsigned not null,
  `nom_branche` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  foreign key(entreprise_id) references entreprises (id) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE employers (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  matricule_emp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  nom_emp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  prenom_emp varchar(255) COLLATE utf8mb4_unicode_ci,
  date_naissance_emp date DEFAULT current_timestamp(),
  cin_emp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  email_emp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  telephone_emp varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  fonction_emp varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  service_id bigint(20) UNSIGNED,
  branche_id bigint(20) UNSIGNED,
  genre_id bigint(20) unsigned DEFAULT 1  REFERENCES genre(id),
  departement_entreprises_id bigint(20) UNSIGNED,
  adresse_quartier varchar(255) COLLATE utf8mb4_unicode_ci  default NULL,
  adresse_code_postal varchar(30) COLLATE utf8mb4_unicode_ci  default NULL,
  adresse_lot varchar(255) COLLATE utf8mb4_unicode_ci  default NULL,
  adresse_ville varchar(255) COLLATE utf8mb4_unicode_ci  default NULL,
  adresse_region varchar(255) COLLATE utf8mb4_unicode_ci  default NULL,
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

CREATE TABLE `chef_dep_entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `departement_entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES departement_entreprises(id) ON DELETE CASCADE,
  `chef_departement_id` bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  `created_at` timestamp default current_timestamp(),
  `updated_at` timestamp default current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `chef_de_service_entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `service_id` bigint(20) UNSIGNED NOT NULL REFERENCES services(id) ON DELETE CASCADE,
  `chef_de_service_id` bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  `created_at` timestamp default current_timestamp(),
  `updated_at` timestamp default current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `historique_stagiaires` (
  `id` bigint(20) UNSIGNED NOT NULL  PRIMARY KEY AUTO_INCREMENT,
  stagiaire_id bigint(20) unsigned not null references employers(id) on delete cascade,
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




