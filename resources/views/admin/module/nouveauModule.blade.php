@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

<div id="page-wrapper">
    <div class="container-fluid bg-light">
        <nav class="navbar navbar-expand-lg w-100">
            <div class="row w-100 g-0 m-0">
                <div class="col-lg-12">
                    <div class="row g-0 m-0" style="align-items: center">
                        @can('isCFP')
                        <div class="col-12 d-flex justify-content-between" style="align-items: center">
                            <div class="col titre_page">
                                <h3 class="mt-3">Nouvelle Module</h3>
                            </div>

                            <div class="col" align="right">
                                <a class="mb-2 new_list_nouvelle {{ Route::currentRouteNamed('liste_formation') ? 'active' : '' }}" href="{{route('liste_module')}}">
                                    <span class="btn_enregistrer text-center">Précedent</span>
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
                <form action="{{route('module.store')}}" method="POST" id="frm_new_module">
                    @csrf
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-1 postion_fixe">
                                <div class="row">
                                    <div class="col text-left ps-0 me-3">
                                        <p id="changer_module" onclick="changer_module();" role="button" class="text-center btn_change_form py-2 mb-1"><a href="#preview_haut"><i class='bx bxs-cube-alt' style="color: #7635dc; font-size:2rem"></i><br><span>Module</span></a>
                                        </p>
                                        <p id="changer_objectif" onclick="changer_objectif();" role="button" class="text-center btn_change_form py-2 mb-1"><a href="#preview_haut2"><i class='bx bx-radio-circle-marked' style="color: #7635dc; font-size:2rem"></i><br><span>Objectif</span></a>
                                        </p>
                                        <p id="changer_cible" onclick="changer_cible();" role="button" class="text-center btn_change_form py-2 mb-1"><a href="#preview_objectif"><i class='bx bx-user' style="color: #7635dc; font-size:2rem"></i><br><span>Cible</span></a>
                                        </p>
                                        <p id="changer_reference" onclick="changer_reference();" role="button" class="text-center btn_change_form py-2 mb-1"><a href="#preview_reference"><i class='bx bx-clipboard' style="color: #7635dc; font-size:2rem"></i><br><span>Reference</span></a>
                                        </p>
                                        <p id="changer_equipement" onclick="changer_equipement();" role="button" class="text-center btn_change_form py-2 mb-1"><a href="#preview_equipement"><i class='bx bxs-cog' style="color: #7635dc; font-size:2rem"></i><br><span>Equipement</span></a>
                                        </p>
                                        <p id="changer_prestation" onclick="changer_prestation();" role="button" class="text-center btn_change_form py-2 mb-1"><a href="#preview_prestation"><i class='bx bx-hive' style="color: #7635dc; font-size:2rem"></i><br><span>Préstation</span></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 pe-5 postion_fixe_form" style="align-items: center">
                                <div class="form-row">
                                    <div class="form-group" id="premier_vue">
                                        <div class="acf-field acf-field-text acf-field-nom_module is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    {{-- test input top --}}
                                                    {{-- <div class="row px-3 mt-4">
                                                        <div class="form-group mt-1 mb-1"> <input type="text" id="email" class="form-control test" required> <label class="ml-3 form-control-placeholder" for="email">Email</label> </div>
                                                    </div> --}}
                                                    <input type="text" class="form-control module module input" id="acf-nom_module" name="nom_module" required>
                                                    <label for="acf-nom_module" class="form-control-placeholder">Nom du module</label>
                                                    @error('nom_module')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="premier_vue9">
                                        <div class="acf-field acf-field-text acf-field-categorie is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <select class="form-control select_formulaire input" id="acf-domaine" name="domaine" style="height: 50px;">
                                                        <option value="null" disable selected hidden>Choisissez la
                                                            domaine de formation ...</option>
                                                        @foreach($domaine as $do)
                                                        <option value="{{$do->id}}" data-value="{{$do->nom_domaine}}">
                                                            {{$do->nom_domaine}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="acf-domaine" class="form-control-placeholder">Domaine de Formation</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="premier_vue2">
                                        <div class="acf-field acf-field-text acf-field-categorie is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <select class="form-control select_formulaire categ categ input" id="acf-categorie" name="categorie" style="height: 50px;">
                                                        {{-- <option value="null" disable selected hidden>Choisissez la
                                                            catégorie de formation ...</option>
                                                        @foreach($liste as $li)
                                                        <option value="{{$li->id}}" data-value="{{$li->nom_formation}}">
                                                        {{$li->nom_formation}}</option>
                                                        @endforeach --}}
                                                    </select>
                                                    <label for="acf-categorie" class="form-control-placeholder">Thématique par Domaine</label>
                                                    <span style="" id="domaine_id_err">choisir le type de domaine valide pour avoir ses formations</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="premier_vue3">
                                        <div class="acf-field acf-field-text acf-field-description is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap mt-2">
                                                    <input type="text" class="form-control descript descript input" id="acf-description" name="description" required>
                                                    <label for="acf-nom_module" class="form-control-placeholder">Déscription</label>
                                                    @error('description')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-row d-flex">
                                        <div class="col me-1">
                                            <div class="form-group" id="premier_vue4">
                                                <div class="acf-field acf-field-text acf-field-jour is-required">
                                                    <div class="acf-input">
                                                        <div class="acf-input-wrap">
                                                            <input type="text" class="form-control jour jour input" id="acf-jour" name="jour" min="1" max="365" onfocus="(this.type='number')" title="entrer une durée en jours" required>
                                                            <label for="acf-nom_module" class="form-control-placeholder">Durée en Jours (J)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group" id="premier_vue5">
                                                <div class="acf-field acf-field-text acf-field-heur is-required">
                                                    <div class="acf-input">
                                                        <div class="acf-input-wrap">
                                                            <input type="text" class="form-control heur heur input" id="acf-heur" name="heure" min="1" max="8760" onfocus="(this.type='number')" title="entrer une durée en heure" required>
                                                            <label for="acf-nom_module" class="form-control-placeholder">Durée en Heure (H)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group" id="premier_vue6">
                                        <div class="acf-field acf-field-text acf-field-modalite is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <select class="form-control select_formulaire modalite modalite input" id="acf-modalite" name="modalite" style="height: 50px;">
                                                        <option value="null" disable selected hidden>Choisissez la
                                                            modalite de formation ...</option>
                                                        <option value="En ligne">En ligne</option>
                                                        <option value="Présentiel">Présentiel</option>
                                                        <option value="En ligne/Présentiel">En ligne/Présentiel</option>
                                                    </select>
                                                    <label for="acf-nom_module" class="form-control-placeholder">Modalité de Formation</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group" id="premier_vue7">
                                        <div class="acf-field acf-field-text acf-field-niveau is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <select class="form-control select_formulaire niveau niveau input" id="acf-niveau" name="niveau" style="height: 50px;">
                                                        <option value="null" disable selected hidden>Choisissez le
                                                            niveau de formation...</option>
                                                        @foreach($niveau as $nv)
                                                        <option value="{{$nv->id}}" data-value="{{$nv->niveau}}">
                                                            {{$nv->niveau}}</option>
                                                        @endforeach
                                                    </select>
                                                    <label for="acf-nom_module" class="form-control-placeholder">Niveau de Formation</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <span id="premier_vue8"> Ajouter un nouveau Niveau de formation : &nbsp;<i class="bx bxs-edit close" onclick="myFunction()"></i>
                                        <br>
                                        <p class="text-center mt-3"><a href="#preview_haut2" class="new_list_nouvelle btn_next" onclick="suivant_objectif();" role="button">Suivant</a></p>
                                    </span>



                                    <div class="form-group apres_preview" id="second_vue">
                                        <div class="acf-field acf-field-text acf-field-objectif is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <textarea class="form-control objectif objectif text_area" id="acf-objectif" name="objectif" required></textarea>
                                                    <label for="acf-nom_module" class="form-control-placeholder-text_area">Objectif du Module</label>
                                                    @error('objectif')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="d-flex justify-content-between">
                                            <p class="text-center mt-3" style="font-size: 16px"><button type="button" class="new_list_nouvelle px-5 btn_previous" onclick="retour_module();"><a href="#preview_haut">Retour</a></button></p>
                                            <p class="text-center mt-3" style="font-size: 16px"><button type="button" class="new_list_nouvelle px-5 btn_next" onclick="suivant_cible();"><a href="#preview_objectif">Suivant</a></button></p>
                                        </div>
                                    </div>

                                    <div class="form-group apres_preview" id="troisiem_vue">
                                        <div class="acf-field acf-field-text acf-field-cible is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <textarea class="form-control cible cible text_area" id="acf-cible" name="cible" required></textarea>
                                                    <label for="acf-nom_module" class="form-control-placeholder-text_area">Public Cible</label>
                                                    @error('cible')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group apres_preview" id="troisiem_vue2">
                                        <div class="acf-field acf-field-text acf-field-prerequis is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <textarea class="form-control prerequis prerequis text_area" id="acf-prerequis" name="prerequis" required></textarea>
                                                    <label for="acf-nom_module" class="form-control-placeholder-text_area">Prérequis</label>
                                                    @error('prerequis')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="d-flex justify-content-between">
                                            <p class="text-center mt-3" style="font-size: 16px"><button type="button" class="new_list_nouvelle px-5 btn_previous" onclick="retour_objectif();"><a href="#preview_haut2">Retour</a></button></p>
                                            <p class="text-center mt-3" style="font-size: 16px"><button type="button" class="new_list_nouvelle px-5 btn_next" onclick="suivant_reference();"><a href="#preview_reference">Suivant</a></button></p>
                                        </div>
                                    </div>

                                    <div class="form-group apres_preview" id="quatriem_vue">
                                        <div class="acf-field acf-field-text acf-field-reference is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control reference reference input" id="acf-reference" name="reference" required>
                                                    <label for="acf-nom_module" class="form-control-placeholder">Reference</label>
                                                    @error('reference')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group apres_preview" id="quatriem_vue2">
                                        <div class="acf-field acf-field-text acf-field-prix is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control prix prix input" id="acf-prix" name="prix" minlength="1" maxlength="7" pattern="[0-9]{1,7}" required>
                                                    <label for="acf-nom_module" class="form-control-placeholder">Prix en AR</label>
                                                    @error('prix')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="d-flex justify-content-between">
                                            <p class="text-center mt-3" style="font-size: 16px"><button type="button" class="new_list_nouvelle px-5 btn_previous" onclick="retour_cible();"><a href="#preview_objectif">Retour</a></button></p>
                                            <p class="text-center mt-3" style="font-size: 16px"><button type="button" class="new_list_nouvelle px-5 btn_next" onclick="suivant_equipement();"><a href="#changer_equipement">Suivant</a></button></p>
                                        </div>
                                    </div>

                                    <div class="form-group apres_preview" id="cinquiem_vue">
                                        <div class="acf-field acf-field-text acf-field-materiel is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <input type="text" class="form-control materiel materiel input" id="acf-materiel" name="materiel" required>
                                                    <label for="acf-nom_module" class="form-control-placeholder">Equipement necessaire</label>
                                                    @error('materiel')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group apres_preview" id="cinquiem_vue2">
                                        <div class="acf-field acf-field-text acf-field-bon_a_savoir is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <textarea class="form-control bon_a_savoir bon_a_savoir text_area" id="acf-bon_a_savoir" name="bon_a_savoir" required></textarea>
                                                    <label for="acf-nom_module" class="form-control-placeholder-text_area">Bon a savoir</label>
                                                    @error('bon_a_savoir')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="d-flex justify-content-between">
                                            <p class="text-center mt-3" style="font-size: 16px"><button type="button" class="new_list_nouvelle px-5 btn_previous" onclick="retour_reference();"><a href="#changer_reference">Retour</a></button></p>
                                            <p class="text-center mt-3" style="font-size: 16px"><button type="button" class="new_list_nouvelle px-5 btn_next" onclick="suivant_prestation();"><a href="#changer_prestation">Suivant</a></button></p>
                                        </div>
                                    </div>

                                    <div class="form-group apres_preview" id="sixieme_vue">
                                        <div class="acf-field acf-field-text acf-field-prestation is-required">
                                            <div class="acf-input">
                                                <div class="acf-input-wrap">
                                                    <textarea class="form-control prestation prestation text_area" id="acf-prestation" name="prestation" onkeyup='estComplet();' required></textarea>
                                                    <label for="acf-nom_module" class="form-control-placeholder-text_area">Prestations pedagogiques</label>
                                                    @error('prestation')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group mb-5 apres_preview" id="sixieme_vue2">

                                        <div class="form-row d-flex">
                                            <div class="col me-1">
                                                <div class="form-group" id="premier_">
                                                    <div class="acf-field acf-field-text acf-field-min is-required">
                                                        <div class="acf-input">
                                                            <div class="acf-input-wrap">
                                                                <input type="text" class="form-control min min input" id="acf-min" name="min_pers" min="1" max="100" onfocus="(this.type='number')" title="entrer le nombre de personne minimale" required>
                                                                <label for="acf-nom_module" class="form-control-placeholder">Nombre personne min</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group" id="premier_">
                                                    <div class="acf-field acf-field-text acf-field-max is-required">
                                                        <div class="acf-input">
                                                            <div class="acf-input-wrap">
                                                                <input type="text" class="form-control max max input" id="acf-max" name="max_pers" min="1" max="100" onfocus="(this.type='number')" title="entrer le nombre de personne maximale" required>
                                                                <label for="acf-nom_module" class="form-control-placeholder">Nombre personne max</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                            <p class="mt-3" style="font-size: 16px;"><button type="button" class="new_list_nouvelle px-5 btn_next" onclick="retour_equipement();"><a href="#changer_equipement">Retour</a></button></p>
                                        </div>
                                    </div>

                                    <div class="actions_buttons">
                                        <hr>
                                        <div class="form-row d-flex">
                                            <div class="col me-1">
                                                <button type="submit" class="btn w-100 btn_enregistrer" id="sauvegarder">Sauvegarder</button>
                                            </div>
                                            <div class="col">
                                                <button type="button" class="btn w-100 btn_annuler" onclick="resetForm();">
                                                    Annuler</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </form>
                <div class="col-lg-7 live_preview" id="preview_haut">
                    <div class="container py-4 bg-light">
                        <div class="row bg-light justify-content-space-between py-3 px-5" id="border_premier">
                            <div class="col-lg-6 col-md-6  new_back">
                                <div class=" ">
                                    <h4><span id="preview_categ"><span class="py-4 acf-categorie">Ms
                                                Excel</span></span><span style="color: black !important;">&nbsp;-&nbsp;</span>
                                        <span></span>
                                        <span id="preview_module"><span class="acf-nom_module">Excel
                                                avancee</span></span>
                                    </h4>
                                    <p id="preview_descript"><span class="acf-description">Optimiser et
                                            automatiser vos tableaux sans programmer</span></p>
                                    <div class="detail__formation__result__avis" >
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
                            <div class="col-lg-6 col-md-6 ">
                                <div class="">
                                    <div class="text-center"><img src="{{asset('images/CFP/Votre-logo-1.png')}}" alt="logo" class="img-fluid" style="width: 200px; height: 100px;"></div>
                                </div>
                            </div>
                            <div class="row row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                                <div class="col" id="preview_haut2"><i class="bx bxs-alarm bx_icon" style="color: #7635dc !important;"></i>
                                    <span id="preview_jour"><span class="acf-jour">
                                            4
                                        </span>j</span>
                                    <span id="preview_heur">/<span class="acf-heur">
                                            28
                                        </span>h</span>
                                </div>
                                <div class="col" id="preview_modalite"><i class="bx bxs-devices bx_icon" style="color: #7635dc !important;"></i>&nbsp;<span class="acf-modalite">Presentiel
                                        et a
                                        distance</span>
                                </div>
                                <div class="col" id="preview_niveau">
                                    <i class='bx bx-equalizer bx_icon' style="color: #7635dc !important;"></i>&nbsp;<span class="acf-niveau">Debutant</span>
                                </div>
                            </div>
                        </div>
                        <div class="row detail__formation__detail justify-content-space-between py-5 px-5">
                            <div class="col-lg-8 detail__formation__content">

                                <div class="row detail__formation__item__left__objectif" id="border_objectif">
                                    <div class="col-lg-12" id="preview_objectif">
                                        <span class="adresse__text">
                                            <i class="bx bx-radio-circle-marked py-2 pb-3 adresse__icon"></i>&nbsp;Objectifs</span>
                                        <p><span>>&nbsp;</span><span class="acf-objectif"> Suite logique de
                                                la formation "Excel - Intermédiaire", cette
                                                formation vous permet, au travers d'études de cas et
                                                d'exemples
                                                très concrets</span></p>
                                    </div>
                                </div>

                                <div class="row detail__formation__item__left__adresse" id="border_cible">
                                    <div class="col-lg-6 d-flex flex-row">
                                        <div class="row d-flex flex-row">
                                            <span class="adresse__text"><i class="bx bx-user py-2 pb-3 adresse__icon"></i>&nbsp;Pour
                                                qui ?</span>
                                            <div class="col-12 px-2" id="preview_cible">
                                                <p><span>>&nbsp;</span><span class="acf-cible">Contrôleur de
                                                        gestion, financier, RH, toute personne
                                                        ayant à exploiter des résultats chiffrés dans Excel
                                                        (version 2013 et suivantes).</span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="row d-flex flex-row">
                                            <span class="adresse__text"><i class="bx bx-list-plus py-2 pb-3 adresse__icon"></i>&nbsp;Prérequis</span>

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

                                <div class="row detail__formation__item__left__adresse" id="border_equipement">
                                    <div class="col-lg-6 d-flex flex-row">
                                        <div class="row d-flex flex-row">
                                            <span class="adresse__text"><i class="bx bxs-cog py-2 pb-3 adresse__icon"></i>&nbsp;Equipement
                                                necessaire</span>
                                            <div class="col-12" id="preview_materiel">
                                                <p><span>>&nbsp;</span><span class="acf-materiel">ordinateur</span> </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="row d-flex flex-row">
                                            <span class="adresse__text"><i class="bx bxs-message-check py-2 pb-3 adresse__icon"></i>&nbsp;Bon
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

                                <div class="row detail__formation__item__left__adresse" id="border_prestation">
                                    <div class="col-lg-12 d-flex flex-row">
                                        <div class="row d-flex flex-row">
                                            <span class="adresse__text"><i class="bx bx-hive py-2 pb-3 adresse__icon"></i>&nbsp;Prestations
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
                                            <p class="text-uppercase text-center" id="preview_modalite"><span class="acf-modalite text_mod">Presentiel et a
                                                    distance</span></p>
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
                                            <p class="acf-reference">10MG2022-01</p>
                                        </div>
                                    </div>
                                </div>
                                <hr class="hr">
                                <div class="row detail__formation__item__main">
                                    <div class="col-lg-6 detail__prix__main__dure">
                                        <div>
                                            <p><i class="bx bxs-alarm bx_icon"></i><span>&nbsp;Durée :</span>
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
                                    <div class="col-lg-5 detail__prix__main__prix">
                                        <div>
                                            <p><i class='bx bx-euro'></i>&nbsp;Prix :</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 detail__prix__main__prix2">
                                        <div>
                                            <p id="preview_prix"><span class="acf-prix">450000</span>&nbsp;AR&nbsp;HT
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


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
                                            <td align="center"><a href="{{route('supprimer_niveau',$nv->id)}}"><i class="bx bxs-trash"></i></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end mx-5 pb-3">
                                    <button type="button" class="btn btn-secondary" onclick="myFunction()">Retour</button>&nbsp;
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
                                                        <input type="text" class="form-control" name="niveau" placeholder="niveau" required>
                                                    </td>
                                                    <td align="center" class="p-2">
                                                        <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script>
$("#acf-domaine").change(function() {
    var id = $(this).val();
    $(".categ").empty();
    $(".categ").append(
        '<option value="null" disable selected hidden>Choisissez la catégorie de formation ...</option>'
    );

    $.ajax({
        url: "/get_formation",
        type: "get",
        data: {
            id: id,
        },
        success: function(response) {
            var userData = response;

            if (userData.length > 0) {
                document.getElementById("domaine_id_err").innerHTML = "";
                for (var $i = 0; $i < userData.length; $i++) {
                    $(".categ").append(
                        '<option value="' +
                            userData[$i].id +
                            '" data-value="' +
                            userData[$i].nom_formation +
                            '" >' +
                            userData[$i].nom_formation +
                            "</option>"
                    );
                }
            } else {
                document.getElementById("domaine_id_err").innerHTML =
                    "choisir le type de domaine valide pour avoir ses formations";
            }
        },
        error: function(error) {
            console.log(error);
        },
    });
});

$('#acf-objectif').summernote({
        // placeholder: "objectif de la formation"
        // , tabsize: 2
         height: 100
});

$(".module").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_module").css("color", "black");
});

