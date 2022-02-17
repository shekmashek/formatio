<div class="row d-flex text-center">
    <div class="d-grid gap-2 col-6 mx-auto">
        <Label style="font: 14px">Pré evaluation</Label>
    </div>
    @if ($evaluation_avant == 0 || $evaluation_avant == null)
        <form action="{{ route('insert_evaluation_stagiaire') }}" method="POST">
        @csrf
        <input type="hidden" name="groupe" value="{{ $projet[0]->groupe_id }}">
        <input type="hidden" name="module" value="{{ $projet[0]->module_id }}">
        <div class="col-md-12 d-flex justify-content-around">
            <table class="table" >
                <thead>
                <tr style="border: 0">
                    <th>Stagiaire(s)</th>
                    @foreach ($competences as $cp)
                        <th align="center">{{ $cp->titre_competence }}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                    @foreach ($stagiaire as $stg)
                        <tr>
                            <td class="text-start"><input type="hidden" value="{{ $stg->stagiaire_id }}" name="stagiaire[{{ $stg->stagiaire_id }}]">{{ $stg->nom_stagiaire.' '.$stg->prenom_stagiaire }}</td>
                            @for ($i = 0; $i < count($competences); $i++)
                                <td class="text-center"><input class="p-0 m-0" style="height: 1.563rem; width: 9rem;" type="number" min="1" max="10" placeholder="notes" name="note[{{ $stg->stagiaire_id }}][{{ $competences[$i]->id }}]" required></td>
                            @endfor
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-success" type="submit">Sauvegarder</button>
        </div>
    </form>
    @else
        <form action="{{ route('modifier_evaluation_stagiaire') }}" method="POST">
            @csrf
            <input type="hidden" name="groupe" value="{{ $projet[0]->groupe_id }}">
            <input type="hidden" name="module" value="{{ $projet[0]->module_id }}">
            <div class="col-md-12 d-flex justify-content-around">
                <table class="table" >
                    <thead>
                    <tr style="border: 0">
                        <th>Stagiaire(s)</th>
                        @foreach ($competences as $cp)
                            <th align="center">{{ $cp->titre_competence }}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($stagiaire as $stg)
                            <tr>
                                <td class="text-start"><input type="hidden" value="{{ $stg->stagiaire_id }}" name="stagiaire[{{ $stg->stagiaire_id }}]">{{ $stg->nom_stagiaire.' '.$stg->prenom_stagiaire }}</td>
                                @for ($i = 0; $i < count($competences); $i++)
                                    @foreach ($evaluation_stg as $e_stg)
                                        @if ($e_stg->stagiaire_id == $stg->stagiaire_id && $e_stg->competence_id == $competences[$i]->id)
                                            <td class="text-center"><input class="p-0 m-0" value="{{ $e_stg->note_avant }}"  style="height: 1.563rem; width: 9rem;" type="number" min="1" max="10" placeholder="notes" name="note[{{ $stg->stagiaire_id }}][{{ $competences[$i]->id }}]" required></td>
                                        @endif
                                    @endforeach
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-success" type="submit">Sauvegarder</button>
            </div>
        </form>
    @endif
</div>

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