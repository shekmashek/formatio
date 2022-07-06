<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formation.mg</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/create_compte.css')}}">
</head>
<body>
    <div class="header">

        <div class="inner-header flex">
            <div class="titre">
                <div class="row">
                    <h3 style="margin-top:-40px;font-weight: lighter;">Inscrivez votre organisme de formation ou votre
                        entreprise gratuitement sur notre plateforme</h3>
                    <div class="col-md-5 contenue mt-5" style="margin-left: 9%">
                        <h1 class=""> <a href="{{route('create+compte+client/employeur')}}"><span>E</span>ntreprise</a>
                        </h1>
                    </div>
                    <div class="col-md-5 contenue mt-5" style="margin-left: 2px">
                        <h1> <a href="{{route('create+compte+client/OF')}}"><span>O</span>rganisme de
                                <span>f</span>ormation</a></h1>
                    </div>
                </div>
            </div>
        </div>

        <!--Waves Container-->
        <div>
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave"
                        d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                </g>
            </svg>
        </div>
        <!--Waves end-->

    </div>
    <!--Header ends-->

    <!--Content starts-->
    <div class="content flex">
        <p style="font-size: 30px">Formation.mg / <a href="/" style="text-decoration: none">revenir à l'acceuil</a>
        </p>
    </div>
    <!--Content ends-->
</body>

</html>