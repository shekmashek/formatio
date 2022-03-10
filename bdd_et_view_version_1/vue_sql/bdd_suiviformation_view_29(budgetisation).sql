CREATE OR REPLACE VIEW v_responsable_entreprise as SELECT
    responsables.*,
    e.nom_etp,
    e.adresse_rue as adresse_rue_etp,
    e.adresse_quartier as adresse_quartier_etp,
    e.adresse_code_postal as adresse_code_postal_etp,
    e.adresse_ville as adresse_ville_etp,
    e.adresse_region as adresse_region_etp,
    e.logo,
    e.nif,
    e.stat,
    e.rcs,
    e.cif,
    e.secteur_id,
    s.nom_secteur,
    e.email_etp,
    e.site_etp,
    e.telephone_etp
FROM
    responsables
JOIN entreprises e ON e.id = responsables.entreprise_id
JOIN secteurs s ON s.id = e.secteur_id;