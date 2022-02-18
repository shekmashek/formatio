@extends('./layouts/admin')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/svg-with-js.min.css" rel="stylesheet" />
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
/* image style */
.profilepic {
  position: relative;
  width: 125px;
  height: 125px;
  border-radius: 50%;
  overflow: hidden;
  background-color: rgb(116, 111, 111);
}

.profilepic:hover .profilepic__content {
  opacity: 1;
}

.profilepic:hover .profilepic__image {
  opacity: .5;
}

.profilepic__image {
  object-fit: cover;
  opacity: 1;
  transition: opacity .2s ease-in-out;
}

.profilepic__content {
  position: absolute;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  color: white;
  opacity: 0;
  transition: opacity .2s ease-in-out;
}

.profilepic__icon {
  color: white;
  padding-bottom: 8px;
}

.fas {
  font-size: 20px;
}

.profilepic__text {
  text-transform: uppercase;
  font-size: 12px;
  width: 50%;
  text-align: center;
}
</style>
<center>                

<div class="col-lg-4">
    <div class="p-3 form-control">
        <p style="text-align: left">Modifier logo</p>
        <form   class="btn-submit" action="{{route('update_logo_entreprise',$responsable->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row px-3 mt-4">
                <div class="form-group mt-1 mb-1">
                <center>
                    <div class="image-upload">
                      <label for="file-input">
                        <div class="upload-icon profilepic">
                            <img src="/dynamic-image/{{$responsable->entreprise->logo}}" id = "photo_stg"  class="image-ronde profilepic__image"> 
                          {{-- <input type="text" id = 'vartemp'> --}}
                          <div class="profilepic__content">
                            <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                            <span class="profilepic__text">Modifier logo</span>
                          </div>
                  </div>
                      </label>
                         <input id="file-input" type="file" name="image" value="{{$responsable->photos}}"/>
                      </div>
                </center>  
            </div>
        </div>
        <input type="hidden" class="form-control test input" value="{{ optional(optional($responsable)->user)->password}}"  name="password" placeholder="">  
                         
                    <input type="hidden" value="   {{ $responsable->nom_resp }}" class="form-control test input"  name="nom">
                    {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}
                  
                
                        <input type="hidden" class="form-control test input" value="   {{ $responsable->prenom_resp }}"  name="prenom">
                        <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Prénom</label>


                        <select hidden  value="{{$responsable->sexe_resp}}" name="genre" class="form-select test input" id="genre"  >
                          <option value="{{$responsable->sexe_resp}}"  >Homme</option>
                          <option value="Femme">Femme</option>

                        </select>
                   
                
                        <input type="hidden" class="form-control test" name="date" value="{{ $responsable->date_naissance_resp}}">
       
                          <input type="hidden" value="{{ $responsable->cin_resp}}" class="form-control test"  name="cin" >

                        <input type="hidden" class="form-control test"  name="mail" value="{{ $responsable->email_resp }}" >

                        <input type="hidden" class="form-control test"  name="phone" value="{{ $responsable->telephone_resp }}"> 
                       
                       
                        <input type="hidden" class="form-control test input" value=""  name="password" placeholder="">  
                        <input type="hidden" class="form-control input test"  name="etp"  value="  {{ optional(optional($responsable)->entreprise)->nom_etp}}" >
                        <input type="hidden" class="form-control input test"  name="rcs"  value="  {{ optional(optional($responsable)->entreprise)->rcs}}" >
                        <input type="hidden" class="form-control input test"  name="nif"  value="  {{ optional(optional($responsable)->entreprise)->nif}}" >
                        <input type="hidden" class="form-control input test"  name="stat"  value="  {{ optional(optional($responsable)->entreprise)->stat}}" >
                        <input type="hidden" class="form-control input test"  name="email_etp"  value="  {{ optional(optional($responsable)->entreprise)->email_etp}}" >
                        <input type="hidden" class="form-control input test"  name="site"  value="  {{ optional(optional($responsable)->entreprise)->site_etp}}" >
                        <input type="hidden" class="form-control input test"  name="cif"  value="  {{ optional(optional($responsable)->entreprise)->cif}}" >
              
                        <input type="hidden" class="form-control input test"  name="phone_etp"  value="  {{ optional(optional($responsable)->entreprise)->telephone_etp}}" >
                      
                        <input type="hidden" class="form-control input test"  name="adresse_etp"  value="  {{ optional(optional($responsable)->entreprise)->adresse}}" >
                        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Adresse</label> --}}

                   
                        <input type="hidden" class="form-control test input" id="lot" name="lot" placeholder="Lot" value="   {{ $responsable->adresse_lot}}">


                
                
                          <input type="hidden" class="form-control test input" id="quartier" name="quartier" placeholder="Quartier" value="   {{ $responsable->adresse_quartier}}">

                          {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Quartier</label> --}}

         
                          <input type="hidden" class="form-control test input" id="code_postal" name="code_postal" placeholder="Code Postale" value="   {{ $responsable->adresse_code_postal}}">
                          {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Code Postal</label> --}}

                 
               
                          <input type="hidden" class="form-control test input" id="ville" name="ville" placeholder="Ville" value="   {{ $responsable->adresse_ville}}">
                          {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Ville</label> --}}

                
            
                          <input type="hidden" class="form-control test input" id="region" name="region" placeholder="Region" value="   {{ $responsable->adresse_region}}">
                        
                          {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Région</label> --}}

               
                    <input type="hidden" class="form-control"  name="fonction" placeholder="Fonction" value="{{ $responsable->fonction_resp}}" readonly>
                
                  
                    <input type="hidden" class="form-control"  name="entreprise"  value="{{ optional(optional($responsable)->entreprise)->nom_etp}}" readonly>
                
                    <input type="hidden" value="{{ $responsable->poste_resp }}"  class="form-control"  name="poste"  readonly>
             
                 
                    <input type="hidden" class="form-control"  name="departement" value="{{ optional(optional($responsable)->departement)->nom_departement }}" readonly>
            
                 
                   
<button style=" background-color: #801D68;color:white;float: right;" class=" mt-1 btn modification "> Enregister</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center> 
</div>
</div>
</div>
<style>
.image-ronde{
    width : 150px; height : 150px;
    border: none;
    -moz-border-radius : 75px;
    -webkit-border-radius : 75px;
    border-radius : 75px;
    cursor: pointer;
    margin-top: -6px;
     margin-left: -15px;
  }
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
@endsection