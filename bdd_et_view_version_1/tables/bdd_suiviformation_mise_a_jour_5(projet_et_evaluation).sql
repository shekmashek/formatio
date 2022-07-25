create table type_formations(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  type_formation varchar(250) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `type_formations` (`type_formation`) VALUES ('Intra'),('Inter');

CREATE TABLE projets (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_projet varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  cfp_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  type_formation_id bigint(20) UNSIGNED NOT NULL REFERENCES type_formations(id) ON DELETE CASCADE,
  status varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  activiter boolean not null default true,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp()
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
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE groupes ADD COLUMN modalite VARCHAR(200);

CREATE TABLE groupe_entreprises (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  groupe_id  bigint(20) UNSIGNED  NOT NULL REFERENCES groupes(id) ON DELETE CASCADE,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `participant_groupe` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
  `groupe_id` bigint(20) UNSIGNED NOT NULL REFERENCES groupes(id) ON DELETE CASCADE,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
alter table participant_groupe add column status int(10) default 0;


CREATE TABLE `details` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `lieu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `h_debut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `h_fin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_detail` date NOT NULL,
  `formateur_id` bigint(20) UNSIGNED NOT NULL REFERENCES formateurs(id) ON DELETE CASCADE,
  `groupe_id` bigint(20) UNSIGNED NOT NULL REFERENCES groupes(id) ON DELETE CASCADE,
  `projet_id` bigint(20) UNSIGNED NOT NULL REFERENCES projets(id) ON DELETE CASCADE,
  `cfp_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `cour_dans_detail` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cours_id` bigint(20) UNSIGNED NOT NULL REFERENCES cours(id) ON DELETE CASCADE,
  `programme_id` bigint(20) UNSIGNED NOT NULL REFERENCES programmes(id) ON DELETE CASCADE,
  `detail_id` bigint(20) UNSIGNED NOT NULL REFERENCES details(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `presences` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `status` int(2)  NOT NULL,
   `h_entree` time,
   `h_sortie` time,
   `note` text,
  `detail_id` bigint(20) UNSIGNED NOT NULL REFERENCES details(id) ON DELETE CASCADE,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL REFERENCES stagiaires(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `froid_evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `cours_id` bigint(20) UNSIGNED NOT NULL REFERENCES cours(id) ON DELETE CASCADE,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projet_id` bigint(20) UNSIGNED NOT NULL REFERENCES projets(id) ON DELETE CASCADE,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL REFERENCES stagiaires(id) ON DELETE CASCADE,
  `cfp_id` bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


Drop table if exists type_champs;
CREATE TABLE `type_champs` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nom_champ` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_champ` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `type_champs` (`id`, `nom_champ`, `desc_champ`, `created_at`, `updated_at`) VALUES
(1, 'Champs type Nombre', 'NOMBRE', NULL, NULL),
(2, 'Champs type Case a Cocher', 'CASE', NULL, NULL),
(3, 'Champs type Text ou commentaire', 'TEXT', NULL, NULL);
(4, 'Champs type checkbox', 'CHECKBOX', NULL, NULL);

Drop table if exists question_mere;
CREATE TABLE `question_mere` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `qst_mere` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_reponse` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

Drop table if exists question_fille;
CREATE TABLE `question_fille` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `qst_fille` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type_champs` bigint(20) UNSIGNED NOT NULL REFERENCES type_champs(id) ON DELETE CASCADE,
  `id_qst_mere` bigint(20) UNSIGNED NOT NULL REFERENCES question_mere(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

alter table question_fille add column point_max int(10) default 0;



Drop table if exists description_champ_reponse;
CREATE TABLE `description_champ_reponse` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `descr_champs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_qst_fille` bigint(20) UNSIGNED NOT NULL REFERENCES question_fille(id) ON DELETE CASCADE,
  `nb_max` int(11),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE description_champ_reponse
add column point_champ int(5) default 0;

Drop table if exists reponse_evaluationchaud;
CREATE TABLE `reponse_evaluationchaud` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `reponse_desc_champ` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_desc_champ` bigint(20) UNSIGNED NOT NULL REFERENCES description_champ_reponse(id) ON DELETE CASCADE,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL REFERENCES stagiaires(id) ON DELETE CASCADE,
  `groupe_id` bigint(20) UNSIGNED NOT NULL REFERENCES groupes(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE reponse_evaluationchaud add column points int(11) default 0;
ALTER TABLE reponse_evaluationchaud add column statut int(2) NULL;


insert into question_mere values(1,'Qualité global de la formation','Donnez une note sur 10 pour votre évaluation globale de la formation:',null,null);
insert into question_mere values(2,'Qualité pédagoqique du formation','Donnez une note sur 10 pour votre évaluation globale de la qualité pédagogique de la formation:',null,null);
insert into question_mere values(3,'Préparation de la formation','Cochez une case par ligne',null,null);
insert into question_mere values(4,'Organisation de la formation','Cochez une case par ligne',null,null);
insert into question_mere values(5,'Déroulement de la formation','Cochez une case par ligne',null,null);
insert into question_mere values(6,'Le rythme de la formation était-il?','',null,null);
insert into question_mere values(7,'Contenu de la formation','Cochez une case par ligne',null,null);
insert into question_mere values(8,'Les objectifs du programme vont-ils atteints','Cochez une case par ligne',null,null);
insert into question_mere values(9,'Efficacité de la formation','Cochez une case par ligne',null,null);
insert into question_mere values(10,'Recommanderiez-vous cette formation?','',null,null);
insert into question_mere values(11,'Quels sont vos attentes pour cette formation?','Repondre au question',null,null);
insert into question_mere values(12,'Quels sont les points forts de cette formation','Repondre au question',null,null);
insert into question_mere values(13,'Quels sont les points faibles de cette formation','Repondre au question',null,null);
insert into question_mere values(14,'Autres remarques','Repondre au question',null,null);


insert into question_fille values (1,"Qualité Globale de la formation",1,1,null,null,0);

insert into question_fille values (2,'Qualité Globale de la formation',1,2,null,null,0);

insert into question_fille values (3,'Les objectifs de la formation ont-ils été clairement annoncés ?',2,3,null,null,5);
insert into question_fille values (4,'Avez-vous eu une discussion avec notre hiérarchie concernant cette formation ?',2,3,null,null,5);

insert into question_fille values (5,"Etes-vous satisfait de l'organisation du logistique et matériels utilisé (salle,ordinateur,vidéoprojecteur) ?",2,4,null,null,5);
insert into question_fille values (6,"La durée du stage vous a-telle semblé adaptée ?",2,4,null,null,5);

insert into question_fille values (7,"Le formateur étail-il clair et dynamique ?",2,5,null,null,5);
insert into question_fille values (8,"les exercices et activités étaient-ils pertinents ?",2,5,null,null,5);
insert into question_fille values (9,"Le formateur a-t-il adapté la formation aux stagiaires ?",2,5,null,null,5);
insert into question_fille values (23,"Est-ce-que le formateur maitrise le sujet ?",2,5,null,null,5);
insert into question_fille values (24,"Est-ce-que le formateur se montre disponible à les demandes d'explications ?",2,5,null,null,5);

insert into question_fille values (10,"Le rythme de la formation était-il?",2,6,null,null,5);

insert into question_fille values (11,"Le programme étail-il clair et précis ?",2,7,null,null,5);
insert into question_fille values (12,"Le programme étail-il adapté à vos besoins ?",2,7,null,null,5);
insert into question_fille values (13,"Les supports de la formation étaient-ils clairs et utiles ?",2,7,null,null,5);
insert into question_fille values (25,"Le support pédagogique était-il conforme à vos attentes ?",2,7,null,null,5);


insert into question_fille values (14,"Les objectifs du programme de formation sont-ils atteints ?",2,8,null,null,5);

insert into question_fille values (15,"Cette formation améliore-t-elle compétences ?",2,9,null,null,5);
insert into question_fille values (16,"Ces nouvelles compétences vont-elles etre applicables dans votre travail ?",2,9,null,null,5);

insert into question_fille values (17,"",2,10,null,null,2);
insert into question_fille values (18,"Vos commentaires: ",3,10,null,null,0);

insert into question_fille values (19,"",3,11,null,null,0);

insert into question_fille values (20,"",3,12,null,null,0);

insert into question_fille values (21,"",3,13,null,null,0);

insert into question_fille values (22,"",3,14,null,null,0);


insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Note sur 10',1,10,null,null,0);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Note sur 10',2,10,null,null,0);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',3,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',3,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',3,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',3,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',3,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',4,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',4,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',4,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',4,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',4,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',5,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',5,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',5,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',5,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',5,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',6,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',6,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',6,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',6,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',6,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',7,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',7,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',7,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',7,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',7,null,null,null,4);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',8,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',8,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',8,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',8,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',8,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',9,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',9,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',9,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',9,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',9,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',23,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',23,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',23,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',23,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',23,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',24,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',24,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',24,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',24,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',24,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',10,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',10,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',10,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',10,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',10,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',11,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',11,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',11,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',11,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',11,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',12,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',12,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',12,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',12,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',12,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',13,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',13,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',13,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',13,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',13,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',25,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',25,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',25,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',25,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',25,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',14,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',14,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',14,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',14,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',14,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',15,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',15,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',15,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',15,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',15,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Insatisfaisant',16,null,null,null,1);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Faible',16,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Moyen',16,null,null,null,3);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Bien',16,null,null,null,4);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Excellent',16,null,null,null,5);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Oui',17,null,null,null,2);
insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('Non',17,null,null,null,1);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('rédigez votre commentaire',18,null,null,null,0);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('',19,null,null,null,0);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('',20,null,null,null,0);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('',21,null,null,null,0);

insert into description_champ_reponse(descr_champs,id_qst_fille,nb_max,created_at,updated_at,point_champ) values ('',22,null,null,null,0);




CREATE TABLE avis(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    stagiaire_id bigint(20) UNSIGNED NOT NULL REFERENCES stagiaires(id) ON DELETE CASCADE,
    module_id bigint(20) UNSIGNED NOT NULL REFERENCES modules(id) ON DELETE CASCADE,
    note decimal(5,2) not null default 0,
    commentaire text,
    status varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
    date_avis date NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
);

create TABLE nombre(
    nombre int not null
);

insert into nombre(nombre) values(1);
insert into nombre(nombre) values(2);
insert into nombre(nombre) values(3);
insert into nombre(nombre) values(4);
insert into nombre(nombre) values(5);


create table ressources(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  description text not null,
  demandeur varchar(255) not null,
  groupe_id bigint(20) UNSIGNED NOT NULL REFERENCES goupes(id) ON DELETE CASCADe
);
alter table ressources add column pris_en_charge VARCHAR(200);
alter table ressources add column note text;


create table frais_annexe_formation(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  description text not null,
  montant decimal(20,2) not null,
  entreprise_id bigint(20) UNSIGNED NOT NULL REFERENCES entreprises(id) ON DELETE CASCADe,
  groupe_id bigint(20) UNSIGNED NOT NULL REFERENCES goupes(id) ON DELETE CASCADe
);

create table status(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  status varchar(100) not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


insert into `status` (`status`)  VALUES   ('Prévisionnel'),('A venir'),('En cours'),('Terminé');

drop table if exists detail_evaluation_action_formation;
create table detail_evaluation_action_formation(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pourcent decimal(5,2) not null,
    evaluation_action_formation_id bigint(20) UNSIGNED NOT NULL REFERENCES evaluation_action_formation(id) ON DELETE CASCADE,
    cfp_id bigint(20) UNSIGNED NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
    created_at timestamp,
    updated_at timestamp,
    groupe_id  bigint(20) UNSIGNED  NOT NULL REFERENCES groupes(id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create table salle_formation_of(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  cfp_id bigint(20) UNSIGNED NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
  salle_formation text not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

alter table salle_formation_of add column ville VARCHAR(200);