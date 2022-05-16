@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Super Administrateurs</h3>
@endsection
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                {{-- <br>
                <h3>Utilisateurs / </h3> --}}
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item mx-1">
                                    {{-- <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_entreprise') ? 'active' : '' }}" href="{{route('utilisateur_entreprise')}}">
                                        Entreprises</a>
                                </li>
                                <li class="nav-item mx-1">
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_cfp') ? 'active' : '' }}" href="{{route('utilisateur_cfp')}}">
                                        Organisme de Formation</a>
                                </li> --}}
                                {{-- <li class="nav-item mx-1">
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_admin') ? 'active' : '' }}" href="{{route('utilisateur_admin')}}">
                                        Admin</a>
                                </li> --}}
                                {{-- <li class="nav-item mx-1">
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_superAdmin') ? 'active' : '' }}" href="{{route('utilisateur_superAdmin')}}">
                                        Super Admin</a>
                                </li> --}}

                            </ul>


                    </div>
                </div>
            </nav>
            <div class="col-lg-12">
                <br>
                {{-- <h4>Super Administrateurs</h4> --}}
            </div>
        </div>
        <div class="container-fluid">
            <table class="table">
                <thead>
                    <th> ID </th>
                    <th> Nom </th>
                    <th> Email </th>
                </thead>
                <tbody>
                    @foreach ($supers as $super)
                    <tr>
                        <td>{{ $super->user_id }}</td>
                        <td>{{ $super->name }}</td>
                        <td>{{ $super->email }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>

    </div>
</div>


@endsection
