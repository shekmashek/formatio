@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <h3>PROJET DE FORMATION</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">


                    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                                    <li class="nav-item">
                                        <a class="nav-link  {{ Route::currentRouteNamed('liste_projet') || Route::currentRouteNamed('liste_projet') ? 'active' : '' }}"
                                            href="{{ route('liste_projet') }}">
                                            <i class="fa fa-list">Liste des Projets</i></a>
                                    </li>

                                    <li class="nav-item">

                                        {{-- <a
                                            class="nav-link  {{ Route::currentRouteNamed('liste_groupe') ? 'active' : '' }}"
                                            aria-current="page" href="{{route('liste_groupe')}}">
                                            <i class="fa fa-list">Listes des Groupes</i></a>

                                    </li> --}}
                                    {{-- <li class="nav-item">
                                        <a class="nav-link  {{ Route::currentRouteNamed('nouveau_groupe') ? 'active' : '' }}"
                                            href="{{route('nouveau_groupe')}}"><i class="fa fa-plus">Nouveau
                                                Groupe</i></a>
                                    </li> --}}


                                </ul>



                            </div>
                        </div>
                    </nav>

                    <div class="panel-body">

                        <div class="row">

                            <div class="col-md-4">

                                <div class="card">
                                    <div class="card-body">

                                        @canany(['isManager', 'isReferent', 'isSuperAdmin', 'isAdmin'])
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title">
                                                    <img src="{{ asset('images/CFP/' . $projet->logo_cfp) }}"
                                                        alt="logonmk" class="logo">
                                                    <a href="#" class="btn btn-warning" data-toggle="collapse"
                                                        data-target="#info_cfp">
                                                        {{ $projet->nom_cfp }}
                                                    </a>
                                                </h5>

                                                <div id="info_cfp" class="collapse">
                                                    <div class="row">
                                                        <div class="col">
                                                            <p>domaine de formation:</p>
                                                        </div>
                                                        <div class="col">
                                                            <p>{{ $projet->domaine_de_formation_cfp }}</p>
                                                        </div>
                                                    </div>

                                                    <p>Téléphone: {{ $projet->tel_cfp }}</p>
                                                    <p>E-mail: <strong style="color: blue">{{ $projet->mail_cfp
                                                            }}</strong> </p>
                                                </div>

                                            </div>
                                            <div class="col"></div>
                                        </div>
                                        @endcanany
                                        @if (Session::has('groupe_error'))
                                        <div class="alert alert-danger">
                                            <ul>
                                                <li>{{ Session::get('groupe_error') }}</li>
                                            </ul>
                                        </div>
                                        @endif
                                        <h6 class="card-title my-2">Nom du projet: <strong style="color: green">{{
                                                $projet->nom_projet }}</strong> </h6>
                                        <h6 class="card-title my-2">Type de la formation: <strong
                                                style="color: green">{{ $projet->type_formation }}</strong> </h6>
                                        {{-- <h6 class="card-subtitle mb-2 text-muted">Status: <strong
                                                style="color: rgb(145, 40, 231)"> {{$projet->status}} </strong></h6>
                                        --}}
                                        <p class="card-text">Date de création:
                                            {{ date('M j, Y', strtotime($projet->date_projet)) }}</p>
                                    </div>
                                </div>

                                @canany(['isCFP'])
                                @if ($projet->type_formation_id == 2 && count($groupe)<=0) <button
                                    class="btn btn-success mb-2 payement" data-toggle="modal" data-target="#modal"><i
                                        class="fa fa-plus"></i> session</button>
                                    @endif
                                    @if ($projet->type_formation_id == 1)
                                    <button class="btn btn-success mb-2 payement" data-toggle="modal"
                                        data-target="#modal"><i class="fa fa-plus"></i> session</button>
                                    @endif
                                    @endcanany
                                    @error('dte_debut')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{ $message }} </span>
                                    </div>
                                    @enderror
                                    @error('dte_fin')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{ $message }} </span>
                                    </div>
                                    @enderror
                                    @error('min_part')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{ $message }} </span>
                                    </div>
                                    @enderror
                                    @error('max_part')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{ $message }} </span>
                                    </div>
                                    @enderror
                                    @error('module_id')
                                    <div class="col-sm-6">
                                        <span style="color:#ff0000;"> {{ $message }} </span>
                                    </div>
                                    @enderror
                            </div>

                            <div class="col-md-8">
                                <table class="table my-2">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">min participant</th>
                                            <th scope="col">max participant</th>
                                            <th scope="col">module</th>
                                            <th scope="col">formation</th>
                                            <th scope="col">date début</th>
                                            <th scope="col">date fin</th>
                                            <th scope="col">status</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($groupe as $grp)
                                        <tr>
                                            <th scope="row">{{ $grp->nom_groupe }}</th>
                                            <td>{{ $grp->min_participant }}</td>
                                            <td>{{ $grp->max_participant }}</td>
                                            <td>{{ $grp->nom_module }}</td>
                                            <td>{{ $grp->nom_formation }}</td>
                                            <td>{{ $grp->date_debut }}</td>
                                            <td>{{ $grp->date_fin }}</td>
                                            <td>{{ $grp->status_groupe }}</td>
                                            <td>
                                                @canany(['isCFP'])
                                                <button class="btn btn-success mb-2 payement" data-toggle="modal"
                                                    data-target="#edit_session_{{ $grp->groupe_id }}"><i
                                                        class="fa fa-edit"></i></button>
                                                @endcanany

                                            </td>
                                        </tr>

                                        {{-- debut modifier session --}}
                                        <div id="edit_session_{{ $grp->groupe_id }}" class="modal fade"
                                            data-backdrop="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div class="modal-title text-md">
                                                            <h5>Modification Session</h5>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card p-3 cardPayement">
                                                            <form action="{{ route('update_groupe', $grp->groupe_id) }}"
                                                                id="zsxsq" method="POST">
                                                                @csrf
                                                                <span>{{ $grp->nom_groupe }}</span>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <span>Date début</span>
                                                                        <div class="inputbox inputboxP mt-0"> <input
                                                                                autocomplete="off" type="date"
                                                                                value="{{ $grp->date_debut }}"
                                                                                name="edit_dte_debut"
                                                                                class="form-control formPayement"
                                                                                required="required"> </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <span>Date fin</span>
                                                                        <div class="inputbox inputboxP mt-0"> <input
                                                                                autocomplete="off" type="date"
                                                                                value="{{ $grp->date_fin }}"
                                                                                name="edit_dte_fin"
                                                                                class="form-control formPayement"
                                                                                required="required"> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <span>Min participant</span>
                                                                        <div class="inputbox inputboxP mt-0"> <input
                                                                                autocomplete="off" type="number"
                                                                                value="{{ $grp->min_participant }}"
                                                                                min="0" pattern="[0-9]"
                                                                                name="edit_min_part"
                                                                                class="form-control formPayement"
                                                                                required="required"> </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <span>Max participant</span>
                                                                        <div class="inputbox inputboxP mt-0"> <input
                                                                                autocomplete="off" type="number"
                                                                                value="{{ $grp->max_participant }}"
                                                                                min="0" pattern="[0-9]"
                                                                                name="edit_max_part"
                                                                                class="form-control formPayement"
                                                                                required="required"> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <span>Payement</span>
                                                                        <select class="form-select m-0" name="payement"
                                                                            aria-label="Default select example">
                                                                            <option
                                                                                value="{{ $grp->type_payement_id }}">{{
                                                                                $grp->type_payement }}</option>
                                                                            @foreach ($payement as $paye)
                                                                            <option value="{{ $paye->id }}">
                                                                                {{ $paye->type }}
                                                                            </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="inputbox inputboxP mt-0">
                                                                    <span>Formation</span> </div>
                                                                <select class="form-select selectP m-0"
                                                                    id="formation_id" name="formation_id"
                                                                    aria-label="Default select example">
                                                                    <option value="{{ $grp->formation_id }}">{{
                                                                        $grp->nom_formation }}</option>
                                                                    @foreach ($formation as $form)
                                                                    <option value="{{ $form->id }}">
                                                                        {{ $form->nom_formation }}</option>
                                                                    @endforeach
                                                                </select>

                                                                <span>Module</span>
                                                                <input hidden name="projet_id"
                                                                    value="{{ $projet->projet_id }}">
                                                                <select class="form-select selectP m-0 p-0"
                                                                    id="module_id" name="module_id"
                                                                    aria-label="Default select example">
                                                                    <option value="{{ $grp->module_id }}">{{
                                                                        $grp->nom_module }}</option>
                                                                </select>
                                                                {{-- <span style="color:#ff0000;"
                                                                    id="module_id_err">Aucun module détecté!
                                                                    veuillez choisir la formation</span> --}}

                                                                {{-- <strong>Status du session</strong>
                                                                <div class="inputbox inputboxP mt-3">
                                                                    <input class="form-control"
                                                                        id="exampleFormControlInput1" list="edit_status"
                                                                        placeholder="Choisissez le statut du projet"
                                                                        name="edit_status" />
                                                                    <datalist id="edit_status">
                                                                        <option>En Cours</option>
                                                                        <option>Fini</option>
                                                                        <option>Stopper la formation</option>
                                                                    </datalist>

                                                                </div> --}}


                                                                <div class="mt-4 mb-4">
                                                                    <div
                                                                        class="mt-4 mb-4 d-flex justify-content-between">
                                                                        <span><button type="button"
                                                                                class="btn btn-danger annuler"
                                                                                data-dismiss="modal">Annuler</button></span>
                                                                        <button type="submit"
                                                                            class="btn btn-success btnP px-3">Valider</button>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        {{-- fin --}}
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>



                        {{-- debut modal nouveau session --}}
                        <div id="modal" class="modal fade" data-backdrop="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title text-md">
                                            <h5>Nouveau Session</h5>
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card p-3 cardPayement">
                                            <form action="{{ route('groupe.store') }}" id="formPayement" method="POST">
                                                @csrf
                                                <div class="row mt-0 mb-0 pt-0 pb-0">
                                                    <div class="col">
                                                        <span>Date début</span>
                                                        <div class="inputbox inputboxP p-0 mt-0"> <input
                                                                autocomplete="off" type="date" name="date_debut"
                                                                class="form-control formPayement" required="required">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <span>Date fin</span>
                                                        <div class="inputbox inputboxP p-0 mt-0"> <input
                                                                autocomplete="off" type="date" name="date_fin"
                                                                class="form-control formPayement" required="required">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row mt-0 ">
                                                    <div class="col">
                                                        <span>Min participant</span>
                                                        <div class="inputbox inputboxP m-0"> <input autocomplete="off"
                                                                type="number" value="0" min="0" pattern="[0-9]"
                                                                name="min_part" class="form-control formPayement m-0"
                                                                required="required"> </div>
                                                    </div>
                                                    <div class="col">
                                                        <span>Max participant</span>
                                                        <div class="inputbox inputboxP m-0"> <input autocomplete="off"
                                                                type="number" value="0" min="0" pattern="[0-9]"
                                                                name="max_part" class="form-control formPayement m-0"
                                                                required="required"> </div>
                                                    </div>
                                                </div>
                                                <div class="inputbox inputboxP mt-0"><span>Formation</span> </div>
                                                <select class="form-select selectP m-0" id="formation_id"
                                                    name="formation_id" aria-label="Default select example">
                                                    <option onselected>Choisissez la formation du session</option>
                                                    @foreach ($formation as $form)
                                                    <option value="{{ $form->id }}">
                                                        {{ $form->nom_formation }}</option>
                                                    @endforeach
                                                </select>

                                                <span>Module</span>
                                                <input hidden name="projet_id" value="{{ $projet->projet_id }}">
                                                <select class="form-select selectP m-0 p-0" id="module_id"
                                                    name="module_id" aria-label="Default select example"></select>
                                                <span style="color:#ff0000;" id="module_id_err">Aucun module détecté!
                                                    veuillez choisir la formation</span>
                                                <div class="mt-0 mb-0">
                                                    <div class="row">
                                                        <div class="col">
                                                            <span>Payement</span>
                                                            <select class="form-select m-0" name="payement"
                                                                aria-label="Default select example">
                                                                @foreach ($payement as $paye)
                                                                <option value="{{ $paye->id }}">{{ $paye->type }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if ($projet->type_formation_id == 1)
                                                    <div class="row">
                                                        <div class="col">
                                                            <span>Entreprise</span>
                                                            <select class="form-select m-0" name="entreprise"
                                                                aria-label="Default select example">
                                                                @foreach ($entreprise as $etp)
                                                                <option value="{{ $etp->entreprise_id }}">
                                                                    {{ $etp->nom_etp }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @if ($projet->type_formation_id == 2)
                                                    <div class="row m-0 p-0">
                                                        <div class="col">
                                                            @foreach ($entreprise as $etp)
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" name="entreprise[]"
                                                                    type="checkbox" id="inlineCheckbox1"
                                                                    value="{{ $etp->entreprise_id }}" required>
                                                                <label class="form-check-label me-2"
                                                                    for="inlineCheckbox1">{{ $etp->nom_etp }}</label>
                                                            </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    @endif
                                                    <div class="mt-4 mb-4 d-flex justify-content-between"> <span><button
                                                                type="button" class="btn btn-danger annuler"
                                                                data-dismiss="modal">Annuler</button></span> <button
                                                            type="submit" form="formPayement"
                                                            class="btn btn-success btnP px-3">Valider</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        {{-- fin --}}

                        {{-- <div class="row">
                            <div class="col-lg-6">
                                <form action="{{route('groupe.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="projet">Nom du projet</label><br>

                                    </div>
                                    <div class="form-group">
                                        <label for="username">Groupe</label>
                                        <input type="text" class="form-control" id="nom_groupe" name="nom_groupe"
                                            placeholder="Nom">
                                        @error('nom_groupe')
                                        <div class="col-sm-6">
                                            <span style="color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>

                                    <button type="submit" class="btn btn-secondary "><span
                                            class="glyphicon glyphicon-plus-sign"></span> Ajouter

                                </form>
                            </div>
                        </div> --}}


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript">
    $('#formation_id').on('change', function() {
            var id = $('#formation_id').val();
            $("#module_id option").remove();
            $.ajax({
                method: "GET",
                url: "{{ route('module_formation') }}",
                data: {
                    id: id
                },
                dataType: "html",
                _token: "{{ csrf_token() }}",
                success: function(response) {
                    var data = JSON.parse(response);
                    if (data.length <= 0) {
                        document.getElementById("module_id_err").innerHTML =
                            "Aucun module a été détecter! veuillez choisir la formation";
                    } else {
                        document.getElementById("module_id_err").innerHTML = "";
                        for (var $i = 0; $i < data.length; $i++) {
                            $("#module_id").append('<option value="' + data[$i].id + '">' + data[$i]
                                .nom_module + '</option>');
                        }
                    }
                },
                error: function(error) {
                    console.log(error)
                }
            });

        });
</script>

@endsection