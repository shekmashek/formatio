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

        <div class="row">

            <div class="col-3"></div>
            <div class="col-6">
                <div class="cardshadow-lg p-3 mb-5 bg-body rounded my-2 mx-2" style="padding: 5px;">
                    <form action="{{route('save_new_resp_cfp')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
                        @csrf

                        <h4 align="left" class="mb-2">A propos de responsable de la formation</strong></h4>

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
                            <div class="col">
                                <select name="cfp_id" id="cfp_id">
                                    @foreach ($cfps as $of)
                                    <option value="{{$of->id}}">{{$of->nom}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <br><br>
                        <div align="center">
                            <button type="submit" class="btn btn_enregistrer">&nbsp; Enregistrer </button>
                        </div>
                    </form>
                </div><br><br>
                <div class="col-3"></div>


            </div>
        </div>




    </div>
</div>


@endsection
@extends('create_compte.footer')
