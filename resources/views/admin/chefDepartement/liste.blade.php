@extends('./layouts/admin')
@section('title')
<h3 class="text-white ms-5">Manager</h3>
@endsection
@section('content')

<div class="container-fluid px-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <nav class="navbar navbar-expand-lg navbar-light bg-light my-2">
                    <div class="container-fluid">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item mx-1">
                                    <a class="nav-link  btn_next" href="{{route('export_excel_new_participant')}}">Export des nouveaux employers</a>
                                </li>
                                <li class="nav-item  mx-1">
                                    <a class="nav-link btn_next" href="{{route('departement.create')}}">Nouveau employer</a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>

                {{-- <div class="panel-heading d-flex justify-content-end">
                    <button type="button" class="btn_enregistrer"><a href="{{route('departement.create')}}">Nouveau Employé</a></button>
            </div>
            <div class="panel-heading d-flex justify-content-end">
                <button type="button" class="btn_enregistrer"><a href="{{route('export_excel_new_participant')}}">Export Nouveau Employé</a></button>
            </div> --}}
            <div class="col-md-12 mb-3">
                <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list">
                    <li class="nav-item btn_next">
                        <a href="#" class="active" id="referent" data-bs-toggle="tab" data-bs-target="#tab-referent" type="button" role="tab" aria-controls="tab-referent" aria-selected="true">
                            Référents
                        </a>
                    </li>
                    <li class="nav-item ms-5 btn_next">
                        <a href="#" class="" id="employé" data-bs-toggle="tab" data-bs-target="#tab-employé" type="button" role="tab" aria-controls="tab-employé" aria-selected="false">
                            Employés
                        </a>
                    </li>
                    <li class="nav-item ms-5 btn_next">
                        <a href="#" class="" id="manager" data-bs-toggle="tab" data-bs-target="#tab-manager" type="button" role="tab" aria-controls="tab-manager" aria-selected="false">
                            Chef de département
                        </a>
                    </li>
                </ul>
            </div>
            @if(Session::has('error'))
            <div class="alert alert-danger">
                {{Session::get('error')}}
            </div>
            @endif
            <div class="tab-content" id="myTabContent">
                {{-- referent --}}
                <div class="tab-pane fade show active" id="tab-referent" role="tabpanel" aria-labelledby="referent">
                    <h4>Liste des responsables</h4>

                    <div class="panel-body">
                        <div class="table-responsive">

                            <table class="table table-striped table-hover" id="dataTables-example">
                                <thead>
                                    <tr class="text-center titre_table">
                                        <th>Photo</th>
                                        <th>Matricule</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Fonction</th>
                                        <th>E-mail</th>
                                        <th>Téléphone</th>
                                        <th>Role</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 0; $i < count($referent); $i++) <tr class="text-center content_table">
                                        <td>
                                            @if($referent[$i]->photos == null)
                                            <center>
                                                <p class="randomColor text-center" style="color:white; font-size: 15px; border: none; border-radius: 100%; height:50px; width:50px ;"><span class="" style="position:relative; top: .9rem;"><b>{{$referent[$i]->nm}}{{$referent[$i]->pr}}</b></span></p>
                                            </center>
                                            @else
                                            <a href="{{asset('images/employers/'.$referent[$i]->photos)}}"><img title="clicker pour voir l'image" src="{{asset('images/responsables/'.$referent[$i]->photos)}}" style="width:50px; height:50px; border-radius:100%; font-size:15px"></a>
                                            @endif
                                        </td>
                                        <td class="">{{$referent[$i]->matricule}}</td>
                                        <td class="">{{$referent[$i]->nom_resp}}</td>
                                        <td class="">{{$referent[$i]->prenom_resp}}</td>

                                        <td class="">{{$referent[$i]->fonction_resp}}</td>
                                        <td class="">{{$referent[$i]->email_resp}}</td>
                                        <td class="">{{$referent[$i]->telephone_resp}}</td>

                                        <td>
                                            <div align="left">
                                                @foreach ($roles_actif_referent as $role_asigner_referent)
                                                @if($referent[$i]->user_id == $role_asigner_referent->user_id)

                                                @if ($role_asigner_referent->role_id == 3)
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="userID_{{$referent[$i]->id}}_roleID_{{$role_asigner_referent->role_id}}" checked disabled>
                                                    <label class="form-check-label" for="userId_{{$referent[$i]->id}}_roleID_{{$role_asigner_referent->role_id}}"><i class="fa fa-check" style="color: green" aria-hidden="true"></i> {{$role_asigner_referent->role_name}}</label>
                                                </div>
                                                @elseif ($role_asigner_referent->role_id == 2)
                                                <div class="form-check form-switch">
                                                    <input class="form-check-input" type="checkbox" id="userID_{{$referent[$i]->id}}_roleID_{{$role_asigner_referent->role_id}}" checked disabled>
                                                    <label class="form-check-label" for="userId_{{$referent[$i]->id}}_roleID_{{$role_asigner_referent->role_id}}"><i class="fa fa-check" style="color: green" aria-hidden="true"></i> {{$role_asigner_referent->role_name}}</label>
                                                </div>

                                                @else
                                                <div class="form-check form-switch">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked"><i class="fa fa-check" style="color: green" aria-hidden="true"></i> {{$role_asigner_referent->role_name}}</label>
                                                    <input class="form-check-input retirer_stg" type="checkbox" data-user-id={{$referent[$i]->user_id}} data-role-id="{{$role_asigner_referent->role_id}}" value="{{$role_asigner_referent->role_id}}" id="refuser_userID_{{$referent[$i]->user_id}}_roleID_{{$role_asigner_referent->role_id}}" checked>
                                                </div>
                                                @endif

                                                @endif
                                                @endforeach

                                                @for($ii = 0; $ii < count($roles_not_actif_referent[$i]["role_inactif"]); $ii++) @if($referent[$i]->user_id == $roles_not_actif_referent[$i]["user_id"])
                                                    <div class="form-check form-switch">
                                                        <label class="form-check-label" for="flexSwitchCheckChecked"><span>{{$roles_not_actif_referent[$i]["role_inactif"][$ii]->role_name}}</span></label>
                                                        <input class="form-check-input ajouter_stg" type="checkbox" data-user-id={{$referent[$i]->user_id}} data-role-id="{{$roles_not_actif_referent[$i]["role_inactif"][$ii]->id}}" value="{{$roles_not_actif_referent[$i]["role_inactif"][$ii]->id}}">
                                                    </div>
                                                    @endif
                                                    @endfor
                                            </div>
                                        </td>

                                        </tr>



                                        {{-- <div class="modal fade" id="myModal_{{ $referent[$i]->id }}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                                    <h6 class="modal-title text-white"> Modification </h6>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('modifDepartement', $referent[$i]->id)}}" method="get" class="btn-submit">
                                                        @csrf
                                                        <input type="hidden" name="_method" value="PUT">
                                                        <div class="form-group">
                                                            <label for="name"><small><b>Nom</b></small></label><br>
                                                            <input type="text" class="form-control" value="{{$referent[$i]->nom_resp}}" autocomplete="off" id="" name="nom_chef" placeholder="Nom">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="prenom"><small><b>Prénom</b></small></label><br>
                                                            <input type="text" class="form-control" autocomplete="off" value="{{$referent[$i]->prenom_resp}}" id="" name="prenom_chef" placeholder="Prénom">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="prenom"><small><b>Genre</b></small></label><br>
                                                            <input type="text" class="form-control" autocomplete="off" value="{{$referent[$i]->sexe_resp}}" id="" name="genre_chef" placeholder="Genre">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="fonction"><small><b>Fonction</b></small></label><br>
                                                            <input type="text" class="form-control" autocomplete="off" id="" value="{{$referent[$i]->fonction_resp}}" name="fonction_chef" placeholder="Fonction">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email"><small><b>E-mail</b></small></label><br>
                                                            <input type="email" class="form-control" autocomplete="off" id="" value="{{$referent[$i]->email_resp}}" name="mail_chef" placeholder="E-mail">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="phone"><small><b>Téléphone</b></small></label><br>
                                                            <input type="text" class="form-control" autocomplete="off" id="" value="{{$referent[$i]->telephone_resp}}" name="telephone_chef" placeholder="Téléphone">
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>&nbsp;
                                                    <button type="submit" class="btn btn-success modification " id=""><span class="fa fa-pencil"></span> Modifier</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                        </div> --}}


                        @endfor
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- employé --}}
            <div class="tab-pane fade show" id="tab-employé" role="tabpanel" aria-labelledby="employé">
                <h4>Liste des employers</h4>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTables-example">
                            <thead>
                                <tr class="text-center titre_table">
                                    <th>Photo</th>
                                    <th>Matricule</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Fonction</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i = 0; $i < count($stagiaires); $i++) <tr class="text-center content_table">
                                    <td>
                                        @if($stagiaires[$i]->photos == null)
                                        <center>
                                            <p class="randomColor text-center" style="color:white; font-size: 15px; border: none; border-radius: 100%; height:50px; width:50px ;"><span class="" style="position:relative; top: .9rem;"><b>{{$stagiaires[$i]->nom}}{{$stagiaires[$i]->prenom}}</b></span></p>
                                        </center>
                                        @else
                                        <a href="{{asset('images/employers/'.$stagiaires[$i]->photos)}}"><img title="clicker pour voir l'image" src="{{asset('images/stagiaires/'.$stagiaires[$i]->photos)}}" style="width:50px; height:50px; border-radius:100%; font-size:15px"></a>
                                        @endif
                                    </td>
                                    <td>{{$stagiaires[$i]->matricule}}</td>
                                    <td>{{$stagiaires[$i]->nom_stagiaire}}</td>
                                    <td>{{$stagiaires[$i]->prenom_stagiaire}}</td>
                                    <td>{{$stagiaires[$i]->fonction_stagiaire}}</td>
                                    <td>{{$stagiaires[$i]->mail_stagiaire}}</td>
                                    <td>{{$stagiaires[$i]->telephone_stagiaire}}</td>

                                    <td>
                                        <div align="left">
                                            @foreach ($roles_actif_stg as $role_asigner_stg)
                                            @if($stagiaires[$i]->user_id == $role_asigner_stg->user_id)

                                            @if ($role_asigner_stg->role_id == 3)
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="userID_{{$stagiaires[$i]->id}}_roleID_{{$role_asigner_stg->role_id}}" checked disabled>
                                                <label class="form-check-label" for="userId_{{$stagiaires[$i]->id}}_roleID_{{$role_asigner_stg->role_id}}"><i class="fa fa-check" style="color: green" aria-hidden="true"></i> {{$role_asigner_stg->role_name}}</label>
                                            </div>
                                            @else
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="flexSwitchCheckChecked"><i class="fa fa-check" style="color: green" aria-hidden="true"></i> {{$role_asigner_stg->role_name}}</label>
                                                <input class="form-check-input retirer_stg" type="checkbox" data-user-id={{$stagiaires[$i]->user_id}} data-role-id="{{$role_asigner_stg->role_id}}" value="{{$role_asigner_stg->role_id}}" id="refuser_userID_{{$stagiaires[$i]->user_id}}_roleID_{{$role_asigner_stg->role_id}}" checked>
                                            </div>
                                            @endif

                                            @endif
                                            @endforeach

                                            @for($ii = 0; $ii < count($roles_not_actif_stg[$i]["role_inactif"]); $ii++) @if($stagiaires[$i]->user_id == $roles_not_actif_stg[$i]["user_id"])
                                                <div class="form-check form-switch">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked"><span>{{$roles_not_actif_stg[$i]["role_inactif"][$ii]->role_name}}</span></label>
                                                    <input class="form-check-input ajouter_stg" type="checkbox" data-user-id={{$stagiaires[$i]->user_id}} data-role-id="{{$roles_not_actif_stg[$i]["role_inactif"][$ii]->id}}" value="{{$roles_not_actif_stg[$i]["role_inactif"][$ii]->id}}">
                                                </div>
                                                @endif
                                                @endfor
                                        </div>
                                    </td>
                                    </tr>

                                    @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- chef de département --}}

            <div class="tab-pane fade show" id="tab-manager" role="tabpanel" aria-labelledby="manager">
                <h4>Liste des chef de départements</h4>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="dataTables-example">
                            <thead>
                                <tr class="text-center titre_table">
                                    <th>Photo</th>
                                    <th>Matricule</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Fonction</th>
                                    <th>E-mail</th>
                                    <th>Téléphone</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for($i=0;$i<count($chef);$i+=1) <tr class="text-center content_table">

                                    <td>
                                        @if($chef[$i]->photos == null)
                                        <center>
                                            <p class="randomColor text-center" style="color:white; font-size: 15px; border: none; border-radius: 100%; height:50px; width:50px ;"><span class="" style="position:relative; top: .9rem;"><b>{{$nom_chef[$i]}}{{$prenom_chef[$i]}}</b></span></p>
                                        </center>
                                        @else
                                        <a href="{{asset('images/employers/'.$chef[$i]->photos)}}"> <img title="clicker pour voir l'image" src="{{asset('images/chefDepartements/'.$chef[$i]->photos)}}" style="width:50px; height:50px; border-radius:100%; font-size:15px"></a></td>
                                    @endif
                                    </td>
                                    <td>{{$chef[$i]->matricule}}</td>
                                    <td>{{$chef[$i]->nom_chef}}</td>
                                    <td>{{$chef[$i]->prenom_chef}}</td>


                                    <td>{{$chef[$i]->fonction_chef}}</td>
                                    <td>{{$chef[$i]->mail_chef}}</td>
                                    <td>{{$chef[$i]->telephone_chef}}</td>
                                    <td>
                                        <div align="left">
                                            @foreach ($roles_actif_manager as $role_asigner_manager)
                                            @if($chef[$i]->user_id == $role_asigner_manager->user_id)

                                            @if ($role_asigner_manager->role_id == 3)
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="userID_{{$chef[$i]->id}}_roleID_{{$role_asigner_manager->role_id}}" checked disabled>
                                                <label class="form-check-label" for="userId_{{$chef[$i]->id}}_roleID_{{$role_asigner_manager->role_id}}"><i class="fa fa-check" style="color: green" aria-hidden="true"></i> {{$role_asigner_manager->role_name}}</label>
                                            </div>
                                            @elseif ($role_asigner_manager->role_id == 5)
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="userID_{{$chef[$i]->id}}_roleID_{{$role_asigner_manager->role_id}}" checked disabled>
                                                <label class="form-check-label" for="userId_{{$chef[$i]->id}}_roleID_{{$role_asigner_manager->role_id}}"><i class="fa fa-check" style="color: green" aria-hidden="true"></i> {{$role_asigner_manager->role_name}}</label>
                                            </div>

                                            @else
                                            <div class="form-check form-switch">
                                                <label class="form-check-label" for="flexSwitchCheckChecked"><i class="fa fa-check" style="color: green" aria-hidden="true"></i> {{$role_asigner_manager->role_name}}</label>
                                                <input class="form-check-input retirer_stg" type="checkbox" data-user-id={{$chef[$i]->user_id}} data-role-id="{{$role_asigner_manager->role_id}}" value="{{$role_asigner_manager->role_id}}" id="refuser_userID_{{$chef[$i]->user_id}}_roleID_{{$role_asigner_manager->role_id}}" checked>
                                            </div>
                                            @endif

                                            @endif
                                            @endforeach

                                            @for($ii = 0; $ii < count($roles_not_actif_manager[$i]["role_inactif"]); $ii++) @if($chef[$i]->user_id == $roles_not_actif_manager[$i]["user_id"])
                                                <div class="form-check form-switch">
                                                    <label class="form-check-label" for="flexSwitchCheckChecked"><span>{{$roles_not_actif_manager[$i]["role_inactif"][$ii]->role_name}}</span></label>
                                                    <input class="form-check-input ajouter_stg" type="checkbox" data-user-id={{$chef[$i]->user_id}} data-role-id="{{$roles_not_actif_manager[$i]["role_inactif"][$ii]->id}}" value="{{$roles_not_actif_manager[$i]["role_inactif"][$ii]->id}}">
                                                </div>
                                                @endif
                                                @endfor
                                        </div>

                                    <td>

                                        </tr>


                                        <!-- Modal delete -->
                                        {{-- <div class="modal fade" id="exampleModal_{{$chef[$i]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header d-flex justify-content-center" style="background-color:green">
                                                    <h6 class="modal-title">
                                                        <font color="white">Atrribuer d'autre rôle !</font>
                                                    </h6>

                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{route('role_manager')}}" method="POST">
                                                        @csrf
                                                        @for($a = 0;$a < count($user_role);$a++) @if($chef[$i]->user_id == $user_role[$a]->user_id)
                                                            @php
                                                            echo $user_role[$a]->role_id;
                                                            @endphp
                                                            @for($b = 0; $b < count($roles); $b++) @if($roles[$b]->id != $user_role[$a]->role_id && $roles[$b]->id!=1 && $roles[$b]->id!=6 && $roles[$b]->id!=7 && $roles[$b]->id!=3)
                                                                @php
                                                                echo $roles[$b]->id;
                                                                @endphp
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" value="{{$roles[$b]->id}}" name="role_id[]" id="flexCheckDefault">
                                                                    <label class="form-check-label" for="flexCheckDefault">
                                                                        {{$roles[$b]->role_description}}
                                                                    </label>
                                                                </div>
                                                                @endif
                                                                @endfor
                                                                @endif
                                                                @endfor
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>

                                                    <button type="submit" class="btn btn-secondary"> Oui </button>
                                                    <input type="text" name="id_chef" value="{{ $chef[$i]->id }}" hidden>

                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                        @endfor
                            </tbody>
                        </table>
                    </div> --}}
                    @endfor
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    //Pour chaque div de classe randomColor
    $(".randomColor").each(function() {
        //On change la couleur de fond au hasard
        $(this).css("background-color", '#' + (Math.random() * 0xFFFFFF << 0).toString(16));
    })

