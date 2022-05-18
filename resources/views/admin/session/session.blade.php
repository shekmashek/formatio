@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Détails des projets</h3>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
            	<br>
                <h3>DETAILS DES PROJETS</h3>
            </div> --}}

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_session') ? 'active' : '' }}" aria-current="page" href="{{route('liste_session')}}">
                                    <i class="fa fa-calendar">Sessions</i></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('liste_detail') ? 'active' : '' }}" aria-current="page" href="{{route('liste_detail')}}">
                                    <i class="fa fa-list"> Listes des Détails</i></a>
                            </li>
                            <li  class ="nav-item " >
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            Tout <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{route('liste_session',5)}}">5</a></li>
                                            <li><a href="{{route('liste_session',10)}}">10</a></li>
                                            <li><a href="{{route('liste_session',25)}}">25</a></li>
                                            <li><a href="{{route('liste_session',25)}}">50</a></li>
                                            <li><a href="{{route('liste_session',25)}}">100</a></li>
                                            <li class="divider"></li>
                                            <li><a href="{{route('liste_session')}}">Tout</a></li>
                                        </ul>
                                    </div>

                                </form>
                            </li>

                            <li class="nav-item d-flex">
                                <button class="btn nav-link" data-toggle="modal" data-target="#myModal"><i class = "fa fa-plus">Nouvelle session</i> </button>
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
                    <div class="shadow p-3 mb-5 bg-body rounded">
                        <div class="row">
                            @foreach ($session as $sess)
                            <div class="col-md-3">

                                 <small><b>Numéro</b></small>
                                 <br>
                                 <p style="margin-top:10px;">{{optional(optional($sess)->session)->numero_session}}</p>

                                </div>
                            <div class="col-md-3">
                         <small><b>Date de début</b></small>
                         <p  style="margin-top:10px;">{{optional(optional($sess)->session)->date_debut}}</p>

                            </div>
                            <div class="col-md-3">
                                <small><b>Date fin </b></small>
                                <p style="margin-top:10px;">{{optional(optional($sess)->session)->date_fin}}</p>

                            </div>
                            <div class="col-md-3">
                                <small><b>Détail</b></small>
                             <p>   <a class="btn " href="{{route('nouveau_detail',['id_session' => optional(optional($sess)->session)->id])}}"><i class="fa fa-plus-square fa-lg" aria-hidden="true"></i></a>

                            </div>
                            @endforeach

                        </div>



                    <!-- nouvelle session -->
                    <div class="modal fade" id = "myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h5 class="modal-title">Nouvelle session</h5>
                                </div>
                                <div class="modal-body">

                                    <form  class="btn-submit" method = "POST" action = "{{route('ajout_session')}}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="debut">Date de début</label>
                                            <input type="date" class="form-control" id="date_debut" name="date_debut">
                                        </div>
                                        <div class="form-group">
                                          <label for="fin">Date fin</label>
                                          <input type="date" class="form-control" id="date_fin" name="date_fin">
                                        </div>
                                        <br>
                                        <button class="btn btn-success  " id="action1"><span class = "glyphicon glyphicon-plus"></span> Ajouter</button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
