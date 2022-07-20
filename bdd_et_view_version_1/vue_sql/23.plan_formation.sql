CREATE OR REPLACE VIEW v_besoins_stagiaires AS SELECT 
besoin.id as besoin_id,
d.nom_domaine,
f.nom_formation,
f.domaine_id,
f.id as formation_id,
besoin.stagiaire_id ,
besoin.objectif,

besoin.date_previsionnelle as date_prev,
besoin.organisme,
besoin.statut,
besoin.type,
besoin.reponse_stagiaire,
besoin.arbitrage,
stg.entreprise_id,
stg.matricule,
stg.nom_stagiaire,
stg.prenom_stagiaire,
stg.genre_stagiaire,
stg.fonction_stagiaire,
stg.poste_emp,
stg.mail_stagiaire,
stg.telephone_stagiaire,
stg.user_id,
stg.prioriter_emp,
stg.service_id,
stg.nom_service,
stg.branche_id,
stg.departement_entreprises_id,
stg.nom_departement,
plan.id as anneePlan_id,
plan.AnneePlan,
plan.debut_rec,
plan.fin_rec
FROM 
	domaines d JOIN formations f ON d.id = f.domaine_id
	JOIN besoin_stagiaire besoin ON besoin.domaines_id = d.id AND besoin.thematique_id = f.id
    JOIN plan_formation_valide plan ON plan.id = besoin.anneePlan_id AND plan.entreprise_id = besoin.entreprise_id
    LEFT JOIN stagiaires stg ON stg.id = besoin.stagiaire_id AND besoin.entreprise_id = stg.entreprise_id;
CREATE or REPLACE view v_stagiaire_departement as
select b.stagiaire_id,s.matricule,s.nom_stagiaire,prenom_stagiaire,s.fonction_stagiaire,s.entreprise_id,s.nom_departement,s.nom_service,s.departement_entreprises_id,s.service_id ,b.anneePlan_id
from besoin_stagiaire b left join stagiaires s on s.id = b.stagiaire_id GROUP BY b.stagiaire_id,s.matricule,s.nom_stagiaire,prenom_stagiaire,s.entreprise_id,s.fonction_stagiaire,s.nom_departement,s.nom_service,s.departement_entreprises_id,s.service_id,b.anneePlan_id;

CREATE or REPLACE VIEW v_stagiaire_module as 
select b.thematique_id,b.stagiaire_id,b.entreprise_id,f.nom_formation,b.anneePlan_id from besoin_stagiaire b
left join formations f on f.id = b.thematique_id
GROUP BY b.entreprise_id,f.nom_formation,b.thematique_id

CREATE or replace VIEW v_stagiaire_departement_budget_plan as
SELECT sd.entreprise_id,sd.nom_departement,sd.departement_entreprises_id,bp.budget,sd.anneePlan_id
from v_besoins_stagiaires sd 
left join  budget_plan bp on bp.departement_id = sd.departement_entreprises_id and sd.entreprise_id = bp.entreprise_id and sd.anneePlan_id = bp.plan_id
GROUP BY sd.entreprise_id,sd.nom_departement,sd.departement_entreprises_id,sd.anneePlan_id;

CREATE or REPLACE VIEW v_stagiaire_module_budget_plan as 
SELECT sm.entreprise_id,sm.nom_formation,sm.thematique_id,bp.budget,sm.anneePlan_id
from v_stagiaire_module sm
left join  budget_plan bp on bp.thematique_id = sm.thematique_id and sm.entreprise_id = bp.entreprise_id and sm.anneePlan_id = bp.plan_id
GROUP BY sm.entreprise_id,sm.nom_formation,sm.thematique_id;

