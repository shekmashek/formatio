@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Mettre à jours</h3>
@endsection
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
            <label for="date">Attribuer d'autre rôle</label>
            @for($i = 0; $i < count($roles); $i++)
              @for($j = 0; $j < count($role_id); $j++)
                  @if($roles[$i]->id != $role_id[$j]->role_id and $roles[$i]->id!=1 and $roles[$i]->id!=6 and $roles[$i]->id!=7)
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                           {{$roles[$i]->role_description}}
                        </label>
                      </div>
                  @endif
              @endfor
            @endfor

          <br>
          </form>

@endsection
