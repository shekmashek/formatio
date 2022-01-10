@extends('./layouts/admin')
@section('content')
<br>

<div class="shadow p-3 mb-5 bg-body rounded">

        <form  class="btn-submit" method="post" action="{{route('update_manager',$var)}}">
            @csrf
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="matr">Nom</label>
                <input type="text" value="{{ $var->nom_chef }}"  class="form-control" name="nom" >
            </div>
            <div class="form-group">
                <label for="name">Prenom</label>
                <input type="text" value="{{ $var->prenom_chef }}" class="form-control"  name="prenom" placeholder="prenom">
            </div>
            <div class="form-group">
                <label for="name">Fonction</label>
                <input type="text" value="{{ $var->fonction_chef }}" class="form-control"  name="fonction" placeholder="Nom">
            </div>
            <div class="form-group">
              <label for="mail">Email</label>
              <input type="text" class="form-control" value="{{ $var->mail_chef }}" id="prenom" name="mail" placeholder="">
            </div>
            <div class="form-group">
              <label for="date">Téléphone</label>
              <input type="text" class="form-control"  name="phone" value="{{ $var->telephone_chef}}">
            </div>
          <br>
           <div class="form-group">
              <label for="password">Mot de passe</label>
              <input type="password" class="form-control" value=""  name="password" placeholder="">
            </div>
            <button class="btn btn-outline-success btn-lg modification " id="action1"><span class = "glyphicon glyphicon-pencil"></span> Modifier</button>
        </form>

@endsection
