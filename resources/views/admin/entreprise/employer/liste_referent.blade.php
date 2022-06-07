
<div class="tab-content">
    <div class="m-5 tab-pane fade show active" id="emp-list" role="tabpanel" aria-labelledby="emp-list">

        <table id="example" class="table " style="width:100%">
            <thead>
                <tr>
                    <th class="id">ID</th>
                    <th scope="col" class="table-head font-weight-light align-middle text-center ">Employé</th>
                    <th scope="col" class="table-head font-weight-light align-middle text-center ">Contacts</th>
                    <th scope="col" class="table-head font-weight-light align-middle text-center ">
                        <span class="d-block">Département</span>
                        <span>Service</span>
                    </th>
                    {{-- <th scope="col" class="table-head font-weight-light align-middle text-center ">Age</th> --}}
                    <th scope="col" class="table-head font-weight-light align-middle text-center ">Ajout</th>

                    <th scope="col" class="table-head font-weight-light align-middle text-center ">Status</th>
                    <th scope="col" class="table-head font-weight-light align-middle text-center ">Référent</th>
                    <th scope="col" class="table-head font-weight-light align-middle text-center ">Actions</th>

                </tr>
            </thead>
            <tbody>
                @forelse ($employers as $employe)
                    @if ($employe->status_referent == 1)
                        <td class="align-middle id">

                            @if ($employe->activiter == 1)
                                <span style="color:#00b900; "> <i class="bx bxs-circle"></i> </span>
                            @else
                                <span style="color:red; "> <i class="bx bxs-circle"></i> </span>
                            @endif
                            {{ $employe->matricule }}
                        </td>


                        <td>
                            <div class="d-flex align-items-center">
                                @if ($employe->photos == null)
                                    {{-- image placeholder --}}
                                    {{-- <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="Image non chargée"
                                    style="width: 45px; height: 45px" class="rounded-circle" /> --}}

                                    {{-- grey color --}}
                                    <i class='bx bx-user-circle profile-holder' style="width: 45px; height: 45px"></i>

                                    {{-- actif/inactif color --}}
                                    {{-- <i class='bx bx-user-circle  h1' style='
                                            @if ($employe->activiter == 1) color:#25b900c9;'
                                                @else
                                                color:#e21717;' 
                                                @endif
                                                ></i> --}}

                                    {{-- initials --}}
                                    {{-- <div class=" rounded-circle p-1 m-1 randomColor align-middle" >
                                                    <span class=" profile-circle  text-center profile-initial" style="position:relative;">
                                                        <b>{{substr($employe->nom_stagiaire, 0, 1)}} {{substr($employe->prenom_stagiaire, 0, 1)}}</b>
                                                    </span>
                                                </div> --}}
                                @else
                                    <img src="{{ asset('images/stagiaires/' . $employe->photos) }}"
                                        alt="Image non chargée" style="width: 45px; height: 45px"
                                        class="rounded-circle" />
                                @endif
                                <div class="ms-3">
                                    <p class="fw-normal mb-1 text-purple ">
                                        {{-- <p class="fw-bold mb-1 text-purple "> --}}
                                        {{ $employe->nom_stagiaire }} {{ $employe->prenom_stagiaire }}</p>
                                    <p class="text-muted mb-0">{{ $employe->fonction_stagiaire }}</p>
                                </div>
                            </div>
                        </td>

                        <td class="align-middle text-start">

                            <div class="ms-3">
                                <p class="mb-1 text-purple">{{ $employe->mail_stagiaire }}</p>
                                {{-- <p class="fw-bold mb-1 text-purple">{{ $employe->mail_stagiaire }}</p> --}}
                                <p class="text-muted mb-0">
                                    {{ $employe->telephone_stagiaire != null ? $employe->telephone_stagiaire : '----' }}
                                </p>


                            </div>

                        </td>
                        <td class="align-middle text-center text-secondary">
                            <span class="d-block">{{ $employe->service->departement->nom_departement }}</span>
                            <span>{{ $employe->service != null ? $employe->service->nom_service : '----' }}</span>
                        </td>
                        {{-- <td class="align-middle text-center text-secondary">61</td> --}}
                        <td class="align-middle text-center text-secondary">2011-04-25</td>
                        <td class="align-middle text-center text-secondary">

                            @if ($employe->activiter == 1)
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckChecked"><span
                                            class="badge bg-success">actif</span></label>
                                    <input class="form-check-input desactiver_stg" type="checkbox"
                                        data-user-id="{{ $employe->user_id }}" value="{{ $employe->id }}" checked>
                                </div>
                            @else
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">
                                        <span class="badge bg-danger">
                                            inactif
                                        </span>
                                    </label>
                                    <input class="form-check-input activer_stg" type="checkbox"
                                        data-user-id="{{ $employe->user_id }}" value="{{ $employe->id }}">
                                </div>
                            @endif

                        </td>

                        {{-- status référent --}}
                        <td class="align-middle text-center text-secondary">

                            @if ($employe->status_referent == 1)
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckChecked"><span
                                            class="badge bg-success">Référent</span></label>
                                    <input class="form-check-input desactiver_referent" type="checkbox"
                                        data-user-id="{{ $employe->user_id }}" value="{{ $employe->id }}" checked>
                                </div>
                            @else
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">
                                        <span class="badge bg-secondary">
                                            non référent
                                        </span>
                                    </label>
                                    <input class="form-check-input activer_referent" type="checkbox"
                                        data-user-id="{{ $employe->user_id }}" value="{{ $employe->id }}"
                                        @if ($employe->activiter != 1)
                                            disabled
                                        @endif
                                        >
                                </div>
                            @endif

                        </td>


                        <td class="align-middle text-center text-secondary">
                            <button type="button" class="btn " data-bs-toggle="modal"
                                data-bs-target="#delete_emp_{{ $employe->id }}">
                                <i class=' bx bxs-trash' style='color:#e21717'></i>
                            </button>
                        </td>

                        </tr>

                        <div class="modal fade" id="delete_emp_{{ $employe->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('mettre_fin_cfp_etp') }}" method="POST">
                                @csrf

                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header d-flex justify-content-center"
                                            style="background-color:rgb(235, 20, 45);">
                                            <h4 class="modal-title text-white">Avertissement !</h4>

                                        </div>
                                        <div class="modal-body">
                                            <small>Vous êtes sur le point d'enlever l'employé
                                                {{ $employe->nom_stagiaire }} {{ $employe->prenom_stagiaire }} -
                                                id : {{ $employe->id }}, utilisateur {{ $employe->user_id }},
                                                cette action est irréversible. Continuer ?</small>
                                        </div>

                                        <div class="modal-footer justify-content-center">
                                            <button type="button" class="btn btn_creer" data-bs-dismiss="modal"> Non
                                            </button>

                                            <a href="{{ route('employeur.destroy', $employe->id) }}"> <button
                                                    type="button" class="btn btn_creer btnP px-3">Oui</button></a>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                    @endif
                @empty
                       
                @endforelse

            </tbody>
        </table>
    </div>
</div>
