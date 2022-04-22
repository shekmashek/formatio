@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Facture</p>
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

</style>

<div class="container-fluid">
    <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>filtrer</a>
    <span class="nombre_pagination text-center filter"><span style="position: relative; bottom: -0.2rem">{{$pagination["debut_aff"]."-".$pagination["fin_aff"]." sur ".$pagination["totale_pagination"]}}</span>

        @if ($pagination["fin_aff"] >= $pagination["totale_pagination"])
        <a href="{{ route('liste_facture',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('liste_facture',$pagination["debut_aff"] + $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif ($pagination["debut_aff"] == 1)
        <a href="{{ route('liste_facture',$pagination["debut_aff"] - $pagination["nb_limit"])}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('liste_facture',$pagination["debut_aff"] + $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif ($pagination["debut_aff"] < $pagination["totale_pagination"] && $pagination["debut_aff"]> 1)
            <a href="{{route('liste_facture',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
            <a href="{{  route('liste_facture',$pagination["debut_aff"] + $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

            @else
            <a href="{{ route('liste_facture',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
            <a href="{{ route('liste_facture',$pagination["debut_aff"] + $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
            @endif
    </span>
    <div class="m-4">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            {{-- <li></li> --}}
            <li class="nav-item">
                <a href="{{route('liste_facture')}}" class="nav-link">
                    TOUT
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" id="nav-valide-tab" data-bs-toggle="tab" data-bs-target="#nav-valide" type="button" role="tab" aria-controls="nav-valide" aria-selected="false">
                    Impayé
                    @if (count($facture_actif) > 0)
                    {{count($facture_actif)}}
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" id=" nav-payer-tab" data-bs-toggle="tab" data-bs-target="#nav-payer" type="button" role="tab" aria-controls="nav-payer" aria-selected="false">
                    Payé
                    @if (count($facture_payer) > 0)
                    {{count($facture_payer)}}
                    @endif
                </a>
            </li>
        </ul>


        <div class="row">
            <div class="col-12">

                <div class="tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="nav-valide" role="tabpanel" aria-labelledby="nav-valide-tab">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">N° facture <a href="#" style="color: blue"> <button class="btn btn_creer_trie"><i class="fa fa-arrow-down"></i></button> </a>
                                    </th>
                                    <th scope="col">Organisme de formation &nbsp; <a href="#" style="color: blue"> <button class="btn btn_creer_trie"><i class="fa fa-arrow-down"></i></button> </a>

                                    </th>
                                    <th scope="col">Date de facturation</th>
                                    <th scope="col">Date de règlement &nbsp; <a href="#" style="color: blue"> <button class="btn btn_creer_trie"><i class="fa fa-arrow-down"></i></button> </a>

                                    </th>
                                    <th scope="col">Total à payer &nbsp; <a href="#" style="color: blue"> <button class="btn btn_creer_trie"><i class="fa fa-arrow-down"></i></button> </a>

                                    </th>
                                    <th scope="col">Reste à payer &nbsp; <a href="#" style="color: blue"> <button class="btn btn_creer_trie"><i class="fa fa-arrow-down"></i></button> </a>

                                    </th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($facture_actif) > 0)
                                @foreach ($facture_actif as $actif)
                                <tr>
                                    <td>
                                        <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">

                                            @if ($actif->reference_type_facture == "Facture")
                                            <div style="background-color: green; border-radius: 10px; text-align: center;color: white">
                                                {{$actif->reference_type_facture}}
                                            </div>
                                            @elseif($actif->reference_type_facture == "Avoir")
                                            <div style="background-color: rgb(144, 196, 202); border-radius: 10px; text-align: center;color: white">
                                                {{$actif->reference_type_facture}}
                                            </div>
                                            @elseif($actif->reference_type_facture == "Acompte")
                                            <div style="background-color: rgb(140, 137, 137); border-radius: 10px; text-align: center;color: white">
                                                {{$actif->reference_type_facture}}
                                            </div>
                                            @else
                                            <div style="background-color: rgb(150, 181, 150); border-radius: 10px; text-align: center;color: white">
                                                {{$actif->reference_type_facture}}
                                            </div>
                                            @endif

                                        </a>
                                    </td>
                                    <th>
                                        <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            {{$actif->num_facture}}
                                        </a>
                                    </th>
                                    <td>
                                        <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            {{$actif->nom_cfp}}
                                        </a>
                                    </td>
                                    <td> <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            {{$actif->invoice_date}}
                                        </a>
                                    </td>
                                    <td> <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            {{$actif->due_date}}
                                        </a>
                                    </td>
                                    <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                            Ar {{number_format($actif->montant_total,0,","," ")}}
                                        </a>
                                    </td>
                                    <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                            Ar {{number_format($actif->dernier_montant_ouvert,0,","," ")}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            @if ($actif->jour_restant >0)
                                                @if ($actif->facture_encour == "en_cour")
                                                    <div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white">
                                                        partiellement payé
                                                    </div>
                                                @else
                                                    <div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white">
                                                        envoyé
                                                    </div>
                                                @endif

                                            @else
                                                <div style="background-color: rgb(235, 122, 122); border-radius: 10px; text-align: center;color:white">
                                                    en retard
                                                </div>
                                            @endif
                                        </a>
                                    </td>

                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="11" class="text-center" style="color:red;">Aucun Résultat</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>


                    {{-- --}}

                    <div class="tab-pane fade" id="nav-payer" role="tabpanel" aria-labelledby="nav-payer-tab">
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">N° facture &nbsp; <a href="#" style="color: blue"> <button class="btn btn_creer_trie"><i class="fa fa-arrow-down"></i></button> </a>
                                    </th>
                                    <th scope="col">Organisme de formation &nbsp; <a href="#" style="color: blue"> <button class="btn btn_creer_trie"><i class="fa fa-arrow-down"></i></button> </a>

                                    </th>
                                    <th scope="col">Date de facturation</th>
                                    <th scope="col">Date de règlement &nbsp; <a href="#" style="color: blue"> <button class="btn btn_creer_trie"><i class="fa fa-arrow-down"></i></button> </a>

                                    </th>
                                    <th scope="col">Total à payer &nbsp; <a href="#" style="color: blue"> <button class="btn btn_creer_trie"><i class="fa fa-arrow-down"></i></button> </a>

                                    </th>
                                    <th scope="col">Reste à payer &nbsp; <a href="#" style="color: blue"> <button class="btn btn_creer_trie"><i class="fa fa-arrow-down"></i></button> </a>

                                    </th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($facture_payer) > 0)
                                @foreach ($facture_payer as $actif)
                                <tr>
                                    <td>
                                        <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            @if ($actif->reference_type_facture == "Facture")
                                            <div style="background-color: green; border-radius: 10px; text-align: center;color: white">
                                                {{$actif->reference_type_facture}}
                                            </div>
                                            @elseif($actif->reference_type_facture == "Avoir")
                                            <div style="background-color: rgb(144, 196, 202); border-radius: 10px; text-align: center;color: white">
                                                {{$actif->reference_type_facture}}
                                            </div>
                                            @elseif($actif->reference_type_facture == "Acompte")
                                            <div style="background-color: rgb(140, 137, 137); border-radius: 10px; text-align: center;color: white">
                                                {{$actif->reference_type_facture}}
                                            </div>
                                            @else
                                            <div style="background-color: rgb(150, 181, 150); border-radius: 10px; text-align: center;color: white">
                                                {{$actif->reference_type_facture}}
                                            </div>
                                            @endif
                                        </a>
                                    </td>
                                    <th>
                                        <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            {{$actif->num_facture}}
                                        </a>
                                    </th>
                                    <td>
                                        <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            {{$actif->nom_etp}}
                                        </a>
                                    </td>

                                    <td> <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            {{$actif->invoice_date}}
                                        </a>
                                    </td>
                                    <td> <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            {{$actif->due_date}}
                                        </a>
                                    </td>
                                    <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                            Ar {{number_format($actif->montant_total,0,","," ")}}
                                        </a>
                                    </td>
                                    <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                            Ar {{number_format($actif->dernier_montant_ouvert,0,","," ")}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            <div style="background-color: rgb(109, 127, 220); border-radius: 10px; text-align: center;color:white">
                                                payé
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="11" class="text-center" style="color:red;">Aucun Résultat</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    {{-- --}}

                </div>


            </div>


            <div class="filtrer mt-3">
                <div class="row">
                    <div class="col">
                        <p class="m-0">Filter</p>
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
                            <form class="mt-1 mb-2 form_colab" action="{{route('search_par_date')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="dte_debut" class="form-label" align="left"> Date de facturation <strong style="color:#ff0000;">*</strong></label>
                                <input required type="date" name="dte_debut" id="dte_debut" class="form-control" />
                                <br>
                                <label for="dte_fin" class="form-label" align="left">Date de règlement <strong style="color:#ff0000;">*</strong></label>
                                <input required type="date" name="dte_fin" id="dte_fin" class="form-control" />
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </form>
                        </div>
                        <p>
                            <a data-bs-toggle="collapse" href="#search_num_fact" role="button" aria-expanded="false" aria-controls="search_num_fact">Recherche par N° facture</a>
                        </p>
                        <div class="collapse multi-collapse" id="search_num_fact">
                            <form class=" mt-1 mb-2 form_colab" method="POST" action="{{route('search_par_num_fact')}}" enctype="multipart/form-data">
                                @csrf
                                <label for="num_fact" class="form-control-placeholder">N° facture<strong style="color:#ff0000;">*</strong></label>
                                <input name="num_fact" id="num_fact" required class="form-control" required type="text" aria-label="Search" placeholder="Numero Facture">
                                <input type="submit" class="btn_creer mt-2" id="exampleFormControlInput1" value="Recherce" />
                            </form>
                        </div>
                        <p>
                            <a data-bs-toggle="collapse" href="#detail_par_solde" role="button" aria-expanded="false" aria-controls="detail_par_solde">Recherche par intervale de solde</a>
                        </p>
                        <div class="collapse multi-collapse" id="detail_par_solde">
                            <form class="mt-1 mb-2 form_colab" action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="dte_debut" class="form-label" align="left">Solde entre <strong style="color:#ff0000;">*</strong></label>
                                <input required type="number" min="0" placeholder="valeur" name="solde_debut" id="solde_debut" class="form-control" />
                                <br>
                                <label for="dte_fin" class="form-label" align="left"> à <strong style="color:#ff0000;">*</strong></label>
                                <input required type="number" name="solde_fin" id="solde_fin" class="form-control" />
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </form>
                        </div>

                        <p>
                            <a data-bs-toggle="collapse" href="#detail_par_etp" role="button" aria-expanded="false" aria-controls="detail_par_etp">Recherche par Entreprise</a>
                        </p>
                        <div class="collapse multi-collapse" id="detail_par_etp">
                            <form class="mt-1 mb-2 form_colab" action="#" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="dte_debut" class="form-label" align="left">Organisme de formation<strong style="color:#ff0000;">*</strong></label>

                                <select autocomplete="on">
                                    @foreach ($cfp as $cf)
                                        <option value="{{$cf->cfp_id}}">{{$cf->nom}}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </form>
                        </div>

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
            </script>


            @endsection
