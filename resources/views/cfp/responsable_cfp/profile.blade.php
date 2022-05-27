@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Profil du compte</h3>
@endsection
@inject('groupe', 'App\groupe')
@section('content')

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
                    <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-image-alt'></i>&nbsp; PHOTO
                    </p>
                    <a href="{{route('modification_photo',$refs->id)}}">

                        @if($refs->photos_resp_cfp==null)
                            <span>
                                <div style="display: grid; place-content: center">
                                    <div class='randomColor photo_users' style="color:white; font-size: 12px; border: none; border-radius: 100%; height:30px; width:30px ; display: grid; place-content: center">
                                    </div>
                                </div>
                            </span>
                        @else
                            <img src="{{asset('images/responsables/'.$refs->photos_resp_cfp)}}" class="image-ronde">
                        @endif
                    </a>
                </div>
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('modification_nom',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-user'></i>&nbsp; NOM<span style="float: right;">{{$refs->nom_resp_cfp}} {{$refs->prenom_resp_cfp}} &nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>

                </div>
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('modification_date_de_naissance',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-calendar'></i>&nbsp; DATE DE NAISSANCE
                        @if ($refs->date_naissance_resp_cfp==null)
                        <span style="float: right; color:red">incomplète&nbsp;
                        @else
                        <span style="float: right;">{{date('j \\ F Y', strtotime($refs->date_naissance_resp_cfp))}}&nbsp;
                        @endif
                        <i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>

                </div>
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('modification_genre',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-male-female' style="color: rgb(116, 116, 116)"></i>&nbsp; GENRE
                            <span style="float: right;">
                            @if ($refs->sexe_resp_cfp == null)
                            <strong  style="color:red">
                            incomplète</strong>&nbsp;
                            @else
                            {{$refs->sexe_resp_cfp}}&nbsp;
                            @endif
                            <i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                <div class="hover" style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('modification_mdp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-key'></i>&nbsp; Mot de passe<span style="float: right;">Mot de passe&nbsp;<i class="fas fa-angle-right"></i></span>
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
                    <a href="{{route('modification_email',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;"> <i class='bx bx-envelope'></i>&nbsp; ADRESSE E-MAIL<span style="float: right;">{{$refs->email_resp_cfp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('modification_telephone',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-phone'></i>&nbsp; TELEPHONE<span style="float: right;">
                            @if ($refs->telephone_resp_cfp == null)
                                <strong  style="color:red">
                                incomplète</strong>&nbsp;
                            @else
                                {{$refs->telephone_resp_cfp}}&nbsp;
                            @endif
                            <!-- @php
                                echo $groupe->formatting_phone($refs->telephone_resp_cfp);
                            @endphp -->
                            <i class="fas fa-angle-right"></i> </span>
                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('modification_cin',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bxs-user-badge' style='color:rgba(0,0,0,0.41)'  ></i>&nbsp; CIN<span style="float: right;">{{$refs->cin_resp_cfp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                <div style="" class="hover">
                    <a href="{{route('modificationn_adresse',$refs->id)}} ">
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
                            {{-- <span style="float: right;">{{$refs->adresse_ville}} &nbsp;{{$refs->adresse_code_postal}}&nbsp;{{$refs->adresse_region}}&nbsp;<i class="fas fa-angle-right"></i></span> --}}
{{--
                            <span style="float: right">
                                @if($refs->adresse_quartier==null)
                                Qter: <strong style="color: red">incomplète</strong>&nbsp;
                                @else
                                Qter: {{$refs->adresse_quartier}} &nbsp;
                                @endif --}}
                            {{-- <i class="fas fa-angle-right"></i> --}}
                            {{-- </span> --}}
                            {{-- <br> --}}
                            {{-- <span style="float: right;">{{$refs->adresse_ville}} &nbsp;{{$refs->adresse_code_postal}}&nbsp;{{$refs->adresse_region}}&nbsp;<i class="fas fa-angle-right"></i></span> --}}
                            {{-- <span style="float: right">
                                @if($refs->adresse_ville==null)
                                Vlle: <strong></strong>&nbsp;
                                @else
                                Vlle: {{$refs->adresse_ville}} &nbsp;
                                @endif --}}
                            {{-- <i class="fas fa-angle-right"></i> --}}
                            {{-- </span> --}}
                            {{-- <span style="float: right;">{{$refs->adresse_ville}} &nbsp;{{$refs->adresse_code_postal}}&nbsp;{{$refs->adresse_region}}&nbsp;<i class="fas fa-angle-right"></i></span> --}}
                            {{-- <span style="float: right">
                                @if($refs->adresse_region==null)
                                Region: <strong style="color: red">incomplète</strong>&nbsp;
                                @else
                                Region: {{$refs->adresse_region}} &nbsp;
                                @endif --}}
                            {{-- <i class="fas fa-angle-right"></i> --}}
                            {{-- </span> --}}
                            {{-- <span style="float: right;">{{$refs->adresse_ville}} &nbsp;{{$refs->adresse_code_postal}}&nbsp;{{$refs->adresse_region}}&nbsp;<i class="fas fa-angle-right"></i></span> --}}
                            {{-- <span style="float: right">
                                @if($refs->adresse_code_postal==null)
                                CP: <strong style="color: red">incomplète</strong>&nbsp;
                                @else
                                CP: {{$refs->adresse_code_postal}} &nbsp;
                                @endif --}}

                            {{-- <i class="fas fa-angle-right"></i> --}}
                            {{-- </span> --}}
                            {{-- <span style="float: right;">{{$refs->adresse_ville}} &nbsp;{{$refs->adresse_code_postal}}&nbsp;{{$refs->adresse_region}}&nbsp;<i class="fas fa-angle-right"></i></span> --}}
                        </p>
                    </a>
                </div>

                <div id="columnchart_material_12" style="width: 200px; height: 62px;"></div>
            </div>
        </div>
        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Informations professionnelles</p>

                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a hrefs="#">
                        <p class="p-1 m-0" style="font-size: 12px;">Poste responsable<span style="float: right;">{{$refs->poste_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div> --}}

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    {{-- <a href="{{route('profil_of',$refs->cfp_id)}}"> --}}
                    <a class="none" href="">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-building'></i>&nbsp; ORGANISME DE FORMATION<span style="float: right;">{{$refs->nom_cfp}} &nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="hover">
                    <a href="{{route('modification_fonction',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 12px;"><i class='bx bx-list-minus'></i>&nbsp; FONCTION<span style="float: right;">{{$refs->fonction_resp_cfp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a hrefs="#">
                        <p class="p-1 m-0" style="font-size: 12px;">DEPARTEMENT<span style="float: right;">{{optional(optional($refs)->departement)->nom_departement}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div> --}}

                <div id="columnchart_material_12" style="width: 200px; height: 114px; "></div>
            </div>
        </div>
    </div>

    @endsection
