@extends('./layouts/admin')
<style>
    .vertical-line{
      border-left: 2px solid #000;
      display: inline-block;
      height: 300px;
      margin: 0 20px;
    }
</style>
@section('content')
<div class="container">
    <div class="row">
        <strong>Gestion de vos documents</strong>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-2">
            <i class="fa fa-folder"></i>&nbsp;&nbsp; {{$get_nom_cfp}}
        </div>
        <div class="col-md-2"><span class="vertical-line"></span></div>
        <div class="col-md-8"> {{$get_sub_folder}} </div>
    </div>
</div>
@endsection