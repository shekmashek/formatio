@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Annuaire</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/annuaire.css')}}">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
{{-- <link rel="stylesheet" href="{{asset('assets/css/modules.css')}}"> --}}

<div class="container-fluid pt-4">
    <div class="row fix_top_row">
        <div class="d-flex flex-row justify-content-between">
            <div class="">
                @if(count($cfps) == null)
                    <h5>Les Organismes de Formations près de chez vous : aucun résultats</h5>
                @elseif(count($cfps) == 1)
                    <h5>Les Organismes de Formations près de chez vous : <span class="nbr_cfp"> 1 résultat, {{count($collaboration)}} collaborés</span></h5>
                @else
                    <h5>Les Organismes de Formations près de chez vous : <span class="nbr_cfp">{{count($cfps)}} résultats, {{count($collaboration)}} collaborés</span></h5>
                @endif
            </div>
            <div class="d-flex flex-row ">
                <div class="d-flex flex-row "><span class="nombre_pagination text-center filter"><span style="position: relative; top: .5rem">{{$pagination["debut_aff"]."-".$pagination["fin_aff"]." sur ".$pagination["totale_pagination"]}}</span></div>

                {{-- =============== condition pagination ==================== --}}
                @if ($pagination["nb_limit"] >= $pagination["totale_pagination"])
                @if(isset($nom_entiter))
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
                @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] - $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ])}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination '></i></a>
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] + $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' ></i></a>
                @else
                <a href="{{ route('annuaire',[($pagination["debut_aff"] - $pagination["nb_limit"]) ])}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination '></i></a>
                <a href="{{ route('annuaire',[($pagination["debut_aff"] + $pagination["nb_limit"]) ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' ></i></a>

                @endif
                {{-- =============== condition pagination ==================== --}}
                @elseif (($pagination["debut_aff"]+$pagination["nb_limit"]) >= $pagination["totale_pagination"])
                @if(isset($nom_entiter))
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

                @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] - $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ])}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] + $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' ></i></a>

                @else
                <a href="{{ route('annuaire',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
                <a href="{{ route('annuaire',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' ></i></a>

                @endif
                {{-- =============== condition pagination ==================== --}}
                @elseif ($pagination["debut_aff"] == 1)
                @if(isset($nom_entiter))
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

                @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] - $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ])}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination '></i></a>
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] + $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ]) }}" role="button"><i class='bx bx-chevron-right pagination' ></i></a>

                @else
                <a href="{{ route('annuaire',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination '></i></a>
                <a href="{{ route('annuaire',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button"><i class='bx bx-chevron-right pagination' ></i></a>

                @endif
                {{-- =============== condition pagination ==================== --}}
                @elseif ($pagination["debut_aff"] == $pagination["fin_aff"] || $pagination["debut_aff"]> $pagination["fin_aff"])
                @if(isset($nom_entiter))
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

                @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] - $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ])}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] + $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' ></i></a>

                @else
                <a href="{{ route('annuaire',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
                <a href="{{ route('annuaire',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' ></i></a>

                @endif
                {{-- =============== condition pagination ==================== --}}
                @elseif ($pagination["debut_aff"] == $pagination["fin_aff"] || $pagination["debut_aff"]> $pagination["fin_aff"])
                @if(isset($nom_entiter))
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

                @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] - $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ])}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] + $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' ></i></a>

                @else
                <a href="{{ route('annuaire',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
                <a href="{{ route('annuaire',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' ></i></a>

                @endif
                {{-- =============== condition pagination ==================== --}}
                @else
                @if(isset($nom_entiter))
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

                @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] - $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ])}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] + $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ]) }}" role="button"><i class='bx bx-chevron-right pagination' ></i></a>

                @else
                <a href="{{ route('annuaire',($pagination["debut_aff"] - $pagination["nb_limit"]) )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
                <a href="{{ route('annuaire',($pagination["debut_aff"] + $pagination["nb_limit"]) ) }}" role="button"><i class='bx bx-chevron-right pagination' ></i></a>

                @endif
                @endif

                @if(isset($nom_entiter) )
                <a href="{{route('annuaire')}}" class="btn_creer text-center filter" role="button">
                    filtre activé <i class="fas fa-times"></i> </a>
                @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))
                <a href="{{route('annuaire')}}"><span class="btn_creer  text-center filter"><span style="position: relative; bottom: -0.2rem">
                        </span> filtre activé <i class="fas fa-times"></i></span>
                </a>
                @endif

                <a href="#" class="btn_creer text-center filter ms-2" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
            </div>
        </div>
    </div>
