@extends('./layouts/admin')
@inject('groupe', 'App\groupe')
@section('content')
<!-- CSS only -->
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
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

    .eval_stagiaire {
        background: rgba(235, 233, 233, 0.658);
        border-radius: 5px;
        align-items: center;
    }

    .eval_stagiaire:hover {
        color: #7635dc;
        background-color: #6373811f;
    }

    .eval_stagiaire:hover a:hover{
        color: #7635dc;
    }

    .eval_stagiaire .collapsed {
        color: #637381;
    }

    .changer_carret:focus{
        text-decoration: none;
    }


    .label_eval{
        border: 1px solid #babfc3;
        color: #babfc3;
    }
    .label_start{
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
    }
    .label_end{
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
    }
    .label_en_cours{
        border: 1px solid #F16529;
        background-color: #F16529;
        color: #fff;
    }
    .label_non_acquis{
        background-color: #e90721;
        border: 1px solid #e90721 !important;
        border-top-left-radius: 5px;
        border-bottom-left-radius: 5px;
        color: #fff;
    }
    .label_acquis{
        background-color: #00CDAC;
        border: 1px solid #00CDAC;
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        color: #fff;
    }
</style>
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

   
    function eval_stagiaire(stg,groupe_id){
        $.ajax({
            type: "GET",
            url: "{{ route('competence_stagiaire') }}",
            data: {
                stg: stg,
                groupe: groupe_id,
            },
            dataType: "html",
            success: function(response) {
                var data = JSON.parse(response);
                var detail = data['detail'];
                var globale = data['globale'];
                var note_avant = data['note_avant'];
                var module = data['module'];
                if(note_avant == 1){
                    $('#resultat_eval').html('');     

                    var html = '<div class="row p-2">';
                    for(let i = 0 ; i < detail.length ; i++){
                        html += '<div class="col-lg-5 text-start p-1"><span class="mt-2">'+detail[i].titre_competence+'</span></div>';
                        // html += '<div class="col-lg-2"><input class="p-0 m-1 py-1" style="height: 1.98rem; width: 4rem; justify-content:center;text-align:center;" type="number" min="1" max="10" name="note['+detail[i].competence_id+']" value="'+detail[i].note_apres+'" required></div>';
                        html += '<div class="col-lg-7">';
                            html += '<div class="d-flex flex-row">';
                                if(detail[i].status == 1){
                                    html += '<label class="label_eval label_start label_non_acquis ps-2 pe-2" for="">NON-ACQUIS</label>';
                                    html += '<label class="label_eval  ps-2 pe-2" for="">EN COURS</label>';
                                    html += '<label class="label_eval label_end  ps-2 pe-2" for="">ACQUIS</label>';
                                } else if(detail[i].status == 2){
                                    html += '<label class="label_eval label_start  ps-2 pe-2" for="">NON-ACQUIS</label>';
                                    html += '<label class="label_eval label_en_cours ps-2 pe-2" for="">EN COURS</label>';
                                    html += '<label class="label_eval label_end  ps-2 pe-2" for="">ACQUIS</label>';
                                } else if(detail[i].status == 3){
                                    html += '<label class="label_eval label_start  ps-2 pe-2" for="">NON-ACQUIS</label>';
                                    html += '<label class="label_eval  ps-2 pe-2" for="">EN COURS</label>';
                                    html += '<label class="label_eval label_end label_acquis ps-2 pe-2" for="">ACQUIS</label>';
                                }
                            html += '</div>';
                        html += '</div>';
                    }

                    html += '</div>';
                    
                    $('#resultat_eval').append(html);

                    if(globale[0].status == 2){
                        $('#eval_globale').append(module.nom_module+'&nbsp;<span style="color:#00CDAC;">VALIDÉ</span>');
                    }else if(globale[0].status == 1){
                        $('#eval_globale').append('<span style="color:#ff0000;">NON-VALIDÉ</span>');
                    }
                }else{
                    $('#resultat_eval').html('');

                    var html = '<div class="d-flex mt-3 titre_projet p-1 mb-1" id="liste_vide"><span class="text-center">Vous devez faire le pre evaluation.</span> </div>' ;
                    $('#choix_stagiaire').hide();
                    $('#validation_module').append(html); 
                }
                          
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function display_radar_stg(label,data_objectif,data_avant,data_apres){

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

    function radar(stg,groupe_id){
        var labels = '[';
        var data_objectif = '[';
        var data_avant = '[';
        var data_apres = '[';
        $.ajax({
            type: "GET",
            url: "{{ route('competence_stagiaire') }}",
            data: {
                stg: stg,
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
                display_radar_stg(labels,data_objectif,data_avant,data_apres);
            },
            error: function(error) {
                console.log(error)
            }
        });
    }
    </script>
<script src="https://fonts.googleapis.com/css?family=Lato"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    

    <nav class="d-flex justify-content-between mb-1 ms-5">
        <span class="titre_detail_session"><p style="font-size: 16px" id="eval_globale"></p></span>
    </nav>
    <div class="mt-2 p-1">
        <div class="row">
            <div class="col-lg-12 "></div>
        </div>
        <div class="row">
            <div class="col-lg-5 ms-2"> 
                <div id="resultat_eval" class="mt-3"></div>
                <script type="text/javascript">
                    var id_stg = @php echo $stagiaire; @endphp;
                    var groupe_id = @php echo $groupe_id; @endphp;
                    eval_stagiaire(id_stg,groupe_id);
                </script>
            </div>
            <div class="col-lg-6">
                <canvas class='mt-3' id="marksChart" width="500" height="300"></canvas>
                <script type="text/javascript">
                    var id_stg = @php echo $stagiaire; @endphp;
                    var groupe_id = @php echo $groupe_id; @endphp;
                    radar(id_stg,groupe_id);
                </script>
            </div>
        </div>
    </div>



@endsection