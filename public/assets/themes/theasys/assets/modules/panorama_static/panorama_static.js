/*
 *  Name : panorama_static
 *  Description : Displays screen when user has choosen the option "Autoplay Enabled" to false
 *  Version : 0.0.5
*/

//THEASYS.theme.autoLoadFunction('panorama_private','init');

THEASYS.theme.modules.panorama_static.initialized = false;

THEASYS.theme.modules.panorama_static.init = function( ){

    var logo = vars.paths.static+'/themes/'+vars.theme+'/assets/img/logo.png';

    var viewer_title = document.head.querySelector("[name~=viewer_title][content]").content;

    var viewer_description = document.head.querySelector("[name~=viewer_description][content]").content;

    if( viewer_description !== '' ){

        if( viewer_description.length > 150 ){

            viewer_description = viewer_description.substring(0,150)+'...';

            var nav_next_icon = '<svg version="1.1" x="0px" y="0px" viewBox="0 0 477.175 477.175"><path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5         c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z"/></svg>';

            viewer_description += '&nbsp;<a id="panorama_static_read_more" href="#">Read more'+nav_next_icon+'</a>';

        }

    }

    var play_button = '<svg version="1.1" viewBox="0 0 512 512"><path d="M256,0C114.833,0,0,114.844,0,256s114.833,256,256,256s256-114.844,256-256S397.167,0,256,0z M357.771,264.969 l-149.333,96c-1.75,1.135-3.771,1.698-5.771,1.698c-1.75,0-3.521-0.438-5.104-1.302C194.125,359.49,192,355.906,192,352V160 c0-3.906,2.125-7.49,5.563-9.365c3.375-1.854,7.604-1.74,10.875,0.396l149.333,96c3.042,1.958,4.896,5.344,4.896,8.969 S360.813,263.01,357.771,264.969z"/></svg>';

    var html = `
        <div id="panorama-static" class="hidden">
            <div id="copyright_start_screen" class="hidden">
                <a target="_blank" rel="noopener" href="${vars.url}">
                    <img src="${logo}" alt="logo" width="150">
                </a>
            </div>
            <div class="logo"></div>
            <div class="play">
                ${play_button}
            </div>
            <div class="txt"><h1 id="panorama-static-title">${viewer_title}</h1></div>
            <div class="description" id="panorama-static-description">${viewer_description}</div>
            <div class="sslinks">
                <span class="sslinks-web"></span>
                <span class="sslinks-map"></span>
                <span class="sslinks-tel"></span>
            </div>
        </div>
        <div id="panorama-static-overlay"></div>
    `;

    $('head').append('<style id="panorama_static_styles" rel="stylesheet" type="text/css"></style>');

    this.applyCustomizations();

    THEASYS.theme.appendHtml(html);

    this.initialized = true;

    THEASYS.renderer.event.on('loadStaticScreen',function( cv, obj, action ){

        THEASYS.theme.modules.panorama_static.applyCustomizations();

        THEASYS.theme.modules.panorama_static.load( cv, obj, action );

    });

    THEASYS.renderer.event.on('resize',function( w, h ){

        if( THEASYS.renderer.vars.get('loaded_static_image') ){

            //$('body').css({'height':h+'px'});

            $('#psi').css({

                width : w+'px',
                height : h+'px',

            });

            $('body').addClass('panorama-static-image').css({

                height : h+'px'

            });

            THEASYS.theme.modules.panorama_static.image_adjust();

        }

    });

};

