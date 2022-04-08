@extends('./layouts/admin')
@section('title')
<h3 class="text-white ms-5">Modification photo</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<div class="col" style="margin-left: 25px">
    <a href="{{route('profil_referent')}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp"> Page précédente</button></a>
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
    {{-- si l'utiliisateur a  choisir un fichier > 60Ko--}}
    @if (\Session::has('error_format'))
    <div class="alert alert-danger col-md-4">
        <ul>
            <li>{!! \Session::get('error_format') !!}</li>
        </ul>
    </div>
    @endif
    <div class="col-lg-4">
        <div class="p-3 form-control">
            <p style="text-align: left">Photo de profil <strong>(60Ko max)</strong></p><br>
            <form class="btn-submit" action="{{route('update_photos_resp')}}" method="post" enctype="multipart/form-data">
                @csrf

                <input type="hidden" value="   {{ $responsable->nom_resp }}" class="form-control test input" name="nom">
                {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}


                <input type="hidden" class="form-control test input" value="   {{ $responsable->prenom_resp }}" name="prenom">
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <center>
                            <div class="image-upload">
                                <label for="file-input">
                                    <div class="upload-icon">
                                        @if($responsable->photos==null)
                                        <span>
                                            <div style="display: grid; place-content: center">
                                                <div class='randomColor photo_users' style="color:white; font-size:30px; border: none; border-radius: 100%; height:80px; width:80px ; display: grid; place-content: center">
                                                    <img src="" alt="" id="photo_stg" class="image-ronde" style="display: none">
                                                </div>
                                            </div>
                                        </span>
                                        @else
                                        <img src="{{asset('images/responsables/'.$responsable->photos)}}" id="photo_stg" class="image-ronde">
                                        @endif
                                        {{-- <input type="text" id = 'vartemp'> --}}
                                    </div>
                            </div>
                            </label>
                            <input id="file-input" type="file" name="image" value="{{$responsable->photos}}" />
                            <button class=" btn_enregistrer mt-1 btn modification "> Enregister</button>
                    </div>
</center>
</div>
</div>


{{-- <select hidden  value="{{$responsable->sexe_resp}}" name="genre" class="form-select test input" id="genre" >
<option value="{{$responsable->sexe_resp}}">Homme</option>
<option value="Femme">Femme</option>

</select> --}}


<input type="hidden" class="form-control test" name="genre" value="{{ $responsable->genre_id}}">
<input type="hidden" class="form-control test" name="date_naissance" value="{{ $responsable->date_naissance_resp}}">

<input type="hidden" value="{{ $responsable->cin_resp}}" class="form-control test" name="cin">

<input type="hidden" class="form-control test" name="mail" value="{{ $responsable->email_resp }}">

<input type="hidden" class="form-control test" name="phone" value="{{ $responsable->telephone_resp }}">


<input type="hidden" class="form-control test input" value="" name="password" placeholder="">


<input type="hidden" class="form-control test input" id="lot" name="lot" placeholder="Lot" value="{{ $responsable->adresse_lot}}">


<input type="hidden" class="form-control test input" id="quartier" name="quartier" placeholder="Quartier" value="{{ $responsable->adresse_quartier}}">




<input type="hidden" class="form-control test input" id="code_postal" name="code_postal" placeholder="Code Postale" value="{{ $responsable->adresse_code_postal}}">


<input type="hidden" class="form-control test input" id="ville" name="ville" placeholder="Ville" value="{{ $responsable->adresse_ville}}">


<input type="hidden" class="form-control test input" id="region" name="region" placeholder="Region" value="{{ $responsable->adresse_region}}">

<input type="hidden" class="form-control input" name="fonction" placeholder="Fonction" value="{{ $responsable->fonction_resp}}" readonly>


<div class="row px-3 mt-4">
    <div class="form-group mt-1 mb-1">
        <input type="hidden" class="form-control input" name="entreprise" value="{{ optional(optional($responsable)->entreprise)->nom_etp}}" readonly>
        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Entreprise</label> --}}

    </div>
</div>
<input type="hidden" value="{{ $responsable->poste_resp }}" class="form-control" name="poste" readonly>


<input type="hidden" class="form-control" name="departement" value="{{ optional(optional($responsable)->departement)->nom_departement }}" readonly>



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
    $('#file-input').change(function(event) {
        $("img.icon").attr('src', URL.createObjectURL(event.target.files[0]));
        $("img.icon").parents('.upload-icon').addClass('has-img');
        readURL(this);
    });
    //fonction qui change la photo de profil du stagiaire
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                //alert(e.target.result);
                $('#photo_stg').css('display', 'block');
                $('#photo_stg').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

</script>
@endsection
