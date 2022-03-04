<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    {{-- Lien font awesome icons --}}
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('../assets/css/smooth_page.css')}}">
    <link rel="stylesheet" href="{{ asset('maquette/style_maquette.css') }}">
    <script src="{{ asset('maquette/javascript.js') }}"></script>
    <link rel="shortcut icon" href="{{  asset('maquette/real_logo.ico') }}" type="image/x-icon">
    <title> Formation.mg </title>

    <style>
        body {
            height: 100vh;
        }

        .image-ronde {
            width: 30px;
            height: 30px;
            border: none;
            -moz-border-radius: 75px;
            -webkit-border-radius: 75px;
            border-radius: 75px;
        }

        .hover:hover {
            background-color: rgb(233, 220, 220);
            cursor: pointer;
        }

        .dashboard {
            position: absolute;
            top: 25%;
            width: 100%;
            align-items: center
        }

    </style>
</head>
<body>
    <button type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
        <i class="far fa-arrow-up"></i>
    </button>
    <header>
        <nav class="navbar_accueil fixed-top d-flex justify-content-between mb-5">
            <div class="left_menu ms-2">
                <p class="titre_text m-0 p-0"><img class="img-fluid" src="{{ asset('maquette/logo_fmg54Ko.png') }}" width="60px" height="60px"> Formation.mg</p>
            </div>
            <div class="right_menu d-flex justify-content-end align-items-center">
                <div class="child_right_menu">
                    <a href="{{url('contact')}}"><button class="btn_bordure_violet mx-2"><i class="fa fa-phone-alt"></i>&nbsp; Contactez-nous</button></a>
                </div>
                <div class="child_right_menu">
                    <a href="{{route('create+compte+client')}}"><button class="btn_bordure_violet mx-2"><i class="fa fa-layer-plus"></i>&nbsp; Créer un compte</button></a>
                </div>
                <div class="child_right_menu">
                    <button class="btn bouton_violet mx-2"><a href="{{ route('logout') }}"><i class="fa fa-sign-in-alt"></i>&nbsp; Déconnexion </a></button>
                </div>
            </div>
        </nav>
    </header>
    <main>

        <div class="row dashboard">
            <div class="row">
                <h2 class="text-center">Remplissez les informations manquantes</h2>
                @if (\Session::has('error'))
                <div class="alert alert-danger">
                    <ul>
                        <li>{!! \Session::get('error') !!}</li>
                    </ul>
                </div>
                @endif
            </div>
            <br>
            <div class="row ">
                <div class="container">
                    <div class="col-12">
                        <form action="{{route('remplir_info_stagiaire')}}" method="POST" class="w-50" style="margin-left: auto; margin-right: auto">
                            @csrf
                            <div class="form-control mb-5">
                                <p class="text-center">Informations générales</p>
                                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                                    <input type="text" name="id_stg" style="float: right;" value="{{$testNull[0]->id}}" hidden>
                                    @if ($testNull[0]->nom_stagiaire!=null)
                                    <p class="p-1 m-0" style="font-size: 10px;">NOM<span style="float: right;">{{$testNull[0]->nom_stagiaire}} {{$testNull[0]->prenom_stagiaire}} &nbsp;<i class="fas fa-angle-right"></i></span>
                                    </p>
                                    @else
                                    <p class="p-1 m-0" style="font-size: 10px;">NOM<input type="text" name="nom_stg" style="float: right;"></p>
                                    @endif
                                </div>
                                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                                    <input type="text" name="titre_stg" style="float: right;" value="{{$testNull[0]->titre}}" hidden>
                                    @if ($testNull[0]->titre!=null)
                                    <p class="p-1 m-0" style="font-size: 10px;">TITRE<span style="float: right;">{{$testNull[0]->titre}} &nbsp;<i class="fas fa-angle-right"></i></span>
                                    </p>
                                    @else
                                    <p class="p-1 m-0" style="font-size: 10px;">TITRE
                                        <select value="" name="titre_stg" class="" id="titre_stg" style="float: right;">
                                            <option value="Mr">Mr</option>
                                            <option value="Mme">Mme</option>
                                            <option value="Mme">Mlle</option>
                                        </select>
                                    </p>
                                    @endif
                                </div>
                                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                                    @if ($testNull[0]->date_naissance!=null)
                                    <p class="p-1 m-0" style="font-size: 10px;">DATE DE NAISSANCE<span style="float: right;">{{date('j \\ F Y', strtotime($testNull[0]->date_naissance))}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                    </p>
                                    @else
                                    <p class="p-1 m-0" style="font-size: 10px;">DATE DE NAISSANCE<input type="date" name="date_naissance_stg" style="float: right;"></p>
                                    @endif


                                </div>
                                <div class="hover" style="border-bottom: solid 1px #d399c2;">
                                    @if ($testNull[0]->genre_stagiaire!=null)
                                    <p class="p-1 m-0" style="font-size: 10px;">GENRE<span style="float: right;">{{$testNull[0]->genre_stagiaire}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                    </p>
                                    @else
                                    <p class="p-1 m-0" style="font-size: 10px;">GENRE
                                        <select value="" name="genre_stg" class="" style="float: right" id="genre">
                                            <option value="Homme">Homme</option>
                                            <option value="Femme">Femme</option>
                                        </select>
                                    </p>
                                    @endif
                                </div>

                                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                            </div>

                            <div class="form-control mb-5">
                                <p class="text-center">Coordonnées</p>


                                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                    @if ($testNull[0]->mail_stagiaire!=null)
                                    <p class="p-1 m-0" style="font-size: 10px;">ADRESSE E-MAIL<span style="float: right;">{{$testNull[0]->mail_stagiaire}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                    </p>
                                    @else
                                    <p class="p-1 m-0" style="font-size: 10px;">ADRESSE E-MAIL<input type="text" name="email_stg" style="float: right;"></p>
                                    @endif
                                </div>
                                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                    @if ($testNull[0]->telephone_stagiaire!=null)
                                    <p class="p-1 m-0" style="font-size: 10px;">TELEPHONE<span style="float: right;">{{$testNull[0]->telephone_stagiaire}}&nbsp;<i class="fas fa-angle-right"></i> </span>

                                    </p>
                                    @else
                                    <p class="p-1 m-0" style="font-size: 10px;">TELEPHONE<input type="text" name="tel_stg" style="float: right;"></p>
                                    @endif
                                </div>

                                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                    @if ($testNull[0]->cin!=null)
                                    <p class="p-1 m-0" style="font-size: 10px;">CIN<span style="float: right;">{{$testNull[0]->cin}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                    </p>
                                    @else
                                    <p class="p-1 m-0" style="font-size: 10px;">CIN<input type="text" name="cin_stg" style="float: right;"></p>
                                    @endif
                                </div>
                                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                    @if ($testNull[0]->lot!=null and $testNull[0]->quartier!=null and $testNull[0]->ville!=null and $testNull[0]->code_postal!=null and $testNull[0]->region!=null )
                                    <p class="p-1 m-0" style="font-size: 10px;">ADRESSE<span style="float: right;">{{$testNull[0]->lot}} &nbsp;{{$testNull[0]->quartier}} &nbsp;{{$testNull[0]->ville}} &nbsp;{{$testNull[0]->code_postal}}&nbsp;{{$testNull[0]->region}}&nbsp;<i class="fas fa-angle-right"></i></span>

                                    </p>
                                    @else
                                    @if($testNull[0]->lot==null)
                                    <p class="p-1 m-0" style="font-size: 10px;">LOT<input type="text" name="lot" style="float: right;"></p>
                                    @endif
                                    @if($testNull[0]->quartier==null)
                                    <p class="p-1 m-0" style="font-size: 10px;">QUARTIER<input type="text" name="quartier" style="float: right;"></p>
                                    @endif
                                    @if($testNull[0]->ville==null)
                                    <p class="p-1 m-0" style="font-size: 10px;">VILLE<input type="text" name="ville" style="float: right;"></p>
                                    @endif
                                    @if($testNull[0]->code_postal==null)
                                    <p class="p-1 m-0" style="font-size: 10px;">CODE POSTAL<input type="text" name="code_postal" style="float: right;"></p>
                                    @endif
                                    @if($testNull[0]->region==null)
                                    <p class="p-1 m-0" style="font-size: 10px;">REGION<input type="text" name="region" style="float: right;"></p>
                                    @endif
                                    @endif

                                </div>



                                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                            </div>



                            <div class="form-control">
                                <p class="text-center">Informations professionnelles</p>


                                <div style="border-bottom: solid 1px #d399c2;" class="">
                                    <p class="p-1 m-0" style="font-size: 10px;">ENTREPRISE<span style="float: right;">{{$entreprise[0]->nom_etp}} &nbsp;<i class="fas fa-angle-right"></i></span>
                                    </p>
                                </div>
                                <div style="border-bottom: solid 1px #d399c2;" class="hover">

                                    <p class="p-1 m-0" style="font-size: 10px;">FONCTION<span style="float: right;">{{$testNull[0]->fonction_stagiaire}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                    </p>

                                </div>
                                <div style="border-bottom: solid 1px #d399c2;" class="hover">
                                    @if($testNull[0]->niveau_etude!=null)
                                    <p class="p-1 m-0" style="font-size: 10px;">NIVEAU D'ETUDE<span style="float: right;">{{$testNull[0]->niveau_etude}}&nbsp;<i class="fas fa-angle-right"></i></span>
                                    </p>
                                    @else
                                    <p class="p-1 m-0" style="font-size: 10px;">NIVEAU D'ETUDE<input type="text" name="niveau_stg" style="float: right;"></p>
                                    @endif
                                </div>

                                <div id="columnchart_material_12" style="width: 200px; height: 30px;"></div>
                            </div><br>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </main>
    {{-- <footer class="footer_container" style="position:fixed; bottom:0; width:100%">
        <div class="container-fluid d-flex justify-content-center pt-3">
            <div class="bordure">&copy; Copyright 2022</div>
            <div class="bordure"><a href="{{url('info_legale')}}" style="color:#801D68 !important" target="_blank">Informations légales</a></div>
    <div><a href="{{url('contact')}}" class="bordure" style="color: #801D62;text-decoration:none" target="_blank">Contactez-nous</a></div>
    <div class="bordure">Politique de confidentialités</div>
    <div class="bordure"> <a href="{{route('condition_generale_de_vente')}}" style="color:#801D68 !important" target="_blank"> Condition d'utilisation</a> </div>
    <div class="bordure"> <a href="{{url('tarifs')}}" style="color:#801D68 !important" target="_blank"> Tarifs</a></div>
    <div class="bordure">Crédits</div>
    <div> &nbsp; Version 0.9</div>
    </div>
    </footer> --}}
</body>
