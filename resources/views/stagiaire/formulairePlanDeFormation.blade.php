@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Demande</p>
@endsection
@section('content')
{{-- <link rel="stylesheet" href="dragtable.css">
<script src="jquery-ui.js"></script>
<script src="jquery.dragtable.js"></script>
<script src="extensions/reorder-columns/bootstrap-table-reorder-columns.js"></script> --}}
<style>
    h1{
        font-weight: 400;
        color: gray;
    }
    .form-control{
        text-align: center;
        border: none;
    }
    input[type="text"]{
        border:1px solid #0dcaf0;
        color: black;
    }
    select{
        border:1px solid #0dcaf0;
        color: black;
    }
    .saf{
        background: rgb(36, 213, 12);
    }

    tr .actio{
        visibility: hidden;
        display:none;
    }

    tr:hover .actio{
        visibility: visible;
        display: block;
        height: 2%;
    }
</style>
<div id="page-wrapper">
    <div class="container  mt-5 p-4">
        <div class="row">
            <h1>Recueil besoin en formation</h1>
        </div>
        <div class="row my-2">
            <div class="tab-content my-2" id="pills-tabContent">
                <div class="tab-pane fade show active" id="liste_dmd_formation" role="tabpanel" aria-labelledby="pills-home-tab">
                    @foreach ($plan as $p)
                        <div class="row p-1 my-2 rounded justify-content-between text-secondary" style="background: rgb(245,242,242);">
                            <div class="col-11 pt-1">Années :{{$p->AnneePlan}}</span>  &nbsp;  Debut du recueil : {{ \Carbon\Carbon::parse($p->debut_rec)->format('d/m/Y')}} &nbsp; fin du recueil : {{ \Carbon\Carbon::parse($p->fin_rec)->format('d/m/Y')}} 
                                @if(strtotime($p->fin_rec) > strtotime('now') )
                                    <a href="{{route('plan.demande',$p->id)}} " class="btn btn-info text-light" style="float: right">Demander un formation</a>
                                @else
                                    <a class="btn btn-danger text-light" style="float: right">Términer</a>
                                @endif
                            </div>
                            <div class="col-1 text-end">
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample_{{$p->AnneePlan}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    <i style="color:white" class="fa-solid fa-arrow-down-long"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="collapse p-3" id="collapseExample_{{$p->AnneePlan}}">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        {{-- <h6 class="text-secondary lead">Tous les demandes de votre équipe</h6> --}}
                                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Tous les demandes</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Demande de proposition</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content w-100" id="pills-tabContent">
                                    <div class="tab-pane fade show active col-12" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                        <div class="table-responsive">
                                                <table class="table table-hover text-secondary my-3 w-100" style="font-size: .8rem;">
                                                    <thead>
                                                        <tr>
                                                            <th>Domaine de formation</th>
                                                            <th>Thematique</th>
                                                            <th>Date</th>
                                                            <th>Organisme sugére</th>
                                                            <th>Statut</th>
                                                            <th>Priorité</th>                                                          
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($besoin as $be)
                                                            @if ($be->anneePlan_id === $p->id)
                                                                <form action="{{route('besoin.modif',$be->id)}}" method="POST">
                                                                @csrf
                                                                    <tr>
                                                                        <td><input  class="form-control inp{{$be->id}}" type="hidden" name="domaine" id="domaine{{$be->id}}" value="" disabled><span class="spa{{$be->id}}"> {{$be->domaine->nom_domaine}}</span></td>
                                                                        <td><input type="hidden"  class="form-control inp{{$be->id}}" name="formation" id="formation{{$be->id}}" value="" disabled><span class="spa{{$be->id}}">{{$be->formation->nom_formation}}</span></td>
                                                                        <td><input type="hidden"  class="form-control inp{{$be->id}}" name="date" id="date{{$be->id}}" value="" ><span class="spa{{$be->id}}">@php echo(date('m-Y',strtotime($be->date_previsionnelle))) @endphp </span></td>
                                                                        <td><input type="hidden" class="form-control inp{{$be->id}}" name="organisme" id="organisme{{$be->id}}" value="" ><span class="spa{{$be->id}}">{{$be->organisme}}</span></td>
                                                                        <td>
                                                                        @if ($be->statut == 0)
                                                                            <span class="bg-warning p-1 text-sm rounded text-white"><small>En attente</small> </span>
                                                                        @elseif ($be->statut == 1)
                                                                            <span class="p-1 rounded text-white" style="background:#41D053;"><small>Validé</small></span>
                                                                        @elseif ($be->statut == 2)
                                                                            <span class="p-1 rounded text-white" style="background:#f54c49;"><small>Refusé</small></span>
                                                                        @endif
                                                                        </td>
                                                                        <td>
                                                                            <select style="border:#0dcaf0 1px solid" hidden class="form-control inp{{$be->id}}" name="type" id="type{{$be->id}}" aria-placeholder="tetret" >
                                                                                <option value="{{$be->type}}" disable selected hidden>{{$be->type}}</option>
                                                                                <option value="urgent">urgent</option>
                                                                                <option value="non-urgent">non-urgent</option>
                                                                            </select>
                                                                            <span class="spa{{$be->id}}">{{$be->type}}</span>
                                                                        </td>
                                                                        @if(strtotime($p->fin_rec) > strtotime('now') )
                                                                            @if($be->statut == '0')
                                                                                <td class="actio">
                                                                                    <a id="but{{$be->id}}" onclick='modifier({{$be->id}},"{{$be->domaine->nom_domaine}}","{{$be->formation->nom_formation}}","{{$be->date_previsionnelle}}","{{$be->organisme}}","{{$be->type}}");' class="btn btn-info text-light btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                                                                    <a id="supp{{$be->id}}" href="{{route('besoin.delete',$be->id)}}" class="btn btn-danger text-light btn-sm" onclick="return confirm('La suppression sera irréversible !')"><i class="fa-solid fa-trash-can"></i></a>
                                                                                    <button type="submit" id="mod{{$be->id}}" style="display: none;margin-left:12px" class="btn btn-sm text-light saf">Modifier</button>
                                                                                </td>
                                                                            @endif
                                                                        @endif
                                                                    </tr>
                                                                </form>
                                                            @endif 
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                            <div class="table-responsive">
                                                <table class="table table-hover text-secondary my-3 w-100" style="font-size: .8rem;">
                                                    <thead>
                                                        <tr>
                                                            <th>Domaine de formation</th>
                                                            <th>Thematique</th>
                                                            <th>Date</th>
                                                            <th>Organisme sugére</th>
                                                            <th>Statut</th>
                                                            <th>Priorité</th> 
                                                            <th>Actions</th>                                                         
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($besoin_valide_stgs as $besoin_valide_stg)
                                                            @if ($besoin_valide_stg->anneePlan_id === $p->id)
                                                                <tr>
                                                                    <td>{{$besoin_valide_stg->domaine->nom_domaine}}</td>
                                                                    <td>{{$besoin_valide_stg->formation->nom_formation}}</td>
                                                                    <td>{{date('m-Y',strtotime($besoin_valide_stg->date_previsionnelle))}}</td>
                                                                    <td>{{$besoin_valide_stg->organisme}}</td>
                                                                    <td>
                                                                    @if ($besoin_valide_stg->reponse_stagiaire == 0)
                                                                        <span class="bg-warning p-1 text-sm rounded text-white"><small>En attente</small> </span>
                                                                    @elseif ($besoin_valide_stg->reponse_stagiaire == 1)
                                                                        <span class="p-1 rounded text-white" style="background:#41D053;"><small>Accepté</small></span>
                                                                    @elseif ($besoin_valide_stg->reponse_stagiaire == 2)
                                                                        <span class="p-1 rounded text-white" style="background:#f54c49;"><small>Refusé</small></span>
                                                                    @endif
                                                                    </td>
                                                                    <td>{{$besoin_valide_stg->type}}</td>
                                                                    @if(strtotime($p->fin_rec) > strtotime('now') )
                                                                        @if($besoin_valide_stg->reponse_stagiaire == '0')
                                                                            <td>
                                                                                <a href="{{route('valideStatutstg',$besoin_valide_stg->id)}}" class="btn" id="{{$besoin_valide_stg->id}}"><i class="bx bx-check bx-sm ml-1" style="color: #41D053;"></i></a>
                                                                                <a href="{{route('refuseSatutstg',$besoin_valide_stg->id)}}" class="btn" id="{{$besoin_valide_stg->id}}"><i class="bx bx-x bx-sm ml-1" style="color: #F00E0B;"></i></a>
                                                                            </td>
                                                                        @endif
                                                                        @if($besoin_valide_stg->reponse_stagiaire == '2')
                                                                            <td>
                                                                                <a href="{{route('valideStatutstg',$besoin_valide_stg->id)}}" class="btn" id="{{$besoin_valide_stg->id}}"><i class="bx bx-check bx-sm ml-1" style="color: #41D053;"></i></a>
                                                                            </td>
                                                                        @endif
                                                                    @endif
                                                                </tr>
                                                            @endif 
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
             
    </div>
</div>
<script>
    function modifier(id,domaine,formation,date,organisme,type){
        var a = 'spa'+id;
        var b = 'inp'+id;
        var d = 'domaine'+id;
        var e = 'formation'+id;
        var f = 'date'+id;
        var j = 'organisme'+id;
        var h ='but'+id;
        var m ='supp'+id;
        var n ='mod'+id;
        var o = 'type'+id;
        var x = 'opt'+id;
       var element = document.getElementsByClassName(a);
       for(var i=0;i<element.length;i++)
        {
        element[i].style.display='none';
        }
       var input = document.getElementsByClassName(b);
       for(var i=0;i<input.length;i++)
        {
        input[i].type='text';
        input[2].type='month';
        }
        document.getElementById(d).value = domaine;
        document.getElementById(e).value = formation;
        document.getElementById(f).value = date;
        document.getElementById(j).value = organisme;
        document.getElementById(o).value = type;
       
        var g =document.getElementById(h);
        g.style.display = "none";
        var k =document.getElementById(m);
        k.style.display = "none";
        var y =document.getElementById(n);
        y.style.display = "block";
        let se = document.getElementById("type"+id);
        se.removeAttribute("hidden");
        se.value=type;
        
    
    };
    
</script>
@endsection