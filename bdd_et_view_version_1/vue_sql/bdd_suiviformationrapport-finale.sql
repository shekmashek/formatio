
create or replace view v_liste_formateur_projet as
select
    projet_id,formateur_id,nom_projet,nom_formateur,prenom_formateur,photos
    from v_detailmoduleformationprojetformateur group by
    projet_id,formateur_id,nom_projet,nom_formateur,prenom_formateur,photos;

create or replace view v_liste_stagiaire_groupe as
select
    stagiaire_id,nom_stagiaire,prenom_stagiaire,groupe_id,nom_groupe,
    module_id,nom_module,reference,v_detailmoduleformation.projet_id
    from stagiaires,participantsessions,groupes,v_detailmoduleformation
    where
        stagiaire_id = stagiaires.id and v_detailmoduleformation.detail_id = participantsessions.detail_id and groupe_id = groupes.id;


create or replace view v_groupe as
select (groupes.id) groupe_id,nom_groupe,projet_id,nom_projet from groupes,projets where projet_id = projets.id;

create or replace view v_detail_groupe_module_projet as
select
        lieu,h_debut,h_fin,date_detail,detail_id,v_detailmoduleformation.projet_id,groupe_id,module_id,
        reference,nom_module,nom_groupe
    from v_detailmoduleformation,groupes where groupe_id = groupes.id and v_detailmoduleformation.projet_id = groupes.projet_id;

create or replace view v_groupe_projet as
select
lieu,projet_id,groupe_id,module_id,nom_module,nom_groupe
    from
    v_detail_groupe_module_projet
    group by
    lieu,projet_id,groupe_id,module_id,nom_module,nom_groupe;


create or replace view v_detail_groupe_stagaire as
select
        lieu,h_debut,h_fin,date_detail,detail_id,projet_id,groupe_id,module_id,
        reference,nom_module,nom_groupe
    from v_detail_groupe_module_projet;

create or replace view v_date_formation as
select
    lieu,projet_id,session_id,date_debut,date_fin
    from details,sessions
    where session_id = sessions.id  group by projet_id,lieu,session_id,date_debut,date_fin;

create table but_objectif(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into but_objectif values(1,"Objectifs globaux de la formation :",NULL,NULL);
insert into but_objectif values(2,"Objectif p??dagogique de la formation Comp??tences cl?? :",NULL,NULL);
insert into but_objectif values(3,"Objectif p??dagogique de la formation Business Intelligence :",NULL,NULL);


create table objectif_globaux(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT,
    but_objectif_id bigint(20) unsigned NOT NULL,
    projet_id bigint(20) unsigned NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(but_objectif_id) references but_objectif(id) on delete cascade,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


insert into objectif_globaux values(1,"Se perfectionner et ??largir ses connaissances sur Excel",1,14,NULL,NULL);
insert into objectif_globaux values(2,"Ma??triser les techniques de calculs (avanc??s) qu???importe la difficult?? et la complexit?? des formules",1,14,NULL,NULL);
insert into objectif_globaux values(3,"??tre en mesure de concevoir et analyser les donn??es",1,14,NULL,NULL);
insert into objectif_globaux values(4,"Gagner du temps et augmenter sa productivit??",1,14,NULL,NULL);

insert into objectif_globaux values(5,"Acqu??rir les fondamentaux sine qua non ?? la bonne pratique d???utilisation du logiciel Microsoft Excel.",2,14,NULL,NULL);
insert into objectif_globaux values(6,"Savoir cr??er et comprendre une formule qu???importe la complexit?? et la longueur",2,14,NULL,NULL);
insert into objectif_globaux values(7,"Organiser et synth??tiser les donn??es.",2,14,NULL,NULL);

insert into objectif_globaux values(8,"Acqu??rir les fondamentaux de la transformation et de l???automatisation des t??ches avec Power QueryAcqu??rir les fondamentaux sine qua non ?? la bonne pratique d???utilisation du logiciel Microsoft Excel.",3,14,NULL,NULL);

create table pedagogique(
    id bigint(20) unsigned primary key not null auto_increment,
    titre TEXT,
    description TEXT,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into pedagogique values(1,"4. METHODE PEDAGOGIQUE","",NULL,NULL);
insert into pedagogique values(2,"4.1.MOYEN PEDAGOGIQUE","Pour une action de formation optimale, nous avons besoin des moyens suivantes :",NULL,NULL);

create table objectif_pedagogique(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT,
    pedagogique_id bigint(20) unsigned NOT NULL,
    projet_id bigint(20) unsigned NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(pedagogique_id) references pedagogique(id) on delete cascade,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into objectif_pedagogique values(1,"Formation pr??sentielle et en ligne",1,14,NULL,NULL);
insert into objectif_pedagogique values(2,"Apport de connaissance th??orique",1,14,NULL,NULL);
insert into objectif_pedagogique values(3,"Alternance th??orie/pratique",1,14,NULL,NULL);
insert into objectif_pedagogique values(4,"Mode op??ratoire",1,14,NULL,NULL);
insert into objectif_pedagogique values(5,"Exercices de mise en pratique",1,14,NULL,NULL);
insert into objectif_pedagogique values(6,"Quiz de r??vision",1,14,NULL,NULL);
insert into objectif_pedagogique values(7,"Questions/r??ponses",1,14,NULL,NULL);
insert into objectif_pedagogique values(8,"Support num??rique Excel et Pdf",1,14,NULL,NULL);

insert into objectif_pedagogique values(9,"Un ordinateur pour chaque apprenant",2,14,NULL,NULL);
insert into objectif_pedagogique values(10,"Logiciel Excel, au minimum une version 2016",2,14,NULL,NULL);
insert into objectif_pedagogique values(11,"Un cahier et un stylo pour chacun d???eux.",2,14,NULL,NULL);
insert into objectif_pedagogique values(12,"Un vid??o projecteur",2,14,NULL,NULL);


create table feed_back(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT,
    projet_id bigint(20) unsigned NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into feed_back values(1,"L???initiative de Ocean trade a ??t?? tr??s appr??ci??e pour avoir organiser cet atelier de formation Excel. En g??n??ral, l???atelier de formation sur Excel a ??t?? vraiment utile, et l???atelier a permis de faire ressortir le point faible du syst??me mis en place actuellement au sein de l???organisation qu???il faut imp??rativement combler.
Il est ??vident que ces employ??s ont besoins de ma??triser Excel, mais pour plus d???efficacit?? dans la r??solution de leur probl??me, il est fortement recommand?? de compl??ter les modules de formations afin qu???ils puissent ??tre en mesure de r??soudre des probl??mes complexes de mani??re autonome et avec efficacit??. Aussi ??tre capable de mettre en place un tableau de bord interactif dans Excel.
",14,NULL,NULL);

create table conclusion(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT,
    projet_id bigint(20) unsigned NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into conclusion values(1,"Les participants souhaitent pouvoir assister davantage ?? d???autres modules de formation EXCEL pour ne rien rater des astuces, des m??thodes et tactiques. L???atmosph??re de la formation a ??t?? ??galement conviviale et agr??able.",14,NULL,NULL);
insert into conclusion values(2,"L???atelier ??tait assez anim??, il avait une approche participative, et r??gnait un climat d???ambiance amicale. Mais surtout que les participants qui sont en majorit?? int??ress??s par les outils de Reporting, d???analyse et des fonctions avanc??es et de la communication ??voqu??e sauront tirer le meilleur profit des r??sultats de ces sessions.",14,NULL,NULL);
insert into conclusion values(3,"Les participants f??licitent Ocean Trade pour avoir organiser cet atelier qui ?? leur avis a atteint ses objectifs. Ils expriment toute leur satisfaction pour les r??sultats auxquels ils sont parvenus au cours de ces sessions de travail et souhaitent qu???il y ait une continuit?? pour l???atelier Excel.",14,NULL,NULL);

create table evaluation_resultat(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT,
    projet_id bigint(20) unsigned NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into evaluation_resultat values(1,"Tous les participants sont satisfaits de la formation.",14,NULL,NULL);
insert into evaluation_resultat values(2,"Globalement cette formation a r??pondu aux attentes des participants",14,NULL,NULL);
insert into evaluation_resultat values(3,"Le module trait?? pendant la formation a r??pondu aux attentes.",14,NULL,NULL);
insert into evaluation_resultat values(4,"Les m??thodologies p??dagogiques ??taient adapt??es, les pr??sentations ??taient claires,",14,NULL,NULL);
insert into evaluation_resultat values(5,"La th??orie et la pratique ??taient ??quilibr??es, le rythme des cours ??tait ad??quat, la dur??e de la formation ??tait trop juste.",14,NULL,NULL);

create table recommandation(
    id bigint(20) unsigned primary key not null auto_increment,
    titre varchar(255) NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into recommandation values(1,"De la part des participants :",NULL,NULL);
insert into recommandation values(2,"De la part des formateurs :",NULL,NULL);

create table detail_recommandation(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT,
    recommandation_id bigint(20) unsigned NOT NULL,
    projet_id bigint(20) unsigned NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(recommandation_id) references recommandation(id) on delete cascade,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into detail_recommandation values(1,"Les participants souhaitent la continuit?? de la formation.",1,14,NULL,NULL);

insert into detail_recommandation values(2,"Il faut ??viter les absences. Car qu???on est absent, on ne peut plus suivre efficacement le cours.",2,14,NULL,NULL);
insert into detail_recommandation values(3,"Il est plus facile pour les participants de renforcer leurs comp??tences si les mat??riels utilis??s lors des ??tudes de cas, proviennent vraiment de leurs fichiers de travail actuels.",2,14,NULL,NULL);




--  suite
create table evaluation_action_formation(
    id bigint(20) unsigned primary key not null auto_increment,
    titre varchar(255) NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into evaluation_action_formation values(1,"Animation de la formation",NULL,NULL);
insert into evaluation_action_formation values(2,"Pertinence de la formation",NULL,NULL);
insert into evaluation_action_formation values(3,"Organisation de la formation",NULL,NULL);
insert into evaluation_action_formation values(4,"Contenu de la formation",NULL,NULL);

create table detail_evaluation_action_formation(
    id bigint(20) unsigned primary key not null auto_increment,
    pourcent DECIMAL(5,2) NOT NULL,
    evaluation_action_formation_id bigint(20) unsigned NOT NULL,
    projet_id bigint(20) unsigned NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(evaluation_action_formation_id) references evaluation_action_formation(id) on delete cascade,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into detail_evaluation_action_formation values(1,90,1,14,NULL,NULL);
insert into detail_evaluation_action_formation values(2,96,2,14,NULL,NULL);
insert into detail_evaluation_action_formation values(3,84,3,14,NULL,NULL);
insert into detail_evaluation_action_formation values(4,94,4,14,NULL,NULL);

create or replace view v_evaluation_action_formation as
select
        (detail_evaluation_action_formation.id) id,(evaluation_action_formation.id) action_formation_id , titre,pourcent,groupe_id
from
    detail_evaluation_action_formation,evaluation_action_formation
where
    evaluation_action_formation_id = evaluation_action_formation.id;


create or replace view v_pourcent_globale_evaluation_action_formation as select (ROUND(AVG(pourcent),2)) globale,groupe_id from v_evaluation_action_formation group by groupe_id;


--  mila view ity SELECT * FROM `v_detailmoduleformation`
create or replace view v_detail_cour as
select
    (details.id) detail_id,cours_id,cours.titre_cours,programme_id,(programmes.titre) titre_programme
from
    details,cours,programmes
where
    details.cours_id = cours.id and cours.programme_id = programmes.id;


create or replace view v_programme_detail_activiter as
select
        v_detailmodule.*,cours_id,titre_cours,programme_id,titre_programme
from
    v_detailmodule,v_detail_cour
where
    v_detailmodule.detail_id = v_detail_cour.detail_id;

create or replace view v_trie_detail_date as
select groupe_id,h_debut,h_fin,date_detail from v_programme_detail_activiter group by groupe_id,h_debut,h_fin,date_detail;


create or replace view v_trie_detail_programme as
select groupe_id,programme_id,titre_programme from v_programme_detail_activiter group by groupe_id,programme_id,titre_programme;

/*
  insert into details(lieu,h_debut,h_fin,date_detail,projet_id,groupe_id,session_id,module_id,formateur_id,created_at,updated_at,cours_id)
   values('tana',7,12,'2021-09-03',2,3,1,9,4,null,null,16);
*/

-- suite nouveau table dernier

create table participant_groupe(
    id bigint(20) unsigned primary key not null auto_increment,
    stagaire_id bigint(20) unsigned NOT NULL,
    groupe_id bigint(20) unsigned NOT NULL,
    created_at timestamp NOT NULL,
    updated_at timestamp NOT NULL,
    foreign key(stagaire_id) references stagiaires(id) on delete cascade,
    foreign key(groupe_id) references groupes(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


insert into participant_groupe(stagaire_id,groupe_id,created_at,updated_at) values
(8,5,NOW(),NOW()),
(9,5,NOW(),NOW());

create or replace view v_participant_groupe as
select
    (participant_groupe.id) participant_groupe_id,stagaire_id,groupe_id,nom_stagiaire,prenom_stagiaire,nom_groupe,projet_id
from
    participant_groupe,stagiaires,groupes
where
    stagaire_id = stagiaires.id and groupe_id = groupes.id ;

create table detail_evaluation_apprenants(
    id bigint(20) unsigned primary key not null auto_increment,
    note_avant DECIMAL(4,2) NOT NULL DEFAULT 0,
    note_apres DECIMAL(4,2) NOT NULL DEFAULT 0,
    participant_groupe_id bigint(20) unsigned NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(participant_groupe_id) references participant_groupe(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into detail_evaluation_apprenants(note_avant,note_apres,participant_groupe_id)
values
(1.5,2.75,59),
(0.6,4.4,64);


create or replace view v_evaluation_apprenant as
select
    (detail_evaluation_apprenants.id) id,v_stagiaire_groupe.*,note_avant,note_apres
from
    v_stagiaire_groupe,detail_evaluation_apprenants
where
    v_stagiaire_groupe.participant_groupe_id = detail_evaluation_apprenants.participant_groupe_id ;

create or replace view v_tmp_verify_evaluaction_action_formation as
    select
        (evaluation_action_formation.id) evaluation_action_formation_id,pourcent,projet_id
    from
        evaluation_action_formation left join detail_evaluation_action_formation
        on
            evaluation_action_formation.id = detail_evaluation_action_formation.evaluation_action_formation_id;


create or replace view v_verify_evaluaction_action_formation as
    select
        (count(pourcent)) verify, evaluation_action_formation_id,projet_id
    from
        v_tmp_verify_evaluaction_action_formation
    group by
        projet_id,evaluation_action_formation_id;


--  documentation chart parfait
https://www.codermen.com/how-to-use-charts-in-laravel-5-7-using-charts-package/

