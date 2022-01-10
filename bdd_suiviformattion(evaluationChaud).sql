-- v_detailmoduleformationprojetformateur

create table type_champs(
    id bigint(20) unsigned primary key not null auto_increment,
    nom_champ varchar(250) not null,
    desc_champ varchar(100) NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into type_champs values(1,'Champs type Nombre','NOMBRE',null,null);
insert into type_champs values(2,'Champs type Case a Cocher','CASE',null,null);
insert into type_champs values(3,'Champs type Text ou commentaire','TEXT',null,null);

create table question_mere(
    id bigint(20) unsigned primary key not null auto_increment,
    qst_mere text NOT NULL,
    desc_reponse text,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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


create table question_fille(
    id bigint(20) unsigned primary key not null auto_increment,
    qst_fille text ,
    id_type_champs bigint(20) unsigned not null,
    id_qst_mere bigint(20) unsigned not null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(id_type_champs) references type_champs(id),
    foreign key(id_qst_mere) references question_mere(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into question_fille values (1,"Qualité Globale de la formation",1,1,null,null);

insert into question_fille values (2,'Qualité Globale de la formation',1,2,null,null);
-- insert into question_fille values (2,'Avez-vous eu une discussion avec notre hiérarchie concernant cette formation ?',1,2,null,null);

insert into question_fille values (3,'Les objectifs de la formation ont-ils été clairement annoncés ?',2,3,null,null);
insert into question_fille values (4,'Avez-vous eu une discussion avec notre hiérarchie concernant cette formation ?',2,3,null,null);

insert into question_fille values (5,"Etes-vous satisfait de l'organisation du logistique et matériels utilisé (salle,ordinateur,vidéoprojecteur) ?",2,4,null,null);
insert into question_fille values (6,"La durée du stage de 12 heures vous a-telle semblé adaptée ?",2,4,null,null);

insert into question_fille values (7,"Le formateur étail-il clair et dynamique ?",2,5,null,null);
insert into question_fille values (8,"les exercices et activités étaient-ils pertinents ?",2,5,null,null);
insert into question_fille values (9,"Le formateur a-t-il adapté la formation aux stagiaires ?",2,5,null,null);

insert into question_fille values (10,"",2,6,null,null);

insert into question_fille values (11,"Le programme étail-il clair et précis ?",2,7,null,null);
insert into question_fille values (12,"Le programme étail-il adapté à vos besoins ?",2,7,null,null);
insert into question_fille values (13,"Les supports de la formation étaient-ils clairs et utiles ?",2,7,null,null);

insert into question_fille values (14,"Les objectifs du programme de formation sont-ils atteints ?",2,8,null,null);

insert into question_fille values (15,"Cette formation améliore-t-elle compétences ?",2,9,null,null);
insert into question_fille values (16,"Ces nouvelles compétences vont-elles etre applicables dans votre travail ?",2,9,null,null);

insert into question_fille values (17,"",2,10,null,null);
insert into question_fille values (18,"Vos commentaires: ",3,10,null,null);

insert into question_fille values (19,"",3,11,null,null);

insert into question_fille values (20,"",3,12,null,null);

insert into question_fille values (21,"",3,13,null,null);

insert into question_fille values (22,"",3,14,null,null);




insert into description_champ_reponse values (1,'Note sur 10',1,10,null,null);

insert into description_champ_reponse values (2,'Note sur 10',2,10,null,null);

insert into description_champ_reponse values (3,'Pas de Tout',3,null,null,null);
insert into description_champ_reponse values (4,'Insuffisamment',null,3,null,null);
insert into description_champ_reponse values (5,'En partie',3,null,null,null);
insert into description_champ_reponse values (6,'Totalement',3,null,null,null);

insert into description_champ_reponse values (7,'Pas de Tout',4,null,null,null);
insert into description_champ_reponse values (8,'Insuffisamment',4,null,null,null);
insert into description_champ_reponse values (9,'En partie',4,null,null,null);
insert into description_champ_reponse values (10,'Totalement',4,null,null,null);

insert into description_champ_reponse values (11,'Pas de Tout',5,null,null,null);
insert into description_champ_reponse values (12,'Insuffisamment',5,null,null,null);
insert into description_champ_reponse values (13,'En partie',5,null,null,null);
insert into description_champ_reponse values (14,'Totalement',5,null,null,null);

insert into description_champ_reponse values (15,'Pas de Tout',6,null,null,null);
insert into description_champ_reponse values (16,'Insuffisamment',6,null,null,null);
insert into description_champ_reponse values (17,'En partie',6,null,null,null);
insert into description_champ_reponse values (18,'Totalement',6,null,null,null);

insert into description_champ_reponse values (19,'Pas de Tout',7,null,null,null);
insert into description_champ_reponse values (20,'Insuffisamment',7,null,null,null);
insert into description_champ_reponse values (21,'En partie',7,null,null,null);
insert into description_champ_reponse values (22,'Totalement',7,null,null,null);

insert into description_champ_reponse values (23,'Pas de Tout',8,null,null,null);
insert into description_champ_reponse values (24,'Insuffisamment',8,null,null,null);
insert into description_champ_reponse values (25,'En partie',8,null,null,null);
insert into description_champ_reponse values (26,'Totalement',8,null,null,null);

insert into description_champ_reponse values (27,'Pas de Tout',9,null,null,null);
insert into description_champ_reponse values (28,'Insuffisamment',9,null,null,null);
insert into description_champ_reponse values (29,'En partie',9,null,null,null);
insert into description_champ_reponse values (30,'Totalement',9,null,null,null);

insert into description_champ_reponse values (31,'Adapté',10,null,null,null);
insert into description_champ_reponse values (32,'Trop rapide',10,null,null,null);
insert into description_champ_reponse values (33,'Trop lent',10,null,null,null);

insert into description_champ_reponse values (34,'Pas de Tout',11,null,null,null);
insert into description_champ_reponse values (35,'Insuffisamment',11,null,null,null);
insert into description_champ_reponse values (36,'En partie',11,null,null,null);
insert into description_champ_reponse values (37,'Totalement',11,null,null,null);

insert into description_champ_reponse values (38,'Pas de Tout',12,null,null,null);
insert into description_champ_reponse values (39,'Insuffisamment',12,null,null,null);
insert into description_champ_reponse values (40,'En partie',12,null,null,null);
insert into description_champ_reponse values (41,'Totalement',12,null,null,null);

insert into description_champ_reponse values (42,'Pas de Tout',13,null,null,null);
insert into description_champ_reponse values (43,'Insuffisamment',13,null,null,null);
insert into description_champ_reponse values (44,'En partie',13,null,null,null);
insert into description_champ_reponse values (45,'Totalement',13,null,null,null);

insert into description_champ_reponse values (46,'Pas de Tout',14,null,null,null);
insert into description_champ_reponse values (47,'Insuffisamment',14,null,null,null);
insert into description_champ_reponse values (48,'En partie',14,null,null,null);
insert into description_champ_reponse values (49,'Totalement',14,null,null,null);

insert into description_champ_reponse values (50,'Non',15,null,null,null);
insert into description_champ_reponse values (51,'Un peu',15,null,null,null);
insert into description_champ_reponse values (52,'Beaucoup',15,null,null,null);

insert into description_champ_reponse values (53,'Non',16,null,null,null);
insert into description_champ_reponse values (54,'Un peu',16,null,null,null);
insert into description_champ_reponse values (55,'Beaucoup',16,null,null,null);

insert into description_champ_reponse values (56,'Oui',17,null,null,null);
insert into description_champ_reponse values (57,'Non',17,null,null,null);

insert into description_champ_reponse values (58,'rédigez votre commentaire',18,null,null,null);

insert into description_champ_reponse values (59,'',19,null,null,null);

insert into description_champ_reponse values (60,'',20,null,null,null);

insert into description_champ_reponse values (61,'',21,null,null,null);

insert into description_champ_reponse values (62,'',22,null,null,null);



create or replace view v_question_fille as
select
    (question_fille.id) id, qst_fille,id_type_champs,desc_champ,id_qst_mere
from
    question_fille,type_champs
where
    id_type_champs=type_champs.id;

-- create or replace view v_question_fille as
-- select
--     (description_champ_reponse.id) id_champ_reponse, (descr_champs) descr_champs_reponse,id_qst_fille,
--     qst_fille,id_type_champs,desc_champ,id_qst_mere
-- from
--     description_champ_reponse,question_fille,type_champs
-- where
--     question_fille.id = id_qst_fille and id_type_champs=type_champs.id;
-- create or replace view v_question_mere as
-- select
--     v_question_fille.*,
--     qst_mere,desc_reponse
-- from
--     v_question_fille,question_mere
-- where
--     question_mere.id = id_qst_mere;

create table reponse_evaluationchaud(
    id bigint(20) unsigned primary key not null auto_increment,
    reponse_desc_champ text,
    id_desc_champ bigint(20) unsigned not null,
    stagiaire_id bigint(20) unsigned not null,
    detail_id bigint(20) unsigned not null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(id_desc_champ) references description_champ_reponse(id) on delete cascade,
    foreign key(stagiaire_id) references stagiaires(id),
    foreign key(detail_id) references details(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



create or replace view v_reponse_evaluationchaud as
    select
        reponse_desc_champ,id_desc_champ,(descr_champs) desc_champ,nb_max,id_qst_fille,stagiaire_id
    from
        reponse_evaluationchaud,description_champ_reponse where id_desc_champ = description_champ_reponse.id;

