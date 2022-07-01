@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Guide</p>
@endsection
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <div class="row w-100">
        <div class="container">
            <div class="col-lg-12">
                <br>
                <div class="text-center">
                    <i class="far fa-address-book fa-5x"></i>
                </div>
                <h1 class="text-center mt-5" >Vous n'avez pas encore du module</h1><br>
            </div>
            <div class="text-center col-lg-12">
                <div class="body">
                    <h5 class="title"></h5>
                    <p class="text"></p>
                    <p class="text">Nous invitons à créer votre premier module de formation en cliquant sur le bouton créer maintenant</p>
                    <a data-bs-toggle="modal" data-bs-target="#nouveau_module" class=" btn_nouveau" role="button">Créer maintenant</a>
                </div>
            </div>
        </div>
    </div>

@endsection