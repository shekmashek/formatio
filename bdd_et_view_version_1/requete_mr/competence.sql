SELECT evaluation.groupe_id,g.nom_groupe,g.projet_id,
pj.nom_projet,pj.cfp_id,
cfp.nom as organisme_formation, cfp.url_logo as url_logo_cfp,
evaluation.competence_id,cp.titre_competence,
cp.module_id,md.reference,md.nom_module,
evaluation.stagiaire_id,stg.nom_stagiaire,stg.prenom_stagiaire,stg.url_photo as url_photo_stagiaire,stg.entreprise_id,
etp.nom_etp as entreprise,etp.url_logo as url_logo_etp,
evaluation.note_avant,evaluation.note_apres,
CASE evaluation.status
        WHEN '0' THEN 'non évalué'
        WHEN '1' THEN 'non acquis'
        WHEN '2' THEN 'en cours'
        WHEN '3' THEN 'acquis'
END as status_evaluation
FROM evaluation_stagiaires as evaluation
LEFT JOIN groupes as g ON g.id = evaluation.groupe_id
LEFT JOIN competence_a_evaluers as cp ON cp.id = evaluation.competence_id
LEFT JOIN stagiaires as stg ON stg.id = evaluation.stagiaire_id
LEFT JOIN projets as pj ON pj.id = g.projet_id
LEFT JOIN cfps as cfp ON cfp.id = pj.cfp_id
LEFT JOIN modules as md ON md.id = cp.module_id
LEFT JOIN entreprises as etp ON etp.id = stg.entreprise_id
