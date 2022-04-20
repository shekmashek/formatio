@extends('layouts.admin')
@section('title')
<p class="text_header m-0 mt-1">Abonnement</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/abonnement.css')}}">

<div class="container-fluid">
    <div class="m-4">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <a href="#abonnement" class="nav-link active" data-bs-toggle="tab">Abonnements</a>
            </li>
            <li class="nav-item">
                <a href="#facture" class="nav-link" data-bs-toggle="tab">Factures</a>
            </li>
            <li class="nav-item">
                <a href="#service" class="nav-link" data-bs-toggle="tab">Historique des services</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="abonnement">
                @if (\Session::has('erreur'))
                    <div class="row w-50 text-center mx-auto">
                        <div class="alert alert-danger justify-content-center mt-5">
                            <ul>
                                <li>{!! \Session::get('erreur') !!}</li>
                            </ul>
                        </div>
                    </div>
                @endif
                <div>
                    <p class="h2 text-center mt-3 mb-5">Choisissez Votre Abonnement</p>
                </div>

               <div class="row mt-3">
                    @if($abonnement_actuel == null)
                        <div class="col-lg-4 col-md-6 mt-5">
                            <div class="card d-flex align-items-center justify-content-center">
                                <div class="ribon"> <span class="bx bxs-paint"></span> </div>
                                <p class="h-1 pt-5">DEMO</p> <span class="price"> <span class="number">0</span> <sup
                                        class="sup">AR</sup></span>
                                <ul class="mb-5 list-unstyled text-muted">
                                    <li><span class="bx bx-check me-2"></span>Test gratuit</li>
                                    <li><span class="bx bx-check me-2"></span>Creation de Compte Pro</li>
                                    <li><span class="bx bx-check me-2"></span>Accès aux Fonctionalité démo</li>
                                </ul>
                                <div class="btn btn-primary">Votre offre actuel</div>
                            </div>
                        </div>
                    @endif
                    @foreach ($typeAbonnement as $types)
                        @foreach ($tarif as $tf)
                            @if($tf->type_abonnement_role_id == $types->types_id)
                                <div class="col-lg-4 col-md-6 mt-5">
                                    <div class="card d-flex align-items-center justify-content-center">
                                        <div class="ribon"> <span class="bx bxs-star-half"></span> </div>
                                        <p class="h-1 pt-5">{{ $types->nom_type }}</p> <span class="price"> <span class="number"> {{number_format($tf->tarif,0, ',', '.')}}</span> <sup
                                                class="sup">AR</sup>/ mois</span>
                                        <ul class="mb-5 list-unstyled text-muted">
                                            @if( $types->nom_type == 'TPE')
                                                <li><span class="bx bx-check me-2"></span>0 - 9 employés</li>
                                            @endif
                                            @if( $types->nom_type == 'PME')
                                                <li><span class="bx bx-check me-2"></span>10 - 49 employés</li>
                                            @endif
                                            @if( $types->nom_type == 'EI')
                                                <li><span class="bx bx-check me-2"></span>50 - 249 employés</li>
                                            @endif
                                            @if( $types->nom_type == 'GE')
                                                <li><span class="bx bx-check me-2"></span>250 employés</li>
                                            @endif

                                        </ul>
                                        @if($abonnement_actuel != null)
                                            @if($types->types_abonnement_id == $abonnement_actuel[0]->type_abonnement_id)
                                               <div class="btn btn-primary"><a href="{{route('desactiver_offre',['id'=>$types->types_abonnement_id])}}">Désactiver mon offre</a></div>
                                            @else
                                                <div class="btn btn-primary"><a href="{{route('abonnement-page',['id'=>$tf->id])}}" target="_blank">S'abonner</a></div>
                                            @endif
                                        @else
                                         <div class="btn btn-primary"><a href="{{route('abonnement-page',['id'=>$tf->id])}}" target="_blank">S'abonner</a></div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                    {{-- <div class="col-lg-4 col-md-6 ">
                        <div class="card d-flex align-items-center justify-content-center">
                            <div class="ribon"> <span class="bx bxs-diamond"></span> </div>
                            <p class="h-1 pt-5">{{ $types->nom_type }}</p> <span class="price">
                                @foreach ($tarifAnnuel as $tfAnn)
                                    @if($tfAnn->type_abonnement_role_id == $types->types_id)
                                        <span class="number">{{number_format($tfAnn->tarif, 0, ',', '.')}}</span> <sup class="sup">AR</sup>/ an</span>
                                    @endif
                                @endforeach

                            <ul class="mb-5 list-unstyled text-muted">
                                <li><span class="bx bx-check me-2"></span>0 - 9 employés</li>
                            </ul>
                            <div class="btn btn_primary"><a href="{{route('abonnement-page',['id'=>$tfAnn->id])}}" target="_blank">S'abonner</a></div>
                        </div>
                    </div> --}}
                </div><br><br>
            </div><br>
            <div class="tab-pane fade" id="facture">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Numéro de facture</th>


                        <th scope="col">Type d'abonnement</th>
                        <th scope="col">Montant HT</th>
                        <th scope="col">TVA (20%)</th>
                        <th scope="col">Net à payer TTC</th>
                        <th scope="col">Invoice date</th>
                        <th scope="col">Due date</th>
                        <th scope="col">Statut</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @foreach ($facture as $fact )
                            <tr>
                                <td><a href="{{route('detail_facture_abonnement',$fact->facture_id)}}" style="text-decoration: underline">{{$fact->num_facture}}</a></td>


                                <td>{{$fact->nom_type}}</td>
                                <td>{{number_format($fact->montant_facture, 0, ',', '.')}} Ar</td>
                                <td>{{number_format($tva, 0, ',', '.')}} Ar</td>
                                <td>{{number_format($net_ttc, 0, ',', '.')}} Ar</td>
                                <td>{{$fact->invoice_date}}</td>
                                <td>{{$fact->due_date}}</td>
                                @if($fact->status_facture == "Non payé")
                                    <td><span style="background-color: red;padding:5px;color:white">{{$fact->status_facture}}</span></td>
                                @endif
                            </tr>
                            @php $i += 1; @endphp
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="service">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Date d'inscription</th>
                        <th scope="col">Type d'abonnement</th>
                        <th scope="col">Catégorie</th>
                        <th scope="col">Activité</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                        @foreach ($facture as $fact )
                            <tr>
                                <td>{{$fact->invoice_date}}</td>
                                <td>{{$fact->nom_type}}</td>
                                <td>{{$fact->categorie}}</td>
                                @if($fact->activite == 1)
                                    <td>En cours</td>
                                @else
                                    <td>Terminé</td>
                                @endif
                                <td></td>
                            </tr>

                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection