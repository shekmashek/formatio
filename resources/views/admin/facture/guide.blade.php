@extends('./layouts/admin')
@section('content')
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <div class="row w-100">
        <div class="container">
            <div class="col-lg-12">
                <br>
                <div class="text-center">
                    <i class="far fa-newspaper fa-5x"></i>
                </div>
                <h1 class="text-center mt-5">Pour commencer, veuillez suivre les étapes citées ci-après </h1><br>
            </div>
            <div class=" text-center col-lg-12">
                <div class="body">
                    <div class="row d-flex">
                        <div class="col text-right">
                            <p class="title"> Vous devriez avoir :</p>
                        </div>
                        <div class="col text-left">
                            <p>- une collaboration avec une entreprise,</p>
                            <p>- une collaboration avec une entreprise,</p>
                        </div>
                    </div>
                    {{-- <a href="{{route('liste_facture',3)}}" class="btn btn">Créer maintenent</a>
                    <style>
                        .btn{ background-color: #801D68 ; color:white;}
                        .btn:hover{color: white;}
                    </style> --}}
                </div>
            </div>
        </div>
    </div>

@endsection
