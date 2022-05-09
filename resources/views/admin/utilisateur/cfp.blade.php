@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Centre de formation professionnelle</h3>
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
                            <li class="nav-item mx-1">
                                {{-- <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_resp_cfp') ? 'active' : '' }}" href="{{route('utilisateur_resp_cfp')}}"> --}}
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_cfp') ? 'active' : '' }}" href="{{route('utilisateur_cfp')}}">
                                    Organisme de formation</a>
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

            <div class="col-lg-12">
                <br>
                {{-- <h4>Organismes de formations professionnelles</h4> --}}
            </div>

</div>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

              
                {{-- <li class="nav-item mx-1">
                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_formateur') ? 'active' : '' }}" href="{{route('utilisateur_formateur')}}">
                        Formateurs</a>
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
                        <li><a href="{{route('utilisateur_cfp',2)}}">5</a></li>
                        <li><a href="{{route('utilisateur_cfp',10)}}">10</a></li>
                        <li><a href="{{route('utilisateur_cfp',25)}}">25</a></li>
                        <li><a href="{{route('utilisateur_cfp',50)}}">50</a></li>
                        <li><a href="{{route('utilisateur_cfp',100)}}">100</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('utilisateur_cfp')}}">Tout</a></li>
                    </ul>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown">
                    Rechercher par entreprise <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        {{-- @foreach($entreprise as $etp)
                            <li><a href="{{route('utilisateur.show',$etp->id)}}">{{$etp->nom_etp}}</a></li>
                        @endforeach --}}
                        {{-- <li class="divider"></li>
                        <li><a href="{{route('utilisateur_cfp')}}">Tout</a></li>
                    </ul>
                </div>
            </form> --}} 

            {{-- <form action="{{ route('utilisateur_new_cfp') }}">
                @csrf
                <p style="display: flex; justify-content:end;">
                    <button type="submit" class="btn btn_enregistrer mx-1">&nbsp; Nouveau Organisme</button>
        &nbsp;
    </p>
</form> --}}
<div class="container-fluid">
    <table class="table">
        <thead>
            <th> Logo </th>
            <th></th>
            <th></th>
            <th>Organisme de Formation</th>
            <th> Responsables Principales</th>
            <th> E-mail </th>
            <th> Téléphone </th>
           
            <th>Date d'inscription</th>

            <th> Action </th>
        </thead>
        <tbody>
            @foreach ($datas as $resp)
            <tr>
                {{-- <td colspan="3" style="width: 40px;"><a class="dropdown-item" href="{{ route('profil_du_responsable',$resp->id) }}"> <img class="img-fluid rounded-3" alt="Responsive image" src="{{asset('images/CFP/'.$resp->logo)}}" style="width:120px;hei" cellspacing="0"> </a></td> --}}

                <td colspan="3" style="width: 40px;"><a class="dropdown-item" href=""> <img class="img-fluid rounded-3" alt="Responsive image" src="{{asset('images/CFP/'.$resp->cfp->logo)}}" style="width:120px;hei" cellspacing="0"> </a></td>
                <td>{{ $resp->cfp->nom}}</td>
                <td> <a class="dropdown-item" href=""><span>{{ $resp->nom_resp_cfp}}</span><span class="ms-1">{{ $resp->prenom_resp_cfp}}</span>  </a></td>
                <td>{{ $resp->email_resp_cfp}}</td>
                <td>{{ $resp->telephone_resp_cfp}}</td>
              
                <td>{{ $resp->created_at}}</td>
                <td>

                    <div class="dropdown">
                        <div class="btn-group dropstart">
                            <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('affichage_parametre_cfp',$resp->id) }}"><button type="text" class="btn btn_enregistrer">Afficher</button> </a>
                                {{-- <a href="#" class="dropdown-item"><button class="btn btn_enregistrer my-2 edit_pdp_cfp" data-id="{{ $resp->id }}" id="{{ $resp->id }}" data-bs-toggle="modal" data-bs-target="#modal_{{$resp->id}}"> <i class="bx bx-edit"></i> Modifier profile</button></a>
                                <a class="dropdown-item" href="#"><button class="btn btn_enregistrer my-2 delete_pdp_cfp" data-id="{{ $resp->id }}" id="{{ $resp->id }}" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$resp->id}}" style="color: red">Supprimer</button></a> --}}

                            </ul>
                        </div>
                    </div>

                </td>
            </tr>


            {{-- <!-- Modal delete -->
            <div class="modal fade" id="delete_modal_{{$resp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                            <h6 class="modal-title text-white">Avertissement pour <strong>{{$resp->nom}}</strong>!</h6>

                        </div>
                        <div class="modal-body">
                            <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                        </div>
                        <div class="modal-footer">

                            <button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button>

                            <form action="{{ route('utilisateur_cfp_delete',$resp->id) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn_enregistrer"> Suprimer </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin modal delete --}}

            {{-- <div id="modal_{{$resp->id}}" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title text-md">
                                <h6>Modification des informations pour</h6>
                                <h5><strong>{{$resp->nom}}</strong></h5>
                            </div>
                            <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('utilisateur_update_cfp',$resp->id) }}" id="edit_pdp_cfp" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="inputbox inputboxP mt-3">
                                    <span><i class="bx bxs-graduation"></i>&nbsp; Raison sociale<strong style="color:red">*</strong> </span>
                                    <input autocomplete="off" type="text" name="nom_cfp" class="form-control formPayement" required="required" value="{{$resp->nom}}">

                                </div>
                                <div class="inputbox inputboxP mt-3">
                                    <span><i class="bx bxs-graduation"></i>&nbsp; Domaine de formation<strong style="color:red">*</strong> </span>
                                    <textarea autocomplete="off" required class="form-control" id="exampleFormControlTextarea1" rows="3" name="domaine_cfp"></textarea>
                                </div>
                                <div class="inputbox inputboxP mt-3">
                                    <span><i class="bx bx-envelope"></i>&nbsp;NIF<strong style="color:#ff0000;">*</strong></span>
                                    <input autocomplete="off" type="text" name="nif_cfp" class="form-control formPayement" required="required" value="{{$resp->nif}}">
                                </div>
                                <div class="inputbox inputboxP mt-3">
                                    <span><i class="bx bx-envelope"></i>&nbsp;STAT<strong style="color:#ff0000;">*</strong></span>
                                    <input autocomplete="off" type="text" name="stat_cfp" class="form-control formPayement" required="required" value="{{$resp->stat}}">
                                </div>
                                <div class="inputbox inputboxP mt-3">
                                    <span><i class="bx bx-envelope"></i>&nbsp;CIF<strong style="color:#ff0000;">*</strong></span>
                                    <input autocomplete="off" type="text" name="cif_cfp" class="form-control formPayement" required="required" value="{{$resp->cif}}">
                                </div>
                                <div class="inputbox inputboxP mt-3">
                                    <span><i class="bx bx-envelope"></i>&nbsp;RCS<strong style="color:#ff0000;">*</strong></span>
                                    <input autocomplete="off" type="text" name="rcs_cfp" class="form-control formPayement" required="required" value="{{$resp->rcs}}">
                                </div>
                                <div class="inputbox inputboxP mt-3">
                                    <span><i class="bx bx-envelope"></i>&nbsp;Email<strong style="color:#ff0000;">*</strong></span>
                                    <input autocomplete="off" type="email" name="email_cfp" class="form-control formPayement" required="required" value="{{$resp->email}}">
                                </div>

                                <div class="inputbox inputboxP mt-3">
                                    <span><i class="bx bx-phone"></i>&nbsp;Téléphone<strong style="color:#ff0000;">*</strong></span>
                                    <input autocomplete="off" type="text" name="telephone_cfp" class="form-control formPayement" required="required" value="{{$resp->telephone}}"> </div>
                                @if ($resp->site_cfp!=NULL)
                                <div class="inputbox inputboxP mt-3">
                                    <span><i class="fa fa-globe"></i>&nbsp; Site web officiel</span>
                                    <input autocomplete="off" type="text" name="site_web" class="form-control formPayement" required="required" value="{{$resp->site_cfp}}"> </div>

                                @else
                                <div class="inputbox inputboxP mt-3">
                                    <span><i class="fa fa-globe"></i>&nbsp; Ajouter un site web officiel</span>
                                    <input autocomplete="off" type="text" name="site_web" class="form-control formPayement" required="required"> </div>

                                @endif

                                <div class="inputbox inputboxP mt-3">
                                    <span>Lot<strong style="color:#ff0000;">*</strong></span>
                                    <input type="text" name="adresse_lot" class="form-control formPayement" required="required" value="{{$resp->adresse_lot}}">
                                </div>
                                <div class="inputbox inputboxP mt-3">
                                    <span>Quartier<strong style="color:#ff0000;">*</strong></span>
                                    <input type="text" name="adresse_quartier" class="form-control formPayement" required="required" value="{{$resp->adresse_quartier}}">
                                </div>
                                <div class="inputbox inputboxP mt-3">
                                    <span>Ville<strong style="color:#ff0000;">*</strong></span>
                                    <input type="text" name="adresse_ville" class="form-control formPayement" required="required" value="{{$resp->adresse_ville}}">
                                </div>
                                <div class="inputbox inputboxP mt-3">
                                    <span>Région<strong style="color:#ff0000;">*</strong></span>
                                    <input type="text" name="adresse_region" class="form-control formPayement" required="required" value="{{$resp->adresse_region}}">
                                </div>
                                <div class="inputbox inputboxP mt-3" id="numero_facture"></div>
                                <div class="mt-4 mb-4">
                                    <div class="mt-4 mb-4 d-flex justify-content-between">
                                        <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                                        <button type="submit"  class="btn btn_enregistrer">Valider</button> </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div> --}} 
            {{-- fin --}}


            @endforeach
        </tbody>
        <tfoot></tfoot>
    </table>
</div>

</div>
</div>


@endsection
