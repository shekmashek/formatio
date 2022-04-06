@extends('./layouts/admin')
@section('content')
<style>
    .status_grise{
    margin: 0 2px;
    padding: 4px 6px;
    font-size: 10px;
    font-weight: bold;
    height: 50%;
    border-radius: 1rem;
    background-color: rgb(150, 144, 144);
    color: white;
}
.status_annule{
    margin: 0 2px;
    padding: 4px 6px;
    font-size: 10px;
    font-weight: bold;
    height: 50%;
    border-radius: 1rem;
    background-color: rgb(184, 3, 3);
    color: white;
}
.status_termine{
    margin: 0 2px;
    padding: 4px 6px;
    font-size: 10px;
    font-weight: bold;
    height: 50%;
    border-radius: 1rem;
    background-color: green;
    color: white;
}
.status_confirme{
    margin: 0 2px;
    padding: 4px 6px;
    font-size: 10px;
    font-weight: bold;
    height: 50%;
    border-radius: 1rem;
    background-color: #801D68;
    color: white;
}
.status_archive{
    margin: 0 2px;
    padding: 4px 6px;
    font-size: 10px;
    font-weight: bold;
    height: 50%;
    border-radius: 1rem;
    background-color: orangered;
    color: white;
}
.statut_active{
    margin: 0 2px;
    font-size: 10px;
    height: 50%;
    font-weight: bold;
    padding: 4px 6px;
    border-radius: 1rem;
    background-color: rgb(15,126,145);
    color: whitesmoke;
}

/* .filter{
    position: relative;
    bottom: .5rem;
    float: right;
} */
.btn_creer{
    background-color: white;
    border: none;
    border-radius: 30px;
    padding: .2rem 1rem;
    color: black;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
}

.btn_creer a{
    font-size: .8rem;
    position: relative;
    bottom: .2rem;
}

.btn_creer:hover{
    background: #6373812a;
    color: blue;
}

.btn_creer:focus{
    color: blue;
    text-decoration: none;
}

