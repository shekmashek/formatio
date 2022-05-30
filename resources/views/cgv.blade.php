

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
            line-height: 1.6rem;
        }
        .navperso{
            position: sticky;
            top: 5rem;
        }
    </style>
    <title> Formation.mg </title>
</head>
<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top text-secondary shadow-lg">
            <div class="container-fluid">
                <div class="left_menu ms-2">
                    <a style=" text-decoration: none;" href="{{ route('accueil_perso') }}">
                        <p class="titre_text m-0 p-0" style="color: black;">
                        <img class="img-fluid" src="{{ asset('maquette/logo_fmg54Ko.png') }}" width="40px" height="40px"> Formation.mg</p>
                    </a>
                </div>
                <div class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-lg-0 text-secondary">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Fonctionnalités
                        </a>
                        <ul class="dropdown-menu shadow-lg" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item mt-2" href="{{url('moderne')}}" target="_blank"><i class="far fa-mouse-pointer center" style="color:rgb(107, 204, 148); padding: 8px 10px; border-radius: 100%; font-size: 13px; background-color: rgb(198,246,213); "></i> &nbsp; Moderne, flexible et sécurusé</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('gestiond')}}" target="_blank"><i class="fad fa-file-alt" style="color:rgb(70, 151, 150); padding: 8px 10px; border-radius: 100%; font-size: 13px; background-color: rgb(178,245,234); "></i> &nbsp; Gestion documentaire</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('gestionf')}}" target="_blank"><i class="fad fa-euro-sign" style="color:rgb(76,81,191); padding: 8px 11px; border-radius: 100%; font-size: 13px; background-color: rgb(195,218,254); "></i> &nbsp; Gestion financière</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('gestiona')}}" target="_blank"><i class="fad fa-calendar-check" style="color:rgb(186, 79, 141); padding: 8px 10px; border-radius: 100%; font-size: 13px; background-color: rgb(254,252,191); "></i>&nbsp; Gestion administrative</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('gestionc')}}" target="_blank"><i class="far fa-users" style="color:rgb(43,108,176); padding: 8px 7px; border-radius: 100%; font-size: 13px; background-color: rgb(190,227,248); "></i>&nbsp; Gestion commerciale</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('qualite')}}" target="_blank"><i class="fad fa-clipboard" style="color:rgb(192,86,33); padding: 8px 10px; border-radius: 100%; font-size: 13px; background-color: rgb(254,235,200); "></i>&nbsp;&nbsp; Qualité</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('communication')}}" target="_blank"><i class="fad fa-comments-alt" style="color:rgb(200,58,58); padding: 8px 8px; border-radius: 100%; font-size: 13px; background-color: rgb(254,235,200); "></i>&nbsp;&nbsp;Communication</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('elearning')}}" target="_blank"><i class="fad fa-laptop" style="color:rgb(183,121,31); padding: 8px 7px; border-radius: 100%; font-size: 13px; background-color: rgb(254,252,191); "></i>&nbsp;&nbsp;E-learning</a></li>
                            <li><a class="dropdown-item mt-2" href="{{url('fonctionnalitea')}}" target="_blank"><i class="fad fa-search" style="color:rgb(100, 60, 194); padding: 8px 9px; border-radius: 100%; font-size: 13px; background-color: rgb(233,216,253); "></i>&nbsp;&nbsp;Fonctionnalités avancées</a></li>
                    </ul>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{url('tarifs')}}" target="_blank">Tarifs</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">À propos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('contact')}}"  target="_blank">Contactez-nous</a>
                    </li>
                </ul>
                <div class="d-flex" id="btn">
                        <li class="nav-item">
                            <a style="color:rgb(75, 75, 75); text-decoration: none" href="{{ route('sign-in') }}" >Se connecter </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" style="color:rgb(79, 79, 79);text-decoration: none; padding: 10px 5px; border: 1px solid #7535DC; border-radius: 35px; font-size: 13px;" >Voir une démo</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('create+compte+client')}}" style="color:white; text-decoration: none; padding: 10px 5px; border: 1px solid #7535DC; border-radius: 35px; font-size: 13px; background-color: #7b42d6; ">Créer un compte</a>
                        </li>
                </div>
                </div>
            </div>
        </nav>
        <div class="row col-12" style="margin-top: 70px;">
        <div class="col-3">
            <ul class="nav flex-column navperso ps-3" >
                <li class="nav-item">
                  <a class="nav-link text-dark" aria-current="page" href="#access">Accès aux Services</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="#inscription">Inscription</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-dark" href="#usage">Usage strictement personnel, Comptes administrateurs et utilisateurs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#duree">Durée de l’abonnement, désinscription</a>
                </li>
                <li class="nav-item">
                <a class="nav-link text-dark" href="#description">Description des Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#condition">Conditions financières</a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link text-dark" href="#responsabilite">Responsabilités et garanties du Client
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#comportement">Comportements prohibés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#obligation">Obligations et responsabilité du Formation.mg</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#propriete">Propriété Intellectuelle
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#donnees">Données à caractère personnel</a>
                </li> --}}

            </ul>
        </div>
        <div class="col-8 mb-3">
            <span class="float-end">Dernière mise à jour : le 27 Avril 2022 <hr class="my-2"></span><br>
            <div id = "access" class="mt-2"></div>
            <h1>Conditions générales de la plateforme </h1>
            <div>
                <h2>Accès aux Services</h2>
                1. Capacité juridique
                <h6>Les services sont accessibles à toute personne morale agissant par l’intermédiaire d’une personne physique disposant de 
                    la capacité juridique pour contracter au nom et pour le compte de la personne morale.</h6>
                2. Services destinés exclusivement aux professionnels.
                <h6>Les Services s’adressent exclusivement aux professionnels entendus comme toutes personnes physiques ou morales exerçant une activité 
                    rémunérée de façon non occasionnelle dans tous les secteurs liés à la formation ou à la gestion de compétences. </h6>
                3. Commande des Services et acceptation des conditions générales
                <h6 id="inscription" class="mt-3">La validation du devis par le client, toute commande de service ou toute souscription d’abonnement nécessite son 
                    inscription sur le site, et l’acceptation pleine et entière des dispositions des présentes conditions générales.
                    Toute adhésion sous réserve est considérée comme nulle et non avenue.</h6>
            </div>
            <div>
                <h2>Inscription</h2>
                <h6>1. L’accès aux services nécessite que le client s’inscrive sur le site, lui-même ou par le biais d’un administrateur qu’il aura désigné, 
                    en remplissant le formulaire prévu à cet effet.</h6>
                <h6>2. Le client, ou l’administrateur, doit fournir l’ensemble des informations marquées comme obligatoires, notamment son nom, prénom, adresse 
                    email professionnel et mot de passe. Il reconnaît et accepte que l’adresse email renseignée sur le formulaire d’inscription constitue son 
                    identifiant de connexion.</h6>
                <h6>Toute inscription incomplète ne sera pas validée. </h6>
                <h6>L’inscription entraîne :</h6>
                <ul class="list-group ps-3">
                    <li>- l’ouverture d’un compte au nom du client , lui donnant accès à un espace personnel qui lui permet de gérer son utilisation des services 
                    sous une forme et selon les moyens techniques que UPSKILL SARL juge les plus appropriés pour rendre lesdits services.</li>
                    <li>- la réception de tout mail envoyé par l’équipe de la plateforme, que ce soit à titre informatif ou publicitaire.</li>
                </ul>
                <h6>Le client garantit que toutes les informations qu’il donne dans le formulaire d’inscription sont exactes, à jour et sincères et 
                    ne sont entachées d’aucun caractère trompeur.</h6>
                <h6>Il s’engage à mettre à jour ces informations dans son espace personnel en cas de modifications, afin qu’elles correspondent toujours aux critères 
                    susvisés.</h6>
                <h6 id="usage" class="mt-3"> Le client est informé et accepte que les informations saisies aux fins de création ou de mise à jour de son compte, par lui ou par
                     le biais de l’administrateur, vaillent preuve de son identité. Les informations saisies par le client l’engagent dès leur validation.</h6>
            </div>
            <div>
                <h2>Usage strictement personnel, comptes administrateurs et utilisateurs</h2>
                <h6>Une fois son inscription validée, le client, ou l’administrateur qu’il aura désigné, dispose de la faculté de créer plusieurs comptes utilisateurs 
                    via son espace personnel, donnant accès aux services.</h6>
                <h6> Il appartient au client ou à l’administrateur de sélectionner les utilisateurs ayant accès à l’application ou aux services, dans la limite du 
                    nombre maximum prévu dans l’abonnement du client, de déterminer la nature des accès qui leur sont donnés, ainsi que les données et informations 
                    auxquelles ils ont accès.</h6>
                <h6>L’utilisateur et/ou l’administrateur peuvent accéder à tout moment au compte du client par le biais de leur propre espace personnel, après s’être 
                    identifiés à l’aide de leur identifiant de connexion ainsi que de leur mot de passe.</h6>
                <h6>L’utilisateur et l’administrateur s’engagent à utiliser personnellement les services et à ne permettre à aucun tiers de les utiliser à
                     leur place ou pour leur compte, sauf à en supporter l’entière responsabilité.</h6>
                <h6>Ils sont pareillement responsables du maintien de la confidentialité de leur identifiant et mot de passe, et reconnaissent expressément que 
                    toute utilisation des services depuis leur compte sera réputée avoir été effectuée par eux.  Ils doivent communiquer immédiatement avec UPSKILL SARL 
                    s'ils s'aperçoivent que leur compte a été utilisé à leur insu. Ils reconnaissent à UPSKILL SARL le droit de prendre toutes mesures appropriées en 
                    pareil cas.
                </h6>
                <h6 id="duree" class="mt-3">Le client est responsable de l’utilisation des services par l’administrateur et les utilisateurs. Toute utilisation des services avec 
                    l’identifiant et le mot de passe d’un compte administrateur et/ou utilisateur est réputée effectuée par le client.</h6>
            </div>
            <div>
                <h2>Durée de l’abonnement, désinscription</h2>
                <h6>1.L’utilisation de l’application et l’ensemble des services prévus aux présentes sont souscrits par le client sous la forme d’un 
                    abonnement mensuel ou annuel, dont les dates de début et fin sont indiquées dans l’email de confirmation de son inscription.
                     Cet abonnement se renouvellera ensuite automatiquement pour une période de même durée, sauf dénonciation par l’une ou l’autre des parties 
                     adressée à l’autre partie par tout moyen écrit 15 (quinze) jours avant l’expiration de la période en cours.</h6>
                <h6 id="description" class="mt-3">2. Tout abonnement aux services est souscrit pour une durée indéterminée. Toutefois, il est impossible de supprimer un 
                    compte parce qu'il s'agit d'un site collaboratif. Par contre, le client peut suspendre son compte et y accéder dès qu'il entre son nom 
                    d'utilisateur et son mot de passe.</h6>
            </div>
            <div>
                <h2>Description des services</h2>
                <h6>1. Licence(s) d’utilisation de l’application</h6>
                <h6 style="margin-left: 10px">1.1 Objet de la licence</h6>
                <h6>UPSKILL SARL  concède au client une licence non exclusive, personnelle et non transmissible d’utilisation de son application, dans sa version 
                    existante à la date des présentes et dans toutes éventuelles versions à venir, aux seules fins de la fourniture des services.</h6>
                <h6>L’accès à l’application est fourni : </h6>
                <ul class="list-group ps-3">
                    <li>- gratuitement en ce qui concerne les trois premiers mois (essai) ;</li>
                    <li>- moyennant un abonnement payant les mois suivant l'essai.</li>
                </ul>
                <h6>Cette licence est consentie pour le monde entier et pour la durée de l’abonnement souscrit.</h6>
                <h6>Il est interdit au client d’en céder ou d’en transférer le bénéfice à un tiers, quel qu’il soit.</h6>
                <h6 style="margin-left: 10px">1.2 Hébergement</h6>
                <h6>Le client n’autorise aucune utilisation des données collectées par le biais de l’application par UPSKILL SARL  ou par un tiers, qui ne serait pas 
                    rendue nécessaire par l’exécution du contrat, sans son autorisation explicite et écrite.</h6>
                <h6>UPSKILL SARL s’engage à mettre en œuvre l’ensemble des moyens techniques conformes à l’état de l’art nécessaire pour assurer la sécurité et
                     l’accès à l’application et aux services, portant sur la protection et la surveillance des infrastructures, le contrôle de l’accès physique 
                     et/ou immatériel auxdites infrastructure, ainsi que sur la mise en œuvre des mesures de détection, de prévention et de récupération pour 
                     protéger ses serveurs d’actes malveillants.</h6>
                <h6>Eu égard à la complexité d’internet, l’inégalité des capacités des différents sous-réseaux, l’afflux à certaines heures des clients de l’application,
                     aux différents goulots d’étranglement sur lesquels UPSKILL SARL  n’a aucune maîtrise, la responsabilité de UPSKILL SARL  sera limitée au 
                     fonctionnement de ses propres serveurs, dont les limites extérieures sont constituées par les points de raccordement.</h6>
                <h6>UPSKILL SARL  ne saurait être tenue pour responsable (i) de l’indisponibilité des serveurs du client ou de ceux de son système d’exploitation, 
                    (ii) des vitesses d’accès à ses serveurs, (iii) des ralentissements externes à ses serveurs, et (iv) des mauvaises transmissions dues à une
                     défaillance ou à un dysfonctionnement de ses réseaux.</h6>
                <h6 style="margin-left: 10px">1.3 Maintenance évolutive</h6>
                <h6>UPSKILL SARL s’engage à faire bénéficier le client des évolutions et mises à jour de son application, dont la nature et la fréquence seront 
                    laissées à la libre appréciation de UPSKILL SARL .</h6>
                <h6>UPSKILL SARL se réserve la possibilité de limiter ou de suspendre l’accès à l’application pendant les opérations de maintenance. 
                    Elle informera le client au préalable par tout moyen utile de la réalisation de ces opérations.</h6>
                <h6 style="margin-left: 10px">1.4 Support technique</h6>
                <h6>En dehors des dysfonctionnements et pour toute question liée à la simple utilisation des services, UPSKILL SARL offre au client un support
                     technique consistant en une assistance et un conseil.</h6>
                <h6>Le support technique est aussi accessible à l’adresse email contact-mg@upskill-sarl.com.</h6>
                <h6 style="margin-left: 10px">1.5 Autres Services</h6>
                <h6>UPSKILL SARL se réserve le droit de proposer tous autres services ou abonnement qu’elle jugera utile, sous une forme et selon les fonctionnalités 
                    et moyens techniques qu’elle estimera les plus appropriés pour rendre lesdits services. Aucune prestation supplémentaire n’aura lieu sans que le
                     client n’en ait accepté le prix et les conditions de mise en œuvre de façon expresse, préalable et par écrit.</h6>
            </div>
            <div>
                <h2>Conditions financières</h2>
                <h6>1. Prix des services </h6>
                <h6>En contrepartie de la réalisation des services, le client s’engage à payer à UPSKILL SARL le prix de l’abonnement choisi, tel qu’indiqué sur 
                    le site et préalablement à son inscription mensuelle ou annuelle, par virement bancaire.</h6>
                <h6>2. Facturation </h6>
                <h6>Les services font l’objet de factures ponctuelles ou mensuelles communiquées au client par email et à chaque nouvelle souscription de service ou 
                    d’abonnement.</h6>
                <h6 id="condition" class="mt-3">3. Révision du Prix </h6>
                <h6>Le Prix a été calculé en fonction de l’abonnement choisi par le client et des options éventuellement souscrites. Si l’un de ces paramètres venait
                     à évoluer en cours de contrat, le prix des services serait recalculé en conséquence.</h6>
                <h6>4. Retards et défauts de paiement</h6>
                <h6>De convention expresse entre les parties, tout retard de paiement de tout ou partie d’une somme due à son échéance au titre de l’exécution des 
                    services entraînera automatiquement et sans mise en demeure préalable : la suspension immédiate des services jusqu’au complet paiement de 
                    l’intégralité des sommes dues.</h6>
            </div>
        </div>
        <footer class="footer_container">
            <div class="d-flex justify-content-center pt-3">
                <div class="bordure">&copy; Copyright 2022</div>
                <div class="bordure"><a href="{{url('info_legale')}}" style="color:#801D68 !important" target="_blank">Informations légales</a></div>&nbsp;
                <div><a href="{{url('contact')}}" class="bordure" style="color: #801D62;" target="_blank">Contactez-nous</a></div>&nbsp;
                <div class="bordure"><a href="{{url('politique_confidentialites')}}" class="bordure" style="color: #801D62;" target="_blank">Politique de confidentialités</a></div>&nbsp;
                <div class="bordure" > <a href="{{route('condition_generale_de_vente')}}" style="color:#801D68 !important" target="_blank"> Condition d'utilisation</a> </div>&nbsp;
                <div class="bordure"> <a href="{{url('tarifs')}}" style="color:#801D68 !important" target="_blank"> Tarifs</a></div>
                <div class="bordure">Crédits</div>
                <div> &nbsp; V 1.0.9</div>
            </div>
        </footer>
    </div>
</body>
</html>
