/*
 *  Name : Share
 *  Description : Ability for users to share tour or share specific panorama view
 *  Version : 0.0.4
*/

THEASYS.theme.autoLoadFunction('share','init');

THEASYS.theme.modules.share.initialized = false;

THEASYS.theme.modules.share.created = 0;

THEASYS.theme.modules.share.exists = 0;

THEASYS.theme.modules.share.eventsCreated = 0;

THEASYS.theme.modules.share.opened = 0;

THEASYS.theme.modules.share.init = function(){

    if( THEASYS.theme.vars.share.created ){

        return false;

    }

    //check to see if share exists

    var options = THEASYS.renderer.vars.get('options');
    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

    var share_menu = parseInt(options.share_menu,10);

    if( THEASYS.cache.obj.tours[tour_rnd].tour.domain_specific === 0 ){

        if( editing ){

            this.exists = 1;

        } else {

            if( share_menu ){

                this.exists = 1;

            }

        }

    }

    if( !this.exists ){

        //check to see if we have it in the context menu

        if( parseInt(options.share_context_menu,10) ){

            this.exists = 1;

        }

    }

    if( !this.exists ){

        return false;

    }

    THEASYS.theme.modules.share.createEvents(1);

    THEASYS.theme.modules.share.initialized = true;

};

THEASYS.theme.modules.share.listenToEdits = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'share_cao':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.share_cao',value);

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

            case'share_social_facebook':
            case'share_social_facebook':
            case'share_social_facebook':
            case'share_social_messenger':
            case'share_social_twitter':
            case'share_social_reddit':
            case'share_social_linkedin':
            case'share_social_telegram':
            case'share_social_whatsapp':
            case'share_social_skype':

                var value = ~~obj[k];

                THEASYS.renderer.vars.set('options.'+k,value);

                THEASYS.theme.modules.share.hide();

                THEASYS.theme.modules.share.load();

            break;

        }

    }

};

