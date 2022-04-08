@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Nouveau plan de formation</p>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="shadow-sm p-3 mb-5 bg-body rounded">
        <div class="container-fluid">
        {{-- <div class="shadow p-3 mb-5 bg-body rounded">
            {{-- <div class="row">
                <div class="col-lg-12">
                    <br>
                <h3>Nouveau plan de formation</h3>
            </div>
            <!-- /.col-lg-12
        </div> --}}
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12 mt-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class ="{{ Route::currentRouteNamed('liste_demande_stagiaire') ? 'active' : '' }}"><a href="{{route('liste_demande_stagiaire')}}" ><span class="fa fa-th-list"></span>  Liste des demandes</a></li>&nbsp;&nbsp;
                            <li class ="{{ Route::currentRouteNamed('listePlanFormation') ? 'active' : '' }}"><a href="{{route('listePlanFormation')}}" ><span class="fa fa-th-list"></span>  Liste des Plans de formation</a></li>&nbsp;&nbsp;
                            <li  class ="{{ Route::currentRouteNamed('ajout_plan') ? 'active' : '' }}" ><a href="{{route('ajout_plan')}}"><span class="fa fa-plus-sign"></span> Nouveau Plan de formation</a></li>

                        </ul>
                    </div>

                    <div class="panel-body">
                            <form action="{{route('enregistrer')}}">
                        <div class="form-group">
                                <label for="annee">Entrée l'Année</label>
                <input type="number" placeholder="ANNEE" min="2017" max="2100" class="form-control" name="annee">

                                <button class="btn btn-primary">Valider</button>

                        </div>
                    </div>

                </form>
    </div>
</div>
<script>
  document.querySelector("input[type=number]")
  .oninput = e => console.log(new Date(e.target.valueAsNumber, 0, 1))
</script>

@endsection
