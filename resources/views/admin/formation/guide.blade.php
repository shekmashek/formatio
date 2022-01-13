@extends('./layouts/admin')
@section('content')

    <div class="row w-100">
        <div class="container">
            <div class="col-lg-12">
                <br>
                <h1 class="text-center mt-5" >Bienvenue ! Vous devriez avoir une formation</h1><br>
            </div>
            <div class=" text-center col-lg-12">
                <div class="body">
                    <h5 class="title"></h5>
                    <p class="text">Si votre liste n'a pas encore dans les listes ci-dessous, </p>
                    <p class="text">
                        nous invitons de vous créer une projet de formation veuillez ajouter votre nouvelle formation ici</p>
                    <a href="{{route('nouvelle_formation')}}" class="btn btn-outline-warning">Créer maintenent</a>
                </div>
            </div>
        </div>
    </div>

@endsection