@extends('./layouts/admin')
@section('content')
{{-- <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script> --}}
<link rel="stylesheet" href="{{asset('assets/css/annuaire.css')}}">
<section class="container-fluid">
    <div class="container-fluid g-0 p-0 recherche mb-5">
        <div class="row g-0 m-0 pt-3">
            <div class="col-3 logo_formation text-center">
                <img src="{{asset('img/images/logo_fmg54Ko.png')}}" alt="logo" class="img-fluid">
            </div>
            <div class="col-9">
                <form action="">
                    <div class="form-row d-flex">
                        <div class="col-9">
                            <div class="form-group">
                                <input type="text" class="form-control input" required name="organisme" id="organisme">
                                <label for="organisme" class="form-control-placeholder"><i
                                        class="bx bx-search me-3"></i>Numerika Center</label>
                            </div>
                        </div>
                        <div class="col-3 text-center">
                            <div class="form-group">
                                <button type="submit" class="btn_submit">Rechercher</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row details g-0">
            <div class="col-8 justify-content-center">
                <div id="result">
                    @foreach ($cfp as $cfp)
                    <div class="row details_content g-0">
                        <div class="col-3 logo_content">
                            <a href="{{route('detail_cfp',$cfp->id)}}" class="text-center mb-2"><img src="{{asset("images/CFP/".$cfp->logo)}}" alt="logo" class="img-fliud logo_img"></a>
                            <p class="text-center m-0"><i class="bx bx-alarm"></i> Fermé aujourd'hui</p>
                            <p class="text-center">Ouvert le mardi 09:00 - 17:30</p>
                        </div>
                        <div class="col-9">
                            <div class="row ps-5">
                                <h4><a href="{{route('detail_cfp',$cfp->id)}}">{{$cfp->nom}}</a></h4>
                                <p>{{$cfp->slogan}}</p>
                                <p class="mt-1"><i class="bx bx-map me-2"></i>{{$cfp->adresse_lot}}&nbsp;{{$cfp->adresse_quartier}}&sbquo;&nbsp;{{$cfp->adresse_ville}}&nbsp;{{$cfp->adresse_code_postal}}&sbquo;&nbsp;{{$cfp->adresse_region}}</p>
                                <div class="col-6 mb-3">
                                    <span class="text-muted"><i class="bx bx-phone"></i> Téléphone</span>
                                    <p class="m-0">{{$cfp->telephone}}</p>
                                </div>
                            </div>
                            <div class="col d-flex flex-row mb-2 ps-5">
                                <span class="btn_actions" role="button"><a href="#"><i
                                            class="bx bx-mail-send"></i>Email</a></span>
                                <span class="btn_actions ms-3" role="button"><a href="#"><i
                                            class="bx bx-globe"></i>Site
                                        Web</a></span>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-4 location">
                {{-- <a href="#"><img src="{{asset('images/CFP/Capture d’écran 2022-03-14 à 15.44.30.png')}}" alt="location" class="img-fluid"></a> --}}
            </div>
            @endforeach
            <div class="col-12 justify-content-center mt-3 services">
                <div class="row text-center">
                    <div class="col-3"><p class="border_end choisir">Pourquoi nous choisir?</p></div>
                    <div class="col-3"><p class="border_end"><i class="bx bx-pyramid"></i>Sur mesure</p></div>
                    <div class="col-3"><p class="border_end"><i class='bx bx-check-shield'></i>Bien etablie</p></div>
                    <div class="col-3"><p><i class='bx bx-headphone'></i>Satisfaction garantie</p></div>
                </div>
            </div>
        </div>
    </div>

</section>
{{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&v=weekly" async></script>
<script>
    let map;

    function initMap() {
        map = new google.maps.Map(document.getElementById("map"), {
            center: { lat: -34.397, lng: 150.644 },
            zoom: 8,
        });
    }
</> --}}

@endsection