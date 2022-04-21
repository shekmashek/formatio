@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<div class="p-3 mb-5 bg-body rounded ">
    <nav class="body_nav m-0 d-flex justify-content-between">
        <div>
            <div class="d-flex m-0 p-0 height_default">
                <h5>{{ $module_session->reference.' - '.$module_session->nom_module }}</h5>&nbsp;&nbsp;&nbsp;
                <div class="{{ $projet[0]->class_status_groupe }} mb-2">{{ $projet[0]->item_status_groupe }}</div>
                <span class="modalite ms-3 mb-2 p-1 ps-2 pe-2">{{ $modalite }}</span>
            </div>
            <div class="d-flex m-0 p-0 height_default">
                <p class=" text-dark mt-3"> <strong>N°: {{ $projet[0]->nom_groupe }}</strong>  </p>
                <p class="m-0">&nbsp; du {{ $projet[0]->date_debut }} au {{ $projet[0]->date_fin }} </p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @canany(['isCFP','isReferent'])
                    <p class="m-0">Chiffre d'affaire HT : &nbsp;</p>
                    <p class="text-dark mt-3"> <strong>@php
                    echo number_format($prix->montant_session,2,"."," ")
                @endphp Ar</strong>  </p>
                @endcanany

                <p class="m-0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Apprenants inscrits : &nbsp;</p>
                <p class="text-dark mt-3"> <strong>{{ $nombre_stg }}</strong>  </p>
            </div>
            {{-- <div class="d-flex m-0 p-0 height_default">
                <p class="m-0">Chiffre d'affaire HT : &nbsp;</p>
                <p class="numero_session text-dark mt-3"> <strong>@php
                    echo number_format($prix->montant_session,2,"."," ");
                @endphp Ar</strong>  </p>
                <p class="m-0">&nbsp;; apprenants inscrits : &nbsp;</p>
                <p class="numero_session text-dark mt-3"> <strong>{{ $nombre_stg }}</strong>  </p>
            </div> --}}
        </div>
        <div>
            <div class="btn_modifier_statut dropdown">

                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true" style="text-decoration: none">
                    <i class='bx bx-slider icon_creer'></i>Modifier statut

                </a>
                <ul class="dropdown-menu" aria-labelledby="ya">
                    <li class="mt-1">
                        <a class="dropdown-item" href="{{ route('modifier_statut_session',[$projet[0]->groupe_id,5]) }}">
                            <i class='bx bx-check'></i>&nbsp;Cloturé
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('modifier_statut_session',[$projet[0]->groupe_id,6]) }}">
                            <i class='bx bxs-report'></i>&nbsp;Reporté
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('modifier_statut_session',[$projet[0]->groupe_id,7]) }}">
                            <i class='bx bx-x'></i>&nbsp;Annulée
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('modifier_statut_session',[$projet[0]->groupe_id,8]) }}">
                            <i class='bx bx-refresh'></i>&nbsp;Repprogrammer
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <section class="bg-light py-1">
        <div class="m-0 p-0">
            <div class="d-flex justify-content-between">
                @if ($type_formation_id == 1)
                    <div class="chiffre_d_affaire">

                        <div class="d-flex flex-row">
                            <p class="p-0 mt-3 text-center">Référent de l'entreprise {{ $projet[0]->nom_etp }} </p>&nbsp;&nbsp;
                            <img src="{{ asset('images/entreprises/'.$projet[0]->logo) }}" alt="" class="mt-2" height="30px" width="30px" style="border-radius: 50%;">&nbsp;
                            {{-- <p class="p-0 mt-3 text-center"> <strong>{{ $projet[0]->nom_etp }}</strong></p>&nbsp;&nbsp; --}}
                            {{-- <p class="p-0 mt-3 text-center"> <strong>{{ $projet[0]->telephone_etp }}</strong></p> --}}
                        </div>
                    </div>
                @endif
                <div class="chiffre_d_affaire">

                    <div class="d-flex flex-row">
                        <p class="p-0 mt-3 text-center"> Responsable de l'organisme de formation {{ $projet[0]->nom_cfp }}</p>&nbsp;&nbsp;
                        <img src="{{ asset('images/CFP/'.$projet[0]->logo_cfp) }}" alt="" class="mt-2" height="30px" width="30px" style="border-radius: 50%;">&nbsp;
                        {{-- <p class="p-0 mt-3 text-center"> <strong>{{ $projet[0]->nom_cfp }}</strong></p>&nbsp;&nbsp; --}}
                        {{-- <p class="p-0 mt-3 text-center"> <strong>{{ $projet[0]->tel_cfp }}</strong></p> --}}
                    </div>
                </div>
                @canany(['isCFP'])
                    <div class="chiffre_d_affaire">
                        <div class="d-flex flex-row">
                            <p class="p-0 mt-3 me-2 text-center"> Formateur(s) :&nbsp;</p>
                            @foreach ($formateur_cfp as $form)
                                <img src="{{ asset('images/formateurs/'.$form->photos) }}" alt="" class="img_superpose mt-2" height="30px" width="30px" style="border-radius: 50%;">
                            @endforeach()
                                {{-- <img src="{{ asset('maquette/user.png') }}" alt="" class="img_superpose" height="30px" width="30px" style="border-radius: 50%;">
                                <img src="{{ asset('maquette/user.png') }}" alt="" class="img_superpose" height="30px" width="30px" style="border-radius: 50%;">
                                <img src="{{ asset('maquette/user.png') }}" alt="" class="img_superpose" height="30px" width="30px" style="border-radius: 50%;"> --}}
                        </div>
                        </strong></p>
                    </div>
                @endcanany

            </div>
            {{-- <div class="d-flex me-2 flex-wrap">
                <div class="{{ $projet[0]->class_status_groupe }}">{{ $projet[0]->item_status_groupe }}</div>
            </div> --}}
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
                    {{-- @if ($type_formation_id == 1) --}}
                        @canany(['isCFP','isReferent','isFormateur'])
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
                        @endcanany
                    {{-- @endif

                    @if ($type_formation_id == 2)
                        @canany(['isReferent'])
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
                        @endcanany --}}
                    {{-- @endif --}}


                            <div>
                                <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'ressource')" style="width: 100%">
                                    <p class="m-0 p-0">RESSOURCES</p>
                                    @if(count($ressource) == 0)
                                    <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                                    @else
                                    <i class="fa fa-check-circle me-2" style="color: chartreuse"></i>
                                    @endif
                                </button>
                            </div>

                            @can('isReferent')
                                <div>
                                    <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'frais')" style="width: 100%">
                                        <p class="m-0 p-0">FRAIS ANNEXES</p>
                                        @if(count($all_frais_annexe) <= 0)
                                            <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                                        @else
                                            <i class="fa fa-check-circle me-2" style="color: chartreuse"></i>
                                        @endif
                                    </button>
                                </div>
                            @endcan

                            <div>
                                <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'document')" style="width: 100%">
                                    <p class="m-0 p-0">DOCUMENTS</p>
                                    {{-- <i class="fa fa-dot-circle me-2" style="color: grey"></i> --}}
                                    {{-- <i class="fa fa-check-circle me-2" style="color: chartreuse"></i> --}}
                                </button>
                            </div>
                        {{-- @if ($type_formation_id == 1) --}}
                            @canany(['isStagiaire'])
                                <div>
                                    <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'chaud')" style="width: 100%">
                                        <p class="m-0 p-0">EVALUATION</p>
                                        <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                                    </button>
                                </div>
                            @endcanany
                            @can('isFormateur')
                                <div>
                                    <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'emargement')" style="width: 100%">
                                        <p class="m-0 p-0">EMARGEMENT</p>
                                        <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                                    </button>
                                </div>
                                <div>
                                    <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'evaluation')" style="width: 100%">
                                        <p class="m-0 p-0">PRE EVALUATION</p>
                                        @if($evaluation_avant <= 0)
                                            <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                                        @else
                                            <i class="fa fa-check-circle me-2" style="color: chartreuse"></i>
                                        @endif
                                    </button>
                                </div>
                                <div>
                                    <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'evaluation_pre_formation')" style="width: 100%">
                                        <p class="m-0 p-0">EVALUATION APRES FORMATION</p>
                                        @if($evaluation_apres <= 0)
                                            <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                                        @else
                                            <i class="fa fa-check-circle me-2" style="color: chartreuse"></i>
                                        @endif
                                    </button>
                                </div>
                            @endcan
                            @canany(['isCFP','isReferent'])
                            <div>
                                <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'evaluation_pre_formation')" style="width: 100%">
                                    <p class="m-0 p-0">EVALUATION DES STAGIAIRES</p>
                                    @if($evaluation_apres <= 0)
                                            <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                                    @else
                                        <i class="fa fa-check-circle me-2" style="color: chartreuse"></i>
                                    @endif
                                </button>
                            </div>
                            @endcanany
                            {{-- <div>
                                <button class="planning d-flex justify-content-between py-1" onclick="openCity(event, 'rapport')" style="width: 100%">
                                    <p class="m-0 p-0">RAPPORT</p>
                                    <i class="fal fa-dot-circle me-2" style="color: grey"></i>
                                </button>
                            </div> --}}
                        {{-- @endif --}}
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
                      {{-- @if ($type_formation_id == 1) --}}
                      {{-- @if ($type_formation_id == 1) --}}
                        @canany(['isCFP','isReferent','isFormateur'])
                            <div id="apprenant" class="tabcontent">
                                @include('admin.stagiaire.ajout_stagiaire')
                            </div>
                        @endcanany
                      {{-- @endif --}}
                      {{-- @if ($type_formation_id == 2)
                        @canany(['isReferent','isCFP'])
                            <div id="apprenant" class="tabcontent">
                                @include('admin.stagiaire.ajout_stagiaire')
                            </div>
                        @endcanany
                      @endif --}}

                      <div id="ressource" class="tabcontent">
                        @include('projet_session.ressource')
                      </div>
                      <div id="frais" class="tabcontent">
                        @include('projet_session.frais_annexe')
                      </div>
                      <div id="document" class="tabcontent">
                        @include('projet_session.document')
                      </div>
                      @canany(['isStagiaire'])
                        <div id="chaud" class="tabcontent">
                            {{-- @include('projet_session.index_evaluation') --}}
                            @include('admin.evaluation.evaluationChaud.evaluationChaud')
                        </div>
                      @endcanany
                      <div id="emargement" class="tabcontent">
                        @include('projet_session.emargement')
                      </div>
                      <div id="evaluation_pre_formation" class="tabcontent">
                        @include('projet_session.evaluation_stagiaires_pre')
                      </div>
                      <div id="evaluation" class="tabcontent">
                        @include('projet_session.evaluation_stagiaires')
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
<div class="infos mt-3">
    <div class="row">
        <div class="col">
            <p class="m-0">infos</p>
        </div>
        <div class="col text-end">
            <i class="bx bx-x " role="button" onclick="afficherInfos();"></i>
        </div>
        <hr class="mt-2">
        <div class="text-center mt-2">
            @if($type_formation_id)
            <img src="{{ asset('images/entreprises/'.$projet[0]->logo) }}" class="img-fluid text-center"  style="width:120px;height:60px;" role="button" onclick="afficherInfos();"  >
            <div >
                <p class="p-0 m-0 text-center" > <strong>{{ $projet[0]->nom_etp }}</strong></p>
                <p class="p-0 m-0 text-center"> <strong>{{ $projet[0]->telephone_etp }}</strong></p>
                <p class="p-0 m-0 text-center"> <strong>{{ $projet[0]->email_etp }}</strong></p>
              <p class="p-0 m-0 text-center"> <strong>  Adresse:{{ $projet[0]->adresse_rue}} {{ $projet[0]->adresse_quartier }} {{ $projet[0]->adresse_code_postal}} {{ $projet[0]->adresse_ville}} {{ $projet[0]->adresse_region}}</strong></p>
            </div>
            @endif

         </div>


    </div>
