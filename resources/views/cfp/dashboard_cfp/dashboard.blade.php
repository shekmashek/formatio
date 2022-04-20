@if($test == 0)
@extends('./layouts/admin_non_abonne')
<link rel="stylesheet" href="{{asset('css/style_dashboard.css')}}">
@section('title') <p class="text_header m-0 mt-1">Tableau de bord</p> @endsection

<div class="container me-0" style="margin-top: 5rem">


    <div class="p-1 m-0 mt-3">
        <div class="container-fluid" style="font-size: 11.8px;">
            <div id="in" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; {{$message}} </span> &nbsp;
                <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('ListeAbonnement')}}">Régler mon abonnement</a>
            </div>
            @if(count($dmd_cfp_etp) == null or count($dmd_cfp_etp) =='')
            <div id="in" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; Veuillez collaborer au moins avec une entreprise ! </span> &nbsp;
                <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('liste_entreprise')}}">Collaborez-vous maintenant</a>
            </div>

            @endif

            @if($ref->adresse_lot==null or $ref->adresse_quartier==null or $ref->adresse_code_postal==null or $ref->adresse_ville==null or $ref->adresse_region==null)
            <div id="in1" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; Veuillez vous complétez vos informations ! </span> &nbsp;
                <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('profil_du_responsable')}}">Modifier vos infos </a>
            </div>

            @endif
            @if ($ref->nif==null or $ref->stat==null or $ref->rcs==null)
            <div id="in2" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; Veuillez vous complétez vos informations professionnel ! </span> &nbsp;
                <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('profil_of',$ref->id)}}">Modifier vos infos légales</a>
            </div>
            @endif
            @if(count($formateur) == null or count($formateur) =='')
            <div id="in3" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; Veuillez collaborer au moins avec un formateur ! </span> &nbsp;
                <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('collaboration')}}">Collaborez-vous maintenant</a>
            </div>
            @endif

            <div class="hide1 p-2 mt-0 alert alert-primary alert-dismissible alert-sm fade show " role="alert">
                <span style="color: #6f93ca"><i class="fas fa-exclamation-circle">&nbsp;</i> Bienvenue ! &nbsp; voici vos tableaux de bord. </span>
            </div>

            <div class="p-2 mt-0 alert alert-warning alert-dismissible alert-sm fade show " role="alert">
                <span style="color: #c7aa4b"> <i class="fas fa-info-circle">&nbsp;</i> Bienvenue ! &nbsp; vous pouvez configurer vos parametres sur le tableau de bord. </span>
                <a id="bouton" style="font-size: 10px; padding:13px; border-radius:100%" type="button" class="p-2 mt-1 btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>

            <div class="row mt-2">
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d;height:120px"><b> <i class="fas fa-users "></i>&nbsp; Collaborateur </b>
                        <a class="overr" href="{{route('collaboration')}}">
                            <p class=" m-1 system_ pb-1"> Formateurs<span class="system_numero">{{count($formateur)}} </span></p>
                        </a>
                        <a class="overr" href="{{route('liste_entreprise')}}">
                            <p class="m-1 system_ pb-1">Entreprise<span class="system_numero">{{count($dmd_cfp_etp) }}</span></p>
                        </a>
                        <a class="overr" href="{{route('liste+responsable+cfp')}}">
                            <p class="m-1 system_ pb-1">Equipe administrative<span class="system_numero">{{ count($resp_cfp) }}</span></p>
                        </a>
                        {{-- <p class="m-1 system_ pb-1">Manager<span class="system_numero">0</span></p> --}}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d;height:120px"><b> <i class="fas fa-book"></i> &nbsp; Catalogue </b>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Publié<span class="system_numero">{{ count($module_publié) }}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">En cours de création<span class="system_numero">{{ count($module_encours_publié) }}</span></p>
                        </a>
                        {{-- <p class="m-1 system_ pb-1">Programme incomplète<span class="system_numero">70</span></p>
                            <p class="m-1 system_ pb-1">Compétence incomplète<span class="system_numero">70</span></p> --}}
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Archiver<span class="system_numero">70</span></p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-4 bg-body rounded" style="color: #8d8d8d;height:120px;"><b> <i class="fas fa-building"></i> &nbsp; Profil de l'organisation ({{$nom_profil_organisation }}) </b>
                        @if ($ref->adresse_lot==null or $ref->adresse_quartier==null or $ref->adresse_code_postal==null or $ref->adresse_ville==null or $ref->adresse_region==null)
                        <a class="overr" href="{{route('profil_du_responsable')}}">
                            <p class="p-0 m-1 system_ pb-1">Adresse<span class="system_numeroAlert">Incomplet</span></p>
                        </a>
                        @else
                        <a class="overr" href="{{route('profil_du_responsable')}}">
                            <p class="m-1 system_ pb-1">Adresse<span class="system_numeroSuccess">Complet</span></p>
                        </a>
                        @endif

                        @if ($ref->nif==null or $ref->stat==null or $ref->rcs==null)
                        <a class="overr" href="{{route('profil_du_responsable')}}">
                            <p class="p-0 m-1 system_ pb-1">Informations légales<span class="system_numeroAlert">Incomplet</span></p>
                        </a>
                        @else
                        <a class="overr" href="{{route('profil_du_responsable')}}">
                            <p class="m-1 system_ pb-1">Informations légales<span class="system_numeroSuccess">Complet</span></p>
                        </a>
                        @endif

                        {{-- <p class="m-1 system_nums pb-1 d-flex">Information légale &nbsp;&nbsp;&nbsp;
                                    @if ($ref->nif==null)
                                        <span style="font-size:9px " class="static">NIF:&nbsp;<span class=" static  system_numeroAlert">Incomplet</span></span>&nbsp;
                                    @else
                                        <span style="font-size:9px " class="static">NIF:&nbsp;<span class=" static system_numeroSuccess">Complet</span></span>&nbsp;
                                    @endif

                                    @if ($ref->stat==null)
                                        <span style="font-size:9px " class="static">STAT:&nbsp;<span class=" static  system_numeroAlert">Incomplet</span></span>&nbsp;
                                    @else
                                        <span style="font-size:9px " class="static">STAT:&nbsp;<span class=" static system_numeroSuccess">Complet</span></span>&nbsp;
                                    @endif

                                    @if ($ref->rcs==null)
                                        <span style="font-size:9px " class="static">RCS:&nbsp;<span class=" static  system_numeroAlert">Incomplet</span></span>&nbsp;
                                    @else
                                        <span style="font-size:9px " class="static">RCS:&nbsp;<span class=" static system_numeroSuccess">Complet</span></span>&nbsp;
                                    @endif
                            </p> --}}

                        {{-- @if ($abonnement_cfp->adresse_lot==null)
                                <p class="p-0 m-1 system_ pb-1">Type d'abonnement<span class="system_numeroAlert">Gratuit</span></p>
                            @else
                                <p class="m-1 system_ pb-1">Type d'abonnement<span class="system_numeroSuccess">Complet</span></p>
                            @endif --}}

                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Type d'abonnement<span class="system_numero">
                                    {{-- @foreach($name as $ab)
                                        {{ $ab->nom_type }}
                                    @endforeach --}}
                                </span></p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="font-size: 11.8px;">
            <div class="row mt-2">
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d"><b> <i class="fas fa-tasks"></i>&nbsp; Session Intra enreprise </b>
                        <a class="overr" href="">
                            <p class="p-0 m-1 system_ pb-1">Complété<span class="system_numero">{{count($session_intra_terminer) }}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">{{count($session_intra_previ) }}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">En cours<span class="system_numero">{{count($session_intra_en_cours) }}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">A venir<span class="system_numero">{{count($session_intra_avenir) }}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Annuler<span class="system_numero">{{count($session_intra_previ) }}</span></p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d;"><b> <i class="fas fa-tasks"></i> &nbsp; Session Inter entreprise </b>
                        <a class="overr" href="">
                            <p class="p-0 m-1 system_ pb-1">Complété<span class="system_numero">{{count($session_inter_terminer)}}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">En cours<span class="system_numero">{{count($session_inter_encours)}}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">{{count($session_inter_previsionnel)}}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">A venir<span class="system_numero">{{count($session_inter_avenir)}}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Annuler<span class="system_numero">{{count($session_inter_annuler)}}</span></p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d"><b> <i class="fas fa-address-card"></i>&nbsp; Facture </b>
                        <a class="overr" href="{{route('liste_facture',2)}}">
                            <p class=" m-1 system_ pb-1">Payé<span class="system_numero">{{ count($facture_paye) }}</span></p>
                        </a>
                        <a class="overr" href="{{route('liste_facture',2)}}">
                            <p class="m-1 system_ pb-1">Non échu<span class="system_numero">{{ count($facture_non_echu) }}</span></p>
                        </a>
                        <a class="overr" href="{{route('liste_facture',2)}}">
                            <p class="m-1 system_ pb-1">Echu non payé<span class="system_numero">0</span></p>
                        </a>
                        <a class="overr" href="{{route('liste_facture',2)}}">
                            <p class="m-1 system_ pb-1">Payement partiel<span class="system_numero">0</span></p>
                        </a>
                        <a class="overr" href="{{route('liste_facture',2)}}">
                            <p class="m-1 system_ pb-1">Brouillon<span class="system_numero">{{ count($facture_brouillon) }}</span></p>
                        </a>
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
</div>


    {{-- <link rel="stylesheet" href="ttps://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"> --}}
    {{--
    <div class=" p-0 m-0 nav d-flex flex-row navigation justify-content-end" style="font-size: 10px;">
        <a href="{{ route('home') }}" type="button" class="btn a active" style="font-size: 12px;"> <i class="fas fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB système</a>
    <a href="{{ route('hometdbf')}}" type="button" class="btn bb me-2 ms-2" style="font-size: 12px;"><i class="fas fa-chart-bar" style="font-size: 10px;"></i>&nbsp;TDB financier</a>
    <a href="{{ route('hometdbq')}}" type="button" class="btn bb" style="font-size: 12px;"> <i class="fas fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB qualité</a>
</div> --}}




