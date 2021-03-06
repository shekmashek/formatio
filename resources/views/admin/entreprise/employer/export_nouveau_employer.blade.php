@extends('./layouts/admin')
@section('title')
<h3 class="text_header m-0 mt-1">Import Excel Employé</h3>
@endsection
@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<script src="{{asset('assets/js/jquery.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>

<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">

<?php
$nbStg=30;
?>


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
        border: none;
        text-align: center
    }

    .form_colab input:focus {
        border: none;
        outline: none;
        box-shadow: none;
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

    td {
        padding: 0 !important;
        height: 30px !important;
    }

</style>

<div class="container-fluid">

    <div class="row g-0">

        <div class="m-4">

            <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
                <li class="nav-item">
                    <a href="{{route('employes.liste')}}" class="nav-link">
                        employé
                    </a>
                </li>
                @canany(['isReferent','isReferentSimple'])
                <li class="nav-item">
                    <a href="{{route('employes.new')}}" class="nav-link">
                        nouveau employé
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{route('employes.export.nouveau')}}" class="nav-link active">
                        import EXCEL employé
                    </a>
                </li>
                @endcanany
                <li class="nav-item">
                    <a href="{{route('employes.liste_referent')}}" class="nav-link">
                    Référents
                    </a>
                </li>
            </ul>
        </div>

        <div class="row mt-1 justify-content-center  export_excel" align="center">
            <div class="col text-muted text-align-center">
                <h6>Comment ajouter plusieurs stagiaires d'une seule coup?</h6>
                <p>Tout d'abord, vous devrez avoir un fichier excel des listes des stagiaires avec des exception comportant seulement ses colonnes requis pour les informations minimum:</p>
                <p>1°):<span> Maximum {{$nbStg}} personne(s) </span></p>
                <p>2°):Les champs neccéssaire: <span> "Matricule" , "Nom", "Prénom", "CIN", "email"</span></p>
                <p>3°): Faire <span>copier coller </span> les données en sélectionnants la prémière ligne "Matricule N°1" ou utiliser la racourcie CRTL+A et CRTL+C (pour copier) et CRTL+V pour coller</p>
            </div>
            {{-- <div class="col-md-4"></div> --}}
        </div>

        <div class="row mt-2 justify-content-center">

            <div class="col jusitfy-content-center">
                <form name="formInsert" id="formInsert" action="{{route('save_multi_stagiaire_exproter_excel')}}" method="POST" enctype="multipart/form-data" class="form_insert_formateur form_colab  needs-validation" novalidate>
                    @csrf
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        <strong>{{Session::get('success')}}</strong>
                    </div>

                    @endif
                    @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{Session::get('error')}}
                    </div>
                    @endif

                    <div class="form-group mb-2" align="center">
                        <button type="submit" class="btn btn_creer" id="saver_multi_stg">sauvegarder</button>
                    </div>

                    <table id="example" class="table table-bordered">
                        <thead style="background-color: #6e717339">
                            <tr align="center">
                                <th>Matricule <span style="color: red">*</span> </th>
                                <th>Nom <span style="color: red">*</span> </th>
                                <th>Prénom</th>
                                <th>CIN <span style="color: red">*</span> </th>
                                <th>E-mail <span style="color: red">*</span> </th>
                            </tr>
                        </thead>
                        <tbody id="newRowMontant">

                            @for($i = 1; $i <= $nbStg; $i++) <tr align="center">
                                <td>
                                    <input autocomplete="off" class="form-control mx-0 " id="matricule_{{$i}}" type="text" name="matricule_[]">
                                    <p class="m-0" style="color: red" name="matricule_err_[]" id="matricule_err_[]"></p>
                                </td>
                                <td>
                                    <input autocomplete="off" class="form-control" id="nom_" type="text" name="nom_[]">
                                    <p class="m-0" style="color: red" name="nom_err_[]" id="nom_err_[]"></p>
                                </td>
                                <td>
                                    <input autocomplete="off" class="form-control" id="inlineFormInput" type="text" name="prenom_[]">
                                </td>
                                <td>
                                    <input autocomplete="off" class="form-control" id="cin_[]" type="text" name="cin_[]">
                                    <p class="m-0" style="color: red" name="cin_err_[]" id="cin_err_[]"></p>
                                </td>
                                <td>
                                    <input autocomplete="off" class="form-control" type="email" id="email_{{$i}}" name="email_[]">
                                    <p class="m-0" name="email_err_[]" style="color: red" id="email_err_[]"></p>
                                </td>
                                </tr>
                                @endfor

                        </tbody>
                    </table>
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

    function verifyDuplicate(table, error) {
        var arryTab = [];
        var test = 0;
        for (var i = 0; i < table.length; i += 1) {
            if (table[i].value != null && table[i].value != "" && table[i].value.length > 0) {
                arryTab[i] = table[i].value;
                test += 1;
            }
        }
        for (var i = 0; i < arryTab.length; i += 1) {
            for (var j = i + 1; j < arryTab.length; j += 1) {
                if (arryTab[i] == arryTab[j] && arryTab[j] != null && arryTab[i] != null) {
                    error[i].innerHTML = "donnée dupliqué";
                    error[j].innerHTML = "donnée dupliqué";
                    $('#saver_multi_stg').prop('disabled', true);
                }
            }
        }
    }


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


    $(function() {
        $("input[name='cin_[]']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    });

    /*================================ verify champ inscription =====================================*/

    $(document).ready(function() {
        $('#saver_multi_stg').prop('disabled', true);
        $('#formInsert input').keyup(function() {
            $('#saver_multi_stg').prop('disabled', false);

            var nom_err = document.getElementsByName("nom_err_[]");
            var matricule_err = document.getElementsByName("matricule_err_[]");
            var email_err = document.getElementsByName("email_err_[]");
            var cin_err = document.getElementsByName("cin_err_[]");

            var nom = document.getElementsByName("nom_[]");
            var matricule = document.getElementsByName("matricule_[]");
            var email = document.getElementsByName("email_[]");
            var cin = document.getElementsByName("cin_[]");

            for (let i = 0; i < matricule.length; i += 1) {
                var matricule_val = matricule[i].value;


                if (matricule[i].value != null) {

                    if (matricule[i].value != "" && matricule[i].value.length < 1 && email[i].value != "") {
                        matricule_err[i].innerHTML = 'matricule invalid';
                    } else {
                        matricule_err[i].innerHTML = '';
                        verifyDuplicate(matricule, matricule_err);
                    }


                    $.ajax({
                        url: "{{route('employes.export.verify_matricule_stg')}}"
                        , type: 'get'
                        , data: {
                            valiny: matricule_val
                        }
                        , success: function(response) {
                            var userData = response;
                            if (userData.length > 0) {
                                matricule_err[i].innerHTML = 'matricule existe déjà';
                                $('#saver_multi_stg').prop('disabled', true);
                            }
                        }
                        , error: function(error) {
                            console.log(error);
                        }
                    });

                    /*==============*/
                    if (matricule[i].value.length > 0) {
                        if (matricule[i].value != null && matricule[i].value != "") {
                            if (nom[i].value.length < 1) {
                                nom_err[i].innerHTML = 'Nom ne doit pas être null';
                                $('#saver_multi_stg').prop('disabled', true);
                            }
                        }
                    } else {
                        nom_err[i].innerHTML = '';

                    }

                    /*=============*/
                    if (email[i].value != null) {
                        var email_val = email[i].value;
                        if (matricule[i].value.length > 0) {
                            if (matricule[i].value != null && matricule[i].value != "") {
                                if (email[i].value.indexOf('@') == -1) {
                                    email_err[i].innerHTML = 'E-mail invalid';
                                    $('#saver_multi_stg').prop('disabled', true);
                                } else {
                                    email_err[i].innerHTML = '';
                                    verifyDuplicate(email, email_err);
                                }
                            }
                        } else {
                            email_err[i].innerHTML = '';

                        }

                        $.ajax({
                            url: "{{route('employes.export.verify_email_stg')}}"
                            , type: 'get'
                            , data: {
                                valiny: email_val
                            }
                            , success: function(response) {
                                var userData = response;
                                if (userData.length > 0) {
                                    email_err[i].innerHTML = 'E-mail existe déjà';
                                    $('#saver_multi_stg').prop('disabled', true);
                                }
                            }
                            , error: function(error) {
                                console.log(error);
                            }
                        });

                    }
                    /*=============*/
                    if (cin[i].value != null) {
                        var cin_val = cin[i].value;
                        if (matricule[i].value.length > 0) {
                            if (matricule[i].value != null && matricule[i].value != "") {
                                if (cin[i].value.length < 5) {
                                    cin_err[i].innerHTML = 'CIN invalid';
                                    $('#saver_multi_stg').prop('disabled', true);
                                } else {
                                    cin_err[i].innerHTML = '';
                                    verifyDuplicate(cin, cin_err);
                                }
                            }
                        } else {
                            cin_err[i].innerHTML = '';
                        }

                        /*=== verify duplication ===========*/

                        $.ajax({
                            url: "{{route('employes.export.verify_cin_stg')}}"
                            , type: 'get'
                            , data: {
                                valiny: cin[i].value
                            }
                            , success: function(response) {
                                var userData = response;
                                if (response.error != null) {
                                    cin_err[i].innerHTML = response.error;
                                    $('#saver_multi_stg').prop('disabled', true);
                                }
                                /*  if (userData.length > 0) {
                                      cin_err[i].innerHTML = "CIN existe déjà";
                                      $('#saver_multi_stg').prop('disabled', true);
                                  } */
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

</script>

@endsection
