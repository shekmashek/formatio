@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 mt-4">
            {{-- <div class="card"> --}}
                {{-- <div class="card-header">{{ __('Reset Password') }}</div> --}}

                {{-- <div class="card-body"> --}}
                    
                    <div class=" p-3 mb-3 bg-body rounded bg-white " style="width:600px; box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;height:430px">
                        <div class="text-center mt-4">
                            <img src="{{ asset('img/images/logo_fmg54Ko.png') }}" alt="background" class="img-fluid" style="height:100px;width:100px;">
                        </div><br>
                        <span class="ms-5" style="color: rgb(116, 116, 116)">Veuillez vous saisir l'adresse e-mail afin d'avoir récupéré votre mot de passe !</span>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <hr style="color: rgb(209, 209, 209); width:350px;margin-start:95px;margin-top:35px">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group row mt-5">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adresse e-Mail') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 my-4">
                            {{-- <div class="col-md-12 offset-4 "> --}}
                            <div class="col-md-12 text-center ">
                                <button type="submit" class="btn btn_enregistrer" role="button"><i class="bx bx-check me-1"></i> valider</button>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection
