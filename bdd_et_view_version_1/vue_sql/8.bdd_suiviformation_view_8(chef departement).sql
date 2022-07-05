


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
LEFT JOIN  chef_departements on  chef_departements.entreprise_id =  departement_entreprises.entreprise_id
and chef_departements.departement_entreprises_id = departement_entreprises.id

