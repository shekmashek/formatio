
/* Modification v_participant_groupe_detail(suiviformation view 4.0) 

    recopier v_participant_groupe_detail dans suiviformation view 4.0 ou ce script
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

/* Modification v_stagiaire_groupe(suiviformation view 4.0)  
    recopier v_stagiaire_groupe dans suiviformation view 4.0 ou ce script
*/

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
        concat(SUBSTRING(s.nom_stagiaire, 1, 1),SUBSTRING(s.prenom_stagiaire, 1, 1)) as sans_photos,
        (s.service_id) departement_id,
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
        mf.logo
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