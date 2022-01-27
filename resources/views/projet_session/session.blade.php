@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<div class="shadow p-3 mb-5 bg-body rounded">
    <nav class="body_nav m-0 d-flex justify-content-between">
        <div>
            <h5>Session </h5>
            <div class="d-flex m-0 p-0 height_default">
                <p class="m-0"> Session  &nbsp; &nbsp; </p>
                <p class="numero_session text-dark mt-3"> <strong>n°: {{ $projet[0]->nom_groupe }}</strong>  </p>
                <p class="m-0">&nbsp; &nbsp; du {{ $projet[0]->date_debut }} au {{ $projet[0]->date_fin }} </p>
                <p class="m-0">&nbsp; appartenant au projet &nbsp;</p>
                <p class="numero_session text-dark mt-3"> <strong>{{ $projet[0]->nom_projet }}</strong> </p>
            </div>
            <div class="d-flex m-0 p-0 height_default">
                <p class="m-0">Chiffre d'affaire HT : &nbsp;</p>
                <p class="numero_session text-dark mt-3"> <strong>7 000 000 Ar</strong>  </p>
                <p class="m-0">&nbsp;; apprenants inscrits : &nbsp;</p>
                <p class="numero_session text-dark mt-3"> <strong>{{ $nombre_stg }}</strong>  </p>
            </div>
        </div>
        <div>
            <a href="{{ url('projet_session') }}"> <i class="fa fa-arrow-alt-circle-left mt-4 me-3" href="{{ url('projet_session') }}">&nbsp; projet</i> </a>
        </div>
    </nav>
    <section class="bg-light py-1">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex flex-wrap">
                <div class="chiffre_d_affaire">
                    <p class="p-0 m-0 text-center"> Referent entreprise </p>
                    <p class="p-0 m-0 text-center"> <strong>{{ $projet[0]->nom_etp }}</strong></p>
                    <p class="p-0 m-0 text-center"> <strong>{{ $projet[0]->telephone_etp }}</strong></p>
                </div>
                <div class="chiffre_d_affaire">
                    <p class="p-0 m-0 text-center"> Organisme de formation </p>
                    <div class="d-flex">
                        <div>
                            <img src="{{ asset('images/CFP/'.$projet[0]->logo_cfp) }}" alt="" width="50px" height="50px" class="img-fluid">
                        </div>
                        <div>
                            <p class="p-0 m-0 text-center"> <strong>{{ $projet[0]->nom_cfp }}</strong></p>
                            <p class="p-0 m-0 text-center"> <strong>{{ $projet[0]->telephone_cfp }}</strong></p>
                        </div>
                    </div>
                </div>
                <div class="chiffre_d_affaire">
                    <p class="p-0 m-0 text-center"> Formateur(s) </p>
                    <p class="p-0 m-0 text-center"> <strong>
                       <div class="pad_img">
                            <img src="{{ asset('maquette/user.png') }}" alt="" class="img_superpose" height="30px" width="30px" style="border-radius: 50%;">
                            <img src="{{ asset('maquette/user.png') }}" alt="" class="img_superpose" height="30px" width="30px" style="border-radius: 50%;">
                            <img src="{{ asset('maquette/user.png') }}" alt="" class="img_superpose" height="30px" width="30px" style="border-radius: 50%;">
                       </div>
                    </strong></p>
                </div>
            </div>
            <div class="d-flex me-2 flex-wrap">
                <div class="status_grise">Prévisionnel</div>
                <div class="status_confirme">Confirmé</div>
                <div class="statut_active">En cours</div>
                <div class="status_termine">Terminé</div>
                <div class="status_archive">Archivé</div>
                <div class="status_annule">Annulé</div>
            </div>
        </div>
    </section>
    <section>
        <div class="row p-0">
            <div class="col-md-2 py-3 pe-4">
                <div class="corps_planning m-0 bg-light">
                    <div >
                        <button class="planning d-flex justify-content-between py-1 active" onload="loadContent()" onclick="openCity(event, 'planning')" style="width: 100%" id="on_load">
                            <p class="m-0 p-0">PLANNING</p>
                            @if($test == 0)
                            <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                            @endif
                            @if($test != 0)
                            <i class="fa fa-check-circle me-2" style="color: chartreuse"></i>
                            @endif
                        </button>
                    </div>
                    <div>
                        <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'apprenant')" style="width: 100%">
                            <p class="m-0 p-0">APPRENANTS</p>
                            @if(count($stagiaire) == 0)
                            <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                            @endif
                            @if(count($stagiaire) != 0)
                            <i class="fa fa-check-circle me-2" style="color: chartreuse"></i>
                            @endif
                        </button>
                    </div>
                    <div>
                        <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'ressource')" style="width: 100%">
                            <p class="m-0 p-0">RESSOURCES</p>
                            <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                        </button>
                    </div>
                    <div>
                        <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'frais')" style="width: 100%">
                            <p class="m-0 p-0">FRAIS ANNEXES</p>
                            <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                        </button>
                    </div>
                    <div>
                        <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'document')" style="width: 100%">
                            <p class="m-0 p-0">DOCUMENT</p>
                            {{-- <i class="fa fa-dot-circle me-2" style="color: grey"></i> --}}
                            <i class="fa fa-check-circle me-2" style="color: chartreuse"></i>
                        </button>
                    </div>
                    <div>
                        <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'chaud')" style="width: 100%">
                            <p class="m-0 p-0">EVALUATION</p>
                            <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                        </button>
                    </div>
                    <div>
                        <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'emargement')" style="width: 100%">
                            <p class="m-0 p-0">EMARGEMENT</p>
                            <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                        </button>
                    </div>
                    <div>
                        <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'rapport')" style="width: 100%">
                            <p class="m-0 p-0">RAPPORT</p>
                            <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-md-10 pt-3">
                {{-- commentaire --}}
                {{-- <div class="d-flex justify-content-end">
                    <img src="{{ asset('maquette/cac.png') }}" alt="" class="img_commentaire" onclick="myFunction_commentaire()">
                </div>

                    <div id="myDIV" class="card col-4">
                        <div class="titre_card align-middle py-1">
                         <p class="text-center m-0 p-0">COMMENTAIRE</p>
                        </div>
                         <div class="card-body">
                             <p>Ici votre commentaire !</p>
                         </div>
                     </div> --}}

                {{-- commentaire --}}


                    {{-- div absolute planning --}}

                    <div id="planning" class="tabcontent" style="display: block;">
                            @include('admin.detail.detail')
                      </div>
                      <div id="apprenant" class="tabcontent">
                        @include('admin.stagiaire.ajout_stagiaire')
                      </div>
                      <div id="ressource" class="tabcontent">
                        @include('projet_session.ressource')
                      </div>
                      <div id="frais" class="tabcontent">
                        @include('projet_session.frais_annexe')
                      </div>
                      <div id="document" class="tabcontent">
                        @include('projet_session.document')
                      </div>
                      <div id="chaud" class="tabcontent">
                        @include('projet_session.index_evaluation')
                      </div>
                      <div id="emargement" class="tabcontent">
                        Emargement
                      </div>
                      <div id="rapport" class="tabcontent">
                        Rapport de formation
                      </div>

                   {{-- fin div absolute planning --}}

                        {{-- <div class="card col-4">
                           <div class="titre_card align-middle py-1">
                            <p class="text-center m-0 p-0">COMMENTAIRE</p>
                           </div>
                            <div class="card-body">
                                <p>Ici votre commentaire !</p>
                            </div>
                        </div> --}}

            </div>
        </div>
    </section>