$(".descript").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_descript").css("color", "black");
});

$(".categ").change(function() {
    var $this = $(this);
    var value2 = $('select.categ option[value="' + $(this).val() + '"]').data(
        "value"
    );
    $("." + $this.attr("id") + "").html(value2);
    $("#preview_categ").css("color", "black");
});

$(".jour").change(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_jour").css("color", "black");
});

$(".heur").change(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_heur").css("color", "black");
});

$(".modalite").change(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_modalite").css("color", "black");
});

$(".niveau").change(function() {
    var $this = $(this);
    var valueniveau = $(
        'select.niveau option[value="' + $(this).val() + '"]'
    ).data("value");
    $("." + $this.attr("id") + "").html(valueniveau);
    $("#preview_niveau").css("color", "black");
});

$(".objectif").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_objectif").css("color", "black");
});

$(".cible").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_cible").css("color", "black");
});

$(".prerequis").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_prerequis").css("color", "black");
});

$(".reference").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_reference").css("color", "black");
});

$(".prix").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_prix").css("color", "black");
});

$(".materiel").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_materiel").css("color", "black");
});

$(".bon_a_savoir").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_bon_a_savoir").css("color", "black");
});

$(".prestation").keyup(function() {
    var $this = $(this);
    $("." + $this.attr("id") + "").html($this.val());
    $("#preview_presentation").css("color", "black");
});

