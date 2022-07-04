create or replace view v_module as select
modules.*,formations.nom_formation,niveaux.niveau
from modules,formations,niveaux where modules.formation_id = formations.id and niveaux.id = modules.niveau_id;
 

create or replace view v_formation as select
(formation_id) id,nom_formation,cfp_id
from v_module group by formation_id,nom_formation,cfp_id;