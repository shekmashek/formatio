CREATE OR REPLACE VIEW v_departement_service_entreprise AS SELECT
    etp.id as entreprise_id,
    etp.nom_etp,
    dep.nom_departement,
    serv.nom_service
FROM
    departement_entreprises dep,
    entreprises etp,
    services serv
WHERE
    dep.entreprise_id = etp.id AND
    serv.departement_entreprise_id = dep.id;

select * GROUP_CONCAT('nom_service') as nom_service from v_departement_service_entreprise 


SELECT `nom_departement`, GROUP_CONCAT(`nom_service`) AS service
FROM `v_departement_service_entreprise` 
GROUP BY `nom_departement`