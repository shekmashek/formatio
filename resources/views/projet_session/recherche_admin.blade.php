@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="{{ asset('reporting/index.css') }}">
<style>
  .vertical {
      border-left: 1px solid rgba(214, 198, 198, 0.801);
      height: 150px;
      position:absolute;
      left: 50%;
      margin-left: -198px;
  }
  .appliquer{
float: right;
  
  }
</style>
<div class="d-flex">
  <button id="btn_plusieurs" class="titre_nombre_personne_active" onclick="plusieurs()">
    <i class="fal fa-users"></i>&nbsp; &nbsp; Rechercher plusieurs personnes
  </button>
  <button id="unique" class="titre_nombre_personne" onclick="unique()">
    <i class="fas fa-user"></i>&nbsp; &nbsp; Rechercher une seule personne
  </button>
</div>
<br>
<div id="toute_personne" style="display: block;">
  <div class="">
    <div>  
       
          <div class="row">          
                <div class="col-lg-4">
                
                  <h4>Structures</h4>
                  <div class="dropdown">
                    <p class="menu_google p-0 m-0" id="personne_hover">Branche &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                       
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="personne()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="tous"  >
                        <label class="form-check-label" for="tous">Tous </label>
                        @foreach ($branches as $branche)
                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="tous"  >
                        <label class="form-check-label" for="tous">
                          {{$branche->nom_branche}}
                          
                        
                        </label>
                      @endforeach

                      </div>
                        
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-2  m-0" id="fonction_hover">Fonction &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="fonction()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tous_fonction" >
                        <label class="form-check-label" for="tous_fonction">
                          Tous
                        </label>
                        @foreach ($stagiaire as $stg )
                        <input class="form-check-input" type="checkbox" value="" id="tous_fonction" >
                        <label class="form-check-label" for="tous_fonction">
                          {{$stg->fonction_stagiaire}}
                          @endforeach
                      </div>
                      
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-2 m-0" id="domaine_hover">Departement &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="domaine()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tous_domaine" >
                        <label class="form-check-label" for="tous_domaine">
                          Tous
                        </label>
                        @foreach ($departement as $dept)
                        <input class="form-check-input" type="checkbox" value="" id="tous_domaine" >
                        <label class="form-check-label" for="tous_domaine">
                          {{$dept->nom_departement}}
                          @endforeach
                      </div>
                   
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-2 m-0 " id="domaine_hover">Service &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="domaine()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tous_domaine" >
                        <label class="form-check-label" for="tous_domaine">
                          Tous
                        </label>
                        @foreach($service as $srv )
                        <input class="form-check-input" type="checkbox" value="" id="tous_domaine" >
                        <label class="form-check-label" for="tous_domaine">
                          {{$srv->nom_service}}
                          @endforeach
                      </div>
                      
                    </div>
                  </div>
                </div>
                <div class="col-lg-8">
                <div class="vertical"></div>
                  
                    
                  <h4 >Modules</h4>
                  <div class="dropdown ">
                    <p class="menu_google p-2 m-0" id="date_hover">Date &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content pb-3" onmouseleave="quit()" onmouseover="date_hover()">
                      <div class="d-flex align-items-center">
                        <p class="m-0 p-0 mt-1"> Du &nbsp;</p>
                         <input type="date" name="" id="">
                          <p class="m-0 p-0 mt-1">&nbsp; au &nbsp; </p>
                          <input type="date" name="" id="">
                      </div>
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-2 m-0" id="qualite_hover">Domaine &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="qualite()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tous_qualite" >
                        <label class="form-check-label" for="tous_qualite">
                          Tous
                        </label>
                        @foreach($dom as $dm )
                          
                        
                        <input class="form-check-input" type="checkbox" value="" id="tous_qualite" >
                        <label class="form-check-label" for="tous_qualite">
                          {{$dm->nom_domaine}}
                          @endforeach
                      </div>
                      
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-2 m-0" id="qualite_hover">Module &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="qualite()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tous_qualite" >
                        <label class="form-check-label" for="tous_qualite">
                          Tous
                        </label>
                        @foreach ($module as $mod )
                       
                        <input class="form-check-input" type="checkbox" value="" id="tous_qualite" >
                        <label class="form-check-label" for="tous_qualite">
                             {{$mod->nom_module}}
                        @endforeach
                      </div>
                   
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-2 m-0" id="qualite_hover">Thématique &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="qualite()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tous_qualite" >
                        <label class="form-check-label" for="tous_qualite">
                          Tous
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="qualite1">
                        <label class="form-check-label" for="qualite1">
                          Thématique 1
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="qualite2">
                        <label class="form-check-label" for="qualite2">
                          Thématique 2
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="qualite3">
                        <label class="form-check-label" for="qualite3">
                          Thématique 3
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="qualite4">
                        <label class="form-check-label" for="qualite4">
                          Thématique 4
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-2 m-0" id="niveau_hover">Niveau &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="niveau()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tous_niveau" >
                        <label class="form-check-label" for="tous_niveau">
                          Tous
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="niveau1">
                        <label class="form-check-label" for="niveau1">
                         Débutante(e) 
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="niveau2">
                        <label class="form-check-label" for="niveau2">
                          Intermediaire 
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="niveau3">
                        <label class="form-check-label" for="niveau3">
                         Avancée 
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="niveau4">
                        <label class="form-check-label" for="niveau4">
                          Expert 
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-2 m-0" id="status_hover">Status &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="status()">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="tous_status" >
                        <label class="form-check-label" for="tous_status">
                          Tous
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="status1">
                        <label class="form-check-label" for="status1">
                          Anuller
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="status2">
                        <label class="form-check-label" for="status2">
                          A venir
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="status3">
                        <label class="form-check-label" for="status3">
                          A completer
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="status4">
                        <label class="form-check-label" for="status4">
                      Previsionnelle
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="dropdown">
                    <p class="menu_google p-0 m-0" id="modalite_hover">Modalité &nbsp; &nbsp; <i class="fas fa-caret-down"></i></p>
                    <div class="dropdown-content" onmouseleave="quit()" onmouseover="modalite()">
                   
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="modalite1">
                        <label class="form-check-label" for="modalite1">
                         En ligne
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="modalite2">
                        <label class="form-check-label" for="modalite2">
                          Présentielle
                        </label>
                      </div>
                    </div>
                  </div>
                  <button class="btn btn-success appliquer">Appliquer</button>
                </div> 
              </div>
            </div>
          </div>

  </div>

  <div id="seul_personne" style="display: none;">
    <div class="d-flex justify-content-between">
      <div class="d-flex">
        <div class="d-flex m-3">
          <p> Matricule :  </p> <input type="text" class="input-recherche p-0 m-0">
        </div>
        <div class="d-flex m-3">
          <p> Nom ou Prénom :  </p> <input type="text" class="input-recherche p-0 m-0">
        </div>
      </div>
      <div>
        <button class="btn btn-success">Appliquer</button>
      </div>
    </div>
  </div>


