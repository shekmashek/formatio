@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Demande</p>
@endsection
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
    integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<link href="https://cdn.jsdelivr.net/gh/akottr/dragtable@master/dragtable.css" rel="stylesheet">
<link href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>


<style>
    h2{
        font-weight: 400;
        font-size: 25px;
        color: gray;
    }
    table.dataTable td {
        font-size: 14px;
    }
    table.dataTable th{
        font-size: 16px
    }
    .dataTables_length label,
    .dataTables_filter label {
        opacity: 0.5;
        transition: opacity 0.15s ease-in;
    }
    .dataTables_length label:hover,
    .dataTables_filter label:hover {
        opacity: 1;
    }
    .page-item.active .page-link {
        /* margin-top: 10px; */
        /* border-radius: 5rem; */
        border: 1px solid #9359ff;
        background-color: #9359ff !important;
        padding: 0.3rem 0.7rem;
        /* color: #59ff90; */
        margin: 0 0.5rem;
        /* font-size: small; */
        color: white!important;
        transition: 0.3s;
    }
    .selection p{
        font-weight: normal;
        text-align: left;
        white-space: nowrap;
        font-family: 'Roboto', sans-serif;
        color: #212529;
    }
    .nav-tabs .nav-link.active {
       outline: none;
       border: none;
       color: rgb(14, 5, 5);
       border-bottom: #7367f0 3px solid; 
   }
    
