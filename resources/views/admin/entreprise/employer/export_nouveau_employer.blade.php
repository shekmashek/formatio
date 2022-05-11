@extends('./layouts/admin')
@section('title')
<h3 class="text_header m-0 mt-1">Export Excel Employer</h3>
@endsection
@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>

<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">

<style type="text/css">
    button,
    value {
        font-size: 30px;
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

    .form_colab span {
        height: 30px;
    }

    .form_colab input::placeholder {
        font-size: 12px
    }

    /* .form_colab button {
        height: 30px;
        padding: 0;
        padding-left: 5px;
        padding-right: 5px;
        font-size: 13px;
    } */

    .nav_bar_list:hover {
        background-color: transparent;
    }

    .nav_bar_list .nav-item:hover {
        border-bottom: 2px solid black;
    }

    h6,
    p {
        font-size: 80%;
    }

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

    <div class="row g-0">

        <div class="m-4">

            <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
                <li class="nav-item">
                    <a href="{{route('employes.liste')}}" class="nav-link">
                        liste des employers
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('employes.new')}}" class="nav-link">
                        nouveau
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('employes.export.nouveau')}}" class="nav-link active">
                        export EXCEL employer
                    </a>
                </li>
            </ul>
        </div>

        <div class="row mt-1 justify-content-center  export_excel" align="center">
            <div class="col text-muted text-align-center">
                <h6>Comment ajouter plusieurs stagiaires d'une seule coup?</h6>
                <p>Tout d'abord, vous devrez avoir un fichier excel des listes des stagiaires avec des exception comportant seulement ses colonnes requis pour les informations minimum:</p>
                <p>1°):<span> Maximum 30 personne(s) </span></p>
                <p>2°):Les champs neccéssaire: <span> "Matricule" , "Nom", "Prénom", "CIN", "email"</span></p>
                <p>3°): Faire <span>copier coller </span> les données en sélectionnants la prémière ligne "Matricule N°1" ou utiliser la racourcie CRTL+A et CRTL+C (pour copier) et CRTL+V pour coller</p>
            </div>
            {{-- <div class="col-md-4"></div> --}}
        </div>

        <div class="row mt-5 justify-content-center">

            <div class="col jusitfy-content-center">
                <form name="formInsert" id="formInsert" action="{{route('save_multi_stagiaire_exproter_excel')}}" method="POST" enctype="multipart/form-data" class="form_insert_formateur form_colab  needs-validation" novalidate>
                    @csrf
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{Session::get('success')}}
                    </div>
                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{Session::get('error')}}
                    </div>
                    @endif

                    <table id="example" class="table">
                        <thead>
                            <tr align="center">
                                <th>Matricule <span style="color: red">*</span> </th>
                                <th>Nom <span style="color: red">*</span> </th>
                                <th>Prénom</th>
                                <th>CIN <span style="color: red">*</span> </th>
                                <th>E-mail <span style="color: red">*</span> </th>
                            </tr>
                        </thead>
                        <tbody id="newRowMontant">

                            @for($i = 1; $i <= 30; $i++) <tr align="center">
                                <td>
                                    <div class="form-group">
                                        <input autocomplete="off" class="form-control mx-0 " id="matricule_{{$i}}" type="text" name="matricule_{{$i}}" placeholder="Matricule N° {{$i}}">
                                        <br>
                                        <p class="m-0" style="color: red" id="matricule_err_{{$i}}"></p>
                                        <div class="invalid-feedback">
                                            Please choose a matricule.
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{-- <div class="form-group"> --}}
                                    <input autocomplete="off" class="form-control" id="nom_{{$i}}" type="text" name="nom_{{$i}}" placeholder="Nom">
                                    {{-- </div> --}}
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input autocomplete="off" class="form-control" id="inlineFormInput" type="text" name="prenom_{{$i}}" placeholder="Prénom">
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input autocomplete="off" class="form-control" id="cin_{{$i}}" type="text" name="cin_{{$i}}" placeholder="CIN">
                                        <br>
                                        <p class="m-0" style="color: red" id="cin_err_{{$i}}"></p>

                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <input autocomplete="off" class="form-control" type="email" id="email_{{$i}}" name="email_{{$i}}" placeholder="E-mail">
                                        <br>
                                        <p class="m-0" style="color: red" id="email_err_{{$i}}"></p>

                                    </div>
                                </td>
                                </tr>
                                @endfor

                        </tbody>
                    </table>
                    <div class="form-group mt-2" align="center">
                        <button type="submit" class="btn btn_creer" id="saver_multi_stg">sauvegarder</button>

                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $(document).ready(function() {

        $('td input').bind('paste', null, function(e) {
            $txt = $(this);
            setTimeout(function() {

                var values = $txt.val().split(/\s+/);
                // var values = $txt.val().split(/\t+/);
                var currentRowIndex = $txt.parent().parent().index();
                var currentColIndex = $txt.parent().index();

                var totalRows = $('#example tbody tr').length;
                var totalCols = $('#example thead th').length;

                var count = 0;

                for (var j = currentRowIndex; j < totalRows; j++) {
                    for (var i = currentColIndex; i < totalCols; i++) {

                        var value = values[count];

                        var inp = $('#example tbody tr').eq(j).find('td').eq(i).find('input');

                        count += 1;
                        inp.val(value);
                    }
                }
            }, 0);
        });
    });




    function verify_email(mail_val) {
        var str = mail_val.split('');
        var result = false;
        for (var i = 0; i < str.length; i += 1) {
            if (str[i] == '@') {
                result = true;
                break;
            } else {
                result = false;
            }
        }
        return result;
    }

    /*================================ verify champ inscription =====================================*/

    $(document).ready(function() {

        /*     $('#saver_multi_stg').prop('disabled', true); */

        $('#formInsert input').keyup(function() {

            for (let i = 1; i <= 30; i += 1) {

                /*         if ($("matricule_err_" + i).html() == '' &&
                    $("email_err_" + i).html() == '' &&
                    $("cin_err_" + i).html() == '') {
                    $('#saver_multi_stg').prop('disabled', false);
                } else {
                    $('#saver_multi_stg').prop('disabled', true);
                }
*/
                if ($("#matricule_" + i).val() != null) {
                    var matricule = $("#matricule_" + i).val();
                    document.getElementById("matricule_err_" + i).innerHTML = '';

                    $.ajax({
                        url: "{{route('employes.export.verify_matricule_stg')}}"
                        , type: 'get'
                        , data: {
                            valiny: matricule
                        }
                        , success: function(response) {
                            var userData = response;
                            if (userData.length > 0) {
                                document.getElementById("matricule_err_" + i).innerHTML = 'matricule existe déjà';
                                /*                  if ( $("email_err_" + i).html() == '' &&
                                                      $("cin_err_" + i).html() == '') {
                                                      $('#saver_multi_stg').prop('disabled', false);
                                                  } else {
                                                      $('#saver_multi_stg').prop('disabled', true);
                                                  } */
                            } else {
                                document.getElementById("matricule_err_" + i).innerHTML = '';
                            }
                        }
                        , error: function(error) {
                            console.log(error);
                        }
                    });

                    if ($("#email_" + i).val() != null) {
                        var email = $("#email_" + i).val();

                        var verify = verify_email(email);
                        if (verify == false && $("#matricule_" + i).val().length > 0) {
                            document.getElementById("email_err_" + i).innerHTML = 'E-mail invalid';
                        } else {
                            document.getElementById("email_err_" + i).innerHTML = '';
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
                                    document.getElementById("email_err_" + i).innerHTML = 'E-mail existe déjà';
                                    /*         if ($("matricule_err_" + i).html() == '' &&
                                                 $("cin_err_" + i).html() == '') {
                                                 $('#saver_multi_stg').prop('disabled', false);
                                             } else {
                                                 $('#saver_multi_stg').prop('disabled', true);
                                             } */
                                } else {
                                    if (verify == false && $("#matricule_" + i).val().length > 0) {
                                        document.getElementById("email_err_" + i).innerHTML = 'E-mail invalid';
                                    } else {
                                        document.getElementById("email_err_" + i).innerHTML = '';
                                    }
                                }
                            }
                            , error: function(error) {
                                console.log(error);
                            }
                        });
                    }

                    if ($("#cin_" + i).val() != null) {
                        var cin = $("#cin_" + i).val();
                        document.getElementById("cin_err_" + i).innerHTML = '';

                        $.ajax({
                            url: "{{route('employes.export.verify_cin_stg')}}"
                            , type: 'get'
                            , data: {
                                valiny: cin
                            }
                            , success: function(response) {
                                var userData = response;
                                if (userData.length > 0) {

                                    document.getElementById("cin_err_" + i).innerHTML = "CIN existe déjà";
                                    /*                if ($("matricule_err_" + i).html() == '' &&
                                                        $("email_err_" + i).html() == '' ) {
                                                        $('#saver_multi_stg').prop('disabled', false);
                                                    } else {
                                                        $('#saver_multi_stg').prop('disabled', true);
                                                    } */
                                } else {
                                    document.getElementById("cin_err_" + i).innerHTML = '';
                                }
                            }
                            , error: function(error) {
                                console.log(error);
                            }
                        });
                    }
                }



            }
        });


    });


    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

</script>

@endsection
