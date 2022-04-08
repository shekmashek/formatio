@extends('./layouts/admin')
@section('title')
    <h3 class="text-white ms-5">Guide</h3>
@endsection
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <div class="row w-100">
        <div class="container">
            <div class="col-lg-12">
                <br>
                <div class="text-center">
                    <i class="far fa-list-alt fa-5x"></i>
                </div>
                <h1 class="text-center mt-5" >Vous n'avez pas aucune programme</h1><br>
            </div>
            <div class=" text-center col-lg-12">
                <div class="body">
                    <h5 class="title"></h5>
                    <p class="text"></p>
                    <p class="text">Nous invitons à créer votre premier programme en cliquant sur le bouton créer maintenant</p>
                    <a href="{{route('nouvelle_programme')}}" class="btn btn">Créer maintenent</a>
                    <style>
                        .btn{ background-color: #801D68 ; color:white;}
                        .btn:hover{color: white;}
                    </style>
                </div>
            </div>
        </div>
    </div>

@endsection

