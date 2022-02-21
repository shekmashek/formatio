<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- profil formateur --}}
    <link rel="stylesheet" href="{{asset('css/facture.css')}}">
    <script src="{{asset('js/facture.js')}}"></script>

    <link rel="stylesheet" href="{{asset('css/profil_formateur.css')}}">

    <link rel="shortcut icon" href="{{  asset('maquette/real_logo.ico') }}" type="image/x-icon">
    <title> formation.mg </title>
    {{-- catalogue --}}
    <!-- Bootstrap Core CSS -->
    <link href="{{asset('bootstrapCss/css/bootstrap.min.css')}} " rel="stylesheet">

    {{-- Boxicon --}}
    <link href="{{asset('assets/css/boxicons.min.css')}} " rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('assets/css/chart_et_font.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- full calendar -->
    <link href="{{asset('assets/fullcalendar/lib/main.css')}}" rel='stylesheet' />

    {{-- Js --}}
    {{-- <link rel="stylsheet" href="https://code.jquery.com/jquery-3.4.1.min.js"> --}}

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="{{asset('../assets/css/smooth_page.css')}}">

    {{-- link fontawesome_all --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


</head>

<body id="body-pd">
    <button type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
        <i class="far fa-arrow-up"></i>
    </button>
    <div class="l-navbar" id="nav-bar">
        <div class="container-fluid ">
            <nav class="nav">
                <div class="d-flex align-items-center justify-content-space-between ms-3 img"><a href="{{ route('home') }}" class="d-flex align-items-center"><img src="{{asset('img/images/logo_fmg54Ko.png')}}" id="img" class="img-fluid logo" alt="logo">&nbsp;<span class="d-flex textS">Tableau de bord</span></a></div>
                <div class="nav_list">
                    <ul class="lisst-unstyled p-0">
                        {{-- categorie de formation --}}
                        <li class="">
                            <a href="#categSubmenu" data-toggle="collapse" aria-expanded="false" class="nav_linke active dropdown-toggle liste"><i class='bx bx-home-smile nav_icon'></i><span class="nav_name">Catalogue</span></a>@canany(['isCFP','isFormateur'])&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouveau_module')}}"><i class='bx bxs-plus-circle nouveau_icon' title="nouveau formation"></i></a>@endcanany
                            <ul class="collapse lisst-unstyled submenuColor" id="categSubmenu">
                                <li class="my-2 sousMenu">
                                    <a href="{{route('liste_formation')}}">Formations</a>
                                </li>
                                @canany(['isCFP','isSuperAdmin','isAdmin','isFormateur'])
                                <li class="my-2 sousMenu">
                                    <a href="{{route('liste_module')}}">Modules</a>
                                </li>
                                <li class="my-2 sousMenu">
                                    <a href="{{route('nouveau_module')}}">Nouvelle Module</a>
                                </li>

                                <li class="my-2 sousMenu">
                                    <a href="{{route('liste_programme')}}">Programmes</a>
                                </li>

                                <li class="my-2 sousMenu">
                                    <a href="{{route('nouvelle_programme')}}">Nouveau programme</a>
                                </li>
                                @endcanany

                            </ul>
                        </li>
                        {{-- entreprise --}}
                        @canany(['isSuperAdmin','isAdmin'])
                        <li class="my-2">
                            <a href="#etpSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-building-house nav_icon'></i><span class="nav_name">Entreprises</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouvelle_entreprise')}}"><i class='bx bxs-plus-circle nouveau_icon' title="nouveau entreprise"></i></a>
                            <ul class="collapse lisst-unstyled submenuColor" id="etpSubMenu">
                                <li class="my-1 sousMenu">
                                    <a href="{{route('liste_entreprise')}}">Entreprises</a>
                                </li>
                                <li class="my-1 sousMenu">
                                    <a href="{{route('departement.index')}}">Département</a>
                                </li>

                            </ul>
                        </li>
                        @endcanany
                        {{-- entreprise --}}
                        @canany(['isReferent'])
                        <li class="my-2">
                            <a href="{{route('liste+responsable+entreprise')}}" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-building-house nav_icon'></i><span class="nav_name">Responsables</span></a>&nbsp;&nbsp;

                    </li>
                    @endcanany
                    @can('isCFP')
                    <li class="my-2">
                        {{-- <a href="{{route('liste_entreprise')}}" class="nav_linke liste"><i class='bx bx-building-house nav_icon'></i><span class="nav_name">Entreprises</span></a> --}}
                        <a href="#etpSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-building-house nav_icon'></i><span class="nav_name">Entreprise</span></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="etpSubMenu">
                            <li class="sousMenu me-2 d-flex justify-content-between">
                                <a href="{{route('liste_entreprise')}}">Entreprises</a>
                                <p class="my-1" id="entreprise" style="background-color: white; border-radius: 2rem; padding: 0 8px;"></p>
                            </li>
                        </ul>
                    </li>
                    @endcan
                    {{-- @canany(['isReferent','isCFP']) --}}
                    @if (Gate::allows('isReferent'))
                    <li class="my-2">
                        <a href="#etpSubMenu_resp_cfp" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-building-house nav_icon'></i><span class="nav_name">Centre</span></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="etpSubMenu_resp_cfp">
                            @can('isReferent')
                            <li class="sousMenu me-2 d-flex justify-content-between">
                                <a href="{{route('list_cfp')}}">Centre</a>
                            </li>
                            @endcan
                            @can('isCFP')
                            <li class="sousMenu me-2 d-flex justify-content-between">
                                <a href="{{route('liste+responsable+cfp')}}">Notre Responsable</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endif

                    {{-- @endcanany --}}

                    {{-- projet de formation --}}
                    @canany(['isSuperAdmin'])
                    <li class="my-2">
                        <a href="#prjfSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bxl-product-hunt nav_icon'></i><span class="nav_name">Projets</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouveau_projet')}}"><i class='bx bxs-plus-circle nouveau_icon' title="nouveau projet"></i></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="prjfSubMenu">
                            <span class="sousMenu me-2 d-flex justify-content-between">
                                <a href="{{route('liste_projet')}}">Projets</a>
                    </li>
                    <li class="my-1 sousMenu">
                        <a href="{{route('liste_groupe')}}">Groupes</a>
                    </li>
                    </ul>
                    </li>
                    @endcanany
                    @canany(['isCFP','isFormateur'])
                    <li class="my-2">
                        <a href="#prjfSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bxl-product-hunt nav_icon'></i><span class="nav_name">Projets</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouveau_projet')}}"><i class='bx bxs-plus-circle nouveau_icon' title="nouveau projet"></i></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="prjfSubMenu">
                            <span class="sousMenu me-2 d-flex justify-content-between">
                                <a href="{{route('liste_projet')}}">Projets</a>
                                <p class="my-1" id="projets" style="background-color: white; border-radius: 2rem; padding: 0 8px;"></p>
                            </span>
                            <li class="sousMenu me-2 d-flex justify-content-between">
                                <a href="{{url('detail_session')}}">Sessions</a>
                                <p class="my-1" id="projets_etp" style="background-color: white; border-radius: 2rem; padding: 0 8px;"></p>
                            </li>
                            <span class="sousMenu me-2 d-flex justify-content-between">
                                <a>Projets en cours</a>
                                <p class="my-1" id="projet_en_cours" style="background-color: white; border-radius: 2rem; padding: 0 8px;"></p>
                            </span>
                            <span class="sousMenu me-2 d-flex justify-content-between">
                                <a>Projets termine</a>
                                <p class="my-1" id="projet_terminer" style="background-color: white; border-radius: 2rem; padding: 0 8px;"></p>
                            </span>
                            <span class="sousMenu me-2 d-flex justify-content-between">
                                <a>Projets a venir</a>
                                <p class="my-1" id="projet_a_venir" style="background-color: white; border-radius: 2rem; padding: 0 8px;"></p>
                            </span>
                            {{-- <li class="my-1 sousMenu">
                                <a href="{{route('liste_groupe')}}">Groupes</a>
                    </li> --}}
                    </ul>
                    </li>
                    @endcanany
                    @canany(['isReferent'])
                    <li class="my-2">
                        <a href="#prjfSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bxl-product-hunt nav_icon'></i><span class="nav_name">Projets</span></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="prjfSubMenu">
                            <li class="sousMenu me-2 d-flex justify-content-between">
                                <a href="{{route('liste_projet')}}">Projets</a>
                                <p class="my-1" id="projets_etp" style="background-color: white; border-radius: 2rem; padding: 0 8px;"></p>
                            </li>

                            <span class="sousMenu me-2 d-flex justify-content-between">
                                <a>Projets en cours</a>
                                <p class="my-1" id="projet_en_cours_etp" style="background-color: white; border-radius: 2rem; padding: 0 8px;"></p>
                            </span>
                            <span class="sousMenu me-2 d-flex justify-content-between">
                                <a>Projets termine</a>
                                <p class="my-1" id="projet_terminer_etp" style="background-color: white; border-radius: 2rem; padding: 0 8px;"></p>
                            </span>
                            <span class="sousMenu me-2 d-flex justify-content-between">
                                <a>Projets a venir</a>
                                <p class="my-1" id="projet_a_venir_etp" style="background-color: white; border-radius: 2rem; padding: 0 8px;"></p>
                            </span>
                        </ul>
                    </li>
                    @endcanany
                    {{-- utilisateurs --}}
                    @canany(['isSuperAdmin','isAdmin'])
                    <li class="my-2">
                        <a href="#gsutSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bxs-user-account nav_icon'></i><span class="nav_name">Utilisateurs</span></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="gsutSubMenu">
                            <li class="my-1 sousMenu">
                                <a href="{{route('liste_utilisateur')}}">Responsables</a>
                            </li>
                            <li class="my-1 sousMenu">
                                <a href="{{route('utilisateur_stagiaire')}}">Stagiaires</a>
                            </li>
                            <li class="my-1 sousMenu">
                                <a href="{{route('utilisateur_formateur')}}">Formateurs</a>
                            </li>
                        </ul>
                    </li>
                    @endcanany

                    {{-- formateurs --}}
                    @canany(['isSuperAdmin','isAdmin'])
                    <li class="my-2">
                        <a href="#frmtSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class="bx bx-user nav_icon"></i><span class="nav_name">Formateurs</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouveau_formateur')}}"><i class='bx bxs-user-plus nouveau_icon' title="nouveau formateur"></i></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="frmtSubMenu">
                            <li class="my-1 sousMenu">
                                <a href="{{route('liste_formateur')}}">Formateurs</a>
                            </li>
                        </ul>
                    </li>
                    @endcanany
                    @canany(['isCFP'])
                    <li class="my-2">
                        <a href="#frmtSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class="bx bx-user nav_icon"></i><span class="nav_name">Formateurs</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouveau_formateur')}}"><i class='bx bxs-user-plus nouveau_icon' title="nouveau formateur"></i></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="frmtSubMenu">
                            <span class="sousMenu me-2 d-flex justify-content-between">
                                <a href="{{route('liste_formateur')}}">Formateur</a>
                                <p class="my-1" id="formateur" style="background-color: white; border-radius: 2rem; padding: 0 8px;"></p>
                            </span>
                        </ul>
                    </li>
                    @endcanany

                    {{-- manager --}}
                    @canany(['isSuperAdmin','isAdmin'])
                    <li class="my-2" style="width: 100%;">
                        <a href="#mngrSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-male nav_icon'></i><span class="nav_name">Manager</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouveau_manager')}}"><i class='bx bxs-user-plus nouveau_icon' title="nouveau chef departement"></i></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="mngrSubMenu">
                            <li class="my-1 sousMenu">
                                <a href="{{route('liste_chefDepartement')}}">Chefs Départements</a>
                            </li>
                        </ul>
                    </li>
                    @endcanany
                    @canany(['isReferent'])
                    <li class="my-2" style="width: 100%;">
                        <a href="#mngrSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-male nav_icon'></i><span class="nav_name">Manager</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouveau_manager')}}"><i class='bx bxs-user-plus nouveau_icon' title="nouveau chef departement"></i></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="mngrSubMenu">
                            <span class="sousMenu me-2 d-flex justify-content-between">
                                <a href="{{route('liste_chefDepartement')}}">Manager</a>
                                <p class="my-1" id="manager" style="background-color: white; border-radius: 2rem; padding: 0 8px;"></p>
                            </span>
                        </ul>
                    </li>
                    @endcanany

                    {{-- Referent --}}
                    @canany(['isAdmin','isSuperAdmin'])
                    <li class="my-2">
                        <a href="#refSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bxl-product-hunt nav_icon'></i><span class="nav_name">Réferents</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouveau_responsable')}}"><i class='bx bxs-user-plus nouveau_icon' title="nouveau responsable"></i></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="refSubMenu">
                            <li class="my-1 sousMenu">
                                <a href="{{route('liste_responsable')}}">Résponsables</a>
                            </li>
                        </ul>
                    </li>
                    @endcanany
                    {{-- stagiares --}}
                    @canany(['isSuperAdmin'])
                    <li class="my-2">
                        <a href="#stgrSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bxs-group nav_icon'></i><span class="nav_name">Participants</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouveau_participant')}}"><i class='bx bxs-user-plus nouveau_icon' title="nouveau stagiaire"></i></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="stgrSubMenu">
                            <li class="my-1 sousMenu">
                                <a href="{{route('liste_participant')}}">Stagiaires</a>
                            </li>
                        </ul>
                    </li>
                    @endcanany
                    @canany(['isReferent'])
                    <li class="my-2">
                        <a href="#stgrSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bxs-group nav_icon'></i><span class="nav_name">Participants</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouveau_participant')}}"><i class='bx bxs-user-plus nouveau_icon' title="nouveau stagiaire"></i></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="stgrSubMenu">
                            <span class="sousMenu me-2 d-flex justify-content-between">
                                <a href="{{route('liste_participant')}}">Stagiaires</a>
                                <p class="my-1" id="stagiaire" style="background-color: white; border-radius: 2rem; padding: 0 8px;"></p>
                            </span>
                        </ul>
                    </li>
                    @endcanany

                    {{-- action de formations
                    @canany(['isSuperAdmin','isCFP','isReferent','isFormateur','isStagiaire'])
                    <li class="my-2">
                        <a href="#actfSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-line-chart nav_icon'></i><span class="nav_name">Sessions</span></a>@canany(['isCFP','isReferent'])&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('execution')}}"><i class='bx bxs-plus-circle nouveau_icon' title="nouveau session"></i></a>@endcanany
                        <ul class="collapse lisst-unstyled submenuColor" id="actfSubMenu">
                            @canany(['isSuperAdmin','isCFP','isReferent'])
                            <li class="my-1 sousMenu">
                                <a href="{{route('liste_detail')}}">Listes</a>
                            </li>
                            @endcanany
                            @canany(['isStagiaire','isCFP','isReferent','isManager','isFormateur'])
                            <li class="my-1 sousMenu">
                                <a href="{{route('execution')}}">execution</a>
                            </li>
                            @endcanany
                            @canany(['isFormateur'])
                            <li class="my-1 sousMenu">
                                <a href="{{route('presence.index')}}">Feuille d'Emargement</a>
                            </li>
                            @endcanany
                        </ul>
                    </li>
                    @endcanany --}}
                    {{-- calendrire de formations --}}
                    <li class="my-2">
                        <a href="{{route('calendrier')}}" class="nav_linke liste"><i class='bx bxs-calendar nav_icon'></i><span class="nav_name">Calendrier</span></a>
                    </li>
                    {{-- commercial --}}
                    @canany(['isSuperAdmin','isCFP','isReferent'])
                    <li class="my-2">
                        <a href="{{route('collaboration')}}" class="nav_linke liste"><i class='bx bxs-message-dots nav_icon'></i><span class="nav_name">Collaboration</span></a>
                    </li>
                    @endcanany
                    {{-- financier --}}


                    {{-- route facture pour référent --}}
                    {{-- @canany(['isSuperAdmin','isAdmin'])
                    <li class="my-2">
                        <a href="{{route('liste_facture',3)}}" class="nav_linke liste"><i class='bx bxs-wallet-alt nav_icon'></i><span class="nav_name">Factures</span></a>
                    </li>
                    @endcanany --}}
                    {{-- @canany(['isCFP','isReferent'])
                    <li class="my-2">
                        <a href="#gstfSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-money nav_icon'></i><span class="nav_name">Facture</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('facture')}}"><i class='bx bxs-plus-circle nouveau_icon' title="nouveau projet"></i></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="gstfSubMenu">
                            {{-- <li class="my-1 sousMenu">
                                <a href="{{route('liste_facture',3)}}">Facturation</a>
                    </li> --}}
                    {{-- <span class="sousMenu me-2 d-flex justify-content-between my-0">
                        <a href="{{route('liste_facture',3)}}">Total facture</a>
                        {{-- <p class="my-1" style="background-color: white; border-radius: 2rem; padding: 0 8px;">7</p> --}}
                    {{-- </span> --}}
                    {{-- <span class="sousMenu me-2 d-flex justify-content-between my-0">
                        <a href="#">Facture en retard</a>
                        <p class="my-1" style="background-color: white; border-radius: 2rem; padding: 0 8px;">7</p>
                    </span>
                    <span class="sousMenu me-2 d-flex justify-content-between my-0">
                        <a href="#">Facture paye</a>
                        <p class="my-1" style="background-color: white; border-radius: 2rem; padding: 0 8px;">7</p>
                    </span>
                    <span class="sousMenu me-2 d-flex justify-content-between my-0">
                        <a href="#">Facture envoye</a>
                        <p class="my-1" style="background-color: white; border-radius: 2rem; padding: 0 8px;">7</p>
                    </span>
                    <span class="sousMenu me-2 d-flex justify-content-between my-0">
                        <a href="#">Facture non envoye</a>
                        <p class="my-1" style="background-color: white; border-radius: 2rem; padding: 0 8px;">347</p>
                    </span>
                    <span class="sousMenu me-2 d-flex justify-content-between my-0">
                        <a href="#">Brouillon</a>
                        <p class="my-1" style="background-color: white; border-radius: 2rem; padding: 0 8px;">7</p>
                    </span> --}}
                    {{-- <li class="my-1 sousMenu">
                                    <a href="{{route('liste_facture',3)}}">Facturation</a>
                    </li> --}}
                    {{-- <span class="sousMenu me-2 d-flex justify-content-between my-0">
                        <a href="{{route('liste_facture',3)}}">Total facture</a>
                    <p class="my-1" style="background-color: white; border-radius: 2rem; padding: 0 8px;">7</p>
                    </span>
                    <span class="sousMenu me-2 d-flex justify-content-between my-0">
                        <a href="#">Facture en retard</a>
                        <p class="my-1" style="background-color: white; border-radius: 2rem; padding: 0 8px;">7</p>
                    </span>
                    <span class="sousMenu me-2 d-flex justify-content-between my-0">
                        <a href="#">Facture paye</a>
                        <p class="my-1" style="background-color: white; border-radius: 2rem; padding: 0 8px;">7</p>
                    </span>
                    <span class="sousMenu me-2 d-flex justify-content-between my-0">
                        <a href="#">Facture envoye</a>
                        <p class="my-1" style="background-color: white; border-radius: 2rem; padding: 0 8px;">7</p>
                    </span>
                    <span class="sousMenu me-2 d-flex justify-content-between my-0">
                        <a href="#">Facture non envoye</a>
                        <p class="my-1" style="background-color: white; border-radius: 2rem; padding: 0 8px;">347</p>
                    </span>
                    <span class="sousMenu me-2 d-flex justify-content-between my-0">
                        <a href="#">Brouillon</a>
                        <p class="my-1" style="background-color: white; border-radius: 2rem; padding: 0 8px;">7</p>
                    </span> --}}

                    {{-- </ul>
                    </li>
                    @endcanany --}}

                    {{-- competence --}}
                    @canany(['isSuperAdmin','isReferent','isManager'])
                    <li class="my-2">
                        <a href="#gstcpSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-list-minus nav_icon'></i><span class="nav_name">Aptitude</span></a>@canany(['isReferent'])&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{ route('demande_test_niveau')}}"><i class='bx bxs-plus-circle nouveau_icon' title="Demande test de niveau"></i></a>@endcanany
                        <ul class="collapse lisst-unstyled submenuColor" id="gstcpSubMenu">
                            <li class="my-1 sousMenu">
                                <a href="{{ route('liste_projet') }}">Tableau de compétence</a>
                            </li>
                        </ul>
                    </li>
                    @endcanany

                    {{-- plan de formation --}}
                    @canany(['isSuperAdmin','isStagiaire','isManager','isReferent'])
                    <li class="my-2">
                        <a @canany(['isStagiaire']) href="{{route('planFormation.index')}}" @endcanany href="#pdfrmSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-list-plus nav_icon'></i><span class="nav_name">Plan</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{ route('planFormation.index') }}"><i class='bx bxs-plus-circle nouveau_icon' title="nouveau plan de formation"></i></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="pdfrmSubMenu">
                            {{-- @canany(['isStagiaire','isManager','isReferent'])
                                <li class="my-1 sousMenu">
                                    <a href="{{route('liste_demande_stagiaire')}}">Demandes</a>
                    </li>
                    @endcanany --}}
                    <li class="my-1 sousMenu">
                        <a href="{{ route('listePlanFormation') }}">Liste</a>
                    </li>

                    </ul>
                    </li>
                    @endcanany


                    {{-- abonemment --}}
                    @canany(['isSuperAdmin','isAdmin'])
                    <li class="my-2">
                        <a href="#abnmtSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bxl-sketch nav_icon'></i><span class="nav_name">Abonnement</span></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="abnmtSubMenu">
                            <li class="my-1 sousMenu">
                                <a href="{{route('abonnement.index')}}">Configuration</a>
                            </li>
                            <li class="my-1 sousMenu">
                                <a href="{{route('listeAbonne')}}">Abonnées</a>
                            </li>
                        </ul>
                    </li>
                    @endcanany
                    @can('isSuperAdmin')
                    <li class="my-2">
                        <a href="{{route('categorie')}}" class="nav_linke liste"><i class='bx bxl-sketch nav_icon'></i><span class="nav_name">Categorie Formation</span></a>
                    </li>
                    @endcan
                    <li class="my-2">
                        <a href="{{route('recherche_admin')}}" class="nav_linke liste"><i class='bx bxs-calendar nav_icon'></i><span class="nav_name">Reporting</span></a>
                    </li>
                    @can('isCFP')
                        <li class="my-2">
                            <a href="{{route('gestion_documentaire')}}" class="nav_linke liste"><i class='bx bxs-calendar nav_icon'></i><span class="nav_name">Document</span></a>
                        </li>
                    @endcan

                    </ul>
                </div>
                <div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class='bx bx-log-out-circle nav_icon_logout mx-4' title="Déconnexion"></i><span class="nav_name">Déconnexion</span></a>
                </div>
            </nav>
        </div>
    </div>
    <!--Container Main start-->
    <div class="container-fluid ps-0 height-100 bg-light" id="content" style="padding-top: 1rem">
        {{-- header --}}
        <header class="header row align-items-center g-0" id="header">
            <div class="col-5">
                <div class="header_toggle d-flex first_nav ">
                    <i class='bx bx-menu menu' id="header-toggle" style="color: #801D68;"></i>
                    <div>
                        @yield('title')
                    </div>
                </div>
            </div>

            <div class="col-7 header-right align-items-center d-flex flex-row">
                <div class="col mt-3 d-flex flex-row">
                    <div class="notification-box">
                        <span class="count-notif">6</span>
                        <div class="notification-bell">
                            <i class="bx bxs-bell bell_move" id="bell" style="color: #801D68;"></i>
                        </div>
                    </div>
                    <div class="notifications" id="box_notif">
                        <h2>Notifications - <span>6</span></h2>
                        <a href="{{route('listes_notifs')}}">
                            <div class="notifications-item">
                                <h4>Vonjy Nomenjanahary,&nbsp;il y a 1h</h4>
                                <p>Veut Collaborrer avec votre entreprise</p>
                            </div>
                        </a>
                    </div>

                    <div class="message-box">
                        <span class="count-message">
                            @isset($totale_invitation)
                            @if($totale_invitation>0)
                            {{$totale_invitation}}
                            @else
                            0
                            @endif
                            @endisset
                        </span>
                        <div class="notification-bell">
                            <i class='bx bxs-envelope ms-5 bell_move' id="envelope" style="color: #801D68;"></i>
                        </div>
                    </div>
                    <div class="messages" id="box_message">
                        <h2>Messages - <span>5</span></h2>
                        <a href="{{route('collaboration')}}">
                            <div class="notifications-item2">
                                {{-- <h4>Nicole Raharifetra,&nbsp;il y a 1h</h4> --}}
                                <h4>Collaboration <strong style="color:red">
                                        @isset($totale_invitation)
                                        @if($totale_invitation>0)
                                        ({{$totale_invitation}})
                                        @else
                                        0
                                        @endif
                                        @endisset
                                    </strong></h4>
                                <p>voir mes invitations,demandes</p>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- entreprise --}}
                <div class="col text-right d-flex flex-row" style="align-items: left; text-align:center">
                    <div class="header_etp_cfp mt-2 pt-1 d-flex flex-row" style="">
                        <p class="ms-2"><i class='bx bx-building-house' style="color: #801D68; font-size: 24px"></i></p>
                        <p style="text-transform: capitalize; text-align: center;color: #801D68">&nbsp;Numerika</p>&nbsp;&nbsp;&nbsp;
                        <div class="d-flex pro_plan">
                            <p class=""><i class='bx bxl-sketch m-0 p-0' style=" font-size: 24px"></i></p>
                            <p class="" style="text-transform: capitalize">&nbsp;&nbsp;rubi</p>
                        </div>
                    </div>
                    <div class="pdp_etp_cfp" id="box_etp_cfp">
                        <div class="container pdp_etp_cfp_card ">
                            <div class="card">
                                <div class="card-title">
                                    <h6 class="mb-0 text-center">Numerika</h6>
                                </div>
                                @can('isReferent')
                                    <div class="card-body">
                                        <a href="{{route('liste_departement')}}">Structure de l'entreprise</a><br>
                                        <a href="{{route('ListeAbonnement')}}">Abonnement</a><br>
                                        <a href="#">Setting</a>
                                    </div>
                                @endcan

                            </div>
                        </div>
                    </div>
                </div>
                {{-- user --}}
                <div class="col">
                    <div class="header_img ms-5 mb-2 text-center d-flex flex-row" style="text-align: center">
                        <p><i class='bx bx-user-circle' style="color: #801D68; font-size: 24px"></i></p>
                        <p style="text-transform: capitalize;color:#801D68">&nbsp;{{Auth::user()->name}}</p>
                    </div>
                    <div class="pdp_profil" id="box_profil">
                        <div class="container pdp_profil_card ">
                            <div class="card">
                                <div class="card-title">
                                    <h6 class="mb-0 text-center">{{Auth::user()->name}}</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        @if(Auth::user()->role_id == 1)
                                        <span class="text-muted d-block mb-2">Admin</span>
                                        @endif
                                        @if(Auth::user()->role_id == 2)
                                        <span class="text-muted d-block mb-2">Référent</span>
                                        @endif
                                        @if(Auth::user()->role_id == 3)
                                        <span class="text-muted d-block mb-2">Stagiaire</span>
                                        @endif
                                        @if(Auth::user()->role_id == 4)
                                        <span class="text-muted d-block mb-2">Formateur</span>
                                        @endif
                                        @if(Auth::user()->role_id == 5)
                                        <span class="text-muted d-block mb-2">Manager</span>
                                        @endif
                                        @if(Auth::user()->role_id == 6)
                                        <span class="text-muted d-block mb-2">Super Admin</span>
                                        @endif
                                        @if(Auth::user()->role_id == 7)
                                        <span class="text-muted d-block mb-2">Centre de Formation</span>
                                        @endif

                                    </div>
                                    <div class="text-center">
                                        @can('isManager')
                                        <a href="{{route('affProfilChefDepartement')}}"><button class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                                        @endcan
                                        @can('isFormateur')
                                        <a href="{{route('profile_formateur')}}"><button
                                                class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                                        @endcan
                                        @can('isStagiaire')
                                        <a href="{{route('profile_stagiaire')}}"><button class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                                        @endcan
                                        @can('isReferent')
                                        <a href="{{route('affResponsable')}}"><button class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                                        @endcan
                                        @can('isCFP')
                                        <a href="{{route('affResponsableCfp')}}"><button class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- logout --}}
                <div class="col">
                    <div class="text_resp ms-5 mt-2 pt-1 text-right d-flex flex-row">
                        <p><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="deconnexion_text"><i class='bx bx-log-out' style="color :#801D68;font-size:24px;"></i></a></p>
                        <p><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();" class="deconnexion_text">&nbsp;&nbsp;<span>Déconnexion</span></a>
                            <form action="{{ route('logout') }}" id="logout-form" method="POST" class="d-none">
                                @csrf
                            </form>
                        </p>
                    </div>
                </div>
            </div>
        </header>
        {{-- header --}}
        {{-- content --}}
        <div class="container-fluid pb-5 h-100" style="background: white;">
            @yield('content')
        </div>
        {{-- content --}}
        {{-- footer --}}
        <div class="footer mt-5">
            <div class="container-fluid footer_all">
                <div class="row w-100">
                    <div class="col-12">
                        <div class="container">
                            <div class="d-flex w-auto footer_one">
                                <div class="footer_list me-2">
                                    <a href="#" class="mx-auto">
                                        <p>&copy;&nbsp;Copyright 2022 : Formation.mg</p>
                                    </a>
                                </div>
                                <div class="footer_list ms-2 me-2">
                                    <a  href="{{url('info_legale')}}" target="_blank" >
                                        <p>Informations légales</p>
                                    </a>
                                </div>
                                <div class="footer_list ms-2 me-2">
                                    <a href="{{url('contacts')}}" style="color: #801D62;text-decoration:none">
                                        <p>Contactez-nous</p>
                                    </a>
                                </div>
                                <div class="footer_list ms-2 me-2">
                                    <a href="#">
                                        <p>Politique de confidentialité</p>
                                    </a>
                                </div>
                                <div class="footer_list ms-2 me-2">
                                    <a href="{{route('condition_generale_de_vente')}}" style="color:#801D68 !important" target="_blank">
                                        <p>Condition d'utilisation</p>
                                    </a>
                                </div>
                                <div class="footer_list ms-2 me-2">
                                    <a href="{{url('tarifs')}}"  style="color:#801D68 !important" target="_blank">
                                        <p>Tarifs</p>
                                    </a>
                                </div>
                                <div class="footer_list_end ms-2 me-2">
                                    <a href="#">
                                        <p>Crédits</p>
                                    </a>
                                </div>
                                <div class="footer_list_end ms-2 me-2 mt-1 text-muted">
                                    <p style="font-size: 13px">1.01</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- footer --}}
    </div>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    {{-- JQuery --}}
    <script src="{{asset('bootstrapCss/js/bootstrap.bundle.js')}}"></script>

    <script src="{{asset('assets/js/boxicons.js')}}"></script>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('assets/js/startmin.js')}}"></script>

    <!--full  calendar -->
    <script src="{{asset('assets/fullcalendar/lib/main.js')}}"></script>

    {{-- auto-complete --}}

    <script src="{{ asset('assets/js/jquery.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('function js/programme/edit_programme.js') }}"></script>

    <script src="{{asset('js/qcmStep.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/qcmStep.css')}}">
    <!--Manomboka eto ny chat-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {}
            , Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script")
                , s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/61e7c1aab84f7301d32bc41c/1fpokp17j';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();

    </script>
    <!--End of Tawk.to Script-->
