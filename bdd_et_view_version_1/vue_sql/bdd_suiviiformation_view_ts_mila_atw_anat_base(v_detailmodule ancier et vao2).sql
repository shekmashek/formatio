-- vao2
CREATE OR REPLACE VIEW v_detailmodule AS SELECT
SELECT
    d.id AS detail_id,
    d.lieu,
    d.h_debut,
    d.h_fin,
    d.date_detail,
    d.formateur_id,
    d.projet_id,
    d.groupe_id,
    d.cfp_id,
    g.max_participant,
    g.min_participant,
    g.nom_groupe,
    g.module_id,
    g.date_debut,
    g.date_fin,
    g.status,
    g.activiter,
    mf.reference,
    mf.nom_module,
    mf.formation_id,
    mf.nom_formation,
    f.nom_formateur,
    f.prenom_formateur,
    f.mail_formateur,
    f.numero_formateur,
    p.nom_projet,
    p.entreprise_id,
    (c.nom) nom_cfp
FROM
    details d
JOIN groupes g ON
    d.groupe_id = g.id
JOIN moduleformation mf ON
    mf.module_id = g.module_id
JOIN formateurs f ON
    f.id = d.formateur_id
JOIN projets p ON
    d.projet_id = p.id
JOIN cfps c ON
    p.cfp_id = c.id
GROUP BY
 d.id,
d.lieu,
d.h_debut,
d.h_fin,
d.date_detail,
d.formateur_id,
d.projet_id,
d.groupe_id,
d.cfp_id,
g.max_participant,
g.min_participant,
g.nom_groupe,
g.module_id,
g.date_debut,
g.date_fin,
g.status,
g.activiter,
mf.reference,
mf.nom_module,
mf.formation_id,
mf.nom_formation,
f.nom_formateur,
f.prenom_formateur,
f.mail_formateur,
f.numero_formateur,
p.nom_projet,
c.nom,
p.entreprise_id
;




-- taloha
CREATE OR REPLACE VIEW v_detailmodule AS SELECT
SELECT
    d.id AS detail_id,
    d.lieu,
    d.h_debut,
    d.h_fin,
    d.date_detail,
    d.formateur_id,
    d.projet_id,
    d.groupe_id,
    d.cfp_id,
    g.max_participant,
    g.min_participant,
    g.nom_groupe,
    g.module_id,
    g.date_debut,
    g.date_fin,
    g.status,
    g.activiter,
    mf.reference,
    mf.nom_module,
    mf.formation_id,
    mf.nom_formation,
    f.nom_formateur,
    f.prenom_formateur,
    f.mail_formateur,
    f.numero_formateur,
    p.nom_projet,
    p.entreprise_id,
    (c.nom) nom_cfp
FROM
    details d
JOIN groupes g ON
    d.groupe_id = g.id
JOIN moduleformation mf ON
    mf.module_id = g.module_id
JOIN formateurs f ON
    f.id = d.formateur_id
JOIN projets p ON
    d.projet_id = p.id
JOIN cfps c ON
    p.cfp_id = c.id
GROUP BY
 d.id,
d.lieu,
d.h_debut,
d.h_fin,
d.date_detail,
d.formateur_id,
d.projet_id,
d.groupe_id,
d.cfp_id,
g.max_participant,
g.min_participant,
g.nom_groupe,
g.module_id,
g.date_debut,
g.date_fin,
g.status,
g.activiter,
mf.reference,
mf.nom_module,
mf.formation_id,
mf.nom_formation,
f.nom_formateur,
f.prenom_formateur,
f.mail_formateur,
f.numero_formateur,
p.nom_projet,
c.nom,
p.entreprise_id
;
