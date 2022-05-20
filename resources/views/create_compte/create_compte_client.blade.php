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
            <h3 class="text-center txt_enter">À propos de votre organisation</h3>
            <form action="{{route('create_compte_employeur')}}" id="msform_facture" method="POST"
                enctype="multipart/form-data">
                @csrf
                <ul id="progressbars" class="mt-0">
                    <li class="active" id="etape1"></li>
                    <li id="etape2"></li>
                    <li id="etape3"></li>
                </ul>

                <div id="formulaire">

                    <fieldset class="shadow p-3 bg-body rounded field-etp">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="name_etp" class="">Raison Sociale<strong style="color:#ff0000;">*</strong></label>        
                                    </div>
                                    <div class="col-8">
                                        <input type="text" name="name_etp" class="form-control input" id="name_etp" placeholder="Nom de votre organisme*"
                                        required />
                                    @error('name_etp')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                    <span style="color:#ff0000;" id="name_etp_err"></span>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="nif_etp" class="">NIF<strong
                                            style="color:#ff0000;">*</strong></label>    
                                    </div>
                                    <div class="col-8">
                                        <input type="text" name="nif" required class="form-control input"
                                        id="nif_etp" placeholder="Numero d'Identité Fiscale*" />
                                    @error('nif')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                                    </div>
                                    @enderror
                                    <span style="color:#ff0000; font-size: 0.8rem" id="nif_etp_err"></span>
    
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-control-label">Logo (1.7 MB max)<strong
                                            style="color:#ff0000;">*</strong></label>    
                                    </div>
                                    <div class="col-8">
                                        <input type="file" required name="logo_etp" class="form-control input_file" id="logo_etp" />
                                        @error('logo_etp')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                                        </div>
                                        @enderror
                                        <p id="error_logo_etp" style="color:#ff0000; font-size: 0.8rem"></p>        
                                    </div>
                                </div>
                                {{-- <p id="error_logo_etp" style="color:#ff0000; font-size: 0.8rem">les extension de type *.jpg, *.png, *.jpeg et *.webp seulement sont autorisé</p> --}}

                            </div>
                            {{-- <div class="row">
                                <div class="col">
                                    <div class="form-group m-0">
                                        <label for="#" class="form-control-label">Secteur d'activité<strong
                                                style="color:#ff0000;">*</strong></label>
                                        <select class="form-select" aria-label="Default select example"
                                            name="secteur_id" required id="secteur_id">
                                            @foreach ($secteur as $sect)
                                            <option value="{{$sect->id}}">{{$sect->nom_secteur}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                            </div> --}}

                            <input type="button" name="next" class="next btn action-button  suivant_etp_1 "
                                id="suivant_etp_1" value="Suivant" />
                    </fieldset>


                    {{-- --}}

                    <fieldset class="shadow p-3 bg-body rounded field2-etp">
                        <h6 align="left" class="mb-3 a_proposdeVous">A propos de vous,responsable de ressource humaine</strong></h4>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-4">
                                                <label for="matricule_resp_etp" class="" align="left">Matricule<strong style="color:#ff0000;">*</strong></label>
                                            </div>
                                            <div class="col-8">
                                                <input type="text" required name="matricule_resp_etp"
                                                class="form-control input mb-1" id="matricule_resp_etp" placeholder="Matricule"/>
    
                                            @error('matricule_resp_etp')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                                            </div>
                                            @enderror
                                            <span style="color:#ff0000; font-size: 0.8rem" id="matricule_resp_etp_err"></span>
                                            </div>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="nom_resp_etp" class="" align="left">Nom<strong style="color:#ff0000;">*</strong></label>                  
                                    </div>
                                    <div class="col-8">
                                        <input type="text" required name="nom_resp_etp" class="form-control input" id="nom_resp_etp" placeholder="Nom"/>
                                        @error('nom_resp_etp')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                                        </div>
                                        @enderror
                                        <span style="color:#ff0000; font-size: 0.8rem" id="nom_resp_etp_err"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="prenom_resp_etp" class=""
                                        align="left">Prénom</label>    
                                    </div>
                                    <div class="col-8">
                                        <input type="text" name="prenom_resp_etp" class="form-control input"
                                        id="prenom_resp_etp" placeholder="Prenom"/>
                                    @error('prenom_resp_etp')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                                    </div>
                                    @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="cin_resp_etp" class="" align="left">CIN<strong
                                            style="color:#ff0000;">*</strong></label>    
                                    </div>
                                    <div class="col-8">
                                        <input type="text" required name="cin_resp_etp" class="form-control input"
                                        id="cin_resp_etp" placeholder="CIN"/>
    
                                    @error('cin_resp_etp')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                                    </div>
                                    @enderror
                                    <span style="color:#ff0000; font-size: 0.8rem" id="cin_resp_etp_err"></span>
                                    </div>
                                </div>
                                
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="email_resp_etp" class="" align="left">Email
                                            Responsable<strong style="color:#ff0000;">*</strong></label>        
                                    </div>
                                    <div class="col-8">
                                        <input type="email" required name="email_resp_etp"
                                    class="form-control input mb-1" id="email_resp_etp" placeholder="E-mail" />

                                @error('email_resp_etp')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                                </div>
                                @enderror
                                <span style="color:#ff0000; font-size: 0.8rem" id="email_resp_etp_err"> veuillez entrer votre mail</span>

                                    </div>
                                </div>
                                 
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <input name="value_confident" class="form-check-input me-2" type="checkbox"
                                        value="1" id="flexCheckDefault" style="width: 18px" required>
                                    <label class="form-check-label m-0" for="flexCheckDefault" align="left">
                                        <a href="{{route('condition_generale_de_vente')}}" class="nav-item lien_confidentiel"
                                            target="_blank">J'ai lu et accepter <strong>les termes
                                                de confidentiels</strong> du plateforme</a>
                                    </label>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <h6 class="text-center"><strong style="font-size: 15px">Je ne suis pas un
                                        robot</strong><strong style="color:#ff0000;">!</strong></h6>
                                <div class="col-sm-3"></div>
                                <div class="col-sm-1" style="display: grid; place-content: center;">
                                    <h6> <strong>16</strong></h6>
                                </div>
                                <div class="col-sm-1" style="display: grid; place-content: center;">
                                    <h6> <strong> + </strong></h6>
                                </div>
                                <div class="col-sm-1" style="display: grid; place-content: center;">
                                    <div class="form-group">
                                        <input required type="number" name="val_robot" class="form-control input"
                                            placeholder="?" id="val_robot"
                                            style="width: 60px; border: none; outline: none; position:relative; top:0.5rem;" />
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

                            <button type="submit" class="btn action-button suivant_etp_confirmer"
                                id="suivant_etp_confirmer">Confirmer</button>

                            {{-- <button type="submit" class=" action-button">Confirmer</button> --}}
                </div>
                </fieldset>
            </form>
        </div>
        <div class="col-6 image_accueil">
            <div class="text-center">
                <img src="{{asset('img/logo_formation/logo_fmg7635dc trans.png')}}" alt="logo" class="img-fluid" width="300px" height="300px">
            </div>
            <h3 class="text-center  mt-2">formation.mg</h3>
        </div>
    </div>
</div>

@endsection
@extends('create_compte.footer')