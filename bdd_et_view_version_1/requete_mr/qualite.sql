select desc_champ.descr_champs,qst_mere.qst_mere,qst_mere.desc_reponse,qst_fille.qst_fille, reponse.reponse_desc_champ,reponse.points,
stg.nom_stagiaire,stg.prenom_stagiaire,stg.url_photo as url_photo_stagiaire,stg.entreprise_id,
gp.nom_groupe,
etp.nom_etp as entreprise,etp.url_logo as url_logo_etp,
reponse.cfp_id,
cfp.nom as organisme_formation,cfp.url_logo as url_logo_cfp
FROM reponse_evaluationchaud as reponse
LEFT JOIN stagiaires AS stg ON
stg.id = reponse.stagiaire_id
LEFT JOIN entreprises as etp ON
stg.entreprise_id = etp.id
LEFT JOIN cfps as cfp ON
cfp.id = reponse.cfp_id
LEFT JOIN description_champ_reponse as desc_champ ON
desc_champ.id = reponse.id_desc_champ
LEFT JOIN question_fille as qst_fille ON
qst_fille.id = desc_champ.id_qst_fille
LEFT JOIN question_mere as qst_mere ON
qst_mere.id = qst_fille.id_qst_mere
LEFT JOIN groupes as gp ON
gp.id = reponse.groupe_id