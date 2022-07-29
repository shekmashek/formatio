@extends('./layouts/admin')
@inject('groupe', 'App\groupe')
@section('content')
    <style>
        .corps_planning .nav-link {
            color: #637381;
            padding: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: all 200ms;
            text-transform: uppercase;
            padding-top: 10px;
        }


        .nav-item .nav-link button.active {
            /* border-bottom: 3px solid #7635dc !important; */
            color: #7635dc;
            border-right: .2rem solid #7635dc;
        }

        /* .nav-item .nav-link.active {
                border-bottom: none !important;
            } */

        .nav-tabs .nav-link:hover {
            background-color: rgb(245, 243, 243);
            transform: scale(1.1);
            border: none;
        }

        .nav-tabs .nav-item a {
            text-decoration: none;
            text-decoration-line: none;
        }

        .shadow {
            height: auto;
        }

        * {
            font-size: 1rem;
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

        /* .card {
            position: absolute;
        } */

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
            margin: 0;
        }

        .planning:hover {
            background-color: #eeeeee;
        }

        .planning p {
            font-size: .85rem;
        }

        @keyframes action {
            0% {
                filter: brightness(0.99);
            }

            25% {
                filter: brightness(0.94);
            }

            50% {
                filter: brightness(0.96);
            }

            75% {
                filter: brightness(0.98);
            }

            100% {
                filter: brightness(1);
            }
        }


        .action_animation {
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

        .liste_projet {
            background-color: #637381;
            margin: 0;
            padding: 1;
            color: #ffffff;
        }

        .liste_projet:hover {
            background-color: #cfccccc5;
            color: #191818;
        }

        .pdf_download {
            background-color: #e73827 !important;
            border-radius: 5px;
        }

        .pdf_download:hover {
            background-color: #af3906 !important;
        }

        .pdf_download button {
            color: #ffffff !important;
        }

        .type_formation {
            border-radius: 1rem;
            background-color: #826bf3;
            color: rgb(255, 255, 255);
            /* width: 60%; */
            align-items: center margin: 0 auto;

            padding: 0.1rem 0.5rem !important;
        }

        .type_intra {
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
        .type_inter:hover {
            cursor: default;
            color: white;
        }

        .type_inter {
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
            align-items: center;
            margin: 0 auto;
        }

        /*info SESSION*/
        .green {
            color: #5e35b1;
            border: 2px solid #43a047;
            border-radius: 2px;
            font-size: 16px;
            font-weight: 700;
            padding: 4px;
        }

        .red {
            color: #5e35b1;
            border: 2px solid #f4511e;
            border-radius: 2px;
            font-size: 16px;
            font-weight: 700;
            padding: 4px;
        }

        .yellow {
            color: #5e35b1;
            border: 2px solid #fdd835;
            border-radius: 2px;
            font-size: 16px;
            font-weight: 700;
            padding: 4px;
        }

        .saClass {
            font-size: 22px;
            color: #637381;
        }

        .saSpan {
            color: #637381;
            font-size: 14px;
        }
    </style>
    <div class="p-3 bg-body rounded ">
        <nav class="body_nav m-0">
            <div class="row">
                <div class="col-md-9">
                    <div class="d-flex m-0 p-0 height_default">
                        <a href="{{ route('liste_projet') }}" class="retour_projet mt-4"><i
                                class='bx bxs-chevron-left p-0' style="font-size: 2rem;"></i></a>
                        <i class='bx bxs-book-open me-2 ms-3' style="font-size: 2rem;color :#26a0da"></i>
                        <span
                            class="@if ($type_formation_id == 1) {{ 'type_intra' }} @elseif($type_formation_id == 2) {{ 'type_inter' }} @endif m-2 p-1 ps-2 pe-2">{{ $projet[0]->type_formation }}</span>
                        <span class="modalite m-2 p-1 ps-2 pe-2"><i
                                class='bx bxs-group mt-1 me-1'></i>{{ $modalite }}</span>
                        <div class="{{ $projet[0]->class_status_groupe }} m-2 mb-2 me-3">
                            {{ $projet[0]->item_status_groupe }}</div>
                        {{-- <span class="mb-2 pt-2 me-3" style="font-weight: bold;">{{ $projet[0]->slogan }}</span> --}}
                        <span class="mb-2 pt-2"
                            style="font-weight: bold;">{{ $module_session->reference . ' - ' . $module_session->nom_module }}</span>
                    </div>
                    <div class="d-flex m-0 p-0 height_default">
                        <span class="text-dark ms-5" style="font-weight: bold;"> {{ $projet[0]->nom_groupe }} </span>
                        <i class='bx bx-time-five ms-3 me-1' style="font-size: 1rem;"></i>
                        <p class="m-0"> Du @php
                            setlocale(LC_TIME, 'fr_FR');
                            echo strftime('%A %e %B %Y', strtotime($projet[0]->date_debut)) . ' au ' . strftime('%A %e %B %Y', strtotime($projet[0]->date_fin));
                        @endphp</p>&nbsp;&nbsp;

                        {{-- @if (count($dataMontantSession) > 0)
                            @if ($dataMontantSession[0]->qte != null)
                                <span class="m-0 ms-1"> apprenant inscrit : {{$dataMontantSession[0]->qte}}</span> &nbsp;&nbsp;
                            @else
                                <span class="m-0 ms-1"> apprenant inscrit : -</span> &nbsp;&nbsp;
                            @endif
                        @else
                            <span class="m-0 ms-1"> apprenant inscrit : -</span> &nbsp;&nbsp;
                        @endif --}}


                        @if (count($lieu_formation) > 0)
                            <i class='bx bx-home ms-3' style="font-size: 1rem;"></i>
                            <span class="m-0 ms-1">{{ $lieu_formation[0] }}</span>
                            <i class='bx bx-door-open ms-3' style="font-size: 1rem;"></i>
                            <span class="m-0 ms-1">{{ $lieu_formation[1] }}</span>&nbsp;&nbsp;
                        @endif

                    </div>
                    <div class="d-flex m-0 p-0 ms-5 height_default">
                        <i class='bx bx-group' style="font-size: 1rem;"></i>
                        <span class="m-0 ms-1 me-3"> Apprenant inscrit : {{ count($stagiaire) }}</span>
                        @can('isCFP')
                            <p class="text-dark mt-3"> CA :<strong>
                                    <span>

                                        @php
                                            $resultat_montant = $groupe->dataFraisSession($projet[0]->groupe_id);
                                            echo number_format($resultat_montant,0,' ','.');
                                        @endphp
                                    </span>
                                    {{ $ref }}</strong> </p>&nbsp;&nbsp;
                            <p class="text-dark mt-3"> FA : <strong>
                                    <span>

                                        @php
                                            $frais = $groupe->frais_annexe_of($projet[0]->groupe_id);
                                            if ($frais == null) {
                                                echo '<span>-</span>';
                                            } else {
                                                number_format($frais, 0, ',', ' ');
                                            }
                                        @endphp&nbsp;
                                    </span>
                                    {{ $ref }}</strong></p>
                        @endcan
                        @canany(['isReferent', 'isReferentSimple', 'isManager', 'isChefDeService'])
                            <p class="text-dark mt-3"> CP : <strong>
                                @php
                                    $resultat_montant = $groupe->dataFraisSession($projet[0]->groupe_id);
                                    echo number_format($resultat_montant,0,' ','.');
                                @endphp
                            {{-- @php
                                $resultat_montant = $groupe->dataFraisSession($projet[0]->groupe_id);
                                echo number_format($resultat_montant,0,' ','.');
                            @endphp --}}
                                </strong> </p>&nbsp;&nbsp;
                            <p class="text-dark mt-3"> FA : <strong id="frais_annex_entreprise">
                                    @php
                                        $Totalfa = 0;
                                    @endphp
                                    <span>
                                        @if (count($all_frais_annexe) > 0)
                                            @foreach ($all_frais_annexe as $fraisAnnexe)
                                                @php $Totalfa += $fraisAnnexe->montant; @endphp
                                            @endforeach
                                            @php
                                                echo number_format($Totalfa, 0, ',', ' ');
                                            @endphp
                                        @else
                                            @php
                                                echo '-';
                                            @endphp
                                        @endif
                                    </span>
                                    &nbsp;{{ $ref }}</strong></p>
                        @endcanany
                    </div>
                    <div class="d-flex height_default m-0 mt-2 p-0">
                        @if ($type_formation_id == 1)
                            <div class="chiffre_d_affaire m-0 p-0 me-3">
                                <div class="d-flex flex-row">
                                    <p class="p-0 mt-3 text-center">Référent de l'entreprise {{ $projet[0]->nom_etp }}
                                    </p>
                                    &nbsp;&nbsp;
                                    <img src="{{ asset('images/entreprises/' . $projet[0]->logo) }}" alt=""
                                        class="mt-2" height="30px" width="30px" style="border-radius: 50%;">&nbsp;
                                </div>
                            </div>
                        @endif
                        <div class="chiffre_d_affaire me-2">

                            <div class="d-flex flex-row">
                                <p class="p-0 mt-3 text-center"> Responsable de l'organisme de formation
                                    {{ $projet[0]->nom_cfp }}</p>&nbsp;&nbsp;
                                <img src="{{ asset('images/CFP/' . $projet[0]->logo_cfp) }}" alt=""
                                    class="mt-2" height="30px" width="30px" style="border-radius: 50%;">&nbsp;
                            </div>
                        </div>
                        @canany(['isCFP'])
                            <div class="chiffre_d_affaire">
                                <div class="d-flex flex-row">
                                    @if (count($formateur_cfp) > 0)
                                        <p class="p-0 me-2 text-center" style="margin-top: 1.9rem !important"> Formateur(s)
                                            :&nbsp;</p>
                                    @endif
                                    @foreach ($formateur_cfp as $form)
                                        <img src="{{ asset('images/formateurs/' . $form->photos) }}" alt=""
                                            class="img_superpose mt-2" height="30px" width="30px"
                                            style="border-radius: 50%;margin-top: 1.6rem !important">
                                    @endforeach()
                                </div>
                                </strong></p>
                            </div>
                        @endcanany
                    </div>
                </div>
                <div class="col-md-3 d-flex justify-content-end">
                    @canany(['isReferent', 'isCFP'])
                        <div class="dropdown">

                            <a class="dropdown-toggle btn_modifier_statut" href="#" role="button" id="dropdownMenuLink"
                                data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"
                                style="text-decoration: none">
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
                        <p><a href="{{ route('fiche_technique_pdf', [$projet[0]->groupe_id]) }}"
                                class="pdf_download py-2"><button class="btn"><i
                                        class='bx bxs-file-pdf'></i>&nbsp;&nbsp;&nbsp;PDF</button></a></p>
                    </div>
                    {{-- <div>
                        <p class="text-end"><a href="{{ route('liste_projet') }}" ><button class="btn liste_projet ms-1"> <span>Retour sur les projets</span></button></a></p>
                    </div> --}}
                </div>

            </div>
        </nav>
    </div>

    {{-- </div> --}}

    {{-- <section class="bg-light py-1">
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
                                @if (count($formateur_cfp) > 0)
                                    <p class="p-0 mt-3 me-2 text-center"> Formateur(s) :&nbsp;</p>
                                @endif
                                @foreach ($formateur_cfp as $form)
                                    <img src="{{ asset('images/formateurs/' . $form->photos) }}" alt=""
                                        class="img_superpose mt-2" height="30px" width="30px" style="border-radius: 50%;">
                                @endforeach()
                            </div>
                            </strong></p>
                        </div>
                    @endcanany

                </div>
            </div><i class='bx bx-check-circle'></i>
        </section> --}}
    <section>
        <div class="row p-0 d-flex flex-row" role="tabpanel">
            <div class="col-md-2 nav_session">
                <div class="corps_planning m-0 bg-light" id="myTab" data-id="refresh" role="tablist">
                    <div class="nav-item active" role="presentation">
                        <a href="#detail" class="nav-link active p-0" id="detail-tab" data-toggle="tab" type="button"
                            role="tab" aria-controls="home" aria-selected="true">
                            <button
                                class="planning d-flex justify-content-between active detail-tab
                                @can('isCFP') {{ 'action_animation' }} @endcan"
                                onclick="openCity(event, 'detail')" style="width: 100%">
                                <p class="m-0 pt-2 pb-2">PLANNING</p>
                                @if ($test == 0)
                                    <i class="bx bx-check-circle me-2 mt-2" style="color: grey"></i>
                                @endif
                                @if ($test != 0)
                                    <i class="bx bxs-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                @endif
                            </button>
                        </a>
                    </div>
                    {{-- @canany(['isCFP', 'isReferent', 'isFormateur', 'isReferentSimple', 'isManager'])
                        <div class="nav-item" role="presentation">
                            <a href="#apprenant" class="nav-link p-0" id="apprenant-tab" data-toggle="tab" type="button"
                                role="tab" aria-controls="home" aria-selected="true">
                                <button
                                    class="planning d-flex justify-content-between apprenant-tab
                                    @if ($type_formation_id == 1) @can('isCFP')
                                            {{ 'action_animation' }}
                                        @endcan @endif
                                    @if ($type_formation_id == 2) @canany(['isReferent', 'isReferentSimple', 'isManager'])
                                            {{ 'action_animation' }}
                                        @endcanany @endif
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
                        </div> --}}
                        @canany(['isCFP', 'isReferent', 'isFormateur', 'isFormateurInterne', 'isReferentSimple', 'isManager',
                            'isChefDeService'])
                            <div class="nav-item" role="presentation">
                                <a href="#apprenant" class="nav-link p-0" id="apprenant-tab" data-toggle="tab" type="button"
                                    role="tab" aria-controls="home" aria-selected="true">
                                    <button
                                        class="planning d-flex justify-content-between apprenant-tab
                                    @if ($type_formation_id == 1)
                                        @can('isCFP')
                                            {{ ' action_animation' }}
                                        @endcan
                                    @endif
                                    @if ($type_formation_id == 2)
                                        @canany(['isReferent', 'isReferentSimple', 'isManager', 'isChefDeService'])
                                            {{ ' action_animation' }}
                                        @endcanany
                                    @endif"
                                        onclick="openCity(event, 'apprenant')" style="width: 100%">
                                        <p class="m-0 pt-2 pb-2">APPRENANTS</p>
                                        @if (count($stagiaire) == 0)
                                            <i class="bx bx-check-circle me-2 mt-2" style="color: grey"></i>
                                        @endif
                                        @if (count($stagiaire) != 0)
                                            <i class="bx bxs-check-circle me-2 mt-2" style="color: chartreuse"></i>
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
                                        <i class="bx bx-check-circle me-2 mt-2" style="color: grey"></i>
                                    @else
                                        <i class="bx bxs-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                    @endif
                                </button>
                            </a>
                        </div>

                        @canany(['isReferent', 'isReferentSimple'])
                            <div class="nav-item" role="presentation">
                                <a href="#frais" class="nav-link p-0" id="frais-tab" data-toggle="tab" type="button"
                                    role="tab" aria-controls="home" aria-selected="true">
                                    <button class="planning d-flex justify-content-between action_animation frais-tab"
                                        onclick="openCity(event, 'frais')" style="width: 100%">
                                        <p class="m-0 pt-2 pb-2">FRAIS ANNEXES</p>
                                        @if (count($all_frais_annexe) <= 0)
                                            <i class="bx bx-check-circle me-2 mt-2" style="color: grey"></i>
                                        @else
                                            <i class="bx bxs-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                        @endif
                                    </button>
                            </div>
                        @endcanany

                        {{-- <div class="nav-item" role="presentation">
                            <a href="#document" class="nav-link p-0" id="document-tab" data-toggle="tab" type="button"
                                role="tab" aria-controls="home" aria-selected="true">
                                <button class="planning d-flex justify-content-between document-tab
                                    @canany(['isCFP', 'isFormateur', 'isFormateurInterne'])
                                        {{ 'action_animation' }}
                                    @endcan"
                                    onclick="openCity(event, 'document')" style="width: 100%">
                                    <p class="m-0 pt-2 pb-2">DOCUMENTS</p>
                                </button>
                            </a>
                        </div> --}}
                        {{-- @if ($type_formation_id == 1) --}}
                        @canany(['isStagiaire'])
                            <div class="nav-item" role="presentation">
                                <a href="#chaud" class="nav-link p-0" id="chaud-tab" data-toggle="tab" type="button"
                                    role="tab" aria-controls="home" aria-selected="true">
                                    <button class="planning d-flex justify-content-between chaud-tab"
                                        onclick="openCity(event, 'chaud')" style="width: 100%">
                                        <p class="m-0 pt-2 pb-2">EVALUATION</p>
                                        <i class="bx bx-check-circle me-2 mt-2" style="color: grey"></i>
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
                                                echo '<i class="bx bxs-check-circle me-2 mt-2" style="color: chartreuse"></i>';
                                            } elseif ($pres == '#bdbebd') {
                                                echo '<i class="bx bx-check-circle me-2 mt-2" style="color: grey"></i>';
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
                                            <i class="bx bx-check-circle me-2 mt-2" style="color: grey"></i>
                                        @else
                                            <i class="bx bxs-check-circle me-2 mt-2" style="color: chartreuse"></i>
                                        @endif
                                    </button>
                                </a>
                            </div>
                            <div class="nav-item" role="presentation">
                                <a href="#evaluation_pre_formation" class="nav-link p-0" id="evaluation_pre_formation-tab"
                                    data-toggle="tab" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    <button
                                        class="planning d-flex justify-content-between action_animation evaluation_pre_formation-tab"
                                        onclick="openCity(event, 'evaluation_pre_formation')" style="width: 100%">
                                        <p class="m-0 pt-2 pb-2">EVALUATION</p>
                                        @php
                                            $statut_eval = $groupe->statut_evaluation($projet[0]->groupe_id);
                                            if ($statut_eval == 0) {
                                                echo '<i class="bx bx-check-circle me-2 mt-2" style="color: grey"></i>';
                                            } elseif ($statut_eval == 1) {
                                                echo '<i class="bx bxs-check-circle me-2 mt-2" style="color: chartreuse"></i>';
                                            }
                                        @endphp
                                    </button>
                                </a>
                            </div>
                        @endcan
                        @canany(['isCFP', 'isReferent', 'isReferentSimple', 'isManager', 'isChefDeService'])
                            <div class="nav-item" role="presentation">
                                <a href="#evaluation_pre_formation" class="nav-link p-0" id="evaluation_pre_formation-tab"
                                    data-toggle="tab" type="button" role="tab" aria-controls="home" aria-selected="true">
                                    <button class="planning d-flex justify-content-between evaluation_pre_formation-tab"
                                        onclick="openCity(event, 'evaluation_pre_formation')" style="width: 100%">
                                        <p class="m-0 pt-2 pb-2">EVALUATION</p>
                                        @php
                                            $statut_eval = $groupe->statut_evaluation($projet[0]->groupe_id);
                                            if ($statut_eval == 0) {
                                                echo '<i class="bx bx-check-circle me-2 mt-2" style="color: grey"></i>';
                                            } elseif ($statut_eval == 1) {
                                                echo '<i class="bx bxs-check-circle me-2 mt-2" style="color: chartreuse"></i>';
                                            }
                                        @endphp
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
                    @canany(['isCFP', 'isReferent', 'isReferentSimple', 'isFormateur', 'isManager',
                        'isChefDeService'])
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
                    {{-- <div id="document" class="tab-pane fade show tabcontent" role="tabpanel" aria-labelledby="document-tab"
                style="display: none">
                @include('projet_session.document')
            </div> --}}
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
            </div>

            <script>
                $('.evaluation_pre_formation-tab').on('click', function(e) {
                    localStorage.setItem('activeTab', 'evaluation_pre_formation');
                });
                $('.evaluation-tab').on('click', function(e) {
                    localStorage.setItem('activeTab', 'evaluation');
                });
                $('.emargement-tab').on('click', function(e) {
                    localStorage.setItem('activeTab', 'emargement');
                });
                $('.chaud-tab').on('click', function(e) {
                    localStorage.setItem('activeTab', 'chaud');
                });
                $('.document-tab').on('click', function(e) {
                    localStorage.setItem('activeTab', 'document');
                });
                $('.frais-tab').on('click', function(e) {
                    localStorage.setItem('activeTab', 'frais');
                });
                $('.ressource-tab').on('click', function(e) {
                    localStorage.setItem('activeTab', 'ressource');
                });
                $('.apprenant-tab').on('click', function(e) {
                    localStorage.setItem('activeTab', 'apprenant');
                });
                $('.detail-tab').on('click', function(e) {
                    localStorage.setItem('activeTab', 'detail');
                });

                let activeTab = localStorage.getItem('activeTab');

                if (activeTab) {
                    $('.tabcontent').css('display', 'none');
                    $('#' + activeTab).show();
                    tablinks = document.getElementsByClassName("planning");
                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                    }
                    $('.' + activeTab + '-tab').addClass("active");
                }
                $('.' + activeTab + '-tab').addClass("active");
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

            {{-- info session --}}
            {{-- etp --}}
            <script>
                $('.showSessionEtp').on('click', function() {
                    var etpId = $(this).data("id");
                    // console.log(etpId);
                    $.ajax({
                        type: "get",
                        url: "/info/session/etp",
                        data: {
                            Id: etpId
                        },
                        dataType: "html",
                        success: function(response) {
                            let userData = JSON.parse(response);
                            console.log(userData);
                            for (let i = 0; i < userData.length; i++) {
                                let logo =
                                    '<img src="{{ asset('images/entreprises/:url_img') }}" style="width:120px;height:120px;border-radius:100%">';
                                logo = logo.replace(":url_img", userData[i].logo);
                                $("#lEtp").html(" ");
                                $("#lEtp").append(logo);
                                $("#status").text(userData[i].nom_statut);
                                $("#nEtp").text(userData[i].nom_etp);
                                $("#juridic").text(': ' + userData[i].nom_type);
                                $("#nif").text(': ' + userData[i].nif);
                                $("#stat").text(': ' + userData[i].stat);
                                $("#tel").text(': ' + userData[i].telephone_etp);
                                $("#mail").text(': ' + userData[i].email_etp);
                                $("#adrlot").text(': ' + userData[i].adresse_lot);
                                $("#adrlot2").text(userData[i].adresse_quartier);

                                $("#adrlot3").text(userData[i].adresse_ville);
                                $("#adrlot4").text(userData[i].adresse_region);
                                $("#site").text(': ' + userData[i].site_etp);


                                var status = $('#status');
                                // console.log(status);

                                if (status.text() == "Premium") {
                                    status.addClass('green');
                                } else if (status.text() == "Invité") {
                                    status.addClass('red');
                                } else if (status.text() == "Pending") {
                                    status.addClass('yellow');
                                } else {
                                    console.log('ereur');
                                }

                            }
                        }
                    });

                });
            </script>
        @endsection
