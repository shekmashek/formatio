@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Arbitrage Plan </p>
@endsection
@section('content')
<link href="https://cdn.jsdelivr.net/gh/akottr/dragtable@master/dragtable.css" rel="stylesheet">
<link href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>
<style>
    h2,h3,label,p{
        font-weight: 400;
        color: gray;
    }
   .arb p{
       text-align: center;
       font-size: 20px;
       margin-top: 5px;
       color: white;
       padding: 5px;

   }
   .nav-tabs .nav-link{
       color: black;
   }
   .nav-tabs .nav-link.active {
       background: #9359ff;
       color: white;
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
</style>
    <div class="container-fluid shadow-sm mt-3 p-5">
        <div class="row">
            <div class="col-md-12">
                <div class="float-start">
                    <h2> Arbitrage Plan 2022</h2>
                </div>
                <div class="float-end">
                    <a href="{{url()->previous()}}" class="btn btn-dark text-white">Retour</a>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button style="width: 50%" class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Arbitrage par departement</button>
                  <button style="width: 50%" class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Arbitrage par module</button>
                  
                </div>
              </nav>
              <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-dark" style="text-align:center">
                                        <th>Département</th>
                                        <th>Plan prév</th>
                                        <th>Budget</th>
                                        <th>Ecart</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    @foreach ($departement as $dep)
                                        <tr>
                                            <td>{{$dep->nom_departement}}</td>
                                            <td>
                                                <input type="text" class="form-control" >
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" >
                                            </td>
                                            <td>
                                                <input type="text" class="form-control" disabled>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr class="text-dark" style="text-align:center">
                                        <th>Module</th>
                                        <th>Participant</th>
                                        <th>Plan prév</th>
                                        <th>Budget</th>
                                        <th>Ecart</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="text-align: center">
                                        <td>Exel</td>
                                        <td>0</td>
                                        <td>
                                            <input type="text" class="form-control" >
                                        </td>
                                        
                                        <td>
                                            <input type="text" class="form-control" >
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" >
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
              </div>      
        </div>
        <div class="col-md-12 mt-3">
            <h3 style="font-size: 16px;">Les demandes :</h3>
            <table class="table table-hover " style="wifth:600px" id="example" data-reorderable-columns="true">
                <thead>
                    <tr >
                        <th>IM</th>
                        <th>Nom </th>
                        <th>Fonction</th>
                        <th>Département</th>
                        <th>Service</th>
                        <th>thematique</th>
                        <th>date prévisionnelle</th>
                        <th>Organisme</th>
                        <th>Priorité</th>
                        <th>N+1</th>
                        <th>Cout</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>
                     @foreach ($stagiaire as $st)
                    <tr>
                        <td>
                            @foreach ($besoin as $be)
                                @if ($be->stagiaire_id == $st->stagiaire_id)         
                                    <?php $mat = $be->stagiaire->matricule; break;?>
                                @else
                                    <?php $mat = '';?>
                                @endif
                            @endforeach
                            @if(isset($mat)) 
                                {{ $mat }}
                            @endif
                        </td>
                        <td>
                            @foreach ($besoin as $be)
                                @if ($be->stagiaire_id == $st->stagiaire_id)            
                                    <?php $nom = $be->stagiaire->nom_stagiaire; break;?>
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
                            @if($fonc == null) 
                                <?php echo('non categorisé'); ?>
                            @else
                                {{ $fonc}}
                            @endif
                        </td>
                        <td>
                            @foreach ($besoin as $be)
                                @if ($be->stagiaire_id == $st->stagiaire_id)           
                                    <?php $fonc = $st->nom_service ?> 
                                @endif 
                            @endforeach
                            @if($fonc == null) 
                                <?php echo('non categorisé'); ?>
                            @else
                                {{ $fonc}}
                            @endif
                        </td>
                            <td>    
                                @foreach($besoin as $be)   
                                    @if ($be->stagiaire_id == $st->stagiaire_id)          
                                    {{$be->formation->nom_formation }} <br>
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
                            <td>
                                @foreach($besoin as $be)   
                                    @if ($be->stagiaire_id == $st->stagiaire_id)            
                                        <input style="height: 30px" name="cout" type="text" value="" class="form-control">
                                    @endif    
                                @endforeach
                            </td>
                            <td class="besoin_btn">
                                @foreach($besoin as $be)   
                                @if ($be->stagiaire_id == $st->stagiaire_id)            
                                    <a type="button"  class="btn  btn-info text-light btn-sm mt-1" style="border-radius: 100px;"><i  class="fa-solid fa-check"></i></a><br>
                                @endif    
                                @endforeach
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
                language:{
                    url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
                },
            });
            table.on('column-reorder', function ( e, settings, details) {
                var headerCell = $( table.column( details.to ).header() );
                headerCell.addClass( 'reordered' );
                setTimeout( function () {
                    headerCell.removeClass( 'reordered' );
                }, 2000 );
            });


    });
    </script>
@endsection