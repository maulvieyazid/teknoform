/*
 *  Name : Menu
 *  Description : Displays a menu
 *  Version : 0.0.3
*/

THEASYS.theme.autoLoadFunction('menu','init');

THEASYS.theme.modules.menu.initialized = false;

THEASYS.theme.modules.menu.init = function( callback ){

    var options = THEASYS.renderer.vars.get('options');

    var option_menu_visible = ~~options.menu_visible;

    var editing = THEASYS.renderer.vars.get('editing');

    var device = THEASYS.renderer.vars.get('device');

    THEASYS.theme.appendHtml('<div id="viewer_menu"></div>',document.getElementById('viewer_wrapper'));

    if( !option_menu_visible && !editing ){

        //return false;

    }

    if( THEASYS.theme.modules.menu.created ){

        return false;

    }

    var html = '';

    html = '<div class="viewer_menu_wrapper">';
    html += '   <div class="viewer_menu-bars">';

    //lets load the menu icons

    var innerHtml = '';

    //GYROSCOPE

    var menu_visible_gyroscope_exists = 0;

    if( device.isMobile ){

        if( editing ){

            menu_visible_gyroscope_exists = 1;

        } else {

            if( ~~options.gyroscope ){

                menu_visible_gyroscope_exists = 1;

            }

        }

        if( menu_visible_gyroscope_exists ){

            var gyroscope_icon = `
<svg version="1.1" viewBox="0 0 426.667 426.667" style="enable-background:new 0 0 426.667 426.667;">
        <g>
            <path d="M213.333,236.8c13.013,0,23.467-10.56,23.467-23.467s-10.453-23.467-23.467-23.467c-12.907,0-23.467,10.56-23.467,23.467
                S200.427,236.8,213.333,236.8z"/>
            <path d="M213.333,0C95.467,0,0,95.467,0,213.333c0,117.76,95.467,213.333,213.333,213.333s213.333-95.573,213.333-213.333
                C426.667,95.467,331.2,0,213.333,0z M260.053,260.053l-174.72,81.28l81.28-174.72l174.72-81.28L260.053,260.053z"/>
        </g>
</svg>
            `;

            html += '<span class="menubars toggle_gyroscope'+(~~options.gyroscope === 0 ? ' hidden':'')+'">'+gyroscope_icon+'</span>';

        }

    }

    //VR

    var menu_visible_vr_mode_exists = 0;

    if( editing ){

        menu_visible_vr_mode_exists = 1;

    } else {

        if( ~~options.vr_mode ){

            menu_visible_vr_mode_exists = 1;

        }

    }

    if( menu_visible_vr_mode_exists ){

        var vr_icon = `
<svg height="512pt" viewBox="0 -96 512 512" width="512pt"><path d="m448.800781 319.199219h-92.464843c-16.867188 0-32.75-6.5625-44.726563-18.484375l-32.132813-32.132813c-6.183593-6.214843-14.722656-9.753906-23.476562-9.753906-8.757812 0-17.296875 3.539063-23.429688 9.703125l-32.15625 32.15625c-12 11.949219-27.882812 18.511719-44.75 18.511719h-92.464843c-34.351563 0-63.199219-27.765625-63.199219-63.199219v-192.800781c0-35.292969 28.71875-63.199219 63.199219-63.199219h385.601562c34.351563 0 63.199219 27.769531 63.199219 63.199219v192.800781c0 35.296875-28.71875 63.199219-63.199219 63.199219zm-192.800781-90.371094c16.683594 0 32.972656 6.761719 44.695312 18.542969l32.109376 32.113281c6.285156 6.253906 14.648437 9.714844 23.53125 9.714844h92.464843c18.039063 0 33.199219-14.601563 33.199219-33.199219v-192.800781c0-18.605469-15.171875-33.199219-33.199219-33.199219h-385.601562c-18.039063 0-33.199219 14.601562-33.199219 33.199219v192.800781c0 18.609375 15.171875 33.199219 33.199219 33.199219h92.464843c8.878907 0 17.246094-3.460938 23.558594-9.746094l32.132813-32.128906c11.671875-11.734375 27.960937-18.496094 44.644531-18.496094zm0 0"/><path d="m143.53125 222.800781c-34.847656 0-63.199219-28.351562-63.199219-63.199219 0-34.847656 28.351563-63.203124 63.199219-63.203124 34.851562 0 63.203125 28.355468 63.203125 63.203124 0 34.847657-28.351563 63.199219-63.203125 63.199219zm0-96.402343c-18.304688 0-33.199219 14.894531-33.199219 33.203124 0 18.304688 14.894531 33.199219 33.199219 33.199219 18.308594 0 33.203125-14.894531 33.203125-33.199219 0-18.308593-14.894531-33.203124-33.203125-33.203124zm0 0"/><path d="m368.46875 222.800781c-34.851562 0-63.203125-28.351562-63.203125-63.199219 0-34.847656 28.351563-63.203124 63.203125-63.203124 34.847656 0 63.199219 28.355468 63.199219 63.203124 0 34.847657-28.351563 63.199219-63.199219 63.199219zm0-96.402343c-18.308594 0-33.203125 14.894531-33.203125 33.203124 0 18.304688 14.894531 33.199219 33.203125 33.199219 18.304688 0 33.199219-14.894531 33.199219-33.199219 0-18.308593-14.894531-33.203124-33.199219-33.203124zm0 0"/></svg>
        `;

        html += '<span class="menubars toggle-vr'+(~~options.vr_mode === 0 ? ' hidden':'')+'">'+vr_icon+'</span>';

    }

    //QUALITY

    var menu_visible_quality_exists = 0;

    if( device.isMobile ){

        if( editing ){

            menu_visible_quality_exists = 1;

        } else {

            if( ~~options.quality ){

                menu_visible_quality_exists = 1;

            }

        }

        if( menu_visible_quality_exists ){

            //html += '<span class="menubars toggle_quality'+(~~options.quality === 0 ? ' hidden':'')+'"><img src="'+THEASYS.vars.paths.static+'/themes/'+THEASYS.vars.theme+'/assets/modules/menu/img/hd.png" alt="HD Quality"></span>';

        }

    }

    //INFO

    var info_icon = `
<svg version="1.1" viewBox="0 0 330 330" style="enable-background:new 0 0 330 330;">
    <path d="M165,0C74.019,0,0,74.02,0,165.001C0,255.982,74.019,330,165,330s165-74.018,165-164.999C330,74.02,255.981,0,165,0z
         M165,300c-74.44,0-135-60.56-135-134.999C30,90.562,90.56,30,165,30s135,60.562,135,135.001C300,239.44,239.439,300,165,300z"/>
    <path d="M164.998,70c-11.026,0-19.996,8.976-19.996,20.009c0,11.023,8.97,19.991,19.996,19.991
        c11.026,0,19.996-8.968,19.996-19.991C184.994,78.976,176.024,70,164.998,70z"/>
    <path d="M165,140c-8.284,0-15,6.716-15,15v90c0,8.284,6.716,15,15,15c8.284,0,15-6.716,15-15v-90C180,146.716,173.284,140,165,140z
        "/>
</svg>
    `;

    html += '<span class="menubars toggle-info hidden">'+info_icon+'</span>';

    //MENU DOTS

    var menu_dots_icon = `
<svg version="1.1" enable-background="new 0 0 515.555 515.555" viewBox="0 0 515.555 515.555"><path d="m303.347 18.875c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138c25.166-25.167 65.97-25.167 91.138 0"/><path d="m303.347 212.209c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138c25.166-25.167 65.97-25.167 91.138 0"/><path d="m303.347 405.541c25.167 25.167 25.167 65.971 0 91.138s-65.971 25.167-91.138 0-25.167-65.971 0-91.138c25.166-25.167 65.97-25.167 91.138 0"/></svg>
    `;

    html += '<span class="menubars menu_dots">'+menu_dots_icon+'</span>';

    html += '</div>';

    //SUB MENU
    html += '       <div class="viewer_menu-submenu"></div>';

    html +='    </div>';
    html +='</div>';

    var viewer_menu = $('#viewer_menu');

    $('head').append('<style id="menu_styles" rel="stylesheet" type="text/css"></style>');

    THEASYS.theme.modules.menu.applyCustomizations();

    viewer_menu.append(html);


    this.createEvents();

    this.createSubmenu(function(){

        if( option_menu_visible ){

            viewer_menu.animate({opacity:1},500);

        }

        if( parseInt( options.menu_opened_by_default, 10 ) ){

            if( parseInt( options.menu_visible, 10) ){

                viewer_menu.find('.viewer_menu-bars .menu_dots').trigger('click');

            }

        }

        callback();

    });

    this.initialized = true;

    if( option_menu_visible ){

        viewer_menu.animate({opacity:1},500);

    }

    this.closeOnActions();

    this.autoRotationMenu();

    viewer_menu.on('click',function(){

        //THEASYS.theme.modules.menu.closeOnActions();

    });

    THEASYS.renderer.event.on('userAction',function(){

        THEASYS.theme.modules.menu.closeOnActions();

    });

    THEASYS.renderer.event.on('gyroscope',function(){

        THEASYS.theme.modules.menu.gyroscopeMenu();

    });

    THEASYS.renderer.event.on('autoRotation',function(){

        THEASYS.theme.modules.menu.autoRotationMenu();

    });

    THEASYS.renderer.event.on('hotspotsToggle',function(hotspotsDisplay){

        if( hotspotsDisplay ){

            $('#viewer_menu').find('.toggle-hotspots').addClass('selected');

        } else {

            $('#viewer_menu').find('.toggle-hotspots').removeClass('selected');

        }

    });

    THEASYS.renderer.event.on('toggleVr',function( vr ){

        var isMobile = THEASYS.renderer.vars.get('device.isMobile');

        if( vr ){

            $('#viewer_menu .toggle-vr').addClass('active');

            if( isMobile ){

                $('#viewer_menu').addClass('hidden');

            }

        } else {

            $('#viewer_menu .toggle-vr').removeClass('active');

            if( isMobile ){

                $('#viewer_menu').removeClass('hidden');

            }

        }

    });

};

