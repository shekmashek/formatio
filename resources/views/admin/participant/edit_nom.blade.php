@extends('./layouts/admin')
@section('content')
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
</style>
<center>

<div class="col-lg-4">
    <div class="p-3 form-control">
        <p style="text-align: left">Modifier le nom</p>
        <form   class="btn-submit" action="{{route('update_stagiaire',$stagiaire->stagiaire_id)}}" method="post" enctype="multipart/form-data">
            @csrf
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                    <input type="text" value="   {{ $stagiaire->nom_stagiaire }}" class="form-control test input"  name="nom">
                    <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Nom</label>
                    </div>
                </div>
                <div class="row px-3 mt-4">
                    <div class="form-group mt-1 mb-1">
                        <input type="text" class="form-control test input" value="   {{ $stagiaire->prenom_stagiaire }}"  name="prenom">
                        <label class="ml-3 form-control-placeholder" style="font-size:13px;color:#801D68">Prénom</label>

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


                  <input type="hidden" class="form-control test"  name="niveau" value="{{ $stagiaire->niveau_etude }}">
                    <input type="hidden" value="{{ $stagiaire->matricule}}"  class="form-control"  name="matricule" placeholder="Matricule" readonly>

                    <input type="hidden" class="form-control"  name="fonction" placeholder="Fonction" value="{{ $stagiaire->fonction_stagiaire }}" readonly>


                    <input type="hidden" class="form-control"  name="entreprise"  value="{{ optional(optional($stagiaire)->entreprise)->nom_etp}}" readonly>

                    <input type="hidden" value="{{ $stagiaire->lieu_travail }}"  class="form-control"  name="lieu" placeholder="Matricule" readonly>


                    <input type="hidden" class="form-control"  name="departement" value="{{ optional(optional($stagiaire)->departement)->nom_departement }}" readonly>



<button style=" background-color: #801D68;color:white;float: right;" class=" mt-1 btn modification "> Enregister</button>
</form>
<div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
</center>
</div>
</div>
</div>

@endsection