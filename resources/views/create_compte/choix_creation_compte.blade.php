@extends('create_compte.header')
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <div class="row mt-5">
                <div class="col-md-5 shadow p-3 bg-body rounded">
                    {{-- <div class="shadow p-3 bg-body rounded mr-1" style="width: 18rem;"> --}}
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Organisation de Formation</h5>
                            <p class="card-text">organisation de formation ou OF</p>
                            <a href="{{route('create+compte+client/OF')}}" class="btn btn-primary">S'inscrir</a>
                        </div>
                    {{-- </div> --}}
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-5 shadow p-3 bg-body rounded ml-2">
                    {{-- <div class="shadow p-3 bg-body rounded ml-1" style="width: 18rem;"> --}}
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Employer</h5>
                            <p class="card-text">responsable de l'entreprise</p>
                            <a href="{{route('create+compte+client/employeur')}}" class="btn btn-primary">S'inscrir</a>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>



        </div>

        <div class="col-md-3"></div>
    </div>
</div>

@endsection
