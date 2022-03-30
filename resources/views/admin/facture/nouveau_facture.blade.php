@extends('./layouts/admin')
@section('content')
{{--<link rel="stylesheet" href="{{asset('css/facture.css')}}"> --}}
{{-- https://www.youtube.com/watch?v=RBeqKYsw7CQ  link template facture videos youtube --}}
<link rel="stylesheet" href="{{asset('assets/css/facture_new.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControlFactures.css')}}">
<div class="container mb-5 mt-5">
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
                                {{-- <img src="{{asset('img/logo_numerika/logonmrk.png')}}" alt="logo_cfp" class="img-fluid"> --}}
                                <img src="{{asset('images/CFP/'.$cfp->logo)}}" alt="logo_cfp" class="img-fluid">
                            </div>
                            <div class="col-8 text-end" align="rigth">
                                {{-- <input type="text" name="" id="" class="text-end titre_facture" placeholder="titre facture" required> --}}
                                <select class="text-end titre_facture form-select  mb-2 m-0" id="type_facture" name="type_facture" aria-label="Default select example" required>
                                    <option onselected hidden> Type de Facture...</option>
                                    @foreach ($type_facture as $tp_fact)
                                    <option value="{{$tp_fact->id}}">{{$tp_fact->description}}</option>
                                    @endforeach
                                </select>

                                <input type="text" name="" id="" class="text-end description_facture" placeholder="Déscription du facture">
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
                            {{-- <div class="details">
                                @foreach ($entreprise as $tp)
                                @if($tp->nom_etp)
                                <p class="m-0 nom_etp">{{$tp->nom_etp}}</p>
                            <p class="m-0 adresse_cfp">{{$tp->adresse_rue}}&nbsp;{{$tp->adresse_quartier}} <br> {{$tp->adresse_ville}}&nbsp;{{$tp->adresse_code_postal}} <br> {{$tp->adresse_region}}</p>
                            <p class="mt-3 m-0 adresse_cfp">{{$tp->telephone_etp}}</p>
                            <p class="m-0 adresse_cfp">{{$tp->email_etp}}</p>
                            <p class="m-0 adresse_cfp">{{$tp->site_etp}}</p>
                            @endif

                            @endforeach
                        </div> --}}
                        <div class="details">
                            <p class="m-0 nom_cfp" id="nom_etp_detail"></p>
                            <p class="m-0 " id="adresse_etp"></p>
                            <p class="mt-3 m-0 " id="tel_etp"></p>
                            <p class="m-0 " id="mail_etp"></p>
                            <p class="m-0 " id="site_etp"></p>
                        </div>
                    </div>
                </div>
                <div class="col-6 p-4">
                    <div class="row mb-2">
                        <div class="col-12 d-flex flex-row justify-content-end">
                            <p class="m-0 pt-3 text-end me-3">Numéro de facture</p> <input type="text" class="form-control input_simple" name="num_facture" required placeholder="reference du facture">
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-12 d-flex flex-row justify-content-end">
                            <p class="m-0 pt-3 text-end me-3">Reference de bon de commande</p> <input type="text" class="form-control input_simple reference_bc" name="reference_bc" id="reference_bc" required placeholder="reference du bon de commande">
                            @error('reference_bc')
                            <span style="color:#ff0000;"> {{$message}} </span>
                            @enderror
                            <span style="color:#ff0000;" id="reference_bc_err"></span>
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
                        <div class="col-2">
                            <h6 class="m-0">Projets</h6>
                        </div>
                        <div class="col-2">
                            <h6 class="m-0">Session</h6>
                        </div>
                        <div class="col-3">
                            <h6 class="m-0">Module</h6>
                        </div>
                        <div class="col-1">
                            <h6 class="m-0">Réf</h6>
                        </div>
                        <div class="col-1 text-end">
                            <h6 class="m-0">Quantité</h6>
                        </div>
                        <div class="col-1">
                            <h6 class="m-0">Prix Unitaire</h6>
                        </div>
                        <div class="col-2 text-end">
                            <h6 class="m-0">Montant</h6>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-2">
                            <select class="form-select selectP input_section4 mb-2" id="projet_id" name="projet_id" aria-label="Default select example" required>
                            </select>
                            <span style="color:#ff0000;" id="projet_id_err">Aucun projet a été
                                détecter</span>
                        </div>
                        <div class="col-2">
                            <select class="form-select selectP input_section4 mb-2" id="session_id" name="session_id" aria-label="Default select example" required>
                            </select>
                            <span style="color:#ff0000;" id="session_id_err">Aucun session a été
                                détecter</span>
                        </div>
                        <div class="col-3">
                            <input type="text" name="qte" id="qte" min="1" value="1" class="form-control input_quantite" required>
                        </div>
                        <div class="col-1">
                            <input type="text" name="qte" id="qte" min="1" value="1" class="form-control input_quantite" required>
                        </div>
                        <div class="col-1">
                            <input type="number" name="qte" id="qte" min="1" value="1" class="form-control input_quantite" required>
                        </div>
                        <div class="col-1">
                            <input type="number" name="facture" min="0" value="0" id="facture" class="form-control input_quantite2" required>
                        </div>
                        <div class="col-2 text-end pt-2">
                            <p class="m-0"><span>500 000</span>&nbsp;MGA</p>
                        </div>
                    </div>

                    <div class="row">
                        <div id="newRowMontant"></div>
                    </div>

                    <div class="row mb-2">
                        <div class="col-9 d-flex flex-row justify-content-end">
                            <p class="m-0 pt-3 text-end me-3">Taxe</p>
                            <select class="form-select selectP input_tax" aria-label="Default select example" name="tax_id" id="tax_id">
                                @foreach ($taxe as $t)
                                <option value="{{$t->id}}">{{$t->description}}</option>
                                @endforeach
                            </select>

                            {{-- <p class="m-0 pt-3 text-end me-3">Taxe</p> <input type="number" class="form-control input_tax" name="num_facture" required> --}}
                        </div>
                        <div class="col-3 text-end">
                            <p class="m-0 pt-2"><span>500 000</span>&nbsp;MGA<span><i class='bx bxs-trash ms-4'></i></span></p>
                        </div>
                    </div>

                    {{-- <div class="row mb-2">
                        <div class="col-9 d-flex flex-row justify-content-end">
                            <p class="m-0 pt-3 text-end me-3">Taxe</p> <input type="number" class="form-control input_tax" name="num_facture" required>
                        </div>
                        <div class="col-3 text-end">
                            <p class="m-0 pt-2"><span>500 000</span>&nbsp;MGA<span><i class='bx bxs-trash ms-4'></i></span></p>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-9 d-flex flex-row justify-content-end">
                            <p class="m-0 pt-3 text-end me-3">TVA</p> <input type="number" class="form-control input_tax" name="num_facture">
                        </div>
                        <div class="col-3 text-end">
                            <p class="m-0 pt-2"><span>500 000</span>&nbsp;MGA<span><i class='bx bxs-trash ms-4'></i></span></p>
                        </div>
                    </div> --}}


                </div>

                <div class="row nouveau_service g-0">
                    <div class="col-12 py-2 text-center">

                        <span><i class='bx bx-plus-circle me-2'></i><a href="#" id="addRowMontant">Ajouter une autre session</a></span>
                    </div>
                </div>
                <div class="col-12 pb-4 element">
                    <div class="row titres_services">
                        <div class="col-3">
                            <h6 class="m-0">Frais annexes</h6>
                        </div>
                        <div class="col-3">
                            <h6 class="m-0">Déscriptions</h6>
                        </div>
                        <div class="col-1 text-end">
                            <h6 class="m-0">Quantité</h6>
                        </div>
                        <div class="col-2">
                            <h6 class="m-0">Prix Unitaire</h6>
                        </div>
                        <div class="col-3 text-end">
                            <h6 class="m-0">Montant</h6>
                        </div>
                    </div>

                    <div class="row my-1">
                        <div id="newRow"></div>
                    </div>

                </div>
                <div class="row nouveau_service g-0">
                    <div class="col-12 py-2 text-center">
                        <span> <a href="#" id="addRow"><i class='bx bx-plus-circle me-2'></i>Ajouter un ou des frais annexes(s)</a> </span>
                    </div>
                </div>
                <div class="row mb-2 g-0 p-2">
                    <div class="col-9 d-flex flex-row justify-content-end">
                        <p class="m-0 text-end pt-1"> Montant total</p>
                    </div>
                    <div class="col-3 text-end">
                        <p><span>500 000</span>&nbsp;MGA</p>
                    </div>
                </div>
                <div class="row mb-2 g-0 p-2">
                    <div class="col-9 d-flex flex-row justify-content-end">
                        <p class="m-0 pt-3 text-end me-3">Remise</p> <input type="number" min="1" value="0" class="form-control input_tax" name="remise" id="remise"><select class="form-select selectP input_select text-end ms-2" id="" name="" aria-label="Default select example" required>
                            <option value="MGA" selected>MGA</option>
                            <option value="%">%</option>
                        </select>
                    </div>
                    <div class="col-3 text-end">
                        <p><span>500 000</span>&nbsp;MGA</p>
                    </div>
                </div>
                <div class="row mb-2 g-0 p-2">
                    <div class="col-9 d-flex flex-row justify-content-end">
                        <p class="m-0 text-end total">Total</p>
                    </div>
                    <div class="col-3 text-end">
                        <p class="pt-1 me-3"><span class="total">500 000</span>&nbsp;MGA</p>
                    </div>
                </div>
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
                <h6 class="mb-0 changer_carret d-flex pt-2 justify-content-between" data-bs-toggle="collapse" href="#titre" aria-expanded="true" aria-controls="collapseprojet">
                    Informations légales
                    <i class="bx bx-caret-down carret-icon text-end"></i>
                </h6>
                <div class="col-12 collapse" id="titre">
                    <div class="row p-2">

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
        $("#session_id").empty();

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

                // alert(JSON.stringify(userData));
                if (etp != null) {
                    document.getElementById("nom_etp_detail").innerHTML = "" + etp.nom_etp;
                    document.getElementById("adresse_etp").innerHTML = "" + etp.adresse_rue + "&nbsp;" + etp.adresse_quartier + " <br> " + etp.adresse_ville + "&nbsp;" + etp.adresse_code_postal + " <br> " + etp.adresse_region;
                    document.getElementById("tel_etp").innerHTML = "" + etp.telephone_etp;
                    document.getElementById("mail_etp").innerHTML = "" + etp.email_etp;
                    document.getElementById("site_etp").innerHTML = "" + etp.site_etp;

                    if (userData.length <= 0) {
                        document.getElementById("projet_id_err").innerHTML = "Aucun projet a été détecter";
                    } else {
                        document.getElementById("projet_id_err").innerHTML = "";
                        for (var $i = 0; $i < userData.length; $i++) {
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
                                    if (userData2.length > 0) {
                                        for (var $i = 0; $i < userData2.length; $i++) {
                                            $("#session_id").append('<option value="' + userData2[$i].groupe_id + '">' + userData2[$i].nom_groupe + '</option>');
                                        }
                                        document.getElementById("session_id_err").innerHTML = "";
                                    } else {
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
                // <div class="row my-3">
                //         <div class="col-3">
                //             <input type="text" name="" id="" class="form-control input_quantite" placeholder="Titre frais annexe">
                //         </div>
                //         <div class="col-3">
                //             <textarea name="" id="" class="text_description form-control" placeholder="déscription du frais annexe"></textarea>
                //         </div>
                //         <div class="col-1">
                //             <input type="number" name="" id="" class="form-control input_quantite">
                //         </div>
                //         <div class="col-2">
                //             <input type="number" name="" id="" class="form-control input_quantite2">
                //         </div>
                //         <div class="col-3 text-end pt-2">
                //             <p class="m-0"><span>500 000</span>&nbsp;MGA<span><i class='bx bxs-trash ms-4'></i></span></p>
                //         </div>
                //     </div>

                html += '<div class="row my-1" id="inputFormRow">';
                html += '<div class="col-3">';
                html += '<select class="form-select selectP input"  id="frais_annexe_id[]" name="frais_annexe_id[]" required>';

                for (var $i = 0; $i < userData.length; $i++) {
                    html += '<option value="' + userData[$i].id + '">' + userData[$i].description + '</option>';
                }
                html += '</select>';
                html += '</div>';

                html += '<div class="col-3">';
                html += '  <textarea name="description_annexe[]" id="description_annexe[]" class="text_description form-control" placeholder="déscription du frais annexe"></textarea>';
                html += '</div>';

                html += '<div class="col-1">';
                html += '<input type="number" min="1" value="1" required class="form-control input_quantite" name="qte_annexe[]" id="qte_annexe[]">';
                html += '</div>';

                html += '<div class="col-2">';
                html += '<input type="number" min="0" value="0" required name="montant_frais_annexe[]" class="form-control input_quantite2" id="montant_frais_annexe[]" placeholder="0">';
                html += '</div>';


                html += '<div class="col-3 text-end pt-2">';
                html += '<p class="m-0"><span>500 000</span>&nbsp;MGA<span>';
                html += '<button id="removeRow" type="button" class="btn btn-danger ms-3"><i class="fa fa-trash"></i></button></span></p>';
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
                id: id
                , entreprise_id: etp_id
            }
            , success: function(response) {
                var userData = response;
                var html = '';

                html += '<div class="row my-1" id="inputFormRowMontant">';
                html += '<div class="col-3">';
                html += '</div>';
                html += '<div class="col-3">';
                html += '<select class="form-select selectP input_section4"  id="session_id[]" name="session_id[]" required>';

                for (var $i = 0; $i < userData.length; $i++) {
                    html += '<option value="' + userData[$i].groupe_id + '">' + userData[$i].nom_groupe + '</option>';
                }
                html += '</select>';
                html += '</div>';

                html += '<div class="col-1">';
                html += '<input type="number" min="1" value="1" required class="form-control input_quantite" name="qte[]" id="qte[]">';
                html += '</div>';

                html += '<div class="col-2">';
                html += '<input type="number" min="0" value="0" required name="facture[]" class="form-control input_quantite2" id="facture[]" placeholder="0">';
                html += '</div>';

                html += '<div class="col-3 text-end pt-2">';
                html += '<p class="m-0"><span>500 000</span>&nbsp;MGA<span>';
                html += '<button id="removeRowMontant" type="button" class="btn btn-danger ms-3"><i class="fa fa-trash"></i></button></span></p>';
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
@endsection
