@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        {{-- <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>MODIFICATION</h3>
            </div>
        </div> --}}
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Informations</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="projet">Entreprise : {{$data[0]->nom_etp}}</label><br>
                                </div>
                                <div class="form-group">
                                    <label for ="entreprise">Nom du projet : {{$data[0]->nom_projet}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Modifier un encaissement de frais annexe</h4>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">

                                @if (Session::has('success'))
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ Session::get('success') }}</strong>
                                    </div>
                                @endif

                                <form action="{{ route('modifier_fa') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="entreprise_id" value="{{ $data[0]->entreprise_id }}">
                                    <input type="hidden" name="projet_id" value="{{ $data[0]->projet_id }}">
                                    <input type="hidden" name="encaissement_fa_id" value="{{ $id_encaissement_fa }}">
                                    <input type="hidden" name="montant_fa_id" value="{{ $id_montant_fa }}">
                                    <div class="form-group">
                                        <label for="libelle">Description</label><br>
                                        <input name="libelle" class="form-control" value="{{ $libelle }}" type="text" id="libelle">
                                        @error('libelle')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="montant">Montant encaissé</label><br>
                                        <input name="montant" class="form-control" value="{{ $montant }}" type="number" min="0" id="montant">
                                        @error('montant')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-success">Modifier</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
            	<br>
                    <a href="{{ route('listeEncaissement',[$data[0]->entreprise_id,$data[0]->projet_id]) }}"><button type="submit" class="btn btn-primary">Extrait de compte client</button></a>

            </div>
        </div>

    </div>
</div>


@endsection
