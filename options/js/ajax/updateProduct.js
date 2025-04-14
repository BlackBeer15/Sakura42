$('.send-event').click(function (e) {
	e.preventDefault();

	var sendData = new FormData();

		sendData.append('typeProd', $('select[name="typeProd"]').val());
		sendData.append('tittle', $('input[name="tittle"]').val());
		sendData.append('ingredients', $('textarea[name="ingredients"]').val());
		sendData.append('price', $('input[name="price"]').val());
		sendData.append('weight', $('input[name="weight"]').val());
        sendData.append('idProduct', $('input[name="idProduct"]').val());


	$.ajax({
		url: '../php/updateProd.php',
		type: 'POST',
		cache: false,
		contentType: false,
		processData: false,
		dataType: 'json',
		data: sendData,

		success (data) {
			if (data.status == true) {
				$('.alert-wrapper').css({'display':'flex'});
				$('.error-send').text(data.message);
			} else {
				$('.alert-wrapper').css({'display':'flex'});
				$('.error-send').text(data.message);
			}
		}
	});
});