@extends('./layouts/admin')
@inject('groupe', 'App\groupe')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/configAll.css')}}">
<style>
    .corps_planning .nav-link {
        color: #637381;
        padding: 5px;
        cursor: pointer;
        font-size: 0.900rem;
        transition: all 200ms;
        text-transform: uppercase;
        padding-top: 10px;
    }


    .nav-item .nav-link button.active {
        /* border-bottom: 3px solid #7635dc !important; */
        color: #7635dc;
        border-right:.2rem solid  #7635dc;
    }

    .nav-tabs .nav-link:hover {
        background-color: rgb(245, 243, 243);
        transform: scale(1.1);
        border: none;
    }

    .nav-tabs .nav-item a {
        text-decoration: none;
        text-decoration-line: none;
    }

    .corps_planning .nav-item .planning{
        border-right:.2rem solid  #c5c4c49b;
    }

</style>
<style>
    .shadow {
        height: auto;
    }

    * {
        font-size: .9rem;
    }

    .body_nav p {
        font-size: 0.9rem;
    }

    .chiffre_d_affaire p {
        font-size: 0.9rem;
    }
/*
    .corps_planning {
        font-size: 1.5rem;
    } */

    .body_nav {
        /* background-color: #e8e8e9;
    color: rgb(3, 0, 0); */
        padding: 6px 8px;
        border-radius: 4px 4px 0 0;
    }

    .numero_session {
        background-color: rgb(255, 255, 255);
        padding: 0 6px;
        border-radius: 4px;
    }

    strong {
        font-size: 10px;
    }

    .img_commentaire {
        border-radius: 5rem;
        position: absolute;
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }

    .img_commentaire:hover {
        cursor: pointer;
    }

    .height_default {
        height: 27px;
        align-items: center
    }

    a {
        font-size: 12px;
        text-decoration: none;
    }

    #myDIV {
        position: absolute;
        display: none;
        margin-left: 57%;
        margin-top: 20px;
    }

    u {
        font-size: 12px;
    }

    .pad_img {
        padding-left: 10px;
    }

    a:hover {
        color: blueviolet;
    }

    p {
        font-size: 10px;
    }

    .img_superpose {
        margin-left: -10px;
        border: 2px solid white;
    }

    .chiffre_d_affaire {
        padding: 0 10px;
    }

    .status_grise {
        border-radius: 1rem;
        background-color: #637381;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .status_reprogrammer {
        border-radius: 1rem;
        background-color: #00CDAC;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .status_cloturer {
        border-radius: 1rem;
        background-color: #314755;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .status_reporter {
        border-radius: 1rem;
        background-color: #26a0da;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .status_annulee {
        border-radius: 1rem;
        background-color: #b31217;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .status_termine {
        border-radius: 1rem;
        background-color: #2ebf91;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .status_confirme {
        border-radius: 1rem;
        background-color: #2B32B2;
        color: white;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .statut_active {
        border-radius: 1rem;
        background-color: rgb(15, 126, 145);
        color: whitesmoke;
        /* width: 60%; */
        align-items: center margin: 0 auto;
        padding: .1rem .5rem;
    }

    .modalite {
        border-radius: 1rem;
        background-color: #26a0da;
        color: rgb(255, 255, 255);
        /* width: 60%; */
        align-items: center margin: 0 auto;

        padding: 0.1rem 0.5rem !important;
    }


    .dernier_planning {
        text-align: left;
        padding-left: 6px;
        height: 100%;
        font-size: 12px;
        background-color: rgba(230, 228, 228, 0.39);
    }

    .dernier_planning:focus {
        color: rgb(130, 33, 100);
        background-color: white;
        font-weight: bold;
    }



    button {
        background-color: white;
        border: none;
        margin: 0;
        padding: 0;
    }

    .titre_card {
        background-color: rgb(223, 219, 219);
        height: 30px;
        border-radius: 4px 4px 0 0;
        margin: 2px 0;
        color: white;
    }

    .card {
        position: absolute;
    }

    /* Style the tab content */
    .tabcontent {
        display: none;
    }

    .btn_modifier_statut {
        /* background-color: white; */
        /* border: 1px; */
        border-radius: 30px;
        /* border-color: #7635dc; */
        padding: 1rem 1rem;
        color: black;
        /* box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px; */
    }

    .btn_modifier_statut a {
        font-size: .8rem;
        position: relative;
        bottom: .2rem;
    }

    .btn_modifier_statut:hover {
        background-color: white;
        color: black;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    }

    .planning {
        text-align: left;
        padding-left: 6px;
        height: 100%;
        font-size: 12px;
        margin:0;
    }

    .planning:hover {
        background-color: #eeeeee;
    }

    .planning p{
        font-size: .8rem;
    }

    @keyframes action{
        0%{
            filter: brightness(0.99);
        }
        25%{
            filter: brightness(0.94);
        }
        50%{
            filter: brightness(0.96);
        }
        75%{
            filter: brightness(0.98);
        }
        100%{
            filter: brightness(1);
        }
    }


    .action_animation{
        animation-name: action;
        animation-duration: 3s;
        animation-delay: 1s;
        animation-iteration-count: infinite;
    }

    /* .btn_modifier_statut:focus{
    color: blue;
    text-decoration: none;
} */

    .icon_creer {
        background-image: linear-gradient(60deg, #f206ee, #0765f3);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        font-size: 1.5rem;
        position: relative;
        top: .4rem;
        margin-right: .3rem;
    }

    .liste_projet{
        background-color: #637381;
        margin: 0;
        padding: 1;
        color: #ffffff;
    }

    .liste_projet:hover{
        background-color: #cfccccc5;
        color: #191818;
    }

    .pdf_download{
            background-color: #e73827 !important;
            border-radius: 5px;
    }
    .pdf_download:hover{
        background-color: #af3906 !important;
    }
    .pdf_download button{
        color: #ffffff !important;
    }

    .type_formation{
        border-radius: 1rem;
        background-color: #826bf3;
        color: rgb(255, 255, 255);
        /* width: 60%; */
        align-items: center margin: 0 auto;

        padding: 0.1rem 0.5rem !important;
    }
    .type_intra{
        padding: 0.1rem 0.5rem !important;
        font-size: 0.85rem;
        background-color: #2193b0;
        border-radius: 1rem;
        transition: all 200ms;
        color: white;
        border: none;
        box-shadow: none;
        outline: none;
        position: relative;
        align-items: center margin: 0 auto;
    }

    .type_intra:hover,
    .type_inter:hover{
        cursor: default;
        color: white;
    }

    .type_inter{
        padding: 0.1rem 0.5rem !important;
        font-size: 0.85rem;
        background-color: #2ebf91;
        border-radius: 1rem;
        transition: all 200ms;
        color: rgb(255, 255, 255);
        border: none;
        box-shadow: none;
        outline: none;
        position: relative;
        align-items: center margin: 0 auto;
    }

</style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
        integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <div class="p-3 bg-body rounded ">
        <nav class="body_nav m-0">
            <div class="row">
                <div class="col-lg-8">
                    <div class="d-flex m-0 p-0 height_default">
                        <a href="{{ route('liste_projet') }}" class="retour_projet mt-4"><i class='bx bxs-chevron-left p-0' style="font-size: 2rem;"></i></a>
                        <i class='bx bxs-book-open me-2 ms-3' style="font-size: 2rem;color :#26a0da"></i>
                        <span class="@if ($type_formation_id == 1) {{ 'type_intra' }} @elseif($type_formation_id == 2) {{ 'type_inter' }} @endif m-2 p-1 ps-2 pe-2">{{ $projet[0]->type_formation }}</span>
                        <span class="modalite m-2 p-1 ps-2 pe-2"><i class='bx bxs-group mt-1 me-1' ></i>{{ $modalite }}</span>
                        <div class="{{ $projet[0]->class_status_groupe }} m-2 mb-2 me-3">{{ $projet[0]->item_status_groupe }}</div>
                        {{-- <span class="mb-2 pt-2 me-3" style="font-weight: bold;">{{ $projet[0]->slogan }}</span> --}}
                        <span class="mb-2 pt-2" style="font-weight: bold;">{{ $module_session->reference . ' - ' . $module_session->nom_module }}</span>
                    </div>
                    <div class="d-flex m-0 p-0 height_default">
                        <span class="text-dark ms-5" style="font-weight: bold;"> {{ $projet[0]->nom_groupe }} </span>
                        <i class='bx bx-time-five ms-3 me-1' style="font-size: 1rem;"></i>
                        <p class="m-0"> Du @php setlocale(LC_TIME, "fr_FR"); echo strftime('%A %e %B %Y', strtotime($projet[0]->date_debut)).' au '.strftime('%A %e %B %Y', strtotime($projet[0]->date_fin)); @endphp</p>
                        {{-- @canany(['isCFP', 'isReferent'])
                            <p class="m-0">Chiffre d'affaire HT : &nbsp;</p>
                            <p class="text-dark mt-3"> <strong>@php
                                echo number_format($prix->montant_session, 2, '.', ' ');
                            @endphp Ar</strong> </p>
                        @endcanany --}}
                        <i class='bx bx-group ms-3' style="font-size: 1rem;"></i>
                        <span class="m-0 ms-1"> apprenant inscrit : </span>
                        <span class="text-dark ms-1"> {{ $nombre_stg }} </span>
                        <i class='bx bx-home ms-3' style="font-size: 1rem;"></i>
                        <span class="m-0 ms-1">{{ $lieu_formation[0] }}</span>
                        <i class='bx bx-door-open ms-3' style="font-size: 1rem;"></i>
                        <span class="m-0 ms-1">{{ $lieu_formation[1] }}</span>
                    </div>
                </div>
                <div class="col-lg-4 d-flex justify-content-end">
                    @canany(['isReferent','isCFP'])
                        <div class="dropdown">

                            <a class="dropdown-toggle btn_modifier_statut" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown"
                                aria-expanded="false" aria-haspopup="true" style="text-decoration: none">
                                <i class='bx bx-slider icon_creer'></i>Modifier statut

                            </a>
                            <ul class="dropdown-menu" aria-labelledby="ya">
                                <li class="mt-1">
                                    <a class="dropdown-item"
                                        href="{{ route('modifier_statut_session', [$projet[0]->groupe_id, 5]) }}">
                                        <i class='bx bx-check'></i>&nbsp;Cloturé
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('modifier_statut_session', [$projet[0]->groupe_id, 6]) }}">
                                        <i class='bx bxs-report'></i>&nbsp;Reporté
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('annuler_session', [$projet[0]->groupe_id]) }}">
                                        <i class='bx bx-x'></i>&nbsp;Annulée
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('modifier_statut_session', [$projet[0]->groupe_id, 8]) }}">
                                        <i class='bx bx-refresh'></i>&nbsp;Repprogrammer
                                    </a>
                                </li>
                            </ul>
                        </div>
                    @endcanany
                    <div>
                        <p><a href="{{ route('fiche_technique_pdf', [$projet[0]->groupe_id]) }}" class="pdf_download py-2" ><button class="btn"><i class='bx bxs-file-pdf'></i>&nbsp;&nbsp;&nbsp;PDF</button></a></p>
                    </div>
                    {{-- <div>
                        <p class="text-end"><a href="{{ route('liste_projet') }}" ><button class="btn liste_projet ms-1"> <span>Retour sur les projets</span></button></a></p>
                    </div> --}}
                </div>
            </div>
        </nav>
        <section class="bg-light py-1">
            <div class="m-0 p-0">
                <div class="d-flex justify-content-between">
                    @if ($type_formation_id == 1)
                        <div class="chiffre_d_affaire">

                            <div class="d-flex flex-row">
                                <p class="p-0 mt-3 text-center">Référent de l'entreprise {{ $projet[0]->nom_etp }} </p>
                                &nbsp;&nbsp;
                                <img src="{{ asset('images/entreprises/' . $projet[0]->logo) }}" alt=""
                                    class="mt-2" height="30px" width="30px" style="border-radius: 50%;">&nbsp;
                            </div>
                        </div>
                    @endif
                    <div class="chiffre_d_affaire">

                        <div class="d-flex flex-row">
                            <p class="p-0 mt-3 text-center"> Responsable de l'organisme de formation
                                {{ $projet[0]->nom_cfp }}</p>&nbsp;&nbsp;
                            <img src="{{ asset('images/CFP/' . $projet[0]->logo_cfp) }}" alt="" class="mt-2"
                                height="30px" width="30px" style="border-radius: 50%;">&nbsp;
                        </div>
                    </div>
                    @canany(['isCFP'])
                        <div class="chiffre_d_affaire">
                            <div class="d-flex flex-row">
                                <p class="p-0 mt-3 me-2 text-center"> Formateur(s) :&nbsp;</p>
                                @foreach ($formateur_cfp as $form)
                                    <img src="{{ asset('images/formateurs/' . $form->photos) }}" alt=""
                                        class="img_superpose mt-2" height="30px" width="30px" style="border-radius: 50%;">
                                @endforeach()
                            </div>
                            </strong></p>
                        </div>
                    @endcanany

                </div>
            </div>
        </section>
        <section>
            <div class="row p-0 d-flex flex-row" role="tabpanel">
                <div class="col-md-2 nav_session">
                    <div class="corps_planning m-0 bg-light" id="myTab" data-id="refresh" role="tablist">
                        <div class="nav-item active" role="presentation">
                            <a href="#detail" class="nav-link active p-0" id="detail-tab" data-toggle="tab" type="button"
                                role="tab" aria-controls="home" aria-selected="true">
                                <button class="planning d-flex justify-content-between active detail-tab
                                @can('isCFP')
                                    {{ 'action_animation' }}
                                @endcan"
                                    onclick="openCity(event, 'detail')" style="width: 100%">
                                    <p class="m-0 pt-2 pb-2">PLANNING</p>
                                    @if ($test == 0)
                                        <i class="fal fa-dot-circle me-2 mt-2" style="color: grey"></i>
                                    @endif
                                    @if ($test != 0)
                                        <i class="fa fa-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                    @endif
                                </button>
                            </a>
                        </div>
                        @canany(['isCFP', 'isReferent', 'isFormateur'])
                            <div class="nav-item" role="presentation">
                                <a href="#apprenant" class="nav-link p-0" id="apprenant-tab" data-toggle="tab" type="button"
                                    role="tab" aria-controls="home" aria-selected="true">
                                    <button class="planning d-flex justify-content-between apprenant-tab
                                    @if ($type_formation_id == 1)
                                        @can('isCFP')
                                            {{ 'action_animation' }}
                                        @endcan
                                    @endif
                                    @if ($type_formation_id == 2)
                                        @can('isReferent')
                                            {{ 'action_animation' }}
                                        @endcan
                                    @endif
                                     "
                                        onclick="openCity(event, 'apprenant')" style="width: 100%">
                                        <p class="m-0 pt-2 pb-2">APPRENANTS</p>
                                        @if (count($stagiaire) == 0)
                                            <i class="fal fa-dot-circle me-2 mt-2" style="color: grey"></i>
                                        @endif
                                        @if (count($stagiaire) != 0)
                                            <i class="fa fa-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                        @endif
                                    </button>
                                </a>
                            </div>
                        @endcanany

                        <div class="nav-item" role="presentation">
                            <a href="#ressource" class="nav-link p-0" id="ressource-tab" data-toggle="tab" type="button"
                                role="tab" aria-controls="home" aria-selected="true">
                                <button class="planning d-flex justify-content-between action_animation ressource-tab"
                                    onclick="openCity(event, 'ressource')" style="width: 100%">
                                    <p class="m-0 pt-2 pb-2">RESSOURCES</p>
                                    @if (count($ressource) == 0)
                                        <i class="fal fa-dot-circle me-2 mt-2" style="color: grey"></i>
                                    @else
                                        <i class="fa fa-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                    @endif
                                </button>
                            </a>
                        </div>

                        @can('isReferent')
                            <div class="nav-item" role="presentation">
                                <a href="#frais" class="nav-link p-0" id="frais-tab" data-toggle="tab" type="button"
                                    role="tab" aria-controls="home" aria-selected="true">
                                    <button class="planning d-flex justify-content-between action_animation frais-tab"
                                        onclick="openCity(event, 'frais')" style="width: 100%">
                                        <p class="m-0 pt-2 pb-2">FRAIS ANNEXES</p>
                                        @if (count($all_frais_annexe) <= 0)
                                            <i class="fal fa-dot-circle me-2 mt-2" style="color: grey"></i>
                                        @else
                                            <i class="fa fa-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                        @endif
                                    </button>
                            </div>
                        @endcan

                        <div class="nav-item" role="presentation">
                            <a href="#document" class="nav-link p-0" id="document-tab" data-toggle="tab" type="button"
                                role="tab" aria-controls="home" aria-selected="true">
                                <button class="planning d-flex justify-content-between document-tab
                                    @canany(['isCFP','isFormateur'])
                                        {{ 'action_animation' }}
                                    @endcan"
                                    onclick="openCity(event, 'document')" style="width: 100%">
                                    <p class="m-0 pt-2 pb-2">DOCUMENTS</p>
                                    {{-- <i class="fa fa-dot-circle me-2 mt-2" style="color: grey"></i> --}}
                                    {{-- <i class="fa fa-check-circle me-2 mt-2" style="color: chartreuse"></i> --}}
                                </button>
                            </a>
                        </div>
                        {{-- @if ($type_formation_id == 1) --}}
                        @canany(['isStagiaire'])
                            <div class="nav-item" role="presentation">
                                <a href="#chaud" class="nav-link p-0" id="chaud-tab" data-toggle="tab" type="button"
                                    role="tab" aria-controls="home" aria-selected="true">
                                    <button class="planning d-flex justify-content-between chaud-tab"
                                        onclick="openCity(event, 'chaud')" style="width: 100%">
                                        <p class="m-0 pt-2 pb-2">EVALUATION</p>
                                        <i class="fal fa-dot-circle me-2 mt-2" style="color: grey"></i>
                                    </button>
                                </a>
                            </div>
                        @endcanany
                        @can('isFormateur')
                            <div class="nav-item" role="presentation">
                                <a href="#emargement" class="nav-link p-0" id="emargement-tab" data-toggle="tab" type="button"
                                    role="tab" aria-controls="home" aria-selected="true">
                                    <button class="planning d-flex justify-content-between action_animation emargement-tab"
                                        onclick="openCity(event, 'emargement')" style="width: 100%">
                                        <p class="m-0 pt-2 pb-2">EMARGEMENT</p>
                                        @php
                                            $pres = $groupe->statut_presences($projet[0]->groupe_id);
                                            if ($pres == '#00ff00') {
                                                echo '<i class="fa fa-check-circle me-2 mt-2" style="color: chartreuse"></i>';
                                            }elseif ($pres == '#bdbebd') {
                                                echo '<i class="fal fa-dot-circle me-2 mt-2" style="color: grey"></i>';
                                            }
                                        @endphp
                                    </button>
                                </a>
                            </div>
                            <div class="nav-item" role="presentation">
                                <a href="#evaluation" class="nav-link p-0" id="evaluation-tab" data-toggle="tab" type="button"
                                    role="tab" aria-controls="home" aria-selected="true">
                                    <button class="planning d-flex justify-content-between  action_animation evaluation-tab"
                                        onclick="openCity(event, 'evaluation')" style="width: 100%">
                                        <p class="m-0 pt-2 pb-2">PRE EVALUATION</p>
                                        @if ($evaluation_avant <= 0)
                                            <i class="fal fa-dot-circle me-2 mt-2" style="color: grey"></i>
                                        @else
                                            <i class="fa fa-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                        @endif
                                    </button>
                                </a>
                            </div>
                            <div class="nav-item" role="presentation">
                                <a href="#evaluation_pre_formation" class="nav-link p-0" id="evaluation_pre_formation-tab"
                                    data-toggle="tab" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    <button class="planning d-flex justify-content-between action_animation evaluation_pre_formation-tab"
                                        onclick="openCity(event, 'evaluation_pre_formation')" style="width: 100%">
                                        <p class="m-0 pt-2 pb-2">EVALUATION</p>
                                        @if ($evaluation_apres <= 0)
                                            <i class="fal fa-dot-circle me-2 mt-2" style="color: grey"></i>
                                        @else
                                            <i class="fa fa-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                        @endif
                                    </button>
                                </a>
                            </div>
                        @endcan
                        @canany(['isCFP', 'isReferent'])
                            <div class="nav-item" role="presentation">
                                <a href="#evaluation_pre_formation" class="nav-link p-0" id="evaluation_pre_formation-tab"
                                    data-toggle="tab" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    <button class="planning d-flex justify-content-between evaluation_pre_formation-tab"
                                        onclick="openCity(event, 'evaluation_pre_formation')" style="width: 100%">
                                        <p class="m-0 pt-2 pb-2">EVALUATION</p>
                                        @if ($evaluation_apres <= 0)
                                            <i class="fal fa-dot-circle me-2 mt-2" style="color: grey"></i>
                                        @else
                                            <i class="fa fa-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                        @endif
                                    </button>
                                </a>
                            </div>
                        @endcanany
                    </div>
                </div>

                <div class="tab-content col-md-10">


                    <div class="tab-pane fade show active tabcontent" id="detail" role="tabpanel"
                        aria-labelledby="detail-tab" style="display: block">
                        @include('admin.detail.detail')
                    </div>
                    @canany(['isCFP', 'isReferent', 'isFormateur'])
                        <div class="tab-pane fade show tabcontent" id="apprenant" role="tabpanel"
                            aria-labelledby="apprenant-tab" style="display: none">
                            @include('admin.stagiaire.ajout_stagiaire')
                        </div>
                    @endcanany

                    <div id="ressource" class="tab-pane fade show tabcontent" id="ressource" role="tabpanel"
                        aria-labelledby="ressource-tab" style="display: none">
                        @include('projet_session.ressource')
                    </div>
                    <div id="frais" class="tab-pane fade show tabcontent" id="frais" role="tabpanel"
                        aria-labelledby="frais-tab" style="display: none">
                        @include('projet_session.frais_annexe')
                    </div>
                    <div id="document" class="tab-pane fade show tabcontent" role="tabpanel" aria-labelledby="document-tab"
                        style="display: none">
                        @include('projet_session.document')
                    </div>
                    @canany(['isStagiaire'])
                        <div id="chaud" class="tab-pane fade show tabcontent" role="tabpanel" aria-labelledby="document-tab"
                            style="display: none">
                            {{-- @include('projet_session.index_evaluation') --}}
                            @include('admin.evaluation.evaluationChaud.evaluationChaud')
                        </div>
                    @endcanany
                    <div id="emargement" class=" tab-pane fade show tabcontent" role="tabpanel"
                        aria-labelledby="emargement-tab" style="display: none">
                        @include('projet_session.emargement')
                    </div>
                    <div id="evaluation" class=" tab-pane fade show tabcontent" role="tabpanel"
                        aria-labelledby="evaluation-tab" style="display: none">
                        @include('projet_session.evaluation_stagiaires')
                    </div>
                    <div id="evaluation_pre_formation" class="tab-pane fade show tabcontent" role="tabpanel"
                        aria-labelledby="evaluation_pre_formation-tab" style="display: none">
                        {{-- @include('projet_session.evaluation_stagiaires_pre') --}}
                        @include('projet_session.evaluation_chaud')
                    </div>
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
                @if ($type_formation_id == 1)
                    <img src="{{ asset('images/entreprises/' . $projet[0]->logo) }}" class="img-fluid text-center"
                        style="width:120px;height:60px;" role="button" onclick="afficherInfos();">
                    <div>
                        <p class="p-0 m-0 text-center"> <strong>{{ $projet[0]->nom_etp }}</strong></p>
                        <p class="p-0 m-0 text-center"> <strong>{{ $projet[0]->telephone_etp }}</strong></p>
                        <p class="p-0 m-0 text-center"> <strong>{{ $projet[0]->email_etp }}</strong></p>
                        <p class="p-0 m-0 text-center"> <strong> Adresse:{{ $projet[0]->adresse_rue }}
                                {{ $projet[0]->adresse_quartier }} {{ $projet[0]->adresse_code_postal }}
                                {{ $projet[0]->adresse_ville }} {{ $projet[0]->adresse_region }}</strong></p>
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
            <div>

            </div>

        </div>
    </div>
    </div>

    {{-- keep nav in refresh --}}
    <script>
        $('.evaluation_pre_formation-tab').on('click',function(e){
            localStorage.setItem('activeTab', 'evaluation_pre_formation');
        });
        $('.evaluation-tab').on('click',function(e){
            localStorage.setItem('activeTab', 'evaluation');
        });
        $('.emargement-tab').on('click',function(e){
            localStorage.setItem('activeTab', 'emargement');
        });
        $('.chaud-tab').on('click',function(e){
            localStorage.setItem('activeTab', 'chaud');
        });
        $('.document-tab').on('click',function(e){
            localStorage.setItem('activeTab', 'document');
        });
        $('.frais-tab').on('click',function(e){
            localStorage.setItem('activeTab', 'frais');
        });
        $('.ressource-tab').on('click',function(e){
            localStorage.setItem('activeTab', 'ressource');
        });
        $('.apprenant-tab').on('click',function(e){
            localStorage.setItem('activeTab', 'apprenant');
        });
        $('.detail-tab').on('click',function(e){
            localStorage.setItem('activeTab', 'detail');
        });

        let activeTab = localStorage.getItem('activeTab');

        if(activeTab){
            $('.tabcontent').css('display','none');
            $('#' + activeTab).show();
            tablinks = document.getElementsByClassName("planning");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }
            $('.'+activeTab+'-tab').addClass("active");
        }
    </script>
    {{-- keep nav in refresh --}}

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