function myFunction() {
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
        x.style.display = "block";
        $("#ouvrir_flottant").modal("show");
    } else {
        x.style.display = "none";
        $("#ouvrir_flottant").modal("hide");
    }
}

function myFunction1() {
    var x = document.getElementById("mydiv");
    if (x.style.display === "none") {
        x.style.display = "block";
        $("#ouvrir_flottant").modal("show");
    } else {
        x.style.display = "none";
        $("#ouvrir_flottant").modal("hide");
    }
}

function changer_module() {
    var mod = document.getElementById("premier_vue");
    var mod2 = document.getElementById("premier_vue2");
    var mod3 = document.getElementById("premier_vue3");
    var mod4 = document.getElementById("premier_vue4");
    var mod5 = document.getElementById("premier_vue5");
    var mod6 = document.getElementById("premier_vue6");
    var mod7 = document.getElementById("premier_vue7");
    var mod8 = document.getElementById("premier_vue8");
    var mod9 = document.getElementById("premier_vue9");
    var objectif = document.getElementById("second_vue");
    var public = document.getElementById("troisiem_vue");
    var prerequis = document.getElementById("troisiem_vue2");
    var reference = document.getElementById("quatriem_vue");
    var prix = document.getElementById("quatriem_vue2");
    var bon_a_savoir = document.getElementById("cinquiem_vue");
    var materiel = document.getElementById("cinquiem_vue2");
    var prestation = document.getElementById("sixieme_vue");
    var bouttons = document.getElementById("sixieme_vue2");
    var mod_preview = document.getElementById("border_premier");
    $("#border_premier").css("border", "4px solid #7635dc");
    $("#border_objectif").css("border", "none");
    $("#border_cible").css("border", "none");
    $("#border_equipement").css("border", "none");
    $("#border_prestation").css("border", "none");
    $("#border_reference").css("border", "none");
    $("#changer_module").css("border", "3px solid #7635dc");
    $("#changer_objectif").css("border", "none");
    $("#changer_cible").css("border", "none");
    $("#changer_equipement").css("border", "none");
    $("#changer_prestation").css("border", "none");
    $("#changer_reference").css("border", "none");
    if (mod.style.display === "none") {
        mod.style.display = "block";
        mod2.style.display = "block";
        mod3.style.display = "block";
        mod4.style.display = "block";
        mod5.style.display = "block";
        mod6.style.display = "block";
        mod7.style.display = "block";
        mod8.style.display = "block";
        mod9.style.display = "block";
        objectif.style.display = "none";
        bouttons.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        mod_preview.style.color = "#939BA0";
    } else {
        mod.style.display = "block";
        mod2.style.display = "block";
        mod3.style.display = "block";
        mod4.style.display = "block";
        mod5.style.display = "block";
        mod6.style.display = "block";
        mod7.style.display = "block";
        mod8.style.display = "block";
        mod9.style.display = "block";
        objectif.style.display = "none";
        bouttons.style.display = "none";
        prestation.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        mod_preview.style.color = "#939BA0";
    }
}

