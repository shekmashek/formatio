@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <h3>ACTION DE FORMATION</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Details du projet
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form class="btn-submit">
                                    @foreach ($detail as $d)
                                    @csrf
                                    {{-- <input type = "text" value="{{$d->session->id}}" id ="sessionId" style='display:none'> --}}

                                    <input type="text" value="{{$d->id}}" id="detailId" style='display:none'>
                                    <div class="form-group">
                                        <label for="projet">Projet : {{$d->projet->nom_projet}}</label><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="entreprise">Entreprise : {{$nom_etp}}</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="groupe">Groupe : {{$d->groupe->nom_groupe}}</label><br>
                                    </div>
                                    <div class="form-group">
                                        <label for="formateur">Formateur : {{$d->formateur->nom_formateur}} {{$d->formateur->prenom_formateur}}</label><br>
                                    </div>
                                    {{-- <div class="form-group">
                                      <label for="session">Session : {{$d->session->date_debut}} - {{$d->session->date_fin}}</label>
                            </div> --}}
                            <div class="form-group">
                                <label for="lieu">Lieu : {{$d->lieu}}</label>
                            </div>
                            <div class="form-group">
                                <label for="session">Horaire :
                                    @php $i = 0; @endphp
                                    @foreach($date_horaire_formation as $det)
                                    @php $i += 1; @endphp
                                    @if ( $i == $nb_meme_horaire)
                                    {{$det->h_debut}} h - {{$det->h_fin}} h
                                    @else {{$det->h_debut}} h - {{$det->h_fin}} h /
                                    @endif
                                    @endforeach

                                </label>
                            </div>
                            <div class="form-group">
                                <label for="date">Date de formation:
                                    @php $i = 0; @endphp
                                    @foreach($date_horaire_formation as $det)
                                    @php $i += 1; @endphp
                                    @if ( $i == $nb_meme_horaire)
                                    {{$det->date_detail}}
                                    @else {{$det->date_detail}} /
                                    @endif
                                    @endforeach
                                </label>
                            </div>
                            {{-- @if ($d->module->formation_id == 1)
                                        <div class="form-group">
                                            <label for="formation">Formation : MS Excel</label><br>
                                        </div>
                                     @else
                                        <div class="form-group">
                                            <label for="formation">Formation : Ms Power BI</label><br>
                                        </div>
                                     @endif --}}

                            {{-- <div class="form-group">
                                      <label for="module">Module : {{$d->module->nom_module}}</label><br>
                        </div> --}}


                        @endforeach


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <br>
        <h3>LISTE DES STAGIAIRES</h3>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="nav nav-pills">
                        <li class="{{ Route::currentRouteNamed('ajout_participant') ? 'active' : '' }}"><a href="{{route('ajout_participant',['id_detail' => $detail[0]->id])}}"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter des stagiaires</a></li>
                        <li class="{{ Route::currentRouteNamed('liste_stagiaire') ? 'active' : '' }}"><a href="{{route('liste_stagiaire',['id_detail'=>$detail[0]->id])}}"><span class="glyphicon glyphicon-th-list"></span></span> Liste des stagiaires </a></li>
                    </ul>
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>Photo</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th colspan="3">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($stagiaire as $stg)
                                <tr>
                                    <td>
                                        <img src="{{asset('images/stagiaires/'.$stg->photos)}}" width="100" height="100">
                                    </td>
                                    <td>{{$stg->nom_stagiaire}}</td>
                                    <td>{{$stg->prenom_stagiaire}}</td>

                                    @canany(['isFormateur'])
                                    <td>
                                        <a href="{{route('evaluation_stagiaire_form',['matricule'=>$stg->stagiaire_id,'groupe_id'=>$stg->groupe_id])}}"><button class="btn btn-primary">Evaluation du stagiaire</button></a>
                                    </td>
                                    @endcanany

                                    @canany(['isStagiaire'])
                                    <td>
                                        <a href="{{route('faireEvaluationChaud',$stg->matricule)}}"><button class="btn btn-primary" id="{{$stg->matricule}}">Evaluation à chaud</button></a>
                                    </td>
                                    @endcanany

                                    <td><a href="{{route('evaluationchaud.show',$stg->matricule)}}"><button class="btn btn-primary">Voir</button></a></td>
                                    <td><a href="{{route('destroy_stagiaire_detail',['id_groupe' => $stg->detail_id,'id_stagiaire'=>$stg->stagiaire_id])}}"><button class="btn btn-danger" id="{{ $stg->detail_id.':'.$stg->stagiaire_id }}"><i class="fa fa-trash"></i></button></a></td>

                                </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $(".supprimer").on('click', function(e) {
        var id = e.target.id;
        var id_array = id.split(":")
        $.ajax({
            type: "GET"
            , url: "{{ route('destroy_stagiaire_detail') }}"
            , data: {
                'id_det': id_array[0]
                , 'id_stg': id_array[1]
            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error")
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

</script>

@endsection
