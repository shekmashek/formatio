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

        <form action="{{route('create_compte_employeur')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
            @csrf
            <ul id="progressbars" class="mb-1">
                <li class="active" id="etape1"></li>
                <li id="etape2"></li>
                <li id="etape3"></li>
                {{-- <li id="confirm"></li> --}}
            </ul>

            <div id="formulaire">

                <fieldset class="shadow p-3 mb-5 bg-body rounded">
                    <h4 align="center" class="mb-2">Votre Société</strong></h4>

                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-control-label">Logo<strong style="color:#ff0000;">*</strong></label>
                        <input type="file" required name="logo_etp" class="form-control" id="logo_etp" />
                    </div>

                    <div class="form-group">
                        <input type="text" name="nif" required class="form-control input_inscription" id="nif_etp" />
                        <label for="nif_etp" class="form-control-placeholder">NIF<strong style="color:#ff0000;">*</strong></label>
                        <span style="color:#ff0000;" id="nif_etp_err"></span>
                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="name_etp" class="form-control input_inscription" id="name_etp" required />
                                <label for="name_etp" class="form-control-placeholder">Raison Sociale<strong style="color:#ff0000;">*</strong></label>
                                <span style = "color:#ff0000;" id="name_etp_err"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="web_etp" class="form-control input_inscription" id="web_etp" />
                                <label class="ml-3 form-control-placeholder" for="web_etp">Web</label>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group m-0">
                                <label for="#" class="form-control-label">Secteur d'activité<strong style="color:#ff0000;">*</strong></label>
                                <select class="form-select" aria-label="Default select example" name="secteur_id" required id="secteur_id">
                                    @foreach ($secteur as $sect)
                                    <option value="{{$sect->id}}">{{$sect->nom_secteur}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                    </div>


                    <input type="button" name="next" class="next action-button" value="Suivant" />
                </fieldset>


                {{-- --}}

                <fieldset class="shadow p-3 mb-5 bg-body rounded">
                    <h4 align="left" class="mb-2">A propos de vous,responsable de la formation de la société</strong></h4>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" required name="nom_resp_etp" class="form-control input_inscription" id="nom_resp_etp" />
                                <label for="nom_resp_etp" class="form-control-placeholder" align="left">Nom<strong style="color:#ff0000;">*</strong></label>

                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <input type="text" name="prenom_resp_etp" class="form-control input_inscription" id="prenom_resp_etp" />
                                <label for="prenom_resp_etp" class="form-control-placeholder" align="left">Prénom</label>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" required name="email_resp_etp" class="form-control input_inscription" id="email_resp_etp" />
                                <label for="email_resp_etp" class="form-control-placeholder" align="left">Email Responsable<strong style="color:#ff0000;">*</strong></label>
                                <span style = "color:#ff0000;" id="email_resp_etp_err"></span>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" max=10 required name="tel_resp_etp" class="form-control input_inscription" id="tel_resp_etp" />
                                <label for="tel_resp_etp" class="form-control-placeholder" align="left">Téléphone responsable<strong style="color:#ff0000;">*</strong></label>
                                <span style = "color:#ff0000;" id="tel_resp_etp_err"></span>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="cin_resp_etp" class="form-control input_inscription" id="cin_resp_etp" />
                                <label for="cin_resp_etp" class="form-control-placeholder" align="left">CIN<strong style="color:#ff0000;">*</strong></label>
                                <span style = "color:#ff0000;" id="cin_resp_etp_err"></span>

                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" required name="fonction_resp_etp" class="form-control input_inscription" id="fonction_resp_etp" />
                                <label for="fonction_resp_etp" class="form-control-placeholder" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
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
                        <h6 class="" align="left"><strong>Je ne suis pas un robot</strong><strong style="color:#ff0000;">!</strong></h6>
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

                    <input type="button" name="previous" class="previous action-button" value="Précendent" />
                    <input type="button" name="make_payment" class="next action-button" value="Suivant" />
                </fieldset>

                {{-- --}}

                <fieldset class="shadow p-3 mb-5 bg-body rounded">
                    <h5 align="left" class="mb-2">Félicitation, pour activer votre, veuillez confirmé votre insciption</strong></h5>
                    <div class="form-group">
                        <img src="{{asset('img_create-compte/terminer.png')}}" class="fit-image" style="width: 300px; heigth: 300px">
                    </div>
                    <input type="button" name="previous" class="previous action-button" value="Précedent" />
                    <button type="submit" style="background: #801D68; leight: 10px; padding: 5px 5px 5px 5px; color:white">Confirmer l'inscription</button>
                </fieldset>


                <fieldset class="shadow p-3 mb-5 bg-body rounded">
                    <h5 align="left" class="mb-2">Félicitation, pour activer votre, veuillez acepter la validation sur votre mail</strong></h5>
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
