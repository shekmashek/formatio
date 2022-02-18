create or replace  view v_responsable_cfp as SELECT
    responsables_cfp.*,
    (cfps.nom) nom_cfp
FROM
    responsables_cfp,
    cfps
WHERE
    responsables_cfp.cfp_id = cfps.id;