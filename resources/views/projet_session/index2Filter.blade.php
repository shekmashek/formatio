@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Projets</p>
@endsection

@inject('groupe', 'App\groupe')
@section('content')
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

    .pagination{
        float: right;
        margin-bottom: 10px;
        font-size: 13px;
    }

    .dataTables_filter > label{
        display: none;
    }

    .dataTables_info, .dataTables_length, .headProject {
        font-size: 13px;
    }

    .redClass{
        color: #f44336 !important;
    }

    .arrowDrop{
        color: #1e9600;
        transition: 0.3s !important;
        transform: rotate(360deg) !important;
    }
    .mivadika{
        transform: rotate(180deg) !important;
        color: red !important;
        transition: 0.3s !important;
    }

    #example_length select{
        height: 25px;
        font-size: 13px;
        vertical-align: middle;
    }

    .myCircle:hover{
        color: #1e9600;
    }
    .hideAction{
        display: none;
    }

    .myTbody td{
        border: 1px solid #ffffff;
    }

</style>

    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-12 ps-2">
                @canany(['isCFP'])
                    @if (Session::has('groupe_error'))
                        <div class="alert alert-danger ms-2 me-2">
                            <ul>
                                <li>{!! \Session::get('groupe_error') !!}</li>
                            </ul>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <a href=" {{route('liste_projet')}} " class="btn btn-sm btn-dark mt-2 text-white float-end" style="width: 100px;"><i class='bx bx-caret-left' style="vertical-align: middle"></i> Retour</a>
                        </div>
                        <table class="table order-column" id="example">
                            <thead style="background: #d4d1d139;">
                                <tr class="myTh">
                                    <th >
                                        <i class='bx bx-library align-middle'></i> Projet
                                    </th>
                                    <th >
                                        <i class="bx bxs-book-open align-middle" style="color: #2e3950"></i> Session
                                    </th>
                                    <th >
                                        <i class="bx bxs-customize align-middle" style="color: #2e3950"></i> Module
                                    </th>
                                    <th >
                                        <i class='bx bx-building-house align-middle'></i> Entreprise
                                    </th>
                                    <th >
                                        <i class='bx bx-calendar-check align-middle' ></i> Modalité
                                    </th>
                                    <th >
                                        <i class='bx bx-dollar-circle align-middle' ></i> Montant
                                    </th>
                                    <th >
                                        <i class='bx bx-time-five'></i> <span style="font-size: 13px">Date</span>
                                    </th>
                                    <th >
                                        <i class='bx bx-home align-middle' ></i> Ville
                                    </th>
                                    <th >
                                        <i class='bx bx-book-content align-middle' style="vertical-align: middle"></i> Type
                                    </th>
                                    <th >
                                        <i class='bx bx-calendar-x align-middle' style="color: #2e3950"></i> Statuts
                                    </th>
                                    <th >
                                        <i class='bx bx-task align-middle' ></i> Eval à chaud
                                    </th>
                                    <th >
                                        <i class='bx bx-task-x align-middle' ></i> Eval à froid
                                    </th>
                                    <th >
                                        <i class='bx bxs-report align-middle' style="vertical-align: middle"></i> Rapport
                                    </th>
                                    <th >
                                        <i class='bx bx-timer align-middle' style="vertical-align: middle; font-size: 20px"></i> Présence
                                    </th>
                                    <th >
                                        <i class='bx bx-spa align-middle' style="vertical-align: middle"></i> Competence
                                    </th>
                                    <th >
                                        <i class='bx bxs-file-pdf align-middle' style="vertical-align: middle"></i> PDF
                                    </th>
                                    <th >
                                        <i class='bx bx-menu align-middle' style="vertical-align: middle"></i> Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="myTbody">
                                @foreach ($resultDate as $rd)
                                    <tr>
                                        <td >
                                            <span>
                                                <a role="button"  data-bs-toggle="modal" data-bs-target="#exampleModal_{{$rd->groupe_id}}">
                                                    <i class='bx bx-window-open' data-id="{{$rd->groupe_id}}" style="font-size: 18px; vertical-align: middle; color: #1c7f2e"></i>
                                                </a>&nbsp;&nbsp;
                                                <span class="myData">{{ $rd->nom_projet }}</span>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="myData">
                                                <a href="{{ route('detail_session', [$rd->groupe_id, $rd->id]) }}">
                                                    <span style="font-size: 13px"  class="spanClass">{{ $rd->session }}</span>
                                                    &nbsp;&nbsp;
                                                    <span>
                                                        <i class='bx bx-show' style="font-size: 20px; vertical-align: middle;"></i>
                                                    </span>
                                                </a>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="myData">{{ $rd->nom_module }}</span>
                                        </td>
                                        <td>
                                            <span class="myData">{{ $rd->nom_etp }}</span>
                                        </td>
                                        <td>
                                            <span style="z-index:-1!important" class="myData">{{ $rd->modalite }}</span>
                                        </td>
                                        <td class="text-end">
                                            <span style="font-size: 13px">0 Ar</span>
                                        </td>
                                        <td>
                                            <span class="myData">{{ \Carbon\Carbon::parse($rd->date_debut)->translatedFormat('d-m-y') }}</span> <span style="font-size: 11px">au</span> 
                                            <span class="myData">{{ \Carbon\Carbon::parse($rd->date_fin)->translatedFormat('d-m-y') }}</span>
                                        </td>
                                        @if ($rd->lieu == null)
                                            <td class="text-center">
                                                <span>{{ '-' }}</span>
                                            </td>
                                        @else
                                            <td>
                                                <span class="myData">{{ $rd->lieu }}</span>
                                            </td>
                                        @endif
                                        <td class="text-center">
                                            <span class="myData">{{ $rd->type_formation }}</span>
                                        </td>
                                        <td class="text-center">
                                            @if($rd->item_status_groupe === 'Cloturé')
                                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#111111"">Cloturé</span>
                                            @elseif($rd->item_status_groupe === 'Reporté')
                                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#af10e9"">Reporté</span>
                                            @elseif($rd->item_status_groupe === 'Prévisionnel')
                                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#2792e4"">Prévisionnel</span>
                                            @elseif($rd->item_status_groupe === 'Annulée')
                                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#b33939"">Annulée</span>
                                            @elseif($rd->item_status_groupe === 'Reprogrammer')    
                                                <span class="myData badge" style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#00CDAC">Reprogrammer</span>
                                            @endif 
                                        </td>
                                        <td class="text-center" style="font-size: 13px">
                                            @php
                                                $eval_chaud = $groupe->statut_evaluation($rd->groupe_id);
                                            @endphp
                                            @if($rd->date_debut > \Carbon\Carbon::today()->toDateString())
                                                <a href="{{ route('resultat_evaluation', [$rd->groupe_id]) }}" style="font-size: 13px">
                                                    <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #868686"></i>
                                                </a>
                                            @elseif($eval_chaud == 1)
                                                <a href="{{ route('resultat_evaluation', [$rd->groupe_id]) }}" style="font-size: 13px">
                                                    <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                                </a>
                                            @elseif($eval_chaud == 0)
                                                <a href="{{ route('resultat_evaluation', [$rd->groupe_id]) }}" style="font-size: 13px">
                                                    <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #b31217"></i>
                                                </a>
                                            @endif
                                        </td>
                                        <td class="text-center" style="font-size: 13px">
                                            <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                        </td>
                                        @if ($rd->id == 1)
                                            <td class="text-center" style="font-size: 13px">
                                                <a href="{{ route('nouveauRapportFinale', [$rd->groupe_id]) }}" target="_blank" style="font-size: 13px">
                                                    <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                                </a>
                                            </td>
                                        @else
                                            <td class="text-center">
                                                <i class='bx bxs-circle' style="font-size: 13px; cursor: not-allowed; color: #b31217"></i>
                                            </td>
                                        @endif
                                        <td class="text-center">
                                            <i class='bx bxs-circle' style="font-size: 13px; cursor: not-allowed; color: rgb(163, 162, 162)"></i>
                                        </td>
                                        <td class="text-center">
                                            <i class='bx bxs-circle' style="font-size: 13px; cursor: not-allowed; color: #1c7f2e"></i>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('fiche_technique_pdf', [$rd->groupe_id]) }}" style="font-size: 13px">
                                                <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <i style="color: rgb(25, 193, 225); cursor: pointer;font-size:20px" class='bx bx-edit'data-bs-toggle="modal" data-bs-target="#modal_modifier_session_{{ $rd->groupe_id }}" data-backdrop="static"></i>
                                        </td>
                                    </tr>

                                    <div class="modal fade"  id="exampleModal_{{$rd->groupe_id}}" data-bs-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-xl " >
                                        <div class="modal-content" style="width: 1800px">
                                            <div class="modal-header text-dark" style="background: whitesmoke;color:gray !important">
                                            <h5 class="modal-title" id="exampleModalLabel">
                                                {{ $rd->nom_module }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                
                                                <div  id="collapseProject_{{$rd->groupe_id}}">
                                                    <div class="card card-xl" >
                                                        <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">
                                                                        <i class='bx bxs-customize' style="color: #011e2a;"></i>
                                                                        <span style="color: #011e2a; font-weight: 500; text-transform: capitalize; font-size: 16px">{{ $rd->nom_module }}</span>
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
                                                                                    $dataDetails = $groupe->formateurData($rd->groupe_id);
                                                                                @endphp
                
                                                                                @if ( count($dataDetails) > 0)
                                                                                    @foreach ($dataDetails as $dataDetail)
                                                                                        <span class='rounded-pill' style='padding: 4px 8px; border: 1px solid #e4e4e498; color: #011e2a; font-size: 14px;'>{{ $dataDetail->nom_formateur }}</span>
                                                                                    @endforeach
                                                                                @elseif(count($dataDetails) <= 0)
                                                                                    <span class='rounded-pill' style='padding: 2px 7px; border: 1px solid #e4e4e498; color: #011e2a;'>{{"--"}}</span>
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
                                                                                    $dataApprs = $groupe->dataApprenant($rd->entreprise_id, $rd->groupe_id);
                                                                                    $dataNombres = $groupe->dataNombre($rd->groupe_id);
                                                                                @endphp
                
                                                                                @if ( count($dataApprs) > 0)
                                                                                    @foreach ($dataApprs as $dataAppr)
                                                                                        <span class='rounded-pill' style='padding: 2px 6px; border: 1px solid #e4e4e498; color: #011e2a; display: inline-block; margin-bottom: 1px; font-size: 13px'>{{ $dataAppr->nom_stagiaire." ".$dataAppr->prenom_stagiaire }}</span>
                                                                                    @endforeach
                                                                                @elseif(count($dataApprs) <= 0)
                                                                                    
                                                                                @endif
                                                                            </a>
                                                                            @foreach ($dataNombres as $nbr)
                                                                                <span class='rounded-pill' style='padding: 4px 8px; border: 1px solid #e4e4e498; color: #011e2a; font-size: 13px;'>{{$nbr->nombre}}</span>
                                                                            @endforeach
                
                                                                            <a data-bs-toggle="collapse" href="#collapseNombre" role="button" aria-expanded="false" aria-controls="collapseNombre">
                                                                                <i class='bx bx-chevron-down' style="vertical-align: middle; font-size: 25px;"></i>
                                                                                <div class="collapse" id="collapseNombre">
                                                                                    <div class="card card-body">
                                                                                        <a href="#">
                                                                                            @php
                                                                                                $dataAllApprs = $groupe->dataApprenantAll($rd->groupe_id);
                                                                                            @endphp
                
                                                                                            @if ( count($dataAllApprs) > 0)
                                                                                                @foreach ($dataAllApprs as $dataAllAppr)
                                                                                                    <span class='rounded-pill' style='padding: 2px 6px; border: 1px solid #e4e4e498; color: #011e2a; display: inline-block; margin-bottom: 1px; font-size: 13px'>{{ $dataAllAppr->nom_stagiaire." ".$dataAllAppr->prenom_stagiaire }}</span>
                                                                                                @endforeach
                                                                                            @elseif(count($dataAllApprs) <= 0)
                                                                                                <span class='rounded-pill' style='padding: 4px 8px; border: 1px solid #e4e4e498; color: #011e2a; font-size: 13px;'>0</span>
                                                                                            @endif
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
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
                                                                                    $dataFrais = $groupe->dataFraisAnnexe($rd->groupe_id, $rd->entreprise_id);
                
                                                                                    $somme = 0;
                                                                                    if (count($dataFrais) > 0) {
                                                                                        foreach ($dataFrais as $dataFrai) {
                                                                                            $somme += $dataFrai->montantTotal;
                                                                                        }
                                                                                    }
                                                                                @endphp
                
                                                                            <span style="color: #011e2a; font-size: 13px">{{ number_format($somme, 2, ',', ' ') }} <span style="font-size: 12px">{{ $devise }}</span></span>
                
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
                
                                                                            <span style="color: #011e2a; font-size: 13px">00 <span style="font-size: 12px">{{ $devise }}</span></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-7">
                                                                <div class="card-body">
                                                                    <h5 class="card-title">
                                                                        <i class='bx bx-calendar' style="color: #011e2a;"></i>
                                                                        <span style="color: #011e2a; font-weight: 500; font-size: 16px">Calendrier des séances</span>
                                                                    </h5>
                                                                    <hr>
                
                                                                    @php
                                                                        $dataSessions = $groupe->dataSession($rd->groupe_id);
                                                                    @endphp
                                                                    <div class="row">
                                                                        @php
                                                                            $info = $groupe->infos_session($rd->groupe_id);
                                                                            if ($info->difference == null && $info->nb_detail == 0) {
                                                                                echo "<span style='font-size: 13px'>".$info->nb_detail . ' séance , durée totale : ' . gmdate('H', $info->difference) . ' h ' . gmdate('i', $info->difference) . ' m'."</span>";
                                                                            } elseif ($info->difference != null && $info->nb_detail == 1) {
                                                                                echo "<span style='font-size: 13px'>".$info->nb_detail . ' séance , durée totale : ' . gmdate('H', $info->difference) . ' h ' . gmdate('i', $info->difference) . ' m'."</span>";
                                                                            } elseif ($info->difference != null && $info->nb_detail > 1) {
                                                                                echo "<span style='font-size: 13px'>".$info->nb_detail . ' séances , durée totale : ' . gmdate('H', $info->difference) . ' h ' . gmdate('i', $info->difference) . ' m'."</span>";
                                                                            }
                                                                        @endphp
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12" style="background: #e4e4e498;">
                                                                            <div class="row">
                                                                                <div class="col-md-2" >
                                                                                    <span class="headEtp">Séances</span>
                                                                                </div>
                                                                                <div class="col-md-2" >
                                                                                    <span class="headEtp">Date</span>
                                                                                </div>
                                                                                <div class="col-md-4">
                                                                                    <span class="headEtp">Lieu de formation</span>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <span class="headEtp">Début</span>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <span class="headEtp">Fin</span>
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
                                                                                            <span style="font-size: 13px; color: #011e2a">Aucune séance</span>
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
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="modal fade" id="delete_session_{{ $rd->groupe_id }}"
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
                                                                href="{{ route('destroy_groupe', [$rd->groupe_id]) }}">Oui</a></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- fin supprimer session --}}
                                        {{-- Debut modal edit session --}}
                                        <div>
                                            <div class="modal fade"
                                                id="modal_modifier_session_{{ $rd->groupe_id }}"
                                                data-backdrop="static" data-bs-backdrop="false">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content p-3">
                                                        <div class="modal-title pt-3"
                                                            style="height: 50px; align-items: center;">
                                                            <h5 class="text-center my-auto">Modifier session
                                                                <strong>{{ $rd->session }}</strong>
                                                            </h5>
                                                        </div>
                                                        @if ($rd->id == 1)
                                                            <div class="row">
                                                                <form
                                                                    action="{{ route('modifier_session_intra') }}"
                                                                    id="formPayement" method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $rd->groupe_id }}">
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
                                                                                                value="{{ $rd->date_debut }}">
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
                                                                                                    value="{{ $rd->formation_id }}">
                                                                                                    {{ $rd->nom_formation }}
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
                                                                                                value="{{ $rd->date_fin }}">
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
                                                                                                    value="{{ $rd->module_id }}">
                                                                                                    {{ $rd->nom_module }}
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
                                                                                                value="{{ $rd->type_payement_id }}"
                                                                                                hidden>
                                                                                                {{ $rd->type }}
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
                                                                                                value="{{ $rd->min_participant }}">
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
                                                                            </div>
                                                                            <div class="row ps-3 mt-2">
                                                                                <div
                                                                                    class="col-lg-6 text-end mt-2">
                                                                                    <span>Module<strong
                                                                                            class="text-danger">*</strong>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="col-lg-6 text-start">
                                                                                    <select
                                                                                        class="form-select input_select"
                                                                                        name="module"
                                                                                        aria-label="Default select example"
                                                                                        style="width: 15rem;"
                                                                                        required>
                                                                                        <option value="null">
                                                                                            Sélectionnez</option>
                                                                                        @foreach ($module as $modu)
                                                                                            <option value="{{ $modu->id }}">{{ $modu->nom_module }}</option>
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-2">
                                                                                <div
                                                                                    class="col-lg-6 text-end mt-2">
                                                                                    <span>Modalité<strong
                                                                                            class="text-danger">*</strong>
                                                                                    </span>
                                                                                </div>
                                                                                <div class="col-lg-6 text-start">
                                                                                    <select
                                                                                        class="form-select selectP input"
                                                                                        id="module_id"
                                                                                        name="module_id"
                                                                                        aria-label="Default select example">
                                                                                        <option
                                                                                            value="{{ $rd->module_id }}">
                                                                                            {{ $rd->nom_module }}
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
                                                                </form>
                                                            </div>
                                                        @endif
                                                        @if ($rd->id == 2)
                                                            <div class="row">
                                                                <div class="form-group">
                                                                    <div class="form-row d-flex">
                                                                        <form
                                                                            action="{{ route('modifier_session_inter') }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            <input type="hidden" name="id"
                                                                                value="{{ $rd->groupe_id }}">
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
                                                                                            value="{{ $rd->date_debut }}">
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
                                                                                            value="{{ $rd->min_participant }}">
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
                                                                                            value="{{ $rd->date_fin }}">
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
                                                                                            value="{{ $rd->max_participant }}">
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

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Fin modal edit session --}}
                                        {{-- debut modal nouveau session --}}
                                        <div>
                                            <div id="modal_{{ $rd->projet_id }}"
                                                class="modal fade modal_projets">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="w-100 text-center">Nouvelle Session pour
                                                                le&nbsp;{{ $rd->nom_projet }}
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
                                                                    value="{{ $rd->projet_id }}">
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
                                            <div id="edit_prj_{{ $rd->projet_id }}"
                                                class="modal fade modal_projets">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="text-center w-100">Modification de la
                                                                Status du
                                                                Session dans le&nbsp;{{ $rd->nom_projet }}
                                                            </h5>

                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('update_projet', $rd->projet_id) }}"
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
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endcanany
            </div>
        </div>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function () {
            var table = $('#example').removeAttr('width').DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                "ordering": false,
                "language": {
                    "paginate": {
                    "previous": "précédent",
                    "next": "suivant"
                    },
                    "search": "Recherche :",
                    "zeroRecords":    "Aucun résultat trouvé",
                    "infoEmpty":      " 0 trouvés",
                    "info":           "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
                    "infoFiltered":   "(filtre sur _MAX_ entrées)",
                    "lengthMenu":     "Affichage _MENU_ ",
                }
            });
        });
    </script>
@endsection
