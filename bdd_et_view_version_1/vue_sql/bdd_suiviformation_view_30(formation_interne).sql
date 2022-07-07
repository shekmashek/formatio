-- Active: 1656400043423@@127.0.0.1@3306@bdd_nicole


CREATE OR REPLACE VIEW v_liste_avis_interne AS SELECT
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
DESC;
CREATE OR REPLACE VIEW v_avis_interne AS SELECT
    module_id,
    ROUND(
        (SUM(note) / COUNT(note)) / COUNT(module_id),
        1
    ) AS pourcentage
FROM
    avis_interne
GROUP BY
    module_id;
CREATE OR REPLACE VIEW v_nombre_avis_par_module_interne AS SELECT
    module_id,
    COUNT(*) AS nombre
FROM
    avis_interne
GROUP BY
    module_id;
CREATE OR REPLACE VIEW v_nombre_note_interne AS SELECT
    module_id,
    ROUND(note / 2, 1) AS note,
    COUNT(note) AS nombre_note
FROM
    avis_interne
GROUP BY
    module_id,
    note;
CREATE OR REPLACE VIEW v_moyenne_avis_module_interne AS SELECT
    module_id,
    SUM(note) / COUNT(module_id) AS moyenne_avis
FROM
    v_nombre_note_interne
GROUP BY
    module_id;
CREATE OR REPLACE VIEW v_pourcentage_avis_interne AS SELECT
    nn.module_id,
    CEIL(nn.note) AS note,
    nn.nombre_note,
    ROUND(
        (nn.nombre_note * 100) / na.nombre,
        0
    ) AS pourcentage_note
FROM
    v_nombre_note_interne nn
JOIN v_nombre_avis_par_module_interne na ON
    nn.module_id = na.module_id
ORDER BY
    nn.module_id,
    nn.note
DESC;

CREATE OR REPLACE VIEW v_module_nombre_interne AS SELECT
    m.id,
    m.reference,
    m.nom_module,
    n.nombre
FROM
    modules_interne m
CROSS JOIN nombre n;

CREATE OR REPLACE VIEW v_statistique_avis_interne AS SELECT
    mn.id AS module_id,
    mn.nombre,
    IFNULL(pa.pourcentage_note, 0) AS pourcentage_note
FROM
    v_module_nombre_interne mn
LEFT JOIN v_pourcentage_avis_interne pa ON
    mn.id = pa.module_id AND mn.nombre = pa.note
ORDER BY
    mn.id;

CREATE OR REPLACE VIEW v_moduleformation_interne AS SELECT
    m.id AS module_id,
    m.reference,
    m.nom_module,
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
    m.etp_id,
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
    etp.nom_etp,
    etp.logo,
    etp.email_etp,
    etp.telephone_etp,
    ROUND(IFNULL(a.moyenne_avis, 0),
    1) AS pourcentage
FROM
    modules_interne m
JOIN formations f ON
    m.formation_id = f.id
JOIN entreprises etp ON m.etp_id = etp.id
JOIN niveaux n ON
    n.id = m.niveau_id
LEFT JOIN v_moyenne_avis_module_interne a ON
    m.id = a.module_id;

CREATE OR REPLACE VIEW v_pourcentage_total_module_etp_interne AS SELECT
    SUM(vpa.pourcentage_note * vpa.nombre_note) as nb_pourcent,
    SUM(vpa.nombre_note) as nombre_note,
    md.etp_id
from v_pourcentage_avis_interne as vpa
join v_moduleformation_interne as md on vpa.module_id = md.module_id
where md.module_id = vpa.module_id;

CREATE OR REPLACE VIEW v_cours_programme_interne AS SELECT
    c.id AS cours_id,
    c.titre_cours,
    c.programme_id,
    p.titre,
    p.module_id,
    m.reference,
    m.nom_module,
    m.formation_id,
    m.duree,
    m.prerequis,
    m.objectif,
    m.modalite_formation,
    m.etat_id
FROM
    cours_interne c
LEFT JOIN programmes_interne p ON
    c.programme_id = p.id
JOIN modules_interne m ON
    m.id = p.module_id;