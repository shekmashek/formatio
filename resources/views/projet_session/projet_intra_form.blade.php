@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Nouveau session de projet Intra</p>
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/projets.css') }}">
    <style>
        .select2-container .select2-selection--single .select2-selection__rendered {
            padding: 4px 1rem !important;
            border-radius: 5px !important;
            box-sizing: border-box !important;
            color: #637381 !important;
            font-size: 16px !important;
            letter-spacing: 1px !important;
            height: 40px !important;
        }

        .select2-container .select2-selection--single :focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border-bottom: 2px solid #28a7eb !important;
            outline-width: 0 !important;
        }

        .select2-container .select2-selection--single{
            height: 40px !important;
            border: 1px solid #28a7eb !important;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 35px !important;
        }
        #select2-entreprise-result-45wl-CNE{
            color: #637381 !important;
        }

        .select2-results_option[id*="Ajouter un nouveau module"] {
            color: bleu !important;
        }
    </style>
    {{-- end --}}
    <div class="container pt-1">
        <div class="row">
            <div class="row mb-4 mt-3">
                <div class="col-6">
                    <h5>Nouvelle session de projet Intra</h5>
                </div>
                <div class="col-6 text-end">
                    <div>
                        <a class="new_list_nouvelle " href="{{url()->previous()}}">
                        <span class="btn_precedent text-center"><i class='bx bxs-chevron-left me-1'></i>Précedent</span>
                    </a>
                    </div>
                </div>
            </div>
            <form action="{{ route('groupe.store') }}" id="formPayement" method="POST" class="form_session pt-2">
                @csrf
                <input type="hidden" name="type_formation" value="{{ $type_formation }}">
                <div class="row">
                    @if (Session::has('groupe_error'))
                        <div class="alert alert-danger ms-2 me-2">
                            <ul>
                                <li>{!! \Session::get('groupe_error') !!}</li>
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="row my-2">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4"><span class="text-danger">* Champ obligatoire</span></div>
                            <div class="col-lg-4"></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6 text-end mt-2"><span>Date debut de la session<strong
                                        class="text-danger">*</strong></span></div>
                            <div class="col-lg-6"><input type="date" id="min" class="form-control input"
                                    name="date_debut" style="width: 12rem;" required></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6 text-end mt-2"><span>Date fin de la session<strong
                                        class="text-danger">*</strong></span></div>
                            <div class="col-lg-6"><input type="date" id="min" class="form-control input"
                                    name="date_fin" style="width: 12rem;" required></div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6 text-end mt-2"><span>Module<strong class="text-danger">*</strong> </span>
                            </div>
                            <div class="col-lg-6 text-start">
                                <select class="form-select input_select my_input_select" name="module_id" id="module_id"
                                     style="width: 25rem;" required>
                                     <option value="CRM">Ajouter un nouveau module</option>
                                     <option value="null" disabled="disabled" selected>Sélectionnez</option>
                                        @foreach ($modules as $mod)
                                            <option value="{{ $mod->id }}">{{ $mod->nom_module }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6 text-end mt-2"><span>Entreprise<strong class="text-danger">*</strong> </span>
                            </div>
                            <div class="col-lg-6 text-start">
                                <select class="form-select input_select my_input_select" name="entreprise" id="entreprise"
                                    aria-label="Default select example" style="width: 20rem;" required>
                                    <option value="CNE">Ajouter une nouvelle entreprise</option>
                                    <option value="null" disabled="disabled" selected>Sélectionnez</option>ÍÍ
                                    @foreach ($entreprise as $etp)
                                        <option value="{{ $etp->entreprise_id }}">{{ $etp->nom_etp }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6 text-end mt-2"><span>Mode de paiement<strong class="text-danger">*</strong>
                                </span></div>
                            <div class="col-lg-6 text-start">
                                <select class="form-select input_select my_input_select" name="payement" aria-label="Default select example"
                                    style="width: 20rem;" required>
                                    <option value="null" disabled="disabled" selected>Sélectionnez</option>
                                    @foreach ($payement as $paye)
                                        <option value="{{ $paye->id }}">{{ $paye->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6 text-end mt-2"><span>Modalité<strong class="text-danger">*</strong> </span>
                            </div>
                            <div class="col-lg-6 text-start">
                                <select class="form-select input_select my_input_select" name="modalite" aria-label="Default select example"
                                    style="width: 15rem;" required>
                                    <option value="null" disabled="disabled" selected>Sélectionnez</option>
                                    <option value="Présentiel">Présentielle</option>
                                    <option value="En ligne">En ligne</option>
                                    <option value="Présentiel/En ligne">Présentiel/En ligne</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6 text-end"><button type="submit" form="formPayement"
                                class="btn btn_enregistrer py-1"><i class='bx bx-check me-1'></i>Créer</button>
                            </div>
                            <div class="col-lg-6 text-start">
                                <a href="{{ route('liste_projet') }}"><button type="button" class="btn  btn_annuler py-1"
                                data-dismiss="modal"><i class='bx bx-x me-1'></i>Annuler</button></a>
                            </div>
                            <div class="col-lg-6 text-start">
                                <a href="{{ route('liste_projet') }}"><button type="button" class="btn  btn_enregistrer py-1"
                                data-dismiss="modal"><i class='bx bxs-chevron-left me-1'></i>Retour en arrière</button></a>
                            </div>
                        </div>
                    </div>
            </form>
        </div>
    </div>
    <style>
        #annuler_session {
            margin-top: 6rem;
        }

    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $(".my_input_select").select2();
        });
    </script>
    <script>
        $('#module_id').on('select2:select', function(event){
            var res = $(this).val();
            if(res == "CRM"){
                location.replace("{{ route('liste_module') }}");
            }
        });

        $('#entreprise').on('select2:select', function(event){
            var res = $(this).val();
            if(res == "CNE"){
                location.replace("{{ route('liste_entreprise') }}");
            }
        });

        $("#formation_id").on("change", function() {
            var id = $("#formation_id").val();
            // $("#module_id option").remove();
            $.ajax({
                method: "GET",
                url: "{{ route('module_formation') }}",
                data: {
                    id: id,
                },
                dataType: "html",
                _token: "{{ csrf_token() }}",
                success: function(response) {
                    var data = JSON.parse(response);
                    console.log(data);
                    if (data.length <= 0) {
                        document.getElementById("module_id_err").innerHTML =
                            "Aucun module a été détecter! veuillez choisir la formation";
                    } else {
                        document.getElementById("module_id_err").innerHTML = "";
                        $("#module_id").html('');
                        for (var $i = 0; $i < data.length; $i++) {
                            $("#module_id").append(
                                '<option value="' +
                                data[$i].id +
                                '">' +
                                data[$i].nom_module +
                                "</option>"
                            );
                        }
                    }
                },
                error: function(error) {
                    console.log(error);
                },
            });
        });

        localStorage.setItem('activeTab', 'detail');
    </script>
@endsection
