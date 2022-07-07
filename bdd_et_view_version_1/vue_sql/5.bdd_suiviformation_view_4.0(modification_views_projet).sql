
create or replace view v_projet_session as
    select
        p.id as projet_id,
        p.nom_projet,
        p.cfp_id,
        p.type_formation_id,
        p.status as status_projet,
        p.activiter as activiter_projet,
        p.created_at as date_projet,
        tf.type_formation,
        cfps.nom as nom_cfp,
        cfps.adresse_ville as adresse_ville_cfp,
        cfps.adresse_lot as adresse_lot_cfp,
        cfps.adresse_region as adresse_region_cfp,
        cfps.email as mail_cfp,
        cfps.telephone as tel_cfp,
        cfps.slogan,
        cfps.nif as nif_cfp,
        cfps.stat as stat_cfp,
        cfps.rcs as rcs_cfp,
        cfps.cif as cif_cfp,
        cfps.logo as logo_cfp,
        cfps.specialisation as specialisation,
        ts.totale_session
    from projets p
    join type_formations tf on p.type_formation_id = tf.id
    join cfps on p.cfp_id = cfps.id
    join v_totale_session ts on ts.projet_id = p.id;


create or replace view v_groupe_entreprise as
    select
        ge.id as groupe_entreprise_id,
        ge.groupe_id,
        ge.entreprise_id,
        e.nom_etp,
        e.adresse_rue,
        e.adresse_quartier,
        e.adresse_code_postal,
        e.adresse_ville,
        e.adresse_region,
        e.logo,
        e.nif,
        e.stat,
        e.rcs,
        e.cif,
        e.secteur_id,
        e.email_etp,
        e.site_etp,
        (e.activiter) activiter_etp,
        e.telephone_etp,
        g.max_participant,
        g.min_participant,
        g.nom_groupe,
        g.projet_id,
        g.module_id,
        g.date_debut,
        g.date_fin,
        g.modalite,
        g.status as status_groupe,
       
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
            when g.status = 0 then 'Créer'end class_status_groupe,
        g.activiter as activiter_groupe,
        g.type_payement_id,
        tp.type as type_payement
    from groupe_entreprises ge
    join groupes g on ge.groupe_id = g.id
    join entreprises e on ge.entreprise_id = e.id
    join type_payement tp on g.type_payement_id = tp.id;

create or replace view v_groupe_projet_entreprise as
    select
        p.nom_projet,
        p.type_formation_id,
        p.cfp_id,
        p.created_at as date_projet,
        p.status as status_projet,
        p.activiter as activiter_projet,
        tf.type_formation,
        vpe.*,
        m.reference,
        m.nom_module,
        (cfps.nom) nom_cfp,
        (cfps.adresse_lot) adresse_lot_cfp,
        (cfps.adresse_ville) adresse_ville_cfp,
        (cfps.adresse_region) adresse_region_cfp,
        (cfps.email) mail_cfp,
        (cfps.telephone) tel_cfp,
        cfps.slogan,
        (cfps.nif) nif_cfp,
        (cfps.stat) stat_cfp,
        (cfps.rcs) rcs_cfp,
        (cfps.cif) cif_cfp,
        (cfps.logo) logo_cfp,
        cfps.site_web,
        (cfps.specialisation) specialisation
    from projets p
    join v_groupe_entreprise vpe on p.id = vpe.projet_id
    join modules m on m.id = vpe.module_id
    join type_formations tf on p.type_formation_id = tf.id
    join cfps on cfps.id = p.cfp_id;


