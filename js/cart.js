var cart = {}; 



$(document).ready(function () {
    loadCart();
    $('.products-wrapper').on("click", ".add-to-cart", addProduct);
    $('.open-card-wrapper').on("click", ".add-to-cart", addProduct);
});

function animateCart() {
    $('.amount-prod').animate({
        width: '35px',
        height: '35px',
        top: '-15px',
        right: '-20px'
    }, 250, function() {
        
    });

    $('.amount-prod').animate({
        width: '25px',
        height: '25px',
        top: '-5px',
        right: '-10px'
    }, 250, function() {
        
    });
}

function addProduct() {
    var idProd = $(this).attr('id');

        if (cart[idProd] == undefined) {
            cart[idProd] = 1;
        } else {
            cart[idProd]++;
        }

        $('.amount-prod').css({'display':'flex'});
        $('.amount-prod').html(Object.values(cart).reduce((a, b) => a + b, 0));
        animateCart();
        saveCart();
}

function saveCart() {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function loadCart() {
    if (localStorage.getItem('cart')) {
        cart = JSON.parse(localStorage.getItem('cart'));
        $('.amount-prod').html(Object.values(cart).reduce((a, b) => a + b, 0));
        $('.amount-prod').css({'display':'flex'});
    }
}