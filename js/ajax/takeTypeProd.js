$('.typeBtn').click(function (e) {
	e.preventDefault();

	var typeProd = $(this).val();

	$.ajax({
		url: 'php/takeTypeProd.php',
		type: 'POST',
		data: {
			typeProd:typeProd
		},

		success: function(result) {
			$('.products-wrapper').empty();
			let response = JSON.parse(result);

			if (response.length === 0) {
				$('.products-wrapper').append(
					'<p class="sorry-but">Извините, но мы ещё не успели заполнить этот раздел :( </p>'
				);
			} else {
				for (let i=0; i<response.length; i++) {
					$('.products-wrapper').append(
						'<div class="product-card" id="'+response[i].idProduct+'"> <div class="card-image"> <img src="'+response[i].photo+'" /> </div> <div class="info-card-wrapper"> <p class="name-product">'+response[i].name+'</p> <p class="about-product"> '+response[i].aboutProd+' </p> <div class="button-price-card"> <button class="add-to-cart" id="'+response[i].idProduct+'">В корзину</button> <p>'+response[i].price+' ₽</p> </div> </div> </div>'
					);
				}
			}

			
		}
	});
});