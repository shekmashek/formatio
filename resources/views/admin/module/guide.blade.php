@extends('./layouts/admin')
@section('content')

    <div class="row w-100">
        <div class="container">
            <div class="col-lg-12">
                <br>
                <h5 class="text-center mt-1" >Bienvenue ! Vous devriez avoir une module</h5><br>
            </div>
            <div class="card text-center col-lg-12">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"></p>
                    <p class="card-text">
                        nous invitons de vous créer une projet de formation veuillez ajouter votre nouvelle module ici</p>
                    <a href="{{route('nouveau_module')}}" class="btn btn-outline-warning">Créer maintenent</a>
                </div>
            </div>
        </div>
    </div>

@endsection