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


        @if(isset($invoice_dte) && isset($due_dte))

        @if ($pagination["fin_aff"] >= $pagination["totale_pagination"])
        <a href="{{ route('search_par_date_pagination',[($pagination["debut_aff"] - $pagination["nb_limit"]),$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('search_par_date_pagination',[($pagination["debut_aff"] + $pagination["nb_limit"]) ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
        @elseif ($pagination["debut_aff"] <= 1) <a href="{{ route('search_par_date_pagination',[($pagination["debut_aff"] - $pagination["nb_limit"]),$invoice_dte,$due_dte ] )}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
            <a href="{{ route('search_par_date_pagination',[($pagination["debut_aff"] + $pagination["nb_limit"]),$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
            @elseif ($pagination["debut_aff"] < $pagination["totale_pagination"] && $pagination["debut_aff"]> 1)
                <a href="{{route('search_par_date_pagination',[($pagination["debut_aff"] - $pagination["nb_limit"]),$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{  route('search_par_date_pagination',[($pagination["debut_aff"] + $pagination["nb_limit"]),$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
                @else
                <a href="{{ route('search_par_date_pagination',[($pagination["debut_aff"] - $pagination["nb_limit"]),$invoice_dte,$due_dte ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('search_par_date_pagination',[($pagination["debut_aff"] + $pagination["nb_limit"]),$invoice_dte,$due_dte ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                @endif

                @elseif(isset($num_fact))

                @if ($pagination["fin_aff"] >= $pagination["totale_pagination"])
                <a href="{{ route('search_par_num_fact_pagination',[ ($pagination["debut_aff"] - $pagination["nb_limit"]),$num_fact ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('search_par_num_fact_pagination',[ ($pagination["debut_aff"] + $pagination["nb_limit"]),$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                @elseif ($pagination["debut_aff"] == 1)
                <a href="{{ route('search_par_num_fact_pagination',[ ($pagination["debut_aff"] - $pagination["nb_limit"]),$num_fact ] )}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('search_par_num_fact_pagination',[ ($pagination["debut_aff"] + $pagination["nb_limit"]),$num_fact ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
                @elseif ($pagination["debut_aff"] < $pagination["totale_pagination"] && $pagination["debut_aff"]> 1)
                    <a href="{{route('search_par_num_fact_pagination',[ ($pagination["debut_aff"] - $pagination["nb_limit"]),$num_fact ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                    <a href="{{  route('search_par_num_fact_pagination',[ ($pagination["debut_aff"] + $pagination["nb_limit"]),$num_fact ] ) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>
                    @else
                    <a href="{{ route('search_par_num_fact_pagination',[ ($pagination["debut_aff"] - $pagination["nb_limit"]),$num_fact ] ) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                    <a href="{{ route('search_par_num_fact_pagination',[ ($pagination["debut_aff"] + $pagination["nb_limit"]),$num_fact ] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                    @endif

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
                    Valider
                    @if (count($facture_actif) > 0)
                    {{count($facture_actif)}}
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" id="nav-encour-tab" data-bs-toggle="tab" data-bs-target="#nav-encour" type="button" role="tab" aria-controls="nav-encour" aria-selected="false">
                    En cour
                    @if (count($facture_encour) > 0)
                    {{count($facture_encour)}}
                    @endif
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link"" id=" nav-payer-tab" data-bs-toggle="tab" data-bs-target="#nav-payer" type="button" role="tab" aria-controls="nav-payer" aria-selected="false">
                    Payer
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
                        {{-- <h6 style="color: #AA076B">Facture En Brouillon</h6> --}}
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Type facture</th>
                                    <th scope="col">Numéro de facture</th>
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">Réference module</th>
                                    <th scope="col">Module de formation</th>
                                    <th scope="col">Projet session</th>
                                    <th scope="col">Date de facturation</th>
                                    <th scope="col">Payement du</th>
                                    @canany(['isCFP'])
                                    <th scope="col" colspan="2">Action</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
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

                                            {{-- <div style="background-color: rgb(164, 187, 233);  border-radius: 10px; text-align: center"> --}}
                                            {{$actif->nom_etp}}
                                            {{-- </div> --}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">

                                            @php
                                            echo html_entity_decode($actif->ref_session)
                                            @endphp
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">

                                            @php
                                            echo html_entity_decode($actif->module_session)
                                            @endphp
                                        </a>
                                    </td>

                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">

                                            {{$actif->nom_projet.": "}}
                                            @php
                                            echo html_entity_decode($actif->session_facture)
                                            @endphp
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
                                    <td>
                                        <div class="dropdown">
                                            <div class="btn-group dropstart">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
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

                                                    {{-- <hr class="dropdown-divider">
                                                    <a class="dropdown-item" href="{{route('facture')}} ">
                                                        <button type="submit" class="btn"> <i class='bx bx-plus-medical'></i> Nouveau facture
                                                        </button></a> --}}
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="8" class="text-center" style="color:red;">Aucun Résultat</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{-- --}}

                    <div class="tab-pane fade" id="nav-valide" role="tabpanel" aria-labelledby="nav-valide-tab">
                        {{-- <h6 style="color: #AA076B">Facture Validé</h6> --}}
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Type facture</th>
                                    <th scope="col">Numéro de facture</th>
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">Réference module</th>
                                    <th scope="col">Module de formation</th>
                                    <th scope="col">Projet session</th>
                                    <th scope="col">Date de facturation</th>
                                    <th scope="col">Payement du</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                            {{-- <div style="background-color: rgb(164, 187, 233); border-radius: 10px; text-align: center"> --}}
                                            {{$actif->nom_etp}}
                                            {{-- </div> --}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            @php
                                            echo html_entity_decode($actif->ref_session)
                                            @endphp
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            @php
                                            echo html_entity_decode($actif->session_facture)
                                            @endphp
                                        </a>
                                    </td>

                                    <td> <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            {{$actif->nom_projet.": "}}
                                            @php
                                            echo html_entity_decode($actif->module_session)
                                            @endphp
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
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            <div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white">
                                                {{$actif->facture_encour}}
                                            </div>
                                        </a>
                                    </td>
                                    @canany(['isCFP'])
                                    <td>
                                        <div class="dropdown">
                                            <div class="btn-group dropstart">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <a href="#" class="dropdown-item">
                                                        <button type="button" class=" btn  payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-bs-toggle="modal" data-bs-target="#modal">Faire un encaissement</button>
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn ">Liste des encaissements</button></a>
                                                    {{-- <hr class="dropdown-divider">
                                                    <a class="dropdown-item" href="{{route('facture')}} " style="color: green"><button type="text" class="btn "><i class='bx bx-plus-medical'></i> Nouveau facture</button></a> --}}

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endcanany

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

                    <div class="tab-pane fade" id="nav-encour" role="tabpanel" aria-labelledby="nav-encour-tab">
                        {{-- <h6 style="color: #AA076B">Facture En Cour</h6> --}}
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Type facture</th>
                                    <th scope="col">Numéro de facture</th>
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">Réference module</th>
                                    <th scope="col">Module de formation</th>
                                    <th scope="col">Projet session</th>
                                    <th scope="col">Date de facturation</th>
                                    <th scope="col">Payement du</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($facture_encour) > 0)
                                @foreach ($facture_encour as $actif)
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
                                            {{-- <div style="background-color: rgb(164, 187, 233); border-radius: 10px; text-align: center"> --}}
                                            {{$actif->nom_etp}}
                                            {{-- </div> --}}
                                        </a>
                                    </td>
                                    <td> <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            @php
                                            echo html_entity_decode($actif->ref_session)
                                            @endphp
                                        </a>
                                    </td>
                                    <td> <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            @php
                                            echo html_entity_decode($actif->session_facture)
                                            @endphp
                                        </a>
                                    </td>

                                    <td> <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            {{$actif->nom_projet.": "}}
                                            @php
                                            echo html_entity_decode($actif->module_session)
                                            @endphp
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
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            <div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white">
                                                en cour
                                            </div>
                                        </a>
                                    </td>
                                    @canany(['isCFP'])
                                    <td>
                                        <div class="dropdown">
                                            <div class="btn-group dropstart">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <a href="#" class="dropdown-item">
                                                        <button type="button" class=" btn  payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-bs-toggle="modal" data-bs-target="#modal">Faire un encaissement</button>
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn ">Liste des encaissements</button></a>
                                                    {{-- <hr class="dropdown-divider">
                                                    <a class="dropdown-item" href="{{route('facture')}} " style="color: green"><button type="text" class="btn "><i class='bx bx-plus-medical'></i> Nouveau facture</button></a> --}}

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endcanany

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

                    <div class="tab-pane fade" id="nav-payer" role="tabpanel" aria-labelledby="nav-payer-tab">
                        {{-- <h6 style="color: #AA076B">Facture Payer</h6> --}}
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Type facture</th>
                                    <th scope="col">Numéro de facture</th>
                                    <th scope="col">Entreprise</th>
                                    <th scope="col">Réference module</th>
                                    <th scope="col">Module de formation</th>
                                    <th scope="col">Projet session</th>
                                    <th scope="col">Date de facturation</th>
                                    <th scope="col">Payement du</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
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
                                            {{-- <div style="background-color: rgb(164, 187, 233); border-radius: 10px; text-align: center"> --}}
                                            {{$actif->nom_etp}}
                                            {{-- </div> --}}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            @php
                                            echo html_entity_decode($actif->ref_session)
                                            @endphp
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            @php
                                            echo html_entity_decode($actif->session_facture)
                                            @endphp
                                        </a>
                                    </td>

                                    <td> <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            {{$actif->nom_projet.": "}}
                                            @php
                                            echo html_entity_decode($actif->module_session)
                                            @endphp
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
                                    <td>
                                        <a href="{{route('detail_facture',$actif->num_facture)}}">
                                            <div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white">
                                                {{$actif->facture_encour}}
                                            </div>
                                        </a>
                                    </td>
                                    @canany(['isCFP'])
                                    <td>
                                        <div class="dropdown">
                                            <div class="btn-group dropstart">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route('imprime_feuille_facture',$actif->num_facture)}}"><button type="button" class="btn "><i class="fa fa-download"></i> PDF</button></a>
                                                    <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn ">Liste des encaissements</button></a>
                                                    {{-- <hr class="dropdown-divider">
                                                    <a class="dropdown-item" href="{{route('facture')}} " style="color: green"><button type="text" class="btn "><i class='bx bx-plus-medical'></i> Nouveau facture</button></a> --}}
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endcanany
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

                </div>


            </div>


            {{-- debut modal encaissement --}}
            <div id="modal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="modal-title text-md">
                                <h5>Reste à payer : <strong><label id="montant"></label> Ar</strong></h5>
                            </div>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('encaisser') }}" id="formPayement" method="POST">
                                @csrf
                                <div class="inputbox inputboxP mt-3">
                                    <span>Description</span>
                                    <textarea autocomplete="off" name="libelle" id="libelle" class="text_description form-control" placeholder="description d'encaissement"></textarea>

                                    {{-- <input autocomplete="off" type="text" name="libelle" class="form-control formPayement" required="required" placeholder="description d'encaissement"> --}}
                                </div>
                                <div class="inputbox inputboxP mt-3">
                                    <span>Montant à facturer</span>
                                    <input autocomplete="off" type="number" min="1" pattern="[0-9]" name="montant" class="form-control formPayement" required="required"> </div>

                                <div class="form-group  mt-3">
                                    <span>Mode de payement<strong style="color:#ff0000;">*</strong></span>
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
            </div>
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
                            <form class="mt-1 mb-2 form_colab" action="{{route('search_par_date')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="dte_debut" class="form-label" align="left"> Date de facturation <strong style="color:#ff0000;">*</strong></label>
                                <input required type="date" name="dte_debut" id="dte_debut" class="form-control" />
                                <br>
                                <label for="dte_fin" class="form-label" align="left">Payement du <strong style="color:#ff0000;">*</strong></label>
                                <input required type="date" name="dte_fin" id="dte_fin" class="form-control" />
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </form>
                        </div>

                        <p>
                            <a data-bs-toggle="collapse" href="#search_num_fact" role="button" aria-expanded="false" aria-controls="search_num_fact">Recherche par numero de facture</a>
                        </p>
                        <div class="collapse multi-collapse" id="search_num_fact">
                            <form class=" mt-1 mb-2 form_colab" method="POST" action="{{route('search_par_num_fact')}}" enctype="multipart/form-data">
                                @csrf
                                <label for="num_fact" class="form-control-placeholder">Numéro de facture<strong style="color:#ff0000;">*</strong></label>
                                <input name="num_fact" id="num_fact" required class="form-control" required type="text" aria-label="Search" placeholder="Numero Facture">
                                <input type="submit" class="btn_creer mt-2" id="exampleFormControlInput1" value="Recherce" />
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

                $(".payement").on('click', function(e) {
                    $('#montant').html('');
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
                            var html = '<input type="hidden" name="num_facture" value="' + userData[1] + '" required>';
                            document.getElementById("date_encaissement").setAttribute("min", userData[2]);
                            $('#numero_facture').append(html);
                        }
                        , error: function(error) {
                            console.log(error)
                        }
                    });
                });

            </script>
            <script>
                $(document).ready(function() {
                    $("#myModal").modal('show');
                });

            </script>

            @endsection
