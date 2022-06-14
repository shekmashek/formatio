

@section('title')
<p class="text_header m-0 mt-1">Nouveau employée</p>
@endsection

<div class="tab-pane fade" id="emp-add" role="tabpanel" aria-labelledby="emp-add">

<form action="{{ route('employeur.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">


        <div class="">
            <div class="col-md-7 m-auto">
                <div class="input-group mb-0">

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


                <div class="input-group mb-0">

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


                <div class="input-group mb-0">

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

                <div class="input-group mb-0">

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

                <div class="input-group mb-0">

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

                <div class="input-group mb-0">

                    <div class="input-group">
                        <div class="input-group-text border-0 border-bottom bg-light">
                            <i class='bx bx-envelope form-icon'></i>
                        </div>

                        <input type="text" autocomplete="off" required name="mail"
                            class="form-control input border-0 border-bottom" id="mail" inputmode="email"
                            required>


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
                <div class="input-group mb-0">
                    <div class="input-group">
                        <div class="input-group-text border-0 border-bottom bg-light">
                            <i class='bx bxs-graduation form-icon'></i>
                        </div>

                        <select name="niveau_etude_id" id="niveau_etude_id" class="form-select form-control input border-0 border-bottom">
                            @forelse ($niveaux_etude as $niveau_etude)
                                <option value="{{ $niveau_etude->id }}">{{ $niveau_etude->niveau_etude }}</option>
                            @empty
                                <p>---</p>
                            @endforelse
                        </select>

                    </div>
                </div>
            </div>

            <div class="col-md-7 m-auto">

                <div class="input-group mb-0">


                    <div class="input-group">
                        <div class="input-group-text border-0 border-bottom bg-light">
                            <box-icon name='building form-icon'></box-icon>
                        </div>
                        <select name="departement" class="form-control input border-bottom" id="">
                            <option value="">selectionner le département</option>
                            @forelse ($departements as $departement)
                                <option value="{{ $departement->id }}">{{ $departement->nom_departement }}</option>
                            @empty
                                <p>---</p>
                            @endforelse
                        </select>
                        <select name="service_id" class="form-control" id="">
                            <option value="">selectionner le service</option>
                            @forelse ($services as $service)
                                <option value="{{ $service->id }}">{{ $service->nom_service }}</option>
                            @empty
                                <p>---</p>
                            @endforelse
                        </select>
                    </div>

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
                <button type="submit" class="btn btn-primary float-end m-2">Enregistrer</button>

            </div>
        </div>
    </div>

</form>


</div>

