
@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification département</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<div class="col" style="margin-left: 25px">
  <a href="{{route('profil_referent')}}"> <button class="btn btn_precedent my-2 edit_pdp_cfp" ><i class="bx bxs-chevron-left me-1"></i> Retour</button></a>
</div>
<center>

<div class="col-lg-4">
    <div class="p-3 form-control">

        <form   class="btn-submit" action="{{route('update_departemennt_service',$responsable->id)}}" method="post" enctype="multipart/form-data">
            @csrf

                    <input type="hidden" value="   {{ $responsable->nom_resp }}" class="form-control test input"  name="nom">
                    {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}


                        <input type="hidden" class="form-control test input" value="   {{ $responsable->prenom_resp }}"  name="prenom">


                        <select hidden  value="{{$responsable->sexe_resp}}" name="genre" class="form-select test input" id="genre"  >
                          <option value="{{$responsable->sexe_resp}}"  >Homme</option>
                          <option value="Femme">Femme</option>

                        </select>


                        <input type="hidden" class="form-control test" name="date_naissance" value="{{ $responsable->date_naissance_resp}}">

                          <input type="hidden" value="{{ $responsable->cin_resp}}" class="form-control test"  name="cin" >

                        <input type="hidden" class="form-control test"  name="mail" value="{{ $responsable->email_resp }}" >

                        <input type="hidden" class="form-control test"  name="phone" value="{{ $responsable->telephone_resp }}">


                        <input type="hidden" class="form-control test input" value=""  name="password" placeholder="">


                        <input type="hidden" class="form-control test input" id="lot" name="lot" placeholder="Lot" value="{{ $responsable->adresse_lot}}">


                          <input type="hidden" class="form-control test input" id="quartier" name="quartier" placeholder="Quartier" value="{{ $responsable->adresse_quartier}}">




                          <input type="hidden" class="form-control test input" id="code_postal" name="code_postal" placeholder="Code Postale" value="{{ $responsable->adresse_code_postal}}">


                          <input type="hidden" class="form-control test input" id="ville" name="ville" placeholder="Ville" value="{{ $responsable->adresse_ville}}">


                          <input type="hidden" class="form-control test input" id="region" name="region" placeholder="Region" value="{{ $responsable->adresse_region}}">

                    <input type="hidden" class="form-control input"  name="fonction" placeholder="Fonction" value="{{ $responsable->fonction_resp}}" readonly>



                    <input type="hidden" class="form-control input"  name="entreprise"  value="{{ optional(optional($responsable)->entreprise)->nom_etp}}" readonly>

                    <input type="hidden" value="{{ $responsable->poste_resp }}"  class="form-control input"  name="poste" >

                    @if ($departement!=null)
                        <label for="">Département</label>
                      <select name="dep" class="form-select test input" id="dep">
                        @foreach ($departement as $dep)
                          <option value="{{$dep->departement_entreprise_id}}">{{$dep->nom_departement}}</option>
                        @endforeach
                      </select><br>
                      <label for="">Service</label>
                      <select  name="serv" class="form-select test input serv">
                        @foreach ($departement as $dep)
                          <option value="{{$dep->service_id}}">{{$dep->nom_service}}</option>
                        @endforeach
                      </select>
                    <button class="btn_enregistrer mt-1 btn modification "> Enregister</button>
                    @else
                        <p>Votre entreprise n'a pas de département/service, cliquez <a href="{{route('liste_departement')}}" class="text-primary text-decoration-underline">ici</a> pour en créer</p>
                    @endif

                </div>
        </div>



</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$("#dep").change(function() {
  $(".serv").empty();
  var id = $(this).val();

  $.ajax({
        url: "/get_service",
        type: "get",
        data: {
            id: id,
        },
        success: function(response) {
            var userData = response;
            if (userData.length > 0) {
                for (var $i = 0; $i < userData.length; $i++) {
                    $(".serv").append(
                        '<option value="' +
                            userData[$i].id +
                            '" data-value="' +
                            userData[$i].nom_service +
                            '" >' +
                            userData[$i].nom_service +
                            "</option>"
                    );
                }
            }
        },
        error: function(error) {
            console.log(error);
        },
    });
});
</script>
@endsection








































