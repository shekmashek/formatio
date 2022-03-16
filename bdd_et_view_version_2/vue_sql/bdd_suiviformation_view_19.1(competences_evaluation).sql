create or replace view v_evaluation_stagiaire_competence as
    select
        c.titre_competence,
        c.module_id,
        c.objectif,
        es.id as evaluation_stg_id,
        es.groupe_id,
        es.competence_id,
        es.stagiaire_id,
        es.note_avant,
        es.note_apres,
        es.status
    from competence_a_evaluers c
    join evaluation_stagiaires es
    on c.id = es.competence_id;