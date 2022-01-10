<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>catalogue pdf</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="d-flex">

            <img src="{{ public_path('img/logo_numerika/logonmrk.png') }}" alt="logonmk" class="logo">

        </div>
    </nav>


    <style type="text/css">

            .logo{
                width: 138px;
                height: 49px;
            }
            .logo-catalogue{
                width: 40px;
                height: 40px;
            }
            .hr-title-categorie{
                height:2px;
                border-width:0;
                color:rgb(108, 201, 218);
                background-color:rgb(108, 201, 218);
            }
            .navbar-pdf{
                background-color: black;
                color: white;
            }
            hr{
                background-color: black;
                border: 2px solid;
            }

.tarif-payer{
    background-color: #04803A;
    color: white;
}
.tarif-reste-positif{
    background-color: red;
    color: white;
}

.tarif-reste-negatif{
    background-color: black;
    color: white;
}

.titre-fiche-facture{
    color: rgb(218, 25, 115);
}

    </style>


<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12 text-center">
                    <h5 class="btn-warning">Feuille de Facture de {{$project->nom_etp}} pour  {{$project->nom_projet}}</h5>
        </div>
    </div>
</div>

<div class="container-fluid my-5">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card shadow p-3 mb-5 bg-body rounded">
                <div class="card-body">
                    <h6 class="card-title my-4">Date de creation du facture de Client:  <strong>{{date('Y-m-d h:m:s')}}</strong></h6>
                    <h4 class="card-title"><img src="storage/{{$project->logo}}" class="logo" alt="..."> {{$project->nom_etp}}</h4>
                    <h5 class="card-title my-1">Project: {{$project->nom_projet}}</h5>
                    <h5 class="card-title my-1">mode payement: <strong>{{$montant_facture->description_type_payement}}</strong></h5>

                    <h5 class="card-title my-1">
                        <a href="{{$montant_facture->bon_de_commande}}">
                            click Bon de Commandde(pdf)
                        </a>

                    </h5>
                    <h5 class="card-title my-1">
                        <a href="{{$montant_facture->facture}}">
                            click Facture(pdf)
                        </a>
                    </h5>

                    <div class="row">


                        <div class="col-md-10 mx-3">

                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Totale Facture</th>
                                    <th scope="col" class="text-muted"><h5>{{$montant_facture->montant_total}} AR</h5></th>
                                </tr>
                                </thead>
                            <tbody>
                                <tr>
                                    <th scope="col">Déjà Payer</th>
                                    <td> <h5><strong class="tarif-payer">{{$montant_facture->payement_totale}} AR</strong></h5></td>
                                </tr>
                                <tr>
                                    @if ($montant_facture->dernier_montant_ouvert> 0)
                                    <th scope="col">Crédit du Clients</th>
                                    <td><h5><strong class="tarif-reste-positif">{{$montant_facture->dernier_montant_ouvert}} AR</strong></h5></td>
                                    @else
                                    <th scope="col">Débit du Clients</th>
                                    <td><h5><strong class="tarif-reste-negatif">{{$montant_facture->dernier_montant_ouvert}} AR</strong></h5></td>
                                    @endif

                                </tr>
                            </tbody>
                            </table>

                            @if($frais_annexes != null)
                            <table class="table my-2">
                                <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">Totale</th>
                                    <th scope="col">Déjà Payer</th>
                                    <th scope="col">Reste Payer</th>
                                </tr>
                                </thead>
                            @foreach ($frais_annexes as $frais_annexe)

                            <tbody>
                                <tr>
                                <td> <h6><strong>{{$frais_annexe->frais_annexe_description}}</strong></h6></td>
                                <th scope="row" class="text-muted"><h6>{{$frais_annexe->montant_total}} AR</h6></th>
                                    <td> <h6><strong class="tarif-payer">{{$frais_annexe->payement_totale}} AR</strong></h6></td>
                                    @if ($montant_facture->dernier_montant_ouvert> 0)
                                    <td><h6><strong class="tarif-reste-positif">{{$frais_annexe->dernier_montant_ouvert}} AR</strong></h6></td>
                                    @else
                                    <td><h6><strong class="tarif-reste-negatif">{{$frais_annexe->dernier_montant_ouvert}} AR</strong></h6></td>
                                    @endif
                                </tr>
                            </tbody>

                            @endforeach
                            </table>
                            @endif


                        </div>


                    </div>

                    <h5 class="card-text my-4">Date dernière action d'Encaissement du Client:  <strong>{{$montant_facture->date_facture}}</strong></h5>
                </div>
            </div>
        </div>
        <div class="col-md-2"></div>

    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>
</html>
