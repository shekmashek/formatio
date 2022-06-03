@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Catalogue</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/formation.css')}}">
<div class="row navigation_detail ">
    <div class="ps-5 pt-3">
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
                                        @foreach ($categorie as $categ)
                                            <input type="hidden" name="id_formation" value="{{$categ->id}}">
                                        @endforeach
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
                    {{-- <div class="dropdown">
                        <button class=""><i class='bx bx-menu icon_dom fs-4 me-2'></i>Domaines de formations<i class="fa fa-caret-down ms-2"></i></button>
                        <div class="dropdown-content">
                            <div class="row flex-wrap">
                                @foreach ($domaines as $dom)
                                    <a href="#">{{$dom->nom_domaine}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </ul>
    </div>
</div>
<section class="formation mb-5">
    <div class="container-fluid g-0 m-0 p-0 justify-content-center ">
        {{--<div class="row g-0 m-0 content_formation p-5">
            <div class="col-6 ">
                <div class="d-flex flex-row flex-wrap" style="padding-left: 4rem">
                    @foreach ($categorie as $ctg )
                    <div class="content_domaines my-4">
                        <a href="{{route('select_par_formation',$ctg->id)}}">
                            {{$ctg->nom_formation}}</a>
                    </div>
                    @endforeach
                    <a href="{{route('select_tous')}}">
                        <button type="button" class="btn btn_categ"><i class="bx bx-list-ul icon_categ"></i> Tous
                            les Thématiques</button>
                    </a>
                </div>
            </div> --}}
            {{-- <div class="col-6 align-items-center justify-content-center">
                <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{asset('img/formation/rendue1.webp')}}" alt="image"
                                class="d-block w-100 img-fluid">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('img/formation/rendue5.webp')}}" alt="image"
                                class="d-block w-100 img-fluid">
                        </div>
                        <div class="carousel-item">
                            <img src="{{asset('img/formation/rendue2.webp')}}" alt="image"
                                class="d-block w-100 img-fluid">
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
    </div>
    <div class="container mt-5">

      <span class="nombre_pagination text-center filter"><span style="position: relative; bottom: -0.2rem">{{$pagination["debut_aff"]."-".$pagination["fin_aff"]." sur ".$pagination["totale_pagination"]}}</span>

        {{-- =============== condition pagination ==================== --}}
        @if ($pagination["nb_limit"] >= $pagination["totale_pagination"])
        @if(isset($nom_entiter))
        <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
        <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>
        @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))
        <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] - $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ])}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination '></i></a>
        <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] + $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' ></i></a>

        @else
        <a href="{{ route('liste_formation',['&',($pagination["debut_aff"] - $pagination["nb_limit"]) ])}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination '></i></a>
        <a href="{{ route('liste_formation',['&',($pagination["debut_aff"] + $pagination["nb_limit"]) ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' ></i></a>

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
        <a href="{{ route('liste_formation',['&',($pagination["debut_aff"] - $pagination["nb_limit"])] )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
        <a href="{{ route('liste_formation',['&',($pagination["debut_aff"] + $pagination["nb_limit"])] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' ></i></a>

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
        <a href="{{ route('liste_formation',['&',($pagination["debut_aff"] - $pagination["nb_limit"])] )}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination '></i></a>
        <a href="{{ route('liste_formation',['&',($pagination["debut_aff"] + $pagination["nb_limit"])] ) }}" role="button"><i class='bx bx-chevron-right pagination' ></i></a>

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
        <a href="{{ route('liste_formation',['&',($pagination["debut_aff"] - $pagination["nb_limit"])] )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
        <a href="{{ route('liste_formation',['&',($pagination["debut_aff"] + $pagination["nb_limit"])] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' ></i></a>

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
        <a href="{{ route('liste_formation',['&',($pagination["debut_aff"] - $pagination["nb_limit"])] )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
        <a href="{{ route('liste_formation',['&',($pagination["debut_aff"] + $pagination["nb_limit"])] ) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' ></i></a>

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
        <a href="{{ route('liste_formation',['&',($pagination["debut_aff"] - $pagination["nb_limit"])] )}}" role="button"><i class='bx bx-chevron-left pagination '></i></a>
        <a href="{{ route('liste_formation',['&',($pagination["debut_aff"] + $pagination["nb_limit"])] ) }}" role="button"><i class='bx bx-chevron-right pagination' ></i></a>

        @endif
        @endif

        @if(isset($nom_entiter) )
        <a href="{{route('liste_formation')}}" class="btn_creer text-center filter" role="button">
            filtre activé <i class="fas fa-times"></i> </a>
        @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))
        <a href="{{route('liste_formation')}}"><span class="btn_creer  text-center filter"><span style="position: relative; bottom: -0.2rem">
                </span> filtre activé <i class="fas fa-times"></i></span>
        </a>
        @endif

                <a href="#" class="btn_creer text-center filter ms-2" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
    </div>

        <h3 class="mb-5">Les formations les plus recherchées </h3>
        <div class="row">
            <div class="col-12 d-flex flex-wrap justify-content-cente">
                @foreach ($module as $mod)
                <div class="card_formation">
                    <div class="imageLogo text-center mb-2 mt-3">
                        <img src="{{asset('images/CFP/'.$mod->logo)}}" alt="logo" class="img-fluid"
                            title="organisme de formation">
                    </div>
                    <div class="titre_module">
                        <p class="text-capitalize text-">{{$mod->nom_module}}</p>
                    </div>
                    <div class="details_module">
                        <div class="row">
                            <div class="col-6">
                                <p class="text-capitalize text-dark"><i
                                        class='bx bx-detail me-2'></i>{{$mod->nom_formation}}</p>
                                <p class="text-capitalize"><i class='bx bx-alarm me-2'></i>{{$mod->duree_jour}}
                                    jours/{{$mod->duree}}heures</p>
                                <p class="text-capitalize"><i
                                        class='bx bxs-notification me-2'></i>{{$mod->modalite_formation}}</p>
                            </div>
                            <div class="col-6 text-center">
                                <p class="text-capitalize"><strong>{{$devise->devise}}&nbsp;{{number_format($mod->prix, 0, ' ', ' ')}}<sup>&nbsp;/ pers</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></strong> </p>
                                @if ($mod->prix_groupe != null)
                                    <p class="text-capitalize"><strong>{{$devise->devise}}&nbsp;{{number_format($mod->prix_groupe, 0, ' ', ' ')}}<sup>&nbsp;/ grp</sup>&nbsp;<span class="text-muted hors_taxe">HT</span></strong> </p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <a href="{{route('select_par_module',$mod->module_id)}}" role="button"
                            class="btn_enregistrer">Voir la formation</a>
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
                <p>
                    <a data-bs-toggle="collapse" href="#search_num_fact" role="button" aria-expanded="false" aria-controls="search_num_fact">Recherche par nom d'organisme</a>
                </p>
                <div class="collapse multi-collapse" id="search_num_fact">
                    <form class=" mt-1 mb-2 form_colab" method="GET" action="{{route('annuaire+recherche+par+entiter')}}" enctype="multipart/form-data">
                        @csrf
                        <input name="nom_entiter" id="nom_entiter" required class="form-control" required type="text" aria-label="Search" placeholder="nom d'organisme">
                        <input type="submit" class="btn_creer mt-2" id="exampleFormControlInput1" value="Recherche" />
                    </form>
                </div>
                <hr>
                <p>
                    <a data-bs-toggle="collapse" href="#detail_par_solde" role="button" aria-expanded="false" aria-controls="detail_par_solde">Recherche par adresse</a>
                </p>
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

