@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Demande</p>
@endsection
@section('content')
<style>
    h2{
        font-weight: lighter;
    }
</style>
<div class="container shadow-sm mt-5 p-4">
    <div class="row">
        <div class="col-md-12">
            <div class="float-start">
                <h2>Liste des demande de formation déja validé</h2>
            </div>
            <div class="float-end">

                <button class="btn btn-primary">
                    Export PDF
                </button>
                <a href="/liste_demande_stagiaire" class="btn btn-dark text-light"> Retour</a>
            </div>
        </div>
        <div class="col-md-12 mt-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nom_stagiaire</th>
                        <th>Email</th>
                        <th>Nom formation</th>
                        <th>Date</th>
                        <th>Cout</th>
                        <th>Organisme</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Safidy Mahafaly</td>
                        <td>safidy@gmail.com</td>
                        <td>Anglais</td>
                        <td>Juin 2022</td>
                        <td>110.000 Ar</td>
                        <td>Numerika</td>
                        <td>
                            <a href="" class="btn btn-info text-light">Modifier</a>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection