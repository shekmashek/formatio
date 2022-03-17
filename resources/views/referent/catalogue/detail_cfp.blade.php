@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/annuaire.css')}}">
<section class="container-fluid">
    <div class="container pb-5">
        <div class="row details g-0">
            <div class="col-8 justify-content-center">
                <div id="result">
                    <div class="row details_content g-0">
                        <div class="col-3 logo_content">
                            <a href="#" class="text-center mb-2"><img src="{{asset("images/CFP/".$cfp[0]->logo_cfp)}}" alt="logo" class="img-fliud logo_img"></a>
                            <p class="text-center m-0 horloge"><i class="bx bx-alarm"></i>
                                Ouvert le
                                @php
                                    foreach ($cfp as $cfp_h) {
                                        setlocale(LC_TIME, "fr_FR");
                                        $jours1 = $cfp_h->jours;
                                        $ouverture = $cfp_h->h_entree;
                                        $fermeture = $cfp_h->h_sortie;
                                        $jours_today = strftime("%A", strtotime($jours1));
                                    }
                                    if ($jours1 = $jours_today) {
                                            echo (strftime("%A", strtotime($jours1))."<br/>");
                                            echo (date('H:i', strtotime($ouverture))." - ".date('H:i', strtotime($fermeture)));
                                        }
                                @endphp
                            </p>
                        </div>
                        <div class="col-9">
                            <div class="row ps-5">
                                <h4><a href="#">{{$cfp[0]->nom_cfp}}</a></h4>
                                <p>{{$cfp[0]->slogan}}</p>
                                <p class="mt-1"><i
                                        class="bx bx-map me-2"></i>{{$cfp[0]->adresse_lot_cfp}}&nbsp;{{$cfp[0]->adresse_quartier_cfp}}&sbquo;&nbsp;{{$cfp[0]->adresse_ville_cfp}}&nbsp;{{$cfp[0]->adresse_code_postal_cfp}}&sbquo;&nbsp;{{$cfp[0]->adresse_region_cfp}}
                                </p>
                                <div class="col-6 mb-3">
                                    <span class="text-muted"><i class="bx bx-phone"></i> Téléphone</span>
                                    <p class="m-0">{{$cfp[0]->tel_cfp}}</p>
                                </div>
                            </div>
                            <div class="col d-flex flex-row mb-2 ps-5">
                                <span class="btn_actions" role="button"><a href="#"><i
                                            class="bx bx-mail-send"></i>Email</a></span>
                                <span class="btn_actions ms-3" role="button"><a href="https://{{$cfp[0]->site_web}}" target="_blank"><i class="bx bx-globe"></i>Site
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
        </div>
        <div class="row">
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
                        @foreach ($cfp as $cfp)
                        <div class="row">
                            <div class="col-6">
                                <p class="m-0 text-capitalize">{{$cfp->jours}}</p>
                            </div>
                            <div class="col-6">
                                <p class="m-0">{{date('H:i', strtotime($cfp->h_entree))}} - {{date('H:i', strtotime($cfp->h_sortie))}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row avis mt-3">
                    <div class="col-12">
                        <h5>Trouvez-nous sur</h5>
                        <div class="row">
                            <div class="col-12 text-center">
                                @if(isset($cfp->lien_facebook))
                                <a href="https://{{$cfp->lien_facebook}}" target="_blank"><span><i class='bx bxl-facebook-circle'></i></span></a>
                                @endif
                                @if(isset($cfp->lien_twitter))
                                <a href="https://{{$cfp->lien_twitter}}" target="_blank"><span><i class='bx bxl-twitter' ></i></span></a>
                                @endif
                                @if(isset($cfp->lien_instagram))
                                <a href="https://{{$cfp->lien_instagram}}" target="_blank"><span><i class='bx bxl-instagram' ></i></span></a>
                                @endif
                                @if(isset($cfp->lien_linkedin))
                                <a href="https://{{$cfp->lien_linkedin}}" target="_blank"><span><i class='bx bxl-linkedin' ></i></span></a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9 px-5 mt-3 details_plus">
                <div class="row">
                    <h5>Présentation de l'entreprise</h5>

                    <p class="strong">{{$cfp->specialisation}}</p>
                    <p class="mb-2">{{$cfp->presentation}}</p>
                </div>
                <div id="domaines"></div>
                <div class="row mt-5">
                    <hr>
                    <h5>Domaines de formations</h5>
                    @foreach ($formation as $frm)
                    <div class="row">
                        <div class="col-4 p-2">
                            <p class="text-capitalize my-2"><a href="{{route("select_par_formation_par_cfp",[$frm->id,$cfp->cfp_id])}}" class="formations">{{$frm->nom_formation}}</a></p>
                        </div>
                    </div>
                    @endforeach
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

</section

@endsection