</body>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
</body>
<script>
    let mybutton = document.getElementById("btn-back-to-top");
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        if (
            document.body.scrollTop > 300 ||
            document.documentElement.scrollTop > 300
        ) {
            mybutton.style.display = "block";
            mybutton.style.bottom = "90px";
        } else {
            mybutton.style.display = "none";
        }
    }
    mybutton.addEventListener("click", backToTop);

    function backToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }

</script>
<script>
    document.addEventListener("DOMContentLoaded", function(event) {

        const afficheNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = document.getElementById(toggleId)
                , nav = document.getElementById(navId)
                , bodypd = document.getElementById(bodyId)
                , headerpd = document.getElementById(headerId)
                , marginimg = document.getElementById(img)

            // valider tous les variables
            if (toggle && nav && bodypd && headerpd) {
                toggle.addEventListener('click', () => {
                    // afficher navigateur
                    nav.classList.toggle('showing')
                    // changer icon
                    toggle.classList.toggle('bx-menu-alt-right')
                    // ajouter padding body
                    bodypd.classList.toggle('body-pd')
                    // ajouter margin logo
                    // marginimg.classList.toggle('imag_marge')
                    // ajouter padding header
                    headerpd.classList.toggle('body-pd')
                })
            }
        }

        afficheNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')
        /*===== Lien active =====*/
        const linkColor = document.querySelectorAll('.nav_link')

        function colorLink() {
            if (linkColor) {
                linkColor.forEach(l => l.classList.remove('active'))
                this.classList.add('active')
            }
        }
        linkColor.forEach(l => l.addEventListener('click', colorLink))

        var dropdown = document.getElementsByClassName("dropdown-menu");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
            });
        }

        $(document).ready(function() {
            var down = false;
            var down2 = false;
            var down3 = false;
            var down4 = false;

            $('#bell').mousedown(function(e) {

                var color = $(this).text();
                if (down) {
                    $('#box_notif').css('height', '0px');
                    $('#box_notif').css('opacity', '0');
                    $('#box_notif').css('display', 'none');

                    down = false;
                } else {
                    $('#box_notif').css('height', 'auto');
                    $('#box_notif').css('opacity', '1');
                    $('#box_notif').css('display', 'block');
                    down = true;
                }
            });
            $('#envelope').mousedown(function(e) {
                var color = $(this).text();
                if (down2) {
                    $('#box_message').css('height', '0px');
                    $('#box_message').css('opacity', '0');
                    $('#box_message').css('display', 'none');
                    down2 = false;
                } else {
                    $('#box_message').css('height', 'auto');
                    $('#box_message').css('opacity', '1');
                    $('#box_message').css('display', 'block');
                    down2 = true;
                }
            });
            $('.header_img').mousedown(function(e) {
                var color = $(this).text();
                if (down3) {
                    $('#box_profil').css('height', '0px');
                    $('#box_profil').css('opacity', '0');
                    $('#box_profil').css('display', 'none');
                    down3 = false;
                } else {
                    $('#box_profil').css('height', 'auto');
                    $('#box_profil').css('opacity', '1');
                    $('#box_profil').css('display', 'block');
                    down3 = true;
                }
            });
            $('.header_etp_cfp').mousedown(function(e) {
                var color = $(this).text();
                if (down4) {
                    $('#box_etp_cfp').css('height', '0px');
                    $('#box_etp_cfp').css('opacity', '0');
                    $('#box_etp_cfp').css('display', 'none');
                    down4 = false;
                } else {
                    $('#box_etp_cfp').css('height', 'auto');
                    $('#box_etp_cfp').css('opacity', '1');
                    $('#box_etp_cfp').css('display', 'block');
                    down4 = true;
                }
            });
        });
    });

