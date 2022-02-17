

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
  adresse_rue varchar(191) COLLATE utf8mb4_unicode_ci,
  adresse_quartier varchar(191) COLLATE utf8mb4_unicode_ci,
  adresse_code_postal varchar(191) COLLATE utf8mb4_unicode_ci,
  adresse_ville varchar(191) COLLATE utf8mb4_unicode_ci,
  adresse_region varchar(191) COLLATE utf8mb4_unicode_ci,
  logo varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  nif varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  stat varchar(255) COLLATE utf8mb4_unicode_ci,
  rcs varchar(255) COLLATE utf8mb4_unicode_ci,
  cif varchar(255) COLLATE utf8mb4_unicode_ci,
  secteur_id bigint(20) UNSIGNED NOT NULL  REFERENCES secteurs(id),
  email_etp varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  site_etp varchar(191) COLLATE utf8mb4_unicode_ci,
  activiter boolean not null default true,
  telephone_etp varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `departement_entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_departement`  varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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

CREATE TABLE `abonnements` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date_demande` date NOT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `mode_financement_id` bigint(20) UNSIGNED NOT NULL  REFERENCES mode_financements(id) ON DELETE CASCADE,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_abonnement_role_id` bigint(20) UNSIGNED NOT NULL  REFERENCES type_abonnement_roles(id) ON DELETE CASCADE,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL  REFERENCES entreprises(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `categorie_paiement_id` bigint(20) NOT NULL  REFERENCES categorie_paiements(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE chef_departements (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_chef varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  prenom_chef varchar(255) COLLATE utf8mb4_unicode_ci,
  genre_chef varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  fonction_chef varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  mail_chef varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  telephone_chef varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  cin_chef varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  user_id bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE,
  photos varchar(255) COLLATE utf8mb4_unicode_ci,
  activiter boolean not null default true,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `chef_dep_entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `departement_entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES departement_entreprises(id) ON DELETE CASCADE,
  `chef_departement_id` bigint(20) UNSIGNED NOT NULL REFERENCES chef_departements(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE responsables (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_resp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  prenom_resp varchar(255) COLLATE utf8mb4_unicode_ci,
  sexe_resp varchar(255) COLLATE utf8mb4_unicode_ci,
  date_naissance_resp date,
  cin_resp varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  email_resp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  telephone_resp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  fonction_resp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  poste_resp varchar(255) COLLATE utf8mb4_unicode_ci,
  departement_entreprises_id bigint(20) UNSIGNED,
  service_id bigint(20) UNSIGNED,
  branche_id bigint(20) UNSIGNED,
  adresse_quartier varchar(191) COLLATE utf8mb4_unicode_ci,
  adresse_code_postal varchar(3) COLLATE utf8mb4_unicode_ci,
  adresse_lot varchar(191) COLLATE utf8mb4_unicode_ci,
  adresse_ville varchar(191) COLLATE utf8mb4_unicode_ci ,
  adresse_region varchar(191) COLLATE utf8mb4_unicode_ci,
  user_id bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE,
  photos varchar(255) COLLATE utf8mb4_unicode_ci,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  activiter boolean not null default true,
  prioriter boolean not null default false,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE stagiaires (
   id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  matricule varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  nom_stagiaire varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  prenom_stagiaire varchar(255) COLLATE utf8mb4_unicode_ci,
  genre_stagiaire varchar(100) COLLATE utf8mb4_unicode_ci,
  titre varchar(225) COLLATE utf8mb4_unicode_ci,
  fonction_stagiaire varchar(255) COLLATE utf8mb4_unicode_ci,
  mail_stagiaire varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  telephone_stagiaire varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  entreprise_id bigint(20) UNSIGNED NOT NULL references entreprises(id) on delete cascade,
  user_id bigint(20) UNSIGNED NOT NULL,
  photos varchar(255) COLLATE utf8mb4_unicode_ci,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  service_id bigint(20) UNSIGNED  not null references services(id) on delete cascade,
  cin varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  date_naissance varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  niveau_etude varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  activiter tinyint(1) NOT NULL DEFAULT '1',
  branche_id bigint(20) UNSIGNED ,
  quartier varchar(225) COLLATE utf8mb4_unicode_ci,
  code_postal varchar(225) COLLATE utf8mb4_unicode_ci,
  ville varchar(225) COLLATE utf8mb4_unicode_ci,
  region varchar(225) COLLATE utf8mb4_unicode_ci,
  lot varchar(225) COLLATE utf8mb4_unicode_ci
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



