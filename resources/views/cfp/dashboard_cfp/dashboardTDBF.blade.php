@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('css/style_dashboardTDBF.css')}}">
<link rel="stylesheet" href="{{asset('css/stagiaires.css')}}">
<div class=" p-0 m-0 nav d-flex flex-row navigation justify-content-end" style="font-size: 10px;">
        <a href="{{ route('home') }}" type="button" class="btn bb" style="font-size: 12px;"> <i class="fas fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB système</a>
        <a href="{{ route('hometdbf')}}" type="button" class="btn b active me-2 ms-2" style="font-size: 12px;"><i class="fas fa-chart-bar" style="font-size: 10px;"></i>&nbsp;TDB financier</a>
        <a href="{{ route('hometdbq')}}" type="button" class="btn bb" style="font-size: 12px;"> <i class="fas fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB qualité</a>
</div>

{{--
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
    </script> --}}


<div class="p-1 m-0">
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="form-control">
                    <p class="text-center" style="font-size: 11px; color:#7535DC">TDB financier</p>
                    <p class="p-0 m-0 " style="font-size: 10px; font-weight: bold;">C.A actuel:
                        {{-- @php
                            foreach ($CA_actuel as $total) {
                                $total = $total->total_ttc;
                                echo $total . ' ';
                            }
                        @endphp --}}
                        Ar TTC</p>
                    <p class="p-1 m-0" style="font-size: 10px;">C.A précedent:
                        {{-- @php
                            foreach ($CA_precedent as $totals) {
                                $totals = $totals->total_ttc;
                                echo $totals . ' ';
                            }
                        @endphp --}}
                        Ar TTC</p>
                    <hr>
                    <div id="chart_div" style=""></div>
                </div>
            </div>
            <div class=" p-0 col-lg-4">
                <div class="form-control" style="height: 233px">
                    <p class="text-center" style="font-size: 11px; color:#7535DC">CA par module</p>
                    <p class="p-0 m-0 " style="font-size: 10px;">Top 5 modules</p>
                    <hr>
                    <div id="1" style=""></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-control" style="height: 233px">
                    <p class="text-center" style="font-size: 11px; color:#7535DC">CA par client</p>
                    <p class="p-0 m-0 " style="font-size: 10px;">Top 5 clients</p>
                    <hr>
                    <div id="2" style=""></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 mt-3">
                <div class="form-control" style="height: 160px">
                    <p class="text-center" style="font-size: 11px; color:#7535DC">Coût de formation</p>
                    <hr>
                    <div style="font-size: 11px">
                        <div class="row">
                            <div class="col-lg-6 p-1 mt-0 m-0">
                                <div class="shadow-sm p-3 mb-1  mt-1 bg-body rounded">
                                    <div class="row">
                                        <div class="col-lg-8" >
                                            <p class="p-0 m-0 ms-0" id="ft2"> Coût pédagogique</p>
                                            <p class="p-0 m-0 mt-1 ms-0" id="ft155">45 %</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="" >
                                                <p id="qssq">
                                                    <i class='bx bxs-wallet' id="sssq"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 p-1 mt-0 m-0">
                                <div class="shadow-sm p-3 mb-1 mt-1 bg-body rounded">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <p class="p-0 m-0 ms-0" id="coll">Frais annexe</p>
                                            <p class="p-0 m-0 mt-1 ms-0" id="ft155">200.000 Ar</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <div>
                                                <p id="pddp">
                                                    <i class='bx bxs-wallet' id="sssq"></i>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                // @php
                // foreach ($GChart as $product) {
                //     $val = "['" . $product->mois . "', " . $product->net_ttc . ', ' . $product->annee . ']';
                //     echo $val . ',';
                // }
                // @endphp
            ]);

            var materialOptions = {
                width: 270,
                height:120,
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
                width: 270,
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
                    width:280,
                    height:130,
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
                    width:280,
                    height:130,
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
