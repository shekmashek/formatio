@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('css/facture.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControlFactures.css')}}">
<div id="page-wrapper">

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                <li class="nav-item btn_next">
                                    <a class="nav-link  {{ Route::currentRouteNamed('liste_facture') || Route::currentRouteNamed('liste_facture') ? 'active' : '' }}" href="{{route('liste_facture')}}">Liste des Factures</a>
                                </li>
                                @canany(['isSuperAdmin','isCFP'])
                                <li class="nav-item btn_next">
                                    <a class="nav-link  {{ Route::currentRouteNamed('facture') ? 'active' : '' }}" href="{{route('facture')}}">Nouveau Facture</a>
                                </li>
                                @endcanany
                            </ul>

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>



    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2><strong>Creation facture</strong></h2>
                <p>Assistant de création de facture</p>

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
                @if(Session::has('error_facture'))
                <div class="alert alert-danger">
                    {{Session::get('error_facture')}}
                </div>
                @endif
                @error('invoice_date')
                <span style="color:#ff0000;"> {{$message}} </span>
                @enderror
                @error('due_date')
                <span style="color:#ff0000;"> {{$message}} </span>
                @enderror
                @if(Session::has('num_facture'))
                <div class="alert alert-danger">
                    {{Session::get('num_facture')}}
                </div>
                @endif
                @error('down_bc')
                <span style="color:#ff0000;"> {{$message}} </span>
                @enderror
                @error('down_fa')
                <span style="color:#ff0000;"> {{$message}} </span>
                @enderror
                @error('num_facture')
                <span style="color:#ff0000;"> {{$message}} </span>
                @enderror

            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">

                <form action="#" id="msform_facture">
                    @csrf

                    <ul id="progressbars">
                        <li class="active" id="etape1"></li>
                        <li class="active" id="etape2"><strong></strong></li>
                        <li class="active" id="etape3"><strong></strong></li>
                        <li class="active" id="etape4"><strong></strong></li>
                        <li class="active" id="etape5"><strong></strong></li>
                        <li class="active" id="etape6"><strong></strong></li>
                    </ul>

                    <div id="formulaire">


                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            {{-- <div class="form-card"> --}}
                            <h2 class="fs-title text-center">Bravo ! les champs sont complet</h2> <br><br>
                            <div class="row justify-content-center">
                                <div class="col-3">
                                    <div class="form-group">
                                        <img src="{{asset('img_create-compte/terminer.png')}}" class="fit-image" style="width: 300px; heigth: 300px">
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-7 text-center">
                                        <a href="{{route('liste_facture')}}"> <button type="button" class="action-button">Terminer</button> </a>
                                    </div>
                                </div>
                        </fieldset>


                    </div>
                    {{-- </form> --}}

            </div>
        </div>

    </div>




</div>


@endsection



<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{asset('js/facture.js')}}"></script>
