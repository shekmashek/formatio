@extends('./layouts/admin')
@section('content')
<script src='https://cdn.plot.ly/plotly-2.9.0.min.js'></script>
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
	<!-- Load plotly.js into the DOM -->

<script>
        var data = [
      {
        type: "indicator",
        mode: "number+gauge+delta",
        // value:  @php echo $total_budget[0]->total @endphp,
        domain: { x: [0, 1], y: [0, 1] },
        title: { text: "<b>Budget</b>" },
        delta: { reference: 200 },
        gauge: {
          shape: "bullet",
          axis: { range: [null, @php echo $total_budget[0]->total @endphp] },
          threshold: {
            line: { color: "red", width: 5, height:200},
            thickness: 1,
            value: @php echo $total_budget[0]->total @endphp
          },
          bar: { color: "grey" },
           steps: [
            { range: [0,1000000], color: "#E1DDDD" },
            { range: [1000000,1200000], color: "#94928F" },
            { range: [1200000,1700000], color: "#757472" }
          ]
        }
      }
    ];

    var layout = { width: 600, height: 350 };
    var config = { responsive: true };
    var myDiv = document.getElementById('chart_div');
    Plotly.newPlot(myDiv, data, layout, config);
</script>
@endsection
