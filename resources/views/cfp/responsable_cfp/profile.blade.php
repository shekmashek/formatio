
@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Parametres</h3>
@endsection
@inject('groupe', 'App\groupe')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/parametres.css')}}">
<div class="container mt-5">
    <div class="row head_content mb-5">
        <div class="col-3 first_col">
            <div class="row">
                <div class="col-4 logo">
                    <a href="{{route('modification_photo',$refs->id)}}">
                        @if($refs->photos_resp_cfp == NULL )
                        <span>
                            <div style="display: grid; place-content: center">
                                <div class='randomColor photo_users '>
                                </div>
                            </div>
                        </span>
                        @else
                            <span class="text-end">
                                <img src="{{asset('images/responsables/'.$refs->photos_resp_cfp)}}" alt="image du responsable" class="img-fluid rounded-circle">
                            </span>
                        @endif
                    </a>
                </div>
                <div class="col-8">
                    <div>
                        @if($refs->nom_resp_cfp == NULL )
                            <a href="{{route('modification_nom',$refs->id)}}" class="action_name">Ajouter Nom</a>
                        @else
                            <p class="nom_org">{{$refs->nom_resp_cfp}}</p>
                            <p class="">{{$refs->prenom_resp_cfp}}</p>
                        @endif
                        <a href="{{route('modification_nom',$refs->id)}}" class="action_name">Modifier</a>
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
        <div class="col-5 info_plus2 p-5 pt-4">
            <h5 class="text-center mb-5">Information Générale</h5>
            <div class="row border_bas">
                <div class="col">
                    @if($refs->date_naissance_resp_cfp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-calendar-alt icon_sociaux1'></i>&nbsp;Date de naissance</p><p class="text-end"><a href="{{route('modification_date_de_naissance',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-calendar-alt icon_sociaux2'></i>Date de naissance :&nbsp;{{$refs->date_naissance_resp_cfp}}</p><p class="text-end"><a href="{{route('modification_date_de_naissance',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas">
                <div class="col">
                    @if($refs->genre == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-user-pin icon_sociaux1'></i>&nbsp;Genre</p><p class="text-end"><a href="{{route('modification_genre',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-user-pin icon_sociaux1'></i>Genre :&nbsp;{{$refs->genre}}</p><p class="text-end"><a href="{{route('modification_genre',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas">
                <div class="col">
                    @if($refs->email_resp_cfp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-gmail icon_sociaux1'></i>&nbsp;Email</p><p class="text-end"><a href="{{route('modification_email',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxl-gmail icon_sociaux1'></i>Email :&nbsp;{{$refs->email_resp_cfp}}</p><p class="text-end"><a href="{{route('modification_email',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas">
                <div class="col">
                    @if($refs->telephone_resp_cfp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-phone icon_sociaux1'></i>&nbsp;Téléphone</p><p class="text-end"><a href="{{route('modification_telephone',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-phone icon_sociaux1'></i>Téléphone :&nbsp;{{$refs->telephone_resp_cfp}}</p><p class="text-end"><a href="{{route('modification_telephone',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-lock icon_sociaux1'></i>Mot de passe :  **************</p><p class="text-end"><a href="{{route('modification_mdp',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                </div>
            </div>
        </div>
        <div class="col-4 info_plus2 p-5 pt-4">
            <h5 class="text-center mb-5">Coordonnées</h5>
            <div class="row border_bas">
                <div class="col">
                    @if($refs->cin_resp_cfp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-grid-vertical icon_sociaux3'></i>&nbsp;CIN</p><p class="text-end"><a href="{{route('modification_cin',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-grid-vertical icon_sociaux3'></i>CIN :&nbsp;{{$refs->cin_resp_cfp}}</p><p class="text-end"><a href="{{route('modification_cin',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas">
                <div class="col">
                    @if($refs->adresse_quartier == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map icon_sociaux2'></i>&nbsp;Adresse Quartier</p><p class="text-end"><a href="{{route('modificationn_adresse',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxs-map icon_sociaux2'></i>&nbsp;{{$refs->adresse_lot}}&nbsp;{{$refs->adresse_quartier}}</p><p class="text-end"><a href="{{route('modificationn_adresse',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($refs->adresse_ville == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map-pin icon_sociaux2'></i>&nbsp;Adresse Ville</p><p class="text-end"><a href="{{route('modificationn_adresse',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxs-map-pin icon_sociaux2'></i>&nbsp;{{$refs->adresse_ville}}&nbsp;{{$refs->adresse_code_postal}}</p><p class="text-end"><a href="{{route('modificationn_adresse',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($refs->adresse_region == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-map-alt icon_sociaux2'></i>&nbsp;Adresse Region</p><p class="text-end"><a href="{{route('modificationn_adresse',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-map-alt icon_sociaux2'></i>&nbsp;{{$refs->adresse_region}}</p><p class="text-end"><a href="{{route('modificationn_adresse',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>

        </div>
        <div class="col-2 info_plus5  pt-4">
            <h5 class="text-center mb-4">Oganisme de formation</h5>
            <div class="row ">
                <div class="col text-center ">
                    @if($cfps->logo == NULL )
                        <span class="text-end">
                            <img src="" alt="Logo centre de formation professionnel" >
                        </span>
                    @else
                        <span class="text-end">
                            <img src="{{asset('images/CFP/'.$cfps->logo)}}" alt="Logo de l'entreprise" class="img-fluid">
                        </span>
                    @endif
                    <p class="mt-4">{{$refs->nom_cfp}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
