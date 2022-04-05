@extends('./layouts/admin')
@section('content')

<!-- include summernote css/js -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>



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
        </div>

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
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

        <div class="row mt-2">
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
                    <form class="d-flex" method="POST" action="{{route('result_recherche_appel_offre')}}">
                        @csrf
                        <input type="text" id="reference_search" name="reference_search" placeholder="Recherche de la préstation de l'appel d'offre" class="form-control" autocomplete="off">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>



    <div class="tab-content mt-5" id="nav-tabContent">

        <div class="tab-pane fade  show active" id="nav-offre_nom_publier" role="tabpanel" aria-labelledby="nav-offre_nom_publier-tab">


            @if (count($appel_offre_non_publier) >0)

            @foreach($appel_offre_non_publier as $offre)

            <div class="row">
                <div class="col">
                    <span class="shadow p-3 mb-5 bg-body row mx-2" style="width: 40rem;">
                        <div class="row">
                            <div class="col">
                                <div align="left">
                                    <img src="{{asset('img/logo_formation/white_logo_color_background.jpg')}}" class="card-img-top" alt="..." style="width: 100px; height:40px;">
                                    <h5>{{$offre->nom_etp}}</h5>
                                    <h6 class="text-muted"> {{$offre->nom_secteur}}</h6>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col" align="center">
                                <h5>APPEL D'OFFRES OUVERT <strong>{{$offre->reference_soumission}}</strong>
                                </h5>
                            </div>
                        </div>
                        @canany(['isReferent'])
                        <p><button type="button" class="btn" style="background-color: #9C27B0; color: white" data-bs-toggle="collapse" href="#multiCollapseExample1_{{$offre->id}}" role="button" aria-expanded="false" aria-controls="multiCollapseExample1_{{$offre->id}}"><i class="bx bxs-plus-circle"></i>Modifier</button></p>
                        @endcanany
                        <p class="card-text">
                            @php
                            echo html_entity_decode($offre->prestation_demande);
                            @endphp
                        </p>
                        <p class="card-text">
                            Les interventions du prestataire s'étaleront à la date {{$offre->date_fin}} à heure {{$offre->hr_fin}}
                        </p>
                        <div class="row mt-1">
                            <div class="col" align="left">
                                <h6>I-Information génerale:</h6>
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-10">
                                        @php
                                        echo html_entity_decode($offre->information_generale);
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col" align="left">
                                <h6>II-Exigence et condition de soumission:</h6>
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-10">
                                        @php
                                        echo html_entity_decode($offre->exigence_soumission);
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-1">
                            <div class="col" align="left">
                                <h6>III-Liste des dossiers à fournir:</h6>
                                <div class="row">
                                    <div class="col-1"></div>
                                    <div class="col-10">
                                        @php
                                        echo html_entity_decode($offre->dossier_fournir);
                                        @endphp
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="card-text">TDR: <a href="#" class="card-link">{{$offre->tdr_url}}</a></p>
                        <p class="card-text">contactez-nous par: <a href="#" class="card-link">{{$offre->email_etp}}</a></p>
                      <a href="{{route('appel_offre.publier',$offre->id)}}"> <button type="button" class="btn btn-lg" style="background-color: #9C27B0; color: white"><span class="fa fa-save"></span>&nbsp; publier</a>

                    </span>
                </div>

                <div class="col">
                    <div class="collapse multi-collapse" id="multiCollapseExample1_{{$offre->id}}">



                        <span class="shadow p-3 mb-5 bg-body row mx-2" style="width: 40rem;">
                            <form action="{{route('appel_offre.update',$offre->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col">
                                        <div align="left">
                                            <img src="{{asset('img/logo_formation/white_logo_color_background.jpg')}}" class="card-img-top" alt="..." style="width: 100px; height:40px;">
                                            <h5>{{$offre->nom_etp}}</h5>
                                            <h6 class="text-muted"> {{$offre->nom_secteur}}</h6>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col" align="center">
                                        <h5>APPEL D'OFFRES OUVERT</strong>
                                        </h5>
                                    </div>
                                </div>

                                <textarea class="form-control" id="reference_soumission" placeholder="référence de soumission" rows="2" cols="10" name="reference_soumission">{{$offre->reference_soumission}}</textarea>
                                @error('reference_soumission')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror


                                {{-- <p class="card-text">
                                @php
                                echo html_entity_decode($offre->prestation_demande);
                                @endphp
                            </p> --}}

                                <label for="prestation" class="form-label" align="left">Préstation démander (objectif de la formation)<strong style="color:#ff0000;">*</strong></label>
                                <textarea class="form-control" id="prestation" placeholder="objectif de la formation" rows="2" cols="10" name="prestation">{{$offre->prestation_demande}}</textarea>
                                @error('reference_soumission')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror

                                <div class="form-group">
                                    <label for="contexte" class="form-label" align="left">Contexte de la préstation<strong style="color:#ff0000;">*</strong></label>
                                    <textarea class="form-control" id="contexte" rows="4" name="contexte">
                                    {{$offre->contexte_prestation}}
                                    </textarea>

                                    @error('contexte')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>

                                <p class="card-text">
                                    Les interventions du prestataire s'étaleront à la
                                </p>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="dte" class="form-label" align="left">Date finale de soumission<strong style="color:#ff0000;">*</strong></label>
                                            <input type="date" autocomplete="off" required name="dte" class="form-control " id="dte" value="{{$offre->date_fin}}" />
                                            @error('dte')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="hr" class="form-label" align="left">Heure finale de soumission<strong style="color:#ff0000;">*</strong></label>
                                            <input type="time" autocomplete="off" required name="hr" class="form-control  mt-2" id="hr" value="{{$offre->hr_fin}}" />
                                            @error('hr')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="information_generale" class="form-label" align="left">I-Information générale<strong style="color:#ff0000;">*</strong></label>
                                    <textarea class="form-control" id="information_generale" cols="30" rows="10" name="information_generale">
                                    {{$offre->information_generale}}
                                    </textarea>
                                    @error('information_generale')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="exigence_soumission" class="form-label" align="left">II-Exigence et Condition de soumission<strong style="color:#ff0000;">*</strong></label>
                                    <textarea class="form-control" id="exigence_soumission" cols="30" rows="10" name="exigence_soumission">
                                    {{$offre->exigence_soumission}}
                                    </textarea>
                                    @error('information_geenrale')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="dossier_fournir" class="form-label" align="left">III-Liste des dossiers à fournir<strong style="color:#ff0000;">*</strong></label>
                                    <textarea class="form-control" id="dossier_fournir" cols="30" rows="10" name="dossier_fournir">
                                    {{$offre->dossier_fournir}}
                                    </textarea>
                                    @error('dossier_fournir')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-lg" style="background-color: #9C27B0; color: white"><span class="fa fa-save"></span>&nbsp; modifier
                            </form>


                        </span>

                    </div>
                </div>

            </div>
        </div>




        @endforeach
        @else
        <h3>Aucun appel d'offre non publié</h3>

        @endif

    </div>

    <div class="tab-pane fade" id="nav-offre_publier" role="tabpanel" aria-labelledby="nav-offre_publier-tab">

        @if (count($appel_offre_publier) >0)
        @foreach($appel_offre_publier as $publier)

        <span class="shadow p-3 mb-5 bg-body row mx-2" style="width: 40rem;">
            <div align="left">
                <img src="{{asset('img/logo_formation/white_logo_color_background.jpg')}}" class="card-img-top" alt="..." style="width: 100px; height:40px;">
                <h5>{{$publier->nom_etp}}</h5>
                <h6 class="text-muted"> {{$publier->nom_secteur}}</h6>
            </div>
            <div class="row mt-1">
                <div class="col" align="center">
                    <h5>APPEL D'OFFRES OUVERT <strong>{{$publier->reference_soumission}}</strong> </h5>
                </div>
            </div>
            <p class="card-text">
                @php
                echo html_entity_decode($publier->prestation_demande);
                @endphp
            </p>
            <p class="card-text">
                Les interventions du prestataire s'étaleront à la date {{$publier->date_fin}} à heure {{$publier->hr_fin}}
            </p>
            <div class="row mt-1">
                <div class="col" align="left">
                    <h6>I-Information génerale:</h6>
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">
                            @php
                            echo html_entity_decode($publier->information_generale);
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col" align="left">
                    <h6>II-Exigence et condition de soumission:</h6>
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">
                            @php
                            echo html_entity_decode($publier->exigence_soumission);
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col" align="left">
                    <h6>II-Liste des dossiers à fournir:</h6>
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-10">
                            @php
                            echo html_entity_decode($publier->dossier_fournir);
                            @endphp
                        </div>
                    </div>
                </div>
            </div>
            <p class="card-text">TDR: <a href="#" class="card-link">{{$publier->tdr_url}}</a></p>
            <p class="card-text">contactez-nous par: <a href="#" class="card-link">{{$publier->email_etp}}</a></p>

        </span>
        @endforeach
        @else
        <h3>Aucun appel d'offre publié</h3>

        @endif
    </div>

</div>




</div>


</div>
</div>
</div>
</div>
</div>
</div>

</div>



<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $('#dossier_fournir').summernote({
        placeholder: 'liste des dossiers à fournir'
        , tabsize: 2
        , height: 100
    });
    $('#information_generale').summernote({
        placeholder: 'liste des informations generale'
        , tabsize: 2
        , height: 100
    });
    $('#exigence_soumission').summernote({
        placeholder: 'liste des exigences de soumission'
        , tabsize: 2
        , height: 100
    });


    $('#prestation').summernote({
        placeholder: 'objectif de la formation'
        , tabsize: 2
        , height: 100
    });
    $('#contexte').summernote({
        placeholder: 'contexte  de la préstation'
        , tabsize: 2
        , height: 100
    });

</script>

@endsection
