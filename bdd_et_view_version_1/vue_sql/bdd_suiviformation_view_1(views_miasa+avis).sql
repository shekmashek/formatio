CREATE OR REPLACE VIEW v_moduleformation AS SELECT
    m.id AS module_id,
    m.reference,
    m.nom_module,
    m.prix,
    m.duree,
    f.id AS formation_id,
    f.nom_formation,
    m.cfp_id
FROM
    modules m
JOIN formations f ON
    m.formation_id = f.id;


CREATE OR REPLACE VIEW v_detailmoduleformation AS SELECT
    d.id AS detail_id,
    d.lieu,
    d.h_debut,
    d.h_fin,
    d.date_detail,
    d.projet_id,
    d.groupe_id,
    d.formateur_id,
    mf.reference,
    mf.nom_module,
    mf.duree,
    mf.formation_id,
    mf.nom_formation,
    mf.cfp_id
FROM
    details d,
    v_moduleformation mf
WHERE
    d.cfp_id = mf.cfp_id;

CREATE OR REPLACE VIEW v_totale_session AS SELECT
    (projets.id) projet_id,
    (count(groupes.id)) totale_session
FROM
    projets left join groupes on projet_id = projets.id
GROUP BY
    projets.id;

CREATE OR REPLACE VIEW v_projetentreprise AS
SELECT
    p.id AS projet_id,
    p.nom_projet,
    p.created_at as date_projet,
    t_se.totale_session,
    p.entreprise_id,
    p.cfp_id,
    p.status,
    p.activiter,
    p.created_at,
    e.nom_etp,
    (e.adresse_rue) adresse,
    e.logo,
    e.nif,
    e.stat,
    e.rcs,
    e.cif,
    e.secteur_id,
    (se.nom_secteur)secteur_activite,
    e.email_etp,
    e.site_etp,
    (e.activiter) activiter_etp,
    e.telephone_etp,
    (cf.nom) nom_cfp,
    (cf.logo) logo_cfp,
    (cf.adresse_ville) adresse_ville_cfp,
    (cf.adresse_region) adresse_region_cfp,
    (cf.email) email_cfp,
    (cf.telephone) telephone_cfp,
    (cf.domaine_de_formation) domaine_de_formation_cfp
FROM
    projets p,
    entreprises e , secteurs se,v_totale_session t_se,cfps cf
where    p.entreprise_id = e.id and e.secteur_id = se.id and p.id = t_se.projet_id and p.cfp_id = cf.id;


CREATE OR REPLACE VIEW v_detailmoduleformationprojet AS SELECT
    dmf.*,
    pe.nom_projet,
    pe.entreprise_id,
    pe.nom_etp,
    pe.adresse,
    pe.logo
FROM
    v_detailmoduleformation dmf,
    v_projetentreprise pe
where
    dmf.projet_id = pe.projet_id and dmf.cfp_id = pe.cfp_id;


CREATE OR REPLACE VIEW v_detailmoduleformationprojetformateur AS SELECT
    dmfp.*,
    f.nom_formateur,
    f.prenom_formateur,
    f.photos,
    f.mail_formateur,
    f.numero_formateur,
    f.genre,
    f.date_naissance,
    (f.adresse) adresse_formateur,
    f.cin,
    f.specialite,
    f.niveau,
    (f.activiter) activiter_formateur,
    user_id
FROM
    v_detailmoduleformationprojet dmfp
JOIN formateurs f ON
    dmfp.formateur_id = f.id;


CREATE OR REPLACE VIEW v_participantsession AS SELECT
    g.projet_id,
	ps.stagiaire_id,
	ps.groupe_id,
	g.nom_groupe,
	g.date_debut,
	g.date_fin,
	(g.status) status_groupe,
	(g.activiter) activiter_groupe,
    s.matricule,
    s.nom_stagiaire,
    s.prenom_stagiaire,
    s.fonction_stagiaire,
    s.genre_stagiaire,
    s.mail_stagiaire,
    s.telephone_stagiaire,
    s.user_id,
    s.photos,
    (s.departement_entreprise_id) departement_id,
    s.cin,
    s.date_naissance,
    (s.lot) adresse,
    s.niveau_etude,
    (s.activiter) activiter_stagiaire,
    pe.nom_projet,
    pe.entreprise_id,
    pe.cfp_id,
    (pe.status) status_projet,
    (pe.activiter) activiter_projet
FROM
    participant_groupe ps,
 	stagiaires s,
     projets pe,
	 groupes g
where
    ps.stagiaire_id = s.id and ps.groupe_id = g.id and g.projet_id = pe.id and s.entreprise_id = pe.entreprise_id;


