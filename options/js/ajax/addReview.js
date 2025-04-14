$('.send-rev').click(function (e) {
	e.preventDefault();

	var sendData = new FormData();

	    sendData.append('cardPhoto', $('input[name="cardPhoto"')[0].files[0]);

		sendData.append('mark', $('select[name="mark"]').val());
		sendData.append('tittle', $('input[name="tittle"]').val());
		sendData.append('rev', $('textarea[name="rev"]').val());
		sendData.append('datePub', $('input[name="datePub"]').val());


	$.ajax({
		url: '../php/addReview.php',
		type: 'POST',
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		data: sendData,

		success (data) {
			if (data.status == true) {
                location.reload()
				$('.create-event-form')[0].reset();
                location.reload()

			} else {
				$('.alert-wrapper').css({'display':'flex'});
				$('.error-send').text(data.message);
			}
		}
	});
});