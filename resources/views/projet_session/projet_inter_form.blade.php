@extends('./layouts/admin')
@section('content')
<div class="container p-0">
    <div class="row">
        <h5 class="my-3 text-center text-capitalize">le projet de formation inter entreprise</h5>
        <form action="{{ route('groupe.store') }}" id="formPayement" method="POST">
            @csrf
            <div class="row">
                <h5 class="mb-4 text-center">Ajouter votre nouvelle Session</h5>
                <div class="form-group">
                    <div class="form-row d-flex">
                        <div class="col">
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" min="1" max="20" name="nb_participant_max"
                                        required onfocus="(this.type='number')">
                                    <label class="ml-3 form-control-placeholder" for="min">Nombre de participant
                                        maximal</label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" name="date_debut_session"
                                        required onfocus="(this.type='date')">
                                    <label class="ml-3 form-control-placeholder" for="min">Date debut du session</label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <select class="form-select selectP input" id="formation_id" name="formation_id"
                                        aria-label="Default select example">
                                        <option onselected>choisir la formation du session</option>
                                        @foreach ($formations as $form)
                                        <option value="{{$form->id}}">{{$form->nom_formation}}</option>
                                        @endforeach
                                    </select>
                                    <label class="ml-3 form-control-placeholder" for="formation_id">Formations</label>
                                </div>
                            </div>
                            <div class="text-center "><button type="submit" form="formPayement" class="btn btn_enregistrer">Valider</button></div>
                        </div>
                        <div class="col">
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" min="1" max="10" name="nb_participant_min"
                                        required onfocus="(this.type='number')">
                                    <label class="ml-3 form-control-placeholder" for="min">Nombre de participant
                                        minimal</label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" name="date_fin_session"
                                        required onfocus="(this.type='date')">
                                    <label class="ml-3 form-control-placeholder" for="min">Date fin du session</label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <select class="form-select selectP input" id="module_id" name="module_id"
                                        aria-label="Default select example">
                                        <option onselected>Choisir la module du session</option>
                                        @foreach ($modules as $mod)
                                        <option value="{{$mod->id}}">{{$mod->nom_module}}</option>
                                        @endforeach
                                    </select>
                                    <label class="ml-3 form-control-placeholder" for="module_id">Modules</label>
                                    <span style="color:#ff0000;" id="module_id_err">Aucun module détecté! veuillez
                                        choisir la formation</span>
                                </div>
                            </div>
                            <div class="text-center "><button type="button" class="btn  btn_annuler" data-dismiss="modal">Annuler</button></div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
<script src="{{asset('js/projet_inter_intra.js')}}"></script>
@endsection