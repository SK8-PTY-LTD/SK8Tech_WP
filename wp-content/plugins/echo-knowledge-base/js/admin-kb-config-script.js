jQuery(document).ready(function($) {

    var ekb_admin_page_wrap = $( '#ekb-admin-page-wrap' );

    // when Main Page is refreshed do setup
    $('#epkb-main-page-content').bind('main_content_changed', function() {

        epkb_set_tabs_height();

        // enable re-ordering if necessary
        if ( $( '#epkb-config-ordering-sidebar, #epkb-config-article-ordering-sidebar' ).is(':visible') ) {
            epkb_custom_ordering(true);
        } else {
            epkb_custom_ordering(false);
        }

        // diable search
        $( '#ekb-admin-page-wrap' ).find('[id*=_search_terms]').prop('readonly', true);
        $('[id*=-search-kb]').prop('disabled', true);

        //Disable Links
        $('#epkb-main-page-container').find( 'a' ).on( 'click', function(e){
            // FUTURE $('#epkb-article-page').trigger('click');
            e.preventDefault();
        });
        $('#epkb-article-page-container').find( 'a' ).on( 'click', function(e){
            e.preventDefault();
        });
    });


    /*********************************************************************************************
     *********************************************************************************************
     *
     *                TOP PANEL
     *
     * ********************************************************************************************
     ********************************************************************************************/

    ( function(){

        // when first loaded show or hide Save/Cancel buttons acordingly
        if ( $('#epkb-main-page-button').hasClass('epkb-active-page') || $('#epkb-article-page-button').hasClass('epkb-active-page') ) {
            $('.epkb-info-save').show();
        } else {
            $('.epkb-info-save').hide();
        }

        // Handle List of KBs dropdown
        $( '#epkb-list-of-kbs' ).on( 'change', function(e) {
           // var what = e.target.value;
            var kb_admin_url = $(this).find(":selected").data('kb-admin-url');
            if ( kb_admin_url ) {
                window.location.href = kb_admin_url;
            }
        });

        // handle switch between Overview / Main Page / Article Page
        $( '#epkb-config-main-info .page-icon' ).on( 'click', function(){

            var active_tab;

            //Remove old messages
            $('.epkb-kb-config-notice-message').html('');

            // remove info boxes
            $('.option-info-icon').removeClass('active-info');
            $('.option-info-content').addClass('hidden');

            // Show TOP panel buttons
            $( '#epkb-main-page').show();
            $( '#epkb-article-page').show();

            // hide CONTENT panel
            $( '.epkb-config-content' ).hide();

            // hide SIDEBAR panel
            $( '.epkb-config-sidebar' ).removeClass( 'open-menu' );

            $( '.epkb-info-section').removeClass( 'epkb-active-page' );

            // Show highlight for Button clicked on
            $( this ).parent().parent().toggleClass( 'epkb-active-page' );

            // Toggle Page Content
            var id = $( this ).attr( 'id' );
            $( '#' + id + '-content' ).fadeToggle();

            if ( id == 'epkb-main-page' ) {

                // show Save and Cancel buttons when on Overview
                $('.epkb-info-save').show();

                active_tab = $('#epkb-main-page-settings').find('.epkb-active-setting');
                if ( active_tab.length > 0 ) {
                    $( '#' + active_tab.attr('id') + '-sidebar' ).addClass('open-menu' );
                }

                // hide Article Page sidebar
                $('#epkb-article-page-settings').hide();
                // show Main Page sidebar
                $( '#epkb-main-page-settings').fadeIn();
                // show CONTENT panel
                $('#epkb-main-page-content').show();

                // renable ordering
                if ( $( '#epkb-config-ordering-sidebar' ).is(':visible') ) {
                    epkb_custom_ordering(true);
                } else {
                    epkb_custom_ordering(false);
                }

            } else if ( id == 'epkb-article-page' ) {

                // show Save and Cancel buttons when on Overview
                $('.epkb-info-save').show();

                var article_page_layout = $('#kb_article_page_layout input[name=kb_article_page_layout]:checked').val();

                // renable ordering
                if ( $( '#epkb-config-article-ordering-sidebar' ).is(':visible') ) {
                    epkb_custom_ordering(true);
                } else {
                    epkb_custom_ordering(false);
                }

                // article Layout tab is always on
                $('#epkb-config-article-layout').addClass('epkb-active-setting' );
                active_tab = $('#epkb-article-page-settings').find('.epkb-active-setting');
                if ( active_tab.length > 0 ) {
                    $( '#' + active_tab.attr('id') + '-sidebar' ).addClass('open-menu' );
                }

                if ( $('#epkb-article-page-content').html().trim().length == 0) {
                    epkb_ajax_article_page_config_change_request( 'layout', article_page_layout );
                }

                // hide Main Page sidebar
                $('#epkb-main-page-settings').hide();
                // show Article Page sidebar
                $( '#epkb-article-page-settings').fadeIn();
                // show CONTENT panel
                $('#epkb-article-page-content').show();

            } else {
                $('#epkb-article-page-settings').hide();
                $('#epkb-main-page-settings').hide();

                // hide Save and Cancel buttons when on Overview
                $('.epkb-info-save').hide();
            }
        });

        // show/hide Layout, Order, Styles, Colors, Text
        $( '.epkb-menu-item' ).on( 'click', function(){

            //Remove old messages
            $('.epkb-kb-config-notice-message').html('');

            // remove info boxes
            $('.option-info-icon').removeClass('active-info');
            $('.option-info-content').addClass('hidden');

        });

        // cancel configuration changes
        $( '#epkb_cancel_config, #epkb_cancel_dashboard' ).on( 'click', function(){
            location.reload();
        });

        // if user comes from Welcome Page with Demo KB on
        if ( $('#epkb-main-page-button').hasClass('epkb-active-page') ) {
            $( '#epkb-main-page-settings').fadeIn();
        }
    })();


    /*********************************************************************************************
     *********************************************************************************************
     *
     *                LAYOUT PREVIEW BOX
     *
     * ********************************************************************************************
     ********************************************************************************************/

    {
        // SEARCH

        //Sidebar Alpha Search Toggle
        $('[id*=-search-toggle]').on('click', function () {
            $('#epkb-article-page-content').find('[id*=-search-toggle]').slideToggle();
        });

        //Prevent Search from being used on config
        $('#ekb-admin-page-wrap').find('[id*=_search_terms]').prop('readonly', true);
        $('[id*=-search-kb]').prop('disabled', true);

        // Show Character count on Tab Name input field and warning message
        $('#kb_name_tmp').on('keyup', function () {
            var value = $(this).val().length;
            var limit = 25;
            var result = limit - value;
            $('#character_value').remove();
            if (result < 0) { //noinspection JSUnresolvedVariable
                $(this).after('<div id="character_value" class="input_error"><p>' + epkb_vars.reduce_name_size + '</p></div>');
            }
        });

        // INFO BOX
        ekb_admin_page_wrap.on( 'click', '.epkb-info', function (){

            $( this ).parent().toggleClass( 'epkb-preview-active-info' );
            $( this ).parent().find( '.epkb-preview-information' ).slideToggle();
            $( this ).parent().next().css( "opacity", ".2" );

            if( !$( this ).parent().hasClass( 'epkb-preview-active-info')){
                $( this ).parent().next().css( "opacity", "1" );
            }
        });

        //Set the Height of the preview box and the config sidebar to match the users screen size.
        function epkb_set_layout_preview_box_height() {
            var screenHeight = $(window).outerHeight();
            var wpAdminAdminbar = 32;
            var configMainInfo = 103;
            var previewInfo = 75;
            var sidebarMenuheader = 64;
            var sidebarBack = 48;
            var bodyPadding = 65;
            var wpAdminfooter = 40;

            var newPreviewHeight = screenHeight - wpAdminfooter - wpAdminAdminbar - configMainInfo - previewInfo - bodyPadding;
            var newSidebarHeight = screenHeight - wpAdminAdminbar - configMainInfo - sidebarMenuheader - sidebarBack - bodyPadding - wpAdminfooter;
            $('#epkb-main-page-container').css('max-height', newPreviewHeight);
            $('#epkb-article-page-container').css('max-height', newPreviewHeight);
            $('[id*=lay-grid-layout-page-container]').css('max-height', newPreviewHeight);
            $('[id*=lay-sidebar-layout-page-container]').css('max-height', newPreviewHeight);
            $('.epkb-menu-body').css('max-height', newSidebarHeight);
        }
        epkb_set_layout_preview_box_height();
    }


    /*********************************************************************************************
     *********************************************************************************************
     *
     *                SIDEBAR: ALL
     *
     * ********************************************************************************************
     ********************************************************************************************/

    {
        // CHANGE any field
        $( '#epkb-config-config' ).on( 'change' ,function (e) {

            if ( event.target.id != undefined &&
                ( event.target.id.includes("reset_style") || event.target.id.match("^categories_display_sequence") || event.target.id.match("^articles_display_sequence") ||
                event.target.id.match("^epkb-layout-preview-data") || event.target.id.match("^kb_main_page_layout") || event.target.id.match("^kb_article_page_layout") ||
                event.target.id.match("grid_category_icon$") )) {
                return;
            }

            // exclude style/color/layout changes
            e.preventDefault();
            e.stopPropagation();

            var epkb_is_article_icon_active = $('#epkb-article-page-button').hasClass('epkb-active-page');

            var postData = {
                action: 'epkb_change_one_config_param_ajax',
                epkb_kb_id: $('#epkb_kb_id').val(),
                form: $('#epkb-config-config').serialize(),
                epkb_demo_kb: $('#epkb-layout-preview-data').is(':checked'),
                epkb_is_article_icon_active: epkb_is_article_icon_active
            };

            var msg;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: postData,
                url: ajaxurl,
                beforeSend: function (xhr)
                {
                    $('#epkb-ajax-in-progress').text('Updating page preview ...');
                    $('#epkb-ajax-in-progress').dialog('open');
                }
            }).done(function (response)
            {
                response = ( response ? response : '' );
                if ( response.error || response.message == undefined || response.kb_info_panel_output == undefined ) {
                    //noinspection JSUnresolvedVariable,JSUnusedAssignment
                    msg = response.message ? response.message : epkb_admin_notification('', epkb_vars.reload_try_again, 'error');
                    return;
                }

                //noinspection JSUnresolvedVariable
                if ( epkb_is_article_icon_active ) {
                    $('#epkb-article-page-content').html(response.kb_info_panel_output);
                    $('#epkb-article-page-content').trigger('article_content_changed');
                } else {
                    $('#epkb-main-page-content').html(response.kb_info_panel_output);
                    $('#epkb-main-page-content').trigger('main_content_changed');
                }

            }).fail( function ( response, textStatus, error )
            {
                //noinspection JSUnresolvedVariable
                msg = ( error ? ' [' + error + ']' : epkb_vars.unknown_error );
                //noinspection JSUnresolvedVariable
                msg = epkb_admin_notification(epkb_vars.error_occurred + '. ' + epkb_vars.msg_try_again, msg, 'error');
            }).always(function ()
            {
                $('#epkb-ajax-in-progress').dialog('close');

                if ( msg ) {
                    $('.epkb-kb-config-notice-message').replaceWith(msg);
                    $( "html, body" ).animate( {scrollTop: 0}, "slow" );
                }
            });
        });

        // CHANGE color picker
        var myOptions = {
            // a callback to fire whenever the color changes to a valid color
            done: function(event, ui){
            },
            // a callback to fire when the input is emptied or an invalid color
            clear: function() {}
        };
        $( '.ekb-color-picker input' ).wpColorPicker(myOptions);

        // because handlers tied to upper elements are blocked we need to reload them after changes are
        // made to colors menu
        function epkb_setup_color_preview_handlers() {
            $('.wp-picker-container ').on('click', function () {

                //Add Preview button beside color square
                $('.epkb-picker-preview').remove();
                $(this).find('.iris-picker-inner').before('<div class="epkb-picker-preview">Preview</div>');

            });
            $('.wp-picker-container').on('click', '.epkb-picker-preview', function (e) {

                // exclude style/color/layout changes
                e.preventDefault();
                e.stopPropagation();

                var epkb_is_article_icon_active = $('#epkb-article-page-button').hasClass('epkb-active-page');

                var postData = {
                    action: 'epkb_change_one_config_param_ajax',
                    epkb_kb_id: $('#epkb_kb_id').val(),
                    form: $('#epkb-config-config').serialize(),
                    epkb_demo_kb: $('#epkb-layout-preview-data').is(':checked'),
                    epkb_is_article_icon_active: epkb_is_article_icon_active
                };

                var msg;

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    data: postData,
                    url: ajaxurl,
                    beforeSend: function (xhr) {
                        $('#epkb-ajax-in-progress').text('Updating page preview ...');
                        $('#epkb-ajax-in-progress').dialog('open');
                    }
                }).done(function (response) {
                    response = ( response ? response : '' );
                    if (response.error || response.message == undefined || response.kb_info_panel_output == undefined) {
                        //noinspection JSUnresolvedVariable,JSUnusedAssignment
                        msg = response.message ? response.message : epkb_admin_notification('', epkb_vars.reload_try_again, 'error');
                        return;
                    }

                    //noinspection JSUnresolvedVariable
                    if (epkb_is_article_icon_active) {
                        $('#epkb-article-page-content').html(response.kb_info_panel_output);
                        $('#epkb-article-page-content').trigger('article_content_changed');
                    } else {
                        $('#epkb-main-page-content').html(response.kb_info_panel_output);
                        $('#epkb-main-page-content').trigger('main_content_changed');
                    }

                }).fail(function (response, textStatus, error) {
                    //noinspection JSUnresolvedVariable
                    msg = ( error ? ' [' + error + ']' : epkb_vars.unknown_error );
                    //noinspection JSUnresolvedVariable
                    msg = epkb_admin_notification(epkb_vars.error_occurred + '. ' + epkb_vars.msg_try_again, msg, 'error');
                }).always(function () {
                    $('#epkb-ajax-in-progress').dialog('close');

                    if (msg) {
                        $('.epkb-kb-config-notice-message').replaceWith(msg);
                        $("html, body").animate({scrollTop: 0}, "slow");
                    }
                });
            });
        }
        epkb_setup_color_preview_handlers();

        // highlight text for clicked on radio button
        $( '.epkb-config-sidebar' ).find( ":radio" ).on('click', function(){
            epkb_sidebar_highlight_text_for_checked_radio_button( $( this ) );
        });

        //Disable Links
        $('#epkb-main-page-container').find( 'a' ).on( 'click', function(e){
            // FUTURE $('#epkb-article-page').trigger('click');
            e.preventDefault();
        });
        $('#epkb-article-page-container').find( 'a' ).on( 'click', function(e){
            e.preventDefault();
        });

        // Display Info Icon Content
        $( '.epkb-menu-content' ).on( 'click', '.option-info-icon', function(e){
            e.preventDefault();

            var is_help_hidden = $( this ).parents( '.config-option-group').find( '.option-info-content' ).hasClass('hidden');

            // first remove all info boxes
            $('.option-info-icon').removeClass('active-info');
            $('.option-info-content').addClass('hidden');

            //Get Sidebar Position
            var sidbarPOS = $(this).parents( '.epkb-sidebar-container' ).position();

            //Toggle Active class for icon
            if ( is_help_hidden ) {
                //Show Content
                $( this ).addClass('active-info');
                $( this ).parents('.config-option-group').find( '.option-info-content' ).removeClass( 'hidden' );
                $( this ).parents('.config-option-group').find( '.option-info-content' ).css({
                    top: sidbarPOS.top + 30,
                    right: $('.epkb-sidebar-container').outerWidth( true ) + 20
                });
            }
        });

        // MAIN PAGE SIDEBAR MENU: Toggle Configuration menu items
        ekb_admin_page_wrap.find('#epkb-main-page-settings').find( '.epkb-menu-item' ).on( 'click', function(e){
            // wait until back button handler is done
            if ( $('#epkb-main-page-settings').find( '.epkb-menu-back' ).is(':visible') ) {
                return;
            }
            epkb_show_level2_sidebar_menu( $( this ) );
        });

        // MAIN PAGE back button
        ekb_admin_page_wrap.find('#epkb-main-page-settings').find( '.epkb-menu-back' ).on( 'click', function(e) {
            e.preventDefault();
            // do not handle if menu is not yet hidden by its handler
            if ( $('#epkb-main-page-settings').find( '.epkb-menu-item' ).is(':visible') ) {
                return;
            }
            epkb_show_level1_sidebar_menu( $(this), false );
        });

        // ARTICLE PAGE SIDEBAR MENU: Toggle Configuration menu items
        ekb_admin_page_wrap.find('#epkb-article-page-settings').find( '.epkb-menu-item' ).on( 'click', function(e){
            // wait until back button handler is done
            if ( $('#epkb-article-page-settings').find( '.epkb-menu-back' ).is(':visible') ) {
                return;
            }
            epkb_show_level2_sidebar_menu( $(this) );
        });

        // ARTICLE PAGE back button
        ekb_admin_page_wrap.find('#epkb-article-page-settings').find( '.epkb-menu-back' ).on( 'click', function(e) {
            e.preventDefault();
            // do not handle if menu is not yet hidden by its handler
            if ( $('#epkb-article-page-settings').find( '.epkb-menu-item' ).is(':visible') ) {
                return;
            }
            epkb_show_level1_sidebar_menu( $(this), true );
        });

        function epkb_show_level1_sidebar_menu( elem, is_article_page ) {
            elem.closest('.epkb-menu-container').find('.epkb-menu-content').hide();
            elem.closest('.epkb-menu-level').find('.epkb-menu-item').show();

            epkb_custom_ordering(false);

            // for article page we might need to show only Layout menu if no layout selected
            var article_page_layout = $('#kb_article_page_layout input[name=kb_article_page_layout]:checked').val();
            if ( is_article_page ) {
                epkb_update_article_page_menu(article_page_layout);
            }
        }

        function epkb_show_level2_sidebar_menu( elem ) {
            elem.closest('.epkb-menu-level').find('.epkb-menu-item').fadeOut();
            elem.parent().find('.epkb-menu-content').fadeIn();

            // renable ordering
            if ( $( '#epkb-config-ordering-sidebar, #epkb-config-article-ordering-sidebar' ).is(':visible') ) {
                epkb_custom_ordering(true);
            } else {
                epkb_custom_ordering(false);
            }
        }

        // SIDEBAR MENU: toggle accordions
        $( '#epkb-config-config' ).on( 'click' , '.epkb-config-sidebar-accordion-header',function (){

            var sidebar = $( this ).parent().parent();

            // close this accordion if it is open
            if ( $( this ).hasClass( 'epkb-kb-active-accordion' ) ){
                $( this ).removeClass( 'epkb-kb-active-accordion');
                $( this ).parent().find( '.epkb-config-sidebar-accordion-body' ).slideUp();
                $( this ).find( 'h4 span').toggleClass( 'ep_icon_down_arrow, ep_icon_right_arrow' );
            } else {
                //Add Down arrow to this clicked on accordion
                $( this ).parent().find( '.epkb-config-sidebar-accordion-header h4 span').addClass('ep_icon_down_arrow');
                $( this ).parent().find( '.epkb-config-sidebar-accordion-header h4 span').removeClass('ep_icon_right_arrow');
                //Add Active class to clicked on accordion
                $( this ).addClass( 'epkb-kb-active-accordion' );
                $( this ).parent().find( '.epkb-config-sidebar-accordion-body' ).slideDown();
            }
        });

        function epkb_sidebar_highlight_text_for_checked_radio_button( $this ){
            $this.parents( '.radio-buttons-vertical' ).find('.input_container').removeClass( 'checked-radio' );
            if( $this.attr( "checked" ) ) {
                $this.parent().addClass( 'checked-radio' );
            }
        }
    }


    /*********************************************************************************************
     *********************************************************************************************
     *
     *                SIDEBAR: MAIN PAGE
     *
     * ********************************************************************************************
     ********************************************************************************************/

    (function(){

        // DEMO / KB DATA Switching
        $('#epkb-main-page-content').on('change', '#epkb-layout-preview-data', function (e) {
            e.preventDefault();  // do not submit the form
            epkb_ajax_main_page_config_change_request( 'demo', 'demo' );
        });

        // LAYOUT: if user wants to change layout, confirm it first
        $( '#kb_main_page_layout_group').on( 'change', function (e) {
           e.preventDefault();

           var target_name = e.target.value;

           // remove focus so that arrow keys up/down page can be used
           $('#kb_main_page_layout input[name=kb_main_page_layout]').blur();

           epkb_ajax_main_page_config_change_request( 'layout', target_name );
         });

        // STYLE: if user wants to change style, confirm it first
        $( '.epkb-menu-body' ).on( 'change', '#main_page_reset_style :input', function (e) {
            e.preventDefault();

            var target_name = e.target.value;

            // allow user to select the same option if they want to reset their changes to the same style
            $('#main_page_reset_style input[name=main_page_reset_style]').prop('checked', false);

            epkb_ajax_main_page_config_change_request('style', target_name);
        });

        // COLORS: if user wants to change colors
        $( '.epkb-menu-body').on( 'click', '#main_page_reset_colors :button', function (e) {
            e.preventDefault();

            var target_name = e.target.value;

            // allow user to select the same option if they want to reset their changes to the same colors
            $('#main_page_reset_colors input[name=reset_colors]').prop('checked', false);

            epkb_ajax_main_page_config_change_request( 'colors', target_name );
        });

        function epkb_ajax_main_page_config_change_request( target_type, target_name ) {

            var postData = {
                action: 'epkb_change_main_page_config_ajax',
                epkb_kb_id: $('#epkb_kb_id').val(),
                target_type: target_type,
                target_name: target_name,
                epkb_chosen_main_page_layout: $('#kb_main_page_layout input[name=kb_main_page_layout]:checked').val(),
                epkb_demo_kb: $('#epkb-layout-preview-data').is(':checked'),
                form: $('#epkb-config-config').serialize()
            };

            var msg;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: postData,
                url: ajaxurl,
                beforeSend: function (xhr)
                {
                    $('#epkb-ajax-in-progress').text('Switching ' + target_type + ' ...');
                    $('#epkb-ajax-in-progress').dialog('open');
                }
            }).done(function (response)
            {
                response = ( response ? response : '' );
                if ( response.error || response.message == undefined || response.style_tab_output == undefined ||
                    response.colors_tab_output == undefined || response.kb_main_page_output == undefined ) {
                    //noinspection JSUnresolvedVariable,JSUnusedAssignment
                    msg = response.message ? response.message : epkb_admin_notification('', epkb_vars.reload_try_again, 'error');
                    return;
                }

                msg = response.message;

                //   ===========    LAYOUT CHANGE   ==============

                // hide Article Page if not applicable OR show it with proper Article Layout widget
                if ( target_type == 'layout' ) {
                    if ( target_name == 'Sidebar' ) {
                        $('#epkb-article-page-button').hide();
                        $('#epkb-user-flow-arrow').hide();
                    } else {
                        $('#epkb-article-page-button').show();
                        $('#epkb-user-flow-arrow').show();
                    }
                }

                // always refresh Main Page layout
                $('#epkb-main-page-content').html(response.kb_main_page_output);
                $('#epkb-main-page-content').trigger('main_content_changed');

                if ( target_type == 'layout' ) {
                    $('#epkb-article-page-content').html(response.article_page_output);
                    $('#epkb-article-page-content').trigger('article_content_changed');

                    if ( response.common_path_output ) {
                        $('#kb_articles_common_path_group').html(response.common_path_output);
                    }

                    if ( response.ordering_output ) {
                        $('#epkb-config-ordering-sidebar').html(response.ordering_output);
                    }

                    if ( response.overview_output ) {
                        $('#epkb-config-overview-content').html(response.overview_output);
                    }

                    if ( response.main_page_text_output ) {
                        $('#epkb-config-text-sidebar').html(response.main_page_text_output);
                    }

                    $('#epkb-config-article-layout-sidebar').html(response.kb_article_layout_widget);

                    // also reset article page
                    epkb_handle_article_page_config_response( target_type, response.article_page_layout, response );

                    // on article page show top menu again
                    var elem = ekb_admin_page_wrap.find('#epkb-article-page-settings').find( '.epkb-menu-item' );
                    epkb_show_level1_sidebar_menu( elem, true );
                }

                if ( response.style_tab_output != 'NONE' ) {
                     $('#epkb-config-styles-sidebar').replaceWith(response.style_tab_output);
                }

                if ( response.colors_tab_output != 'NONE' ) {
                     $('#epkb-config-colors-sidebar').replaceWith(response.colors_tab_output);
                }

            }).fail( function ( response, textStatus, error )
            {
                //noinspection JSUnresolvedVariable
                msg = ( error ? ' [' + error + ']' : epkb_vars.unknown_error );
                //noinspection JSUnresolvedVariable
                msg = epkb_admin_notification(epkb_vars.error_occurred + '. ' + epkb_vars.msg_try_again, msg, 'error');
            }).always(function ()
            {
                $('#epkb-ajax-in-progress').dialog('close');

                //If color pickers are not detected then add them.
                if(  $( '#epkb-config-colors-sidebar .wp-picker-container' ).length == 0 ){
                    $( '#epkb-config-colors-sidebar .ekb-color-picker input' ).wpColorPicker();
                    epkb_setup_color_preview_handlers();
                }

                if ( msg ) {
                    $('.epkb-kb-config-notice-message').replaceWith(msg);
                    $( "html, body" ).animate( {scrollTop: 0}, "slow" );
                }
            });
        }

    })();


    /*********************************************************************************************
     *********************************************************************************************
     *
     *                SIDEBAR: ARTICLE PAGE
     *
     *********************************************************************************************
     ********************************************************************************************/

    {
        // LAYOUT: if user wants to change layout, confirm it first
        $( '.epkb-menu-body').on( 'change', '#kb_article_page_layout_group', function (e) {
            e.preventDefault();

            var target_name = e.target.value;

            // remove focus so that arrow keys up/down page can be used
            $('#kb_article_page_layout input[name=kb_article_page_layout]').blur();

            epkb_ajax_article_page_config_change_request( 'layout', target_name );
        });

        // STYLE: if user wants to change style, confirm it first
        $( '.epkb-menu-body' ).on( 'change', '#article_page_reset_style :input', function (e) {
            e.preventDefault();

            var target_name = e.target.value;

            // allow user to select the same option if they want to reset their changes to the same style
            $('#article_page_reset_style input[name=article_page_reset_style]').prop('checked', false);

            epkb_ajax_article_page_config_change_request('style', target_name);
        });

        // COLORS: if user wants to change colors, confirm it first
        $( '.epkb-menu-body').on( 'click', '#article_page_reset_colors :button', function (e) {
            e.preventDefault();

            var target_name = e.target.value;

            // allow user to select the same option if they want to reset their changes to the same colors
            $('#reset_colors input[name=reset_colors]').prop('checked', false);

            epkb_ajax_article_page_config_change_request( 'colors', target_name );
        });

        function epkb_ajax_article_page_config_change_request( target_type, target_name ) {

            var postData = {
                action: 'epkb_change_article_page_config_ajax',
                epkb_kb_id: $('#epkb_kb_id').val(),
                target_type: target_type,
                target_name: target_name,
                epkb_chosen_article_page_layout: $('#kb_article_page_layout input[name=kb_article_page_layout]:checked').val(),
                epkb_demo_kb: $('#epkb-layout-preview-data').is(':checked'),
                form: $('#epkb-config-config').serialize()
            };

            var msg;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: postData,
                url: ajaxurl,
                beforeSend: function (xhr)
                {
                    $('#epkb-ajax-in-progress').text('Switching ' + target_type + ' ...');
                    $('#epkb-ajax-in-progress').dialog('open');
                }
            }).done(function (response)
            {
                var error = epkb_handle_article_page_config_response( target_type, target_name, response );
                msg = error.length > 0 ? error : response.message;

            }).fail( function ( response, textStatus, error )
            {
                //noinspection JSUnresolvedVariable
                msg = ( error ? ' [' + error + ']' : epkb_vars.unknown_error );
                //noinspection JSUnresolvedVariable
                msg = epkb_admin_notification(epkb_vars.error_occurred + '. ' + epkb_vars.msg_try_again, msg, 'error');
            }).always(function ()
            {
                $('#epkb-ajax-in-progress').dialog('close');

                //If color pickers are not detected then add them.
                if(  $( '#epkb-config-article-colors-sidebar .wp-picker-container' ).length == 0 ){
                    $( '#epkb-config-article-colors-sidebar .ekb-color-picker input' ).wpColorPicker();
                    epkb_setup_color_preview_handlers();
                }

                if ( msg ) {
                    $('.epkb-kb-config-notice-message').replaceWith(msg);
                    $( "html, body" ).animate( {scrollTop: 0}, "slow" );
                }
            });
        }

        function epkb_handle_article_page_config_response( target_type, target_name, response ) {

            response = ( response ? response : '' );
            if ( response.error || response.message == undefined ||
                response.article_style_tab_output == undefined || response.article_colors_tab_output == undefined ) {
                //noinspection JSUnresolvedVariable,JSUnusedAssignment
                return response.message ? response.message : epkb_admin_notification('', epkb_vars.reload_try_again, 'error');
            }

            // always refresh colors
            $('#epkb-article-page-content').html(response.article_page_output);
            $('#epkb-article-page-content').trigger('article_content_changed');

            if ( response.article_style_tab_output != 'NONE' ) {
                $('#epkb-config-article-styles-sidebar').replaceWith(response.article_style_tab_output);
            }

            if ( response.article_colors_tab_output != 'NONE' ) {
                $('#epkb-config-article-colors-sidebar').replaceWith(response.article_colors_tab_output);
            }

            if ( response.article_text_tab_output ) {
                $('#epkb-config-article-text-sidebar').replaceWith(response.article_text_tab_output);
            }

            return '';
        }

       function epkb_update_article_page_menu( article_page_layout ) {
            // article only has no layout configuration; if switching to Basic/Tabs layout then have no article layout
            if ( article_page_layout == 'Article' ) {
                $('#epkb-config-article-ordering').hide();
                $('#epkb-config-article-styles').hide();
                $('#epkb-config-article-colors').hide();
                $('#epkb-config-article-text').hide();
            } else {
                $('#epkb-config-article-ordering').show();
                $('#epkb-config-article-styles').show();
                $('#epkb-config-article-colors').show();
                $('#epkb-config-article-text').show();
            }
        }
    }


    /********************************************************************************************
     *
     *                SAVE CONFIGURATION
     *
     ********************************************************************************************/

    // SAVE KB configuration
    $( '#epkb_save_kb_config, #epkb_save_dashboard' ).on( 'click', function (e) {
        e.preventDefault();  // do not submit the form
        var msg = '';

        // get top level category sequence for Tabs Layout handling
        var top_cat_sequence = [];
        $('.epkb_top_categories').each(function(i, obj) {
            var top_cat_id = $(this).find('[data-kb-category-id]').data('kb-category-id');
            if ( top_cat_id ) {
                top_cat_sequence.push(top_cat_id);
            }
        });

        // since KB Name is outside of form, set hidden form field with its value
        $('#kb_name').val($('#kb_name_tmp').val());
        
        // retrieve all categories and article ids
        var postData = {
            action: 'epkb_save_kb_config_changes',
            _wpnonce_epkb_save_kb_config: $('#_wpnonce_epkb_save_kb_config').val(),
            epkb_kb_id: $('#epkb_kb_id').val(),
            form: $('#epkb-config-config').serialize(),
            epkb_new_sequence: epkb_get_new_sequence(),
            top_cat_sequence: top_cat_sequence
        };

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: postData,
            url: ajaxurl,
            beforeSend: function (xhr)
            {
                //noinspection JSUnresolvedVariable
                $('#epkb-ajax-in-progress').text(epkb_vars.save_config);
                $('#epkb-ajax-in-progress').dialog('open');
            }

        }).done(function (response)
        {
            response = ( response ? response : '' );
            if ( ! response.error && response.message != undefined )
            {
                msg = response.message;

                $('#epkb-content-container').find('.epkb-sortable-item-highlight').each(function(i, obj) {
                    $(this).removeClass('epkb-sortable-item-highlight');
                });

                if (msg.indexOf('RELOAD') >= 0) {
                    $('.epkb-kb-config-notice-message').replaceWith(msg);
                    msg = '';
                    $("html, body").animate({scrollTop: 0}, "slow");

                    window.setTimeout(show_reload_dialog, 2000);
                    function show_reload_dialog() {
                        location.reload();
                    }
                }
            } else {
                //noinspection JSUnresolvedVariable
                msg = response.message ? response.message : epkb_admin_notification('', epkb_vars.reload_try_again, 'error');
            }

        }).fail(function (response, textStatus, error)
        {
            //noinspection JSUnresolvedVariable
            msg = ( error ? ' [' + error + ']' : epkb_vars.unknown_error );
            //noinspection JSUnresolvedVariable
            msg = epkb_admin_notification(epkb_vars.not_saved + ' ' + epkb_vars.msg_try_again, msg, 'error');
        }).always(function ()
        {
            $('#epkb-ajax-in-progress').dialog('close');

            if ( msg ) {
                $('.epkb-kb-config-notice-message').replaceWith(msg);
                $("html, body").animate({scrollTop: 0}, "slow");
            }
        });
    });


    /********************************************************************************************
     *
     *                ARTICLES / CATEGORIES SEQUENCE ORDERING
     *
     ********************************************************************************************/

    {
        // enable custom ordering
        $( '.epkb-menu-item' ).on( 'click', function(){
            if ( $( this ).attr('id') == 'epkb-config-ordering' ) {
                epkb_custom_ordering(true);
            } else {
                epkb_custom_ordering(false);
            }
        });

        function epkb_custom_ordering( enabled ) {
            var isDisabled = ! enabled;

            epkb_add_custom_ordering();
            $('.epkb-config-content .epkb-top-categories-list').sortable("option", "disabled", isDisabled);
            $('.epkb-config-content .epkb-categories-list').sortable("option", "disabled", isDisabled);
            $('.epkb-config-content .epkb-sub-category').sortable("option", "disabled", isDisabled);
            $('.epkb-config-content .epkb-sub-sub-category').sortable("option", "disabled", isDisabled);
            $('.epkb-config-content .epkb-articles').sortable("option", "disabled", isDisabled);
            $('.epkb-config-content .epkb-top-categories-list').sortable("option", "disabled", isDisabled);
            $('.epkb-config-content .epkb-categories-list').sortable("option", "disabled", isDisabled);
            $('.epkb-config-content .epkb-sub-category').sortable("option", "disabled", isDisabled);
            $('.epkb-config-content .epkb-sub-sub-category').sortable("option", "disabled", isDisabled);
            $('.epkb-config-content .epkb-articles').sortable("option", "disabled", isDisabled);

            var style = enabled ? 'move' : 'auto';
            $('#epkb-content-container').css('cursor', style, 'important');
            $('.epkb-config-content').find( 'a' ).css('cursor', style, 'important');
        }

        function epkb_add_custom_ordering() {

            // Order Top Categories for Tabs layout
            $('.epkb-config-content .epkb-top-categories-list').sortable({
                axis: 'x',
                forceHelperSize: true,
                forcePlaceholderSize: true,
                // handle: '.epkb-sortable-articles',
                opacity: 0.8,
                placeholder: 'epkb-sortable-placeholder',
                update: function (event, ui)
                {
                    if ( $('#epkb-main-page').closest('.epkb-info-pages').hasClass('epkb-active-page') ) {
                        $('#epkb-config-ordering-sidebar').find('input[name=categories_display_sequence][value=user-sequenced]').click();
                    }
                }
            });

            // Order Categories
            $('.epkb-config-content .epkb-categories-list').sortable({
                axis: 'x,y',
                forceHelperSize: true,
                forcePlaceholderSize: true,
                // handle: '.epkb-sortable-articles',
                opacity: 0.8,
                placeholder: 'epkb-sortable-placeholder',
                /* doesn't work well:  start: function (event, ui) {
                 // do not move Uncategorized
                 if ( ! ui.item.find('[data-kb-category-id]').data('kb-category-id') ) {
                 return false;
                 }
                 }, */
                update: function (event, ui)
                {
                    if ( $('#epkb-main-page').closest('.epkb-info-pages').hasClass('epkb-active-page') ) {
                        $('#epkb-config-ordering-sidebar').find('input[name=categories_display_sequence][value=user-sequenced]').click();
                    }
                }
            });

            // Order Sub-categories
            $('.epkb-config-content .epkb-sub-category').sortable({
                axis: 'x,y',
                forceHelperSize: true,
                forcePlaceholderSize: true,
                // handle: '.epkb-sortable-articles',
                opacity: 0.8,
                placeholder: 'epkb-sortable-placeholder',
                update: function (event, ui)
                {
                    if ( $('#epkb-main-page').closest('.epkb-info-pages').hasClass('epkb-active-page') ) {
                        $('#epkb-config-ordering-sidebar').find('input[name=categories_display_sequence][value=user-sequenced]').click();
                    }
                }
            });

            // Order Sub-sub-categories
            $('.epkb-config-content .epkb-sub-sub-category').sortable({
                axis: 'x,y',
                forceHelperSize: true,
                forcePlaceholderSize: true,
                // handle: '.epkb-sortable-articles',
                opacity: 0.8,
                placeholder: 'epkb-sortable-placeholder',
                update: function (event, ui)
                {
                    if ( $('#epkb-main-page').closest('.epkb-info-pages').hasClass('epkb-active-page') ) {
                        $('#epkb-config-ordering-sidebar').find('input[name=categories_display_sequence][value=user-sequenced]').click();
                    }
                }
            });

            // Order Articles
            $('.epkb-config-content .epkb-articles, .epkb-articles').sortable({
                axis: 'y',
                forceHelperSize: true,
                forcePlaceholderSize: true,
                // handle: '.epkb-sortable-articles',
                opacity: 0.8,
                placeholder: 'epkb-sortable-placeholder',
                update: function (event, ui)
                {
                    if ( $('#epkb-main-page').closest('.epkb-info-pages').hasClass('epkb-active-page') ) {
                        $('#epkb-config-ordering-sidebar').find('input[name=articles_display_sequence][value=user-sequenced]').click();
                    }
                }
            });
        }

        function epkb_get_new_sequence() {
            var new_sequence = [];
            $('#epkb-main-page-content').find('[data-kb-type]').each(function(i, obj) {

                // some layouts like Tabs Layout has top categories and sub-categories "disconnected". Connect them here
                var top_cat_id = $(this).data('kb-top-category-id') ? $(this).data('kb-top-category-id') : '';
                if ( top_cat_id ) {
                    new_sequence.push([top_cat_id, 'category']);
                }

                var category_id = $(this).data('kb-category-id') == undefined ? $(this).data('kb-article-id') : $(this).data('kb-category-id');
                if ( category_id != undefined ) {
                    new_sequence.push([category_id, $(this).attr("data-kb-type")]);
                }
            });
            return new_sequence;
        }

        // update left pane when user selects a different article sequence
        $('#epkb-main-page-settings').on( 'change', '#articles_display_sequence', function (e) {
            e.preventDefault();
            epkb_process_user_sequence_change( 'articles_sequence' );

        });

        // update left pane when user selects a different category sequence
        $('#epkb-main-page-settings').on( 'change', '#categories_display_sequence', function (e) {
            e.preventDefault();
            epkb_process_user_sequence_change( 'categories_sequence' );

        });

        function epkb_process_user_sequence_change( sequence_type ) {

            var postData = {
                action: 'epkb_change_to_non_custom_sequence',
                _wpnonce_epkb_save_kb_config: $('#_wpnonce_epkb_save_kb_config').val(),
                epkb_kb_id: $('#epkb_kb_id').val(),
                form: $('#epkb-config-config').serialize(),
                sequence_type: sequence_type,
                articles_sequence_new_value: epkb_get_field_value('articles_display_sequence', 'articles_display_sequence'),
                categories_sequence_new_value: epkb_get_field_value('categories_display_sequence', 'categories_display_sequence'),
                epkb_new_sequence: epkb_get_new_sequence(),
                epkb_chosen_main_page_layout: $('#kb_main_page_layout input[name=kb_main_page_layout]:checked').val(),
                epkb_demo_kb: $('#epkb-layout-preview-data').is(':checked'),
            };
            var msg;

            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: postData,
                url: ajaxurl,
                beforeSend: function (xhr)
                {
                    $('#epkb-ajax-in-progress').text('Switching article sequence ...');
                    $('#epkb-ajax-in-progress').dialog('open');
                }
            }).done(function (response)
            {
                response = ( response ? response : '' );
                if ( ! response.error && response.message != undefined && response.kb_main_page_output != undefined )
                {
                    msg = response.message;
                    $('#epkb-main-page-content').html(response.kb_main_page_output);
                    $('#epkb-main-page-content').trigger('main_content_changed');
                } else {
                    //noinspection JSUnresolvedVariable
                    msg = response.message ? response.message : epkb_admin_notification('', epkb_vars.reload_try_again, 'error');
                }

            }).fail( function ( response, textStatus, error )
            {
                //noinspection JSUnresolvedVariable
                msg = ( error ? ' [' + error + ']' : epkb_vars.unknown_error );
                //noinspection JSUnresolvedVariable
                msg = epkb_admin_notification(epkb_vars.error_occurred + '. ' + epkb_vars.msg_try_again, msg, 'error');
            }).always(function ()
            {
                $('#epkb-ajax-in-progress').dialog('close');

               // epkb_set_tabs_width();

                if ( msg ) {
                    $('.epkb-kb-config-notice-message').replaceWith(msg);
                    $( "html, body" ).animate( {scrollTop: 0}, "slow" );
                }
            });
        }
    }


    /********************************************************************************************
     *
     *                TABS LAYOUT
     *
     ********************************************************************************************/

    {
        // Set Tabs with based on how many are there and divide it up based on the container width.
    	/*function epkb_set_tabs_width() {
            var containerWidth = $('#epkb-content-container').outerWidth();
            var tabCount = $('.epkb_top_categories').length;
            $('.epkb_top_categories').css("width", ( containerWidth / tabCount ));
        }
        epkb_set_tabs_width();*/

        //Get the highest height of Tab and make all other tabs the same height
    	function epkb_set_tabs_height(){

            var navTabsLi = $('.epkb-nav-tabs li');

            var tallestHeight = 0;

        	$('#epkb-content-container').find( navTabsLi ).each( function(){

                var this_element = $(this).outerHeight(true);
            	if( this_element > tallestHeight ) {
                    tallestHeight = this_element;
                }
            });
            $('#epkb-content-container').find(navTabsLi).css('min-height', tallestHeight);
        }
        epkb_set_tabs_height();

        //Get the highest height of Tab and make all other tabs the same height when user selects Main page
        $( '#epkb-config-main-info').on( 'click', '.epkb-info-pages', function(){
            epkb_set_tabs_height();
        } );


        // Tabs Layout: switch to the top category user clicked on
        $('#epkb-main-page-content').on('click', '.epkb_top_categories', function () {
            // switch tab
            $(this).parent().find('li').removeClass('active');
            $(this).addClass('active');
            // switch content
            $('#epkb-main-page-container').find('.epkb-tab-panel').removeClass('active');
            $('.epkb-panel-container .epkb-tab-panel:nth-child(' + ($(this).index() + 1) + ')').addClass('active');
        });
    }


    /********************************************************************************************
     *
     *                CATEGORY SECTIONS
     *
     ********************************************************************************************/

    {
        /**
         * 1. ICON TOGGLE for Sub Category - toggle between open icon and close icon
         */
        $('#epkb-main-page-content').on('click', '.epkb-section-body .epkb-category-level-2-3', function (){

            var plus_icons = ['ep_icon_plus', 'ep_icon_minus'];
            var plus_icons_box = ['ep_icon_plus_box', 'ep_icon_minus_box'];
            var arrow_icons1 = ['ep_icon_right_arrow', 'ep_icon_down_arrow'];
            var arrow_icons2 = ['ep_icon_arrow_carrot_right', 'ep_icon_arrow_carrot_down'];
            var arrow_icons3 = ['ep_icon_arrow_carrot_right_circle', 'ep_icon_arrow_carrot_down_circle'];
            var folder_icon = ['ep_icon_folder_add', 'ep_icon_folder_open'];

            var icon = $(this).find('i');
            function toggle_category_icons($array) {

                 //If Parameter Icon exists
                if ( icon.hasClass( $array[0] ) ) {

                    icon.removeClass( $array[0] );
                    icon.addClass( $array[1] );

                } else if ( icon.hasClass( $array[1] )) {

                    icon.removeClass( $array[1] );
                    icon.addClass($array[0]);
                }
            }

            toggle_category_icons(plus_icons);
            toggle_category_icons(plus_icons_box);
            toggle_category_icons(arrow_icons1);
            toggle_category_icons(arrow_icons2);
            toggle_category_icons(arrow_icons3);
            toggle_category_icons(folder_icon);
        });

        /**
         *  2. SHOW ITEMS in SUB-CATEGORY
         */
        $('#epkb-main-page-content').on('click', '.epkb-section-body .epkb-category-level-2-3', function () {
            $(this).next().toggleClass('active');
        });

        /**
         * 3. SHOW ALL articles functionality
         *
         * When user clicks on the "Show all articles" it will toggle the "hide" class on all hidden articles
         */
        $('#epkb-main-page-content').on('click', '.epkb-show-all-articles', function () {

            $(this).toggleClass('active');
            var parent = $(this).parent('ul');
            var article = parent.find('li');

            //If this has class "active" then change the text to Hide extra articles
            if ($(this).hasClass('active')) {

                //If Active
                $(this).find('.epkb-show-text').addClass('epkb-hide-elem');
                $(this).find('.epkb-hide-text').removeClass('epkb-hide-elem');

            } else {
                //If not Active
                $(this).find('.epkb-show-text').removeClass('epkb-hide-elem');
                $(this).find('.epkb-hide-text').addClass('epkb-hide-elem');
            }

            $(article).each(function () {

                //If has class "hide" remove it and replace it with class "Visible"
                if ($(this).hasClass('epkb-hide-elem')) {
                    $(this).removeClass('epkb-hide-elem');
                    $(this).addClass('visible');
                } else if ($(this).hasClass('visible')) {
                    $(this).removeClass('visible');
                    $(this).addClass('epkb-hide-elem');
                }
            });
        });
    }


    /********************************************************************************************
     *
     *                OTHER
     *
     ********************************************************************************************/

    // cleanup after Ajax calls
    var epkb_timeout;
    $(document).ajaxComplete(function () {
        epkb_set_layout_preview_box_height();
        clearTimeout(epkb_timeout);

        //Add fadeout class to notice after set amount of time has passed.
        epkb_timeout = setTimeout(function () {
                ekb_admin_page_wrap.find('.epkb-kb-config-notice-message').addClass('fadeOutDown');
            }
            , 10000);

        //Add fadeout class to notice if close icon clicked.
        ekb_admin_page_wrap.find('.epkb-kb-config-notice-message').on('click', '.epkb-close-notice', function (){
            $(this).parent().addClass('fadeOutUp');
        });

        // highlight text for clicked on radio button
        $( '.epkb-config-sidebar' ).find( ":radio" ).on('click', function(){
            epkb_sidebar_highlight_text_for_checked_radio_button( $( this ) );
        });

        //Highlight text for checked radio button
        $( '.epkb-config-sidebar' ).find( ":radio" ).each( function(){
            if( $(this).attr( "checked" ) ) {
                $(this).parent().addClass( 'checked-radio' );
            }
        });


    });

    // SHOW INFO MESSAGES
    function epkb_admin_notification( $title, $message , $type ) {
        return '<div class="epkb-kb-config-notice-message">' +
            '<div class="contents">' +
            '<span class="' + $type + '">' +
            ($title ? '<h4>'+$title+'</h4>' : '' ) +
            ($message ? $message : '') +
            '</span>' +
            '</div>' +
            '</div>';
    }

    // get value of a form field
    function epkb_get_field_value( field_name, valueName ) {
        var values = {};
        $.each($("input[id^=" + field_name + "]").serializeArray(), function (i, field) {
            values[field.name] = field.value;
        });

        return typeof values[valueName] === 'undefined' ? '' : values[valueName];
    }

    // hide welcome section on settings page
    $('#epkb-config-overview-content').find( '#epkb_close_upgrade' ).on( 'click', function() {

        $('#epkb-config-overview-content').find( '.epkb_upgrade_message' ).hide();

        var postData = {
            action: 'epkb_close_upgrade_message'
        };

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: ajaxurl,
            data: postData
        })
    });
});