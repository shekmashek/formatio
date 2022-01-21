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



                <form id="form_add_contact" method="POST" action="{{ route('update_mail_stagiaire') }}" class="h-50">
                    @csrf
                    <div class="form-row background_transparent">
                        <div class="col-12" align="center">

                            <div class="img_top mt-4">
                                <img src="{{ asset('img/images/logo_fmg54Ko.png') }}" alt="background" class="img-fluid">
                            </div>
                            <span>
                                <strong>{{$msg}}</strong>
                            </span>
                            <div>
                                <div class="form-group mt-4">
                                    <input type="email" name="email" placeholder="E-mail" class="form-control input_design @error('email') is-invalid @enderror" autocomplete="off">
                                </div>
                            </div>
                            <div>

                            </div>
                            <div>
                                <div class="form-group mt-3 mb-4" align="center">
                                    <button type="submit" class="btn btn-primary btn-center btn-login ">{{__('Modifier mon e-mail')}}</button>
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
