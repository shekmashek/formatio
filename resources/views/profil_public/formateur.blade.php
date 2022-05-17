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
                            @if($formateur->photos==null)
                            <span>
                                <div style="display: grid; place-content: center" class="form_photo">
                                    <div class='randomColor ' style="color:white; font-size: 100px; border: none; border-radius: 100%; height:200px; width:200px ; display: grid; place-content: center">{{$initial_formateur[0]->nm}}{{$initial_formateur[0]->pr}}</div>
                                </div>
                            </span>
                            @else
                            <img src="{{asset('images/formateurs/'.$formateur->photos)}}" class="image-ronde form_photo" style=" border: none; border-radius: 100%; height:200px; width:200px ;">
                            @endif
                        </div>
                        <div class=" bg-light">
                            <div class="row">
                                <h2 class=" text-center ">{{$formateur->nom_formateur}} {{$formateur->prenom_formateur}}</h2>
                                <div class="col-lg-6 col-md-6  detail mt-5">
                                    <span><i class="fa fa-calendar"></i> Né le {{date('j \\ F Y', strtotime($formateur->date_naissance))}}</span><br>
                                    <span><i class="fa fa-envelope"></i> {{$formateur->mail_formateur}}</span><br>
                                    <span><i class="fa fa-phone-square"></i> {{$formateur->numero_formateur}}</span><br>
                                    <span><i class="fa fa-address-book" ></i> {{$formateur->adresse}}</span>
                                </div>
                                <div class="col-lg-6 col-md-6 detail mt-5">
                                    <span><i class="fa fa-briefcase"></i> Poste: {{$formateur->specialite}}</span><br>
                                    <span><i class="fa fa-graduation-cap"></i> Niveau d'étude: {{$formateur->niveau}}</span><br>
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