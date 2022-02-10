@extends('./layouts/admin')
@section('content')


<style>
    .input_inscription {
        padding: 2px;
        border-radius: 100px;
        box-sizing: border-box;
        color: #9E9E9E;
        border: 1px solid #BDBDBD;
        font-size: 16px;
        letter-spacing: 1px;
        height: 50px !important;
        border: 2px solid #aa076c17 !important;

    }

    .input_inscription:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: 2px solid #AA076B !important;
        outline-width: 0 !important;
    }


    .form-control-placeholder {
        position: absolute;
        top: 1rem;
        padding: 12px 2px 0 2px;
        padding: 0;
        padding-top: 2px;
        padding-bottom: 5px;
        padding-left: 5px;
        padding-right: 5px;
        transition: all 300ms;
        opacity: 0.5;
        left: 2rem;
    }

    .input_inscription:focus+.form-control-placeholder,
    .input_inscription:valid+.form-control-placeholder {
        font-size: 95%;
        font-weight: bolder;
        top: 1rem;
        transform: translate3d(0, -100%, 0);
        opacity: 1;
        backgroup-color: white;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        box-shadow: 0 0 0 30px white inset !important;
        -webkit-box-shadow: 0 0 0 30px white inset !important;
    }

</style>


<div id="page-wrapper">
    <div class="shadow-sm p-3 mb-5 bg-body rounded">
        <div class="container-fluid">
            <div class="panel-heading d-flex justify-content-between mb-5">
                <div>
                    <li class="{{ Route::currentRouteNamed('liste_chefDepartement') ? 'active' : '' }}" style="list-style: none"><a href="{{route('liste_chefDepartement')}}"><span class="bx bx-list-ul"></span>Liste des Manager</a></li>&nbsp;
                </div>
                <div>
                    <button class="btn btn_nouveau_color"><a href="{{route('departement.create')}}"><span class="bx bxs-plus-circle"></span> Nouveau Manager</a></button>
                </div>
            </div>
            @if (Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{Session::get('error') }}</li>
                </ul>
            </div>
            @endif
            <!-- /.row -->
            <div class="shadow p-3 mb-5 bg-body rounded">
                <h2>Nouveau Manager</h2>



                <form action="{{route('ajoutChefDepartement.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="photo" class="form-label">Photo<strong style="color:#ff0000;">*</strong></label>
                        <input type="file" enctype="multipart/form-data" class="form-control" id="photo" name="photos">
                        @error('photos')
                        <div class="col-sm-6">
                            <span style="color:#ff0000;"> {{$message}} </span>
                        </div>
                        @enderror
                    </div><br>


                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" autocomplete="off" required name="nom" class="form-control input_inscription" id="nom" />
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
                                <input type="text" autocomplete="off" name="prenom" class="form-control input_inscription" id="prenom" />
                                <label for="prenom" class="form-control-placeholder" align="left">Prénom</label>
                                @error('prenom')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" required autocomplete="off" name="cin" class="form-control input_inscription" id="cin" />
                                <label for="cin" class="form-control-placeholder" align="left">CIN<strong style="color:#ff0000;">*</strong></label>
                                <span style="color:#ff0000;" id="cin_err"></span>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" autocomplete="off" required name="fonction" class="form-control input_inscription" id="fonction" />
                                <label for="fonction" class="form-control-placeholder" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                                @error('fonction')
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
                                <input type="email" required name="mail" class="form-control input_inscription" id="mail" />
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
                                <input type="text" max=10 required name="phone" class="form-control input_inscription" id="phone" />
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
                        <div class="col">
                            <div class="form-group">
                                <label for="etp">Genre ou Sexe<strong style="color:#ff0000;">*</strong></label>
                                <select class="form-select" aria-label="Default select example" name="genre_chef" required id="genre_chef">
                                    <option value="H">Homme</option>
                                    <option value="S">Femme</option>
                                </select>
                                @error('genre_chef')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            @can('isReferent')
                            <div class="form-group">
                                <label for="etp">Departement<strong style="color:#ff0000;">*</strong></label>
                                <select class="form-select" class="form-control" id="liste_dep" name="liste_dep">
                                    @foreach($liste_departement as $dep)
                                    <option value="{{$dep->id}}">{{$dep->nom_departement}}</option>
                                    @endforeach
                                    </option>
                                </select>
                            </div>
                            @endcan
                        </div>
                    </div>

                    @can('isSuperAdmin')
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="etp">Entreprise</label><br><br>
                                <select class="form-select" class="form-control" id="liste_etp" name="liste_etp">
                                    @foreach($liste_entreprise as $etp)
                                    <option value="{{$etp->id}}">{{$etp->nom_etp}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="etp">Département</label>
                                <select class="form-select" class="form-control" id="liste_dep" name="liste_dep">
                                    @foreach($liste_departement as $dep)
                                    <option value="{{$dep->id}}">{{$dep->nom_departement}}</option>
                                    @endforeach
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    @endcan

                    <button type="submit" class="btn btn-lg" style="background-color: #9C27B0; color: white"><span class="fa fa-save"></span>&nbsp; Ajouter


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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>

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
