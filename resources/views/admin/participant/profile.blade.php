@extends('./layouts/admin')
@section('content')
    <style>
       .image-ronde{
  width : 120px; height : 120px;
  border: none;
  -moz-border-radius : 75px;
  -webkit-border-radius : 75px;
  border-radius : 75px;
}
    </style>
     <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="formation-service">
            
                            @foreach ($stagiaires as $stagiaire)

                            
                                    <center>
                                     <div class="m-b-25"> <img src="{{asset('images/stagiaires/'.$stagiaire->photos)}}"  class="image-ronde">
                                    </div>
                                    @can('isStagiaire')
                                    <a href="{{route('edit_participant',$stagiaire->id)}} " class="text-white"><i class=" fa fa-edit"></i> &nbsp;Modifier mon profil</a>
                                @endcan
                                    </center>
                                   <div class="row">
                                       <div class="col-lg-8">
                                        <h6 class="p-2  ">{{$stagiaire->titre}} {{$stagiaire->nom_stagiaire}} {{$stagiaire->prenom_stagiaire}}</h6>
                                        <p class="m-b-10  "><i class="bx bx-calendar-alt"></i>&nbsp;<strong style="color:gray">Date de naissance</strong><br>&nbsp;{{$stagiaire->date_naissance}}</p>
                                       
                                       </div>
                                       <div class="col-lg-4">
                                        <h6 class="p-2 f-w-900 ">{{$stagiaire->fonction_stagiaire}}</h6>
                                        <p class="m-b-10  "><i class="bx bx-id-card"></i>&nbsp;<strong style="color:gray">CIN</strong><br>{{$stagiaire->cin}}</p>
                                       
                                       </div>
                                   </div>
                                    <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                    
                                </div>
                            </div>
                    
                
                    <div class="col-lg-4 col-md-6">
                        <div class="formation-service">
                            <h6 class="m-b-20  ">Informations personnelles</h6>
                            <hr>

                            <p class="m-b-10 "><i class="bx bx-building-house"></i>&nbsp;<strong style="color:gray">Adresse</strong></p>
                            <h6 class="text-muted f-w-400">{{$stagiaire->lot}} &nbsp;{{$stagiaire->quartier}} &nbsp;{{$stagiaire->ville}} &nbsp;{{$stagiaire->code_postal}}&nbsp;{{$stagiaire->region}}</h6>
                            <p class="m-b-10  "><i class="bx bx-phone"></i>&nbsp;<strong style="color:gray">Téléphone</strong></p>
                            <h6 class="text-muted f-w-400 text-white">{{$stagiaire->telephone_stagiaire}}</h6>
                                <p class="m-b-10 "><i class="bx bx-envelope"></i>&nbsp;<strong style="color:gray">E-mail</strong></p>
                                <h6 class="text-muted f-w-400 text-white">{{$stagiaire->mail_stagiaire}}</h6>
                            </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="formation-service">
                            <h6 class="m-b-20  ">Informations professionnelles</h6>
                            <hr>
                            <p class="m-b-10 "><i  class="fa fa-id-card-o"></i>&nbsp;<strong style="color:gray">Matricule</strong></p>
                                <h6 class="text-muted f-w-400">{{$stagiaire->matricule}}</h6>
                                <p class="m-b-10 "><i class="bx bx-building-house"></i>&nbsp;<strong style="color:gray">Entreprise</strong></p>
                                <h6 class="text-muted f-w-400">{{optional(optional($stagiaire)->entreprise)->nom_etp}}</h6>
                                  <p class="m-b-10 "><i  class="bx bxs-graduation"></i>&nbsp;<strong style="color:gray">Niveau d'étude</strong></p>
                                <h6 class="text-muted f-w-400">{{$stagiaire->niveau_etude}}</h6>
                                <p class="m-b-10 "><i class="bx bx-home"></i>&nbsp;<strong style="color:gray">Département</strong></p>
                                <h6 class="text-muted f-w-400">{{optional(optional($stagiaire)->departement)->nom_departement}}</h6>
                                <p class="m-b-10 "><i  class="bx bx bx-home"></i>&nbsp;<strong style="color:gray">Branche</strong></p>
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
