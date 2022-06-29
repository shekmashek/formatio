@extends('./layouts.admin')
    @section('title')
    <p class="text_header m-0 mt-1">Abonnement</p>
    @endsection
    @section('content')
    <link rel="stylesheet" href="{{asset('assets/css/abonnement.css')}}">
    <style>
        td{
            vertical-align: middle
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
        integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
    <div class="container-fluid">
        {{-- <div class="col-md">
            <div class="">
                <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
            </div>
        </div> --}}
        <div class="m-4" role="tabpanel">
            <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
                <li class="nav-item active">
                    <a href="#service" class="nav-link active" data-toggle="tab"><i class="bi bi-list-task"></i>&nbsp;&nbsp;Historique des services</a>
                </li>
                <li class="nav-item">
                    <a href="#abonnement" class="nav-link " data-toggle="tab"><i class="bi bi-person-plus-fill"></i>&nbsp;&nbsp;Abonnements</a>
                </li>
                <li class="nav-item">
                    <a href="#fact" class="nav-link" data-toggle="tab"><i class="bi bi-receipt"></i>&nbsp;&nbsp;Factures</a>
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

                    {{-- <div>
                        <p class="h2 text-center mt-3 mb-5">Choisissez votre abonnement</p>
                    </div> --}}

                    <div class="col-lg-12 d-flex">
                        @can('isReferent')
                            <?php $i = 0; ?>
                            @foreach ($typeAbonnement as $types_etp)

                                <div class="col mt-5 justify-content-between">
                                    <div class="card ab_{{$i}} d-flex align-items-center justify-content-center">
                                        <p class="h-1 pt-5 nom_type ">{{ $types_etp->nom_type }}</p>
                                        <span class="description mt-2">{{ $types_etp->description }}</span>
                                        <span class="tarif"> <span class="number"> {{number_format($types_etp->tarif,0, ',', '.')}}</span> <sup
                                                class="sup">AR</sup>/ mois</span>

                                        <ul class="mb-5 list-unstyled text-muted">
                                            @if($types_etp->illimite == 1)
                                                <li><span class="bx bx-check me-2"></span>Utilisateurs illimités</li>
                                                <li><span class="bx bx-check me-2"></span>Formateurs illimités</li>
                                                <li><span class="bx bx-check me-2"></span>Employés illimités</li>
                                            @else
                                                <li><span class="bx bx-check me-2"></span>{{$types_etp->nb_utilisateur}} utilisateurs</li>
                                                <li><span class="bx bx-check me-2"></span>{{$types_etp->nb_formateur}} formateurs</li>
                                                <li><span class="bx bx-check me-2"></span>{{$types_etp->min_emp}} - {{$types_etp->max_emp}}  employés</li>
                                            @endif
                                        </ul>
                                        @if($abonnement_actuel != null)
                                            @if($types_etp->id == $abonnement_actuel[0]->type_abonnements_etp_id and $abonnement_actuel[0]->activite == 1)
                                                <div class="btn btn-primary"><a href="{{route('desactiver_offre',['id'=>$types_etp->id])}}">Désactivation immédiat de mon offre</a></div>
                                            @else
                                                <button class="btn btn-primary"><a href="{{route('abonnement-page',$types_etp->id)}}">S'abonner</a></button>
                                            @endif
                                        @elseif($types_etp->id==1)
                                            <button class="btn btn-primary">Votre offre actuelle</button>
                                        @else
                                            <button class="btn btn-primary"><a href="{{route('abonnement-page',$types_etp->id)}}">S'abonner</a></button>
                                        @endif
                                    </div>
                                </div>
                                <?php $i+=1; ?>
                            @endforeach
                        @endcan
                        @can('isCFP')
                            <?php $i = 0; ?>
                            @foreach ($typeAbonnement as $types_of)
                                <div class="col mt-5 justify-content-between">
                                    <div class="card ab_{{$i}} d-flex align-items-center justify-content-center">
                                        <p class="h-1 pt-5 nom_type">{{ $types_of->nom_type }}</p>
                                        <span class="description mt-2">{{ $types_of->description }}</span>
                                        <span class="tarif"> <span class="number"> {{number_format($types_of->tarif,0, ',', '.')}}</span> <sup
                                                class="sup">AR</sup>/ mois</span>

                                        <ul class="mb-5 list-unstyled text-muted">
                                            @if($types_of->illimite == 1)
                                                <li><span class="bx bx-check me-2"></span>Utilisateurs illimités</li>
                                                <li><span class="bx bx-check me-2"></span>Formateurs illimités</li>
                                                <li><span class="bx bx-check me-2"></span>Sessions illimités</li>
                                            @else
                                                <li><span class="bx bx-check me-2"></span>{{$types_of->nb_utilisateur}} utilisateurs</li>
                                                <li><span class="bx bx-check me-2"></span>{{$types_of->nb_formateur}} formateurs</li>
                                                <li><span class="bx bx-check me-2"></span>{{$types_of->nb_projet}} sessions</li>
                                            @endif
                                        </ul>
                                        @if($abonnement_actuel != null)
                                            @if($types_of->id == $abonnement_actuel[0]->type_abonnements_cfp_id and $abonnement_actuel[0]->activite == 1 )
                                                <div class="btn btn-primary"><a href="{{route('desactiver_offre',['id'=>$types_of->id])}}">Désactivation immédiat de mon offre</a></div>
                                            @else
                                                <button class="btn btn-primary"><a href="{{route('abonnement-page',$types_of->id)}}">S'abonner</a></button>
                                            @endif
                                        @elseif($types_of->id==1)
                                            <button class="btn btn-primary">Votre offre actuelle</button>
                                        @else
                                            <button class="btn btn-primary"><a href="{{route('abonnement-page',$types_of->id)}}">S'abonner</a></button>
                                        @endif
                                    </div>
                                </div>
                                <?php $i+=1; ?>
                            @endforeach
                        @endcan
                    </div>
                </div>
                <div class="tab-pane fade show" id="fact">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Facture #</th>
                            <th scope="col">Abonnement</th>
                            <th scope="col">Montant
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
                                    <td>{{$fact->nom_type}}&nbsp,&nbspMensuel</td>
                                    <td>{{number_format($fact->montant_facture, 0, ',', '.')}} Ar</td>
                                    <td> @php echo date("d-m-Y",strtotime($fact->invoice_date)) @endphp</td>
                                    <td> @php echo date("d-m-Y",strtotime($fact->due_date)) @endphp</td>
                                    @if($fact->status_facture == "Non payé")
                                        <td><span style="background-color: red;padding:5px;color:white;border-radius:10px">{{$fact->status_facture}}</span></td>
                                    @else
                                        <td><span style="background-color: green;padding:5px;color:white;border-radius:10px">{{$fact->status_facture}}</span></td>
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
                            <th scope="col">Abonnement</th>
                            <th scope="col">Prochaine facture</th>
                            <th scope="col">Activité</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 0; @endphp
                            @foreach ($facture as $fact )
                                <tr>

                                    <td> @php echo date("d-m-Y",strtotime($fact->invoice_date)) @endphp</td>
                                    <td>{{$fact->nom_type}}&nbsp;, Mensuel, &nbsp; {{number_format($fact->montant_facture, 0, ',', '.')}}Ar</td>
                                    <td> @php echo date("d-m-Y",strtotime($facture_suivant[$i])) @endphp</td>
                                    @if($fact->activite == 1)
                                        <td><span style="background-color: green;padding:5px;color:white;border-radius:10px"> En cours </span></td>
                                    @elseif ($fact->status == "En attente")
                                        <td><span style="background-color: orange;padding:5px;color:white;border-radius:10px"> En attente </span></td>
                                    @else
                                        <td><span style="background-color: red;padding:5px;color:white;border-radius:10px"> Terminé </span></td>
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
                                                        <a class="dropdown-item" href="{{route('arret_immediat_abonnement_entreprise',[$fact->abonnement_id,$fact->entreprise_id])}}"><i class="bx bx-x" style="position: relative; top:0.3rem; font-size:1.3rem; color:red"></i> &nbsp; Arrêter immédiatement</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="{{route('arret_fin_abonnement_entreprise',$fact->abonnement_id)}}"><i class="bx bx-x" style="position: relative; top:0.3rem; font-size:1.3rem; color:red"></i>&nbsp; Arrêter à la fin de l'abonnement</a>
                                                    </li>
                                                @endcan
                                                @can('isCFP')
                                                    <li>
                                                        <a class="dropdown-item" href="{{route('arret_immediat_abonnement_of',[$fact->abonnement_id,$fact->cfp_id])}}"><i class="bx bx-x" style="position: relative; top:0.3rem; font-size:1.3rem; color:red"></i> &nbsp; Arrêter immédiatement</a>
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
                localStorage.setItem('abonnement', lien);
                ($('.nav_list a[href="' + Tabactive + '"]').closest('a')).addClass('active');
                ($('.btn_racourcis a[href="' + Tabactive + '"]').closest('div')).addClass('active');
        });
        let activeTab = localStorage.getItem('abonnement');
        // console.log(activeTab);
        if(activeTab){
            $('#myTab a[href="' + activeTab + '"]').tab('show');
        }

    </script>


@endsection