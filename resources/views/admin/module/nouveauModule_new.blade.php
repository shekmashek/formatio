@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Modification programme</h3>
@endsection
@section('content')
<link href="https://cdn.quilljs.com/1.0.0/quill.snow.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControlModules.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/modif_programme.css')}}">
<div class="row navigation_detail mb-2">
    <div class="ps-5 col justify-content-between d-flex flex-row">
        <div>
            <ul class="d-flex flex-row">
                <li class="me-5"><a href="#objectif"><i class='bx bx-target-lock encre_icon me-2'></i>objectif</a></li>
                <li class="me-5"><a href="#pour_qui"><i class='bx bx-user encre_icon me-2'></i>pour qui ?</a></li>
                <li class="me-5"><a href="#programme"><i class='bx bx-list-minus encre_icon me-2'></i>programme</a></li>
            </ul>
        </div>
        <div>
            <a href="{{route('annuler_new_mod',$infos[0]->module_id)}}" class="text-primary retour_back btn_annuler"><i class='bx bx-x me-1'></i>annuler</a>
            <a class="new_list_nouvelle {{ Route::currentRouteNamed('liste_formation') ? 'active' : '' }}"
            href="{{route('liste_module')}}">
            <span class="btn_precedent text-center hors_ligne_redirect"><i class='bx bx-check-double me-1'></i>Enregistrer</span>
            </a>
        </div>
    </div>
</div>
{{-- <div style="display: none" id="popup"></div> --}}
<div id="popup">
    Bonjour, pour pouvoir créer votre module de formation, veuillez modifier le template ci-dessous afin de l'enregistrer. <br>
    Ceci est un aperçu de présentation de votre module quand il sera mis en ligne. Pour annuler cette création cliquer <a href="{{route('annuler_new_mod',$infos[0]->module_id)}}" class="text-primary retour_back">ici.</a><br>
    Si vous ne modifier pas vos informations, il sera présenter comme tel. Veuillez à bien vérifier 👀 ! Il sera visible dans l'onglet hors ligne.
</div>
<section class="detail__formation">
    <div class="container py-4 bg-light">
        <div class="row justify-content-space-between py-3 px-5" id="border_premier">
            <div class="col-lg-6 col-md-6 ">
                <div class="">
                    @foreach ($infos as $res)
                    <h4 class="py-4">{{$res->nom_module}}&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#nom_module"><i class='bx bx-edit bx_modifier' title="modifier titre module"></i></span></h4>
                    <p class="text_black">{{$res->nom_formation}}</p>
                    <div class="d-flex">
                        <p class="text_black">{{$res->description}}</p>&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#description"><i class='bx bx-edit bx_modifier' title="modifier description module"></i></span>
                    </div>
                    <div class="detail__formation__result__avis">
                        <div class="Stars" style="--note: {{ $res->pourcentage }};"></div>
                        <span class="text_black"><strong>{{ $res->pourcentage }}</strong>/5 ({{ $nb_avis }} avis)</span>
                        {{-- <div class="col">
                            <p class="mb-0"> Nouveau niveau de formation &nbsp;<i class="bx bx-plus-medical bx_ajouter" onclick="changer_niveau()"></i></p>
                        </div> --}}
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
                <div class="col background_contrast"><i class="bx bxs-alarm bx_icon"></i><i class='bx bx-signal-5' ></i>
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
                        <i class='bx bx-signal-5 bx_icon bx_pourcentage' style="--pourcentage: {{$level->progression}}"></i><span>&nbsp;{{$res->niveau}}</span>
                    @endif
                    @endforeach
                </div>
                <div class="col background_contrast"><i class='bx bx-clipboard bx_icon'></i><span>&nbsp;{{$res->reference}}</span></div>
                <div class="col background_contrast" ><span >{{$devise->devise}} &nbsp;<strong>{{number_format($res->prix, 0, ' ', ' ')}}</strong><sup>&nbsp;/ pers</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></span></div>
                @if($res->prix_groupe != null)
                    <div class="col background_contrast" ><span >{{$devise->devise}} &nbsp;<strong>{{number_format($res->prix_groupe, 0, ' ', ' ')}}</strong><sup>&nbsp;/ {{$res->max_pers}} pers</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></span></div>
                @endif
                <div class="col">
                    <span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#refs"><i class='bx bx-edit bx_modifier' title="modifier details module"></i></span>
                </div>
            </div>
        </div>
        <div class="row detail__formation__detail justify-content-space-between py-5 px-5 mb-5">
            <div class="col-lg-9 detail__formation__content">
                <div id="pour_qui"></div>
                {{-- section 0 --}}
                {{-- FIXME:mise en forme de design --}}
                <h4 class="pb-3"><i class='bx bx-target-lock encre__icon me-2'></i>Objectifs de la formation&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#objectif_module"><i class='bx bx-edit bx_modifier' title="modifier objectif de la formation"></i></span></h4>
                <div class="row detail__formation__item__left__objectif">
                    <div class="col-lg-12">
                        {{-- <p>@php echo html_entity_decode($res->objectif) @endphp</p> --}}
                        <p id="objectif_content">{{$res->objectif}}</p>
                    </div>
                </div>

                {{-- section 1 --}}
                {{-- FIXME:mise en forme de design --}}
                <h4 class="pt-3 pb-3"><i class='bx bx-user encre__icon me-2'></i>A qui s'adresse cette formation?</h4>
                <div class="row detail__formation__item__left__adresse pe-4">
                    <div class="col d-flex flex-row module_detail_objet me-3">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i class="bx bx-user py-2 pb-3 adresse__icon"></i>&nbsp;Pour qui ?&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#cible"><i class='bx bx-edit bx_modifier' title="modifier objectif de la formation"></i></span></h3></span>
                            <div class="col-12 ps-4">
                                {{-- <p>@php echo html_entity_decode($res->cible) @endphp</p> --}}
                                <p id="cible_content">{{$res->cible}}</p>

                            </div>
                        </div>
                    </div>
                    <div class="col module_detail_objet">
                        <div class="row d-flex flex-row w-100">
                            <span class="adresse__text"><i class="bx bx-list-plus py-2 pb-3 adresse__icon"></i>&nbsp;Prérequis&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#prerequis_module"><i class='bx bx-edit bx_modifier' title="modifier objectif de la formation"></i></span></span>
                            <div class="col-12 ps-4">
                                {{-- <p>@php echo html_entity_decode($res->prerequis) @endphp</p> --}}
                                <p id="prerequis_content">{{$res->prerequis}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row detail__formation__item__left__adresse pe-4">
                    <div class="col d-flex flex-row module_detail_objet me-3">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i class="bx bxs-cog py-2 pb-3 adresse__icon"></i>&nbsp;Equipement necessaire&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#equipement_module"><i class='bx bx-edit bx_modifier' title="modifier objectif de la formation"></i></span></span>
                            <div class="col-12 ps-4">
                                {{-- <p>@php echo html_entity_decode($res->materiel_necessaire) @endphp</p> --}}
                                <p id="equipement_content">{{$res->materiel_necessaire}}</p>

                            </div>
                        </div>
                    </div>

                    <div class="col module_detail_objet">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i class="bx bxs-message-check py-2 pb-3 adresse__icon"></i>&nbsp;Bon a savoir&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#bon_a_savoir_module"><i class='bx bx-edit bx_modifier' title="modifier objectif de la formation"></i></span></span>
                            <div class="col-12 ps-4">
                                {{-- <p>@php echo html_entity_decode($res->bon_a_savoir) @endphp</p> --}}
                                <p id="bon_a_savoir_content">{{$res->bon_a_savoir}}</p>

                            </div>
                        </div>
                    </div>
                </div>
                <div id="programme"></div>
                <div id="programme__formation"></div>
                <div class="row detail__formation__item__left__adresse ">
                    <div class="row detail__formation__item__left__adresse">
                        <div class="col-lg-12 d-flex flex-row module_detail_objet">
                            <div class="row d-flex flex-row">
                                <span class="adresse__text"><i
                                    class="bx bx-hive py-2 pb-3 adresse__icon"></i>&nbsp;Prestations
                                pedagogiques&nbsp;<span class="icon_modif" role="button" data-bs-toggle="modal" data-bs-target="#prestation_module"><i class='bx bx-edit bx_modifier' title="modifier objectif de la formation"></i></span></span>
                                <div class="col-12 ps-4">
                                    {{-- <p>@php echo html_entity_decode($res->prestation) @endphp</p> --}}
                                    <p id="prestation_content">{{$res->prestation}}</p>
                                </div>
                            </div>
                            <div id="programme"></div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- section 3 --}}
                {{-- FIXME:mise en forme de design --}}
                <div class="row detail__formation__item__left">
                    <div class="d-flex flex-row">
                        <h4 class="pt-3 pb-3"><i class='bx bx-list-minus encre__icon me-2'></i>Programme de la formation </h4>
                        <span class="aide_pogramme"><i class='bx bx-help-circle text-muted'></i>
                            <div class="text_aide">
                                <p>Le programme doit décrire les différentes étapes que le stagiaire aura à parcourir pour atteindre son objectif en termes d’acquisition de compétences, de savoirs et de savoir-faire. <br>
                                    Vous pouvez également ajouter de nouvelles programmes en cliquant sur <button type="button" class="btn_nouveau btn">
                                        <i class='bx bx-plus-medical '></i>
                                        Ajouter un section
                                    </button>
                                    <br>Vous pouvez également modifier les existant en faisant un survol.
                                </p>
                            </div>
                        </span>
                    </div>

                    <div class="col-lg-12">
                        <div class="row detail__formation__item__left">
                            <form action="{{route('insert_prog_cours')}}" method="POST" class="w-100">
                                @csrf
                                <div id="newProg"></div>
                                <div class="form-row d-flex flex-row">
                                    <input type="hidden" value="{{$id[0]->id}}" name="id_module">
                                    <button type="submit" class="btn btn_enregistrer me-4" id="nouveau_prg"
                                        style="display:none"><i class='bx bx-check-double me-1'></i>Enregistrer</button>
                                    <button type="button" id="addProg" class="btn_nouveau btn">
                                        <i class='bx bx-plus-medical '></i>
                                        Ajouter un section
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
                                        <div class="d-flex flex-row test_affichage">
                                            <div role="button" data-bs-toggle="modal" class="ajouter_cours me-2" data-bs-target="#Modal_cours_{{$prgc->id}}" id="{{$prgc->id}}" title="ajouter une nouvelle point">
                                                <i class='bx bx-plus-medical bx_ajouter'></i>
                                            </div>
                                            <div role="button" data-bs-toggle="modal" class="modifier_cours me-2"  id="{{$prgc->id}}" title="modifier le programme">
                                                <i class='bx bx-edit bx_modifier'></i>
                                            </div>
                                            <div class="suppression_programme" title="Supprimer le programme" id="{{$prgc->id}}">
                                                <i class='bx bx-trash bx_supprimer'></i>
                                            </div>
                                        </div>
                                    </h6>
                                    <div class="accordionItemContent">
                                        @foreach ($cours as $c)
                                        @if($c->programme_id == $prgc->id)
                                        <div id="cours{{$c->cours_id}}" class="ps-4 m-0 pb-3 pt-2 p-0 cours_hover d-flex flex-row justify-content-between">
                                            <div class="pt-2"><i class="bx bx-chevron-right"></i>&nbsp;{{$c->titre_cours}}</div>
                                            <div class="me-2">
                                                <span class="suppression mt-2" title="Supprimer le Cours" id="{{$c->cours_id}}">
                                                    <i class='bx bx-trash bx_supprimer'></i>
                                                </span>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach

                                    </div>
                                    {{-- data-target="#Modal_{{$prgc->id}}" --}}
                                </div>
                                <div>
                                    <div class="modal fade" id="Modal_{{$prgc->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="Modal{{$prgc->id}}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ModalLabel">Modifier les Cours et le Programme</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('update_prog_cours')}}" method="POST"
                                                        class="form_modif">
                                                        @csrf
                                                        <div class="rowModifier"></div>
                                                        {{-- <input type="hidden" value="{{$prgc->id}}" name="id_prog">
                                                        <div class="form-row">
                                                            <label for="" class="mb-2">Titre de Section</label>
                                                            <input type="text" name="titre_prog" class="w-100  titre_{{$i}} input" value="{{$prgc->titre}}">
                                                            <hr>
                                                            <label for="" class="mb-2">Liste des Points en Cours</label>
                                                            <div class="d-flex flex-column">
                                                                <?php $j=0 ?>
                                                                @foreach ($cours as $c)
                                                                    @if($c->programme_id == $prgc->id)
                                                                    <input type="text" name="cours_{{$prgc->id}}_{{$c->cours_id}}" class="w-100 cours_{{$j}} input mb-2" value="{{$c->titre_cours}}" required>
                                                                    <input type="hidden" name="id_cours_{{$prgc->id}}_{{$c->cours_id}}" value="{{$c->cours_id}}">
                                                                    <?php $j++ ?>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                        </div> --}}
                                                </div>
                                                <div class="modal-footer justify-content-center">
                                                    <button type="button" class="btn btn_fermer remove_input" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                                    <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check-double me-1'></i>Enregistrer</button>
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
                                                            <div class="row mb-5">
                                                                <div class="mt-2 text-center">
                                                                    <span class="btn_nouveau text-center" onclick="Cours();" >
                                                                        <i class='bx bx-plus-medical me-1'></i>Ajouter un point
                                                                    </span>
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
                                                            <div class="newRowCours"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-center">
                                                        <button type="button" class="btn btn_fermer" id="fermerCours" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                                        <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check-double me-1'></i>Enregistrer</button>
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

                {{-- @if($competences == null) --}}
                <div class="row g-0 competence_box mb-3 ">

                    <div class="d-flex justify-content-between">
                        <h5 class="text-center py-2 ps-1">Compétences à Acquérir
                        <span class="aide_competence"><i class='bx bx-help-circle '></i>
                            <div class="text_aide">
                                <p>Attribuez des compétences à vos intervenants et à vos programmes de formation pour faciliter le suivi de vos formations. <br>
                                    Vous pouvez également ajouter de nouvelles compétences en cliquant sur l'icone <i class='bx bx-plus-medical bx_ajouter'></i> et les modifer sur <i class='bx bx-edit bx_modifier'></i>. Vous pouvez entrer au maximum 10 compétences et 3 minimum et une note allant de 1 à 10 !</p>
                            </div>
                        </span>
                    </h5>
                    </div>
                        {{-- @foreach ($competences as $comp)
                        <div class="row text-start g-0 px-1" id="competence_{{$comp->id}}">
                            <div class="col-1">
                                <i class="bx bx-check-double check_comp"></i>&nbsp;
                            </div>
                            <div class="col-11 mb-3">
                                <span class="text-capitalize">{{$comp->titre_competence}}</span>
                            </div>
                        </div>
                        @endforeach --}}
                        <canvas id="marksChart" width="1000" height="800" class="justify-content-center"></canvas>
                        <div class="text-center mb-3">
                            <span class=" ms-2 mb-2 mt-2 pb-2" data-bs-toggle="modal" data-bs-target="#ModalCompetence_{{$id[0]->id}}" id="{{$id[0]->id}}" onclick="competence();" title="ajouter une nouvelle competence">
                                <i class='bx bx-plus-medical bx_ajouter'></i>
                            </span>
                            @if(count($competences) > 3)
                                <span class=" ms-2 mb-2 mt-2 pb-2" data-bs-toggle="modal" data-bs-target="#Modal_{{$id[0]->id}}" id="{{$id[0]->id}}" title="modifier les competence">
                                    <i class='bx bx-edit bx_modifier'></i>
                                </span>
                            @endif
                        </div>
                </div>
                {{-- @endif --}}
                <div>
                    <div class="modal fade" id="ModalCompetence_{{$id[0]->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('ajout_competence')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{$id[0]->id}}">
                                    <div class="modal-header">
                                        <h6>Compétences a évaluer</h6>
                                    </div>
                                    <div class="modal-body mt-2 mb-2">
                                        <div class="container">
                                            {{-- <div class="row">
                                                <div class="mt-2 text-center mb-5">
                                                    <span id="addRow" class="btn_nouveau text-center " >
                                                        <i class='bx bx-plus-medical me-1'></i>Ajouter une competence
                                                    </span>

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
                                            </div> --}}
                                            <div class="newRowComp"></div>
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn_fermer" id="fermerComp" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                        <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check-double me-1'></i>Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <?php $i=0 ?>
                    <div class="modal fade" id="Modal_{{$id[0]->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{route('modifier_competence')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" id="id" value="{{$id[0]->id}}">
                                    <div class="modal-header">
                                        <h6>Compétences a évaluer</h6>
                                    </div>
                                    <div class="modal-body mt-2 mb-2">
                                        <div class="container">
                                            @foreach ($competences as $comp)
                                            <div class="d-flex count_input" id="countt_{{$comp->id}}">
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
                                                    @if(count($competences) >= 4)
                                                        <div class="suppre_{{$comp->id}} suppression_competence" role="button" title="Supprimer le competence" id="{{$comp->id}}" data-id="{{$comp->id}}"><i class='bx bx-trash bx_supprimer mt-1 ms-2'></i></div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn_fermer" id="fermer4" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                        <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check-double me-1'></i>Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <?php $i++ ?>
                </div>
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
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control module module input" name="nom_module" required value="{{$res->nom_module}}" placeholder="Nom module" >
                                            <label for="nom_module" class="form-control-placeholder">Nom module</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check-double me-1'></i>Enregistrer</button>
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
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="text" class="form-control module module input" name="description" required value="{{$res->description}}" placeholder="Déscription module" >
                                            <label for="description" class="form-control-placeholder">Déscription</label>
                                        </div>
                                        <div class="text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check-double me-1'></i>Enregistrer</button>
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
                                                @if($res->niveau == 'Débutant')
                                                <option value="{{$res->niveau_id}}" selected>
                                                    {{$res->niveau}} </option>
                                                <option value="2">Intermédiaire</option>
                                                <option value="3">Avancé</option>
                                                <option value="5">Expert</option>
                                                @endif
                                                @if($res->niveau == 'Intermédiaire')
                                                <option value="{{$res->niveau_id}}" selected>
                                                    {{$res->niveau}} </option>
                                                <option value="1">Débutant</option>
                                                <option value="3">Avancé</option>
                                                <option value="5">Expert</option>
                                                @endif
                                                @if($res->niveau == 'Avancé')
                                                <option value="{{$res->niveau_id}}" selected>
                                                    {{$res->niveau}} </option>
                                                <option value="1">Débutant</option>
                                                <option value="2">Intermédiaire</option>
                                                <option value="5">Expert</option>
                                                @endif
                                                @if($res->niveau == 'Expert')
                                                <option value="{{$res->niveau_id}}" selected>
                                                    {{$res->niveau}} </option>
                                                <option value="1">Débutant</option>
                                                <option value="2">Intermédiaire</option>
                                                <option value="3">Avancé</option>
                                                @endif
                                                {{-- @foreach($niveau as $nv)
                                                <option value="{{$nv->id}}" data-value="{{$nv->niveau}}">
                                                    {{$nv->niveau}}</option>
                                                @endforeach --}}
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
                                        <div class="text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check-double me-1'></i>Enregistrer</button>
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
                                <form action="{{route('modification_objectif',$res->module_id)}}" method="POST" id="form_objectif">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Objectif de la formation</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="objectif_textarea" name="objectif" placeholder="Ajouter des textes" style="display: none"></textarea>
                                            <div id="objectif_id">
                                                <p>@php echo html_entity_decode($res->objectif) @endphp</p>
                                            </div>

                                        </div>
                                        <div class="mt-3 text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check-double me-1'></i>Enregistrer</button>
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
                                <form action="{{route('modification_pour_qui',$res->module_id)}}" method="POST" id="form_public">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Public cible</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="public_textarea" name="public_cible" placeholder="Ajouter des textes" style="display: none"></textarea>
                                            <div id="public_id">
                                                <p>@php echo html_entity_decode($res->cible) @endphp</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check-double me-1'></i>Enregistrer</button>
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
                                <form action="{{route('modification_prerequis',$res->module_id)}}" method="POST" id="form_prerequis">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Prérequis</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="prerequis_textarea" name="prerequis" placeholder="Ajouter des textes" style="display: none"></textarea>
                                            <div id="prerequis_id">
                                                <p>@php echo html_entity_decode($res->prerequis) @endphp</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check-double me-1'></i>Enregistrer</button>
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
                                <form action="{{route('modification_equipement',$res->module_id)}}" method="POST" id="form_equipement">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Equipement necessaire</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="equipement_textarea" name="equipement" placeholder="Ajouter des textes" style="display: none"></textarea>
                                            <div id="equipement_id">
                                                <p>@php echo html_entity_decode($res->materiel_necessaire) @endphp</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check-double me-1'></i>Enregistrer</button>
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
                                <form action="{{route('modification_bon_a_savoir',$res->module_id)}}" method="POST" id="form_bon_a_savoir">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Bon à savoir</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="bon_a_savoir_textarea" name="bon_a_savoir" placeholder="Ajouter des textes" style="display: none"></textarea>
                                            <div id="bon_a_savoir_id">
                                                <p>@php echo html_entity_decode($res->bon_a_savoir) @endphp</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check-double me-1'></i>Enregistrer</button>
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
                                <form action="{{route('modification_prestation',$res->module_id)}}" method="POST" id="form_prestation">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center">Préstation pédagogique</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <textarea id="prestation_textarea" name="prestation" placeholder="Ajouter des textes" style="display: none"></textarea>
                                            <div id="prestation_id">
                                                <p>@php echo html_entity_decode($res->prestation) @endphp</p>
                                            </div>
                                        </div>
                                        <div class="mt-3 text-center">
                                            <button type="button" class="btn btn_fermer" id="fermer1" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                            <button type="submit" class="btn btn_enregistrer "><i class='bx bx-check-double me-1'></i>Enregistrer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" class="form-control" name="recuperer_module_id" id="mod_id_rec" value="{{$res->module_id}}">
                {{-- modification niveau --}}
                {{-- <div class="modal" tabindex="-1" role="dialog" id="ouvrir_flottant">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Changer le niveau</h5>
                            </div>
                            <div class="modal-body">
                                <div class="col-lg-12">
                                    <div id="myDIV" class="card" >
                                        <table class="table">
                                            <tbody>
                                                @foreach($niveau as $nv)
                                                <tr align="center">
                                                    <td>{{$nv->niveau}}</td>
                                                    <td align="center"><a href="{{route('supprimer_niveau',$nv->id)}}"><i class="bx bx-trash bx_supprimer"></i></a></td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="text-center mb-3">
                                            <button type="button" class="btn btn_fermer" data-bs-dismiss="modal"> <i class='bx bx-block me-1'></i>Fermer</button>
                                        </div>
                                        <div id="mydiv" class="text-center px-2 mt-3">
                                            <form action="{{route('enregistrer_niveau')}}" method="POST">
                                                @csrf
                                                <input type="text" class="form-control mb-2 input" name="niveau" placeholder="Nouveau Niveau" required>
                                                <button type="submit" class="btn btn_enregistrer mb-3" ><i class='bx bx-check-double me-1'></i>Enregistrer</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.quilljs.com/1.0.0/quill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="{{ asset('js/module_programme.js') }}"></script>
<script>

    $('.modifier_cours').on('click',function(e){
        let id = $(e.target).closest('.modifier_cours').attr("id");
        $.ajax({
            type: "get"
            , url: "{{route('load_cours_programme')}}"
            ,dataType: "json"
            , data: {
                Id: id
            }
            , success: function(response) {
                let userData = response;
                console.log(userData);
                let html = '';
                if (userData['cours'] != null || undefined) {
                    // for (let $l = 0; $l < userData['cours'].length; $l++) {
                        html += '<input type="hidden" value="'+userData['cours'][0]['programme_id']+'" name="id_prog">';
                        html += '<div class="form-row">';
                        html +=     '<label for="" class="mb-2">Titre de Section</label>';
                        html +=     '<input type="text" name="titre_prog" class="w-100  titre_{{$i}} input" value="'+userData['cours'][0]['titre']+'">';
                        html +=     '<hr>'
                        html +=     '<label for="" class="mb-2">Liste des Points en Cours</label>';

                        html +=     '<div class="d-flex flex-column">'
                        html +=         '<?php $j=0 ?>';
                                        for (let $k = 0; $k < userData['cours'].length; $k++) {
                                            if (userData['cours'][0]['programme_id'] == userData['cours'][$k]['programme_id']) {
                        html +=                 '<input type="text" name="cours_'+userData['cours'][$k]['programme_id']+'_'+userData['cours'][$k]['cours_id']+'" class="w-100 cours_'+$k+' input mb-2" value="'+userData['cours'][$k]['titre_cours']+'" required>';
                        html +=                 '<input type="hidden" name="id_cours_'+userData['cours'][$k]['programme_id']+'_'+userData['cours'][$k]['cours_id']+'" value="'+userData['cours'][$k]['cours_id']+'">';
                                            }
                                        }
                        html +=     '</div>'
                        html += '</div>'
                    // }
                }else{
                    alert('error');
                }
                $('.rowModifier').empty();
                $('.rowModifier').append(html);
                $('#Modal_'+ id).modal('show');

            }
            , error: function(error) {
                console.log(JSON.parse(error));
                // console.log(JSON.stringify(error));
            }
        });
    });


    $('.retour_back').on('click', function (e) {
        localStorage.setItem('ActiveTabMod', '#publies');
    });
    // localStorage.setItem('popupShown', 'true');

    if(localStorage.getItem('popState') != 'shown'){
        $("#popup").delay(200).fadeIn();
        localStorage.setItem('popState','shown');
    }

    $('#popup').click(function(e) // You are clicking the close button
    {
        $('#popup').fadeOut(); // Now the pop up is hiden.
    });

    if(localStorage.getItem('popState') == 'shown'){
        $("#popup").hide();
    }

    $('.aide_pogramme').click(function(e){
        if (this.classList.contains('active')) {
            this.classList.remove('active');
        } else {
            this.classList.add('active');
        }
    });

    $('.aide_competence').click(function(e){
        if (this.classList.contains('active')) {
            this.classList.remove('active');
        } else {
            this.classList.add('active');
        }
    });

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

// function changer_niveau() {
//     var x = document.getElementById("myDIV");
//         $('.dismis_buton').show();
//         $("#ouvrir_flottant").modal("show");
// }

// $('.hors_ligne_redirect').on('click', function (e) {
//         localStorage.setItem('ActiveTabMod', '#hors_ligne');
//     });


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
        }
        ,error: function(error){
            console.log(error);
        }
    });
};

</script>
@endsection