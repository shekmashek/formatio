
--  view permetant d'avoir les information de programme selon les modules par categorie

create or replace view v_programme as
    select
    formation_id,nom_formation,id_module,nom_module,reference,(prix) prix_module,(duree) duree_module,
    (programmes.id) id_programme,(programmes.titre) titre_programme

    from

    (select
        (modules.id) id_module,modules.reference,modules.nom_module,
        formation_id,formations.nom_formation,prix,duree
    from
        modules, formations
    where
        modules.formation_id = formations.id) as module

    join
    programmes ON module.id_module = programmes.module_id;


--  view import pour exportation excel

create or replace view v_exportcatalogue as
select
        modules.reference,modules.nom_module,
        prix,duree,formations.nom_formation
    from
        modules, formations
    where
        modules.formation_id = formations.id;


        -- view importation export excel des responsables par entreprises

create or replace view v_exportresponsable as
    select
        nom_resp,prenom_resp,fonction_resp,email_resp,telephone_resp
        ,nom_etp,adresse
    from
        responsables,entreprises where entreprises.id = responsables.entreprise_id;

            -- view importation export excel des Stagiaires par entreprises

create or replace view v_exportparticipant as
    select
        matricule,nom_stagiaire,prenom_stagiaire,genre_stagiaire,fonction_stagiaire,mail_stagiaire,telephone_stagiaire
        ,nom_etp,entreprises.adresse
    from
        stagiaires,entreprises where entreprises.id = stagiaires.entreprise_id;


create or replace view v_dernier_date_encaissement as
select
(factures.id) facture_id,(IFNULL(encaissements.montant_facture,factures.montant_total)) montant_facture,IFNULL(max(date_encaissement),NOW()) date_encaissement
from factures left join encaissements
on encaissements.facture_id=factures.id group by factures.id,IFNULL(encaissements.montant_facture,factures.montant_total);


create or replace view v_dernier_encaissement as
select
        v_dernier_date_encaissement.facture_id,(v_dernier_date_encaissement.montant_facture) montant_facture,(IFNULL(payement,0)) payement,
        ( IFNULL( montant_ouvert,( v_dernier_date_encaissement.montant_facture - IFNULL(payement,0)) ) ) dernier_montant_ouvert,
        v_dernier_date_encaissement.date_encaissement
    from
        v_dernier_date_encaissement left join encaissements on v_dernier_date_encaissement.facture_id = encaissements.facture_id
    and
        v_dernier_date_encaissement.date_encaissement = encaissements.date_encaissement;


create or replace view v_encaissement as
select
    (factures.id) facture_id ,projet_id,
    ifnull(payement,0) payement , ifnull(montant_total,0) montant_total , IFNULL(date_facture,NOW()) date_facture
from
    factures left join encaissements on factures.id=facture_id;


create or replace view v_sum_encaissement as
select
        facture_id,projet_id,SUM(payement) payement_totale,montant_total,date_facture
from
        v_encaissement
group by facture_id,montant_total,projet_id ;



/*----------------  view avant ----------------------------------------------*/
-- create or replace view v_facture as
-- select
--         projet_id,v_sum_encaissement.facture_id,v_sum_encaissement.montant_total,
--         payement_totale,dernier_montant_ouvert,
--         date_facture
--         from
--         v_sum_encaissement,v_dernier_encaissement
--         where
--             v_sum_encaissement.facture_id = v_dernier_encaissement.facture_id;
/*---------------- Fin view avant ----------------------------------------------*/



/*----------------  view apres ----------------------------------------------*/

create or replace view v_temp_facture as
select
        projet_id,v_sum_encaissement.facture_id,v_sum_encaissement.montant_total,
        payement_totale,dernier_montant_ouvert,
        date_facture
        from
        v_sum_encaissement,v_dernier_encaissement
        where
            v_sum_encaissement.facture_id = v_dernier_encaissement.facture_id;


/*----------------  FIN view apres ----------------------------------------------*/

