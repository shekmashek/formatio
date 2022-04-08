@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Modification entreprise</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

<center>

<div class="col-lg-4">
    <div class="p-3 form-control">

        <form   class="btn-submit" action="{{route('update_responsable',$responsable->id)}}" method="post" enctype="multipart/form-data">
            @csrf

                    <input type="hidden" value="   {{ $responsable->nom_resp }}" class="form-control test input"  name="nom">
                    {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label> --}}


                        <input type="hidden" class="form-control test input" value="   {{ $responsable->prenom_resp }}"  name="prenom">
                        <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Prénom</label>


                        {{-- <select hidden  value="{{$responsable->sexe_resp}}" name="genre" class="form-select test input" id="genre"  >
                          <option value="{{$responsable->sexe_resp}}"  >Homme</option>
                          <option value="Femme">Femme</option>

                        </select> --}}


                        <input type="hidden" class="form-control test" name="genre" value="{{ $responsable->genre_id}}">
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


                    <div class="row px-3 mt-4">
                        <div class="form-group mt-1 mb-1">
                    <input type="text" class="form-control input test"  name="etp"  value="  {{ optional(optional($responsable)->entreprise)->nom_etp}}" >
                    <label class="ml-3 form-control-placeholder" >Entreprise</label>

                </div>
        </div>
                    <input type="hidden" value="{{ $responsable->poste_resp }}"  class="form-control"  name="poste"  readonly>


                    <input type="hidden" class="form-control"  name="departement" value="{{ optional(optional($responsable)->departement)->nom_departement }}" readonly>



<button class="btn_enregistrer mt-1 btn modification "> Enregister</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>

@endsection








































