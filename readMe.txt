1-->: Collaboration_version_2.2
- ajout table dans bdd_suiviformation_mise_a_jour(collaboration):
    .refuse_demmande_cfp_etp
    .refuse_demmande_etp_cfp
- ajout vue dans bdd_suiviformation_view_21:
    .jiaby

2-->: inscription_1.0

    - edit table cfps:
        . alter table cfps add column adresse_rue varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;
        . alter table cfps add column adresse_quartier varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;
        . alter table cfps add column adresse_code_postal varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;

    -ajout nouveau table responsable cfp dans bdd_suiviformation_mise_a_jour(table_mere).sql :
        . table: responables_cfp

    - edit table entreprises:
        . alter table entreprises add column adresse_rue varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;
        . alter table entreprises add column adresse_quartier varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;
        . alter table entreprises add column adresse_code_postal varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;
        . alter table entreprises add column adresse_ville varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;
        . alter table entreprises add column adresse_region varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;

     - edit table responsables:
        . alter table responsables add column  sexe_resp varchar(255) COLLATE utf8mb4_unicode_ci;
        . alter table responsables add column date_naissance_resp date NOT NULL;
        . alter table responsables add column poste_resp varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL;
        . alter table responsables add column departement_id bigint(20) UNSIGNED NOT NULL REFERENCES departements(id) ON DELETE CASCADE;
        . alter table responsables add column adresse_lot varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;
        . alter table responsables add column adresse_rue varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;
        . alter table responsables add column adresse_quartier varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;
        . alter table responsables add column adresse_code_postal varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;
        . alter table responsables add column adresse_ville varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;
        . alter table responsables add column adresse_region varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL;
