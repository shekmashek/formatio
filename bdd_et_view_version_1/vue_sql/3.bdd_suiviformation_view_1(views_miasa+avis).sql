CREATE OR REPLACE VIEW v_moduleformation AS SELECT
    m.id AS module_id,
    m.reference,
    m.nom_module,
    m.prix,
    m.prix_groupe,
    m.duree,
    m.etat_id,
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

CREATE OR REPLACE VIEW v_detailmoduleformationprojet AS SELECT
    dmf.*,
    pe.entreprise_id,
    pe.nom_etp,
    pe.adresse_rue,
    pe.adresse_quartier,
    pe.adresse_code_postal,
    pe.adresse_ville,
    pe.adresse_region,
    pe.logo
FROM
    v_detailmoduleformation dmf,
    v_groupe_entreprise pe
where
    dmf.projet_id = pe.projet_id;


CREATE OR REPLACE VIEW v_detailmoduleformationprojetformateur AS SELECT
    dmfp.*,
    f.nom_formateur,
    f.prenom_formateur,
    f.photos,
    f.mail_formateur,
    f.numero_formateur,
    (f.genre_id) genre,
    f.date_naissance,
    (f.adresse) adresse_formateur,
    f.cin,
    f.specialite,
    f.niveau_etude_id,
    (f.activiter) activiter_formateur,
    pj.id,
    pj.nom_projet,
    pj.type_formation_id,
    pj.status,
    pj.activiter,
    user_id
FROM
    v_detailmoduleformationprojet dmfp
JOIN formateurs f ON
    dmfp.formateur_id = f.id
JOIN projets pj ON
    dmfp.projet_id = pj.id;

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
    m.prix_groupe,
    m.duree,
    m.prerequis,
    m.objectif,
    m.modalite_formation,
    m.etat_id
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
STATUS
    ,
    projet_id,
    stagiaire_id,
    CASE WHEN
STATUS
    = 4 THEN '#018001' WHEN
STATUS
    = 3 THEN '#3CFF01' WHEN
STATUS
    = 2 THEN '#FFE601' WHEN
STATUS
    = 1 THEN '#FF8801' WHEN
STATUS
    = 0 THEN '#FF0000'
END couleur
FROM
    froid_evaluations;
CREATE OR REPLACE VIEW v_pourcentage_status AS SELECT
    cfp_id,
    projet_id,
    stagiaire_id,
    (
        SUM(
    STATUS
    ) /(4 * COUNT(cours_id))
    ) * 100 AS pourcentage
FROM
    froid_evaluations
GROUP BY
    cfp_id,
    projet_id,
    stagiaire_id;
CREATE OR REPLACE VIEW v_liste_avis AS SELECT
    module_id,
    stagiaire_id,
    commentaire,
    ROUND(note / 2, 1) AS note,
    nom_stagiaire,
    prenom_stagiaire,
    date_avis
FROM
    avis a
JOIN stagiaires s ON
    a.stagiaire_id = s.id
ORDER BY
    date_avis
DESC
    ;
CREATE OR REPLACE VIEW v_avis AS SELECT
    module_id,
    ROUND(
        (SUM(note) / COUNT(note)) / COUNT(module_id),
        1
    ) AS pourcentage
FROM
    avis
GROUP BY
    module_id;
CREATE OR REPLACE VIEW v_nombre_avis_par_module AS SELECT
    module_id,
    COUNT(*) AS nombre
FROM
    avis
GROUP BY
    module_id;
    CREATE OR REPLACE VIEW v_nombre_note AS SELECT
        module_id,
        ROUND(note / 2, 1) AS note,
        COUNT(note) AS nombre_note
    FROM
        avis
    GROUP BY
        module_id,
        note;
CREATE OR REPLACE VIEW v_moyenne_avis_module AS SELECT
    module_id,
    SUM(note) / COUNT(module_id) AS moyenne_avis
FROM
    v_nombre_note
GROUP BY
    module_id;
CREATE OR REPLACE VIEW v_pourcentage_avis AS SELECT
    nn.module_id,
    CEIL(nn.note) AS note,
    nn.nombre_note,
    ROUND(
        (nn.nombre_note * 100) / na.nombre,
        0
    ) AS pourcentage_note
FROM
    v_nombre_note nn
JOIN v_nombre_avis_par_module na ON
    nn.module_id = na.module_id
ORDER BY
    nn.module_id,
    nn.note
DESC
    ;
CREATE OR REPLACE VIEW v_module_nombre AS SELECT
    m.id,
    m.reference,
    m.nom_module,
    n.nombre
FROM
    modules m
CROSS JOIN nombre n;
CREATE OR REPLACE VIEW v_statistique_avis AS SELECT
    mn.id AS module_id,
    mn.nombre,
    IFNULL(pa.pourcentage_note, 0) AS pourcentage_note
FROM
    v_module_nombre mn
LEFT JOIN v_pourcentage_avis pa ON
    mn.id = pa.module_id AND mn.nombre = pa.note
ORDER BY
    mn.id;

