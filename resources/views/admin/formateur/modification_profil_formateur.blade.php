@extends('./layouts/admin')
@section('content')
<div id="page-wrapper ">
    <div class="container-fluid ">
        <div class="shadow pt-3 mb-5 bg-body rounded ">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>MODIFICATION PROFIL FORMATEUR</h3>
            </div>
            <div class="panel-heading">
                <ul class="nav nav-pills">

                </ul>
            </div><br>
        </div>
        </div>
    <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action = "{{route('misajourFormateur',$formateur->id)}}" method = "POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                      <label for="name">Nom</label><br><br>
                                      <input type="text" autocomplete="off" value="{{$formateur->nom_formateur}}" class="form-control" id="nom" name="nom" placeholder="Nom">
                                      @error('nom')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    <div class="form-group">
                                      <label for="prenom">Prénom</label><br><br>
                                      <input type="text" autocomplete="off" value="{{$formateur->prenom_formateur}}" class="form-control" id="prenom" name="prenom" placeholder="Prénom">
                                      @error('prenom')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    <div class="form-group">
                                        <label for="phone">Téléphone</label><br><br>
                                        <input type="text" autocomplete="off" value="{{$formateur->numero_formateur}}" class="form-control" id="phone" name="phone" placeholder="Téléphone">
                                        @error('phone')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                      </div><br>
                                      <div class="form-group">
                                        <label for="email">E-mail</label><br><br>
                                        <input type="email" autocomplete="off" value="{{$formateur->mail_formateur}}" class="form-control" id="mail" name="mail" placeholder="E-mail">
                                        @error('mail')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                      </div><br>
                                      <div class="form-group">
                                          <label for="cin">CIN</label><br><br>
                                          <input type="text" autocomplete="off" value="{{$formateur->cin}}" cin class="form-control" id="cin" name="cin" placeholder="CIN">
                                          @error('cin')
                                            <div class ="col-sm-6">
                                                <span style = "color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div><br>
  {{--  --}}

                                          <div class="select-group">
                                            <select name="genre" id="genre" value="{{$formateur->genre}}" class="form-control">Sexe :
                                                <option value="homme">Homme</option>
                                                <option value="femme">Femme</option>
                                            </select>
                                          </div><br>
                                </div>

                                <div class="col-lg-6">

                                      <div class="form-group">
                                        <label for="">Date de naissance</label><br><br>
                                        <input type="date" autocomplete="off" value="{{$formateur->date_naissance}}"  class="form-control" id="dateNais" name="dateNais" placeholder="Date de naissance">
                                        @error('date_de_naissance')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                      </div><br><div class="form-group">
                                        <label for="">Adresse</label><br><br>
                                        <input type="text" autocomplete="off" value="{{$formateur->adresse}}"  class="form-control" id="adresse" name="adresse" placeholder="Adresse">
                                        @error('adresse')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                      </div><br><div class="form-group">
                                        <label for="">Specialité</label><br><br>
                                        <input type="text" autocomplete="off" value="{{$formateur->specialite}}"  class="form-control" id="specialite" name="specialite" placeholder="Specialite">
                                        @error('specialite')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                      </div><br><div class="form-group">
                                        <label for="">Niveau</label><br><br>
                                        <input type="text" autocomplete="off" value="{{$formateur->niveau}}"  class="form-control" id="niveau" name="niveau" placeholder="Niveau">
                                        @error('niveau')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                      </div><br>
                                       <div class="form-group">
                                        <label for="sary">Mot de passe</label><br><br>
                                        <input type="password" value="" class="form-control" id="password" name="password">
                                        @error('mdp')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                      </div><br>

                                </div>
                                    <button type = "submit" class="btn btn-outline-success "><span class="fa fa-save"></span>&nbsp; Modifier
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

@endsection
