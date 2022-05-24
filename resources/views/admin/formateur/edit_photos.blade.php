@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification photo</h3>
@endsection
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="col" style="margin-left: 25px">
  <a href="{{route('profile_formateur')}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp" > Page précédente</button></a>
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
<div class="col-lg-4">
    <div class="p-3 form-control">
        <p style="text-align: left">Photos de profile
          <strong>Taille du fichier: (1.7 MB max)</strong>
        </p>
        <form   class="btn-submit" action="{{route('update_prof',$formateur->id)}}" method="post" enctype="multipart/form-data">
            @csrf

                    <input type="hidden" value="{{ $formateur->nom_formateur }}" class="form-control test"  name="nom">


                        <input type="hidden" class="form-control test" value="{{ $formateur->prenom_formateur }}"  name="prenom">
                        <input type="hidden" class="form-control test input" value="{{ $formateur->adresse }}"  name="adresse">

                        <input type="hidden" class="form-control test"  name="niveau" value="{{$niveau->niveau_etude}}">

            <div class="row px-3 mt-4">
            <div class="form-group mt-1 mb-1">
            <center>
                <div class="image-upload">
                  <label for="file-input">
                    <div class="upload-icon">
                      @if($formateur->photos==null)
                      <span>
                          <div style="display: grid; place-content: center">
                              <div class='randomColor photo_users' style="color:white; font-size:20px; border: none; border-radius: 100%; height:70px; width:70px ; display: grid; place-content: center">
                                <img src="" alt="" id = "photo_stg" class="image-ronde" style="display: none">

                              </div>
                          </div>
                      </span>
                  @else
                        <img src="{{asset('images/formateurs/'.$formateur->photos)}}" id = "photo_stg"  class="image-ronde">
                      {{-- <input type="text" id = 'vartemp'> --}}

                      @endif
                </div>
                  </label>
                  </div>
                  <input id="file-input" type="file" name="image" value="{{$formateur->photos}}"/>

            </center>
        </div>
    </div>
                        {{-- <select hidden  value="{{$formateur->genre}}" name="genre" class="form-select test" id="genre"  >
                          <option value="{{$formateur->genre}}"  >Homme</option>
                          <option value="Femme">Femme</option>

                        </select> --}}
                        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Genre</label> --}}



                        <input type="hidden" class="form-control test" name="genre" value="{{ $formateur->genre_id }}">
                        <input type="hidden" class="form-control test" name="dateNais" value="{{ $formateur->date_naissance }}">

                          <input type="hidden" value="{{ $formateur->cin}}" class="form-control test"  name="cin" >

                        <input type="hidden" class="form-control test"  name="mail" value="   {{ $formateur->mail_formateur }}" >


                        <input type="hidden" class="form-control test"  name="phone" value="  {{ $formateur->numero_formateur }}">



                  <input type="hidden" class="form-control test"  name="specialite" value="   {{ $formateur->specialite }}">





<button  class="btn_enregistrer mt-1 btn modification "> Enregister</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>
<style>

.image-ronde{
  width : 120px; height : 120px;
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

      $('#file-input').change( function(event) {
        $("img.icon").attr('src',URL.createObjectURL(event.target.files[0]));
        $("img.icon").parents('.upload-icon').addClass('has-img');
        readURL(this);
      });
      //fonction qui change la photo de profil du formateur
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