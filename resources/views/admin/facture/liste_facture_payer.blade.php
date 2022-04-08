@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Liste des factures payées</p>
@endsection
@section('content')

<style>
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

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

            {{-- <div class="col-lg-12">
            	<br>
                <h3> <strong>Liste Facture</strong></h3>
            </div> --}}

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                        <a class="nav-link  {{ Route::currentRouteNamed('liste_facture',2) || Route::currentRouteNamed('liste_facture',2) ? 'active' : '' }}" href="{{route('liste_facture',2)}}">
                            <i class="fa fa-list">Liste des Factures</i></a>
                        </li>
                        @canany(['isSuperAdmin','isCFP'])
                            <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('facture') ? 'active' : '' }}" href="{{route('facture')}}">
                                <i class="fa fa-plus">Nouveau Facture</i></a>
                            </li>
                        @endcanany
                    </ul>

                    </div>
                </div>
                </nav>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item mx-2"><h6>
                            <a class="nav-link {{ Route::currentRouteNamed('liste_facture',0) || Route::currentRouteNamed('liste_facture',0) ? 'active' : '' }}" href="{{route('liste_facture',0)}}"><strong style="color:blueviolet">Payée</strong><strong style="color: red;">
                                @if ($compte_facture_payer == null)
                                (0)
                                @else
                                ({{$compte_facture_payer->totale}})
                                @endif

                            </strong></a></h6>
                        </li>
                        <li class="nav-item mx-2"><h6>
                            <a class="nav-link {{ Route::currentRouteNamed('liste_facture',1) || Route::currentRouteNamed('liste_facture',1) ? 'active' : '' }}" href="{{route('liste_facture',1)}}">En cours<strong style="color: red;">
                                @if ($compte_facture_en_cour == null)
                                    (0)
                                    @else
                                    ({{$compte_facture_en_cour->totale}})
                                    @endif
                            </strong></a></h6>
                        </li>
                        <li class="nav-item mx-2"> <h6>
                            <a class="nav-link {{ Route::currentRouteNamed('liste_facture',2) || Route::currentRouteNamed('liste_facture',2) ? 'active' : '' }}" href="{{route('liste_facture',2)}}">Validée <strong style="color: red;">
                                @if ($compte_facture_actif == null)
                                (0)
                                @else
                                ({{$compte_facture_actif->totale}})
                                @endif
                            </strong> </a></h6>
                        </li>
                        <li class="nav-item mx-2"><h6>
                            <a class="nav-link {{ Route::currentRouteNamed('liste_facture',3) || Route::currentRouteNamed('liste_facture',3) ? 'active' : '' }}" href="{{route('liste_facture',3)}}">Brouillons<strong style="color: red;">
                                @if ($compte_facture_inactif == null)
                                    (0)
                                    @else
                                    ({{$compte_facture_inactif->totale}})
                                    @endif
                            </strong></a></h6>
                        </li>

                    </ul>

                    <div class="d-flex">
                        <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list">
                            <li class="nav-item">
                                <a href="#" class=" active" id="home-tab" data-toggle="tab" data-target="#invitation" type="button" role="tab" aria-controls="invitation" aria-selected="true">
                                    recherce par intervale de date
                                </a>
                            </li>
                            <li class="nav-item ms-5">
                                <a href="#" class="" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">
                                    recherche par numero
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
                </div>
            </nav>

            <div class="container-fluid mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane fade show active" id="invitation" role="tabpanel" aria-labelledby="home-tab">

                                <div class="row">
                                    <div class="col"></div>

                                    <div class="col-8">
                                        <h5>Recherche par Date</h5>

                                        <form class="d-flex mt-3">
                                            @csrf
                                            <div class="form-group">
                                                <input id="fact_dte" class="form-control input_inscription me-2" type="date" aria-label="Search">
                                                <label for="fact_dte" class="form-control-placeholder">Invoice Date<strong style="color:#ff0000;">*</strong></label>
                                            </div>
                                            <div class="form-group">
                                                <input id="fact_dte2" class="form-control input_inscription me-2" type="date" aria-label="Search">
                                                <label for="fact_dte2" class="form-control-placeholder">Due Date<strong style="color:#ff0000;">*</strong></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="form-control input_inscription mt-1" style="background: #9C27B0; color:white" id="exampleFormControlInput1" placeholder="Invoice Date" value="recherce" />
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>

                            <div class="tab-pane fade show" id="profile" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col"></div>

                                    <div class="col-4">
                                        <h5>Recherche par Numero Facture</h5>

                                        <form class="d-flex mt-3">
                                            <div class="form-group">
                                                <input id="num_fact" required class="form-control input_inscription me-2" type="text" aria-label="Search">
                                                <label for="num_fact" class="form-control-placeholder">Numéro de facture<strong style="color:#ff0000;">*</strong></label>
                                            </div>
                                            <div class="form-group">
                                                <input type="submit" class="form-control input_inscription mt-1" style="background: #9C27B0; color:white" id="exampleFormControlInput1" placeholder="Invoice Date" value="recherce" />
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                {{-- <form class="form-inline my-2 my-lg-0">
                                            @csrf
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-auto">
                                                        <label for="exampleFormControlInput1" class="form-label">numéro facture<strong class="text-red">*</strong></label>
                                                    </div>
                                                    <div class="col-auto">
                                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="numéro facture" list="num_facture" name="sts" />
                                                        <datalist id="num_facture">
                                                            @foreach ($facture_inactif as $tab)
                                                            <option>{{$tab->num_facture}}</option>
                                @endforeach
                                </datalist>
                            </div>
                            <div class="col-auto">
                                <input type="submit" class="form-control btn btn-success" id="exampleFormControlInput1" placeholder="Invoice Date" value="recherce" />

                            </div>
                        </div>
                    </div>



                    </form> --}}
                </div>
            </div>


        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="table-responsive">


                            <div class="container-fluid my-2">


                            <div class="row">

                                <table class="table table-striped ">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Numéro de facture</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Invoice Date</th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Date Totale</th>
                                            <th scope="col">Activité</th>
                                            @canany(['isSuperAdmin', 'isCFP'])
                                                <th scope="col" colspan="2">Action</th>
                                            @endcanany
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($facture) > 0)
                                        @foreach ($facture as $actif)
                                        <tr>
                                            <td class="text-center" style="color:green;">O</td>
                                            <th>
                                            <a href="{{route('detail_facture',$actif->num_facture)}}">
                                                <i class="fa fa-barcode"></i>
                                                {{$actif->num_facture}}
                                            </a>
                                            </th>
                                            <td>{{$actif->other_message}}</td>
                                            <td>{{$actif->invoice_date}}</td>
                                            <td>{{$actif->due_date}}</td>
                                            <td>{{$actif->totale_jour.' jour(s)'}}</td>

                                            @if ($actif->facture_encour == "valider")

                                                <td style="color:red;"><i class="fa fa-bolt"></i>{{$actif->facture_encour}}</td>
                                                @canany(['isCFP'])]
                                                <td>
                                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        ...
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        <li>
                                                            <button class="btn btn-success btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a></li>
                                                    </ul>
                                                </td>
                                                @endcanany

                                                @elseif ($actif->facture_encour == "en_cour")

                                                <td style="color:rgb(198, 201, 25);"><i class="fa fa-shopping-bag"></i> {{$actif->facture_encour}}</td>
                                                @canany(['isCFP'])]
                                                <td>
                                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        ...
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        <li>
                                                            <button class="btn btn-success btn-block mb-2 payement" data-id="{{ $actif->num_facture }}" id="{{ $actif->num_facture }}" data-toggle="modal" data-target="#modal"><i class="fa fa-money"></i>Faire un encaissement</button>
                                                        </li>
                                                        <li>
                                                            <a href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a></li>
                                                    </ul>
                                                </td>
                                                @endcanany

                                            @else
                                                <td style="color:rgb(15, 221, 67);"><i class="fa fa-check-circle"></i><i class="fa fa-check-circle"></i> {{$actif->facture_encour}}</td>
                                                @canany(['isCFP'])]
                                                <td>

                                                    <div class="btn-group dropleft">
                                                        <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{route('imprime_feuille_facture',$actif->num_facture)}}">PDF</a>
                                                            {{-- <a class="dropdown-item" href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a> --}}
                                                            <hr class="dropdown-divider">
                                                            <a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a>
                                                        </div>
                                                    </div>


                                                    {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        ...
                                                    </a>
                                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                        <li><a class="dropdown-item" href="{{route('imprime_feuille_facture',$actif->num_facture)}}">PDF</a></li>
                                                        <li>
                                                            <a href="{{ route('listeEncaissement',[$actif->num_facture]) }}"><button type="submit" class="btn btn-info"><i class="fa fa-eye"></i>Liste des encaissements</button></a>
                                                        </li>
                                                        <li><hr class="dropdown-divider"></li>
                                                        <li><a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a></li>
                                                    </ul> --}}
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




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
