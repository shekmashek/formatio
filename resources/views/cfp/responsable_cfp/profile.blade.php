@extends('./layouts/admin')
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

    .hover:hover {
        background-color: rgb(233, 220, 220);
        cursor: pointer;
    }

</style>
<div class="row">
    <div class="row mt-2">

        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Informations générales</p>

                <div class="d-flex align-items-center justify-content-between hover" style="border-bottom: solid 1px #d399c2;">
                    <p class="p-1 m-0" style="font-size: 10px;">PHOTO
                    </p>
                    <a href="{{route('edit_photos_resp',$refs->id)}}">
                        {{-- <img src="{{asset('images/responsables/'.$refs->photos)}}" class="image-ronde"> --}}
                        @if($refs->photos_resp_cfp==null)
                        <img src="{{asset('images/users/user.png')}}" class="image-ronde">
                        @else
                        <img src="{{asset('images/responsables/'.$refs->photos_resp_cfp)}}" class="image-ronde">
                        @endif


                    </a>
                </div>
                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                    <a href="{{route('modification_nom',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">NOM<span style="float: right;">{{$refs->nom_resp_cfp}} {{$refs->prenom_resp_cfp}} &nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>

                </div>
                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                    <a href="{{route('modification_date_de_naissance',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">DATE DE NAISSANCE
                        @if ($refs->date_naissance_resp_cfp==null)
                        <span style="float: right; color:red">incomplète&nbsp;
                        @else
                        <span style="float: right;">{{date('j \\ F Y', strtotime($refs->date_naissance_resp_cfp))}}&nbsp;
                        @endif
                        <i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>

                </div>
                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                    <a href="{{route('edit_genre_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">GENRE
                            <span style="float: right;">
                            @if ($refs->sexe_resp_cfp==null)
                            <strong  style="color:red">
                            incomplète</strong>&nbsp;
                            @else
                           {{$refs->sexe_resp_cfp}}&nbsp;
                            @endif
                            <i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                    <a href="{{route('edit_pwd_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">Mot de passe<span style="float: right;">Mot de passe&nbsp;<i class="fas fa-angle-right"></i></span>
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
                    <a href="{{route('edit_mail_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">ADRESSE E-MAIL<span style="float: right;">{{$refs->email_resp_cfp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                    <a href="{{route('edit_phone_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">TELEPHONE<span style="float: right;">{{$refs->telephone_resp_cfp}}&nbsp;<i class="fas fa-angle-right"></i> </span>

                        </p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                    <a href="{{route('edit_cin_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">CIN<span style="float: right;">{{$refs->cin_resp_cfp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                    <a href="{{route('edit_adresse_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">ADRESSE <span style="float: right;">
                            <span style="float: right">
                            @if ($refs->adresse_lot==null)
                            Lot/Rue: <strong style="color: red">incomplète</strong>&nbsp;
                            @else
                            Lot/Rue: {{$refs->adresse_lot}} &nbsp;
                            @endif

                            @if($refs->adresse_quartier==null)
                            Qter: <strong style="color: red">incomplète</strong>&nbsp;
                            @else
                            Qter: {{$refs->adresse_quartier}} &nbsp;
                            @endif

                            @if($refs->adresse_ville==null)
                            Vlle: <strong style="color: red">incomplète</strong>&nbsp;
                            @else
                            Vlle: {{$refs->adresse_ville}} &nbsp;
                            @endif

                            @if($refs->adresse_region==null)
                            Region: <strong style="color: red">incomplète</strong>&nbsp;
                            @else
                            Region: {{$refs->adresse_region}} &nbsp;
                            @endif

                            @if($refs->adresse_code_postal==null)
                            Postal: <strong style="color: red">incomplète</strong>&nbsp;
                            @else
                            Postal: {{$refs->adresse_code_postal}} &nbsp;
                            @endif

                            <i class="fas fa-angle-right"></i></span>
                            {{-- <span style="float: right;">{{$refs->adresse_ville}} &nbsp;{{$refs->adresse_code_postal}}&nbsp;{{$refs->adresse_region}}&nbsp;<i class="fas fa-angle-right"></i></span> --}}
                          </p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                    <a href="{{route('edit_fonction_resp',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">FONCTION<span style="float: right;">{{$refs->fonction_resp_cfp}}&nbsp;<i class="fas fa-angle-right"></i></span>
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
                    <a hrefs="#">
                        <p class="p-1 m-0" style="font-size: 10px;">Poste responsable<span style="float: right;">{{$refs->poste_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div> --}}

                <div style="border-bottom: solid 1px #d399c2;" class="">
                    <a href="{{route('profil_cfp',$refs->cfp_id)}}">
                        <p class="p-1 m-0" style="font-size: 10px;">ORGANISME DE FORMATION<span style="float: right;">{{$refs->nom_cfp}} &nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>

                </div>

                {{-- <div style="border-bottom: solid 1px #d399c2;" class="">
                    <a hrefs="#">
                        <p class="p-1 m-0" style="font-size: 10px;">DEPARTEMENT<span style="float: right;">{{optional(optional($refs)->departement)->nom_departement}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div> --}}

                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>
    </div>

    @endsection
