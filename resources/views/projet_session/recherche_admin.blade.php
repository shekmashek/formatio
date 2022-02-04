@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<style>
  *{
    font-size: 1rem;
    font-family: 'Lato';
    color: grey;
  }
  .input-recherche{
    margin: 0;
    height: 1.6em !important;
    padding-left: .5rem !important;
    border: none;
    border-bottom: 1px solid rgb(130,33,100);
  }
  .input-recherche:focus{
    box-shadow: none;
    outline: none;
  }
  .titre_card{
    color: rgb(130,33,100);
  }
  .btn-appliquer{
    padding: 6px 12px;
    font-size: .7rem;
    border-top:3px solid rgb(130,33,100);
    border-left: 2px solid rgb(130,33,100);
    border-right: 2px solid rgb(130,33,100);
    border-bottom: 3px solid rgb(130,33,100);
    border-radius: .5rem;
    margin: 1rem 0;
    transition: all .4s ease-in-out;
  }
  .Titre_div{
    background: rgb(130,33,100);
    color: white !important;
    border-bottom: 3px solid white;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  .Titre_div article{
    color: white;
  }
  .Titre_div i{
    color: white;
  }
  }
  .Titre_div:hover{
    cursor: pointer;
  }
  li{
    list-style: none;;
  }
  .btn-appliquer:hover{
    transform: scale(1.1) ;
  }
  .select-class{
    height: 2em !important;
    margin: 0 !important;
  }
  i:hover{
    cursor: pointer;
  }
  .col-md-3 input[type="date"]
  {
    height: 1.5em;
    padding: 0;
    width: 35%;
  }
  .select_recherche{
    width: 100%;
    height: 1.5rem;
    border: none;
    border-bottom: 2px solid rgb(130,33,100);
  }
  .select_recherche:focus{
    outline: none;
    box-shadow: none;
  }
  .classe_sexe{
    border: 1px solid grey;
    background-color: #fff;
    padding: 0 0.5rem;
  }
  .classe_sexe_active{
    border: 1px solid grey;
    background-color: rgb(214, 210, 210);
    padding: 0 0.5rem;
  }
  .shadow_card{
    box-shadow: rgb(130,33,100) 0px 2px 4px 0px;
    padding: .5rem .5rem;
    border-radius: .5rem;
    height: 8.5rem;
  }
  input[type="date"]{
    height: 1.5em !important;
    width: 40% !important;
  }
</style>

<div class="col-md-6 mx-auto pb-5">
  {{-- personne --}}
  <div class="Titre_div px-3" href="#personne" data-toggle="collapse" onclick="menu_1()">
    <article>Personne</article>
    <i class="fa fa-angle-up" id="menu_personne"></i>
  </div>

  <div class="px-3 pt-3 bg-white collapse show" id="personne">
    <div class="row">
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
    </div>
    <div class="d-flex justify-content-end">
      <button class="btn-appliquer">Appliquer</button>
    </div>
  </div>
  {{-- personne --}}

  {{-- fonction --}}
  <div class="Titre_div px-3" href="#fonction" data-toggle="collapse" onclick="menu_2()">
    <article>Fonction</article>
    <i class="fa fa-angle-up" id="menu_fonction"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="fonction">
    <div class="row">
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
            <select class="select_recherche m-0 p-0" name="liste_dep" id="">
              <option value="" selected hidden>Choisissez un département...</option>
              @for($i = 0; $i < count($liste_dep); $i++)
                  <option value="">{{$liste_dep[$i]->nom_departement}}</option>
              @endfor
            </select>
        </div>
      </div>
      <div class="col-md-6 px-1">
        <div class="shadow_card">
          <p class="p-0 m-0"> Service </p>
            <select class="select_recherche m-0 p-0" name="" id="">
              <option value="" selected hidden>Choisissez un service...</option>
              @for($i = 0; $i < count($liste_serv); $i++)
                <option value="">{{$liste_serv[$i]->nom_service}}</option>
              @endfor
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
    </div>
    <div class="d-flex justify-content-end">
      <button class="btn-appliquer">Appliquer</button>
    </div>
  </div>
  {{-- fonction --}}

  {{-- domaine --}}
  <div class="Titre_div px-3" href="#domaine" data-toggle="collapse" onclick="menu_3()">
    <article>Domaine</article>
    <i class="fa fa-angle-up" id="menu_domaine"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="domaine">
    <div class="row">
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
    </div>
    <div class="d-flex justify-content-end">
      <button class="btn-appliquer">Appliquer</button>
    </div>
  </div>
  {{-- domaine --}}

  {{-- Date --}}
  <div class="Titre_div px-3" href="#date_recherche" data-toggle="collapse" onclick="menu_4()">
    <article>Date / Qualité</article>
    <i class="fa fa-angle-up" id="menu_date"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="date_recherche">
    <div class="row">
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
    </div>
    <div class="d-flex justify-content-end">
      <button class="btn-appliquer">Appliquer</button>
    </div>
  </div>
  {{-- Date --}}

  {{-- modalite --}}
  <div class="Titre_div px-3" href="#modalite_status" data-toggle="collapse" onclick="menu_5()">
    <article>Modalité / Niveau / Status</article>
    <i class="fa fa-angle-up" id="menu_modalite"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="modalite_status">
    <div class="row">
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
    </div>
    <div class="d-flex justify-content-end">
      <button class="btn-appliquer">Appliquer</button>
    </div>
  </div>
  {{-- modalite --}}
