

create or replace view v_question_fille as
select
    (question_fille.id) id, qst_fille,id_type_champs,desc_champ,id_qst_mere
from
    question_fille,type_champs
where
    id_type_champs=type_champs.id;


create or replace view v_reponse_evaluationchaud as
    select
        reponse_desc_champ,id_desc_champ,(descr_champs) desc_champ,nb_max,id_qst_fille,stagiaire_id
    from
        reponse_evaluationchaud,description_champ_reponse where id_desc_champ = description_champ_reponse.id;