THEASYS.theme.modules.panorama_static.listenToEdits = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'start_screen_blur':
            case'start_screen_tc':
            case'start_screen_sslinks_o':
            case'start_screen_sslinks_oh':
            case'start_screen_sslinks_s':
            case'start_screen_sslinks_p':
            case'start_screen_sslinks_tc':
            case'start_screen_play_tc':
            case'start_screen_play_o':
            case'start_screen_play_oh':
            case'start_screen_overlay_bc':
            case'start_screen_overlay_bo':
            case'start_screen_overlay_boh':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.'+k,value);

                this.applyCustomizations();

            break;

            case'start_screen_custom_logo_opacity':

                var value = parseFloat(obj[k],10);

                THEASYS.renderer.vars.set('options.start_screen_custom_logo_opacity',value);

                this.applyCustomizations();

            break;

            case'start_screen_custom_logo_size':

                var value = parseInt(obj[k],10);

                THEASYS.renderer.vars.set('options.start_screen_custom_logo_size',value);

                this.applyCustomizations();

            break;

            case'start_screen_website':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.start_screen_website',value);

                THEASYS.theme.modules.panorama_static.load_start_screen_link('website');

            break;

            case'start_screen_website_url':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.start_screen_website_url',value);

                THEASYS.theme.modules.panorama_static.load_start_screen_link('website');

            break;

            case'start_screen_map':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.start_screen_map',value);

                THEASYS.theme.modules.panorama_static.load_start_screen_link('map');

            break;

            case'start_screen_map_url':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.start_screen_map_url',value);

                THEASYS.theme.modules.panorama_static.load_start_screen_link('map');

            break;

            case'start_screen_tel':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.start_screen_tel',value);

                THEASYS.theme.modules.panorama_static.load_start_screen_link('tel');

            break;

            case'start_screen_tel_url':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.start_screen_tel_url',value);

                THEASYS.theme.modules.panorama_static.load_start_screen_link('tel');

            break;

            case'copyright_start_screen':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.copyright_start_screen',value);

                THEASYS.theme.exec('copyright','startScreenAddRemoveClassHidden',value);

            break;

            case'start_screen_custom_logo_display':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.start_screen_custom_logo_display',value);

                if( value ){

                    $('#panorama-static').find('.logo').show();

                } else {

                    $('#panorama-static').find('.logo').hide();

                }

            break;

            case'start_screen_overlay':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.start_screen_overlay',value);

                if( value ){

                    $('#panorama-static-overlay').fadeIn();

                } else {

                    $('#panorama-static-overlay').fadeOut();

                }

            break;

            case'start_screen_logo_insert':

                $('#panorama-static').find('.logo img').attr('src',obj[k]);

                THEASYS.renderer.vars.set('options.start_screen_logo_insert',obj[k]);

            break;

            case'start_screen_logo_delete':

                var src = THEASYS.renderer.vars.get('empty_img');

                $('#panorama-static').find('.logo img').attr('src',src);

                THEASYS.renderer.vars.set('options.start_screen_logo_delete',src);

                //_vars.options.logo_path = '';
                //app.logo = _vars.empty_img;

                //$('#viewer_logo').find('img').attr('src',app.logo);

            break;

            case'start_screen_custom_logo_url':

                THEASYS.renderer.vars.set('options.start_screen_custom_logo_url',obj[k]);

                if( obj[k] !== '' ){

                    var start_screen_custom_logo_a = $('#panorama-static .logo').find('a');

                    if( start_screen_custom_logo_a.length ){

                        start_screen_custom_logo_a.attr('rel','noopener').attr('href',THEASYS.fn.parse_url(obj[k]));

                    } else {

                        $('#panorama-static .logo').find('img').wrap('<a target="_blank" rel="noopener" href="'+THEASYS.fn.parse_url(obj[k])+'"></a>');

                    }

                } else {

                    var start_screen_custom_logo_a = $('#panorama-static .logo').find('a');

                    if( start_screen_custom_logo_a.length ){

                        $('#panorama-static .logo').find('img').unwrap('a');

                    } else {

                        //$('#viewer_logo').find('img').wrap('<a target="_blank" rel="noopener" href="'+_vars.options.logo_url+'"></a>');

                    }

                }

            break;

            case'start_screen_tour_title':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.start_screen_tour_title',value);

                if( value ){

                    $('#panorama-static').find('.txt').show();

                } else {

                    $('#panorama-static').find('.txt').hide();

                }

            break;

            case'start_screen_tour_description':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.start_screen_tour_description',value);

                if( value ){

                    $('#panorama-static').find('.description').show();

                } else {

                    $('#panorama-static').find('.description').hide();

                }

            break;

        }

    }

};

