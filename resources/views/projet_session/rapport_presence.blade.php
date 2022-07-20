@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Rapport des présences</p>
@endsection
<style>
    /* .info_session{
        background: rgb(232,203,192);
        background: linear-gradient(90deg, rgba(232,203,192,1) 39%, rgba(120,128,162,1) 100%);
    } */
    .card{
        border-radius: none !important;
    }
</style>
@section('content')
 <div class="container">
    <div class="row">
        <div class="col-lg-12 info_session">
            <div class="card" style="width: 40rem;">
                <div class="card-body">
                    <h5 class="card-title text-muted">Rapport des présences</h5>
                    <div class="card-subtitle mb-2 text-muted">
                        <h6>
                            <span>Session&nbsp;:&nbsp;</span><span>Sess-16</span><span>&nbsp;(Du @php
                                setlocale(LC_TIME, 'fr_FR');
                                echo strftime('%e %B %Y', strtotime($info_groupe->date_debut)) . ' au ' . strftime('%e %B %Y', strtotime($info_groupe->date_fin));
                            @endphp)</span>
                        </h6>
                    </div>
                    <div class="card-subtitle mb-2 text-muted">
                        <h6>
                            <span>Module : {{ $info_groupe->nom_module }}</span>
                        </h6>
                    </div>
                    <div class="card-subtitle mb-2 text-muted">
                        <h6>Organisme de formation : {{ $info_groupe->nom_cfp }}</h6>
                    </div>
                    <div class="card-subtitle mb-2 text-muted">
                        <h6>Entreprise : {{ $info_groupe->nom_etp }}</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-10 d-flex flex-row justify-content-start">
                @foreach ($seances as $detail)
                    <div class="head_detail text-muted ms-5">@php
                        echo strftime('%e %B', strtotime($detail->date_detail));
                    @endphp
                    ({{ $detail->h_debut.' - '.$detail->h_fin  }})</div>
                @endforeach
            </div>
        </div>
        <div class="row mt-3 ">
            @foreach ($data_session as $ds)
                <div class="col-md-2">{{ $ds->nom_stagiaire.' '.$ds->prenom_stagiaire }}</div>
                <div class="col-md-10 d-flex flex-row justify-content-start">
                    @foreach ($data_detail as $dd)
                            <div class="head_detail text-muted ms-5">{{ $dd->statut_presence }}</div>
                    @endforeach
                </div>
            @endforeach
            
        </div>
    </div>
</div>
@endsection