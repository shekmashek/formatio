@extends('./layouts/admin')
@section('content')
<script src='https://cdn.plot.ly/plotly-2.9.0.min.js'></script>
<link rel="stylesheet" href="{{asset('css/style_dashboard.css')}}">
<style>
    .realise{
        border: solid 10px;
        border-color: #E1DDDD;
        background-color: #E1DDDD;
        width: 40px;
    }
    .engage{
        border: solid 10px;
        border-color: #94928F;
        background-color: #94928F;
        width: 40px;
    }
    .restant{
        border: solid 10px;
        border-color: #383838;
        background-color: #383838;
        width: 40px;
    }
</style>
{{-- <link rel="stylesheet" href="ttps://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"> --}}


<div class=" p-0 m-0 nav d-flex flex-row navigation justify-content-end" style="font-size: 10px;">
        <a href="{{ route('home') }}" type="button" class="btn" style="font-size: 12px;"> <i class="fad fa-sliders-v" style="font-size: 10px;"></i>&nbsp;TDB système</a>
        <a href="{{ route('homertdbf')}}" type="button" class="btn b active me-2 ms-2" style="font-size: 12px;"><i class="far fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB financier</a>
        <a href="{{ route('homertdbq')}}" type="button" class="btn " style="font-size: 12px;"> <i class="fad fa-chart-bar" style="font-size: 10px;"></i>&nbsp;TDB qualité</a>
        @can('isReferent')
        <a href="{{ route('budget_previsionnel')}}" type="button" class="btn " style="font-size: 12px;"> <i class="fad fa-chart-bar" style="font-size: 10px;"></i>&nbsp;TDB budget previsionnel</a>    </div>
    @endcan
</div>
<div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <h4>Budget total :{{number_format($total_budget[0]->total,0,",",".")}}Ar</h4><br><br>
      </div>
      <div class="col-md-6">
        <h4>Département :{{$total_realise_dep[0]->nom_departement}}</h4><br><br>
      </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6 d-flex flex-row">
          <div class="realise me-3"></div>
          <h5 class="me-3">Réalisé: {{number_format($total_realise[0]->realise,0,",",".")}}Ar</h5>
          <div class="engage me-3"></div>
          <h5 class="me-3">Engagé: {{number_format($total_engage[0]->engage,0,",",".")}}Ar</h5>
          <div class="restant me-3"></div>
          <h5 class="me-3">Restant: {{number_format($total_restant,0,",",".")}}Ar</h5>
        </div>
        <div class="col-md-6 d-flex flex-row">
          <div class="realise me-3"></div>
          <h5 class="me-3">Réalisé: {{number_format($total_realise_dep[0]->total_realise,0,",",".")}}Ar</h5>
          <div class="engage me-3"></div>
          <h5 class="me-3">Engagé: {{number_format($total_engage[0]->engage,0,",",".")}}Ar</h5>
          <div class="restant me-3"></div>
          <h5 class="me-3">Restant: {{number_format($total_restant_dep,0,",",".")}}Ar</h5>
        </div>
    </div>
    <div class="row">
      <div class="col-md-6 d-flex flex-row">
        <div id="chart_div"></div>
      </div>
      <div class="col-md-6 d-flex flex-row">
        <div id="chart_dep"></div>
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
        delta: { reference: @php echo $total_budget[0]->total @endphp },
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
            { range: [0, @php echo $total_realise[0]->realise  @endphp], color: "#E1DDDD" },
            { range: [@php echo $total_realise[0]->realise  @endphp,1200000], color: "#94928F" },
            { range: [1200000,@php echo $total_budget[0]->total @endphp], color: "#383838" }
          ]
        }
      }
    ];

    var layout = { width: 600, height: 250 };
    var config = { responsive: true };
    var myDiv = document.getElementById('chart_div');
    Plotly.newPlot(myDiv, data, layout, config);
      const total_realise_dep = @php echo  json_encode($total_realise_dep) @endphp;
      for (let i = 0; i < total_realise_dep.length; i++) {
          var donnees = [
          {
            type: "indicator",
            mode: "number+gauge+delta",
            // value:  @php echo $total_budget[0]->total @endphp,
            domain: { x: [0, 1], y: [0, 1] },
            title: { text: "<b>Budget</b>" },
            delta: { reference: @php
                  echo $total_restant_dep;
                @endphp
              },
            gauge: {
              shape: "bullet",
              axis: { range: [null, @php echo  $total_budget[0]->total @endphp] },
              threshold: {
                line: { color: "red", width: 5, height:200},
                thickness: 1,
                value: @php echo  $total_budget[0]->total @endphp
              },
              bar: { color: "grey" },
              steps: [
                { range: [0, total_realise_dep[i].total_realise ], color: "#E1DDDD" },
                { range: [total_realise_dep[i].total_realise,1200000], color: "#94928F" },
                { range: [1200000,@php echo $total_budget[0]->total @endphp], color: "#383838" }
              ]
            }
          }
        ];


        var interface = { width: 600, height: 250 };
        var configuration = { responsive: true };
        var monDiv = document.getElementById('chart_dep');
        Plotly.newPlot(monDiv, donnees, interface, configuration);
      }

</script>
@endsection
