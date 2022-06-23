@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Accueil</h3>
@endsection
@section('content')
<link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/cover/">
<link href="{{asset('css/cover.css')}}" rel="stylesheet">

<style>
.bd-placeholder-img {
    font-size: 1.125rem;
    text-anchor: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    user-select: none;
}

@media (min-width: 768px) {
    .bd-placeholder-img-lg {
    font-size: 3.5rem;
    }
}

.b-example-divider {
    height: 3rem;
    background-color: rgba(0, 0, 0, .1);
    border: solid rgba(0, 0, 0, .15);
    border-width: 1px 0;
    box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
}

.b-example-vr {
    flex-shrink: 0;
    width: 1.5rem;
    height: 100vh;
}

.bi {
    vertical-align: -.125em;
    fill: currentColor;
}

.nav-scroller {
    position: relative;
    z-index: 2;
    height: 2.75rem;
    overflow-y: hidden;
}

.nav-scroller .nav {
    display: flex;
    flex-wrap: nowrap;
    padding-bottom: 1rem;
    margin-top: -1px;
    overflow-x: auto;
    text-align: center;
    white-space: nowrap;
    -webkit-overflow-scrolling: touch;
}
</style>

<div class="d-flex h-100 text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
        <div id="icon-container"></div>
        <main class="pt-5 px-3">
            <h1>Bienvenue</h1>
                <h2 class="lead mt-4 mb-4">{{$formateur[0]->nom_formateur." ".$formateur[0]->prenom_formateur}}</h2>
                @if($formateur)
                <a href="{{route('calendrier')}}" class="fw-bold ">Regardez votre programme du jour.</a>
                @elseif($formateur)
                <a href="{{route('calendrier')}}" class="fw-bold ">Veuillez compléter vos coordonnées pour pouvoir accéder aux fonctionnalitées nécessaires.</a>
                @endif
            </p>
        </main>
        {{-- </div> --}}
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.4/lottie.min.js">
<script>
    var animation = bodymovin.loadAnimation({
    container: document.getElementById('icon-container'), // required
    path: 'https://assets6.lottiefiles.com/packages/lf20_xnbikipz.json', // required
    renderer: 'svg', // required
    loop: true, // optional
    autoplay: true, // optional
    name: "Demo Animation", // optional
});
</script>
@endsection
