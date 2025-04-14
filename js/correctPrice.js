    function correctPrice() {
        area = $('input[name="settlement"]').val();

        switch (area) {
            case 'р-н Кузнецкий':
                if (totalPrice < 800) {
                    newPrice = totalPrice + 150;
                    $('.new-price').empty();
                    $('.new-price').append(newPrice);
                    $('.delivery-price').empty();
                    $('.delivery-price').append('150');
                } else {
                    $('.new-price').empty();
                    $('.new-price').append(totalPrice);
                    $('.delivery-price').empty();
                    $('.delivery-price').append('0');
                }
                break;
            case 'р-н Орджоникидзевский':
                if (totalPrice < 1800) {
                    newPrice = totalPrice + 250;
                    $('.new-price').empty();
                    $('.new-price').append(newPrice);
                    $('.delivery-price').empty();
                    $('.delivery-price').append('250'); 
                } else {
                    $('.new-price').empty();
                    $('.new-price').append(totalPrice);
                    $('.delivery-price').empty();
                    $('.delivery-price').append('0');
                }
                break;
            case 'р-н Центральный':
                if (totalPrice < 1700) {
                    newPrice = totalPrice + 200;
                    $('.new-price').empty();
                    $('.new-price').append(newPrice);
                    $('.delivery-price').empty();
                    $('.delivery-price').append('200'); 
                } else {
                    $('.new-price').empty();
                    $('.new-price').append(totalPrice);
                    $('.delivery-price').empty();
                    $('.delivery-price').append('0');
                }
                break;
            case 'р-н Заводской':
                if (totalPrice < 2000) {
                    newPrice = totalPrice + 250;
                    $('.new-price').empty();
                    $('.new-price').append(newPrice);
                    $('.delivery-price').empty();
                    $('.delivery-price').append('250'); 
                } else {
                    $('.new-price').empty();
                    $('.new-price').append(totalPrice);
                    $('.delivery-price').empty();
                    $('.delivery-price').append('0');
                }
                break;
            case 'р-н Новоильинский':
                if (totalPrice < 2000) {
                    newPrice = totalPrice + 350;
                    $('.new-price').empty();
                    $('.new-price').append(newPrice);
                    $('.delivery-price').empty();
                    $('.delivery-price').append('350');
                } else {
                    $('.new-price').empty();
                    $('.new-price').append(totalPrice);
                    $('.delivery-price').empty();
                    $('.delivery-price').append('0');
                }
                break;
            default:
                $('.new-price').empty();
                $('.new-price').append(totalPrice);
        }
    }

    $('#street').blur(function() {
        correctPrice();
    });
