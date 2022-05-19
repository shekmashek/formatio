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
LEFT JOIN secteurs s ON s.id = e.secteur_id;

CREATE OR REPLACE VIEW v_plan_formation as
SELECT
    s.id,
    s.nom_stagiaire,
    s.prenom_stagiaire,
    s.service_id,
    serv.nom_service,
    serv.departement_entreprise_id,
    dep.nom_departement,
    r.stagiaire_id as id_stagiaire,
    r.duree_formation,
    r.mois_previsionnelle,
    r.statut,
    r.date_demande,
    r.formation_id,
    f.nom_formation,
    r.typologie_formation,
    r.objectif_attendu,
    p.cout_previsionnel,
    p.mode_financement,
    p.recueil_information_id,
    a.annee
FROM
    recueil_informations r
JOIN plan_formations p ON  p.recueil_information_id = r.id
JOIN formations f ON f.id = r.formation_id
JOIN annee_plans a ON a.id = r.annee_plan_id
JOIN stagiaires s ON s.id = r.stagiaire_id
JOIN services serv ON serv.id = s.service_id
JOIN departement_entreprises dep ON dep.id = serv.departement_entreprise_id;

CREATE OR REPLACE VIEW v_budgetisation as SELECT
    e.id as entreprise_id,
    e.nom_etp,
    dep.nom_departement,
    b.budget_total,
    b.annee
FROM
    budgetisation b
JOIN entreprises e ON b.entreprise_id = e.id
JOIN departement_entreprises dep ON b.departement_entreprise_id = dep.id;