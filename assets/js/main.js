jQuery(window).load(function ($) {
    jQuery('.colorlib-templates-wrapper input[type="radio"]').on('change', function () {
        var btn = jQuery(this);
        var parent = btn.parent('.colorlib-single-template-wrapper');
        if (btn.is(':checked')) {
            parent.addClass('active');
            jQuery('input[type="radio"]').not(btn).parent('.colorlib-single-template-wrapper').removeClass('active');
        }
    });
    jQuery('#accordion-section-colorlib_404_customizer_template_selection').attr('style', 'display:block !important;');
});