CREATE OR REPLACE VIEW moduleformation AS SELECT
    m.id AS module_id,
    m.reference,
    m.nom_module,
    m.prix,
    m.prix_groupe,
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
    m.etat_id,
    m.created_at,
    (
    IFNULL(
            (
                DATEDIFF(m.created_at, NOW()) +3),
                0
            )
    ) jours_restant,
    IFNULL(m.max, 0) AS max_pers,
    IFNULL(m.min, 0) AS min_pers,
    n.niveau,
    f.id AS formation_id,
    f.nom_formation,
    f.domaine_id,
    cfps.nom,
    cfps.logo,
    cfps.email,
    cfps.telephone,
    ROUND(IFNULL(a.moyenne_avis, 0),
    1) AS pourcentage
FROM
    modules m
JOIN formations f ON
    m.formation_id = f.id
JOIN cfps ON m.cfp_id = cfps.id
JOIN niveaux n ON
    n.id = m.niveau_id
LEFT JOIN v_moyenne_avis_module a ON
    m.id = a.module_id;

CREATE OR REPLACE VIEW v_pourcentage_total_module_cfp AS SELECT
    SUM(vpa.pourcentage_note * vpa.nombre_note) as nb_pourcent,
    SUM(vpa.nombre_note) as nombre_note,
    md.cfp_id
    from v_pourcentage_avis as vpa
    join moduleformation as md on vpa.module_id = md.module_id
    where md.module_id = vpa.module_id;



CREATE OR REPLACE VIEW cfpcours AS SELECT
    m.id AS module_id,
    m.reference,
    m.nom_module,
    m.prix,
    m.prix_groupe,
    m.duree,
    m.modalite_formation,
    m.duree_jour,
    m.objectif,
    m.prerequis,
    m.description,
    m.materiel_necessaire,
    m.cible,
    m.niveau_id,
    m.etat_id,
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


-- create or replace view v_detail_projet_groupe as
--     select d.id as detail_id,d.lieu,d.h_debut,d.h_fin,d.date_detail,d.formateur_id,d.groupe_id,d.projet_id,
--     d.cfp_id,p.nom_projet,p.entreprise_id,p.status as status_projet,p.activiter as activiter_projet,
--     g.max_participant,g.min_participant,g.nom_groupe,g.module_id,g.date_debut,g.date_fin,
--     g.status as status_groupe,g.activiter as activiter_groupe
--     from details d join projets p on d.projet_id = p.id
--     join groupes g on d.groupe_id = g.id;

-- create or replace view v_groupe as
-- select
-- groupes.id,
-- min_participant,
-- max_participant,
-- nom_groupe,
-- projet_id,
-- module_id,
-- date_debut,
-- date_fin,
-- groupes.status,
-- groupes.activiter,
-- projets.nom_projet,
-- reference,nom_module,formation_id,prix,duree,duree_jour,objectif,
-- nom_formation,domaine_id,
-- nom_domaine
-- from
-- groupes,modules,formations,domaines,projets,entreprises
-- where groupes.module_id = modules.id and formation_id = formations.id and domaine_id = domaines.id
-- and projet_id = projets.id and entreprise_id = entreprises.id;

create or replace view v_departement_service_entreprise as
    select
        s.id as service_id,
        s.departement_entreprise_id,
        s.nom_service,
        de.nom_departement,
        de.entreprise_id
    from services s
    join departement_entreprises de on s.departement_entreprise_id = de.id;

CREATE OR REPLACE VIEW v_stagiaire_entreprise AS SELECT
    stg.id AS stagiaire_id,
    stg.matricule,
    stg.nom_stagiaire,
    stg.prenom_stagiaire,
    stg.genre_stagiaire,
    stg.fonction_stagiaire,
    stg.mail_stagiaire,
    stg.telephone_stagiaire,
    stg.user_id,
    stg.photos,
    stg.cin,
    stg.date_naissance,
    stg.activiter,
    stg.branche_id,
    stg.quartier,
    stg.code_postal,
    stg.ville,
    stg.region,
    stg.lot,
    b.nom_branche,
    (e.id) entreprise_id,
    e.nom_etp,
    e.adresse_rue,
    e.adresse_quartier,
    e.adresse_code_postal,
    e.adresse_ville,
    e.adresse_region,
    e.logo,
    e.nif,
    e.stat,
    e.rcs,
    e.cif,
    e.secteur_id,
    e.email_etp,
    e.site_etp,
    (e.activiter) activiter_etp,
    e.telephone_etp,
    ds.nom_service,
    ds.service_id,
    ds.departement_entreprise_id,
    ds.nom_departement,
    niveau.id as niveau_etude_id,
    niveau.niveau_etude,
    gr.genre
FROM
    stagiaires as stg
    join entreprises e
    on stg.entreprise_id = e.id
    left join v_departement_service_entreprise ds
    on ds.service_id = stg.service_id
    left join branches b
    on b.id = stg.branche_id
    join niveau_etude niveau
    on niveau.id = stg.niveau_etude_id
    join genre gr
    on gr.id = stg.genre_id;


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
    stg.cin,
    stg.date_naissance,
    (stg.lot) adresse,
    stg.niveau_etude_id,
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
    historique_stagiaires as historique,
     branches as branche
WHERE
    stg.entreprise_id = etp.id and
    historique.stagiaire_id = stg.id and    stg.entreprise_id = branche.entreprise_id;