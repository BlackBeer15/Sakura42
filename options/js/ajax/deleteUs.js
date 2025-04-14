$('.delete-btn').click(function (e) {
	e.preventDefault();

	let idUs = $(this).attr('value');

	$.ajax({
		url: '../php/deleteUs.php',
		type: 'POST',
		dataType: 'json',
		data: {
			idUs: idUs,
		},

		success (data) {
			if (data.status == true) {
				location.reload()
			}
		}
	});
});