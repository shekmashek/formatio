<?php $id=1; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Login</title>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="d-flex">

            <img src="{{ public_path('img/logo_formation/logo_transparent_background.png') }}" alt="logonmk" class="logo">

        </div>
    </nav>


    <style type="text/css">
        /* h1 {

            font-size: 80%;
            }
            h2 {

            font-size: 80%;
            } */
        h3 {

            font-size: 15px;
        }

        h4 {

            /* font-size: 90%; */
            font-size: 15px;
        }

        h5 {

            font-size: 10px;
        }

        h6 {

            font-size: 10px;
        }

        p {

            font-size: 80%;
        }

        .logo {
            width: 138px;
            height: 49px;
        }

        .logo-catalogue {
            width: 40px;
            height: 40px;
        }

        .hr-title-categorie {
            height: 2px;
            border-width: 0;
            color: rgb(108, 201, 218);
            background-color: rgb(108, 201, 218);
        }

        .navbar-pdf {
            background-color: black;
            color: white;
        }

        hr {
            background-color: black;
            border: 2px solid;
        }

    </style>

    <h3>Liste(s) de(s) Responsable(s)</h3>

    {{-- Ouverture de container --}}
    <div class="container my-5">

        @foreach ($entreprises as $entreprise)

        {{-- Ouverture derow --}}

        <div class="row">

            {{-- Ouverture de col--}}

            <div class="col-md-12">

                <div class="navbar-brand">
                    <h4> <img src="{{ public_path('images/entreprises/'.$entreprise->logo) }}" alt="logo-{{$entreprise->nom_etp}}" class="logo">{{$entreprise->nom_etp}}
                        ({{$entreprise->adresse}})
                    </h4>
                </div>

                <h4>Responsable(s):</h4>

                @foreach ($responsables as $responsable)
                @if ($entreprise->id == $responsable->entreprise_id)

                <p><strong>{{$responsable->nom_resp}}</strong> {{$responsable->prenom_resp}}</p>

                <div class="card my-2" style="width: auto;">
                    <ul>
                        <li>fonction : <strong>{{$responsable->fonction_resp}}</strong></li>
                        <li>email: <a href="#">{{$responsable->email_resp}}</a></li>
                        <li>tél: {{$responsable->telephone_resp}}</li>
                    </ul>
                </div>

                @endif
                @endforeach

                {{-- Fermeture de row et col --}}
            </div>
        </div>
        {{-- </div> --}}

        <hr>
        <?php $id+=1; ?>
        @endforeach

        {{-- Fermeture de container --}}
    </div>


    <footer class="my-5 navbar-pdf bg-dark">

        <table class="table" width="auto">
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
