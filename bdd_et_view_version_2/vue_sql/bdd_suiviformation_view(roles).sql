CREATE OR REPLACE VIEW v_role_etp AS SELECT
    *
FROM
    roles
WHERE
    role_name = 'manager' OR role_name = 'referent' OR role_name = 'formateur' OR role_name = 'stagiaire';

CREATE OR REPLACE VIEW v_role_user_init AS SELECT
    v_role_etp.*,
    role_users.user_id
FROM
    v_role_etp
CROSS JOIN role_users
GROUP BY id,role_name,created_at,updated_at,role_description,user_id
;

CREATE OR REPLACE VIEW v_role_user_etp_stg AS SELECT
    roles.role_name,roles.role_description,role_users.role_id,role_users.user_id,stagiaires.entreprise_id
FROM
    role_users,stagiaires,roles
WHERE
    role_users.role_id = roles.id AND role_users.user_id = stagiaires.user_id ;

CREATE OR REPLACE VIEW v_role_user_etp_referent AS SELECT
    roles.role_name,roles.role_description,role_users.role_id,role_users.user_id,responsables.entreprise_id
FROM
    role_users,responsables,roles
WHERE
    role_users.role_id = roles.id AND role_users.user_id = responsables.user_id and responsables.prioriter=false;

CREATE OR REPLACE VIEW v_role_user_etp_manager AS SELECT
    roles.role_name,roles.role_description,role_users.role_id,role_users.user_id,chef_departements.entreprise_id
FROM
    role_users,chef_departements,roles
WHERE
    role_users.role_id = roles.id AND role_users.user_id = chef_departements.user_id ;