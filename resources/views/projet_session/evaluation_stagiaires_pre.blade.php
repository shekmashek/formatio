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
    </style>
    <nav class="d-flex justify-content-between mb-1 ">
        <span class="titre_detail_session"><strong style="font-size: 14px">Note des apprenants de la session</strong></span>
    </nav>
    <nav class="d-flex justify-content-around">
        @canany(['isFormateur','isFormateurInterne'])
            <button id="btn_note" class="btn btn_note_radar" style="background-color: #fff; border: 1px solid grey" onclick="modifier_note()">Notes des stagiaires</button>
        @endcanany
        <button id="btn_radar" class="btn btn_note_radar" onclick="voir_radar()">Résultats</button>
        {{-- <button id="btn_formateur" class="btn btn_note_radar" onclick="evaluation_formateur()">Evaluation des formateurs</button> --}}
    </nav>
    @canany(['isFormateur','isFormateurInterne'])
    <div id="modifier_note" style="display: block">
        <div class="row d-flex text-center mt-2">
            <form action="{{ route('insert_evaluation_stagiaire_apres') }}" method="POST">
                @csrf
                <input type="hidden" name="groupe" value="{{ $projet[0]->groupe_id }}">
                <input type="hidden" name="module" value="{{ $projet[0]->module_id }}">
                @if (count($evaluation_stg)>0)
                    <div class="col-md-12 d-flex justify-content-around">
                        <table class="table table-borderless" >
                            <thead style="border-bottom: 1px solid black; line-height: 20px">
                            <tr>
                                <th>Stagiaire(s)</th>
                                @foreach ($competences as $cp)
                                    <th align="center">{{ $cp->titre_competence }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody style="border-top: 0">
                                @foreach ($stagiaire as $stg)
                                    <tr>
                                        <td class="text-start"><input type="hidden" value="{{ $stg->stagiaire_id }}" name="stagiaire[{{ $stg->stagiaire_id }}]">
                                            @if ($stg->photos == null)
                                                <span class="me-2">{{ $stg->sans_photos }}</span>
                                            @else
                                                <img src="{{ asset('images/stagiaires/'.$stg->photos) }}" alt="" height="30px" width="30px" style="border-radius: 50%;">{{ $stg->nom_stagiaire.' '.$stg->prenom_stagiaire }} </div>
                                            @endif
                                            
                                        </td>
                                        @for ($i = 0; $i < count($competences); $i++)
                                            @foreach ($evaluation_stg as $e_stg)
                                                @if ($e_stg->stagiaire_id == $stg->stagiaire_id && $e_stg->competence_id == $competences[$i]->id)
                                                    <td class="text-center"><input class="p-0 m-0" value="{{ $e_stg->note_apres }}" style="height: 1.563rem; width: 9rem;" type="number" min="1" max="10" placeholder="notes" name="note[{{ $stg->stagiaire_id }}][{{ $competences[$i]->id }}]" required></td>
                                                @endif
                                            @endforeach
                                        @endfor
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button class="btn inserer_emargement" type="submit">Sauvegarder</button>
                    </div>
                @else
                    <div class="col-md-12 d-flex justify-content-around">
                        <table class="table table-borderless" >
                            <thead style="border-bottom: 1px solid black; line-height: 20px">
                            <tr>
                                {{-- <th>Stagiaire(s)</th> --}}
                                @foreach ($competences as $cp)
                                    <th align="center">{{ $cp->titre_competence }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody style="border-top: 0">
                                @foreach ($stagiaire as $stg)
                                    <tr>
                                        <td class="text-start"><input type="hidden" value="{{ $stg->stagiaire_id }}" name="stagiaire[{{ $stg->stagiaire_id }}]">
                                            @if ($stg->photos == null)
                                                <span class="me-2">{{ $stg->sans_photos }}</span>
                                            @else
                                                <img src="{{ asset('images/stagiaires/'.$stg->photos) }}" alt="" height="30px" width="30px" style="border-radius: 50%;">{{ $stg->nom_stagiaire.' '.$stg->prenom_stagiaire }} </div>
                                            @endif
                                            
                                        </td>
                                        @for ($i = 0; $i < count($competences); $i++)
                                            @foreach ($evaluation_stg as $e_stg)
                                                @if ($e_stg->stagiaire_id == $stg->stagiaire_id && $e_stg->competence_id == $competences[$i]->id)
                                                    <td class="text-center"><input class="p-0 m-0" value="{{ $e_stg->note_apres }}" style="height: 1.563rem; width: 9rem;" type="number" min="1" max="10" placeholder="notes" name="note[{{ $stg->stagiaire_id }}][{{ $competences[$i]->id }}]" required></td>
                                                @endif
                                            @endforeach
                                        @endfor
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex mt-3 titre_projet p-1 mb-1" id="liste_vide">
                        <span class="text-center">Aucun apprenant inscrit</span>
                    </div>
                @endif
            </form>
        </div>
    </div>
    @endcanany
    @canany(['isFormateur','isFormateurInterne'])
        <div id="voir_radar" style="display: none">
    @endcanany
    @canany(['isCFP','isReferent'])
        <div id="voir_radar">
    @endcanany
        <div class="row mt-2">
            <div class="col-md-5">
                <div>
                     Choisissez votre stagiaire pour voir le résultat<br>
                    <select class="form-select" id="stagiaire_radar"  aria-label="Default select example">
                        <option hidden>Choisissez un stagiaire</option>
                        @foreach ($stagiaire as $stg_r)
                            <option  data-stg_id="{{ $stg_r->stagiaire_id }}" value="{{ $stg_r->stagiaire_id }}">{{ $stg_r->nom_stagiaire.' '.$stg_r->prenom_stagiaire }}</option>
                        @endforeach
                    </select>
                </div>
                <div>

                </div>
            </div>
            <div class="col-md-7"><canvas id="marksChart" width="500" height="300"></canvas></div>
        </div>
    </div>
    {{-- <div id="evaluation_formateurs" style="display: none">
        Evaluation des formateurs
    </div> --}}



<script src="https://fonts.googleapis.com/css?family=Lato"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script type="text/javascript">
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
                var userData = JSON.parse(response);
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


