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
                    @foreach ($stagiaire as $liste)
                        <div class="col-md-1 text-center">{{ $liste->matricule }}</div>
                        <div class="col-md-2 text-center">{{ $liste->nom_stagiaire }}</div>
                        <div class="col-md-2 text-center">{{ $liste->prenom_stagiaire }}</div>
                        {{-- <div class="col-md-1">
                        <input type="submit" class="btn btn-primary pointage" id = "{{$liste->stagiaire_id}}" value = "Pointage">
                        </div class="col-md-1"> --}}

                        <div class="col-md-3 text-center ">
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
                                    <input type="text" class="m-0"
                                        name="h_entree[{{ $liste->stagiaire_id }}]" placeholder="Heure entrée"
                                        style="width: 150px" onfocus="(this.type='time')">
                                </div>
                                <div class="col-md-6 text-center m-0">
                                    <input type="text" class="m-0"
                                        name="h_sortie[{{ $liste->stagiaire_id }}]" placeholder="Heure sortie"
                                        style="width: 150px" onfocus="(this.type='time')">
                                </div>
                            </div>
                        </div>
                        </tr>
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
        });
    });

    $(document).on('click', '#add_presence', function(e) {
        var id_detail = $(this).data('id');
        var attendance = [];
        $("input[type='radio'][name^='attendance']:checked").map(function() {
            attendance.push($(this).val());
        });
        var groupe_id = @php echo $projet[0]->groupe_id; @endphp;
        alert(attendance[0]);
        $.ajax({
            type: "GET",
            url: "{{route('insert_presence_detail')}}",
            data:{
                presence:attendance,
                groupe:groupe_id,
                detail_id:id_detail
            },
            dataType: "html",
            success: function(response) {
                alert('eto');
                var userData = JSON.parse(response);
                // html = '';
                alert(userData);
                // for (let i = 0; i < userData.length; i++) {
                //     html += '<div class="row" id="inputFormRow_frais">';
                //     html += '<div class="col-md-3">';
                //     html += '<label class="w-100 pe-2">'+userData[i].description+'</label>';
                //     html += '</div>';
                //     html += '<div class="col-md-9">';
                //     html += '<ul>';
                //     html +='<li><label class="text-end test">'+userData[i].montant+'</label></li>';
                //     html += '</ul>';
                //     html += '</div>';
                //     html += '</div>';
                // }

                // $('resultat_frais').append(html);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
</script>