THEASYS.theme.modules.panorama_static.load = function( cv, obj, action ){

    var static_image = THEASYS.renderer.vars.get('static_image');

    $('body').addClass('panorama-static-image').css({

        'background-image' : 'url('+static_image+')',
        filter : "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+static_image+"', sizingMethod='scale')",
        '-ms-filter' : "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+static_image+"', sizingMethod='scale')",
        'height' : $(window).height()+'px'

    });

    var options = THEASYS.renderer.vars.get('options');

    if( options.load_transition == 0 ){


    } else {

        $('body').append('<canvas id="psi" style="display:none;"></canvas>').addClass('panorama-static-image').css({

            //'background-image' : 'url('+image+')',
            //filter : "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+image+"', sizingMethod='scale')",
            //'-ms-filter' : "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+image+"', sizingMethod='scale')",
            'height' : $(window).height()+'px'

        });

        var img = new Image();

        img.crossOrigin = "anonymous";

        img.onload = function(){

            //_vars.loaded_static_image = img;

            THEASYS.renderer.vars.set('loaded_static_image', img);

            THEASYS.theme.modules.panorama_static.image_adjust();

        };

        img.src = static_image;

    }

    var panorama_static = $('#panorama-static');

    panorama_static.removeClass('hidden');

    $('#viewer').addClass('hidden').hide();

    $('#viewer_menu').addClass('hidden');

    var empty_img = THEASYS.renderer.vars.get('empty_img');

    var uid = THEASYS.renderer.vars.get('uid');

    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

    panorama_static.find('.logo').html('<img src="'+empty_img+'" alt="logo">');

    var editing = THEASYS.renderer.vars.get('editing');

    if( !editing ){

        if( ~~options.start_screen_custom_logo_display ){

            if( options.start_screen_custom_logo_display_image !== '' ){

                var static_logo_image = vars.paths.options+'/'+uid+'/'+tour_rnd+'/'+options.start_screen_custom_logo_display_image_path;

                panorama_static.find('.logo').html('<img src="'+static_logo_image+'" alt="logo">');

            }

            panorama_static.find('.logo').show();

        } else {

            panorama_static.find('.logo').hide();

        }

    } else {

        if( ~~options.start_screen_logo_display ){

        }

        if( options.start_screen_custom_logo_display_image !== '' ){

            var static_logo_image = vars.paths.options+'/'+uid+'/'+tour_rnd+'/'+options.start_screen_custom_logo_display_image_path;

            panorama_static.find('.logo').html('<img src="'+static_logo_image+'" alt="logo">');

            if( ~~options.start_screen_custom_logo_display ){

                panorama_static.find('.logo').show();

            } else {

                panorama_static.find('.logo').hide();

            }

        } else {

            panorama_static.find('.logo').show();

        }

    }

    if( 'start_screen_custom_logo_url' in options && options.start_screen_custom_logo_url !== '' ){

        panorama_static.find('.logo img').wrap('<a target="_blank" rel="noopener" href="'+THEASYS.fn.parse_url(options.start_screen_custom_logo_url)+'"></a>');

    }

    if( ~~options.start_screen_tour_title ){

        panorama_static.find('.txt').show();

    } else {

        panorama_static.find('.txt').hide();

    }

    if( ~~options.start_screen_tour_description ){

        var wh = $(window).height();

        var psh = $('#panorama-static').outerHeight();

        if( psh > wh ){

            panorama_static.find('.description').show();

        }

    } else {

        panorama_static.find('.description').hide();

    }

    $('.toggle-vr-wrapper').addClass('hidden');

    if( ~~options.start_screen_overlay ){

        $('#panorama-static-overlay').show();

    } else {

        $('#panorama-static-overlay').hide();

    }

    this.load_start_screen_link('website');

    this.load_start_screen_link('map');

    this.load_start_screen_link('tel');

    $('#viewer_wrapper').removeClass('hidden');

    THEASYS.theme.exec('loader','hide');

    panorama_static.find('.play').on('click',function(e){

        e.preventDefault();

        //THEASYS.theme.exec('loader','show');

        THEASYS.renderer.init( obj, cv, function(){

            THEASYS.renderer.resize();

            panorama_static.hide();

            $('#panorama-static-overlay').hide();

            $('#viewer_menu').removeClass('hidden');

            $('.toggle-vr-wrapper').removeClass('hidden');

            THEASYS.renderer.processAutoRotation();

            //panorama_static.fadeOut(function(){

            $('body').removeClass('panorama-static-image').css({

                'background-image' : 'none',
                'height' : 'auto',

            });

            var toggle_info_elem = $('#viewer_menu').find('.toggle-info');

            if( !toggle_info_elem.hasClass('hidden') ){

                if( ~~options.titles_open_by_default ){

                    toggle_info_elem.trigger('click');

                }

            }

            //});

            $('#panorama-static-overlay').fadeOut();

            THEASYS.theme.exec('loader','hide');

        }, function(){

            $('#viewer').removeClass('hidden').show();

            panorama_static.hide();

            $('#panorama-static-overlay').hide();

        });

    }).on('mouseover',function(e){

        $('#panorama-static-overlay').addClass('overlay-opac');

    }).on('mouseout',function(e){

        $('#panorama-static-overlay').removeClass('overlay-opac');

    });

    $('#panorama_static_read_more').on('click',function(e) {

        e.preventDefault();

        var html_content = $('#viewer_description').html();

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

            }
        });

        $('#actions_html_container').find('a.display_info_panel').simulateClick('click');

        return false;

    });

    $('#panorama-static').on('touchmove',function(e) {

        if( !THEASYS.fn.isInIframe() ){

            e.preventDefault();

        }

    });

    $('#panorama-static-overlay').on('touchmove',function(e) {

        if( !THEASYS.fn.isInIframe() ){

            e.preventDefault();

        }

    });

};

