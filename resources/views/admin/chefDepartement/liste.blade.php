@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Manager</h3>
@endsection
@section('content')
<style>
    .bgTest {
        background-color: #7635DC;
        color: white
    }
</style>
<link rel="stylesheet" href="{{asset('assets/css/employes.css')}}">
<div class="container-fluid px-5">

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                {{-- <div class="panel-heading d-flex justify-content-end">
                    <button type="button" class="btn_enregistrer"><a href="{{route('departement.create')}}">Nouveau
                            Employé</a></button>
                </div> --}}
                <div class="row">
                    <div class="col-md-8 mb-3">
                        <ul class="nav navbar-nav navbar-list me-auto mb-2 mb-lg-0 d-flex flex-row nav_bar_list">
                            <li class="nav-item ms-5">
                                <a href="#" class="btn_next referentClass" id="employé" data-bs-toggle="tab" data-bs-target="#tab-employé"
                                    type="button" role="tab" aria-controls="tab-employé" aria-selected="false">
                                    Référents
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="btn_next employeClass" id="referent" data-bs-toggle="tab"
                                    data-bs-target="#tab-employe" type="button" role="tab" aria-controls="tab-referent"
                                    aria-selected="true">
                                    Employés
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="btn_next" id="formateur" data-bs-toggle="tab"
                                    data-bs-target="#tab-referent" type="button" role="tab" aria-controls="tab-referent"
                                    aria-selected="true">
                                    Formateur interne
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="btn_next chefClass" id="manager" data-bs-toggle="tab" data-bs-target="#tab-manager"
                                    type="button" role="tab" aria-controls="tab-manager" aria-selected="false">
                                    Chef de département
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md">
                        <div class="">
                            <a href="#" class="btn_creer text-center filter mt-3" role="button" onclick="afficherFiltre();"><i class='bx bx-filter icon_creer'></i>Afficher les filtres</a>
                        </div>
                    </div>
                </div>

                @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{Session::get('error')}}
                </div>
                @endif
                <div class="tab-content" id="myTabContent">
                    {{-- referent --}}
                    <div class="tab-pane fade show active" id="tab-employé" role="tabpanel" aria-labelledby="referent">
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
                                    <tbody id="dynamic_rowR">
                                        @for($i = 0; $i < count($referent); $i++) <tr class="text-center content_table">
                                            <td>
                                                @if($referent[$i]->photos == null)
                                                <center>
                                                    <p class="randomColor text-center"
                                                        style="color:white; font-size: 15px; border: none; border-radius: 100%; height:50px; width:50px ;">
                                                        <span class=""
                                                            style="position:relative; top: .9rem;"><b>{{$referent[$i]->nm}}{{$referent[$i]->pr}}</b></span>
                                                    </p>
                                                </center>
                                                @else
                                                <a href="{{asset('images/responsables/'.$referent[$i]->photos)}}"><img
                                                        title="clicker pour voir l'image"
                                                        src="{{asset('images/responsables/'.$referent[$i]->photos)}}"
                                                        style="width:50px; height:50px; border-radius:100%; font-size:15px"></a>
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
                                                    <span><i class="fa fa-check" style="color: green"
                                                            aria-hidden="true"></i>
                                                        {{$role_asigner_referent->role_name}}</span> <br>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    @for($ii = 0; $ii <
                                                        count($roles_not_actif_referent[$i]["role_inactif"]); $ii++)
                                                        @if($referent[$i]->user_id ==
                                                        $roles_not_actif_referent[$i]["user_id"])
                                                        {{-- <span style="color:blueviolet">attribué role pour
                                                            {{$roles_not_actif_referent[$i]["role_inactif"][$ii]->role_name}}
                                                            {{-- <button class="btn modifier pt-0"><a
                                                                    href="{{route('add_role_user',[$referent[$i]->user_id,$roles_not_actif_referent[$i]["
                                                                    role_inactif"][$ii]->id])}}"><i
                                                                        class='bx bx-edit background_grey'
                                                                        style="color: #0052D4 !important;font-size: 15px"
                                                                        title="modifier les informations"></i></a></button> --}}
                                                        </span> <br>
                                                        <p id="info"></p @endif @endfor </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    @foreach ($roles_actif_referent as $role_asigner_referent)
                                                    @if($referent[$i]->user_id == $role_asigner_referent->user_id &&
                                                    $role_asigner_referent->role_name!='referent' &&
                                                    $role_asigner_referent->role_name!='stagiaire')
                                                    <span> <button class="btn modifier pt-0"><a
                                                                href="{{route('delete_role_user',[$referent[$i]->user_id,$role_asigner_referent->role_id])}}">
                                                                <i class="fas fa-window-close" aria-hidden="true"
                                                                    style="color:red"></i>{{$role_asigner_referent->role_name}}
                                                            </a></button>
                                                    </span> <br>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </td>

                                            </tr>


                                            {{--
                                            <!-- Modal delete -->
                                            <div class="modal fade" id="exampleModal_{{$referent[$i]->id}}"
                                                tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-flex justify-content-center"
                                                            style="background-color:rgb(224,182,187);">
                                                            <h6 class="modal-title">
                                                                <font color="white">Avertissement !</font>
                                                            </h6>

                                                        </div>
                                                        <div class="modal-body">
                                                            <small>Vous êtes sur le point d'effacer une donnée, cette
                                                                action est irréversible. Continuer ?</small>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal"> Non </button>
                                                            <form action="{{ route('destroy_chefDepartement') }}"
                                                                method="GET">
                                                                @csrf
                                                                <button type="submit" class="btn btn-secondary"> Oui
                                                                </button>
                                                                <input type="text" name="id_get"
                                                                    value="{{ $referent[$i]->id }}" hidden>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}


                                            <div class="modal fade" id="myModal_{{ $referent[$i]->id }}">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-flex justify-content-center"
                                                            style="background-color:rgb(96,167,134);">
                                                            <h6 class="modal-title text-white"> Modification </h6>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{route('modifDepartement', $referent[$i]->id)}}"
                                                                method="get" class="btn-submit">
                                                                @csrf
                                                                {{-- --}}
                                                                <input type="hidden" name="_method" value="PUT">
                                                                {{-- --}}
                                                                <div class="form-group">
                                                                    <label
                                                                        for="name"><small><b>Nom</b></small></label><br>
                                                                    <input type="text" class="form-control"
                                                                        value="{{$referent[$i]->nom_resp}}"
                                                                        autocomplete="off" id="" name="nom_chef"
                                                                        placeholder="Nom">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="prenom"><small><b>Prénom</b></small></label><br>
                                                                    <input type="text" class="form-control"
                                                                        autocomplete="off"
                                                                        value="{{$referent[$i]->prenom_resp}}" id=""
                                                                        name="prenom_chef" placeholder="Prénom">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="prenom"><small><b>Genre</b></small></label><br>
                                                                    <input type="text" class="form-control"
                                                                        autocomplete="off"
                                                                        value="{{$referent[$i]->sexe_resp}}" id=""
                                                                        name="genre_chef" placeholder="Genre">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="fonction"><small><b>Fonction</b></small></label><br>
                                                                    <input type="text" class="form-control"
                                                                        autocomplete="off" id=""
                                                                        value="{{$referent[$i]->fonction_resp}}"
                                                                        name="fonction_chef" placeholder="Fonction">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="email"><small><b>E-mail</b></small></label><br>
                                                                    <input type="email" class="form-control"
                                                                        autocomplete="off" id=""
                                                                        value="{{$referent[$i]->email_resp}}"
                                                                        name="mail_chef" placeholder="E-mail">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="phone"><small><b>Téléphone</b></small></label><br>
                                                                    <input type="text" class="form-control"
                                                                        autocomplete="off" id=""
                                                                        value="{{$referent[$i]->telephone_resp}}"
                                                                        name="telephone_chef" placeholder="Téléphone">
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Fermer</button>&nbsp;
                                                            <button type="submit" class="btn btn-success modification "
                                                                id=""><span class="fa fa-pencil"></span>
                                                                Modifier</button>
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
                        </tbody>
                        </table>
                    </div>
                    {{-- employé --}}
                    <div class="tab-pane fade show" id="tab-employe" role="tabpanel" aria-labelledby="employé">
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
                                            <th class="rnla">Role non asigné</th>
                                            <th class="rnlh">Netoyé</th>

                                        </tr>
                                    </thead>
                                    <tbody id="dynamic_row">
                                        @for($i = 0; $i < count($stagiaires); $i++)
                                        <tr class="text-center content_table">
                                            <td>
                                                @if($stagiaires[$i]->photos == null)
                                                <center>
                                                    <p class="randomColor text-center"
                                                        style="color:white; font-size: 15px; border: none; border-radius: 100%; height:50px; width:50px ;">
                                                        <span class=""
                                                            style="position:relative; top: .9rem;"><b>{{$stagiaires[$i]->nom}}{{$stagiaires[$i]->prenom}}</b></span>
                                                    </p>
                                                </center>
                                                @else
                                                <a href="{{asset('images/stagiaires/'.$stagiaires[$i]->photos)}}"><img
                                                        title="clicker pour voir l'image"
                                                        src="{{asset('images/stagiaires/'.$stagiaires[$i]->photos)}}"
                                                        style="width:50px; height:50px; border-radius:100%; font-size:15px"></a>
                                                {{-- <img src="/stagiaire-image/{{$stagiaires[$i]->photos}}" width="50"
                                                    height="50">
                                                </td> --}}
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
                                                    <span><i class="fa fa-check" style="color: green"
                                                            aria-hidden="true"></i>
                                                        {{$role_asigner_stg->role_name}}</span> <br>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    @for($ii = 0; $ii < count($roles_not_actif_stg[$i]["role_inactif"]);
                                                        $ii++) @if($stagiaires[$i]->user_id ==
                                                        $roles_not_actif_stg[$i]["user_id"])
                                                        <span style="color:blueviolet">attribué role pour
                                                            {{$roles_not_actif_stg[$i]["role_inactif"][$ii]->role_name}}
                                                            <button class="btn modifier pt-0"><a
                                                                    href="{{route('add_role_user',[$stagiaires[$i]->user_id,$roles_not_actif_stg[$i]["role_inactif"][$ii]->id])}}"><i
                                                                        class='bx bx-edit background_grey'
                                                                        style="color: #0052D4 !important;font-size: 15px"
                                                                        title="modifier les informations"></i></a></button>
                                                        </span> <br>
                                                        @endif
                                                        @endfor
                                                </div>
                                            </td>
                                            <td>
                                                <div align="left">
                                                    @foreach ($roles_actif_stg as $role_asigner_stg)
                                                    @if($stagiaires[$i]->user_id == $role_asigner_stg->user_id &&
                                                    $role_asigner_stg->role_name!='stagiaire')
                                                    <span> <button class="btn modifier pt-0"><a
                                                                href="{{route('delete_role_user',[$stagiaires[$i]->user_id,$role_asigner_stg->role_id])}}">
                                                                <i class="fas fa-window-close" aria-hidden="true"
                                                                    style="color:red"></i>{{$role_asigner_stg->role_name}}
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
                                                        <div class="modal-header d-flex justify-content-center"
                                                            style="background-color:rgb(96,167,134);">
                                                            <h6 class="modal-title text-white"> Modification </h6>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form
                                                                action="{{route('modifDepartement', $stagiaires[$i]->id)}}"
                                                                method="get" class="btn-submit">
                                                                @csrf
                                                                {{-- --}}
                                                                <input type="hidden" name="_method" value="PUT">
                                                                {{-- --}}
                                                                <div class="form-group">
                                                                    <label
                                                                        for="name"><small><b>Nom</b></small></label><br>
                                                                    <input type="text" class="form-control"
                                                                        value="{{$stagiaires[$i]->nom_stagiaire}}"
                                                                        autocomplete="off" id="" name="nom_chef"
                                                                        placeholder="Nom">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="prenom"><small><b>Prénom</b></small></label><br>
                                                                    <input type="text" class="form-control"
                                                                        autocomplete="off"
                                                                        value="{{$stagiaires[$i]->prenom_stagiaire}}"
                                                                        id="" name="prenom_chef" placeholder="Prénom">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="prenom"><small><b>Genre</b></small></label><br>
                                                                    <input type="text" class="form-control"
                                                                        autocomplete="off"
                                                                        value="{{$stagiaires[$i]->genre_stagiaire}}"
                                                                        id="" name="genre_chef" placeholder="Genre">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="fonction"><small><b>Fonction</b></small></label><br>
                                                                    <input type="text" class="form-control"
                                                                        autocomplete="off" id=""
                                                                        value="{{$stagiaires[$i]->fonction_stagiaire}}"
                                                                        name="fonction_chef" placeholder="Fonction">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="email"><small><b>E-mail</b></small></label><br>
                                                                    <input type="email" class="form-control"
                                                                        autocomplete="off" id=""
                                                                        value="{{$stagiaires[$i]->mail_stagiaire}}"
                                                                        name="mail_chef" placeholder="E-mail">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label
                                                                        for="phone"><small><b>Téléphone</b></small></label><br>
                                                                    <input type="text" class="form-control"
                                                                        autocomplete="off" id=""
                                                                        value="{{$stagiaires[$i]->telephone_stagiaire}}"
                                                                        name="telephone_chef" placeholder="Téléphone">
                                                                </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Fermer</button>&nbsp;
                                                            <button type="submit" class="btn btn-success modification "
                                                                id=""><span class="fa fa-pencil"></span>
                                                                Modifier</button>
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
                                            <th class="rlc">Role non asigné</th>
                                            <th class="rlc">Netoyé</th>
                                        </tr>
                                    </thead>
                                    <tbody id="dynamic_rowC">
                                        @for($i=0;$i<count($chef);$i+=1) <tr class="text-center content_table">

                                            <td>
                                                @if($chef[$i]->photos == null)
                                                <center>
                                                    <p class="randomColor text-center"
                                                        style="color:white; font-size: 15px; border: none; border-radius: 100%; height:50px; width:50px ;">
                                                        <span class=""
                                                            style="position:relative; top: .9rem;"><b>{{$nom_chef[$i]}}{{$prenom_chef[$i]}}</b></span>
                                                    </p>
                                                </center>
                                                @else
                                                <a href="{{asset('images/chefDepartement/'.$chef[$i]->photos)}}"> <img
                                                        title="clicker pour voir l'image"
                                                        src="{{asset('images/chefDepartement/'.$chef[$i]->photos)}}"
                                                        style="width:50px; height:50px; border-radius:100%; font-size:15px"></a>
                                            </td>
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
                                                    <span><i class="fa fa-check" style="color: green"
                                                            aria-hidden="true"></i>
                                                        {{$role_asigner_manager->role_name}}</span> <br>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td>
                                                {{-- <div align="left">
                                                    @for($i = 0; $i <
                                                        count($roles_not_actif_manager[$i]["role_inactif"]); $i++)
                                                        @if($chef[$i]->user_id ==
                                                        $roles_not_actif_manager[$i]["user_id"])
                                                        <span style="color:blueviolet">attribué role pour
                                                            {{$roles_not_actif_manager[$i]["role_inactif"][$i]->role_name}}
                                                            <button class="btn modifier pt-0"><a
                                                                    href="{{route('add_role_user',[$chef[$i]->user_id,$roles_not_actif_manager[$i]["
                                                                    role_inactif"][$i]->id])}}"><i
                                                                        class='bx bx-edit background_grey'
                                                                        style="color: #0052D4 !important;font-size: 15px"
                                                                        title="modifier les informations"></i></a></button>
                                                        </span> <br>
                                                        @endif
                                                        @endfor
                                                </div> --}}
                                            </td>
                                            <td>
                                                <div align="left">
                                                    @foreach ($roles_actif_manager as $role_asigner_manager)
                                                    @if($chef[$i]->user_id == $role_asigner_manager->user_id &&
                                                    $role_asigner_manager->role_name!='stagiaire' &&
                                                    $role_asigner_manager->role_name!='manager')
                                                    <span> <button class="btn modifier pt-0"><a
                                                                href="{{route('delete_role_user',[$chef[$i]->user_id,$role_asigner_manager->role_id])}}">
                                                                <i class="fas fa-window-close" aria-hidden="true"
                                                                    style="color:red"></i>{{$role_asigner_manager->role_name}}
                                                            </a></button>
                                                    </span> <br>
                                                    @endif
                                                    @endforeach
                                                </div>
                                            </td>

                                            </tr>


                                            <!-- Modal delete -->
                                            <div class="modal fade" id="exampleModal_{{$chef[$i]->id}}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-flex justify-content-center"
                                                            style="background-color:green">
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
                                                                @for($a = 0;$a < count($user_role);$a++) @if($chef[$i]->
                                                                    user_id == $user_role[$a]->user_id)
                                                                    @php
                                                                    echo $user_role[$a]->role_id;
                                                                    @endphp
                                                                    @for($b = 0; $b < count($roles); $b++)
                                                                        @if($roles[$b]->id != $user_role[$a]->role_id &&
                                                                        $roles[$b]->id!=1 && $roles[$b]->id!=6 &&
                                                                        $roles[$b]->id!=7 && $roles[$b]->id!=3)
                                                                        @php
                                                                        echo $roles[$b]->id;
                                                                        @endphp
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                type="checkbox"
                                                                                value="{{$roles[$b]->id}}"
                                                                                name="role_id[]" id="flexCheckDefault">
                                                                            <label class="form-check-label"
                                                                                for="flexCheckDefault">
                                                                                {{$roles[$b]->role_description}}
                                                                            </label>
                                                                        </div>
                                                                        @endif
                                                                        @endfor
                                                                        @endif
                                                                        @endfor
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal"> Non </button>

                                                            <button type="submit" class="btn btn-secondary"> Oui
                                                            </button>
                                                            <input type="text" name="id_chef"
                                                                value="{{ $chef[$i]->id }}" hidden>

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
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


{{--filter employes--}}
<div class="filtrer mt-3 testFilter">
    <div class="row">
        <div class="row">
            <div class="col-md-11">
                <p class="m-0" style="color: #0052D4; text-transform: uppercase">Filter vos équipes</p>
            </div>
            <div class="col-md-1 text-end">
                <i class="bx bx-x " role="button" onclick="afficherFiltre();"></i>
            </div>
        </div>
        <hr class="mt-2">
        {{-- @canany(['isReferent', 'isCFP']) --}}
        <div class="col-12 pe-3">
            <div class="row mb-3 p-2 pt-0">

                    {{-- <p>
                        <div class="row">
                            <div class="col-md-11">
                                <a class="" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Autre options de recherche
                                  </a>
                            </div>
                            <div class="col-md-1">
                                <i class="fa-solid fa-chevron-down"></i>
                            </div>
                        </div>

                    </p>
                      <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <form action="/employes/filtre/query/name" method="post" >
                                @csrf
                                <input style="width: 265px" type="text" name="name" id="name" class="mt-3 form-control form-sm mb-2" placeholder="Entrez un nom ...">
                            </form>
                            <form action="/employes/filtre/query/matricule" method="post">
                                @csrf
                                <input style="width: 265px" type="text" name="matricule" id="matricule" class="mt-3 form-control form-sm mb-2" placeholder="Entrez une matricule ...">
                            </form>
                            <form action="/employes/filtre/query/role" method="post">
                                @csrf
                                <input style="width: 265px" type="text" name="role_name" id="role_name" class="mt-3 form-control form-sm mb-2" placeholder="Entrez un rôle ...">
                            </form>
                        </div>
                      </div> --}}

                      <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                              Référents
                            </button>
                          </h2>
                          <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="/referents/filtre/query/fonction" method="post" >
                                    @csrf
                                    <input style="width: 265px" type="text" name="fonctionReferent" id="fonctionReferent" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez une fonction ...">
                                </form>
                                <hr>
                                <form action="/referents/filtre/query/name" method="post" >
                                    @csrf
                                    <input style="width: 265px" type="text" name="nameReferent" id="nameReferent" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un nom ...">
                                </form>
                                <form action="/referents/filtre/query/matricule" method="post">
                                    @csrf
                                    <input style="width: 265px" type="text" name="matriculeReferent" id="matriculeReferent" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez une matricule ...">
                                </form>
                                <form action="/referents/filtre/query/role" method="post">
                                    @csrf
                                    <input style="width: 265px" type="text" name="roleReferent" id="roleReferent" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un rôle ...">
                                </form>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                              Employés
                            </button>
                          </h2>
                          <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="/employes/filtre/query/fonction" method="post">
                                    @csrf
                                    <input style="width: 265px" type="text" name="test" id="test" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez une fonction ...">
                                </form>
                                <hr>
                                <form action="/employes/filtre/query/name" method="post" >
                                    @csrf
                                    <input style="width: 265px" type="text" name="name" id="name" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un nom ...">
                                </form>
                                <form action="/employes/filtre/query/matricule" method="post">
                                    @csrf
                                    <input style="width: 265px" type="text" name="matricule" id="matricule" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez une matricule ...">
                                </form>
                                <form action="/employes/filtre/query/role" method="post">
                                    @csrf
                                    <input style="width: 265px" type="text" name="role_name" id="role_name" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un rôle ...">
                                </form>
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                          <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                              Formateur interne
                            </button>
                          </h2>
                          <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                {{-- <form action="/employes/filtre/query" method="post">
                                    @csrf

                                    <select name="test" id="test" class="form-control form-control-sm" style="width: 265px">
                                        <option value="0" selected="true" disabled="true">-- selectionner une fonction --</option>
                                        @foreach ($stagiaires as $stg)
                                            <option value="{{ $stg->id }}">{{ $stg->fonction_stagiaire }}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit" value="Filtrer" class="btn btn-sm mt-2" style="width: 150px; background-color: #7635dc; color: #fff">
                                </form>
                                <hr>
                                <form action="/employes/filtre/query/name" method="post" >
                                    @csrf
                                    <input style="width: 265px" type="text" name="name" id="name" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un nom ...">
                                </form>
                                <form action="/employes/filtre/query/matricule" method="post">
                                    @csrf
                                    <input style="width: 265px" type="text" name="matricule" id="matricule" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez une matricule ...">
                                </form>
                                <form action="/employes/filtre/query/role" method="post">
                                    @csrf
                                    <input style="width: 265px" type="text" name="role_name" id="role_name" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un rôle ...">
                                </form> --}}
                            </div>
                          </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingFour">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseThree">
                                Chef de département
                              </button>
                            </h2>
                            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    <form action="/chefs/filtre/query" method="post">
                                        @csrf
                                        <form action="/chefs/filtre/query/fonction" method="post" >
                                            @csrf
                                            <input style="width: 265px" type="text" name="fonctionChef" id="fonctionChef" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez une fonction ...">
                                        </form>
                                    </form>
                                    <hr>
                                    <form action="/chefs/filtre/query/name" method="post" >
                                        @csrf
                                        <input style="width: 265px" type="text" name="nameChef" id="nameChef" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un nom ...">
                                    </form>
                                    <form action="/chefs/filtre/query/matricule" method="post">
                                        @csrf
                                        <input style="width: 265px" type="text" name="matriculeChef" id="matriculeChef" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez une matricule ...">
                                    </form>
                                    <form action="/chefs/filtre/query/role" method="post">
                                        @csrf
                                        <input style="width: 265px" type="text" name="roleChef" id="roleChef" class="mt-3 form-control form-control-sm mb-2" placeholder="Entrez un rôle ...">
                                    </form>
                                </div>
                            </div>
                          </div>
                      </div>

                    {{-- <a style="color: blue; margin-top: 10px;" href="{{ route('employes') }}"><i class="fa-solid fa-arrow-rotate-right"></i> Actualiser</a> --}}
            </div>
        </div>
    </div>
</div>

{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
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

    $(document).ready(function(){
	$('#on').on('change',function(){
    	if(this.checked){
    		$("#info").text("mety iz zao");
    	}
        else{
        	$("#info").text("aha annh");
        }
    });
});

</script>

{{--filtre fonction employe--}}
<script type="text/javascript">
    $('body').on('keyup','#test',function(){
        $('#matricule').val('');
        $('#name').val('');
        $('#role_name').val('');
        $('.rnla').hide();
        $('.rnlh').hide();

        var test = $(this).val();
        console.log(test)

        $.ajax({
            method: 'GET',
            url: '{{ route("stagiaire.filter.fonction") }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                test: test,
            },
            success: function (res) {
                var tableRow ='';

                $('#dynamic_row').html('');

                $.each(res, function (index, value) {

                    tableRow += '<tr class="text-center content_table">';
                    tableRow +='<td><img src="{{asset("images/stagiaires/:?")}}" alt="" style="width:50px; height:50px; border-radius:100%">';
                    tableRow = tableRow.replace(":?",value.photos);
                    tableRow +=
                        '</td><td>'+value.matricule+
                        '</td><td>'+value.nom_stagiaire+
                        '</td><td>'+value.prenom_stagiaire+
                        '</td><td>'+value.fonction_stagiaire+
                        '</td><td>'+value.mail_stagiaire+
                        '</td><td>'+value.telephone_stagiaire+
                        '</td><td><i class="fa fa-check" style="color: green; margin-right: 5px"></i>'+value.role_name+
                        '</td><tr>';


                    console.log(tableRow);
                });
                $('#dynamic_row').append(tableRow);

            }

        });
    });
</script>

{{--filtre name--}}
<script type="text/javascript">
    $('body').on('keyup','#name',function(){
        $('#matricule').val('');
        $('#role_name').val('');
        $('#test').val('');
        $('.rnla').hide();
        $('.rnlh').hide();
        var name = $(this).val();
        console.log(name)

        $.ajax({
            method: 'GET',
            url: '{{ route("stagiaire.filter.name") }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                name: name,
            },
            success: function (res) {
                var tableRow ='';

                $('#dynamic_row').html('');

                $.each(res, function (index, value) {

                    tableRow += '<tr class="text-center content_table">';
                    tableRow +='<td><img src="{{asset("images/stagiaires/:?")}}" alt="" style="width:50px; height:50px; border-radius:100%">';
                    tableRow = tableRow.replace(":?",value.photos);
                    tableRow +=
                        '</td><td>'+value.matricule+
                        '</td><td>'+value.nom_stagiaire+
                        '</td><td>'+value.prenom_stagiaire+
                        '</td><td>'+value.fonction_stagiaire+
                        '</td><td>'+value.mail_stagiaire+
                        '</td><td>'+value.telephone_stagiaire+
                        '</td><td><i class="fa fa-check" style="color: green; margin-right: 5px"></i>'+value.role_name+
                        '</td><tr>';


                    console.log(tableRow);
                });
                $('#dynamic_row').append(tableRow);

            }

        });
    });
</script>

{{--filtre matricule--}}
<script type="text/javascript">
    $('body').on('keyup','#matricule',function(){
        $('#name').val('');
        $('#role_name').val('');
        $('#test').val('');
        $('.rnla').hide();
        $('.rnlh').hide();
        var matricule = $(this).val();
        console.log(matricule)

        $.ajax({
            method: 'GET',
            url: '{{ route("stagiaire.filter.matricule") }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                matricule: matricule,
            },
            success: function (res) {
                var tableRow ='';

                $('#dynamic_row').html('');

                $.each(res, function (index, value) {

                    tableRow += '<tr class="text-center content_table">';
                    tableRow +='<td><img src="{{asset("images/stagiaires/:?")}}" alt="" style="width:50px; height:50px; border-radius:100%">';
                    tableRow = tableRow.replace(":?",value.photos);
                    tableRow +=
                        '</td><td>'+value.matricule+
                        '</td><td>'+value.nom_stagiaire+
                        '</td><td>'+value.prenom_stagiaire+
                        '</td><td>'+value.fonction_stagiaire+
                        '</td><td>'+value.mail_stagiaire+
                        '</td><td>'+value.telephone_stagiaire+
                        '</td><td><i class="fa fa-check" style="color: green; margin-right: 5px"></i>'+value.role_name+
                        '</td><tr>';


                    console.log(tableRow);
                });
                $('#dynamic_row').append(tableRow);

            }

        });
    });
