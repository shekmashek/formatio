@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Affichage paramètre résponsable</h3>
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
            <div class="form-control" style="height: 120px;">
                <p class="text-center">Information légales</p>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('profile_entreprise',$refs->entreprise_id)}}">
                        <p class="p-1 m-0" style="font-size: 10px;">ENTREPRISE<span style="float: right;">{{$nom_entreprise->nom_etp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="" class="none">
                        <p class="p-1 m-0" style="font-size: 10.3px;">Branche<span style="float: right;">{{$branche->nom_branche}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="form-control" style="height: 120px; ">
                <p class="text-center">Information de facturation</p>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="" class="none">
                        <p class="p-1 m-0" style="font-size: 10.3px;">Facture non echu<span style="float: right;">1 &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-control" style="height: 120px; ">
                <p class="text-center">Information de taxation</p>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="" class="none">
                        <p class="p-1 m-0" style="font-size: 10.3px;">Taxation<span style="float: right;">Assugetti &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @endsection
