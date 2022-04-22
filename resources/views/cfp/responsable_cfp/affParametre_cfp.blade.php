@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Affichage du parametre de centre de formation</h3>
@endsection
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
                <p class="text-center">Informations professionnelles</p>

                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a hrefs="#">
                        <p class="p-1 m-0" style="font-size: 12px;">Poste responsable<span style="float: right;">{{$refs->poste_resp}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div> --}}

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('profil_of',$refs->cfp_id)}}">
                        <p class="p-1 m-0" style="font-size: 12px;">ORGANISME DE FORMATION<span style="float: right;">{{$refs->nom_cfp}} &nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>

                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a hrefs="#">
                        <p class="p-1 m-0" style="font-size: 12px;">DEPARTEMENT<span style="float: right;">{{optional(optional($refs)->departement)->nom_departement}}&nbsp;<i class="fas fa-angle-right"></i></span>

                        </p>
                    </a>
                </div> --}}

                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
            </div>
        </div>

        <div class="col-lg-4">

            <div class="form-control">
                <p class="text-center">Informations de facturation</p>
            </div>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
        </div>
        <div class="col-lg-4">
            <div class="form-control">
                <p class="text-center">Informations de taxation</p>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    {{-- <a href="{{route('profil_of',$refs->cfp_id)}}"> --}}
                    <a class="none" href="">
                        <p class="p-1 m-0" style="font-size: 12px;">Taxation<span style="float: right;">Assugetti &nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
                    </a>
                </div>
            </div>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
        </div>
    </div>

    @endsection
