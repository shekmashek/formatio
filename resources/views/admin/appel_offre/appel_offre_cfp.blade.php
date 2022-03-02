@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/appel.css')}}">
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
    <div class="col-10">
        @if (count($appel_offre_publier) >0)
        @foreach($appel_offre_publier as $pub)
        <div class="row d-flex flex-row">
            {{-- <div class="col-6 d-flex flex-wrap">
                <ul>
                    <li class="list_appel">
                        <div class="row d-flex flex-row">
                            <div class="col-4">
                                <img src="{{asset('img/logo_formation/white_logo_color_background.jpg')}}" class="img-fluid" alt="...">
                            </div>
                            <div class="col-4">
                                <p>{{$pub->nom_etp}}</p>
                            </div>
                            <div class="col-4">
                                <p><a data-bs-toggle="collapse" href="#detail_{{$pub->id}}" role="button" aria-expanded="false" aria-controls="detail_{{$pub->id}}">détail</a></p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div> --}}
            <div class="col content_appel">
                <table class="table">
                    <tbody>
                        <tr class="test">
                            <th scope="row">
                                <img src="{{asset('img/logo_formation/white_logo_color_background.jpg')}}" class="card-img-top" alt="..." style="width: 100px; height:40px;">
                                <br>
                                <p>{{$pub->nom_etp}}</p>
                                <p><a data-bs-toggle="collapse" href="#detail_{{$pub->id}}" role="button" aria-expanded="false" aria-controls="detail_{{$pub->id}}">détail</a></p>
                            </th>
                            <td>
                                <p>Référence: <a href="#detail_{{$pub->id}}" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="detail_{{$pub->id}}" class="detail" role="button">
                                        <strong>{{$pub->reference_soumission}}</strong> </a>
                                </p>
                                <h6><strong class="fw-lighter">domaine </strong> {{$pub->nom_domaine}}</h6>
                                <h6><strong class="fw-lighter">thématique </strong> {{$pub->nom_formation}}</h6>
                                <h6><strong class="fw-lighter">postulé le, </strong> {{$pub->created_at}}</h6>
                                <h6><strong class="fw-lighter">cloturé le, </strong> {{$pub->date_fin}} <strong class="fw-lighter">à</strong> {{$pub->hr_fin}}</h6>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col mx-1 details_appel">
                <div class="collapse multi-collapse" id="detail_{{$pub->id}}">
                    <span class="shadow p-3 bg-body row mt-1 mb-1 mx-1" style="width: 40rem;">
                        <div class="row">
                            <div class="col">
                                <div align="left">
                                    <img src="{{asset('img/logo_formation/white_logo_color_background.jpg')}}" class="card-img-top" alt="..." style="width: 100px; height:40px;">
                                    <h5>{{$pub->nom_etp}}</h5>
                                    <p>{{$pub->email_etp}}</p>
                                    <p></p>
                                </div>
                            </div>
                            <div class="col">
                                <h6 class="text-muted">{{$pub->nom_secteur}}</h6>
                            </div>
                        </div>
                        <div align="center" class="mt-2">
                            <h5> <strong> DETAIL DE L'APPEL D'OFFRE</strong></h5>
                        </div>
                        <h6>Réference: <strong>{{$pub->reference_soumission}}</strong></h6>
                        <h6><strong class="fw-lighter"> Recherche de formation </strong> <strong>{{$pub->nom_formation}}</strong> <strong class="fw-lighter"> du domaine</strong> <strong>{{$pub->nom_domaine}}</strong></h6>
                        <p class="text-muted">{{$pub->description_court}}</p>

                        <p><strong class="fw-lighter">L'offre a été postulé le</strong> <strong>{{$pub->created_at}}</strong>. <strong class="fw-lighter">Les interventions du préstataire s'étaleront à la date</strong> <strong>{{$pub->date_fin}}</strong> <strong class="fw-lighter">à</strong> <strong>{{$pub->hr_fin}}</strong></p>

                        <div class="row my-1">
                            <div class="col">
                                @php
                                echo html_entity_decode($pub->description) @endphp
                            </div>
                        </div>
                        <p class="appel_download">TDR: <a href="#" ><i class="bx bxs-cloud-download"></i>télécharger</a></p>
                    </span>
                </div>
            </div>
            @endforeach
        </div>
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

    $(".detail").on('click', function() {
        $(".details_appel").css("display","block");
        $(".details_appel").css("display","none");
    })


</script>

@endsection
