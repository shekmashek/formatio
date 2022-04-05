@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Modules</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
    <div class="container-fluid pb-3">
        <nav class="navbar navbar-expand-lg w-100 justify-content-end filter">
            <a href="#" class="btn_creer text-center"><i class='bx bx-candles icon_creer'></i>Filtrer les modules</a>
        </nav>
        <div class="m-4">
            <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
                <li class="nav-item">
                    <a href="#enCours" class="nav-link active" data-bs-toggle="tab">En cours de
                        creation&nbsp;({{count($mod_en_cours)}})</a>
                </li>
                <li class="nav-item">
                    <a href="#nonPublies" class="nav-link" data-bs-toggle="tab">Non
                        publiés&nbsp;({{count($mod_non_publies)}})</a>
                </li>
                <li class="nav-item">
                    <a href="#publies" class="nav-link" data-bs-toggle="tab">Publiés&nbsp;({{count($mod_publies)}})</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="enCours">
                    <div class="container-fluid p-0 mt-3 me-3">
                        <div class="row instruction mb-3">
                            <div class="col-12">
                                <p class="mb-0 ">L'onglet En Cours de Création regroupe tous les modules qui ne sont pas encore términés. <br>
                                    La première étape pour pouvoir publier votre module consiste à compléter votre programme de formation et vos cours.</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-10 ps-3">
                                <div class="row pading_bas">

                                    @foreach($mod_en_cours as $mod)
                                    <div class="col-6 list_module">
                                        <div class="row detail__formation__result new_card_module bg-light mb-3"
                                            id="border_premier">
                                            <div class=" detail__formation__result__content">
                                                <div class="detail__formation__result__item ">
                                                    <h4 class="mt-3"><span id="preview_categ"><span
                                                                class=" acf-categorie">{{$mod->nom_formation}}</span></span><span>&nbsp;-&nbsp;</span>
                                                        <span></span>
                                                        <span id="preview_module"><span
                                                                class="acf-nom_module">{{$mod->nom_module}}</span></span>
                                                    </h4>
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
                                                        </div>
                                                        <div class="col-6 ms-3 w-100">
                                                            <p class="m-0">
                                                                <span class="new_module_prix">
                                                                    @php
                                                                    echo number_format($mod->prix, 0, ' ', ' ');
                                                                    @endphp
                                                                    &nbsp;AR</span>&nbsp;HT
                                                            </p>
                                                            @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                                            <span
                                                                class="">{{$mod->min_pers}}&nbsp;-&nbsp;{{$mod->max_pers}}&nbsp;personne</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row row-cols-auto liste__formation__result__item3 justify-content-between py-1">
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
                                                    <a href="{{route('ajout_programme',$mod->module_id)}}" class="btn_completer" role="button">Completer&nbsp;votre&nbsp;programme</a>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade" id="nonPublies">
                    <div class="container-fluid p-0 mt-3 me-3">
                        <div class="row instruction mb-3">
                            <div class="col-12">
                                <p class="mb-0 ">L'onglet Non Publiés regroupe tous les modules qui doivent êtres activés. <br>
                                    La deuxième étape consiste à ajouter les compétences ou les cours qui seront évalués par le formateur, afin d'établir les évaluations des participants.</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-10 ps-3">
                                <div class="row pading_bas d-flex flex-wrap">
                                    @foreach($mod_non_publies as $mod)
                                    <div class="col-6 list_module">
                                        <div class="row detail__formation__result new_card_module bg-light mb-3"
                                            id="border_premier">
                                            <div class=" detail__formation__result__content">
                                                <div class="detail__formation__result__item ">
                                                    <h4 class="mt-3"><span id="preview_categ"><span
                                                                class=" acf-categorie">{{$mod->nom_formation}}</span></span><span>&nbsp;-&nbsp;</span>
                                                        <span></span>
                                                        <span id="preview_module"><span
                                                                class="acf-nom_module">{{$mod->nom_module}}</span></span>
                                                    </h4>
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
                                                        </div>
                                                        <div class="col-6 ms-3 w-100">
                                                            <p class="m-0">
                                                                <span class="new_module_prix">
                                                                    @php
                                                                    echo number_format($mod->prix, 0, ' ', ' ');
                                                                    @endphp
                                                                    &nbsp;AR</span>&nbsp;HT
                                                            </p>
                                                            @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                                            <span>{{$mod->min_pers}}&nbsp;-&nbsp;{{$mod->max_pers}}&nbsp;personne</span>
                                                            @endif
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
                                            <div
                                                class="row row-cols-auto liste__formation__result__item3 justify-content-between text-center py-1">
                                                @canany(['isCFP','isAdmin','isSuperAdmin'])
                                                <div class="col-3" id="preview_niveau">
                                                    <button class="btn modifier pt-0"><a
                                                            href="{{route('modifier_module_prog',$mod->module_id)}}"><i
                                                                class='bx bx-edit background_grey'
                                                                style="color: #0052D4 !important;font-size: 15px"
                                                                title="modifier les informations"></i></a></button>
                                                </div>
                                                <div class="col-3" id="preview_niveau">
                                                    <button class="btn modifier_prog pt-0"><a
                                                            href="{{route('modif_programmes',$mod->module_id)}}"><i
                                                                class='bx bx-edit-alt background_grey4'
                                                                style="color: #801d68 !important;font-size: 15px"
                                                                title="modifier les programmes"></i></a></button>
                                                </div>
                                                <div class="col-3" id="preview_niveau">
                                                    <button class="btn supprimer pt-0" data-bs-toggle="modal"
                                                        data-bs-target="#exampleModal_{{$mod->module_id}}"><i
                                                            class="bx bx-trash background_grey2"
                                                            style="color: #ff0000 !important;font-size: 15px"
                                                            title="supprimer le module"></i></button>
                                                </div>
                                                <div class="col-3" id="preview_niveau">
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
                                                            <div class="d-flex">
                                                                <div class="col-7">
                                                                    <div class="form-group">
                                                                        <div class="form-row">
                                                                            <input type="text" name="titre_competence[]"
                                                                                id="titre_competence"
                                                                                class="form-control input"
                                                                                required>
                                                                            <label for="titre_competence"
                                                                                class="form-control-placeholder">Compétences</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <div class="form-group ms-1">
                                                                        <div class="form-row">
                                                                            <input type="text" name="objectif[]"
                                                                                id="objectif" min="1" max="10"
                                                                                onfocus="(this.type='number')"
                                                                                class="form-control input"
                                                                                required>
                                                                            <label for="objectif"
                                                                                class="form-control-placeholder">Notes</label>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-1">
                                                                    <div class="mt-3">
                                                                        <button id="addRow" class="form-control btn_competence"
                                                                            type="button" onclick="competence();"><i
                                                                                class="bx bx-plus"
                                                                                style="font-size: 20px"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="newRow"></div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="tab-pane fade" id="publies">
                    <div class="container-fluid p-0 mt-3 me-3">
                        <div class="row instruction mb-3">
                            <div class="col-12">
                                <p class="mb-0 ">L'onglet Publiés regroupe tous les modules qui sont déjá mises en ligne. <br>
                                    Ce sont les modules qui s'afficheront dans votre catalogue de formation et qui seront visibles publiquement.</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <div class="col-10 ps-3">
                                <div class="row pading_bas d-flex flex-wrap">
                                    @foreach($mod_publies as $mod)
                                    <div class="col-6 list_module">
                                        <div class="row detail__formation__result new_card_module bg-light justify-content-space-between py-3 px-2"
                                            id="border_premier">
                                            <div class="col-lg-12 col-md-12 detail__formation__result__content">
                                                <div class="detail__formation__result__item ">
                                                    <h4 class="mt-2"><span id="preview_categ"><span
                                                                class="py-4 acf-categorie">{{$mod->nom_formation}}</span></span><span
                                                            style="color: #801d68">&nbsp;-&nbsp;</span>
                                                        <span></span>
                                                        <span id="preview_module"><span
                                                                class="acf-nom_module">{{$mod->nom_module}}</span></span>

                                                    </h4>
                                                    <p id="preview_descript"><span
                                                            class="acf-description">{{$mod->description}}</span></p>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="detail__formation__result__avis"
                                                            style="color: black !important;">
                                                            <div style="--note: 4.5;">
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star-half'></i>
                                                            </div>
                                                            <span><strong>0.0</strong>/5 (aucun avis)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="detail__formation__result__content text-end">
                                                            <div>
                                                                @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                                                <span
                                                                    style="color: #7635dc">{{$mod->min_pers}}&nbsp;-&nbsp;{{$mod->max_pers}}&nbsp;personne</span>
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <p style="margin: 0"><span class="new_module_prix">
                                                                        @php
                                                                        echo number_format($mod->prix, 0, ' ', ' ');
                                                                        @endphp
                                                                        &nbsp;AR</span>&nbsp;HT</p><span></span>
                                                            </div>

                                                        </div>
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
                                                <div class="col-8 d-flex flex-row">
                                                    <div class="col-3" id="preview_niveau">
                                                        <button class="btn modifier pt-0"><a
                                                                href="{{route('modifier_module_prog',$mod->module_id)}}"><i
                                                                    class='bx bx-edit background_grey'
                                                                    style="color: #0052D4 !important;font-size: 15px"
                                                                    title="modifier les informations"></i></a></button>
                                                    </div>
                                                    <div class="col-3" id="preview_niveau">
                                                        <button class="btn modifier_prog pt-0"><a
                                                                href="{{route('modif_programmes',$mod->module_id)}}"><i
                                                                    class='bx bx-edit-alt background_grey4'
                                                                    style="color: #801d68 !important;font-size: 15px"
                                                                    title="modifier les programmes"></i></a></button>
                                                    </div>
                                                    <div class="col-3" id="preview_niveau">
                                                        <button class="btn supprimer pt-0" data-bs-toggle="modal"
                                                            data-bs-target="#exampleModal_{{$mod->module_id}}"><i
                                                                class="bx bx-trash background_grey2"
                                                                style="color: #ff0000 !important;font-size: 15px"
                                                                title="supprimer le module"></i></button>
                                                    </div>
                                                    <div class="col-3" id="preview_niveau">
                                                        <button class="btn afficher pt-0" data-id="{{$mod->module_id}}"
                                                            data-bs-toggle="modal" data-bs-target="#ModalAffichage"
                                                            id="{{$mod->module_id}}"><i
                                                                class='bx bx-low-vision background_grey3'
                                                                style="color: #799F0C !important;font-size: 15px"
                                                                title="afficher les informations"></i></button>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="new_btn_programme text-center">
                                                        <span class="btn btn_next">Publiées</span>
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
                                            @endcanany
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal" id="ModalAffichage">
                    <div class="modal-dialog">
                        <div class="modal-content modal_grand">
                            <div class="container-fluid">
                                <div class="col-lg-12" id="preview_haut">
                                    <div class="container py-4 bg-light">
                                        <div class="row  bg-light justify-content-space-between py-3 px-5"
                                            id="border_premier">
                                            <div class="col-lg-6 col-md-6 new_back">
                                                <div class="detail__formation__result__item ">
                                                    <h4><span id="preview_categ"><span class="py-4 acf-categorie"
                                                                id="nom_formation"></span></span><span
                                                            style="color: black !important;">&nbsp;-&nbsp;</span>
                                                        <span></span>
                                                        <span id="preview_module"><span class="acf-nom_module"
                                                                id="nom_module"></span></span>
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
                                                    {{-- <div class="text-center" id="imgDiv"><img
                                                            src='{{asset("images/CFP/".$mod_en_cours[0]->logo)}}'
                                                            alt="logo" id="logos" class="img-fluid"
                                                            style="width: 200px; height: 100px;">
                                                    </div> --}}
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
                                                            <p class="text-uppercase" id="preview_modalite"><span
                                                                    class="acf-modalite" id="modalite2"></span></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row detail__formation__item__main">
                                                    <div class="col-lg-5 detail__prix__main__ref">
                                                        <div>
                                                            <p><i class="bx bx-clipboard"></i>&nbsp;Ref :</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-7 detail__prix__main__ref2 pt-2">
                                                        <div id="preview_reference">
                                                            <p class="acf-reference" id="reference"></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr class="hr">
                                                <div class="row detail__formation__item__main">
                                                    <div class="col-lg-6 detail__prix__main__dure">
                                                        <div>
                                                            <p><i
                                                                    class="bx bxs-alarm bx_icon"></i><span>&nbsp;Durée</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 detail__prix__main__dure2">
                                                        <div>
                                                            <p>
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
                                                    <div class="col-lg-4 detail__prix__main__prix">
                                                        <div>
                                                            <p><i class='bx bx-euro'></i>&nbsp;Prix</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 detail__prix__main__prix2">
                                                        <div>
                                                            <p id="preview_prix" class="text-end"><span class="acf-prix"
                                                                    id="prix"></span>&nbsp;AR&nbsp;HT</p>
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
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{asset('js/modules.js')}}"></script>
    @endsection