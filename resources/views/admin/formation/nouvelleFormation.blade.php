@extends('./layouts/admin')
@section('title')
<p class="text-white ms-5" style="font-size: 20px;">Nouveau formation</p>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">

                                <a class="nav-link {{ Route::currentRouteNamed('liste_formation') || Route::currentRouteNamed('liste_projet') ? 'active' : '' }}" aria-current="page" href="{{route('liste_formation')}}">
                                    <i class="bx bx-list-ul" style="font-size: 20px;"></i><span>&nbsp;Liste des formations</span></a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('nouvelle_formation') ? 'active' : '' }}" href="{{route('nouvelle_formation')}}"><i class="bx bxs-plus-circle"></i><span>&nbsp;Nouvelle Formation</span></a>
                            </li>
                            <li class="nav-item">

                                <a class="nav-link  {{ Route::currentRouteNamed('liste_module') || Route::currentRouteNamed('liste_module') ? 'active' : '' }}" href="{{route('liste_module')}}">
                                    <i class="bx bx-list-minus" style="font-size: 20px;"></i><span>&nbsp;Liste des modules</span></a>
                            </li>

                            <li class="nav-item">

                                <a class="nav-link  {{ Route::currentRouteNamed('liste_programme') || Route::currentRouteNamed('liste_programme') ? 'active' : '' }}" aria-current="page" href="{{route('liste_programme')}}">
                                    <i class="bx bx-list-minus" style="font-size: 20px;"></i><span>&nbsp;Liste des programmes</span></a>

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

                <div class="panel-body">
                    <div class="container">
                        <div class="col-lg-12">
                            <form action="{{route('formation.store')}}" method="POST">
                                @csrf
                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group me-3">
                                            <label for="domaine de formation" class="label_margin_bottom">Domaine de formation</label>
                                            <select class="form-select" name="domaine" aria-label="Default select example">
                                                <option value="null" disabled selected hidden>Choisissez votre domaine de formation ...</option>
                                                @foreach ($domaine as $d)
                                                <option value="{{ $d->id }}">{{ $d->nom_domaine }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group mt-2 ms-3">
                                            <label for="username">Nom de la formation</label>
                                            <input type="text" class="form-control" id="nom_projet" autocomplete="off" name="nom_formation" placeholder="Nom" pattern="[a-zA-Z0-9@&,/'- ']" required>
                                            @error('nom_formation')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row mb-5 mt-3" align="center">
                                    <div class="col">
                                        <button type="submit" class="btn btn-secondary w-50"> <i class="bx bxs-plus-circle"></i><span>&nbsp;Ajouter</span></button>
                                    </div>
                                </div>
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
</div>
@endsection
