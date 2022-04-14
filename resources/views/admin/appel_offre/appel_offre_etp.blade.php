@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Appel d'offre</p>
@endsection
@section('content')

<!-- include summernote css/js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<style>
    text a {
        text-decoration-style: none;
        transition: all .5s ease-in-out;
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;

    }

    text a:hover {
        transform: scale(0.9);
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;

    }

    /* .test {
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    .test:hover {
        transform: scale(1);
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    } */

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
        {{-- <div class="row">
            <div class="col-md-12">
                <h1>Appel d'offre</h1>
            </div>
        </div> --}}

        {{-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @canany(['isReferent'])
                        <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('nouveau+appel+offre') || Route::currentRouteNamed('nouveau+appel+offre') ? 'active' : '' }}" href="{{route('nouveau+appel+offre')}}">
                                Nouveau appel d'offre</a>
                        </li>
                        @endcanany
                        <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('appel_offre.index') ? 'active' : '' }}" aria-current="page" href="{{route('appel_offre.index')}}">
                                Listes des appels d'offres</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> --}}

        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list">

                            <li class="nav-item me-5">
                                <a href="#" class="active" id="nav-offre_nom_publier-tab" data-bs-toggle="tab" data-bs-target="#nav-offre_nom_publier" type="button" role="tab" aria-controls="nav-offre_nom_publier" aria-selected="true">
                                    Appel d'offre non publié
                                    @if (count($appel_offre_non_publier) > 0)
                                    <strong style="color: red">({{count($appel_offre_non_publier)}})</strong>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item me-5">
                                <a href="#" class="" id="nav-offre_publier-tab" data-bs-toggle="tab" data-bs-target="#nav-offre_publier" type="button" role="tab" aria-controls="nav-offre_publier" aria-selected="false">
                                    Appel d'offre publié
                                    @if (count($appel_offre_publier) > 0)
                                    <strong style="color: red">({{count($appel_offre_publier)}})</strong>
                                    @endif
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="">
                    <a href="#" class="btn_creer text-center filter mt-3" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
                </div>
            </div>

        </div>

    </div>



    <div class="tab-content mt-1" id="nav-tabContent">

        <div class="tab-pane fade  show active" id="nav-offre_nom_publier" role="tabpanel" aria-labelledby="nav-offre_nom_publier-tab">

            {{-- <tr class="test">
                                <th scope="row">
                                    <a href="#multiCollapseExample1" data-bs-toggle="collapse"  role="button" aria-expanded="false" aria-controls="multiCollapseExample1" role="button">
                                    <img src="{{asset('img/logo_formation/white_logo_color_background.jpg')}}" class="card-img-top" alt="..." style="width: 100px; height:40px;">
            <br>
            <p>Nom Entreprise</p>
            </a>
            </th>
            <td>
                <p>Référence: <strong>PAGE-II/2022</strong></p>
                <h6><strong class="fw-lighter">domaine </strong> Bureautique</h6>
                <h6><strong class="fw-lighter">thématique </strong> EXCEL</h6>
                <h6><strong class="fw-lighter">postulé le, </strong> 01-01-2021</h6>
                <h6><strong class="fw-lighter">cloturé le, </strong> 01-01-2022 <strong class="fw-lighter">à</strong> 12:00</h6>
            </td>
            <td>
                <p>description courte</p>
            </td>
            </tr> --}}
            @if (count($appel_offre_non_publier) >0)

            @foreach ($appel_offre_non_publier as $nom_publier)
            <div class="row">
                <div class="col">
                    <table class="table">
                        <tbody>

                            <tr class="test">
                                <th scope="row">
                                    <img src="{{asset('images/entreprises/'.$non_publier->logo)}}" class="card-img-top" alt="..." style="width: 100px; height:40px;">
                                    <br>
                                    <p>{{$nom_publier->nom_etp}}</p>
                                    <p><a data-bs-toggle="collapse" href="#detail_{{$nom_publier->id}}" role="button" aria-expanded="false" aria-controls="detail_{{$nom_publier->id}}">détail</a></p>
                                    @canany(['isReferent'])
                                    <p><a data-bs-toggle="collapse" href="#multiCollapseExample1_{{$nom_publier->id}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1_{{$nom_publier->id}}"><i class="bx bxs-plus-circle"></i>modifier</a></p>
                                    @endcanany
                                </th>
                                <td>
                                    <p>Référence: <a href="#detail_{{$nom_publier->id}}" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="detail_{{$nom_publier->id}}" role="button">
                                            <strong>{{$nom_publier->reference_soumission}}</strong> </a>
                                    </p>
                                    <h6><strong class="fw-lighter">domaine </strong> {{$nom_publier->nom_domaine}}</h6>
                                    <h6><strong class="fw-lighter">thématique </strong> {{$nom_publier->nom_formation}}</h6>
                                    <h6><strong class="fw-lighter">postulé le, </strong> {{$nom_publier->created_at}}</h6>
                                    <h6><strong class="fw-lighter">cloturé le, </strong> {{$nom_publier->date_fin}} <strong class="fw-lighter">à</strong> {{$nom_publier->hr_fin}}</h6>
                                    <h6>
                                        <div align="left">
                                            <a href="{{route('appel_offre.publier',$nom_publier->id)}}" class="btn btn-lg btn_enregistrer">Publier</a>
                                        </div>
                                    </h6>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col">
                    <div class="collapse multi-collapse" id="detail_{{$nom_publier->id}}">

                        <span class="p-3 bg-body row mt-1 mb-1 mx-1" style="width: 40rem;">
                            <div class="row">
                                <div class="col">
                                    <div align="left">
                                        <img src="{{asset('images/entreprises/'.$non_publier->logo)}}" class="card-img-top" alt="..." style="width: 100px; height:40px;">
                                        <h5>{{$nom_publier->nom_etp}}</h5>
                                        <p>{{$nom_publier->email_etp}}</p>
                                        <p></p>
                                    </div>
                                </div>
                                <div class="col">
                                    <h6 class="text-muted">{{$nom_publier->nom_secteur}}</h6>
                                </div>
                            </div>
                            <div align="center" class="mt-2">
                                <h5> <strong> DETAIL DE L'APPEL D'OFFRE</strong></h5>
                            </div>
                            <h6>Réference: <strong>{{$nom_publier->reference_soumission}}</strong></h6>
                            <h6><strong class="fw-lighter"> Recherche de formation </strong> <strong>{{$nom_publier->nom_formation}}</strong> <strong class="fw-lighter"> du domaine</strong> <strong>{{$nom_publier->nom_domaine}}</strong></h6>
                            <p class="text-muted">{{$nom_publier->description_court}}</p>

                            <p><strong class="fw-lighter">L'offre a été postulé le</strong> <strong>{{$nom_publier->created_at}}</strong>. <strong class="fw-lighter">Les interventions du préstataire s'étaleront à la date</strong> <strong>{{$nom_publier->date_fin}}</strong> <strong class="fw-lighter">à</strong> <strong>{{$nom_publier->hr_fin}}</strong></p>

                            <div class="row my-1">
                                <div class="col">
                                    @php
                                    echo html_entity_decode($nom_publier->description) @endphp
                                </div>
                            </div>
                            <p>TDR: <a href="#">{{$nom_publier->tdr_url}}</a></p>
                        </span>
                    </div>

                    <div class="collapse multi-collapse mt-1 mb-1 mx-1" id="multiCollapseExample1_{{$nom_publier->id}}">

                        <span class=" p-3 bg-body row mx-1" style="width: 40rem;">
                            <form action="{{route('appel_offre.update',$nom_publier->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div align="center" class="mt-2">
                                    <h5> <strong> MODIFICATION DE L'APPEL D'OFFRE</strong></h5>
                                </div>
                                <h6>Réference: <strong>{{$nom_publier->reference_soumission}}</strong></h6>
                                <textarea class="form-control" id="reference_soumission" placeholder="référence de soumission" rows="2" cols="10" name="reference_soumission">{{$nom_publier->reference_soumission}}</textarea>
                                @error('reference_soumission')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror

                                <div class="row">
                                    <div class="col-4">
                                        <label for="domaine" class="form-label" align="left">Domaine<strong style="color:#ff0000;">*</strong></label>
                                        <select class="form-select" aria-label="Default select example" name="domaine" id="domaine">
                                            <option selected>veuillez choisir</option>
                                            @foreach ($domaines as $domaine )
                                            <option value="{{$domaine->id}}">{{$domaine->nom_domaine}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <label for="thematique" class="form-label" align="left">Thématique<strong style="color:#ff0000;">*</strong></label>
                                        <select class="form-select" aria-label="Default select example" name="thematique" id="thematique">
                                            <option value="{{$nom_publier->formation_id}}">{{$nom_publier->nom_formation}}</option>
                                        </select>
                                        <span style="color:#ff0000;" id="thematique_id_err"></span>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="desc_courte" class="form-label" align="left">Description Courte du thématique<strong style="color:#ff0000;">*</strong></label>
                                    <textarea class="form-control" id="desc_court" rows="2" name="desc_court">{{$nom_publier->description_court}}</textarea>
                                    @error('desc_courte')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>
                                <div class="row">
                                    <p>Les interventions du préstataire s'étaleront à la date</p>
                                    <div class="col-4">
                                        <label for="dte" class="form-label" align="left">Date finale de soumission<strong style="color:#ff0000;">*</strong></label>
                                        <input type="date" autocomplete="off" required name="dte" class="form-control " id="dte" value="{{$nom_publier->date_fin}}" />
                                        @error('dte')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="hr" class="form-label" align="left">Heure finale de soumission<strong style="color:#ff0000;">*</strong></label>
                                        <input type="time" autocomplete="off" required name="hr" class="form-control  mt-2" id="hr" value="{{$nom_publier->hr_fin}}" />
                                        @error('hr')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="desc_detailer" class="form-label" align="left">Description détailé<strong style="color:#ff0000;">*</strong></label>
                                        <textarea class="form-control" id="desc_detailer" rows="20" name="desc_detailer">{{$nom_publier->description}}</textarea>

                                        @error('desc_detailer')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div align="center">
                                    <button type="submit" class="btn btn-lg btn_enregistrer"> Modifier </button>
                                </div>


                        </span>
                    </div>

                </div>
            </div>

            @endforeach
            @else
            <h4>Acun Appel d'offre non publié</h4>
            @endif
        </div>


        <div class="tab-pane fade" id="nav-offre_publier" role="tabpanel" aria-labelledby="nav-offre_publier-tab">

            @if (count($appel_offre_publier) >0)
            @foreach($appel_offre_publier as $publier)
            <div class="row">
                <div class="col">
                    <table class="table">
                        <tbody>
                            <tr class="test">
                                <th scope="row">
                                    <img src="{{asset('images/entreprises/'.$publier->logo)}}" class="card-img-top" alt="..." style="width: 100px; height:40px;">
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
                <div class="col">
                    <div class="collapse multi-collapse" id="detail_{{$publier->id}}">

                        <span class=" p-3 bg-body row mt-1 mb-1 mx-1" style="width: 40rem;">
                            <div class="row">
                                <div class="col">
                                    <div align="left">
                                        <img src="{{asset('images/entreprises/'.$publier->logo)}}" class="card-img-top" alt="..." style="width: 100px; height:40px;">
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
            <h3>Aucun appel d'offre publié</h3>
            @endif
        </div>
        <div class="filtrer mt-3">
            <div class="row">
                <div class="col">
                    <p class="m-0">Filter vos appel d'offre</p>
                </div>
                <div class="col text-end">
                    <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
                </div>
                <hr class="mt-2">
                <form class="d-flex" method="POST" action="{{route('result_recherche_appel_offre')}}">
                    @csrf
                    <input type="text" id="reference_search" name="reference_search" placeholder="Recherche de la préstation de l'appel d'offre" class="form-control" autocomplete="off">
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>





        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <script type="text/javascript">
            $('#desc_detailer').summernote({
                placeholder: "description détailer de votre appel d'offre"
                , tabsize: 2
                , height: 500
            , });
            // $('#information_generale').summernote({
            //     placeholder: 'liste des informations generale'
            //     , tabsize: 2
            //     , height: 100
            // });
            // $('#exigence_soumission').summernote({
            //     placeholder: 'liste des exigences de soumission'
            //     , tabsize: 2
            //     , height: 100
            // });


            // $('#prestation').summernote({
            //     placeholder: 'objectif de la formation'
            //     , tabsize: 2
            //     , height: 100
            // });
            // $('#contexte').summernote({
            //     placeholder: 'contexte  de la préstation'
            //     , tabsize: 2
            //     , height: 100
            // });

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
