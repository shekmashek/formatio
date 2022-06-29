@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Demande</p>
@endsection
@section('content')
<link rel="stylesheet" href="dragtable.css">
<script src="jquery-ui.js"></script>
<script src="jquery.dragtable.js"></script>
<script src="extensions/reorder-columns/bootstrap-table-reorder-columns.js"></script>
<style>
    h1{
        font-weight: 400;
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
</style>
<div id="page-wrapper">
    <div class="container  mt-5 p-4">
        <div class="row">
            <h1>Reccueil besoin en formation</h1>
        </div>
        <div class="row mt-3 p-3">
            <table class="table text-center">
                <thead>
                    @foreach ($plan as $p)
                    <tr style="background: rgb(250, 248, 248)">
                        <td class="p"  colspan="1"><span style="padding-top: 30px">Années :{{$p->AnneePlan}}</span>  &nbsp;  Debut du recueil : {{ \Carbon\Carbon::parse($p->debut_rec)->format('d/m/Y')}} &nbsp; fin du recueil : {{ \Carbon\Carbon::parse($p->fin_rec)->format('d/m/Y')}} 
                            @if(strtotime($p->fin_rec) > strtotime('now') )
                                <a href="{{route('plan.demande',$p->id)}} " class="btn btn-info text-light" style="float: right">Demander un formation</a>
                            @else
                                <a class="btn btn-danger text-light" style="float: right">Términer</a>
                            @endif
                        </th>
                        <th class="" colspan="0">
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample_{{$p->AnneePlan}}" role="button" aria-expanded="false" aria-controls="collapseExample">
                                <i style="color:white" class="fa-solid fa-arrow-down-long"></i>
                            </a>
                        </th>
                    </tr>
                    <tbody>
                        <tr>
                            <td>
                               
                                    <div  id="collapseExample_{{$p->AnneePlan}}">
                                        <div class="card card-body" style="width: 100%">
                                            <p>Vos demandes:</p>
                                            @if(session()->has('success'))
                                                <div class="alert alert-success" style="height: 60px">
                                                    <p>Modification effectué avec succes &nbsp; 👏🏻</p>
                                                </div>
                                            @endif
                                            @if(session()->has('delete'))
                                                <div class="alert alert-danger" style="height: 60px">
                                                    <p>Demande supprimer &nbsp; <span>🥺</span> </p>
                                                </div>
                                            @endif
                                            <table class="table table-hover">
                                                <thead>
                                                    
                                                    <th>Domaine de formation</th>
                                                    <th>Thematique</th>
                                                    <th>Date</th>
                                                    <th>Organisme sugére</th>
                                                    <th>Statut</th>
                                                    <th>Priorité</th>
                                                    @if(strtotime($p->fin_rec) > strtotime('now') )
                                                        <th>Action</th>
                                                    @endif
                                                </thead>
                                                <tbody>

                                                    @foreach ($besoin as $be)
                                                        @if ($be->anneePlan_id === $p->id)
                                                        <form action="{{route('besoin.modif',$be->id)}}" method="POST">
                                                            @csrf
                                                            <tr>
                                                                <td><input  class="form-control inp{{$be->id}}" type="hidden" name="domaine" id="domaine{{$be->id}}" value="" ><span class="spa{{$be->id}}"> {{$be->domaine->nom_domaine}}</span></td>
                                                                <td><input type="hidden"  class="form-control inp{{$be->id}}" name="formation" id="formation{{$be->id}}" value="" ><span class="spa{{$be->id}}">{{$be->formation->nom_formation}}</span></td>
                                                                <td><input type="hidden"  class="form-control inp{{$be->id}}" name="date" id="date{{$be->id}}" value="" ><span class="spa{{$be->id}}">@php echo(date('m-Y',strtotime($be->date_previsionnelle))) @endphp </span></td>
                                                                <td><input type="hidden" class="form-control inp{{$be->id}}" name="organisme" id="organisme{{$be->id}}" value="" ><span class="spa{{$be->id}}">{{$be->organisme}}</span></td>
                                                                <td><span class="badge bg-warning">En attente</span></td>
                                                                <td><select style="border:#0dcaf0 1px solid" hidden class="form-control inp{{$be->id}}" name="type" id="type{{$be->id}}" aria-placeholder="tetret" >
                                                                        <option value="{{$be->type}}" disable selected hidden>{{$be->type}}</option>
                                                                        <option value="urgent">urgent</option>
                                                                        <option value="non-urgent">non-urgent</option>
                                                                    </select>
                                                                    <span class="spa{{$be->id}}">{{$be->type}}</span></td>
                                                                @if(strtotime($p->fin_rec) > strtotime('now') )
                                                                <td>
                                                                    <a id="but{{$be->id}}" onclick='modifier({{$be->id}},"{{$be->domaine->nom_domaine}}","{{$be->formation->nom_formation}}","{{$be->date_previsionnelle}}","{{$be->organisme}}","{{$be->type}}");'  class="btn btn-info text-light">
                                                                        <i  class="fa-solid fa-pen-to-square"></i></a>
                                                                    <a id="supp{{$be->id}}" href="{{route('besoin.delete',$be->id)}}" class="btn btn-danger text-light" onclick="return confirm('La suppression sera irréversible !')"><i class="fa-solid fa-trash-can"></i></a>
                                                                    <button type="submit" id="mod{{$be->id}}" style="display: none;margin-left:12px" href="" style="background-color: " class="btn btn text-light saf">Modifier</button>
                                                                </td>
                                                                @endif
                                                            </tr>
                                                        </form>
                                                        @endif 
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                      </div>
                                
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                    {{-- <tr style="background: rgb(250, 248, 248)">
                        <th >2021</th>
                        <th><span class="badge  " style="background: rgb(61, 158, 50)">Términer</span></th>
                        <th></th>
                        <th style="float: right"><i class="fa-solid fa-angle-down"></i></th>
                    </tr>
                    <tr style="background: rgb(250, 248, 248)">
                        <th >2020</th>
                        <th><span class="badge  " style="background: rgb(61, 158, 50)">Términer</span></th>
                        <th></th>
                        <th style="float: right"><i class="fa-solid fa-angle-down"></i></th>
                    </tr> --}}
                </thead>
                
            </table>
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
