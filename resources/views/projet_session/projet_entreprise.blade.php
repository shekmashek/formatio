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
    
    table .dropdown-menu  {
        position:fixed !important; 
        z-index: 1;
        background: white;
        opacity: inherit;
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
</style>

@if (count($data) <= 0)
            <div class="d-flex mt-3 titre_projet p-1 mb-1">
                <span class="text-center">Vous n'avez pas encore du projet.</span>
            </div>
        @else
            <table class="table modifTable">
                <thead style=" top: 0;">
                    <tr style="background: #c7c9c939">
                        <th class="headProject"><i class='bx bx-library'></i> Projet</th>
                        <th class="headProject"><i class='bx bxs-book-open' style="color: #2e3950"></i> Session</th>
                        <th class="headProject"><i class='bx bxs-customize' style="color: #2e3950"></i> Module</th>
                        <th class="headProject"><i class='bx bx-building-house'></i> Centre de formation</th>
                        <th class="headProject"><i class='bx bx-calendar-check' ></i> Modalité</th>
                        <th class="headProject"><i class='bx bx-time-five' ></i> Date</th>
                        <th class="headProject"><i class='bx bx-home' ></i> Ville</th>
                        <th class="headProject"><i class='bx bx-calendar-x' style="color: #2e3950"></i> Statut</th>
                        <th class="headProject"><i class='bx bx-book-content' style="vertical-align: middle"></i> Type</th>
                        <th class="headProject"><i class='bx bx-task align-middle' ></i> Eval à chaud</th>
                        <th class="headProject"><i class='bx bx-task-x align-middle' ></i> Eval à froid</th>
                        <th class="headProject"><i class='bx bxs-file-pdf align-middle' style="vertical-align: middle"></i> PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $pj)
                        <tr>
                            <td>
                                <span  style='font-size: 13px;'>{{ $pj->nom_projet }}</span>
                            </td>
                            <td>
                                @if ($pj->type_formation_id == 3)
                                <a style="font-size: 13px" href="{{ route('detail_session_interne', [$pj->groupe_id]) }}"><span class="spanClass">{{ $pj->nom_groupe }} &nbsp;&nbsp;<i class='bx bx-show' style="font-size: 20px; vertical-align: middle;"></i></span></a>
                                @else
                                    <a href="{{ route('detail_session', [$pj->groupe_id, $pj->type_formation_id]) }}">
                                        <span style="font-size: 13px"  class="spanClass">{{ $pj->nom_groupe }} &nbsp;&nbsp;<i class='bx bx-show' style="font-size: 20px; vertical-align: middle;"></i></span>
                                    </a>
                                @endif
                            </td>
                            <td>
                                <span style="font-size: 13px">{{ $pj->nom_module }}</span>
                            </td>
                            <td>
                                <span style="font-size: 13px">{{ $pj->nom_cfp }}</span>
                            </td>
                            <td>
                                <span style="font-size: 13px">{{ $pj->modalite }}</span>
                            </td>
                            <td class="text-center">
                                @php
                                    echo "<span style='font-size: 13px;'>".strftime('%d-%m-%y', strtotime($pj->date_debut)).' au '.strftime('%d-%m-%y', strtotime($pj->date_fin))."</span>";
                                @endphp
                            </td>
                            <td>
                                @if($lieuFormation!=null)
                                    <span style="font-size: 13px;">{{$lieuFormation[0]}}</span>
                                @else
                                    {{"-"}}
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
                            <td class="text-center">
                                @if ($pj->type_formation_id == 1)
                                    <span style="text-align: center; font-weight: 400; font-size: 13px">
                                        {{ $pj->type_formation }}
                                    </span>
                                @elseif ($pj->type_formation_id == 2)
                                    <span style="text-align: center; font-weight: 400; font-size: 13px">
                                        {{ $pj->type_formation }}
                                    </span>
                                @elseif ($pj->type_formation_id == 3)
                                    <span style="text-align: center; font-weight: 400; font-size: 13px">
                                        {{ $pj->type_formation }}
                                    </span>
                                @endif
                            </td>

                            @if ($pj->type_formation_id == 3)
                                <td class="text-center">
                                    <a href="{{ route('resultat_evaluation_interne', [$pj->groupe_id]) }}" style="font-size: 13px">
                                        <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                    </a>
                                </td>
                            @else
                                <td class="text-center">
                                    <a href="{{ route('resultat_evaluation', [$pj->groupe_id]) }}" style="font-size: 13px">
                                        <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                    </a>
                                </td>
                            @endif

                            @if ($pj->type_formation_id == 3)
                            <td>fgjkq</td>
                            @else
                                @php
                                    $reponse = $froidEval->periode_froid_evaluation($pj->groupe_id);
                                @endphp
                                @if($reponse == 1)
                                    <td class="text-center">
                                        <a href="{{ route('evaluation_froid/resultat', [$pj->groupe_id]) }}" style="font-size: 13px">
                                            <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                        </a>
                                    </td>
                                @else
                                    <td class="text-center">
                                        {{ '-' }}
                                    </td>
                                @endif
                            @endif

                            @if ($pj->type_formation_id == 3)
                                <td class="text-center">
                                    <a href="{{ route('fiche_technique_interne_pdf', [$pj->groupe_id]) }}" style="font-size: 13px">
                                        <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                    </a>
                                </td>
                            @else
                                <td class="text-center">
                                    <a href="{{ route('fiche_technique_pdf', [$pj->groupe_id]) }}" style="font-size: 13px">
                                        <i class='bx bxs-circle' style="font-size: 13px; cursor: pointer; color: #1c7f2e"></i>
                                    </a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif


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

                new $.fn.dataTable.FixedColumns( table, {
                    leftColumns: 3,
                } );
                $('.ColVis_Button').text('Afficher / Masquer');

                $('input:checkbox').on('change', function () {
                    var Session = $('input:checkbox[name="Session"]:checked').map(function() {
                        return this.value;
                    }).get().join('|');
                    
                    table.column(0 ).search(Session, true,false,false).draw();

                    var Session = $('input:checkbox[name="Session"]:checked').map(function() {
                        return this.value;
                    }).get().join('|');
                    
                    table.column(1).search(Session, true,false,false).draw();
                    
                    var Module = $('input:checkbox[name="Module"]:checked').map(function() {
                        return this.value;
                    }).get().join('|');
                    
                    table.column(2).search(Module, true,false,false).draw();

                    var Entreprise = $('input:checkbox[name="EntrepriseE"]:checked').map(function() {
                        return this.value;
                    }).get().join('|');
                    
                    table.column(3).search(Entreprise, true,false,false).draw();

                    var Modalite = $('input:checkbox[name="Modalite"]:checked').map(function() {
                        return this.value;
                    }).get().join('|');
                    
                    table.column(4).search(Modalite, true,false,false).draw();
                    
                    var Statut = $('input:checkbox[name="Statut"]:checked').map(function() {
                        return this.value;
                    }).get().join('|');
                    
                    table.column(8).search(Statut, true,false,false).draw();

                    var Type = $('input:checkbox[name="TypeF"]:checked').map(function() {
                        return this.value;
                    }).get().join('|');
                    
                    table.column(7).search(Type, true,false,false).draw();
                });

                $('.column_search').on('keyup' ,function () {
                    console.log($(this).val());
                    table.column( $(this).parent().parent().parent().parent().index() ).search( this.value ).draw();
                } );

                // select all
                $('.select_all').on('click', function(){
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
                        $('.select_all').prop('checked', true);
                    } else{
                        $('.select_all').prop('checked', false);
                    }
                });
                // end select all

                $('.modifTable').DataTable();
            } );
        </script>
@endsection