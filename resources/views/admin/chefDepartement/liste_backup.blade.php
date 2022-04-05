@extends('./layouts/admin')
@section('title')
<h3 class="text-white ms-5">Manager</h3>
@endsection
@section('content')

<div class="container-fluid px-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                {{-- <div class="panel-heading d-flex justify-content-end">
                    <button type="button" class="btn_enregistrer"><a href="{{route('departement.create')}}">Nouveau Employé</a></button>
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
                                            <th>Role asigné</th>
                                            <th>Role non asigné</th>
                                            <th>Netoyé</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for($i = 0; $i < count($referent); $i++) <tr class="text-center content_table">
                                            <td>
                                                @if($referent[$i]->photos == null)
                                                   <center> <p  class="randomColor text-center" style="color:white; font-size: 15px; border: none; border-radius: 100%; height:50px; width:50px ;"><span class="" style="position:relative; top: .9rem;"><b>{{$referent[$i]->nm}}{{$referent[$i]->pr}}</b></span></p></center>
                                                @else
                                                    <a href="{{asset('images/responsables/'.$referent[$i]->photos)}}"><img title="clicker pour voir l'image" src="{{asset('images/responsables/'.$referent[$i]->photos)}}" style="width:50px; height:50px; border-radius:100%; font-size:15px"></a>
                                                @endif
                                            </td>
                                            <td class="" >{{$referent[$i]->matricule}}</td>
                                            <td class="" >{{$referent[$i]->nom_resp}}</td>
                                            <td class="" >{{$referent[$i]->prenom_resp}}</td>

                                            <td class="" >{{$referent[$i]->fonction_resp}}</td>
                                            <td class="" >{{$referent[$i]->email_resp}}</td>
                                            <td class="" >{{$referent[$i]->telephone_resp}}</td>

                                            <td>
                                                <div align="left">
                                                    @foreach ($roles_actif_referent as $role_asigner_referent)
                                                    @if($referent[$i]->user_id == $role_asigner_referent->user_id)
                                                    <span><i class="fa fa-check" style="color: green" aria-hidden="true"></i> {{$role_asigner_referent->role_name}}</span> <br>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    @for($ii = 0; $ii < count($roles_not_actif_referent[$i]["role_inactif"]); $ii++)
                                                    @if($referent[$i]->user_id == $roles_not_actif_referent[$i]["user_id"])
                                                    <span style="color:blueviolet">attribué role pour {{$roles_not_actif_referent[$i]["role_inactif"][$ii]->role_name}}
                                                        <button class="btn modifier pt-0"><a href="{{route('add_role_user',[$referent[$i]->user_id,$roles_not_actif_referent[$i]["role_inactif"][$ii]->id])}}"><i class='bx bx-edit background_grey' style="color: #0052D4 !important;font-size: 15px" title="modifier les informations"></i></a></button>
                                                    </span> <br>
                                                    @endif
                                                    @endfor
                                                </div>
                                            </td>
                                            <td>
                                                    <div align="left">
                                                        @foreach ($roles_actif_referent as $role_asigner_referent)
                                                        @if($referent[$i]->user_id == $role_asigner_referent->user_id && $role_asigner_referent->role_name!='referent' && $role_asigner_referent->role_name!='stagiaire')
                                                        <span> <button class="btn modifier pt-0"><a href="{{route('delete_role_user',[$referent[$i]->user_id,$role_asigner_referent->role_id])}}">
                                                            <i class="fas fa-window-close" aria-hidden="true" style="color:red"></i>{{$role_asigner_referent->role_name}}
                                                        </a></button>
                                                        </span> <br>
                                                        @endif
                                                        @endforeach
                                                    </div>
                                            </td>

                                            </tr>


                                            {{-- <!-- Modal delete -->
                                        <div class="modal fade" id="exampleModal_{{$referent[$i]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <form action="{{ route('destroy_chefDepartement') }}" method="GET">
                                                            @csrf
                                                            <button type="submit" class="btn btn-secondary"> Oui </button>
                                                            <input type="text" name="id_get" value="{{ $referent[$i]->id }}" hidden>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                            </div> --}}


                            <div class="modal fade" id="myModal_{{ $referent[$i]->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                            <h6 class="modal-title text-white"> Modification </h6>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('modifDepartement', $referent[$i]->id)}}" method="get" class="btn-submit">
                                                @csrf
                                                {{-- --}}
                                                <input type="hidden" name="_method" value="PUT">
                                                {{-- --}}
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
                            </div>
                            @endfor
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- employé --}}
                <div class="tab-pane fade show" id="tab-employé" role="tabpanel" aria-labelledby="employé">
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
                                        <th>Role asigné</th>
                                        <th>Role non asigné</th>
                                        <th>Netoyé</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 0; $i < count($stagiaires); $i++) <tr class="text-center content_table">
                                        <td>
                                            @if($stagiaires[$i]->photos == null)
                                               <center> <p  class="randomColor text-center" style="color:white; font-size: 15px; border: none; border-radius: 100%; height:50px; width:50px ;"><span class="" style="position:relative; top: .9rem;"><b>{{$stagiaires[$i]->nom}}{{$stagiaires[$i]->prenom}}</b></span></p></center>
                                            @else
                                                <a href="{{asset('images/stagiaires/'.$stagiaires[$i]->photos)}}"><img title="clicker pour voir l'image" src="{{asset('images/stagiaires/'.$stagiaires[$i]->photos)}}" style="width:50px; height:50px; border-radius:100%; font-size:15px"></a>
                                                {{-- <img src="/stagiaire-image/{{$stagiaires[$i]->photos}}" width="50" height="50"></td> --}}
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
                                                <span><i class="fa fa-check" style="color: green" aria-hidden="true"></i> {{$role_asigner_stg->role_name}}</span> <br>
                                                @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            <div align="left">
                                                @for($ii = 0; $ii < count($roles_not_actif_stg[$i]["role_inactif"]); $ii++)
                                                @if($stagiaires[$i]->user_id == $roles_not_actif_stg[$i]["user_id"])
                                                <span style="color:blueviolet">attribué role pour {{$roles_not_actif_stg[$i]["role_inactif"][$ii]->role_name}}
                                                    <button class="btn modifier pt-0"><a href="{{route('add_role_user',[$stagiaires[$i]->user_id,$roles_not_actif_stg[$i]["role_inactif"][$ii]->id])}}"><i class='bx bx-edit background_grey' style="color: #0052D4 !important;font-size: 15px" title="modifier les informations"></i></a></button>
                                                </span> <br>
                                                @endif
                                                @endfor
                                            </div>
                                        </td>
                                        <td>
                                            <div align="left">
                                                @foreach ($roles_actif_stg as $role_asigner_stg)
                                                @if($stagiaires[$i]->user_id == $role_asigner_stg->user_id && $role_asigner_stg->role_name!='stagiaire')
                                                <span> <button class="btn modifier pt-0"><a href="{{route('delete_role_user',[$stagiaires[$i]->user_id,$role_asigner_stg->role_id])}}">
                                                    <i class="fas fa-window-close" aria-hidden="true" style="color:red"></i>{{$role_asigner_stg->role_name}}
                                                </a></button>
                                                </span> <br>
                                                @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        </tr>

                                        <div class="modal fade" id="myModal_{{ $stagiaires[$i]->id }}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header d-flex justify-content-center" style="background-color:rgb(96,167,134);">
                                                        <h6 class="modal-title text-white"> Modification </h6>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('modifDepartement', $stagiaires[$i]->id)}}" method="get" class="btn-submit">
                                                            @csrf
                                                            {{-- --}}
                                                            <input type="hidden" name="_method" value="PUT">
                                                            {{-- --}}
                                                            <div class="form-group">
                                                                <label for="name"><small><b>Nom</b></small></label><br>
                                                                <input type="text" class="form-control" value="{{$stagiaires[$i]->nom_stagiaire}}" autocomplete="off" id="" name="nom_chef" placeholder="Nom">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="prenom"><small><b>Prénom</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" value="{{$stagiaires[$i]->prenom_stagiaire}}" id="" name="prenom_chef" placeholder="Prénom">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="prenom"><small><b>Genre</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" value="{{$stagiaires[$i]->genre_stagiaire}}" id="" name="genre_chef" placeholder="Genre">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="fonction"><small><b>Fonction</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" id="" value="{{$stagiaires[$i]->fonction_stagiaire}}" name="fonction_chef" placeholder="Fonction">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="email"><small><b>E-mail</b></small></label><br>
                                                                <input type="email" class="form-control" autocomplete="off" id="" value="{{$stagiaires[$i]->mail_stagiaire}}" name="mail_chef" placeholder="E-mail">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="phone"><small><b>Téléphone</b></small></label><br>
                                                                <input type="text" class="form-control" autocomplete="off" id="" value="{{$stagiaires[$i]->telephone_stagiaire}}" name="telephone_chef" placeholder="Téléphone">
                                                            </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>&nbsp;
                                                        <button type="submit" class="btn btn-success modification " id=""><span class="fa fa-pencil"></span> Modifier</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- chef de département --}}

                <div class="tab-pane fade show" id="tab-manager" role="tabpanel" aria-labelledby="manager">
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
                                        <th>Role asigné</th>
                                        <th>Role non asigné</th>
                                        <th>Netoyé</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i=0;$i<count($chef);$i+=1)
                                    <tr class="text-center content_table">

                                        <td>
                                            @if($chef[$i]->photos == null)
                                               <center> <p  class="randomColor text-center" style="color:white; font-size: 15px; border: none; border-radius: 100%; height:50px; width:50px ;"><span class="" style="position:relative; top: .9rem;"><b>{{$nom_chef[$i]}}{{$prenom_chef[$i]}}</b></span></p></center>
                                            @else
                                            <a href="{{asset('images/chefDepartement/'.$chef[$i]->photos)}}"> <img title="clicker pour voir l'image" src="{{asset('images/chefDepartements/'.$chef[$i]->photos)}}" style="width:50px; height:50px; border-radius:100%; font-size:15px"></a></td>
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
                                                <span><i class="fa fa-check" style="color: green" aria-hidden="true"></i> {{$role_asigner_manager->role_name}}</span> <br>
                                                @endif
                                                @endforeach
                                            </div>
                                        </td>
                                        <td>
                                            {{-- <div align="left">
                                                @for($i = 0; $i < count($roles_not_actif_manager[$i]["role_inactif"]); $i++)
                                                    @if($chef[$i]->user_id == $roles_not_actif_manager[$i]["user_id"])
                                                    <span style="color:blueviolet">attribué role pour {{$roles_not_actif_manager[$i]["role_inactif"][$i]->role_name}}
                                                        <button class="btn modifier pt-0"><a href="{{route('add_role_user',[$chef[$i]->user_id,$roles_not_actif_manager[$i]["role_inactif"][$i]->id])}}"><i class='bx bx-edit background_grey' style="color: #0052D4 !important;font-size: 15px" title="modifier les informations"></i></a></button>
                                                    </span> <br>
                                                    @endif
                                                @endfor
                                            </div> --}}
                                        </td>
                                        <td>
                                            <div align="left">
                                                @foreach ($roles_actif_manager as $role_asigner_manager)
                                                @if($chef[$i]->user_id == $role_asigner_manager->user_id && $role_asigner_manager->role_name!='stagiaire' && $role_asigner_manager->role_name!='manager')
                                                <span> <button class="btn modifier pt-0"><a href="{{route('delete_role_user',[$chef[$i]->user_id,$role_asigner_manager->role_id])}}">
                                                    <i class="fas fa-window-close" aria-hidden="true" style="color:red"></i>{{$role_asigner_manager->role_name}}
                                                </a></button>
                                                </span> <br>
                                                @endif
                                                @endforeach
                                            </div>
                                        </td>

                                    </tr>


                                    <!-- Modal delete -->
                                    <div class="modal fade" id="exampleModal_{{$chef[$i]->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        {{-- @php
                                                                $a = 0;
                                                            @endphp --}}
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
                                    </div>
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
      $(this).css("background-color", '#'+(Math.random()*0xFFFFFF<<0).toString(16));
    })
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(".supprimer").on('click', function(e) {
        var id = e.target.id;
        // alert(JSON.stringify(id));
        $.ajax({
            type: "GET"
            , url: "{{route('destroy_chefDepartement')}}"
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

</script>
@endsection
