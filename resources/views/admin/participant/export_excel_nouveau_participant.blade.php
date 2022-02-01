@extends('./layouts/admin')
@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

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

</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <h3>EXPORT EXCEL NOUVEAUX STAGIAIRES</h3>
            </div>
        </div>

        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_participant') ? 'active' : '' }}" aria-current="page" href="{{route('liste_participant')}}">
                                    <i class="fa fa-list">Liste des stagiaires</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('nouveau_participant') ? 'active' : '' }}" aria-current="page" href="{{route('nouveau_participant')}}">
                                    <i class="fa fa-plus"> Nouveau stagiaire</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('export_excel_new_participant') ? 'active' : '' }}" aria-current="page" href="{{route('export_excel_new_participant')}}">
                                    <i class="fa fa-plus"> export participant</i></a>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-8">
                <h6>Comment ajouter plusieurs stagiaires d'une seule coup?</h6>
                <p>Tout d'abord, vous devrez avoir un fichier excel des listes des stagiaires avec des exception comportant seulement ses colonnes requis pour les informations minimum:</p>
                <p>1°):<strong> Maximum 30 personne(s) </strong></p>
                <p>2°):Les champs neccéssaire: <strong> "Matricule" , "Nom", "Prénom", " Genre ou Sexe (ex: F ou M)", "Date Naissance (ex:Jour/Mois/Année) ", "CIN", "email", " Télephone"," Fonction" </strong></p>
                <p>3°): Faire <strong>copier coller </strong> les données en sélectionnants la prémière ligne ou utiliser la racourcie CRTL+A et CRTL+C (pour copier) et CRTL+V pour coller</p>
            </div>
            {{-- <div class="col-md-4"></div> --}}
        </div>

        <div class="row mt-5">

            <h3>Nouveaux Stagiaires</h3>

            <div class="col-md-12 shadow p-3 mb-5 bg-body rounded">
                <form name="formInsert" id="formInsert" action="{{route('save_multi_stagiaire_exproter_excel')}}" method="POST" enctype="multipart/form-data" class="form_insert_formateur form_colab">
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

                    @canany(['isSuperAdmin','isAdmin'])
                    <div class="form-group">
                        <label for="etp">Entreprise</label><br>
                        <select name="liste_etp" class="form-control" id="liste_etp">
                            {{-- <option value="">Choisissez une entreprise...</option> --}}
                            @foreach ($liste_etp as $liste)
                            <option value="{{$liste->id}}">{{$liste->nom_etp}}</option>
                            @endforeach
                        </select>
                    </div><br>
            </div>
            <div class="form-group">
                <label for="etp">Departement</label><br>
                <select name="departement_id" class="form-control" id="departement_id">
                    {{-- <option value="">Choisissez un département...</option> --}}
                    @foreach ($liste_dep as $liste)
                    <option value="{{$liste->id}}">{{$liste->nom_departement}}</option>
                    @endforeach

                </select>
            </div><br>
            @endcanany
            @can('isReferent')
            <div class="form-group">
                <label for="etp">Departement</label><br>
                <select name="departement_id" class="form-control" id="departement_id">
                    {{-- <option value="">Choisissez un département...</option> --}}
                    @foreach ($liste_dep as $liste)
                    <option value="{{$liste->departement_id}}">{{$liste->nom_departement}}</option>
                    @endforeach
                </select>
            </div><br>
            @endcan

            @can('isManager')
            <div class="form-group">
                <label for="etp">Departement</label><br>
                <select name="departement_departement_" class="form-control" id="departement_id">
                    @foreach ($liste_dep as $liste)
                    <option value="{{$liste->departement_id}}">{{$liste->nom_departement}}</option>
                    @endforeach
                </select>
            </div><br>
            @endcan


                    {{-- <div class="form-group">
                        <label for="">Département</label>
                        <select name="departement_id" class="form-select" aria-label="Default select example">
                            @foreach ($liste_dep as $liste)
                            <option value="{{$liste->id}}">{{$liste->nom_departement}}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <table id="example" class="">
                        <thead>
                            <tr align="center">
                                <th>Matricule <strong style="color: red">*</strong> </th>
                                <th>Nom <strong style="color: red">*</strong> </th>
                                <th>Prénom <strong style="color: red">*</strong> </th>
                                <th>Sexe <strong style="color: red">*</strong> </th>
                                <th>Date de naissance <strong style="color: red">*</strong> </th>
                                <th>CIN <strong style="color: red">*</strong> </th>
                                <th>Email <strong style="color: red">*</strong> </th>
                                <th>Télephone <strong style="color: red">*</strong> </th>
                                <th>Fonction <strong style="color: red">*</strong> </th>
                            </tr>
                        </thead>
                        <tbody id="newRowMontant">

                            @for($i = 1; $i <= 30; $i++) <tr>
                                <td>
                                    <div class="input-group">
                                        <label  class=" m-0 mt-3 pt-1 pe-é"><strong class="m-0" style="color: black">{{$i}}</strong></label>
                                        {{-- <label class="input-group-text" id="inputGroup-sizing-default">{{$i}}</label> --}}
                                        <input class=" ml-2 form-control" type="text" name="matricule_{{$i}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="nom_{{$i}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="prenom_{{$i}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="sexe_{{$i}}" pattern="[A-Za-z' -]{1,1}" title="1 caractère">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="naissance_{{$i}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="cin_{{$i}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input class="form-control" type="email" name="email_{{$i}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="tel_{{$i}}">
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group">
                                        <input class="form-control" type="text" name="fonction_{{$i}}">
                                    </div>
                                </td>
                                </tr>
                                @endfor

                        </tbody>
                    </table>
                    <div class="form-group mt-5">
                        <button type="submit" class="btn btn-success">sauvegarder</button>

                    </div>
                </form>
            </div>
        </div>

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


    </script>

</div>
@endsection