</style>
    <div class="container-fluid mt-5 p-5">
        <div class="row">
            <div class="col-md-12">
                <div class="float-start">
                    <h2>Liste globale des demandes de formation </h2>
                </div>
                <div class="float-end">
                    <a class="btn btn-secondary text-light" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Ajouter une demande
                    </a>
                    <a href="{{route('besoin.PDF',$ids)}}" class="btn btn-primary text-light">
                        Export PDF
                    </a>
                    <a href="{{route('besoin.arbitrage',$ids)}}" class="btn btn text-light" style="background: #9359ff">
                        Passer à l'arbitrage
                    </a>
                    <a href="/liste_demande_stagiaire" class="btn btn-dark text-light"><i class="fa-solid fa-caret-left"></i>&nbsp; Retour</a>
                </div>
            </div>
            {{-- <div style="display: flex">
                Afficher : <a class="toggle-vis" data-column="0">Nom</a> - <a class="toggle-vis" data-column="1">Fonction</a> 
            </div> --}}
            <div class="col-md-12 mt-2">
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                  
                        <table class="table table-hover">
                            <tr>
                                <th>IM</th>
                                <th>Nom </th> 
                                <th>Fonction</th>
                                <th>Département</th>
                                <th>Service</th>
                                <th>domaine</th>
                                <th>thematique</th>
                                <th>date prévisionnelle</th>
                                <th>Organisme</th>
                                <th>Urgence</th> 
                                <th></th>
                            </tr>
                            <tbody>
                                <form action="{{route('besoin.ajoutRH')}}" method="POST">
                                @csrf
                                    <input type="hidden" name="anneePlan_id" value="{{$ids}}">
                                 <tr>
                                    <th style="width: 50px">
                                        <select name="" class="form-control" id="matricule" style="width: 40px;height:30px;font-size:12px" id="">
                                            @foreach($employer as $em)
                                            <option value="{{$em->matricule_emp}}" >{{$em->matricule_emp}}</option>
                                            
                                            @endforeach
                                        </select>
                                    </th>

                                    <th>
                                        <select name="stagiaire_id" class="form-control nom" id="nom" style="width: 100px;height:30px;font-size:12px" id="" required>
                                            {{-- @foreach($employer as $em)
                                            <option value="" >{{$em->nom_emp}}</option>
                                            @endforeach --}}
                                        </select>
                                    </th>
                                    <th>
                                        <select name="entreprise_id" class="form-control fonction" id="fonction" style="width: 100px;height:30px;font-size:12px" id="" required>
                                            {{-- @foreach($employer as $em)
                                            <option value="" >{{$em->fonction_emp}}</option>
                                            @endforeach --}}
                                        </select>
                                    </th>
                                    <th>
                                        <select name="" class="form-control departementC" id="departementC" style="width: 160px;height:30px;font-size:12px" id="" required> 
                                            {{-- @foreach($employer as $em)
                                            <option value="" >{{$em->}}</option>
                                            @endforeach --}}
                                        </select>
                                    </th>
                                    <th>
                                        <select name="" class="form-control service" id="service" style="width: 100px;height:30px;font-size:12px" id="" required>
                                            {{-- @foreach($employer as $em)
                                            <option value="" >{{$em->nom_emp}}</option>
                                            @endforeach --}}
                                        </select>
                                    </th>
                                    <th>
                                        <select name="domaine_id" class="form-control domaine" style="width: 150px;height:30px;font-size:12px" id="" required>
                                            <option value="" selected hidden>choisir domaine</option>
                                            @foreach($domaine as $dom)
                                            <option value="{{$dom->id}}" >{{$dom->nom_domaine}}</option>
                                            @endforeach
                                        </select>
                                    </th>
                                    <th>
                                        <select name="thematique_id" class="form-control thematique" id="thematique" style="width: 150px;height:30px;font-size:12px" id="" required>
                                            {{-- @foreach($employer as $em)
                                            <option value="" >{{$em->nom_emp}}</option>
                                            @endforeach --}}
                                        </select>
                                    </th>
                                    <th><input type="date" name="date" style="width: 100px;height:30px;font-size:12px" class="form-control" required></th>
                                    <th><input style="width: 100px;height:30px;font-size:12px" name="organisme" type="text" class="form-control" required></th>
                                    <th>
                                        <select name="type" class="form-control"  style="width: 150px;height:30px;font-size:12px" id="" required>
                                            <option value="urgent" >urgent</option>
                                            <option value="non-urgent" >non-urgent</option>    
                                        </select>
                                    </th>
                                    <th><button class="btn btn-info text-light" type="submit" style="width: 90px;height:30px;font-size:12px">Ajouter</button></th>
                                </tr>
                            </form>
                            </tbody>
                        </table>
                   
                </div>
                
            </div>
        </div>
                
            </div>
            <div class="col-md-12 mt-4">
                
                <div class="row selection"  style="width:400px">
                    <div  style="display: flex;margin-left:200px;float:right;position:absolute;z-index:1;width:500px">
                        {{-- <p style="margin-left:2px;margin-top:4px;color:gray;font-family:'Roboto',sans-serif;">Département:</p> --}}
                            <select class="form-control menu" id="departement" style="width:300px;height:30px;margin-left:0px;margin-top:0px;font-size:12px" name="" id="">
                                <option value="" selected hidden>Selection par departement</option>
                                
                                <option value="non categorisé">non categorisé</option>

                                @foreach($departement as $dep)
                                    <option value="{{$dep->nom_departement}}" >{{$dep->nom_departement}}</option>
                                @endforeach
                                
                            </select>
                            <button class="btn  p-1 reload" style="height: 30px;border:1px solid gray"><i style="" class="fa-solid fa-arrows-rotate"></i></button>
                    </div>
                    <div  style="display: flex;margin-left:750px;position: absolute;" id="service">
                        {{-- <p style="margin-left:2px;margin-top:4px;color:gray">Sérvice:</p>
                            <select class="form-control menu" id="service" style="width:300px;height:30px;margin-left:0px;margin-top:0px;font-size:12px" >
                                
                            </select> --}}
                    </div>
                       
                </div>
                <table class="table table-hover " style="wifth:600px" id="example" data-reorderable-columns="true">
                    <thead>
                        <tr style="background: rgb(240, 237, 237);text-align:center">
                            <th>IM</th>
                            <th>Nom </th> 
                            <th>Fonction</th>
                            <th>Département</th>
                            <th>Service</th>
                            <th>thematique</th>
                            <th>date prévisionnelle</th>
                            <th>Organisme</th>
                            <th>Urgence</th>
                            <th>N+1</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($stagiaire as $st)
                        <tr>
                            <td>
                                @foreach ($besoin as $be)
                                    @if ($be->stagiaire_id == $st->stagiaire_id)            
                                        <?php $mat = $be->stagiaire->matricule;
                                        break;?>
                                    @else
                                    <?php $mat = ''; ?>
                                    @endif
                               @endforeach
                                @if(isset($mat)) 
                                    {{ $mat }}
                                @endif
                            </td>
                            <td>
                                @foreach ($besoin as $be)
                                    @if ($be->stagiaire_id == $st->stagiaire_id)            
                                        <?php $nom = $be->stagiaire->nom_stagiaire;
                                        break;?>
                                    @else
                                    <?php $nom = ''; ?>
                                    @endif
                               @endforeach
                                @if(isset($nom)) 
                                    {{ $nom }}
                                @endif
                            </td>
                            
                            <td>
                                @foreach ($besoin as $be)
                                @if ($be->stagiaire_id == $st->stagiaire_id)            
                                    <?php $fonc = $st->fonction_stagiaire ?>
                                @endif 
                                @endforeach
                                @if(isset($fonc)) 
                                {{ $fonc}}
                                @endif
                            </td>
                            <td>
                                @foreach ($besoin as $be)
                                @if ($be->stagiaire_id == $st->stagiaire_id)            
                                    <?php $fonc = $st->nom_departement ?>                                    
                                    @endif 
                                @endforeach
                                @if(isset($fonc))
                                    {{ $fonc}}
                                @endif
                            </td>
                            <td>
                                @foreach ($besoin as $be)
                                @if ($be->stagiaire_id == $st->stagiaire_id)            
                                    <?php $fonc = $st->nom_service ?> 
                                    @endif 
                                @endforeach
                                @if(isset($fonc))
                                    @if($fonc == null)
                                        <?php echo ('non categorisé')?>
                                    @else
                                        {{$fonc}}
                                    @endif
                                @endif
                            </td>
                            <td>    
                                @foreach($besoin as $be)   
                                    @if ($be->stagiaire_id == $st->stagiaire_id)            
                                    &nbsp; {{$be->formation->nom_formation }} <br>
                                    @endif    
                                @endforeach
                            </td>
                            <td >    
                                @foreach($besoin as $be)   
                                    @if ($be->stagiaire_id == $st->stagiaire_id)            
                                    &nbsp; @php echo(date('m-Y',strtotime($be->date_previsionnelle))) @endphp <br>
                                    @endif    
                                @endforeach
                            </td>
                            <td>    
                                @foreach($besoin as $be)   
                                    @if ($be->stagiaire_id == $st->stagiaire_id)            
                                     &nbsp; {{$be->organisme}} <br>
                                    @endif    
                            @endforeach
                            </td>
                            <td>    
                                @foreach($besoin as $be)   
                                    @if ($be->stagiaire_id == $st->stagiaire_id)            
                                     &nbsp; {{$be->type}} <br>
                                    @endif    
                            @endforeach
                            </td>
                            <td>    
                                @foreach($besoin as $be)   
                                    @if ($be->stagiaire_id == $st->stagiaire_id)            
                                        <?php $stat = $be->statut?>
                                        @if($stat == '0')
                                        <span style="padding: 1px" class="bg-warning mt-2 text-sm rounded text-white">En attente</span> <br>
                                        @elseif($stat== '1')
                                            <span  class=" mt-3 rounded text-white" style="background:#41D053;padding: 1px">validé</span> <br>
                                        @else
                                            <span class=" rounded text-white mt-3" style="background:#f54c49">Non-validé</span> <br>
                                        @endif
                                    @endif    
                                @endforeach
                                
                            </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jqueryui@1.11.1/jquery-ui.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/akottr/dragtable@master/jquery.dragtable.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.20.2/dist/extensions/reorder-columns/bootstrap-table-reorder-columns.min.js"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
<script>

    $(document).ready(function () {
            var table = $('#example').DataTable({
                colReorder: true,
                select: true,
                responsive:true,
                search:true,
                language:{
                    url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
                },
            });
            table.on( 'column-reorder', function ( e, settings, details ) {
                var headerCell = $( table.column( details.to ).header() );
            
                headerCell.addClass( 'reordered' );
            
                setTimeout( function () {
                    headerCell.removeClass( 'reordered' );
                }, 2000 );
            } );

            $("#departement").on('change',function(e){
                
                var val = $(this).text()
                table.column( 3 )
                .search( val ? $(this).val() : val )
                .draw();
                
            });
            $(function() {
                $('#example').bootstrapTable()
            }) 
            $(".reload").on('click',function(){
                $('#example').bootstrapTable().clear().draw();
                // alert('test')
            }) 
            $('a.toggle-vis').on('click', function (e) {
            e.preventDefault();
    
            // Get the column API object
            var column = table.column($(this).attr('data-column'));
    
            // Toggle the visibility
            column.visible(!column.visible());
        });
        $("#matricule").change(function (e) { 
            e.preventDefault();
            var id = $(this).val()
            $.ajax({
                type: "get",
                url: "/getEmployer",
                data: {
                    id:id,
                },
                dataType: "json",
                success: function (response) {
                    var employer = response;
                    if (employer.length > 0) {
                        document.getElementById("nom").innerHTML = "";
                        document.getElementById("fonction").innerHTML = "";
                        document.getElementById("departementC").innerHTML = "";
                        document.getElementById("service").innerHTML = "";
                        for(var i = 0;i < employer.length ; i++){
                            $(".nom").append(
                                
                                '<option value="'+employer[i].id+'">'+employer[i].nom_emp+'</option>'
                            )
                            
                            $(".fonction").append(
                                '<option value="'+employer[i].entreprise_id+'">'+employer[i].fonction_emp+'</option>'
                            )

                            $(".departementC").append(
                                
                                '<option value="'+employer[i].departement_entreprise_id+'">'+employer[i].nom_departement+'</option>'
                            )
                            $(".service").append(
                                '<option value="'+employer[i].service_id+'">'+employer[i].nom_service+'</option>'
                            )
                        }
                    }else{

                    }
                }
            });
        });

        $(".domaine").change(function (e) { 
            
            e.preventDefault();
            var id = $(this).val();
            $.ajax({
                url: "/get_formation",
                type: "get",
                data: {
                    id: id,
                },
                success: function (response) {
                    var userData = response;
                    if(userData.length > 0){
                        document.getElementById("thematique").innerHTML = "";
                        for (var $i = 0; $i < userData.length; $i++) {
                            $('.thematique').append(
                                // '<input type="hidden" name="thematique_id" value="'+userData[$i].id+'">' +
                                '<option value="'+userData[$i].id+'" data-value="' +userData[$i].nom_formation +'" >' +userData[$i].nom_formation +"</option>"
                            )   
                        }
                    }
                }
            });
            
        });
  
    });
    
 
    

</script>
@endsection