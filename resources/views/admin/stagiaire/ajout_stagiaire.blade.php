


    {{-- nouveau desgin apprenant --}}
<div class="conteneur">
    @if ($type_formation_id == 1)
        @can('isCFP')
            {{-- Nouveau apreanant --}}
            <section class="section_recherche m-0 p-2">
                <div class="d-flex py-1 align-items-center align-content-center">
                    <p class="titre_ajout_apprenant my-3">Pour ajouter un(e) nouvel(le) apprenant(e), veuillez insérer son numéro de matricule.</p>&nbsp;
                    <input type="text" id="matricule_search" data-id="{{ $entreprise_id }}" name="matricule_stg" placeholder="Entrez le matricule ici . . ." class="form-control w-10">
                    <input type="hidden" id="id_entreprise" value="{{ $entreprise_id }}">
                    <button type="submit" class="btn btn-outline-secondary mt-2 rechercher">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <div class="d-flex mb-3">
                    <span class="span_matricule"> <input type="text" class="label_text" id="matricule" disabled  placeholder="Matricule"> </span>
                    <span class="span_name"> <input type="text" class="label_text" id="nom" disabled placeholder="Nom"> </span>
                    <span class="span_name"> <input type="text" class="label_text" id="prenom" disabled placeholder="Prénom"> </span>
                    {{-- <span class="span_name"> <input type="text" class="label_text" id="departement" disabled placeholder="Département"> </span> --}}
                    <span class="span_ajout" id="boutton_add">
                        <i class="boutton fa fa-plus-circle" id="add_apprenant"></i>
                    </span>
                </div>
            </section><br><hr><br>
            {{-- fin nouveau apprenant --}}
        @endcan
    @endif
    @if ($type_formation_id == 2)
        @can('isReferent')
            {{-- Nouveau apreanant --}}
            <section class="section_recherche m-0 p-2">
                <div class="d-flex py-1 align-items-center align-content-center">
                    <p class="titre_ajout_apprenant my-3">Pour ajouter un(e) nouvel(le) apprenant(e), veuillez insérer son numéro de matricule.</p>&nbsp;
                    <input type="text" id="matricule_search" data-id="{{ $entreprise_id }}" name="matricule_stg" placeholder="Entrez le matricule ici . . ." class="form-control w-10">
                    <input type="hidden" id="id_entreprise" value="{{ $entreprise_id }}">
                    <button type="submit" class="btn btn-outline-secondary mt-2 rechercher">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <div class="d-flex mb-3">
                    <span class="span_matricule"> <input type="text" class="label_text" id="matricule" disabled  placeholder="Matricule"> </span>
                    <span class="span_name"> <input type="text" class="label_text" id="nom" disabled placeholder="Nom"> </span>
                    <span class="span_name"> <input type="text" class="label_text" id="prenom" disabled placeholder="Prénom"> </span>
                    {{-- <span class="span_name"> <input type="text" class="label_text" id="departement" disabled placeholder="Département"> </span> --}}
                    <span class="span_ajout" id="boutton_add">
                        <i class="boutton fa fa-plus-circle" id="add_apprenant"></i>
                    </span>
                </div>
            </section><br><hr><br>
            {{-- fin nouveau apprenant --}}
        @endcan
    @endif
    <div class="d-flex justify-content-between">
        <h5>Liste des apprenants inscrits(es) au projet</h5>
        <div class="d-flex">
            {{-- <button class="btn btn-secondary mx-1 align-items-center"><i class="far fa-file-pdf"></i>&nbsp; Exporter en PDF</button>
            <button class="btn btn-secondary"><i class="far fa-file-excel"></i>&nbsp; Exporter en Excel</button> --}}
        </div>
    </div>
    <br>
        <table class="table table-striped" id="test_table">
            <thead>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Téléphone</th>
                <th>E-mail</th>
                <th>Fonction</th>
                <th>Département</th>
                <th>Service</th>
                @can('isCFP')
                     <th></th>
                @endcan
            </thead>
            <tbody id="participant_groupe">
                @foreach ($stagiaire as  $stg)
                <tr id="row_{{ $stg->stagiaire_id }}">
                    <td>{{ $stg->matricule }}</td>
                    <td>{{ $stg->nom_stagiaire }}</td>
                    <td>{{ $stg->prenom_stagiaire }}</td>
                    <td>{{ $stg->genre_stagiaire }}</td>
                    <td>{{ $stg->telephone_stagiaire }}</td>
                    <td>{{ $stg->mail_stagiaire }}</td>
                    <td>{{ $stg->fonction_stagiaire }}</td>
                    <td>{{ $stg->nom_departement }}</td>
                    <td>{{ $stg->nom_service }}</td>
                    @can('isCFP')
                        <td><button type="button" class="supprimer" data-bs-toggle="modal" data-bs-target="#delete_stg_{{$stg->stagiaire_id}}"><i class="fa fa-trash-alt supprimer"></i></button></td>
                    @endcan
                </tr>
                <div class="modal fade" id="delete_stg_{{$stg->stagiaire_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header  d-flex justify-content-center" style="background-color:rgb(224,182,187);">
                                <h6 class="modal-title">Avertissement !</h6>
                            </div>
                            <div class="modal-body">
                                <small>Vous êtes sur le point d'effacer une donnée, cette action est irréversible. Continuer ?</small>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Non </button>
                                <button type="button" class="btn btn-secondary supprimer_stg" id="{{$stg->stagiaire_id}}" data-bs-dismiss="modal">Oui</button>
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

    $(".rechercher").on('click',function(e){
        var id = $("#matricule_search").val();
        var etp_id = @php echo $entreprise_id; @endphp;
        $.ajax({
            type: "GET",
            url: "{{route('one_stagiaire')}}",
            data:{
                Id:id,
                etp:etp_id
            },
            dataType: "html",
            success:function(response){
                // alert(JSON.stringify(response));
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

    $(".span_ajout").on('click',function(e){
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
                $("#matricule").val('');
                $("#nom").val('');
                $("#prenom").val('');
                $("#departement").val('');
                $("#test_table > tbody").empty();
                var html = '';
                for (var i = 0; i < userData.length; i++){
                    html +='<tr id="row_'+userData[i].stagiaire_id+'">';
                    html +='<td>'+userData[i].matricule+'</td>';
                    html += '<td>'+userData[i].nom_stagiaire+'</td>';
                    html += '<td>'+userData[i].prenom_stagiaire+'</td>';
                    html += '<td>'+userData[i].genre_stagiaire+'</td>';
                    html += '<td>'+userData[i].telephone_stagiaire+'</td>';
                    html += '<td>'+userData[i].mail_stagiaire+'</td>';
                    html += '<td>'+userData[i].fonction_stagiaire+'</td>';
                    html += '<td>'+userData[i].nom_departement+'</td>';
                    html += '<td>'+userData[i].nom_service+'</td>';
                    html += '<td><button type="button" class="supprimer" data-bs-toggle="modal" data-bs-target="#exampleModal_'+userData[i].stagiaire_id+'"><i class="fa fa-trash-alt supprimer"></i></button></td>';
                    html += '</tr>';
                    html += '<div class="modal fade" id="exampleModal_'+userData[i].stagiaire_id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                    html += '<div class="modal-dialog modal-dialog-centered" role="document">';
                    html += '<div class="modal-content">';
                    html += '<div class="modal-header  d-flex justify-content-center" style="background-color:rgb(224,182,187);">';
                    html += '<h6 class="modal-title">Avertissement !</h6>';
                    html += '</div>';
                    html += '<div class="modal-body">';
                    html += '<small>Vous êtes sur le point d\'effacer une donnée, cette action est irréversible. Continuer ?</small>';
                    html += '</div>';
                    html += '<div class="modal-footer">';
                    html += '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Non </button>';
                    html += '<button type="button" class="btn btn-secondary supprimer_stg" id="'+userData[i].stagiaire_id+'" data-bs-dismiss="modal"> Oui </button>'
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                    html += '</div>';
                }
                $('#participant_groupe').append(html);
                // location.reload(true);
           },
           error:function(error){
              console.log(error)
           }
        });
    });

    // $(".ajouter_participant").on('click',function(e){
    //     alert('eto');
    //     var id = $("#matricule").val();
    //     var groupe_id = @php echo $projet[0]->groupe_id; @endphp;
    //     $.ajax({
    //         type: "GET",
    //         url: "{{route('add_participant_groupe')}}",
    //         data:{
    //             Id:id,
    //             groupe:groupe_id
    //         },
    //         dataType: "html",
    //         success:function(response){
    //             var userData=JSON.parse(response);
    //             $("#matricule").val('');
    //             $("#nom").val('');
    //             $("#prenom").val('');
    //             $("#departement").val('');
    //             $("#test_table > tbody").empty();
    //             var html = '';
    //             for (var i = 0; i < userData.length; i++){
    //                 html +='<tr id="row_'+userData[i].stagiaire_id+'">';
    //                 html +='<td>'+userData[i].matricule+'</td>';
    //                 html += '<td>'+userData[i].nom_stagiaire+'</td>';
    //                 html += '<td>'+userData[i].prenom_stagiaire+'</td>';
    //                 html += '<td>'+userData[i].genre_stagiaire+'</td>';
    //                 html += '<td>'+userData[i].telephone_stagiaire+'</td>';
    //                 html += '<td>'+userData[i].mail_stagiaire+'</td>';
    //                 html += '<td>'+userData[i].fonction_stagiaire+'</td>';
    //                 html += '<td>'+userData[i].nom_departement+'</td>';
    //                 html += '<td>'+userData[i].nom_service+'</td>';
    //                 html += '<td><button type="button" class="supprimer" data-toggle="modal" data-target="#exampleModal_'+userData[i].stagiaire_id+'"><i class="fa fa-trash-alt supprimer"></i></button></td>';
    //                 html += '</tr>';
    //                 html += '<div class="modal fade" id="exampleModal_'+userData[i].stagiaire_id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
    //                 html += '<div class="modal-dialog modal-dialog-centered" role="document">';
    //                 html += '<div class="modal-content">';
    //                 html += '<div class="modal-header  d-flex justify-content-center" style="background-color:rgb(224,182,187);">';
    //                 html += '<h6 class="modal-title">Avertissement !</h6>';
    //                 html += '</div>';
    //                 html += '<div class="modal-body">';
    //                 html += '<small>Vous êtes sur le point d\'effacer une donnée, cette action est irréversible. Continuer ?</small>';
    //                 html += '</div>';
    //                 html += '<div class="modal-footer">';
    //                 html += '<button type="button" class="btn btn-secondary" data-dismiss="modal"> Non </button>';
    //                 html += '<button type="button" class="btn btn-secondary supprimer_stg" id="'+userData[i].stagiaire_id+'" data-dismiss="modal"> Oui </button>'
    //                 html += '</div>';
    //                 html += '</div>';
    //                 html += '</div>';
    //                 html += '</div>';
    //             }
    //             $('#participant_groupe').append(html);

    //        },
    //        error:function(error){
    //           console.log(error)
    //        }
    //     });
	// });


    // $(".rechercher").on('click',function(e){
    //     var id = $("#matricule_search").val();
    //     $.ajax({
    //         type: "GET",
    //         url: "{{route('one_stagiaire')}}",
    //         data:{Id:id},
    //         dataType: "html",
    //         success:function(response){
    //             var userData=JSON.parse(response);
    //             $("#matricule").val(userData[0].matricule);
    //             $("#nom").val(userData[0].nom_stagiaire);
    //             $("#prenom").val(userData[0].prenom_stagiaire);
    //             $("#departement").val(userData[0].nom_departement);
    //             // var html = '<i class="boutton fa fa-plus-circle" id="ajouter_participant"></i>';
    //             // $('#boutton_add').append(html);
    //             // id_detail = userData[$i].id;
    //             // $('#action1').val('Modifier');
    //        },
    //        error:function(error){
    //           console.log(error)
    //        }
    //     });
	// });

    $(".supprimer_stg").on('click', function(e) {
        var id = e.target.id;
        var groupe_id = @php echo $projet[0]->groupe_id; @endphp;
        $.ajax({
            type: "GET"
            , url: "{{route('supprimer_participant_groupe')}}"
            , data: {
                Id: id,
                groupe:groupe_id
            }
            , success: function(response) {
                if (response.success) {
                    var row=document.getElementById("row_"+id);
                    row.parentNode.removeChild(row);
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
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
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
