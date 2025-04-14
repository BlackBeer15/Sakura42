$(document).ready(function(){  

    if ($(window).scrollTop() > 40) {
        $('header').addClass("head-active");
        $('.logo').addClass("logo-active");
    } else {
        $('header').removeClass("head-active");
        $('.logo').removeClass("logo-active");
    }

    $(window).on("scroll", function(){
        if ($(window).scrollTop() > 40) {
            $('header').addClass("head-active");
            $('.logo').addClass("logo-active");
        } else {
            $('header').removeClass("head-active");
            $('.logo').removeClass("logo-active");
        }
    });
});