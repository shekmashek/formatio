@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <h3>Nouveau Formation</h3>
            </div>


            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('utilisateur_formateur') || Route::currentRouteNamed('utilisateur_formateur') ? 'active' : '' }}" href="{{route('utilisateur_formateur')}}">
                                    <i class="fa fa-list">Formateurs</i></a>
                            </li>

                            <li class="nav-item">

                                <a class="nav-link  {{ Route::currentRouteNamed('nouveau_formateur') ? 'active' : '' }}" aria-current="page" href="{{route('nouveau_formateur')}}">
                                    <i class="fa fa-plus">Nouveau Formateur</i></a>

                            </li>

                        </ul>
{{-- q --}}

                    </div>
                </div>
            </nav>

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
                                    <div class="row">
                                        <div class="col-lg-6 ">
                                            <h1>Profil Formateur</h1>
                                            <div class="form-group">
                                                <input type="text" name="nom" id="nom" placeholder="Nom" class="form-control" pattern="[A-Za-z' -]{1,100}" title="5 à 100 caractères" required>
                                            </div>
                                            @error('nom')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;" class="error" id="errorname"> {{$message}} </span>
                                            </div>
                                            @enderror
                                            <div class="form-group">
                                                <input type="text" name="prenom" id="prenom" placeholder="Prenom" class="form-control" pattern="[A-Za-z' -]{0,255}" title="5 à 255 caractères">
                                            </div>
                                            @error('prenom')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                            <div class="select-group">
                                                <select name="sexe" id="sexe" class="form-control">
                                                    <option value="null" disabled selected hidden>Sexe</option>
                                                    <option value="homme">Homme</option>
                                                    <option value="femme">Femme</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="adresse" id="adresse" pattern="[A-Za-z0-9.&' -/]{1,255}" title="5 à 255 caractères" placeholder="Adresse" required>
                                            </div>
                                            @error('adresse')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                            @error('sexe')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="date_naissance" id="date" placeholder="Date de naissance" onfocus="(this.type='date')" required>
                                            </div>
                                            @error('date_naissance')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror

                                            <div class="form-group">
                                                <input type="mail" class="form-control" name="mail" id="mail" pattern="[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]" title="entre votre adresse mail" placeholder="example@gmail.com" required>
                                            </div>
                                            @error('mail')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                            <div class="form-group">
                                                <input type="tel" class="form-control" name="phone" id="phone" minlength="10" maxlength="10" placeholder="Téléphone" pattern="[0-9]{10}" title="entrer une numero de 10 chiffres sans lettre ni caractères spéciaux" required>
                                            </div>
                                            @error('phone')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                            <div class="form-group">
                                                <input type="tel" class="form-control" name="cin" id="cin" minlength="12" maxlength="12" placeholder="Numero de CIN" pattern="[0-9]{12}" title="entre un numero de 12 chiffres sans lettres ni caractères spéciaux" required>
                                            </div>
                                            @error('cin')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="specialite" id="specialite" pattern="[A-Za-z' -]{1,50}" title="5 à 50 caractères" placeholder="Spécialité" required>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="niveau" id="niveau" pattern="[A-Za-z0-9+' -]{1,50}" title="5 à 50 caractères" placeholder="Niveau d'étude" required>
                                            </div>
                                            @error('niveau')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                            @error('specialite')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror


                                            <div class="form-control-file">
                                                <input type="file" class="form-control" name="image" id="image" placeholder="fichier" title="veuillez choisir une image" required>
                                            </div>
                                            @error('image')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        {{-- ligne pour le domaine et les competences du formateur --}}
                                        <div class="col-lg-6">
                                            <div class="row mt-1">
                                                <h1>Domaine et Competence</h1>
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
                                                        <input type="text" class="form-control" name="taches[]" id="taches" pattern="[A-Za-z0-9' ,-/]{1,100}" title="5 à 100 caractères" placeholder="Tâches faites dans l'entreprise" class="domaine" required>
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
</div>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script type="text/javascript">
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

    //validation formulaire
    // function valider(){

    //     var nom = document.getElementById("nom").value;

    //     if (nom != "") {
    //         return true;
    //         document.getElementById("formInsert").submit();
    //     }else{
    //         document.getElementById("nom").focus();
    //         alert("Veuillez remplir le champ nom!");
    //     }

    // function validateForm() {
    //     var nom = document.forms["formInsert"]["nom"];
    //     if (nom.value == "") {
    //         document.getElementById("errorname").innerHTML="Veuillez entrez un nom valide";
    //         nom.focus();
    //         return false;
    //     }else{
    //         document.getElementById("errorname").innerHTML="";
    //         return true;
    //     }
    // }

    // }

</script>
@endsection
