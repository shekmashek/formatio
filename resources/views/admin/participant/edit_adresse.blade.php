@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<div class="col" style="margin-left: 25px">
    <a href="{{route('profile_stagiaire')}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp" > Page précédente</button></a>
  </div>
<center>                

<div class="col-lg-4">
    <div class="p-3 form-control">
        
        <form   class="btn-submit" action="{{route('update_stagiaire',$stagiaire->id)}}" method="post" enctype="multipart/form-data">
            @csrf
              
                    <input type="hidden" value="   {{ $stagiaire->nom_stagiaire }}" class="form-control test"  name="nom">
                
              
                        <input type="hidden" class="form-control test" value="   {{ $stagiaire->prenom_stagiaire }}"  name="prenom">
                      

  {{-- hidden --}}
  {{-- <p style="font-size: 20px;" class="ms-5">Profiles</p>
            <center>
                <div class="image-upload">
                  <label for="file-input">
                    <div class="upload-icon">
                      <img src="{{asset('images/stagiaires/'.$stagiaire->photos)}}" id = "photo_stg"  class="image-ronde">
                      {{-- <input type="text" id = 'vartemp'> --}}
                  {{-- </div>
                  </label>
                     <input id="file-input" type="file" name="image" value="{{$stagiaire->photos}}"/>
                  </div>
            </center> --}} 
                
                        <select hidden  value="{{$stagiaire->genre_stagiaire}}" name="genre" class="form-select test" id="genre"  >
                          <option value="{{$stagiaire->genre_stagiaire}}"  >Homme</option>
                          <option value="Femme">Femme</option>

                        </select>
                        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68;left:-45px">Genre</label> --}}
 
                        <select hidden value="{{$stagiaire->titre}}"  name="titre" class="form-control test" id="titre">
                            <option value="Mr">Mr</option>
                            <option value="Mme">Mme</option>
                            <option value="Mlle">Mlle</option>
                            <option value="Dr">Dr</option>
                            <option value="Prof">Prof</option>
                            <option value="Dir">Dir</option>
                            <option value="PDG">PDG</option>
                        </select>
                        {{-- <label class="ml-3 form-control-placeholder" >Titre</label> --}}

                      
                        <input type="hidden" class="form-control test" name="date" value="{{ $stagiaire->date_naissance }}">
                        
                          <input type="hidden" value="{{ $stagiaire->cin}}" class="form-control test"  name="cin" >

                        <input type="hidden" class="form-control test"  name="mail" value="   {{ $stagiaire->mail_stagiaire }}" >

                        
                        <input type="hidden" class="form-control test"  name="phone" value="  {{ $stagiaire->telephone_stagiaire }}"> 
                           
                       
                                            
                                <input type="hidden" class="form-control test" value=""  name="password" placeholder="">  
                        <div class="row px-3 mt-4">
                            <div class="form-group mt-1 mb-1">
                                <input type="text" class="form-control test input" id="lot" name="lot" placeholder="Lot" value="   {{ $stagiaire->lot}}">
                                <label class="ml-3 form-control-placeholder" >Lot</label>

                            </div>
                        </div>
                        <div class="row px-3 mt-4">
                            <div class="form-group mt-1 mb-1">
                          <input type="text" class="form-control test input" id="quartier" name="quartier" placeholder="Quartier" value="   {{ $stagiaire->quartier}}">
                          <label class="ml-3 form-control-placeholder" >Quartier</label>

                            </div>
                        </div>
                        <div class="row px-3 mt-4">
                            <div class="form-group mt-1 mb-1">
                         
                                <input type="text" class="form-control test input" id="code_postal" name="code_postal" placeholder="Code Postale" value="   {{ $stagiaire->code_postal}}">
                        <label class="ml-3 form-control-placeholder" >Code Postal</label>
                            
                            </div>
                        </div>
                        <div class="row px-3 mt-4">
                            <div class="form-group mt-1 mb-1">
                          
                                <input type="text" class="form-control test input" id="ville" name="ville" placeholder="Ville" value="   {{ $stagiaire->ville}}">
                        <label class="ml-3 form-control-placeholder" >Ville</label>
                            
                            </div>
                        </div>
                        <div class="row px-3 mt-4">
                            <div class="form-group mt-1 mb-1">
                                <input type="text" class="form-control test input" id="region" name="region" placeholder="Region" value="{{ $stagiaire->region}}">
                           <label class="ml-3 form-control-placeholder" >Region</label>
            
                            </div>
                        </div>
                    
                  <input type="hidden" class="form-control test"  name="niveau" value="   {{ $stagiaire->niveau_etude }}">
                    <input type="hidden" value="{{ $stagiaire->matricule}}"  class="form-control"  name="matricule" placeholder="Matricule" readonly>
            
                    <input type="hidden" class="form-control"  name="fonction" placeholder="Fonction" value="{{ $stagiaire->fonction_stagiaire }}" readonly>
                
                  
                    <input type="hidden" class="form-control"  name="entreprise"  value="{{ optional(optional($stagiaire)->entreprise)->nom_etp}}" readonly>
                
                    <input type="hidden" value="{{ $stagiaire->lieu_travail }}"  class="form-control"  name="lieu" placeholder="Matricule" readonly>
             
                 
                    <input type="hidden" class="form-control"  name="departement" value="{{ optional(optional($stagiaire)->departement)->nom_departement }}" readonly>
            
                 
                   
<button class="btn_enregistrer mt-1 btn modification "> Enregister</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center> 
</div>
</div>
</div>

@endsection