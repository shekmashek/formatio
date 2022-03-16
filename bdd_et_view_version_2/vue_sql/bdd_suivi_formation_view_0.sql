create or replace view v_user_role as
    select
        rl_usr.user_id,
        rl_usr.role_id,
        rl_usr.activiter,
        usr.name,
        usr.email,
        usr.cin,
        usr.telephone,
        rl.role_name,
        rl.role_description
    from users as usr,roles as rl, role_users as rl_usr
    where rl_usr.user_id = usr.id and rl_usr.role_id = rl.id

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