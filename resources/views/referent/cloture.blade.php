@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Arbitrage Plan </p>
@endsection

@section('content')
<link href="https://cdn.jsdelivr.net/gh/akottr/dragtable@master/dragtable.css" rel="stylesheet">
<link href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>
<style>
    h2,h3,label,p,td,input,button{
        font-weight: 400;
        color: rgb(76, 71, 71);
    }
    td{
        font-size: 13px;
    }
    .nav-tabs .nav-link{
       color: black;
   }
   .nav-tabs .nav-link.active {
       outline: none;
       border: none;
       color: rgb(14, 5, 5);
       border-bottom: #7367f0 3px solid; 
      
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
    <div class="container-fluid p-5 mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="float-start">
                    @foreach($anne as $an)
                        <h2> Plan définitive {{$an->AnneePlan}}</h2>
                    
                </div>
                <div class="float-end"> 
                    @if($an->cloture == 1) 
                    <a class="btn btn text-light" style="background: #9359ff" href="/ArbitragePlan/{{$an->id}}">Acceder a l'arbitrage</a>
                    <a class="btn btn-dark text-light" href="/liste_demande_stagiaire"><i class="fa-solid fa-caret-left"></i>&nbsp;Retour</a>
                    @else
                    <a class="btn btn-dark text-light" href="/ArbitragePlan/{{$an->id}}"><i class="fa-solid fa-caret-left"></i>&nbsp;Retour</a>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="row">
                {{-- <div class="col-md-4" style="height: 200px">
                    <canvas id="myChart" style="width: 200px"></canvas>
                    
                </div> --}}
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                      <button style="width: 33.333%;" class="nav-link active arbdep" id="nav-home-tab"  data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Les demande rétenue </button>
                      <button style="width: 33.333%" class="nav-link arbm" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Plan par departement</button>
                      <button style="width: 33.333%" class="nav-link arbm" id="nav-module-tab" data-bs-toggle="tab" data-bs-target="#nav-module" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Plan par module</button>
                      
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active mt-5" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row">
                            <div class="col-md-11">

                            </div>
                            <div class="col-md-1">
                                <a href="{{route('plan.besoinPDFV',$an->id)}}" style="float: right;width:165px;" class="btn btn-primary mb-2 text-light"><i class='bx bxs-file-pdf'></i> Export PDF</a>
                            </div>
                            
                        </div>
                        
                        <table class="table table-bordered mt-5" id="example" > 
                            <thead>
                                <tr style="margin-top:30px" >
                                    <th>IM</th>
                                    <th>Nom </th>
                                    <th>Fonction</th>
                                    <th>Département</th>
                                    <th>Service</th>
                                    <th>thematique</th>
                                    <th>date prévisionnelle</th>
                                    <th>Organisme</th>
                                     <th>Cout</th>    
                                </tr>
                            </thead>
                        
                            <tbody>
                                @foreach ($stagiaire as $st)
                                <form action="" method="POST">
                                <tr>
                                    <td>
                                        @foreach ($besoin as $be)
                                            @if ($be->stagiaire_id == $st->stagiaire_id)            
                                                <?php $mat = $be->stagiaire->matricule;
                                                break;?>
                                                
                                            @else
                                            <?php $mat = '';
                                                
                                            ?>
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
                                            <?php $nom = '';
                                                
                                            ?>
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
                                        @if($fonc == null)
                                            <?php echo ('non categorisé')?>
                                        @else
                                            {{$fonc}}
                                        @endif
                                        @endif
                                    </td>
                                    <td>
                                        @foreach ($besoin as $be)
                                        @if ($be->stagiaire_id == $st->stagiaire_id)            
                                            <?php $fonc = $st->nom_service ?> 
                                            <input type="hidden" value="{{$fonc}}" name="service_{{$be->id}}">
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
                                            <input type="hidden" name="formation_{{$be->id}}" value="{{$be->formation->nom_formation}}">
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
                                        &nbsp; {{number_format($be->cout, 0, ',', '.')}} Ar <br>
                                        @endif    
                                        @endforeach
                                    </td>
                                    
                                </form>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row mt-4">
                            <div class="col-md-11">

                            </div>
                            <div class="col-md-1">
                                <a href="{{route('plan.besoin_departement_PDF',$an->id)}}" style="float: right;width:165px;" class="btn btn-primary mb-2 text-light"><i class='bx bxs-file-pdf'></i> Export PDF</a>
                            </div>
                            
                        </div>
                        <table class="table table-hover mt-5" id="departement">
                            <thead>
                                <tr >
                                    <th></th>
                                    <th class="text-center">Département</th>
                                    <th class="text-center">Budget</th>
                                    <th class="text-center">Besoins</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departement as $dep)
                                    <tr class="text-center">
                                        <td class="text-start">
                                            <a  style="font-size:15px" data-bs-toggle="collapse" href="#collapseExample_{{$dep->departement_entreprises_id}}" role="button" aria-expanded="false" aria-controls="collapseExample"><i class='bx bx-down-arrow-circle'></i></a>
                                        </td>
                                        <td>{{$dep->nom_departement}}</td>
                                        <td>{{number_format($dep->budget, 0, ',', '.')}} Ar</td>
                                        <td>
                                            @foreach($paxdep as $pax)
                                            @if($dep->departement_entreprises_id == $pax->departement_entreprises_id)
                                                {{$pax->pax}}
                                            @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <div class="collapse" id="collapseExample_{{$dep->departement_entreprises_id}}">
                                                <div class="card card-body">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <th>IM</th>
                                                            <th>Nom</th>
                                                            <th>Email</th>
                                                            <th>Module</th>                        
                                                            <th>Budget</th>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($besoindep as $bd)
                                                            @if($dep->departement_entreprises_id == $bd->departement_entreprises_id)
                                                                <tr class="text-start">
                                                                    <td>{{$bd->matricule}}</td>
                                                                    <td>{{$bd->nom_stagiaire}}</td>
                                                                    <td>{{$bd->mail_stagiaire}}</td>
                                                                    <td>{{$bd->nom_formation}}</td>
                                                                    
                                                                    <td>{{number_format($bd->cout, 0, ',', '.')}} Ar</td>
                                                                </tr>
                                                            @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="tab-pane fade" id="nav-module" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row mt-4">
                            <div class="col-md-11">

                            </div>
                            <div class="col-md-1">
                                <a href="{{route('plan.besoin_module_PDF',$an->id)}}" style="float: right;width:165px;" class="btn btn-primary mb-2 text-light"><i class='bx bxs-file-pdf'></i> Export PDF</a>
                            </div>
                            
                        </div>
                        <table class="table table-hover" id="module" style="width: 100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Module</th>
                                    <th class="text-center">Pax</th>
                                    <th>Budget</th>
                                    <th style="display: none"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($module as $modu)
                                <tr>
                                    <td class="text-start">
                                        <a  style="font-size:15px" data-bs-toggle="collapse" href="#collapseExample_{{$modu->thematique_id}}" role="button" aria-expanded="false" aria-controls="collapseExample"><i class='bx bx-down-arrow-circle'></i></a>
                                    </td>
                                    <td>{{$modu->nom_formation}}</td>
                                    <td class="text-center">
                                        @foreach($moduleC as $mod)
                                        @if($mod->thematique_id == $modu->thematique_id)
                                           {{ $mod->c}}
                                            <?php $t=$mod->c ?>
                                        @endif
                                        @endforeach
                                    </td>
                                    <td >
                                        @if($modu->budget == null)
                                            {{number_format(0, 0, ',', '.')}} Ar
                                        @else
                                            {{number_format($modu->budget, 0, ',', '.')}} Ar
                                        @endif

                                    </td>
                                    <td >
                                        <div class="collapse" id="collapseExample_{{$modu->thematique_id}}">
                                            <div class="card card-body">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <th>IM</th>
                                                        <th>Nom</th>
                                                        <th>Email</th>
                                                        <th>Departement</th>
                                                        <th>Service</th>
                                                        <th>Budget</th>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($besoinModule as $bm)
                                                        @if($bm->formation_id == $modu->thematique_id)
                                                            <tr>
                                                                <td>{{$bm->matricule}}</td>
                                                                <td>{{$bm->nom_stagiaire}}</td>
                                                                <td>{{$bm->mail_stagiaire}}</td>
                                                                <td>{{$bm->nom_departement}}</td>
                                                                <td>{{$bm->nom_service}}</td>
                                                                <td>{{number_format($bm->cout, 0, ',', '.')}} Ar</td>
                                                            </tr>
                                                        @endif
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
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
         var table = $('#example').DataTable({
                colReorder: true,
                select: true,
                responsive:true,
                language:{
                    url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
                },
            });
            var table = $('#departement').DataTable({
                colReorder: true,
                select: true,
                responsive:true,
                language:{
                    url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
                },
            });  
            // var table = $('#module').DataTable({
            //     colReorder: true,
            //     select: true,
            //     responsive:true,
            //     language:{
            //         url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
            //     },
            // });  
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
    <script>
        
        const ctx = document.getElementById('myChart').getContext('2d');
        
        const myChart = new Chart(ctx, {
            // Chart.defaults.elements.bar.borderWidth = 2;

            type: 'polarArea',
            data: {
                labels: [
                    'Red',
                    'Green',
                    'Yellow',
                    'Grey',
                    'Blue'
                ],
                datasets: [{
                    label: 'My First Dataset',
                    data: [11, 16, 7, 3, 14],
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(75, 192, 192)',
                    'rgb(255, 205, 86)',
                    'rgb(201, 203, 207)',
                    'rgb(54, 162, 235)'
                    ]
                }]
            },
            options: {
                
            }
        });
    </script> --}}
@endsection