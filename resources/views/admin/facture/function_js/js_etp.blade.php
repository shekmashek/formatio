<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
    $(document).on("keyup change", "#dte_debut", function() {
        document.getElementById("dte_fin").setAttribute("min", $(this).val());
    });

    $(document).on("keyup change", "#solde_debut", function() {
        document.getElementById("solde_fin").setAttribute("min", $(this).val());
        $("#solde_fin").val($(this).val());
    });



    /*------------------------------------------------- Numero Facture-------------------------------------------------------------------*/


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

                if (full_facture[i_act].reference_type_facture == "Acompte") {
                    console.log(JSON.stringify(full_facture[i_act]));
                }
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
                }

                html_tous += "  </a></td><th>";
                html_tous += "  <a href=" + url_detail_facture + ">" + full_facture[i_act].num_facture + "   </a> </th> <td>";
                html_tous += "  <a href=" + url_detail_facture + ">" + full_facture[i_act].nom_etp + " </a></td><td>";
                html_tous += "  <a href=" + url_detail_facture + ">" + full_facture[i_act].invoice_date + " </a> </td><td>";
                html_tous += "  <a href=" + url_detail_facture + ">" + full_facture[i_act].due_date + " </a> </td><td>";

                html_tous += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + number_format(full_facture[i_act].montant_total, 0, ",", " ") + " </a> </td><td>";
                html_tous += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + number_format(full_facture[i_act].dernier_montant_ouvert, 0, ",", " ") + " </a> </td><td>";

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


                html_tous += "</tr>";

            }
        } else {
            html_tous += '<tr><td colspan = "9" class = "text-center" style = "color:red;" > Aucun Résultat </td> </tr> ';
        }
        return html_tous;
    }

    function getDataFactureValider(facture_actif, devise) {
        var html_actif = '';

        if (facture_actif.length > 0) {

            for (var i_actif = 0; i_actif < facture_actif.length; i_actif += 1) {

                var url_detail_facture = "{{ route('detail_facture_etp', [':id',':id2']) }}";
                url_detail_facture = url_detail_facture.replace(":id", facture_actif[i_actif].cfp_id);
                url_detail_facture = url_detail_facture.replace(":id2", facture_actif[i_actif].num_facture);

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

                    html_actif += "   <div style='background-color: rgb(150, 181, 150); border-radius: 10px; text-align: center;color: white'>"; +
                    facture_actif[i_actif].reference_type_facture +
                        " </div>";
                }

                html_actif += "  </a></td><th>";
                html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].num_facture + "   </a> </th> <td>";
                html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].nom_cfp + " </a></td><td>";
                html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].invoice_date + " </a> </td><td>";
                html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].due_date + " </a> </td><td>";

                html_actif += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + number_format(facture_actif[i_actif].montant_total, 0, ",", " ") + " </a> </td><td>";
                html_actif += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + number_format(facture_actif[i_actif].dernier_montant_ouvert, 0, ",", " ") + " </a> </td><td>";



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
                html_actif += " </a> </td>";



                html_actif += "</tr>";


            }
        } else {
            html_actif += '<tr><td colspan = "10" class = "text-center" style = "color:red;" > Aucun Résultat </td> </tr> ';

        }

        return html_actif;
    }

    function getDataFacturePayer(facture_payer, devise) {
        var html_payer = '';
        if (facture_payer.length > 0) {

            for (var i_payer = 0; i_payer < facture_payer.length; i_payer += 1) {

                var url_detail_facture = "{{ route('detail_facture_etp', [':id',':id2']) }}";
                url_detail_facture = url_detail_facture.replace(":id", facture_payer[i_payer].cfp_id);
                url_detail_facture = url_detail_facture.replace(":id2", facture_payer[i_payer].num_facture);

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

                    html_payer += "    <div style='background-color: rgb(140, 137, 137); border-radius: 10px; text-align: center;color: white'> "; +
                    facture_payer[i_payer].reference_type_facture +
                        " </div> ";
                } else {

                    html_payer += "   <div style='background-color: rgb(150, 181, 150); border-radius: 10px; text-align: center;color: white'>"; +
                    facture_payer[i_payer].reference_type_facture +
                        " </div>";
                }

                html_payer += "  </a></td><th>";
                html_payer += "  <a href=" + url_detail_facture + ">" + facture_payer[i_payer].num_facture + "   </a> </th> <td>";
                html_payer += "  <a href=" + url_detail_facture + ">" + facture_payer[i_payer].nom_cfp + " </a></td><td>";
                html_payer += "  <a href=" + url_detail_facture + ">" + facture_payer[i_payer].invoice_date + " </a> </td><td>";
                html_payer += "  <a href=" + url_detail_facture + ">" + facture_payer[i_payer].due_date + " </a> </td><td>";

                html_payer += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + number_format(facture_payer[i_payer].montant_total, 0, ",", " ") + " </a> </td><td>";
                html_payer += "  <a href=" + url_detail_facture + ">  " + devise.devise + " " + number_format(facture_payer[i_payer].dernier_montant_ouvert, 0, ",", " ") + " </a> </td><td>";

                html_payer += "  <a href=" + url_detail_facture + "> ";
                html_payer += '<div style="background-color:  rgb(109, 127, 220); border-radius: 10px; text-align: center;color:white">  payé </div>';
                html_payer += " </a> </td>";

                html_payer += "</tr>";
            }
        } else {
            html_payer += '<tr><td colspan = "10" class = "text-center" style = "color:red;" > Aucun Résultat </td> </tr> ';
        }
        return html_payer;
    }


    function getDataFacture(response) {
        var valiny = JSON.parse(response);
        var devise = valiny["devise"];

        var full_facture = valiny["full_facture"];
        var facture_actif = valiny["facture_actif"];
        var facture_payer = valiny["facture_payer"];

        var html_full = getDataFactureTous(full_facture, devise);
        var html_actif = getDataFactureValider(facture_actif, devise);
        var html_payer = getDataFacturePayer(facture_payer, devise);
        return {
            "html_full": html_full
            ,"html_actif": html_actif
            , "html_payer": html_payer
        };
    }



    /*============================================================================*/
    function getDataRequetTrie(idName, trie_par_rep) {
        var dataValiny = {

            data_value: $(idName).val()
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
                , nb_pagination_full: @php echo $pagination_full["debut_aff"];@endphp
                , nb_pagination_actif: @php echo $pagination_actif["debut_aff"];@endphp
                , nb_pagination_payer: @php echo $pagination_payer["debut_aff"];@endphp
                , entiter_id: "@php echo $entiter_id;@endphp"
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

    /*==============================================================================================*/

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

                $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                $('#list_data_trie_payer').empty().append(resultat["html_payer"]);

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

                $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                $('#list_data_trie_payer').empty().append(resultat["html_payer"]);

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

                $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
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

                $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
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

                    $('#list_data_trie_tous').empty().append(resultat["html_full"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);

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
