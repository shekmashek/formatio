
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formation.mg</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    </head>
<style>
    body {
    background: whitesmoke;
    direction: ltr;
    font-size: 12px;
    line-height: 1.4286;
    margin: 0;
    padding: 0;
    font-family: 'Roboto',sans-serif;
}
.contenue{
    width: 80%;
    background: #fff;
    position: absolute;
    top:50%;
    left: 50%;
    transform: translate(-50%,-50%);
    border-radius: 5px;
    border: 1px rgb(190, 177, 177) solid;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    padding: 48px 40px 36px;


}
.contenue h3{
    font-size: 2rem;
    font-weight:lighter;
}
.form{
    width: 250px;
    height: 40px;
    position: relative;

}
.form input{
    width: 100%;
    height: 100%;
    background: transparent;
    border: 1px solid rgb(190, 177, 177);
    border-radius:2px;
    outline: none;
    padding: 0 10px;
    font-size: 16px;
    color: black;

}
.form label{
    position: absolute;
    top: 8px;
    left: 10px;
    text-transform: title;
    font-size: 16px;
    transition: .3s;
    padding: 0 20px;
    background: #fff;
    color: gray;

}
.form input:focus  ~ label,.form input:valid  ~ label{
    margin-top:-18px;
    background: #fff;
    font-size: 12px;
    color: #7367f0;

}

.form input:focus,input:valid {
    border: #7367f0 1px solid;
}

.img{
    position: absolute;
    left: 59%;
    top: 15%;
}
h5{
    font-weight: lighter;
    color: #0f0e15;
}

