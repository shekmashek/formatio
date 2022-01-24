<link rel="stylesheet" href="{{asset('css/profil_formateur.css')}}">

<link rel="shortcut icon" href="{{  asset('maquette/real_logo.ico') }}" type="image/x-icon">
<title> formation.mg </title>
{{-- catalogue --}}
<!-- Bootstrap Core CSS -->
<link href="{{asset('bootstrapCss/css/bootstrap.min.css')}} " rel="stylesheet">

{{-- Boxicon --}}
<link href="{{asset('assets/css/boxicons.min.css')}} " rel="stylesheet">

<!-- Custom CSS -->
<link href="{{asset('assets/css/chart_et_font.css')}}" rel="stylesheet">

<!-- Custom Fonts -->
<link href="{{asset('assets/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

<!-- full calendar -->
<link href="{{asset('assets/fullcalendar/lib/main.css')}}" rel='stylesheet' />
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap5.min.css">
<link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

<link rel="stylesheet" href="{{asset('../assets/css/smooth_page.css')}}">

{{-- link fontawesome_all --}}
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<link rel="stylesheet" href="{{asset('css/qcmStep.css')}}">

</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="col-12">
                    <div class="img_top mt-4 text-center">
                        <img src="{{ asset('img/images/logo_fmg54Ko.png') }}" alt="background" class="img-fluid" style="width: 8rem; height: 8rem;">
                    </div>
                </div>
                <h2>Inscrivez gratuitement votre centre de formation sur <strong>formation.mg</strong></h2>
                <form action="{{route('create_facture')}}" id="msform" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- progressbar -->
                    <ul id="progressbar" class="mb-1">
                        <li class="active" id="etape1"></li>
                        <li id="etape2"></li>
                        <li id="etape3"></li>
                        <li id="etape4"></li>
                    </ul> <!-- fieldsets -->

                    <div id="formulaire">

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            <div class="row">
                                <div class="col">
                                    <h3 class="position-center">Vous êtes ?<strong style="color:#ff0000;">*</strong></h3>
                                    <h6 style="color: black">Formulaire dédié aux Employeur et Organisation de Formation. Si vous cherchez une formation c'est par <a href="#" style="color: blue">ICI</a></h6>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <select class="form-select" aria-label="Default select example" name="entreprise_id" id="entreprise_id">
                                        <option value="null" disabled selected hidden>Veuillez Sélectionner</option>
                                        <option value="">Organisation de Formation (OF)</option>
                                        <option value="">Employeur (responsable de l'entreprise)</option>
                                    </select>
                                </div>
                            </div>

                            <input type="button" name="next" class="next action-button" style="background-color: red" value="Suivant" />
                        </fieldset>

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            <h3 class="">Veuillez entrer le nom de votre entreprise</strong></h3>

                            <label for="exampleFormControlInput1" class="form-label">Non de l'entreprise<strong style="color:#ff0000;">*</strong></label>
                            <input type="text" name="num_facture" class="form-control" id="num_facture" placeholder="Non" />
                            <span style="color:#ff0000;" id="num_facture_err"></span>

                            <input type="button" name="previous" class="previous action-button-previous" style="background-color: red" value="Précedent" />
                            <input type="button" name="next" class="next action-button" style="background-color: red" value="Suivant" />

                        </fieldset>

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            <h3 class="">Veuillez certifier que vous etes la responsable de <strong>Cotona</strong></h3>
                            <p>veuillez renseigner:</p>
                            <div class="row">
                                <div class="form-ground">
                                    <label for="exampleFormControlInput1" class="form-label " align="left">Non<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" name="num_facture" class="form-control" id="num_facture" />
                                    <span style="color:#ff0000;" id="num_facture_err"></span>
                                </div>
                                <div class="form-ground">
                                    <label for="exampleFormControlInput1" class="form-label" align="left">Prénom<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" name="num_facture" class="form-control" id="num_facture" />
                                    <span style="color:#ff0000;" id="num_facture_err"></span>
                                </div>
                                <div class="form-ground">
                                    <label for="exampleFormControlInput1" class="form-label" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" name="num_facture" class="form-control" id="num_facture" />
                                    <span style="color:#ff0000;" id="num_facture_err"></span>
                                </div>
                                <div class="form-ground">
                                    <label for="exampleFormControlInput1" class="form-label" align="left">Email<strong style="color:#ff0000;">*</strong></label>
                                    <input type="email" name="num_facture" class="form-control" id="num_facture" />
                                    <span style="color:#ff0000;" id="num_facture_err"></span>
                                </div>
                                <div class="form-ground">
                                    <label for="exampleFormControlInput1" class="form-label" align="left">Télephone<strong style="color:#ff0000;">*</strong></label>
                                    <input type="text" name="num_facture" class="form-control" id="num_facture" />
                                    <span style="color:#ff0000;" id="num_facture_err"></span>
                                </div>

                            </div>

                            <input type="button" name="previous" class="previous action-button-previous" style="background-color: red" value="Précendent" />
                            <input type="button" name="make_payment" class="next action-button" style="background-color: red" value="Suivant" />
                        </fieldset>

                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            <h5 class="">Après avoir remplir notre condition,vous pouvez maitenant activier votre.</strong></h5>
                            <h6>Avant d'activer votre,veuillez bien revérifier votre données!</h6>
                            <button type="submit" class="btn btn-danger">Activation</button>
                        </fieldset>

                    </div>



                </form>

            </div>

            <div class="col-md-3"></div>
        </div>
    </div>


    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>

    {{-- JQuery --}}
    <script src="{{asset('bootstrapCss/js/bootstrap.bundle.js')}}"></script>
    <script src="{{asset('assets/js/boxicons.js')}}"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('assets/js/startmin.js')}}"></script>
    <script src="{{asset('assets/fullcalendar/lib/main.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

    <script src="{{asset('assets/js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>
    <script src="{{ asset('function js/programme/edit_programme.js') }}"></script>
    <script src="{{asset('js/qcmStep.js')}}"></script>

</body>
</html>
