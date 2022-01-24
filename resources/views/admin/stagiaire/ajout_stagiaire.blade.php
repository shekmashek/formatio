{{-- @extends('./layouts/admin')
@section('content') --}}
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
                    {{-- <div class="panel-heading">
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
                                        {{-- <div class="form-group">
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
                                        {{-- @if ($d->module->formation_id == 1)
                                            <div class="form-group">
                                                <label for="formation">Formation : MS Excel</label><br>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label for="formation">Formation : Ms Power BI</label><br>
                                            </div>
                                        @endif --}}

                                        {{-- <div class="form-group">
                                        <label for="module">Module : {{$d->module->nom_module}}</label><br>
                                        </div> 
                                    @endforeach
                                </form>
                            </div>
                        </div>
                    </div> --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <ul class="nav nav-pills">
                                        <li class ="{{ Route::currentRouteNamed('ajout_participant') ? 'active' : '' }}"><a href="{{route('ajout_participant',['id_detail' => $detail[0]->id])}}" ><span class="glyphicon glyphicon-plus-sign"></span>  Ajouter des stagiaires</a></li>
                                        <li  class ="{{ Route::currentRouteNamed('liste_stagiaire') ? 'active' : '' }}" ><a href="{{route('liste_stagiaire',['id_detail'=>$detail[0]->id])}}"><span class="glyphicon glyphicon-th-list"></span></span> Liste des stagiaires  </a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">

                                    <form  action="{{ route('insert_detailStagiaire') }}">

                                        @foreach ($stagiaire as $stg)
                                        <div class="form-group form-check">
                                            <input type="checkbox" name="stagiaire[]" class="form-check-input" value="{{ $stg->id }}" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck">{{ $stg->matricule."  :  ".$stg->nom_stagiaire." ".$stg->prenom_stagiaire}}</label>
                                          </div>
                                        @endforeach
                                        <input type="hidden" name="groupe_id" value="{{ $id_groupe }}">
                                        @if(count($stagiaire)>0)
                                            <button type="submit" class="btn btn-primary">Ajouter les stagiaires</button>
                                        @else
                                        <h4>Tous les stagiaires sont déjà dans cette session</h4>
                                        @endif
                                    </form>
                                </div>
                            </div>
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
    // //enregistrer execution
    // $("#action1").click(function(e){
    //    e.preventDefault();
    //    var evaluation = $("#evaluation").val();
    //    var qualite = $('#qualite').val();
    //    var exc_m1 = $('#exc_m1').val();
    //    var exc_m2= $('#exc_m2').val();
    //    var exc_m3= $('#exc_m3').val();
    //    var exc_m4 = $('#exc_m4').val();
    //    var exc_m5 = $('#exc_m5').val();
    //    var bi_m1 = $('#bi_m1').val();
    //    var bi_m2= $('#bi_m2').val();
    //    var bi_m3= $('#bi_m3').val();
    //    var url = '{{ url('store_execution') }}';
    //      $.ajax({
    //        url:url,
    //        method:'get',
    //        data:{
    //                Qualite : qualite,
    //                Evaluation : evaluation,
    //                Stagiaire_id:id_stagiaire,
    //                Session_id:id_session,
    //                Exc_m1:exc_m1,
    //                Exc_m2:exc_m2,
    //                Exc_m3:exc_m3,
    //                Exc_m4:exc_m4,
    //                Exc_m5:exc_m5,
    //                Bi_m1:bi_m1,
    //                Bi_m2:bi_m2,
    //                Bi_m3:bi_m3
    //             },
    //        success:function(response){
    //           if(response.success){
    //              window.location.reload();
    //           }else{
    //               alert("Error")
    //           }
    //        },
    //        error:function(error){
    //           console.log(error)
    //        }
    //    });
    // });
</script>
{{-- @endsection --}}
