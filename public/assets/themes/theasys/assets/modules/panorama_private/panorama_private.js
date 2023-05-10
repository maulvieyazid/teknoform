/*
 *  Name : panorama_private
 *  Description : Displays a screen where user is prompted to enter password in order to display the panorama
 *  Version : 0.0.4
*/

//THEASYS.theme.autoLoadFunction('panorama_private','init');

THEASYS.theme.modules.panorama_private.initialized = false;

THEASYS.theme.modules.panorama_private.init = function( ){

    var lock_icon = `
<svg version="1.1" viewBox="0 0 512 512">
    <g>
        <path d="M437.333,192h-32v-42.667C405.333,66.99,338.344,0,256,0S106.667,66.99,106.667,149.333V192h-32
            C68.771,192,64,196.771,64,202.667v266.667C64,492.865,83.135,512,106.667,512h298.667C428.865,512,448,492.865,448,469.333
            V202.667C448,196.771,443.229,192,437.333,192z M287.938,414.823c0.333,3.01-0.635,6.031-2.656,8.292
            c-2.021,2.26-4.917,3.552-7.948,3.552h-42.667c-3.031,0-5.927-1.292-7.948-3.552c-2.021-2.26-2.99-5.281-2.656-8.292l6.729-60.51
            c-10.927-7.948-17.458-20.521-17.458-34.313c0-23.531,19.135-42.667,42.667-42.667s42.667,19.135,42.667,42.667
            c0,13.792-6.531,26.365-17.458,34.313L287.938,414.823z M341.333,192H170.667v-42.667C170.667,102.281,208.948,64,256,64
            s85.333,38.281,85.333,85.333V192z"/>
    </g>
</svg>
    `;

    var html = `
        <div id="panorama-private">
            <div class="txt">
                <p>This Virtual Tour is private. Please enter password.</p>
                <div class="input-wrapper">
                    <span class="panorama-private-lock">${lock_icon}</span>
                    <input type="password" id="panorama-private-input">
                    <button id="panorama-private-button">Unlock</button>
                </div>
                <p id="panorama-private-error-empty" class="hidden">Empty password. Please enter a password.</p>
                <p id="panorama-private-error-wrong" class="hidden">Wrong password. Please try again.</p>
            </div>
        </div>
        <div id="panorama-private-overlay_0"></div>
        <div id="panorama-private-overlay_1"></div>
    `;

    $('head').append('<style id="panorama_private_styles" rel="stylesheet" type="text/css"></style>');

    this.applyCustomizations();

    THEASYS.theme.appendHtml(html);

    this.initialized = true;

    THEASYS.renderer.event.on('loadPrivateScreen',function(){

        THEASYS.theme.modules.panorama_private.applyCustomizations();

        THEASYS.theme.modules.panorama_private.load();

    });

};

THEASYS.theme.modules.panorama_private.listenToEdits = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'password_protect_bo':
            case'password_protect_bc':
            case'password_protect_b':
            case'password_protect_g':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.'+k,value);

                this.applyCustomizations();

            break;

            case'password_protect_toggle':

                THEASYS.theme.exec('loader','show');

                if( $('#panorama-private:visible').length ){

                    $('#panorama-private').fadeOut(function(){

                        $('body').removeClass('panorama-pp-bg');
                        $('body').css('background','');

                        $('#panorama-private-overlay_0').hide();
                        $('#panorama-private-overlay_1').hide();

                        $('#panorama-private-input').val('');

                        $('#viewer').removeClass('hidden');
                        $('#viewer_menu').removeClass('hidden');

                        THEASYS.renderer.vars.set('tour_password','');

                        THEASYS.renderer.process();

                    });

                } else {

                    //THEASYS.renderer.callInitAfterTourNoSuccess({code:'ppns'});

                    THEASYS.theme.modules.panorama_private.load();

                }

            break;

        }

    }

};

