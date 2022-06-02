@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Modules</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/configAll.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
    integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<div class="container-fluid pb-1">

    <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();">
        <i class='bx bx-filter icon_creer'></i>Afficher les filtres
    </a>
    <div class="m-4" role="tabpanel">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item active">
                <a href="#enCours" class="nav-link active" data-toggle="tab">Configurer Programme&nbsp;&nbsp;&nbsp;{{count($mod_en_cours)}}</a>
            </li>
            <li class="nav-item">
                <a href="#nonPublies" class="nav-link" data-toggle="tab">Configurer Compétence&nbsp;&nbsp;&nbsp;{{count($mod_non_publies)}}</a>
            </li>
            <li class="nav-item">
                <a href="#hors_ligne" class="nav-link" data-toggle="tab">Catalogue Hors ligne&nbsp;&nbsp;&nbsp;{{count($mod_hors_ligne)}}</a>
            </li>
            <li class="nav-item">
                <a href="#publies" class="nav-link" data-toggle="tab">Catalogue en Ligne&nbsp;&nbsp;&nbsp;{{count($mod_publies)}}</a>
            </li>
            <li class="">
                <a href="{{route('nouveau_module')}}" class=" btn_nouveau" role="button"><i class='bx bx-plus-medical me-2'></i>nouveau module</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="enCours">
                <div class="container-fluid p-0 mt-3 me-3">
                    <div class="row instruction mb-3">
                        <div class="col-12">
                            <p class="mb-0 ">La configuration de programme regroupe tous les modules qui viennent d'être crées.<br>
                                La première étape pour pouvoir publier votre module consiste à compléter votre programme
                                de formation et vos cours.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-12 ps-3">
                            <div class="row pading_bas">
                                @if($mod_en_cours == null)
                                <div class="si_vide row mt-4">
                                    <h5 class="text-center text-uppercase">Vous n'avez pas encore créer de module</h5>
                                    <a class="text-center mt-5" href="{{route('nouveau_module')}}" role="button" ><i
                                            class='bx bx-layer-plus icon_vide' title="ajouter un nouveau module"></i></a>
                                </div>
                                @else
                                @foreach($mod_en_cours as $mod)
                                <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-12 col-sm-12 list_module">
                                    <div class="row detail__formation__result new_card_module bg-light mb-3"
                                        id="border_premier">
                                        <div class=" detail__formation__result__content">
                                            <div class="detail__formation__result__item ">
                                                <h4 class="mt-3 ">
                                                    <span id="preview_module">
                                                        <span class="acf-nom_module">{{$mod->nom_module}}</span>
                                                    </span>
                                                </h4>
                                                <span id="preview_categ"><span class=" acf-categorie"
                                                        style="font-size: 0.850rem; color: #637381">{{$mod->nom_formation}}</span></span>
                                                <p id="preview_descript"><span class="acf-description"
                                                        style="font-size: 0.850rem">{{$mod->description}}</span></p>
                                                <div class="d-flex ">
                                                    <div class="col-6 detail__formation__result__avis">
                                                        <div style="--note: 4.5;">
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star-half'></i>
                                                        </div>
                                                        <span><strong>0.0</strong>/5 (aucun avis)</span>
                                                        @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                                        <span
                                                            class="">pour&nbsp;{{$mod->min_pers}}&nbsp;à&nbsp;{{$mod->max_pers}}&nbsp;personne</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-6 w-100">
                                                        <p class="m-0">
                                                            <span class="new_module_prix">
                                                                <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pers</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                            </span>
                                                        </p>
                                                        <p class="m-0 ">
                                                            <span class="new_module_prix">
                                                            @if($mod->prix_groupe != null)
                                                                <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;/ grp</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                            @endif
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="row row-cols-auto liste__formation__result__item3 justify-content-between py-1">
                                            <div class="col-3" style="font-size: 12px" id="preview_haut2"><i
                                                    class="bx bxs-alarm bx_icon"
                                                    style="color: #7635dc !important; font-size: 0.800rem"></i>
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
                                        <div class="d-flex flex-row justify-content-center">
                                            @canany(['isCFP','isAdmin','isSuperAdmin'])
                                            <div class="" id="preview_niveau">
                                                <button class="btn modifier pt-0"><a
                                                        href="{{route('modifier_module',$mod->module_id)}}"><i
                                                            class='bx bx-edit bx_modifier'
                                                            title="modifier les informations"></i></a></button>
                                            </div>
                                            <div class="" id="preview_niveau">
                                                <button class="btn supprimer pt-0" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal_{{$mod->module_id}}"><i
                                                        class="bx bx-trash bx_supprimer"
                                                        title="supprimer le module"></i></button>
                                            </div>
                                            <div class="mt-1">
                                                <a href="{{route('ajout_programme',$mod->module_id)}}"
                                                    class="btn_completer"
                                                    role="button">Completer&nbsp;votre&nbsp;programme</a>
                                            </div>
                                        </div>

                                        <div>
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
                                                            <small>Vous êtes sur le point d'effacer une donnée, cette
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


            <div class="tab-pane show fade" id="nonPublies">
                <div class="container-fluid p-0 mt-3 me-3">
                    <div class="row instruction mb-3">
                        <div class="col-12">
                            <p class="mb-0 ">Le configuration de competence regroupe tous les modules qui doivent êtres activés.
                                <br>
                                La deuxième étape consiste à ajouter les compétences ou les cours qui seront évalués par
                                le formateur, afin d'établir les évaluations des participants.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-12 ps-3">
                            <div class="row pading_bas d-flex flex-wrap">
                                @if($mod_non_publies == null)
                                <div class="si_vide row mt-4">
                                    <h5 class="text-center text-uppercase">Vous n'avez pas encore créer de module</h5>
                                    <a class="text-center mt-5" href="{{route('nouveau_module')}}" role="button"><i
                                            class='bx bx-layer-plus icon_vide'></i></a>
                                </div>
                                @else
                                @foreach($mod_non_publies as $mod)
                                <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-12 col-sm-12 list_module">
                                    <div class="row detail__formation__result new_card_module bg-light mb-3"
                                        id="border_premier">
                                        <div class=" detail__formation__result__content">
                                            <div class="detail__formation__result__item ">
                                                <h4 class="mt-3">
                                                    <span id="preview_module"><span
                                                            class="acf-nom_module">{{$mod->nom_module}}</span></span>
                                                </h4>
                                                <span id="preview_categ"><span class=" acf-categorie"
                                                        style="font-size: 0.850rem; color: #637381">{{$mod->nom_formation}}</span></span>
                                                <p id="preview_descript"><span class="acf-description"
                                                        style="font-size: 0.850rem">{{$mod->description}}</span></p>
                                                <div class="d-flex ">
                                                    <div class="col-6 detail__formation__result__avis">
                                                        <div style="--note: 4.5;">
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star-half'></i>
                                                        </div>
                                                        <span><strong>0.0</strong>/5 (aucun avis)</span>
                                                        @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                                        <span
                                                            class="">pour&nbsp;{{$mod->min_pers}}&nbsp;à&nbsp;{{$mod->max_pers}}&nbsp;personne</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-6 w-100">
                                                        <p class="m-0">
                                                            <span class="new_module_prix">
                                                                <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pers</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                            </span>
                                                        </p>
                                                        <p class="m-0 ">
                                                            <span class="new_module_prix">
                                                            @if($mod->prix_groupe != null)
                                                                <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;/ grp</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                            @endif
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="row row-cols-auto liste__formation__result__item3 justify-content-between py-1">
                                            <div class="col-3" style="font-size: 12px" id="preview_haut2"><i
                                                    class="bx bxs-alarm bx_icon"
                                                    style="color: #7635dc !important; font-size: 0.800rem"></i>
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
                                        <div class="d-flex flex-row justify-content-center">
                                            @canany(['isCFP','isAdmin','isSuperAdmin'])
                                            <div class="" id="preview_niveau">
                                                <button class="btn modifier pt-0"><a
                                                        href="{{route('modif_programmes',$mod->module_id)}}"><i
                                                            class='bx bx-edit bx_modifier'
                                                            title="modifier les informations"></i></a></button>
                                            </div>
                                            <div class="" id="preview_niveau">
                                                <button class="btn supprimer pt-0" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal_{{$mod->module_id}}"><i
                                                        class="bx bx-trash bx_supprimer"
                                                        title="supprimer le module"></i></button>
                                            </div>
                                            <div class="mt-2">
                                                <button type="button" class="btn btn_competence mt-1"
                                                    data-id="{{$mod->module_id}}" data-bs-toggle="modal"
                                                    data-bs-target="#ModalCompetence"
                                                    id="{{$mod->module_id}}">Compétences&nbsp;professionnelles</button>
                                            </div>
                                            <div>
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
                                            </div>
                                            @endcanany
                                        </div>

                                    </div>
                                </div>

                                <div class="modal fade" id="ModalCompetence">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{route('publier_module')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" id="id" value="{{$mod->module_id}}">
                                                <div class="modal-header ">
                                                    <h6>Compétences a évaluer</h6>
                                                </div>
                                                <div class="modal-body mt-2 mb-2">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="mt-2 text-center">
                                                                <button id="addRow" type="button"
                                                                    class="btn btn_nouveau text-center mb-4 pb-2"
                                                                    onclick="competence();">
                                                                    <i class='bx bx-plus-medical me-1'></i>Ajouter
                                                                    une nouvelle ligne
                                                                </button>

                                                            </div>
                                                        </div>
                                                        <div class="d-flex">
                                                            <div class="col-8">
                                                                <div class="form-group">
                                                                    <div class="form-row">
                                                                        <input type="text" name="titre_competence[]"
                                                                            id="titre_competence"
                                                                            class="form-control input"
                                                                            placeholder="Compétences" required>
                                                                        <label for="titre_competence"
                                                                            class="form-control-placeholder">Compétences</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group ms-1">
                                                                    <div class="form-row">
                                                                        <input type="text" name="notes[]" id="notes"
                                                                            min="1" max="10"
                                                                            onfocus="(this.type='number')"
                                                                            class="form-control input"
                                                                            placeholder="Notes" required>
                                                                        <label for="notes"
                                                                            class="form-control-placeholder">Notes</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="newRow"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn_annuler" data-bs-dismiss="modal"><i class='bx bx-x me-1'></i>Annuler</button>
                                                    <button type="submit" class="btn btn_enregistrer redirect_tab" id="{{$mod->module_id}}"><i class='bx bx-check me-1'></i>Enregistrer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane show fade" id="hors_ligne">
                <div class="container-fluid p-0 mt-3 me-3">
                    <div class="row instruction mb-3">
                        <div class="col-12">
                            <p class="mb-0 ">Le catalogue hors ligne regroupe tous les modules qui sont déjá términer et attendent d'être mises en ligne.
                                <br>
                                Ce sont les modules qui s'afficheront dans votre catalogue de formation et qui seront
                                visibles publiquement s'ils sont mises en lignes.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-lg-12 ps-3">
                            <div class="row pading_bas d-flex flex-wrap">
                                @if($mod_hors_ligne == null)
                                <div class="si_vide row mt-4">
                                    <h5 class="text-center text-uppercase">Vous n'avez pas encore créer de module</h5>
                                    <a class="text-center mt-5" href="{{route('nouveau_module')}}" role="button"><i
                                            class='bx bx-layer-plus icon_vide'></i></a>
                                </div>
                                @else
                                @foreach($mod_hors_ligne as $mod)
                                <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-12 col-sm-12 list_module">
                                    <div class="row detail__formation__result new_card_module bg-light justify-content-space-between py-3 px-2"
                                        id="border_premier">
                                        <div class="col-lg-12 col-md-12 detail__formation__result__content">
                                            <div class="detail__formation__result__item ">
                                                <h4 class="mt-2">
                                                    <span id="preview_module"><span
                                                            class="acf-nom_module">{{$mod->nom_module}}</span></span>

                                                </h4>
                                                <span id="preview_categ"><span class=" acf-categorie"
                                                        style="font-size: 0.850rem; color: #637381; margin-bottom: 5px">{{$mod->nom_formation}}</span></span>
                                                <p id="preview_descript"><span
                                                        class="acf-description">{{$mod->description}}</span></p>
                                            </div>
                                            <div class="d-flex ">
                                                <div class="col-6 detail__formation__result__avis">
                                                    <div style="--note: 4.5;">
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star-half'></i>
                                                    </div>
                                                    <span><strong>0.0</strong>/5 (aucun avis)</span>
                                                    @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                                    <span
                                                        class="">pour&nbsp;{{$mod->min_pers}}&nbsp;à&nbsp;{{$mod->max_pers}}&nbsp;personne</span>
                                                    @endif
                                                </div>
                                                <div class="col-6 w-100">
                                                    <p class="m-0">
                                                        <span class="new_module_prix">
                                                            <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pers</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                        </span>
                                                    </p>
                                                    <p class="m-0 ">
                                                        <span class="new_module_prix">
                                                        @if($mod->prix_groupe != null)
                                                            <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;/ grp</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
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
                                                        @if ($mod->etat_id == 2)
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
                                                        <button type="button" class="btn btn_enregistrer suppression_module" ><i class='bx bx-check me-1'></i>Oui</button>
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

            <div class="tab-pane show fade" id="publies">
                <div class="container-fluid p-0 mt-3 me-3">
                    <div class="row instruction mb-3">
                        <div class="col-12">
                            <p class="mb-0 ">Le catalogue en ligne regroupe tous les modules qui sont déjá mises en ligne.
                                <br>
                                Ce sont les modules qui s'afficheront dans votre catalogue de formation et qui seront
                                visibles publiquement.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-lg-12 ps-3">
                            <div class="row pading_bas d-flex flex-wrap">
                                @if($mod_publies == null)
                                <div class="si_vide row mt-4">
                                    <h5 class="text-center text-uppercase">Vous n'avez pas encore créer de module</h5>
                                    <a class="text-center mt-5" href="{{route('nouveau_module')}}" role="button"><i
                                            class='bx bx-layer-plus icon_vide'></i></a>
                                </div>
                                @else
                                @foreach($mod_publies as $mod)
                                <div class="col-xxl-4 col-xl-4 col-lg-6 col-md-12 col-sm-12 list_module">
                                    <div class="row detail__formation__result new_card_module bg-light justify-content-space-between py-3 px-2"
                                        id="border_premier">
                                        <div class="col-lg-12 col-md-12 detail__formation__result__content">
                                            <div class="detail__formation__result__item ">
                                                <h4 class="mt-2">
                                                    <span id="preview_module"><span
                                                            class="acf-nom_module">{{$mod->nom_module}}</span></span>

                                                </h4>
                                                <span id="preview_categ"><span class=" acf-categorie"
                                                        style="font-size: 0.850rem; color: #637381; margin-bottom: 5px">{{$mod->nom_formation}}</span></span>
                                                <p id="preview_descript"><span
                                                        class="acf-description">{{$mod->description}}</span></p>
                                            </div>
                                            <div class="d-flex ">
                                                <div class="col-6 detail__formation__result__avis">
                                                    <div style="--note: 4.5;">
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star'></i>
                                                        <i class='bx bxs-star-half'></i>
                                                    </div>
                                                    <span><strong>0.0</strong>/5 (aucun avis)</span>
                                                    @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                                    <span
                                                        class="">pour&nbsp;{{$mod->min_pers}}&nbsp;à&nbsp;{{$mod->max_pers}}&nbsp;personne</span>
                                                    @endif
                                                </div>
                                                <div class="col-6 w-100">
                                                    <p class="m-0">
                                                        <span class="new_module_prix">
                                                            <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pers</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                                                        </span>
                                                    </p>
                                                    <p class="m-0 ">
                                                        <span class="new_module_prix">
                                                        @if($mod->prix_groupe != null)
                                                            <div class="mb-2">{{$devise->devise}}&nbsp;{{number_format($mod->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;/ grp</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
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
                                                        @if ($mod->etat_id == 1)
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
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        PROGRAMME À COMPLÉTER
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form action="">
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-6 me-1 justify-content-center">
                                                    <select name="ref" id="ref" class="form-control mb-2 outline_none">
                                                        <option value="null" disable selected hidden>Référence</option>
                                                        @foreach($mod_en_cours as $mod_prog)
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
                                                        @foreach($mod_en_cours as $mod_prog)
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
                                                        <input type="range" name="range" step="4" min="4" max="40" value="" onchange="rangeHour.value=value" class="slide_range slide_hour">
                                                        <input type="text" id="rangeHour" class="prix_range prix_slide" readonly/>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <label>Durée en Jours</label>
                                                    <div class="d-flex flex-row">
                                                        <input type="range" name="range" step="1" min="1" max="5" value="" onchange="rangeDay.value=value" class="slide_range slider_day">
                                                        <input type="text" id="rangeDay" class="prix_range prix_slide" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="m-0 mb-1">Intervalle de prix par personne en {{$devise->devise}}</p>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-8">
                                                    <div class="d-flex flex-row">
                                                        <span class="me-4 text_prix">100&sbquo;000</span><input type="range" name="range" step="50000" min="100000" max="500000" value=""  class="slide_range w-100" id="prix_pers">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" id="rangePrimary" class="prix_range" readonly/>
                                                </div>
                                            </div>
                                            <p class="m-0 mb-1">Intervalle de prix par groupe en {{$devise->devise}}</p>
                                            <div class="form-row d-flex flex-row">
                                                <div class="col-8">
                                                    <div class="d-flex flex-row">
                                                        <span class="me-4 text_prix">1&sbquo;000&sbquo;000</span><input type="range" name="range" step="100000" min="1000000" max="5000000" value="" class="slide_range w-100" id="prix_groupe">
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <input type="text" id="rangePrimary1" class="prix_range" readonly/>
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
                                                        @foreach($mod_non_publies as $mod_prog)
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
                                                        @foreach($mod_non_publies as $mod_prog)
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
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let lien = ($(e.target).attr('href'));
        localStorage.setItem('ActiveTabMod', lien);
    });
    let ActiveTabMod = localStorage.getItem('ActiveTabMod');
    if(ActiveTabMod){
        $('#myTab a[href="' + ActiveTabMod + '"]').tab('show');
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

    document.getElementById('prix_pers').addEventListener('input', function (e) {
        let valeur = e.target.value.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",").trim();
        rangePrimary.value = valeur;
    });
    document.getElementById('prix_groupe').addEventListener('input', function (e) {
        let valeur = e.target.value.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",").trim();
        rangePrimary1.value = valeur;
    });
    document.getElementById('prix_pers1').addEventListener('input', function (e) {
        let valeur = e.target.value.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",").trim();
        rangeSecondary.value = valeur;
    });
    document.getElementById('prix_groupe1').addEventListener('input', function (e) {
        let valeur = e.target.value.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",").trim();
        rangeSecondary1.value = valeur;
    });
    document.getElementById('prix_pers2').addEventListener('input', function (e) {
        let valeur = e.target.value.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",").trim();
        rangeThird.value = valeur;
    });
    document.getElementById('prix_groupe2').addEventListener('input', function (e) {
        let valeur = e.target.value.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ",").trim();
        rangeThird1.value = valeur;
    });

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