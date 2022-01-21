@extends('./layouts/admin')
@section('content')
<div class="row">
    <div class="col-lg-3">
    </div>
<div class="col-lg-9">
 
<div class="formation__search">
    <div class="formation__search__form">
        <form class="" method="GET" action="{{route('result_formation')}}">
            {{-- <form action="{{ route('search') }}" method="GET">
                <input type="text" name="search" class="form-control" required/>: --}}
       @csrf
            <input type="text" id="reference_search" name="nom_formation" placeholder="Recherche Formation par example excel" class="form-control" autocomplete="off">
            <button type="submit" class="btn">
                <i class="fa fa-search"></i>
            </button>
        </form>
    </div>
</div>
@foreach ($categorie as $ctg )
<button type="button" class="btn btn" style="border-radius: 15px"><a href="{{route('select_par_module',$ctg->id)}}">{{$ctg->nom_formation}}</a></button>
@endforeach
<style>
    .btn{background-color: #801D68;color: white}
    .btn:hover{color:white}
</style>
   </div>   
</div>
<section class="detail__formation">
    <div class="container py-4">
        <div class="row detail__formation__result bg-light justify-content-space-between py-3 px-5">
            <div class="col-lg-6 col-md-6 detail__formation__result__content">
                <div class="detail__formation__result__item">
                    <h4 class="py-4">{{$infos->nom_formation}} - {{$infos->nom_module}}</h4>
                    <p>{{$infos->description}}</p>
                    <div class="detail__formation__result__avis">
                        <div class="Stars" style="--note: {{ $infos->pourcentage }};"></div>
                        <span><strong>{{ $infos->pourcentage }}</strong>/5 ({{ $nb_avis }} avis)</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 detail__formation__result__content">
                <div class="detail__formation__result__item2">
                    <a href="#"><h6 class="py-4 text-center">Formation Proposée par&nbsp;<span>{{$infos->nom}}</span></h6></a>
                    <div class="text-center"><img src="{{asset('images/CFP/'.$infos->logo)}}" alt="logo" class="img-fluid" style="width: 200px; height:100px;"></div>
                </div>
            </div>
            <div class="row row-cols-auto liste__formation__result__item3 justify-content-space-between py-4">
                    <div class="col"><i class="bx bxs-alarm bx_icon"></i>
                        <span>
                            @isset($infos->duree_jour)
                                {{$infos->duree_jour}} jours
                            @endisset
                        </span>
                        <span>
                            @isset($infos->duree)
                                /{{$infos->duree}} h
                            @endisset
                        </span> </p>
                    </div>
                    <div class="col"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$infos->modalite_formation}}</span></div>
                    <div class="col"><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$infos->niveau}}</span></div>
            </div>
        </div>
        <div class="row detail__formation__detail justify-content-space-between py-5 px-5">
            <div class="col-lg-9 detail__formation__content">
                {{-- section 0 --}}
                {{-- FIXME:mise en forme de design --}}
                <div class="row detail__formation__item__left__objectif">
                    <div class="col-lg-12">
                        <h3 class="pb-3">Objectifs</h3>
                        <p>{{$infos->objectif}}</p>
                        <a href="#programme__formation"><button type="button" class="btn btn-warning">Consulter le programme de cette formation</button></a>
                    </div>
                </div>
                {{-- section 1 --}}
                {{-- FIXME:mise en forme de design --}}
                    <h3 class="pt-3 pb-3">A qui s'adresse cette formation?</h3>
                    <div class="row detail__formation__item__left__adresse">
                        <div class="col-lg-5 d-flex flex-row">
                            <div class="row d-flex flex-row">
                                <span class="adresse__text"><i class="bx bx-user py-2 pb-3 adresse__icon"></i>&nbsp;Pour qui ?</span>
                                <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                                <div class="col-11"><p>{{$infos->cible}}</p></div>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <div class="row d-flex flex-row">
                                <span class="adresse__text"><i class="bx bx-list-plus py-2 pb-3 adresse__icon"></i>&nbsp;Prérequis</span>
                                <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                                <div class="col-11"><p>{{$infos->prerequis}}</p></div>
                            </div>
                            <div class="row d-flex flex-row">
                                <div class="col-1"><i class="bx bx-chevron-right"></i></div>
                                <div class="col-11"><p>Évaluez votre niveau en <a href="#">cliquant ici.</a> </p></div>
                            </div>
                        </div>
                        <div id="programme__formation"></div>
                    </div>
                {{-- section 3 --}}
                {{-- FIXME:mise en forme de design --}}
                <div class="row detail__formation__item__left">
                    <h3 class="pt-3 pb-3">Programme de la formation</h3>
                    <div></div>
                    <div class="col-lg-12">
                        <div class="row detail__formation__item__left__accordion">
                            <div class="accordion" id="accordion__program">
                                <?php $i=1 ?>
                                @foreach ($programmes as $prgc)
                                    <div class="card">
                                        <div class="card-header" id="heading1">
                                            <h2 class="mb-0"><button class="btn btn-block text-left"  type="button" data-toggle="collapse" data-target="#collapse{{$i}}" aria-expanded="true" id="icon" aria-controls="collapse1"><i class="bx bxs-plus-circle icon-prog-list" id="icon"></i>&nbsp;&nbsp;{{$i}} - {{$prgc->titre}}</button></h2>
                                        </div>
                                            @foreach ($cours as $c)
                                                @if($c->programme_id == $prgc->id)
                                                    <div id="collapse{{$i}}" class="collapse show" aria-labelledby="heading1" data-parent="#accordion__program">
                                                        <div class="card-body"> <i class="bx bx-chevron-right"></i>&nbsp;{{$c->titre_cours}}</div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        <?php $i++ ?>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                {{-- section 5 --}}
                {{-- FIXME:mise en forme de design --}}
                <div class="row detail__formation__programme__avis">
                    <div><h3 class="pt-5 pb-0">Avis sur la formation</h3></div>
                    <div class="col-12 mb-5">
                        <div class="card p-2 pt-1">
                            <div class="row detail__formation__programme__avis__rated d-flex">
                                <div class="col-md-4 text-center d-flex flex-column">
                                    <div class="rating-box">
                                        <h1 class="pt-4">{{ $infos->pourcentage }}</h1>
                                        <p class="">sur 5</p>
                                    </div>
                                    <div class="Stars" style="--note: {{ $infos->pourcentage }};"></div>
                                </div>
                                <div class="col-md-8 pt-2">
                                    <div class="table-rating-bar justify-content-center">
                                        <table class="text-left mx-auto">
                                            <tr>
                                                <td class="rating-label">Excellent</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        <div class="bar-5" style="--progress_bar: {{ $statistiques[0]->pourcentage_note }}%;"></div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ $statistiques[0]->pourcentage_note }}%</td>
                                            </tr>
                                            <tr>
                                                <td class="rating-label">Bien</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        <div class="bar-4" style="--progress_bar: {{ $statistiques[1]->pourcentage_note }}%;"></div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ $statistiques[1]->pourcentage_note }}%</td>
                                            </tr>
                                            <tr>
                                                <td class="rating-label">Moyenne</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        <div class="bar-3" style="--progress_bar: {{ $statistiques[2]->pourcentage_note }}%;"></div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ $statistiques[2]->pourcentage_note }}%</td>
                                            </tr>
                                            <tr>
                                                <td class="rating-label">Normal</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        <div class="bar-2" style="--progress_bar: {{ $statistiques[3]->pourcentage_note }}%;"></div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ $statistiques[3]->pourcentage_note }}%</td>
                                            </tr>
                                            <tr>
                                                <td class="rating-label">Terrible</td>
                                                <td class="rating-bar">
                                                    <div class="bar-container">
                                                        <div class="bar-1" style="--progress_bar: {{ $statistiques[4]->pourcentage_note }}%;"></div>
                                                    </div>
                                                </td>
                                                <td class="text-right">{{ $statistiques[4]->pourcentage_note }}%</td>
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
                                        <div class="col"><h5 class="mt-3 mb-0">{{ $avis->nom_stagiaire }} {{ $avis->prenom_stagiaire }}</h5></div>
                                        <div class="col"><p class="text-muted pt-5 pt-sm-3">{{ $avis->date_avis }}</p></div>
                                        <div class="col">
                                            <p class="text-left d-flex flex-row"><div class="Stars" style="--note: {{ $avis->note }};"></div>&nbsp;<span class="text-muted">{{ $avis->note }}</span></p>
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
                <div class="row detail__formation__item__main">
                    <div class="detail__prix__main__presentiel pt-3">
                        <div>
                            <p class="text-uppercase">{{$infos->modalite_formation}}</p>
                        </div>
                    </div>
                </div>
                <div class="row detail__formation__item__main">
                    <div class="col-lg-6 detail__prix__main__ref">
                        <div>
                            <p><i class="bx bx-clipboard"></i>&nbsp;Reference</p>
                        </div>
                    </div>
                    <div class="col-lg-6 detail__prix__main__ref2">
                        <div>
                            <p>{{ $infos->reference }}</p>
                        </div>
                    </div>
                </div>
                <hr class="hr">
                <div class="row detail__formation__item__main">
                    <div class="col-lg-6 detail__prix__main__dure">
                        <div>
                            <p><i class="bx bxs-alarm bx_icon"></i><span>&nbsp;Durée</span></p>
                        </div>
                    </div>
                    <div class="col-lg-6 detail__prix__main__dure2">
                        <div>
                            <p>
                                <span>
                                    @isset($infos->duree_jour)
                                        {{$infos->duree_jour}} jours
                                    @endisset
                                </span>
                                <span>
                                    @isset($infos->duree)
                                        /{{$infos->duree}} h
                                    @endisset
                                </span> </p>
                        </div>
                    </div>
                </div>
                <hr class="hr">
                <div class="row detail__formation__item__rmain">
                    <div class="col-lg-4 detail__prix__main__prix">
                        <div>
                            <p><i class='bx bx-euro'></i>&nbsp;Prix</p>
                        </div>
                    </div>
                    <div class="col-lg-8 detail__prix__main__prix2">
                        <div>
                            <p><span>{{number_format($infos->prix, 0, ' ', ' ')}}&nbsp;AR</span>&nbsp;HT</p>

                        </div>
                    </div>
                </div>
                <hr class="hr">
                <div class="row detail__formation__item__main">
                    <div class="col-lg-12 detail__prix__main__btn py-5">
                        <button type="submit" class="btn">Demander un dévis</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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