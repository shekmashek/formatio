@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="{{ asset('reporting/index.css') }}">


<div class="d-flex">
<p class="menu_google">Personne &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
<p class="menu_google">Fonction &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
<p class="menu_google">Domaine &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p> 
<p class="menu_google">Date &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p> 
<p class="menu_google">Qualite &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
<p class="menu_google">Niveau &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
<p class="menu_google">Status &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
<p class="menu_google">Modalite &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
</div>


<div class="col-md-7 mx-auto pb-5">
  {{-- personne --}}
  <div class="Titre_div px-3" href="#personne" data-toggle="collapse" onclick="menu_1()">
    <article>Personne</article>
    <i class="fa fa-angle-up" id="menu_personne"></i>
  </div>

  <div class="px-3 pt-3 bg-white collapse show" id="personne">
    {{-- <div class="row">
      <div class="col-md-6 px-1">
        <div class="shadow_card pb-4">
          <h6 class="text-center">Sexe</h6>
          <div class="d-flex flex-wrap justify-content-center">
            <button class="classe_sexe_active" onclick="tous_btn()" id="tous_btn">Tous</button>
            <button class="classe_sexe" onclick="homme_btn()" id="homme_btn">Homme</button>
            <button class="classe_sexe" onclick="femme_btn()" id="femme_btn">Femme</button>
          </div>
          <div class="d-flex align-items-center m-0 p-0 pt-4" style="height: 2em !important;">
            <p class="p-0 m-0 mt-3"> Matricule</p>
            <input type="text" class="input-recherche w-100">&nbsp; <p class="p-0 m-0 pt-3">au</p> &nbsp;
            <input type="text" class="input-recherche w-100">
          </div>
        </div>
      </div>
      <div class="col-md-6 px-1">
        <div class="shadow_card">
            <p class="p-0 m-0"> Nom </p>
              <input type="text" class="input-recherche w-100 p-0 m-0">
            <p class="p-0 m-0 pt-1"> Prénom </p>
              <input type="text" class="input-recherche w-100 p-0 m-0">
        </div>
      </div>
    </div> --}}
    <div class="row">
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <h6 class="text-center">Sexe</h6>
          <div class="d-flex flex-wrap justify-content-center">
            <button class="classe_sexe_active" onclick="tous_btn()" id="tous_btn">Tous</button>
            <button class="classe_sexe" onclick="homme_btn()" id="homme_btn">Homme</button>
            <button class="classe_sexe" onclick="femme_btn()" id="femme_btn">Femme</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <p class="p-0 m-0"> Matricule</p>
          <div class="d-flex">
            <p class="p-0 m-0 pt-2">Du</p><input type="text" class="input-recherche w-100 p-0 m-0">&nbsp; <p class="p-0 m-0 pt-2">au</p> &nbsp;
            <input type="text" class="input-recherche w-100 p-0 m-0">
          </div>
        </div>
      </div>
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
            <p class="p-0 m-0"> Nom ou Prénom </p>
              <input type="text" class="input-recherche w-100 p-0 m-0">
        </div>
      </div>
    </div>

      <button class="btn-appliquer">Appliquer</button>
  </div>
  {{-- personne --}}

  {{-- fonction --}}
  <div class="Titre_div px-3" href="#fonction" data-toggle="collapse" onclick="menu_2()">
    <article>Fonction</article>
    <i class="fa fa-angle-up" id="menu_fonction"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="fonction">
    {{-- <div class="row">
      <div class="col-md-6 px-1">
        <div class="shadow_card">
          <p class="p-0 m-0"> Fonction </p>
            <select class="select_recherche m-0 p-0" name="" id="">
              <option value="" selected hidden></option>
              <option value="">Fonction 1</option>
              <option value="">Fonction 2</option>
              <option value="">Fonction 3</option>
              <option value="">Fonction 4</option>
              <option value="">Fonction 5</option>
            </select>
          <p class="p-0 m-0 pt-1"> Département </p>
            <select class="select_recherche m-0 p-0" name="" id="">
              <option value="" selected hidden></option>
              <option value="">Département 1</option>
              <option value="">Département 2</option>
              <option value="">Département 3</option>
              <option value="">Département 4</option>
              <option value="">Département 5</option>
            </select>
        </div>
      </div>
      <div class="col-md-6 px-1">
        <div class="shadow_card">
          <p class="p-0 m-0"> Service </p>
            <select class="select_recherche m-0 p-0" name="" id="">
              <option value="" selected hidden></option>
              <option value="">Service 1</option>
              <option value="">Service 2</option>
              <option value="">Service 3</option>
              <option value="">Service 4</option>
              <option value="">Service 5</option>
            </select>
          <p class="p-0 m-0 pt-1"> Branche </p>
            <select class="select_recherche m-0 p-0" name="" id="">
              <option value="" selected hidden></option>
              <option value="">Branche 1</option>
              <option value="">Branche 2</option>
              <option value="">Branche 3</option>
              <option value="">Branche 4</option>
              <option value="">Branche 5</option>
            </select>
      </div>
      </div>
    </div> --}}

    <div class="row">
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <p class="p-0 m-0"> Fonction </p>
            <select class="select_recherche m-0 p-0" name="" id="">
              <option value="" selected hidden></option>
              <option value="">Fonction 1</option>
              <option value="">Fonction 2</option>
              <option value="">Fonction 3</option>
              <option value="">Fonction 4</option>
              <option value="">Fonction 5</option>
            </select>
        </div>
      </div>
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <p class="p-0 m-0"> Département </p>
            <select class="select_recherche m-0 p-0" name="" id="">
              <option value="" selected hidden></option>
              <option value="">Département 1</option>
              <option value="">Département 2</option>
              <option value="">Département 3</option>
              <option value="">Département 4</option>
              <option value="">Département 5</option>
            </select>
        </div>
      </div>
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <p class="p-0 m-0"> Service </p>
          <select class="select_recherche m-0 p-0" name="" id="">
            <option value="" selected hidden></option>
            <option value="">Service 1</option>
            <option value="">Service 2</option>
            <option value="">Service 3</option>
            <option value="">Service 4</option>
            <option value="">Service 5</option>
          </select>
        </div>
      </div>
    </div>

      <button class="btn-appliquer">Appliquer</button>
  </div>
  {{-- fonction --}}

  {{-- domaine --}}
  <div class="Titre_div px-3" href="#domaine" data-toggle="collapse" onclick="menu_3()">
    <article>Domaine</article>
    <i class="fa fa-angle-up" id="menu_domaine"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="domaine">
    {{-- <div class="row">
      <div class="col-md-6 px-1">
        <div class="shadow_card">
          <p class="p-0 m-0"> Domaine </p>
            <select class="select_recherche m-0 p-0" name="" id="">
              <option value="" selected hidden></option>
              <option value="">Domaine 1</option>
              <option value="">Domaine 2</option>
              <option value="">Domaine 3</option>
              <option value="">Domaine 4</option>
              <option value="">Domaine 5</option>
            </select>
          <p class="p-0 m-0 pt-1 m-0 p-0"> Thématique </p>
            <select class="select_recherche m-0 p-0" name="" id="">
              <option value="" selected hidden></option>
              <option value="">Theme 1</option>
              <option value="">Theme 2</option>
              <option value="">Theme 3</option>
              <option value="">Theme 4</option>
              <option value="">Theme 5</option>
            </select>
      </div>
      </div>
      <div class="col-md-6 px-1">
        <div class="shadow_card">
          <p class="p-0 m-0"> Organisme de formation </p>
        </div>
      </div>
    </div> --}}


    <div class="row">
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <p class="p-0 m-0"> Domaine </p>
            <select class="select_recherche m-0 p-0" name="" id="">
              <option value="" selected hidden></option>
              <option value="">Domaine 1</option>
              <option value="">Domaine 2</option>
              <option value="">Domaine 3</option>
              <option value="">Domaine 4</option>
              <option value="">Domaine 5</option>
            </select>
        </div>
      </div>
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <p class="p-0 m-0 m-0 p-0"> Thématique </p>
            <select class="select_recherche m-0 p-0" name="" id="">
              <option value="" selected hidden></option>
              <option value="">Theme 1</option>
              <option value="">Theme 2</option>
              <option value="">Theme 3</option>
              <option value="">Theme 4</option>
              <option value="">Theme 5</option>
            </select>
        </div>
      </div>
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <p class="p-0 m-0"> Organisme de formation </p>
        </div>
      </div>
    </div>


      <button class="btn-appliquer">Appliquer</button>
  </div>
  {{-- domaine --}}

  {{-- Date --}}
  <div class="Titre_div px-3" href="#date_recherche" data-toggle="collapse" onclick="menu_4()">
    <article>Date / Qualité</article>
    <i class="fa fa-angle-up" id="menu_date"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="date_recherche">
    {{-- <div class="row">
      <div class="col-md-6 px-1">
        <div class="shadow_card">
          <div class="d-flex align-items-center m-0 p-0" style="height: 2em !important;">
            <p class="p-0 m-0 pt-2"> Du </p>&nbsp; &nbsp; &nbsp;
              <input type="date">&nbsp; <p class="pt-4">au</p> &nbsp;
              <input type="date">
          </div>
          <div class="d-flex align-items-center m-0 p-0">
            <p class="p-0 m-0 pt-3"> Année </p>
            <select class="select_recherche" name="" id="">
              <option value="" selected hidden></option>
              <option value="">2022</option>
              <option value="">2023</option>
              <option value="">2024</option>
              <option value="">2025</option>
              <option value="">2026</option>
              <option value="">2027</option>
              <option value="">2028</option>
              <option value="">2029</option>
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-6 px-1">
        <div class="shadow_card">
          <p class="p-0 m-0 text-center"> Qualité </p>
          <div class="d-flex flex-wrap justify-content-center pt-3">
            <button class="classe_sexe" onclick="qualite1()" id="presence_btn">Présence</button>
            <button class="classe_sexe" onclick="qualite2()" id="absence_btn">Absence</button>
            <button class="classe_sexe" onclick="qualite3()" id="reussite_btn">Réussite</button>
          </div>
      </div>
      </div>
    </div> --}}


    <div class="row">
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <p class="p-0 m-0"> Date </p>
          <div class="d-flex align-items-center m-0 p-0" style="height: 2em !important;">
            <p class="p-0 m-0 pt-2"> Du </p>&nbsp; &nbsp; &nbsp;
              <input type="date">&nbsp; <p class="pt-4">au</p> &nbsp;
              <input type="date">
          </div>
        </div>
      </div>
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <p class="p-0 m-0"> Année </p>
          <div class="d-flex flex-wrap justify-content-center mt-2">
            <button class="classe_sexe" onclick="annee1()" id="annee_1">2018</button>
            <button class="classe_sexe" onclick="annee2()" id="annee_2">2019</button>
            <button class="classe_sexe" onclick="annee3()" id="annee_3">2020</button>
            <button class="classe_sexe" onclick="annee4()" id="annee_4">2021</button>
            <button class="classe_sexe" onclick="annee5()" id="annee_5">2022</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <p class="text-center m-1"> Qualité </p>
          <div class="d-flex flex-wrap justify-content-center">
            <button class="classe_sexe" onclick="qualite1()" id="presence_btn">Présence</button>
            <button class="classe_sexe" onclick="qualite2()" id="absence_btn">Absence</button>
            <button class="classe_sexe" onclick="qualite3()" id="reussite_btn">Réussite</button>
          </div>
        </div>
      </div>
    </div>


      <button class="btn-appliquer">Appliquer</button>
  </div>
  {{-- Date --}}

  {{-- modalite --}}
  <div class="Titre_div px-3" href="#modalite_status" data-toggle="collapse" onclick="menu_5()">
    <article>Modalité / Niveau / Status</article>
    <i class="fa fa-angle-up" id="menu_modalite"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="modalite_status">
    {{-- <div class="row">
      <div class="col-md-6 px-1">
        <div class="shadow_card">
          <p class="p-0 m-0 text-center"> Modalité </p>
            <div class="d-flex flex-wrap justify-content-center pt-3">
              <button class="classe_sexe" onclick="modalite1()" id="presentille_btn">Présentielle</button>
              <button class="classe_sexe" onclick="modalite2()" id="distance_btn">A distance</button>
            </div>
            <p class="p-0 m-0 text-center"> Niveau </p>
            <div class="d-flex flex-wrap justify-content-center pt-3">
              <button class="classe_sexe" onclick="niveau1()" id="debutant_btn">Débutant</button>
              <button class="classe_sexe" onclick="niveau2()" id="intermediaire_btn">Intermédiaire</button>
              <button class="classe_sexe" onclick="niveau3()" id="avance_btn">Avancé</button>
            </div>
        </div>
      </div>
      <div class="col-md-6 px-1">
        <div class="shadow_card">
          <p class="p-0 m-0 text-center"> Status </p>
          <div class="d-flex flex-wrap justify-content-center pt-3">
            <button class="classe_sexe" onclick="status1()" id="cours_btn">En cours</button>
            <button class="classe_sexe" onclick="status2()" id="complete_btn">Completé</button>
            <button class="classe_sexe" onclick="status3()" id="avenir_btn">A venir</button>
          </div>
      </div>
      </div>
    </div> --}}


    <div class="row">
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <h6 class="text-center"> Modalité </h6>
          <div class="d-flex flex-wrap justify-content-center">
            <button class="classe_sexe" onclick="modalite1()" id="presentille_btn">Présentielle</button>
              <button class="classe_sexe" onclick="modalite2()" id="distance_btn">A distance</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <h6 class="text-center"> Niveau </h6>
          <div class="d-flex flex-wrap justify-content-center">
            <button class="classe_sexe" onclick="niveau1()" id="debutant_btn">Débutant</button>
              <button class="classe_sexe" onclick="niveau2()" id="intermediaire_btn">Intermédiaire</button>
              <button class="classe_sexe" onclick="niveau3()" id="avance_btn">Avancé</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 px-1">
        <div class="shadow_card_1">
          <h6 class="text-center"> Status </h6>
          <div class="d-flex flex-wrap justify-content-center">
            <button class="classe_sexe" onclick="status1()" id="cours_btn">En cours</button>
            <button class="classe_sexe" onclick="status2()" id="complete_btn">Completé</button>
            <button class="classe_sexe" onclick="status3()" id="avenir_btn">A venir</button>
          </div>
        </div>
      </div>
    </div>


      <button class="btn-appliquer">Appliquer</button>
  </div>
  {{-- modalite --}}
</div>


<script src="{{ asset('reporting/index.js') }}"></script>
@endsection