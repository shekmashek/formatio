<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" rel="stylesheet"
        integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />
    <link href='https://unpkg.com/boxicons@2.1.1/dist/boxicons.js' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">
</head>

<body>

    <div class="sidebar">
        <div class="logo_content">
            <div class="logo">
                <span><img src="{{asset('img/images/logo_fmg54Ko.png')}}" alt="" class="img-fluid"></span>
                <div class="logo_name"><a href="{{ route('home') }}">Formation.mg</a></div>
            </div>
            <i class="bx bx-menu" id="btn_menu" role="button" onclick="clickSidebar();"></i>
        </div>
        <ul class="nav_list mb-5" onclick="activer(event);" id="menu">

            <li>
                <a href="{{ route('home') }}" class="d-flex active nav_linke">
                    <i class="bx bxs-dashboard"></i>
                    <span class="links_name">Tableau de bord</span>
                </a>
                <span class="tooltip">Tableau de bord</span>
            </li>

            @canany(['isCFP','isFormateur'])
            <li>
                <a href="{{route('liste_module')}}" class="d-flex nav_linke">
                    <i class="bx bx-customize"></i>
                    <span class="links_name">Modules</span>
                </a>
                <span class="tooltip">Modules</span>
            </li>
            @endcanany
            {{-- entreprise --}}
            @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('liste_entreprise')}}" class="d-flex nav_linke">
                    <i class='bx bx-building-house'></i>
                    <span class="links_name">Entreprises</span>
                </a>
                <span class="tooltip">Entreprises</span>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouvelle_entreprise')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouvelle Entreprise</span>
                </a>
                <span class="tooltip">Nouvelle Entreprise</span>
            <li class="my-1 sousMenu">
                <a href="{{route('departement.index')}}">Département</a>
            </li>
            </li> --}}
            @endcanany
            @canany(['isReferent'])
            <li>
                <a href="{{route('liste_departement')}}" class="d-flex nav_linke">
                    <i class='bx bx-buildings'></i>
                    <span class="links_name">Departements</span>
                </a>
                <span class="tooltip">Departements</span>
            </li>
            @endcanany
            @can('isCFP')
            <li>
                <a href="{{route('liste_entreprise')}}" class="d-flex nav_linke">
                    <i class='bx bx-building-house'></i>
                    <span class="links_name">Entreprises</span>
                </a>
                <span class="tooltip">Entreprises</span>
            </li>
            @endcan
            @can('isReferent')
            <li>
                <a href="{{route('list_cfp')}}" class="d-flex nav_linke">
                    <i class='bx bxs-business'></i>
                    <span class="links_name">Organisme</span>
                </a>
                <span class="tooltip">Organisme</span>
            </li>
            @endcan
            {{-- projet de formation --}}
            @canany(['isSuperAdmin'])
            <li>
                <a href="{{route('liste_projet')}}" class="d-flex nav_linke">
                    <i class='bx bx-library'></i>
                    <span class="links_name">Projets</span>
                </a>
                <span class="tooltip">Projets</span>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_projet')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Projet</span>
                </a>
                <span class="tooltip">Nouveau Projet</span>
            <li class="my-1 sousMenu">
                <a href="{{route('liste_groupe')}}">Groupes</a>
            </li>
            </li> --}}
            @endcanany
            @canany(['isCFP','isFormateur'])
            <li>
                <a href="{{route('accueil_projet')}}" class="d-flex nav_linke">
                    <i class='bx bx-library'></i>
                    <span class="links_name">Projets</span>
                </a>
                <span class="tooltip">Projets</span>
            </li>
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
            </li> --}}
            @endcanany
            @canany(['isReferent'])
            <li>
                <a href="{{route('accueil_projet')}}" class="d-flex nav_linke">
                    <i class='bx bx-library'></i>
                    <span class="links_name">Projets</span>
                </a>
                <span class="tooltip">Projets</span>
            </li>
            @endcanany
            {{-- utilisateurs --}}
            @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('liste_utilisateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Referent</span>
                </a>
                <span class="tooltip">Referent</span>
            </li>
            <li>
                <a href="{{route('utilisateur_stagiaire')}}" class="d-flex nav_linke">
                    <i class='bx bx-user-circle'></i>
                    <span class="links_name">Stagiaires</span>
                </a>
                <span class="tooltip">Stagiaires</span>
            </li>
            <li>
                <a href="{{route('utilisateur_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Formateurs</span>
                </a>
                <span class="tooltip">Formateurs</span>
            </li>
            @endcanany
            {{-- formateurs --}}
            @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('liste_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Formateurs</span>
                </a>
                <span class="tooltip">Formateurs</span>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Formateur</span>
                </a>
                <span class="tooltip">Nouveau Formateur</span>
            </li> --}}
            @endcanany
            @canany(['isCFP'])
            <li>
                <a href="{{route('liste_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Formateurs</span>
                </a>
                <span class="tooltip">Formateurs</span>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_formateur')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Formateur</span>
                </a>
                <span class="tooltip">Nouveau Formateur</span>
            </li> --}}
            @endcanany
            {{-- manager --}}
            @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('employes')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Manager</span>
                </a>
                <span class="tooltip">Manager</span>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_manager')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Manager</span>
                </a>
                <span class="tooltip">Nouveau Manager</span>
            </li> --}}
            @endcanany
            @canany(['isReferent'])
            <li>
                <a href="{{route('employes')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Manager</span>
                </a>
                <span class="tooltip">Manager</span>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_manager')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Manager</span>
                </a>
                <span class="tooltip">Nouveau Manager</span>
            </li> --}}
            @endcanany
            {{-- Referent --}}
            @canany(['isAdmin','isSuperAdmin'])
            <li>
                <a href="{{route('liste_responsable')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Réferents</span>
                </a>
                <span class="tooltip">Réferents</span>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_responsable')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Réferents</span>
                </a>
                <span class="tooltip">Nouveau Réferents</span>
            </li> --}}
            @endcanany
            {{-- stagiares --}}
            @canany(['isSuperAdmin'])
            <li>
                <a href="{{route('liste_participant')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Stagiaires</span>
                </a>
                <span class="tooltip">Stagiaires</span>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_participant')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Stagiaire</span>
                </a>
                <span class="tooltip">Nouveau Stagiaire</span>
            </li> --}}
            @endcanany
            @canany(['isReferent'])
            <li>
                <a href="{{route('liste_participant')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-rectangle'></i>
                    <span class="links_name">Stagiaires</span>
                </a>
                <span class="tooltip">Stagiaires</span>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('nouveau_participant')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Nouveau Stagiaire</span>
                </a>
                <span class="tooltip">Nouveau Stagiaire</span>
            </li> --}}
            @endcanany
            {{-- action de formations --}}

            @canany(['isFormateur'])
            <li>
                <a href="{{route('presence.index')}}" class="d-flex nav_linke">
                    <i class='bx bx-list-check'></i>
                    <span class="links_name">Emargement</span>
                </a>
                <span class="tooltip">Emargement</span>
            </li>
            @endcanany

            {{-- calendrire de formations --}}
            <li>
                <a href="{{route('calendrier')}}" class="d-flex nav_linke">
                    <i class='bx bxs-calendar'></i>
                    <span class="links_name">Calendrier</span>
                </a>
                <span class="tooltip">Calendrier</span>
            </li>

            {{-- commercial --}}
            @canany(['isSuperAdmin','isCFP','isReferent'])
            <li>
                <a href="{{route('collaboration')}}" class="d-flex nav_linke">
                    <i class='bx bxs-user-account'></i>
                    <span class="links_name">Coopération</span>
                </a>
                <span class="tooltip">Coopération</span>
            </li>
            @endcanany
            @canany(['isCFP','isReferent'])
            <li>
                <a href="{{route('facture')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Factures</span>
                </a>
                <span class="tooltip">Factures</span>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('liste_facture')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Total facture</span>
                </a>
                <span class="tooltip">Total facture</span>
            </li> --}}

            @endcanany
            {{-- competence --}}
            @canany(['isSuperAdmin','isReferent','isManager'])
            @canany(['isReferent'])
            <li>
                <a href="{{route('demande_test_niveau')}}" class="d-flex nav_linke">
                    <i class='bx bx-network-chart'></i>
                    <span class="links_name">Aptitudes</span>
                </a>
                <span class="tooltip">Aptitudes</span>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('liste_facture')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Total facture</span>
                </a>
                <span class="tooltip">Total facture</span>
            </li> --}}
            @endcanany
            <li>
                <a href="{{route('liste_projet')}}" class="d-flex nav_linke">
                    <i class='bx bxs-doughnut-chart'></i>
                    <span class="links_name">Compétence</span>
                </a>
                <span class="tooltip">Compétence</span>
            </li>
            @endcanany

            {{-- plan de formation --}}
            @canany(['isSuperAdmin','isStagiaire','isManager','isReferent'])
            <li>
                <a @canany(['isStagiaire']) href="{{route('planFormation.index')}}" @endcanany
                    href="{{route('liste_projet')}}" class="d-flex nav_linke">
                    <i class='bx bx-scatter-chart'></i>
                    <span class="links_name">Plan</span>
                </a>
                <span class="tooltip">Plan</span>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('listePlanFormation')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Liste Plan</span>
                </a>
                <span class="tooltip">Liste Plan</span>
            </li> --}}
            @endcanany
            {{-- abonemment --}}
            @canany(['isSuperAdmin','isAdmin'])
            <li>
                <a href="{{route('listeAbonne')}}" class="d-flex nav_linke">
                    <i class='bx bxl-sketch'></i>
                    <span class="links_name">Abonnées</span>
                </a>
                <span class="tooltip">Abonnées</span>
            </li>
            {{-- integrer dans la page
            <li>
                <a href="{{route('abonnement.index')}}" class="d-flex nav_linke">
                    <i class='bx bxs-bank'></i>
                    <span class="links_name">Abonnement</span>
                </a>
                <span class="tooltip">Abonnement</span>
            </li> --}}
            @endcanany
            @can('isReferent')
            <li>
                <a href="{{route('ListeAbonnement')}}" class="d-flex nav_linke">
                    <i class='bx bxl-sketch'></i>
                    <span class="links_name">Abonnement</span>
                </a>
                <span class="tooltip">Abonnement</span>
            </li>
            @endcan
            @can('isSuperAdmin')
            <li>
                <a href="{{route('categorie')}}" class="d-flex nav_linke">
                    <i class='bx bx-book'></i>
                    <span class="links_name">Catégories</span>
                </a>
                <span class="tooltip">Catégories</span>
            </li>
            @endcan
            <li>
                <a href="{{route('recherche_admin')}}" class="d-flex nav_linke">
                    <i class='bx bxs-notepad'></i>
                    <span class="links_name">Reporting</span>
                </a>
                <span class="tooltip">Reporting</span>
            </li>
            @can('isCFP')
            {{-- <li>
                <a href="{{route('gestion_documentaire')}}" class="d-flex nav_linke">
                    <i class='bx bx-book-add'></i>
                    <span class="links_name">Librairies</span>
                </a>
                <span class="tooltip">Librairies</span>
            </li> --}}
            <li>
                <a href="#" class="d-flex nav_linke">
                    <i class='bx bx-book-add'></i>
                    <span class="links_name">Librairies</span>
                </a>
                <span class="tooltip">Librairies</span>
            </li>
            @endcan
        </ul>
        <br>
        <br>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img src="{{asset('images/formateurs/RAHARIFETRANicole22-12-2021.png')}}" class="img-fluid"
                        alt="user_profile">
                    <div class="name_job">
                        <div class="name">Malala</div>
                        <div class="job">Manager</div>
                    </div>
                </div>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                    <i class="bx bx-log-out" id="log_out"></i></a>
            </div>
        </div>

    </div>

    <div class="home_content">
        <div class="container-fluid ps-0 height-100 bg-light" id="content" style="padding-top: 1rem">
            <!-- <div class="text">Home</div> -->
            {{-- header --}}
            <header class="header row align-items-center g-0" id="header">
                <div class="col-5">
                    <div>
                        @yield('title')
                    </div>
                </div>

                <div class="col-7 header-right align-items-center d-flex flex-row">
                    <div class="col mt-3 d-flex flex-row">
                        <div class="notification-box">
                            <span class="count-notif">6</span>
                            <div class="notification-bell">
                                <i class="bx bxs-bell bell_move" id="bell" style="color: #637381;"></i>
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
                                <i class='bx bxs-envelope ms-5 bell_move' id="envelope" style="color: #637381;"></i>
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
                    <div class="col d-flex flex-row" style="align-items: left; text-align:center">
                        <div class="header_etp_cfp d-flex flex-row" style="">
                            <p class="ms-2"><i class='bx bx-building-house' style="color: #801D68;"></i>
                            </p>
                            <p style="text-transform: capitalize; text-align: center;color: #801D68">&nbsp;Numerika</p>
                            &nbsp;&nbsp;&nbsp;
                            <div class="d-flex pro_plan">
                                <p class=""><i class='bx bxl-sketch m-0 p-0' style=" font-size: 24px"></i></p>
                                <p class="" style="text-transform: capitalize; margin-top: 0.1rem">&nbsp;&nbsp;rubi</p>
                            </div>
                        </div>
                        <div class="pdp_etp_cfp" id="box_etp_cfp">
                            <div class="container pdp_etp_cfp_card ">
                                <div class="card">
                                    <div class="card-title">
                                        <h6 class="mb-0 text-center">Numerika</h6>
                                        <hr class="m-0">
                                    </div>
                                    <div class="card-body">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- user --}}
                    <div class="col">
                        <div class="header_img ms-5 mb-2 text-center d-flex flex-row" style="text-align: center">
                            <p><i class='bx bx-user-circle' style="color: #801D68; font-size: 24px"></i></p>
                            <p style="text-transform: capitalize;color:#801D68" class="header_img_name">
                                &nbsp;{{Auth::user()->name}}</p>
                        </div>
                        <div class="pdp_profil" id="box_profil">
                            <div class="container pdp_profil_card ">
                                <div class="card">
                                    <div class="card-title">
                                        <h6 class="mb-0 text-center">{{Auth::user()->name}}</h6>
                                        <hr class="m-0">
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center">
                                            <input type="text" value="{{Auth::user()->id}}" id="id_user" hidden>
                                        <ul id="liste_role">
                                            Accès:
                                        </ul>
                                            {{-- @if(Auth::user()->role_id == 1)
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
                                            @endif --}}

                                        </div>
                                        <div class="text-center">
                                            @can('isManagerPrincipale')
                                            <a href="{{route('affProfilChefDepartement')}}"><button class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                                            @endcan
                                            @can('isFormateurPrincipale')
                                            <a href="{{route('profile_formateur')}}"><button
                                                    class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                                            @endcan
                                            @can('isStagiairePrincipale')
                                            <a href="{{route('profile_stagiaire')}}"><button class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                                            @endcan
                                            @can('isReferentPrincipale')
                                            <a href="{{route('affResponsable')}}"><button class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                                            @endcan
                                            @can('isCFPPrincipale')
                                            <a href="{{route('affResponsableCfp')}}"><button class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                                            @endcan
                                        </div>
                                        {{-- <div class="text-center">
                                            @can('isManager')
                                            <a href="{{route('affProfilChefDepartement')}}"><button
                                                    class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                                            @endcan
                                            @can('isStagiaire')
                                            <a href="{{route('profile_stagiaire')}}"><button
                                                    class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                                            @endcan
                                            @can('isReferent')
                                            <a href="{{route('affResponsable')}}"><button
                                                    class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                                            @endcan
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- logout --}}
                    <div class="col">
                        <div class="text_resp ms-5 me-5 pt-1 d-flex flex-row">
                            <p><a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="deconnexion_text"><i
                                        class='bx bx-log-out' style="color :#801D68;font-size:24px;"></i></a></p>
                            <p><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"
                                    class="deconnexion_text">&nbsp;&nbsp;<span>Déconnexion</span></a>
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
            <div class="container-fluid content_body" style="padding-bottom: 2.5rem; padding-top: 3.5rem;">
                @yield('content')
            </div>
            {{-- content --}}
            {{-- footer --}}
            <div class="footer mt-5">
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
                                        <a href="#">
                                            <p>Politique de confidentialité</p>
                                        </a>
                                    </div>
                                    <div class="footer_list ms-2 me-2">
                                        <a href="{{route('condition_generale_de_vente')}}"
                                            style="color:#801D68 !important" target="_blank">
                                            <p>Condition d'utilisation</p>
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
            </div>
            {{-- footer --}}
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.2/umd/popper.min.js"
        integrity="sha512-aDciVjp+txtxTJWsp8aRwttA0vR2sJMk/73ZT7ExuEHv7I5E6iyyobpFOlEFkq59mWW8ToYGuVZFnwhwIUisKA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"
        integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="{{asset('js/admin.js')}}"></script>
</body>

</html>