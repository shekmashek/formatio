

<div>
        {{-- <div class="row">
            <div class="col-lg-12">
                <br>
                <h3>DETAILS DES PROJETS</h3>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('liste_detail') ? 'active' : '' }}" aria-current="page" href="{{route('liste_detail')}}">
                                    <i class="fa fa-list"> Listes des Détails</i></a>
                            </li>
                            @canany(['isCFP'])
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('nouveau_detail') ? 'active' : '' }}" aria-current="page" href="{{route('nouveau_detail')}}">
                                    <i class="fa fa-list"> Nouveau détail</i></a>
                            </li>
                            @endcanany


                            <li class="nav-item ">
                                <form class="navbar-form navbar-left" role="search">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            Tout <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{route('liste_detail',5)}}">5</a></li>
                                            <li><a href="{{route('liste_detail',10)}}">10</a></li>
                                            <li><a href="{{route('liste_detail',25)}}">25</a></li>
                                            <li><a href="{{route('liste_detail',25)}}">50</a></li>
                                            <li><a href="{{route('liste_detail',25)}}">100</a></li>
                                            <li class="divider"></li>
                                            <li><a href="{{route('liste_detail')}}">Tout</a></li>
                                        </ul>
                                    </div>

                                </form>
                            </li>

                            {{-- @canany(['isCFP'])
                            <li class="nav-item">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                    Rechercher par entreprise <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    @foreach($liste as $etp)
                                    <li><a href="{{route('show_detail_entreprise',$etp->entreprise_id)}}">{{$etp->nom_etp}}</a></li>
                                    @endforeach
                                    <li class="divider"></li>
                                    <li><a href="{{route('liste_detail')}}">Tout</a></li>
                                </ul>
                            </li>
                            @endcanany --}}

                        {{-- </ul>

                    </div>
                </div>
            </nav> --}}


        {{-- </div> --}}
        <!-- /.row -->

        <style>
            .icon_plus{
                font-size: 1.2rem;
            }
            .nouveau_detail{
                background-color: #822164;
                border-radius: 20px;
                color: #fff;
                padding: 0 8; 
            }
            .nouveau_detail:hover{
                background-color: #b8368f;
                color: #fff;
            }
        </style>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <nav class="d-flex justify-content-end mb-1">
                                <a class="nouveau_detail btn"  aria-current="page"  data-toggle="modal" data-target="#modal_nouveau_detail">
                                    <span class="icon_plus m-0 p-0"> + </span> Nouveau détail</a>
                        </nav>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        @canany(['isReferent','isManager','isFormateur'])
                                        <th>CFP</th>
                                        @endcanany
                                        <th>Module</th>
                                        <th>Lieu</th>
                                        <th>Date</th>
                                        <th>Début</th>
                                        <th>Fin</th>
                                        <th>Formateur</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $d)

                                    <tr>
                                        @canany(['isReferent','isManager','isFormateur'])
                                        <td> <strong style="color: blue">{{$d->nom_cfp }}</strong></td>
                                        @endcanany
                                        <td>{{$d->nom_module}}</td>
                                        <td>{{$d->lieu}}</td>
                                        <td>{{$d->date_detail}}</td>
                                        <td>{{$d->h_debut}} h</td>
                                        <td>{{$d->h_fin}} h</td>

                                        <td>{{$d->nom_formateur." ".$d->prenom_formateur}}</td>
                                     
                                        {{-- <td >
                                                <a href="{{route('execution',[$d->detail_id])}}" class ="btn btn-info" id="{{$d->detail_id}}"><span class="glyphicon glyphicon-eye-open"></span></a>
                                        </td>
                                        <td><button class="btn btn-success modifier" id="{{$d->detail_id}}" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-pencil"></span> Modifier</button></td>
                                        <td><button class="btn btn-danger supprimer" id="{{$d->detail_id}}"><span class="glyphicon glyphicon-remove"></span> Supprimer</button></td>
                                        --}}
                                       
                                     </tr>

                                    @endforeach

                                </tbody>
                            </table>

                            {{-- Nouveau detail --}}
                            <div class="modal fade" id="modal_nouveau_detail">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-title pt-3" style="height: 50px; align-items: center;">
                                            <h5 class="text-center my-auto">Nouveau detail</h5>
                                        </div>
                                        <form class="btn-submit" action="{{route('detail.store')}}" method="post">
                                            @csrf
                                                <input type="hidden" name="projet" value="{{ $projet[0]->projet_id }}">
                                                <input type="hidden" name="groupe" value="{{ $projet[0]->groupe_id }}">
                                                <div class="form-group mx-auto">
                                                    <label for="formateur">Formateur</label><br>
                                                    <select class="form-control" id="formateur" name="formateur">
                                                        @foreach($formateur as $format)
                                                        <option value="{{$format->formateur_id}}">{{$format->nom_formateur}} {{$format->prenom_formateur}}</option>
                                                        @endforeach
                                                    </select>
                                                    <p><strong style="color: red" id="err_formateur"></strong></p>
                                                </div>
                                                <div class="form-group mx-auto">
                                                    <label for="lieu">Lieu</label>
                                                    <input type="text" class="form-control" id="lieu" name="lieu" placeholder="Lieu">
                                                   
                                                </div>
                                                <div class="form-group mx-auto">
                                                    <label for="date">Date</label>
                                                    <input type="date" class="form-control" id="date_detail" name="date" min="" max="">
                                                </div>
                                                <div class="form-group mx-auto">
                                                    <label for="debut">Heure début</label>
                                                    <input type="time" class="form-control" id="debut" name="debut" min="07:00" max="17:00">
                                                </div>
                                                <div class="form-group mx-auto">
                                                    <label for="fin">Heure fin</label>
                                                    <input type="time" class="form-control" id="fin" name="fin" min="08:00" max="18:08">
                                                </div>
                                                <div class="d-flex justify-content-center mb-3">
                                                <input type="submit" id="ajouter" class="btn btn-primary" value="Ajouter">
                                                </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                            {{-- fin nouveau detail --}}
                              
                              <!-- Modal -->
                            <div class="modal fade" id="myModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">Modification</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="btn-submit">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nom">Projet</label>
                                                    <input type="text" class="form-control" id="projetModif" placeholder="Projet">
                                                </div>
                                                <div class="form-group">
                                                    <label for="groupe">Groupe</label>
                                                    <input type="text" class="form-control" id="groupeModif" placeholder="Groupe">
                                                </div>
                                                <div class="form-group">
                                                    <label for="lieu">Lieu</label>
                                                    <input type="text" class="form-control" id="lieuModif" placeholder="Lieu">
                                                </div>
                                                <div class="form-group">
                                                    <label for="debut">Date début</label>
                                                    <input type="date" class="form-control" id="debutModif" name="debut">
                                                </div>
                                                <div class="form-group">
                                                    <label for="fin">Date fin</label>
                                                    <input type="date" class="form-control" id="finModif" name="fin">
                                                </div>
                                                <button class="btn btn-success modification " id="action1"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
    var id_detail;
    $(".modifier").on('click', function(e) {
        var id = e.target.id;

        $.ajax({
            type: "GET"
            , url: "{{route('edit_detail')}}"
            , data: {
                Id: id
            }
            , dataType: "html"
            , success: function(response) {
                var userData = JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++) {
                    $("#projetModif").val(userData[$i].projet.nom_projet);
                    $("#groupeModif").val(userData[$i].projet.groupe_projet);
                    $("#lieuModif").val(userData[$i].lieu);
                    $("#debutModif").val(userData[$i].date_debut);
                    $("#finModif").val(userData[$i].date_fin);
                    id_detail = userData[$i].id;
                }
                $('#action1').val('Modifier');
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
            , url: "{{route('destroy_detail')}}"
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
        var lieu = $("#lieu").val();
        var date_debut = $('#debut').val();
        var date_fin = $('#fin').val();
        var url = 'update_detail/' + id_detail;
        $.ajax({
            url: url
            , method: 'get'
            , data: {

                Lieu: lieu
                , Debut: date_debut
                , Fin: date_fin,

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
