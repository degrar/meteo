$().ready( function() {
    $('#contact_us form').submit(function(event) {
        event.preventDefault();
        var data = [];
        $("#contact_us input[type=text], #contact_us input[type=hidden], #contact_us textarea").each(function() {
            if($(this).data('placeholder')!=$(this).val()) data.push($(this).attr('name')+"="+$(this).val());
            else data.push($(this).attr('name')+"=");
        });
        if($("#checkboxform").is(':checked')) data.push("form_terms_and_conditions=true");
        data = data.join("&");
        console.log(data);
        $.ajax($(this).attr('action'), {
            method: $(this).attr('method'),
            data: data,
            success: function () {
                $("#contact_us input[type=submit]").remove();
            },
            error: function(jqXHR, text_status, error_thrown) {
                var errors = JSON.parse(jqXHR.responseText);
                for(var input_name in errors) {
                    var input = $('#contact_us form [name=' + input_name + ']');
                    if(input_name=="form_terms_and_conditions") {
                        $('label.lite-x-gray, label.lite-x-gray a').css({color:"red"});
                    } else {
                        input.toggleClass('validation_error');
                    }
                }
            }
        });
    });
});