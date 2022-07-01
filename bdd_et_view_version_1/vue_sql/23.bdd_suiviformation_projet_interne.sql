create or replace view v_detail_session_interne as
    select
        d.id AS detail_id,
        d.lieu,
        d.h_debut,
        d.h_fin,
        d.date_detail,
        d.formateur_interne_id formateur_id,
        d.projet_interne_id as projet_id,
        d.groupe_interne_id as groupe_id,
        g.nom_groupe,
        g.module_interne_id as module_id,
        g.date_debut,
        g.date_fin,
        g.status as status_groupe,
        g.activiter as activiter_groupe,
        m.reference,
        m.nom_module,
        m.formation_id,
        f.photos,
        concat(SUBSTRING(nom_formateur, 1, 1),SUBSTRING(prenom_formateur, 1, 1)) as sans_photos,
        f.nom_formateur,
        f.prenom_formateur,
        f.mail_formateur,
        f.numero_formateur,
        p.nom_projet,
        p.type_formation_id,
        p.entreprise_id,
        tf.type_formation
    FROM
        details_interne d
    JOIN groupes_interne g ON
        d.groupe_interne_id = g.id
    JOIN modules_interne m ON
        m.id = g.module_interne_id
    JOIN formateurs f ON
        f.id = d.formateur_interne_id
    JOIN projets_interne p ON
        d.projet_interne_id = p.id
    join type_formations tf
        on tf.id = p.type_formation_id;


create or replace view v_groupe_entreprise_interne as
    select
        p.entreprise_id,
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
        g.id as groupe_id,
        g.nom_groupe,
        g.projet_interne_id as projet_id,
        g.module_interne_id as module_id,
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
        g.activiter as activiter_groupe
    from groupes_interne g
    join projets_interne p on g.projet_interne_id = p.id
    join entreprises e on p.entreprise_id = e.id;

create or replace view v_stagiaire_groupe_interne as
select
    p.id as participant_groupe_id,
    g.id as groupe_id,
    g.nom_groupe,
    g.projet_interne_id as projet_id,
    g.module_interne_id as module_id,
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
    mf.etp_id
from
    participant_groupe_interne p
join
    groupes_interne g
on g.id = p.groupe_interne_id
join stagiaires s
    on s.id = p.stagiaire_id
join modules_interne mf
    on mf.id = g.module_interne_id
join niveau_etude niveau
    on niveau.id = s.niveau_etude_id order by groupe_id desc;


create or replace view v_detail_presence_interne as
    select d.id as detail_id,
        d.lieu,
        d.h_debut,
        d.h_fin,
        d.date_detail,
        d.formateur_interne_id as formateur_id,
        d.groupe_interne_id as groupe_id,
        d.projet_interne_id as projet_id,
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
    from details_interne d join presences_interne p on d.id = p.detail_interne_id order by p.stagiaire_id asc;


create or replace view v_detail_presence_stagiaire_interne as
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
    from v_detail_presence_interne dp
    join employers stg on dp.stagiaire_id = stg.id;


CREATE OR REPLACE view formateurs_interne as
SELECT
    employers.id as formateur_id,
    employers.entreprise_id,
    (employers.matricule_emp) matricule,
    (employers.nom_emp) nom_formateur,
    (employers.prenom_emp) prenom_formateur,
    employers.genre_id,
    (genre.genre) genre_formateur,
    (employers.fonction_emp) fonction_formateur,
    employers.poste_emp,
    (employers.email_emp) mail_formateur,
    (employers.telephone_emp) telephone_formateur,
    employers.user_id,
    (employers.prioriter) prioriter_emp,
    employers.service_id,
    vd.nom_service,
    employers.branche_id,
    url_photo,
    employers.departement_entreprises_id,
     vd.nom_departement,
    employers.photos,
    (employers.cin_emp) cin,
    (employers.date_naissance_emp) date_naissance,
    employers.activiter,
    (employers.adresse_quartier) quartier,
    (employers.adresse_code_postal) code_postal,
    (employers.adresse_ville) ville,
    (employers.adresse_region) region,
    (employers.adresse_lot) lot,
    bc.nom_branche,
    role_users.role_id,
    role_users.prioriter,
employers.created_at,
employers.updated_at,
niveau_etude_id,
niveau_etude.niveau_etude
FROM employers
LEFT JOIN v_departement_service_entreprise vd ON vd.service_id = employers.service_id and vd.departement_entreprise_id = employers.departement_entreprises_id
LEFT JOIN branches bc ON bc.id = employers.branche_id
JOIN role_users ON role_users.user_id =  employers.user_id
JOIN genre ON genre.id = employers.genre_id
JOIN niveau_etude ON niveau_etude.id = employers.niveau_etude_id
WHERE role_users.role_id=8;

create or replace view v_participant_groupe_detail_interne as
    select
        sg.*,
        d.id as detail_id,
        d.lieu,
        d.date_detail,
        d.h_debut,
        d.h_fin,
        d.formateur_interne_id as formateur_id,
        f.mail_formateur,
        f.telephone_formateur,
        f.nom_formateur,
        f.prenom_formateur
    from v_stagiaire_groupe_interne sg
    join details_interne d on sg.groupe_id = d.groupe_interne_id
    join formateurs_interne f on f.formateur_id = d.formateur_interne_id;

create or replace view v_emargement_interne as
    select
        pgd.*,
        ifnull(dps.text_status,"non") as text_status,
        ifnull(dps.color_status,"non") as color_status
    from v_participant_groupe_detail_interne pgd
    left join v_detail_presence_stagiaire_interne dps
    on pgd.detail_id = dps.detail_id
    and pgd.stagiaire_id = dps.stagiaire_id;