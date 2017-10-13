$().ready(function(){
	$("#cookies_header").addClass('visible');
	$('ul.services a').on('click', function(e){
		e.preventDefault();
		var el_data = $(this).data('id');
		if(service_status === 1){
			$('.section4').removeClass('detailservice');
		}
        var isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
        $(isFirefox?"html":"body").animate({ scrollTop: ( $('.section4').offset().top ) }, 1000, function(){
			console.log('animate');
			$('.service_nav_item[data-id="'+el_data+'"]').trigger("click");
		});
	});

	$('ul.members a').on('click', function(e){
		e.preventDefault();
		var el_data = $(this).data('id');
        var isFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') > -1;
        $(isFirefox?"html":"body").animate({ scrollTop: ( $('.section5').offset().top ) }, 1000, function(){
			$('.team_member[data-id="'+el_data+'"] .cross').trigger("click");
		});
	});
});

/** COOKIES **/
function getCookie(c_name){
	var c_value = document.cookie;
	var c_start = c_value.indexOf(" " + c_name + "=");
	if (c_start == -1){
		c_start = c_value.indexOf(c_name + "=");
	}
	if (c_start == -1){
		c_value = null;
	}else{
		c_start = c_value.indexOf("=", c_start) + 1;
		var c_end = c_value.indexOf(";", c_start);
		if (c_end == -1){
			c_end = c_value.length;
		}
		c_value = unescape(c_value.substring(c_start,c_end));
	}
	return c_value;
}

function setCookie(c_name,value,exdays){
	var exdate = new Date();
	exdate.setDate(exdate.getDate() + exdays);
	var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
	document.cookie=c_name + "=" + c_value;
}


function PonerCookie(){
	setCookie('show_cookies_message','1',365);
	$("#cookies_header").removeClass('visible');
}
/** FIN COOKIES **/