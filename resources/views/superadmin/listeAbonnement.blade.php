@extends('layouts.admin')
@section('title')
<p class="text_header m-0 mt-1">Abonnement</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/abonnement.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
    integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<div class="container-fluid">
    <div class="m-4" role="tabpanel">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item active">
                <a href="#service" class="nav-link active" data-toggle="tab">Historique des services</a>
            </li>
            <li class="nav-item">
                <a href="#abonnement" class="nav-link " data-toggle="tab">Abonnements</a>
            </li>
            <li class="nav-item">
                <a href="#facture" class="nav-link" data-toggle="tab">Factures</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show" id="abonnement">
                @if (\Session::has('erreur'))
                    <div class="row w-50 text-center mx-auto">
                        <div class="alert alert-danger justify-content-center mt-5">
                            <ul>
                                <li>{!! \Session::get('erreur') !!}</li>
                            </ul>
                        </div>
                    </div>
                @endif
                @if (\Session::has('erreur_abonnement'))
                    <div class="row w-50 text-center mx-auto">
                        <div class="alert alert-danger justify-content-center mt-5">
                            <ul>
                                <li>{!! \Session::get('erreur_abonnement') !!}</li>
                            </ul>
                        </div>
                    </div>
                @endif

                <div>
                    <p class="h2 text-center mt-3 mb-5">Choisissez Votre Abonnement</p>
                </div>

               <div class="row mt-3">
                    <div class="col-lg-12 d-flex">
                        @foreach ($typeAbonnement as $types)
                            @foreach ($tarif as $tf)
                                @if($tf->type_abonnement_role_id == $types->types_id)
                                    <div class="col mt-5 justify-content-between">
                                        <div class="card d-flex align-items-center justify-content-center">
                                            <div class="ribon"> <span class="bx bxs-star-half"></span> </div>
                                            <p class="h-1 pt-5">{{ $types->nom_type }}</p> <span class="price"> <span class="number"> {{number_format($tf->tarif,0, ',', '.')}}</span> <sup
                                                    class="sup">AR</sup>/ mois</span>
                                            <ul class="mb-5 list-unstyled text-muted">
                                                @if( $types->nom_type == 'Gratuit')
                                                    <li><span class="bx bx-check me-2"></span>Essai gratuit pendant 60jours</li>
                                                @endif
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
                                                @if($types->types_abonnement_id == $abonnement_actuel[0]->type_abonnement_id and $abonnement_actuel[0]->activite == 1)
                                                <div class="btn btn-primary"><a href="{{route('desactiver_offre',['id'=>$types->types_abonnement_id])}}">Désactivation immédiat de mon offre</a></div>
                                                @else
                                                    <div class="btn btn-primary"><a href="{{route('abonnement-page',['id'=>$tf->id])}}">S'abonner</a></div>
                                                @endif
                                            @else
                                            <div class="btn btn-primary"><a href="{{route('abonnement-page',['id'=>$tf->id])}}">S'abonner</a></div>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endforeach
                    </div>

                </div><br><br>
            </div><br>
            <div class="tab-pane fade show" id="facture">
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
                        @foreach ($facture as $fact )
                            @if ($fact->nom_type == "Gratuit" && $fact->status_facture == "Non payé"))
                                <th scope="col">Payer la facture</th>
                            @endif
                        @endforeach
                      </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @foreach ($facture as $fact )
                            <tr>
                                <td><a href="{{route('detail_facture_abonnement',$fact->facture_id)}}" style="text-decoration: underline">{{$fact->num_facture}}</a></td>


                                <td>{{$fact->nom_type}}</td>
                                <td>{{number_format($fact->montant_facture, 0, ',', '.')}} Ar</td>
                                {{-- <td>{{number_format($tva[$i], 0, ',', '.')}} Ar</td>
                                <td>{{number_format($net_ttc[$i], 0, ',', '.')}} Ar</td> --}}
                                <td>{{$fact->invoice_date}}</td>
                                <td>{{$fact->due_date}}</td>
                                @if($fact->status_facture == "Non payé")
                                    <td><span style="background-color: red;padding:10px;color:white;border-radius:10px">{{$fact->status_facture}}</span></td>
                                @else
                                    <td><span style="background-color: green;padding:10px;color:white;border-radius:10px">{{$fact->status_facture}}</span></td>
                                @endif
                                @if ($fact->nom_type == "Gratuit" && $fact->status_facture == "Non payé")
                                    <td scope="col"><button class="btn btn-primary"> <a href="{{route('activer_compte_gratuit',$fact->abonnement_id)}}"> Payer </a></button></td>
                                @endif

                            </tr>
                            @php $i += 1; @endphp
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade show active" id="service">
                @if (\Session::has('arret_immediat'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('arret_immediat') !!}</li>
                        </ul>
                    </div>
                @endif
                @if (\Session::has('arret_fin'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('arret_fin') !!}</li>
                        </ul>
                    </div>
                @endif
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Date d'inscription</th>
                        <th scope="col">Type d'abonnement</th>
                        <th scope="col">Prochaine facture</th>
                        <th scope="col">Activité</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @foreach ($facture as $fact )

                            <tr>
                                <td>{{$fact->invoice_date}}</td>

                                <td>{{$fact->nom_type}}&nbsp;,&nbsp;{{$fact->categorie}}&nbsp;,&nbsp; {{number_format($fact->montant_facture, 0, ',', '.')}}Ar</td>
                                <td>{{$facture_suivant[$i]}}</td>
                                @if($fact->activite == 1)
                                    <td><span style="background-color: green;padding:10px;color:white;border-radius:10px"> En cours </span></td>
                                @elseif ($fact->status == "En attente")
                                    <td><span style="background-color: orange;padding:10px;color:white;border-radius:10px"> En attente </span></td>
                                @else
                                    <td><span style="background-color: red;padding:10px;color:white;border-radius:10px"> Terminé </span></td>
                                @endif
                                <td>
                                    <div class="dropdown">
                                        @if($fact->activite == 0)
                                            <button class="btn btn-secondary dropdown-toggle disabled" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                Arrêter le service
                                            </button>
                                        @else
                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Arrêter le service
                                            </button>
                                        @endif
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            @can('isReferent')
                                                <li>
                                                    <a class="dropdown-item" href="{{route('arret_immediat_abonnement_entreprise',$fact->abonnement_id)}}"><i class="bx bx-x" style="position: relative; top:0.3rem; font-size:1.3rem; color:red"></i> &nbsp; Arrêter immédiatement</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{route('arret_fin_abonnement_entreprise',$fact->abonnement_id)}}"><i class="bx bx-x" style="position: relative; top:0.3rem; font-size:1.3rem; color:red"></i>&nbsp; Arrêter à la fin de l'abonnement</a>
                                                </li>
                                            @endcan
                                            @can('isCFP')
                                                <li>
                                                    <a class="dropdown-item" href="{{route('arret_immediat_abonnement_of',$fact->abonnement_id)}}"><i class="bx bx-x" style="position: relative; top:0.3rem; font-size:1.3rem; color:red"></i> &nbsp; Arrêter immédiatement</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="{{route('arret_fin_abonnement_of',$fact->abonnement_id)}}"><i class="bx bx-x" style="position: relative; top:0.3rem; font-size:1.3rem; color:red"></i>&nbsp; Arrêter à la fin de l'abonnement</a>
                                                </li>
                                            @endcan
                                        </ul>
                                      </div>
                                </td>
                            </tr>
                            @php
                                $i+=1;
                            @endphp
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
            let lien = ($(e.target).attr('href'));
            localStorage.setItem('activeTab', lien);
        });
        let activeTab = localStorage.getItem('activeTab');
        if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }
</script>


@endsection