/*
 *  Name : cookiesconsent
 *  Description : Displays a cookiesconsent panel on the bottom of the screen
 *  Version : 0.0.3
*/

THEASYS.theme.autoLoadFunction('cookiesconsent','init');

THEASYS.theme.modules.cookiesconsent.initialized = false;

THEASYS.theme.modules.cookiesconsent.init = function( ){

    var options = THEASYS.renderer.vars.get('options');

    if( 'disable_cookiesconsent' in options ){

        this.initialized = true;

        return false;

    }

    if( !('cookiesconsent' in options) ){

        this.initialized = true;

        return false;

    }

    if( !~~options.cookiesconsent ){

        this.initialized = true;

        return false;

    }

    if( !THEASYS.theme.modules.cookiesconsent.setCookie('test_cookie',1,365) ){

        this.initialized = true;

        return false;

    }

    THEASYS.theme.modules.cookiesconsent.setCookie('test_cookie',null,0);

    /*var storage; var fail;var uid;
    try {uid = new Date;(storage = window.localStorage).setItem(uid, uid);fail = storage.getItem(uid) != uid;storage.removeItem(uid);fail && (storage = false); } catch (exception) {}

    if( !storage ){

        this.initialized = true;

        return false;

    }*/

    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

    var cookie_key = 'theasys_viewer_cookiesconsest_'+tour_rnd;

    var days = 'cookiesconsent_days' in options ? parseInt(options.cookiesconsent_days,10) : 365;

    var learn_more_url = 'cookiesconsent_url' in options ? options.cookiesconsent_url : '';

    var secs =  days  * 86400 * 1000;

    var html = `<div id="viewer_cookiesconsent">
        <div class="viewer_cookiesconsent_inner">

        <div>We use cookies so that this Virtual Tour works for you. By using this Tour, you agree to our use of cookies. <a id="viewer_cookiesconsent_url" target="_blank" href="${learn_more_url}">Learn more</a></div>
        <div><button>Agree</button></div>

        </div>
    </div>`;

    THEASYS.theme.appendHtml(html);

    var bgcolor = 'cookiesconsent_bgcolor' in options ? options.cookiesconsent_bgcolor : '#d679b5';
    var color = 'cookiesconsent_color' in options ? options.cookiesconsent_color : '#fff';

    $('#viewer_cookiesconsent').css({

        'background-color' : bgcolor,
        'color' : color,

    });

    var button_bgcolor = 'cookiesconsent_button_bgcolor' in options ? options.cookiesconsent_button_bgcolor : '#fff';
    var button_color = 'cookiesconsent_button_color' in options ? options.cookiesconsent_button_color : '#263772';

    $('#viewer_cookiesconsent button').css({

        'background-color' : button_bgcolor,
        'color' : button_color,

    });

    var editing = ~~THEASYS.renderer.vars.get('editing');

    if( editing ){

        if( !vars.exported ){

            this.display();

        }

    } else {

        var cookie = THEASYS.theme.modules.cookiesconsent.getCookie(cookie_key,'1',days);

        if( ~~cookie ){


        } else {

            this.display();

        }

        /*var date = storage.getItem(cookie_key);

        if( date ){

            var diff = new Date() - new Date(date);

            if( diff > secs ){

                this.display();

            }

        } else {

            this.display();

        }*/

    }

    $('#viewer_cookiesconsent button').on('click',function(){

        //storage.setItem(cookie_key, new Date());

        THEASYS.theme.modules.cookiesconsent.setCookie(cookie_key,'1',days);

        THEASYS.theme.modules.cookiesconsent.hide();

    });

    $('body').on('click','#viewer_cookiesconsent_overlay',function(e){

        THEASYS.theme.modules.cookiesconsent.hidePanel();

    });

    $('body').on('click','#viewer_cookiesconsent_close',function(e){

        THEASYS.theme.modules.cookiesconsent.hidePanel();

    });

    var cached_cookiesconsent_content = '';

    $('#viewer_cookiesconsent_url').on('click',function(e){

        if( learn_more_url === '' ){

            e.preventDefault();

            if( vars.exported ){

                if( vars.cookiesconsent !== '' ){

                    THEASYS.theme.modules.cookiesconsent.displayPanel(vars.cookiesconsent);

                } else {

                    THEASYS.theme.modules.cookiesconsent.displayPanel('Not available!');

                }

            } else {

                if( cached_cookiesconsent_content === '' ){

                    THEASYS.theme.exec('loader','show');

                    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

                    THEASYS.fn.ajax.call({
                        url : THEASYS.fn.u('api','viewer'),
                        data : {
                            action : 'cookiesconsent',
                            params : {
                                q : tour_rnd,
                            },
                        },
                        sessionCheck : false,

                    }).then(function(msg){

                        cached_cookiesconsent_content = msg;

                        THEASYS.theme.modules.cookiesconsent.displayPanel(cached_cookiesconsent_content);

                        THEASYS.theme.exec('loader','hide');

                    },function(error) {

                        cached_cookiesconsent_content = '';

                        THEASYS.theme.modules.cookiesconsent.displayPanel('Something went wrong. Please try again later.');

                        THEASYS.theme.exec('loader','hide');

                    });

                } else {

                    THEASYS.theme.modules.cookiesconsent.displayPanel(cached_cookiesconsent_content);

                }

            }

            return false;

        }

    });

    this.initialized = true;

};

