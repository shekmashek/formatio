@extends('./layouts/admin')
@section('title')
<h3 class="text-white ms-5">Liste formation </h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/formation.css')}}">
<div class="row navigation_detail ">
    <div class="ps-5">
        <ul class="">
            <div class="row align-items-center">
                <div class="col-3">
                    <li>
                        <h3 class="text-center">Que voulez-vous apprendre?</h3>
                    </li>
                </div>
                <div class="col-6">
                    <li class="me-5">
                        <div class="row content_search text-center">
                            <form method="GET" action="{{route('result_formation')}}">
                                @csrf
                                <div class="form-row">
                                    <div class="d-flex flex-row">
                                        {{-- @foreach ($categorie as $categ)
                                            <input type="hidden" name="id_formation" value="{{$categ->id}}">
                                        @endforeach --}}
                                        <input class="form-control me-2" type="text" name="nom_formation" placeholder="Rechercher par formations ex. Excel">
                                        <button type="submit" class="btn"><i class="bx bx-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>
                </div>
                <div class="col-3">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle dropbtn text-center mt-3" href="#" id="domaine_dropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class='bx bx-menu icon_dom fs-4 me-2'></i>Domaines de Formations
                        </a>
                        <div class="dropdown-menu mega_menu pt-0 mt-3" aria-labelledby="domaine_dropdown">
                            <div class="d-flex align-items-start flex-column flex-sm-row px-3 py-5">
                                <div>
                                    @foreach ($domaine_col1 as $dom)
                                    <a class="dropdown-item" href="{{route('domaine_vers_formation',$dom->id)}}">{{$dom->nom_domaine}}</a>
                                    @endforeach
                                </div>
                                <div>
                                    @foreach ($domaine_col2 as $dom)
                                    <a class="dropdown-item" href="{{route('domaine_vers_formation',$dom->id)}}">{{$dom->nom_domaine}}</a>
                                    @endforeach
                                </div>
                                <div>
                                    @foreach ($domaine_col3 as $dom)
                                    <a class="dropdown-item" href="{{route('domaine_vers_formation',$dom->id)}}">{{$dom->nom_domaine}}</a>
                                    @endforeach
                                </div>
                                <div>
                                    @foreach ($domaine_col4 as $dom)
                                    <a class="dropdown-item" href="{{route('domaine_vers_formation',$dom->id)}}">{{$dom->nom_domaine}}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                </div>
            </div>
        </ul>
    </div>
