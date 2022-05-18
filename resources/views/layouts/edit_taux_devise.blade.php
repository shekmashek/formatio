@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Devise
    </p>
@endsection
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
<link rel="stylesheet" href="{{asset('assets/css/styleGeneral.css')}}">
@section('content')
<center>
    <div class="col-lg-4">
        <div class="p-3 form-control">
<div class="container">
    <div class="col-offset-3">
<form action="{{route('update_taux',$taux_edit->id)}}" method="POST">
    @csrf
    <div class="row px-3 mt-4">
        <div class="form-group mt-1 mb-1">
    <input type="text" class="form-control input" name="ar" value="{{$taux_edit->valeur_ariary}}">
    {{-- <input type="hidden" class="form-control" name="updated_at" value="{{$ $taux_edit->updated_at}}"> --}}
    <label class="ml-3 form-control-placeholder">Valeur en Ariary</label>
</div>
    </div>
    <div class="container">
        <div class="col-offset-3">
        <input type="date" class="form-control input" name="data_tx" value="{{$taux_edit->created_at}}">
        <label class="ml-3 form-control-placeholder">Date</label>
    
    </div>
</div>
    <button class=" btn_enregistrer">Enregistrer</button>
</form>
</center>
    </div>
</div>

@endsection