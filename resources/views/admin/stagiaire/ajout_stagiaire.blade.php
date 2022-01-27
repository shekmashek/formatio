
{{-- <div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">

                                <div class="panel-body">

                                    <form  action="{{ route('insert_detailStagiaire') }}">

                                        @foreach ($stagiaire as $stg)
                                        <div class="form-group form-check">
                                            <input type="checkbox" name="stagiaire[]" class="form-check-input" value="{{ $stg->id }}" id="exampleCheck1">
                                            <label class="form-check-label" for="exampleCheck">{{ $stg->matricule."  :  ".$stg->nom_stagiaire." ".$stg->prenom_stagiaire}}</label>
                                          </div>
                                        @endforeach

                                        <input type="hidden" name="groupe_id" value="{{ $projet[0]->groupe_id }}">
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
</div> --}}

    {{-- nouveau desgin apprenant --}}
<div class="conteneur">
    {{-- Nouveau apreanant --}}
    <section class="section_recherche m-0 p-2">
        <div class="d-flex py-1 align-items-center align-content-center">
            <p class="titre_ajout_apprenant my-3">Pour ajouter un(e) nouvel(le) apprenant(e), veuillez insérer son numéro de matricule.</p>&nbsp;
            <input type="text" id="matricule_search" data-id="{{ $projet[0]->entreprise_id }}" name="matricule_stg" placeholder="Entrez le matricule ici . . ." class="form-control col-3">
            <input type="hidden" id="id_entreprise" value="{{ $projet[0]->entreprise_id }}">
            <button type="submit" class="btn btn-outline-secondary mt-2 rechercher">
                <i class="fa fa-search"></i>
            </button>
        </div>
        <div class="d-flex mb-3">
            <span class="span_matricule"> <input type="text" class="label_text" id="matricule" disabled  placeholder="Matricule"> </span>
            <span class="span_name"> <input type="text" class="label_text" id="nom" disabled placeholder="Nom"> </span>
            <span class="span_name"> <input type="text" class="label_text" id="prenom" disabled placeholder="Prénom"> </span>
            <span class="span_name"> <input type="text" class="label_text" id="departement" disabled placeholder="Département"> </span>
            <span class="span_ajout"> 
                <i class="boutton fa fa-plus-circle" id="ajouter_participant"></i>
             </span>
        </div>
    </section><br><hr><br>
    {{-- fin nouveau apprenant --}}
    <div class="d-flex justify-content-between">
        <h5>Liste des apprenants inscrits(es) au projet</h5>
        <div class="d-flex">
            <button class="btn btn-secondary mx-1 align-items-center"><i class="far fa-file-pdf"></i>&nbsp; Exporter en PDF</button>
            <button class="btn btn-secondary"><i class="far fa-file-excel"></i>&nbsp; Exporter en Excel</button>
        </div>
    </div>
    <br>
        <table class="table table-striped">
            <thead>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Téléphone</th>
                <th>E-mail</th>
                <th>Fonction</th>
                <th>Département</th>
                <th></th>
            </thead>
            <tbody id="participant_groupe">
                @foreach ($stagiaire as  $stg)
                <tr>
                    <td>{{ $stg->matricule }}</td>
                    <td>{{ $stg->nom_stagiaire }}</td>
                    <td>{{ $stg->prenom_stagiaire }}</td>
                    <td>{{ $stg->genre_stagiaire }}</td>
                    <td>{{ $stg->telephone_stagiaire }}</td>
                    <td>{{ $stg->mail_stagiaire }}</td>
                    <td>{{ $stg->fonction_stagiaire }}</td>
                    <td>{{ $stg->departement_id }}</td>
                    <td><button class="supprimer" data-toggle="modal" data-target="#exampleModal_{{$stg->stagiaire_id}}"><i class="fa fa-trash-alt supprimer"></i></button></td>
                </tr>
                <div class="modal fade" id="exampleModal_{{$stg->stagiaire_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header  d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                <h6 class="modal-title">Avertissement !</h6>
                            </div>
                            <div class="modal-body">
                                <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>
                                <button type="button" class="btn btn-secondary supprimer_stg" id="{{$stg->stagiaire_id}}"> Oui </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>
</div>
<style>
.supprimer:hover{
    cursor: pointer;
}

.boutton{
    font-size: 2rem;
}
.boutton:hover{
    cursor: pointer;
}

