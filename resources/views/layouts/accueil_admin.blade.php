@extends('./layouts/admin')
@section('content')
<div class="container-fluid" id="affiche">
    <div class="row line_default justify-content-center">
        <h1 class="text-mutted text-center titre mt-5">Bienvenue dans votre espace d'administration</h1>
        <img src="{{asset('img/images/logo_transparent_background.png')}}" alt="" class="img-fluid image_fond">
        <a href="#" class="text-center"><button class="btn btn-warning btnP my-5" type="">Voir plus</button></a>
    </div>
</div>
@endsection