THEASYS.theme.modules.menu.api = function( action, key, value ){

    if( key === 'menu' ){
console.log(action);
        switch( action ){

            case'set':

                var val = -1;

                console.error(value);

                if( value !== undefined && value !== null && !isNaN(value) ){

                    val = parseInt(value,10);

                    this.toggle(val);

                }

            break;

        }

    }

};

THEASYS.theme.modules.menu.listenToEdits = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'menu_visible':

                var value = +obj[k];

                if( value ){

                    $('#viewer_menu').find('.menu_dots').removeClass('hidden');

                } else {

                    $('#viewer_menu').find('.menu_dots').addClass('hidden');

                }

                THEASYS.renderer.vars.set('options.menu_visible',value);

                THEASYS.theme.exec('shadow','display');

            break;

            case'auto_rotation':

                if( !obj[k] ){

                    $('#viewer_menu').find('.toggle_auto_rotate').addClass('hidden');

                } else {

                    $('#viewer_menu').find('.toggle_auto_rotate').removeClass('hidden');

                }

                THEASYS.renderer.vars.set('options.auto_rotation',+obj[k]);

            break;

            case'fullscreen':

                if( !obj[k] ){

                    $('#viewer_menu').find('.toggle_full_screen').addClass('hidden');

                } else {

                    $('#viewer_menu').find('.toggle_full_screen').removeClass('hidden');

                }

                THEASYS.renderer.vars.set('options.fullscreen',+obj[k]);

            break;

            case'vr_mode':

                var value = +obj[k];

                if( !value ){

                    $('#viewer_menu').find('.toggle-vr').addClass('hidden');

                } else {

                    $('#viewer_menu').find('.toggle-vr').removeClass('hidden');

                }

                THEASYS.renderer.vars.set('options.vr_mode',value);

                THEASYS.theme.exec('shadow','display');

            break;

            case'gyroscope':

                var value = +obj[k];

                if( !value ){

                    $('#viewer_menu').find('.toggle_gyroscope').addClass('hidden');

                } else {

                    $('#viewer_menu').find('.toggle_gyroscope').removeClass('hidden');

                }

                THEASYS.renderer.vars.set('options.gyroscope',value);

                THEASYS.theme.exec('shadow','display');

            break;

            case'quality':

                var value = +obj[k];

                if( !value ){

                    $('#viewer_menu').find('.toggle_quality').addClass('hidden');

                } else {

                    $('#viewer_menu').find('.toggle_quality').removeClass('hidden');

                }

                THEASYS.renderer.vars.set('options.quality',value);

                THEASYS.theme.exec('shadow','display');

            break;

            case'background_sound':

                if( !obj[k] ){

                    $('#viewer_menu').find('.toggle-sounds').addClass('hidden');

                } else {

                    $('#viewer_menu').find('.toggle-sounds').removeClass('hidden');

                }

                THEASYS.renderer.vars.set('options.background_sound',+obj[k]);

            break;

            case'menu_close_on_actions':

                THEASYS.renderer.vars.set('options.menu_close_on_actions',+obj[k]);

            break;

            case'share_menu':

                if( !obj[k] ){

                    $('#viewer_menu').find('.menu_share').addClass('hidden');

                } else {

                    $('#viewer_menu').find('.menu_share').removeClass('hidden');

                }

                THEASYS.renderer.vars.set('options.share_menu',+obj[k]);

            break;

            case'hotspots_display':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.hotspots_display',value);

                var thh = $('#viewer_menu').find('.toggle-hotspots').hasClass('thh');

                if( !thh ){

                    if( !value ){

                        $('#viewer_menu').find('.toggle-hotspots').addClass('hidden');

                    } else {

                        $('#viewer_menu').find('.toggle-hotspots').removeClass('hidden');

                    }

                }

            break;

            case'menu_bo':
            case'menu_bc':
            case'menu_br':
            case'menu_tc':
            case'menu_di':
            case'menu_stc':
            case'menu_sbc':
            case'menu_sbo':
            case'menu_sbr':
            case'menu_s_tc':
            case'menu_s_bc':
            case'menu_s_bo':
            case'menu_s_br':
            case'menu_s_di':
            case'menu_s_stc':
            case'menu_s_sbc':
            case'menu_s_sbo':
            case'menu_s_sbr':
            case'menu_s_dbo':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.'+k,value);

                this.applyCustomizations();

            break;

        }

    }

};


THEASYS.theme.modules.menu.created = 0;
THEASYS.theme.modules.menu.created_submenu = 0;

THEASYS.theme.modules.menu.createEvents = function(data){

    //if( !THEASYS.theme.modules.menu.created ){

    //    return false;

    //}

    var options = THEASYS.renderer.vars.get('options');
    var device = THEASYS.renderer.vars.get('device');
    var editing = THEASYS.renderer.vars.get('editing');
    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

    var viewer_menu = $('#viewer_menu');

    var option_menu_visible = ~~options.menu_visible;

    var menu_visible_event_click = 0;

    if( editing ){

        menu_visible_event_click = 1;

    } else {

        if( option_menu_visible ){

            menu_visible_event_click = 1;

        }

    }

    if( menu_visible_event_click ){

        viewer_menu.on('click','.viewer_menu-bars .menu_dots',function(){

            THEASYS.theme.modules.menu.toggle();

        });

    }

    if( editing ){

        if( !option_menu_visible ){

            viewer_menu.find('.menu_dots').addClass('hidden');

        }

    } else {

        if( !option_menu_visible ){

            viewer_menu.find('.menu_dots').addClass('hidden');

        }

    }

    //QUALITY

    var menu_visible_quality_exists = 0;

    if( device.isMobile ){

        if( editing ){

            menu_visible_quality_exists = 1;

        } else {

            if( ~~options.quality ){

                menu_visible_quality_exists = 1;

            }

        }

    }

    if( menu_visible_quality_exists ){

        if( 'quality_active_on_load' in options && options.quality_active_on_load ){

            viewer_menu.find('.toggle_quality').addClass('active');

        }

        viewer_menu.on('click','.toggle_quality',function(){

            THEASYS.renderer.toggleQuality();

            THEASYS.theme.modules.menu.autoHide();

        });

    }

    //GYROSCOPE

    var menu_visible_gyroscope_exists = 0;

    if( device.isMobile ){

        if( editing ){

            menu_visible_gyroscope_exists = 1;

        } else {

            if( ~~options.gyroscope ){

                menu_visible_gyroscope_exists = 1;

            }

        }

    }

    if( menu_visible_gyroscope_exists ){

        viewer_menu.on('click','.toggle_gyroscope',function(event){

            var iDevices = [
                'iPad Simulator',
                'iPhone Simulator',
                'iPod Simulator',
                'iPad',
                'iPhone',
                'iPod'
            ];

            var isIos = false;

            if (!!navigator.platform) {

                while (iDevices.length) {

                    if (navigator.platform === iDevices.pop()){

                        isIos = true;

                        break;

                    }

                }

            }

            if( isIos ){

                if( THEASYS.fn.isInIframe() ){

                    if ( window.DeviceOrientationEvent !== undefined && typeof window.DeviceOrientationEvent.requestPermission === 'function' ) {

                        window.parent.postMessage({'action':'gyroscope'},'*');

                    } else {

                        THEASYS.renderer.toggleGyroscope();

                    }

                } else {

                    THEASYS.renderer.toggleGyroscope();

                }

            } else {

                THEASYS.renderer.toggleGyroscope();

            }

            THEASYS.theme.modules.menu.autoHide();

        });

    }

    //VR
    var menu_visible_vr_mode_exists = 0;

    if( editing ){

        menu_visible_vr_mode_exists = 1;

    } else {

        if( ~~options.vr_mode ){

            menu_visible_vr_mode_exists = 1;

        }

    }

    if( menu_visible_vr_mode_exists ){

        viewer_menu.on('click','.toggle-vr',function(){

            if(  device.isMobile && document.webkitFullscreenElement === undefined ){

                if( THEASYS.fn.isInIframe() ){

                    window.location.hash = 'vr';
                    //load in new window
                    window.open(window.location.href);

                } else {

                    THEASYS.renderer.toggleVr();

                }

            } else {

                THEASYS.renderer.toggleVr();

            }

            THEASYS.theme.modules.menu.autoHide();

        });

        $(document).on("keyup", function(e) {

            var vr = THEASYS.renderer.vars.get('vr');

            if(vr){

                if(e.which === 27){

                    THEASYS.renderer.toggleVr();

                }

            }

        });

    }


    //AUTO HIDE MENU ON VIEWER CLICK

    var createHideMenuEventsOnClose = 0;

    if( editing ){

        createHideMenuEventsOnClose = 1;

    } else {

        if( ~~options.menu_close_on_actions ){

            createHideMenuEventsOnClose = 1;

        }

    }

    if( createHideMenuEventsOnClose ){

        $('#viewer').on('click',function(){

            THEASYS.theme.modules.menu.autoHide();

        });

    }

};

