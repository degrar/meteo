$().ready(function () {
    $('#slider_about_us').slick({
        infinite: true,
        autoplay: true,
        autoplaySpeed: 10000,
        draggable: true,
        pauseOnFocus: false,
        pauseOnHover: false,
        arrows: true,
        dots: false,
        fade: true,
        nextArrow: '<i class="slick-arrow slick-next fa fa-angle-right"></i>',
        prevArrow: '<i class="slick-arrow slick-prev fa fa-angle-left"></i>',
    }).on('afterChange', function (slick, currentSlide, nextSlide) {
        $('#slider_about_us .slide_page_number').html(currentSlide.currentSlide + 1);
    });

    $('#slider_about_us .slick-arrow.slick-next').after(
        '<span class="slide_counter"><span class="slide_page_number">1</span> / ' +
        $("#slider_about_us .slide").length +
        '</span>'
    );

    var onResize = function () {
        var counterHeight = $('#slider_about_us .slide_counter').height();
        var arrowHeight = $('#slider_about_us .slick-arrow.slick-next').height();
        if(typeof($('#slider_about_us .slick-next').position())!="undefined")
        {
            $('#slider_about_us .slide_counter').css({
                top: $('#slider_about_us .slick-next').position().top + ((arrowHeight - counterHeight) / 2)
            });
        }
    };
    $(window).resize(onResize);
    onResize();
});