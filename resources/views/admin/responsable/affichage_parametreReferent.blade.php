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
            <a href="{{route('liste_projet')}}">
                <div class="row text-end p-0">
                    <i class='bx bxs-component icon_infos p-0'></i>
                </div>
                <div class="row ps-2 ">
                    <p class="nb_modules m-0 p-0">{{count($projets_counts)}}</p>
                    <p class="text-muted borderBotom_color p-0 pb-2 text-uppercase">Projets</p>
                </div>
            </a>
        </div>
        <div class="col-3 second_col">
            <a href="{{route('liste_participant')}}">
                <div class="row text-end p-0">
                    <i class='bx bxs-user-detail icon_infos2 p-0'></i>
                </div>
                <div class="row ps-2 ">
                    <p class="nb_modules m-0 p-0">{{count($stagiaires_counts)}}</p>
                    <p class="text-muted borderBotom_color2 p-0 pb-2 text-uppercase">Stagiaires</p>
                </div>
            </a>
        </div>
        <div class="col-3 second_col">
            <div class="row text-end p-0">
                <i class='bx bxs-user-pin icon_infos3 p-0'></i>
            </div>
            <div class="row ps-2 ">
                <p class="nb_modules m-0 p-0">{{count($chef_departements_counts)}}</p>
                <p class="text-muted borderBotom_color3 p-0 pb-2 text-uppercase">Managers</p>
            </div>
        </div>
        <div class="row row_bas g-0">
            <div class="col third_col py-2">
                <a href="{{route('liste_projet')}}">
                    <p class="text-muted text-center m-1 txt_row_bas">Sessions</p>
                    <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($projets_counts)}}</p>
                </a>
            </div>
            <div class="col third_col py-2">
                <p class="text-muted text-center m-1 txt_row_bas">Modules Internes</p>
                <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($modulesInternes_counts)}}</p>
            </div>
            <div class="col third_col py-2">
                <a href="{{route('liste_projet')}}">
                    <p class="text-muted text-center m-1 txt_row_bas">Projets inter</p>
                    <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($projetInter_counts)}}</p>
                </a>
            </div>
            <div class="col third_col py-2">
                <a href="{{route('liste_projet')}}">
                    <p class="text-muted text-center m-1 txt_row_bas">Projet Intra</p>
                    <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($projetIntra_counts)}}</p>
                </a>
            </div>
            <div class="col third_col py-2">
                <a href="{{route('list_cfp')}}">
                    <p class="text-muted text-center m-1 txt_row_bas">Organisme Collaborés</p>
                    <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($cfp_counts)}}</p>
                </a>
            </div>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-5 info_plus2 p-5 pt-4">
            <h5 class="text-center mb-5">Information Professionnelles</h5>
            <div class="row border_bas">
                <div class="col">
                    @if($entreprise->email_etp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-gmail icon_sociaux1'></i>&nbsp;E-mail Incomplète</p><p class="text-end"><a href="{{route('modification_email_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxl-gmail icon_sociaux1'></i>&nbsp;{{$entreprise->email_etp}}</p><p class="text-end"><a href="{{route('modification_email_entreprise',$entreprise->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($entreprise->telephone_etp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-calculator icon_sociaux1'></i>&nbsp;Téléphone Incomplète</p><p class="text-end"><a href="{{route('modification_telephone_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-calculator icon_sociaux1'></i>&nbsp;{{$entreprise->telephone_etp}}</p><p class="text-end"><a href="{{route('modification_telephone_entreprise',$entreprise->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($secteur->nom_secteur == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-intersect icon_sociaux1'></i>&nbsp;Secteur d'activiter Incomplète</p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-intersect icon_sociaux1'></i>&nbsp;{{$secteur->nom_secteur}}</p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($branche == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-category-alt icon_sociaux1'></i>&nbsp;Branche Incomplète</p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxs-category-alt icon_sociaux1'></i>&nbsp;{{$branche->nom_branche}}</p></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-4 info_plus p-5 pt-4">
            <h5 class="text-center mb-5">Facturations</h5>
            <div class="row border_bas">
                <div class="col">
                    @if($entreprise->adresse_quartier == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map icon_sociaux2'></i>&nbsp;Adresse Quartier Incomplète</p><p class="text-end"><a href="{{route('modification_adresse_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxs-map icon_sociaux2'></i>&nbsp;{{$entreprise->adresse_rue}}&nbsp;{{$entreprise->adresse_quartier}}</p><p class="text-end"><a href="{{route('modification_adresse_entreprise',$entreprise->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($entreprise->adresse_ville == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map-pin icon_sociaux2'></i>&nbsp;Adresse Ville Incomplète</p><p class="text-end"><a href="{{route('modification_adresse_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxs-map-pin icon_sociaux2'></i>&nbsp;{{$entreprise->adresse_ville}}&nbsp;{{$entreprise->adresse_code_postal}}</p><p class="text-end"><a href="{{route('modification_adresse_entreprise',$entreprise->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($entreprise->adresse_region == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-map-alt icon_sociaux2'></i>&nbsp;Adresse Region Incomplète</p><p class="text-end"><a href="{{route('modification_adresse_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-map-alt icon_sociaux2'></i>&nbsp;{{$entreprise->adresse_region}}</p><p class="text-end"><a href="{{route('modification_adresse_entreprise',$entreprise->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($entreprise->site_etp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-globe icon_sociaux2'></i>&nbsp;Site Web Incomplète</p><p class="text-end"><a href="{{route('modification_site_etp_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-globe icon_sociaux2'></i>&nbsp;{{$entreprise->site_etp}}</p><p class="text-end"><a href="{{route('modification_site_etp_entreprise',$entreprise->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($entreprise->nif == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-sitemap icon_sociaux3'></i>&nbsp;Numéro d'Identification Fiscale Incomplète (NIF)</p><p class="text-end"><a href="{{route('modification_nif_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-sitemap icon_sociaux3'></i>NIF :&nbsp;{{$entreprise->nif}}</p><p class="text-end"><a href="{{route('modification_nif_entreprise',$entreprise->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($entreprise->stat == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-align-justify icon_sociaux3'></i>&nbsp;Statistiques Incomplète (STAT)</p><p class="text-end"><a href="{{route('modification_stat_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-align-justify icon_sociaux3'></i>STAT :&nbsp;{{$entreprise->stat}}</p><p class="text-end"><a href="{{route('modification_stat_entreprise',$entreprise->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($entreprise->rcs == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-check-shield icon_sociaux3'></i>&nbsp;Registre du Commerce et des Sociétés Incomplète (RCS)</p><p class="text-end"><a href="{{route('modification_rcs_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxs-check-shield icon_sociaux3'></i>RCS :&nbsp;{{$entreprise->rcs}}</p><p class="text-end"><a href="{{route('modification_rcs_entreprise',$entreprise->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($entreprise->cif == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-check-shield icon_sociaux3'></i>&nbsp;Cérticat d'Identification Fiscale Incomplète (CIF)</p><p class="text-end"><a href="{{route('modification_cif_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-check-shield icon_sociaux3'></i>CIF :&nbsp;{{$entreprise->cif}}</p><p class="text-end"><a href="{{route('modification_cif_entreprise',$entreprise->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-2 info_plus4  pt-4">
            <h5 class="text-center mb-4">Taxation</h5>
            <div class="row border_bas">
                <div class="col text-center afficher_icon_modif">
                    @if($entreprise->assujetti_id == NULL)
                        <div class="p-1 m-0"><p>Assujetti Incomplète</p></div>
                        <div><p class="text-end"><a href="{{route('modification_assujetti_entreprise',$entreprise->id)}}" class="action_other_not">Compléter</a></p></div>
                    @elseif($entreprise->assujetti_id == 1)
                        <div class="p-1 m-0"><p>Assujetti</p></div>
                        <div><p class=""><a href="{{route('modification_assujetti_entreprise',$entreprise->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @else
                        <div class="p-1 m-0"><p>Non Assujetti</p></div>
                        <div><p class="text-center"><a href="{{route('modification_assujetti_entreprise',$entreprise->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
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


