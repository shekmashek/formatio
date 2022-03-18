CREATE OR REPLACE VIEW v_departement_service_entreprise AS SELECT
     dep.id as departement_entreprise_id,
    serv.id as service_id,
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


CREATE OR REPLACE VIEW v_chef_departement_entreprise AS SELECT
    chef_etp.departement_entreprise_id as departement_id,
    dep.nom_departement as departement,
    dep.entreprise_id as entreprise_id,
    chef.id as chef_id,
    chef.nom_chef,
    chef.prenom_chef,
    chef.genre_chef,
    chef.fonction_chef,
    chef.mail_chef,
    chef.telephone_chef,
    chef.cin_chef,
    chef.photos,
    chef_etp.id as chef_etp_id
FROM
    chef_departements chef,
    chef_dep_entreprises chef_etp,
    departement_entreprises dep
WHERE
    chef.id = chef_etp.chef_departement_id
AND
    dep.id = chef_etp.departement_entreprise_id;

