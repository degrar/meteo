
function change_image(this_element){
	old_el = $('.service_nav .show');
	image_selected = $(this_element).data('image');			
	new_el = $(this_element);
	$('.service_nav_item').removeClass('show');
	$(this_element).addClass('show');
	$('.'+ old_el.data('image')).removeClass('show').addClass('hide');
	$('.'+ new_el.data('image')).removeClass('hide').addClass('show');
	old_el = $(this_element);
}

function change_content_section(content_service,title_service){
	$('.service_content').empty();
	$('.col2 span.title').empty();
	$('#services_container .scrollbar_container').remove();
	$('#services_container .separation_line').after('<div class="scrollbar_container"><div class="up_gradient"></div><div class="scrollbar_box default-skin"><p class="service_content"></p></div><div class="down_gradient"></div></div>');
	$('#services_container .service_content').html(content_service);
	$('.col2 span.title').html(title_service);
	$('#services_container .scrollbar_box').customScrollbar({
       preventDefaultScroll: true,
       updateOnWindowResize: true,
    });

	$('#services_container .scroll-bar').append("<div class='scrollbar_backline'></div>");

 	$("#services_container .container").on("customScroll", function(event, scrollData) {
        if(scrollData.scrollPercent>0) {
            $('#services_container .up_gradient').show();
        } else {
            $('#services_container .up_gradient').hide();
        }
        if(scrollData.scrollPercent<100) {
            $('#services_container .down_gradient').show();
        } else {
            $('#services_container .down_gradient').hide();
        }
    });
}

function move_section(el1, class2){
	if($(el1).hasClass(class2)){
		$(el1).removeClass(class2);
	}else{
		$(el1).addClass(class2);
	}
}

var service_status = 0;
$(document).ready(function(){
	Object.keys(services_img).map(function(key){
		(new Image()).src =  services_img[key];
	});

    var viewportWidth = $(window).width();
    $('.service_img img').first().css( 'opacity','1');

	$('.show_service').on('click', function(){
		move_section('.section4','detailservice');
		service_status = 0;
	});
    $('.service_nav_item').hover(function(){

		a_img_selected = $(this).data('image');

		$('.service_img').css('background-image', 'url(' + a_img_selected + ')');
	});

	$('.service_nav_item').on('click',function(){
		move_section('.section4','detailservice');
		id_el = 'id_'+$(this).data('id');
		service_title = $(this).text();
		change_content_section(services_content[id_el], service_title);
		service_status = 1;
	});
});
