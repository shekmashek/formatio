create or replace  view v_responsable_cfp as SELECT
    responsables_cfp.*,
    cfps.slogan,
    cfps.nif,
    cfps.stat,
    cfps.rcs,
    cfps.cif,
    genre.genre,
    (cfps.nom) nom_cfp,
    (cfps.logo) logo_cfp
FROM
    responsables_cfp
JOIN cfps ON  responsables_cfp.cfp_id = cfps.id
LEFT JOIN genre ON  responsables_cfp.sexe_resp_cfp = genre.id