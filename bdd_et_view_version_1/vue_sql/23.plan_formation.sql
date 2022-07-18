
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

