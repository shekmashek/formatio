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
        <table class="table mahafaly">
            <thead>
                <tr style="background: #c7c9c939">
                    <th>
                        <div class="dropdown">
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-library align-middle'></i> Projet
                            </button>
                            <ul class="dropdown-menu main p-2" >
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all1" type="checkbox" id="select_all">
                                    <label class="form-check-label label" for="select_all" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomProjet as $prj)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox form-check-input" type="checkbox" name="Projet1" value="{{ $prj->nom_projet}}"><span style="font-size: 12px">{{ $prj->nom_projet}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown">
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bx bxs-book-open align-middle" style="color: #2e3950"></i> Session
                            </button>
                            <ul class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all1" type="checkbox" id="select_all1">
                                    <label class="form-check-label label" for="select_all1" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomSessions as $sess)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox form-check-input" type="checkbox" name="Session1" value="{{ $sess->nom_groupe}}"><span style="font-size: 12px">{{ $sess->nom_groupe}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                    <th>
                        <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bx bxs-customize'></i> Module
                        </button>
                    </th>
                    <th>
                        <div class="dropdown z-index-2" id="ta">
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-building-house'></i> Centre de formation
                            </button>
                            
                            <ul  class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all1" type="checkbox" id="select_all3">
                                    <label class="form-check-label label" for="select_all3" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomEtps as $e)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox form-check-input" type="checkbox" name="Cfp1" value="{{ $e->nom_etp}}"><span style="font-size: 12px">{{ $e->nom_etp}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                    <th>
                        <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bx bx-calendar-check' ></i> Modalité
                        </button>
                    </th>
                    <th>
                        <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bx bx-time-five' ></i> Date
                        </button>
                    </th>
                    <th>
                        <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bx bx-home' ></i> Ville
                        </button>
                    </th>
                    <th>
                        <div class="dropdown" >
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-calendar-x align-middle' style="color: #2e3950"></i> Statuts
                            </button>
                            <ul class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all1" type="checkbox" id="select_all1">
                                    <label class="form-check-label label" for="select_all1" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomStatuts as $stt)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox form-check-input" type="checkbox" name="Statut1" value="{{ $stt->item_status_groupe}}"><span style="font-size: 12px">{{ $stt->item_status_groupe}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                    <th>
                        <div class="dropdown" >
                            <button style="font-size: 13px" class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-book-content align-middle' style="vertical-align: middle"></i> Type
                            </button>
                            <ul class="dropdown-menu main p-2">
                                <li>
                                    <input type="text" class="column_search form-control form-control-sm">
                                </li>
                                <li>
                                    <input class="form-check-input select_all1" type="checkbox" id="select_all6">
                                    <label class="form-check-label label" for="select_all6" style="font-size: 12px">Selectionez tout</label>
                                </li>
                                <ul>
                                    @foreach ($nomTypes as $ntp)
                                        <div class="form-check">
                                            <li>
                                                <input class="checkbox form-check-input" type="checkbox" name="Type1" value="{{ $ntp->type_formation}}"><span style="font-size: 12px">{{ $ntp->type_formation}}</span>
                                            </li>
                                        </div>
                                    @endforeach
                                </ul>
                            </ul>
                        </div>
                    </th>
                    <th>
                        <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bx bx-task align-middle' ></i> Eval à chaud
                        </button>
                    </th>
                    <th>
                        <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bx bx-task-x align-middle' ></i> Eval à froid
                        </button>
                    </th>
                    <th>
                        <button style="font-size: 13px" class="btn btn-default" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class='bx bxs-file-pdf align-middle' style="vertical-align: middle"></i> PDF
                        </button>
                    </th>
                </tr>
                <tr class="myTh">
                    <th></i> Projet</th>
                    <th></i> Session</th>
                    <th></i> Module</th>
                    <th></i> Centre de formation</th>
                    <th></i> Modalité</th>
                    <th></i> Date</th>
                    <th> Ville</th>
                    <th></i> Statut</th>
                    <th></i> Type</th>
                    <th> Eval à chaud</th>
                    <th> Eval à froid</th>
                    <th> PDF</th>
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
                            <a style="font-size: 13px" href="{{ route('detail_session_interne', [$pj->groupe_id]) }}"><span class="spanClass"style="font-size: 13px;">{{ $pj->nom_groupe }} &nbsp;&nbsp;<i class='bx bx-show' style="font-size: 20px; vertical-align: middle;"></i></span></a>
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
                            <td class="text-center">
                                <span> {{ '-' }} </span>
                            </td>
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
                
                table1.column(0).find(Projet1).draw();

                var Session1 = $('input:checkbox[name="Session1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(1).find(Session1).draw();

                var Module1 = $('input:checkbox[name="Module1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(2).find(Module1).draw();

                var Cfp1 = $('input:checkbox[name="Cfp1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(3).find(Cfp1).draw();

                var Statut1 = $('input:checkbox[name="Statut1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(7).find(Statut1).draw();

                var Type1 = $('input:checkbox[name="Type1"]:checked').map(function() {
                    return this.value;
                }).get().join('|');
                
                table1.column(8).find(Type1).draw();
                
                
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

            $('.column_search').on('keyup' ,function () {
                table1.column( $(this).parent().parent().parent().parent().index() ).search( this.value ).draw();
            } );
        } );
    </script>
@endsection
