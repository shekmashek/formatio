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
                color: #7f7fff;
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
                color: #7f7fff;
                text-decoration: none;
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
                border: 1px solid #7f7fff;
                background-color: #7f7fff !important;
                padding: 0.3rem 0.7rem;
                /* color: #7f7fff; */
                margin: 0 0.5rem;
                font-size: small;
                transition: 0.3s;
            }

            .page-item.disabled .page-link {
                font-size: smaller;
                opacity: 0, 5;

            }

        </style>
    @endpush

    <!-- Tabs navs -->
    <div class="row m-5">
        <ul class="nav nav-tabs mb-3 ml-3 col-md-10" id="ex1" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="ex1-tab-1" data-mdb-toggle="tab" data-bs-toggle="tab" href="#ex1-tabs-1"
                    role="tab" aria-controls="ex1-tabs-1" aria-selected="true">Liste</a>
            </li>
            <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" data-bs-toggle="modal" data-bs-target="#form-ajout">
                    Ajouter
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="ex1-tab-3" data-mdb-toggle="tab" data-bs-toggle="tab" href="#ex1-tabs-3"
                    role="tab" aria-controls="ex1-tabs-3" aria-selected="false">Tab 3</a>
            </li>
        </ul>
        <!-- Tabs navs -->


        {{-- form ajout --}}

        <!-- Modal -->
        <div class="modal fade" id="form-ajout" tabindex="-1" aria-labelledby="form-ajoutLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="form-ajoutLabel">Ajouter</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            <ul>
                                <li>{{ Session::get('success') }}</li>
                            </ul>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{ Session::get('error') }}</li>
                            </ul>
                        </div>
                    @endif
                    {{-- <form action="{{route('create_compte_employeur')}}" method="POST" enctype="multipart/form-data"> --}}
                    <form action="{{ route('employeur.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">


                            <div class="">
                                <div class="col-md-7 m-auto">
                                    <div class="input-group">

                                        <div class="input-group">
                                            <div class="input-group-text border-0 border-bottom bg-light">
                                                <i class="bi bi-hash form-icon"></i>
                                            </div>

                                            <input type="text" autocomplete="off" required name="matricule"
                                                class="form-control input border-0 border-bottom" id="matricule" required>


                                            <label for="matricule" class="input-placeholder">Matricule<strong
                                                    style="color:#ff0000;">*</strong></label>



                                            @error('matricule')
                                                <div class="col-sm-6">
                                                    <span style="color:#ff0000;"> {{ $message }} </span>
                                                </div>
                                            @enderror
                                        </div>

                                    </div>

                                </div>

                            </div>

                            <select class="form-select selectP input visually-hidden" id="type_enregistrement"
                                name="type_enregistrement" aria-label="Default select example">
                                <option value="STAGIAIRE">Employé</option>
                                <option value="REFERENT">Réferent</option>
                                <option value="MANAGER">Chef de département</option>

                            </select>


                            <div class="">
                                <div class="col-md-7 m-auto">


                                    <div class="input-group">

                                        <div class="input-group">
                                            <div class="input-group-text border-0 border-bottom bg-light">
                                                <i class="bx bx-user form-icon"></i>
                                            </div>

                                            <input type="text" autocomplete="off" required name="nom"
                                                class="form-control input border-0 border-bottom" id="nom" required>

                                            <label for="nom" class="input-placeholder">Nom<strong
                                                    style="color:#ff0000;">*</strong></label>


                                            @error('nom')
                                                <div class="col-sm-6">
                                                    <span style="color:#ff0000;"> {{ $message }} </span>
                                                </div>
                                            @enderror
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-7 m-auto">


                                    <div class="input-group">

                                        <div class="input-group">
                                            <div class="input-group-text border-0 bg-light visually-hidden">
                                                <i class="bx bx-user form-icon"></i>
                                            </div>

                                            <input type="text" autocomplete="off" required name="prenom"
                                                class="form-control input border-0 border-bottom" id="prenom" required>


                                            <label for="prenom" class="input-placeholder">Prenom<strong
                                                    style="color:#ff0000;">*</strong></label>


                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="">
                                <div class="col-md-7 m-auto">

                                    <div class="input-group">

                                        <div class="input-group">
                                            <div class="input-group-text border-0 border-bottom bg-light">
                                                <i class='bx bxs-id-card form-icon'></i>
                                            </div>

                                            <input type="text" autocomplete="off" required name="cin"
                                                class="form-control input border-0 border-bottom" id="cin" required>


                                            <label for="cin" class="input-placeholder">CIN<strong
                                                    style="color:#ff0000;">*</strong></label>


                                            <span style="color:#ff0000;" id="cin_err"></span>
                                            @error('cin')
                                                <div class="col-sm-6">
                                                    <span style="color:#ff0000;"> {{ $message }} </span>
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-7 m-auto">

                                    <div class="input-group">

                                        <div class="input-group">
                                            <div class="input-group-text border-0 border-bottom bg-light">
                                                <i class='bx bx-phone form-icon'></i>
                                            </div>

                                            <input type="text" autocomplete="off" required name="phone"
                                                class="form-control input border-0 border-bottom" id="phone"
                                                inputmode="numeric" required>


                                            <label for="phone" class="input-placeholder" id="">Téléphone<strong
                                                    style="color:#ff0000;">*</strong></label>

                                            <span id="phone_err" style="color:#ff0000;"></span>

                                            @error('phone')
                                                <div class="col-sm-6">
                                                    <span style="color:#ff0000;"> {{ $message }} </span>
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>


                            </div>
                            <div class="">
                                <div class="col-md-7 m-auto">

                                    <div class="input-group">

                                        <div class="input-group">
                                            <div class="input-group-text border-0 border-bottom bg-light">
                                                <i class='bx bx-envelope form-icon'></i>
                                            </div>

                                            <input type="text" autocomplete="off" required name="mail"
                                                class="form-control input border-0 border-bottom" id="mail"
                                                inputmode="email" required>


                                            <label for="mail" class="input-placeholder">Email<strong
                                                    style="color:#ff0000;">*</strong></label>

        
                                            <span id="mail_err"></span>
                                            @error('mail')
                                                <div class="col-sm-6">
                                                    <span style="color:#ff0000;"> {{ $message }} </span>
                                                </div>
                                            @enderror
                                        </div>

                                    </div>

                                </div>
                                <div class="col-md-7 m-auto">

                                    <div class="input-group">

                                        <div class="input-group">
                                            <div class="input-group-text border-0 border-bottom bg-light">
                                                <i class='bx bx-briefcase form-icon'></i>
                                            </div>

                                            <input type="text" autocomplete="off" required name="fonction"
                                                class="form-control input border-0 border-bottom" id="fonction" required>


                                            <label for="fonction" class="input-placeholder">Fonction<strong
                                                    style="color:#ff0000;">*</strong></label>



                                            @error('fonction')
                                                <div class="col-sm-6">
                                                    <span style="color:#ff0000;"> {{ $message }} </span>
                                                </div>
                                            @enderror
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        {{-- form ajout --}}


        <!-- Tabs content -->

        <div class="tab-content" id="ex1-content">
            <div class="m-5 tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                <table id="example" class="table " style="width:100%">
                    <thead>
                        <tr>
                            <th class="id">ID</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Employé</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Contacts</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">
                                <span class="d-block">Entreprise</span>
                                <span>Département</span>
                            </th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Age</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Start date</th>

                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Status</th>
                            <th scope="col" class="table-head font-weight-light align-middle text-center ">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employers as $employe)
                            <tr>
                                <td class="align-middle id">

                                    @if ($employe->activiter == 1)
                                        <span style="color:#00b900; "> <i class="bx bxs-circle"></i> </span>
                                    @else
                                        <span style="color:red; "> <i class="bx bxs-circle"></i> </span>
                                    @endif
                                    {{ $employe->id }}
                                </td>


                                <td>
                                    <div class="d-flex align-items-center">
                                        @if ($employe->photos == null)
                                            {{-- <img src="https://mdbootstrap.com/img/new/avatars/8.jpg" alt="Image non chargée"
                                                style="width: 45px; height: 45px" class="rounded-circle" /> --}}

                                            {{-- <i class='bx bx-user-circle profile-holder'
                                                style="width: 45px; height: 45px"></i> --}}
                                                <i class='bx bx-user-circle' style='width: 45px; height: 45px;
                                                @if ($employe->activiter == 1)
                                                color:#00b900;'
                                                @else
                                                color:#e21717;'
                                                @endif
                                                ></i>
                                        @else
                                            <img src="{{ asset('images/stagiaires/' . $employe->photos) }}"
                                                alt="Image non chargée" style="width: 45px; height: 45px"
                                                class="rounded-circle" />
                                        @endif
                                        <div class="ms-3">
                                            <p class="fw-bold mb-1 text-purple ">
                                                {{ $employe->nom_stagiaire }}{{ $employe->prenom_stagiaire }}</p>
                                            <p class="text-muted mb-0">#{{ $employe->matricule }}</p>
                                        </div>
                                    </div>
                                </td>

                                <td class="align-middle text-center">

                                    <div class="ms-3">
                                        <p class="fw-bold mb-1 text-purple">{{ $employe->mail_stagiaire }}</p>
                                        <p class="text-muted mb-0">
                                            {{ $employe->telephone_stagiaire != null ? $employe->telephone_stagiaire : '----' }}
                                        </p>


                                    </div>

                                </td>
                                <td class="align-middle text-center text-secondary">{{ $entreprise->nom_etp }}</td>
                                <td class="align-middle text-center text-secondary">61</td>
                                <td class="align-middle text-center text-secondary">2011-04-25</td>
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
                                            <label class="form-check-label"
                                                for="flexSwitchCheckChecked"><span>inactif</span></label>
                                            <input class="form-check-input activer_stg" type="checkbox"
                                                data-user-id="{{ $employe->user_id }}" value="{{ $employe->id }}">
                                        </div>
                                    @endif

                                </td>
                                <td class="align-middle text-center text-secondary">
                                    <button type="button" class="btn " data-bs-toggle="modal"
                                        data-bs-target="#delete_emp_{{ $employe->id }}">
                                        <i class='bx bxs-trash' style='color:#e21717'></i>
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
                                                    id : {{ $employe->id }}, utilisateur {{ $employe->user_id }}
                                                    sur le plateforme, cette action est irréversible. Continuer ?</small>
                                            </div>

                                            <div class="modal-footer justify-content-center">
                                                <button type="button" class="btn btn_creer" data-bs-dismiss="modal"> Non
                                                </button>

                                                <a href="{{ route('employeur.destroy', $employe->user_id) }}"> <button
                                                        type="button" class="btn btn_creer btnP px-3">Oui</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        @empty
                            <h3 class="text-center">Aucun employé</h3>
                        @endforelse

                    </tbody>
                </table>

            </div>

            <div class="tab-pane fade" id="ex1-tabs-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                export
            </div>
        </div>

        {{-- tabs content --}}
    </div>

    @push('extra-js')
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

        <script>
            // modal
            var myModal = document.getElementById('form-ajout')
            var myInput = document.getElementById('myInput')

            myModal.addEventListener('shown.bs.modal', function() {
                myInput.focus()
            })

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

            // desactiver stagiaire
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
                        window.location.reload();
                    },
                    error: function(error) {
                        console.log(error)
                    }
                });
            });

            // modal form 

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
                        url: '{{ route('verify_cin_user') }}',
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
                    url: '{{ route('verify_mail_user') }}',
                    type: 'get',
                    data: {
                        valiny: result
                    },
                    success: function(response) {
                        var userData = response;

                        if (userData.length > 0) {
                            document.getElementById("mail_err").innerHTML = "l'email est déjà associé à un compte";
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
                    /*  $.ajax({
                          url: '{{ route('verify_tel_user') }}'
                          , type: 'get'
                          , data: {
                              valiny: result
                          }
                          , success: function(response) {
                              var userData = response;

                              if (userData.length > 0) {
                                  document.getElementById("phone_err").innerHTML = "le numéro du télephone existe déjà";
                              } else {
                                  document.getElementById("phone_err").innerHTML = "";
                              }
                          }
                          , error: function(error) {
                              console.log(error);
                          }
                      }); */
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
