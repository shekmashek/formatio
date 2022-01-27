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
                                    <div class="m-b-25"> <img src="/formateur-image/{{$formateur->photos}}" width="30%" height="30%" class="rounded-circle">

                                    </div>
                                    <h6 class="f-w-600">{{$formateur->nom_formateur}} {{$formateur->prenom_formateur}} </h6>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-6">
                                        <h6 class="m-b-20  f-w-600">Information personnelle</h6>
                                    <hr>
                                            <p class="m-b-10 f-w-600"><i class="bx bx-id-card"></i>&nbsp;CIN</p>
                                            <h6 class="text-muted f-w-400">{{$formateur->cin}}</h6>
                                            <p class="m-b-10 f-w-600"><i class="bx bx-calendar-alt"></i>&nbsp;Date de naissance</p>
                                            <h6 class="text-muted f-w-400">{{$formateur->date_naissance}}</h6>
                                            <p class="m-b-10 f-w-600"><i class="bx bx-envelope"></i>&nbsp;E-mail</p>
                                            <h6 class="text-muted f-w-400">{{$formateur->mail_formateur}}</h6>
                                            <p class="m-b-10 f-w-600"><i class="bx bx-phone"></i>&nbsp;Téléphone</p>
                                            <h6 class="text-muted f-w-400">{{$formateur->numero_formateur}}</h6>
                                            <p class="m-b-10 f-w-600"><i class="bx bx-building-house"></i>&nbsp;Adresse</p>
                                            <h6 class="text-muted f-w-400">{{$formateur->adresse}}</h6>
                                        </div>
                                        <div class="col-lg-6">
                                        <h6 class="m-b-20  f-w-600">Information professionnelle</h6>
                                    <hr>
                                            <p class="m-b-10 f-w-600"><i class="bx bxs-graduation"></i>&nbsp;Niveau d'Etude</p>
                                            <h6 class="text-muted f-w-400">{{$formateur->niveau}}</h6>
                                            <p class="m-b-10 f-w-600"><i class="bx bxs-graduation"></i>&nbsp;Spécialité</p>
                                            <h6 class="text-muted f-w-400">{{$formateur->specialite}}</h6>
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


<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection
