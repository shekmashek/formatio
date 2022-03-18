<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>{{$facture[0]->description_type_facture.' du projet '.$facture[0]->nom_projet}} pdf</title>
</head>
<body>

    <style type="text/css">
        /* h1 {

            font-size: 80%;
            }
            h2 {

            font-size: 80%;
            } */
        h3 {

            font-size: 15px;
        }

        h4 {

            /* font-size: 90%; */
            font-size: 15px;
        }

        h5 {

            font-size: 10px;
        }

        h6 {

            font-size: 10px;
        }

        p {

            font-size: 80%;
        }

        table,
        th,
        td {
            font-size: 10px;
        }

        .logo {
            width: 120px;
            height: 40px;
        }

        .logo-catalogue {
            width: 40px;
            height: 40px;
        }

        .hr-title-categorie {
            height: 2px;
            border-width: 0;
            color: rgb(108, 201, 218);
            background-color: rgb(108, 201, 218);
        }

        .navbar-pdf {
            background-color: black;
            color: white;
        }

        hr {
            background-color: black;
            border: 2px solid;
        }

        .logo-catalogue {
            width: 60px;
            height: 60px;
        }

        .tarif-payer {
            background-color: #04803A;
            color: white;
        }

        .tarif-reste-positif {
            background-color: red;
            color: white;
        }

        .tarif-reste-negatif {
            background-color: black;
            color: white;
        }

        .titre-fiche-facture {
            color: rgb(218, 25, 115);
        }

        .place_droite {
            float: right;
        }

        .table_facture1 table,
        .table_facture1 th,
        .table_facture1 td {
            border: none !important;
            border-collapse: collapse;
        }

        .table_facture2 table,
        .table_facture2 th,
        .table_facture2 td {
            border: none !important;
            border-collapse: collapse;
        }

        .table_facture2 table td:nth-child(2){
            width: 300px;
        }
        tr {
            border: none;
        }

    </style>

    <div class="container-fluid">
        <div class="row g-0 ">
            <div class="col-md-12 ">
                <h3 class="mx-3">{{$facture[0]->description_type_facture}}</h3>
                <div class="row table_facture1 mx-2">
                    <table class="table table_sans_bordure">
                        <tbody>

                            <tr>
                                <td colspan="3">
                                    <h6></h6><br>
                                    <h6>nif: {{$cfp->nif}}</h6>
                                    <h6>stat: {{$cfp->stat}}</h6>
                                    <h6>cif: {{$cfp->cif}}</h6>
                                    <h6>rcs: {{$cfp->rcs}}</h6>
                                </td>


                                <td>
                                    <h6></h6><br>
                                    <h6></h6><br>
                                    <h6>mail: {{$cfp->email}}</h6>
                                    <h6>tél: {{$cfp->telephone}}</h6>
                                    @if($cfp->site_cfp!=null)
                                    <h6>site: {{$cfp->site_cfp}}</h6>
                                    @endif
                                </td>

                                <td>
                                    <div align="right">
                                        <h6><img src="{{ public_path('images/CFP/'.$cfp->logo) }}" alt="logonmk" style="width: 200px; height: 60px;"></h6>
                                        {{-- <h6><img src="{{$rawData}}" alt="logonmk" style="width: 200px; height: 60px;"></h6> --}}
                                        <h5><strong>{{$cfp->nom}}</strong></h5>
                                        <h6>adresse: {{$cfp->adresse_lot}}</h6>
                                        <h6>ville: {{$cfp->adresse_ville}}</h6>
                                    </div>
                                </td>

                            </tr>
                            <tr>
                                <td colspan="5">
                                    <h5><strong>Facturé à</strong></h5>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <h5><strong>{{$facture[0]->nom_etp}}</strong></h5>
                                    <h6>mail: {{$facture[0]->email_etp}}</h6>
                                    <h6>{{$facture[0]->adresse}}</h6>
                                    <h6>tél: {{$facture[0]->telephone_etp}}</h6>
                                    @if($facture[0]->site_etp!=null)
                                    <h6>site: {{$facture[0]->site_etp}}</h6>
                                    @endif
                                </th>
                                <td colspan="3">
                                    <br>
                                    <h6>nif: {{$facture[0]->nif}}</h6>
                                    <h6>stat: {{$facture[0]->stat}}</h6>
                                    <h6>cif: {{$facture[0]->cif}}</h6>
                                    <h6>rcs: {{$facture[0]->rcs}}</h6>

                                </td>
                                {{-- <td></td> --}}
                                <td>
                                    <div align="right">
                                        <h5><strong>Invoice Number:{{$facture[0]->num_facture}}</strong></h5>
                                        <h6>Reference de Bon de Commande: <strong>{{$facture[0]->reference_bc}}</strong></h6>
                                        <h6>Invoice Date: <strong>{{$facture[0]->invoice_date}}</strong></h6>
                                        <h6>Payment Due: <strong>{{$facture[0]->due_date}}</strong></h6>
                                        <h6>Amount Due(MGA): <strong>Ar{{number_format($montant_totale->dernier_montant_ouvert,2,",",".")}}</strong></h6>
                                        <h6>Mode de Payement: <strong>{{$facture[0]->description_financement}}</strong></h6>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <th colspan="5">
                                    <h4>Facture: N° {{$rel_date = date( "Ymdhsm",  strtotime($facture[0]->due_date))}}</h4>
                                </th>
                            </tr>

                        </tbody>
                    </table>
                </div>
                <div class="row mx-2">
                    <table class="table table-borderless">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">Session</th>
                                <th>Designation</th>
                                <th scope="col">PUTH(AR)</th>
                                <th scope="col">Quantité</th>
                                <th scope="col">Montant(AR)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facture as $montant_facture)
                            <tr>
                                <th>{{$montant_facture->nom_groupe}}</th>
                                <td>{{$montant_facture->description_facture}}</td>
                                <td><strong>{{number_format($montant_facture->pu,2,",",".")}}</strong></td>
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
                                <td><strong>{{number_format($frais_annexe->pu,2,",",".")}}</strong></td>
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
                                <td class="table-warning"><strong>{{number_format($fa->pu,2,",",".")}}</strong></td>
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
                </div>
                <div class="row table_facture2">

                        <table class="table table-borderless">
                            <tbody>
                                <tr align="right">

                                    <td colspan="5"><strong>Montant Brut HT(Ariary)</strong></td>
                                    <td>
                                        <div align="right">
                                            <strong>{{number_format($montant_totale->montant_brut_ht,2,",",".")}}</strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr align="right">

                                    <td colspan="5"><strong>Remise(Ariary)</strong></td>
                                    <td>
                                        <div align="right">
                                            <strong>{{number_format($montant_totale->remise,2,",",".")}}</strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr align="right">

                                    <td colspan="5"><strong>Net Commercial HT(Ariary)</strong></td>
                                    <td>
                                        <div align="right">
                                            <strong>{{number_format($montant_totale->net_commercial,2,",",".")}}</strong>
                                        </div>
                                    </td>
                                </tr>
                                <tr align="right">

                                    <td colspan="5"><strong>TVA({{$facture[0]->pourcent}} %)</strong></td>
                                    <td>
                                        <div align="right">
                                            <strong>{{number_format($montant_totale->tva,2,",",".")}}</strong>
                                        </div>
                                    </td>
                                </tr>

                                @if($montant_totale->sum_acompte > 0 && strtoupper($facture[0]->reference_facture) == strtoupper("FACTURE"))

                                <tr align="right">

                                    <td colspan="5"><strong>Facture d'Acompte(Ariary)</strong></td>
                                    <td>
                                        <div align="right" class="table-warning">
                                            <strong>-{{number_format($montant_totale->sum_acompte,2,",",".")}}</strong>
                                        </div>
                                    </td>
                                </tr>
                                @endif

                                <tr align="right">

                                    <td colspan="5"><strong>Net à Payer TTC(Ariary)</strong></td>
                                    <td>
                                        <div align="right">
                                            <strong>{{number_format($montant_totale->montant_total,2,",",".")}}</strong>
                                        </div>
                                    </td>
                                </tr>

                                <tr align="right">

                                    <td colspan="5"><strong>Reste à Payer(Ariary)</strong></td>
                                    <td>
                                        <div align="right" class="table-success">
                                            <strong>{{number_format( $montant_totale->dernier_montant_ouvert,2,",",".")}}</strong>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                </div>
                <div class="row table_facture2 mx-2">


                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>
                                    <h6>Arretée la présente facture à la somme de:</h6>
                                    <ul>
                                        Ariary <strong>{{$lettre_montant}}</strong>
                                    </ul>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <h6>Autre Message</h6>
                                    <ul>
                                        <strong>{{$facture[0]->other_message}}</strong>
                                    </ul>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>
</html>
