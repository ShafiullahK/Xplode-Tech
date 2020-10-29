$(document).ready(function() {
	const date = $("#att-date").val();

	$("#mark-attendence").click(function() {
		if ($(".attendence-table td").hasClass("holiday-td")) {
			alert("Already marked as holiday");
			return;
		}

		const checked = document.querySelectorAll("input[type=radio]:checked");
		const studentAttendences = [];

		checked.forEach(c => {
			studentAttendences.push(c.value);
		});

		$.ajax({
			type: "post",
			url: "lib/attendence/mark_attendence.php",
			dataType: "html",
			data: { studentAttendences, date },
			beforeSend: function() {
				$("#mark-attendence").attr("disabled", true);
				$("#mark-attendence").prepend(
					'<span class="spinner-border spinner-border-sm"></span>'
				);
			},
			success: function(res) {
				$("#mark-attendence").removeAttr("disabled");
				$("#mark-attendence span").fadeOut();
			}
		});
	});

	// mark as holiday
	$("#mark-as-hd").click(function() {
		if (confirm("Are you sure ?")) {
			$.ajax({
				type: "post",
				url: "lib/attendence/mark_as_holiday.php",
				dataType: "html",
				data: { date },
				beforeSend: function() {
					$("#mark-as-hd").attr("disabled", true);
					$("#mark-as-hd").prepend(
						'<span class="spinner-border spinner-border-sm"></span>'
					);
                },
				success: function(res) {
                    if ($(".attendence-table td").hasClass("holiday-td")) {
                        alert("Already marked as holiday");
                        window.location.reload();
                        return;
                        
                    }
					$("#mark-as-hd").removeAttr("disabled");
					$("#mark-as-hd span").fadeOut();
					$("#result").html(res);
					window.location.reload();
				}
			});
		}
	});
});