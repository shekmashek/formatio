CREATE OR REPLACE view stagiaires as
SELECT
    employers.id,
    employers.entreprise_id,
    (employers.matricule_emp) matricule,
    (employers.nom_emp) nom_stagiaire,
    (employers.prenom_emp) prenom_stagiaire,
    employers.genre_id,
    (genre.genre) genre_stagiaire,
    (employers.fonction_emp) fonction_stagiaire,
    employers.poste_emp,
    (employers.email_emp) mail_stagiaire,
    (employers.telephone_emp) telephone_stagiaire,
    employers.user_id,
    (employers.prioriter) prioriter_emp,
    service_id,
    branche_id,
    url_photo,
    employers.photos,
    (employers.cin_emp) cin,
    (employers.date_naissance_emp) date_naissance,
    employers.activiter,
    (employers.adresse_quartier) quartier,
    (employers.adresse_code_postal) code_postal,
    (employers.adresse_ville) ville,
    (employers.adresse_region) region,
    (employers.adresse_lot) lot,
    role_users.role_id,
    role_users.prioriter,
employers.created_at,
employers.updated_at,
niveau_etude_id,
niveau_etude.niveau_etude
FROM
employers, role_users, genre,niveau_etude
WHERE
    employers.user_id = role_users.user_id and employers.genre_id = genre.id and niveau_etude_id=niveau_etude.id and role_users.role_id=3;

CREATE OR REPLACE view responsables as
SELECT
    employers.id,
    employers.entreprise_id,
    (employers.matricule_emp) matricule,
    (employers.nom_emp) nom_resp,
    (employers.prenom_emp) prenom_resp,
    employers.genre_id,
    (genre.genre) sexe_resp,
    (employers.fonction_emp) fonction_resp,
    (employers.poste_emp) poste_resp,
    (employers.email_emp) email_resp,
    (employers.telephone_emp) telephone_resp,
    employers.user_id,
    (employers.prioriter) prioriter_emp,
    employers.service_id,
    vd.nom_service,
    url_photo,
    employers.departement_entreprises_id,
    vd.nom_departement,
    employers.photos,
    (employers.cin_emp) cin_resp,
    (employers.date_naissance_emp) date_naissance_resp,
    employers.activiter,
    employers.adresse_quartier,
    employers.adresse_code_postal,
    employers.adresse_ville,
    employers.adresse_region,
    employers.adresse_lot,
    employers.branche_id,
    branches.nom_branche,
    role_users.role_id,
    role_users.prioriter,
employers.created_at,
employers.updated_at,
niveau_etude_id,
niveau_etude.niveau_etude
FROM
employers
LEFT JOIN v_departement_service_entreprise vd ON vd.service_id = employers.service_id and vd.departement_entreprise_id = employers.departement_entreprises_id
LEFT JOIN branches ON branches.id = employers.branche_id
JOIN role_users ON role_users.user_id =  employers.user_id
JOIN genre ON genre.id = employers.genre_id
JOIN niveau_etude ON niveau_etude.id = employers.niveau_etude_id
WHERE role_users.role_id=2;

CREATE OR REPLACE view chef_departements as
SELECT
    employers.id,
    employers.entreprise_id,
    (employers.matricule_emp) matricule,
    (employers.nom_emp) nom_chef,
    (employers.prenom_emp) prenom_chef,
    employers.genre_id,
    (genre.genre) genre_chef,
    (employers.fonction_emp) fonction_chef,
    employers.poste_emp,
    (employers.email_emp) mail_chef,
    (employers.telephone_emp) telephone_chef,
    employers.user_id,
    (employers.prioriter) prioriter_emp,
    employers.branche_id,
    service_id,
    url_photo,
    employers.photos,
    (employers.cin_emp) cin_chef,
    (employers.date_naissance_emp) date_naissance_chef,
    employers.activiter,
    employers.adresse_quartier,
    employers.adresse_code_postal,
    employers.adresse_ville,
    employers.adresse_region,
    employers.adresse_lot,
    role_users.role_id,
    role_users.prioriter,
employers.created_at,
employers.updated_at,
niveau_etude_id,
niveau_etude.niveau_etude
FROM
employers, role_users, genre,niveau_etude
WHERE
    employers.user_id = role_users.user_id and employers.genre_id =genre.id and niveau_etude_id=niveau_etude.id and role_users.role_id=5;


