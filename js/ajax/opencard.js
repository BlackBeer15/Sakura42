$('.products-wrapper').on("click", ".card-image", function(e) { 
	e.preventDefault();

    var idProduct = $(this).parent('.product-card').attr('id');

    $('html').css({'overflow':'hidden'});
    $('.open-card-wrapper').css({'display':'flex'});

    $.ajax({
		url: 'php/openCard.php',
		type: 'POST',
		data: {
			idProduct: idProduct,
		},

		success: function(result) {
			$('.open-card-wrapper').empty();
			let response = JSON.parse(result);
			for (let i=0; i<response.length; i++) {
				$('.open-card-wrapper').append(
					'<div class="open-product-card" id="'+response[i].idProduct+'"> <i class="fa-solid fa-xmark"></i> <div class="card-image"> <img src="'+response[i].photo+'" /> </div> <div class="info-card-wrapper"> <p class="name-product">'+response[i].name+'</p> <p class="about-product">'+response[i].aboutProd+'</p><div class="button-price-card"> <button class="add-to-cart" id="'+response[i].idProduct+'">В корзину</button> <p>'+response[i].price+' ₽</p> </div> <p class="weight"> '+response[i].weight+' г. </p> </div> </div> <script type="text/javascript">$(".fa-xmark").click(function () { $("html").css({"overflow":"auto"}); $(".open-card-wrapper").css({"display":"none"}); });</script>'
				);
			}
		}
    });
});

//  