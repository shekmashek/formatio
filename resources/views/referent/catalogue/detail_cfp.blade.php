@extends('./layouts/admin')
@section('content')
{{-- <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> --}}
<link rel="stylesheet" href="{{asset('assets/css/annuaire.css')}}">
<section class="container-fluid">
    <div class="container-fluid g-0 p-0 recherche mb-5">
        <div class="row g-0 m-0 pt-3">
            <div class="col-3 logo_formation text-center">
                <img src="{{asset('img/images/logo_fmg54Ko.png')}}" alt="logo" class="img-fluid">
            </div>
            <div class="col-9">
                <form action="">
                    <div class="form-row d-flex">
                        <div class="col-9">
                            <div class="form-group">
                                <input type="text" class="form-control input" required name="organisme" id="organisme">
                                <label for="organisme" class="form-control-placeholder"><i
                                        class="bx bx-search me-3"></i>Numerika Center</label>
                            </div>
                        </div>
                        <div class="col-3 text-center">
                            <div class="form-group">
                                <button type="submit" class="btn_submit">Rechercher</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container pb-5">
        <div class="row details g-0">
            <div class="col-8 justify-content-center">
                <div id="result">
                    @foreach ($cfp as $cfp)
                    <div class="row details_content g-0">
                        <div class="col-3 logo_content">
                            <a href="{{route('detail_cfp',$cfp->id)}}" class="text-center mb-2"><img src="{{asset("images/CFP/".$cfp->logo)}}" alt="logo" class="img-fliud logo_img"></a>
                            <p class="text-center m-0"><i class="bx bx-alarm"></i> Fermé aujourd'hui<br />Ouvert le
                                mardi<br />09:00 - 17:30</p>
                        </div>
                        <div class="col-9">
                            <div class="row ps-5">
                                <h4><a href="{{route('detail_cfp',$cfp->id)}}">{{$cfp->nom}}</a></h4>
                                <p>{{$cfp->slogan}}</p>
                                <p class="mt-1"><i
                                        class="bx bx-map me-2"></i>{{$cfp->adresse_lot}}&nbsp;{{$cfp->adresse_quartier}}&sbquo;&nbsp;{{$cfp->adresse_ville}}&nbsp;{{$cfp->adresse_code_postal}}&sbquo;&nbsp;{{$cfp->adresse_region}}
                                </p>
                                <div class="col-6 mb-3">
                                    <span class="text-muted"><i class="bx bx-phone"></i> Téléphone</span>
                                    <p class="m-0">{{$cfp->telephone}}</p>
                                </div>
                            </div>
                            <div class="col d-flex flex-row mb-2 ps-5">
                                <span class="btn_actions" role="button"><a href="#"><i
                                            class="bx bx-mail-send"></i>Email</a></span>
                                <span class="btn_actions ms-3" role="button"><a href="#"><i class="bx bx-globe"></i>Site
                                        Web</a></span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-4 location">
                {{-- <a href="#"><img src="{{asset('images/CFP/Capture d’écran 2022-03-14 à 15.44.30.png')}}"
                        alt="location" class="img-fluid"></a> --}}
            </div>
            @endforeach
            <div class="col-12 mt-3 services">
                <div class="row text-center">
                    <div class="col-4"><a href="#presentation">
                            <p class="border_end choisir">Pourquoi nous choisir?</p>
                        </a></div>
                    <div class="col-4"><a href="#domaines">
                            <p class="border_end"><i class="bx bx-pyramid"></i>Domaines de Formations</p>
                        </a></div>
                    <div class="col-4"><a href="#avis">
                            <p><i class='bx bx-microphone'></i>Avis</p>
                        </a></div>
                    <div id="presentation"></div>

                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-3">
                <div class="row avis mt-3">
                    <div class="col-12">
                        <h5>Résumé des avis</h5>
                        <div class="row d-flex">
                            <div class="col-md-12 text-center d-flex flex-column">
                                <div class="rating-box">
                                    {{-- <h1 class="pt-4">{{ $res->pourcentage }}</h1> --}}
                                    <p class="m-0">sur 5</p>
                                </div>
                                {{-- <div class="Stars" style="--note: {{ $res->pourcentage }};"></div> --}}
                            </div>
                        </div>
                        <div class="row d-flex">
                            <div class="col-md-12 pt-2">
                                <div class="table-rating-bar ">
                                    <table class="">
                                        <tr>
                                            <td class="rating-label">Excellent</td>
                                            <td class="rating-bar">
                                                <div class="bar-container">
                                                    {{-- <div class="bar-5"
                                                        style="--progress_bar: {{ $statistiques[0]->pourcentage_note }}%;">
                                                    </div> --}}
                                                </div>
                                            </td>
                                            {{-- <td class="text-right">{{ $statistiques[0]->pourcentage_note }}%
                                            </td> --}}
                                        </tr>
                                        <tr>
                                            <td class="rating-label">Bien</td>
                                            <td class="rating-bar">
                                                <div class="bar-container">
                                                    {{-- <div class="bar-4"
                                                        style="--progress_bar: {{ $statistiques[1]->pourcentage_note }}%;">
                                                    </div> --}}
                                                </div>
                                            </td>
                                            {{-- <td class="text-right">{{ $statistiques[1]->pourcentage_note }}%
                                            </td> --}}
                                        </tr>
                                        <tr>
                                            <td class="rating-label">Moyenne</td>
                                            <td class="rating-bar">
                                                <div class="bar-container">
                                                    {{-- <div class="bar-3"
                                                        style="--progress_bar: {{ $statistiques[2]->pourcentage_note }}%;">
                                                    </div> --}}
                                                </div>
                                            </td>
                                            {{-- <td class="text-right">{{ $statistiques[2]->pourcentage_note }}%
                                            </td> --}}
                                        </tr>
                                        <tr>
                                            <td class="rating-label">Normal</td>
                                            <td class="rating-bar">
                                                <div class="bar-container">
                                                    {{-- <div class="bar-2"
                                                        style="--progress_bar: {{ $statistiques[3]->pourcentage_note }}%;">
                                                    </div> --}}
                                                </div>
                                            </td>
                                            {{-- <td class="text-right">{{ $statistiques[3]->pourcentage_note }}%
                                            </td> --}}
                                        </tr>
                                        <tr>
                                            <td class="rating-label">Terrible</td>
                                            <td class="rating-bar">
                                                <div class="bar-container">
                                                    {{-- <div class="bar-1"
                                                        style="--progress_bar: {{ $statistiques[4]->pourcentage_note }}%;">
                                                    </div> --}}
                                                </div>
                                            </td>
                                            {{-- <td class="text-right">{{ $statistiques[4]->pourcentage_note }}%
                                            </td> --}}
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row avis mt-3">
                    <div class="col-12">
                        <h5>Horaires d'ouvertures</h5>
                        <div class="row">
                            <div class="col-6">
                                <p class="m-0">Lundi</p>
                            </div>
                            <div class="col-6">
                                <p class="m-0">08h30 - 18h00</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="m-0">Mardi</p>
                            </div>
                            <div class="col-6">
                                <p class="m-0">08h30 - 18h00</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="m-0">Mercredi</p>
                            </div>
                            <div class="col-6">
                                <p class="m-0">08h30 - 18h00</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="m-0">Jeudi</p>
                            </div>
                            <div class="col-6">
                                <p class="m-0">08h30 - 18h00</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="m-0">Vendredi</p>
                            </div>
                            <div class="col-6">
                                <p class="m-0">08h30 - 18h00</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="m-0">Samedi</p>
                            </div>
                            <div class="col-6">
                                <p class="m-0">08h30 - 18h00</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="m-0">Dimanche</p>
                            </div>
                            <div class="col-6">
                                <p class="m-0">Fermé</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row avis mt-3">
                    <div class="col-12">
                        <h5>Trouvez-nous sur</h5>
                        <div class="row">
                            <div class="col-12 text-center">
                                <span><i class='bx bxl-facebook-circle'></i></span>
                                <span><i class='bx bxl-twitter' ></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9 px-5 mt-3">
                <div class="row">
                    <h5>Présentation de l'entreprise</h5>
                    <p>Spécialistes de la fourniture et de la réparation d'ordinateurs, d'ordinateurs portables, d'imprimantes et d'accessoires à Kettering, Northamptonshire</p>
                    <p>Chez Kettering Laptops, nous vendons une gamme fantastique d'ordinateurs portables, de PC et d'imprimantes neufs et d'occasion ainsi qu'une vaste sélection d'accessoires informatiques. Nous proposons des réparations expertes en magasin ainsi qu'un service de réparation mobile à toutes les entreprises domestiques et petites entreprises de Kettering.</p>
                    <p>Nous sommes également un centre Epson Express et sommes spécialisés dans la fourniture et la réparation d'imprimantes Epson Express. Nous avons une variété d'imprimantes Epson en stock, des garanties prolongées et une large gamme d'encres et de papiers Epson à des prix réduits.</p>
                    <p>Qu'est-ce que les ordinateurs portables Kettering ont à vous offrir ?</p>
                    <ul>
                        <li>Nouveaux PC et ordinateurs portables</li>
                        <li>Réparations de PC et d'ordinateurs portables en magasin</li>
                        <li>Service de réparation d'ordinateurs mobiles</li>
                        <li>Spécialistes des imprimantes Epson Express</li>
                        <li>Suppression et protection des virus</li>
                        <li>Service et délai d'exécution efficaces</li>
                        <li>Service convivial et accessible</li>
                        <li>Prix compétitifs</li>
                    </ul>
                </div>
                <div id="domaines"></div>
                <div class="row mt-5">
                    <hr>
                    <h5>Domaines de formations</h5>
                    <div class="row">
                        <div class="col-4">
                            CÂBLES

                            NETTOYAGE INFORMATIQUE

                            ENTREPRISES INFORMATIQUES

                            CONSEIL EN INFORMATIQUE

                            CONSOMMABLES INFORMATIQUES

                            MATÉRIEL INFORMATIQUE

                            RÉSEAU INFORMATIQUE ET CÂBLAGE

                            PÉRIPHÉRIQUES D'ORDINATEUR

                            RECYCLAGE INFORMATIQUE

                            RÉPARATION INFORMATIQUE

                            SÉCURITÉ INFORMATIQUE

                            BOUTIQUES INFORMATIQUES

                            VENTES DE LOGICIELS INFORMATIQUES

                            SYSTÈMES INFORMATIQUES

                            TECHNICIENS EN INFORMATIQUE
                        </div>
                        <div class="col-4">
                            DES ORDINATEURS

                            CÂBLAGE DE DONNÉES

                            RÉCUPÉRATION DE DONNÉES

                            FOURNISSEURS DE DONNÉES ET SERVICES

                            REPRISE APRÈS SINISTRE

                            SERVICES INFORMATIQUES À DOMICILE

                            INFORMATIQUE

                            CARTOUCHES D'ENCRE

                            ACCÈS INTERNET

                            SUPPORT INFORMATIQUE

                            RÉPARATION D'ORDINATEURS PORTABLES

                            ORDINATEURS PORTABLES
                        </div>
                        <div class="col-4">
                            CÂBLAGE RÉSEAU

                            RÉPARATION D'IMPRIMANTE

                            CARTOUCHES DE TONER

                            SUPPRESSION DE VIRUS ET DE LOGICIEL ESPION

                            WIFI

                            RÉSEAUX SANS FIL
                        </div>
                    </div>
                </div>
                <div id="avis"></div>
                <div class="detail__formation__programme__avis__donnes mt-3">
                    <hr>
                    {{-- @foreach ($liste_avis as $avis) --}}
                    <div class="row" id="avis">
                        <div class="d-flex flex-row">
                            <div class="col">
                                {{-- <h5 class="mt-3 mb-0">{{ $avis->nom_stagiaire }} {{ $avis->prenom_stagiaire }} --}}
                                </h5>
                            </div>
                            <div class="col">
                                {{-- <p class="text-muted pt-5 pt-sm-3">{{ $avis->date_avis }}</p> --}}
                            </div>
                            <div class="col">
                                <p class="text-left d-flex flex-row">
                                {{-- <div class="Stars" style="--note: {{ $avis->note }};"></div>&nbsp;<span class="text-muted">{{ $avis->note }}</span></p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row ms-1">
                        {{-- <p>{{ $avis->commentaire }}</p> --}}
                    </div>

                    {{-- @endforeach --}}
                </div>
            </div>
        </div>
    </div>

</section>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&v=weekly" async></script>
<script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8,
        });
    }
</> --}}

@endsection