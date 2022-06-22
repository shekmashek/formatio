-- create  or REPLACE view v_projet as
-- select
-- projets.*,
-- entreprises.nom_etp
-- from projets,entreprises
-- where
-- entreprise_id= entreprises.id;

-- create or REPLACE view v_entreprise_par_projet as
-- select
-- cfp_id,
-- entreprise_id,
-- nom_etp,
-- id as projet_id
-- from v_projet
-- group by
-- cfp_id,
-- entreprise_id,
-- nom_etp,
-- id;



create or replace view v_groupe_projet_entreprise as
    select g.id as groupe_id,g.max_participant,g.min_participant,g.nom_groupe,g.module_id,
    g.date_debut,g.date_fin,g.status as status_groupe,g.activiter as activiter_groupe,vpe.*
    from groupes g join v_projet_entreprise vpe on g.projet_id = vpe.projet_id;


create or replace view v_stagiaire_groupe as
select g.id as groupe_id,
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
        (s.service_id) departement_id,
        s.cin,
        s.date_naissance,
        (s.lot) adresse,
        s.niveau_etude,
        s.activiter as activiter_stagiaire,
        s.branche_id
    from
        participant_groupe p
    join
        groupes g
    on g.id = p.groupe_id
    join
        stagiaires s
        on s.id = p.stagiaire_id;

create or replace view  v_responsable_entreprise as
    select r.id as responsable_id,
        r.nom_resp,
        r.prenom_resp,
        r.fonction_resp,
        r.email_resp,
        r.cin_resp,
        r.telephone_resp,
        r.user_id as user_id_responsable,
        r.photos,
        r.entreprise_id as entreprise_id_responsable,
        r.activiter as activiter_responsable,
        r.user_id,
        r.prioriter,
        e.id as entreprise_id,
        e.nom_etp,
        e.adresse_rue as adresse_etp,
        e.logo as logo_entreprise,
        e.nif as nif_etp,
        e.stat as stat_etp,
        e.rcs as rcs_etp,
        e.cif as cif_etp,
        e.secteur_id as secteur_id_etp,
        e.email_etp,
        e.site_etp,
        e.activiter as activiter_etp,
        e.telephone_etp
        from responsables r
        join
            entreprises e on e.id = r.entreprise_id;


create or replace view v_detail_presence as
    select d.id as detail_id,
        d.lieu,
        d.h_debut,
        d.h_fin,
        d.date_detail,
        d.formateur_id,
        d.groupe_id,
        d.projet_id,
        d.cfp_id,
        p.status,
        p.stagiaire_id,
        p.h_entree,
        p.h_sortie,
        case when p.status = 0 then 'Absent'
             when p.status = 1 then 'Présent'
        end as text_status,
        case when p.status = 0 then '#ff0000'
             when p.status = 1 then '#00ff00'
        end as color_status
    from details d join presences p on d.id = p.detail_id order by p.stagiaire_id asc;


