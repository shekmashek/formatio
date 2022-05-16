@extends('./layouts/admin')
@inject('groupe', 'App\groupe')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/formation.css')}}">
@if (Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{!! Session::get('error') !!}</li>
        </ul>
    </div>
@endif
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
                    <div class="dropdown">
                        <button class="dropbtn"><i class='bx bx-menu icon_dom fs-4 me-2'></i>Domaines des formations<i class="fa fa-caret-down ms-2"></i></button>
                        <div class="dropdown-content">
                            <div class="row flex-wrap">
                                @foreach ($domaines as $dom)
                                    <a href="#">{{$dom->nom_domaine}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <button class="btn" type="btn"></button>
                </div>
            </div>
        </ul>
    </div>
</div>
<section class="detail__formation mb-5">
    <nav class="navigation_details d-flex flex-row justify-content-between">
        <div>
            <ul class="d-flex flex-row">
                <li class="me-5"><a href="#objectif">objectif</a></li>
                <li class="me-5"><a href="#pour_qui">pour qui ?</a></li>
                <li class="me-5"><a href="#programme">programme</a></li>
                <li class="me-5"><a href="#avis">avis</a></li>
                <li class="me-5"><a href="#dates">dates</a></li>
            </ul>
        </div>
        <div>
            <button class="btn_pdf px-4 py-1" type="button"><i class='bx bxs-cloud-download me-3'></i>PDF</button>
        </div>
    </nav>
    <div class="container py-5">
        <div class="row justify-content-space-between py-3 px-5 back" id="border_premier">
            <div class="col-lg-8 col-md-8 pe-5 module_detail">
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
            <div class="col-lg-4 col-md-4 ">
                <div class="">
                    <a href="#">
                        <h6 class="py-4 text-center">Formation Proposée par&nbsp;<span>{{$res->nom}}</span></h6>
                    </a>
                    <div class="text-center"><img src="{{asset('images/CFP/'.$res->logo)}}" alt="logo" class="img-fluid"
                            style="width: 200px; height:100px;"></div>
                </div>
            </div>
            <div id="objectif"></div>
            <div class="row row-cols-auto module_detail_heure justify-content-around w-100">
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
                <div class="col"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$res->modalite_formation}}</span>
                </div>
                <div class="col"><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$res->niveau}}</span></div>
                <div class="col"><i class='bx bx-clipboard bx_icon'></i><span>&nbsp;{{$res->reference}}</span></div>
                <div class="col pt-1" ><span >{{$devise->devise}} &nbsp;<strong>{{number_format($res->prix, 0, ' ', ' ')}}</strong>&nbsp;HT</span></div>
                {{-- <div class="col pt-1" ><a href="#" role="button" class="btn_demander">Demander un dévis</a></div>
                 <div class="text-center mt-5"><a href="#" role="button" class="btn_demander">Demander un dévis</a></div> --}}
            </div>
        </div>
        <div class="row detail__formation__detail py-5">

            <div class="col-lg-9 pe-5">
                {{-- section 0 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pb-3">Objectifs de la formation</h3>
                <div class="row module_detail_content p-5">
                    <div class="col-lg-12">
                        <p>@php echo html_entity_decode($res->objectif) @endphp</p>
                        <div id="pour_qui"></div>
                    </div>
                </div>
                {{-- section 1 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pt-3 pb-3 mt-5">A qui s'adresse cette formation?</h3>
                <div class="row justify-content-between">
                    <div class="col d-flex flex-row module_detail_objet me-3">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i class="bx bx-user adresse__icon"></i>&nbsp;Pour qui
                                ?</span>
                            <div class="col-12 ps-4">
                                <p>@php echo html_entity_decode($res->cible) @endphp</p>
                            </div>
                        </div>
                    </div>

                    <div class="col module_detail_objet">
                        <div class="row d-flex flex-row w-100">
                            <span class="adresse__text"><i
                                    class="bx bx-list-plus adresse__icon"></i>&nbsp;Prérequis</span>
                            <div class="col-12 ps-4">
                                <p>@php echo html_entity_decode($res->prerequis) @endphp</p>
                            </div>
                        </div>
                        <div class="row d-flex flex-row">
                            <div class="col-12 ps-4">
                                <p>Évaluez votre niveau en <a href="#">cliquant ici.</a> </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-between">
                    <div class="col d-flex flex-row module_detail_objet me-3">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-cog adresse__icon"></i>&nbsp;Equipement
                                necessaire</span>
                            <div class="col-12 ps-4">
                                <p>@php echo html_entity_decode($res->materiel_necessaire) @endphp</p>
                            </div>
                        </div>
                    </div>

                    <div class="col module_detail_objet">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bxs-message-check adresse__icon"></i>&nbsp;Bon
                                a savoir</span>
                            <div class="col-12 ps-4">
                                <p>@php echo html_entity_decode($res->bon_a_savoir) @endphp</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row detail__formation__item__left__adresse">
                    <div class="col-lg-12 d-flex flex-row module_detail_objet">
                        <div class="row d-flex flex-row">
                            <span class="adresse__text"><i
                                    class="bx bx-hive adresse__icon"></i>&nbsp;Prestations
                                pedagogiques</span>
                            <div class="col-12 ps-4">
                                <p>@php echo html_entity_decode($res->prestation) @endphp</p>
                            </div>
                        </div>
                        <div id="programme"></div>
                    </div>
                </div>
                @endforeach
                <div id="programme__formation"></div>
                {{-- section 3 --}}
                {{-- FIXME:mise en forme de design --}}
                <h3 class="pt-3">Programme de la formation</h3>
                <div class="row mt-5">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="accordion" id="accordion__program">
                                <?php $i=1 ?>
                                @foreach ($programmes as $prgc)
                                <div class="card mb-5">
                                    <div class="card-header" id="heading1">
                                        <h2 class="mb-0"><button class="btn btn-block text-left" type="button"
                                                data-toggle="collapse" data-target="#collapse{{$i}}"
                                                aria-expanded="true" id="icon" aria-controls="collapse1">{{$i}} - {{$prgc->titre}}</button></h2>
                                    </div>
                                    @foreach ($cours as $c)
                                    @if($c->programme_id == $prgc->id)
                                    <div id="collapse{{$i}}" class="collapse show ps-3" aria-labelledby="heading1"
                                        data-parent="#accordion__program">
                                        <div class="card-body"> <i
                                                class="bx bx-chevron-right"></i>&nbsp;{{$c->titre_cours}}</div>
                                    </div>
                                    @endif
                                    @endforeach
                                    <?php $i++ ?>
                                </div>
                                @endforeach
                                <div id="avis"></div>
                            </div>
                        </div>
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
            <div class="col-lg-3 ">
                <div class="row detail__intra">
                    <div class="row g-0 m-0">
                        <div class="detail__prix">
                            <div class="detail__prix__text">
                                <p class="pt-2 text-uppercase"><b>competences a acquérir</b></p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-3">
                        @foreach ($competences as $compt)
                            <p><i class='bx bx-check-double text-success' ></i>&nbsp;{{$compt->titre_competence}}</p>
                        @endforeach
                    </div>
                    <div class="row g-0 m-0 detail_ref_ref">
                        <div class="col-lg-12 py-5">
                            <a href="#" role="button" class="btn_demander">Demander un dévis</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row ">
                <h3 class="pt-3 pb-3">Dates et Villes Session Inter</h3>
                <div class="col-lg-12">
                    <div class="row">
                        <div id="dates"></div>
                        <ul>
                            @foreach ($datas as $data)
                            <li class="date_ville px-2 mb-2">
                                <div class="row">
                                    <div class="col-3 text-center">
                                        <span>Du @php setlocale(LC_TIME, "fr_FR"); echo strftime("%d %B, %Y",
                                            strtotime($data->date_debut)); @endphp au @php setlocale(LC_TIME, "fr_FR");
                                            echo strftime("%d %B, %Y", strtotime($data->date_fin)); @endphp</span>
                                    </div>
                                    <div class="col-3 text-center">
                                        <span>
                                            @php
                                                echo $groupe->get_lieu_fromation($data->groupe_id);
                                            @endphp
                                        </span>
                                    </div>
                                    <div class="col-3 text-center">
                                        <span>{{ number_format($infos[0]->prix, 0, ' ', ' ') }} AR HT</span>
                                    </div>
                                    {{-- @canany(['isManager','isReferent','isStagiaire']) --}}
                                    @canany(['isReferent'])
                                        <div class="col-3 text-center">
                                            <a href="{{route('inscriptionInter',[$data->type_formation_id,$data->groupe_id])}}" class="btn_inscription" role="button">
                                                @php
                                                    $inscrit = $groupe->inscrit_session_inter($data->groupe_id);
                                                    if ($inscrit == 0) {
                                                        echo "S'inscrire";
                                                    }
                                                    if ($inscrit == 1) {
                                                        echo "Déjà inscrit";
                                                    }
                                                @endphp
                                            </a>
                                        </div>
                                    @endcanany
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
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