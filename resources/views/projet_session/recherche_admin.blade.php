@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<style>
  *{
    font-size: 1rem;
    font-family: 'Lato';
  }
  .input-recherche{
    height: 2em !important;
    padding-left: .5rem;
  }
  .bordure_sexe{
    /* border: 1px solid grey; */
    height: 2em;
    display: flex;
    align-items: center;
    padding: 0 6px;
  }
  .titre_card{
    background-color: #ffffff;
    border-top:3px solid rgb(130,33,100);
    border-left: 2px solid rgb(130,33,100);
    border-right: 2px solid rgb(130,33,100);
    border-top-right-radius: .5rem;
    padding: 0 6px;
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
    transform: rotate(-10deg);
    transition: all .6s ease;
  }
  .btn-appliquer:hover{
    transform: rotate(0deg);
  }
  .box-separateur{
    border-right: 2px solid rgb(130,33,100);
    padding-right: 1rem;
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
<span class="titre_card">Personne&nbsp; &nbsp; <i class="fa fa-eye" href="#personne_ressource" data-toggle="collapse"></i></span>
<div class="collapse show" id="personne_ressource">
<div class="d-flex shadow justify-content-between align-items-center py-2">
  <div class="d-flex">
    <div class="box-separateur">
      <label for="sexe"  class="ms-2"><u>Sexe</u> :</label><br>
        <div class="bordure_sexe mt-2">
          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">Homme</label>
          </div>

          <div class="form-check mx-2">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
            <label class="form-check-label" for="flexRadioDefault1">Femme</label>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" checked>
            <label class="form-check-label" for="flexRadioDefault1">Tout</label>
          </div>
        </div>
    </div>

    <div class="mx-2 box-separateur">
      <label for="matricule"><u>Matricule</u> :</label><br>
      <input type="text" class="input-recherche" name="" id="" placeholder="N° matricule">
    </div>

    <div class="mx-2 box-separateur">
      <label for="nom"><u>Nom</u> :</label><br>
      <input type="text" class="input-recherche" placeholder="Nom . . .">
    </div>

    <div class="mx-2 box-separateur">
      <label for="prenom"><u>Prenom</u> :</label><br>
      <input type="text" class="input-recherche" placeholder="Prénom . . .">
    </div>
  </div>
  <div class="mx-2">
    <button class="btn-appliquer">Appliquer</button>
  </div>
</div><br>
</div>
{{-- personne --}}

{{-- fonction --}}
<span class="titre_card">Fonction&nbsp; &nbsp; <i class="fa fa-eye" href="#fonction_ressource" data-toggle="collapse"></i></span>
<div class="collapse show" id="fonction_ressource">
<div class="d-flex shadow justify-content-between align-items-center py-2">
  <div class="d-flex">
    <div class="mx-2 box-separateur">
      <label for="fonction"><u>Fonction</u> :</label><br>
      <input type="text" class="input-recherche" placeholder="Fonction . . .">
    </div>
    <div class="mx-2 box-separateur">
      <label for="departement"><u>Département</u> :</label><br>
      <input type="text" class="input-recherche" placeholder="Département . . .">
    </div>
    <div class="mx-2 box-separateur">
      <label for="service"><u>Service</u> :</label><br>
      <input type="text" class="input-recherche" placeholder="Service . . .">
    </div>
    <div class="mx-2 box-separateur">
      <label for="branche"><u>Branche</u> :</label><br>
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
<span class="titre_card">Domaine&nbsp; &nbsp; <i class="fa fa-eye" href="#domaine_ressource" data-toggle="collapse"></i></span>
<div class="collapse show" id="domaine_ressource">
<div class="d-flex shadow justify-content-between align-items-center py-2">
  <div class="d-flex">
    <div class="mx-2 box-separateur">
      <label for="domaine"><u>Domaine</u> :</label><br>
      <input type="text" class="input-recherche" placeholder="Fonction . . .">
    </div>
    <div class="mx-2 box-separateur">
      <label for="thematique"><u>Thématique</u> :</label><br>
        <select class="select-class">
          <option selected hidden style="color: grey">Choississez le thématique</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
    </div>
    <div class="mx-2 box-separateur">
      <label for="of"><u>Organisme de formation</u> :</label><br>
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
<span class="titre_card">Date&nbsp; &nbsp; <i class="fa fa-eye" href="#date_ressource" data-toggle="collapse"></i></span>
<div id="date_ressource" class="collapse show">
<div class="d-flex shadow justify-content-between align-items-center py-2" >
  <div class="d-flex">
    <div class="mx-2 box-separateur">
      <label for="date"><u>Date</u> :</label><br>
      <input type="text" class="input-recherche" placeholder="11/02/2021 . . .">
    </div>
    <div class="mx-2 box-separateur">
      <label for="mois"><u>Mois</u> :</label><br>
      <input type="text" class="input-recherche" placeholder="Janvier . . .">
    </div>
    <div class="mx-2 box-separateur">
      <label for="annee"><u>Année</u> :</label><br>
      <input type="text" class="input-recherche" placeholder="2022 . . .">
    </div>
  </div>
  <div>
    <button class="btn-appliquer me-2">Appliquer</button>
  </div>
</div>
</div>
{{-- date --}}
@endsection