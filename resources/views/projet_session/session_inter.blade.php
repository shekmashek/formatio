@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/projets.css')}}">
<div class="container">
    <div class="row">
        {{-- <h5 class="my-3 text-center text-capitalize">le projet de formation inter entreprise</h5> --}}
        <form action="{{ route('nouveau_session_inter',['type_formation'=>2]) }}" id="formPayement" method="POST"
            class="form_session p-2 m-0">
            @csrf
            <input type="hidden" name="module_id" value="{{$module_id}}">
            <div class="row">
                <h5 class="mb-4 text-center">Créer une nouvelle session de projet Inter</h5>
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
                                    <input type="text" id="min" class="form-control input" name="date_debut" required
                                        onfocus="(this.type='date')">
                                    <label class="ml-3 form-control-placeholder" for="min">Date debut du session<strong
                                            class="text-danger">*</strong></label>
                                </div>
                            </div>

                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" min="1" max="50"
                                        name="min_part" onfocus="(this.type='number')">
                                    <label class="ml-3 form-control-placeholder" for="min">Nombre de participant
                                        minimal</label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <select class="form-select selectP input" id="etp_id" name="modalite"
                                        aria-label="Default select example">
                                        <option value="null" selected hidden>Choisir la modalité de formation...</option>
                                        <option value="Présentielle">Présentielle</option>
                                        <option value="En ligne">En ligne</option>
                                        <option value="Présentielle/En ligne">Présentiel/En ligne</option>
                                    </select>
                                    <label class="ml-3 form-control-placeholder" for="etp_id">Modalite</label>
                                </div>
                            </div>
                            <div class="text-center "><button type="submit" form="formPayement"
                                    class="btn btn_enregistrer">Valider</button></div>
                        </div>
                        <div class="col">
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" name="date_fin" required
                                        onfocus="(this.type='date')">
                                    <label class="ml-3 form-control-placeholder" for="min">Date fin du session<strong
                                            class="text-danger">*</strong></label>
                                </div>
                            </div>
                            <div class="row px-3 mt-2">
                                <div class="form-group mt-1 mb-1">
                                    <input type="text" id="min" class="form-control input" min="1" max="50"
                                        name="max_part" onfocus="(this.type='number')">
                                    <label class="ml-3 form-control-placeholder" for="min">Nombre de participant
                                        maximal</label>
                                </div>
                            </div>

                            <div class="text-center " id="annuler_session"><button type="button" class="btn  btn_annuler"><a
                                        href="{{route('liste_projet')}}">Annuler</a></button>
                            </div>
                        </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="{{asset('js/projet_inter_intra.js')}}"></script>
@endsection