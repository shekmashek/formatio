create table evaluation_stagiaires(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    groupe_id bigint(20) UNSIGNED NOT NULL REFERENCES groupes(id) ON DELETE CASCADE,
    competence_id bigint(20) UNSIGNED NOT NULL REFERENCES competence_a_evaluers(id) ON DELETE CASCADE,
    stagiaire_id bigint(20) UNSIGNED NOT NULL REFERENCES employers(id) ON DELETE CASCADE,
    note_avant int(10) UNSIGNED not null DEFAULT 0,
    note_apres int(10) UNSIGNED not null DEFAULT 0,
    status int UNSIGNED not null DEFAULT 0
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

create table detail_evaluation_apprenants(
    id bigint(20) unsigned primary key not null auto_increment,
    note_avant DECIMAL(4,2) NOT NULL DEFAULT 0,
    note_apres DECIMAL(4,2) NOT NULL DEFAULT 0,
    participant_groupe_id bigint(20) unsigned NOT NULL,
    created_at timestamp NULL DEFAULT NULL,
    updated_at timestamp NULL DEFAULT NULL,
    foreign key(participant_groupe_id) references participant_groupe(id) on delete cascade
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
