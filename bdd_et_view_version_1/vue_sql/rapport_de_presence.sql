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
        when (sum(e.statut_presence) - n.total_stagiaire) = 0 then 'Présent' 
        when (sum(e.statut_presence) - n.total_stagiaire) < 0 and sum(e.statut_presence) > 0 then 'Partiellement présent'
        when sum(e.statut_presence) = 0 then 'Absent'
    end statut_presence_groupe
from v_emargement e join v_nombre_participant_groupe n on e.groupe_id = n.groupe_id
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
