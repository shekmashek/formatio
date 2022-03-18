@extends('./layouts/admin')
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
                    <a href="#">
                        <img src="{{asset('images/responsables/'.$refs->photos)}}" class="image-ronde">
                    </a>
                </div>
                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                    <a href="{{route('edit_nom',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">NOM<span style="float: right;">{{$refs->nom_resp}} {{$refs->prenom_resp}} &nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>

                </div>
                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                    <a href="{{route('edit_naissance',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">ANNIVERSAIRE<span style="float: right;">{{date('j \\ F Y', strtotime($refs->date_naissance_resp))}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>

                </div>
                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                    <a href="{{route('edit_genre',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">GENRE<span style="float: right;">{{$refs->sexe_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
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
                    <a href="{{route('edit_mail',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">ADRESSE E-MAIL<span style="float: right;">{{$refs->email_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                    <a href="{{route('edit_phone',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">TELEPHONE<span style="float: right;">{{$refs->telephone_resp}}&nbsp;<i class="fas fa-angle-right"></i> </span>

                        </p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                    <a href="{{route('edit_cin',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">CIN<span style="float: right;">{{$refs->cin_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                    <a href="{{route('edit_adresse',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">ADRESSE<span style="float: right;">{{$refs->adresse_lot}} &nbsp;{{$refs->adresse_quartier}} &nbsp;{{$refs->adresse_ville}} &nbsp;{{$refs->adresse_code_postal}}&nbsp;{{$refs->adresse_region}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div>
                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                    <a href="{{route('edit_fonction',$refs->id)}} ">
                        <p class="p-1 m-0" style="font-size: 10px;">FONCTION<span style="float: right;">{{$refs->fonction_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>


                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>
        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Informations professionnelles</p>

                <div style="border-bottom: solid 1px #d399c2;" class="">
                    <a href="#">
                        <p class="p-1 m-0" style="font-size: 10px;">Poste responsable<span style="float: right;">{{$refs->poste_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #d399c2;" class="">
                    <a href="# ">
                        <p class="p-1 m-0" style="font-size: 10px;">ENTREPRISE<span style="float: right;">{{optional(optional($refs)->entreprise)->nom_etp}} &nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>

                </div>

                {{-- <div style="border-bottom: solid 1px #d399c2;" class="">
                                         <a href="#" >
                                     <p class="p-1 m-0" style="font-size: 10px;">DEPARTEMENT<span style="float: right;">{{optional(optional($refs)->departement)->nom_departement}}&nbsp;<i class="fas fa-angle-right"></i></span>

                </p>
                </a>
            </div> --}}
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
        </div>
    </div>

</div>

@endsection