THEASYS.theme.modules.share.getHtmlContent = function( ){

    var title = document.title;
    var title_euc = encodeURIComponent(title);

    var image = document.head.querySelector("[name~=image][content]").content;
    var image_euc = encodeURIComponent(image);

    if( vars.exported ){

        image_euc = vars.path+image_euc;

    }

    var url = document.head.querySelector("[name~=url][content]").content;
    var url_euc = encodeURIComponent(url);

    if( vars.exported ){

        url_euc = vars.path+url_euc;

    }

    var description = document.head.querySelector("[name~=description][content]").content;
    var description_euc = encodeURIComponent(description);

    //add share html

    var has_share_social = false;

    var options = THEASYS.renderer.vars.get('options');

    var share_social_facebook = '';

    if( ('share_social_facebook' in options && ~~options.share_social_facebook) || !('share_social_facebook' in options) ){

        share_social_facebook = `
        <span>
            <a title="Facebook" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-href="https://www.facebook.com/dialog/share?app_id=231254307638115&display=popup&picture=${image_euc}&title=${title_euc}&description=${description_euc}&href=" href="#">
                <img src="${vars.paths.static}/themes/${vars.theme}/assets/modules/share/img/social/facebook.png" alt="facebook">
            </a>
        </span>
        `;

        has_share_social = true;

    }

    var share_social_messenger = '';

    if( ('share_social_messenger' in options && ~~options.share_social_messenger) || !('share_social_messenger' in options) ){

        share_social_messenger = `
        <span>
            <a title="Facebook Messenger" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-href="https://www.facebook.com/dialog/send?app_id=231254307638115&redirect_uri=${url_euc}&link=" href="#">
                <img src="${vars.paths.static}/themes/${vars.theme}/assets/modules/share/img/social/facebook-messenger.png" alt="facebook messenger">
            </a>
        </span>
        `;

        has_share_social = true;

    }

    var share_social_twitter = '';

    if( ('share_social_twitter' in options && ~~options.share_social_twitter) || !('share_social_twitter' in options) ){

        share_social_twitter = `
        <span>
            <a title="Twitter" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" data-href="https://twitter.com/intent/tweet?text=${title_euc}&url=" href="#">
                <img src="${vars.paths.static}/themes/${vars.theme}/assets/modules/share/img/social/twitter.svg" alt="twitter">
            </a>
        </span>
        `;

        has_share_social = true;

    }

    var share_social_reddit = '';

    if( ('share_social_reddit' in options && ~~options.share_social_reddit) || !('share_social_reddit' in options) ){

        share_social_reddit = `
        <span>
            <a title="Reddit" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-href="https://www.reddit.com/submit?title=${title_euc}&url=" href="#">
                <img src="${vars.paths.static}/themes/${vars.theme}/assets/modules/share/img/social/reddit.png" alt="reddit">
            </a>
        </span>
        `;

        has_share_social = true;

    }

    var share_social_linkedin = '';

    if( ('share_social_linkedin' in options && ~~options.share_social_linkedin) ){

        share_social_linkedin = `
        <span>
            <a title="Linkedin" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-href="https://www.linkedin.com/sharing/share-offsite/?url=" href="#">
                <img src="${vars.paths.static}/themes/${vars.theme}/assets/modules/share/img/social/linkedin.png" alt="linkedin">
            </a>
        </span>
        `;

        has_share_social = true;

    }

    var share_social_telegram = '';

    if( ('share_social_telegram' in options && ~~options.share_social_telegram) ){

        share_social_telegram = `
        <span>
            <a title="Telegram" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-href="https://t.me/share?url=" href="#">
                <img src="${vars.paths.static}/themes/${vars.theme}/assets/modules/share/img/social/telegram.png" alt="telegram">
            </a>
        </span>
        `;

        has_share_social = true;

    }

    var share_social_whatsapp = '';

    if( ('share_social_whatsapp' in options && ~~options.share_social_whatsapp) ){

        share_social_whatsapp = `
        <span>
            <a title="Whatsapp" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-href="https://wa.me/?text=" href="#">
                <img src="${vars.paths.static}/themes/${vars.theme}/assets/modules/share/img/social/whatsapp.png" alt="whatsapp">
            </a>
        </span>
        `;

        has_share_social = true;

    }

    var share_social_skype = '';

    if( ('share_social_skype' in options && ~~options.share_social_skype) ){

        share_social_skype = `
        <span>
            <a title="Skype" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" data-href="https://web.skype.com/share?text=${title_euc}&url=" href="#">
                <img src="${vars.paths.static}/themes/${vars.theme}/assets/modules/share/img/social/skype.svg" alt="skype">
            </a>
        </span>
        `;

        has_share_social = true;

    }

    var html = `
        <div id="panorama-share">
            <div id="panorama-share-content">
                <ul class="tab-menu">
                    <li data-rel="share_tour" class="active">Share Tour</li>
                    <li data-rel="share_this_view">Share This View</li>
                </ul>
                <div class="tab-panes">
                    <div data-rel="share_tour" class="tab-pane active">
                        <input type="text" id="panorama-share-input">
                        <div class="share-border"></div>
                        <div class="social-share">
                            ${share_social_facebook}
                            ${share_social_messenger}
                            ${share_social_twitter}
                            ${share_social_linkedin}
                            ${share_social_telegram}
                            ${share_social_whatsapp}
                            ${share_social_skype}
                            ${share_social_reddit}
                        </div>
                    </div>
                    <div data-rel="share_this_view" class="tab-pane">
                        <div id="share_this_view_loader" class="hidden loading"></div>
                        <div data-loaded="0" id="share_this_view_content">
                            <input type="text" id="panorama-share-this-view-input">
                            <div class="share-border"></div>
                            <div class="social-share">
                                ${share_social_facebook}
                                ${share_social_messenger}
                                ${share_social_twitter}
                                ${share_social_linkedin}
                                ${share_social_telegram}
                                ${share_social_whatsapp}
                                ${share_social_skype}
                                ${share_social_reddit}
                            </div>
                        </div>
                        <div id="share_this_view_error" class="hidden">
                            <p>Something went wrong. Please try again.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `;

    return html;

}