</div>
<section class="mt-3">
    <div class="container">
        <div class="row">

            {{-- @if (count($infos)>0) --}}
            {{-- @if(!isset($nom_formation))
            <h5 class="ms-5">{{count($infos)}} résultats</h5><br>
            @endif --}}
            @if(isset($nom_entiter))
            <h5 class="ms-5">{{count($infos)}} résultat trouvé sur  &nbsp;{{$nom_entiter}}</h5><br>
            @elseif(isset($nom_formation))
            <h5 class="ms-5">{{count($infos)}} résultat trouvé en &nbsp;{{$nom_entiter}}</h5><br>
            @else
            <h5 class="ms-5">{{count($infos)}} résultats trouvé</h5><br>
            @endif

            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif

            <span class="nombre_pagination text-center filter"><span style="position: relative; bottom: -0.2rem">{{$pagination["debut_aff"]."-".$pagination["fin_aff"]." sur ".$pagination["totale_pagination"]}}</span>

                {{-- =========== pagination module =============================================== --}}
                @include("referent.catalogue.pagination.pagination_liste_formation")

                <a href="#" class="btn_creer text-center filter ms-2" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>

                @if(isset($nom_formation) )
                <a href="{{route('result_formation')}}" class="btn_creer text-center filter" role="button">
                    filtre activé <i class="fas fa-times"></i> </a>
                @elseif(isset($data_debut_filtre) && isset($data_fin_filtre))
                <a href="{{route('result_formation')}}" class="btn_creer text-center filter" role="button">
                    filtre activé <i class="fas fa-times"></i> </a>
                @elseif(isset($nom_formation) )
                <a href="{{route('result_formation')}}" class="btn_creer text-center filter" role="button">
                    filtre activé <i class="fas fa-times"></i> </a>
                @elseif(isset($nom_entiter) )
                <a href="{{route('result_formation')}}" class="btn_creer text-center filter" role="button">
                    filtre activé <i class="fas fa-times"></i> </a>
                @endif

        </div>
    </div>

    </div>
    <div class="container-fluid pb-5 px-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                @if (count($infos)>0)

                @foreach ($infos as $info)
                <div class="row liste__formation justify-content-space-between mb-4">
                    <div class="col d-flex flex-column">
                        <a href="{{route('detail_cfp',$info->cfp_id)}}" class="justify-content-center text-center">
                            <span class="mb-2 description">{{$info->nom}}</span><img src="{{asset('images/CFP/'.$info->logo)}}" alt="logo" class="img-fluid" style="width: 100px; height:50px;">
                        </a>
                    </div>
                    <div class="col-3 liste__formation__content">
                        <a href="{{route('select_par_module',$info->module_id)}}">
                            <div class="liste__formation__item">
                                <h5>{{$info->nom_module}}</h5>
                                <p><span>{{$info->nom_formation}}</span></p>
                                {{-- <p>Réference : <span>{{$info->reference}}</span></p> --}}

                            </div>
                        </a>
                    </div>
                    <div class="col-4">
                        <div class="liste__formation__avis mb-3 d-flex flex-row justify-content-between">
                            <div>
                                <div class="Stars" style="--note: {{ $info->pourcentage }};">
                                </div>



                                <span class="me-3"><strong>{{ $info->pourcentage }}</strong>/5
                                    @if($info->total_avis != null)
                                    ({{$info->total_avis}} avis)
                                    @else
                                    (0 avis)
                                    @endif
                                </span>
                            </div>
                            <div>
                                <span>Réf : {{$info->reference}}</span>
                            </div>

                        </div>
                        <div class="liste__formation__item3 description d-flex flex-row">
                            <div class="me-2"><i class="bx bx-alarm bx_icon"></i>
                                <span>
                                    @isset($info->duree_jour)
                                    {{$info->duree_jour}} jours
                                    @endisset
                                </span>
                                <span>
                                    @isset($info->duree)
                                    /{{$info->duree}} h
                                    @endisset
                                </span> </p>
                            </div>
                            <div class="me-2"><i class="bx bx-certification bx_icon"></i><span>&nbsp;Certifiante</span>
                            </div>
                            <div class="me-2"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$info->modalite_formation}}</span>
                            </div>
                            <div><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$info->niveau}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col text-center">
                        <div class="description mb-3">{{$devise->devise}}&nbsp;{{number_format($info->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pers</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                        @if($info->prix_groupe != null)
                        <div class="pt-1 description">{{$devise->devise}}&nbsp;{{number_format($info->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;/ grp</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></div>
                        @endif
                    </div>
                    <div class="col">
                        <div class="mb-2 lien_clique"><a href="{{route('demande_devis_client',$info->module_id)}}" class="description ">Démander&nbsp;un&nbsp;devis</a></div>
                        @if (count($datas) <= 0) @else @foreach ($datas as $data) @if($info->module_id == $data->module_id)
                            <div class="pt-1 lien_clique"><a href="{{route('inscriptionInter',[$data->groupe_id,$data->type_formation_id])}}" class="description ">S'inscrire</a></div>
                            @endif
                            @endforeach
                            @endif
                    </div>
                    @foreach ($datas as $data)
                    @if($info->module_id == $data->module_id)
                    @if (count($datas) <= 0) @else <hr class="mb-1 mt-2">
                        <div class="row w-100 justify-content-end">
                            <h6 class="mb-0 changer_caret d-flex pt-2 w-100" data-bs-toggle="collapse" href="#collapseprojet_{{$info->module_id}}" role="button" aria-expanded="false" aria-controls="collapseprojet">Afficher les dates du Session Inter&nbsp;<i class="bx bx-caret-down caret-icon"></i>
                            </h6>
                        </div>
                        <div class="details collapse detail_inter" id="collapseprojet_{{$info->module_id}}">
                            <div class="row px-3 py-2">
                                <div class="col-2">
                                    <p>Prochaines Sessions</p>
                                </div>
                                <div class="col-5 date text-center">
                                    @foreach ($datas as $data)
                                    @if($info->module_id == $data->module_id)
                                    <p>Du @php setlocale(LC_TIME, "fr_FR"); echo strftime("%d %B, %Y", strtotime($data->date_debut)); @endphp au @php setlocale(LC_TIME, "fr_FR"); echo strftime("%d %B, %Y", strtotime($data->date_fin)); @endphp</p>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="col-5 text-center">
                                    <p class="">Cette thématique vous intéresse?<button type="button" class="btn_next ms-4"><a href="{{route('select_par_module',$info->module_id)}}">Voir la Formation</a></button> </p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endif
                        @endforeach
                </div>
                @endforeach
                @else
                <h2 class="text-center">Aucun module pour cette formation 😅 !</h2>
                <div class="col text-center">
                    <a class="mb-2 new_list_nouvelle " href="{{route('liste_formation')}}">
                        <span class="btn_enregistrer text-center"><i class="bx bxs-chevron-left me-1"></i>Retour</span>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>



    <div class="filtrer mt-3">
        <div class="row">
            <div class="col">
                <p class="m-0">Filtre par</p>
            </div>
            <div class="col text-end">
                <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
            </div>
            <hr class="mt-2">
            <div class="row mt-0 navigation_module">
                <p>
                    <a data-bs-toggle="collapse" href="#intervale_prix" role="button" aria-expanded="false" aria-controls="intervale_prix">Intervale de prix par personne</a>
                </p>
                <div class="collapse multi-collapse" id="intervale_prix">
                    <div class="row">
                        <form class=" mt-1 mb-2 form_colab" method="GET" action="{{route('result_formation.filtre',"SINGLE_PRIX")}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dte_debut" class="form-label" align="left">Solde minimum {{$devise->reference." "}}<strong style="color:#ff0000;">*</strong></label>
                                        <input autocomplete="off" required type="number" min="0" placeholder="valeur" name="data_debut_filtre" id="data_debut_filtre" class="form-control" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dte_fin" class="form-label" align="left"> Solde à maximum {{$devise->reference." "}}<strong style="color:#ff0000;">*</strong></label>
                                        <input required type="number" name="data_fin_filtre" id="data_fin_filtre" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div align="center">
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <p>
                    <a data-bs-toggle="collapse" href="#intervale_prix_grp" role="button" aria-expanded="false" aria-controls="intervale_prix_grp">Intervale de prix par groupe</a>
                </p>
                <div class="collapse multi-collapse" id="intervale_prix_grp">
                    <div class="row">
                        <form class=" mt-1 mb-2 form_colab" method="GET" action="{{route('result_formation.filtre',"GROUPE_PRIX")}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dte_debut" class="form-label" align="left">Solde minimum {{$devise->reference." "}}<strong style="color:#ff0000;">*</strong></label>
                                        <input autocomplete="off" required type="number" min="0" placeholder="valeur" name="data_debut_filtre" id="data_debut_filtre" class="form-control" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dte_fin" class="form-label" align="left"> Solde à maximum {{$devise->reference." "}}<strong style="color:#ff0000;">*</strong></label>
                                        <input required type="number" name="data_fin_filtre" id="data_fin_filtre" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div align="center">
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <p>
                    <a data-bs-toggle="collapse" href="#intervale_hr" role="button" aria-expanded="false" aria-controls="intervale_hr">Intervale de heure de formation</a>
                </p>
                <div class="collapse multi-collapse" id="intervale_hr">
                    <div class="row">
                        <form class=" mt-1 mb-2 form_colab" method="GET" action="{{route('result_formation.filtre',"HR")}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dte_debut" class="form-label" align="left">Hr minimum <strong style="color:#ff0000;">*</strong></label>
                                        <input autocomplete="off" required type="number" min="0" placeholder="valeur" name="data_debut_filtre" id="data_debut_filtre" class="form-control" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dte_fin" class="form-label" align="left"> Hr à maximum {{$devise->reference." "}}<strong style="color:#ff0000;">*</strong></label>
                                        <input required type="number" name="data_fin_filtre" id="data_fin_filtre" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div align="center">
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <p>
                    <a data-bs-toggle="collapse" href="#intervale_jr" role="button" aria-expanded="false" aria-controls="intervale_jr">Intervale de jour de formation</a>
                </p>
                <div class="collapse multi-collapse" id="intervale_jr">
                    <div class="row">
                        <form class=" mt-1 mb-2 form_colab" method="GET" action="{{route('result_formation.filtre',"DAY")}}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dte_debut" class="form-label" align="left">Jr minimum <strong style="color:#ff0000;">*</strong></label>
                                        <input autocomplete="off" required type="number" min="0" placeholder="valeur" name="data_debut_filtre" id="data_debut_filtre" class="form-control" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="dte_fin" class="form-label" align="left"> Jr à maximum {{$devise->reference." "}}<strong style="color:#ff0000;">*</strong></label>
                                        <input required type="number" name="data_fin_filtre" id="data_fin_filtre" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div align="center">
                                <button type="submit" class="btn_creer mt-2">Recherche</button>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <p>
                    <a data-bs-toggle="collapse" href="#detail_par_etp" role="button" aria-expanded="false" class="entiter_filtre" aria-controls="detail_par_etp">Organisme de formation <i class='bx icon_trie bxs-chevron-up'></i></a>
                </p>
                <div class="collapse multi-collapse" id="detail_par_etp">

                    <div class="row">
                        <form class="mt-1 mb-2 form_colab" action="{{route('result_formation.entiter.filtre',"OF")}}" method="GET" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input  autocomplete="off" list="list_of" class="form-control" name="nom_entiter" id="nom_entiter">
                                        <datalist id="list_of">
                                            @foreach ($organismes as $of)
                                            <option value="{{$of->nom}}">
                                                @endforeach
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn_creer mt-2">Recherche</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>

                <p>
                    <a data-bs-toggle="collapse" href="#detail_comeptence" role="button" aria-expanded="false" class="entiter_filtre" aria-controls="detail_comeptence">Compétence à evaluer <i class='bx icon_trie bxs-chevron-up'></i></a>
                </p>
                <div class="collapse multi-collapse" id="detail_comeptence">

                    <div class="row">
                        <form class="mt-1 mb-2 form_colab" action="{{route('result_formation.entiter.filtre',"COMPETENCE")}}" method="GET" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input autocomplete="off" list="competence" class="form-control" name="nom_entiter" id="nom_entiter">
                                        <datalist id="competence">
                                            @foreach ($competences as $compe)
                                            <option value="{{$compe->titre_competence}}">
                                                @endforeach
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn_creer mt-2">Recherche</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>


                <p>
                    <a data-bs-toggle="collapse" href="#detail_formation" role="button" aria-expanded="false" class="entiter_filtre" aria-controls="detail_formation">Nom de formation <i class='bx icon_trie bxs-chevron-up'></i></a>
                </p>
                <div class="collapse multi-collapse" id="detail_formation">

                    <div class="row">
                        <form class="mt-1 mb-2 form_colab" action="{{route('result_formation.entiter.filtre',"FORMATION")}}" method="GET" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input  autocomplete="off" list="no_formation" class="form-control" name="nom_entiter" id="nom_entiter">
                                        <datalist id="no_formation">
                                            @foreach ($formations as $form)
                                            <option value="{{$form->nom_formation}}">
                                                @endforeach
                                        </datalist>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn_creer mt-2">Recherche</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <hr>
                <p>
                    <a data-bs-toggle="collapse" href="#detail_par_status" role="button" aria-expanded="false" class="status_filtre" aria-controls="detail_par_status">modalité <i class='bx icon_trie bxs-chevron-up'></i></a>
                </p>
                <div class="collapse multi-collapse" id="detail_par_status">
                    <form class="mt-1 mb-2 form_colab" action="{{route('result_formation.modalite.filtre')}}" method="GET" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-select" name="nom_entiter" id="nom_entiter">
                                        <option value="En ligne">En ligne</option>
                                        <option value="Presentiel">Présentiel</option>
                                        <option value="En ligne/Presentiel">En ligne/Présentiel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn_creer mt-2">Recherche</button>

                            </div>
                        </div>
                    </form>
                </div>
                <hr>

            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function() {
        $("#reference_search").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "{{route('search__formation')}}"
                    , type: 'get'
                    , dataType: "json"
                    , data: {
                        //    _token: CSRF_TOKEN,
                        search: request.term
                    }
                    , success: function(data) {
                        // alert("eto");
                        response(data);
                    }
                    , error: function(data) {
                        alert("error");
                        //alert(JSON.stringify(data));
                    }
                });
            }
            , select: function(event, ui) {
                // Set selection
                $('#reference_search').val(ui.item.label); // display the selected text
                return false;
            }
        });
    });
    $(".domaine").on('mouseover', function(e) {
        var id = $(this).data("id");
        $.ajax({
            method: "GET"
            , url: "{{route('domaine_formation')}}"
            , data: {
                domaine_id: id
            }
            , dataType: "html"
            , success: function(response) {
                var userData = JSON.parse(response);
                var formations = userData[0];
                var modules = userData[1];
                var domaine_id = userData[2];
                $('.sous-formation-row').html('');
                var html = '';
                for (let i = 0; i < formations.length; i++) {
                    var url_formation = '{{ route("select_par_formation", ":id") }}';
                    url_formation = url_formation.replace(':id', formations[i].id);
                    html += '<dl class="sous-formation-items" data-role="two-menu">';
                    html += '<dt><a href="' + url_formation + '">' + formations[i].nom_formation + '</a></dt>';
                    html += '<dd class="d-flex flex-column">';
                    for (let j = 0; j < modules.length; j++) {
                        if (formations[i].id == modules[j].formation_id) {
                            var url_module_detail = '{{ route("select_par_module", ":id") }}';
                            url_module_detail = url_module_detail.replace(':id', modules[j].module_id);
                            html += '<a href="' + url_module_detail + '">' + (modules[j].nom_module) + '</a>';
                        }
                    }
                    html += '</dd>';
                    html += '</dl>';
                }
                $(".dropdown>.dropdown-menu").css("display", "block");
                $('.sous-formation-row').append(html);
            }
            , error: function(error) {
                console.log(error)
            }
        });
        $(".sous-formation-content").on('mouseleave', function(e) {
            $(".dropdown>.dropdown-menu").css("display", "none");
        });
    });
    $(document).ready(function() {
        $(".changer_caret").on("click", function() {
            if (
                $(this)
                .find(".caret-icon")
                .hasClass("bx-caret-down")
            ) {
                $(this)
                    .find(".caret-icon")
                    .removeClass("bx-caret-down")
                    .addClass("bx-caret-up");
            } else {
                $(this)
                    .find(".caret-icon")
                    .removeClass("bx-caret-up")
                    .addClass("bx-caret-down");
            }
        });
    });

</script>
@endsection
