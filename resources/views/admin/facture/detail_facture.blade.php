@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Détail facture</h3>
@endsection
@section('content')

<style type="text/css">
</style>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

            {{-- <div class="col-lg-12">
                <br>
                <h3> <strong>Detail Facture</strong></h3>
            </div> --}}

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item btn_next">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_facture') || Route::currentRouteNamed('liste_facture') ? 'active' : '' }}" href="{{route('liste_facture')}}">
                                    Liste des Factures</a>
                            </li>
                            @canany(['isCFP','isCFPrincipale'])
                            <li class="nav-item btn_next">
                                <a class="nav-link  {{ Route::currentRouteNamed('facture') ? 'active' : '' }}" href="{{route('facture')}}">
                                    Nouveau Facture</a>
                            </li>
                            <li class="nav-item btn_next">
                            <a class="nav-link  {{ Route::currentRouteNamed('imprime_feuille_facture') ? 'active' : '' }}" href="{{route('imprime_feuille_facture',$facture[0]->num_facture)}}">
                                PDF</a>
                            </li>
                            @endcanany
                            @canany(['isReferentPrincipale','isManagerPrincipale','isReferent','isManager'])
                            <li class="nav-item btn_next">
                                <a class="nav-link  {{ Route::currentRouteNamed('imprime_feuille_facture_etp') ? 'active' : '' }}" href="{{route('imprime_feuille_facture_etp',[$cfp->id,$facture[0]->num_facture])}}">
                                    PDF</a>
                            </li>
                            @endcanany


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

                        <div class="container-fluid my-2">
                            <div class="row my-4">
                                <div class="col-md-4">
                                    <h2>{{$facture[0]->description_type_facture}}</h2>
                                </div>
                                <div class="col-md-8"></div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <h6></h6><br>
                                    <h6>nif: {{$cfp->nif}}</h6>
                                    <h6>stat: {{$cfp->stat}}</h6>
                                    <h6>cif: {{$cfp->cif}}</h6>
                                    <h6>rcs: {{$cfp->rcs}}</h6>
                                </div>
                                <div class="col-md-3">
                                    <div align="right">
                                        <h6></h6><br>
                                        <h6></h6><br>
                                        <h6>mail: {{$cfp->email}}</h6>
                                        <h6>tél: {{$cfp->telephone}}</h6>
                                        @if($cfp->site_web!=null)
                                        <h6>site: {{$cfp->site_web}}</h6>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div align="right">
                                        {{-- <h6><img src="/image-cfp/{{$cfp->logo }}" alt="logonmk" style="width: 200px; height: 60px;"></h6> --}}
                                        <h6><img src="{{asset('images/CFP/'.$cfp->logo) }}" alt="logonmk" style="width: 200px; height: 60px;"></h6>

                                        <h5><strong>{{$cfp->nom}}</strong></h5>
                                        <h6>adresse: {{$cfp->adresse_lot}}</h6>
                                        <h6>ville: {{$cfp->adresse_ville}}</h6>
                                    </div>
                                </div>

                            </div>

                            <div class="row my-5"></div>
                        </div>

                        <div class="container-fluid my-5">

                            <div class="row">
                                <h5><strong>Facturé à</strong></h5>

                                <div class="col-md-3">
                                    <div align="left">
                                        <h5><strong>{{$facture[0]->nom_etp}}</strong></h5>
                                        <h6>mail: {{$facture[0]->email_etp}}</h6>
                                        <h6>{{$facture[0]->adresse}}</h6>
                                        <h6>tél: {{$facture[0]->telephone_etp}}</h6>
                                        @if($facture[0]->site_etp!=null)
                                        <h6>site: {{$facture[0]->site_etp}}</h6>
                                        @endif

                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div align="left">
                                        <br>
                                        <h6>nif: {{$facture[0]->nif}}</h6>
                                        <h6>stat: {{$facture[0]->stat}}</h6>
                                        <h6>cif: {{$facture[0]->cif}}</h6>
                                        <h6>rcs: {{$facture[0]->rcs}}</h6>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div align="right">
                                        <h5><strong>Invoice Number:{{$facture[0]->num_facture}}</strong></h5>
                                        <h6>Reference de Bon de Commande: <strong>{{$facture[0]->reference_bc}}</strong></h6>
                                        <h6>Invoice Date: <strong>{{$facture[0]->invoice_date}}</strong></h6>
                                        <h6>Payment Due: <strong>{{$facture[0]->due_date}}</strong></h6>
                                        <h6> <strong>Amount Due(MGA):Ar{{number_format($montant_totale->dernier_montant_ouvert,2,",",".")}}</strong></h6>
                                        <h6>Mode de Payement: <strong>{{$facture[0]->description_financement}}</strong></h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr>
                        <h4>Facture: N° {{$rel_date = date( "Ymdhsm",  strtotime($facture[0]->due_date))}}</h4>

                        <div class="container-fluid my-4">

                            <div class="row">
                                <table class="table ">
                                    <thead class="table-success">
                                        <tr>
                                            <th scope="col">Session</th>
                                            <th>Designation</th>
                                            <th scope="col">PUHT(AR)</th>
                                            <th scope="col">Quantité</th>
                                            <th scope="col">Montant(AR)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($facture as $montant_facture)

                                        <tr>
                                            <th>{{$montant_facture->nom_groupe}}</th>
                                            <td>{{$montant_facture->description_facture}}</td>
                                            <td>
                                                <div align="right">
                                                    <strong>{{number_format($montant_facture->pu,2,",",".")}}</strong>
                                                </div>
                                            </td>
                                            <td><strong>{{$montant_facture->qte}}</strong></td>
                                            <td>
                                                <div align="right">
                                                    <strong>{{number_format($montant_facture->hors_taxe,2,",",".")}}</strong>
                                                </div>
                                            </td>
                                        </tr>

                                        @endforeach

                                        @if($frais_annexes != null)
                                        @foreach ($frais_annexes as $frais_annexe)

                                        <tr>
                                            <th>{{$frais_annexe->frais_annexe_description}}</th>
                                            <td>{{$frais_annexe->description}}</td>
                                            <td>
                                                <div align="right">
                                                    <strong>{{number_format($frais_annexe->pu,2,",",".")}}</strong>
                                                </div>
                                            </td>
                                            <td><strong>{{$frais_annexe->qte}}</strong></td>
                                            <td>
                                                <div align="right">
                                                    <strong>{{number_format($frais_annexe->hors_taxe,2,",",".")}}</strong>
                                                </div>
                                            </td>
                                        </tr>

                                        @endforeach
                                        @endif

                                        @if($facture_acompte != null && strtoupper($facture[0]->reference_facture) == strtoupper("Facture"))
                                        @foreach ($facture_acompte as $fa)

                                        <tr>
                                            <th class="table-warning">{{$fa->reference_facture.' pour '.$fa->nom_groupe}}</th>
                                            <td class="table-warning">{{$fa->description_facture}}</td>
                                            <td class="table-warning">
                                                <div align="right">
                                                    <strong>{{number_format($fa->pu,2,",",".")}}</strong>
                                                </div>
                                            </td>
                                            <td class="table-warning"><strong>{{$fa->qte}}</strong></td>
                                            <td class="table-warning">
                                                <div align="right">
                                                    -<strong>{{number_format($fa->hors_taxe,2,",",".")}}</strong>
                                                </div>
                                            </td>
                                        </tr>

                                        @endforeach
                                        @endif

                                    </tbody>
                                </table>

                                <div class="container-fluid my-2">

                                    <div class="row mt-5">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="d-flex">
                                                        <td> <strong>Montant Brut HT(Ariary)</strong></td>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex">
                                                        <td>
                                                            <div align="right">
                                                                {{number_format($montant_totale->montant_brut_ht,2,",",".")}}
                                                            </div>
                                                        </td>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="d-flex">
                                                        <td> <strong>Remise(Ariary)</strong></td>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex">
                                                        <td id="totale_montant">
                                                            <div align="right">
                                                                -{{number_format($montant_totale->remise,2,",",".")}}
                                                            </div>
                                                        </td>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="d-flex">
                                                        <td> <strong>Net Commercial HT(Ariary)</strong></td>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex">
                                                        <td>
                                                            <div align="right">
                                                                {{number_format($montant_totale->net_commercial,2,",",".")}}
                                                            </div>
                                                        </td>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <hr>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="d-flex">
                                                        <td><strong>TVA({{$facture[0]->pourcent}} %)</strong></td>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex">
                                                        <td id="pourcentage">
                                                            <div align="right">
                                                                {{number_format($montant_totale->tva,2,",",".")}}
                                                            </div>
                                                        </td>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>


                                    @if($montant_totale->sum_acompte > 0 && strtoupper($facture[0]->reference_facture) == strtoupper("FACTURE"))

                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="d-flex">
                                                        <td><strong>Facture d'Acompte(Ariary)</strong></td>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex btn-warning">
                                                        <td>
                                                            <div align="right">
                                                                -{{number_format($montant_totale->sum_acompte,2,",",".")}}
                                                            </div>
                                                        </td>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                                    @endif

                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="d-flex">
                                                        <td><strong>Net à payer TTC(Ariary)</strong></td>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex">
                                                        <td>
                                                            <div align="right">
                                                                {{-- {{number_format($montant_totale->net_ttc,2,",",".")}} --}}
                                                                {{number_format($montant_totale->montant_total,2,",",".")}}
                                                            </div>
                                                        </td>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="d-flex">
                                                        <strong>Reste à payer(Ariary)</strong>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="d-flex table-success">
                                                        {{-- <td> --}}
                                                        <div align="right">
                                                            {{number_format( $montant_totale->dernier_montant_ouvert,2,",",".")}}
                                                        </div>
                                                        {{-- </td> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>


                                </div>

                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="row">

                                <div class="col-md-12">
                                    <p>Arretée la présente facture à la somme de:</p>

                                    <td>Ariary {{$lettre_montant}}</td>
                                    <hr class="mt-5">
                                    <p>Autre Message</p>

                                    <td>
                                        {{$facture[0]->other_message}}
                                    </td>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection
