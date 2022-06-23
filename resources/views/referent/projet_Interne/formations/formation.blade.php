@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Formation Interne</h3>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/modules.css')}}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.min.js"
    integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
<div class="m-4" role="tabpanel" >
    <ul class="nav nav-tabs d-flex flex-row navigation_module" id="myTab">
        <li class="nav-item">
            <a href="#domaine" class="nav-link" data-toggle="tab">Domaines interne</a>
        </li>
        <li class="nav-item active">
            <a href="#catalogue" class="nav-link active" data-toggle="tab">Catalogue Interne</a>
        </li>
        <li class="">
            <a data-bs-toggle="modal" data-bs-target="#nouveau_module" class=" btn_nouveau" role="button"><i class='bx bx-plus-medical me-2'></i>nouveau module</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane show fade" id="domaine">
            <div class="container-fluid p-0 mt-3 me-3">
                
            </div>
        </div>
        <div class="tab-pane show fade active" id="catalogue">
            <div class="container-fluid p-0 mt-3 me-3">
                catalogue
            </div>
        </div>
    </div>

@endsection