function team_vw(){
    if($(window).width() < 768){
        return '90vw';
    }else{
        return '50vw';
    }
}

$().ready(function() {
    var slide_status = 0;
    var obj_position = 0;
    var selected_box = null;

    $(window).resize(function() {
        if(slide_status == 1) {
            selected_box.css({
                top: ($(window).height()/2) - (selected_box.outerHeight(true) /2),
                left: ($('#team_images').position().left),
            });
        }
    });
    $('#team_images .team_member').hover(function() {
        $(this).find('.cross').css('opacity',0.4);
    }, function() {
        $(this).find('.cross').css('opacity',1);
    });
    $('#team_images .cross, #team_images .team_memeber_name, #team_images .team_member_short_description').click(function() {
        var obj = $(this).closest('.team_member');
        if(slide_status == 0) {
            slide_status = 2; // Block animations
            obj_position = obj.position();
            $('#team_cv_content').remove();
            $('#team_images').after($('<div id="team_cv_content"><div class="scrollbar_container"><div class="up_gradient"></div><div class="scrollbar_box default-skin"></div><div class="down_gradient"></div></div></div>'));
            $('#team_cv_content .scrollbar_container .scrollbar_box').html(team_cv[obj.data('id')]);
            $('#team_cv_content .scrollbar_container .scrollbar_box').customScrollbar({preventDefaultScroll: true, updateOnWindowResize: true});
            $('#team_cv_content .scroll-bar').append("<div class='scrollbar_backline'></div>");
            $("#team_cv_content .scrollbar_container .scrollbar_box").on("customScroll", function(event, scrollData) {
                if(scrollData.scrollPercent>0) {
                    $('#team_cv_content .up_gradient').show();
                } else {
                    $('#team_cv_content .up_gradient').hide();
                }
                if(scrollData.scrollPercent<100) {
                    $('#team_cv_content .down_gradient').show();
                } else {
                    $('#team_cv_content .down_gradient').hide();
                }
            });
            obj.siblings().animate({opacity: 0.01}, function() {
                obj.css({display: 'block', position: 'absolute', top: obj_position.top, left: obj_position.left, width: '33.3333%'});
                obj.animate({top: ($(window).height()/2) - (obj.outerHeight(true) /2)});
                obj.find('.cross').rotate({
                    duration: 500,
                    angle: 0,
                    animateTo: 45
                });
            });
            selected_box = obj;
            $('#team_slide').animate({left: "-="+team_vw()}, 1000, function() {
                slide_status = 1;
            });
        } else if(slide_status == 1) {
            slide_status = 2; // Block animations
            selected_box.animate({top: obj_position.top}, function() {
                selected_box.removeAttr( 'style' );
                selected_box.siblings().animate({opacity: 1});
                selected_box.find('.cross').rotate({
                    duration: 500,
                    angle: 45,
                    animateTo: 0
                });
            });
            $('#team_slide').animate({left: "+="+team_vw()}, 1000, function() {
                slide_status = 0;
            });
        }
    });
});