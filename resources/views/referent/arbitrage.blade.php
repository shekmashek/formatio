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
   .arb p{
       text-align: center;
       font-size: 20px;
       margin-top: 5px;
       color: white;
       padding: 5px;

   }
   td,th{
       font-size:15px;
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
    
    <div class="container-fluid shadow-sm mt-3 p-5">
        <div class="row">
            <div class="col-md-12">
                <div class="float-start">
                    @foreach($anne as $an)
                        <h2> Arbitrage Plan {{$an->AnneePlan}}</h2>
                    
                </div>
                <div class="float-end">
                    <a href="{{route('plan.cloture',$an->id)}}" class="btn text-light" style="background:#9359ff" ><i class='bx bx-calendar-check'></i>&nbsp;Cloturé</a>
                    <a class="btn btn-dark text-light" href="/ListedemandeFormation/{{$an->id}}"><i class="fa-solid fa-caret-left"></i>&nbsp;Retour</a>
                  
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-3">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                  <button style="width: 50%" class="nav-link active arbdep" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Arbitrage par departement</button>
                  <button style="width: 50%" class="nav-link arbm" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Arbitrage par module</button>
                  
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
                                        <th>Plan prév </th>
                                        <th>Budget(Ar)</th>
                                        <th>Ecart</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                    
                                    @foreach ($departement as $ar)
                                        <tr>
                                            <td style="text-align:center">    
                                                    {{$ar->nom_departement}}</td>
                                            <td style="text-align:center"> 
                                                @foreach($somme as $s)
                                                @if($ar->departement_entreprises_id== $s->departement_id)
                                                    <input type="hidden"  name="prev{{$ar->departement_entreprises_id}}" value="{{$s->v}}" placeholder="0" id="prev{{$ar->departement_entreprises_id}}" class="form-control text-end" disabled>
                                                   <input type="text" style="height:30px" value="{{number_format($s->v, 0, ',', '.')}} Ar" class="form-control text-end" disabled>
                                                @endif
                                                @endforeach
                                                
                                            </td>
                                            <td>
                                                     
                                                    @if($ar->budget != null)
                                                        <a href="" id="{{$ar->departement_entreprises_id}}" data="{{$an->id}}" class="modifier"><i style="margin-left: 10px;margin-top:7px;position: absolute;color:#d0af41" class="bx bx-edit-alt"></i></a>
                                                        <input type="text" style="height:30px;" value="{{number_format($ar->budget, 0, ',', '.')}}" name="bud{{$ar->departement_entreprises_id}}" id="{{$ar->departement_entreprises_id}}" class="form-control text-end tes" required>  
                                                    @else
                                                    <a href="" id="{{$ar->departement_entreprises_id}}" data="{{$an->id}}" class="ajout"><i style="margin-left: 10px;margin-top:7px;position: absolute;color:#41D053" class="fa-solid fa-circle-check"></i></a>
                                                    <input type="number" style="height:30px;" value="" placeholder="veillez entré votre budget" name="bud{{$ar->departement_entreprises_id}}" id="{{$ar->departement_entreprises_id}}" class="form-control text-end tes" >  
                                                    @endif
                                                    
                                                
                                               
                                            </td>
                                            <td>
                                                @foreach($ecart as $ec)
                                                @if( $ar->departement_entreprises_id == $ec->departement_entreprises_id)
                                                <input type="text" style="height:30px"  value="{{number_format($ec->budget-$ec->somme, 0, ',', '.')}} Ar" class="form-control text-end" disabled>
                                                @endif
                                                @endforeach
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
                                        <th style="text-align: center">Pax</th>
                                        <th>Plan prévisionnelle</th>
                                        <th>Budget (Ar)</th>
                                        <th>Ecart </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mod as $mo)
                                    <tr>
                                        <td>
                                            {{$mo->nom_formation}} 
                                        </td>
                                        <td class="text-center">
                                            @foreach($module as $mod)
                                            @if($mod->thematique_id == $mo->thematique_id)
                                               {{ $mod->c}}
                                                <?php $t=$mod->c ?>
                                            @endif
                                            @endforeach
                                            {{-- @if(isset($x))
                                                {{$x}}
                                            @else
                                                O
                                            @endif --}}
                                        </td>
                                        <td >
                                            @foreach($module as $mod)
                                            @if($mod->thematique_id == $mo->thematique_id)
                                                <input type="text" style="height:30px"  value="{{number_format($mod->v, 0, ',', '.')}} Ar" name="prev{{$mo->thematique_id}}"  class="form-control text-end" disabled>
                                               
                                                
                                            @endif
                                            @endforeach
                                          
                                        </td>
                                        
                                        <td>

                                            @if($mo->budget == null)
                                                <a id="{{$mo->thematique_id}}" data="{{$an->id}}"  class="thematique"><i style="margin-left: 10px;margin-top:7px;position: absolute;color:#41D053" class="fa-solid fa-circle-check"></i></a>
                                                <input style="height:30px" placeholder="veillez entre votre budget" data="{{$an->id}}"  type="number" id="{{$mo->thematique_id}}" name="bud{{$mo->thematique_id}}" class="form-control mod text-end" >
                                            @else
                                            <a id="{{$mo->thematique_id}}" data="{{$an->id}}"  class="modthematique"><i style="margin-left: 10px;margin-top:7px;position: absolute;color:#d0af41" class="bx bx-edit-alt"></i></a>
                                            <input style="height:30px"   type="text" id="{{$mo->thematique_id}}" name="bud{{$mo->thematique_id}}" class="form-control mod text-end" value="{{number_format($mo->budget, 0, ',', '.')}}">
                                            @endif
                                            
                                        </td>
                                        <td>
                                            
                                            @foreach($ecartMod as $ecarM)
                                            @if($mo->thematique_id == $ecarM->thematique_id)
                                            <input type="text" style="height:30px"  value="{{number_format( $ecarM->budget-$ecarM->somme, 0, ',', '.')}} Ar" class="form-control text-end" disabled>
                                            @endif
                                            @endforeach
                                        </td> 
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
              </div>      
        </div>
        <div class="col-md-12 mt-3">
            <h3 style="font-size: 16px;">Les demandes :</h3>
            <table class="table table-bordered table-responsive" style="wifth:600px" id="example" 
                
                
                {{-- data-toolbar=".toolbar" --}}
                {{-- data-show-columns="true" --}}
                {{-- data-search="true" --}}
                {{-- data-show-toggle="true" --}}
                {{-- data-pagination="true" --}}
                data-reorderable-columns="true"
                >
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
                            <th>Urgence</th>
                            <th>N+1</th>
                            <th>Cout(Ar)</th>
                            <th >Action</th>
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
                                    <input type="hidden" name="departement_id_{{$be->id}}" value="{{$st->departement_entreprises_id}}">
                                    <input type="hidden" name="service_id_{{$be->id}}" value="{{$st->service_id}}">
                                    <input type="hidden" name="{{$fonc}}" name="departement_{{$be->id}}">
                                    <input type="hidden" name="besoin_{{$be->id}}" value="{{$be->id}}">
                                    <input type="hidden" name="stagiaire_{{$be->id}}" value="{{$st->stagiaire_id}}">
                                    <input type="hidden" name="anne_{{$be->id}}" value="{{$be->anneePlan_id}}">
                                    <input type="hidden" name="thematique_id_{{$be->id}}" value="{{$be->thematique_id}}">
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
                                     &nbsp; {{$be->type}} <br>
                                    @endif    
                                @endforeach
                            </td>
                            <td class="text-center">    
                                @foreach($besoin as $be)   
                                    @if ($be->stagiaire_id == $st->stagiaire_id)            
                                        <?php $stat = $be->statut?>
                                        @if($stat == '0')
                                        <span style="padding: 1px" class=" mt-2 text-sm rounded text-white"><i class='bx bx-loader-circle bx-spin' style="color: rgba(255, 170, 0, 0.922);font-size:20px"></i></span> <br>
                                        @elseif($stat== '1')
                                            <span  class=" mt-3 rounded text-white" style=";padding: 1px"><i class='bx bx-user-check' style="color: rgba(54, 230, 15, 0.922);font-size:20px" ></i></span> <br>
                                        @else
                                            <span class=" rounded text-white mt-3" style="background:#f54c49">Non-validé</span> <br>
                                        @endif
                                    @endif    
                                @endforeach
                                
                            </td>
                            <td>
                                @foreach($besoin as $be)   
                                    @if ($be->stagiaire_id == $st->stagiaire_id)  
                                        @if($be->cout == '0')
                                        <input style="height: 30px;width:150px;font-size:12px" type="number"  value="300.000" name="cout_{{$be->id}}" class="form-control text-end">   
                                        @else
                                        @if($be->arbitrage == '1')
                                        <a  class="coudre" id="{{$be->id}}"><i style="margin-left: 10px;margin-top:7px;position: absolute;color:#d0af41" class="bx bx-edit-alt"></i></a>
                                        <input style="height: 30px;width:150px;font-size:12px;background:rgba(134, 218, 136, 0.2)" type="number"  value="{{number_format($be->cout, 0, ',', '.')}}" name="cout_{{$be->id}}"  class="form-control text-end "> 
                                        @else
                                        <a  class="coudre" id="{{$be->id}}"><i style="margin-left: 10px;margin-top:7px;position: absolute;color:#d0af41" class="bx bx-edit-alt"></i></a>
                                        <input style="height: 30px;width:150px;font-size:12px" type="number"  value="{{number_format($be->cout, 0, ',', '.')}}" name="cout_{{$be->id}}"  class="form-control text-end "> 
                                        @endif
                                        @endif

                                    @endif 
                                @endforeach
                            </td>
                            <td class="text-center">
                                @foreach($besoin as $be)   
                                @if ($be->stagiaire_id == $st->stagiaire_id) 
                                    <?php $arbitre = $be->arbitrage ?>  
                                    @if($arbitre == '1')
                                    <a  data-id="{{$be->id}}" class="refu " ><span class=" rounded text-white mt-3" style=""><i class='bx bx-x-circle mt-2' style="color: #c31212;font-size:22px"></i></span></a> <br>
                                    @else
                                    <a  data-id="{{$be->id}}" class=" valide" data={{$an->id}} style="" ><span  class=" mt-3 rounded text-white" style="padding: 1px"><i class="fa-solid fa-circle-check mt-2" style="color: #41D053;font-size:20px"></i></span></a><br>
                                    @endif         
                                   
                                @endif    
                                @endforeach
                            </td>
                        </form>
                            @endforeach
                        </tr>
                       
                    </tbody>
                </table>
                @endforeach
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
         $('.arbm').on('click',function(){
                var id = $(this).attr('data-bs-target')
                localStorage.setItem('module', id)
            })
            let mod = localStorage.getItem('module');
            if(mod){
                $(mod).addClass("show active")
                $("#nav-home").removeClass("show active")
                $("#nav-profile-tab").addClass("active")
                $("#nav-home-tab").removeClass("active")
            }
        $('.arbdep').on('click',function(){
            localStorage.removeItem('module')
            $("#nav-home-tab").addClass("active")
        })
        $(document).ready(function () {  
            
            $('.tes').keyup(function (e) { 
            var a = $(this).attr('id');
            var b = "prev"+a;
            var c = "ecart"+a;
            var budget = $(this).val()
            var prev   = $("input[name="+b+"]").val()
            var ec  = budget - prev;
            $("#"+c+"").val(ec)
            
            
            });
            
            $('.mod').keyup(function (e) { 
            var a = $(this).attr('id');    
            var b = "prev"+a;
            var c = "ecart"+a;
            var budget = $(this).val()
            var prev  = $("input[name="+b+"]").val()
            var ec  = budget - prev;
            $("input[name="+c+"]").val(ec)
            });
            
           

            


            var table = $('#example').DataTable({
                colReorder: true,
                select: true,
                responsive:true,
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
            $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(".valide").on('click',function(e){
                e.preventDefault();
                var id = $(this).data("id")
                var departement = $("input[name=departement_"+id+"]").val()
                var stagiaire   = $("input[name=stagiaire_"+id+"]").val()
                var anne = $("input[name=anne_"+id+"]").val()
                var formation = $("input[name=formation_"+id+"]").val()
                var service = $("input[name=service_"+id+"]").val()
                var cout = $("input[name=cout_"+id+"]").val()
                var besoin = $("input[name=besoin_"+id+"]").val()
                var departement_id = $("input[name=departement_id_"+id+"]").val()
                var service_id = $("input[name=service_id_"+id+"]").val()
                var thematique_id = $("input[name=thematique_id_"+id+"]").val()
                var anne_id = $(this).attr("data")
                
                $.ajax({
                    method: "POST",
                    url: "/arbitrageP",
                    data: {
                        departement:departement,
                        stagiaire:stagiaire,
                        anne:anne,
                        formation:formation,
                        service:service,
                        cout:cout,
                        besoin:besoin,
                        departement_id:departement_id,
                        service_id:service_id,
                        thematique_id:thematique_id,
                        id:id,
                        anne_id:anne_id,
                    },
                    
                    success:function(response){
                        console.log('mety')
                        location.reload()
                    },
                    
                });
                
            })

            $(".refu").on('click',function(e){
                e.preventDefault();
                var id = $(this).data("id")
                console.log(id)
                $.ajax({
                    method:"POST",
                    url:"/delarbitrage",
                    data:{
                        id:id
                    },
                    dataType : 'json',
                    success:function(response){
                        location.reload()
                        console.log(response)
                        
                    },
                    error: function(response){
                        console.log(response)
                    }
                })
            })

            $(".ajout").on('click', function () {
                var id = $(this).attr("id")
                var anne_id = $(this).attr("data")
                var budget = $("input[name=bud"+id+"]").val()
                // alert(id);
                $.ajax({
                    method:"POST",
                    url:"/budgetPlan",
                    data:{
                        id:id,
                        budget:budget,
                        anne_id:anne_id,
                    },
                    dataType : 'json',
                    success:function(response){
                        // location.reload()
                        console.log(response)
                        
                    },
                    error: function(response){
                        console.log(response)
                    }
                })
            });
            $(".modifier").on('click', function () {
                var id = $(this).attr("id")
                var budget = $("input[name=bud"+id+"]").val()
                var anne_id = $(this).attr("data")

                alert(anne_id);
                $.ajax({
                    method:"POST",
                    url:"/budgetPlanMod",
                    data:{
                        id:id,
                        budget:budget,
                        anne_id:anne_id,
                    },
                    dataType : 'json',
                    success:function(response){
                        // location.reload()
                        // console.log(response)
                        // alert('mety')
                        
                    },
                    error: function(response){
                        // console.log(response)
                        // alert('tsi')
                    }
                })
            });
            $(".thematique").on('click', function () {
                var id = $(this).attr("id")
                var budget = $("input[name=bud"+id+"]").val()
                var anne_id = $(this).attr("data")
                // alert(anne_id)
                $.ajax({
                    method:"POST",
                    url:"/budgetthematique",
                    data:{
                        id:id,
                        budget:budget,
                        anne_id:anne_id,
                    },
                    dataType : 'json',
                    success:function(response){
                        location.reload()
                        // console.log(response)
                        // alert('mety')
                        
                    },
                    error: function(response){
                        // console.log(response)
                        // alert('tsi')
                    }
                })
            });
            $(".modthematique").on('click', function () {
                
                var id = $(this).attr("id")
                var budget = $("input[name=bud"+id+"]").val()
                alert(budget)
                var anne_id = $(this).attr("data")
                
                $.ajax({
                    method:"POST",
                    url:"/Modthematique",
                    data:{
                        id:id,
                        budget:budget,
                        anne_id:anne_id,
                    },
                    dataType : 'json',
                    success:function(response){
                        location.reload()
                        // console.log(response)
                        // alert('mety')
                        
                    },
                    error: function(response){
                        // console.log(response)
                        // alert('tsi')
                    }
                })
            });

            $(".coudre").on('click', function () {
               var a = $(this).attr("id");
               var cou = $("input[name=cout_"+a+"]").val()
               
               $.ajax({
                   type: "POST",
                   url: "/modcout",
                   data: {
                       a:a,
                       cou:cou,
                   },
                   dataType: 'json',
                   success: function (response) {
                       console.log('mety')
                       location.reload()
                   }
               });
            });
           
            
    });

    </script>
@endsection