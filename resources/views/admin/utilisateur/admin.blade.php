@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Utilisateurs</h3>
@endsection
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
                <br>
                <h3>Utilisateurs / </h3>
            </div> --}}

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item mx-1">
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_entreprise') ? 'active' : '' }}" href="{{route('utilisateur_entreprise')}}">
                                        Entreprises</a>
                                </li>
                                <li class="nav-item mx-1">
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_cfp') ? 'active' : '' }}" href="{{route('utilisateur_cfp')}}">
                                        Organisme de Formation</a>
                                </li>
                                {{-- <li class="nav-item mx-1">
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_admin') ? 'active' : '' }}" href="{{route('utilisateur_admin')}}">
                                        Admin</a>
                                </li> --}}
                                <li class="nav-item mx-1">
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_superAdmin') ? 'active' : '' }}" href="{{route('utilisateur_superAdmin')}}">
                                        Super Admin</a>
                                </li>

                            </ul>


                    </div>
                </div>
            </nav>
            <div class="col-lg-12">
                <br>
                <h4>Administrateurs</h4>
            </div>

        </div>

        {{-- <form action="{{ route('utilisateur_new_admin') }}"> --}}
        @csrf
        {{-- <p style="display: flex; justify-content: flex-end;">
            <button type="button" class="btn btn_enregistrer" data-bs-toggle="modal" data-bs-target="#exampleModals">&nbsp; Nouvel administrateur</button>
        </p> --}}
        <!-- Button trigger modal -->
        <div class="text-end">
            <button type="button" class="btn btn_enregistrer" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Nouvel administrateur
              </button>
        </div>
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <label for=""> CIN</label>
                    <input type="text" class="form-control" required name="cin"><br><br>
                    <label for=""> Mot de passe </label>
                    <input type="password" class="form-control" name="password_new_user"><br><br>
                    <input type="password" class="form-control" value="1" name="role_id" style="display:none"><br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">&nbsp; Retour</button>
                <button type="submit" class="btn btn-primary">&nbsp; Enregistrer</button>
                </form>
            </div>
        </div>
    </div>
  </div>
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
                    @endforeach
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>

    </div>
</div>


@endsection
