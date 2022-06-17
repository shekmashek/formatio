@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification fonction</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<div class="col" style="margin-left: 25px">
  <a href="{{route('profile_stagiaire')}}" role="button" class="btn btn_precedent me-1 my-2"><i class="bx bxs-chevron-left me-1"></i>   Retour</a>
  {{-- <a href="{{route('profile_stagiaire')}}"> <button class="btn btn_enregistrer my-2 edit_pdp_cfp" > Page précédente</button></a> --}}
</div>
<center>
@if (\Session::has('error_fonction'))
  <div class="alert alert-danger col-md-4">
      <ul>
          <li>{!! \Session::get('error_fonction') !!}</li>
      </ul>
  </div>
@endif
<div class="col-lg-4">
    <div class="p-3 form-control">

        <form   class="btn-submit" action="{{route('update_responsable',$stagiaire->id)}}" method="post" enctype="multipart/form-data">
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

                        <select hidden  value="{{$stagiaire->genre_id}}" name="genre" class="form-select test" id="genre"  >
                          <option value="{{$stagiaire->genre_id}}"  >Homme</option>
                          <option value="Femme">Femme</option>

                        </select>
                        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Genre</label> --}}


                        {{-- <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Titre</label> --}}


                        <input type="hidden" class="form-control test" name="date_naissance" value="{{ $stagiaire->date_naissance }}">

                          <input type="hidden" value="{{ $stagiaire->cin}}" class="form-control test"  name="cin" >

                        <input type="hidden" class="form-control test"  name="mail" value="   {{ $stagiaire->mail_stagiaire }}" >


                        <input type="hidden" class="form-control test"  name="phone" value="  {{ $stagiaire->telephone_stagiaire }}">
                                       <input type="hidden" class="form-control test" value=""  name="password" placeholder="">
                          <input type="hidden" class="form-control test" id="lot" name="lot" placeholder="Lot" value="{{ $stagiaire->lot}}">



                          <input type="hidden" class="form-control test" id="quartier" name="quartier" placeholder="Quartier" value="{{ $stagiaire->quartier}}">


                          <input type="hidden" class="form-control test" id="code_postal" name="code_postal" placeholder="Code Postale" value="{{ $stagiaire->code_postal}}">


                          <input type="hidden" class="form-control test" id="ville" name="ville" placeholder="Ville" value="{{ $stagiaire->ville}}">
                          <input type="hidden" class="form-control test" id="region" name="region" placeholder="Region" value="{{ $stagiaire->region}}">


                  <input type="hidden" class="form-control test"  name="niveau" value="{{ $stagiaire->niveau_etude_id }}">
                    <input type="hidden" value="{{ $stagiaire->matricule}}"  class="form-control"  name="matricule" placeholder="Matricule" readonly>
                    <div class="row px-3 mt-4">
                        <div class="form-group mt-1 mb-1">
                    <input type="text" class="form-control test input"  name="fonction" placeholder="Fonction" value="   {{ $stagiaire->fonction_stagiaire }}" >
                    <label class="ml-3 form-control-placeholder" >Fonction</label>

                        </div>
                    </div>
                    <input type="hidden" class="form-control"  name="entreprise"  value="{{ optional(optional($stagiaire)->entreprise)->nom_etp}}" readonly>



                    <input type="hidden" class="form-control"  name="departement" value="{{ optional(optional($stagiaire)->departement)->nom_departement }}" readonly>

                    <button class="btn btn_enregistrer mt-1"><i class="bx bx-check me-1"></i> Enregistrer</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>

@endsection