@extends('./layouts/admin')
@section('content')

<div class="container-fluid p-5">
    <div id="barchart_material" style="width: 30%; height: 500px;"></div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            /*      ["Mois","Année", "Chiffre d'affaire"],["janvier","2021","30000 AR"],["fevrier","2021","7000 AR"],*/

            /* en bas, actuel,precedent*/
            ["Mois {{$GChart[0]->annee}}", "chiffre"],
            @php
                  foreach($GChart as $product) {
                      echo "['".$product-> mois."', ".$product-> net_ttc."],";
                  }
                  @endphp

            /*      @php
                  foreach($GChart as $product) {
                      echo "['".$product-> mois."', ".$product-> annee.", ".$product-> net_ttc.
                      "],";
                  }
                  @endphp */
        ]);




        var options = {
            chart: {
                title: 'Bar Graph | Sales'
                , subtitle: 'Sales, and Quantity: TESTE NOAM'
            , }
            , bars: 'vertical'
        };
        var chart = new google.charts.Bar(document.getElementById('barchart_material'));
        chart.draw(data, google.charts.Bar.convertOptions(options));
    }

</script>


@endsection
