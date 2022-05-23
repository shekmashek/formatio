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

<div class="container felicitaton vh-100">
    <div class="row justify-content-center test">
        <div class="col-6">
            <div class="row justify-content-center align-items-center" id="msform_facture">
                {{-- <ul id="progressbars" class="mb-1">
                    <li class="active" id="etape1"></li>
                    <li class="active" id="etape2"></li>
                    <li class="active" id="etape3"></li>
                </ul> --}}
                <div class="col-md-12">

                    <div id="formulaire">
                        <fieldset class="shadow p-3 mb-5 bg-body rounded">
                            <h5 class="mb-5 text-center">Félicitation,votre compte a été creer,vous pouvez maintenant vous connecter à l'aide des identifiant que nous avons envoyer par mail</strong></h5>
                            <div class="form-group">
                                <img src="{{asset('img_create-compte/terminer.png')}}" class="fit-image mb-5" style="width: 250px; heigth: 250px;">
                            </div>
                            <a href="{{route('sign-in')}}">
                                <button type="button" style="background: #7635dc; padding: 5px 5px 5px 5px; color:white; border: none; border-radius: 5px">Terminé</button>
                            </a>
                        </fieldset>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection
@extends('create_compte.footer')