function changer_objectif() {
    var mod = document.getElementById("premier_vue");
    var mod2 = document.getElementById("premier_vue2");
    var mod3 = document.getElementById("premier_vue3");
    var mod4 = document.getElementById("premier_vue4");
    var mod5 = document.getElementById("premier_vue5");
    var mod6 = document.getElementById("premier_vue6");
    var mod7 = document.getElementById("premier_vue7");
    var mod8 = document.getElementById("premier_vue8");
    var mod9 = document.getElementById("premier_vue9");
    var objectif = document.getElementById("second_vue");
    var public = document.getElementById("troisiem_vue");
    var prerequis = document.getElementById("troisiem_vue2");
    var reference = document.getElementById("quatriem_vue");
    var prix = document.getElementById("quatriem_vue2");
    var bon_a_savoir = document.getElementById("cinquiem_vue");
    var materiel = document.getElementById("cinquiem_vue2");
    var prestation = document.getElementById("sixieme_vue");
    var bouttons = document.getElementById("sixieme_vue2");
    $("#border_objectif").css("border", "4px solid #7635dc");
    $("#border_premier").css("border", "none");
    $("#border_cible").css("border", "none");
    $("#border_equipement").css("border", "none");
    $("#border_prestation").css("border", "none");
    $("#border_reference").css("border", "none");
    $("#changer_objectif").css("border", "3px solid #7635dc");
    $("#changer_module").css("border", "none");
    $("#changer_cible").css("border", "none");
    $("#changer_equipement").css("border", "none");
    $("#changer_prestation").css("border", "none");
    $("#changer_reference").css("border", "none");
    if (objectif.style.display === "none") {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "block";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    } else {
        objectif.style.display = "block";
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    }
}