THEASYS.theme.modules.menu.createSubmenu = function(callback){

    THEASYS.api.engine.execute('get','menu',null,function(data){

        if( 'menu' in data ){

            if( !data.menu.status ){

                //return false;

            }

            var html = '';

            if( data.menu.status ){

                if( 'auto_rotation' in data.menu.items && data.menu.items.auto_rotation.exists ){

                    var auto_rotation_icon = `
<svg version="1.1" viewBox="0 0 467.871 467.871" style="enable-background:new 0 0 467.871 467.871;">
<g>
    <path d="M392.098,344.131c-6.597-5.014-16.007-3.729-21.019,2.868c-0.962,1.266-1.948,2.516-2.957,3.751
        c-15.046,18.411-35.315,33.36-60.321,44.474c-0.124,0.055-0.247,0.111-0.369,0.17c-39.456,18.831-85.618,21.405-129.896,7.274
        c-38.875-12.657-70.505-37.162-94.017-72.837c-17.462-27.997-26.613-58.428-27.264-90.524c-0.016-0.781-0.015-1.564-0.021-2.346
        h18.402c6.919,0,10.384-8.365,5.491-13.257L46.7,190.277c-3.033-3.033-7.95-3.033-10.983,0L2.29,223.704
        c-4.892,4.892-1.427,13.257,5.491,13.257H26.21c0.24,38.722,10.983,75.351,31.963,108.92c0.062,0.099,0.125,0.196,0.188,0.294
        c27.356,41.581,64.327,70.186,109.971,85.046c21.87,6.979,44.152,10.447,66.102,10.447c29.833-0.001,59.045-6.407,85.737-19.113
        c31.267-13.929,56.432-33.243,74.793-57.405C399.977,358.554,398.693,349.144,392.098,344.131z"/>
    <path d="M460.09,233.876h-18.428c-0.001-4.112-0.123-8.271-0.364-12.362c-1.913-32.411-11.568-64.326-27.921-92.295
        c-15.945-27.271-38.292-50.932-64.626-68.426c-26.774-17.787-57.774-29.226-89.649-33.079
        c-35.426-4.283-71.452,0.578-104.185,14.052c-32.1,13.213-60.653,34.522-82.572,61.623c-5.21,6.44-4.211,15.886,2.229,21.096
        c6.442,5.209,15.886,4.211,21.096-2.23c1.12-1.385,2.264-2.75,3.424-4.1c18.274-21.253,41.418-38.016,67.242-48.646
        c27.995-11.523,58.83-15.678,89.166-12.011c27.25,3.294,53.754,13.074,76.648,28.284c22.546,14.979,41.679,35.234,55.329,58.58
        c13.98,23.91,22.235,51.2,23.871,78.92c0.104,1.763,0.182,3.54,0.235,5.32c0.052,1.76,0.077,3.522,0.078,5.275h-18.426
        c-6.919,0-10.384,8.365-5.491,13.257l33.427,33.427c3.033,3.033,7.95,3.033,10.983,0l33.427-33.427
        C470.473,242.241,467.008,233.876,460.09,233.876z"/>
</g>
</svg>
                    `;

                    html += '  <div data-tooltip="Auto Rotation" class="toggle_auto_rotate'+(data.menu.items.auto_rotation.status === 0 ? ' hidden':'')+'"><span class="viewer_menu_item_img">'+auto_rotation_icon+'</span><span class="viewer_menu_item_txt">Auto Rotation</span></div>';

                }

                if( 'fullscreen' in data.menu.items && data.menu.items.fullscreen.exists ){

var fullscreen_icon = `
<svg version="1.1" viewBox="0 0 512 512">
        <g>
            <path d="M335.085,207.085L469.333,72.837V128c0,11.782,9.551,21.333,21.333,21.333S512,139.782,512,128V21.335
                c0-0.703-0.037-1.406-0.106-2.107c-0.031-0.316-0.09-0.622-0.135-0.933c-0.054-0.377-0.098-0.755-0.172-1.13
                c-0.071-0.358-0.169-0.705-0.258-1.056c-0.081-0.323-0.152-0.648-0.249-0.968c-0.104-0.345-0.234-0.678-0.355-1.015
                c-0.115-0.319-0.22-0.641-0.35-0.956c-0.13-0.315-0.284-0.616-0.428-0.923c-0.153-0.324-0.297-0.651-0.467-0.969
                c-0.158-0.294-0.337-0.574-0.508-0.86c-0.186-0.311-0.362-0.626-0.565-0.93c-0.211-0.316-0.447-0.613-0.674-0.917
                c-0.19-0.253-0.366-0.513-0.568-0.76c-0.443-0.539-0.909-1.058-1.402-1.551c-0.004-0.004-0.007-0.008-0.011-0.012
                c-0.004-0.004-0.008-0.006-0.011-0.01c-0.494-0.493-1.012-0.96-1.552-1.403c-0.247-0.203-0.507-0.379-0.761-0.569
                c-0.303-0.227-0.6-0.462-0.916-0.673c-0.304-0.203-0.619-0.379-0.931-0.565c-0.286-0.171-0.565-0.35-0.859-0.508
                c-0.318-0.17-0.644-0.314-0.969-0.467c-0.307-0.145-0.609-0.298-0.923-0.429c-0.315-0.13-0.637-0.236-0.957-0.35
                c-0.337-0.121-0.669-0.25-1.013-0.354c-0.32-0.097-0.646-0.168-0.969-0.249c-0.351-0.089-0.698-0.187-1.055-0.258
                c-0.375-0.074-0.753-0.119-1.13-0.173c-0.311-0.044-0.617-0.104-0.933-0.135C492.072,0.037,491.37,0,490.667,0H384
                c-11.782,0-21.333,9.551-21.333,21.333c0,11.782,9.551,21.333,21.333,21.333h55.163L304.915,176.915
                c-8.331,8.331-8.331,21.839,0,30.17S326.754,215.416,335.085,207.085z"/>
            <path d="M176.915,304.915L42.667,439.163V384c0-11.782-9.551-21.333-21.333-21.333C9.551,362.667,0,372.218,0,384v106.667
                c0,0.703,0.037,1.405,0.106,2.105c0.031,0.315,0.09,0.621,0.135,0.933c0.054,0.377,0.098,0.756,0.173,1.13
                c0.071,0.358,0.169,0.704,0.258,1.055c0.081,0.324,0.152,0.649,0.249,0.969c0.104,0.344,0.233,0.677,0.354,1.013
                c0.115,0.32,0.22,0.642,0.35,0.957c0.13,0.315,0.284,0.616,0.429,0.923c0.153,0.324,0.297,0.651,0.467,0.969
                c0.158,0.294,0.337,0.573,0.508,0.859c0.186,0.311,0.362,0.627,0.565,0.931c0.211,0.316,0.446,0.612,0.673,0.916
                c0.19,0.254,0.366,0.514,0.569,0.761c0.443,0.54,0.91,1.059,1.403,1.552c0.004,0.004,0.006,0.008,0.01,0.011
                c0.004,0.004,0.008,0.007,0.012,0.011c0.493,0.492,1.012,0.959,1.551,1.402c0.247,0.203,0.507,0.379,0.76,0.568
                c0.304,0.227,0.601,0.463,0.917,0.674c0.303,0.203,0.618,0.379,0.93,0.565c0.286,0.171,0.565,0.35,0.86,0.508
                c0.318,0.17,0.645,0.314,0.969,0.467c0.307,0.145,0.609,0.298,0.923,0.428c0.315,0.13,0.636,0.235,0.956,0.35
                c0.337,0.121,0.67,0.25,1.015,0.355c0.32,0.097,0.645,0.168,0.968,0.249c0.351,0.089,0.698,0.187,1.056,0.258
                c0.375,0.074,0.753,0.118,1.13,0.172c0.311,0.044,0.618,0.104,0.933,0.135c0.7,0.069,1.402,0.106,2.104,0.106
                c0,0,0.001,0,0.001,0H128c11.782,0,21.333-9.551,21.333-21.333s-9.551-21.333-21.333-21.333H72.837l134.248-134.248
                c8.331-8.331,8.331-21.839,0-30.17S185.246,296.584,176.915,304.915z"/>
            <path d="M507.736,503.425c0.226-0.302,0.461-0.598,0.671-0.913c0.204-0.304,0.38-0.62,0.566-0.932
                c0.17-0.285,0.349-0.564,0.506-0.857c0.17-0.318,0.315-0.646,0.468-0.971c0.145-0.306,0.297-0.607,0.428-0.921
                c0.13-0.315,0.236-0.637,0.35-0.957c0.121-0.337,0.25-0.669,0.354-1.013c0.097-0.32,0.168-0.646,0.249-0.969
                c0.089-0.351,0.187-0.698,0.258-1.055c0.074-0.375,0.118-0.753,0.173-1.13c0.044-0.311,0.104-0.617,0.135-0.933
                c0.069-0.701,0.106-1.404,0.106-2.107V384c0-11.782-9.551-21.333-21.333-21.333s-21.333,9.551-21.333,21.333v55.163
                L335.085,304.915c-8.331-8.331-21.839-8.331-30.17,0s-8.331,21.839,0,30.17l134.248,134.248H384
                c-11.782,0-21.333,9.551-21.333,21.333S372.218,512,384,512h106.667c0.703,0,1.405-0.037,2.105-0.106
                c0.315-0.031,0.621-0.09,0.933-0.135c0.377-0.054,0.756-0.098,1.13-0.173c0.358-0.071,0.704-0.169,1.055-0.258
                c0.324-0.081,0.649-0.152,0.969-0.249c0.344-0.104,0.677-0.233,1.013-0.354c0.32-0.115,0.642-0.22,0.957-0.35
                c0.314-0.13,0.615-0.283,0.921-0.428c0.325-0.153,0.653-0.297,0.971-0.468c0.293-0.157,0.572-0.336,0.857-0.506
                c0.312-0.186,0.628-0.363,0.932-0.566c0.315-0.211,0.611-0.445,0.913-0.671c0.255-0.191,0.516-0.368,0.764-0.571
                c0.535-0.439,1.05-0.903,1.54-1.392c0.008-0.007,0.016-0.014,0.023-0.021s0.014-0.016,0.021-0.023
                c0.488-0.49,0.952-1.004,1.392-1.54C507.368,503.941,507.545,503.68,507.736,503.425z"/>
            <path d="M72.837,42.667H128c11.782,0,21.333-9.551,21.333-21.333C149.333,9.551,139.782,0,128,0H21.333c0,0-0.001,0-0.001,0
                c-0.702,0-1.405,0.037-2.104,0.106c-0.316,0.031-0.622,0.09-0.933,0.135c-0.377,0.054-0.755,0.098-1.13,0.172
                c-0.358,0.071-0.705,0.169-1.056,0.258c-0.323,0.081-0.648,0.152-0.968,0.249c-0.345,0.104-0.678,0.234-1.015,0.355
                c-0.319,0.115-0.641,0.22-0.956,0.35c-0.315,0.131-0.618,0.284-0.925,0.43c-0.323,0.152-0.65,0.296-0.967,0.466
                c-0.295,0.158-0.575,0.338-0.862,0.509C10.106,3.215,9.791,3.39,9.488,3.593c-0.317,0.212-0.615,0.448-0.92,0.676
                C8.316,4.458,8.057,4.633,7.812,4.835C6.725,5.727,5.727,6.725,4.835,7.812C4.633,8.057,4.458,8.316,4.269,8.569
                c-0.228,0.305-0.464,0.603-0.676,0.92c-0.203,0.303-0.378,0.617-0.564,0.928c-0.171,0.286-0.351,0.567-0.509,0.862
                c-0.17,0.317-0.313,0.643-0.466,0.967c-0.145,0.307-0.299,0.61-0.43,0.925c-0.13,0.315-0.235,0.636-0.35,0.956
                c-0.121,0.337-0.25,0.67-0.355,1.015c-0.097,0.32-0.168,0.645-0.249,0.968c-0.089,0.351-0.187,0.698-0.258,1.056
                c-0.074,0.375-0.118,0.753-0.172,1.13c-0.044,0.311-0.104,0.618-0.135,0.933C0.037,19.928,0,20.63,0,21.333V128
                c0,11.782,9.551,21.333,21.333,21.333c11.782,0,21.333-9.551,21.333-21.333V72.837l134.248,134.248
                c8.331,8.331,21.839,8.331,30.17,0s8.331-21.839,0-30.17L72.837,42.667z"/>
        </g>
</svg>
`;

                    html += '  <div data-tooltip="Toggle FullScreen" class="toggle_full_screen'+(data.menu.items.fullscreen.status === 0 ? ' hidden':'')+'"><span class="viewer_menu_item_img">'+fullscreen_icon+'</span><span class="viewer_menu_item_txt">FullScreen</span></div>';

                }

                if( 'hotspots' in data.menu.items && data.menu.items.hotspots.exists ){

var hotspots_icon = `
<svg version="1.1" viewBox="0 0 512.013 512.013">
        <g>
            <path d="M372.653,244.726l22.56,22.56l112-112c6.204-6.241,6.204-16.319,0-22.56l-112-112l-22.56,22.72l84.8,84.64H0.013v32
                h457.44L372.653,244.726z"/>
            <path d="M512.013,352.086H54.573l84.8-84.64l-22.72-22.72l-112,112c-6.204,6.241-6.204,16.319,0,22.56l112,112l22.56-22.56
                l-84.64-84.64h457.44V352.086z"/>
        </g>

</svg>
`;

                    html += '  <div data-tooltip="Hotspots" class="toggle-hotspots'+(data.menu.items.hotspots.status === 0 ? ' hidden':'')+'"><span class="viewer_menu_item_img">'+hotspots_icon+'</span><span class="viewer_menu_item_txt">Hotspots</span></div>';

                }

                if( 'audio' in data.menu.items && data.menu.items.audio.exists ){

var audio_icon = `
<svg version="1.1" viewBox="0 0 477.526 477.526">
    <g>
        <path d="M213.333,104.461c-5.28-3.049-11.786-3.049-17.067,0L80.794,170.424H17.067C7.641,170.424,0,178.065,0,187.49v102.4
            c0,9.426,7.641,17.067,17.067,17.067h63.727l115.541,66.014c8.185,4.675,18.609,1.83,23.284-6.354
            c1.472-2.577,2.246-5.492,2.247-8.46V119.224C221.86,113.133,218.608,107.507,213.333,104.461z"/>
    </g>
    <g>
        <path d="M286.362,176.79c-5.909-7.331-16.639-8.492-23.979-2.594c-7.347,5.904-8.517,16.647-2.613,23.994
            c0,0,0.001,0.001,0.001,0.002c17.649,24.115,17.649,56.883,0,80.998c-5.95,7.31-4.847,18.06,2.463,24.01s18.06,4.847,24.01-2.463
            c0.039-0.048,0.078-0.096,0.117-0.145C314.284,264.047,314.284,213.334,286.362,176.79z"/>
    </g>
    <g>
        <path d="M354.628,125.59c-5.909-7.331-16.639-8.492-23.979-2.594c-7.347,5.904-8.517,16.647-2.612,23.994
            c0,0.001,0.001,0.001,0.001,0.002c40.653,54.374,40.653,129.024,0,183.398c-5.95,7.31-4.847,18.06,2.463,24.01
            c7.31,5.95,18.06,4.847,24.01-2.463c0.039-0.048,0.078-0.096,0.117-0.145C404.771,284.727,404.771,192.654,354.628,125.59z"/>
    </g>
    <g>
        <path d="M422.895,74.39c-5.95-7.31-16.7-8.413-24.01-2.463c-7.254,5.904-8.405,16.547-2.58,23.865
            c63.352,84.734,63.352,201.065,0,285.798c-5.95,7.31-4.847,18.06,2.463,24.01c7.31,5.95,18.06,4.847,24.01-2.463
            c0.039-0.048,0.078-0.096,0.117-0.145C495.736,305.567,495.736,171.813,422.895,74.39z"/>
    </g>
</svg>
`;

                    html += '  <div data-tooltip="Sounds" class="toggle-sounds hidden"><span class="viewer_menu_item_img">'+audio_icon+'</span><span class="viewer_menu_item_txt">Sounds</span></div>';

                }

                if( 'share' in data.menu.items && data.menu.items.share.exists ){

var share_icon = `
<svg version="1.1" viewBox="0 0 512 512">
    <g>
        <path d="M406,332c-29.641,0-55.761,14.581-72.167,36.755L191.99,296.124c2.355-8.027,4.01-16.346,4.01-25.124
            c0-11.906-2.441-23.225-6.658-33.636l148.445-89.328C354.307,167.424,378.589,180,406,180c49.629,0,90-40.371,90-90
            c0-49.629-40.371-90-90-90c-49.629,0-90,40.371-90,90c0,11.437,2.355,22.286,6.262,32.358l-148.887,89.59
            C156.869,193.136,132.937,181,106,181c-49.629,0-90,40.371-90,90c0,49.629,40.371,90,90,90c30.13,0,56.691-15.009,73.035-37.806
            l141.376,72.395C317.807,403.995,316,412.75,316,422c0,49.629,40.371,90,90,90c49.629,0,90-40.371,90-90
            C496,372.371,455.629,332,406,332z"/>
    </g>
</svg>
`;

                    html += '  <div data-tooltip="Share" class="menu_share'+(!data.menu.items.share.status ? ' hidden':'')+'"><span class="viewer_menu_item_img">'+share_icon+'</span><span class="viewer_menu_item_txt">Share</span></div>';

                }

            }

            var viewer_menu = $('#viewer_menu');

            viewer_menu.find('.viewer_menu-submenu').append(html);

            THEASYS.theme.modules.menu.createSubMenuEvents(data);

            THEASYS.renderer.event.trigger('autoRotation');

        }

        if( typeof callback === 'function' ){

            callback();

        }

    });

};


