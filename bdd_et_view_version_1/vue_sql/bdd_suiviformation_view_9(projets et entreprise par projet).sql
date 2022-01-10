create  or REPLACE view v_projet as
select
projets.*,
entreprises.nom_etp
from projets,entreprises
where
entreprise_id= entreprises.id;

create or REPLACE view v_entreprise_par_projet as
select
cfp_id,
entreprise_id,
nom_etp
from v_projet
group by
cfp_id,
entreprise_id,
nom_etp;
