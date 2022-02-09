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

<style>
    .input_inscription {
        padding: 2px;
        border-radius: 100px;
        box-sizing: border-box;
        color: #9E9E9E;
        border: 1px solid #BDBDBD;
        font-size: 16px;
        letter-spacing: 1px;
        height: 50px !important;
        border: 2px solid #aa076c17 !important;

    }

    .input_inscription:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 2px solid #AA076B !important;
        outline-width: 0 !important;
    }


    .form-control-placeholder {
        position: absolute;
        top: 1rem;
        padding: 12px 2px 0 2px;
        padding: 0;
        padding-top: 2px;
        padding-bottom: 5px;
        padding-left: 5px;
        padding-right: 5px;
        transition: all 300ms;
        opacity: 0.5;
        left: 2rem;
    }

    .input_inscription:focus+.form-control-placeholder,
    .input_inscription:valid+.form-control-placeholder {
        font-size: 95%;
        font-weight: bolder;
        top: 1rem;
        transform: translate3d(0, -100%, 0);
        opacity: 1;
        backgroup-color: white;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        box-shadow: 0 0 0 30px white inset !important;
        -webkit-box-shadow: 0 0 0 30px white inset !important;
    }

</style>

<div class="row justify-content-center">
    <div class="col-md-12">

        <form action="{{route('create_compte_cfp')}}" id="msform" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- progressbar -->
            <ul id="progressbar_create_compte" class="mb-1">
                <li class="active" id="etape1"></li>
                <li id="etape2"></li>
                <li id="etape3"></li>
                <li id="confirm"></li>
                {{-- <li id="etape5"></li> --}}
            </ul> <!-- fieldsets -->

            <div id="formulaire">

                <fieldset class="shadow p-3 mb-5 bg-body rounded">
                    <h4 align="left" class="mb-2">Veuillez entrer le profile professionnel de votre organisation</strong></h4>

                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-control-label">Logo<strong style="color:#ff0000;">*</strong></label>
                        <input type="file" required name="logo_cfp" class="form-control" id="logo_cfp" />
                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="name_cfp" class="form-control input_inscription" id="name_cfp" required />
                                <label for="name_cfp" class="form-control-placeholder">Nom<strong style="color:#ff0000;">*</strong></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="web_cfp" class="form-control input_inscription" id="web_cfp" />
                                <label class="ml-3 form-control-placeholder" for="web_cfp">Web</label>

                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" name="nif" required class="form-control input_inscription" id="nif_cfp" />
                        <label for="name_entreprise" class="form-control-placeholder">NIF<strong style="color:#ff0000;">*</strong></label>
                        <span style = "color:#ff0000;" id="nif_cfp_err"></span>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="lot_cfp" required class="form-control input_inscription" id="lot_cfp" />
                                <label for="lot_cfp" class="form-control-placeholder">Lot ou Rue<strong style="color:#ff0000;">*</strong></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="quartier_cfp" required class="form-control input_inscription" id="quartier_cfp" />
                                <label for="quartier_cfp" class="form-control-placeholder">Quartier<strong style="color:#ff0000;">*</strong></label>

                            </div>
                        </div>

                    </div>

                    <div class="row mt-2">

                        <div class="col">
                            <div class="form-group">
                                <input type="text" required name="ville" class="form-control input_inscription" id="ville" />
                                <label for="ville" class="form-control-placeholder" align="left">Ville<strong style="color:#ff0000;">*</strong></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="code_postal_cfp" required class="form-control input_inscription" id="code_postal_cfp" />
                                <label for="code_postal_cfp" class="form-control-placeholder">Code Postal<strong style="color:#ff0000;">*</strong></label>

                            </div>
                        </div>
                    </div>
                    <div class="form-group m-0">
                        <label for="#" class="form-control-label">Région<strong style="color:#ff0000;">*</strong></label>
                        <select class="form-select" aria-label="Default select example" name="region" required id="region">
                            <option value="Diana">Diana</option>
                            <option value="Sava">Sava</option>
                            <option value="Itasy">Itasy</option>
                            <option value="Analamanga">Analamanga</option>
                            <option value="Vakinankaratra">Vakinankaratra</option>
                            <option value="Bongolava">Bongolava</option>
                            <option value="Sofia">Sofia</option>
                            <option value="Boeny">Boeny</option>
                            <option value="Betsiboka">Betsiboka</option>
                            <option value="Melaky">Melaky</option>
                            <option value="Alaotra-Mangoro">Alaotra-Mangoro</option>
                            <option value="Atsinanana">Atsinanana</option>
                            <option value="Analanjirofo">Analanjirofo</option>
                            <option value="Amoron'i Mania">Amoron'i Mania</option>
                            <option value="Haute Matsiatra">Haute Matsiatra</option>
                            <option value="Vatovay">Vatovay</option>
                            <option value="Fitovinany">Fitovinany</option>
                            <option value="Atsimo-Atsinanana">Atsimo-Atsinanana</option>
                            <option value="Ihorombe">Ihorombe</option>
                            <option value="Menabe">Menabe</option>
                            <option value="Atsimo-Andrefana">Atsimo-Andrefana</option>
                            <option value="Androy">Androy</option>
                            <option value="Anôsy">Anôsy</option>
                        </select>
                    </div>

                    <input type="button" name="next" class="next action-button" value="Suivant" />
                </fieldset>


                {{-- --}}

                <fieldset class="shadow p-3 mb-5 bg-body rounded">
                    <h4 align="left" class="mb-2">A propos de vous</strong></h4>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" required name="nom_resp_cfp" class="form-control input_inscription" id="nom_resp_cfp" />
                                <label for="nom_resp_cfp" class="form-control-placeholder" align="left">Nom<strong style="color:#ff0000;">*</strong></label>

                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <input type="text" name="prenom_resp_cfp" class="form-control input_inscription" id="prenom_resp_cfp" />
                                <label for="prenom_resp_cfp" class="form-control-placeholder" align="left">Prénom</label>

                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="cin_resp_cfp" class="form-control input_inscription" id="cin_resp_cfp" />
                                <label for="cin_resp_cfp" class="form-control-placeholder" align="left">CIN<strong style="color:#ff0000;">*</strong></label>
                                <span style = "color:#ff0000;" id="cin_resp_cfp_err"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" required name="fonction_resp_cfp" class="form-control input_inscription" id="fonction_resp_cfp" />
                                <label for="fonction_resp_cfp" class="form-control-placeholder" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" required name="email_resp_cfp" class="form-control input_inscription" id="email_resp_cfp" />
                                <label for="email_resp_cfp" class="form-control-placeholder" align="left">Email Responsable<strong style="color:#ff0000;">*</strong></label>
                                <span style = "color:#ff0000;" id="email_resp_cfp_err"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" max=10 required name="tel_resp_cfp" class="form-control input_inscription" id="tel_resp_cfp" />
                                <label for="tel_resp_cfp" class="form-control-placeholder" align="left">Téléphone responsable<strong style="color:#ff0000;">*</strong></label>
                                <span style = "color:#ff0000;" id="tel_resp_cfp_err"></span>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="dte_resp_cfp" class="form-control-label" align="left">Date de Naissance<strong style="color:#ff0000;">*</strong></label>
                                <input type="date" required name="dte_resp_cfp" class="form-control input_inscription" id="dte_resp_cfp" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                {{-- <label for="exampleFormControlInput1" class="form-control-label" align="left">Genre ou Sexe<strong style="color:#ff0000;">*</strong></label> --}}
                                <select class="form-select" aria-label="Default select example" name="sexe_resp_cfp" required id="sexe_resp_cfp">
                                    <option value="null" disabled selected hidden>Genre ou Sexe<strong style="color:#ff0000;">*</strong></option>

                                    <option value="H">Homme</option>
                                    <option value="S">Femme</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <input type="button" name="previous" class="previous action-button" value="Précendent" />
                    <input type="button" name="make_payment" class="next action-button" value="Suivant" />
                </fieldset>

                {{-- --}}

                <fieldset class="shadow p-3 mb-5 bg-body rounded">
                    <h4 align="left" class="mb-2">Veuillez renseigner votre information l'égale de votre organisation</h4>

                    {{-- <div class="form-group">
                        <input type="text" name="nif" required class="form-control input_inscription" id="name_entreprise" />
                        <label for="name_entreprise" class="form-control-placeholder">NIF<strong style="color:#ff0000;">*</strong></label>

                    </div>
                    <div class="form-group">
                        <input type="text" name="stat" required class="form-control input_inscription" id="stat" />
                        <label for="stat" required class="form-control-placeholder">STAT</label>

                    </div>
                    <div class="form-group">
                        <input type="text" name="rcs" required class="form-control input_inscription" id="rcs" />
                        <label for="rcs" required class="form-control-placeholder">RCS</label>

                    </div>
                    <div class="form-group">
                        <input type="text" name="cif" class="form-control input_inscription" id="cif" />
                        <label for="cif" class="form-control-placeholder">CIF à jour</label>

                    </div> --}}


                    <div class="row justify-content-center">
                        <h5 class="mt-5 mb-2" align="left"><strong>Je ne suis pas un robot</strong><strong style="color:#ff0000;">!</strong></h5>
                        <div class="col-sm-3"></div>
                        <div class="col-sm-1">
                            <h6> <strong>16</strong></h6>
                        </div>
                        <div class="col-sm-1">
                            <h6> <strong> + </strong></h6>
                        </div>
                        <div class="col-sm-1">
                            <div class="form-group">
                                <input type="text" name="val_robot" class="form-control input_inscription" placeholder="?" id="val_robot" style="width: 60px" />
                                {{-- <label for="val_robot" required class="form-control-placeholder"><strong style="color:#ff0000;">?</strong></label> --}}
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

                    <div class="row">
                        <div class="col-sm-1">
                            <input name="value_confident" class="form-check-input me-5" type="checkbox" value="1" id="flexCheckDefault" style="width: 18px">
                        </div>
                        <div class="col-md-8">
                            <label class="form-check-label m-0" for="flexCheckDefault" align="left">
                                J'ai lu et accepter les termes de confidentiels du plateforme
                            </label>
                        </div>
                        <div class="col-md-3"></div>
                    </div>

                    <input type="button" name="previous" class="previous action-button" value="Précedent" />
                    <input type="button" name="next" class="next action-button" value="Confirmer" />

                </fieldset>

                {{-- --}}

                <fieldset class="shadow p-3 mb-5 bg-body rounded">
                    <h5 align="left" class="mb-2">Félicitation, pour activer votre, veuillez acepter la validation sur votre mail</strong></h5>
                    {{-- <h6>Avant d'activer votre,veuillez bien revérifier votre données!</h6> --}}
                    <div class="form-group">
                    <img src="{{asset('img_create-compte/terminer.png')}}" class="fit-image" style="width: 300px; heigth: 300px">
                </div>
                    {{-- <input type="button" name="previous" class="previous action-button" value="Précendent" /> --}}
                    <button type="submit" class="action-button">lancer</button>
                </fieldset>

                {{-- --}}
            </div>


        </form>

    </div>
</div>

@endsection
@extends('create_compte.footer')
