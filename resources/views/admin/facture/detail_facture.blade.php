@extends('./layouts/admin')
@section('title')
<h3 class="text_header m-0 mt-1">Détail facture</h3>
@endsection
@section('content')
{{-- <link rel="stylesheet" href="{{asset('css/facture.css')}}"> --}}


<link rel="stylesheet" href="{{asset('assets/css/facture_new.css')}}">
<style>
     .pdf_download{
            background-color: #e73827 !important;
        }
        .pdf_download:hover{
            background-color: #af3906 !important;
        }
        .pdf_download button{
            color: #ffffff !important;
        }

</style>
<div id="page-wrapper">
    <div class="container-fluid">
</div>

<div class="m-4">
    <section class="section1 mb-4">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <div class="">
                    <a class="nav-link   {{ Route::currentRouteNamed('liste_facture') || Route::currentRouteNamed('liste_facture') ? 'active' : '' }}" href="{{route('liste_facture')}}">
                        Retour à la liste des factures</a></div>
            </li>
            @canany(['isCFP','isCFPrincipale'])
            <li class="nav-item">

                    <a class="nav-link pdf_download  {{ Route::currentRouteNamed('imprime_feuille_facture') ? 'active' : '' }}" href="{{route('imprime_feuille_facture',$montant_totale->num_facture)}}">
                        <button class="btn"><i class="bx bxs-file-pdf"></i> PDF </button> </a>
            </li>
            @endcanany
            @canany(['isReferentPrincipale','isManagerPrincipale','isReferent','isManager'])
            <li class="nav-item ">
                <a class="nav-link pdf_download  {{ Route::currentRouteNamed('imprime_feuille_facture_etp') ? 'active' : '' }}" href="{{route('imprime_feuille_facture_etp',[$cfp->id,$montant_totale->num_facture])}}">
                    <button class="btn"><i class="bx bxs-file-pdf"></i> PDF </button></a>
            </li>
            @endcanany
        </ul>
    </section>

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">

                <div class="panel-body">

                    <div class="container-fluid my-2">
                        <div class="row p-2">
                            <div class="col-4">
                                {{-- <img src="{{asset('images/CFP/'.$cfp->logo)}}" alt="logo_cfp" class="img-fluid"> --}}
                                <img src="{{asset('images/CFP/'.$cfp->logo)}}" alt="logo_cfp" style="width: 300px; height: 90px;">
                            </div>
                            <div class="col-8 text-end" align="rigth">

                                <div class="info_cfp">
                                    <h2 class="mb-2">{{$montant_totale->reference_type_facture}}</h2>

                                    <h4 class="m-0 nom_cfp">{{$cfp->nom}}</h4>
                                    <p class="m-0 adresse_cfp">{{$cfp->email}}</p>
                                    <p class="m-0 adresse_cfp">{{$cfp->adresse_lot." ".$cfp->adresse_quartier}}</p>
                                    <p class="m-0 adresse_cfp">{{$cfp->adresse_ville." ".$cfp->adresse_code_postal}}</p>
                                    <p class="m-0 adresse_cfp">{{$cfp->adresse_region}}</p> <br>
                                    <p class="m-0 adresse_cfp">{{$cfp->telephone}}</p>
                                    @if ($cfp->site_web!=null)
                                    <p class="m-0 adresse_cfp">{{$cfp->site_web}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="container-fluid my-2">

                        <div class="row">
                            <h5><strong>Facturé à</strong></h5>

                            <div class="col-md-4">
                                <div align="left">
                                    <h5>{{$entreprise->nom_etp}}</h5>
                                    {{-- <p>{{$resp_actif->prenom_resp." ".$resp_actif->nom_resp." RESPONSABLE"}}</p> --}}
                                    <p class="m-0 adresse_cfp">{{$entreprise->email_etp}}</p>

                                    <p class="m-0 adresse_cfp">{{$entreprise->adresse_rue." ".$entreprise->adresse_quartier}}</p>
                                    <p class="m-0 adresse_cfp">{{$entreprise->adresse_ville." ".$entreprise->adresse_code_postal}}</p>
                                    <p class="m-0 adresse_cfp">{{$entreprise->adresse_region}}</p>
                                    <p class="m-0 adresse_cfp">{{$entreprise->telephone_etp}}</p>
                                    @if ($entreprise->site_etp!=null)
                                    <p class="m-0 adresse_cfp">{{$entreprise->site_etp}}</p>
                                    @endif
                                    <p class="m-0 adresse_cfp text-muted">NIF: {{$entreprise->nif}}</p>
                                    <p class="m-0 adresse_cfp text-muted">STAT: {{$entreprise->stat}}</p>
                                    <p class="m-0 adresse_cfp text-muted">RCS: {{$entreprise->rcs}}</p>
                                    <p class="m-0 adresse_cfp text-muted">CIF: {{$entreprise->cif}}</p>
                                </div>
                            </div>

                            <div class="col-md-3"></div>
                            <div class="col-md-5">
                                <div align="right" class="me-1">
                                    <h5>N° facture: {{$montant_totale->num_facture}}</h5>
                                    <h6>N° BC: {{$facture[0]->reference_bc}}</h6>
                                    <h6>Date de facturation: {{$montant_totale->invoice_date}}</h6>
                                    <h6>Date de règlement: {{$montant_totale->due_date}}</h6>
                                    <h6>Reste à payer({{$devise->devise}}): {{number_format($montant_totale->dernier_montant_ouvert,0,","," ")}} </h6>
                                </div>
                            </div>

                        </div>
                    </div>

                    <hr>
                    {{-- <h6 class="my-1">Facture: N° {{$rel_date = date( "Ymdhsm",  strtotime($facture[0]->due_date))}}</h6> --}}

                    <div class="container-fluid my-4">

                        <div class="row">
                            <table class="table ">
                                <thead class="">
                                    <tr>
                                        <th scope="col">Réf</th>
                                        <th>Module</th>
                                        <th>Designation</th>
                                        <th></th>
                                        <th>Qte</th>
                                        <th>Unité</th>
                                        <th>PU HT</th>
                                        <th>
                                            <div align="right">
                                                Montant
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="mb-1">
                                    @foreach ($facture as $montant_facture)
                                    <tr>
                                        <td>{{$montant_facture->reference}}</td>
                                        <td>{{$montant_facture->nom_module}}</td>
                                        <td>{{$montant_facture->nom_projet." de la ".$montant_facture->nom_groupe.",avec ".$montant_facture->nbre_participant." participant(s) du ".$montant_facture->date_debut_session}}</td>
                                        <td>{{$montant_facture->nom_groupe}}</td>
                                        <td>{{$montant_facture->qte}}</td>
                                        <td>
                                            <div align="left">
                                                {{$montant_facture->description_facture}}
                                            </div>
                                        </td>
                                        <td>
                                            <div align="left">
                                                {{$devise->reference." ".number_format($montant_facture->pu,0,","," ")}}
                                            </div>
                                        </td>
                                        <td>
                                            <div align="right">
                                                {{$devise->reference." ".number_format($montant_facture->hors_taxe,0,","," ")}}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach

                                    @if($facture_acompte != null && strtoupper($facture[0]->reference_facture) == strtoupper("Facture"))
                                    @foreach ($facture_acompte as $fa)
                                    <tr>
                                        <td>
                                            <a href="{{route('detail_facture',$fa->num_facture)}}">
                                                {{$fa->num_facture}}
                                            </a>
                                        </td>
                                        <td></td>
                                        <td>{{$fa->reference_type_facture}}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <div align="right">
                                                {{$devise->reference." -".number_format($fa->montant_total,0,","," ")}}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @if($frais_annexes != null)
                                    @foreach ($frais_annexes as $frais_annexe)
                                    <tr>
                                        <td>{{$frais_annexe->frais_annexe_description}}</td>
                                        <td></td>
                                        <td>{{$frais_annexe->description}}</td>
                                        <td></td>
                                        <td>{{$frais_annexe->qte}}</td>
                                        <td></td>
                                        <td>
                                            <div align="left">
                                                {{$devise->reference." ".number_format($frais_annexe->pu,0,","," ")}}
                                            </div>
                                        </td>
                                        <td>
                                            <div align="right">
                                                {{$devise->reference." ".number_format($frais_annexe->hors_taxe,0,","," ")}}
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                            <div class="container-fluid my-2">
                                <div class="row">
                                    <div class="col"></div>
                                    <div class="col"></div>
                                    <div class="col">
                                        {{-- <table class="table table-bordered border-dark"> --}}

                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>Montant Brut HT</td>
                                                    <td>
                                                        <div align="right">
                                                            {{$devise->reference." ".number_format($montant_totale->montant_brut_ht,0,","," ")}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                @if($montant_totale->remise>0)

                                                <tr>
                                                    <td>Remise</td>
                                                    <td>
                                                        <div align="right">
                                                            {{$devise->reference." -".number_format($montant_totale->remise,0,","," ")}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td>Net Commercial HT</td>
                                                    <td>
                                                        <div align="right">
                                                            {{$devise->reference." ".number_format($montant_totale->net_commercial,0,","," ")}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                @if($facture[0]->pourcent>0)
                                                <tr>
                                                    <td>TVA({{$facture[0]->pourcent}} %)</td>
                                                    <td>
                                                        <div align="right">
                                                            {{$devise->reference." ".number_format($montant_totale->tva,0,","," ")}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif

                                                @if($montant_totale->sum_acompte > 0 && strtoupper($facture[0]->reference_facture) == strtoupper("FACTURE"))
                                                <tr>
                                                    <td>Acompte</td>
                                                    <td>
                                                        <div align="right">
                                                            {{$devise->reference." -".number_format($montant_totale->sum_acompte,0,","," ")}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif


                                            </tbody>
                                        </table>
                                        <table class="table  table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>Net à payer TTC</td>
                                                    <td>
                                                        <div align="right">
                                                            {{$devise->reference." ".number_format($montant_totale->montant_total,0,","," ")}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                            </div>

                        </div>

                    </div>
                </div>

                <p>Arretée la présente facture à la somme de: {{$lettre_montant." ".$devise->devise}}</p>
                <p>mode de paiement: {{$montant_totale->description_financement}}</p>
                @if($facture[0]->other_message!=null)
                <p>Autre Message</p>
                <p style="max-width: 40%">{{$facture[0]->other_message}}</p>
                @endif
                <div class="container-fluid mb-5">
                    <div class="row text-muted">
                        <div class="col">
                            <p>NIF: {{$cfp->nif}}</p>
                        </div>
                        <div class="col">
                            <p>STAT: {{$cfp->stat}}</p>
                        </div>
                        <div class="col">
                            <p>RCS: {{$cfp->rcs}}</p>
                        </div>
                        <div class="col">
                            <p>CIF: {{$cfp->cif}}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
</div>
</div>


@endsection
