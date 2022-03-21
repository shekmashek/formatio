<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    {{-- Lien font awesome icons --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('assets/css/index_accueil.css')}}">
    <script src="{{ asset('maquette/javascript.js') }}"></script>
    <link rel="shortcut icon" href="{{  asset('maquette/real_logo.ico') }}" type="image/x-icon">
    <title> Formation.mg </title>
</head>
<body>
    {{-- <button type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
        <i class="far fa-arrow-up"></i>
    </button> --}}
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top pb-0" >
            <div class="container-fluid">
                <div class="left_menu ms-2">
                    <p class="titre_text m-0 p-0"><img class="img-fluid" src="{{ asset('maquette/logo_fmg54Ko.png') }}" > Formation.mg</p>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown icon_background">
                            <a class="nav-link dropdown-toggle links" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Fonctionnalités</a>
                            <ul class="dropdown-menu p-3" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item pt-2" href="{{url('moderne')}}" target="_blank"><i class="far fa-mouse-pointer center icon_back"></i> &nbsp; Moderne, flexible et sécurusé</a></li>
                                <li><a class="dropdown-item pt-2" href="{{url('gestiond')}}" target="_blank"><i class="fad fa-file-alt icon_back2"></i> &nbsp; Gestion docummentaire</a></li>
                                {{-- <li><hr class="dropdown-divider"></li> --}}
                                <li><a class="dropdown-item pt-2" href="{{url('gestionf')}}" target="_blank"><i class="fad fa-euro-sign icon_back3"></i> &nbsp; Gestion financière</a></li>
                                <li><a class="dropdown-item pt-2" href="{{url('gestiona')}}" target="_blank"><i class="fad fa-calendar-check icon_back4"></i>&nbsp; Gestion administrative</a></li>
                                <li><a class="dropdown-item pt-2" href="{{url('gestionc')}}" target="_blank"><i class="far fa-user icon_back5"></i>&nbsp; Gestion commerciale</a></li>
                                <li><a class="dropdown-item pt-2" href="{{url('qualite')}}" target="_blank"><i class="fad fa-clipboard icon_back6"></i>&nbsp; Qualité</a></li>
                                <li><a class="dropdown-item pt-2" href="{{url('communication')}}" target="_blank"><i class="fad fa-comments-alt icon_back7"></i>&nbsp; Communication</a></li>
                                <li><a class="dropdown-item pt-2" href="{{url('elearning')}}" target="_blank"><i class="fad fa-laptop icon_back8"></i>&nbsp; E-learning</a></li>
                                <li><a class="dropdown-item pt-2" href="{{url('fonctionnalitea')}}" target="_blank"><i class="fad fa-search icon_back9"></i>&nbsp; Fonctionnalités avancées</a></li>
                            </ul>
                        </li>

                        <li class="nav-item ms-2">
                            <a class="nav-link links " href="{{url('tarifs')}}" target="_blank">Tarifs</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link links" href="#">À propos</a>
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link links" href="{{url('contact')}}" target="_blank">Contactez-nous</a>
                        </li>

                    </ul>
                    <div class="menu_action">
                        <ul class="d-flex">
                            <li class="nav-item">
                                <a href="{{ route('sign-in') }}" class="btn_login me-2" role="button">Se connecter</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('create+compte+client')}}" class="btn_creerCompte me-2" role="button">Créer un compte</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="mt-5 mb-5">
        {{-- <div class=" p-5 m-0 container-fluid" style="font-size: 14px">
            <div class="row ">
                <div class="p-0 col-lg-6">
                    <div class="shadow p-3 mb-4 bg-body rounded" style="height: 160px">
                        <div class="row ">
                            <div class="col" align="center">
                                <p class="p-0 mt-0 m-0">Plateforme collaboratif de gestion de formation</p>
                                <p style="font-size: 10px; color: rgb(158, 157, 157)">
                                    La première plateforme malagasy
                                    de gestion de formation,<br> outil
                                    incontournable et innovateur du milieu professionnel.
                                </p><br>
                                <a href="{{url('tarifs')}}" style="color: #9d76dc;font-size: 11px;">&nbsp; Voir plus >&nbsp;</a>
                            </div>
                            <div class="col " align="center">
                                <p style="font-size: 10px; margin:0; color: rgb(158, 157, 157)"> - Centre de formation </p>
                                <p style="font-size: 10px;margin:0; color: rgb(158, 157, 157)"> - Formateur</p>
                                <p style="font-size: 10px;margin:0; color: rgb(158, 157, 157)"> - Référent</p>
                                <p style="font-size: 10px;margin:0; color: rgb(158, 157, 157)"> - Apprenant</p>
                                <p style="font-size: 10px;margin:0; color: rgb(158, 157, 157)"> - Manager </p>
                                <a style="background-color: #9d76dc; color:white; font-size: 12px; margin-top: 15px " class="btn" href="{{url('contact')}}" target="_blank">Contactez notre service commerciale</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" p-0 col-lg-6">
                    <div class=" ms-3 shadow p-3 mb-0 bg-body rounded">
                        <div class="row ">
                            <div class="col" align="center">
                                <p class="p-0 mt-0 m-0">Demander une demonstration</p>
                                <p style="font-size: 10px;  color: rgb(158, 157, 157)">
                                    Envie de tester les fonctionnalités de Formation.mg?<br>
                                    Contactez notre équipe commerciale et prenez rendez-vous.
                                    Nous serons ravis de vous faire découvrir les horizons de notre logiciel et en quoi il vous est indispensable.
                                </p>
                                <a href="{{url('tarifs')}}" style="color: #9d76dc;;font-size: 11px">&nbsp; Voir plus >&nbsp;</a>
                            </div>
                            <div class="col" align="center">
                                <img class=" img-fluid" src="{{ asset('maquette/demos.jpg') }}" alt="" style="height:70px; width:130px"><br>
                                <a style="background-color: #9d76dc;; color:white; font-size: 11px " class=" btn mb-2 mt-4" href="">Demander une demo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="p-0 col-lg-6">
                    <div class=" shadow p-3 mb-4 bg-body rounded">
                        <div class="row ">
                            <div class="col" align="center">
                                <p class="p-0 mt-0 m-0">Vous êtes un organisme de formation ?</p>
                                <p style="font-size: 10px;  color: rgb(158, 157, 157)">
                                    Disposez d’une base de données centralisée,<br> gagnez en temps et en économie.
                                    Retrouvez tout ce dont vous avez besoin dans un seul et unique endroit : la gestion de vos formations (session , exécution ...),
                                    vos facturations, vos devis, votre espace professionnel ( dressage et modification de vos catalogues).<br>
                                    Investissez dans le futur ! <br> Digitalisez votre activité et ayez une longueur d’avance sur les autres.<br>
                                    Améliorez votre communication et votre suivi commercial.<br>
                                    Rapprochez-vous de vos clients, envoyez leurs des évaluations digitalisées et personnalisables et obtenez des feedbacks instantanés
                                </p>
                                <a href="{{url('tarifs')}}" style="color: #9d76dc;;font-size: 11px">&nbsp; Voir plus >&nbsp;</a>
                            </div>
                            <div class="col" align="center">
                                <img class=" img-fluid" src="{{ asset('maquette/demos.jpg') }}" alt="" style="height:90px; width:130px"><br>
                                <a style="background-color: #9d76dc;; color:white; font-size: 11px; " class=" btn mb-2 mt-5" href="{{route('create+compte+client')}}">Creer un compte pro</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-0 col-lg-6">
                    <div class=" ms-3 shadow p-3 mb-0 bg-body rounded" style="height: 237px">
                        <div class="row ">
                            <div class="col" align="center">
                                <p class="p-0 mt-0 m-0">Vous êtes employeur ?</p>
                                <p style="font-size: 10px;  color: rgb(158, 157, 157)">
                                    Accès facile, sécurisé et instantané. <br>
                                    Accédez facilement au marché des formations professionnelles et trouvez ce dont vous avez besoin sans vous déplacer.<br>
                                    Solution ergonomique à vos problèmes quotidiens ! <br>
                                    Gérez votre entreprise ( dépenses, budgets, personnel, factures, données, évaluations du personnel,...) n'importe où,
                                    à n'importe quel moment via formation.mg et dites adieu à vos tâches administratives redondantes et ennuyeuses,
                                    les archives en paperasse volumineuses,...
                                </P>
                                <a href="{{url('tarifs')}}" style="color: #9d76dc;;font-size: 11px">&nbsp; Voir plus >&nbsp;</a>
                            </div>
                            <div class="col" align="center">
                                <img class=" img-fluid" src="{{ asset('maquette/formation.jpg') }}" alt="" alt="" style="height:100px; width:130px"><br>
                                <a style="background-color: #9d76dc; color:white; font-size: 11px; margin-top: 35px" class=" btn mb-2 " href="{{route('create+compte+client')}}">Creer un compte pro</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </main>
    <footer class="footer_all">
        <div class="d-flex justify-content-center align-items-center pt-3">
            <div class="bordure">&copy; Copyright 2022</div>
            <div class="bordure"><a href="{{url('info_legale')}}" target="_blank">Informations légales</a></div>
            <div class="bordure"><a href="{{url('contact')}}" target="_blank">Contactez-nous</a></div>
            <div class="bordure"><a href="{{url('politique_confidentialites')}}" target="_blank">Politique de confidentialités</a></div>

            <div class="bordure"> <a href="{{route('condition_generale_de_vente')}}" target="_blank"> Condition d'utilisation</a> </div>
            <div class="bordure"> <a href="{{url('tarifs')}}" target="_blank"> Tarifs</a></div>
            <div class="bordure"><a href="#" target="_blank">Crédits</a></div>
            <div class="ps-3 version">V 1.0.9</div>
        </div>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
        let mybutton = document.getElementById("btn-back-to-top");
        window.onscroll = function () {
            scrollFunction();
        };
        function scrollFunction() {
        if (
            document.body.scrollTop > 300 ||
            document.documentElement.scrollTop > 300
        ) {
            mybutton.style.display = "block";
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
</body>
</html>