create table demande_test_niveaux(
    id bigint(20) unsigned primary key not null auto_increment,
    description_test text not null,
    entreprise_id bigint(20) unsigned not null,
    cfp_id bigint(20) unsigned not null,
    formation_id bigint(20) unsigned not null,
    date_creation date default now(),
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT current_timestamp(),
    foreign key(entreprise_id) references entreprises(id) on delete cascade,
    foreign key(cfp_id) references entreprises(id) on delete cascade,
    foreign key(formation_id) references formations(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table stagiaire_pour_test_niveaux(
    id bigint(20) unsigned primary key not null auto_increment,
    stagiaire_id bigint(20) unsigned not null REFERENCES employers(id) on delete cascade,
    demande_tn_id bigint(20) unsigned not null REFERENCES demande_test_niveaux(id) on delete cascade,
    etat bigint(1) default 0 not null,
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create table question_evaluations(
    id bigint(20) unsigned primary key not null auto_increment,
    question text not null,
    cfp_id bigint(20) unsigned not null,
    formation_id bigint(20) unsigned not null,
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT current_timestamp(),
    foreign key(cfp_id) references entreprises(id) on delete cascade,
    foreign key(formation_id) references formations(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table choix_pour_questions(
    id bigint(20) unsigned primary key not null auto_increment,
    question_id bigint(20) unsigned not null,
    reponse text not null,
    points int default 0 not null,
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT current_timestamp(),
    foreign key(question_id) references question_evaluations(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table reponse_pour_questions(
    id bigint(20) unsigned primary key not null auto_increment,
    points bigint(20) unsigned not null,
    demande_tn_id bigint(20) unsigned not null references demande_test_niveaux(id) on delete cascade,
    question_id bigint(20) unsigned not null references question_evaluations(id) on delete cascade,
    stagiaire_id bigint(20) unsigned not null references employers(id) on delete cascade,
    created_at timestamp NULL DEFAULT current_timestamp(),
    updated_at timestamp NULL DEFAULT current_timestamp()
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
