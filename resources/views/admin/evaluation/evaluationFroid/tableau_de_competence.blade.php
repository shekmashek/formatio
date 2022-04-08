@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">tableau de compétence</h3>
@endsection
@section('content')
<link href="{{asset('css/tableau_competence.css')}}" rel="stylesheet">
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="scratch1">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <img src="{{ asset('storage/'.$projet->logo) }}" alt="logo_entreprise">
                                        <H4>{{ $projet->nom_etp }}</H4>
                                    </div>
                                </div>
                            </div>
                        </div>


                      <div class="row">
                        <div class="col-md-12">
                            {{-- <h5>Tableau de compétences</h5> --}}
                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                  <th></th>
                                    @foreach ($cours as $crs)
                                        <th><span>{{ $crs->titre_cours }}</span></th>
                                    @endforeach
                                    <th><span>Poucentage</span></th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                    @foreach ($stagiaire as $stg)
                                        <th scope="row"><img src="{{ asset('images/stagiaires/'.$stg->photos) }}" alt=""> {{ $stg->nom_stagiaire." ".$stg->prenom_stagiaire }}</th>
                                        @foreach ($cours as $crs)
                                            @foreach ($evaluation as $eval)
                                                @if ($id_projet == $eval->projet_id && $eval->stagiaire_id == $stg->stagiaire_id && $crs->cours_id == $eval->cours_id)
                                                    <td style="color:{{ $eval->couleur }}; text-align: center"><i class="fa fa-circle"></i></td>
                                                @endif
                                            @endforeach
                                        @endforeach
                                        @foreach ($pourcentage as $pg)
                                            @if ($pg->stagiaire_id == $stg->stagiaire_id)
                                            <th scope="row">{{ $pg->pourcentage." %" }}</th>
                                            @endif
                                        @endforeach
                                        <tr>
                                    @endforeach
                                <tr>
                              </tbody>
                            </table>
                          </div>

                        </div>
                      </div>
                      <div class="row">
                            <span ><i style="color: #018001;" class="fa fa-circle"></i> Peut enseigner les autres</span>
                            <span ><i style="color: #3CFF01;" class="fa fa-circle"></i> Avancée</span>
                            <span ><i style="color: #FFE601;" class="fa fa-circle"></i> Acquis</span>
                            <span ><i style="color: #FF8801;" class="fa fa-circle"></i> En cours d'acquisition</span>
                            <span ><i style="color: #FF0000;" class="fa fa-circle"></i> Non acquis</span>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
</script>
@endsection
