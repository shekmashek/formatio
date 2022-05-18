@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Ajout cours</h3>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
                <br>
                <h3>Cours</h3>
            </div> --}}

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <ul class="nav nav-pills d-flex flex-row">
                                <li class="{{ Route::currentRouteNamed('liste_formation') || Route::currentRouteNamed('liste_projet') ? 'active' : '' }}"><a href="{{route('liste_formation')}}"><span class="glyphicon glyphicon-th-list"></span><i class='bx bx-list-ul'></i>&nbsp;Liste des formations</a></li>&nbsp;&nbsp;&nbsp;
                                <li class="{{ Route::currentRouteNamed('liste_module') || Route::currentRouteNamed('liste_module') ? 'active' : '' }}"><a href="{{route('liste_module')}}"><span class="glyphicon glyphicon-th-list"></span><i class='bx bx-list-ul'></i>&nbsp;Liste des modules</a></li>&nbsp;&nbsp;&nbsp;
                                <li class="{{ Route::currentRouteNamed('liste_programme') || Route::currentRouteNamed('liste_programme') ? 'active' : '' }}"><a href="{{route('liste_programme')}}"><span class="glyphicon glyphicon-th-list"></span><i class='bx bx-list-ul'></i>&nbsp;Liste des programmes</a></li>&nbsp;&nbsp;&nbsp;
                                <li><a href="{{ route('liste_cours',['id_prog'=>$id_programme]) }}"><span class="glyphicon glyphicon-plus-list"></span><i class='bx bx-list-ul'></i>&nbsp;Liste des cours</a><br></li>
                            </ul>
                        </div>

                        <div class="panel-body">
                            <div class="row">
                                <div class="container">
                                    <div class="col-lg-12">
                                        <form @if ($cours!="" ) action="{{route('modifier_cours')}}" @else action="{{route('insertion_cours')}}" @endif method="GET">
                                            @csrf
                                            <div class="form-row">
                                                <div class="col" align="center">
                                                    <div class="form-group">
                                                        <input type="hidden" name="programme_id" value="{{ $id_programme }}">
                                                        <input type="hidden" name="id_cours" value="{{ $id_cours }}">
                                                        <label for="titre_cours" class=" mt-4">Ajouter des nouveaux cours : </label>
                                                        <input type="text" class="form-control w-50" id="titre_cours" value="{{ $cours }}" name="titre_cours" placeholder="Titre de cours">
                                                        @error('titre_cours')
                                                        <div class="col-sm-6">
                                                            <span style="color:#ff0000;"> {{$message}} </span>
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>
                                                        @if ($cours!="")
                                                            <button type="submit" class="btn btn-secondary w-50"><span class="glyphicon glyphicon-plus-sign"></span><i class='bx bxs-edit' ></i>&nbsp;Modifier</button>
                                                        @else
                                                            <button type="submit" class="btn btn-secondary w-50"><span class="glyphicon glyphicon-plus-sign"></span><i class='bx bxs-plus-circle'></i>&nbsp;Ajouter</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

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