function changer_cible() {
    var mod = document.getElementById("premier_vue");
    var mod2 = document.getElementById("premier_vue2");
    var mod3 = document.getElementById("premier_vue3");
    var mod4 = document.getElementById("premier_vue4");
    var mod5 = document.getElementById("premier_vue5");
    var mod6 = document.getElementById("premier_vue6");
    var mod7 = document.getElementById("premier_vue7");
    var mod8 = document.getElementById("premier_vue8");
    var mod9 = document.getElementById("premier_vue9");
    var objectif = document.getElementById("second_vue");
    var public = document.getElementById("troisiem_vue");
    var prerequis = document.getElementById("troisiem_vue2");
    var reference = document.getElementById("quatriem_vue");
    var prix = document.getElementById("quatriem_vue2");
    var bon_a_savoir = document.getElementById("cinquiem_vue");
    var materiel = document.getElementById("cinquiem_vue2");
    var prestation = document.getElementById("sixieme_vue");
    var bouttons = document.getElementById("sixieme_vue2");
    $("#border_cible").css("border", "4px solid #7635dc");
    $("#border_premier").css("border", "none");
    $("#border_objectif").css("border", "none");
    $("#border_equipement").css("border", "none");
    $("#border_prestation").css("border", "none");
    $("#border_reference").css("border", "none");
    $("#changer_cible").css("border", "3px solid #7635dc");
    $("#changer_objectif").css("border", "none");
    $("#changer_module").css("border", "none");
    $("#changer_equipement").css("border", "none");
    $("#changer_prestation").css("border", "none");
    $("#changer_reference").css("border", "none");
    if (objectif.style.display === "none") {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "block";
        prerequis.style.display = "block";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    } else {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "block";
        prerequis.style.display = "block";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    }
}

