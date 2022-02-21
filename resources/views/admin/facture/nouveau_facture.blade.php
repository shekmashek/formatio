@extends('./layouts/admin')
@section('content')

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


<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                <li class="nav-item">
                                    <a class="nav-link  {{ Route::currentRouteNamed('liste_facture') || Route::currentRouteNamed('liste_facture') ? 'active' : '' }}" href="{{route('liste_facture')}}">
                                        <i class="fa fa-list">Liste des Factures</i></a>
                                </li>
                                @canany(['isSuperAdmin','isCFP'])
                                <li class="nav-item">
                                    <a class="nav-link  {{ Route::currentRouteNamed('facture') ? 'active' : '' }}" href="{{route('facture')}}">
                                        <i class="fa fa-plus">Nouveau Facture</i></a>
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
                                        <label for="exampleFormControlInput1" class="form-label">Entreprise à facturer<strong style="color:#ff0000;">*</strong></label>
                                        <select class="form-select" aria-label="Default select example" name="entreprise_id" id="entreprise_id">
                                            <option selected>choisir l'entreprise à facturer.....</option>
                                            @foreach ($entreprise as $tp)
                                            <option value="{{$tp->id}}">{{$tp->nom_etp}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" class="form-label">Sur le project<strong style="color:#ff0000;">*</strong></label>
                                        <select class="form-select" aria-label="Default select example" name="projet_id" id="projet_id">
                                        </select>
                                        <span style="color:#ff0000;" id="projet_id_err">Aucun projet a été détecter</span>
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
                                        <input type="text" required name="num_facture" class="form-control  input_inscription" id="num_facture" />
                                        <label for="num_facture" class="form-control-placeholder">Numéro de facture<strong style="color:#ff0000;">*</strong></label>
                                        <span style="color:#ff0000;" id="num_facture_err"></span>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" required class="form-control input_inscription reference_bc" id="reference_bc" name="reference_bc">
                                        <label for="reference_bc" class="form-control-placeholder">Reference Bon de Commande<strong style="color:#ff0000;">*</strong></label>
                                        @error('reference_bc')
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                        @enderror
                                        <span style="color:#ff0000;" id="reference_bc_err"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    {{-- <div class="form-group"> --}}
                                    <label align="left" for="down_bc" class="form-label">
                                        Upload Bon de Commande(Format pdf :maximum 1.5M.0)<strong style="color:#ff0000;">*</strong>
                                    </label>
                                    <input type="file" class="form-control" id="down_bc" name="down_bc">
                                    @error('down_bc')
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                    @enderror
                                    {{-- </div> --}}
                                </div>
                                <div class="col">
                                    {{-- <div class="form-group"> --}}
                                    <label align="left" for="down_bc" class="form-label">Upload Devis(Format pdf :maximum 1.5M.0)<strong style="color:#ff0000;">*</strong></label>
                                    <input type="file" class="form-control" id="down_fa" name="down_fa">
                                    @error('down_fa')
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                    @enderror
                                    {{-- </div> --}}
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
                                        <label for="invoice_date" class="form-label">Date création Facture<strong style="color:#ff0000;">*</strong></label>
                                        <input type="date" required class="form-control input_inscription" id="exampleFormControlInput1" placeholder="Invoice Date" name="invoice_date" id="invoice_date">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="due_date" class="form-label">Durer de Date<strong style="color:#ff0000;">*</strong></label>
                                        <input type="date" required class="form-control input_inscription" placeholder="Due Date" name="due_date" id="due_date">
                                    </div>
                                </div>
                            </div>


                            <input type="button" name="previous" class="previous action-button" value="Précedent" />
                            <input type="button" name="next" class="next action-button" value="Suivant" />

                        </fieldset>

                        {{-- etape 4 --}}

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            <h4 align="left" class="mb-2">Mode de paiement:</h4>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" class="form-label">Type Facture<strong style="color:#ff0000;">*</strong></label>
                                        <select class="form-select" aria-label="Default select example" name="type_facture" id="type_facture">
                                            @foreach ($type_facture as $tp)
                                            <option value="{{$tp->id}}">{{$tp->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" class="form-label">Choisir mode de type de payement<strong style="color:#ff0000;">*</strong></label>
                                        <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="id_mode_financement">
                                            @foreach ($mode_payement as $type)
                                            <option value="{{$type->id}}">{{$type->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class='col'>
                                    <div class="form-group">
                                        <label for="exampleFormControlInput1" class="form-label">Tax<strong style="color:#ff0000;">*</strong></label>
                                        <select class="form-select" aria-label="Default select example" name="tax_id" id="tax_id">
                                            @foreach ($taxe as $t)
                                            <option value="{{$t->id}}">{{$t->description}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class='col'>
                                    <label for="exampleFormControlInput1" class="form-label">Choisir mode de financement<strong style="color:#ff0000;">*</strong></label>
                                    <select class="form-select form-select-md mb-3" aria-label=".form-select-lg example" name="id_type_payement">
                                        @foreach ($typePayement as $type)
                                        <option value="{{$type->id}}">{{$type->type}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <input type="button" name="previous" class="previous action-button" value="Précendent" />
                            <input type="button" name="make_payment" class="next action-button" value="Suivant" />
                        </fieldset>

                        {{-- etpate 5 --}}

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            <h4 align="left" class="mb-2">Frais:</h4>

                            {{-- <div style="background-color: rgb(214, 218, 214);"> --}}
                            <div class="row">
                                <div class="col-md-3 justify-content-text">
                                    <h4 align="left" class="my-2">Frais pédagogique:</h4>
                                </div>
                                <div class="col-md-2">
                                    <button id="addRowMontant" type="button" class="btn btn-success"><i class="fa fa-plus">montant(click)</i></button>
                                </div>
                                <div class="col-md-7">

                                </div>
                            </div>

                            <div class="row mt-1 mb-3">
                                <div id="newRowMontant"></div>
                            </div>

                        {{-- </div> --}}

                            <hr style="border: 2px solid black;">


                            <div class="row mt-5">
                                <div class="col-md-3 justify-content-text">
                                    <h4 align="left" class="my-2">Frais annexe:</h4>
                                </div>
                                <div class="col-auto">
                                    <button id="addRow" type="button" class="btn btn-info"><i class="fa fa-plus">frais annexe(click)</i></button>
                                </div>
                                {{-- <div class="col-md-7"></div> --}}
                            </div>

                            <div class="row my-1">
                                <div id="newRow"></div>
                            </div>

                            <hr style="border: 2px solid black;">

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="remise" class="form-label">Remise</label>
                                        <input type="number" min="0" value="0" placeholder="remise(facultatif)" class="form-control input_inscription" name="remise" id="remise">
                                    </div>
                                </div>

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="other_message" class="form-label">Other Message</label>
                                        <textarea class="form-control" placeholder="'votre commentaire ou description'" id="other_message" rows="3" name="other_message"></textarea>
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
                                {{-- </div> --}}
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
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeSelect">Type frais annexe<strong style="color: red">*</strong> </label>';
                html += '<select class="form-select mt-1" id="frais" name="frais_annexe_id[]" id="specificSizeSelect">';

                for (var $i = 0; $i < userData.length; $i++) {
                    html += '<option value="' + userData[$i].id + '">' + userData[$i].description + '</option>';
                }
                html += '</select></div>';
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeInputName">PU(Ariary)<strong style="color: red">*</strong></label>';
                html += '<input type="number" min="0" value="0" name="montant_frais_annexe[]" class="form-control" id="specificSizeInputName" placeholder="0"></div>';
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeInputName">Description</label>';
                html += '<input type="text" name="description_annexe[]" class="form-control" id="specificSizeInputName" placeholder="description"></div>';
                html += '<div class="col-auto"><div class="input-group-append">';
                html += '<label class="visually" for="specificSizeInputName">Qte<strong style="color: red">*</strong></label>';
                html += '<input type="number" min="1" value="1" name="qte_annexe[]" class="form-control" id="specificSizeInputName" placeholder="1"></div></div>';
                html += '<div class="col-auto">';
                html += '<button id="removeRow" type="button" class="btn btn-danger"  style="position:relative; top: 2.3rem"><i class="fa fa-trash"></i></button>';
                html += '</div>';
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
                id: id,
                entreprise_id: etp_id
            }
            , success: function(response) {
                var userData = response;

                var html = '';
                html += '<div class="row justify-content" id="inputFormRowMontant">';
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeSelect">Choisir la Session a Facturé<strong style="color: red">*</strong></label>';
                html += '<select id="session_id" class="form-control mt-1" name="session_id[]">';
                for (var $i = 0; $i < userData.length; $i++) {
                    html += '<option value="' + userData[$i].groupe_id + '">' + userData[$i].nom_groupe + '</option>';
                }
                html += '</select></div>';
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeInputName">PU(Ariary)<strong style="color: red">*</strong></label>';
                html += '<input type="number" min="0" value="0" name="facture[]" class="form-control" id="specificSizeInputName" placeholder="0"></div>';
                html += '<div class="col">';
                html += '<label class="visually" for="specificSizeInputName">Description</label>';
                html += '<input type="text" name="description[]" class="form-control" id="specificSizeInputName" placeholder="description"></div>';
                html += '<div class="col-auto"><div class="input-group-append">';
                html += '<label class="visually" for="specificSizeInputName">Qte<strong style="color: red">*</strong></label>';
                html += '<input type="number" min="1" value="1" name="qte[]" class="form-control" id="specificSizeInputName" placeholder="1"></div>';
                html += '</div>';
                html += '<div class="col-auto"><div class="input-group-append">';
                html += '<button id="removeRowMontant" type="button" class="btn btn-danger" style="position:relative; top: 2.3rem"><i class="fa fa-trash"></i></button>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div><br>';

                $('#newRowMontant').append(html);


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
