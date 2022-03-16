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


        {{-- <div class="card">
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


        </div> --}}
        <div class="row justify-content-center" id="msform_facture">
            <ul id="progressbars" class="mb-1">
                <li class="active" id="etape1"></li>
                <li  class="active" id="etape2"></li>
                <li  class="active" id="etape3"></li>
            </ul>
            <div class="col-md-12">

                <div id="formulaire">
                    <fieldset class="shadow p-3 mb-5 bg-body rounded">
                        <h5 align="left" class="mb-2">Félicitation, pour activer votre, veuillez confirmé votre insciption</strong></h5>
                        <div class="form-group">
                            <img src="{{asset('img_create-compte/terminer.png')}}" class="fit-image" style="width: 300px; heigth: 300px">
                        </div>
                        <a href="{{route('sign-in')}}">
                            <button type="button" style="background: #801D68; leight: 10px; padding: 5px 5px 5px 5px; color:white">Terminé</button>
                        </a>
                    </fieldset>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
@extends('create_compte.footer')
