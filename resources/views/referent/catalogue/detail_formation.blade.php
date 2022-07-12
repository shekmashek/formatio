@extends('./layouts/admin')
@inject('groupe', 'App\groupe')
@section('content')
<link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/css/formation.css')}}">
@if (Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! Session::get('error') !!}</li>
        </ul>
    </div>
@endif
<div class="row navigation_detail">
    <div class="ps-5">
        <ul class="">
            <div class="row align-items-center">
                <div class="col-3">
                    <li>
                        <h3 class="text-center">Que voulez-vous apprendre?</h3>
                    </li>
                </div>
                <div class="col-6">
                    <li class="me-5">
                        <div class="row content_search text-center">
                            <form method="GET" action="{{route('result_formation')}}">
                                @csrf
                                <div class="form-row">
                                    <div class="d-flex flex-row">
                                        @foreach ($categorie as $categ)
                                            <input type="hidden" name="id_formation" value="{{$categ->id}}">
                                        @endforeach
                                        <input class="form-control me-2" type="text" name="nom_formation" placeholder="Rechercher par formations ex. Excel">
                                        <button type="submit" class="btn"><i class="bx bx-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                </div>
                <div class="col-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropbtn text-center mt-3" href="#" id="domaine_dropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-menu icon_dom fs-4 me-2'></i>Domaines de Formations
                        </a>
                        <div class="dropdown-menu mega_menu pt-0 mt-3" aria-labelledby="domaine_dropdown">
                            <div class="d-flex align-items-start flex-column flex-sm-row px-3 py-5">
                                <div>
                                    @foreach ($domaine_col1 as $dom)
                                        <a class="dropdown-item" href="{{route('domaine_vers_formation',$dom->id)}}">{{$dom->nom_domaine}}</a>
                                    @endforeach
                                </div>
                                <div>
                                    @foreach ($domaine_col2 as $dom)
                                        <a class="dropdown-item" href="{{route('domaine_vers_formation',$dom->id)}}">{{$dom->nom_domaine}}</a>
                                    @endforeach
                                </div>
                                <div>
                                    @foreach ($domaine_col3 as $dom)
                                        <a class="dropdown-item" href="{{route('domaine_vers_formation',$dom->id)}}">{{$dom->nom_domaine}}</a>
                                    @endforeach
                                </div>
                                <div>
                                    @foreach ($domaine_col4 as $dom)
                                        <a class="dropdown-item" href="{{route('domaine_vers_formation',$dom->id)}}">{{$dom->nom_domaine}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
            </div>
        </ul>
    </div>
</div>
<section class="detail__formation mb-5" >
    <nav class="navigation_details d-flex flex-row justify-content-between">
        <div>
            <ul class="d-flex flex-row">
                <li class="me-5"><a href="#objectif"><i class='bx bx-target-lock encre_icon me-2'></i>objectif</a></li>
                <li class="me-5"><a href="#pour_qui"><i class='bx bx-user encre_icon me-2'></i>pour qui ?</a></li>
                <li class="me-5"><a href="#programme"><i class='bx bx-list-minus encre_icon me-2'></i>programme</a></li>
                <li class="me-5"><a href="#avis"><i class='bx bxs-edit-alt encre_icon me-2'></i>Avis</a></li>
                <li class="me-5"><a href="#dates"><i class='bx bxs-calendar-check encre_icon me-2'></i>dates</a></li>
                @can('isReferent')
                <li class="me-5"><a href="{{route('demande_devis_client',$infos[0]->module_id)}}"><i class='bx bxs-cart-download encre_icon me-2'></i>Demander un devis</a></li>
                @endcan
                <li class="me-5"><a class="print_to_pdf"><i class='bx bxs-download encre_icon me-2'></i>telecharger en pdf</a></li>

            </ul>
        </div>
        {{-- <div>
            <button class="btn_pdf px-4 py-1" type="button"><i class='bx bxs-cloud-download me-3'></i>PDF</button>
        </div> --}}
    </nav>
    <div class="container py-5" id="printToPdf">
        <div class="row justify-content-space-between py-3 back" id="border_premier">
            <div class="col-lg-8 col-md-8 pe-5 module_detail">
                <div class="detail__formation__result__item">
                    @foreach ($infos as $res)
                    <h4 class="py-4">{{$res->nom_module}}</h4>
                    <p class="lien_formation"><a href="{{route('affichage_formation',$res->formation_id)}}">{{$res->nom_formation}}</a></p>
                    <p>{{$res->description}}</p>
                    <div class="detail__formation__result__avis d-flex flex-row">
                        <div class="Stars" style="--note: {{ $res->pourcentage }};"></div>
                        <div class="stars">
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star'></i>
                            <i class='bx bxs-star-half' ></i>
                            <i class='bx bx-star'></i>
                            <i class='bx bx-star'></i>
                        </div>
                        <span class="ms-2">{{ $res->pourcentage }}/5 ({{ $nb_avis }} avis)</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 ">
                <div class="">
                    <a href="{{route('detail_cfp',$res->cfp_id)}}">
                        <h6 class="py-4 text-center">Formation Proposée par&nbsp;<span>{{$res->nom}}</span></h6>
                        <div class="text-center">
                            <img src="{{asset('images/CFP/'.$res->logo)}}" alt="logo" class="img-fluid" style="width: 200px; height:100px;">
                        </div>
                    </a>
                    @if($avis_etoile!=null)
                        @if($avis_etoile[0]->pourcentage != null)
                        <div class="d-flex flex-row justify-content-center mt-2">
                            @if($avis_etoile[0]->pourcentage != null)
                                <div class="Stars" style="--note: {{ $avis_etoile[0]->pourcentage }};"></div>
                                <div class="stars">
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star'></i>
                                    <i class='bx bxs-star-half' ></i>
                                    <i class='bx bx-star'></i>
                                    <i class='bx bx-star'></i>
                                </div>
                            @else
                                <div class="Stars" style="--note: 0;"></div>
                            @endif
                            <div class="rating-box ms-2">
                                @if($avis_etoile[0]->pourcentage != null)
                                    <span class="avis_verif"><span class="">{{ $avis_etoile[0]->pourcentage }}</span> ({{$avis_etoile[0]->nb_avis}} avis)</span><br>
                                @else
                                    <span class="">0 sur 5 (0 avis)</span>
                                @endif
                            </div>
                            <br>
                        </div>
                        @else
                        <div class="text-center">
                            <span>Avis sur le centre de formation</span>
                        </div>
                        @endif
                    @endif
                </div>
            </div>
            <div id="objectif"></div>
            <div class="row row-cols-auto module_detail_heure py-3">
                <div class="col background_contrast"><i class="bx bxs-alarm bx_icon"></i>
                    <span>
                        @isset($res->duree_jour)
                        {{$res->duree_jour}} jours
                        @endisset
                    </span>
                    <span>
                        @isset($res->duree)
                        /{{$res->duree}} h
                        @endisset
                    </span> </p>
                </div>
                <div class="col background_contrast"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$res->modalite_formation}}</span>
                </div>
                <div class="col background_contrast">
                    @foreach ($niveau as $level)
                    @if($res->niveau_id == $level->id)
                        <i class='bx bx-signal-5 bx_icon bx_pourcentage' style="--pourcentage: {{$level->progression}}"></i><i class='bx bx-signal-5 bx_icon level_cacher'></i><span>&nbsp;{{$level->niveau}}</span>
                    @endif
                    @endforeach
                </div>
                <div class="col background_contrast"><i class='bx bx-clipboard bx_icon'></i><span>&nbsp;{{$res->reference}}</span></div>
                @if($res->prix == 0)
                    <div class="col background_contrast" ><span >Prix sur demande de devis</span></div>
                @else
                    <div class="col background_contrast" ><span >{{$devise->devise}}&nbsp;{{number_format($res->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pax</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></span></div>
                @endif
                @if($res->prix_groupe != null)
                    <div class="col background_contrast" ><span >{{$devise->devise}}&nbsp;{{number_format($res->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;/ {{$res->max_pers}} pax</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></span></div>
                @endif
                {{-- <div class="col pt-1" ><a href="#" role="button" class="btn_demander">Demander un dévis</a></div>
                <div class="text-center mt-5"><a href="#" role="button" class="btn_demander">Demander un dévis</a></div> --}}
            </div>
        </div>
        {{-- <div class="html2pdf__page-break"></div> --}}

        <div class="row detail__formation__detail py-5">

            <div class="col-lg pe-5">
                {{-- section 0 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pb-3"><i class='bx bx-target-lock encre__icon me-2'></i><i class='bx bx-target-lock encre__icon_cacher me-2'></i>Objectifs de la formation</h3>
                <div class="row module_detail_content p-2">
                    <div class="col-lg-12">
                        <p id="objectif_content">{{$res->objectif}}</p>
                        <div id="pour_qui"></div>
                    </div>
                </div>
                <div class="html2pdf__page-break"></div>
                {{-- section 1 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pt-3 pb-3 mt-5"><i class='bx bx-user encre__icon me-2'></i><i class='bx bx-user encre__icon_cacher me-2'></i>A qui s'adresse cette formation?</h3>
                <div class="row justify-content-between">
                    <div class="col d-flex flex-row module_detail_objet me-3">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i class="bx bx-user adresse__icon"></i>&nbsp;Pour qui
                                ?</span>
                            <div class="col-12 ps-4">
                                {{-- <p>@php echo html_entity_decode($res->cible) @endphp</p> --}}
                                <p id="cible_content">{{$res->cible}}</p>

                            </div>
                        </div>
                    </div>

                    <div class="col module_detail_objet">
                        <div class="row d-flex flex-row w-100">
                            <span class="adresse__text"><i
                                    class="bx bx-list-plus adresse__icon"></i>&nbsp;Prérequis</span>
                            <div class="col-12 ps-4">
                                {{-- <p>@php echo html_entity_decode($res->prerequis) @endphp</p> --}}
                                <p id="prerequis_content">{{$res->prerequis}}</p>

                            </div>
                        </div>
                        <div class="row d-flex flex-row">
                            <div class="col-12 ps-4">
                                <p>Évaluez votre niveau en <a href="#">cliquant ici.</a> </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between">
                    <div class="col d-flex flex-row module_detail_objet me-3">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-cog adresse__icon"></i>&nbsp;Equipement
                                necessaire</span>
                            <div class="col-12 ps-4">
                                {{-- <p>@php echo html_entity_decode($res->materiel_necessaire) @endphp</p> --}}
                                <p id="equipement_content">{{$res->materiel_necessaire}}</p>

                            </div>
                        </div>
                    </div>

                    <div class="col module_detail_objet">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-message-check adresse__icon"></i>&nbsp;Bon
                                a savoir</span>
                            <div class="col-12 ps-4">
                                {{-- <p>@php echo html_entity_decode($res->bon_a_savoir) @endphp</p> --}}
                                <p id="bon_a_savoir_content">{{$res->bon_a_savoir}}</p>

                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="html2pdf__page-break"></div> --}}
                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-12 d-flex flex-row module_detail_objet">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bx-hive adresse__icon"></i>&nbsp;Prestations
                                pedagogiques</span>
                            <div class="col-12 ps-4">
                                {{-- <p>@php echo html_entity_decode($res->prestation) @endphp</p> --}}
                                <p id="prestation_content">{{$res->prestation}}</p>

                            </div>
                        </div>
                        <div id="programme"></div>
                    </div>
                </div>
                @endforeach
                <div id="programme__formation"></div>
                <div class="html2pdf__page-break"></div>
                {{-- section 3 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pt-3"><i class='bx bx-list-minus encre__icon me-2'></i><i class='bx bx-list-minus encre__icon_cacher me-2'></i>Programme de la formation</h3>
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="accordion" id="accordion__program">
                                <?php $i=1 ?>
                                @foreach ($programmes as $prgc)
                                <div class="card mb-4">
                                    <div class="card-header" id="heading1">
                                        <h2 class="mb-0"><button class="btn btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapse{{$i}}"
                                                aria-expanded="true" id="icon" aria-controls="collapse1">{{$i}} - {{$prgc->titre}}</button></h2>
                                    </div>
                                    @foreach ($cours as $c)
                                    @if($c->programme_id == $prgc->id)
                                    <div id="collapse{{$i}}" class="collapse show ps-3" aria-labelledby="heading1"
                                        data-parent="#accordion__program">
                                        <div class="card-body"> <i
                                                class="bx bx-chevron-right"></i>&nbsp;{{$c->titre_cours}}</div>
                                    </div>
                                    @endif
                                    @endforeach
                                    <?php $i++ ?>
                                </div>
                                @endforeach
                                <div id="avis"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="html2pdf__page-break"></div>
                <div class="row afficher_pdf">
                    <div class="col justify-content-center">
                        <div>
                            <h3 class="pt-3 pb-0"><i class='bx bxs-cog encre__icon me-2'></i><i class='bx bxs-cog encre__icon_cacher me-2'></i>Compétences à acquérir</h3>
                        </div>
                        <canvas id="marksChart1" width="500" height="300"></canvas>
                    </div>

                </div>

                {{-- section 5 --}}
                {{-- FIXME:mise en forme de design --}}
                <div class="html2pdf__page-break"></div>
                <div class="row detail__formation__programme__avis">
                    <div>
                        <h3 class="pt-5 pb-0"><i class='bx bxs-edit-alt encre__icon me-2'></i><i class='bx bxs-edit-alt encre__icon_cacher me-2'></i>Avis sur la formation</h3>
                    </div>
                    <div class="col-12 mb-5">
                        <div class="card p-2 pt-1">
                            <div class="row detail__formation__programme__avis__rated d-flex">
                                <div class="col-md-4 text-center d-flex flex-column">
                                    <div class="rating-box">
                                        <h3 class="pt-4">
                                            @if($res->pourcentage != null)
                                                {{$res->pourcentage}} avis
                                            @else
                                                0 avis
                                            @endif
                                        </h3>
                                        <p class="">sur 5</p>
                                    </div>
                                    <div class="Stars" style="--note: {{ $res->pourcentage }};"></div>
                                    <div class="stars">
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star'></i>
                                        <i class='bx bxs-star-half' ></i>
                                        <i class='bx bx-star'></i>
                                        <i class='bx bx-star'></i>
                                    </div>
                                </div>
                                <div class="col-md-8 pt-2 ">
                                    <div class="table-rating-bar justify-content-center">
                                        <table class="text-left mx-auto">
                                            <tr>
                                                <td class="rating-label">Excellent</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        <div class="bar-5"
                                                            style="--progress_bar: {{ $statistiques[0]->pourcentage_note }}%;">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ $statistiques[0]->pourcentage_note }}%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="rating-label">Bien</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        <div class="bar-4"
                                                            style="--progress_bar: {{ $statistiques[1]->pourcentage_note }}%;">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ $statistiques[1]->pourcentage_note }}%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="rating-label">Moyenne</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        <div class="bar-3"
                                                            style="--progress_bar: {{ $statistiques[2]->pourcentage_note }}%;">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ $statistiques[2]->pourcentage_note }}%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="rating-label">Normal</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        <div class="bar-2"
                                                            style="--progress_bar: {{ $statistiques[3]->pourcentage_note }}%;">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ $statistiques[3]->pourcentage_note }}%
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="rating-label">Terrible</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        <div class="bar-1"
                                                            style="--progress_bar: {{ $statistiques[4]->pourcentage_note }}%;">
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ $statistiques[4]->pourcentage_note }}%
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="detail__formation__programme__avis__donnes mt-5">
                            @foreach ($liste_avis as $avis)
                            <div class="row">
                                <div class="d-flex flex-row">
                                    <div class="col">
                                        <h5 class="mt-3 mb-0">{{ $avis->nom_stagiaire }}.{{ $avis->prenom_stagiaire }}
                                        </h5>
                                    </div>
                                    <div class="col">
                                        <p class="text-muted pt-5 pt-sm-3">{{ $avis->date_avis }}</p>
                                    </div>
                                    <div class="col text-left d-flex flex-row align-content-center">
                                        {{-- <p class=""> --}}
                                            <div class="Stars" style="--note: {{ $avis->note }};"></div>
                                            <div class="stars">
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star'></i>
                                                <i class='bx bxs-star-half'></i>
                                                <i class='bx bx-star'></i>
                                                <i class='bx bx-star'></i>
                                            </div>
                                        &nbsp;<span class="text-muted">{{ $avis->note }}</span>
                                        {{-- </p> --}}
                                    </div>
                                </div>
                            </div>
                            <div class="row ms-1 mb-3">
                                <p>{{ $avis->commentaire }}</p>
                            </div>
                            @endforeach
                            @if(count($liste_avis_count) >= 10)
                                <div class="text-end"><a class="btn btn_fermer plus_avis" role="button" role="button" id="{{$infos[0]->module_id}}">voir tous les avis</a></div>
                            @endif
                            <div class="newRowAvis"></div>
                            <div class="text-end"><a class="btn btn_fermer moins_avis" role="button" role="button" ><i class='bx bxs-chevron-up me-2' ></i>afficher moins d'avis</a></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-none">
                <textarea id="objectif_textarea" name="objectif" placeholder="Ajouter des textes" style="display: none"></textarea>
                <div id="objectif_id">
                    <p>@php echo html_entity_decode($res->objectif) @endphp</p>
                </div>

                <textarea id="public_textarea" name="public_cible" placeholder="Ajouter des textes" style="display: none"></textarea>
                <div id="public_id">
                    <p>@php echo html_entity_decode($res->cible) @endphp</p>
                </div>

                <textarea id="prerequis_textarea" name="prerequis" placeholder="Ajouter des textes" style="display: none"></textarea>
                <div id="prerequis_id">
                    <p>@php echo html_entity_decode($res->prerequis) @endphp</p>
                </div>

                <textarea id="equipement_textarea" name="equipement" placeholder="Ajouter des textes" style="display: none"></textarea>
                <div id="equipement_id">
                    <p>@php echo html_entity_decode($res->materiel_necessaire) @endphp</p>
                </div>

                <textarea id="bon_a_savoir_textarea" name="bon_a_savoir" placeholder="Ajouter des textes" style="display: none"></textarea>
                <div id="bon_a_savoir_id">
                    <p>@php echo html_entity_decode($res->bon_a_savoir) @endphp</p>
                </div>

                <textarea id="prestation_textarea" name="prestation" placeholder="Ajouter des textes" style="display: none"></textarea>
                <div id="prestation_id">
                    <p>@php echo html_entity_decode($res->prestation) @endphp</p>
                </div>
            </div>
            {{-- FIXME:mise en forme de design --}}
            <div class="col-lg-3 cacher_pdf">
                <div class="row detail__intra">
                    <div class="row g-0 m-0">
                        <div class="detail__prix">
                            <div class="detail__prix__text">
                                <p class="pt-2 text-uppercase"><b>competences a acquérir</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3">
                        {{-- @foreach ($competences as $compt)
                            <p><i class='bx bx-check-double text-success' ></i>&nbsp;{{$compt->titre_competence}}</p>
                        @endforeach --}}
                        <canvas id="marksChart" width="1000" height="800" class="justify-content-center"></canvas>

                    </div>
                    {{-- <div class="row g-0 m-0 detail_ref_ref">
                        <div class="col-lg-12 py-5">
                            <a href="{{route('demande_devis_client',$infos[0]->module_id)}}" role="button" class="btn_demander">Demander un dévis</a>
                        </div>
                    </div> --}}
                </div>
            </div>
            <input type="hidden" class="form-control" name="recuperer_module_id" id="mod_id_rec" value="{{$infos[0]->module_id}}">
        </div>
        <div class="html2pdf__page-break"></div>
        <div class="container">
            @if($datas == null)

            @else
            <div class="row ">
                <h3 class="pt-3 pb-3"><i class='bx bxs-calendar-check encre__icon me-2'></i><i class='bx bxs-calendar-check encre__icon_cacher me-2'></i>Dates et Villes Session Inter</h3>
                <div class="col-lg-12">
                    <div class="row">
                        <div id="dates"></div>
                        <ul>
                            @foreach ($datas as $data)
                            <li class="date_ville px-2 mb-2">
                                <div class="row">
                                    <div class="col-3 text-center">
                                        <span>Du @php setlocale(LC_TIME, "fr_FR"); echo strftime("%d %B, %Y",
                                            strtotime($data->date_debut)); @endphp au @php setlocale(LC_TIME, "fr_FR");
                                            echo strftime("%d %B, %Y", strtotime($data->date_fin)); @endphp</span>
                                    </div>
                                    <div class="col-3 text-center">
                                        <span>
                                            {{ $data->adresse_ville.' '.$data->adresse_lot }}
                                        </span>
                                    </div>
                                    <div class="col-3 text-center">
                                        <span>{{ number_format($infos[0]->prix, 0, ' ', ' ') }} AR HT</span>
                                    </div>
                                    {{-- @canany(['isManager','isReferent','isStagiaire']) --}}
                                    @canany(['isReferent','isReferentSimple'])
                                        <div class="col-3 text-center">
                                            <a href="{{route('inscriptionInter',[$data->groupe_id,$data->type_formation_id])}}" class="btn_enregistrer" role="button">
                                                @php
                                                    $inscrit = $groupe->inscrit_session_inter($data->groupe_id);
                                                    if ($inscrit == 0) {
                                                        echo "S'inscrire";
                                                    }
                                                    if ($inscrit == 1) {
                                                        echo "Déjà inscrit";
                                                    }
                                                @endphp
                                            </a>
                                        </div>
                                    @endcanany
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div id="elementH"></div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
          $( "#reference_search" ).autocomplete({
            source: function( request, response ) {
              // Fetch data
              $.ajax({
                url:"{{route('search__formation')}}",
                type: 'get',
                dataType: "json",
                data: {
                //    _token: CSRF_TOKEN,
                   search: request.term
                },
                success: function( data ) {
                    // alert("eto");
                   response( data );
                },error:function(data){
                    alert("error");
                    //alert(JSON.stringify(data));
                }
              });
            },
            select: function (event, ui) {
           // Set selection
           $('#reference_search').val(ui.item.label); // display the selected text
           return false;
        }
          });
        });
    $(".domaine").on('mouseover',function(e){
        var id = $(this).data("id");
        $.ajax({
        method: "GET",
        url:  "{{route('domaine_formation')}}",
        data:{domaine_id:id},
        dataType: "html",
        success:function(response){
            var userData=JSON.parse(response);
            var formations = userData[0];
            var modules = userData[1];
            var domaine_id = userData[2];
            $('.sous-formation-row').html('');
            var html = '';
             for (let i = 0; i < formations.length; i++) {
                var url_formation = '{{ route("select_par_formation", ":id") }}';
                url_formation = url_formation.replace(':id', formations[i].id);
                html += '<dl class="sous-formation-items" data-role="two-menu">';
                html += '<dt><a href="'+url_formation+'">'+formations[i].nom_formation+'</a></dt>';
                html += '<dd class="d-flex flex-column">';
                    for (let j = 0; j < modules.length; j++) {
                        if (formations[i].id == modules[j].formation_id) {
                            var url_module_detail = '{{ route("select_par_module", ":id") }}';
                            url_module_detail = url_module_detail.replace(':id', modules[j].module_id);
                            html += '<a href="'+url_module_detail+'">'+(modules[j].nom_module)+'</a>';
                        }
                    }
                html += '</dd>';
                html += '</dl>';
            }
            $(".dropdown>.dropdown-menu").css("display", "block");
            $('.sous-formation-row').append(html);
        },
        error:function(error){
            console.log(error)
        }
        });
        $(".sous-formation-content").on('mouseleave',function(e){
            $(".dropdown>.dropdown-menu").css("display", "none");
        });
    });


    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }

    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['code-block'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}],
        [{ 'script': 'sub'}, { 'script': 'super' }],

        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
        [{ 'font': [] }],
        [{ 'align': [] }]
    ];

    let objectif_editor = new Quill('#objectif_id', {
        modules: {
            toolbar: toolbarOptions
        },
        theme: 'snow',
    });

    let public_editor = new Quill('#public_id', {
        modules: {
            toolbar: toolbarOptions },
        theme: 'snow',
    });

    let prerequis_editor = new Quill('#prerequis_id', {
        modules: {
            toolbar: toolbarOptions },
        theme: 'snow',
    });

    let equipement_editor = new Quill('#equipement_id', {
        modules: {
            toolbar: toolbarOptions },
        theme: 'snow',
    });

    let bon_a_savoir_editor = new Quill('#bon_a_savoir_id', {
        modules: {
            toolbar: toolbarOptions },
        theme: 'snow',
    });

    let prestation_editor = new Quill('#prestation_id', {
        modules: {
            toolbar: toolbarOptions },
        theme: 'snow',
    });

    let objectif = objectif_editor.root.innerHTML;

    $('#objectif_content').html(objectif);
    $("#form_objectif").on("submit",function() {
        $("#objectif_textarea").val($("#objectif_id").html());
    });


    let cible = public_editor.root.innerHTML;
    $('#cible_content').html(cible);
    $("#form_public").on("submit",function() {
        $("#public_textarea").val($("#public_id").html());
    });

    let prerequis = prerequis_editor.root.innerHTML;
    $('#prerequis_content').html(prerequis);
    $("#form_prerequis").on("submit",function() {
        $("#prerequis_textarea").val($("#prerequis_id").html());
    });

    let equipement = equipement_editor.root.innerHTML;
    $('#equipement_content').html(equipement);
    $("#form_equipement").on("submit",function() {
        $("#equipement_textarea").val($("#equipement_id").html());
    });

    let bon_a_savoir = bon_a_savoir_editor.root.innerHTML;
    $('#bon_a_savoir_content').html(bon_a_savoir);
    $("#form_bon_a_savoir").on("submit",function() {
        $("#bon_a_savoir_textarea").val($("#bon_a_savoir_id").html());
    });

    let prestation = prestation_editor.root.innerHTML;
    $('#prestation_content').html(prestation);
    $("#form_prestation").on("submit",function() {
        $("#prestation_textarea").val($("#prestation_id").html());
    });

    $('.plus_avis').on('click', function(e){
        let id = $(e.target).closest('.plus_avis').attr("id");

        $.ajax({
            type: "get"
            ,url: "{{route('plus_avis_module')}}"
            ,data:{
                Id: id,
            }
            ,success: function(response){
                let moduleData = response;
                if (moduleData['liste_avis'] != null || undefined){
                    let html = '';

                    for (let i = 0; i < moduleData['liste_avis'].length; i++) {
                        html += '<div class="row" id="avis">';
                        html +=     '<div class="d-flex flex-row">';
                        html +=         '<div class="col">';
                        html +=             '<h6 class="mt-3 mb-0">'+moduleData['liste_avis'][i]['nom_stagiaire']+'.'+moduleData['liste_avis'][i]['prenom_stagiaire']+'</h6>';
                        html +=         '</div>'
                        html +=         '<div class="col">';
                        html +=             '<p class="text-muted pt-5 pt-sm-3">'+moduleData['liste_avis'][i]['date_avis']+'</p>';
                        html +=         '</div>'
                        html +=         '<div class="col">';
                        html +=             '<p class="text-left d-flex flex-row">';
                        html +=                 '<div class="Stars" style="--note: '+moduleData['liste_avis'][i]['note']+';"></div>&nbsp;<span class="text-muted">'+moduleData['liste_avis'][i]['note']+'</span>';
                        html +=             '</p>'
                        html +=         '</div>'
                        html +=     '</div>'
                        html += '</div>'
                        html += '<div class="row ms-1">';
                        html +=     '<p>'+moduleData['liste_avis'][i]['commentaire']+'</p>';
                        html += '</div>';
                    }
                    $('.newRowAvis').empty();
                    $('.newRowAvis').append(html);
                    $('.plus_avis').hide();
                    $('.moins_avis').css('visibility','visible');
                }else{
                    alert('error');
                }

            }
            ,error: function(error){
                console.log(error);
            },
        });
    });
    $('.moins_avis').click(function(){
        $('.newRowAvis').empty();
        $('.plus_avis').show();
        $('.moins_avis').css('visibility','hidden');
    });

