/*
 *  Name : panorama_vr
 *  Description : VR e.t.c.
 *  Version : 0.0.3
*/

THEASYS.theme.autoLoadFunction('panorama_vr','init');

THEASYS.theme.modules.panorama_vr.initialized = false;

THEASYS.theme.modules.panorama_vr.init = function( ){

    var phone_landscape = THEASYS.vars.paths.static+'/themes/'+THEASYS.vars.theme+'/assets/modules/panorama_vr/img/phone-landscape.png';

    var html = `
        <div id="panorama-vr-vertical-lock" class="hidden">
            <div class="txt">
                <div class="icon">
                    <img src="${phone_landscape}" alt="phone landscape">
                </div>
                Please rotate your device into the landscape position to use the VR mode.<button class="exit"><span class="vertical_lock_exit_img"></span><span class="vertical_lock_exit_txt">Exit VR mode</span></button>
            </div>
        </div>
        <div id="viewer_left_target" class="viewer_target"><span></span></div>
        <div id="viewer_right_target" class="viewer_target"><span></span></div>
    `;

    THEASYS.theme.appendHtml(html);

    THEASYS.renderer.vars.set('viewer_left_target',$('#viewer_left_target'));

    THEASYS.renderer.vars.set('viewer_right_target',$('#viewer_right_target'));

    var cd = THEASYS.vars.paths.static+'/themes/'+THEASYS.vars.theme+'/assets/modules/panorama_vr/img/cardboard-dark.png';

    $('#panorama-vr-vertical-lock').find('.vertical_lock_exit_img').css({

        'background-image' : "url('"+cd+"')"

    });

    var cd = THEASYS.vars.paths.static+'/themes/'+THEASYS.vars.theme+'/assets/modules/panorama_vr/img/stoxos_eps.png';

    $('.viewer_target').css({

        'background-image' : "url('"+cd+"')",
        'background-repeat' : "no-repeat"

    });

    this.initialized = true;

    THEASYS.renderer.event.on('vrVerticalLock',function( state ){

        THEASYS.theme.modules.panorama_vr.vertical_lock( state );

    });

    THEASYS.renderer.event.on('loadedOnce',function(){

        var options = THEASYS.renderer.vars.get('options');

        var isMobile = THEASYS.renderer.vars.get('device.isMobile');

        if( !isMobile ) {

            if( 'vr_mode_active_on_load_desktop' in options ){

                if( ~~options.vr_mode_active_on_load_desktop ){

                    THEASYS.theme.modules.panorama_vr.processMenu();

                }

            }

        } else {

            if( 'vr_mode_active_on_load_mobile' in options ){

                if( ~~options.vr_mode_active_on_load_mobile ){

                    THEASYS.theme.modules.panorama_vr.processMenu();

                }

            }

        }

    });

    THEASYS.renderer.event.on('toggleVr',function(vr){

        var isMobile = THEASYS.renderer.vars.get('device.isMobile');

        if( vr ){

            if( isMobile ){

            }

        } else {

            if( isMobile ){

                $('#panorama-vr-vertical-lock').addClass('hidden');

            }

        }

    });

};

THEASYS.theme.modules.panorama_vr.vertical_lock = function( state ){

    state = state || 0;

    if(state){

        $('#panorama-vr-vertical-lock').removeClass('hidden');

        $('#panorama-vr-vertical-lock').find('.exit').off('click').on('click',function(){

            THEASYS.renderer.toggleVr(0);

        });

    } else {

        $('#panorama-vr-vertical-lock').addClass('hidden');

    }

};

THEASYS.theme.modules.panorama_vr.processMenu = function( vr ){

    if( vr === undefined ){

        var vr = THEASYS.renderer.vars.get('vr');

    }

    var isMobile = THEASYS.renderer.vars.get('device.isMobile');

    if( vr ){

        $('#viewer_menu .toggle-vr').addClass('active');

        if( isMobile ){

            $('#viewer_menu').addClass('hidden');
            $('#map_button_wrapper').addClass('hidden');

            //$('#tooltip').hide();

            $('#thumbnails-wrapper').addClass('hidden');

        }

    } else {

        $('#viewer_menu .toggle-vr').removeClass('active');

        if( isMobile ){

            $('#viewer_menu').removeClass('hidden');
            $('#map_button_wrapper').removeClass('hidden');

            $('#thumbnails-wrapper').removeClass('hidden');

            $('#panorama-vr-vertical-lock').addClass('hidden');

        }

    }

    THEASYS.renderer.resize();

};