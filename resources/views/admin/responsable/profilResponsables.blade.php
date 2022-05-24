@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Votre profil</h3>
@endsection
@inject('groupe','App\groupe')
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
    .image-ronde {
        width: 30px;
        height: 30px;
        border: none;
        -moz-border-radius: 75px;
        -webkit-border-radius: 75px;
        border-radius: 75px;
    }

    .none:hover{
        cursor:default;
    }
</style>
<div class="row">
    <div class="row mt-2">

        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Informations générales</p>

                <div class="d-flex align-items-center justify-content-between hover" style="border-bottom: solid 1px #e8dfe5;">
                    <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-image-alt'></i>&nbsp; PHOTO</p>
                    <a href="{{route('edit_photos_resp',$refs->id)}}">
                        {{-- <img src="{{asset('images/responsables/'.$refs->photos)}}" class="image-ronde"> --}}
                        @if($refs->photos==null)
                            <span>
                                <div style="display: grid; place-content: center">
                                    <div class='randomColor photo_users' style="color:white; font-size: 12px; border: none; border-radius: 100%; height:30px; width:30px ; display: grid; place-content: center">
                                    </div>
                                </div>
                            </span>
                        @else
                        <img src="{{asset('images/responsables/'.$refs->photos)}}" class="image-ronde">
                        @endif

                    </a>
                </div>
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('edit_nom_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-user' ></i>&nbsp; NOM<span style="float: right;">{{$refs->nom_resp}} {{$refs->prenom_resp}} &nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>

                </div>

                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('edit_naissance_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-calendar'></i>&nbsp; DATE DE NAISSANCE
                        @if ($refs->date_naissance_resp==null)
                        <span style="float: right; color:red">incomplète&nbsp;
                        @else
                        <span style="float: right;">{{date('j \\ F Y', strtotime($refs->date_naissance_resp))}}&nbsp;
                        @endif
                        <i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>

                </div>
                {{-- <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('edit_naissance_resp',$refs->id)}} ">

                    @if ($refs->date_naissance_resp==null)
                    <span style="float: right; color:red">incomplète&nbsp;
                        @else
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-calendar' ></i>&nbsp; <span style="float: right;">{{date('j \\ F Y', strtotime($refs->date_naissance_resp))}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                        @endif
                    </a>

                </div> --}}
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('edit_genre_resp',$refs->id)}}  ">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-male-female' style="color: rgb(116, 116, 116)"></i>&nbsp; GENRE
                            <span style="float: right;">
                            @if ($refs->sexe_resp==null)
                            <strong  style="color:red">
                            incomplète</strong>&nbsp;
                            @else
                            {{$refs->sexe_resp}}&nbsp;
                            @endif
                            <i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                {{-- <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('edit_genre_resp',$refs->id)}} ">
                        @if ($refs->sexe_resp==null)
                    <span style="float: right; color:red">incomplète&nbsp;
                        @else
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-male-female' style=''  ></i>&nbsp; GENRE<span style="float: right;">{{$refs->sexe_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>

                        @endif
                    </a>
                </div> --}}
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('edit_pwd_resp',$refs->id)}} ">
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

                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('edit_mail_resp',$refs->id)}} ">
                        
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-envelope' style='' ></i>&nbsp; ADRESSE E-MAIL<span style="float: right;">{{$refs->email_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('edit_phone_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-phone' style='' ></i>&nbsp; TELEPHONE
                            <span style="float: right;">
                                @if ($refs->telephone_resp==null)
                            <strong  style="color:red">
                            incomplète</strong>&nbsp;
                            @else
                                @php
                                    echo $groupe->formatting_phone($refs->telephone_resp);  
                                @endphp

                            @endif
                                {{-- {{$refs->telephone_resp}}&nbsp; --}}
                                <i class="fas fa-angle-right"></i> 
                            </span>

                        </p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('edit_cin_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bxs-user-badge' style='color:rgba(0,0,0,0.49)'  ></i>&nbsp; CIN<span style="float: right;">{{$refs->cin_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
             
                <div style="" class="hover">
                    <a href="{{route('edit_adresse_resp',$refs->id)}}">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-map-pin' ></i>&nbsp; ADRESSE <span style="float: right;">
                            <span style="float: right">
                                @if ($refs->adresse_lot == NULL || $refs->adresse_quartier == NULL || $refs->adresse_quartier == NULL || $refs->adresse_ville == NULL || $refs->adresse_region == NULL || $refs->adresse_code_postal == NULL)
                                    <strong style="color: red">incomplète</strong>&nbsp;
                                @else
                                    Lot/Rue: {{$refs->adresse_lot}}
                                    Qter: {{$refs->adresse_quartier}}
                                    Vlle: {{$refs->adresse_ville}}
                                    <br>
                                    Region: {{$refs->adresse_region}}
                                    CP: {{$refs->adresse_code_postal}}
                                @endif
                            <i class="fas fa-angle-right"></i>
                            </span> 
                           
                        </p>
                    </a>
                </div>

               


                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>
        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Informations professionnelles</p>

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    {{-- <a href="{{route('profile_entreprise',$refs->entreprise_id)}}"> --}}
                    <a href="" class="none">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-building'  ></i>&nbsp; ENTREPRISE<span style="float: right;">{{$nom_entreprise->nom_etp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('edit_fonction_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-list-minus'  ></i>&nbsp; FONCTION<span style="float: right;">{{$refs->fonction_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="" class="none">
                        <p class="p-1 m-0" style="font-size: 10.3px;">Branche<span style="float: right;">{{$branche->nom_branche}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div> --}}

                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a hrefs="#">
                        <p class="p-1 m-0" style="font-size: 12px;">DEPARTEMENT<span style="float: right;">{{optional(optional($refs)->departement)->nom_departement}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div> --}}

                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>
    </div>
</div>

    @endsection
