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

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="d-flex">

            <img src="{{ public_path('img/logo_formation/logo_transparent_background.png') }}" alt="logonmk" class="logo">

        </div>
    </nav>


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
            width: 138px;
            height: 49px;
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

    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <h3>Facture à payé</h3>

                <table border="1" width="auto" class="table">
                    <thead>
                        <tr>
                            <th scope="col">Numero Facture</th>
                            <th scope="col">date de création de facture</th>
                            <th scope="col">date fin du facture</th>
                            <th scope="col">Montant facture(Ariary)</th>
                            <th scope="col">Payer(Ariary)</th>
                            <th scope="col">Reste à payer(Ariary)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $montant_totale->num_facture }}</td>
                            <td>{{ $montant_totale->invoice_date }}</td>
                            <td>{{ $montant_totale->due_date }}</td>
                            <td class="text-end">{{ number_format($montant_totale->montant_total, 2, ',', ' ') }}</td>
                            <td class="text-end">{{ number_format($montant_totale->payement_totale, 2, ',', ' ') }}</td>
                            <td class="text-end">{{ number_format($montant_totale->dernier_montant_ouvert, 2, ',', ' ') }}</td>

                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Ouverture de container --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3>Liste(s) de(s) Encaissement(s)</h3>

                <table border="1" width="auto"  class="table">
                    <thead>
                        <tr>
                            <th scope="col">Date payement</th>
                            <th scope="col">Libellé</th>
                            <th scope="col">Facture</th>
                            <th scope="col">Montant facture(Ariary)</th>
                            <th scope="col">Paiement(Ariary)</th>
                            <th scope="col">Montant ouvert(Ariary)</th>
                            <th scope="col">Mode de payement</th>
                            <th scope="col">Encaisseur</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($encaissement as $info)
                        <tr>
                            <td>{{ $info->date_encaissement }}</td>
                            <td>{{ $info->libelle }}</td>
                            <td>{{ $info->num_facture }}</td>
                            <td class="text-end">{{ number_format($info->montant_facture, 2, ',', ' ') }}</td>
                            <td class="text-end">{{ number_format($info->payement, 2, ',', ' ') }}</td>
                            <td class="text-end">{{ number_format($info->montant_ouvert, 2, ',', ' ') }}</td>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script> --}}
</body>
</html>