create or replace view v_groupe_projet_module as
    select
        p.nom_projet,
        p.type_formation_id,
        p.cfp_id,
        p.created_at as date_projet,
        p.status as status_projet,
        p.activiter as activiter_projet,
        tf.type_formation,
        (cfps.nom) nom_cfp,
        (cfps.adresse_lot) adresse_lot_cfp,
        (cfps.adresse_ville) adresse_ville_cfp,
        (cfps.adresse_region) adresse_region_cfp,
        (cfps.email) mail_cfp,
        (cfps.telephone) tel_cfp,
        cfps.slogan,
        (cfps.nif) nif_cfp,
        (cfps.stat) stat_cfp,
        (cfps.rcs) rcs_cfp,
        (cfps.cif) cif_cfp,
        (cfps.logo) logo_cfp,
        cfps.site_web,
        g.id as groupe_id,
        g.max_participant,
        g.min_participant,
        g.nom_groupe,
        g.projet_id,
        g.module_id,
        g.date_debut,
        g.date_fin,
        g.status as status_groupe,
        g.modalite,
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
            when g.status = 0 then 'Créer'end class_status_groupe,
        g.activiter as activiter_groupe,
        g.type_payement_id,
        mf.reference,
        mf.nom_module,
        mf.prix,
        mf.duree,
        mf.modalite_formation,
        mf.duree_jour,
        mf.objectif,
        mf.prerequis,
        mf.description,
        mf.materiel_necessaire,
        mf.cible,
        mf.niveau_id,
        mf.niveau,
        mf.formation_id,
        mf.nom_formation,
        mf.domaine_id,
        mf.nom,
        mf.email,
        mf.telephone,
        mf.pourcentage,
        tp.type,
        (g_etp.id) groupe_entreprise_id,
        g_etp.entreprise_id
    from groupes g
    join moduleformation mf on mf.module_id = g.module_id
    join projets p on p.id = g.projet_id
    join type_formations tf on p.type_formation_id = tf.id
    join cfps on cfps.id = p.cfp_id
    join type_payement tp on tp.id = g.type_payement_id
    left join groupe_entreprises g_etp on g.id = g_etp.groupe_id;


create or replace view v_groupe_projet_entreprise_module as
    select
        vgpe.*,
        mf.prix,
        mf.duree,
        mf.modalite_formation,
        mf.duree_jour,
        mf.objectif,
        mf.prerequis,
        mf.description,
        mf.materiel_necessaire,
        mf.cible,
        mf.niveau_id,
        mf.niveau,
        mf.formation_id,
        mf.nom_formation,
        mf.domaine_id,
        mf.nom,
        mf.email,
        mf.telephone,
        mf.pourcentage,
        d.nom_domaine
    from
        v_groupe_projet_entreprise vgpe
    join moduleformation mf on vgpe.module_id = mf.module_id
    join domaines d on d.id = mf.domaine_id;

CREATE OR REPLACE VIEW v_detailmodule AS
    SELECT
        d.id AS detail_id,
        d.lieu,
        d.h_debut,
        d.h_fin,
        d.date_detail,
        d.formateur_id,
        d.projet_id,
        d.groupe_id,
        d.cfp_id,
        g.max_participant,
        g.min_participant,
        g.nom_groupe,
        g.module_id,
        g.date_debut,
        g.date_fin,
        g.status_groupe,
        g.activiter_groupe,
        g.logo as logo_entreprise,
        g.entreprise_id,
        g.nom_etp,
        mf.formation_id,
        dom.id as id_domaine,
        dom.nom_domaine,
        mf.nom_formation,
        f.nom_formateur,
        f.prenom_formateur,
        f.mail_formateur,
        f.numero_formateur,
        f.photos,
        concat(SUBSTRING(nom_formateur, 1, 1),SUBSTRING(prenom_formateur, 1, 1)) as sans_photos,
        p.nom_projet,
        (c.nom) nom_cfp,
        c.logo as logo_cfp,
        p.type_formation_id,
        tf.type_formation
    FROM
        details d
    JOIN v_groupe_projet_entreprise g ON
        d.groupe_id = g.groupe_id
    JOIN moduleformation mf ON
        mf.module_id = g.module_id
    JOIN formateurs f ON
        f.id = d.formateur_id
    JOIN projets p ON
        d.projet_id = p.id
    JOIN cfps c ON
        p.cfp_id = c.id
    JOIN domaines dom ON
        mf.domaine_id = dom.id
    join type_formations tf
        on tf.id = p.type_formation_id
    GROUP BY
    d.id,
    d.lieu,
    d.h_debut,
    d.h_fin,
    d.date_detail,
    d.formateur_id,
    d.projet_id,
    d.groupe_id,
    d.cfp_id,
    g.max_participant,
    g.min_participant,
    g.nom_groupe,
    g.module_id,
    g.date_debut,
    g.date_fin,
    g.status_groupe,
    g.activiter_groupe,
    g.logo,
    g.entreprise_id,
    g.nom_etp,
    g.reference,
    g.nom_module,
    mf.formation_id,
    dom.id,
    dom.nom_domaine,
    mf.nom_formation,
    f.nom_formateur,
    f.prenom_formateur,
    f.mail_formateur,
    f.numero_formateur,
    f.photos,
    p.nom_projet,
    c.nom,
    c.logo,
    p.type_formation_id,
    tf.type_formation
    ;


