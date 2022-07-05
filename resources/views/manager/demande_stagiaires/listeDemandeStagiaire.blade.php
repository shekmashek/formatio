@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Demande de formation </p>
@endsection
<style>
     tr .action{
        visibility: hidden;
        display:none;
    }

    tr:hover .action,
    tr:hover .actions{
        visibility: visible;
        display: block;
        cursor: pointer;
        height: 2%;
    }

</style>
@section('content')
    <div class="container-fluid">   
        <div class="col-11 m-auto my-5">
            <div class="row">
                <div class="col-">
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
                                        <div class="flex-grow-1 text-end">
                                            <a href="{{route('envoye_autre_demande',$plan_recueil->id)}}" class="btn btn-info text-white">Demander une proposition</a>
                                        </div>
                                    </div>
                                    <div class="tab-content w-100" id="pills-tabContent">
                                        <div class="tab-pane fade show active col-12" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                                            <div class="table-responsive">
                                                    <table class="table table-hover text-secondary my-3 w-100" style="font-size: .8rem;">
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
                                                                        <td class="text-secondary">{{$besoin->matricule}}</td>
                                                                        <td class="text-secondary">{{$besoin->nom_stagiaire}} {{ $besoin->prenom_stagiaire }}</td>
                                                                        <td class="text-secondary">{{ $besoin->nom_service }}</td>
                                                                        <td class="text-secondary">{{$besoin->fonction_stagiaire}}</td>
                                                                        <td class="text-secondary">{{ $besoin->nom_formation}}</td>
                                                                        <td class="text-secondary">{{ $besoin->objectif}}</td>
                                                                        <td class="text-center text-secondary">{{ $besoin->date_prev}}</td>
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
                                                                                    <a href="{{route('modifDemandeStagiaire',$besoin->besoin_id)}}" class="editBtn{{$besoin->besoin_id}} text-info btn"  id="{{$besoin->besoin_id}}"><i class="bx bxs-edit-alt bx-sm"></i></a>
                                                                                @endif
                                                                                <a href="{{route('valideStatut',$besoin->besoin_id)}}" class="btn" id="{{$besoin->besoin_id}}"><i class="bx bx-check bx-sm ml-1" style="color: #41D053;"></i></a>
                                                                                <a href="{{route('refuseSatut',$besoin->besoin_id)}}" class="btn" id="{{$besoin->besoin_id}}"><i class="bx bx-x bx-sm ml-1" style="color: #F00E0B;"></i></a>
                                                                            </td>
                                                                        @elseif ($besoin->statut == 2)
                                                                            <td class="action text-center">
                                                                                @if (strtotime($plan_recueil->fin_rec) >= strtotime(now()))
                                                                                    <a href="{{route('modifDemandeStagiaire',$besoin->besoin_id)}}" class="editBtn{{$besoin->besoin_id}} text-info" class="btn"  id="{{$besoin->besoin_id}}"><i class="bx bxs-edit-alt bx-sm"></i></a>
                                                                                @endif
                                                                                <a href="{{route('valideStatut',$besoin->besoin_id)}}" class="btn" id="{{$besoin->besoin_id}}"><i class="bx bx-check bx-sm ml-1" style="color: #41D053;"></i></a>
                                                                            </td>
                                                                        @endif
                                                                    </tr> 
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
                                                                <th>Matricule</th>
                                                                <th>Nom stagiaire</th>
                                                                <th>Service</th>
                                                                <th>Fonction</th>
                                                                <th>Nom de formation</th>
                                                                <th>Objectif de besoin</th>
                                                                <th class="text-center">Date prév.</th>
                                                                <th>CFP souhaitée</th>
                                                                <th>Priorité</th>
                                                                <th class="text-center">Reponse stagiaire</th>                                                           
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($propositions as $proposition)
                                                                @if ($plan_recueil->id == $proposition->anneePlan_id)
                                                                    <tr>
                                                                        <td class="text-secondary">{{$proposition->matricule}}</td>
                                                                        <td class="text-secondary">{{$proposition->nom_stagiaire}} {{ $proposition->prenom_stagiaire }}</td>
                                                                        <td class="text-secondary">{{ $proposition->nom_service }}</td>
                                                                        <td class="text-secondary">{{$proposition->fonction_stagiaire}}</td>
                                                                        <td class="text-secondary">{{ $proposition->nom_formation}}</td>
                                                                        <td class="text-secondary">{{ $proposition->objectif}}</td>
                                                                        <td class="text-center text-secondary">{{ $proposition->date_prev}}</td>
                                                                        <td class="text-secondary">{{ $proposition->organisme}}</td>
                                                                        <td class="text-secondary">{{ $proposition->type}}</td>
                                                                        <td class="text-center">
                                                                            @if ($proposition->reponse_stagiaire == 0)
                                                                                <span class="bg-warning p-1 rounded text-white">En attente</span>
                                                                            @elseif ($proposition->reponse_stagiaire == 1)
                                                                                <span class="p-1 rounded text-white" style="background:#41D053;">Accepté</span>
                                                                            @elseif ($proposition->reponse_stagiaire == 2)
                                                                                <span class="p-1 rounded text-white" style="background:#f54c49;">Refusé</span>
                                                                            @endif
                                                                        </td>
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
@endsection