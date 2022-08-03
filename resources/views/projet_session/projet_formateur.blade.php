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
</style>

@if (count($data) <= 0)
<div class="d-flex mt-3 titre_projet p-1 mb-1">
    <span class="text-center">Vous n'avez pas encore du projet.</span>
</div>
@else
<table class="table m-0 p-0 mt-2 table-borderless mahafaly2">
    <thead style="background: #c7c9c939">
        <tr>
            <th class="myTh">
                <i class='bx bx-library align-middle'></i> Projet
            </th>
            <th class="myTh">
                <i class="bx bxs-book-open align-middle" style="color: #2e3950"></i> Session
            </th>
            <th class="myTh">
                <i class="bx bxs-customize align-middle" style="color: #2e3950"></i> Module
            </th>
            <th class="myTh">
                <i class='bx bx-building-house align-middle'></i> Entreprise
            </th>
            <th class="myTh">
                <i class='bx bx-calendar-check align-middle' ></i> Modalité
            </th>
            <th class="myTh">
                <i class='bx bx-time-five'></i> <span style="font-size: 13px">Date</span>
            </th>
            <th class="myTh">
                <i class='bx bx-book-content align-middle' style="vertical-align: middle"></i> Type
            </th>
            <th class="myTh">
                <i class='bx bx-calendar-x align-middle' style="color: #2e3950"></i> Statuts
            </th>
            <th class="myTh">Emargement</th>
            <th class="myTh">
                <i class='bx bxs-file-pdf align-middle' style="vertical-align: middle"></i> PDF
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $pj)
            <tr class="m-0">
                <td class="myTh">
                    {{ $pj->nom_projet }}
                </td>
                
                <td>
                    <span class="myData">
                        <a href="{{ route('detail_session', [$pj->groupe_id, $pj->type_formation_id]) }}">
                            <span style="font-size: 13px"  class="spanClass">{{ $pj->nom_groupe }}</span>
                            &nbsp;&nbsp;
                            <span>
                                <i class='bx bx-show' style="font-size: 20px; vertical-align: middle;"></i>
                            </span>
                        </a>
                    </span>
                </td>
                <td class="myTh text-start">
                    {{ $pj->nom_module }}
                    @php
                        '&nbsp;' . $groupe->nombre_apprenant_session($pj->groupe_id);
                    @endphp
                </td>
                <td class="myTh text-start">
                    @foreach ($entreprise as $etp)
                        @if ($etp->groupe_id == $pj->groupe_id)
                            {{ $etp->nom_etp }}
                        @endif
                    @endforeach
                </td>
                <td class="myTh">
                    <span style="font-size: 13px">{{ $pj->modalite }}</span>
                </td>
                <td class="myTh">
                    @php
                        echo strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin));
                    @endphp
                </td>
                <td class="myTh">
                    @if ($pj->type_formation_id == 1)
                        <span class="myData">{{ $pj->type_formation }}</span>
                    @elseif ($pj->type_formation_id == 2)
                        <span class="myData">{{ $pj->type_formation }}</span>
                    @endif
                </td>
                <td class="text-center">
                    @if($pj->item_status_groupe === 'Cloturé')
                        <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#111111"">Cloturé</span>
                    @elseif($pj->item_status_groupe === 'Reporté')
                        <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#af10e9"">Reporté</span>
                    @elseif($pj->item_status_groupe === 'Prévisionnel')
                        <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#2792e4"">Prévisionnel</span>
                    @elseif($pj->item_status_groupe === 'Annulée')
                        <span class="myData badge " style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#b33939"">Annulée</span>
                    @elseif($pj->item_status_groupe === 'Reprogrammer')    
                        <span class="myData badge" style="width: 97px; font-size: 12px; font-weight: 400; text-align: center;background:#00CDAC">Reprogrammer</span>
                    @endif 
                </td>
                <td class="myTh">
                    <p class="m-0 p-0 ms-0"><i class='bx bx-check-circle' style="color:
                        @php
                            echo $groupe->statut_presences($pj->groupe_id);
                        @endphp
                        "></i>&nbsp;Emargement</p>
                    <p class="myTh"><i class='bx bx-check-circle'
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
                <td class="text-center">
                    <a href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}" style="font-size: 13px">
                        <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection

@section('script')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="http://infra.clarin.eu/content/libs/DataTables-1.10.6/extensions/ColVis/js/dataTables.colVis.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.mahafaly2').DataTable({
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
                }
            });
        } );
    </script>
@endsection
