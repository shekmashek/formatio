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
    <link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
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
                    <a href="{{route('accueil_perso')}}"><p class="titre_text m-0 p-0"><img class="img-fluid" src="{{ asset('maquette/logo_fmg7635dc.png') }}"> Formation.mg</p></a>
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

    <main class="mt-5">
        <div class="container pt-5 contact_content pb-5">
            <h1 class="p-0 m-0 text-center mb-5">Nous contacter</h1>
            <div class="row">
                {{-- <div class="col-lg-4 d-flex flex-column">
                    <span><i class="fa fa-map-marker text mt-3 me-3 ms-1" aria-hidden="true"></i>II N 60 A Analamahitsy
                        <br> 101 Antananarivo Madagascar.</span>
                    <span><i class="fa fa-envelope text mt-3 me-3" aria-hidden="true"></i>contact@numerika.center</span>
                    <span><i class="fa fa-phone text mt-3 me-3"
                            aria-hidden="true"></i>+261&nbsp;33&nbsp;23&nbsp;135&nbsp;63</span>
                </div> --}}
                <div class="col-12">
                    @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                    @endif
                    <form method="POST" action="{{route('contact')}}" enctype="multipart/form-data">
                        <div class="row contact_form">
                            <div class="col-lg-6">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control input" name="name" id="input" autocomplete="off" required>
                                    <label for="input" class="form-control-placeholder">Nom</label>
                                    @error('name')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control input" name="entreprise" autocomplete="off" required>
                                    <label for="input" class="form-control-placeholder">Entreprise</label>
                                    @error('entreprise')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <input type="mail" class="form-control input" name="mail" autocomplete="off" required>
                                    <label for="input" class="form-control-placeholder">Email</label>
                                    @error('mail')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control input" name="objet" autocomplete="off" required>
                                    <label for="input" class="form-control-placeholder">Objet</label>
                                    @error('objet')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <textarea type="text" class="form-control text_area" name="msg" autocomplete="off" required></textarea>
                                <label for="input" class="form-control-placeholder-text_area">Votre message...</label>
                                @error('msg')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                            <div class="text-center mb-3">
                                <p style="text-center">Captcha</p>
                                0 + <input type="text" name="input" autocomplete="off" style="width: 25px;height:25px"
                                    required>
                                = 7
                            </div>
                            <button class="btn commencer text-center" type="submit">Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer class="footer_all mt-5">
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
</body>

</html>