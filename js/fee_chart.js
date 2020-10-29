$("document").ready(function() {
	$.get("lib/get_monthly_records.php", { type: "fees" }, function(res) {
		const fees = JSON.parse(res);

		Highcharts.chart("fee_chart", {
			chart: {
				type: "bar"
			},
			colors: ["#9516cc"],
			title: {
				text: `Fee Collection (${new Date().getFullYear()})`
			},
			xAxis: {
				categories: Object.keys(fees)
			},
			yAxis: {
				min: 0,
				title: {
					text: "Fee Collected"
				}
			},
			legend: {
				reversed: true
			},
			plotOptions: {
				series: {
					stacking: "normal"
				}
			},
			series: [
				{
					name: "Fee Collection",
					data: [
						parseInt(fees.Jan),
						parseInt(fees.Feb),
						parseInt(fees.Mar),
						parseInt(fees.Apr),
						parseInt(fees.May),
						parseInt(fees.Jun),
						parseInt(fees.Jul),
						parseInt(fees.Aug),
						parseInt(fees.Sep),
						parseInt(fees.Oct),
						parseInt(fees.Nov),
						parseInt(fees.Dec)
					]
				}
			]
		});
	});
});