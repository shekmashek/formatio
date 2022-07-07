-- Active: 1656400043423@@127.0.0.1@3306@bdd_nicole


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

create or replace view v_stagiaire_groupe as
select
        p.id as participant_groupe_id,
        g.id as groupe_id,
        g.max_participant,
        g.min_participant,
        g.nom_groupe,
        g.projet_id,
        g.module_id,
        g.date_debut,
        g.date_fin,
        g.status,
        g.activiter as activiter_groupe,
        s.id as stagiaire_id,
        s.matricule,
        s.nom_stagiaire,
        s.prenom_stagiaire,
        s.genre_stagiaire,
        s.fonction_stagiaire,
        s.mail_stagiaire,
        s.telephone_stagiaire,
        s.entreprise_id,
        s.user_id,
        s.photos,
        s.service_id,
        concat(SUBSTRING(s.nom_stagiaire, 1, 1),SUBSTRING(s.prenom_stagiaire, 1, 1)) as sans_photos,
        (s.departement_entreprises_id) departement_id,
        s.cin,
        niveau.id as niveau_etude_id,
        niveau.niveau_etude,
        s.date_naissance,
        (s.lot) adresse,
        s.activiter as activiter_stagiaire,
        s.branche_id,
        ifnull(d.nom_departement,' ') as nom_departement,
        ifnull(d.nom_service,' ') as nom_service,
        mf.reference,
        mf.nom_module,
        mf.nom_formation,
        mf.nom as nom_cfp,
        mf.cfp_id,
        mf.logo,
        case
            when g.status = 8 then 'Reprogrammer'
            when g.status = 7 then 'Annulée'
            when g.status = 6 then 'Reporté'
            when g.status = 5 then 'Cloturé'
            when g.status = 2 then
                case
                    when (g.date_fin - curdate()) < 0 then 'Terminé'
                    when (g.date_debut - curdate()) <= 0 then 'En cours'
                    else 'A venir' end
            when g.status = 1 then 'Prévisionnel'
            when g.status = 0 then 'Créer'end item_status_groupe,
        case
            when g.status = 8 then 'status_reprogrammer'
            when g.status = 7 then 'status_annulee'
            when g.status = 6 then 'status_reporter'
            when g.status = 5 then 'status_cloturer'
            when g.status = 2 then
                case
                    when (g.date_fin - curdate()) < 0 then 'status_termine'
                    when (g.date_debut - curdate()) < 0 then 'statut_active'
                    else 'status_confirme' end
            when g.status = 1 then 'status_grise'
            when g.status = 0 then 'Créer'end class_status_groupe
    from
        participant_groupe p
    join
        groupes g
    on g.id = p.groupe_id
    join
        stagiaires s
        on s.id = p.stagiaire_id
    left join v_departement_service_entreprise d
        on s.service_id = d.service_id
    join moduleformation mf
        on mf.module_id = g.module_id
    join niveau_etude niveau
        on niveau.id = s.niveau_etude_id order by groupe_id desc;


create or replace view v_stagiaire_notstatut_eval as
    select *,
    case when groupe_id not in(select groupe_id from reponse_evaluationchaud) then 0 else 1 end statut_eval
    from v_stagiaire_groupe order by date_debut desc
