/*
 *  Name : Titles
 *  Description : Displays tour/ panorama titles and descriptions
 *  Version : 0.0.5
*/

THEASYS.theme.autoLoadFunction('titles','init');

THEASYS.theme.modules.titles.initialized = false;

THEASYS.theme.modules.titles.html = '';

THEASYS.theme.modules.titles.init = function( ){

    THEASYS.theme.modules.titles.create();

    THEASYS.theme.modules.titles.initialized = true;

    THEASYS.renderer.event.on('init',function(){

        var loadedOnce = THEASYS.renderer.vars.get('loadedOnce');

        if( loadedOnce ){

            THEASYS.theme.modules.titles.create();

        }

    });

    THEASYS.renderer.event.on('resize',function(){

    });

};

THEASYS.theme.modules.titles.listenToEdits = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'titles_cao':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.titles_cao',value);

                if( !value ){

                    THEASYS.fn.clear_cao();

                } else {

                    var action = {

                        t : 'dip',
                        cao : value,
                        status : 1,
                        type : 'display_info_panel',

                    };

                    THEASYS.fn.apply_cao(action);

                }

            break;

            case'titles_tour':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.titles_tour',value);

                this.create();

                THEASYS.theme.exec('shadow','display');

            break;

            case'titles_tour_description':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.titles_tour_description',value);

                this.create();

                THEASYS.theme.exec('shadow','display');

            break;

            case'titles_panorama':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.titles_panorama',value);

                this.create();

                THEASYS.theme.exec('shadow','display');

            break;

            case'titles_panorama_description':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.titles_panorama_description',value);

                this.create();

                THEASYS.theme.exec('shadow','display');

            break;

            case'titles_open_by_default':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.titles_open_by_default',value);

                this.create();

                THEASYS.theme.exec('shadow','display');

            break;

            case'titles_use_theme_font':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.'+k,value);

                this.applyCustomizations();

            break;

        }

    }

};

THEASYS.theme.modules.titles.getHtml = function( ){

    var html = '';

    var options = THEASYS.renderer.vars.get('options');
    var id = THEASYS.renderer.vars.get('id');
    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

    var viewer_title = document.head.querySelector("[name~=viewer_title][content]").content;

    var viewer_description = $('#viewer_description').html();

    if( ~~options.titles_tour ){

        html += '<div id="viewer_titles-tour_title">'+viewer_title+'</div>';

    }

    if( viewer_description && viewer_description !== '' ){

        viewer_description = viewer_description.trim();

        if( ~~options.titles_tour_description ){

            html += '<div id="viewer_titles-tour_description">'+viewer_description+'</div>';

        }

    }

    var panoramaTitle = '';

    if( id ){

        if( 'title' in THEASYS.cache.obj.tours[tour_rnd].panoramas[id] ){

            panoramaTitle = THEASYS.cache.obj.tours[tour_rnd].panoramas[id].title;

        }

    }

    if( panoramaTitle !== '' ){

        panoramaTitle = panoramaTitle.trim();

        if( ~~options.titles_panorama ){

            html += '<div id="viewer_titles-panorama_title">'+panoramaTitle+'</div>';

        }

    }

    var panoramaDescription = THEASYS.cache.obj.tours[tour_rnd].panoramas[id].description;

    if( panoramaDescription !== '' ){

        panoramaDescription = panoramaDescription.trim();

        if( ~~options.titles_panorama_description ){

            html += '<div id="viewer_titles-panorama_description">'+panoramaDescription+'</div>';

        }

    }

    return html;

}

