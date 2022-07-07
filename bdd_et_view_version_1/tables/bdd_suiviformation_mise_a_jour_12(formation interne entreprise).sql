insert into type_formations(type_formation) values ('Interne');

insert into roles(id,role_name,role_description) values(8,'formateur_interne','Formateur interne');

alter table employers add column formateur_interne int(2) default 0;

drop table if exists projets_interne;
CREATE TABLE projets_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_projet varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  activiter int(2) not null default 0,
  date_creation timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

alter table projets_interne add column type_formation_id bigint(20) UNSIGNED NOT NULL REFERENCES type_formations(id) ON DELETE CASCADE;
alter table projets_interne add column status varchar(100);

drop table if exists groupes_interne;
CREATE TABLE groupes_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_groupe varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  projet_interne_id  bigint(20) UNSIGNED  NOT NULL REFERENCES projets_interne(id) ON DELETE CASCADE,
  module_interne_id bigint(20) UNSIGNED not null references modules_interne(id) ON DELETE CASCADE,
  date_debut date NOT NULL,
  date_fin date NOT NULL,
  status varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  salle_formation text,
  activiter boolean not null default true
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

alter table groupes_interne add column modalite varchar(100);

CREATE TABLE participant_groupe_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  stagiaire_id bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  groupe_interne_id bigint(20) UNSIGNED NOT NULL REFERENCES groupes_interne(id) ON DELETE CASCADE,
  status int(10) default 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

drop table if exists details_interne;
CREATE TABLE details_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  lieu varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  h_debut varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  h_fin varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  date_detail date NOT NULL,
  formateur_interne_id bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  groupe_interne_id bigint(20) UNSIGNED NOT NULL REFERENCES groupes_interne(id) ON DELETE CASCADE,
  projet_interne_id bigint(20) UNSIGNED NOT NULL REFERENCES projets_interne(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table ressources_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  description TEXT NOT NULL,
  pris_en_charge VARCHAR(255) NOT NULL,
  note text
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

alter table ressources_interne add column groupe_id bigint(20) UNSIGNED NOT NULL REFERENCES ressources_interne(id) ON DELETE CASCADE;

CREATE TABLE presences_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  status varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  detail_interne_id bigint(20) UNSIGNED NOT NULL REFERENCES details_interne(id) ON DELETE CASCADE,
  stagiaire_id bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  h_entree time default null,
  h_sortie time default null,
  note text default null
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table reponse_evaluationchaud_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  reponse_desc_champ text,
  id_desc_champ bigint(20) UNSIGNED NOT NULL REFERENCES descr_champs(id) ON DELETE CASCADE,
  stagiaire_id bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  groupe_interne_id bigint(20) UNSIGNED NOT NULL REFERENCES groupes_interne(id) ON DELETE CASCADE,
  points int(11) default 0,
  statut int(2)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table evaluation_stagiaire_interne(
  id bigint(20) unsigned primary key not null auto_increment,
  groupe_interne_id bigint(20) unsigned not null references groupes_interne(id)  ON DELETE CASCADE,
  competence_a_evaluers_interne_id bigint(20) unsigned not null references competence_a_evaluers_interne(id)  ON DELETE CASCADE,
  stagiaire_id bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  note_avant int(10) default 0,
  note_apres int(10) default 0,
  status int(10) default 0
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS modules_interne;
CREATE TABLE modules_interne (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  reference varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  nom_module varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  formation_id bigint(20) UNSIGNED NOT NULL REFERENCES formations(id) ON DELETE CASCADE,
  etp_id bigint(20) NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
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


create table salle_formation_etp(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  etp_id bigint(20) UNSIGNED NOT NULL REFERENCES etp(id) ON DELETE CASCADE,
  salle_formation text NOT NULL,
  ville text
);

insert into salle_formation_etp(etp_id, salle_formation,ville) values(1, 'Salle 4','Tana');

create table frais_annexe_etp(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  description text NOT NULL,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprise(id) ON DELETE CASCADE
);

