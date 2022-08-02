@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Projets</p>
@endsection

@inject('groupe', 'App\groupe')
@inject('carbon', 'Carbon\Carbon')
@inject('froidEval', 'App\FroidEvaluation')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="http://infra.clarin.eu/content/libs/DataTables-1.10.6/extensions/ColVis/css/dataTables.colVis.css">
<style>
    .dataTables_empty{
        font-size: 13px;
    }

    /* colvis */
    th, td { 
        white-space: nowrap; 
        border: none;
    }

    div.dataTables_wrapper {
        width: 95%;
        margin: 0 auto;
    }

    div.ColVis {
        float: left;
    }
    .DTFC_LeftBodyLiner{
        margin-top:-12px;
        padding-top: 0px;
        background: #ffff;
    }

    ul.ColVis_collection{
        box-shadow: none !important;
        background: #f3f3f3 !important;
        font-size: 12px !important;
    }

    ul.ColVis_collection li span{
        font-size: 14px !important;
    }

    ul.ColVis_collection li{
        background: #f3f3f3;
        box-shadow: none !important;
        border: none;
        font-size: 12px !important;
    }
    ul.ColVis_collection li:hover{
        background: #f3f3f3;
        box-shadow: none !important;
        border: none;
        font-size: 12px !important;
    }
    .myTh th{
        font-size: 0px; 
        padding: 0;
        background: white; 
        border: 1px solid #fff !important;
    }
    .myData{
        font-size: 12px;
    }
    #example{
        padding-bottom: 20px !important; 
    }
    
    .dataTables_wrapper.no-footer div.dataTables_scrollBody > table {
        position: relative; 
        z-index: 0;
        
    }

    .table{
        overflow: unset !important;
    }
    button.ColVis_Button{
        box-shadow: none;
        font-size: 12px;
        height: 25px;
        background: #ffff !important;
        color: rgb(73, 69, 69) !important;
    }
    button.ColVis_Button:hover{
        box-shadow: none !important;
    }

    div.dataTables_scrollHead {
        overflow: visible !important;
    }
    div.DTFC_LeftHeadWrapper{
        overflow: visible !important;
    }

    .popover{
        max-width:500px;
    }

