@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<style>
  *{
    font-size: 14px;
  }
    .enfant{
        width: 100%;
        background-color: transparent;
        height: 25px !important;
        border: none;
        margin: 0 4px;
        border-left: 1px solid rgb(130,33,100);
        border-bottom: 1px solid rgb(130,33,100);
    }
    .form_input{
      height: 10px;
      font-size: 12px;
    }
    .form_input_search{
      height: 30px !important;
      border-radius: .5rem;
      border: none;
      border-bottom: 2px solid rgb(130,33,100); 
      border-top: 2px solid rgb(130,33,100); 
      color: grey;
      padding-left: .5rem;
    }
    .btn-hide-column{
      padding: 6px 12px;
      border: none;
      border-bottom: 2px solid rgb(130,33,100); 
      border-top: 2px solid rgb(130,33,100); 
      color: grey;
      border-radius: .5rem;
    }
    .form_input_search:focus{
      outline: none;
      box-shadow: none;
    }
    .search_icon{
      color: rgb(130,33,100);
    }
    .btn-hide{
      padding: 0 6px;
      border: none;
      background-color: transparent;
    }
    .modal > fade{
      float: right !important;
    }
</style>

<div class="d-flex justify-content-between mb-3">
  <div>
    <input type="text" class="form_input_search" placeholder="Rechercher ici . . . ">&nbsp; &nbsp;
    <button class="btn-hide"><i class="fa fa-search search_icon"></i></button>
  </div>
    <div>
      <button class="btn-hide-column"data-toggle="modal" data-target="#exampleModalCenter">< / Cacher des colonnes ></button>
      <button class="btn-hide-column"><i class="fad fa-file-excel" style="color: yellowgreen"></i>&nbsp; Exporter en Excel </button>
    </div>
</div>
<nav class="d-flex">
  <div class="mx-1">
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
  <div class="mx-1">
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
  <div class="mx-1">
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
  <div class="mx-1">
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
  <div class="mx-1">
      <button class="btn btn-success"><i class="fa fa-search"></i> &nbsp; Valider</button>
  </div>
</nav>


<main>
    <section class="d-flex">
        <input class="enfant ps-3" type="text" disabled placeholder="Projet . . .">
        <input class="enfant ps-3" type="text" disabled placeholder="Module . . .">
        <input class="enfant ps-3" type="text" disabled placeholder="Centre . . .">
        <input class="enfant ps-3" type="text" disabled placeholder="Année . . .">
    </section><hr>
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


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
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