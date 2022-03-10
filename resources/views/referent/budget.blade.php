@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('assets/css/inputControl.css')}}">
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <br>
                    <div class="shadow-sm p-3 mb-5 bg-body rounded">
                        <div class="container-fluid">
                            <div class="shadow p-3 mb-5 bg-body rounded">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <br>
                                        <h3>Plan de formation et budgetisation</h3>
                                        <br>
                                        <div class="panel-heading">
                                            <ul class="nav nav-pills">
                                                <button type = "button" class ="btn_next {{ Route::currentRouteNamed('planFormation') ? 'active' : '' }}"><a href="{{route('planFormation.index')}}" ><span class="fa fa-th-list"></span>  Nouvelle demande</a></button>&nbsp;&nbsp;
                                                @can('isReferent')
                                                    <button type = "button" class ="btn_next {{ Route::currentRouteNamed('liste_demande_stagiaire') ? 'active' : '' }}"><a href="{{route('liste_demande_stagiaire')}}" ><span class="fa fa-th-list"></span>  Liste des demandes</a></button>&nbsp;&nbsp;
                                                @endcan
                                                <button type = "button" class ="btn_next {{ Route::currentRouteNamed('listePlanFormation') ? 'active' : '' }}"><a href="{{route('listePlanFormation')}}" ><span class="fa fa-th-list"></span>  Liste des Plan de formation</a></button>&nbsp;&nbsp;
                                                <button  type = "button" class ="btn_next {{ Route::currentRouteNamed('ajout_plan') ? 'active' : '' }}" ><a href="{{route('ajout_plan')}}"><span class="fa fa-plus-sign"></span> Nouveau Plan de formation</a></button>&nbsp;&nbsp;
                                                <button  type = "button" class ="btn_next {{ Route::currentRouteNamed('budget') ? 'active' : '' }}" ><a href="{{route('budget')}}"><span class="fas fa-sack-dollar"></span> Budgetisation</a></button>&nbsp;&nbsp;
                                                <button type = "button" class ="btn_next"><form class="d-flex mx-1" method="GET" action="{{ route('recherchePlanAnnee') }}">
                                                    <div class="form-group">
                                                        <input style="margin-top:-5px;" type="text" id="annee_search" name="annee" class="form-control" placeholder="Rechercher par année"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <button style="margin-top:-5px;" type="submit" class="btn btn-primary"> <i class="fa fa-search"></i></button>
                                                    </div>
                                                </form></button>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="shadow p-5 mb-5 mx-auto bg-body w-50" style="border-radius: 15px">
                <h2 class="text-center mb-5" style="color: var(--font-sidebar-color); font-size: 1.5rem">BUDGET PREVISIONNEL</h2>

                {{-- <form action="{{route('create_compte_employeur')}}" method="POST" enctype="multipart/form-data"> --}}
                <form action="{{route('employeur.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" autocomplete="off" required name="Coût en Ariary" class="form-control input" id="matricule" /required>
                                <label for="matricule" class="form-control-placeholder" align="left">Coût en Ariary<strong style="color:#ff0000;">*</strong></label>
                                @error('cout')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="row px-3">
                                <div class="form-group">
                                    <select class="form-select selectP input" id="type_enregistrement" name="type_enregistrement" aria-label="Default select example">
                                        @for ($i = 0 ;$i<count($departement);$i++)

                                        @endfor
                                    </select>
                                    <label class="form-control-placeholder" for="type_enregistrement">Département<strong style="color:#ff0000;">*</strong></label>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" autocomplete="off" required name="nom" class="form-control input" id="nom" required />
                                <label for="nom" class="form-control-placeholder" align="left">Nom<strong style="color:#ff0000;">*</strong></label>
                                @error('nom')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <input type="text" autocomplete="off" name="prenom" class="form-control input" id="prenom" required />
                                <label for="prenom" class="form-control-placeholder" align="left">Prénom</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <input type="text" required autocomplete="off" name="cin" class="form-control input" id="cin" required />
                                <label for="cin" class="form-control-placeholder" align="left">CIN<strong style="color:#ff0000;">*</strong></label>
                                <span style="color:#ff0000;" id="cin_err"></span>
                                @error('cin')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <input type="text" autocomplete="off" required name="fonction" class="form-control input" id="fonction" required />
                                <label for="fonction" class="form-control-placeholder" align="left">Fonction<strong style="color:#ff0000;">*</strong></label>
                                @error('fonction')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="email" required name="mail" class="form-control input" id="mail" required />
                                <label for="mail" class="form-control-placeholder" align="left">Email<strong style="color:#ff0000;">*</strong></label>
                                <span style="color:#ff0000;" id="mail_err"></span>
                                @error('mail')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input type="text" max=10 required name="phone" class="form-control input" id="phone" required />
                                <label for="phone" class="form-control-placeholder" align="left">Téléphone<strong style="color:#ff0000;">*</strong></label>
                                <span style="color:#ff0000;" id="phone_err"></span>
                                @error('phone')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class=" text-center">
                        <button type="submit" class="btn btn-lg btn_enregistrer">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

