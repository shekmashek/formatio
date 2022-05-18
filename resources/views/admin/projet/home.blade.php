@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Projet de formation</h3>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
                <br>
                <h3>PROJET DE FORMATION</h3>
            </div> --}}

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_projet') || Route::currentRouteNamed('liste_projet') ? 'active' : '' }}" href="{{route('liste_projet')}}">
                                    <i class="fa fa-list">Liste des Projets</i></a>
                            </li>


                            {{-- <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('nouveau_projet') ? 'active' : '' }}" href="{{route('nouveau_projet')}}"><i class="fa fa-plus">Nouveau Project</i></a>
                            </li> --}}

                            {{-- <li class="nav-item">

                        <a class="nav-link  {{ Route::currentRouteNamed('liste_groupe') ? 'active' : '' }}" aria-current="page" href="{{route('liste_groupe')}}">
                            <i class="fa fa-list">Listes des Groupes</i></a>

                            </li> --}}

                        </ul>

                        <form class="navbar-form navbar-left" role="search">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    Tout <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{route('home',5)}}">5</a></li>
                                    <li><a href="{{route('home',10)}}">10</a></li>
                                    <li><a href="{{route('home',25)}}">25</a></li>
                                    <li><a href="{{route('home',50)}}">50</a></li>
                                    <li><a href="{{route('home',100)}}">100</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('home')}}">Tout</a></li>
                                </ul>
                            </div>
                            <div class="btn-group">

                                @canany(['isSuperAdmin','isAdmin'])

                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    Rechercher par CFP <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    @foreach($cfp as $cfp)
                                    <li><a href="#">{{$cfp->nom}}</a></li>
                                    @endforeach
                                    <li class="divider"></li>
                                    <li><a href="{{route('home')}}">Tout</a></li>
                                </ul>

                                @endcanany

                                @canany(['isCFP'])

                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    Rechercher par entreprises <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    @foreach($entreprise as $etp)
                                    <li><a href="#">{{$etp->nom_etp}}</a></li>
                                    @endforeach
                                    <li class="divider"></li>
                                    <li><a href="{{route('home')}}">Tout</a></li>
                                </ul>

                                @endcanany
                                {{-- <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Rechercher par projet <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                @foreach($projet as $proj)
                                    <li><a href="{{route('projet.show',['nom_projet' => $proj->nom_projet])}}">{{$proj->nom_projet}}</a></li>
                                @endforeach
                                <li class="divider"></li>
                                <li><a href="{{route('home')}}">Tout</a></li>
                                </ul> --}}


                            </div>

                        </form>

                    </div>
                </div>
            </nav>

            {{-- @can('isAdmin')
                    <div class="btn btn-success btn-lg">
                        You have Admin Access
                    </div>
                @endcan --}}
        </div>
        <!-- /.row -->

        @canany(['isCFP'])

        <button class="btn btn-success mb-2 payement" data-toggle="modal" data-target="#new_projet"><i class="fa fa-plus"></i> nouveau projet</button>
        @endcanany

        <div class="row">
            <div class="col-lg-12">

                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="table-responsive">
                            @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                            @endif
                            <table class="table table-striped table-bordered table-hover" id="projet_tab">
                                <thead>
                                    <tr>
                                        <th>Nom du projet</th>
                                        @canany(['isAdmin','isManager','isReferent','isSuperAdmin'])
                                        <th>CFP</th>
                                        @endcanany
                                        <th>Entreprise</th>
                                        @canany(['isCFP','isReferent'])
                                        <th colspan="2">status</th>
                                        @endcanany
                                        @canany(['isCFP'])
                                        <th colspan="4">Actions</th>
                                        @endcanany
                                    </tr>
                                </thead>
                                <tbody id="liste_projet">
                                    @foreach($data as $pj)

                                    <tr>
                                        <td>

                                            <a class="nav-link  {{ Route::currentRouteNamed('nouveau_groupe',$pj->projet_id) ? 'active' : '' }}" href="{{route('nouveau_groupe',$pj->projet_id)}}">
                                                <button type="button" class="btn btn-link position-relative">
                                                {{$pj->nom_projet}}
                                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                                    {{$pj->totale_session}} session+
                                                    <span class="visually-hidden">unread messages</span>
                                                  </span>

                                                </button>


                                            </a>

                                        </td>
                                        @canany(['isAdmin','isManager','isReferent','isSuperAdmin'])
                                        <td><strong style="color: blue">{{$pj->nom_cfp}}</strong> </td>
                                        @endcanany
                                        <td>
                                            {{$pj->nom_etp}}</td>
                                        @canany(['isCFP','isManager','isReferent'])



                                        <td>
                                            <strong style="color: blue">{{$pj->status}}</strong>

                                        </td>
                                        @endcanany
                                        @canany(['isCFP','isReferent'])
                                        <td>
                                            @canany(['isCFP'])
                                            <button class="btn btn-success mb-2 payement"  data-toggle="modal" data-target="#edit_prj_{{ $pj->projet_id }}"><i class="fa fa-edit"></i></button>
                                            @endcanany
                                        </td>
                                        @endcanany
                                        @canany(['isCFP'])
                                        <td>
                                            {{-- <button class="btn btn-danger"  data-target="{{$pj->projet_id}}" ><i class="fa fa-trash"></i></button> --}}

                                            <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal_{{$pj->projet_id}}"><i class="fa fa-trash"></i></button>

                                        </td>
                                        @endcanany
                                    </tr>


                        {{-- debut modal edit projet --}}
                        <div id="edit_prj_{{ $pj->projet_id }}"  class="modal fade" data-backdrop="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title text-md"><h5>Modification Projet</h5></div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card p-3 cardPayement">
                                            <form action="{{ route('update_projet',$pj->projet_id) }}" id="zsxsq" method="POST">
                                                @csrf
                                                <strong>{{ $pj->nom_projet }}</strong>

                                                <span>Status du projet</span>
                                                <div class="inputbox inputboxP mt-3">
                                                    <input type="text" class="form-control formPayement" id="exampleFormControlInput1" placeholder="status du projet" list="edit_status_projet" value="{{ $pj->status }}"  name="edit_status_projet"/>
                                                        <datalist id="edit_status_projet">
                                                                <option>En Cours</option>
                                                                <option>Fini</option>
                                                                <option>Stopper la formation</option>
                                                        </datalist>

                                                </div>


                                                <div class="mt-4 mb-4">
                                                    <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn-danger annuler" data-dismiss="modal">Annuler</button></span> <button type="submit"  class="btn btn-success btnP px-3">Valider</button> </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- fin --}}


                                        {{-- <td>
                                             <form action="{{ route('nouveauRapportFinale') }}" method="HEAD">
                                            @csrf
                                            <input name="projet_id" type="hidden" value="{{ $pj->projet_id }}">
                                            <input name="entreprise_id" type="hidden" value="{{ $pj->entreprise_id }}">
                                            <button type="submit" class="btn btn-dark">creer rapport finale</button>
                                            </form>

                                        </td>
                                        @endcanany
                                        @canany(['isCFP','isReferent'])
                                        <td>

                                            <form action="{{ route('downRapportFinale') }}" method="HEAD">
                                            @csrf
                                            <input name="projet_id" type="hidden" value="{{ $pj->projet_id }}">
                                            <input name="entreprise_id" type="hidden" value="{{ $pj->entreprise_id }}">
                                            <button type="submit" class="btn btn-info">telecharger rapport finale</button>
                                            </form>
                                        </td> --}}


                                    <!-- Modal delete -->
                                    <div class="modal fade" id="exampleModal_{{$pj->projet_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                                    <h6 class="modal-title">
                                                        <font color="white">Avertissement !</font>
                                                    </h6>

                                                </div>
                                                <div class="modal-body">
                                                    <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                                    <form action="{{ route('destroy_projet') }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-secondary"> Oui </button>
                                                        <input type="text" name="id_get" value="{{ $pj->projet_id }}" hidden>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- fin modal delete --}}


                                    @endforeach

                                    <input id="id_value" value="" style="display:none">
                                </tbody>
                            </table>


                            {{-- nouveau projet --}}
                            @canany(['isCFP'])

                            <div id="new_projet" class="modal fade" data-backdrop="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="modal-title text-md">
                                                <h5>Nouveau Projet</h5>
                                            </div>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card p-3 cardPayement">
                                                <form action="{{ route('projet.store') }}" id="zsxsq" method="POST">
                                                    @csrf

                                                    <label for="etp">Entreprise</label><br>
                                                    <select name="liste_etp" class=" form-control inputbox inputboxP mt-3" id="liste_etp" name="liste_etp">
                                                        @foreach($entreprise as $li)
                                                        <option value="{{$li->entreprise_id}}">{{$li->nom_etp}}</option>
                                                        @endforeach
                                                    </select>

                                                    @if(count($entreprise) <=0) <P><strong style="color: red">désoler,vous ne pouver pas créer un projet si vous n'avez pas encore collaborer avec des entreprises,merci!</strong> </p>
                                                        @endif


                                                        <div class="mt-4 mb-4">
                                                            <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button type="button" class="btn btn-danger annuler" data-dismiss="modal">Annuler</button></span> <button type="submit" class="btn btn-success btnP px-3">Ajouter</button> </div>
                                                        </div>
                                                </form>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            @endcanany
                            {{-- fin --}}


                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Modification</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                                @csrf
                                                <div class="form-group">
                                                    <label for="username">Nom du projet</label>
                                                    <input type="text" class="form-control" id="projetModif" name="nom_projet" placeholder="Nom">
                                                    @error('nom_projet')
                                                    <div class="col-sm-6">
                                                        <span style="color:#ff0000;"> {{$message}} </span>
                                                    </div>
                                                    @enderror
                                                </div><br>
                                                <button class="btn btn-success modification " id="action1"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $(".modifier").on('click', function(e) {
        var id = $(this).data("id");

        $.ajax({
            method: "GET"
            , url: "{{route('edit_projet')}}"
            , data: {
                Id: id
            }
            , dataType: "html"
            , success: function(response) {

                var userData = JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++) {
                    $("#projetModif").val(userData[$i].nom_projet);

                    $('#id_value').val(userData[$i].id);

                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    $(".supprimer").on('click', function(e) {
        var id = e.target.id;
        $.ajax({
            type: "GET"
            , url: "{{route('destroy_projet')}}"
            , data: {
                Id: id
            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error")
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    $("#action1").click(function(e) {
        e.preventDefault();
        var projet = $("#projetModif").val();

        var id = $('#id_value').val();
        $.ajax({
            url: "{{route('update_projet')}}"
            , method: 'get'
            , data: {
                Id: id
                , Nom_projet: projet,

            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error")
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
@endsection
