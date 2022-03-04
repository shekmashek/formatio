@extends('./layouts/admin')
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/projets.css') }}">
    <div class="container-fluid">
        <div class="row">
            <h3 class="mt-5 mb-3 text-center">Listes des Projets Intra et Inter</h3>
            <div class="col-2 pe-3">
                @canany(['isReferent', 'isCFP'])
                    <div class="row mb-3 p-2 filtre_date">
                        <h6 class="text-center mt-2">Filtrer vos Projets</h6>
                        <form action="{{ route('liste_projet') }}" method="GET">
                            <input type="hidden" name="type_formation" value="{{ $type_formation_id }}">
                            <div class="row px-3 mt-2">
                                    <select name="mois" id="mois" class="filtre_projet">
                                        <option value="null" selected>Mois</option>
                                        <option style="background-color: red;color: red;" value="1">Janvier</option>
                                        <option value="2">Février</option>
                                        <option value="3">Mars</option>
                                        <option value="4">Avril</option>
                                        <option value="5">Mai</option>
                                        <option value="6">Juin</option>
                                        <option value="7">Juillet</option>
                                        <option value="8">Août</option>
                                        <option value="9">Septembre</option>
                                        <option value="10">Octobre</option>
                                        <option value="11">Novembre</option>
                                        <option value="12">Décembre</option>
                                    </select>
                                </div>
                                <div class="row px-3 mt-2">
                                            <select name="trimestre" id="trimestre" class="filtre_projet">
                                        <option value="null" selected>Trimestres</option>
                                        <option value="1">1e Trimestre</option>
                                        <option value="2">2e Trimestre</option>
                                        <option value="3">3e Trimestre</option>
                                        <option value="4">4e Trimestre</option>
                                    </select>

                                    </div>

                                    <div class="row px-3 mt-2">
                                    <select name="semestre" id="semestre" class="filtre_projet">
                                        <option value="null" selected>Semestres</option>
                                        <option value="1">1e Semestre</option>
                                        <option value="2">2e Semestre</option>
                                    </select>

                            </div>

                            <div class="row px-3 mt-2">
                                    <select name="annee" id="annee" class="filtre_projet">
                                        <option value="null" selected>Années</option>
                                    </select>
                                    <button class="btn btn_competence mt-3 mb-3" type="submit">Appliquer</button>
                            </div>

                        </form>
                    </div>
                @endcanany
            </div>


            <div class="col-10 ps-5">
                <div class="row">
                @canany(['isCFP', 'isFormateur'])
                    <div class="m" id="corps">
                        @if (count($projet) <= 0)
                            <div class="row d-flex mt-3 titre_projet p-1 mb-1">
                                <p class="text-center text_aucun">Vous n'avez pas encore du projet.</p>
                            </div>
                        @endif
                        @foreach ($projet as $prj)

                                <div class="row mt-3 titre_projet p-1 mb-1 w-100">

                                    <div class="col-4 p-0"><h6 class="mb-0 changer_carret d-flex pt-2" data-bs-toggle="collapse"
                                        href="#collapseprojet_{{ $prj->projet_id }}" role="button" aria-expanded="false"
                                        aria-controls="collapseprojet"><i class="bx bx-caret-down carret-icon"></i>&nbsp;
                                        @php if ($prj->totale_session == 1) {
                                                    echo $prj->nom_projet . '(' . $prj->totale_session . ' session)';
                                                } elseif ($prj->totale_session > 1) {
                                                    echo $prj->nom_projet . '(' . $prj->totale_session . ' sessions)';
                                            }
                                        @endphp
                                        &nbsp;&nbsp;&#10148;&nbsp;@php
                                            setlocale(LC_TIME, 'fr_FR');
                                        echo strftime('%d %B, %Y', strtotime($prj->date_projet)); @endphp @if ($type_formation_id == 1)
                                            {{-- {{ $data[0]->nom_etp }} --}}
                                        @endif
                                        &nbsp;&nbsp;</h6>
                                    </div>
                                    <div class="col-1 p-0">
                                        @if ($prj->type_formation_id == 1)
                                            <h6 class="m-0"><button
                                                    class="type_intra mt-1 m-0 filtre_projet">{{ $prj->type_formation }}</button></h6>
                                            &nbsp;&nbsp;
                                        @elseif ($prj->type_formation_id == 2)
                                            <h6 class="m-0"><button
                                                    class="type_inter mt-1 m-0">{{ $prj->type_formation }}</button></h6>&nbsp;&nbsp;
                                        @endif
                                    </div>
                                    <div class="col-4 p-0">
                                        @foreach ($projet_formation as $pf)
                                        @if ($pf->projet_id == $prj->projet_id)
                                            <h6 class="m-0"><label
                                                    class="projet_formation mt-1 m-0">{{ $pf->nom_formation }}</label></h6>
                                            &nbsp;&nbsp;
                                        @endif
                                        @endforeach
                                    </div>
                                    <div class="col-1 text-end p-0">
                                        @can('isCFP')
                                            @if ($prj->type_formation_id == 1)
                                                <span type="button" class=" m-0 nouvelle_session text-end" data-bs-toggle="modal"
                                                    data-bs-target="#modal_{{ $prj->projet_id }}"><i class="bx bx-plus-circle btn_plus"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="Nouvelle session"></i></span>
                                            @endif
                                        @endcan
                                    </div>
                            </div>

                            <table class="table table-stripped m-0 p-0 collapse" id="collapseprojet_{{ $prj->projet_id }}">
                                <thead class="thead_projet">
                                    <th> Session </th>
                                    <th> Module </th>
                                    @can('isCFP')
                                        @if ($prj->type_formation_id == 1)
                                            <th> Entreprise </th>
                                        @endif
                                    @endcan
                                    @can('isReferent')
                                        @if ($prj->type_formation_id == 1)
                                            <th> Centre de formation </th>
                                        @endif
                                    @endcan
                                    <th> Date du projet</th>

                                    <th> Statut </th>
                                    {{-- <th></th> --}}
                                </thead>
                                <tbody class="tbody_projet">

                                    @if ($prj->totale_session <= 0)
                                        <tr>
                                            <td colspan="5"> Aucun session</td>

                                        </tr>
                                    @else
                                        @foreach ($data as $pj)
                                            @if ($prj->projet_id == $pj->projet_id)
                                                <tr>
                                                    <td> <a
                                                            href="{{ route('detail_session', [$pj->groupe_id, $type_formation_id]) }}">{{ $pj->nom_groupe }}</a>
                                                    </td>
                                                    <td>{{ $pj->nom_module }}</td>
                                                    @can('isCFP')
                                                        @if ($pj->type_formation_id == 1)
                                                            <td> {{ $pj->nom_etp }} </td>
                                                        @endif
                                                    @endcan
                                                    @can('isReferent')
                                                        @if ($pj->type_formation_id == 1)
                                                            <td> {{ $pj->nom_cfp }} </td>
                                                        @endif
                                                    @endcan
                                                    {{-- @can('isCFP')
                         @if ($pj->type_formation_id == 1)<td> {{ $pj->nom_etp }} </td>@endif
                        @endcan --}}
                                                    <td> {{ $pj->date_debut . ' au ' . $pj->date_fin }} </td>
                                                    <td>
                                                        <p class="en_cours m-0 p-0">{{ $pj->item_status_groupe }}</p>
                                                    </td>
                                                    {{-- <td><i type="button" class="fa fa-edit" data-bs-toggle="modal"
                                data-bs-target="#edit_prj_{{ $pj->projet_id }}"></i></td> --}}

                                                    {{-- debut modal edit projet --}}
                                                    <div id="edit_prj_{{ $pj->projet_id }}" class="modal fade modal_projets"
                                                        data-backdrop="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="text-center w-100">Modification de la Status du
                                                                        Session dans le&nbsp;{{$pj->nom_projet }}
                                                                    </h5>

                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="{{ route('update_projet', $pj->projet_id) }}"
                                                                        id="zsxsq" method="POST">
                                                                        @csrf
                                                                        <div class="row px-3 mt-2">
                                                                            <div class="form-group mt-1 mb-1">
                                                                                <select class="form-select selectP input"
                                                                                    id="formation_id" name="formation_id"
                                                                                    aria-label="Default select example">
                                                                                    <option onselected hidden>choisir la status
                                                                                        du session</option>
                                                                                    @foreach ($status as $stat)
                                                                                        <option value="{{ $stat->id }}">
                                                                                            {{ $stat->status }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <label class="ml-3 form-control-placeholder"
                                                                                    for="formation_id">Status</label>
                                                                            </div>
                                                                        </div>


                                                                        <div class="mt-4 mb-4">
                                                                            <div
                                                                                class="mt-4 mb-4 d-flex justify-content-around">
                                                                                <div class="text-center px-3"><button
                                                                                        type="submit" form="formPayement"
                                                                                        class="btn btn_enregistrer">Valider</button>
                                                                                </div>
                                                                                <div class="text-center px-3"><button
                                                                                        type="button" class="btn btn_annuler"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close">Annuler</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    {{-- fin --}}
                                                    {{-- debut modal nouveau session --}}
                                                    <div id="modal_{{ $pj->projet_id }}" class="modal fade modal_projets"
                                                        data-backdrop="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="w-100 text-center">Nouvelle Session pour
                                                                        le&nbsp;{{$pj->nom_projet }}
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('insert_session') }}"
                                                                        id="formPayement" method="POST"
                                                                        class="justify-content-center me-5">
                                                                        @csrf
                                                                        <input type="hidden" name="type_formation" value="1">
                                                                        <input type="hidden" name="projet"
                                                                            value="{{ $pj->projet_id }}">
                                                                        <div class="row">
                                                                            <h5 class="mb-4 text-center">Ajouter votre nouvelle
                                                                                Session</h5>
                                                                            <div class="form-group">
                                                                                <div class="form-row d-flex">
                                                                                    <div class="col">
                                                                                        <div class="row px-3 mt-2">
                                                                                            <div class="form-group mt-1 mb-1">
                                                                                                <input type="text" id="min"
                                                                                                    class="form-control input"
                                                                                                    min="1" max="50"
                                                                                                    name="min_part" required
                                                                                                    onfocus="(this.type='number')">
                                                                                                <label
                                                                                                    class="form-control-placeholder"
                                                                                                    for="min">Participant
                                                                                                    minimal</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row px-3 mt-2">
                                                                                            <div class="form-group mt-1 mb-1">
                                                                                                <input type="text" id="min"
                                                                                                    class="form-control input"
                                                                                                    name="date_debut" required
                                                                                                    onfocus="(this.type='date')">
                                                                                                <label
                                                                                                    class="form-control-placeholder"
                                                                                                    for="min">Date debut</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="text-center px-3"><button
                                                                                                type="submit"
                                                                                                form="formPayement"
                                                                                                class="btn btn_enregistrer">Valider</button>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col">
                                                                                        <div class="row px-3 mt-2">
                                                                                            <div class="form-group mt-1 mb-1">
                                                                                                <input type="text" id="min"
                                                                                                    class="form-control input"
                                                                                                    min="1" max="50"
                                                                                                    name="max_part" required
                                                                                                    onfocus="(this.type='number')">
                                                                                                <label
                                                                                                    class="form-control-placeholder"
                                                                                                    for="min">Participant
                                                                                                    maximal</label>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row px-3 mt-2">
                                                                                            <div class="form-group mt-1 mb-1">
                                                                                                <input type="text" id="min"
                                                                                                    class="form-control input"
                                                                                                    name="date_fin" required
                                                                                                    onfocus="(this.type='date')">
                                                                                                <label
                                                                                                    class=" form-control-placeholder"
                                                                                                    for="min">Date fin</label>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="text-center px-3"><button
                                                                                                type="button"
                                                                                                class="btn btn_annuler"
                                                                                                data-bs-dismiss="modal"
                                                                                                aria-label="Close">Annuler</button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- fin --}}
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        @endforeach
                    </div>
                @endcanany
                @can('isReferent')
                    @if (count($data) <= 0)
                        <div class="d-flex mt-3 titre_projet p-1 mb-1">
                            <span class="text-center">Vous n'avez pas encore du projet.</span>
                        </div>
                    @else
                        <table class="table table-stroped m-0 p-0">
                            <thead class="thead_projet">
                                <th>Projet</th>
                                <th> Session </th>
                                <th> Centre de formation </th>
                                <th> Date du projet</th>

                                <th> Statut </th>
                            </thead>
                            <tbody class="tbody_projet">
                                @foreach ($data as $pj)
                                    <tr>
                                        <td>{{ $pj->nom_projet }}</td>
                                        <td> <a
                                                href="{{ route('detail_session', $pj->groupe_id) }}">{{ $pj->nom_groupe }}</a>
                                        </td>
                                        <td> {{ $pj->nom_cfp }} </td>
                                        <td> {{ date('d-m-Y', strtotime($pj->date_projet)) }} </td>
                                        <td>
                                            <p class="en_cours m-0 p-0">{{ $pj->status_groupe }}</p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                @endcan
                @can('isStagiaire')
                    @if (count($data) <= 0)
                        <div class="d-flex mt-3 titre_projet p-1 mb-1">
                            <span class="text-center">Vous n'avez pas encore du projet.</span>
                        </div>
                    @else
                        <table class="table table-stroped m-0 p-0">
                            <thead class="thead_projet">
                                {{-- <th>Projet</th> --}}
                                <th> Session </th>
                                <th> Date du session</th>
                                <th> Centre de formation </th>
                                <th> Formation </th>
                                <th> Module</th>
                                <th>Evaluation </th>
                            </thead>
                            <tbody class="tbody_projet">
                                @foreach ($data as $pj)
                                    <tr>
                                        {{-- <td>{{ $pj->nom_projet }}</td> --}}
                                        <td> {{ $pj->nom_groupe }}</td>
                                        <td> {{ date('d-m-Y', strtotime($pj->date_debut)) }}-{{ date('d-m-Y', strtotime($pj->date_fin)) }}
                                        </td>
                                        <td> {{ $pj->nom_cfp }} </td>
                                        <td> {{ $pj->nom_formation }} </td>
                                        <td> {{ $pj->nom_module }} </td>
                                        <td>
                                            <a class="btn btn_filtre filtre_appliquer"
                                                href="{{ route('faireEvaluationChaud', [$pj->groupe_id]) }}">Evaluation</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    @endcan
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="{{ asset('js/index2.js') }}"></script>
    @endsection
