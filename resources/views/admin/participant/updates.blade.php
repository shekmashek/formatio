@extends('./layouts/admin')
@section('content')
<style>
    
       .image-ronde{
  width : 120px; height : 120px;
  border: none;
  -moz-border-radius : 75px;
  -webkit-border-radius : 75px;
  border-radius : 75px;
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
  }
  label{}
</style>
<br>

<div class="shadow p-3 mb-5 bg-body rounded">
  <center>
  <p style="font-size: 20px;" >Mon compte</p>
  </center>
  
  <div class="formation__item set-bg" id>
    <form   class="btn-submit" action="{{route('update_stagiaire',$stagiaire->id)}}" method="get" >
      @csrf
    <div class="row">
      <div class="col-lg-4 col-md-6">
        <div class="formation-service">
        <p style="font-size: 17px;color:gray" class="ms-5">Profiles</p>
            <center>
                <div class="image-upload">
                  <label for="file-input">
                    <div class="upload-icon">
                      <img src="{{asset('images/stagiaires/'.$stagiaire->photos)}}"  id = "photo_stg"  class="image-ronde">
                      {{-- <input type="text" id = 'vartemp'> --}}
                  </div>
                  </label>
                  <input id="file-input" type="file" name="image" value="{{$stagiaire->photos}}"/>
                  </div>
            </center>
                <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                        
                        <input type="text" value="   {{ $stagiaire->nom_stagiaire }}" class="form-control test"  name="nom" style="font-size:15px">
                        <label class="ml-3 form-control-placeholder"  style="font-size:13px;color:gray">Nom</label>
                      </div> 
                </div> 
                  
                <div class="row px-3 mt-4">
                  <div class="form-group mt-1 mb-1">
                        <input type="text" class="form-control test" value="   {{ $stagiaire->prenom_stagiaire }}"  name="prenom" style="font-size:15px">
                        <label class="ml-3 form-control-placeholder"style="font-size:13px;color:gray" >Prénom</label>
                     
                      </div>
                </div> 
                <div class="row px-3 mt-4">
                  <div class="form-group mt-1 mb-1">
                  
                        <select value="   {{$stagiaire->genre_stagiaire}}" name="genre" class="form-select test" id="genre" style="font-size:15px">
                       
                          <option value="Homme"  selected >Homme</option>
                          <option value="Femme">Femme</option>
                      
                        </select>
                        <label class="ml-3 form-control-placeholder" style="font-size:13px;color:gray">Genre</label>

                      </div>
                    </div>

                    <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                        <select value="   {{$stagiaire->titre}}"  name="titre" class="form-control test" id="titre" style="font-size:15px">
                            <option value="Monsieur">Mr</option>
                            <option value="Mme">Mme</option>
                            <option value="Mlle">Mlle</option>
                            <option value="Dr">Dr</option>
                            <option value="Prof">Prof</option>
                            <option value="Dir">Dir</option>
                            <option value="PDG">PDG</option>
                        </select>
                        <label class="ml-3 form-control-placeholder" style="font-size:13px;color:gray" >Titre</label>

                      </div>
                    </div>
                    
                    <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                        <input type="date" class="form-control test" name="date" value="   {{ $stagiaire->date_naissance }}" style="font-size:15px">
                        <label class="ml-3 form-control-placeholder" style="font-size:13px;color:gray">Date de Naissance</label>
                      
                      </div>
                    </div>
                    <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                          <input type="text" value="   {{ $stagiaire->cin}}" class="form-control test"  name="cin"  style="font-size:15px">
                          <label  class="ml-3 form-control-placeholder"  style="font-size:13px;color:gray" >CIN</label>
                      
                        </div> 
                    </div> 

                     <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                        <input type="email" class="form-control test"  name="mail" value="   {{ $stagiaire->mail_stagiaire }}" style="font-size:15px" >
                        <label class="ml-3 form-control-placeholder"  style="font-size:13px;color:gray">E-mail</label>
                      
                      </div>
                    </div> 

                        <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                        <input type="text" class="form-control test"  name="phone" value="   {{ $stagiaire->telephone_stagiaire }}" style="font-size:15px">
                        <label class="ml-3 form-control-placeholder" style="font-size:13px;color:gray">Téléphone</label>
                      </div>
                        </div>

                       <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                        <input type="password" class="form-control test" value=""  name="password" placeholder="" style="font-size:15px"> 
                        <label class="ml-3 form-control-placeholder" style="font-size:13px;color:gray" >Mot de passe</label>
                      
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-6">
                   <div class="formation-service">
                <p style="font-size: 17px;color:gray" class="ms-5">Informations Personnelles</p>
                        
                       <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                          <input type="text" class="form-control test" id="lot" name="lot" placeholder="Lot" value="   {{ $stagiaire->lot}}" style="font-size:15px">
                          <label  class="ml-3 form-control-placeholder" style="font-size:13px;color:gray" >Lot</label>
                          
                      </div> 
                    </div> 
                    
                     <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                          <input type="text" class="form-control test" id="quartier" name="quartier" placeholder="Quartier" value="   {{ $stagiaire->quartier}}"style="font-size:15px">
                          <label  class="ml-3 form-control-placeholder" style="font-size:13px;color:gray" > Quartier</label>

                        </div>
                      </div>
                     <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                          <input type="text" class="form-control test" id="code_postal" name="code_postal" placeholder="Code Postale" value="   {{ $stagiaire->code_postal}}" style="font-size:15px">
                          <label class="ml-3 form-control-placeholder" style="font-size:13px;color:gray">Code Postale</label>
                        </div>
                      </div>
                     <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                          <input type="text" class="form-control test" id="ville" name="ville" placeholder="Ville" value="   {{ $stagiaire->ville}}" style="font-size:15px">
                          <label class="ml-3 form-control-placeholder" style="font-size:13px;color:gray">Ville</label>
                      
                        </div>
                    </div>

                     <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                          <input type="text" class="form-control test" id="region" name="region" placeholder="Region" value="   {{ $stagiaire->region}}" style="font-size:15px">
                          <label  class="ml-3 form-control-placeholder" style="font-size:13px;color:gray">Region</label>
                        </div>
                    </div>
                
                
               <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                  <input type="text" class="form-control test"  name="niveau" value="   {{ $stagiaire->niveau_etude }}" style="font-size:15px">
                  <label class="ml-3 form-control-placeholder" style="font-size:13px;color:gray">Niveau d'étude</label>
                
                </div>
              </div>
                
              </div>
             </div>
          <div class="col-lg-4 col-md-6">
            <div class="formation-service">
              <p style="font-size: 17px;color:gray" class="ms-5">Informations Professionnelles</p>
                <p>
                 <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                    <input type="text" value="   {{ $stagiaire->matricule}}"  class="form-control test"  name="matricule" style="font-size:15px" >
                    <label class="ml-3 form-control-placeholder" style="font-size:13px;color:gray">Matricule</label>
                  </div>
                  </div>
                 <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                    <input type="text" class="form-control test"  name="fonction" placeholder="Fonction" value="   {{ $stagiaire->fonction_stagiaire }}" style="font-size:15px" >
                    <label class="ml-3 form-control-placeholder" style="font-size:13px;color:gray">Fonction</label>
                  
                  </div>
                </div>

                 <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                    <input type="text" class="form-control test"  name="entreprise"  value="   {{ optional(optional($stagiaire)->entreprise)->nom_etp}}" style="font-size:15px" >
                    <label class="ml-3 form-control-placeholder"  style="font-size:13px;color:gray">Entreprise</label>
                  
                  </div>
                </div>

                 <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                    <input type="text" value="   {{ $stagiaire->lieu_travail }}"  class="form-control test"  name="lieu" placeholder="Matricule" style="font-size:15px">
                    <label class="ml-3 form-control-placeholder" style="font-size:13px;color:gray">Branche</label>
                  </div>

                  </div>
                 <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                    <input type="text" class="form-control test"  name="departement" value="   {{ optional(optional($stagiaire)->departement)->nom_departement }}" style="font-size:15px">
                    <label class="ml-3 form-control-placeholder" style="font-size:13px;color:gray">Departement</label>
                
                  </div>
                </div>

            </div>
        </div>
            <div class="col-lg-1 col-md-6">

          </div>
        <div class="col-lg-11 col-md-6">
            <div class="formation-service">
                <h4><span class="lnr lnr-phone"></span>Formation suivie</h4>
                <p>
                   Lorem ipsum dolor sit, amet consectetur adipisicing elit. Minima laboriosam repellat alias voluptate vel, sit maxime quaerat molestiae nemo in accusantium quos voluptates omnis! Amet laborum ab nemo veniam libero.</p>
                </p>
            </div>
        </div>
        <br>
            
      </div>
    </div>
    <button style="background-color: #801D68;color:white" class="btn modification "> Enregister</button>
        </form>
  </div>
  <style>


