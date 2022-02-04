@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <h3>STAGIAIRE</h3>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_participant') ? 'active' : '' }}" aria-current="page" href="{{route('liste_participant')}}">
                                    <i class="fa fa-list">Liste des stagiaires</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('nouveau_participant') ? 'active' : '' }}" aria-current="page" href="{{route('nouveau_participant')}}">
                                    <i class="fa fa-plus"> Nouveau stagiaire</i></a>
                            </li>
                            @canany(['isAdmin','isSuperAdmin', 'isReferent'])
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('export_excel_new_participant') ? 'active' : '' }}" aria-current="page" href="{{route('export_excel_new_participant')}}">
                                    <i class="fa fa-plus"> export participant</i></a>
                            </li>
                            @endcanany

                        </ul>

                    </div>
                </div>
            </nav>


            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{route('participant.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="matricule">Matricule</label>
                                        <input type="text" class="form-control" id="matricule" name="matricule" placeholder="Matricule">
                                        @error('matricule')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                        @if($matricule_error != '')
                                        <span style="color:#ff0000;"> {{$matricule_error}} </span>
                                        @endif
                                    </div><br>
                                    <div class="form-group">
                                        <label for="name">Nom</label>
                                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom">
                                        @error('nom')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    <div class="form-group">
                                        <label for="prenom">Prénom</label>
                                        <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom">
                                        @error('prenom')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>

                                    </div><br>
                                    <div class="form-group">
                                        <label for="lot">Lot</label>
                                        <input type="text" class="form-control" id="lot" name="lot" placeholder="Lot">
                                        @error('lot')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                    </div><br>

                                    <div class="form-group">
                                        <label for="quartier">Quartier</label>
                                        <input type="text" class="form-control" id="quartier" name="quartier" placeholder="Quartier">
                                        @error('quartier')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                    </div><br>
                                    <div class="form-group">
                                        <label for="code_postal">Code Postale</label>
                                        <input type="text" class="form-control" id="code_postal" name="code_postal" placeholder="Code Postale">
                                        @error('code_postal')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                    </div><br>
                                    <div class="form-group">
                                        <label for="ville">Ville</label>
                                        <input type="text" class="form-control" id="ville" name="ville" placeholder="Ville">
                                        @error('ville')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                    </div><br>
                                    <div class="form-group">
                                        <label for="region">Region</label>
                                        <input type="text" class="form-control" id="region" name="region" placeholder="Region">
                                        @error('region')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                                          </div>
                                          @enderror
                                    <div class="form-group">
                                        <label for="adresse">Adresse</label>
                                        <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse">
                                        @error('adresse')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    <div class="form-group">
                                        <label for="genre">Genre</label>
                                        <select name="genre" class="form-control" id="genre">
                                            <option value="homme">Homme</option>
                                            <option value="femme">Femme</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="titre">Titre</label>
                                        <select name="titre" class="form-control" id="titre">
                                            <option value="Monsieur">Mr</option>
                                            <option value="Mme">Mme</option>
                                            <option value="Mlle">Mlle</option>
                                            <option value="Dr">Dr</option>
                                            <option value="Prof">Prof</option>
                                            <option value="Dir">Dir</option>
                                            <option value="PDG">PDG</option>
                                        </select>
                                      </div>
                                       <div class="form-group">
                                        <label for="naissance">Date de naissance</label>
                                        <input type="date" class="form-control" name="naissance">
                                    </div><br>
                                    <div class="form-group">
                                        <label for="CIN">CIN</label>
                                        <input type="text" class="form-control" id="cin" name="cin" placeholder="Numero CIN">
                                        @error('cin')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    <div class="form-group">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" id="mail" name="mail" placeholder="E-mail">
                                        @error('mail')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                        @if($email_error != '')
                                        <span style="color:#ff0000;"> {{$email_error}} </span>
                                        @endif
                                    </div><br>
                                    <div class="form-group">
                                        <label for="phone">Téléphone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Téléphone">
                                        @error('phone')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>

                                    <div class="form-group">
                                        <label for="niveau">Niveau d'étude</label><br>
                                        <select name="niveau" class="form-control" id="niveau">
                                            <option value="">Choisissez un niveau d'étude...</option>
                                            <option value="Doctorat">Doctorat</option>
                                            <option value="Ingénieur">Ingénieur</option>
                                            <option value="Bacc+4">Bacc+4</option>
                                            <option value="Licence">Licence</option>
                                            <option value="DTS">DTS</option>
                                            <option value="Bacc+1">Bacc+1</option>
                                            <option value="BACC">BACC</option>
                                            <option value="BEPC">BEPC</option>
                                            <option value="CEPE">CEPE</option>
                                        </select>
                                    </div><br>
                                    @can('isSuperAdmin')
                                    <div class="form-group">
                                        <label for="etp">Entreprise</label><br>
                                        <select name="liste_etp" class="form-control" id="liste_etp">
                                            <option value="">Choisissez une entreprise...</option>
                                            @foreach ($liste_etp as $liste)
                                            <option value="{{$liste->id}}">{{$liste->nom_etp}}</option>
                                            @endforeach
                                        </select>
                                    </div><br>
                            </div>
                            <div class="form-group">
                                <label for="etp">Departement</label><br>
                                <select name="liste_dep" class="form-control" id="liste_dep">
                                    <option value="">Choisissez un département...</option>
                                    @for ($i = 0; $i < count($liste_dep); $i++)
                                        <option value="{{$liste_dep[$i]->id}}">{{$liste_dep[$i]->nom_departement}}</option>
                                    @endfor
                                </select>
                            </div><br>
                            @endcan
                            @can('isReferent')
                            <div class="form-group">
                                <label for="etp">Departement</label><br>
                                <select name="liste_dep" class="form-control" id="liste_dep">
                                    <option value="">Choisissez un département...</option>
                                    @for ($i = 0; $i < count($liste_dep); $i++)
                                        <option value="{{$liste_dep[$i]->id}}">{{$liste_dep[$i]->nom_departement}}</option>
                                    @endfor
                                </select>
                            </div><br>
                            @endcan

                            @can('isManager')
                            <div class="form-group">
                                <label for="etp">Departement</label><br>
                                <select name="liste_dep" class="form-control" id="liste_dep">
                                    @foreach ($liste_dep as $liste)
                                    <option value="{{$liste->departement->id}}">{{$liste->departement->nom_departement}}</option>
                                    @endforeach
                                </select>
                            </div><br>
                            @endcan

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="fonction">Fonction</label>
                                    <input type="text" class="form-control" id="fonction" name="fonction" placeholder="Fonction">
                                    @error('fonction')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{$message}} </span>
                                    </div>
                                    @enderror
                                </div><br>


                                    <div class="form-group">
                                        <label for="lieu">Lieu de travail</label>
                                        <input type="text" class="form-control" id="lieu" name="lieu"
                                            placeholder="Lieu de travail">
                                        @error('lieu')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{ $message }} </span>
                                            </div>
                                        @enderror
                                    </div><br>
                                    {{-- <div class="form-group">
                                {{-- <div class="form-group">
                                        <label for="CIN">CIN</label>
                                        <input type="text" class="form-control" id="cin" name="cin" placeholder="Numero CIN">
                                        @error('cin')
                                          <div class ="col-sm-6">
                                              <span style = "color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                        </div><br>
                        <div class="form-group">
                            <label for="naissance">Date de naissance</label>
                            <input type="date" class="form-control" name="naissance">
                        </div><br>
                        <div class="form-group">
                            <label for="adresse">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Adresse">
                            @error('adresse')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                        </div><br> --}}
                        {{-- <div class="form-group">
                            <label for="lieu">Lieu de travail</label>
                            <input type="text" class="form-control" id="lieu" name="lieu" placeholder="Lieu de travail">
                            @error('lieu')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                        </div><br> --}}
                        {{-- <div class="form-group">
                                        <label for="niveau">Niveau d'étude</label><br>
                                        <select name="niveau" class="form-control" id="niveau">
                                            <option value="">Choisissez un niveau d'étude...</option>
                                            <option value = "Doctorat">Doctorat</option>
                                            <option value = "Ingénieur">Ingénieur</option>
                                            <option value = "Bacc+4">Bacc+4</option>
                                            <option value = "Licence">Licence</option>
                                            <option value = "DTS">DTS</option>
                                            <option value = "Bacc+1">Bacc+1</option>
                                            <option value = "BACC">BACC</option>
                                            <option value = "BEPC">BEPC</option>
                                            <option value = "CEPE">CEPE</option>
                                        </select>
                                      </div><br> --}}
                        <div class="form-group">
                            <label for="sary">Photo</label>
                            <input type="file" class="form-control-file" id="photo" name="image">
                            @error('image')
                            <div class="col-sm-6">
                                <span style="color:#ff0000;"> {{$message}} </span>
                            </div>
                            @enderror
                        </div><br>
                        <input type="submit" class="btn btn-primary" id="action1" value="Ajouter">

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <input id="id_part" value="" style='display:none'>
    </div>
</div>
</div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $('#liste_etp').on('change', function() {
        $('#liste_dep').empty();

        var id = $(this).val();
        $.ajax({
            url: "{{route('show_dep')}}"
            , type: 'get'
            , data: {
                id: id
            }
            , success: function(response) {
                var userData = response;

                for (var $i = 0; $i < userData.length; $i++) {
                    $("#liste_dep").append('<option value="' + userData[$i].id + '">' + userData[$i].departement.nom_departement + '</option>');
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });

    });

</script>
@endsection

