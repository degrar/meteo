$().ready(function () {
    $('#slider_top').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 10000,
        draggable: true,
        pauseOnFocus: false,
        pauseOnHover: false,
        arrows: false,
        dots: true,
        fade: true,
        customPaging: function(slider, i) {
            return '<svg version="1.1" id="dot_'+i+'" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve"><circle class="circle" style="display:none;" fill="none" stroke="#000000" stroke-width="1.3" stroke-miterlimit="10" cx="10" cy="10" r="9"/><circle class="dot" cx="10" cy="10" r="3.25"/></svg>';
        }
    });


    $('#slider_top .subtitle').after('<span class="small_line"></span>');

    var position_dots_top = function () {
        var slick_dots = $('#slider_top .slick-dots');
        if (slick_dots.length > 0) {
            slick_dots.css(
                'bottom',
                $('#slider_top .slick-dots').position().bottom + 100
            );
        }
    };
    position_dots_top();

    $(window).resize(function () {
        var ratio = $(window).width() / $(window).height();
        if (ratio > 2.4) {
            $('#slider_top .slick-dots').hide();
        } else {
            $('#slider_top .slick-dots').show();
            position_dots_top();
        }
    });

    $('#slider_top').append(
        '<div class="scroll_down_box">' +
            '<span class="scroll_white_box"><span>scroll down</span></span>' +
            '<span class="scroll_down_arrow fa fa-angle-down"></span>' +
        '</div>'
    );
    
    $('#slider_top .scroll_down_box').click(function() {
        var isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
        $(isFirefox?"html":"body").animate({
            scrollTop: $('.section2').offset().top
        }, 1000);
    }).hover(function() {
        $('#slider_top .scroll_down_box .scroll_white_box span').css({opacity: 0.6});
    }, function() {
        $('#slider_top .scroll_down_box .scroll_white_box span').css({opacity: 1});
    });
});