<style>
    #faire_presence:hover {
        cursor: pointer;
    }

</style>
<div class="container">
    <div class="row m-0">
        <div class="col-md-2 text-center">Module</div>
        <div class="col-md-4 text-center">Lieu</div>
        <div class="col-md-2 text-center">Date</div>
        <div class="col-md-1 text-center">Début</div>
        <div class="col-md-1 text-center">Fin</div>
        <div class="col-md-2 text-center">Action</div>
        <hr class="m-2 p-0">
    </div>
    @foreach ($datas as $dt)
    @php
        $status = '';
    @endphp
        <form action="{{ route('insert_presence_detail') }}" method="post" id="insert_form">
            @csrf
            <input type="hidden" name="groupe" value="{{ $projet[0]->groupe_id }}">
            <input type="hidden" name="detail_id" value="{{ $dt->detail_id }}">
            <div id="presence_stagiaire">
                <div class="row m-0 p-0">
                    <div class="col-md-2 text-center">{{ $dt->nom_module }}</div>
                    <div class="col-md-4 text-center">{{ $dt->lieu }}</div>
                    <div class="col-md-2 text-center">{{ $dt->date_detail }}</div>
                    <div class="col-md-1 text-center">{{ $dt->h_debut }}</div>
                    <div class="col-md-1 text-center">{{ $dt->h_fin }}</div>
                    <div class="col-md-2 text-center fermer_collapse"><i id="faire_presence" data-bs-toggle="collapse"
                            href="#stagiaire_presence_{{ $dt->detail_id }}" class="bx bx-edit reset_radio">Emargement</i></div>
                </div>
                <hr class="m-2 p-0">
                <div class="collapse" id="stagiaire_presence_{{ $dt->detail_id }}">
                    @foreach ($presence_detail as $pre)    
                        @if ($pre->detail_id == $dt->detail_id && $pre->text_status == "non")
                            @php
                                $status='non';
                            @endphp
                            <div class="row m-0 p-0 d-flex flex-grow">
                                <div class="col-md-1 text-center">{{ $pre->matricule }}</div>
                                <div class="col-md-2 text-center">{{ $pre->nom_stagiaire }}</div>
                                <div class="col-md-2 text-center">{{ $pre->prenom_stagiaire }}</div>
                                <div class="col-md-3 text-center" id="resultat_presence_{{ $dt->detail_id . $pre->stagiaire_id }}">
                                    <label style="color: green;">
                                        <input class="m-2 present" type="radio" id="present"
                                            data-id="{{ $dt->detail_id . $pre->stagiaire_id }}"
                                            name="attendance[{{ $dt->detail_id }}][{{ $pre->stagiaire_id }}]" value="1"
                                            required>
                                        Présent
                                    </label>
                                    <label style="color: red;">
                                        <input class="m-2 absent" type="radio" id="absent"
                                            data-id="{{ $dt->detail_id . $pre->stagiaire_id }}"
                                            name="attendance[{{ $dt->detail_id }}][{{ $pre->stagiaire_id }}]" value="0"
                                            required>
                                        Absent
                                    </label>
                                </div>
                                <div class="col-md-2">
                                    <div class="row" class="pointage"
                                        id="pointage_{{ $dt->detail_id . $pre->stagiaire_id }}">
                                        <div class="col-md-6 text-center p-0 m-0">
                                            <input type="time" class="m-0 pointage_entree"
                                                name="h_entree[{{ $dt->detail_id }}][{{ $pre->stagiaire_id }}]"
                                                style="width: 67.1px" onfocus="(this.type='time')" >
                                        </div>
                                        <div class="col-md-6 text-center p-0 m-0">
                                            <input type="time" class="m-0 pointage_sortie"
                                                name="h_sortie[{{ $dt->detail_id }}][{{ $pre->stagiaire_id }}]"
                                                style="width: 67.1px" onfocus="(this.type='time')">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 p-0">
                                    <input type="text" class="mt-0 p-0" name="note_desc[{{ $dt->detail_id }}][{{ $pre->stagiaire_id }}]" placeholder="Note(s)">
                                </div>
                                </tr>
                            </div>
                        @elseif ($pre->detail_id == $dt->detail_id && $pre->text_status != "non")
                            @php
                                $status='oui';
                            @endphp
                            <div class="row m-0 p-0 d-flex flex-grow" id="edit_emargement_{{ $dt->detail_id.$pre->stagiaire_id }}">
                                <div class="col-md-1 text-center">{{ $pre->matricule }}</div>
                                <div class="col-md-2 text-center">{{ $pre->nom_stagiaire }}</div>
                                <div class="col-md-2 text-center">{{ $pre->prenom_stagiaire }}</div>
                                <div class="col-md-3 text-center mt-1" id="resultat_presence_{{ $pre->detail_id . $pre->stagiaire_id }}">
                                    <label style="color: {{ $pre->color_status }};">
                                            {{ $pre->text_status }}
                                    </label>
                                </div>
                                <div class="col-md-2 mt-2">
                                    <i type="button" class="bx bx-edit edit_presence"  data-detail="{{ $dt->detail_id }}" data-stagiaire="{{ $pre->stagiaire_id }}"></i>
                                </div>
                            </div>
                        @endif
                    @endforeach  
                    @if ($status == 'non')
                        <div align="center">
                            <button type="submit" form="insert_form" class="btn-success w-25">Enregistrer</button>
                        </div>
                    @elseif ($status == 'oui')
                        {{-- <div align="center">
                            <button type="button" class="btn btn-inverse-light w-25" data-bs-toggle="modal" data-bs-target="#modifier_presence_{{ $dt->detail_id }}"><i class="fa fa-edit"></i>&nbsp;Modifier </button>
                        </div>
                        <div class="modal fade" id="modifier_presence_{{ $dt->detail_id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                              <div class="modal-content w-auto">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">Modification presence</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body w-auto">
                                    <form action="{{ route('modifier_presence') }}" method="POST">
                                        <input type="hidden" name="groupe" value="{{ $projet[0]->groupe_id }}">
                                        <input type="hidden" name="detail_id" value="{{ $dt->detail_id }}">
                                        @foreach ($stagiaire as $stg)
                                            <div class="row m-0 p-0 d-flex flex-grow">
                                                <div class="col-md-1 text-center">{{ $stg->matricule }}</div>
                                                <div class="col-md-2 text-center">{{ $stg->nom_stagiaire }}</div>
                                                <div class="col-md-2 text-center">{{ $stg->prenom_stagiaire }}</div>
                                                <div class="col-md-3 text-center" id="resultat_presence_{{ $dt->detail_id . $stg->stagiaire_id }}">
                                                    <label style="color: green;">
                                                        <input class="m-2 present" type="radio" id="present"
                                                            data-id="{{ $dt->detail_id . $stg->stagiaire_id }}"
                                                            name="attendance[{{ $dt->detail_id }}][{{ $stg->stagiaire_id }}]" value="1"
                                                            required>
                                                        Présent
                                                    </label>
                                                    <label style="color: red;">
                                                        <input class="m-2 absent" type="radio" id="absent"
                                                            data-id="{{ $dt->detail_id . $pre->stagiaire_id }}"
                                                            name="attendance[{{ $dt->detail_id }}][{{ $stg->stagiaire_id }}]" value="0"
                                                            required>
                                                        Absent
                                                    </label>
                                                </div>
                                                
                                                </tr>
                                            </div>
                                        @endforeach
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Anuller</button>
                                        <button type="submit" class="btn btn-primary">Modifier</button>
                                    </form>
                                </div>
                              </div>
                            </div>
                          </div> --}}
                    @endif
                </div>
            </div>
        </form>
    @endforeach
