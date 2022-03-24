@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
<div class="shadow-sm p-3 mb-5 bg-body rounded">
    <div class="container-fluid">
        <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>RESPONSABLE</h3>
            </div>
            <div class="panel-heading">
                <ul class="nav nav-pills">
                    <li class ="{{ Route::currentRouteNamed('liste_responsable') ? 'active' : '' }}"><a href="{{route('liste_responsable')}}" ><span class="glyphicon glyphicon-th-list"></span>  Liste des responsables</a></li>
                    <li  class ="{{ Route::currentRouteNamed('nouveau_responsable') ? 'active' : '' }}" ><a href="{{route('nouveau_responsable')}}"><span class="glyphicon glyphicon-plus-sign"></span> Nouveau </a></li>
                </ul>
            </div><br>
            <!-- /.col-lg-12 -->
        </div>
        </div>
            <!-- /.row -->
    <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action = "{{route('enregistrer_resp')}}" method = "POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                      <label for="name">Nom</label><br><br>
                                      <input type="text" autocomplete="off" class="form-control" id="nom" name="nom" placeholder="Nom">
                                      @error('nom')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    <div class="form-group">
                                      <label for="prenom">Prénom</label><br><br>
                                      <input type="text" autocomplete="off" class="form-control" id="prenom" name="prenom" placeholder="Prénom">
                                      @error('prenom')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                     {{-- <div class="form-group">
                                      <label for="cin">CIN</label><br><br>
                                      <input type="text" autocomplete="off" class="form-control" id="cin" name="cin" placeholder="CIN">
                                      @error('cin')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror --}}
                                    {{-- </div><br> --}}
                                    <div class="form-group">
                                        <label for="lot">Lot</label><br><br>
                                        <input type="text" autocomplete="off" class="form-control" id="lot" name="lot" placeholder="Lot">
                                        @error('lot')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                      </div><br>
                                      <div class="form-group">
                                        <label for="quartier">Quartier</label><br><br>
                                        <input type="text" autocomplete="off" class="form-control" id="quartier" name="quartier" placeholder="Quartier">
                                        @error('quartier')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                      </div><br>
                                      <div class="form-group">
                                        <label for="code_postal">Code Postal</label><br><br>
                                        <input type="text" autocomplete="off" class="form-control" id="code_postal" name="code_postal" placeholder="Code Postal">
                                        @error('code_postal')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                      </div><br>
                                      <div class="form-group">
                                        <label for="ville">Ville</label><br><br>
                                        <input type="text" autocomplete="off" class="form-control" id="ville" name="ville" placeholder="Ville">
                                        @error('ville')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                      </div><br>
                                      <div class="form-group">
                                        <label for="region">Région</label><br><br>
                                        <input type="text" autocomplete="off" class="form-control" id="region" name="region" placeholder="Région">
                                        @error('region')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                      </div><br>
                                     <div class="form-group">
                                      <label for="sary">Photo</label>
                                      <input type="file" class="form-control-file" id="photo" name="photos">
                                      @error('photos')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    <div class="form-group">
                                      <label for="fonction">Fonction</label><br><br>
                                      <input type="text" autocomplete="off" class="form-control" id="fonction" name="fonction" placeholder="Fonction">
                                      @error('fonction')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>


                                <div class="form-group">
                                    <label for="poste">Poste</label><br><br>
                                    <input type="text" autocomplete="off" class="form-control" id="poste" name="poste" placeholder="poste">
                                    @error('poste')
                                      <div class ="col-sm-6">
                                          <span style = "color:#ff0000;"> {{$message}} </span>
                                      </div>
                                      @enderror
                                  </div><br>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                      <label for="email">E-mail</label><br><br>
                                      <input type="email" autocomplete="off" class="form-control" id="mail" name="mail" placeholder="E-mail">
                                      @error('mail')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    <div class="form-group">
                                      <label for="phone">Téléphone</label><br><br>
                                      <input type="text" autocomplete="off" class="form-control" id="phone" name="phone" placeholder="Téléphone">
                                      @error('phone')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>


                                    <div class="form-group">
                                      <label for="etp">Entreprise</label><br><br>
                                      <select class="form-select" aria-label="Default select example" name="liste_etp" autocomplete="off" class="form-control" id="liste_etp" name = "liste_etp">
                                          @foreach($liste as $li)
                                          <option value="{{$li->id}}">{{$li->nom_etp}}</option>
                                          @endforeach
                                      </select>
                                    </div><br><br>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="exampleFormControlInput1" class="form-label" align="left">Sexe</label>
                                            <select class="form-select" aria-label="Default select example" name="sexe_resp" required id="sexe_resp">
                                                <option value="null" disabled selected hidden>Veuillez Sélectionner</option>
                                                <option value="2">Homme</option>
                                                <option value="1">Femme</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="exampleFormControlInput1" class="form-label" align="left">Date de Naissance<strong style="color:#ff0000;">*</strong></label>
                                            <input type="date" required name="dte_resp" class="form-control" id="dte_resp" />
                                        </div>
                                        <div class="col-md-5">
                                            <label for="exampleFormControlInput1" class="form-label" align="left">CIN<strong style="color:#ff0000;">*</strong></label>
                                            <input type="text" required name="cin_resp" class="form-control" id="cin_resp" />
                                        </div>
                                    </div>


                                </div>
                                    <button type = "submit" class="btn btn-outline-success "><span class="fa fa-save"></span>&nbsp; Ajouter
                                </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>
</div>
@endsection
