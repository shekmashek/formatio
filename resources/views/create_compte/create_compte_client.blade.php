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

                        <div class="row">
                            <div class="col">
                                <label for="exampleFormControlInput1" class="form-label">Non<strong style="color:#ff0000;">*</strong></label>
                                <input type="text" name="name_entreprise" class="form-control" id="name_entreprise_search" />
                                <span style="color:#ff0000;" id="num_facture_err"></span>
                            </div>
                        </div>

                        <input type="button" name="next" class="next action-button" style="background-color: red" value="Suivant" />
                    </fieldset>

                    <fieldset class="shadow p-3 mb-5 bg-body rounded">
                        <h3 class="">Veuillez entrer votre fonction</strong></h3>
                        <p>votre fonction dans l'entreprise</p>

                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="function_resp" class="form-control" id="function_resp" />
                        </div>
                        <input type="button" name="previous" class="previous action-button-previous" style="background-color: red" value="Précedent" />
                        <input type="button" name="next" class="next action-button" style="background-color: red" value="Suivant" />
                    </fieldset>

                    <fieldset class="shadow p-3 mb-5 bg-body rounded">
                        <h3 class="">Veuillez certifier vos information</strong></h3>

                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label " align="left">Non<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="nom_resp" class="form-control" id="nom_resp" />
                        </div>
                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label" align="left">Prénom<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" required name="prenom_resp" class="form-control" id="prenom_resp" />
                        </div>
                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label" align="left">Email<strong style="color:#ff0000;">*</strong></label>
                            <input type="email" required name="email_resp" class="form-control" id="email_resp" />
                        </div>
                        <div class="form-ground">
                            <label for="exampleFormControlInput1" class="form-label" align="left">Téléphone<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" max=10 required name="tel_resp" class="form-control" id="tel_resp" />
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
