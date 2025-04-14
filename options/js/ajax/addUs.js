$('.send-us').click(function (e) {
	e.preventDefault();

	var sendData = new FormData();

		sendData.append('role', $('select[name="role"]').val());
		sendData.append('surname', $('input[name="surname"]').val());
		sendData.append('name', $('input[name="fname"]').val());
		sendData.append('login', $('input[name="login"]').val());
		sendData.append('password', $('input[name="password"]').val());


	$.ajax({
		url: '../php/addUs.php',
		type: 'POST',
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		data: sendData,

		success (data) {
			if (data.status == true) {
				$('.create-event-form')[0].reset();
                location.reload();

			} else {
				$('.alert-wrapper').css({'display':'flex'});
				$('.error-send').text(data.message);
			}
		}
	});
});