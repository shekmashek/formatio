


CREATE TABLE taux_devises
(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    devise_id bigint(20)  UNSIGNED NOT NULL  REFERENCES devises(id) ON DELETE CASCADE,
    valeur_default int NOT NULL default 1,
    valeur_ariary int not null default 1,
    created_at date NOT NULL,
    updated_at date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


insert into taux_devises(devise_id,valeur_default,valeur_ariary,created_at,updated_at ) values
(1,1,1,NOW(),NOW()),
(2,1,4200,"2022-01-01",NOW()),
(3,1,4500,"2022-01-01",NOW()),
(2,1,4200,NOW(),NOW()),
(3,1,4500,NOW(),NOW());




