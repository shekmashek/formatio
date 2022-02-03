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
    <style>
        h6{
            text-align: justify;
        }
    </style>
    <title> Formation.mg </title>
</head>
<body>
    <button
        type="button"
        class="btn btn-floating btn-lg" id="btn-back-to-top">
        <i class="far fa-arrow-up"></i>
    </button>
    <div class="row"  style="margin-top: 100px">
        <header class="col-4">
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
            <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="#">Accès aux Services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Commande des Services et acceptation des conditions générales</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Inscription</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled">Usage strictement personnel, Comptes administrateurs et utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Durée de l’abonnement, désinscription
                    </a>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled">Description des Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Conditions financières</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Responsabilités et garanties du Client
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Comportements prohibés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Obligations et responsabilité du A WORLD FOR US</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Propriété Intellectuelle
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Données à caractère personnel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled">Données à caractère personnel</a>
                </li>
            </ul>
        </header>
        <main class="col-6">
            <h1>Conditions générales de la plateforme Formation.mg</h1>
            <h2>Accès aux Services</h2>
            1. Capacité juridique
                <h6>Les services sont accessibles à toute personne morale agissant par l’intermédiaire d’une personne physique disposant de la capacité juridique pour contracter au nom et pour le compte de la personne morale.</h6><br>
            2. Services destinés exclusivement aux professionnel.
                <h6>Les Services s’adressent exclusivement aux professionnels entendus comme toutes personnes physiques ou morales exerçant une activité rémunérée de façon non occasionnelle dans tous les secteurs liés à la formation ou à la gestion de compétences. </h6><br>
            3. Commande des Services et acceptation des conditions générales
                <h6>La validation du Devis par le Client, toute commande de Service ou toute souscription d’abonnement nécessite son inscription sur le Site, et l’acceptation pleine et entière des dispositions des présentes conditions générales.
            Toute adhésion sous réserve est considérée comme nulle et non avenue.</h6>
            <h2>Inscription</h2>
            <h6>1. L’accès aux Services nécessite que le Client s’inscrive sur le Site, lui-même ou par le biais d’un administrateur qu’il aura désigné, en remplissant le formulaire prévu à cet effet.
                </h6><br>
            <h6>2. Le Client, ou l’administrateur, doit fournir l’ensemble des informations marquées comme obligatoires, notamment son nom, prénom, adresse email professionnelle et mot de passe. Il reconnaît et accepte que l’adresse email renseignée sur le formulaire d’inscription constitue son identifiant de connexion.</h6><br>
            <h6>Toute inscription incomplète ne sera pas validée. </h6><br>
            <h6>L’inscription entraîne l’ouverture d’un compte au nom du Client , lui donnant accès à un espace personnel qui lui permet de gérer son utilisation des Services sous une forme et selon les moyens techniques que Formation.mg juge les plus appropriés pour rendre lesdits Services.</h6><br>
            <h6>Le Client garantit que toutes les informations qu’il donne dans le formulaire d’inscription sont exactes, à jour et sincères et ne sont entachées d’aucun caractère trompeur.</h6><br>
            <h6>Il s’engage à mettre à jour ces informations dans son Espace Personnel en cas de modifications, afin qu’elles correspondent toujours aux critères susvisés.</h6><br>
            <h6> Client est informé et accepte que les informations saisies aux fins de création ou de mise à jour de son Compte, par lui ou par le biais de l’Administrateur, vaillent preuve de son identité. Les informations saisies par le Client l’engagent dès leur validation.</h6>
            <h2>Usage strictement personnel, Comptes administrateurs et utilisateurs</h2>
            <h6>Une fois son inscription validée, le Client, ou l’administrateur qu’il aura désigné, dispose de la faculté de créer plusieurs comptes utilisateurs via son Espace Personnel, donnant accès aux Services.</h6><br>
            <h6> appartient au Client ou à l’administrateur de sélectionner les utilisateurs ayant accès à l’Application ou aux Services, dans la limite du nombre maximum prévu dans l’abonnement du Client, de déterminer la nature des accès qui leur sont donnés, ainsi que les données et informations auxquelles ils ont accès.</h6><br>
            <h6>L’utilisateur et/ou l’administrateur peuvent accéder à tout moment au Compte du Client par le biais de leur propre Espace Personnel, après s’être identifiés à l’aide de leur identifiant de connexion ainsi que de leur mot de passe.</h6><br>
            <h6>L’utilisateur et l’administrateur s’engagent à utiliser personnellement les Services et à ne permettre à aucun tiers de les utiliser à leur place ou pour leur compte, sauf à en supporter l’entière responsabilité.</h6><br>
            <h6>Ils sont pareillement responsables du maintien de la confidentialité de leur identifiant et de leur mot de passe, et reconnaissent expressément que toute utilisation des Services depuis leur Compte sera réputée avoir été effectuée par eux. Ces derniers doivent immédiatement contacter Formation;mg s’ils remarquent que leur Compte a été utilisé à leur insu. Ils reconnaissent à formation.mg le droit de prendre toutes mesures appropriées en pareil cas.</h6><br>
            <h6>Le Client est responsable de l’utilisation des Services par l’administrateur et les utilisateurs. Toute utilisation des Services avec l’identifiant et le mot de passe d’un Compte administrateur et/ou utilisateur est réputée effectuée par le Client.</h6><br>
            <h2>Durée de l’abonnement, désinscription</h2>
            <h6>1. La licence d’utilisation de l’Application et l’ensemble des Services prévus aux présentes sont souscrits par le Client sous la forme d’un abonnement mensuel ou annuel, dont la date de début est indiquée dans l’email de confirmation de son inscription. Cet abonnement se renouvellera ensuite tacitement pour une période de même durée, sauf dénonciation par l’une ou l’autre des parties adressée à l’autre partie par tout moyen écrit 8 (huit) jours au moins avant l’expiration de la période en cours.
            </h6>
            <h6>2. Tout abonnement aux Services est souscrit pour une durée indéterminée. La suppression d’un compte ne pourrait pas se faire, du fait que c’est un site collaboratif. Cependant, le client peut suspendre son compte  et y avoir accès dès qu’il entre son identifiant et son mot de passe.
            </h6>
        </main>
    </div>

</body>
</html>