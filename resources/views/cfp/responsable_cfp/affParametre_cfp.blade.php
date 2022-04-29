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
                <div class="d-flex align-items-center justify-content-between hover" style="border-bottom: solid 1px #e8dfe5;">
                    <div>
                        <p class="p-1 m-0" style="font-size: 12px;">Logo</p>
                    </div>
                    <div class="text-end">
                        <a href="{{route('modification_logo_cfp',$cfps->id)}}">
                        @if($cfps->logo == NULL )
                            <span class="text-end">
                                <img src="" alt="Logo centre de formation professionnel" width="50%" height="50%">
                            </span>
                        @else
                            <span class="text-end">
                                <img src="{{asset('images/CFP/'.$cfps->logo)}}" width="50%" height="50%" class="">
                            </span>
                            @endif
                        </a>
                    </div>
                </div>

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_nom_organisme',$cfps->id)}}">
                        <p class="p-1 m-0" style="font-size: 12px;">Nom de l'organisme<span style="float: right;">{{$cfps->nom}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_email',$cfps->id)}}">
                        @if($cfps->email==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">E-mail<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">E-mail<span style="float: right;">{{$cfps->email}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_telephone',$cfps->id)}}">
                        @if($cfps->telephone==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">Télephone<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Télephone<span style="float: right;">{{$cfps->telephone}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_horaire',$cfps->id)}}">
                        @if($horaire==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">Horaire d'ouverture<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            @for($i = 0;$i < count($horaire);$i++)
                                <p class="p-1 m-0" style="font-size: 12px;">Horaire d'ouverture<span style="float: right;">{{ $horaire[$i]->jours}} : @php echo (date('H:i', strtotime($horaire[$i]->h_entree))." - ".date('H:i', strtotime($horaire[$i]->h_sortie))) @endphp &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            @endfor
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                        @if($reseaux_sociaux == NULL)
                            <a href="{{route('lien_facebook',$cfps->id)}}">
                                <p class="p-1 m-0" style="font-size: 12px;">Facebook<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a>
                            <a href="{{route('lien_twitter',$cfps->id)}}">
                                <p class="p-1 m-0" style="font-size: 12px;">Twitter<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a>
                            <a href="{{route('lien_instagram',$cfps->id)}}">
                                <p class="p-1 m-0" style="font-size: 12px;">Instagram<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a>
                            <a href="{{route('lien_linkedin',$cfps->id)}}">
                                <p class="p-1 m-0" style="font-size: 12px;">Linkedin<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a>
                            @else
                                @if($reseaux_sociaux[0]->lien_facebook==null)
                                    <a href="{{route('lien_facebook',$cfps->id)}}">
                                        <p class="p-1 m-0" style="font-size: 12px;">Facebook<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @else
                                    <a href="{{route('lien_facebook',$cfps->id)}}">
                                        <p class="p-1 m-0" style="font-size: 12px;">Facebook<span style="float: right;">{{$reseaux_sociaux[0]->lien_facebook}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @endif
                                @if($reseaux_sociaux[0]->lien_twitter==null)
                                    <a href="{{route('lien_twitter',$cfps->id)}}">
                                        <p class="p-1 m-0" style="font-size: 12px;">Twitter<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @else
                                    <a href="{{route('lien_twitter',$cfps->id)}}">
                                        <p class="p-1 m-0" style="font-size: 12px;">Twitter<span style="float: right;">{{$reseaux_sociaux[0]->lien_twitter}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @endif
                                @if($reseaux_sociaux[0]->lien_instagram==null)
                                    <a href="{{route('lien_instagram',$cfps->id)}}">
                                        <p class="p-1 m-0" style="font-size: 12px;">Instagram<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @else
                                    <a href="{{route('lien_instagram',$cfps->id)}}">
                                        <p class="p-1 m-0" style="font-size: 12px;">Instagram<span style="float: right;">{{$reseaux_sociaux[0]->lien_instagram}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @endif
                                @if($reseaux_sociaux[0]->lien_linkedin==null)
                                    <a href="{{route('lien_linkedin',$cfps->id)}}">
                                        <p class="p-1 m-0" style="font-size: 12px;">Linkedin<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @else
                                    <a href="{{route('lien_linkedin',$cfps->id)}}">
                                        <p class="p-1 m-0" style="font-size: 12px;">Linkedin<span style="float: right;">{{$reseaux_sociaux[0]->lien_linkedin}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                                    </a>
                                @endif
                        @endif
                </div>


                
                {{-- <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('profil_of',$refs->cfp_id)}}">
                        <p class="p-1 m-0" style="font-size: 12px;">ORGANISME DE FORMATION<span style="float: right;">{{$refs->nom_cfp}} &nbsp;<i class="fas fa-angle-right"></i></span>
                        </p>
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

        <div class="col-lg-4">

            <div class="form-control" style="height:324px">
                <p class="text-center">Informations de facturation</p>
                <div style="border-bottom: solid 1px #e8dfe5;" class="mt-5">
                    <a href="{{route('modification_adresse_organisme',$cfps->id)}}" class="">
                        @if($cfps->adresse_quartier== null)
                            <p class="p-1 m-0" style="font-size: 12px; color:red;">Adresse<span style="float: right;">incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Adresse<span style="float: right;">{{$cfps->adresse_quartier}}&nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('modification_adresse_organisme',$cfps->id)}}" class="">
                        @if($cfps->adresse_ville== null)
                            <p class="p-1 m-0" style="font-size: 12px; color:red;">Adresse ville<span style="float: right;">incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Adresse ville<span style="float: right;">{{$cfps->adresse_ville}}&nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;">
                    <a href="{{route('modification_adresse_organisme',$cfps->id)}}" class="">
                        @if($cfps->adresse_region== null)
                            <p class="p-1 m-0" style="font-size: 12px; color:red;">Adresse région<span style="float: right;">incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Adresse région<span style="float: right;">{{$cfps->adresse_region}}&nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" >
                    <a href="{{route('modification_site_web',$cfps->id)}}" class="">
                        @if($cfps->site_web == NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">Site web officiel<span style="float: right; color:red;">incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Site web officiel<span style="float: right;">{{$cfps->site_web}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
            </div>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
        </div>
        <div class="col-lg-4">
            <div class="form-control" style="height:324px">
                <p class="text-center">Informations de taxation</p>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    {{-- <a href="{{route('profil_of',$refs->cfp_id)}}"> --}}
                        @if($cfps->assujetti_id == null )
                            <a href="{{route('modification_assujetti_cfp',$cfps->id)}}" class="none_">
                                <p class="p-1 m-0" style="font-size: 12px; ">Taxation<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a>
                        @elseif($cfps->assujetti_id == 1)
                            <a href="{{route('modification_assujetti_cfp',$cfps->id)}}" class="none_">
                                <p class="p-1 m-0" style="font-size: 12px;">Taxation<span style="float: right;">Assujetti &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a>
                        @else
                            <a href="{{route('modification_assujetti_cfp',$cfps->id)}}" class="none_">
                                <p class="p-1 m-0" style="font-size: 12px;">Taxation<span style="float: right;">Non assujetti &nbsp;<i class="fas fa-angle-right"></i></span></p>
                            </a>
                        @endif
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                        <a href="" class="none_">
                            <p class="p-1 m-0" style="font-size: 12px;">TVA en pourcentage (%)<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        </a>
                </div>
            </div>
            <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
        </div>
    </div>

    @endsection
