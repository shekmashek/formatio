
create or replace view v_departement as
select  * from  departement_entreprises;

-- create or replace view v_departement as
-- select
--     departement_id,
--     nom_departement,
--     entreprise_id
-- from
--     departements,departement_entreprises
-- where departement_id = departements.id;
