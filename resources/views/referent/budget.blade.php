@extends('./layouts/admin')
@section('title')
    <h3 class="text_header m-0 mt-1">Budgetisation</h3>
@endsection
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
        <div class="col-md-4"></div>
        <div class="col-md-4">
            @if (\Session::has('success'))
                <div class="alert alert-success">
                    <ul>
                        <li>{!! \Session::get('success') !!}</li>
                    </ul>
                </div>
            @endif
        </div>
        <div class="col-md-4"></div>
    </div>

    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4"> <h4 id="cout_suggere"></h4>
        </div>
        <div class="col-md-4"></div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="shadow p-5 mb-5 mx-auto bg-body w-50" style="border-radius: 15px">
                <h2 class="text-center mb-5" style="color: var(--font-sidebar-color); font-size: 1.5rem">BUDGET PREVISIONNEL</h2>

                <form action="{{route('enregistrer_budget')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <input type="text" autocomplete="off" required name="budget" class="form-control input" id="matricule" /required>
                                <label for="cout" class="form-control-placeholder" align="left">Coût en Ariary<strong style="color:#ff0000;">*</strong></label>
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
                                    <select class="form-select selectP input" id="departement" name="departement" aria-label="Default select example">
                                        @for ($i = 0 ;$i<count($departement);$i++)
                                            <option value="{{$departement[$i]->id}}">{{$departement[$i]->nom_departement}}</option>
                                        @endfor
                                    </select>
                                    <label class="form-control-placeholder" for="type_enregistrement">Département<strong style="color:#ff0000;">*</strong></label>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <select name="annee" id="anneeTest" class="filtre_projet form-control input text-center" required>
                                    <option value="null" selected hidden>Année</option>
                                </select>
                                {{-- <input type="text" autocomplete="off" required name="Année" class="form-control input" id="nom" onfocus="(this.type='year')" required /> --}}
                                <label for="anneeTest" class="form-control-placeholder" align="left">Année<strong style="color:#ff0000;">*</strong></label>
                                @error('nom')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                    <div class=" text-center">
                        <button type="submit" class="btn btn-lg btn_enregistrer">Sauvegarder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    let annee = document.getElementById("anneeTest");

    let anneeEnCours = new Date().getFullYear();
    let anneeAVenir = anneeEnCours + 1;
    while (anneeEnCours <= anneeAVenir) {
        let anneeOption = document.createElement("option");
        anneeOption.text = anneeEnCours;
        anneeOption.value = anneeEnCours;
        annee.add(anneeOption);
        anneeEnCours += 1;
    }
    $(document).ready(function() {
        var result =  $('#departement').val();
        $.ajax({
            url: '{{route("cout_prev")}}'
            , type: 'get'
            , data: {
                dep_id: result
            }
            , success: function(response) {

                var budget = response['total_budget'];
                var nom_dep = response['nom_dep'];
                $('#cout_suggere').text('Coût suggéré(Ar),année '+ nom_dep.annee+' du département '+nom_dep.nom_departement+ ':'+budget[0].cout_prev);
            }
            , error: function(error) {
                console.log(error);
            }
        });
    });
    $('#departement').on('change',function() {
        var result = $(this).val();
        // $('#cout_suggere').text('Coût suggéré pendant le recueil de demande formation du département '+result+ ':');
        $.ajax({
            url: '{{route("cout_prev")}}'
            , type: 'get'
            , data: {
                dep_id: result
            }
            , success: function(response) {
                var budget = response['total_budget'];
                var nom_dep = response['nom_dep'];
                $('#cout_suggere').text('Coût suggéré(Ar),année '+ nom_dep.annee+' du département '+nom_dep.nom_departement+ ':'+budget[0].cout_prev);
           }
            , error: function(error) {
                console.log(error);
            }
        });
    });
</script>
@endsection

