@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Action de formation</h3>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
                <br>

                <h3>ACTION DE FORMATION</h3>
            </div> --}}

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('execution') ? 'active' : '' }}" aria-current="page" href="{{route('execution')}}">
                                    <i class="fa fa-plus">Ajouter des participants</i></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('liste_detail') ? 'active' : '' }}" aria-current="page" href="{{route('liste_detail')}}">
                                    <i class="fa fa-list"> Listes des Détails</i></a>
                            </li>



                        </ul>

                    </div>
                </div>
            </nav>


        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class="{{ Route::currentRouteNamed('execution') ? 'active' : '' }}"><a href="{{route('execution')}}"><span class="glyphicon glyphicon-plus"></span> Ajouter des participants</a></li>
                            <li class="{{ Route::currentRouteNamed('liste_detail') ? 'active' : '' }}"><a href="{{route('liste_detail')}}"><span class="glyphicon glyphicon-th-list"></span> Liste des détails</a></li>
                        </ul>
                    </div>
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                    @endif

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        @canany(['isSuperAdmin','isReferent','isCFP','isFormateur','isFormateurInterne','isManager','isChefDeService'])
                                        <th>Projet</th>
                                        <th>Groupe</th>
                                        @canany(['isFormateur', 'isCFP','isFormateurInterne'])
                                            <th>Convoquer les stagiaires</th>
                                        @endcanany

                                        <th>Ajout stagiaire</th>
                                        @endcanany
                                        @canany(['isStagiaire'])
                                        <th>Formation</th>
                                        <th>Module</th>
                                        <th>Formateur</th>
                                        <th>Lieu</th>
                                        <th>Date début</th>
                                        <th>Date fin</th>
                                        <th>Action</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody>
                                    @canany(['isSuperAdmin','isReferent','isCFP','isFormateur','isFormateurInterne','isManager','isChefDeService'])
                                    @foreach ($datas as $d)
                                    <tr>
                                        <td>{{$d->nom_projet}}</td>
                                        <td>{{$d->nom_groupe}}</td>
                                        @canany(['isFormateur','isFormateurInterne', 'isCFP'])
                                            <td><a href="{{route('convocationMail',[$d->detail_id,$d->groupe_id])}}">Convoquer</a></td>
                                        @endcanany
                                        <td><a href="{{route('ajout_participant',['id_detail' => $d->detail_id])}}"><i class="fa fa-plus"></i></a></td>
                                    </tr>
                                    @endforeach
                                    @endcanany
                                    @canany(['isStagiaire'])
                                    @foreach ($datas as $d)
                                    <tr>
                                        <td>{{$d->nom_formation}}</td>
                                        <td>{{$d->nom_module}}</td>
                                        <td>{{$d->nom_formateur}}</td>
                                        <td>{{$d->lieu}}</td>
                                        <td>{{$d->date_debut}}</td>
                                        <td>{{$d->date_fin}}</td>
                                        <td>
                                            @isset($verifyExist)
                                                @if($verifyExist>0)
                                                <a href="{{route('evaluationchaud.show',$d->matricule)}}"><button class="btn btn-primary" id="{{$d->matricule}}">Voir Evaluation</button></a>
                                                @else
                                                <a href="{{route('faireEvaluationChaud',$d->matricule)}}"><button class="btn btn-primary" id="{{$d->matricule}}">Evaluation à chaud</button></a>
                                                @endif
                                            @else
                                                <a href="{{route('faireEvaluationChaud',$d->matricule)}}"><button class="btn btn-primary" id="{{$d->matricule}}">Evaluation à chaud</button></a>
                                            @endisset

                                        </td>
                                    </tr>
                                    @endforeach
                                    @endcanany
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
