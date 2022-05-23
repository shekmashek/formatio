<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Facture d'abonnement</title>
</head>
<body>

    <style type="text/css">
        .status{
            color: #637381;
            font-size: 2rem;
        }

        .status span{
            color: red;
        }

        .payer{
            color: rgb(7, 158, 7);
        }
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

    <div class="container-fluid me-2 mr-2">
        <div class="row g-0 ">
            <div class="col-md-12 ">
                <div class="row table_facture1  me-2 mr-2">
                    <table class="table table_sans_bordure">
                        <tbody>
                            <tr>
                                <td>
                                    <img src="{{ public_path('images/upskill.png') }}" width="200px">
                                    {{-- <img src="{{ asset('images/talenta.png') }}" class="img-fluid" width="500px"> --}}
                                </td>
                                <td>
                                    @if ($facture[0]->status_facture == "Non payé")
                                        <div class="status p-0">
                                            <span class="text-center p-0 m-0">{{$facture[0]->status_facture}}</span>
                                        </div>
                                    @else
                                        <div class="payer" style="justify-content: center;text-align:center">
                                            <span style="font-size: 80%">{{$facture[0]->status_facture}}</span>
                                        </div>
                                    @endif
                                </td>
                                <td align="right">
                                    <h6>UpSkill</h6>
                                    <h6>contact@formation.mg</h6>
                                    <h6>Lot IIN 60 Analamahitsy 101 Antananarivo Madagascar</h6>
                                    <h6>+261 34 81 135 63</h6>
                                    <h6>www.formation.mg</h6><br>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h5>Facturé à </h5>
                                    @if($cfp!=null)
                                        <h6>{{$cfp->nom}}</h6>
                                        <h6>{{$cfp->email}}</h6>
                                        <h6>{{$cfp->adresse_lot." ".$cfp->adresse_quartier}}</h6>
                                        <h6>{{$cfp->adresse_ville." ".$cfp->adresse_code_postal}}</h6>
                                        <h6>{{$cfp->adresse_region}}</h6>
                                        <h6>{{$cfp->telephone}}</h6>
                                        <h6>{{$cfp->site_web}}</h6>
                                        <p class="m-0 adresse_cfp">NIF : {{$cfp->nif}} &nbsp;&nbsp; - &nbsp;&nbsp; Stat : {{$cfp->stat}} &nbsp;&nbsp; - &nbsp;&nbsp; RCS : {{$cfp->rcs}}  &nbsp;&nbsp; - &nbsp;&nbsp; CIF : {{$cfp->cif}}</p>
                                    @endif
                                    @if($entreprises!=null)
                                        <h6>{{$entreprises->nom_etp}}</h6>
                                        <h6>{{$entreprises->email_etp}}</h6>
                                        <h6>{{$entreprises->adresse_rue." ".$entreprises->adresse_quartier}}</h6>
                                        <h6>{{$entreprises->adresse_ville." ".$entreprises->adresse_code_postal}}</h6>
                                        <h6>{{$entreprises->adresse_region}}</h6>
                                        <h6>{{$entreprises->telephone_etp}}</h6>
                                        <h6>{{$entreprises->site_etp}}</h6>
                                        <p class="m-0 adresse_cfp">NIF : {{$entreprises->nif}} &nbsp;&nbsp; - &nbsp;&nbsp; Stat : {{$entreprises->stat}} &nbsp;&nbsp; - &nbsp;&nbsp; RCS : {{$entreprises->rcs}}  &nbsp;&nbsp; - &nbsp;&nbsp; CIF : {{$entreprises->cif}}</p>
                                    @endif
                                </td>
                                <td></td>
                                <td>
                                    <div align="right">
                                        <h6></h6><br>
                                        <h6></h6><br>
                                        <h6>Facture N° :  {{$facture[0]->num_facture}}</h6>
                                        <h6>Date de facturation :  {{$facture[0]->invoice_date}}</h6>
                                        <h6>Date d'échéance : {{$facture[0]->due_date}}</h6>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row me-2 mr-2">
                    <table class="table">
                        <thead class="btn-secondary">
                            <tr>
                                <th scope="col">Description</th>
                                <th>Montant </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Abonnement {{$facture[0]->nom_type}} - Mensuel <br> Debut : {{$dates_abonnement[0]->date_debut}} <br> Fin: {{$dates_abonnement[0]->date_fin}}</td>
                                <td>{{number_format($facture[0]->montant_facture, 0, ',', '.')}} Ar</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <p>Arretée la présente facture à la somme de:<strong> {{$lettre_montant}} Ariary</strong></p>
    </div>
</body>
</html>
