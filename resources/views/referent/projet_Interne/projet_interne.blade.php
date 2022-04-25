@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Formation interne</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/projetInterne.css')}}">
<div class="container">
    <a href="#" class="btn_creer text-center filter" role="button" onclick="afficherFiltre();"><i
            class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
    <div class="col-12 mt-2">
        <ul class="nav nav-tabs d-flex flex-row navigation_interne" id="myTab">
            <li class="nav-item {{ empty($tabName) || $tabName == 'formations' ? 'active' : '' }}">
                <a href="#formations" class="nav-link active me-5" data-bs-toggle="tab">Formations Internes</a>
            </li>
            <li class="nav-item {{ empty($tabName) || $tabName == 'formateurs' ? 'active' : '' }}">
                <a href="#formateurs" class="nav-link me-5" data-bs-toggle="tab">Formateurs Internes</a>
            </li>
            <li class="nav-item {{ empty($tabName) || $tabName == 'projets' ? 'active' : '' }}">
                <a href="#projets" class="nav-link me-5" data-bs-toggle="tab">Projets Internes</a>
            </li>
        </ul>
        <div class="tab-content mt-3">
            <div class="tab-pane {{ !empty($tabName) && $tabName == 'formations' ? 'active' : '' }}" id="formations">
                <div class="col-4 px-4">
                    <div class="projet_interne p1">
                        <a href="{{route('formations')}}">
                            <span><i class='bx bxs-grid-alt'></i></span>
                            <p class="mt-3">Formations</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="tab-pane {{ empty($tabName) || $tabName == 'formateurs' ? 'active' : '' }}" id="formateurs">
                <div class="col-4 px-4">
                    <div class="projet_interne p2">
                        <a href="{{route('formateurs')}}">
                            <span><i class='bx bxs-user'></i></span>
                            <p class="mt-3">Formateurs</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="tab-pane {{ empty($tabName) || $tabName == 'projets' ? 'active' : '' }}" id="projets">
                <div class="col-4 px-4">
                    <div class="projet_interne p3">
                        <a href="{{route('projets')}}">
                            <span><i class='bx bx-unite'></i></span>
                            <p class="mt-3">Projets</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="filtrer mt-3">
        <div class="row">
            <div class="col-10">
                <p class="m-0">Filter vos Formations Internes</p>
            </div>
            <div class="col-2 text-end">
                <i class="bx bx-x" role="button" onclick="afficherFiltre();"></i>
            </div>
            <hr class="mt-2">
        </div>
    </div>
</div>
@endsection