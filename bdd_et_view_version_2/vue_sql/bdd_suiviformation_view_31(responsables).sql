create or replace  view v_employers_as_role_referent as SELECT
    employers.*,
    role_users.role_id,
     (role_users.prioriter) prioriter_role_user,
    (role_users.activiter) activiter_role_user,
    v_role_etp.role_name,
    v_role_etp.role_description
FROM
    employers,role_users,v_role_etp
WHERE
employers.user_id = role_users.user_id AND role_users.role_id=v_role_etp.id AND role_users.role_id=2;