create or replace view v_detail_session as
    select
        d.id AS detail_id,
        d.lieu,
        d.h_debut,
        d.h_fin,
        d.date_detail,
        d.formateur_id,
        d.projet_id,
        d.groupe_id,
        d.cfp_id,
        g.max_participant,
        g.min_participant,
        g.nom_groupe,
        g.module_id,
        g.date_debut,
        g.date_fin,
        g.status as status_groupe,
        g.activiter as activiter_groupe,
        mf.reference,
        mf.nom_module,
        mf.formation_id,
        dom.id as id_domaine,
        dom.nom_domaine,
        mf.nom_formation,
        f.photos,
        concat(SUBSTRING(nom_formateur, 1, 1),SUBSTRING(prenom_formateur, 1, 1)) as sans_photos,
        f.nom_formateur,
        f.prenom_formateur,
        f.mail_formateur,
        f.numero_formateur,
        p.nom_projet,
        (c.nom) nom_cfp,
        p.type_formation_id,
        tf.type_formation
    FROM
        details d
    JOIN groupes g ON
        d.groupe_id = g.id
    JOIN moduleformation mf ON
        mf.module_id = g.module_id
    JOIN formateurs f ON
        f.id = d.formateur_id
    JOIN projets p ON
        d.projet_id = p.id
    JOIN cfps c ON
        p.cfp_id = c.id
    JOIN domaines dom ON
        mf.domaine_id = dom.id
    join type_formations tf
        on tf.id = p.type_formation_id;


CREATE OR REPLACE VIEW v_participant_groupe AS
    SELECT
        dm.*,
        pg.stagiaire_id,
        s.matricule_emp as matricule,
        s.nom_emp as nom_stagiaire,
        s.prenom_emp as prenom_stagiaire,
        s.genre_id as genre_stagiaire,
        s.fonction_emp as fonction_stagiaire,
        s.email_emp as mail_stagiaire,
        s.telephone_emp as telephone_stagiaire,
        s.user_id AS user_id_stagiaire,
        s.service_id as departement_id,
        s.cin_emp as cin,
        s.date_naissance_emp as date_naissance,
        (s.adresse_lot) adresse,
        s.niveau_etude_id,
        s.activiter AS activiter_stagiaire,
        s.branche_id
    FROM
        participant_groupe pg
    JOIN v_detailmodule dm ON
        pg.groupe_id = dm.groupe_id
    JOIN employers s ON
        s.id = pg.stagiaire_id;



create or replace view v_projet_cfp as
    select
        p.id as projet_id,
        p.nom_projet,
        p.cfp_id,
        p.type_formation_id,
        p.status,
        p.activiter as activiter_projet,
        p.created_at as date_projet,
        (cfps.nom) nom_cfp,
        (cfps.adresse_lot) adresse_lot_cfp,
        (cfps.adresse_ville) adresse_ville_cfp,
        (cfps.adresse_region) adresse_region_cfp,
        (cfps.email) mail_cfp,
        (cfps.telephone) tel_cfp,
        cfps.slogan as domaine_de_formation_cfp,
        (cfps.nif) nif_cfp,
        (cfps.stat) stat_cfp,
        (cfps.rcs) rcs_cfp,
        (cfps.cif) cif_cfp,
        (cfps.logo) logo_cfp,
        (cfps.specialisation) specialisation,
        tf.type_formation
    from projets p
    join cfps on cfps.id = p.cfp_id
    join type_formations tf on tf.id = p.type_formation_id;




