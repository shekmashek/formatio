@inject("domaine", 'App\Domaine')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Formation.mg</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/fontawesome.min.css"
        integrity="sha512-8Vtie9oRR62i7vkmVUISvuwOeipGv8Jd+Sur/ORKDD5JiLgTGeBSkI3ISOhc730VGvA5VVQPwKIKlmi+zMZ71w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">
    <link rel="shortcut icon" href="{{  asset('maquette/logo_fmg7635dc.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/css/configAll.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/mahafaly.css')}}">

    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .modal-backdrop{
            z-index: 1 !important;
        }
    </style>
</head>
<body>
    @if ($message = Session::get('creation_inter_error'))
        <div class="modal" tabindex="-1">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger ms-2 me-2">
                        <ul>
                            <li>{{ $message }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            </div>
        </div>
    @endif

    <div class="sidebar active">
        {{-- <div class="logo_content">
            <div class="logo">
                <span><img src="{{asset('img/images/logo_fmg54Ko.png')}}" alt="" class="img-fluid"></span>
                <div class="logo_name"><a href="{{ route('home') }}">Formation.mg</a></div>
            </div>

        </div> --}}
        <ul class="nav nav_list mb-5" id="menu">
            {{-- <li>
                <a href="{{ route('home') }}" class="nav_linke" id="accueil">
                    <i class="bx bxs-dashboard"></i>
                    <span class="links_name">Accueil</span>
                </a>

            </li> --}}



            @canany(['isReferent','isReferentSimple'])
            <li>
                <a href="{{ route('afficher_iframe_entreprise') }}" class="d-flex BI nav_linke">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="links_name">BI</span>
                </a>
            </li>

            @endcanany
            @canany(['isCFP'])
            <li>
                <a href="{{ route('afficher_iframe_cfp') }}" class="d-flex BI nav_linke">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="links_name">BI</span>
                </a>
            </li>
            @endcanany
            @canany(['isSuperAdmin'])
            <li>
                <a href="{{ route('creer_iframe') }}" class="d-flex BI nav_linke">
                    <i class='bx bxs-pie-chart-alt-2'></i>
                    <span class="links_name"> BI </span>
                </a>
            </li>
            @endcanany




            {{-- @canany(['isCFP'])
            <li>
                <a href="{{route('liste_module')}}" class="d-flex nav_linke">
                    <i class="bx bx-customize"></i>
                    <span class="links_name">Modules</span>
                </a>

            </li>
            @endcanany --}}
            {{-- entreprise --}}
            {{-- @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('liste_entreprise')}}" class="d-flex nav_linke">
                    <i class='bx bx-building-house'></i>
                    <span class="links_name">Entreprises</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouvelle_entreprise')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouvelle Entreprise</span>
                </a>

            <li class="my-1 sousMenu">
                <a href="{{route('departement.index')}}">Département</a>
            </li>
            </li> --}}
            {{-- @endcanany --}}
            @canany(['isSuperAdmin'])

            {{-- <a href="{{route('liste_utilisateur')}}" class="btn_racourcis me-4 mt-3">
                <span class="d-flex flex-column"> <i class='bx bxs-user'></i><span
                        class="text_racourcis">Utilisateurs</span></span>


            </a> --}}
            <li>
                <a href="{{route('categorie')}}" class="d-flex categorie nav_linke">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="links_name">Categories</span>
                </a>

            </li>
            <li>
                <a href="{{route('module')}}" class="d-flex formation nav_linke">
                    <i class='bx bx-book'></i>
                    <span class="links_name">Formations</span>
                </a>

            </li>
            <li>
                <a href="{{route('crud_formation')}}" class="d-flex crud nav_linke">
                    <i class='bx bx-grid'></i>
                    <span class="links_name" style="font-size: 10px">Domaine & Formation</span>
                </a>

            </li>
            <li>
                <a href="{{ route('taxes') }}" class="d-flex taxe nav_linke">
                    <i class='bx bx-spreadsheet'></i>
                    <span class="links_name">Taxe</span>
                </a>

            </li>
            <li>
                <a href="{{ route('devise') }}" class="d-flex devise nav_linke">
                    <i class='bx bx-receipt'></i>
                    <span class="links_name">Devise</span>
                </a>

            </li>

            @endcanany

            @can('isCFP')
            <li>
                <a href="{{route('liste_entreprise')}}" class="d-flex entreprise nav_linke">
                    <i class='bx bx-building-house'></i>
                    <span class="links_name">Entreprises</span>
                </a>

            </li>
            @endcan
            @canany(['isReferent','isReferentSimple'])
            <li>
                <a href="{{route('list_cfp')}}" class="d-flex organisme nav_linke">
                    <i class='bx bxs-business'></i>
                    <span class="links_name">Organisme</span>
                </a>

            </li>
            @endcanany
            {{-- projet de formation --}}

            {{-- @canany(['isCFP','isFormateur'])
            <li>
                <a href="{{route('liste_projet')}}" class="d-flex nav_linke">
                    <i class='bx bx-library'></i>
                    <span class="links_name">Projets</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_projet')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Projet</span>
                </a>
                <span class="tooltip">Nouveau Projet</span>
            <li class="sousMenu me-2 d-flex justify-content-between">
                <a href="{{url('detail_session')}}">Sessions</a>
                <p class="my-1" id="projets_etp" style="background-color: white; border-radius: 2rem; padding: 0 8px;">
                </p>
            </li>
            </li>
            @endcanany --}}
            @canany(['isReferent','isReferentSimple','isManager','isChefDeService'])
            <li>
                <a href="{{route('liste_projet')}}" class="d-flex projet nav_linke">
                    <i class='bx bx-library'></i>
                    <span class="links_name">Projets</span>
                </a>
            </li>
            @endcanany
            @canany(['isReferent','isReferentSimple','isManager','isStagiaire','isChefDeService'])
            <li>
                <a href="{{route('formations')}}" class="d-flex nav_linke">
                    <i class='bx bxl-netlify'></i>
                    <span class="links_name">Formations</span>
                </a>

            </li>
            @endcanany
            @canany(['isReferent','isReferentSimple'])
            <li>
                <a href="{{route('formateurs')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-pin'></i>
                    <span class="links_name">Formateurs</span>
                </a>

            </li>
            @endcanany
            @canany(['isStagiaire'])
            <li>
                <a href="{{route('liste_projet',['id'=>1])}}" class="d-flex projet nav_linke">
                    <i class='bx bx-library'></i>
                    <span class="links_name">Projets</span>
                </a>

            </li>
            @endcanany
            @canany(['isCFP','isReferent','isManager','isChefDeService'])
            {{-- <li>
                <a href="{{route('appel_offre.index')}}" class="d-flex nav_linke">
                    <i class='bx bx-mail-send'></i>
                    <span class="links_name">Appel d'Offre</span>
                </a>

            </li> --}}
            @endcanany
            {{-- utilisateurs --}}
            {{-- @canany(['isSuperAdmin','isAdmin'])

            <li>
                <a href="{{route('utilisateur_stagiaire')}}" class="d-flex nav_linke">
                    <i class='bx bx-user-circle'></i>
                    <span class="links_name">Stagiaires</span>
                </a>

            </li>
            <li>
                <a href="{{route('utilisateur_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Formateurs</span>
                </a>

            </li>
            @endcanany --}}
            {{-- formateurs --}}

            @canany(['isCFP'])
            <li>
                <a href="{{route('liste_formateur')}}" class="d-flex formateurs nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Formateurs</span>
                </a>

            </li>
            {{-- <li>
                <a href="{{route('nouveau_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Formateur</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Formateur</span>
                </a>

            </li> --}}
            @endcanany
            {{-- manager --}}
            {{-- @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('employes')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Manager</span>
                </a>

            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_manager')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Manager</span>
                </a>

            </li> --}}
            {{-- @endcanany --}}
            @canany(['isReferent'])
            {{-- <li>
                <a href="{{route('employes')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Equipe admnistrative</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_manager')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Manager</span>
                </a>

            </li> --}}
            @endcanany
            {{-- Referent --}}
            @canany(['isAdmin','isSuperAdmin'])
            <li>
                <a href="{{route('utilisateur_superAdmin')}}" class="d-flex superadmin nav_linke">
                    <i class='bx bxs-user'></i>
                    <span class="links_name">Super Admin</span>
                </a>

            </li>
            {{-- <li>
                <a href="{{route('liste_responsable')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Réferents</span>
                </a>

            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_responsable')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Réferents</span>
                </a>

            </li> --}}
            @endcanany
            {{-- stagiares --}}

            {{-- @canany(['isReferent'])
            <li>
                <a href="{{route('liste_participant')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Stagiaires</span>
                </a>

            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_participant')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Stagiaire</span>
                </a>

            </li> --}}
            {{-- @endcanany --}}
            {{-- action de formations --}}

            {{-- @canany(['isFormateur'])
            <li>
                <a href="{{route('presence.index')}}" class="d-flex nav_linke">
                    <i class='bx bx-list-check'></i>
                    <span class="links_name">Emargement</span>
                </a>

            </li>
            @endcanany --}}

            {{-- calendrire de formations
            <li>
                @canany(['isReferent','isStagiaire','isManager'])
                <a href="{{route('calendrier_formation')}}" class="d-flex nav_linke">
                    <i class='bx bxs-calendar'></i>
                    <span class="links_name">Calendrier</span>
                </a>
                @endcan--}}
                {{-- @canany(['isCFP', 'isFormateur'])
                <a href="{{route('calendrier')}}" class="d-flex nav_linke">
                    <i class='bx bxs-calendar'></i>
                    <span class="links_name">Calendrier</span>
                </a>
                @endcanany -


            </li>-}}

            {{-- commercial --}}
            {{-- @canany(['isSuperAdmin','isCFP','isReferent'])
            <li>
                <a href="{{route('collaboration')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-account'></i>
                    <span class="links_name">Coopération</span>
                </a>

            </li>
            @endcanany --}}
            @canany(['isCFP','isReferent','isReferentSimple'])
            <li>
                <a href="{{route('liste_facture')}}" class="d-flex facture nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Factures</span>
                </a>

            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('liste_facture')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Total facture</span>
                </a>
            </li> --}}

            @endcanany
            {{-- competence --}}
            @canany(['isReferent','isManager','isChefDeService'])
            @canany(['isReferent'])
            {{-- <li>
                <a href="{{route('demande_test_niveau')}}" class="d-flex nav_linke">
                    <i class='bx bx-network-chart'></i>
                    <span class="links_name">Aptitudes</span>
                </a>
            </li> --}}
            {{-- integrer dans la page
            <li>
                <a href="{{route('liste_facture')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Total facture</span>
                </a>
            </li> --}}
            @endcanany
            {{-- <li>
                <a href="{{route('liste_projet')}}" class="d-flex nav_linke">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="links_name">Compétence</span>
                </a>
            </li> --}}
            @endcanany

            {{-- plan de formation --}}
            @canany(['isStagiaire','isManager','isChefDeService','isChefDeService','isReferent','isReferentSimple'])
            <li>
                <a @canany(['isStagiaire']) href="{{route('planFormation.index')}}" @endcanany
                    href="{{route('liste_demande_stagiaire')}}" class="d-flex nav_linke">
                    <i class='bx bx-bar-chart-square'></i>
                    <span class="links_name">Plan</span>
                </a>
            </li>
            @endcanany
            {{-- integrer dans la page
            <li>
                <a href="{{route('listePlanFormation')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Liste Plan</span>
                </a>
            </li> --}}
            {{-- @endcanany
            {{-- abonemment --}}
            @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('listeAbonne')}}" class="d-flex abonnees nav_linke">
                    <i class='bx bxl-sketch'></i>
                    <span class="links_name">Abonnées</span>
                </a>

            </li>

            {{-- integrer dans la page
            <li>
                <a href="{{route('abonnement.index')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Abonnement</span>
                </a>
            </li> --}}
            @endcanany

            {{-- @canany(['isReferent','isCFP'])
            <li>
                <a href="{{route('ListeAbonnement')}}" class="d-flex nav_linke abo">
                    <i class='bx bxl-sketch'></i>
                    <span class="links_name">Abonnement</span>
                </a>
            </li>
            @endcan --}}
            {{-- @can(['isCFP'])
            <li>
                <a href="{{route('liste_demande_devis')}}" class="d-flex demandedevis nav_linke">
                    <i class='bx bxs-notepad'></i>
                    <span class="links_name"> Demande devis</span>
                </a>
            </li>

            @endcan --}}
            @canany(['isFormateur','isFormateurInterne'])
            <li>
                <a href="{{route('profilProf',Auth::user()->id)}}" class="d-flex moncv nav_linke">
                    <i class='bx bxs-notepad'></i>
                    <span class="links_name">Mon CV</span>
                </a>
            </li>

            @endcanany

            {{-- <li>
                <i class='bx bxs-notepad'></i>
                <span class="links_name">Reporting</span>
                </a>
            </li> --}}
            {{-- @can('isCFP')
            <li>
                <a href="{{route('gestion_documentaire')}}" class="d-flex nav_linke">
                    <i class='bx bx-book-add'></i>
                    <span class="links_name">Librairies</span>
                </a>
            </li>
            <li>
                <a href="{{route('gestion_documentaire')}}" class="d-flex nav_linke">
                    <i class='bx bx-book-add'></i>


                    <span class="links_name">Librairies</span>
                </a>
            </li>
            @endcan --}}
        </ul>

        {{-- <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <div class='photo_users'> </div>
                    <div class="name_job">
                        <div class="name">Déconnexion</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="bx bx-log-out" id="log_out"></i></a>
            </div>
        </div> --}}

    </div>

    <div class="home_content">
        <div class="container-fluid p-0 height-100 bg-light" id="content">
            <header class="header row align-items-center g-0" id="header">
                {{-- <div class="col-1 menu_hamburger">
                    <i class="bx bx-menu" id="btn_menu" role="button" onclick="clickSidebar();"></i>
                </div> --}}
                <div class="col-3 d-flex flex-row padding_logo">
                    <span><img src="{{asset('img/logos_all/iconFormation.webp')}}" alt="" class="img-fluid menu_logo me-3"></span>@yield('title')
                            {{-- <div>
                                <a href="/home" class="teste">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <div class="titre">
                                        <i >F</i>
                                    </div>

                                </a>
                            </div>
                            <div style="margin-left:90px;margin-top:-10px;font-size:30px;">@yield('title')</div>--}}
                </div>
                <div class="col-4 align-items-center justify-content-start d-flex flex-row ">
                    @canany(['isReferent','isStagiaire','isManager','isChefDeService','isReferentSimple'])
                    <div class="row">
                        <div class="searchBoxMod d-flex flex-row py-2">

                            <div class="btn_racourcis me-4">
                                <a href="{{route('liste_formation')}}" class="text-center catalogue" role="button"
                                    onclick="afficher_catalogue()"><span class="d-flex flex-column"><i
                                            class='bx bxs-category-alt mb-2 mt-1'></i><span
                                            class="text_racourcis">Catalogue</span></span></a>
                            </div>
                            <div class="btn_racourcis me-4">
                                <a href="{{route('liste_projet')}}" class="text-center annuaire" role="button"
                                    onclick="afficher_annuaire()"><span class="d-flex flex-column"><i
                                            class='bx bx-library mb-2 mt-1'></i><span
                                            class="text_racourcis">Projets</span></span></a>
                            </div>
                            <div class="btn_racourcis me-4">
                                <a href="{{route('annuaire')}}" class="text-center annuaire" role="button"
                                    onclick="afficher_annuaire()"><span class="d-flex flex-column"><i
                                            class='bx bx-analyse mb-2 mt-1'></i><span
                                            class="text_racourcis">Annuaire</span></span></a>
                            </div>

                        </div>
                    </div>
                    @endcanany

                    <div class="row">
                        <div class="searchBoxMod d-flex flex-row py-2">
                            @canany(['isReferent','isManager','isChefDeService','isReferentSimple','isStagiaire'])
                            <div class="btn_racourcis me-4">
                                <a href="{{route('calendrier_formation')}}" class="text-center agenda" role="button"><span
                                        class="d-flex flex-column text-center"><i
                                            class='bx bxs-calendar-edit mb-2 mt-1'></i><span
                                            class="text_racourcis">Agenda</span></span></a>
                            </div>
                            @endcanany
                            @canany(['isReferent','isManager','isChefDeService','isReferentSimple'])
                                <div class="btn_racourcis me-4">
                                    <a href="{{route('employes.liste')}}" class="employe text-center" role="button"><span
                                            class="d-flex flex-column"><i class='bx bxs-user-detail mb-2 mt-1'></i><span
                                                class="text_racourcis">employés</span></span></a>
                                </div class="btn_racourcis">
                            @endcanany
                            {{-- <div class="btn_racourcis me-4">
                                <a href="{{route('employes')}}" class="text-center" role="button"><span
                                        class="d-flex flex-column"><i class='bx bxs-group mb-2 mt-1'></i><span
                                            class="text_racourcis">Equipe</span></span></a>
                            </div> --}}
                        </div>
                    </div>



                    {{-- @canany(['isCFP','isFormateur'])
                    <div class="row">
                        <div class="searchBoxMod d-flex flex-row py-2">
                            <div class="btn_racourcis me-4">
                                <a href="{{route('calendrier')}}" class="text-center " role="button"><span
                                        class="d-flex flex-column"><i class='bx bxs-calendar-edit mb-2 mt-1'></i><span
                                            class="text_racourcis">Agenda</span></span></a>
                            </div>
                        </div>
                    </div>
                    @endcanany --}}
                    @canany('isCFP')
                    <div class="row">
                        <div class="searchBoxMod d-flex flex-row py-2">
                            <div class="btn_racourcis me-4">
                                <a href="{{route('liste_module')}}" class="text-center module" role="button"><span
                                        class="d-flex flex-column"><i class='bx bxs-customize mb-2 mt-1'></i><span
                                            class="text_racourcis">Modules</span></span></a>
                            </div>
                            <div class="btn_racourcis me-4">
                                <a href="{{route('liste_projet')}}" class="text-center projet" role="button"><span
                                        class="d-flex flex-column"><i class='bx bx-library mb-2 mt-1'></i><span
                                            class="text_racourcis">Projets</span></span></a>
                            </div>
                            <div class="btn_racourcis me-4">
                                <a href="{{route('calendrier')}}" class="text-center agenda" role="button"><span
                                        class="d-flex flex-column"><i class='bx bxs-calendar-week mb-2 mt-1'></i><span
                                            class="text_racourcis">Agenda</span></span></a>
                            </div>
                            @can('isPremium')
                            <div class="btn_racourcis me-4">
                                <a href="{{route('liste_equipe_admin')}}" class="text-center equipe" role="button">
                                    <span class="d-flex flex-column">
                                        <i class='bx bxs-user-account mb-2 mt-1'></i>
                                        <span class="text_racourcis">equipes</span>
                                    </span>
                                </a>
                            </div>
                            @endcan
                        </div>
                    </div>
                    @endcanany
                    {{-- @canany('isStagiaire')
                    <div class="row">
                        <div class="searchBoxMod d-flex flex-row py-2">
                            <div class="btn_racourcis me-4">
                                <a href="{{route('liste_projet')}}" class="text-center projet" role="button"><span
                                        class="d-flex flex-column"><i class='bx bx-library mb-2 mt-1'></i><span
                                            class="text_racourcis">Projets</span></span></a>
                            </div>
                            <div class="btn_racourcis me-4">
                                <a href="{{route('calendrier_formation')}}" class="text-center agenda" role="button"><span
                                        class="d-flex flex-column"><i class='bx bxs-calendar-week mb-2 mt-1'></i><span
                                            class="text_racourcis">Agenda</span></span></a>
                            </div>
                        </div>
                    </div>
                    @endcanany --}}
                    @canany(['isFormateur','isFormateurInterne'])
                    <div class="row">
                        <div class="searchBoxMod d-flex flex-row py-2">
                            <div class="d-flex flex-row">
                                <div class="btn_racourcis me-4">
                                    <a href="{{route('liste_projet')}}" class="text-center projet" role="button"><span
                                            class="d-flex flex-column"><i class='bx bx-library mb-2 mt-1'></i><span
                                                class="text_racourcis">Projets</span></span></a>
                                </div>
                                <div class="btn_racourcis me-4">
                                    <a href="{{route('calendrier')}}" class="text-center agenda" role="button"><span
                                            class="d-flex flex-column"><i
                                                class='bx bxs-calendar-week  mb-2 mt-1'></i><span
                                                class="text_racourcis">Agenda</span></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcanany
                </div>
                <div class="col-5 header-right align-items-center d-flex flex-row">
                    <div class="col-4 d-flex flex-row justify-content-center apprendCreer pb-3">
                        {{-- @can('isStagiaire')
                        <div class="col-5 header-right">
                            <div class="col-12 d-flex flex-row justify-content-center apprendCreer apprendreBox">
                                <div class="btn_racourcis" id="text_apprendre">
                                    {{-- <span class="text_apprendre" role="button"><i class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    {{-- <a href="#" class="text-center " role="button"><span class="d-flex flex-column"><i class='fa-solid fa-book-open-reader mb-2 mt-1'></i>
                                        <span class="text_racourcis">Apprendre</span></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endcan --}}
                        {{-- @can('isManager')
                        <div class="col-5 header-right">
                            <div class="col-12 d-flex flex-row justify-content-center apprendCreer apprendreBox">
                                <div class="btn_racourcis" id="text_apprendre">
                                    {{-- <span class="text_apprendre" role="button"><i
                                            class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    {{-- <a href="#" class="text-center " role="button"><span class="d-flex flex-column"><i class='fa-solid fa-book-open-reader mb-2 mt-1'></i>
                                        <span class="text_racourcis">Apprendre</span></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endcan --}}
                        @canany(['isReferent','isReferentSimple'])
                        <div class="col-5 header-right d-flex flex-row">
                            <div class="col-12 d-flex flex-row justify-content-center apprendCreer apprendreBox">
                                <div class="btn_racourcis" id="text_apprendre">
                                    {{-- <span class="text_apprendre" role="button"><i
                                            class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    <a href="#" class="text-center " role="button"><span class="d-flex flex-column"><i class='fa-solid fa-book-open-reader mb-2 mt-1'></i>
                                        <span class="text_racourcis">Apprendre</span></span>
                                    </a>
                                </div>
                                {{-- <div class="btn_racourcis dropdown prevent_affichage .navigation_module" >
                                    <a href="#" class="dropdown-toggle" role="button" id="notification" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                        <span class=""><i class='bx bxs-bell-ring bx-tada-hover mb-2 mt-1'></i>
                                        <span class="text_racourcis"></span></span>
                                        <span class="badge_invitation">6</span>
                                    </a>
                                    <ul class="dropdown-menu agrandir2" aria-labelledby="notification">
                                        listes des notifications
                                    </ul>
                                </div> --}}
                                <div class="btn_racourcis dropdown prevent_affichage2 .navigation_module" >
                                    {{-- <span class="text_apprendre" role="button"><i
                                            class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    <a href="#" class="dropdown-toggle" role="button" id="invitation_cfp" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                        <span class=""><i class='bx bxs-message-add bx-burst-hover mb-2 mt-1'></i>
                                        <span class="text_racourcis"></span></span>
                                        <span class="badge_invitation">9</span>
                                    </a>
                                    <ul class="dropdown-menu agrandir " aria-labelledby="invitation_cfp">
                                        <div class="m-4 mt-2" role="tabpanel">
                                            <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab" style="font-size: 10px;">
                                                <li class="nav-item ">
                                                    <a href="#invitation_attente" class="nav-link active" data-bs-toggle="tab">Invitations en attente</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#invitation_refuses" class="nav-link" data-bs-toggle="tab">Invitations réfusées</a>
                                                </li>

                                            </ul>

                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="invitation_attente">
                                                    <div class="container">
                                                        <div class="row">
                                                            <ul>
                                                                liste invitations en attente
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="invitation_refuses">
                                                    <div class="container">
                                                        <div class="row">
                                                            <ul>
                                                                liste des invitations réfusées
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>

                        </div>
                        @endcanany
                        @can('isCFP')
                        <div class="col-5 header-right">
                            <div class="col-12 d-flex flex-row justify-content-end apprendCreer apprendreBox">
                                <div class="btn_racourcis" id="text_apprendre">
                                    {{-- <span class="text_apprendre" role="button"><i
                                            class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    <a href="#" class="text-center " role="button"><span class="d-flex flex-column"><i class='fa-solid fa-book-open-reader mb-2 mt-1'></i>
                                        <span class="text_racourcis">Apprendre</span></span>
                                    </a>
                                </div>
                                <div class="btn_racourcis dropdown prevent_affichage .navigation_module" >
                                    {{-- <span class="text_apprendre" role="button"><i
                                            class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    {{-- <a href="#" class="dropdown-toggle" role="button" id="notification" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                        <span class=""><i class='bx bxs-bell-ring bx-tada-hover mb-2 mt-1'></i>
                                        <span class="text_racourcis"></span></span>
                                        <span class="badge_invitation">6</span>
                                    </a>
                                    <ul class="dropdown-menu agrandir2" aria-labelledby="notification">
                                        listes des notifications
                                    </ul> --}}
                                </div>
                                <div class="btn_racourcis dropdown prevent_affichage2 .navigation_module" >
                                    {{-- <span class="text_apprendre" role="button"><i
                                            class="fa-solid fa-book-open-reader icons_creer"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apprendre</span> --}}
                                    <a href="#" class="dropdown-toggle" role="button" id="invitation_cfp" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                                        <span class=""><i class='bx bxs-message-add bx-burst-hover mb-2 mt-1'></i>
                                        <span class="text_racourcis"></span></span>
                                        <span class="badge_invitation"></span>
                                    </a>
                                    <ul class="dropdown-menu agrandir " aria-labelledby="invitation_cfp">
                                        <div class="m-4 mt-2" role="tabpanel">
                                            <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab" style="font-size: 10px;">
                                                <li class="nav-item " >
                                                    <a href="#invitation_attente" class="nav-link active" data-bs-toggle="tab">Invitations en attente</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#invitation_refuses" class="nav-link" data-bs-toggle="tab">Invitations réfusées</a>
                                                </li>

                                            </ul>

                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="invitation_attente">
                                                    <div class="container">
                                                        <div class="row">
                                                            <ul>
                                                                <p class="test_affiche1 mt-3 my-2" style="font-size: 12px"></p>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="invitation_refuses">
                                                    <div class="container">
                                                        <div class="row">
                                                            <ul class="test_affiche2 mt-3 my-2" style="font-size: 12px">
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endcan

                    </div>
                    <div class="col-8">
                        <div class="row justify-content-end">
                            <div class="col-12 text-end icones_header">
                                @can('isSuperAdmin')
                                    <a class="dropdown-toggle p-1" id="dropdownMenuCreer" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class='bx bx-plus-medical icon_creer_admin'></i></a>
                                    <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuCreer">
                                        <li><a class="dropdown-item" href="{{route('nouveau_type')}}"> <i
                                                    class='bx bxs-doughnut-chart icon_plus'></i>&nbsp;Nouveau type
                                            </a></li>
                                            <li id="abo"><a class="dropdown-item" href="{{route('nouveau_coupon')}}"> <i
                                                class='bx bx-money '></i>&nbsp;Nouveau coupon
                                        </a></li>
                                        <li id="formation"><a class="dropdown-item" href="{{route('nouveau_formation')}}"> <i
                                            class='bx bx-cross '></i>&nbsp;Nouvelle formation
                                        </a></li>
                                    </ul>
                                @endcan
                                @canany(['isManager','isChefDeService'])
                                    <a class="dropdown-toggle p-1" id="dropdownMenuCreer" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class='bx bx-plus-medical icon_creer_admin'></i></a>
                                    <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuCreer">
                                        <li><a class="dropdown-item" href="{{route('planFormation.index')}}"> <i
                                                    class='bx bxs-doughnut-chart icon_plus'></i>&nbsp;Nouvelle demande
                                                stagiaire</a></li>
                                        <li id="formation"><a class="dropdown-item" href="{{route('ajout_plan')}}"> <i
                                                    class='bx bx-scatter-chart icon_plus'></i>&nbsp;Nouvelle plan de
                                                formation</a></li>
                                        <li id="BI"><a class="dropdown-item" href="{{route('budget')}}"><i
                                                    class="fas fa-money-check icon_plus"></i>&nbsp;Budgetisation</a></li>

                                    </ul>
                                @endcanany
                                @canany(['isReferent','isReferentSimple'])
                                    <a class="dropdown-toggle p-1" id="dropdownMenuCreer" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class='bx bx-plus-medical icon_creer_admin'></i></a>
                                    <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuCreer">
                                        <li id="employe">
                                            <a class="dropdown-item" href="{{route('employes.new')}}">
                                                <i class="fas fa-user icon_plus  "></i>&nbsp; Nouveau Employés
                                            </a>
                                        </li>
                                    </ul>
                                    <a class="dropdown-toggle p-1" id="dropdownMenuParametre" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class='bx bx-cog icon_creer_admin'></i></a>
                                    <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuParametre">
                                        <li id="parametre">
                                            <a class="dropdown-item" href="{{route('aff_parametre_referent')}}">
                                                <i class="bx bx-info-circle icon_plus  "></i>&nbsp; Information légales
                                            </a>
                                        </li>
                                        <li id="abo">
                                            <a class="dropdown-item" href="{{route('ListeAbonnement')}}">
                                                <i class="bx bxl-sketch icon_plus  "></i>&nbsp; Abonnement
                                            </a>
                                        </li>
                                        <li id="equipe">
                                            <a class="dropdown-item" href="{{route('liste_departement')}}">
                                                <i class="fas fa-user icon_plus  "></i>&nbsp; Structure de l'entreprise
                                            </a>
                                        </li>

                                        <li id="parametre">
                                            <a class="dropdown-item" href="{{route('parametrage_frais_annexe')}}">
                                                <i class="bx bx-money-withdraw icon_plus  "></i>&nbsp; Frais annexes
                                            </a>
                                        </li>
                                    </ul>
                                @endcanany
                                @can('isCFP')
                                    <a class="dropdown-toggle p-1" id="dropdownMenuCreer" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class='bx bx-plus-medical icon_creer_admin'></i></a>
                                    <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuCreer">
                                        @can('isCFPPrincipale')
                                            @can('isPremium')
                                                <li id="equipe">
                                                    <a class="dropdown-item" href="{{route('liste+responsable+cfp')}}">
                                                        <i class="bx bx-user icon_plus"></i>&nbsp; Nouveau réferent
                                                    </a>
                                                </li>
                                            @endcan
                                        @endcan
                                        <li>
                                            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#nouveau_module" role="button">
                                                <i class="bx bx-customize icon_plus"></i>&nbsp; Nouveau Module
                                            </a>
                                        </li>
                                        {{-- <li id="formateurs">
                                            <a class="dropdown-item" href="{{route('nouveau_formateur')}}">
                                                <i class="bx bxs-user-rectangle icon_plus "></i>&nbsp; Nouveau Formateur
                                            </a>
                                        </li> --}}
                                        @can('isPremium')
                                            <li id="projet">
                                                <a class="dropdown-item"
                                                    href="{{route('nouveau_groupe_inter',['type_formation'=>2])}}">
                                                    <i class='bx bx-library icon_plus'></i>&nbsp;Projet Inter
                                                </a>
                                            </li>
                                        @endcan
                                        <li id="projet">
                                            <a class="dropdown-item"
                                                href="{{route('nouveau_groupe',['type_formation'=>1])}}">
                                                <i class="bx bx-library icon_plus"></i>&nbsp; Projet Intra
                                            </a>
                                        </li>
                                        <li id="facture">
                                            <a class="dropdown-item" href="{{route('facture')}}">
                                                <i class='bx bxs-bank icon_plus'></i>&nbsp;Nouvelle Facture
                                            </a>
                                        </li>
                                    </ul>
                                    @canany(['isCFPPrincipale','isPremium'])
                                        <a class="dropdown-toggle p-1" id="dropdownMenuParametre" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class='bx bx-cog icon_creer_admin'></i></a>
                                        <ul class="dropdown-menu mt-3" aria-labelledby="dropdownMenuParametre">
                                            <li id="parametre">
                                                <a class="dropdown-item" href="{{route('affichage_parametre_cfp')}}">
                                                    <i class="bx bx-info-circle icon_plus  "></i>&nbsp; Information légales
                                                </a>
                                            </li>
                                            <li id="abo">
                                                <a class="dropdown-item" href="{{route('ListeAbonnement')}}">
                                                    <i class="bx bxl-sketch icon_plus"></i>&nbsp;Abonnement
                                                </a>
                                            </li>
                                            <li id="parametre">
                                                <a class="dropdown-item" href="{{route('parametrage_salle')}}">
                                                    <i class='bx bxs-door-open icon_plus'></i>&nbsp;Salle de formation
                                                </a>
                                            </li>
                                        </ul>
                                    @endcanany
                                @endcan
                                <a class="dropdown-toggle p-1" id="dropdownMenuSuite" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class='bx bx-grid-alt icon_creer_admin'></i></a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuSuite">
                                    <div class="card card_suite">
                                        <div class="card-body py-0">
                                            <div class="row">
                                                <div class="col-4 px-0 logo_suite">
                                                    @can('isManagerPrincipale')
                                                        <a href="{{route('profil_manager')}}" class="text-center justify-content-center d-flex flex-column"><i class='bx bxs-user-circle icone_compte '></i><span class="mt-1">compte</span></a>
                                                    @endcan
                                                    @can('isFormateurPrincipale')
                                                        <a href="{{route('profile_formateur')}}" class="text-center justify-content-center d-flex flex-column"><i class='bx bxs-user-circle icone_compte '></i><span class="mt-1">compte</span></a>
                                                    @endcan
                                                    @can('isStagiairePrincipale')
                                                        <a href="{{route('profile_stagiaire')}}" class="text-center justify-content-center d-flex flex-column"><i class='bx bxs-user-circle icone_compte '></i><span class="mt-1">compte</span></a>
                                                    @endcan
                                                    @canany(['isReferent','isReferentSimple'])
                                                        <a href="{{route('profil_referent')}}" class="text-center justify-content-center d-flex flex-column"><i class='bx bxs-user-circle icone_compte '></i><span class="mt-1">compte</span></a>
                                                    @endcanany
                                                    @can('isCFPPrincipale')
                                                        <a href="{{route('profil_du_responsable')}}" class="text-center justify-content-center d-flex flex-column"><i class='bx bxs-user-circle icone_compte '></i><span class="mt-1">compte</span></a>
                                                    @endcan
                                                </div>
                                                <div class="col-4 px-0 logo_suite">
                                                    <a href="#" class="text-center justify-content-center d-flex flex-column"><img src="{{asset('img/logos_all/iconFormation.webp')}}" alt="logo formation" width="35px" height="35px" class="img-responsive mb-2"><span>formation</span></a>
                                                </div>
                                                <div class="col-4 px-0 logo_suite">
                                                    <a href="#" class="text-center justify-content-center d-flex flex-column"><img src="{{asset('img/logos_all/iconPaie.webp')}}" alt="logo formation" width="35px" height="35px" class="img-responsive mb-2"><span>paie</span></a>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-4 px-0 logo_suite">
                                                    <a href="#" class="text-center justify-content-center d-flex flex-column"><img src="{{asset('img/logos_all/iconConge.webp')}}" alt="logo formation" width="35px" height="35px" class="img-responsive mb-2"><span>congé</span></a>
                                                </div>
                                                <div class="col-4 px-0 logo_suite">
                                                    <a href="#" class="text-center justify-content-center d-flex flex-column"><img src="{{asset('img/logos_all/iconPersonel.webp')}}" alt="logo formation" width="35px" height="35px" class="img-responsive mb-2"><span>personel</span></a>
                                                </div>
                                                <div class="col-4 px-0 logo_suite">
                                                    <a href="#" class="text-center justify-content-center d-flex flex-column"><img src="{{asset('img/logos_all/iconRecrutement.webp')}}" alt="logo formation" width="35px" height="35px" class="img-responsive mb-2"><span>recrutement</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a class="dropdown-toggle p-1" id="dropdownMenuProfil" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true"><i class='bx bx-user-circle icon_creer_admin'></i></a>
                                <div class="dropdown-menu p-0" aria-labelledby="dropdownMenuProfil">
                                    <div class="card card_profile pt-3">
                                        <div class="card-title">
                                            <div class="row px-3">
                                                <div class="col-7">
                                                    <span class="titre_card_profil"><img src="{{asset('img/logos_all/iconFormation.webp')}}" alt="logo_mini" title="logo formation.mg" width="30px" height="30px">Formation.mg</span>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <div class="logout">
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"></a>
                                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class=" text-center">Se déconnecter</a>
                                                        <form action="{{ route('logout') }}" id="logout-form" method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body p-0">
                                            <div class="row ps-4">
                                                <div class="col-2 ps-4">
                                                    <span>
                                                        <div style="display: grid; place-content: center">
                                                            <div class='randomColor photo_users' style="color:white; font-size: 20px; border: none; border-radius: 100%; height: 65px; width: 65px ; display: grid; place-content: center">
                                                            </div>
                                                        </div>
                                                    </span>
                                                </div>
                                                <div class="col-10 ps-4">
                                                    <h6 class="mb-0 ">{{Auth::user()->name}}</h6>
                                                    <h6 class="mb-0 text-muted text_mail">{{Auth::user()->email}}</h6>
                                                    <p id="nom_etp" class="mt-2"></p>
                                                </div>
                                            </div>
                                            <div class="row role_liste mt-2">
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col">
                                                            <input type="text" value="{{Auth::user()->id}}" id="id_user" hidden>
                                                            <span class="text-muted p-0 test_font">Connécté en tant que :</span>
                                                        </div>
                                                        <div class="col p-0">
                                                            <ul id="liste_role" class="d-flex flex-column"></ul>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-5">
                                                        <div class="d-flex flex-row py-0 justify-content-center">
                                                            <a href="{{url('politique_confidentialite')}}" target="_blank">
                                                                <p class="m-0 test_font2">Politique de confidentialité</p>
                                                            </a>
                                                            &nbsp;-&nbsp;
                                                            <a href="{{route('condition_generale_de_vente')}}" target="_blank">
                                                                <p class="m-0 test_font2">Conditions d'utilisation</p>
                                                            </a>
                                                        </div>
                                                        <div class="d-flex flex-row py-0 justify-content-center">
                                                            <a href="{{url('contacts')}}" target="_blank">
                                                                <p class="m-0 test_font2">Contactez-nous</p>
                                                            </a>
                                                            &nbsp;-&nbsp;
                                                            <a href="{{url('info_legale')}}" target="_blank">
                                                                <p class="m-0 test_font2">Informations légales</p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                @can('isCFP')
                    <div>
                        <div class="modal fade" id="nouveau_module" tabindex="-1"
                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <form action="{{route('nouveau_module_new')}}" method="POST" id="frm_new_module">
                                        @csrf
                                        <div class="modal-header .avertissement  d-flex justify-content-center"
                                            style="color: white">
                                            <h6 class="modal-title">Domaine de Formation</h6>
                                        </div>
                                        <div class="modal-body mb-3">
                                            <div class="form-group" >
                                                <select class="form-control select_formulaire input" id="acf-domaine" name="domaine" style="height: 40px;" required>
                                                    <option value="null" disable selected hidden>Choisissez la
                                                        domaine de formation ...</option>
                                                    @php
                                                        $data = $domaine->domaine();
                                                    @endphp
                                                    @foreach($data as $do)
                                                    <option value="{{$do->id}}" data-value="{{$do->nom_domaine}}">
                                                        {{$do->nom_domaine}}</option>
                                                    @endforeach
                                                </select>
                                                <label for="acf-domaine" class="form-control-placeholder mb-2">Domaine de Formation</label>
                                            </div>
                                            <div class="form-group mt-3" >
                                                <select class="form-control select_formulaire categ categ input" id="acf-categorie" name="categorie" style="height: 40px;" required>
                                                </select>
                                                <label for="acf-categorie" class="form-control-placeholder mb-2">Thématique par Domaine</label>
                                                <p id="domaine_id_err" class="text-danger">Choisir le domaine de formation valide</p>
                                            </div>
                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn_annuler" data-bs-dismiss="modal"><i class='bx bx-x me-1'></i>Non</button>
                                            <button type="submit" class="btn btn_enregistrer"><i class='bx bx-check me-1'></i>Créer votre module</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan

            </header>
            {{-- header --}}
            {{-- content --}}
            <div class="container-fluid content_body px-0 " style="padding-bottom: 1rem; padding-top: 4.5rem;">
                @yield('content')

            </div>
            {{-- content --}}
            {{-- footer --}}
            {{-- <div class="footer mt-5">
                <div class="container-fluid footer_all">
                    <div class="row w-100">
                        <div class="col-12">
                            <div class="container">
                                <div class="d-flex w-auto footer_one justify-content-center">
                                    <div class="footer_list me-2">
                                        <a href="#" class="mx-auto">
                                            <p>&copy;&nbsp;Copyright 2022 : Formation.mg</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="#">
                                            <p>Informations légales</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="{{url('contacts')}}" style="color: #801D62;text-decoration:none">
                                            <p>Contactez-nous</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="{{url('politique_confidentialite')}}" target="_blank">
                                            <p>Politique de confidentialité</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="{{route('condition_generale_de_vente')}}"
                                            style="color:#801D68 !important" target="_blank">
                                            <p>Conditions d'utilisation</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="#">
                                            <p>Tarifs</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="#">
                                            <p>Crédits</p>
                                        </a>
                                    </div>
                                    <div class="footer_list_end ms-2 me-2 text-muted">
                                        <p>1.01</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="apprendre mt-3">
                <div class="row">
                    <div class="col">
                        <p class="m-0 titre_apprendre"> Apprendre</p>
                    </div>
                    <div class="col text-end close" id="closeApprendre">
                        <!--<i class="bx bx-x " role="button" onclick="afficherTuto();"></i>-->
                        <i class="bx bx-x" role="button"></i>
                    </div>
                    <hr class="mt-2">
                    @can('isAdmin')
                    <div class="tutorielApprendreAdmin">Admin</div>
                    @endcan
                    @can('isCFP')
                    <div class="tutorielApprendreCfp">
                        <h5>Créer un nouveau projet de formation</h5>
                        <p class="m-0 p-1">
                            <span>Pour créer un nouveau de formation, il faut au préalable compléter les prérequis
                                suivant :</span>
                        </p>
                        <div class="list-group list-group-flush" id="accordion">
                            <li class="list-group-item align-items-start ">
                                <a class="accordion-toggle d-flex justify-content-between listeApprendre"
                                    id="accApprCat" data-bs-toggle="collapse" data-bs-parent="#accordion"
                                    href="#apprCat">
                                    <div class="ms-2 me-auto">
                                        <div class="text-sm">1. Avoir un catalogue de formation</div>
                                    </div>
                                    <span class="fas fa-angle-down"></span>
                                </a>
                                <div id="apprCat" class="collapse p-1">
                                    <hr>
                                    <a data-bs-toggle="modal" data-bs-target="#nouveau_module" role="button"><span>Cliquer ici pour ajouter un module à votre catalogue
                                            de formation</span></a>
                                </div>
                            </li>
                            {{-- <li class="list-group-item  align-items-start">
                                <a class="accordion-toggle d-flex justify-content-between listeApprendre"
                                    id="accApprForm" data-bs-toggle="collapse" data-bs-parent="#accordion"
                                    href="#apprFormateur">
                                    <div class="ms-2 me-auto">
                                        <div class="text-sm">2. Ajouter des formateurs</div>
                                    </div>
                                    <span class="fas fa-angle-down"></span>
                                </a>
                                <div id="apprFormateur" class="collapse  p-1">
                                    <hr>
                                    <a href="{{route('nouveau_formateur')}}"><span>Cliquer ici pour ajouter un formateur</span></a>
                                </div>
                            </li> --}}

                            <li class="list-group-item align-items-start listeApprendre">
                                <a class="accordion-toggle d-flex justify-content-between listeApprendre"
                                    id="accApprInter" data-bs-toggle="collapse" data-bs-parent="#accordion"
                                    href="#apprInter">
                                    <div class="ms-2 me-auto">
                                        <div class=" text-sm">2. Collaborer avec les entreprises qui ont des projets en
                                            commun avec vous </div>
                                    </div>
                                    <span class="fas fa-angle-down"></span>
                                </a>
                                <div id="apprInter" class="collapse">
                                    <hr>
                                    <a href="{{route('liste_entreprise')}}"><span>Cliquer ici pour collaborer avec une
                                            entreprise</span></a>
                                </div>
                            </li>
                        </div>
                    </div>
                    <div class="tutorielApprendre"></div>
                    @endcan
                    @can('isStagiaire')
                    <div class="tutorielApprendreStagiaire">Stagiaire</div>
                    @endcan

                    @canany(['isReferent','isReferentSimple'])
                    <div class="tutorielApprendreReferent">Referent</div>
                    @endcan

                    @can('isManager')
                    <div class="tutorielApprendreManager">Manager</div>
                    @endcan

                    @canany(['isFormateur','isFormateurInterne'])
                    <div class="tutorielApprendreFormateur">Formateur</div>
                    @endcanany
                    <!-- <h6 class="title_apprendre"><u>Annuaire</u></h6>
                        <h6 class="title_apprendre"><u>Agenda</u></h6> -->

                </div>
            </div>
            {{-- <div class="apprendre mt-3">
                <div class="row">
                    <div class="col">
                        <p class="m-0 titre_apprendre">Apprendre</p>
                    </div>
                    <div class="col text-end close" id="close">
                        <!--<i class="bx bx-x " role="button" onclick="afficherTuto();"></i>-->
                        <i class="bx bx-x" role="button"></i>
                    </div>
                    <hr class="mt-2">
                    @can('isAdmin')
                    <div class="tutorielApprendreAdmin">Admin</div>
                    @endcan
                    @can('isCFP')
                    <div class="tutorielApprendreCfp">
                        <h5>Créer un nouveau projet de formation</h5>
                        <p class="m-0 p-1">
                            <span>Pour créer un nouveau de formation, il faut au préalable compléter les prérequis
                                suivant :</span>
                        </p>
                        <ol class="list-group list-group-numbered list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-start listeApprendre">
                                <div class="ms-2 me-auto">
                                    <div class="text-sm">Avoir un catalogue de formation</div>
                                </div>
                                <button class="btn btn-light btn-sm apprCat" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#apprCat" aria-expanded="false" aria-controls="apprCat"><i
                                        class="fas fa-angle-down"></i></button>
                            </li>
                            <div id="apprCat" class="collapse p-2"><a href="/nouveau_module"><span>Cliquer ici pour
                                        ajouter un module à votre catalogue de formation</span></a></div>
                            <li class="list-group-item d-flex justify-content-between align-items-start listeApprendre">
                                <div class="ms-2 me-auto">
                                    <div class="text-sm">Ajouter des formateurs</div>
                                </div>
                                <button class="btn btn-light btn-sm apprCat" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#apprFormateur" aria-expanded="false" aria-controls=""><i
                                        class="fas fa-angle-down"></i></button>
                            </li>
                            <div id="apprFormateur" class="collapse p-2"><a href="nouveau_formateur"><span>Cliquer ici
                                        pour ajouter un formateur</span></a></div>

                            <li class="list-group-item d-flex justify-content-between align-items-start listeApprendre">
                                <div class="ms-2 me-auto">
                                    <div class=" text-sm">Collaborer avec les entreprises qui ont des projets en commun
                                        avec vous </div>
                                </div>
                                <button class="btn btn-light btn-sm apprCat " type="button" data-bs-toggle="collapse"
                                    data-bs-target="#apprInter" aria-expanded="false" aria-controls="apprInter"><i
                                        class="fas fa-angle-down"></i></button>
                            </li>
                            <div id="apprInter" class="collapse p-2"><a href="liste_entreprise"><span>Cliquer ici pour
                                        collaborer avec une entreprise</span></a></div>
                    </div>
                    @endcan
                    @can('isStagiaire')
                    <div class="tutorielApprendreStagiaire">Stagiaire</div>
                    @endcan

                    @can('isReferent')
                    <div class="tutorielApprendreReferent">Referent</div>
                    @endcan

                    @can('isManager')
                    <div class="tutorielApprendreManager">Manager</div>
                    @endcan

                    @can('isFormateur')
                    <div class="tutorielApprendreFormateur">Formateur</div>
                    @endcan
                    <!-- <h6 class="title_apprendre"><u>Annuaire</u></h6>
                        <h6 class="title_apprendre"><u>Agenda</u></h6> -->

                </div>
            </div> --}}

        </div>
        {{-- footer --}}
    </div>

    <script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.2/umd/popper.min.js"
        integrity="sha512-aDciVjp+txtxTJWsp8aRwttA0vR2sJMk/73ZT7ExuEHv7I5E6iyyobpFOlEFkq59mWW8ToYGuVZFnwhwIUisKA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js" integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="{{asset('js/admin.js')}}"></script>
    <script src="{{asset('js/apprendre.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script type="text/javascript">
        //Pour chaque div de classe randomColor
        $(".randomColor").each(function() {
        //On change la couleur de fond au hasard
            $(this).css("background-color", '#'+(Math.random()*0xFFFFFF<<0).toString(16).slice(-6));
        });

        $("#acf-domaine").change(function() {
            var id = $(this).val();
            $(".categ").empty();
            // $(".categ").append(
            //     '<option value="null" disable selected hidden>Choisissez la catégorie de formation ...</option>'
            // );

            $.ajax({
                url: "/get_formation",
                type: "get",
                data: {
                    id: id,
                },
                success: function(response) {
                    var userData = response;

                    if (userData.length > 0) {
                        document.getElementById("domaine_id_err").innerHTML = "";
                        for (var $i = 0; $i < userData.length; $i++) {
                            $(".categ").append(
                                '<option value="' + userData[$i].id + '" data-value="' + userData[$i].nom_formation + '" >' + userData[$i].nom_formation +"</option>"
                            );
                        }
                    } else {
                        document.getElementById("domaine_id_err").innerHTML =
                            "choisir le type de domaine valide pour avoir ses formations";
                    }
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        }
        $('.module_redirect').on('click', function (e) {
            localStorage.setItem('ActiveTabMod', '#publies');
        });

        $(document).ready(function() {

            var pdp = "";
            $.ajax({
                url: '{{ route("profile_resp") }}'
                , type: 'get'
                , success: function(response) {
                    if(response['photo'] == 'oui'){
                        var html = '<img src="{{asset(":?")}}" alt="user_profile" style="width : 70px; height : 70px; border: none; border-radius : 100%; display: grid; place-content: center">';
                        html = html.replace(":?", response['user']);
                        // alert(JSON.stringify(response));
                        $('.photo_users').append(html);

                    }
                    if(response['photo'] == 'non'){
                        var html = response['user'][0]['nm']+''+response['user'][0]['pr'];
                        $('.photo_users').append(html);
                    }
                    $('.badge_invitation').text("");
                    $('.badge_invitation').append(response['invitation'].length);

                    // var userData = JSON.parse(response);
                    // alert(JSON.stringify(response.length));
                    if(response['invitation'].length == 0){
                        // alert("eto");
                        var html = "Aucun invitations en attente";
                        $('.test_affiche1').append(html);
                        $('.test_affiche1').css('textAlign','center');

                    }else{
                        // alert("aiza");
                        for (let i = 0; i < response['invitation'].length; i++){
                            $('.test_affiche1').append('<li class="invitation_'+response['invitation'][i]['demmandeur_etp_id']+' text-center"><span class="me-2">'+response['invitation'][i]['nom_resp']+'</span><span class="me-2">'+response['invitation'][i]['prenom_resp']+'</span>|&nbsp;&nbsp;<span class="me-2">'+response['invitation'][i]['email_etp']+'</span>|&nbsp;&nbsp;<span class="me-2">'+response['invitation'][i]['nom_etp']+'</span>|&nbsp;&nbsp;<span>'+response['invitation'][i]['nom_secteur']+'</span> <span id="'+response['invitation'][i]['demmandeur_etp_id']+'" class="btn btn-sm accepte" title="accepter l\'invitation" role="button"><i class="bx bx-check-double bx_ajouter"></i></span> <span id="ref_'+response['invitation'][i]['demmandeur_etp_id']+'" class="btn refuse" title="refuser l\'invitation" role="button" data-id="'+response['invitation'][i]['demmandeur_etp_id']+'"><i class="bx bx-x bx_supprimer"></i></span></li>');

                            $(".accepte").on("click", function(e) {
                                let id = $(e.target).closest(".accepte").attr("id");
                                // alert(id);
                                $.ajax({
                                    type: "get",
                                    url: " {{ route('accept_invitation_cfp_etp_notif') }}",
                                    data: {
                                        Id: id,
                                    },
                                    success: function(response) {

                                        console.log(".invitation_" + id);
                                        $(".invitation_" + id).remove();
                                        $('.badge_invitation').text("");
                                        $('.badge_invitation').append(i);
                                        toastr.success('Une invitation a été accéptée');
                                    },
                                    error: function(error) {
                                    console.log(error);
                                    },
                                });
                            });


                            $(".refuse").on("click", function(e) {
                                let id = $(this).data("id");
                                $.ajax({
                                    type: "get",
                                    url: " {{ route('annulation_cfp_etp_notif') }}",
                                    data: {
                                        Id: id,
                                    },
                                    success: function(response) {
                                        // alert("success");
                                        // console.log(".invitation_" + id);
                                        $(".invitation_" + id).remove();
                                        $('.badge_invitation').text("");
                                        $('.badge_invitation').append(i);
                                        toastr.warning('Une invitation à été réfuser');
                                    },
                                    error: function(error) {
                                    console.log(error);
                                    },
                                });
                            });
                        }
                    }


                }
                , error: function(error) {
                    console.log(error);
                }
            });
        });

        $(document).ready(function() {
            $.ajax({
                url: '{{ route("aff_refuse_etp_cfp") }}'
                , type: 'get'
                , success: function(response) {
                    if(response['refuse_invitation'].length == 0){
                        var html = 'Aucun invitations refusée';
                        $('.test_affiche2').append(html);
                        $('.test_affiche2').css('textAlign','center');

                    }else{
                        // alert("aiza");
                        for (let i = 0; i < response['refuse_invitation'].length; i++){
                            $('.test_affiche2').append('<li class="invitation_'+response['refuse_invitation'][i]['demmandeur_etp_id']+' text-center"><span class="me-2">'+response['refuse_invitation'][i]['email_etp']+'</span>|&nbsp;&nbsp;<span class="me-2">'+response['refuse_invitation'][i]['nom_etp']+'</span>|&nbsp;&nbsp;<span>'+response['refuse_invitation'][i]['nom_secteur']+'</span></li>');
                        }
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        });

        $('.prevent_affichage').on('click', function(e){
            e.stopPropagation();
        });

        $('.prevent_affichage2').on('click', function(e){
            e.stopPropagation();
        });


    $(".nav .nav_linke").on("click", function(e){
        localStorage.setItem('indiceSidebar', this);
        $('a.active').removeClass('active');
    });

    $(".btn_racourcis a").on("click", function(e){
        localStorage.setItem('indiceSidebar', this);
        $('a.active').removeClass('active');
    });

    $("a.vous").on("click", function(e){
        localStorage.setItem('indiceSidebar', 'vous');
    });

    $("a.teste").on("click", function(e){
        localStorage.setItem('indiceSidebar', $(".nav").find("#accueil").get()[0].href);
    });

    $(".btn_creer li").on("click", function(e){
        if(''==this.id)localStorage.removeItem('indiceSidebar');
        else if (!$(".nav").find("."+this.id)) {
            localStorage.removeItem('indiceSidebar');
        }
        else if (this.id=="parametre") {
            localStorage.setItem('indiceSidebar', 'parametre');
        }
        else if($(".btn_racourcis").find("."+this.id).get()[0]){
            localStorage.setItem('indiceSidebar', $(".btn_racourcis").find("."+this.id).get()[0].href);
        }
        else if($(".nav").find("."+this.id).get()[0]){
            localStorage.setItem('indiceSidebar', $(".nav").find("."+this.id).get()[0].href);
        }
        else localStorage.removeItem('indiceSidebar');
    });

    $(".deconnexion").on("click", function(e){
        localStorage.clear();
    });

    if(!(localStorage.getItem('indiceSidebar')))localStorage.setItem('indiceSidebar', document.getElementById("accueil").href);

    let Tabactive = localStorage.getItem('indiceSidebar');
    if(Tabactive=="parametre")$('.btn_creer.parametre').addClass('active');
    else if(Tabactive=="vous")$('.btn_vous ').addClass('active');
    else if(Tabactive){
        ($('.nav_list a[href="' + Tabactive + '"]').closest('a')).addClass('active');
        ($('.btn_racourcis a[href="' + Tabactive + '"]').closest('div')).addClass('active');
    }
</script>
</body>

</html>