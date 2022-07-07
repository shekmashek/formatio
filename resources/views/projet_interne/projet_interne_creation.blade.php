@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Nouveau session de projet Intra</p>
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('assets/css/projets.css') }}">
    <div class="container pt-1">
        <div class="row">
            {{-- <h5 class="my-3 text-center">Le Projet de Formation intra entreprise</h5> --}}

            <form action="{{ route('projet_interne/enregistrement') }}" id="formPayement" method="POST" class="form_session pt-2">
                @csrf
                <div class="row">
                    <h5 class="mb-2 text-center">Création d'une nouvelle session de projet interne</h5>
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
                            <div class="col-lg-6 text-end">
                                <select class="form-select input_select" name="module_id"
                                    aria-label="Default select example" style="width: 25rem;" required>
                                    <option value="null">Sélectionnez</option>
                                    @foreach ($modules as $mod)
                                        <option value="{{ $mod->id }}">{{ $mod->nom_module }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-6 text-end mt-2"><span>Modalité<strong class="text-danger">*</strong> </span>
                            </div>
                            <div class="col-lg-6 text-end">
                                <select class="form-select input_select" name="modalite" aria-label="Default select example"
                                    style="width: 15rem;" required>
                                    <option value="null">Sélectionnez</option>
                                    <option value="Présentiel">Présentielle</option>
                                    <option value="En ligne">En ligne</option>
                                    <option value="Présentiel/En ligne">Présentiel/En ligne</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-6 text-end">
                                <a href="{{ route('liste_projet') }}"><button type="button" class="btn  btn_annuler py-1"
                                        data-dismiss="modal"><i class='bx bxs-chevron-left me-1'></i>Annuler</button></a>
                            </div>
                            <div class="col-lg-6"><button type="submit" form="formPayement"
                                    class="btn btn_nouveau py-1"><i class='bx bx-check me-1'></i>Créer</button></div>
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
@endsection
