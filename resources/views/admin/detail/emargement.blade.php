@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Emmargement</h3>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
            	<br>
                <h3>FEUILLE D'EMARGEMENT</h3>
            </div> --}}
            <div class="col-lg-4 mb-3">
                <form class="col-lg-12 form-inline" method="GET" action="{{ route('recherche_projet') }}">
                        <div class="form-group">
                            <input type="text" id="projet_search" name="nom_projet" class="form-control" placeholder="Nom du projet"/>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                </form>
            </div>
        </div><br>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class ="{{ Route::currentRouteNamed('presence.index') ? 'active' : '' }}"><a href="{{route('presence.index')}}" ><span class="glyphicon glyphicon-calendar"></span>  Séance</a></li>
                        </ul>
                    </div>
                    <div class="panel-body">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Projet</th>
                                        <th>Groupe</th>
                                        <th >Date</th>
                                        <th>Début</th>
                                        <th>Fin</th>
                                        <th>Formation</th>
                                        <th>Module</th>
                                        <th>Présence</th>
                                        <th>Nombre des participants</th>
                                        <th>Présent</th>


                                    </tr>
                                </thead>

                                <tbody>


                                       @foreach ($datas as $d)
                                       <tr>
                                            <td>{{$d->nom_projet}}</td>
                                            <td>{{$d->nom_groupe}}</td>
                                            <td >{{$d->date_detail}}</td>
                                            <td>{{$d->h_debut}} h</td>
                                            <td >{{$d->h_fin}} h</td>
                                            <td>{{$d->nom_formation}} </td>

                                            <td>{{$d->nom_module}}</td>
                                            <td >
                                                <a href="{{route('presence.show',[$d->detail_id])}}" class ="btn btn-info"><i class = "fa fa-pencil"></i></a>
                                            </td>
                                            <td>
                                                @foreach($nb_participant as $nombreparticipant)
                                                    {{-- @if($nombreparticipant->id == $d->detail_id) --}}
                                                        <label for="">{{$nombreparticipant->presence_count}}</label>
                                                    {{-- @endif --}}
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($nb as $present)
                                                    @if($present->id == $d->detail_id)
                                                        <label for="">{{$present->presence_count}}</label>
                                                    @endif

                                                @endforeach
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
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        $( "#projet_search" ).autocomplete({

            source: function( request, response ) {
            // Fetch data
            $.ajax({
                url:"{{route('search_projet')}}",
                type: 'get',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function( data ) {
                response( data );


                },error:function(data){
                    alert("error");
                }
            });
            },
            select: function (event, ui) {

            // Set selection
            $('#projet_search').val(ui.item.label); // display the selected text
            $('#projetid').val(ui.item.value); // save selected id to input
            return false;
            }
        });
    });
</script>
@endsection