.icon_creer{
    background-image: linear-gradient(60deg, #f206ee, #0765f3);
    background-clip: text;
    -webkit-background-clip: text;
    color: transparent;
    font-size: 1.5rem;
    position: relative;
    top: .4rem;
    margin-right: .3rem;
}

.pagination{
    background-clip: text;
    margin-right: .3rem;
    font-size: 2.5rem; 
    position: relative; 
    top: .4rem;
}

/* .pagination:hover{
    color: #ffffff;
    background-color: rgb(214, 212, 212);
    border-radius: 1.3rem;
} */
.nombre_pagination{
    color: #626262;

}
</style>
    <link rel="stylesheet" href="{{ asset('assets/css/projets.css') }}">
    <div class="container-fluid mb-5">
        <div class="d-flex flex-row justify-content-end">
            <span class="nombre_pagination"><span style="position: relative; bottom: .35rem">1-5 sur 23</span>
                @if ($page == 1)
                    <a href="{{ route('liste_projet',[1,$page-1]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                    <a href="{{ route('liste_projet',[1,$page+1]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
                @elseif ($page == $fin_page)
                    <a href="{{ route('liste_projet',[1,$page-1]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                    <a href="{{ route('liste_projet',[1,$page+1]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                @else
                    <a href="{{ route('liste_projet',[1,$page-1]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                    <a href="{{ route('liste_projet',[1,$page+1]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
                @endif
            </span>
            <a href="" class="btn_creer text-center filter mt-2"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
        </div>
        
        <div class="row w-100">
            <div class="col-12 ps-5">
                <div class="row">
                @canany(['isCFP'])
                    <div class="m" id="corps">
                        @if (count($projet) <= 0)
                            <div class="row d-flex mt-3 titre_projet p-1 mb-1">
                                <p class="text-center text_aucun">Vous n'avez pas encore du projet.</p>
                            </div>
                        @endif
                        @foreach ($projet as $prj)

                                <div class="row mt-3 titre_projet p-1 mb-1 w-100">

                                    <div class="col-4 p-0"><h6 class="mb-0 changer_carret d-flex pt-2" data-bs-toggle="collapse"
                                        href="#collapseprojet_{{ $prj->projet_id }}" role="button" aria-expanded="false"
                                        aria-controls="collapseprojet"><i class="bx bx-caret-down carret-icon"></i>&nbsp;
                                        @php if ($prj->totale_session == 1) {
                                                    echo $prj->nom_projet . ' ' . $prj->totale_session . ' session';
                                                } elseif ($prj->totale_session > 1) {
                                                    echo $prj->nom_projet . ' ' . $prj->totale_session . ' sessions';
                                            }
                                        @endphp
                                        &nbsp;&nbsp;&#10148;&nbsp;@php
                                            setlocale(LC_TIME, 'fr_FR');
                                        echo strftime('%d %B, %Y', strtotime($prj->date_projet)); @endphp @if ($type_formation_id == 1)
                                            {{-- {{ $data[0]->nom_etp }} --}}
                                        @endif
                                        &nbsp;&nbsp;</h6>
                                    </div>
                                    <div class="col-1 p-0">
                                        @if ($prj->type_formation_id == 1)
                                            <h6 class="m-0"><button
                                                    class="type_intra mt-1 m-0 filtre_projet">{{ $prj->type_formation }}</button></h6>
                                            &nbsp;&nbsp;
                                        @elseif ($prj->type_formation_id == 2)
                                            <h6 class="m-0"><button
                                                    class="type_inter mt-1 m-0">{{ $prj->type_formation }}</button></h6>&nbsp;&nbsp;
                                        @endif
                                    </div>
                                    <div class="col-3 p-0">
                                        @foreach ($projet_formation as $pf)
                                        @if ($pf->projet_id == $prj->projet_id)
                                            <h6 class="m-0"><label
                                                    class="projet_formation mt-1 m-0">{{ $pf->nom_formation }}</label></h6>
                                            &nbsp;&nbsp;
                                        @endif
                                        @endforeach
                                    </div>

                                    <div class="col-3 text-end p-0">
                                        @can('isCFP')
                                            @if ($prj->type_formation_id == 1)
                                                <span type="button" class=" m-0 nouvelle_session text-end" data-bs-toggle="modal"
                                                    data-bs-target="#modal_{{ $prj->projet_id }}"><i class="bx bx-plus-circle btn_plus"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Nouvelle session">Ajouter une session</i></span>
                                            @endif
                                        @endcan
                                    </div>
                            </div>

                            <table class="table table-stripped m-0 p-0 collapse" id="collapseprojet_{{ $prj->projet_id }}">
                                <thead class="thead_projet">
                                    <th> Session </th>
                                    <th> Module </th>
                                    {{-- @can('isCFP')
                                        @if ($prj->type_formation_id == 1)
                                            <th> Entreprise </th>
                                        @endif
                                    @endcan --}}
                                    @can('isReferent')
                                        @if ($prj->type_formation_id == 1)
                                            <th> Centre de formation </th>
                                        @endif
                                    @endcan
                                    <th> Date du projet</th>

                                    <th> Statut </th>
                                    @can('isCFP')
                                        <th></th>
                                    @endcan
                                    @if ($prj->type_formation_id == 1)
                                        <th></th>
                                    @endif
                                </thead>
                                <tbody class="tbody_projet">

                                    @if ($prj->totale_session <= 0)
                                        <tr>
                                            <td colspan="5"> Aucun session</td>

                                        </tr>
                                    @else
                                        @foreach ($data as $pj)
                                            @if ($prj->projet_id == $pj->projet_id)
                                                <tr>
                                                    <td> <a
                                                            href="{{ route('detail_session', [$pj->groupe_id,$prj->type_formation_id]) }}">{{ $pj->nom_groupe }}</a>
                                                    </td>
                                                    <td>{{ $pj->nom_module }}</td>
                                                    {{-- @can('isCFP')
                                                        @if ($pj->type_formation_id == 1)
                                                            <td> {{ $pj->nom_etp }} </td>
                                                        @endif
                                                    @endcan --}}
                                                    @can('isReferent')
                                                        @if ($pj->type_formation_id == 1)
                                                            <td> {{ $pj->nom_cfp }} </td>
                                                        @endif
                                                    @endcan
                                                    {{-- @can('isCFP')
                         @if ($pj->type_formation_id == 1)<td> {{ $pj->nom_etp }} </td>@endif
                        @endcan --}}
                                                    <td> {{ $pj->date_debut . ' au ' . $pj->date_fin }} </td>
                                                    <td>
                                                        <div class="{{ $pj->class_status_groupe }}">{{ $pj->item_status_groupe }}</div>
                                                    </td>
                                                    @can('isCFP')
                                                    <td><a href="" aria-current="page" data-bs-toggle="modal"
                                                        style="background:none; color:rgb(130,33,100);" data-bs-target="#modal_modifier_session_{{ $pj->groupe_id }}"><i
                                                        class="fa fa-edit ms-2"></i></a></td>
                                                    @endcan
                                                    @if ($prj->type_formation_id == 1)
                                                        <td>
                                                            <a style="background: none" href="{{ route('nouveauRapportFinale',[$pj->groupe_id]) }}"><button class="btn rapport_finale">Rapport</button></a>
                                                        </td>
                                                    @endif

                                                    {{-- <td><i type="button" class="fa fa-edit" data-bs-toggle="modal"
                                data-bs-target="#edit_prj_{{ $pj->projet_id }}"></i></td> --}}
                                                    {{-- Debut modal edit session --}}
                                                    <div class="modal fade"
                                                        id="modal_modifier_session_{{ $pj->groupe_id }}">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content p-3">
                                                                <div class="modal-title pt-3"
                                                                    style="height: 50px; align-items: center;">
                                                                    <h5 class="text-center my-auto">Modifier session <strong>{{ $pj->nom_groupe }}</strong></h5>
                                                                </div>
                                                                @if ($prj->type_formation_id == 1)
                                                                    <div class="row">
                                                                        <form action="{{ route('modifier_session_inter') }}" id="formPayement" method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="id" value="{{ $pj->groupe_id }}">
                                                                            <div class="row">
                                                                                <div class="form-group">
                                                                                    <div class="form-row d-flex">
                                                                                        <div class="col">
                                                                                            <div class="row px-3 mt-2">
                                                                                                <div class="form-group mt-1 mb-1">
                                                                                                    <input type="text" id="min" class="form-control input" name="date_debut"
                                                                                                        required onfocus="(this.type='date')" value="{{date('d/m/Y',strtotime($pj->date_debut))}}">
                                                                                                    <label class="ml-3 form-control-placeholder" for="min">Date debut du session<strong
                                                                                                        class="text-danger">*</strong></label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row px-3 mt-2">
                                                                                                <div class="form-group mt-1 mb-1">
                                                                                                    <select class="form-select selectP input" id="formation_session_id" name="formation_id"
                                                                                                        aria-label="Default select example">
                                                                                                        <option value="{{ $pj->formation_id }}">{{ $pj->nom_formation }}</option>
                                                                                                        @foreach ($formation as $form)
                                                                                                        <option value="{{$form->id}}">{{$form->nom_formation}}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                    <label class="ml-3 form-control-placeholder" for="formation_id">Formations<strong
                                                                                                        class="text-danger">*</strong></label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row px-3 mt-2">
                                                                                                <div class="form-group mt-1 mb-1">
                                                                                                    <select class="form-select selectP input" id="payement_id" name="payement"
                                                                                                        aria-label="Default select example">
                                                                                                        <option value="{{ $pj->type_payement_id }}" hidden>{{ $pj->type }}</option>
                                                                                                        @foreach ($payement as $paye)
                                                                                                        <option value="{{ $paye->id }}">{{ $paye->type }}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                    <label class="ml-3 form-control-placeholder" for="payement_id">Mode de Payement<strong
                                                                                                        class="text-danger">*</strong></label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row px-3 mt-2">
                                                                                                <div class="form-group mt-1 mb-1">
                                                                                                    <input type="text" id="min" class="form-control input" min="1" max="50" name="min_part"
                                                                                                        required onfocus="(this.type='number')" value="{{ $pj->min_participant }}">
                                                                                                    <label class="ml-3 form-control-placeholder" for="min">Nombre de participant
                                                                                                        minimal</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="text-center "><button type="submit" form="formPayement" class="btn btn_enregistrer">Valider</button></div>
                                                                                        </div>
                                                                                        <div class="col">
                                                                                            <div class="row px-3 mt-2">
                                                                                                <div class="form-group mt-1 mb-1">
                                                                                                    <input type="text" id="min" class="form-control input" name="date_fin"
                                                                                                        required onfocus="(this.type='date')" value="{{date('d/m/Y',strtotime($pj->date_fin))}}">
                                                                                                    <label class="ml-3 form-control-placeholder" for="min">Date fin du session<strong
                                                                                                        class="text-danger">*</strong></label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row px-3 mt-2">
                                                                                                <div class="form-group mt-1 mb-1">
                                                                                                    <select class="form-select selectP input" id="module_id" name="module_id"
                                                                                                        aria-label="Default select example">
                                                                                                        <option {{ $pj->module_id }}>{{ $pj->nom_module }}</option>
                                                                                                        @foreach ($module as $mod)
                                                                                                        <option value="{{$mod->id}}">{{$mod->nom_module}}</option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                    <label class="ml-3 form-control-placeholder" for="module_id">Modules<strong
                                                                                                        class="text-danger">*</strong></label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row px-3 mb-5 mt-2">
                                                                                                <div class="form-group mt-1 mb-1">
                                                                                                    <input type="text" id="min" class="form-control input" min="1" max="50" name="max_part"
                                                                                                        required onfocus="(this.type='number')" value="{{ $pj->max_participant }}">
                                                                                                    <label class="ml-3 form-control-placeholder" for="min">Nombre de participant
                                                                                                        maximal</label>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row px-3">
                                                                                                <div class="form-group mt-2">
                                                                                                   
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="text-center mt-5"><button type="button" class="btn  btn_annuler" data-bs-dismiss="modal">Annuler</button></div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        </form>
                                                                    </div>
                                                                @endif
                                                                @if ($prj->type_formation_id == 2)
                                                                    <div class="row">
                                                                        <div class="form-group">
                                                                            <div class="form-row d-flex">
                                                                                <div class="col">
                                                                                    <div class="row px-3 mt-2">
                                                                                        <div class="form-group mt-1 mb-1">
                                                                                            <input type="text" id="min"
                                                                                                class="form-control input"
                                                                                                name="date_debut" required
                                                                                                onfocus="(this.type='date')" value="{{date('d/m/Y',strtotime($pj->date_debut))}}">
                                                                                            <label
                                                                                                class="form-control-placeholder"
                                                                                                for="min">Date debut<strong
                                                                                                class="text-danger">*</strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row px-3 mt-2">
                                                                                        <div class="form-group mt-1 mb-1">
                                                                                            <input type="text" id="min"
                                                                                                class="form-control input"
                                                                                                min="1" max="50"
                                                                                                name="min_part" required
                                                                                                onfocus="(this.type='number')" value="{{ $pj->min_participant }}">
                                                                                            <label
                                                                                                class="form-control-placeholder"
                                                                                                for="min">Participant
                                                                                                minimal</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                    <div class="text-center px-3"><button
                                                                                            type="submit"
                                                                                            class="btn btn_enregistrer">Valider</button>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col">
                                                                                    <div class="row px-3 mt-2">
                                                                                        <div class="form-group mt-1 mb-1">
                                                                                            <input type="text" id="min"
                                                                                                class="form-control input"
                                                                                                name="date_fin" required
                                                                                                onfocus="(this.type='date')" value="{{date('d/m/Y',strtotime($pj->date_fin)) }}">
                                                                                            <label
                                                                                                class=" form-control-placeholder"
                                                                                                for="min">Date fin<strong
                                                                                                class="text-danger">*</strong></label>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row px-3 mt-2">
                                                                                        <div class="form-group mt-1 mb-1">
                                                                                            <input type="text" id="min"
                                                                                                class="form-control input"
                                                                                                min="1" max="50"
                                                                                                name="max_part" required
                                                                                                onfocus="(this.type='number')" value="{{ $pj->max_participant }}">
                                                                                            <label
                                                                                                class="form-control-placeholder"
                                                                                                for="min">Participant
                                                                                                maximal</label>
                                                                                        </div>
                                                                                    </div>
                                                                                    

                                                                                    <div class="text-center px-3"><button
                                                                                            type="button"
                                                                                            class="btn btn_annuler"
                                                                                            data-bs-dismiss="modal"
                                                                                            aria-label="Close">Annuler</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>    
                                                        </div>
                                                    </div>
                                                    {{-- Fin modal edit session --}}
                                                    {{-- debut modal edit projet --}}
                                                    <div id="edit_prj_{{ $pj->projet_id }}" class="modal fade modal_projets"
                                                        data-backdrop="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="text-center w-100">Modification de la Status du
                                                                        Session dans le&nbsp;{{$pj->nom_projet }}
                                                                    </h5>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('update_projet', $pj->projet_id) }}"
                                                                        id="zsxsq" method="POST">
                                                                        @csrf
                                                                        <div class="row px-3 mt-2">
                                                                            <div class="form-group mt-1 mb-1">
                                                                                <select class="form-select selectP input"
                                                                                    id="formation_id" name="formation_id"
                                                                                    aria-label="Default select example">
                                                                                    <option onselected hidden>choisir la status
                                                                                        du session</option>
                                                                                    @foreach ($status as $stat)
                                                                                        <option value="{{ $stat->id }}">
                                                                                            {{ $stat->status }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <label class="ml-3 form-control-placeholder"
                                                                                    for="formation_id">Status</label>
                                                                            </div>
                                                                        </div>


                                                                        <div class="mt-4 mb-4">
                                                                            <div
                                                                                class="mt-4 mb-4 d-flex justify-content-around">
                                                                                <div class="text-center px-3"><button
                                                                                        type="submit" form="formPayement"
                                                                                        class="btn btn_enregistrer">Valider</button>
                                                                                </div>
                                                                                <div class="text-center px-3"><button
                                                                                        type="button" class="btn btn_annuler"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close">Annuler</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    {{-- fin --}}
                                                    {{-- debut modal nouveau session --}}
                                                    <div id="modal_{{ $pj->projet_id }}" class="modal fade modal_projets"
                                                        data-backdrop="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="w-100 text-center">Nouvelle Session pour
                                                                        le&nbsp;{{$pj->nom_projet }}
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('insert_session') }}"
                                                                         method="POST"
                                                                        class="justify-content-center me-5">
                                                                        @csrf
                                                                        <input type="hidden" name="type_formation" value="1">
                                                                        <input type="hidden" name="projet"
                                                                            value="{{ $pj->projet_id }}">
                                                                        <div class="row">
                                                                            <h5 class="mb-4 text-center">Ajouter votre nouvelle
                                                                                Session</h5>
                                                                            <div class="form-group">
                                                                                <div class="form-row d-flex">
                                                                                    <div class="col">
                                                                                        <div class="row px-3 mt-2">
                                                                                            <div class="form-group mt-1 mb-1">
                                                                                                <input type="text" id="min"
                                                                                                    class="form-control input"
                                                                                                    name="date_debut" required
                                                                                                    onfocus="(this.type='date')">
                                                                                                <label
                                                                                                    class="form-control-placeholder"
                                                                                                    for="min">Date debut<strong
                                                                                                    class="text-danger">*</strong></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row px-3 mt-2">
                                                                                            <div class="form-group mt-1 mb-1">
                                                                                                <input type="text" id="min"
                                                                                                    class="form-control input"
                                                                                                    min="1" max="50"
                                                                                                    name="min_part" required
                                                                                                    onfocus="(this.type='number')">
                                                                                                <label
                                                                                                    class="form-control-placeholder"
                                                                                                    for="min">Participant
                                                                                                    minimal</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        
                                                                                        <div class="text-center px-3"><button
                                                                                                type="submit"
                                                                                                class="btn btn_enregistrer">Valider</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="row px-3 mt-2">
                                                                                            <div class="form-group mt-1 mb-1">
                                                                                                <input type="text" id="min"
                                                                                                    class="form-control input"
                                                                                                    name="date_fin" required
                                                                                                    onfocus="(this.type='date')">
                                                                                                <label
                                                                                                    class=" form-control-placeholder"
                                                                                                    for="min">Date fin<strong
                                                                                                    class="text-danger">*</strong></label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row px-3 mt-2">
                                                                                            <div class="form-group mt-1 mb-1">
                                                                                                <input type="text" id="min"
                                                                                                    class="form-control input"
                                                                                                    min="1" max="50"
                                                                                                    name="max_part" required
                                                                                                    onfocus="(this.type='number')">
                                                                                                <label
                                                                                                    class="form-control-placeholder"
                                                                                                    for="min">Participant
                                                                                                    maximal</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        

                                                                                        <div class="text-center px-3"><button
                                                                                                type="button"
                                                                                                class="btn btn_annuler"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close">Annuler</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- fin --}}
                                                </tr>
                                                @if ($prj->type_formation_id == 2)
                                                    @break
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                @endcanany
                @can('isFormateur')
                    @if (count($data) <= 0)
                        <div class="d-flex mt-3 titre_projet p-1 mb-1">
                            <span class="text-center">Vous n'avez pas encore du projet.</span>
                        </div>
                    @else
                        <table class="table table-stroped m-0 p-0 mt-2">
                            <thead class="thead_projet">
                                <th>Projet</th>
                                <th>Type de formation</th>
                                <th> Session </th>
                                <th>Date session</th>
                                <th> Centre de formation </th>
                                <th> Date du projet</th>

                                <th> Statut </th>
                            </thead>
                            <tbody class="tbody_projet">
                                @foreach ($data as $pj)
                                    <tr class="m-0">
                                        <td>{{ $pj->nom_projet }}</td>
                                        <td>
                                            @if ($pj->type_formation_id == 1)
                                            <h6 class="m-0"><button
                                                    class="type_intra m-0 filtre_projet">{{ $pj->type_formation }}</button></h6>
                                            &nbsp;&nbsp;
                                            @elseif ($pj->type_formation_id == 2)
                                                <h6 class="m-0"><button
                                                        class="type_inter m-0">{{ $pj->type_formation }}</button></h6>&nbsp;&nbsp;
                                            @endif
                                        </td>
                                        <td> <a
                                            href="{{ route('detail_session', [$pj->groupe_id,$pj->type_formation_id]) }}">{{ $pj->nom_groupe }}</a>
                                        </td>
                                        <td> {{ $pj->date_debut . ' au ' . $pj->date_fin }} </td>
                                        <td> {{ $pj->nom_cfp }} </td>
                                        <td> {{ date('d-m-Y', strtotime($pj->date_projet)) }} </td>
                                        <td>
                                            <p class="en_cours m-0 p-0">{{ $pj->item_status_groupe }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endcan
                @can('isReferent')
                    @if (count($data) <= 0)
                        <div class="d-flex mt-3 titre_projet p-1 mb-1">
                            <span class="text-center">Vous n'avez pas encore du projet.</span>
                        </div>
                    @else
                        <table class="table table-stroped m-0 p-0 mt-2">
                            <thead class="thead_projet">
                                <th>Projet</th>
                                <th>Type de formation</th>
                                <th> Session </th>
                                <th>Date session</th>
                                <th> Centre de formation </th>
                                {{-- <th> Date du projet</th> --}}

                                <th> Statut </th>
                            </thead>
                            <tbody class="tbody_projet">
                                @foreach ($data as $pj)
                                    <tr class="m-0">
                                        <td>{{ $pj->nom_projet }}</td>
                                        <td>
                                            @if ($pj->type_formation_id == 1)
                                            <h6 class="m-0"><button
                                                    class="type_intra m-0 filtre_projet">{{ $pj->type_formation }}</button></h6>
                                            &nbsp;&nbsp;
                                            @elseif ($pj->type_formation_id == 2)
                                                <h6 class="m-0"><button
                                                        class="type_inter m-0">{{ $pj->type_formation }}</button></h6>&nbsp;&nbsp;
                                            @endif
                                        </td>
                                        <td> <a
                                                href="{{ route('detail_session', [$pj->groupe_id,$pj->type_formation_id]) }}">{{ $pj->nom_groupe }}</a>
                                        </td>
                                        <td> {{ $pj->date_debut . ' au ' . $pj->date_fin }} </td>
                                        <td> {{ $pj->nom_cfp }} </td>
                                        {{-- <td> {{ date('d-m-Y', strtotime($pj->date_projet)) }} </td> --}}
                                        <td>
                                            <p class="en_cours m-0 p-0">{{ $pj->item_status_groupe }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endcan
                @can('isStagiaire')
                    @if (count($data) <= 0)
                        <div class="d-flex mt-3 titre_projet p-1 mb-1">
                            <span class="text-center">Vous n'avez pas encore du projet.</span>
                        </div>
                    @else
                        <table class="table table-stroped m-0 p-0">
                            <thead class="thead_projet">
                                {{-- <th>Projet</th> --}}
                                <th> Session </th>
                                <th> Date du session</th>
                                <th> Centre de formation </th>
                                <th> Formation </th>
                                <th> Module</th>
                                <th>Evaluation </th>
                            </thead>
                            <tbody class="tbody_projet">
                                @foreach ($data as $pj)
                                    <tr>
                                        {{-- <td>{{ $pj->nom_projet }}</td> --}}
                                        <td> {{ $pj->nom_groupe }}</td>
                                        <td> {{ date('d-m-Y', strtotime($pj->date_debut)) }}-{{ date('d-m-Y', strtotime($pj->date_fin)) }}
                                        </td>
                                        <td> {{ $pj->nom_cfp }} </td>
                                        <td> {{ $pj->nom_formation }} </td>
                                        <td> {{ $pj->nom_module }} </td>
                                        <td>
                                            @if ($pj->statut_eval == 0)
                                                <a class="btn btn_filtre filtre_appliquer"
                                                href="{{ route('faireEvaluationChaud', [$pj->groupe_id]) }}">Evaluation</a>
                                            @elseif ($pj->statut_eval == 1)
                                                <p style="color: green">Evaluation terminé</p>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    @endcan

                    <div>
                        {{-- {!! $projet->links() !!} --}}
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="{{ asset('js/index2.js') }}"></script>
        <script>
            $("#formation_session_id").on("change", function() {
                var id = $("#formation_session_id").val();
                $("#module_id option").remove();
                $.ajax({
                    method: "GET",
                    url: "{{ route('module_formation') }}",
                    data: {
                        id: id,
                    },
                    dataType: "html",
                    _token: "{{ csrf_token() }}",
                    success: function(response) {
                        var data = JSON.parse(response);
                        if (data.length <= 0) {
                            document.getElementById("module_id_err").innerHTML =
                                "Aucun module a été détecter! veuillez choisir la formation";
                        } else {
                            // document.getElementById("module_id_err").innerHTML = "";
                            for (var $i = 0; $i < data.length; $i++) {
                                $("#module_id").append(
                                    '<option value="' +
                                        data[$i].id +
                                        '">' +
                                        data[$i].nom_module +
                                        "</option>"
                                );
                            }
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            });
        
        </script>
    @endsection
