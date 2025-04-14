$('select[name="typeDelivery"]').change(function () {

	let typeDelivery = $(this).val();

    if (typeDelivery == 'Самовывоз') {
        $('.address-wrapper').css({'display':'none'});
        $('.cook-to-time').css({'display':'block'});
    } else {
        $('.cook-to-time').css({'display':'none'});
        $('.address-wrapper').css({'display':'block'});
    }
});