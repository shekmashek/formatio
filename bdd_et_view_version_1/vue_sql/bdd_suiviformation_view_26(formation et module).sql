create or replace view v_module as select
modules.*,formations.nom_formation
from modules,formations where modules.formation_id = formations.id;


create or replace view v_formation as select
(formation_id) id,nom_formation,cfp_id
from v_module group by formation_id,nom_formation,cfp_id;