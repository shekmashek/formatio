@extends('./layouts/admin')
@section('content')
<div class="container-fluid justify-content-center pb-3">

    <style type="text/css">
        button,
        value {
            font-size: 12px;
        }

        .font_text strong,
        .font_text li,
        .font_text h3,
        .font_text h4,
        .font_text p {
            font-size: 12px;
        }

        .font_text h5,
        .font_text h6 {
            font-size: 10px;
        }

        .form_colab input {
            height: 30px;
        }

        .form_colab input:hover {
            height: 30px;
            border: 1px solid #AA076B;
        }

        .form_colab select {
            height: 30px;
        }

        .form_colab select::option {
            height: 12px;
        }

        .form_colab input::placeholder {
            font-size: 12px
        }

        .form_colab label {
            font-size: 12px
        }

        .form_colab button {
            height: 30px;
            padding: 0;
            padding-left: 5px;
            padding-right: 5px;
            font-size: 13px;
        }

        .nav_bar_list:hover {
            background-color: transparent;
        }

        .nav_bar_list .nav-item:hover {
            border-bottom: 2px solid black;
        }

    </style>


    <div class="row w-100 bg-none mt-5 font_text">

        <div class="col-md-5">

            <div class="shadow p-3 mb-5 bg-body rounded ">
                <h4>Liste(s) de(s) responsable(s)</h4>

                <table class="table  table-borderless table-lg">
                    <tbody id="data_collaboration">

                        <tr>
                            <td>
                                <div align="left">
                                    <strong>{{$resp_etp_connecter->nom_resp." ".$resp_etp_connecter->prenom_resp}}</strong>
                                    <p style="color: rgb(238, 150, 18)">{{$resp_etp_connecter->email_resp}}</p>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <strong>{{$resp_etp_connecter->fonction_resp}}</strong>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    @if ($resp_etp_connecter->prioriter == 1)
                                    <strong style="color: rgb(18, 238, 66)">{{"principale"}}</strong>
                                    @else
                                    <strong style="color: rgb(9, 10, 10)">{{"responsable"}}</strong>
                                    @endif
                                </div>
                            </td>

                            <td>
                                <div align="center">
                                    <strong style="color: rgb(18, 238, 66)">moi</strong>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <hr>
                            </td>
                        </tr>
                        @if (count($responsable)<=0) <tr>
                            <td colspan="3"> <strong align="center">Aucun autre que vous qui est responsable de votre entité</strong></td>
                            </tr>
                            @else
                            @foreach($responsable as $etp)
                            <tr>
                                <td>
                                    <div align="left">
                                        <strong>{{$etp->nom_resp." ".$etp->prenom_resp}}</strong>
                                        <p style="color: rgb(238, 150, 18)">{{$etp->email_resp}}</p>
                                    </div>
                                </td>

                                <td>
                                    <div align="center">
                                        <strong>{{$etp->fonction_resp}}</strong>
                                    </div>
                                </td>

                                <td>
                                    <div align="center">
                                        @if ($etp->prioriter == 1)
                                        <strong style="color: rgb(18, 238, 66)">{{"principale"}}</strong>
                                        @else
                                        <strong style="color: rgb(9, 10, 10)">{{"responsable"}}</strong>
                                        @endif
                                    </div>
                                </td>
                                <td>

                                    <div class="btn-group dropleft">
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-v"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('affResponsable',{{$etp->id}})}}"><i class="fa fa-eye"></i> &nbsp; Afficher</a>
                                            <a class="dropdown-item" href="" data-toggle="modal" data-target="#exampleModal_{{$etp->id}}"><i class="fa fa-trash"></i> <strong style="color: red">Mettre fin à la collaboration</strong></a>
                                        </div>
                                    </div>
                                </td>
                                {{-- modal delete  --}}
                                <div class="modal fade" id="exampleModal_{{$etp->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                <h6 class="modal-title text-white">Avertissement !</h6>

                                            </div>
                                            <div class="modal-body">
                                                <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                <form action="{{ route('delete+responsable+entreprise') }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-secondary"> Oui </button>
                                                    <input name="id" type="text" value="{{$etp->id}}" hidden>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- fin modal delete --}}

                            </tr>

                            @endforeach
                            @endif

                    </tbody>

                </table>

            </div>


        </div>

        <div class="col-md-7">

            {{-- <div class="shadow p-3 mb-5 bg-body rounded my-5"> --}}

            @if($resp_etp_connecter->prioriter == 1)
            <h2>Créer un nouveau responsable dans votre organisation</h2>
            <p>
                Pour travailler plus vite pour plus de productivié et gagner du temps.
            </p>

            <form class="form form_colab" action="{{ route('save+nouveau+responsable+entreprise') }}" method="POST">
                @csrf
                <div class="form-row d-flex">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-control-label" align="left">Nom<strong style="color:#ff0000;">*</strong></label>
                        <input required type="text" class="form-control mb-2" id="inlineFormInput" name="nom" placeholder="Nom*" required />
                    </div>
                    <div class="col ms-2">
                        <label for="exampleFormControlInput1" class="form-control-label" align="left">Prénom</label>
                        <input type="text" class="form-control  mb-2" id="inlineFormInput" name="prenom" placeholder="Prénom" />
                    </div>

                </div>
                <div class="form-row d-flex">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-control-label" align="left">CIN<strong style="color:#ff0000;">*</strong></label>

                        <div class="row">
                            <div class="col">
                                <input required type="text" minlength="1" maxlength="1" class="form-control mb-2" id="inlineFormInput" name="cin_1" />
                            </div>
                            <div class="col">
                                <input required type="text" minlength="1" maxlength="1" class="form-control mb-2" id="inlineFormInput" name="cin_2" />
                            </div>
                            <div class="col">
                                <input required type="text" minlength="1" maxlength="1" class="form-control mb-2" id="inlineFormInput" name="cin_3" />
                            </div>
                            <div class="col">
                                <input required type="text" minlength="1" maxlength="1" class="form-control mb-2" id="inlineFormInput" name="cin_4" />
                            </div>
                            <div class="col">
                                <input required type="text" minlength="1" maxlength="1" class="form-control mb-2" id="inlineFormInput" name="cin_5" />
                            </div>
                            <div class="col">
                                <input required type="text" minlength="1" maxlength="1" class="form-control mb-2" id="inlineFormInput" name="cin_6" />
                            </div>
                            <div class="col">
                                <input required type="text" minlength="1" maxlength="1" class="form-control mb-2" id="inlineFormInput" name="cin_7" />
                            </div>
                            <div class="col">
                                <input required type="text" minlength="1" maxlength="1" class="form-control mb-2" id="inlineFormInput" name="cin_8" />
                            </div>
                            <div class="col">
                                <input required type="text" minlength="1" maxlength="1" class="form-control mb-2" id="inlineFormInput" name="cin_9" />
                            </div>
                            <div class="col">
                                <input required type="text" minlength="1" maxlength="1" class="form-control mb-2" id="inlineFormInput" name="cin_10" />
                            </div>
                            <div class="col">
                                <input required type="text" minlength="1" maxlength="1" class="form-control mb-2" id="inlineFormInput" name="cin_11" />
                            </div>
                            <div class="col">
                                <input required type="text" minlength="1" maxlength="1" class="form-control mb-2" id="inlineFormInput" name="cin_12" />
                            </div>
                        </div>

                        {{-- <input required type="text" minlength="12" maxlength="12"  class="form-control mb-2" id="inlineFormInput" name="cin" /> --}}

                    </div>
                </div>

                <label for="exampleFormControlInput1" class="form-control-label" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                <input required type="text" class="form-control  mb-2" id="inlineFormInput" name="fonction" placeholder="Fonction*" />

                <div class="form-row d-flex">
                    <div class="col">
                        <label for="exampleFormControlInput1" class="form-control-label" align="left">Email<strong style="color:#ff0000;">*</strong></label>
                        <input required type="email" class="form-control mb-2" id="email" name="email" placeholder="Email*" />
                        <span style="color:#ff0000;" id="email_err"></span>

                    </div>
                    <div class="col ms-2">
                        <label for="exampleFormControlInput1" class="form-control-label" align="left">Télephone<strong style="color:#ff0000;">*</strong></label>
                        <input required type="text" class="form-control  mb-2" id="phone" name="phone" placeholder="Télephone*" />
                        <span style="color:#ff0000;" id="phone_err"></span>

                    </div>
                </div>

                <div class="form-row d-flex">
                    <div class="col">
                        <label for="dte_resp" class="form-control-label" align="left">Date de Naissance<strong style="color:#ff0000;">*</strong></label>
                        <input required type="date" class="form-control mb-2" id="inlineFormInput" name="dte" />
                    </div>
                    <div class="col ms-2">
                        <label for="exampleFormControlInput1" class="form-control-label" align="left">Genre ou Sexe<strong style="color:#ff0000;">*</strong></label>

                        <select class="form-select  mb-2 mt-2" id="inlineFormInput" name="sexe" required id="sexe_resp">
                            <option value="H">Homme</option>
                            <option value="S">Femme</option>
                        </select>
                    </div>
                </div>

                <div class="form-row d-flex">
                    <div class="col ms-2">
                        <button type="submit" class="btn btn-primary mt-2">Enregistrer</button>
                    </div>
                </div>

                @if(Session::has('success'))
                <div class="alert alert-success">
                    <strong> {{Session::get('success')}}</strong>
                </div>
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger">
                    <strong> {{Session::get('error')}}</strong>
                </div>
                @endif
            </form>
            @endif


        </div>


    </div>


</div>




</div>

<script src="{{ asset('assets/js/jquery.js') }}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />

<script type="text/javascript">
    /*-----------------------------------------------*/

    $(document).on('change', '#email', function() {
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
                    document.getElementById("email_err").innerHTML = "mail existe déjà";
                } else {
                    document.getElementById("email_err").innerHTML = "";
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

</script>

@endsection
