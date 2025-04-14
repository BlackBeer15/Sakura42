function showCart() {
    cart = JSON.parse(localStorage.getItem('cart'));

    if (cart !== undefined && cart !== null && Object.keys(cart).length !== 0) {
        $('.content-cart').empty();
        $('.empty-box').css({'display':'none'});

        $.ajax({
            url: 'php/getProductCart.php',
            type: 'POST',
            data: {
                cart: cart,
            },
    
            success: function(result) {
                $('.content-cart').empty();

                let response = JSON.parse(result);
                arr = response.flat();
                totalPrice = 0;

                for (let i=0; i<arr.length; i++) {
                    $('.content-cart').append(
                        '<div class="product-card"> <i class="fa-solid fa-trash delete-btn" id="'+arr[i].idProduct+'"></i> <div class="card-image"> <img src="'+arr[i].photo+'" /> </div> <div class="info-card-wrapper"> <p class="name-product">'+arr[i].name+'</p> <p class="about-product"> '+arr[i].price+' ₽/'+arr[i].weight+' г.</p><div class="amount-prod-card"> <button id="'+arr[i].idProduct+'" class="minus-prod">-</button> <p class="amount">'+cart[arr[i].idProduct]+'</p> <button id="'+arr[i].idProduct+'" class="plus-prod">+</button> </div> </div> </div>'
                    );
                }

                for (let k=0; k<arr.length; k++) {
                    totalPrice += arr[k].price * cart[arr[k].idProduct];
                }

                $('.price').empty();
                $('.price').append(totalPrice);
                correctPrice();                   
            }
        });

        $('.content-cart').on("click", ".delete-btn", deleteProduct);



    } else {
        $('.content-cart').empty();
        $('.empty-box').css({'display':'flex'});
        $('.amount-prod').css({'display':'none'});
        localStorage.removeItem('cart');
        totalPrice = 0;
        $('.price').empty();
        $('.price').append(totalPrice);
    }
}

function deleteProduct() {
    var idProd = $(this).attr('id');
    delete cart[idProd];
    saveCart();
    $('.amount-prod').html(Object.values(cart).reduce((a, b) => a + b, 0));
    showCart();
}

function plusProduct() {
    var idProd = $(this).attr('id');
    cart[idProd]++;
    saveCart();
    $('.amount-prod').html(Object.values(cart).reduce((a, b) => a + b, 0));
    showCart();
}

function minusProduct() {
    var idProd = $(this).attr('id');
    if (cart[idProd] == 1) {
        delete cart[idProd];
    } else {
        cart[idProd]--;
    }
    saveCart();
    $('.amount-prod').html(Object.values(cart).reduce((a, b) => a + b, 0));
    showCart();
}

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

$(document).ready(function () {
    showCart();
    $('.content-cart').on("click", ".plus-prod", plusProduct);
    $('.content-cart').on("click", ".minus-prod", minusProduct);
});
//  