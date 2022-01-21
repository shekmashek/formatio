@extends('layouts.admin')
@section('content')
<div class="container">
<h1>Ajout categorie de formation</h1><br>
<form method="get" action="{{route('ajout_categorie')}}">
    
@foreach ($categorie as $ctg )
<div>
    <input type="checkbox" name="status[]" value="{{$ctg->id}}">
           
    <label for="{{$ctg->id}}">{{$ctg->nom_formation}}<br></label>
     {{-- <input type="hidden"name="id_formation" value="{{$ctg->id}}" >  --}}
  </div>

@endforeach
<button class="btn btn-primary" type="submit"> Valider</button>

</form>
</div>
@endsection