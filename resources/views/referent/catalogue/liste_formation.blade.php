@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Liste formation </h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/formation.css')}}">
<section class="">
    <div class="container">
        <div class="row">

            @if (count($infos)>0)
            <h2 class="">Tous les formations en :&nbsp;{{ $infos[0]->nom_formation }}</h2><br>
            <p></p>
            @endif
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif
        </div>
    </div>

    </div>
    <div class="container pb-5">
        <div class="row">
            <div class="col-lg-3 filtre_formation">
                <div class="row">
                    <p class="liste__formation__titre">Catégories</p>
                    <div class="form-check liste__formation__radio">
                        <input class="form-check-input" type="radio" name="flexRadioListe" id="flexRadioListe1" checked>
                        <label class="form-check-label" for="flexRadioListe1">Nos Formations</label>
                    </div>
                    <div class="form-check liste__formation__radio">
                        <input class="form-check-input" type="radio" name="flexRadioListe" id="flexRadioListe2">
                        <label class="form-check-label" for="flexRadioListe2">Tous nos Contenus</label>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">

                @if (count($infos)>0)

                @foreach ($infos as $info)
                <div class="row liste__formation justify-content-space-between mb-5">
                    <div class="col-lg-6 col-md-6 liste__formation__content">
                        <a href="{{route('select_par_module',$info->module_id)}}">
                            <div class="liste__formation__item">
                                <h4>{{$info->nom_module}}</h4>
                                <p class="description">{{$info->description}}</p>
                                <div class="liste__formation__avis">
                                    <div class="Stars" style="--note: {{ $info->pourcentage }};">

                                    </div>
                                    <span><strong>{{ $info->pourcentage }}</strong>/5</span>
                                </div>

                                <p class="mt-2 description">Formation proposée
                                    par&nbsp;<span class="">{{$info->nom}}</span>&nbsp;&nbsp;&nbsp;<img src="{{asset('images/CFP/'.$info->logo)}}" alt="logo" class="img-fluid" style="width: 100px; height:50px;"></p>

                            </div>
                        </a>
                    </div>

                    <div class="col-lg-6 col-md-6 text-end description">
                        <div class="liste__formation__item2">
                            <form action="{{route('demande_devis.store')}}" method="post">
                                @csrf
                                <input type="text" hidden name="module_id" value="{{$info->module_id}}">
                                <button type="submit" class=" btn btn_next mb-3">Démander
                                    un devis&nbsp;<i class="bx bxs-cart-add bx_icon"></i></button>
                            </form>

                            {{-- <a href="#">
                                <h6 class="devis_form">Démander un devis&nbsp;<i class="bx bxs-cart-add bx_icon"></i>
                                </h6>
                            </a> --}}
                            <p class="prix_ht"><span class="prix_ar">
                                    @php
                                    echo number_format($info->prix, 0, ' ', ' ');
                                    @endphp
                                    &nbsp;AR</span>&nbsp;HT</p>
                            <p>Réference : <span>{{$info->reference}}</span></p>
                        </div>

                    </div>
                    <div class="row row-cols-auto liste__formation__item3 justify-content-space-between description">
                        <div class="col"><i class="bx bx-alarm bx_icon"></i>
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
                        <div class="col"><i class="bx bx-certification bx_icon"></i><span>&nbsp;Certifiante</span>
                        </div>
                        <div class="col"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$info->modalite_formation}}</span>
                        </div>
                        <div class="col"><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$info->niveau}}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row w-100 justify-content-end">

                        <h6 class="mb-0 changer_caret d-flex pt-2 w-100" data-bs-toggle="collapse" href="#collapseprojet_{{$info->module_id}}" role="button" aria-expanded="false" aria-controls="collapseprojet">Afficher les dates&nbsp;<i class="bx bx-caret-down caret-icon"></i>
                        </h6>
                    </div>
                    <div class="details collapse detail_inter" id="collapseprojet_{{$info->module_id}}">
                        {{-- @if (count($datas)<=0)
                            <div class="row px-3 py-2">
                                <div class="col-3">
                                    <p>Aucun session inter</p>
                                </div>
                            </div>
                        @else --}}
                            <div class="row px-3 py-2">
                                <div class="col-3">
                                    <p>Prochaines Sessions</p>
                                </div>
                                <div class="col-5 date">
                                    @foreach ($datas as $data)
                                        @if($info->module_id == $data->module_id)
                                            <p>Du @php setlocale(LC_TIME, "fr_FR"); echo strftime("%d %B, %Y", strtotime($data->date_debut)); @endphp au @php setlocale(LC_TIME, "fr_FR"); echo strftime("%d %B, %Y", strtotime($data->date_fin)); @endphp</p>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="col-4">
                                    <p>Cette thématique vous intéresse ?
                                        Nos experts conçoivent votre formation
                                        sur-mesure ! Nous contacter</p>
                                        <button type="button" class="btn_next"><a href="{{route('select_par_module',$info->module_id)}}">Voir la Formation</a></button>
                                </div>
                            </div>
                        {{-- @endif --}}
                    </div>
                </div>
                @endforeach
                @else
                <h2>Aucun module pour cette formation.</h2>
                @endif
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
