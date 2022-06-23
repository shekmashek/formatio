@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Profil formateur</h3>
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
                                    <div class="m-b-25"> <img src="/responsable-image/{{$refs->photos}}" width="30%" height="30%" class="rounded-circle">

                                    </div>
                                    <h6 class="f-w-600">{{$refs->nom_resp}} {{$refs->prenom_resp}} </h6>
                                    <h6 class="text-muted f-w-400">{{$refs->fonction_resp}}</h6>
                                    @can('isrefserent')
                                            <a hrefs="{{route('edit_responsable',$refs->id)}}"><i class=" fa fa-edit"></i> &nbsp;Modifier mon profil</a>
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
                                            <h6 class="text-muted f-w-400">{{$refs->cin_resp}}</h6>


                                       <p class="m-b-10 f-w-600"><i class="bx bx-phone"></i>&nbsp;Téléphone</p>
                                            <h6 class="text-muted f-w-400">{{$refs->telephone_resp}}</h6>



                                            <p class="m-b-10 f-w-600"><i class="bx bx-envelope"></i>&nbsp;E-mail </p>
                                            <h6 class="text-muted f-w-400">{{$refs->email_resp}}</h6>

                                     </div>
                                        <div class="col-lg-6">
                                            <h6 class="m-b-20 p-b-5  f-w-600">Informations professionnelles</h6>
                                            <hr>

                                            <p class="m-b-10 f-w-600"><i class="bx bx-building-house"></i>&nbsp;Entreprise</p>

                                            <h6 class="text-muted f-w-400">{{$refs->entreprise->nom_etp}}</h6>



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
            /* .hover:hover{
                font-size: 25px;
                cursor: pointer;
                background-color: #f0ececfa;
                border: 25px;
            }
            #nom:hover{
                font-size: 25px;
                cursor: pointer;
                background-color: #f0ececfa;
                border: 25px;
            }
            */

    </style>
