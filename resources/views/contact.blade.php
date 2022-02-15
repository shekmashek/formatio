<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" href="{{asset('../assets/css/smooth_page.css')}}">
    <link rel="stylesheet" href="{{ asset('maquette/style_maquette.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    {{-- Lien font awesome icons --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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
        <nav class="p-0 navbar_accueil fixed-top d-flex justify-content-between">
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
                    <button class="btn bouton_violet mx-2" style="background-color: #801D68"><a href="{{ route('sign-in') }}" style="text-decoration: none;color:white"><i class="fa fa-sign-in-alt"></i>&nbsp; Connexion </a></button>
                </div>
            </div>
        </nav>
    </header>

    <div class="container" style="margin-top: 6%;">
        <p class="p-0 m-0" style="font-size: 25px; text-align:left; ">Contactez-nous</p>

        <hr>
        <div class="row">

            <div class="col-lg-4">
                <p class=" ms-5 mt-4" style="font-size: 20px;">Adresse</p>


                <i class="fa fa-map-marker text mt-3" aria-hidden="true">
                    II N 60 A Analamahitsy 101 Antananarivo Madagascar.
                </i>


               <i class="fa fa-envelope text mt-3" aria-hidden="true">
                contact@numerika.center
               </i>
               <br>
               <i class="fa fa-phone text mt-3" aria-hidden="true">
                (261) 033 23 135 63
               </i>
            </div>
            <div class="col-lg-8">
                <p class=" ms-5 mt-4" style="font-size: 20px;">Pour nous contacter Veuillez remplir les formulaires ci-dessous</p>

                @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
                <div class="row">
                    <div class="col-lg-6">
                <form method="POST" action="{{route('contact')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Votre nom" name="name" autocomplete="off">
                        @error('name')
                        <div class="col-sm-6">
                            <span style="color:#ff0000;"> {{$message}} </span>
                        </div>
                        @enderror
                    </div>
                     <br>
                     <div class="form-group">
                        <input type="text" class="form-control" placeholder="Entreprise" name="entreprise" autocomplete="off">
                        @error('entreprise')
                        <div class="col-sm-6">
                            <span style="color:#ff0000;"> {{$message}} </span>
                        </div>
                        @enderror
                    </div>
                      <br>
                    </div>
                    <div class="col-lg-6">

                      <div class="form-group">
                        <input type="text" class="form-control" placeholder="Email" name="mail" autocomplete="off">
                        @error('mail')
                        <div class="col-sm-6">
                            <span style="color:#ff0000;"> {{$message}} </span>
                        </div>
                        @enderror
                    </div>
                      <br>
                      <div class="form-group">
                         <input type="text" class="form-control" placeholder="Objet" name="objet" autocomplete="off">
                         @error('objet')
                         <div class="col-sm-6">
                             <span style="color:#ff0000;"> {{$message}} </span>
                         </div>
                         @enderror
                        </div>
                    </div>
                </div>

                 <div class="form-group">
                    <textarea type="text" class="form-control" placeholder="Votre message" style="height: 75px" name="msg" autocomplete="off"></textarea>
                    @error('msg')
                    <div class="col-sm-6">
                        <span style="color:#ff0000;"> {{$message}} </span>
                    </div>
                    @enderror
                </div>
               <div>
                   <br>
                 <p style="text-align:left">Captcha</p>
                 0 + <input type="text" name="input" autocomplete="off" style="width: 25px;height:25px" required> = 7 <br>
                </div>
                <br>
                    <button class="btn " type="submit" style="background-color: #801D68;color:white">Envoyer</button>

            </div>
            </div>
        </form>

        <br><br><br>
        <footer class="footer_container">

            <div class="d-flex justify-content-center pt-3">
                <div class="bordure">&copy; Copyright 2022</div>
                <div class="bordure">Informations légales</div>
                <div><a href="{{url('contact')}}" class="bordure" style="color: #801D62;text-decoration:none" target="_blank">Contactez-nous</a></div>
                <div class="bordure">Politique de confidentialités</div>
                <div class="bordure" > <a href="{{route('condition_generale_de_vente')}}" style="color:#801D68 !important" target="_blank"> Condition d'utilisation</a> </div>
                <div class="bordure">Tarifs</div>
                <div class="bordure">Crédits</div>
                <div> &nbsp; Version 0.9</div>
            </div>
</footer>
    </div>
    <style>
        .text{color: grey;font-size: 16px}
    </style>

</body>
</html>