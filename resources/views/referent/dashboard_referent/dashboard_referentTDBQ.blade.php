@extends('./layouts/admin')
@section('content')
<link rel="stylesheet" href="{{asset('css/style_dashboard.css')}}">
{{-- <link rel="stylesheet" href="ttps://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"> --}}

<div class=" p-0 m-0 nav d-flex flex-row navigation justify-content-end" style="font-size: 10px;">
        <a href="{{ route('home') }}" type="button" class="btn bb" style="font-size: 12px;"> <i class="fas fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB système</a>
        <a href="{{ route('homertdbf')}}" type="button" class="btn bb me-2 ms-2" style="font-size: 12px;"><i class="fas fa-chart-line" style="font-size: 10px;"></i>&nbsp;TDB financier</a>
        <a href="{{ route('hometdbq')}}" type="button" class="btn c active" style="font-size: 12px; color: #801D68;"> <i class="fas fa-chart-bar" style="font-size: 10px;"></i>&nbsp;TDB qualité</a>
</div>


<div class="p-1 m-0">
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-lg-4" >
                <div class="form-control">
                    <p class="text-center" style="color:#7535DC; font-size: 13px;">Total d'heure de formation</p>
                    {{-- <span class="ms-5 mt-1" style="color: rgb(82, 82, 82)"><i class="fas fa-clock" style="color:rgb(150, 214, 142);background-color: rgb(204, 242, 200); border-radius: 7px; font-size: 26px; padding: 5px"></i>&nbsp;&nbsp; 145 heures</span> --}}
                    <div id="piechart" style="max-width:300px; height: 140px;"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-control" style="height: 189px">
                    {{-- graphique --}}
                    <p class="text-center" style="font-size: 13px; color:#7535DC">Total d'heure par département</p><br>
                    <span class="ms-5 mt-1" style="color: rgb(82, 82, 82)"><i class="fas fa-clock" style="color:rgb(216, 146, 137);background-color: rgb(243, 208, 204); border-radius: 7px; font-size: 30px; padding: 5px"></i>&nbsp;&nbsp; 15 heures</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-control">
                    {{-- graphique --}}
                    <p class="text-center" style="font-size: 13px; color:#7535DC" >Total d'heure par module</p>
                    {{-- <span class="ms-5 mt-1" style="color: rgb(82, 82, 82)"><i class="fas fa-clock" style="color:rgb(220, 223, 79);background-color: rgb(244, 245, 171); border-radius: 7px; font-size: 26px; padding: 5px"></i>&nbsp;&nbsp; Excel • 45 heures</span> --}}
                    <div id="pie1" style="max-width:300px; height: 140px;"></div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-4">
                <div class="form-control" style="height: 189px">
                    <p class="text-center" style="font-size: 13px; color:#7535DC" >Nombre homme et femme formés</p><br>
                    <span class="ms-5 mt-1" style="color: rgb(82, 82, 82)"><i class="fas fa-male" style="color:rgb(138, 154, 243);background-color: rgb(197, 204, 243); border-radius: 7px; font-size: 30px; padding: 5px;width:30px"></i>&nbsp;&nbsp; 100 hommes</span>
                    <span class="ms-5 mt-1" style="color: rgb(82, 82, 82)"><i class="fas fa-female" style="color:rgb(238, 144, 149);background-color: rgb(243, 197, 199); border-radius: 7px; font-size: 30px; padding: 5px;width:30px"></i>&nbsp;&nbsp; 115 femmes</span>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-control">
                    {{-- graphique --}}
                    <p class="text-center" style="font-size: 13px; color:#7535DC">Nombre de la personne formé par module</p>
                    {{-- <span class="ms-5 mt-1" style="color: rgb(82, 82, 82)"><i class="fas fa-male" style="color:rgb(138, 154, 243);background-color: rgb(197, 204, 243); border-radius: 7px; font-size: 26px; padding: 5px;width:26px"></i>&nbsp;&nbsp; 10 hommes</span> --}}
                    {{-- <span class="ms-5 mt-1" style="color: rgb(82, 82, 82)"><i class="fas fa-female" style="color:rgb(238, 144, 149);background-color: rgb(243, 197, 199); border-radius: 7px; font-size: 26px; padding: 5px;width:26px"></i>&nbsp;&nbsp; 5 femmes</span>
                    <span class="ms-5 mt-1" style="color: rgb(82, 82, 82)"><i class="fas fa-building" style="color:rgb(181, 206, 71);background-color: rgb(224, 238, 161); border-radius: 7px; font-size: 26px; padding: 5px;width:26px"></i>&nbsp;&nbsp; 115 personnes</span> --}}
                    <div id="pie2" style="max-width:300px; height: 140px;"></div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-control" style="height: 189px">
                    <p class="text-center" style="font-size: 13px; color:#7535DC">Total homme et femme</p><br>
                    <span class="ms-5 mt-1" style="color: rgb(82, 82, 82)"><i class="fas fa-male" style="color:rgb(138, 154, 243);background-color: rgb(197, 204, 243); border-radius: 7px; font-size: 30px; padding: 5px;width:30px"></i>&nbsp;&nbsp; 10 hommes</span>
                    <span class="ms-5 mt-1" style="color: rgb(82, 82, 82)"><i class="fas fa-female" style="color:rgb(238, 144, 149);background-color: rgb(243, 197, 199); border-radius: 7px; font-size: 30px; padding: 5px;width:30px"></i>&nbsp;&nbsp; 5 femmes</span>
                </div>
                {{-- <div class="form-control">
                    <p class="text-center" style="font-size: 13px; color:#7535DC" >Nombre homme et femme formés</p>
                    <span class="ms-5 mt-1" style="color: rgb(82, 82, 82)"><i class="fas fa-male" style="color:rgb(138, 154, 243);background-color: rgb(197, 204, 243); border-radius: 7px; font-size: 26px; padding: 5px;width:26px"></i>&nbsp;&nbsp; 100 hommes</span>
                    <span class="ms-5 mt-1" style="color: rgb(82, 82, 82)"><i class="fas fa-female" style="color:rgb(238, 144, 149);background-color: rgb(243, 197, 199); border-radius: 7px; font-size: 26px; padding: 5px;width:26px"></i>&nbsp;&nbsp; 115 femmes</span>
                </div> --}}
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-4">
                <div class="form-control">
                    <p class="text-center" style="color:#7535DC;font-size: 13px;">Assiduité</p>
                    <span class="ms-5 mt-1" style="color: rgb(82, 82, 82)"><i class="fas fa-users" style="color:rgb(125, 218, 213);background-color: rgb(197, 243, 241); border-radius: 7px; font-size: 26px; padding: 5px;width:26px"></i>&nbsp;&nbsp; 17 % (taux d'absence)</span>
                </div>
            </div>
            <div class="col-lg-4">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Mois','date'],
          ['Work',     10, 10],
          ['Eat',      2, 2],
          ['Commute',  1, 3]
        ]);

        var options = {
          title: ''
        };

        var chart = new google.visualization.BarChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Task', 'Mois','date'],
      ['Work',     10, 10],
      ['Eat',      2, 2],
      ['Commute',  1, 3]
    ]);

    var options = {
      title: ''
    };

    var chart = new google.visualization.BarChart(document.getElementById('pie1'));

    chart.draw(data, options);
  }
</script>

<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Task', 'Mois','date'],
      ['Work',     10, 10],
      ['Eat',      2, 2],
      ['Commute',  1, 3]
    ]);

    var options = {
      title: ''
    };

    var chart = new google.visualization.BarChart(document.getElementById('pie2'));

    chart.draw(data, options);
  }
</script>
@endsection