function afficher_radar(label,competence){

let marksCanvas = document.getElementById("marksChart");

let marksData = {
labels: JSON.parse(label),
datasets: [{
    label: "Objectif à atteindre",
    backgroundColor: "rgba(12, 213, 52, 0.2)",
    borderColor: "rgb(26, 113, 235)",
    pointBackgroundColor: "rgb(243, 84, 27)",
    data: JSON.parse(competence)
}]
};

let radarChart = new Chart(marksCanvas, {
type: 'radar',
data: marksData
});

var chartOptions = {
    scale: {
        ticks: {
            beginAtZero: true,
            min: 0,
            max: 10,
            stepSize: 1
        },
        pointLabels: {
            fontSize: 18
        }
    },
    legend: {
        position: 'left'
    }
};
}
function afficher_radar1(label,competence){

let marksCanvas = document.getElementById("marksChart1");

let marksData = {
labels: JSON.parse(label),
datasets: [{
    label: "Objectif à atteindre",
    backgroundColor: "rgba(12, 213, 52, 0.2)",
    borderColor: "rgb(26, 113, 235)",
    pointBackgroundColor: "rgb(243, 84, 27)",
    data: JSON.parse(competence)
}]
};

let radarChart = new Chart(marksCanvas, {
type: 'radar',
data: marksData
});

var chartOptions = {
    scale: {
        ticks: {
            beginAtZero: true,
            min: 0,
            max: 10,
            stepSize: 1
        },
        pointLabels: {
            fontSize: 18
        }
    },
    legend: {
        position: 'left'
    }
};
}

window.onload = function(e){
let id_mod = $("#mod_id_rec").val();
// alert(id_mod);
let labels = '[';
let competences = '[';
$.ajax({
    type: "get"
    ,url: "{{route('competence_module')}}"
    ,data: {
        mod_id: id_mod
    }
    ,dataType: "html"
    ,success: function(response){
        let userData = JSON.parse(response);
        // alert(JSON.stringify(userData['detail']));
        // alert(userData['detail'].length);
        for (let i = 0; i < userData['detail'].length; i++) {
            if (i == userData['detail'].length - 1) {
                labels += '"'+userData['detail'][i].titre_competence+'"]';
                competences += userData['detail'][i].objectif+']';
            }else{
                labels += '"'+userData['detail'][i].titre_competence+'",';
                competences += userData['detail'][i].objectif+',';
            }
        }
        // alert(competences);
        afficher_radar(labels,competences);
        afficher_radar1(labels,competences);
    }
    ,error: function(error){
        console.log(error);
    }
});
};
$(".print_to_pdf").on('click', function(e){
    $(".cacher_pdf").css("display","none");
    $(".Stars").css("display","none");
    $(".bx_pourcentage").css("display","none");
    $(".encre__icon").css("display","none");
    $(".level_cacher").css("display","inline-block");
    $(".stars").css("display","inline-block");
    $(".encre__icon_cacher").css("display","inline-block");
    $(".stars").css("color","yellow");
    $(".background_contrast").css("margin-left","2px");
    $(".background_contrast").css("fontSize","0.8rem");
    $("span").css("fontSize","0.8rem");
    $("p").css("fontSize","0.8rem");
    $(".card-body").css("fontSize","0.8rem");
    $(".background_contrast").css("padding-left","5px");
    $(".background_contrast").css("padding-right","5px");
    $(".module_detail_objet").css("margin-bottom","10px");
    $(".btn-block").css("border","none");
    $("#marksChart1").css("border","none");

    let element = document.getElementById('printToPdf');
    var opt = {
        margin:       0.5,
        filename:     'programme de formation.pdf',
        image:        { type: 'jpeg', quality: 1},
        html2canvas:  { scale: 2 },
        jsPDF:        { unit: 'in', format: 'letter', orientation: 'portrait' }
    };
    // html2pdf().set(opt).from(element).save();
    html2pdf().set(opt).from(element).save().then(function () {window.location.reload()});

});

</script>
@endsection