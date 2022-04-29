@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Projet de formation </h3>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
            	<br>
                <h3>PROJET DE FORMATION</h3>
            </div> --}}
            <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_projet') || Route::currentRouteNamed('liste_projet') ? 'active' : '' }}" href="{{route('liste_projet')}}">
                                    <i class="fa fa-list">Liste des Projets</i></a>
                                </li>

                                <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('nouveau_projet') ? 'active' : '' }}" href="{{route('nouveau_projet')}}"><i class="fa fa-plus">Nouveau Projet</i></a>
                                </li>


                                <li class="nav-item">

                                <a class="nav-link  {{ Route::currentRouteNamed('liste_groupe') ? 'active' : '' }}" aria-current="page" href="{{route('liste_groupe')}}">
                                    <i class="fa fa-list">Listes des Groupes</i></a>

                                </li>

                            </ul>



                            </div>
                        </div>
                        </nav>


                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form  action = "{{route('projet.store')}}" method="POST" >
                                    @csrf
                                    <div class="form-group">
                                        {{-- <label for="username">Nom du projet</label>
                                        <input type="text" class="form-control" id="nom_projet" value="2_OCEANTRADE_9/2020" name="nom_projet" placeholder="Nom" readonly> --}}
                                        {{-- @error('nom_projet')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror --}}
                                    </div><br>

                                    <div class="form-group">
                                      <label for="etp">Entreprise</label><br>
                                      <select name="liste_etp" class="form-control" id="liste_etp" name = "liste_etp">
                                          @foreach($etp as $li)
                                          <option value="{{$li->id}}">{{$li->nom_etp}}</option>
                                          @endforeach
                                      </select>
                                    </div>

                                    <button type = "submit" class="btn btn-secondary "><span class="glyphicon glyphicon-plus-sign"></span> Ajouter
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
