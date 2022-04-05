@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        {{-- <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>ACTION DE FORMATION</h3>
            </div>
        </div> --}}
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class ="{{ Route::currentRouteNamed('execution') ? 'active' : '' }}"><a href="{{route('execution')}}" ><span class="glyphicon glyphicon-plus"></span> Ajouter des participants</a></li>
                            <li class ="{{ Route::currentRouteNamed('liste_detail') ? 'active' : '' }}"><a href="{{route('liste_detail')}}" ><span class="glyphicon glyphicon-th-list"></span>  Liste des détails</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Projet</th>
                                        <th>Session</th>
                                        <th>Evaluation</th>

                                    </tr>
                                </thead>

                                <tbody>

                                       @foreach ($datas as $d)
                                       <tr>
                                           <td>{{$d->nom_projet}}</td>
                                           <td>{{$d->nom_groupe}}</td>
                                           <td><a href="{{route('tableau_competence',[$d->projet_id,$d->groupe_id,$d->module_id])}}"><span class = "glyphicon glyphicon-plus">Evaluation</span></a></td>
                                        </tr>
                                       @endforeach

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
