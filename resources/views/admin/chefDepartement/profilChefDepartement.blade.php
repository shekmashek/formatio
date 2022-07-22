@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">@lang('translation.Profil')</h3>
@endsection
@section('content')
    {{-- <div class="page-content page-container" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-2 m-r-2">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    @foreach ($vars  as $id_chef)
                                    <div class="m-b-25"> <img src="/stagiaire-image/{{$id_chef->photos}}" width="25%" height="25%" class="img-radius">
                                    </div>
                                    <h6 class="f-w-600">{{$id_chef->nom_chef}} {{$id_chef->prenom_chef}}</h6>
                                    <p>{{$id_chef->fonction_chef}}</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                    @can('`')
                                        <a href="{{route('edit_manager',$id_chef->id)}}"><i class=" fa fa-edit"></i> &nbsp;Modifier mon profil</a>
                                    @endcan
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Informations personnelles</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-envelope"></i>&nbsp;E-mail</p>
                                            <h6 class="text-muted f-w-400">{{$id_chef->mail_chef}}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-phone"></i>&nbsp;Téléphone</p>
                                            <h6 class="text-muted f-w-400">{{$id_chef->telephone_chef}}</h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-home"></i>&nbsp;Département</p>
                                            {{-- @foreach ($departement as $dep)
                                            <h6 class="text-muted f-w-400">{{$dep->departement->nom_departement}}</h6>
                                            @endforeach --}}
{{--
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"><i class="bx bx-building-house"></i>&nbsp;Entreprise</p>
                                            <h6 class="text-muted f-w-400">{{$id_chef->entreprise->nom_etp}}</h6>
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
    <style>
        .image-ronde{
   width : 30px; height : 30px;
   border: none;
   -moz-border-radius : 75px;
   -webkit-border-radius : 75px;
   border-radius : 75px;
 }
 </style>
      <div class="row">
    <div class="row mt-2">

                             <div class="col-lg-4">

                                 <div class="form-control">
                                     <p class="text-center">@lang('translation.Informations') @lang('translation.générales')</p>

                                     <div class="d-flex align-items-center justify-content-between hover" style="border-bottom: solid 1px #e8dfe5;">
                                     <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-image-alt'></i>&nbsp; @lang('translation.Image')

                                     </p>



                                     <a href="{{route('editer_photos_manager',$id_chef->id)}}" >
                                        @if($id_chef->photos==null)
                                                <span>
                                                    <div style="display: grid; place-content: center">
                                                        <div class='randomColor photo_users' style="color:white; font-size: 12px; border: none; border-radius: 100%; height:30px; width:30px ; display: grid; place-content: center">
                                                        </div>
                                                    </div>
                                                </span>
                                            @else
                                        <img src="{{asset('images/employes/'.$id_chef->photos)}}" class="image-ronde">

                                            @endif
                                    </a>
                                    </div>
                                    <div  style="border-bottom: solid 1px #e8dfe5;">
                                     <a href="{{route('editer_nom_manager',$id_chef->id)}}" >
                                     <p class="p-1 m-0" id="nom" style="font-size: 12px;"><i class='bx bx-user' ></i>&nbsp;@lang('translation.Nom')<span style="float: right;">{{$id_chef->nom_emp}} {{$id_chef->prenom_emp}} &nbsp;<i class="fas fa-angle-right"></i></span>

                                     </p></a>

                                    </div>

                                    <div id="nom"style="border-bottom: solid 1px #e8dfe5;">
                                     <a href="{{route('editer_genre_manager',$id_chef->id)}}" >
                                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-male-female' style="color: rgb(116, 116, 116)"></i>&nbsp; @lang('translation.Genre')
                                        @if ($genre ==null)
                                        <span style="float: right; color:red">@lang('translation.incomplète')&nbsp;
                                      @else
                                     <span style="float: right;">{{$genre}}&nbsp;
                                        @endif
                                        <i class="fas fa-angle-right"></i></span>

                                    </p>
                                     </a>

                                    </div>
                                    <div id="nom"style="border-bottom: solid 1px #e8dfe5;">
                                        <a href="{{route('editer_pwd_manager',$id_chef->id)}}" >
                                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-key' style='' ></i>&nbsp;@lang('translation.motDePasse')<span style="float: right;">@lang('translation.motDePasse')&nbsp;<i class="fas fa-angle-right"></i></span>
                                        </p>
                                        </a>
                                       </div>
                                     <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                                 </div>
                             </div>


                                 <div class="col-lg-4">

                                     <div class="form-control">
                                         <p class="text-center">@lang('translation.Coordonnées')</p>

                                         <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                                             <a href="{{route('editer_mail_manager',$id_chef->id)}}" >
                                         <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-envelope' style='' ></i>&nbsp;@lang('translation.E-mail')<span style="float: right;">{{$id_chef->email_emp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                                         </p>
                                             </a>
                                         </div>
                                         <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                                             <a href=" {{route('editer_phone_manager',$id_chef->id)}}" >
                                         <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-phone' style='' ></i>&nbsp;@lang('translation.Téléphone')<span style="float: right;">{{$id_chef->telephone_emp}}&nbsp;<i class="fas fa-angle-right"></i> </span>

                                         </p>
                                             </a>
                                         </div>

                                         <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                                             <a href="{{route('editer_cin_manager',$id_chef->id)}} " >
                                         <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bxs-user-badge' style='color:rgba(0,0,0,0.49)'  ></i>&nbsp;@lang('translation.CIN')<span style="float: right;">{{$id_chef->cin_emp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                         </p>
                                             </a>
                                         </div>


                                         <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                                     </div>
                             </div>
                             <div class="col-lg-4">

                                 <div class="form-control">
                                     <p class="text-center">@lang('translation.Informations') @lang('translation.professionnelles')</p>

                                     <div style="border-bottom: solid 1px #e8dfe5;" class="hover">

                                     <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-id-card'></i>&nbsp;@lang('translation.Matricule')<span style="float: right;">{{$id_chef->matricule_emp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                                     </p>

                                     </div>

                                     <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                                         <a href="{{route('editer_fonction_manager',$id_chef->id)}}  " >
                                     <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-list-minus'  ></i>&nbsp;@lang('translation.Fonction')<span style="float: right;">{{$id_chef->fonction_emp}} &nbsp;<i class="fas fa-angle-right"></i></span>

                                     </p>
                                         </a>

                                     </div>
                                     <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                                        {{-- <a href="{{route('editer_niveau',$id_chef->id)}}  " > --}}
                                    <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-building'  ></i>&nbsp;@lang('translation.Entreprise')<span style="float: right;">{{$nom_etp}} &nbsp;<i class="fas fa-angle-right"></i></span>

                                    </p>
                                        </a>

                                    </div>




     </div>
@endsection
