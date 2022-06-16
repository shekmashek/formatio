
@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Parametres</h3>
@endsection
@inject('groupe','App\groupe')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/parametres.css')}}">
<div class="container mt-5">
    <div class="row head_content mb-5">
        <div class="col-3 first_col">
            <div class="row">
                <div class="col-4 logo">
                    <a href="{{route('edit_photos_resp',$refs->id)}}">
                        @if($refs->photos == NULL )
                        <span>
                            <div style="display: grid; place-content: center">
                                <div class='randomColor photo_users '>
                                </div>
                            </div>
                        </span>
                        @else
                            <span class="text-end">
                                <img src="{{asset('images/responsables/'.$refs->photos)}}" alt="image du responsable" class="img-fluid rounded-circle">
                            </span>
                        @endif
                    </a>
                </div>
                <div class="col-8">
                    <div>
                        @if($refs->nom_resp == NULL )
                            <a href="{{route('edit_nom_resp',$refs->id)}}" class="action_name">Ajouter Nom</a>
                        @else
                            <p class="nom_org flex-wrap">{{$refs->nom_resp}}</p>
                            <p class="">{{$refs->prenom_resp}}</p>
                        @endif
                        <a href="{{route('edit_nom_resp',$refs->id)}}" class="action_name">Modifier</a>
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
            <a href="{{route('employes.liste')}}">
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
            <h5 class="text-center mb-5">Information Générale</h5>
            <div class="row border_bas">
                <div class="col">
                    @if($refs->date_naissance_resp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-calendar-alt icon_sociaux1'></i>&nbsp;Date de naissance Incomplète</p><p class="text-end"><a href="{{route('edit_naissance_resp',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-calendar-alt icon_sociaux2'></i>Date de naissance :&nbsp;{{$refs->date_naissance_resp}}</p><p class="text-end"><a href="{{route('edit_naissance_resp',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas">
                <div class="col">
                    @if($refs->sexe_resp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-user-pin icon_sociaux1'></i>&nbsp;Genre Incomplète</p><p class="text-end"><a href="{{route('edit_genre_resp',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-user-pin icon_sociaux1'></i>Genre :&nbsp;{{$refs->sexe_resp}}</p><p class="text-end"><a href="{{route('edit_genre_resp',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas">
                <div class="col">
                    @if($refs->email_resp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxl-gmail icon_sociaux1'></i>&nbsp;Email Incomplète</p><p class="text-end"><a href="{{route('edit_mail_resp',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxl-gmail icon_sociaux1'></i>Email :&nbsp;{{$refs->email_resp}}</p><p class="text-end"><a href="{{route('edit_mail_resp',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas">
                <div class="col">
                    @if($refs->telephone_resp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-phone icon_sociaux1'></i>&nbsp;Téléphone Incomplète</p><p class="text-end"><a href="{{route('edit_phone_resp',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-phone icon_sociaux1'></i>Téléphone :&nbsp;{{$refs->telephone_resp}}</p><p class="text-end"><a href="{{route('edit_phone_resp',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-lock icon_sociaux1'></i>Mot de passe :  **************</p><p class="text-end"><a href="{{route('edit_pwd_resp',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                </div>
            </div>
        </div>
        <div class="col-4 info_plus2 p-5 pt-4">
            <h5 class="text-center mb-5">Coordonnées</h5>
            <div class="row border_bas">
                <div class="col">
                    @if($refs->cin_resp == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-grid-vertical icon_sociaux3'></i>&nbsp;CIN Incomplète</p><p class="text-end"><a href="{{route('edit_cin_resp',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-grid-vertical icon_sociaux3'></i>CIN :&nbsp;{{$refs->cin_resp}}</p><p class="text-end"><a href="{{route('edit_cin_resp',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas">
                <div class="col">
                    @if($refs->adresse_quartier == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map icon_sociaux2'></i>&nbsp;Adresse Quartier Incomplète</p><p class="text-end"><a href="{{route('edit_adresse_resp',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxs-map icon_sociaux2'></i>&nbsp;{{$refs->adresse_lot}}&nbsp;{{$refs->adresse_quartier}}</p><p class="text-end"><a href="{{route('edit_adresse_resp',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row border_bas mt-3">
                <div class="col">
                    @if($refs->adresse_ville == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bxs-map-pin icon_sociaux2'></i>&nbsp;Adresse Ville Incomplète</p><p class="text-end"><a href="{{route('edit_adresse_resp',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxs-map-pin icon_sociaux2'></i>&nbsp;{{$refs->adresse_ville}}&nbsp;{{$refs->adresse_code_postal}}</p><p class="text-end"><a href="{{route('edit_adresse_resp',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col">
                    @if($refs->adresse_region == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row"><p><i class='bx bx-map-alt icon_sociaux2'></i>&nbsp;Adresse Region Incomplète</p><p class="text-end"><a href="{{route('edit_adresse_resp',$refs->id)}}" class="action_other_not">Compléter</a></p></div>
                    @else
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-map-alt icon_sociaux2'></i>&nbsp;{{$refs->adresse_region}}</p><p class="text-end"><a href="{{route('edit_adresse_resp',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                    @endif
                </div>
            </div>

        </div>
        <div class="col-2 info_plus5  pt-4">
            <h5 class="text-center mb-4">Entreprise</h5>
            <div class="row ">
                <div class="col text-center ">
                    @if($entreprise->logo == NULL )
                        <span class="text-end">
                            <img src="" alt="Logo centre de formation professionnel" >
                        </span>
                    @else
                        <span class="text-end">
                            <img src="{{asset('images/entreprises/'.$entreprise->logo)}}" alt="Logo de l'entreprise" class="img-fluid">
                        </span>
                    @endif
                    {{-- <p class="mt-4">{{$entreprise->nom_etp}}</p> --}}

                        @if($refs->service_id == NULL)
                            <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-buildings icon_sociaux2'></i>&nbsp;Dep  --------------------- </p><p class="text-end"><a href="{{route('edit_departement_service',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                        @else
                            <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxs-buildings icon_sociaux2'></i>&nbsp;Dep: {{$refs->nom_departement}}</p><p class="text-end"><a href="{{route('edit_departement_service',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                        @endif
                        @if($refs->service_id == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-building icon_sociaux2'></i>&nbsp;Serv -------------------</p><p class="text-end"><a href="{{route('edit_departement_service',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                        @else
                            <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxs-building icon_sociaux2'></i>&nbsp;Serv: {{$refs->nom_service}}</p><p class="text-end"><a href="{{route('edit_departement_service',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                        @endif
                        @if($refs->branche_id == NULL)
                        <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bx-building-house icon_sociaux2'></i>&nbsp;Branche ------------</p><p class="text-end"><a href="{{route('edit_branche',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                        @else
                            <div class="p-1 m-0 justify-content-between d-flex flex-row afficher_icon_modif"><p><i class='bx bxs-map icon_sociaux2'></i>&nbsp;Branche: {{$refs->nom_branche}}</p><p class="text-end"><a href="{{route('edit_branche',$refs->id)}}"><i class='bx bx-edit bx_modifier'></i></a></p></div>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


