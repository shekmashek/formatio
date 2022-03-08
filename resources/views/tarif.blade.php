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
    <link rel="shortcut icon" href="{{  asset('maquette/real_logo.ico') }}" type="image/x-icon">
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
                    <a style=" text-decoration: none;" href="{{ route('accueil_perso') }}"><p class="titre_text m-0 p-0" style="color: black;"><img class="img-fluid" src="{{ asset('maquette/logo_fmg54Ko.png') }}" width="40px" height="25px"> Formation.mg</p></a>
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
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Fonctionnalités</a>
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
                        <a style="color:rgb(75, 75, 75); text-decoration: none" href="{{ route('sign-in') }}" >Se connecter </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" style="color:rgb(79, 79, 79);text-decoration: none; padding: 10px 5px; border: 1px solid #7535DC; border-radius: 35px; font-size: 13px;" >Voir une démo</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('create+compte+client')}}" style="color:white; text-decoration: none; padding: 10px 5px; border: 1px solid #7535DC; border-radius: 35px; font-size: 13px; background-color: #7b42d6; ">Créer un compte</a>
                    </li>
                  {{-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success" type="submit">Search</button> --}}
                </form>
              </div>
            </div>
          </nav>
        {{-- <nav class="navbar_accueil fixed-top d-flex justify-content-between">
            <div class="left_menu ms-2">
                <a style=" text-decoration: none;" href="{{ route('accueil_perso') }}"><p class="titre_text m-0 p-0" style="color: black;"><img class="img-fluid" src="{{ asset('maquette/logo_fmg54Ko.png') }}" width="60px" height="60px"> Formation.mg</p></a>
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
        <div class="container-fluid">
            <div class="p-5 m-0">
                <center><h1>Offrez-vous l'excellence</h1></center>
                <p class="p-3" style="font-size: 14px; color:rgb(131, 131, 131)">Toutes nos offres sont <b> sans engagement : </b> <br>
                nos clients travaillent avec nous car ils sont <b> satisfaits </b>, pas sous contrat ! </p> </center>
            </div>
            <div class="row">
                <div class="col-lg-3"></div>
                    <div class="col-lg-2">
                        <center>
                            <p>Basic</p>
                            <b class="p-0 m-0" style="font-size: 25px;">199 €</b>
                            <p>Par mois</p>
                        </center>
                    </div>
                    <div class="col-lg-2">
                        <center>
                            <p>Pro</p>
                            <b class="p-0 m-0" style="font-size: 25px;">299 €</b>
                            <p>Par mois</p>
                        </center>
                    </div>
                    <div class="col-lg-2">
                        <center>
                            <p>Premium</p>
                            <b class="p-0 m-0" style="font-size: 25px;">499 €</b>
                            <p>Par mois</p>
                        </center>
                    </div>
                    <div class="col-lg-2">
                        <center>
                            <p>Elite</p>
                            <b class="p-0 m-0" style="font-size: 25px;">Sur devis</b>
                        </center>
                    </div>
                <div class="col-lg-1"></div>
            </div>
            <div class="row">

            </div>
        </div>
    </main>
    <footer class="footer_container">
        <div class="d-flex justify-content-center pt-3">
            <div class="bordure">&copy; Copyright 2022</div>
            <div class="bordure"><a href="{{url('info_legale')}}" style="color:#801D68 !important" target="_blank">Informations légales</a></div>
            <div><a href="{{url('contact')}}" class="bordure" style="color: #801D62;text-decoration:none" target="_blank">Contactez-nous</a></div>
            <div class="bordure">Politique de confidentialités</div>
            <div class="bordure" > <a href="{{route('condition_generale_de_vente')}}" style="color:#801D68 !important" target="_blank"> Condition d'utilisation</a> </div>
            <div class="bordure"><a href="{{url('tarifs')}}" style="color:#801D68 !important" target="_blank"> Tarifs</a></div>
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