.table-straped > tbody > tr:nth-child(2n+1) > td, .table-stroped > tbody > tr:nth-child(2n+1) > th {
   background-color: rgb(255,249,224);
}
.titre_ajout_apprenant{
    font-size: 14px;
    text-align: left !important;
}
.label_text{
    background-color: #fff;
    border: none;
}
.span_name{
    width: 100%;
    border-bottom: 1px solid grey;
    padding-bottom: .8rem;
    margin: 0 1rem;
    color: grey;
}
.span_ajout{
    width: 20%;
    border-bottom: 1px solid grey;
    padding-bottom: .8rem;
    margin: 0 1rem;
    color: grey;
}
.span_matricule{
    width: 50%;
    border-bottom: 1px solid grey;
    padding-bottom: .8rem;
    margin: 0 1rem;
    color: grey;
}
.section_recherche{
    border: 3px solid rgba(230, 228, 228, 0.39);
    border-radius: .5rem;
}
.icon_box{
    font-size: 8PX;
}
th{
    text-align: center;
}
td{
    text-align: center;
}
</style>



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

    $(".rechercher").on('click',function(e){
        var id = $("#matricule_search").val();
        $.ajax({
            type: "GET",
            url: "{{route('one_stagiaire')}}",
            data:{Id:id},
            dataType: "html",
            success:function(response){
                var userData=JSON.parse(response);
                $("#matricule").val(userData[0].matricule);
                $("#nom").val(userData[0].nom_stagiaire);
                $("#prenom").val(userData[0].prenom_stagiaire);
                $("#departement").val(userData[0].nom_departement);
                // id_detail = userData[$i].id;
                // $('#action1').val('Modifier');
           },
           error:function(error){
              console.log(error)
           }
        });
	});


    $("#ajouter_participant").on('click',function(e){
        var id = $("#matricule").val();
        var groupe_id = @php echo $projet[0]->groupe_id; @endphp;
        $.ajax({
            type: "GET",
            url: "{{route('add_participant_groupe')}}",
            data:{
                Id:id,
                groupe:groupe_id
            },
            dataType: "html",
            success:function(response){
                var userData=JSON.parse(response);
                alert(userData);
           },
           error:function(error){
              console.log(error)
           }
        });
	});


    $(".rechercher").on('click',function(e){
        var id = $("#matricule_search").val();
        $.ajax({
            type: "GET",
            url: "{{route('one_stagiaire')}}",
            data:{Id:id},
            dataType: "html",
            success:function(response){
                var userData=JSON.parse(response);
                $("#matricule").val(userData[0].matricule);
                $("#nom").val(userData[0].nom_stagiaire);
                $("#prenom").val(userData[0].prenom_stagiaire);
                $("#departement").val(userData[0].nom_departement);
                // id_detail = userData[$i].id;
                // $('#action1').val('Modifier');
           },
           error:function(error){
              console.log(error)
           }
        });
	});

    $(".supprimer_stg").on('click', function(e) {
        var id = e.target.id;
        var groupe_id = @php echo $projet[0]->groupe_id; @endphp;
        $.ajax({
            type: "GET"
            , url: "{{route('destroy_module')}}"
            , data: {
                Id: id,
                groupe:groupe_id
            }
            , success: function(response) {
                if (response.success) {
                    window.location.reload();
                } else {
                    alert("Error")
                }
            }
            , error: function(error) {
                console.log(error)
            }
        });
    });
</script>
<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    var etp_id = $("#id_entreprise").val();
    $(document).ready(function() {
        $("#matricule_search").autocomplete({
            source: function(request, response) {
                // Fetch data
                $.ajax({
                    url: "{{route('search_matricule')}}"
                    , type: 'get'
                    , dataType: "json"
                    , data: {
                        //    _token: CSRF_TOKEN,
                        search: request.term,
                        etp_id : etp_id
                    }
                    , success: function(data) {
                        // alert("eto");
                        response(data);
                    }
                    , error: function(data) {
                        alert("error");
                        //alert(JSON.stringify(data));
                    }
                });
            }
            , select: function(event, ui) {
                // Set selection
                $('#matricule_search').val(ui.item.label); // display the selected text
                $('#stagiaireid').val(ui.item.value); // save selected id to input
                return false;
            }
        });
    });

    

</script>