create table type_facture(
    id bigint(20) unsigned primary key not null auto_increment,
    description varchar(255) not null,
    reference varchar(255) not null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into type_facture(description,reference,created_at,updated_at) values
("Facture Définitive","Facture",NOW(),NOW()),
("Facture d'Avoir","Avoir",NOW(),NOW()),
("Facture d'Acompte","Acompte",NOW(),NOW());


alter table factures add column invoice_date DATE NOT NULL;
alter table factures add column due_date DATE NOT NULL;
alter table factures add column tax_id bigint(20) unsigned  not null references taxes(id) on delete cascade;
alter table factures add column  description TEXT;
alter table factures add column ohter_message  TEXT;

alter table factures add column  hors_taxe decimal(15,2) default 0 check(hors_taxe >= 0);

alter table factures add column qte  INT NOT NULL DEFAULT 1;
alter table factures add column num_facture  varchar(255) NOT NULL DEFAULT "#0000FCT";
alter table factures add column type_financement_id bigint(20) unsigned  not null references mode_financements(id) on delete cascade;
alter table factures add column groupe_id bigint(20) unsigned  not null references groupes(id) on delete cascade;

alter table factures add column pu int NOT NULL DEFAULT 1;

alter table factures add column activiter boolean NOT NULL DEFAULT false;

alter table factures add column reference_bc varchar(255) NOT NULL DEFAULT "#-------";

alter table factures add column remise INT DEFAULT 0;

alter table factures add column type_facture_id bigint(20) unsigned  not null references type_facture(id) on delete cascade;

create or replace view v_facture as
select
    v_temp_facture.*,nom_projet,entreprise_id, type_payement_id,(type_payement.type) description_type_payement,
    bon_de_commande,facture,factures.hors_taxe,invoice_date,due_date,tax_id,(taxes.description) nom_taxe,taxes.pourcent,
    (factures.description) description_facture,other_message,qte,num_facture,activiter,groupe_id,groupes.nom_groupe,pu,type_financement_id,(mode_financements.description) description_financement,
    nom_etp,adresse,logo,reference_bc,remise,
    (v_temp_facture.payement_totale - hors_taxe) payement_cours,
    (case
    when (v_temp_facture.payement_totale - hors_taxe)<0 and payement_totale<=0 then 'valider'
    when (v_temp_facture.payement_totale - hors_taxe)<0 and payement_totale>0 then 'en_cour'
    when (v_temp_facture.payement_totale - hors_taxe)>=0 then 'terminer'
    end  ) facture_encour,
    type_facture_id,(type_facture.description) description_type_facture,
    (type_facture.reference) reference_facture,NIF,STAT,RCS,CIF,Secteur_activite
from
    v_temp_facture,factures,type_payement,taxes,projets,groupes,entreprises,mode_financements,type_facture
where
    v_temp_facture.facture_id = factures.id and factures.type_payement_id = type_payement.id and type_financement_id = mode_financements.id and
    factures.tax_id = taxes.id  and v_temp_facture.projet_id = projets.id and groupe_id = groupes.id and entreprise_id = entreprises.id and
    type_facture_id = type_facture.id;


create or replace view v_facture_actif
as
select
    num_facture,other_message,
    due_date,invoice_date,(DATEDIFF(due_date,invoice_date)) totale_jour,
    (  IFNULL( (DATEDIFF(due_date,NOW())),0)  ) jour_restant,facture_encour
    from
    v_facture where activiter=True group by num_facture,other_message,due_date,invoice_date,facture_encour;

create or replace view v_facture_inactif
as
select
    num_facture,other_message,
    due_date,invoice_date,(DATEDIFF(due_date,invoice_date)) totale_jour,
    (  IFNULL( (DATEDIFF(due_date,NOW())),0)  ) jour_restant,facture_encour
    from
    v_facture where activiter=False group by num_facture,other_message,due_date,invoice_date,facture_encour;

create or replace view v_compte_facture_actif as select (COUNT(num_facture)) totale from v_facture_actif;
create or replace view v_compte_facture_inactif as select (COUNT(num_facture)) totale from v_facture_inactif;
create or replace view v_compte_facture_en_cour as select (COUNT(num_facture)) totale from v_facture where facture_encour='en_cour';

create or replace view v_compte_facture_payer as select (COUNT(num_facture)) totale from v_facture where facture_encour='terminer';
create or replace view resultat_frais_annexe as
    select e.encaissements_fa_id,e.facture_id,e.montant_frais_annexe_id,e.montant_frais_annexe,e.payement,e.montant_ouvert,e.libelle,e.date_encaissement,
    m.projet_id,m.frais_annexe_id,m.description from v_encaissement_frais_annexe e join v_montant_frais_annexe m
    on e.montant_frais_annexe_id = m.montant_frais_annexe_id;



--------------Auto evaluation  QCM
create table demande_test_niveaux(
    id bigint(20) unsigned primary key not null auto_increment,
    description_test text not null,
    entreprise_id bigint(20) unsigned not null,
    cfp_id bigint(20) unsigned not null,
    formation_id bigint(20) unsigned not null,
    date_creation date default now(),
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(entreprise_id) references entreprises(id) on delete cascade,
    foreign key(cfp_id) references cfps(id) on delete cascade,
    foreign key(formation_id) references formations(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table stagiaire_pour_test_niveaux(
    id bigint(20) unsigned primary key not null auto_increment,
    stagiaire_id bigint(20) unsigned not null,
    demande_tn_id bigint(20) unsigned not null,
    etat bigint(1) default 0 not null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(stagiaire_id) references stagiaires(id) on delete cascade,
    foreign key(demande_tn_id) references demande_test_niveaux(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create table question_evaluations(
    id bigint(20) unsigned primary key not null auto_increment,
    question text not null,
    cfp_id bigint(20) unsigned not null,
    formation_id bigint(20) unsigned not null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(cfp_id) references cfps(id) on delete cascade,
    foreign key(formation_id) references formations(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table choix_pour_questions(
    id bigint(20) unsigned primary key not null auto_increment,
    question_id bigint(20) unsigned not null,
    reponse text not null,
    points int default 0 not null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(question_id) references question_evaluations(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table reponse_pour_questions(
    id bigint(20) unsigned primary key not null auto_increment,
    points bigint(20) unsigned not null,
    demande_tn_id bigint(20) unsigned not null,
    question_id bigint(20) unsigned not null,
    stagiaire_id bigint(20) unsigned not null,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(stagiaire_id) references stagiaires(id) on delete cascade,
    foreign key(question_id) references question_evaluations(id) on delete cascade,
    foreign key(demande_tn_id) references demande_test_niveaux(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create or replace view v_notification_test_niveaux as
    select s.stagiaire_id,s.demande_tn_id,s.etat,d.description_test,d.entreprise_id,d.cfp_id,d.formation_id,d.date_creation
    from stagiaire_pour_test_niveaux s join demande_test_niveaux d on d.id=s.demande_tn_id;


create or replace view v_question_reponse_test_niveau as
    select c.*,q.cfp_id,q.formation_id from question_evaluations q join choix_pour_questions c
    on c.question_id = q.id;

create or replace view v_resultat_test_niveau as
    select sum(points) as total_points,count(question_id) as nombre_question,(sum(points)/count(question_id))*100 as pourcentage, demande_tn_id,stagiaire_id from reponse_pour_questions
    group by stagiaire_id,demande_tn_id;


create or replace view v_notification_demande as
    select n.stagiaire_id,n.demande_tn_id,n.description_test,n.entreprise_id,n.cfp_id,n.formation_id,
    n.date_creation,n.etat,f.nom_formation from v_notification_test_niveaux n join formations f
    on n.formation_id = f.id;
-- create table test_de_niveau(
--     id bigint(20) unsigned primary key not null auto_increment,
--     entreprise_id bigint(20) unsigned not null,
--     formation_id bigint(20) unsigned not null,
--     stagiaire_id bigint(20) unsigned not null,
--     etat varchar(20) default 'f',
--     foreign key(entreprise_id) references entreprises(id) on delete cascade,
--     foreign key(formation_id) references formations(id) on delete cascade,
--     foreign key(stagiaire_id) references stagiaires(id) on delete cascade
-- )ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- view facture pour encaissement
create or replace view v_montant_pedagogique_facture as
    select num_facture,sum(qte) as qte_totale,sum(hors_taxe) as hors_taxe from factures group by num_facture;

create or replace view v_montant_frais_annexe as
    select num_facture,sum(qte) as qte_totale,sum(hors_taxe) as hors_taxe from montant_frais_annexes group by num_facture;

create or replace view v_remise_facture as
    select num_facture,sum(remise)/count(num_facture) as remise from factures group by num_facture;

create or replace view v_taxe_facture as
    select num_facture,pourcent from factures f join taxes t on f.tax_id=t.id group by num_facture;

create or replace view v_type_facture as
    select num_facture,

create or replace view v_montant_brut_facture as
    select mpf.num_facture,(mpf.hors_taxe+mfa.hors_taxe) as montant_brut_ht from v_montant_pedagogique_facture mpf
    join v_montant_frais_annexe mfa on mpf.num_facture=mfa.num_facture;


create or replace view v_montant_facture as
    select mbr.num_facture,mbr.montant_brut_ht,rf.remise,(mbr.montant_brut_ht-rf.remise) as net_commercial,(mbr.montant_brut_ht-rf.remise) as net_ht,
    (((mbr.montant_brut_ht-rf.remise)*tf.pourcent)/100) as tva from v_montant_brut_facture mbr
    join v_remise_facture rf on mbr.num_facture =rf.num_facture join v_taxe_facture tf on tf.num_facture=mbr.num_facture;

create or replace view v_montant_facture_
create or replace view resultat_frais_annexe as
    select e.encaissements_fa_id,e.facture_id,e.montant_frais_annexe_id,e.montant_frais_annexe,e.payement,e.montant_ouvert,e.libelle,e.date_encaissement,
    m.projet_id,m.frais_annexe_id,m.description from v_encaissement_frais_annexe e join v_montant_frais_annexe m
    on e.montant_frais_annexe_id = m.montant_frais_annexe_id;


--------------
create or replace view v_type_abonnement_role_etp as
    select t.id as type_abonnement_role_id,t.type_abonne_id,t.type_abonnement_id,
    a.id as abonnement_id,a.date_demande,a.date_debut,a.date_fin,a.mode_paiement,a.status,
    a.entreprise_id,a.categorie_paiement_id
    from type_abonnement_roles t join abonnements a on t.id = a.type_abonnement_role_id;

create or replace view v_categorie_abonnement_etp as
    select ta.*,cp.categorie,tc.tarif,t.NomType,t.Logo from v_type_abonnement_role_etp ta
    join categorie_paiements cp on ta.categorie_paiement_id = cp.id
    join tarif_categories tc on ta.type_abonnement_role_id=tc.type_abonnement_role_id
    and ta.categorie_paiement_id = tc.categorie_paiement_id
    join type_abonnements t on t.id = ta.type_abonnement_id

create or replace view v_type_abonnement_role_cfp as
    select t.id as type_abonnement_role_id,t.type_abonne_id,t.type_abonnement_id,
    a.id as abonnement_id,a.date_demande,a.date_debut,a.date_fin,a.mode_paiement,a.status,
    a.cfp_id,a.categorie_paiement_id
    from type_abonnement_roles t join abonnement_cfps a on t.id = a.type_abonnement_role_id;

create or replace view v_categorie_abonnements_cfp as
    select ta.*,cp.categorie,tc.tarif,t.NomType,t.Logo from v_type_abonnement_role_cfp ta
    join categorie_paiements cp on ta.categorie_paiement_id = cp.id
    join tarif_categories tc on ta.type_abonnement_role_id=tc.type_abonnement_role_id
    and ta.categorie_paiement_id = tc.categorie_paiement_id
    join type_abonnements t on t.id = ta.type_abonnement_id

