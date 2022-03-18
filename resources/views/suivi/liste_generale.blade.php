@extends('../layouts/menu')
@section('content')
<div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header">Liste des participants</h3>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Liste des stagiaires qui ont suivies la formation chez Numerika
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Entreprise</th>
                                                    <th>Nom</th>
                                                    <th>Prénom</th>
                                                    <th>Genre</th>
                                                    <th>Fonction</th>
                                                    <th>Mail</th>
                                                    <th>Telephone</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($datas as $d)
                                                <tr>
                                               
                                                   
                                                    <td>{{$d->nom_etp}}
                                                    <td>{{$d->nom_stagiaire}}</td>
                                                    <td>{{$d->prenom_stagiaire}}</td>
                                                    <td>{{$d->genre_stagiaire}}</td>
                                                    <td>{{$d->fonction_stagiaire}}</td>
                                                    <td>{{$d->mail_stagiaire}}</td>
                                                    <td>{{$d->telephone_stagiaire}}</td>
                                                    <td>   
                                                        <a href="{{route('profil',[$d->id])}}" class="btn btn-success m-2" role="button">Detail</a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{ $datas->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection