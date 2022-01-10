@extends('./layouts/admin')
@section('content')
    <div id="page-wrapper">
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="projet_tab">
                                <thead>
                                    <tr>
                                        <th>Niveau</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($niveau as $nv)
                                        <tr>
                                            <td>{{$nv->niveau}}</td>
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
@endsection
