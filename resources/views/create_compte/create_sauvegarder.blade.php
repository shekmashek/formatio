@extends('create_compte.header')
@section('content')

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

<div class="row justify-content-center">
    <div class="col-md-12">


        <div class="card">
            <div class="row px-2">
                <div class="col">
                </div>
                <div class="col">
                    <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image">
                    <div class="d-grid gap-2 col-6 mx-auto mb-5">
                        <a href="{{route('sign-in')}}"><button class="btn btn-success" style="align: center">Termnié</button></a>
                    </div>
                </div>
                <div class="col">
                </div>
            </div>


        </div>
    </div>
</div>

@endsection
@extends('create_compte.footer')
