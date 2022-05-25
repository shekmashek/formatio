@extends('./layouts/admin')
<link rel="stylesheet" href="{{asset('css/style_dashboard.css')}}">
@section('title')
<p class="text_header m-0 mt-1">Tableau de bord</p>
@endsection
@section('content')
<div class="container-fluid" style="margin-top: 5rem">
    <div class="p-1 m-0 mt-3">
        <div class="container-fluid" style="font-size: 11.8px;">

                @if($test == 1)
                <div id="in" class="p-2 mt-1 alert alert-success text-center" role="alert">
                    <span style="color: rgb(89, 192, 37)"> {{$message}} </span> &nbsp;
                </div>
                @else
                <div id="in" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                    <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; {{$message}} </span> &nbsp;
                    <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('ListeAbonnement')}}">Régler mon abonnement</a>
                </div>
                @endif
             </div>
            @if(count($cfps) == null or count($cfps) =='')
            <div id="in" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; Veuillez collaborer au moins avec une entreprise ! </span> &nbsp;
                <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('collaboration')}}">Collaborez-vous maintenant</a>
            </div>
            @else

            @endif

            @if($refs->nif==null or $refs->stat==null or $refs->rcs==null)
            <div id="in1" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; Veuillez vous complétez vos informations professionnel ! </span> &nbsp;
                <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('aff_parametre_referent')}}">Modifier vos infos légales</a>
            </div>
            @else

            @endif

            @if(count($formateur_referent) == null or count($formateur_referent) =='')
            <div id="in2" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; Veuillez collaborer au moins avec un formateur ! </span> &nbsp;
                <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('collaboration')}}">Collaborez-vous maintenant</a>
            </div>
            @else

            @endif

            {{-- cfp ty <div id="in2" class="p-2 mt-1 alert alert-danger text-center" role="alert">
            <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; Veuillez créer un module pour avoir commencercommencé ! </span> &nbsp;
            <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="">Créer un module de formation</a>
        </div> --}}


            <div class="hide1 p-2 mt-0 alert alert-primary alert-dismissible alert-sm fade show " role="alert">
                <span style="color: #6f93ca"><i class="fas fa-exclamation-circle">&nbsp;</i> Bienvenue ! &nbsp; voici vos tableaux de bord. </span>
                {{-- <button style="font-size: 10px;" type="button" class="p-2 mt-1 btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
            </div>
            <div class="p-2 mt-0 alert alert-warning alert-dismissible alert-sm fade show " role="alert">
                <span style="color: #c7aa4b"> <i class="fas fa-info-circle">&nbsp;</i> Bienvenue ! &nbsp; voici vos tableaux de bord. </span>
                <a id="bouton" style="font-size: 10px; padding:13px; border-radius:100%" type="button" class="p-2 mt-1 btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>


            <div class="row mt-2">
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d"><b> <i class="fas fa-users "></i>&nbsp; Collaborateur </b>
                        <a class="overr" href="{{route('collaboration')}}">
                            <p class=" m-1 system_ pb-1">Formateurs interne<span class="system_numero">{{ count($formateur_referent)}}</span></p>
                        </a>
                        <a class="overr" href="{{route('collaboration')}}">
                            <p class="m-1 system_ pb-1">Entreprise<span class="system_numero">{{ count($cfps)}}</span></p>
                        </a>
                        <p class="m-1 system_ pb-1">Équipe administrative<span class="system_numero">{{$total}}</span></p>
                        <a class="overr" href="{{route('liste_participant')}}">
                            <p class="m-1 system_ pb-1">Employée<span class="system_numero">{{$nb_stagiaire}}</span></p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d"><b> <i class="fas fa-address-card"></i>&nbsp; Facture </b>
                        <a class="overr" href="{{route('liste_facture')}}">
                            <p class=" m-1 system_ pb-1">Payé<span class="system_numero">{{ count($facture_paye) }}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Non échu<span class="system_numero">{{ count($facture_non_echu) }}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Echu non payé<span class="system_numero">0</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Payement partiel<span class="system_numero">0</span></p>
                        </a>
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d; height:129px;"><b> <i class="fas fa-building"></i> &nbsp; Profil de l'organisation ({{ $etp }}) </b>
                        @if ($referent->adresse_quartier==null or $referent->adresse_code_postal==null and $referent->adresse_lot==null and $referent->adresse_ville==null and $referent->adresse_region==null)
                        <a class="overr" href="{{route('profil_referent')}}">
                            <p class="p-0 m-1 system_ pb-1">Adresse<span class="system_numeroAlert">Incomplet</span></p>
                        </a>
                        @else
                        <a class="overr" href="{{route('profil_referent')}}">
                            <p class="m-1 system_ pb-1">Adresse<span class="system_numeroSuccess">Complet</span></p>
                        </a>
                        @endif

                        @if ($refs->nif==null or $refs->stat==null or $refs->rcs==null)
                        <a class="overr" href="{{route('profil_referent')}}">
                            <p class="p-0 m-1 system_ pb-1">Informations légales<span class="system_numeroAlert">Incomplet</span></p>
                        </a>
                        @else
                        <a class="overr" href="{{route('profil_referent')}}">
                            <p class="m-1 system_ pb-1">Informations légales<span class="system_numeroSuccess">Complet</span></p>
                        </a>
                        @endif
                        {{-- <p class="m-1 system_ pb-1">Information légale<span class="system_numeroSuccess">complet</span></p> --}}
                        {{-- <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Type d'abonnement<span class="system_numero">
                                    @foreach($name as $ab)
                                    {{ $ab->nom_type }}
                                    @endforeach
                                </span></p>
                        </a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-3" style="font-size: 11.8px;">
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d"><b> <i class="fas fa-tasks"></i>&nbsp; Formation intra entreprise</b>
                    <a class="overr" href="">
                        <p class="p-0 m-1 system_ pb-1">Prévisionnel<span class="system_numero">{{count($session_intra_terminer) }}</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">A venir<span class="system_numero">{{count($session_intra_previ) }}</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">En cours<span class="system_numero">{{count($session_intra_en_cours) }}</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">Complété<span class="system_numero">{{count($session_intra_avenir) }}</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">Cloturé<span class="system_numero">{{count($session_intra_avenir) }}</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">Annuler<span class="system_numero">{{count($session_intra_previ) }}</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">Repporté<span class="system_numero">{{count($session_intra_avenir) }}</span></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d"><b> <i class="fas fa-tasks"></i> &nbsp; Formation inter entreprise</b>
                    <a class="overr" href="">
                        <p class="p-0 m-1 system_ pb-1">Prévisionnel<span class="system_numero">{{count($session_intra_terminer) }}</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">A venir<span class="system_numero">{{count($session_intra_previ) }}</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">En cours<span class="system_numero">{{count($session_intra_en_cours) }}</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">Complété<span class="system_numero">{{count($session_intra_avenir) }}</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">Cloturé<span class="system_numero">{{count($session_intra_avenir) }}</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">Annuler<span class="system_numero">{{count($session_intra_previ) }}</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">Repporté<span class="system_numero">{{count($session_intra_avenir) }}</span></p>
                    </a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d"><b> <i class="fas fa-tasks"></i> &nbsp; Formation interne entreprise</b>
                    <a class="overr" href="">
                        <p class="p-0 m-1 system_ pb-1">Prévisionnel<span class="system_numero">3</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">A venir<span class="system_numero">1</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">En cours<span class="system_numero">0</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">Complété<span class="system_numero">0</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">Cloturé<span class="system_numero">0</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">Annuler<span class="system_numero">0</span></p>
                    </a>
                    <a class="overr" href="">
                        <p class="m-1 system_ pb-1">Repporté<span class="system_numero">0</span></p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script>
    setTimeout(function() {
        $('.hide1').fadeOut('slow');
    }, 9000);

</script>
<script>
    var el = document.getElementById("in");

    function fadeIn(el, time) {
        el.style.opacity = 0;

        var last = +new Date();
        var tick = function() {
            el.style.opacity = +el.style.opacity + (new Date() - last) / time;
            last = +new Date();

            if (+el.style.opacity < 1) {
                (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 10);
            }
        };

        tick();
    }

    fadeIn(el, 2950);

    var el = document.getElementById("in1");

    function fadeIn(el, time) {
        el.style.opacity = 0;

        var last = +new Date();
        var tick = function() {
            el.style.opacity = +el.style.opacity + (new Date() - last) / time;
            last = +new Date();

            if (+el.style.opacity < 1) {
                (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 10);
            }
        };

        tick();
    }
    fadeIn(el, 2950);


    var el = document.getElementById("in2");

    function fadeIn(el, time) {
        el.style.opacity = 0;

        var last = +new Date();
        var tick = function() {
            el.style.opacity = +el.style.opacity + (new Date() - last) / time;
            last = +new Date();

            if (+el.style.opacity < 1) {
                (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 10);
            }
        };

        tick();
    }

    fadeIn(el, 2950);


    var el = document.getElementById("in3");

    function fadeIn(el, time) {
        el.style.opacity = 0;

        var last = +new Date();
        var tick = function() {
            el.style.opacity = +el.style.opacity + (new Date() - last) / time;
            last = +new Date();

            if (+el.style.opacity < 1) {
                (window.requestAnimationFrame && requestAnimationFrame(tick)) || setTimeout(tick, 10);
            }
        };

        tick();
    }

    fadeIn(el, 2950);

</script>

</div>
@endsection
