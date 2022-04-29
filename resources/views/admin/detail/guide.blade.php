@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Guide</h3>
@endsection
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                
                <br>
                <div class="text-center">
                <i class="far fa-bar-chart fa-5x" aria-hidden="true"></i>
                </div>
                <h3 class="text-center mt-5 "  style="font-weight:bold">Pour commencer vous devez collaborer avec une entreprise!</h3><br>
            </div>
            <div class="text-center">
                <div class="body">
                  <h5 class="title">Ensuite créer un Projet</h5>
                  <h5 class="title">Créer une groupe et</h5>
                  <h5 class="title">Avoir un formateur</h5>
                  <p class="text"></p>
                  <p class="text"></p>
                  <a href="{{route('nouveau_detail')}}" class="btn btn">Nouveau Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .btn{background-color: #542356;color: white}
    .btn:hover{color:white}
</style>
@endsection