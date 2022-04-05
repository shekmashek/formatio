@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        {{-- <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>DETAILS DES PROJETS</h3>
            </div>

        </div> --}}
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Projets</th>
                                        <th>Groupe</th>
                                        <th>Date de début</th>
                                        <th>Date fin </th>
                                        <th>Détail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($detail_groupe as $s)
                                    <tr>
                                        <td>{{ $s->nom_projet }}</td>
                                        <td>{{ $s->nom_groupe }}</td>
                                        <td width="200px">{{$s->date_debut}}</td>
                                        <td>{{$s->date_fin}}</td>
                                        <td>

                                            <a href="{{route('liste_detail_par_session',[$s->groupe_id,$s->detail_id])}}"><i class="fa fa-eye"></i></a>
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


@endsection
