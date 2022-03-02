@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/projets.css')}}">
<div class="container pt-5">
    {{-- <div class="row">
        <h5 class="my-3 text-center text-capitalize">le projet de formation inter entreprise</h5>
        <form action="{{ route('nouveau_session_inter',['type_formation'=>2]) }}" id="formPayement" method="POST" class="form_session">
            @csrf
            <div class="row">
                <h5 class="mb-4 text-center">Ajouter votre nouvelle Session</h5>
                <div class="form-group">
                    <div class="form-row d-flex">
                        <div class="col">
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" min="1" max="50"
                                        name="nb_participant_min" required onfocus="(this.type='number')">
                                    <label class="ml-3 form-control-placeholder" for="min">Nombre de participant
                                        minimal</label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" name="date_debut"
                                        required onfocus="(this.type='date')">
                                    <label class="ml-3 form-control-placeholder" for="min">Date debut du session</label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <select class="form-select selectP input" id="formation_id" name="formation_id"
                                        aria-label="Default select example">
                                        <option onselected>choisir la formation du session</option>
                                        @foreach ($formations as $form)
                                        <option value="{{$form->id}}">{{$form->nom_formation}}</option>
                                        @endforeach
                                    </select>
                                    <label class="ml-3 form-control-placeholder" for="formation_id">Formations</label>
                                </div>
                            </div>
                            <div class="text-center "><button type="submit" form="formPayement"
                                    class="btn btn_enregistrer">Valider</button></div>
                        </div>
                        <div class="col">
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" min="1" max="50"
                                        name="nb_participant_max" required onfocus="(this.type='number')">
                                    <label class="ml-3 form-control-placeholder" for="min">Nombre de participant
                                        maximal</label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" name="date_fin"
                                        required onfocus="(this.type='date')">
                                    <label class="ml-3 form-control-placeholder" for="min">Date fin du session</label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <select class="form-select selectP input" id="module_id" name="module_id"
                                        aria-label="Default select example">
                                        <option onselected>Choisir la module du session</option>
                                        @foreach ($modules as $mod)
                                        <option value="{{$mod->id}}">{{$mod->nom_module}}</option>
                                        @endforeach
                                    </select>
                                    <label class="ml-3 form-control-placeholder" for="module_id">Modules</label>
                                    <span style="color:#ff0000;" id="module_id_err">Aucun module détecté! veuillez
                                        choisir la formation</span>
                                </div>
                            </div>
                            <div class="text-center "><button type="button" class="btn  btn_annuler"
                                    data-dismiss="modal">Annuler</button></div>
                        </div>
                    </div>
                </div>
        </form>
    </div> --}}
    <h5 class="my-3 text-center text-capitalize">le projet de formation inter entreprise</h5>
    <div class="m-4">
        <h6>Listes des formations disponibles</h6>
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">

            <li class="nav-item">
                <a href="#formation_{{$formations[0]->id}}" class="nav-link active"
                    data-bs-toggle="tab">{{$formations[0]->nom_formation}}</a>
            </li>
            {{-- indice 0 par defaut active --}}
            @foreach ($formations as $frm)
            @if($formations[0]->id!=$frm->id)
            <li class="nav-item">
                <a href="#formation_{{$frm->id}}" class="nav-link" data-bs-toggle="tab">{{$frm->nom_formation}}</a>
            </li>
            @endif


            @endforeach
        </ul>

        <div class="tab-content">
            {{-- indice 0 par defaut active --}}
            @foreach ($modules as $mod1)
            @if ($formations[0]->id == $mod1->formation_id)
            <div class="tab-pane fade show active " id="formation_{{$formations[0]->id}}">
                <div class="container d-flex flex-wrap">
                    @foreach ($modules as $mod1)
                    @if($mod1->formation_id === $formations[0]->id)
                    <div class="row detail__formation__result new_card_module bg-light mb-3" id="border_premier">
                        <div class="detail__formation__result__content">
                            <div class="detail__formation__result__item ">
                                <h4 class="mt-3"><span id="preview_categ"><span
                                            class=" acf-categorie">{{$mod1->nom_formation}}</span></span><span>&nbsp;-&nbsp;</span>
                                    <span></span>
                                    <span id="preview_module"><span
                                            class="acf-nom_module">{{$mod1->nom_module}}</span></span>
                                </h4>
                                <p id="preview_descript"><span class="acf-description"
                                        style="font-size: 0.850rem">{{$mod1->description}}</span></p>
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
                                                echo number_format($mod1->prix, 0, ' ', ' ');
                                                @endphp
                                                &nbsp;AR</span>&nbsp;HT
                                        </p>
                                        @if($mod1->min != 0 && $mod1->max != 0)
                                        <span>{{$mod1->min}}&nbsp;-&nbsp;{{$mod1->max}}&nbsp;personne</span>
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
                                        {{$mod1->duree_jour}}
                                    </span>j</span>
                                <span id="preview_heur">/<span class="acf-heur">
                                        {{$mod1->duree}}
                                    </span>h</span>
                            </div>
                            <div class="col-5" style="font-size: 12px" id="preview_modalite"><i
                                    class="bx bxs-devices bx_icon" style="color: #7635dc !important;"></i>&nbsp;<span
                                    class="acf-modalite">{{$mod1->modalite_formation}}</span>
                            </div>
                            <div class="col-4" style="font-size: 12px" id="preview_niveau">
                                <i class='bx bx-equalizer bx_icon' style="color: #7635dc !important;"></i>&nbsp;<span
                                    class="acf-niveau">{{$mod1->niveau}}</span>
                            </div>

                        </div>

                        <div class="new_btn_programme text-center">
                            <button type="button" class="btn btn_competence non_pub" data-id="{{$mod1->id}}"
                                data-bs-toggle="modal" data-bs-target="#ModalCompetence" id="{{$mod1->id}}">Session
                                Inter</button>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach
            {{-- on boucle les indices different de 0 --}}
            @foreach ($formations as $frm)
            @if($formations[0]->id != $frm->id)
            <div class="tab-pane fade " id="formation_{{$frm->id}}">
                <div class="container d-flex flex-wrap">
                @foreach ($modules as $mod) @if($mod->formation_id === $frm->id)
                    <div class="row detail__formation__result new_card_module bg-light mb-3" id="border_premier">
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
                                            <span class="new_module_prix"
                                                style="color: #7635dc !important; font-weight:500 !important;">
                                                @php
                                                echo number_format($mod->prix, 0, ' ', ' ');
                                                @endphp
                                                &nbsp;AR</span>&nbsp;HT
                                        </p>
                                        @if($mod->min != 0 && $mod->max != 0)
                                        <span>{{$mod->min}}&nbsp;-&nbsp;{{$mod->max}}&nbsp;personne</span>
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
                                    class="bx bxs-devices bx_icon" style="color: #7635dc !important;"></i>&nbsp;<span
                                    class="acf-modalite">{{$mod->modalite_formation}}</span>
                            </div>
                            <div class="col-4" style="font-size: 12px" id="preview_niveau">
                                <i class='bx bx-equalizer bx_icon' style="color: #7635dc !important;"></i>&nbsp;<span
                                    class="acf-niveau">{{$mod->niveau}}</span>
                            </div>

                        </div>

                        <div class="new_btn_programme text-center">
                            <button type="button" class="btn btn_competence non_pub" data-id="{{$mod->id}}"
                                data-bs-toggle="modal" data-bs-target="#ModalCompetence" id="{{$mod->id}}">Session
                                Inter</button>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
            @endforeach


        </div>
    </div>
</div>
<script src="{{asset('js/projet_inter_intra.js')}}"></script>
@endsection