CREATE OR REPLACE VIEW v_coursfroidevaluation AS SELECT
    c.id AS cours_id,
    c.titre_cours,
    c.programme_id,
    IFNULL(fe.status, 0) AS status,
	fe.cfp_id,
    fe.projet_id,
    fe.stagiaire_id,
     s.matricule,
    s.nom_stagiaire,
    s.prenom_stagiaire,
    s.fonction_stagiaire,
    s.genre_stagiaire,
    s.mail_stagiaire,
    s.telephone_stagiaire,
    s.user_id,
    s.photos,
    (s.departement_entreprise_id) departement_id,
    s.cin,
    s.date_naissance,
    (s.lot) adresse,
    s.niveau_etude,
    (s.activiter) activiter_stagiaire
FROM
    cours c
LEFT JOIN froid_evaluations fe ON
    c.id = fe.cours_id
JOIN stagiaires s ON
    fe.stagiaire_id = s.id;


CREATE OR REPLACE VIEW v_cours_programme AS SELECT
    c.id AS cours_id,
    c.titre_cours,
    c.programme_id,
    p.titre,
    p.module_id,
    m.reference,
    m.nom_module,
    m.formation_id,
    m.prix,
    m.duree,
    m.prerequis,
    m.objectif,
    m.modalite_formation
FROM
    cours c
LEFT JOIN programmes p ON
    c.programme_id = p.id
JOIN modules m ON
    m.id = p.module_id;


CREATE OR REPLACE VIEW v_froid_evaluations AS SELECT
    id,
    cfp_id,
    cours_id,
    status,
    projet_id,
    stagiaire_id,
    CASE WHEN
status
    = 4 THEN '#018001' WHEN
status
    = 3 THEN '#3CFF01' WHEN
status
    = 2 THEN '#FFE601' WHEN
status
    = 1 THEN '#FF8801' WHEN
status
    = 0 THEN '#FF0000'
END couleur
FROM
    froid_evaluations;


create or replace view v_pourcentage_status as SELECT
    cfp_id,
    projet_id,
    stagiaire_id,
    (
        SUM(
    status
    ) /(4 * COUNT(cours_id))
    ) * 100 AS pourcentage
FROM
    froid_evaluations
GROUP BY
    cfp_id,
    projet_id,
    stagiaire_id;
create or replace view v_liste_avis as
    select module_id,stagiaire_id,commentaire,round(note/2,1) as note,nom_stagiaire,prenom_stagiaire,date_avis
    from avis a join stagiaires  s on a.stagiaire_id = s.id order by date_avis desc;

create or replace view v_avis as
    select module_id,round((sum(note)/count(note))/count(module_id),1) as pourcentage from avis group by module_id;

create or replace view v_nombre_avis_par_module as
    select module_id,count(*) as nombre from avis group by module_id;

create or replace view v_nombre_note as
    select module_id,round(note/2,1) as note,count(note) as nombre_note from avis group by module_id,note;

create or replace view v_moyenne_avis_module as
    select module_id,sum(note)/count(module_id) as moyenne_avis from v_nombre_note group by module_id;

create or replace view v_pourcentage_avis as
    select nn.module_id,ceil(nn.note) as note,nn.nombre_note,round((nn.nombre_note*100)/na.nombre,0) as pourcentage_note
    from v_nombre_note nn join v_nombre_avis_par_module na on nn.module_id=na.module_id
    order by nn.module_id,nn.note desc;

create or replace view v_module_nombre as select m.id,m.reference,m.nom_module,n.nombre from modules m cross join nombre n;

create or replace view v_statistique_avis as
select mn.id as module_id,mn.nombre,ifnull(pa.pourcentage_note,0) as pourcentage_note
from v_module_nombre mn left join v_pourcentage_avis pa
on mn.id = pa.module_id and mn.nombre = pa.note order by mn.id;

CREATE OR REPLACE VIEW moduleformation AS SELECT
    m.id AS module_id,
    m.reference,
    m.nom_module,
    m.prix,
    m.duree,
    m.modalite_formation,
    m.duree_jour,
    m.objectif,
    m.prerequis,
    m.description,
    m.materiel_necessaire,
    m.cible,
    m.niveau_id,
    m.prestation,
    m.bon_a_savoir,
    m.status,
    m.cfp_id,
    ifnull(m.max,0) as max_pers,
    ifnull(m.min,0) as min_pers,
    n.niveau,
    f.id AS formation_id,
    f.nom_formation,
    f.domaine_id,
    cfps.nom,
    cfps.logo,
    cfps.email,
    cfps.telephone,
    round(ifnull(a.moyenne_avis,0),1) as pourcentage