{{-- <div class="col-md-7 mx-auto pb-5">
  <div class="Titre_div px-3" href="#personne" data-toggle="collapse" onclick="menu_1()">
    <article>Personne</article>
    <i class="fa fa-angle-up" id="menu_personne"></i>
  </div>

  <div class="px-3 pt-3 bg-white collapse show" id="personne">
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


  <div class="Titre_div px-3" href="#fonction" data-toggle="collapse" onclick="menu_2()">
    <article>Fonction</article>
    <i class="fa fa-angle-up" id="menu_fonction"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="fonction">
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


  <div class="Titre_div px-3" href="#domaine" data-toggle="collapse" onclick="menu_3()">
    <article>Domaine</article>
    <i class="fa fa-angle-up" id="menu_domaine"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="domaine">
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


  <div class="Titre_div px-3" href="#date_recherche" data-toggle="collapse" onclick="menu_4()">
    <article>Date / Qualité</article>
    <i class="fa fa-angle-up" id="menu_date"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="date_recherche">
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


  <div class="Titre_div px-3" href="#modalite_status" data-toggle="collapse" onclick="menu_5()">
    <article>Modalité / Niveau / Status</article>
    <i class="fa fa-angle-up" id="menu_modalite"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="modalite_status">
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
</div> --}}


<script src="{{ asset('reporting/index.js') }}"></script>
@endsection