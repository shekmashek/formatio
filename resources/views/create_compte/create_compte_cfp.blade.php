
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
    font-size: 14px;
    line-height: 1.4286;
    margin: 0;
    padding: 0;
    font-family: 'Roboto',sans-serif;
}
.contenue{
    width: 1000px;
    height: 720px;
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

.form.diso input{
    border: #ff0000 1px solid;
    
}
.form.diso input:focus  ~ label,.form.diso input:valid  ~ label{
    color: #ff0000;
}
.form.marna input{
    border: #31ae4c 1px solid;
    
}
.form.marna input:focus  ~ label,.form.marna input:valid  ~ label{
    color: #00ff6a;
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
i{
    color: grey;
}

</style>
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
                        <div class="form " >
                            <input name="nom_resp_cfp"  id="nom_resp_cfp"  value="{{old('nom_resp_cfp')}}" type="text" autocomplete="off" required>
                            <label for="">Noms</label>
                            @error('nom_resp_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                            </div>
                            @enderror
                            <span style="color:#ff0000; font-size: 0.8rem" id="nom_resp_cfp_err"></span>
                        </div>
                        <div class="form " style="margin-left: 20px;">
                            <input name="prenom_resp_cfp" autocomplete="off"  type="text" name="prenom_resp_cfp" required>
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
                            <input name="cin_resp_cfp" autocomplete="off" id="cin_resp_cfp" type="number" min="6"  required>
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
                            <span style="color:#ff0000; font-size: 0.8rem" id="email_resp_cfp_err"> Veuillez entrer votre mail</span>
                        </div>
                    </div>  
                    <div class="img">
                        <img src="{{asset('images/create.png')}} " style="width:400px;height:400px; alt="">
                    </div>
                    <h5 class="mt-5"><i class="fa-solid fa-sitemap"></i>&nbsp;&nbsp;A propos de votre organisation :</h5>  
                    <div class="formulaire mt-3" style="display: flex">
                        <div class="form " >
                            <input type="text" name="name_cfp" autocomplete="off"  required>
                            <label for="">Raison sociale</label>
                            @error('name_cfp')
                            <div class="col-sm-6">
                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                            </div>
                            @enderror
                        </div>
                        <div class="form " style="margin-left: 20px;">
                            <input name="nif" type="number" autocomplete="off"  required>
                            <label for="">Nif</label>
                            @error('nif')
                            <div class="col-sm-6">
                                <span style="color:#ff0000; font-size: 0.8rem"> {{$message}} </span>
                            </div>
                            @enderror
                        </div>    
                    </div> 
                    <div class="formulaire">
                        <label for="" class="mt-2" style="font-size:18px;color:gray;font-weight: lighter;">Logo</label>
                        <div class="form " style="width:520px;">    
                            <input type="file" name="logo_cfp" class="form-control" autocomplete="off"  style="height: 30px" required>
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
                        <input name="value_confident" class="form-check-input align-middle" type="checkbox" value="1" id=""> &nbsp;<p class="align-middle"><a href="{{route('condition_generale_de_vente')}}" target="_blank" class="nav-item lien_confidentiel" style="font-size: 14px">J'ai lu et accepter les termes de confidentiels du plateforme</a></p>
                    </div>
                    
                   
                    <div class="formulaire">
                        <div class="formulaire text-center" style="display: flex;">
                            <h5 style="font-size: 18px;margin-left:15%">Je ne suis pas un robot🙈</h5>
                        </div>
                        <div class="formulaire">
                            <p style="font-size: 16px;margin-left:20%">16 + <input type="text" name="val_robot" placeholder="?" style="width: 40px;text-align:center" required> = 27</p>
                            <button class="btn text-light align-middle mt-3" style="background: #0a0a08;margin-left:0%;"><i class="fa-solid fa-circle-chevron-left align-middle"></i> &nbsp; <a href="/create+compte+client" class="mt-2" style="text-decoration: none;color:white">Retour</a> </button>
                        <button type="submit" id="suivant_of_confirmer" class="btn text-light mt-3" style="background: #7367f0;margin-left:35%;">Confirmer</button>
                    </div>
                </div> 
            </form>     
        </div>
    </div>
</body>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

{{-- JQuery --}}
<script src="{{asset('bootstrapCss/js/bootstrap.bundle.js')}}"></script>
<script src="{{asset('assets/js/boxicons.js')}}"></script>
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/startmin.js')}}"></script>
<script src="{{asset('assets/fullcalendar/lib/main.js')}}"></script>
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="{{asset('assets/js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>
<script src="{{asset('js/create_compte.js')}}"></script>

<script type="text/javascript">
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

    $(document).on('change', '#name_entreprise', function() {
        var id = $(this).val();
        document.getElementById('name_entreprise_desc').innerHTML = id;
        console.log(document.getElementById('name_entreprise_desc').value);
    });


    $(function() {
        $("input[name='cin_resp_etp']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
        $("input[name='cin_resp_cfp']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
        $("input[name='val_robot']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    });


    $(document).ready(function() {

        $('#suivant_etp_1').prop('disabled', true);
        document.getElementById("nif_etp_err").innerHTML = "NIF incomplète!";
        document.getElementById("matricule_resp_etp_err").innerHTML = "Matricule ne doit pas être null!";
        $('#suivant_etp_confirmer').prop('disabled', true);

        // ========= field N°1 et N°2 pour entreprise inscription =================================

        $('.field-etp input').change(function() {

            if (document.getElementById("name_etp_err").innerHTML == '' &&
                document.getElementById("nif_etp_err").innerHTML == '') {
                $('#suivant_etp_1').prop('disabled', false);
            } else {
                $('#suivant_etp_1').prop('disabled', true);
            }

        });
        $('.field2-etp input').change(function() {
            if ($('#nom_resp_etp').val().length > 1 &&
                $('#cin_resp_etp').val().length > 4 &&
                $('#matricule_resp_etp').val().length > 1 &&
                $('#email_resp_etp').val().length > 5 &&
                $('#val_robot').val().length > 0) {

                if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                    document.getElementById("cin_resp_etp_err").innerHTML == '' &&
                    document.getElementById("matricule_resp_etp_err").innerHTML == '' &&
                    document.getElementById("email_resp_etp_err").innerHTML == '') {
                    $('#suivant_etp_confirmer').prop('disabled', false);
                } else {
                    $('#suivant_etp_confirmer').prop('disabled', true);
                }
            }
        });

    });

    $(document).ready(function() {

        $('#suivant_of_1').prop('disabled', true);
        document.getElementById("nif_cfp_err").innerHTML = "NIF incomplète!";
        $('#suivant_of_confirmer').prop('disabled', true);

        $('.field-cfp input').change(function() {
            if ($("#name_cfp_err").html() == '' &&
                $("#nif_cfp_err").html() == '') {
                $('#suivant_of_1').prop('disabled', false);
            } else {
                $('#suivant_of_1').prop('disabled', true);
            }
        });

        $('.field2-cfp input').change(function() {
            if ($('#nom_resp_cfp').val().length > 1 &&
                $('#cin_resp_cfp').val().length > 4 &&
                $('#email_resp_cfp').val().length > 5 &&
                $('#value_confident').val() == 1 &&
                $('#val_robot').val().length > 0) {

                if (document.getElementById("nom_resp_cfp_err").innerHTML == '' &&
                    document.getElementById("cin_resp_cfp_err").innerHTML == '' &&
                    document.getElementById("email_resp_cfp_err").innerHTML == '') {
                    $('#suivant_of_confirmer').prop('disabled', false);

                } else {
                    $('#suivant_of_confirmer').prop('disabled', true);

                }
            }
        });

    });


    /*-----------------------------------------------*/

    $(document).on('keyup change', '#name_cfp', function() {
        var result = $(this).val();
        if (result.length < 2) {
            document.getElementById("name_cfp_err").innerHTML = "Veuillez indqué votre Raison sociale";

            if ($("#nif_cfp_err").html() == '') {
                $('#suivant_of_1').prop('disabled', false);
            } else {
                $('#suivant_of_1').prop('disabled', true);
            }

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

                        if ($("#nif_cfp_err").html() == '') {
                            $('#suivant_of_1').prop('disabled', false);
                        } else {
                            $('#suivant_of_1').prop('disabled', true);
                        }
                    } else {
                        document.getElementById("name_cfp_err").innerHTML = "";

                        if ($("#nif_cfp_err").html() == '') {
                            $('#suivant_of_1').prop('disabled', false);
                        } else {
                            $('#suivant_of_1').prop('disabled', true);
                        }
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

                if ($("#name_cfp_err").html() == '' &&
                    $("#nif_cfp_err").html() == '') {
                    $('#suivant_of_1').prop('disabled', false);
                } else {
                    $('#suivant_of_1').prop('disabled', true);
                }
            } else {
                document.getElementById("error_logo_cfp").innerHTML = '';

                if ($("#name_cfp_err").html() == '' &&
                    $("#nif_cfp_err").html() == '') {
                    $('#suivant_of_1').prop('disabled', false);
                } else {
                    $('#suivant_of_1').prop('disabled', true);
                }
            }
        } else {
            document.getElementById("error_logo_cfp").innerHTML = "les extension de type *.jpg, *.png et *.jpeg seulement sont autorisé";

            if ($("#name_cfp_err").html() == '' &&
                $("#nif_cfp_err").html() == '') {
                $('#suivant_of_1').prop('disabled', false);
            } else {
                $('#suivant_of_1').prop('disabled', true);
            }
        }
    });

    /*-----------------------------------------------*/

    $(document).on('keyup change', '#nif_cfp', function() {
        var nif = $(this).val();
        if ($('#nif_cfp').val().length < 7) {
            document.getElementById("nif_cfp_err").innerHTML = "NIF incomplète!";

            if (document.getElementById("name_cfp_err").innerHTML == '') {
                $('#suivant_of_1').prop('disabled', false);
            } else {
                $('#suivant_of_1').prop('disabled', true);
            }

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

                        if ($("#name_cfp_err").html() == '') {
                            $('#suivant_of_1').prop('disabled', false);
                        } else {
                            $('#suivant_of_1').prop('disabled', true);
                        }

                    } else {
                        document.getElementById("nif_cfp_err").innerHTML = "";

                        if ($("#name_cfp_err").html() == '') {
                            $('#suivant_of_1').prop('disabled', false);
                        } else {
                            $('#suivant_of_1').prop('disabled', true);
                        }

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

                    if (document.getElementById("nom_resp_cfp_err").innerHTML == '' &&
                        document.getElementById("email_resp_cfp_err").innerHTML == '') {
                        $('#suivant_of_confirmer').prop('disabled', false);
                    } else {
                        $('#suivant_of_confirmer').prop('disabled', true);
                    }
                } else {
                    document.getElementById("cin_resp_cfp_err").innerHTML = "";

                    if (document.getElementById("nom_resp_cfp_err").innerHTML == '' &&
                        document.getElementById("email_resp_cfp_err").innerHTML == '') {
                        $('#suivant_of_confirmer').prop('disabled', false);
                    } else {
                        $('#suivant_of_confirmer').prop('disabled', true);
                    }
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

            if (document.getElementById("nom_resp_cfp_err").innerHTML == '' &&
                document.getElementById("cin_resp_cfp_err").innerHTML == '') {
                $('#suivant_of_confirmer').prop('disabled', false);
            } else {
                $('#suivant_of_confirmer').prop('disabled', true);
            }

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

                        if (document.getElementById("nom_resp_cfp_err").innerHTML == '' &&
                            document.getElementById("cin_resp_cfp_err").innerHTML == '') {
                            $('#suivant_of_confirmer').prop('disabled', false);
                        } else {
                            $('#suivant_of_confirmer').prop('disabled', true);
                        }

                    } else {
                        document.getElementById("email_resp_cfp_err").innerHTML = "";

                        if (document.getElementById("nom_resp_cfp_err").innerHTML == '' &&
                            document.getElementById("cin_resp_cfp_err").innerHTML == '') {
                            $('#suivant_of_confirmer').prop('disabled', false);
                        } else {
                            $('#suivant_of_confirmer').prop('disabled', true);
                        }
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });

        }

    });



    /*================= entreprise =====================*/


    /*-------------------------------------------------------------------------------------*/
    $(document).on('keyup change', '#name_etp', function() {
        var result = $(this).val();
        if (result.length < 2) {
            document.getElementById("name_etp_err").innerHTML = "Veuillez indqué votre Raison sociale";

            if (document.getElementById("nif_etp_err").innerHTML == '') {
                $('#suivant_etp_1').prop('disabled', false);
            } else {
                $('#suivant_etp_1').prop('disabled', true);
            }

        } else {
            document.getElementById("name_etp_err").innerHTML = "";


            $.ajax({
                url: '{{route("verify_name_etp")}}'
                , type: 'get'
                , data: {
                    valiny: result
                }
                , success: function(response) {
                    var userData = response;

                    if (userData.length > 0) {
                        document.getElementById("name_etp_err").innerHTML = "Entité existe déjà";

                        if (document.getElementById("nif_etp_err").innerHTML == '') {
                            $('#suivant_etp_1').prop('disabled', false);
                        } else {
                            $('#suivant_etp_1').prop('disabled', true);
                        }
                    } else {
                        document.getElementById("name_etp_err").innerHTML = "";

                        if (document.getElementById("nif_etp_err").innerHTML == '') {
                            $('#suivant_etp_1').prop('disabled', false);
                        } else {
                            $('#suivant_etp_1').prop('disabled', true);
                        }
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    /*-------------------------------------------------------------------*/
   $(document).on('keyup change', '#logo_etp', function() {
        var test = $(this).val().split('.').pop();
        document.getElementById("error_logo_etp").innerHTML = '';

        if ("" + test == "jpg" || "" + test == "jpeg" || "" + test == "png") {
            if (this.files[0].size > 1692728) {
                document.getElementById("error_logo_etp").innerHTML = "la taille de votre logo ne doit pas dépassé 1.7 MB";

                if (document.getElementById("name_etp_err").innerHTML == '' &&
                    document.getElementById("nif_etp_err").innerHTML == '') {
                    $('#suivant_etp_1').prop('disabled', false);
                } else {
                    $('#suivant_etp_1').prop('disabled', true);
                }

            } else {
                document.getElementById("error_logo_etp").innerHTML = '';

                if (document.getElementById("name_etp_err").innerHTML == '' &&
                    document.getElementById("nif_etp_err").innerHTML == '') {
                    $('#suivant_etp_1').prop('disabled', false);
                } else {
                    $('#suivant_etp_1').prop('disabled', true);
                }
            }
        } else {
            document.getElementById("error_logo_etp").innerHTML = "les extension de type *.jpg, *.png et *.jpeg seulement sont autorisé";

            if (document.getElementById("name_etp_err").innerHTML == '' &&
                document.getElementById("nif_etp_err").innerHTML == '') {
                $('#suivant_etp_1').prop('disabled', false);
            } else {
                $('#suivant_etp_1').prop('disabled', true);
            }
        }
    });


    /*-----------------------------------------------------------------------*/
    $(document).on('keyup change', '#nif_etp', function() {
        var nif = $(this).val();

        if (nif.length < 7) {
            document.getElementById("nif_etp_err").innerHTML = "NIF incomplète!";

            if (document.getElementById("name_etp_err").innerHTML == '') {
                $('#suivant_etp_1').prop('disabled', false);
            } else {
                $('#suivant_etp_1').prop('disabled', true);
            }

        } else {
            document.getElementById("nif_etp_err").innerHTML = "";

            $.ajax({
                url: '{{route("verify_nif_etp")}}'
                , type: 'get'
                , data: {
                    nif: nif
                }
                , success: function(response) {
                    var userData = response;
                    if (userData.length > 0) {
                        document.getElementById("nif_etp_err").innerHTML = "NIF appartient déjà sur d'autre entreprise!";

                        if (document.getElementById("name_etp_err").innerHTML == '') {
                            $('#suivant_etp_1').prop('disabled', false);
                        } else {
                            $('#suivant_etp_1').prop('disabled', true);
                        }
                    } else {
                        document.getElementById("nif_etp_err").innerHTML = "";

                        if (document.getElementById("name_etp_err").innerHTML == '') {
                            $('#suivant_etp_1').prop('disabled', false);
                        } else {
                            $('#suivant_etp_1').prop('disabled', true);
                        }
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }
    });

    /*--------------------------------------------------------------------*/

    $(document).on('keyup change', '#matricule_resp_etp', function() {
        var result = $(this).val();
        if (result.length < 1) {
            document.getElementById("matricule_resp_etp_err").innerHTML = "Matricule ne doit pas être null";

            if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                document.getElementById("cin_resp_etp_err").innerHTML == '' &&
                document.getElementById("email_resp_etp_err").innerHTML == '') {
                $('#suivant_etp_confirmer').prop('disabled', false);
            } else {
                $('#suivant_etp_confirmer').prop('disabled', true);
            }

        } else {
            document.getElementById("matricule_resp_etp_err").innerHTML = "";

            if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                document.getElementById("cin_resp_etp_err").innerHTML == '' &&
                document.getElementById("email_resp_etp_err").innerHTML == '') {
                $('#suivant_etp_confirmer').prop('disabled', false);
            } else {
                $('#suivant_etp_confirmer').prop('disabled', true);
            }

        }
    });

    /*--------------------------------------------------------------------*/

    $(document).on('keyup change', '#cin_resp_etp', function() {
        var result = $(this).val();
        document.getElementById("cin_resp_etp_err").innerHTML = "";

        if (result.length < 4) {
            document.getElementById("cin_resp_etp_err").innerHTML = "Le CIN est invalide";

            if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                document.getElementById("matricule_resp_etp_err").innerHTML == '' &&
                document.getElementById("email_resp_etp_err").innerHTML == '') {
                $('#suivant_etp_confirmer').prop('disabled', false);
            } else {
                $('#suivant_etp_confirmer').prop('disabled', true);
            }

        } else {
            $.ajax({
                url: '{{route("verify_cin_user")}}'
                , type: 'get'
                , data: {
                    valiny: result
                }
                , success: function(response) {
                    var userData = response;
                    if (userData.length > 0) {
                        document.getElementById("cin_resp_etp_err").innerHTML = "CIN appartient déjà par un autre utilisateur";

                        if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                            document.getElementById("matricule_resp_etp_err").innerHTML == '' &&
                            document.getElementById("email_resp_etp_err").innerHTML == '') {
                            $('#suivant_etp_confirmer').prop('disabled', false);
                        } else {
                            $('#suivant_etp_confirmer').prop('disabled', true);
                        }
                    } else {
                        document.getElementById("cin_resp_etp_err").innerHTML = "";

                        if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                            document.getElementById("matricule_resp_etp_err").innerHTML == '' &&
                            document.getElementById("email_resp_etp_err").innerHTML == '') {
                            $('#suivant_etp_confirmer').prop('disabled', false);
                        } else {
                            $('#suivant_etp_confirmer').prop('disabled', true);
                        }
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }

    });
    /*--------------------------------------------------------------------*/

    $(document).on('keyup change', '#email_resp_etp', function() {
        var result = $(this).val();
        if (result.length < 3) {
            document.getElementById("email_resp_etp_err").innerHTML = "mail invalide !";

            if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                document.getElementById("cin_resp_etp_err").innerHTML == '' &&
                document.getElementById("matricule_resp_etp_err").innerHTML == '') {
                $('#suivant_etp_confirmer').prop('disabled', false);
            } else {
                $('#suivant_etp_confirmer').prop('disabled', true);
            }

        } else {
            document.getElementById("email_resp_etp_err").innerHTML = "";

            $.ajax({
                url: '{{route("verify_mail_user")}}'
                , type: 'get'
                , data: {
                    valiny: result
                }
                , success: function(response) {
                    var userData = response;
                    if (userData.length > 0) {
                        document.getElementById("email_resp_etp_err").innerHTML = "mail existe déjà";

                        if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                            document.getElementById("cin_resp_etp_err").innerHTML == '' &&
                            document.getElementById("matricule_resp_etp_err").innerHTML == '') {
                            $('#suivant_etp_confirmer').prop('disabled', false);
                        } else {
                            $('#suivant_etp_confirmer').prop('disabled', true);
                        }

                    } else {
                        document.getElementById("email_resp_etp_err").innerHTML = "";

                        if (document.getElementById("nom_resp_etp_err").innerHTML == '' &&
                            document.getElementById("cin_resp_etp_err").innerHTML == '' &&
                            document.getElementById("matricule_resp_etp_err").innerHTML == '') {
                            $('#suivant_etp_confirmer').prop('disabled', false);
                        } else {
                            $('#suivant_etp_confirmer').prop('disabled', true);
                        }
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        }
    });

</script>
</html>


