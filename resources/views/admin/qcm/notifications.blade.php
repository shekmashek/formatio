@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Notifications</h3>
@endsection
@section('content')

<link rel="stylesheet" href="{{ asset('css/resultatQCM.css') }}">
<div id="page-wrapper">
 <div class="container">
    <div class="row">
        <div class="col-md-3"></div>
            <div class="col-md-6">
                <button type="button" class="btn btn-success" data-toggle="collapse" data-target="#modifierrecommandation">Notifications <span class="badge badge-info">{{ count($notifications) }}</span></button>
                <div id="modifierrecommandation" class="collapse">
                            <ul>
                                @foreach ($notifications as $notif)
                                <a href="{{ route('auto_evaluation',[$notif->cfp_id,$notif->formation_id]) }}">
                                    <li>
                                        <span>Evaluation pour {{ $notif->nom_formation }}</span><br>
                                        <span>{{ $notif->description_test }}</span>
                                    </li>
                                </a>
                                @endforeach
                            </ul>

                </div>
            </div>
        <div class="col-md-3">

        </div>
        {{-- <span>{{ number_format($resultat[0]->pourcentage, 2, ',', ' ') }} %</span> --}}

    </div>
 </div>



</div>


@endsection
