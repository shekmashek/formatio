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
    height: 1.6em !important;
    padding-left: .5rem;
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
    margin-left: 40%;
    margin-top: 1rem;
    margin-bottom: 1rem;
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
    margin-left: 1rem;
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
  }
</style>

<div class="col-md-6 mx-auto">
  {{-- personne --}}
  <div class="Titre_div px-3" href="#personne" data-toggle="collapse" onclick="menu_1()">
    <article>Personne</article>
    <i class="fa fa-angle-up" id="menu_personne"></i>
  </div>

  <div class="px-3 pt-3 bg-white collapse show" id="personne">
    <div class="shadow_card col-6">
      <h6 class="text-center">Sexe</h6>
      <div class="d-flex flex-wrap justify-content-center">
        <button class="classe_sexe_active" onclick="tous_btn()" id="tous_btn">Tous</button>
        <button class="classe_sexe" onclick="homme_btn()" id="homme_btn">Homme</button>
        <button class="classe_sexe" onclick="femme_btn()" id="femme_btn">Femme</button>
      </div>
      <div class="d-flex align-items-center m-0 p-0" style="height: 2em !important;">
        <p class="p-0 m-0"> Matricule</p>
        <input type="text" class="input-recherche w-100">&nbsp; au &nbsp;
        <input type="text" class="input-recherche w-100">
      </div>
    </div>
    <div class="d-flex align-items-center m-0 p-0">
      <p class="p-0 m-0"> Nom </p>
        <input type="text" class="input-recherche w-100 ms-3">
    </div>
    <div class="d-flex align-items-center m-0 p-0">
      <p class="p-0 m-0"> Prénom </p>
        <input type="text" class="input-recherche w-100">
    </div>
    <li>
      <button class="btn-appliquer">Appliquer</button>
    </li>
  </div>
  {{-- personne --}}

  {{-- fonction --}}
  <div class="Titre_div px-3" href="#fonction" data-toggle="collapse" onclick="menu_2()">
    <article>Fonction</article>
    <i class="fa fa-angle-up" id="menu_fonction"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="fonction">
    <div class="d-flex align-items-center m-0 p-0" style="height: 2em !important;">
      <p class="p-0 m-0"> Fonction </p>
      <input type="text" class="input-recherche w-100">
    </div>
    <div class="d-flex align-items-center m-0 p-0">
      <p class="p-0 m-0"> Département </p>
        <input type="text" class="input-recherche w-100 ms-3">
    </div>
    <div class="d-flex align-items-center m-0 p-0">
      <p class="p-0 m-0"> Service </p>
        <input type="text" class="input-recherche w-100">
    </div>
    <div class="d-flex align-items-center m-0 p-0">
      <p class="p-0 m-0"> Branche </p>
        <input type="text" class="input-recherche w-100">
    </div>
    <li>
      <button class="btn-appliquer">Appliquer</button>
    </li>
  </div>
  {{-- fonction --}}

  {{-- domaine --}}
  <div class="Titre_div px-3" href="#domaine" data-toggle="collapse" onclick="menu_3()">
    <article>Domaine</article>
    <i class="fa fa-angle-up" id="menu_domaine"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="domaine">
    <div class="d-flex align-items-center m-0 p-0" style="height: 2em !important;">
      <p class="p-0 m-0"> Domaine </p>
      <input type="text" class="input-recherche w-100">
    </div>
    <div class="d-flex align-items-center m-0 p-0">
      <p class="p-0 m-0"> Thématique </p>
        <input type="text" class="input-recherche w-100 ms-3">
    </div>
    <div class="d-flex align-items-center m-0 p-0">
      <p class="p-0 m-0"> Organisme de formation </p>
        <input type="text" class="input-recherche w-100">
    </div>
    <li>
      <button class="btn-appliquer">Appliquer</button>
    </li>
  </div>
  {{-- domaine --}}

  {{-- Date --}}
  <div class="Titre_div px-3" href="#date_recherche" data-toggle="collapse" onclick="menu_4()">
    <article>Date</article>
    <i class="fa fa-angle-up" id="menu_date"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="date_recherche">
    <div class="d-flex align-items-center m-0 p-0" style="height: 2em !important;">
      <p class="p-0 m-0 pt-2"> Date </p>&nbsp; &nbsp; &nbsp;
        <input type="date" name="" id="">&nbsp; <p class="pt-4">au</p> &nbsp;
        <input type="date" name="" id="">
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
    <li>
      <button class="btn-appliquer">Appliquer</button>
    </li>
  </div>
  {{-- Date --}}

  {{-- Qualite --}}
  <div class="Titre_div px-3" href="#qualite" data-toggle="collapse" onclick="menu_5()">
    <article>Qualite</article>
    <i class="fa fa-angle-up" id="menu_qualite"></i>
  </div>
  <div class="px-3 pt-3 bg-white collapse show" id="qualite">
    <div class="d-flex justify-content-between">
      <p>Présence</p> <input type="radio" class="" name="flexRadioDefault" id="flexRadioDefault1">
    </div>
    <div class="d-flex justify-content-between">
       <p>Absence</p> <input type="radio" class="" name="flexRadioDefault" id="flexRadioDefault1">
    </div>
    <li>
      <button class="btn-appliquer">Appliquer</button>
    </li>
  </div>
  {{-- qualite --}}
</div>



<script>
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
    var element_5 = document.getElementById('menu_qualite').classList;
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