</div>



<script>
  function niveau1(){
    document.getElementById('debutant_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('intermediaire_btn').style.backgroundColor = "white";
    document.getElementById('avance_btn').style.backgroundColor = "white";
  };
  function niveau2(){
    document.getElementById('debutant_btn').style.backgroundColor = "white";
    document.getElementById('intermediaire_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('avance_btn').style.backgroundColor = "white";
  };
  function niveau3(){
    document.getElementById('debutant_btn').style.backgroundColor = "white";
    document.getElementById('intermediaire_btn').style.backgroundColor = "white";
    document.getElementById('avance_btn').style.backgroundColor = "rgb(214, 210, 210)";
  };
  function modalite1(){
    document.getElementById('presentille_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('distance_btn').style.backgroundColor = "white";
  };
  function modalite2(){
    document.getElementById('presentille_btn').style.backgroundColor = "white";
    document.getElementById('distance_btn').style.backgroundColor = "rgb(214, 210, 210)";
  };
  function status1(){
    document.getElementById('cours_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('complete_btn').style.backgroundColor = "white";
    document.getElementById('avenir_btn').style.backgroundColor = "white";
  };
  function status2(){
    document.getElementById('cours_btn').style.backgroundColor = "white";
    document.getElementById('complete_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('avenir_btn').style.backgroundColor = "white";
  };
  function status3(){
    document.getElementById('cours_btn').style.backgroundColor = "white";
    document.getElementById('complete_btn').style.backgroundColor = "white";
    document.getElementById('avenir_btn').style.backgroundColor = "rgb(214, 210, 210)";
  };
  function qualite1(){
    document.getElementById('presence_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('absence_btn').style.backgroundColor = "white";
    document.getElementById('reussite_btn').style.backgroundColor = "white";
  };
  function qualite2(){
    document.getElementById('presence_btn').style.backgroundColor = "white";
    document.getElementById('absence_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('reussite_btn').style.backgroundColor = "white";
  };
  function qualite3(){
    document.getElementById('presence_btn').style.backgroundColor = "white";
    document.getElementById('absence_btn').style.backgroundColor = "white";
    document.getElementById('reussite_btn').style.backgroundColor = "rgb(214, 210, 210)";
  };
  function tous_btn(){
    document.getElementById('tous_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('homme_btn').style.backgroundColor = "white";
    document.getElementById('femme_btn').style.backgroundColor = "white";
  };
  function homme_btn(){
    document.getElementById('tous_btn').style.backgroundColor = "white";
    document.getElementById('homme_btn').style.backgroundColor = "rgb(214, 210, 210)";
    document.getElementById('femme_btn').style.backgroundColor = "white";
  };
  function femme_btn(){
    document.getElementById('tous_btn').style.backgroundColor = "white";
    document.getElementById('homme_btn').style.backgroundColor = "white";
    document.getElementById('femme_btn').style.backgroundColor = "rgb(214, 210, 210)";
  };
  function menu_1(){
    var element_1 = document.getElementById('menu_personne').classList;
    if(element_1 == "fa fa-angle-up"){
      element_1.remove("fa-angle-up");
      element_1.add("fa-angle-down");
    }else if(element_1 == "fa fa-angle-down"){
      element_1.remove("fa-angle-down");
      element_1.add("fa-angle-up");
    }
  };
  function menu_2(){
    var element_2 = document.getElementById('menu_fonction').classList;
    if(element_2 == "fa fa-angle-up"){
      element_2.remove("fa-angle-up");
      element_2.add("fa-angle-down");
    }else if(element_2 == "fa fa-angle-down"){
      element_2.remove("fa-angle-down");
      element_2.add("fa-angle-up");
    }
  };
  function menu_3(){
    var element_3 = document.getElementById('menu_domaine').classList;
    if(element_3 == "fa fa-angle-up"){
      element_3.remove("fa-angle-up");
      element_3.add("fa-angle-down");
    }else if(element_3 == "fa fa-angle-down"){
      element_3.remove("fa-angle-down");
      element_3.add("fa-angle-up");
    }
  };
  function menu_4(){
    var element_4 = document.getElementById('menu_date').classList;
    if(element_4 == "fa fa-angle-up"){
      element_4.remove("fa-angle-up");
      element_4.add("fa-angle-down");
    }else if(element_4 == "fa fa-angle-down"){
      element_4.remove("fa-angle-down");
      element_4.add("fa-angle-up");
    }
  };
  function menu_5(){
    var element_5 = document.getElementById('menu_modalite').classList;
    if(element_5 == "fa fa-angle-up"){
      element_5.remove("fa-angle-up");
      element_5.add("fa-angle-down");
    }else if(element_5 == "fa fa-angle-down"){
      element_5.remove("fa-angle-down");
      element_5.add("fa-angle-up");
    }
  };

</script>
@endsection