THEASYS.theme.modules.menu.createSubMenuEvents = function(data){

    if( !THEASYS.theme.modules.menu.created ){

        //return false;

    }

    var options = THEASYS.renderer.vars.get('options');
    var device = THEASYS.renderer.vars.get('device');
    var editing = THEASYS.renderer.vars.get('editing');
    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

    var viewer_menu = $('#viewer_menu');

    var option_menu_visible = ~~options.menu_visible;

    //AUDIO

    if( 'audio' in data.menu.items && data.menu.items.audio.exists ){

        viewer_menu.on('click','.toggle-sounds',function(e){

            THEASYS.theme.modules.audio.endedPlaying = 0;

            THEASYS.theme.exec('audio','toggle');

            THEASYS.theme.modules.menu.autoHide();

        });

        if( ( 'audio' in THEASYS.cache.obj.tours[tour_rnd].tour ) && THEASYS.cache.obj.tours[tour_rnd].tour.audio ){

            if( parseInt(options.background_sound,10) ){

                viewer_menu.find('.toggle-sounds').removeClass('hidden');

            }

        }

    }

    //REVISIT HOTSPOTS AS CORE FUNCTIONS MUST BE IN RENDERER

    if( 'hotspots' in data.menu.items && data.menu.items.hotspots.exists ){

        if( parseInt(options.hotspots_display,10) ){

            viewer_menu.find('.toggle-hotspots').addClass('selected');

        } else {

            viewer_menu.find('.toggle-hotspots').removeClass('selected');

        }

        viewer_menu.on('click','.toggle-hotspots',function(){

            //THEASYS.theme.modules.menu.toggleHotspots();

            THEASYS.renderer.toggleHotspots();

            THEASYS.theme.modules.menu.autoHide();

        });

    }

    //FULLSCREEN

    if( 'fullscreen' in data.menu.items && data.menu.items.fullscreen.exists ){

        viewer_menu.on('click','.toggle_full_screen',function(){

            $(this).toggleClass('selected');

            THEASYS.renderer.toggleFullScreen();

        });

        $(document).on("fullscreenchange", function(e) {

            var fs = (($(document).fullScreen()?true:false));

            THEASYS.renderer.vars.set('fullScreenEnabled',fs);

            if(!fs){

                THEASYS.theme.exec('maps','mapAutoShrink');

            }

            THEASYS.renderer.resize();

            if(!fs){

                viewer_menu.find('.toggle_full_screen').removeClass('selected');

                THEASYS.renderer.vars.set('isFullScreen',0);

            } else {

                viewer_menu.find('.toggle_full_screen').addClass('selected');

                THEASYS.renderer.vars.set('isFullScreen',1);

            }

        });

    }

    //AUTO ROTATION

    if( 'auto_rotation' in data.menu.items && data.menu.items.auto_rotation.exists ){

        viewer_menu.on('click','.toggle_auto_rotate',function(){

            THEASYS.renderer.toggleAutoRotate();

            THEASYS.theme.modules.menu.autoHide();

        });

    }

    //SHARE

    if( 'share' in data.menu.items && data.menu.items.share.exists ){

        viewer_menu.on('click','.menu_share',function(){

            THEASYS.theme.exec('share','load');

        });

    }

};

