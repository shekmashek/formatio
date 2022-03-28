@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('css/style_dashboard.css')}}">
{{-- <link rel="stylesheet" href="ttps://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"> --}}


{{-- <div class=" p-0 m-0 nav d-flex flex-row navigation justify-content-end" style="font-size: 10px;">
        <a href="{{ route('home') }}" type="button" class="btn" style="font-size: 12px;"> <i class="fad fa-sliders-v" style="font-size: 10px;"></i>&nbsp;TDB système</a>
        <a href="{{ route('homertdbf')}}" type="button" class="btn b active me-2 ms-2" style="font-size: 12px;"><i class="far fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB financier</a>
        <a href="{{ route('homertdbq')}}" type="button" class="btn " style="font-size: 12px;"> <i class="fad fa-chart-bar" style="font-size: 10px;"></i>&nbsp;TDB qualité</a>
        @can('isReferent')
        <a href="{{ route('budget_previsionnel')}}" type="button" class="btn " style="font-size: 12px;"> <i class="fad fa-chart-bar" style="font-size: 10px;"></i>&nbsp;TDB budget previsionnel</a>    </div>
    @endcan
</div> --}}

<div class="p-1 m-0">
    <div class="container-fluid">
        <div class="row">
            <div id="chart_div"></div>
        </div>
    </div>
</div>
	<!-- Load plotly.js into the DOM -->
	<script src='https://cdn.plot.ly/plotly-2.9.0.min.js'></script>
<script>
        var data = [
      {
        type: "indicator",
        mode: "number+gauge+delta",
        value: @php echo $total_realise[0]->realise @endphp,
        domain: { x: [0, 1], y: [0, 1] },
        title: { text: "<b>Budget</b>" },
        delta: { reference: 200 },
        gauge: {
          shape: "bullet",
          axis: { range: [null, @php echo $total_budget[0]->total @endphp] },
          threshold: {
            line: { color: "red", width: 2 },
            thickness: 0.75,
            value: 280
          },
          steps: [
            { range: [0,@php echo $total_engage[0]->engage @endphp], color: "grey" },
            { range: [50000,@php echo $total_realise[0]->realise @endphp], color: "grey" },
            { range: [@php echo $total_realise[0]->realise @endphp,  @php echo $total_budget[0]->total @endphp], color: "blue" }
          ]
        }
      }
    ];

    var layout = { width: 600, height: 250 };
    var config = { responsive: true };
    var myDiv = document.getElementById('chart_div');
    Plotly.newPlot(myDiv, data, layout, config);
</script>
@endsection
