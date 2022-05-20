


    {{-- nouveau desgin apprenant --}}
<div class="conteneur">
    <nav class="d-flex justify-content-between mb-1 ">
        <span class="titre_detail_session"><strong style="font-size: 14px">Liste des apprenants inscrits(es) au projet</strong></span>
    </nav>
    @if ($type_formation_id == 1)
        @can('isCFP')
            {{-- Nouveau apreanant --}}
            <section class="section_recherche m-0 p-2">
                <div class="d-flex py-1 align-items-center align-content-center">
                    <p class="titre_ajout_apprenant my-3">Pour ajouter un(e) nouvel(le) apprenant(e), veuillez insérer son numéro de matricule : </p>&nbsp;
                    <input type="text" id="matricule_search" data-id="{{ $entreprise_id }}" name="matricule_stg" placeholder="Entrez le matricule ici . . ." class="matricule_search_input form-control">
                    <input type="hidden" id="id_entreprise" value="{{ $entreprise_id }}">
                    <button type="submit" class="btn btn-outline-secondary m-0 rechercher">
                        <i class="fa fa-search m-0"></i>
                    </button>
                </div>
                <div class="d-flex mb-3" id="ajout_stg_mat"></div>
                <div class="d-flex mb-3">
                    <span class="span_matricule" id="image_stg"></span>
                    <span class="span_matricule"> <input type="text" class="label_text" id="matricule" disabled > </span>
                    <span class="span_name"> <input type="text" class="label_text" id="nom" disabled > </span>
                    <span class="span_name"> <input type="text" class="label_text" id="prenom" disabled> </span>
                    <span class="span_name"> <input type="text" class="label_text" id="fonction"> </span>
                    <span class="span_ajout" id="boutton_add" style="display: none;">
                        <i class="boutton fa fa-plus-circle" id="add_apprenant"></i>
                    </span>
                </div>
            </section><br>
            {{-- fin nouveau apprenant --}}
        @endcan
    @endif
    @if ($type_formation_id == 2)
        @can('isReferent')
            {{-- Nouveau apreanant --}}
            <section class="section_recherche m-0 p-2">
                <div class="d-flex py-1 align-items-center align-content-center">
                    <p class="titre_ajout_apprenant my-3">Pour ajouter un(e) nouvel(le) apprenant(e), veuillez insérer son numéro de matricule :</p>&nbsp;
                    <input type="text" id="matricule_search" data-id="{{ $entreprise_id }}" name="matricule_stg" placeholder="Entrez le matricule ici . . ." class="matricule_search_input form-control">
                    <input type="hidden" id="id_entreprise" value="{{ $entreprise_id }}">
                    <button type="submit" class="btn btn-outline-secondary m-0 rechercher">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <div class="d-flex mb-3" id="ajout_stg_mat"></div>
                <div class="d-flex mb-3">
                    <span class="span_matricule" id="image_stg"></span>
                    <span class="span_matricule"> <input type="text" class="label_text" id="matricule" disabled> </span>
                    <span class="span_name"> <input type="text" class="label_text" id="nom" disabled > </span>
                    <span class="span_name"> <input type="text" class="label_text" id="prenom" disabled > </span>
                    <span class="span_name"> <input type="text" class="label_text" id="fonction" disabled> </span>
                    <span class="span_ajout" id="boutton_add" style="display: none;">
                        <i class="boutton fa fa-plus-circle" id="add_apprenant"></i>
                    </span>
                </div>
            </section><br>
            {{-- fin nouveau apprenant --}}
        @endcan
    @endif
    {{-- <div class="d-flex justify-content-between">
        <h6>Liste des apprenants inscrits(es) au projet</h6>
        <div class="d-flex">
            <button class="btn btn-secondary mx-1 align-items-center"><i class="far fa-file-pdf"></i>&nbsp; Exporter en PDF</button>
            <button class="btn btn-secondary"><i class="far fa-file-excel"></i>&nbsp; Exporter en Excel</button>
        </div>
    </div> --}}
    {{-- <br> --}}
    <style>
        .titre_projet {
            background: rgba(235, 233, 233, 0.658);
            border-radius: 5px;
        }

        .titre_projet:hover {
            color: #7635dc;
            background-color: #6373811f;
        }

        .titre_projet .collapsed {
            color: #637381;
        }
        .titre_projet {
            color: #7635dc;
        }
    </style>
    @if (count($stagiaire) <= 0)
        <table class="table table-hover table-borderless" id="test_table">
            <thead style="border-bottom: 1px solid black; line-height: 20px">
                <th>Photo</th>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>E-mail</th>
                <th>Fonction</th>
                {{-- <th>Département</th>
                <th>Service</th> --}}
                @can('isCFP')
                    <th></th>
                @endcan
            </thead>
            <tbody id="participant_groupe">
            </tbody>
        </table>
        <div class="d-flex mt-3 titre_projet p-1 mb-1" id="liste_vide">
            <span class="text-center">Aucun apprenant inscrit</span>
        </div>
    @else
        <table class="table table-hover table-borderless" id="test_table">
            <thead style="border-bottom: 1px solid black; line-height: 20px">
                <th>Photo</th>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Téléphone</th>
                <th>E-mail</th>
                <th>Fonction</th>
                {{-- <th>Département</th>
                <th>Service</th> --}}
                @can('isCFP')
                     <th></th>
                @endcan
                @if ($type_formation_id == 2)
                    @can('isReferent')
                        <th></th>
                    @endcan
                @endif
            </thead>
            <tbody id="participant_groupe">
                @foreach ($stagiaire as  $stg)
                <tr id="row_{{ $stg->stagiaire_id }}">
                    <td>
                        @if ($stg->photos != null)
                            <img src="{{ asset('images/stagiaires/'.$stg->photos) }}" alt="" height="30px" width="30px" style="border-radius: 50%;">
                        @else
                            <span class="m-0 p-0" style="background-color:rgb(238, 238, 238); font-size: 16px; border: none; border-radius: 100%; height:30px; width:30px ; display: grid; place-content: center;">{{ $stg->sans_photos }}
                            </span>
                        @endif
                    </td>
                    <td>{{ $stg->matricule }}</td>
                    <td>{{ $stg->nom_stagiaire }}</td>
                    <td>{{ $stg->prenom_stagiaire }}</td>
                    <td>
                        @php
                            echo $groupe->formatting_phone($stg->telephone_stagiaire);
                        @endphp
                    </td>
                    <td>{{ $stg->mail_stagiaire }}</td>
                    <td>{{ $stg->fonction_stagiaire }}</td>
                    {{-- <td>{{ $stg->nom_departement }}</td>
                    <td>{{ $stg->nom_service }}</td> --}}
                    @can('isCFP')
                        <td><button type="button" class="supprimer" data-bs-toggle="modal" data-bs-target="#delete_stg_{{$stg->stagiaire_id}}"><i class="bx bx-trash bx_supprimer"></i></button></td>
                    @endcan
                    @if ($type_formation_id == 2)
                        @can('isReferent')
                            <td><button type="button" class="supprimer" data-bs-toggle="modal" data-bs-target="#delete_stg_{{$stg->stagiaire_id}}"><i class="bx bx-trash bx_supprimer"></i></button></td>
                        @endcan
                    @endif
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
    @endif
