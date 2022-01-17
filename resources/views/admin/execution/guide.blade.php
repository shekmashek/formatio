@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <div class="text-center">
                <i class="fa fa fa-object-group fa-5x" aria-hidden="true"></i>
                </div>
                <h3 class="text-center mt-5 "  style="font-weight:bold">Vous devez avoir un projet!</h3><br>
            </div>
            <div class="text-center">
                <div class="body">
                  <h5 class="title">Avoir session du goupe</h5>
                  <h5 class="title">Et ajouter des stagiaires</h5>
                  <p class="text"></p>
                  <p class="text"></p>
                  <a href="{{route('ajout_participant')}}" class="btn btn-outline-warning">Ajout Stagiaire</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection