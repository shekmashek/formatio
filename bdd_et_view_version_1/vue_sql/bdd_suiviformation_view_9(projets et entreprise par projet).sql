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



create or replace view v_groupe_projet_entreprise as
    select g.id as groupe_id,g.max_participant,g.min_participant,g.nom_groupe,g.module_id,
    g.date_debut,g.date_fin,g.status as status_groupe,g.activiter as activiter_groupe,vpe.*
    from groupes g join v_projetentreprise vpe on g.projet_id = vpe.projet_id;

