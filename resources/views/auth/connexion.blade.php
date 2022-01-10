<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrapCss/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrapCss/js/jquery.min.js') }}" ></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('login_css/css/style.css') }}">

    <title>Login</title>
</head>
<body>

    {{-- <nav class="navbar navbar-expand-lg navbar-light ">
        <div class="container-fluid">

            <img src="{{ asset('img/logo_numerika/logonmrk.png') }}" alt="logonmk" class="logo">

        </div>
      </nav> --}}

      {{-- formulaire de connection --}}

            <div class="container py-5 login">
                <div class="row">
                    <div class="col-lg-5 px-5 formulaire">
                        <form id="form_add_contact" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="">
                                <h1 class="bienvenue">Bienvenue</h1></br>
                            </div>
                            <p>Entrer votre adresse e-mail et votre mot de passe pour se connecter</p>
                            <div class="form-group">
                                <label for="mail" class="form-label-sm libele">E-mail</label>
                                <input type="email" name="email" placeholder="E-mail" class="form-control @error('email') is-invalid @enderror"">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-label-sm libele">Mot de passe</label>
                                <input placeholder="Mot de passe" class="form-control @error('password') is-invalid @enderror"  type="password" name="password" id="password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="choix" name="switch">
                                <label class="form-check-label" for="flexSwitchCheckDefault">&nbsp;Se souvenir de moi&sbquo;&nbsp;</label>
                                @if (Route::has('password.request'))
                                <label ><a href="{{ route('password.request') }}" class="forgot-login">{{ __('Mot de passe oublié?') }}</a></label>
                                @endif
                            </div>
                            <div class="form-group mt-4" align="center">
                                <button type="submit" class="btn btn-primary btn-center btn-login" >{{__('Se connecter')}}</button>
                            </div>
                            <div>
                                <label for="sing in">Vous n'avez pas de compte?<a href="#"><span class="bienvenue">créer un compte</span></a></label>
                            </div>
                        </form>
                    </div>

                    <div class="col-lg-7 linear_gradient" align="center">
                        <img src="{{ asset('img/logo_formation/logo_transparent_background.png') }}" alt="background" class="img-fluid login-image py-5">
                        {{-- <div id="carousel" class="carousel slide carousel-fade carousel-dark slide" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                            </div>
                            <div class="carousel-inner" class="img-fluid">
                                <div class="carousel-item active" data-bs-interval="5000">
                                    <img src="{{ asset('img/logo_formation/dark_logo_white_background.jpg') }}" alt="background" class="img-fluid img-login" class="d-block w-100">

                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <img src="{{ asset('img/logo_formation/white_logo_dark_background.jpg') }}" alt="background" class="img-fluid img-login" class="d-block w-100">

                                </div>
                                <div class="carousel-item" data-bs-interval="5000">
                                    <img src="{{ asset('img/logo_formation/white_logo_color_background.jpg') }}" alt="background" class="img-fluid img-login" class="d-block w-100">

                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div> --}}
                    </div>
                </div>
            </div>
</body>
<script src="{{ asset('bootstrapCss/js/bootstrap.min.js') }}" ></script>
<script src="{{ asset('bootstrapCss/js/bootstrap.bundle.min.js') }}" ></script>
</html>
