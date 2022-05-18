@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Choix des stagiaires</h3>
@endsection
@section('content')
<div class="page-wrapper">
    <div class="container">
        <div class="row ms-auto justify-content-center">
            <div class="col-lg-10">
                <table class="table">
                    <thead>
                        <tr class="align-items-center">
                            <th>Nom</th>
                            <th>Prenom</th>
                            <th>Entreprise</th>
                            <th>Fonction</th>
                            {{-- <th>Département</th> --}}
                            <th>Sexe</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <form id="choix" action="{{ route('inserer_stagiaire_qcm') }}" method="post">
                        @csrf
                   <tbody>
                        @foreach ($stagiaire as $stg)
                            <tr>
                                <td>{{$stg->nom_stagiaire}}</td>
                                <td>{{$stg->prenom_stagiaire}}</td>
                                <td>{{$stg->entreprise->nom_etp}}</td>
                                <td>{{$stg->fonction_stagiaire}}</td>
                                {{-- <td>{{$stg->departement->nom_departement}}</td> --}}
                                <td>{{$stg->genre_stagiaire}}</td>
                                <td align="center">
                                    <div class="form-check" >
                                        <input type="checkbox" class="form-check-input" name="stagiaire[]" type="checkbox" value="{{ $stg->id }}" id="flexCheck">
                                  </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <input type="hidden" name="demande" value="{{ $id_dmd }}">
                    </form>
                </table>
                <button class="btn btn-success valider" type="submit" form="choix">Valider</button>
            </div>
        </div>
    </div>
</div>
@endsection
