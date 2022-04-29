@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Liste responsables</p>
@endsection
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            {{-- <div class="col-lg-12">
                <br>
                <h3>RESPONSABLE</h3>
            </div> --}}

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">

                                <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('liste_responsable') || Route::currentRouteNamed('liste_responsable') ? 'active' : '' }}" aria-current="page" href="{{route('liste_responsable')}}">
                                    Liste des Responsables</a>

                            </li>
                            @canany(['isSuperAdmin','isAdmin'])
                            <li class="nav-item">
                                <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('nouveau_responsable') ? 'active' : '' }}" href="{{route('nouveau_responsable')}}">
                                    Nouveau Responsable</a>
                            </li>
                            @endcanany
                            <li class="nav-item dropdown">
                                <form class="navbar-form navbar-left " role="search">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown">
                                            Tout <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{route('liste_responsable',5)}}">5</a></li>
                                            <li><a href="{{route('liste_responsable',10)}}">10</a></li>
                                            <li><a href="{{route('liste_responsable',25)}}">25</a></li>
                                            <li><a href="{{route('liste_responsable',50)}}">50</a></li>
                                            <li><a href="{{route('liste_responsable',100)}}">100</a></li>
                                            <li class="divider"></li>
                                            <li><a href="{{route('liste_responsable')}}">Tout</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-bs-toggle="dropdown">
                                            Rechercher par entreprise <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            @foreach($liste as $etp)
                                            <li><a href="{{route('responsable.show',$etp->id)}}">{{$etp->nom_etp}}</a></li>
                                            @endforeach
                                            <li class="divider"></li>
                                            <li><a href="{{route('liste_responsable')}}">Tout</a></li>
                                        </ul>
                                    </div>
                                </form>

                        </ul>
                    </div>
                </div>
            </nav>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('imprime_liste_responsable',$info_impression['id']) || Route::currentRouteNamed('imprime_liste_responsable',$info_impression['id']) ? 'active' : '' }}" aria-current="page" href="{{route('imprime_liste_responsable',$info_impression['id'])}}">
                                    PDF Liste des Responsables ({{$info_impression['nom_entreprise']}})</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('excel_liste_responsable') || Route::currentRouteNamed('excel_liste_responsable') ? 'active' : '' }}" aria-current="page" href="{{route('excel_liste_responsable')}}">
                                    Excel Listes des Responsables(Tout)</a>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>




            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">


                    <div class="panel-body">


                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nom</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>CIN</th>
                                        <th>Fonction</th>
                                        <th>E-mail</th>
                                        <th>Téléphone</th>
                                        <th>Entreprise</th>
                                        <th colspan="2">Actions</th>

                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($datas as $d)
                                    <tr>
                                        <td>
                                            {{-- <img src="/responsable-image/{{$d->photos}}" width="100" height="100"> --}}
                                            <img src="{{asset('images/responsables/'.$d->photos)}}" width="30" height="30">
                                        </td>
                                        <td>{{$d->nom_resp}}</td>
                                        <td>{{$d->prenom_resp}}</td>
                                        <td>{{$d->cin_resp}}</td>
                                        <td>{{$d->fonction_resp}}</td>
                                        <td>{{$d->email_resp}}</td>
                                        <td>{{$d->telephone_resp}}</td>
                                        <td>{{optional(optional($d)->entreprise)->nom_etp }}</td>
                                        {{-- <td>{{$d->entreprise->nom_etp}}</td> --}}

                                        <td>
                                            <center>
                                                <div class="btn-group">
                                                    <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa fa-ellipsis-v"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        @can('isSuperAdmin')
                                                        <li type="button" style="font-size:15px;"> <a class="modifier" title="Modifier le profil" id="{{$d->id}}" data-bs-toggle="modal" data-target="#myModal"><i style="font-size:18px;" class="fa fa-edit"></i>&nbsp;Modifier </a></li>
                                                        <li style="font-size:15px;"><a href="" data-toggle="modal" data-target="#exampleModal_{{$d->id}}"><i style="font-size:18px;" class="fa fa-trash"></i> &nbsp;Supprimer</a> </li>

                                                        @endcan
                                                        <li type="button" style="font-size:15px;"><a href="{{route('profil_referent', $d)}}" class="afficher" title="Afficher le profil" id="{{$d->id}}"><i style="font-size:18px;" class="fa fa-user"></i>&nbsp; Profil </a></li>
                                                    </div>
                                                </div>
                                            </center>
                                        </td>
                                    </tr>


                                    <!-- Modal delete -->
                                    <div class="modal fade" id="exampleModal_{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <form action="{{ route('destroy_responsable') }}" method="GET">
                                                        @csrf
                                                        <button type="submit" class="btn btn-secondary"> Oui </button>
                                                        <input type="text" name="id" value="{{$d->id}}" hidden>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    @endforeach
                                    <input id="id_resp_value" value="" style='display:none'>
                                </tbody>
                            </table>
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                            <h5 class="modal-title text-white">Modification</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form class="btn-submit">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="name"><small><b>Nom</b></small></label>
                                                    <input type="text" class="form-control" id="nomModif" name="nomModif" placeholder="Nom">
                                                </div>
                                                <div class="form-group">
                                                    <label for="prenom"><small><b>Prénom</b></small></label>
                                                    <input type="text" class="form-control" id="prenomModif" name="prenomModif" placeholder="Prénom">
                                                </div>
                                                <div class="form-group">
                                                    <label for="cin"><small><b>CIN</b></small></label>
                                                    <input type="text" autocomplete="off" class="form-control" id="cin" name="cin" placeholder="CIN">

                                                </div>
                                                <div class="form-group">
                                                    <label for="fonction"><small><b>Fonction</b></small></label>
                                                    <input type="text" class="form-control" id="fonctionModif" name="fonctionModif" placeholder="Fonction">
                                                </div>
                                                <div class="form-group">
                                                    <label for="email"><small><b>E-mail</b></small></label>
                                                    <input type="email" class="form-control" id="mailModif" name="mailModif" placeholder="E-mail">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone"><small><b>Téléphone</b></small></label>
                                                    <input type="text" class="form-control" id="phoneModif" name="phoneModif" placeholder="Téléphone">
                                                </div>
                                                <br>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>&nbsp;
                                            <button class="btn btn-success modification " id="action1"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
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
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    var identifiant_entreprise = $('#liste_etp').val();
    $('#id_etp').val(identifiant_entreprise);
    $('#liste_etp').on('change', function() {
        $('#id_etp').val($(this).val());
    });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".modifier").on('click', function(e) {
        var id = e.target.id;
        $.ajax({
            type: "GET"
            , url: "{{route('edit_responsable')}}"
            , data: {
                Id: id
            }
            , dataType: "html"
            , success: function(response) {
                var userData = JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++) {
                    $("#nomModif").val(userData[$i].nom_resp);
                    $("#prenomModif").val(userData[$i].prenom_resp);
                    $("#cin").val(userData[$i].cin_resp);
                    $("#fonctionModif").val(userData[$i].fonction_resp);
                    $("#phoneModif").val(userData[$i].telephone_resp);
                    $("#mailModif").val(userData[$i].email_resp);
                    $('#id_resp_value').val(userData[$i].id);

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
            , url: "{{route('destroy_responsable')}}"
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
        // var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var nom = $("#nomModif").val();
        var prenom = $("#prenomModif").val();
        var fonction = $("#fonctionModif").val();
        var phone = $("#phoneModif").val();
        var mail = $("#mailModif").val();

        var id = $('#id_resp_value').val();
        $.ajax({
            url: "{{route('update_responsable')}}"
            , method: 'get'
            , data: {
                Id: id
                , Nom: nom
                , Prenom: prenom
                , Fonction: fonction
                , Phone: phone
                , Mail: mail
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

</script>
@endsection
