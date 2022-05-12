@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Nouveau formateur</p>
@endsection
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        {{-- <div class="row">
            <div class="col-lg-12">
                <br>
                <h3>Nouveau Formateur</h3>
            </div>


            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_formateur') || Route::currentRouteNamed('liste_formateur') ? 'active' : '' }}" href="{{route('liste_formateur')}}">
                                    <button class="btn btn_enregistrer">Formateurs</button></a>
                            </li>

                            <li class="nav-item">

                                <a class="nav-link  {{ Route::currentRouteNamed('nouveau_formateur') ? 'active' : '' }}" aria-current="page" href="{{route('nouveau_formateur')}}">
                                    <button class="btn btn_enregistrer">Nouveau Formateur</button></a>

                            </li>

                        </ul>

                    </div>
                </div>
            </nav>

        </div> --}}

        <div class="row mt-3">
            <div class="col-lg-12">
                @canany(['isCFP'])
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
                @endif
                 {{-- si l'utiliisateur a  choisir un fichier > 60Ko--}}
                @if (\Session::has('erreur_photo'))
                <div class="alert alert-danger col-md-4">
                    <ul>
                        <li>{!! \Session::get('erreur_photo') !!}</li>
                    </ul>
                </div>
                @endif
                @endcanany
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="container-lg">
                            <div class="row bg-light">
                                <form name="formInsert" id="formInsert" action="{{route('formateur.store')}}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();" class="form_insert_formateur">
                                    @csrf

                                    <p style="font-size: 15px;">Profil Formateur</p>

                                    <div class="form-control-file mt-2">
                                        <input type="file" class="form-control" name="image" id="image" placeholder="fichier" title="veuillez choisir une image" required>
                                        {{-- <strong>Taille du fichier: 60Ko max</strong> --}}
                                    </div><br>
                                    @error('image')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror

                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <input type="text" name="nom" id="nom" placeholder="Nom*" class="form-control" pattern="[A-Za-z' -]{1,100}" title="5 à 100 caractères" required>
                                            </div>
                                            @error('nom')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;" class="error" id="errorname"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-7">
                                            <div class="form-group">
                                                <input type="text" name="prenom" id="prenom" placeholder="Prenom*" class="form-control"  title="1 à 255 caractères">
                                            </div>
                                            @error('prenom')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="select-group">
                                                <select name="sexe" id="sexe" class="form-control">
                                                    <option value="null" disabled selected hidden>Sexe</option>
                                                    <option value="homme">Homme</option>
                                                    <option value="femme">Femme</option>
                                                </select>
                                            </div>
                                            @error('sexe')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="date_naissance" id="date" placeholder="Date de naissance*" onfocus="(this.type='date')" required>
                                            </div>
                                            @error('date_naissance')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="adresse" id="adresse" pattern="[A-Za-z0-9.&' -/]{1,255}" title="5 à 255 caractères" placeholder="Adresse Lot ou Rue*" required>
                                            </div>
                                            @error('adresse')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">

                                            <div class="form-group">
                                                <input type="mail" class="form-control" name="mail" id="mail" pattern="[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]" title="entre votre adresse mail" placeholder="adresse e-mail*" required>
                                                <span style="color:#ff0000;" id="mail_err"></span>
                                            </div>
                                            @error('mail')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="tel" class="form-control" name="phone" id="phone" minlength="10" maxlength="10" placeholder="Téléphone*" pattern="[0-9]{10}" title="entrer une numero de 10 chiffres sans lettre ni caractères spéciaux" required>
                                                <span style="color:#ff0000;" id="phone_err"></span>
                                            </div>
                                            @error('phone')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="tel" class="form-control" name="cin" id="cin" minlength="12" maxlength="12" placeholder="Numero de CIN*" pattern="[0-9]{12}" title="entre un numero de 12 chiffres sans lettres ni caractères spéciaux" required>
                                                <span style="color:#ff0000;" id="cin_err"></span>
                                            </div>
                                            @error('cin')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="specialite" id="specialite" pattern="[A-Za-z' -]{1,50}" title="5 à 50 caractères" placeholder="Spécialité*" required>
                                            </div>
                                            @error('niveau')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="niveau" id="niveau" pattern="[A-Za-z0-9+' -]{1,50}" title="5 à 50 caractères" placeholder="Niveau d'étude*" required>
                                            </div>
                                        </div>
                                        @error('specialite')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                    </div>


                                    <h1>Domaine et Competence</h1>

                                    <div class="row mt-2">
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="domaine[]" id="domaine" pattern="[A-Za-z' -]{1,50}" title="5 à 50 caractères" placeholder="Ex:Bureautique,Communication,Développement Informatique..." class="domaine" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-5">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="competences[]" id="competences" pattern="[A-Za-z0-9&@+' ,-]{1,255}" title="5 à 255 caractères" placeholder="Ex:Ms Excel,communication interpersonnelle,HTML..." class="domaine" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 mt-3" align="center">
                                            <button id="addRow1" class="form-control btn btn-warning envoyer" type="button"><i class="fa fa-plus" style="font-size: 15px"></i></button>
                                        </div>
                                        <div id="newRow1"></div>
                                    </div>


                                    <div class="row mt-4">
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
                                                        <input type="text" class="form-control" name="date_debut[]" id="date_debut" class="domaine" placeholder="Date de début du travail" onfocus="(this.type='date')" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="date_fin[]" id="date_fin" class="domaine" placeholder="Date de fin du travail" onfocus="(this.type='date')" >
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
</div>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script type="text/javascript">


$(document).on('change', '#cin', function() {
        var result = $(this).val();
        $.ajax({
            url: '{{route("verify_cin_user")}}'
            , type: 'get'
            , data: {
                valiny: result
            }
            , success: function(response) {
                var userData = response;

                if (userData.length > 0) {
                    document.getElementById("cin_err").innerHTML = "CIN appartient déjà par un autre utilisateur";
                } else {
                    document.getElementById("cin_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).on('change', '#mail', function() {
        var result = $(this).val();
        $.ajax({
            url: '{{route("verify_mail_user")}}'
            , type: 'get'
            , data: {
                valiny: result
            }
            , success: function(response) {
                var userData = response;

                if (userData.length > 0) {
                    document.getElementById("mail_err").innerHTML = "mail existe déjà";
                } else {
                    document.getElementById("mail_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });

    $(document).on('change', '#phone', function() {
        var result = $(this).val();
        $.ajax({
            url: '{{route("verify_tel_user")}}'
            , type: 'get'
            , data: {
                valiny: result
            }
            , success: function(response) {
                var userData = response;

                if (userData.length > 0) {
                    document.getElementById("phone_err").innerHTML = "Télephone existes déjà";
                } else {
                    document.getElementById("phone_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });


    //add row1
    $(document).on('click', '#addRow1', function() {
        var html = '';
        html += '<div class="row" id="inputFormRow1">';
        html += '<div class="col-lg-5">';
        html += '<div class="form-group">';
        html += '<input type="text" class="form-control" name="domaine[]" id="domaine" title="5 à 50 caractères" placeholder="Ex:Bureautique,Communication,Développement Informatique..." class="domaine" required>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-lg-5">';
        html += '<div class="form-group">';
        html += '<input type="text" class="form-control" name="competences[]" id="competences" title="5 à 255 caractères" placeholder="Ex:Ms Excel,communication interpersonnelle,HTML..." class="domaine" required>';
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
        html2 += '<input type="date" class="form-control" name="date_debut[]" id="date_debut" class="domaine" placeholder="Date de début du travail" >';
        html2 += '</div>';
        html2 += '</div>';
        html2 += '<div class="col-lg-4">';
        html2 += '<div class="form-group">';
        html2 += '<input type="date" class="form-control" name="date_fin[]" id="date_fin" class="domaine" placeholder="Date de fin du travail" >';
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
@endsection
