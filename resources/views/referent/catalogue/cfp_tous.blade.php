@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/annuaire.css')}}">
<section class="annuaire mb-5">
    <div class="container g-0 p-0 recherche">
        <div class="row g-0 m-0 p-3">
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
    <div class="container my-5">
        <div class="row">
            <h4 class="text-center mb-3">Les Organismes de Formations près de chez vous</h4>
            <div class="row mb-5">
                <div class="col-12 alphabet text-uppercase">
                    <span>
                        {{-- @php
                    $AZ = range('a', 'z');
                    foreach ($AZ as $lettres){
                        echo $lettres;
                    }
                    @endphp --}}
                    </span>
                    @php
                    $alphabet = array();
                    for($i = 'a'; $i <= 'z'; $i++){
                        $alphabet[] = $i;
                        // echo $i;
                    };
                    // dd($alphabet[25]);
                    @endphp
                </div>
            </div>
            <div class="col-3 filtres">
                <h6>Filtrer les résultats</h6>
                <div class="row">
                    <p>Categories</p>
                </div>
            </div>
            <div class="col-9 justify-content-center">
                @foreach ($pagination as $cfp)
                <div class="row detail_content mb-5">
                    <div class="col-2">
                        <img src="{{$cfp->logo}}" alt="logo" class="img-fliud">
                    </div>
                    <div class="col-10 detail_cfp">
                        <div class="row">
                            <h4>{{$cfp->nom}}</h4>
                            <p>{{$cfp->domaine_de_formation}}</p>
                            <div class="col d-flex flex-row mb-2">
                                <span class="btn_actions" role="button"><a href="#"><i
                                            class="bx bx-mail-send"></i>Email</a></span>
                                <span class="btn_actions ms-3 contact_action" role="button" data-bs-toggle="collapse"
                                href="#contact_{{ $cfp->id }}" aria-expanded="false" aria-controls="collapseprojet"><i
                                        class="bx bx-phone"></i>Contact</span>
                                <span class="btn_actions ms-3" role="button"><a href="#"><i class="bx bx-globe"></i>Site
                                        Web</a></span>
                                <span class="btn_actions ms-3" role="button"><a href="#"><i class="bx bx-info-circle"></i>Plus d'infos</a></span>
                            </div>
                            <div class="contact collapse" id="contact_{{ $cfp->id }}">
                                <div class="col-6 phone_detail">
                                    <div class="d-flex flex-row justify-content-between">
                                        <span class="text-muted">Téléphone</span>
                                    </div>
                                    <p class="m-0">{{$cfp->telephone}}</p>
                                </div>
                            </div>
                        </div>
                        <p class="mt-1 adresse"><i
                                class="bx bxs-map"></i>{{$cfp->adresse_lot}}&nbsp;{{$cfp->adresse_quartier}}&sbquo;&nbsp;{{$cfp->adresse_ville}}&nbsp;{{$cfp->adresse_code_postal}}&sbquo;&nbsp;{{$cfp->adresse_region}}
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {!! $pagination->links() !!}
            </div>
        </div>
    </div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

@endsection