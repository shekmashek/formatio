SELECT dtls.date_detail,dtls.h_debut as debut_seance,
       dtls.h_fin as fin_seance,
       p.h_entree as entree_stagiaire, p.h_sortie as sortie_stagiaire,
       frm.nom_formateur,frm.prenom_formateur,frm.url_photo as url_photo_formateur,
       gp.nom_groupe as nom_session,
       note,
       stg.nom_stagiaire,stg.prenom_stagiaire,stg.url_photo as url_photo_stagiaire,stg.entreprise_id,
       etp.nom_etp as entreprise,etp.url_logo as url_logo_etp,
       dtls.cfp_id,
       cfp.nom as organisme_formation,cfp.url_logo as url_logo_cfp,
CASE p.status
        WHEN '1' THEN 'present'
        WHEN '0' THEN 'absent'
END as status_presence
FROM presences as p
LEFT JOIN stagiaires as stg ON
stg.id = p.stagiaire_id
LEFT JOIN entreprises as etp ON
etp.id = stg.entreprise_id
LEFT JOIN details as dtls ON
dtls.id = p.detail_id
LEFT JOIN cfps as cfp ON
cfp.id = dtls.cfp_id
LEFT JOIN formateurs as frm ON
frm.id = dtls.formateur_id
LEFT JOIN groupes as gp ON
gp.id = dtls.groupe_id


