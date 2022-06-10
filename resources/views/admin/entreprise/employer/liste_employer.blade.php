@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Liste des employés</p>
@endsection
@section('content')
    @push('extra-css')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.3/css/fixedHeader.bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.3.0/css/responsive.bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/inputControl.css') }}">

        <style>
            .table-head {
                font-weight: normal;
            }

            .text-purple {
                color: #9359ff;
            }

            .form-select:focus,
            .form-control:focus {
                border-color: #ab39f7;
                box-shadow: 0 0 0 0.2rem rgba(160, 92, 248, 0.25);
            }

            .nav-tabs:hover {
                outline: none;
                border: none;
            }

            .nav-item a:hover {
                outline: none;
                color: #9359ff;
                text-decoration: none;
            }

            .nav-tabs .nav-link {
                border: none;
                color: #535353c9;
            }

            .nav-tabs .nav-link.active {

                border-bottom: 2px solid #9359ff;
                color: #9359ff;

            }


            .dataTables_length label,
            .dataTables_filter label {
                opacity: 0.5;
                transition: opacity 0.15s ease-in;
            }

            .dataTables_length label:hover,
            .dataTables_filter label:hover {
                opacity: 1;
            }

            .page-item.active .page-link {
                border-radius: 5rem;
                border: 1px solid #9359ff;
                background-color: #9359ff !important;
                padding: 0.3rem 0.7rem;
                /* color: #59ff90; */
                margin: 0 0.5rem;
                font-size: small;
                color: white!important;
                transition: 0.3s;
            }

            .page-item.disabled .page-link {
                font-size: smaller;
                opacity: 0, 5;

            }

            .profile-circle {
                width: 50px;
                height: 50px;
                border-radius: 50%;

            }

            .profile-initial {
                display: flex;
                flex-wrap: nowrap;
                font-size: 1rem;
            }
        </style>
    @endpush

    <!-- Tabs navs -->
    <div class="row m-5">
        <ul class="nav nav-tabs mb-3 ml-3 col-md-10" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="emps-list" data-mdb-toggle="tab" data-bs-toggle="tab" href="#emp-list"
                    role="tab" aria-controls="emp-list" aria-selected="true">Liste des emmployes</a>

            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="emps-add" data-mdb-toggle="tab" data-bs-toggle="tab" href="#emp-add" role="tab"
                    aria-controls="emp-add" aria-selected="true">Nouveau</a>
                {{-- <button type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#form-ajout">
                    Ajouter
                </button> --}}
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="emps-export" data-mdb-toggle="tab" data-bs-toggle="tab" href="#emp-export"
                    role="tab" aria-controls="emp-export" aria-selected="false">Exporter</a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link" id="emps-referents" data-mdb-toggle="tab" data-bs-toggle="tab"
                    href="#emp-referents" role="tab" aria-controls="emp-referents" aria-selected="false">Référents</a>
            </li>

        </ul>
        <!-- Tabs navs -->


        @if (Session::has('success'))
            <div class="alert alert-success h6 text-sm">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session::has('error'))
            <div class="alert alert-danger h6 text-sm">
                {{ Session::get('error') }}
            </div>
        @endif
        @if (Session::has('info'))
            <div class="alert alert-info h6 text-sm">
                {{ Session::get('info') }}
            </div>
        @endif

        {{-- form ajout --}}

        <div class="divider"></div>

        <!-- Tabs content -->

        <div class="tab-content">
            <div class="m-5 tab-pane fade show active" id="emp-list" role="tabpanel" aria-labelledby="emp-list">
                <p id="status_error" class="text-danger">

                </p>
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
                            <tr>
                                <td class="align-middle id">
                                    
                                    # {{ $employe->matricule }}
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($employe->photos == null)
                                            {{-- image placeholder --}}
                                            {{-- <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="Image non chargée"
                                                style="width: 45px; height: 45px" class="rounded-circle" /> --}}

                                            {{-- grey color --}}
                                            <span class=" position-relative">
                                                <i class='bx bx-user-circle profile-holder'
                                                    style="width: 45px; height: 45px">
                                                </i>
                                                <span
                                                    class="opacity-100 position-absolute bottom-0 mt-3 top-50 
                                                    start-50 ms-3 translate-middle p-2 border-light actif-status
                                                    rounded-circle
                                                    @if ($employe->activiter == 1) 
                                                        bg-success
                                                    @else
                                                        bg-danger 
                                                    @endif
                                                    ">
                                                
                                                </span>

                                                {{-- gem icon as badge --}}
                                                {{-- <span class="opacity-100 position-absolute bottom-0 mt-2 top-50 
                                                    start-50 ms-3 translate-middle p-2">
                                                    <i class="bi bi-gem f-w-600"></i>
                                                </span> --}}


                                            </span>


                                            {{-- actif/inactif color --}}
                                            {{-- <i class='bx bx-user-circle  h1' style='
                                                @if ($employe->activiter == 1) color:#25b900c9;'
                                                    @else
                                                    color:#e21717;' 
                                                    @endif
                                                    ></i> --}}

                                            {{-- initials --}}
                                            {{-- <div class="randomColor rounded-circle p-3 mb-2 profile-circle" >
                                                <span class="align-middle text-center profile-initial" style="position:relative;">
                                                    <b>{{substr($employe->nom_stagiaire, 0, 1)}} {{substr($employe->prenom_stagiaire, 0, 1)}}</b>
                                                </span>
                                            </div> --}}
                                        @else
                                            <span class="position-relative">
                                                <img src="{{ asset('images/stagiaires/' . $employe->photos) }}"
                                                    alt="Image non chargée" style="width: 45px; height: 45px"
                                                    class="rounded-circle" />
                                                <span
                                                    class="opacity-100 position-absolute bottom-0 mt-3 top-50 start-50 ms-3 
                                                    translate-middle p-2 border actif-status
                                                    border-light rounded-circle
                                                    @if ($employe->activiter == 1) 
                                                        bg-success
                                                    @else
                                                        bg-danger 
                                                    @endif
                                                ">
                                                    <span class="visually-hidden">Activity</span>
                                                </span>
                                            </span>
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
                                    <span
                                        class="d-block">{{ $employe->service->departement->nom_departement }}</span>
                                    <span>{{ $employe->service != null ? $employe->service->nom_service : '----' }}</span>
                                </td>
                                {{-- <td class="align-middle text-center text-secondary">61</td> --}}
                                <td class="align-middle text-center text-secondary">
                                    {{ $employe->created_at->format('d M Y h:m') }}
                                </td>
                                <td class="align-middle text-center text-secondary">

                                    @if ($employe->activiter == 1)
                                        <div class="form-check form-switch">
                                            <label class="form-check-label" for="flexSwitchCheckChecked"><span
                                                    class="badge bg-success">actif</span></label>
                                            <input class="form-check-input desactiver_stg" type="checkbox"
                                                data-user-id="{{ $employe->user_id }}" value="{{ $employe->id }}"
                                                checked>
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
                                                data-user-id="{{ $employe->user_id }}" value="{{ $employe->id }}"
                                                date-user-actif="{{ $employe->activiter }}"
                                                checked>
                                        </div>
                                    @else
                                        <div class="form-check form-switch">
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                <span class="badge bg-secondary">
                                                    non référent
                                                </span>
                                            </label>
                                            <input class="form-check-input activer_referent" type="checkbox"
                                                data-user-id='["{{ $employe->user_id }}","{{ $employe->activiter }}"]' value="{{ $employe->id }}"
                                        
                                                {{-- desactiver le bouton si l'employé n'est pas actif --}} @if ($employe->activiter != 1) disabled @endif>
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
                          

                        @empty

                        @endforelse

                    </tbody>
                </table>

            </div>


            {{-- form ajout --}}

            @include('admin.entreprise.employer.nouveau_employer')


            <div class="tab-pane fade" id="emp-export" role="tabpanel" aria-labelledby="emp-export">
                export
            </div>
            <div class="tab-pane fade" id="emp-referents" role="tabpanel" aria-labelledby="emp-referents">

                @include('admin.entreprise.employer.liste_referent')
            </div>
        </div>

        {{-- tabs content --}}
    </div>

    @push('extra-js')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

        {{-- scr --}}
        {{-- <script src="{{ asset('js/employes_scripts.js') }}"></script> --}}

        <script>
            
            // dataTables
            $(document).ready(function() {
                var table = $('#example').DataTable({
                    responsive: true,
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
                    },
                });

                new $.fn.dataTable.FixedHeader(table);
            });
            $(document).ready(function() {
                var table = $('#liste_referents').DataTable({
                    responsive: true,
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.12.0/i18n/fr-FR.json",
                    },
                });

                new $.fn.dataTable.FixedHeader(table);
            });


            // changer le status de référent -> activer
            $(".activer_referent").on('click', function(e) {
                var data_id = $(this).data("user-id");
                var user_id = data_id[0];
                var user_actif = data_id[1];
                var stg_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "employes.setReferent",
                    data: {
                        user_id: user_id,
                        emp_id: stg_id,
                        user_actif: user_actif
                    },
                    success: function(response) {
                        console.log(response);
                        // window.location.reload();
                        // don't reloead the page if json response have error
                        if (response.error) {
                            alert(response.error);
                            // remove the attribute checked
                            $(".activer_referent").removeAttr('checked');
                            // uncheck the checkbox
                            $(".activer_referent").prop('checked', false);

                            document.getElementById("status_error") .innerHTML = response.error;
                        } else {
                            alert('pass');
                            window.location.reload();
                        }
                    },
                    error: function(response) {
                        console.log(error);
                    }
                });
            });

            // changer le status de référent à désactiver
            $(".desactiver_referent").on('click', function(e) {
                var user_id = $(this).data("user-id");
                var user_actif = $(this).data("user-actif");
                var stg_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "employes.unsetReferent",
                    data: {
                        user_id: user_id,
                        emp_id: stg_id,
                        user_actif: user_actif
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.reload();
                    },
                    error: function(response) {
                        console.log(error);
                    }
                })
            })

            // desactiver/activer stagiaire
            $(".desactiver_stg").on('click', function(e) {
                var user_id = $(this).data("user-id");
                var stg_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('employes.liste.desactiver') }}",
                    data: {
                        user_id: user_id,
                        emp_id: stg_id
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.reload();
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            });
            $(".activer_stg").on('click', function(e) {
                var user_id = $(this).data("user-id");
                var stg_id = $(this).val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('employes.liste.activer') }}",
                    data: {
                        user_id: user_id,
                        emp_id: stg_id
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.reload();
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            });

            // verification à l'ajout 


            // Valeur numerique cin/tel
            $(function() {
                $("input[name='phone']").on('input', function(e) {

                    //   bolck the input to accept only numbers     
                    this.value = this.value.replace(/[^+0-9]/g, '');

                    // $(this).val($(this).val().replace(/[^0-9]/g, ''));
                });
                $("input[name='cin']").on('input', function(e) {
                    $(this).val($(this).val().replace(/[^0-9]/g, ''));
                });
            });


            $(document).on('change', '#cin', function() {
                document.getElementById("cin_err").innerHTML = "";

                var result = $(this).val();
                if ($(this).val().length < 5) {
                    console.log('cin trop court');
                    document.getElementById("cin_err").innerHTML = "n°CIN invalid";

                } else {
                    document.getElementById("cin_err").innerHTML = "";
                    $.ajax({
                        url: "{{ route('verify_cin_user') }}",
                        type: 'get',
                        data: {
                            valiny: result
                        },
                        success: function(response) {
                            var userData = response;

                            if (userData.length > 0) {
                                document.getElementById("cin_err").innerHTML =
                                    "CIN appartient déjà par un autre utilisateur";
                            } else {
                                document.getElementById("cin_err").innerHTML = "";
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }
            });

            $(document).on('change', '#mail', function() {
                var result = $(this).val();
                $.ajax({
                    url: "{{ route('verify_mail_user') }}",
                    type: 'get',
                    data: {
                        valiny: result
                    },
                    success: function(response) {
                        var userData = response;

                        if (userData.length > 0) {
                            document.getElementById("mail_err").innerHTML =
                                "l'email est déjà associé à un compte";
                        } else {
                            document.getElementById("mail_err").innerHTML = "";
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });

            $(document).on('change', '#phone', function() {
                var result = $(this).val();

                if ($(this).val().length < 7) {
                    document.getElementById("phone_err").innerHTML = "numéro télephone invalide";
                } else {
                    document.getElementById("phone_err").innerHTML = '';
                    $.ajax({
                        url: '{{ route('verify_tel_user') }}',
                        type: 'get',
                        data: {
                            valiny: result
                        },
                        success: function(response) {
                            var userData = response;

                            if (userData.length > 0) {
                                document.getElementById("phone_err").innerHTML =
                                    "le numéro du télephone existe déjà";
                            } else {
                                document.getElementById("phone_err").innerHTML = "";
                            }
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                }


            });

            /*---------------------------------------------------------*/
            $('#liste_etp').on('change', function() {
                $('#liste_dep').empty();
                var id = $(this).val();
                $.ajax({
                    url: "{{ route('show_dep') }}",
                    type: 'get',
                    data: {
                        id: id
                    },
                    success: function(response) {
                        var userData = response;
                        console.log(userData);
                        for (var $i = 0; $i < userData.length; $i++) {
                            $("#liste_dep").append('<option value="' + userData[$i].departement.id + '">' +
                                userData[$i].departement.nom_departement + '</option>');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        </script>



        <script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap.min.js"></script>
    @endpush
@endsection
