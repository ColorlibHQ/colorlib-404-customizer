jQuery(window).load(function () {
    jQuery('textarea.js-ccsm-editor').each(function () {
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

    wp.customize.panel('colorlib_coming_soon_general_panel', function (section) {
        section.expanded.bind(function (isExpanding) {
            var loginURL = CCSMurls.siteurl + '?colorlib-coming-soon-customization=true';

            // Value of isExpanding will = true if you're entering the section, false if you're leaving it.
            if (isExpanding) {
                wp.customize.previewer.previewUrl.set(loginURL);
            } else {
                wp.customize.previewer.previewUrl.set(CCSMurls.siteurl);
            }
        });
    });

    jQuery('.colorlib-single-template-wrapper img').click(function () {

        //declare arrays
        var pageContentArray = ['template_02', 'template_04', 'template_05', 'template_06', 'template_08', 'template_10', 'template_12', 'template_14'];
        var pageFooterArray = ['template_01', 'template_03', 'template_04', 'template_06'];
        var negativeBackgroundImageArray = ['template_03', 'template_04'];
        var backgroundColorArray = ['template_03', 'template_04'];

        //get control value
        var controlValue = wp.customize.control('ccsm_settings[colorlib_coming_soon_template_selection]').setting._value;

        //get controls
        var pageContent = wp.customize.control('ccsm_settings[colorlib_coming_soon_page_content]');
        var pageFooter = wp.customize.control('ccsm_settings[colorlib_coming_soon_page_footer]');
        var backgroundImage = wp.customize.control('ccsm_settings[colorlib_coming_soon_background_image]');
        var backgroundColor = wp.customize.control('ccsm_settings[colorlib_coming_soon_background_color]');

        //do action
        if (jQuery.inArray(controlValue, pageContentArray)) {
            pageContent.activate();
        } else {
            pageContent.deactivate();
        }

        if (jQuery.inArray(controlValue, pageFooterArray)) {
            pageFooter.activate();
        } else {
            pageFooter.deactivate();
        }

        if (jQuery.inArray(controlValue, negativeBackgroundImageArray)) {
            backgroundImage.deactivate();
        } else {
            backgroundImage.activate();
        }

        if (jQuery.inArray(controlValue, backgroundColorArray)) {
            backgroundColor.activate();
        } else {
            backgroundColor.deactivate();
        }

    });

    /*wp.customize.control('ccsm_settings[colorlib_coming_soon_template_selection]', function (control) {
        console.log(control.setting._value);
    });*/
});



