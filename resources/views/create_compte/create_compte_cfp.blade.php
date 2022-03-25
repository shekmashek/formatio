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

        <form action="{{route('create_compte_cfp')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
            @csrf

            <div id="formulaire" class="mt-0">
                <ul id="progressbars">
                    <li class="active" id="etape1"></li>
                    <li id="etape2"></li>
                    <li id="etape3"></li>
                    {{-- <li id="confirm"></li> --}}
                </ul>

                <fieldset class="shadow mt-0 p-3 bg-body rounded  field">
                    <h6 align="left" class="mb-2">Veuillez entrer le profil professionnel de votre organisation</strong></h4>

                        <div class="form-group">
                            <input type="text" name="name_cfp" class="form-control input_inscription" id="name_cfp" required />
                            <label for="name_cfp" class="form-control-placeholder">Raison Sociale<strong style="color:#ff0000;">*</strong></label>
                            @error('name_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000;" id="name_cfp_err"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" name="nif" required class="form-control input_inscription" id="nif_cfp" />
                            <label for="name_entreprise" class="form-control-placeholder">NIF<strong style="color:#ff0000;">*</strong></label>
                            @error('nif')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000;" id="nif_cfp_err"></span>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlInput1" class="form-control-label">Logo(60Ko max)<strong style="color:#ff0000;">*</strong></label>
                            <input type="file" required name="logo_cfp" class="form-control" id="logo_cfp" />
                            @error('logo_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            @if ($errors->has('logo_cfp'))
                            <div class="error">
                                {{ $errors->first('logo_cfp') }}
                            </div>
                            @endif
                            <p id="error_logo_cfp" style="color:#ff0000;"></p>

                        </div>
                        <div class="form-group">
                            <input type="text" name="web_cfp" class="form-control input_inscription" id="web_cfp" />
                            <label class="ml-3 form-control-placeholder" for="web_cfp">Web</label>
                        </div>


                        <input type="button" name="next" class="next action-button  suivant_of_1 "  value="Suivant" />
                </fieldset>


                {{-- --}}

                <fieldset class="shadow p-3 bg-body rounded field2">
                    <h6 align="left" class="mb-2">A propos de vous,responsable de la formation de la société</strong></h4>

                        <div class="form-group">
                            <input type="text" required name="nom_resp_cfp" class="form-control input_inscription" id="nom_resp_cfp" />
                            <label for="nom_resp_cfp" class="form-control-placeholder" align="left">Nom<strong style="color:#ff0000;">*</strong></label>
                            @error('nom_resp_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000;" id="nom_resp_cfp_err"></span>

                        </div>
                        <div class="form-group">
                            <input type="text" name="prenom_resp_cfp" class="form-control input_inscription" id="prenom_resp_cfp" />
                            <label for="prenom_resp_cfp" class="form-control-placeholder" align="left">Prénom</label>
                            @error('prenom_resp_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="text" name="cin_resp_cfp" class="form-control input_inscription" id="cin_resp_cfp" />
                            <label for="cin_resp_cfp" class="form-control-placeholder" align="left">CIN<strong style="color:#ff0000;">*</strong></label>
                            @error('cin_resp_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000;" id="cin_resp_cfp_err"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" required name="fonction_resp_cfp" class="form-control input_inscription" id="fonction_resp_cfp" />
                            <label for="fonction_resp_cfp" class="form-control-placeholder" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                            @error('fonction_resp_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000;" id="fonction_resp_cfp_err"></span>

                        </div>
                        <div class="form-group">
                            <input type="email" required name="email_resp_cfp" class="form-control input_inscription" id="email_resp_cfp" />
                            <label for="email_resp_cfp" class="form-control-placeholder" align="left">Email Responsable<strong style="color:#ff0000;">*</strong></label>
                            @error('email_resp_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000;" id="email_resp_cfp_err"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" max=10 required name="tel_resp_cfp" class="form-control input_inscription" id="tel_resp_cfp" />
                            <label for="tel_resp_cfp" class="form-control-placeholder" align="left">Téléphone responsable<strong style="color:#ff0000;">*</strong></label>
                            @error('tel_resp_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000;" id="tel_resp_cfp_err"></span>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <input name="value_confident" class="form-check-input me-5" type="checkbox" value="1" id="flexCheckDefault" style="width: 18px" required>
                                <label class="form-check-label m-0" for="flexCheckDefault" align="left">
                                    <a href="{{route('condition_generale_de_vente')}}" target="_blank" class="nav-item" style="font-size: 14px">J'ai lu et accepter <strong style="color: blue">les termes de confidentiels</strong> du plateforme</a>
                                </label>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <h6 align="left"><strong style="font-size: 15px">Je ne suis pas un robot</strong><strong style="color:#ff0000;">!</strong></h6>
                            <div class="col-sm-3"></div>
                            <div class="col-sm-1" style="display: grid; place-content: center;">
                                <h6> <strong>16</strong></h6>
                            </div>
                            <div class="col-sm-1" style="display: grid; place-content: center;">
                                <h6> <strong> + </strong></h6>
                            </div>
                            <div class="col-sm-1" style="display: grid; place-content: center;">
                                <div class="form-group">
                                    <input required type="number" name="val_robot" class="form-control input" placeholder="?" id="val_robot" style="width: 60px; border: none; outline: none; position:relative; top:0.5rem;" />
                                </div>
                            </div>
                            <div class="col-sm-1" style="display: grid; place-content: center;">
                                <h6> <strong> = </strong></h6>
                            </div>
                            <div class="col-sm-1" style="display: grid; place-content: center;">
                                <h6> <strong> 27 </strong></h6>
                            </div>

                            <div class="col-sm-3"></div>
                        </div>

                        <input type="button" name="previous" class="previous action-button" value="Précedent" />
                        <button type="submit" class=" action-button suivant_of_confirmer">Confirmer</button>

                        {{-- <input type="button" name="make_payment" class="next action-button" value="Suivant" /> --}}
                </fieldset>


    </div>


    </form>

</div>
</div>

@endsection
@extends('create_compte.footer')
