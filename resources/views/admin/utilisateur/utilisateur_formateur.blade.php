@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Utilisateur</h3>
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <h3>Utilisateurs/</h3>
            </div>

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
                                <li class="nav-item mx-1">
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_admin') ? 'active' : '' }}" href="{{route('utilisateur_admin')}}">
                                        Admin</a>
                                </li>
                                <li class="nav-item mx-1">
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_superAdmin') ? 'active' : '' }}" href="{{route('utilisateur_superAdmin')}}">
                                        Super Admin</a>
                                </li>
                            </ul>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="col-lg-12">
                <br>
                <h4>Organismes de formations professionnelles / Formateurs</h4>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item mx-1">
                            <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_resp_cfp') ? 'active' : '' }}" href="{{route('utilisateur_resp_cfp')}}">
                                Responsables des OF</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_formateur') ? 'active' : '' }}" href="{{route('utilisateur_formateur')}}">
                                Formateurs</a>
                        </li>
                    </ul>


                </div>
            </div>
        </nav>

        <form action="{{route('nouveau_formateur')}}" method="GET">
            @csrf
            <p style="display: flex; justify-content: flex-end;">
                <button type="submit" class="btn btn_enregistrer">&nbsp; Nouvel formateur</button>
                &nbsp;
            </p>
        </form>

        <!-- /.row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nom d'utilisateur</th>
                                <th>E-mail</th>
                                <th> Téléphone </th>
                                <th>CIN</th>
                                <th>Niveau d'etude</th>

                                <th> Action </th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach($datas as $formateur)
                            <tr>
                                <td style="width: 10%;">
                                    @if ($formateur->photos==null)
                                    <img class="img-fluid rounded-3" alt="Responsive image" src="{{asset('images/users/users.png')}}" width="30%" height="30%" style="cellapading=0;" cellspacing="0"> </a>
                                    @else
                                    <img class="img-fluid rounded-3" alt="Responsive image" src="{{asset('images/formateurs/'.$formateur->photos)}}" width="30%" height="30%" style="cellapading=0;" cellspacing="0"> </a>
                                    @endif
                                </td>
                                <td>{{$formateur->nom_formateur .' '.$formateur->prenom_formateur}}</td>
                                <td>{{$formateur->mail_formateur}}</td>
                                <td>{{$formateur->numero_formateur}}</td>
                                <td>{{$formateur->cin}}</td>
                                <td>{{$formateur->niveau}}</td>
                                <td>

                                    <div class="dropdown">
                                        <div class="btn-group dropstart">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <a class="dropdown-item" href="#"><button type="text" class="btn btn_enregistrer">Afficher</button> </a>
                                                <a href="#" class="dropdown-item"><button class="btn btn_enregistrer my-2 " data-bs-toggle="modal" data-bs-target="#modal_{{$formateur->id}}"> <i class="bx bx-edit"></i> Modifier profile</button></a>
                                                <a class="dropdown-item" href="#"><button class="btn btn_enregistrer my-2 delete_pdp_cfp" data-id="{{ $formateur->id }}" id="{{ $formateur->id }}" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$formateur->id}}" style="color: red">Supprimer</button></a>

                                            </ul>
                                        </div>
                                    </div>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
