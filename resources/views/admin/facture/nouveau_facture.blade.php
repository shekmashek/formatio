@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Nouveau facture</p>
@endsection
@section('content')
{{--<link rel="stylesheet" href="{{asset('css/facture.css')}}"> --}}
{{-- https://www.youtube.com/watch?v=RBeqKYsw7CQ  link template facture videos youtube --}}
<link rel="stylesheet" href="{{asset('assets/css/facture_new.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControlFactures.css')}}">
<div class="container mb-5 mt-5">
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
    <form action="{{route('create_facture')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <section class="section1 mb-4">
                <div class="row">
                    <div class="col-6">
                        <h2>Nouvelle facture</h2>
                    </div>
                    <div class="col-6 text-end">
                        <input type="submit" class="btn btn_submit" value="Enregistrer et continuer">
                    </div>
                </div>
            </section>
            <section class="section2 mb-4">
                <div class="row header_facture">
                    <h6 class="mb-0 changer_carret d-flex pt-2 justify-content-between" data-bs-toggle="collapse" href="#titre" aria-expanded="true" aria-controls="collapseprojet">
                        Adresse et coordonnées de l'entreprise, titre, résumé et logo
                        <i class="bx bx-caret-down carret-icon text-end"></i>
                    </h6>
                    <div class="col-12 collapse" id="titre">
                        <div class="row p-2">
                            <div class="col-4">
                                <img src="{{asset('images/CFP/'.$cfp->logo)}}" alt="logo_cfp" class="img-fluid">
                            </div>
                            <div class="col-8 text-end" align="rigth">
                                <select class="text-end titre_facture form-select  mb-2 m-0" id="type_facture" name="type_facture" aria-label="Default select example" required>
                                    <option onselected hidden> Type de Facture...</option>
                                    @foreach ($type_facture as $tp_fact)
                                    <option value="{{$tp_fact->id}}">{{$tp_fact->reference}}</option>
                                    @endforeach
                                </select>
                                <select class="text-end titre_facture form-select  mb-2 m-0" id="id_mode_financement" name="id_mode_financement" aria-label="Default select example" required>
                                    <option onselected hidden> Mode de payement...</option>
                                    @foreach ($mode_payement as $mod)
                                    <option value="{{$mod->id}}">{{$mod->description}}</option>
                                    @endforeach
                                </select>

                                <input type="text" name="description_facture" id="description_facture" class="text-end description_facture" placeholder="Déscription du facture">
                                <div class="info_cfp">
                                    <p class="m-0 nom_cfp">{{$cfp->nom}}</p>
                                    <p class="m-0 adresse_cfp">{{$cfp->adresse_lot." ".$cfp->adresse_quartier}}</p>
                                    <p class="m-0 adresse_cfp">{{$cfp->adresse_ville." ".$cfp->adresse_code_postal}}</p>
                                    <p class="m-0 adresse_cfp">{{$cfp->adresse_region}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section3">
                <div class="row entreprise_facturer">
                    <div class="col-6 p-4">
                        <h6>Facturer à</h6>
                        <div class="form-group">
                            <select class="form-select selectP input_entreprise mb-2" id="entreprise_id" name="entreprise_id" aria-label="Default select example" required>
                                <option onselected hidden> Ajouter l'entreprise à facturer...</option>
                                @foreach ($entreprise as $tp)
                                <option value="{{$tp->id}}">{{$tp->nom_etp}}</option>
                                @endforeach
                            </select>
                            <div class="details">
                                <p class="m-0 nom_cfp" id="nom_etp_detail"></p>
                                <p class="m-0 " id="adresse_etp"></p>
                                <p class="mt-3 m-0 " id="tel_etp"></p>
                                <p class="m-0 " id="mail_etp"></p>
                                <p class="m-0 " id="site_etp"></p>
                                <p class="m-0 " id="info_légale_etp"></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 p-4">
                        <div class="row mb-2">
                            <div class="col-12 d-flex flex-row justify-content-end">
                                <p class="m-0 pt-3 text-end me-3">Numéro de facture</p> <input type="text" class="form-control input_simple" name="num_facture" required placeholder="reference du facture">
                                @error('num_facture')
                                <p> <span style="color:#ff0000;"> {{$message}} </span></p>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12 d-flex flex-row justify-content-end">
                                <p class="m-0 pt-3 text-end me-3">Reference de bon de commande</p> <input type="text" class="form-control input_simple reference_bc" name="reference_bc" id="reference_bc" required placeholder="reference du bon de commande">
                                @error('reference_bc')
                                <p> <span style="color:#ff0000;"> {{$message}} </span></p>
                                @enderror
                                <p> <span style="color:#ff0000;" id="reference_bc_err"></span></p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12 d-flex flex-row justify-content-end">
                                <p class="m-0 pt-3 text-end me-3">Date de facturation</p> <input type="date" class="form-control input_simple" name="invoice_date" id="invoice_date" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex flex-row justify-content-end">
                                <p class="m-0 pt-3 text-end me-3">Payement du</p> <input type="date" class="form-control input_simple" name="due_date" id="due_date" required>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section4 mb-4">
                <div class="row services_factures">
                    <div class="col-12 pb-4 element">
                        <div class="row titres_services">
                            <div class="col-3">
                                <h6 class="m-0">Choisit le projet</h6>
                            </div>
                            <div class="col-5">
                                <h6 class="m-0">Choisir votre session</h6>
                            </div>
                            <div class="col-1 text-end">
                                <h6 class="m-0">Entrer le quantité</h6>
                            </div>
                            <div class="col-2">
                                <h6 class="m-0">Entrer prix unitaire</h6>
                            </div>
                            <div class="col-1 text-end">
                                <h6 class="m-0"></h6>
                            </div>
                        </div>
                        <div class="row my-3">
                            <div class="col-3">
                                <select class="form-select selectP input_section4 mb-2" id="projet_id" name="projet_id" aria-label="Default select example" required>
                                </select>
                                <span style="color:#ff0000;" id="projet_id_err">Aucun projet a été
                                    détecter</span>
                            </div>
                            <div class="col-5">
                                <select class="form-select selectP input_section4 mb-2 session_id" id="session_id[]" name="session_id[]" aria-label="Default select example" required>
                                </select>
                                <span style="color:#ff0000;" id="session_id_err">Aucun session a été
                                    détecter</span>
                            </div>
                            {{-- <div class="col-3">
                            <p id="module_id_ref"></p>
                        </div> --}}
                            <div class="col-1">
                                <input type="number" name="qte[]" id="qte[]" min="1" value="1" class="form-control qte input_quantite" required>
                            </div>
                            <div class="col-2">
                                <input type="number" name="facture[]" min="0" value="0" id="facture[]" class=" somme_totale_montant facture form-control input_quantite2 montant_session_facture" required>
                            </div>
                            <div class="col-1 text-end pt-2">
                                {{-- <p class="m-0"><span id="montant_plus_qte">0</span>&nbsp;MGA</p> --}}
                            </div>
                        </div>



                        <div class="row">

                            <div id="newRowMontant"></div>

                            <div class="row mb-2">
                                <div class="col-9 d-flex flex-row justify-content-end">
                                    <p class="m-0 pt-3 text-end me-3">Taxe</p>
                                    <select class="form-select selectP input_tax calcule_pour_tax" aria-label="Default select example" name="tax_id" id="tax_id">
                                        @foreach ($taxe as $t)
                                        <option id="test_{{$t->id}}" value="{{$t->id}}" data-id={{$t->pourcent}}>{{$t->description}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3 text-end">
                                    {{-- <p class="m-0 pt-2"><span id="montant_tax" class="montant_session_facture">0</span>&nbsp;MGA<span><i class='bx bxs-trash ms-4'></i></span></p> --}}
                                </div>
                            </div>
                            {{-- <div class="row mb-2 g-0 p-2">
                                <div class="col-9 d-flex flex-row justify-content-end">
                                    <p class="m-0 text-end total">Total Montant Session</p>
                                </div>
                                <div class="col-3 text-end">
                                    <p class="pt-1 me-3 total">
                                        <span id="total_montant_session">0</span>&nbsp;MGA
                                    </p>
                                </div>
                            </div> --}}
                        </div>




                    </div>

                    <div class="row nouveau_service g-0">
                        <div class="col-12 py-2 text-center">

                            <span><a href="#" id="addRowMontant" value="0"><i class='bx bx-plus-medical me-2'></i> Ajouter une autre session</a></span>
                        </div>
                    </div>
                    <div class="col-12 pb-4 element">
                        <div class="row titres_services">
                            <div class="col-3">
                                <h6 class="m-0">Frais annexes</h6>
                            </div>
                            <div class="col-5">
                                <h6 class="m-0">Déscriptions</h6>
                            </div>
                            <div class="col-1 text-end">
                                <h6 class="m-0">Entrer le quantité</h6>
                            </div>
                            <div class="col-2">
                                <h6 class="m-0">Entrer prix unitaire</h6>
                            </div>
                            <div class="col-1 text-end">
                                <h6 class="m-0"></h6>
                            </div>
                        </div>

                        <div id="newRow"></div>

                        {{-- <div class="row my-1">


                            <div class="row mb-2 g-0 p-2">
                                <div class="col-9 d-flex flex-row justify-content-end">
                                    <p class="m-0 text-end total">Total Frais Annexe</p>
                                </div>
                                <div class="col-3 text-end">
                                    <p class="pt-1 me-3 total">
                                        <span id="total_frais_annexe">0</span>&nbsp;MGA
                                    </p>
                                </div>
                            </div>

                        </div> --}}

                    </div>
                    <div class="row nouveau_service g-0">
                        <div class="col-12 py-2 text-center">
                            <span> <a href="#" id="addRow" value="0"><i class='bx bx-plus-medical me-2'></i>Ajouter un ou des frais annexes(s)</a> </span>
                        </div>
                    </div>
                    {{-- <div class="row mb-2 g-0 p-2">
                        <div class="col-9 d-flex flex-row justify-content-end">
                            <p class="m-0 text-end pt-1"> Montant total</p>
                        </div>
                        <div class="col-3 text-end">
                            <p><span>0</span>&nbsp;MGA</p>
                        </div>
                    </div> --}}
                    <div class="row mb-2 g-0 p-2">
                        <div class="col-9 d-flex flex-row justify-content-end">
                            <p class="m-0 pt-3 text-end me-3">Remise</p> <input type="number" min="0" value="0" class="form-control input_tax" name="remise" id="remise">
                            <select class="form-select selectP input_select text-end ms-2" id="type_remise_id" name="type_remise_id" aria-label="Default select example">
                                @foreach ($type_remise as $re)
                                <option value="{{$re->id}}" selected>{{$re->description}}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="col-3 text-end">
                            {{-- <p><span id="montant_remise">0</span>&nbsp;MGA</p> --}}
                        </div>
                    </div>
                    {{-- <div class="row mb-2 g-0 p-2">
                        <div class="col-9 d-flex flex-row justify-content-end">
                            <p class="m-0 text-end total">Total</p>
                        </div>
                        <div class="col-3 text-end">
                            <p class="pt-1 me-3"><span class="total" id="total_montant_frais_annexe">0</span>&nbsp;MGA</p>
                        </div>
                    </div> --}}
                    <hr>
                    <div class="row mb-2 g-0">
                        <div class="col-12 ">
                            <h6 class="note_titre ms-2"><span> Notes et autres rémarques</span></h6>
                            <textarea name="other_message" id="other_message" class="notes_texte" placeholder="'Vos commentaires ou descriptions'"></textarea>
                        </div>
                    </div>
                </div>
            </section>
            <section class="section5 mb-4">
                <div class="row header_facture">
                    <h6 class="mb-0 changer_carret2 d-flex pt-2 justify-content-between" data-bs-toggle="collapse" href="#titre" aria-expanded="true" aria-controls="collapseprojet">
                        Informations légales
                        <i class="bx bx-caret-down carret-icon text-end"></i>
                    </h6>
                    <div class="col-12 collapse" id="titre">
                        <div class="row p-2 justify-content-center text-center">
                            <p>NIF: {{$cfp->nif}}&nbsp;&nbsp; STAT: {{$cfp->stat}}&nbsp;&nbsp; RCS: {{$cfp->rcs}} &nbsp;&nbsp; CIF: {{$cfp->cif}}</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </form>
</div>
{{-- <script src="{{asset('js/facture.js')}}"></script> --}}

<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('js/facture.js')}}"></script>
<script type="text/javascript">
    /*=========================================================*/
    $(document).ready(function() {
        $(".changer_carret").on("click", function() {
            if (
                $(this)
                .find(".carret-icon")
                .hasClass("bx-caret-down")
            ) {
                $(this)
                    .find(".carret-icon")
                    .removeClass("bx-caret-down")
                    .addClass("bx-caret-up");
            } else {
                $(this)
                    .find(".carret-icon")
                    .removeClass("bx-caret-up")
                    .addClass("bx-caret-down");
            }
        });

        $(".changer_carret2").on("click", function() {
            if (
                $(this)
                .find(".carret-icon")
                .hasClass("bx-caret-down")
            ) {
                $(this)
                    .find(".carret-icon")
                    .removeClass("bx-caret-down")
                    .addClass("bx-caret-up");
            } else {
                $(this)
                    .find(".carret-icon")
                    .removeClass("bx-caret-up")
                    .addClass("bx-caret-down");
            }
        });


    });



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
        $(".session_id").empty();

        var id = $(this).val();
        var prj_id = 0;
        $.ajax({
            url: 'projetFacturer'
            , type: 'get'
            , data: {
                id: id
            }
            , success: function(response) {
                var userData = response.projet;
                var etp = response.entreprise;

                if (etp != null) {
                    document.getElementById("nom_etp_detail").innerHTML = "" + etp.nom_etp;
                    document.getElementById("adresse_etp").innerHTML = "" + etp.adresse_rue + "&nbsp;" + etp.adresse_quartier + " <br> " + etp.adresse_ville + "&nbsp;" + etp.adresse_code_postal + " <br> " + etp.adresse_region;
                    document.getElementById("tel_etp").innerHTML = "" + etp.telephone_etp;
                    document.getElementById("mail_etp").innerHTML = "" + etp.email_etp;
                    document.getElementById("site_etp").innerHTML = "" + etp.site_etp;
                    document.getElementById("info_légale_etp").innerHTML = "NIF: " + etp.nif + " &nbsp; STAT: " + etp.stat + " &nbsp; <br> RCS: " + etp.rcs + " &nbsp; CIF: " + etp.cif;

                    if (userData.length <= 0) {
                        document.getElementById("projet_id_err").innerHTML = "Aucun projet a été détecter";
                    } else {
                        document.getElementById("projet_id_err").innerHTML = "";
                        for (var $i = 0; $i < (userData.length); $i++) {
                            $("#projet_id").append('<option value="' + userData[$i].projet_id + '">' + userData[$i].nom_projet + '</option>');
                        }
                        prj_id = $("#projet_id").val();

                        if (id != null && prj_id != null) {
                            $.ajax({
                                url: "{{route('groupe_projet')}}"
                                , type: 'get'
                                , data: {
                                    id: prj_id
                                    , entreprise_id: id
                                }
                                , success: function(response2) {
                                    var userData2 = response2;
                                    $("#addRowMontant").val(userData2.length);
                                    if ($("#addRowMontant").val() > 1) {
                                        $("#addRowMontant").css("display", "inline-block");
                                    } else {
                                        $("#addRowMontant").css("display", "none");
                                    }
                                    if (userData2.length > 0) {
                                        for (var $i = 0; $i < userData2.length; $i++) {
                                            $(".session_id").append('<option value="' + userData2[$i].groupe_entreprise_id + '">' + userData2[$i].nom_formation + '/ ' + userData2[$i].nom_module + '/ ' + userData2[$i].reference + "/ " + userData2[$i].nom_groupe + '</option>');
                                        }
                                        document.getElementById("session_id_err").innerHTML = "";
                                    } else {
                                        document.getElementById("session_id_err").innerHTML = "Aucun session a été détecter";
                                    }
                                }
                            });

                            $.ajax({
                                url: "{{route('groupe_projet')}}"
                                , type: 'get'
                                , data: {
                                    id: prj_id
                                    , entreprise_id: id
                                }
                                , success: function(response2) {

                                    var userData2 = response2;
                                    if (userData2.length > 0) {
                                        for (var $i = 0; $i < userData2.length - userData2.length; $i++) {
                                            $("#session_id").append('<option value="' + userData2[$i].groupe_entreprise_id + '">' + userData2[$i].nom_groupe + '</option>');
                                            document.getElementById("module_id_ref").innerHTML = "" + userData2[$i].nom_formation + '/' + userData2[$i].nom_module + '/' + userData2[$i].reference;
                                        }
                                        document.getElementById("session_id_err").innerHTML = "";
                                    } else {
                                        document.getElementById("module_id_ref").innerHTML = "";
                                        document.getElementById("session_id_err").innerHTML = "Aucun session a été détecter";
                                    }

                                }
                            });
                        }
                    }
                } else {
                    document.getElementById("nom_etp").innerHTML = "";
                    document.getElementById("adresse_etp").innerHTML = "";
                    document.getElementById("tel_etp").innerHTML = "";
                    document.getElementById("mail_etp").innerHTML = "";
                    document.getElementById("site_etp").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });

    });



    // ======== show session
    $(document).on('change', '#projet_id', function() {
        $(".session_id").empty();

        var prj_id = $(this).val();
        var entreprise_id = $("#entreprise_id").val();
        $.ajax({
            url: "{{route('groupe_projet')}}"
            , type: 'get'
            , data: {
                id: prj_id
                , entreprise_id: entreprise_id
            }
            , success: function(response2) {
                var userData2 = response2;
                $("#addRowMontant").val(userData2.length);
                if ($("#addRowMontant").val() > 1) {
                    $("#addRowMontant").css("display", "inline-block");
                } else {
                    $("#addRowMontant").css("display", "none");
                }
                if (userData2.length > 0) {
                    for (var $i = 0; $i < userData2.length; $i++) {
                        $(".session_id").append('<option value="' + userData2[$i].groupe_entreprise_id + '">' + userData2[$i].nom_formation + '/ ' + userData2[$i].nom_module + '/ ' + userData2[$i].reference + "/ " + userData2[$i].nom_groupe + '</option>');
                    }
                    document.getElementById("session_id_err").innerHTML = "";
                } else {
                    document.getElementById("session_id_err").innerHTML = "Aucun session a été détecter";
                }
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
                $("#addRow").val(userData.length);
                var total_frais_annexe_possible = ($(".row #inputFormRow").length + 1);
                if ($("#addRow").val() > 1) {
                    $("#addRow").css("display", "inline-block");
                } else {
                    $("#addRow").css("display", "none");
                }
                if (total_frais_annexe_possible < ($("#addRow").val() + 1)) {
                    $("#addRow").css("display", "inline-block");
                    for (var $i = 0; $i < userData.length; $i++) {
                        $("#frais").append('<option value="' + userData[$i].id + '">' + JSON.stringify(userData[$i].description) + '</option>');
                    }
                    var html = '';
                    html += '<div class="row my-1" id="inputFormRow">';
                    html += '<div class="col-3">';
                    html += '<select class="form-select selectP input_section4"  id="frais_annexe_id[]" name="frais_annexe_id[]" required>';

                    for (var $i = 0; $i < userData.length; $i++) {
                        html += '<option value="' + userData[$i].id + '">' + userData[$i].description + '</option>';
                    }
                    html += '</select>';
                    html += '</div>';

                    html += '<div class="col-5">';
                    html += '  <textarea name="description_annexe[]" id="description_annexe[]" class="text_description form-control" placeholder="déscription du frais annexe"></textarea>';
                    html += '</div>';

                    html += '<div class="col-1">';
                    html += '<input type="number" min="1" value="1" required class="form-control input_quantite annexe_qte" name="qte_annexe[]" id="qte_annexe[]">';
                    html += '</div>';

                    html += '<div class="col-2">';
                    html += '<input type="number" min="0" value="0" required name="montant_frais_annexe[]" class="somme_totale_montant form-control input_quantite2 frais_annexe" id="montant_frais_annexe[]" placeholder="0">';
                    html += '</div>';

                    html += '<div class="col-1 text-end pt-2">';
                    html += '<p class="m-0"><span>';
                    html += '<button id="removeRow" type="button" class="btn btn-danger ms-3"><i class="fa fa-trash"></i></button></span>';
                    html += '</div>';
                    html += '</div><br>';

                    $('#newRow').append(html);

                    if (total_frais_annexe_possible >= ($("#addRow").val())) {
                        $("#addRow").css("display", "none");
                    }
                } else {
                    $("#addRow").css("display", "none");

                }

            }
            , error: function(error) {
                console.log(error);
            }
        });

    });

    /*
        $(document).on("keyup change", ".montant_session_facture", function() {
            var montant_session = 0;
            var pourcent = 0;
            montant_session = document.getElementById("total_montant_session").innerHTML;

            //  $(".calcule_pour_tax option").each(function() {
                pourcent = $("#test_"+$(".calcule_pour_tax").val()).data("id");
            //  });

            alert(JSON.stringify(pourcent));
            var result =0;
            result= ((montant_session * 100) / pourcent);
            document.getElementById("montant_tax").innerHTML = pourcent;

        }); */
    /*  $(document).on("keyup change", ".fa", function() {
        var sum = 0;
        $(".somme_totale_montant").each(function() {
            sum += +$(this).val();
        });
        document.getElementById("total_montant_frais_annexe").innerHTML = sum;
    });
*/

    $(document).on("keyup change", ".qte", function() {
        var montant = 0;
        var qte = 0;
        var sum = 0;
        montant = $(".facture").val();
        qte = $(this).val();
        sum = montant * qte;
        document.getElementById("montant_plus_qte").innerHTML = sum;

    });
    $(document).on("keyup change", ".facture", function() {
        var montant = 0;
        var qte = 0;
        var sum = 0;
        montant = $(this).val();
        qte = $(".qte").val();
        sum = montant * qte;
        document.getElementById("montant_plus_qte").innerHTML = sum;

    });


    $(document).on("keyup change", ".montant_session_facture", function() {
        var sum = 0;
        var pourcent = 0;
        $(".montant_session_facture").each(function() {
            sum += +$(this).val();
        });
        pourcent = $("#test_" + $(".calcule_pour_tax").val()).data("id");
        document.getElementById("total_montant_session").innerHTML = sum;
        var result = 0;
        if (pourcent != 0) {
            result = (sum / pourcent);
        } else {
            result = 0;
        }
        document.getElementById("montant_tax").innerHTML = result;
    });


    $(document).on("keyup change", ".frais_annexe", function() {
        var sum = 0;
        $(".frais_annexe").each(function() {
            sum += +$(this).val();
        });
        document.getElementById("total_frais_annexe").innerHTML = sum;

    });


    // remove row
    $(document).on('click', '#removeRow', function() {
        $(this).closest('#inputFormRow').remove();
        var total_frais_annexe_possible = ($(".row #inputFormRow").length + 1);
        if (total_frais_annexe_possible < ($("#addRow").val() + 1)) {
            $("#addRow").css("display", "inline-block");
        }
    });


    // ============================ Montant=========================

    $(document).on('click', '#addRowMontant', function() {
        $('#montant').empty();
        var id = $("#projet_id").val();
        var etp_id = $("#entreprise_id").val();

        $total_session_possible = ($(".row #inputFormRowMontant").length + 1);
        if ($total_session_possible < ($("#addRowMontant").val())) {
            $("#addRowMontant").css("display", "inline-block");
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
                    html += '<div class="row my-1" id="inputFormRowMontant">';
                    html += '<div class="col-3">';
                    html += '</div>';
                    html += '<div class="col-5">';
                    html += '<select class="form-select selectP input_section4"  id="session_id[]" name="session_id[]" required>';

                    for (var $i = 0; $i < userData.length; $i++) {
                        html += '<option value="' + userData[$i].groupe_entreprise_id + '">' + userData[$i].nom_formation + '/ ' + userData[$i].nom_module + '/ ' + userData[$i].reference + '/ ' + userData[$i].nom_groupe + '</option>';
                    }
                    html += '</select>';
                    html += '</div>';
                    html += '<div class="col-1">';
                    html += '<input type="number" min="1" value="1" required class="form-control input_quantite" name="qte[]" id="qte[]">';
                    html += '</div>';

                    html += '<div class="col-2">';
                    html += '<input type="number" min="0" value="0" required name="facture[]" class="somme_totale_montant form-control input_quantite2 montant_session_facture" id="facture[]" placeholder="0">';
                    html += '</div>';

                    html += '<div class="col-1 text-end pt-2">';
                    html += '<p class="m-0"><span>';
                    html += '<button id="removeRowMontant" type="button" class="btn btn-danger ms-3"><i class="fa fa-trash"></i></button></span></p>';
                    html += '</div>';
                    html += '</div><br>';

                    $('#newRowMontant').append(html);
                }
                , error: function(error) {
                    console.log(error);
                }
            });

            if ($total_session_possible + 1 >= ($("#addRowMontant").val())) {
                $("#addRowMontant").css("display", "none");
            }
        } else {
            $("#addRowMontant").css("display", "none");
        }

    });

    // remove row
    $(document).on('click', '#removeRowMontant', function() {
        $(this).closest('#inputFormRowMontant').remove();
        $total_session_possible = ($(".row #inputFormRowMontant").length + 1);
        if ($total_session_possible < ($("#addRowMontant").val())) {
            $("#addRowMontant").css("display", "inline-block");
        } else {
            $("#addRowMontant").css("display", "none");
        }
    });

</script>
@endsection
