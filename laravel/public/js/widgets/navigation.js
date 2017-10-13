var page_number;
var window_h;
var position = $(window).scrollTop();
var current_page = 0;
var keys = {38: 1, 40: 1};
var scroll_active = false;
var wheeling;

function debounce(func, wait, immediate) {
    var timeout;           
    return function() {
        var context = this, 
            args = arguments;
        var callNow = immediate && !timeout;
        clearTimeout(timeout); 
        timeout = setTimeout(function() {
             timeout = null;
             if (!immediate) {
               func.apply(context, args);
             }
        }, wait);
        if (callNow) func.apply(context, args);  
    }; 
};

function scroll_to_anchors(){
    $('.scroll_to').on('click',function(e){
        main_menu_toggle_height = $('.main_menu_toggle').outerHeight();
        scroll_to_el= $(this).data('scroll_to');
        e.preventDefault();
        var position_top = $('.' + scroll_to_el).offset().top - main_menu_toggle_height;
        $("html, body").animate({ scrollTop: position_top }, 800, function(){
            $('.main_menu_toggle').animate({marginTop: '-' + main_menu_toggle_height +'px'}, 800);
            $('body').animate({paddingTop: '0px'}, 800);           
            $('.c-hamburger').removeClass('is-active');
            position_page( false );
        });     
    });
};

position_page = function(move){
    move = typeof move !== 'undefined' ? move : true;
    window_h = $(window).height();
    current_page = Math.round($(window).scrollTop() / window_h);
    if(move) $(window).scrollTop(page_number * window_h);
};

function preventDefault(e) {
    e = e || window.event;
    if (e.preventDefault)
        e.preventDefault();
    e.returnValue = false;  
}

function menu_toggle(){
    $('.main_menu_fixed').toggleClass('minimal_menu');

}

var scrolltop = function(){
    var windowHeight = $(window).height();
    var isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
    var isSafari = navigator.userAgent.toLowerCase().indexOf('safari') > -1;
    var isiOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
    if(isiOS && isSafari) {
        windowHeight = window.screen.height - (navigator.standalone?0:32);
    }
    $(isFirefox?"html":"body").animate({ scrollTop: windowHeight * current_page }, 800, function(){scroll_active = false;});
};

function preventDefaultForScrollKeys(e) {
    if (keys[e.keyCode]) {
        preventDefault(e);
        if(e.keyCode == 40 && !scroll_active && current_page < 5){
            scroll_active = true;
            current_page++;
            if(current_page==1) menu_toggle();
            scrolltop();
        }else if((e.keyCode == 38 && !scroll_active && current_page > 0)||( e.deltaY < 0 && !scroll_active && current_page > 0 )){
            scroll_active = true;
            current_page--;
            if(current_page==0) menu_toggle();
            scrolltop();
        }
        return false;
    }
}

function scroll(e){
    if($(e.target).parents('.scrollbar_box').length > 0){
        return;
    }
    if(!wheeling) {
        if(e.deltaY > 0 && !scroll_active && current_page < number_of_sections){
            scroll_active = true;
            current_page++;
            if(current_page==1) menu_toggle();
            scrolltop();
        } else if((e.deltaY < 0 && !scroll_active && current_page > 0)||( e.deltaY < 0 && !scroll_active && current_page > 0)){
            scroll_active = true;
            current_page--;
            if(current_page==0) menu_toggle();
            scrolltop();
        }
    }
    clearTimeout(wheeling);
    wheeling = setTimeout(function() {
        wheeling = undefined;
    }, 250);

    e = e || window.event;
    if (e.preventDefault)
    e.preventDefault();
    e.returnValue = false;
}

function isSizeMobile(){
    if($(window).width() < 768)
    return true;
}

function disableScroll() {
    if (window.addEventListener) // older FF
        window.addEventListener('DOMMouseScroll', scroll, false);
    window.onwheel = scroll; // modern standard
    window.onmousewheel = document.onmousewheel = scroll; // older browsers, IE
    window.ontouchmove  = scroll; // mobile
    document.onkeydown  = preventDefaultForScrollKeys;
    $("section, footer").swipe( {
        swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
            if(direction=="up") {
                scroll_active = true;
                current_page++;
                if(current_page==1) menu_toggle();
                scrolltop();
                event.preventDefault();
            } else if(direction=="down") {
                scroll_active = true;
                current_page--;
                if(current_page==0) menu_toggle();
                scrolltop();
                event.preventDefault();
            }
        }
    } );
}

function enableScroll() {
    if (window.removeEventListener)
    window.removeEventListener('DOMMouseScroll', preventDefault, false);
    window.onmousewheel = document.onmousewheel = null;
    window.onwheel = null;
    window.ontouchmove = null;
    document.onkeydown = null;
}

function calcSizeMobile() {
    if(isSizeMobile()){
        number_of_sections = 6;
    }else{
        number_of_sections = 5;
    }
}

$(document).ready(function(){
    calcSizeMobile();
    if(window.simple_scroll == undefined || window.simple_scroll == false) {
        disableScroll();
    } else {
        $('body, html').css('overflow-y','auto');
    }
});

$(document).ready(function(){
    main_menu_toggle_height = $('.main_menu_toggle').outerHeight();
    scroll_to_anchors();
    $('.main_menu_toggle').css('margin-top', '-'+ main_menu_toggle_height +'px');
    $('.c-hamburger').on('click', function(){        
        if(!$('.c-hamburger').hasClass('is-active')){
            $('.main_menu_toggle').animate({ marginTop: '0px' }, 800);   
            $('body').animate({paddingTop: main_menu_toggle_height +'px'}, 800);
            $(this).addClass('is-active');           
        }else{
            $('.main_menu_toggle').animate({marginTop: '-' + main_menu_toggle_height +'px'}, 800);
            $('body').animate({paddingTop: '0px'}, 800);           
            $('.c-hamburger').removeClass('is-active');    
        }
    });
    position_page();
});

// acabar de encapsular bien la funcion
$(window).resize(function(){
    calcSizeMobile();
    main_menu_toggle_height = $('.main_menu_toggle').outerHeight();
    $('.main_menu_toggle').css('margin-top', '-'+ main_menu_toggle_height +'px');
});

$(window).on('resize',position_page);