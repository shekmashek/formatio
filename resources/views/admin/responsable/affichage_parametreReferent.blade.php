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
            <div class="form-control" >
                <p class="text-center">Information légales</p>
                <div class="d-flex align-items-center justify-content-between hover" style="border-bottom: solid 1px #e8dfe5;">
                    <div>
                        <p class="p-1 m-0" style="font-size: 12px;">Logo</p>
                    </div>
                    <div class="text-end">
                        <a href="{{route('modification_logo',$entreprise->id)}}">
                        @if($entreprise->logo == NULL )
                            <span class="text-end">
                                <img src="" alt="Logo entreprise">
                            </span>
                        @else
                            <span class="text-end">
                                <img src="{{asset('images/entreprises/'.$entreprise->logo)}}" width="120px" height="60px" class="">
                            </span>
                            @endif
                        </a>
                    </div>
                </div>

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_nom_entreprise',$entreprise->id)}}">
                        <p class="p-1 m-0" style="font-size: 12px;">Nom entreprise<span style="float: right;">{{$nom_entreprise->nom_etp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_email_entreprise',$entreprise->id)}}">
                        @if($entreprise->email_etp==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">E-mail entreprise<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">E-mail entreprise<span style="float: right;">{{$nom_entreprise->email_etp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_email_entreprise',$entreprise->id)}}">
                        @if($entreprise->telephone_etp==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">Télephone entreprise<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Télephone entreprise<span style="float: right;">{{$nom_entreprise->telephone_etp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_nif_entreprise',$entreprise->id)}}">
                        @if($entreprise->nif==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">NIF<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">NIF<span style="float: right;">{{$nom_entreprise->nif}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_stat_entreprise',$entreprise->id)}}">
                        @if($entreprise->stat==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">STAT<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">STAT<span style="float: right;">{{$nom_entreprise->stat}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_rcs_entreprise',$entreprise->id)}}">
                        @if($entreprise->rcs==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">RCS<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">RCS<span style="float: right;">{{$nom_entreprise->rcs}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_rcs_entreprise',$entreprise->id)}}">
                        @if($entreprise->cif==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">CIF<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">CIF<span style="float: right;">{{$nom_entreprise->cif}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="">
                        @if($entreprise->secteur->nom_secteur==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">Secteur d'activité<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Secteur d'activité<span style="float: right;">{{$entreprise->secteur->nom_secteur}}&nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>


                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('profile_entreprise',$refs->entreprise_id)}}">
                        <p class="p-1 m-0" style="font-size: 12px;">ENTREPRISE<span style="float: right;">{{$nom_entreprise->nom_etp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div> --}}
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="" class="none">
                        <p class="p-1 m-0" style="font-size: 12px;">Branche<span style="float: right;">{{$branche->nom_branche}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="form-control" style="height: 389px;">
                <p class="text-center">Information de facturation</p>
                <div style="border-bottom: solid 1px #e8dfe5;" class="mt-5">
                    <a href="{{route('modification_adresse_entreprise',$entreprise->id)}}" class="">
                        @if($entreprise->adresse_rue== null or $entreprise->adresse_quartier == null or $entreprise->adresse_code_postal == null or $entreprise->adresse_ville == null or $entreprise->adresse_region == null)
                            <p class="p-1 m-0" style="font-size: 12px; color:red;">Adresse<span style="float: right;">incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Adresse<span style="float: right;">{{$entreprise->adresse_rue}} {{$entreprise->adresse_quartier}} {{$entreprise->adresse_code_postal}} {{$entreprise->adresse_ville}} {{$entreprise->adresse_region}}&nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" >
                    <a href="{{route('modification_site_etp_entreprise',$entreprise->id)}}" class="">
                        @if($entreprise->site_etp == NULL)
                            <p class="p-1 m-0" style="font-size: 12px; color:red;">Site web<span style="float: right;">incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Site web<span style="float: right;">{{$entreprise->site_etp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-control" style="height: 389px; ">
                <p class="text-center">Information de taxation</p>
                <div style="border-bottom: solid 1px #e8dfe5;" class="mt-5">
                    @if($referent->assujetti_id == null )
                        <a href="{{route('modification_assujetti_entreprise',$refs->entreprise_id)}}" class="none_">
                            <p class="p-1 m-0" style="font-size: 12px;">Taxation<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        </a>
                    @elseif($referent->assujetti_id == 1)
                        <a href="{{route('modification_assujetti_entreprise',$refs->entreprise_id)}}" class="none_">
                            <p class="p-1 m-0" style="font-size: 12px;">Taxation<span style="float: right;">Assujetti &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        </a>
                    @else
                        <a href="{{route('modification_assujetti_entreprise',$refs->entreprise_id)}}" class="none_">
                            <p class="p-1 m-0" style="font-size: 12px;">Taxation<span style="float: right;">Non assujetti &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        </a>
                    @endif
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    {{-- @if($referent->assujetti_id == null ) --}}
                        <a href="" class="none_">
                            <p class="p-1 m-0" style="font-size: 12px;">TVA<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        </a>
                    {{-- @elseif($referent->assujetti_id == 1)
                        <a href="{{route('modification_assujetti_entreprise',$refs->entreprise_id)}}" class="none_">
                            <p class="p-1 m-0" style="font-size: 12px;">Taxation<span style="float: right;">Assujetti &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        </a>
                    @else
                        <a href="{{route('modification_assujetti_entreprise',$refs->entreprise_id)}}" class="none_">
                            <p class="p-1 m-0" style="font-size: 12px;">Taxation<span style="float: right;">Non assujetti &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        </a>
                    @endif --}}
                </div>
            </div>
        </div>
    </div>

    @endsection
