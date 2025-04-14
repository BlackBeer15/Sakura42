$('.prod-wrapper').on("click", ".delete-btn", function(e) { 
	e.preventDefault();

	let idProduct = $(this).attr('value');

	$.ajax({
		url: '../php/deleteProd.php',
		type: 'POST',
		dataType: 'json',
		data: {
			idProduct: idProduct,
		},

		success (data) {
			if (data.status == true) {
				$('.alert-wrapper').css({'display':'flex'});
				$('.error-send').text(data.message);

                $.ajax({
					url: '../php/takeMenu.php',
					type: 'POST',
					success: function(result) {
						$('.prod-wrapper').empty();
						let response = JSON.parse(result);
						for (let i=0; i<response.length; i++) {
							$('.prod-wrapper').append(
								'<div class="product-card"> <div class="card-image" style="background-image: url(../../'+response[i].photo+');"></div> <div class="info-product"> <p class="name-prod">'+response[i].nameProd+'</p> <p class="about-prod">'+response[i].aboutProd+'</p> <p class="price-weight">Цена: '+response[i].price+' ₽ Вес: '+response[i].weight+' гр.</p> <p class="who-when">'+response[i].nameUser+' '+response[i].surname+', '+response[i].createDate+'</p> </div> <div class="card-buttons"> <p class="delete-btn" value="'+response[i].idProduct+'"> Удалить </p> <a href="redactorProduct.php?id='+response[i].idProduct+'"> Редактировать </a> </div> </div>'
							);
						}
					}
				});
			}
		}
	});
});