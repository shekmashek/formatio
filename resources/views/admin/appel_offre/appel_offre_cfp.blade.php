@extends('./layouts/admin')
@section('content')

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
                        @canany(['isReferent'])
                        <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('nouveau+appel+offre') || Route::currentRouteNamed('nouveau+appel+offre') ? 'active' : '' }}" href="{{route('nouveau+appel+offre')}}">
                                <i class="fa fa-list">Nouveau appel d'offre</i></a>
                        </li>
                        @endcanany
                        <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('appel_offre.index') ? 'active' : '' }}" aria-current="page" href="{{route('appel_offre.index')}}">
                                <i class="fa fa-list">Listes des appels d'offres</i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>



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

        {{-- </div> --}}




        {{-- <div class="tab-pane fade" id="nav-offre_publier" role="tabpanel" aria-labelledby="nav-offre_publier-tab"> --}}

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

    {{-- </div> --}}





@endsection
