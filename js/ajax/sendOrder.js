$(document).ready(function() {
    
    $('.fa-xmark').click(function () {
        $('.alert-wrapper').css({'display':'none'});
        $('html').css({'overflow':'auto'});
    });
    
    $('.alert-wrapper').click(function () {
        $('.alert-wrapper').css({'display':'none'});
        $('html').css({'overflow':'auto'});
    });

    $('.send-chek').click(function (e) {
        e.preventDefault();
        area = $('input[name="settlement"]').val();

        if (area == "р-н Куйбышевский" || area == "село Ильинка") {
            viewAlert('К сожалению, в данный район пока что нет доставки :(');
        } else {
            if (cart != undefined && localStorage.getItem('cart') && totalPrice != 0) {
                
                userName = $('input[name="nameUser"]').val();
                phone = $('input[name="phone"]').val();
                totalPrice = $('.price').text();
                typeDelivery = $('select[name="typeDelivery"]').val();

                if (typeDelivery == 'Доставка') {
                    street = $('input[name="street"]').val();
                    home = $('input[name="home"]').val();
                    korpus = $('input[name="korpus"]').val();
                    entrance = $('input[name="entrance"]').val();
                    floor = $('input[name="floor"]').val();
                    appartament = $('input[name="appartament"]').val();
                    homePhone = $('input[name="homePhone"]').val();
                    typePayment = $('select[name="typePayment"]').val();

                    if (userName.trim() != '' && phone.trim() != '' && street.trim() != '' && home.trim() !='') {
                        $.ajax({
                            url: 'php/sendOrder.php',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                cart: cart,
                                userName: userName,
                                phone: phone,
                                typeDelivery: typeDelivery,
                                street: street,
                                home: home,
                                korpus: korpus,
                                entrance: entrance,
                                floor: floor,
                                appartament: appartament,
                                homePhone: homePhone,
                                typePayment: typePayment,
                                area: area
                            },
                            success (data) {
                                if (data.status == true) {
                                    $('.set-order')[0].reset();
                                    localStorage.removeItem('cart');
                                    $('.content-cart').empty();
                                    $('.empty-box').css({'display':'flex'});
                                    $('.amount-prod').css({'display':'none'});
                                    localStorage.removeItem('cart');
                                    totalPrice = 0;
                                    $('.price').empty();
                                    $('.price').append(totalPrice);
                                    viewAlert(data.message);
                                } else {
                                    viewAlert(data.message);
                                }
                            }
                        });
                    } else {
                        viewAlert('Все обязательные поля* должны быть заполнены!');
                    }

                } else if (userName.trim() != '' && phone.trim() != '') {
                    cookTime = $('input[name="cookTime"]').val();
                    
                    if (cookTime.trim() == '' || cookTime==undefined) {
                        cookTime = 'Необходимо уточнить';
                    }

                    $.ajax({
                        url: 'php/sendOrder.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            cart: cart,
                            userName: userName,
                            phone: phone,
                            totalPrice: totalPrice,
                            typeDelivery: typeDelivery,
                            cookTime: cookTime,
                        },
                        success (data) {
                            if (data.status == true) {
                                $('.set-order')[0].reset();
                                localStorage.removeItem('cart');
                                totalPrice = 0;
                                $('.price').empty();
                                $('.price').append(totalPrice);
                                viewAlert(data.message);
                            } else {
                                viewAlert(data.message);
                            }
                        }
                    });
                } else {
                    viewAlert('Все обязательные поля* должны быть заполнены!');
                }
            } else {
                viewAlert('Козина пуста!');
            }
        }
    });

    function viewAlert (message) {
        $('html').css({'overflow':'hidden'});
        $('.alert-wrapper').css({'display':'flex'});
        $('.error-send').text(message);
    }
});