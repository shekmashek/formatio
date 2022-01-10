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
        <div class="col-12 ">
            <div class="container  h-100">
                <form id="form_add_contact" method="POST" action="{{ route('login') }}" class="h-50">
                    @csrf
                    <div class="form-row w-80 background_transparent">
                        <div class="col centrer_img">
                            <div class="mt-5">
                                <img src="{{ asset('img/logo_formation/logo_transparent_background.png') }}" alt="background" class="img-fluid mt-3">
                            </div>
                        </div>
                        <div class="col">
                            <div>
                                <h1 class="bienvenue text-center mt-4">Bienvenue</h1>
                            </div>
                            <div>
                                <p class="text-center">Entrer votre adresse mail et votre mot de passe pour se connecter</p>
                                <div class="form-group mt-4">
                                    <label for="mail" class="form-label-sm libele">E-mail</label>
                                    <input type="email" name="email" placeholder="E-mail" class="form-control @error('email') is-invalid @enderror" autocomplete="off">
                                    @error('email')
                                    <span class=" invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="form-group mt-4">
                                    <label for="password" class="form-label-sm libele">Mot de passe</label>
                                    <div class="input-group">
                                        <input placeholder="Mot de passe" class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" autocomplete="off">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-eye-slash" style="cursor: pointer" onclick="Afficher()" id="eye_icon"></i></span>
                                        </div>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="form-group mt-5 mb-4" align="center">
                                    <button type="submit" class="btn btn-primary btn-center btn-login w-80">{{__('Se connecter')}}</button>
                                </div>
                            </div>
                            <div class="text-center">
                                @if (Route::has('password.request'))
                                <label><a href="{{ route('password.request') }}" class="forgot-login">{{ __('Mot de passe oublié?') }}</a></label>
                                @endif
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
        var icon = document.getElementById("eye_icon");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        } else {
            input.type = "password";
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        }
    }

</script>
</html>