</div>
</div>
{{-- affiche prof --}}
<div class="prof mt-3">
    <div class="row">
        <div class="col">
            <p class="m-0">Infos</p>
        </div>
        <div class="col text-end">
            <i class="bx bx-x " role="button" onclick="afficherProf();"></i>
        </div>
        <hr class="mt-2">
        <div class="text-center mt-2">

              </div>
              <div >

              </div>

    </div>
</div>
</div>
<style>
.shadow{
    height: auto;
}

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
    /* background-color: #e8e8e9;
    color: rgb(3, 0, 0); */
    padding: 6px 8px;
    border-radius: 4px 4px 0 0;
    font-family: 'Open Sans';
}
.numero_session{
    background-color: rgb(255, 255, 255);
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
}
.status_grise{
    border-radius: 1rem;
    background-color: #637381;
    color: white;
    /* width: 60%; */
    align-items: center
    margin: 0 auto;
    padding :.1rem .5rem;
}

.status_reprogrammer{
    border-radius: 1rem;
    background-color: #00CDAC;
    color: white;
    /* width: 60%; */
    align-items: center
    margin: 0 auto;
    padding :.1rem .5rem;
}

.status_cloturer{
    border-radius: 1rem;
    background-color: #314755;
    color: white;
    /* width: 60%; */
    align-items: center
    margin: 0 auto;
    padding :.1rem .5rem;
}