</script>

{{--filtre employe role--}}
<script type="text/javascript">
    $('body').on('keyup','#role_name',function(){
        $('#name').val('');
        $('#matricule').val('');
        $('#test').val('');
        $('.rnla').hide();
        $('.rnlh').hide();
        var role_name = $(this).val();
        console.log(role_name)

        $.ajax({
            method: 'GET',
            url: '{{ route("stagiaire.filter.role") }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                role_name: role_name,
            },
            success: function (res) {
                var tableRow ='';

                $('#dynamic_row').html('');

                $.each(res, function (index, value) {

                    tableRow += '<tr class="text-center content_table">';
                    tableRow +='<td><img src="{{asset("images/stagiaires/:?")}}" alt="" style="width:50px; height:50px; border-radius:100%">';
                    tableRow = tableRow.replace(":?",value.photos);
                    tableRow +=
                        '</td><td>'+value.matricule+
                        '</td><td>'+value.nom_stagiaire+
                        '</td><td>'+value.prenom_stagiaire+
                        '</td><td>'+value.fonction_stagiaire+
                        '</td><td>'+value.mail_stagiaire+
                        '</td><td>'+value.telephone_stagiaire+
                        '</td><td><i class="fa fa-check" style="color: green; margin-right: 5px"></i>'+value.role_name+
                        '</td><tr>';
                    console.log(tableRow);
                });
                $('#dynamic_row').append(tableRow);
            }

        });
    });
</script>

{{--filtre referent fonction--}}
<script type="text/javascript">
    $('body').on('keyup','#fonctionReferent',function(){
        $('#matriculeReferent').val('');
        $('#roleReferent').val('');
        $('#nameReferent').val('');

        var fonctionReferent = $(this).val();
        console.log(fonctionReferent)

        $.ajax({
            method: 'GET',
            url: '{{ route("referent.filter.fonction") }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                fonctionReferent: fonctionReferent,
            },
            success: function (res) {
                var tableRow ='';

                $('#dynamic_rowR').html('');

                $.each(res, function (index, value) {

                    tableRow += '<tr class="text-center content_table">';
                    tableRow +='<td><img src="{{asset("images/responsables/:?")}}" alt="" style="width:50px; height:50px; border-radius:100%">';
                    tableRow = tableRow.replace(":?",value.photos);
                    tableRow +=
                        '</td><td>'+value.matricule+
                        '</td><td>'+value.nom_resp+
                        '</td><td>'+value.prenom_resp+
                        '</td><td>'+value.fonction_resp+
                        '</td><td>'+value.email_resp+
                        '</td><td>'+value.telephone_resp+
                        '</td><td><i class="fa fa-check" style="color: green; margin-right: 5px"></i>'+value.role_name+
                        '</td><tr>';
                    console.log(tableRow);
                });
                $('#dynamic_rowR').append(tableRow);

            }

        });
    });
</script>

{{--filtre referent name--}}
    <script type="text/javascript">
        $('body').on('keyup','#nameReferent',function(){
            $('#matriculeReferent').val('');
            $('#roleReferent').val('');
            $('#fonctionReferent').val('');

            var nameReferent = $(this).val();
            console.log(nameReferent)

            $.ajax({
                method: 'GET',
                url: '{{ route("referent.filter.name") }}',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    nameReferent: nameReferent,
                },
                success: function (res) {
                    var tableRow ='';

                    $('#dynamic_rowR').html('');

                    $.each(res, function (index, value) {

                        tableRow += '<tr class="text-center content_table">';
                        tableRow +='<td><img src="{{asset("images/responsables/:?")}}" alt="" style="width:50px; height:50px; border-radius:100%">';
                        tableRow = tableRow.replace(":?",value.photos);
                        tableRow +=
                            '</td><td>'+value.matricule+
                            '</td><td>'+value.nom_resp+
                            '</td><td>'+value.prenom_resp+
                            '</td><td>'+value.fonction_resp+
                            '</td><td>'+value.email_resp+
                            '</td><td>'+value.telephone_resp+
                            '</td><td><i class="fa fa-check" style="color: green; margin-right: 5px"></i>'+value.role_name+
                            '</td><tr>';
                        console.log(tableRow);
                    });
                    $('#dynamic_rowR').append(tableRow);

                }

            });
        });
    </script>

    {{--filtre referent matricule--}}
    <script type="text/javascript">
        $('body').on('keyup','#matriculeReferent',function(){
            $('#nameReferent').val('');
            $('#roleReferent').val('');
            $('#fonctionReferent').val('');

            var matriculeReferent = $(this).val();
            console.log(matriculeReferent)

            $.ajax({
                method: 'GET',
                url: '{{ route("referent.filter.matricule") }}',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    matriculeReferent: matriculeReferent,
                },
                success: function (res) {
                    var tableRow ='';

                    $('#dynamic_rowR').html('');

                    $.each(res, function (index, value) {

                        tableRow += '<tr class="text-center content_table">';
                        tableRow +='<td><img src="{{asset("images/responsables/:?")}}" alt="" style="width:50px; height:50px; border-radius:100%">';
                        tableRow = tableRow.replace(":?",value.photos);
                        tableRow +=
                            '</td><td>'+value.matricule+
                            '</td><td>'+value.nom_resp+
                            '</td><td>'+value.prenom_resp+
                            '</td><td>'+value.fonction_resp+
                            '</td><td>'+value.email_resp+
                            '</td><td>'+value.telephone_resp+
                            '</td><td><i class="fa fa-check" style="color: green; margin-right: 5px"></i>'+value.role_name+
                            '</td><tr>';
                        console.log(tableRow);
                    });
                    $('#dynamic_rowR').append(tableRow);

                }

            });
        });
    </script>

