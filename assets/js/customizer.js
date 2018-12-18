jQuery(window).load(function () {

    jQuery('textarea.js-cnfp-editor').each(function () {
        var textareaId = jQuery(this).attr('id');
        var textareaEditor = jQuery(this);

        wp.editor.initialize(textareaId, {
            tinymce: {
                wpautop: true,
                browser_spellcheck: true,
                mediaButtons: false,
                wp_autoresize_on: true,
                toolbar1: 'bold,italic,link,strikethrough',
                setup: function (editor) {
                    editor.on('change', function () {
                        editor.save();
                        jQuery(textareaEditor).trigger('change');
                    });
                }
            },
            quicktags: true
        });
    });

    wp.customize.panel('colorlib_404_customizer_panel', function (section) {
        section.expanded.bind(function (isExpanding) {
            var loginURL = CNFPurls.siteurl + '?colorlib-404-customization=true';
            // Value of isExpanding will = true if you're entering the section, false if you're leaving it.
            if (isExpanding) {
                wp.customize.previewer.previewUrl.set(loginURL);
            } else {
                wp.customize.previewer.previewUrl.set(CNFPurls.siteurl);

            }
        });
    });

    jQuery('#accordion-section-colorlib_404_customizer_template_selection button.change-theme').bind('click',function(){
        jQuery('#sub-accordion-section-colorlib_404_customizer_template_selection').toggleClass('cnfp_section_show');
    });

});



