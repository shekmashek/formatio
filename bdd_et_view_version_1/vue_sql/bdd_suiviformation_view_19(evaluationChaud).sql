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
    groupe_id
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
    qf.qst_fille;




select
    id_qst_fille,
    qst_fille,
    (total_stagiaire * point_max) as note_sur_10,
    

