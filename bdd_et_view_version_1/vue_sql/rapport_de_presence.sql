create or replace view v_nombre_detail_groupe as
select
    groupe_id,
    count(id) as nombre_detail
from details group by groupe_id;

create or replace view v_rapport_presence as
select
    e.groupe_id,
    stagiaire_id,
    matricule,
    nom_stagiaire,
    prenom_stagiaire,
    genre_stagiaire,
    fonction_stagiaire,
    mail_stagiaire,
    telephone_stagiaire,
    photos,
    sans_photos,
    case 
        when (sum(e.statut_presence) - n.nombre_detail) = 0 then 'Présent' 
        when (sum(e.statut_presence) - n.nombre_detail) < 0 and sum(e.statut_presence) > 0 then 'Présent partiellement'
        when sum(e.statut_presence) = 0 then 'Absent'
    end statut_presence_groupe_text,
    case 
        when (sum(e.statut_presence) - n.nombre_detail) = 0 then '2' 
        when (sum(e.statut_presence) - n.nombre_detail) < 0 and sum(e.statut_presence) > 0 then '1'
        when sum(e.statut_presence) = 0 then '0'
    end statut_presence_groupe,
    n.nombre_detail - sum(e.statut_presence)  as nombre_presence
from v_emargement e join v_nombre_detail_groupe n on e.groupe_id = n.groupe_id
group by 
    e.groupe_id,
    stagiaire_id,
    matricule,
    nom_stagiaire,
    prenom_stagiaire,
    genre_stagiaire,
    fonction_stagiaire,
    mail_stagiaire,
    telephone_stagiaire,
    photos,
    sans_photos;
