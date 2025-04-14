$('.send-event').click(function (e) {
	e.preventDefault();

	var sendData = new FormData();

	sendData.append('cardPhoto', $('input[name="cardPhoto"')[0].files[0]);

		sendData.append('typeProd', $('select[name="typeProd"]').val());
		sendData.append('tittle', $('input[name="tittle"]').val());
		sendData.append('ingredients', $('textarea[name="ingredients"]').val());
		sendData.append('price', $('input[name="price"]').val());
		sendData.append('weight', $('input[name="weight"]').val());


	$.ajax({
		url: '../php/addProd.php',
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
				$('.create-event-form')[0].reset();

				$.ajax({
					url: '../php/takeMenu.php',
					type: 'POST',
					success: function(result) {
						$('.prod-wrapper').empty();
						let response = JSON.parse(result);
						for (let i=0; i<response.length; i++) {
							$('.prod-wrapper').append(
								'<div class="product-card"> <div class="card-image" style="background-image: url(../../'+response[i].photo+');"></div> <div class="info-product"> <p class="name-prod">'+response[i].nameProd+'</p> <p class="type-prod">'+response[i].typeProd+'</p> <p class="about-prod">'+response[i].aboutProd+'</p> <p class="price-weight">Цена: '+response[i].price+' ₽ Вес: '+response[i].weight+' гр.</p> <p class="who-when">'+response[i].nameUser+' '+response[i].surname+', '+response[i].createDate+'</p> </div> <div class="card-buttons"> <p class="delete-btn" value="'+response[i].idProduct+'"> Удалить </p> <a href="redactorProduct.php?id='+response[i].idProduct+'"> Редактировать </a> </div> </div>'
							);
						}
					}
				});

			} else {
				$('.alert-wrapper').css({'display':'flex'});
				$('.error-send').text(data.message);
			}
		}
	});
});