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
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="abonnement">
                <div>
                    <p class="h2 text-center mt-3 mb-5">Choisissez Votre Abonnement</p>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-4 col-md-6 ">
                        <div class="card d-flex align-items-center justify-content-center">
                            <div class="ribon"> <span class="bx bxs-paint"></span> </div>
                            <p class="h-1 pt-5">DEMO</p> <span class="price"> <span class="number">0</span> <sup
                                    class="sup">AR</sup></span>
                            <ul class="mb-5 list-unstyled text-muted">
                                <li><span class="bx bx-check me-2"></span>Test gratuit</li>
                                <li><span class="bx bx-check me-2"></span>Creation de Compte Pro</li>
                                <li><span class="bx bx-check me-2"></span>Accès aux Fonctionalité démo</li>
                            </ul>
                            <div class="btn btn-primary">Commencer</div>
                        </div>
                    </div>
                    @foreach ($typeAbonnement as $types)
                        @foreach ($tarif as $tf)
                            @if($tf->type_abonnement_role_id == $types->types_id)
                                <div class="col-lg-4 col-md-6 ">
                                    <div class="card d-flex align-items-center justify-content-center">
                                        <div class="ribon"> <span class="bx bxs-star-half"></span> </div>
                                        <p class="h-1 pt-5">{{ $types->nom_type }}</p> <span class="price"> <span class="number"> {{number_format($tf->tarif,0, ',', '.')}}</span> <sup
                                                class="sup">AR</sup>/ mois</span>
                                        <ul class="mb-5 list-unstyled text-muted">
                                            <li><span class="bx bx-check me-2"></span>Test gratuit</li>
                                            <li><span class="bx bx-check me-2"></span>Creation de Compte Pro</li>
                                            <li><span class="bx bx-check me-2"></span>Accès à toutes les Fonctionalités </li>
                                        </ul>
                                        <div class="btn btn-primary"><a href="{{route('abonnement-page',['id'=>$tf->id])}}" target="_blank">Commencer</a></div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endforeach
                    <div class="col-lg-4 col-md-6 ">
                        <div class="card d-flex align-items-center justify-content-center">
                            <div class="ribon"> <span class="bx bxs-diamond"></span> </div>
                            <p class="h-1 pt-5">{{ $types->nom_type }}</p> <span class="price">
                                @foreach ($tarifAnnuel as $tfAnn)
                                    @if($tfAnn->type_abonnement_role_id == $types->types_id)
                                        <span class="number">{{number_format($tfAnn->tarif, 0, ',', '.')}}</span> <sup class="sup">AR</sup>/ an</span>
                                    @endif
                                @endforeach

                            <ul class="mb-5 list-unstyled text-muted">
                                <li><span class="bx bx-check me-2"></span>Test gratuit</li>
                                <li><span class="bx bx-check me-2"></span>Creation de Compte Pro</li>
                                <li><span class="bx bx-check me-2"></span>Accès à toutes les Fonctionalités</li>
                            </ul>
                            <div class="btn btn_primary"><a href="{{route('abonnement-page',['id'=>$tfAnn->id])}}" target="_blank">Commencer</a></div>
                        </div>
                    </div>
                </div><br><br>
            </div><br>
            <div class="tab-pane fade" id="facture">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Numéro de facture</th>
                        @if($mois!=null)
                            <th scope="col">Mois</th>
                        @else
                            <th scope="col">Année</th>
                        @endif

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
                                @if($mois!=null)
                                    <td>{{$mois[$i]}}</td>
                                @else
                                    <td>{{$annee[$i]}}</td>
                                @endif

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
        </div>
    </div>
</div>
{{-- <div class="carHead">
    <h2 class="text-white font text-center mt-5"> Voici notre tarif </h2>
    @isset($payant)
    @foreach ($abn as $abonnements)
    @foreach ($payant as $nom)
    @if($abonnements->id == $nom->type_abonnement_role->type_abonnement_id)
    <h2 class="text-white font text-center mt-5"> Votre offre est {{$abonnements->nom_type}} </h2>
    @endif
    @endforeach
    @endforeach
    @endisset
    @isset($gratuit)
    <h2 class="text-white font text-center mt-5"> Votre offre est {{$gratuit}} </h2>
    @endisset

    <div class="row align-items-center justify-content-center">
        <div class="col-3 py-5">
            <div class="form-control bg-light g-0 d-flex px-1 py-1 btn_ligne btn-outline-none">
                <button class="btn mx-0 form-control btn_month" onclick="month()" value="Mensuel"
                    autofocus>Mensuel</button>&nbsp;
                <button class="btn mx-0 form-control btn_month" onclick="year()" value="Annuel">Annuel</button>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row d-flex flex-row flex-wrap justify-content-evenly">
                @isset($gratuit)
                @foreach($offregratuit as $offre)
                <div class="card_repeat bg-white">
                    <div class="py-3">
                        <button class="btn_premium">
                            <h4>Gratuit</h4>
                        </button>
                        <br>
                        <p>
                        <h1 class="gratuit">0 Ar</h1>
                        </p><br>


                        <p class="th_color"> <i class="fal fa-check"
                                style="font-size: 10px; padding: 4px; font-weight:bold;"></i>&nbsp;&nbsp;
                            {{$offre->limite}} collaborations avec les {{$offre->type_abonne->abonne_name}}</p>

                        <p></p>
                    </div>
                </div>
                @endforeach
                @endisset
                @foreach ($typeAbonnement as $types)
                @foreach ($tarif as $tf)
                @if($tf->type_abonnement_role_id == $types->types_id)

                <div class="card_repeat bg-white">
                    <div class="py-3">

                        <button class="btn_premium">
                            <h4>{{ $types->nom_type }}</h4>
                        </button>
                        <br>
                        <h1><input disabled value=" <?php echo number_format($tf->tarif, 2, ',', '.') ;  ?> Ar"
                                style="text-align:center; border:none; width:300px; background-color:white;"
                                id="prixMensuel"></h1>
                        <p></p>
                        @foreach ($tarifAnnuel as $tfAnn)
                        @if($tfAnn->type_abonnement_role_id == $types->types_id)
                        <h1><input disabled value=" <?php echo number_format($tfAnn->tarif, 2, ',', '.') ;  ?> Ar"
                                style="display:none;text-align:center; border:none; width:300px; background-color:white;"
                                id="prixAnnuel"></h1>
                        <p></p>
                        @endif
                        @endforeach


                        <ul>
                            <p> <i class="fal fa-check"
                                    style="font-size: 10px; padding: 4px; font-weight:bold;"></i>&nbsp;&nbsp;
                                Collaboration illimité </p>
                        </ul>
                        <p></p>
                        <button class="form-control btn_join" id="abonnerMensuel"> <a
                                href="{{route('abonnement-page',['id'=>$tf->id])}}"> S'abonner </a> &nbsp;&nbsp; <i
                                class="fal fa-arrow-right"></i> </button><br>

                        @foreach ($tarifAnnuel as $tfAnn)
                        @if($tfAnn->type_abonnement_role_id == $types->types_id)
                        <button class="form-control btn_join" id="abonnerAnnuel" style="display: none"> <a
                                href="{{route('abonnement-page',['id'=>$tfAnn->id])}}"> S'abonner </a> &nbsp;&nbsp; <i
                                class="fal fa-arrow-right"></i> </button><br>
                        @endif
                        @endforeach


                    </div>
                </div>
                @endif
                @endforeach
                @endforeach


            </div>

        </div>

        <div class="col-md-1"></div>
    </div>
</div> --}}

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    function month()
        {
           document.getElementById('prixMensuel').style.display = "block";
            document.getElementById('abonnerMensuel').style.display = "block";
            document.getElementById('prixAnnuel').style.display = "none";
            document.getElementById('abonnerAnnuel').style.display = "none";

        }
        function year()
        {   document.getElementById('prixMensuel').style.display = "none";
            document.getElementById('abonnerMensuel').style.display = "none";
            document.getElementById('abonnerAnnuel').style.display = "block";
            document.getElementById('prixAnnuel').style.display = "block";
        }
</script>
{{-- <script>
    $(document).on('load',function(load)){
        document.getElementById("mensuel").style.color = 'red';
});

</script> --}}
@endsection