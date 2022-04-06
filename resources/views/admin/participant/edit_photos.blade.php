@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="col" style="margin-left: 25px">
    <a href="{{route('profile_stagiaire')}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp" > Page précédente</button></a>
  </div>
<center>
 {{-- si l'utiliisateur a cliqué sur enregistrer sans choisir un fichier--}}
 @if (\Session::has('error'))
 <div class="alert alert-danger col-md-4">
     <ul>
         <li>{!! \Session::get('error') !!}</li>
     </ul>
 </div>
 @endif
 {{-- si l'utiliisateur a  choisir un fichier > 60Ko--}}
 @if (\Session::has('error_logo'))
 <div class="alert alert-danger col-md-4">
     <ul>
         <li>{!! \Session::get('error_logo') !!}</li>
     </ul>
 </div>
 @endif
  {{-- si l'utiliisateur a  choisir un  format incompatible --}}
  @if (\Session::has('error_format'))
  <div class="alert alert-danger col-md-4">
      <ul>
          <li>{!! \Session::get('error_format') !!}</li>
      </ul>
  </div>
  @endif
<div class="col-lg-4">
    <div class="p-3 form-control">
        <p style="text-align: left">Photos de profil <strong>(60Ko max)</strong></p><br>
        <form   class="btn-submit" action="{{route('update_photo_stagiaire',$stagiaire->id)}}" method="post" enctype="multipart/form-data">
            @csrf

                    <input type="hidden" value="   {{ $stagiaire->nom_stagiaire }}" class="form-control test"  name="nom">


                        <input type="hidden" class="form-control test" value="   {{ $stagiaire->prenom_stagiaire }}"  name="prenom">


            <div class="row px-3 mt-4">
            <div class="form-group mt-1 mb-1">
              <center>
                <div class="image-upload">
                  <label for="file-input">
                    <div class="upload-icon">
                        @if($stagiaire->photos==null)
                            <span>
                                <div style="display: grid; place-content: center">
                                    <div class='randomColor photo_users' style="color:white; font-size:30px; border: none; border-radius: 100%; height:80px; width:80px ; display: grid; place-content: center"  >
                                        <img src="" alt="" id = "photo_stg" class="image-ronde" style="display: none">
                                    </div>
                                </div>
                            </span>
                        @else
                            <img src="{{asset('images/stagiaires/'.$stagiaire->photos)}}" id = "photo_stg"  class="image-ronde">
                        @endif
                      {{-- <input type="text" id = 'vartemp'> --}}
                    </div>
                </div>
                </label>
                    <input id="file-input" type="file" name="image" value="{{$stagiaire->photos}}"/>
                    <button class="btn_enregistrer mt-1 btn modification "> Enregister</button>
                </div>
            </center>
        </div>
    </div>
                        <select hidden  value="{{$stagiaire->genre_stagiaire}}" name="genre" class="form-select test" id="genre"  >
                          <option value="{{$stagiaire->genre_stagiaire}}"  >Homme</option>
                          <option value="Femme">Femme</option>

                        </select>


                        <select hidden value="{{$stagiaire->titre}}"  name="titre" class="form-control test" id="titre">
                            <option value="Mr">Mr</option>
                            <option value="Mme">Mme</option>
                            <option value="Mlle">Mlle</option>
                            <option value="Dr">Dr</option>
                            <option value="Prof">Prof</option>
                            <option value="Dir">Dir</option>
                            <option value="PDG">PDG</option>
                        </select>



                        <input type="hidden" class="form-control test" name="date" value="{{ $stagiaire->date_naissance }}">

                          <input type="hidden" value="{{ $stagiaire->cin}}" class="form-control test"  name="cin" >

                        <input type="hidden" class="form-control test"  name="mail" value="   {{ $stagiaire->mail_stagiaire }}" >


                        <input type="hidden" class="form-control test"  name="phone" value="  {{ $stagiaire->telephone_stagiaire }}">
                                       <input type="hidden" class="form-control test" value=""  name="password" placeholder="">
                          <input type="hidden" class="form-control test" id="lot" name="lot" placeholder="Lot" value="{{ $stagiaire->lot}}">



                          <input type="hidden" class="form-control test" id="quartier" name="quartier" placeholder="Quartier" value="{{ $stagiaire->quartier}}">


                          <input type="hidden" class="form-control test" id="code_postal" name="code_postal" placeholder="Code Postale" value="{{ $stagiaire->code_postal}}">


                          <input type="hidden" class="form-control test" id="ville" name="ville" placeholder="Ville" value="{{ $stagiaire->ville}}">
                          <input type="hidden" class="form-control test" id="region" name="region" placeholder="Region" value="{{ $stagiaire->region}}">

                          <div class="row px-3 mt-4">
                            <div class="form-group mt-1 mb-1">
                  <input type="hidden" class="form-control test"  name="niveau" value="   {{ $stagiaire->niveau_etude }}">

                    <input type="hidden" value="   {{ $stagiaire->matricule}}"  class="form-control test"  name="matricule" placeholder="Matricule" >


                    <input type="hidden" class="form-control test"  name="fonction" placeholder="Fonction" value="   {{ $stagiaire->fonction_stagiaire }}" >


                    <input type="hidden" class="form-control test"  name="entreprise"  value="   {{ optional(optional($stagiaire)->entreprise)->nom_etp}}">

                    <input type="hidden" value="   {{ $branche->id }}"  class="form-control test"  name="lieu_travail" placeholder="Matricule" >


                  </div>
              </div>
                    <input type="hidden" class="form-control test"  name="departement" value="{{ optional(optional($stagiaire)->departement)->nom_departement }}" >

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
                    $('#photo_stg').css('display','block');
                    $('#photo_stg').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }


    </script>
@endsection