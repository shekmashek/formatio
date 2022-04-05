
create or replace view v_horaire_cfp as
    select
        h.*,
        (cfps.nom) nom_cfp,
        (cfps.adresse_lot) adresse_lot_cfp,
        (cfps.adresse_quartier) adresse_quartier_cfp,
        (cfps.adresse_ville) adresse_ville_cfp,
        (cfps.adresse_region) adresse_region_cfp,
        (cfps.adresse_code_postal) adresse_code_postal_cfp,
        (cfps.email) mail_cfp,
        (cfps.telephone) tel_cfp,
        (cfps.slogan) slogan,
        (cfps.presentation) presentation,
        (cfps.logo) logo_cfp,
        (cfps.specialisation) specialisation,
        (cfps.site_web) site_web
    from horaires h
    join cfps on cfps.id = h.cfp_id;

    create or replace view v_reseaux_sociaux_cfp as
    select
        rs.lien_facebook,
        rs.lien_twitter,
        rs.lien_instagram,
        rs.lien_linkedin,
        rs.cfp_id,
        (cfps.nom) nom_cfp,
        (cfps.adresse_lot) adresse_lot_cfp,
        (cfps.adresse_quartier) adresse_quartier_cfp,
        (cfps.adresse_ville) adresse_ville_cfp,
        (cfps.adresse_region) adresse_region_cfp,
        (cfps.adresse_code_postal) adresse_code_postal_cfp,
        (cfps.email) mail_cfp,
        (cfps.telephone) tel_cfp,
        (cfps.slogan) slogan,
        (cfps.presentation) presentation,
        (cfps.logo) logo_cfp,
        (cfps.specialisation) specialisation,
        (cfps.site_web) site_web
    from cfps
    join reseaux_sociaux rs on rs.cfp_id = cfps.id;