</div>
<style>
.matricule_search_input{
    width: 20%;
}

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
    /* border-bottom: 1px solid grey; */
    padding-bottom: .3rem;
    margin: 0 1rem;
    color: grey;
}
.span_ajout{
    width: 20%;
    /* border-bottom: 1px solid grey; */
    padding-bottom: .3rem;
    margin: 0 1rem;
    color: grey;
}
.span_matricule{
    width: 50%;
    /* border-bottom: 1px solid grey; */
    padding-bottom: .3rem;
    margin: 0 1rem;
    color: grey;
}
/* .section_recherche{
    border: 3px solid rgba(230, 228, 228, 0.39);
    border-radius: .5rem;
} */
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
        var groupe_id = @php echo $projet[0]->groupe_id; @endphp;
        $.ajax({
            type: "GET",
            url: "{{route('one_stagiaire')}}",
            data:{
                Id:id,
                etp:etp_id,
                groupe:groupe_id
            },
            dataType: "html",
            success:function(response){
                // alert(JSON.stringify(response));
                var data=JSON.parse(response);

                if(data['status'] == '200'){
                    $('#ajout_stg_mat').html('');
                    if(data['inscrit'] > 0){
                        $("#matricule").val('');
                        $("#nom").val('');
                        $("#prenom").val('');
                        $("#fonction").val('');
                        $(".span_ajout").hide();
                        $("#image_stg").html('');
                        $('#ajout_stg_mat').append('<span style="color:red">Apprenant déjà inscrit dans cette session.</span>');
                    }else{
                        var userData = data['stagiaire'];
                        $("#image_stg").html('');
                        html = '';
                        if(userData[0].photos == null){
                            html = '<span class="m-0 p-0" style="background-color:rgb(238, 238, 238); font-size: 16px; border: none; border-radius: 100%; height:30px; width:30px ; display: grid; place-content: center;">'+userData[0].sans_photo+'</span>';
                        }else{
                            html = '<img src="{{ asset("images/stagiaires/:?") }}" alt="" height="30px" width="30px" style="border-radius: 50%;">';
                            html = html.replace(":?",userData[0].photos);
                        }
                        $("#image_stg").append(html);
                        $("#matricule").val(userData[0].matricule);
                        $("#nom").val(userData[0].nom_stagiaire);
                        $("#prenom").val(userData[0].prenom_stagiaire);
                        $("#fonction").val(userData[0].fonction_stagiaire);
                        // $("#boutton_add").append('<i class="boutton fa fa-plus-circle" id="add_apprenant"></i>');
                        $(".span_ajout").show();
                        // $(".span_ajout").hide();
                        // alert('eto');
                        // id_detail = userData[$i].id;
                        // $('#action1').val('Modifier');
                    }
                }
                if(data['status'] == '400'){
                    $('#ajout_stg_mat').html('');
                    $("#matricule").val('');
                    $("#nom").val('');
                    $("#prenom").val('');
                    $("#fonction").val('');
                    $(".span_ajout").hide();
                    $("#image_stg").html('');
                    $('#ajout_stg_mat').append('<span style="color:red">Matricule introuvable</span>');
                }
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
                $("#fonction").val('');
                $("#test_table > tbody").empty();
                // var html = '';
                // for (var i = 0; i < userData.length; i++){
                //     photo = '';
                //     if(userData[i].photos == null){
                //         photo = '<span class="m-0 p-0" style="background-color:rgb(238, 238, 238); font-size: 16px; border: none; border-radius: 100%; height:30px; width:30px ; display: grid; place-content: center;">'+userData[0].sans_photo+'</span>';
                //     }else{
                //         photo = '<img src="{{ asset("images/stagiaires/:?") }}" alt="" height="30px" width="30px" style="border-radius: 50%;">';
                //         photo = photo.replace(":?",userData[i].photos);
                //     }
                //     // alert(html);
                //     html +='<tr id="row_'+userData[i].stagiaire_id+'">';
                //     html += '<td>'+photo+'</td>';
                //     html +='<td>'+userData[i].matricule+'</td>';
                //     html += '<td>'+userData[i].nom_stagiaire+'</td>';
                //     html += '<td>'+userData[i].prenom_stagiaire+'</td>';
                //     html += '<td>'+userData[i].telephone_stagiaire+'</td>';
                //     html += '<td>'+userData[i].mail_stagiaire+'</td>';
                //     html += '<td>'+userData[i].fonction_stagiaire+'</td>';
                //     // html += '<td>'+userData[i].nom_departement+'</td>';
                //     // html += '<td>'+userData[i].nom_service+'</td>';
                //     html += '<td><button type="button" class="supprimer" data-bs-toggle="modal" data-bs-target="#exampleModal_'+userData[i].stagiaire_id+'"><i class="bx bx-trash bx_supprimer"></i></button></td>';
                //     html += '</tr>';
                //     html += '<div class="modal fade" id="exampleModal_'+userData[i].stagiaire_id+'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">';
                //     html += '<div class="modal-dialog modal-dialog-centered" role="document">';
                //     html += '<div class="modal-content">';
                //     html += '<div class="modal-header  d-flex justify-content-center" style="background-color:rgb(224,182,187);">';
                //     html += '<h6 class="modal-title">Avertissement !</h6>';
                //     html += '</div>';
                //     html += '<div class="modal-body">';
                //     html += '<small>Vous êtes sur le point d\'effacer une donnée, cette action est irréversible. Continuer ?</small>';
                //     html += '</div>';
                //     html += '<div class="modal-footer">';
                //     html += '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Non </button>';
                //     html += '<button type="button" class="btn btn-secondary supprimer_stg" id="'+userData[i].stagiaire_id+'" data-bs-dismiss="modal"> Oui </button>'
                //     html += '</div>';
                //     html += '</div>';
                //     html += '</div>';
                //     html += '</div>';
                // }
                // $('#participant_groupe').append(html);
                $(".span_ajout").hide();
                $("#image_stg").hide();
                $("#liste_vide").remove();

                location.reload();
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
<script>
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
