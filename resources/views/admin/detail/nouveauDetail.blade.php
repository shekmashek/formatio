@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <br>
                <h3>DETAILS DES PROJETS</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul class="nav nav-pills">
                            {{-- <li class ="{{ Route::currentRouteNamed('liste_session') ? 'active' : '' }}"><a href="{{route('liste_session')}}"><span class="glyphicon glyphicon-calendar"></span> Session</a></li> --}}
                            <li class="{{ Route::currentRouteNamed('liste_detail') ? 'active' : '' }}"><a href="{{route('liste_detail')}}"><span class="glyphicon glyphicon-th-list"></span> Liste des détails</a></li>
                            <li class="{{ Route::currentRouteNamed('nouveau_detail') ? 'active' : '' }}"><a href="{{route('nouveau_detail')}}"><span class="glyphicon glyphicon-plus-sign"></span> Nouveau</a></li>

                        </ul>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form class="btn-submit" action="{{route('detail.store')}}" method="post">
                                    @csrf
                                    <input type="text" name="sess_id" value="{{$id}}" style="display:none">
                                    {{-- <label name = "date_session_debut">Session : {{$session_debut}} </label> - <label name="date_session_fin"> {{$session_fin}} </label> --}}
                                    <br>
                                    <div class="form-group">
                                        <label for="projet">Entreprise</label><br>
                                        <select class="form-control" id="etp" name="etp">
                                            <option onselected>Choisissez une entreprise....</option>
                                            @foreach($entreprise as $etp)
                                            <option value="{{$etp->entreprise_id}}">{{$etp->nom_etp}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="projet">Projet</label><br>
                                        <select class="form-control" id="liste_pj" name="projet">
                                            <option onselected>Choisissez un projet....</option>
                                            @foreach($projet as $pj)
                                            <option value="{{$pj->id}}">{{$pj->nom_projet}}</option>
                                            @endforeach
                                        </select>
                                        <span style = "color:#ff0000;" id="projet_id_err">Aucun projet  détecté! veuillez choisir l'entreprise</span>

                                    </div>
                                    <div class="form-group">
                                        <label for="groupe">Groupe</label><br>
                                        <select class="form-control" id="groupe" name="groupe">
                                            {{-- @foreach($groupe as $gp)
                                            <option value="{{$gp->id}}">{{$gp->nom_groupe}}</option>
                                            @endforeach --}}
                                        </select>
                                        <p><strong style="color: red" id="err_session">Aucune session détectée! Veuillez choisir un projet pour avoir une session</strong></p>
                                    </div>


                            <div class="form-group">
                                <label for="formateur">Formateur</label><br>
                                <select class="form-control" id="formateur" name="formateur">
                                    @foreach($formateur as $format)
                                    <option value="{{$format->formateur_id}}">{{$format->nom_formateur}} {{$format->prenom_formateur}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="lieu">Lieu</label>
                                <input type="text" class="form-control" id="lieu" name="lieu" placeholder="Lieu">
                                @error('lieu')
                                <div class="col-sm-6">
                                    <span style="color:#ff0000;"> {{$message}} </span>
                                </div>
                                @enderror
                            </div><br>
                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" class="form-control" id="date_detail" name="date" min="" max="">
                            </div>
                            <div class="form-group">
                                <label for="debut">Heure début</label>
                                <input type="time" class="form-control" id="debut" name="debut" min="07:00" max="17:00">
                            </div>
                            <div class="form-group">
                                <label for="fin">Heure fin</label>
                                <input type="time" class="form-control" id="fin" name="fin" min="08:00" max="18:08">
                            </div>

                            <input type="submit" id="ajouter" class="btn btn-primary" value="Ajouter">

                            </form>
                        </div>
                    </div>
                </div>
                <input id="id_part" value="" style='display:none'>

            </div>
        </div>
    </div>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $('#liste_pj').on('change', function(e) {
        $('#groupe').empty();

        var id = $(this).val();
        $.ajax({
            url: 'show_groupe/' + id
            , type: 'get'
            , data: {
                id: id
            }
            , success: function(response) {
                var userData = response;
                if (userData.length <= 0) {
                    document.getElementById("err_session").innerHTML = "Acucun session est détester! veuiller choisir une project pour avoir session";
                } else {
                    document.getElementById("err_session").innerHTML = "";
                    for (var $i = 0; $i < userData.length; $i++) {
                        $("#groupe").append('<option value="' + userData[$i].id + '">' + userData[$i].nom_groupe + '</option>');
                    }
                }


            }
            , error: function(error) {
                console.log(error);
            }
        });
    });
    $('#groupe').on('change',function(){
        var id = $(this).val();
        var dateControl = document.querySelector('input[type="date"]');

        $.ajax({
            url: 'date_but'
            , type: 'get'
            , data: {
                id: id
            }
            , dataType: "html"
            , success: function(response) {

                var userData = JSON.parse(response);
                dateControl.min = userData.date_debut;
                dateControl.max = userData.date_fin;

            }
            , error: function(error) {
                console.log(error);
            }
        });
    });
    $('#type_formation').on('change', function() {
        $('#module').empty();

        var id = $(this).val();
        $.ajax({
            url: 'show/' + id
            , type: 'get'
            , data: {
                id: id
            }
            , success: function(response) {
                console.log(response);
                var userData = response;
                for (var $i = 0; $i < userData.length; $i++) {
                    $("#module").append('<option value="' + userData[$i].id + '">' + userData[$i].nom_module + '</option>');
                }
            }
            , error: function(error) {
                console.log(error);
            }
        });

    });


    // ================ verifie session =======================

    $(document).on('change', '#entreprise_id', function() {
        $("#projet_id").empty();
        var id = $(this).val();
        $.ajax({
            url: 'projetFacturer'
            , type: 'get'
            , data: {
                id: id
            }
            , success: function(response) {
                var userData = response;
                if (userData.length <= 0) {
                    // $("#projet_id_err").val("Aucun projet a été détecter");
                    document.getElementById("projet_id_err").innerHTML = "Aucun projet détecté";
                } else {
                    document.getElementById("projet_id_err").innerHTML = "";
                    for (var $i = 0; $i < userData.length; $i++) {
                        $("#projet_id").append('<option value="' + userData[$i].id + '">' + userData[$i].nom_projet + '</option>');
                    }
                }

            }
            , error: function(error) {
                console.log(error);
            }
        });
    });


    $('#etp').on('change', function()
    {
        var id = $('#etp').val();
    $("#liste_pj option").remove();
    $("#liste_pj").append('<option onselected>Choisissez un projet....</option>');

    $.ajax({
    method: "GET",
    url:  "{{route('show_projet')}}",
    data:{id:id},
    dataType: "html",
    _token: "{{ csrf_token() }}",
    success:function(response)
    {
        var data=JSON.parse(response);
        if(data.length<=0){
                    document.getElementById("projet_id_err").innerHTML = "Aucun projet détecté! veuillez choisir l'entreprise";
        } else {
            document.getElementById("projet_id_err").innerHTML = "";
            for (var $i = 0; $i < data.length; $i++){
                $("#liste_pj").append('<option value="'+data[$i].id+'">'+ data[$i].nom_projet+'</option>');
            }
        }
    },
        error:function(error){
            console.log(error)
        }
    });

    });


</script>
@endsection
