@extends('./layouts/admin')
@section('content')
            <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-2 m-r-2">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25"> <img src="/responsable-image/{{$ref->photos}}" width="30%" height="30%" class="rounded-circle">

                                    </div>
                                    <h6 class="f-w-600">{{$ref->nom_resp}} {{$ref->prenom_resp}} </h6>
                                    <h6 class="text-muted f-w-400">{{$ref->fonction_resp}}</h6>
                                    @can('isReferent')
                                            <a href="{{route('edit_responsable',$ref->id)}}"><i class=" fa fa-edit"></i> &nbsp;Modifier mon profil</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">

                                    <div class="row">
                                      <div class="col-lg-6">
                                         <h6 class="m-b-20 p-b-5  f-w-600">Informations personnelles</h6>
                                            <hr>
                                           <p class="m-b-10 f-w-600"><i class="bx bx-id-card"></i>&nbsp;CIN</p>
                                            <h6 class="text-muted f-w-400">{{$ref->cin_resp}}</h6>


                                       <p class="m-b-10 f-w-600"><i class="bx bx-phone"></i>&nbsp;Téléphone</p>
                                            <h6 class="text-muted f-w-400">{{$ref->telephone_resp}}</h6>



                                            <p class="m-b-10 f-w-600"><i class="bx bx-envelope"></i>&nbsp;E-mail </p>
                                            <h6 class="text-muted f-w-400">{{$ref->email_resp}}</h6>

                                     </div>
                                        <div class="col-lg-6">
                                            <h6 class="m-b-20 p-b-5  f-w-600">Informations professionnelles</h6>
                                            <hr>

                                            <p class="m-b-10 f-w-600"><i class="bx bx-building-house"></i>&nbsp;Entreprise</p>

                                            <h6 class="text-muted f-w-400">{{$ref->entreprise->nom_etp}}</h6>



                                        </div>



                </div>
            </div>
        </div>
    </div>

@endsection