{{--filtre referent role--}}
<script type="text/javascript">
    $('body').on('keyup','#roleReferent',function(){
        $('#nameReferent').val('');
        $('#matriculeReferent').val('');
        $('#fonctionReferent').val('');

        var roleReferent = $(this).val();
        console.log(roleReferent)

        $.ajax({
            method: 'GET',
            url: '{{ route("referent.filter.role") }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                roleReferent: roleReferent,
            },
            success: function (res) {
                var tableRow ='';

                $('#dynamic_rowR').html('');

                $.each(res, function (index, value) {

                    tableRow += '<tr class="text-center content_table">';
                    tableRow +='<td><img src="{{asset("images/responsables/:?")}}" alt="" style="width:50px; height:50px; border-radius:100%">';
                    tableRow = tableRow.replace(":?",value.photos);
                    tableRow +=
                        '</td><td>'+value.matricule+
                        '</td><td>'+value.nom_resp+
                        '</td><td>'+value.prenom_resp+
                        '</td><td>'+value.fonction_resp+
                        '</td><td>'+value.email_resp+
                        '</td><td>'+value.telephone_resp+
                        '</td><td><i class="fa fa-check" style="color: green; margin-right: 5px"></i>'+value.role_name+
                        '</td><tr>';
                    console.log(tableRow);
                });
                $('#dynamic_rowR').append(tableRow);

            }

        });
    });
