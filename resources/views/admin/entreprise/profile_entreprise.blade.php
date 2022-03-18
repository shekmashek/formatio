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
                                    <div class="m-b-25"> <img src="/dynamic-image/{{$entreprise->logo}}" width="25%" height="25%" class="img-radius">

                                    </div>
                                    <h6 class="f-w-600">{{$entreprise->nom_etp}}</h6>
                                    {{-- <p>{{$var->fonction_chef}}</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i> --}}
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information personnelle</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-envelope"></i>&nbsp;E-mail</p>
                                            <h6 class="text-muted f-w-400">{{$entreprise->email_etp}}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-book"></i>&nbsp;NIF</p>
                                            <h6 class="text-muted f-w-400">{{$entreprise->nif}}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-phone"></i>&nbsp;Téléphone</p>
                                            <h6 class="text-muted f-w-400">{{$entreprise->telephone_etp}}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-book"></i>&nbsp;STAT</p>
                                            <h6 class="text-muted f-w-400">{{$entreprise->stat}}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-home"></i>&nbsp;Adresse</p>
                                            <h6 class="text-muted f-w-400">{{$entreprise->adresse_rue}} {{$entreprise->adresse_quartier}} {{$entreprise->adresse_code_postal}} {{$entreprise->adresse_ville}} {{$entreprise->adresse_region}}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-book"></i>&nbsp;RCS</p>
                                            <h6 class="text-muted f-w-400">{{$entreprise->rcs}}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="fa fa-globe"></i>&nbsp;Site web</p>
                                            <h6 class="text-muted f-w-400"><a href="{{$entreprise->site_etp}}" target="_blank">{{$entreprise->site_etp}}</a></h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-book"></i>&nbsp;CIF</p>
                                            <h6 class="text-muted f-w-400">{{$entreprise->cif}}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-briefcase"></i>&nbsp;Secteur d'activité</p>
                                            <h6 class="text-muted f-w-400">{{$entreprise->secteur->nom_secteur}}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-briefcase"></i>&nbsp;Départements</p>
                                            @for($i = 0;$i<count($departement);$i++)
                                                <h6 class="text-muted f-w-400">{{$departement[$i]->nom_departement}}</h6>
                                            @endfor
                                        </div>
                                    </div>
                                    <ul class="social-link list-unstyled m-t-40 m-b-10">
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook" data-abc="true"><i class="mdi mdi-facebook feather icon-facebook facebook" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter" data-abc="true"><i class="mdi mdi-twitter feather icon-twitter twitter" aria-hidden="true"></i></a></li>
                                        <li><a href="#!" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram" data-abc="true"><i class="mdi mdi-instagram feather icon-instagram instagram" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
