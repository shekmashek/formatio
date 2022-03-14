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

                <form action="{{route('create_facture')}}" id="msform_facture" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- <ul id="progressbars">
                    <li class="active" id="etape1"></li>
                    <li id="etape2"><strong></strong></li>
                    <li id="etape3"><strong></strong></li>
                    <li id="etape4"><strong></strong></li>
                    <li id="etape5"><strong></strong></li>
                    <li id="etape6"><strong></strong></li>
                </ul> --}}
                    <div id="formulaire">
                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            {{-- <div class="form-card"> --}}
                            <h4 align="left" class="mb-2">Inserer les dates:</h4>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" required class="form-control input" id="exampleFormControlInput1" name="invoice_date" id="invoice_date" onfocus="(this.type='date')">
                                        <label for="invoice_date" class="form-control-placeholder">Date création Facture<strong style="color:#ff0000;">*</strong></label>

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" required class="form-control input" name="due_date" id="due_date" onfocus="(this.type='date')">
                                        <label for="due_date" class="form-control-placeholder">Durer de Date<strong style="color:#ff0000;">*</strong></label>

                                    </div>
                                </div>
                            </div>

                            <h4 align="left" class="mb-2">Montant Facture</h4>
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
                                        <label for="due_date" class="form-control-placeholder">Durer de Date<strong style="color:#ff0000;">*</strong></label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" value="text description" required class="form-control input" name="due_date" id="desc">
                                        <label for="desc" class="form-control-placeholder">Durer de Date<strong style="color:#ff0000;"></strong></label>
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

                            <h4 align="left" class="mb-2">Montant Frais Annexes</h4>
                            <div class="row justify-content" id="inputFormRow">
                                <div class="col">
                                    <label class="visually" for="specificSizeSelect">Type frais annexe<strong style="color: red">*</strong> </label>
                                    <select class="form-select mt-1" id="frais" name="frais_annexe_id[]" id="specificSizeSelect">
                                        <option value="1">Session 1</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label class="visually" for="specificSizeInputName">PU(Ariary)<strong style="color: red">*</strong></label>
                                    <input type="number" min="0" value="500000" name="montant_frais_annexe[]" class="form-control" id="specificSizeInputName" placeholder="0">
                                </div>
                                <div class="col">
                                    <label class="visually" for="specificSizeInputName">Description</label>
                                    <input type="text" value="text description" name="description_annexe[]" class="form-control" id="specificSizeInputName" placeholder="description">
                                </div>
                                <div class="col-auto">
                                    <div class="input-group-append">
                                        <label class="visually" for="specificSizeInputName">Qte<strong style="color: red">*</strong></label>
                                        <input type="number" min="1" value="10" name="qte_annexe[]" class="form-control" id="specificSizeInputName" placeholder="1">
                                    </div>
                                </div>
                            </div><br>


                        </fieldset>


                    </div>
                </form>
            </div>
        </div>

        <script src="{{asset('js/facture.js')}}"></script>
        @endsection