THEASYS.theme.modules.titles.create = function( ){

    THEASYS.theme.modules.titles.html = '';

    var options = THEASYS.renderer.vars.get('options');
    var id = THEASYS.renderer.vars.get('id');
    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

    var display_info_button_titles_tour = 0;
    var display_info_button_titles_description = 0;
    var display_info_button_titles_panorama = 0;
    var display_info_button_titles_panorama_description = 0;

    var viewer_title = document.head.querySelector("[name~=viewer_title][content]").content;

    var viewer_description = $('#viewer_description').html();

    if( ~~options.titles_tour ){

        display_info_button_titles_tour = 1;

    }

    var tourDescription = viewer_description;

    if( tourDescription && tourDescription !== '' ){

        tourDescription = tourDescription.trim();

        if( ~~options.titles_tour_description ){

            display_info_button_titles_description = 1;

        }

    }

    var panoramaTitle = '';

    if( id ){

        if( 'title' in THEASYS.cache.obj.tours[tour_rnd].panoramas[id] ){

            panoramaTitle = THEASYS.cache.obj.tours[tour_rnd].panoramas[id].title;

        }

    }

    if( panoramaTitle !== '' ){

        panoramaTitle = panoramaTitle.trim();

        if( ~~options.titles_panorama ){

            display_info_button_titles_panorama = 1;

        }

    }

    var panoramaDescription = THEASYS.cache.obj.tours[tour_rnd].panoramas[id].description;

    if( panoramaDescription !== '' ){

        panoramaDescription = panoramaDescription.trim();

        if( ~~options.titles_panorama_description ){

            display_info_button_titles_panorama_description = 1;

        }

    }

    this.createEvents();

    $('head').append('<style id="titles_styles" rel="stylesheet" type="text/css"></style>');

    this.applyCustomizations();

    if( display_info_button_titles_tour || display_info_button_titles_description || display_info_button_titles_panorama || display_info_button_titles_panorama_description  ){

        $('#viewer_menu').find('.toggle-info').removeClass('hidden');

        $('#action_html_content').html( this.getHtml() );

        var loadedOnce = THEASYS.renderer.vars.get('loadedOnce');

        if( !loadedOnce ){

            if( ~~options.titles_open_by_default && ~~options.autoplay ){

                $('#viewer_menu').find('.toggle-info').trigger('click');

            }

        }

    } else {

        $.fancybox.getInstance('close');

        if( !loadedOnce ){

            if( ~~options.titles_open_by_default ){

                THEASYS.theme.on_initialized('audio',function(){

                    THEASYS.theme.modules.titles.closeInfo();

                });

            }

        }

        THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',false);

        $('#viewer_menu').find('.toggle-info').addClass('hidden');

    }

};


THEASYS.theme.modules.titles.eventsCreated = 0;

THEASYS.theme.modules.titles.createEvents = function( ){

    if( this.eventsCreated ){

        return false;

    }

    $('#viewer_menu').on('click','.toggle-info',function(){

        THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',true);

        var html_content = THEASYS.theme.modules.titles.getHtml();

        var html = `
            <a class="display_info_panel" data-fancybox="action_html_content" data-src="#action_html_content" href="javascript:;"></a>
            <div id="action_html_content" class="redactor-styles fancybox-info-panel popup-info-panel popup-info-panel-titles">
                ${html_content}
            </div>
        `;

        $('#actions_html_container').html(html);

        $(".display_info_panel").fancybox({
            infobar: false,
            smallBtn: true,
            hash: false,
            onActivate: function(instance) {

                var options = THEASYS.renderer.vars.get('options');

                var titles_cao = 'titles_cao' in options && options.titles_cao || null;

                if( !titles_cao ){

                    THEASYS.fn.clear_cao(instance.id);

                } else {

                    var action = {

                        t : 'dip',
                        cao : titles_cao,
                        status : 1,
                        type : 'display_info_panel',

                    };

                    THEASYS.fn.apply_cao(action,instance.id);

                }

            },
            afterClose: function(instance) {

                THEASYS.fn.clear_cao(instance.id);

                THEASYS.theme.modules.titles.closeInfo();

                THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',false);

            }
        });

        $('#actions_html_container').find('a.display_info_panel').simulateClick('click');

    });

    this.eventsCreated = 1;

};

THEASYS.theme.modules.titles.closeInfo = function( ){

    THEASYS.theme.exec('audio','setAudio');

};

THEASYS.theme.modules.titles.applyCustomizations = function(){

    var options = THEASYS.renderer.vars.get('options');

    var style = '';

    if( 'titles_use_theme_font' in options ){

        if( ~~options.titles_use_theme_font ){

            style += '.popup-info-panel-titles{font-family: unset;}';

            style += '#viewer_titles-tour_title{font-family: unset;}';

            style += '#viewer_titles-panorama_title{font-family: unset;}';

            style += '#viewer_titles-panorama_description{font-family: unset;}';

        } else {

            style += '.popup-info-panel-titles{font-family: Arial, sans-serif;}';

            style += '#viewer_titles-tour_title{font-family: Arial, sans-serif;}';

            style += '#viewer_titles-panorama_title{font-family: Arial, sans-serif;}';

            style += '#viewer_titles-panorama_description{font-family: Arial, sans-serif;}';
        }

    }

    $('#titles_styles').html(style);

};