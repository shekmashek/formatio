@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('css/style_dashboard.css')}}">
{{-- <link rel="stylesheet" href="ttps://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"> --}}

<div class=" p-0 m-0 nav d-flex flex-row navigation justify-content-end" style="font-size: 10px;">
        <a href="{{ route('home') }}" type="button" class="btn a active" style="font-size: 12px;"> <i class="fas fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB système</a>
        <a href="{{ route('hometdbf')}}" type="button" class="btn bb me-2 ms-2" style="font-size: 12px;"><i class="fas fa-chart-bar" style="font-size: 10px;"></i>&nbsp;TDB financier</a>
        <a href="{{ route('hometdbq')}}" type="button" class="btn bb" style="font-size: 12px;"> <i class="fas fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB qualité</a>
</div>


<div class="p-1 m-0">
    <div class="container-fluid" style="font-size: 10px;">
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68;height:151px"><b> <i class="fas fa-users "></i>&nbsp; Collaborateur </b>
                    <a class="overr" href="{{route('collaboration')}}"> <p class=" m-1 system_ pb-1"> Formateurs<span class="system_numero">{{ count($formateur)}} </span></p></a>
                    <a class="overr" href="{{route('liste_entreprise')}}"><p class="m-1 system_ pb-1">Entreprise<span class="system_numero">{{ count($dmd_cfp_etp) }}</span></p></a>
                    <a class="overr" href="{{route('liste+responsable+cfp')}}"><p class="m-1 system_ pb-1">Equipe administrative<span class="system_numero">{{ count($resp_cfp) }}</span></p></a>
                    {{-- <p class="m-1 system_ pb-1">Manager<span class="system_numero">0</span></p> --}}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68;height:151px"><b> <i class="fas fa-book"></i> &nbsp; Catalogue </b>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Publié<span class="system_numero">{{ count($module_publié) }}</span></p></a>
                        <a class="overr" href=""><p class="m-1 system_ pb-1">En cours de création<span class="system_numero">{{ count($module_encours_publié) }}</span></p></a>
                    {{-- <p class="m-1 system_ pb-1">Programme incomplète<span class="system_numero">70</span></p>
                    <p class="m-1 system_ pb-1">Compétence incomplète<span class="system_numero">70</span></p> --}}
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Archiver<span class="system_numero">70</span></p></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fas fa-address-card"></i>&nbsp; Facture </b>
                    <a class="overr" href="{{route('liste_facture',2)}}"><p class=" m-1 system_ pb-1">Payé<span class="system_numero">{{ count($facture_paye) }}</span></p></a>
                    <a class="overr" href="{{route('liste_facture',2)}}"><p class="m-1 system_ pb-1">Non échu<span class="system_numero">{{ count($facture_non_echu) }}</span></p></a>
                    <a class="overr" href="{{route('liste_facture',2)}}"><p class="m-1 system_ pb-1">Echu non payé<span class="system_numero">0</span></p></a>
                    <a class="overr" href="{{route('liste_facture',2)}}"><p class="m-1 system_ pb-1">Payement partiel<span class="system_numero">0</span></p></a>
                    <a class="overr" href="{{route('liste_facture',2)}}"><p class="m-1 system_ pb-1">Brouillon<span class="system_numero">{{ count($facture_brouillon) }}</span></p></a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="font-size: 10px;">
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fas fa-tasks"></i>&nbsp; Session Intra enreprise </b>
                    <a class="overr" href=""><p class="p-0 m-1 system_ pb-1">Complété<span class="system_numero">{{ count($session_intra_terminer) }}</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">{{ count($session_intra_previ) }}</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">En cours<span class="system_numero">{{ count($session_intra_en_cours) }}</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">A venir<span class="system_numero">{{ count($session_intra_avenir) }}</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Annuler<span class="system_numero">{{ count($session_intra_previ) }}</span></p></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68;"><b> <i class="fas fa-tasks"></i> &nbsp; Session Inter entreprise </b>
                    <a class="overr" href=""><p class="p-0 m-1 system_ pb-1">Complété<span class="system_numero">3</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">En cours<span class="system_numero">7</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">0</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">A venir<span class="system_numero">0</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Annuler<span class="system_numero">0</span></p></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68;height:151px"><b> <i class="fas fa-building"></i> &nbsp; Profil de l'organisation ({{  $nom_profil_organisation }}) </b>
                    @if ($ref->adresse_lot==null or $ref->adresse_quartier==null and $ref->adresse_code_postal==null and $ref->adresse_ville==null and $ref->adresse_region==null)
                        <a class="overr" href="{{route('affResponsableCfp')}}"> <p class="p-0 m-1 system_ pb-1">Adresse<span class="system_numeroAlert">Incomplet</span></p></a>
                    @else
                        <a class="overr" href="{{route('affResponsableCfp')}}"><p class="m-1 system_ pb-1">Adresse<span class="system_numeroSuccess">Complet</span></p></a>
                    @endif

                    @if ($ref->nif==null or $ref->stat==null or $ref->rcs==null)
                        <a class="overr" href="{{route('affResponsableCfp')}}"><p class="p-0 m-1 system_ pb-1">Informations légales<span class="system_numeroAlert">Incomplet</span></p></a>
                    @else
                        <a class="overr" href="{{route('affResponsableCfp')}}"><p class="m-1 system_ pb-1">Informations légales<span class="system_numeroSuccess">Complet</span></p></a>
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

                    <a class="overr" href=""><p class="m-1 system_ pb-1">Type d'abonnement<span class="system_numero">
                            {{-- @foreach($name as $ab)
                                {{ $ab->nom_type }}
                            @endforeach --}}
                    </span></p></a>
                </div>
            </div>
        </div>
    </div>

@endsection
