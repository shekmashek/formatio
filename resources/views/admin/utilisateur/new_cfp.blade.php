@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>Utilisateurs / Centre de formations professionnelles</h3>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                        <a class="nav-link  {{ Route::currentRouteNamed('liste_utilisateur') || Route::currentRouteNamed('liste_utilisateur') ? 'active' : '' }}" href="{{route('liste_utilisateur')}}">
                            <i class="fa fa-list">&nbsp; Responsables</i></a>
                        </li>

                        <li class="nav-item">

                        <a class="nav-link  {{ Route::currentRouteNamed('utilisateur_stagiaire') ? 'active' : '' }}" aria-current="page" href="{{route('utilisateur_stagiaire')}}">
                            <i class="fa fa-list">&nbsp; Stagiaires</i></a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('utilisateur_formateur') ? 'active' : '' }}" href="{{route('utilisateur_formateur')}}">
                            <i class="fa fa-list">&nbsp; Formateurs</i></a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('utilisateur_admin') ? 'active' : '' }}" href="{{route('utilisateur_admin')}}">
                            <i class="fa fa-list">&nbsp; Admin</i></a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('utilisateur_cfp') ? 'active' : '' }}" href="{{route('utilisateur_cfp')}}">
                            <i class="fa fa-list">&nbsp; Cfp</i></a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('utilisateur_superAdmin') ? 'active' : '' }}" href="{{route('utilisateur_superAdmin')}}">
                            <i class="fa fa-list">&nbsp; Super Admin</i></a>
                        </li>


                    </ul>


                    </div>
                </div>
            </nav>


            <form class="navbar-form navbar-left" role="search">
                    <div style="display: flex; justify-content: flex-end;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Tout <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route('liste_utilisateur',5)}}">5</a></li>
                            <li><a href="{{route('liste_utilisateur',10)}}">10</a></li>
                            <li><a href="{{route('liste_utilisateur',25)}}">25</a></li>
                            <li><a href="{{route('liste_utilisateur',50)}}">50</a></li>
                            <li><a href="{{route('liste_utilisateur',100)}}">100</a></li>
                            <li class="divider"></li>
                            <li><a href="{{route('liste_utilisateur')}}">Tout</a></li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Rechercher par entreprise <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                @foreach($liste as $etp)
                                    <li><a href="{{route('utilisateur.show',$etp->id)}}">{{$etp->nom_etp}}</a></li>
                                @endforeach
                                <li class="divider"></li>
                                <li><a href="{{route('liste_utilisateur')}}">Tout</a></li>
                            </ul>
                        </div>

                    </div>
            </form>
        </div>

<div class="card" style="padding: 5px;">
    <form action="{{ route('utilisateur_register_cfp') }}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="row">
        <div class="col-md-6">
            <label for=""> Logo </label><p></p><p></p>
            <input type="file" name="logo"><br><br>
            <label for=""> Nom </label><br>
            <input type="text" class="form-control" name="nom" autocomplete="off" required><br>
            <div class="d-flex justify-content-between">
                <div>
                    <label for=""> Lot </label><br>
                    <input type="text" class="form-control" name="adresse_lot" autocomplete="off" required><br>
                </div>
                <div>
                    <label for=""> Ville </label><br>
                    <input type="text" class="form-control" name="adresse_ville" autocomplete="off" required><br>
                </div>
                <div>
                    <label for=""> Région </label><br>
                    <input type="text" class="form-control" name="adresse_region" autocomplete="off" required><br>
                </div>
            </div>
            <div class="d-flex flex-row">
                <div>
                    <label for=""> E-mail </label><br>
                    <input type="text" class="form-control" name="email" autocomplete="off" required><br>
                </div>
                <div>
                    <label for=""> Site web </label><br>
                    <input type="text" class="form-control" name="site" autocomplete="off" required><br>
                </div>
            </div>
            <label for=""> Téléphone(une seule numero) </label><br>
            <input type="text" class="form-control" name="telephone" autocomplete="off" required><br>

        </div>
        <div class="col-md-6">
            <label for=""> Domaine </label><br>
            <input type="text" class="form-control" name="domaine" autocomplete="off" required><br>
            <label for=""> NIF </label><br>
            <input type="text" class="form-control" name="nif" autocomplete="off" required><br>
            <label for=""> STAT </label><br>
            <input type="text" class="form-control" name="stat" autocomplete="off" required><br>
            <label for=""> RCS</label><br>
            <input type="text" class="form-control" name="rcs" autocomplete="off" required><br>
            <label for=""> CIF </label><br>
            <input type="text" class="form-control sm-3" name="cif" autocomplete="off" required><br>
        </div>
    </div>
    <br><br>
        <div style="display: flex; justify-content: flex-end;">
            <button type="submit" class="btn btn-success">&nbsp; Enregistrer </button>
        </div>
    </form>
</div>

    </div>
    </div>


@endsection
