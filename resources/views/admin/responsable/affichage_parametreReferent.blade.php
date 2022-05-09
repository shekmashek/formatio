@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Parametres</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/parametres.css')}}">
<div class="container mt-5">
    <div class="row head_content mb-5">
        <div class="col-3 first_col">
            <div class="row">
                <div class="col-4 logo">
                    <a href="{{route('modification_logo',$entreprise->id)}}">
                        @if($entreprise->logo == NULL )
                            <span class="text-end">
                                <img src="" alt="Logo centre de formation professionnel" >
                            </span>
                        @else
                            <span class="text-end">
                                <img src="{{asset('images/entreprises/'.$entreprise->logo)}}" alt="Logo de l'entreprise" class="img-fluid">
                            </span>
                        @endif
                    </a>
                </div>
                <div class="col-8">
                    <div>
                        @if($entreprise->nom_etp == NULL )
                            <a href="{{route('modification_nom_entreprise',$entreprise->id)}}" class="action_name">Ajouter Nom</a>
                        @else
                            <p class="nom_org">{{$entreprise->nom_etp}}</p>
                        @endif
                        <a href="{{route('modification_nom_entreprise',$entreprise->id)}}" class="action_name">Modifier</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-3 second_col">
            <div class="row text-end p-0">
                <i class='bx bxs-component icon_infos p-0'></i>
            </div>
            <div class="row ps-2 ">
                <p class="nb_modules m-0 p-0">{{count($projets_counts)}}</p>
                <p class="text-muted borderBotom_color p-0 pb-2 text-uppercase">Projets</p>
            </div>
        </div>
        <div class="col-3 second_col">
            <div class="row text-end p-0">
                <i class='bx bxs-user-detail icon_infos p-0'></i>
            </div>
            <div class="row ps-2 ">
                <p class="nb_modules m-0 p-0">{{count($stagiaires_counts)}}</p>
                <p class="text-muted borderBotom_color2 p-0 pb-2 text-uppercase">Stagiaires</p>
            </div>
        </div>
        <div class="col-3 second_col">
            <div class="row text-end p-0">
                <i class='bx bxs-user-pin icon_infos p-0'></i>
            </div>
            <div class="row ps-2 ">
                <p class="nb_modules m-0 p-0">{{count($chef_departements_counts)}}</p>
                <p class="text-muted borderBotom_color3 p-0 pb-2 text-uppercase">Managers</p>
            </div>
        </div>
        <div class="row row_bas g-0">
            <div class="col third_col py-2">
                <p class="text-muted text-center m-1 txt_row_bas">Sessions</p>
                <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($projets_counts)}}</p>
            </div>
            <div class="col third_col py-2">
                <p class="text-muted text-center m-1 txt_row_bas">Modules Internes</p>
                <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($modulesInternes_counts)}}</p>
            </div>
            <div class="col third_col py-2">
                <p class="text-muted text-center m-1 txt_row_bas">Projets inter</p>
                <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($projetInter_counts)}}</p>
            </div>
            <div class="col third_col py-2">
                <p class="text-muted text-center m-1 txt_row_bas">Projet Intra</p>
                <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($projetIntra_counts)}}</p>
            </div>
            <div class="col third_col py-2">
                <p class="text-muted text-center m-1 txt_row_bas">Organisme Collaborés</p>
                <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($cfp_counts)}}</p>
            </div>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-5 info_plus2 p-5 pt-4">
            <h5 class="text-center mb-5">Information Professionnelles</h5>
            <div class="row border_bas">
                <div class="col">
                    @if($entreprise->email_etp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-gmail icon_sociaux'></i>&nbsp;E-mail Incomplète</p><p class="text-end"><a href="{{route('modification_email_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-gmail icon_sociaux'></i>&nbsp;{{$entreprise->email_etp}}</p><p class="text-end"><a href="{{route('modification_email_entreprise',$entreprise->id)}}" class="action_other">Modifier e-mail</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($entreprise->telephone_etp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-calculator icon_sociaux'></i>&nbsp;Téléphone Incomplète</p><p class="text-end"><a href="{{route('modification_telephone_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-calculator icon_sociaux'></i>&nbsp;{{$entreprise->telephone_etp}}</p><p class="text-end"><a href="{{route('modification_telephone_entreprise',$entreprise->id)}}" class="action_other">Modifier Numéro</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($secteur->nom_secteur == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-calculator icon_sociaux'></i>&nbsp;Secteur d'activiter Incomplète</p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-calculator icon_sociaux'></i>&nbsp;{{$secteur->nom_secteur}}</p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($branche == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-calculator icon_sociaux'></i>&nbsp;Branche Incomplète</p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-calculator icon_sociaux'></i>&nbsp;{{$branche->nom_branche}}</p></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-4 info_plus p-5 pt-4">
            <h5 class="text-center mb-5">Facturations</h5>
            <div class="row border_bas">
                <div class="col">
                    @if($entreprise->adresse_quartier == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map icon_sociaux'></i>&nbsp;Adresse Quartier Incomplète</p><p class="text-end"><a href="{{route('modification_adresse_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map icon_sociaux'></i>&nbsp;{{$entreprise->adresse_rue}}&nbsp;{{$entreprise->adresse_quartier}}</p><p class="text-end"><a href="{{route('modification_adresse_entreprise',$entreprise->id)}}" class="action_other">Modifier</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($entreprise->adresse_ville == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map-pin icon_sociaux'></i>&nbsp;Adresse Ville Incomplète</p><p class="text-end"><a href="{{route('modification_adresse_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map-pin icon_sociaux'></i>&nbsp;{{$entreprise->adresse_ville}}&nbsp;{{$entreprise->adresse_code_postal}}</p><p class="text-end"><a href="{{route('modification_adresse_entreprise',$entreprise->id)}}" class="action_other">Modifier Ville</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($entreprise->adresse_region == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-map-alt icon_sociaux'></i>&nbsp;Adresse Region Incomplète</p><p class="text-end"><a href="{{route('modification_adresse_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-map-alt icon_sociaux'></i>&nbsp;{{$entreprise->adresse_region}}</p><p class="text-end"><a href="{{route('modification_adresse_entreprise',$entreprise->id)}}" class="action_other">Modifier Region</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($entreprise->site_etp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-globe icon_sociaux'></i>&nbsp;Site Web Incomplète</p><p class="text-end"><a href="{{route('modification_site_etp_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-globe icon_sociaux'></i>&nbsp;{{$entreprise->site_etp}}</p><p class="text-end"><a href="{{route('modification_site_etp_entreprise',$entreprise->id)}}" class="action_other">Modifier Site Web</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($entreprise->nif == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-sitemap icon_sociaux'></i>&nbsp;NIF Incomplète</p><p class="text-end"><a href="{{route('modification_nif_entreprise',$entreprise->id)}}" class="action_other_not">Compléter NIF</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-sitemap icon_sociaux'></i>&nbsp;{{$entreprise->nif}}</p><p class="text-end"><a href="{{route('modification_nif_entreprise',$entreprise->id)}}" class="action_other">Modifier NIF</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($entreprise->stat == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-align-justify icon_sociaux'></i>&nbsp;STAT Incomplète</p><p class="text-end"><a href="{{route('modification_stat_entreprise',$entreprise->id)}}" class="action_other_not">Compléter STAT</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-align-justify icon_sociaux'></i>&nbsp;{{$entreprise->stat}}</p><p class="text-end"><a href="{{route('modification_stat_entreprise',$entreprise->id)}}" class="action_other">Modifier STAT</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($entreprise->rcs == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-check-shield icon_sociaux'></i>&nbsp;RCS Incomplète</p><p class="text-end"><a href="{{route('modification_rcs_entreprise',$entreprise->id)}}" class="action_other_not">Compléter RCS</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-check-shield icon_sociaux'></i>&nbsp;{{$entreprise->rcs}}</p><p class="text-end"><a href="{{route('modification_rcs_entreprise',$entreprise->id)}}" class="action_other">Modifier RCS</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($entreprise->cif == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-check-shield icon_sociaux'></i>&nbsp;CIF Incomplète</p><p class="text-end"><a href="{{route('modification_cif_entreprise',$entreprise->id)}}" class="action_other_not">Compléter CIF</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-check-shield icon_sociaux'></i>&nbsp;{{$entreprise->cif}}</p><p class="text-end"><a href="{{route('modification_cif_entreprise',$entreprise->id)}}" class="action_other">Modifier CIF</a></p></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-2 info_plus4  pt-4">
            <h5 class="text-center mb-4">Taxation</h5>
            <div class="row border_bas">
                <div class="col text-center">
                    @if($entreprise->assujetti_id == NULL)
                        <div class="p-1 m-0"><p>Assujetti Incomplète</p></div>
                        <div><p class="text-end"><a href="{{route('modification_assujetti_entreprise',$entreprise->id)}}" class="action_other_not">Compléter Assujetti</a></p></div>
                    @elseif($entreprise->assujetti_id == 1)
                        <div class="p-1 m-0"><p>Assujetti</p></div>
                        <div><p class=""><a href="{{route('modification_assujetti_entreprise',$entreprise->id)}}" class="action_other">Modifier Assujetti</a></p></div>
                    @else
                        <div class="p-1 m-0"><p>Non Assujetti</p></div>
                        <div><p class="text-center"><a href="{{route('modification_assujetti_entreprise',$entreprise->id)}}" class="action_other">Modifier Assujetti</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row ">
                <div class="col text-center">
                    <div class="p-1 m-0 mt-2"><p class="mb-2">TVA : @foreach($tva as $tva_cfp) {{$tva_cfp->pourcent}} @endforeach %</p></div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

{{-- <div class="row">
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
                    <a href="{{route('modification_$entreprise',$entreprise->id)}}">
                        <p class="p-1 m-0" style="font-size: 12px;">Nom entreprise<span style="float: right;">{{$entreprise->nom_etp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_email_entreprise',$entreprise->id)}}">
                        @if($entreprise->email_etp==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">E-mail entreprise<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">E-mail entreprise<span style="float: right;">{{$entreprise->email_etp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_telephone_entreprise',$entreprise->id)}}">
                        @if($entreprise->telephone_etp==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">Télephone entreprise<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">Télephone entreprise<span style="float: right;">{{$entreprise->telephone_etp}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_nif_entreprise',$entreprise->id)}}">
                        @if($entreprise->nif==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">NIF<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">NIF<span style="float: right;">{{$entreprise->nif}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_stat_entreprise',$entreprise->id)}}">
                        @if($entreprise->stat==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">STAT<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">STAT<span style="float: right;">{{$entreprise->stat}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_rcs_entreprise',$entreprise->id)}}">
                        @if($entreprise->rcs==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">RCS<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">RCS<span style="float: right;">{{$entreprise->rcs}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @endif
                    </a>
                </div>
                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    <a href="{{route('modification_rcs_entreprise',$entreprise->id)}}">
                        @if($entreprise->cif==NULL)
                            <p class="p-1 m-0" style="font-size: 12px;">CIF<span style="float: right; color:red">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                        @else
                            <p class="p-1 m-0" style="font-size: 12px;">CIF<span style="float: right;">{{$entreprise->cif}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
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

                <div style="border-bottom: solid 1px #e8dfe5;" class="">
                    @if($branche == null )
                        <p class="p-1 m-0" style="font-size: 12px;">Branche<span style="float: right;">aucun<i class="fas fa-angle-right"></i></span></p>
                    @else
                        <p class="p-1 m-0" style="font-size: 12px;">Branche<span style="float: right;">{{$branche->nom_branche}} &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    @endif
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
                    <a href="" class="none_">
                        <p class="p-1 m-0" style="font-size: 12px;">TVA<span style="float: right;">Incomplète &nbsp;<i class="fas fa-angle-right"></i></span></p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    @endsection --}}
