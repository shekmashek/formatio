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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js">
    <link rel="stylesheet" href="{{asset('css/profil_formateur.css')}}">

    <link rel="icon" href="{{asset('img/logo_numerika/logonmrk.png')}}" sizes="90x60" type="image/png">
    <title>{{ config('app.name', 'Laravel') }}</title>
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
    <link rel="stylsheet" href="https://code.jquery.com/jquery-3.4.1.min.js">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>



</head>
<body id="body-pd">
    <header class="header row align-items-center g-0" id="header">
        <div class="col-5">
            <div class="header_toggle d-flex first_nav ">
                <i class='bx bx-menu menu' id="header-toggle" style="color: white;"></i>
                <div>
                    @yield('title')
                </div>
            </div>
        </div>
        <div class="col-4">

        </div>
        <div class="col-3 header-right align-items-center d-flex flex-row">
            <div class="notification-box">
                <span class="count-notif">6</span>
                <div class="notification-bell">
                    <i class="bx bxs-bell bell_move" id="bell" style="color: white;"></i>
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
                    <i class='bx bxs-envelope ms-5 bell_move' id="envelope" style="color: white;"></i>
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
            <div class="header_img ms-5 mb-2"><a href=""><img src="" alt="" class="utilisateur" id="photo_profil"></a></div>
            <div class="pdp_profil" id="box_profil">
                <div class="container pdp_profil_card d-flex justify-content-center align-items-center">
                    <div class="card">
                        <div class="upper"></div>
                        <div class="user text-center">
                            <div class="profile"> <img src="{{asset('images/entreprises/TEST15-11-2021.png')}}" class="rounded-circle" width="80"> </div>
                        </div>
                        <div class="mt-5 text-center">
                            <h4 class="mb-0">{{Auth::user()->name}}</h4>
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
                            @can('isManager')
                            <a href="{{route('affProfilChefDepartement')}}"><button class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                            @endcan
                            @can('isStagiaire')
                            <a href="{{route('profile_stagiaire')}}"><button class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                            @endcan
                            @can('isReferent')
                            <a href="{{route('affResponsable')}}"><button class="btn btn-primary btn-sm profil_btn mt-5 mb-3">Profil</button></a><br>
                            @endcan

                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><span class="deconnexion_text">Déconnexion</span></a>
                            <form action="{{ route('logout') }}" id="logout-form" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="l-navbar" id="nav-bar">
        <div class="container-fluid ">
            <nav class="nav">
                <div class="d-flex align-items-center justify-content-space-between ms-3 img"><a href="{{ route('accueil_admin') }}" class="d-flex align-items-center"><img src="{{asset('img/images/logo_fmg.png')}}" id="img" class="img-fluid logo" alt="logo">&nbsp;<span class="d-flex textS">FORMATION.MG</span></a></div>
                <div class="nav_list">
                    <ul class="lisst-unstyled p-0">
                        {{-- categorie de formation --}}
                        <li class="">
                            <a href="#categSubmenu" data-toggle="collapse" aria-expanded="false" class="nav_linke active dropdown-toggle liste"><i class='bx bx-home-smile nav_icon'></i><span class="nav_name">Catalogue</span></a>@canany(['isCFP','isSuperAdmin','isAdmin','isFormateur'])&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouvelle_formation')}}"><i class='bx bxs-plus-circle nouveau_icon' title="nouveau formation"></i></a>@endcanany
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
                        @can('isCFP')
                        <li class="my-2">
                            <a href="{{route('liste_entreprise')}}" class="nav_linke liste"><i class='bx bx-building-house nav_icon'></i><span class="nav_name">Entreprises</span></a>
                        </li>
                        @endcan

                        {{-- projet de formation --}}
                        @canany(['isCFP','isSuperAdmin'])
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
                        @can('isReferent')
                        <li class="my-2">
                            <a href="{{route('liste_projet')}}" class="nav_linke liste"><i class='bx bxl-product-hunt nav_icon'></i><span class="nav_name">Projets</span></a>
                        </li>
                        @endcan
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
                        @canany(['isCFP','isSuperAdmin','isAdmin'])
                        <li class="my-2">
                            <a href="#frmtSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class="bx bx-user nav_icon"></i><span class="nav_name">Formateurs</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouveau_formateur')}}"><i class='bx bxs-user-plus nouveau_icon' title="nouveau formateur"></i></a>
                            <ul class="collapse lisst-unstyled submenuColor" id="frmtSubMenu">
                                <li class="my-1 sousMenu">
                                    <a href="{{route('liste_formateur')}}">Formateurs</a>
                                </li>
                            </ul>
                        </li>
                        @endcanany

                        {{-- manager --}}
                        @canany(['isSuperAdmin','isReferent','isAdmin'])
                        <li class="my-2" style="width: 100%;">
                            <a href="#mngrSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-male nav_icon'></i><span class="nav_name">Manager</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouveau_manager')}}"><i class='bx bxs-user-plus nouveau_icon' title="nouveau chef departement"></i></a>
                            <ul class="collapse lisst-unstyled submenuColor" id="mngrSubMenu">
                                <li class="my-1 sousMenu">
                                    <a href="{{route('liste_chefDepartement')}}">Chefs Départements</a>
                                </li>
                            </ul>
                        </li>
                        @endcanany

                        {{-- Referent --}}
                        @canany(['isCFP','isAdmin','isSuperAdmin'])
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
                        @canany(['isSuperAdmin','isReferent'])
                        <li class="my-2">
                            <a href="#stgrSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bxs-group nav_icon'></i><span class="nav_name">Participants</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('nouveau_participant')}}"><i class='bx bxs-user-plus nouveau_icon' title="nouveau stagiaire"></i></a>
                            <ul class="collapse lisst-unstyled submenuColor" id="stgrSubMenu">
                                <li class="my-1 sousMenu">
                                    <a href="{{route('liste_participant')}}">Stagiaires</a>
                                </li>
                            </ul>
                        </li>
                        @endcanany

                    {{-- action de formations --}}
                    @canany(['isSuperAdmin','isCFP','isReferent','isFormateur','isStagiaire'])
                    <li class="my-2">
                        <a href="#actfSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-line-chart nav_icon'></i><span class="nav_name">Sessions</span></a>@canany(['isSuperAdmin','isCFP','isReferent'])&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{route('execution')}}"><i class='bx bxs-plus-circle nouveau_icon' title="nouveau session"></i></a>@endcanany
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
                    @endcanany
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
                    @canany(['isCFP','isSuperAdmin','isAdmin','isReferent'])
                    <li class="my-2">
                        <a href="{{route('liste_facture',3)}}" class="nav_linke liste"><i class='bx bxs-wallet-alt nav_icon'></i><span class="nav_name">Factures</span></a>
                    </li>
                    @endcanany
                    {{-- competence --}}
                    @canany(['isSuperAdmin','isReferent','isManager'])
                    <li class="my-2">
                        <a href="#gstcpSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-list-minus nav_icon'></i><span class="nav_name">Aptitude</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{ route('demande_test_niveau')}}"><i class='bx bxs-plus-circle nouveau_icon' title="Demande test de niveau"></i></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="gstcpSubMenu">
                            <li class="my-1 sousMenu">
                                <a href="{{ route('tableau_competence') }}">Tableau de compétence</a>
                            </li>
                        </ul>
                    </li>
                    @endcanany

                    {{-- plan de formation --}}
                    @canany(['isSuperAdmin','isReferent','isManager','isStagiaire'])
                    <li class="my-2">
                        <a @canany(['isStagiaire']) href="{{route('liste_demande_formation')}}"@endcanany href="#pdfrmSubMenu" data-toggle="collapse" aria-expanded="false" class="nav_linke dropdown-toggle liste"><i class='bx bx-list-plus nav_icon'></i><span class="nav_name">Plan</span></a>&nbsp;&nbsp;<a class='nouveau_icon_lien' href="{{ route('ajout_plan') }}"><i class='bx bxs-plus-circle nouveau_icon' title="nouveau plan de formation"></i></a>
                        <ul class="collapse lisst-unstyled submenuColor" id="pdfrmSubMenu">
                            @canany(['isSuperAdmin','isReferent','isManager'])
                            <li class="my-1 sousMenu">
                                <a href="{{route('liste_demande_stagiaire')}}">Demandes</a>
                            </li>
                            <li class="my-1 sousMenu">
                                <a href="{{ route('listePlanFormation') }}">Plans de Formations</a>
                            </li>
                            @endcanany
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
                    @can('isReferent')
                    <li class="my-2">
                        <a href="{{route('ListeAbonnement')}}" class="nav_linke liste"><i class='bx bxl-sketch nav_icon'></i><span class="nav_name">Abonnement</span></a>
                    </li>
                    @endcan

                    </ul>
                </div>
                <div>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"><i class='bx bx-log-out-circle nav_icon_logout mx-4' title="Déconnexion"></i></a>
                </div>
            </nav>
        </div>
    </div>
    <!--Container Main start-->
    <div class="container-fluid height-100 bg-light" id="content" style="padding-top: 1rem">
        @yield('content')
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
    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('assets/js/metisMenu.min.js')}}"></script>

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
</body>

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
        });
    });

</script>
</html>
