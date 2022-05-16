@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Annuaire</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/annuaire.css')}}">
{{-- <link rel="stylesheet" href="{{asset('assets/css/modules.css')}}"> --}}

<div class="container-fluid pt-4">
    <div class="row fix_top_row">
        <div class="d-flex flex-row justify-content-between">
            <div class="">
                <h5>Les Organismes de Formations près de chez vous</h5>
            </div>
            <div class="d-flex flex-row ">
                <div class="d-flex flex-row pt-1"><span class="nombre_pagination text-center filter"><span style="position: relative; bottom: -0.2rem">{{$pagination["debut_aff"]."-".$pagination["fin_aff"]." sur ".$pagination["totale_pagination"]}}</span></div>
                {{-- =============== condition pagination ==================== --}}
                @if ($pagination["nb_limit"] >= $pagination["totale_pagination"])

                @if(isset($nom_entiter))
                {{-- -------- --}}
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

                @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))

                {{-- -------- --}}
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] - $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ])}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination pt-1'></i></a>
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] + $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' pt-1></i></a>

                @else
                {{-- -------- --}}
                <a href="{{ route('annuaire',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire',$pagination["debut_aff"] + $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

                @endif

                {{-- ======================= condition pagination=================== --}}

                @elseif (($pagination["debut_aff"]+$pagination["nb_limit"]) >= $pagination["totale_pagination"])

                @if(isset($nom_entiter))
                {{-- -------- --}}
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

                @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))

                {{-- -------- --}}
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] - $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ])}}" role="button"><i class='bx bx-chevron-left pagination pt-1'></i></a>
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] + $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination' pt-1></i></a>

                @else
                {{-- -------- --}}
                <a href="{{ route('annuaire',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire',$pagination["debut_aff"] + $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

                @endif

                {{-- =============== condition pagination ==================== --}}
                @elseif ($pagination["debut_aff"] == 1)

                @if(isset($nom_entiter))
                {{-- -------- --}}
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

                @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))

                {{-- -------- --}}
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] - $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ])}}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination pt-1'></i></a>
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] + $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ]) }}" role="button"><i class='bx bx-chevron-right pagination' pt-1></i></a>

                @else
                {{-- -------- --}}
                <a href="{{ route('annuaire',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire',$pagination["debut_aff"] + $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

                @endif

                {{-- =============== condition pagination ==================== --}}
                @elseif ($pagination["debut_aff"] == $pagination["fin_aff"] || $pagination["debut_aff"]> $pagination["fin_aff"])
                @if(isset($nom_entiter))
                {{-- -------- --}}
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

                @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))

                {{-- -------- --}}
                <a href="{{route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

                @else
                {{-- -------- --}}
                <a href="{{ route('annuaire',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire',$pagination["debut_aff"] + $pagination["nb_limit"]) }}" role="button" style=" pointer-events: none;cursor: default;"><i class='bx bx-chevron-right pagination'></i></a>

                @endif

                {{-- =============== condition pagination ==================== --}}
                @else

                @if(isset($nom_entiter))
                {{-- -------- --}}
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] - $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire+recherche+par+entiter',[($pagination["debut_aff"] + $pagination["nb_limit"]),$nom_entiter ]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

                @elseif(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))

                {{-- -------- --}}
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] - $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ])}}" role="button"><i class='bx bx-chevron-left pagination pt-1'></i></a>
                <a href="{{ route('annuaire+recherche+par+adresse',[($pagination["debut_aff"] + $pagination["nb_limit"]),$quartier,$ville,$code_postal,$region ]) }}" role="button"><i class='bx bx-chevron-right pagination' pt-1></i></a>

                @else
                {{-- -------- --}}
                <a href="{{ route('annuaire',$pagination["debut_aff"] - $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-left pagination'></i></a>
                <a href="{{ route('annuaire',$pagination["debut_aff"] + $pagination["nb_limit"]) }}" role="button"><i class='bx bx-chevron-right pagination'></i></a>

                @endif
                @endif

                @if(isset($quartier) && isset($ville) && isset($code_postal) && isset($region))
                <a href="{{route('annuaire')}}" class="btn_creer text-center filter  mx-2" role="button">
                    filtre activé <i class="fas fa-times"></i> </a>
                @elseif(isset($nom_entiter))
                <a href="{{route('annuaire')}}" class="btn_creer text-center filter  mx-2" role="button">
                    filtre activé <i class="fas fa-times"></i> </a>
                @endif

                <a href="#" class="btn_creer text-center filter mx-2 " role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
            </div>
        </div>
    </div>
    <section class="annuaire mb-5">
        <div class="container my-2">
            <div class="row justify-content-center">
                <div class="row mb-5 fix_top">
                    <div class="col-12 alphabet">
                        @foreach ($initial as $init)
                        <span title="{{$init->initial}}" class="lien_filtre activer" id="{{$init->initial}}" role="button">{{$init->initial}}</span>
                        @endforeach
                    </div>
                </div>

                <div class="col-9 justify-content-center px-5">
                    <div id="result">
                        @foreach ($cfps as $cfp)
                        <div class="row detail_content mb-5">
                            <div class="col-2 logo_content">
                                <a href="{{route('detail_cfp',$cfp->id)}}"><img src="{{asset("images/CFP/".$cfp->logo)}}" alt="logo" class="img-fliud logo_img"></a>
                            </div>
                            <div class="col-10 ">
                                <div class="row">
                                    <h4><a href="{{route('detail_cfp',$cfp->id)}}">{{$cfp->nom}}</a></h4>
                                    @if ($cfp->slogan!=null)
                                    <p>{{$cfp->slogan}}</p>
                                    @else
                                    <p>------------</p>
                                    @endif
                                    <div class="col d-flex flex-row mb-2">
                                        <span class="btn_actions ms-2" role="button"><a href="#"><i class="bx bx-mail-send"></i>Email</a></span>
                                        <span class="btn_actions ms-3 contact_action" role="button" data-bs-toggle="collapse" href="#contact_{{ $cfp->id }}" aria-expanded="false" aria-controls="collapseprojet"><i class="bx bx-phone"></i>Contact</span>
                                        <span class="btn_actions ms-3" role="button"><a href="https://{{$cfp->site_web}}" target="_blank"><i class="bx bx-globe"></i>Site
                                                Web</a></span>
                                        <span class="btn_actions ms-3" role="button"><a href="{{route('detail_cfp',$cfp->id)}}"><i class="bx bx-info-circle"></i>Plus d'infos</a></span>
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
                                </div>
                                <p class="mt-1 adresse"><i class="bx bxs-map"></i>
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
</div>
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
            console.log(JSON.stringify(dataValue));
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
console.log(JSON.stringify(response));
                    if (userData != null || undefined) {
                        let html = '';

                        for (let i = 0; i < userData.length; i++) {
                            console.log(userData);
                            let url_detail_cfp = '{{ route("detail_cfp", ":id") }}';
                            url_detail_cfp = url_detail_cfp.replace(":id", userData[i]['id']);

                            html += '<div class="row detail_content mb-5">';
                            html += '<div class="col-2 logo_content">';
                            html += '<a href="' + url_detail_cfp + '"><img src="{{ asset("images/CFP/:?") }}" alt="logo" class="img-fliud logo_img"></a>';
                            html += '</div>';
                            html += '<div class="col-10 detail_cfp">';
                            html += '<div class="row">';
                            html += '<h4><a href="' + url_detail_cfp + '">' + userData[i]['nom'] + '</a></h4>';
                            if (userData[i]['slogan'] != null) {
                                html += '<p>' + userData[i]['slogan'] + '</p>';
                            } else {
                                html += '<p>--------</p>';
                            }
                            html += '<div class="col d-flex flex-row mb-2">';
                            html += '<span class="btn_actions" role="button">';
                            html += '<a href="#"><i class="bx bx-mail-send"></i>Email</a>';
                            html += '</span>';
                            html += '<span class="btn_actions ms-3 contact_action" role="button" data-bs-toggle="collapse"href="#contact_' + userData[i]['id'] + '" aria-expanded="false" aria-controls="collapseprojet"><i class="bx bx-phone"></i>Contact</span>';
                            html += '<span class="btn_actions ms-3" role="button">';
                            html += '<a href="https://' + userData[i]['site_web'] + '" target="_blank"><i class="bx bx-globe"></i>Site Web</a>';
                            html += '</span>';
                            html += '<span class="btn_actions ms-3" role="button">';
                            html += '<a href="' + url_detail_cfp + '"><i class="bx bx-info-circle"></i>Plus d\'infos</a>';
                            html += '</span>';
                            html += '</div>';
                            html += '<div class="contact collapse" id="contact_' + userData[i]['id'] + '">';
                            html += '<div class="col-6 phone_detail">';
                            html += '<span class="text-muted">Téléphone</span>';

                            if (userData[i]['telephone'] != null) {
                                html += '<p class="m-0">' + userData[i]['telephone'] + '</p>';
                            } else {
                                html += '<p class="m-0">--------</p>';
                            }
                            html += '</div>';
                            html += '</div>';

                            html += '<p class="mt-1 adresse"><i class="bx bxs-map"></i>';
                            if (userData[i]['adresse_lot'] = !null) {
                                html += '' + userData[i]['adresse_lot'] + '';
                            } else {
                                html += '------';
                            }
                            html += '&nbsp;';
                            if (userData[i]['adresse_quartier'] != null) {
                                html += '' + userData[i]['adresse_quartier'] + '';
                            } else {
                                html += ' ------';
                            }
                            html += '&sbquo;&nbsp;';
                            if (userData[i]['adresse_ville'] != null) {
                                html += '' + userData[i]['adresse_ville'] + '';
                            } else {
                                html += '-------';
                            }
                            html += '&nbsp;';
                            if (userData[i]['adresse_code_postal'] != null) {
                                html += '' + userData[i]['adresse_code_postal'] + '';
                            } else {
                                html += '-------';
                            }
                            html += '&sbquo;&nbsp;';
                            if (userData[i]['adresse_region'] != null) {
                                html += '' + userData[i]['adresse_region'] + '';
                            } else {
                                html += '-------';
                            }
                            html += '</p>';

                            html += '</div>';
                            html += '</div>';
                            html += '</div>';
                            html = html.replace(':?', userData[i]['logo']);
                            if ($(this).hasClass('activer')) {
                                $(this).removeClass('activer').addClass("activer_filtre");
                            } else {
                                $(this).removeClass('activer_filtre').addClass("activer");
                            }
                        }

                        $("#result").empty();
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