@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Formation interne</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/projetInterne.css')}}">
<div class="container">
    <div class="row">
        <h3 class="text-center mt-5 mb-5">Bienvenue dans votre fomation Interne</h3>
        <div class="col-4 px-4">
            <div class="projet_interne p1">
                <a href="{{route('formations')}}">
                    <span><i class='bx bxs-grid-alt'></i></span>
                    <p class="mt-3">Formations</p>
                </a>
            </div>
        </div>
        <div class="col-4 px-4">
            <div class="projet_interne p2">
                <a href="{{route('formateurs')}}">
                    <span><i class='bx bxs-user'></i></span>
                    <p class="mt-3">Formateurs</p>
                </a>
            </div>
        </div>
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
@endsection