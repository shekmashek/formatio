@extends('./layouts/admin')
@section('content')
<style>
   .input{
        width: 170px;
    }
.test {
    padding: 2px;
    border-radius: 5px;
    box-sizing: border-box;
    color: #9E9E9E;
    border: 1px solid #BDBDBD;
    font-size: 16px;
    letter-spacing: 1px;
    height: 50px !important
}

.test:focus{
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 2px solid #E53935 !important;
    outline-width: 0 !important;
}

.form-control-placeholder {
  position: absolute;
  top: 1rem;
  padding: 12px 2px 0 2px;
  padding: 0;
  padding-top: 2px;
  padding-bottom: 5px;
  transition: all 300ms;
  opacity: 0.5;
  left: 2rem;
}

.test:focus+.form-control-placeholder,
.test:valid+.form-control-placeholder {
  font-size: 95%;
  font-weight: bolder;
  top: 1.5rem;
  transform: translate3d(0, -100%, 0);
  opacity: 1;
  background-color: white;
  margin-left: 105px;

}
</style>
<center>                

<div class="col-lg-4">
    <div class="p-3 form-control">
        <p style="text-align: left">Modifier le nom</p>
        <form   class="btn-submit" action="{{route('utilisateur_update_cfp',$cfp->id)}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                    <input type="text" value="   {{ $cfp->nom }}" class="form-control test input"  name="nom_cfp">
                    <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label>
                    </div>
                </div>
                        <input type="hidden" class="form-control test" name="adresse_lot"  value="{{ $cfp->adresse_lot }}" >
                          <input type="hidden" value="{{ $cfp->adresse_ville}}" class="form-control test"  name="adresse_ville" >

                        <input type="hidden" class="form-control test"  name="adresse_region" value="{{ $cfp->adresse_region }}" >

                        <input type="hidden" class="form-control test" name="phone" value="{{ $cfp->telephone }}">
                        <input type="hidden" class="form-control test" value=""  name="password" placeholder="">  
                          
                    
                  <input class="form-control test"  type="hidden" name="mail" value="{{ $cfp->email }}">
                    <input type="hidden" value="{{ $cfp->site_cfp}}"  class="form-control"  name="site_web" placeholder="" >
            
                    <input type="hidden" class="form-control"  name="domaine_cfp" placeholder="Fonction" value="{{ $cfp->domaine_de_formation }}" >
                
                  
                    <input type="hidden" class="form-control"  name="nif_cfp"  value="{{ $cfp->nif}}" >
                
                    <input type="hidden" value="{{ $cfp->stat}}"  class="form-control"  name="stat_cfp" placeholder="Matricule" >
             
                 
                    <input type="hidden" class="form-control"  name="cif_cfp" value="{{ $cfp->cif }}" >
                    <input type="hidden" class="form-control"  name="rcs_cfp" value="{{ $cfp->rcs }}" >

            
                 
                   
<button style=" background-color: #801D68;color:white;float: right;" class=" mt-1 btn modification "> Enregister</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center> 
</div>
</div>
</div>

@endsection