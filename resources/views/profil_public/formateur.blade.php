@extends('./layouts.admin')
@section('content')
<style>
    .cadre1{
        border:2px solid black;
        height: 300px;
    }
    .form_photo{
        padding-top: 150px;
    }
    .detail{
        padding-left: 60px;
    }
</style>
<div class="container cadre1">
    <div class="row">
        <div class="col-lg-2 ms-5 mt-5">
            @if($formateur->photos==null)
            <span>
                <div style="display: grid; place-content: center" class="form_photo">
                    <div class='randomColor ' style="color:white; font-size: 100px; border: none; border-radius: 100%; height:200px; width:200px ; display: grid; place-content: center">{{$initial_formateur[0]->nm}}{{$initial_formateur[0]->pr}}</div>
                </div>
            </span>
            @else
            <img src="{{asset('images/formateurs/'.$formateur->photos)}}" class="image-ronde form_photo">
            @endif
        </div>
        <div class="col-lg-8">

        </div>
    </div>
    <div class="row">
        <h1 class="detail">{{$formateur->nom_formateur}} {{$formateur->prenom_formateur}}</h1><br>

        <div class="col-lg-6 detail">
             <h4>Informations personnelles</h4>
            <span><i class="fa fa-calendar"></i> Né le {{date('j \\ F Y', strtotime($formateur->date_naissance))}}</span><br>
            <span><i class="fa fa-envelope"></i> {{$formateur->mail_formateur}}</span><br>
            <span><i class="fa fa-phone-square"></i> {{$formateur->numero_formateur}}</span><br>
            <span><i class="fa fa-address-book" ></i> {{$formateur->adresse}}</span>
        </div>
        <div class="col-lg-6">
            <h4>Informations professionnelles</h4>
            <span><i class="fa fa-briefcase"></i> Poste: {{$formateur->specialite}}</span><br>
            <span><i class="fa fa-graduation-cap"></i> Niveau d'étude: {{$formateur->niveau}}</span><br>
        </div>
    </div>
</div>
@endsection