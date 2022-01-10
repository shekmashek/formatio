@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>Utilisateurs/Responsables</h3>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                        <a class="nav-link  {{ Route::currentRouteNamed('liste_utilisateur') || Route::currentRouteNamed('liste_utilisateur') ? 'active' : '' }}" href="{{route('liste_utilisateur')}}">
                            <i class="fa fa-list">&nbsp; Responsables</i></a>
                        </li>

                        <li class="nav-item">

                        <a class="nav-link  {{ Route::currentRouteNamed('utilisateur_stagiaire') ? 'active' : '' }}" aria-current="page" href="{{route('utilisateur_stagiaire')}}">
                            <i class="fa fa-list">&nbsp; Stagiaires</i></a>

                        </li>

                        <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('utilisateur_formateur') ? 'active' : '' }}" href="{{route('utilisateur_formateur')}}">
                            <i class="fa fa-list">&nbsp; Formateurs</i></a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('utilisateur_admin') ? 'active' : '' }}" href="{{route('utilisateur_admin')}}">
                            <i class="fa fa-list">&nbsp; Admin</i></a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('utilisateur_cfp') ? 'active' : '' }}" href="{{route('utilisateur_cfp')}}">
                            <i class="fa fa-list">&nbsp; Cfp</i></a>
                        </li>

                         <li class="nav-item">
                            <a class="nav-link  {{ Route::currentRouteNamed('utilisateur_superAdmin') ? 'active' : '' }}" href="{{route('utilisateur_superAdmin')}}">
                            <i class="fa fa-list">&nbsp; Super Admin</i></a>
                        </li>


                    </ul>


                    </div>
                </div>
            </nav>


            <form class="navbar-form navbar-left" role="search">
                <div style="display: flex; justify-content: flex-end;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Tout <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                            <li><a href="{{route('liste_utilisateur',5)}}">5</a></li>
                            <li><a href="{{route('liste_utilisateur',10)}}">10</a></li>
                            <li><a href="{{route('liste_utilisateur',25)}}">25</a></li>
                            <li><a href="{{route('liste_utilisateur',50)}}">50</a></li>
                            <li><a href="{{route('liste_utilisateur',100)}}">100</a></li>
                            <li class="divider"></li>
                            <li><a href="{{route('liste_utilisateur')}}">Tout</a></li>
                            </ul>
                        </div>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            Rechercher par entreprise <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                @foreach($liste as $etp)
                                    <li><a href="{{route('utilisateur.show',$etp->id)}}">{{$etp->nom_etp}}</a></li>
                                @endforeach
                                <li class="divider"></li>
                                <li><a href="{{route('liste_utilisateur')}}">Tout</a></li>
                            </ul>
                        </div>
                    </div>
            </form>
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
                                        <th>Fonction</th>
                                        <th>Entreprise</th>
                                    </tr>
                                </thead>

                                <tbody>

                                        @foreach($datas as $resp)
                                    		<tr>
                                    			<td>{{$resp->nom_resp}}</td>
                                    			<td>{{$resp->email_resp}}</td>
                                                <td>{{$resp->fonction_resp}}</td>
                                                <td>{{$resp->entreprise->nom_etp}}</td>

                                            </tr>
                                    	@endforeach
                                        <input id="id_value" value="" style = 'display:none'>

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
