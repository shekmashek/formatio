@extends('./layouts/admin')
@section('title')
<p class="text-white ms-5" style="font-size: 20px;">Votre catalogue de formation</p>
@endsection
@section('content')
<div class="container-fluid">
    <nav class="navbar navbar-expand-lg">
        <div class="row g-0 m-0 w-100">
            <div class="col-lg-12">
                <div class="row g-0 m-0 p-2 new_row">
                    {{--<div class="col col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <a class="new_list {{ Route::currentRouteNamed('liste_formation') || Route::currentRouteNamed('liste_projet') ? 'active' : '' }}" aria-current="page" href="{{route('liste_formation')}}">
                            <i class="bx bx-list-ul new_icon" style="font-size: 20px;"></i><span>Liste des Formations</span>
                        </a>
                    </div>
                     <div class="col col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <a class="new_list {{ Route::currentRouteNamed('liste_module') || Route::currentRouteNamed('liste_module') ? 'active' : '' }}" href="{{route('liste_module')}}">
                            <i class="bx bx-list-ul new_icon" style="font-size: 20px;"></i><span>Liste des Modules</span>
                        </a>
                    </div>
                    <div class="col col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <a class="new_list {{ Route::currentRouteNamed('liste_programme') || Route::currentRouteNamed('liste_programme') ? 'active' : '' }}" aria-current="page" href="{{route('liste_programme')}}">
                            <i class="bx bx-list-ul new_icon" style="font-size: 20px;"></i><span>Liste des Programmes</span>
                        </a>
                    </div> --}}
                    @can('isCFP')
                    <div class="col col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <a class="new_list_nouvelle {{ Route::currentRouteNamed('nouvelle_formation') ? 'active' : '' }}" href="{{route('nouvelle_formation')}}">
                            <i class="bx bxs-plus-circle new_icon_nouveau" style="font-size: 20px;"></i><span>Nouvelle Formation</span>
                        </a>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row my-5">
            <h5 class="text-dark">
                Mes Formations :
            </h5>
            <div class="container d-flex">
                <div class="row new_card_formation w-100">
                    @foreach($formation as $frm)
                        <div class="col col-sm-12 col-md-6 col-lg-3 col-xl-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row card_row">
                                        <h5 class="card-title">{{ $frm->nom_formation }}
                                        </h5>
                                    </div>

                                    <div class="row card_row2">
                                        {{-- <h6 class="card-text">
                                            Ms Excel
                                        </h6> --}}
                                        <p class="new_list_card"><i class="bx bx-file new_icon_card"></i>&nbsp;{{ $frm->domaine->nom_domaine }}</p>
                                    </div>
                                    <div class="row w-100 card_row3" align="center">
                                        @canany(['isCFP','isAdmin','isSuperAdmin'])
                                            <div class="col" >
                                                <button class="btn " data-toggle="modal" data-target="#Modal_modifier_{{$frm->id}}"><i class="bx bxs-edit new_bx" title="Editer"></i></button>
                                            </div>
                                            <div class="col" >
                                                <button class="btn " data-toggle="modal" data-target="#exampleModal_{{$frm->id}}"><i class="bx bxs-trash new_bx" title="Supprimer"></i></button>
                                            </div>
                                        @endcanany
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>



    {{-- <div class="container-fluid mt-4">
        <div class="row">
            <div class="col">
                <h5 class="text-dark">
                    Mes Thématiques :
                </h5>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="col-12">
                    <a class="new_list {{ Route::currentRouteNamed('nouvelle_formation') ? 'active' : '' }}" href="{{route('nouvelle_formation')}}">
                        <i class='bx bx-file new_icon' style="font-size: 20px;"></i><span>Bureautique</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div id="page-wrapper">
    <!-- /.row -->
    <div class="row">
        <div class="container">
            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped " id="projet_tab">

                                <tbody>
                                    @foreach($formation as $frm)
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
