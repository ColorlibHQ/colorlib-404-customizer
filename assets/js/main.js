jQuery(window).load(function ($) {
    jQuery('.colorlib-templates-wrapper input[type="radio"]').on('change', function () {
        var btn = jQuery(this);
        var parent = btn.parent('.colorlib-single-template-wrapper');
        if (btn.is(':checked')) {
            parent.addClass('active');
            jQuery('input[type="radio"]').not(btn).parent('.colorlib-single-template-wrapper').removeClass('active');
        }
    });
    jQuery('#accordion-section-colorlib_coming_soon_section_templates').attr('style', 'display:block !important;');
});