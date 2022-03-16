@extends('./layouts/admin')
@section('title')
<h3 class="text-white ms-5">Manager</h3>
@endsection
@section('content')

<div class="container-fluid px-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading d-flex justify-content-end">
                    <button type="button" class="btn_enregistrer"><a href="{{route('departement.create')}}">Nouveau employé</a></button>
                </div>
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
                        <h6 style="color: #AA076B">Liste des référents</h6>
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
                                            <td></td>
                                            <td>{{$referent[$i]->matricule}}</td>
                                            <td>{{$referent[$i]->nom_resp}}</td>
                                            <td>{{$referent[$i]->prenom_resp}}</td>

                                            <td>{{$referent[$i]->fonction_resp}}</td>
                                            <td>{{$referent[$i]->email_resp}}</td>
                                            <td>{{$referent[$i]->telephone_resp}}</td>

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
                                                    @for($ii = 0; $ii < count($roles_not_actif_referent[$i]["role_inactif"]); $ii++) @if($referent[$i]->user_id == $roles_not_actif_referent[$i]["user_id"])
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


                                            @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    {{-- employé --}}
                    <div class="tab-pane fade show" id="tab-employé" role="tabpanel" aria-labelledby="employé">
                        <h6 style="color: #AA076B">Liste des employés</h6>

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
                                                    @for($ii = 0; $ii < count($roles_not_actif_stg[$i]["role_inactif"]); $ii++) @if($stagiaires[$i]->user_id == $roles_not_actif_stg[$i]["user_id"])
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

                                            @endfor
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>



                    {{-- chef de département --}}

                    <div class="tab-pane fade show" id="tab-manager" role="tabpanel" aria-labelledby="manager">
                        <h6 style="color: #AA076B">Liste des chefs des départements</h6>

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped justify-text-center" id="dataTables-example">
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
                                        @if (count($chef)>0)


                                        @for($i=0;$i<count($chef);$i+=1) <tr class="text-center content_table">
                                            <td></td>
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
                                                <div align="left">
                                                    @for($ii = 0; $ii < count($roles_not_actif_manager[$i]["role_inactif"]); $ii++) @if($chef[$i]->user_id == $roles_not_actif_manager[$i]["user_id"])
                                                        <span style="color:blueviolet">attribué role pour {{$roles_not_actif_manager[$i]["role_inactif"][$ii]->role_name}}
                                                            <button class="btn modifier pt-0"><a href="{{route('add_role_user',[$chef[$i]->user_id,$roles_not_actif_manager[$i]["role_inactif"][$ii]->id])}}"><i class='bx bx-edit background_grey' style="color: #0052D4 !important;font-size: 15px" title="modifier les informations"></i></a></button>
                                                        </span> <br>
                                                        @endif
                                                        @endfor
                                                </div>
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

                                            @endfor
                                            @endif
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
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
