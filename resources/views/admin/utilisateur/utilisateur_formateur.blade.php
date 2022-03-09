@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>Utilisateurs/Formateurs</h3>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link btn_enregistrer  {{ Route::currentRouteNamed('liste_utilisateur') || Route::currentRouteNamed('liste_utilisateur') ? 'active' : '' }}" href="{{route('liste_utilisateur')}}">
                                Responsables</a>
                        </li>

                        <li class="nav-item">

                            <a class="nav-link btn_enregistrer  {{ Route::currentRouteNamed('utilisateur_stagiaire') ? 'active' : '' }}" aria-current="page" href="{{route('utilisateur_stagiaire')}}">
                                Stagiaires</a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_formateur') ? 'active' : '' }}" href="{{route('utilisateur_formateur')}}">
                                Formateurs</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_admin') ? 'active' : '' }}" href="{{route('utilisateur_admin')}}">
                                Admin</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_cfp') ? 'active' : '' }}" href="{{route('utilisateur_cfp')}}">
                                Organisme de Formation</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link btn_enregistrer {{ Route::currentRouteNamed('utilisateur_superAdmin') ? 'active' : '' }}" href="{{route('utilisateur_superAdmin')}}">
                                Super Admin</a>
                        </li>


                    </ul>

                    <form class="navbar-form navbar-left" role="search">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Tout <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{route('utilisateur_stagiaire',5)}}">5</a></li>
                                <li><a href="{{route('utilisateur_stagiaire',10)}}">10</a></li>
                                <li><a href="{{route('utilisateur_stagiaire',25)}}">25</a></li>
                                <li><a href="{{route('utilisateur_stagiaire',50)}}">50</a></li>
                                <li><a href="{{route('utilisateur_stagiaire',100)}}">100</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('utilisateur_stagiaire')}}">Tout</a></li>
                            </ul>
                        </div>
                    </form>

                    </div>

                    <form action="{{route('nouveau_formateur')}}" method="GET">
                        @csrf
                        <p style="display: flex; justify-content: flex-end;">
                            <button type="submit" class="btn btn-primary">&nbsp; Nouvel formateur</button>
                            &nbsp;
                        </p>
                    </form>

                </div>
            </nav>



        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Nom d'utilisateur</th>
                                        <th>E-mail</th>
                                    </tr>
                                </thead>

                                <tbody>

                                        @foreach($datas as $formateur)
                                    		<tr>
                                    			<td>{{$formateur->nom_formateur .' '.$formateur->prenom_formateur}}</td>
                                    			<td>{{$formateur->mail_formateur}}</td>

                                            </tr>
                                    	@endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
