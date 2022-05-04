@extends('./layouts.admin')
@section('content')
<style>

    .form_photo{
        padding-top: 100px;
    }
    .detail{
        padding-left: 60px;
    }
</style>
<div class="container mt-5">
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-lg-6 col-xlg-6">
                    <div class="card" style="border-radius: 2%">
                        <div class="card-body little-profile text-center">
                            @if($stagiaire->photos==null)
                            <span>
                                <div style="display: grid; place-content: center" class="form_photo">
                                    <div class='randomColor ' style="color:white; font-size: 100px; border: none; border-radius: 100%; height:200px; width:200px ; display: grid; place-content: center">{{$initial_stagiaire[0]->nm}}{{$initial_stagiaire[0]->pr}}</div>
                                </div>
                            </span>
                            @else
                            <img src="{{asset('images/stagiaires/'.$stagiaire->photos)}}" class="image-ronde form_photo">
                            @endif
                        </div>
                        <div class=" bg-light">
                            <div class="row">
                                <div class="col-lg-6 col-md-6  detail">
                                    <h4>Informations personnelles</h4>
                                    <span><i class="fa fa-calendar"></i> Né le {{date('j \\ F Y', strtotime($stagiaire->date_naissance))}}</span><br>
                                    <span><i class="fa fa-envelope"></i> {{$stagiaire->mail_stagiaire}}</span><br>
                                    <span><i class="fa fa-phone-square"></i> {{$stagiaire->telephone_stagiaire}}</span><br>
                                    <span><i class="fa fa-address-book" ></i> {{$stagiaire->lot}} {{$stagiaire->quartier}} {{$stagiaire->ville}} {{$stagiaire->code_postal}}</span>
                                </div>
                                <div class="col-lg-6 col-md-6  detail">
                                    <h4>Informations professionnelles</h4>
                                    <span><i class="fa fa-id-card"></i> Matricule : {{$stagiaire->matricule}}</span><br>
                                    <span><i class="fa fa-briefcase"></i> Département:  {{ $departement->nom_departement }}</span><br>
                                    <span><i class="fa fa-briefcase"></i> Service:  {{ $service->nom_service }}</span><br>
                                    <span><i class="fa fa-briefcase"></i> Branche:  {{ $branche->nom_branche }}</span><br>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection