@extends('./layouts.admin')
@section('content')
<style>
    .gradient-custom {
        background: #f4f5f7;
        background: -webkit-linear-gradient(to right bottom, rgba(194, 71, 145, 1), rgba(42, 117, 232 ,1));
        background: linear-gradient(to right bottom, rgba(194, 71, 145, 1), rgba(42, 117, 232 , 1));
        border-top-left-radius: .5rem; 
        border-bottom-left-radius: .5rem;
    }
    .boutonretour{
        background: #f4f5f7;
        background: -webkit-linear-gradient(to right bottom, rgba(232, 42, 148 , 1), rgba(42, 117, 232  ,1));
        background: linear-gradient(to right bottom, rgba(232, 42, 148 , 1), rgba(42, 117, 232 , 1));
    }
</style>
<section class="vh-100 " style="background-color: #f4f5f7;">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col col-lg-10 my-2 mb-4 mb-lg-0">
                <div class="card mb-3 shadow" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4  text-center gradient-custom text-white little-profile">
                            @if($formateur->photos==null)
                                <span>
                                <div style="display: grid; place-content: center" class="form_photo">
                                    <div class='randomColor ' style="color:white; font-size: 100px; border: none; border-radius: 100%; height:200px; width:200px ; display: grid; place-content: center">{{$initial_formateur[0]->nm}}{{$initial_formateur[0]->pr}}</div>
                                </div>
                                </span>
                            @else
                            <img src="{{asset('images/formateurs/'.$formateur->photos)}}" class="image-ronde form_photo my-4" style=" border: none; border-radius: 100%; height:200px; width:200px ;"/>
                            @endif
                            
                            <h5 class="my-1 fw-bold">{{$formateur->nom_formateur}} {{$formateur->prenom_formateur}}</h5>
                            <p class="fw-bold my-2">{{$formateur->specialite}}</p>
                        </div>
                        <div class="col-md-8">
                        <div class="card-body pt-4">
                            <h6 class="fw-bold pt-2 inform"><i class="fa-solid fa-user-pen "></i> &nbsp;INFORMATIONS PERSONNELLES</h5>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1 mx-3">
                                <div class="col-6 mb-3 ">
                                    <h6><i class="fa-solid fa-envelope"></i>  &nbsp;Email</h6>
                                    <p class="text-muted mx-4">{{$formateur->mail_formateur}}</p>
                                    <h6 ><i class="fa-solid fa-cake-candles"></i> &nbsp;Né le </h6>
                                    <p class="text-muted mx-4">{{date('j \\ F Y', strtotime($formateur->date_naissance))}}</p>
                                </div>
                                
                                <div class="col-6 mb-3 ">
                                    <h6><i class="fa-solid fa-phone"></i> &nbsp;Téléphone</h6>
                                    <p class="text-muted mx-4">{{$formateur->numero_formateur}}</p>
                                    <h6><i class="fa-solid fa-address-card"></i> &nbsp;Adresse</h6>
                                    <p class="text-muted mx-4">{{$formateur->adresse}}</p>
                                </div>
                            </div>
                            <h6 class="fw-bold inform" ><i class="fa-solid fa-user-tag"></i> &nbsp;INFORMATIONS PROFESSIONNELLES</h6>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1 mx-3">
                                <div class="col-6 mb-3 ">
                                    <h6><i class="fa fa-briefcase"></i> &nbsp;Poste</h6>
                                    <p class="text-muted mx-4">{{$formateur->specialite}}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    <h6><i class="fas fa-graduation-cap"></i> &nbsp;Niveau d'étude</h6>  
                                    <p class="text-muted mx-4">{{ $formateur->niveau }}</p>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection