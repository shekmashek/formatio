
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
        g.status as status_groupe,
        case g.status
            when 0 then 'Créer'
            when 1 then 'Prévisionnel'
            when 2 then 'A venir'
            when 3 then 'En cours'
            when 4 then 'Terminé'
        end item_status_groupe,
        case g.status
            when 0 then 'Créer'
            when 1 then 'status_grise'
            when 2 then 'status_confirme'
            when 3 then 'statut_active'
            when 4 then 'status_termine'
        end class_status_groupe,
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
        case g.status
            when 0 then 'Créer'
            when 1 then 'Prévisionnel'
            when 2 then 'A venir'
            when 3 then 'En cours'
            when 4 then 'Terminé'
        end item_status_groupe,
        case g.status
            when 0 then 'Créer'
            when 1 then 'status_grise'
            when 2 then 'status_confirme'
            when 3 then 'statut_active'
            when 4 then 'status_termine'
        end class_status_groupe,
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
        mf.pourcentage
    from groupes g
    join moduleformation mf on mf.module_id = g.module_id
    join projets p on p.id = g.projet_id
    join type_formations tf on p.type_formation_id = tf.id
    join cfps on cfps.id = p.cfp_id;


create or replace view v_groupe_projet_entreprise_module as
    select
        vgpe.*,
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
        g.nom_etp,
        mf.reference,
        mf.nom_module,
        mf.formation_id,
        dom.id as id_domaine,
        dom.nom_domaine,
        mf.nom_formation,
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
    g.nom_etp,
    mf.reference,
    mf.nom_module,
    mf.formation_id,
    dom.id,
    dom.nom_domaine,
    mf.nom_formation,
    f.nom_formateur,
    f.prenom_formateur,
    f.mail_formateur,
    f.numero_formateur,
    p.nom_projet,
    c.nom,
    p.type_formation_id,
    tf.type_formation
    ;


CREATE OR REPLACE VIEW v_participant_groupe AS
    SELECT
        dm.*,
        pg.stagiaire_id,
        s.matricule,
        s.nom_stagiaire,
        s.prenom_stagiaire,
        s.genre_stagiaire,
        s.fonction_stagiaire,
        s.mail_stagiaire,
        s.telephone_stagiaire,
        s.user_id AS user_id_stagiaire,
        s.photos,
        s.service_id as departement_id,
        s.cin,
        s.date_naissance,
        (s.lot) adresse,
        s.niveau_etude,
        s.activiter AS activiter_stagiaire,
        s.branche_id
    FROM
        participant_groupe pg
    JOIN v_detailmodule dm ON
        pg.groupe_id = dm.groupe_id
    JOIN stagiaires s ON
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


create or replace view v_departement_service_entreprise as
    select
        s.id as service_id,
        s.departement_entreprise_id,
        s.nom_service,
        de.nom_departement,
        de.entreprise_id
    from services s
    join departement_entreprises de on s.departement_entreprise_id = de.id;


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
        (s.service_id) departement_id,
        s.cin,
        s.date_naissance,
        (s.lot) adresse,
        s.niveau_etude,
        s.activiter as activiter_stagiaire,
        s.branche_id,
        d.nom_departement,
        d.nom_service,
        mf.reference,
        mf.nom_module,
        mf.nom_formation,
        mf.nom as nom_cfp,
        mf.cfp_id
    from
        participant_groupe p
    join
        groupes g
    on g.id = p.groupe_id
    join
        stagiaires s
        on s.id = p.stagiaire_id
    join v_departement_service_entreprise d
        on s.service_id = d.service_id
    join moduleformation mf
        on mf.module_id = g.module_id;


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




CREATE OR REPLACE VIEW v_stagiaire_entreprise AS SELECT
    stg.id AS stagiaire_id,
    stg.matricule,
    stg.nom_stagiaire,
    stg.prenom_stagiaire,
    stg.genre_stagiaire,
    stg.titre,
    stg.fonction_stagiaire,
    stg.mail_stagiaire,
    stg.telephone_stagiaire,
    stg.user_id,
    stg.photos,
    stg.cin,
    stg.date_naissance,
    stg.niveau_etude,
    stg.activiter,
    stg.branche_id,
    stg.quartier,
    stg.code_postal,
    stg.ville,
    stg.region,
    stg.lot,
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
    ds.*
FROM
    stagiaires as stg
    join entreprises e
    on stg.entreprise_id = e.id
    join v_departement_service_entreprise ds
    on ds.service_id = stg.service_id;




create or replace view v_detail_presence_stagiaire as
    select
        dp.*,
        stg.matricule,
        stg.nom_stagiaire,
        stg.prenom_stagiaire,
        stg.genre_stagiaire,
        stg.titre,
        stg.fonction_stagiaire,
        stg.mail_stagiaire,
        stg.telephone_stagiaire,
        stg.user_id,
        stg.photos,
        stg.cin,
        stg.date_naissance,
        stg.niveau_etude,
        stg.activiter,
        stg.branche_id,
        stg.quartier,
        stg.code_postal,
        stg.ville,
        stg.region,
        stg.lot
    from v_detail_presence dp
    join stagiaires stg on dp.stagiaire_id = stg.id;


create or replace view v_participant_groupe_detail as
    select
        sg.*,
        d.id as detail_id,
        d.lieu,
        d.h_debut,
        d.h_fin,
        d.formateur_id,
        d.cfp_id
    from v_stagiaire_groupe sg
    join details d on sg.groupe_id = d.groupe_id;

create or replace view v_emargement as
    select
        pgd.*,
        ifnull(dps.text_status,"non") as text_status,
        ifnull(dps.color_status,"non") as color_status
    from v_participant_groupe_detail pgd
    left join v_detail_presence_stagiaire dps
    on pgd.detail_id = dps.detail_id
    and pgd.stagiaire_id = dps.stagiaire_id;


ALTER TABLE presences
ADD CONSTRAINT presence_stg_constraint UNIQUE (detail_id,stagiaire_id);



create or replace view v_projet_session_inter as
    select
        p.nom_projet,
        p.cfp_id,
        p.type_formation_id,
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
        case g.status
            when 0 then 'Créer'
            when 1 then 'Prévisionnel'
            when 2 then 'A venir'
            when 3 then 'En cours'
            when 4 then 'Terminé'
        end item_status_groupe,
        case g.status
            when 0 then 'Créer'
            when 1 then 'status_grise'
            when 2 then 'status_confirme'
            when 3 then 'statut_active'
            when 4 then 'status_termine'
        end class_status_groupe,
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
        f.niveau,
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
        f.niveau,
        d.groupe_id;


create or replace view v_programme_detail_activiter as
select
        v_detailmodule.*,cours_id,titre_cours,programme_id,titre_programme
from
    v_detailmodule,v_detail_cour
where
    v_detailmodule.detail_id = v_detail_cour.detail_id;


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
        mf.*
    from
    groupes g join projets p
    on g.projet_id = p.id
    join moduleformation mf on mf.module_id = g.module_id;


create or replace view v_evaluation_apprenant as
select
    (detail_evaluation_apprenants.id) id,v_stagiaire_groupe.*,note_avant,note_apres
from
    v_stagiaire_groupe,detail_evaluation_apprenants
where
    v_stagiaire_groupe.participant_groupe_id = detail_evaluation_apprenants.participant_groupe_id ;