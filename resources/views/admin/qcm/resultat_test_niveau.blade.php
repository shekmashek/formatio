

@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Résultat du test de niveau</h3>
@endsection
@section('content')

<link rel="stylesheet" href="{{ asset('css/resultatQCM.css') }}">
<div id="page-wrapper">

 <div class="container">
    <div class="row">
        <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    {{-- <div class="name text-left mb-3"> 30 </div> --}}
                    <h3>{{ $stagiaire[0]->nom_stagiaire." ".$stagiaire[0]->prenom_stagiaire }}</h3>
                    <div class="cardnumber d-flex justify-content-between align-items-center px-3 mb-3">
                        <span><h4> Résultat du test : </span><span>{{ $resultat[0]->total_points }}/{{ $resultat[0]->nombre_question }}</span></h4> </div>
                    {{-- <div class="text-right visa"> 60 </div> --}}
                </div>
            </div>
        <div class="col-md-3"></div>
        {{-- <span>{{ number_format($resultat[0]->pourcentage, 2, ',', ' ') }} %</span> --}}

    </div>
 </div>



</div>


@endsection
