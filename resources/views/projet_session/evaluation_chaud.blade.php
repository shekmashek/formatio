<!-- CSS only -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
<script>
    function modifier_note(){
        document.getElementById('btn_note').style.backgroundColor = "white";
        document.getElementById('btn_note').style.border = "1px solid grey";
        document.getElementById('btn_radar').style.border = "none";
        document.getElementById('btn_radar').style.backgroundColor = "rgb(241, 241, 242)";
        document.getElementById('modifier_note').style.display = "block";
        document.getElementById('voir_radar').style.display = "none";
    }
    function voir_radar(){
        document.getElementById('btn_note').style.backgroundColor = "rgb(241, 241, 242)";
        document.getElementById('btn_radar').style.backgroundColor = "white";
        document.getElementById('btn_note').style.border = "none";
        document.getElementById('btn_radar').style.border = "1px solid grey";
        document.getElementById('voir_radar').style.display = "block";
        document.getElementById('modifier_note').style.display = "none";
    }

    var nombre = @php echo count($stagiaire); @endphp;
    // alert(nombre);
    </script>


    <style>
    .btn_note_radar{
        width: 100%;
        background-color: rgb(241, 241, 242);
        margin: 0 2px;
    }
    .btn:focus{
        outline: none;
        box-shadow: none;
    }

    .bouton_stg:hover{
        background-color: rgb(226, 226, 226);
    }
    .bouton_stg_eval:hover *{
        cursor: pointer;
    }

    .btn-outline-danger{
        border: 1px solid #00CDAC !important;
        outline: none !important;
        box-shadow: none !important;
        color: black;
    }

    .btn-outline-warning{
        border: 1px solid #00CDAC !important;
        outline: none !important;
        box-shadow: none !important;
        color: black;
    }

    .btn-outline-primary{
        border: 1px solid #00CDAC !important;
        outline: none !important;
        box-shadow: none !important;
        color: black;
    }

    .btn-check:checked+.btn-outline-warning{
        background-color: #F16529 !important;
        color: white !important;
        border-color: #F16529 !important;
    }

    .btn-check:hover+.btn-outline-warning{
        background-color: #F16529 !important;
        color: white !important;
        border-color: #F16529 !important;
    }

    .btn-check:checked+.btn-outline-danger{
        background-color: #e90721 !important;
        border-color: #e90721 !important;
    }

    .btn-check:hover+.btn-outline-danger{
        background-color: #e90721 !important;
        border-color: #e90721 !important;
    }

    .btn-check:checked+.btn-outline-primary{
        background-color: #00CDAC !important;
    }

    .btn-check:hover+.btn-outline-primary{
        background-color: #00CDAC !important;
    }

    .border_rad_1{
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }
    .border_rad_2{
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }

    .mb_top{
        margin-top: 4px;
    }

    </style>
    <nav class="d-flex justify-content-between mb-1 ">
        <span class="titre_detail_session"><strong style="font-size: 14px">Note des apprenants de la session</strong></span>
    </nav>
    <nav class="d-flex justify-content-around">
        @canany(['isFormateur'])
            <button id="btn_note" class="btn btn_note_radar" style="background-color: #fff; border: 1px solid grey" onclick="modifier_note()">Notes des stagiaires</button>
        @endcanany
        <button id="btn_radar" class="btn btn_note_radar" onclick="voir_radar()">Résultats</button>
        {{-- <button id="btn_formateur" class="btn btn_note_radar" onclick="evaluation_formateur()">Evaluation des formateurs</button> --}}
    </nav>
    @canany(['isFormateur'])
    <div id="modifier_note" style="display: block">
        @if (count($stagiaire) > 0)
            <form action="{{ route('insert_evaluation_stagiaire_apres') }}" method="POST">
                @csrf
                <input type="hidden" name="module" value={{ $module_session->module_id }}>
                <input type="hidden" name="groupe" value={{ $projet[0]->groupe_id }}>
                <div class="row d-flex text-center mt-2">
                    <div class="col-lg-2">
                        @foreach ($stagiaire as $stg)
                            <div class=" row bouton_stg pt-1 pb-1 pe-1">
                                <div class="col-lg-10 d-flex justify-content-arround mt-1 bouton_stg_eval">
                                    <input class="form-check-input stagiaire ms-1 mt-1 me-1" type="radio" value="{{ $stg->stagiaire_id }}" name="stagiaire" data-id="{{ $stg->stagiaire_id }}" id="stagiaire_eval_{{ $stg->stagiaire_id }}" required>
                                    <label class="form-check-label" for="stagiaire_eval_{{ $stg->stagiaire_id }}">
                                        {{ $stg->nom_stagiaire.' '.$stg->prenom_stagiaire }}
                                    </label>
                                </div>
                                <div class="col-lg-2">
                                    <i class='bx bx-circle' style="font-size: 1.5rem; margin-top :.29rem; color:
                                    @php
                                        echo $groupe->statut_evaluation_apres($projet[0]->groupe_id,$stg->stagiaire_id);
                                    @endphp
                                    "></i>
                                </div>
                                <br>
                            </div>
                        @endforeach
                    </div>
                    {{-- 1.563rem --}}
                    <div class="col-lg-9 ms-5" id="validation_module">
                        <div class="row p-2">
                            @foreach ($competences as $comp)
                                <div class="col-lg-4 text-start p-1"><span class="mt-2">{{ $comp->titre_competence }}</span></div>
                                <div class="col-lg-2"><input class="p-0 m-1 py-1" style="height: 1.98rem; width: 4rem; justify-content:center; text-align:right;" type="number" min="1" max="10" placeholder="  ../10" name="note[{{ $comp->id }}]" required></div>
                                <div class="col-lg-6 d-flex justify-content-arround " >
                                    <div class="mb_top">
                                        <input type="radio" class="btn-check" name="status[{{ $comp->id }}]" id="danger-outlined_{{ $comp->id }}" data-id="{{ $comp->id }}" autocomplete="off" value="1" required>
                                        <label class=" mb-1 button_test border_rad_1 py-1 px-2 btn-outline-danger" role="button" for="danger-outlined_{{ $comp->id }}">NON-ACQUIS</label>
                                    </div>
                                    <div class="mb_top">
                                        <input type="radio" class="btn-check" name="status[{{ $comp->id }}]" id="warning-outlined_{{ $comp->id }}" data-id="{{ $comp->id }}" autocomplete="off" value="2" required>
                                        <label class=" button_test mb-1 px-2 py-1 btn-outline-warning" role="button" for="warning-outlined_{{ $comp->id }}">EN COURS</label>
                                    </div>
                                    <div class="mb_top">
                                        <input type="radio" class="btn-check" name="status[{{ $comp->id }}]" id="success-outlined_{{ $comp->id }}" data-id="{{ $comp->id }}" autocomplete="off" value="3" required>
                                        <label class="button_test mb-1 px-2 py-1 pt_top border_rad_2 btn-outline-primary" role="button" for="success-outlined_{{ $comp->id }}">ACQUIS</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row mt-2 p-2">
                            <div class="col-lg-4 py-1">
                                <span class="me-4 mt-1">Validation globale pour le module :</span>
                            </div>
                            <div class="col-lg-8 d-flex justify-content-arround">
                                <div class="">
                                    <input type="radio" class="btn-check" name="note_globale" id="danger-outlined_nv"  autocomplete="off" value="1" required>
                                    <label class=" mb-1 button_test border_rad_1 py-1 px-2 btn-outline-danger" role="button" for="danger-outlined_nv">NON-VALIDÉ</label>
                                </div>
                                <div class="">
                                    <input type="radio" class="btn-check" name="note_globale" id="danger-outlined_v"  autocomplete="off" value="2" required>
                                    <label class="button_test mb-1 px-2 py-1 pt_top border_rad_2 btn-outline-primary" role="button" for="danger-outlined_v">VALIDÉ</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-arround">
                    <div class="d-grid gap-2 col-6 mx-auto mt-3">
                        <button class="btn inserer_emargement" id="boutton_save_eval" type="submit">Sauvegarder</button>
                    </div>
                </div>
            </form>
        @else
        <div class="d-flex mt-3 titre_projet p-1 mb-1" id="liste_vide">
            <span class="text-center">Aucun apprenant inscrit</span>
        </div>
        @endif
        
    </div>
    @endcanany
    @canany(['isFormateur'])
        <div id="voir_radar" style="display: none">
    @endcanany
    @canany(['isCFP','isReferent'])
        <div id="voir_radar">
    @endcanany
        <div class="row mt-2">
            <div class="col-md-4">
                Choisissez votre stagiaire pour voir le résultat<br>
                <select class="form-select" id="stagiaire_radar"  aria-label="Default select example">
                    <option hidden>Choisissez un stagiaire</option>
                    @foreach ($stagiaire as $stg_r)
                        <option  data-stg_id="{{ $stg_r->stagiaire_id }}" value="{{ $stg_r->stagiaire_id }}">{{ $stg_r->nom_stagiaire.' '.$stg_r->prenom_stagiaire }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-8"><canvas id="marksChart" width="500" height="300"></canvas></div>
        </div>
    </div>
    {{-- <div id="evaluation_formateurs" style="display: none">
        Evaluation des formateurs
    </div> --}}



<script src="https://fonts.googleapis.com/css?family=Lato"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript">

    $('.stagiaire').on('click',function(e){
        var stg_id = $("input[type='radio'][name='stagiaire']:checked").val();
        var groupe_id = @php echo $projet[0]->groupe_id; @endphp;
        $.ajax({
            type: "GET",
            url: "{{ route('competence_stagiaire') }}",
            data: {
                stg: stg_id,
                groupe: groupe_id,
            },
            dataType: "html",
            success: function(response) {
                var data = JSON.parse(response);
                var detail = data['detail'];
                var globale = data['globale'];
                var note_avant = data['note_avant'];
                if(note_avant == 1){
                    $('#validation_module').html('');     

                    var html = '<div class="row p-2">';
                    for(let i = 0 ; i < detail.length ; i++){
                        html += '<div class="col-lg-4 text-start p-1"><span class="mt-2">'+detail[i].titre_competence+'</span></div>';
                        html += '<div class="col-lg-2"><input class="p-0 m-1 py-1" style="height: 1.98rem; width: 4rem; justify-content:center;text-align:center;" type="number" min="1" max="10" name="note['+detail[i].competence_id+']" value="'+detail[i].note_apres+'" required></div>';
                        html += '<div class="col-lg-6 d-flex justify-content-arround " >';

                            html += '<div class="mb_top">';
                            html += '<input type="radio" class="btn-check" name="status['+detail[i].competence_id+']" id="danger-outlined_'+detail[i].competence_id+'" data-id="'+detail[i].competence_id+'" autocomplete="off" value="1" required '+detail[i].non_acquis+'>';
                            html += '<label class=" mb-1 button_test border_rad_1 py-1 px-2 btn-outline-danger" role="button" for="danger-outlined_'+detail[i].competence_id+'">NON-ACQUIS</label>';
                            html += '</div>';

                            html += '<div class="mb_top">';
                            html += '<input type="radio" class="btn-check" name="status['+detail[i].competence_id+']" id="warning-outlined_'+detail[i].competence_id+'" data-id="'+detail[i].competence_id+'" autocomplete="off" value="2" required '+detail[i].en_cours+'>';
                            html += '<label class=" button_test mb-1 px-2 py-1 btn-outline-warning" role="button" for="warning-outlined_'+detail[i].competence_id+'">EN COURS</label>'
                            html += '</div>';

                            html += '<div class="mb_top">';
                            html += '<input type="radio" class="btn-check" name="status['+detail[i].competence_id+']" id="success-outlined_'+detail[i].competence_id+'" data-id="'+detail[i].competence_id+'" autocomplete="off" value="3" required '+detail[i].acquis+'>';
                            html += '<label class="button_test mb-1 px-2 py-1 pt_top border_rad_2 btn-outline-primary" role="button" for="success-outlined_'+detail[i].competence_id+'">ACQUIS</label>';
                            html += '</div>';

                        html += '</div>';
                    }

                    html += '</div>';

                    html += '<div class="row mt-2 p-2">';
                        html += '<div class="col-lg-4 py-1">';
                            html += '<span class="me-4 mt-1">Validation globale pour le module :</span>';
                        html += '</div>';
                        html += '<div class="col-lg-8 d-flex justify-content-arround">';
                            html += '<div class="">';
                                html += '<input type="radio" class="btn-check" name="note_globale" id="danger-outlined_nv" autocomplete="off" value="1" required '+globale[0].non_valide+'>';
                                html += '<label class=" mb-1 button_test border_rad_1 py-1 px-2 btn-outline-danger" role="button" for="danger-outlined_nv">NON-VALIDÉ</label>';
                            html += '</div>';
                            html += '<div class="">';
                                html += '<input type="radio" class="btn-check" name="note_globale" id="danger-outlined_v"  autocomplete="off" value="2" required '+globale[0].valide+'>';
                                html += '<label class="button_test mb-1 px-2 py-1 pt_top border_rad_2 btn-outline-primary" role="button" for="danger-outlined_v">VALIDÉ</label>';
                            html += '</div>';
                        html += '</div>';
                    html += '</div>';

                    $('#validation_module').append(html); 
                }else{
                    $('#validation_module').html('');

                    var html = '<div class="d-flex mt-3 titre_projet p-1 mb-1" id="liste_vide"><span class="text-center">Vous devez faire le pre evaluation.</span> </div>' ;
                    $('#boutton_save_eval').hide();
                    $('#validation_module').append(html); 
                }
                          
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    
    // $('.inserer_emargement').on('click',function(e){
    //     $("input[type='radio'][name^='status']:checked").map(function() {
    //         // attendance.push($(this).val());
    //         alert($(this).val());
    //     });

    // });
    
    // var marksCanvas = document.getElementById("marksChart");

    // var marksData = {
    // labels: ["English", "Maths", "Physics", "Chemistry", "Biology", "History"],
    // datasets: [{
    //     label: "Student A",
    //     backgroundColor: "rgba(0,0,250,0.1)",
    //     pointBackgroundColor: "blue",
    //     borderColor: "rgba(0,0,250,0.6)",
    //     data: [53, 55, 57, 12, 60, 50]
    // },
    // {
    //     label: "Student B",
    //     backgroundColor: "rgba(250,0,0,0.1)",
    //     pointBackgroundColor: "red",
    //     borderColor: "rgba(250,0,0,0.6)",
    //     data: [65, 75, 70, 80, 60, 80]
    // },
    // {
    //     label: "Student C",
    //     backgroundColor: "rgba(0,250,0,0.1)",
    //     pointBackgroundColor: "green",
    //     borderColor: "rgba(0,250,0,0.6)",
    //     data: [23, 42, 46, 86, 100, 20]
    // }]
    // };

    // var radarChart = new Chart(marksCanvas, {
    //     type: 'radar',
    //     data: marksData
    // });

    // var chartOptions = {
    //     scale: {
    //         ticks: {
    //         beginAtZero: true,
    //         min: 0,
    //         max: 100,
    //         stepSize: 20
    //         },
    //         pointLabels: {
    //             fontSize: 18
    //         }
    //     },
    //     legend: {
    //         position: 'left'
    //     }
    // };

    function display_radar(label,data_objectif,data_avant,data_apres){

        var marksCanvas = document.getElementById("marksChart");

        var marksData = {
        labels: JSON.parse(label),
        datasets: [{
            label: "Objectif à atteindre",
            backgroundColor: "rgba(0,0,250,0.1)",
            borderColor: "rgba(0,0,250,0.6)",
            data: JSON.parse(data_objectif)
        },
        {
            label: "Avant formation",
            backgroundColor: "rgba(250,0,0,0.1)",
            borderColor: "rgba(250,0,0,0.6)",
            data: JSON.parse(data_avant)
        },
        {
            label: "Après formation",
            backgroundColor: "rgba(0,250,0,0.1)",
            borderColor: "rgba(0,250,0,0.6)",
            data: JSON.parse(data_apres)
        }]
        };
        var radarChart = new Chart(marksCanvas, {
            type: 'radar',
            data: marksData
        });

        var chartOptions = {
            scale: {
                ticks: {
                    beginAtZero: true,
                    min: 0,
                    max: 10,
                    stepSize: 1
                },
                pointLabels: {
                    fontSize: 18
                }
            },
            legend: {
                position: 'left'
            }
        };
    }

    $("#stagiaire_radar").on('change', function(e) {
        // var id = e.target.id;
        var id_stg = $("#stagiaire_radar option:selected").val();
        var groupe_id = @php echo $projet[0]->groupe_id; @endphp;

        var labels = '[';
        var data_objectif = '[';
        var data_avant = '[';
        var data_apres = '[';
        $.ajax({
            type: "GET",
            url: "{{ route('competence_stagiaire') }}",
            data: {
                stg: id_stg,
                groupe: groupe_id
            },
            dataType: "html",
            success: function(response) {
                var data = JSON.parse(response);
                var userData = data['detail'];
                for (var i = 0; i < userData.length; i++) {
                    if(i == userData.length - 1){
                        labels += '"'+userData[i].titre_competence+'"]';
                        data_objectif += userData[i].objectif+']';
                        data_avant += userData[i].note_avant+']';
                        data_apres += userData[i].note_apres+']';
                    }else{
                        labels += '"'+userData[i].titre_competence+'",';
                        data_objectif += userData[i].objectif+',';
                        data_avant += userData[i].note_avant+',';
                        data_apres += userData[i].note_apres+',';
                    }
                }
                display_radar(labels,data_objectif,data_avant,data_apres);
            },
            error: function(error) {
                console.log(error)
            }
        });
    });
</script>


