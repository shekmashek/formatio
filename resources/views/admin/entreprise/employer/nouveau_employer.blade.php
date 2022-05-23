@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Nouveau employé</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">

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


<div class="container-fluid" id="form-input_employer">

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
            <div class="col-md-12">
                <div class="shadow p-5 mb-5 mx-auto bg-body w-50" style="border-radius: 15px">
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
                    <form action="{{route('employeur.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <input type="text" autocomplete="off" required name="matricule" class="form-control input" id="matricule" /required>
                                    <label for="matricule" class="form-control-placeholder" align="left">Matricule<strong style="color:#ff0000;">*</strong></label>
                                    <span style="color:#ff0000;" id="matricule_err"></span>
                                    @error('matricule')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="row px-3">
                                    <div class="form-group">
                                        <select class="form-select selectP input" id="type_enregistrement" name="type_enregistrement" aria-label="Default select example">
                                            <option value="STAGIAIRE">Employé</option>
                                            <option value="REFERENT">Réferent</option>
                                            <option value="MANAGER">Chef de département</option>

                                        </select>
                                        <label class="form-control-placeholder" for="type_enregistrement">Enregistrer en tant que<strong style="color:#ff0000;">*</strong></label>
                                    </div>
                                </div>
                            </div>

                        </div>


                        {{-- <div class="row"> --}}
                        {{-- <div class="col-md-5"> --}}
                        <div class="form-group">
                            <input type="text" autocomplete="off" required name="nom" class="form-control input" id="nom" required />
                            <label for="nom" class="form-control-placeholder" align="left">Nom<strong style="color:#ff0000;">*</strong></label>
                            @error('nom')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                        </div>
                        {{-- </div> --}}
                        {{-- <div class="col-md-7"> --}}
                        <div class="form-group">
                            <input type="text" autocomplete="off" name="prenom" class="form-control input" id="prenom" required />
                            <label for="prenom" class="form-control-placeholder" align="left">Prénom</label>
                        </div>
                        {{-- </div> --}}
                        {{-- </div> --}}
                        {{-- <div class="row"> --}}
                        {{-- <div class="col"> --}}
                        <div class="form-group">
                            <input type="text" required autocomplete="off" name="cin" class="form-control input" id="cin" required />
                            <label for="cin" class="form-control-placeholder" align="left">CIN<strong style="color:#ff0000;">*</strong></label>
                            <span style="color:#ff0000;" id="cin_err"></span>
                            @error('cin')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                        </div>
                        {{-- </div> --}}
                        {{-- <div class="col"> --}}
                        {{-- <div class="form-group">
                                <input type="text" max=10 required name="phone" class="form-control input" id="phone" required />
                                <label for="phone" class="form-control-placeholder" align="left">Téléphone<strong style="color:#ff0000;">*</strong></label>
                                <span style="color:#ff0000;" id="phone_err"></span>
                                @error('phone')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                </div>
                @enderror
            </div> --}}
            {{-- </div> --}}


            {{-- </div> --}}
            {{-- <div class="row"> --}}
            {{-- <div class="col-md-6"> --}}
            <div class="form-group">
                <input type="email" autocomplete="off" required name="mail" class="form-control input" id="mail" required />
                <label for="mail" class="form-control-placeholder" align="left">Email<strong style="color:#ff0000;">*</strong></label>
                <span style="color:#ff0000;" id="mail_err"></span>
                @error('mail')
                <div class="col-sm-6">
                    <span style="color:#ff0000;"> {{$message}} </span>
                </div>
                @enderror
            </div>
            {{-- </div> --}}
            {{-- <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" autocomplete="off" required name="fonction" class="form-control input" id="fonction" required />
                                <label for="fonction" class="form-control-placeholder" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                                @error('fonction')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
        </div>
        @enderror
    </div>
</div> --}}
{{-- </div> --}}
<div class=" text-center">
    <button type="submit" id="saver_stg" class="btn btn-lg btn_enregistrer">Sauvegarder</button>
</div>
</form>
</div>
</div>
</div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    function verify_email(mail_val) {
        var str = mail_val.split('');
        var result = false;
        for (var i = 0; i < str.length; i += 1) {
            if (str[i] == '@') {
                result = true;

            } else {
                result = false;
            }
        }
        return result;
    }


    $(document).ready(function() {

        $('#form-input_employer input').keyup(function() {
            $('#saver_stg').prop('disabled', false);

            var mail_err = document.getElementsByName("email_err[]");

            if ($("#matricule").val() != null) {
                var matricule = $("#matricule").val();
                if ($("#matricule").val() != "" && $("#matricule").val().length < 1 && $("#email").val() != "") {
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
                                document.getElementById("email_err").innerHTML = 'E-mail existe déjà';
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
                    document.getElementById("cin_err").innerHTML = '';

                    $.ajax({
                        url: "{{route('employes.export.verify_cin_stg')}}"
                        , type: 'get'
                        , data: {
                            valiny: cin
                        }
                        , success: function(response) {
                            var userData = response;
                            if (userData.length > 0) {
                                document.getElementById("cin_err").innerHTML = "CIN existe déjà";
                                $('#saver_stg').prop('disabled', true);


                            } else {
                                document.getElementById("cin_err").innerHTML = '';
                            }
                        }
                        , error: function(error) {
                            console.log(error);
                        }
                    });
                }
            }
        });


    });

    /*-----------------------------------------------*/

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

*/
    /*---------------------------------------------------------*/
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

</script>
@endsection
