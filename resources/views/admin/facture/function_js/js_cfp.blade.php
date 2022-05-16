<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
 /*   $(document).ready(function() {
        $("#myModal").modal('show');

    });
*/
    /*--------------------------------------------------------------------------------------------------------------------*/
    /*     $(".payement").on('click', function(e) {

                    $('#montant').html('');
                    $('#num_fact_encaissement').html('');
                    $("#numero_facture").html('')
                    var id = $(".payement").data("id");


                    $.ajax({
                        method: "GET"
                        , url: "{{route('montant_restant')}}"
                        , data: {
                            num_facture: id
                        }
                        , dataType: "html"
                        , success: function(response) {
                            var userData = JSON.parse(response);
                            $("#montant").append(userData[0]);
                            $("#num_fact_encaissement").append(userData[1]);
                            var html = '<input type="hidden" name="num_facture" value="' + userData[1] + '" required>';
                            document.getElementById("date_encaissement").setAttribute("min", userData[2]);
                            $('#numero_facture').append(html);
                        }
                        , error: function(error) {
                            console.log(error)
                        }
                    });
                });
*/
    /*--------------------------------------------------------------------------------------------------------------------*/
    $(document).on("keyup change", "#dte_debut", function() {
        document.getElementById("dte_fin").setAttribute("min", $(this).val());
    });

    $(document).on("keyup change", "#solde_debut", function() {
        document.getElementById("solde_fin").setAttribute("min", $(this).val());
        $("#solde_fin").val($(this).val());
    });


    /*------------------------------------------------- Numero Facture-------------------------------------------------------------------*/

    function number_format(number, decimals, decPoint, thousandsSep) {
        decimals = decimals || 0;
        number = parseFloat(number);

        if (!decPoint || !thousandsSep) {
            decPoint = '.';
            thousandsSep = ',';
        }

        var roundedNumber = Math.round(Math.abs(number) * ('1e' + decimals)) + '';
        var numbersString = decimals ? roundedNumber.slice(0, decimals * -1) : roundedNumber;
        var decimalsString = decimals ? roundedNumber.slice(decimals * -1) : '';
        var formattedNumber = "";

        while (numbersString.length > 3) {
            formattedNumber += thousandsSep + numbersString.slice(-3)
            numbersString = numbersString.slice(0, -3);
        }

        return (number < 0 ? '-' : '') + numbersString + formattedNumber + (decimalsString ? (decPoint + decimalsString) : '');
    }



    function getDataFactureTous(full_facture, devise) {
        var html_tous = '';
        if (full_facture.length > 0) {

            for (var i_act = 0; i_act < full_facture.length; i_act += 1) {

                var url_detail_facture = "{{ route('detail_facture', ':id') }}";
                url_detail_facture = url_detail_facture.replace(":id", full_facture[i_act].num_facture);

                var url_edit_facture = "{{ route('edit_facture', ':id') }}";
                url_edit_facture = url_edit_facture.replace(":id", full_facture[i_act].num_facture);

                var url_form_facture = "{{ route('valid_facture') }}";

                var url_delete_facture = "{{ route('delete_facture', ':id') }}";
                url_delete_facture = url_delete_facture.replace(":id", full_facture[i_act].num_facture);

                var url_liste_encaissement_facture = "{{ route('listeEncaissement', ':id') }}";
                url_liste_encaissement_facture = url_liste_encaissement_facture.replace(":id", full_facture[i_act].num_facture);

                var url_pdf_liste_encaissement_facture = "{{ route('pdf+liste+encaissement', ':id') }}";
                url_pdf_liste_encaissement_facture = url_pdf_liste_encaissement_facture.replace(":id", full_facture[i_act].num_facture);
                var url_pdf_facture_facture = "{{ route('imprime_feuille_facture', ':id') }}";
                url_pdf_facture_facture = url_pdf_facture_facture.replace(":id", full_facture[i_act].num_facture);

                var url_form_encaissement = "{{ route('encaisser') }}";

                html_tous += " <tr><td> <a href=" + url_detail_facture + ">";

                if (full_facture[i_act].reference_type_facture == "Facture") {

                    html_tous += "  <div style='background-color: green; border-radius: 10px; text-align: center;color: white'>" +
                        full_facture[i_act].reference_type_facture +
                        "</div>";
                } else if (full_facture[i_act].reference_type_facture == "Avoir") {

                    html_tous += "   <div style='background-color: rgb(144, 196, 202); border-radius: 10px; text-align: center;color: white'>" +
                        full_facture[i_act].reference_type_facture +
                        " </div> ";
                } else if (full_facture[i_act].reference_type_facture == "Acompte") {
                    html_tous += "    <div style='background-color: rgb(140, 137, 137); border-radius: 10px; text-align: center;color: white'> " +
                        full_facture[i_act].reference_type_facture +
                        " </div> ";
                    /*     console.log(JSON.stringify(full_facture[i_act].reference_type_facture)); */
                }

                /* else {

                    html_tous += "   <div style='background-color: rgb(150, 181, 150); border-radius: 10px; text-align: center;color: white'>"; +
                    full_facture[i_act].reference_type_facture +
                        " </div>";
                } */

                html_tous += "  </a></td><th>";
                html_tous += "  <a href=" + url_detail_facture + ">" + full_facture[i_act].num_facture + "   </a> </th> <td>";
                html_tous += "  <a href=" + url_detail_facture + ">" + full_facture[i_act].nom_etp + " </a></td><td>";
                html_tous += "  <a href=" + url_detail_facture + ">" + full_facture[i_act].invoice_date + " </a> </td><td>";
                html_tous += "  <a href=" + url_detail_facture + ">" + full_facture[i_act].due_date + " </a> </td><td>";

                html_tous += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + full_facture[i_act].montant_total.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim() + " </a> </td><td>";
                html_tous += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + full_facture[i_act].dernier_montant_ouvert.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim() + " </a> </td><td>";

                html_tous += "  <a href=" + url_detail_facture + "> ";


                if (full_facture[i_act].dernier_montant_ouvert <= 0) {
                    html_tous += '<div style="background-color: rgb(109, 127, 220); border-radius: 10px; text-align: center;color:white">  payé </div>';
                } else {
                    if (full_facture[i_act].facture_encour == "valider") {
                        if (full_facture[i_act].jour_restant > 0) {
                            html_tous += '<div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white"> envoyé  </div>';
                        } else {
                            html_tous += '<div style="background-color: rgb(235, 122, 122); border-radius: 10px; text-align: center;color:white"> en retard </div>';
                        }
                    } else if (full_facture[i_act].facture_encour == "en_cour") {
                        if (full_facture[i_act].jour_restant > 0) {
                            html_tous += '<div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white">  partiellement payé  </div>';
                        } else {
                            html_tous += '<div style="background-color: rgb(235, 122, 122); border-radius: 10px; text-align: center;color:white">  en retard </div>';
                        }
                    }
                }


                html_tous += "   </a> </td>";
                html_tous += "<td>";

                if (full_facture[i_act].activiter == 0) {
                    html_tous += '  <div class="dropdown ">';
                    html_tous += '<div class = "btn-group dropstart">';
                    html_tous += '<button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></button>';
                    html_tous += '<ul class = "dropdown-menu" >';
                    html_tous += '<li class="dropdown-item">';
                    html_tous += ' <a href="' + url_edit_facture + '">  <button type="button" class="btn"><i class="fa fa-edit"></i> Modifier</button>';
                    html_tous += '</a></li> <li class = "dropdown-item"> ';
                    html_tous += '<form action = "' + url_form_facture + '" method = "POST">';
                    html_tous += '@csrf';
                    html_tous += '<input name = "num_facture" type = "hidden" value = "' + full_facture[i_act].num_facture + '" >';
                    html_tous += '<button type="submit" class="btn "><i class="bx bx-file"></i> Valider</button>';
                    html_tous += "</form>";
                    html_tous += "</li> <li>";
                    /*   html_tous += '<a class="dropdown-item" href="' + url_delete_facture + '">';
                       html_tous += '<button type="submit" class="btn "><span class="fa fa-trash"></span> Supprimer</button>'; */
                    /* html_tous += " </a> </li></ul> </div> </div>"; */
                    html_tous += '<a class="dropdown-item" href="#">';
                    html_tous += '<button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#delete_fature_' + full_facture[i_act].num_facture + '"><span class="fa fa-trash"></span> Supprimer</button>';
                    html_tous += '</a>';

                    html_tous += "</li></ul> </div> </div>";
                } else {

                    if (full_facture[i_act].facture_encour == "valider") {

                        html_tous += ' <div class="dropdown"><div class="btn-group dropstart"> <button type="button" class="btn  btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> </button> ';
                        html_tous += '  <ul class="dropdown-menu">';
                        html_tous += '  <a href="#" class="dropdown-item">';
                        html_tous += ' <button type="button" class=" btn  payement" data-id="' + full_facture[i_act].num_facture + '" id="' + full_facture[i_act].num_facture + '" data-bs-toggle="modal" data-bs-target="#modal' + full_facture[i_act].cfp_id + '_' + full_facture[i_act].num_facture + '">Faire un encaissement</button>';
                        html_tous += '</a>';
                        html_tous += '<a class="dropdown-item" href="' + url_liste_encaissement_facture + '"><button type="button" class="btn ">Liste des encaissements</button></a>';
                        html_tous += '</ul>';
                        html_tous += ' </div> </div>';

                    } else if (full_facture[i_act].facture_encour == "en_cour") {

                        html_tous += '<div class="dropdown">';
                        html_tous += '<div class="btn-group dropstart">';
                        html_tous += '<button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
                        html_tous += '</button>';
                        html_tous += '<ul class="dropdown-menu">';
                        html_tous += '<a href="#" class="dropdown-item">';
                        html_tous += '<button type="button" class=" btn  payement" data-id="' + full_facture[i_act].num_facture + '" id="' + full_facture[i_act].num_facture + '" data-bs-toggle="modal" data-bs-target="#modal' + full_facture[i_act].cfp_id + '_' + full_facture[i_act].num_facture + '">Faire un encaissement</button>';
                        html_tous += '</a>'
                        html_tous += ' <a class="dropdown-item" href="' + url_liste_encaissement_facture + '"><button type="button" class="btn ">Liste des encaissements</button></a>';
                        html_tous += '<hr class="dropdown-divider">';
                        html_tous += '<a class="dropdown-item" href="' + url_pdf_liste_encaissement_facture + '">';
                        html_tous += '<button type="button" class="btn "> <i class="fa fa-download"></i> PDF Encaissement </button></a>';
                        html_tous += '</ul> </div></div>';

                    } else {

                        html_tous += '<div class="dropdown">';
                        html_tous += '<div class="btn-group dropstart">';
                        html_tous += '<button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
                        html_tous += '</button>';
                        html_tous += '<ul class="dropdown-menu">';
                        html_tous += '<a class="dropdown-item" href="' + url_pdf_facture_facture + '"><button type="button" class="btn "><i class="fa fa-download"></i> PDF Facture</button></a>';
                        html_tous += ' <a class="dropdown-item" href="' + url_liste_encaissement_facture + '"><button type="button" class="btn ">Liste des encaissements</button></a>';
                        html_tous += '<hr class="dropdown-divider">';
                        html_tous += '<a class="dropdown-item" href="' + url_pdf_liste_encaissement_facture + '">';
                        html_tous += '<button type="button" class="btn "> <i class="fa fa-download"></i> PDF Encaissement </button></a>';
                        html_tous += '</ul> </div></div>';

                    }
                }

                html_tous += "</td> </tr>";


                html_tous += ' <div id="modal' + full_facture[i_act].cfp_id + '_' + full_facture[i_act].num_facture + '" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">';

                html_tous += '<div class="modal-dialog">';
                html_tous += '<div class="modal-content">';
                html_tous += '<div class="modal-header">';
                html_tous += '<div class="modal-title text-md">';
                html_tous += '<h6>Encaisser la facture  N° : <span class="text-mued" id="num_fact_encaissement">' + full_facture[i_act].num_facture + '</span></h6>';

                html_tous += '<h5>Reste à payer : <strong><label id="montant"></label> ' + devise.devise + ' ' + full_facture[i_act].dernier_montant_ouvert.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim() + '</strong></h5>';
                html_tous += '</div>';
                html_tous += '</div>';
                html_tous += '<div class="modal-body">';
                html_tous += '<form action="' + url_form_encaissement + '" id="formPayement" method="POST">';
                html_tous += '@csrf';
                html_tous += '<input autocomplete="off" type="text" value="' + full_facture[i_act].num_facture + '" name="num_facture" class="form-control formPayement" required="required" hidden> </div>';

                html_tous += '<div class="inputbox inputboxP mt-3  ms-1">';
                html_tous += '<span>Description</span>';
                html_tous += ' <textarea autocomplete="off" name="libelle" id="libelle" class="text_description form-control" placeholder="description" rows="5"></textarea>';

                html_tous += '</div>';
                html_tous += ' <div class="inputbox inputboxP mt-3  ms-1">';
                html_tous += ' <span>Montant à facturer</span>';
                html_tous += ' <input autocomplete="off" type="number" min="1" pattern="[0-9]" name="montant" class="form-control formPayement" required="required" style="height: 50px;"> </div>';

                html_tous += ' <div class="form-group  mt-3  ms-1">';
                html_tous += '   <span>Mode de paiement<strong style="color:#ff0000;">*</strong></span>';
                html_tous += '  <select class="form-select selectP" name="mode_payement" id="mode_payement" aria-label="Default select example" style="height: 50px;">';
                html_tous += '</select>';
                html_tous += '</div>';
                html_tous += '<div class="inputbox inputboxP mt-3  ms-1">';
                html_tous += '<span>Date de paiement<strong style="color:#ff0000;">*</strong></span>';
                html_tous += '<input type="date" name="date_encaissement" id="date_encaissement" class="form-control formPayement" required="required" style="height: 50px;">';
                html_tous += ' </div>';
                html_tous += ' <div class="inputbox inputboxP mt-3" id="numero_facture"></div>';
                html_tous += '</form>';
                html_tous += '<div class="mt-4 mb-4">';
                html_tous += '<div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span> <button type="submit" form="formPayement" class="btn btn_creer btnP px-3">Encaisser</button> </div>';
                html_tous += '</div>';
                html_tous += '</div>';
                html_tous += ' </div>';
                html_tous += '</div>';
                html_tous += '</div>';

                html_tous += '<div class="modal fade" id="delete_fature_' + full_facture[i_act].num_facture + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                html_tous += '<div class="modal-dialog modal-dialog-centered" role="document">';
                html_tous += '<div class="modal-content">';
                html_tous += '<div class="modal-header d-flex justify-content-center" style="background-color:rgb(235, 20, 45);">';
                html_tous += '<h4 class="modal-title text-white">Avertissement !</h4>';
                html_tous += '</div>';
                html_tous += '<div class="modal-body">';
                html_tous += "<small>Vous <span style='color: red'> êtes </span>sur le point d'enlever une facture qui est déjà créer, voulez vous continuer ?</small>";
                html_tous += '</div>';
                html_tous += '<div class="modal-footer justify-content-center">';
                html_tous += '<button type="button" class="btn btn_creer" data-bs-dismiss="modal"> Non </button>';
                html_tous += '<a href="' + url_delete_facture + '"> <button type="button" class="btn btn_creer btnP px-3">Oui</button></a>';
                html_tous += '</div>';
                html_tous += '</div>';
                html_tous += '</div>';
                html_tous += '</div>';
            }
        } else {
            html_tous += '<tr><td colspan = "10" class = "text-center" style = "color:red;" > Aucun Résultat </td> </tr> ';
        }
        return html_tous;
    }



    function getDataFactureBrouillon(facture_inactif, devise) {
        var html_inactif = '';
        if (facture_inactif.length > 0) {

            for (var i_act = 0; i_act < facture_inactif.length; i_act += 1) {

                var url_detail_facture = "{{ route('detail_facture', ':id') }}";
                url_detail_facture = url_detail_facture.replace(":id", facture_inactif[i_act].num_facture);

                var url_edit_facture = "{{ route('edit_facture', ':id') }}";
                url_edit_facture = url_edit_facture.replace(":id", facture_inactif[i_act].num_facture);

                var url_form_facture = "{{ route('valid_facture') }}";

                var url_delete_facture = "{{ route('delete_facture', ':id') }}";
                url_delete_facture = url_delete_facture.replace(":id", facture_inactif[i_act].num_facture);

                html_inactif += " <tr><td> <a href=" + url_detail_facture + ">";

                if (facture_inactif[i_act].reference_type_facture == "Facture") {

                    html_inactif += "  <div style='background-color: green; border-radius: 10px; text-align: center;color: white'>" +
                        facture_inactif[i_act].reference_type_facture +
                        "</div>";
                } else if (facture_inactif[i_act].reference_type_facture == "Avoir") {

                    html_inactif += "   <div style='background-color: rgb(144, 196, 202); border-radius: 10px; text-align: center;color: white'>" +
                        facture_inactif[i_act].reference_type_facture +
                        " </div> ";
                } else if (facture_inactif[i_act].reference_type_facture == "Acompte") {

                    html_inactif += "    <div style='background-color: rgb(140, 137, 137); border-radius: 10px; text-align: center;color: white'> " +
                        facture_inactif[i_act].reference_type_facture +
                        " </div> ";
                } else {

                    html_inactif += "   <div style='background-color: rgb(150, 181, 150); border-radius: 10px; text-align: center;color: white'>"; +
                    facture_inactif[i_act].reference_type_facture +
                        " </div>";
                }

                html_inactif += "  </a></td><th>";
                html_inactif += "  <a href=" + url_detail_facture + ">" + facture_inactif[i_act].num_facture + "   </a> </th> <td>";
                html_inactif += "  <a href=" + url_detail_facture + ">" + facture_inactif[i_act].nom_etp + " </a></td><td>";
                html_inactif += "  <a href=" + url_detail_facture + ">" + facture_inactif[i_act].invoice_date + " </a> </td><td>";
                html_inactif += "  <a href=" + url_detail_facture + ">" + facture_inactif[i_act].due_date + " </a> </td><td>";

                html_inactif += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + facture_inactif[i_act].montant_total.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim() + " </a> </td><td>";
                html_inactif += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + facture_inactif[i_act].dernier_montant_ouvert.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim() + " </a> </td><td>";

                html_inactif += "  <a href=" + url_detail_facture + "> ";

                if (facture_inactif[i_act].jour_restant > 0) {

                    html_inactif += " <div style='background-color: rgb(233, 190, 142); border-radius: 10px; text-align: center;color:white'> nom envoyé  </div>";

                } else {

                    html_inactif += " <div style='background-color: rgb(235, 122, 122); border-radius: 10px; text-align: center;color:white'> en retard </div>";
                }

                html_inactif += "   </a> </td><td>";
                html_inactif += '  <div class="dropdown ">';
                html_inactif += '<div class = "btn-group dropstart">';
                html_inactif += '<button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></button>';
                html_inactif += '<ul class = "dropdown-menu" >';
                html_inactif += '<li class="dropdown-item">';
                html_inactif += ' <a href="' + url_edit_facture + '">  <button type="button" class="btn"><i class="fa fa-edit"></i> Modifier</button>';
                html_inactif += '</a></li> <li class = "dropdown-item"> ';
                html_inactif += '<form action = "' + url_form_facture + '" method = "POST">';
                html_inactif += '@csrf';
                html_inactif += '<input name = "num_facture" type = "hidden" value = "' + facture_inactif[i_act].num_facture + '" >';
                html_inactif += '<button type="submit" class="btn "><i class="bx bx-file"></i> Valider</button>';
                html_inactif += "</form>";
                html_inactif += "</li> <li>";

                /*       html_inactif += '<a class="dropdown-item" href="' + url_delete_facture + '">';
                html_inactif += '<button type="submit" class="btn "><span class="fa fa-trash"></span> Supprimer</button>';
                html_inactif += " </a> </li></ul> </div> </div></td> </tr>";
*/

                html_inactif += '<a class="dropdown-item" href="#">';
                html_inactif += '<button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#delete_fature_inactif' + facture_inactif[i_act].num_facture + '"><span class="fa fa-trash"></span> Supprimer</button>';
                html_inactif += '</a>';
                html_inactif += "</li></ul> </div> </div>";

                html_inactif += '<div class="modal fade" id="delete_fature_inactif' + facture_inactif[i_act].num_facture + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                html_inactif += '<div class="modal-dialog modal-dialog-centered" role="document">';
                html_inactif += '<div class="modal-content">';
                html_inactif += '<div class="modal-header d-flex justify-content-center" style="background-color:rgb(235, 20, 45);">';
                html_inactif += '<h4 class="modal-title text-white">Avertissement !</h4>';
                html_inactif += '</div>';
                html_inactif += '<div class="modal-body">';
                html_inactif += "<small>Vous <span style='color: red'> êtes </span>sur le point d'enlever une facture qui est déjà créer, voulez vous continuer ?</small>";
                html_inactif += '</div>';
                html_inactif += '<div class="modal-footer justify-content-center">';
                html_inactif += '<button type="button" class="btn btn_creer" data-bs-dismiss="modal"> Non </button>';
                html_inactif += '<a href="' + url_delete_facture + '"> <button type="button" class="btn btn_creer btnP px-3">Oui</button></a>';
                html_inactif += '</div>';
                html_inactif += '</div>';
                html_inactif += '</div>';
                html_inactif += '</div>';
            }
        } else {
            html_inactif += '<tr><td colspan = "10" class = "text-center" style = "color:red;" > Aucun Résultat </td> </tr> ';
        }
        return html_inactif;
    }


    function getDataFactureValider(facture_actif, devise) {
        var html_actif = '';
        // var mode_payement = @php $mode_payement;  @endphp;


        if (facture_actif.length > 0) {

            for (var i_actif = 0; i_actif < facture_actif.length; i_actif += 1) {

                var url_detail_facture = "{{ route('detail_facture', ':id') }}";
                url_detail_facture = url_detail_facture.replace(":id", facture_actif[i_actif].num_facture);

                var url_edit_facture = "{{ route('edit_facture', ':id') }}";
                url_edit_facture = url_edit_facture.replace(":id", facture_actif[i_actif].num_facture);

                var url_form_facture = "{{ route('valid_facture') }}";

                var url_liste_encaissement_facture = "{{ route('listeEncaissement', ':id') }}";
                url_liste_encaissement_facture = url_liste_encaissement_facture.replace(":id", facture_actif[i_actif].num_facture);

                var url_pdf_liste_encaissement_facture = "{{ route('pdf+liste+encaissement', ':id') }}";
                url_pdf_liste_encaissement_facture = url_pdf_liste_encaissement_facture.replace(":id", facture_actif[i_actif].num_facture);

                var url_delete_facture = "{{ route('delete_facture', ':id') }}";
                url_delete_facture = url_delete_facture.replace(":id", facture_actif[i_actif].num_facture);

                var url_form_encaissement = "{{ route('encaisser') }}";

                html_actif += " <tr><td> <a href=" + url_detail_facture + ">";

                if (facture_actif[i_actif].reference_type_facture == "Facture") {

                    html_actif += "  <div style='background-color: green; border-radius: 10px; text-align: center;color: white'>" +
                        facture_actif[i_actif].reference_type_facture +
                        "</div>";
                } else if (facture_actif[i_actif].reference_type_facture == "Avoir") {

                    html_actif += "   <div style='background-color: rgb(144, 196, 202); border-radius: 10px; text-align: center;color: white'>" +
                        facture_actif[i_actif].reference_type_facture +
                        " </div> ";
                } else if (facture_actif[i_actif].reference_type_facture == "Acompte") {

                    html_actif += "  <div style='background-color: rgb(140, 137, 137); border-radius: 10px; text-align: center;color: white'> " +
                        facture_actif[i_actif].reference_type_facture +
                        " </div> ";
                } else {

                    html_actif += "   <div style='background-color: rgb(150, 181, 150); border-radius: 10px; text-align: center;color: white'>" +
                        facture_actif[i_actif].reference_type_facture +
                        " </div>";
                }

                html_actif += "  </a></td><th>";
                html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].num_facture + "   </a> </th> <td>";
                html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].nom_etp + " </a></td><td>";
                html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].invoice_date + " </a> </td><td>";
                html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].due_date + " </a> </td><td>";

                html_actif += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + facture_actif[i_actif].montant_total.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim() + " </a> </td><td>";
                html_actif += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + facture_actif[i_actif].dernier_montant_ouvert.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim() + " </a> </td><td>";



                html_actif += "  <a href=" + url_detail_facture + "> ";

                if (facture_actif[i_actif].jour_restant > 0) {
                    if ($facture_actif[i_actif].facture_encour == "en_cour") {
                        html_actif += '<div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white"> partiellement payé</html_actif+=div>';
                    } else {
                        html_actif += '<div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white"> envoyé </div>';
                    }
                } else {
                    html_actif += " <div style='background-color: rgb(235, 122, 122); border-radius: 10px; text-align: center;color:white'> en retard </div>";
                }
                html_actif += " </a> </td><td>";

                if (facture_actif[i_actif].facture_encour == "valider") {
                    html_actif += ' <div class="dropdown"><div class="btn-group dropstart"> <button type="button" class="btn  btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> </button> ';
                    html_actif += '  <ul class="dropdown-menu">';
                    html_actif += '  <a href="#" class="dropdown-item">';
                    html_actif += ' <button type="button" class=" btn  payement" data-id="' + facture_actif[i_actif].num_facture + '" id="' + facture_actif[i_actif].num_facture + '" data-bs-toggle="modal" data-bs-target="#modal_valide_' + facture_actif[i_actif].cfp_id + '_' + facture_actif[i_actif].num_facture + '">Faire un encaissement</button>';
                    html_actif += '</a>';
                    html_actif += '<a class="dropdown-item" href="' + url_liste_encaissement_facture + '"><button type="button" class="btn ">Liste des encaissements</button></a>';
                    html_actif += '</ul>';
                    html_actif += ' </div> </div>';

                } else if (facture_actif[i_actif].facture_encour == "en_cour") {
                    html_actif += '<div class="dropdown">';
                    html_actif += '<div class="btn-group dropstart">';
                    html_actif += '<button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
                    html_actif += '</button>';
                    html_actif += '<ul class="dropdown-menu">';
                    html_actif += '<a href="#" class="dropdown-item">';
                    html_actif += '<button type="button" class=" btn  payement" data-id="' + facture_actif[i_actif].num_facture + '" id="' + facture_actif[i_actif].num_facture + '" data-bs-toggle="modal" data-bs-target="#modal_valide_' + facture_actif[i_actif].cfp_id + '_' + facture_actif[i_actif].num_facture + '">Faire un encaissement</button>';
                    html_actif += '</a>'
                    html_actif += ' <a class="dropdown-item" href="' + url_liste_encaissement_facture + '"><button type="button" class="btn ">Liste des encaissements</button></a>';
                    html_actif += '<hr class="dropdown-divider">';
                    html_actif += '<a class="dropdown-item" href="' + url_pdf_liste_encaissement_facture + '">';
                    html_actif += '<button type="button" class="btn "> <i class="fa fa-download"></i> PDF Encaissement </button></a>';
                    html_actif += '</ul> </div></div>';

                }

                html_actif += "</td> </tr>";

                html_actif += ' <div id="modal_valide_' + facture_actif[i_actif].cfp_id + '_' + facture_actif[i_actif].num_facture + '" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">';

                html_actif += ' <div class="modal-dialog">';
                html_actif += ' <div class="modal-content px-3 py-3">';
                html_actif += '  <div class="modal-header">';
                html_actif += ' <div class="modal-title text-md">';

                html_actif += '<h6>Encaisser la facture  N° : <span class="text-mued" id="num_fact_encaissement">' + facture_actif[i_actif].num_facture + '</span></h6>';

                html_actif += '<h5>Reste à payer : <strong><label id="montant"></label> ' + devise.devise + ' ' + facture_actif[i_actif].dernier_montant_ouvert.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim() + '</strong></h5>';

                html_actif += ' </div>';
                html_actif += ' </div>';
                html_actif += ' <div class="modal-body">';
                html_actif += '<form action="' + url_form_encaissement + '" id="formPayement" method="POST">';

                html_actif += '  @csrf';
                html_actif += '    <input autocomplete="off" type="text" value="{{$actif->num_facture}}" name="num_facture" class="form-control formPayement" required="required" hidden>';
                html_actif += ' </div>';
                html_actif += ' <div class="inputbox inputboxP mt-3  mx-1">';
                html_actif += ' <div class="row">';
                html_actif += ' <div class="col"><span>Date de paiement<strong style="color:#ff0000;">*</strong></span></div>';
                html_actif += ' <div class="col">';
                html_actif += '  <input type="date" name="date_encaissement" class="form-control formPayement" required="required" style="height: 50px;">';
                html_actif += '   <div class="invalid-feedback">votre Date de paiement</div>';
                html_actif += ' </div></div>';

                html_actif += '   </div>';
                html_actif += ' <div class="inputbox inputboxP mt-3   mx-1">';
                html_actif += '  <div class="row"><div class="col"><span>Montant à facturer<strong style="color:#ff0000;">*</strong></span></div>';
                html_actif += ' <div class="col">';
                html_actif += ' <input autocomplete="off" type="number" min="1" name="montant" class="form-control formPayement" required="required" style="height: 50px;">';
                html_actif += '  <div class="invalid-feedback"> votre montant à encaisser';
                html_actif += '    </div>';
                html_actif += '  </div>';
                html_actif += '  </div>';
                html_actif += '  </div>';

                html_actif += ' <div class="form-group  mt-3  mx-1">';
                html_actif += '   <div class="row">';
                html_actif += '   <div class="col">';
                html_actif += '    <span>Mode de paiement<strong style="color:#ff0000;">*</strong></span>';
                html_actif += '   </div>';
                html_actif += '    <div class="col">';
                html_actif += '  <select class="form-select selectP" name="mode_payement" aria-label="Default select example" style="height: 50px;">';
                /* @foreach ($mode_payement as $mp)
                 <option value="{{ $mp->id }}">{{ $mp->description }}</option>
                 @endforeach */
                html_actif += '   </select>';
                html_actif += '  </div>';
                html_actif += ' </div>';
                html_actif += ' <div class="invalid-feedback"> votre mode de paiement';
                html_actif += '   </div>';
                html_actif += '    </div>';
                html_actif += '    <div class="inputbox inputboxP mt-2  mx-1">';
                html_actif += '     <span>Memo/Notes</span>';
                html_actif += "     <textarea autocomplete='off' name='libelle' class='text_description form-control'  rows='5'></textarea>";
                html_actif += '  </div>';
                html_actif += '    <div class="inputbox inputboxP mt-3" id="numero_facture"></div>';
                html_actif += '     <div class="">';
                html_actif += '    <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span> <button type="submit" form="formPayement" class="btn btn_creer btnP px-3">Encaisser</button> </div>';
                html_actif += '    </div>';
                html_actif += '    </form>';

                html_actif += ' </div>';

                html_actif += ' </div>';
                html_actif += ' </div>';

                /*     html_actif += ' <div id="modal_valide_' + facture_actif[i_actif].cfp_id + '_' + facture_actif[i_actif].num_facture + '" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">';

                     html_actif += '<div class="modal-dialog">';
                     html_actif += '<div class="modal-content">';
                     html_actif += '<div class="modal-header">';
                     html_actif += '<div class="modal-title text-md">';
                     html_actif += '<h6>Encaisser la facture  N° : <span class="text-mued" id="num_fact_encaissement">' + facture_actif[i_actif].num_facture + '</span></h6>';

                     html_actif += '<h5>Reste à payer : <strong><label id="montant"></label> ' + devise.devise + ' ' + facture_actif[i_actif].dernier_montant_ouvert.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim() + '</strong></h5>';
                     html_actif += '</div>';
                     html_actif += '</div>';
                     html_actif += '<div class="modal-body">';
                     html_actif += '<form action="' + url_form_encaissement + '" id="formPayement" method="POST">';
                     html_actif += '@csrf';
                     html_actif += '<input autocomplete="off" type="text" value="' + facture_actif[i_actif].num_facture + '" name="num_facture" class="form-control formPayement" required="required" hidden> </div>';

                     html_actif += '<div class="inputbox inputboxP mt-3  ms-1">';
                     html_actif += '<span>Description</span>';
                     html_actif += ' <textarea autocomplete="off" name="libelle" id="libelle" class="text_description form-control" placeholder="description" rows="5"></textarea>';

                     html_actif += '</div>';
                     html_actif += ' <div class="inputbox inputboxP mt-3  ms-1">';
                     html_actif += ' <span>Montant à facturer</span>';
                     html_actif += ' <input autocomplete="off" type="number" min="1" pattern="[0-9]" name="montant" class="form-control formPayement" required="required" style="height: 50px;"> </div>';

                     html_actif += ' <div class="form-group  mt-3  ms-1">';
                     html_actif += '   <span>Mode de paiement<strong style="color:#ff0000;">*</strong></span>';
                     html_actif += '  <select class="form-select selectP" name="mode_payement" id="mode_payement" aria-label="Default select example" style="height: 50px;">';
                         for (let j = 0; j < mode_payement.lenght; j += 1) {
                             html_actif += '<option value="' + mode_payement[j].id + '">' + mode_payement[j] description + '</option>';
                         }
                     html_actif += '</select>';
                     html_actif += '</div>';
                     html_actif += '<div class="inputbox inputboxP mt-3  ms-1">';
                     html_actif += '<span>Date de paiement<strong style="color:#ff0000;">*</strong></span>';
                     html_actif += '<input type="date" name="date_encaissement" id="date_encaissement" class="form-control formPayement" required="required" style="height: 50px;">';
                     html_actif += ' </div>';
                     html_actif += ' <div class="inputbox inputboxP mt-3" id="numero_facture"></div>';
                     html_actif += '</form>';
                     html_actif += '<div class="mt-4 mb-4">';
                     html_actif += '<div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span> <button type="submit" form="formPayement" class="btn btn_creer btnP px-3">Encaisser</button> </div>';
                     html_actif += '</div>';
                     html_actif += '</div>';
                     html_actif += ' </div>';
                     html_actif += '</div>';
                     html_actif += '</div>'; */

            }
        } else {
            html_actif += '<tr><td colspan = "11" class = "text-center" style = "color:red;" > Aucun Résultat </td> </tr> ';

        }

        return html_actif;
    }

    function getDataFacturePayer(facture_payer, devise) {
        var html_payer = '';
        if (facture_payer.length > 0) {

            for (var i_payer = 0; i_payer < facture_payer.length; i_payer += 1) {

                var url_detail_facture = "{{ route('detail_facture', ':id') }}";
                url_detail_facture = url_detail_facture.replace(":id", facture_payer[i_payer].num_facture);

                var url_liste_encaissement_facture = "{{ route('listeEncaissement', ':id') }}";
                url_liste_encaissement_facture = url_liste_encaissement_facture.replace(":id", facture_payer[i_payer].num_facture);

                var url_pdf_liste_encaissement_facture = "{{ route('pdf+liste+encaissement', ':id') }}";
                url_pdf_liste_encaissement_facture = url_pdf_liste_encaissement_facture.replace(":id", facture_payer[i_payer].num_facture);

                var url_pdf_facture_facture = "{{ route('imprime_feuille_facture', ':id') }}";
                url_pdf_facture_facture = url_pdf_facture_facture.replace(":id", facture_payer[i_payer].num_facture);


                html_payer += " <tr><td> <a href=" + url_detail_facture + ">";

                if (facture_payer[i_payer].reference_type_facture == "Facture") {

                    html_payer += "  <div style='background-color: green; border-radius: 10px; text-align: center;color: white'>" +
                        facture_payer[i_payer].reference_type_facture +
                        "</div>";
                } else if (facture_payer[i_payer].reference_type_facture == "Avoir") {

                    html_payer += "   <div style='background-color: rgb(144, 196, 202); border-radius: 10px; text-align: center;color: white'>" +
                        facture_payer[i_payer].reference_type_facture +
                        " </div> ";
                } else if (facture_payer[i_payer].reference_type_facture == "Acompte") {

                    html_payer += "    <div style='background-color: rgb(140, 137, 137); border-radius: 10px; text-align: center;color: white'> " +
                        facture_payer[i_payer].reference_type_facture +
                        " </div> ";
                } else {

                    html_payer += "   <div style='background-color: rgb(150, 181, 150); border-radius: 10px; text-align: center;color: white'>"; +
                    facture_payer[i_payer].reference_type_facture +
                        " </div>";
                }

                html_payer += "  </a></td><th>";
                html_payer += "  <a href=" + url_detail_facture + ">" + facture_payer[i_payer].num_facture + "   </a> </th> <td>";
                html_payer += "  <a href=" + url_detail_facture + ">" + facture_payer[i_payer].nom_etp + " </a></td><td>";
                html_payer += "  <a href=" + url_detail_facture + ">" + facture_payer[i_payer].invoice_date + " </a> </td><td>";
                html_payer += "  <a href=" + url_detail_facture + ">" + facture_payer[i_payer].due_date + " </a> </td><td>";

                html_payer += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + facture_payer[i_payer].montant_total.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim() + " </a> </td><td>";
                html_payer += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + facture_payer[i_payer].dernier_montant_ouvert.replace(/[^\dA-Z]/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, " ").trim() + " </a> </td><td>";

                html_payer += "  <a href=" + url_detail_facture + "> ";
                html_payer += '<div style="background-color:  rgb(109, 127, 220); border-radius: 10px; text-align: center;color:white">  payé </div>';
                html_payer += " </a> </td><td>";

                html_payer += '<div class="dropdown">';
                html_payer += '<div class="btn-group dropstart">';
                html_payer += '<button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">';
                html_payer += '</button>';
                html_payer += '<ul class="dropdown-menu">';
                html_payer += '<a class="dropdown-item" href="' + url_pdf_facture_facture + '"><button type="button" class="btn "><i class="fa fa-download"></i> PDF Facture</button></a>';
                html_payer += ' <a class="dropdown-item" href="' + url_liste_encaissement_facture + '"><button type="button" class="btn ">Liste des encaissements</button></a>';
                html_payer += '<hr class="dropdown-divider">';
                html_payer += '<a class="dropdown-item" href="' + url_pdf_liste_encaissement_facture + '">';
                html_payer += '<button type="button" class="btn "> <i class="fa fa-download"></i> PDF Encaissement </button></a>';
                html_payer += '</ul> </div></div>';

                html_payer += "</td> </tr>";
            }
        } else {
            html_payer += '<tr><td colspan = "11" class = "text-center" style = "color:red;" > Aucun Résultat </td> </tr> ';
        }
        return html_payer;
    }


    function getDataFacture(response) {
        var valiny = JSON.parse(response);
        var devise = valiny["devise"];

        if (valiny["entiter"] == "OF") {

            var full_facture = valiny["full_facture"];
            var facture_inactif = valiny["facture_inactif"];
            var facture_actif = valiny["facture_actif"];
            var facture_payer = valiny["facture_payer"];

            var html_full = getDataFactureTous(full_facture, devise);
            var html_inactif = getDataFactureBrouillon(facture_inactif, devise);
            var html_actif = getDataFactureValider(facture_actif, devise);
            var html_payer = getDataFacturePayer(facture_payer, devise);


            return {
                "html_full": html_full
                , "html_inactif": html_inactif
                , "html_actif": html_actif
                , "html_payer": html_payer
            };

        } else {
            var full_facture = valiny["full_facture"];
            var facture_actif = valiny["facture_actif"];
            var facture_payer = valiny["facture_payer"];

            var html_full = getDataFactureTous(full_facture, devise);
            var html_actif = getDataFactureValider(facture_actif, devise);
            var html_payer = getDataFacturePayer(facture_payer, devise);

            return {
                "html_full": html_full
                , "html_actif": html_actif
                , "html_payer": html_payer
            };
        }

    }

    /*============================================================================*/
    function getDataRequetTrie(idName, trie_par_rep) {
        var dataValiny = {

            data_value: $(idName).val()
            , nb_pagination_brouillon: @php echo $pagination_brouillon["debut_aff"];@endphp
            , nb_pagination_full: @php echo $pagination_full["debut_aff"];@endphp
            , nb_pagination_actif: @php echo $pagination_actif["debut_aff"];@endphp
            , nb_pagination_payer: @php echo $pagination_payer["debut_aff"];@endphp
            , trie_par: trie_par_rep
        };

        @php
        if (isset($invoice_dte) && isset($due_dte)) {
            @endphp

            dataValiny = {
                data_value: $(idName).val()
                , nb_pagination_brouillon: @php echo $pagination_brouillon["debut_aff"];@endphp
                , nb_pagination_full: @php echo $pagination_full["debut_aff"];@endphp
                , nb_pagination_actif: @php echo $pagination_actif["debut_aff"];@endphp
                , nb_pagination_payer: @php echo $pagination_payer["debut_aff"];@endphp
                , invoice_dte: document.getElementById("debut_dte").value
                , due_dte: document.getElementById("fin_dte").value
                , trie_par: trie_par_rep
            };

            @php
        } else if (isset($solde_debut) && isset($solde_fin)) {
            @endphp


            dataValiny = {
                data_value: $(idName).val()
                , nb_pagination_brouillon: @php echo $pagination_brouillon["debut_aff"];@endphp
                , nb_pagination_full: @php echo $pagination_full["debut_aff"];@endphp
                , nb_pagination_actif: @php echo $pagination_actif["debut_aff"];@endphp
                , nb_pagination_payer: @php echo $pagination_payer["debut_aff"];@endphp
                , solde_debut: @php echo $solde_debut;@endphp
                , solde_fin: @php echo $solde_fin;@endphp
                , trie_par: trie_par_rep
            };

            @php
        } else if (isset($num_fact)) {
            @endphp


            dataValiny = {
                data_value: $(idName).val()
                , nb_pagination_brouillon: @php echo $pagination_brouillon["debut_aff"];@endphp
                , nb_pagination_full: @php echo $pagination_full["debut_aff"];@endphp
                , nb_pagination_actif: @php echo $pagination_actif["debut_aff"];@endphp
                , nb_pagination_payer: @php echo $pagination_payer["debut_aff"];@endphp
                , num_fact: "@php echo $num_fact;@endphp"
                , trie_par: trie_par_rep
            };


            @php
        } else if (isset($entiter_id)) {
            @endphp


            dataValiny = {
                data_value: $(idName).val()
                , nb_pagination_brouillon: @php echo $pagination_brouillon["debut_aff"];@endphp
                , nb_pagination_full: @php echo $pagination_full["debut_aff"];@endphp
                , nb_pagination_actif: @php echo $pagination_actif["debut_aff"];@endphp
                , nb_pagination_payer: @php echo $pagination_payer["debut_aff"];@endphp
                , entiter_id: "@php echo $entiter_id;@endphp"
                , trie_par: trie_par_rep
            };

            @php
        } else if (isset($status)) {
            @endphp

            dataValiny = {
                data_value: $(idName).val()
                , nb_pagination_brouillon: @php echo $pagination_brouillon["debut_aff"];@endphp
                , nb_pagination_full: @php echo $pagination_full["debut_aff"];@endphp
                , nb_pagination_actif: @php echo $pagination_actif["debut_aff"];@endphp
                , nb_pagination_payer: @php echo $pagination_payer["debut_aff"];@endphp
                , status: "@php echo $status;@endphp"
                , trie_par: trie_par_rep
            };

            @php
        }
        @endphp

        return dataValiny;
    }
    /*==============================================================================================*/

    $(".dte_facturation_filtre").on('click', function(e) {
        if (
            $(".dte_facturation_filtre")
            .find(".icon_trie")
            .hasClass("bxs-chevron-down")
        ) {
            $(".dte_facturation_filtre")
                .find(".icon_trie")
                .removeClass("bxs-chevron-down")
                .addClass("bxs-chevron-up");
        } else {
            $(".dte_facturation_filtre")
                .find(".icon_trie")
                .removeClass("bxs-chevron-up")
                .addClass("bxs-chevron-down");
        }
    });

    $(".solde_total_payer_filtre").on('click', function(e) {
        if (
            $(".solde_total_payer_filtre")
            .find(".icon_trie")
            .hasClass("bxs-chevron-down")
        ) {
            $(".solde_total_payer_filtre")
                .find(".icon_trie")
                .removeClass("bxs-chevron-down")
                .addClass("bxs-chevron-up");
        } else {
            $(".solde_total_payer_filtre")
                .find(".icon_trie")
                .removeClass("bxs-chevron-up")
                .addClass("bxs-chevron-down");
        }
    });

    $(".num_fact_filtre").on('click', function(e) {
        if (
            $(".num_fact_filtre")
            .find(".icon_trie")
            .hasClass("bxs-chevron-down")
        ) {
            $(".num_fact_filtre")
                .find(".icon_trie")
                .removeClass("bxs-chevron-down")
                .addClass("bxs-chevron-up");
        } else {
            $(".num_fact_filtre")
                .find(".icon_trie")
                .removeClass("bxs-chevron-up")
                .addClass("bxs-chevron-down");
        }
    });


    $(".entiter_filtre").on('click', function(e) {
        if (
            $(".entiter_filtre")
            .find(".icon_trie")
            .hasClass("bxs-chevron-down")
        ) {
            $(".entiter_filtre")
                .find(".icon_trie")
                .removeClass("bxs-chevron-down")
                .addClass("bxs-chevron-up");
        } else {
            $(".entiter_filtre")
                .find(".icon_trie")
                .removeClass("bxs-chevron-up")
                .addClass("bxs-chevron-down");
        }
    });


    $(".status_filtre").on('click', function(e) {
        if (
            $(".status_filtre")
            .find(".icon_trie")
            .hasClass("bxs-chevron-down")
        ) {
            $(".status_filtre")
                .find(".icon_trie")
                .removeClass("bxs-chevron-down")
                .addClass("bxs-chevron-up");
        } else {
            $(".status_filtre")
                .find(".icon_trie")
                .removeClass("bxs-chevron-up")
                .addClass("bxs-chevron-down");
        }
    });
    /* =================================================================================================*/


    $(".num_fact_trie").on('click', function(e) {
        var valiny = $(this).val();


        if ($(".num_fact_trie").val() == 0) {
            $(".num_fact_trie").val(1);
        } else {

            $(".num_fact_trie").val(0);
        }

        if (
            $(".num_fact_trie")
            .find(".icon_trie")
            .hasClass("fa-arrow-down")
        ) {
            $(".num_fact_trie")
                .find(".icon_trie")
                .removeClass("fa-arrow-down")
                .addClass("color-text-trie")
                .addClass("fa-arrow-up");
        } else {
            $(".num_fact_trie")
                .find(".icon_trie")
                .removeClass("fa-arrow-up")
                .addClass("color-text-trie")
                .addClass("fa-arrow-down");
        }

        $('.nom_entiter_trie')
            .find(".icon_trie")
            .removeClass("fa-arrow-up")
            .removeClass("color-text-trie")
            .addClass("fa-arrow-down");

        $('.dte_reglement_trie')
            .find(".icon_trie")
            .removeClass("fa-arrow-up")
            .removeClass("color-text-trie")
            .addClass("fa-arrow-down");

        $('.total_payer_trie')
            .find(".icon_trie")
            .removeClass("fa-arrow-up")
            .removeClass("color-text-trie")
            .addClass("fa-arrow-down");

        $('.rest_payer_trie')
            .find(".icon_trie")
            .removeClass("fa-arrow-up")
            .removeClass("color-text-trie")
            .addClass("fa-arrow-down");

        var dataValue = getDataRequetTrie(".num_fact_trie", "NUM_FACT");

        $.ajax({
            method: "GET"
            , url: "{{route('facture.trie')}}"
            , data: dataValue
            , dataType: "html"
            , success: function(response) {

                var valiny = JSON.parse(response);
                var resultat = getDataFacture(response);

                if (valiny["entiter"] == "OF") {
                    $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                    $('#list_data_trie_brouillon').empty().append(resultat["html_inactif"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                } else {
                    $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                }

            }
            , error: function(error) {
                console.log(error)
            }
        });

    });

    /*--------------------------------------------- Nom Entité-----------------------------------------------------------------------*/

    $(".nom_entiter_trie").on('click', function(e) {
        var valiny = $(this).val();

        if (
            $(".nom_entiter_trie")
            .find(".icon_trie")
            .hasClass("fa-arrow-down")
        ) {
            $(".nom_entiter_trie")
                .find(".icon_trie")
                .removeClass("fa-arrow-down")
                .addClass("color-text-trie")
                .addClass("fa-arrow-up");
        } else {
            $(".nom_entiter_trie")
                .find(".icon_trie")
                .removeClass("fa-arrow-up")
                .addClass("color-text-trie")
                .addClass("fa-arrow-down");
        }

        $('.num_fact_trie')
            .find(".icon_trie")
            .removeClass("color-text-trie")
            .removeClass("fa-arrow-up")
            .addClass("fa-arrow-down");

        $('.dte_reglement_trie')
            .find(".icon_trie")
            .removeClass("color-text-trie")
            .removeClass("fa-arrow-up")
            .addClass("fa-arrow-down");

        $('.total_payer_trie')
            .find(".icon_trie")
            .removeClass("color-text-trie")
            .removeClass("fa-arrow-up")
            .addClass("fa-arrow-down");

        $('.rest_payer_trie')
            .find(".icon_trie")
            .removeClass("color-text-trie")
            .removeClass("fa-arrow-up")
            .addClass("fa-arrow-down");

        if ($(".nom_entiter_trie").val() == 0) {
            $(".nom_entiter_trie").val(1);
        } else {
            $(".nom_entiter_trie").val(0);
        }

        var dataValue = getDataRequetTrie(".nom_entiter_trie", "ENTITE");

        $.ajax({
            method: "GET"
            , url: "{{route('facture.trie')}}"
            , data: dataValue
            , dataType: "html"
            , success: function(response) {

                var valiny = JSON.parse(response);
                var resultat = getDataFacture(response);

                if (valiny["entiter"] == "OF") {
                    $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                    $('#list_data_trie_brouillon').empty().append(resultat["html_inactif"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                } else {
                    $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                }


            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    /*--------------------------------------------- Date de règlement -----------------------------------------------------------------------*/

    $(".dte_reglement_trie").on('click', function(e) {
        var valiny = $(this).val();

        if (
            $(".dte_reglement_trie")
            .find(".icon_trie")
            .hasClass("fa-arrow-down")
        ) {
            $(".dte_reglement_trie")
                .find(".icon_trie")
                .removeClass("fa-arrow-down")
                .addClass("color-text-trie")
                .addClass("fa-arrow-up");
        } else {
            $(".dte_reglement_trie")
                .find(".icon_trie")
                .removeClass("fa-arrow-up")
                .addClass("color-text-trie")
                .addClass("fa-arrow-down");
        }


        $('.num_fact_trie')
            .find(".icon_trie")
            .removeClass("fa-arrow-up")
            .removeClass("color-text-trie")
            .addClass("fa-arrow-down");

        $('.nom_entiter_trie')
            .find(".icon_trie")
            .removeClass("fa-arrow-up")
            .removeClass("color-text-trie")
            .addClass("fa-arrow-down");

        $('.total_payer_trie')
            .find(".icon_trie")
            .removeClass("fa-arrow-up")
            .removeClass("color-text-trie")
            .addClass("fa-arrow-down");

        $('.rest_payer_trie')
            .find(".icon_trie")
            .removeClass("fa-arrow-up")
            .removeClass("color-text-trie")
            .addClass("fa-arrow-down");

        if ($(".dte_reglement_trie").val() == 0) {
            $(".dte_reglement_trie").val(1);
        } else {
            $(".dte_reglement_trie").val(0);
        }

        var dataValue = getDataRequetTrie(".dte_reglement_trie", "DUE_DTE");

        $.ajax({
            method: "GET"
            , url: "{{route('facture.trie')}}"
            , data: dataValue
            , dataType: "html"
            , success: function(response) {

                var valiny = JSON.parse(response);
                var resultat = getDataFacture(response);

                if (valiny["entiter"] == "OF") {
                    $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                    $('#list_data_trie_brouillon').empty().append(resultat["html_inactif"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                } else {
                    $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                }

            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    /*--------------------------------------------- Totale à payer -----------------------------------------------------------------------*/

    $(".total_payer_trie").on('click', function(e) {
        var valiny = $(this).val();

        if (
            $(".total_payer_trie")
            .find(".icon_trie")
            .hasClass("fa-arrow-down")
        ) {
            $(".total_payer_trie")
                .find(".icon_trie")
                .removeClass("fa-arrow-down")
                .addClass("color-text-trie")
                .addClass("fa-arrow-up");
        } else {
            $(".total_payer_trie")
                .find(".icon_trie")
                .removeClass("fa-arrow-up")
                .addClass("color-text-trie")
                .addClass("fa-arrow-down");
        }

        $('.num_fact_trie')
            .find(".icon_trie")
            .removeClass("fa-arrow-up")
            .removeClass("color-text-trie")
            .addClass("fa-arrow-down");

        $('.nom_entiter_trie')
            .find(".icon_trie")
            .removeClass("fa-arrow-up")
            .removeClass("color-text-trie")
            .addClass("fa-arrow-down");

        $('.dte_reglement_trie')
            .find(".icon_trie")
            .removeClass("fa-arrow-up")
            .removeClass("color-text-trie")
            .addClass("fa-arrow-down");

        $('.rest_payer_trie')
            .find(".icon_trie")
            .removeClass("fa-arrow-up")
            .removeClass("color-text-trie")
            .addClass("fa-arrow-down");
        if ($(".total_payer_trie").val() == 0) {
            $(".total_payer_trie").val(1);
        } else {
            $(".total_payer_trie").val(0);
        }

        var dataValue = getDataRequetTrie(".total_payer_trie", "TOTAL_SOLDE");

        $.ajax({
            method: "GET"
            , url: "{{route('facture.trie')}}"
            , data: dataValue
            , dataType: "html"
            , success: function(response) {

                var valiny = JSON.parse(response);
                var resultat = getDataFacture(response);
                if (valiny["entiter"] == "OF") {
                    $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                    $('#list_data_trie_brouillon').empty().append(resultat["html_inactif"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                } else {
                    $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    /*--------------------------------------------- Totale reste à payer -----------------------------------------------------------------------*/

    $(".rest_payer_trie").on('click', function(e) {
        var valiny = $(this).val();

        if (
            $(".rest_payer_trie")
            .find(".icon_trie")
            .hasClass("fa-arrow-down")
        ) {
            $(".rest_payer_trie")
                .find(".icon_trie")
                .removeClass("fa-arrow-down")
                .addClass("color-text-trie")
                .addClass("fa-arrow-up");
        } else {
            $(".rest_payer_trie")
                .find(".icon_trie")
                .removeClass("fa-arrow-up")
                .addClass("color-text-trie")
                .addClass("fa-arrow-down");
        }

        $('.num_fact_trie')
            .find(".icon_trie")
            .removeClass("color-text-trie")
            .removeClass("fa-arrow-up")
            .addClass("fa-arrow-down");

        $('.nom_entiter_trie')
            .find(".icon_trie")
            .removeClass("color-text-trie")
            .removeClass("fa-arrow-up")
            .addClass("fa-arrow-down");

        $('.dte_reglement_trie')
            .find(".icon_trie")
            .removeClass("color-text-trie")
            .removeClass("fa-arrow-up")
            .addClass("fa-arrow-down");

        $('.total_payer_trie')
            .find(".icon_trie")
            .removeClass("color-text-trie")
            .removeClass("fa-arrow-up")
            .addClass("fa-arrow-down");
        if ($(".rest_payer_trie").val() == 0) {
            $(".rest_payer_trie").val(1);
        } else {
            $(".rest_payer_trie").val(0);
        }

        var dataValue = getDataRequetTrie(".rest_payer_trie", "RESTE_SOLDE");

        $.ajax({
            method: "GET"
            , url: "{{route('facture.trie')}}"
            , data: dataValue
            , dataType: "html"
            , success: function(response) {

                var valiny = JSON.parse(response);
                var resultat = getDataFacture(response);
                if (valiny["entiter"] == "OF") {
                    $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                    $('#list_data_trie_brouillon').empty().append(resultat["html_inactif"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                } else {
                    $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                }

            }
            , error: function(error) {
                console.log(error)
            }
        });
    });



    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

</script>
