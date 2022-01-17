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

    <link rel="stylesheet" href="{{ asset('maquette/style_maquette.css') }}">
    <script src="{{ asset('maquette/javascript.js') }}"></script>
    <link rel="shortcut icon" href="{{  asset('maquette/real_logo.ico') }}" type="image/x-icon">
    <title> Formation.mg </title>
</head>
<body>
    <header>
        <nav class="navbar_accueil fixed-top d-flex justify-content-between">
            <div class="left_menu ms-2">
                <img class="img-fluid" src="{{ asset('maquette/logo_fmg54Ko.png') }}" width="60px" height="60px"> Formation.mg
            </div>
            <div class="right_menu d-flex justify-content-end align-items-center">
                <div class="child_right_menu">
                    <button class="btn btn_bordure_violet mx-2"><i class="fa fa-phone-alt"></i>&nbsp; Contactez notre équipe commercial</button>
                </div>
                <div class="child_right_menu">
                    <button class="btn btn_bordure_violet mx-2"><i class="fa fa-layer-plus"></i>&nbsp; Créer un compte pro</button>
                </div>
                <div class="child_right_menu">
                    <button class="btn bouton_violet mx-2"><a href="{{ route('sign-in') }}"><i class="fa fa-sign-in-alt"></i>&nbsp; Connexion à l'espace pro </a></button>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <section class="section_1">
            <div class="container-fluid conteneur">
                <div class="row">
                    <div class="col-md-6 py-5">
                        <h2>Plateforme collaboratif de gestion de formation</h2>
                            <p>La première plateforme malagasy
                            de gestion de formation, outil
                            incontournable et innovateur du milieu professionnel.</p><br>
                            <center><button class="btn btn_blue">Voir plus</button></center>
                    </div>
                    <div class="col-md-6 py-5 px-5" style="border-radius: 50%;">
                        <img class="img-fluid rounded-3" src="{{ asset('maquette/collaboration.jpg') }}" alt="" style="border-radius: 50%;">
                    </div>
                </div>
            </div>
        </section>
        <section class="section_2">
            <div class="container-fluid conteneur">
                <div class="row">
                    <div class="col-md-6 py-5 px-5">
                        <img class="img-fluid rounded-3" src="{{ asset('maquette/formation_1.jpg') }}" alt="">
                    </div>
                    <div class="col-md-6 py-5">
                        <h2>Vous êtes une organisme de formation ?</h2>
                        <h4>Voici vos avantages</h4>
                        <ul>
                            <li>Avantage 1</li>
                            <li>Avantage 2</li>
                            <li>Avantage 3</li>
                            <li>Avantage 4</li>
                            <li>Avantage 5</li>
                        </ul>
                        <center><button class="btn btn_blue">Creer un compte pro</button></center>
                    </div>
                </div>
            </div>
            
        </section>
        <section class="section_3">
            <div class="container-fluid conteneur">
                <div class="row">
                    <div class="col-md-6 py-5">
                        <h2>Vous êtes employeur ?</h2>
                        <h4>Voici vos avantages</h4>
                        <ul>
                            <li>Avantage 1</li>
                            <li>Avantage 2</li>
                            <li>Avantage 3</li>
                            <li>Avantage 4</li>
                            <li>Avantage 5</li>
                        </ul>
                        <center><button class="btn btn_blue">Creer un compte pro</button></center>
                    </div>
                    <div class="col-md-6 py-5 px-5 rounded-3">
                       <img class="img-fluid" src="{{ asset('maquette/formation.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid conteneur">
                <div class="row">
                    <div class="col-md-6 py-5 px-5">
                        <img class="img-fluid" src="{{ asset('maquette/demos.jpg') }}" alt="">
                    </div>
                    <div class="col-md-6 py-5">
                        <h2>Demander une demonstration</h2>
                        <h4>Voici vos avantages</h4>
                        <ul>
                            <li>Avantage 1</li>
                            <li>Avantage 2</li>
                            <li>Avantage 3</li>
                            <li>Avantage 4</li>
                            <li>Avantage 5</li>
                        </ul>
                        <center><button class="btn btn_blue">Demander une demo</button></center>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="footer_container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="d-flex pied pt-3">
                    <div class="bordure">&copy; Copyright 2022</div>
                    <div class="bordure">Informations légales</div>
                    <div class="bordure">Contactez-nous</div>
                    <div class="bordure">Politique de confidentialités</div>
                    <div class="bordure">Condition d'utilisation</div>
                    <div class="bordure">Tarifs</div>
                    <div> &nbsp; Crédits</div>
                </div>

            </div>
            <div class="col-md-3"></div>
        </div>
    </footer>
</body>
</html>