@extends('./layouts/admin')
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
    .filtre{
        overflow-y: scroll;
    }
</style>

<div id="page-wrapper">

    @if (Session::has('error'))
    <div class="alert alert-danger">
        <ul>
            <li>{{Session::get('error') }}</li>
        </ul>
    </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1>Appel d'offre</h1>
            </div>
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
        </nav>


        {{--
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="">
                    <form class="d-flex" method="POST" action="{{route('result_recherche_appel_offre')}}">
        @csrf
        <input type="text" id="reference_search" name="reference_search" placeholder="Recherche de la préstation de l'appel d'offre" class="form-control" autocomplete="off">
        <button type="submit" class="btn btn-success">
            <i class="fa fa-search"></i>
        </button>
        </form>
    </div>
</div>
</div> --}}



{{-- <div class="tab-pane fade" id="nav-offre_publier" role="tabpanel" aria-labelledby="nav-offre_publier-tab"> --}}

<div class="row">
    <div class="col-2 shadow mt-2 filtre">
        <h5>Critère</h5>
        <div class="row mt-0">
            <h6>
                <a data-bs-toggle="collapse" href="#detail_par_thematique" role="button" aria-expanded="false" aria-controls="detail_par_thematique">Recherche par thématique de formation</a>
            </h6>
            <div class="collapse multi-collapse" id="detail_par_thematique">
                <form class="mt-5 form_colab" action="{{route('recherche_thematique_formation')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="domaine" class="form-label" align="left">domaine<strong style="color:#ff0000;">*</strong></label>
                    <select class="form-select" aria-label="Default select example" name="domaine" id="domaine">
                        @foreach ($domaines as $domaine )
                        <option value="{{$domaine->id}}">{{$domaine->nom_domaine}}</option>
                        @endforeach
                    </select>
                    <br>
                    <label for="domaine" class="form-label" align="left">thématique<strong style="color:#ff0000;">*</strong></label>
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
                    Recherche par indication de thématique</a>
            </h6>
            <div class="collapse multi-collapse" id="indice_thematique">
                <form class="mt-5 form_colab" action="{{route('result_recherche_appel_offre')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="dte_debut" class="form-label" align="left">nom thématique <strong style="color:#ff0000;">*</strong></label> <br>
                    <input required type="text" class="form-control" name="reference_search" placeholder="nom thématique" />
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
                        <label for="dte_fin" class="form-label" align="left">à date <strong style="color:#ff0000;">*</strong></label> <br>
                        <input required type="date" name="dte_fin" class="form-control" /> <br>
                        <button type="submit" class="btn_enregistrer">recherche</button>
                    </form>
                </div>

        </div>
    </div>
    <div class="col mx-1 shadow">
        @if (count($appel_offre_publier) >0)
        @foreach($appel_offre_publier as $publier)
        <div class="row">
            <div class="col shadow">
                <table class="table">
                    <tbody>
                        <tr class="test">
                            <th scope="row">
                                <img src="{{asset('img/logo_formation/white_logo_color_background.jpg')}}" class="card-img-top" alt="..." style="width: 100px; height:40px;">
                                <br>
                                <p>{{$publier->nom_etp}}</p>
                                <p><a data-bs-toggle="collapse" href="#detail_{{$publier->id}}" role="button" aria-expanded="false" aria-controls="detail_{{$publier->id}}">détail</a></p>
                            </th>
                            <td>
                                <p>Référence: <a href="#detail_{{$publier->id}}" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="detail_{{$publier->id}}" role="button">
                                        <strong>{{$publier->reference_soumission}}</strong> </a>
                                </p>
                                <h6><strong class="fw-lighter">domaine </strong> {{$publier->nom_domaine}}</h6>
                                <h6><strong class="fw-lighter">thématique </strong> {{$publier->nom_formation}}</h6>
                                <h6><strong class="fw-lighter">postulé le, </strong> {{$publier->created_at}}</h6>
                                <h6><strong class="fw-lighter">cloturé le, </strong> {{$publier->date_fin}} <strong class="fw-lighter">à</strong> {{$publier->hr_fin}}</h6>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col mx-1">
                <div class="collapse multi-collapse" id="detail_{{$publier->id}}">

                    <span class="shadow p-3 bg-body row mt-1 mb-1 mx-1" style="width: 40rem;">
                        <div class="row">
                            <div class="col">
                                <div align="left">
                                    <img src="{{asset('img/logo_formation/white_logo_color_background.jpg')}}" class="card-img-top" alt="..." style="width: 100px; height:40px;">
                                    <h5>{{$publier->nom_etp}}</h5>
                                    <p>{{$publier->email_etp}}</p>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <h6 class="text-muted">{{$publier->nom_secteur}}</h6>
                            </div>
                        </div>
                        <div align="center" class="mt-2">
                            <h5> <strong> DETAIL DE L'APPEL D'OFFRE</strong></h5>
                        </div>
                        <h6>Réference: <strong>{{$publier->reference_soumission}}</strong></h6>
                        <h6><strong class="fw-lighter"> Recherche de formation </strong> <strong>{{$publier->nom_formation}}</strong> <strong class="fw-lighter"> du domaine</strong> <strong>{{$publier->nom_domaine}}</strong></h6>
                        <p class="text-muted">{{$publier->description_court}}</p>

                        <p><strong class="fw-lighter">L'offre a été postulé le</strong> <strong>{{$publier->created_at}}</strong>. <strong class="fw-lighter">Les interventions du préstataire s'étaleront à la date</strong> <strong>{{$publier->date_fin}}</strong> <strong class="fw-lighter">à</strong> <strong>{{$publier->hr_fin}}</strong></p>

                        <div class="row my-1">
                            <div class="col">
                                @php
                                echo html_entity_decode($publier->description) @endphp
                            </div>
                        </div>
                        <p>TDR: <a href="#">{{$publier->tdr_url}}</a></p>
                    </span>
                </div>

            </div>
        </div>
        @endforeach
        @else
        <h3>Aucun appel d'offre trouvé</h3>

        @endif
    </div>
</div>

</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $(document).on('change', '#domaine', function() {
        $("#thematique").empty();
        var id = $(this).val();
        $.ajax({
            url: "{{route('get_thematique')}}"
            , type: 'get'
            , data: {
                formation_id: id
            }
            , success: function(response) {
                var userData = response;
                if (userData.length <= 0) {
                    document.getElementById("thematique_id_err").innerHTML = "Aucun thématique a été détecter";
                } else {
                    document.getElementById("thematique_id_err").innerHTML = "";
                    for (var $i = 0; $i < userData.length; $i++) {
                        $("#thematique").append('<option value="' + userData[$i].id + '">' + userData[$i].nom_formation + '</option>');
                    }
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });
</script>

@endsection