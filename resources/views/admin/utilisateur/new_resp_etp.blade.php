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
                <h4>Entreprises professionnelles / Nouveau</h4>
            </div>
        </div>

        <div class="row">

            <div class="col-3"></div>
            <div class="col-6">
                <div class="cardshadow-lg p-3 mb-5 bg-body rounded my-2 mx-2" style="padding: 5px;">
                    <form action="{{route('save_new_resp_etp')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
                        @csrf

                        <h4 align="left" class="mb-2">A propos de responsable de la formation</strong></h4>
                        @if(Session::has('error'))
                        <div class="alert alert-danger">
                            {{Session::get('error')}}
                        </div>
                        @endif

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
                                    <label for="nom_resp" class="form-control-placeholder" align="left">Nom<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" required name="nom_resp" class="form-control input_inscription" id="nom_resp" />
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="prenom_resp" class="form-control-placeholder" align="left">Prénom</label>
                                    <input type="text" name="prenom_resp" class="form-control input_inscription" id="prenom_resp" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="cin_resp" class="form-control-placeholder" align="left">CIN<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" name="cin_resp" class="form-control input_inscription" id="cin_resp_etp" />
                                    <span style="color:#ff0000;" id="cin_resp_etp_err"></span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="fonction_resp" class="form-control-placeholder" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" required name="fonction_resp" class="form-control input_inscription" id="fonction_resp" />
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_resp" class="form-control-placeholder" align="left">Email Responsable<strong style="color:#ff0000;">*</strong></label>
                                    <input type="email" required name="email_resp" class="form-control input_inscription" id="email_resp_etp" />
                                    <span style="color:#ff0000;" id="email_resp_etp_err"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tel_resp" class="form-control-placeholder" align="left">Téléphone responsable<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" max=10 required name="tel_resp" class="form-control input_inscription" id="tel_resp_etp" />
                                    <span style="color:#ff0000;" id="tel_resp_etp_err"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col">
                                <select name="entreprise_id" id="entreprise_id">
                                    @foreach ($entreprises as $etp)
                                    <option value="{{$etp->id}}">{{$etp->nom_etp}}</option>
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
