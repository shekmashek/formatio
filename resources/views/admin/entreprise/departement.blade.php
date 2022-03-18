@extends('./layouts/admin')
@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-12">
                <br>
                <h5>Entreprise</h5>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light css-menuInter p-3 mb-2 rounded">
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

                            {{-- <li class="nav-item">
                            <a class="nav-link {{ Route::currentRouteNamed('liste_entreprise') ? 'active' : '' }}" aria-current="page" href="{{route('liste_entreprise')}}">
                            <i class="fa fa-list ">Mode Liste</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('liste_entreprise') ? 'active' : '' }}" aria-current="page" href="{{route('liste_entreprise')}}">
                                    <i class="fa fa-list ">Mode Block</i></a>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('departement.index') ? 'active' : '' }}" aria-current="page" href="{{route('departement.index')}}">
                                    <i class='bx bx-building' style="font-size: 20px;"></i><span>&nbsp;Departement</span></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

                <div class="panel-body">
                    <div class="row">
                        <div class="container">
                            <div class="col-lg-12">
                                <form action="{{route('departement.store')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="name">Nom de l'entreprise</label>
                                                <select name="etp_id" class="form-control">
                                                    <option value="null" selected hidden>Choisir le nom de l'entreprise...</option>
                                                    @foreach ($liste_entreprise as $liste)
                                                    <option value="{{$liste->id}}">{{$liste->nom_etp}} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div align="center"><button type="submit" class="btn btn-secondary w-50 mt-5"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter</button></div>
                                        </div>
                                        <div class="col ms-5">
                                            <div class="form-group">
                                                <label for="name">Departement</label>
                                                <div class="form-check">
                                                    @foreach ($liste_departement as $departement)
                                                    <input class="form-check-input" type="checkbox" value="{{$departement->id}}" id="defaultCheck1" name="departement[]">
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        {{$departement->nom_departement}}
                                                    </label><br>
                                                    @endforeach
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

@endsection
