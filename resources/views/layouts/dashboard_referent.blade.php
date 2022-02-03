@extends('./layouts/admin')
@section('content')

    <div class="p-0 m-4">
        <ul class="nav nav-tabs d-flex flex-row navigation justify-content-end" id="myTab" style="font-size: 13px;">
            <li class="nav-item">
                <a href="#TBFinancière" class="nav-link active" data-bs-toggle="tab">Tableau de bord</a>
            </li>
            <li class="nav-item">
                <a href="#TBStatistique" class="nav-link " data-bs-toggle="tab">Tableau de bord statistique</a>
            </li>
            <li class="nav-item">
                <a href="#TBQualité" class="nav-link " data-bs-toggle="tab">Tableau de bord Qualité</a>
            </li>
        </ul><br>

        <div class="tab-content ">
            <div class="tab-pane fade show active" id="TBFinancière">
                <div class="container-fluid">
                    <div class="row mt-2">
                        <div class="col-lg-4">
                            <div class="form-control">
                                <p class="text-center"><b style="font-size: 16px;">Stagiaire par sexe</b></p>
                                <p class="p-0 m-0 " style="font-size: 14px; ">Total Homme :15,4 %
                                    {{-- @php
                                        foreach ($CA_actuel as $total) {
                                            $total = $total->total_ttc;
                                            echo $total . ' ';
                                        }
                                    @endphp --}}
                                </p>
                                <p class="p-0 mt-1 " style="font-size: 14px;" >Total Femme : 84,6 %
                                    {{-- @php
                                        foreach ($CA_actuel as $total) {
                                            $total = $total->total_ttc;
                                            echo $total . ' ';
                                    @endphp --}}
                                </p>

                                <hr>
                                <div id="piechart"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-control">
                                <p class="text-center"><b style="font-size: 16px;">Total stagiaire </b></p>
                                <p class="p-0 m-0 " style="font-size: 14px; font-weight: bold;">Total stagiaire actuel : 700
                                    {{-- @php
                                        foreach ($CA_actuel as $total) {
                                            $total = $total->total_ttc;
                                            echo $total . ' ';
                                        }
                                    @endphp --}}
                                </p>
                                <p class="p-1 m-0" style="font-size: 13px;">Total stagiaire de l'année précédent : 250
                                    {{-- @php
                                        foreach ($CA_precedent as $totals) {
                                            $totals = $totals->total_ttc;
                                            echo $totals . ' ';
                                        }
                                    @endphp --}}
                                </p>
                                <hr>
                                <div id="barchart_material"></div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            {{-- <div class="form-control">
                                <p class="text-center"><b style="font-size: 17px;">Chiffre d'affaires par client</b></p>
                                <p class="p-0 m-0 " style="font-size: 15px; font-weight: bold;">Top 10 clients</p>
                                <hr>
                                <div id="barchart_material_2"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>


        <div class="tab-pane fade" id="TBStatistique">
            <div class="container-fluid">
                <div class="row mt-2">
                    <div class="col-lg-4">
                        <div class="form-control">
                            <p class="text-center"><b style="font-size: 16px;">Tableau de bord financier</b></p>
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


        <div class="tab-pane fade" id="TBQualité">

        </div>
      </div>
    </div>

<style>
  .nav-tabs .nav-link{
    color: white;
  }
  .navigation{
    background-image:linear-gradient(100deg, #AA076B, #61045F)
  }

  .navigation:hover{
    background-color: #801D68;
  }
</style>
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

    </script>

<script type="text/javascript">

    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = google.visualization.arrayToDataTable([
        ['Task', 'Hours per Day'],
        ['Homme',     11],
        ['Femme',      2]
      ]);

      var options = {
        title: ''
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
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
            width: 350,
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
