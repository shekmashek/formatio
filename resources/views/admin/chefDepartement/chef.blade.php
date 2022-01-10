@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
<div class="shadow-sm p-3 mb-5 bg-body rounded">
    <div class="container-fluid">
    <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>MANAGER</h3> <br>
                <div class="panel-heading">
                        <ul class="nav nav-pills">
                            <li class ="{{ Route::currentRouteNamed('liste_chefDepartement') ? 'active' : '' }}"><a href="{{route('liste_chefDepartement')}}" ><span class="glyphicon glyphicon-th-list"></span>  Liste des Managers</a></li>
                            <li  class ="{{ Route::currentRouteNamed('departement.create') ? 'active' : '' }}" ><a href="{{route('departement.create')}}"><span class="glyphicon glyphicon-plus-sign"></span> Nouveau Manager</a></li>
                        </ul>
                </div>
            </div>
            <!-- /.col-lg-12 -->
            </div>
        </div>
        @if (Session::has('error'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{Session::get('error') }}</li>
                </ul>
            </div>
        @endif
            <!-- /.row -->
    <div class="shadow p-3 mb-5 bg-body rounded">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">

                                <form action = "{{route('ajoutChefDepartement.store')}}" method = "POST" enctype="multipart/form-data">
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
                                    <label for="prenom">Genre</label><br><br>
                                    <select class="form-select" aria-label="Default select example" id="genre_chef" name="genre_chef">
                                        <option value="Homme">Homme</option>
                                        <option value="Femme">Femme</option>
                                      </select>@error('genre_chef')
                                      <div class ="col-sm-6">
                                          <span style = "color:#ff0000;"> {{$message}} </span>
                                      </div>
                                      @enderror<br>
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
                                      <label for="email">E-mail</label><br><br>
                                      <input type="email"  class="form-control" id="mail" name="mail" placeholder="E-mail">
                                      @error('mail')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    </div>
                                    <div class="col-lg-6">
                                    <div class="form-group">
                                      <label for="phone">Téléphone</label><br><br>
                                      <input type="text" autocomplete="off" class="form-control" id="phone" name="phone" placeholder="Téléphone">
                                      @error('phone')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>

                                    @can('isSuperAdmin')
                                        <div class="form-group">
                                            <label for="etp">Entreprise</label><br><br>
                                            <select class="form-select" class="form-control" id="liste_etp" name = "liste_etp">
                                            <option value="">Choisissez une Entreprise ...</option>
                                                @foreach($liste_entreprise as $etp)
                                                <option value="{{$etp->id}}">{{$etp->nom_etp}}</option>
                                                @endforeach
                                            </select>
                                        </div><br>
                                        <div class="form-group">
                                            <label for="etp">Département</label><br><br>
                                            <select class="form-select" class="form-control" id="liste_dep" name = "liste_dep">
                                                <option value="">Choisissez un département ...</option>
                                                    @foreach($liste_departement as $dep)
                                                    <option value="{{$dep->id}}">{{$dep->nom_departement}}</option>
                                                    @endforeach
                                                </option>
                                            </select>
                                          </div><br><br>
                                    @endcan
                                    @can('isReferent')
                                        <div class="form-group">
                                            <label for="etp">Departement</label><br><br>
                                            <select class="form-select" class="form-control" id="liste_dep" name = "liste_dep">
                                                <option value="">Choisissez un département ...</option>
                                                    @foreach($liste_departement as $dep)
                                                    <option value="{{$dep->departement->id}}">{{$dep->departement->nom_departement}}</option>
                                                    @endforeach
                                                </option>
                                            </select>
                                        </div><br><br>
                                    @endcan


                                    <div class="form-group">
                                        <label for="sary">Photo &nbsp;</label><br><br>
                                        <input type="file" enctype="multipart/form-data" class="form-control-file" id="photo" name="photos">
                                        @error('photos')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                      </div><br>
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
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $('#liste_etp').on('change', function() {
        $('#liste_dep').empty();
        var id = $(this).val();
        $.ajax({
               url:"{{route('show_dep')}}",
               type:'get',
               data:{id:id },
               success:function(response){
                   var userData=response;
                    console.log(userData);
                    for (var $i = 0; $i < userData.length; $i++){
                         $("#liste_dep").append('<option value="'+userData[$i].departement.id+'">'+ userData[$i].departement.nom_departement+'</option>');
                    }
               },
               error:function(error){
                  console.log(error);
               }
        });
    });
</script>
@endsection
