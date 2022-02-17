@extends('./layouts/admin')
@section('content')
<style>
    .image-ronde{
width : 30px; height : 30px;
border: none;
-moz-border-radius : 75px;
-webkit-border-radius : 75px;
border-radius : 75px;
}
.:{
 background-color: rgb(233, 220, 220);
 cursor: pointer;
}
 </style>
  <div class="row">
      
                     <div class="row mt-2">
                        @foreach ($vars  as $var)
                         <div class="col-lg-4">
                            
                             <div class="form-control">
                                 <p class="text-center">Informations générales</p>
                         
                                 <div class="d-flex align-items-center justify-content-between " style="border-bottom: solid 1px #d399c2;">
                                 <p class="p-1 m-0" style="font-size: 10px;">Photos
                                 </p>
                                 {{-- <a href="{{route('edit_logochef',$var->id)}} " > --}}
                                    <img src="{{asset('images/chefDepartement/'.$var->photos)}}"  class="image-ronde">
                             </a>
                                 
                                </div>
                                <div class="" style="border-bottom: solid 1px #d399c2;">
                                 {{-- <a href="{{route('edit_nomchef',$var->id)}}" > --}}
                                 <p class="p-1 m-0" style="font-size: 10px;">NOM<span style="float: right;">{{$var->nom_chef}} {{$var->prenom_chef}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                     
                                 </p></a>
                                 
                                </div>
                          
                              
                              
                               
                                 <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                             </div>
                         </div>
                     

                             <div class="col-lg-4">
                            
                                 <div class="form-control">
                                     <p class="text-center">Coordonnées</p>
                             
                                     <div style="border-bottom: solid 1px #d399c2;" class="">
                                        {{-- <a href="{{route('edit_mailchef',$var->id)}}" > --}}
                                    <p class="p-1 m-0" style="font-size: 10px;">ADRESSE E-MAIL<span style="float: right;">{{$var->mail_chef}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                        
                                    </p>
                                        </a>
                                    </div>
                                     <div style="border-bottom: solid 1px #d399c2;" class="">
                                         {{-- <a href="{{route('edit_phonechef',$var->id)}}" > --}}
                                     <p class="p-1 m-0" style="font-size: 10px;">TELEPHONE<span style="float: right;">{{$var->telephone_chef}}&nbsp;<i class="fas fa-angle-right"></i> </span>
                                         
                                     </p>
                                         </a>
                                     </div>
                      
                                     
                                     <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                                 </div>
                         </div>
                         <div class="col-lg-4">
                            
                             <div class="form-control">
                                 <p class="text-center">Informations professionnelles</p>
                         
                  
                                 {{-- <div style="border-bottom: solid 1px #d399c2;" class="">
                                    
                                     {{-- <a href="{{route('edit_departementchef',$cfp->id)}}" > --}}
                                        {{-- @foreach ($departement as $dep) --}}
                                 {{-- <p class="p-1 m-0" style="font-size: 10px;"> Departement<span style="float: right;">  {{$dep->departement->nom_departement}} 
                                    &nbsp;<i class="fas fa-angle-right"></i></span>
                                   
                                    @endforeach
                                 </p>
                                     </a>
                                 
                                 </div> --}} 
                                 <div style="border-bottom: solid 1px #d399c2;" class="">
                                    {{-- <a href="{{route('edit_fonctionchef',$var->id)}}" > --}}
                                <p class="p-1 m-0" style="font-size: 10px;">Fonction<span style="float: right;">{{$var->fonction_chef}} &nbsp;<i class="fas fa-angle-right"></i></span>
                                    
                                </p>
                                    </a>
                                </div>
                                 <div style="border-bottom: solid 1px #d399c2;" class="">
                                     {{-- <a href="{{route('edit_entreprisechef',$var->id)}}" > --}}
                                 <p class="p-1 m-0" style="font-size: 10px;">Entreprise<span style="float: right;">{{$var->entreprise->nom_etp}} &nbsp;<i class="fas fa-angle-right"></i></span>
                                     
                                 </p>
                                     </a>
                                 </div>
                             
                                 
                                 <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                             </div>
                     </div>
                         @endforeach
 </div>
    {{-- <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-2 m-r-2">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    @foreach ($vars  as $var)

                                    <div class="m-b-25"> <img src="/stagiaire-image/{{$var->photos}}" width="25%" height="25%" class="img-radius">

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
    </div> --}}
@endsection
