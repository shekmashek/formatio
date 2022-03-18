@extends('../layouts.menu')

@section('content')
 <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="page-header">Liste des formations</h3>



                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">

                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Nom du projet</th>
                                                    <th>Formation</th>
                                                    <th>Module</th>
                                                    <th>Nombre de participants</th>
                                                    <th>Début</th>
                                                    <th>Fin</th>
                                                    <th>Lieu</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                 @foreach($datas as $d)

                                                     <tr>
                                                        <td>{{$d->projet->nom_projet}}/{{$d->projet->groupe_projet}}</td>
                                                        @if( $d->module->formation_id == 1)
                                                            <td>MS Excel</td>
                                                        @else
                                                            <td>Ms Power BI</td>
                                                        @endif
                                                        <td>{{$d->module->nom_module}}</td>
                                                        <td width="10%">{{$nb->detail_count}}</td>
                                                        <td  width = "10%">{{$d->date_debut}}</td>
                                                        <td width = "10%">{{$d->date_fin}}</td>
                                                        <td>{{$d->lieu}}</td>
                                                        <td>
                                                            <a href="{{route('detail_projet',[$d->id])}}" class="btn btn-success m-2" role="button">Detail</a>
                                                        </td>
                                                    </tr>



                                                @endforeach
                                            </tbody>
                                        </table>
                                        <?php echo $datas->render(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection
