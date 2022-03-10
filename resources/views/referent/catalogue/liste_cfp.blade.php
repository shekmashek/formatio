@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/formation.css')}}">
<section class="">
    <div class="container">
        <div class="row">

            @if (count($infos)>0)
            <h2 class="">Tous les organismes de formations en :&nbsp;{{ $infos[0]->nom_formation }}</h2><br>
            <p></p>

            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif
        </div>
    </div>

    </div>
    <div class="container pb-5 vh-100">
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
                <div class="row liste__formation justify-content-space-between mb-5">
                    <div class="col-lg-6 col-md-6 liste__formation__content">

                    </div>
                    <div class="col-lg-6 col-md-6 text-end description">

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection