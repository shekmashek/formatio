@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_entreprise') ? 'active' : '' }}" href="{{route('utilisateur_entreprise')}}">
                                    Entreprises</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_cfp') ? 'active' : '' }}" href="{{route('utilisateur_cfp')}}">
                                    Organisme de Formation</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn_enregistrer  {{ Route::currentRouteNamed('liste_utilisateur') || Route::currentRouteNamed('liste_utilisateur') ? 'active' : '' }}" href="{{route('liste_utilisateur')}}">
                                    Responsables</a>
                            </li>

                            <li class="nav-item">

                                <a class="nav-link btn_enregistrer  {{ Route::currentRouteNamed('utilisateur_stagiaire') ? 'active' : '' }}" aria-current="page" href="{{route('utilisateur_stagiaire')}}">
                                    Stagiaires</a>

                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_formateur') ? 'active' : '' }}" href="{{route('utilisateur_formateur')}}">
                                    Formateurs</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_admin') ? 'active' : '' }}" href="{{route('utilisateur_admin')}}">
                                    Admin</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_superAdmin') ? 'active' : '' }}" href="{{route('utilisateur_superAdmin')}}">
                                    Super Admin</a>
                            </li>


                        </ul>


                    </div>
                </div>
            </nav>

            <div class="col-lg-12">
                <br>
                <h3>Entité / Entreprises professionnelles</h3>
            </div>



            {{-- <form class="navbar-form navbar-left" role="search">
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
    </form> --}}
</div>
<form action="{{ route('utilisateur_new_cfp') }}">
    @csrf
    <p style="display: flex; justify-content: flex-end;">
        <button type="submit" class="btn btn-primary">&nbsp; Nouveau centre de formation</button>
        &nbsp;
    </p>
