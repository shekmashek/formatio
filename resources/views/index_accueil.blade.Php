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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{asset('../assets/css/smooth_page.css')}}">
    <link rel="stylesheet" href="{{ asset('maquette/style_maquette.css') }}">
    <script src="{{ asset('maquette/javascript.js') }}"></script>
    <link rel="shortcut icon" href="{{  asset('maquette/logo_fmg copie.png') }}" type="image/x-icon">
    <title> Formation.mg </title>
</head>
<body>
    <button
        type="button"
        class="btn btn-floating btn-lg" id="btn-back-to-top">
        <i class="far fa-arrow-up"></i>
    </button>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top navbar_accueil " style="height: 55px;">
            <div class="container-fluid">
                <div class="left_menu ms-2">
                    <p class="titre_text m-0 p-0"><img class="img-fluid" src="{{ asset('maquette/logo_fmg54Ko.png') }}" width="40px" height="25px"> Formation.mg</p>
                </div>
              {{-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button> --}}
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  {{-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                  </li> --}}
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Fonctionnalités</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <li><a class="dropdown-item mt-2" href="{{url('moderne')}}" target="_blank"><i class="far fa-mouse-pointer center" style="color:rgb(107, 204, 148); padding: 8px 10px; border-radius: 100%; font-size: 13px; background-color: rgb(198,246,213); "></i> &nbsp; Moderne, flexible et sécurusé</a></li>
                      <li><a class="dropdown-item mt-2" href="{{url('gestiond')}}" target="_blank"><i class="fad fa-file-alt" style="color:rgb(70, 151, 150); padding: 8px 10px; border-radius: 100%; font-size: 13px; background-color: rgb(178,245,234); "></i> &nbsp; Gestion docummentaire</a></li>
                      {{-- <li><hr class="dropdown-divider"></li> --}}
                      <li><a class="dropdown-item mt-2" href="{{url('gestionf')}}" target="_blank"><i class="fad fa-euro-sign" style="color:rgb(76,81,191); padding: 8px 11px; border-radius: 100%; font-size: 13px; background-color: rgb(195,218,254); "></i> &nbsp; Gestion financière</a></li>
                      <li><a class="dropdown-item mt-2" href="{{url('gestiona')}}" target="_blank"><i class="fad fa-calendar-check" style="color:rgb(186, 79, 141); padding: 8px 10px; border-radius: 100%; font-size: 13px; background-color: rgb(254,252,191); "></i>&nbsp; Gestion administrative</a></li>
                      <li><a class="dropdown-item mt-2" href="{{url('gestionc')}}" target="_blank"><i class="far fa-users" style="color:rgb(43,108,176); padding: 8px 7px; border-radius: 100%; font-size: 13px; background-color: rgb(190,227,248); "></i>&nbsp; Gestion commerciale</a></li>
                      <li><a class="dropdown-item mt-2" href="{{url('qualite')}}" target="_blank"><i class="fad fa-clipboard" style="color:rgb(192,86,33); padding: 8px 10px; border-radius: 100%; font-size: 13px; background-color: rgb(254,235,200); "></i>&nbsp;&nbsp; Qualité</a></li>
                      <li><a class="dropdown-item mt-2" href="{{url('communication')}}" target="_blank"><i class="fad fa-comments-alt" style="color:rgb(200,58,58); padding: 8px 8px; border-radius: 100%; font-size: 13px; background-color: rgb(254,235,200); "></i>&nbsp;&nbsp;Communication</a></li>
                      <li><a class="dropdown-item mt-2" href="{{url('elearning')}}" target="_blank"><i class="fad fa-laptop" style="color:rgb(183,121,31); padding: 8px 7px; border-radius: 100%; font-size: 13px; background-color: rgb(254,252,191); "></i>&nbsp;&nbsp;E-learning</a></li>
                      <li><a class="dropdown-item mt-2" href="{{url('fonctionnalitea')}}" target="_blank"><i class="fad fa-search" style="color:rgb(100, 60, 194); padding: 8px 9px; border-radius: 100%; font-size: 13px; background-color: rgb(233,216,253); "></i>&nbsp;&nbsp;Fonctionnalités avancées</a></li>
                    </ul>
                  </li>

                  <li class="nav-item">
                    <a class="nav-link" href="{{url('tarifs')}}" target="_blank">Tarifs</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">À propos</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{url('contact')}}"  target="_blank">Contactez-nous</a>
                  </li>

                </ul>
                <form class="d-flex">
                    <li class="nav-item">
                        <a style="color:rgb(75, 75, 75);" href="{{ route('sign-in') }}" >Se connecter </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" style="color:rgb(79, 79, 79); padding: 10px 5px; border: 1px solid #7535DC; border-radius: 35px; font-size: 13px;" >Voir une démo</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('create+compte+client')}}" style="color:white; padding: 10px 5px; border: 1px solid #7535DC; border-radius: 35px; font-size: 13px; background-color: #7b42d6; ">Créer un compte</a>
                    </li>
                  {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button> --}}
                </form>
              </div>
            </div>
          </nav>
        {{-- <nav class="navbar_accueil fixed-top d-flex justify-content-between">
            <div class="left_menu ms-2">
                <p class="titre_text m-0 p-0"><img class="img-fluid" src="{{ asset('maquette/logo_fmg54Ko.png') }}" width="60px" height="60px"> Formation.mg</p>
            </div>

            <div class="right_menu d-flex justify-content-end align-items-center">
                <div class="child_right_menu">
                    <a href="{{url('contact')}}"><button class="btn_bordure_violet mx-2"><i class="fa fa-phone-alt"></i>&nbsp; Contactez-nous</button></a>
                </div>
                <div class="child_right_menu">
                   <a href="{{route('create+compte+client')}}"><button class="btn_bordure_violet mx-2"><i class="fa fa-layer-plus"></i>&nbsp; Créer un compte</button></a>
                </div>
                <div class="child_right_menu">
                    <button class="btn bouton_violet mx-2"><a href="{{ route('sign-in') }}"><i class="fa fa-sign-in-alt"></i>&nbsp; Connexion </a></button>
                </div>
            </div>
        </nav> --}}
    </header>
    <main>
        <div class=" p-5 m-0 container-fluid" style="font-size: 14px">
            <div class="row ">
                <div class="p-0 col-lg-6">
                    <div class="shadow p-3 mb-4 bg-body rounded" style="height: 160px">
                        <div class="row ">
                            <div class="col"  align="center">
                                <p class="p-0 mt-0 m-0">Plateforme collaboratif de gestion de formation</p>
                                <p style="font-size: 10px; color: rgb(158, 157, 157)">
                                    La première plateforme malagasy
                                    de gestion de formation,<br> outil
                                    incontournable et innovateur du milieu professionnel.
                                </p><br>
                                    <a href="{{url('tarifs')}}" style="color: #9d76dc;font-size: 11px;">&nbsp; Voir plus >&nbsp;</a>
                            </div>
                            <div class="col "  align="center">
                                    <p style="font-size: 10px; margin:0; color: rgb(158, 157, 157)" > - Centre de formation </p>
                                    <p style="font-size: 10px;margin:0; color: rgb(158, 157, 157)"> - Formateur</p>
                                    <p style="font-size: 10px;margin:0; color: rgb(158, 157, 157)"> - Référent</p>
                                    <p style="font-size: 10px;margin:0; color: rgb(158, 157, 157)"> - Apprenant</p>
                                    <p style="font-size: 10px;margin:0; color: rgb(158, 157, 157)"> - Manager </p>
                                    {{-- <img class=" ms-5 img-fluid rounded-3" src="{{ asset('maquette/collaboration.jpg') }}" alt="" style="height:50px; width:120px"><br> --}}
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
                                    {{-- <a style="background-color: #801D68; color:white; font-size: 11px " class="btn mb-2" href="">Demander une demo</a> --}}
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
                            <div class="col"  align="center">
                                <p class="p-0 mt-0 m-0">Vous êtes un organisme de formation ?</p>
                                <p style="font-size: 10px;  color: rgb(158, 157, 157)">
                                    Disposez d’une base de données centralisée,<br> gagnez en temps et en économie.
                                    Retrouvez  tout ce dont vous avez besoin dans un seul et unique endroit : la gestion de vos formations (session , exécution ...),
                                    vos facturations, vos devis, votre espace professionnel ( dressage et modification de vos catalogues).<br>
                                    Investissez dans le futur ! <br> Digitalisez votre activité et ayez une longueur d’avance sur les autres.<br>
                                    Améliorez votre communication et votre suivi commercial.<br>
                                    Rapprochez-vous de vos clients, envoyez leurs des évaluations digitalisées et personnalisables et obtenez des feedbacks instantanés
                                </p>
                                <a href="{{url('tarifs')}}" style="color: #9d76dc;;font-size: 11px">&nbsp; Voir plus >&nbsp;</a>
                                    {{-- <a style="background-color: #801D68; color:white; font-size: 11px " class="btn mb-2" href="{{route('create+compte+client')}}">Creer un compte pro</a> --}}
                            </div>
                            <div class="col"  align="center">
                                    <img  class=" img-fluid" src="{{ asset('maquette/demos.jpg') }}" alt="" style="height:90px; width:130px"><br>
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
                                    {{-- <a style="background-color: #801D68; color:white; font-size: 11px " class="btn" href="{{route('create+compte+client')}}">Creer un compte pro</a> --}}
                            </div>
                            <div class="col" align="center">
                                    <img class=" img-fluid" src="{{ asset('maquette/formation.jpg') }}" alt=""  alt="" style="height:100px; width:130px"><br>
                                    <a style="background-color: #9d76dc; color:white; font-size: 11px; margin-top: 35px" class=" btn mb-2 " href="{{route('create+compte+client')}}">Creer un compte pro</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer_container">
                <div class="d-flex justify-content-center pt-3">
                    <div class="bordure">&copy; Copyright 2022</div>
                    <div class="bordure"><a href="{{url('info_legale')}}" style="color:#801D68 !important" target="_blank">Informations légales</a></div>
                    <div><a href="{{url('contact')}}" class="bordure" style="color: #801D62;text-decoration:none" target="_blank">Contactez-nous</a></div>
                    <div class="bordure"><a href="{{url('politique_confidentialites')}}" class="bordure" style="color: #801D62;text-decoration:none" target="_blank">Politique de confidentialités</a></div>

                    <div class="bordure" > <a href="{{route('condition_generale_de_vente')}}" style="color:#801D68 !important" target="_blank"> Condition d'utilisation</a> </div>
                    <div class="bordure"> <a href="{{url('tarifs')}}" style="color:#801D68 !important" target="_blank"> Tarifs</a></div>
                    <div class="bordure">Crédits</div>
                    <div> &nbsp; Version 0.9</div>
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