@extends('./layouts/admin')
@section('content')

@foreach ($infos as $inf)
    <p>{{$inf->nom_formation}}</p>
    <p>{{$inf->nom_module}}</p>
@endforeach

@endsection