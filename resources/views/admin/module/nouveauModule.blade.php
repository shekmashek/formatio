@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg w-100">
            <div class="row w-100 g-0 m-0">
                <div class="col-lg-12">
                    <div class="row g-0 m-0" style="align-items: center">
                        @can('isCFP')
                        <div class="col-12 d-flex justify-content-between" style="align-items: center">
                            <div class="col">
                                <h3 class="mt-2">Nouvelle Moudule</h3>
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
                            <div class="col text-right">
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
        <div class="panel-body">
            <div class="row">
                <form action="{{route('module.store')}}" method="POST">
                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4 pe-5" style="align-items: center">
                                <div class="form-row ">
                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-nom_module is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control module module"
                                                        id="acf-nom_module" name="acf[nom_module]"
                                                        placeholder="Nom du module" required>
                                                    @error('acf[nom_module]')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-categorie is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <select class="form-control select_formulaire categ categ"
                                                        id="acf-categorie" name="acf[categorie]" style="height: 50px;">
                                                        <option value="null" disable selected hidden>Choisissez la
                                                            catégorie de formation ...</option>
                                                        @foreach($liste as $li)
                                                        <option value="{{$li->id}}" data-value="{{$li->nom_formation}}">
                                                            {{$li->nom_formation}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-description is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control descript descript"
                                                        id="acf-description" name="acf[description]"
                                                        placeholder="Déscription" required>
                                                    @error('acf[description]')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-jour is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control jour jour" id="acf-jour"
                                                        name="acf[jour]" min="1" max="365"
                                                        placeholder="Durée en Jours (J)" onfocus="(this.type='number')"
                                                        title="entrer une durée en jours" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-heur is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control heur heur" id="acf-heur"
                                                        name="acf[heur]" min="1" max="8760"
                                                        placeholder="Durée en Heure (H)" onfocus="(this.type='number')"
                                                        title="entrer une durée en heure" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-modalite is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <select class="form-control select_formulaire modalite modalite"
                                                        id="acf-modalite" name="acf[modalite]" style="height: 50px;">
                                                        <option value="null" disable selected hidden>Choisissez la
                                                            modalite de formation ...</option>
                                                        <option value="En ligne">En ligne</option>
                                                        <option value="Présentiel">Présentiel</option>
                                                        <option value="En ligne/Présentiel">En ligne/Présentiel</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-niveau is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <select class="form-control select_formulaire niveau niveau"
                                                        id="acf-niveau" name="acf[niveau]" style="height: 50px;">
                                                        <option value="null" disable selected hidden>Choisissez le
                                                            niveau de formation...</option>
                                                        @foreach($niveau as $nv)
                                                        <option value="{{$nv->id}}" data-value="{{$nv->niveau}}">
                                                            {{$nv->niveau}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <Span> Ajouter un nouveau Niveau de formation : &nbsp;</Span><i
                                        class="bx bxs-edit close" onclick="myFunction()"></i>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-objectif is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <textarea class="form-control objectif objectif" id="acf-objectif"
                                                        name="acf[objectif]" placeholder="Objectifs" rows=3
                                                        required></textarea>
                                                    @error('acf[objectif]')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-cible is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <textarea class="form-control cible cible" id="acf-cible"
                                                        name="acf[cible]" placeholder="Public cible" rows=3
                                                        required></textarea>
                                                    @error('acf[cible]')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-prerequis is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <textarea class="form-control prerequis prerequis"
                                                        id="acf-prerequis" name="acf[prerequis]" placeholder="Prerequis"
                                                        rows=3 required></textarea>
                                                    @error('acf[prerequis]')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-reference is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control reference reference"
                                                        id="acf-reference" name="acf[reference]" placeholder="Reference"
                                                        required>
                                                    @error('acf[reference]')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-prix is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control prix prix" id="acf-prix"
                                                        name="acf[prix]" minlength="1" maxlength="7"
                                                        pattern="[0-9]{1,7}" placeholder="Prix en AR" required>
                                                    @error('acf[prix]')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-materiel is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control materiel materiel"
                                                        id="acf-materiel" name="acf[materiel]"
                                                        placeholder="Equipement necessaire" required>
                                                    @error('acf[materiel]')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-bon_a_savoir is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <textarea class="form-control bon_a_savoir bon_a_savoir"
                                                        id="acf-bon_a_savoir" name="acf[bon_a_savoir]"
                                                        placeholder="Bon a savoir" rows=3 required></textarea>
                                                    @error('acf[bon_a_savoir]')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="acf-field acf-field-text acf-field-prestation is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <textarea class="form-control prestation prestation"
                                                        id="acf-prestation" name="acf[prestation]"
                                                        placeholder="Prestations pedagogiques" rows=3
                                                        required></textarea>
                                                    @error('acf[prestation]')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-5" align="center">
                                        <button type="submit" class="btn btn-secondary w-100"><i
                                                class="bx bxs-plus-circle"></i> Ajouter</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 live_preview">
                                <div class="container py-4 bg-light">
                                    <div
                                        class="row detail__formation__result bg-light justify-content-space-between py-3 px-5">
                                        <div class="col-lg-6 col-md-6 detail__formation__result__content">
                                            <div class="detail__formation__result__item ">
                                                <h4><span id="preview_categ"><span class="py-4 acf-categorie">Ms
                                                            Excel</span></span>&nbsp;-&nbsp;<span></span>
                                                    <span id="preview_module"><span class="acf-nom_module">Excel
                                                            avancee</span></span>
                                                </h4>
                                                <p id="preview_descript"><span class="acf-description">Optimiser et
                                                        automatiser vos tableaux sans programmer</span></p>
                                                <div class="detail__formation__result__avis">
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
                                                <a href="#">
                                                    <h6 class="py-4 text-center">Formation Proposée
                                                        par&nbsp;<span>Numerika Center</span></h6>
                                                </a>
                                                <div class="text-center"><img
                                                        src="{{asset('images/CFP/Votre-logo-1.png')}}" alt="logo"
                                                        class="img-fluid" style="width: 200px; height:100px;"></div>
                                            </div>
                                        </div>
                                        <div
                                            class="row row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                                            <div class="col"><i class="bx bxs-alarm bx_icon"></i>
                                                <span id="preview_jour"><span class="acf-jour">
                                                        4
                                                    </span>j</span>
                                                <span id="preview_heur">/<span class="acf-heur">
                                                        28
                                                    </span>h</span>
                                            </div>
                                            <div class="col" id="preview_modalite"><i
                                                    class="bx bxs-devices bx_icon"></i>&nbsp;<span
                                                    class="acf-modalite">Presentiel et a
                                                    distance</span>
                                            </div>
                                            <div class="col" id="preview_niveau">
                                                <i class='bx bx-equalizer bx_icon'></i>&nbsp;<span
                                                    class="acf-niveau">Debutant</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row detail__formation__detail justify-content-space-between py-5 px-5">
                                        <div class="col-lg-8 detail__formation__content">

                                            <div class="row detail__formation__item__left__objectif">
                                                <div class="col-lg-12" id="preview_objectif">
                                                    <h5 class="pb-3">Objectifs</h5>
                                                    <p><span>>&nbsp;</span><span class="acf-objectif"> Suite logique de
                                                            la formation "Excel - Intermédiaire", cette
                                                            formation vous permet, au travers d'études de cas et
                                                            d'exemples
                                                            très concrets</span></p>
                                                </div>
                                            </div>

                                            <h5 class="pt-3 pb-3">Public concerne</h5>
                                            <div class="row detail__formation__item__left__adresse">
                                                <div class="col-lg-6 d-flex flex-row">
                                                    <div class="row d-flex flex-row">
                                                        <span class="adresse__text"><i
                                                                class="bx bx-user py-2 pb-3 adresse__icon"></i>&nbsp;Pour
                                                            qui ?</span>
                                                        <div class="col-12" id="preview_cible">
                                                            <p><span>>&nbsp;</span><span class="acf-cible">Contrôleur de
                                                                    gestion, financier, RH, toute personne
                                                                    ayant à exploiter des résultats chiffrés dans Excel
                                                                    (version 2013 et suivantes).</span></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="row d-flex flex-row">
                                                        <span class="adresse__text"><i
                                                                class="bx bx-list-plus py-2 pb-3 adresse__icon"></i>&nbsp;Prérequis</span>

                                                        <div class="col-12" id="preview_prerequis">
                                                            <p><span>>&nbsp;</span><span class="acf-prerequis"> Avoir
                                                                    suivi la formation "Excel - Intermédiaire" (réf.
                                                                    7233) ou avoir un niveau de connaissances
                                                                    équivalent.</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row detail__formation__item__left__adresse">
                                                <div class="col-lg-6 d-flex flex-row">
                                                    <div class="row d-flex flex-row">
                                                        <span class="adresse__text"><i
                                                                class="bx bxs-cog py-2 pb-3 adresse__icon"></i>&nbsp;Equipement
                                                            necessaire</span>
                                                        <div class="col-12" id="preview_materiel">
                                                            <p><span>>&nbsp;</span><span
                                                                    class="acf-materiel">ordinateur</span> </p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-6">
                                                    <div class="row d-flex flex-row">
                                                        <span class="adresse__text"><i
                                                                class="bx bxs-message-check py-2 pb-3 adresse__icon"></i>&nbsp;Bon
                                                            a savoir</span>

                                                        <div class="col-12" id="preview_bon_a_savoir">
                                                            <p><span>>&nbsp;</span><span class="acf-bon_a_savoir">Nous
                                                                    vous conseillons de prevoire des plages horaires de
                                                                    travail fixes afin de garder le rythme. </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row detail__formation__item__left__adresse">
                                                <div class="col-lg-12 d-flex flex-row">
                                                    <div class="row d-flex flex-row">
                                                        <span class="adresse__text"><i
                                                                class="bx bxs-cog py-2 pb-3 adresse__icon"></i>&nbsp;Prestations
                                                            pedagogiques</span>
                                                        <div class="col-12" id="preview_prestation">
                                                            <p><span>>&nbsp;</span><span class="acf-prestation">Package
                                                                    pedagogique special 40 ans, repas du midi et
                                                                    pauses-cafe offerts les jours de formation</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-4 detail__formation__item__right">
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
                                                                class="acf-modalite">Presentiel et a
                                                                distance</span></p>
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
                                                        <p class="acf-reference">10MG2022-01</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="hr">
                                            <div class="row detail__formation__item__main">
                                                <div class="col-lg-6 detail__prix__main__dure">
                                                    <div>
                                                        <p><i class="bx bxs-alarm bx_icon"></i><span>&nbsp;Durée</span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 detail__prix__main__dure2">
                                                    <div>
                                                        <p>
                                                            <span id="preview_jour"><span class="acf-jour">
                                                                    4
                                                                </span>j</span>
                                                            <span id="preview_heur">/<span class="acf-heur">
                                                                    28
                                                                </span>h</span>
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
                                                        <p id="preview_prix"><span
                                                                class="acf-prix">450000</span>&nbsp;AR&nbsp;HT</p>
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
                        </div>
                    </div>
                </form>

                <div class="modal" tabindex="-1" role="dialog" id="ouvrir_flottant">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Changer le niveau</h5>
                            </div>
                            <div class="modal-body">
                                <div class="col-lg-12">
                                    <div id="myDIV" class="card" style="display: none;">
                                        <table class="table">
                                            <thead align="center">
                                                <th>Niveau</th>
                                                <th>Supprimer</th>
                                            </thead>
                                            <tbody>
                                                @foreach($niveau as $nv)
                                                <tr>
                                                    <td>{{$nv->niveau}}</td>
                                                    <td align="center"><a
                                                            href="{{route('supprimer_niveau',$nv->id)}}"><i
                                                                class="bx bxs-trash"></i></a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="d-flex justify-content-end mx-5 pb-3">
                                            <button type="button" class="btn btn-secondary"
                                                onclick="myFunction()">Retour</button>&nbsp;
                                            <button class="btn btn-primary" onclick="myFunction1()">Ajouter
                                                un niveau</button>
                                        </div>
                                        <div id="mydiv" style="display: none;">
                                            <form action="{{route('enregistrer_niveau')}}" method="POST">
                                                @csrf
                                                <table class="table">
                                                    <thead>
                                                        <th>Nouvelle niveau : </th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="text" class="form-control" name="niveau"
                                                                    placeholder="niveau" required>
                                                            </td>
                                                            <td align="center" class="p-2">
                                                                <button type="submit"
                                                                    class="btn btn-primary mt-3">Enregistrer</button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(".module").keyup(function() {
        var $this = $(this);
        $('.' + $this.attr("id") + '').html($this.val());
    });

    $(".descript").keyup(function() {
        var $this = $(this);
        $('.' + $this.attr("id") + '').html($this.val());
    });

    $(".categ").change(function() {
        var $this = $(this);
        var value2 = $('select.categ option[value="' + $(this).val() + '"]').data('value');
        $('.' + $this.attr("id") + '').html(value2);
    });

    $(".jour").change(function() {
        var $this = $(this);
        $('.' + $this.attr("id") + '').html($this.val());
    });

    $(".heur").change(function() {
        var $this = $(this);
        $('.' + $this.attr("id") + '').html($this.val());
    });

    $(".modalite").change(function() {
        var $this = $(this);
        $('.' + $this.attr("id") + '').html($this.val());
    });

    $(".niveau").change(function() {
        var $this = $(this);
        var valueniveau = $('select.niveau option[value="' + $(this).val() + '"]').data('value');
        $('.' + $this.attr("id") + '').html(valueniveau);
    });

    $(".objectif").keyup(function() {
        var $this = $(this);
        $('.' + $this.attr("id") + '').html($this.val());
    });

    $(".cible").keyup(function() {
        var $this = $(this);
        $('.' + $this.attr("id") + '').html($this.val());
    });

    $(".prerequis").keyup(function() {
        var $this = $(this);
        $('.' + $this.attr("id") + '').html($this.val());
    });

    $(".reference").keyup(function() {
        var $this = $(this);
        $('.' + $this.attr("id") + '').html($this.val());
    });

    $(".prix").keyup(function() {
        var $this = $(this);
        $('.' + $this.attr("id") + '').html($this.val());
    });

    $(".materiel").keyup(function() {
        var $this = $(this);
        $('.' + $this.attr("id") + '').html($this.val());
    });

    $(".bon_a_savoir").keyup(function() {
        var $this = $(this);
        $('.' + $this.attr("id") + '').html($this.val());
    });

    $(".prestation").keyup(function() {
        var $this = $(this);
        $('.' + $this.attr("id") + '').html($this.val());
    });

function myFunction() {
        var x = document.getElementById("myDIV");
        if (x.style.display === "none") {
            x.style.display = "block";
            $('#ouvrir_flottant').modal('show');
        } else {
            x.style.display = "none";
            $('#ouvrir_flottant').modal('hide');
        }
    }

    function myFunction1() {
        var x = document.getElementById("mydiv");
        if (x.style.display === "none") {
            x.style.display = "block";
            $('#ouvrir_flottant').modal('show');
        } else {
            x.style.display = "none";
            $('#ouvrir_flottant').modal('hide');
        }
    }

</script>
@endsection