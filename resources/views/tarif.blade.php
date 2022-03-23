<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    {{-- Lien font awesome icons --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <script src="{{ asset('maquette/javascript.js') }}"></script>
    <link rel="shortcut icon" href="{{  asset('maquette/logo_fmg7635dc.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/css/index_accueil.css')}}">
    <title> Formation.mg </title>
</head>
<body>
    <button type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
        <i class="far fa-arrow-up"></i>
    </button>
    <header class="header">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top pb-0">
            <div class="container-fluid">
                <div class="left_menu ms-2">
                    <a href="{{route('accueil_perso')}}"><p class="titre_text m-0 p-0"><img class="img-fluid"
                            src="{{ asset('maquette/logo_fmg7635dc.png') }}"> Formation.mg</p></a>
                </div>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <div class="menu_action">
                        <ul class="d-flex">
                            <li class="nav-item">
                                <a href="{{ route('sign-in') }}" class="btn_login me-2" role="button">Se connecter</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('create+compte+client')}}" class="btn_creerCompte me-2"
                                    role="button">Créer un compte</a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container pt-5">
            <div class="p-5 m-0">
                <center>
                    <h1>Offrez-vous l'excellence</h1>
                    <p class="p-3" style="font-size: 14px; color:rgb(131, 131, 131)">Toutes nos offres sont <b> sans engagement : </b> <br>
                    nos clients travaillent avec nous car ils sont <b> satisfaits </b>, pas sous contrat ! </p>
                </center>
            </div>
            <div class="row justify-content-end ps-5">
                    <div class="col-lg-3 p-0">
                        <div class="card">
                            <center>
                                <p>Basic</p>
                                <b class="p-0 m-0" style="font-size: 25px;">199 €</b>
                                <p>Par mois</p>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-3 p-0">
                        <div class="card">
                            <center>
                                <p>Pro</p>
                                <b class="p-0 m-0" style="font-size: 25px;">299 €</b>
                                <p>Par mois</p>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-3 p-0">
                        <div class="card">
                            <center>
                                <p>Premium</p>
                                <b class="p-0 m-0" style="font-size: 25px;">499 €</b>
                                <p>Par mois</p>
                            </center>
                        </div>
                    </div>
                    <div class="col-lg-3 p-0">
                        <div class="card" style="height: 114px">
                            <center>
                                <p>Elite</p>
                                <b class="p-0 m-0" style="font-size: 25px;">Sur devis</b>
                            </center>
                        </div>
                    </div>
            </div>
            <div class="row">

            </div>
        </div>
    </main>
    <footer class="footer_all">
        <div class="d-flex justify-content-center align-items-center pt-3">
            <div class="bordure">&copy; Copyright 2022</div>
            <div class="bordure"><a href="{{url('info_legale')}}" target="_blank" rel="noopener noreferrer">Informations légales</a></div>
            <div class="bordure"><a href="{{url('contact')}}" target="_blank" rel="noopener noreferrer">Contactez-nous</a></div>
            <div class="bordure"><a href="{{url('politique_confidentialites')}}" target="_blank" rel="noopener noreferrer">Politique de
                    confidentialités</a></div>

            <div class="bordure"> <a href="{{route('condition_generale_de_vente')}}" target="_blank" rel="noopener noreferrer"> Condition
                    d'utilisation</a> </div>
            <div class="bordure"> <a href="{{url('tarifs')}}" target="_blank" rel="noopener noreferrer"> Tarifs</a></div>
            <div class="bordure"><a href="#" target="_blank" rel="noopener noreferrer">Crédits</a></div>
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