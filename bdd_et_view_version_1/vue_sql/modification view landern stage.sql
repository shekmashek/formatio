
/* Modification v_participant_groupe_detail(suiviformation view 4.0) 

    recopier v_participant_groupe_detail ou ce script
 */

 create or replace view v_participant_groupe_detail as
    select
        sg.*,
        d.id as detail_id,
        d.lieu,
        d.date_detail,
        d.h_debut,
        d.h_fin,
        d.formateur_id,
        formateurs.mail_formateur,
        formateurs.numero_formateur,
        formateurs.nom_formateur,
        formateurs.prenom_formateur
    from v_stagiaire_groupe sg
    join details d on sg.groupe_id = d.groupe_id
    join formateurs on formateurs.id = d.formateur_id;