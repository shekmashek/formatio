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

CREATE TABLE `question_mere` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `qst_mere` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_reponse` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cfp_id` bigint(20) NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `question_fille` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `qst_fille` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_type_champs` bigint(20) UNSIGNED NOT NULL REFERENCES type_champs(id) ON DELETE CASCADE,
  `id_qst_mere` bigint(20) UNSIGNED NOT NULL REFERENCES question_mere(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

alter table question_fille add column point_max int(10) default 0;




CREATE TABLE `description_champ_reponse` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `descr_champs` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_qst_fille` bigint(20) UNSIGNED NOT NULL REFERENCES question_fille(id) ON DELETE CASCADE,
  `cfp_id` bigint(20) NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `nb_max` int(11),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE description_champ_reponse
add column point_champ int(5) default 0;

CREATE TABLE `reponse_evaluationchaud` (
  `id` bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `reponse_desc_champ` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_desc_champ` bigint(20) UNSIGNED NOT NULL REFERENCES description_champ_reponse(id) ON DELETE CASCADE,
  `stagiaire_id` bigint(20) UNSIGNED NOT NULL REFERENCES stagiaires(id) ON DELETE CASCADE,
  `groupe_id` bigint(20) UNSIGNED NOT NULL REFERENCES groupes(id) ON DELETE CASCADE,
  `cfp_id` bigint(20) NOT NULL REFERENCES entreprises(id) ON DELETE CASCADE,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE reponse_evaluationchaud add column points int(11) default 0;
ALTER TABLE reponse_evaluationchaud add column status int(2) NULL;


insert into question_mere values(1,'Qualité global de la formation','Donnez une note sur 10 pour votre évaluation globale de la formation:',1,null,null);
insert into question_mere values(2,'Qualité pédagoqique du formation','Donnez une note sur 10 pour votre évaluation globale de la qualité pédagogique de la formation:',1,null,null);
insert into question_mere values(3,'Préparation de la formation','Cochez une case par ligne',1,null,null);
insert into question_mere values(4,'Organisation de la formation','Cochez une case par ligne',1,null,null);
insert into question_mere values(5,'Déroulement de la formation','Cochez une case par ligne',1,null,null);
insert into question_mere values(6,'Le rythme de la formation était-il?','',1,null,null);
insert into question_mere values(7,'Contenu de la formation','Cochez une case par ligne',1,null,null);
insert into question_mere values(8,'Les objectifs du programme vont-ils atteints','Cochez une case par ligne',1,null,null);
insert into question_mere values(9,'Efficacité de la formation','Cochez une case par ligne',1,null,null);
insert into question_mere values(10,'Recommanderiez-vous cette formation?','',1,null,null);
insert into question_mere values(11,'Quels sont vos attentes pour cette formation?','Repondre au question',1,null,null);
insert into question_mere values(12,'Quels sont les points forts de cette formation','Repondre au question',1,null,null);
insert into question_mere values(13,'Quels sont les points faibles de cette formation','Repondre au question',1,null,null);
insert into question_mere values(14,'Autres remarques','Repondre au question',1,null,null);


insert into question_fille values (1,"Qualité Globale de la formation",1,1,null,null,0);

insert into question_fille values (2,'Qualité Globale de la formation',1,2,null,null,0);

insert into question_fille values (3,'Les objectifs de la formation ont-ils été clairement annoncés ?',2,3,null,null,4);
insert into question_fille values (4,'Avez-vous eu une discussion avec notre hiérarchie concernant cette formation ?',2,3,null,null,4);

insert into question_fille values (5,"Etes-vous satisfait de l'organisation du logistique et matériels utilisé (salle,ordinateur,vidéoprojecteur) ?",2,4,null,null,0);
insert into question_fille values (6,"La durée du stage de 12 heures vous a-telle semblé adaptée ?",2,4,null,null,4);

insert into question_fille values (7,"Le formateur étail-il clair et dynamique ?",2,5,null,null,4);
insert into question_fille values (8,"les exercices et activités étaient-ils pertinents ?",2,5,null,null,4);
insert into question_fille values (9,"Le formateur a-t-il adapté la formation aux stagiaires ?",2,5,null,null,4);

insert into question_fille values (10,"Le rythme de la formation était-il?",2,6,null,null,3);

insert into question_fille values (11,"Le programme étail-il clair et précis ?",2,7,null,null,4);
insert into question_fille values (12,"Le programme étail-il adapté à vos besoins ?",2,7,null,null,4);
insert into question_fille values (13,"Les supports de la formation étaient-ils clairs et utiles ?",2,7,null,null,4);

insert into question_fille values (14,"Les objectifs du programme de formation sont-ils atteints ?",2,8,null,null,4);

insert into question_fille values (15,"Cette formation améliore-t-elle compétences ?",2,9,null,null,4);
insert into question_fille values (16,"Ces nouvelles compétences vont-elles etre applicables dans votre travail ?",2,9,null,null,4);

insert into question_fille values (17,"",2,10,null,null,2);
insert into question_fille values (18,"Vos commentaires: ",3,10,null,null,0);

insert into question_fille values (19,"",3,11,null,null,0);

insert into question_fille values (20,"",3,12,null,null,0);

insert into question_fille values (21,"",3,13,null,null,0);

insert into question_fille values (22,"",3,14,null,null,0);


insert into description_champ_reponse values (1,'Note sur 10',1,1,10,null,null,0);

insert into description_champ_reponse values (2,'Note sur 10',2,1,10,null,null,0);

insert into description_champ_reponse values (3,'Pas du tout',3,1,null,null,null,0);
insert into description_champ_reponse values (4,'Insuffisamment',3,3,null,null,null,0);
insert into description_champ_reponse values (5,'En partie',3,1,null,null,null,0);
insert into description_champ_reponse values (6,'Totalement',3,1,null,null,null,0);

insert into description_champ_reponse values (7,'Pas du tout',4,1,null,null,null,0);
insert into description_champ_reponse values (8,'Insuffisamment',4,1,null,null,null,0);
insert into description_champ_reponse values (9,'En partie',4,1,null,null,null,0);
insert into description_champ_reponse values (10,'Totalement',4,1,null,null,null,0);

insert into description_champ_reponse values (11,'Pas du tout',5,1,null,null,null,0);
insert into description_champ_reponse values (12,'Insuffisamment',5,1,null,null,null,0);
insert into description_champ_reponse values (13,'En partie',5,1,null,null,null,0);
insert into description_champ_reponse values (14,'Totalement',5,1,null,null,null,0);

insert into description_champ_reponse values (15,'Pas du tout',6,1,null,null,null,0);
insert into description_champ_reponse values (16,'Insuffisamment',6,1,null,null,null,0);
insert into description_champ_reponse values (17,'En partie',6,1,null,null,null,0);
insert into description_champ_reponse values (18,'Totalement',6,1,null,null,null,0);

insert into description_champ_reponse values (19,'Pas du tout',7,1,null,null,null,0);
insert into description_champ_reponse values (20,'Insuffisamment',7,1,null,null,null,0);
insert into description_champ_reponse values (21,'En partie',7,1,null,null,null,0);
insert into description_champ_reponse values (22,'Totalement',7,1,null,null,null,0);

insert into description_champ_reponse values (23,'Pas du tout',8,1,null,null,null,0);
insert into description_champ_reponse values (24,'Insuffisamment',8,1,null,null,null,0);
insert into description_champ_reponse values (25,'En partie',8,1,null,null,null,0);
insert into description_champ_reponse values (26,'Totalement',8,1,null,null,null,0);

insert into description_champ_reponse values (27,'Pas du tout',9,1,null,null,null,0);
insert into description_champ_reponse values (28,'Insuffisamment',9,1,null,null,null,0);
insert into description_champ_reponse values (29,'En partie',9,1,null,null,null,0);
insert into description_champ_reponse values (30,'Totalement',9,1,null,null,null,0);

insert into description_champ_reponse values (31,'Adapté',10,1,null,null,null,0);
insert into description_champ_reponse values (32,'Trop rapide',10,1,null,null,null,0);
insert into description_champ_reponse values (33,'Trop lent',10,1,null,null,null,0);

insert into description_champ_reponse values (34,'Pas du tout',11,1,null,null,null,0);
insert into description_champ_reponse values (35,'Insuffisamment',11,1,null,null,null,0);
insert into description_champ_reponse values (36,'En partie',11,1,null,null,null,0);
insert into description_champ_reponse values (37,'Totalement',11,1,null,null,null,0);

insert into description_champ_reponse values (38,'Pas du tout',12,1,null,null,null,0);
insert into description_champ_reponse values (39,'Insuffisamment',12,1,null,null,null,0);
insert into description_champ_reponse values (40,'En partie',12,1,null,null,null,0);
insert into description_champ_reponse values (41,'Totalement',12,1,null,null,null,0);

insert into description_champ_reponse values (42,'Pas du tout',13,1,null,null,null,0);
insert into description_champ_reponse values (43,'Insuffisamment',13,1,null,null,null,0);
insert into description_champ_reponse values (44,'En partie',13,1,null,null,null,0);
insert into description_champ_reponse values (45,'Totalement',13,1,null,null,null,0);

insert into description_champ_reponse values (46,'Pas du tout',14,1,null,null,null,0);
insert into description_champ_reponse values (47,'Insuffisamment',14,1,null,null,null,0);
insert into description_champ_reponse values (48,'En partie',14,1,null,null,null,0);
insert into description_champ_reponse values (49,'Totalement',14,1,null,null,null,0);

insert into description_champ_reponse values (50,'Non',15,1,null,null,null,0);
insert into description_champ_reponse values (51,'Un peu',15,1,null,null,null,0);
insert into description_champ_reponse values (52,'Beaucoup',15,1,null,null,null,0);

insert into description_champ_reponse values (53,'Non',16,1,null,null,null,0);
insert into description_champ_reponse values (54,'Un peu',16,1,null,null,null,0);
insert into description_champ_reponse values (55,'Beaucoup',16,1,null,null,null,0);

insert into description_champ_reponse values (56,'Oui',17,1,null,null,null,0);
insert into description_champ_reponse values (57,'Non',17,1,null,null,null,0);

insert into description_champ_reponse values (58,'rédigez votre commentaire',18,1,null,null,null,0);

insert into description_champ_reponse values (59,'',19,1,null,null,null,0);

insert into description_champ_reponse values (60,'',20,1,null,null,null,0);

insert into description_champ_reponse values (61,'',21,1,null,null,null,0);

insert into description_champ_reponse values (62,'',22,1,null,null,null,0);

update description_champ_reponse set point_champ = 1 where descr_champs = 'Pas du tout';
update description_champ_reponse set point_champ = 2 where descr_champs = 'Insuffisamment';
update description_champ_reponse set point_champ = 3 where descr_champs = 'En partie';
update description_champ_reponse set point_champ = 4 where descr_champs = 'Totalement';
update description_champ_reponse set point_champ = 1 where descr_champs = 'Trop rapide';
update description_champ_reponse set point_champ = 1 where descr_champs = 'Trop lent';
update description_champ_reponse set point_champ = 3 where descr_champs = 'Adapté';
update description_champ_reponse set point_champ = 1 where descr_champs = 'Non';
update description_champ_reponse set point_champ = 2 where descr_champs = 'Oui';
update description_champ_reponse set point_champ = 2 where descr_champs = 'Un peu';
update description_champ_reponse set point_champ = 3 where descr_champs = 'Beaucoup';




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