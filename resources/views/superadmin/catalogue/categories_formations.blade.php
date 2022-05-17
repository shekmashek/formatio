@extends('layouts.admin')
@section('title')
    <p class="text_header m-0 mt-1">Categorie de formation
    </p>
@endsection
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
<button class="btn btn_enregistrer mt-3" type="submit"> Valider</button>

</form>


          <table class="table mt-4">
            <thead>
            <th>Formation</th>
            </thead>
            <tbody>
              @foreach ($formation as $form)
       <tr>
      <td>{{$form->nom_formation}} </td>

      </tr>
      @endforeach
    </tbody>
    </table>

</div>
@endsection