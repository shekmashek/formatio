@extends('layouts.admin')
@section('content')
<div class="container">
<h1>Ajout les formations les plus rechercher</h1><br>
<form method="get" action="{{route('ajout_module')}}">
    
@foreach ($module as $mod )
<div>
    <input type="checkbox" name="status[]" value="{{$mod->id}}">
           
    <label for="{{$mod->id}}">{{$mod->nom_module}}<br></label>
     {{-- <input type="hidden"name="id_formation" value="{{$ctg->id}}" >  --}}
  </div>

@endforeach
<button class="btn btn-primary" type="submit"> Valider</button>

</form>
</div>
@endsection