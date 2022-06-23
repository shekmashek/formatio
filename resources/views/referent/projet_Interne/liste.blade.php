@extends('./layouts/admin')
@section('title')
    <p class="text_header m-0 mt-1">Demande</p>
@endsection
@section('content')
<style>
    h2{
        font-weight: lighter;
        font-size: 25px;
    }
</style>
    <div class="container shadow-sm mt-5 p-4">
        <div class="row">
            <div class="col-md-12">
                <div class="float-start">
                    <h2>Liste global des demande de formation </h2>
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
                            <th>Date prévisionnelle</th>
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
                            <td>0</td>
                            <td></td>
                            <td>
                                <a href="" class="btn btn-info text-light">Modifier</a>
                                <a href="" class="btn btn-warning text-light">Validé</a>
                                <a href="" class="btn btn-danger text-light">Réfuser</a>
                            </td>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection