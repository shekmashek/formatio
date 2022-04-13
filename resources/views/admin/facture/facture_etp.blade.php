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
                <a href="#" class="nav-link active" id="nav-valide-tab" data-bs-toggle="tab" data-bs-target="#nav-valide" type="button" role="tab" aria-controls="nav-valide" aria-selected="true">
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

                    <div class="tab-pane fade show active" id="nav-valide" role="tabpanel" aria-labelledby="nav-valide-tab">
                        {{-- <h6 style="color: #AA076B">Facture Validé</h6> --}}
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Type facture</th>
                                    <th scope="col">Numéro de facture</th>
                                    <th scope="col">Organisme de formation</th>
                                    <th scope="col">Réference module</th>
                                    <th scope="col">Module de formation</th>
                                    <th scope="col">Projet session</th>
                                    <th scope="col">Date de facturation</th>
                                    <th scope="col">Payement du</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($facture_actif) > 0)
                                @foreach ($facture_actif as $actif)
                                <tr>
                                    <td>
                                        <div style="background-color: rgb(226, 230, 238); border-radius: 10px; text-align: center">
                                            {{$actif->reference_type_facture}}
                                        </div>
                                    </td>
                                    <th>
                                        <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            {{$actif->num_facture}}
                                        </a>
                                    </th>
                                    <td>
                                        <div style="background-color: rgb(164, 187, 233); border-radius: 10px; text-align: center">
                                            {{$actif->nom_cfp}}
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                        echo html_entity_decode($actif->ref_session)
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                        echo html_entity_decode($actif->session_facture)
                                        @endphp
                                    </td>

                                    <td>{{$actif->nom_projet.": "}}
                                        @php
                                        echo html_entity_decode($actif->module_session)
                                        @endphp
                                    </td>

                                    <td>{{$actif->invoice_date}}</td>
                                    <td>{{$actif->due_date}}</td>
                                    @if ($actif->facture_encour == "valider")
                                    <td>
                                        <div style="background-color: rgb(208, 187, 231); border-radius: 10px; text-align: center">
                                            {{$actif->facture_encour}}
                                        </div>
                                    </td>
                                    @endif
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
                                    <th scope="col">Organisme de formation</th>
                                    <th scope="col">Réference module</th>
                                    <th scope="col">Module de formation</th>
                                    <th scope="col">Projet session</th>
                                    <th scope="col">Date de facturation</th>
                                    <th scope="col">Payement du</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($facture_encour) > 0)
                                @foreach ($facture_encour as $actif)
                                <tr>
                                    <td>
                                        <div style="background-color: green; border-radius: 10px; text-align: center;color:white">
                                            {{$actif->reference_type_facture}}
                                        </div>
                                    </td>
                                    <th>
                                        <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            {{$actif->num_facture}}
                                        </a>
                                    </th>
                                    <td>
                                        <div style="background-color: rgb(164, 187, 233); border-radius: 10px; text-align: center">
                                            {{$actif->nom_cfp}}
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                        echo html_entity_decode($actif->ref_session)
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                        echo html_entity_decode($actif->session_facture)
                                        @endphp
                                    </td>

                                    <td>{{$actif->nom_projet.": "}}
                                        @php
                                        echo html_entity_decode($actif->module_session)
                                        @endphp
                                    </td>
                                    <td>{{$actif->invoice_date}}</td>
                                    <td>{{$actif->due_date}}</td>
                                    <td>
                                        {{-- <div style="background-color: green; border-radius: 10px; text-align: center;color:white"> --}}
                                        {{-- {{$actif->facture_encour}} --}} en cour
                                        {{-- </div> --}}
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

                    <div class="tab-pane fade" id="nav-payer" role="tabpanel" aria-labelledby="nav-payer-tab">
                        {{-- <h6 style="color: #AA076B">Facture Payer</h6> --}}
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Type facture</th>
                                    <th scope="col">Numéro de facture</th>
                                    <th scope="col">Organisme de formation</th>
                                    <th scope="col">Réference module</th>
                                    <th scope="col">Module de formation</th>
                                    <th scope="col">Projet session</th>
                                    <th scope="col">Date de facturation</th>
                                    <th scope="col">Payement du</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (count($facture_payer) > 0)
                                @foreach ($facture_payer as $actif)
                                <tr>
                                    <td>
                                        <div style="background-color: blue; border-radius: 10px; text-align: center;color:white">
                                            {{$actif->reference_type_facture}}
                                        </div>
                                    </td>
                                    <th>
                                        <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                            {{$actif->num_facture}}
                                        </a>
                                    </th>
                                    <td>
                                        <div style="background-color: rgb(164, 187, 233); border-radius: 10px; text-align: center">
                                            {{$actif->nom_etp}}
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                        echo html_entity_decode($actif->ref_session)
                                        @endphp
                                    </td>
                                    <td>
                                        @php
                                        echo html_entity_decode($actif->session_facture)
                                        @endphp
                                    </td>

                                    <td>{{$actif->nom_projet.": "}}
                                        @php
                                        echo html_entity_decode($actif->module_session)
                                        @endphp
                                    </td>

                                    <td>{{$actif->invoice_date}}</td>
                                    <td>{{$actif->due_date}}</td>
                                    <td>
                                        {{-- <div style="background-color: blue; border-radius: 10px; text-align: center;color:white"> --}}
                                        {{$actif->facture_encour}}
                                        {{-- </div> --}}
                                    </td>Ú
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
                                <input required type="date" name="dte_debut" class="form-control" />
                                <br>
                                <label for="dte_fin" class="form-label" align="left">Payement du <strong style="color:#ff0000;">*</strong></label>
                                <input required type="date" name="dte_fin" class="form-control" />
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






            @endsection
