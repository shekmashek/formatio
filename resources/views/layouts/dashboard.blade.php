@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
{{-- <link rel="stylesheet" href="ttps://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"> --}}
    {{-- <style>
        /* .nav-tabs .nav-link{
            background-image:linear-gradient(60deg, #AA076B 40%, #61045F)
            /* color: white;
        } */

        #myTab{
            background-color: white;
        }

        .nav-link{
            color: black;

        }

        .nav-link:hover{
            color: black;
            background-color: #f2f2f2;
        }


        .navigation .nav-item{
            background-image: none;
            color: white;
            background-color: white ;
        }

        .navigation{
            background-color: #f8f9fa;
            /* background-image:linear-gradient(100deg, #AA076B, #61045F) */
        }

        .navigation:hover{
            background-color: #dde0e2;
            border-block-color: none;
            /* background-color: #801D68; */
        }

        .system_{
            text-align: left;
            border: none;
            border-bottom: 1px solid #c22d9d;
        }
        .system_num{
            text-align: right;
            color: #801d68;
            font-size: 20px;
            border-radius: 10px;
            float: right;
            position: relative;
            bottom: .5rem;
        }

        .system_numero{
            text-align: right;
            color: white;
            background-color: #9d207d;
            border: none;
            border-radius: 5px;
            float: right;
            padding-left: 5px;
            padding-right: 5px
        }


        .system_numeroAlert{
            text-align: right;
            color: white;
            background-color: #d32727;
            border: none;
            border-radius: 5px;
            float: right;
            padding-left: 5px;
            padding-right: 5px
        }


        .system_numeroSuccess{
            text-align: right;
            color: white;
            background-color: #25d315;
            border: none;
            border-radius: 5px;
            float: right;
            padding-left: 5px;
            padding-right: 5px
        }
    </style> --}}



    <style>
        .nav .btn{
            background-color: #f7f7f7;
            border: none;
        }

        .nav .btn:hover{
            background-color: #dddddd;
            border: none;
        }

        .nav .a{
            background-color: #dddddd;
            color: #801D68;
        }


        .system_{
            text-align: left;
            border: none;
            border-bottom: 1px solid #c22d9d;
        }
        .system_num{
            text-align: right;
            color: #801d68;
            font-size: 20px;
            border-radius: 10px;
            float: right;
            position: relative;
            bottom: .5rem;
        }

        .system_numero{
            text-align: right;
            color: white;
            background-color: #9d207d;
            border: none;
            border-radius: 5px;
            float: right;
            padding-left: 5px;
            padding-right: 5px
        }


        .system_numeroAlert{
            text-align: right;
            color: white;
            background-color: #d32727;
            border: none;
            border-radius: 5px;
            float: right;
            padding-left: 5px;
            padding-right: 5px
        }


        .system_numeroSuccess{
            text-align: right;
            color: white;
            background-color: #25d315;
            border: none;
            border-radius: 5px;
            float: right;
            padding-left: 5px;
            padding-right: 5px
        }
    </style>

<div class=" p-0 m-0 nav d-flex flex-row navigation justify-content-end" style="font-size: 10px;">
        <a href="{{ route('home') }}" type="button" class="btn a active" style="font-size: 12px;"> <i class="fad fa-sliders-v" style="font-size: 10px;"></i>&nbsp;TDB système</a>
        <a href="{{ route('hometdbf')}}" type="button" class="btn  me-2 ms-2" style="font-size: 12px;"><i class="far fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB financier</a>
        <a href="{{ route('hometdbq')}}" type="button" class="btn " style="font-size: 12px;"> <i class="fad fa-chart-bar" style="font-size: 10px;"></i>&nbsp;TDB qualité</a>
</div>


<div class="p-1 m-0">
    <div class="container-fluid" style="font-size: 10px;">
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fad fa-users "></i>&nbsp; Collaborateur </b>
                    <p class=" m-1 system_ pb-1">Formateurs<span class="system_numero">0</span></p>
                    <p class="m-1 system_ pb-1">Entreprise<span class="system_numero">7</span></p>
                    <p class="m-1 system_ pb-1">Réferents<span class="system_numero">0</span></p>
                    <p class="m-1 system_ pb-1">Manager<span class="system_numero">0</span></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="far fa-book-spells"></i> &nbsp; Catalogue </b>
                    <p class="m-1 system_ pb-1">Publié<span class="system_numero">5</span></p>
                    <p class="m-1 system_ pb-1">En cours de création<span class="system_numero">10</span></p>
                    <p class="m-1 system_ pb-1">Programme incomplète<span class="system_numero">70</span></p>
                    <p class="m-1 system_ pb-1">Compétence incomplète<span class="system_numero">70</span></p>
                    <p class="m-1 system_ pb-1">Archiver<span class="system_numero">70</span></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fad fa-address-card"></i>&nbsp; Facture </b>
                    <p class=" m-1 system_ pb-1">Payé<span class="system_numero">3</span></p>
                    <p class="m-1 system_ pb-1">Non échu<span class="system_numero">7</span></p>
                    <p class="m-1 system_ pb-1">Echu non payé<span class="system_numero">0</span></p>
                    <p class="m-1 system_ pb-1">Payement partiel<span class="system_numero">0</span></p>
                    <p class="m-1 system_ pb-1">Brouillon<span class="system_numero">0</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="font-size: 10px;">
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fas fa-tasks"></i> &nbsp; Session Inter entreprise </b>
                    <p class="p-0 m-1 system_ pb-1">Complété<span class="system_numero">3</span></p>
                    <p class="m-1 system_ pb-1">En cours<span class="system_numero">7</span></p>
                    <p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">0</span></p>
                    <p class="m-1 system_ pb-1">A venir<span class="system_numero">0</span></p>
                    <p class="m-1 system_ pb-1">Annuler<span class="system_numero">0</span></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fas fa-tasks"></i>&nbsp; Session Intra enreprise </b>
                    <p class="p-0 m-1 system_ pb-1">Complété<span class="system_numero">3</span></p>
                    <p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">0</span></p>
                    <p class="m-1 system_ pb-1">En cours<span class="system_numero">0</span></p>
                    <p class="m-1 system_ pb-1">A venir<span class="system_numero">10</span></p>
                    <p class="m-1 system_ pb-1">Annuler<span class="system_numero">0</span></p>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fal fa-building"></i> &nbsp; Profil de l'organisation (Numerika) </b>
                    <p class="p-0 m-1 system_ pb-1">Adresse<span class="system_numeroAlert">Incomplet</span></p>
                    <p class="m-1 system_ pb-1">Information légale<span class="system_numeroSuccess">complet</span></p>
                    <p class="m-1 system_ pb-1">Type d'abonnement<span class="system_numero">Gratuit</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid" style="font-size: 10px;">
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b><i class="far fa-user-cog"></i>&nbsp; Profil de l'utilisateur (Urluc) </b>
                    <p class="p-0 m-1 system_ pb-1">Informations générales<span class="system_numeroAlert">Incomplet</span></p>
                    <p class="m-1 system_ pb-1">Coordonnées<span class="system_numeroSuccess">Complet</span></p>
                    <p class="m-1 system_ pb-1">Informations professionnelles<span class="system_numeroAlert">Incomplet</span></p>
                </div>
            </div>
        </div>
    </div>
</div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection
