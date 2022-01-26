<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
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
                <h2>Inscrivez gratuitement vos information sur <strong>formation.mg</strong></h2>
                <p>Si vous voulez créer un compte,cliquer <a href="{{route('create+compte+client')}}" style="color: blue">ICI.  </a>Si vous voulez vous connectez,cliquer <a href="{{route('sign-in')}}" style="color: blue">ICI</a></p>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
    @yield('content')
