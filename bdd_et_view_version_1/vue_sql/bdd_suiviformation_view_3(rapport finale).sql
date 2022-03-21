
CREATE OR REPLACE VIEW v_liste_formateur_projet AS SELECT
    cfp_id,
    projet_id,
    formateur_id,
    nom_projet,
    nom_formateur,
    prenom_formateur,
    photos,
    mail_formateur,
    numero_formateur,
    genre,
    activiter_formateur,
    user_id
FROM
    v_detailmoduleformationprojetformateur
GROUP BY
    cfp_id,
    projet_id,
    formateur_id,
    nom_projet,
    nom_formateur,
    prenom_formateur,
    photos,
    mail_formateur,
    numero_formateur,
    genre,
     activiter_formateur,
    user_id;


-- CREATE OR REPLACE VIEW v_liste_stagiaire_groupe AS SELECT
--     v_participantsession.cfp_id,
--     stagiaire_id,
--     stagiaires.nom_stagiaire,
--     stagiaires.prenom_stagiaire,
--     v_participantsession.groupe_id,
--     groupes.nom_groupe,
--     groupes.date_debut,
--     groupes.date_fin,
--     (groupes.status) status_groupe,
--     (groupes.activiter) activiter_groupe,
--     module_id,
--     nom_module,
--     reference,
--     v_detailmoduleformation.projet_id
-- FROM
--     stagiaires,
--     v_participantsession,
--     groupes,
--     v_detailmoduleformation
-- WHERE
--     stagiaire_id = stagiaires.id AND v_detailmoduleformation.projet_id = v_participantsession.projet_id AND v_participantsession.groupe_id = groupes.id
--     AND v_participantsession.cfp_id = v_detailmoduleformation.cfp_id;



CREATE OR REPLACE VIEW v_detail_groupe_module_projet AS SELECT
    duree,
    formation_id,
    nom_formation,
    cfp_id,
    lieu,
    h_debut,
    h_fin,
    date_detail,
    detail_id,
    v_detailmoduleformation.projet_id,
    groupe_id,
    module_id,
    reference,
    nom_module,
    nom_groupe,
    date_debut,
    date_fin,
    (groupes.status) status_groupe,
    (groupes.activiter) activiter_groupe
FROM
    v_detailmoduleformation,
    groupes
WHERE
    groupe_id = groupes.id AND v_detailmoduleformation.projet_id = groupes.projet_id;


CREATE OR REPLACE VIEW v_groupe_projet AS SELECT
    v_detail_groupe_module_projet.cfp_id,
    formation_id,
    nom_formation,
    status_groupe,
    activiter_groupe,
    lieu,
    projet_id,
    nom_projet,
    groupe_id,
    module_id,
    nom_module,
    nom_groupe
FROM
    v_detail_groupe_module_projet,
    projets
WHERE
    projet_id = projets.id AND v_detail_groupe_module_projet.cfp_id = projets.cfp_id
GROUP BY
    v_detail_groupe_module_projet.cfp_id,
    formation_id,
    nom_formation,
    status_groupe,
    activiter_groupe,
    lieu,
    projet_id,
    groupe_id,
    module_id,
    nom_module,
    nom_groupe,
    nom_projet;



CREATE OR REPLACE VIEW v_detail_groupe_stagaire AS SELECT
    lieu,
    h_debut,
    h_fin,
    date_detail,
    detail_id,
    projet_id,
    groupe_id,
    module_id,
    cfp_id,
    reference,
    nom_module,
    nom_groupe
FROM
    v_detail_groupe_module_projet;



create or replace view v_date_formation as
select
    lieu,groupes.projet_id,groupe_id,date_debut,date_fin,cfp_id,status,activiter
    from details,groupes
    where groupe_id = groupes.id  group by groupes.projet_id,lieu,groupe_id,date_debut,date_fin,cfp_id,status,activiter;





CREATE OR REPLACE VIEW v_evaluation_action_formation AS SELECT
    (evaluation_action_formation.id) action_formation_id,
    titre,
    pourcent,
    projet_id,
    evaluation_action_formation.cfp_id
FROM
    detail_evaluation_action_formation,
    evaluation_action_formation
WHERE
    evaluation_action_formation_id = evaluation_action_formation.id AND evaluation_action_formation.cfp_id = evaluation_action_formation.cfp_id;



CREATE OR REPLACE VIEW v_pourcent_globale_evaluation_action_formation AS SELECT
    (ROUND(AVG(pourcent),
    2)) globale,
    projet_id,
    cfp_id
FROM
    v_evaluation_action_formation
GROUP BY
    projet_id,cfp_id;


CREATE OR REPLACE VIEW v_detail_cour AS SELECT
    (details.id) detail_id,
    cfp_id,
    cours_id,
    cours.titre_cours,
    cour_dans_detail.programme_id,
    (programmes.titre) titre_programme
FROM
    cour_dans_detail,
    details,
    cours,
    programmes
WHERE
    cour_dans_detail.cours_id = cours.id AND cour_dans_detail.programme_id = programmes.id AND cour_dans_detail.detail_id = details.id;


CREATE OR REPLACE VIEW v_programme_detail_activiter AS SELECT
    v_detailmoduleformation.*,
    cours_id,
    titre_cours,
    programme_id,
    titre_programme
FROM
    v_detailmoduleformation,
    v_detail_cour
WHERE
    v_detailmoduleformation.detail_id = v_detail_cour.detail_id AND v_detailmoduleformation.cfp_id = v_detail_cour.cfp_id;


CREATE OR REPLACE VIEW v_trie_detail_date AS SELECT
	cfp_id,
    projet_id,
    h_debut,
    h_fin,
    date_detail
FROM
    v_programme_detail_activiter
GROUP BY
	cfp_id,
    projet_id,
    h_debut,
    h_fin,
    date_detail;


CREATE OR REPLACE VIEW v_trie_detail_programme AS SELECT
    cfp_id,
    projet_id,
    programme_id,
    titre_programme,
    groupe_id
FROM
    v_programme_detail_activiter
GROUP BY
    cfp_id,
    projet_id,
    programme_id,
    titre_programme,
    groupe_id;




