@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <style>
        /* .nav-tabs .nav-link{
            background-image:linear-gradient(60deg, #AA076B 40%, #61045F)
            /* color: white;
        } */

        #myTab{
            background-color: white;
        }

        .nav-link{
            color: black;

        }

        .nav-link:hover{
            color: black;
            background-color: #f2f2f2;
        }


        .navigation .nav-item{
            background-image: none;
            color: white;
            background-color: white ;
        }

        .navigation{
            background-color: #f8f9fa;
            /* background-image:linear-gradient(100deg, #AA076B, #61045F) */
        }

        .navigation:hover{
            background-color: #dde0e2;
            border-block-color: none;
            /* background-color: #801D68; */
        }

        .system_{
            text-align: left;
            border: none;
            border-bottom: 1px solid #c22d9d;
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


        .system_numeroAlert{
            text-align: right;
            color: white;
            background-color: #d32727;
            border: none;
            border-radius: 5px;
            float: right;
            padding-left: 5px;
            padding-right: 5px
        }


        .system_numeroSuccess{
            text-align: right;
            color: white;
            background-color: #25d315;
            border: none;
            border-radius: 5px;
            float: right;
            padding-left: 5px;
            padding-right: 5px
        }
    </style>

    <div class="p-0 m-0">
        <ul class="nav nav-tabs d-flex flex-row navigation justify-content-end " id="myTab" style="font-size: 11px;">
            <li class="nav-item">
                <a href="#TBFinancière" class="nav-link active m-1" data-bs-toggle="tab"> <i class="fad fa-sliders-v" style="font-size: 13px;"></i>&nbsp; TDB système</a>
            </li>
            <li class="nav-item">
                <a href="#TBStatistique" class="nav-link m-1" data-bs-toggle="tab" ><i class="far fa-chart-line" style="font-size: 15px;"></i>&nbsp; TDB financier</a>
            </li>
            <li class="nav-item">
                <a href="#TBQualité" class="nav-link m-1" data-bs-toggle="tab" > <i class="fad fa-chart-bar" style="font-size: 15px;"></i>&nbsp; TDB Qualité</a>
            </li>
        </ul><br>
        <div class="tab-content ">
            <div class="tab-pane fade show active" id="TBFinancière">
                <div class="container-fluid" style="font-size: 10px;">
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fad fa-users "></i>&nbsp; Collaborateur </b>
                                <p class=" m-1 system_ pb-1">Formateurs<span class="system_numero">0</span></p>
                                <p class="m-1 system_ pb-1">Entreprise<span class="system_numero">7</span></p>
                                <p class="m-1 system_ pb-1">Réferents<span class="system_numero">0</span></p>
                                <p class="m-1 system_ pb-1">Manager<span class="system_numero">0</span></p>
                            </div>
                        </div>

                        {{-- <div class="col-lg-4">
                            <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"> <b><i class="fad fa-users "></i> &nbsp; Collaborateur</b>
                                <p class="p-0 m-1 system_ pb-1">Formateurs<span class="system_num"><i style="color: red;" class='bx bxs-user-x'></i></span></p>
                                {{-- <p class="m-3 system_">Entreprise<span class="system_num"><i class='bx bxs-check-shield'></i></span></p>
                                <p class="m-3 system_">Réferents<span class="system_num"><i class='bx bxs-user-check' ></i></span></p> ireto ny icone--
                                <p class="p-0 m-1 system_ pb-1">Entreprise<span class="system_numero">70</span></p>
                                <p class="m-1 system_ pb-1">Réferents<span class="system_numero">55</span></p>
                            </div>
                        </div>  --}}


                        <div class="col-lg-4">
                            <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="far fa-book-spells"></i> &nbsp; Catalogue </b>
                                <p class="m-1 system_ pb-1">Publié<span class="system_numero">5</span></p>
                                <p class="m-1 system_ pb-1">En cours de création<span class="system_numero">10</span></p>
                                <p class="m-1 system_ pb-1">Programme incomplète<span class="system_numero">70</span></p>
                                <p class="m-1 system_ pb-1">Compétence incomplète<span class="system_numero">70</span></p>
                                <p class="m-1 system_ pb-1">Archiver<span class="system_numero">70</span></p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fad fa-address-card"></i>&nbsp; Facture </b>
                                <p class=" m-1 system_ pb-1">Payé<span class="system_numero">3</span></p>
                                <p class="m-1 system_ pb-1">Non échu<span class="system_numero">7</span></p>
                                <p class="m-1 system_ pb-1">Echu non payé<span class="system_numero">0</span></p>
                                <p class="m-1 system_ pb-1">Payement partiel<span class="system_numero">0</span></p>
                                <p class="m-1 system_ pb-1">Brouillon<span class="system_numero">0</span></p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- 2 --}}
                <div class="container-fluid" style="font-size: 10px;">
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fas fa-tasks"></i> &nbsp; Session Inter entreprise </b>
                                <p class="p-0 m-1 system_ pb-1">Complété<span class="system_numero">3</span></p>
                                <p class="m-1 system_ pb-1">En cours<span class="system_numero">7</span></p>
                                <p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">0</span></p>
                                <p class="m-1 system_ pb-1">A venir<span class="system_numero">0</span></p>
                                <p class="m-1 system_ pb-1">Annuler<span class="system_numero">0</span></p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fas fa-tasks"></i>&nbsp; Session Intra enreprise </b>
                                <p class="p-0 m-1 system_ pb-1">Complété<span class="system_numero">3</span></p>
                                <p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">0</span></p>
                                <p class="m-1 system_ pb-1">En cours<span class="system_numero">0</span></p>
                                <p class="m-1 system_ pb-1">A venir<span class="system_numero">10</span></p>
                                <p class="m-1 system_ pb-1">Annuler<span class="system_numero">0</span></p>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fal fa-building"></i> &nbsp; Profil de l'organisation (Numerika) </b>
                                <p class="p-0 m-1 system_ pb-1">Adresse<span class="system_numeroAlert">Incomplet</span></p>
                                <p class="m-1 system_ pb-1">Information légale<span class="system_numeroSuccess">complet</span></p>
                                <p class="m-1 system_ pb-1">Type d'abonnement<span class="system_numero">Gratuit</span></p>
                            </div>
                        </div>
                        {{--  referent ty  <div class="col-lg-4">
                            <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fas fa-tasks"></i>&nbsp; Session Interne </b>
                                <p class="p-0 m-1 system_ pb-1">Comlété<span class="system_numero">30</span></p>
                                <p class="m-1 system_ pb-1">En cours<span class="system_numero">40</span></p>
                                 <p class="m-1 system_ pb-1">Prévisionnel<span class="system_numero">0</span></p>
                                <p class="m-1 system_ pb-1">A venir<span class="system_numero">1</span></p>
                                <p class="m-1 system_ pb-1">Annuler<span class="system_numero">0</span></p>
                            </div>
                        </div> --}}
                    </div>
                </div>
                {{-- 3 --}}
                <div class="container-fluid" style="font-size: 10px;">
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b><i class="far fa-user-cog"></i>&nbsp; Profil de l'utilisateur (Urluc) </b>
                                <p class="p-0 m-1 system_ pb-1">Informations générales<span class="system_numeroAlert">Incomplet</span></p>
                                <p class="m-1 system_ pb-1">Coordonnées<span class="system_numeroSuccess">Complet</span></p>
                                <p class="m-1 system_ pb-1">Informations professionnelles<span class="system_numeroAlert">Incomplet</span></p>
                            </div>
                        </div>
                        {{-- referent ty <div class="col-lg-4">
                            <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fas fa-warehouse-alt"></i> &nbsp;Structure de l'entreprise </b>
                                <p class="p-0 m-1 system_ pb-1">Département<span class="system_numero">3</span></p>
                                <p class="m-1 system_ pb-1">Service<span class="system_numero">7</span></p>
                                <p class="m-1 system_ pb-1">Branche<span class="system_numero"><i class='bx bx-git-branch'></i>&nbsp;0</span></p>
                                <p class="m-1 system_ pb-1">Fonction<span class="system_numero">4</span></p>
                            </div>
                        </div> --}}

                        {{-- referent ty <div class="col-lg-4">
                            <div class="shadow-sm p-2 mb-1 bg-body rounded" style="color: #801D68"><b> <i class="fad fa-users-cog"></i>&nbsp; Employée </b>
                                <p class="p-0 m-1 system_ pb-1">Actif<span class="system_numero">30</span></p>
                                <p class="m-1 system_ pb-1">Inactif<span class="system_numero">40</span></p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

        <div class="tab-pane fade" id="TBStatistique">
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
                                @endphp Ar TTC</p>

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
                            <div id="1" style="width: 350px; height:200px; justify-content: flex-start;"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-control">
                            <p class="text-center" style="font-size: 11px;">CA par client</p>
                            <p class="p-0 m-0 " style="font-size: 10px;">Top 10 clients</p>
                            <hr>
                            <div id="2"  style="width: 350px; height:200px; justify-content: flex-start;"></div>
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
                        <div class="form-control" style="font-size: 11px;">
                            <p class="text-center">Tableau de bord financier</p>
                            <p class="p-0 m-0 " style="font-size: 10px; font-weight: bold;">C.A actuel:
                                {{-- @php
                                    foreach ($CA_actuel as $total) {
                                        $total = $total->total;
                                        echo $total . ' ';
                                    }
                                @endphp --}}
                                Ar TTC</p>

                            <p class="p-1 m-0" style="font-size: 10px;">C.A précedent:
                                {{-- @php
                                    foreach ($CA_precedent as $totals) {
                                        $totals = $totals->total;
                                        echo $totals . ' ';
                                    }
                                @endphp  --}}
                                Ar TTC</p>
                            <hr>
                            <div id="3" style="width: 350px; height: 200px;"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-control">
                            <p class="text-center" style="font-size: 11px;">Chiffre d'affaires par module</p>
                            <p class="p-0 m-0 " style="font-size: 10px; ">Top 10 modules</p>
                            <hr>
                            <div id="4" style="width: 350px; height:200px;"></div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-control">
                            <p class="text-center" style="font-size: 11px;" >Chiffre d'affaires par client</p>
                            <p class="p-0 m-0 " style="font-size: 10px; ">Top 10 clients</p>
                            <hr>
                            <div id="5" style="width: 350px; height:200px;"></div>
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
            google.charts.load('current', {'packages':['bar']});
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



    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart', 'bar']
        });
        google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {

            // var button = document.getElementById('change-chart');
            var chartDiv = document.getElementById('3');

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
            google.charts.load('current', {'packages':['bar']});
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
                bars: 'horizontal' // Required for Material Bar Charts.
                };

                var chart = new google.charts.Bar(document.getElementById('4'));

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
                chart: {
                    title: '',
                    subtitle: '',
                },
                bars: 'horizontal' // Required for Material Bar Charts.
                };

                var chart = new google.charts.Bar(document.getElementById('5'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
    </script>



@endsection
