CREATE OR REPLACE view stagiaires as
SELECT
    employers.id,
    employers.entreprise_id,
    (employers.matricule_emp) matricule,
    (employers.nom_emp) nom_stagiaire,
    (employers.prenom) prenom_stagiaire,
    (employers.sexe_emp) genre_stagiaire,
    (employers.fonction_emp) fonction_stagiaire,
    (employers.email_emp) mail_stagiaire,
    (employers.telephone_emp) telephone_stagiaire,
    employers.user_id,
    service_id,
    employers.photos,
    (employers.cin_emp) cin,
    (employers.date_naissance_emp) date_naissance,
    employers.niveau_etude,
    employers.activiter,
    employers.prioriter,
    (employers.adresse_quartier) quartier,
    (employers.adresse_code_postal) code_postal,
    (employers.adresse_ville) ville,
    (employers.adresse_region) region,
    (employers.adresse_lot) lot,
    role_users.role_id
FROM
employers, role_users
WHERE
    employers.user_id = role_users.user_id and role_users.role_id=3;

CREATE OR REPLACE view responsables as
SELECT
    employers.id,
    employers.entreprise_id,
    (employers.matricule_emp) matricule,
    (employers.nom_emp) nom_resp,
    (employers.prenom) prenom_resp,
    (employers.sexe_emp) sexe_resp,
    (employers.fonction_emp) fonction_resp,
    (employers.email_emp) email_resp,
    (employers.telephone_emp) telephone_resp,
    employers.user_id,
    service_id,
    departement_entreprises_id,
    employers.photos,
    (employers.cin_emp) cin_resp,
    (employers.date_naissance_emp) date_naissance_resp,
    employers.niveau_etude,
    employers.activiter,
    employers.prioriter,
    employers.adresse_quartier,
    employers.adresse_code_postal,
    employers.adresse_ville,
    employers.adresse_region,
    employers.adresse_lot,
    role_users.role_id
FROM
employers, role_users
WHERE
    employers.user_id = role_users.user_id  and role_users.role_id=2;


CREATE OR REPLACE view chef_departements as
SELECT
    employers.id AS chef_departement_id,
    employers.entreprise_id,
    (employers.matricule_emp) matricule,
    (employers.nom_emp) nom_chef,
    (employers.prenom) prenom_chef,
    (employers.sexe_emp) genre_chef,
    (employers.fonction_emp) fonction_chef,
    (employers.email_emp) mail_chef,
    (employers.telephone_emp) telephone_chef,
    employers.user_id,
    service_id,
    employers.photos,
    (employers.cin_emp) cin_chef,
    (employers.date_naissance_emp) date_naissance_chef,
    employers.niveau_etude,
    employers.activiter,
    employers.prioriter,
    employers.adresse_quartier,
    employers.adresse_code_postal,
    employers.adresse_ville,
    employers.adresse_region,
    employers.adresse_lot,
    role_users.role_id
FROM
employers, role_users
WHERE
    employers.user_id = role_users.user_id and role_users.role_id=5;