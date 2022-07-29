@extends('./layouts/admin')
@section('title')
<p class="text_header m-0 mt-1">Nouveau réferent</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{ asset('assets/css/inputcontrol.css') }}">
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
    <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-6">
                    <h5>Nouveau Réferent</h5>
                </div>
                <div class="col-6 text-end">
                    <div>
                        <a class="new_list_nouvelle " href="{{route('liste_module')}}">
                        <span class="btn_precedent text-center"><i class='bx bxs-chevron-left me-1'></i>Précedent</span>
                    </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="col-lg-12 p-4">
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
                        @if($resp_cfp_connecter->prioriter == 1)
                        <form class="form form_colab " action="{{ route('save+nouveau+responsable+cfp') }}" method="POST">
                            @csrf

                            <div class="mb-3 row text-end">
                                <label for="" class="col-sm-2 col-form-label">Nom <span style="color: red">*</span></label>
                                <div class="col-sm-5">
                                    <input autocomplete="off" required type="text" class="form-control" id="inlineFormInput"
                                        name="nom" placeholder="" required />
                                </div>
                            </div>

                            <div class="mb-3 row text-end">
                                <label for="" class="col-sm-2 col-form-label">Prénom <span
                                        style="color: red">*</span></label>
                                <div class="col-sm-6">
                                    <input autocomplete="off" type="text" class="form-control " id="inlineFormInput"
                                        name="prenom" placeholder="" />
                                </div>
                            </div>

                            <div class="mb-3 row text-end">
                                <label for="" class="col-sm-2 col-form-label">Email <span
                                        style="color: red">*</span></label>
                                <div class="col-sm-5">
                                    <input autocomplete="off" required type="email" class="form-control mb-2" id="email"
                                        name="email" placeholder="" />
                                </div>
                            </div>

                            <div class="mb-3 row text-end">
                                <label for="" class="col-sm-2 col-form-label">Télephone <span
                                        style="color: red">*</span></label>
                                <div class="col-sm-3">
                                    <input autocomplete="off" required type="text" class="form-control  mb-2" id="phone"
                                        name="phone" placeholder="" />
                                </div>
                            </div>

                            <div class="mb-3 row text-end">
                                <label for="" class="col-sm-2 col-form-label">CIN <span style="color: red">*</span></label>
                                <div class="col-sm-4">
                                    <input autocomplete="off" required type="text" maxlength="20" class="form-control "
                                        id="inlineFormInput" name="cin" />
                                </div>
                            </div>

                            <div class="mb-3 row text-end">
                                <label for="" class="col-sm-2 col-form-label">Fonction <span
                                        style="color: red">*</span></label>
                                <div class="col-sm-6">
                                    <input autocomplete="off" required type="text" class="form-control "
                                        id="inlineFormInput" name="fonction" placeholder="" />
                                </div>
                            </div>




                            <div class="col mt-4 ms-5 text-center    " style="font-size: 14px">
                                <button type="submit" class="btn btn_enregistrer "><i class="bx bx-check me-2"></i>
                                    Enregistrer</button>
                                <a href="{{route('liste_equipe_admin')}}" role="button"
                                    class="btn_annuler ms-3 text-center"><i class="bx bx-x me-2"></i>
                                    Annuler</a>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <script type="text/javascript">
        /*-----------------------------------------------*/
    $(function() {
        $("input[name='phone']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    });


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