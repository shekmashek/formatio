
create table frais_annexes(
    id bigint(20) unsigned primary key not null auto_increment,
    description varchar(255) not null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into frais_annexes(description) values
('frais de deplacement'),
("frais d'hebergement"),
('frais de restauration'),
('frais de logistique');

create table montant_frais_annexes(
    id bigint(20) unsigned primary key not null auto_increment,
    frais_annexe_id bigint(20) unsigned not null,
    num_facture  varchar(255) NOT NULL DEFAULT "#0000FCT",
    montant decimal(15,2) default 0 check(montant >= 0),
    description TEXT,
    date_frais_annexe timestamp not null,
    hors_taxe decimal(15,2) default 0 check(hors_taxe >= 0),
    qte int NOT NULL DEFAULT 1,
    pu int NOT NULL DEFAULT 1,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(frais_annexe_id) references frais_annexes(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create table encaissements_frais_annexe(
    id bigint(20) unsigned primary key not null auto_increment,
    facture_id bigint(20) unsigned not null,
    montant_frais_annexe_id bigint(20) unsigned not null,
    montant_frais_annexe decimal(15,2) default 0 check(montant_frais_annexe >= 0),
    libelle text default "",
    payement decimal(15,2) default 0 check(payement >= 0),
    montant_ouvert decimal(15,2) default 0 check(montant_ouvert >= 0),
    date_encaissement timestamp not null default now(),
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(facture_id) references factures(id) on delete cascade,
    foreign key(montant_frais_annexe_id) references montant_frais_annexes(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


insert into encaissements_frais_annexe(facture_id,montant_frais_annexe_id,montant_frais_annexe,libelle,payement,montant_ouvert,date_encaissement,created_at,updated_at)
values
(22,1,3000,"check",1000,2000,NOW(),NOW(),NOW());


-- ====================  view pour frais annexe

create or replace view v_dernier_date_encaissement_frais_annexe as
select
    (montant_frais_annexes.id) montant_frais_annexe_id,
    (IFNULL(encaissements_frais_annexe.montant_frais_annexe,montant_frais_annexes.montant)) montant_frais_annexe,
    IFNULL(max(date_encaissement),NOW()) date_encaissement
from
    montant_frais_annexes left join encaissements_frais_annexe
on
    encaissements_frais_annexe.montant_frais_annexe_id=montant_frais_annexes.id
group by
    montant_frais_annexes.id,IFNULL(encaissements_frais_annexe.montant_frais_annexe,montant_frais_annexes.montant);




create or replace view v_dernier_encaissement_frais_annexe as
select
        v_dernier_date_encaissement_frais_annexe.montant_frais_annexe_id,
        (v_dernier_date_encaissement_frais_annexe.montant_frais_annexe) montant_frais_annexe,
        (IFNULL(payement,0)) payement,
        ( IFNULL( montant_ouvert,( v_dernier_date_encaissement_frais_annexe.montant_frais_annexe - IFNULL(payement,0)) ) ) dernier_montant_ouvert,
        v_dernier_date_encaissement_frais_annexe.date_encaissement
    from
        v_dernier_date_encaissement_frais_annexe left join encaissements_frais_annexe
        on
        v_dernier_date_encaissement_frais_annexe.montant_frais_annexe_id = encaissements_frais_annexe.montant_frais_annexe_id
    and
        v_dernier_date_encaissement_frais_annexe.date_encaissement = encaissements_frais_annexe.date_encaissement;


create or replace view v_encaissement_frais_annexe as
select
    (montant_frais_annexes.id) montant_frais_annexe_id,num_facture,
    ifnull(payement,0) payement , ifnull(montant,0) montant_total , IFNULL(date_frais_annexe,NOW()) date_frais_annexe
from
    montant_frais_annexes left join encaissements_frais_annexe on montant_frais_annexes.id=montant_frais_annexe_id;


create or replace view v_sum_encaissement_frais_annexe as
select
        montant_frais_annexe_id,num_facture,SUM(payement) payement_totale,montant_total,date_frais_annexe
from
        v_encaissement_frais_annexe
group by montant_frais_annexe_id,montant_total,num_facture ;


create or replace view v_temp_frais_annexe as
select
        num_facture,v_sum_encaissement_frais_annexe.montant_frais_annexe_id,
        v_sum_encaissement_frais_annexe.montant_total,
        payement_totale,dernier_montant_ouvert,
        date_frais_annexe
from
        v_sum_encaissement_frais_annexe,v_dernier_encaissement_frais_annexe
where
            v_sum_encaissement_frais_annexe.montant_frais_annexe_id = v_dernier_encaissement_frais_annexe.montant_frais_annexe_id;


create or replace view v_frais_annexe as
select
    v_temp_frais_annexe.*,(frais_annexes.description) frais_annexe_description,(montant_frais_annexes.description) description,hors_taxe,qte,pu
from
    v_temp_frais_annexe,montant_frais_annexes,frais_annexes
where
    v_temp_frais_annexe.montant_frais_annexe_id = montant_frais_annexes.id and montant_frais_annexes.frais_annexe_id = frais_annexes.id ;


-- ============= table taxe ======================


create table taxes(
    id bigint(20) unsigned primary key not null auto_increment,
    description varchar(255) not null unique,
    pourcent decimal(5,2) check(pourcent>=0),
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


insert into taxes(description,pourcent,created_at,updated_at) values
("TVA",20,NOW(),NOW()),
("Hors Taxe",0,NOW(),NOW());

-- ==========================  table mode_financments

create table mode_financements(
    id bigint(20) unsigned primary key not null auto_increment,
    description varchar(255) not null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into mode_financements values
(1,"Virement banquaire",NULL,NULL),
(2,"Check",NULL,NULL),
(3,"Espece",NULL,NULL),
(4,"Mobile Money",NULL,NULL);
insert into encaissements(facture_id,montant_facture,libelle,payement,montant_ouvert,date_encaissement,created_at,updated_at) values
(4,500000,"test",100000,400000,NOW(),NOW(),NOW());
insert into encaissements(facture_id,montant_facture,libelle,payement,montant_ouvert,date_encaissement,created_at,updated_at) values
(6,1000000,"test",1000000,0,NOW(),NOW(),NOW());

