@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Entreprises professionnelles</h3>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

            {{-- <h3>Utilisateurs /</h3> --}}
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item mx-1">
                                {{-- <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_entreprise') ? 'active' : '' }}" href="{{route('utilisateur_entreprise')}}"> --}}
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('liste_utilisateur') ? 'active' : '' }}" href="{{route('liste_utilisateur')}}">

                                    Entreprises</a>
                            </li>
                            {{-- <li class="nav-item mx-1">
                                <a class="nav-link btn_enregistrer  {{ Route::currentRouteNamed('liste_utilisateur') || Route::currentRouteNamed('liste_utilisateur') ? 'active' : '' }}" href="{{route('liste_utilisateur')}}">
                                    Responsables  Entreprises</a>
                            </li> --}}
                            <li class="nav-item mx-1">
                                <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_cfp') ? 'active' : '' }}" href="{{route('utilisateur_cfp')}}">
                                    Organisme de Formation</a>
                            </li>
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
            {{-- <form class="navbar-form navbar-left" role="search">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown">
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
                    <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown">
                    Rechercher par entreprise <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        @foreach($entreprises as $etp)
                            <li><a href="{{route('utilisateur.show',$etp->id)}}">{{$etp->nom_etp}}</a></li>
                        @endforeach
                        <li class="divider"></li>
                        <li><a href="{{route('liste_utilisateur')}}">Tout</a></li>
                    </ul>
                </div>
            </form> --}}

            <div class="col-lg-12">
                <br>
                {{-- <h4>Entreprises professionnelles</h4> --}}
            </div>

        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">


                        {{-- <li class="nav-item mx-1">
                            <a class="nav-link btn_enregistrer  {{ Route::currentRouteNamed('utilisateur_stagiaire') ? 'active' : '' }}" aria-current="page" href="{{route('utilisateur_stagiaire')}}">
                                Stagiaires</a>
                        </li> --}}
                    </ul>


                </div>
            </div>
        </nav>


        {{-- <form action="{{ route('utilisateur_new_etp') }}">
            @csrf
            <p style="display: flex; justify-content:end;">
                <button type="submit" class="btn btn_enregistrer mx-1">&nbsp; Nouveau Entreprise</button>
                &nbsp;
            </p>
        </form> --}}

        <div class="container-fluid">
            <table class="table">
                <thead>
                    <th> Logo </th>
                    <th> Entreprises</th>
                    <th> Responsables </th>

                    <th> E-mail </th>
                    <th> Téléphone </th>
                    <th> Date d'inscription </th>
                    {{-- <th>Site web</th> --}}
                    <th> Action </th>
                </thead>
                <tbody>

                    {{-- <tr>
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
                    </tr> --}}


                    @foreach ($datas as $data)


                    <tr>
                        <td>
                            <img width="80" height="50" class="img-fluid rounded-3" alt="Responsive image" src="{{asset('images/entreprises/'.$data->entreprise->logo)}}" style="cellapading=0;" cellspacing="0">
                        </td>
                        <td><span>{{ $data->entreprise->nom_etp }}</span></td>
                        <td><span>{{ $data->nom_resp}}</span><span class="ms-1">{{ $data->prenom_resp}}(<strong style="color: green" >principale</strong>)</span></td>

                        <td>{{ $data->email_resp}}</td>
                        <td>{{ $data->telephone_resp}}</td>
                        <td>{{ $data->created_at}}</td>

                        {{-- <td>{{ $etp->site_etp }}</td> --}}
                        <td>

                            <div class="dropdown">
                                <div class="btn-group dropstart">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('aff_parametre_referent',$data->id)}}"><button type="text" class="btn btn_enregistrer">Afficher</button> </a>
                                        {{-- <a class="dropdown-item"><button class="btn btn_enregistrer my-2 edit_pdp_cfp" data-id="{{ $etp->id }}" id="{{ $etp->id }}" data-bs-toggle="modal" data-bs-target="#modal_{{$etp->id}}"> <i class="bx bxs-edit-alt"></i> Modifier profile</button></a>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$etp->id}}"> <button class="btn btn_enregistrer">Supprimer</button></a> --}}
                                    </ul>
                                </div>
                            </div>

                        </td>
                    </tr>


                    <!-- Modal delete -->
                    <div class="modal fade" id="delete_modal_{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                    <h6 class="modal-title text-white">Avertissement pour <strong>{{$data->nom_etp}}</strong>!</h6>

                                </div>
                                <div class="modal-body">
                                    <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                </div>
                                <div class="modal-footer">

                                    <button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button>

                                    <form action="{{ route('utilisateur_entreprise_delete',$data->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="btn btn_enregistrer"> Suprimer </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- fin modal delete --}}

                    <!-- Modal -->
                    <div id="modal_{{$data->id}}" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="modal-title text-md">
                                        <h6>Modification des informations pour</h6>
                                        <h5><strong>{{$data->nom_etp}}</strong></h5>
                                    </div>
                                    <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('utilisateur_update_etp',$data->id) }}" id="edit_pdp_etp" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="inputbox inputboxP mt-3">
                                            <span><i class="bx bxs-graduation"></i>&nbsp; Raison sociale<strong style="color:red">*</strong> </span>
                                            <input autocomplete="off" type="text" name="nom_etp" class="form-control formPayement" required="required" value="{{$data->nom_etp}}">

                                        </div>
                                        <div class="inputbox inputboxP mt-3">
                                            <span><i class="bx bx-envelope"></i>&nbsp;NIF<strong style="color:#ff0000;">*</strong></span>
                                            <input autocomplete="off" type="text" name="nif_etp" class="form-control formPayement" required="required" value="{{$data->nif}}">
                                        </div>
                                        <div class="inputbox inputboxP mt-3">
                                            <span><i class="bx bx-envelope"></i>&nbsp;STAT<strong style="color:#ff0000;">*</strong></span>
                                            <input autocomplete="off" type="text" name="stat_etp" class="form-control formPayement" required="required" value="{{$data->stat}}">
                                        </div>
                                        <div class="inputbox inputboxP mt-3">
                                            <span><i class="bx bx-envelope"></i>&nbsp;CIF<strong style="color:#ff0000;">*</strong></span>
                                            <input autocomplete="off" type="text" name="cif_etp" class="form-control formPayement" required="required" value="{{$data->cif}}">
                                        </div>
                                        <div class="inputbox inputboxP mt-3">
                                            <span><i class="bx bx-envelope"></i>&nbsp;RCS<strong style="color:#ff0000;">*</strong></span>
                                            <input autocomplete="off" type="text" name="rcs_etp" class="form-control formPayement" required="required" value="{{$data->rcs}}">
                                        </div>
                                        <div class="inputbox inputboxP mt-3">
                                            <span><i class="bx bx-envelope"></i>&nbsp;Email<strong style="color:#ff0000;">*</strong></span>
                                            <input autocomplete="off" type="email" name="email_etp" class="form-control formPayement" required="required" value="{{$data->email_etp}}">
                                        </div>

                                        <div class="inputbox inputboxP mt-3">
                                            <span><i class="bx bx-phone"></i>&nbsp;Téléphone<strong style="color:#ff0000;">*</strong></span>
                                            <input autocomplete="off" type="text" name="telephone_etp" class="form-control formPayement" required="required" value="{{$data->telephone_etp}}"> </div>
                                        @if ($data->site_etp!=NULL)
                                        <div class="inputbox inputboxP mt-3">
                                            <span><i class="fa fa-globe"></i>&nbsp; Site web officiel</span>
                                            <input autocomplete="off" type="text" name="site_web" class="form-control formPayement" required="required" value="{{$data->site_etp}}"> </div>

                                        @else
                                        <div class="inputbox inputboxP mt-3">
                                            <span><i class="fa fa-globe"></i>&nbsp; Ajouter un site web officiel</span>
                                            <input autocomplete="off" type="text" name="site_web" class="form-control formPayement" required="required"> </div>

                                        @endif

                                        <div class="inputbox inputboxP mt-3">
                                            <span>Rue<strong style="color:#ff0000;">*</strong></span>
                                            <input type="text" name="adresse_lot" class="form-control formPayement" required="required" value="{{$data->adresse_rue}}">
                                        </div>
                                        <div class="inputbox inputboxP mt-3">
                                            <span>Quartier<strong style="color:#ff0000;">*</strong></span>
                                            <input type="text" name="adresse_quartier" class="form-control formPayement" required="required" value="{{$data->adresse_quartier}}">
                                        </div>
                                        <div class="inputbox inputboxP mt-3">
                                            <span>Ville<strong style="color:#ff0000;">*</strong></span>
                                            <input type="text" name="adresse_ville" class="form-control formPayement" required="required" value="{{$data->adresse_ville}}">
                                        </div>
                                        <div class="inputbox inputboxP mt-3">
                                            <span>Région<strong style="color:#ff0000;">*</strong></span>
                                            <input type="text" name="adresse_region" class="form-control formPayement" required="required" value="{{$data->adresse_region}}">
                                        </div>
                                        <div class="inputbox inputboxP mt-3" id="numero_facture"></div>
                                        <div class="mt-4 mb-4">
                                            <div class="mt-4 mb-4 d-flex justify-content-between">
                                                <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                                                <button type="submit" class="btn btn_enregistrer">Valider </button> </div>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- fin --}}

                    @endforeach
                </tbody>
                <tfoot></tfoot>
            </table>
        </div>

    </div>
</div>
@endsection
