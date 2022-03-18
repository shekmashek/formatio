
create or replace view v_responsables as
select
    (responsables.id) resp_id,
    responsables.nom_resp,
    entreprise_id,
    entreprises.nom_etp
from
    responsables,entreprises
where
    entreprise_id = entreprises.id;