function changer_reference() {
    var mod = document.getElementById("premier_vue");
    var mod2 = document.getElementById("premier_vue2");
    var mod3 = document.getElementById("premier_vue3");
    var mod4 = document.getElementById("premier_vue4");
    var mod5 = document.getElementById("premier_vue5");
    var mod6 = document.getElementById("premier_vue6");
    var mod7 = document.getElementById("premier_vue7");
    var mod8 = document.getElementById("premier_vue8");
    var mod9 = document.getElementById("premier_vue9");
    var objectif = document.getElementById("second_vue");
    var public = document.getElementById("troisiem_vue");
    var prerequis = document.getElementById("troisiem_vue2");
    var reference = document.getElementById("quatriem_vue");
    var prix = document.getElementById("quatriem_vue2");
    var bon_a_savoir = document.getElementById("cinquiem_vue");
    var materiel = document.getElementById("cinquiem_vue2");
    var prestation = document.getElementById("sixieme_vue");
    var bouttons = document.getElementById("sixieme_vue2");
    $("#border_reference").css("border", "4px solid #7635dc");
    $("#border_premier").css("border", "none");
    $("#border_cible").css("border", "none");
    $("#border_equipement").css("border", "none");
    $("#border_prestation").css("border", "none");
    $("#border_objectif").css("border", "none");
    $("#changer_reference").css("border", "3px solid #7635dc");
    $("#changer_objectif").css("border", "none");
    $("#changer_cible").css("border", "none");
    $("#changer_equipement").css("border", "none");
    $("#changer_prestation").css("border", "none");
    $("#changer_module").css("border", "none");
    if (objectif.style.display === "none") {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "block";
        prix.style.display = "block";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    } else {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "block";
        prix.style.display = "block";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    }
}

