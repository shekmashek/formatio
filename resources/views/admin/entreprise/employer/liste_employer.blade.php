@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Liste employer</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">

<style>
    table,
    th {
        font-size: 11px;
    }

    table,
    td {
        font-size: 11px;
    }

    .nav_bar_list:hover {
        background-color: transparent;
    }

    .nav_bar_list .nav-item:hover {
        border-bottom: 2px solid black;
    }

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

    .status_grise {
        border-radius: 1rem;
        background-color: #637381;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_reprogrammer {
        border-radius: 1rem;
        background-color: #00CDAC;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_cloturer {
        border-radius: 1rem;
        background-color: #314755;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_reporter {
        border-radius: 1rem;
        background-color: #26a0da;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_annulee {
        border-radius: 1rem;
        background-color: #b31217;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_termine {
        border-radius: 1rem;
        background-color: #1E9600;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .status_confirme {
        border-radius: 1rem;
        background-color: #2B32B2;
        color: white;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    .statut_active {
        border-radius: 1rem;
        background-color: rgb(15, 126, 145);
        color: whitesmoke;
        width: 60%;
        align-items: center margin: 0 auto;
    }

    /* .filter{
    position: relative;
    bottom: .5rem;
    float: right;
} */
    .btn_creer {
        background-color: white;
        border: none;
        border-radius: 30px;
        padding: .2rem 1rem;
        color: black;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    }

    .btn_creer a {
        font-size: .8rem;
        position: relative;
        bottom: .2rem;
    }

    .btn_creer:hover {
        background: #6373812a;
        color: blue;
    }

    .btn_creer:focus {
        color: blue;
        text-decoration: none;
    }

    .icon_creer {
        background-image: linear-gradient(60deg, #f206ee, #0765f3);
        background-clip: text;
        -webkit-background-clip: text;
        color: transparent;
        font-size: 1.5rem;
        position: relative;
        top: .4rem;
        margin-right: .3rem;
    }

    .pagination {
        background-clip: text;
        margin-right: .3rem;
        font-size: 2rem;
        position: relative;
        top: .7rem;
    }

    .pagination:hover {
        color: #000000;
        background-color: rgb(239, 239, 239);
        border-radius: 1.3rem;
    }

    .nombre_pagination {
        color: #626262;

    }

    .color-text-trie {
        color: blue;
    }

</style>

<div class="container-fluid">
    <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Filtre</a>
    <span class="nombre_pagination text-center filter"><span style="position: relative; bottom: -0.2rem">1-5 sur 10</span>
        <a href="#" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="#" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
    </span>

    <div class="m-4">

        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <a href="{{route('employes.liste')}}" class="nav-link active">
                   liste des employers
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('departement.create')}}" class="nav-link">
                   nouveau
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('employes.export.nouveau')}}" class="nav-link">
                    export employer
                </a>
            </li>
        </ul>
        <div class="row">
            <div class="col-12">

                <table class="table  table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Photo</th>
                            <th scope="col">Matricule &nbsp; <a href="#" style="color: blue"> <button class="btn btn_creer_trie num_fact_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                            </th>
                            <th scope="col">Nom &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                            </th>
                            <th scope="col">Prénom</th>
                            <th scope="col">E-mail &nbsp; <button class="btn btn_creer_trie dte_reglement_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                            </th>
                            <th scope="col">Télephone &nbsp; <button class="btn btn_creer_trie total_payer_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                            </th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="list_data_trie_valider">
                        <tr>
                            <td>
                                <a href="#">
                                    <p class="randomColor text-center" style="color:white; font-size: 10px; border: none; border-radius: 100%; height:30px; width:30px ;">
                                        <span class="" style="position:relative; top: .5rem;"><b>ANF</b></span>
                                    </p>
                                    {{-- @if($referent[$i]->photos == null)
                                    <center>
                                        <p class="randomColor text-center" style="color:white; font-size: 15px; border: none; border-radius: 100%; height:50px; width:50px ;">
                                            <span class="" style="position:relative; top: .9rem;"><b>{{$referent[$i]->nm}}{{$referent[$i]->pr}}</b></span>
                                        </p>
                                    </center>
                                    @else
                                    <a href="{{asset('images/responsables/'.$referent[$i]->photos)}}"><img title="clicker pour voir l'image" src="{{asset('images/responsables/'.$referent[$i]->photos)}}" style="width:50px; height:50px; border-radius:100%; font-size:15px"></a>
                                    @endif --}}

                                </a>
                            </td>
                            <td>
                                <span style="color:green; "> <i class="bx bxs-circle"></i> </span> ETU000976
                            </td>
                            <th>
                                ANTOENJARA (teste)
                            </th>
                            <td>
                                Noam Francisco
                            </td>
                            <td>
                                antoenjara1998@gmail.com
                            </td>
                            <td>
                                032 86 837 25
                            </td>
                             <td>
                                <div class="dropdown">
                                    <div class="btn-group dropstart">
                                        <button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                        </button>
                                        <ul class="dropdown-menu">
                                            <li class="dropdown-item">
                                                desactiver
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="#">
                                                    <button type="submit" class="btn "><span class="fa fa-trash"></span> Retiré dans le plateforme</button>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>

                        </tr>

                    </tbody>
                </table>
            </div>


            <div class="filtrer mt-3">
                <div class="row">
                    <div class="col">
                        <p class="m-0">Filtre</p>
                    </div>
                    <div class="col text-end">
                        <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
                    </div>
                    <hr class="mt-2">
                    <div class="row mt-0">
                        <p>
                            <a data-bs-toggle="collapse" href="#detail_par_thematique" role="button" aria-expanded="false" aria-controls="detail_par_thematique">Recherche par intervale de date de facturation</a>
                        </p>
                        <div class="collapse multi-collapse" id="detail_par_thematique">
                            <form class="mt-1 mb-2 form_colab" action="{{route('search_par_date')}}" method="GET" enctype="multipart/form-data">
                                @csrf
                                <label for="dte_debut" class="form-label" align="left"> Date de facturation <strong style="color:#ff0000;">*</strong></label>
                                <input required type="date" name="dte_debut" id="dte_debut" class="form-control" />
                                <br>
                                <label for="dte_fin" class="form-label" align="left">Date de règlement <strong style="color:#ff0000;">*</strong></label>
                                <input required type="date" name="dte_fin" id="dte_fin" class="form-control" />
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </form>
                        </div>
                        <hr>
                        <p>
                            <a data-bs-toggle="collapse" href="#search_num_fact" role="button" aria-expanded="false" aria-controls="search_num_fact">Recherche par N° facture</a>
                        </p>
                        <div class="collapse multi-collapse" id="search_num_fact">
                            <form class=" mt-1 mb-2 form_colab" method="GET" action="{{route('search_par_num_fact')}}" enctype="multipart/form-data">
                                @csrf
                                <label for="num_fact" class="form-control-placeholder">N° facture<strong style="color:#ff0000;">*</strong></label>
                                <input name="num_fact" id="num_fact" required class="form-control" required type="text" aria-label="Search" placeholder="Numero Facture">
                                <input type="submit" class="btn_creer mt-2" id="exampleFormControlInput1" value="Recherce" />
                            </form>
                        </div>
                        <hr>

                        <p>
                            <a data-bs-toggle="collapse" href="#detail_par_etp" role="button" aria-expanded="false" aria-controls="detail_par_etp">Recherche par activité</a>
                        </p>
                        <div class="collapse multi-collapse" id="detail_par_etp">
                            <form class="mt-1 mb-2 form_colab" action="#" method="GET" enctype="multipart/form-data">
                                @csrf
                                <label for="dte_debut" class="form-label" align="left">Organisme de formation<strong style="color:#ff0000;">*</strong></label>
                                <br>
                                <select class="form-select" autocomplete="on">
                                  <option value="">actif</option>
                                  <option value="">inactif</option>
                                </select>
                                <br>
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </form>
                        </div>
                        <hr>

                    </div>
                </div>
            </div>



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

                    var facture_actif = valiny["facture_actif"];
                    var facture_payer = valiny["facture_payer"];
                    var html_actif = getDataFactureValider(facture_actif, devise);
                    var html_payer = getDataFacturePayer(facture_payer, devise);
                    return {
                        "html_actif": html_actif
                        , "html_payer": html_payer
                    };
                }



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

                    $.ajax({
                        method: "GET"
                        , url: "{{route('trie_par_num_facture')}}"
                        , data: {
                            data_value: $(this).val()
                            , nb_pagination:0
                        }
                        , dataType: "html"
                        , success: function(response) {



                            var valiny = JSON.parse(response);
                            var resultat = getDataFacture(response);

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

                    $.ajax({
                        method: "GET"
                        , url: "{{route('trie_par_entiter')}}"
                        , data: {
                            data_value: $(this).val()
                        }
                        , dataType: "html"
                        , success: function(response) {

                            var valiny = JSON.parse(response);
                            var resultat = getDataFacture(response);

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

                    $.ajax({
                        method: "GET"
                        , url: "{{route('trie_par_dte')}}"
                        , data: {
                            data_value: $(this).val()
                        }
                        , dataType: "html"
                        , success: function(response) {

                            var valiny = JSON.parse(response);
                            var resultat = getDataFacture(response);

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

                    $.ajax({
                        method: "GET"
                        , url: "{{route('trie_par_totale_payer')}}"
                        , data: {
                            data_value: $(this).val()

                        }
                        , dataType: "html"
                        , success: function(response) {



                            var valiny = JSON.parse(response);
                            var resultat = getDataFacture(response);

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

                    $.ajax({
                        method: "GET"
                        , url: "{{route('trie_par_reste_payer')}}"
                        , data: {
                            data_value: $(this).val()

                        }
                        , dataType: "html"
                        , success: function(response) {

                            var valiny = JSON.parse(response);
                            var resultat = getDataFacture(response);

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


            @endsection
