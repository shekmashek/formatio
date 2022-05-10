@extends('layouts.admin')
@section('title')
    <p class="text_header m-0 mt-1">Formation publier
    </p>
@endsection
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
<button class="btn btn_enregistrer mt-3" type="submit"> Valider</button>
</form>
<table class="table mt-4">
  <thead>
  <th>Module </th>
  </thead>
  <tbody>  
    @foreach ($modules as $modulo)   
<tr>
<td>{{$modulo->nom_module}} </td>

</tr> 
@endforeach 
</tbody> 
</table>
</div>
@endsection