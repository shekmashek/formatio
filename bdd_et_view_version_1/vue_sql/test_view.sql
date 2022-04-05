

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

