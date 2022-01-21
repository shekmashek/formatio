@extends('./layouts/admin')
@section('content')

<div class="row">
	<div class="col-lg-3">
		<div class="card-header"  style="background-color: rgb(125, 181, 253);">
			<h1>Hello !</h1>
		</div>
		<div class="" style="background-color: rgb(70, 149, 252);">
			<div class="card-body">
				<canvas id="bar-chart" width="700" height="380"></canvas>
			</div>
		</div>
	</div>
</div>


<style>
    canvas {
	display: block;
	max-width: 600px;
	/* margin: 40px auto; */
}
</style>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>


<script>
var bar_ctx = document.getElementById('bar-chart').getContext('2d');

var purple_orange_gradient = bar_ctx.createLinearGradient(0, 0, 0, 600);
purple_orange_gradient.addColorStop(0, '#801D68');
purple_orange_gradient.addColorStop(1, 'white');

var bar_chart = new Chart(bar_ctx, {
    type: 'bar',
    data: {
        labels: ["J", "F", "M", "Avr"],
        datasets: [{
            label: '',
            data: [1, 70, 3, 8],
						backgroundColor: purple_orange_gradient,
						hoverBackgroundColor: purple_orange_gradient,
						hoverBorderWidth: 2,
						hoverBorderColor: 'purple'
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
@endsection
