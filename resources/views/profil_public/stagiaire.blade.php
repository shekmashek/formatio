@extends('./layouts.admin')
@section('content')
<style>
    /* .gradient-custom {
        background: #f4f5f7;
        background: -webkit-linear-gradient(to right bottom, rgba(232, 42, 148 , 1), rgba(42, 117, 232 ,1));
        background: linear-gradient(to right bottom, rgba(232, 42, 148 , 1), rgba(42, 117, 232 , 1));
        border-top-left-radius: .5rem; 
        border-bottom-left-radius: .5rem;
    } */
    .boutonretour{
        background: #f4f5f7;
        background: -webkit-linear-gradient(to right bottom, rgba(232, 42, 148 , 1), rgba(42, 117, 232  ,1));
        background: linear-gradient(to right bottom, rgba(232, 42, 148 , 1), rgba(42, 117, 232 , 1));
    }
    .inform{
        color: #9B59AD;
        }
</style>
<section class="vh-100" style="background-color: #f4f5f7;">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center my-5">
            <div class="col col-lg-10 my-2 mb-4 mb-lg-0">
                <div class="card mb-3 shadow" style="border-radius: .5rem;">
                    <div class="row g-0">
                        <div class="col-md-4  text-center  little-profile" style="background-color: #f4f5f7;">
                            @if($stagiaire->photos==null)
                                <span>
                                    <div style="display: grid; place-content: center" class="form_photo my-5 p-2">
                                        <div class='randomColor ' style="color:white; font-size: 80px; border: none; border-radius: 100%; height:150px; width:150px ; display: grid; place-content: center">{{$initial_stagiaire[0]->nm}}{{$initial_stagiaire[0]->pr}}</div>
                                    </div>
                                </span>
                            @else
                            <img src="{{asset('images/stagiaires/'.$stagiaire->photos)}}" alt="Avatar" class="img-fluid my-5 image-ronde form_photo" width="150px" />
                            @endif
                            
                            <h5 class="my-1 fw-bold">{{$stagiaire->nom_stagiaire}} {{$stagiaire->prenom_stagiaire}}</h5>
                            <p class="fw-bold my-2">{{ $branche->nom_branche }}</p>
                        </div>
                        <div class="col-md-8">
                        <div class="card-body pt-4">
                            <h6 class="fw-bold pt-2 inform"><i class="fa-solid fa-user-pen "></i> &nbsp;INFORMATIONS PERSONNELLES</h5>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1 mx-3">
                                <div class="col-6 mb-3 ">
                                    <h6 class="fw-bold"><i class="fa-solid fa-envelope"></i>  &nbsp;Email</h6>
                                    <p class="text-muted mx-4">{{$stagiaire->mail_stagiaire}}</p>
                                    <h6 class="fw-bold"><i class="fa-solid fa-cake-candles"></i> &nbsp;Né le </h6>
                                    <p class="text-muted mx-4">{{date('j \\ F Y', strtotime($stagiaire->date_naissance))}}</p>
                                </div>
                                
                                <div class="col-6 mb-3 ">
                                    <h6  class="fw-bold"><i class="fa-solid fa-phone"></i> &nbsp;Téléphone</h6>
                                    <p class="text-muted mx-4">{{$stagiaire->telephone_stagiaire}}</p>
                                    <h6 class="fw-bold"><i class="fa-solid fa-address-card"></i> &nbsp;Adresse</h6>
                                    <p class="text-muted mx-4">{{$stagiaire->lot}} {{$stagiaire->quartier}} {{$stagiaire->ville}} {{$stagiaire->code_postal}}</p>
                                </div>
                            </div>
                            <h6 class="fw-bold inform" ><i class="fa-solid fa-user-tag"></i> &nbsp;INFORMATIONS PROFESSIONNELLES</h6>
                            <hr class="mt-0 mb-4">
                            <div class="row pt-1 mx-3">
                                <div class="col-6 mb-3 ">
                                    <h6 class="fw-bold"><i class="fa-solid fa-address-book"></i> &nbsp;Matricule</h6>
                                    <p class="text-muted mx-4">{{$stagiaire->matricule}}</p>
                                </div>
                                <div class="col-6 mb-3">
                                    @if($stagiaire->service_id == null)
                                        <h6 class="fw-bold"><i class="fa fa-briefcase"></i> &nbsp;Département</h6>  
                                        <p class="text-muted mx-4">{{ $departement }}</p>
                                        <h6 class="fw-bold"><i class="fa fa-briefcase"></i> &nbsp;Service</h6>
                                        <p class="text-muted mx-4">{{ $service }}</p>
                                  @else
                                        <h6 class="fw-bold"><i class="fa fa-briefcase"></i> &nbsp;Département</h6>  
                                        <p class="text-muted mx-4">{{ $departement->nom_departement }}</p>
                                        <h6 class="fw-bold"><i class="fa fa-briefcase"></i> &nbsp;Service</h6>
                                        <p class="text-muted mx-4">{{ $service->nom_service }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="text-end ">
                                <a href="{{route('employes.liste')}}" class="btn boutonretour text-white"><i class="fa-solid fa-circle-left fa-2xl"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection    
