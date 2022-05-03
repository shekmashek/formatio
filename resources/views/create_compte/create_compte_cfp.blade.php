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
<link rel="stylesheet" href="{{asset('assets/css/inputControlAccueilIndex.css')}}">

<div class="container-fluid">
    <div class="row justify-content-center vh-100">
        <div class="col-6 form_content">
            <h3 class="text-center txt_enter">Veuillez entrer le profil professionnel de votre organisation</h3>
            <form action="{{route('create_compte_cfp')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
                @csrf

                <div id="formulaire" class="mt-0">
                    <ul id="progressbars">
                        <li class="active" id="etape1"></li>
                        <li id="etape2"></li>
                        <li id="etape3"></li>
                        {{-- <li id="confirm"></li> --}}
                    </ul>

                    <fieldset class="shadow mt-0 p-3 bg-body rounded  field-cfp">
                            <div class="form-group mb-2">
                                <input type="text" name="name_cfp" class="form-control input mt-3" id="name_cfp" placeholder="Raison Sociale(Nom de votre organisme)*" required/>
                                <label for="name_cfp" class="form-control-placeholder">Raison Sociale(Nom de votre organisme)<span style="color:#ff0000;">*</span></label>
                                @error('name_cfp')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                                <span style="color:#ff0000;" id="name_cfp_err"></span>
                            </div>
                            <div class="form-group">
                                <input type="text" name="nif" class="form-control input" id="nif_cfp" placeholder="Numero d'Identité Fiscale*" required/>
                                <label for="name_entreprise" class="form-control-placeholder">Numero d'Identité Fiscale<strong style="color:#ff0000;">*</strong></label>
                                @error('nif')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                                <span style="color:#ff0000;" id="nif_cfp_err"></span>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1" class="form-control-label">Logo(60Ko max)<strong style="color:#ff0000;">*</strong></label>
                                <input type="file" required name="logo_cfp" class="form-control input" id="logo_cfp" />
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
                                <p id="error_logo_cfp" style="color:#ff0000;">les extension de type *.jpg, *.png et *.jpeg seulement sont autorisé</p>

                            </div>
                                <input type="button" name="next" class="next btn action-button suivant_of_1"  id="suivant_of_1"  value="Suivant" />
                                {{-- <input type="button" name="next" class="next action-button " value="Suivant" /> --}}


                    </fieldset>


                    {{-- --}}

                    <fieldset class="shadow p-3 bg-body rounded field2-cfp">
                        <h6 align="left" class="mb-2">A propos de vous,responsable de la formation de la société</strong></h4>

                            <div class="form-group">
                                <input type="text" required name="nom_resp_cfp" class="form-control input" id="nom_resp_cfp" />
                                <label for="nom_resp_cfp" class="form-control-placeholder" align="left">Nom<strong style="color:#ff0000;">*</strong></label>
                                @error('nom_resp_cfp')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                                <span style="color:#ff0000;" id="nom_resp_cfp_err"></span>

                            </div>
                            <div class="form-group">
                                <input type="text" name="prenom_resp_cfp" class="form-control input" id="prenom_resp_cfp" />
                                <label for="prenom_resp_cfp" class="form-control-placeholder" align="left">Prénom</label>
                                @error('prenom_resp_cfp')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" name="cin_resp_cfp" class="form-control input" id="cin_resp_cfp" />
                                <label for="cin_resp_cfp" class="form-control-placeholder" align="left">CIN<strong style="color:#ff0000;">*</strong></label>
                                @error('cin_resp_cfp')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                                <span style="color:#ff0000;" id="cin_resp_cfp_err"></span>
                            </div>
                            <div class="form-group">
                                <input type="email" required name="email_resp_cfp" class="form-control input" id="email_resp_cfp" />
                                <label for="email_resp_cfp" class="form-control-placeholder" align="left">Email Responsable<strong style="color:#ff0000;">*</strong></label>
                                @error('email_resp_cfp')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                                <span style="color:#ff0000;" id="email_resp_cfp_err"> veuillez entrer votre mail</span>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <input name="value_confident" id="value_confident" class="form-check-input me-5" type="checkbox" value="1" id="flexCheckDefault" style="width: 18px" required>
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
                                    <button type="submit" class=" action-button  btn  suivant_of_confirmer" id="suivant_of_confirmer">Confirmer</button>
                                    {{-- <button type="submit" class=" action-button">Confirmer</button> --}}


                            {{-- <input type="button" name="make_payment" class="next action-button" value="Suivant" /> --}}
                    </fieldset>


                </div>


            </form>

        </div>
        <div class="col-6">
            <div>
                <img src="{{asset('img/logo_formation/logo_fmg7635dc trans.png')}}" alt="logo" class="img-fluid image_accueil">
            </div>
        </div>
    </div>
</div>


@endsection
@extends('create_compte.footer')