function changer_equipement() {
    var mod = document.getElementById("premier_vue");
    var mod2 = document.getElementById("premier_vue2");
    var mod3 = document.getElementById("premier_vue3");
    var mod4 = document.getElementById("premier_vue4");
    var mod5 = document.getElementById("premier_vue5");
    var mod6 = document.getElementById("premier_vue6");
    var mod7 = document.getElementById("premier_vue7");
    var mod8 = document.getElementById("premier_vue8");
    var mod9 = document.getElementById("premier_vue9");
    var objectif = document.getElementById("second_vue");
    var public = document.getElementById("troisiem_vue");
    var prerequis = document.getElementById("troisiem_vue2");
    var reference = document.getElementById("quatriem_vue");
    var prix = document.getElementById("quatriem_vue2");
    var bon_a_savoir = document.getElementById("cinquiem_vue");
    var materiel = document.getElementById("cinquiem_vue2");
    var prestation = document.getElementById("sixieme_vue");
    var bouttons = document.getElementById("sixieme_vue2");
    $("#border_equipement").css("border", "4px solid #7635dc");
    $("#border_premier").css("border", "none");
    $("#border_cible").css("border", "none");
    $("#border_reference").css("border", "none");
    $("#border_prestation").css("border", "none");
    $("#border_objectif").css("border", "none");
    $("#changer_equipement").css("border", "3px solid #7635dc");
    $("#changer_objectif").css("border", "none");
    $("#changer_cible").css("border", "none");
    $("#changer_module").css("border", "none");
    $("#changer_prestation").css("border", "none");
    $("#changer_reference").css("border", "none");
    if (objectif.style.display === "none") {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "block";
        materiel.style.display = "block";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    } else {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "block";
        materiel.style.display = "block";
        prestation.style.display = "none";
        bouttons.style.display = "none";
    }
}