</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /*============ Referent =================*/
    $(".retirer_referent").on('click', function(e) {
        var user_id = $(this).data("user-id");
        var role_id = $(this).data("role-id");
        $.ajax({
            type: "GET"
            , url: "{{route('delete_role_user')}}"
            , data: {
                user_id: user_id
                , role_id: role_id
            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error");
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    $(".ajouter_referent").on('change', function(e) {
        var user_id = $(this).data("user-id");
        var role_id = $(this).data("role-id");
        $.ajax({
            type: "GET"
            , url: "{{route('add_role_user')}}"
            , data: {
                user_id: user_id
                , role_id: role_id
            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error");
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    /*============ stg =================*/
    $(".retirer_stg").on('click', function(e) {
        var user_id = $(this).data("user-id");
        var role_id = $(this).data("role-id");
        $.ajax({
            type: "GET"
            , url: "{{route('delete_role_user')}}"
            , data: {
                user_id: user_id
                , role_id: role_id
            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error");
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    $(".ajouter_stg").on('change', function(e) {
        var user_id = $(this).data("user-id");
        var role_id = $(this).data("role-id");
        $.ajax({
            type: "GET"
            , url: "{{route('add_role_user')}}"
            , data: {
                user_id: user_id
                , role_id: role_id
            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error");
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    /*============ stg =================*/
    $(".retirer_manager").on('click', function(e) {
        var user_id = $(this).data("user-id");
        var role_id = $(this).data("role-id");
        $.ajax({
            type: "GET"
            , url: "{{route('delete_role_user')}}"
            , data: {
                user_id: user_id
                , role_id: role_id
            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error");
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

    $(".ajouter_manager").on('change', function(e) {
        var user_id = $(this).data("user-id");
        var role_id = $(this).data("role-id");
        $.ajax({
            type: "GET"
            , url: "{{route('add_role_user')}}"
            , data: {
                user_id: user_id
                , role_id: role_id
            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error");
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });

</script>
@endsection
