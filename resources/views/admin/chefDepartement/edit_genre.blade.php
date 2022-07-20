@extends('./layouts/admin')
@section('title')
<h3 class="text_header m-0 mt-1">@lang('translation.Modification') @lang('translation.sexe')</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">


<div class="col" style="margin-left: 25px">
  <a href="{{route('update_responsable')}}"> <button class="btn btn_precedent my-2 edit_pdp_cfp"><i
        class="bx bxs-chevron-left me-1"></i>@lang('translation.Précedent')</button></a>
</div>
<center>
  <div class="col-lg-4">
    <div class="p-3 form-control">

      <form class="btn-submit" action="{{route('update_responsable',$chef->id)}}" method="post"
        enctype="multipart/form-data">
        @csrf

        <div class="row px-3 mt-4">
          <div class="form-group mt-1 mb-1">
            <select value="{{$chef->genre_id}}" name="genre" class="form-select test input" id="genre">
              <option value="2">@lang('translation.Homme')</option>
              <option value="1">@lang('translation.Femme')</option>

            </select>
            <label class="ml-3 form-control-placeholder">@lang('translation.Genre')</label>

          </div>
        </div>


        <input type="hidden" value="{{ $chef->nom_chef }}" class="form-control test input" name="nom">
        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}




        <input type="hidden" class="form-control test input" value="{{ $chef->prenom_chef }}" name="prenom">

        {{-- <select hidden value="{{$chef->sexe_resp}}" name="genre" class="form-select test input" id="genre">
          <option value="{{$chef->sexe_resp}}">Homme</option>
          <option value="Femme">Femme</option>

        </select> --}}




        <input type="hidden" value="{{ $chef->cin_chef}}" class="form-control test" name="cin">

        <input type="hidden" class="form-control test" name="mail" value="{{ $chef->mail_chef}}">

        <input type="hidden" class="form-control test" name="phone" value="{{ $chef->telephone_chef }}">
        <input type="hidden" value="{{ $chef->fonction_chef}}" class="form-control test" name="fonction">

        <input type="hidden" class="form-control test" name="matricule" value="{{ $chef->matricule}}">

        <input type="hidden" class="form-control test" id="lot" name="lot" placeholder="Lot"
          value="{{ $chef->adresse_lot}}">
        <input type="hidden" class="form-control test" id="quartier" name="quartier" placeholder="Quartier"
          value="{{ $chef->adresse_quartier}}">


        <input type="hidden" class="form-control test" id="code_postal" name="code_postal" placeholder="Code Postale"
          value="{{ $chef->adresse_code_postal}}">


        <input type="hidden" class="form-control test" id="ville" name="ville" placeholder="Ville"
          value="{{ $chef->adresse_ville}}">
        <input type="hidden" class="form-control test" id="region" name="region" placeholder="Region"
          value="{{ $chef->adresse_region}}">




        <button class="btn_enregistrer mt-1 btn modification "><i
            class="bx bx-check me-1"></i>@lang('translation.Enregistrer')</button>
      </form>
      <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>
<style>
  .image-ronde {
    width: 150px;
    height: 150px;
    border: none;
    -moz-border-radius: 75px;
    -webkit-border-radius: 75px;
    border-radius: 75px;
    cursor: pointer;
  }

  .image-upload>input {
    display: none;
  }
</style>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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