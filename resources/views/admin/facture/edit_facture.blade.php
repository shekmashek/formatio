@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('css/facture.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControlFactures.css')}}">
<div id="page-wrapper">

    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-12">
                    <br>
                    <h3> <strong>Modification du Détail Facture Brouillon</strong></h3>
                </div>

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                <li class="nav-item btn_next">
                                    <a class="nav-link  {{ Route::currentRouteNamed('liste_facture',2) || Route::currentRouteNamed('liste_facture',2) ? 'active' : '' }}" href="{{route('liste_facture',2)}}">
                                        Liste des Factures</a>
                                </li>

                                <li class="nav-item btn_next">
                                    <a class="nav-link  {{ Route::currentRouteNamed('facture') ? 'active' : '' }}" href="{{route('facture')}}">
                                        Nouveau Facture</a>
                                </li>

                            </ul>


                        </div>
                    </div>
                </nav>


            </div>
            <!-- /.row -->
            <div class="row">

            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="shadow p-3 mb-5 bg-body rounded">

                    <table class="table">
                        <thead>
                            <th>Numero Facture</th>
                            <th>Projet</th>
                            <th>Session</th>
                            <th>Entreprise</th>
                        </thead>
                        <td>
                            <strong>Fa-1</strong>
                        </td>
                        <td>projet-1</td>
                        <td>
                            <strong>Session 1</strong>
                        </td>
                        <td>
                            <strong>COLAS</strong>
                        </td>
                    </table>

                    <form action="{{route('create_facture')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h5 align="left" class="mb-2">Inserer les dates:</h5>

                        <div class="row justify-content" id="inputFormRow">
                            <div class="col-3">
                                <div class="form-group">
                                    <input type="text" required class="form-control input" id="exampleFormControlInput1" name="invoice_date" id="invoice_date" onfocus="(this.type='date')">
                                    <label for="invoice_date" class="form-control-placeholder">Date création Facture<strong style="color:#ff0000;">*</strong></label>

                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <input type="text" required class="form-control input" name="due_date" id="due_date" onfocus="(this.type='date')">
                                    <label for="due_date" class="form-control-placeholder">Durer de Date<strong style="color:#ff0000;">*</strong></label>

                                </div>
                            </div>
                        </div>

                        <h5 align="left" class="mb-2">Montant Facture</h5>
                        <div class="row justify-content" id="inputFormRow">
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-select selectP input" id="frais_annexe_id[]" name="frais_annexe_id[]" aria-label="Default select example">
                                        <option value="1">Session 1</option>
                                    </select>
                                    <label class="ml-3 form-control-placeholder" for="frais_annexe_id[]">Type frais annexe<strong style="color: red">*</strong> </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" min="0" value="500000" required class="form-control input" name="due_date" id="due_date">
                                    <label for="due_date" class="form-control-placeholder">PU(Ariary)<strong style="color:#ff0000;">*</strong></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" value="text description" required class="form-control input" name="due_date" id="desc">
                                    <label for="desc" class="form-control-placeholder">Description<strong style="color:#ff0000;"></strong></label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="input-group-append">
                                    <div class="form-group">
                                        <input type="number" min="1" value="2" required class="form-control input" name="due_date" id="due_date">
                                        <label for="due_date" class="form-control-placeholder">Qte<strong style="color:#ff0000;">*</strong></label>
                                    </div>
                                </div>
                            </div>
                        </div><br>

                        <h5 align="left" class="mb-2">Montant Frais Annexes Existant</h5>
                        <div class="row justify-content" id="inputFormRow">
                            <div class="col">
                                <div class="form-group">
                                    <select class="form-select selectP input" id="frais_annexe_id[]" name="frais_annexe_id[]" aria-label="Default select example">
                                        <option value="1">Session 1</option>
                                    </select>
                                    <label class="ml-3 form-control-placeholder" for="frais_annexe_id[]">Type frais annexe<strong style="color: red">*</strong> </label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="number" min="0" value="500000" required class="form-control input" name="due_date" id="due_date">
                                    <label for="due_date" class="form-control-placeholder">PU(Ariary)<strong style="color:#ff0000;">*</strong></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" value="text description" required class="form-control input" name="due_date" id="desc">
                                    <label for="desc" class="form-control-placeholder">Description<strong style="color:#ff0000;"></strong></label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="input-group-append">
                                    <div class="form-group">
                                        <input type="number" min="1" value="2" required class="form-control input" name="due_date" id="due_date">
                                        <label for="due_date" class="form-control-placeholder">Qte<strong style="color:#ff0000;">*</strong></label>
                                    </div>
                                </div>
                            </div>
                        </div><br>


                        <div class="row">
                            <div class="col">
                                <h5 align="left" class="mb-2" style="color: green">Montant Frais Annexes Existant</h5>
                            </div>
                            <div class="col-auto">
                                <button id="addRow" type="button" class="btn btn_next" style="color: green">Ajouter Frais Annexe</button>
                            </div>
                        </div>
                        <div id="newRow" class="mt-2"></div>

                    </form>
                </div>
            </div>
        </div>

        <script src="{{ asset('assets/js/jquery.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{asset('js/facture.js')}}"></script>


        <script type="text/javascript">
            // add row
            $(document).on('click', '#addRow', function() {
                $('#frais').empty();
                $.ajax({
                    url: "{{route('frais_annexe')}}"
                    , type: 'get'
                    , success: function(response) {

                        var userData = response;
                        for (var $i = 0; $i < userData.length; $i++) {
                            $("#frais").append('<option value="' + userData[$i].id + '">' + JSON.stringify(userData[$i].description) + '</option>');
                        }
                    }
                    , error: function(error) {
                        console.log(error);
                    }
                });

                $.ajax({
                    url: "{{route('frais_annexe')}}"
                    , type: 'get'
                    , success: function(response) {
                        var userData = response;
                        var html = '';


                        html += '<div class="row justify-content" id="inputFormRow">';
                        html += '<div class="col"><div class="form-group">';
                        html += '<select class="form-select selectP input"  id="frais_annexe_id[]" name="frais_annexe_id[]">';

                        for (var $i = 0; $i < userData.length; $i++) {
                            html += '<option value="' + userData[$i].id + '">' + userData[$i].description + '</option>';
                        }
                        html += '</select>';
                        html += '<label class="ml-3 form-control-placeholder" for="frais_annexe_id[]">Type frais annexe<strong style="color: red">*</strong> </label>';
                        html += '</div></div>';


                        html += '<div class="col"><div class="form-group">';
                        html += '<input type="number" min="0" value="0" name="montant_frais_annexe[]" class="form-control input" id="montant_frais_annexe[]" placeholder="0">';
                        html += ' <label for="montant_frais_annexe[]" class="form-control-placeholder">PU(Ariary)<strong style="color:#ff0000;">*</strong></label>';
                        html += '</div></div>';


                        html += '<div class="col"><div class="form-group">';
                        html += '<input type="text" name="description_annexe[]" class="form-control input" id="description_annexe[]" placeholder="description">';
                        html += '<label class="form-control-placeholder" for="description_annexe[]">Description</label>';
                        html += '</div></div>';

                        html += '<div class="col-auto"><div class="form-group">';
                        html += '<input type="number" min="1" value="2" required class="form-control input" name="qte_annexe[]" id="qte_annexe[]">';
                        html += '<label class="form-control-placeholder" for="qte_annexe[]">Qte<strong style="color: red">*</strong></label>';
                        html += '</div></div>';

                        html += '<div class="col-auto"><div class="form-group">';
                        html += '<button id="removeRow" type="button" class="btn btn-danger"  style="position:relative; top: 2.3rem"><i class="fa fa-trash"></i></button>';
                        html += '</div></div>';
                        html += '</div><br>';

                        $('#newRow').append(html);


                    }
                    , error: function(error) {
                        console.log(error);
                    }
                });

            });

            // remove row
            $(document).on('click', '#removeRow', function() {
                $(this).closest('#inputFormRow').remove();
            });

        </script>
        @endsection
