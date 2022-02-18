<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('bootstrapCss/css/bootstrap.min.css') }}">
    <script src="{{ asset('bootstrapCss/js/jquery.min.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('login_css/css/style.css') }}">
    {{-- Boxicon --}}
    <link href="{{asset('assets/css/boxicons.min.css')}} " rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>Login</title>
</head>
<body>
    <div class="container postion_login login h-100">
        <div class="col-12">
            <div class="container mt-5 h-100">
                <form id="form_add_contact" method="POST" action="{{ route('login') }}" class="h-50">
                    @csrf
                    <div class="form-row background_transparent">
                        <div class="col-12" align="center">
                            <div class="img_top mt-4">
                                <img src="{{ asset('img/images/logo_fmg54Ko.png') }}" alt="background" class="img-fluid">
                            </div>
                            <div>
                                <div class="form-group mt-4">
                                    <input type="email" name="email" placeholder="E-mail" class="form-control input_design @error('email') is-invalid @enderror" autocomplete="off">
                                    @error('email')
                                    <span class=" invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="form-group mt-4">
                                    <div class="input-group">
                                        <input placeholder="Mot de passe" class="form-control input_design @error('password') is-invalid @enderror" type="password" name="password" id="password" autocomplete="off">
                                        <div class="input-group-append">
                                            <button class="btn btn_masquer" onclick="Afficher()" type="button"><span id="eye_icon" style="cursor: pointer" class="ms-2">Afficher</span></button>
                                        </div>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="text-center">
                                    @if (Route::has('password.request'))
                                    <label><a href="{{ route('password.request') }}" class="forgot-login">{{ __('Mot de passe oublié?') }}</a></label>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <div class="form-group mt-3 mb-4" align="center">
                                    <button type="submit" class="btn btn-primary btn-center btn-login ">{{__('Se connecter à votre compte pro')}}</button>
                                </div>
                            </div>
                            <div class="d-flex flex-row">
                                <hr>
                                <div class="mx-3"><p>ou</p></div>
                                <hr>
                            </div>
                            <div>
                                <div class="form-group mt-4 mb-2" align="center">
                                    <a href="{{route('create+compte+client')}}"><button type="button" class="btn btn-primary btn-center btn-login_creer ">{{__('Creer votre compte pro')}}</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('bootstrapCss/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('bootstrapCss/js/bootstrap.bundle.min.js') }}"></script>
<script>
    function Afficher() {
        var input = document.getElementById("password");
        var texte = document.getElementById('eye_icon');
        if (input.type === "password") {
            input.type = "text";
            texte.innerHTML="Masquer";
        } else {
            input.type = "password";
            texte.innerHTML="Afficher";
        }
    }

</script>
</html>
