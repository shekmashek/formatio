
@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('css/style_dashboard.css')}}">
<div class=" p-0 m-0 nav d-flex flex-row navigation justify-content-end" style="font-size: 10px;">
        <a href="{{ route('home') }}" type="button" class="btn a active" style="font-size: 12px;"><i class="fas fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB système</a>
        <a href="{{ route('homertdbf')}}" type="button" class="btn bb  me-2 ms-2" style="font-size: 12px;"><i class="fas fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB financier</a>
        <a href="{{ route('homertdbq')}}" type="button" class="btn bb" style="font-size: 12px;"> <i class="fa fa-chart-bar" style="font-size: 10px;"></i>&nbsp;TDB qualité</a>
</div>


<div class="p-1 m-0">
    <div class="container-fluid" style="font-size: 10px;">
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fad fa-users "></i>&nbsp; Collaborateur </b>
                    <a class="overr" href="{{route('collaboration')}}"><p class=" m-1 system_ pb-1">Formateurs interne<span class="system_numero">{{ count($formateur_referent)}}</span></p></a>
                    <a class="overr" href="{{route('collaboration')}}"><p class="m-1 system_ pb-1">Entreprise<span class="system_numero">{{ count($cfps)}}</span></p></a>
                    <p class="m-1 system_ pb-1">Équipe administrative<span class="system_numero">{{$total}}</span></p>
                    <a class="overr" href="{{route('liste_participant')}}"> <p class="m-1 system_ pb-1">Employée<span class="system_numero">{{$nb_stagiaire}}</span></p></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fad fa-address-card"></i>&nbsp; Facture </b>
                    <a class="overr" href=""><p class=" m-1 system_ pb-1">Payé<span class="system_numero">{{ count($facture_paye) }}</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Non échu<span class="system_numero">{{ count($facture_non_echu) }}</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Echu non payé<span class="system_numero">0</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Payement partiel<span class="system_numero">0</span></p></a>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68; height:129px;"><b> <i class="fal fa-building"></i> &nbsp; Profil de l'organisation ({{ $etp }}) </b>
                    @if ($referent->adresse_quartier==null or $referent->adresse_code_postal==null and $referent->adresse_lot==null and $referent->adresse_ville==null and $referent->adresse_region==null)
                        <a class="overr" href="{{route('affResponsable')}}"> <p class="p-0 m-1 system_ pb-1">Adresse<span class="system_numeroAlert">Incomplet</span></p></a>
                    @else
                        <a class="overr" href="{{route('affResponsable')}}"> <p class="m-1 system_ pb-1">Adresse<span class="system_numeroSuccess">Complet</span></p></a>
                    @endif

                    @if ($refs->nif==null or $refs->stat==null or $refs->rcs==null)
                        <a class="overr" href="{{route('affResponsable')}}"><p class="p-0 m-1 system_ pb-1">Informations légales<span class="system_numeroAlert">Incomplet</span></p></a>
                    @else
                        <a class="overr" href="{{route('affResponsable')}}"><p class="m-1 system_ pb-1">Informations légales<span class="system_numeroSuccess">Complet</span></p></a>
                    @endif
                    {{-- <p class="m-1 system_ pb-1">Information légale<span class="system_numeroSuccess">complet</span></p> --}}
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Type d'abonnement<span class="system_numero">
                            @foreach($name as $ab)
                                {{ $ab->nom_type }}
                            @endforeach
                    </span></p></a>
                </div>
            </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-3" style="font-size: 10px;">
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fas fa-tasks"></i>&nbsp; Formation intra entreprise</b>
                    <a class="overr" href=""><p class="p-0 m-1 system_ pb-1">Complété<span class="system_numero">{{ count($session_intra_terminer) }}</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">{{ count($session_intra_previ) }}</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">En cours<span class="system_numero">{{ count($session_intra_en_cours) }}</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">A venir<span class="system_numero">{{ count($session_intra_avenir) }}</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Annuler<span class="system_numero">{{ count($session_intra_previ) }}</span></p></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fas fa-tasks"></i> &nbsp; Formation inter entreprise</b>
                    <a class="overr" href=""><p class="p-0 m-1 system_ pb-1">Complété<span class="system_numero">3</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">En cours<span class="system_numero">7</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">0</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">A venir<span class="system_numero">0</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Annuler<span class="system_numero">0</span></p></a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fas fa-tasks"></i> &nbsp; Formation interne entreprise</b>
                    <a class="overr" href=""><p class="p-0 m-1 system_ pb-1">Complété<span class="system_numero">3</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">En cours<span class="system_numero">7</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">0</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">A venir<span class="system_numero">0</span></p></a>
                    <a class="overr" href=""><p class="m-1 system_ pb-1">Annuler<span class="system_numero">0</span></p></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