THEASYS.theme.modules.menu.toggle = function(state){

    //alert("caller is " + arguments.callee.caller.toString());
    //console.log('THEASYS.theme.modules.menu.toggle',state);

    var option_menu_visible = ~~THEASYS.renderer.vars.get('options.menu_visible');

    if( !option_menu_visible ){

        return false;

    }

    var viewer_menu = $('#viewer_menu');

    if( state !== undefined ){

        if( isNaN(state) ){

            return false;

        }

        var state = parseInt(state,10);

        if( state === 1 ){

            viewer_menu.find('.viewer_menu-submenu').addClass('fadeInUp');
            viewer_menu.find('.menu_dots').addClass('active');

        } else if( state === 0 ) {

            viewer_menu.find('.viewer_menu-submenu').removeClass('fadeInUp');
            viewer_menu.find('.menu_dots').removeClass('active');

        } else {

            viewer_menu.find('.viewer_menu-submenu').toggleClass('fadeInUp');
            viewer_menu.find('.menu_dots').toggleClass('active');

        }

    } else {

        viewer_menu.find('.viewer_menu-submenu').toggleClass('fadeInUp');
        viewer_menu.find('.menu_dots').toggleClass('active');

    }

};

THEASYS.theme.modules.menu.autoHide = function(){

    if( ~~THEASYS.renderer.vars.get('options.menu_close_on_actions') ){

        this.toggle(0);

    }

};

