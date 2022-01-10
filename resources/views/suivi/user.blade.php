@extends('layouts.apps')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <span >Enregistré avec succcès</span><br>
                    <span>Cliquez sur "Register" pour enregistrer un autre utilisateur</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