@else
@extends('./layouts/admin')

<link rel="stylesheet" href="{{asset('css/style_dashboard.css')}}">
@section('title') <p class="text_header m-0 mt-1">Tableau de bord</p> @endsection

<div class="container" style="margin-top: 5rem">


    <div class="p-1 m-0 mt-3">
        <div class="container-fluid" style="font-size: 11.8px;">
            <div id="in" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; {{$message}} </span> &nbsp;
                <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('ListeAbonnement')}}">Régler mon abonnement</a>
            </div>
            @if(count($dmd_cfp_etp) == null or count($dmd_cfp_etp) =='')
            <div id="in" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; Veuillez collaborer au moins avec une entreprise ! </span> &nbsp;
                <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('liste_entreprise')}}">Collaborez-vous maintenant</a>
            </div>

            @endif

            @if($ref->adresse_lot==null or $ref->adresse_quartier==null or $ref->adresse_code_postal==null or $ref->adresse_ville==null or $ref->adresse_region==null)
            <div id="in1" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; Veuillez vous complétez vos informations ! </span> &nbsp;
                <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('profil_du_responsable')}}">Modifier vos infos </a>
            </div>

            @endif
            @if ($ref->nif==null or $ref->stat==null or $ref->rcs==null)
            <div id="in2" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; Veuillez vous complétez vos informations professionnel ! </span> &nbsp;
                <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('profil_of',$ref->id)}}">Modifier vos infos légales</a>
            </div>
            @endif
            @if(count($formateur) == null or count($formateur) =='')
            <div id="in3" class="p-2 mt-1 alert alert-danger text-center" role="alert">
                <span style="color: rgb(233, 113, 113)"><i class="fas fa-exclamation-triangle"></i> &nbsp; Veuillez collaborer au moins avec un formateur ! </span> &nbsp;
                <a style="color: rgb(233, 113, 113); text-decoration: underline;" href="{{route('collaboration')}}">Collaborez-vous maintenant</a>
            </div>
            @endif

            <div class="hide1 p-2 mt-0 alert alert-primary alert-dismissible alert-sm fade show " role="alert">
                <span style="color: #6f93ca"><i class="fas fa-exclamation-circle">&nbsp;</i> Bienvenue ! &nbsp; voici vos tableaux de bord. </span>
            </div>

            <div class="p-2 mt-0 alert alert-warning alert-dismissible alert-sm fade show " role="alert">
                <span style="color: #c7aa4b"> <i class="fas fa-info-circle">&nbsp;</i> Bienvenue ! &nbsp; vous pouvez configurer vos parametres sur le tableau de bord. </span>
                <a id="bouton" style="font-size: 10px; padding:13px; border-radius:100%" type="button" class="p-2 mt-1 btn-close" data-bs-dismiss="alert" aria-label="Close"></a>
            </div>

            <div class="row mt-2">
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d;height:120px"><b> <i class="fas fa-users "></i>&nbsp; Collaborateur </b>
                        <a class="overr" href="{{route('collaboration')}}">
                            <p class=" m-1 system_ pb-1"> Formateurs<span class="system_numero">{{count($formateur)}} </span></p>
                        </a>
                        <a class="overr" href="{{route('liste_entreprise')}}">
                            <p class="m-1 system_ pb-1">Entreprise<span class="system_numero">{{count($dmd_cfp_etp) }}</span></p>
                        </a>
                        <a class="overr" href="{{route('liste+responsable+cfp')}}">
                            <p class="m-1 system_ pb-1">Equipe administrative<span class="system_numero">{{ count($resp_cfp) }}</span></p>
                        </a>
                        {{-- <p class="m-1 system_ pb-1">Manager<span class="system_numero">0</span></p> --}}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d;height:120px"><b> <i class="fas fa-book"></i> &nbsp; Catalogue </b>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Publié<span class="system_numero">{{ count($module_publié) }}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">En cours de création<span class="system_numero">{{ count($module_encours_publié) }}</span></p>
                        </a>
                        {{-- <p class="m-1 system_ pb-1">Programme incomplète<span class="system_numero">70</span></p>
                            <p class="m-1 system_ pb-1">Compétence incomplète<span class="system_numero">70</span></p> --}}
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Archiver<span class="system_numero">70</span></p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-4 bg-body rounded" style="color: #8d8d8d;height:120px;"><b> <i class="fas fa-building"></i> &nbsp; Profil de l'organisation ({{$nom_profil_organisation }}) </b>
                        @if ($ref->adresse_lot==null or $ref->adresse_quartier==null or $ref->adresse_code_postal==null or $ref->adresse_ville==null or $ref->adresse_region==null)
                        <a class="overr" href="{{route('profil_du_responsable')}}">
                            <p class="p-0 m-1 system_ pb-1">Adresse<span class="system_numeroAlert">Incomplet</span></p>
                        </a>
                        @else
                        <a class="overr" href="{{route('profil_du_responsable')}}">
                            <p class="m-1 system_ pb-1">Adresse<span class="system_numeroSuccess">Complet</span></p>
                        </a>
                        @endif

                        @if ($ref->nif==null or $ref->stat==null or $ref->rcs==null)
                        <a class="overr" href="{{route('profil_du_responsable')}}">
                            <p class="p-0 m-1 system_ pb-1">Informations légales<span class="system_numeroAlert">Incomplet</span></p>
                        </a>
                        @else
                        <a class="overr" href="{{route('profil_du_responsable')}}">
                            <p class="m-1 system_ pb-1">Informations légales<span class="system_numeroSuccess">Complet</span></p>
                        </a>
                        @endif

                        {{-- <p class="m-1 system_nums pb-1 d-flex">Information légale &nbsp;&nbsp;&nbsp;
                                    @if ($ref->nif==null)
                                        <span style="font-size:9px " class="static">NIF:&nbsp;<span class=" static  system_numeroAlert">Incomplet</span></span>&nbsp;
                                    @else
                                        <span style="font-size:9px " class="static">NIF:&nbsp;<span class=" static system_numeroSuccess">Complet</span></span>&nbsp;
                                    @endif

                                    @if ($ref->stat==null)
                                        <span style="font-size:9px " class="static">STAT:&nbsp;<span class=" static  system_numeroAlert">Incomplet</span></span>&nbsp;
                                    @else
                                        <span style="font-size:9px " class="static">STAT:&nbsp;<span class=" static system_numeroSuccess">Complet</span></span>&nbsp;
                                    @endif

                                    @if ($ref->rcs==null)
                                        <span style="font-size:9px " class="static">RCS:&nbsp;<span class=" static  system_numeroAlert">Incomplet</span></span>&nbsp;
                                    @else
                                        <span style="font-size:9px " class="static">RCS:&nbsp;<span class=" static system_numeroSuccess">Complet</span></span>&nbsp;
                                    @endif
                            </p> --}}

                        {{-- @if ($abonnement_cfp->adresse_lot==null)
                                <p class="p-0 m-1 system_ pb-1">Type d'abonnement<span class="system_numeroAlert">Gratuit</span></p>
                            @else
                                <p class="m-1 system_ pb-1">Type d'abonnement<span class="system_numeroSuccess">Complet</span></p>
                            @endif --}}

                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Type d'abonnement<span class="system_numero">
                                    {{-- @foreach($name as $ab)
                                        {{ $ab->nom_type }}
                                    @endforeach --}}
                                </span></p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid" style="font-size: 11.8px;">
            <div class="row mt-2">
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d"><b> <i class="fas fa-tasks"></i>&nbsp; Session Intra enreprise </b>
                        <a class="overr" href="">
                            <p class="p-0 m-1 system_ pb-1">Complété<span class="system_numero">{{count($session_intra_terminer) }}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">{{count($session_intra_previ) }}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">En cours<span class="system_numero">{{count($session_intra_en_cours) }}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">A venir<span class="system_numero">{{count($session_intra_avenir) }}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Annuler<span class="system_numero">{{count($session_intra_previ) }}</span></p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d;"><b> <i class="fas fa-tasks"></i> &nbsp; Session Inter entreprise </b>
                        <a class="overr" href="">
                            <p class="p-0 m-1 system_ pb-1">Complété<span class="system_numero">{{count($session_inter_terminer)}}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">En cours<span class="system_numero">{{count($session_inter_encours)}}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">{{count($session_inter_previsionnel)}}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">A venir<span class="system_numero">{{count($session_inter_avenir)}}</span></p>
                        </a>
                        <a class="overr" href="">
                            <p class="m-1 system_ pb-1">Annuler<span class="system_numero">{{count($session_inter_annuler)}}</span></p>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #8d8d8d"><b> <i class="fas fa-address-card"></i>&nbsp; Facture </b>
                        <a class="overr" href="{{route('liste_facture',2)}}">
                            <p class=" m-1 system_ pb-1">Payé<span class="system_numero">{{ count($facture_paye) }}</span></p>
                        </a>
                        <a class="overr" href="{{route('liste_facture',2)}}">
                            <p class="m-1 system_ pb-1">Non échu<span class="system_numero">{{ count($facture_non_echu) }}</span></p>
                        </a>
                        <a class="overr" href="{{route('liste_facture',2)}}">
                            <p class="m-1 system_ pb-1">Echu non payé<span class="system_numero">0</span></p>
                        </a>
                        <a class="overr" href="{{route('liste_facture',2)}}">
                            <p class="m-1 system_ pb-1">Payement partiel<span class="system_numero">0</span></p>
                        </a>
                        <a class="overr" href="{{route('liste_facture',2)}}">
                            <p class="m-1 system_ pb-1">Brouillon<span class="system_numero">{{ count($facture_brouillon) }}</span></p>
                        </a>
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
</div>


@endif
