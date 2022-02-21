CREATE OR REPLACE VIEW v_pagination_facture AS SELECT
    cfp_id,
    (
       ROUND(COUNT(id)/10)
) totale_pagination
FROM
    factures
GROUP BY
    cfp_id;



    -- requete ampiasaina rhf manw find pagination

    -- select * from facture where cfp_id=? limit val,10