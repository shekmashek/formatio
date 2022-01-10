@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>Demande de formation</h3>
            </div>

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link  {{ Route::currentRouteNamed('liste_demande_formation') ? 'active' : '' }}" aria-current="page" href="{{route('liste_demande_formation')}}">
                                    <i class="fa fa-list">Liste de demande</i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ Route::currentRouteNamed('planFormation.index') ? 'active' : '' }}" aria-current="page" href="{{route('planFormation.index')}}">
                                    <i class="fa fa-plus"> Nouvelle demande</i></a>
                            </li>

                    </ul>

                        </div>
                    </div>
                </nav>


        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form action="{{route('planFormation.store')}}" method = "POST">
                                    @csrf
                                    @can('isReferent')
                                        <div class="form-group">
                                            <label for="plan">Collaborateur</label><br>
                                            <select class="form-control" id="plan" name = "stagiaire_id">
                                                <option>Choisissez un collaborateur...</option>
                                                @foreach($collaborateur as $collab)
                                                    <option value="{{$collab->id}}">{{$collab->nom_stagiaire}} {{$collab->prenom_stagiaire}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endcan

                                    <div class="form-group">
                                        <label for="plan">Plan de formation</label><br>
                                        <select class="form-control" id="plan" name = "IdAnnee">
                                            <option>Choisissez un plan de formation...</option>
                                            @foreach($annee as $an)
                                               <option value="{{$an->id}}">{{$an->annee}}</option>
                                            @endforeach
                                        </select><br>
                                    <div class="form-group">
                                        <label for="domaine">Domaine de Formation</label><br>
                                        <select class="form-control" id="domaine" name = "IdDomaine">
                                            <option value="">Choisissez un domaine de formation...</option>
                                            @foreach($liste_domaine as $domaine)
                                               <option value="{{$domaine->id}}">{{$domaine->nom_domaine}}</option>
                                              @endforeach
                                        </select><br>
                                    </div>
                                    <div class="form-group">
                                      <label for="nom">Nom de Formation</label><br>
                                      <select class="form-control" id="formation" name = "IdFormation">
                                            <option value="">Choisissez une formation...</option>
                                            @foreach($liste_formation  as $formation)
                                             <option value="{{$formation->id}}">{{$formation->nom_formation}}</option>
                                            @endforeach
                                      </select><br>
                                    </div>
                                    <div class="form-group">
                                    <label for="typologieFormation">Typologie de formation</label><br><br>
                                    <select class="form-control" aria-label="Default select example" id="typologieFormation" name="typologie">
                                        <option value="Choisissez une typologie...">Choisissez une typologie...</option>
                                        <option value="Adaptation au poste">Adaptation au poste</option>
                                        <option value="Evolution dans l’emploi">Evolution dans l’emploi</option>
                                        <option value="Développement de compétences">Développement de compétences</option>

                                    </select>
                                </div>
                                    <div class="form-group">
                                      <label for="objectifAttendu">Objectif attendue</label><br><br>
                                      <textarea class="form-control" id="objectifAttendu" name="objectif" placeholder="Objectif d’amélioration des performances individuelles et collectives"></textarea>
                                      @error('objectif')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br><br>
                                    <div class="form-group">
                                      <label for="duree">Durée de Formation(en jours)</label>
                                      <input type="number" class="form-control" id="duree" name="duree_formation" placeholder="Durée (j)" required>
                                      @error('prenom')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    <div class="form-group">
                                      <label for="date">Date Prévisionnelle</label>
                                      <input type="month" class="form-control" id="date" name="date_previsionnelle" min="2020-01" placeholder="Date" required>
                                      @error('date')
                                        <div class ="col-sm-6">
                                            <span style = "color:#ff0000;"> {{$message}} </span>
                                        </div>
                                        @enderror
                                    </div><br>
                                    <button>Demander</button>

                <input id="id_part" value="" style='display:none'>
                </div>
            </div>
        </div>
    </div>
</div>
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $('#domaine').on('change', function() {
        $('#formation').empty();

        var id = $(this).val();
        $.ajax({
               url:"{{route('formationParDomaine',"+id+")}}",
               type:'get',
               data:{id:id },
               success:function(response){
                   var userData=response;
                console.log(userData);
                    for (var $i = 0; $i < userData.length; $i++){
                         $("#formation").append('<option value="'+userData[$i].id+'">'+ userData[$i].nom_formation+'</option>');
                    }
               },
               error:function(error){
                  console.log(error);
               }
        });

    });
</script>
@endsection