THEASYS.theme.modules.panorama_private.load = function( ){

    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

    var tour_embed_rnd = THEASYS.renderer.vars.get('tour_embed_rnd');

    if( vars.exported ){

        THEASYS.theme.modules.panorama_private.applyCustomizations(vars.db.embed.options);

        THEASYS.theme.modules.panorama_private.display();

    } else {

        THEASYS.fn.ajax.call({
            url : THEASYS.fn.u('api','viewer'),
            data : {
                action : 'getTourEmbedOptions',
                params : {
                    q : tour_rnd,
                    qe : tour_embed_rnd,
                    e : THEASYS.renderer.vars.get('editing'),
                },
            },
            sessionCheck : false,

        }).then(function(msg){

            if( msg && 'options' in msg ){

                THEASYS.theme.modules.panorama_private.applyCustomizations(msg.options);

            }

            THEASYS.theme.modules.panorama_private.display();

        },function(error) {

            THEASYS.theme.modules.panorama_private.display();

        });

    }

    $('#panorama-private-input').off('keypress').on('keypress',function(e){

        if( e.which === 13 ){

            e.preventDefault();

            $('#panorama-private-button').trigger('click');

            return false;

        }

    });

    $('#panorama-private-button').off('click').on('click',function(e){

        e.preventDefault();

        $('#panorama-private-error-empty').addClass('hidden');

        $('#panorama-private-error-wrong').addClass('hidden');

        var panorama_private_input_elem = $('#panorama-private-input');

        var password = panorama_private_input_elem.val();

        if( password === '' ){

            $('#panorama-private-error-empty').removeClass('hidden');

            panorama_private_input_elem.focus();

            return false;

        } else {

            THEASYS.theme.exec('loader','show');

            var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

            if( vars.exported ){

                if( password === vars.db.tour.private_password ){

                    THEASYS.theme.modules.panorama_private.hide(password);

                } else {

                    $('#panorama-private-error-wrong').removeClass('hidden');

                    panorama_private_input_elem.focus();

                }

                THEASYS.theme.exec('loader','hide');

            } else {

                THEASYS.fn.ajax.call({
                    url : THEASYS.fn.u('api','viewer'),
                    data : {
                        action : 'tourPasswordCheck',
                        params : {
                            p : password,
                            q : tour_rnd,
                        },
                    },
                    sessionCheck : false,

                }).then(function(msg){

                    if(msg){

                        THEASYS.theme.modules.panorama_private.hide(password);

                    } else {

                        $('#panorama-private-error-wrong').removeClass('hidden');

                        panorama_private_input_elem.focus();

                    }

                    THEASYS.theme.exec('loader','hide');

                },function(error) {

                    $('#panorama-private-error-wrong').removeClass('hidden');

                    panorama_private_input_elem.focus();

                    THEASYS.theme.exec('loader','hide');

                });

            }

            return false;

        }

        return false;

    });

};

THEASYS.theme.modules.panorama_private.display = function( ){

    $('body').addClass('panorama-pp-bg');

    var bg = THEASYS.vars.paths.static+'/themes/'+THEASYS.vars.theme+'/assets/modules/panorama_private/img/bg.jpg';

    //$('.panorama-pp-bg').css({
    $('#panorama-private-overlay_0').css({

        'background' : 'url('+bg+') no-repeat center center fixed',
        'filter' : "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+bg+"', sizingMethod='scale')",
        '-ms-filter' : "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+bg+"', sizingMethod='scale')",
        'background-size' : 'cover',

    }).show();

    $('#panorama-private-overlay_1').show();

    $('#viewer').addClass('hidden');

    $('#viewer_menu').addClass('hidden');

    THEASYS.theme.exec('loader','hide');

    $('#panorama-private').show();

};

THEASYS.theme.modules.panorama_private.hide = function( password ){

    $('#panorama-private').fadeOut(function(){

        $('body').removeClass('panorama-pp-bg');

        $('body').css('background','');

        $('#panorama-private-overlay_0').hide();

        $('#panorama-private-overlay_1').hide();

        $('#panorama-private-input').val('');

        $('#viewer').removeClass('hidden');

        $('#viewer_menu').removeClass('hidden');

        THEASYS.renderer.vars.set('tour_password',password);

        if( !THEASYS.renderer.vars.get('editing') ){

            THEASYS.renderer.process();

        }

    });

};

THEASYS.theme.modules.panorama_private.applyCustomizations = function(obj){

    var options = THEASYS.renderer.vars.get('options');

    if( obj ){

        options = obj;

    }

    var style = '';

    if( 'password_protect_bc' in options && 'password_protect_bo' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.password_protect_bc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.password_protect_bo+')';

            style += '#panorama-private-overlay_1{background:'+rgba+'!important;}';

        }

    }

    if( 'password_protect_b' in options && 'password_protect_g' in options ){

        //style += '#panorama-private-overlay_1{backdrop-filter: blur('+options.password_protect_b+'px) grayscale('+options.password_protect_g+');-webkit-backdrop-filter: blur('+options.password_protect_b+'px) grayscale('+options.password_protect_g+');-moz-backdrop-filter: blur('+options.password_protect_b+'px) grayscale('+options.password_protect_g+');}';

        style += '#panorama-private-overlay_0{filter: blur('+options.password_protect_b+'px) grayscale('+options.password_protect_g+');-webkit-filter: blur('+options.password_protect_b+'px) grayscale('+options.password_protect_g+');-moz-filter: blur('+options.password_protect_b+'px) grayscale('+options.password_protect_g+');}';

    }

    $('#panorama_private_styles').html(style);

};
