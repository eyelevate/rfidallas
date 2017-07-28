

$(document).ready(function(){
	charts.fill();
});

charts = {
	fill: function(){
		// get fee info from server and post it to form
		axios.get('/apis/charts/admins-index').then(response => {
			// set variables
			var data = response.data.chart1;
			var options = charts.options('simple', data);
			// First Chart Row

			// Customers
			var ctx = $('#card-chart1');
			var cardChart1 = charts.make(ctx, data, options);

			// Employees
			data = response.data.chart2;
			options = charts.options('simple', data);
			var ctx = $('#card-chart2');
			var cardChart2 = charts.make(ctx, data, options);

			// Managers
			data = response.data.chart3;
			options = charts.options('simple', data);
			var ctx = $('#card-chart3');
			var cardChart3 = charts.make(ctx, data, options);

			// Partners
			data = response.data.chart4;
			console.log(data);
			options = charts.options('simple', data);
			var ctx = $('#card-chart4');
			var cardChart3 = charts.make(ctx, data, options);


		});
	},
	make: function (ctx, data, options) {
		return new Chart(ctx, {
			type: data.type,
			data: {
				labels: data.labels,
				datasets: [
				{
					label: data.datasets.label,
					backgroundColor: data.datasets.backgroundColor,
					borderColor: data.datasets.borderColor,
					data: data.datasets.data
				},
				]
			},
			options: options
		});
	},
	options: function(type, data) {
		var options = {};
		switch (type) {
			case 'simple':
				var options = {
					maintainAspectRatio: false,
					legend: {
						display: false
					},
					scales: {
						xAxes: [{
							gridLines: {
								color: 'transparent',
								zeroLineColor: 'transparent'
							},
							ticks: {
								fontSize: 2,
								fontColor: 'transparent',
							}

						}],
						yAxes: [{
							display: false,
							ticks: {
								display: false,
								min: Math.min.apply(Math, data.datasets.data) - 5,
								max: Math.max.apply(Math, data.datasets.data) + 5,
							}
						}],
					},
					elements: {
						line: {
							borderWidth: 1
						},
						point: {
							radius: 4,
							hitRadius: 10,
							hoverRadius: 4,
						},
					}
				}
				break;
			default:
				// statements_def
				break;
		}

		return options;
	}
}