THEASYS.theme.modules.panorama_static.image_adjust = function( ){

    var canvas = document.getElementById('psi');

    if( canvas ){

        var loaded_static_image = THEASYS.renderer.vars.get('loaded_static_image');

        if( loaded_static_image ){

            canvas.width = $(window).width();
            canvas.height = $(window).height();

            var ctx = canvas.getContext("2d");

            var ratio = loaded_static_image.width / loaded_static_image.height;

            var newWidth = canvas.width;

            var newHeight = newWidth / ratio;

            if (newHeight < canvas.height) {

                newHeight = canvas.height;

                newWidth = newHeight * ratio;

            }

            var xOffset = newWidth > canvas.width ? (canvas.width - newWidth) / 2 : 0;

            var yOffset = newHeight > canvas.height ? (canvas.height - newHeight) / 2 : 0;

            ctx.drawImage(loaded_static_image, xOffset, yOffset, newWidth, newHeight);

        }

    }

};

THEASYS.theme.modules.panorama_static.load_start_screen_link = function(type){

    var options = THEASYS.renderer.vars.get('options');

    var panorama_static = $('#panorama-static');

    switch( type ){

        case 'website':

            if( ~~options.start_screen_website ){

                var url = options.start_screen_website_url;

                url = url.trim();

                if( url !== '' ){

                    url =  THEASYS.fn.parse_url(url);

var website = `
<svg version="1.1" viewBox="0 0 511.997 511.997">
<g transform="translate(1 1)">
    <g>
        <g>
            <path d="M211.26,389.24l-60.331,60.331c-25.012,25.012-65.517,25.012-90.508,0.005c-24.996-24.996-24.996-65.505-0.005-90.496
                l120.683-120.683c24.991-24.992,65.5-24.992,90.491,0c8.331,8.331,21.839,8.331,30.17,0c8.331-8.331,8.331-21.839,0-30.17
                c-41.654-41.654-109.177-41.654-150.831,0L30.247,328.909c-41.654,41.654-41.654,109.177,0,150.831
                c41.649,41.676,109.177,41.676,150.853,0l60.331-60.331c8.331-8.331,8.331-21.839,0-30.17S219.591,380.909,211.26,389.24z"/>
            <path d="M479.751,30.24c-41.654-41.654-109.199-41.654-150.853,0l-72.384,72.384c-8.331,8.331-8.331,21.839,0,30.17
                c8.331,8.331,21.839,8.331,30.17,0l72.384-72.384c24.991-24.992,65.521-24.992,90.513,0c24.991,24.991,24.991,65.5,0,90.491
                L316.845,283.638c-24.992,24.992-65.5,24.992-90.491,0c-8.331-8.331-21.839-8.331-30.17,0s-8.331,21.839,0,30.17
                c41.654,41.654,109.177,41.654,150.831,0l132.736-132.736C521.405,139.418,521.405,71.894,479.751,30.24z"/>
        </g>
    </g>
</g>
</svg>
`;
                    var html = '<a target="_blank" rel="noopener" href="'+url+'">'+website+'</a>';

                    panorama_static.find('.sslinks-web').html(html);

                } else {

                    panorama_static.find('.sslinks-web').html('');

                }

            } else {

                panorama_static.find('.sslinks-web').html('');

            }

        break;

        case 'map':

            if( ~~options.start_screen_map ){

                var url = options.start_screen_map_url;

                url = url.trim();

                if( url !== '' ){

                    url = THEASYS.fn.parse_url(url);

var map = `
<svg height="682pt" viewBox="-119 -21 682 682.66669">
    <path d="m216.210938 0c-122.664063 0-222.460938 99.796875-222.460938 222.460938 0 154.175781 222.679688 417.539062 222.679688 417.539062s222.242187-270.945312 222.242187-417.539062c0-122.664063-99.792969-222.460938-222.460937-222.460938zm67.121093 287.597656c-18.507812 18.503906-42.8125 27.757813-67.121093 27.757813-24.304688 0-48.617188-9.253907-67.117188-27.757813-37.011719-37.007812-37.011719-97.226562 0-134.238281 17.921875-17.929687 41.761719-27.804687 67.117188-27.804687 25.355468 0 49.191406 9.878906 67.121093 27.804687 37.011719 37.011719 37.011719 97.230469 0 134.238281zm0 0"/>
</svg>
`;

                    var html = '<a target="_blank" rel="noopener" href="'+url+'">'+map+'</a>';

                    panorama_static.find('.sslinks-map').html(html);

                } else {

                    panorama_static.find('.sslinks-map').html('');

                }

            } else {

                panorama_static.find('.sslinks-map').html('');

            }

        break;

        case 'tel':

            if( ~~options.start_screen_tel ){

                var url = ''+options.start_screen_tel_url;

                url = url.trim();

                if( url !== '' ){

var tel = `
<svg version="1.1" viewBox="0 0 401.998 401.998">
    <path d="M401.129,311.475c-1.137-3.426-8.371-8.473-21.697-15.129c-3.61-2.098-8.754-4.949-15.41-8.566
        c-6.662-3.617-12.709-6.95-18.13-9.996c-5.432-3.045-10.521-5.995-15.276-8.846c-0.76-0.571-3.139-2.234-7.136-5
        c-4.001-2.758-7.375-4.805-10.14-6.14c-2.759-1.327-5.473-1.995-8.138-1.995c-3.806,0-8.56,2.714-14.268,8.135
        c-5.708,5.428-10.944,11.324-15.7,17.706c-4.757,6.379-9.802,12.275-15.126,17.7c-5.332,5.427-9.713,8.138-13.135,8.138
        c-1.718,0-3.86-0.479-6.427-1.424c-2.566-0.951-4.518-1.766-5.858-2.423c-1.328-0.671-3.607-1.999-6.845-4.004
        c-3.244-1.999-5.048-3.094-5.428-3.285c-26.075-14.469-48.438-31.029-67.093-49.676c-18.649-18.658-35.211-41.019-49.676-67.097
        c-0.19-0.381-1.287-2.19-3.284-5.424c-2-3.237-3.333-5.518-3.999-6.854c-0.666-1.331-1.475-3.283-2.425-5.852
        s-1.427-4.709-1.427-6.424c0-3.424,2.713-7.804,8.138-13.134c5.424-5.327,11.326-10.373,17.7-15.128
        c6.379-4.755,12.275-9.991,17.701-15.699c5.424-5.711,8.136-10.467,8.136-14.273c0-2.663-0.666-5.378-1.997-8.137
        c-1.332-2.765-3.378-6.139-6.139-10.138c-2.762-3.997-4.427-6.374-4.999-7.139c-2.852-4.755-5.799-9.846-8.848-15.271
        c-3.049-5.424-6.377-11.47-9.995-18.131c-3.615-6.658-6.468-11.799-8.564-15.415C98.986,9.233,93.943,1.997,90.516,0.859
        C89.183,0.288,87.183,0,84.521,0c-5.142,0-11.85,0.95-20.129,2.856c-8.282,1.903-14.799,3.899-19.558,5.996
        c-9.517,3.995-19.604,15.605-30.264,34.826C4.863,61.566,0.01,79.271,0.01,96.78c0,5.135,0.333,10.131,0.999,14.989
        c0.666,4.853,1.856,10.326,3.571,16.418c1.712,6.09,3.093,10.614,4.137,13.56c1.045,2.948,2.996,8.229,5.852,15.845
        c2.852,7.614,4.567,12.275,5.138,13.988c6.661,18.654,14.56,35.307,23.695,49.964c15.03,24.362,35.541,49.539,61.521,75.521
        c25.981,25.98,51.153,46.49,75.517,61.526c14.655,9.134,31.314,17.032,49.965,23.698c1.714,0.568,6.375,2.279,13.986,5.141
        c7.614,2.854,12.897,4.805,15.845,5.852c2.949,1.048,7.474,2.43,13.559,4.145c6.098,1.715,11.566,2.905,16.419,3.576
        c4.856,0.657,9.853,0.996,14.989,0.996c17.508,0,35.214-4.856,53.105-14.562c19.219-10.656,30.826-20.745,34.823-30.269
        c2.102-4.754,4.093-11.273,5.996-19.555c1.909-8.278,2.857-14.985,2.857-20.126C401.99,314.814,401.703,312.819,401.129,311.475z"
        />
</svg>
`;

                    var html = '<a target="_blank" rel="noopener" href="tel:'+url+'">'+tel+'</a>';

                    panorama_static.find('.sslinks-tel').html(html);

                } else {

                    panorama_static.find('.sslinks-tel').html('');

                }

            } else {

                panorama_static.find('.sslinks-tel').html('');

            }

        break;

    }

};

