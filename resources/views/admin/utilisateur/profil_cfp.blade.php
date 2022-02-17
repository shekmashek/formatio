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
.hover:hover{
 background-color: rgb(233, 220, 220);
 cursor: pointer;
}
 </style>
  <div class="row">
      
                     <div class="row mt-2">
                         @foreach ($liste_cfps as $cfp)
                         <div class="col-lg-4">
                            
                             <div class="form-control">
                                 <p class="text-center">Informations générales</p>
                         
                                 <div class="d-flex align-items-center justify-content-between hover" style="border-bottom: solid 1px #d399c2;">
                                 <p class="p-1 m-0" style="font-size: 10px;">Logo
                                 </p>
                                 <a href="{{route('edit_logocfp',$cfp->id)}} " >
                                    <img src="{{asset('images/CFP/'.$cfp->logo)}}"  class="image-ronde">
                             </a>
                                 
                                </div>
                                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                                 <a href="{{route('edit_nomcfp',$cfp->id)}}" >
                                 <p class="p-1 m-0" style="font-size: 10px;">NOM<span style="float: right;">{{ $cfp->nom }}&nbsp;<i class="fas fa-angle-right"></i></span>
                                     
                                 </p></a>
                                 
                                </div>
                          
                                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                                    <a href="{{route('edit_adressecfp',$cfp->id)}}" >
                                    <p class="p-1 m-0" style="font-size: 10px;">Adresse<span style="float: right;">{{ $cfp->adresse_lot }}, {{ $cfp->adresse_ville }}, {{ $cfp->adresse_region }}&nbsp;<i class="fas fa-angle-right"></i></span>
                                        
                                    </p></a>
                                    
                                   </div>
                                @can('isCFP')
                                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                                 <a href="{{route('edit_pwdcfp',$cfp->id)}}" >
                                 <p class="p-1 m-0" style="font-size: 10px;">Mot de passe<span style="float: right;">Mot de passe&nbsp;<i class="fas fa-angle-right"></i></span>
                                 </p>
                                 </a>
                                </div>
                                @endcan
                                 <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                             </div>
                         </div>
                     

                             <div class="col-lg-4">
                            
                                 <div class="form-control">
                                     <p class="text-center">Coordonnées</p>
                             
                                     <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                         <a href="{{route('edit_mailcfp',$cfp->id)}}" >
                                     <p class="p-1 m-0" style="font-size: 10px;">ADRESSE E-MAIL<span style="float: right;">{{ $cfp->email }}&nbsp;<i class="fas fa-angle-right"></i></span>
                                         
                                     </p>
                                         </a>
                                     </div>
                                     <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                         <a href="{{route('edit_phonecfp',$cfp->id)}}" >
                                     <p class="p-1 m-0" style="font-size: 10px;">TELEPHONE<span style="float: right;">{{ $cfp->telephone }}&nbsp;<i class="fas fa-angle-right"></i> </span>
                                         
                                     </p>
                                         </a>
                                     </div>
                      
                                     
                                     <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                                 </div>
                         </div>
                         <div class="col-lg-4">
                            
                             <div class="form-control">
                                 <p class="text-center">Informations professionnelles</p>
                         
                  
                                 <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                     <a href="{{route('edit_domainecfp',$cfp->id)}}" >
                                 <p class="p-1 m-0" style="font-size: 10px;"> Domaine de formation<span style="float: right;">{{ $cfp->domaine_de_formation }} 
                                    &nbsp;<i class="fas fa-angle-right"></i></span>
                                     
                                 </p>
                                     </a>
                                 
                                 </div>
                                 
                                 <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                     <a href="{{route('edit_sitecfp',$cfp->id)}}" >
                                 <p class="p-1 m-0" style="font-size: 10px;">Site web officiel<span style="float: right;">{{ $cfp->site_cfp }} &nbsp;<i class="fas fa-angle-right"></i></span>
                                     
                                 </p>
                                     </a>
                                 </div>
                                 <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                    <a href="{{route('edit_nifcfp',$cfp->id)}}" >
                                <p class="p-1 m-0" style="font-size: 10px;">NIF<span style="float: right;">{{ $cfp->nif }} &nbsp;<i class="fas fa-angle-right"></i></span>
                                    
                                </p>
                                    </a>
                                </div>
                                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                    <a href="{{route('edit_cifcfp',$cfp->id)}}" >
                                <p class="p-1 m-0" style="font-size: 10px;">CIF<span style="float: right;">{{ $cfp->cif }} &nbsp;<i class="fas fa-angle-right"></i></span>
                                    
                                </p>
                                    </a>
                                </div>
                                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                    <a href="{{route('edit_statcfp',$cfp->id)}}" >
                                <p class="p-1 m-0" style="font-size: 10px;">STAT<span style="float: right;">{{ $cfp->stat}} &nbsp;<i class="fas fa-angle-right"></i></span>
                                    
                                </p>
                                    </a>
                                </div>
                                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                    <a href="{{route('edit_rcscfp',$cfp->id)}}" >
                                <p class="p-1 m-0" style="font-size: 10px;">RCS<span style="float: right;">{{ $cfp->rcs}} &nbsp;<i class="fas fa-angle-right"></i></span>
                                    
                                </p>
                                    </a>
                                </div>
                                
                                 
                                 <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                             </div>
                     </div>
                         @endforeach
 </div>
    {{-- <div class="page-content page-container" id="page-content">
        @foreach ($liste_cfps as $cfp)


        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-2 m-r-2">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25"> <img src="/dynamic-image/{{$cfp->logo}}" width="30%" height="30%">

                                    </div>
                                    <h6 class="f-w-600">{{ $cfp->nom }}</h6>
                                    <p></p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                    <p></p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-6">
                                    <h6 class="m-b-20  f-w-600">Centre de formaton</h6>
                                            <hr>
                                            <p class="m-b-10 f-w-600"><i class="bx bx-building-house"></i>&nbsp;Adresse</p>
                                            <h6 class="text-muted f-w-400">{{ $cfp->adresse_lot }}, {{ $cfp->adresse_ville }}, {{ $cfp->adresse_region }}</h6>

                                            <p class="m-b-10 f-w-600"><i class="bx bx-envelope"></i>&nbsp;Email</p>
                                            <h6 class="text-muted f-w-400">{{ $cfp->email }}</h6>

                                            <p class="m-b-10 f-w-600"><i class="bx bx-phone"></i>&nbsp;Téléphone</p>
                                            <h6 class="text-muted f-w-400">{{ $cfp->telephone }}</h6>
                                        </div>

                                        <div class="col-lg-6">
                                            <br><br>
                                        <p class="m-b-10 f-w-600"><i  class="bx bxs-graduation"></i>&nbsp; Domaine de formation</p>
                                            <h6 class="text-muted f-w-400"> {{ $cfp->domaine_de_formation }} </h6>
                                              <p class="m-b-10 f-w-600"><i  class="fa fa-globe"></i>&nbsp; Site web officiel</p>
                                            <h6 class="text-muted f-w-400">{{ $cfp->site_cfp }}</h6>
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
        @endforeach
    </div> --}}
@endsection
