@extends('./layouts/admin')
@section('title')
<p class="text-white ms-5" style="font-size: 20px;">Votre module de formation</p>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid pb-3">
        <nav class="navbar navbar-expand-lg w-100">
            <div class="row w-100 g-0 m-0">
                <div class="col-lg-12">
                    <div class="row g-0 m-0" style="align-items: center">
                        @can('isCFP')
                        <div class="col-12 d-flex justify-content-between" style="align-items: center">
                            <div class="col">
                                <h3 class="mt-2">Modules</h3>
                            </div>
                            <div class="col search_formatiom">
                                <form action="">
                                    <div class="row w-100 form-group">
                                        <div class="input-group">
                                            <input type="text" class="form-control"
                                                placeholder="Chercher des formations...">
                                            <span class="input-group-addon success"><a href="#ici"><span
                                                        class="bx bx-search" role="button"></span></a></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col" align="right">
                                <a class="new_list_nouvelle {{ Route::currentRouteNamed('liste_formation') ? 'active' : '' }}"
                                    href="{{route('liste_formation')}}">
                                    <span><span style="font-size: 20px">
                                            << </span>&nbsp;Retour
                                        </span>
                                </a>
                            </div>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <hr>

        {{-- <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('imprime_calalogue') || Route::currentRouteNamed('imprime_calalogue') ? 'active' : '' }}"
                                    aria-current="page" href="{{route('imprime_calalogue')}}">
                                    <i class="bx bx-download"></i><span>&nbsp;PDF Catalogue</span></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('excel_catalogue') || Route::currentRouteNamed('excel_catalogue') ? 'active' : '' }}"
                                    aria-current="page" href="{{route('excel_catalogue')}}">
                                    <i class="bx bx-download"></i><span>&nbsp;Excel Catalogue</span></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div> --}}

        @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
        @endif

        <div class="m-4">
            <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
                <li class="nav-item">
                    <a href="#enCours" class="nav-link active" data-bs-toggle="tab">En cours de
                        creation&nbsp;({{count($mod_en_cours)}})</a>
                </li>
                <li class="nav-item">
                    <a href="#nonPublies" class="nav-link" data-bs-toggle="tab">Non
                        publiées&nbsp;({{count($mod_non_publies)}})</a>
                </li>
                <li class="nav-item">
                    <a href="#publies" class="nav-link" data-bs-toggle="tab">Publiées&nbsp;({{count($mod_publies)}})</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="enCours">
                    <div class="container-fluid d-flex p-0 mt-3 me-3">
                        <div class="col-2 filtre_cours ps-3">
                            <h5 class="mt-3">Filtrer les modules</h5>
                            <div class="row">
                                <form action="">
                                    <div class="form-row">
                                        <div class="searchBoxMod">
                                            <input class="searchInputMod mb-2" type="text" name=""
                                                placeholder="Rechercher">
                                            <button class="searchButtonMod" href="#">
                                                <i class="bx bx-search">
                                                </i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <p class="mt-2">En cours</p>
                            <div class="container p-0">
                                <ul class="ps-2">
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Excel</label></li>
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Power BI</label></li>
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Bureautique</label></li>
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Management</label></li>
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Comptabilite</label></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-10 ps-3">
                            <div class="row pading_bas">
                                @foreach($mod_en_cours as $mod)
                                <div class="col-6 list_module">
                                    <div class="row detail__formation__result new_card_module bg-light justify-content-space-between py-3 px-2"
                                        id="border_premier">
                                        <div class="col-lg-6 col-md-6 detail__formation__result__content">
                                            <div class="detail__formation__result__item ">
                                                <h4 class="mt-2"><span id="preview_categ"><span
                                                            class="py-4 acf-categorie">{{$mod->nom_formation}}</span></span><span
                                                        style="color: #801d68">&nbsp;-&nbsp;</span>
                                                    <span></span>
                                                    <span id="preview_module"><span
                                                            class="acf-nom_module">{{$mod->nom_module}}</span></span>
                                                </h4>
                                                <br>
                                                <p id="preview_descript"><span
                                                        class="acf-description">{{$mod->description}}</span></p>
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
                                        </div>
                                        <div class="col-lg-6 col-md-6 detail__formation__result__content text-end">
                                            <div>
                                                @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                                <button
                                                    class="btn btn-warning new_duree">{{$mod->min_pers}}&nbsp;-&nbsp;{{$mod->max_pers}}&nbsp;personne</button>
                                                @endif
                                            </div>
                                            <div>
                                                <p style="margin: 0"><span class="new_module_prix">
                                                        @php
                                                        echo number_format($mod->prix, 0, ' ', ' ');
                                                        @endphp
                                                        &nbsp;AR</span>&nbsp;HT</p><span></span>
                                                <span>par personne</span>
                                            </div>
                                            <div class="new_btn_programme">
                                                <button type="button" class="btn btn-primary"><a
                                                        href="{{route('ajout_programme',$mod->module_id)}}">Completer&nbsp;votre&nbsp;programme</a></button>
                                            </div>
                                        </div>
                                        <div
                                            class="row row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                                            <div class="col-2" style="font-size: 12px" id="preview_haut2"><i
                                                    class="bx bxs-alarm bx_icon" style="color: #801d68 !important;"></i>
                                                <span id="preview_jour" style="font-size: 12px"><span class="acf-jour">
                                                        {{$mod->duree_jour}}
                                                    </span>j</span>
                                                <span id="preview_heur">/<span class="acf-heur">
                                                        {{$mod->duree}}
                                                    </span>h</span>
                                            </div>
                                            <div class="col-4" style="font-size: 12px" id="preview_modalite"><i
                                                    class="bx bxs-devices bx_icon"
                                                    style="color: #801d68 !important;"></i>&nbsp;<span
                                                    class="acf-modalite">{{$mod->modalite_formation}}</span>
                                            </div>
                                            <div class="col-3" style="font-size: 12px" id="preview_niveau">
                                                <i class='bx bx-equalizer bx_icon'
                                                    style="color: #801d68 !important;"></i>&nbsp;<span
                                                    class="acf-niveau">{{$mod->niveau}}</span>
                                            </div>
                                            @canany(['isCFP','isAdmin','isSuperAdmin'])
                                            <div class="col-1" id="preview_niveau">
                                                <button class="btn modifier pt-0"><a
                                                        href="{{route('modifier_module',$mod->module_id)}}"><i
                                                            class='bx bx-edit background_grey'
                                                            style="color: #0052D4 !important;font-size: 15px" title="modifier les informations"></i></a></button>
                                            </div>
                                            <div class="col-1" id="preview_niveau">
                                                <button class="btn supprimer pt-0" data-toggle="modal"
                                                    data-target="#exampleModal_{{$mod->module_id}}"><i
                                                        class="bx bx-trash background_grey2"
                                                        style="color: #ff0000 !important;font-size: 15px" title="supprimer le module"></i></button>
                                            </div>
                                            <div class="col-1" id="preview_niveau">
                                                <button class="btn afficher pt-0" data-id="{{$mod->module_id}}"
                                                    data-toggle="modal" data-target="#ModalAffichage"
                                                    id="{{$mod->module_id}}"><i class='fa fa-eye background_grey3'
                                                        style="color: #3b9f0c !important;font-size: 15px"
                                                        title="afficher les informations"></i></a>

                                                </button>
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
                                                                data-dismiss="modal"> Non
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
                                </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="ModalAffichage">
                    <div class="modal-dialog">
                        <div class="modal-content modal_grand">
                            <div class="container-fluid">
                                <div class="col-lg-12" id="preview_haut">
                                    <div class="container py-4 bg-light">
                                        <div class="row detail__formation__result bg-light justify-content-space-between py-3 px-5"
                                            id="border_premier">
                                            <div class="col-lg-6 col-md-6 detail__formation__result__content new_back">
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

                                                {{-- <div class="row detail__formation__item__left">
                                                    <h3 class="pt-3 pb-3">Programme de la formation</h3>
                                                    <div></div>
                                                    <div class="col-lg-12">
                                                        <div class="row detail__formation__item__left__accordion">
                                                            <div class="accordion" id="accordion__program">
                                                                <?php //$i=1 ?>
                                                                @foreach ($programmes as $prgc)
                                                                <div class="card">
                                                                    <div class="card-header" id="heading1">
                                                                        <h2 class="mb-0"><button
                                                                                class="btn btn-block text-left"
                                                                                type="button" data-toggle="collapse"
                                                                                data-target="#collapse{{$i}}"
                                                                                aria-expanded="true" id="icon"
                                                                                aria-controls="collapse1"><i
                                                                                    class="bx bxs-plus-circle icon-prog-list"
                                                                                    id="icon"></i>&nbsp;&nbsp;{{$i}} -
                                                                                {{$prgc->titre}}</button></h2>
                                                                    </div>
                                                                    @foreach ($cours as $c)
                                                                    @if($c->programme_id == $prgc->id)
                                                                    <div id="collapse{{$i}}" class="collapse show"
                                                                        aria-labelledby="heading1"
                                                                        data-parent="#accordion__program">
                                                                        <div class="card-body"> <i
                                                                                class="bx bx-chevron-right"></i>&nbsp;{{$c->titre_cours}}
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    @endforeach
                                                                    <?php //$i++ ?>
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div> --}}
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
                                                <hr class="hr">
                                                <div class="row detail__formation__item__main">
                                                    <div class="col-lg-12 detail__prix__main__btn py-5">
                                                        <button type="button" class="btn">Demander un dévis</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary " id="fermer" data-dismiss="modal">
                                        Fermer </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="nonPublies">
                    <div class="container-fluid d-flex p-0 mt-3 me-3">
                        <div class="col-2 filtre_cours ps-3">
                            <h5 class="mt-3">Filtrer les modules</h5>
                            <div class="row">
                                <form action="">
                                    <div class="form-row">
                                        <div class="searchBoxMod">
                                            <input class="searchInputMod mb-2" type="text" name=""
                                                placeholder="Rechercher">
                                            <button class="searchButtonMod" href="#">
                                                <i class="bx bx-search">
                                                </i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <p class="mt-2">Non publiees</p>
                            <div class="container p-0">
                                <ul class="ps-2">
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Excel</label></li>
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Power BI</label></li>
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Bureautique</label></li>
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Management</label></li>
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Comptabilite</label></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-10 ps-3">
                            <div class="row pading_bas">
                                @foreach($mod_non_publies as $mod)
                                <div class="col-6 list_module">
                                    <div class="row detail__formation__result new_card_module bg-light justify-content-space-between py-3 px-2"
                                        id="border_premier">
                                        <div class="col-lg-6 col-md-6 detail__formation__result__content">
                                            <div class="detail__formation__result__item ">
                                                <h4 class="mt-2"><span id="preview_categ"><span
                                                            class="py-4 acf-categorie">{{$mod->nom_formation}}</span></span><span
                                                        style="color: #801d68">&nbsp;-&nbsp;</span>
                                                    <span></span>
                                                    <span id="preview_module"><span
                                                            class="acf-nom_module">{{$mod->nom_module}}</span></span>
                                                </h4>
                                                <br>
                                                <p id="preview_descript"><span
                                                        class="acf-description">{{$mod->description}}</span></p>
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
                                        </div>
                                        <div class="col-lg-6 col-md-6 detail__formation__result__content text-end">
                                            <div>
                                                @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                                <button
                                                    class="btn btn-warning new_duree">{{$mod->min_pers}}&nbsp;-&nbsp;{{$mod->max_pers}}&nbsp;personne</button>
                                                @endif
                                            </div>
                                            <div>
                                                <p style="margin: 0"><span class="new_module_prix">
                                                        @php
                                                        echo number_format($mod->prix, 0, ' ', ' ');
                                                        @endphp
                                                        &nbsp;AR</span>&nbsp;HT</p><span></span>
                                                <span>par personne</span>
                                            </div>
                                            <div class="new_btn_programme">
                                                <button type="button" class="btn btn-primary non_pub"
                                                    data-id="{{$mod->module_id}}" data-toggle="modal"
                                                    data-target="#ModalCompetence"
                                                    id="{{$mod->module_id}}">Compétences&nbsp;professionnelles</button>
                                            </div>
                                        </div>
                                        <div
                                            class="row row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                                            <div class="col-2" style="font-size: 12px" id="preview_haut2"><i
                                                    class="bx bxs-alarm bx_icon" style="color: #801d68 !important;"></i>
                                                <span id="preview_jour"><span class="acf-jour">
                                                        {{$mod->duree_jour}}
                                                    </span>j</span>
                                                <span id="preview_heur">/<span class="acf-heur">
                                                        {{$mod->duree}}
                                                    </span>h</span>
                                            </div>
                                            <div class="col-3" style="font-size: 12px" id="preview_modalite"><i
                                                    class="bx bxs-devices bx_icon"
                                                    style="color: #801d68 !important;"></i>&nbsp;<span
                                                    class="acf-modalite">{{$mod->modalite_formation}}</span>
                                            </div>
                                            <div class="col-3" style="font-size: 12px" id="preview_niveau">
                                                <i class='bx bx-equalizer bx_icon'
                                                    style="color: #801d68 !important;"></i>&nbsp;<span
                                                    class="acf-niveau">{{$mod->niveau}}</span>
                                            </div>
                                            @canany(['isCFP','isAdmin','isSuperAdmin'])
                                            <div class="col-1" id="preview_niveau">
                                                <button class="btn modifier pt-0"><a
                                                        href="{{route('modifier_module_prog',$mod->module_id)}}"><i
                                                            class='bx bx-edit background_grey'
                                                            style="color: #0052D4 !important;font-size: 15px" title="modifier les informations"></i></a></button>
                                            </div>
                                            <div class="col-1" id="preview_niveau">
                                                <button class="btn modifier_prog pt-0"><a
                                                        href="{{route('modif_programmes',$mod->module_id)}}"><i
                                                            class='bx bx-edit-alt background_grey4'
                                                            style="color: #801d68 !important;font-size: 15px" title="modifier les programmes"></i></a></button>
                                            </div>
                                            <div class="col-1" id="preview_niveau">
                                                <button class="btn supprimer pt-0" data-toggle="modal"
                                                    data-target="#exampleModal_{{$mod->module_id}}"><i
                                                        class="bx bx-trash background_grey2"
                                                        style="color: #ff0000 !important;font-size: 15px" title="supprimer le module"></i></button>
                                            </div>
                                            <div class="col-1" id="preview_niveau">
                                                <button class="btn afficher pt-0" data-id="{{$mod->module_id}}"
                                                    data-toggle="modal" data-target="#ModalAffichage"
                                                    id="{{$mod->module_id}}"><i class='fa fa-eye background_grey3'
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
                                                                data-dismiss="modal"> Non
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
                                                                            class="form-control label_placeholder"
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
                                                                            class="form-control label_placeholder"
                                                                            required>
                                                                        <label for="objectif"
                                                                            class="form-control-placeholder">Notes</label>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-1">
                                                                <div class="mt-3">
                                                                    <button id="addRow" class="form-control btn"
                                                                        type="button" onclick="competence();"><i
                                                                            class="bx bx-plus"
                                                                            style="font-size: 20px"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="newRow"></div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary " id="fermer"
                                                        data-dismiss="modal">
                                                        Fermer </button>
                                                    <button type="submit"
                                                        class="btn btn-primary non_pub">Enregistrer</button>
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


                <div class="tab-pane fade" id="publies">
                    <div class="container-fluid d-flex p-0 mt-3 me-3">
                        <div class="col-2 filtre_cours ps-3">
                            <h5 class="mt-3">Filtrer les modules</h5>
                            <div class="row">
                                <form action="">
                                    <div class="form-row">
                                        <div class="searchBoxMod">
                                            <input class="searchInputMod mb-2" type="text" name=""
                                                placeholder="Rechercher">
                                            <button class="searchButtonMod" href="#">
                                                <i class="bx bx-search">
                                                </i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <p class="mt-2">Publiees</p>

                            <div class="container p-0">
                                <ul class="ps-2">
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Excel</label></li>
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Power BI</label></li>
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Bureautique</label></li>
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Management</label></li>
                                    <li><input type="checkbox" id="checkboxOne" value=""><label for="checkboxOne"
                                            class="ms-2">Comptabilite</label></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-10 ps-3">
                            <div class="row pading_bas">
                                @foreach($mod_publies as $mod)
                                <div class="col-6 list_module">
                                    <div class="row detail__formation__result new_card_module bg-light justify-content-space-between py-3 px-2"
                                        id="border_premier">
                                        <div class="col-lg-6 col-md-6 detail__formation__result__content">
                                            <div class="detail__formation__result__item ">
                                                <h4 class="mt-2"><span id="preview_categ"><span
                                                            class="py-4 acf-categorie">{{$mod->nom_formation}}</span></span><span
                                                        style="color: #801d68">&nbsp;-&nbsp;</span>
                                                    <span></span>
                                                    <span id="preview_module"><span
                                                            class="acf-nom_module">{{$mod->nom_module}}</span></span>
                                                </h4>
                                                <br>
                                                <p id="preview_descript"><span
                                                        class="acf-description">{{$mod->description}}</span></p>
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
                                        </div>
                                        <div class="col-lg-6 col-md-6 detail__formation__result__content text-end">
                                            <div>
                                                @if($mod->min_pers != 0 && $mod->max_pers != 0)
                                                <button
                                                    class="btn btn-warning new_duree">{{$mod->min_pers}}&nbsp;-&nbsp;{{$mod->max_pers}}&nbsp;personne</button>
                                                @endif
                                            </div>
                                            <div>
                                                <p style="margin: 0"><span class="new_module_prix">
                                                        @php
                                                        echo number_format($mod->prix, 0, ' ', ' ');
                                                        @endphp
                                                        &nbsp;AR</span>&nbsp;HT</p><span></span>
                                                <span>par personne</span>
                                            </div>
                                            <div class="new_btn_programme">
                                                <button type="button" class="btn btn-primary publiees"
                                                    style="font-weight: bolder">Publié</button>
                                            </div>
                                        </div>
                                        <div
                                            class="row row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                                            <div class="col-2" style="font-size: 14px" id="preview_haut2"><i
                                                    class="bx bxs-alarm bx_icon" style="color: #801d68 !important;"></i>
                                                <span id="preview_jour"><span class="acf-jour">
                                                        {{$mod->duree_jour}}
                                                    </span>j</span>
                                                <span id="preview_heur">/<span class="acf-heur">
                                                        {{$mod->duree}}
                                                    </span>h</span>
                                            </div>
                                            <div class="col-4" style="font-size: 14px" id="preview_modalite"><i
                                                    class="bx bxs-devices bx_icon"
                                                    style="color: #801d68 !important;"></i>&nbsp;<span
                                                    class="acf-modalite">{{$mod->modalite_formation}}</span>
                                            </div>
                                            <div class="col-3" style="font-size: 14px" id="preview_niveau">
                                                <i class='bx bx-equalizer bx_icon'
                                                    style="color: #801d68 !important;"></i>&nbsp;<span
                                                    class="acf-niveau">{{$mod->niveau}}</span>
                                            </div>
                                            @canany(['isCFP','isAdmin','isSuperAdmin'])
                                            <div class="col-1" id="preview_niveau">
                                                <button class="btn modifier"><a
                                                        href="{{route('modifier_module_pub',$mod->module_id)}}"><i
                                                            class='bx bx-edit'
                                                            style="color: #0052D4 !important;font-size: 20px"></i></a></button>
                                            </div>
                                            <div class="col-1" id="preview_niveau">
                                                <button class="btn supprimer" data-toggle="modal"
                                                    data-target="#exampleModal_{{$mod->module_id}}"><i
                                                        class="bx bx-trash"
                                                        style="color: #ff0000 !important;font-size: 20px"></i></button>
                                            </div>
                                            <div class="col-1" id="preview_niveau">
                                                <button class="btn afficher " data-id="{{$mod->module_id}}"
                                                    data-toggle="modal" data-target="#ModalAffichage"
                                                    id="{{$mod->module_id}}"><i class='fa fa-eye'
                                                        style="color: #799F0C !important;font-size: 20px"
                                                        title="Afficher"></i></button>
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
                                                                data-dismiss="modal"> Non
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
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script type="text/javascript">
        //separateur de milliers javascript
    function numStr(a, b) {
        a = '' + a;
        b = b || ' ';
        let c = ''
            , d = 0;
        while (a.match(/^0[0-9]/)) {
            a = a.substr(1);
        }
        for (let i = a.length - 1; i >= 0; i--) {
            c = (d != 0 && d % 3 == 0) ? a[i] + b + c : a[i] + c;
            d++;
        }
        return c;
    }
    $(".afficher").on('click', function(e) {
        let id = $(this).data("id");
        $.ajax({
            method: "GET"
            , url: "{{route('afficher_module')}}"
            , data: {
                Id: id
            }
            , dataType: "html"
            , success: function(response) {
                let userData = JSON.parse(response);
                //parcourir le premier tableau contenant les info sur les programmes
                for (let $i = 0; $i < userData.length; $i++) {
                    $("#reference").text(userData[$i].reference);
                    $("#nom_module").text(userData[$i].nom_module);
                    $("#prix").text(numStr(userData[$i].prix, ' '));
                    $("#heure").text(userData[$i].duree);
                    $("#heure2").text(userData[$i].duree);
                    $("#jour").text(userData[$i].duree_jour);
                    $("#jour2").text(userData[$i].duree_jour);
                    $("#objectif").text(userData[$i].objectif);
                    $("#prerequis").text(userData[$i].prerequis);
                    $("#modalite").text(userData[$i].modalite_formation);
                    $("#modalite2").text(userData[$i].modalite_formation);
                    $("#description").text(userData[$i].description);
                    $("#materiel").text(userData[$i].materiel_necessaire);
                    $("#bon_a_savoir").text(userData[$i].bon_a_savoir);
                    $("#cible").text(userData[$i].cible);
                    $("#prestation").text(userData[$i].prestation);
                    $("#nom_formation").text(userData[$i].nom_formation);
                    $("#niveau").text(userData[$i].niveau);
                }
                // var ul = document.getElementById('programme');

                // // $("#programe").append('<li>ok</li>');
                // for (var $j = 0; $j < userData[0].length; $j++) {

                //     var li = document.createElement('li');
                //     li.appendChild(document.createTextNode(userData[0][$j].titre));
                //     ul.appendChild(li);
                //     //     li = null;
                // }

                //parcourir le deuxième tableau contenant les info sur le nom de la formation
                // $("#nomFormation").text(userData[1]);

            }
            , error: function(error) {
                console.log(error)
            }
        });
    });
    $('#fermer', '.close').on('change', function(e) {
        let ul = document.getElementById('programme');
        ul.innerHTML = '';

    });

    // $('body').on('click', function(e) {
    //     var ul = document.getElementById('programme');
    //     ul.innerHTML = '';
    // });

    // $(".modifier").on('click', function(e) {
    //     let id = $(this).data("id");
    //     $.ajax({
    //         method: "GET"
    //         , url: "{{route('edit_module')}}"
    //         , data: {
    //             Id: id
    //         }
    //         , dataType: "html"
    //         , success: function(response) {

    //             let userData = JSON.parse(response);
    //             for (let $i = 0; $i < userData.length; $i++) {
    //                 $("#nomModif").val(userData[$i].nom_module);
    //                 $("#prixModif").val(userData[$i].prix);
    //                 $("#dureeModif").val(userData[$i].duree);
    //                 $("#dureeJourModif").val(userData[$i].duree_jour);
    //                 $('#id_value').val(userData[$i].id);

    //                 $('#modalite').val(userData[$i].modalite_formation).change();

    //             }
    //         }
    //         , error: function(error) {
    //             console.log(error)
    //         }
    //     });
    // });
    $(".suppression").on('click', function(e) {
        let id = e.target.id;
        $.ajax({
            type: "GET"
            , url: "{{route('destroy_module')}}"
            , data: {
                Id: id
            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error")
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    </script>

    <script type="text/javascript">
        // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $("#reference_search").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "{{route('searchReference')}}"
                    , type: 'get'
                    , dataType: "json"
                    , data: {
                        //    _token: CSRF_TOKEN,
                        search: request.term
                    }
                    , success: function(data) {
                        // alert("eto");
                        response(data);
                    }
                    , error: function(data) {
                        alert("error");
                        //alert(JSON.stringify(data));
                    }
                });
            }
            , select: function(event, ui) {
                // Set selection
                $('#reference_search').val(ui.item.label); // display the selected text
                $('#stagiaireid').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });
    </script>
    <script type="text/javascript">
        // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $("#categorie_search").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "{{route('searchCategorie')}}"
                    , type: 'get'
                    , dataType: "json"
                    , data: {
                        //    _token: CSRF_TOKEN,
                        recheche: request.term
                    }
                    , success: function(data) {
                        // alert("eto");
                        response(data);
                    }
                    , error: function(data) {
                        alert("error");
                        //alert(JSON.stringify(data));
                    }
                });
            }
            , select: function(event, ui) {
                // Set selection
                $('#categorie_search').val(ui.item.label); // display the selected text
                $('#stagiaireid').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });

    $(document).ready(function(){
        $("#myTab a:last").tab("show"); // show last tab
    });

    function resetForm() {
        document.getElementById("frm_modif_module").reset();
    }

    function competence() {
        var html = '';
        html += '<div class="d-flex" id="row_new">';
        html +=     '<div class="col-7">';
        html +=         '<div class="form-group">';
        html +=             '<div class="form-row">';
        html +=                 '<input type="text" name="titre_competence[]" id="titre_competence" class="form-control label_placeholder" required>';
        html +=                 '<label for="titre_competence" class="form-control-placeholder">Compétences';
        html +=                 '</label>';
        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';

        html +=     '<div class="col-4">';
        html +=         '<div class="form-group ms-1">';
        html +=             '<div class="form-row">';
        html +=                 '<input type="number" name="objectif[]" id="objectif" min="1" max="10" class="form-control label_placeholder" required>';
        html +=                 '<label for="objectif" class="form-control-placeholder">Notes';
        html +=                 '</label>';
        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';

        html +=     '<div class="col-1">';
        html +=         '<div class="mt-3">';
        html +=             '<div class="form-row">';
        html +=                 '<button id="removeRow" class="form-control btn" type="button">';
        html +=                     '<i class="bx bx-minus" style="font-size: 20px">';
        html +=                     '</i>';
        html +=                 '</button>';
        html +=             '</div>';
        html +=         '</div>';
        html +=     '</div>';
        html += '</div>';

        $('#newRow').append(html);
    }

    // remove row
    $(document).on('click', '#removeRow', function() {
        $(this).closest('#row_new').remove();
    });



    </script>
    @endsection