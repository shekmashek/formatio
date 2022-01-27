@extends('./layouts/admin')
@section('content')
    <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-2 m-r-2">
                            @foreach ($stagiaires as $stagiaire)

                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">

                                     <div class="m-b-25"> <img src="{{asset('images/stagiaires/'.$stagiaire->photos)}}" width="30%" height="30%" class="rounded-circle">

                                    </div>
                                    <h6 class="f-w-600">{{$stagiaire->nom_stagiaire}} {{$stagiaire->prenom_stagiaire}}</h6>
                                    <p>{{$stagiaire->fonction_stagiaire}}</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                    @can('isStagiaire')
                                        <a href="{{route('edit_participant',$stagiaire->id)}}"><i class=" fa fa-edit"></i> &nbsp;Modifier mon profil</a>
                                    @endcan

                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-6">
                                    <h6 class="m-b-20  f-w-600">Informations personnelles</h6>

                                            <hr>
                                            <p class="m-b-10 f-w-600"><i class="bx bx-id-card"></i>&nbsp;CIN</p>
                                            <h6 class="text-muted f-w-400">{{$stagiaire->cin}}</h6>


                                            <p class="m-b-10 f-w-600"><i class="bx bx-calendar-alt"></i>&nbsp;Date de naissance</p>
                                            <h6 class="text-muted f-w-400">{{$stagiaire->date_naissance}}</h6>

                                            <p class="m-b-10 f-w-600"><i class="bx bx-building-house"></i>&nbsp;Adresse</p>
                                            <h6 class="text-muted f-w-400">{{$stagiaire->lot}} &nbsp;{{$stagiaire->quartier}} &nbsp;{{$stagiaire->ville}} &nbsp;{{$stagiaire->code_postal}}&nbsp;{{$stagiaire->region}}</h6>

                                            <p class="m-b-10 f-w-600"><i class="bx bx-envelope"></i>&nbsp;E-mail</p>
                                            <h6 class="text-muted f-w-400">{{$stagiaire->mail_stagiaire}}</h6>


                                            <p class="m-b-10 f-w-600"><i class="bx bx-phone"></i>&nbsp;Téléphone</p>
                                            <h6 class="text-muted f-w-400">{{$stagiaire->telephone_stagiaire}}</h6>
                                        </div>

                                        <div class="col-lg-6">
                                    <h6 class="m-b-20  f-w-600">Informations professionnelles</h6>
                                        <hr>
                                        <p class="m-b-10 f-w-600"><i  class="fa fa-id-card-o"></i>&nbsp;Matricule</p>
                                            <h6 class="text-muted f-w-400">{{$stagiaire->matricule}}</h6>
                                            <p class="m-b-10 f-w-600"><i class="bx bx-building-house"></i>&nbsp;Entreprise</p>
                                            <h6 class="text-muted f-w-400">{{optional(optional($stagiaire)->entreprise)->nom_etp}}</h6>
                                              <p class="m-b-10 f-w-600"><i  class="bx bxs-graduation"></i>&nbsp;Niveau d'étude</p>
                                            <h6 class="text-muted f-w-400">{{$stagiaire->niveau_etude}}</h6>
                                            <p class="m-b-10 f-w-600"><i class="bx bx-home"></i>&nbsp;Département</p>
                                            <h6 class="text-muted f-w-400">{{optional(optional($stagiaire)->departement)->nom_departement}}</h6>
                                            <p class="m-b-10 f-w-600"><i  class="bx bx bx-home"></i>&nbsp;Branche</p>
                                            <h6 class="text-muted f-w-400">{{$stagiaire->lieu_travail}}</h6>
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
