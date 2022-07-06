@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Modules</p>
@endsection
@section('content')
{{-- <link rel="stylesheet" href="{{asset('assets/css/mahafaly.css')}}"> --}}
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControlModules.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/configAll.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/formation.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
    integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<div class="container-fluid pb-1" id="Page1">
    <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();">
        <i class='bx bx-filter icon_creer'></i>Afficher les filtres
    </a>

    <div class="m-4" role="tabpanel" >
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <a href="#hors_ligne" class="nav-link" data-bs-toggle="tab">Catalogue Hors ligne&nbsp;&nbsp;&nbsp;{{count($mod_hors_ligne)}}</a>
            </li>
            <li class="nav-item">
                <a href="#publies" class="nav-link active" data-bs-toggle="tab">Catalogue en Ligne&nbsp;&nbsp;&nbsp;{{count($mod_publies)}}</a>
            </li>
            <li class="">
                <a data-bs-toggle="modal" data-bs-target="#nouveau_module" class=" btn_nouveau" role="button"><i class='bx bx-plus-medical me-2'></i>nouveau module</a>
            </li>
            <a href="#" onclick="return show('Page2','Page1');" title="afficher en mode liste"><i class='bx bx-list-ul view_icon'></i></a>
        </ul>

        <div class="tab-content">
            <div class="tab-pane show fade" id="hors_ligne">
                <div class="container-fluid p-0 mt-3 me-3">
                    <div class="row instruction mb-3">
                        <div class="col-11">
                            <p class="mb-0 ">Le catalogue hors ligne regroupe tous les modules qui sont déjá términer et attendent d'être mises en ligne.
                                <br>
                                Ce sont les modules qui s'afficheront dans votre catalogue de formation et qui seront
                                visibles publiquement s'ils sont mises en lignes.
                            </p>
                        </div>
                        <div class="col-1 text-end">
                            <i class='bx bx-x-circle fs-5' onclick="cacher_instruction();"></i>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-lg-12 ps-3">
                            <div class="row pading_bas d-flex flex-wrap">
                                @if($mod_hors_ligne == null)
                                <div class="si_vide row mt-4">
                                    <h5 class="text-center text-uppercase">Vous n'avez pas encore créer de module</h5>
                                    <a class="text-center mt-5" data-bs-toggle="modal" data-bs-target="#nouveau_module" role="button"><i
                                            class='bx bx-layer-plus icon_vide'></i></a>
                                </div>
                                @else
                                @foreach($mod_hors_ligne as $mod)
                                <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-12 col-sm-12 list_module">
                                    <div class="row detail__formation__result new_card_module bg-light justify-content-space-between py-3 px-2 ribbon"
                                        id="border_premier">
                                        <div class="col-lg-12 col-md-12 detail__formation__result__content">
                                            <div class="detail__formation__result__item ">
                                                <h4 class="mt-2">
                                                    <span id="preview_module" class="row ">
                                                        @if($mod->jours_restant > 0)
                                                        <div class="col-10">
                                                            <span class="acf-nom_module">{{$mod->nom_module}}</span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span class="ribbon1"><span>Nouveau<br>J - {{$mod->jours_restant}}</span></span>
                                                        </div>
                                                        @else
                                                        <span class="acf-nom_module">{{$mod->nom_module}}</span>
                                                        @endif
                                                    </span>
                                                </h4>
                                                <span id="preview_categ"><span class=" acf-categorie"
                                                        style="font-size: 0.850rem; color: #637381; margin-bottom: 5px">{{$mod->nom_formation}}</span></span>
                                                <p id="preview_descript"><span
                                                        class="acf-description">{{$mod->description}}</span></p>
                                            </div>
                                            <div class="d-flex ">
                                                <div class="col-6 detail__formation__result__avis">
                                                    <div class="Stars" style="--note: {{ $mod->pourcentage }};"></div>
                                                    <div class="me-3">{{ $mod->pourcentage }}/5
                                                        @if($mod->total_avis != null)
                                                        ({{$mod->total_avis}} avis)
                                                        @else
                                                        (0 avis)
                                                        @endif
                                                    </div>
                                                    @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                                    <span
                                                        class="">&nbsp;{{$mod->min_pers}}&nbsp;à&nbsp;{{$mod->max_pers}}&nbsp;pax</span>
                                                    @endif
                                                </div>
                                                <div class="col-6 w-100">
                                                    <p class="m-0">
                                                        <span class="new_module_prix">
                                                            <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pax</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                        </span>
                                                    </p>
                                                    <p class="m-0 ">
                                                        <span class="new_module_prix">
                                                        @if($mod->prix_groupe != null)
                                                            <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;@if($mod->max_pers != 0)/ {{$mod->max_pers}} pax @else / pax @endif</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                        @endif
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row g-0 row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                                            <div class="col-3" style="font-size: 12px" id="preview_haut2"><i
                                                    class="bx bxs-alarm bx_icon" style="color: #7635dc !important;"></i>
                                                <span id="preview_jour"><span class="acf-jour">
                                                        {{$mod->duree_jour}}
                                                    </span>j</span>
                                                <span id="preview_heur">/<span class="acf-heur">
                                                        {{$mod->duree}}
                                                    </span>h</span>
                                            </div>
                                            <div class="col-5" style="font-size: 12px" id="preview_modalite"><i
                                                    class="bx bxs-devices bx_icon"
                                                    style="color: #7635dc !important;"></i>&nbsp;<span
                                                    class="acf-modalite">{{$mod->modalite_formation}}</span>
                                            </div>
                                            <div class="col-4" style="font-size: 12px" id="preview_niveau">
                                                <i class='bx bx-equalizer bx_icon'
                                                    style="color: #7635dc !important;"></i>&nbsp;<span
                                                    class="acf-niveau">{{$mod->niveau}}</span>
                                            </div>
                                        </div>
                                        <div class="row g-0">
                                            @canany(['isCFP','isAdmin','isSuperAdmin'])
                                            <div class="col-4 d-flex flex-row">
                                                <div class="col" id="preview_niveau">
                                                    <button class="btn modifier pt-0"><a
                                                            href="{{route('modif_programmes',$mod->module_id)}}"><i
                                                                class='bx bx-edit bx_modifier'
                                                                title="modifier les informations"></i></a></button>
                                                </div>
                                                <div class="col" id="preview_niveau">
                                                    <button class="btn supprimer pt-0" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal_{{$mod->module_id}}"><i
                                                            class="bx bx-trash bx_supprimer"
                                                            title="supprimer le module"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="new_btn_programme text-center">
                                                    <div class="text-uppercase">
                                                        @if ($mod->status == 1)
                                                        <div class="form-check form-switch d-flex flex-row">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked"><span class="button_choix_hors_ligne">Hors&nbsp;Ligne</span></label>
                                                            <input class="form-check-input  ms-3" data-bs-toggle="modal" id="switch_{{$mod->module_id}}" data-bs-target="#en_ligne_{{$mod->module_id}}" type="checkbox" value="{{$mod->module_id}}" title="activer pour mettre en ligne">
                                                        </div>
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="exampleModal_{{$mod->module_id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header .avertissement  d-flex justify-content-center"
                                                        style="background-color:#ee0707; color: white">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center my-2">
                                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                                        </div>
                                                        <small>Vous êtes sur le point d'effacer une donnée,
                                                            cette
                                                            action
                                                            est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn_annuler" data-bs-dismiss="modal" id="{{$mod->module_id}}"><i class='bx bx-x me-1'></i>Non</button>
                                                        <button type="button" class="btn btn_enregistrer suppression_module" id="{{$mod->module_id}}"><i class='bx bx-check me-1'></i>Oui</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="en_ligne_{{$mod->module_id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="en_ligne_{{$mod->module_id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header .avertissement  d-flex justify-content-center"
                                                        style="background-color:#ee0707; color: white">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center my-2">
                                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                                        </div>
                                                        <p class="text-center">Vous allez mettre en ligne cette module. Êtes-vous sur?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn_annuler non_en_ligne" data-bs-dismiss="modal" id="{{$mod->module_id}}"><i class='bx bx-x me-1'></i>Non</button>
                                                        <button type="submit" class="btn btn_enregistrer mettre_en_ligne" id="{{$mod->module_id}}"><i class='bx bx-check me-1'></i>Oui</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endcanany
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane show fade active" id="publies">
                <div class="container-fluid p-0 mt-3 me-3">
                    <div class="row instruction mb-3">
                        <div class="col-11">
                            <p class="mb-0 ">Le catalogue en ligne regroupe tous les modules qui sont déjá mises en ligne.
                                <br>
                                Ce sont les modules qui s'afficheront dans votre catalogue de formation et qui seront
                                visibles publiquement.</p>
                        </div>
                        <div class="col-1 text-end">
                            <i class='bx bx-x-circle fs-5' onclick="cacher_instruction();"></i>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-lg-12 ps-3">
                            <div class="row pading_bas d-flex flex-wrap">
                                @if($mod_publies == null)
                                <div class="si_vide row mt-4">
                                    <h5 class="text-center text-uppercase">Vous n'avez pas encore créer de module</h5>
                                    <a class="text-center mt-5" href="{{route('nouveau_module_new')}}" role="button"><i
                                            class='bx bx-layer-plus icon_vide'></i></a>
                                </div>
                                @else
                                @foreach($mod_publies as $mod)
                                <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-12 col-sm-12 list_module">
                                    <div class="row detail__formation__result new_card_module bg-light justify-content-space-between py-3 px-2 ribbon"
                                        id="border_premier">
                                        <div class="col-lg-12 col-md-12 detail__formation__result__content">
                                            <div class="detail__formation__result__item ">
                                                <h4 class="mt-2">
                                                    <span id="preview_module" class="row ">
                                                        @if($mod->jours_restant > 0)
                                                        <div class="col-10">
                                                            <span class="acf-nom_module">{{$mod->nom_module}}</span>
                                                        </div>
                                                        <div class="col-2">
                                                            <span class="ribbon1"><span>Nouveau<br>J - {{$mod->jours_restant}}</span></span>
                                                        </div>
                                                        @else
                                                        <span class="acf-nom_module">{{$mod->nom_module}}</span>
                                                        @endif
                                                    </span>
                                                </h4>
                                                <span id="preview_categ"><span class=" acf-categorie"
                                                        style="font-size: 0.850rem; color: #637381; margin-bottom: 5px">{{$mod->nom_formation}}</span></span>
                                                <p id="preview_descript"><span
                                                        class="acf-description">{{$mod->description}}</span></p>
                                            </div>
                                            <div class="d-flex ">
                                                <div class="col-6 detail__formation__result__avis">
                                                    <div class="Stars" style="--note: {{ $mod->pourcentage }};"></div>
                                                    <div class="me-3">{{ $mod->pourcentage }}/5
                                                        @if($mod->total_avis != null)
                                                        ({{$mod->total_avis}} avis)
                                                        @else
                                                        (0 avis)
                                                        @endif
                                                    </div>
                                                    @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                                    <span
                                                        class="">&nbsp;{{$mod->min_pers}}&nbsp;à&nbsp;{{$mod->max_pers}}&nbsp;pax</span>
                                                    @endif
                                                </div>
                                                <div class="col-6 w-100">
                                                    <p class="m-0">
                                                        <span class="new_module_prix">
                                                            <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pax</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                        </span>
                                                    </p>
                                                    <p class="m-0 ">
                                                        <span class="new_module_prix">
                                                        @if($mod->prix_groupe != null)
                                                            <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;@if($mod->max_pers != 0)/ {{$mod->max_pers}} pax @else / pax @endif</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                        @endif
                                                        </span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="row row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                                            <div class="col-3" style="font-size: 12px" id="preview_haut2"><i
                                                    class="bx bxs-alarm bx_icon" style="color: #7635dc !important;"></i>
                                                <span id="preview_jour"><span class="acf-jour">
                                                        {{$mod->duree_jour}}
                                                    </span>j</span>
                                                <span id="preview_heur">/<span class="acf-heur">
                                                        {{$mod->duree}}
                                                    </span>h</span>
                                            </div>
                                            <div class="col-5" style="font-size: 12px" id="preview_modalite"><i
                                                    class="bx bxs-devices bx_icon"
                                                    style="color: #7635dc !important;"></i>&nbsp;<span
                                                    class="acf-modalite">{{$mod->modalite_formation}}</span>
                                            </div>
                                            <div class="col-4" style="font-size: 12px" id="preview_niveau">
                                                <i class='bx bx-equalizer bx_icon'
                                                    style="color: #7635dc !important;"></i>&nbsp;<span
                                                    class="acf-niveau">{{$mod->niveau}}</span>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @canany(['isCFP','isAdmin','isSuperAdmin'])
                                            <div class="col-4 d-flex flex-row">
                                                <div class="col" id="preview_niveau">
                                                    <button class="btn modifier pt-0"><a
                                                            href="{{route('modif_programmes',$mod->module_id)}}"><i
                                                                class='bx bx-edit bx_modifier'
                                                                title="modifier les informations"></i></a></button>
                                                </div>
                                                <div class="col" id="preview_niveau">
                                                    <button class="btn supprimer pt-0" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal_{{$mod->module_id}}"><i
                                                            class="bx bx-trash bx_supprimer"
                                                            title="supprimer le module"></i></button>
                                                </div>

                                            </div>
                                            <div class="col-8">
                                                <div class="new_btn_programme text-center">
                                                    <div class="text-uppercase">
                                                        @if ($mod->status == 2)
                                                        <div class="form-check form-switch d-flex flex-row">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked"><span class="button_choix">En&nbsp;Ligne</span></label>
                                                            <input class="form-check-input  ms-3" data-bs-toggle="modal" id="switch2_{{$mod->module_id}}" data-bs-target="#hors_ligne_{{$mod->module_id}}" type="checkbox" title="désactiver pour mettre hors ligne" checked >
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="exampleModal_{{$mod->module_id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header .avertissement  d-flex justify-content-center"
                                                        style="background-color:#ee0707; color: white">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center my-2">
                                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                                        </div>
                                                        <small>Vous êtes sur le point d'effacer une donnée,
                                                            cette
                                                            action
                                                            est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn_annuler" data-bs-dismiss="modal"><i class='bx bx-x me-1'></i>Non</button>
                                                        <button type="button" class="btn btn_enregistrer suppression_module" id="{{$mod->module_id}}"><i class='bx bx-check me-1'></i>Oui</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="hors_ligne_{{$mod->module_id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="hors_ligne_{{$mod->module_id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header .avertissement  d-flex justify-content-center"
                                                        style="background-color:#ee0707; color: white">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center my-2">
                                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                                        </div>
                                                        <p class="text-center">Vous allez mettre hors ligne cette module. Êtes-vous sur?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn_annuler non_hors_ligne" data-bs-dismiss="modal" id="{{$mod->module_id}}"><i class='bx bx-x me-1'></i>Non</button>
                                                        <button type="submit" class="btn btn_enregistrer mettre_hors_ligne" id="{{$mod->module_id}}"><i class='bx bx-check me-1'></i>Oui</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endcanany
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="modal fade" id="nouveau_module" tabindex="-1"
                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <form action="{{route('nouveau_module_new')}}" method="POST" id="frm_new_module">
                                @csrf
                                <div class="modal-header .avertissement  d-flex justify-content-center"
                                    style="color: white">
                                    <h6 class="modal-title">Domaine de Formation</h6>
                                </div>
                                <div class="modal-body mb-3">
                                    <div class="form-group" >
                                        <select class="form-control select_formulaire input" id="acf-domaine" name="domaine" style="height: 40px;" required>
                                            <option value="null" disable selected hidden>Choisissez la
                                                domaine de formation ...</option>
                                            @foreach($domaine as $do)
                                            <option value="{{$do->id}}" data-value="{{$do->nom_domaine}}">
                                                {{$do->nom_domaine}}</option>
                                            @endforeach
                                        </select>
                                        <label for="acf-domaine" class="form-control-placeholder mb-2">Domaine de Formation</label>
                                    </div>
                                    <div class="form-group mt-3" >
                                        <select class="form-control select_formulaire categ categ input" id="acf-categorie" name="categorie" style="height: 40px;" required>
                                        </select>
                                        <label for="acf-categorie" class="form-control-placeholder mb-2">Thématique par Domaine</label>
                                        <p id="domaine_id_err" class="text-danger">Choisir le domaine de formation valide</p>
                                    </div>
                                <div class="modal-footer justify-content-center">
                                    <button type="button" class="btn btn_annuler" data-bs-dismiss="modal"><i class='bx bx-x me-1'></i>Non</button>
                                    <button type="submit" class="btn btn_enregistrer"><i class='bx bx-check me-1'></i>Créer votre module</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="filtrer mt-3">
            <div class="row">
                <div class="col">
                    <p class="m-0">Filter les modules</p>
                </div>
                <div class="col text-end">
                    <i class="bx bx-x" role="button" onclick="afficherFiltre();"></i>
                </div>
                <hr class="mt-2 mb-0">
                <div class="row gutter_none">
                    <div class="col">
                        <div class="accordion" id="accordionExample">

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        COMPETENCE À COMPLÉTER
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form action="">
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-6 me-1 justify-content-center">
                                                    <select name="ref" id="ref" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Référence</option>
                                                        @foreach($mod_hors_ligne as $mod_prog)
                                                        <option value="{{$mod_prog->reference}}">{{$mod_prog->reference}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 justify-content-center">
                                                    <select name="niveau" id="niveau" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Niveau</option>
                                                        @foreach($niveau as $niv)
                                                        <option value="{{$niv->niveau}}">{{$niv->niveau}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col justify-content-center">
                                                    <select name="nom_mod" id="nom_mod" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Nom de module</option>
                                                        @foreach($mod_hors_ligne as $mod_prog)
                                                        <option value="{{$mod_prog->nom_module}}">{{$mod_prog->nom_module}}</option>
                                                        @endforeach
                                                    </select>
                                                    <select name="thematique" id="thematique" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Thématique</option>
                                                        @foreach($categorie as $categ)
                                                        <option value="{{$categ->nom_formation}}">{{$categ->nom_formation}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-5 me-1 justify-content-center">
                                                    <div class="form-groupe">
                                                        <select name="date_creation" id="date_creation" class="form-control mb-2 outline_none">
                                                            <option value="null" disable selected hidden>Création</option>
                                                            @foreach($date_creation as $date)
                                                            <option value="{{$date->created_at}}">{{date('d/m/Y', strtotime($date->created_at,))}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-7 justify-content-center">
                                                    <select name="modalites" id="modalites" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Modalité Formation</option>
                                                        <option value="En ligne">En ligne</option>
                                                        <option value="Presentiel">Présentiel</option>
                                                        <option value="En ligne/Presentiel">En ligne/Présentiel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-6">
                                                    <label>Durée en Heure</label>
                                                    <div class="d-flex flex-row">
                                                        <input type="range" name="range" step="4" min="4" max="40" value="" onchange="rangeHour1.value=value" class="slide_range slide_hour">
                                                        <input type="text" id="rangeHour1" class="prix_range prix_slide" readonly/>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label>Durée en Jours</label>
                                                    <div class="d-flex flex-row">
                                                        <input type="range" name="range" step="1" min="1" max="5" value="" onchange="rangeDay1.value=value" class="slide_range slider_day">
                                                        <input type="text" id="rangeDay1" class="prix_range prix_slide" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="m-0 mb-1">Intervalle de prix par personne en {{$devise->devise}}</p>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-8">
                                                    <div class="d-flex flex-row">
                                                        <span class="me-4 text_prix">100&sbquo;000</span><input type="range" name="range" step="50000" min="100000" max="500000" value=""  class="slide_range w-100" id="prix_pers1">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" id="rangeSecondary" class="prix_range" readonly/>
                                                </div>
                                            </div>
                                            <p class="m-0 mb-1">Intervalle de prix par groupe en {{$devise->devise}}</p>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-8">
                                                    <div class="d-flex flex-row">
                                                        <span class="me-4 text_prix">1&sbquo;000&sbquo;000</span><input type="range" name="range" step="100000" min="1000000" max="5000000" value="" class="slide_range w-100" id="prix_groupe1">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" id="rangeSecondary1" class="prix_range" readonly/>
                                                </div>
                                            </div>
                                            <div class="text-center mt-1">
                                                <input type="submit" class="btn_enregistrer text-center" value="Appliquer">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        VOTRE CATALOGUE
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form action="">
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-6 me-1 justify-content-center">
                                                    <select name="ref" id="ref" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Référence</option>
                                                        @foreach($mod_publies as $mod_prog)
                                                        <option value="{{$mod_prog->reference}}">{{$mod_prog->reference}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 justify-content-center">
                                                    <select name="niveau" id="niveau" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Niveau</option>
                                                        @foreach($niveau as $niv)
                                                        <option value="{{$niv->niveau}}">{{$niv->niveau}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col justify-content-center">
                                                    <select name="nom_mod" id="nom_mod" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Nom de module</option>
                                                        @foreach($mod_publies as $mod_prog)
                                                        <option value="{{$mod_prog->nom_module}}">{{$mod_prog->nom_module}}</option>
                                                        @endforeach
                                                    </select>
                                                    <select name="thematique" id="thematique" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Thématique</option>
                                                        @foreach($categorie as $categ)
                                                        <option value="{{$categ->nom_formation}}">{{$categ->nom_formation}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-5 me-1 justify-content-center">
                                                    <div class="form-groupe">
                                                        <select name="date_creation" id="date_creation" class="form-control mb-2 outline_none">
                                                            <option value="null" disable selected hidden>Création</option>
                                                            @foreach($date_creation as $date)
                                                            <option value="{{$date->created_at}}">{{date('d/m/Y', strtotime($date->created_at,))}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-7 justify-content-center">
                                                    <select name="modalites" id="modalites" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Modalité Formation</option>
                                                        <option value="En ligne">En ligne</option>
                                                        <option value="Presentiel">Présentiel</option>
                                                        <option value="En ligne/Presentiel">En ligne/Présentiel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-6">
                                                    <label>Durée en Heure</label>
                                                    <div class="d-flex flex-row">
                                                        <input type="range" name="range" step="4" min="4" max="40" value="" onchange="rangeHour2.value=value" class="slide_range slide_hour">
                                                        <input type="text" id="rangeHour2" class="prix_range prix_slide" readonly/>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label>Durée en Jours</label>
                                                    <div class="d-flex flex-row">
                                                        <input type="range" name="range" step="1" min="1" max="5" value="" onchange="rangeDay2.value=value" class="slide_range slider_day">
                                                        <input type="text" id="rangeDay2" class="prix_range prix_slide" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="m-0 mb-1">Intervalle de prix par personne en {{$devise->devise}}</p>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-8">
                                                    <div class="d-flex flex-row">
                                                        <span class="me-4 text_prix">100&sbquo;000</span><input type="range" name="range" step="50000" min="100000" max="500000" value=""  class="slide_range w-100" id="prix_pers2">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" id="rangeThird" class="prix_range" readonly/>
                                                </div>
                                            </div>
                                            <p class="m-0 mb-1">Intervalle de prix par groupe en {{$devise->devise}}</p>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-8">
                                                    <div class="d-flex flex-row">
                                                        <span class="me-4 text_prix">1&sbquo;000&sbquo;000</span><input type="range" name="range" step="100000" min="1000000" max="5000000" value="" class="slide_range w-100" id="prix_groupe2">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" id="rangeThird1" class="prix_range" readonly/>
                                                </div>
                                            </div>
                                            <div class="text-center mt-1">
                                                <input type="submit" class="btn_enregistrer text-center" value="Appliquer">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div class="container-fluid pb-1" id="Page2" style="display: none">
    <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();">
        <i class='bx bx-filter icon_creer'></i>Afficher les filtres
    </a>
    <div class="m-4" role="tabpanel">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="mytab">
            <li class="nav-item">
                <a href="#hors_lignes" class="nav-link" data-bs-toggle="tab">Catalogue Hors ligne&nbsp;&nbsp;&nbsp;{{count($mod_hors_ligne)}}</a>
            </li>
            <li class="nav-item ">
                <a href="#publiees" class="nav-link active" data-bs-toggle="tab">Catalogue en Ligne&nbsp;&nbsp;&nbsp;{{count($mod_publies)}}</a>
            </li>
            <li class="">
                <a data-bs-toggle="modal" data-bs-target="#nouveau_module" class=" btn_nouveau" role="button"><i class='bx bx-plus-medical me-2'></i>nouveau module</a>
            </li>
            <a href="#" onclick="return show('Page1','Page2');" title="afficher en mode card"><i class='bx bxs-card view_icon'></i></a>

        </ul>
        <div class="tab-content">
            <div class="tab-pane show fade" id="hors_lignes">
                <div class="container-fluid p-0 mt-3 me-3">
                    <div class="row instruction mb-3">
                        <div class="col-11">
                            <p class="mb-0 ">Le catalogue hors ligne regroupe tous les modules qui sont déjá términer et attendent d'être mises en ligne.
                                <br>
                                Ce sont les modules qui s'afficheront dans votre catalogue de formation et qui seront
                                visibles publiquement s'ils sont mises en lignes.</p>
                        </div>
                        <div class="col-1 text-end">
                            <i class='bx bx-x-circle fs-5' onclick="cacher_instruction();"></i>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-12">

                            @if (count($mod_hors_ligne)>0)
                            {{-- {{dd($mod_hors_ligne)}} --}}
                            @foreach ($mod_hors_ligne as $info)
                            {{-- {{dd($info)}} --}}
                            <div class="row liste__formation justify-content-space-between mb-4 ribbon">
                                <div class="col-1 d-flex flex-column">
                                    <a href="{{route('detail_cfp',$info->cfp_id)}}" class="justify-content-center text-center">
                                        <img src="{{asset('images/CFP/'.$info->logo)}}" alt="logo" class="img-fluid" style="width: 100px; height:50px;">
                                    </a>
                                </div>
                                <div class="col-3 liste__formation__content">
                                    <a href="{{route('select_par_module',$info->module_id)}}">
                                        <div class="liste__formation__item">
                                            <h5>{{$info->nom_module}}</h5>
                                            <p><span>{{$info->nom_formation}}</span></p>
                                            {{-- <p>Réference : <span>{{$info->reference}}</span></p> --}}

                                        </div>
                                    </a>
                                </div>
                                <div class="col-3">
                                    <div class="liste__formation__avis mb-3 d-flex flex-row justify-content-between">
                                        <div>
                                            <div class="Stars" style="--note: {{ $info->pourcentage }};">
                                            </div>
                                            <span class="me-3">{{ $info->pourcentage }}/5
                                                @if($info->total_avis != null)
                                                ({{$info->total_avis}} avis)
                                                @else
                                                (0 avis)
                                                @endif
                                            </span>
                                        </div>
                                        <div>
                                            <span>Réf : {{$info->reference}}</span>
                                        </div>

                                    </div>
                                    <div class="liste__formation__item3 description d-flex flex-row">
                                        <div class="me-2"><i class="bx bx-alarm bx_icon"></i>
                                            <span>
                                                @isset($info->duree_jour)
                                                {{$info->duree_jour}} jours
                                                @endisset
                                            </span>
                                            <span>
                                                @isset($info->duree)
                                                /{{$info->duree}} h
                                                @endisset
                                            </span> </p>
                                        </div>
                                        <div class="me-2"><i class="bx bx-certification bx_icon"></i><span>&nbsp;Certifiante</span>
                                        </div>
                                        <div class="me-2"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$info->modalite_formation}}</span>
                                        </div>
                                        <div class="me-3"><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$info->niveau}}</span>
                                        </div>
                                        @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                            <div>
                                                <span class="">&nbsp;{{$mod->min_pers}}&nbsp;à&nbsp;{{$mod->max_pers}}&nbsp;pax</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-2 text-end">
                                    <div class="description mb-3">{{$devise->devise}}&nbsp;{{number_format($info->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pax</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                    @if($info->prix_groupe != null)
                                    <div class="pt-1 description">{{$devise->devise}}&nbsp;{{number_format($info->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;@if($mod->max_pers != 0)/ {{$mod->max_pers}} pax @else / pax @endif</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                    @endif
                                </div>
                                <div class="col-2 actions_button_mod">
                                    <div class="row w-100 mb-2">
                                        <div class="col-12 d-flex flex-row">
                                            <div class="col-6 text-center" id="preview_niveau">
                                                <button class="btn modifier pt-0"><a
                                                        href="{{route('modif_programmes',$info->module_id)}}"><i
                                                            class='bx bx-edit bx_modifier'
                                                            title="modifier les informations"></i></a></button>
                                            </div>
                                            <div class="col-6 text-center" id="preview_niveau">
                                                <button class="btn supprimer pt-0" data-bs-toggle="modal"
                                                    data-bs-target="#listModal_{{$info->module_id}}"><i
                                                        class="bx bx-trash bx_supprimer"
                                                        title="supprimer le module"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="new_btn_programme text-center">
                                                <div class="text-uppercase">
                                                    @if ($info->status == 1)
                                                    <div class="form-check form-switch d-flex flex-row">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked"><span class="button_choix_hors_ligne">Hors&nbsp;Ligne</span></label>
                                                        <input class="form-check-input  ms-3" data-bs-toggle="modal" id="switch_{{$info->module_id}}" data-bs-target="#liste_en_ligne_{{$info->module_id}}" type="checkbox" value="{{$mod->module_id}}" title="activer pour mettre en ligne">
                                                    </div>
                                                    @endif
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    {{-- @if($info->jours_restant > 0)
                                    <div class="col-1">
                                        <span class="ribbon2"><span>Nouveau<br>J - {{$info->jours_restant}}</span></span>
                                    </div>
                                    @endif --}}
                                </div>
                                <div class="modal fade" id="listModal_{{$info->module_id}}" tabindex="-1"
                                    role="dialog" aria-labelledby="listModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header .avertissement  d-flex justify-content-center"
                                                style="background-color:#ee0707; color: white">
                                                <h6 class="modal-title">Avertissement !</h6>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center my-2">
                                                    <i class="fa-solid fa-circle-exclamation warning"></i>
                                                </div>
                                                <small>Vous êtes sur le point d'effacer une donnée,
                                                    cette
                                                    action
                                                    est irréversible. Continuer ?</small>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn_annuler" data-bs-dismiss="modal" id="{{$info->module_id}}"><i class='bx bx-x me-1'></i>Non</button>
                                                <button type="button" class="btn btn_enregistrer suppression_module" id="{{$info->module_id}}"><i class='bx bx-check me-1'></i>Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="liste_en_ligne_{{$info->module_id}}" tabindex="-1"
                                    role="dialog" aria-labelledby="liste_en_ligne_{{$info->module_id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header .avertissement  d-flex justify-content-center"
                                                style="background-color:#ee0707; color: white">
                                                <h6 class="modal-title">Avertissement !</h6>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center my-2">
                                                    <i class="fa-solid fa-circle-exclamation warning"></i>
                                                </div>
                                                <p class="text-center">Vous allez mettre en ligne cette module. Êtes-vous sur?</p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn_annuler non_en_ligne" data-bs-dismiss="modal" id="{{$info->module_id}}"><i class='bx bx-x me-1'></i>Non</button>
                                                <button type="submit" class="btn btn_enregistrer mettre_en_ligne" id="{{$info->module_id}}"><i class='bx bx-check me-1'></i>Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- @foreach ($datas as $data)
                                @if($info->module_id == $data->module_id)
                                @if (count($datas) <= 0) @else <hr class="mb-1 mt-2">
                                    <div class="row w-100 justify-content-end">
                                        <h6 class="mb-0 changer_caret d-flex pt-2 w-100" data-bs-toggle="collapse" href="#collapseprojet_{{$info->module_id}}" role="button" aria-expanded="false" aria-controls="collapseprojet">Afficher les dates du Session Inter&nbsp;<i class="bx bx-caret-down caret-icon"></i>
                                        </h6>
                                    </div>
                                    <div class="details collapse detail_inter" id="collapseprojet_{{$info->module_id}}">
                                        <div class="row px-3 py-2">
                                            <div class="col-2">
                                                <p>Prochaines Sessions</p>
                                            </div>
                                            <div class="col-5 date text-center">
                                                @foreach ($datas as $data)
                                                @if($info->module_id == $data->module_id)
                                                <p>Du @php setlocale(LC_TIME, "fr_FR"); echo strftime("%d %B, %Y", strtotime($data->date_debut)); @endphp au @php setlocale(LC_TIME, "fr_FR"); echo strftime("%d %B, %Y", strtotime($data->date_fin)); @endphp</p>
                                                @endif
                                                @endforeach
                                            </div>
                                            <div class="col-5 text-center">
                                                <p class="">Cette thématique vous intéresse?<button type="button" class="btn_next ms-4"><a href="{{route('select_par_module',$info->module_id)}}">Voir la Formation</a></button> </p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                @endif
                                @endforeach --}}
                            </div>
                            @endforeach
                            @else
                            <h2 class="text-center">Aucun module pour cette formation 😅 !</h2>
                            <div class="col text-center">
                                <a class="mb-2 new_list_nouvelle " href="{{route('liste_formation')}}">
                                    <span class="btn_enregistrer text-center"><i class="bx bxs-chevron-left me-1"></i>Retour</span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane show fade active" id="publiees">
                <div class="container-fluid p-0 mt-3 me-3">
                    <div class="row instruction mb-3">
                        <div class="col-11">
                            <p class="mb-0 ">Le catalogue en ligne regroupe tous les modules qui sont déjá mises en ligne.
                                <br>
                                Ce sont les modules qui s'afficheront dans votre catalogue de formation et qui seront
                                visibles publiquement.</p>
                        </div>
                        <div class="col-1 text-end">
                            <i class='bx bx-x-circle fs-5' onclick="cacher_instruction();"></i>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-12">

                            @if (count($mod_publies)>0)

                            @foreach ($mod_publies as $info)
                            <div class="row liste__formation justify-content-space-between mb-4">
                                <div class="col-1 d-flex flex-column">
                                    <a href="{{route('detail_cfp',$info->cfp_id)}}" class="justify-content-center text-center">
                                        <img src="{{asset('images/CFP/'.$info->logo)}}" alt="logo" class="img-fluid" style="width: 100px; height:50px;">
                                    </a>
                                </div>
                                <div class="col-3 liste__formation__content">
                                    <a href="{{route('select_par_module',$info->module_id)}}">
                                        <div class="liste__formation__item">
                                            <h5>{{$info->nom_module}}</h5>
                                            <p><span>{{$info->nom_formation}}</span></p>
                                            {{-- <p>Réference : <span>{{$info->reference}}</span></p> --}}

                                        </div>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <div class="liste__formation__avis mb-3 d-flex flex-row justify-content-between">
                                        <div>
                                            <div class="Stars" style="--note: {{ $info->pourcentage }};">
                                            </div>
                                            <span class="me-3">{{ $info->pourcentage }}/5
                                                @if($info->total_avis != null)
                                                ({{$info->total_avis}} avis)
                                                @else
                                                (0 avis)
                                                @endif
                                            </span>
                                        </div>
                                        <div>
                                            <span>Réf : {{$info->reference}}</span>
                                        </div>

                                    </div>
                                    <div class="liste__formation__item3 description d-flex flex-row">
                                        <div class="me-2"><i class="bx bx-alarm bx_icon"></i>
                                            <span>
                                                @isset($info->duree_jour)
                                                {{$info->duree_jour}} jours
                                                @endisset
                                            </span>
                                            <span>
                                                @isset($info->duree)
                                                /{{$info->duree}} h
                                                @endisset
                                            </span> </p>
                                        </div>
                                        <div class="me-2"><i class="bx bx-certification bx_icon"></i><span>&nbsp;Certifiante</span>
                                        </div>
                                        <div class="me-2"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$info->modalite_formation}}</span>
                                        </div>
                                        <div class="me-3"><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$info->niveau}}</span>
                                        </div>
                                        @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                            <div>
                                                <span class="">&nbsp;{{$mod->min_pers}}&nbsp;à&nbsp;{{$mod->max_pers}}&nbsp;pax</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-2 text-end">
                                    <div class="description mb-3">{{$devise->devise}}&nbsp;{{number_format($info->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pax</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                    @if($info->prix_groupe != null)
                                    <div class="pt-1 description">{{$devise->devise}}&nbsp;{{number_format($info->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;@if($mod->max_pers != 0)/ {{$mod->max_pers}} pax @else / pax @endif</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                    @endif
                                </div>
                                <div class="col-2 actions_button_mod">
                                    <div class="row w-100 mb-2">
                                        <div class="col-12 d-flex flex-row">
                                            <div class="col-6 text-center" id="preview_niveau">
                                                <button class="btn modifier pt-0"><a
                                                        href="{{route('modif_programmes',$info->module_id)}}"><i
                                                            class='bx bx-edit bx_modifier'
                                                            title="modifier les informations"></i></a></button>
                                            </div>
                                            <div class="col-6 text-center" id="preview_niveau">
                                                <button class="btn supprimer pt-0" data-bs-toggle="modal"
                                                    data-bs-target="#listModal_{{$info->module_id}}"><i
                                                        class="bx bx-trash bx_supprimer"
                                                        title="supprimer le module"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="new_btn_programme text-center">
                                                <div class="text-uppercase">
                                                    @if ($info->status == 2)
                                                    <div class="form-check form-switch d-flex flex-row">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked"><span class="button_choix">En&nbsp;Ligne</span></label>
                                                        <input class="form-check-input  ms-3" data-bs-toggle="modal" id="switch2_{{$info->module_id}}" data-bs-target="#liste_hors_ligne_{{$info->module_id}}" type="checkbox" title="désactiver pour mettre hors ligne" checked >
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="listModal_{{$info->module_id}}" tabindex="-1"
                                    role="dialog" aria-labelledby="listModal" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header .avertissement  d-flex justify-content-center"
                                                style="background-color:#ee0707; color: white">
                                                <h6 class="modal-title">Avertissement !</h6>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center my-2">
                                                    <i class="fa-solid fa-circle-exclamation warning"></i>
                                                </div>
                                                <small>Vous êtes sur le point d'effacer une donnée,
                                                    cette
                                                    action
                                                    est irréversible. Continuer ?</small>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn_annuler" data-bs-dismiss="modal"><i class='bx bx-x me-1'></i>Non</button>
                                                <button type="button" class="btn btn_enregistrer suppression_module" id="{{$info->module_id}}"><i class='bx bx-check me-1'></i>Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="liste_hors_ligne_{{$info->module_id}}" tabindex="-1"
                                    role="dialog" aria-labelledby="liste_hors_ligne_{{$info->module_id}}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header .avertissement  d-flex justify-content-center"
                                                style="background-color:#ee0707; color: white">
                                                <h6 class="modal-title">Avertissement !</h6>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center my-2">
                                                    <i class="fa-solid fa-circle-exclamation warning"></i>
                                                </div>
                                                <p class="text-center">Vous allez mettre hors ligne cette module. Êtes-vous sur?</p>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn_annuler non_hors_ligne" data-bs-dismiss="modal" id="{{$info->module_id}}"><i class='bx bx-x me-1'></i>Non</button>
                                                <button type="submit" class="btn btn_enregistrer mettre_hors_ligne" id="{{$info->module_id}}"><i class='bx bx-check me-1'></i>Oui</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col">
                                    <div class="mb-2 lien_clique"><a href="{{route('demande_devis_client',$info->module_id)}}" class="description ">Démander&nbsp;un&nbsp;devis</a></div>
                                    @if (count($datas) <= 0) @else @foreach ($datas as $data) @if($info->module_id == $data->module_id)
                                        <div class="pt-1 lien_clique"><a href="{{route('inscriptionInter',[$data->groupe_id,$data->type_formation_id])}}" class="description ">S'inscrire</a></div>
                                        @endif
                                        @endforeach
                                        @endif
                                </div> --}}

                                {{-- @if (count($datas)<=0)

                                @else
                                    <hr class="mb-1 mt-2">
                                    <div class="row w-100 justify-content-end">
                                        <span class="mb-0 changer_caret d-flex pt-2 w-100" data-bs-toggle="collapse" href="#collapseprojet_{{$info->module_id}}" role="button" aria-expanded="false" aria-controls="collapseprojet"><span style="font-size: .8rem;">Afficher les actions de formation</span>&nbsp;<i class="bx bx-caret-down caret-icon"></i>
                                        </span>
                                        <div class="details collapse detail_inter" id="collapseprojet_{{$info->module_id}}" style="background: none;">
                                            <div class="row px-3 py-2">
                                                <div class="col-12 date">
                                                    <table class="table table-striped">
                                                        <thead class="text-secondary" style="font-size: .8rem;">
                                                            <tr>
                                                                <th scope="col">Date</th>
                                                                <th scope="col">Entreprise</th>
                                                                <th scope="col">Nombres Stagiaires</th>
                                                                <th scope="col">Session</th>
                                                                <th scope="col">Type</th>
                                                                <th scope="col">Modalité</th>
                                                                <th scope="col">Chiffre d'Affaire ({{$devise->devise}})</th>
                                                                <th scope="col">Frais Annexe ({{$devise->devise}})</th>
                                                                <th scope="col">Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody style="font-size: .8rem">
                                                        @foreach ($datas as $data)
                                                            @if($info->module_id == $data->module_id)
                                                                <tr>
                                                                    <td class="text-center text-secondary">
                                                                        @php echo strftime('%d-%m-%y', strtotime($data->date_debut)).' au '.strftime('%d-%m-%y', strtotime($data->date_fin)); @endphp
                                                                    </td>
                                                                    <td class="text-secondary">{{$data->nom_etp}}</td>
                                                                    @if ($data->qte!=null)
                                                                        <td class="text-end text-secondary">{{$data->qte}}</td>
                                                                    @else
                                                                        <td class="text-center text-secondary">
                                                                            @php
                                                                                echo "<span>-</span>";
                                                                            @endphp
                                                                        </td>
                                                                    @endif
                                                                    <td class="text-secondary">{{$data->nom_groupe}}</td>
                                                                    <td class="text-secondary">
                                                                        @if ($data->type_formation_id ==1)
                                                                            @php
                                                                                echo"Intra";
                                                                            @endphp
                                                                        @elseif ($data->type_formation_id==2)
                                                                            @php
                                                                                echo"Inter";
                                                                            @endphp
                                                                        @endif
                                                                    </td>
                                                                    <td class="text-secondary">{{$data->modalite}}</td>
                                                                    @if ($data->chiffre_affaire!=null)
                                                                        <td class="text-center text-secondary">{{number_format($data->chiffre_affaire,0,",","")}}</td>
                                                                    @else
                                                                        <td class="text-center text-secondary">
                                                                            @php
                                                                                echo "<span>-</span>";
                                                                            @endphp
                                                                        </td>
                                                                    @endif
                                                                    @if (count($frais_annexe)>0)
                                                                        @if ($frais_annexe[0]->num_facture == $data->num_facture)
                                                                            <td class="text-center text-secondary">{{number_format($frais_annexe[0]->hors_taxe,0,",","")}}</td>
                                                                        @else
                                                                            <td class="text-center text-secondary">
                                                                                @php
                                                                                    echo "<span>-</span>";
                                                                                @endphp
                                                                            </td>
                                                                        @endif
                                                                    @else
                                                                        <td class="text-center text-secondary">
                                                                            @php
                                                                                echo "<span>-</span>";
                                                                            @endphp
                                                                        </td>
                                                                    @endif
                                                                    <td class="text-secondary">{{$data->item_status_groupe}}</td>
                                                                </tr>
                                                            @endif
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif --}}
                            </div>
                            @endforeach
                            @else
                            <h2 class="text-center">Aucun module pour cette formation 😅 !</h2>
                            <div class="col text-center">
                                <a class="mb-2 new_list_nouvelle " href="{{route('liste_formation')}}">
                                    <span class="btn_enregistrer text-center"><i class="bx bxs-chevron-left me-1"></i>Retour</span>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="filtrer mt-3">
            <div class="row">
                <div class="col">
                    <p class="m-0">Filter les modules</p>
                </div>
                <div class="col text-end">
                    <i class="bx bx-x" role="button" onclick="afficherFiltre();"></i>
                </div>
                <hr class="mt-2 mb-0">
                <div class="row gutter_none">
                    <div class="col">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        COMPETENCE À COMPLÉTER
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form action="">
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-6 me-1 justify-content-center">
                                                    <select name="ref" id="ref" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Référence</option>
                                                        @foreach($mod_hors_ligne as $mod_prog)
                                                        <option value="{{$mod_prog->reference}}">{{$mod_prog->reference}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 justify-content-center">
                                                    <select name="niveau" id="niveau" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Niveau</option>
                                                        @foreach($niveau as $niv)
                                                        <option value="{{$niv->niveau}}">{{$niv->niveau}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col justify-content-center">
                                                    <select name="nom_mod" id="nom_mod" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Nom de module</option>
                                                        @foreach($mod_hors_ligne as $mod_prog)
                                                        <option value="{{$mod_prog->nom_module}}">{{$mod_prog->nom_module}}</option>
                                                        @endforeach
                                                    </select>
                                                    <select name="thematique" id="thematique" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Thématique</option>
                                                        @foreach($categorie as $categ)
                                                        <option value="{{$categ->nom_formation}}">{{$categ->nom_formation}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-5 me-1 justify-content-center">
                                                    <div class="form-groupe">
                                                        <select name="date_creation" id="date_creation" class="form-control mb-2 outline_none">
                                                            <option value="null" disable selected hidden>Création</option>
                                                            @foreach($date_creation as $date)
                                                            <option value="{{$date->created_at}}">{{date('d/m/Y', strtotime($date->created_at,))}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-7 justify-content-center">
                                                    <select name="modalites" id="modalites" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Modalité Formation</option>
                                                        <option value="En ligne">En ligne</option>
                                                        <option value="Presentiel">Présentiel</option>
                                                        <option value="En ligne/Presentiel">En ligne/Présentiel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-6">
                                                    <label>Durée en Heure</label>
                                                    <div class="d-flex flex-row">
                                                        <input type="range" name="range" step="4" min="4" max="40" value="" onchange="rangeHour1.value=value" class="slide_range slide_hour">
                                                        <input type="text" id="rangeHour1" class="prix_range prix_slide" readonly/>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label>Durée en Jours</label>
                                                    <div class="d-flex flex-row">
                                                        <input type="range" name="range" step="1" min="1" max="5" value="" onchange="rangeDay1.value=value" class="slide_range slider_day">
                                                        <input type="text" id="rangeDay1" class="prix_range prix_slide" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="m-0 mb-1">Intervalle de prix par personne en {{$devise->devise}}</p>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-8">
                                                    <div class="d-flex flex-row">
                                                        <span class="me-4 text_prix">100&sbquo;000</span><input type="range" name="range" step="50000" min="100000" max="500000" value=""  class="slide_range w-100" id="prix_pers1">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" id="rangeSecondary" class="prix_range" readonly/>
                                                </div>
                                            </div>
                                            <p class="m-0 mb-1">Intervalle de prix par groupe en {{$devise->devise}}</p>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-8">
                                                    <div class="d-flex flex-row">
                                                        <span class="me-4 text_prix">1&sbquo;000&sbquo;000</span><input type="range" name="range" step="100000" min="1000000" max="5000000" value="" class="slide_range w-100" id="prix_groupe1">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" id="rangeSecondary1" class="prix_range" readonly/>
                                                </div>
                                            </div>
                                            <div class="text-center mt-1">
                                                <input type="submit" class="btn_enregistrer text-center" value="Appliquer">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        VOTRE CATALOGUE
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form action="">
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-6 me-1 justify-content-center">
                                                    <select name="ref" id="ref" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Référence</option>
                                                        @foreach($mod_publies as $mod_prog)
                                                        <option value="{{$mod_prog->reference}}">{{$mod_prog->reference}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-6 justify-content-center">
                                                    <select name="niveau" id="niveau" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Niveau</option>
                                                        @foreach($niveau as $niv)
                                                        <option value="{{$niv->niveau}}">{{$niv->niveau}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col justify-content-center">
                                                    <select name="nom_mod" id="nom_mod" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Nom de module</option>
                                                        @foreach($mod_publies as $mod_prog)
                                                        <option value="{{$mod_prog->nom_module}}">{{$mod_prog->nom_module}}</option>
                                                        @endforeach
                                                    </select>
                                                    <select name="thematique" id="thematique" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Thématique</option>
                                                        @foreach($categorie as $categ)
                                                        <option value="{{$categ->nom_formation}}">{{$categ->nom_formation}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-5 me-1 justify-content-center">
                                                    <div class="form-groupe">
                                                        <select name="date_creation" id="date_creation" class="form-control mb-2 outline_none">
                                                            <option value="null" disable selected hidden>Création</option>
                                                            @foreach($date_creation as $date)
                                                            <option value="{{$date->created_at}}">{{date('d/m/Y', strtotime($date->created_at,))}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-7 justify-content-center">
                                                    <select name="modalites" id="modalites" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Modalité Formation</option>
                                                        <option value="En ligne">En ligne</option>
                                                        <option value="Presentiel">Présentiel</option>
                                                        <option value="En ligne/Presentiel">En ligne/Présentiel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-6">
                                                    <label>Durée en Heure</label>
                                                    <div class="d-flex flex-row">
                                                        <input type="range" name="range" step="4" min="4" max="40" value="" onchange="rangeHour2.value=value" class="slide_range slide_hour">
                                                        <input type="text" id="rangeHour2" class="prix_range prix_slide" readonly/>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label>Durée en Jours</label>
                                                    <div class="d-flex flex-row">
                                                        <input type="range" name="range" step="1" min="1" max="5" value="" onchange="rangeDay2.value=value" class="slide_range slider_day">
                                                        <input type="text" id="rangeDay2" class="prix_range prix_slide" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="m-0 mb-1">Intervalle de prix par personne en {{$devise->devise}}</p>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-8">
                                                    <div class="d-flex flex-row">
                                                        <span class="me-4 text_prix">100&sbquo;000</span><input type="range" name="range" step="50000" min="100000" max="500000" value=""  class="slide_range w-100" id="prix_pers2">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" id="rangeThird" class="prix_range" readonly/>
                                                </div>
                                            </div>
                                            <p class="m-0 mb-1">Intervalle de prix par groupe en {{$devise->devise}}</p>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-8">
                                                    <div class="d-flex flex-row">
                                                        <span class="me-4 text_prix">1&sbquo;000&sbquo;000</span><input type="range" name="range" step="100000" min="1000000" max="5000000" value="" class="slide_range w-100" id="prix_groupe2">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" id="rangeThird1" class="prix_range" readonly/>
                                                </div>
                                            </div>
                                            <div class="text-center mt-1">
                                                <input type="submit" class="btn_enregistrer text-center" value="Appliquer">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('js/modules.js')}}"></script>
<script >

localStorage.removeItem('popState');
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let lien = ($(e.target).attr('href'));
        localStorage.setItem('ActiveTabMod', lien);
    });
    let ActiveTabMod = localStorage.getItem('ActiveTabMod');
    if(ActiveTabMod){
        $('#myTab a[href="' + ActiveTabMod + '"]').tab('show');
    }

    function show(shown, hidden) {
        document.getElementById(shown).style.display='block';
        document.getElementById(hidden).style.display='none';

        if (shown == "Page2") {
            // alert(shown);
            localStorage.getItem('ActiveTabMod', '#publiees');
        }
        if (shown == "Page1") {
            // alert(shown);
            localStorage.getItem('ActiveTabMod','#publies');
        }
        return false;

    }
    $('.redirect_tab').on('click', function (e) {
        localStorage.setItem('ActiveTabMod', '#hors_ligne');
    });

    $('.mettre_en_ligne').on('click', function (e) {
        localStorage.setItem('ActiveTabMod', '#publies');
    });

    $('.mettre_hors_ligne').on('click', function (e) {
        localStorage.setItem('ActiveTabMod', '#hors_ligne');
    });

    toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": false,
    "progressBar": false,
    "positionClass": "toast-top-center",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "3000",
    "timeOut": "5000",
    "extendedTimeOut": "3000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
    }

    // document.getElementById('prix_pers').addEventListener('input', function (e) {
    //     let valeur = e.target.value.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",").trim();
    //     rangePrimary.value = valeur;
    // });
    // document.getElementById('prix_groupe').addEventListener('input', function (e) {
    //     let valeur = e.target.value.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",").trim();
    //     rangePrimary1.value = valeur;
    // });
    // document.getElementById('prix_pers1').addEventListener('input', function (e) {
    //     let valeur = e.target.value.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",").trim();
    //     rangeSecondary.value = valeur;
    // });
    // document.getElementById('prix_groupe1').addEventListener('input', function (e) {
    //     let valeur = e.target.value.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",").trim();
    //     rangeSecondary1.value = valeur;
    // });
    // document.getElementById('prix_pers2').addEventListener('input', function (e) {
    //     let valeur = e.target.value.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",").trim();
    //     rangeThird.value = valeur;
    // });
    // document.getElementById('prix_groupe2').addEventListener('input', function (e) {
    //     let valeur = e.target.value.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",").trim();
    //     rangeThird1.value = valeur;
    // });

    $(".mettre_en_ligne").on('click', function(e) {
        let id = e.target.id;
        $.ajax({
            method: "GET"
            , url: "{{route('mettre_en_ligne')}}"
            , data: {Id : id}
            , success: function(response) {
                window.location.reload();

            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    //  (".non_en_ligne").on('click', function(e) {
    //     let id = $(e.target).closest('.non_en_ligne').attr("id");
    //     alert(id);
    //     // $("#switch_"+id).prop('checked',false);
    //  });

    $(".non_en_ligne").on('click', function(e) {
        let id = $(e.target).closest('.non_en_ligne').attr("id");
        $("#switch_"+id).prop('checked',false);
    });

    $(".non_hors_ligne").on('click', function(e) {
        let id = $(e.target).closest('.non_hors_ligne').attr("id");
        $("#switch2_"+id).prop('checked',true);
    });

    //  $(".non_hors_ligne").on('click', function(e) {
    //     $(".form-check-input").prop('checked',true);
    //  });

    //  $(".non_en_ligne").on('click', function(e) {
    //     $(".form-check-input").prop('checked',false);
    //  });

    $(".mettre_hors_ligne").on('click', function(e) {
        let id = e.target.id;
        $.ajax({
            method: "GET"
            , url: "{{route('mettre_hors_ligne')}}"
            , data: {Id : id}
            , success: function(response) {
                window.location.reload();
                // $("#switch2_"+id).prop('checked',true);
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });




</script>
@endsection