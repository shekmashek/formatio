@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Détail facture</h3>
@endsection
@section('content')

<style type="text/css">
    .btn_pdf{
        padding: auto 2rem;
        margin-right: 2rem;
        border: none;
        background: #637381;
        color: white;
        border-radius: 5px;
        }
        .btn_pdf:hover{
            color: black;
            background-color: rgb(224, 223, 223);
            box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 12px;
        }
        .btn_pdf .bx{
            font-size: 1.3rem;
            position: relative;
            top: .2rem;
        }
        .status{
            color: #637381;
            font-size: 3rem;
            justify-content: end;
        }

        .status span{
            border: 3px solid red;
            padding: .5rem 1rem;
            border-radius: 10px;
        }

        .payer{
            border: 3px solid rgb(7, 158, 7);
            padding: .5rem 1rem;
            border-radius: 10px;
        }

</style>

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg w-100">
                <div class="row w-100 g-0 m-0">
                    <div class="col-lg-12">
                        <div class="row g-0 m-0" style="align-items: center">
                            <div class="col-12 d-flex justify-content-between" style="align-items: center">
                                <div class="col" align="right">
                                    <button class="btn_pdf px-4 py-1" type="button"><i class='bx bxs-cloud-download me-3'></i>PDF</button>
                                    <a class="mb-2 new_list_nouvelle {{ Route::currentRouteNamed('ListeAbonnement') ? 'active' : '' }}"   href="{{route('ListeAbonnement')}}">
                                        <span class="btn_pdf text-center px-4 py-1" type="button">Retour à la liste des factures</span>
                                    </a>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="container-fluid my-2">
                            <div class="row p-2">
                                <div class="col-4">
                                    <img src="{{asset('images/talenta.png')}}" alt="logo_cfp" class="img-fluid">
                                </div>
                                @if ($facture[0]->status_facture == "Non payé")
                                    <div class="status col-4 text-end">
                                        <span>{{$facture[0]->status_facture}}</span>
                                    </div>
                                @else
                                    <div class="payer col-4 text-end">
                                        <span>{{$facture[0]->status_facture}}</span>
                                    </div>
                                @endif

                                <div class="col-4 text-end" align="rigth">
                                    <div class="info_cfp">
                                        <h4 class="m-0 nom_cfp">Talenta</h4>
                                        <p class="m-0 adresse_cfp">contact@formation.mg</p>
                                        <p class="m-0 adresse_cfp">Lot IIN 60 Analamahitsy 101 Antananarivo Madagascar</p>
                                        <p class="m-0 adresse_cfp">+261 34 81 135 63</p>
                                        <p class="m-0 adresse_cfp">www.formation.mg</p><br>

                                        {{-- <p class="m-0 adresse_cfp">NIF : {{$cfp->nif}} &nbsp;&nbsp; - &nbsp;&nbsp; Stat : {{$cfp->stat}} &nbsp;&nbsp; - &nbsp;&nbsp; RCS : {{$cfp->rcs}}  &nbsp;&nbsp; - &nbsp;&nbsp; CIF : {{$cfp->cif}}</p> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="container-fluid my-2">
                            <div class="row">
                                <h5><strong>Facturé à</strong></h5>
                                @if($cfp!=null)
                                    <div class="col-md-4">
                                        <div align="left">
                                            <h4 class="m-0 nom_cfp">{{$cfp->nom}}</h4>
                                            <p class="m-0 adresse_cfp">{{$cfp->email}}</p>
                                            <p class="m-0 adresse_cfp">{{$cfp->adresse_lot." ".$cfp->adresse_quartier}}</p>
                                            <p class="m-0 adresse_cfp">{{$cfp->adresse_ville." ".$cfp->adresse_code_postal}}</p>
                                            <p class="m-0 adresse_cfp">{{$cfp->adresse_region}}</p>
                                            <p class="m-0 adresse_cfp">{{$cfp->telephone}}</p>
                                            <p class="m-0 adresse_cfp">{{$cfp->site_web}}</p><br>

                                            <p class="m-0 adresse_cfp">NIF : {{$cfp->nif}} &nbsp;&nbsp; - &nbsp;&nbsp; Stat : {{$cfp->stat}} &nbsp;&nbsp; - &nbsp;&nbsp; RCS : {{$cfp->rcs}}  &nbsp;&nbsp; - &nbsp;&nbsp; CIF : {{$cfp->cif}}</p>
                                        </div>
                                    </div>
                                @endif
                                @if($entreprises!=null)
                                    <div class="col-md-4">
                                        <div align="left">
                                            <h4 class="m-0 nom_cfp">{{$entreprises->nom_etp}}</h4>
                                            <p class="m-0 adresse_cfp">{{$entreprises->email_etp}}</p>
                                            <p class="m-0 adresse_cfp">{{$entreprises->adresse_rue." ".$entreprises->adresse_quartier}}</p>
                                            <p class="m-0 adresse_cfp">{{$entreprises->adresse_ville." ".$entreprises->adresse_code_postal}}</p>
                                            <p class="m-0 adresse_cfp">{{$entreprises->adresse_region}}</p>
                                            <p class="m-0 adresse_cfp">{{$entreprises->telephone_etp}}</p>
                                            <p class="m-0 adresse_cfp">{{$entreprises->site_etp}}</p><br>

                                            <p class="m-0 adresse_cfp">NIF : {{$entreprises->nif}} &nbsp;&nbsp; - &nbsp;&nbsp; Stat : {{$entreprises->stat}} &nbsp;&nbsp; - &nbsp;&nbsp; RCS : {{$entreprises->rcs}}  &nbsp;&nbsp; - &nbsp;&nbsp; CIF : {{$entreprises->cif}}</p>
                                        </div>
                                    </div>
                                @endif


                                <div class="col-md-3"></div>
                                <div class="col-md-5">
                                    <div align="right" class="me-1">
                                        <h5>Facture N°: {{$facture[0]->num_facture}}</h5>
                                        <h6>Date de facturation: {{$facture[0]->invoice_date}}</h6>
                                        <h6>Date d'échéance: {{$facture[0]->due_date}}</h6>
                                        <h6>Mode de paiement:
                                        <select class="form-control col-2" name="" id="">
                                            @foreach ($mode_paiements as $paiement)
                                                <option value="">{{$paiement->description}}</option>
                                            @endforeach
                                        </select>
                                        </h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <hr>


                        <div class="container-fluid my-4">

                            <div class="row">
                                <table class="table ">
                                    <thead class="table-success">
                                        <tr>
                                            <th scope="col">Type d'abonnement</th>
                                            <th>Catégorie</th>
                                            <th> Montant HT</th>
                                            <th> TVA (20%) </th>
                                            <th> Net à payer TTC </th>
                                        </tr>
                                    </thead>
                                    <tbody class="mb-1">
                                        <tr>
                                            <td>{{$facture[0]->nom_type}}</td>
                                            <td>{{$facture[0]->categorie}}</td>
                                            <td>{{number_format($facture[0]->montant_facture, 0, ',', '.')}} Ar</td>
                                            <td>{{number_format($tva,0,',','.')}} Ar</td>
                                            <td>{{number_format($net_ttc,0,',','.')}} Ar</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                            </div>
                        </div>
                    </div>

                    <p>Arretée la présente facture à la somme de:<strong> {{$lettre_montant}} Ariary</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
