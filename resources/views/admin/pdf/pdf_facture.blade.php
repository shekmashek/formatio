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

        /* hr {
            background-color: black;
            border: 2px solid;
        } */

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

        .table_facture2 table td:nth-child(2) {
            width: 300px;
        }

        tr {
            border: none;
        }

    </style>

    <div class="container-fluid mx-0">
        <div class="row g-0 ">
            <div class="col-md-12 ">
                <div class="row table_facture1 mx-1">
                    {{-- <div class="row  mx-2"> --}}

                    <table class="table table_sans_bordure">
                        {{-- <table class="table table_sans_bordure"> --}}
                        <tbody>

                            <tr>
                                <td colspan="3">
                                    <h6><img src="{{ public_path('images/CFP/'.$cfp->logo) }}" alt="logonmk" style="width: 300px; height: 90px;"></h6>
                                    {{-- <h6><img src="{{ asset('images/CFP/'.$cfp->logo) }}" alt="logonmk" style="width: 300px; height: 80px;"></h6> --}}

                                </td>

                                <td></td>

                                <td>
                                    <div align="right">
                                        <h3 class="mx-3">{{$facture[0]->reference_facture}}</h3>
                                        <h5><strong>{{$cfp->nom}}</strong></h5>
                                        <h6>{{$cfp->email}}</h6>
                                        <h6>{{$cfp->adresse_lot." ".$cfp->adresse_quartier}}</h6>
                                        <h6>{{$cfp->adresse_ville." ".$cfp->adresse_code_postal}}</h6>
                                        <h6>{{$cfp->adresse_region}}</h6>
                                        <h6>{{$cfp->telephone}}</h6>
                                        @if($cfp->site_web!=null)
                                        <h6>site: {{$cfp->site_web}}</h6>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    <h5>Facturé à <strong>{{$facture[0]->nom_etp}}</strong></h5>
                                    <h6>{{$facture[0]->email_etp}}</h6>
                                    @if($facture[0]->adresse_rue!=null && $facture[0]->adresse_quartier!=null)
                                    <h6>{{$facture[0]->adresse_rue." ".$facture[0]->adresse_quartier}}</h6>
                                    @endif
                                    @if($facture[0]->adresse_ville!=null && $facture[0]->adresse_code_postal!=null && $facture[0]->adresse_region!=null)
                                    <h6>{{$facture[0]->adresse_ville." ".$facture[0]->adresse_code_postal.", ".$facture[0]->adresse_region}}</h6>
                                    @endif
                                    <h6>{{$facture[0]->telephone_etp}}</h6>
                                    @if($facture[0]->site_etp!=null)
                                    <h6>{{$facture[0]->site_etp}}</h6>
                                    @endif
                                    <h6>nif: {{$facture[0]->nif}}</h6>
                                    <h6>stat: {{$facture[0]->stat}}</h6>
                                    <h6>cif: {{$facture[0]->cif}}</h6>
                                    <h6>rcs: {{$facture[0]->rcs}}</h6>
                                </th>
                                <td colspan="3"></td>
                                <td>
                                    <div align="right">
                                        <h6></h6><br>
                                        <h6></h6><br>
                                        <h6></h6><br>
                                        <h6></h6><br>
                                        <h6></h6><br>
                                        <h6></h6><br>
                                        <h5>Numéro de facture:{{$facture[0]->num_facture}}</h5>
                                        <h5>Reference de bon de commande: {{$facture[0]->reference_bc}}</h5>
                                        <h5>Date de facturation: {{$facture[0]->invoice_date}}</h5>
                                        <h5>Payment du: <strong>{{$facture[0]->due_date}}</strong></h5>
                                        <h5>Amount Due(MGA): <strong>Ar {{number_format($montant_totale->dernier_montant_ouvert,0,","," ")}}</strong></h5>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr>

                <div class="row mx-2">
                    <table class="table table-borderless">
                        <thead class="table-success">
                            <tr>
                                <th scope="col">Réf</th>
                                <th>Module</th>
                                <th>Designation</th>
                                <th></th>
                                <th>Qte</th>
                                <th>PU HT</th>
                                <th>
                                    <div align="right">
                                        Montant
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facture as $montant_facture)
                            <tr>
                                <td>{{$montant_facture->reference}}</td>
                                <td>{{$montant_facture->nom_module}}</td>
                                <td>{{$montant_facture->nom_projet." de la ".$montant_facture->nom_groupe." du ".$montant_facture->date_debut_session}}</td>
                                <td>{{$montant_facture->nom_groupe}}</td>
                                <td><strong>{{$montant_facture->qte}}</strong></td>
                                <td>
                                    <div align="left">
                                        Ar {{number_format($montant_facture->pu,0,","," ")}}
                                    </div>
                                </td>
                                <th>
                                    <div align="right">
                                        Ar {{number_format($montant_facture->hors_taxe,0,","," ")}}
                                    </div>
                                </th>
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
                                <th>
                                    <div align="right">
                                        Ar -{{number_format($fa->dernier_montant_ouvert,0,","," ")}}
                                    </div>
                                </th>
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
                                <td> <strong>{{$frais_annexe->qte}}</strong></td>
                                <td>
                                    <div align="left">
                                        Ar {{number_format($frais_annexe->pu,0,","," ")}}
                                    </div>
                                </td>
                                <td>
                                    <div align="right">
                                        <strong>Ar {{number_format($frais_annexe->hors_taxe,0,","," ")}}</strong>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>

                <hr>

                <div class="row table_facture2  mx-1">

                    <table class="table table-bordered border-dark">
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Montant Brut HT</td>
                                <td>
                                    <div align="right">
                                        Ar {{number_format($montant_totale->montant_brut_ht,0,","," ")}}
                                    </div>
                                </td>
                            </tr>
                            @if($montant_totale->remise>0)

                            <tr>
                                <td></td>
                                <td></td>
                                <td>Remise</td>
                                <td>
                                    <div align="right" style="background-color: rgb(255, 204, 0)">
                                        Ar -{{number_format($montant_totale->remise,0,","," ")}}
                                    </div>
                                </td>
                            </tr>
                            @endif
                            <tr>
                                <td></td>
                                <td></td>
                                <td>Net Commercial HT</td>
                                <td>
                                    <div align="right">
                                        Ar {{number_format($montant_totale->net_commercial,0,","," ")}}
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>TVA({{$facture[0]->pourcent}} %)</td>
                                <td>
                                    <div align="right">
                                        Ar {{number_format($montant_totale->tva,0,","," ")}}
                                    </div>
                                </td>
                            </tr>

                            @if($montant_totale->sum_acompte > 0 && strtoupper($facture[0]->reference_facture) == strtoupper("FACTURE"))

                            <tr>
                                <td></td>
                                <td></td>
                                <td>Acompte</td>
                                <td>
                                    <div align="right" style="background-color: rgb(255, 204, 0)">
                                        Ar -{{number_format($montant_totale->sum_acompte,0,","," ")}}
                                    </div>
                                </td>
                            </tr>
                            @endif

                            <tr>
                                <td></td>
                                <td></td>
                                <td>Net à payer TTC</td>
                                <td>
                                    <div align="right">
                                        <strong>Ar {{number_format($montant_totale->montant_total,0,","," ")}}</strong>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr>

                <div class="row table_facture2 mx-2 justify-content-center">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td style="max-width: 25%">
                                    <div align="left">
                                        <h6>Arretée la présente facture à la somme de:<strong>{{$lettre_montant}} Ariary</strong></h6><br>
                                        <h6>mode de payement: <strong>{{$montant_totale->description_financement}}</strong></h6><br>
                                        <h6>Autre Message</h6><br>
                                        <p>{{$facture[0]->other_message}}</p><br>
                                    </div>
                                </td>
                                <td style="max-width: 25%"></td>
                                <td style="max-width: 25%"></td>
                                <td style="max-width: 25%"></td>
                            </tr>
                            <tr>
                                <td style="max-width: 25%">
                                    <p>Info légale: NIF: {{$cfp->nif}}</p>
                                </td>
                                <td style="max-width: 25%">
                                    <p>STAT: {{$cfp->stat}}</p>
                                </td>
                                <td style="max-width: 25%">
                                    <p>RCS: {{$cfp->rcs}}</p>
                                </td>
                                <td style="max-width: 25%">
                                    <p>CIF: {{$cfp->cif}}</p>
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
