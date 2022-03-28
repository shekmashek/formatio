CREATE TABLE secteurs (
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nom_secteur varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
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
  nom_etp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  adresse_rue varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_quartier varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_code_postal varchar(3) COLLATE utf8mb4_unicode_ci  default 'XXX',
  adresse_ville varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_region varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  logo varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  url_logo VARCHAR(155),
  nif varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  stat varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  rcs varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  cif varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  secteur_id bigint(20) UNSIGNED NOT NULL  REFERENCES secteurs(id),
  email_etp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  site_etp varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  activiter boolean not null default true,
  telephone_etp varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE departement_entreprises (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_departement  varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE services (
  id bigint(20) UNSIGNED NOT NULL  PRIMARY KEY AUTO_INCREMENT,
  departement_entreprise_id bigint(20) unsigned not null,
  nom_service varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  foreign key(departement_entreprise_id) references departement_entreprises (id) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE branches (
  id bigint(20) UNSIGNED NOT NULL  PRIMARY KEY AUTO_INCREMENT,
  entreprise_id bigint(20) unsigned not null,
  nom_branche varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  foreign key(entreprise_id) references entreprises (id) on delete cascade
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE abonnements (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  date_demande date DEFAULT '0000-0000-00',
  date_debut date DEFAULT current_timestamp(),
  date_fin date DEFAULT current_timestamp(),
  mode_financement_id bigint(20) UNSIGNED NOT NULL  REFERENCES mode_financements(id) ON DELETE CASCADE,
  status varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  type_abonnement_role_id bigint(20) UNSIGNED NOT NULL  REFERENCES type_abonnement_roles(id) ON DELETE CASCADE,
  entreprise_id bigint(20) UNSIGNED NOT NULL  REFERENCES entreprises(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  categorie_paiement_id bigint(20) NOT NULL  REFERENCES categorie_paiements(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE employers (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  matricule_emp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  nom_emp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  prenom varchar(255) COLLATE utf8mb4_unicode_ci,
  sexe_emp varchar(255) COLLATE utf8mb4_unicode_ci,
  date_naissance_emp date DEFAULT current_timestamp(),
  cin_emp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL UNIQUE,
  email_emp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  telephone_emp varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  fonction_emp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  poste_emp varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  service_id bigint(20) UNSIGNED,
  branche_id bigint(20) UNSIGNED ,
  genre_id bigint(20) unsigned default 1 REFERENCES genre(id),
  departement_entreprises_id bigint(20) UNSIGNED,
  adresse_quartier varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_code_postal varchar(3) COLLATE utf8mb4_unicode_ci  default 'XXX',
  adresse_lot varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_ville varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_region varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  user_id bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE,
  photos varchar(255) COLLATE utf8mb4_unicode_ci,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  niveau_etude varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  activiter boolean not null default true,
  prioriter boolean not null default false,
  url_photo VARCHAR(155),
  created_at timestamp  DEFAULT current_timestamp(),
  updated_at timestamp  DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE historique_stagiaires (
  id bigint(20) UNSIGNED NOT NULL  PRIMARY KEY AUTO_INCREMENT,
  stagiaire_id bigint(20) unsigned not null references employers(id) on delete cascade,
  ancien_entreprise_id bigint(20) unsigned not null references entreprises(id) on delete cascade,
  ancien_departement_id bigint(20) unsigned not null references departement_entreprises(id) on delete cascade,
  nouveau_entreprise_id bigint(20) unsigned not null,
  nouveau_departement_id bigint(20) unsigned not null,
  ancien_matricule varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  nouveau_matricule varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  date_depart varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  date_arrivee varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  particulier boolean not null default true
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE chef_dep_entreprises (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  departement_entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES departement_entreprises(id) ON DELETE CASCADE,
  chef_departement_id bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

