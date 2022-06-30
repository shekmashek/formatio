@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Projets</p>
@endsection

@inject('groupe', 'App\groupe')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/projets.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/configAll.css') }}">

<link href="https://nightly.datatables.net/fixedheader/css/fixedHeader.dataTables.css?_=f0de745b101295e88f1504c17177ff49.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/fixedheader/js/dataTables.fixedHeader.js?_=f0de745b101295e88f1504c17177ff49"></script>
    <style>
        .dropdown-item.active{
            background-color: transparent !important;
        }

        .dropdown-item.active:hover{
            background-color: #ececec !important;
        }
        .status_grise {
            border-radius: 5px;
            background-color: #637381;
            color: white;
            align-items: center; margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_reprogrammer {
            border-radius: 5px;
            background-color: #00CDAC;
            color: white;
            align-items: center; margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_cloturer {
            border-radius: 5px;
            background-color: #314755;
            color: white;
            align-items: center; margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_reporter {
            border-radius: 5px;
            background-color: #26a0da;
            color: white;
            align-items: center; margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_annulee {
            border-radius: 5px;
            background-color: #b31217;
            color: white;
            align-items: center; margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_termine {
            border-radius: 5px;
            background-color: #1E9600;
            color: white;
            align-items: center; margin: 0 auto;
            padding-top: 2.5px;
            padding-bottom: 2.5px;
            position: relative;
            bottom: 1px;
        }

        .status_confirme {
            border-radius: 5px;
            background-color: #2B32B2;
            color: white;
            align-items: center ;margin: 0 auto;
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
            align-items: center; margin: 0 auto;
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
            margin: 0 auto;
            text-align: center;
            padding: 0.2rem 0.3rem !important;
            min-width: 140px;
            display: inline-block;
        }

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

        .paginationOld {
            background-clip: text;
            margin-right: .3rem;
            font-size: 2rem;
            position: relative;
            top: .7rem;
        } 

        .paginationOld:hover {
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
            /*info SESSION*/
        .green{
            color: #5e35b1;
            border: 2px solid #43a047;
            border-radius: 2px;
            font-size: 16px;
            font-weight: 700;
            padding: 4px;
        }

        .red{
            color: #5e35b1;
            border: 2px solid #f4511e;
            border-radius: 2px;
            font-size: 16px;
            font-weight: 700;
            padding: 4px;
        }

        .yellow{
            color: #5e35b1;
            border: 2px solid #fdd835;
            border-radius: 2px;
            font-size: 16px;
            font-weight: 700;
            padding: 4px;
        }

        .saClass{
            font-size: 21px; 
            color: #637381;
        }
        .saSpan{
            color: #637381;
            font-size: 14px;
        }
        /* fixed top header */
        .fixedTop{
            /* max-height: 720px; */
            overflow-y: scroll;
        }

        #myDiv{
            position: fixed;
            top: 0;

        }
        .spanClass:hover{
            color: #673ab7;
            transition: 0.3s ease-in-out;
            /* border-bottom: 3px solid #673ab7; */
        }

        .head{
            font-size: 14px;
        }
        .table > :not(:last-child) > :last-child > * {
            border-bottom-color: white;
        }
        table#myTable > tbody > tr:first-child{
            /* border-top: 10px solid #cccccc; */
            /* background: #cccccc; */
        }
        .table > :not(caption) > * > td:last-child {
            padding: .5rem .5rem;
            background-color: var(--bs-table-bg);
            /* border-bottom-width: 0px; */
            box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
        }
        .pagination{
            float: right;
            margin-bottom: 14px;
        }
    </style>

    <div class="container-fluid mb-5">

        {{-- test --}}
        <div class="row">
            <div class="col-12 ps-2">
                @canany(['isCFP'])
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
                    <div class="row">
                        <div class="col-8 mb-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <a href=" {{route('liste_projet')}} " class="btn btn-sm btn-success mt-2">Actualiser</a>
                                </div>
                                <div class="col-md-6"></div>
                            </div>
                        </div>
                        <div class="col-4"></div>
                        <div class="fixedTop" >
                            <table id="myDatatablesa" class="display nowrap table shadow-sm table-hover">
                                <thead style="position: sticky; top: 0; z-index:1">
                                    <tr style="background: #eff1f3;">
                                        <th style="font-size: 14px;" scope="col"><i class='bx bx-library'></i> Projet</th>
                                        <th style="font-size: 14px;" scope="col"><i class='bx bxs-book-open' style="color: #2e3950"></i> Session</th>
                                        <th style="font-size: 14px;" scope="col"><i class='bx bxs-customize' style="color: #2e3950"></i> Module</th>
                                        <th style="font-size: 14px;" scope="col"><i class='bx bx-building-house'></i> Entreprise</th>
                                        <th style="font-size: 14px;" scope="col"><i class='bx bx-calendar-check' ></i> Modalité</th>
                                        <th style="font-size: 14px;" scope="col"><i class='bx bx-time-five' ></i> Date du projet</th>
                                        <th style="font-size: 14px;" scope="col"><i class='bx bx-home' ></i> Ville</th>
                                        <th style="font-size: 14px;" scope="col"><i class="bi bi-check2-square"></i> Status</th>
                                        <th style="font-size: 14px;" scope="col"><i class="bi bi-list-ul"></i> Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ( count($dataGroupe) > 0)
                                        @foreach ($dataGroupe as $d)
                                            <tr>
                                                <td style="background: #cccccc"> {{ $d->nom_projet}} </td>
                                                <td colspan="8" style="background: #cccccc">
                                                    @if ($d->type_formation_id == 1)
                                                        <span style="background: #2193b0; color: #ffffff; border-radius: 5px; text-align: center; padding: 4px 8px; font-weight: 400; letter-spacing: 1px;">
                                                            {{ $d->type_formation }}
                                                        </span>
                                                    @elseif ($d->type_formation_id == 2)
                                                        <span style="background: #2ebf91; color: #ffffff; border-radius: 5px; text-align: center; padding: 4px 8px; font-weight: 400; letter-spacing: 1px;">
                                                            {{ $d->type_formation }}
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @foreach ($data as $v)
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <span>
                                                        <a data-bs-toggle="collapse" href="#collapseExample_{{$v->groupe_id}}" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="bi bi-arrow-down-circle"></i></a>
                                                    </span>
                                                    <a href="{{ route('detail_session', [$v->groupe_id, $v->type_formation_id]) }}">
                                                        <span style="border-bottom: 3px solid #673ab7; font-size: 14px"  class="spanClass">{{ $v->nom_groupe }}</span>
                                                    </a>
                                                </td>
                                                <td>
                                                     {{ $v->nom_module}} 
                                                </td>
                                                <td>
                                                     Entreprise 
                                                </td>
                                                <td> 
                                                    {{ $v->modalite}} 
                                                </td>
                                                <td> <span style="font-size: 13px">{{ date('d M Y', strtotime($v->date_debut))." au ".date('d M Y', strtotime($v->date_fin))}}</span> </td>
                                                <td> Ville </td>
                                                <td> {{ $v->item_status_groupe}} </td>
                                            </tr>
                                            @endforeach
                                            
                                        @endforeach
                                    @else
                                            <tr>
                                                <td colspan="9" class="text-primary">Aucun résultat</td>
                                            </tr>
                                    @endif

                                    @foreach ($projet as $prj)
                                        @if ($prj->totale_session <= 0)
                                            <span> Aucune session</span>
                                        @else
                                            <tr>
                                                <td style="vertical-align: top;">
                                                    @php
                                                        if ($prj->totale_session == 1) {
                                                            echo "<span  style='font-size: 14px;'>".$prj->nom_projet."</span>";
                                                        } elseif ($prj->totale_session > 1) {
                                                            echo "<span  style='font-size: 14px;'>".$prj->nom_projet."</span>";
                                                        } elseif ($prj->totale_session == 0) {
                                                            echo "<span  style='font-size: 14px;'>".$prj->nom_projet."</span>";
                                                        }
                                                    @endphp
                                                    <span style="display: block; padding-top: 18px; display: none;">
                                                        @if ($prj->type_formation_id == 1)
                                                            <span style="background: #2193b0; color: #ffffff; border-radius: 5px; text-align: center; padding: 4px 8px; font-weight: 400; letter-spacing: 1px;">
                                                                {{ $prj->type_formation }}
                                                            </span>
                                                        @elseif ($prj->type_formation_id == 2)
                                                            <span style="background: #2ebf91; color: #ffffff; border-radius: 5px; text-align: center; padding: 4px 8px; font-weight: 400; letter-spacing: 1px;">
                                                                {{ $prj->type_formation }}
                                                            </span>
                                                        @endif
                                                    </span>
                                                </td>
                                                <td style="display: none">
                                                    @foreach ($data as $pj)
                                                        @if ($prj->projet_id == $pj->projet_id)
                                                        <span>
                                                            <a data-bs-toggle='collapse' href="#collapseExample_{{ $pj->groupe_id}}" role='button' aria-expanded='false' aria-controls='collapseExample'><i class="bi bi-arrow-down-circle"></i></a>
                                                        </span>
                                                        <span style="display: inline-block; margin-bottom: 15px;">{{ $pj->nom_groupe}}</span> <br><hr>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td style="display: none">
                                                    @foreach ($data as $pj)
                                                        @if ($prj->projet_id == $pj->projet_id)
                                                            <span style="display: inline-block; margin-bottom: 15px;">
                                                                {{ $pj->nom_module}}     
                                                            </span> <br>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td style="display: none">
                                                    @foreach ($data as $pj)
                                                        @if ($prj->projet_id == $pj->projet_id)
                                                            @foreach ($entreprise as $etp)
                                                                @if ($etp->groupe_id == $pj->groupe_id)
                                                                <span style="display: inline-block; margin-bottom: 15px;">{{ $etp->nom_etp }}</span> <br>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td style="display: none">
                                                    @foreach ($data as $pj)
                                                        @if ($prj->projet_id == $pj->projet_id)
                                                            <span style="display: inline-block; margin-bottom: 15px;">{{ $pj->modalite }}</span><br>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td style="display: none">
                                                    @foreach ($data as $pj)
                                                        @if ($prj->projet_id == $pj->projet_id)
                                                            @php
                                                                echo "<span  style='display: inline-block; margin-bottom: 15px;'>".strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin))."</span><br>";
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td style="display: none;"></td>
                                                <td style="display: none">
                                                    @foreach ($data as $pj)
                                                        @if ($prj->projet_id == $pj->projet_id)
                                                            <span style="display: inline-block; margin-bottom: 15px;">{{ $pj->item_status_groupe }}</span> <br>
                                                        @endif
                                                    @endforeach
                                                </td>
                                                <td colspan="8" style="padding: 0; margin: 0">
                                                    <table class="table" id="myTable">
                                                        <thead>
                                                            <tr>
                                                                <th style="vertical-align: top; width: 13.2%">
                                                                    @if ($prj->type_formation_id == 1)
                                                                        <span style="background: #2193b0; color: #ffffff; border-radius: 5px; text-align: center; padding: 2px 10px; font-weight: 400; letter-spacing: 1px;">
                                                                            {{ $prj->type_formation }}
                                                                        </span>
                                                                    @elseif ($prj->type_formation_id == 2)
                                                                        <span style="background: #2ebf91; color: #ffffff; border-radius: 5px; text-align: center; padding: 2px 10px; font-weight: 400; letter-spacing: 1px;">
                                                                            {{ $prj->type_formation }}
                                                                        </span>
                                                                    @endif 
                                                                </th>
                                                                <th style="display: none; width: 12.8%">
                                                                    @foreach ($data as $pj)
                                                                        @if ($prj->projet_id == $pj->projet_id)
                                                                        <span>
                                                                            <a data-bs-toggle='collapse' href="#collapseExample_{{ $pj->groupe_id}}" role='button' aria-expanded='false' aria-controls='collapseExample'><i class="bi bi-arrow-down-circle"></i></a>
                                                                        </span>
                                                                        {{ $pj->nom_groupe}} <br><hr>
                                                                        @endif
                                                                    @endforeach
                                                                </th>
                                                                
                                                                <th style="width: 13.9%">
                                                                    
                                                                </th>
                                                                <th style="width: 12%"></th>
                                                                <th style="width: 13.2%"></th>
                                                                <th style="width: 13.2%"></th>
                                                                <th style="width: 13.2%"></th>
                                                                <th style="width: 13.2%;">
                                                                    @can('isCFP')
                                                                        @if ($prj->type_formation_id == 1)
                                                                            <span role="button" data-bs-toggle="modal"
                                                                                data-bs-target="#modal_{{ $prj->projet_id }}" data-backdrop='static'
                                                                                title="Nouvelle session" class="btn btn_nouveau py-1">
                                                                                <i class='bx bx-plus-medical me-1'></i>Session
                                                                            </span>
                                                                        @endif 
                                                                    @endcan
                                                                </th>
                                                                <th style="width: 13.2%">
                                                                    
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($data as $pj)
                                                                @if ($prj->projet_id == $pj->projet_id)
                                                                <tr>
                                                                    <td style="">
                                                                        <span>
                                                                            <a data-bs-toggle="collapse" href="#collapseExample_{{$pj->groupe_id}}" role="button" aria-expanded="false" aria-controls="collapseExample"><i class="bi bi-arrow-down-circle"></i></a>
                                                                        </span>
                                                                        <a href="{{ route('detail_session', [$pj->groupe_id, $prj->type_formation_id]) }}">
                                                                            <span style="border-bottom: 3px solid #673ab7; font-size: 14px"  class="spanClass">{{ $pj->nom_groupe }}</span>
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <span style="font-size: 14px">
                                                                            {{ $pj->nom_module }}
                                                                        </span>
                                                                    </td>
                                                                    <td>
                                                                        @foreach ($entreprise as $etp)
                                                                            @if ($etp->groupe_id == $pj->groupe_id)
                                                                            <span style="font-size: 14px">{{ $etp->nom_etp }}</span>
                                                                            @endif
                                                                        @endforeach
                                                                    </td>
                                                                    <td>
                                                                        <span style="font-size: 14px">{{ $pj->modalite }}</span>
                                                                    </td>
                                                                    <td>
                                                                        @php
                                                                            echo "<span style='padding-left: 18px; font-size: 10px;'>".strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin))."</span>";    
                                                                        @endphp
                                                                    </td>
                                                                    <td>
                                                                            @php
                                                                                $ville = $groupe->dataVille($pj->groupe_id);
                                                                                $salle = explode(',  ', $ville);
                                                                            @endphp
                                                                            <span style="font-size: 12px;">{{ $salle[0] }}</span><br>
                                                                    </td>
                                                                    <td>
                                                                        <p class=" m-0 ps-1 pe-1 text-center">
                                                                            {{ $pj->item_status_groupe }}
                                                                        </p>
                                                                    </td>
                                                                    <td class="text-center" style="width: 180px;">
                                                                        <i class='bx bx-chevron-down-circle mt-1' style="font-size: 1.8rem;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                                                        <ul class="dropdown-menu p-0" aria-labelledby="dropdownMenuButton1">
                                                                            @can('isCFP')
                                                                                <li><span class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal_modifier_session_{{ $pj->groupe_id }}" data-backdrop="static" style="cursor: pointer;">Modifier</span></li>
                                                                            @endcan
                                                                            <li class="action_projet"><a class="dropdown-item" href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}">Expoter en PDF</a></li>
                                                                            <li class="action_projet"><a class="dropdown-item" href="{{ route('resultat_evaluation', [$pj->groupe_id]) }}">Evaluation à chaud</a></li>
                                                                            @if ($prj->type_formation_id == 1)
                                                                                <li class="action_projet"><a class="dropdown-item" href="{{ route('nouveauRapportFinale', [$pj->groupe_id]) }}" target="_blank">Rapport</a></li>
                                                                            @endif
                                                                        </ul>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8">
                                                                        <div class="collapse" id="collapseExample_{{$pj->groupe_id}}">
                                                                            <div class="card">
                                                                            <div class="row">
                                                                                <div class="col-md-5">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title">
                                                                                            <i class='bx bxs-customize' style="color: #011e2a;"></i>
                                                                                            <span style="color: #011e2a; font-weight: 500; text-transform: capitalize;">{{ $pj->nom_module }}</span>
                                                                                        </h5>
                                                                                        <hr>
                                                                                        <div class="row mb-2">
                                                                                            <div class="col-md-4">
                                                                                                <i class="bi bi-person-square"></i>
                                                                                                    <span style="color: #011e2a; font-weight: 500; font-size: 14px; text-transform: capitalize; margin-left: 4px;">
                                                                                                        formateurs
                                                                                                    </span>
                                                                                            </div>
                                                                                            <div class="col-md-8">
                                                                                                <a href="#">
                                                                                                    
                                                                                                    @php
                                                                                                        $dataDetails = $groupe->formateurData($pj->groupe_id);
                                                                                                        // var_dump($dataDetails);
                                                                                                    @endphp
                        
                                                                                                    @if ( count($dataDetails) > 0)
                                                                                                        @foreach ($dataDetails as $dataDetail)
                                                                                                            <span class='rounded-pill' style='padding: 4px 8px; color: #fff; background-color: #2193b0; font-size: 14px;'>{{ $dataDetail->nom_formateur }}</span>
                                                                                                        @endforeach
                                                                                                    @elseif(count($dataDetails) <= 0)
                                                                                                        <span class='rounded-pill' style='padding: 2px 7px; color: #fff; background-color: #014f70'>{{"--"}}</span>
                                                                                                    @endif
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mb-2">
                                                                                            <div class="col-md-4">
                                                                                                <i class="bi bi-people-fill"></i>
                                                                                                    <span style="color: #011e2a; font-weight: 500; font-size: 14px; text-transform: capitalize; margin-left: 4px;">
                                                                                                        Apprenants
                                                                                                    </span>
                                                                                            </div>
                                                                                            <div class="col-md-8">
                                                                                                <a href="#">
                                                                                                    @php
                                                                                                        $dataApprs = $groupe->dataApprenant($pj->cfp_id, $pj->groupe_id);
                                                                                                    @endphp
                        
                                                                                                    @if ( count($dataApprs) > 0)
                                                                                                        @foreach ($dataApprs as $dataAppr)
                                                                                                            <span class='rounded-pill' style='padding: 2px 6px; color: #fff; background-color: #014f70; display: inline-block; margin-bottom: 1px; font-size: 13px'>{{ $dataAppr->nom_stagiaire." ".$dataAppr->prenom_stagiaire }}</span>
                                                                                                        @endforeach
                                                                                                    @elseif(count($dataApprs) <= 0)
                                                                                                        <span class='rounded-pill' style='padding: 2px 7px; color: #fff; background-color: #014f70'>{{"--"}}</span>
                                                                                                    @endif
                                                                                                </a>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mb-2">
                                                                                            <div class="col-md-4">
                                                                                                <i class="bi bi-currency-dollar"></i>
                                                                                                    <span style="color: #011e2a; font-weight: 500; font-size: 14px; text-transform: capitalize; margin-left: 4px;">
                                                                                                        Frais annexes
                                                                                                    </span>
                                                                                            </div>
                                                                                            <div class="col-md-8">
                                                                                                    @php
                                                                                                        $dataFrais = $groupe->dataFraisAnnexe($pj->groupe_id, $pj->entreprise_id);
                                                                                                        
                                                                                                        $somme = 0;
                                                                                                        if (count($dataFrais) > 0) {
                                                                                                            foreach ($dataFrais as $dataFrai) {
                                                                                                                $somme += $dataFrai->montantTotal;
                                                                                                            }
                                                                                                        }
                                                                                                    @endphp
                                                                                                    
                                                                                                <span style="color: #275b75; font-size: 15px">{{ number_format($somme, 2, ',', ' ') }} <span>{{ $devise }}</span></span>  
                                                                                                    
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row mb-2">
                                                                                            <div class="col-md-4">
                                                                                                <i class="bi bi-cash-coin"></i>
                                                                                                    <span style="color: #011e2a; font-weight: 500; font-size: 14px; text-transform: capitalize; margin-left: 4px;">
                                                                                                        Coûts
                                                                                                    </span>
                                                                                            </div>
                                                                                            <div class="col-md-8">
                                                                                                    @php
                                                                                                        $dataFrais = $groupe->dataFraisAnnexe($pj->groupe_id, $pj->entreprise_id);
                                                                                                        
                                                                                                        $somme = 0;
                                                                                                        if (count($dataFrais) > 0) {
                                                                                                            foreach ($dataFrais as $dataFrai) {
                                                                                                                $somme += $dataFrai->montantTotal;
                                                                                                            }
                                                                                                        }
                                                                                                    @endphp
                                                                                                    
                                                                                                <span style="color: #275b75; font-size: 15px">{{ number_format($pj->prix, 2) }} <span>{{ $devise }}</span></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-7">
                                                                                    <div class="card-body">
                                                                                        <h5 class="card-title">
                                                                                            <i class="bi bi-calendar2-week" style="color: #011e2a;"></i>
                                                                                            <span style="color: #011e2a; font-weight: 500;">Calendrier des séances</span>
                                                                                        </h5>
                                                                                        <hr>
                                                                                            
                                                                                        @php
                                                                                            $dataSessions = $groupe->dataSession($pj->groupe_id);
                                                                                        @endphp
                                                                                        <div class="row">
                                                                                            <div class="col-md-12" style="background: #014f70; color: #fff;">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-2" >
                                                                                                        <span class="head">Séances</span>
                                                                                                    </div>
                                                                                                    <div class="col-md-2" >
                                                                                                        <span class="head">Date</span>
                                                                                                    </div>
                                                                                                    <div class="col-md-4">
                                                                                                        <span class="head">Lieu de formation</span>
                                                                                                    </div>
                                                                                                    <div class="col-md-2">
                                                                                                        <span class="head">Début</span>
                                                                                                    </div>
                                                                                                    <div class="col-md-2">
                                                                                                        <span class="head">Fin</span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <div class="col-md-12" >
                                                                                                <div class="row">
                                                                                                    @if ( count($dataSessions) > 0)
                                                                                                        <div class="col-md-2" >
                                                                                                            @php
                                                                                                                $i = 1;
                                                                                                            @endphp
                                                                                                            @foreach ($dataSessions as $dataSession)
                                                                                                                <p style="font-size: 13px">{{ $i++ }}</p>
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                        <div class="col-md-2" >
                                                                                                            @foreach ($dataSessions as $dataSession)
                                                                                                                <p style="font-size: 13px">{{ \Carbon\Carbon::parse($dataSession->date_detail)->translatedFormat('d M Y') }}</p>
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                        <div class="col-md-4">
                                                                                                            @foreach ($dataSessions as $dataSession)
                                                                                                            @php
                                                                                                                $salle = explode(',  ', $dataSession->lieu);
                                                                                                            @endphp
                                                                                                                <p style="font-size: 13px">{{ $salle[0]." ".$salle[1] }}</p>
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                        <div class="col-md-2">
                                                                                                            @foreach ($dataSessions as $dataSession)
                                                                                                                <p style="font-size: 13px">{{ $dataSession->h_debut}} </p>
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                        <div class="col-md-2">
                                                                                                            @foreach ($dataSessions as $dataSession)
                                                                                                                <p style="font-size: 13px">{{ $dataSession->h_fin}} </p>
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                    @elseif( count($dataSessions) <= 0)
                                                                                                    <div class="row">
                                                                                                            <div class="col-md-12">
                                                                                                                <span style="color: rgb(56, 121, 207)">Aucune séance</span>
                                                                                                            </div>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endcanany
            </div>
        </div>

        <div class="row w-100">

            <div class="col-12 ps-5">
                <div class="row">
                    @canany(['isCFP'])
                        <div class="m" id="corps">
                            <table class="table shadow-sm p-3 mb-5 bg-body rounded">
                                <tbody>
                                    @foreach ($projet as $prj)
                                        @foreach ($data as $pj)
                                            @if ($prj->projet_id == $pj->projet_id)
                                            {{-- fin table eto ambany --}}
                                            {{-- start all modal --}}
                                            <div>
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
                                            </div>
                                            {{-- end all modal --}}
                                            @if ($prj->type_formation_id == 2)
                                                @break
                                            @endif
                                        @endif
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                @endcanany
            </div>
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection
