@extends('layouts.admin')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Abonnement</title>
    <link rel="stylesheet" href="{{ asset('bootstrapCss/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{asset('assets/css/abonnement.css')}}">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg w-100">
                <div class="row w-100 g-0 m-0">
                    <div class="col-lg-12">
                        <div class="row g-0 m-0" style="align-items: center">
                            <div class="col-12 d-flex justify-content-between" style="align-items: center">
                                <div class="col" align="right">
                                    {{-- <a class="mb-2 new_list_nouvelle {{ Route::currentRouteNamed('ListeAbonnement') ? 'active' : '' }}"   href="{{route('ListeAbonnement')}}">
                                        <span class="btn_enregistrer text-center">Retour - Liste des factures</span>
                                    </a> --}}
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="abonnement">
                <div class="row mt-5">
                    <div class="col">
                        <div class="row align-items-center justify-content-center">
                        </div>
                        @foreach ($typeAbonnement as $types)
                            @foreach ($tarif as $tf)
                                 <div class="col-lg-6 col-md-6 ">
                                    <div class="card d-flex align-items-center justify-content-center">
                                        <div class="ribon"> <span class="bx bxs-star-half"></span> </div>
                                        <p class="h-1 pt-5">{{ $types->nom_type }}</p> <span class="price"> <span class="number"> {{number_format($tf->tarif,0, ',', '.')}}</span> <sup
                                                class="sup">AR</sup>/ mois</span>
                                        <ul class="mb-5 list-unstyled text-muted">
                                            <li><span class="bx bx-check me-2"></span>Test gratuit</li>
                                            <li><span class="bx bx-check me-2"></span>Creation de Compte Pro</li>
                                            <li><span class="bx bx-check me-2"></span>Accès à toutes les Fonctionalités </li>
                                        </ul>
                                        {{-- <div class="btn btn-primary"><a href="{{route('abonnement-page',['id'=>$tf->id])}}" target="_blank">Commencer</a></div> --}}
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>

                    <div class="col-lg-6">
                         <div class="card-title">
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif

                                <h3> Votre Compte actuel: {{$type_abonnement}}</h3>

                            </div>
                            <form action="{{route('enregistrer_abonnement')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    @if($entreprise!=null)
                                        @foreach ($entreprise as $etp)
                                            <div class="col-md-5">
                                                <label for="">Nom</label>
                                                <input type="text" class="form-control" value="{{$etp->nom_etp}}" readonly><br>

                                                <label for="">Adresse de facturation</label>
                                                <input type="text" class="form-control" value = "{{$etp->adresse_lot}} {{$etp->adresse_quartier}} {{$etp->adresse_ville}} {{$etp->adresse_region}} {{$etp->adresse_code_postal}} " readonly><br>

                                                <label for="">Email</label>
                                                <input type="text" class="form-control" value = "{{$etp->email_etp}}" readonly><br>

                                                <label for="">Telephone</label>
                                                <input type="text" class="form-control" value = "{{$etp->telephone_etp}}" readonly><br>
                                            </div>

                                            <div class="col-md-5">
                                                <label for="">Compte actuel</label>
                                                @if($nb == 0)
                                                    <input type="text" class="form-control" value = "Gratuit" readonly><br>
                                                @endif

                                                <label for="">Referent</label>
                                                <input type="text" class="form-control" value = "{{$etp->nom_resp}} {{$etp->prenom_resp}}" readonly><br>

                                            </div>
                                        @endforeach
                                    @endif
                                    @if($cfps!=null)
                                        @foreach ($cfps as $cfp)

                                            <div class="col-md-5">
                                                <label for="">Nom</label>
                                                <input type="text" class="form-control" value="{{$cfp->nom}}" readonly><br>

                                                <label for="">Adresse de facturation</label>
                                                <input type="text" class="form-control" value = "{{$cfp->adresse_lot}} {{$cfp->adresse_ville}} {{$cfp->adresse_region}}" readonly><br>
                                            </div>
                                            <div class="col-md-5">
                                                <label for="">E-mail</label>
                                                <input type="text" class="form-control" value = "{{$cfp->email}}" readonly><br>

                                                <label for="">Téléphone</label>
                                                <input type="text" class="form-control" value = "{{$cfp->telephone}}" readonly><br>
                                            </div>

                                            {{-- <div class="col-md-5">
                                                <label for="">Compte actuel</label>
                                                @if($nb == 0)
                                                    <input type="text" class="form-control" value = "Gratuit" readonly><br>
                                                @endif
                                            </div> --}}
                                        @endforeach
                                    @endif


                                    <div class="col-md-1"></div>
                                </div>

                                <div class="d-flex flex-row justify-content-lg-evenly">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            <small class="smalli">En envoyant cette demande d'abonnement, j'accepte les politiques de confidentialités,les Conditions générales d'utilisation,les conditions générales de vente </small>
                                        </label>
                                    </div>
                                </div>
                            <br><br>
                            <div class="col text-center">
                             <button class="btn btn-success" type="submit">Accepter le Changement de tarif</button>
                            </div>
                            <input type="text" value =" {{$type_abonnement_role_id}} " hidden name="type_abonnement_role_id">
                            <input type="text" value="{{$categorie_paiement_id}}" hidden name="catg_id">
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
@endsection
