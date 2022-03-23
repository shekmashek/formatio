create or replace  view v_responsable_cfp as SELECT
    responsables_cfp.*,
    genre.genre,
    (cfps.nom) nom_cfp,
    (cfps.logo) logo_cfp
FROM
    responsables_cfp,
    cfps,
    genre
WHERE
    responsables_cfp.sexe_resp_cfp = genre.id and
    responsables_cfp.cfp_id = cfps.id;