</div>

<style>
    .answer {
        display: block;
    }

    .answer~.answer {
        display: none;
    }

</style>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
    $(document).ready(function() {
        // change the selector to use a class
        $(".absent").click(function() {
            // this will query for the clicked toggle
            var $toggle = $(this);

            // build the target form id
            var id = "#pointage_" + $toggle.data('id');

            $(id).hide();
        });
        $(".present").click(function() {
            // this will query for the clicked toggle
            var $toggle = $(this);

            // build the target form id
            var id = "#pointage_" + $toggle.data('id');

            $(id).show();
        });

        $(".fermer_collapse").click(function() {
            $(".present").prop('checked', false);
            $(".absent").prop('checked', false);
            $(".pointage_entree").val('');
            $(".pointage_sortie").val('');

        });
    });


    $(document).ready(function() {
        $(".edit_presence").click(function() {
            var $toggle = $(this);
            var id = "#edit_emargement_" + $toggle.data('detail')+$toggle.data('stagiaire');
            var stg = $toggle.data('stagiaire');
            var detail = $toggle.data('detail');
            $.ajax({
                type: "GET",
                url: "{{route('get_presence_stg')}}",
                data:{
                    stagiaire:stg,
                    detail:detail
                },
                dataType: "html",
                success: function(response) {
                    var userData = JSON.parse(response);
                    alert(userData['nom_stagiaire']);
                    var html = '';
                    html += '<div class="row m-0 p-0 d-flex flex-grow">';
                    html += '<div class="col-md-1 text-center">'+userData['matricule']+'</div>';
                    html += '<div class="col-md-2 text-center">'+userData['nom_stagiaire']+'</div>';
                    html += '<div class="col-md-2 text-center">'+userData['prenom_stagiaire']+'</div>';
                    html += '<div class="col-md-3 text-center" id="resultat_presence_'+userData['detail_id']+userData['stagiaire_id']+'>';            
                    html += '<label style="color: green;">';
                    html += '<input class="m-2 present" type="radio" id="present" data-id="'+userData['detail_id']+userData['stagiaire_id']+'" name="attendance['+userData['detail_id']+']['+userData['stagiaire_id']+']" value="1" required>';
                    html += 'Présent';
                    html += '</label>';
                    html += '<label style="color: red;">';
                    html += '<input class="m-2 absent" type="radio" id="absent" data-id="'+userData['detail_id']+userData['stagiaire_id']+'" name="attendance['+userData['detail_id']+']['+userData['stagiaire_id']+']" value="0" required>';          
                    html += 'Absent';
                    html += '</label>';
                    html += '</div>';
                    html += '<div class="col-md-2">';
                    html += '<div class="row" class="pointage" id="pointage_'+userData['detail_id']+userData['stagiaire_id']+'">';         
                    html += '<div class="col-md-6 text-center p-0 m-0">';
                    html += '<input type="time" class="m-0 pointage_entree" name="h_entree['+userData['detail_id']+']['+userData['stagiaire_id']+']" style="width: 67.1px" onfocus="(this.type="time")" >';                 
                    html += '</div>';            
                    html += '<div class="col-md-6 text-center p-0 m-0">';            
                    html += '<input type="time" class="m-0 pointage_sortie" name="h_sortie['+userData['detail_id']+']['+userData['stagiaire_id']+']" style="width: 67.1px" onfocus="(this.type="time")" >';                            
                    html += '</div>';                    
                    html += '</div>';
                    html += '</div>';                            
                    html += '<div class="col-md-2 p-0">';
                    html += '<input type="text" class="mt-0 p-0" name="note_desc['+userData['detail_id']+']['+userData['stagiaire_id']+']" placeholder="Note(s)">';                    
                    html += '</div>';
                    html += '</tr>';                    
                    html += '</div>';            

                    // if(userData['status'] == 1){
                    //     $(id+'>present').find(':radio[name^=attendance][value="1"]').prop('checked', true);
                    // }elseif(userData['status'] == 0){
                    //     $(id+'>absent').find(':radio[name^=attendance][value="0"]').prop('checked', true);
                    // }                  

                    $(id).html(html);
                },
                error: function(error) {
                    console.log(error);
                }
            });

        });
    });

    $(document).on('click', '#add_presence', function(e) {
        var id_detail = $(this).data('id');
        var groupe_id = @php echo $projet[0]->groupe_id; @endphp;
        var attendance = [];
        $("input[type='radio'][name^='attendance']:checked").map(function() {
            attendance.push($(this).val());
        });
        var pointage_entree = $("input[name^='h_entree[]']").map(function() {
            return $(this).val();
        }).get();
        var pointage_sortie = $("input[name^='h_sortie[]']").map(function() {
            return $(this).val();
        }).get();
        var note = $("input[name^='note_desc[]']").map(function() {
            return $(this).val();
        }).get();
        $.ajax({
            type: "GET",
            url: "{{route('insert_presence_detail')}}",
            data:{
                presence:attendance,
                groupe:groupe_id,
                detail_id:id_detail,
                entree:pointage_entree,
                sortie:pointage_sortie,
                note_desc:note
            },
            dataType: "html",
            success: function(response) {
                alert('eto');
                var userData = JSON.parse(response);
                for (let i = 0; i < userData.length; i++) {
                    var html = '';
                    var div_presence = 'resultat_presence_';
                    var div_pointage = 'pointage_';
                    html += '<label style="color:'+userData[i].color_status+'">';
                    html += userData[i].text_status;
                    html += '</label>';

                    div_presence +=  userData[i].detail_id;
                    div_presence += userData[i].stagiaire_id;

                    div_pointage +=  userData[i].detail_id;
                    div_pointage += userData[i].stagiaire_id;

                    $("'#"+div_presence+"'").append(html);
                    $("'#"+div_pointage+"'").hide();
                }

            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>