.status_reporter{
    border-radius: 1rem;
    background-color: #26a0da;
    color: white;
    /* width: 60%; */
    align-items: center
    margin: 0 auto;
    padding :.1rem .5rem;
}

.status_annulee{
    border-radius: 1rem;
    background-color: #b31217;
    color: white;
    /* width: 60%; */
    align-items: center
    margin: 0 auto;
    padding :.1rem .5rem;
}
.status_termine{
    border-radius: 1rem;
    background-color: #1E9600;
    color: white;
    /* width: 60%; */
    align-items: center
    margin: 0 auto;
    padding :.1rem .5rem;
}
.status_confirme{
    border-radius: 1rem;
    background-color: #2B32B2;
    color: white;
    /* width: 60%; */
    align-items: center
    margin: 0 auto;
    padding :.1rem .5rem;
}

.statut_active{
    border-radius: 1rem;
    background-color: rgb(15,126,145);
    color: whitesmoke;
    /* width: 60%; */
    align-items: center
    margin: 0 auto;
    padding :.1rem .5rem;
}

.modalite{
    border-radius: 1rem;
    background-color: rgb(213, 146, 217);
    color: whitesmoke;
    /* width: 60%; */
    align-items: center
    margin: 0 auto;

    padding : 0.1rem 0.5rem !important;
}

.planning{
    text-align: left;
    padding-left: 6px;
    height: 100%;
    font-size: 12px;
    /* background-color: rgba(230, 228, 228, 0.39);
    border-bottom: 1px solid rgb(187, 183, 183); */
}
.planning:hover{
    background-color: #eeeeee;
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
    box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 3px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;
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

.btn_modifier_statut{
    /* background-color: white; */
    /* border: none; */
    border-radius: 30px;
    padding: .2rem 1rem;
    color: black;
    /* box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px; */
}

.btn_modifier_statut a{
    font-size: .8rem;
    position: relative;
    bottom: .2rem;
}

.btn_modifier_statut:hover{
    background: #eeeeee;
    color: rgb(0, 0, 0);
}

/* .btn_modifier_statut:focus{
    color: blue;
    text-decoration: none;
} */

.icon_creer{
    background-image: linear-gradient(60deg, #f206ee, #0765f3);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    font-size: 1.5rem;
    position: relative;
    top: .4rem;
    margin-right: .3rem;
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