</div>
<section class="annuairebg mb-5">
    <div class="container my-2">
            <div class="row mb-5 justify-content-center">
                <div class="col-12 alphabet mb-2">
                    @foreach ($initial as $init)
                    <span title="{{$init->initial}}" class="lien_filtre activer" id="{{$init->initial}}" role="button">{{$init->initial}}</span>
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-12 justify-content-center px-5">
                    <div id="result">

                        @foreach ($cfps as $cfp)
                        <div class="row detail_content mb-4">
                            <div class="col-2 logo_content">
                                <a href="{{route('detail_cfp',$cfp->id)}}"><img src="{{asset("images/CFP/".$cfp->logo)}}" alt="logo" class="img-fliud logo_img"></a>
                            </div>
                            <div class="col-3 ">
                                <div class="row">
                                <h4><a href="{{route('detail_cfp',$cfp->id)}}">{{$cfp->nom}}</a>
                                    @foreach ($type_abonnement as $type)
                                        @if($cfp->id == $type->cfp_id)
                                            @if($type->type_abonnement_id == 1)
                                                <sup><span class="mode1"><i class='bx bxl-sketch'></i>{{$type->nom_type}}</span></sup>
                                            @endif
                                            @if($type->type_abonnement_id == 2)
                                                <sup><span class="mode2"><i class='bx bxl-sketch'></i>{{$type->nom_type}}</span></sup>
                                            @endif
                                            @if($type->type_abonnement_id == 3)
                                                <sup><span class="mode3"><i class='bx bxl-sketch'></i>{{$type->nom_type}}</span></sup>
                                            @endif
                                            @if($type->type_abonnement_id == 4)
                                                <sup><span class="mode4"><i class='bx bxl-sketch'></i>{{$type->nom_type}}</span></sup>
                                            @endif
                                            @if($type->type_abonnement_id == 5)
                                                <sup><span class="mode5"><i class='bx bxl-sketch'></i>{{$type->nom_type}}</span></sup>
                                            @endif
                                            @if($type->type_abonnement_id != 1 && $type->type_abonnement_id != 2 && $type->type_abonnement_id != 3 && $type->type_abonnement_id != 4 && $type->type_abonnement_id != 5 )

                                            @endif
                                        @endif
                                    @endforeach
                                </h4>
                                    @if ($cfp->slogan!=null)
                                    <p>{{$cfp->slogan}}</p>
                                    @else
                                    <p>------------</p>
                                    @endif
                                </div>
                                <div class="d-flex flex-row">
                                    @foreach ($avis_etoile as $avis)
                                        @if($avis->cfp_id == $cfp->id)
                                            @if($avis->pourcentage != null)
                                            <div class="d-flex flex-row">
                                                @if($avis->pourcentage != null)
                                                    <div class="Stars" style="--note: {{ $avis->pourcentage }};"></div>
                                                @else
                                                    <div class="Stars" style="--note: 0;"></div>
                                                @endif
                                            </div>
                                            <div class="rating-box ms-2">
                                                @if($avis->pourcentage != null)
                                                    <span class="avis_verif"><span class="">{{ $avis->pourcentage }} / 5</span> ({{$avis->nb_avis}} avis)</span>
                                                @else
                                                    <span class="">0 sur 5 (0 avis)</span>
                                                @endif
                                            </div>
                                            @endif
                                        @else
                                            <div class="d-flex flex-row">
                                                <div class="Stars" style="--note: 0;"></div>
                                            </div>
                                            <div class="rating-box ms-2">
                                                <span class="">0 sur 5 (0 avis)</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="col d-flex flex-row mb-2">
                                    <span class="btn_fermer me-3" role="button"><a href="#"><i class="bx bx-mail-send me-2"></i>Email</a></span>
                                    <span class="btn_fermer me-3 contact_action" role="button" data-bs-toggle="collapse" href="#contact_{{ $cfp->id }}" aria-expanded="false" aria-controls="collapseprojet"><i class="bx bx-phone me-2"></i>Contact</span>
                                    <span class="btn_fermer me-3" role="button"><a href="https://{{$cfp->site_web}}" target="_blank"><i class="bx bx-globe me-2"></i>Site
                                            Web</a></span>
                                    <span class="btn_fermer me-5" role="button"><a href="{{route('detail_cfp',$cfp->id)}}"><i class="bx bx-info-circle me-2"></i>Formations</a></span>

                                </div>
                                <div class="contact collapse" id="contact_{{ $cfp->id }}">
                                    <div class="col-6 phone_detail">
                                        <span class="text-muted">Téléphone</span>
                                        @if ($cfp->telephone!=null)
                                        <p class="m-0">{{$cfp->telephone}}</p>
                                        @else
                                        <p class="m-0">------</p>
                                        @endif
                                    </div>
                                </div>
                                <p class="mt-1 "><i class="bx bxs-map"></i>
                                    @if ($cfp->adresse_lot=!null)
                                    {{$cfp->adresse_lot}}
                                    @else
                                    ------
                                    @endif
                                    &nbsp;
                                    @if ($cfp->adresse_quartier!=null)
                                    {{$cfp->adresse_quartier}}
                                    @else
                                    ------
                                    @endif
                                    &sbquo;&nbsp;
                                    @if ($cfp->adresse_ville!=null)
                                    {{$cfp->adresse_ville}}
                                    @else
                                    -------
                                    @endif
                                    &nbsp;
                                    @if ($cfp->adresse_code_postal!=null)
                                    {{$cfp->adresse_code_postal}}
                                    @else
                                    -------
                                    @endif
                                    &sbquo;&nbsp;
                                    @if ($cfp->adresse_region!=null)
                                    {{$cfp->adresse_region}}
                                    @else
                                    -------
                                    @endif
                                </p>
                            </div>
                            <div class="col-1">
                                <span class="badges">
                                    @foreach ($collaboration as $collab)
                                        @if($collab->inviter_cfp_id == $cfp->id && $collab->activiter == 1)
                                            <div class="main-wrapper">
                                                <div class="badge green">
                                                    <div class="circle"> <i class="bx bxs-badge-check"></i></div>
                                                    <div class="ribbon">Collaboré</div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="filtrer mt-3">
                <div class="row">
                    <div class="col">
                        <p class="m-0">Filtre</p>
                    </div>
                    <div class="col text-end">
                        <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
                    </div>
                    <hr class="mt-2">
                    <div class="row mt-0 navigation_module">

                    <div class="accordion accordion-flush" id="accordionFlushExample">


                        <p>
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#search_num_fact" aria-expanded="false" aria-controls="search_num_fact">

                            Recherche par nom d'organisme
                        </p>

                        </button>

                        <div class="collapse multi-collapse" id="search_num_fact">
                            <form class=" mt-1 mb-2 form_colab" method="GET" action="{{route('annuaire+recherche+par+entiter')}}" enctype="multipart/form-data">
                                @csrf
                                <input name="nom_entiter" id="nom_entiter" required class="form-control" required type="text" aria-label="Search" placeholder="nom d'organisme">
                                <input type="submit" class="btn_creer mt-2" id="exampleFormControlInput1" value="Recherche" />
                            </form>
                        </div>


                        <hr>

                        <p>

                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#detail_par_solde" aria-expanded="false" aria-controls="detail_par_solde">
                                Recherche par adresse

                        </p>
                    </button>
                        <div class="collapse multi-collapse" id="detail_par_solde">
                            <form class="mt-1 mb-2 form_colab" action="{{route('annuaire+recherche+par+adresse')}}" method="GET" enctype="multipart/form-data">
                                @csrf
                                <label for="dte_debut" class="form-label" align="left"> quartier <strong style="color:#ff0000;">*</strong></label>
                                <input required type="text" name="qter" id="qter" class="form-control" />
                                <br>
                                <label for="dte_fin" class="form-label" align="left">ville <strong style="color:#ff0000;">*</strong></label>
                                <input required type="text" name="vlle" id="vlle" class="form-control" />

                                <label for="dte_fin" class="form-label" align="left">code postale <strong style="color:#ff0000;">*</strong></label>
                                <input required type="text" name="cde_post" id="cde_post" class="form-control" />

                                <label for="dte_fin" class="form-label" align="left">région<strong style="color:#ff0000;">*</strong></label>
                                <input required type="text" name="reg" id="reg" class="form-control" />

                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </form>
                        </div>
                        <hr>
                    </div>
                </div>
            </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    let CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");

    function getDataRequetTrie(idName, id_alpha) {

        var dataValiny = {};

        @php
        if (isset($quartier) && isset($ville) && isset($code_postal) && isset($region)) {
            @endphp

            dataValiny = {
                Alpha: id_alpha
                , nb_pagination: @php echo $pagination["debut_aff"];@endphp
                , quartier: "@php echo $quartier;@endphp"
                , ville: "@php echo $ville;@endphp"
                , code_postal: "@php echo $code_postal;@endphp"
                , region: "@php echo $region;@endphp"
            };

            @php
        } else if (isset($nom_entiter)) {
            @endphp
            dataValiny = {
                Alpha: id_alpha
                , nb_pagination: @php echo $pagination["debut_aff"];@endphp
                , nom_entiter: "@php echo $nom_entiter;@endphp"
            };
            @php
        } else {
            @endphp

            dataValiny = {
                Alpha: id_alpha
                , nb_pagination: @php echo $pagination["debut_aff"];@endphp
            };
            @php
        }
        @endphp

        return dataValiny;
    }

    $(document).ready(function() {
        $(".lien_filtre").click(function(e) {
            let id_alpha = e.target.id;
            var dataValue = getDataRequetTrie(".lien_filtre", id_alpha);
            // console.log(JSON.stringify(dataValue));
            /*
            data: {
                    Alpha: id_alpha
                , }
            */
            $.ajax({
                method: "get"
                , url: "{{route('alphabet_filtre')}}"
                , data: dataValue
                , dataType: "html"
                , success: function(response) {
                    let userData = JSON.parse(response);
                    // console.log(JSON.stringify(userData['avis']));
                    if (userData['cfp'] != null || undefined) {
                        let html = '';

                        for (let i = 0; i < userData['cfp'].length; i++) {
                            // console.log(userData['type']);
                            let url_detail_cfp = '{{ route("detail_cfp", ":id") }}';
                            url_detail_cfp = url_detail_cfp.replace(":id", userData['cfp'][i]['id']);

                            html += '<div class="row detail_content mb-5">';
                            html +=     '<div class="col-2 logo_content">';
                            html +=         '<a href="' + url_detail_cfp + '"><img src="{{ asset("images/CFP/:?") }}" alt="logo" class="img-fliud logo_img"></a>';
                            html +=     '</div>';
                            html +=     '<div class="col-3 detail_cfp">';
                            html +=         '<div class="row">';
                            html +=             '<h4><a href="' + url_detail_cfp + '">' + userData['cfp'][i]['nom'] + '</a>';
                                                for (let l = 0; l < userData['type'].length; l++) {
                                                    if (userData['cfp'][i]['id'] == userData['type'][l]['cfp_id']) {
                                                        if (userData['type'][l]['type_abonnement_id'] == 1) {
                            html +=                         '<sup><span class="mode1"><i class="bx bxl-sketch"></i>'+userData['type'][l]['nom_type']+'</span></sup>';
                                                        }
                                                        if (userData['type'][l]['type_abonnement_id'] == 2) {
                            html +=                         '<sup><span class="mode2"><i class="bx bxl-sketch"></i>'+userData['type'][l]['nom_type']+'</span></sup>';
                                                        }
                                                        if (userData['type'][l]['type_abonnement_id'] == 3) {
                            html +=                         '<sup><span class="mode3"><i class="bx bxl-sketch"></i>'+userData['type'][l]['nom_type']+'</span></sup>';
                                                        }
                                                        if (userData['type'][l]['type_abonnement_id'] == 4) {
                            html +=                         '<sup><span class="mode4"><i class="bx bxl-sketch"></i>'+userData['type'][l]['nom_type']+'</span></sup>';
                                                        }
                                                        if (userData['type'][l]['type_abonnement_id'] == 5) {
                            html +=                         '<sup><span class="mode5"><i class="bx bxl-sketch"></i>'+userData['type'][l]['nom_type']+'</span></sup>';
                                                        }
                                                        if (userData['type'][l]['type_abonnement_id'] != 1 && userData['type'][l]['type_abonnement_id'] != 2 && userData['type'][l]['type_abonnement_id'] != 3 && userData['type'][l]['type_abonnement_id'] != 4 && userData['type'][l]['type_abonnement_id'] != 5){

                                                        }
                                                    }
                                                }
                            html +=             '</h4>';
                                                    if (userData['cfp'][i]['slogan'] != null) {
                            html +=                     '<p>' + userData['cfp'][i]['slogan'] + '</p>';
                                                    } else {
                            html +=                     '<p>--------</p>';
                                                    }
                            html +=         '</div>';
                            html +=         '<div class="d-flex flex-row">';
                                            for (let k = 0; k < userData['avis'].length; k++) {
                                                if(userData['avis'][k]['cfp_id'] == userData['cfp'][i]['id']){
                                                    if (userData['avis'][k]['pourcentage'] != null) {
                            html +=                     '<div class="d-flex flex-row">';
                                                            if (userData['avis'][k]['pourcentage'] != null) {
                            html +=                             '<div class="Stars" style="--note: '+ userData['avis'][k]['pourcentage']+';"></div>';
                                                            }else{
                            html +=                             '<div class="Stars" style="--note: 0;"></div>';
                                                            }
                            html +=                     '</div>';
                            html +=                     '<div class="rating-box ms-2">';
                                                            if (userData['avis'][k]['pourcentage'] != null) {
                            html +=                             '<span class="avis_verif"><span class="">'+ userData['avis'][k]['pourcentage']+' / 5</span> ('+ userData['avis'][k]['nb_avis']+' avis)</span>';
                                                            }else{
                            html +=                             '<span class="">0 sur 5 (0 avis)</span>';
                                                            }
                            html +=                     '</div>';
                                                    }
                                                }else{
                            html +=                 '<div class="d-flex flex-row">';
                            html +=                     '<div class="Stars" style="--note: 0;"></div>';
                            html +=                 '</div>';
                            html +=                 '<div class="rating-box ms-2">';
                            html +=                     '<span class="">0 sur 5 (0 avis)</span>';
                            html +=                 '</div>';
                                                }
                                            }
                            html +=         '</div>';
                            html +=     '</div>';

                            html +=     '<div class="col-6">';
                            html +=         '<div class="col d-flex flex-row mb-2">';
                            html +=             '<span class="btn_fermer" role="button">';
                            html +=                 '<a href="#"><i class="bx bx-mail-send me-2"></i>Email</a>';
                            html +=             '</span>';
                            html +=             '<span class="btn_fermer ms-3 contact_action" role="button" data-bs-toggle="collapse"href="#contact_' + userData['cfp'][i]['id'] + '" aria-expanded="false" aria-controls="collapseprojet"><i class="bx bx-phone me-2"></i>Contact</span>';
                            html +=             '<span class="btn_fermer ms-3" role="button">';
                            html +=                 '<a href="https://' + userData['cfp'][i]['site_web'] + '" target="_blank"><i class="bx bx-globe me-2"></i>Site Web</a>';
                            html +=             '</span>';
                            html +=             '<span class="btn_fermer ms-3" role="button">';
                            html +=                 '<a href="' + url_detail_cfp + '"><i class="bx bx-info-circle me-2"></i>Plus d\'infos</a>';
                            html +=             '</span>';
                            html +=         '</div>';
                            html +=         '<div class="contact collapse" id="contact_' + userData['cfp'][i]['id'] + '">';
                            html +=             '<div class="col-6 phone_detail">';
                            html +=                 '<span class="text-muted">Téléphone</span>';
                                                        if (userData['cfp'][i]['telephone'] != null) {
                            html +=                         '<p class="m-0">' + userData['cfp'][i]['telephone'] + '</p>';
                                                        } else {
                            html +=                         '<p class="m-0">--------</p>';
                                                        }
                            html +=             '</div>';
                            html +=         '</div>';

                            html +=         '<p class="mt-1 adresse"><i class="bx bxs-map"></i>';
                                                if (userData['cfp'][i]['adresse_lot'] = !null) {
                            html +=                 '' + userData['cfp'][i]['adresse_lot'] + '';
                                                } else {
                            html +=                 '------';
                                                }
                            html +=             '&nbsp;';
                                                if (userData['cfp'][i]['adresse_quartier'] != null) {
                            html +=                 '' + userData['cfp'][i]['adresse_quartier'] + '';
                                                } else {
                            html +=                 ' ------';
                                                }
                            html +=             '&sbquo;&nbsp;';
                                                if (userData['cfp'][i]['adresse_ville'] != null) {
                            html +=                 '' + userData['cfp'][i]['adresse_ville'] + '';
                                                } else {
                            html +=                 '-------';
                                                }
                            html +=             '&nbsp;';
                                                if (userData['cfp'][i]['adresse_code_postal'] != null) {
                            html +=                 '' + userData['cfp'][i]['adresse_code_postal'] + '';
                                                } else {
                            html +=                 '-------';
                                                }
                            html +=             '&sbquo;&nbsp;';
                                                if (userData['cfp'][i]['adresse_region'] != null) {
                            html +=                 '' + userData['cfp'][i]['adresse_region'] + '';
                                                }else {
                            html +=                 '-------';
                                                }
                            html +=         '</p>';
                            html +=     '</div>';
                            html +=     '<div class="col-1">';
                            html +=         '<span class="badges">';
                                                for (let j = 0; j < userData['collab'].length; j++) {
                                                    if(userData['collab'][j]['inviter_cfp_id'] == userData['cfp'][i]['id'] && userData['collab'][j]['activiter'] == 1){
                            html +=                     '<div class="main-wrapper">';
                            html +=                         '<div class="badge green">';
                            html +=                             '<div class="circle">';
                            html +=                                 '<i class="bx bxs-badge-check"></i>';
                            html +=                             '</div>';
                            html +=                             '<div class="ribbon">Collaboré</div>';
                            html +=                         '</div>';
                            html +=                     '</div>';
                                                    }
                                                }
                            html +=         '</span>';
                            html +=     '</div>';
                            html += '</div>';
                            html = html.replace(':?', userData['cfp'][i]['logo']);
                            if ($(this).hasClass('activer')) {
                                $(this).removeClass('activer').addClass("activer_filtre");
                            } else {
                                $(this).removeClass('activer_filtre').addClass("activer");
                            }

                        }
                        let counterCfp = userData['cfp'].length;
                        $('.nbr_cfp').text('');
                        if (counterCfp == 1) {
                            $('.nbr_cfp').append(' 1 résultat');
                        }else{
                            $('.nbr_cfp').append(counterCfp+' résultats');
                        }

                        $("#result").text("");
                        $("#result").append(html);
                        $(".pagination").css('display', 'flex');
                    } else {
                        alert('error');
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            , });
            if ($(this).hasClass('activer')) {
                $(this).removeClass('activer').addClass("activer_filtre");
            } else {
                $(this).removeClass('activer_filtre').addClass("activer");
            }
        });
    });

</script>
@endsection
