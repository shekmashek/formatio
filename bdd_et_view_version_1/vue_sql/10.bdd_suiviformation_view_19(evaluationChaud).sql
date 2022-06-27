
create table points(point int(2));

insert into
    points value(1);

insert into
    points value(2);

insert into
    points value(3);

insert into
    points value(4);

alter table reponse_evaluationchaud add column statut int(2) default 0;
alter table reponse_evaluationchaud add column points int(11) default 0;

create
or replace view v_question_fille as
select
    (question_fille.id) id,
    qst_fille,
    id_type_champs,
    desc_champ,
    id_qst_mere
from
    question_fille,
    type_champs
where
    id_type_champs = type_champs.id;

create
or replace view v_reponse_evaluationchaud as
select
    reponse_desc_champ,
    id_desc_champ,
    (descr_champs) desc_champ,
    nb_max,
    id_qst_fille,
    stagiaire_id,
    points,
    groupe_id,
    statut
from
    reponse_evaluationchaud,
    description_champ_reponse
where
    id_desc_champ = description_champ_reponse.id;


create
or replace view v_nombre_stagiaire_groupe as
select
    groupe_id,
    count(stagiaire_id) as total_stagiaire
from
    participant_groupe
group by
    groupe_id;

create
or replace view v_evaluation_chaud as
select
    re.groupe_id,
    id_qst_fille,
    qf.qst_fille,
    count(stagiaire_id) as nombre_stg,
    re.points,
    total_stagiaire,
    qf.point_max
from
     v_reponse_evaluationchaud re
    join v_nombre_stagiaire_groupe nsg on re.groupe_id = nsg.groupe_id
    join question_fille qf on re.id_qst_fille = qf.id
group by
    id_qst_fille,
    re.groupe_id,
    re.points,
    qf.qst_fille,
    qf.point_max,
    nsg.total_stagiaire;


create
or replace view v_question_fille_point as
select
    qf.id as id_qst_fille,
    qf.qst_fille,
    qf.point_max,
    p.point,
    t.groupe_id as groupe_id
from
    question_fille qf
    cross join points p
    join (
        select
            qf.id as id_qst_fille,
            g.id as groupe_id
        from
            question_fille qf
            cross join groupes g
    ) as t on t.id_qst_fille = qf.id;



create
or replace view v_evaluation_chaud_resultat as
select
    qfp.groupe_id,
    qfp.id_qst_fille,
    qfp.qst_fille,
    qfp.point,
    ifnull(ec.points, 0) as point_eval,
    ifnull(ec.nombre_stg, 0) as nombre_stg,
    ifnull(ec.total_stagiaire, 0) as total_stagiaire,
    ifnull(
        ROUND(
            (
                (ec.nombre_stg * ec.points) /(ec.total_stagiaire * qfp.point_max)
            ) * 10,
            1
        ),
        0
    ) as note_sur_10,
    ifnull(
        ROUND(
            (
                (ec.nombre_stg * ec.points) /(ec.total_stagiaire * qfp.point_max)
            ) * 100,
            1
        ),
        0
    ) as pourcentage
from
    v_question_fille_point qfp
    left join v_evaluation_chaud ec on qfp.id_qst_fille = ec.id_qst_fille and qfp.point = ec.points and qfp.groupe_id = ec.groupe_id
    group by
        qfp.groupe_id,
        qfp.id_qst_fille,
        qfp.qst_fille,
        qfp.point,
        ec.points,
        ec.nombre_stg,
        ec.total_stagiaire;