FROM
    modules m
JOIN formations f ON
    m.formation_id = f.id
JOIN cfps ON m.cfp_id = cfps.id
JOIN niveaux n ON
    n.id = m.niveau_id
left join v_moyenne_avis_module a on m.id = a.module_id;


CREATE OR REPLACE VIEW cfpcours AS SELECT
    m.id AS module_id,
    m.reference,
    m.nom_module,
    m.prix,
    m.duree,
    m.modalite_formation,
    m.duree_jour,
    m.objectif,
    m.prerequis,
    m.description,
    m.materiel_necessaire,
    m.cible,
    m.niveau_id,
    n.niveau,
    f.id AS formation_id,
    f.nom_formation,
    f.domaine_id,
    m.cfp_id,
    cfps.nom,
    cfps.logo,
    cfps.email,
    cfps.telephone,
    p.id AS id_programme,
    p.titre AS titre_programme
FROM
    modules m
JOIN formations f ON
    m.formation_id = f.id
JOIN cfps ON m.cfp_id = cfps.id
JOIN niveaux n ON
    n.id = m.niveau_id
JOIN programmes p ON
    p.module_id = m.id;



create or replace view v_detail_projet_groupe as
    select d.id as detail_id,d.lieu,d.h_debut,d.h_fin,d.date_detail,d.formateur_id,d.groupe_id,d.projet_id,
    d.cfp_id,p.nom_projet,p.entreprise_id,p.status as status_projet,p.activiter as activiter_projet,
    g.max_participant,g.min_participant,g.nom_groupe,g.module_id,g.date_debut,g.date_fin,
    g.status as status_groupe,g.activiter as activiter_groupe
    from details d join projets p on d.projet_id = p.id
    join groupes g on d.groupe_id = g.id;
create or replace view v_groupe as
select
groupes.id,
min_participant,
max_participant,
nom_groupe,
projet_id,
module_id,
date_debut,
date_fin,
groupes.status,
groupes.activiter,
projets.nom_projet,
reference,nom_module,formation_id,prix,duree,duree_jour,objectif,
nom_formation,domaine_id,
nom_domaine
from
groupes,modules,formations,domaines,projets,entreprises
where groupes.module_id = modules.id and formation_id = formations.id and domaine_id = domaines.id
and projet_id = projets.id and entreprise_id = entreprises.id;

CREATE OR REPLACE VIEW v_stagiaire_entreprise AS SELECT
    stg.id AS stagiaire_id,
    stg.matricule,
    stg.nom_stagiaire,
    stg.prenom_stagiaire,
    stg.genre_stagiaire,
    stg.fonction_stagiaire,
    stg.mail_stagiaire,
    stg.telephone_stagiaire,
    stg.entreprise_id,
    stg.user_id,
    stg.photos,
    (stg.departement_entreprise_id) departement_id,
    stg.service_id as stg_service_id,
    stg.cin,
    stg.date_naissance,
    (stg.lot) adresse,
    stg.lieu_travail,
    stg.niveau_etude,
    stg.activiter,
    etp.nom_etp,
    dept.nom_departement,
    serv.nom_service,
    serv.id as service_id
FROM
    stagiaires as stg,
    entreprises as etp,
    departement_entreprises as dept,
    services as serv
WHERE
    stg.entreprise_id = etp.id and
    stg.departement_entreprise_id = dept.id and stg.service_id = serv.id;

CREATE OR REPLACE VIEW v_historique_stagiaires AS SELECT
    stg.id AS stagiaire_id,
    stg.matricule,
    stg.nom_stagiaire,
    stg.prenom_stagiaire,
    stg.genre_stagiaire,
    stg.fonction_stagiaire,
    stg.mail_stagiaire,
    stg.telephone_stagiaire,
    stg.entreprise_id,
    stg.user_id,
    stg.photos,
    (stg.departement_entreprise_id) departement_entreprises_id,
    stg.cin,
    stg.date_naissance,
    (stg.lot) adresse,
    stg.lieu_travail,
    stg.niveau_etude,
    stg.activiter,
    etp.nom_etp,
    historique.stagiaire_id AS histo_stagiaire_id,
    historique.ancien_entreprise_id AS ancien_entreprise_id,
    historique.nouveau_entreprise_id AS nouveau_entreprise_id,
    historique.date_depart,
    historique.date_arrivee
FROM
    stagiaires as stg,
    entreprises as etp,
    historique_stagiaires as historique
WHERE
    stg.entreprise_id = etp.id and
    historique.stagiaire_id = stg.id;


