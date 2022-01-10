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
                                    @foreach ($vars  as $var)

                                    <div class="m-b-25"> <img src="{{asset('images/chefDepartement/'.$var->photos)}}" width="25%" height="25%" class="img-radius">

                                    </div>
                                    <h6 class="f-w-600">{{$var->nom_chef}} {{$var->prenom_chef}}</h6>
                                    <p>{{$var->fonction_chef}}</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                    @can('isManager')
                                        <a href="{{route('edit_manager',$var->id)}}"><i class=" fa fa-edit"></i> &nbsp;Modifier mon profil</a>
                                    @endcan

                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Informations personnelles</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-envelope"></i>&nbsp;E-mail</p>
                                            <h6 class="text-muted f-w-400">{{$var->mail_chef}}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-phone"></i>&nbsp;Téléphone</p>
                                            <h6 class="text-muted f-w-400">{{$var->telephone_chef}}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-home"></i>&nbsp;Département</p>
                                            @foreach ($departement as $dep)
                                            <h6 class="text-muted f-w-400">{{$dep->departement->nom_departement}}</h6>
                                            @endforeach

                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-building-house"></i>&nbsp;Entreprise</p>
                                            <h6 class="text-muted f-w-400">{{$var->entreprise->nom_etp}}</h6>
                                        </div>
                                    </div>

                                    <ul class="social-link list-unstyled m-t-40 m-b-10">
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