</style>
    @if (count($projet) <= 0)
        <div class="container mt-3 p-1 mb-1">
            <div id="popup">
                <div class="row">
                    <div class="col text-center">
                        <i class='bx bxs-plus-circle icon_upgrade me-3'></i>
                        @if($abonnement_cfp[0]->illimite != 1)
                            @if($nb_formateur == 0 || $nb_formateur == 0 || $nb_collaboration == 0)Vous n’avez pas encore de projet @if($nb_modules == 0)pour en créer un ajouter d’abord des modules a votre <a data-bs-toggle="modal" data-bs-target="#nouveau_module" role="button" class="text-primary lien_condition">catalogue de formation</a>.@endif @if($nb_formateur == 0)<a href="{{route('liste_formateur')}}" class="text-primary lien_condition">Ajouter des formateurs</a>.@endif @if($nb_collaboration == 0)<a href="{{route('liste_entreprise')}}" class="text-primary lien_condition">Inviter des entreprises.</a>@endif .@endif @if($nb_formateur != 0 && $nb_formateur != 0 && $nb_collaboration != 0)Maintenant vous pouvez créer votre premier projet de formation <a href="{{route('nouveau_groupe',1)}}" class="text-primary lien_condition">intra</a> @if($abonnement_cfp != null) ou <a href="{{route('nouveau_groupe_inter',2)}}" class="text-primary lien_condition">inter</a>@endif.@endif
                        @else
                            <span>Votre abonnement actuel vous permet de faire un nombre illimités de projets.</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="text-center mt-5">
                <img src="{{asset('img/folder(1).webp')}}" alt="folder empty" width="300px" height="300px">
                <p>Aucun projet en cours</p>
            </div>
        </div>
    @endif
    @if (Session::has('groupe_error'))
        <div class="alert alert-danger ms-2 me-2">
            <ul>
                <li>{!! \Session::get('groupe_error') !!}</li>
            </ul>
        </div>
    @endif

        <table class="table order-column" id="example">
            <thead  style=" top: 0">
                <tr style="background: #d4d1d139;margin-top:-10px">
                    <th >
                        <div class="dropdown">
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-library align-middle'></i> Projet
                            </button>
                            <ul class="dropdown-menu main p-2" >
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all">
                                    <label class="form-check-label label" for="select_all" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomProjet as $prj)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Projet2" value="{{ $prj->nom_projet}}"><span style="font-size: 12px">{{ $prj->nom_projet}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                    <th >
                        <div class="dropdown">
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bxs-book-open align-middle" style="color: #2e3950"></i> Session
                            </button>
                            <ul class="dropdown-menu main p-2" >
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all">
                                    <label class="form-check-label label" for="select_all" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomSessions as $s)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Session2" value="{{ $s->nom_groupe}}"><span style="font-size: 12px">{{ $s->nom_groupe}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                    
                    <th class="headProject" >
                        <div class="dropdown">
                
                            <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bxs-customize align-middle" style="color: #2e3950"></i> Module
                            </button>
                            {{-- <ul  class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all23">
                                    <label class="form-check-label label" for="select_all23" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomModules as $m)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Module2" value="{{ $m->nom_module}}"><span style="font-size: 12px">{{ $m->nom_module}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul> --}}
                        </div>
                    </th>
                    <th class="headProject" >
                        <div class="dropdown z-index-2" id="ta">
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-building-house align-middle'></i> Entreprise
                            </button>
                            
                            <ul  class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all3">
                                    <label class="form-check-label label" for="select_all3" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomEntreprises as $e)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Entreprise2" value="{{ $e->nom_etp}}"><span style="font-size: 12px">{{ $e->nom_etp}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                    <th >
                        <div class="dropdown" >
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-calendar-check align-middle' ></i> Modalité
                            </button>
                            <ul class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all4">
                                    <label class="form-check-label label" for="select_all4" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomModalites as $mdlt)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Modalite2" value="{{ $mdlt->modalite}}"><span style="font-size: 12px">{{ $mdlt->modalite}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                        </ul>
                        </div>
                    </th>
                    <th>
                        <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bx bx-dollar-circle align-middle' ></i> Montant
                        </button>
                    </th>
                    <th>
                        <div class="dropdown">
                            <a id="exampleE1" tabindex="0" class="btn btn-sm btn-default" role="button" data-bs-toggle="popover" title="Recherche entre 2 périodes" style="width: 100%;">
                                <i class='bx bx-time-five'></i> <span style="font-size: 13px">Date</span> &nbsp;&nbsp;<i class='bx bx-caret-down' style="font-size: 12px"></i>
                            </a>
                        </div>
                        <div hidden>
                            <div data-name="popover-content">
                                <table class="table">
                                    <thead>
                                        <form action="{{ route('project.filterBydate') }}" method="post">
                                            @csrf
                                            <tr>
                                                <th style="font-size: 12px; font-weight: 400;">De</th>
                                                <th style="font-size: 12px; font-weight: 400;">A</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <th>
                                                    <div class="input-group input-group-sm" style="width: 98%;">
                                                        <input type="date" name="from" id="from" value="{{ date('Y-m-d')}}" class="form-control form-control-sm @error('from') is-invalid @enderror" style="font-size: 13px">
                                                        <span class="input-group-text" id="basic-addon1"><i class='bx bx-calendar' style="font-size: 20px"></i></span>
                                                        @error('from')
                                                            <span class="text-danger" style="font-size: 12px">{{ "Ce champs est obligatoire" }}</span>
                                                        @enderror
                                                    </div>
                                                </th>
                                                <th>
                                                    <div class="input-group input-group-sm" style="width: 98%;">
                                                        <input type="date" name="to" id="to" value="{{ date('Y-m-d')}}" class="form-control form-control-sm @error('to') is-invalid @enderror" style="font-size: 13px">
                                                        <span class="input-group-text" id="basic-addon1"><i class='bx bx-calendar' style="font-size: 20px"></i></span>
                                                        @error('to')
                                                            <span class="text-danger" style="font-size: 12px">{{ "Ce champs est obligatoire" }}</span>
                                                        @enderror
                                                    </div>
                                                </th>
                                                <th>
                                                    <button type="submit" class="btn btn-sm btn-primary">Filtrer <i class='bx bx-search-alt-2' style="font-size: 20px; vertical-align: middle;"></i></button>
                                                </th>
                                            </tr>
                                        </form>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </th>
                    <th  >
                        <div class="dropdown" >
                            <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-home align-middle' ></i> Ville
                            </button>
                        </div>
                    </th>
                    <th >
                        <div class="dropdown" >
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-book-content align-middle' style="vertical-align: middle"></i> Type
                            </button>
                            <ul class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all6">
                                    <label class="form-check-label label" for="select_all6" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomTypes as $ntp)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Type2" value="{{ $ntp->type_formation}}"><span style="font-size: 12px">{{ $ntp->type_formation}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                    <th  >
                        <div class="dropdown" >
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-calendar-x align-middle' style="color: #2e3950"></i> Statuts
                            </button>
                            <ul class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all2" type="checkbox" id="select_all1">
                                    <label class="form-check-label label" for="select_all1" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomStatuts as $stt)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox2 form-check-input" type="checkbox" name="Statut2" value="{{ $stt->item_status_groupe}}"><span style="font-size: 12px">{{ $stt->item_status_groupe}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                
                    <th >
                        <div class="dropdown" >
                            <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-task align-middle' ></i> Eval à chaud
                            </button>
                        </div>
                    </th>
                    <th >
                        <div class="dropdown" >
                            <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-task-x align-middle' ></i> Eval à froid
                            </button>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown" >
                                <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bxs-report align-middle' style="vertical-align: middle"></i> Rapport
                                </button>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown" >
                                <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-timer align-middle' style="vertical-align: middle; font-size: 20px"></i> Présence
                                </button>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown" >
                                <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-spa align-middle' style="vertical-align: middle"></i> Competence
                                </button>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown" >
                                <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bxs-file-pdf align-middle' style="vertical-align: middle"></i> PDF
                                </button>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown" >
                                <button style="cursor: default !important; font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='bx bx-menu align-middle' style="vertical-align: middle"></i> Action
                                </button>
                        </div>
                    </th>
                </tr>
                <tr class="myTh">
                    <th >Projet</th>
                    <th >Session</th>
                    <th >Module</th>
                    <th >Entreprise</th>
                    <th >Modalité</th>
                    <th >Montant</th>
                    <th >Date</th>
                    <th >Ville</th>
                    <th >Type</th>
                    <th >Statuts</th>
                    <th >Eval à chaud</th>
                    <th >Eval à froid</th>
                    <th >Rapport</th>
                    <th >Présence</th>
                    <th >Competence</th>
                    <th >PDF</th>
                    <th >Action</th>
                </tr>
            </thead>
            <tbody class="myTbody">
                @foreach ($fullProjects as $projet)
                    <tr class="tab">
                        <td >
                            <span>
                                <a role="button"  data-bs-toggle="modal" data-bs-target="#exampleModal_{{$projet->groupe_id}}">
                                    <i class='bx bx-window-open' data-id="{{$projet->groupe_id}}" style="font-size: 18px; vertical-align: middle; color: #1c7f2e"></i>
                                </a>&nbsp;&nbsp;
                                <span class="myData">{{ $projet->nom_projet }}</span>
                            </span>
                        </td>
                        <td>
                            <span class="myData">
                                <a href="{{ route('detail_session', [$projet->groupe_id, $projet->id]) }}">
                                    <span style="font-size: 13px"  class="spanClass">{{ $projet->session }}</span>
                                    &nbsp;&nbsp;
                                    <span>
                                        <i class='bx bx-show' style="font-size: 20px; vertical-align: middle;"></i>
                                    </span>
                                </a>
                            </span>
                        </td>
                        <td>
                            <span class="myData">{{ $projet->nom_module }}</span>
                        </td>
                        <td>
                            <span class="myData">{{ $projet->nom_etp }}</span>
                        </td>
                        <td>
                            <span style="z-index:-1!important" class="myData">{{ $projet->modalite }}</span>
                        </td>
                        <td class="text-end">
                            <span style="font-size: 13px">0 Ar</span>
                        </td>
                        <td>
                            <span class="myData">{{ \Carbon\Carbon::parse($projet->date_debut)->translatedFormat('d-m-y') }}</span> <span style="font-size: 11px">au</span> 
                            <span class="myData">{{ \Carbon\Carbon::parse($projet->date_fin)->translatedFormat('d-m-y') }}</span>
                        </td>
                        @if ($projet->lieu == null)
                            <td class="text-center">
                                <span>{{ '-' }}</span>
                            </td>
                        @else
                            <td>
                                <span class="myData">{{ $projet->lieu }}</span>
                            </td>
                        @endif
                        <td class="text-center">
                            <span class="myData">{{ $projet->type_formation }}</span>
                        </td>
                        <td class="text-center">
                            @if($projet->item_status_groupe === 'Cloturé')
                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#111111"">Cloturé</span>
                            @elseif($projet->item_status_groupe === 'Reporté')
                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#af10e9"">Reporté</span>
                            @elseif($projet->item_status_groupe === 'Prévisionnel')
                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#2792e4"">Prévisionnel</span>
                            @elseif($projet->item_status_groupe === 'Annulée')
                                <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#b33939"">Annulée</span>
                            @elseif($projet->item_status_groupe === 'Reprogrammer')    
                                <span class="myData badge" style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#00CDAC">Reprogrammer</span>
                            @endif 
                        </td>

                        <td class="text-center" style="font-size: 13px">
                            @php
                                $eval_chaud = $groupe->statut_evaluation($projet->groupe_id);
                            @endphp
                            @if($projet->date_debut > \Carbon\Carbon::today()->toDateString())
                                <a href="{{ route('resultat_evaluation', [$projet->groupe_id]) }}" style="font-size: 13px">
                                    <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #868686"></i>
                                </a>
                            @elseif($eval_chaud == 1)
                                <a href="{{ route('resultat_evaluation', [$projet->groupe_id]) }}" style="font-size: 13px">
                                    <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                </a>
                            @elseif($eval_chaud == 0)
                                <a href="{{ route('resultat_evaluation', [$projet->groupe_id]) }}" style="font-size: 13px">
                                    <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #b31217"></i>
                                </a>
                            @endif
                        </td>
                        <td class="text-center" style="font-size: 13px">
                            <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                        </td>

                        
                        @if ($projet->id == 1)
                            <td class="text-center" style="font-size: 13px">
                                <a href="{{ route('nouveauRapportFinale', [$projet->groupe_id]) }}" target="_blank" style="font-size: 13px">
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
                            <a href="{{ route('fiche_technique_pdf', [$projet->groupe_id]) }}" style="font-size: 13px">
                                <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                            </a>
                        </td>
                        <td class="text-center">
                            
                                <i style="color: rgb(25, 193, 225); cursor: pointer;font-size:20px" class='bx bx-edit'data-bs-toggle="modal" data-bs-target="#modal_modifier_session_{{ $projet->groupe_id }}" data-backdrop="static"></i>
                           
                        </td>
                    </tr>

                    <div class="modal fade  "  id="exampleModal_{{$projet->groupe_id}}" data-bs-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl " >
                        <div class="modal-content" style="width: 1800px">
                            <div class="modal-header text-dark" style="background: whitesmoke;color:gray !important">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ $projet->nom_module }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                
                                <div  id="collapseProject_{{$projet->groupe_id}}">
                                    <div class="card card-xl" >
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <i class='bx bxs-customize' style="color: #011e2a;"></i>
                                                        <span style="color: #011e2a; font-weight: 500; text-transform: capitalize; font-size: 16px">{{ $projet->nom_module }}</span>
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
                                                                    $dataDetails = $groupe->formateurData($projet->groupe_id);
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
                                                                    $dataApprs = $groupe->dataApprenant($projet->entreprise_id, $projet->groupe_id);
                                                                    $dataNombres = $groupe->dataNombre($projet->groupe_id);
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
                                                                                $dataAllApprs = $groupe->dataApprenantAll($projet->groupe_id);
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
                                                                    $dataFrais = $groupe->dataFraisAnnexe($projet->groupe_id, $projet->entreprise_id);

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
                                                        $dataSessions = $groupe->dataSession($projet->groupe_id);
                                                    @endphp
                                                    <div class="row">
                                                        @php
                                                            $info = $groupe->infos_session($projet->groupe_id);
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
                            {{-- <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            
                            </div> --}}
                        </div>
                        </div>
                    </div>

                    
                @endforeach
                @foreach ($data as $pj)
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
                            data-backdrop="static" data-bs-backdrop="false">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content p-3">
                                    <div class="modal-title pt-3"
                                        style="height: 50px; align-items: center;">
                                        <h5 class="text-center my-auto">Modifier session
                                            <strong>{{ $pj->nom_groupe }}</strong>
                                        </h5>
                                    </div>
                                    @if ($projet->id == 1)
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
                                            </form>
                                        </div>
                                    @endif
                                    @if ($projet->id == 2)
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
                @endforeach
            </tbody>
        </table>
