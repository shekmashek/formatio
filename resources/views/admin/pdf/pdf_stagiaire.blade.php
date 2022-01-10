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

        .logo {
            width: 138px;
            height: 49px;
        }

        .logo-catalogue {
            width: 40px;
            height: 40px;
        }

        .pdf {
            width: 60px;
            height: 60px;
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

    <h4>Liste(s) de(s) Stagiaire(s)</h4>
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

                <h4 class="mb-3">Stagiaires(s):</h4>

                @foreach ($stagiaires as $stagiaire)
                @if ($entreprise->id == $stagiaire->entreprise_id)

                <p><img src="{{ public_path('images/stagiaires/'.$stagiaire->photos) }}" alt="profil" class="pdf"> <strong>{{$stagiaire->nom_stagiaire}}</strong> {{$stagiaire->prenom_stagiaire}}</p>

                <div class="card my-2" style="width: auto;">
                    <ul>
                        <li>matricule : <strong>{{$stagiaire->matricule}}</strong></li>
                        <li>fonction : {{$stagiaire->fonction_stagiaire}}</li>
                        <li>sexe: <strong>{{$stagiaire->genre_stagiaire}}</strong></li>
                        <li>email: <a href="#">{{$stagiaire->mail_stagiaire}}</a></li>
                        <li>tél: {{$stagiaire->telephone_stagiaire}}</li>
                    </ul>
                </div>

                @endif
                @endforeach

                {{-- Fermeture de row et col --}}
            </div>
        </div>
        {{-- </div> --}}

        <?php $id+=1; ?>
        <hr>
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