</script>

{{--filtre chef fonction--}}
<script type="text/javascript">
    $('body').on('keyup','#fonctionChef',function(){
        $('#matriculeChef').val('');
        $('#roleChef').val('');
        $('#nameChef').val('');
        $('.rlc').hide();

        var fonctionChef = $(this).val();
        console.log(fonctionChef)

        $.ajax({
            method: 'GET',
            url: '{{ route("chef.filter.fonction") }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                fonctionChef: fonctionChef,
            },
            success: function (res) {
                var tableRow ='';

                $('#dynamic_rowC').html('');

                $.each(res, function (index, value) {

                    tableRow += '<tr class="text-center content_table">';
                    tableRow +='<td><img src="{{asset("images/chefDepartement/:?")}}" alt="" style="width:50px; height:50px; border-radius:100%">';
                    tableRow = tableRow.replace(":?",value.photos);
                    tableRow +=
                        '</td><td>'+value.id+
                        '</td><td>'+value.nom_chef+
                        '</td><td>'+value.prenom_chef+
                        '</td><td>'+value.fonction_chef+
                        '</td><td>'+value.mail_chef+
                        '</td><td>'+value.telephone_chef+
                        '</td><td><i class="fa fa-check" style="color: green; margin-right: 5px"></i>'+value.role_name+
                        '</td><tr>';
                    console.log(tableRow);
                });
                $('#dynamic_rowC').append(tableRow);

            }

        });
    });
</script>

{{--filtre chef name--}}
<script type="text/javascript">
    $('body').on('keyup','#nameChef',function(){
        $('#matriculeChef').val('');
        $('#roleChef').val('');
        $('#fonctionChef').val('');
        $('.rlc').hide();

        var nameChef = $(this).val();
        console.log(nameChef)

        $.ajax({
            method: 'GET',
            url: '{{ route("chef.filter.name") }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                nameChef: nameChef,
            },
            success: function (res) {
                var tableRow ='';

                $('#dynamic_rowC').html('');

                $.each(res, function (index, value) {

                    tableRow += '<tr class="text-center content_table">';
                    tableRow +='<td><img src="{{asset("images/chefDepartement/:?")}}" alt="" style="width:50px; height:50px; border-radius:100%">';
                    tableRow = tableRow.replace(":?",value.photos);
                    tableRow +=
                        '</td><td>'+value.id+
                        '</td><td>'+value.nom_chef+
                        '</td><td>'+value.prenom_chef+
                        '</td><td>'+value.fonction_chef+
                        '</td><td>'+value.mail_chef+
                        '</td><td>'+value.telephone_chef+
                        '</td><td><i class="fa fa-check" style="color: green; margin-right: 5px"></i>'+value.role_name+
                        '</td><tr>';
                    console.log(tableRow);
                });
                $('#dynamic_rowC').append(tableRow);

            }

        });
    });
