@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<style>
    .enfant{
        width: 100%;
        background-color: #fff;
        border: none;
        margin: 0 1em;
        border-bottom: 1px solid #000;
    }
</style>

<nav class="d-flex justify-content-end pe-4">
    <button class="btn btn-secondary"><i class="fad fa-file-excel" style="color: yellowgreen"></i>&nbsp; Exporter en Excel </button>
</nav>
<nav class="d-flex">
    <div class="mx-3">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Projet
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
    </div>
    <div class="mx-3">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Module
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
    </div>
    <div class="mx-3">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Centre
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
    </div>
    <div class="mx-3">
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Année
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
    </div>
    <div class="mx-3">
        <button class="btn btn-success"><i class="fa fa-search"></i> &nbsp; Valider</button>
    </div>
</nav>
<input type="checkbox" id="checkme"/>
  <input type="submit" name="sendNewSms" class="inputButton" disabled="disabled" id="sendNewSms" value=" Send " />

<main>
    <section class="d-flex">
        <input class="enfant" type="text" disabled placeholder="Projet . . .">
        <input class="enfant" type="text" disabled placeholder="Module . . .">
        <input class="enfant" type="text" disabled placeholder="Centre . . .">
        <input class="enfant" type="text" disabled placeholder="Année . . .">
    </section>
    <section>
        <table class="table">
            <thead>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Age</th>
                <th>Sexe</th>
            </thead>
            <tbody>
                <tr>
                    <td>Rakoto</td>
                    <td>Bema</td>
                    <td>32</td>
                    <td>homme</td>
                </tr>
            </tbody>
        </table>
    </section>
</main>



<script>
     var checker = document.getElementById('checkme');
 var sendbtn = document.getElementById('sendNewSms');
 // when unchecked or checked, run the function
 checker.onchange = function(){
if(this.checked){
    sendbtn.disabled = false;
} else {
    sendbtn.disabled = true;
}

}
</script>
@endsection