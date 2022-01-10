@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="mt-5">Nouvelle Entreprise</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">

                            <a class="nav-link {{ Route::currentRouteNamed('liste_entreprise') ? 'active' : '' }}" aria-current="page" href="{{route('liste_entreprise')}}">
                                <i class="bx bx-list-ul" style="font-size: 20px;"></i><span>&nbsp;Liste des Entreprise</span></a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('nouvelle_entreprise') ? 'active' : '' }}" href="{{route('nouvelle_entreprise')}}"><i class="bx bxs-plus-circle" style="font-size: 20px;"></i><span>&nbsp;Nouvelle Entreprise</span></a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="row">
            <div class="container">
                <div class="col-lg-12">
                    <div class="panel panel-default formulaire_entreprise">
                        <div class="panel-body ">
                            <form action="{{route('entreprise.store')}}" method="POST" enctype="multipart/form-data" class="mb-5">
                                @csrf
                                <div class="form-row">
                                    <div class="col me-3">
                                        <h5 class="text-muted">Infos générales</h5>
                                        <div class="form-group mt-3">
                                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Nom de l'entreprise" pattern="[Aa-zA-Z0-9.!#$%&'*+/=?^_`{|}~' -]{1,100}" title="5 à 100 caractères" required>
                                            @error('nom')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="adresse" placeholder="Adresse de l'entreprise" name="adresse" pattern="[A-Za-z0-9.&' -/]{1,255}" title="5 à 255 caractères" required>
                                            @error('adresse')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="tel" class="form-control" id="phone" name="phone" placeholder="téléphone" minlength="10" maxlength="10" pattern="[0-9]{10}" title="entrer une numero de 10 chiffres sans lettre ni caractères spéciaux" required>
                                            @error('phone')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="mail" name="mail" placeholder="Mail de l'entreprise" pattern="[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]" title="entre l'adresse mail de l'entreprise" placeholder="example@gmail.com" required>
                                            @error('mail')
                                            <div class="col-sm-6">
                                                <span style="color:#ff0000;"> {{$message}} </span>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col ms-3">
                                        <h5 class="text-muted">Infos légales</h5>
                                        <div class="form-row">

                                            <div class="col m-0">
                                                <div class="form-group">
                                                    <label for="boutton_fichier" class="bg-secondary">Logo</label>
                                                    <span id="file-chosen">Pas de fichier choisie</span>
                                                    <input type="file" class="form-control-file" id="boutton_fichier" name="image" hidden>
                                                    @error('image')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="nif" name="nif" placeholder="NIF (Numéro d'Immatriculation Fiscale)"  pattern="[0-9]{10}" title="entrer une numero de 10 chiffres sans lettre ni caractères spéciaux" required>
                                                    @error('nif')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="stat" name="stat" placeholder="STAT (Statistiques)"  pattern="[0-9]{17}" title="entrer une numero de 17 chiffres sans lettre ni caractères spéciaux" required>
                                                    @error('stat')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <select name="secteur" class="form-control" style="height: 50px;">
                                                        <option value="null" disabled selected hidden>Choisissez un secteur d'activité...</option>
                                                        @foreach ($secteur as $sect)
                                                        <option value="{{$sect->id}}">{{$sect->nom_secteur}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>


                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="rcs" name="rcs" placeholder="RCS (Registre du Commerce et des Sociétés))"  title="entrer une numero de 10 chiffres sans lettre ni caractères spéciaux" required>
                                                    @error('rcs')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="cif" name="cif" placeholder="CIF (Carte d'Immatriculation Fiscale) "  title="Exemple : 2021 N° 0456898 / DGI-I" required>

                                                    {{-- <input type="text" class="form-control" id="cif" name="cif" placeholder="CIF (Carte d'Immatriculation Fiscale) " title="Exemple : 2021 N° 0456898 / DGI-I" required> --}}
                                                    @error('cif')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="site" name="site" placeholder="Site Web"  title="5 à 100 caractères" required>
                                                    @error('site')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div>
                                                    <button type="submit" class="btn btn-secondary w-100"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
</div>
<script>
    const actualBtn = document.getElementById('boutton_fichier');

    const fileChosen = document.getElementById('file-chosen');

    actualBtn.addEventListener('change', function() {
        fileChosen.textContent = this.files[0].name
    })

</script>
@endsection