create or replace view v_stagiaire_groupe as
select
        p.id as participant_groupe_id,
        pr.type_formation_id,
        g.id as groupe_id,
        g.max_participant,
        g.min_participant,
        g.nom_groupe,
        g.projet_id,
        g.module_id,
        g.date_debut,
        g.date_fin,
        g.status,
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
        when g.status = 0 then 'Créer'end class_status_groupe,
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
        (s.departement_entreprises_id) departement_id,
        s.cin,
        niveau.id as niveau_etude_id,
        niveau.niveau_etude,
        s.date_naissance,
        (s.lot) adresse,
        s.activiter as activiter_stagiaire,
        s.branche_id,
        ifnull(s.nom_departement,' ') as nom_departement,
        ifnull(s.nom_service,' ') as nom_service,
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
    join projets pr on g.projet_id = pr.id
    join
        stagiaires s
        on s.id = p.stagiaire_id
    join moduleformation mf
        on mf.module_id = g.module_id
    join niveau_etude niveau
        on niveau.id = s.niveau_etude_id order by groupe_id desc;


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
             when p.status = 1 then '#7635dc'
        end as color_status,
        p.note
    from details d join presences p on d.id = p.detail_id order by p.stagiaire_id asc;




-- CREATE OR REPLACE VIEW v_stagiaire_entreprise AS
-- SELECT
--     stg.id AS stagiaire_id,
--     stg.matricule,
--     stg.nom_stagiaire,
--     stg.prenom_stagiaire,
--     stg.genre_stagiaire,
--     stg.titre,
--     stg.fonction_stagiaire,
--     stg.mail_stagiaire,
--     stg.telephone_stagiaire,
--     stg.user_id,
--     stg.photos,
--     stg.cin,
--     stg.date_naissance,
--     stg.niveau_etude_id,
--     stg.activiter,
--     stg.branche_id,
--     stg.quartier,
--     stg.code_postal,
--     stg.ville,
--     stg.region,
--     stg.lot,
--     e.nom_etp,
--     e.adresse_rue,
--     e.adresse_quartier,
--     e.adresse_code_postal,
--     e.adresse_ville,
--     e.adresse_region,
--     e.logo,
--     e.nif,
--     e.stat,
--     e.rcs,
--     e.cif,
--     e.secteur_id,
--     e.email_etp,
--     e.site_etp,
--     (e.activiter) activiter_etp,
--     e.telephone_etp,
--     ds.*
-- FROM
--     stagiaires as stg
--     join entreprises e
--     on stg.entreprise_id = e.id
--     join v_departement_service_entreprise ds
--     on ds.service_id = stg.service_id;




create or replace view v_detail_presence_stagiaire as
    select
        dp.*,
        stg.matricule_emp as matricule,
        stg.nom_emp as nom_stagiaire,
        stg.prenom_emp as prenom_stagiaire,
        stg.genre_id as genre_stagiaire,
        stg.fonction_emp as fonction_stagiaire,
        stg.email_emp as mail_stagiaire,
        stg.telephone_emp as telephone_stagiaire,
        stg.user_id,
        stg.photos,
        stg.cin_emp as cin,
        stg.date_naissance_emp as date_naissance,
        stg.activiter,
        stg.branche_id,
        stg.adresse_quartier as quartier,
        stg.adresse_code_postal as code_postal,
        stg.adresse_ville as ville,
        stg.adresse_region as region,
        stg.adresse_lot as lot
    from v_detail_presence dp
    join employers stg on dp.stagiaire_id = stg.id;


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

create or replace view v_emargement as
    select
        pgd.*,
        ifnull(dps.text_status,"non") as text_status,
        ifnull(dps.color_status,"non") as color_status
    from v_participant_groupe_detail pgd
    left join v_detail_presence_stagiaire dps
    on pgd.detail_id = dps.detail_id
    and pgd.stagiaire_id = dps.stagiaire_id;

create or replace view v_projet_session_inter as
    select
        p.nom_projet,
        p.cfp_id,
        p.type_formation_id,
        tf.type_formation,
        p.status as status_projet,
        p.activiter as activiter_projet,
        p.created_at as date_projet,
        g.projet_id,
        g.id as groupe_id,
        g.min_participant,
        g.max_participant,
        g.nom_groupe,
        g.module_id,
        g.type_payement_id,
        g.date_debut,
        g.date_fin,
        g.status as status_groupe,
        g.activiter as activiter_groupe,
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
            when g.status = 0 then 'Créer'end class_status_groupe,
        (cfps.nom) nom_cfp,
        (cfps.adresse_lot) adresse_lot_cfp,
        (cfps.adresse_ville) adresse_ville_cfp,
        (cfps.adresse_region) adresse_region_cfp,
        (cfps.email) mail_cfp,
        (cfps.telephone) tel_cfp,
        cfps.slogan as domaine_de_formation_cfp,
        (cfps.nif) nif_cfp,
        (cfps.stat) stat_cfp,
        (cfps.rcs) rcs_cfp,
        (cfps.cif) cif_cfp,
        (cfps.logo) logo_cfp,
        (cfps.specialisation) specialisation
    from groupes g join projets p on g.projet_id = p.id
    join type_formations tf on tf.id = p.type_formation_id
    join cfps on cfps.id = p.cfp_id;


