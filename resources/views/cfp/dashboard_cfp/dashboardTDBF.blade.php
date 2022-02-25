@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('css/style_dashboardTDBF.css')}}">
{{-- <link rel="stylesheet" href="ttps://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"> --}}
<div class="container-fluid pt-5">
<div class=" p-0 m-0 nav d-flex flex-row navigation justify-content-end" style="font-size: 10px;">
        <a href="{{ route('home') }}" type="button" class="btn" style="font-size: 12px;"> <i class="fad fa-sliders-v" style="font-size: 10px;"></i>&nbsp;TDB système</a>
        <a href="{{ route('hometdbf')}}" type="button" class="btn b active me-2 ms-2" style="font-size: 12px;"><i class="far fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB financier</a>
        <a href="{{ route('hometdbq')}}" type="button" class="btn " style="font-size: 12px;"> <i class="fad fa-chart-bar" style="font-size: 10px;"></i>&nbsp;TDB qualité</a>
</div>


<div class="p-1 m-0">
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="form-control">
                    <p class="text-center" style="font-size: 11px;">TDB financier</p>
                    <p class="p-0 m-0 " style="font-size: 10px; font-weight: bold;">C.A actuel:
                        @php
                            foreach ($CA_actuel as $total) {
                                $total = $total->total_ttc;
                                echo $total . ' ';
                            }
                        @endphp
                        Ar TTC</p>
                    <p class="p-1 m-0" style="font-size: 10px;">C.A précedent:
                        @php
                            foreach ($CA_precedent as $totals) {
                                $totals = $totals->total_ttc;
                                echo $totals . ' ';
                            }
                        @endphp Ar TTC</p>
                    <hr>
                    <div id="chart_div"></div>
                </div>
            </div>
            <div class=" p-0 col-lg-4">
                <div class="form-control">
                    <p class="text-center" style="font-size: 11px;">CA par module</p>
                    <p class="p-0 m-0 " style="font-size: 10px;">Top 10 modules</p>
                    <hr>
                    <div id="1"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-control">
                    <p class="text-center" style="font-size: 11px;">CA par client</p>
                    <p class="p-0 m-0 " style="font-size: 10px;">Top 10 clients</p>
                    <hr>
                    <div id="2" ></div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {

            // var button = document.getElementById('change-chart');
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
                width: 320,
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
                width: 300,
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
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Year', 'Sales', 'Expenses','ee'],
                ['2014', 1000, 400,100],
                ['2015', 1170, 460,150],
                ['2016', 660, 1120,200],
                ['2017', 1030, 540,20]
                ]);

                var options = {
                    width:320,
                    height:200,
                chart: {
                    title: '',
                    subtitle: '',
                },
                bars: 'horizontal' // Required for Material Bar Charts.
                };

                var chart = new google.charts.Bar(document.getElementById('1'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
    </script>


    <script type="text/javascript">
            google.charts.load('current', {'packages':['bar']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Year', 'Sales', 'Expenses', 'Profit'],
                ['2014', 100, 40, 00],
                ['2015', 110, 40, 25],
                ['2016', 60, 110, 30],
                ['2017', 100, 40, 50]
                ]);

                var options = {
                    width:320,
                    height:200,
                chart: {
                    title: '',
                    subtitle: '',
                },
                bars: 'horizontal' // Required for Material Bar Charts.
                };

                var chart = new google.charts.Bar(document.getElementById('2'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
    </script>
@endsection
