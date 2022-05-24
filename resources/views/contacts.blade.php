@extends('./layouts/admin')
@section('content')

@section('title')
<p class="text_header m-0 mt-1">Contact </p>
@endsection

<script src="{{ asset('maquette/javascript.js') }}"></script>
<link rel="shortcut icon" href="{{  asset('maquette/logo_fmg7635dc.png') }}" type="image/x-icon">
<link rel="stylesheet" href="{{asset('assets/css/index_accueil.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
           
            <main class="mt-5">
                <div class="container pt-5 contact_content pb-5">
                    <h1 class="p-0 m-0 text-center mb-5">Nous contacter</h1>
                    <div class="row">
                        {{-- <div class="col-lg-4 d-flex flex-column">
                            <span><i class="fa fa-map-marker text mt-3 me-3 ms-1" aria-hidden="true"></i>II N 60 A Analamahitsy
                                <br> 101 Antananarivo Madagascar.</span>
                            <span><i class="fa fa-envelope text mt-3 me-3" aria-hidden="true"></i>contact@numerika.center</span>
                            <span><i class="fa fa-phone text mt-3 me-3"
                                    aria-hidden="true"></i>+261&nbsp;33&nbsp;23&nbsp;135&nbsp;63</span>
                        </div> --}}
                        <div class="col-12">
                            @if(session()->has('message'))
                            <div class="alert alert-success">
                                {{ session()->get('message') }}
                            </div>
                            @endif
                            <form method="POST" action="{{route('contacter')}}" enctype="multipart/form-data">
                                <div class="row contact_form">
                                    <div class="col-lg-6">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control input" name="name" id="input" autocomplete="off" required>
                                            <label for="input" class="form-control-placeholder">Nom</label>
                                            @error('name')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control input" name="entreprise" autocomplete="off" required>
                                            <label for="input" class="form-control-placeholder">Entreprise</label>
                                            @error('entreprise')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="mail" class="form-control input" name="mail" autocomplete="off" required>
                                            <label for="input" class="form-control-placeholder">Email</label>
                                            @error('mail')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
        
                                        <div class="form-group">
                                            <input type="text" class="form-control input" name="objet" autocomplete="off" required>
                                            <label for="input" class="form-control-placeholder">Objet</label>
                                            @error('objet')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
        
                                    <div class="form-group">
                                        <textarea type="text" class="form-control text_area" name="msg" autocomplete="off" required></textarea>
                                        <label for="input" class="form-control-placeholder-text_area">Votre message...</label>
                                        @error('msg')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="text-center mb-3">
                                        <p style="text-center">Captcha</p>
                                        0 + <input type="text" name="input" autocomplete="off" style="width: 25px;height:25px"
                                            required>
                                        = 7
                                    </div>
                                    <button class="btn commencer text-center" type="submit">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
@endsection