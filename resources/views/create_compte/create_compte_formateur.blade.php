<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="{{  asset('maquette/real_logo.ico') }}" type="image/x-icon">
    <title> formation.mg </title>

    <link rel="stylesheet" href="{{asset('css/profil_formateur.css')}}">
    <link href="{{asset('bootstrapCss/css/bootstrap.min.css')}} " rel="stylesheet">
    <link href="{{asset('assets/css/boxicons.min.css')}} " rel="stylesheet">
    <link href="{{asset('assets/css/chart_et_font.css')}}" rel="stylesheet">
    <link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{asset('../assets/css/smooth_page.css')}}">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{asset('../assets/css/smooth_page.css')}}">
    <link rel="stylesheet" href="{{ asset('maquette/style_maquette.css') }}">
    <script src="{{ asset('maquette/javascript.js') }}"></script>

</head>
<body>
    <button type="button" class="btn btn-floating btn-lg" id="btn-back-to-top">
        <i class="far fa-arrow-up"></i>
    </button>
    <header>
        <nav class="navbar_accueil fixed-top d-flex justify-content-between">
            <div class="left_menu ms-2">
                <p class="titre_text m-0 p-0"><img class="img-fluid" src="{{ asset('maquette/logo_fmg54Ko.png') }}" width="60px" height="60px"> Formation.mg</p>
            </div>
            <div class="right_menu d-flex justify-content-end align-items-center">
                <div class="child_right_menu">
                    <button class="btn_bordure_violet mx-2"><i class="fa fa-phone-alt"></i>&nbsp; Contactez-nous</button>
                </div>
                <div class="child_right_menu">
                    <button class="btn_bordure_violet mx-2"><i class="fa fa-layer-plus"></i>&nbsp; Créer un compte</button>
                </div>
                <div class="child_right_menu">
                    <button class="btn bouton_violet mx-2"><a href="{{ route('sign-in') }}"><i class="fa fa-sign-in-alt"></i>&nbsp; Connexion </a></button>
                </div>
            </div>
        </nav>
    </header>


    {{-- <div id="page-wrapper"> --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 mt-5">
                <h2>Creation de nouveau compte de Formateur</h2>
            </div>

        </div>

        <div class="row">
            <div class="col-lg-12">

                @canany(['isCFP'])
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif
                @endcanany
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="container-lg">
                            <div class="row bg-light">
                                <form name="formInsert" id="formInsert" action="{{route('formateur.store')}}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();" class="form_insert_formateur">
                                    @csrf



                                    <h1>Profil Formateur</h1>

                                    <div class="row">
                                        <div class="col">
                                            <input type="file" class="form-control" name="image" id="image" placeholder="fichier" title="veuillez choisir une image" required>
                                            @error('image')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" name="nom" id="nom" placeholder="Nom" class="form-control" pattern="[A-Za-z' -]{1,100}" title="5 à 100 caractères" required>
                                            @error('nom')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;" class="error" id="errorname"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <input type="text" name="prenom" id="prenom" placeholder="Prenom" class="form-control" title="1 à 255 caractères">
                                            @error('prenom')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <select name="sexe" id="sexe" class="form-control">
                                                <option value="null" disabled selected hidden>Sexe</option>
                                                <option value="homme">Homme</option>
                                                <option value="femme">Femme</option>
                                            </select>
                                            @error('sexe')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="adresse" id="adresse" pattern="[A-Za-z0-9.&' -/]{1,255}" title="5 à 255 caractères" placeholder="Adresse" required>
                                            @error('adresse')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="date_naissance" id="date" placeholder="Date de naissance" onfocus="(this.type='date')" required>
                                            @error('date_naissance')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <input type="mail" class="form-control" name="mail" id="mail" pattern="[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]" title="entre votre adresse mail" placeholder="example@gmail.com" required>
                                            @error('mail')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <input type="tel" class="form-control" name="phone" id="phone" minlength="10" maxlength="10" placeholder="Téléphone" pattern="[0-9]{10}" title="entrer une numero de 10 chiffres sans lettre ni caractères spéciaux" required>
                                            @error('phone')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <input type="tel" class="form-control" name="cin" id="cin" minlength="12" maxlength="12" placeholder="Numero de CIN" pattern="[0-9]{12}" title="entre un numero de 12 chiffres sans lettres ni caractères spéciaux" required>
                                            @error('cin')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="specialite" id="specialite" pattern="[A-Za-z' -]{1,50}" title="5 à 50 caractères" placeholder="Spécialité" required>
                                            @error('niveau')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="niveau" id="niveau" pattern="[A-Za-z0-9+' -]{1,50}" title="5 à 50 caractères" placeholder="Niveau d'étude" required>
                                            @error('specialite')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <h3 align="center" class="mb-3">Information CV du Formateur</h3>

                                    <div class="row mt-1">
                                        <h1>Domaine* et Competence *</h1>

                                        {{-- <div class="col"> --}}
                                        <div class="row mt-1">

                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="domaine[]" id="domaine" pattern="[A-Za-z' -]{1,50}" title="5 à 50 caractères" placeholder="Domaine" class="domaine" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-5">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="competences[]" id="competences" pattern="[A-Za-z0-9&@+' ,-]{1,255}" title="5 à 255 caractères" placeholder="competences" class="domaine" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-2 mt-3" align="center">
                                                <button id="addRow1" class="form-control btn btn-warning envoyer" type="button"><i class="fa fa-plus" style="font-size: 15px"></i></button>
                                            </div>
                                            <div id="newRow1"></div>
                                        </div>

                                    </div>

                                    <div class="row mt-1">
                                        <h1 class="text-center">Expériences Professionnelles</h1>
                                        <div class="col-lg-12">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="entreprise[]" pattern="[A-Za-z0-9.@&' -/]{1,50}" title="5 à 50 caractères" id="entreprise" placeholder="Nom entreprise" class="domaine" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="poste[]" id="poste" pattern="[A-Za-z0-9' ,-/]{1,100}" title="5 à 100 caractères" placeholder="Poste occupé" class="domaine" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="taches[]" id="taches" pattern="[A-Za-z0-9' ,-/]{1,100}" title="5 à 100 caractères" placeholder="Description des tâches faites dans l'entreprise" class="domaine" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="date_debut[]" id="date_debut" class="domaine" placeholder="Date de début du travail" onfocus="(this.type='date')" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="date_fin[]" id="date_fin" class="domaine" placeholder="Date de fin du travail" onfocus="(this.type='date')" required>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 mt-3" align="center">
                                                    <div class="form-group">
                                                        <button id="addRow2" type="button" class="btn btn-warning envoyer"><i class="fa fa-plus" style="font-size: 15px;"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="newRow2"></div>


                                    </div>



                                    <div class="row">
                                        <div class="col-lg-12 mt-5 mb-5" align="center">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-warning btn-lg text-white envoyer" value="Envoyer le profil">
                                            </div>
                                        </div>
                                    </div>



                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- </div> --}}


    <footer class="footer_container">

        <div class="d-flex justify-content-center pt-3">
            <div class="bordure">&copy; Copyright 2022</div>
            <div class="bordure">Informations légales</div>
            <div class="bordure">Contactez-nous</div>
            <div class="bordure">Politique de confidentialités</div>
            <div class="bordure">Condition d'utilisation</div>
            <div class="bordure">Tarifs</div>
            <div class="bordure">Crédits</div>
            <div> &nbsp; Version 0.9</div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    {{-- <script src="{{asset('assets/js/bootstrap.min.js')}}"></script> --}}
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <script type="text/javascript">
        let mybutton = document.getElementById("btn-back-to-top");
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            if (
                document.body.scrollTop > 300 ||
                document.documentElement.scrollTop > 300
            ) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }
        mybutton.addEventListener("click", backToTop);

        function backToTop() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }


        //add row1
        $(document).on('click', '#addRow1', function() {
            var html = '';
            html += '<div class="row" id="inputFormRow1">';
            html += '<div class="col-lg-5">';
            html += '<div class="form-group">';
            html += '<input type="text" class="form-control" name="domaine[]" id="domaine" title="5 à 50 caractères" placeholder="Domaine" class="domaine" required>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-lg-5">';
            html += '<div class="form-group">';
            html += '<input type="text" class="form-control" name="competences[]" id="competences" title="5 à 255 caractères" placeholder="competences" class="domaine" required>';
            html += '</div>';
            html += '</div>';
            html += '<div class="col-lg-2 mt-3" align="center">';
            html += '<button id="removeRow1" type="button" class="btn btn-danger envoyer"><i class="fa fa-close style="font-size: 15px;"></i></button>';
            html += '</div>';
            html += '</div>';

            $('#newRow1').append(html);
        });

        // remove row1
        $(document).on('click', '#removeRow1', function() {
            $(this).closest('#inputFormRow1').remove();
        });

        //add row2

        $(document).on('click', '#addRow2', function() {
            var html2 = '';
            html2 += '<div class="row"id="inputFormRow2">';
            html2 += '<div class="col-lg-12">';

            html2 += '<div class="row">';
            html2 += '<div class="col-lg-4">';
            html2 += '<div class="form-group">';
            html2 += '<input type="text" class="form-control" name="entreprise[]" id="entreprise" title="5 à 50 caractères" placeholder="Nom entreprise" class="domaine" required>';
            html2 += '</div>';
            html2 += '</div>';
            html2 += '<div class="col-lg-4">';
            html2 += '<div class="form-group">';
            html2 += '<input type="text" class="form-control" name="poste[]" id="poste" title="5 à 100 caractères" placeholder="Poste occupé" class="domaine" required>';
            html2 += '</div>';
            html2 += '</div>';
            html2 += '<div class="col-lg-4">';
            html2 += '<div class="form-group">';
            html2 += '<input type="text" class="form-control"name="taches[]" id="taches" title="5 à 100 caractères" placeholder="Tâches effectuer dans l&apos;entreprise" class="domaine" required>';
            html2 += '</div>';
            html2 += '</div>';
            html2 += '</div>';

            html2 += '<div class="row">';
            html2 += '<div class="col-lg-4">';
            html2 += '<div class="form-group">';
            html2 += '<input type="date" class="form-control" name="date_debut[]" id="date_debut" class="domaine" placeholder="Date de début du travail" required>';
            html2 += '</div>';
            html2 += '</div>';
            html2 += '<div class="col-lg-4">';
            html2 += '<div class="form-group">';
            html2 += '<input type="date" class="form-control" name="date_fin[]" id="date_fin" class="domaine" placeholder="Date de fin du travail" required>';
            html2 += '</div>';
            html2 += '</div>';
            html2 += '<div class="col-lg-4 mt-3" align="center">';
            html2 += '<div class="form-group">';
            html2 += '<button id="removeRow2" type="button" class="btn btn-danger envoyer"><i class="fa fa-close style="font-size: 15px;" ></i></button>';
            html2 += '</div>';
            html2 += '</div>';
            html2 += '</div>';

            html2 += '</div>';
            html2 += '</div>';

            $('#newRow2').append(html2);
        });

        // remove row1
        $(document).on('click', '#removeRow2', function() {
            $(this).closest('#inputFormRow2').remove();
        });

    </script>

</body>
</html>
