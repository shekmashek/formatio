CREATE OR REPLACE VIEW v_departement AS SELECT
    departement_id,
    entreprise_id,
    nom_departement
FROM
    departement_entreprises,
    departements
WHERE
    departement_id = departements.id;


