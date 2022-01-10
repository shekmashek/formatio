@extends('./layouts/admin')
@section('content')
<br>

<div class="shadow p-3 mb-5 bg-body rounded">

        <form  class="btn-submit" action="{{route('update_stagiaire',$stagiaire->id)}}" method="get" >
            @csrf
            <div class="row">
            <div class="col-md-6">
            <div class="form-group">
                <label for="matr">Matricule</label>
                <input type="text" value="{{ $stagiaire->matricule }}"  class="form-control"  name="matricule" placeholder="Matricule">
            </div>
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" value="{{ $stagiaire->nom_stagiaire }}" class="form-control"  name="nom" placeholder="Nom">
            </div>
            <div class="form-group">
              <label for="prenom">Prénom</label>
              <input type="text" class="form-control" value="{{ $stagiaire->prenom_stagiaire }}"  name="prenom" placeholder="Prénom">
            </div>
            <div class="form-group">
              <label for="date">Date de Naissance</label>
              <input type="date" class="form-control" name="date" value="{{ $stagiaire->date_naissance }}">
            </div>
            <div class="form-group">
              <label for="adresse">Adresse</label>
              <input type="adresse" class="form-control"  name="adresse" value="{{ $stagiaire->adresse }}">
            </div>

          </div>
        <div class="col-md-6">
          <div class="form-group">
              <label for="email">E-mail</label>
              <input type="email" class="form-control"  name="mail" value="{{ $stagiaire->mail_stagiaire }}" >
            </div>
            <div class="form-group">
              <label for="phone">Téléphone</label>
              <input type="text" class="form-control"  name="phone" value="{{ $stagiaire->telephone_stagiaire }}">
            </div>
            <div class="form-group">




            <div class="form-group">
              <label for="niv_etude">Niveau d'étude</label>
              <input type="text" class="form-control"  name="niv" value="{{ $stagiaire->niveau_etude }}">
            </div>

            <div class="form-group">
              <label for="fonction">Fonction</label>
              <input type="text" class="form-control"  name="fonction" placeholder="Fonction" value="{{ $stagiaire->fonction_stagiaire }}">
            </div>
             <div class="form-group">
              <label for="password">Mot de passe</label>
              <input type="password" class="form-control" value=""  name="password" placeholder="">
            </div>
        </div>
        </div>
          <br>
            <button class="btn btn-outline-success btn-lg modification "><span class = "glyphicon glyphicon-pencil"></span> Modifier</button>
        </form>

@endsection
