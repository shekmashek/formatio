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
            color: #637381;
            font-size: 3rem;
            justify-content: end;
        }
        .payer span{
            border: 3px solid green;
            padding: .5rem 1rem;
            border-radius: 10px;
        }

        .pdf_download{
            background-color: #e73827 !important;
            border-radius: 5px;
            padding: 7px;
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
        <div class="row">
            <nav class="navbar navbar-expand-lg w-100">
                <div class="row w-100 g-0 m-0">
                    <div class="col-lg-12">
                        <div class="row g-0 m-0" style="align-items: center">
                            <div class="col-12 d-flex justify-content-between" style="align-items: center">
                                <div class="col" align="right">
                                    <a href="{{route('impression_facture',$facture[0]->facture_id)}}" class="m-0 ps-1 pe-1 pdf_download"><button class="btn"><i class="bx bxs-file-pdf"></i>PDF</button></a>
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
                                    <img src="{{asset('images/upskill.png')}}" alt="logo_cfp" class="img-fluid">
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
                                        <h4 class="m-0 nom_cfp">UpSkill</h4>
                                        <p class="m-0 adresse_cfp">contact-mg@upskill-sarl.com</p>
                                        <p class="m-0 adresse_cfp">Lot IIN 60 Analamahitsy 101 Antananarivo Madagascar</p>
                                        <p class="m-0 adresse_cfp">+261 34 81 135 63</p>
                                        <p class="m-0 adresse_cfp">www.formation.mg</p><br>

                                        <p class="m-0 adresse_cfp">NIF : 5011767848 <br> RCS : 2022B00475 <br> Stat : 62011 11 2022 0 10487 <br> Carte Fiscale : N° 0183506/DGI-J</p>
                                    </div>
                                </div>
                            </div>
                        </div>

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

                                            <p class="m-0 adresse_cfp">NIF : {{$cfp->nif}} <br>RCS : {{$cfp->rcs}}  <br>Stat : {{$cfp->stat}}   <br> CIF : {{$cfp->cif}}</p>
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

                                            <p class="m-0 adresse_cfp">NIF : {{$entreprises->nif}} <br> Stat : {{$entreprises->stat}} <br> RCS : {{$entreprises->rcs}}  <br> CIF : {{$entreprises->cif}}</p>
                                        </div>
                                    </div>
                                @endif


                                <div class="col-md-3"></div>
                                <div class="col-md-5">
                                    <div align="right" class="me-1">
                                        <h5>Facture N°: {{$facture[0]->num_facture}}</h5>
                                        <h6>Date de facturation: {{$facture[0]->invoice_date}}</h6>
                                        <h6>Date d'échéance: {{$facture[0]->due_date}}</h6>
                                        @if ($facture[0]->nom_type != "Gratuit")
                                            <h6>Mode de paiement:
                                                <select class="form-select-lg mb-3" name="" id="paiement">
                                                    <option value="">Choisissez un mode de paiement...</option>
                                                    @foreach ($mode_paiements as $paiement)
                                                        <option value="{{ $paiement->description }}">{{$paiement->description}}</option>
                                                    @endforeach
                                                </select>
                                            </h6>
                                        @endif

                                        <div class="card detail_virement" style="width: 32rem;display: none">
                                            <div class="card-body">
                                                <h5 class="card-title">Paiement par virement</h5>
                                                <p class="card-text">Veuillez remplir les informations vers ce lien</p>
                                                <a href="#" class="btn btn-primary">Virement</a>
                                            </div>
                                        </div>

                                        <div class="card detail_cheque" style="width: 32rem;display: none">
                                            <div class="card-body">
                                                <h5 class="card-title">Paiement par chèque</h5>
                                                <p class="card-text">Veuillez suivre ce lien</p>
                                                <a href="#" class="btn btn-primary">Paiement par chèque</a>
                                            </div>
                                        </div>

                                        <div class="card detail_espece" style="width: 32rem;display: none">
                                            <div class="card-body">
                                                <h5 class="card-title">Paiement par espèce</h5>
                                                <span class="card-text">Veuillez contacter le responsable de UpSkills</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="container-fluid my-4">

                            <div class="row">
                                <table class="table ">
                                    <thead class="table" style="background-color:#acacac ">
                                        <tr>
                                            <th scope="col">Description</th>
                                            <th> Montant </th>
                                        </tr>
                                    </thead>
                                    <tbody class="mb-1">
                                        <tr>
                                            @if($dates_abonnement[0]->date_debut == null)
                                                <td>Abonnement {{$facture[0]->nom_type}} - Mensuel <br> Debut : <span style="color: red" > En attente d'activation </span> <br> Fin: <span style="color: red">En attente d'activation</span>  </td>
                                            @else
                                                <td>Abonnement {{$facture[0]->nom_type}} - Mensuel <br> Debut : {{$dates_abonnement[0]->date_debut}} <br> Fin: {{$dates_abonnement[0]->date_fin}}</td>
                                            @endif
                                            <td>{{number_format($facture[0]->montant_facture, 0, ',', '.')}} Ar</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <p>Arretée la présente facture à la somme de:<strong> {{$lettre_montant}} Ariary</strong></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    /* detail paiement */
    $("#paiement" ).on( "change", function() {
        if($(this).val()=="Virement bancaire"){
            $('.detail_virement').css("display","block");
            $('.detail_cheque').css("display","none");
            $('.detail_espece').css("display","none");
        }
        if($(this).val()=="Chèque"){
            $('.detail_cheque').css("display","block");
            $('.detail_virement').css("display","none");
            $('.detail_espece').css("display","none");
        }
        if($(this).val()=="Espece"){
            $('.detail_espece').css("display","block");
            $('.detail_virement').css("display","none");
            $('.detail_cheque').css("display","none");
        }

    });
</script>

@endsection