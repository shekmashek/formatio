CREATE OR REPLACE VIEW v_notification_test_niveaux AS SELECT
    s.stagiaire_id,
    s.demande_tn_id,
    s.etat,
    d.description_test,
    d.entreprise_id,
    d.cfp_id,
    d.formation_id,
    d.date_creation
FROM
    stagiaire_pour_test_niveaux s
JOIN demande_test_niveaux d ON
    d.id = s.demande_tn_id;

create or replace view v_question_reponse_test_niveau as
    select c.*,q.cfp_id,q.formation_id from question_evaluations q join choix_pour_questions c
    on c.question_id = q.id;

create or replace view v_resultat_test_niveau as
    select sum(points) as total_points,count(question_id) as nombre_question,(sum(points)/count(question_id))*100 as pourcentage, demande_tn_id,stagiaire_id from reponse_pour_questions
    group by stagiaire_id,demande_tn_id;


create or replace view v_notification_demande as
    select n.stagiaire_id,n.demande_tn_id,n.description_test,n.entreprise_id,n.cfp_id,n.formation_id,
    n.date_creation,n.etat,f.nom_formation from v_notification_test_niveaux n join formations f
    on n.formation_id = f.id;