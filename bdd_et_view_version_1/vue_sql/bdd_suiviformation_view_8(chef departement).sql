

create or replace view v_chef_departement_entreprise as
SELECT
    chef_dep_entreprises.departement_entreprise_id,
    chef_dep_entreprises.chef_departement_id,
    chef_departements.entreprise_id,
    (chef_departements.user_id) user_id_chef_departement,
    departement_entreprises.nom_departement
FROM
    chef_dep_entreprises,
    chef_departements,
    departement_entreprises
WHERE
    chef_dep_entreprises.chef_departement_id = chef_departements.id AND
    chef_dep_entreprises.departement_entreprise_id = departement_entreprises.id AND
     departement_entreprises.entreprise_id = chef_departements.entreprise_id;
