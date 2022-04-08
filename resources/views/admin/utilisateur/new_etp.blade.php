@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Nouveau entreprise</h3>
@endsection
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


                    </div>
                </div>
            </nav>

            <div class="col-lg-12">
                <br>
                <h4>Entreprise professionnelles / Nouveau</h4>
            </div>

        </div>

        <div class="card" style="padding: 5px;">
            {{-- <form action="{{ route('utilisateur_register_cfp') }}" method="post" enctype="multipart/form-data"> --}}
            <form action="{{route('create_compte_employeur')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <h4 align="left" class="mb-2">Veuillez entrer le profile professionnel de votre entreprise</strong></h4>
                        <div class="form-group">
                            <label for="exampleFormControlInput1" class="form-control-label">Logo<strong style="color:#ff0000;">*</strong></label>
                            <input type="file" required name="logo_etp" class="form-control" id="logo_etp" />
                        </div>

                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label for="name_cfp" class="form-control-placeholder">Raison Sociale<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" name="name_etp" class="form-control input_inscription" id="name_etp" required />
                                    <span style="color:#ff0000;" id="name_cfp_err"></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label class="ml-3 form-control-placeholder" for="web_cfp">Web</label>
                                    <input type="text" name="web_etp" class="form-control input_inscription" id="web_etp" />

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name_entreprise" class="form-control-placeholder">NIF<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" name="nif" required class="form-control input_inscription" id="nif_etp" />
                            <span style="color:#ff0000;" id="nif_etp_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="#" class="form-control-label">Secteur d'activité<strong style="color:#ff0000;">*</strong></label>
                            <select class="form-select" aria-label="Default select example" name="secteur_id" required id="secteur_id">
                                @foreach ($secteur as $sect)
                                <option value="{{$sect->id}}">{{$sect->nom_secteur}}</option>
                                @endforeach

                            </select>


                        </div>

                    </div>
                    <div class="col">

                        <h4 align="left" class="mb-2">A propos de vous,responsable de la formation de la société</strong></h4>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="matricule_resp_etp" class="form-control-placeholder" align="left">Matricule<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" required name="matricule_resp_etp" class="form-control input_inscription" id="matricule_resp_etp" />
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="nom_resp_cfp" class="form-control-placeholder" align="left">Nom<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" required name="nom_resp_etp" class="form-control input_inscription" id="nom_resp_etp" />
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="prenom_resp_cfp" class="form-control-placeholder" align="left">Prénom</label>
                                    <input type="text" name="prenom_resp_etp" class="form-control input_inscription" id="prenom_resp_etp" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="cin_resp_cfp" class="form-control-placeholder" align="left">CIN<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" name="cin_resp_etp" class="form-control input_inscription" id="cin_resp_etp" />
                                    <span style="color:#ff0000;" id="cin_resp_etp_err"></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="fonction_resp_cfp" class="form-control-placeholder" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" required name="fonction_resp_etp" class="form-control input_inscription" id="fonction_resp_etp" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_resp_etp" class="form-control-placeholder" align="left">Email Responsable<strong style="color:#ff0000;">*</strong></label>
                                    <input type="email" required name="email_resp_etp" class="form-control input_inscription" id="email_resp_etp" />
                                    <span style="color:#ff0000;" id="email_resp_etp_err"></span>

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tel_resp_cfp" class="form-control-placeholder" align="left">Téléphone responsable<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" max=10 required name="tel_resp_etp" class="form-control input_inscription" id="tel_resp_etp" />
                                    <span style="color:#ff0000;" id="tel_resp_etp_err"></span>
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
