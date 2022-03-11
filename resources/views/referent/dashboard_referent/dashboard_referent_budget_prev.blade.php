@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('css/style_dashboard.css')}}">
{{-- <link rel="stylesheet" href="ttps://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"> --}}


<div class=" p-0 m-0 nav d-flex flex-row navigation justify-content-end" style="font-size: 10px;">
        <a href="{{ route('home') }}" type="button" class="btn" style="font-size: 12px;"> <i class="fad fa-sliders-v" style="font-size: 10px;"></i>&nbsp;TDB système</a>
        <a href="{{ route('homertdbf')}}" type="button" class="btn b active me-2 ms-2" style="font-size: 12px;"><i class="far fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB financier</a>
        <a href="{{ route('homertdbq')}}" type="button" class="btn " style="font-size: 12px;"> <i class="fad fa-chart-bar" style="font-size: 10px;"></i>&nbsp;TDB qualité</a>
        @can('isReferent')
        <a href="{{ route('budget_previsionnel')}}" type="button" class="btn " style="font-size: 12px;"> <i class="fad fa-chart-bar" style="font-size: 10px;"></i>&nbsp;TDB budget previsionnel</a>    </div>
    @endcan
</div>

<div class="p-1 m-0">
    <div class="container-fluid">
        <div class="row">
            <div id="chart_div"></div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
    google.charts.load('current', {packages: ['corechart', 'bar']});
google.charts.setOnLoadCallback(drawBasic);

function drawBasic() {

      var data = google.visualization.arrayToDataTable([
          ['Budget','Budget prévisionnel:', 'Budget Engagé', 'Budget Réalisé','Budget Restant'],
            @php
                echo "[' ',".$total_budget[0]->total.", 0,0,0],";
                echo "[' ',0, ".$total_engage[0]->engage.", ".$total_realise[0]->realise.",".$total_restant."]";
            @endphp
          ]

      );

      var options = {
        isStacked: true,
        title: 'Budget previsionnel '+new Date().getFullYear() ,
        chartArea: {width: '50%'},
        hAxis: {
          title: '',
          minValue: 0
        },
        vAxis: {
          title: ''
        }
      };

      var chart = new google.visualization.BarChart(document.getElementById('chart_div'));

      chart.draw(data, options);
    }
</script>
@endsection
