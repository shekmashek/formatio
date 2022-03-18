@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>Demande de formation</h3>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_demande_formation') ? 'active' : '' }}" aria-current="page" href="{{route('liste_demande_formation')}}">
                                    <i class="fa fa-list">Liste de demande </i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('planFormation.index') ? 'active' : '' }}" aria-current="page" href="{{route('planFormation.index')}}">
                                    <i class="fa fa-plus"> Nouvelle demande </i></a>
                            </li>

                    </ul>

                        </div>
                    </div>
                </nav>

                <table class="table" id="projet_tab">
                    <thead>
                        <tr>
                            <th>Domaine</th>
                            <th>Formation</th>
                            <th>Durée(en jours)</th>
                            <th>Date prev.</th>
                            <th>Statut</th>

                        </tr>
                    </thead>
                    <tbody id = "liste_projet">
                            @foreach($recueilInfo as $rec)
                                    <tr>
                                        @foreach ($liste_domaine as $d)
                                            @if ($d->id == $rec->formation->domaine_id)
                                                <td>{{$d->nom_domaine}}</td>
                                            @endif
                                        @endforeach
                                        <td>{{$rec->formation->nom_formation}}</td>
                                        <td>{{$rec->duree_formation}} j</td>
                                        <td><?php setlocale(LC_ALL, 'fr_FR'); ?>{{date('F', mktime(0, 0, 0, $rec->mois_previsionnelle, 10)).' '.$rec->annee_previsionnelle}} </td>
                                        @if($rec->statut == "En attente")
                                            <td id = "statut_demande"><span id = "span_statut" style="background-color:orange;color:white" class="py-1 px-1">{{$rec->statut}}</span></td>
                                        @elseif($rec->statut == "Acceptée")
                                            <td id = "statut_demande"><span id = "span_statut" style="background-color:green;color:white" class="py-1 px-1">{{$rec->statut}}</span></td>
                                        @else
                                            <td id = "statut_demande"><span id = "span_statut" style="background-color:red;color:white" class="py-1 px-2">{{$rec->statut}}</span></td>
                                        @endif

                                    </tr>
                            @endforeach

                            <input id="id_value" value=""  style = "display:none">

                    </tbody>
                </table>
        </div>
@endsection