create or replace view v_formateur_projet as
    select
        f.formateur_id,
        f.nom_formateur,
        f.prenom_formateur,
        f.mail_formateur,
        f.numero_formateur,
        f.photos,
        f.genre,
        f.date_naissance,
        f.adresse,
        f.cin,
        f.specialite,
        d.groupe_id
    from
        v_demmande_cfp_formateur f join details d on f.formateur_id = d.formateur_id
    group by
        f.formateur_id,
        f.nom_formateur,
        f.prenom_formateur,
        f.mail_formateur,
        f.numero_formateur,
        f.photos,
        f.genre,
        f.date_naissance,
        f.adresse,
        f.cin,
        f.specialite,
        d.groupe_id;


-- create or replace view v_programme_detail_activiter as
-- select
--         v_detailmodule.*,cours_id,titre_cours,programme_id,titre_programme
-- from
--     v_detailmodule,v_detail_cour
-- where
--     v_detailmodule.detail_id = v_detail_cour.detail_id;


create or replace view v_session_projet as
    select
        g.id as groupe_id,
        g.max_participant,
        g.min_participant,
        g.nom_groupe,
        g.projet_id,
        g.type_payement_id,
        g.date_debut,
        g.date_fin,
        g.status as status_groupe,
        g.activiter as activiter_groupe,
        p.nom_projet,
        p.type_formation_id,
        p.status as status_projet,
        p.created_at as date_projet,
        mf.*,
        c.adresse_lot,
        c.adresse_ville
    from
    groupes g join projets p
    on g.projet_id = p.id
    join moduleformation mf on mf.module_id = g.module_id
    join cfps c on mf.cfp_id = c.id;


-- create or replace view v_evaluation_apprenant as
-- select
--     (detail_evaluation_apprenants.id) id,v_stagiaire_groupe.*,note_avant,note_apres
-- from
--     v_stagiaire_groupe,detail_evaluation_apprenants
-- where
--     v_stagiaire_groupe.participant_groupe_id = detail_evaluation_apprenants.participant_groupe_id ;


create or replace view v_montant_session as
    select
        g.id as groupe_id,
        ifnull(count(pg.stagiaire_id),0) as nombre_stg,
        ifnull((mf.prix * count(pg.stagiaire_id)),0) as montant_session
    from groupes g
    left join participant_groupe pg
    on pg.groupe_id = g.id
    join moduleformation mf
    on mf.module_id = g.module_id
    group by g.id;



create or replace view v_projet_formateur as
    select
        gpm.*,
        fp.formateur_id
    from
        v_formateur_projet fp
    join
        v_groupe_projet_module gpm
    on gpm.groupe_id = fp.groupe_id;


create or replace view v_projet_formation as
    select
        projet_id,
        formation_id,
        nom_formation,
        cfp_id
    from v_groupe_projet_entreprise_module
    group by
        projet_id,
        formation_id,
        nom_formation,
        cfp_id;

-- select
--     g.projet_id,
--     p.nom_projet,
--     mf.formation_id,
--     mf.nom_formation,
--     p.cfp_id
-- from groupes g
-- join projets p on p.id = g.projet_id
-- join moduleformation mf on g.module_id = mf.module_id
-- group by
--     g.projet_id,
--     p.nom_projet,
--     mf.formation_id,
--     mf.nom_formation,
--     p.cfp_id;



select
    d.groupe_id,
    d.formateur_id,
    f.photos
from details d
join formateurs f on f.id = d.formateur_id
group by
    d.groupe_id,
    d.formateur_id,
    f.photos;

create or replace view v_presence_groupe as
    select
        p.detail_id,
        p.stagiaire_id,
        p.status,
        d.groupe_id
    from presences p
    join details d on d.id = p.detail_id;

