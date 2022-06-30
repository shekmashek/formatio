
@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Plan de formation </p>
@endsection
@section('content')
<style>
    h4,label,p{
        font-weight: 400;
        color: gray;
    }
    .disabled > a {
    color: currentColor;
    display: inline-block;  /* For IE11/ MS Edge bug */
    pointer-events: none;
    text-decoration: none;
    }
    .disabled {
    cursor: not-allowed;
    opacity: 0.5;
    }
    input[type="text"]:disabled {
    background: rgb(245, 242, 242);
    }
    
    tr .action{
        visibility: hidden;
        display:none;
    }
    
    tr:hover .action,
    tr:hover .actions{
        visibility: visible;
        display: block;
        height: 2%;
    }
</style>

<div id="container-fluid">
    <div class="col-11 my-4 m-auto">
        @can('isReferent')
            <div class="row">
                <div class="col-md-12 ">
                    <div class="float-start">
                        <h4>Plan de formation </h4>
                    </div>
                    <div class="float-end">
                        <button class="btn btn-info text-light text-sm" class="btn btn-primary" > <a href="{{route('ajout.plan',$entreprise_id)}}">Crée un nouveaux plan</a> </button>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-12">
                    @foreach ($plan as $p)
                        <table class="table " >
                            <thead>
                                <tr  style="background: rgb(245, 242, 242);" >
                                    <th style="border: none">{{$p->AnneePlan}}</th>
                                    <th style="float: right;border:none">
                                        <a data-bs-toggle="collapse" data-toggle="collapse" href="#collapseExample_{{$p->AnneePlan}}"   role="button" aria-expanded="false" aria-controls="collapseExample">
                                            <i class="fa-solid fa-angle-down" id="one" onclick="midina()"  data-id="{{$p->id}}"  ></i>
                                        </a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr> 
                                <td>
                                    <div class="collapse" id="collapseExample_{{$p->AnneePlan}}">
                                        <div class="row">
                                            <div class="col-md-6 p-4">
                                                <h5>Plan Previsionnel</h5>
                                                <form action="{{route('plan.modifier',$p->id)}}" method="post">
                                                    @csrf
                                                    
                                                    <div class="form-group">
                                                        <div class="input-groupe">
                                                            <label for="">Demande de recueil:</label>
                                                            <input type="date" value="{{$p->debut_rec}}" name="debut" class="form-control" id="inp" >
                                                        </div>
                                                        <div class="input-groupe">
                                                            <label for="">Fin de recueil:</label>
                                                            <input type="date" placeholder="test" value="{{ $p->fin_rec}}" name="fin" id="inp2" class="form-control" >
                                                        </div>
                                                        <div class="input-groupe">
                                                        <label for="">Salarie:</label>
                                                        <input type="text" class="form-control" value="{{$nombr}}" disabled>
                                                        <button type="submit" class="btn btn-info text-light mt-1" style="margin-left: 503px" >Editer</button>
                                                    </div>
                                                </form>  
                                                <div style="display: flex"> 
                                                <button class="btn btn-info mt-3 text-light">Email de collecte</button>&nbsp;
                                                <p class="mt-4" style="font-weight: 400;font-size:12px;"> Envoie à tout les salarié une email pour reccueillir leur formation</p>
                                                </div>
                                                <div style="display: flex"> 
                                                <button class="btn btn-warning mt-2 text-light">Email de rappele</button>&nbsp;
                                                <p class="mt-3" style="font-weight: 400;font-size:12px;"> rappele par email pour reccueillir leur formation</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 p-4 ">
                                            <h5>Reccueil de besoins</h5>
                                            <div class="row ">
                                                <div class="col">
                                                    <div class="float-start">
                                                        <p>Nombre des besoins  exprimer par les salarier</p>
                                                    </div>
                                                    <div class="float-end">
                                                        
                                                        <p><span id="count"> </span></p>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="row p-2" style="margin-top: -20px">
                                                
                                                    <div>
                                                        <span  class="te "><a href="{{route('liste.demande',$p->id)}}" class="btn btn-info btn-sm mt-2 text-light" ><i class="fa-solid fa-eye"></i>&nbsp; Voir liste</a> </span>
                                                        <span class="te "> <a href="" class="btn btn-primary btn-sm mt-2 text-light"> <i class="fa-solid fa-file-pdf" ></i>&nbsp; Export liste</a> </span>
    
                                                </div>
                                            </div>
                                            <div class="row " >
                                                <div class="col mt-3">
                                                    <div class="float-start">
                                                        <p>Nombre valide par le N+</p>
                                                    </div>
                                                    <div class="float-end">
                                                        <p>0</p>
                                                    </div>
                                                </div>
                                            </div>   
                                            <div class="row p-2" style="margin-top: -20px">
                                                <div>
                                                    <a href="{{route('liste.demandeV')}}" class="btn btn-warning btn-sm mt-2 text-light"><i class="fa-solid fa-eye"></i>&nbsp;Voir liste</a>
                                                    <a href="" class="btn btn-primary btn-sm mt-2 text-light"><i class="fa-solid fa-file-pdf"></i>&nbsp; Export liste</a>
                                                </div>
                                            </div> 
                                            
                                        </div>
                                    </div>
                                    </div>
                                </td>
                                </tr>
                            </tbody>
                        </table>  
                    @endforeach 
                </div>
            </div>
        @endcan

        @can('isManager')
            <div class="row">
                <div class="col">
                    <h3 class="lead">Liste de demande de Formation</h3>
                </div>
            </div>
            <div class="row my-2">

                  <div class="tab-content my-2" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="liste_dmd_formation" role="tabpanel" aria-labelledby="pills-home-tab">
                        @foreach ($plan as $plan_recueil)
                            <div class="row p-1 my-2 rounded justify-content-between text-secondary" style="background: rgb(245,242,242);">
                                <div class="col-3 pt-1">
                                    {{$plan_recueil->AnneePlan}}
                                </div>
                                <div class="col-8 pt-1">{{ \Carbon\Carbon::parse($plan_recueil->debut_rec)->translatedFormat("j F Y")}} au {{ \Carbon\Carbon::parse($plan_recueil->fin_rec)->translatedFormat("j F Y")}}</div>
                                <div class="col-1 text-end">
                                    @if (count($besoins) > 0)
                                        <button class="btn btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$plan_recueil->id}}" aria-expanded="false" aria-controls="collapse">
                                            <i class="fas fa-caret-down"></i>
                                        </button>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="collapse p-3" id="collapse{{$plan_recueil->id}}">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h6 class="text-secondary lead">Tous les demandes de votre équipe</h6>
                                        </div>
                                        <div class="flex-grow-1 text-end">
                                            <a href="{{route('envoye_autre_demande',$plan_recueil->id)}}" class="btn btn-info text-white">Demander une proposition</a>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover text-secondary my-3" style="font-size: .8rem;">
                                            <thead>
                                                <tr>
                                                    <th>Matricule</th>
                                                    <th>Nom stagiaire</th>
                                                    <th>Service</th>
                                                    <th>Fonction</th>
                                                    <th>Nom de formation</th>
                                                    <th>Objectif de besoin</th>
                                                    <th class="text-center">Date prév.</th>
                                                    <th>CFP souhaitée</th>
                                                    <th>Priorité</th>
                                                    <th class="text-center">Status</th>                                                           
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($besoins as $besoin)
                                                    @if ($plan_recueil->id == $besoin->anneePlan_id)
                                                        <tr>
                                                            <td class="text-secondary">{{$besoin->stagiaire->matricule}}</td>
                                                            <td class="text-secondary">{{$besoin->stagiaire->nom_stagiaire}} {{ $besoin->stagiaire->prenom_stagiaire }}</td>
                                                            <td></td>
                                                            <td class="text-secondary">{{$besoin->stagiaire->fonction_stagiaire}}</td>
                                                            <td class="text-secondary">{{ $besoin->formation->nom_formation}}</td>
                                                            <td class="text-secondary">{{ $besoin->objectif}}</td>
                                                            <td class="text-center text-secondary">{{ $besoin->date_previsionnelle}}</td>
                                                            <td class="text-secondary">{{ $besoin->organisme}}</td>
                                                            <td class="text-secondary">{{ $besoin->type}}</td>
                                                            <td class="text-center">
                                                                @if ($besoin->statut == 0)
                                                                    <span class="bg-warning p-1 rounded text-white">En attente</span>
                                                                @elseif ($besoin->statut == 1)
                                                                    <span class="p-1 rounded text-white" style="background:#41D053;">Validé</span>
                                                                @elseif ($besoin->statut == 2)
                                                                    <span class="p-1 rounded text-white" style="background:#f54c49;">Refusé</span>
                                                                @endif
                                                            </td>
                                                            @if ($besoin->statut == 0)
                                                                <td class="action text-center">
                                                                    @if (strtotime($plan_recueil->fin_rec) >= strtotime('now'))
                                                                        <a href="{{route('modifDemandeStagiaire',$besoin->id)}}" class="editBtn{{$besoin->id}} text-info btn"  id="{{$besoin->id}}"><i class="bx bxs-edit-alt bx-sm"></i></a>
                                                                    @endif
                                                                    <a href="{{route('valideStatut',$besoin->id)}}" class="btn" id="{{$besoin->id}}"><i class="bx bx-check bx-sm ml-1" style="color: #41D053;"></i></a>
                                                                    <a href="{{route('refuseSatut',$besoin->id)}}" class="btn" id="{{$besoin->id}}"><i class="bx bx-x bx-sm ml-1" style="color: #F00E0B;"></i></a>
                                                                </td>
                                                            @elseif ($besoin->statut == 2)
                                                                <td class="action text-center">
                                                                    @if (strtotime($plan_recueil->fin_rec) >= strtotime(now()))
                                                                        <a href="{{route('modifDemandeStagiaire',$besoin->id)}}" class="editBtn{{$besoin->id}} text-info" class="btn"  id="{{$besoin->id}}"><i class="bx bxs-edit-alt bx-sm"></i></a>
                                                                    @endif
                                                                    <a href="{{route('valideStatut',$besoin->id)}}" class="btn" id="{{$besoin->id}}"><i class="bx bx-check bx-sm ml-1" style="color: #41D053;"></i></a>
                                                                </td>
                                                            @endif
                                                        </tr> 
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endcan
       
</div> 
      
</div>
@push('scripts')
<script>

    function midina(){
       var id = $('#one').data('id');
       console.log(id);
       $.ajax({
            url: "/countPlan",
            type: "get",
            data: {
                Id: id,
            },
            success: function(response) {
                var b = response;
                $('#count').html('<p>'+b+' </p>');
            },
        }); 
    };
</script>
@endpush

@endsection
