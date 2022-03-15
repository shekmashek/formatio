@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('css/facture.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControlFactures.css')}}">
<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                <li class="nav-item btn_next">
                                    <a class="nav-link  {{ Route::currentRouteNamed('liste_facture',2) || Route::currentRouteNamed('liste_facture',2) ? 'active' : '' }}" href="{{route('liste_facture',2)}}">Liste des Factures</a>
                                </li>
                                @canany(['isSuperAdmin','isCFP'])
                                <li class="nav-item btn_next">
                                    <a class="nav-link  {{ Route::currentRouteNamed('facture') ? 'active' : '' }}" href="{{route('facture')}}">Nouveau Facture</a>
                                </li>
                                @endcanany
                            </ul>

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2><strong>Creation facture</strong></h2>
                <p>Assistant de création de facture</p>

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
                @if(Session::has('error_facture'))
                <div class="alert alert-danger">
                    {{Session::get('error_facture')}}
                </div>
                @endif
                @error('invoice_date')
                <span style="color:#ff0000;"> {{$message}} </span>
                @enderror
                @error('due_date')
                <span style="color:#ff0000;"> {{$message}} </span>
                @enderror
                @if(Session::has('num_facture'))
                <div class="alert alert-danger">
                    {{Session::get('num_facture')}}
                </div>
                @endif
                @error('down_bc')
                <span style="color:#ff0000;"> {{$message}} </span>
                @enderror
                @error('down_fa')
                <span style="color:#ff0000;"> {{$message}} </span>
                @enderror
                @error('num_facture')
                <span style="color:#ff0000;"> {{$message}} </span>
                @enderror

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">

                <form action="{{route('create_facture')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
                    @csrf
                    <ul id="progressbars">
                        <li class="active" id="etape1"></li>
                        <li id="etape2"><strong></strong></li>
                        <li id="etape3"><strong></strong></li>
                        <li id="etape4"><strong></strong></li>
                        <li id="etape5"><strong></strong></li>
                        <li id="etape6"><strong></strong></li>
                        {{-- <li class="active" id="etape1"><strong>Entreprise</strong></li>
                        <li id="etape2"><strong>numéro Facture</strong></li>
                        <li id="etape3"><strong>dates</strong></li>
                        <li id="etape4"><strong>mode de paiement</strong></li>
                        <li id="etape5"><strong>frais</strong></li>
                        <li id="etape6"><strong>sauvegarder</strong></li> --}}
                    </ul>

                    {{-- <ul id="progressbar">
                        <li class="active" id="personal"><strong>Entreprise</strong></li>
                        <li id="account"><strong>numéro Facture</strong></li>
                        <li id="personal"><strong>dates</strong></li>
                        <li id="payment"><strong>mode de paiement</strong></li>
                        <li id="payment"><strong>frais</strong></li>
                        <li id="confirm"><strong>sauvegarder</strong></li>
                    </ul> --}}

                    <div id="formulaire">

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            {{-- <div class="form-card"> --}}
                            <h4 align="left" class="mb-2">Choisir l'entreprise à facturer:</h4>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-select selectP input" id="entreprise_id" name="entreprise_id" aria-label="Default select example">
                                            <option onselected>Choisir l'entreprise à facturer...</option>
                                            @foreach ($entreprise as $tp)
                                            <option value="{{$tp->id}}">{{$tp->nom_etp}}</option>
                                            @endforeach
                                        </select>
                                        <label class="ml-3 form-control-placeholder" for="formation_id">Entreprise à
                                            facturer<strong style="color:#ff0000;">*</strong></label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-select selectP input" id="projet_id" name="projet_id" aria-label="Default select example">
                                        </select>
                                        <label class="ml-3 form-control-placeholder" for="formation_id">Sur le
                                            project<strong style="color:#ff0000;">*</strong></label>
                                        <span style="color:#ff0000;" id="projet_id_err">Aucun projet a été
                                            détecter</span>
                                    </div>
                                </div>
                            </div>

                            <input type="button" name="next" class="next action-button" value="Suivant" />
                        </fieldset>

                        {{-- etape 2 --}}

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            <h4 align="left" class="my-2">Inserer Invoice Number</h4>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" id="min" class="form-control input" name="num_facture" required>
                                        <label class="form-control-placeholder" for="min">Numéro de
                                            facture<strong style="color:#ff0000;">*</strong></label>
                                        <span style="color:#ff0000;" id="num_facture_err"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" required class="form-control input reference_bc" id="reference_bc" name="reference_bc">
                                        <label for="reference_bc" class="form-control-placeholder">Reference Bon de
                                            Commande<strong style="color:#ff0000;">*</strong></label>
                                        @error('reference_bc')
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                        @enderror
                                        <span style="color:#ff0000;" id="reference_bc_err"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    {{-- <div class="form-group"> --}}
                                    <label align="left" for="down_bc" class="form-label">
                                        Upload Bon de Commande(Format pdf :maximum 1.5M.0)<strong style="color:#ff0000;">*</strong>
                                    </label>
                                    <input type="file" class="form-control" id="down_bc" name="down_bc">
                                    @error('down_bc')
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                    @enderror
                                    {{--
                                    </div> --}}
                                </div>
                                <div class="col">
                                    {{-- <div class="form-group"> --}}
                                    <label align="left" for="down_bc" class="form-label">Upload Devis(Format pdf
                                        :maximum 1.5M.0)<strong style="color:#ff0000;">*</strong></label>
                                    <input type="file" class="form-control " id="down_fa" name="down_fa">
                                    @error('down_fa')
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                    @enderror
                                    {{--
                                    </div> --}}
                                </div>
                            </div>



                            <input type="button" name="previous" class="previous action-button" value="Précendent" />
                            <input type="button" name="next" class="next action-button" value="Suivant" />
                        </fieldset>

                        {{-- etape 3 --}}

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            <h4 align="left" class="mb-2">Inserer les dates:</h4>

                            <div class="row">

                                <div class="col">
                                    <div class="form-group">

                                        <input type="text" required class="form-control input" id="exampleFormControlInput1" name="invoice_date" id="invoice_date" onfocus="(this.type='date')">
                                        <label for="invoice_date" class="form-control-placeholder">Date création Facture<strong style="color:#ff0000;">*</strong></label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">

                                        <input type="text" required class="form-control input" name="due_date" id="due_date" onfocus="(this.type='date')">
                                        <label for="due_date" class="form-control-placeholder">Durer de Date<strong style="color:#ff0000;">*</strong></label>
                                    </div>
                                </div>
                            </div>


                            <input type="button" name="previous" class="previous action-button" value="Précedent" />
                            <input type="button" name="next" class="next action-button" value="Suivant" />

                        </fieldset>

                        {{-- etape 4 --}}

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            <h4 align="left" class="mb-3">Mode de paiement:</h4>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <select class="form-select input" aria-label="Default select" name="type_facture" id="type_facture">
                                            @foreach ($type_facture as $tp)
                                            <option value="{{$tp->id}}">{{$tp->description}}</option>
                                            @endforeach
                                        </select>
                                        <label for="exampleFormControlInput1" class="form-control-placeholder">Type Facture<strong style="color:#ff0000;">*</strong></label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">

                                        <select class="form-select input" aria-label=".form-select-lg example" name="id_mode_financement">
                                            @foreach ($mode_payement as $type)
                                            <option value="{{$type->id}}">{{$type->description}}</option>
                                            @endforeach
                                        </select>
                                        <label for="exampleFormControlInput1" class="form-control-placeholder">Choisir mode de type de
                                            payement<strong style="color:#ff0000;">*</strong></label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class='col'>
                                    <div class="form-group">

                                        <select class="form-select input" aria-label="Default select example" name="tax_id" id="tax_id">
                                            @foreach ($taxe as $t)
                                            <option value="{{$t->id}}">{{$t->description}}</option>
                                            @endforeach
                                        </select>
                                        <label for="exampleFormControlInput1" class="form-control-placeholder">Tax<strong style="color:#ff0000;">*</strong></label>
                                    </div>
                                </div>
                                <div class='col'>

                                    <select class="form-select form-select-md input" aria-label="form-select-lg example" name="id_type_payement">
                                        @foreach ($typePayement as $type)
                                        <option value="{{$type->id}}">{{$type->type}}</option>
                                        @endforeach
                                    </select>
                                    <label for="exampleFormControlInput1" class="form-control-placeholder">Choisir mode de
                                        financement<strong style="color:#ff0000;">*</strong></label>
                                </div>

                            </div>

                            <input type="button" name="previous" class="previous action-button" value="Précendent" />
                            <input type="button" name="make_payment" class="next action-button" value="Suivant" />
                        </fieldset>

                        {{-- etpate 5 --}}

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            <h4 align="left" class="mb-2">Frais:</h4>
                                 <div class="row">
                                <div class="col-md-3 justify-content-text">
                                    <h4 align="left" class="my-2">Frais pédagogique:</h4>
                                </div>
                                <div class="col-md-2">
                                    <button id="addRowMontant" type="button" class="btn btn_next"> <i class="bx bx-plus"></i> Ajout montant</button>
                                </div>
                                <div class="col-md-7"></div>
                            </div>

                            <div class="row mt-1 mb-3">
                                <div id="newRowMontant"></div>
                            </div>
                            <hr style="border: 2px solid black;">
                            <div class="row mt-5">
                                <div class="col-md-3 justify-content-text">
                                    <h4 align="left" class="my-2">Frais annexe:</h4>
                                </div>
                                <div class="col-auto">
                                    <button id="addRow" type="button" class="btn btn_next"> <i class="bx bx-plus"></i> Ajout frais Annexe</button>
                                </div>
                            </div>

                            <div class="row my-1">
                                <div id="newRow"></div>
                            </div>

                            <hr style="border: 2px solid black;">

                            <div class="row mt-2">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input type="number" min="0" value="0" placeholder="remise(facultatif)" class="form-control input" name="remise" id="remise">
                                        <label for="remise" class="form-control-placeholder">Remise</label>
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <textarea class="form-control text_area pt-2" placeholder="'votre commentaire ou description'" id="other_message" name="other_message" style="height: 80px !important;"></textarea>
                                        <label for="other_message" class="form-control-placeholder-text_area">Other Message</label>
                                    </div>
                                </div>
                            </div>

                            <input type="button" name="previous" class="previous action-button" value="Précendent" />
                            <input type="button" name="next" class="next action-button" value="Suivant" />
                        </fieldset>

                        {{-- etpate 6 --}}

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            {{-- <div class="form-card"> --}}
                            <h2 class="fs-title text-center">Bravo ! les champs sont complet</h2> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-3">
                                    <div class="form-group">
                                        <img src="{{asset('img_create-compte/terminer.png')}}" class="fit-image" style="width: 300px; heigth: 300px">
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <input type="button" name="previous" class="previous action-button" value="Précendent" />
                                        <input type="submit" class="next action-button" value="Sauvegarder" />
                                    </div>
                                </div>
                                {{--
                                </div> --}}
                        </fieldset>


                    </div>
                </form>

            </div>
        </div>

    </div>