</div>


<style>
*{
    font-family: 'Open Sans';
    font-size: .9rem;
}
.body_nav p{
    font-size: 0.9rem;
}

.chiffre_d_affaire p{
    font-size: 0.9rem;
}

.corps_planning{
    font-size: 0.9rem;
}

.body_nav{
    background-color: rgb(130,33,100);
    color: whitesmoke;
    padding: 6px 8px;
    border-radius: 4px 4px 0 0;
    font-family: 'Open Sans';
}
.numero_session{
    background-color: rgb(233, 222, 177);
    padding: 0 6px;
    border-radius: 4px;
}
strong{
    font-size: 10px;
}
.img_commentaire{
    border-radius: 5rem;
    position: absolute;
    width: 40px;
    height: 40px;
    margin-right: 10px;
}
.img_commentaire:hover{
    cursor: pointer;
}
.height_default{
    height: 27px;
    align-items: center

}
a{
    font-size: 12px;
    text-decoration: none;
}
#myDIV{
    position: absolute;
    display: none;
    margin-left: 57%;
    margin-top: 20px;
}
u{
    font-size: 12px;
}
.pad_img{
    padding-left: 10px;
}
a:hover{
    color: blueviolet;
}
p{
    font-size: 10px;
}
.img_superpose{
    margin-left: -10px;
    border: 2px solid white;
}
.chiffre_d_affaire{
    padding: 0 10px;
    border-right: 2px solid rgb(15,126,145);
}
.status_grise{
    margin: 0 2px;
    padding: 4px 6px;
    font-size: 10px;
    font-weight: bold;
    height: 50%;
    border-radius: 1rem;
    background-color: rgb(150, 144, 144);
    color: white;
}
.status_annule{
    margin: 0 2px;
    padding: 4px 6px;
    font-size: 10px;
    font-weight: bold;
    height: 50%;
    border-radius: 1rem;
    background-color: rgb(184, 3, 3);
    color: white;
}
.status_termine{
    margin: 0 2px;
    padding: 4px 6px;
    font-size: 10px;
    font-weight: bold;
    height: 50%;
    border-radius: 1rem;
    background-color: green;
    color: white;
}
.status_confirme{
    margin: 0 2px;
    padding: 4px 6px;
    font-size: 10px;
    font-weight: bold;
    height: 50%;
    border-radius: 1rem;
    background-color: #801D68;
    color: white;
}
.status_archive{
    margin: 0 2px;
    padding: 4px 6px;
    font-size: 10px;
    font-weight: bold;
    height: 50%;
    border-radius: 1rem;
    background-color: orangered;
    color: white;
}
.statut_active{
    margin: 0 2px;
    font-size: 10px;
    height: 50%;
    font-weight: bold;
    padding: 4px 6px;
    border-radius: 1rem;
    background-color: rgb(15,126,145);
    color: whitesmoke;
}
.planning{
    text-align: left;
    padding-left: 6px;
    height: 100%;
    font-size: 12px;
    background-color: rgba(230, 228, 228, 0.39);
    border-bottom: 1px solid rgb(187, 183, 183);
}
.dernier_planning{
    text-align: left;
    padding-left: 6px;
    height: 100%;
    font-size: 12px;
    background-color: rgba(230, 228, 228, 0.39);
}
.dernier_planning:focus{
    color: rgb(130,33,100);
    background-color: white;
    font-weight: bold;
}
.active{
    color: rgb(130,33,100);
    background-color: white;
    font-weight: bold;
}
.corps_planning{
    /* border: 1px solid grey; */
    box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
}
button{
    background-color: white;
    border: none;
    margin: 0;
    padding: 0;
}
.titre_card{
    background-color: rgb(223, 219, 219);
    height: 30px;
    border-radius: 4px 4px 0 0;
    margin: 2px 0;
    color: white;
}
.card{
    position: absolute;
}

/* Style the tab content */
.tabcontent {
    display: none;
}
</style>
<script type="text/javascript">
function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("planning");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}

function myFunction_commentaire() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
@endsection