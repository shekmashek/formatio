@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <h3>Formation</h3>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">

                                <a class="nav-link  {{ Route::currentRouteNamed('liste_formation') || Route::currentRouteNamed('liste_projet') ? 'active' : '' }}" aria-current="page" href="{{route('liste_formation')}}">
                                    <i class="bx bx-list-ul" style="font-size: 20px;"></i><span>&nbsp;Liste des formations</span></a>

                            </li>
                            @can('isCFP')
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('nouvelle_formation') ? 'active' : '' }}" href="{{route('nouvelle_formation')}}"><i class="bx bxs-plus-circle"></i><span>&nbsp;Nouvelle Formation</span></a>
                            </li>
                            @endcan

                            <li class="nav-item">

                                <a class="nav-link  {{ Route::currentRouteNamed('liste_module') || Route::currentRouteNamed('liste_module') ? 'active' : '' }}" href="{{route('liste_module')}}">
                                    <i class="bx bx-list-minus" style="font-size: 20px;"></i><span>&nbsp;Liste des modules</span></a>
                            </li>

                            <li class="nav-item">

                                <a class="nav-link  {{ Route::currentRouteNamed('liste_programme') || Route::currentRouteNamed('liste_programme') ? 'active' : '' }}" aria-current="page" href="{{route('liste_programme')}}">
                                    <i class="bx bx-list-minus" style="font-size: 20px;"></i><span>&nbsp;Liste des programmes</span></a>

                            </li>

                        </ul>
                    </div>
                </div>
            </nav>

            <form class="navbar-form navbar-left navbar-brand" role="search">
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
            <div class="container">
                <div class="col-lg-12">

                    <div class="panel panel-default">

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped " id="projet_tab">
                                    <thead>
                                        <tr>
                                            <th>Domaine</th>
                                            <th>Nom de la formation</th>
                                            <th colspan="2" style="text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($formation as $frm)
                                        <tr>
                                            <td>{{$frm->domaine->nom_domaine}}</td>
                                            <td>{{$frm->nom_formation}}</td>
                                            <td style="text-align: center;">
                                                @canany(['isCFP','isAdmin','isSuperAdmin'])
                                                <button class="btn " data-toggle="modal" data-target="#Modal_modifier_{{$frm->id}}"><i class="bx bxs-edit" title="Editer"></i></button>
                                                <button class="btn " data-toggle="modal" data-target="#exampleModal_{{$frm->id}}"><i class="bx bxs-trash" title="Supprimer"></i></button>
                                                @endcanany
                                                <button class="btn " data-toggle="modal" data-target="#Modal_afficher_{{$frm->id}}"><i class="fa fa-eye" title="Afficher"></i></button>
                                            </td>
                                        </tr>
                                        <!-- Modal delete -->
                                        <div class="modal fade" id="exampleModal_{{$frm->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                        <form action="{{ route('destroy_formation', $frm->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-secondary"> Oui </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- fin modal delete --}}

                                        <!-- Modal show -->
                                        <div class="modal fade" id="Modal_afficher_{{$frm->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(129,173,238);">
                                                        <h6 class="modal-title">
                                                            <font color="white">Détail de formation</font>
                                                        </h6>

                                                    </div>
                                                    <div class="modal-body">
                                                        <label><small><b>Domaine</b></small></label>
                                                        <p>{{$frm->domaine->nom_domaine}}</p><br>
                                                        <label><small><b>Nom de la formation</b></small></label>
                                                        <p>{{$frm->nom_formation}}</p><br>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Retour </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal modifier -->
                                        <div class="modal fade" id="Modal_modifier_{{$frm->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                                        <h6 class="modal-title">
                                                            <font color="white">Détail de formation</font>
                                                        </h6>

                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('show_formation', $frm->id) }}" method="post">
                                                            @csrf
                                                            <label><small><b>Domaine</b></small></label>
                                                            <input class="form-control" name="domaine" value="{{$frm->domaine->nom_domaine}}"><br>
                                                            <label><small><b>Nom de la formation</b></small></label>
                                                            <input class="form-control" name="nom_formation" value="{{$frm->nom_formation}}"><br>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> Retour </button>

                                                        <button type="submit" class="btn btn-success"> Enregistrer </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
<script>
    // $(document).ready(function() {
    //     $('#projet_tab').dataTable({});
    // });

</script>
@endsection
