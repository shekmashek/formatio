create table mes_documents(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  path text not null,
  nom_doc text not null,
  extension varchar(8) not null,
  groupe_id bigint(20) UNSIGNED  NOT NULL REFERENCES groupes(id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

drop table if exists detail_evaluation_action_formation;
create table detail_evaluation_action_formation(
    id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    pourcent decimal(5,2) not null,
    evaluation_action_formation_id bigint(20) UNSIGNED NOT NULL REFERENCES evaluation_action_formation(id) ON DELETE CASCADE,
    cfp_id bigint(20) UNSIGNED NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
    created_at timestamp,
    updated_at timestamp,
    groupe_id  bigint(20) UNSIGNED  NOT NULL REFERENCES groupes(id) ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


create table salle_formation_of(
  id bigint(20) UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
  cfp_id bigint(20) UNSIGNED NOT NULL REFERENCES cfps(id) ON DELETE CASCADE,
  salle_formation text not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

alter table salle_formation_of add column ville VARCHAR(200);