</form>
<div class="container-fluid">
    <table class="table">
        <thead>
            <th> Logo </th>
            <th> Nom </th>
            <th> E-mail </th>
            <th> Téléphone </th>
            <th>Site web</th>
            <th> Action </th>
        </thead>
        <tbody>

            <tr>
                <td>
                    <img src="{{asset('images/entreprises/COLAS.png')}}" width="80" height="50">

                <td><strong>COLAS</strong></td>
                <td>colas@gmail.com</td>
                <td>032 22 333 11</td>
                <td>colas.com</td>
                <td>

                    <div class="dropdown">
                        <div class="btn-group dropstart">
                            <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('profil_cfp',1) }}"><button type="text" class="btn btn_enregistrer">Afficher</button> </a>
                                <a class="dropdown-item" href="#Modal_{{ 1 }}" data-toggle="modal"><button type="text" class="btn btn_enregistrer">Modifier</button> </a>
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal_{{1}}"> Supprimer</a>
                            </ul>
                        </div>
                    </div>
                </td>
            </tr>

            {{-- @foreach ($cfps as $cfp)
            <tr>
                <td><img class="img-fluid rounded-3" alt="Responsive image" src="{{asset('images/entreprises/'.$cfp->logo)}}" style="cellapading=0;" cellspacing="0"> </td>
                <td><strong>{{ $cfp->nom }}</strong></td>
                <td>{{ $cfp->email }}</td>
                <td>{{ $cfp->telephone }}</td>
                <td>{{ $cfp->site_cfp }}</td>
                <td>

                    <div class="dropdown">
                        <div class="btn-group dropstart">
                            <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('profil_cfp',$cfp->id) }}"><button type="text" class="btn btn_enregistrer">Afficher</button> </a>
                                <a class="dropdown-item" href="#Modal_{{ $cfp->id }}" data-toggle="modal"><button type="text" class="btn btn_enregistrer">Modifier</button> </a>
                                <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal_{{$cfp->id}}"> Supprimer</a>
                            </ul>
                        </div>
                    </div>


                </td>
            </tr> --}}


            <!-- Modal delete -->
            {{-- <div class="modal fade" id="exampleModal_{{$cfp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="{{ route('utilisateur_cfp_delete',$cfp->id) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-secondary"> Oui </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}
            {{-- fin modal delete --}}

            <!-- Modal -->
            {{-- <div class="modal fade bd-modal-lg" id="Modal_{{ $cfp->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-header d-flex flex-row justify-content-between" style="background-color:rgb(96,167,134);">
                        <div style="width: 100px; height:100px;">
                            <img class="img-fluid rounded-3" alt="Responsive image" src="{{ asset('images/CFP/'.$cfp->logo) }}" style="cellapading=0;" cellspacing="0">
                        </div>
                        <div>
                            <h6 class="modal-title text-white"> Modification </h6>
                        </div>
                    </div>
                    <div class="modal-content">
                        <div class="modal-body">
                            <form action="{{ route('utilisateur_update_cfp',$cfp->id) }}" method="POST">
                                @csrf
                                <div class="d-flex justify-content-lg-evenly">
                                    <div>
                                        <label for=""> <b>Nom</b> </label><br><br>
                                        <input type="text" class="form-control" name="nom_cfp" value="{{ $cfp->nom }}"><br>
                                    </div>
                                    <div>
                                        <label for=""> <b>Site web officiel</b> </label><br><br>
                                        <input type="text" class="form-control" name="site_web" value="{{ $cfp->site_cfp }}"><br>
                                    </div>
                                </div>
                                <hr>
                                <center><label> <b> Adresse </b></label></center>
                                <hr>
                                <div class="d-flex justify-content-evenly">
                                    <div>
                                        <label for=""> <b>Lot</b> </label><br><br>
                                        <input type="text" class="form-control" name="adresse_lot" value="{{ $cfp->adresse_lot }}"><br>
                                    </div>
                                    <div>
                                        <label for=""> <b>Ville</b> </label><br><br>
                                        <input type="text" class="form-control" name="adresse_ville" value="{{ $cfp->adresse_ville }}"><br>
                                    </div>
                                    <div>
                                        <label for=""> <b>Region</b> </label><br><br>
                                        <input type="text" class="form-control" name="adresse_region" value="{{ $cfp->adresse_region }}"><br>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-evenly">
                                    <div>
                                        <label for=""> <b>Email</b> </label><br><br>
                                        <input type="text" class="form-control" name="email_cfp" value="{{ $cfp->email }}"><br>
                                    </div>
                                    <div>
                                        <label for=""> <b>Telephone</b> </label><br><br>
                                        <input type="text" class="form-control" name="telephone_cfp" value="{{ $cfp->telephone }}"><br>
                                    </div>
                                    <div>
                                        <label for=""> <b>Domaine de formation</b> </label><br><br>
                                        <input type="text" class="form-control" name="domaine_cfp" value="{{ $cfp->domaine_de_formation }}"><br>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-evenly">
                                    <div class="mx-2">
                                        <label for=""> <b>NIF</b> </label><br><br>
                                        <input type="text" class="form-control" name="nif_cfp" value="{{ $cfp->nif }}"><br>
                                    </div>
                                    <div class="mx-2">
                                        <label for=""> <b>STAT</b> </label><br><br>
                                        <input type="text" class="form-control" name="stat_cfp" value="{{ $cfp->stat }}"><br>
                                    </div>
                                    <div class="mx-2">
                                        <label for=""> <b>RCS</b> </label><br><br>
                                        <input type="text" class="form-control" name="rcs_cfp" value="{{ $cfp->rcs }}"><br>
                                    </div>
                                    <div class="mx-2">
                                        <label for=""> <b>CIF</b> </label><br><br>
                                        <input type="text" class="form-control" name="cif_cfp" value="{{ $cfp->cif }}"><br>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> Fermer </button>

                            <button type="submit" class="btn btn-success"> Enregistrer </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- @endforeach --}}
        </tbody>
        <tfoot></tfoot>
    </table>
</div>

</div>
</div>


@endsection