THEASYS.theme.modules.menu.closeOnActions = function(){

    var createHideMenuEventsOnClose = 0;

    if( THEASYS.renderer.vars.get('editing') ){

        createHideMenuEventsOnClose = 1;

    } else {

        if( ~~THEASYS.renderer.vars.get('options.menu_close_on_actions') ){

            createHideMenuEventsOnClose = 1;

        }

    }

    if( createHideMenuEventsOnClose ){

        this.autoHide();

    }

};

THEASYS.theme.modules.menu.autoRotationMenu = function(){

    //if( ~~THEASYS.renderer.vars.get('options.menu_close_on_actions') ){

        if( THEASYS.renderer.vars.get('options.auto_rotation') ){

            viewer_menu = $('#viewer_menu');

            viewer_menu.find('.toggle_auto_rotate').removeClass('hidden');

            var auto_rotation = THEASYS.renderer.vars.get('auto_rotation');
            var auto_rotation_enabled = THEASYS.renderer.vars.get('auto_rotation_enabled');

            //console.log( auto_rotation.status, auto_rotation_enabled );

            if( auto_rotation.status ){

                if( auto_rotation_enabled ) {

                    viewer_menu.find('.toggle_auto_rotate').addClass('selected');

                    //if( _vars.autoRotationDisabledBecauseOfInteraction ) {

                        //$('#viewer_menu').find('.toggle_auto_rotate').removeClass('selected');

                    //}

                } else {

                    viewer_menu.find('.toggle_auto_rotate').removeClass('selected');

                }

                viewer_menu.find('.toggle_auto_rotate').removeClass('disabled');

            } else {

                viewer_menu.find('.toggle_auto_rotate').removeClass('selected');
                viewer_menu.find('.toggle_auto_rotate').addClass('disabled');

            }

        } else {

            $('#viewer_menu').find('.toggle_auto_rotate').addClass('hidden');

        }

        if( ~~THEASYS.renderer.vars.get('options.auto_rotation_starting_panorama') ){

            //$('#viewer_menu').find('.toggle_auto_rotate').removeClass('hidden');
            //$('#viewer_menu').find('.toggle_auto_rotate').removeClass('disabled');
            //$('#viewer_menu').find('.toggle_auto_rotate').addClass('selected');

        } else {

            //$('#viewer_menu').find('.toggle_auto_rotate').removeClass('selected');

        }

    //}

};

