@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/annuaire.css')}}">
<section class="annuaire mb-5 vh-100">
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
                                <label for="organisme" class="form-control-placeholder"><i class="bx bx-search me-3"></i>Numerika Center</label>
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
        <h4 class="text-center">Les Organismes de Formations près de chez vous</h4>
        <div class="col-2">
            <h6>Filtrer les résultats</h6>
            <div class="row">
                <p>Categories</p>
            </div>
        </div>
        <div class="col-10">
            @foreach ($cfp as $cfp)
            <div class="row">
                <div class="col-2">
                    <img src="{{$cfp->logo}}" alt="logo" class="img-fliud">
                </div>
                <div class="col-8 detail_cfp">
                    <h4>{{$cfp->nom}}</h4>
                    <p>{{$cfp->domaine_de_formation}}</p>
                    <div class="row">
                        <div class="col d-flex flex-row">
                            <span class="btn_actions" role="button"><a href="#"><i class="bx bx-mail-send"></i>Email</a></span>
                            <span class="btn_actions ms-3 contact_action" role="button"><i class="bx bx-phone"></i>Contact</span>
                            <span class="btn_actions ms-3" role="button"><a href=""><i class="bx bx-globe"></i>Site Web</a></span>
                        </div>
                        <div class="contact mt-3 mb-3">
                            <div class="col-6 phone_detail">
                                <div class="d-flex flex-row justify-content-between">
                                <span class="text-muted">Téléphone</span><span class="fermer"><i class="bx bx-x"></i></span>
                                </div>
                                <p class="m-0">{{$cfp->telephone}}</p>
                            </div>
                        </div>
                    </div>
                    <p class="mt-2 adresse"><i class="bx bxs-map"></i>{{$cfp->adresse_lot}}&nbsp;{{$cfp->adresse_quartier}}&sbquo;&nbsp;{{$cfp->adresse_ville}}&nbsp;{{$cfp->adresse_code_postal}}</p>
                </div>
                <div class="col-2">

                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript">
    let contact =document.querySelector('.contact_action');
    let fermer =document.querySelector('.fermer');
    contact.addEventListener('click', function(event) {
        $(".contact").css('display','block');
    });
    fermer.addEventListener('click', function(event) {
        $(".contact").css('display','none');
    });
</script>
@endsection
