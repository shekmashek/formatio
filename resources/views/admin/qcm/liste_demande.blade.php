@extends('./layouts/admin')
@section('content')
<div class="page-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="col-3">Description</th>
                            <th class="col-3">Entreprise</th>
                            <th class="col-3">Centre de formation</th>
                            <th class="col-3">Formation</th>
                            <th class="col-3">Actions</th>
                        </tr>
                    </thead>
                   <tbody>
                        @foreach ($liste as $lst)
                            <tr>
                                <td>{{$lst->description_test}}</td>
                                <td>{{$lst->entreprise->nom_etp}}</td>
                                <td>{{$lst->cfp->Nom}}</td>
                                <td>{{$lst->formation->nom_formation}}</td>
                                <td><a href="{{route('choix_stagiaires',['id'=>$lst->id])}}"><button class="btn btn-warning stagiaire">Stagiare</button></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
