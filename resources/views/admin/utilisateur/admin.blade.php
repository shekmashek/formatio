@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>Utilisateurs / Administrateurs</h3>
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

        {{-- <form action="{{ route('utilisateur_new_admin') }}"> --}}
            @csrf
        <p style="display: flex; justify-content: flex-end;">   
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModals">&nbsp; Nouvel administrateur</button>
            </p>
        {{-- </form> --}}

<div class="container-fluid">
    <table class="table">
        <thead>
            <th> ID </th>
            <th> Nom </th>
            <th> Email </th>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
            </tr>            

  
  <!-- Modal -->
  <div class="modal fade" id="exampleModals" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h1>Ajout nouvel administrateur</h1>
        </div>
        <div class="modal-body">
            <form action="{{ route('utilisateur_new_admin') }}" method="get">
                @csrf
          <label for=""> Nom </label>
          <input type="text" class="form-control" required name="nom_new_user"><br><br>
          <label for=""> Email </label>
          <input type="text" class="form-control" required name="email_new_user"><br><br>
          <label for=""> Mot de passe </label>
          <input type="password" class="form-control" name="password_new_user"><br><br>
          <input type="password" class="form-control" value="1" name="role_id" style="display:none"><br><br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">&nbsp; Retour</button>
          <button type="submit" class="btn btn-primary">&nbsp; Enregistrer</button>
            </form>
        </div>
      </div>
    </div>
  </div>


            @endforeach
        </tbody>
        <tfoot></tfoot>
    </table>
</div>

    </div>
    </div>


@endsection
