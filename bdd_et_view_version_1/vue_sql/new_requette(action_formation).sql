create or replace view v_ville_formation as
    select 
        SUBSTRING_INDEX(lieu,',  ',1) as ville,
        groupe_id
    from details  
    group by groupe_id;

create or replace view v_nombre_participant_groupe as
    select
        groupe_id,
        count(stagiaire_id) as total_stagiaire
    from 
        participant_groupe
    group by 
        groupe_id;

create or replace view v_cout_pedagogique_module as
select
    g.id as groupe_id,
    m.prix,
    m.id as module_id,
    m.nom_module,
    ifnull(npg.total_stagiaire,0) as total_stagiaire,
    ifnull((m.prix * npg.total_stagiaire),0) as cout_pedagogique
from groupes g 
join modules m on g.module_id = m.id
left join v_nombre_participant_groupe npg on npg.groupe_id = g.id;

create or replace view v_cout_frais_annexe as
select 
g.id as groupe_id,
SUM(fr.montant ) as frais_annexe
from groupes g
join frais_annexe_formation fr on  fr.groupe_id=  g.id
group by groupe_id;


create or replace view v_action_formation as
select 
    p.nom_projet,
     tf.type_formation,
    p.type_formation_id,
    g.nom_groupe,
    g.id as groupe_id,
    g.modalite,
    cfp.nom as nom_cfp,
     vpe.nom_etp,
    ifnull(npg.total_stagiaire,0) as nombre_participant,
    cp.module_id,
    cp.nom_module,
    cp.cout_pedagogique,
    ifnull(frais_annexe,0) as frais_annexe,
    mf.nom_formation as thematique,
    dm.nom_domaine as domaine,
    ifnull(vpe.item_status_groupe,'') as statut,
    ifnull(prof.nom_formateur,'')as nom_formateur,
    ifnull(prof.prenom_formateur,'') as prenom_formateur,
    ifnull(v.ville,'') as ville
    
from 
    groupes g
    left join projets p on p.id = g.projet_id
    join type_formations tf on p.type_formation_id = tf.id
    left join v_nombre_participant_groupe npg on npg.groupe_id = g.id
    join v_cout_pedagogique_module cp on cp.groupe_id = g.id
    left join v_ville_formation v on v.groupe_id = g.id
    left join v_cout_frais_annexe fa on fa.groupe_id = g.id
    join moduleformation mf on mf.module_id = cp.module_id
    join domaines dm on dm.id = mf.domaine_id 
    join cfps cfp on p.cfp_id = cfp.id
    left join v_formateur_projet prof on g.id = prof.groupe_id
    left join v_groupe_entreprise vpe on g.id = vpe.groupe_id





    
    