THEASYS.theme.modules.menu.gyroscopeMenu = function(){

    var gyroscope = THEASYS.renderer.vars.get('gyroscope');

    if( gyroscope ){

        $('#viewer_menu .toggle_gyroscope').addClass('active');

    } else {

        $('#viewer_menu .toggle_gyroscope').removeClass('active');

    }

};

THEASYS.theme.modules.menu.trigger = function(data){

    if( data === 'info' ){

        $('#viewer_menu .toggle-info').simulateClick('click');

    } else if( data === 'sounds' ){

        $('#viewer_menu .toggle-sounds').simulateClick('click');

    } else if( data === 'fullscreen' ){

        $('#viewer_menu .toggle_full_screen').simulateClick('click');

    } else if( data === 'share' ){

        $('#viewer_menu .menu_share').simulateClick('click');

    } else if( data === 'vr' ){

        $('#viewer_menu .toggle-vr').simulateClick('click');

    } else if( data === 'gyroscope' ){

        $('#viewer_menu .toggle_gyroscope').simulateClick('click');

    } else if( data === 'hotspots' ){

        $('#viewer_menu .toggle-hotspots').simulateClick('click');

    }

};

THEASYS.theme.modules.menu.applyCustomizations = function(){

    var options = THEASYS.renderer.vars.get('options');

    var style = '';

    if( 'menu_bc' in options && 'menu_bo' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.menu_bc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.menu_bo+')';

            style += '#viewer_menu span.menubars{background:'+rgba+'!important;}';

        }

    }

    if( 'menu_br' in options ){

        style += '#viewer_menu span.menubars{border-radius: '+options.menu_br+'%!important;}';

    }

    if( 'menu_tc' in options ){

        style += '#viewer_menu span.menubars svg path{fill: '+options.menu_tc+'!important;}';

    }

    if( 'menu_di' in options ){

        style += '#viewer_menu span.menubars{margin-left: '+options.menu_di+'px!important;}';
    }

    if( 'menu_sbc' in options && 'menu_sbo' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.menu_sbc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.menu_sbo+')';

            style += '#viewer_menu span.menubars.active{background:'+rgba+'!important;}';

        }

    }

    if( 'menu_sbr' in options ){

        style += '#viewer_menu span.menubars.active{border-radius: '+options.menu_sbr+'%!important;}';

    }

    if( 'menu_stc' in options ){

        style += '#viewer_menu span.menubars.active svg path{fill: '+options.menu_stc+'!important;}';

    }


    if( 'menu_s_bc' in options && 'menu_s_bo' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.menu_s_bc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.menu_s_bo+')';

            style += '#viewer_menu .viewer_menu-submenu{background:'+rgba+'!important;}';

        }

    }

    if( 'menu_s_br' in options ){

        style += '#viewer_menu .viewer_menu-submenu{border-radius: '+options.menu_s_br+'px!important;}';

    }

    if( 'menu_s_tc' in options ){

        style += '#viewer_menu .viewer_menu-submenu{color: '+options.menu_s_tc+'!important;}';
        style += '#viewer_menu .viewer_menu-submenu .viewer_menu_item_img svg path{fill: '+options.menu_s_tc+'!important;}';

    }

    if( 'menu_s_di' in options ){

        style += '#viewer_menu .viewer_menu-submenu div{margin: 0 0 '+options.menu_s_di+'px 0px!important;}';
    }

    if( 'menu_s_sbc' in options && 'menu_s_sbo' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.menu_s_sbc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.menu_s_sbo+')';

            style += '#viewer_menu .viewer_menu-submenu div.selected{background:'+rgba+'!important;}';

        }

    }

    if( 'menu_s_sbr' in options ){

        style += '#viewer_menu .viewer_menu-submenu div.selected{border-radius: '+options.menu_s_sbr+'px!important;}';

    }

    if( 'menu_s_stc' in options ){

        style += '#viewer_menu .viewer_menu-submenu div.selected{color: '+options.menu_s_stc+'!important;}';
        style += '#viewer_menu .viewer_menu-submenu div.selected .viewer_menu_item_txt{color: '+options.menu_s_stc+'!important;}';
        style += '#viewer_menu .viewer_menu-submenu div.selected .viewer_menu_item_img svg path{fill: '+options.menu_s_stc+'!important;}';

    }

    if( 'menu_s_dbo' in options ){

        style += '#viewer_menu .viewer_menu-submenu div.disabled{opacity: '+options.menu_s_dbo+'!important;}';

    }

    $('#menu_styles').html(style);

};