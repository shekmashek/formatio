<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">

$(document).ready(function() {
                    $("#myModal").modal('show');
                });

/*--------------------------------------------------------------------------------------------------------------------*/
                $(document).on("keyup change", "#dte_debut", function() {
                    document.getElementById("dte_fin").setAttribute("min", $(this).val());
                });

                $(document).on("keyup change", "#solde_debut", function() {
                    document.getElementById("solde_fin").setAttribute("min", $(this).val());
                    $("#solde_fin").val($(this).val());
                });
/*--------------------------------------------------------------------------------------------------------------------*/
                $(".payement").on('click', function(e) {
                    $('#montant').html('');
                    $('#num_fact_encaissement').html('');
                    $("#numero_facture").html('')
                    var id = $(this).data("id");
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
/*--------------------------------------------------------------------------------------------------------------------*/

       $(".num_fact_trie").on('click', function(e) {
            var valiny = $(this).val();

            if ($(this).val() == 0) {
                $(this).val(1);
            } else {
                $(this).val(0);
            }

            $.ajax({
                method: "GET"
                , url: "{{route('trie_par_num_facture')}}"
                , data: {
                    data_num_fact_trie: $(this).val()
                    , nb_pagination: @php echo $pagination["debut_aff"];@endphp
                }
                , dataType: "html"
                , success: function(response) {
                    var valiny = JSON.parse(response);

                    console.log(JSON.stringify(valiny["dernier_ordre"]));
                    var facture_inactif = valiny["facture_inactif"];

                    var facture_actif = valiny["facture_actif"];
                    var facture_payer = valiny["facture_payer"];

                    var html_inactif = '';
                    var html_actif = '';
                    var html_payer = '';


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

                                html_inactif += "    <div style='background-color: rgb(140, 137, 137); border-radius: 10px; text-align: center;color: white'> "; +
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

                            let test = "" + Math.round(facture_inactif[i_act].montant_total);
                            let montant_total = test.match(/.{1,3}/g).join(" ");
                            let test1 = "" + Math.round(facture_inactif[i_act].dernier_montant_ouvert);
                            let dernier_montant_ouvert = test.match(/.{1,3}/g).join(" ");

                            html_inactif += "  <a href=" + url_detail_facture + ">  Ar " + montant_total + " </a> </td><td>";
                            html_inactif += "  <a href=" + url_detail_facture + ">  Ar " + dernier_montant_ouvert + " </a> </td><td>";

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
                            html_inactif += ' <a href="' + url_edit_facture + '">  <button type="button" class="btn"><i class="fa fa-edit"></i> Modifier facture</button>';
                            html_inactif += '</a></li> <li class = "dropdown-item"> ';
                            html_inactif += '<form action = "' + url_form_facture + '" method = "POST">';
                            html_inactif += '@csrf';
                            html_inactif += '<input name = "num_facture" type = "hidden" value = "' + facture_inactif[i_act].num_facture + '" >';
                            html_inactif += '<button type="submit" class="btn ">Valider facture</button>';
                            html_inactif += "</form>";
                            html_inactif += "</li> <li>";
                            html_inactif += '<a class="dropdown-item" href="' + url_delete_facture + '">';
                            html_inactif += '<button type="submit" class="btn "><span class="fa fa-trash"></span> Supprimer</button>';
                            html_inactif += " </a> </li></ul> </div> </div></td> </tr>";


                        }
                    } else {
                        html_inactif += '<tr><td colspan = "10" class = "text-center" style = "color:red;" > Aucun Résultat </td> </tr> ';

                    }

                    // ======================= pour les facture valider

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
                            html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].nom_etp + " </a></td><td>";
                            html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].invoice_date + " </a> </td><td>";
                            html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].due_date + " </a> </td><td>";

                            let test = "" + Math.round(facture_actif[i_actif].montant_total);
                            let montant_total = test.match(/.{1,3}/g).join(" ");
                            let test1 = "" + Math.round(facture_actif[i_actif].dernier_montant_ouvert);
                            let dernier_montant_ouvert = test.match(/.{1,3}/g).join(" ");

                            html_actif += "  <a href=" + url_detail_facture + ">  Ar " + montant_total + " </a> </td><td>";
                            html_actif += "  <a href=" + url_detail_facture + ">  Ar " + dernier_montant_ouvert + " </a> </td><td>";


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
                                html_actif += ' <button type="button" class=" btn  payement" data-id="' + facture_actif[i_actif].num_facture + '" id="' + facture_actif[i_actif].num_facture + '" data-bs-toggle="modal" data-bs-target="#modal">Faire un encaissement</button>';
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
                                html_actif += '<button type="button" class=" btn  payement" data-id="' + facture_actif[i_actif].num_facture + '" id="' + facture_actif[i_actif].num_facture + '" data-bs-toggle="modal" data-bs-target="#modal">Faire un encaissement</button>';
                                html_actif += '</a>'
                                html_actif += ' <a class="dropdown-item" href="' + url_liste_encaissement_facture + '"><button type="button" class="btn ">Liste des encaissements</button></a>';
                                html_actif += '<hr class="dropdown-divider">';
                                html_actif += '<a class="dropdown-item" href="' + url_pdf_liste_encaissement_facture + '">';
                                html_actif += '<button type="button" class="btn "> <i class="fa fa-download"></i> PDF Encaissement </button></a>';
                                html_actif += '</ul> </div></div>';

                            }

                            html_actif += "</td> </tr>";
                        }
                    } else {
                        html_actif += '<tr><td colspan = "11" class = "text-center" style = "color:red;" > Aucun Résultat </td> </tr> ';

                    }

                    // ======================= pour les facture payé

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
                            html_payer += "  <a href=" + url_detail_facture + ">" + facture_payer[i_payer].nom_etp + " </a></td><td>";
                            html_payer += "  <a href=" + url_detail_facture + ">" + facture_payer[i_payer].invoice_date + " </a> </td><td>";
                            html_payer += "  <a href=" + url_detail_facture + ">" + facture_payer[i_payer].due_date + " </a> </td><td>";

                            let test = "" + Math.round(facture_payer[i_payer].montant_total);
                            let montant_total = test.match(/.{1,3}/g).join(" ");
                            let test1 = "" + Math.round(facture_payer[i_payer].dernier_montant_ouvert);
                            let dernier_montant_ouvert = test.match(/.{1,3}/g).join(" ");

                            html_payer += "  <a href=" + url_detail_facture + ">  Ar " + montant_total + " </a> </td><td>";
                            html_payer += "  <a href=" + url_detail_facture + ">  Ar " + dernier_montant_ouvert + " </a> </td><td>";
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

                    $('#list_data_trie_brouillon').empty().append(html_inactif);
                    $('#list_data_trie_valider').empty().append(html_actif);
                    $('#list_data_trie_payer').empty().append(html_payer);

                }
                , error: function(error) {
                    console.log(error)
                }
            });
        });

    </script>
