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

    .color-text-trie {
        color: blue;
    }

</style>

<div class="container-fluid">
    <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Filtre</a>
    <span class="nombre_pagination text-center filter"><span style="position: relative; bottom: -0.2rem">{{$pagination["debut_aff"]."-".$pagination["fin_aff"]." sur ".$pagination["totale_pagination"]}}</span>


        @if(isset($invoice_dte) && isset($due_dte))

        @if ($pagination["fin_aff"] >= $pagination["totale_pagination"])
        <a href="{{ route('search_par_date',[($pagination["debut_aff"] - $pagination["nb_limit"]),$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('search_par_date',[($pagination["debut_aff"] + $pagination["nb_limit"]) ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

        @elseif ($pagination["debut_aff"] <= 1) <a href="{{ route('search_par_date',[($pagination["debut_aff"] - $pagination["nb_limit"]),$invoice_dte,$due_dte ] )}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
            <a href="{{ route('search_par_date',[($pagination["debut_aff"] + $pagination["nb_limit"]),$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

            @elseif ($pagination["debut_aff"] < $pagination["totale_pagination"] && $pagination["debut_aff"]> 1)
                <a href="{{route('search_par_date',[($pagination["debut_aff"] - $pagination["nb_limit"]),$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{  route('search_par_date',[($pagination["debut_aff"] + $pagination["nb_limit"]),$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

                @else
                <a href="{{ route('search_par_date',[($pagination["debut_aff"] - $pagination["nb_limit"]),$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('search_par_date',[($pagination["debut_aff"] + $pagination["nb_limit"]),$invoice_dte,$due_dte ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                @endif

                @elseif(isset($solde_debut) && isset($solde_fin))

                @if ($pagination["fin_aff"] >= $pagination["totale_pagination"])
                <a href="{{ route('search_par_solde',[($pagination["debut_aff"] - $pagination["nb_limit"]),$solde_debut,$solde_fin ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('search_par_solde',[($pagination["debut_aff"] + $pagination["nb_limit"]) ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

                @elseif ($pagination["debut_aff"] <= 1) <a href="{{ route('search_par_solde',[($pagination["debut_aff"] - $pagination["nb_limit"]),$solde_debut,$solde_fin ] )}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                    <a href="{{ route('search_par_solde',[($pagination["debut_aff"] + $pagination["nb_limit"]),$solde_debut,$solde_fin ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

                    @elseif ($pagination["debut_aff"] < $pagination["totale_pagination"] && $pagination["debut_aff"]> 1)
                        <a href="{{route('search_par_solde',[($pagination["debut_aff"] - $pagination["nb_limit"]),$solde_debut,$solde_fin ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                        <a href="{{  route('search_par_solde',[($pagination["debut_aff"] + $pagination["nb_limit"]),$solde_debut,$solde_fin ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

                        @else
                        <a href="{{ route('search_par_solde',[($pagination["debut_aff"] - $pagination["nb_limit"]),$solde_debut,$solde_fin ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                        <a href="{{ route('search_par_solde',[($pagination["debut_aff"] + $pagination["nb_limit"]),$solde_debut,$solde_fin ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                        @endif
                        {{-- --}}
                        @elseif(isset($num_fact))

                        @if ($pagination["fin_aff"] >= $pagination["totale_pagination"])
                        <a href="{{ route('search_par_num_fact',[ ($pagination["debut_aff"] - $pagination["nb_limit"]),$num_fact ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                        <a href="{{ route('search_par_num_fact',[ ($pagination["debut_aff"] + $pagination["nb_limit"]),$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

                        @elseif ($pagination["debut_aff"] == 1)
                        <a href="{{ route('search_par_num_fact',[ ($pagination["debut_aff"] - $pagination["nb_limit"]),$num_fact ] )}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                        <a href="{{ route('search_par_num_fact',[ ($pagination["debut_aff"] + $pagination["nb_limit"]),$num_fact ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

                        @elseif ($pagination["debut_aff"] < $pagination["totale_pagination"] && $pagination["debut_aff"]> 1)
                            <a href="{{route('search_par_num_fact',[ ($pagination["debut_aff"] - $pagination["nb_limit"]),$num_fact ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                            <a href="{{  route('search_par_num_fact',[ ($pagination["debut_aff"] + $pagination["nb_limit"]),$num_fact ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

                            @else
                            <a href="{{ route('search_par_num_fact',[ ($pagination["debut_aff"] - $pagination["nb_limit"]),$num_fact ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                            <a href="{{ route('search_par_num_fact',[ ($pagination["debut_aff"] + $pagination["nb_limit"]),$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                            @endif
                            {{-- --}}
                            @elseif(isset($entiter_id))

                            @if ($pagination["fin_aff"] >= $pagination["totale_pagination"])
                            <a href="{{ route('search_par_entiter',[ ($pagination["debut_aff"] - $pagination["nb_limit"]),$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                            <a href="{{ route('search_par_entiter',[ ($pagination["debut_aff"] + $pagination["nb_limit"]),$entiter_id ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

                            @elseif ($pagination["debut_aff"] == 1)
                            <a href="{{ route('search_par_entiter',[ ($pagination["debut_aff"] - $pagination["nb_limit"]),$entiter_id ] )}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                            <a href="{{ route('search_par_entiter',[ ($pagination["debut_aff"] + $pagination["nb_limit"]),$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

                            @elseif ($pagination["debut_aff"] < $pagination["totale_pagination"] && $pagination["debut_aff"]> 1)
                                <a href="{{route('search_par_entiter',[ ($pagination["debut_aff"] - $pagination["nb_limit"]),$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                                <a href="{{  route('search_par_entiter',[ ($pagination["debut_aff"] + $pagination["nb_limit"]),$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

                                @else
                                <a href="{{ route('search_par_entiter',[ ($pagination["debut_aff"] - $pagination["nb_limit"]),$entiter_id ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                                <a href="{{ route('search_par_entiter',[ ($pagination["debut_aff"] + $pagination["nb_limit"]),$entiter_id ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                                @endif

                                {{-- --}}
                                @else

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
                <a href="#" class="nav-link active" id="nav-brouilon-tab" data-bs-toggle="tab" data-bs-target="#nav-brouilon" type="button" role="tab" aria-controls="nav-brouilon" aria-selected="true">
                    Brouillon
                    @if (count($facture_inactif) > 0)
                    {{count($facture_inactif)}}
                    @endif
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

                    <div class="tab-pane fade show active" id="nav-brouilon" role="tabpanel" aria-labelledby="nav-brouilon-tab">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">N° facture &nbsp; <a href="#" style="color: blue"> <button class="btn btn_creer_trie num_fact_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                    </th>
                                    <th scope="col">Entreprise &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                    </th>
                                    <th scope="col">Date de facturation</th>
                                    <th scope="col">Date de règlement &nbsp; <button class="btn btn_creer_trie dte_reglement_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                    </th>
                                    <th scope="col">Total à payer &nbsp; <button class="btn btn_creer_trie total_payer_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                    </th>
                                    <th scope="col">Solde &nbsp; <button class="btn btn_creer_trie rest_payer_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                    </th>
                                    <th scope="col">Status</th>
                                    @canany(['isCFP'])
                                    <th scope="col" colspan="2">Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody id="list_data_trie_brouillon">
                                @if (count($facture_inactif) > 0)
                                @foreach ($facture_inactif as $actif)

                                <tr>
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">

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
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            {{$actif->num_facture}}
                                        </a>
                                    </th>
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            {{$actif->nom_etp}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            {{$actif->invoice_date}}
                                        </a>
                                    </td>
                                    <td> <a href="{{route('detail_facture',$actif->num_facture)}}">

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
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            @if ($actif->jour_restant >0)
                                            <div style="background-color: rgb(233, 190, 142); border-radius: 10px; text-align: center;color:white">
                                                nom envoyé
                                            </div>
                                            @else
                                            <div style="background-color: rgb(235, 122, 122); border-radius: 10px; text-align: center;color:white">
                                                en retard
                                            </div>
                                            @endif
                                        </a>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <div class="btn-group dropstart">
                                                <button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li class="dropdown-item">
                                                        <a href="{{route('edit_facture',$actif->num_facture)}}"> <button type="button" class="btn"><i class="fa fa-edit"></i> Modifier facture</button>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-item">
                                                        <form action="{{route('valid_facture')}}" method="POST">
                                                            @csrf
                                                            <input name="num_facture" type="hidden" value="{{$actif->num_facture}}">
                                                            <button type="submit" class="btn ">Valider facture</button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{route('delete_facture',$actif->num_facture)}}">
                                                            <button type="submit" class="btn "><span class="fa fa-trash"></span> Supprimer</button>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="10" class="text-center" style="color:red;">Aucun Résultat</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- --}}

                    <div class="tab-pane fade" id="nav-valide" role="tabpanel" aria-labelledby="nav-valide-tab">
                        <table class="table table-hover">
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">N° facture &nbsp; <a href="#" style="color: blue"> <button class="btn btn_creer_trie num_fact_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                </th>
                                <th scope="col">Entreprise &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                </th>
                                <th scope="col">Date de facturation</th>
                                <th scope="col">Date de règlement &nbsp; <button class="btn btn_creer_trie dte_reglement_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                </th>
                                <th scope="col">Total à payer &nbsp; <button class="btn btn_creer_trie total_payer_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                </th>
                                <th scope="col">Solde &nbsp; <button class="btn btn_creer_trie rest_payer_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                </th>
                                <th scope="col">Status</th>
                                @canany(['isCFP'])
                                <th scope="col" colspan="2">Action</th>
                                @endcanany
                            </tr>
                            <tbody id="list_data_trie_valider">
                                @if (count($facture_actif) > 0)
                                @foreach ($facture_actif as $actif)
                                <tr>
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">

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
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            {{$actif->num_facture}}
                                        </a>
                                    </th>
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            {{$actif->nom_etp}}
                                        </a>
                                    </td>
                                    <td> <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            {{$actif->invoice_date}}
                                        </a>
                                    </td>
                                    <td> <a href="{{route('detail_facture',$actif->num_facture)}}">
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
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">

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
                                    @canany(['isCFP'])
                                    <td>
                                        @if ($actif->facture_encour == "valider")

                                        <div class="dropdown">
                                            <div class="btn-group dropstart">
                                                <button type="button" class="btn  btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                                </button>
                                                <ul class="dropdown-menu">
                                                    <a href="#" class="dropdown-item">
                                                        <button type="button" class=" btn  payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-bs-toggle="modal" data-bs-target="#modal{{ $actif->cfp_id }}_{{ $actif->num_facture }}">Faire un encaissement</button>
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn ">Liste des encaissements</button></a>
                                                </ul>
                                            </div>
                                        </div>

                                        @elseif ($actif->facture_encour == "en_cour")

                                        <div class="dropdown">
                                            <div class="btn-group dropstart">
                                                <button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                                </button>
                                                <ul class="dropdown-menu">
                                                    <a href="#" class="dropdown-item">
                                                        <button type="button" class=" btn  payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-bs-toggle="modal" data-bs-target="#modal{{ $actif->cfp_id }}_{{ $actif->num_facture }}">Faire un encaissement</button>
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn ">Liste des encaissements</button></a>
                                                    <hr class="dropdown-divider">
                                                    <a class="dropdown-item {{ Route::currentRouteNamed('pdf+liste+encaissement',$actif->num_facture) ? 'active' : '' }}" href="{{route('pdf+liste+encaissement',$actif->num_facture)}}">
                                                        <button type="button" class="btn "> <i class="fa fa-download"></i> PDF Encaissement </button></a>
                                                </ul>
                                            </div>
                                        </div>

                                        @endif

                                    </td>
                                    @endcanany

                                </tr>

                                <div id="modal{{ $actif->cfp_id }}_{{ $actif->num_facture }}" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <div class="modal-title text-md">
                                                    <h6>Encaisser la facture N°: <span class="text-mued" id="num_fact_encaissement">{{ $actif->num_facture }}</span></h6>
                                                    <h5>Reste à payer : <strong><label id="montant"></label> Ar {{number_format($actif->dernier_montant_ouvert,0,","," ")}}</strong></h5>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('encaisser') }} needs-validation" id="formPayement" method="POST" novalidate>
                                                    @csrf
                                                    <input autocomplete="off" type="text" value="{{$actif->num_facture}}" name="num_facture" class="form-control formPayement" required="required" hidden>
                                            </div>

                                            <div class="inputbox inputboxP mt-2  mx-1">
                                                <span>Description</span>
                                                <textarea autocomplete="off" name="libelle" class="text_description form-control" placeholder="description d'encaissement" rows="5"></textarea>

                                            </div>
                                            <div class="inputbox inputboxP mt-3   mx-1">
                                                <span>Montant à facturer<strong style="color:#ff0000;">*</strong></span>
                                                <input autocomplete="off" type="number" min="1" name="montant" class="form-control formPayement" required="required" style="height: 50px;">
                                                <div class="invalid-feedback">
                                                    votre montant à encaisser
                                                </div>
                                            </div>

                                            <div class="form-group  mt-3  mx-1">
                                                <span>Mode de paiement<strong style="color:#ff0000;">*</strong></span>
                                                <select class="form-select selectP" name="mode_payement" aria-label="Default select example" style="height: 50px;">
                                                    @foreach ($mode_payement as $mp)
                                                    <option value="{{ $mp->id }}">{{ $mp->description }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback">
                                                    votre mode de paiement
                                                </div>
                                            </div>
                                            <div class="inputbox inputboxP mt-3  mx-1">
                                                <span>Date de paiement<strong style="color:#ff0000;">*</strong></span>
                                                <input type="date" name="date_encaissement" class="form-control formPayement" required="required" style="height: 50px;">
                                                <div class="invalid-feedback">
                                                    votre Date de paiement
                                                </div>
                                            </div>
                                            <div class="inputbox inputboxP mt-3" id="numero_facture"></div>

                                            <div class="mt-4 mb-4">
                                                <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span> <button type="submit" form="formPayement" class="btn btn_creer btnP px-3">Encaisser</button> </div>
                                            </div>

                                            </form>

                                        </div>

                                    </div>
                                </div>
                                {{-- </div> --}}

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
                        <table class="table table-hover">
                            <tr>
                                <th scope="col">Type</th>
                                <th scope="col">N° facture &nbsp; <a href="#" style="color: blue"> <button class="btn btn_creer_trie num_fact_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                </th>
                                <th scope="col">Entreprise &nbsp; <button class="btn btn_creer_trie nom_entiter_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                </th>
                                <th scope="col">Date de facturation</th>
                                <th scope="col">Date de règlement &nbsp; <button class="btn btn_creer_trie dte_reglement_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                </th>
                                <th scope="col">Total à payer &nbsp; <button class="btn btn_creer_trie total_payer_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                </th>
                                <th scope="col">Solde &nbsp; <button class="btn btn_creer_trie rest_payer_trie" value="0"><i class="fa icon_trie fa-arrow-down"></i></button> </a>
                                </th>
                                <th scope="col">Status</th>
                                @canany(['isCFP'])
                                <th scope="col" colspan="2">Action</th>
                                @endcanany
                            </tr>
                            <tbody id="list_data_trie_payer">
                                @if (count($facture_payer) > 0)
                                @foreach ($facture_payer as $actif)
                                <tr>
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
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
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            {{$actif->num_facture}}
                                        </a>
                                    </th>
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            {{$actif->nom_etp}}
                                        </a>
                                    </td>
                                    <td> <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            {{$actif->invoice_date}}
                                        </a>
                                    </td>
                                    <td> <a href="{{route('detail_facture',$actif->num_facture)}}">
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
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            <div style="background-color: rgb(109, 127, 220); border-radius: 10px; text-align: center;color:white">
                                                payé
                                            </div>
                                        </a>
                                    </td>
                                    @canany(['isCFP'])
                                    <td>
                                        <div class="dropdown">
                                            <div class="btn-group dropstart">
                                                <button type="button" class="btn btn_creer_trie dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">

                                                </button>
                                                <ul class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route('imprime_feuille_facture',$actif->num_facture)}}"><button type="button" class="btn "><i class="fa fa-download"></i> PDF Facture</button></a>
                                                    <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn ">Liste des encaissements</button></a>
                                                    <hr class="dropdown-divider">
                                                    <a class="dropdown-item {{ Route::currentRouteNamed('pdf+liste+encaissement',$actif->num_facture) ? 'active' : '' }}" href="{{route('pdf+liste+encaissement',$actif->num_facture)}}">
                                                        <button type="button" class="btn "> <i class="fa fa-download"></i> PDF Encaissement </button></a>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endcanany
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


            {{-- debut modal encaissement --}}
            {{-- <div id="modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="modal-title text-md">
                            <h6>N° facture : <span class="text-mued" id="num_fact_encaissement"></span></h6>
                            <h5>Reste à payer : <strong><label id="montant"></label> Ar</strong></h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('encaisser') }}" id="formPayement" method="POST">
            @csrf
            <div class="inputbox inputboxP mt-3">
                <span>Description</span>
                <textarea autocomplete="off" name="libelle" id="libelle" class="text_description form-control" placeholder="description d'encaissement"></textarea>

            </div>
            <div class="inputbox inputboxP mt-3">
                <span>Montant à facturer</span>
                <input autocomplete="off" type="number" min="1" pattern="[0-9]" name="montant" class="form-control formPayement" required="required"> </div>

            <div class="form-group  mt-3">
                <span>Mode de paiement<strong style="color:#ff0000;">*</strong></span>
                <select class="form-select selectP" name="mode_payement" id="mode_payement" aria-label="Default select example">
                    @foreach ($mode_payement as $mp)
                    <option value="{{ $mp->id }}">{{ $mp->description }}</option>
                    @endforeach
                </select>
            </div>
            <div class="inputbox inputboxP mt-3">
                <span>Date de payement<strong style="color:#ff0000;">*</strong></span>
                <input type="date" name="date_encaissement" id="date_encaissement" class="form-control formPayement" required="required" value="{{ date('d/m/Y') }}">
            </div>
            <div class="inputbox inputboxP mt-3" id="numero_facture"></div>
            </form>
            <div class="mt-4 mb-4">
                <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn_creer annuler" style="color: red" data-bs-dismiss="modal" aria-label="Close">Annuler</button></span> <button type="submit" form="formPayement" class="btn btn_creer btnP px-3">Encaisser</button> </div>
            </div>

        </div>

    </div>
</div>
</div> --}}
{{-- fin --}}



{{-- modal reussi --}}
@if (Session::has('encaissement_ok'))
<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <fieldset>
                    <div class="form-card">
                        <h2 class="fs-title text-center">{{ Session::get('encaissement_ok') }}</h2> <br><br>
                        <div class="row justify-content-center">
                            <div class="col-3"> <img src="{{ asset('img/images/ok.png') }}" class="fit-image"> </div>
                        </div> <br>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</div>
@endif
{{-- fin --}}

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

            <p>
                <a data-bs-toggle="collapse" href="#search_num_fact" role="button" aria-expanded="false" aria-controls="search_num_fact">Recherche par numero de facture</a>
            </p>
            <div class="collapse multi-collapse" id="search_num_fact">
                <form class=" mt-1 mb-2 form_colab" method="GET" action="{{route('search_par_num_fact')}}" enctype="multipart/form-data">
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
                <form class="mt-1 mb-2 form_colab" action="{{route('search_par_solde')}}" method="GET" enctype="multipart/form-data">
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
                <form class="mt-1 mb-2 form_colab" action="{{route('search_par_entiter')}}" method="GET" enctype="multipart/form-data">
                    @csrf
                    <label for="dte_debut" class="form-label" align="left">Entreprise<strong style="color:#ff0000;">*</strong></label>
                    <br>
                    <select name="entiter_id" id="entiter_id">
                        @foreach ($entreprise as $etp)
                        <option value="{{$etp->entreprise_id}}">{{$etp->nom_etp}}</option>
                        @endforeach
                    </select>
                    <br>
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
    $(document).ready(function() {
        $("#myModal").modal('show');
    });

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

    function getDataFactureBrouillon(facture_inactif) {
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

                html_inactif += "  <a href=" + url_detail_facture + ">  Ar " + number_format(facture_inactif[i_act].montant_total, 0, ",", " ") + " </a> </td><td>";
                html_inactif += "  <a href=" + url_detail_facture + ">  Ar " + number_format(facture_inactif[i_act].dernier_montant_ouvert, 0, ",", " ") + " </a> </td><td>";

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
        return html_inactif;
    }


    function getDataFactureValider(facture_actif) {
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

                    html_actif += "   <div style='background-color: rgb(150, 181, 150); border-radius: 10px; text-align: center;color: white'>"; +
                    facture_actif[i_actif].reference_type_facture +
                        " </div>";
                }

                html_actif += "  </a></td><th>";
                html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].num_facture + "   </a> </th> <td>";
                html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].nom_etp + " </a></td><td>";
                html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].invoice_date + " </a> </td><td>";
                html_actif += "  <a href=" + url_detail_facture + ">" + facture_actif[i_actif].due_date + " </a> </td><td>";

                html_actif += "  <a href=" + url_detail_facture + ">  Ar " + number_format(facture_actif[i_actif].montant_total, 0, ",", " ") + " </a> </td><td>";
                html_actif += "  <a href=" + url_detail_facture + ">  Ar " +number_format(facture_actif[i_actif].dernier_montant_ouvert, 0, ",", " ") + " </a> </td><td>";



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
                    html_actif += ' <button type="button" class=" btn  payement" data-id="' + facture_actif[i_actif].num_facture + '" id="' + facture_actif[i_actif].num_facture + '" data-bs-toggle="modal" data-bs-target="#modal' + facture_actif[i_actif].cfp_id + '_' + facture_actif[i_actif].num_facture + '">Faire un encaissement</button>';
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
                    html_actif += '<button type="button" class=" btn  payement" data-id="' + facture_actif[i_actif].num_facture + '" id="' + facture_actif[i_actif].num_facture + '" data-bs-toggle="modal" data-bs-target="#modal' + facture_actif[i_actif].cfp_id + '_' + facture_actif[i_actif].num_facture + '">Faire un encaissement</button>';
                    html_actif += '</a>'
                    html_actif += ' <a class="dropdown-item" href="' + url_liste_encaissement_facture + '"><button type="button" class="btn ">Liste des encaissements</button></a>';
                    html_actif += '<hr class="dropdown-divider">';
                    html_actif += '<a class="dropdown-item" href="' + url_pdf_liste_encaissement_facture + '">';
                    html_actif += '<button type="button" class="btn "> <i class="fa fa-download"></i> PDF Encaissement </button></a>';
                    html_actif += '</ul> </div></div>';

                }

                html_actif += "</td> </tr>";

                html_actif += ' <div id="modal' + facture_actif[i_actif].cfp_id + '_' + facture_actif[i_actif].num_facture + '" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">';

                html_actif += '<div class="modal-dialog">';
                html_actif += '<div class="modal-content">';
                html_actif += '<div class="modal-header">';
                html_actif += '<div class="modal-title text-md">';
                html_actif += '<h6>Encaisser la facture  N° : <span class="text-mued" id="num_fact_encaissement">' + facture_actif[i_actif].num_facture + '</span></h6>';

                html_actif += '<h5>Reste à payer : <strong><label id="montant"></label> Ar ' + number_format(facture_actif[i_actif].dernier_montant_ouvert, 0, ",", " ") + '</strong></h5>';
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
                /*    for (let j = 0; j < mode_payement.lenght; j += 1) {
                        html_actif += '<option value="' + mode_payement[j].id + '">' + mode_payement[j] description + '</option>';
                    } */
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
                html_actif += '</div>';

            }
        } else {
            html_actif += '<tr><td colspan = "11" class = "text-center" style = "color:red;" > Aucun Résultat </td> </tr> ';

        }

        return html_actif;
    }

    function getDataFacturePayer(facture_payer) {
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

                html_payer += "  <a href=" + url_detail_facture + ">  Ar " + number_format(facture_payer[i_payer].montant_total, 0, ",", " ") + " </a> </td><td>";
                html_payer += "  <a href=" + url_detail_facture + ">  Ar " + number_format(facture_payer[i_payer].dernier_montant_ouvert, 0, ",", " ") + " </a> </td><td>";

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

        if (valiny["entiter"] == "OF") {

            var facture_inactif = valiny["facture_inactif"];
            var facture_actif = valiny["facture_actif"];
            var facture_payer = valiny["facture_payer"];

            var html_inactif = getDataFactureBrouillon(facture_inactif);
            var html_actif = getDataFactureValider(facture_actif);
            var html_payer = getDataFacturePayer(facture_payer);

            return {
                "html_inactif": html_inactif
                , "html_actif": html_actif
                , "html_payer": html_payer
            };
        } else {
            var facture_actif = valiny["facture_actif"];
            var facture_payer = valiny["facture_payer"];
            var html_actif = getDataFactureValider(facture_actif);
            var html_payer = getDataFacturePayer(facture_payer);

            return {
                "html_actif": html_actif
                , "html_payer": html_payer
            };
        }

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
                , nb_pagination: @php echo $pagination["debut_aff"];@endphp
            }
            , dataType: "html"
            , success: function(response) {



                var valiny = JSON.parse(response);
                var resultat = getDataFacture(response);

                if (valiny["entiter"] == "OF") {
                    $('#list_data_trie_brouillon').empty().append(resultat["html_inactif"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                } else {
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

        $.ajax({
            method: "GET"
            , url: "{{route('trie_par_entiter')}}"
            , data: {
                data_value: $(this).val()
                , nb_pagination: @php echo $pagination["debut_aff"];@endphp
            }
            , dataType: "html"
            , success: function(response) {

                var valiny = JSON.parse(response);
                var resultat = getDataFacture(response);

                if (valiny["entiter"] == "OF") {
                    $('#list_data_trie_brouillon').empty().append(resultat["html_inactif"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                } else {
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

        $.ajax({
            method: "GET"
            , url: "{{route('trie_par_dte')}}"
            , data: {
                data_value: $(this).val()
                , nb_pagination: @php echo $pagination["debut_aff"];@endphp
            }
            , dataType: "html"
            , success: function(response) {

                var valiny = JSON.parse(response);
                var resultat = getDataFacture(response);

                if (valiny["entiter"] == "OF") {
                    $('#list_data_trie_brouillon').empty().append(resultat["html_inactif"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                } else {
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

        $.ajax({
            method: "GET"
            , url: "{{route('trie_par_totale_payer')}}"
            , data: {
                data_value: $(this).val()
                , nb_pagination: @php echo $pagination["debut_aff"];@endphp
            }
            , dataType: "html"
            , success: function(response) {



                var valiny = JSON.parse(response);
                var resultat = getDataFacture(response);

                if (valiny["entiter"] == "OF") {
                    $('#list_data_trie_brouillon').empty().append(resultat["html_inactif"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                } else {
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

        $.ajax({
            method: "GET"
            , url: "{{route('trie_par_reste_payer')}}"
            , data: {
                data_value: $(this).val()
                , nb_pagination: @php echo $pagination["debut_aff"];@endphp
            }
            , dataType: "html"
            , success: function(response) {

                var valiny = JSON.parse(response);
                var resultat = getDataFacture(response);

                if (valiny["entiter"] == "OF") {
                    $('#list_data_trie_brouillon').empty().append(resultat["html_inactif"]);
                    $('#list_data_trie_valider').empty().append(resultat["html_actif"]);
                    $('#list_data_trie_payer').empty().append(resultat["html_payer"]);
                } else {
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

@endsection
