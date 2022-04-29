@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <h3>Utilisateurs / </h3>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                {{-- <li class="nav-item mx-1">
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_entreprise') ? 'active' : '' }}" href="{{route('utilisateur_entreprise')}}">
                                        Entreprises</a>
                                </li> --}}
                                
                                <li class="nav-item mx-1">
                                    <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('liste_entreprise') ? 'active' : '' }}" href="{{route('liste_entreprise')}}">
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


                    </div>
                </div>
            </nav>

            <div class="col-lg-12">
                <br>
                <h4>Entreprises professionnelles / Responsables des ETP</h4>
            </div>

        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        {{-- <li class="nav-item mx-1">
                            <a class="nav-link btn_enregistrer  {{ Route::currentRouteNamed('liste_utilisateur') || Route::currentRouteNamed('liste_utilisateur') ? 'active' : '' }}" href="{{route('liste_utilisateur')}}">
                                Responsables des ETP</a>
                        </li> --}}
                        {{-- <li class="nav-item mx-1">
                            <a class="nav-link btn_enregistrer  {{ Route::currentRouteNamed('utilisateur_stagiaire') ? 'active' : '' }}" aria-current="page" href="{{route('utilisateur_stagiaire')}}">
                                Stagiaires</a>
                        </li> --}}
                    </ul>


                </div>
            </div>
        </nav>


        {{-- <form action="{{ route('utilisateur_new_resp_etp') }}">
            @csrf
            <p style="display: flex; justify-content:end;">
                <button type="submit" class="btn btn_enregistrer mx-1">&nbsp; Nouveau Resposable</button>
                &nbsp;
            </p>
        </form> --}}


        {{-- </div> --}}
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th> # </th>
                                        <th>Nom d'utilisateur</th>
                                        <th>E-mail</th>
                                        <th> Téléphone </th>
                                        <th>Fonction</th>
                                        <th>Entreprise</th>
                                        <th> Action </th>
                                    </tr>
                                </thead>

                                <tbody>
                               

                                    @foreach($datas as $resp)
                                    <tr>
                                        <td style="width: 10%;"><a class="dropdown-item" href="{{ route('profil_of',$resp->id) }}">
                                                @if ($resp->photos==null)
                                                <img class="img-fluid  " alt="Responsive image" src="{{asset('images/responsables/users.png')}}" style="height:50px; width:50px;border-radius:100%"> </a>
                                            @else

                                            <img class="img-fluid " alt="Responsive image" src="{{asset('images/responsables/'.$resp->photos)}}"  style="height:50px; width:50px;border-radius:100%" ></a>
                                        
                                            @endif
                                        </td>
                                        <td>{{$resp->nom_resp." ".$resp->prenom_resp}}</td>
                                        <td>
                                            @if ($resp->prioriter==true)
                                            {{ $resp->email_resp }} (<strong style="color: green">principale</strong>)
                                            @else
                                            {{ $resp->email_resp }} (<strong style="color: rgb(223, 21, 223)">responsable</strong>)
                                            @endif
                                        </td>
                                        <td>{{$resp->telephone_resp}}</td>
                                        <td>{{$resp->fonction_resp}}</td>
                                        <td>{{$resp->entreprise->nom_etp}}</td>
                                        <td>
                                            <div class="dropdown">
                                                <div class="btn-group dropstart">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <a class="dropdown-item" href="#"><button type="text" class="btn btn_enregistrer">Afficher</button> </a>
                                                        <a href="#" class="dropdown-item"><button class="btn btn_enregistrer my-2 " data-bs-toggle="modal" data-bs-target="#modal_{{$resp->id}}"> <i class="bx bx-edit"></i> Modifier profile</button></a>
                                                        <a class="dropdown-item" href="#"><button class="btn btn_enregistrer my-2 delete_pdp_cfp" data-id="{{ $resp->id }}" id="{{ $resp->id }}" data-bs-toggle="modal" data-bs-target="#delete_modal_{{$resp->id}}" style="color: red">Supprimer</button></a>
                                                    </ul>
                                                </div>
                                            </div>

                                        </td>
                                    </tr>

                                    <!-- Modal delete -->
                                    <div class="modal fade" id="delete_modal_{{$resp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                    <h6 class="modal-title text-white">Avertissement pour <strong>{{$resp->nom_resp." ".$resp->prenom_resp}}</strong>!</h6>
                                                </div>
                                                @if ($resp->prioriter==true)
                                                <div class="modal-body">
                                                    <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible.Cette utilisateur est le responsable principale de son entreprise.Si vous voulez le supprimer, tous les informations à propos de son entreprise disparaîtra Continuer ?</small>
                                                </div>
                                                @else
                                                <div class="modal-body">
                                                    <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                </div>
                                                @endif

                                                <div class="modal-footer">

                                                    <button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button>

                                                    <form action="{{ route('delete_resp_etp',$resp->id) }}" method="GET">
                                                        @csrf
                                                        <button type="submit" class="btn btn_enregistrer"> Suprimer </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- fin modal delete --}}
                                    <div id="modal_{{$resp->id}}" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="modal-title text-md">
                                                        <h6>Modification des informations pour</h6>
                                                        <h5><strong>{{$resp->nom_resp." ".$resp->prenom_resp}}</strong></h5>
                                                    </div>
                                                    <button type="button" class="btn-close btn" style="color:red; background-color:rgb(255, 0, 225)" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('update_resp_etp',$resp->id) }}" method="GET" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="inputbox inputboxP mt-3">
                                                            <span><i class="bx bxs-graduation"></i>&nbsp; Nom<strong style="color:red">*</strong> </span>
                                                            <input autocomplete="off" type="text" name="nom" class="form-control formPayement" required="required" value="{{$resp->nom_resp}}">

                                                        </div>
                                                        <div class="inputbox inputboxP mt-3">
                                                            <span><i class="bx bxs-graduation"></i>&nbsp; Prénom<strong style="color:red">*</strong> </span>
                                                            <input autocomplete="off" type="text" name="prenom" class="form-control formPayement" required="required" value="{{$resp->prenom_resp}}">
                                                        </div>
                                                        <div class="inputbox inputboxP mt-3">
                                                            <span><i class="bx bx-envelope"></i>&nbsp;Fonction<strong style="color:#ff0000;">*</strong></span>
                                                            <input autocomplete="off" type="text" name="fonction" class="form-control formPayement" required="required" value="{{$resp->fonction_resp}}">
                                                        </div>
                                                        <div class="inputbox inputboxP mt-3">
                                                            <span><i class="bx bx-envelope"></i>&nbsp;Email<strong style="color:#ff0000;">*</strong></span>
                                                            <input autocomplete="off" type="email" name="email_resp" class="form-control formPayement" required="required" value="{{$resp->email_resp}}">
                                                        </div>
                                                        <div class="inputbox inputboxP mt-3">
                                                            <span><i class="bx bx-envelope"></i>&nbsp;CIN<strong style="color:#ff0000;">*</strong></span>
                                                            <input autocomplete="off" type="text" name="cin" class="form-control formPayement" required="required" value="{{$resp->cin_resp}}">
                                                        </div>
                                                        <div class="inputbox inputboxP mt-3">
                                                            <span><i class="bx bx-phone"></i>&nbsp;Téléphone<strong style="color:#ff0000;">*</strong></span>
                                                            <input autocomplete="off" type="text" name="telephone" class="form-control formPayement" required="required" value="{{$resp->telephone_resp}}"> </div>
                                                        <div class="inputbox inputboxP mt-3">
                                                            <span><i class="fa fa-globe"></i>&nbsp; Genre</span>
                                                            <select name="sexe" id="sexe">
                                                                <option value="HOMME">Homme</option>
                                                                <option value="FEMME">Femme</option>
                                                            </select>
                                                            <div class="mt-4 mb-4">
                                                                <div class="mt-4 mb-4 d-flex justify-content-between">
                                                                    <span><button style="color:red" type="button" class="btn btn_enregistrer annuler" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span>
                                                                    <button type="submit" class="btn btn_enregistrer">Valider</button> </div>
                                                            </div>
                                                    </form>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- fin --}}

                                    @endforeach
                                    <input id="id_value" value="" style='display:none'>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
