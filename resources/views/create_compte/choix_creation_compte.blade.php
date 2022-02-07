@extends('create_compte.header')
@section('content')


<style>
    .test a {
        text-decoration-style: none;
        transition: all .5s ease-in-out;
    }

    .test {
        box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
    }

    .test:hover {
        transform: scale(0.95);
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

</style>

<div class="row justify-content-center">
    <h5 class="nav-item active">

        Inscription gratuite sur la plateforme <strong>formation.mg</strong>

    </h5>
    <p>D'abord, faites nous savoir si vous êtes un organisme de formation ou un employeur</p>

    <div class="col-md-4  p-3 bg-body rounded test me-2">
        <a href="{{route('create+compte+client/OF')}}" role="button">

            <img src="{{asset('img_create-compte/instructor_signup.png')}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h6 class="card-title text-center">Organisation de Formation</h6>
            </div>
        </a>
    </div>


    <div class="col-md-4  p-3 bg-body rounded ms-2 test">
        <a href="{{route('create+compte+client/employeur')}}" class="" role="button">
            <img src="{{asset('img_create-compte/student_signup.png')}}" class="card-img-top" alt="...">
            <div class="card-body">
                <h6 class="card-title text-center">Employeur</h6>
            </div>
        </a>
    </div>

</div>


@endsection
