<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/mahafaly.css')}}">
    <title>Formation.mg</title>
</head>
<style>
    .img{
        position: relative;
        margin-left: 19%;
        margin-top: 15%;
        height: 100%;

    }
    .form{
        margin-top: 35%;

        padding: 50px;


    }
    .form h2{
        font-weight: 500 !important;
        font-size: 1.714rem;
        font-family: inherit;
        font-weight: 500;
        line-height: 1.2;
        color: #5e5873;
    }
    .index{
        border: none;
        border-bottom: 2px solid #7367f0;
        border-radius: 0px;
        color: #6e6b7b;
    }
     p{
        font-family: Helvetica,Arial,serif;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.45;
        color: #6e6b7b;
        line-height: 1.5rem;
    }
    .form-group label{
        font-family: Helvetica,Arial,serif;

        font-size: 12px;
        font-weight: 400;
        line-height: 1.45;
        color: #6e6b7b;


    }
    .form-control{
        height: 35px;
    }
    .form-control:focus{
       border: #7367f0 1px solid;
       box-shadow: 0 5px 30px rgba(0, 0, 0, .1);

    }

    #tes:focus{
        box-shadow: none;
        outline: none;
    }
    a{
        color: #7367f0;
        text-decoration: none;

    }
    span:hover{
        transform: scale(1);
        cursor: pointer;
    }
    @media screen and (max-width: 990px){
        .img{
            /* width: 500px; */
            display: none;

        }

        .form{
            position: relative;
            padding: 100px;
            box-shadow: 0 5px 30px rgba(0, 0, 0, .1);
            margin-top: 50px;
            /* background: #000; */
            /* position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%); */
        }
        body{
            margin: 0;
            padding: 0;
        }
    }
    @media screen and (min-width:990px) and (max-width: 1200px) {
        .img{
            width: 400px;
            margin-top: 20%;

            /* display: none; */
        }
        .form{
            margin-top: 50%;

        }
    }

</style>
<body>
    <div class="col-3 d-flex flex-row padding_logo" style="margin-left: 50px;">

    </div>
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-8 tt">
                <div class="img">
                    <img class="img-fluid" style="width: 600px" src="{{asset('images/izi.png')}}" alt="">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form ">
                    <h2>Bienvenue chez formation.mg <span>👋</span> </h2>
                    <p>Veuillez vous connecter à votre compte et commencer l'aventure</p>
                    <form id="form_add_contact" method="POST" action="{{ route('login') }}" class="h-50">
                        @csrf
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" autocomplete="off">
                            @error('email')
                                <span class=" invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Mot de passe</label>

                        </div>
                        <div class="input-group">
                            <input type="password" name="password" id="password"  class="form-control" aria-label="Amount (to the nearest dollar)">
                            <div class="input-group-append">
                            <span class="input-group-text" style="height: 35px;"><i class="fa-solid fa-eye align-middle" onclick="affiche()" ></i></span>

                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <a href="{{ route('password.request') }}" >Mot de passe oublie?</a>
                        <button type="submit" id="tes"    class=" btn btn-info btn-block mt-2" style="width:100%;background-color: #7367f0;color: white;"> Se connecter</button>
                    </form>
                    <p class="text-center mt-2"> Nouveaux dans le plateforme? <a href="{{route('create+compte+client')}}">Créer un compte</a> </p>
                </div>
                {{-- <hr style="padding: 100px"> --}}
            </div>
        </div>
    </div>

</body>
<script>
    function affiche(){

        var input = document.getElementById("password");
        if (input.type === "password") {
            input.type = 'text'
        } else {
            input.type = 'password'
        }
    }
</script>
</html>