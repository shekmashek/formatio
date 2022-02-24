@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Manager</h3>
@endsection
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading d-flex justify-content-between mb-5">
                    <div>
                        <li class="{{ Route::currentRouteNamed('employes') ? 'active' : '' }}" style="list-style: none"><a href="{{route('employes')}}"><span class="bx bx-list-ul"></span>Liste des employés</a></li>&nbsp;
                    </div>
                    <div>
                        <button style = "color: rgb(102, 15, 241)"><a href="{{route('departement.create')}}"><span class="bx bxs-plus-circle"></span> Nouveau Employé</a></button>
                    </div>
                </div>
                <div class="col-md-12 mt-5">
                    <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list">
                        <li class="nav-item">
                            <a href="#" style="color: rgb(102, 15, 241)" class=" active" id="referent" data-toggle="tab" data-target="#tab-referent" type="button" role="tab" aria-controls="tab-referent" aria-selected="true">
                                Référents
                            </a>
                        </li>
                        <li class="nav-item ms-5">
                            <a href="#"  style="color: rgb(102, 15, 241)" class="" id="employé" data-toggle="tab" data-target="#tab-employé" type="button" role="tab" aria-controls="tab-employé" aria-selected="false">
                                Employés
                            </a>
                        </li>
                        <li class="nav-item ms-5">
                            <a href="#"  style="color: rgb(102, 15, 241)" class="" id="manager" data-toggle="tab" data-target="#tab-manager" type="button" role="tab" aria-controls="tab-manager" aria-selected="false">
                                Chef de département
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="myTabContent">
                    {{-- referent --}}
                    <div class="tab-pane fade show active" id="tab-referent" role="tabpanel" aria-labelledby="referent">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Genre</th>
                                            <th>Fonction</th>
                                            <th>E-mail</th>
                                            <th>Téléphone</th>
                                            <th>Accès</th>
                                            <th>Attribuer d'autre role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($i = 0; $i < count($referent); $i++)
                                        <tr>
                                            <td>
                                                @if($referent[$i]->photos == null)
                                                <img src="{{asset('images/users/users.png')}}"  width="50" height="50" class="image-ronde">
                                                @else
                                                <img src="/responsable-image/{{$referent[$i]->photos}}" width="50" height="50"></td>
                                                @endif
                                            <td>{{$referent[$i]->nom_resp}}</td>
                                            <td>{{$referent[$i]->prenom_resp}}</td>
                                            <td>{{$referent[$i]->sexe_resp}}</td>
                                            <td>{{$referent[$i]->fonction_resp}}</td>
                                            <td>{{$referent[$i]->email_resp}}</td>
                                            <td>{{$referent[$i]->telephone_resp}}</td>
                                            <td>
                                                <ul>
                                                    @for($j = 0; $j < count($user_role); $j++)
                                                        @if($referent[$i]->user_id == $user_role[$j]->user_id)
                                                            <li>{{$user_role[$j]->role_description}}</li>
                                                            @endif
                                                    @endfor
                                                </ul>
                                                {{-- <center>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <li style="font-size:15px;"> <a href="{{route('affProfilChefDepartement', $referent[$i]->id)}}" class="afficher" title="Afficher le profil" id="{{$referent[$i]->id}}"><i style="font-size:18px;" class="fa fa-eye"></i>&nbsp; Afficher </a>
                                                                @canany(['isCFP','isAdmin','isSuperAdmin'])
                                                            <li type="button" style="font-size:15px;"> <a href="#myModal_{{ $referent[$i]->id }}" class="modifier" title="Modifier le profil" id="" data-toggle="modal"><i style="font-size:18px;" class="fa fa-edit"></i> &nbsp;Modifier</a> </li>
                                                            <li style="font-size:15px;"><a href="" data-toggle="modal" data-target="#exampleModal_{{$referent[$i]->id}}"><i style="font-size:18px;" class="fa fa-trash"></i> &nbsp;Supprimer</a> </li>
                                                            @endcanany
                                                        </div>
                                                    </div>
                                                </center> --}}
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        <ul>
                                                            @for($j = 0; $j < count($user_role); $j++)
                                                                @for($k = 0; $k < count($roles); $k++)
                                                                    @if($referent[$i]->user_id == $user_role[$j]->user_id)
                                                                        @if($user_role[$j]->role_id != $roles[$k]->id)
                                                                            <li>{{$roles[$k]->role_description}}</li>
                                                                        @endif
                                                                    @endif
                                                                @endfor
                                                            @endfor
                                                        </ul>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>


                                        <!-- Modal delete -->
                                        <div class="modal fade" id="exampleModal_{{$referent[$i]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">
                                                            <font color="white">Avertissement !</font>
                                                        </h6>

                                                    </div>
                                                    <div class="modal-body">
                                                        <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                        <form action="{{ route('destroy_chefDepartement') }}" method="GET">
                                                            @csrf
                                                            <button type="submit" class="btn btn-secondary"> Oui </button>
                                                            <input type="text" name="id_get" value="{{ $referent[$i]->id }}" hidden>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="modal fade" id="myModal_{{ $referent[$i]->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                                        <h6 class="modal-title text-white"> Modification </h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('modifDepartement', $referent[$i]->id)}}" method="get" class="btn-submit">
                                                            @csrf
                                                            {{-- --}}
                                                            <input type="hidden" name="_method" value="PUT">
                                                            {{-- --}}
                                                            <div class="form-group">
                                                                <label for="name"><small><b>Nom</b></small></label><br>
                                                                <input type="text" class="form-control" value="{{$referent[$i]->nom_resp}}" autocomplete="off" id="" name="nom_chef" placeholder="Nom">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="prenom"><small><b>Prénom</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" value="{{$referent[$i]->prenom_resp}}" id="" name="prenom_chef" placeholder="Prénom">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="prenom"><small><b>Genre</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" value="{{$referent[$i]->sexe_resp}}" id="" name="genre_chef" placeholder="Genre">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fonction"><small><b>Fonction</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" id="" value="{{$referent[$i]->fonction_resp}}" name="fonction_chef" placeholder="Fonction">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email"><small><b>E-mail</b></small></label><br>
                                                                <input type="email" class="form-control" autocomplete="off" id="" value="{{$referent[$i]->email_resp}}" name="mail_chef" placeholder="E-mail">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone"><small><b>Téléphone</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" id="" value="{{$referent[$i]->telephone_resp}}" name="telephone_chef" placeholder="Téléphone">
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>&nbsp;
                                                        <button type="submit" class="btn btn-success modification " id=""><span class="fa fa-pencil"></span> Modifier</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- employé --}}
                    <div class="tab-pane fade show" id="tab-employé" role="tabpanel" aria-labelledby="employé">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Genre</th>
                                            <th>Fonction</th>
                                            <th>E-mail</th>
                                            <th>Téléphone</th>
                                            <th>Accès</th>
                                            <th>Attribuer d'autre role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @for($i = 0; $i < count($stagiaires); $i++)
                                        <tr>
                                            <td>
                                                @if($stagiaires[$i]->photos == null)
                                                    <img src="{{asset('images/users/users.png')}}"  width="50" height="50" class="image-ronde">
                                                @else
                                                    <img src="/stagiaire-image/{{$stagiaires[$i]->photos}}" width="50" height="50"></td>
                                                @endif
                                            </td>
                                            <td>{{$stagiaires[$i]->nom_stagiaire}}</td>
                                            <td>{{$stagiaires[$i]->prenom_stagiaire}}</td>
                                           <td>{{$stagiaires[$i]->genre_stagiaire}}</td>

                                            <td>{{$stagiaires[$i]->fonction_stagiaire}}</td>
                                            <td>{{$stagiaires[$i]->mail_stagiaire}}</td>
                                            <td>{{$stagiaires[$i]->telephone_stagiaire}}</td>
                                            <td>
                                                <ul>
                                                    @for($j = 0; $j < count($user_role); $j++)
                                                        @if($stagiaires[$i]->user_id == $user_role[$j]->user_id)
                                                            <li>{{$user_role[$j]->role_description}}</li>
                                                            @endif
                                                    @endfor
                                                </ul>
                                                {{-- <center>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <li style="font-size:15px;"> <a href="{{route('affProfilChefDepartement', $stagiaires[$i]->id)}}" class="afficher" title="Afficher le profil" id="{{$stagiaires[$i]->id}}"><i style="font-size:18px;" class="fa fa-eye"></i>&nbsp; Afficher </a>
                                                                @canany(['isCFP','isAdmin','isSuperAdmin'])
                                                            <li type="button" style="font-size:15px;"> <a href="#myModal_{{ $stagiaires[$i]->id }}" class="modifier" title="Modifier le profil" id="" data-toggle="modal"><i style="font-size:18px;" class="fa fa-edit"></i> &nbsp;Modifier</a> </li>
                                                            <li style="font-size:15px;"><a href="" data-toggle="modal" data-target="#exampleModal_{{$stagiaires[$i]->id}}"><i style="font-size:18px;" class="fa fa-trash"></i> &nbsp;Supprimer</a> </li>
                                                            @endcanany
                                                        </div>
                                                    </div>
                                                </center> --}}
                                            </td>
                                            <td>
                                                <ul>
                                                    @for($j = 0; $j < count($user_role); $j++)
                                                        @for($k = 0; $k < count($roles); $k++)
                                                            @if($stagiaires[$i]->user_id == $user_role[$j]->user_id)
                                                                @if($user_role[$j]->role_id != $roles[$k]->id)
                                                                    <li>{{$roles[$k]->role_description}}</li>
                                                                @endif
                                                            @endif
                                                        @endfor
                                                    @endfor
                                                </ul>
                                            </td>
                                        </tr>


                                        <!-- Modal delete -->
                                        <div class="modal fade" id="exampleModal_{{$stagiaires[$i]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">
                                                            <font color="white">Avertissement !</font>
                                                        </h6>

                                                    </div>
                                                    <div class="modal-body">
                                                        <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                        <form action="{{ route('destroy_chefDepartement') }}" method="GET">
                                                            @csrf
                                                            <button type="submit" class="btn btn-secondary"> Oui </button>
                                                            <input type="text" name="id_get" value="{{ $stagiaires[$i]->id }}" hidden>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="modal fade" id="myModal_{{ $stagiaires[$i]->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                                        <h6 class="modal-title text-white"> Modification </h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('modifDepartement', $stagiaires[$i]->id)}}" method="get" class="btn-submit">
                                                            @csrf
                                                            {{-- --}}
                                                            <input type="hidden" name="_method" value="PUT">
                                                            {{-- --}}
                                                            <div class="form-group">
                                                                <label for="name"><small><b>Nom</b></small></label><br>
                                                                <input type="text" class="form-control" value="{{$stagiaires[$i]->nom_stagiaire}}" autocomplete="off" id="" name="nom_chef" placeholder="Nom">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="prenom"><small><b>Prénom</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" value="{{$stagiaires[$i]->prenom_stagiaire}}" id="" name="prenom_chef" placeholder="Prénom">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="prenom"><small><b>Genre</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" value="{{$stagiaires[$i]->genre_stagiaire}}" id="" name="genre_chef" placeholder="Genre">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fonction"><small><b>Fonction</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" id="" value="{{$stagiaires[$i]->fonction_stagiaire}}" name="fonction_chef" placeholder="Fonction">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email"><small><b>E-mail</b></small></label><br>
                                                                <input type="email" class="form-control" autocomplete="off" id="" value="{{$stagiaires[$i]->mail_stagiaire}}" name="mail_chef" placeholder="E-mail">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone"><small><b>Téléphone</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" id="" value="{{$stagiaires[$i]->telephone_stagiaire}}" name="telephone_chef" placeholder="Téléphone">
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>&nbsp;
                                                        <button type="submit" class="btn btn-success modification " id=""><span class="fa fa-pencil"></span> Modifier</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- chef de département --}}

                    <div class="tab-pane fade show" id="tab-manager" role="tabpanel" aria-labelledby="manager">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Nom</th>
                                            <th>Prénom</th>
                                            <th>Genre</th>
                                            <th>Fonction</th>
                                            <th>E-mail</th>
                                            <th>Téléphone</th>
                                            <th>Accès</th>
                                            <th>Attribuer d'autre role</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($chef as $chefs)
                                        <tr>
                                            <td>
                                                @if($chefs->photos == null)
                                                <img src="{{asset('images/users/users.png')}}"  width="50" height="50" class="image-ronde">
                                                @else
                                                <img src="/stagiaire-image/{{$chefs->photos}}" width="50" height="50"></td>
                                                @endif
                                            </td>
                                            <td>{{$chefs->nom_chef}}</td>
                                            <td>{{$chefs->prenom_chef}}</td>
                                           <td>{{$chefs->genre_chef }}</td>

                                            <td>{{$chefs->fonction_chef}}</td>
                                            <td>{{$chefs->mail_chef}}</td>
                                            <td>{{$chefs->telephone_chef}}</td>
                                            <td>
                                                <ul>
                                                    @for($j = 0; $j < count($user_role); $j++)
                                                        @if($chefs->user_id == $user_role[$j]->user_id)
                                                            <li>{{$user_role[$j]->role_description}}</li>
                                                            @endif
                                                    @endfor
                                                </ul>
                                                {{-- <center>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <li style="font-size:15px;"> <a href="{{route('affProfilChefDepartement', $chefs)}}" class="afficher" title="Afficher le profil" id="{{$chefs->id}}"><i style="font-size:18px;" class="fa fa-eye"></i>&nbsp; Afficher </a>
                                                                @canany(['isCFP','isAdmin','isSuperAdmin'])
                                                            <li type="button" style="font-size:15px;"> <a href="#myModal_{{ $chefs->id }}" class="modifier" title="Modifier le profil" id="" data-toggle="modal"><i style="font-size:18px;" class="fa fa-edit"></i> &nbsp;Modifier</a> </li>
                                                            <li style="font-size:15px;"><a href="" data-toggle="modal" data-target="#exampleModal_{{$chefs->id}}"><i style="font-size:18px;" class="fa fa-trash"></i> &nbsp;Supprimer</a> </li>
                                                            @endcanany
                                                        </div>
                                                    </div>
                                                </center> --}}
                                            </td>
                                        </tr>


                                        <!-- Modal delete -->
                                        <div class="modal fade" id="exampleModal_{{$chefs->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">
                                                            <font color="white">Avertissement !</font>
                                                        </h6>

                                                    </div>
                                                    <div class="modal-body">
                                                        <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                        <form action="{{ route('destroy_chefDepartement') }}" method="GET">
                                                            @csrf
                                                            <button type="submit" class="btn btn-secondary"> Oui </button>
                                                            <input type="text" name="id_get" value="{{ $chefs->id }}" hidden>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="modal fade" id="myModal_{{ $chefs->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                                        <h6 class="modal-title text-white"> Modification </h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('modifDepartement', $chefs->id)}}" method="get" class="btn-submit">
                                                            @csrf
                                                            {{-- --}}
                                                            <input type="hidden" name="_method" value="PUT">
                                                            {{-- --}}
                                                            <div class="form-group">
                                                                <label for="name"><small><b>Nom</b></small></label><br>
                                                                <input type="text" class="form-control" value="{{$chefs->nom_chef}}" autocomplete="off" id="" name="nom_chef" placeholder="Nom">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="prenom"><small><b>Prénom</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" value="{{$chefs->prenom_chef}}" id="" name="prenom_chef" placeholder="Prénom">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="prenom"><small><b>Genre</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" value="{{$chefs->genre_chef}}" id="" name="genre_chef" placeholder="Genre">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fonction"><small><b>Fonction</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" id="" value="{{$chefs->fonction_chef}}" name="fonction_chef" placeholder="Fonction">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email"><small><b>E-mail</b></small></label><br>
                                                                <input type="email" class="form-control" autocomplete="off" id="" value="{{$chefs->mail_chef}}" name="mail_chef" placeholder="E-mail">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone"><small><b>Téléphone</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" id="" value="{{$chefs->telephone_chef}}" name="telephone_chef" placeholder="Téléphone">
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>&nbsp;
                                                        <button type="submit" class="btn btn-success modification " id=""><span class="fa fa-pencil"></span> Modifier</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- service --}}
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-5">

                                    <div class="shadow p-3 mb-5 bg-body rounded ">

                                        <h4>Services</h4>

                                        <div class="table-responsive text-center">

                                            <table class="table  table-borderless table-sm">
                                                <tbody id="data_collaboration">

                                                    <tr>
                                                        <td>
                                                            <div align="left">
                                                                @if(isset($service_departement))
                                                                    @for($i = 0; $i < $nb_serv; $i++)
                                                                        <h6><strong>{{$service_departement[$i]->nom_departement}}</strong></h6>

                                                                <div class="row">
                                                                    <div class="col-md-1"></div>
                                                                    <div class="col-md-9">
                                                                        <p>{{$service_departement[$i]->nom_service}}</p>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                            <div align="rigth">
                                                                                <p style="color: rgb(66, 55, 221)"><i class="bx bx-check"></i></p>
                                                                            </div>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <div class="btn-group dropleft">
                                                                            <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                <i class="fa fa-ellipsis-v"></i>
                                                                            </button>
                                                                            <div class="dropdown-menu">
                                                                                <a class="dropdown-item" href="#"><i class="fa fa-eye"></i> &nbsp; modifier</a>
                                                                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal_#"><i class="fa fa-trash"></i> <strong style="color: red">rétirer définitvement</strong></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endfor
                                                                @endif
                                                            </div>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                    </tr>
                                                    <div class="modal fade" id="exampleModal_#" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                                    <h6 class="modal-title text-white">Avertissement !</h6>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                                    <form action="#" method="post">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-secondary"> Oui </button>
                                                                        <input name="cfp_id" type="text" value="test" hidden>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-7">
                                    <div class="shadow p-3 mb-5 bg-body rounded ">

                                        <h4>Ajout de service</h4>
                                        <form name="formInsert" id="formInsert" action="{{route('enregistrement_service')}}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();" class="form_colab">
                                            @csrf
                                            <div class="form-row d-flex">
                                                <div class="col mb-2">
                                                    <select class="form-select mt-2" id="inlineFormInput" aria-label="Default select example" name = "departement_id[]">
                                                        <option selected>Choisissez le département </option>
                                                        @if(isset($rqt))
                                                            @for($i = 0; $i < $nb; $i++)
                                                                <option value= "{{$rqt[$i]->id}}">{{$rqt[$i]->nom_departement}}</option>
                                                            @endfor
                                                        @endif
                                                    </select>
                                                </div>

                                                <div class="col">
                                                    <input type="text" class="form-control mb-2" id="inlineFormInput" name="service[]" placeholder="Nom de service" required />
                                                </div>
                                                <div class="col ms-2">
                                                    <button type="button" class="btn btn-success mt-2" id="addRow2"><i class='bx bxs-plus-circle'></i></button>
                                                </div>

                                            </div>
                                            <div id="add_column2"></div>

                                            <button type="submit" class="btn btn-primary mt-2">Sauvegarder</button>

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
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".supprimer").on('click', function(e) {
        var id = e.target.id;
        // alert(JSON.stringify(id));
        $.ajax({
            type: "GET"
            , url: "{{route('destroy_chefDepartement')}}"
            , data: {
                Id: id
            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error")
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

</script>
@endsection
