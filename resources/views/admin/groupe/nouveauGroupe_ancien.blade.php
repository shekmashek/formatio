@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>PROJET DE FORMATION</h3>
            </div>
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
                                    <i class="fa fa-list">Liste des Projects</i></a>
                                </li>

                                <li class="nav-item">

                                <a class="nav-link  {{ Route::currentRouteNamed('liste_groupe') ? 'active' : '' }}" aria-current="page" href="{{route('liste_groupe')}}">
                                    <i class="fa fa-list">Listes des Groupes</i></a>

                                </li>

                                <li class="nav-item">
                                    <a class="nav-link  {{ Route::currentRouteNamed('nouveau_groupe') ? 'active' : '' }}" href="{{route('nouveau_groupe')}}"><i class="fa fa-plus">Nouveau Groupe</i></a>
                                </li>


                            </ul>



                            </div>
                        </div>
                    </nav>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form  action = "{{route('groupe.store')}}" method="POST" >
                                    @csrf
                                    <div class="form-group">
                                    <label for="projet">Nom du projet</label><br>
                                    <select name="projet" class="form-control" id="projet" name = "projet">
                                        @foreach($projet as $li)
                                        <option value="{{$li->id}}">{{$li->nom_projet}}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Groupe</label>
                                        <input type="text" class="form-control" id="nom_groupe" name="nom_groupe" placeholder="Nom">
                                        @error('nom_groupe')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>

                                    <button type = "submit" class="btn btn-secondary "><span class="glyphicon glyphicon-plus-sign"></span> Ajouter

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
