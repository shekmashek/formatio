@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Nouveau employé</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControlAccueilIndex.css')}}">

<style>
    .navigation_module .nav-link {
        color: #637381;
        padding: 5px;
        cursor: pointer;
        font-size: 0.900rem;
        transition: all 200ms;
        margin-right: 1rem;
        text-transform: uppercase;
        padding-top: 10px;
        border: none;
    }

    .nav-item .nav-link.active {
        border-bottom: 3px solid #7635dc !important;
        border: none;
        color: #7635dc
    }

    .nav-tabs .nav-link:hover {
        background-color: rgb(245, 243, 243);
        transform: scale(1.1);
        border: none;
    }

    .nav-tabs .nav-item a {
        text-decoration: none;
        text-decoration-line: none;
    }

</style>


<div class="container-fluid">

    <div class="m-4">

        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <a href="{{route('employes.liste')}}" class="nav-link">
                    employés
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('employes.new')}}" class="nav-link active">
                    nouveau employé
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('employes.export.nouveau')}}" class="nav-link">
                    import EXCEL employé
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('employes.equipe')}}" class="nav-link">
                    Equipe
                </a>
            </li>
        </ul>
        <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div style="border-radius: 1px">
                    {{-- <h2 class="text-center mb-5" style="color: var(--font-sidebar-color); font-size: 1.5rem">Nouveau Employé</h2> --}}
                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{{Session::get('success') }}</li>
                        </ul>
                    </div>
                    @endif
                    @if (Session::has('error'))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{Session::get('error') }}</li>
                        </ul>
                    </div>
                    @endif
                    {{-- <form action="{{route('create_compte_employeur')}}" method="POST" enctype="multipart/form-data"> --}}
                    <form id="formInsert" action="{{route('employeur.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <h4 class="text-center">Nouveau Employé</h4>
                        <div class="row mt-4">
                            <div class="col-md-4  text-end">
                                <label class="mt-2">Matricule<strong style="color:#ff0000;">*</strong></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" autocomplete="off" required name="matricule" class="form-control input w-50" id="matricule" placeholder="Matricule" />
                                    @error('matricule')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                    <span class="m-0" style="color: red" id="matricule_err"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4 text-end">
                                <label for="nom" class="mt-2">Nom<strong style="color:#ff0000;">*</strong></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" autocomplete="off" required name="nom" class="form-control input" id="nom" required placeholder="Nom" />
                                    @error('nom')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4 text-end">
                                <label for="prenom" class="mt-2">Prénom</label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" autocomplete="off" name="prenom" class="form-control input" id="prenom" required placeholder="Prénom" />
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4 text-end">
                                <label for="cin" class="mt-2">CIN<strong style="color:#ff0000;">*</strong></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" required autocomplete="off" name="cin" class="form-control input" id="cin" required placeholder="Carte d'Identité Nationale" />
                                    <span style="color:#ff0000;" id="cin_err"></span>
                                    @error('cin')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4 text-end">
                                <label for="phone" class="mt-2">Téléphone<strong style="color:#ff0000;">*</strong></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" autocomplete="off" min=6 required name="phone" class="form-control input" id="phone" required placeholder="Télephone" />
                                    <span style="color:#ff0000;" id="phone_err"></span>
                                    @error('phone')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4 text-end">
                                <label for="mail" class="mt-2">Email<strong style="color:#ff0000;">*</strong></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="email" autocomplete="off" required name="mail" class="form-control input" id="mail" required placeholder="E-mail" />
                                    <span style="color:#ff0000;" id="mail_err"></span>
                                    @error('mail')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mt-1">
                            <div class="col-md-4 text-end">
                                <label for="fonction" class="mt-2">Fonction<strong style="color:#ff0000;">*</strong></label>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <input type="text" autocomplete="off" required name="fonction" class="form-control input" id="fonction" required placeholder="Fonction" />
                                    @error('fonction')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div class=" text-center mt-3">
                            <button type="submit" class="btn btn-lg btn_creer" id="saver_stg">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-md-4"></div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    /* function getMail(var tab=[]){
        for (let index = 0; index < tab.length; index++) {
            if(tab[index]== '@'){
                return true;
            }

        }
        return false;
    }
    */



    $(function() {
        $("input[name='phone']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
        $("input[name='cin']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    });


    /*
 <input type="text" name="passkey"
                        id="num"
                        oninput="return onlynum()"
                        minlength="2">
    */
    function onlynum() {
        var fm = document.getElementById("formInsert");
        var ip = document.getElementById("num");
        var tag = document.getElementById("value");
        var res = ip.value;

        if (res != '') {
            if (isNaN(res)) {

                // Set input value empty
                ip.value = "";

                // Reset the form
                fm.reset();
                return false;
            } else {
                return true
            }
        }
    }


    $(document).ready(function() {

        $('#formInsert input').keyup(function() {
            $('#saver_stg').prop('disabled', false);

            if ($("#matricule").val() != null) {
                var matricule = $("#matricule").val();
                if ($("#matricule").val() != "" && $("#matricule").val().length < 1 && $("#mail").val() != "") {
                    document.getElementById("matricule_err").innerHTML = 'invalid';
                } else {
                    document.getElementById("matricule_err").innerHTML = '';

                }

                $.ajax({
                    url: "{{route('employes.export.verify_matricule_stg')}}"
                    , type: 'get'
                    , data: {
                        valiny: matricule
                    }
                    , success: function(response) {
                        var userData = response;
                        if (userData.length > 0) {
                            document.getElementById("matricule_err").innerHTML = 'matricule existe déjà';
                            $('#saver_stg').prop('disabled', true);
                        } else {
                            document.getElementById("matricule_err").innerHTML = '';
                        }
                    }
                    , error: function(error) {
                        console.log(error);
                    }
                });
                /*=============*/
                if ($("#mail").val() != null) {
                    var email = $("#mail").val();

                    if ($("#matricule").val() != null && $("#matricule").val() != "") {
                        if (email.indexOf('@') == -1) {
                            document.getElementById("mail_err").innerHTML = 'E-mail invalid';
                            $('#saver_stg').prop('disabled', true);

                        } else {
                            document.getElementById("mail_err").innerHTML = '';
                        }
                    }

                    $.ajax({
                        url: "{{route('employes.export.verify_email_stg')}}"
                        , type: 'get'
                        , data: {
                            valiny: email
                        }
                        , success: function(response) {
                            var userData = response;
                            if (userData.length > 0) {
                                document.getElementById("mail_err").innerHTML = 'E-mail existe déjà';
                                $('#saver_stg').prop('disabled', true);

                            }
                        }
                        , error: function(error) {
                            console.log(error);
                        }
                    });
                }
                /*=============*/
                if ($("#cin").val() != null) {
                    var cin = $("#cin").val();
                    /*                  document.getElementById("cin_err").innerHTML = '';
                     */
                    if ($("#matricule").val().length > 0) {
                        if ($("#matricule").val() != null && $("#matricule").val() != "") {
                            if ($("#cin").val().length < 5) {
                                document.getElementById("cin_err").innerHTML = 'CIN invalid';
                                $('#saver_multi_stg').prop('disabled', true);
                            } else {
                                document.getElementById("cin_err").innerHTML = '';
                                verifyDuplicate(cin, cin_err);
                            }
                        }
                    } else {
                        document.getElementById("cin_err").innerHTML = '';
                    }

                    $.ajax({
                        url: "{{route('employes.export.verify_cin_stg')}}"
                        , type: 'get'
                        , data: {
                            valiny: cin
                        }
                        , success: function(response) {
                            var userData = response;
                            if (response.error != null) {
                                document.getElementById("cin_err").innerHTML = response.error;
                                $('#saver_stg').prop('disabled', true);
                            }
                            /*  if (userData.length > 0) {
                                  document.getElementById("cin_err").innerHTML = "CIN existe déjà";
                                  $('#saver_stg').prop('disabled', true);
                              } else {
                                  document.getElementById("cin_err").innerHTML = '';
                              } */
                        }
                        , error: function(error) {
                            console.log(error);
                        }
                    });
                }
            }



        });


    });



    /*
        $(document).on('change', '#cin', function() {
            document.getElementById("cin_err").innerHTML = "";

            var result = $(this).val();
            if ($(this).val().length < 5) {
                document.getElementById("cin_err").innerHTML = "Le CIN est invalid";

            } else {
                document.getElementById("cin_err").innerHTML = "";
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
            }
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

            if ($(this).val().length < 7) {
                document.getElementById("phone_err").innerHTML = "le numéro du télephone n'est pas correct";
            } else {
                document.getElementById("phone_err").innerHTML = '';

            }


        });


        $('#liste_etp').on('change', function() {
            $('#liste_dep').empty();
            var id = $(this).val();
            $.ajax({
                url: "{{route('show_dep')}}"
                , type: 'get'
                , data: {
                    id: id
                }
                , success: function(response) {
                    var userData = response;
                    console.log(userData);
                    for (var $i = 0; $i < userData.length; $i++) {
                        $("#liste_dep").append('<option value="' + userData[$i].departement.id + '">' + userData[$i].departement.nom_departement + '</option>');
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            });
        });
    */

</script>
@endsection