</script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: '{{ route("profil_user") }}'
            , type: 'get'
            , success: function(response) {
                var profil = response;
                var img = '<img src="{{asset(":pdp")}}" >';
                img = img.replace(':pdp', profil);
                $("#photo_profil").append(img);
                $("#profil_usesr").append(img);
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

</script>

{{-- nombre dynamique dans la side-bar --}}
<script>
    $(document).ready(function() {
        $.ajax({
            url: '{{ route("admin_count") }}'
            , type: 'get'
            , success: function(response) {
                var nombre = response;
                $("#entreprise").append(nombre[0]);
                $("#projet_en_cours").append(nombre[1]);
                $("#projet_terminer").append(nombre[2]);
                $("#projet_a_venir").append(nombre[3]);
                $("#projets").append(nombre[4]);
                $("#formateur").append(nombre[5]);
                // alert(nombre);
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });
    $(document).ready(function() {
        $.ajax({
            url: '{{ route("admin_count_etp") }}'
            , type: 'get'
            , success: function(response) {
                var nombre = response;
                $("#cfp").append(nombre[0]);
                $("#projet_en_cours_etp").append(nombre[1]);
                $("#projet_terminer_etp").append(nombre[2]);
                $("#projet_a_venir_etp").append(nombre[3]);
                $("#projets_etp").append(nombre[4]);
                $("#stagiaire").append(nombre[5]);
                $("#manager").append(nombre[6]);
                // alert(nombre);
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).ready(function() {
        $('.ui-helper-hidden-accessible').hide();
    });

</script>

</html>
