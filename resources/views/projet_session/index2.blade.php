@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Projets</p>
@endsection

@inject('groupe', 'App\groupe')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/projets.css') }}">

    <style>
        .status_grise {
            border-radius: 1rem;
            background-color: #637381;
            color: white;
            align-items: center margin: 0 auto;
        }

        .status_reprogrammer {
            border-radius: 1rem;
            background-color: #00CDAC;
            color: white;
            align-items: center margin: 0 auto;
        }

        .status_cloturer {
            border-radius: 1rem;
            background-color: #314755;
            color: white;
            align-items: center margin: 0 auto;
        }

        .status_reporter {
            border-radius: 1rem;
            background-color: #26a0da;
            color: white;
            align-items: center margin: 0 auto;
        }

        .status_annulee {
            border-radius: 1rem;
            background-color: #b31217;
            color: white;
            align-items: center margin: 0 auto;
        }

        .status_termine {
            border-radius: 1rem;
            background-color: #1E9600;
            color: white;
            align-items: center margin: 0 auto;
        }

        .status_confirme {
            border-radius: 1rem;
            background-color: #2B32B2;
            color: white;
            align-items: center margin: 0 auto;
            padding-end:1rem;
        }

        .statut_active {
            border-radius: 1rem;
            background-color: rgb(15, 126, 145);
            color: whitesmoke;
            align-items: center margin: 0 auto;
        }

        /* .filter{
        position: relative;
        bottom: .5rem;
        float: right;
    } */
        .btn_creer {
            background-color: white;
            border: none;
            border-radius: 30px;
            padding: .2rem 1rem;
            color: black;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        }

        .btn_creer a {
            font-size: .8rem;
            position: relative;
            bottom: .2rem;
        }

        .btn_creer:hover {
            background: #6373812a;
            color: blue;
        }

        .btn_creer:focus {
            color: blue;
            text-decoration: none;
        }

        .icon_creer {
            background-image: linear-gradient(60deg, #f206ee, #0765f3);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            font-size: 1.5rem;
            position: relative;
            top: .4rem;
            margin-right: .3rem;
        }

        .pagination {
            background-clip: text;
            margin-right: .3rem;
            font-size: 2rem;
            position: relative;
            top: .7rem;
        }

        .pagination:hover {
            color: #000000;
            background-color: rgb(239, 239, 239);
            border-radius: 1.3rem;
        }

        .nombre_pagination {
            color: #626262;

        }

    </style>
    <div class="container-fluid mb-5">
        <div class="d-flex flex-row justify-content-end mt-3">
            <span class="nombre_pagination"><span style="position: relative; bottom: -0.2rem">{{ $debut . '-' . $fin }} sur
                    {{ $nb_projet }}</span>
                @if ($nb_par_page >= $nb_projet)
                    <a href="{{ route('liste_projet', [1, $page - 1]) }}" role="button"
                        style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                    <a href="{{ route('liste_projet', [1, $page + 1]) }}" role="button"
                        style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                @elseif ($page == 1)
                    <a href="{{ route('liste_projet', [1, $page - 1]) }}" role="button"
                        style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                    <a href="{{ route('liste_projet', [1, $page + 1]) }}" role="button"><i
                            class='bx bx-chevron-right pagination'></i></a>
                @elseif ($page == $fin_page || $page > $fin_page)
                    <a href="{{ route('liste_projet', [1, $page - 1]) }}" role="button"><i
                            class='bx bx-chevron-left pagination'></i></a>
                    <a href="{{ route('liste_projet', [1, $page + 1]) }}" role="button"
                        style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                @else
                    <a href="{{ route('liste_projet', [1, $page - 1]) }}" role="button"><i
                            class='bx bx-chevron-left pagination'></i></a>
                    <a href="{{ route('liste_projet', [1, $page + 1]) }}" role="button"><i
                            class='bx bx-chevron-right pagination'></i></a>
                @endif
            </span>
            <a href="#" class="btn_creer text-center filter mt-3" role="button" onclick="afficherFiltre();"><i
                    class='bx bx-filter icon_creer'></i>Afficher les filtres</a>

        </div>
        @if (Session::has('pdf_error'))
            <div class="alert alert-danger ms-4 me-4">
                <ul>
                    <li>{!! \Session::get('pdf_error') !!}</li>
                </ul>
            </div>
        @endif
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
                            @if (Session::has('groupe_error'))
                                <div class="alert alert-danger ms-2 me-2">
                                    <ul>
                                        <li>{!! \Session::get('groupe_error') !!}</li>
                                    </ul>
                                </div>
                            @endif
                            @foreach ($projet as $prj)
                                <div class="row mt-3 titre_projet p-1 mb-1 w-100 g-0">

                                    <div class="col-4 p-0">
                                        <h6><a href="#collapseprojet_{{ $prj->projet_id }}"
                                                class="mb-0 changer_carret d-flex pt-2" data-bs-toggle="collapse"
                                                role="button"><i class="bx bx-caret-down carret-icon"></i>&nbsp;
                                                @php if ($prj->totale_session == 1) {
                                                        echo $prj->nom_projet . ' ' . $prj->totale_session . ' session';
                                                    } elseif ($prj->totale_session > 1) {
                                                        echo $prj->nom_projet . ' ' . $prj->totale_session . ' sessions';
                                                    }elseif ($prj->totale_session == 0) {
                                                        echo $prj->nom_projet ;
                                                    }
                                                @endphp
                                                &nbsp;&nbsp;&#10148;&nbsp;@php
                                                    setlocale(LC_TIME, 'fr_FR');
                                                echo strftime('%d %B, %Y', strtotime($prj->date_projet)); @endphp @if ($type_formation_id == 1)
                                                    {{-- {{ $data[0]->nom_etp }} --}}
                                                @endif
                                                &nbsp;&nbsp;</a></h6>
                                    </div>
                                    <div class="col-1 p-0">
                                        @if ($prj->type_formation_id == 1)
                                            <h6 class="m-0"><button
                                                    class="type_intra mt-1 m-0 filtre_projet">{{ $prj->type_formation }}</button>
                                            </h6>
                                            &nbsp;&nbsp;
                                        @elseif ($prj->type_formation_id == 2)
                                            <h6 class="m-0"><button
                                                    class="type_inter mt-1 m-0">{{ $prj->type_formation }}</button></h6>
                                            &nbsp;&nbsp;
                                        @endif
                                    </div>
                                    <div class="col-3 p-0">
                                        @foreach ($projet_formation as $pf)
                                            @if ($pf->projet_id == $prj->projet_id)
                                                <h6 class="m-0"><label
                                                        class="projet_formation mt-1 m-0">{{ $pf->nom_formation }}</label>
                                                </h6>
                                                &nbsp;&nbsp;
                                            @endif
                                        @endforeach
                                    </div>

                                    <div class="col-3 new_session p-0">
                                        @can('isCFP')
                                            @if ($prj->type_formation_id == 1)
                                                <span role="button" class=" m-0 nouvelle_session " data-bs-toggle="modal"
                                                    data-bs-target="#modal_{{ $prj->projet_id }}" data-backdrop='static'
                                                    title="Nouvelle session"><i class="bx bx-plus-medical me-3"></i>Ajouter une
                                                    session</span>
                                            @endif
                                        @endcan
                                    </div>
                                </div>

                                <table class="table table-hover m-0 p-0 collapse table-borderless"
                                    id="collapseprojet_{{ $prj->projet_id }}"
                                    aria-labelledby="collapseprojet_{{ $prj->projet_id }}">
                                    <thead class="thead_projet" style="border-bottom: 1px solid black; line-height: 20px">
                                        <th> Session </th>
                                        <th> Module </th>
                                        <th> Entreprise </th>
                                        <th> Modalité </th>
                                        <th> Date du projet</th>

                                        <th> Statut </th>
                                        <th rowspan="2"></th>
                                        @if ($prj->type_formation_id == 1)
                                            <th></th>
                                        @endif
                                        {{-- <th></th> --}}
                                    </thead>
                                    <tbody class="tbody_projet">

                                        @if ($prj->totale_session <= 0)
                                            <tr>
                                                <td colspan="5"> Aucune session</td>

                                            </tr>
                                        @else
                                            @foreach ($data as $pj)
                                                @if ($prj->projet_id == $pj->projet_id)
                                                    <tr>
                                                        <td> <a
                                                                href="{{ route('detail_session', [$pj->groupe_id, $prj->type_formation_id]) }}">{{ $pj->nom_groupe }}</a>
                                                        </td>
                                                        <td>{{ $pj->nom_module }}</td>
                                                        <td>
                                                            @foreach ($entreprise as $etp)
                                                                @if ($etp->groupe_id == $pj->groupe_id)
                                                                    {{ $etp->nom_etp}}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $pj->modalite }}</td>
                                                        <td> {{ $pj->date_debut . ' au ' . $pj->date_fin }} </td>
                                                        <td align="center" style="min-width: 6rem;">
                                                            <p class="{{ $pj->class_status_groupe }} m-0 ps-1 pe-1">
                                                                {{ $pj->item_status_groupe }}</p>
                                                                
                                                        </td>
                                                        <td class="p-0"><a href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}" class="m-0 ps-1 pe-1"><button class="btn"><i class="bx bxs-file-pdf"></i>PDF</button></a></td>
                                                        @if ($prj->type_formation_id == 1)
                                                            <td class="p-0">
                                                                <a class="mt-2"
                                                                    href="{{ route('nouveauRapportFinale', [$pj->groupe_id]) }}" target="_blank"><button class="btn">Rapport</button></a>
                                                            </td>
                                                        @endif
                                                        @can('isCFP')
                                                            <td class="centrer_edit"><a href="#" data-bs-toggle="modal"
                                                                    data-bs-target="#modal_modifier_session_{{ $pj->groupe_id }}"
                                                                    data-backdrop="static" class="bx bx-edit" style="font-size: 1.2rem;">
                                                                    </a></td>
                                                        @endcan

                                                        {{-- <td><a class="bx bx-trash" data-bs-toggle="modal" data-bs-target="#delete_session_{{ $pj->groupe_id }}" style="font-size: 1.2rem;"></a></td> --}}

                                                        {{-- debut supprimer session --}}
                                                            <div class="modal fade" id="delete_session_{{ $pj->groupe_id }}"
                                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header  d-flex justify-content-center"
                                                                            style="background-color:rgb(224,182,187);">
                                                                            <h6 class="modal-title">Avertissement !</h6>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <small>Vous êtes sur le point d'effacer une donnée, cette
                                                                                action est irréversible. Continuer ?</small>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary"
                                                                                data-bs-dismiss="modal"> Non </button>
                                                                            <button type="button" class="btn btn-secondary"><a
                                                                                    href="{{ route('destroy_groupe', [$pj->groupe_id]) }}">Oui</a></button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        {{-- fin supprimer session --}}
                                                        {{-- Debut modal edit session --}}
                                                        <div>
                                                            <div class="modal fade"
                                                                id="modal_modifier_session_{{ $pj->groupe_id }}"
                                                                data-backdrop="static">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content p-3">
                                                                        <div class="modal-title pt-3"
                                                                            style="height: 50px; align-items: center;">
                                                                            <h5 class="text-center my-auto">Modifier session
                                                                                <strong>{{ $pj->nom_groupe }}</strong></h5>
                                                                        </div>
                                                                        @if ($prj->type_formation_id == 1)
                                                                            <div class="row">
                                                                                <form
                                                                                    action="{{ route('modifier_session_intra') }}"
                                                                                    id="formPayement" method="post">
                                                                                    @csrf
                                                                                    <input type="hidden" name="id"
                                                                                        value="{{ $pj->groupe_id }}">
                                                                                    <div class="row">
                                                                                        <div class="form-group">
                                                                                            <div class="form-row d-flex">
                                                                                                <div class="col">
                                                                                                    <div class="row ps-3 mt-2">
                                                                                                        <div
                                                                                                            class="form-group mt-1 mb-1">
                                                                                                            <input type="text"
                                                                                                                id="min"
                                                                                                                class="form-control input"
                                                                                                                name="date_debut"
                                                                                                                required
                                                                                                                onfocus="(this.type='date')"
                                                                                                                value="{{ $pj->date_debut }}">
                                                                                                            <label
                                                                                                                class="ml-3 form-control-placeholder"
                                                                                                                for="min">Date
                                                                                                                debut du
                                                                                                                session<strong
                                                                                                                    class="text-danger">*</strong></label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row ps-3 mt-2">
                                                                                                        <div
                                                                                                            class="form-group mt-1">
                                                                                                            <select
                                                                                                                class="form-select selectP input"
                                                                                                                id="formation_session_id"
                                                                                                                name="formation_id"
                                                                                                                aria-label="Default select example">
                                                                                                                <option
                                                                                                                    value="{{ $pj->formation_id }}">
                                                                                                                    {{ $pj->nom_formation }}
                                                                                                                </option>
                                                                                                                @foreach ($formation as $form)
                                                                                                                    <option
                                                                                                                        value="{{ $form->id }}">
                                                                                                                        {{ $form->nom_formation }}
                                                                                                                    </option>
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                            <label
                                                                                                                class="ml-3 form-control-placeholder"
                                                                                                                for="formation_id">Formations<strong
                                                                                                                    class="text-danger">*</strong></label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col">
                                                                                                    <div class="row ps-3 mt-2">
                                                                                                        <div
                                                                                                            class="form-group mt-1 mb-1">
                                                                                                            <input type="text"
                                                                                                                id="min"
                                                                                                                class="form-control input"
                                                                                                                name="date_fin"
                                                                                                                required
                                                                                                                onfocus="(this.type='date')"
                                                                                                                value="{{ $pj->date_fin }}">
                                                                                                            <label
                                                                                                                class="ml-3 form-control-placeholder"
                                                                                                                for="min">Date
                                                                                                                fin du
                                                                                                                session<strong
                                                                                                                    class="text-danger">*</strong></label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="row ps-3 mt-2">
                                                                                                        <div
                                                                                                            class="form-group mt-1 mb-1">
                                                                                                            <select
                                                                                                                class="form-select selectP input"
                                                                                                                id="module_id"
                                                                                                                name="module_id"
                                                                                                                aria-label="Default select example">
                                                                                                                <option
                                                                                                                    value="{{ $pj->module_id }}">
                                                                                                                    {{ $pj->nom_module }}
                                                                                                                </option>
                                                                                                                @foreach ($module as $mod)
                                                                                                                    <option
                                                                                                                        value="{{ $mod->id }}">
                                                                                                                        {{ $mod->nom_module }}
                                                                                                                    </option>
                                                                                                                @endforeach
                                                                                                            </select>
                                                                                                            <label
                                                                                                                class="ml-3 form-control-placeholder"
                                                                                                                for="module_id">Modules<strong
                                                                                                                    class="text-danger">*</strong></label>
                                                                                                        </div>
                                                                                                    </div>

                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-row">
                                                                                                <div class="row ps-3 mt-2">
                                                                                                    <div
                                                                                                        class="form-group mt-1 mb-1">
                                                                                                        <select
                                                                                                            class="form-select selectP input"
                                                                                                            id="payement_id"
                                                                                                            name="payement"
                                                                                                            aria-label="Default select example">
                                                                                                            <option
                                                                                                                value="{{ $pj->type_payement_id }}"
                                                                                                                hidden>
                                                                                                                {{ $pj->type }}
                                                                                                            </option>
                                                                                                            @foreach ($payement as $paye)
                                                                                                                <option
                                                                                                                    value="{{ $paye->id }}">
                                                                                                                    {{ $paye->type }}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        </select>
                                                                                                        <label
                                                                                                            class=" form-control-placeholder"
                                                                                                            for="payement_id">Mode
                                                                                                            de Payement<strong
                                                                                                                class="text-danger">*</strong></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-row d-flex">
                                                                                                <div class="col">
                                                                                                    <div class="row ps-3">
                                                                                                        <div
                                                                                                            class="form-group ">
                                                                                                            <input type="text"
                                                                                                                id="min"
                                                                                                                class="form-control input"
                                                                                                                min="1" max="50"
                                                                                                                name="min_part"
                                                                                                                required
                                                                                                                onfocus="(this.type='number')"
                                                                                                                value="{{ $pj->min_participant }}">
                                                                                                            <label
                                                                                                                class="ml-3 form-control-placeholder"
                                                                                                                for="min">Nombre
                                                                                                                de participant
                                                                                                                minimal</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="text-center mb-1">
                                                                                                        <button type="submit"
                                                                                                            form="formPayement"
                                                                                                            class="btn btn_enregistrer">Valider</button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="col">
                                                                                                    <div class="row ps-3">
                                                                                                        <div
                                                                                                            class="form-group ">
                                                                                                            <input type="text"
                                                                                                                id="min"
                                                                                                                class="form-control input"
                                                                                                                min="1" max="50"
                                                                                                                name="max_part"
                                                                                                                required
                                                                                                                onfocus="(this.type='number')"
                                                                                                                value="{{ $pj->max_participant }}">
                                                                                                            <label
                                                                                                                class="ml-3 form-control-placeholder"
                                                                                                                for="min">Nombre
                                                                                                                de participant
                                                                                                                maximal</label>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="text-center mb-1">
                                                                                                        <button type="button"
                                                                                                            class="btn  btn_annuler"
                                                                                                            data-bs-dismiss="modal">Annuler</button>
                                                                                                    </div>
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
                                                                                        <form
                                                                                            action="{{ route('modifier_session_inter') }}"
                                                                                            method="POST">
                                                                                            @csrf
                                                                                            <input type="hidden" name="id"
                                                                                                value="{{ $pj->groupe_id }}">
                                                                                            <div class="col">
                                                                                                <div class="row ps-3 mt-2">
                                                                                                    <div
                                                                                                        class="form-group mt-1 mb-1">
                                                                                                        <input type="text"
                                                                                                            id="min"
                                                                                                            class="form-control input"
                                                                                                            name="date_debut"
                                                                                                            required
                                                                                                            onfocus="(this.type='date')"
                                                                                                            value="{{ $pj->date_debut }}">
                                                                                                        <label
                                                                                                            class="form-control-placeholder"
                                                                                                            for="min">Date
                                                                                                            debut<strong
                                                                                                                class="text-danger">*</strong></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row ps-3 mt-2">
                                                                                                    <div
                                                                                                        class="form-group mt-1 mb-1">
                                                                                                        <input type="text"
                                                                                                            id="min"
                                                                                                            class="form-control input"
                                                                                                            min="1" max="50"
                                                                                                            name="min_part"
                                                                                                            required
                                                                                                            onfocus="(this.type='number')"
                                                                                                            value="{{ $pj->min_participant }}">
                                                                                                        <label
                                                                                                            class="form-control-placeholder"
                                                                                                            for="min">Participant
                                                                                                            minimal</label>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="text-center ps-3">
                                                                                                    <button type="submit"
                                                                                                        class="btn btn_enregistrer">Valider</button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <div class="row ps-3 mt-2">
                                                                                                    <div
                                                                                                        class="form-group mt-1 mb-1">
                                                                                                        <input type="text"
                                                                                                            id="min"
                                                                                                            class="form-control input"
                                                                                                            name="date_fin"
                                                                                                            required
                                                                                                            onfocus="(this.type='date')"
                                                                                                            value="{{ $pj->date_fin }}">
                                                                                                        <label
                                                                                                            class=" form-control-placeholder"
                                                                                                            for="min">Date
                                                                                                            fin<strong
                                                                                                                class="text-danger">*</strong></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row ps-3 mt-2">
                                                                                                    <div
                                                                                                        class="form-group mt-1 mb-1">
                                                                                                        <input type="text"
                                                                                                            id="min"
                                                                                                            class="form-control input"
                                                                                                            min="1" max="50"
                                                                                                            name="max_part"
                                                                                                            required
                                                                                                            onfocus="(this.type='number')"
                                                                                                            value="{{ $pj->max_participant }}">
                                                                                                        <label
                                                                                                            class="form-control-placeholder"
                                                                                                            for="min">Participant
                                                                                                            maximal</label>
                                                                                                    </div>
                                                                                                </div>


                                                                                                <div class="text-center ps-3">
                                                                                                    <button type="button"
                                                                                                        class="btn btn_annuler"
                                                                                                        data-bs-dismiss="modal"
                                                                                                        aria-label="Close">Annuler</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        {{-- Fin modal edit session --}}
                                                        {{-- debut modal nouveau session --}}
                                                        <div>
                                                            <div id="modal_{{ $pj->projet_id }}"
                                                                class="modal fade modal_projets">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="w-100 text-center">Nouvelle Session pour
                                                                                le&nbsp;{{ $pj->nom_projet }}
                                                                            </h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ route('insert_session') }}"
                                                                                method="POST"
                                                                                class="justify-content-center me-5">
                                                                                @csrf
                                                                                <input type="hidden" name="type_formation"
                                                                                    value="1">
                                                                                <input type="hidden" name="projet"
                                                                                    value="{{ $pj->projet_id }}">
                                                                                <div class="row">
                                                                                    <h5 class="mb-4 text-center">Ajouter votre
                                                                                        nouvelle
                                                                                        Session</h5>
                                                                                    <div class="form-group">
                                                                                        <div class="form-row d-flex">
                                                                                            <div class="col">
                                                                                                <div class="row ps-3 mt-2">
                                                                                                    <div
                                                                                                        class="form-group mt-1 mb-1">
                                                                                                        <input type="text"
                                                                                                            id="min"
                                                                                                            class="form-control input"
                                                                                                            name="date_debut"
                                                                                                            required
                                                                                                            onfocus="(this.type='date')">
                                                                                                        <label
                                                                                                            class="form-control-placeholder"
                                                                                                            for="min">Date
                                                                                                            debut<strong
                                                                                                                class="text-danger">*</strong></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row ps-3 mt-2">
                                                                                                    <div
                                                                                                        class="form-group mt-1 mb-1">
                                                                                                        <input type="text"
                                                                                                            id="min"
                                                                                                            class="form-control input"
                                                                                                            min="1" max="50"
                                                                                                            name="min_part"
                                                                                                            required
                                                                                                            onfocus="(this.type='number')">
                                                                                                        <label
                                                                                                            class="form-control-placeholder"
                                                                                                            for="min">Participant
                                                                                                            minimal</label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row px-3 mt-2">
                                                                                                    <div
                                                                                                        class="form-group mt-1 mb-1">
                                                                                                        <select
                                                                                                            class="form-select selectP input"
                                                                                                            id="etp_id"
                                                                                                            name="modalite"
                                                                                                            aria-label="Default select example">
                                                                                                            {{-- <option value="null" selected hidden>Choisir l'entreprise souhaité...</option> --}}
                                                                                                            <option
                                                                                                                value="Présentielle">
                                                                                                                Présentielle
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="En ligne">
                                                                                                                En ligne
                                                                                                            </option>
                                                                                                            <option
                                                                                                                value="Présentiel/En ligne">
                                                                                                                Présentiel/En
                                                                                                                ligne</option>
                                                                                                        </select>
                                                                                                        <label
                                                                                                            class="ml-3 form-control-placeholder"
                                                                                                            for="etp_id">Modalite</label>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="text-center ps-3">
                                                                                                    <button type="submit"
                                                                                                        class="btn btn_enregistrer">Valider</button>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col">
                                                                                                <div class="row ps-3 mt-2">
                                                                                                    <div
                                                                                                        class="form-group mt-1 mb-1">
                                                                                                        <input type="text"
                                                                                                            id="min"
                                                                                                            class="form-control input"
                                                                                                            name="date_fin"
                                                                                                            required
                                                                                                            onfocus="(this.type='date')">
                                                                                                        <label
                                                                                                            class=" form-control-placeholder"
                                                                                                            for="min">Date
                                                                                                            fin<strong
                                                                                                                class="text-danger">*</strong></label>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="row ps-3 mt-2">
                                                                                                    <div
                                                                                                        class="form-group mt-1 mb-1">
                                                                                                        <input type="text"
                                                                                                            id="min"
                                                                                                            class="form-control input"
                                                                                                            min="1" max="50"
                                                                                                            name="max_part"
                                                                                                            required
                                                                                                            onfocus="(this.type='number')">
                                                                                                        <label
                                                                                                            class="form-control-placeholder"
                                                                                                            for="min">Participant
                                                                                                            maximal</label>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="text-center ps-3">
                                                                                                    <button type="button"
                                                                                                        class="btn btn_annuler"
                                                                                                        data-bs-dismiss="modal"
                                                                                                        aria-label="Close"
                                                                                                        style="margin-top: 6rem;">Annuler</button>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                            </form>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- fin --}}
                                                        {{-- debut modal edit projet --}}
                                                        <div>
                                                            <div id="edit_prj_{{ $pj->projet_id }}"
                                                                class="modal fade modal_projets">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="text-center w-100">Modification de la
                                                                                Status du
                                                                                Session dans le&nbsp;{{ $pj->nom_projet }}
                                                                            </h5>

                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form
                                                                                action="{{ route('update_projet', $pj->projet_id) }}"
                                                                                id="zsxsq" method="POST">
                                                                                @csrf
                                                                                <div class="row ps-3 mt-2">
                                                                                    <div class="form-group mt-1 mb-1">
                                                                                        <select
                                                                                            class="form-select selectP input"
                                                                                            id="formation_id"
                                                                                            name="formation_id"
                                                                                            aria-label="Default select example">
                                                                                            <option onselected hidden>choisir la
                                                                                                status
                                                                                                du session</option>
                                                                                            @foreach ($status as $stat)
                                                                                                <option
                                                                                                    value="{{ $stat->id }}">
                                                                                                    {{ $stat->status }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        </select>
                                                                                        <label
                                                                                            class="ml-3 form-control-placeholder"
                                                                                            for="formation_id">Status</label>
                                                                                    </div>
                                                                                </div>


                                                                                <div class="mt-4 mb-4">
                                                                                    <div
                                                                                        class="mt-4 mb-4 d-flex justify-content-around">
                                                                                        <div class="text-center ps-3"><button
                                                                                                type="submit"
                                                                                                form="formPayement"
                                                                                                class="btn btn_enregistrer">Valider</button>
                                                                                        </div>
                                                                                        <div class="text-center ps-3"><button
                                                                                                type="button"
                                                                                                class="btn btn_annuler"
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
                        <table class="table table-hover m-0 p-0 mt-2 table-borderless">
                            <thead class="thead_projet" style="border-bottom: 1px solid black; line-height: 20px">
                                <th>Projet</th>
                                <th>Type de formation</th>
                                <th> Session </th>
                                <th>Date session</th>
                                <th> Entreprise </th>
                                <th> Date du projet</th>
                                <th> Modalité</th>
                                <th> Statut </th>
                                <th rowspan="2"></th>
                            </thead>
                            <tbody class="tbody_projet">
                                @foreach ($data as $pj)
                                    <tr class="m-0">
                                        <td>{{ $pj->nom_projet }}</td>
                                        <td>
                                            @if ($pj->type_formation_id == 1)
                                                <h6 class="m-0"><button
                                                        class="type_intra m-0 filtre_projet">{{ $pj->type_formation }}</button>
                                                </h6>
                                                &nbsp;&nbsp;
                                            @elseif ($pj->type_formation_id == 2)
                                                <h6 class="m-0"><button
                                                        class="type_inter m-0">{{ $pj->type_formation }}</button></h6>
                                                &nbsp;&nbsp;
                                            @endif
                                        </td>
                                        <td> <a
                                                href="{{ route('detail_session', [$pj->groupe_id, $pj->type_formation_id]) }}">{{ $pj->nom_groupe }}</a>
                                        </td>
                                        <td> {{ $pj->date_debut . ' au ' . $pj->date_fin }} </td>
                                        <td>
                                            @foreach ($entreprise as $etp)
                                                @if ($etp->groupe_id == $pj->groupe_id)
                                                    {{ $etp->nom_etp }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td> {{ date('d-m-Y', strtotime($pj->date_projet)) }} </td>
                                        <td>{{ $pj->modalite }}</td>
                                        <td>
                                            <p class="{{ $pj->class_status_groupe }} pe-1 ps-1 m-0">
                                                {{ $pj->item_status_groupe }}</p>
                                        </td>
                                        <td class="p-0"><a href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}" class="m-0 ps-1 pe-1"><button class="btn"><i class="bx bxs-file-pdf"></i>PDF</button></a></td>
                                        <td align="left">
                                            <p class="m-0 p-0 ms-0"><i class='bx bx-check-circle' style="color:
                                            @php
                                                echo $groupe->statut_presences($pj->groupe_id);
                                            @endphp
                                            "></i>&nbsp;Emargement</p>
                                            <p class="m-0 p-0 ms-0"><i class='bx bx-check-circle' style="color:
                                            @php
                                                echo $groupe->statut_evaluation($pj->groupe_id);
                                            @endphp
                                            "></i>&nbsp;Evaluation</p>
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
                        <table class="table table-hover table-borderless m-0 p-0 mt-2">
                            <thead class="thead_projet" style="border-bottom: 1px solid black; line-height: 20px">
                                <th>Projet</th>
                                <th>Type de formation</th>
                                <th> Session </th>
                                <th>Date session</th>
                                <th> Centre de formation </th>
                                {{-- <th> Date du projet</th> --}}
                                <th>Modalité</th>
                                <th> Statut </th>
                                <th></th>
                            </thead>
                            <tbody class="tbody_projet">
                                @foreach ($data as $pj)
                                    <tr class="m-0">
                                        <td>{{ $pj->nom_projet }}</td>
                                        <td>
                                            @if ($pj->type_formation_id == 1)
                                                <h6 class="m-0"><button
                                                        class="type_intra m-0 filtre_projet">{{ $pj->type_formation }}</button>
                                                </h6>
                                                &nbsp;&nbsp;
                                            @elseif ($pj->type_formation_id == 2)
                                                <h6 class="m-0"><button
                                                        class="type_inter m-0">{{ $pj->type_formation }}</button></h6>
                                                &nbsp;&nbsp;
                                            @endif
                                        </td>
                                        <td> <a
                                                href="{{ route('detail_session', [$pj->groupe_id, $pj->type_formation_id]) }}">{{ $pj->nom_groupe }}</a>
                                        </td>
                                        <td> {{ $pj->date_debut . ' au ' . $pj->date_fin }} </td>
                                        <td> {{ $pj->nom_cfp }} </td>
                                        {{-- <td> {{ date('d-m-Y', strtotime($pj->date_projet)) }} </td> --}}
                                        {{-- <td>{{ $pj->modalite }}</td> --}}
                                        <td>
                                            <p class="{{ $pj->class_status_groupe }}">{{ $pj->item_status_groupe }}
                                            </p>
                                        </td>
                                        <td class="p-0"><a href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}" class="m-0 ps-1 pe-1"><button class="btn"><i class="bx bxs-file-pdf"></i>PDF</button></a></td>
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
                        <table class="table table-hover table-borderless m-0 p-0">
                            <thead class="thead_projet" style="border-bottom: 1px solid black; line-height: 20px">
                                {{-- <th>Projet</th> --}}
                                <th> Session </th>
                                <th> Date du session</th>
                                <th> Centre de formation </th>
                                <th> Formation </th>
                                <th> Module</th>
                                <th></th>
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
                                        <td class="p-0"><a href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}" class="m-0 ps-1 pe-1"><button class="btn"><i class="bx bxs-file-pdf"></i>PDF</button></a></td>
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
        <div class="filtrer mt-3">
            <div class="row">
                <div class="col">
                    <p class="m-0">Filter vos projets</p>
                </div>
                <div class="col text-end">
                    <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
                </div>
                <hr class="mt-2">
                @canany(['isReferent', 'isCFP'])
                    <div class="col-12 pe-3">
                        <div class="row mb-3 p-2 pt-0">
                            <form action="{{ route('liste_projet') }}" method="GET">
                                <input type="hidden" name="type_formation" value="{{ $type_formation_id }}">
                                <div class="row px-3 mt-2">
                                    <select name="mois" id="mois" class="filtre_projet">
                                        <option value="null" selected>Mois</option>
                                        <option style="background-color: red;color: red;" value="1">Janvier</option>
                                        <option value="2">Février</option>
                                        <option value="3">Mars</option>
                                        <option value="4">Avril</option>
                                        <option value="5">Mai</option>
                                        <option value="6">Juin</option>
                                        <option value="7">Juillet</option>
                                        <option value="8">Août</option>
                                        <option value="9">Septembre</option>
                                        <option value="10">Octobre</option>
                                        <option value="11">Novembre</option>
                                        <option value="12">Décembre</option>
                                    </select>
                                </div>
                                <div class="row px-3 mt-2">
                                    <select name="trimestre" id="trimestre" class="filtre_projet">
                                        <option value="null" selected>Trimestres</option>
                                        <option value="1">1e Trimestre</option>
                                        <option value="2">2e Trimestre</option>
                                        <option value="3">3e Trimestre</option>
                                        <option value="4">4e Trimestre</option>
                                    </select>

                                </div>

                                <div class="row px-3 mt-2">
                                    <select name="semestre" id="semestre" class="filtre_projet">
                                        <option value="null" selected>Semestres</option>
                                        <option value="1">1e Semestre</option>
                                        <option value="2">2e Semestre</option>
                                    </select>

                                </div>

                                <div class="row px-3 mt-2">
                                    <select name="annee" id="annee" class="filtre_projet">
                                        <option value="null" selected>Années</option>
                                    </select>
                                    <button class="btn btn_next mt-3 mb-3" type="submit">Appliquer</button>

                                </div>

                            </form>
                        </div>
                    @endcanany
                </div>
                @can('isReferent')
                    <div class="row px-3 mt-2">
                        <form action="{{ route('recherche_cfp') }}" method="POST">
                            @csrf
                            <div class="form-group mt-1 mb-1">
                                <input type="text " class="form-control input" name="cfp_search">
                                <label class="form-control-placeholder">Organisme de formation</label>
                            </div>
                            <div class="row px-3">
                                <button class="btn btn_next mt-3 mb-3" type="submit">Rechercher</button>
                            </div>
                        </form>
                    </div>
                @endcan
                {{-- @can('isCFP')
                <div class="row px-3 mt-2">
                    <form  action="{{ route('recherche_entreprise') }}" method="POST">
                        @csrf
                        <div class="form-group mt-1 mb-1">
                        <input type="text " class="form-control input"   name="entreprise">
                        <label class="form-control-placeholder">Entreprise</label>
                    </div>
                    <div class="row px-3">
                        <button class="btn btn_next mt-3 mb-3" type="submit">Rechercher</button>
                    </div>
                    </form>
                </div>
                @endcan --}}
                @canany(['isReferent', 'isCFP'])
                    <div class="col-12 ps-5">
                    @endcanany
                    @canany(['isFormateur', 'isStagiaire'])
                        <div class="col-12 ps-5">
                        @endcanany
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
                    // $('.changer_carret').on('click',function(){
                    //     if ($('.collapse').hasClass('show')) {
                    //         $('.collapse').remove('show');
                    //     } ;
                    // });
                </script>
            @endsection
