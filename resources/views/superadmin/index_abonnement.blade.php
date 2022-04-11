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

</head>
@include('Views.superadmin.index-css')
<body>

    {{-- <div class="abonnement_header">

        <div class="row" style="color: white;">
            <div class="col-md-4 text-center"><img class="img-fluid rounded-3" style="width: 150px; height:80px;" src="{{ asset('logo/logo_white_background.jpg') }}" alt=""></div>
            <div class="col-md-4">
                <div class="bar">
                      <p> Pages  </p>
                       <p> Authentification </p>
                        <p>Application  </p>
                        <p>e-commerce  </p>
                </div>
            </div>
            <div class="col-md-4 text-center"><button class="buy_now"> Page d'accueil </button></div>
        </div>
    </div> --}}


    <div class="row mt-5">
        <div class="col-md-5">
            <div class="row align-items-center justify-content-center">
                <div class="col-6 pt-5">


                </div>
            </div>
            <center>
            @foreach ($typeAbonnement  as $tp)
                @foreach($tarif as $tf)

                    <div class="card_repeat bg-light">
                        <div class="py-3">

                            <button class="btn_premium">
                                <img src="{{asset('images/abonnement/'.$tp->type_abonnement['logo'])}}" style="width: 80px">
                            </button><p><h1>@php
                                echo number_format($tf->tarif, 2, ',', '.');
                             @endphp Ar  </h1></p><br>

                            <ul>
                                <p> <i class="fal fa-check" style="font-size: 10px; padding: 4px; font-weight:bold;"></i>&nbsp;&nbsp; Collaboration illimité </p>
                            </ul>
                            <p></p>

                        </div>
                    </div>

                @endforeach
            @endforeach
    </center>

        </div>

        <div class="col-md-7 pt-5 px-5 ms-auto">
            <div class="card py-3">
                <div class="card-title">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                  <center>
                    <h3> Votre Compte actuel</h3>
                  </center>
                </div>
                <form action="{{route('enregistrer_abonnement')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-1"></div>
                        @if($entreprise!=null)
                            @foreach ($entreprise as $etp)
                                <div class="col-md-5">
                                    <label for="">Nom</label>
                                    <input type="text" class="form-control" value="{{$etp->entreprise->nom_etp}}" readonly><br>

                                    <label for="">Adresse de facturation</label>
                                    <input type="text" class="form-control" value = "{{$etp->entreprise->adresse}}" readonly><br>

                                    <label for="">Email</label>
                                    <input type="text" class="form-control" value = "{{$etp->entreprise->email_etp}}" readonly><br>

                                    <label for="">Telephone</label>
                                    <input type="text" class="form-control" value = "{{$etp->entreprise->telephone_etp}}" readonly><br>
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

                                    <label for="">Email</label>
                                    <input type="text" class="form-control" value = "{{$cfp->email}}" readonly><br>

                                    <label for="">Telephone</label>
                                    <input type="text" class="form-control" value = "{{$cfp->telephone}}" readonly><br>
                                </div>

                                <div class="col-md-5">
                                    <label for="">Compte actuel</label>
                                    @if($nb == 0)
                                        <input type="text" class="form-control" value = "Gratuit" readonly><br>
                                    @endif



                                </div>
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
                        {{-- <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                <small class="smalli">Conditions générales d'utilisation</small>
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                <small class="smalli">Conditions générales de vente</small>
                            </label>
                        </div> --}}
                    </div>
                <br><br>
                <center><button class="btn btn-success  " type="submit">Accepter le Changement de tarif</button></center>
                <input type="text" value =" {{$type_abonnement_role_id}} " hidden name="type_abonnement_role_id">
                <input type="text" value="{{$categorie_paiement_id}}" hidden name="catg_id">
            </form>
            </div>
        </div>
    </div>
</body>
</html>
@endsection
