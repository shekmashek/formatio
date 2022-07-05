-- Active: 1656400043423@@127.0.0.1@3306@bdd_nicole



create or replace view v_chef_departement_entreprise as
SELECT

    departement_entreprises.entreprise_id,
    (chef_departements.id) chef_departements_id,
    chef_departements.nom_chef,
    chef_departements.prenom_chef,
    (chef_departements.user_id) user_id_chef_departement,
    departement_entreprises.id,
    departement_entreprises.nom_departement
FROM
    departement_entreprises
LEFT JOIN   chef_departements on  chef_departements.entreprise_id =  departement_entreprises.entreprise_id
and chef_departements.departement_entreprises_id = departement_entreprises.id;

create or replace view v_chef_de_service_entreprise as
SELECT
    services.departement_entreprise_id,
    services.id,
    services.nom_service,
    services.entreprise_id,
    departement_entreprises.nom_departement,
    (employers.id) chef_services_id,
    employers.nom_emp nom_chef,
    employers.prenom_emp prenom_chef,
    (employers.user_id) user_id
FROM
    services
JOIN departement_entreprises on departement_entreprises.id = services.departement_entreprise_id
left JOIN chef_de_service_entreprises on  services.id =  chef_de_service_entreprises.service_id
left JOIN employers on  chef_de_service_entreprises.chef_de_service_id =  employers.id