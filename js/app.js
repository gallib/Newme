(function($){


    function sendContact()
    {
        var isPending;

        if (!$('#contact-form').length) {
            return;
        }

        $('#contact-form').submit(function() {
            $('.form-error').remove();
            $('.error').removeClass('error');

            if (isPending) {
                isPending.abort();
            }

            isPending = $.ajax({
                url : newme.ajax_url,
                type: 'post',
                data: $(this).serialize()
            }).success(function(response){
                if (response.success == true) {
                    $('.contact-form-wrapper').html('<p>' + response.data.message + '</p>');
                } else {
                    if (response.data) {
                        if (response.data.required_fields) {
                            $.each(response.data.required_fields, function (i, e) {
                                $('#' + e).addClass('error').after('<small class="form-error error">' + newme.contact_mandatory_field + '</small>');
                            });
                        }

                        if (response.data.errors) {
                            $.each(response.data.errors, function (element, error) {
                                $('#' + element).addClass('error').after('<small class="form-error error">' + error + '</small>');
                            });
                        }
                    }
                }

            });

            return false;
        });
    }

    $(document).foundation({
        topbar: {
            custom_back_text: true,
            back_text: newme.menu_back
        }
    });

    $(document).ready(function(){
        sendContact();
    });
})(jQuery);