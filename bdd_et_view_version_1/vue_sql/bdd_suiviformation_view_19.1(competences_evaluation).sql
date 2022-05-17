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
        es.status,
        case 
            when es.status = 1 then 'checked'
            when es.status = 2 then ''
            when es.status = 3 then ''
        end non_acquis,
        case 
            when es.status = 1 then ''
            when es.status = 2 then 'checked'
            when es.status = 3 then ''
        end en_cours,
        case 
            when es.status = 1 then ''
            when es.status = 2 then ''
            when es.status = 3 then 'checked'
        end acquis
    from competence_a_evaluers c
    join evaluation_stagiaires es on c.id = es.competence_id;

create or replace view v_evaluation_globale as 
    select 
        *,
        case 
            when status = 1 then 'checked'
            when status = 2 then ''
        end non_valide,
        case 
            when status = 1 then ''
            when status = 2 then 'checked'
        end valide
    from participant_groupe;