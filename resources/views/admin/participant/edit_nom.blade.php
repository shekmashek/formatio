@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification nom</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<div class="col" style="margin-left: 25px">
  <a href="{{route('profile_stagiaire')}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp" > Page précédente</button></a>
</div>
<center>
@if (\Session::has('error_nom'))
  <div class="alert alert-danger col-md-4">
      <ul>
          <li>{!! \Session::get('error_nom') !!}</li>
      </ul>
  </div>
@endif
@if (\Session::has('error_prenom'))
  <div class="alert alert-danger col-md-4">
      <ul>
          <li>{!! \Session::get('error_prenom') !!}</li>
      </ul>
  </div>
@endif
<div class="col-lg-4">
    <div class="p-3 form-control">

        <form   class="btn-submit" action="{{route('update_stagiaire',$stagiaire->id)}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                    <input type="text" value="   {{ $stagiaire->nom_stagiaire }}" class="form-control test input"  name="nom">
                    <label class="ml-3 form-control-placeholder" >Nom</label>
                    </div>
                </div>
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <input type="text" class="form-control test input" value="   {{ $stagiaire->prenom_stagiaire }}"  name="prenom">
                        <label class="ml-3 form-control-placeholder" >Prénom</label>

                        </div>
                </div>
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

                        <select hidden value="{{$stagiaire->genre_stagiaire}}" name="genre" class="form-select test" id="genre"  >
                          <option value="{{$stagiaire->genre_stagiaire}}"  >Homme</option>
                          <option value="Femme">Femme</option>

                        </select>
                        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Genre</label> --}}

                        <select hidden value="{{$stagiaire->titre}}"  name="titre" class="form-control test" id="titre">
                            <option value="Mr">Mr</option>
                            <option value="Mme">Mme</option>
                            <option value="Mlle">Mlle</option>
                            <option value="Dr">Dr</option>
                            <option value="Prof">Prof</option>
                            <option value="Dir">Dir</option>
                            <option value="PDG">PDG</option>
                        </select>
                        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Titre</label> --}}


                        <input type="hidden" class="form-control test" name="date" value="{{ $stagiaire->date_naissance }}">

                          <input type="hidden" value="{{ $stagiaire->cin}}" class="form-control test"  name="cin" >

                        <input type="hidden" class="form-control test"  name="mail" value="{{ $stagiaire->mail_stagiaire }}" >

                        <input type="hidden" class="form-control test"  name="phone" value="{{ $stagiaire->telephone_stagiaire }}">
                        <input type="hidden" class="form-control test" value=""  name="password" placeholder="">
                          <input type="hidden" class="form-control test" id="lot" name="lot" placeholder="Lot" value="{{ $stagiaire->lot}}">



                          <input type="hidden" class="form-control test" id="quartier" name="quartier" placeholder="Quartier" value="{{ $stagiaire->quartier}}">


                          <input type="hidden" class="form-control test" id="code_postal" name="code_postal" placeholder="Code Postale" value="{{ $stagiaire->code_postal}}">


                          <input type="hidden" class="form-control test" id="ville" name="ville" placeholder="Ville" value="{{ $stagiaire->ville}}">
                          <input type="hidden" class="form-control test" id="region" name="region" placeholder="Region" value="{{ $stagiaire->region}}">


                  <input type="hidden" class="form-control test"  name="niveau" value="{{ $stagiaire->niveau_etude_id }}">
                    <input type="hidden" value="{{ $stagiaire->matricule}}"  class="form-control"  name="matricule" placeholder="Matricule" readonly>

                    <input type="hidden" class="form-control"  name="fonction" placeholder="Fonction" value="{{ $stagiaire->fonction_stagiaire }}" readonly>


                    <input type="hidden" class="form-control"  name="entreprise"  value="{{ optional(optional($stagiaire)->entreprise)->nom_etp}}" readonly>

                    <input type="hidden" value="{{ $branche->id}}"  class="form-control"  name="lieu_travail" placeholder="Matricule" readonly>


                    <input type="hidden" class="form-control"  name="departement" value="{{ optional(optional($stagiaire)->departement)->nom_departement }}" readonly>



<button class="btn_enregistrer  mt-1 btn modification "> Enregister</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>

@endsection