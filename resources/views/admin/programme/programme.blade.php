@extends('./layouts/admin')
@section('title')
<p class="text-white ms-5" style="font-size: 20px;">Votre programme</p>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <h3>Programmes</h3>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">

                                <a class="nav-link {{ Route::currentRouteNamed('liste_formation') || Route::currentRouteNamed('liste_projet') ? 'active' : '' }}" aria-current="page" href="{{route('liste_formation')}}">
                                    <i class="bx bx-list-ul" style="font-size: 20px;"></i><span>&nbsp;Liste des formations</span></a>

                            </li>
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_module') || Route::currentRouteNamed('liste_module') ? 'active' : '' }}" href="{{route('liste_module')}}">
                                    <i class="bx bx-list-minus" style="font-size: 20px;"></i><span>&nbsp;Liste des modules</span></a>
                            </li>


                            <li class="nav-item">

                                <a class="nav-link  {{ Route::currentRouteNamed('liste_programme') || Route::currentRouteNamed('liste_programme') ? 'active' : '' }}" aria-current="page" href="{{route('liste_programme')}}">
                                    <i class="bx bx-list-minus" style="font-size: 20px;"></i><span>&nbsp;Liste des programmes</span></a>

                            </li>
                            @can('isCFP')
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('nouvelle_programme') || Route::currentRouteNamed('nouvelle_programme') ? 'active' : '' }}" href="{{route('nouvelle_programme')}}"><i class="bx bxs-plus-circle"></i><span>&nbsp;Nouveau Programme</span></a>
                            </li>
                            @endcan


                        </ul>
                    </div>
                </div>
            </nav>


            <form class="navbar-form navbar-left" role="search">
                <div class="btn-group">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        Tout <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{route('liste_formation',5)}}">5</a></li>
                        <li><a href="{{route('liste_formation',10)}}">10</a></li>
                        <li><a href="{{route('liste_formation',25)}}">25</a></li>
                        <li><a href="{{route('liste_formation',50)}}">50</a></li>
                        <li><a href="{{route('liste_formation',100)}}">100</a></li>
                        <li class="divider"></li>
                        <li><a href="{{route('liste_formation')}}">Tout</a></li>
                    </ul>
                </div>
            </form>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="table-responsive">
                            <p style="background-color:green;" id="delete_ok"></p>

                            <p style="color:#ff0000;" id="delete_error"></p>
                            <table class="table table-striped table-bordered table-hover" id="projet_tab">
                                <thead>
                                    <tr>
                                        <th>Titre de programme</th>
                                        <th>Nom du module</th>
                                        <th>Catégorie</th>
                                        <th colspan="3" style="text-align: center;">Actions</th>

                                </thead>
                                <tbody>
                                    @foreach($programmes as $programme)
                                    <tr>
                                        <td>{{$programme->titre_programme}}</td>
                                        <td>{{$programme->nom_module}}</td>
                                        <td>{{$programme->nom_formation}}</td>
                                        @canany(['isCFP','isFormateur','isSuperAdmin','isAdmin'])
                                            <td style="text-align: center;"><button class="btn modifier " data-id = "{{$programme->id_programme}}" data-toggle="modal" data-target="#myModal" id="{{$programme->id_programme}}" ><i class='bx bxs-edit' title="Editer"></button></td>
                                                <td style="text-align: center;"><button class="btn" data-toggle="modal" data-target="#exampleModal_{{$programme->id_programme}}"><i class='bx bxs-trash' title="Supprimer"></i></button></td>

                                        @endcanany

                                        {{-- <td> <a href="{{route('destroy_programme',$programme->id_programme)}}"> <button class="btn btn-danger supprime_programme"><span class="glyphicon glyphicon-remove"></span></button></a></td> --}}
                                        <td style="text-align: center;"><a href="{{ route('liste_cours',['id_prog'=>$programme->id_programme]) }}"><button class="btn"><i class='bx bxs-book-open' title="Voir cours"></i></button></a></td>

                                    </tr>
                                        <!-- Modal delete -->
                                        <div class="modal fade"  id="exampleModal_{{$programme->id_programme}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                              <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                  <h6 class="modal-title">Avertissement !</font></h6>

                                                </div>
                                                <div class="modal-body">
                                                  <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                </div>
                                                <div class="modal-footer">
                                                  <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                  <form action="{{route('destroy_programme',$programme->id_programme)}}" method="POST">
                                                          @csrf
                                                      <button type="submit" class="btn btn-secondary"> Oui </button>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                          {{-- fin modal delete --}}
                                @endforeach
                                <input id="id_value" value=""  style = "display:none">
                                </tbody>
                            </table>

                            {{-- Modification de Programme --}}

                            <div class="modal fade" id="myModal">


                                <div class="modal-dialog ">


                                    <div class="modal-content shadow-lg  bg-body rounded">
                                        <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                            <h5 class="modal-title text-white"> Modification </h5>
                                        </div>
                                        <div class="modal-body">
                                            <form id="form_update_data">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="username"><small><b>Titre du Programme</b></small></label>
                                                    <label id="id_programme"></label>
                                                    <input type="text" class="form-control" id="titre_progamme" name="titre_progamme" placeholder="Nom">

                                                    <p style="color:#ff0000;" id="error_titre_programme"></p>

                                                </div><br>


                                                <div class="form-group">
                                                    <label for="prix"><small><b>Types de Module</b></small></label>
                                                    <select class="form-select" id="list_module" name="list_module" aria-label="Default select example">
                                                    </select>
                                                </div><br>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>&nbsp;
                                            <button class="btn btn-success " id="modif_programme"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //separateur de milliers javascript


    /*


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); */

</script>



@endsection
