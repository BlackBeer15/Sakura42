$('.delete-btn').click(function (e) {
	e.preventDefault();

	let idReview = $(this).attr('value');

	$.ajax({
		url: '../php/deleteReview.php',
		type: 'POST',
		dataType: 'json',
		data: {
			idReview: idReview,
		},

		success (data) {
			if (data.status == true) {
				location.reload()
			}
		}
	});
});