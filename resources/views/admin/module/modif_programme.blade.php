@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification programme</h3>
@endsection
@section('content')
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
                    @foreach ($infos as $res)
                    <h4 class="py-4">{{$res->nom_module}}</h4>
                    <p class="text_black">{{$res->nom_formation}} </p>
                    <p class="text_black">{{$res->description}}</p>
                    <div class="detail__formation__result__avis">
                        <div class="Stars" style="--note: {{ $res->pourcentage }};"></div>
                        <span class="text_black"><strong>{{ $res->pourcentage }}</strong>/5 ({{ $nb_avis }} avis)</span>
                    </div>


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
                <div class="col">{{$devise->devise}}
                    <span class="text_black text_prix">&nbsp;{{number_format($res->prix, 0, ' ', ' ')}}&nbsp;</span>&nbsp;HT</span>
                </div>
            </div>
        </div>
        <div class="row detail__formation__detail justify-content-space-between py-5 px-5 mb-5">
            <div class="col-lg-12 detail__formation__content">
                <div id="pour_qui"></div>
                {{-- section 0 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pb-3">Objectifs de la formation</h3>
                <div class="row detail__formation__item__left__objectif">
                    <div class="col-lg-12">
                        <p>{{$res->objectif}}</p>
                    </div>
                </div>

                {{-- section 1 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pt-3 pb-3">A qui s'adresse cette formation?</h3>
                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-5 d-flex flex-row">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i class="bx bx-user py-2 pb-3 adresse__icon"></i>&nbsp;Pour qui ?</span>
                            <div class="col-12">
                                <p><i class="bx bx-chevron-right"></i>&nbsp;{{$res->cible}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="row d-flex flex-row w-100">
                            <span class="adresse__text"><i
                                    class="bx bx-list-plus py-2 pb-3 adresse__icon"></i>&nbsp;Prérequis</span>
                            <div class="col-12">
                                <p><i class="bx bx-chevron-right"></i>&nbsp;{{$res->prerequis}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-5 d-flex flex-row">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-cog py-2 pb-3 adresse__icon"></i>&nbsp;Equipement
                                necessaire</span>
                            <div class="col-12">
                                <p><i class="bx bx-chevron-right"></i>&nbsp;{{$res->materiel_necessaire}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-message-check py-2 pb-3 adresse__icon"></i>&nbsp;Bon
                                a savoir</span>
                            <div class="col-12">
                                <p><i class="bx bx-chevron-right"></i>&nbsp;{{$res->bon_a_savoir}}</p>
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
                                pedagogiques</span>
                            <div class="col-12">
                                <p><i class="bx bx-chevron-right"></i>&nbsp;{{$res->prestation}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- section 3 --}}
                {{-- FIXME:mise en forme de design --}}
                <div class="row detail__formation__item__left">
                    <h3 class="pt-3 pb-3">Programme de la formation</h3>
                    <div class="col-lg-12">
                        <div class="row detail__formation__item__left">
                            <form action="{{route('insert_prog_cours')}}" method="POST" class="w-100">
                                @csrf
                                <div id="newProg"></div>
                                <div class="form-row d-flex flex-row">
                                    <input type="hidden" value="{{$id}}" name="id_module">
                                    <button type="submit" class="btn btn-primary btn_enregistrer me-4" id="nouveau_prg"
                                        style="display:none">Enregistrer</button>
                                    <button type="button" id="addProg" class="btn_creer btn pb-2">
                                        <i class='bx bx-plus-medical icon_creer'></i>
                                        Ajouter un nouveau section dans votre programme
                                    </button>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="row detail__formation__item__left__accordion ">
                            <div class="accordionWrapper">
                                <?php $i=0 ?>
                                @foreach ($programmes as $prgc)
                                <div class="accordionItem open" id="programme{{$prgc->id}}">
                                    <h6 class="accordionItemHeading py-2 ps-3 pe-3 justify-content-between d-flex flex-row">
                                        <div class="pt-2">{{$i+1}} - {{$prgc->titre}}</div>
                                        <div class="suppression_programme px-2" role="button"
                                            title="Supprimer le programme" id="{{$prgc->id}}"><i class='bx bx-x me-2'></i>Supprimer</div>
                                    </h6>
                                    <div class="accordionItemContent">
                                        @foreach ($cours as $c)
                                        @if($c->programme_id == $prgc->id)
                                        <div id="cours{{$c->cours_id}}" class="ps-4 m-0 pb-3 pt-2 p-0 cours_hover d-flex flex-row justify-content-between">
                                            <div class="pt-2"><i class="bx bx-chevron-right"></i>&nbsp;{{$c->titre_cours}} </div>
                                            <div class="me-2">
                                                <span class="suppression effacer_cours"
                                                    role="button" title="Supprimer le Cours"
                                                    id="{{$c->cours_id}}"><i class='bx bx-x me-2'></i>Effacer</>
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                        <button type="button" class="btn_creer ms-2 mb-2 mt-2 pb-2"
                                            data-bs-toggle="modal" data-bs-target="#Modal_cours_{{$prgc->id}}"
                                            id="{{$prgc->id}}">
                                            <i class='bx bx-plus-medical icon_creer'></i>
                                            Ajouter de point dans votre section
                                        </button>
                                        <button type="button" class="btn btn_creer ms-2 mb-2 mt-2 pb-2"
                                            data-bs-toggle="modal" data-bs-target="#Modal_{{$prgc->id}}"
                                            id="{{$prgc->id}}">
                                            <i class='bx bxs-edit-alt icon_creer'></i>
                                            Modifier Section et Points
                                        </button>
                                    </div>
                                    {{-- data-target="#Modal_{{$prgc->id}}" --}}
                                </div>
                                <div>
                                    <div class="modal fade" id="Modal_{{$prgc->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="Modal{{$prgc->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalLabel">Modifier les Cours et le
                                                        Programme</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('update_prog_cours')}}" method="POST"
                                                        class="form_modif">
                                                        @csrf
                                                        <input type="hidden" value="{{$prgc->id}}" name="id_prog">
                                                        <div class="form-row">
                                                            <label for="" class="mb-2">Titre de Section</label>
                                                            <input type="text" name="titre_prog"
                                                                class="w-100  titre_{{$i}} input" value="{{$prgc->titre}}">
                                                            <hr>
                                                            <label for="" class="mb-2">Liste des Points en Cours</label>
                                                            <div class="d-flex flex-column">
                                                                <?php $j=0 ?>
                                                                @foreach ($cours as $c)
                                                                @if($c->programme_id == $prgc->id)
                                                                <input type="text"
                                                                    name="cours_{{$prgc->id}}_{{$c->cours_id}}"
                                                                    class="w-100 cours_{{$j}} input mb-2"
                                                                    value="{{$c->titre_cours}}" required>
                                                                <input type="hidden"
                                                                    name="id_cours_{{$prgc->id}}_{{$c->cours_id}}"
                                                                    value="{{$c->cours_id}}">
                                                                <?php $j++ ?>
                                                                @endif
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer d-flex flex-row">
                                                    <button type="button" class="btn  btn_previous"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn  btn_next">Enregistrer</button>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="modal fade" id="Modal_cours_{{$prgc->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="Modal_cours_{{$prgc->id}}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{route('insertion_cours')}}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id_prog" id="id" value="{{$prgc->id}}">
                                                    <div class="modal-header">
                                                        <h6>Ajouter des nouvelles Points dans&nbsp;{{$prgc->titre}}</h6>
                                                    </div>
                                                    <div class="modal-body mt-2 mb-2">
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="mt-2 text-center">
                                                                    <button type="button" class="btn_creer text-center mb-4 pb-2" onclick="Cours();" >
                                                                        <i class='bx bx-plus-medical icon_creer'></i>Ajouter une nouvelle ligne
                                                                    </button>

                                                                </div>
                                                            </div>
                                                            <div class="d-flex">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="form-row">
                                                                            <input type="text" name="cours[]" id="cours"
                                                                                class="form-control input" placeholder="Nouveau Point" required>
                                                                            <label for="cours"
                                                                                class="form-control-placeholder">Nouveau Point </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="newRow"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn_previous " id="fermer"
                                                            data-bs-dismiss="modal">
                                                            Fermer </button>
                                                        <button type="submit"
                                                            class="btn btn_next non_pub">Enregistrer</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++ ?>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- FIXME:mise en forme de design --}}
            <div class="col-lg-3 g-0 p-0 m-0">

                @if($competences != null)
                <div class="row g-0 competence_box mb-3 ">
                    <h5 class="text-center py-2">Compétences à Acquérir</h5>
                        @foreach ($competences as $comp)
                        <div class="row text-start g-0 px-1" id="competence_{{$comp->id}}">
                            <div class="col-1">
                                <i class="bx bx-check check_comp"></i>&nbsp;
                            </div>
                            <div class="col-11 mb-3">
                                <span class="text-capitalize">{{$comp->titre_competence}}</span>
                            </div>
                        </div>
                        @endforeach
                        <div class="text-center">
                            <button type="button" class="btn_creer ms-2 mb-2 mt-2 pb-2" data-bs-toggle="modal" data-bs-target="#ModalCompetence_{{$id}}" id="{{$id}}">
                                <i class='bx bx-plus-medical icon_creer'></i>
                                Ajouter
                            </button>
                            <button type="button" class="btn btn_creer ms-2 mb-2 mt-2 pb-2" data-bs-toggle="modal" data-bs-target="#Modal_{{$id}}" id="{{$id}}">
                                <i class='bx bxs-edit-alt icon_creer'></i>
                                Modifier
                            </button>
                        </div>
                </div>
                @endif
                <div>
                    <div class="modal fade" id="ModalCompetence_{{$id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('ajout_competence')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{$id}}">
                                    <div class="modal-header">
                                        <h6>Compétences a évaluer</h6>
                                    </div>
                                    <div class="modal-body mt-2 mb-2">
                                        <div class="container">
                                            <div class="row">
                                                <div class="mt-2 text-center">
                                                    <button id="addRow" type="button" class="btn_creer text-center mb-4 pb-2" onclick="competence();" >
                                                        <i class='bx bx-plus-medical icon_creer'></i>Ajouter une nouvelle ligne
                                                    </button>

                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <div class="col-8">
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <input type="text" name="titre_competence[]"
                                                                id="titre_competence"
                                                                class="form-control input" placeholder="Compétences"
                                                                required>
                                                            <label for="titre_competence"
                                                                class="form-control-placeholder">Compétences</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-group ms-1">
                                                        <div class="form-row">
                                                            <input type="text" name="notes[]"
                                                                id="notes" min="1" max="10"
                                                                onfocus="(this.type='number')"
                                                                class="form-control input" placeholder="Notes"
                                                                required>
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
                </div>
                <div>
                    <?php $i=0 ?>
                    <div class="modal fade" id="Modal_{{$id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('modifier_competence')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{$id}}">
                                    <div class="modal-header">
                                        <h6>Compétences a évaluer</h6>
                                    </div>
                                    <div class="modal-body mt-2 mb-2">
                                        <div class="container">
                                            @foreach ($competences as $comp)
                                            <div class="d-flex">
                                                <div class="col-9">
                                                    <div class="form-group">
                                                        <div class="form-row">
                                                            <input type="text" name="titre_competence_{{$comp->module_id}}_{{$comp->id}}"
                                                                id="titre_competence"
                                                                class="form-control input mb-2 suppre_{{$comp->id}}" value="{{$comp->titre_competence}}" placeholder="Compétences"
                                                                required>
                                                            <input type="hidden"
                                                                name="id_notes_{{$comp->module_id}}_{{$comp->id}}"
                                                                value="{{$comp->module_id}}">
                                                            <label for="titre_competence"
                                                                class="form-control-placeholder">Compétences</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <div class="form-group ms-1">
                                                        <div class="form-row">
                                                            <input type="text" name="notes_{{$comp->module_id}}_{{$comp->id}}"
                                                                id="notes" min="1" max="10"
                                                                onfocus="(this.type='number')"
                                                                class="form-control input mb-2 suppre_{{$comp->id}}" value="{{$comp->objectif}}" placeholder="Notes"
                                                                required>
                                                                <input type="hidden"
                                                                    name="id_notes_{{$comp->module_id}}_{{$comp->id}}"
                                                                    value="{{$comp->module_id}}">
                                                            <label for="notes"
                                                                class="form-control-placeholder">Notes</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-1">
                                                    <div class="px-2 mt-2 suppre_{{$comp->id}} suppression_competence" role="button" title="Supprimer le competence" id="{{$comp->id}}" data-id="{{$comp->id}}"><i class='bx bx-x me-2'></i></div>
                                                </div>
                                            </div>
                                            @endforeach
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
                    <?php $i++ ?>
                </div>
            </div>
            {{-- modal competence ajouter --}}

        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="{{ asset('js/module_programme.js') }}"></script>
@endsection