THEASYS.theme.modules.share.createEvents = function( visible ){

    if( this.eventsCreated ){

        return false;

    }

    var editing = THEASYS.renderer.vars.get('editing');

    var events_create = 0;

    if( editing ){

        events_create = 1;

    } else {

        if( visible ){

            events_create = 1;

        }

    }

    if( events_create ){

      $(document).on('click touchend','#panorama-share-content .tab-menu li',function(){

            var jthis = $(this);
            var rel = jthis.data('rel');

            $('#panorama-share-content').find('.tab-pane[data-rel="'+rel+'"]').show().siblings().hide();

            jthis.addClass('active').siblings().removeClass('active');

            if( rel === 'share_this_view' ){

                var loaded = parseInt($('#share_this_view_content').data('loaded'),10);

                if( !loaded ){

                    $('#share_this_view_content').addClass('hidden');
                    $('#share_this_view_error').addClass('hidden');
                    $('#share_this_view_loader').removeClass('hidden');

                    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');
                    var tour_embed_rnd = THEASYS.renderer.vars.get('tour_embed_rnd');
                    var id = THEASYS.renderer.vars.get('id');
                    var rnd = THEASYS.renderer.vars.get('rnd');
                    var current_position = THEASYS.renderer.vars.get('current_position');

                    if( vars.exported ){

                        var msg = THEASYS.check.newTourEmbedViewShare(
                                tour_rnd,
                                tour_embed_rnd,
                                id,
                                rnd,
                                current_position.x,
                                current_position.y,
                                current_position.z,
                                current_position.fov,
                                current_position.lat,
                                current_position.lon
                            );

                        if( 'status' in msg ){

                            if( msg.status ){

                                var url = vars.path+vars.file+'?s='+msg.data.f+','+msg.data.lt+','+msg.data.ln+','+msg.data.p+','+msg.data.r;

                                $('#panorama-share-this-view-input').val(url);

                                THEASYS.theme.modules.share.addUrlToShareLinks(url,'share_this_view');

                                $('#share_this_view_content').removeClass('hidden');
                                $('#share_this_view_error').addClass('hidden');
                                $('#share_this_view_loader').addClass('hidden');
                                $('#share_this_view_content').data('loaded',1);

                            } else {

                                $('#share_this_view_loader').addClass('hidden');
                                $('#share_this_view_error').removeClass('hidden');

                            }

                        } else {

                            $('#share_this_view_loader').addClass('hidden');
                            $('#share_this_view_error').removeClass('hidden');

                        }

                    } else {

                        THEASYS.fn.ajax.call({
                            url : THEASYS.fn.u('api','viewer'),
                            data:{
                                action : 'newTourEmbedViewShare',
                                params : {
                                    t : tour_rnd,
                                    h : tour_embed_rnd,
                                    e : id,
                                    a : rnd,
                                    s : current_position.x,
                                    y : current_position.y,
                                    s_ : current_position.z,
                                    _ : current_position.fov,
                                    __ : current_position.lat,
                                    ___ : current_position.lon,
                                },
                            },
                            sessionCheck : false,
                        }).then(function(msg){

                            if( 'status' in msg ){

                                if( msg.status ){

                                    var url = THEASYS.vars.short_url+'/'+msg.rnd;

                                    $('#panorama-share-this-view-input').val(url);

                                    THEASYS.theme.modules.share.addUrlToShareLinks(url,'share_this_view');

                                    $('#share_this_view_content').removeClass('hidden');
                                    $('#share_this_view_error').addClass('hidden');
                                    $('#share_this_view_loader').addClass('hidden');
                                    $('#share_this_view_content').data('loaded',1);

                                } else {

                                    $('#share_this_view_loader').addClass('hidden');
                                    $('#share_this_view_error').removeClass('hidden');

                                }

                            } else {

                                $('#share_this_view_loader').addClass('hidden');
                                $('#share_this_view_error').removeClass('hidden');

                            }

                        },function(){

                            $('#share_this_view_loader').addClass('hidden');
                            $('#share_this_view_error').removeClass('hidden');

                        });

                    }

                }

            }

        });

        $(document).on('click','#panorama-share-input',function(){

            $(this).select();

        });

        $(document).on('click','#panorama-share-this-view-input',function(){

            $(this).select();

        });

    }

    this.eventsCreated = 1;

};

THEASYS.theme.modules.share.hide = function(){

    if( typeof $.fancybox !== 'undefined') {

        $.fancybox.close();

    }

    this.opened = 0;

};

THEASYS.theme.modules.share.load = function(){

    if( !this.exists ){

        return false;

    }

    if( this.opened ){

        return false;

    }

    THEASYS.theme.exec('menu','autoHide');

    THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',true);

    setTimeout(function () {

        THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',true);

    },100);

    var html_content = this.getHtmlContent();

    var html = `
        <a class="display_share" data-fancybox="share_content" data-src="#share_content" href="javascript:;"></a>
        <div id="share_content">${html_content}</div>
    `;

    $('#actions_html_container').html(html);


    var url = THEASYS.vars.short_url+'/'+THEASYS.vars.short_url_embed_rnd;

    if( vars.exported ){

        url = vars.path+vars.file;

    }

    $('#panorama-share-input').val(url);

    this.addUrlToShareLinks(url,'share_tour');

    THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',true);

    $(".display_share").fancybox({
        infobar: false,
        smallBtn: true,
        hash: false,
        onActivate: function(instance) {

            var options = THEASYS.renderer.vars.get('options');

            var action = {

                t : 'dip',
                cao : options.share_cao,
                status : 1,
                type : 'display_info_panel',

            };

            THEASYS.fn.apply_cao(action,instance.id);

        },
        afterClose: function(instance) {

            THEASYS.fn.clear_cao(instance.id);

            $('#share_this_view_content').data('loaded',0);

            THEASYS.theme.modules.share.resetGui();

            THEASYS.theme.modules.share.opened = 0;

            THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',false);

        },

    });

    $('#actions_html_container').find('a.display_share').simulateClick('click');

    this.opened = 1;

};

THEASYS.theme.modules.share.addUrlToShareLinks = function(url,rel){

    var encoded_url = encodeURIComponent(url);

    if( rel ){

        var pane = $('#panorama-share').find('.tab-pane[data-rel="'+rel+'"]');

        if( pane && pane.length ){

            pane.find('a').each(function(){

                var jthis = $(this);

                var href = jthis.data('href');

                jthis.attr('href',href+encoded_url);

            });

        }

    }

};

THEASYS.theme.modules.share.resetGui = function(){

    $('#panorama-share-content .tab-menu li[data-rel="share_tour"]').addClass('active').siblings().removeClass('active');

    $('#panorama-share-content .tab-panes .tab-pane[data-rel="share_tour"]').addClass('active').siblings().removeClass('active');

};