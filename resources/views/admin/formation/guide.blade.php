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
                    <i class="far fa-book fa-5x"></i>
                </div>
                <h1 class="text-center mt-5" >   Bienvenue ! Vous devriez avoir une formation </h1><br>
            </div>
            <div class=" text-center col-lg-12">
                <div class="body">
                    <h5 class="title"></h5>
                    <p class="text">Nous invitons à vous créer une formation en cliquant sur le bouton créer maintenant</p>
                    <a href="{{route('nouvelle_formation')}}" class="btn btn" style="text-color:#801D68;" >Créer maintenent</a>
                    <style>
                        .btn{ background-color: #801D68 ; color:white;}
                        .btn:hover{color: white;}

                    </style>
                </div>
            </div>
        </div>
    </div>

@endsection