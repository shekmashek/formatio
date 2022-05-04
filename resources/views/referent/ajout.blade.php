@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Plan de formation</p>
@endsection
@section('content')
<div id="page-wrapper">
<div class="shadow-sm p-3 mb-5 bg-body rounded">
    <div class="container-fluid">
    <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                {{-- <h3>PLAN DE FORMATION</h3> <br> --}}
                <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class ="{{ Route::currentRouteNamed('liste_demande_stagiaire') ? 'active' : '' }}"><a href="{{route('liste_demande_stagiaire')}}" ><span class="fa fa-th-list"></span>  Liste des demandes</a></li>&nbsp;&nbsp;
                            <li class ="{{ Route::currentRouteNamed('listePlanFormation') ? 'active' : '' }}"><a href="{{route('listePlanFormation')}}" ><span class="fa fa-th-list"></span>  Liste des Plan de formation</a></li>&nbsp;&nbsp;
                            <li  class ="{{ Route::currentRouteNamed('ajout_plan') ? 'active' : '' }}" ><a href="{{route('ajout_plan')}}"><span class="fa fa-plus-sign"></span> Nouveau Plan de formation</a></li>

                        </ul>
                </div>
            </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @foreach ($plan as $plans)
                    <label for="">Collaborateur : {{ $plans->stagiaire->nom_stagiaire }} {{ $plans->stagiaire->prenom_stagiaire }} - {{$plans->stagiaire->fonction_stagiaire }}</label><br>
                    <label for="">Formation: {{ $plans->formation->nom_formation }}</label>

                @endforeach
            </div>
        </div>
        <br>
    <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">

                                <form action = "{{route('enregistrerPlan')}}" method = "POST" >
                                    @csrf
                                    <input type = "text" style="display: none" name = "idRecueil" value="{{$plan[0]->id}}">
                                    <input type = "text"  style="display: none"  name = "idAnnee" value="{{$plan[0]->annee_plan_id}}">
                                    <br>
                                    <label for="typologieFormation">Typologie de formation</label><br><br>
                                    <select class="form-select" aria-label="Default select example" id="typologieFormation" name="typologie">
                                        <option value="Choisissez une typologie...">Choisissez une typologie...</option>
                                        <option value="Adaptation au poste">Adaptation au poste</option>
                                        <option value="Evolution dans l’emploi">Evolution dans l’emploi</option>
                                        <option value="Développement de compétences">Développement de compétences</option>

                                    </select>
                                    <div class="form-group">
                                      <label for="objectifAttendu">Objectif attendue</label><br><br>
                                      <input type="text" autocomplete="off" class="form-control" id="objectifAttendu" name="objectif" placeholder="Objectif attendue">
                                      @error('objectif')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br><br>

                                    <div class="col-lg-6">


                                    <div class="form-group">
                                      <label for="coutPrevisionnel">Coût prév.</label><br><br>
                                      <input type="text" autocomplete="off" class="form-control" id="coutPrevisionnel" name="cout" placeholder="Coût prévisionnel">
                                      @error('cout')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br><br>
                                    <div class="form-group">
                                      <label for="modeFinancement">Mode de financement</label><br><br>
                                      <select class="form-select" aria-label="Default select example" id="typologieFormation" name="mode_financement">
                                        <option value="Choisissez un mode de financement...">Choisissez un mode de financement...</option>
                                        <option value="Fonds propre">Fonds propre</option>
                                        <option value="FMFP">FMFP</option>
                                    </select>
                                    </div><br>
                                    </div>
                                    <button type = "submit" class="btn btn-outline-success "><span class="fa fa-save"></span>&nbsp; Ajouter

                                </form>

                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection
