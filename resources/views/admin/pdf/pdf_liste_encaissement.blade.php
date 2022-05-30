<?php $id=1; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <title>export pdf liste d'encaissement</title>
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

            font-size: 70%;
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

    <div class="container-fluid me-2 mr-2">
        <div class="row table_facture1  me-2 mr-2">
            <div class="col">
                <table class="table table_sans_bordure">
                    <tbody>
                        <tr>
                            <td colspan="3">
                                <h6><img src="{{ public_path('images/CFP/'.$cfp->logo) }}" alt="logonmk" style="width: 300px; height: 90px;"></h6>
                            </td>
                            <td></td>
                            <td>
                                <div align="right">
                                    <h3 class="mx-3">{{$montant_totale->reference_type_facture}}</h3>
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
                                <h5>Facturé à <strong>{{$entreprise->nom_etp}}</strong></h5>
                                <h6>{{$entreprise->email_etp}}</h6>
                                @if($entreprise->adresse_rue!=null && $entreprise->adresse_quartier!=null)
                                <h6>{{$entreprise->adresse_rue." ".$entreprise->adresse_quartier}}</h6>
                                @endif
                                @if($entreprise->adresse_ville!=null && $entreprise->adresse_code_postal!=null && $entreprise->adresse_region!=null)
                                <h6>{{$entreprise->adresse_ville." ".$entreprise->adresse_code_postal.", ".$entreprise->adresse_region}}</h6>
                                @endif
                                <h6>{{$entreprise->telephone_etp}}</h6>
                                @if($entreprise->site_etp!=null)
                                <h6>{{$entreprise->site_etp}}</h6>
                                @endif
                                <h6 class=" text-muted">nif: {{$entreprise->nif}}</h6>
                                <h6 class=" text-muted">stat: {{$entreprise->stat}}</h6>
                                <h6 class=" text-muted">cif: {{$entreprise->cif}}</h6>
                                <h6 class=" text-muted">rcs: {{$entreprise->rcs}}</h6>
                            </th>
                            <td colspan="3"></td>
                            <td>
                                <div align="right">
                                    <h6></h6><br>
                                    <h6></h6><br>
                                    <h4>N° facture: {{$montant_totale->num_facture}}</h4>
                                    <h4>N° BC: {{$facture[0]->reference_bc}}</h4>
                                    <h4>Date de facturation: {{$montant_totale->invoice_date}}</h4>
                                    <h4>Date de règlement: {{$montant_totale->due_date}}</h4>
                                    <h4>Reste à payer({{$devise->devise}}): {{number_format($montant_totale->dernier_montant_ouvert,0,","," ")}}</strong></h4>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Ouverture de container --}}
        <div class="row me-2 mr-2">
            <div class="col-md-12">

                <table class="table">
                    <thead class="btn-secondary">
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Libellé</th>
                            <th scope="col">Montant</th>
                            <th scope="col">Paiement</th>
                            <th scope="col">Montant ouvert</th>
                            <th scope="col">Mode de paiement</th>
                            <th scope="col">Encaisseur</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($encaissement as $info)
                        <tr>
                            <td>{{ $info->date_encaissement }}</td>
                            <td>{{ $info->libelle }}</td>
                            <td class="text-end">{{$devise->reference." ". number_format($info->montant_facture, 0, ',', ' ') }}</td>
                            <td class="text-end">{{$devise->reference." ". number_format($info->payement, 0, ',', ' ') }}</td>
                            <td class="text-end">{{$devise->reference." ". number_format($info->montant_ouvert, 0, ',', ' ') }}</td>
                            <td>{{ $info->description }}</td>
                            <td>{{ $info->nom_resp_cfp}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                {{-- Fermeture de row et col --}}
            </div>
        </div>

    </div>

    <div class="row table_facture2  me-2 mr-2 justify-content-center text-center text-muted">
        <p> nif: {{$cfp->nif}}&nbsp;&nbsp; stat: {{$cfp->stat}}&nbsp;&nbsp; rcs: {{$cfp->rcs}} &nbsp;&nbsp; cif: {{$cfp->cif}}</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script> --}}
</body>
</html>
