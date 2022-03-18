@extends('../layouts/menu')
@section('content')
<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header">Liste des participants</h3>
                            Retour
                            <a href = "{{route('home')}}" class = "glyphicon glyphicon-step-backward"></a>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Nom du projet : {{$nom_projet}}<br>
                                    Formation: {{$nom_formation}}<br>
                                    Module: {{$nom_module}}
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Prénom</th>
                                                    <th>Genre</th>
                                                    <th>Fonction</th>
                                                    <th>Mail</th>
                                                    <th>Téléphone</th>
                                                    <th>Qualité globale de la formation</th>
                                                    <th>Evaluation du formateur</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($datas as $d)
                                                <tr>
                                                    <td>{{$d->nom_stagiaire}}</td>
                                                    <td>{{$d->prenom_stagiaire}}</td>
                                                    <td>{{$d->genre_stagiaire}}</td>
                                                    <td>{{$d->fonction_stagiaire}}</td>
                                                    <td>{{$d->mail_stagiaire}}</td>
                                                    <td>{{$d->telephone_stagiaire}}</td>
                                                    <td>{{$d->qualite_formation}}</td>
                                                    <td>{{$d->evaluation_formation}}</td>
                                                    <td>   
                                                        <a href="{{route('profil',[$d->id])}}" class="btn btn-success m-2" role="button">Detail</a>
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
                </div>
            </div>
        </div>
@endsection