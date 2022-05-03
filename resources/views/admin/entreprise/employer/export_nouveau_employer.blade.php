@extends('./layouts/admin')
@section('title')
<h3 class="text_header m-0 mt-1">Export Excel nouveau stagiaire</h3>
@endsection
@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

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
        width: auto;
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

</style>

<div class="container-fluid">

    <div class="row">
        <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
            <li class="nav-item">
                <a href="{{route('employes.liste')}}" class="nav-link">
                    liste des employers
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('departement.create')}}" class="nav-link">
                    nouveau
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('employes.export.nouveau')}}" class="nav-link active">
                    export employer
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
            <p>3°): Faire <span>copier coller </span> les données en sélectionnants la prémière ligne ou utiliser la racourcie CRTL+A et CRTL+C (pour copier) et CRTL+V pour coller</p>
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
                                    <input class=" ml-2 form-control form-control-sm" id="matricule_{{$i}}" type="text" name="matricule_{{$i}}" placeholder="Matricule N° {{$i}}">
                                <span style="color: red" id="matricule_err_"></span>
                                <div class="invalid-feedback">
                                    Please choose a matricule.
                                  </div>
                                </div>
                            </td>
                            <td>
                                {{-- <div class="form-group"> --}}
                                <input class="form-control" id="nom_{{$i}}" type="text" name="nom_{{$i}}" placeholder="Nom">
                                {{-- </div> --}}
                            </td>
                            <td>
                                <div class="input-group">
                                    <input class="form-control" id="inlineFormInput" type="text" name="prenom_{{$i}}" placeholder="Prénom">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input class="form-control" id="cin_{{$i}}" type="text" name="cin_{{$i}}" placeholder="CIN">
                                </div>
                            </td>
                            <td>
                                <div class="input-group">
                                    <input class="form-control" type="email" id="email_{{$i}}" name="email_{{$i}}" placeholder="E-mail">
                                </div>
                            </td>
                            </tr>
                            @endfor

                    </tbody>
                </table>
                <div class="form-group mt-2" align="center">
                    <button type="submit" class="btn btn_creer">sauvegarder</button>

                </div>
            </form>
        </div>
    </div>
</div>

{{--
<form class="row g-3 needs-validation" novalidate>
    <div class="col-md-4">
      <label for="validationCustom01" class="form-label">First name</label>
      <input type="text" class="form-control" id="validationCustom01" value="Mark" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4">
      <label for="validationCustom02" class="form-label">Last name</label>
      <input type="text" class="form-control" id="validationCustom02" value="Otto" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4">
      <label for="validationCustomUsername" class="form-label">Username</label>
      <div class="input-group has-validation">
        <span class="input-group-text" id="inputGroupPrepend">@</span>
        <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
        <div class="invalid-feedback">
          Please choose a username.
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <label for="validationCustom03" class="form-label">City</label>
      <input type="text" class="form-control" id="validationCustom03" required>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
    <div class="col-md-3">
      <label for="validationCustom04" class="form-label">State</label>
      <select class="form-select" id="validationCustom04" required>
        <option selected disabled value="">Choose...</option>
        <option>...</option>
      </select>
      <div class="invalid-feedback">
        Please select a valid state.
      </div>
    </div>
    <div class="col-md-3">
      <label for="validationCustom05" class="form-label">Zip</label>
      <input type="text" class="form-control" id="validationCustom05" required>
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
    <div class="col-12">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
        <label class="form-check-label" for="invalidCheck">
          Agree to terms and conditions
        </label>
        <div class="invalid-feedback">
          You must agree before submitting.
        </div>
      </div>
    </div>
    <div class="col-12">
      <button class="btn btn-primary" type="submit">Submit form</button>
    </div>
  </form> --}}
</div>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $(document).ready(function() {

        $('td input').bind('paste', null, function(e) {
            $txt = $(this);
            setTimeout(function() {

                // var values = $txt.val().split(/\s+/);
                var values = $txt.val().split(/\t+/);
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




    $('#liste_etp').on('change', function() {
        $('#departement_id').empty();
        var id = $(this).val();
        $.ajax({
            url: "{{route('show_dep')}}"
            , type: 'get'
            , data: {
                id: id
            }
            , success: function(response) {
                var userData = response;
                for (var $i = 0; $i < userData.length; $i++) {
                    $("#departement_id").append('<option value="' + userData[$i].id + '">' + userData[$i].departement.nom_departement + '</option>');
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });

    });

    /*================================ verify champ inscription =====================================*/

    $(document).ready(function() {

  /*      $('#suivant_etp_1').prop('disabled', true);
        document.getElementById("nif_etp_err").innerHTML = "NIF incomplète!";
        document.getElementById("matricule_resp_etp_err").innerHTML = "Matricule ne doit pas être null!";
        $('#suivant_etp_confirmer').prop('disabled', true);
*/
        // ========= field N°1 et N°2 pour entreprise inscription =================================
/*
        $('#formInsert input').change(function() {

            for (let i = 1; i <= 30; i += 1) {
                if($("#matricule_"+i).val()!=null){
                    let names = "#matricule_err_"+i;
                    document.getElementById("error_logo_etp").innerHTML == '';

                }
            }
        });


    });
*/

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
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