<div class="row">
    <div class="row mt-2">
        <div class="col-lg-4">
            <div class="form-control">
                <p class="text-center">Informations générales</p>
                <div class="d-flex align-items-center justify-content-between hover" style="border-bottom: solid 1px #e8dfe5;">
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-image-alt'></i>&nbsp; PHOTO
                </p>
                <a href="{{route('editer_photos',$formateur->id)}}" >
                @if($formateur->photos==null)
                <span>
                    <div style="display: grid; place-content: center">
                        <div class='randomColor photo_users' style="color:white; font-size: 12px; border: none; border-radius: 100%; height:30px; width:30px ; display: grid; place-content: center">
                        </div>
                    </div>
                </span>
                @else
                <img src="{{asset('images/formateurs/'.$formateur->photos)}}" class="image-ronde">
                @endif
            </a>
            </div>
            <div  style="border-bottom: solid 1px #e8dfe5;">
                <a href="{{route('editer_nom',$formateur->id)}}" >
                <p class="p-1 m-0" id="nom" style="font-size: 12px;"><i class='bx bx-user' ></i>&nbsp; NOM<span style="float: right;">{{$formateur->nom_formateur}} {{$formateur->prenom_formateur}} &nbsp;<i class="fas fa-angle-right"></i></span>

                </p></a>

                </div>
                <div id="nom" style="border-bottom: solid 1px #e8dfe5;">
                <a href="{{route('editer_naissance',$formateur->id)}}" >
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-calendar'></i>&nbsp; DATE DE NAISSANCE<span style="float: right;">{{date('j \\ F Y', strtotime($formateur->date_naissance))}}&nbsp;<i class="fas fa-angle-right"></i></span>

                </p>
            </a>

            </div>
            <div id="nom"style="border-bottom: solid 1px #e8dfe5;">
                <a href="{{route('editer_genre',$formateur->id)}}" >
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-male-female' style="color: rgb(116, 116, 116)"></i>&nbsp; GENRE
                <span style="float: right;">

                {{optional(optional($formateur)->genre)->genre}}&nbsp;
                <i class="fas fa-angle-right"></i></span>
                </p>
                </a>
            </div>
            <div id="nom"style="border-bottom: solid 1px #e8dfe5;">
                <a href="{{route('editer_pwd',$formateur->id)}}" >
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-key' style='' ></i>&nbsp; Mot de passe<span style="float: right;">Mot de passe&nbsp;<i class="fas fa-angle-right"></i></span>
                </p>
                </a>
                </div>
                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>


        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Coordonnées</p>

                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                    <a href="{{route('editer_mail',$formateur->id)}}" >
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-envelope' style='' ></i>&nbsp; ADRESSE E-MAIL<span style="float: right;">{{$formateur->mail_formateur}}&nbsp;<i class="fas fa-angle-right"></i></span>

                </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href=" {{route('editer_phone',$formateur->id)}}" >
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-phone' style='' ></i>&nbsp;TELEPHONE<span style="float: right;">{{$formateur->numero_formateur}}&nbsp;<i class="fas fa-angle-right"></i> </span>

                </p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                    <a href="{{route('editer_cin',$formateur->id)}} " >
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bxs-user-badge' style='color:rgba(0,0,0,0.49)'  ></i>&nbsp; CIN<span style="float: right;">{{$formateur->cin}}&nbsp;<i class="fas fa-angle-right"></i></span>
                </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #d399c2;" class="hover">
            <a href="{{route('editer_adresse',$formateur->id)}}  " >
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-map-pin' ></i>&nbsp;ADRESSE<span style="float: right;">{{$formateur->adresse}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-angle-right"></i></span>

                </p>
            </a>
                </div>

                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>
        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Informations professionnelles</p>

                {{-- <div style="border-bottom: solid 1px #d399c2;" class="hover">
                    <a href="{{route('editer_etp',$formateur->id)}} " >
                <p class="p-1 m-0" style="font-size: 12px;">Poste<span style="float: right;">{{$formateur->specialite}}&nbsp;<i class="fas fa-angle-right"></i></span>

                </p>
                    </a>
                </div> --}}

                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                    <a href="{{route('editer_niveau',$formateur->id)}}  " >
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bxs-graduation' style='color:rgba(0,0,0,0.58)'  ></i>&nbsp;Niveau d'étude<span style="float: right;">{{$niveau->niveau_etude}} &nbsp;<i class="fas fa-angle-right"></i></span>

                </p>
                    </a>

                </div>
                @foreach($competence as $comp)
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                <a href="{{route('editer_comp',$formateur->id)}}  " >
            <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-library'></i> &nbsp;Competence<span style="float: right;">{{$comp->competence}} &nbsp;<i class="fas fa-angle-right"></i></span>

            </p>
        </div>
        <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
            <a href="{{route('editer_domaine',$formateur->id)}}  " >
        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-book-reader'></i>&nbsp;Domaine<span style="float: right;">{{$comp->domaine}} &nbsp;<i class="fas fa-angle-right"></i></span>

        </p>
        @endforeach
            </a>

        </div>
        @foreach($experience as $exp)
        <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
            <a href="{{route('editer_nom_etp',$formateur->id)}}  " >
        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-building'  ></i>&nbsp; Entreprise<span style="float: right;">{{$exp->nom_entreprise}} &nbsp;<i class="fas fa-angle-right"></i></span>

        </p>
            </a>
            </div>
            <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                <a href="{{route('editer_poste',$formateur->id)}}  " >
            <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-bar-chart-square'></i>&nbsp;Poste occupé<span style="float: right;">{{$exp->poste_occuper}} &nbsp;<i class="fas fa-angle-right"></i></span>

            </p>
                </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('editer_fonction',$formateur->id)}}  " >
                <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-list-minus'  ></i>&nbsp;Fonction<span style="float: right;">{{$exp->taches}} &nbsp;<i class="fas fa-angle-right"></i></span>

                </p>
                    </a>
                    </div>
            @endforeach
            {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                <a href="#" >
            <p class="p-1 m-0" style="font-size: 12px;">DEPARTEMENT<span style="float: right;">{{optional(optional($refs)->departement)->nom_departement}}&nbsp;<i class="fas fa-angle-right"></i></span>

            </p>
                </a>
            </div> --}}
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
        </div>
    </div>

</div>

@endsection


