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
    height: 2em !important;
    padding-left: .5rem;
  }
  .label_sexe{
    border: 1px solid aqua;
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
    transition: all .4s ease-in-out;
  }
  .btn-appliquer:hover{
    transform: scale(1.1) ;
  }
  .box-separateur{
    box-shadow: rgb(130,33,100) 0px 2px 4px 0px;
    border-radius: .5rem;
    padding: 1rem;
    background-color: #fff;
    margin: 0 2px;
  }
  .select-class{
    height: 2em !important;
    margin: 0 !important;
  }
  i:hover{
    cursor: pointer;
  }
</style>

{{-- personne --}}
{{-- hfkhnd --}}
   <div class="bg-white p-0 w-100 ">
    <div class="d-flex justify-content-between pt-2 px-4"><h5 class="titre_card">Personne</h5> <i class="fa fa-eye" href="#personne_ressource" data-toggle="collapse"></i></div>
    <div class="collapse show" id="personne_ressource">
        <div class="d-flex justify-content-evenly">
          <div class="box-separateur px-5">
            <label for="sexe"  class="ms-2">Sexe :</label><br>
                  <label class="form-check-label p-0 m-0 label_sexe" for="flexRadioDefault1">Homme</label>
                  <label class="form-check-label p-0 m-0 label_sexe" for="flexRadioDefault1">Femme</label>
                  <label class="form-check-label p-0 m-0 label_sexe" for="flexRadioDefault1">Tout</label>
          </div>

          <div class="box-separateur">
            <label for="matricule">Matricule :</label><br>
            <input type="text" class="input-recherche" name="" id="" placeholder="N° matricule" width="75px">
          </div>

          <div class="box-separateur">
            <label for="nom">Nom :</label><br>
            <input type="text" class="input-recherche" placeholder="Nom . . .">
          </div>

          <div class="box-separateur">
            <label for="prenom">Prenom :</label><br>
            <input type="text" class="input-recherche" placeholder="Prénom . . .">
          </div>

          <div class="box-separateur">
            <label for="age">Age :</label><br>
            <input type="text" class="input-recherche" placeholder="32 . . .">
          </div>
        </div>
      <div class="mt-3 me-4 mb-2 d-flex justify-content-end">
        <button class="btn-appliquer">Appliquer</button>
      </div><br>
    </div>
   </div>
{{-- personne --}}

{{-- fonction --}}
<span>Fonction&nbsp; &nbsp; <i class="fa fa-eye" href="#fonction_ressource" data-toggle="collapse"></i></span>
<div class="collapse show" id="fonction_ressource">
<div class="d-flex shadow justify-content-between align-items-center py-2">
  <div class="d-flex">
    <div class="mx-2 box-separateur">
      <label for="fonction">Fonction :</label><br>
      <input type="text" class="input-recherche" placeholder="Fonction . . .">
    </div>
    <div class="mx-2 box-separateur">
      <label for="departement">Département :</label><br>
      <input type="text" class="input-recherche" placeholder="Département . . .">
    </div>
    <div class="mx-2 box-separateur">
      <label for="service">Service :</label><br>
      <input type="text" class="input-recherche" placeholder="Service . . .">
    </div>
    <div class="mx-2 box-separateur">
      <label for="branche">Branche :</label><br>
      <input type="text" class="input-recherche" placeholder="Branche . . .">
    </div>
  </div>
  <div>
    <button class="btn-appliquer me-2">Appliquer</button>
  </div>
</div><br>
</div>
{{-- fonction --}}

{{-- domaine --}}
<span>Domaine&nbsp; &nbsp; <i class="fa fa-eye" href="#domaine_ressource" data-toggle="collapse"></i></span>
<div class="collapse show" id="domaine_ressource">
<div class="d-flex shadow justify-content-between align-items-center py-2">
  <div class="d-flex">
    <div class="mx-2 box-separateur">
      <label for="domaine">Domaine :</label><br>
      <input type="text" class="input-recherche" placeholder="Fonction . . .">
    </div>
    <div class="mx-2 box-separateur">
      <label for="thematique">Thématique :</label><br>
        <select class="select-class">
          <option selected hidden style="color: grey">Choississez le thématique</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
    </div>
    <div class="mx-2 box-separateur">
      <label for="of">Organisme de formation :</label><br>
      <input type="text" class="input-recherche" placeholder="Service . . .">
    </div>
  </div>
  <div>
    <button class="btn-appliquer me-2">Appliquer</button>
  </div>
</div><br>
</div>
{{-- domaine --}}

{{-- date --}}
<span>Date&nbsp; &nbsp; <i class="fa fa-eye" href="#date_ressource" data-toggle="collapse"></i></span>
<div id="date_ressource" class="collapse show">
<div class="d-flex shadow justify-content-between align-items-center py-2" >
  <div class="d-flex">
    <div class="mx-2 box-separateur">
      <label for="date">Date :</label><br>
      <input type="text" class="input-recherche" placeholder="11/02/2021 . . .">
    </div>
    <div class="mx-2 box-separateur">
      <label for="mois">Mois :</label><br>
      <input type="text" class="input-recherche" placeholder="Janvier . . .">
    </div>
    <div class="mx-2 box-separateur">
      <label for="annee">Année :</label><br>
      <input type="text" class="input-recherche" placeholder="2022 . . .">
    </div>
  </div>
  <div>
    <button class="btn-appliquer me-2">Appliquer</button>
  </div>
</div><br>
</div>
{{-- date --}}

{{-- qualité --}}
<span>Qualité&nbsp; &nbsp; <i class="fa fa-eye" href="#qualite_ressource" data-toggle="collapse"></i></span>
<div id="qualite_ressource" class="collapse show">
<div class="d-flex shadow justify-content-between align-items-center py-2" >
  <div class="d-flex">
    <div class="mx-2 box-separateur">
      <label for="presence">Qualité :</label><br>
      <span class="d-flex">
        <div class="form-check mx-2">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
          <label class="form-check-label" for="flexRadioDefault1">Présence</label>
        </div>
        <div class="form-check mx-2">
          <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
          <label class="form-check-label" for="flexRadioDefault1">Absence</label>
        </div>
      </span>
    </div>
    <div class="mx-2 box-separateur">
      <label for="mois">Réussite :</label><br>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
        <label class="form-check-label" for="flexRadioDefault1">Absence</label>
      </div>
    </div>
  </div>
  <div>
    <button class="btn-appliquer me-2">Appliquer</button>
  </div>
</div>
</div><br>
{{-- qualité --}}
@endsection