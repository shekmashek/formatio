
CREATE OR REPLACE VIEW v_departement_service_entreprise AS SELECT
     dep.id as departement_entreprise_id,
    serv.id as service_id,
    etp.id as entreprise_id,
    etp.nom_etp,
    dep.nom_departement,
    serv.nom_service
FROM
    departement_entreprises dep,
    entreprises etp,
    services serv
WHERE
    dep.entreprise_id = etp.id AND
    serv.departement_entreprise_id = dep.id;

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
    (employers.email_emp) mail_stagiaire,
    (employers.telephone_emp) telephone_stagiaire,
    employers.user_id,
    (employers.prioriter) prioriter_emp,
    employers.service_id,
    vd.nom_service,
    employers.branche_id,
    url_photo,
    employers.departement_entreprises_id,
     vd.nom_departement,
    employers.photos,
    (employers.cin_emp) cin,
    (employers.date_naissance_emp) date_naissance,
    employers.activiter,
    (employers.adresse_quartier) quartier,
    (employers.adresse_code_postal) code_postal,
    (employers.adresse_ville) ville,
    (employers.adresse_region) region,
    (employers.adresse_lot) lot,
    bc.nom_branche,
    role_users.role_id,
    role_users.prioriter,
employers.created_at,
employers.updated_at,
niveau_etude_id,
niveau_etude.niveau_etude
FROM employers
LEFT JOIN v_departement_service_entreprise vd ON vd.service_id = employers.service_id and vd.departement_entreprise_id = employers.departement_entreprises_id
LEFT JOIN branches bc ON bc.id = employers.branche_id
JOIN role_users ON role_users.user_id =  employers.user_id
JOIN genre ON genre.id = employers.genre_id
JOIN niveau_etude ON niveau_etude.id = employers.niveau_etude_id
WHERE role_users.role_id=3;



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
    bc.nom_branche,
    role_users.role_id,
    role_users.prioriter,
    employers.created_at,
    employers.updated_at,
    niveau_etude_id,
    niveau_etude.niveau_etude,
    etp.logo,
    etp.nom_etp,
    etp.adresse_rue as adresse_rue_etp,
    etp.adresse_quartier as adresse_quartier_etp,
    etp.adresse_code_postal as adresse_code_postal_etp,
    etp.adresse_ville as adresse_ville_etp,
    etp.adresse_region as adresse_region_etp,
    etp.site_etp
FROM
employers
LEFT JOIN v_departement_service_entreprise vd ON vd.service_id = employers.service_id and vd.departement_entreprise_id = employers.departement_entreprises_id
LEFT JOIN branches bc ON bc.id = employers.branche_id
JOIN role_users ON role_users.user_id =  employers.user_id
JOIN genre ON genre.id = employers.genre_id
JOIN niveau_etude ON niveau_etude.id = employers.niveau_etude_id
JOIN entreprises as etp ON etp.id = employers.entreprise_id
WHERE role_users.role_id=2;


CREATE OR REPLACE view chef_departements as
SELECT
    employers.id,
    employers.entreprise_id,
    e.nom_etp,
    (employers.matricule_emp) matricule,
    (employers.nom_emp) nom_chef,
    (employers.prenom_emp) prenom_chef,
    employers.genre_id,
    (genre.genre) genre_chef,
    (employers.fonction_emp) fonction_chef,
    (employers.email_emp) mail_chef,
    (employers.telephone_emp) telephone_chef,
    employers.user_id,
    (employers.prioriter) prioriter_emp,
    employers.branche_id,
    bc.nom_branche,
    employers.service_id,
    vd.nom_service,
    url_photo,
    employers.departement_entreprises_id,
    vd.nom_departement,
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
employers
LEFT JOIN v_departement_service_entreprise vd ON vd.service_id = employers.service_id and vd.departement_entreprise_id = employers.departement_entreprises_id
LEFT JOIN branches bc ON bc.id = employers.branche_id
JOIN role_users ON role_users.user_id =  employers.user_id
JOIN genre ON genre.id = employers.genre_id
JOIN niveau_etude ON niveau_etude.id = employers.niveau_etude_id
JOIN entreprises e ON e.id = employers.entreprise_id
WHERE role_users.role_id=5;

CREATE OR REPLACE view responsables_cfp as SELECT
    (employers.id)id,
    nom_emp as nom_resp_cfp,
    prenom_emp as prenom_resp_cfp,
    genre_id as sexe_resp_cfp,
    date_naissance_emp as date_naissance_resp_cfp,
    cin_emp as cin_resp_cfp,
    email_emp as email_resp_cfp,
    telephone_emp as telephone_resp_cfp,
    fonction_emp as fonction_resp_cfp,
    adresse_lot,
    (employers.adresse_quartier) adresse_quartier,
    (employers.adresse_quartier) adresse_code_postal,
    (employers.adresse_quartier)  adresse_ville,
    (employers.adresse_quartier) adresse_region,
    photos as photos_resp_cfp,
    entreprise_id as cfp_id,
    user_id,
    (employers.activiter) activiter,
    prioriter,
    url_photo,
    (employers.created_at) created_at,
    (employers.updated_at) updated_at
FROM
employers
JOIN entreprises
WHERE employers.entreprise_id = entreprises.id and entreprises.type_entreprise_id = 2;

create or replace view  v_responsable_entreprise as
    select r.id as responsable_id,
        r.nom_resp,
        r.prenom_resp,
        r.fonction_resp,
        r.email_resp,
        r.cin_resp,
        r.telephone_resp,
        r.user_id as user_id_responsable,
        r.photos,
        r.entreprise_id as entreprise_id_responsable,
        r.activiter as activiter_responsable,
        r.user_id,
        r.prioriter,
        e.id as entreprise_id,
        e.nom_etp,
        e.adresse_rue as adresse_lot,
        e.adresse_quartier,
        e.adresse_code_postal,
        e.adresse_ville,
        e.adresse_region,
        e.logo as logo_entreprise,
        e.nif as nif_etp,
        e.stat as stat_etp,
        e.rcs as rcs_etp,
        e.cif as cif_etp,
        e.secteur_id as secteur_id_etp,
        e.email_etp,
        e.site_etp,
        e.activiter as activiter_etp,
        e.telephone_etp
        from responsables r
        join
            entreprises e on e.id = r.entreprise_id;