THEASYS.theme.modules.cookiesconsent.setCookie = function( cname, cvalue, exdays ){

    try {

        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";

        return true;

    } catch(error) {

    }

    return false;

};

THEASYS.theme.modules.cookiesconsent.getCookie = function( cname ){

    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
    }
    return "";

};

THEASYS.theme.modules.cookiesconsent.listenToEdits = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'cookiesconsent_cao':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.cookiesconsent_cao',value);

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

            case'cookiesconsent_bgcolor':

                var value = obj[k];

                $('#viewer_cookiesconsent').css({'background':value});

            break;

            case'cookiesconsent_color':

                var value = obj[k];

                $('#viewer_cookiesconsent').css({'color':value});

                $('#viewer_cookiesconsent a').css({'color':value});

            break;

            case'cookiesconsent_button_bgcolor':

                var value = obj[k];

                $('#viewer_cookiesconsent button').css({'background':value});

            break;

            case'cookiesconsent_button_color':

                var value = obj[k];

                $('#viewer_cookiesconsent button').css({'color':value});

            break;

        }

    }

};

THEASYS.theme.modules.cookiesconsent.display = function( ){

    $('#viewer_cookiesconsent').css("display", "flex").hide().fadeIn();

};

THEASYS.theme.modules.cookiesconsent.displayPanel = function( html_content ){

    THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',true);

    var html = `
        <a class="display_cookiesconsent" data-fancybox="cookiesconsent_content" data-src="#cookiesconsent_content" href="javascript:;"></a>
        <div id="cookiesconsent_content" class="redactor-styles fancybox-info-panel">${html_content}</div>
    `;

    $('#actions_html_container').html(html);

    $(".display_cookiesconsent").fancybox({
        infobar: false,
        smallBtn: true,
        hash: false,
        //closeExisting: true,
        onActivate: function(instance) {

            var options = THEASYS.renderer.vars.get('options');

            var action = {

                t : 'dip',
                cao : options.cookiesconsent_cao,
                status : 1,
                type : 'display_info_panel',

            };

            THEASYS.fn.apply_cao(action,instance.id);

        },
        afterClose: function(instance) {

            THEASYS.fn.clear_cao(instance.id);

            THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',false);

            $('#viewer_cookiesconsent').css({'z-index':99999});

        },

    });

    $('#viewer_cookiesconsent').css({'z-index':99990});

    $('#actions_html_container').find('a.display_cookiesconsent').simulateClick('click');

};

THEASYS.theme.modules.cookiesconsent.hide = function( ){

    $('#viewer_cookiesconsent').fadeOut();

};

THEASYS.theme.modules.cookiesconsent.hidePanel = function( ){

    $('#viewer_cookiesconsent_overlay').fadeOut(function(){

        $(this).remove();

    });

    $('#viewer_cookiesconsent_panel_wrapper').fadeOut(function(){

        $(this).remove();

    });

};