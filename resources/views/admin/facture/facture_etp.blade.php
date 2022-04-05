@extends('./layouts/admin')
@section('content')
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

</style>


<div class="container-fluid">
    {{-- <div class="row">
        <h3> <strong>Liste Facture</strong></h3>
    </div> --}}
</div>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item btn_next">
                    <a href="{{route('liste_facture')}}" class="nav-link">
                        Voir tout facture
                    </a>
                </li>
                <li class="nav-item btn_next">
                    <a class="nav-link  {{ Route::currentRouteNamed('liste_facture') || Route::currentRouteNamed('liste_facture') ? 'active' : '' }}" href="{{route('liste_facture')}}">Liste des Factures</a>
                </li>
                @canany(['isSuperAdmin','isCFP'])
                <li class="nav-item btn_next">
                    <a class="nav-link  {{ Route::currentRouteNamed('facture') ? 'active' : '' }}" href="{{route('facture')}}">Nouveau Facture</a>
                </li>
                @endcanany
            </ul>

        </div>
    </div>
</nav>


<div class="container-fluid">
    <div class="row">
        <div class="col-2">
            <h6 style="color: #AA076B">Critère</h6>
            <div class="row mt-0">
                <p>
                    <a data-bs-toggle="collapse" href="#detail_par_thematique" role="button" aria-expanded="false" aria-controls="detail_par_thematique">Recherche par thématique de formation</a>
            </p>
                <div class="collapse multi-collapse" id="detail_par_thematique">
                    <form class="mt-1 mb-2 form_colab" action="{{route('search_par_date')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="dte_debut" class="form-label" align="left"> date entre <strong style="color:#ff0000;">*</strong></label>
                        <input required type="date" name="dte_debut" class="form-control" />
                        <br>
                        <label for="dte_fin" class="form-label" align="left">à date <strong style="color:#ff0000;">*</strong></label>
                        <input required type="date" name="dte_fin" class="form-control" />
                        <button type="submit" class="btn_enregistrer">recherche</button>
                    </form>
                </div>

                <p>
                    <a data-bs-toggle="collapse" href="#search_num_fact" role="button" aria-expanded="false" aria-controls="search_num_fact">Recherche par Numero Facture</a>
                </p>
                <div class="collapse multi-collapse" id="search_num_fact">
                    <form class=" mt-1 mb-2 form_colab" method="POST" action="{{route('search_par_num_fact')}}" enctype="multipart/form-data">
                        @csrf
                        <label for="num_fact" class="form-control-placeholder">Numéro de facture<strong style="color:#ff0000;">*</strong></label>
                        <input name="num_fact" id="num_fact" required class="form-control" required type="text" aria-label="Search" placeholder="Numero Facture">
                        <input type="submit" class="btn_enregistrer" id="exampleFormControlInput1" placeholder="Invoice Date" value="recherce" />
                    </form>
                </div>
            </div>

        </div>
        <div class="col-10">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list">
                         <li class="nav-item me-5">
                            <a href="#" class="active" id="nav-valide-tab" data-bs-toggle="tab" data-bs-target="#nav-valide" type="button" role="tab" aria-controls="nav-valide" aria-selected="true">
                                Facture Valider
                                @if (count($facture_actif) > 0)
                                <strong style="color: red">({{count($facture_actif)}})</strong>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item me-5">
                            <a href="#" class="" id="nav-encour-tab" data-bs-toggle="tab" data-bs-target="#nav-encour" type="button" role="tab" aria-controls="nav-encour" aria-selected="false">
                                Facture En Cour
                                @if (count($facture_encour) > 0)
                                <strong style="color: red">({{count($facture_encour)}})</strong>
                                @endif
                            </a>
                        </li>
                        <li class="nav-item me-5">
                            <a href="#" class="" id="nav-payer-tab" data-bs-toggle="tab" data-bs-target="#nav-payer" type="button" role="tab" aria-controls="nav-payer" aria-selected="false">
                                Facture Payer
                                @if (count($facture_payer) > 0)
                                <strong style="color: red">({{count($facture_payer)}})</strong>
                                @endif
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">



                <div class="tab-pane fade show active" id="nav-valide" role="tabpanel" aria-labelledby="nav-valide-tab">
                    {{-- <div class="container-fluid">
                        <div class="row">
                            <div class="col"> --}}
                    <h6 style="color: #AA076B">Facture Validé</h6>
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Numéro de facture</th>
                                <th scope="col">Organisme de Formation</th>
                                <th scope="col">Projet / Session / type de formation</th>
                                <th scope="col">Invoice Date</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Activité</th>
                               <th scope="col" colspan="2">Satut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($facture_actif) > 0)
                            @foreach ($facture_actif as $actif)
                            <tr>
                                <td class="text-center" style="color:red;">{{$actif->description_type_facture}}</td>
                                <th>
                                    <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                        <strong> <i class="fa fa-barcode"></i> {{$actif->num_facture}} </strong>
                                    </a>
                                </th>
                                <td> <strong>{{$actif->nom_cfp}}</strong></td>
                                <td>{{$actif->nom_projet." / ".$actif->nom_groupe." / ".$actif->type_formation}}</td>
                                <td>{{$actif->invoice_date}}</td>
                                <td>{{$actif->due_date}}</td>
                                @if ($actif->jour_restant>=1)
                                <td style="color:red;">{{$actif->jour_restant.' jour(s) restant(s)'}}</td>
                                @else
                                <td style="color:red;">temps de payement a éxpirer!</td>
                                @endif
                                    @if ($actif->facture_encour == "valider")
                                    <td style="color:red;"><i class="fa fa-bolt"></i>{{$actif->facture_encour}}</td>
                                    @canany(['isCFP'])
                                    <td>
                                        <div class="dropdown">
                                            <div class="btn-group dropstart">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">

                                                    <a href="#" class="dropdown-item">
                                                        <button type="button" class=" btn btn_enregistrer payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-bs-toggle="modal" data-bs-target="#modal">Faire un encaissement</button>
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn btn_enregistrer">Liste des encaissements</button></a>
                                                    <hr class="dropdown-divider">
                                                    <a class="dropdown-item" href="{{route('facture')}} " style="color: green"><button type="text" class="btn btn_enregistrer">Creer nouveau facture</button></a>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endcanany
                                    @elseif ($actif->facture_encour == "en_cour")
                                    <td style="color:rgb(198, 201, 25);"><i class="fa fa-shopping-bag"></i> {{$actif->facture_encour}}</td>
                                    @canany(['isCFP'])
                                    <td>

                                        <div class="dropdown">
                                            <div class="btn-group dropstart">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <a href="#" class="dropdown-item">
                                                        <button type="button" class=" btn btn_enregistrer payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-bs-toggle="modal" data-bs-target="#modal">Faire un encaissement</button>
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn btn_enregistrer">Liste des encaissements</button></a>
                                                    <hr class="dropdown-divider">
                                                    <a class="dropdown-item" href="{{route('facture')}} " style="color: green"><button type="text" class="btn btn_enregistrer">Creer nouveau facture</button></a>

                                                </ul>
                                            </div>
                                        </div>

                                    </td>
                                    @endcanany
                                    @else
                                    <td style="color:rgb(15, 221, 67);"><i class="fa fa-check-circle"></i><i class="fa fa-check-circle"></i> {{$actif->facture_encour}}</td>
                                    @canany(['isCFP'])
                                    <td>

                                        <div class="dropdown">
                                            <div class="btn-group dropstart">
                                                <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <a class="dropdown-item" href="{{route('imprime_feuille_facture',$actif->num_facture)}}"><button type="button" class="btn btn_enregistrer">PDF</button></a>
                                                    <hr class="dropdown-divider">
                                                    <a class="dropdown-item" href="{{route('facture')}} " style="color: green"><button type="text" class="btn btn_enregistrer">Creer nouveau facture</button></a>

                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                    @endcanany
                                    @endif
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

                <div class="tab-pane fade " id="nav-encour" role="tabpanel" aria-labelledby="nav-encour-tab">
                    <h6 style="color: #AA076B">Facture En Cour</h6>
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Numéro de facture</th>
                                <th scope="col">Organisme de Formation</th>
                               <th scope="col">Projet / Session / type de formation</th>
                                <th scope="col">Invoice Date</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Activité</th>
                                <th scope="col" colspan="2">Satut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($facture_encour) > 0)
                            @foreach ($facture_encour as $actif)
                            <tr>
                                <td class="text-center" style="color:red;">{{$actif->description_type_facture}}</td>
                                <th>
                                    <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                        <strong> <i class="fa fa-barcode"></i> {{$actif->num_facture}} </strong>
                                    </a>
                                </th>
                                <td> <strong>{{$actif->nom_cfp}}</strong></td>
                                <td>{{$actif->nom_projet." / ".$actif->nom_groupe." / ".$actif->type_formation}}</td>
                                <td>{{$actif->invoice_date}}</td>
                                <td>{{$actif->due_date}}</td>
                                @if ($actif->jour_restant>=1)
                                <td style="color:red;">{{$actif->jour_restant.' jour(s) restant(s)'}}</td>
                                @else
                                <td style="color:red;">temps de payement a éxpirer!</td>
                                @endif
                                @if ($actif->facture_encour == "en_cour")
                                <td style="color:rgb(198, 201, 25);"><i class="fa fa-shopping-bag"></i> {{$actif->facture_encour}}</td>
                                @canany(['isCFP'])
                                <td>
                                    <div class="dropdown">
                                        <div class="btn-group dropstart">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <a href="#" class="dropdown-item">
                                                    <button type="button" class=" btn btn_enregistrer payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-bs-toggle="modal" data-bs-target="#modal">Faire un encaissement</button>
                                                </a>
                                                <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="button" class="btn btn_enregistrer">Liste des encaissements</button></a>
                                                <hr class="dropdown-divider">
                                                <a class="dropdown-item" href="{{route('facture')}} " style="color: green"><button type="text" class="btn btn_enregistrer">Creer nouveau facture</button></a>

                                            </ul>
                                        </div>
                                    </div>
                                </td>
                                @endcanany
                                @endif
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

                <div class="tab-pane fade" id="nav-payer" role="tabpanel" aria-labelledby="nav-payer-tab">
                    <h6 style="color: #AA076B">Facture Payer</h6>
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Numéro de facture</th>
                                <th scope="col">Organisme de Formation</th>
                                <th scope="col">Projet / Session / type de formation</th>
                                <th scope="col">Invoice Date</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Activité</th>
                                <th scope="col" colspan="2">Satut</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($facture_payer) > 0)
                            @foreach ($facture_payer as $actif)
                            <td class="text-center" style="color:red;">{{$actif->description_type_facture}}</td>
                            <th>
                                <a href="{{route('detail_facture_etp',[$actif->cfp_id,$actif->num_facture])}}">
                                    <strong> <i class="fa fa-barcode"></i> {{$actif->num_facture}} </strong>
                                </a>
                            </th>
                            <td> <strong>{{$actif->nom_cfp}}</strong></td>
                            <td>{{$actif->nom_projet." / ".$actif->nom_groupe." / ".$actif->type_formation}}</td>
                            <td>{{$actif->invoice_date}}</td>
                            <td>{{$actif->due_date}}</td>
                            @if ($actif->jour_restant>=1)
                            <td style="color:red;">{{$actif->jour_restant.' jour(s) restant(s)'}}</td>
                            @else
                            <td style="color:red;">temps de payement a éxpirer!</td>
                            @endif
                            @if ($actif->facture_encour == "valider")
                            <td style="color:red;"><i class="fa fa-bolt"></i>{{$actif->facture_encour}}</td>
                            @canany(['isCFP'])
                            <td>
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu">

                                        <button class="dropdown-item btn btn-default btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button>
                                        <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class=" btn btn-default btn-block mb-2"><i class="fa fa-eye"></i>Liste des encaissements</button></a>

                                        <hr class="dropdown-divider">
                                        <a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a>
                                    </div>
                                </div>
                            </td>
                            @endcanany
                            @elseif ($actif->facture_encour == "en_cour")
                            <td style="color:rgb(198, 201, 25);"><i class="fa fa-shopping-bag"></i> {{$actif->facture_encour}}</td>
                            @canany(['isCFP'])
                            <td>
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item btn btn-default btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button>
                                        <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class=" btn btn-default btn-block mb-2"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                    </div>
                                </div>
                            </td>
                            @endcanany
                            @else
                            <td style="color:rgb(15, 221, 67);"><i class="fa fa-check-circle"></i><i class="fa fa-check-circle"></i> {{$actif->facture_encour}}</td>
                            @canany(['isCFP'])
                            <td>
                                <div class="dropdown">
                                    <div class="btn-group dropstart">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('imprime_feuille_facture',$actif->num_facture)}}"><button type="button" class="btn btn_enregistrer">PDF</button></a>
                                            <hr class="dropdown-divider">
                                            <a class="dropdown-item" href="{{route('facture')}} " style="color: green"><button type="text" class="btn btn_enregistrer">Creer nouveau facture</button></a>

                                        </ul>
                                    </div>
                                </div>
                            </td>
                            @endcanany
                            @endif
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

            </div>



        </div>


        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript">
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

    </div>








    @endsection