</script>

{{--filtre chef matricule--}}
<script type="text/javascript">
    $('body').on('keyup','#matriculeChef',function(){
        $('#roleChef').val('');
        $('#nameChef').val('');
        $('#fonctionChef').val('');
        $('.rlc').hide();

        var matriculeChef = $(this).val();
        console.log(matriculeChef)

        $.ajax({
            method: 'GET',
            url: '{{ route("chef.filter.matricule") }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                matriculeChef: matriculeChef,
            },
            success: function (res) {
                var tableRow ='';

                $('#dynamic_rowC').html('');

                $.each(res, function (index, value) {

                    tableRow += '<tr class="text-center content_table">';
                    tableRow +='<td><img src="{{asset("images/chefDepartement/:?")}}" alt="" style="width:50px; height:50px; border-radius:100%">';
                    tableRow = tableRow.replace(":?",value.photos);
                    tableRow +=
                        '</td><td>'+value.id+
                        '</td><td>'+value.nom_chef+
                        '</td><td>'+value.prenom_chef+
                        '</td><td>'+value.fonction_chef+
                        '</td><td>'+value.mail_chef+
                        '</td><td>'+value.telephone_chef+
                        '</td><td><i class="fa fa-check" style="color: green; margin-right: 5px"></i>'+value.role_name+
                        '</td><tr>';
                    console.log(tableRow);
                });
                $('#dynamic_rowC').append(tableRow);

            }

        });
    });
</script>

{{--filtre chef role--}}
<script type="text/javascript">
    $('body').on('keyup','#roleChef',function(){
        $('#matriculeChef').val('');
        $('#nameChef').val('');
        $('#fonctionChef').val('');
        $('.rlc').hide();

        var roleChef = $(this).val();
        console.log(roleChef)

        $.ajax({
            method: 'GET',
            url: '{{ route("chef.filter.role") }}',
            dataType: 'json',
            data: {
                '_token': '{{ csrf_token() }}',
                roleChef: roleChef,
            },
            success: function (res) {
                var tableRow ='';

                $('#dynamic_rowC').html('');

                $.each(res, function (index, value) {

                    tableRow += '<tr class="text-center content_table">';
                    tableRow +='<td><img src="{{asset("images/chefDepartement/:?")}}" alt="" style="width:50px; height:50px; border-radius:100%">';
                    tableRow = tableRow.replace(":?",value.photos);
                    tableRow +=
                        '</td><td>'+value.id+
                        '</td><td>'+value.nom_chef+
                        '</td><td>'+value.prenom_chef+
                        '</td><td>'+value.fonction_chef+
                        '</td><td>'+value.mail_chef+
                        '</td><td>'+value.telephone_chef+
                        '</td><td><i class="fa fa-check" style="color: green; margin-right: 5px"></i>'+value.role_name+
                        '</td><tr>';
                    console.log(tableRow);
                });
                $('#dynamic_rowC').append(tableRow);

            }

        });
    });
</script>

<script>
    $(document).ready(function () {
        $('#employé').addClass('bgTest');

        $("#employé").click(function(){
            $('#employé').addClass('bgTest');
            $("#referent").removeClass("bgTest");
            $('#formateur').removeClass('bgTest');
            $('#manager').removeClass('bgTest');
        });

        $("#referent").click(function(){
            $('#referent').addClass('bgTest');
            $("#employé").removeClass("bgTest");
            $('#formateur').removeClass('bgTest');
            $('#manager').removeClass('bgTest');
        });

        $("#manager").click(function(){
            $('#manager').addClass('bgTest');
            $("#employé").removeClass("bgTest");
            $("#referent").removeClass("bgTest");
            $('#formateur').removeClass('bgTest');
        });

        $("#formateur").click(function(){
            $('#formateur').addClass('bgTest');
            $("#employé").removeClass("bgTest");
            $("#referent").removeClass("bgTest");
            $('#manager').removeClass('bgTest');
        });
    });
</script>
@endsection