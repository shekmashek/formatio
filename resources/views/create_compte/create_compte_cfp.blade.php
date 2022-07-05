<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Formation.mg</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="shortcut icon" href="{{asset('img/logos_all/iconFormation.webp') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/create_compte_cfp.css')}}">
</head>
<body>

    <div class="container">
        <div class="row">
            <form action="{{route('create_compte_cfp')}}" id="form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="contenue">
                    @if(Session::has('success'))
                    <div class="alert alert-success" style="margin-top:-25px">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger" style="margin-top:-25px">
                        {{Session::get('error')}}
                    </div>
                    @endif
                    <h3 class="">Crée votre compte</h3>
                    <h5 class="mt-3"><i class="fa-solid fa-user-tie"></i>&nbsp;&nbsp;A propos de vous :</h5>
                    <div class="formulaire mt-3" style="display: flex">
                        <div class="form ">
                            <input name="nom_resp_cfp" id="nom_resp_cfp" value="{{old('nom_resp_cfp')}}" type="text"
                                autocomplete="off" required>
                            <label for="">Noms</label>
                            @error('nom_resp_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000; font-size: 0.8rem" id="nom_resp_cfp_err"></span>
                        </div>
                        <div class="form " style="margin-left: 20px;">
                            <input name="prenom_resp_cfp" autocomplete="off" type="text" name="prenom_resp_cfp"
                                required>
                            <label for="">Prénoms</label>
                            @error('prenom_resp_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000; font-size: 0.8rem;"> {{$message}} </span>
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="formulaire">
                        <div class="form mt-4" style="width:520px;">
                            <input name="cin_resp_cfp" autocomplete="off" id="cin_resp_cfp" type="text" required>
                            <label for="">CIN</label>
                            @error('cin_resp_cfp')
                            <div class="col-sm-12">
                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000; font-size: 0.8rem" id="cin_resp_cfp_err"></span>
                        </div>
                    </div>
                    <div class="formulaire">
                        <div class="form mt-4" style="width:520px;">
                            <input name="email_resp_cfp" autocomplete="off" id="email_resp_cfp" type="text" required>
                            <label for="">Email Responsable</label>
                            @error('email_resp_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000; font-size: 0.8rem" id="email_resp_cfp_err"> </span>
                        </div>
                    </div>
                    <div class="img">
                        <img src="{{asset('images/create.png')}} " style="width:400px;height:400px; alt="">
                    </div>
                    <h5 class=" mt-5"><i class="fa-solid fa-sitemap"></i>&nbsp;&nbsp;A propos de votre organisation :
                        </h5>
                        <div class="formulaire mt-3" style="display: flex">
                            <div class="form ">
                                <input type="text" name="name_cfp" autocomplete="off" required>
                                <label for="">Raison sociale</label>
                                @error('name_cfp')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                                </div>
                                @enderror
                                <span style="color:#ff0000;" id="name_cfp_err"></span>
                            </div>
                            <div class="form " style="margin-left: 20px;">
                                <input name="nif" id="nif_cfp" type="text" autocomplete="off" required>
                                <label for="">Nif</label>
                                @error('nif')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                                </div>
                                @enderror
                                <span style="color:#ff0000; font-size: 0.8rem" id="nif_cfp_err"> </span>
                            </div>
                        </div>
                        <div class="formulaire">
                            <label for="" class="mt-2"
                                style="font-size:18px;color:gray;font-weight: lighter;">Logo</label>
                            <div class="form " style="width:520px;">
                                <input type="file" name="logo_cfp" id="logo_cfp" class="form-control" autocomplete="off"
                                    style="height: 30px" required>
                            </div>
                            @error('logo_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                            </div>
                            @enderror
                            @if ($errors->has('logo_cfp'))
                            <div class="error">
                                {{ $errors->first('logo_cfp') }}
                            </div>
                            @endif
                            <p id="error_logo_cfp" style="color:#ff0000; font-size: 0.8rem"></p>
                        </div>

                        <div class="formulaire text-center mt-3" style="display: flex;">
                            <input name="value_confident" required class="form-check-input align-middle" type="checkbox"
                                value="1" id=""> &nbsp;<p class="align-middle"><a
                                    href="{{route('condition_generale_de_vente')}}" target="_blank"
                                    class="nav-item lien_confidentiel" style="font-size: 14px">J'ai lu et accepter les
                                    termes de confidentiels du plateforme</a></p>
                        </div>
                        <div class="formulaire">
                            <div class="formulaire text-center" style="display: flex;">
                                <h5 style="font-size: 18px;margin-left:15%">Je ne suis pas un robot🙈</h5>
                            </div>
                            <div class="formulaire">
                                <p style="font-size: 16px;margin-left:20%">16 + <input type="text" name="val_robot"
                                        placeholder="?" style="width: 40px;text-align:center" required> = 27</p>
                                <a href="/create+compte+client" class="btn btn"
                                    style="text-decoration: none;color:white;background: #0a0a08;margin-left:0%;"><i
                                        class="fa-solid fa-circle-chevron-left align-middle"></i> &nbsp;Retour</a>
                                </button>
                                <button type="submit" class="btn text-light mt-3"
                                    style="background: #7367f0;margin-left:35%;">Confirmer</button>
                            </div>
                        </div>
            </form>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.min.js"
        integrity="sha512-a6ctI6w1kg3J4dSjknHj3aWLEbjitAXAjLDRUxo2wyYmDFRcz2RJuQr5M3Kt8O/TtUSp8n2rAyaXYy1sjoKmrQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
<script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).on('keyup change', '#nif_cfp', function() {
        var nif = $(this).val();

        if (nif.length < 7) {
            document.getElementById("nif_cfp_err").innerHTML = "NIF incomplète!";
        } else {
            document.getElementById("nif_cfp_err").innerHTML = "";
            $.ajax({
                url: '{{route("verify_nif_cfp")}}'
                , type: 'get'
                , data: {
                    nif: nif
                }
                , success: function(response) {
                    var userData = response;
                    if (userData.length > 0) {
                        document.getElementById("nif_cfp_err").innerHTML = "NIF appartient déjà sur d'autre organisme!";
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }
    });


    /*-----------------------------------------------*/

    $(document).on('keyup change', '#name_cfp', function() {
        var result = $(this).val();
        if (result.length < 2) {
            document.getElementById("name_cfp_err").innerHTML = "Veuillez indqué votre Raison sociale";
        } else {
            document.getElementById("name_cfp_err").innerHTML = "";
            $.ajax({
                url: '{{route("verify_name_cfp")}}'
                , type: 'get'
                , data: {
                    valiny: result
                }
                , success: function(response) {
                    var userData = response;

                    if (userData.length > 0) {
                        document.getElementById("name_cfp_err").innerHTML = "Entité existe déjà";
                    } else {
                        document.getElementById("name_cfp_err").innerHTML = "";
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    /*-----------------------------------------------*/

$(document).on('keyup change', '#logo_cfp', function() {
        var test = $(this).val().split('.').pop();
        document.getElementById("error_logo_cfp").innerHTML = '';

        if ("" + test == "jpg" || "" + test == "jpeg" || "" + test == "png") {
            /**60 000*/
            if (this.files[0].size > 1692728) {
                document.getElementById("error_logo_cfp").innerHTML = "la taille de votre logo ne doit pas dépassé 1.7 MB";
            }
        } else {
            document.getElementById("error_logo_cfp").innerHTML = "les extension de type *.jpg, *.png et *.jpeg seulement sont autorisé";
        }
    });

    /*-----------------------------------------------*/

    $(document).on('keyup change', '#nif_cfp', function() {
        var nif = $(this).val();
        if ($('#nif_cfp').val().length < 7) {
            document.getElementById("nif_cfp_err").innerHTML = "NIF incomplète!";

        } else {
            document.getElementById("nif_cfp_err").innerHTML = "";
            $.ajax({
                url: '{{route("verify_nif_cfp")}}'
                , type: 'get'
                , data: {
                    nif: nif
                }
                , success: function(response) {
                    var userData = response;
                    if (userData.length > 0) {
                        document.getElementById("nif_cfp_err").innerHTML = "NIF appartient déjà sur d'autre organisme de formation!";
                    } else {
                        document.getElementById("nif_cfp_err").innerHTML = "";
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }
    });


    /*-----------------------------------------------*/

    $(document).on('keyup change', '#cin_resp_cfp', function() {
        var result = $(this).val();
        document.getElementById("cin_resp_cfp_err").innerHTML = "";
        $.ajax({
            url: '{{route("verify_cin_user")}}'
            , type: 'get'
            , data: {
                valiny: result
            }
            , success: function(response) {
                var userData = response;
                if (userData.length > 0) {
                    document.getElementById("cin_resp_cfp_err").innerHTML = "CIN appartient déjà par un autre utilisateur";
                } else {
                    document.getElementById("cin_resp_cfp_err").innerHTML = "";
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });
    /*-----------------------------------------------*/
    $(document).on('keyup change', '#email_resp_cfp', function() {
        var result = $(this).val();
        if (result.length < 3) {
            document.getElementById("email_resp_cfp_err").innerHTML = "mail invalide !";
        } else {
            document.getElementById("email_resp_cfp_err").innerHTML = "";
            $.ajax({
                url: '{{route("verify_mail_user")}}'
                , type: 'get'
                , data: {
                    valiny: result
                }
                , success: function(response) {
                    var userData = response;

                    if (userData.length > 0) {
                        document.getElementById("email_resp_cfp_err").innerHTML = "mail existe déjà";
                    } else {
                        document.getElementById("email_resp_cfp_err").innerHTML = "";
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }
    });

</script>
</body>


</html>