.image-upload > input
{
    display: none;
}
  </style>
 
  
  
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src ="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
  
  // $(document).ready(function(){
  //   alert("Bien venu");
  // });
  $('#file-input').change( function(event) {
    $("img.icon").attr('src',URL.createObjectURL(event.target.files[0]));
    $("img.icon").parents('.upload-icon').addClass('has-img');
    readURL(this);
  });
  //fonction qui change la photo de profil du stagiaire
  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                //alert(e.target.result);
                $('#photo_stg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }


</script>
        {{-- <form  class="btn-submit" action="{{route('update_stagiaire',$stagiaire->id)}}" method="get" >
            @csrf
            <div class="row">
            <div class="col-md-6">
           <div class="row px-3 mt-4">
                      <div class="form-group mt-1 mb-1">
                <label for="matr">Matricule</label>
                <input type="text" value="{{ $stagiaire->matricule }}"  class="form-control"  name="matricule" placeholder="Matricule">
            </div>
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" value="{{ $stagiaire->nom_stagiaire }}" class="form-control"  name="nom" placeholder="Nom">
            </div>
            <div class="form-group">
              <label for="prenom">Prénom</label>
              <input type="text" class="form-control" value="{{ $stagiaire->prenom_stagiaire }}"  name="prenom" placeholder="Prénom">
            </div>
            <div class="form-group">
              <label for="date">Date de Naissance</label>
              <input type="date" class="form-control" name="date" value="{{ $stagiaire->date_naissance }}">
            </div>
            <div class="form-group">
              <label for="adresse">Adresse</label>
              <input type="adresse" class="form-control"  name="adresse" value="{{ $stagiaire->adresse }}">
            </div>

          </div>
        <div class="col-md-6">
          <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" class="form-control"  name="mail" value="{{ $stagiaire->mail_stagiaire }}" >
            </div>
            <div class="form-group">
              <label for="phone">Téléphone</label>
              <input type="text" class="form-control"  name="phone" value="{{ $stagiaire->telephone_stagiaire }}">
            </div>
           
             <div class="form-group">
              <label for="niv_etude">Niveau d'étude</label>
              <input type="text" class="form-control"  name="niv" value="{{ $stagiaire->niveau_etude }}">
            </div>

            <div class="form-group">
              <label for="fonction">Fonction</label>
              <input type="text" class="form-control"  name="fonction" placeholder="Fonction" value="{{ $stagiaire->fonction_stagiaire }}">
            </div>
             <div class="form-group">
              <label for="password">Mot de passe</label>
              <input type="password" class="form-control" value=""  name="password" placeholder="">
            </div>
        </div>
        </div>
          <br>
            <button class="btn btn-outline-success btn-lg modification "><span class = "glyphicon glyphicon-pencil"></span> Modifier</button>
        </form> --}}

@endsection
