@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="shadow-sm p-3 mb-5 bg-body rounded">
        <div class="container-fluid">
        <div class="shadow p-3 mb-5 bg-body rounded">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <h3>ABONNEMENT</h3> <br>
                    <div class="panel-heading">
                            <ul class="nav nav-pills">
                                <li class ="{{ Route::currentRouteNamed('abonnement.index') ? 'active' : '' }}"><a href="{{route('abonnement.index')}}" ><span class="fa fa-th-list"></span>&nbsp; Types d'abonnement</a></li>&nbsp;
                                <li class ="{{ Route::currentRouteNamed('listeAbonne') ? 'active' : '' }}"><a href="{{route('listeAbonne')}}" ><span class="fa fa-th-list"></span>&nbsp; Listes abonnement</a></li>&nbsp;
                            </ul>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card px-4 py-2">

                            <table class="table text-center">
                                <title> Plan detaillé </title>
                                <thead>
                                    <th class="th_color"> Type d'abonnement </th>
                                    <th class="th_color"> Tarif mensuel </th>
                                    <th class="th_color"> Tarif annuel </th>
                                    <th class="th_color"> Utilisateurs souscrits </th>
                                </thead>
                                <tbody>
                                    @if(count($abonnementETP) > 0)
                                        <tr>
                                            <td class="th_color"> {{ $abonnementETP[0]->nom_type }} - entreprises </td>
                                            <td class="th_color"> {{ $abonnementETP[0]->tarif/10 }} Ar</td>
                                            <td class="th_color"> {{ $abonnementETP[0]->tarif }} Ar</td>
                                            <td class="th_color"><button class="btn btn-primary">  <a href="{{route('activation_page',['id' => $abonnementETP[0]->abonnement_id])}}">{{count($abonnementETP)}} utilisateurs</a></button></td>
                                        </tr>
                                    @endif
                                    @if(count($abonnementCFP) > 0)
                                        <tr>
                                            <td class="th_color"> {{ $abonnementCFP[0]->nom_type }} - CFP </td>
                                            <td class="th_color"> {{ $abonnementCFP[0]->tarif/10 }} Ar</td>
                                            <td class="th_color"> {{ $abonnementCFP[0]->tarif }} Ar</td>
                                            <td class="th_color"><button class="btn btn-primary">  <a href="{{route('activation_page',['id' => $abonnementCFP[0]->abonnement_id])}}">{{count($abonnementCFP)}} utilisateurs</a></button></td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>

                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</div>
@endsection
