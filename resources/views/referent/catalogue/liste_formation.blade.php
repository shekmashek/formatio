@extends('./layouts/admin')
@section('content')
<section class="liste__formation">
    <div class="container py-5">
        <div class="row my-5 titre_formation">
            <span><h2>Formations&nbsp;</h2></span>
            @isset($nom_formation)
                <h2>{{$nom_formation}}</h2>
            @endisset
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="row liste__formation__recherche">
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
            <div class="col-lg-9">
               @foreach ($infos as $info)
                    <div class="row liste__formation__result justify-content-space-between mb-5">
                        <div class="row liste__formation justify-content-space-between">
                            <div class="col-lg-6 col-md-6 liste__formation__result__content">
                                <a href="{{route('select_par_module',$info->module_id)}}">
                                    <div class="liste__formation__result__item">
                                        <h4>{{$info->nom_formation}} - {{$info->nom_module}}</h4>
                                        <p>{{$info->description}}</p>
                                        <div class="liste__formation__result__avis">
                                            <div class="Stars" style="--note: {{ $info->pourcentage }};"></div>
                                            <span><strong>{{ $info->pourcentage }}</strong>/5</span>
                                        </div>

                                        <p class="mt-2">Formation proposée par&nbsp;<span>{{$info->nom}}</span>&nbsp;&nbsp;&nbsp;<img src="{{asset('images/CFP/'.$info->logo)}}" alt="logo" class="img-fluid" style="width: 100px; height:50px;"></p>

                                    </div>
                                </a>
                            </div>

                            <div class="col-lg-6 col-md-6 liste__formation__result__content">
                                <div class="liste__formation__result__item2">
                                    <a href="#">
                                        <h6 class="devis_form">Démander un devis&nbsp;<i class="bx bxs-cart-add bx_icon"></i></h6>
                                    </a>
                                    <p class="prix_ht"><span class="prix_ar">
                                        @php
                                            echo number_format($info->prix, 0, ' ', ' ');
                                        @endphp
                                        &nbsp;AR</span>&nbsp;HT</p>
                                    <p>Réference : <span>{{$info->reference}}</span></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row row-cols-auto liste__formation__result__item3 justify-content-space-between">
                                <div class="col"><i class="bx bx-alarm bx_icon"></i>
                                    <span>
                                        @isset($info->duree_jour)
                                            {{$info->duree_jour}} jours
                                        @endisset
                                    </span>
                                    <span>
                                        @isset($info->duree)
                                            /{{$info->duree}} h
                                        @endisset
                                    </span> </p>
                                </div>
                                <div class="col"><i class="bx bx-certification bx_icon"></i><span>&nbsp;Certifiante</span></div>
                                <div class="col"><i class="bx bxs-devices bx_icon"></i><span>&nbsp;{{$info->modalite_formation}}</span></div>
                                <div class="col"><i class='bx bx-equalizer bx_icon'></i><span>&nbsp;{{$info->niveau}}</span></div>
                                <div class="col"><span>Intra</span></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection
