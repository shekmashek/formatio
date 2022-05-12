@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Facture</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('css/facture.css')}}">

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
    <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>

    @if(isset($invoice_dte) && isset($due_dte))
    <a href="{{route('liste_facture')}}" class="btn_creer text-center filter" role="button">
        filtre activé <i class="fas fa-times"></i> </a>
    @elseif(isset($solde_debut) && isset($solde_fin))
    <a href="{{route('liste_facture')}}"><span class="btn_creer  text-center filter"><span style="position: relative; bottom: -0.2rem">
            </span> filtre activé <i class="fas fa-times"></i></span>
    </a>
    @elseif(isset($num_fact))
    <a href="{{route('liste_facture')}}" class="btn_creer text-center filter" role="button">
        filtre activé <i class="fas fa-times"></i> </a>
    @elseif(isset($entiter_id))
    <a href="{{route('liste_facture')}}" class="btn_creer text-center filter" role="button">
        filtre activé <i class="fas fa-times"></i> </a>
        @elseif(isset($status))
        <a href="{{route('liste_facture')}}" class="btn_creer text-center filter" role="button">
            filtre activé <i class="fas fa-times"></i> </a>

    @endif


    @if (isset($invoice_dte))
    {{-- {{dd($invoice_dte)}} --}}
    @endif
    {{-- @if($pagination_full["debut_aff"]>1 || $pagination_brouillon["debut_aff"]>1 || $pagination_actif["debut_aff"]>1 || $pagination_payer["debut_aff"]>1 )

    @if(isset($invoice_dte) && isset($due_dte))
    <a href="{{route('search_par_date',[1,1,1,1,$pour_list,$invoice_dte,$due_dte])}}" class="btn_creer text-center filter" role="button">
    pagination activé <i class="fas fa-times"></i> </a>
    @elseif(isset($solde_debut) && isset($solde_fin))
    <a href="{{route('search_par_solde',[1,1,1,1,$pour_list,$solde_debut,$solde_fin])}}"><span class="btn_creer  text-center filter"><span style="position: relative; bottom: -0.2rem">
            </span> pagination activé <i class="fas fa-times"></i></span>
    </a>
    @elseif(isset($num_fact))
    <a href="{{route('search_par_num_fact',[1,1,1,1,$pour_list,$num_fact])}}" class="btn_creer text-center filter" role="button">
        pagination activé <i class="fas fa-times"></i> </a>
    @elseif(isset($entiter_id))
    <a href="{{route('search_par_entiter',[1,1,1,1,$pour_list,$entiter_id])}}" class="btn_creer text-center filter" role="button">
        pagination activé <i class="fas fa-times"></i> </a>
    @else
    <a href="{{route('liste_facture',[1,1,1,1,$pour_list])}}" class="btn_creer text-center filter" role="button">
        pagination activé <i class="fas fa-times"></i> </a>
    @endif
    @endif --}}

    <div class="m-4">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            {{-- <li></li> --}}
            <li class="nav-item">

                @if (isset($pour_list))
                @if ($pour_list == "TOUT")
                <a href="#" class="nav-link active" id="nav-tous-tab" data-bs-toggle="tab" data-bs-target="#nav-tous" type="button" role="tab" aria-controls="nav-tous" aria-selected="true">
                    @else
                    <a href="#" class="nav-link" id="nav-tous-tab" data-bs-toggle="tab" data-bs-target="#nav-tous" type="button" role="tab" aria-controls="nav-tous" aria-selected="false">
                        @endif
                        @else
                        <a href="#" class="nav-link active" id="nav-tous-tab" data-bs-toggle="tab" data-bs-target="#nav-tous" type="button" role="tab" aria-controls="nav-tous" aria-selected="true">
                            @endif
                            TOUT
                            {{count($full_facture)}}
                        </a>

            </li>
            <li class="nav-item">
                @if (isset($pour_list))
                @if ($pour_list == "INACTIF")
                <a href="#" class="nav-link active" id="nav-brouilon-tab" data-bs-toggle="tab" data-bs-target="#nav-brouilon" type="button" role="tab" aria-controls="nav-brouilon" aria-selected="true">
                    @else
                    <a href="#" class="nav-link" id="nav-brouilon-tab" data-bs-toggle="tab" data-bs-target="#nav-brouilon" type="button" role="tab" aria-controls="nav-brouilon" aria-selected="false">
                        @endif
                        @else
                        <a href="#" class="nav-link " id="nav-brouilon-tab" data-bs-toggle="tab" data-bs-target="#nav-brouilon" type="button" role="tab" aria-controls="nav-brouilon" aria-selected="false">
                            @endif
                            Brouillon
                            {{count($facture_inactif)}}
                        </a>
            </li>
            <li class="nav-item">
                @if (isset($pour_list))
                @if ($pour_list == "ACTIF")
                <a href="#" class="nav-link active" id="nav-valide-tab" data-bs-toggle="tab" data-bs-target="#nav-valide" type="button" role="tab" aria-controls="nav-valide" aria-selected="true">
                    @else
                    <a href="#" class="nav-link" id="nav-valide-tab" data-bs-toggle="tab" data-bs-target="#nav-valide" type="button" role="tab" aria-controls="nav-valide" aria-selected="false">
                        @endif
                        @else
                        <a href="#" class="nav-link" id="nav-valide-tab" data-bs-toggle="tab" data-bs-target="#nav-valide" type="button" role="tab" aria-controls="nav-valide" aria-selected="false">
                            @endif
                            Impayé
                            {{count($facture_actif)}}
                        </a>
            </li>
            <li class="nav-item">
                @if (isset($pour_list))
                @if ($pour_list == "PAYER")
                <a href="#" class="nav-link active" id=" nav-payer-tab" data-bs-toggle="tab" data-bs-target="#nav-payer" type="button" role="tab" aria-controls="nav-payer" aria-selected="true">
                    @else
                    <a href="#" class="nav-link" id=" nav-payer-tab" data-bs-toggle="tab" data-bs-target="#nav-payer" type="button" role="tab" aria-controls="nav-payer" aria-selected="false">
                        @endif
                        @else
                        <a href="#" class="nav-link" id=" nav-payer-tab" data-bs-toggle="tab" data-bs-target="#nav-payer" type="button" role="tab" aria-controls="nav-payer" aria-selected="false">
                            @endif
                            Payé
                            {{count($facture_payer)}}
                        </a>
            </li>
        </ul>


        <div class="row">
            <div class="col-12">



                <div class="tab-content" id="nav-tabContent">

                    @if (isset($pour_list))
                    @if ($pour_list == "TOUT")
                    <div class="tab-pane fade show active" id="nav-tous" role="tabpanel" aria-labelledby="nav-tous-tab">
                        @else
                        <div class="tab-pane fade" id="nav-tous" role="tabpanel" aria-labelledby="nav-tous-tab">
                            @endif
                            @else
                            <div class="tab-pane fade  show active" id="nav-tous" role="tabpanel" aria-labelledby="nav-tous-tab">
                                @endif

                                {{------------------------------------------------------------------------------- pagination facture full--}}
                                @include("admin.facture.pagination_cfp.pagination_tout_facture")

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
                                    <tbody id="list_data_trie_tous">
                                        @if (count($full_facture) > 0)
                                        @foreach ($full_facture as $actif)

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
                                                    {{$devise->devise." ".number_format($actif->montant_total,0,","," ")}}
                                                </a>
                                            </td>
                                            <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                                    {{$devise->devise." ".number_format($actif->dernier_montant_ouvert,0,","," ")}}
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                    @if($actif->dernier_montant_ouvert<=0) <div style="background-color: rgb(109, 127, 220); border-radius: 10px; text-align: center;color:white">
                                                        payé
                            </div>
                            @else
                            @if($actif->facture_encour =="valider")
                            @if ($actif->jour_restant >0)
                            <div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white">
                                envoyé
                            </div>
                            @else
                            <div style="background-color: rgb(235, 122, 122); border-radius: 10px; text-align: center;color:white">
                                en retard
                            </div>
                            @endif
                            @elseif($actif->facture_encour =="en_cour")
                            @if ($actif->jour_restant >0)
                            <div style="background-color: rgb(124, 151, 177); border-radius: 10px; text-align: center;color:white">
                                partiellement payé
                            </div>
                            @else
                            <div style="background-color: rgb(235, 122, 122); border-radius: 10px; text-align: center;color:white">
                                en retard
                            </div>
                            @endif
                            @endif
                            @endif

                            </a>
                            </td>
                            <td>
                                @if($actif->activiter==0)
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
                                @else

                                @if($actif->facture_encour == "valider")
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
                                @elseif($actif->facture_encour =="en_cour")
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
                                @else
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
                                @endif
                                @endif

                            </td>
                            </tr>

                            <div id="modal{{ $actif->cfp_id }}_{{ $actif->num_facture }}" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title text-md">
                                                <h6>Encaisser la facture N°: <span class="text-mued" id="num_fact_encaissement">{{ $actif->num_facture }}</span></h6>
                                                <h5>Reste à payer : <strong><label id="montant"></label> {{$devise->devise." ".number_format($actif->dernier_montant_ouvert,0,","," ")}}</strong></h5>
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

                        @if (isset($pour_list))
                        @if ($pour_list == "INACTIF")
                        <div class="tab-pane fade show active" id="nav-brouilon" role="tabpanel" aria-labelledby="nav-brouilon-tab">
                            @else
                            <div class="tab-pane fade" id="nav-brouilon" role="tabpanel" aria-labelledby="nav-brouilon-tab">
                                @endif
                                @else
                                <div class="tab-pane fade " id="nav-brouilon" role="tabpanel" aria-labelledby="nav-brouilon-tab">
                                    @endif

                                    {{------------------------------------------------------------------------------- pagination facture brouillon--}}
                                    @include("admin.facture.pagination_cfp.pagination_facture_brouillon")


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
                                                        {{$devise->devise." ".number_format($actif->montant_total,0,","," ")}}
                                                    </a>
                                                </td>
                                                <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                                        {{$devise->devise." ".number_format($actif->dernier_montant_ouvert,0,","," ")}}
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


                                @if (isset($pour_list))
                                @if ($pour_list == "ACTIF")
                                <div class="tab-pane fade show active" id="nav-valide" role="tabpanel" aria-labelledby="nav-valide-tab">
                                    @else
                                    <div class="tab-pane fade" id="nav-valide" role="tabpanel" aria-labelledby="nav-valide-tab">
                                        @endif
                                        @else
                                        <div class="tab-pane fade" id="nav-valide" role="tabpanel" aria-labelledby="nav-valide-tab">
                                            @endif

                                            {{------------------------------------------------------------------------------- pagination facture activer--}}
                                            @include("admin.facture.pagination_cfp.pagination_facture_actif")

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
                                                                {{$devise->devise." ".number_format($actif->montant_total,0,","," ")}}
                                                            </a>
                                                        </td>
                                                        <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                {{$devise->devise." ".number_format($actif->dernier_montant_ouvert,0,","," ")}}
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
                                                                        <h5>Reste à payer : <strong><label id="montant"></label> {{$devise->devise." ".number_format($actif->dernier_montant_ouvert,0,","," ")}}</strong></h5>
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

                                        @if (isset($pour_list))
                                        @if ($pour_list == "PAYER")
                                        <div class="tab-pane fade show active" id="nav-payer" role="tabpanel" aria-labelledby="nav-payer-tab">
                                            @else
                                            <div class="tab-pane fade" id="nav-payer" role="tabpanel" aria-labelledby="nav-payer-tab">
                                                @endif
                                                @else
                                                <div class="tab-pane fade" id="nav-payer" role="tabpanel" aria-labelledby="nav-payer-tab">
                                                    @endif

                                                    {{------------------------------------------------------------------------------- pagination facture payer--}}
                                                    @include("admin.facture.pagination_cfp.pagination_facture_payer")


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
                                                                        {{$devise->devise." ".number_format($actif->montant_total,0,","," ")}}
                                                                    </a>
                                                                </td>
                                                                <td><a href="{{route('detail_facture',$actif->num_facture)}}">
                                                                        {{$devise->devise." ".number_format($actif->dernier_montant_ouvert,0,","," ")}}
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
                                                    <p class="m-0">Filtre</p>
                                                </div>
                                                <div class="col text-end">
                                                    <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
                                                </div>
                                                <hr class="mt-2">
                                                <div class="row mt-0 navigation_module">
                                                    <p>
                                                        <a data-bs-toggle="collapse" href="#detail_par_thematique" role="button" aria-expanded="false" aria-controls="detail_par_thematique" class="dte_facturation_filtre">Recherche par intervale de date de facturation <i class='bx icon_trie bxs-chevron-up'></i></a>
                                                    </p>
                                                    <div class="collapse multi-collapse" id="detail_par_thematique">
                                                        <form class="mt-1 mb-2 form_colab" action="{{route('search_par_date')}}" method="GET" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="dte_debut" class="form-label" align="left"> Date début<strong style="color:#ff0000;">*</strong></label>
                                                                        <input required type="date" name="dte_debut" id="dte_debut" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="dte_fin" class="form-label" align="left">Date fin <strong style="color:#ff0000;">*</strong></label>
                                                                        <input required type="date" name="dte_fin" id="dte_fin" class="form-control" />

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div align="center">
                                                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <hr>
                                                    <p>
                                                        <a data-bs-toggle="collapse" class="num_fact_filtre" href="#search_num_fact" role="button" aria-expanded="false" aria-controls="search_num_fact">Recherche par numero de facture <i class='bx icon_trie bxs-chevron-up'></i></a>
                                                    </p>
                                                    <div class="collapse multi-collapse" id="search_num_fact">
                                                        <form class=" mt-1 mb-2 form_colab" method="GET" action="{{route('search_par_num_fact')}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <input autocomplete="off" name="num_fact" id="num_fact" required class="form-control" required type="text" aria-label="Search" placeholder="Numero Facture">
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    <button type="submit" class="btn_creer mt-2">Recherche</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <hr>
                                                    <p>
                                                        <a data-bs-toggle="collapse" href="#detail_par_solde" role="button" aria-expanded="false" class="solde_total_payer_filtre" aria-controls="detail_par_solde">Recherche par intervale de solde total à payer <i class='bx icon_trie bxs-chevron-up'></i></a>
                                                    </p>
                                                    <div class="collapse multi-collapse" id="detail_par_solde">
                                                        <form class="mt-1 mb-2 form_colab" action="{{route('search_par_solde')}}" method="GET" enctype="multipart/form-data">
                                                            @csrf

                                                            <div class="row">
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="dte_debut" class="form-label" align="left">Solde minimum {{$devise->devise." "}}<strong style="color:#ff0000;">*</strong></label>
                                                                        <input autocomplete="off" required type="number" min="0" placeholder="valeur" name="solde_debut" id="solde_debut" class="form-control" />
                                                                    </div>
                                                                </div>
                                                                <div class="col">
                                                                    <div class="form-group">
                                                                        <label for="dte_fin" class="form-label" align="left"> Solde à maximum {{$devise->devise." "}}<strong style="color:#ff0000;">*</strong></label>
                                                                        <input required type="number" name="solde_fin" id="solde_fin" class="form-control" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div align="center">
                                                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    {{-- <hr>
                                                    <p>
                                                        <a data-bs-toggle="collapse" href="#detail_par_rest" role="button" aria-expanded="false" class="solde_reste_payer_filtre" aria-controls="detail_par_rest">Recherche par intervale de solde <i class='bx icon_trie bxs-chevron-up'></i></a>
                                                    </p>
                                                    <div class="collapse multi-collapse" id="detail_par_rest">
                                                        <form class="mt-1 mb-2 form_colab" action="{{route('search_par_solde')}}" method="GET" enctype="multipart/form-data">
                                                    @csrf

                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="dte_debut" class="form-label" align="left">Solde minimum {{$devise->devise." "}}<strong style="color:#ff0000;">*</strong></label>
                                                                <input required type="number" min="0" placeholder="valeur" name="reste_solde_payer_debut" id="reste_solde_payer_debut" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="dte_fin" class="form-label" align="left"> Solde à maximum {{$devise->devise." "}}<strong style="color:#ff0000;">*</strong></label>
                                                                <input required type="number" name="reste_solde_payer_fin" id="reste_solde_payer_fin" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div align="center">
                                                        <button type="submit" class="btn_creer mt-2">Recherche</button>
                                                    </div>
                                                    </form>
                                                </div> --}}
                                                <hr>
                                                <p>
                                                    <a data-bs-toggle="collapse" href="#detail_par_etp" role="button" aria-expanded="false" class="entiter_filtre" aria-controls="detail_par_etp">Recherche par entreprise <i class='bx icon_trie bxs-chevron-up'></i></a>
                                                </p>
                                                <div class="collapse multi-collapse" id="detail_par_etp">
                                                    <form class="mt-1 mb-2 form_colab" action="{{route('search_par_entiter')}}" method="GET" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <select class="form-select" name="entiter_id" id="entiter_id">
                                                                        @foreach ($entreprise as $etp)
                                                                        <option value="{{$etp->entreprise_id}}">{{$etp->nom_etp}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <button type="submit" class="btn_creer mt-2">Recherche</button>

                                                            </div>
                                                        </div>

                                                        {{-- <label for="dte_debut" class="form-label" align="left">Entreprise<strong style="color:#ff0000;">*</strong></label>
                                                                <br>
                                                                <select class="form-select" name="entiter_id" id="entiter_id">
                                                                    @foreach ($entreprise as $etp)
                                                                    <option value="{{$etp->entreprise_id}}">{{$etp->nom_etp}}</option>
                                                        @endforeach
                                                        </select>
                                                        <br>
                                                        <button type="submit" class="btn_creer mt-2">Recherche</button> --}}
                                                    </form>
                                                </div>
                                                <hr>
                                                <p>
                                                    <a data-bs-toggle="collapse" href="#detail_par_status" role="button" aria-expanded="false" class="status_filtre" aria-controls="detail_par_status">Recherche par status <i class='bx icon_trie bxs-chevron-up'></i></a>
                                                </p>
                                                <div class="collapse multi-collapse" id="detail_par_status">
                                                    <form class="mt-1 mb-2 form_colab" action="{{route('search_par_status')}}" method="GET" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <select class="form-select" name="status" id="status">
                                                                        <option value="INACTIF">Nom envoyé</option>
                                                                        <option value="ACTIF">Envoyé</option>
                                                                        <option value="EN_COUR">Partiellement payé</option>
                                                                        <option value="PAYER">Payé</option>
                                                                        <option value="RETARD">En retard</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <button type="submit" class="btn_creer mt-2">Recherche</button>

                                                            </div>
                                                        </div>

                                                        <br>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    {{-- inmportation fonction js pour cfp --}}
                                    @include("admin.facture.function_js.js_cfp")

                                    @endsection
