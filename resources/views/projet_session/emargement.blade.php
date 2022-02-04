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
        <div id="presence_stagiaire">
            <div class="row m-0 p-0">
                <div class="col-md-2 text-center">{{ $dt->nom_module }}</div>
                <div class="col-md-4 text-center">{{ $dt->lieu }}</div>
                <div class="col-md-2 text-center">{{ $dt->date_detail }}</div>
                <div class="col-md-1 text-center">{{ $dt->h_debut }}</div>
                <div class="col-md-1 text-center">{{ $dt->h_fin }}</div>
                <div class="col-md-2 text-center fermer_collapse"><i id="faire_presence" data-toggle="collapse"
                        href="#stagiaire_presence_{{ $dt->detail_id }}" class="fa fa-edit reset_radio">Emargement</i></div>
            </div>
            <hr class="m-2 p-0">
            <div class="collapse" id="stagiaire_presence_{{ $dt->detail_id }}">
                {{-- <form action="{{ route('insert_presence') }}" id="myform" method="post" role="form"> --}}
                <div class="row m-0 p-0 d-flex flex-grow">
                    {{-- @foreach ($presence_detail as $prd)
                        @if ($prd->detail_id == $dt->detail_id)
                            @foreach ($stagiaire as $liste)
                                @if ()

                                @endif
                                <div class="col-md-1 text-center">{{ $liste->matricule }}</div>
                                <div class="col-md-2 text-center">{{ $liste->nom_stagiaire }}</div>
                                <div class="col-md-2 text-center">{{ $liste->prenom_stagiaire }}</div>
                                <div class="col-md-7 text-center">
                                    <label style="color: {{ $prd->color_status }};">
                                        {{ $prd->text_status }}
                                    </label>
                                </div>
                            @endforeach

                        @else --}}
                            @foreach ($stagiaire as $liste)
                                <div class="col-md-1 text-center">{{ $liste->matricule }}</div>
                                <div class="col-md-2 text-center">{{ $liste->nom_stagiaire }}</div>
                                <div class="col-md-2 text-center">{{ $liste->prenom_stagiaire }}</div>
                                <div class="col-md-3 text-center" id="resultat_presence_{{ $dt->detail_id . $liste->stagiaire_id }}">
                                    {{-- @if ($message != '')
                                <label>{{ $liste->status }}</label>
                                @else --}}
                                    @csrf
                                    {{-- <div class="radio"> --}}
                                    <label style="color: green;">
                                        <input class="m-2 present" type="radio" id="present"
                                            data-id="{{ $dt->detail_id . $liste->stagiaire_id }}"
                                            name="attendance[{{ $dt->detail_id }}][{{ $liste->stagiaire_id }}]" value="1"
                                            required>
                                        Présent
                                    </label>
                                    <label style="color: red;">
                                        <input class="m-2 absent" type="radio" id="absent"
                                            data-id="{{ $dt->detail_id . $liste->stagiaire_id }}"
                                            name="attendance[{{ $dt->detail_id }}][{{ $liste->stagiaire_id }}]" value="0"
                                            required>
                                        Absent
                                    </label>
                                    {{-- </div> --}}
                                    {{-- @endif --}}
                                </div>
                                <div class="col-md-4">
                                    <div class="row" class="pointage"
                                        id="pointage_{{ $dt->detail_id . $liste->stagiaire_id }}">
                                        <div class="col-md-6 text-center m-0">
                                            <input type="text" class="m-0 pointage_entree"
                                                name="h_entree[]" placeholder="Heure entrée"
                                                style="width: 150px" onfocus="(this.type='time')" >
                                        </div>
                                        <div class="col-md-6 text-center m-0">
                                            <input type="text" class="m-0 pointage_sortie"
                                                name="h_sortie[]" placeholder="Heure sortie"
                                                style="width: 150px" onfocus="(this.type='time')">
                                        </div>
                                    </div>
                                </div>
                                </tr>
                            {{-- @endforeach
                        @endif --}}

                    @endforeach

                    <div align="center">
                        <button class="btn-success w-25" id="add_presence" data-id="{{ $dt->detail_id }}"
                            form="myform" name="add_attendance">Enregistrer</button>
                    </div>


                    {{-- @if ($message == '')
                            <button class="btn btn-success form-control" form="myform"  name="add_attendance">Ajouter</button>
                        @else
                            <a href="{{ route('modifier',[$datas[0]->detail_id]) }}"><button class="btn btn-primary form-control">Modifier</button></a>
                        @endif --}}
                </div>
                {{-- </form> --}}
            </div>
        </div>
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

    $(document).on('click', '#add_presence', function(e) {
        var id_detail = $(this).data('id');
        var groupe_id = @php echo $projet[0]->groupe_id; @endphp;
        var attendance = [];
        $("input[type='radio'][name^='attendance']:checked").map(function() {
            attendance.push($(this).val());
        });
        var pointage_entree = $("input[name='h_entree[]']").map(function() {
            return $(this).val();
        }).get();
        var pointage_sortie = $("input[name='h_sortie[]']").map(function() {
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
                sortie:pointage_sortie
            },
            dataType: "html",
            success: function(response) {
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
