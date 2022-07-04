

CREATE OR REPLACE VIEW v_encaissement AS SELECT
    encaissements.*,
    factures.entreprise_id,
    mf.description
FROM
    encaissements
JOIN mode_financements mf ON
    encaissements.mode_financement_id = mf.id
JOIN factures ON factures.num_facture = encaissements.num_facture;