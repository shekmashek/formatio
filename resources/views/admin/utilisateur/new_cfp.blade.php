@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

           <h3>Utilisateurs /</h3>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
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
                                <a class="nav-link btn_enregistrer  {{ Route::currentRouteNamed('liste_utilisateur') || Route::currentRouteNamed('liste_utilisateur') ? 'active' : '' }}" href="{{route('liste_utilisateur')}}">
                                    Responsables</a>
                            </li>

                            <li class="nav-item mx-1">

                                <a class="nav-link btn_enregistrer  {{ Route::currentRouteNamed('utilisateur_stagiaire') ? 'active' : '' }}" aria-current="page" href="{{route('utilisateur_stagiaire')}}">
                                    Stagiaires</a>

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
                <h4>Organisme de formations professionnelles / Nouveau</h4>
            </div>
        </div>

        <div class="cardshadow-lg p-3 mb-5 bg-body rounded my-2 mx-2" style="padding: 5px;">
            {{-- <form action="{{ route('utilisateur_register_cfp') }}" method="post" enctype="multipart/form-data"> --}}
            <form action="{{route('create_compte_cfp')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <h4 align="left" class="mb-2">Veuillez entrer le profile professionnel de votre organisation</strong></h4>
                        <div class="form-group">
                            <label for="exampleFormControlInput1" class="form-control-label">Logo<strong style="color:#ff0000;">*</strong></label>
                            <input type="file" required name="logo_cfp" class="form-control" id="logo_cfp" />
                        </div>

                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label for="name_cfp" class="form-control-placeholder">Raison Sociale<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" name="name_cfp" class="form-control input_inscription" id="name_cfp" required />
                                    <span style="color:#ff0000;" id="name_cfp_err"></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="ml-3 form-control-placeholder" for="web_cfp">Web</label>
                                    <input type="text" name="web_cfp" class="form-control input_inscription" id="web_cfp" />

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name_entreprise" class="form-control-placeholder">NIF<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" name="nif" required class="form-control input_inscription" id="nif_cfp" />
                            <span style="color:#ff0000;" id="nif_cfp_err"></span>
                        </div>
                        {{-- <label for=""> Logo </label>
                        <p></p>
                        <p></p>
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
                        <label for=""> Domaine </label><br>
                        <input type="text" class="form-control" name="domaine" autocomplete="off" required><br>
                        <label for=""> NIF </label><br>
                        <input type="text" class="form-control" name="nif" autocomplete="off" required><br>
                        <label for=""> STAT </label><br>
                        <input type="text" class="form-control" name="stat" autocomplete="off" required><br>
                        <label for=""> RCS</label><br>
                        <input type="text" class="form-control" name="rcs" autocomplete="off" required><br>
                        <label for=""> CIF </label><br>
                        <input type="text" class="form-control sm-3" name="cif" autocomplete="off" required><br> --}}

                    </div>
                    <div class="col">

                        <h4 align="left" class="mb-2">A propos de vous,responsable de la formation de la société</strong></h4>

                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="nom_resp_cfp" class="form-control-placeholder" align="left">Nom<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" required name="nom_resp_cfp" class="form-control input_inscription" id="nom_resp_cfp" />
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="prenom_resp_cfp" class="form-control-placeholder" align="left">Prénom</label>
                                    <input type="text" name="prenom_resp_cfp" class="form-control input_inscription" id="prenom_resp_cfp" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="cin_resp_cfp" class="form-control-placeholder" align="left">CIN<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" name="cin_resp_cfp" class="form-control input_inscription" id="cin_resp_cfp" />
                                    <span style="color:#ff0000;" id="cin_resp_cfp_err"></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="fonction_resp_cfp" class="form-control-placeholder" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" required name="fonction_resp_cfp" class="form-control input_inscription" id="fonction_resp_cfp" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_resp_cfp" class="form-control-placeholder" align="left">Email Responsable<strong style="color:#ff0000;">*</strong></label>
                                    <input type="email" required name="email_resp_cfp" class="form-control input_inscription" id="email_resp_cfp" />
                                    <span style="color:#ff0000;" id="email_resp_cfp_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tel_resp_cfp" class="form-control-placeholder" align="left">Téléphone responsable<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" max=10 required name="tel_resp_cfp" class="form-control input_inscription" id="tel_resp_cfp" />
                                    <span style="color:#ff0000;" id="tel_resp_cfp_err"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-1">
                                <input name="value_confident" class="form-check-input me-5" type="checkbox" value="1" id="flexCheckDefault" style="width: 18px">
                            </div>
                            <div class="col-md-11">
                                <label class="form-check-label m-0" for="flexCheckDefault" align="left">
                                    <a href="{{route('condition_generale_de_vente')}}" class="nav-item">J'ai lu et accepter les termes de confidentiels du plateforme</a>
                                </label>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <h6 class="mt-5 mb-2" align="left"><strong>Je ne suis pas un robot</strong><strong style="color:#ff0000;">!</strong></h6>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-1">
                                <h6> <strong>16</strong></h6>
                            </div>
                            <div class="col-sm-1">
                                <h6> <strong> + </strong></h6>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <input type="number" name="val_robot" class="form-control input_inscription" placeholder="?" id="val_robot" style="width: 60px" />
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <h6> <strong> = </strong></h6>
                            </div>
                            <div class="col-sm-1">
                                <h6> <strong> 27 </strong></h6>
                            </div>

                            <div class="col-sm-3"></div>
                        </div>

                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-md-6">

                    </div>
                    <div class="col-md-6">

                    </div>
                </div> --}}
                <br><br>
                <div align="center">
                    <button type="submit" class="btn btn_enregistrer">&nbsp; Enregistrer </button>
                </div>
            </form>
        </div><br><br>

    </div>
</div>


@endsection
@extends('create_compte.footer')
