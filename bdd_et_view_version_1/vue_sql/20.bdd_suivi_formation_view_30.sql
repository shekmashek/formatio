
CREATE OR REPLACE VIEW v_entreprise_iframe as SELECT
    e.id as entreprise_id,
    e.statut_compte_id,
    e.nom_etp,
    i.iframe
FROM iframe_entreprise i
RIGHT JOIN entreprises e ON e.id = i.entreprise_id;

CREATE OR REPLACE VIEW v_cfp_iframe as SELECT
    c.id as cfp_id,
    c.nom,
    c.statut_compte_id,
    i.iframe
FROM iframe_cfp i
RIGHT JOIN cfps c ON c.id = i.cfp_id;