@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Evaluation à froid</h3>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        {{-- <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>EVALUATION</h3>
            </div>
        </div> --}}
        <form action="{{route('evaluation.store')}}" method = "post">
            @csrf

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class ="{{ Route::currentRouteNamed('evaluation') ? 'active' : '' }}"><a href="{{route('liste_participant')}}" ><span class="glyphicon glyphicon-th-list"></span>  Liste des evaluations</a></li>
                            {{-- <li  class ="{{ Route::currentRouteNamed('nouveau_participant') ? 'active' : '' }}" ><a href="{{route('nouveau_participant')}}"><span class="glyphicon glyphicon-plus-sign"></span> Nouveau </a></li> --}}
                        </ul>
                    </div>
                    <div class="panel-body">
                        @foreach($stagiaire as $stg)
                        <input type = "text" for="stagiaire_id" name = "stagiaire_id" style='display:none'  value = "{{$stg->id}}">
                        <label for="nom_stagiaire">Nom du stagiaire:{{$stg->nom_stagiaire }}  {{$stg->prenom_stagiaire }}</label><br>
                        <label for="entreprise">Entreprise: {{$stg->entreprise->nom_etp }}</label>
                        @endforeach
                        <br>
                        <input type = "text" for="projet_id" name = "projet_id" style='display:none'  value = "{{$detail[0]->projet_id}}">
                        @foreach($detail as $dt)
                            {{-- <input type = "text" for="detail_id" name = "detail_id" style='display:none'  value = "{{$dt->id}}"> --}}
                            <input type = "text" for="module_id" name = "module_id" style='display:none'  value = "{{$dt->module_id}}">
                            <label for="groupe">Groupe:{{$dt->nom_groupe }}</label><br>
                            <label for="session">Session: {{$dt->date_debut }} / {{$dt->date_fin }}</label><br>
                            <label for="module">Module: {{$dt->nom_module }}</label><br>
                            @if ($dt->formation_id == 1)
                                <label for="formation">Formation : MS Excel</label><br>
                            @else
                                <label for="formation">Formation : Ms Power BI</label><br>
                            @endif
                            <label for="formateur">Formateur: {{$dt->nom_formateur }} {{$dt->prenom_formateur }}</label><br>
                        @endforeach
                        <br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Programme</th>
                                        <th>Compétences</th>
                                        <th>Non acquis</th>
                                        <th>En cours d'acquisition</th>
                                        <th>Acquis</th>
                                        <th>Avancée</th>
                                        <th>Peut enseigner les autres</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($programme as $pg)
                                    <tr>
                                        @if($pg->module_id == $detail[0]->module_id)
                                            <td>{{$pg->titre}}</td>
                                            <td>
                                                <ul>
                                                    @foreach($cours as $crs)
                                                        @if($crs->programme_id == $pg->id)
                                                            <li>{{$crs->titre_cours}}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>

                                            </td>
                                            @foreach($nb_evaluation as $nb_ev)
                                                @if($nb_ev->froid_evaluation_count == 0)
                                                    <td>
                                                        @foreach($cours as $crs)
                                                            @if($crs->programme_id == $pg->id)
                                                                <input type="radio"  name="cours[{{ $crs->cours_id }}]" data-id="{{$crs->cours_id}}" class = "NA" value = "0"><br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($cours as $crs)
                                                            @if($crs->programme_id == $pg->id)
                                                                <input type="radio"  name="cours[{{ $crs->cours_id }}]" data-id="{{$crs->cours_id}}" class = "EC" value = "1"><br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($cours as $crs)
                                                            @if($crs->programme_id == $pg->id)
                                                                <input type="radio"  name="cours[{{ $crs->cours_id }}]" data-id="{{$crs->cours_id}}" class = "AC" value = "2"><br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($cours as $crs)
                                                            @if($crs->programme_id == $pg->id)
                                                                <input type="radio"  name="cours[{{ $crs->cours_id }}]" data-id="{{$crs->cours_id}}" class = "AV" value = "3"><br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($cours as $crs)
                                                            @if($crs->programme_id == $pg->id)
                                                                <input type="radio"  name="cours[{{ $crs->cours_id }}]" data-id="{{$crs->cours_id}}" class = "PE" value = "4"><br>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                {{-- @else
                                                    <td>
                                                        @foreach($cours as $crs)
                                                            @if($crs->programme_id == $pg->id)
                                                                @foreach($evaluation_stagiaire as $evaluationStg)
                                                                    @if($crs->id == $evaluationStg->cours_id )
                                                                        @if($evaluationStg->status == "0")
                                                                            <span class="glyphicon glyphicon-remove-circle"><label style="color:rgb(255, 0, 0)">[{{$crs->titre_cours}}]</label></span><br>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($cours as $crs)
                                                            @if($crs->programme_id == $pg->id)
                                                                @foreach($evaluation_stagiaire as $evaluationStg)
                                                                    @if($crs->id == $evaluationStg->cours_id)
                                                                        @if($evaluationStg->status == "1")
                                                                            <span class="glyphicon glyphicon-refresh"><label style="color:rgb(255, 136, 1)">[{{$crs->titre_cours}}]</label></span><br>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($cours as $crs)
                                                            @if($crs->programme_id == $pg->id)
                                                                @foreach($evaluation_stagiaire as $evaluationStg)
                                                                    @if($crs->id == $evaluationStg->cours_id)
                                                                        @if($evaluationStg->status == "2")
                                                                            <span class="glyphicon glyphicon-refresh"><label style="color:rgb(255, 230, 1)">[{{$crs->titre_cours}}]</label></span><br>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach($cours as $crs)
                                                            @if($crs->programme_id == $pg->id)
                                                                @foreach($evaluation_stagiaire as $evaluationStg)
                                                                    @if($crs->id == $evaluationStg->cours_id)
                                                                        @if($evaluationStg->status == "3")
                                                                            <span class="glyphicon glyphicon-refresh"><label style="color:rgb(60, 255, 1)">[{{$crs->titre_cours}}]</label></span><br>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </td>

                                                    <td>
                                                        @foreach($cours as $crs)
                                                            @if($crs->programme_id == $pg->id)
                                                                @foreach($evaluation_stagiaire as $evaluationStg)
                                                                    @if($crs->id == $evaluationStg->cours_id)
                                                                        @if($evaluationStg->status == "4")
                                                                            <span class="glyphicon glyphicon-ok-circle"><label style="color:rgba(1, 128, 1)">[{{$crs->titre_cours}}]</label></span><br>
                                                                        @endif
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    </td> --}}
                                                @endif
                                            @endforeach
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @foreach($nb_evaluation as $nb_ev)
                                @if($nb_ev->froid_evaluation_count == 0)
                                    <button type ="submit " id = "evaluer" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Evaluer</button>
                                @endif
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
</script>
@endsection