@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="http://infra.clarin.eu/content/libs/DataTables-1.10.6/extensions/ColVis/js/dataTables.colVis.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

    <script type='text/javascript'>
        $(document).ready(function() {
            var options = {
                html: true,
                title: "Optional: HELLO(Will overide the default-the inline title)",
                content: $('[data-name="popover-content"]')
            }
            var example = document.getElementById('exampleE1')
            var popover = new bootstrap.Popover(example, options)
        })
    </script>

    <script>
        $(document).ready(function() {
            var table1 = $('.mahafaly').DataTable({
                // dom:            "Bfrtip",
                "dom": 'C<"clear">lfrtip',
                // scrollY:        "500px",
                scrollX:        true,
                // scrollCollapse: true,
                paging:         true,
                buttons:        [ 'colvis','colonne' ],
                select: true,
                ordering:false,
                "bAutoWidth": false,
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
                    "buttonText": "Change colonne"
                },
                "colVis": {
                    "label": function ( index, title, th ) {
                        return (index+1) +'. '+ title;
                    }
                }
            });

            $('input:checkbox').on('change', function () {
                var Projet1 = $('input:checkbox[name="Projet1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(0).search(Projet1, true,false,false).draw();

                var Session1 = $('input:checkbox[name="Session1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(1).search(Session1, true,false,false).draw();

                var Module1 = $('input:checkbox[name="Module1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(2).search(Module1, true,false,false).draw();

                var Cfp1 = $('input:checkbox[name="Cfp1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(3).search(Cfp1, true,false,false).draw();

                var Statut1 = $('input:checkbox[name="Statut1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(7).search(Statut1, true,false,false).draw();

                var Type1 = $('input:checkbox[name="Type1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(8).search(Type1, true,false,false).draw();
                
                
                // select all
                $('.select_all1').on('click', function(){
                    if(this.checked){
                        $('.checkbox').each(function(){
                            this.checked = true;
                        });
                    }else{
                        $('.checkbox').each(function(){
                            this.checked = false;
                        });
                    }
                });

                $('.checkbox').on('click', function(){
                    if(('.checkbox:checked').length == $('.checkboxx').length){
                        $('.select_all1').prop('checked', true);
                    } else{
                        $('.select_all1').prop('checked', false);
                    }
                });
                // end select all
            });

            var table = $('#example').DataTable( {
                // dom:            "Bfrtip",
                "dom": 'C<"clear">lfrtip',
                // scrollY:        "500px",
                scrollX:        true,
                // scrollCollapse: true,
                paging:         true,
                buttons:        [ 'colvis','colonne' ],
                select: true,
                ordering:false,
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
                    "buttonText": "Change colonne"
                },
                "colVis": {
                    "label": function ( index, title, th ) {
                        return (index+1) +'. '+ title;
                    }
                }
            } );

            $('.ColVis_Button').text('Afficher / Masquer');

            new $.fn.dataTable.FixedColumns( table, {
                leftColumns: 3,
            } );
            $('.ColVis_Button').text('Afficher / Masquer');

            $('input:checkbox').on('change', function () {
                var Projet2 = $('input:checkbox[name="Projet2"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(0).search(Projet2, true,false,false).draw();

                var Session2 = $('input:checkbox[name="Session2"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(1).search(Session2, true,false,false).draw();

                
                // var Module2 = $('input:checkbox[name="Module2"]:checked').map(function() {
                //     return this.value;
                // }).get().join('|');
                
                // table.column(2).search(Module2, true,false,false).draw();

                
                var Entreprise2 = $('input:checkbox[name="Entreprise2"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(3).search(Entreprise2, true,false,false).draw();

                var Modalite2 = $('input:checkbox[name="Modalite2"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(4).search(Modalite2, true,false,false).draw();
                
                var Type2 = $('input:checkbox[name="Type2"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(8).search(Type2, true,false,false).draw();

                var Statut2 = $('input:checkbox[name="Statut2"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table.column(9).search(Statut2, true,false,false).draw();
                // select all
                $('.select_all2').on('click', function(){
                    if(this.checked){
                        $('.checkbox2').each(function(){
                            this.checked = true;
                        });
                    }else{
                        $('.checkbox2').each(function(){
                            this.checked = false;
                        });
                    }
                });

                $('.checkbox2').on('click', function(){
                    if(('.checkbox2:checked').length == $('.checkbox2').length){
                        $('.select_all2').prop('checked', true);
                    } else{
                        $('.select_all2').prop('checked', false);
                    }
                });
                // end select all
            });

            $('.column_search').on('keyup' ,function () {
                console.log($(this).val());
                table.column( $(this).parent().parent().parent().parent().index() ).search( this.value ).draw();
            } );
        } );
    </script>
@endsection