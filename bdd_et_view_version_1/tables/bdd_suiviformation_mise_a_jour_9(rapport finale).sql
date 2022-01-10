
create table but_objectif(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT NOT NULL,
    cfp_id bigint(20) UNSIGNED NOT NULL  REFERENCES cfps(id) ON DELETE CASCADE,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into but_objectif values(1,"Objectifs globaux de la formation :",1,NULL,NULL);
insert into but_objectif values(2,"Objectif pédagogique de la formation Compétences clé :",1,NULL,NULL);
insert into but_objectif values(3,"Objectif pédagogique de la formation Business Intelligence :",1,NULL,NULL);


create table pedagogique(
    id bigint(20) unsigned primary key not null auto_increment,
    titre TEXT NOT NULL,
    description TEXT,
    cfp_id bigint(20) UNSIGNED NOT NULL  REFERENCES cfps(id) ON DELETE CASCADE,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into pedagogique values(1,"4. METHODE PEDAGOGIQUE","",1,NULL,NULL);
insert into pedagogique values(2,"4.1.MOYEN PEDAGOGIQUE","Pour une action de formation optimale, nous avons besoin des moyens suivantes :",1,NULL,NULL);


create table recommandation(
    id bigint(20) unsigned primary key not null auto_increment,
    titre varchar(255) NOT NULL,
    cfp_id bigint(20) UNSIGNED NOT NULL  REFERENCES cfps(id) ON DELETE CASCADE,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into recommandation values(1,"De la part des participants :",1,NULL,NULL);
insert into recommandation values(2,"De la part des formateurs :",1,NULL,NULL);


create table evaluation_action_formation(
    id bigint(20) unsigned primary key not null auto_increment,
    titre varchar(255) NOT NULL,
    cfp_id bigint(20) UNSIGNED NOT NULL  REFERENCES cfps(id) ON DELETE CASCADE,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

insert into evaluation_action_formation values(1,"Animation de la formation",1,NULL,NULL);
insert into evaluation_action_formation values(2,"Pertinence de la formation",1,NULL,NULL);
insert into evaluation_action_formation values(3,"Organisation de la formation",1,NULL,NULL);
insert into evaluation_action_formation values(4,"Contenu de la formation",1,NULL,NULL);


create table objectif_globaux(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT NOT NULL,
    but_objectif_id bigint(20) unsigned NOT NULL,
    projet_id bigint(20) unsigned NOT NULL,
    cfp_id bigint(20) UNSIGNED NOT NULL  REFERENCES cfps(id) ON DELETE CASCADE,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(but_objectif_id) references but_objectif(id) on delete cascade,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;



create table objectif_pedagogique(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT NOT NULL,
    pedagogique_id bigint(20) unsigned NOT NULL,
    projet_id bigint(20) unsigned NOT NULL,
    cfp_id bigint(20) UNSIGNED NOT NULL  REFERENCES cfps(id) ON DELETE CASCADE,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(pedagogique_id) references pedagogique(id) on delete cascade,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create table feed_back(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT NOT NULL,
    projet_id bigint(20) unsigned NOT NULL,
    cfp_id bigint(20) UNSIGNED NOT NULL  REFERENCES cfps(id) ON DELETE CASCADE,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create table conclusion(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT NOT NULL,
    projet_id bigint(20) unsigned NOT NULL,
    cfp_id bigint(20) UNSIGNED NOT NULL  REFERENCES cfps(id) ON DELETE CASCADE,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create table evaluation_resultat(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT NOT NULL,
    projet_id bigint(20) unsigned NOT NULL,
    cfp_id bigint(20) UNSIGNED NOT NULL  REFERENCES cfps(id) ON DELETE CASCADE,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create table detail_recommandation(
    id bigint(20) unsigned primary key not null auto_increment,
    description TEXT NOT NULL,
    recommandation_id bigint(20) unsigned NOT NULL,
    projet_id bigint(20) unsigned NOT NULL,
    cfp_id bigint(20) UNSIGNED NOT NULL  REFERENCES cfps(id) ON DELETE CASCADE,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(recommandation_id) references recommandation(id) on delete cascade,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create table detail_evaluation_action_formation(
    id bigint(20) unsigned primary key not null auto_increment,
    pourcent DECIMAL(5,2) NOT NULL,
    evaluation_action_formation_id bigint(20) unsigned NOT NULL,
    projet_id bigint(20) unsigned NOT NULL,
    cfp_id bigint(20) UNSIGNED NOT NULL  REFERENCES cfps(id) ON DELETE CASCADE,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(evaluation_action_formation_id) references evaluation_action_formation(id) on delete cascade,
    foreign key(projet_id) references projets(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
