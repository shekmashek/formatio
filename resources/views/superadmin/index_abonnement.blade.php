@extends('layouts.admin')
@section('title')
<p class="text_header m-0 mt-1">Abonnement</p>
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('bootstrapCss/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link rel="stylesheet" href="{{asset('assets/css/abonnement.css')}}">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2">
                <div class="col mt-5 justify-content-between">
                    <div class="card d-flex align-items-center justify-content-center">
                        <p class="h-1 pt-5 nom_type mt-5">{{ $typeAbonnement->nom_type }}</p>
                        <span class="description mt-5">{{ $typeAbonnement->description }}</span>
                        <span class="tarif"> <span class="number"> {{number_format($typeAbonnement->tarif,0, ',', '.')}}</span> <sup
                                class="sup">AR</sup>/ mois</span>

                        <ul class="mb-5 list-unstyled text-muted">
                            @if($typeAbonnement->illimite == 1)
                                <li><span class="bx bx-check me-2"></span>Utilisateurs illimités</li>
                                <li><span class="bx bx-check me-2"></span>Formateurs illimités</li>
                                @can('isReferent')
                                    <li><span class="bx bx-check me-2"></span>Employés illimités</li>
                                @endcan
                                @can('isCFP')
                                    <li><span class="bx bx-check me-2"></span>Projets illimités</li>
                                @endcan
                            @else
                                <li><span class="bx bx-check me-2"></span>{{$typeAbonnement->nb_utilisateur}} utilisateurs</li>
                                <li><span class="bx bx-check me-2"></span>{{$typeAbonnement->nb_formateur}} formateurs</li>
                                @can('isReferent')
                                    <li><span class="bx bx-check me-2"></span>{{$typeAbonnement->min_emp}} - {{$typeAbonnement->max_emp}}  employés</li>
                                @endcan
                                @can('isCFP')
                                    <li><span class="bx bx-check me-2"></span>{{$typeAbonnement->nb_projet}} projets</li>
                                @endcan
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                <div class="shadow p-5 mb-5 mx-auto bg-body w-50 mt-5" style="border-radius: 15px">
                    <h3> Votre Compte actuel: {{$type_abonnement}}</h3>

                    <form action="{{route('enregistrer_abonnement')}}" method="POST">
                        @csrf
                        @if($entreprise!=null)
                            @foreach ($entreprise as $etp)
                            <div class="row">
                                <div class="col-12">
                                    <div class="row px-3">
                                        <div class="form-group">
                                            <label for="nom" class="" align="left">Nom<strong style="color:#ff0000;"></strong></label>
                                            <input type="text" autocomplete="off"  name="nom_type" class="form-control input" id="nom_type" readonly  value="{{$etp->nom_etp}}">
                                            @error('nom')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row px-3">
                                        <div class="form-group">
                                            <label for="adresse" class="" align="left">Adresse de facturation<strong style="color:#ff0000;"></strong></label>
                                            <input type="text" autocomplete="off"  name="nom_type" class="form-control input" id="nom_type" readonly value = "{{$etp->adresse_lot}} {{$etp->adresse_quartier}} {{$etp->adresse_ville}} {{$etp->adresse_region}} {{$etp->adresse_code_postal}} ">
                                            @error('nom')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row px-3">
                                        <div class="form-group">
                                            <label for="adresse" class="" align="left">E-mail<strong style="color:#ff0000;"></strong></label>
                                            <input type="text" autocomplete="off"  name="nom_type" class="form-control input" id="nom_type" readonly value = "{{$etp->email_etp}}">
                                            @error('nom')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row px-3">
                                        <div class="form-group">
                                            <label for="adresse" class="" align="left">Telephone<strong style="color:#ff0000;"></strong></label>
                                            <input type="text" autocomplete="off"  name="nom_type" class="form-control input" id="nom_type" readonly  value = "{{$etp->telephone_etp}}">
                                            @error('nom')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row px-3">
                                        <div class="form-group">
                                            <label for="adresse" class="" align="left">Référent<strong style="color:#ff0000;"></strong></label>
                                            <input type="text" autocomplete="off"  name="nom_type" class="form-control input" id="nom_type" readonly value = "{{$etp->nom_resp}} {{$etp->prenom_resp}}" >
                                            @error('nom')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                        @if($cfps!=null)
                            @foreach ($cfps as $cfp)
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row px-3">
                                            <div class="form-group">
                                                <label for="nom" class="" align="left">Nom<strong style="color:#ff0000;"></strong></label>
                                                <input type="text" autocomplete="off"  name="nom_type" class="form-control input" id="nom_type" readonly  value="{{$cfp->nom}}">
                                                @error('nom')
                                                <div class="col-sm-6">
                                                    <span style="color:#ff0000;"> {{$message}} </span>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row px-3">
                                            <div class="form-group">
                                                <label for="adresse" class="" align="left">Adresse de facturation<strong style="color:#ff0000;"></strong></label>
                                                <input type="text" autocomplete="off"  name="nom_type" class="form-control input" id="nom_type" readonly value = "{{$cfp->adresse_lot}} {{$cfp->adresse_ville}} {{$cfp->adresse_region}}  ">
                                                @error('nom')
                                                <div class="col-sm-6">
                                                    <span style="color:#ff0000;"> {{$message}} </span>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row px-3">
                                            <div class="form-group">
                                                <label for="adresse" class="" align="left">E-mail<strong style="color:#ff0000;"></strong></label>
                                                <input type="text" autocomplete="off"  name="nom_type" class="form-control input" id="nom_type" readonly value = "{{$cfp->email}}">
                                                @error('nom')
                                                <div class="col-sm-6">
                                                    <span style="color:#ff0000;"> {{$message}} </span>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <div class="row px-3">
                                            <div class="form-group">
                                                <label for="adresse" class="" align="left">Telephone<strong style="color:#ff0000;"></strong></label>
                                                <input type="text" autocomplete="off"  name="nom_type" class="form-control input" id="nom_type" readonly  value = "{{$cfp->telephone}}">
                                                @error('nom')
                                                <div class="col-sm-6">
                                                    <span style="color:#ff0000;"> {{$message}} </span>
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif


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
                        <input type="text" value ="{{$typeAbonnement->id}} " hidden name="type_abonnement_role_id">
                    </form>
                </div>
           </div>
        </div>
    </div>
@endsection