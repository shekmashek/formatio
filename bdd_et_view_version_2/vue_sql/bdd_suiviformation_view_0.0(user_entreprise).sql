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
    employers.poste_emp,
    (employers.email_emp) email_resp,
    (employers.telephone_emp) telephone_resp,
    employers.user_id,
    service_id,
    url_photo,
    departement_entreprises_id,
    employers.photos,
    (employers.cin_emp) cin_resp,
    (employers.date_naissance_emp) date_naissance_resp,
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
employers, role_users , genre,niveau_etude
WHERE
    employers.user_id = role_users.user_id and employers.genre_id = genre.id and niveau_etude_id=niveau_etude.id  and role_users.role_id=2;

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




create or replace  view v_employers_as_role_referent as SELECT
    employers.*,
    role_users.role_id,
     (role_users.prioriter) prioriter_role_user,
    (role_users.activiter) activiter_role_user,
    v_role_etp.role_name,
    v_role_etp.role_description
FROM
    employers,role_users,v_role_etp
WHERE
employers.user_id = role_users.user_id AND role_users.role_id=v_role_etp.id AND role_users.role_id=2;
