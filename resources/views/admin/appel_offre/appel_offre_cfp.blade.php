@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Appel d'offre</p>
@endsection
@section('content')


    <style type="text/css">
        button,
        value {
            font-size: 12px;
        }

        .font_text strong,
        .font_text li,
        .font_text h3,
        .font_text h4,
        .font_text p {
            font-size: 12px;
        }

        .font_text h5,
        .font_text h6 {
            font-size: 10px;
        }

        .form_colab input {
            height: 30px;
        }

        .form_colab input::placeholder {
            font-size: 12px
        }

        .form_colab button {
            height: 30px;
            padding: 0;
            padding-left: 5px;
            padding-right: 5px;
            font-size: 13px;
        }

        .nav_bar_list:hover {
            background-color: transparent;
        }

        .nav_bar_list .nav-item:hover {
            border-bottom: 2px solid black;
        }

        .filtre {
            overflow-y: scroll;
        }

    </style>

    <div id="page-wrapper">

        @if (Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ Session::get('error') }}</li>
                </ul>
            </div>
        @endif

        <div class="container-fluid">
            {{-- <div class="row">
            <div class="col-md-12">
                <h1>Appel d'offre</h1>
            </div>
        </div> --}}

            {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('appel_offre.index') ? 'active' : '' }}" aria-current="page" href="{{route('appel_offre.index')}}">
                                Voir tous les listes des appels d'offres</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> --}}


            {{-- <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="">
                    <form class="d-flex" method="POST" action="{{route('result_recherche_appel_offre')}}">
        @csrf
        <input type="text" id="reference_search" name="reference_search" placeholder="Recherche de la pr??station de l'appel d'offre" class="form-control" autocomplete="off">
        <button type="submit" class="btn btn-success">
            <i class="fa fa-search"></i>
        </button>
        </form>
    </div>
</div>

</div> --}}



            {{-- <div class="tab-pane fade" id="nav-offre_publier" role="tabpanel" aria-labelledby="nav-offre_publier-tab"> --}}
            <div class="container-fluid mb-5">
                <div class="d-flex flex-row justify-content-end mt-3">
                    {{-- <span class="nombre_pagination"><span style="position: relative; bottom: -0.2rem">{{ $debut . '-' . $fin }}
                            sur {{ $nb_offre }}</span>
                        @if ($nb_par_page >= $nb_offre)
                            <a href="{{ route('appel_offre.publier', [1, $page - 1]) }}" role="button"
                                style=" pointer-events: none;cursor: default;"><i
                                    class='bx bx-chevron-left pagination'></i></a>
                            <a href="{{ route('appel_offre.publier', [1, $page + 1]) }}" role="button"
                                style=" pointer-events: none;cursor: default;"><i
                                    class='bx bx-chevron-right pagination'></i></a>
                        @elseif ($page == 1)
                            <a href="{{ route('appel_offre.publier', [1, $page - 1]) }}" role="button"
                                style=" pointer-events: none;cursor: default;"><i
                                    class='bx bx-chevron-left pagination'></i></a>
                            <a href="{{ route('appel_offre.publier', [1, $page + 1]) }}" role="button"><i
                                    class='bx bx-chevron-right pagination'></i></a>
                        @elseif ($page == $fin_page || $page > $fin_page)
                            <a href="{{ route('appel_offre.publier', [1, $page - 1]) }}" role="button"><i
                                    class='bx bx-chevron-left pagination'></i></a>
                            <a href="{{ route('appel_offre.publier', [1, $page + 1]) }}" role="button"
                                style=" pointer-events: none;cursor: default;"><i
                                    class='bx bx-chevron-right pagination'></i></a>
                        @else
                            <a href="{{ route('appel_offre.publier', [1, $page - 1]) }}" role="button"><i
                                    class='bx bx-chevron-left pagination'></i></a>
                            <a href="{{ route('appel_offre.publier', [1, $page + 1]) }}" role="button"><i
                                    class='bx bx-chevron-right pagination'></i></a>
                        @endif
                    </span> --}}
                    <a href="#" class="btn_creer text-center filter mt-3" role="button" onclick="afficherFiltre();"><i
                            class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
                </div>

                {{-- <div class="row">
    <div class="col-2  mt-2 filtre">
        <div class="filtrer mt-3" >
            <div class="row">
                <div class="col">
                    <p class="m-0">Filter vos projets</p>
                </div>
                <div class="col text-end">
                    <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
                </div>
            </div>
    
        </div> --}}
                {{-- <h5>Crit??re</h5>
        <div class="row mt-0">
            <h6>
                <a data-bs-toggle="collapse" href="#detail_par_thematique" role="button" aria-expanded="false" aria-controls="detail_par_thematique">Recherche par th??matique de formation</a>
            </h6>
            <div class="collapse multi-collapse" id="detail_par_thematique">
                <form class="mt-5 form_colab" action="{{route('recherche_thematique_formation')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="domaine" class="form-label" align="left">domaine<strong style="color:#ff0000;">*</strong></label>
                    <select class="form-select" aria-label="Default select example" name="domaine" id="domaine">
                        @foreach ($domaines as $domaine)
                        <option value="{{$domaine->id}}">{{$domaine->nom_domaine}}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="domaine" class="form-label" align="left">th??matique<strong style="color:#ff0000;">*</strong></label>
                    <select class="form-select" aria-label="Default select example" name="thematique" id="thematique">
                    </select>
                    <span style="color:#ff0000;" id="thematique_id_err"></span>
                    <br>
                    <button type="submit" class="btn_enregistrer">recherche</button>
                </form>
            </div>
        </div>

        <hr class="mt-1">
        <div class="row mt-0">
            <h6>
                <a data-bs-toggle="collapse" href="#indice_thematique" role="button" aria-expanded="false" aria-controls="indice_thematique">
                    Recherche par indication de th??matique</a>
            </h6>
            <div class="collapse multi-collapse" id="indice_thematique">
                <form class="mt-5 form_colab" action="{{route('result_recherche_appel_offre')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="dte_debut" class="form-label" align="left">nom th??matique <strong style="color:#ff0000;">*</strong></label> <br>
                    <input required type="text" class="form-control" name="reference_search" placeholder="nom th??matique" />
                    <br>
                    <button type="submit" class="btn_enregistrer">recherche</button>
                </form>
            </div>
        </div>
        <hr class="mt-1">

        <div class="row mt-0">
            <h6>    <a data-bs-toggle="collapse" href="#intervale_date" role="button" aria-expanded="false" aria-controls="intervale_date">
                Recherche par intervale des dates </a></h6>
                <div class="collapse multi-collapse" id="intervale_date">
                    <form class="mt-5 form_colab" action="{{route('recherche_intervale_date_appel_offre')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="dte_debut" class="form-label" align="left">entre date <strong style="color:#ff0000;">*</strong></label> <br>
                        <input required type="date" name="dte_debut" class="form-control" />
                        <br>
                        <label for="dte_fin" class="form-label" align="left">?? date <strong style="color:#ff0000;">*</strong></label> <br>
                        <input required type="date" name="dte_fin" class="form-control" /> <br>
                        <button type="submit" class="btn_enregistrer">recherche</button>
                    </form>
                </div>

        </div>
    </div> --}}
                <div class="row">

                    <div class="col mx-1 ">
                        @if (count($appel_offre_publier) > 0)
                            @foreach ($appel_offre_publier as $publier)
                                <div class="row">
                                    <div class="col ">
                                        <table class="table">
                                            <tbody>
                                                <tr class="test">
                                                    <th scope="row">
                                                        <span role="button" onclick="afficherInfos();">
                                                            <img src="{{asset('images/entreprises/'.$publier->logo)}}"
                                                                class="card-img-top" alt="..."
                                                                style="width: 100px; height:40px;">
                                                            <br>
                                                            <p>{{ $publier->nom_etp }}</p>
                                                        </span>
                                                        <p><a data-bs-toggle="collapse" href="#detail_{{ $publier->id }}"
                                                                role="button" aria-expanded="false"
                                                                aria-controls="detail_{{ $publier->id }}">d??tail</a></p>
                                                    </th>
                                                    <td>
                                                        <p>R??f??rence: <a href="#detail_{{ $publier->id }}"
                                                                data-bs-toggle="collapse" role="button"
                                                                aria-expanded="false"
                                                                aria-controls="detail_{{ $publier->id }}" role="button">
                                                                <strong>{{ $publier->reference_soumission }}</strong> </a>
                                                        </p>
                                                        <h6><strong class="fw-lighter">domaine </strong>
                                                            {{ $publier->nom_domaine }}</h6>
                                                        <h6><strong class="fw-lighter">th??matique </strong>
                                                            {{ $publier->nom_formation }}</h6>
                                                        <h6><strong class="fw-lighter">postul?? le, </strong>
                                                            {{ $publier->created_at }}</h6>
                                                        <h6><strong class="fw-lighter">clotur?? le, </strong>
                                                            {{ $publier->date_fin }} <strong
                                                                class="fw-lighter">??</strong> {{ $publier->hr_fin }}
                                                        </h6>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col mx-1">
                                        <div class="collapse multi-collapse" id="detail_{{ $publier->id }}">

                                            <span class=" p-3 bg-body row mt-1 mb-1 mx-1" style="width: 40rem;">
                                                <div class="row">
                                                    <div class="col">
                                                        <div align="left">
                                                           <img src="{{asset('images/entreprises/'.$publier->logo)}}" 
                                                                class="card-img-top" alt="..."
                                                                style="width: 100px; height:40px;">
                                                            <h5>{{ $publier->nom_etp }}</h5>
                                                            <p>{{ $publier->email_etp }}</p>
                                                            <p></p>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <h6 class="text-muted">{{ $publier->nom_secteur }}</h6>
                                                    </div>
                                                </div>
                                                <div align="center" class="mt-2">
                                                    <h5> <strong> DETAIL DE L'APPEL D'OFFRE</strong></h5>
                                                </div>
                                                <h6>R??ference: <strong>{{ $publier->reference_soumission }}</strong></h6>
                                                <h6><strong class="fw-lighter"> Recherche de formation </strong>
                                                    <strong>{{ $publier->nom_formation }}</strong> <strong
                                                        class="fw-lighter"> du domaine</strong>
                                                    <strong>{{ $publier->nom_domaine }}</strong></h6>
                                                <p class="text-muted">{{ $publier->description_court }}</p>

                                                <p><strong class="fw-lighter">L'offre a ??t?? postul?? le</strong>
                                                    <strong>{{ $publier->created_at }}</strong>. <strong
                                                        class="fw-lighter">Les interventions du pr??stataire s'??taleront
                                                        ?? la date</strong> <strong>{{ $publier->date_fin }}</strong>
                                                    <strong class="fw-lighter">??</strong>
                                                    <strong>{{ $publier->hr_fin }}</strong></p>

                                                <div class="row my-1">
                                                    <div class="col">
                                                        @php
                                                        echo html_entity_decode($publier->description); @endphp
                                                    </div>
                                                </div>
                                                <p>TDR: <a href="#">{{ $publier->tdr_url }}</a></p>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @else
                            <h3>Aucun appel d'offre trouv??</h3>
                        @endif
                    </div>
                </div>
            </div>
            <div class="filtrer mt-3">
                <div class="row">
                    <div class="col">
                        <p class="m-0">Filter vos projets</p>
                    </div>
                    <div class="col text-end">
                        <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
                    </div>
                </div>
                <hr class="mt-1">

                <div class="col-12 pe-3">
                    <div class="row mb-3 p-2 pt-0">
                        <div class="row mt-0">
                            <h6>
                                <a data-bs-toggle="collapse" href="#detail_par_thematique" role="button"
                                    aria-expanded="false" aria-controls="detail_par_thematique">Recherche par th??matique de
                                    formation</a>
                            </h6>
                            <div class="collapse multi-collapse" id="detail_par_thematique">
                                <form class="mt-5 form_colab" action="{{ route('recherche_thematique_formation') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="domaine" class="form-label" align="left">domaine<strong
                                            style="color:#ff0000;">*</strong></label>
                                    <select class="form-select" aria-label="Default select example" name="domaine"
                                        id="domaine">
                                        @foreach ($domaines as $domaine)
                                            <option value="{{ $domaine->id }}">{{ $domaine->nom_domaine }}</option>
                                        @endforeach
                                    </select>
                                    <br>
                                    <label for="domaine" class="form-label" align="left">th??matique<strong
                                            style="color:#ff0000;">*</strong></label>
                                    <select class="form-select" aria-label="Default select example" name="thematique"
                                        id="thematique">
                                    </select>
                                    <span style="color:#ff0000;" id="thematique_id_err"></span>
                                    <br>
                                    <button type="submit" class="btn_enregistrer">recherche</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-1">
                    <div class="row px-3 mt-2">
                        <div class="row mt-0">
                            <h6>
                                <a data-bs-toggle="collapse" href="#indice_thematique" role="button" aria-expanded="false"
                                    aria-controls="indice_thematique">
                                    Recherche par indication de th??matique</a>
                            </h6>
                            <div class="collapse multi-collapse" id="indice_thematique">
                                <form class="mt-5 form_colab" action="{{ route('result_recherche_appel_offre') }}"
                                    method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <label for="dte_debut" class="form-label" align="left">nom th??matique <strong
                                            style="color:#ff0000;">*</strong></label> <br>
                                    <input required type="text" class="form-control" name="reference_search"
                                        placeholder="nom th??matique" />
                                    <br>
                                    <button type="submit" class="btn_enregistrer">recherche</button>
                                </form>
                            </div>
                        </div>
                        <hr class="mt-1">
                        <div class="row px-3 mt-2">
                            <div class="row mt-0">
                                <h6> <a data-bs-toggle="collapse" href="#intervale_date" role="button" aria-expanded="false"
                                        aria-controls="intervale_date">
                                        Recherche par intervale des dates </a></h6>
                                <div class="collapse multi-collapse" id="intervale_date">
                                    <form class="mt-5 form_colab"
                                        action="{{ route('recherche_intervale_date_appel_offre') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <label for="dte_debut" class="form-label" align="left">entre date <strong
                                                style="color:#ff0000;">*</strong></label> <br>
                                        <input required type="date" name="dte_debut" class="form-control" />
                                        <br>
                                        <label for="dte_fin" class="form-label" align="left">?? date <strong
                                                style="color:#ff0000;">*</strong></label> <br>
                                        <input required type="date" name="dte_fin" class="form-control" /> <br>
                                        <button type="submit" class="btn_enregistrer">recherche</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-1">
                </div>
                </form>
            </div>
            <div class="infos mt-3">
                <div class="row">
                    <div class="col">
                        <p class="m-0">infos</p>
                    </div>
                    <div class="col text-end">
                        <i class="bx bx-x " role="button" onclick="afficherInfos();"></i>
                    </div>
                    <hr class="mt-2">
                   <span class="text-center"> <img src="{{asset('images/entreprises/'.$publier->logo)}}" style="height: 100px;width:100px"></span>  
                   <div style="font-size: 13px">
                        <div class="text-center mt-2">
                            <span>  {{$publier->nom_etp}}</span>
                        </div>
                        <div class="text-center mt-2">
                            <span>Email:{{$publier->email_etp}}</span>
                        </div>
                        <div class="text-center mt-2">
                            <span> T??l??phone:{{$publier->telephone_etp}}</span>
                        
                        </div>
                        <div class="text-center mt-2">
                            <span> Site web:{{$publier->site_etp}}</span>
                         </div>
                         
                        </div> 




                       

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script type="text/javascript">
        $(document).on('change', '#domaine', function() {
            $("#thematique").empty();
            var id = $(this).val();
            $.ajax({
                url: "{{ route('get_thematique') }}",
                type: 'get',
                data: {
                    formation_id: id
                },
                success: function(response) {
                    var userData = response;
                    if (userData.length <= 0) {
                        document.getElementById("thematique_id_err").innerHTML =
                            "Aucun th??matique a ??t?? d??tecter";
                    } else {
                        document.getElementById("thematique_id_err").innerHTML = "";
                        for (var $i = 0; $i < userData.length; $i++) {
                            $("#thematique").append('<option value="' + userData[$i].id + '">' +
                                userData[$i].nom_formation + '</option>');
                        }
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>

@endsection
