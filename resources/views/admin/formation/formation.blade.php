@extends('./layouts/admin')
@section('title')
<p class="text-white ms-5" style="font-size: 20px;">Votre catalogue de formation</p>
@endsection
@section('content')
<div class="container-fluid px-5 pe-3">
    {{-- <nav class="navbar navbar-expand-lg w-100"> --}}
        {{-- <div class="row w-100 g-0 m-0"> --}}
            {{-- <div class="col-lg-12"> --}}
                {{-- <div class="row g-0 m-0 p-2" style="align-items: center">
                    @can('isCFP')
                    <div class="col-12 d-flex justify-content-between" style="align-items: center">
                        <div class="col">
                            <h3 class="mt-2">Formation</h3>
                        </div>
                        <div class="col search_formatiom">
                            <form action="">
                                <div class="row w-100 form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control"
                                            placeholder="Chercher des formations...">
                                        <span class="input-group-addon success"><a href="#ici"><span
                                                    class="bx bx-search" role="button"></span></a></span>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col" align="right">
                            <a class="new_list_nouvelle {{ Route::currentRouteNamed('nouveau_module') ? 'active' : '' }}"
                                href="{{route('nouveau_module')}}">
                                <span><span style="font-size: 20px">+</span>&nbsp;Nouvelle
                                    Modules</span>
                            </a>
                        </div>
                        @endcan
                    </div>

                </div> --}}
            {{-- </div> --}}
        {{-- </div> --}}
    {{-- </nav> --}}
    {{-- <hr> --}}
    <div class="container-fluid ps-5">
        <div class="row w-100 my-5">
            <h5 class="text-dark">
                Mes Formations :
            </h5>
            <div class="container p-0 d-flex flex-row">
                <div class="row p-o new_card_formation w-100">
                    @foreach($formation as $frm)
                    <div class="col p-0 col-sm-12 col-md-6 col-lg-3 col-xl-3">
                        <div class="card g-0 mx-0 p-0" style="width: 18rem;">
                            <div class="card-body p-0 d-flex">
                                <div class="col-10 pt-3" style="align-items: center">
                                    <div class="row card_row">
                                        <h5 class="card-title">{{ $frm->nom_formation }}
                                        </h5>
                                    </div>
                                    <div class="card_row2 mt-3 text-center">
                                        <i class="bx bx-file new_icon_card" style="font-size: 70px"></i>
                                    </div>
                                </div>
                                <div class="col-2 action_card p-0" align="center">
                                    @canany(['isCFP','isAdmin','isSuperAdmin'])
                                    <button class="btn p-0" data-toggle="modal"
                                        data-target="#Modal_modifier_{{$frm->id}}"><i class="bx bxs-edit new_bx"
                                            title="Editer"></i></button>
                                    <button class="btn p-0" data-toggle="modal"
                                        data-target="#exampleModal_{{$frm->id}}"><i class="bx bxs-trash new_bx"
                                            title="Supprimer"></i></button>
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
                                        <div class="modal fade" id="exampleModal_{{$frm->id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center"
                                                        style="background-color:rgb(224,182,187);">
                                                        <h6 class="modal-title">Avertissement !</h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <small>Vous êtes sur le point d'effacer une donnée, cette
                                                            action
                                                            est
                                                            irréversible. Continuer ?</small>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal"> Non </button>
                                                        <form action="{{ route('destroy_formation', $frm->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-secondary"> Oui
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- fin modal delete --}}

                                        <!-- Modal show -->
                                        <div class="modal fade" id="Modal_afficher_{{$frm->id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center"
                                                        style="background-color:rgb(129,173,238);">
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
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal"> Retour </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal modifier -->
                                        <div class="modal fade" id="Modal_modifier_{{$frm->id}}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center"
                                                        style="background-color:rgb(96,167,134);">
                                                        <h6 class="modal-title">
                                                            <font color="white">Détail de formation</font>
                                                        </h6>

                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('show_formation', $frm->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <label><small><b>Domaine</b></small></label>
                                                            <input class="form-control" name="domaine"
                                                                value="{{$frm->domaine->nom_domaine}}"><br>
                                                            <label><small><b>Nom de la formation</b></small></label>
                                                            <input class="form-control" name="nom_formation"
                                                                value="{{$frm->nom_formation}}"><br>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal"> Retour </button>

                                                        <button type="submit" class="btn btn-success"> Enregistrer
                                                        </button>
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
@endsection