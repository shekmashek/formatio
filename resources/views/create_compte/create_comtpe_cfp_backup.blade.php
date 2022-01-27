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
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <form action="{{route('create_compte_cfp')}}" id="msform" method="POST" enctype="multipart/form-data">
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

                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Non<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" name="name_cfp" class="form-control" id="name_cfp" />
                                <span style="color:#ff0000;" id="num_facture_err"></span>
                            </div>
                        </div>

                        <input type="button" name="next" class="next action-button" style="background-color: red" value="Suivant" />
                    </fieldset>

                    <fieldset class="shadow p-3 mb-5 bg-body rounded">
                        <h3 class="">Veuillez entrer vos information l'egale</strong></h3>

                        <label for="exampleFormControlInput1" class="form-label">NIF<strong style="color:#ff0000;">*</strong></label>
                        <input type="text" name="nif" required class="form-control" id="name_entreprise" />
                        <label for="exampleFormControlInput1" required class="form-label">STAT<strong style="color:#ff0000;">*</strong></label>
                        <input type="text" name="stat" required class="form-control" id="name_entreprise" />
                        <label for="exampleFormControlInput1" required class="form-label">RCS<strong style="color:#ff0000;">*</strong></label>
                        <input type="text" name="rcs" required class="form-control" id="name_entreprise" />
                        <label for="exampleFormControlInput1" required class="form-label">CIF<strong style="color:#ff0000;">*</strong></label>
                        <input type="text" name="cif" required class="form-control" id="name_entreprise" />

                        <input type="button" name="previous" class="previous action-button-previous" style="background-color: red" value="Précedent" />
                        <input type="button" name="next" class="next action-button" style="background-color: red" value="Suivant" />

                    </fieldset>

                    <fieldset class="shadow p-3 mb-5 bg-body rounded">
                        <h3 class="">Veuillez entrer vos information personnel</strong></h3>

                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label" align="left">Domaine<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="domaine_cfp" class="form-control" id="domaine_cfp" />
                        </div>

                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label" align="left">Lot<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="lot" class="form-control" id="lot" />
                        </div>

                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label" align="left">Ville<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="ville" class="form-control" id="ville" />
                        </div>

                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label" align="left">Région<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="region" class="form-control" id="region" />
                        </div>

                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label" align="left">Email<strong style="color:#ff0000;">*</strong></label>
                            <input type="email" required name="email_cfp" class="form-control" id="email_cfp" />
                        </div>
                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label" align="left">Téléphone<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" max=10 required name="tel_cfp" class="form-control" id="tel_cfp" />
                        </div>
                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label" align="left">Web</label>
                            <input type="text" name="web_cfp" class="form-control" id="web_cfp" />
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

        <div class="col-md-3"></div>
    </div>
</div>

@endsection
@extends('create_compte.footer')
