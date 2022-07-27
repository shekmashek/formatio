@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Rapport des présences</p>
@endsection
<style>
    .info_session{
        background: rgb(232,203,192);
        background: linear-gradient(90deg, rgb(140, 120, 162) 39%, rgba(232,203,192,1) 100%);
    }
    .card{
        border-radius: none !important;
        border: none !important;
    }
    .card-body{
        color: white !important;
    }
</style>
@section('content')
 <div class="container">
    <div class="row">
        <div class="col-12 info_session">
            <div class="" style="width: 40rem;">
                <div class="card-body">
                    <h5 class="card-title">Rapport des présences des stagiaires</h5>
                    <div class="card-subtitle mb-2">
                        <h6>
                            <span>Session&nbsp;:&nbsp;</span><span>{{ $info_groupe->nom_groupe }}&nbsp;(Du @php
                                setlocale(LC_TIME, 'fr_FR');
                                echo strftime('%e %B %Y', strtotime($info_groupe->date_debut)) . ' au ' . strftime('%e %B %Y', strtotime($info_groupe->date_fin));
                            @endphp)</span>
                        </h6>
                    </div>
                    @if ($info_groupe->type_formation_id == 3)
                        <div class="card-subtitle mb-2">
                            <h6>Session interne</h6>
                        </div>
                    @endif
                    <div class="card-subtitle mb-2">
                        <h6>
                            <span>Module : {{ $info_groupe->nom_module }}</span>
                        </h6>
                    </div>
                    @if($info_groupe->type_formation_id != 3)
                        <div class="card-subtitle mb-2">
                            <h6>Organisme de formation : {{ $info_groupe->nom_cfp }}</h6>
                        </div>
                        <div class="card-subtitle mb-2">
                            <h6>Entreprise : {{ $info_groupe->nom_etp }}</h6>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 mt-3">
            <table class="table table-borderless table-hover text-muted">
                <thead>
                    <tr>
                        <th class="text-muted col-2">Stagiaire(s)</th>
                        @foreach ($seances as $detail)
                            <th class="text-center">
                                <div class="text-muted">
                                    @php
                                        echo strftime('%e %B', strtotime($detail->date_detail));
                                    @endphp
                                    <br>({{ $detail->h_debut.' - '.$detail->h_fin  }})
                                </div>
                            </th>
                        @endforeach
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_session as $ds)
                        <tr>
                            <td class="col-2 mt-2">
                                @if($ds->photos == null)
                                    <div class="d-flex"><span class="mt-1 p-0" style="background-color:rgb(213, 166, 217); color:white; font-size: 16px; border: none; border-radius: 100%; height:30px; width:30px ; display: grid; place-content: center;">{{ $ds->sans_photos }}</span><span class="ms-1" style="margin-bottom:0.4rem;">{{ $ds->matricule }}<br>{{ $ds->nom_stagiaire.' '.$ds->prenom_stagiaire }}</span></div>
                                @else
                                    <div class="d-flex"><img src="{{ asset("images/employes/".$ds->photos) }}" alt="" height="30px" width="30px" style="border-radius: 50%;"><span class="ms-1" style="margin-top:0.4rem;">{{ $ds->nom_stagiaire.' '.$ds->prenom_stagiaire }}</span></div>
                                @endif
                                
                            </td>
                            @foreach ($data_detail as $dd)
                                @if($dd->stagiaire_id == $ds->stagiaire_id and $dd->groupe_id == $ds->groupe_id)
                                    <th class="text-center pt-4">
                                        @if ($dd->statut_presence == 1)
                                            <i class='bx bxs-check-circle' style="color: chartreuse"></i>
                                        @elseif ($dd->statut_presence == 0)
                                            <i class='bx bxs-x-circle' style="color: red"></i>
                                        @endif
                                    </th>
                                @endif
                            @endforeach
                            <td>
                                @if($ds->statut_presence_groupe == 0)
                                <i class='bx bxs-user-x' style="color: red"></i>
                                @elseif($ds->statut_presence_groupe == 1)
                                <i class='bx bxs-user-minus' style="color: orange"></i>
                                @elseif($ds->statut_presence_groupe == 2)
                                <i class='bx bxs-user-check' style="color: chartreuse"></i>
                                @endif
                                {{ $ds->statut_presence_groupe_text }}
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection