-- CREATE OR REPLACE view stagiaires as
-- SELECT
--     employers.id AS stagiaire_id,
--     employers.entreprise_id,
--     (employers.matricule_emp) matricule,
--     (employers.nom_emp) nom_stagiaire,
--     (employers.prenom) prenom_stagiaire,
--     (employers.sexe_emp) genre_stagiaire,
--     (employers.fonction_emp) fonction_stagiaire,
--     (employers.email_emp) mail_stagiaire,
--     (employers.telephone_emp) telephone_stagiaire,
--     employers.user_id,
--     service_id,
--     employers.photos,
--     (employers.cin_emp) cin,
--     (employers.date_naissance_emp) date_naissance,
--     employers.niveau_etude,
--     employers.activiter,
--     employers.prioriter,
--     (employers.adresse_quartier) quartier,
--     (employers.adresse_code_postal) code_postal,
--     (employers.adresse_ville) ville,
--     (employers.adresse_region) region,
--     (employers.adresse_lot) lot,
--     role_users.role_id
-- FROM
-- employers, role_users
-- WHERE
--     employers.user_id = role_users.user_id and role_users.role_id=3;

CREATE OR REPLACE view responsables_cfp as
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


CREATE TABLE formateurs (
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_formateur varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  prenom_formateur varchar(191) COLLATE utf8mb4_unicode_ci,
  mail_formateur varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  numero_formateur varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  photos varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp(),
  genre varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  date_naissance varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  adresse varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  cin varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  specialite varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  niveau varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  activiter boolean not null default true,
  user_id bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



CREATE TABLE responsables_cfp(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nom_resp_cfp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  prenom_resp_cfp varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  sexe_resp_cfp varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  date_naissance_resp_cfp date default current_timestamp(),
  cin_resp_cfp varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'XXXXXXX',
  email_resp_cfp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  telephone_resp_cfp varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  fonction_resp_cfp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  adresse_lot varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_quartier varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_code_postal varchar(3) COLLATE utf8mb4_unicode_ci  default 'XXX',
  adresse_ville varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  adresse_region varchar(191) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  photos_resp_cfp varchar(255) COLLATE utf8mb4_unicode_ci  default 'XXXXXXX',
  cfp_id bigint(20) UNSIGNED NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
  user_id bigint(20) UNSIGNED NOT NULL REFERENCES users(id) ON DELETE CASCADE,
  activiter boolean not null default true,
  prioriter boolean not null default false,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;