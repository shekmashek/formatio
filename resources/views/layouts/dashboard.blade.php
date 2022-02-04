@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
        .nav-tabs .nav-link{
            background-image:linear-gradient(60deg, #AA076B 40%, #61045F)
            /* color: white; */
        }
        .navigation{
            background-color: #f8f9fa;
            /* background-image:linear-gradient(100deg, #AA076B, #61045F) */
        }

        .navigation:hover{
            background-color: #f8f9fa;
            /* background-color: #801D68; */
        }

        .system_{
            text-align: left;
            border: none;
            border-bottom: 1px solid #801D68;
        }
        .system_num{
            text-align: right;
            color: #801d68;
            font-size: 20px;
            border-radius: 10px;
            float: right;
            position: relative;
            bottom: .5rem;
        }

        .system_numero{
            text-align: right;
            color: white;
            background-color: #9d207d;
            border: none;
            border-radius: 5px;
            float: right;
            padding-left: 5px;
            padding-right: 5px
        }
    </style>

    <div class="p-0 m-4">
        <ul class="nav nav-tabs d-flex flex-row navigation justify-content-end " id="myTab" style="font-size: 13px;">
            <li class="nav-item">
                <a href="#TBFinancière" class="nav-link active m-1" data-bs-toggle="tab" style="color: white"> <i class="fad fa-sliders-v"></i>&nbsp; TDB système</a>
            </li>
            <li class="nav-item">
                <a href="#TBStatistique" class="nav-link m-1" data-bs-toggle="tab" style="color: white"> <i class="far fa-money-check"></i>&nbsp; TDB financier</a>
            </li>
            <li class="nav-item">
                <a href="#TBQualité" class="nav-link m-1" data-bs-toggle="tab" style="color: white"> <i class="fad fa-book-alt"></i>&nbsp; TDB Qualité</a>
            </li>
        </ul><br>
        <div class="tab-content ">
            <div class="tab-pane fade show active" id="TBFinancière">
                <div class="container-fluid" style="font-size: 13px;">
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <div class="shadow-sm p-3 mb-5 bg-body rounded" style="color: #801D68"> <b><i class="fad fa-users "></i> &nbsp; Collaborateur</b>
                                <p class="p-0 m-3 system_ pb-1">Formateurs<span class="system_num"><i style="color: red;" class='bx bxs-user-x'></i></span></p>
                                {{-- <p class="m-3 system_">Entreprise<span class="system_num"><i class='bx bxs-check-shield'></i></span></p>
                                <p class="m-3 system_">Réferents<span class="system_num"><i class='bx bxs-user-check' ></i></span></p> ireto ny icone--}}
                                <p class="m-3 system_ pb-1">Entreprise<span class="system_numero">70</span></p>
                                <p class="m-3 system_ pb-1">Réferents<span class="system_numero">55</span></p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="shadow-sm p-3 mb-5 bg-body rounded" style="color: #801D68"><b> <i class="far fa-book-spells"></i> &nbsp; Catalogue </b>
                                <p class="p-0 m-3 system_ pb-1">Publié<span class="system_numero">5</span></p>
                                <p class="m-3 system_">EN cours<span class="system_num"><i style="color: rgb(2, 162, 21)" class='bx bxs-check-shield'></i></span></p>
                                <p class="m-3 system_ pb-1">A venir<span class="system_numero">70</span></p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="shadow-sm p-3 mb-5 bg-body rounded" style="color: #801D68"><b> <i class="fad fa-address-card"></i>&nbsp; Facture </b>
                                <p class="p-0 m-3 system_ pb-1">Payé<span class="system_numero">3</span></p>
                                <p class="m-3 system_ pb-1">Non échu<span class="system_numero">7</span></p>
                                <p class="m-3 system_ pb-1">Echu non payé<span class="system_numero">0</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 2 --}}
                <div class="container-fluid" style="font-size: 13px;">
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <div class="shadow-sm p-3 mb-5 bg-body rounded" style="color: #801D68"><b> <i class="fas fa-tasks"></i> &nbsp; Session Inter entreprise </b>
                                <p class="p-0 m-3 system_ pb-1">Comlété<span class="system_numero">3</span></p>
                                <p class="m-3 system_ pb-1">En cours<span class="system_numero">7</span></p>
                                <p class="m-3 system_ pb-1">A venir<span class="system_numero">0</span></p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="shadow-sm p-3 mb-5 bg-body rounded" style="color: #801D68"><b> <i class="fas fa-tasks"></i>&nbsp; Session Intra enreprise </b>
                                <p class="p-0 m-3 system_ pb-1">Comlété<span class="system_numero">3</span></p>
                                <p class="m-3 system_ pb-1">En cours<span class="system_numero">0</span></p>
                                <p class="m-3 system_ pb-1">A venir<span class="system_numero">10</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="tab-pane fade" id="TBStatistique">
            <div class="container-fluid">
                <div class="row mt-2">
                    <div class="col-lg-4">
                        <div class="form-control">
                            <p class="text-center"><b style="font-size: 17px;">TDB financier</b></p>
                            <p class="p-0 m-0 " style="font-size: 14px; font-weight: bold;">C.A actuel:
                                @php
                                    foreach ($CA_actuel as $total) {
                                        $total = $total->total_ttc;
                                        echo $total . ' ';
                                    }
                                @endphp Ar TTC</p>

                            <p class="p-1 m-0" style="font-size: 13px;">C.A précedent:
                                @php
                                    foreach ($CA_precedent as $totals) {
                                        $totals = $totals->total_ttc;
                                        echo $totals . ' ';
                                    }
                                @endphp Ar TTC</p>
                            <hr>
                            <div id="chart_div"  style="width: 200px; height: 200px;"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-control">
                            <p class="text-center"><b style="font-size: 17px;">CA par module</b></p>
                            <p class="p-0 m-0 " style="font-size: 15px; font-weight: bold;">Top 10 modules</p>
                            <hr>
                            <div id="barchart_material"  style="width: 200px; height: 200px;"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-control">
                            <p class="text-center"><b style="font-size: 17px;">CA par client</b></p>
                            <p class="p-0 m-0 " style="font-size: 15px; font-weight: bold;">Top 10 clients</p>
                            <hr>
                            <div id="barchart_material_2"  style="width: 200px; height: 200px;"></div>
                        </div>
                    </div>
                </div>

            </div>
            {{-- fin --}}

        </div>


        <div class="tab-pane fade" id="TBQualité">
            <div class="container-fluid">
                <div class="row mt-2">
                    <div class="col-lg-4">
                        <div class="form-control">
                            <p class="text-center"><b style="font-size: 17px;">Tableau de bord financier</b></p>
                            <p class="p-0 m-0 " style="font-size: 15px; font-weight: bold;">C.A actuel:
                                {{-- @php
                                    foreach ($CA_actuel as $total) {
                                        $total = $total->total;
                                        echo $total . ' ';
                                    }
                                @endphp --}}Ar TTC</p>

                            <p class="p-1 m-0" style="font-size: 13px;">C.A précedent:
                                {{-- @php
                                    foreach ($CA_precedent as $totals) {
                                        $totals = $totals->total;
                                        echo $totals . ' ';
                                    }
                                @endphp  --}}
                                Ar TTC</p>
                            <hr>
                            <div id="columnchart_material_12" style="width: 200px; height: 200px;"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-control">
                            <p class="text-center"><b style="font-size: 17px;">Chiffre d'affaires par module</b></p>
                            <p class="p-0 m-0 " style="font-size: 15px; font-weight: bold;">Top 10 modules</p>
                            <hr>
                            <div id="barchart_material"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-control">
                            <p class="text-center"><b style="font-size: 17px;">Chiffre d'affaires par client</b></p>
                            <p class="p-0 m-0 " style="font-size: 15px; font-weight: bold;">Top 10 clients</p>
                            <hr>
                            <div id="barchart_material_2"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
      </div>
    </div>


    {{-- <div class="row mt-2">
    <div class="col-lg-4">
        <div class="form-control">
            <h5 class="text-center"><b>TDB finance</b></h5>
            <p class="p-0 m-0 " style="font-size: 15px; font-weight: bold;">C.A actuel:
            @php
              foreach($CA_actuel as $total) {
                $total =  $total->total;
                echo $total." ";
              }
            @endphp Ar TTC</p>

            <p class="p-1 m-0" style="font-size: 13px;">C.A précedent:
              @php
              foreach($CA_precedent as $totals) {
                $totals =  $totals->total;
                echo $totals." ";
              }
            @endphp Ar TTC</p><hr>
            <div id="chart_div"></div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-control">
          <h5 class="text-center"><b>CA par module</b></h5>
          <p class="p-0 m-0 " style="font-size: 15px; font-weight: bold;">Top 10 module</p><hr>
          <div id="barchart_material"></div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="form-control">
          <h5 class="text-center"><b>CA par Client</b></h5>
          <p class="p-0 m-0 " style="font-size: 15px; font-weight: bold;">Top 10 client</p><hr>
          <div id="barchart_material_2"></div>
        </div>
    </div>
</div> --}}


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("myTab a:last").tab("show");
        });

    /*    var name = [];
                    var marks = [];

                    // for (var i in data) {
                        name.push("Noam");
                        marks.push("blue");
                    // }

                    var chartdata = {
                        labels: name,
                        datasets: [
                            {
                                label: 'Student Marks',
                                backgroundColor: '#49e2ff',
                                borderColor: '#46d5f1',
                                hoverBackgroundColor: '#CCCCCC',
                                hoverBorderColor: '#666666',
                                data: marks
                            }
                        ]
                    };

                    var graphTarget = $("#chart_div");

                    var barGraph = new Chart(graphTarget, {
                        type: 'bar',
                        data: chartdata
                    });
                });
*/
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {

            var button = document.getElementById('change-chart');
            var chartDiv = document.getElementById('chart_div');

            var data = google.visualization.arrayToDataTable([
                ['mois', 'prix', 'annee'],
                @php
                foreach ($GChart as $product) {
                    $val = "['" . $product->mois . "', " . $product->net_ttc . ', ' . $product->annee . ']';
                    echo $val . ',';
                }
                @endphp
            ]);

            var materialOptions = {
                width: 350,
                chart: {
                    title: '',
                    subtitle: ''
                },
                series: {
                    0: {
                        axis: 'Actuel'
                    },
                    1: {
                        axis: 'précédent'
                    }
                },
                axes: {
                    y: {
                        distance: {
                            label: 'C.A'
                        },
                        brightness: {
                            side: 'right',
                            label: ''
                        }
                    }
                }
            };

            var classicOptions = {
                width: 250,
                series: {
                    0: {
                        targetAxisIndex: 0
                    },
                    1: {
                        targetAxisIndex: 1
                    }
                },
                title: '',
                vAxes: {
                    // Adds titles to each axis.
                    0: {
                        title: ''
                    },
                    1: {
                        title: ' '
                    }
                }
            };

            function drawMaterialChart() {
                var materialChart = new google.charts.Bar(chartDiv);
                materialChart.draw(data, google.charts.Bar.convertOptions(materialOptions));
                button.innerText = 'Change to Classic';
                button.onclick = drawClassicChart;
            }

            function drawClassicChart() {
                var classicChart = new google.visualization.ColumnChart(chartDiv);
                classicChart.draw(data, classicOptions);
                button.innerText = 'Change to Material';
                button.onclick = drawMaterialChart;
            }

            drawMaterialChart();
        };
    </script>

    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Sales', 'Expenses', 'Profit'],
                ['2014', 1000, 400, 200],
                ['2015', 1170, 460, 250],
                ['2016', 660, 1120, 300],
                ['2017', 1030, 540, 350]
            ]);

            var options = {
                chart: {
                    title: '',
                    subtitle: '',
                },
                bars: 'horizontal'
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>


    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Sales', 'Expenses', 'Profit'],
                ['2014', 1000, 400, 200],
                ['2015', 1170, 460, 250],
                ['2016', 660, 1120, 300],
                ['2017', 1030, 540, 350]
            ]);

            var options = {
                chart: {
                    title: '',
                    subtitle: '',
                },
                bars: 'horizontal'
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material_2'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>


    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'S', 'E', 'P'],
          ['2014', 1000, 400, 200],
          ['2015', 1170, 460, 250],
        ]);

        var options = {
            width: 250,
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material_12'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>

@endsection