</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    // CSRF Token
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
          $( "#reference_search" ).autocomplete({
            source: function( request, response ) {
              // Fetch data
              $.ajax({
                url:"{{route('search__formation')}}",
                type: 'get',
                dataType: "json",
                data: {
                //    _token: CSRF_TOKEN,
                   search: request.term
                },
                success: function( data ) {
                    // alert("eto");
                   response( data );
                },error:function(data){
                    alert("error");
                    //alert(JSON.stringify(data));
                }
              });
            },
            select: function (event, ui) {
           // Set selection
           $('#reference_search').val(ui.item.label); // display the selected text
           return false;
        }
          });
        });
    $(".domaine").on('mouseover',function(e){
        var id = $(this).data("id");
        $.ajax({
        method: "GET",
        url:  "{{route('domaine_formation')}}",
        data:{domaine_id:id},
        dataType: "html",
        success:function(response){
            var userData=JSON.parse(response);
            var formations = userData[0];
            var modules = userData[1];
            var domaine_id = userData[2];
            $('.sous-formation-row').html('');
            var html = '';
             for (let i = 0; i < formations.length; i++) {
                var url_formation = '{{ route("select_par_formation", ":id") }}';
                url_formation = url_formation.replace(':id', formations[i].id);
                html += '<dl class="sous-formation-items" data-role="two-menu">';
                html += '<dt><a href="'+url_formation+'">'+formations[i].nom_formation+'</a></dt>';
                html += '<dd class="d-flex flex-column">';
                    for (let j = 0; j < modules.length; j++) {
                        if (formations[i].id == modules[j].formation_id) {
                            var url_module_detail = '{{ route("select_par_module", ":id") }}';
                            url_module_detail = url_module_detail.replace(':id', modules[j].module_id);
                            html += '<a href="'+url_module_detail+'">'+(modules[j].nom_module)+'</a>';
                        }
                    }
                html += '</dd>';
                html += '</dl>';
            }
            $(".dropdown>.dropdown-menu").css("display", "block");
            $('.sous-formation-row').append(html);
        },
        error:function(error){
            console.log(error)
        }
        });
        $(".sous-formation-content").on('mouseleave',function(e){
            $(".dropdown>.dropdown-menu").css("display", "none");
        });
    });

</script>

@endsection