@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Modules</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
    integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
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
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="enCours">
                <div class="container-fluid p-0 mt-3 me-3">
                    <div class="row instruction mb-3">
                        <div class="col-12">
                            <p class="mb-0 ">L'onglet programme à completer regroupe tous les modules qui ne sont pas
                                encore términés. <br>
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
                                    <a class="text-center mt-5" href="{{route('nouveau_module')}}" role="button"><i
                                            class='bx bx-layer-plus icon_vide'></i></a>
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
                                                                @php
                                                                echo number_format($mod->prix, 0, ' ', ' ');
                                                                @endphp
                                                                &nbsp;{{$devise->devise}}</span>&nbsp;HT<span>/pers</span>
                                                        </p>
                                                        <p class="m-0 ">
                                                            <span class="new_module_prix">
                                                                @if($mod->prix_groupe == null)
                                                                <span>-&nbsp;&nbsp;&nbsp;{{$devise->devise}}&nbsp;HT<span>/grp</span></span>
                                                                @else
                                                                @php
                                                                echo number_format($mod->prix_groupe, 0, ' ', ' ');
                                                                @endphp
                                                                &nbsp;{{$devise->devise}}</span>&nbsp;HT<span>/grp</span>
                                                            @endif
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
                                        <div class="d-flex flex-row">
                                            @canany(['isCFP','isAdmin','isSuperAdmin'])
                                            <div class="" id="preview_niveau">
                                                <button class="btn modifier pt-0"><a
                                                        href="{{route('modifier_module',$mod->module_id)}}"><i
                                                            class='bx bx-edit background_grey'
                                                            style="color: #0052D4 !important;font-size: 15px"
                                                            title="modifier les informations"></i></a></button>
                                            </div>
                                            <div class="" id="preview_niveau">
                                                <button class="btn supprimer pt-0" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal_{{$mod->module_id}}"><i
                                                        class="bx bx-trash background_grey2"
                                                        style="color: #ff0000 !important;font-size: 15px"
                                                        title="supprimer le module"></i></button>
                                            </div>
                                            <div class="" id="preview_niveau">
                                                <button class="btn afficher pt-0" data-id="{{$mod->module_id}}"
                                                    data-bs-toggle="modal" data-bs-target="#ModalAffichage"
                                                    id="{{$mod->module_id}}"><i
                                                        class='bx bx-low-vision background_grey3'
                                                        style="color: #3b9f0c !important;font-size: 15px"
                                                        title="afficher les informations"></i></a>

                                                </button>
                                            </div>
                                            <div class=" new_btn_programme text-center">
                                                <a href="{{route('ajout_programme',$mod->module_id)}}"
                                                    class="btn_completer"
                                                    role="button">Completer&nbsp;votre&nbsp;programme</a>
                                            </div>
                                        </div>


                                        <div class="modal fade" id="exampleModal_{{$mod->module_id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header  d-flex justify-content-center"
                                                        style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <small>Vous êtes sur le point d'effacer une donnée, cette
                                                            action
                                                            est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal"> Non
                                                        </button>
                                                        <button type="button" class="btn btn-secondary suppression"
                                                            id="{{$mod->module_id}}"> Oui</button>
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
                            <p class="mb-0 ">L'onglet Non Publiés regroupe tous les modules qui doivent êtres activés.
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
                                                                @php
                                                                echo number_format($mod->prix, 0, ' ', ' ');
                                                                @endphp
                                                                &nbsp;{{$devise->devise}}</span>&nbsp;HT<span>/pers</span>
                                                        </p>
                                                        <p class="m-0 ">
                                                            <span class="new_module_prix">
                                                                @if($mod->prix_groupe == null)
                                                                <span>-&nbsp;&nbsp;&nbsp;{{$devise->devise}}&nbsp;HT<span>/grp</span></span>
                                                                @else
                                                                @php
                                                                echo number_format($mod->prix_groupe, 0, ' ', ' ');
                                                                @endphp
                                                                &nbsp;{{$devise->devise}}</span>&nbsp;HT<span>/grp</span>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class=" text-end">
                                            <div>
                                                @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                                <span
                                                    class="">{{$mod->min_pers}}&nbsp;-&nbsp;{{$mod->max_pers}}&nbsp;personne</span>
                                                @endif
                                            </div>
                                        </div> --}}
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
                                        <div class="row row-cols-auto liste__formation__result__item3 justify-content-center text-center py-1">
                                            @canany(['isCFP','isAdmin','isSuperAdmin'])
                                            <div class="col-3" id="preview_niveau">
                                                <button class="btn modifier pt-0"><a
                                                        href="{{route('modif_programmes',$mod->module_id)}}"><i
                                                            class='bx bx-edit background_grey'
                                                            style="color: #0052D4 !important;font-size: 15px"
                                                            title="modifier les informations"></i></a></button>
                                            </div>
                                            {{-- <div class="" id="preview_niveau">
                                                <button class="btn modifier_prog pt-0"><a
                                                        href="{{route('modifier_module_prog',$mod->module_id)}}"><i
                                                            class='bx bx-edit-alt background_grey4'
                                                            style="color: #801d68 !important;font-size: 15px"
                                                            title="modifier les programmes"></i></a></button>
                                            </div> --}}
                                            <div class="" id="preview_niveau">
                                                <button class="btn supprimer pt-0" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal_{{$mod->module_id}}"><i
                                                        class="bx bx-trash background_grey2"
                                                        style="color: #ff0000 !important;font-size: 15px"
                                                        title="supprimer le module"></i></button>
                                            </div>
                                            <div class="" id="preview_niveau">
                                                <button class="btn afficher pt-0" data-id="{{$mod->module_id}}"
                                                    data-bs-toggle="modal" data-bs-target="#ModalAffichage"
                                                    id="{{$mod->module_id}}"><i
                                                        class='bx bx-low-vision background_grey3'
                                                        style="color: #799F0C !important;font-size: 15px"
                                                        title="afficher les informations"></i></button>
                                            </div>
                                            <div class="modal fade" id="exampleModal_{{$mod->module_id}}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header  d-flex justify-content-center"
                                                            style="background-color:rgb(224,182,187);">
                                                            <h6 class="modal-title">Avertissement !</h6>
                                                        </div>
                                                        <div class="modal-body">
                                                            <small>Vous êtes sur le point d'effacer une donnée,
                                                                cette
                                                                action
                                                                est irréversible. Continuer ?</small>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal"> Non
                                                            </button>
                                                            <button type="button" class="btn btn-secondary suppression"
                                                                id="{{$mod->module_id}}"> Oui</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endcanany
                                        </div>
                                        <div class="new_btn_programme text-center">
                                            <button type="button" class="btn btn_competence non_pub"
                                                data-id="{{$mod->module_id}}" data-bs-toggle="modal"
                                                data-bs-target="#ModalCompetence"
                                                id="{{$mod->module_id}}">Compétences&nbsp;professionnelles</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal fade" id="ModalCompetence">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="{{route('publier_module')}}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" id="id" value="{{$mod->module_id}}">
                                                <div class="modal-header">
                                                    <h6>Compétences a évaluer</h6>
                                                </div>
                                                <div class="modal-body mt-2 mb-2">
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="mt-2 text-center">
                                                                <button id="addRow" type="button"
                                                                    class="btn_creer text-center mb-4 pb-2"
                                                                    onclick="competence();">
                                                                    <i class='bx bx-plus-medical icon_creer'></i>Ajouter
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
                                                <div class="modal-footer d-flex flex-row">
                                                    <button type="button" class="btn btn_annuler " id="fermer"
                                                        data-bs-dismiss="modal">Annuler</button>
                                                    <button type="submit"
                                                        class="btn btn_enregistrer non_pub">Enregistrer</button>
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
                            <p class="mb-0 ">L'onglet Publiés regroupe tous les modules qui sont déjá mises en ligne.
                                <br>
                                Ce sont les modules qui s'afficheront dans votre catalogue de formation et qui seront
                                visibles publiquement.</p>
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
                                                            @php
                                                            echo number_format($mod->prix, 0, ' ', ' ');
                                                            @endphp
                                                            &nbsp;{{$devise->devise}}</span>&nbsp;HT<span>/pers</span>
                                                    </p>
                                                    <p class="m-0 ">
                                                        <span class="new_module_prix">
                                                            @if($mod->prix_groupe == null)
                                                            <span>-&nbsp;&nbsp;&nbsp;{{$devise->devise}}&nbsp;HT<span>/grp</span></span>
                                                            @else
                                                            @php
                                                            echo number_format($mod->prix_groupe, 0, ' ', ' ');
                                                            @endphp
                                                            &nbsp;{{$devise->devise}}</span>&nbsp;HT<span>/grp</span>
                                                        @endif
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
                                                                class='bx bx-edit background_grey'
                                                                style="color: #0052D4 !important;font-size: 15px"
                                                                title="modifier les informations"></i></a></button>
                                                </div>
                                                {{-- <div class="col-3" id="preview_niveau">
                                                    <button class="btn modifier_prog pt-0"><a
                                                            href="{{route('modifier_module_prog',$mod->module_id)}}"><i
                                                                class='bx bx-edit-alt background_grey4'
                                                                style="color: #801d68 !important;font-size: 15px"
                                                                title="modifier les programmes"></i></a></button>
                                                </div> --}}
                                                <div class="col" id="preview_niveau">
                                                    <button class="btn supprimer pt-0" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal_{{$mod->module_id}}"><i
                                                            class="bx bx-trash background_grey2"
                                                            style="color: #ff0000 !important;font-size: 15px"
                                                            title="supprimer le module"></i></button>
                                                </div>
                                                <div class="col" id="preview_niveau">
                                                    <button class="btn afficher pt-0" data-id="{{$mod->module_id}}"
                                                        data-bs-toggle="modal" data-bs-target="#ModalAffichage"
                                                        id="{{$mod->module_id}}"><i
                                                            class='bx bx-low-vision background_grey3'
                                                            style="color: #799F0C !important;font-size: 15px"
                                                            title="afficher les informations"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="new_btn_programme text-center">
                                                    <div class="text-uppercase">
                                                        @if ($mod->etat_id == 2)
                                                        <div class="form-check form-switch d-flex flex-row">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked"><span class="button_choix_hors_ligne">Hors&nbsp;Ligne</span></label>
                                                            <input class="form-check-input  ms-3" data-bs-toggle="modal" data-bs-target="#en_ligne_{{$mod->module_id}}" type="checkbox" value="{{$mod->module_id}}" title="activer pour mettre en ligne">
                                                        </div>
                                                        @endif
                                                        {{-- <a href="{{route('mettre_')}}" role="button"><span class="btn py-1 button_choix active_mod">Hors Ligne</span></a>
                                                        <a href="" role="button"><span class="btn py-1 button_choix">En ligne</span></a> --}}
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="exampleModal_{{$mod->module_id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header  d-flex justify-content-center"
                                                        style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <small>Vous êtes sur le point d'effacer une donnée,
                                                            cette
                                                            action
                                                            est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal"> Non
                                                        </button>
                                                        <button type="button" class="btn btn-secondary suppression"
                                                            id="{{$mod->module_id}}"> Oui</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="en_ligne_{{$mod->module_id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="en_ligne_{{$mod->module_id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header  d-flex justify-content-center"
                                                        style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center my-2">
                                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                                        </div>
                                                        <p class="text-center">Vous allez mettre en ligne cette module. Êtes-vous sur?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary non_en_ligne"
                                                            data-bs-dismiss="modal"> Non
                                                        </button>
                                                        <button type="button" class="btn btn-secondary mettre_en_ligne"
                                                            id="{{$mod->module_id}}"> Oui</button>
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
                            <p class="mb-0 ">L'onglet Publiés regroupe tous les modules qui sont déjá mises en ligne.
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
                                                            @php
                                                            echo number_format($mod->prix, 0, ' ', ' ');
                                                            @endphp
                                                            &nbsp;{{$devise->devise}}</span>&nbsp;HT<span>/pers</span>
                                                    </p>
                                                    <p class="m-0 ">
                                                        <span class="new_module_prix">
                                                            @if($mod->prix_groupe == null)
                                                            <span>-&nbsp;&nbsp;&nbsp;{{$devise->devise}}&nbsp;HT<span>/grp</span></span>
                                                            @else
                                                            @php
                                                            echo number_format($mod->prix_groupe, 0, ' ', ' ');
                                                            @endphp
                                                            &nbsp;{{$devise->devise}}</span>&nbsp;HT<span>/grp</span>
                                                        @endif
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
                                                                class='bx bx-edit background_grey'
                                                                style="color: #0052D4 !important;font-size: 15px"
                                                                title="modifier les informations"></i></a></button>
                                                </div>
                                                {{-- <div class="col-3" id="preview_niveau">
                                                    <button class="btn modifier_prog pt-0"><a
                                                            href="{{route('modifier_module_prog',$mod->module_id)}}"><i
                                                                class='bx bx-edit-alt background_grey4'
                                                                style="color: #801d68 !important;font-size: 15px"
                                                                title="modifier les programmes"></i></a></button>
                                                </div> --}}
                                                <div class="col" id="preview_niveau">
                                                    <button class="btn supprimer pt-0" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal_{{$mod->module_id}}"><i
                                                            class="bx bx-trash background_grey2"
                                                            style="color: #ff0000 !important;font-size: 15px"
                                                            title="supprimer le module"></i></button>
                                                </div>
                                                <div class="col" id="preview_niveau">
                                                    <button class="btn afficher pt-0" data-id="{{$mod->module_id}}"
                                                        data-bs-toggle="modal" data-bs-target="#ModalAffichage"
                                                        id="{{$mod->module_id}}"><i
                                                            class='bx bx-low-vision background_grey3'
                                                            style="color: #799F0C !important;font-size: 15px"
                                                            title="afficher les informations"></i></button>
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <div class="new_btn_programme text-center">
                                                    <div class="text-uppercase">
                                                        @if ($mod->etat_id == 1)
                                                        <div class="form-check form-switch d-flex flex-row">
                                                            <label class="form-check-label" for="flexSwitchCheckChecked"><span class="button_choix">En&nbsp;Ligne</span></label>
                                                            <input class="form-check-input  ms-3" data-bs-toggle="modal" data-bs-target="#hors_ligne_{{$mod->module_id}}" type="checkbox" title="désactiver pour mettre hors ligne" checked>
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
                                                    <div class="modal-header  d-flex justify-content-center"
                                                        style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <small>Vous êtes sur le point d'effacer une donnée,
                                                            cette
                                                            action
                                                            est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal"> Non
                                                        </button>
                                                        <button type="button" class="btn btn-secondary suppression"
                                                            id="{{$mod->module_id}}">Oui</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="hors_ligne_{{$mod->module_id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="hors_ligne_{{$mod->module_id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header  d-flex justify-content-center"
                                                        style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="text-center my-2">
                                                            <i class="fa-solid fa-circle-exclamation warning"></i>
                                                        </div>
                                                        <p class="text-center">Vous allez mettre hors ligne cette module. Êtes-vous sur?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary non_hors_ligne"
                                                            data-bs-dismiss="modal"> Non
                                                        </button>
                                                        <button type="button" class="btn btn-secondary mettre_hors_ligne"
                                                            id="{{$mod->module_id}}"> Oui</button>
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
                {{-- <div class="modal" id="ModalAffichage">
                    <div class="modal-dialog">
                        <div class="modal-content modal_grand">
                            <div class="container-fluid">
                                <div class="col-lg-12" id="preview_haut">
                                    <div class="container py-4 bg-light">
                                        <div class="row  bg-light justify-content-space-between py-3 px-5"
                                            id="border_premier">
                                            <div class="col-lg-6 col-md-6 new_back">
                                                <div class="detail__formation__result__item ">
                                                    <h4>
                                                        <span id="preview_module">
                                                            <span class="acf-nom_module" id="nom_module"></span>
                                                        </span><br>
                                                        <span id="preview_categ">
                                                            <span class="py-4 acf-categorie" id="nom_formation"></span>
                                                            <span>
                                                    </h4>
                                                    <p id="preview_descript"><span class="acf-description"
                                                            id="description"></span></p>
                                                    <div class="detail__formation__result__avis"
                                                        style="color: black !important;">
                                                        <div class="Stars" style="--note: 4.5;">
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star-half'></i>
                                                        </div>
                                                        <span><strong>4.5</strong>/5 (250 avis)</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 detail__formation__result__content">
                                                <div class="detail__formation__result__item2">

                                                </div>
                                            </div>
                                            <div
                                                class="row row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                                                <div class="col" id="preview_haut2"><i class="bx bxs-alarm bx_icon"
                                                        style="color: black !important;"></i>
                                                    <span id="preview_jour"><span class="acf-jour"
                                                            id="jour"></span>j</span>
                                                    <span id="preview_heur">/<span class="acf-heur"
                                                            id="heure"></span>h</span>
                                                </div>
                                                <div class="col" id="preview_modalite"><i class="bx bxs-devices bx_icon"
                                                        style="color: black !important;"></i>&nbsp;<span
                                                        lass="acf-modalite" id="modalite"></span>
                                                </div>
                                                <div class="col" id="preview_niveau">
                                                    <i class='bx bx-equalizer bx_icon'
                                                        style="color: black !important;"></i>&nbsp;<span
                                                        class="acf-niveau" id="niveau"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="row detail__formation__detail justify-content-space-between py-5 px-5">
                                            <div class="col-lg-8 detail__formation__content">

                                                <div class="row detail__formation__item__left__objectif"
                                                    id="border_objectif">
                                                    <div class="col-lg-12" id="preview_objectif">
                                                        <span class="adresse__text">
                                                            <i
                                                                class="bx bx-radio-circle-marked py-2 pb-3 adresse__icon"></i>&nbsp;Objectifs</span>
                                                        <p><span>>&nbsp;</span><span class="acf-objectif"
                                                                id="objectif"></span></p>
                                                    </div>
                                                </div>

                                                <div class="row detail__formation__item__left__adresse"
                                                    id="border_cible">
                                                    <div class="col-lg-6 d-flex flex-row">
                                                        <div class="row d-flex flex-row">
                                                            <span class="adresse__text"><i
                                                                    class="bx bx-user py-2 pb-3 adresse__icon"></i>&nbsp;Pour
                                                                qui ?</span>
                                                            <div class="col-12 px-2" id="preview_cible">
                                                                <p><span>>&nbsp;</span><span class="acf-cible"
                                                                        id="cible"></span></p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="row d-flex flex-row">
                                                            <span class="adresse__text"><i
                                                                    class="bx bx-list-plus py-2 pb-3 adresse__icon"></i>&nbsp;Prérequis</span>
                                                            <div class="col-12" id="preview_prerequis">
                                                                <p><span>>&nbsp;</span><span class="acf-prerequis"
                                                                        id="prerequis"></span></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row detail__formation__item__left__adresse"
                                                    id="border_equipement">
                                                    <div class="col-lg-6 d-flex flex-row">
                                                        <div class="row d-flex flex-row">
                                                            <span class="adresse__text"><i
                                                                    class="bx bxs-cog py-2 pb-3 adresse__icon"></i>&nbsp;Equipement
                                                                necessaire</span>
                                                            <div class="col-12" id="preview_materiel">
                                                                <p><span>>&nbsp;</span><span class="acf-materiel"
                                                                        id="materiel"></span></p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="row d-flex flex-row">
                                                            <span class="adresse__text"><i
                                                                    class="bx bxs-message-check py-2 pb-3 adresse__icon"></i>&nbsp;Bon
                                                                a savoir</span>
                                                            <div class="col-12" id="preview_bon_a_savoir">
                                                                <p><span>>&nbsp;</span><span class="acf-bon_a_savoir"
                                                                        id="bon_a_savoir"></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row detail__formation__item__left__adresse"
                                                    id="border_prestation">
                                                    <div class="col-lg-12 d-flex flex-row">
                                                        <div class="row d-flex flex-row">
                                                            <span class="adresse__text"><i
                                                                    class="bx bx-hive py-2 pb-3 adresse__icon"></i>&nbsp;Prestations
                                                                pedagogiques</span>
                                                            <div class="col-12" id="preview_prestation">
                                                                <p><span>>&nbsp;</span><span class="acf-prestation"
                                                                        id="prestation"></span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 detail__formation__item__right" id="border_reference">
                                                <div class="row detail__formation__item__main__head align-items-center">
                                                    <div class="detail__prix__head">
                                                        <div class="detail__prix__text">
                                                            <p class="pt-2"><b>INTRA</b></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row detail__formation__item__main">
                                                    <div class="detail__prix__main__presentiel pt-3">
                                                        <div>
                                                            <p class="text-uppercase text-center" id="preview_modalite">
                                                                <span class="acf-modalite" id="modalite2"></span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row detail__formation__item__main">
                                                    <div class="col-lg-5 detail__prix__main__ref pt-2">
                                                        <div>
                                                            <p><i class="bx bx-clipboard"></i>&nbsp;Ref :</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 detail__prix__main__ref2 pt-2">
                                                        <div id="preview_reference">
                                                            <p class="acf-reference text-center" id="reference"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="hr">
                                                <div class="row detail__formation__item__main">
                                                    <div class="col-lg-5 detail__prix__main__dure">
                                                        <div>
                                                            <p><i
                                                                    class="bx bxs-alarm bx_icon"></i><span>&nbsp;Durée</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 detail__prix__main__dure2">
                                                        <div>
                                                            <p class="text-center">
                                                                <span id="preview_jour"><span class="acf-jour"
                                                                        id="jour2"></span>j</span>
                                                                <span id="preview_heur">/<span class="acf-heur"
                                                                        id="heure2"></span>h</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="hr">
                                                <div class="row detail__formation__item__rmain">
                                                    <div class="col-lg-5 detail__prix__main__prix">
                                                        <div>
                                                            <p><i class='bx bx-euro'></i>&nbsp;Prix</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 detail__prix__main__prix2">
                                                        <div>
                                                            <p id="preview_prix" class="text-center"><span
                                                                    class="acf-prix" id="prix"></span>&nbsp;{{$devise->devise}}&nbsp;HT
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn_next " id="fermer" data-bs-dismiss="modal">
                                        Fermer </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
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
<script src="{{asset('js/modules.js')}}"></script>
<script >
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let lien = ($(e.target).attr('href'));
        localStorage.setItem('Tabactive', lien);
    });
    let Tabactive = localStorage.getItem('Tabactive');
    if(Tabactive){
        $('#myTab a[href="' + Tabactive + '"]').tab('show');
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

     $(".non_hors_ligne").on('click', function(e) {
        $(".form-check-input").prop('checked',true);
     });

     $(".non_en_ligne").on('click', function(e) {
        $(".form-check-input").prop('checked',false);
     });

     $(".mettre_hors_ligne").on('click', function(e) {
        let id = e.target.id;
        $.ajax({
            method: "GET"
            , url: "{{route('mettre_hors_ligne')}}"
            , data: {Id : id}
            , success: function(response) {
                window.location.reload();
            }
            , error: function(error) {
                console.log(error)
            }
        });
     });



</script>
@endsection