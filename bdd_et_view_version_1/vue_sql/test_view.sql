

    select
        g.status as status_groupe,
        g.date_debut,
        g.date_fin,
        case
            when g.status = 2 then
                case
                    when (g.date_fin - curdate()) < 0 then 'Terminé'
                    when (g.date_debut - curdate()) < 0 then 'En cours'
                    else 'A venir' end
            when g.status = 1 then 'Prévisionnel'
            when g.status = 0 then 'Créer'end item_status_groupe,
        case
            when g.status = 2 then
                case
                    when (g.date_fin - curdate()) < 0 then 'status_termine'
                    when (g.date_debut - curdate()) < 0 then 'statut_active'
                    else 'status_confirme' end
            when g.status = 1 then 'status_grise'
            when g.status = 0 then 'Créer'end class_status_groupe
    from groupes g
select * from v_projet_session  order by date_projet desc limit 0,3

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
        f.photos,
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


select concat(SUBSTRING(nom_formateur, 1, 1),SUBSTRING(prenom_formateur, 1, 1)) as sans_photo from formateurs;


CREATE OR REPLACE VIEW v_demmande_etp_cfp AS
SELECT
    d.activiter AS activiter_demande,
    c.id AS cfp_id,
    c.nom,
    c.adresse_lot,
    c.adresse_ville,
    c.adresse_region,
    c.email,
    c.telephone,
    c.slogan,
    c.nif AS nif_cfp,
    c.stat AS stat_cfp,
    c.rcs AS rcs_cfp,
    c.cif AS cif_cfp,
    c.logo AS logo_cfp,
    c.specialisation AS specialisation,
    c.presentation AS presentation,
    c.activiter AS activiter_cfp,
    c.site_web,
    e.id AS entreprise_id,
    e.nom_etp,
    (e.adresse_rue) adresse,
    e.logo AS logo_etp,
    e.nif AS nif_etp,
    e.stat AS stat_etp,
    e.cif AS cif_etp,
    e.rcs AS rcs_etp,
    e.secteur_id,
    se.nom_secteur,
    e.email_etp,
    e.site_etp,
    e.activiter AS activer_etp,
    e.telephone_etp,
    r.
FROM
    demmande_etp_cfp d
JOIN cfps c ON
    d.inviter_cfp_id = c.id
JOIN entreprises e ON
    d.demmandeur_etp_id = e.id
JOIN secteurs se ON
    e.secteur_id = se.id
join responsables r on
    r.entreprise_id = e.id
WHERE
    d.activiter = 1;

select count(id) as nb_detail,sum(TIME_TO_SEC(h_fin) - TIME_TO_SEC(h_debut)) as difference from details where groupe_id = 27;


create table test_json(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  personne varchar(50) NOT NULL,
  adresse json
);
insert into test_json(id, personne, adresse) values(1,'Vonjy','{"lot":"LOT III 3 D","Ville":"Imeritsiatosika","Province":"Analamanga"}');

select personne,JSON_VALUE(adresse,'$.lot') as lot,JSON_VALUE(adresse,'$.Ville') as ville from test_json;
