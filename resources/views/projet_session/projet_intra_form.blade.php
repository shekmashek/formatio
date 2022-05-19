@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Nouveau Projet Intra</p>
@endsection
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/projets.css')}}">
<div class="container pt-1">
    <div class="row">
        {{-- <h5 class="my-3 text-center">Le Projet de Formation intra entreprise</h5> --}}
        
        <form action="{{ route('groupe.store') }}" id="formPayement" method="POST" class="form_session pt-2">
            @csrf
            <input type="hidden" name="type_formation" value="{{ $type_formation }}">
            <div class="row">
                <h5 class="mb-2 text-center">Créer une nouvelle session de projet intra</h5>
                @if (Session::has('groupe_error'))
                    <div class="alert alert-danger ms-2 me-2">
                        <ul>
                            <li>{!! \Session::get('groupe_error') !!}</li>
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <div class="form-row d-flex">
                        <div class="col">
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" name="date_debut"
                                        required onfocus="(this.type='date')">
                                    <label class="ml-3 form-control-placeholder" for="min">Date debut du session<strong
                                        class="text-danger">*</strong></label>
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
                                    <label class="ml-3 form-control-placeholder" for="formation_id">Formations<strong
                                        class="text-danger">*</strong></label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <select class="form-select selectP input" id="etp_id" name="entreprise"
                                        aria-label="Default select example">
                                        <option value="null" selected hidden>Choisir l'entreprise souhaité...</option>
                                        @foreach ($entreprise as $etp)
                                        <option value="{{ $etp->entreprise_id }}">{{ $etp->nom_etp }}</option>
                                        @endforeach
                                    </select>
                                    <label class="ml-3 form-control-placeholder" for="etp_id">Entreprises<strong
                                        class="text-danger">*</strong></label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" min="1" max="50" name="min_part"
                                        required onfocus="(this.type='number')">
                                    <label class="ml-3 form-control-placeholder" for="min">Nombre de participant
                                        minimal</label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <select class="form-select selectP input" id="etp_id" name="modalite"
                                        aria-label="Default select example">
                                        {{-- <option value="null" selected hidden>Choisir l'entreprise souhaité...</option> --}}
                                        <option value="Présentiel">Présentielle</option>
                                        <option value="En ligne">En ligne</option>
                                        <option value="Présentiel/En ligne">Présentiel/En ligne</option>
                                    </select>
                                    <label class="ml-3 form-control-placeholder" for="etp_id">Modalite</label>
                                </div>
                            </div>
                            <div class="text-center "><button type="submit" form="formPayement" class="btn btn_enregistrer">Valider</button></div>
                        </div>
                        <div class="col">
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" name="date_fin"
                                        required onfocus="(this.type='date')">
                                    <label class="ml-3 form-control-placeholder" for="min">Date fin du session<strong
                                        class="text-danger">*</strong></label>
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
                                    <label class="ml-3 form-control-placeholder" for="module_id">Modules<strong
                                        class="text-danger">*</strong></label>
                                    <span style="color:#ff0000;" id="module_id_err">Aucun module détecté! veuillez
                                        choisir la formation</span>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <select class="form-select selectP input" id="payement_id" name="payement"
                                        aria-label="Default select example">
                                        <option value="null" selected hidden>Choisir votre mode de Payement</option>
                                        @foreach ($payement as $paye)
                                        <option value="{{ $paye->id }}">{{ $paye->type }}</option>
                                        @endforeach
                                    </select>
                                    <label class="ml-3 form-control-placeholder" for="payement_id">Mode de Payement<strong
                                        class="text-danger">*</strong></label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" min="1" max="50" name="max_part"
                                        required onfocus="(this.type='number')">
                                    <label class="ml-3 form-control-placeholder" for="min">Nombre de participant
                                        maximal</label>
                                </div>
                            </div>
                            <div class="text-center " id="annuler_session"><a href="{{ route('liste_projet') }}"><button type="button" class="btn  btn_annuler" data-dismiss="modal">Annuler</button></a></div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</div>
<style>
    #annuler_session{
        margin-top: 6rem;
    }
</style>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
{{-- <script src="{{asset('js/projet_inter_intra.js')}}"></script> --}}
<script>
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

</script>
@endsection