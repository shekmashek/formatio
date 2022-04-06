@extends('layouts.admin')
@section('title')
    <p class="text_header m-0 mt-1">Abonnement</p>
@endsection
@section('content')
<html>
    <head>
        <title> Pricing || page </title>
        <link rel="stylesheet" href="{{ asset('bootstrapCss/css/bootstrap.min.css') }}">
        <!-- CSS only -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


</head>
@include('Views.superadmin.index-css')
<body class="bg-light">
    <div class="carHead">

                {{-- <div class="row" style="color: white;">
                    <div class="col-md-4 text-center"><img class="img-fluid rounded-3" style="width: 150px; height:80px;" src="{{ asset('logo/logo_white_background.jpg') }}" alt=""></div>
                    <div class="col-md-4">
                        <div class="bar">
                              <p> Pages  </p>
                               <p> Authentification </p>
                                <p>Application  </p>
                                <p>e-commerce  </p>
                        </div>
                    </div>
                    <div class="col-md-4 text-center"><button class="buy_now"><i class="fa fa-plus"></i>&nbsp;<a href="{{route('abonnement.index')}}">Ajouter un nouvel abonnement</a>  </button></div>
                </div> --}}



            <h2 class="text-white font text-center mt-5"> Voici notre tarif </h2>
            @isset($payant)
                @foreach ($abn as  $abonnements)
                    @foreach ($payant as $nom)
                        @if($abonnements->id == $nom->type_abonnement_role->type_abonnement_id)
                            <h2 class="text-white font text-center mt-5"> Votre offre est {{$abonnements->nom_type}} </h2>
                        @endif
                    @endforeach
                @endforeach
            @endisset
            @isset($gratuit)
                <h2 class="text-white font text-center mt-5"> Votre offre est {{$gratuit}} </h2>
                @endisset

            <div class="row align-items-center justify-content-center">
                <div class="col-3 py-5">
                    <div class="form-control bg-light g-0 d-flex px-1 py-1 btn_ligne btn-outline-none">
                        <button class="btn mx-0 form-control btn_month"  onclick="month()" value="Mensuel" autofocus>Mensuel</button>&nbsp;
                        <button class="btn mx-0 form-control btn_month"  onclick="year()" value="Annuel">Annuel</button>
                    </div>
<script>
    $(document).on('load',function(load)){
        document.getElementById("mensuel").style.color = 'red';
});

</script>
                </div>
            </div>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
            <center>
            <div class="row d-flex flex-row flex-wrap justify-content-evenly">
                @isset($gratuit)
                    @foreach($offregratuit as $offre)
                        <div class="card_repeat bg-white">
                            <div class="py-3">
                                <button class="btn_premium">
                                    <h4>Gratuit</h4>
                                </button>
                                <br>
                                    <p><h1 class="gratuit">0 Ar</h1></p><br>


                                    <p class="th_color"> <i class="fal fa-check" style="font-size: 10px; padding: 4px; font-weight:bold;"></i>&nbsp;&nbsp; {{$offre->limite}} collaborations avec les {{$offre->type_abonne->abonne_name}}</p>

                                <p></p>
                            </div>
                        </div>
                    @endforeach
                @endisset
               @foreach ($typeAbonnement as $types)
                    @foreach ($tarif as $tf)
                        @if($tf->type_abonnement_role_id == $types->id)

                            <div class="card_repeat bg-white">
                                <div class="py-3">

                                    <button class="btn_premium">
                                        <h4>{{ $types->type_abonnement->nom_type }}</h4>
                                    </button>
                                    <br>
                                    <h1><input disabled value=" <?php echo number_format($tf->tarif, 2, ',', '.') ;  ?> Ar" style="text-align:center; border:none; width:300px; background-color:white;" id="prixMensuel"></h1><p></p>
                                    @foreach ($tarifAnnuel as $tfAnn)
                                        @if($tfAnn->type_abonnement_role_id == $types->id)
                                            <h1><input disabled value=" <?php echo number_format($tfAnn->tarif, 2, ',', '.') ;  ?> Ar" style="display:none;text-align:center; border:none; width:300px; background-color:white;" id="prixAnnuel"></h1><p></p>
                                        @endif
                                    @endforeach
                                        {{-- <p><h1>@php
                                            echo number_format($tf->tarif, 2, ',', '.');
                                        @endphp   Ar</h1></p><br> --}}

                                    <ul>
                                        <p> <i class="fal fa-check" style="font-size: 10px; padding: 4px; font-weight:bold;"></i>&nbsp;&nbsp; Collaboration illimité </p>
                                    </ul>
                                    <p></p>
                                    <button class="form-control btn_join" id="abonnerMensuel"> <a href="{{route('abonnement-page',['id'=>$tf->id])}}"> S'abonner  </a> &nbsp;&nbsp;  <i class="fal fa-arrow-right"></i> </button><br>

                                    @foreach ($tarifAnnuel as $tfAnn)
                                        @if($tfAnn->type_abonnement_role_id == $types->id)
                                            <button class="form-control btn_join" id="abonnerAnnuel" style="display: none"> <a href="{{route('abonnement-page',['id'=>$tfAnn->id])}}"> S'abonner  </a> &nbsp;&nbsp;  <i class="fal fa-arrow-right"></i> </button><br>
                                        @endif
                                    @endforeach


                                </div>
                            </div>
                        @endif
                    @endforeach
            @endforeach


            </div>

        </center>
    </div>

    <div class="col-md-1"></div>
</div>
<hr>
<br><br>
    </div>

</body>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
     function month()
        {
           document.getElementById('prixMensuel').style.display = "block";
            document.getElementById('abonnerMensuel').style.display = "block";
            document.getElementById('prixAnnuel').style.display = "none";
            document.getElementById('abonnerAnnuel').style.display = "none";

        }
        function year()
        {   document.getElementById('prixMensuel').style.display = "none";
            document.getElementById('abonnerMensuel').style.display = "none";
            document.getElementById('abonnerAnnuel').style.display = "block";
            document.getElementById('prixAnnuel').style.display = "block";
        }
</script>
</html>
@endsection
