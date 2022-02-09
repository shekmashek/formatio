<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <link rel="stylesheet" href="{{asset('css/create_compte.css')}}">

</head>
<body class="m-0 p-0">

    <div class="container-fluid">
        <header>
            <nav class="navbar navbar-expand-lg" style="position:fixed top">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><img src="{{ asset('img/images/logo_fmg54Ko.png') }}" alt="background" class="img-fluid" style="width: 2.5rem; height: 2.5rem;">
                    </a>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">

                            </li>
                        </ul>

                    </div>
                </div>
            </nav>
        </header>


        <div class="row justify-content-center">
            {{-- <div class="col-md-2"></div> --}}
            <div class="col-md-8 ">

                @yield('content')

                <p class="mt-5">Vous avez un compte? Connectez-vous <a href="{{route('sign-in')}}" style="color: blue">ICI. </a></p>

            </div>
            {{-- <div class="col-md-2"></div> --}}
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
    <script src="{{asset('js/facture.js')}}"></script>

    <script type="text/javascript">
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        $(document).on('change', '#name_entreprise', function() {
            var id = $(this).val();
            // document.getElementById('name_entreprise_desc').value = id;
            document.getElementById('name_entreprise_desc').innerHTML = id;
            console.log(document.getElementById('name_entreprise_desc').value);
        });

        // ====== autoComplet Champs search nom entreprise

        $(document).ready(function() {


            $('#name_entreprise_search').autocomplete({


                source: function(request, response) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                        , type: 'GET'
                        , url: "{{route('search_entreprise_referent')}}"
                        , data: {
                            search: request.term
                        }
                        , success: function(data) {
                            response(data);
                        }
                    });
                }
                , minlength: 1
                , autoFocus: true
                , select: function(e, ui) {
                    $('#name_entreprise_search').val(ui.item.nom_resp);
                }

            });


        });

    </script>

</body>
</html>
