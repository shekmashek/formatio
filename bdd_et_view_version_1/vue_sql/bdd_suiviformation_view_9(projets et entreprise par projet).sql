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
nom_etp,
id as projet_id
from v_projet
group by
cfp_id,
entreprise_id,
nom_etp,
id;



create or replace view v_groupe_projet_entreprise as 
    select g.id as groupe_id,g.max_participant,g.min_participant,g.nom_groupe,g.module_id,
    g.date_debut,g.date_fin,g.status as status_groupe,g.activiter as activiter_groupe,vpe.*
    from groupes g join v_projetentreprise vpe on g.projet_id = vpe.projet_id; 


create or replace view v_stagiaire_groupe as
select g.id as groupe_id,
        g.max_participant,
        g.min_participant,
        g.nom_groupe,
        g.projet_id,
        g.module_id,
        g.date_debut,
        g.date_fin,
        g.status,
        g.activiter as activiter_groupe,
        s.id as stagiaire_id,
        s.matricule,
        s.nom_stagiaire,
        s.prenom_stagiaire,
        s.genre_stagiaire,
        s.fonction_stagiaire,
        s.mail_stagiaire,
        s.telephone_stagiaire,
        s.entreprise_id,
        s.user_id,
        s.photos,
        s.departement_id,
        s.cin,
        s.date_naissance,
        s.adresse,
        s.niveau_etude,
        s.activiter as activiter_stagiaire,
        s.lieu_travail
    from 
        participant_groupe p 
    join
        groupes g
    on g.id = p.groupe_id
    join
        stagiaires s
        on s.id = p.stagiaire_id;

-- create or replace view v_apprenants as 
--     select 

-- create or REPLACE view v_projet_entreprise_cfp as
--     select
--         p.id as projet_id,p.nom_projet,p.entreprise_id,p.cfp_id,p.status as status_projet,
--         p.activiter as activiter_projet,e.nom_etp,e.adresse as adresse_etp,
--         e.logo,e.email_etp,e.telephone_etp,
--         c.nom as nom_cfp,c.email as email_cfp,c.telephone as telephone_cfp
--     from projets p join entreprises e on p.entreprise_id = e.id 
--                     join cfps c on c.id = p.cfp_id;