</style>
<body>
    <div class="container">
        <div class="row">
            @canany(['isCFP'])
            @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
            @endif
                {{-- si l'utiliisateur a  choisir un fichier > 60Ko--}}
            @if (\Session::has('erreur_photo'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('erreur_photo') !!}</li>
                </ul>
            </div>
            @endif
            @if (\Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{!! \Session::get('error') !!}</li>
                </ul>
            </div>
            @endif
            @endcanany
            <div class="contenue mt-5">
                <form name="formInsert" id="formInsert" action="{{route('formateur.store')}}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();" class="form_insert_formateur">
                    @csrf
                    <h3 class="text-center mt-5">Créez votre compte</h3>
                    <h4>Informations générales</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-control-file mt-2">
                                <input type="file" class="form-control" name="image" id="image" placeholder="fichier" title="choisissez votre photo de profil" required>
                                <strong>Taille du fichier: (1.7 MB max)</strong>
                            </div>
                            <br>
                            @error('image')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <div class="form-group mb-2">
                                <input type="text" name="nom" id="nom" value="{{$formateur->nom_formateur}}" placeholder="Nom*" class="form-control" pattern="[A-Za-z' -]{1,100}" title="5 à 100 caractères" required>
                            </div>
                            @error('nom')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;" class="error" id="errorname"> {{$message}} </span>
                            </div>
                            @enderror
                            <div class="form-group mb-2">
                                <input type="text" name="prenom" id="prenom" value="{{$formateur->prenom_formateur}}" placeholder="Prenom*" class="form-control"  title="1 à 255 caractères"required>
                            </div>
                            @error('prenom')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <div class="select-group mb-2">
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
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" name="date_naissance" id="date" placeholder="Date de naissance*" onfocus="(this.type='date')" required>
                            </div>
                            @error('date_naissance')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" name="adresse" id="adresse" pattern="[A-Za-z0-9.&' -/]{1,255}" title="5 à 255 caractères" placeholder="Adresse, Lot ou Rue*" required>
                            </div>
                            @error('adresse')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <div class="form-group mb-2">
                                <input type="mail" class="form-control" value="{{$formateur->mail_formateur}}" name="mail" id="mail" pattern="[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]" title="entre votre adresse mail" placeholder="adresse e-mail*" required>
                                <span style="color:#ff0000;" id="mail_err"></span>
                            </div>
                            @error('mail')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <div class="form-group mb-2">
                                <input type="tel" class="form-control" name="phone" id="phone" minlength="10" maxlength="10" placeholder="Téléphone*" pattern="[0-9]{10}" title="entrer une numero de 10 chiffres sans lettre ni caractères spéciaux" required>
                                <span style="color:#ff0000;" id="phone_err"></span>
                            </div>
                            @error('phone')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <div class="form-group mb-2">
                                <input type="tel" class="form-control" name="cin" id="cin" minlength="12" maxlength="12" placeholder="Numero de CIN*" pattern="[0-9]{12}" title="entre un numero de 12 chiffres sans lettres ni caractères spéciaux" required>
                                <span style="color:#ff0000;" id="cin_err"></span>
                            </div>
                            @error('cin')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <h4>Informations Professionnelles</h4>
                            <div class="form-group mb-2">
                                <input type="text" class="form-control" name="specialite" id="specialite"  placeholder="Spécialité*" required>
                            </div>
                            @error('niveau')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                            <div class="form-group mb-2">
                                <select name="niveau"  class="form-select input" id="">
                                    @foreach ($niveau as $nv)
                                        <option value="{{$nv->id}}">{{$nv->niveau_etude}}</option>
                                    @endforeach
                                </select>
                                {{-- <input type="text" class="form-control" name="niveau" id="niveau"  placeholder="Niveau d'étude*" required> --}}
                            </div>
                            @error('specialite')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                            @enderror
                        </div>

                    <div class="img">
                        <img src="{{asset('images/create.png')}} " style="width:40%">
                    </div>
                    </div>
                    <h4>Domaine et Competence</h4>
                    <div class="row mt-2">
                        <div class="col-lg-5">
                            <div class="form-group">
                                <input type="text" class="form-control" name="domaine[]" id="domaine"  placeholder="Ex:Bureautique,Communication,Développement Informatique..." class="domaine" required>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <input type="text" class="form-control" name="competences[]" id="competences"  placeholder="Ex:Ms Excel,communication interpersonnelle,HTML..." class="domaine" required>
                            </div>
                        </div>
                        <div class="col-lg-2" align="center">
                            <button id="addRow1" class="btn btn-success envoyer" type="button"><i class="fa fa-plus" style="font-size: 15px"></i></button>
                        </div>
                        <div id="newRow1"></div>
                    </div>
                    <div class="row mt-4">
                        <h4>Expériences Professionnelles</h4>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="entreprise[]"  id="entreprise" placeholder="Nom entreprise" class="domaine" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="poste[]" id="poste" placeholder="Poste occupé" class="domaine" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="taches[]" id="taches" placeholder="Description des tâches faites dans l'entreprise" class="domaine" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
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
                                <div class="col-lg-4" align="center">
                                    <div class="form-group">
                                        <button id="addRow2" type="button" class="btn btn-success envoyer"><i class="fa fa-plus" style="font-size: 15px;"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="newRow2"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 mt-5 mb-5" align="center">
                            <div class="form-group">
                                <input type="submit" style="background: #7367f0" class="btn btn-warning btn-lg text-white envoyer" value="S'inscrire">
                            </div>
                        </div>
                    </div>
                </form>
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
        html += '<div class="row mt-2" id="inputFormRow1">';
        html += '<div class="col-lg-5">';
        html += '<div class="form-group">';
        html += '<input type="text" class="form-control" name="domaine[]" id="domaine"  placeholder="Ex:Bureautique,Communication,Développement Informatique..." class="domaine" required>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-lg-5">';
        html += '<div class="form-group">';
        html += '<input type="text" class="form-control" name="competences[]" id="competences"  placeholder="Ex:Ms Excel,communication interpersonnelle,HTML..." class="domaine" required>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-lg-2" align="center">';
        html += '<button id="removeRow1" type="button" class="btn btn-danger envoyer"><i class="fa fa-close style="font-size: 15px; text-color: white"></i></button>';
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
        html2 += '<div class="row mt-2"id="inputFormRow2">';
        html2 += '<div class="col-lg-12">';

        html2 += '<div class="row">';
        html2 += '<div class="col-lg-4">';
        html2 += '<div class="form-group">';
        html2 += '<input type="text" class="form-control" name="entreprise[]" id="entreprise" placeholder="Nom entreprise" class="domaine" required>';
        html2 += '</div>';
        html2 += '</div>';
        html2 += '<div class="col-lg-4">';
        html2 += '<div class="form-group">';
        html2 += '<input type="text" class="form-control" name="poste[]" id="poste"  placeholder="Poste occupé" class="domaine" required>';
        html2 += '</div>';
        html2 += '</div>';
        html2 += '<div class="col-lg-4">';
        html2 += '<div class="form-group">';
        html2 += '<input type="text" class="form-control"name="taches[]" id="taches"  placeholder="Tâches effectuer dans l&apos;entreprise" class="domaine" required>';
        html2 += '</div>';
        html2 += '</div>';
        html2 += '</div>';

        html2 += '<div class="row mt-2">';
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
        html2 += '<div class="col-lg-4" align="center">';
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
    $(function() {
        $("input[name='phone']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    });
    $(function() {
        $("input[name='cin']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    });

</script>

</body>
</html>