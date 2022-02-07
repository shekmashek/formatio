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
    border-radius: 5px;
    box-sizing: border-box;
    color: #9E9E9E;
    border: 1px solid #BDBDBD;
    font-size: 16px;
    letter-spacing: 1px;
    height: 50px !important;
    border: 2px solid #aa076c93 !important;

}

.input_inscription:focus{
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
input:-webkit-autofill:active{
    box-shadow: 0 0 0 30px white inset !important;
    -webkit-box-shadow: 0 0 0 30px white inset !important;
}

</style>

<div class="row justify-content-center">
    <div class="col-md-12">

        <form action="{{route('create_compte_cfp')}}" id="msform" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- progressbar -->
            <ul id="progressbar" class="mb-1">
                <li class="active" id="etape1"></li>
                <li id="etape2"></li>
                <li id="etape3"></li>
                <li id="etape4"></li>
                <li id="etape5"></li>
            </ul> <!-- fieldsets -->

            <div id="formulaire">

                <fieldset class="shadow p-3 mb-5 bg-body rounded">
                    <h4 class="">Veuillez entrer le profile professionnel de votre organisation</strong></h3>

                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-control-placeholder">Logo<strong style="color:#ff0000;">*</strong></label>
                        <input type="file" required name="logo_cfp" class="form-control" id="logo_cfp" />
                    </div>

                    <div class="row">
                        {{-- <div class="row px-3 mt-4">
                            <div class="form-group mt-1 mb-1">
                                 <input type="text" id="email" class="form-control input_inscription" >
                                 <label class="ml-3 form-control-placeholder" for="email">Email</label>
                            </div>
                         </div> --}}
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="name_cfp" class="form-control input_inscription" id="name_cfp" required/>
                                <label for="name_cfp" class="form-control-placeholder">Non<strong style="color:#ff0000;">*</strong></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" name="web_cfp" class="form-control input_inscription" id="web_cfp" />
                                <label class="ml-3 form-control-placeholder" for="web_cfp">Web</label>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" required name="email_cfp" class="form-control input_inscription" id="email_cfp" />
                                <label for="email_cfp" class="form-control-placeholder" align="left">Email de l'organisation<strong style="color:#ff0000;">*</strong></label>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tel_cfp" class="form-control-placeholder" align="left">Téléphone de l'organisation<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" max=10 required name="tel_cfp" class="form-control input_inscription" id="tel_cfp" />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <input type="text" required name="domaine_cfp" class="form-control input_inscription" id="domaine_cfp" />
                        <label for="domaine_cfp" class="form-control-placeholder" align="left">Domaine d'activité<strong style="color:#ff0000;">*</strong></label>

                    </div>
                    <input type="button" name="next" class="next action-button"  value="Suivant" />
                </fieldset>

                <fieldset class="shadow p-3 mb-5 bg-body rounded">
                    <h3 class="">A propos de votre organisation</h3>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-control-placeholder">Rue<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" name="rue_cfp" required class="form-control" id="rue_cfp" />
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-control-placeholder">Quartier<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" name="quartier_cfp" required class="form-control" id="quartier_cfp" />
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-control-placeholder">Code Postal<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" name="code_postal_cfp" required class="form-control" id="code_postal_cfp" />
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Lot<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="lot" class="form-control" id="lot" />
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Ville<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="ville" class="form-control" id="ville" />
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Région<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="region" class="form-control" id="region" />
                        </div>
                    </div>

                    <label for="exampleFormControlInput1" class="form-control-placeholder">NIF<strong style="color:#ff0000;">*</strong></label>
                    <input type="text" name="nif" required class="form-control" id="name_entreprise" />

                    <label for="exampleFormControlInput1" required class="form-control-placeholder">STAT<strong style="color:#ff0000;">*</strong></label>
                    <input type="text" name="stat" required class="form-control" id="name_entreprise" />

                    <label for="exampleFormControlInput1" required class="form-control-placeholder">RCS<strong style="color:#ff0000;">*</strong></label>
                    <input type="text" name="rcs" required class="form-control" id="name_entreprise" />

                    <label for="exampleFormControlInput1" class="form-control-placeholder">CIF à jour</label>
                    <input type="text" name="cif" class="form-control" id="name_entreprise" />

                    <input type="button" name="previous" class="previous action-button"  value="Précedent" />
                    <input type="button" name="next" class="next action-button"  value="Suivant" />

                </fieldset>

                <fieldset class="shadow p-3 mb-5 bg-body rounded">
                    <h3 class="">A propos de vous</strong></h3>
                    <h4>En vous inscrivant, vous atinput_inscriptionez que vous ête <strong> le responsable formation au sein de votre organisation</strong>.</h4>

                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-control-placeholder">Photo<strong style="color:#ff0000;">*</strong></label>
                        <input type="file" required name="photo_resp_cfp" class="form-control" id="photo_resp_cfp" />
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Nom<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="nom_resp_cfp" class="form-control" id="nom_resp_cfp" />
                        </div>
                        <div class="col-md-8">
                            <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Prénom</label>
                            <input type="text" name="prenom_resp_cfp" class="form-control" id="prenom_resp_cfp" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Sexe</label>
                            <select class="form-select" aria-label="Default select example" name="sexe_resp_cfp" required id="sexe_resp_cfp">
                                <option value="null" disabled selected hidden>Veuillez Sélectionner</option>
                                <option value="H">Homme</option>
                                <option value="S">Femme</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Date de Naissance<strong style="color:#ff0000;">*</strong></label>
                            <input type="date" required name="dte_resp_cfp" class="form-control" id="dte_resp_cfp" />
                        </div>
                        <div class="col-md-5">
                            <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">CIN<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="cin_resp_cfp" class="form-control" id="cin_resp_cfp" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Email Responsable<strong style="color:#ff0000;">*</strong></label>
                                <input type="email" required name="email_resp_cfp" class="form-control" id="email_resp_cfp" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Téléphone responsable<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" max=10 required name="tel_resp_cfp" class="form-control" id="tel_resp_cfp" />
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-control-placeholder">Rue<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" name="rue_resp_cfp" required class="form-control" id="rue_resp_cfp" />
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-control-placeholder">Quartier<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" name="quartier_resp_cfp" required class="form-control" id="quartier_resp_cfp" />
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-control-placeholder">Code Postal<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" name="code_postal_resp_cfp" required class="form-control" id="code_postal_resp_cfp" />
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Lot<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="lot_resp_cfp" class="form-control" id="lot_resp_cfp" />
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Ville<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="ville_resp_cfp" class="form-control" id="ville_resp_cfp" />
                        </div>
                        <div class="col">
                            <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Région<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="region_resp_cfp" class="form-control" id="region_resp_cfp" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="fonction_resp_cfp" class="form-control" id="fonction_resp_cfp" />
                        </div>
                        <div class="col-md-6">
                            <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Département<strong style="color:#ff0000;">*</strong></label>
                            <select class="form-select" aria-label="Default select example" required name="departement_resp_cfp" id="departement_resp_cfp">
                                <option value="null" disabled selected hidden>Veuillez Sélectionner</option>
                                @foreach ($departements as $depart)
                                <option value="{{$depart->id}}">{{$depart->nom_departement}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlInput1" class="form-control-placeholder" align="left">Poste</label>
                        <input type="text" name="poste_resp_cfp" class="form-control" id="poste_resp_cfp" />
                    </div>


                    <input type="button" name="previous" class="previous action-button"  value="Précendent" />
                    <input type="button" name="make_payment" class="next action-button"  value="Suivant" />
                </fieldset>

                <fieldset class="shadow p-3 mb-5 bg-body rounded">
                    <h5 class="">Après avoir remplir notre condition,vous pouvez maitenant activier votre.</strong></h5>
                    <h6>Avant d'activer votre,veuillez bien revérifier votre données!</h6>
                    <input type="button" name="previous" class="previous action-button"  value="Précendent" />
                    <button type="submit" class="action-button">Activation</button>
                </fieldset>

            </div>


        </form>

    </div>
</div>

@endsection
@extends('create_compte.footer')
