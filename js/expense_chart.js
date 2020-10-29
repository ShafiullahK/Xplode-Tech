$("document").ready(function() {
	$.get("lib/get_monthly_expense_record.php", { type: "expenses" }, function(res) {
		
		const expenses = JSON.parse(res);

		Highcharts.chart("expense_chart", {
			chart: {
				type: "area"
			},
			colors: ["#e5144c"],
			title: {
				text: `Expenses (${new Date().getFullYear()})`
			},
			xAxis: {
				categories: Object.keys(expenses)
			},
			yAxis: {
				min: 0,
				title: {
					text: "Amount spent on expenses"
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
					name: "Expenses",
					data: [
						parseInt(expenses.Jan),
						parseInt(expenses.Feb),
						parseInt(expenses.Mar),
						parseInt(expenses.Apr),
						parseInt(expenses.May),
						parseInt(expenses.Jun),
						parseInt(expenses.Jul),
						parseInt(expenses.Aug),
						parseInt(expenses.Sep),
						parseInt(expenses.Oct),
						parseInt(expenses.Nov),
						parseInt(expenses.Dec)
					]
				}
			]
		});
	});
});