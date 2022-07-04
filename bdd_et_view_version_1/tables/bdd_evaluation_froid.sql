
create table question_evaluation_froid(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    type_champ_id bigint(20) NOT NULL REFERENCES type_champs(id) ON DELETE CASCADE,
    question text,
    point_max int(2) default 0
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into question_evaluation_froid (type_champ_id,question,point_max) values(2,'Je mets en pratique régulièrement à mon poste de travail les connaissances acquises au cours de la formation',5);
insert into question_evaluation_froid (type_champ_id,question,point_max) values(4,'À quelle fréquence ?',2);
insert into question_evaluation_froid (type_champ_id,question,point_max) values(4,'À quoi cela est-il dû ? (plusieurs réponses sont possibles, cochez la (ou les) case(s) correspondante(s))',7);
insert into question_evaluation_froid (type_champ_id,question,point_max) values(4,'Si vous ne les avez pas encore mises en pratique, quelles en sont les raisons ? (plusieurs réponses possibles)',10);
insert into question_evaluation_froid (type_champ_id,question,point_max) values(3,'Quels ont été les impacts de cette formation sur votre situation professionnelle ? (ex : évolution de poste / promotion, évaluation positive, meilleure intégration, reconnaissance, rétribution...)',2);
insert into question_evaluation_froid (type_champ_id,question,point_max) values(4,'Pour aller plus loin dans le développement de mes compétences, je pense avoir besoin... (merci de préciser votre besoin en commentaire)',2);

create table reponse_question_eval_froid(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    question_id bigint(20) NOT NULL REFERENCES question_evaluation_froid(id) ON DELETE CASCADE,
    reponse text,
    point_reponse int(2) default 0
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(1,'Totalement en désaccord',1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(1,'',2);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(1,'',3);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(1,'',4);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(1,'Totalement en accord',5);

insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(2,'Régulièrement',2);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(2,'Occasinnellement',1);

insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(3,'L’opportunité ne s’est pas présentée',1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(3,'L’opportunité ne s’est pas encore présentée, mais il devrait en avoir l’occasion',1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(3,'La formation dispensée n’était pas adaptée à ses besoins',1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(3,'La formation n’a pas eu lieu au bon moment (trop tôt ou trop tard)',1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(3,'Le niveau de formation n’était pas adapté à son propre niveau',1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(3,'Les points abordés en formation n’ont pas de lien avec ses missions dans l’entreprise',1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(3,'Le collaborateur a changé de fonction entre-temps',1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(3,'Autre (à préciser)',1);

insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(4,"Je n'ai pas eu l'occasion d'utiliser les acquis de ma formation",1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(4,"Je n'ai pas eu assez de temps",1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(4,"Je n'ai pas eu le matériel adéquat",1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(4,"Je n'ai pas eu l'information adéquate",1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(4,"Mes collègues se sont montré(e)s réticent(e)s",1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(4,"Mes subordonné(e)s se sont montré(e)s réticent(e)s",1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(4,"Mon manager n'y était pas favorable",1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(4,"Le contenu de la formation ne correspond pas à mon travail",1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(4,"La formation n'a pas été donnée au moment où j'en avais besoin",1);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(4,"Autre(s) (merci de préciser)",1);

insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(5,"",0);

insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(6,"D'une information",0);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(6,"D'un accompagnement",0);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(6,"D'une formation",0);
insert into reponse_question_eval_froid(question_id,reponse,point_reponse) values(6,"De plus de pratique",0);


create table resultat_eval_froid_stagiaire(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    question_id bigint(20) NOT NULL REFERENCES question_evaluation_froid(id) ON DELETE CASCADE,
    groupe_id bigint(20) NOT NULL REFERENCES groupes(id) ON DELETE CASCADE,
    stagiaire_id bigint(20) NOT NULL REFERENCES chef_departements(id) ON DELETE CASCADE,
    reponse_id bigint(20) NOT NULL REFERENCES reponse_question_eval_froid(id) ON DELETE CASCADE,
    date_eval timestamp default now()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
alter table resultat_eval_froid_stagiaire add reponse_text text;

create table resultat_eval_froid_manager(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    question_id bigint(20) NOT NULL REFERENCES question_evaluation_froid(id) ON DELETE CASCADE,
    groupe_id bigint(20) NOT NULL REFERENCES groupes(id) ON DELETE CASCADE,
    manager_id bigint(20) NOT NULL REFERENCES stagiaires(id) ON DELETE CASCADE,
    reponse_eval text,
    date_eval timestamp default now()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create or replace view v_question_champ_froid as
select
    q.id as question_id,
    q.type_champ_id,
    q.question,
    q.point_max,
    tc.nom_champ,
    tc.desc_champ
from question_evaluation_froid q
join type_champs tc on q.type_champ_id = tc.id;

create or replace view v_resultat_froid_evaluation_stagiaire as
    select
        r.question_id,
        r.groupe_id,
        count(r.stagiaire_id) as nombre_reponse,
        ns.total_stagiaire,
        r.reponse_id,
        rep.reponse,
        q.desc_champ,
        ROUND((count(r.stagiaire_id)*100)/ns.total_stagiaire,1) as pourcentage_reponse
    from resultat_eval_froid_stagiaire r
    join v_nombre_stagiaire_groupe ns on r.groupe_id = ns.groupe_id
    join v_question_champ_froid q on r.question_id = q.question_id
    join reponse_question_eval_froid rep on rep.id = r.reponse_id
    where q.desc_champ != 'TEXT'
    group by
        r.question_id,
        r.groupe_id,
        r.reponse_id,
        ns.total_stagiaire,
        rep.reponse,
        q.desc_champ;

