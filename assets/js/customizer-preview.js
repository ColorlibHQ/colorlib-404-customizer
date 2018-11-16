(function ($) {

    //Page heading preview
    wp.customize('cnfp_settings[colorlib_404_customizer_page_heading]', function (text) {
        text.bind(function (textValue) {
            console.log(textValue);
            jQuery('#colorlib_404_customizer_page_heading').html(textValue);
        });
        ;
    });

    //Page content preview
    wp.customize('cnfp_settings[colorlib_404_customizer_content]', function (text) {
        text.bind(function (textValue) {
            jQuery('#colorlib_404_customizer_content').html(textValue);
        });
    });

    //Page footer preview
    wp.customize('cnfp_settings[colorlib_404_customizer_button_text]', function (text) {
        text.bind(function (textValue) {
            jQuery('#colorlib_404_customizer_button_text').html(textValue);
        });
    });

    //social links preview
    jQuery('#sub-accordion-section-colorlib_404_customizer_social_settings').find('input').each(function () {
        var controllerID = jQuery(this).attr('data-customize-setting-link');
        wp.customize(controllerID, function (text) {
            text.bind(function (textValue) {
                jQuery('#' + controllerID).html(textValue);
            });
        });
    });


})(jQuery);