</div>


@endsection



<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('js/facture.js')}}"></script>

<script type="text/javascript">
    // ========= show facture existe déjà
    $(document).on('change', '#num_facture', function() {
        var num_facture = $(this).val();
        $.ajax({
            url: '{{route("verifyFacture")}}'
            , type: 'get'
            , data: {
                num_facture: num_facture
            }
            , success: function(response) {
                var userData = response;

                if (userData.length > 0) {
                    document.getElementById("num_facture_err").innerHTML = "Numero Facture est déjà utiliser!";
                } else {
                    document.getElementById("num_facture_err").innerHTML = "";
                }

            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

    // ========= show reference bon de commande existe déjà
    $(document).on('change', '#reference_bc', function() {
        var reference_bc = $(this).val();
        $.ajax({
            url: '{{route("verifyReferenceBC")}}'
            , type: 'get'
            , data: {
                reference_bc: reference_bc
            }
            , success: function(response) {
                var userData = response;
                if (userData.length > 0) {
                    document.getElementById("reference_bc_err").innerHTML = "Reference Bon de commande est déjà utiliser!";
                } else {
                    document.getElementById("reference_bc_err").innerHTML = "";
                }

            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

    // ======== show entreprise
    $(document).on('change', '#entreprise_id', function() {
        $("#projet_id").empty();
        var id = $(this).val();
        $.ajax({
            url: 'projetFacturer'
            , type: 'get'
            , data: {
                id: id
            }
            , success: function(response) {
                var userData = response;
                if (userData.length <= 0) {
                    // $("#projet_id_err").val("Aucun projet a été détecter");
                    document.getElementById("projet_id_err").innerHTML = "Aucun projet a été détecter";
                } else {
                    document.getElementById("projet_id_err").innerHTML = "";
                    for (var $i = 0; $i < userData.length; $i++) {
                        $("#projet_id").append('<option value="' + userData[$i].projet_id + '">' + userData[$i].nom_projet + '</option>');
                    }
                }

            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

    // add row
    $(document).on('click', '#addRow', function() {
        $('#frais').empty();
        $.ajax({
            url: "{{route('frais_annexe')}}"
            , type: 'get'
            , success: function(response) {

                var userData = response;
                for (var $i = 0; $i < userData.length; $i++) {
                    $("#frais").append('<option value="' + userData[$i].id + '">' + JSON.stringify(userData[$i].description) + '</option>');
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });

        $.ajax({
            url: "{{route('frais_annexe')}}"
            , type: 'get'
            , success: function(response) {
                var userData = response;
                var html = '';


                html += '<div class="row justify-content" id="inputFormRow">';
                html += '<div class="col"><div class="form-group">';
                html += '<select class="form-select selectP input"  id="frais_annexe_id[]" name="frais_annexe_id[]">';

                for (var $i = 0; $i < userData.length; $i++) {
                    html += '<option value="' + userData[$i].id + '">' + userData[$i].description + '</option>';
                }
                html += '</select>';
                html += '<label class="ml-3 form-control-placeholder" for="frais_annexe_id[]">Type frais annexe<strong style="color: red">*</strong> </label>';
                html += '</div></div>';


                html += '<div class="col"><div class="form-group">';
                html += '<input type="number" min="0" value="0" name="montant_frais_annexe[]" class="form-control input" id="montant_frais_annexe[]" placeholder="0">';
                html += ' <label for="montant_frais_annexe[]" class="form-control-placeholder">PU(Ariary)<strong style="color:#ff0000;">*</strong></label>';
                html += '</div></div>';


                html += '<div class="col"><div class="form-group">';
                html += '<input type="text" name="description_annexe[]" class="form-control input" id="description_annexe[]" placeholder="description">';
                html += '<label class="form-control-placeholder" for="description_annexe[]">Description</label>';
                html += '</div></div>';

                html += '<div class="col-auto" style="display: grid; place-content: center; width: 120px; "><div class="form-group">';
                html += '<input type="number" min="1" value="2" required class="form-control input" name="qte_annexe[]" id="qte_annexe[]">';
                html += '<label class="form-control-placeholder" for="qte_annexe[]">Qte<strong style="color: red">*</strong></label>';
                html += '</div></div>';

                html += '<div class="col-auto justify-center"><div class="form-group">';
                html += '<button id="removeRow" type="button" class="btn btn-danger"  style="position:relative; top: 2.3rem"><i class="fa fa-trash"></i></button>';
                html += '</div></div>';
                html += '</div><br>';

                $('#newRow').append(html);


            }
            , error: function(error) {
                console.log(error);
            }
        });


    });

    // remove row
    $(document).on('click', '#removeRow', function() {
        $(this).closest('#inputFormRow').remove();
    });


    // ============================ Montant=========================

    $(document).on('click', '#addRowMontant', function() {
        $('#montant').empty();
        var id = $("#projet_id").val();
        var etp_id = $("#entreprise_id").val();

        $.ajax({
            url: "{{route('groupe_projet')}}"
            , type: 'get'
            , data: {
                id: id
                , entreprise_id: etp_id
            }
            , success: function(response) {
                var userData = response;
                var html = '';


                html += '<div class="row justify-content" id="inputFormRowMontant">';
                html += '<div class="col"><div class="form-group">';
                html += '<select class="form-select selectP input"  id="session_id[]" name="session_id[]">';

                for (var $i = 0; $i < userData.length; $i++) {
                    html += '<option value="' + userData[$i].groupe_id + '">' + userData[$i].nom_groupe + '</option>';
                }
                html += '</select>';
                html += '<label class="ml-3 form-control-placeholder" for="session_id[]">Type frais annexe<strong style="color: red">*</strong> </label>';
                html += '</div></div>';


                html += '<div class="col"><div class="form-group">';
                html += '<input type="number" min="0" value="0" name="facture[]" class="form-control input" id="facture[]" placeholder="0">';
                html += ' <label for="facture[]" class="form-control-placeholder">PU(Ariary)<strong style="color:#ff0000;">*</strong></label>';
                html += '</div></div>';


                html += '<div class="col"><div class="form-group">';
                html += '<input type="text" name="description[]" class="form-control input" id="description[]" placeholder="description">';
                html += '<label class="form-control-placeholder" for="description[]">Description</label>';
                html += '</div></div>';

                html += '<div class="col-auto"><div class="form-group">';
                html += '<input type="number" min="1" value="2" required class="form-control input" name="qte[]" id="qte[]">';
                html += '<label class="form-control-placeholder" for="qte[]">Qte<strong style="color: red">*</strong></label>';
                html += '</div></div>';

                html += '<div class="col-auto"><div class="input-group-append">';
                html += '<button id="removeRowMontant" type="button" class="btn btn-danger" style="position:relative; top: 2.3rem"><i class="fa fa-trash"></i></button>';
                html += '</div></div>';
                html += '</div>';
                html += '</div><br>';

                $('#newRowMontant').append(html);

/*
                          var userData = response;

                var html = '';
                html += '<div class="row justify-content" id="inputFormRowMontant">';
                html += '<div class="col"><div class="form-group>';
                html += '<select id="session_id[]" class="form-select selectP input" name="session_id[]">';
                for (var $i = 0; $i < userData.length; $i++) {
                    html += '<option value="' + userData[$i].groupe_id + '">' + userData[$i].nom_groupe + '</option>';
                }
                html += '</select>';
                html += '<label class="ml-3 form-control-placeholder" for="session_id[]">Choisir la Session a Facturé<strong style="color: red">*</strong></label>';
                html += '</div></div>';

                html += '<div class="col"><div class="form-group>';
                html += '<input required type="number" min="0" value="0" name="facture[]" class="form-control input" id="facture[]" placeholder="0">';
                html += '<label class="ml-3 form-control-placeholder" for="facture[]">PU(Ariary)<strong style="color: red">*</strong></label>';
                html += '</div></div>';

                html += '<div class="col"><div class="form-group>';
                html += '<input type="text" name="description[]" class="form-control input" id="description[]" placeholder="description">';
                html += '<label class="ml-3 form-control-placeholder" for="description[]">Description</label>';
                html += '</div></div>';

                html += '<div class="col-auto"><div class="form-group">';
                html += '<input required type="number" min="1" value="1" name="qte[]" class="form-control input" id="qte[]" placeholder="1">';
                html += '<label class="ml-3 form-control-placeholder" for="qte[]">Qte<strong style="color: red">*</strong></label>';
                html += '</div></div>';

                html += '<div class="col-auto"><div class="input-group-append">';
                html += '<button id="removeRowMontant" type="button" class="btn btn-danger" style="position:relative; top: 2.3rem"><i class="fa fa-trash"></i></button>';
                html += '</div></div>';
                html += '</div><br>';

                $('#newRowMontant').append(html);
*/

            }
            , error: function(error) {
                console.log(error);
            }
        });


    });

    // remove row
    $(document).on('click', '#removeRowMontant', function() {
        $(this).closest('#inputFormRowMontant').remove();
    });

</script>
