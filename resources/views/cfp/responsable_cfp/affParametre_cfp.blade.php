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
                    <a href="{{route('modification_logo_cfp',$cfps->id)}}">
                        @if($cfps->logo == NULL )
                            <span class="text-end">
                                <img src="" alt="Logo centre de formation professionnel" >
                            </span>
                        @else
                            <span class="text-end">
                                <img src="{{asset('images/CFP/'.$cfps->logo)}}" alt="Logo centre de formation professionnel" class="img-fluid">
                            </span>
                        @endif
                    </a>
                </div>
                <div class="col-8">
                    <div>
                        @if($cfps->nom == NULL )
                            <a href="{{route('modification_nom_organisme',$cfps->id)}}" class="action_name">Ajouter Nom</a><br>
                        @else
                            <p class="nom_org">{{$cfps->nom}}</p>
                        @endif
                        @if($cfps->slogan == NULL )
                            <a href="{{route('modification_nom_organisme',$cfps->id)}}" class="action_name">Ajouter Slogan</a>
                        @else
                            <p>{{$cfps->slogan}}</p>
                        @endif
                        <a href="{{route('modification_nom_organisme',$cfps->id)}}" class="action_name">Modifier</a>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-3 second_col">
            <a href="{{route('liste_module')}}">
                <div class="row text-end p-0">
                    <i class='bx bxs-customize icon_infos p-0'></i>
                </div>
                <div class="row ps-2 ">
                    <p class="nb_modules m-0 p-0">{{count($modules_counts)}}</p>
                    <p class="text-muted borderBotom_color p-0 pb-2 text-uppercase">Modules</p>
                </div>
            </a>
        </div>
        <div class="col-3 second_col">
            <a href="{{route('liste_projet')}}">
                <div class="row text-end p-0">
                    <i class='bx bxs-component icon_infos2 p-0'></i>
                </div>
                <div class="row ps-2 ">
                    <p class="nb_modules m-0 p-0">{{count($projets_counts)}}</p>
                    <p class="text-muted borderBotom_color2 p-0 pb-2 text-uppercase">Projets</p>
                </div>
            </a>
        </div>
        <div class="col-3 second_col">
            <a href="{{route('liste_facture')}}">
                <div class="row text-end p-0">
                    <i class='bx bxs-receipt icon_infos3 p-0'></i>
                </div>
                <div class="row ps-2 ">
                    <p class="nb_modules m-0 p-0">{{count($factures_counts)}}</p>
                    <p class="text-muted borderBotom_color3 p-0 pb-2 text-uppercase">Factures</p>
                </div>
            </a>
        </div>
        <div class="row row_bas g-0">
            <div class="col third_col py-2">
                <a href="{{route('liste_projet')}}">
                    <p class="text-muted text-center m-1 txt_row_bas">Sessions</p>
                    <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($sessions_counts)}}</p>
                </a>
                </div>
            <div class="col third_col py-2">
                <a href="{{route('liste_projet')}}">
                    <p class="text-muted text-center m-1 txt_row_bas">Projets Intra</p>
                    <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($projetIntra_counts)}}</p>
                </a>
                </div>
            <div class="col third_col py-2">
                <a href="{{route('liste_projet')}}">
                    <p class="text-muted text-center m-1 txt_row_bas">Projets inter</p>
                    <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($projetInter_counts)}}</p>
                </a>
                </div>
            <div class="col third_col py-2">
                <a href="{{route('liste_formateur')}}">
                    <p class="text-muted text-center m-1 txt_row_bas">Formateurs Collaborés</p>
                    <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($formateurs_counts)}}</p>
                </a>
                </div>
            <div class="col third_col py-2">
                <a href="{{route('liste_entreprise')}}">
                    <p class="text-muted text-center m-1 txt_row_bas">Entreprises Collaborés</p>
                    <p class="text-center nb_modules text-muted txt_row_bas m-0">{{count($entreprises_counts)}}</p>
                </a>
            </div>
        </div>
    </div>

    <div class="row justify-content-between">
        <div class="col-5 info_plus p-5 pt-4">
        <h5 class="text-center mb-5">Information Professionnelles</h5>
            <div class="row border_bas">
                <div class="col">
                    @if($cfps->email == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-gmail icon_sociaux'></i>&nbsp;E-mail Incomplète</p><p class="text-end"><a href="{{route('modification_email',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-gmail icon_sociaux'></i>&nbsp;{{$cfps->email}}</p><p class="text-end"><a href="{{route('modification_email',$cfps->id)}}" class="action_other">Modifier e-mail</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($cfps->telephone == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-calculator icon_sociaux'></i>&nbsp;Téléphone Incomplète</p><p class="text-end"><a href="{{route('modification_telephone',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-calculator icon_sociaux'></i>&nbsp;{{$cfps->telephone}}</p><p class="text-end"><a href="{{route('modification_telephone',$cfps->id)}}" class="action_other">Modifier Numéro</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($reseaux_sociaux != null)
                        @if($reseaux_sociaux[0]->lien_facebook == NULL)
                            <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-facebook-circle icon_sociaux'></i>&nbsp;Facebook Incomplète</p><p class="text-end"><a href="{{route('lien_facebook',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                        @else
                            <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-facebook-circle icon_sociaux'></i>&nbsp;{{$reseaux_sociaux[0]->lien_facebook}}</p><p class="text-end"><a href="{{route('lien_facebook',$cfps->id)}}" class="action_other">Modifier</a></p></div>
                        @endif
                    @else
                    <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-facebook-circle icon_sociaux'></i>&nbsp;Réseaux sociaux Incomplète</p><p class="text-end"><a href="{{route('lien_facebook',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($reseaux_sociaux != null)
                        @if($reseaux_sociaux[0]->lien_twitter == NULL)
                            <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-twitter icon_sociaux'></i>&nbsp;Twitter Incomplète</p><p class="text-end"><a href="{{route('lien_twitter',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                        @else
                            <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-twitter icon_sociaux'></i>&nbsp;{{$reseaux_sociaux[0]->lien_twitter}}</p><p class="text-end"><a href="{{route('lien_twitter',$cfps->id)}}" class="action_other">Modifier</a></p></div>
                        @endif
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-twitter icon_sociaux'></i>&nbsp;Réseaux sociaux Incomplète</p><p class="text-end"><a href="{{route('lien_twitter',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($reseaux_sociaux != null)
                        @if($reseaux_sociaux[0]->lien_instagram == NULL)
                            <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-instagram-alt icon_sociaux'></i>&nbsp;Instagram Incomplète</p><p class="text-end"><a href="{{route('lien_instagram',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                        @else
                            <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-instagram-alt icon_sociaux'></i>&nbsp;{{$reseaux_sociaux[0]->lien_instagram}}</p><p class="text-end"><a href="{{route('lien_instagram',$cfps->id)}}" class="action_other">Modifier</a></p></div>
                        @endif
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-instagram-alt icon_sociaux'></i>&nbsp;Réseaux sociaux Incomplète</p><p class="text-end"><a href="{{route('lien_instagram',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($reseaux_sociaux != null)
                        @if($reseaux_sociaux[0]->lien_linkedin == NULL)
                            <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-linkedin-square icon_sociaux'></i>&nbsp;Linkedin Incomplète</p><p class="text-end"><a href="{{route('lien_linkedin',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                        @else
                            <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-linkedin-square icon_sociaux'></i>&nbsp;{{$reseaux_sociaux[0]->lien_linkedin}}</p><p class="text-end"><a href="{{route('lien_linkedin',$cfps->id)}}" class="action_other">Modifier</a></p></div>
                        @endif
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-linkedin-square icon_sociaux'></i>&nbsp;Réseaux sociaux Incomplète</p><p class="text-end"><a href="{{route('lien_linkedin',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-4 info_plus p-5 pt-4">
            <h5 class="text-center mb-5">Facturations</h5>
            <div class="row border_bas">
                <div class="col">
                    @if($cfps->adresse_quartier == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map icon_sociaux'></i>&nbsp;Adresse Quartier Incomplète</p><p class="text-end"><a href="{{route('modification_adresse_organisme',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map icon_sociaux'></i>&nbsp;{{$cfps->adresse_lot}}&nbsp;{{$cfps->adresse_quartier}}</p><p class="text-end"><a href="{{route('modification_adresse_organisme',$cfps->id)}}" class="action_other">Modifier</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($cfps->adresse_ville == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map-pin icon_sociaux'></i>&nbsp;Adresse Ville Incomplète</p><p class="text-end"><a href="{{route('modification_adresse_organisme',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map-pin icon_sociaux'></i>&nbsp;{{$cfps->adresse_ville}}</p><p class="text-end"><a href="{{route('modification_adresse_organisme',$cfps->id)}}" class="action_other">Modifier</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($cfps->adresse_region == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-map-alt icon_sociaux'></i>&nbsp;Adresse Region Incomplète</p><p class="text-end"><a href="{{route('modification_adresse_organisme',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-map-alt icon_sociaux'></i>&nbsp;{{$cfps->adresse_region}}</p><p class="text-end"><a href="{{route('modification_adresse_organisme',$cfps->id)}}" class="action_other">Modifier</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($cfps->site_web == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-globe icon_sociaux'></i>&nbsp;Site Web Incomplète</p><p class="text-end"><a href="{{route('modification_site_web',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-globe icon_sociaux'></i>&nbsp;{{$cfps->site_web}}</p><p class="text-end"><a href="{{route('modification_site_web',$cfps->id)}}" class="action_other">Modifier</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($cfps->nif == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-sitemap icon_sociaux'></i>&nbsp;Numéro d'Identification Fiscale Incomplète (NIF)</p><p class="text-end"><a href="{{route('modification_nif',$cfps->id)}}" class="action_other_not">Compléter NIF</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-sitemap icon_sociaux'></i>&nbsp;{{$cfps->nif}}</p><p class="text-end"><a href="{{route('modification_nif',$cfps->id)}}" class="action_other">Modifier NIF</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($cfps->stat == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-align-justify icon_sociaux'></i>&nbsp;Statistiques Incomplète (STAT)</p><p class="text-end"><a href="{{route('modification_stat',$cfps->id)}}" class="action_other_not">Compléter STAT</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-align-justify icon_sociaux'></i>&nbsp;{{$cfps->stat}}</p><p class="text-end"><a href="{{route('modification_stat',$cfps->id)}}" class="action_other">Modifier STAT</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($cfps->rcs == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-check-shield icon_sociaux'></i>&nbsp;Registre du Commerce et des Sociétés Incomplète (RCS)</p><p class="text-end"><a href="{{route('modification_rcs_cfps',$cfps->id)}}" class="action_other_not">Compléter RCS</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-check-shield icon_sociaux'></i>&nbsp;{{$cfps->rcs}}</p><p class="text-end"><a href="{{route('modification_rcs_cfps',$cfps->id)}}" class="action_other">Modifier RCS</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($cfps->cif == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-check-shield icon_sociaux'></i>&nbsp;Cérticat d'Identification Fiscale Incomplète (CIF)</p><p class="text-end"><a href="{{route('modification_cif_cfps',$cfps->id)}}" class="action_other_not">Compléter CIF</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-check-shield icon_sociaux'></i>&nbsp;{{$cfps->cif}}</p><p class="text-end"><a href="{{route('modification_cif_cfps',$cfps->id)}}" class="action_other">Modifier CIF</a></p></div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-2 info_plus3  pt-4">
            <h5 class="text-center mb-4">Taxation</h5>
            <div class="row border_bas">
                <div class="col text-center">
                    @if($cfps->assujetti_id == NULL)
                        <div class="p-1 m-0"><p>Assujetti Incomplète</p></div>
                        <div><p class="text-end"><a href="{{route('modification_assujetti_cfp',$cfps->id)}}" class="action_other_not">Compléter Assujetti</a></p></div>
                    @elseif($cfps->assujetti_id == 1)
                        <div class="p-1 m-0"><p>Assujetti</p></div>
                        <div><p class=""><a href="{{route('modification_assujetti_cfp',$cfps->id)}}" class="action_other">Modifier Assujetti</a></p></div>
                    @else
                        <div class="p-1 m-0"><p>Non Assujetti</p></div>
                        <div><p class="text-center"><a href="{{route('modification_assujetti_cfp',$cfps->id)}}" class="action_other">Modifier Assujetti</a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas">
                <div class="col text-center">
                    <div class="p-1 m-0 mt-2"><p class="mb-2">TVA : @foreach($tva as $tva_cfp) {{$tva_cfp->pourcent}} @endforeach %</p></div>
                </div>
            </div>
            <h5 class="text-center mb-3 mt-3">Heures d'Ouvertures</h5>
            <div class="row">
                <div class="col text-center">
                    @if($horaire == NULL)
                        <div class="p-1 m-0"><p>Heures Incomplète</p></div>
                        <div><p class=""><a href="{{route('modification_horaire',$cfps->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        @for($i = 0;$i < count($horaire);$i++)
                            <div class="p-1 m-0 d-flex flex-row justify-content-between"><p class="p-1 m-0 text-capitalize text-start">{{ $horaire[$i]->jours}}</p><p class="m-0 mt-1 text-end"> @php echo (date('H:i', strtotime($horaire[$i]->h_entree))." - ".date('H:i', strtotime($horaire[$i]->h_sortie))) @endphp</p></div>
                        @endfor
                        <div class="mt-3"><p class="text-center"><a href="{{route('modification_horaire',$cfps->id)}}" class="action_other">Modifier Heures</a></p></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
