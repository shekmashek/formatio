
@extends('./layouts/admin')
@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
            	<br>
                <h3>ACTION DE FORMATION</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
            <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Details du projet
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <form   class="btn-submit" >
                                    @foreach ($detail as $d)
                                    @csrf
                                    <input type = "text" value="{{$d->session->id}}" id ="sessionId" style='display:none'>

                                    <input type = "text" value="{{$d->id}}" id ="detailId" style='display:none'>
                                    <div class="form-group">
                                      <label for="projet">Projet : {{$d->projet->nom_projet}}</label><br>
                                    </div>
                                    <div class="form-group">
                                        <label for ="entreprise">Entreprise : {{$nom_etp}}</label>
                                     </div>
                                    <div class="form-group">
                                      <label for="groupe">Groupe : {{$d->groupe->nom_groupe}}</label><br>
                                    </div>
                                    <div class="form-group">
                                      <label for="formateur">Formateur : {{$d->formateur->nom_formateur}} {{$d->formateur->prenom_formateur}}</label><br>
                                     </div>
                                    <div class="form-group">
                                      <label for="session">Session : {{$d->session->date_debut}} - {{$d->session->date_fin}}</label>
                                     </div>
                                    <div class="form-group">
                                      <label for="lieu">Lieu : {{$d->lieu}}</label>
                                     </div>
                                    <div class="form-group">
                                        <label for="session">Horaire :
                                            @php $i = 0; @endphp
                                            @foreach($date_horaire_formation as $det)
                                                 @php $i += 1; @endphp
                                                 @if ( $i == $nb_meme_horaire)
                                                    {{$det->h_debut}} h - {{$det->h_fin}} h
                                                @else {{$det->h_debut}} h - {{$det->h_fin}} h /
                                                @endif
                                            @endforeach

                                        </label>
                                     </div>
                                     <div class="form-group">
                                        <label for="date">Date de formation:
                                            @php $i = 0; @endphp
                                            @foreach($date_horaire_formation as $det)
                                                 @php $i += 1; @endphp
                                                 @if ( $i == $nb_meme_horaire)
                                                    {{$det->date_detail}}
                                                @else {{$det->date_detail}}  /
                                                @endif
                                            @endforeach
                                        </label>
                                     </div>
                                     @if ($d->module->formation_id == 1)
                                        <div class="form-group">
                                            <label for="formation">Formation : MS Excel</label><br>
                                        </div>
                                     @else
                                        <div class="form-group">
                                            <label for="formation">Formation : Ms Power BI</label><br>
                                        </div>
                                     @endif

                                    <div class="form-group">
                                      <label for="module">Module : {{$d->module->nom_module}}</label><br>
                                     </div>


                                   @endforeach
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Execution
                    </div>
                    <div class="panel-body">
                        <form class="btn-submit" >
                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-sm-6">
                                        <label for="qualite">Qualité globale de la formation</label>
                                    </div>
                                    <div class = "col-sm-4">
                                        <input type = "number" min = "0" max = "10" value = "0" class="form-control" id = "qualite">
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-sm-6">
                                        <label for="qualite">Evaluation du formateur</label>
                                    </div>
                                    <div class = "col-sm-4">
                                        <input type = "number" min = "0" max = "10" value = "0" class="form-control" id = "evaluation">
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <div class = "row">
                                    <div class="col-sm-6">
                                        <label for="Stagiaire">Stagiaire</label>
                                    </div>
                                    <div class = "col-sm-4">
                                        <select name="stagiaire" class="form-control" id="stagiaire">
                                            @foreach($stagiaire as $st)
                                            <option value= "{{$st->id}}" >{{$st->nom_stagiaire}} {{$st->prenom_stagiaire}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                            @foreach($formation as $frm)
                            <div class="form-group">
                                <h2>Compétences en {{$frm->nom_formation}} </h2>
                            </div>

                            <div class="form-group">
                                <div class = "row">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <th>Modules</th>
                                            <th>Programmes</th>
                                            <th>Cours</th>
                                            @foreach($module as $mod)
                                                @if($frm->id == $mod->formation_id)
                                                <tr>
                                                    <td>{{$mod->nom_module}}</td>


                                                    <td>
                                                        <ul>
                                                            @foreach($programme as $pg)
                                                                @if($mod->id == $pg->module_id)
                                                                    <li>{{$pg->titre}}</li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @endforeach









                            <input type = "submit" class="btn btn-primary" id ="action1" value = "Ajouter">

                        </form>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Liste des executions
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Stagiaire</th>
                                        <th>Qualité globale de la formation</th>
                                        <th>Evaluation du formateur</th>
                                        <th colspan ="5">Compétences en Ms Excel</th>
                                        <th colspan ="3">Compétences en Ms Power BI</th>
                                        <th>Modifier</th>

                                    </tr>
                                    <tr>
                                        <th style="background-color : grey"></th>
                                        <th style="background-color : grey"></th>
                                        <th style="background-color : grey"></th>
                                        <th>N.I</th>
                                        <th>N.II</th>
                                        <th>N.III</th>
                                        <th>N.IV</th>
                                        <th>N.V</th>
                                        <th>N.I</th>
                                        <th>N.II</th>
                                        <th>N.III</th>
                                        <th style="background-color : grey"></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach($execution as $ex)
                                    <tr>
                                        <td>{{$ex->stagiaire->nom_stagiaire}} {{$ex->stagiaire->prenom_stagiaire}}</td>
                                        <td>{{$ex->qualite_formation}}</td>
                                        <td>{{$ex->evaluation_formateur}}</td>
                                        <td>{{$ex->msexcel_fondamentaux}}</td>
                                        <td >{{$ex->msexcel_calculsFonctions}}</td>
                                        <td>{{$ex->msexcel_gestionDonnées}}</td>
                                        <td>{{$ex->msexcel_BI}}</td>
                                        <td>{{$ex->msexcel_VBA}}</td>
                                        <td>{{$ex->msBI_fondamentaux}}</td>
                                        <td>{{$ex->mseBI_dax}}</td>
                                        <td>{{$ex->msBI_dataviz}}</td>
                                        <td><a href=""><span class = "glyphicon glyphicon-pencil"></span></a></td>

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
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    var id_detail;
    $(".modifier").on('click',function(e){
        var id = e.target.id;

        $.ajax({
            type: "GET",
            url: "{{route('edit_detail')}}",
            data:{Id:id},
            dataType: "html",
            success:function(response){
                var userData=JSON.parse(response);
                for (var $i = 0; $i < userData.length; $i++){
                    $("#projetModif").val(userData[$i].projet.nom_projet);
                    $("#groupeModif").val(userData[$i].projet.groupe_projet);
                    $("#lieuModif").val(userData[$i].lieu);
                    $("#debutModif").val(userData[$i].date_debut);
                    $("#finModif").val(userData[$i].date_fin);
                    id_detail = userData[$i].id;
                }
                $('#action1').val('Modifier');
           },
           error:function(error){
              console.log(error)
           }
        });
	});
    //recuperer id stagiaire
    var id_stagiaire = $('#stagiaire').val();
    var id_session = $('#sessionId').val();
    $('#stagiaire').on('change', function() {
       id_stagiaire = $(this).val();
    });
    //enregistrer execution
    $("#action1").click(function(e){
       e.preventDefault();
       var evaluation = $("#evaluation").val();
       var qualite = $('#qualite').val();
       var exc_m1 = $('#exc_m1').val();
       var exc_m2= $('#exc_m2').val();
       var exc_m3= $('#exc_m3').val();
       var exc_m4 = $('#exc_m4').val();
       var exc_m5 = $('#exc_m5').val();
       var bi_m1 = $('#bi_m1').val();
       var bi_m2= $('#bi_m2').val();
       var bi_m3= $('#bi_m3').val();
       var url = '{{ url('store_execution') }}';
         $.ajax({
           url:url,
           method:'get',
           data:{
                   Qualite : qualite,
                   Evaluation : evaluation,
                   Stagiaire_id:id_stagiaire,
                   Session_id:id_session,
                   Exc_m1:exc_m1,
                   Exc_m2:exc_m2,
                   Exc_m3:exc_m3,
                   Exc_m4:exc_m4,
                   Exc_m5:exc_m5,
                   Bi_m1:bi_m1,
                   Bi_m2:bi_m2,
                   Bi_m3:bi_m3
                },
           success:function(response){
              if(response.success){
                 window.location.reload();
              }else{
                  alert("Error")
              }
           },
           error:function(error){
              console.log(error)
           }
       });
    });
</script>
@endsection
