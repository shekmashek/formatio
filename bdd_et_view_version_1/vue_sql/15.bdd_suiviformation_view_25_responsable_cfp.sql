
create or replace  view v_responsable_cfp as SELECT
    responsables_cfp.*,
    cfps.slogan,
    cfps.nif,
    cfps.stat,
    cfps.rcs,
    cfps.cif,
    genre.genre,
    (cfps.nom) nom_cfp,
    (cfps.adresse_lot) adresse_lot_cfp,
    (cfps.adresse_quartier) adresse_quartier_cfp,
    (cfps.adresse_code_postal) adresse_code_postal_cfp,
    (cfps.adresse_ville) adresse_ville_cfp,
    (cfps.adresse_region) adresse_region_cfp,
    cfps.logo,
    cfps.site_web

FROM
    responsables_cfp
JOIN cfps ON  responsables_cfp.cfp_id = cfps.id
LEFT JOIN genre ON  responsables_cfp.sexe_resp_cfp = genre.id