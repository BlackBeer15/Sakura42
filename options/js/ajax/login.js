$('.logbtn').click(function (e) {
	e.preventDefault();

	let login = $('input[name="login"]').val(),
		password = $('input[name="password"]').val();

	$.ajax({
		url: './php/log.php',
		type: 'POST',
		dataType: 'json',
		data: {
			login: login,
			password: password
		},

		success (data) {
			if (data.status == true) {
				document.location.href = 'profile.php';
			} else {
				$('.error-form').text(data.message);
			}
		}
	});
});