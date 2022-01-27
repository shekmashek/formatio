@extends('create_compte.header')
@section('content')

@if(Session::has('success'))
<div class="alert alert-success">
    {{Session::get('success')}}
</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger">
    {{Session::get('error')}}
</div>
@endif

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">

            <form action="{{route('create_compte_employeur')}}" id="msform" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- progressbar -->
                <ul id="progressbar" class="mb-1">
                    <li class="active" id="etape1"></li>
                    <li id="etape2"></li>
                    <li id="etape3"></li>
                    <li id="etape4"></li>
                </ul> <!-- fieldsets -->

                <div id="formulaire">

                    <fieldset class="shadow p-3 mb-5 bg-body rounded">
                        <h3 class="">Veuillez entrer le nom de votre entreprise</strong></h3>

                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label">Logo<strong style="color:#ff0000;">*</strong></label>
                            <input type="file" required name="logo_cfp" class="form-control" id="logo_cfp" />
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Non<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" name="name_etp" class="form-control" id="name_etp" />
                                <span style="color:#ff0000;" id="num_facture_err"></span>
                            </div>
                            <div class="col">
                                <div class="form-ground">
                                    <label for="exampleFormControlInput1" class="form-label" align="left">Web</label>
                                    <input type="text" name="web_etp" class="form-control" id="web_etp" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-ground">
                                    <label for="exampleFormControlInput1" class="form-label" align="left">Email de l'entreprise<strong style="color:#ff0000;">*</strong></label>
                                    <input type="email" required name="email_etp" class="form-control" id="email_etp" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-ground">
                                    <label for="exampleFormControlInput1" class="form-label" align="left">Téléphone de l'entreprise<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" max=10 required name="tel_etp" class="form-control" id="tel_etp" />
                                </div>
                            </div>
                        </div>

                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label" align="left">Secteur d'activité<strong style="color:#ff0000;">*</strong></label>
                            {{-- <input type="text" required name="domaine_etp" class="form-control" id="domaine_etp" /> --}}
                            <select class="form-select" aria-label="Default select example" required name="domaine_etp" id="domaine_etp">
                                <option value="null" disabled selected hidden>Veuillez Sélectionner</option>
                                @foreach ($secteurs as $sect)
                                <option value="{{$sect->id}}">{{$sect->nom_secteur}}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="button" name="next" class="next action-button" style="background-color: red" value="Suivant" />
                    </fieldset>

                    <fieldset class="shadow p-3 mb-5 bg-body rounded">
                        <h3 class="">A propos de votre entreprise</h3>


                        <div class="row mt-2">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Rue<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" name="rue_etp" required class="form-control" id="rue_etp" />
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Quartier<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" name="quartier_etp" required class="form-control" id="quartier_etp" />
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Code Postal<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" name="code_postal_etp" required class="form-control" id="code_postal_etp" />
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label" align="left">Lot<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" required name="lot_etp" class="form-control" id="lot_etp" />
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label" align="left">Ville<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" required name="ville_etp" class="form-control" id="ville_etp" />
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label" align="left">Région<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" required name="region_etp" class="form-control" id="region_etp" />
                            </div>
                        </div>

                        <label for="exampleFormControlInput1" class="form-label">NIF<strong style="color:#ff0000;">*</strong></label>
                        <input type="text" name="nif" required class="form-control" id="name_entreprise" />

                        <label for="exampleFormControlInput1" required class="form-label">STAT<strong style="color:#ff0000;">*</strong></label>
                        <input type="text" name="stat" required class="form-control" id="name_entreprise" />

                        <label for="exampleFormControlInput1" required class="form-label">RCS<strong style="color:#ff0000;">*</strong></label>
                        <input type="text" name="rcs" required class="form-control" id="name_entreprise" />

                        <label for="exampleFormControlInput1" class="form-label">CIF à jour</label>
                        <input type="text" name="cif" class="form-control" id="name_entreprise" />


                        <input type="button" name="previous" class="previous action-button-previous" style="background-color: red" value="Précedent" />
                        <input type="button" name="next" class="next action-button" style="background-color: red" value="Suivant" />
                    </fieldset>


                    <fieldset class="shadow p-3 mb-5 bg-body rounded">
                        <h3 class="">A propos de vous</strong></h3>
                        <h4>En vous inscrivant, vous attestez que vous ête <strong> le responsable formation au sein de votre entreprise</strong>.</h4>

                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label">Photo<strong style="color:#ff0000;">*</strong></label>
                            <input type="file" required name="photo_resp" class="form-control" id="photo_resp" />
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label" align="left">Nom<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" required name="nom_resp" class="form-control" id="nom_resp" />
                            </div>
                            <div class="col-md-8">
                                <label for="exampleFormControlInput1" class="form-label" align="left">Prénom</label>
                                <input type="text"  name="prenom_resp" class="form-control" id="prenom_resp" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="exampleFormControlInput1" class="form-label" align="left">Sexe</label>
                                <select class="form-select" aria-label="Default select example" name="sexe_resp" required id="sexe_resp">
                                    <option value="null" disabled selected hidden>Veuillez Sélectionner</option>
                                    <option value="H">Homme</option>
                                    <option value="S">Femme</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="exampleFormControlInput1" class="form-label" align="left">Date de Naissance<strong style="color:#ff0000;">*</strong></label>
                                <input type="date" required name="dte_resp" class="form-control" id="dte_resp" />
                            </div>
                            <div class="col-md-5">
                                <label for="exampleFormControlInput1" class="form-label" align="left">CIN<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" required name="cin_resp" class="form-control" id="cin_resp" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-ground">
                                    <label for="exampleFormControlInput1" class="form-label" align="left">Email Responsable<strong style="color:#ff0000;">*</strong></label>
                                    <input type="email" required name="email_resp" class="form-control" id="email_resp" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-ground">
                                    <label for="exampleFormControlInput1" class="form-label" align="left">Téléphone responsable<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" max=10 required name="tel_resp" class="form-control" id="tel_resp" />
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Rue<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" name="rue_resp" required class="form-control" id="rue_resp" />
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Quartier<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" name="quartier_resp" required class="form-control" id="quartier_resp" />
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Code Postal<strong style="color:#ff0000;">*</strong></label>
                                <input type="text"  name="code_postal_resp" required class="form-control" id="code_postal_resp" />
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label" align="left">Lot<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" required name="lot_resp" class="form-control" id="lot_resp" />
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label" align="left">Ville<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" required name="ville_resp" class="form-control" id="ville_resp" />
                            </div>
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label" align="left">Région<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" required name="region_resp" class="form-control" id="region_resp" />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" required name="fonction_resp" class="form-control" id="fonction_resp" />
                            </div>
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label" align="left">Département<strong style="color:#ff0000;">*</strong></label>
                                <select class="form-select" aria-label="Default select example" required name="departement_resp" id="departement_resp">
                                    <option value="null" disabled selected hidden>Veuillez Sélectionner</option>
                                    @foreach ($departements as $depart)
                                    <option value="{{$depart->id}}">{{$depart->nom_departement}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label" align="left">Poste</label>
                            <input type="text" name="poste_resp" class="form-control" id="poste_resp" />
                        </div>

                        <input type="button" name="previous" class="previous action-button-previous" style="background-color: red" value="Précendent" />
                        <input type="button" name="make_payment" class="next action-button" style="background-color: red" value="Suivant" />
                    </fieldset>

                    <fieldset class="shadow p-3 mb-5 bg-body rounded">
                        <h5 class="">Après avoir remplir notre condition,vous pouvez maitenant activier votre.</strong></h5>
                        <h6>Avant d'activer votre,veuillez bien revérifier votre données!</h6>
                        <input type="button" name="previous" class="previous action-button-previous" style="background-color: red" value="Précendent" />
                        <button type="submit" class="btn btn-danger">Activation</button>
                    </fieldset>
                </div>


            </form>

        </div>

        <div class="col-md-2"></div>
    </div>
</div>

@endsection
@extends('create_compte.footer')
