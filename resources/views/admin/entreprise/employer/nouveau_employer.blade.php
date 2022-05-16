@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Nouveau employée</p>
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
.nav-tabs .nav-item a{
    text-decoration: none;
    text-decoration-line: none;
}
</style>


<div class="container-fluid">

    <div class="m-4">

    <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
        <li class="nav-item">
            <a href="{{route('employes.liste')}}" class="nav-link">
                liste des employers
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('employes.new')}}" class="nav-link active">
                nouveau
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('employes.export.nouveau')}}" class="nav-link">
                export EXCEL employer
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


                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" autocomplete="off" required name="nom" class="form-control input" id="nom" required />
                                <label for="nom" class="form-control-placeholder" align="left">Nom<strong style="color:#ff0000;">*</strong></label>
                                @error('nom')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <input type="text" autocomplete="off" name="prenom" class="form-control input" id="prenom" required />
                                <label for="prenom" class="form-control-placeholder" align="left">Prénom</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
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
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" max=10 required name="phone" class="form-control input" id="phone" required />
                                <label for="phone" class="form-control-placeholder" align="left">Téléphone<strong style="color:#ff0000;">*</strong></label>
                                <span style="color:#ff0000;" id="phone_err"></span>
                                @error('phone')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" required name="mail" class="form-control input" id="mail" required />
                                <label for="mail" class="form-control-placeholder" align="left">Email<strong style="color:#ff0000;">*</strong></label>
                                <span style="color:#ff0000;" id="mail_err"></span>
                                @error('mail')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" autocomplete="off" required name="fonction" class="form-control input" id="fonction" required />
                                <label for="fonction" class="form-control-placeholder" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                                @error('fonction')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class=" text-center">
                        <button type="submit" class="btn btn-lg btn_enregistrer">Sauvegarder</button>
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

   /* function getMail(var tab=[]){
        for (let index = 0; index < tab.length; index++) {
            if(tab[index]== '@'){
                return true;
            }

        }
        return false;
    }
    */
    $(document).on('change', '#cin', function() {
        document.getElementById("cin_err").innerHTML = "";

        var result = $(this).val();
       if ($(this).val().length<5) {
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

        if ($(this).val().length <7) {
            document.getElementById("phone_err").innerHTML = "le numéro du télephone n'est pas correct";
        } else {
            document.getElementById("phone_err").innerHTML = '';
          /*  $.ajax({
                url: '{{route("verify_tel_user")}}'
                , type: 'get'
                , data: {
                    valiny: result
                }
                , success: function(response) {
                    var userData = response;

                    if (userData.length > 0) {
                        document.getElementById("phone_err").innerHTML = "le numéro du télephone existe déjà";
                    } else {
                        document.getElementById("phone_err").innerHTML = "";
                    }
                }
                , error: function(error) {
                    console.log(error);
                }
            }); */
        }


    });

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
