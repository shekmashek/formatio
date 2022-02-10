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
        <nav class="navbar_accueil fixed-top d-flex justify-content-between">
            <div class="left_menu ms-2">
                <p class="titre_text m-0 p-0"><img class="img-fluid" src="{{ asset('maquette/logo_fmg54Ko.png') }}" width="60px" height="60px"> Formation.mg</p>
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
        </nav>
    </header>
    <main>
        <div class="container-fluid ">
            <p class="p-5 m-0" style="text-align: left; font-size: 12px;">
                Le site <a style="color: #801D68; text-decoration-line: underline;"  href="#">https://www.digiforma.com</a> est édité par A World For US SAS, au capital de 11000 €, entreprise immatriculée au RCS de PARIS sous le numéro 51048950300027, dont le siège social est sis au 41 rue Poliveau, 75005 PARIS. <br> <br>
                N° de TVA intracommunautaire : FR26510489503. <br> <br>
                Directeur de la publication : Henri Morlaye, Directeur Technique de A World For US SAS, joignable à l’adresse info@aworldforus.com. <br> <br>
                Le site est hébergé par Heroku Inc., 650 7th Street, San Francisco, CA (tel : +33 1 (877) 563-4311).
                Le stockage des données personnelles des utilisateurs est exclusivement réalisé sur les centres de données (« clusters ») de la société Amazon Inc, dont le siège social est situé 10 Terry Avenue North, Seattle, WA. Tous les clusters Amazon sur lesquels les données du Site sont stockées sont localisés dans des Etats membres de l’Union Européenne..
                Les informations concernant la collecte et le traitement des données personnelles (politique et déclaration) sont fournies dans la charte de données personnelles du site. <br> <br>
                Pour toutes demandes commerciales, merci de nous contacter via la <a style="color: #801D68; text-decoration-line: underline;"  href="#">page de contact</a>  ou bien de visiter notre <a style="color: #801D68; text-decoration-line: underline;" href="#">centre d’aide.</a>
            </p>
        </div>
    </main>
    <footer class="footer_container">
        <div class="d-flex justify-content-center pt-3">
            <div class="bordure">&copy; Copyright 2022</div>
            <div class="bordure"><a href="{{url('info_legale')}}" style="color:#801D68 !important" target="_blank">Informations légales</a></div>
            <div><a href="{{url('contact')}}" class="bordure" style="color: #801D62;text-decoration:none" target="_blank">Contactez-nous</a></div>
            <div class="bordure">Politique de confidentialités</div>
            <div class="bordure" > <a href="{{route('condition_generale_de_vente')}}" style="color:#801D68 !important" target="_blank"> Condition d'utilisation</a> </div>
            <div class="bordure">Tarifs</div>
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