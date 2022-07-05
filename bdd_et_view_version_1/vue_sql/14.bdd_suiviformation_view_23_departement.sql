-- Active: 1656400043423@@127.0.0.1@3306@bdd_nicole
CREATE OR REPLACE VIEW v_chef_departement_entreprise AS SELECT
    dep.id as departement_id,
    dep.nom_departement as departement,
    dep.entreprise_id as entreprise_id,
    chef.id as chef_id,
    chef.nom_chef,
    chef.prenom_chef,
    chef.genre_id,
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
