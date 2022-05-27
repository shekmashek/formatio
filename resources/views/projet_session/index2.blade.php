@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Projets</p>
@endsection

@inject('groupe', 'App\groupe')

@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/projets.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/configAll.css') }}">

    <style>
        .status_grise {
            border-radius: 5px;
            background-color: #637381;
            color: white;
            align-items: center margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_reprogrammer {
            border-radius: 5px;
            background-color: #00CDAC;
            color: white;
            align-items: center margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_cloturer {
            border-radius: 5px;
            background-color: #314755;
            color: white;
            align-items: center margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_reporter {
            border-radius: 5px;
            background-color: #26a0da;
            color: white;
            align-items: center margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_annulee {
            border-radius: 5px;
            background-color: #b31217;
            color: white;
            align-items: center margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_termine {
            border-radius: 5px;
            background-color: #1E9600;
            color: white;
            align-items: center margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_confirme {
            border-radius: 5px;
            background-color: #2B32B2;
            color: white;
            align-items: center margin: 0 auto;
            padding-end: 1rem;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .statut_active {
            border-radius: 5px;
            background-color: rgb(15, 126, 145);
            color: whitesmoke;
            align-items: center margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .modalite {
            border-radius: 5px;
            background-color: #26a0da;
            color: rgb(255, 255, 255);
            /* width: 60%; */
            align-items: center margin: 0 auto;

            padding: 0.3rem 0.5rem !important;
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

        .rapport_finale {
            background-color: #F16529 !important;
        }

        .rapport_finale button {
            color: #ffffff !important;
        }

        .rapport_finale:hover {
            background-color: #af3906 !important;
        }

        .pdf_download {
            background-color: #e73827 !important;
            padding: 0.3rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all .5ms ease;
            color: white !important;
            position: relative;
        }

        .pdf_download:hover {
            background-color: #af3906 !important;
        }

        .pdf_download button {
            color: #ffffff !important;
        }

        tbody tr {
            vertical-align: middle;
        }

        .btn-label-session {
            position: relative;
            left: -12px;
            display: inline-block;
            padding: 6px 12px;
            background: rgba(37, 37, 37, 0.15);
            /* background-color: #a8e063; */
            border-radius: 3px 0 0 3px;
        }

        .btn-ajout-session {
            padding-top: 0;
            padding-bottom: 0;
        }

        .resultat_stg{
            background-color: #2cb445;
            padding: 0.3rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all .5ms ease;
            position: relative;
        }
        .resultat_stg button{
            color: #ffffff !important;
        }
        .resultat_stg:hover{
            background-color: #1c7f2e;
        }

        .btn_eval_stg{
            background-color: #363dbc;
            padding: 0.3rem;
            border-radius: 5px;
            cursor: pointer;
            transition: all .5ms ease;
            position: relative;
        }
        .btn_eval_stg:hover{
            background-color: #262b86;
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
                                                @php
                                                    if ($prj->totale_session == 1) {
                                                        echo $prj->nom_projet . '&nbsp;&nbsp;Sess&nbsp;' . $prj->totale_session;
                                                    } elseif ($prj->totale_session > 1) {
                                                        echo $prj->nom_projet . '&nbsp;&nbsp;Sess&nbsp;' . $prj->totale_session;
                                                    } elseif ($prj->totale_session == 0) {
                                                        echo $prj->nom_projet . '&nbsp;&nbsp;Sess&nbsp;' . $prj->totale_session;
                                                    }
                                                @endphp
                                                &nbsp;&nbsp;@php
                                                    setlocale(LC_TIME, 'fr_FR');
                                                echo strftime('%d %B, %Y', strtotime($prj->date_projet)); @endphp @if ($type_formation_id == 1)
                                                    {{-- {{ $data[0]->nom_etp }} --}}
                                                @endif
                                                &nbsp;&nbsp;</a></h6>
                                    </div>
                                    <div class="col-1 p-0 text-center">
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
                                    <div class="col-5 p-0 d-flex justify-content-start">
                                        @php
                                            $modules = $groupe->module_projet($prj->projet_id);
                                        @endphp
                                        @foreach ($modules as $mod)
                                            <h6 class="m-0">
                                                <label class="projet_formation m-0">
                                                    {{ $mod->nom_module }}
                                                </label>
                                            </h6>&nbsp;
                                        @endforeach
                                    </div>

                                    <div class="col-2 new_session p-0">
                                        @can('isCFP')
                                            @if ($prj->type_formation_id == 1)
                                                {{-- <span role="button" class=" m-0 nouvelle_session " data-bs-toggle="modal"
                                                    data-bs-target="#modal_{{ $prj->projet_id }}" data-backdrop='static'
                                                    title="Nouvelle session"><i class="bx bx-plus-medical icon_creer"></i>Session</span> --}}
                                                <span role="button" data-bs-toggle="modal"
                                                    data-bs-target="#modal_{{ $prj->projet_id }}" data-backdrop='static'
                                                    title="Nouvelle session" class="btn btn_nouveau py-1 mb-2">
                                                    <i class='bx bx-plus-medical me-1'></i>Session</span>
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
                                        <th> <i class='bx bx-group'></i> </th>
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
                                                        <td class="text-start">{{ $pj->nom_module }}</td>
                                                        <td class="text-end">
                                                            @php
                                                                echo $groupe->nombre_apprenant_session($pj->groupe_id);
                                                            @endphp
                                                        </td>
                                                        <td class="text-start">
                                                            @foreach ($entreprise as $etp)
                                                                @if ($etp->groupe_id == $pj->groupe_id)
                                                                    {{ $etp->nom_etp }}
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td><span class="modalite">{{ $pj->modalite }}</span></td>
                                                        <td>
                                                            @php
                                                                echo strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin));
                                                            @endphp
                                                        </td>
                                                        <td align="center" style="min-width: 6rem;">
                                                            <p class="{{ $pj->class_status_groupe }} m-0 ps-1 pe-1">
                                                                {{ $pj->item_status_groupe }}</p>

                                                        </td>
                                                        <td class="p-0"><a
                                                                href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}"
                                                                class="m-0 ps-1 pe-1 pdf_download"><button
                                                                    class="btn"><i
                                                                        class="bx bxs-file-pdf"></i>PDF</button></a></td>
                                                        @if ($prj->type_formation_id == 1)
                                                            <td class="p-0">
                                                                <a class="mt-2 rapport_finale"
                                                                    href="{{ route('nouveauRapportFinale', [$pj->groupe_id]) }}"
                                                                    target="_blank"><button class="btn"><i
                                                                            class='bx bxs-report'></i>Rapport</button></a>
                                                            </td>
                                                        @endif
                                                        @can('isCFP')
                                                            <td class="centrer_edit"><button href="#" class="btn"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal_modifier_session_{{ $pj->groupe_id }}"
                                                                    data-backdrop="static"><i class='bx bx-edit bx_modifier'
                                                                        style="font-size: 1.1rem !important;"></i>
                                                                </button></td>
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
                                                                        <small>Vous êtes sur le point d'effacer une donnée,
                                                                            cette
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
                                                                                <strong>{{ $pj->nom_groupe }}</strong>
                                                                            </h5>
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
                                                                                    <h5 class="mb-4 text-center">Ajouter votre
                                                                                        nouvelle
                                                                                        Session</h5>
                                                                                    <div class="form-group">
                                                                                        <div class="row mt-2">
                                                                                            <div
                                                                                                class="col-lg-6 text-end mt-2">
                                                                                                <span>Date debut de la
                                                                                                    session<strong
                                                                                                        class="text-danger">*</strong></span>
                                                                                            </div>
                                                                                            <div class="col-lg-6"><input
                                                                                                    type="date" id="min"
                                                                                                    class="form-control input"
                                                                                                    name="date_debut"
                                                                                                    style="width: 12rem;"
                                                                                                    required></div>
                                                                                        </div>
                                                                                        <div class="row mt-2">
                                                                                            <div
                                                                                                class="col-lg-6 text-end mt-2">
                                                                                                <span>Date fin de la
                                                                                                    session<strong
                                                                                                        class="text-danger">*</strong></span>
                                                                                            </div>
                                                                                            <div class="col-lg-6"><input
                                                                                                    type="date" id="min"
                                                                                                    class="form-control input"
                                                                                                    name="date_fin"
                                                                                                    style="width: 12rem;"
                                                                                                    required></div>
                                                                                        </div>
                                                                                        <div class="row mt-2">
                                                                                            <div
                                                                                                class="col-lg-6 text-end mt-2">
                                                                                                <span>Modalité<strong
                                                                                                        class="text-danger">*</strong>
                                                                                                </span>
                                                                                            </div>
                                                                                            <div class="col-lg-6 text-end">
                                                                                                <select
                                                                                                    class="form-select input_select"
                                                                                                    name="modalite"
                                                                                                    aria-label="Default select example"
                                                                                                    style="width: 15rem;"
                                                                                                    required>
                                                                                                    <option value="null">
                                                                                                        Sélectionnez</option>
                                                                                                    <option value="Présentiel">
                                                                                                        Présentielle</option>
                                                                                                    <option value="En ligne">En
                                                                                                        ligne</option>
                                                                                                    <option
                                                                                                        value="Présentiel/En ligne">
                                                                                                        Présentiel/En ligne
                                                                                                    </option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mt-3">
                                                                                            <div class="col-lg-6 text-end"><button type="submit"
                                                                                                    class="btn btn_enregistrer"><i class="bx bx-check me-1"></i> Enregistrer</button></div>
                                                                                            <div class="col-lg-6">
                                                                                                <button type="button" class="btn  btn_annuler" data-dismiss="modal">
                                                                                                    <i class='bx bx-x me-1'></i> Annuler
                                                                                                </button>
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
                                <th>Type</th>
                                <th>Session</th>
                                <th> Module </th>
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
                                                        class="type_intra ">{{ $pj->type_formation }}</button>
                                                </h6>
                                                &nbsp;&nbsp;
                                            @elseif ($pj->type_formation_id == 2)
                                                <h6 class="m-0"><button
                                                        class="type_inter ">{{ $pj->type_formation }}</button></h6>
                                                &nbsp;&nbsp;
                                            @endif
                                        </td>
                                        <td>
                                            <a
                                                href="{{ route('detail_session', [$pj->groupe_id, $pj->type_formation_id]) }}">{{ $pj->nom_groupe }}</a>
                                        </td>
                                        <td class="text-start">
                                            @php
                                                echo $groupe->module_session($pj->module_id) . '&nbsp;' . $groupe->nombre_apprenant_session($pj->groupe_id);
                                            @endphp
                                        </td>
                                        <td> 
                                            @php
                                                echo strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin));
                                            @endphp
                                        </td>
                                        <td class="text-start">
                                            @foreach ($entreprise as $etp)
                                                @if ($etp->groupe_id == $pj->groupe_id)
                                                    {{ $etp->nom_etp }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td> {{ date('d-m-Y', strtotime($pj->date_projet)) }} </td>
                                        <td><span class="modalite">{{ $pj->modalite }}</span></td>
                                        <td>
                                            <p class="{{ $pj->class_status_groupe }} pe-1 ps-1 m-0">
                                                {{ $pj->item_status_groupe }}</p>
                                        </td>
                                        <td class="p-0"><a
                                                href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}"
                                                class="m-0 ps-1 pe-1 pdf_download"><button class="btn"><i
                                                        class="bx bxs-file-pdf"></i>PDF</button></a></td>
                                        <td align="left">
                                            <p class="m-0 p-0 ms-0"><i class='bx bx-check-circle' style="color:
                                                @php
                                                    echo $groupe->statut_presences($pj->groupe_id);
                                                @endphp
                                                "></i>&nbsp;Emargement</p>
                                            <p class="m-0 p-0 ms-0"><i class='bx bx-check-circle'
                                                @php
                                                    $statut_eval = $groupe->statut_evaluation($pj->groupe_id);
                                                    if($statut_eval == 0){
                                                        echo 'style="color:#bdbebd;"';
                                                    }
                                                    elseif ($statut_eval == 1) {
                                                        echo 'style="color:#00ff00;"';
                                                    }
                                                @endphp
                                                ></i>&nbsp;Evaluation</p>
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
                                <th> Module </th>
                                <th> <i class='bx bx-group'></i> </th>
                                <th>Date session</th>
                                <th> Centre de formation </th>
                                {{-- <th> Date du projet</th> --}}
                                <th>Modalité</th>
                                <th> Statut </th>
                                <th></th>
                            </thead>
                            <tbody class="tbody_projet">
                                @foreach ($data as $pj)
                                    <tr>
                                        <td>{{ $pj->nom_projet }}</td>
                                        <td style="vertical-align: middle">
                                            @if ($pj->type_formation_id == 1)
                                                <h6 class="m-0 "><button
                                                        class="type_intra ">{{ $pj->type_formation }}</button>
                                                </h6>
                                                &nbsp;&nbsp;
                                            @elseif ($pj->type_formation_id == 2)
                                                <h6 class="m-0"><button
                                                        class="type_inter ">{{ $pj->type_formation }}</button></h6>
                                                &nbsp;&nbsp;
                                            @endif
                                        </td>
                                        <td> <a
                                                href="{{ route('detail_session', [$pj->groupe_id, $pj->type_formation_id]) }}">{{ $pj->nom_groupe }}</a>
                                        </td>
                                        <td class="text-start">
                                            @php
                                                echo $groupe->module_session($pj->module_id);
                                            @endphp
                                        </td>
                                        <td class="text-end">
                                            @php
                                                echo $groupe->nombre_apprenant_session($pj->groupe_id);
                                            @endphp
                                        </td>
                                        <td>
                                            @php
                                                echo strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin));
                                            @endphp
                                        </td>
                                        <td class="text-start"> {{ $pj->nom_cfp }} </td>
                                        {{-- <td> {{ date('d-m-Y', strtotime($pj->date_projet)) }} </td> --}}
                                        <td><span class="modalite">{{ $pj->modalite }}</span></td>
                                        <td>
                                            <p class="{{ $pj->class_status_groupe }} m-0">
                                                {{ $pj->item_status_groupe }}
                                            </p>
                                        </td>
                                        <td class="p-0"><a
                                                href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}"
                                                class="m-0 ps-1 pe-1 pdf_download"><button class="btn"><i
                                                        class="bx bxs-file-pdf"></i>PDF</button></a></td>
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
                                <th> Module </th>
                                <th> Date du session</th>
                                <th> Centre de formation </th>
                                <th> Formation </th>
                                <th> Module</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </thead>
                            <tbody class="">
                                @foreach ($data as $pj)
                                    <tr>
                                        {{-- <td>{{ $pj->nom_projet }}</td> --}}
                                        <td> {{ $pj->nom_groupe }}</td>
                                        <td>
                                            @php
                                                echo $groupe->module_session($pj->module_id);
                                            @endphp
                                        </td>
                                        <td> 
                                            @php
                                                echo strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin));
                                            @endphp
                                        </td>
                                        <td> {{ $pj->nom_cfp }} </td>
                                        <td> {{ $pj->nom_formation }} </td>
                                        <td> {{ $pj->nom_module }} </td>
                                        <td class="p-0"><a
                                                href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}"
                                                class="m-0 ps-1 pe-1 pdf_download"><button class="btn"><i
                                                        class="bx bxs-file-pdf"></i>PDF</button></a></td>
                                        <td>
                                            @if ($pj->statut_eval == 0)
                                                <a class="btn_eval_stg" href="{{ route('faireEvaluationChaud', [$pj->groupe_id]) }}"><button class="btn pb-2" style="color: #ffffff !important">Evaluation</button></a>
                                            @elseif ($pj->statut_eval == 1)
                                                <p class="mt-3" style="color: green">Evaluation terminé</p>
                                            @endif

                                        </td>
                                        <td>
                                            <a class="resultat_stg" href="{{ route('resultat_stagiaire',[$pj->groupe_id]) }}">
                                            @php
                                                $res = $groupe->resultat_eval($pj->groupe_id);
                                                if ($res == 1) {
                                                    echo '<button class="btn pb-2">Résultat</button>';
                                                }
                                            @endphp
                                            </a>
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

                    localStorage.setItem('activeTab', 'detail');
                </script>
            @endsection
