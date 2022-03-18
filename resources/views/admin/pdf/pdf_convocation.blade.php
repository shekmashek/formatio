
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Details de la formation</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="d-flex">

            <img src="{{ public_path('img/logo_numerika/logonmrk.png') }}" alt="logonmk" class="logo">

        </div>
    </nav>


    <style type="text/css">

            .logo{
                width: 138px;
                height: 49px;
            }
            .logo-catalogue{
                width: 40px;
                height: 40px;
            }
            .hr-title-categorie{
                height:2px;
                border-width:0;
                color:rgb(108, 201, 218);
                background-color:rgb(108, 201, 218);
            }
            .navbar-pdf{
                background-color: black;
                color: white;
            }
            hr{
                background-color: black;
                border: 2px solid;
            }
    </style>



{{--  Ouverture de container --}}
<div class="container my-5">
    <h4>Details de la formation</h4>
    @foreach ($nom_module as $module)
        @foreach ($datas_details as $dt)
            <p>Lieu de la formation : {{$dt->lieu}} </p>
        @endforeach
        <p>Module : {{$module->nom_module}} </p>
        <p>Durée(heure) : {{$module->duree}}h </p>
        <p>Durée(jours) : {{$module->duree_jour}}jours </p>
        <p>Planning de formation: </p>
        <ul>
        @foreach ($datesHeureDetail as $dtheure)
            <li>{{$dtheure->date_detail}} : {{$dtheure->h_debut}}h - {{$dtheure->h_fin}}h  </li>
        @endforeach
        </ul>
    @endforeach


<h4>Compétences visés</h4>
    @foreach ($categories as $cat)

{{--  Ouverture derow --}}

    <div class="row">

{{--  Ouverture de col--}}

<div class="col-md-12">



@foreach ($nom_module as $dt)
@if ( $dt->formation_id == $cat->id )

<p> <strong>{{$cat->nom_formation}}</strong></p>

<div class="card" style="width: 18rem;">

    <ul>
        @foreach ($programmes as $programme)
        @if ($programme->module_id == $dt->id)

        <li>{{$programme->titre}}</li>

        @endif
        @endforeach

    </ul>
</div>

@endif
@endforeach

{{--  Fermeture de row et col --}}
        </div>
    </div>
{{-- </div> --}}

@endforeach
{{--  Fermeture de container --}}
</div>




<footer class="my-5 navbar-pdf bg-dark">

    <table class="table">


   <tr>
       <th>&copy;20{{date('y')}}</th>
       <th>contact@numerika.center</th>
       <th>0332313563</th>
       <th>www.numerika.center</th>
   </tr>
</table>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>
</html>
