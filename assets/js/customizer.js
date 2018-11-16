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

    jQuery('.colorlib-single-template-wrapper img').click(function () {

        //declare arrays
        var contactLinkArray = ['template_16'];
        var socialLinksArray = ['template_11', 'template_14', 'template_15', 'template_16', 'template_19'];
        var contentArray = ['template_1', 'template_03', 'template_04', 'template_09', 'template_10', 'template_12', 'template_13', 'template_14', 'template_15', 'template_17', 'template_18', 'template_19', 'template_20'];
        var backBtnArray = ['template_01', 'template_04', 'template_05', 'template_06', 'template_07', 'template_08', 'template_09', 'template_10', 'template_11', 'template_12', 'template_13', 'template_14', 'template_15', 'template_16', 'template_17', 'template_18', 'template_19', 'template_20'];
        var negativeBackgroundColorArray = ['template_016'];

        //get control value
        var controlValue = jQuery(this).next('input').val();

        //get controls
        var contactLink = wp.customize.control('cnfp_settings[colorlib_404_customizer_contact_link]');
        var socialLinks = wp.customize.section('colorlib_404_customizer_social_settings');
        var contentControl = wp.customize.control('cnfp_settings[colorlib_404_customizer_content]');
        var backBtnControl = wp.customize.control('cnfp_settings[colorlib_404_customizer_button_text]');
        var backgroundColor = wp.customize.control('cnfp_settings[colorlib_404_customizer_background_color]');


        //do action
        if (jQuery.inArray(controlValue, contactLinkArray)) {
            contactLink.activate();
        } else {
            contactLink.deactivate();
        }

        if (jQuery.inArray(controlValue, socialLinksArray)) {
            socialLinks.activate();
        } else {
            socialLinks.deactivate();
        }

        if (jQuery.inArray(controlValue, contentArray)) {
            contentControl.activate();
        } else {
            contentControl.deactivate();
        }

        if (jQuery.inArray(controlValue, backBtnArray)) {
            backBtnControl.activate();
        } else {
            backBtnControl.deactivate();
        }

        if (jQuery.inArray(controlValue, negativeBackgroundColorArray)) {
            backgroundColor.deactivate();
        } else {
            backgroundColor.activate();
        }
    });
});



