@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>Nouvelle Formation</h3>
            </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                
                <a class="nav-link {{ Route::currentRouteNamed('liste_formation') || Route::currentRouteNamed('liste_projet') ? 'active' : '' }}" aria-current="page" href="{{route('liste_formation')}}">
             <i class="fa fa-list ">Liste des formations</i></a>
                        
                </li>
                <li class="nav-item">
                <a class="nav-link  {{ Route::currentRouteNamed('nouvelle_formation') ? 'active' : '' }}" href="{{route('nouvelle_formation')}}"><i class="fa fa-plus">Nouvelle Formation</i></a>
                </li>
                <li class="nav-item">
                
                <a class="nav-link  {{ Route::currentRouteNamed('liste_module') || Route::currentRouteNamed('liste_module') ? 'active' : '' }}" href="{{route('liste_module')}}">
                    <i class="fa fa-list">Liste des modules</i></a>                 
                </li>

                <li class="nav-item">
                
                <a class="nav-link  {{ Route::currentRouteNamed('liste_programme') || Route::currentRouteNamed('liste_programme') ? 'active' : '' }}" aria-current="page" href="{{route('liste_programme')}}">
                    <i class="fa fa-list">Liste des programmes</i></a>
                            
                </li>
                
            </ul>
            </div>
        </div>
        </nav>

            <form class="navbar-form navbar-left" role="search">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      Tout <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="{{route('liste_formation',5)}}">5</a></li>
                      <li><a href="{{route('liste_formation',10)}}">10</a></li>
                      <li><a href="{{route('liste_formation',25)}}">25</a></li>
                      <li><a href="{{route('liste_formation',25)}}">50</a></li>
                      <li><a href="{{route('liste_formation',25)}}">100</a></li>
                      <li class="divider"></li>
                      <li><a href="{{route('liste_formation')}}">Tout</a></li>
                    </ul>
                </div>
            </form>
        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form  action = "{{route('formation.store')}}" method="POST" >
                                    @csrf
                                    <div class="form-group">
                                        <label for="username">Nom de la formation</label>
                                        <input type="text" class="form-control" id="nom_projet" name="nom_formation" placeholder="Nom">
                                        @error('nom_formation')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>

                                    <button type = "submit" class="btn btn-outline-primary ">  <i class="fa fa-plus">Ajouter</i> </button>
                                   <!-- <input type = "submit" class="btn btn-primary" id ="action2" value = "Modifier" style="visibility:hidden">
                                   		 -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