function changer_prestation() {
    var mod = document.getElementById("premier_vue");
    var mod2 = document.getElementById("premier_vue2");
    var mod3 = document.getElementById("premier_vue3");
    var mod4 = document.getElementById("premier_vue4");
    var mod5 = document.getElementById("premier_vue5");
    var mod6 = document.getElementById("premier_vue6");
    var mod7 = document.getElementById("premier_vue7");
    var mod9 = document.getElementById("premier_vue9");
    var mod8 = document.getElementById("premier_vue8");
    var objectif = document.getElementById("second_vue");
    var public = document.getElementById("troisiem_vue");
    var prerequis = document.getElementById("troisiem_vue2");
    var reference = document.getElementById("quatriem_vue");
    var prix = document.getElementById("quatriem_vue2");
    var bon_a_savoir = document.getElementById("cinquiem_vue");
    var materiel = document.getElementById("cinquiem_vue2");
    var prestation = document.getElementById("sixieme_vue");
    var bouttons = document.getElementById("sixieme_vue2");
    $("#border_prestation").css("border", "4px solid #7635dc");
    $("#border_premier").css("border", "none");
    $("#border_cible").css("border", "none");
    $("#border_equipement").css("border", "none");
    $("#border_reference").css("border", "none");
    $("#border_objectif").css("border", "none");
    $("#changer_prestation").css("border", "3px solid #7635dc");
    $("#changer_objectif").css("border", "none");
    $("#changer_cible").css("border", "none");
    $("#changer_equipement").css("border", "none");
    $("#changer_module").css("border", "none");
    $("#changer_reference").css("border", "none");
    if (objectif.style.display === "none") {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "block";
        bouttons.style.display = "block";
    } else {
        mod.style.display = "none";
        mod2.style.display = "none";
        mod3.style.display = "none";
        mod4.style.display = "none";
        mod5.style.display = "none";
        mod6.style.display = "none";
        mod7.style.display = "none";
        mod8.style.display = "none";
        mod9.style.display = "none";
        objectif.style.display = "none";
        public.style.display = "none";
        prerequis.style.display = "none";
        reference.style.display = "none";
        prix.style.display = "none";
        bon_a_savoir.style.display = "none";
        materiel.style.display = "none";
        prestation.style.display = "block";
        bouttons.style.display = "block";
    }
}

function resetForm() {
    changer_module();
    document.getElementById("frm_new_module").reset();
    $("#changer_module").css("border", "3px solid #7635dc");
}

function suivant_objectif() {
    changer_objectif();
}

function retour_module() {
    changer_module();
}

function suivant_cible() {
    changer_cible();
}

function retour_objectif() {
    changer_objectif();
}

function suivant_reference() {
    changer_reference();
}

function retour_cible() {
    changer_cible();
}

function suivant_equipement() {
    changer_equipement();
}

function retour_reference() {
    changer_reference();
}

function suivant_prestation() {
    changer_prestation();
}

function retour_equipement() {
    changer_equipement();
}

let module_vide = document.getElementById("acf-nom_module");
let descript_vide = document.getElementById("acf-description");
let jour_vide = document.getElementById("acf-jour");
let heure_vide = document.getElementById("acf-heur");
let objectif_vide = document.getElementById("acf-objectif");
let cible_vide = document.getElementById("acf-cible");
let prerequis_vide = document.getElementById("acf-prerequis");
let reference_vide = document.getElementById("acf-reference");
let prix_vide = document.getElementById("acf-prix");
let materiel_vide = document.getElementById("acf-materiel");
let bonasavoir_vide = document.getElementById("acf-bon_a_savoir");
let prestation_vide = document.getElementById("acf-prestation");
let btn = document.getElementById("sauvegarder");
btn.disabled = true;

function estComplet() {
    if (
        module_vide.value != "" &&
        descript_vide.value != "" &&
        jour_vide.value != "" &&
        heure_vide.value != "" &&
        objectif_vide.value != "" &&
        cible_vide.value != "" &&
        prerequis_vide.value != "" &&
        reference_vide.value != "" &&
        prix_vide.value != "" &&
        materiel_vide.value != "" &&
        bonasavoir_vide.value != "" &&
        prestation_vide.value != ""
    ) {
        btn.disabled = false;
    } else {
        btn.disabled = true;
    }
}

let sidebar = document.querySelector(".sidebar");
let menu = document.querySelector(".bx-menu");

function clickSidebar() {
    sidebar.classList.toggle("active");
    menu.classList.toggle("bx-menu-alt-right");
}


</script>
@endsection
