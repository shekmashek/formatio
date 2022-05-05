@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Ajout programme</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/ajoutProgramme.css')}}">
<div class="row navigation_detail">
    <div class="ps-5 col justify-content-between d-flex flex-row">
        <div>
            <ul class="d-flex flex-row">
                <li class="me-5"><a href="#objectif">objectif</a></li>
                <li class="me-5"><a href="#pour_qui">pour qui ?</a></li>
                <li class="me-5"><a href="#programme">programme</a></li>
            </ul>
        </div>
        <div>
            <a class="new_list_nouvelle {{ Route::currentRouteNamed('liste_formation') ? 'active' : '' }}"
            href="{{route('liste_module')}}">
            <span class="btn_enregistrer text-center">Précedent</span>
        </a>
        </div>
    </div>
</div>
<section class="detail__formation">
    <div class="container py-4">
        <div class="row bg-light justify-content-space-between py-3 px-5">
            <div class="col-lg-6 col-md-6 detail__formation__result__content">
                <div class="detail__formation__result__item">
                    @foreach ($infos as $res)
                    <h4 class="py-4">{{$res->nom_module}}</h4>
                    <p>{{$res->nom_formation}}</p>
                    <p>{{$res->description}}</p>
                    <div class="detail__formation__result__avis">
                        <div class="Stars" style="--note: {{ $res->pourcentage }};"></div>
                        <span><strong>{{ $res->pourcentage }}</strong>/5 ({{ $nb_avis }} avis)</span>
                    </div>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 detail__formation__result__content">
                <div class="detail__formation__result__item2">
                        <h6 class="py-4 text-center">Formation Proposée par&nbsp;<span>{{$res->nom}}</span></h6>

                        <div class="text-center">
                            <img src="{{asset('images/CFP/'.$res->logo)}}" alt="logo" class="img-fluid" style="width: 200px; height:100px;">
                        </div>
                    @can('isReferent')
                    <a href="#">
                        <h6 class="py-4 text-center">Formation Proposée par&nbsp;<span>{{$res->nom}}</span></h6>

                        <div class="text-center">
                            <img src="{{asset('images/CFP/'.$res->logo)}}" alt="logo" class="img-fluid" style="width: 200px; height:100px;">
                        </div>
                    </a>
                    @endcan
                </div>
            </div>
            <div class="row row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                <div class="col"><i class="bx bxs-alarm bx_icon"></i>
                    <span>
                        @isset($res->duree_jour)
                        {{$res->duree_jour}} jours
                        @endisset
                    </span>
                    <span>
                        @isset($res->duree)
                        /{{$res->duree}} h
                        @endisset
                    </span> </p>
                </div>
                <div id="objectif"></div>
                <div class="col"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$res->modalite_formation}}</span>
                </div>
                <div class="col"><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$res->niveau}}</span></div>
            </div>
        </div>
        <div class="row detail__formation__detail justify-content-space-between py-5 px-5">
            <div class="col-lg-9 detail__formation__content">
                {{-- section 0 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pb-3">Objectifs de la formation  </h3>
                <div class="row detail__formation__item__left__objectif">
                    <div id="pour_qui"></div>
                    <div class="col-lg-12">
                        <p>{{$res->objectif}}</p>
                    </div>
                </div>
                {{-- section 1 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pt-3 pb-3">A qui s'adresse cette formation?</h3>
                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-5 d-flex flex-row">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i class="bx bx-user py-2 pb-3 adresse__icon"></i>&nbsp;Pour qui
                                ?</span>
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>{{$res->cible}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="row d-flex flex-row w-100">
                            <span class="adresse__text"><i
                                    class="bx bx-list-plus py-2 pb-3 adresse__icon"></i>&nbsp;Prérequis</span>
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>{{$res->prerequis}}</p>
                            </div>
                        </div>
                        <div class="row d-flex flex-row">
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>Évaluez votre niveau en <a href="#">cliquant ici.</a> </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-5 d-flex flex-row">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-cog py-2 pb-3 adresse__icon"></i>&nbsp;Equipement
                                necessaire</span>
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>{{$res->materiel_necessaire}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-message-check py-2 pb-3 adresse__icon"></i>&nbsp;Bon
                                a savoir</span>
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>{{$res->bon_a_savoir}}</p>
                            </div>
                        </div>
                        <div class="row d-flex flex-row">
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>Évaluez votre niveau en <a href="#">cliquant ici.</a> </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="programme"></div>
                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-12 d-flex flex-row">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bx-hive py-2 pb-3 adresse__icon"></i>&nbsp;Prestations
                                pedagogiques</span>
                            <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                            <div class="col-11">
                                <p>{{$res->prestation}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- section 3 --}}
                {{-- FIXME:mise en forme de design --}}
                @if (\Session::has('success'))
                    <div class="alert alert-success col-md-12">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                        <a href="{{route('liste_module')}}">Cliquez ici pour voir le module</a>
                    </div>
                @endif
                <div class="row detail__formation__item__left">
                    <h3 class="pt-3 pb-3">Programme de la formation</h3>
                    <div></div>
                    <div class="col-lg-12">
                        <form action="{{route('insert_prog_cours')}}" method="POST" class="w-100">
                            @csrf
                            <div class="row detail__formation__item__left__accordion">
                                <button type="button" id="addProg" class="btn_creer btn pb-2 w-50 mb-3" title="ajouter un nouveau programme">
                                    <i class='bx bx-plus-medical icon_creer'></i>
                                    Ajouter un nouveau section dans votre programme
                                </button>
                                <span role="button" class="accordion ">
                                    <input type="text" class="form-control input" name="titre_prog[0]" placeholder="Titre de votre programme" required>
                                </span>
                                <div class="panel" id="heading2">
                                    <span class="d-flex input_cours">
                                        <i class="bx bx-chevron-right pt-4"></i>&nbsp;<input type="text"
                                            class="form-control" name="cours_0[]" placeholder="Votre cours">
                                    </span>
                                    <span id="newCours0"></span>
                                    <button type="button" class="btn_creer ms-2 mb-2 mt-2 pb-2" id="addCours0" title="ajouter un nouveau cours">
                                        <i class='bx bx-plus-medical icon_creer'></i>
                                        Ajouter de point dans votre section
                                    </button>
                                </div>
                            </div>
                            <br>
                            <div id="newProg"></div>
                            <br>
                            <div class="form-row">
                                <input type="hidden" value="{{$id}}" name="id_module">
                                <button type="submit" class="btn btn-primary btn_enregistrer">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- section 5 --}}
                {{-- FIXME:mise en forme de design --}}
                <div class="row detail__formation__programme__avis">
                    <div>
                        <h3 class="pt-5 pb-0">Avis sur la formation</h3>
                    </div>
                    <div class="col-12 mb-5">
                        <div class="card p-2 pt-1">
                            <div class="row detail__formation__programme__avis__rated d-flex">
                                <div class="col-md-4 text-center d-flex flex-column">
                                    <div class="rating-box">
                                        <h1 class="pt-4">{{ $res->pourcentage }}</h1>
                                        <p class="">sur 5</p>
                                    </div>
                                    <div class="Stars" style="--note: {{ $res->pourcentage }};"></div>
                                </div>
                                <div class="col-md-8 pt-2">
                                    <div class="table-rating-bar justify-content-center">
                                        <table class="text-left mx-auto">
                                            <tr>
                                                <td class="rating-label">Excellent</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        {{-- <div class="bar-5"
                                                            style="--progress_bar: {{ $statistiques[0]->pourcentage_note }}%;">
                                                        </div> --}}
                                                    </div>
                                                </td>
                                                {{-- <td class="text-right">{{ $statistiques[0]->pourcentage_note }}%
                                                </td> --}}
                                            </tr>
                                            <tr>
                                                <td class="rating-label">Bien</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        {{-- <div class="bar-4"
                                                            style="--progress_bar: {{ $statistiques[1]->pourcentage_note }}%;">
                                                        </div> --}}
                                                    </div>
                                                </td>
                                                {{-- <td class="text-right">{{ $statistiques[1]->pourcentage_note }}%
                                                </td> --}}
                                            </tr>
                                            <tr>
                                                <td class="rating-label">Moyenne</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        {{-- <div class="bar-3"
                                                            style="--progress_bar: {{ $statistiques[2]->pourcentage_note }}%;">
                                                        </div> --}}
                                                    </div>
                                                </td>
                                                {{-- <td class="text-right">{{ $statistiques[2]->pourcentage_note }}%
                                                </td> --}}
                                            </tr>
                                            <tr>
                                                <td class="rating-label">Normal</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        {{-- <div class="bar-2"
                                                            style="--progress_bar: {{ $statistiques[3]->pourcentage_note }}%;">
                                                        </div> --}}
                                                    </div>
                                                </td>
                                                {{-- <td class="text-right">{{ $statistiques[3]->pourcentage_note }}%
                                                </td> --}}
                                            </tr>
                                            <tr>
                                                <td class="rating-label">Terrible</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        {{-- <div class="bar-1"
                                                            style="--progress_bar: {{ $statistiques[4]->pourcentage_note }}%;">
                                                        </div> --}}
                                                    </div>
                                                </td>
                                                {{-- <td class="text-right">{{ $statistiques[4]->pourcentage_note }}%
                                                </td> --}}
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="detail__formation__programme__avis__donnes">
                            @foreach ($liste_avis as $avis)
                            <div class="row">
                                <div class="d-flex flex-row">
                                    <div class="col">
                                        <h5 class="mt-3 mb-0">{{ $avis->nom_stagiaire }} {{ $avis->prenom_stagiaire }}
                                        </h5>
                                    </div>
                                    <div class="col">
                                        <p class="text-muted pt-5 pt-sm-3">{{ $avis->date_avis }}</p>
                                    </div>
                                    <div class="col">
                                        <p class="text-left d-flex flex-row">
                                        <div class="Stars" style="--note: {{ $avis->note }};"></div>&nbsp;<span
                                            class="text-muted">{{ $avis->note }}</span></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row ms-1">
                                <p>{{ $avis->commentaire }}</p>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- FIXME:mise en forme de design --}}
            <div class="col-lg-3 detail__formation__item__right">
                <div class="row detail__formation__item__main__head align-items-center">
                    <div class="detail__prix__head">
                        <div class="detail__prix__text">
                            <p class="pt-2"><b>INTRA</b></p>
                        </div>
                    </div>
                </div>
                <div class="row detail__formation__item__main mt-3 text-center">
                    <div class="col-lg-6 detail__prix__main__ref">
                        <div>
                            <p><i class="bx bx-clipboard"></i>&nbsp;Réf :</p>
                        </div>
                    </div>
                    <div class="col-lg-6 detail__prix__main__ref2">
                        <div>
                            <p>{{ $res->reference }}</p>
                        </div>
                    </div>
                </div>
                <hr class="hr">
                <div class="row detail__formation__item__main text-center">
                    <div class="col-lg-6 detail__prix__main__dure">
                        <div>
                            <p><i class="bx bxs-alarm bx_icon"></i><span>&nbsp;Durée :</span></p>
                        </div>
                    </div>
                    <div class="col-lg-6 detail__prix__main__dure2">
                        <div>
                            <p>
                                <span>
                                    @isset($res->duree_jour)
                                    {{$res->duree_jour}} jours
                                    @endisset
                                </span>
                                <span>
                                    @isset($res->duree)
                                    /{{$res->duree}} h
                                    @endisset
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
                <hr class="hr">
                <div class="row detail__formation__item__rmain text-center">
                    <div class="col-lg-6 detail__prix__main__prix">
                        <div >
                            <p>{{$devise->devise}}&nbsp;Prix : </p>
                        </div>
                    </div>
                    <div class="col-lg-6 detail__prix__main__prix2">
                        <div>
                            <p><span>{{number_format($res->prix, 0, ' ', ' ')}}&nbsp;{{$devise->devise}}</span>&nbsp;HT</p>

                        </div>
                    </div>
                </div>

              @can('isReferent')
              <hr class="hr">
              <div class="row detail__formation__item__main">
                <div class="col-lg-12 detail__prix__main__btn py-5">
                    <form action="{{route('demande_devis.store')}}" method="post">
                        @csrf
                        <input type="text" hidden name="module_id" value="{{$res->module_id}}">
                        <button type="submit" class="btn">Demander un dévis</button>
                    </form>

                </div>
            </div>
              @endcan


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

    $(document).on('click','#addCours0', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_0[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';

        $('#newCours0').append(html);
    });

    $(document).on('click','#addCours1', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_1[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours1').append(html);
    });

    $(document).on('click','#addCours2', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_2[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours2').append(html);
    });

    $(document).on('click','#addCours3', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_3[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours3').append(html);
    });

    $(document).on('click','#addCours4', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_4[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours4').append(html);
    });

    $(document).on('click','#addCours5', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_5[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours5').append(html);
    });

    $(document).on('click','#addCours6', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_6[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours6').append(html);
    });

    $(document).on('click','#addCours7', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_7[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours7').append(html);
    });

    $(document).on('click','#addCours8', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_8[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours8').append(html);
    });

    $(document).on('click','#addCours9', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_9[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours9').append(html);
    });

    $(document).on('click','#addCours10', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_10[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours10').append(html);
    });


    $(document).on('click','#addCours11', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_11[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';

        $('#newCours11').append(html);
    });

    $(document).on('click','#addCours12', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_12[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours12').append(html);
    });

    $(document).on('click','#addCours13', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_13[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours13').append(html);
    });

    $(document).on('click','#addCours14', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_14[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours14').append(html);
    });

    $(document).on('click','#addCours15', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_15[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours15').append(html);
    });

    $(document).on('click','#addCours16', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_16[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours17').append(html);
    });

    $(document).on('click','#addCours18', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_17[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours18').append(html);
    });

    $(document).on('click','#addCours19', function() {
        var html = '';
        html += '<span class="d-flex input_cours" id="headingcours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_18[]" placeholder="Votre cours">';
        html += '<span class="effacer_cours px-2 d-flex" role="button" title="Supprimer le cours" id="removeCours">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Effacer';
        html += '</span>';
        html += '</span>';


        $('#newCours19').append(html);
    });

    // remove row2
    $(document).on('click', '#removeCours', function() {
        $(this).closest('#headingcours').remove();
    });
    var i = 1;

    $(document).on('click','#addProg', function() {

        var html = '';
        html += '<div class="row detail__formation__item__left__accordion" id="heading1">';

        html += '<span role="button" class="accordion  d-flex">';
        html += '<input type="text" class="form-control" name="titre_prog['+i+']" placeholder="Titre de votre programme">';
        html += '<span class="suppression_programme px-2 pt-3 d-flex" role="button" title="Supprimer le cours" id="removeProg" title="Supprimer un programme">';
        html += '<i class="bx bx-x me-2">';
        html += '</i>Supprimer';
        html += '</span>';
        html += '</span>';

        html += '<div class="panel pb-4">';
        html += '<span class="d-flex input_cours">';
        html += '<i class="bx bx-chevron-right pt-4">';
        html += '</i>&nbsp;';
        html += '<input type="text" class="form-control" name="cours_'+i+'[]"  placeholder="Votre cours">';
        html += '</span>';
        html += '<span id="newCours'+i+'">';
        html += '</span>';
        html += '<span class="btn_creer px-2 ms-2 mb-2 mt-3 py-2" role="button" title="Supprimer le cours" id="addCours'+i+'" title="ajouter un nouveau cours">';
        html += '<i class="bx bx-plus-medical icon_creer">';
        html += '</i>Ajouter de point dans votre section';
        html += '</span>';
        html += '</div>';

        html += '</div>';

        $('#newProg').append(html);
        i = i+1;

    });

    // remove row1
    $(document).on('click', '#removeProg', function() {
        $(this).closest('#heading1').remove();
    });


    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }

</script>
@endsection