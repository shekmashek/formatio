@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                        <a class="nav-link  {{ Route::currentRouteNamed('liste_facture',2) || Route::currentRouteNamed('liste_facture',2) ? 'active' : '' }}" href="{{route('liste_facture',2)}}">
                            <i class="fa fa-list">Liste des Factures</i></a>
                        </li>
                        @canany(['isCFP'])
                            <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('facture') ? 'active' : '' }}" href="{{route('facture')}}">
                                <i class="fa fa-plus">Nouveau Facture</i></a>
                            </li>
                        @endcanany


                    </ul>


                    </div>
                </div>
                </nav>



            <div class="col-lg-12">
            	<br>
                <h3> <strong>Liste Facture</strong></h3>
            </div>

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item mx-2"><h6>
                                <a class="nav-link {{ Route::currentRouteNamed('liste_facture',0) || Route::currentRouteNamed('liste_facture',0) ? 'active' : '' }}" href="{{route('liste_facture',0)}}">Payée<strong style="color: red;">
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
                    </div>
                    </div>
                </nav>

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <form class="form-inline my-2 my-lg-0">
                                @csrf
                                <li class="nav-item dropdown mx-2">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">numéro facture<strong class="text-red">*</strong></label>
                                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="numéro facture" list="num_facture" name="sts"/>
                                        <datalist id="num_facture">
                                            @foreach ($facture_inactif as $tab)
                                                <option>{{$tab->num_facture}}</option>
                                            @endforeach
                                        </datalist>
                                    </div>
                                </li>

                                <li class="nav-item dropdown mx-2">
                                    <div class="mb-3">
                                        <input type="submit" class="form-control btn btn-success" id="exampleFormControlInput1" placeholder="Invoice Date" value="recherce"/>
                                    </div>
                                </li>

                            </form>

                        </ul>

                        </div>
                    </div>
                    </nav>

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
                                            <th scope="col">Date Restant</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($facture_inactif) > 0)
                                        @foreach ($facture_inactif as $actif)
                                        <tr>
                                            <td class="text-center" style="color:red;">O</td>
                                            <th>
                                            <strong>
                                                <i class="fa fa-barcode"></i>
                                                {{$actif->num_facture}}
                                            </strong>
                                            </th>
                                            <td>{{$actif->other_message}}</td>
                                            <td>{{$actif->invoice_date}}</td>
                                            <td>{{$actif->due_date}}</td>
                                            <td>{{$actif->totale_jour.' jour(s))'}}</td>
                                            <td style="color:red;">{{$actif->jour_restant.' jour(s))'}}</td>
                                            <td>
                                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    ...
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                    <li>
                                                        <form action="{{route('valid_facture')}}" method="POST">
                                                            @csrf
                                                            <input name="num_facture" type="hidden" value="{{$actif->num_facture}}">
                                                            <button type="submit" class="btn btn-dark"> <i class="fa fa-save"></i></button>
                                                        </form>

                                                    </li>

                                                    </li>
                                                    <li>
                                                        <form action="{{route('valid_facture')}}" method="POST">
                                                            @csrf
                                                            <input name="num_facture" type="hidden" value="{{$actif->num_facture}}">
                                                            <button type="submit" class="btn btn-primary"> valider facture</button>
                                                        </form>

                                                    </li>
                                                    <li>
                                                        <a class="nav-link" href="{{route('delete_facture',$actif->num_facture)}}" >
                                                            <button type="submit" class="btn btn-danger"> <i class="fa fa-trash"></i></button>
                                                        </a>


                                                    </li>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="{{route('facture')}} ">creer nouveau facture</a></li>
                                                </ul>
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




                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

