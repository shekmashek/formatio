CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_departement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `departements` (`nom_departement`) VALUES
('Achat'),
('Administration,comptabilité et finance'),
('IT et Télécommunications '),
('Ingénierie et Technique'),
('Management et Direction'),
('Marketing, Publicité et Evénement'),
('Production'),
('Recherche et développement'),
('Ressources humaines'),
('Secrétariat et Support Administratif'),
('Service légal'),
('Transport et Logistique'),
('Vente');

CREATE TABLE `secteurs` (
     `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `nom_secteur` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `secteurs` (`nom_secteur`) VALUES
('BTP & Ressources stratégiques(BTP/DS)'),
('Développement Rural(DR)'),
('Technologies de l\'Information&Communication(TIC)'),
('Textile,Habillements&Accessoires(THA)'),
('Tourisme,Hôtellerie&Restauration(THR)'),
('Multi Sectoriel'),
('Formation équité MPE');

CREATE TABLE `entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_etp` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rcs` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cif` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secteur_id` bigint(20) UNSIGNED NOT NULL  REFERENCES secteurs(id),
  `email_etp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_etp` varchar(191) COLLATE utf8mb4_unicode_ci,
  `activiter` boolean not null default true,
  `telephone_etp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
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


CREATE TABLE `departement_entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `departement_id` bigint(20) UNSIGNED NOT NULL REFERENCES departements(id) ON DELETE CASCADE,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `chef_departements` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_chef` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_chef` varchar(255) COLLATE utf8mb4_unicode_ci,
  `genre_chef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fonction_chef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_chef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_chef` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cin_chef` varchar(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `user_id` bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activiter` boolean not null default true,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `chef_dep_entreprises` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `departement_entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES departement_entreprises(id) ON DELETE CASCADE,
  `chef_departement_id` bigint(20) UNSIGNED NOT NULL REFERENCES chef_departements(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `responsables` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_resp` varchar(255) COLLATE utf8mb4_unicode_ci,
  `fonction_resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cin_resp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_resp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `activiter` boolean not null default true,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `stagiaires` (
  `id` bigint(20) UNSIGNED NOT NULL  PRIMARY KEY AUTO_INCREMENT,
  `matricule` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci,
  `genre_stagiaire` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fonction_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail_stagiaire` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone_stagiaire` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `entreprise_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `user_id` bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL REFERENCES departements(id) ON DELETE CASCADE,
  `cin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lieu_travail` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `niveau_etude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activiter` boolean not null default true
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