THEASYS.theme.modules.panorama_static.applyCustomizations = function(){

    var options = THEASYS.renderer.vars.get('options');

    var style = '';

    if( 'start_screen_overlay_bc' in options && 'start_screen_overlay_bo' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.start_screen_overlay_bc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.start_screen_overlay_bo+')';

            style += '#panorama-static-overlay{background:'+rgba+'!important;}';

        }

    }

    if( 'start_screen_overlay_bc' in options && 'start_screen_overlay_boh' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.start_screen_overlay_bc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.start_screen_overlay_boh+')';

            style += '#panorama-static-overlay.overlay-opac{background:'+rgba+'!important;}';

        }

    }

    if( 'start_screen_custom_logo_opacity' in options ){

        style += '#panorama-static .logo img{opacity: '+options.start_screen_custom_logo_opacity+'!important;}';

    }

    if( 'start_screen_blur' in options ){

        //style += '#panorama-static-overlay{backdrop-filter: blur('+options.start_screen_blur+'px);-webkit-backdrop-filter: blur('+options.start_screen_blur+'px);-moz-backdrop-filter: blur('+options.start_screen_blur+'px);}';
        //style += '#panorama-static-overlay{filter: blur('+options.start_screen_blur+'px);-webkit-filter: blur('+options.start_screen_blur+'px);-moz-filter: blur('+options.start_screen_blur+'px);}';

    }

    if( 'start_screen_play_tc' in options ){

        style += '#panorama-static .play svg path{fill: '+options.start_screen_play_tc+'!important;}';

    }

    if( 'start_screen_play_o' in options ){

        style += '#panorama-static .play{opacity: '+options.start_screen_play_o+'!important;}';

    }

    if( 'start_screen_play_oh' in options ){

        style += '#panorama-static .play:hover{opacity: '+options.start_screen_play_oh+'!important;}';

    }

    if( 'start_screen_tc' in options ){

        style += '#panorama-static{color: '+options.start_screen_tc+'!important;}';

        style += '#panorama-static a{color: '+options.start_screen_tc+'!important;}';

    }

    if( 'start_screen_sslinks_tc' in options ){

        style += '#panorama-static .sslinks svg path{fill: '+options.start_screen_sslinks_tc+'!important;}';

    }

    if( 'start_screen_sslinks_s' in options ){

        style += '#panorama-static .sslinks svg{width: '+options.start_screen_sslinks_s+'px!important;height: '+options.start_screen_sslinks_s+'px!important;}';

    }

    if( 'start_screen_sslinks_o' in options ){

        style += '#panorama-static .sslinks svg{opacity: '+options.start_screen_sslinks_o+'!important;}';

    }

    if( 'start_screen_sslinks_oh' in options ){

        style += '#panorama-static .sslinks svg:hover{opacity: '+options.start_screen_sslinks_oh+'!important;}';

    }

    if( 'start_screen_sslinks_p' in options ){

        style += '#panorama-static .sslinks svg{margin: auto '+options.start_screen_sslinks_p+'px!important;}';

    }

    if( 'start_screen_custom_logo_size' in options ){

        var m200 = ( options.start_screen_custom_logo_size * 200 ) / 100;

        var m100 = ( options.start_screen_custom_logo_size * 100 ) / 100;

        style += `
        #panorama-static .logo img{max-height: ${m100}px;}
        @media(max-width: 767px) {#panorama-static .logo img {max-width: ${m200}px;}}
        `;

    }

    $('#panorama_static_styles').html(style);

};