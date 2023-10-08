jQuery(function($) {
    $(document).ready(function() {
        thim_custom_admin_select();
        thim_sailing_40_install_demo();
    });

    function thim_custom_admin_select() {
        $('#customize-control-thim_preload select').on('change', function() {
            if ($(this).val() == 'image') {
                $('#customize-control-thim_preload_image').show();
            } else {
                $('#customize-control-thim_preload_image').hide();
            }
        }).trigger('change');
    }

    function thim_sailing_40_install_demo() {
        if ($('.tc-importer-wrapper').length == 0) {
            return;
        }

        if ($('.tc-importer-wrapper .theme.installed[data-thim-demo^=demo-vc]').length > 0) {
            $('.tc-importer-wrapper').addClass('visual_composer');
        }
        if ($('.tc-importer-wrapper .theme.installed[data-thim-demo^=demo-so]').length > 0) {
            $('.tc-importer-wrapper').addClass('site_origin');
        }
        if ($('.tc-importer-wrapper .theme.installed[data-thim-demo^=demo-elementor]').length > 0) {
            $('.tc-importer-wrapper').addClass('elementor');
        }

        if ($('.tc-importer-wrapper .theme.installed').length > 0) {
            return;
        }

        var $html = '<div class="thim-choose-page-builder"><h3 class="title">Please select page builder before Import Demo.</h3>';
        $html += '<select id="thim-select-page-builder">';
        $html += '<option value="">Select</option>';
        $html += '<option value="elementor">Elementor</option>';
        $html += '<option value="site_origin">Site Origin</option>';
        $html += '</select></div>';

        $('.tc-importer-wrapper').prepend($html);

        if ($('#thim-select-page-builder').val() === '') {
            $('.tc-importer-wrapper').addClass('overlay');
        }

        $(document).on('change', '#thim-select-page-builder', function () {

            var elem = $(this),
                elem_val = elem.val(),
                elem_parent = elem.parents('.tc-importer-wrapper'),
                data = {
                    action: 'thim_update_theme_mods',
                    thim_key: 'thim_page_builder_chosen',
                    thim_value: elem_val
                };

            if (elem_val !== '') {
                elem_parent.removeClass('visual_composer');
                elem_parent.removeClass('site_origin');
                elem_parent.removeClass('elementor');
                elem_parent.addClass(elem_val);

                elem_parent.removeClass('overlay').addClass('loading');
                $.post(ajaxurl, data, function (response) {
                    console.log(response);
                    elem_parent.removeClass('loading');
                });
            } else {
                elem_parent.addClass('overlay');
            }

        });
    }
});
