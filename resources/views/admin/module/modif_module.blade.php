@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification programme</h3>
@endsection
@section('content')
<link href='https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/modif_programme.css')}}">
<div class="row navigation_detail">
    <div class="ps-5 col justify-content-between d-flex flex-row">
        <div>
            <ul class="d-flex flex-row">
                <li class="me-5"><a href="#objectif">objectif</a></li>
                <li class="me-5"><a href="#pour_qui">pour qui ?</a></li>
                <li class="me-5"><a href="#programme">programme</a></li>
            </ul>
        </div>
        <div>
            <a class="new_list_nouvelle {{ Route::currentRouteNamed('liste_formation') ? 'active' : '' }}"
            href="{{route('liste_module')}}">
            <span class="btn_enregistrer text-center">Précedent</span>
        </a>
        </div>
    </div>
</div>
<section class="detail__formation">
    <div class="container py-4 bg-light">
        <div class="row justify-content-space-between py-3 px-5" id="border_premier">
            <div class="col-lg-6 col-md-6 ">
                <div class="">
                    <h5 class="text-success">Pour faire vos modifications cliquer sur l'icone modifier&nbsp;<i class='bx bxs-hand-right'></i>&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#nom_module"><i class='bx bxs-message-square-edit icon_creer' title="modifier titre module"></i></span></h5>
                    @foreach ($module_en_modif as $res)
                    <h4 class="py-4">{{$res->nom_module}}&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#nom_module"><i class='bx bxs-message-square-edit icon_creer' title="modifier titre module"></i></span></h4>
                    <p class="text_black">{{$res->nom_formation}} </p>
                    <p class="text_black">{{$res->description}}&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#description"><i class='bx bxs-message-square-edit icon_creer' title="modifier description module"></i></span></p>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 ">
                <div class="detail__formation__result__item2">
                    <a href="#">
                        <h6 class="py-4 text-center text_black">Formation Proposée par&nbsp;<span>{{$res->nom}}</span>
                        </h6>
                    </a>
                    <div class="text-center"><img src="{{asset('images/CFP/'.$res->logo)}}" alt="logo" class="img-fluid"
                            style="width: 200px; height:100px;"></div>
                </div>
            </div>
            <div class="row row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                <div id="objectif"></div>
                <div class="col"><i class="bx bxs-alarm bx_icon"></i>
                    <span class="text_black">
                        @isset($res->duree_jour)
                        {{$res->duree_jour}} jours
                        @endisset
                    </span>
                    <span class="text_black">
                        @isset($res->duree)
                        /{{$res->duree}} h
                        @endisset
                    </span> </p>
                </div>

                <div class="col"><i class="bx bxs-devices bx_icon"></i><span
                        class="text_black">&nbsp;{{$res->modalite_formation}}</span>
                </div>
                <div class="col"><i class='bx bx-equalizer bx_icon'></i><span
                        class="text_black">&nbsp;{{$res->niveau}}</span>
                </div>
                <div class="col"><i class='bx bx-receipt bx_icon'></i><span
                    class="text_black">&nbsp;{{ $res->reference }}</span>
                </div>
                <div class="col">
                    {{$devise->devise}}<span class="text_black text_prix">&nbsp;{{number_format($res->prix, 0, ' ', ' ')}}&nbsp;</span>&nbsp;HT</span>
                </div>
                <div class="col">
                    {{$devise->devise}}<span class="text_black text_prix">&nbsp;{{number_format($res->prix_groupe, 0, ' ', ' ')}}&nbsp;</span>&nbsp;HT</span>
                </div>
                <div class="col">
                    <span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#refs"><i class='bx bxs-message-square-edit icon_creer' title="modifier details module"></i></span>
                </div>
            </div>
        </div>
        <div class="row detail__formation__detail justify-content-space-between py-5 px-5 mb-5">
            <div class="col-lg-12 detail__formation__content">
                <div id="pour_qui"></div>
                {{-- section 0 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pb-3">Objectifs de la formation&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#objectif_module"><i class='bx bxs-message-square-edit icon_creer' title="modifier objectif de la formation"></i></span></h3>
                <div class="row detail__formation__item__left__objectif">
                    <div class="col-lg-12">
                        <p>@php echo html_entity_decode($res->objectif) @endphp</p>
                    </div>
                </div>

                {{-- section 1 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pt-3 pb-3">A qui s'adresse cette formation?</h3>
                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-5 d-flex flex-row">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i class="bx bx-user py-2 pb-3 adresse__icon"></i>&nbsp;Pour qui ?&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#cible"><i class='bx bxs-message-square-edit icon_creer' title="modifier objectif de la formation"></i></span></h3></span>
                            <div class="col-12">
                                <p>@php echo html_entity_decode($res->cible) @endphp</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="row d-flex flex-row w-100">
                            <span class="adresse__text"><i
                                    class="bx bx-list-plus py-2 pb-3 adresse__icon"></i>&nbsp;Prérequis&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#prerequis_module"><i class='bx bxs-message-square-edit icon_creer' title="modifier objectif de la formation"></i></span></span>
                            <div class="col-12">
                                <p>@php echo html_entity_decode($res->prerequis) @endphp</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-5 d-flex flex-row">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-cog py-2 pb-3 adresse__icon"></i>&nbsp;Equipement
                                necessaire&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#equipement_module"><i class='bx bxs-message-square-edit icon_creer' title="modifier objectif de la formation"></i></span></span>
                            <div class="col-12">
                                <p>@php echo html_entity_decode($res->materiel_necessaire) @endphp</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-message-check py-2 pb-3 adresse__icon"></i>&nbsp;Bon
                                a savoir&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#bon_a_savoir_module"><i class='bx bxs-message-square-edit icon_creer' title="modifier objectif de la formation"></i></span></span>
                            <div class="col-12">
                                <p>@php echo html_entity_decode($res->bon_a_savoir) @endphp</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="programme"></div>
                <div id="programme__formation"></div>
                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-12 d-flex flex-row">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bx-hive py-2 pb-3 adresse__icon"></i>&nbsp;Prestations
                                pedagogiques&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#prestation_module"><i class='bx bxs-message-square-edit icon_creer' title="modifier objectif de la formation"></i></span></span>
                            <div class="col-12">
                                <p>@php echo html_entity_decode($res->prestation) @endphp</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- modal modification --}}
            <div>
                {{-- modification nom_module --}}
                <div>
                    <div class="modal" id="nom_module" aria-labelledby="nom_module" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('modification_nom_module',$res->module_id)}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Nom module</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control module module input" name="nom_module" required value="{{$res->nom_module}}" placeholder="Nom module" >
                                            <label for="nom_module" class="form-control-placeholder">Nom module</label>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                    </div>
                </div>
                {{-- modification description --}}
                <div>
                    <div class="modal" id="description" aria-labelledby="description" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('modification_description',$res->module_id)}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Déscription module</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control module module input" name="description" required value="{{$res->description}}" placeholder="Déscription module" >
                                            <label for="description" class="form-control-placeholder">Déscription</label>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification detail --}}
                <div>
                    <div class="modal" id="refs" aria-labelledby="refs" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('modification_detail',$res->module_id)}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Détail module</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control jour input" id="jour" name="jour" min="1" max="365" onfocus="(this.type='number')" title="modifier durée en jours" value="{{$res->duree_jour}}" placeholder="Durée en Jours (J)" required>
                                            <label for="acf-jour" class="form-control-placeholder">Durée en Jours (J)</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control jour input" id="heure" name="heure" min="1" max="8760" onfocus="(this.type='number')" title="modifier durée en heure" value="{{$res->duree}}" placeholder="Durée en Heure (H)" required>
                                            <label for="acf-jour" class="form-control-placeholder">Durée en Heure (H)</label>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control select_formulaire modalite modalite input mt-3" id="modalite" name="modalite" style="height: 50px;">
                                                @if($res->modalite_formation == 'En ligne')
                                                <option value="{{$res->modalite_formation}}" selected>
                                                    {{$res->modalite_formation}}</option>
                                                <option value="Presentiel">Présentiel</option>
                                                <option value="En ligne/Presentiel">En ligne/Présentiel</option>
                                                @endif
                                                @if($res->modalite_formation == 'Presentiel')
                                                <option value="En ligne">En ligne</option>
                                                <option value="{{$res->modalite_formation}}" selected>
                                                    {{$res->modalite_formation}} </option>
                                                <option value="En ligne/Presentiel">En ligne/Présentiel</option>
                                                @endif
                                                @if($res->modalite_formation == 'En ligne/Presentiel')
                                                <option value="En ligne">En ligne</option>
                                                <option value="Presentiel">Présentiel</option>
                                                <option value="{{$res->modalite_formation}}" selected>
                                                    {{$res->modalite_formation}} </option>
                                                @endif
                                            </select>
                                            <label for="acf-modalite" class="form-control-placeholder">Modifier la modalite de formation...</label>
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control select_formulaire niveau niveau input mt-3" id="niveau" name="niveau" style="height: 50px;">
                                                <option value="{{$res->niveau_id}}" selected>
                                                    {{$res->niveau}} </option>
                                                @foreach($niveau as $nv)
                                                <option value="{{$nv->id}}" data-value="{{$nv->niveau}}">
                                                    {{$nv->niveau}}</option>
                                                @endforeach
                                            </select>
                                            <label for="acf-modalite" class="form-control-placeholder">Modifier le niveau</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control module module input" name="reference" required value="{{$res->reference}}" placeholder="Référence module" >
                                            <label for="reference" class="form-control-placeholder">Référence</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control module module input" name="prix" required value="{{$res->prix}}" onfocus="(this.type='number')" placeholder="Prix module" >
                                            <label for="prix" class="form-control-placeholder">Prix en {{$devise->devise}}</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control module module input" name="prix_groupe" required value="{{$res->prix_groupe}}" onfocus="(this.type='number')" placeholder="Prix en groupe module" >
                                            <label for="prix_groupe" class="form-control-placeholder">Prix groupe en {{$devise->devise}}</label>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification objectif --}}
                <div>
                    <div class="modal" id="objectif_module" aria-labelledby="objectif_module" aria-hidden="true">
                        <div class="modal-dialog width_large">
                            <div class="modal-content ">
                                <form action="{{route('modification_objectif',$res->module_id)}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Objectif de la formation</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="objectif_text" name="objectif" placeholder="Ajouter des textes">{{$res->objectif}}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification pour_qui --}}
                <div>
                    <div class="modal" id="cible" aria-labelledby="cible" aria-hidden="true">
                        <div class="modal-dialog width_large">
                            <div class="modal-content ">
                                <form action="{{route('modification_pour_qui',$res->module_id)}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Public cible</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="public_cible" name="public_cible" placeholder="Ajouter des textes">{{$res->cible}}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification prerequis --}}
                <div>
                    <div class="modal" id="prerequis_module" aria-labelledby="prerequis_module" aria-hidden="true">
                        <div class="modal-dialog width_large">
                            <div class="modal-content ">
                                <form action="{{route('modification_prerequis',$res->module_id)}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Prérequis</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="prerequis" name="prerequis" placeholder="Ajouter des textes">{{$res->prerequis}}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification equipement --}}
                <div>
                    <div class="modal" id="equipement_module" aria-labelledby="equipement_module" aria-hidden="true">
                        <div class="modal-dialog width_large">
                            <div class="modal-content ">
                                <form action="{{route('modification_equipement',$res->module_id)}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Equipement necessaire</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="equipement" name="equipement" placeholder="Ajouter des textes">{{$res->materiel_necessaire}}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification bon_a_savoir --}}
                <div>
                    <div class="modal" id="bon_a_savoir_module" aria-labelledby="bon_a_savoir_module" aria-hidden="true">
                        <div class="modal-dialog width_large">
                            <div class="modal-content ">
                                <form action="{{route('modification_bon_a_savoir',$res->module_id)}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Bon à savoir</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="bon_a_savoir" name="bon_a_savoir" placeholder="Ajouter des textes">{{$res->bon_a_savoir}}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- modification prestation --}}
                <div>
                    <div class="modal" id="prestation_module" aria-labelledby="prestation_module" aria-hidden="true">
                        <div class="modal-dialog width_large">
                            <div class="modal-content ">
                                <form action="{{route('modification_prestation',$res->module_id)}}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Préstation pédagogique</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="prestation" name="prestation" placeholder="Ajouter des textes">{{$res->prestation}}</textarea>
                                        </div>
                                        <div class="mt-3">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js'></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="{{ asset('js/module_programme.js') }}"></script>
<script>
    let editor = new FroalaEditor('#objectif_text');
    let editor2 = new FroalaEditor('#public_cible');
    let editor3 = new FroalaEditor('#prerequis');
    let editor4 = new FroalaEditor('#equipement');
    let editor5 = new FroalaEditor('#bon_a_savoir');
    let editor6 = new FroalaEditor('#prestation');
</script>
@endsection