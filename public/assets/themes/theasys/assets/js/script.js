var viewer_title = document.head.querySelector("[name~=viewer_title][content]").content;

THEASYS.theme.html = `
    <div id="viewer_wrapper" class="noselect">
        <div id="viewer" tabindex="0"></div>
    </div>
    <div id="viewer_submenu" class="hidden"></div>
    <div id="tooltip"></div>
    <input type="hidden" id="editing" value="">
    <input type="hidden" id="viewer_title" value="${viewer_title}">
    <div id="actions_html_container" class="hidden"></div>
`;

//event::processPanoramaAfterEarly
THEASYS.renderer.event.on('processPanoramaAfterEarly',function(){

    var loadedOnce = THEASYS.renderer.vars.get('loadedOnce');

    if( loadedOnce <= 0 ){

        THEASYS.theme.modules.cookiesconsent.init();

        THEASYS.theme.modules.navigation.init();

        THEASYS.theme.modules.navigation_mouse.init();

        THEASYS.theme.applyCustomizations();

    }

});

THEASYS.renderer.event.on('loadedOnce',function(){

    THEASYS.theme.modules.popup.init();

    THEASYS.theme.modules.automations.init();

    THEASYS.theme.modules.shadow.init();

    THEASYS.theme.modules.maps.init();

    THEASYS.theme.modules.menu.init(function(){

        //load the audio after we have added to the submenu the Sounds item so user can toggle sounds
        THEASYS.theme.modules.audio.init();

    });

    THEASYS.theme.modules.titles.init();

    THEASYS.theme.modules.thumbnails.init();

    THEASYS.theme.modules.contextMenu.init();

    THEASYS.theme.modules.logo.init();

    THEASYS.theme.modules.copyright.init();

    THEASYS.theme.modules.share.init();

    //THEASYS.theme.autoLoadFunctions();

    if( THEASYS.fn.isInIframe() ){

        THEASYS.renderer.event.on('userGlobalAction',function(){

            var globalUserActionTriggeredOnce = ~~THEASYS.renderer.vars.get('globalUserActionTriggeredOnce');

            if( !globalUserActionTriggeredOnce ){

                THEASYS.renderer.processPanoramaImages();

                THEASYS.renderer.vars.set('globalUserActionTriggeredOnce',1);

            }

        });

    } else {

        THEASYS.renderer.processPanoramaImages();

    }

});

THEASYS.renderer.event.on('loadedPanorama',function(){

    //console.log('loaded panorama');

});

THEASYS.renderer.event.on('loadingPanorama',function(){

    //console.log('loading panorama');

});

THEASYS.renderer.event.on('beforeLoad',function(){

    //console.log('beforeLoad');

    THEASYS.theme.modules.loader.init();

    THEASYS.theme.modules.panorama_error.init();
    THEASYS.theme.modules.panorama_private.init();
    THEASYS.theme.modules.panorama_static.init();

    THEASYS.theme.modules.hotspots_tooltip.init();
    THEASYS.theme.modules.panorama_vr.init();

});

THEASYS.renderer.event.on('load',function(){

    //console.log('load');

});

THEASYS.renderer.event.on('resize',function(w,h){

    var w = $(window).width();

    var h = $(window).height();

    THEASYS.renderer.vars.set('rendererWidth',w);

    THEASYS.renderer.vars.set('rendererHeight',h);

    if( THEASYS.theme.modules.maps.initialized ){

        if( THEASYS.theme.modules.maps.map_gui_mode ){

            w  = parseFloat(w,10) - $('#map-wrapper').outerWidth();

        }

    }

    THEASYS.renderer.vars.set('rendererWidth',w);

    $('#viewer').css({'width':w+'px','height':h+'px'});

    $('#viewer_wrapper').css({'width':w+'px','height':h+'px','float':'left'});

    var container = THEASYS.renderer.vars.get('container');

    $('#'+container).css({'width':w+'px','height':h+'px'});

});

THEASYS.renderer.event.on('userAction',function(){

    var createHideMenuEventsOnClose = 0;

    if( THEASYS.renderer.vars.get('editing') ){

        createHideMenuEventsOnClose = 1;

    } else {

        if( ~~THEASYS.renderer.vars.get('options.menu_close_on_actions') ){

            createHideMenuEventsOnClose = 1;

        }

    }

    if( createHideMenuEventsOnClose ){

        $('#viewer').on('click',function(){

            THEASYS.theme.exec('menu','autoHide');

        });

    }

});

THEASYS.theme.popup_instance = 0;

THEASYS.theme.popup_instance_styles = '';

THEASYS.renderer.event.on('hotspotClick',function(action){

    if( 'type' in action ){

        switch(action.type){

            case'call':

                var url = 'tel:'+action.tel;

                var html = '<a style="position:absolute;top:0px;left:0px;" id="call_a_number" href="'+url+'" target="_blank" rel="noopener"></a>';

                $('body').append(html);

                $('#call_a_number').simulateClick('click');

                $('#call_a_number').remove();

            break;

            case'link_to_url':

                var url = THEASYS.fn.parse_url(action.url);

                var open_in_new_tab = 'open_in_new_tab' in action ? parseInt(action.open_in_new_tab,10) : 1;

                if( open_in_new_tab ){

                    var html = '<a style="position:absolute;top:0px;left:0px;" id="link_to_url" href="'+url+'" target="_blank" rel="noopener"></a>';

                } else {

                    var html = '<a style="position:absolute;top:0px;left:0px;" id="link_to_url" href="'+url+'" rel="noopener"></a>';

                }

                $('body').append(html);

                 $('#link_to_url').simulateClick('click');

                 $('#link_to_url').remove();

            break;

            case 'email':

                var url = 'mailto:'+action.email+'?subject='+action.subject;

                var html = '<a style="position:absolute;top:0px;left:0px;" id="action_mailto" href="'+url+'" target="_blank" rel="noopener"></a>';

                $('body').append(html);

                $('#action_mailto').simulateClick('click');

                $('#action_mailto').remove();

            break;

            case'display_video':

                THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',true);

                //stop playing background audio

                THEASYS.theme.exec('audio','forcePause');

                var html = '';

                if( 'aspect_ratio' in action && ~~action.aspect_ratio ){

                    var ratio = ~~action.aspect_ratio;

                    if( ratio === 3 ){

                        html = `
                            <a class="display_video" data-caption="${action.title||''}" data-width="${action.aspect_ratio_w}" data-height="${action.aspect_ratio_h}" data-fancybox href="${THEASYS.fn.video_embed_url(action.url,~~action.auto_play)}"></a>
                        `;

                    } else if( ratio === 2 ){

                        html = `
                            <a class="display_video" data-ratio="1" data-caption="${action.title||''}" data-fancybox href="${THEASYS.fn.video_embed_url(action.url,~~action.auto_play)}"></a>
                        `;

                    } else if( ratio === 1 ){

                        html = `
                            <a class="display_video" data-ratio="2" data-caption="${action.title||''}" data-fancybox href="${THEASYS.fn.video_embed_url(action.url,~~action.auto_play)}"></a>
                        `;

                    }

                } else {

                    html = `
                        <a class="display_video" data-caption="${action.title||''}" data-fancybox href="${THEASYS.fn.video_embed_url(action.url,~~action.auto_play)}"></a>
                    `;

                }

                $('#actions_html_container').html(html);

                $(".display_video").fancybox({
                    iframe: {
                        tpl: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen" src=""></iframe>',
                        preload:false,
                    },

                    infobar: false,
                    smallBtn: true,
                    hash: false,
                    onActivate: function(instance) {

                        THEASYS.fn.apply_cao(action,instance.id);

                    },
                    afterClose: function(instance) {

                        THEASYS.fn.clear_cao(instance.id);

                        THEASYS.theme.exec('audio','resumeBackgroundSound');

                        THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',false);

                    }
                });

                $('#actions_html_container').find('a.display_video').simulateClick('click');

            break;

            case'display_image':

                THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',true);

                var img = vars.paths.media+'/'+THEASYS.renderer.vars.get('uid')+'/'+THEASYS.renderer.vars.get('tour_rnd')+'/action_image/'+action.image;

                var html = `<a href="${img}" class="display_image" data-fancybox data-caption="${action.title||''}"><img src="${img}" alt="${action.title}" /></a>`;

                $('#actions_html_container').html(html);

                $(".display_image").fancybox({
                    infobar: false,
                    smallBtn: true,
                    hash: false,
                    onActivate: function(instance) {

                        THEASYS.fn.apply_cao(action,instance.id);

                    },
                    afterClose: function(instance) {

                        THEASYS.fn.clear_cao(instance.id);

                        THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',false);

                    }
                });

                $('#actions_html_container').find('a.display_image').simulateClick('click');

            break;

            case 'display_info_panel':

                THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',true);

                var html = `
                    <a class="display_info_panel" data-fancybox="action_html_content" data-src="#action_html_content" href="javascript:;"></a>
                    <div id="action_html_content" class="redactor-styles popup-info-panel popup-info-panel-display_info_panel fancybox-info-panel">${action.html_content}</div>
                `;

                $('#actions_html_container').html(html);

                $(".display_info_panel").fancybox({
                    infobar: false,
                    smallBtn: true,
                    hash: false,
                    onActivate: function(instance) {

                        THEASYS.fn.apply_cao(action,instance.id);

                    },
                    afterClose: function(instance) {

                        THEASYS.fn.clear_cao(instance.id);

                        THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',false);

                    }
                });

                $('#actions_html_container').find('a.display_info_panel').simulateClick('click');

            break;

            case 'display_image_gallery':

                THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',true);

                var html = '';

                var uid = THEASYS.renderer.vars.get('uid');

                var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

                for( var i = 0, n = action.images.length; i < n; i++ ){

                    var img = vars.paths.media+'/'+uid+'/'+tour_rnd+'/action_image/'+action.images[i].image;

                    html += `<a href="${img}" class="image-gallery" data-fancybox="image-gallery" data-caption="${action.images[i].title||''}"><img src="${img}" alt="${action.images[i].title}" /></a>`;

                }

                $('#actions_html_container').html(html);

                $(".image-gallery").fancybox({
                    infobar: false,
                    smallBtn: true,
                    hash: false,
                    loop: true,
                    onActivate: function(instance) {

                        THEASYS.fn.apply_cao(action,instance.id);

                    },
                    afterClose: function(instance) {

                        THEASYS.fn.clear_cao(instance.id);

                        THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',false);

                    }
                });

                $('#actions_html_container').find('a.image-gallery').eq(0).simulateClick('click');

            break;

            case 'iframe':

                THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',true);

                var html = '';

                var parser = new DOMParser();

                var parsedIframe = parser.parseFromString(action.iframe, "text/html");

                var iFrame = parsedIframe.getElementsByTagName("iframe");

                if( !iFrame.length ){

                    //theasys.func.dialog.open('dialog-error','Iframe src not found!');

                    return false;

                }

                var src = iFrame[0].src;

                if( src ){

                    html = `<a class="display_iframe" data-fancybox data-type="iframe" data-src="${src}" data-caption="${action.title||''}" href="javascript:;"></a>`;

                }

                $('#actions_html_container').html(html);

                $(".display_iframe").fancybox({
                    iframe: {
                        tpl: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen" src=""></iframe>',
                        preload:false,
                    },
                    infobar: false,
                    smallBtn: true,
                    hash: false,
                    onActivate: function(instance) {

                        THEASYS.fn.apply_cao(action,instance.id);

                    },
                    afterClose: function(instance) {

                        THEASYS.fn.clear_cao(instance.id);

                        THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',false);

                    }
                });

                $('#actions_html_container').find('a.display_iframe').simulateClick('click');

            break;

            case'pdf':

                THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',true);

                var src = vars.paths.media+'/'+THEASYS.renderer.vars.get('uid')+'/'+THEASYS.renderer.vars.get('tour_rnd')+'/action_pdf/'+action.pdf;

                var device = THEASYS.renderer.vars.get('device');

                if( device.isMobile ){

                    var html = '<a style="position:absolute;top:0px;left:0px;" id="link_to_pdf" href="'+src+'" target="_blank" rel="noopener"></a>';

                    $('body').append(html);

                     $('#link_to_pdf').simulateClick('click');

                     $('#link_to_pdf').remove();

                } else {

                    var html = '';

                    if( src ){

                        html = `<a class="display_pdf" data-fancybox data-type="iframe" data-src="${src}" data-caption="${action.title||''}" href="javascript:;"></a>`;

                    }

                    $('#actions_html_container').html(html);

                    $(".display_pdf").fancybox({
                        iframe: {
                            tpl: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen" src=""></iframe>',
                            preload:false,
                        },
                        infobar: false,
                        smallBtn: true,
                        hash: false,
                        onActivate: function(instance) {

                            THEASYS.fn.apply_cao(action,instance.id);

                        },
                        afterClose: function(instance) {

                            THEASYS.fn.clear_cao(instance.id);

                            THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',false);

                        }
                    });

                    $('#actions_html_container').find('a.display_pdf').simulateClick('click');

                }

            break;

            case 'presentation':

                THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',true);

                THEASYS.theme.exec('audio','forcePause');

                var type = action.t;

                var html = '';

                var user_random_uid = THEASYS.renderer.vars.get('user_random_uid');
                var uid = THEASYS.renderer.vars.get('uid');
                var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');
                var user_tour_random_id = THEASYS.renderer.vars.get('user_tour_random_id');

                if( type === 'p3' ){

                    for( var i = 0, n = action.slides.length; i < n; i++ ){

                        if( action.slides[i].t === 'image' ){

                            html += '<a href="'+vars.paths.media+'/'+user_random_uid+'/'+tour_rnd+'/action_image/'+action.slides[i].v+'" data-caption="'+(action.slides[i].ti||'')+'" data-fancybox="presentation-bars"></a>';

                        } else if( action.slides[i].t === 'pdf' ){

                            html += '<a data-type="iframe" href="'+vars.paths.media+'/'+user_random_uid+'/'+tour_rnd+'/action_pdf/'+action.slides[i].v+'" data-caption="'+(action.slides[i].ti||'')+'" data-fancybox="presentation-bars"></a>';

                        } else if( action.slides[i].t === 'video' ){

                            html += '<a href="'+action.slides[i].v+'" data-caption="'+(action.slides[i].ti||'')+'" data-fancybox="presentation-bars"></a>';

                        } else if( action.slides[i].t === 'iframe' ){

                            var parser = new DOMParser();

                            var parsedIframe = parser.parseFromString(action.slides[i].v, "text/html");

                            var iFrame = parsedIframe.getElementsByTagName("iframe");

                            if( !iFrame.length ){

                                continue;

                            }

                            var src = iFrame[0].src;

                            if( src ){

                                html += '<a data-type="iframe" href="'+src+'" data-caption="'+(action.slides[i].ti||'')+'" data-fancybox="presentation-bars"></a>';

                            }

                        }

                    }

                } else if( type === 'p2' ) {

                    for( var i = 0, n = action.slides.length; i < n; i++ ){

                        if( action.slides[i].t === 'image' ){

                            html += '<a class="presentation-product" href="'+vars.paths.media+'/'+user_random_uid+'/'+tour_rnd+'/action_image/'+action.slides[i].v+'" data-caption="'+(action.slides[i].ti||'')+'" data-fancybox="presentation-product" data-panel="presentation-product-panel"></a>';

                        } else if( action.slides[i].t === 'pdf' ){

                            html += '<a class="presentation-product" data-type="iframe" href="'+vars.paths.media+'/'+user_random_uid+'/'+tour_rnd+'/action_pdf/'+action.slides[i].v+'" data-caption="'+(action.slides[i].ti||'')+'" data-fancybox="presentation-product" data-panel="presentation-product-panel"></a>';

                        } else if( action.slides[i].t === 'video' ){

                            html += '<a class="presentation-product" href="'+action.slides[i].v+'" data-caption="'+(action.slides[i].ti||'')+'" data-fancybox="presentation-product" data-panel="presentation-product-panel"></a>';

                        } else if( action.slides[i].t === 'iframe' ){

                            var parser = new DOMParser();

                            var parsedIframe = parser.parseFromString(action.slides[i].v, "text/html");

                            var iFrame = parsedIframe.getElementsByTagName("iframe");

                            if( !iFrame.length ){

                                continue;

                            }

                            var src = iFrame[0].src;

                            if( src ){

                                html += '<a class="presentation-product" data-type="iframe" href="'+src+'" data-caption="'+(action.slides[i].ti||'')+'" data-fancybox="presentation-product" data-panel="presentation-product-panel"></a>';

                            }

                        }

                    }

                    var lead_button_html = '';

                    if( ('albt' in action) && action.albt && ('albu' in action) && action.albu ){

                        lead_button_html += '<div class="presentation-product-panel-lead-button"><a target="_blank" rel="noopener" href="'+action.albu+'">'+action.albt+'</a></div>';

                    }

                    html += '<div id="presentation-product-panel"><div class="redactor-styles">'+action.html+'</div>'+lead_button_html+'</div>';

                } else {

                    for( var i = 0, n = action.slides.length; i < n; i++ ){

                        if( action.slides[i].t === 'image' ){

                            html += '<a class="quick_view" href="'+vars.paths.media+'/'+user_random_uid+'/'+tour_rnd+'/action_image/'+action.slides[i].v+'" data-caption="'+(action.slides[i].ti||'')+'" data-fancybox="presentation"></a>';

                        } else if( action.slides[i].t === 'pdf' ){

                            html += '<a class="quick_view" data-type="iframe" href="'+vars.paths.media+'/'+user_random_uid+'/'+tour_rnd+'/action_pdf/'+action.slides[i].v+'" data-caption="'+(action.slides[i].ti||'')+'" data-fancybox="presentation"></a>';

                        } else if( action.slides[i].t === 'video' ){

                            html += '<a class="quick_view" href="'+action.slides[i].v+'" data-caption="'+(action.slides[i].ti||'')+'" data-fancybox="presentation"></a>';

                        } else if( action.slides[i].t === 'iframe' ){

                           var parser = new DOMParser();

                            var parsedIframe = parser.parseFromString(action.slides[i].v, "text/html");

                            var iFrame = parsedIframe.getElementsByTagName("iframe");

                            if( !iFrame.length ){

                                continue;

                            }

                            var src = iFrame[0].src;

                            if( src ){

                                html += '<a class="quick_view" data-type="iframe" href="'+src+'" data-caption="'+(action.slides[i].ti||'')+'" data-fancybox="presentation"></a>';

                            }

                        }

                    }

                }

                $('#actions_html_container').html(html);

                if( type === 'p3' ){

                    $('[data-fancybox="presentation-bars"]').fancybox({
                        iframe: {
                            tpl: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen" src=""></iframe>',
                            preload:false,
                        },
                        baseClass: "presentation-bars",
                        infobar: false,
                        touch: {
                            vertical: false
                        },
                        //buttons: ["close", "thumbs", "share"],
                        buttons: ["close"],
                        animationEffect: "fade",
                        transitionEffect: "fade",
                        preventCaptionOverlap: false,
                        idleTime: false,
                        gutter: 0,
                        caption: function(instance) {
                            return action.html;
                        },
                        hash: false,
                        onActivate: function(instance) {

                            THEASYS.fn.apply_cao(action,instance.id);

                        },
                        afterClose: function(instance) {

                            THEASYS.fn.clear_cao(instance.id);

                            THEASYS.theme.exec('audio','resumeBackgroundSound');

                            THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',false);

                        }
                    });

                } else if( type === 'p2' ) {

                    var baseTpl = `

                        <div class="fancybox-container" role="dialog">
                            <div class="presentation-product-content">
                                <div class="presentation-product-carousel">
                                    <div class="fancybox-stage"></div>
                                </div>
                                <div class="presentation-product-aside"></div>
                                <button data-fancybox-close class="presentation-product-close">X</button>
                            </div>
                        </div>

                    `;

                    $(".presentation-product").fancybox({
                        iframe: {
                            tpl: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen" src=""></iframe>',
                            preload:false,
                        },
                        baseClass: "presentation-product-container",
                        infobar: false,
                        buttons: false,
                        thumbs: false,
                        margin: 0,
                        touch: {
                            vertical: false
                        },
                        animationEffect: false,
                        transitionEffect: "slide",
                        transitionDuration: 500,
                        baseTpl:baseTpl,
                        loop: true,

                        onInit: function(instance) {

                            if( instance.group.length > 1 ){

                                var bullets = '<ul class="presentation-product-bullets">';

                                for (var i = 0; i < instance.group.length; i++) {
                                    bullets += '<li><a data-index="' + i + '" href="javascript:;"><span>' + (i + 1) + "</span></a></li>";
                                }

                                bullets += "</ul>";

                                $(bullets)
                                .on("click touchstart", "a", function() {
                                    var index = $(this).data("index");
                                    $.fancybox.getInstance(function() {
                                        this.jumpTo(index);
                                    });
                                })
                                .appendTo(instance.$refs.container.find(".presentation-product-carousel"));

                                instance.$refs.container.find(".presentation-product-carousel").addClass('presentation-product-carousel-bullets-bottom-fix');

                            }

                            var $element = instance.group[instance.currIndex].opts.$orig;

                            var form_id = $element.data("panel");

                            instance.$refs.container.find(".presentation-product-aside").append(
                                $("#" + form_id)
                                .clone(true)
                                .removeClass("hidden")
                            );
                        },
                        beforeShow: function(instance) {

                            instance.$refs.container
                            .find(".presentation-product-bullets")
                            .children()
                            .removeClass("active")
                            .eq(instance.currIndex)
                            .addClass("active");

                        },
                        hash: false,
                        onActivate: function(instance) {

                            THEASYS.fn.apply_cao(action,instance.id);

                        },
                        afterClose: function(instance) {

                            THEASYS.fn.clear_cao(instance.id);

                            THEASYS.theme.exec('audio','resumeBackgroundSound');

                            THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',false);

                        }
                    });

                } else if( type === 'p1' ){

                    $(".quick_view").fancybox({
                        iframe: {
                            tpl: '<iframe id="fancybox-frame{rnd}" name="fancybox-frame{rnd}" class="fancybox-iframe" allowfullscreen allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen" src=""></iframe>',
                            preload:false,
                        },
                        infobar: false,
                        smallBtn: true,
                        hash: false,
                        loop: true,
                        onActivate: function(instance) {

                            THEASYS.fn.apply_cao(action,instance.id);

                        },
                        afterClose: function(instance) {

                            THEASYS.fn.clear_cao(instance.id);

                            THEASYS.theme.exec('audio','resumeBackgroundSound');

                            THEASYS.renderer.vars.set('autoRotationTemporarilyDisabled',false);

                        }
                    });

                }

                $('#actions_html_container').find('a').eq(0).simulateClick('click');

            break;

        }

    }

});

THEASYS.fn.apply_cao = function( action, instance_id ){

    //var device = THEASYS.renderer.vars.get('device');

    var type = 'p1';

    var options = null;

    if( action ){

        type = action.t;

        options = action.cao;

    }

    if( !THEASYS.theme.popup_instance ){

        THEASYS.theme.popup_instance = instance_id || 0;

    } else {

        var instances = $('.fancybox-container').length;

        if( instances > 1 ){

            $('#fancybox-container-'+THEASYS.theme.popup_instance).addClass('hidden');

        }

    }

    if( !options ){

        return false;

    }

    var style = '';

    if( type === 'i' || type === 'if' || type === 'dv' || type === 'pdf' || type === 'dig' || type === 'dip' || type === 'p1' || type === 'p2' ){

        //background

        if( 'bc' in options && 'o' in options ){

            if( type === 'p2' ){

                var rgb = THEASYS.fn.hexToRgb(options.bc);

                if ( rgb ){

                    var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.o+')';

                    style += ' .presentation-product-container{background:'+rgba+'!important;}';

                }

            } else {

                style += ' .fancybox-bg{background:'+options.bc+'!important;opacity:'+options.o+'!important}';

            }

        }

        //close icon

        if( 'cbc' in options && 'cbco' in options ){

            var rgb = THEASYS.fn.hexToRgb(options.cbc);

            if ( rgb ){

                var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.cbco+')';

                if( type === 'p2' ){

                    style += ' .presentation-product-close{background:'+rgba+'!important;}';

                } else {

                    style += ' .fancybox-content .fancybox-close-small{background:'+rgba+'!important;}';

                }

            }

        }

        if( 'hcbc' in options && 'hcbco' in options ){

            var rgb = THEASYS.fn.hexToRgb(options.hcbc);

            if ( rgb ){

                var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.hcbco+')';

                if( type === 'p2' ){

                    style += ' .presentation-product-close:hover{background:'+rgba+'!important;}';

                } else {

                    style += ' .fancybox-content .fancybox-close-small:hover{background:'+rgba+'!important;}';

                }

            }

        }

        if( 'ctc' in options ){

            if( type === 'p2' ){

                style += ' .presentation-product-close{color:'+options.ctc+'!important}';

            } else {

                style += ' .fancybox-content .fancybox-close-small{color:'+options.ctc+'!important}';

            }

        }

        if( 'hctc' in options ){

            if( type === 'p2' ){

                style += ' .presentation-product-close:hover{color:'+options.hctc+'!important}';

            } else {

                style += ' .fancybox-content .fancybox-close-small:hover{color:'+options.hctc+'!important}';

            }

        }

        //title

        if( 'tbc' in options && 'to' in options ){

            var rgb = THEASYS.fn.hexToRgb(options.tbc);

            if ( rgb ){

                var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.to+')';

                style += ' .fancybox-caption{background: linear-gradient(0deg,'+rgba+' 0,rgba(0,0,0,.3) 50%,rgba(0,0,0,.15) 65%,rgba(0,0,0,.075) 75.5%,rgba(0,0,0,.037) 82.85%,rgba(0,0,0,.019) 88%,transparent)!important;}';

            }

        }

        if( 'tc' in options ){

            style += ' .fancybox-caption{color:'+options.tc+'!important}';

        }

        //navigation arrows

        if( type === 'dig' || type === 'p1' ){

            if( 'nbc' in options && 'nbco' in options ){

                var rgb = THEASYS.fn.hexToRgb(options.nbc);

                if ( rgb ){

                    var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.nbco+')';

                    style += ' .fancybox-navigation .fancybox-button div{background:'+rgba+'!important;}';

                }

            }

            if( 'ntc' in options ){

                style += ' .fancybox-navigation .fancybox-button div{color:'+options.ntc+'!important}';

            }

            if( 'hnbc' in options && 'hnbco' in options ){

                var rgb = THEASYS.fn.hexToRgb(options.hnbc);

                if ( rgb ){

                    var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.hnbco+')';

                    style += ' .fancybox-navigation .fancybox-button div:hover{background:'+rgba+'!important;}';

                }

            }

            if( 'hntc' in options ){

                style += ' .fancybox-navigation .fancybox-button div:hover{color:'+options.hntc+'!important}';

            }

            if( 'ndtc' in options ){

                style += ' .fancybox-navigation .fancybox-button[disabled]  div, .fancybox-navigation .fancybox-button[disabled]  div:hover{color:'+options.ndtc+'!important}';

            }

        }

        //panel

        if( type === 'dip' ){

            if( 'pbc' in options && 'pbco' in options ){

                var rgb = THEASYS.fn.hexToRgb(options.pbc);

                if ( rgb ){

                    var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.pbco+')';

                    style += ' .fancybox-content{background:'+rgba+'!important;}';

                }

            }

            if( 'ptc' in options ){

                style += ' .fancybox-content{color:'+options.ptc+'!important}';

                style += ' .fancybox-content a{color:'+options.ptc+'!important}';

                style += ' .fancybox-content a:hover{color:'+options.ptc+'!important}';

            }

            if( 'pp' in options ){

                style += ' .fancybox-content{padding:'+options.pp+'px!important}';

            }

            //INFO PANEL BORDERS

            if( 'ipbolw' in options && 'ipbolc' in options && 'ipbolt' in options ){

                style += ' .fancybox-content{border-left:'+options.ipbolw+'px '+options.ipbolt+' '+options.ipbolc+'!important;}';

            }

            if( 'ipbotw' in options && 'ipbotc' in options && 'ipbott' in options ){

                style += ' .fancybox-content{border-top:'+options.ipbotw+'px '+options.ipbott+' '+options.ipbotc+'!important;}';

            }

            if( 'ipborw' in options && 'ipborc' in options && 'ipbort' in options ){

                style += ' .fancybox-content{border-right:'+options.ipborw+'px '+options.ipbort+' '+options.ipborc+'!important;}';

            }

            if( 'ipbobw' in options && 'ipbobc' in options && 'ipbobt' in options ){

                style += '.fancybox-content{border-bottom:'+options.ipbobw+'px '+options.ipbobt+' '+options.ipbobc+'!important;}';

            }

            //INFO PANEL CLOSE BUTTON MARGIN

            if( 'ipcbtm' in options ){

                style += '.fancybox-content .fancybox-close-small{margin-top:'+options.ipcbtm+'px!important;}';

            }

            if( 'ipcbrm' in options ){

                style += '.fancybox-content .fancybox-close-small{margin-right:'+options.ipcbrm+'px!important;}';

            }

        }

        //p2

        if( type === 'p2' ){

            if( 'lpbc' in options && 'lpbco' in options ){

                var rgb = THEASYS.fn.hexToRgb(options.lpbc);

                if ( rgb ){

                    var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.lpbco+')';

                    style += ' .presentation-product-carousel{background:'+rgba+'!important;}';

                }

            }

            if( 'lpbbc' in options ) {

                style += '.presentation-product-bullets li:not(.active) a span{background:'+options.lpbbc+'!important}';

            }

            if( 'lpabbc' in options) {

                style += '.presentation-product-bullets li.active a span{background:'+options.lpabbc+'!important}';

            }

            if( 'rpbc' in options) {

                style += '.presentation-product-aside{background:'+options.rpbc+'!important}';

            }

            if( 'rpbc' in options && 'rpbco' in options ){

                var rgb = THEASYS.fn.hexToRgb(options.rpbc);

                if ( rgb ){

                    var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.rpbco+')';

                    style += ' .presentation-product-aside{background:'+rgba+'!important;}';

                }

            }

            if( 'rptc' in options) {

                style += '.presentation-product-aside{color:'+options.rptc+'!important}';

                style += '.presentation-product-aside a{color:'+options.rptc+'!important}';

                style += '.presentation-product-aside a:hover{color:'+options.rptc+'!important}';

            }

            //TYPE 2 LEFT PANEL BORDERS

            if( 'lpbolw' in options && 'lpbolc' in options && 'lpbolt' in options ){

                style += '.presentation-product-carousel{border-left:'+options.lpbolw+'px '+options.lpbolt+' '+options.lpbolc+'!important;}';

            }

            if( 'lpbotw' in options && 'lpbotc' in options && 'lpbott' in options ){

                style += '.presentation-product-carousel{border-top:'+options.lpbotw+'px '+options.lpbott+' '+options.lpbotc+'!important;}';

            }

            if( 'lpborw' in options && 'lpborc' in options && 'lpbort' in options ){

                style += '.presentation-product-carousel{border-right:'+options.lpborw+'px '+options.lpbort+' '+options.lpborc+'!important;}';

            }

            if( 'lpbobw' in options && 'lpbobc' in options && 'lpbobt' in options ){

                style += '.presentation-product-carousel{border-bottom:'+options.lpbobw+'px '+options.lpbobt+' '+options.lpbobc+'!important;}';

            }

            //TYPE 2 RIGHT PANEL BORDERS

            if( 'rpbolw' in options && 'rpbolc' in options && 'rpbolt' in options ){

                style += '.presentation-product-aside{border-left:'+options.rpbolw+'px '+options.rpbolt+' '+options.rpbolc+'!important;}';

            }

            if( 'rpbotw' in options && 'rpbotc' in options && 'rpbott' in options ){

                style += '.presentation-product-aside{border-top:'+options.rpbotw+'px '+options.rpbott+' '+options.rpbotc+'!important;}';

            }

            if( 'rpborw' in options && 'rpborc' in options && 'rpbort' in options ){

                style += '.presentation-product-aside{border-right:'+options.rpborw+'px '+options.rpbort+' '+options.rpborc+'!important;}';

            }

            if( 'rpbobw' in options && 'rpbobc' in options && 'rpbobt' in options ){

                style += '.presentation-product-aside{border-bottom:'+options.rpbobw+'px '+options.rpbobt+' '+options.rpbobc+'!important;}';

            }

            //TYPE 2 CLOSE BUTTON MARGIN

            if( 'rpcbtm' in options ){

                style += '.presentation-product-close{margin-top:'+options.rpcbtm+'px!important;}';

            }

            if( 'rpcbrm' in options ){

                style += '.presentation-product-close{margin-right:'+options.rpcbrm+'px!important;}';

            }

            //TYPE 2 LEAD BUTTON

            if( 'rplbbc' in options && 'rplbo' in options ){

                var rgb = THEASYS.fn.hexToRgb(options.rplbbc);

                if ( rgb ){

                    var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.rplbo+')';

                    style += ' .presentation-product-panel-lead-button a{background:'+rgba+'!important;}';

                }

            }

            if( 'rplbtc' in options ) {

                style += '.presentation-product-panel-lead-button a{color:'+options.rplbtc+'!important}';

            }

            if( 'rplbff' in options ) {

                if( options.rplbff !== '' ) {

                    style += ".presentation-product-panel-lead-button a{font-family:'"+options.rplbff+"'!important}";

                }

            }

            if( 'rplbfs' in options ) {

                style += '.presentation-product-panel-lead-button a{font-size:'+options.rplbfs+'px!important}';

            }

            if( 'rplbfw' in options ) {

                style += '.presentation-product-panel-lead-button a{font-weight:'+options.rplbfw+'!important}';

            }

            if( 'rplbp' in options) {

                var align = 'left';

                if( parseInt(options.rplbp,10) === 1 ){

                    align = 'center';

                } else if( parseInt(options.rplbp,10) === 2 ){

                    align = 'right';

                }

                style += '.presentation-product-panel-lead-button{text-align:'+align+'!important}';

            }

            if( 'rplbw' in options) {

                if( parseInt(options.rplbw,10) > 0 ){

                    style += '.presentation-product-panel-lead-button a{width:'+options.rplbw+'%!important}';

                }

            }

            if( 'rplbml' in options) {

                style += '.presentation-product-panel-lead-button a{margin-left:'+options.rplbml+'px!important}';

            }

            if( 'rplbmr' in options) {

                style += '.presentation-product-panel-lead-button a{margin-right:'+options.rplbmr+'px!important}';

            }

            if( 'rplbmt' in options) {

                style += '.presentation-product-panel-lead-button a{margin-top:'+options.rplbmt+'px!important}';

            }

            if( 'rplbmb' in options) {

                style += '.presentation-product-panel-lead-button a{margin-bottom:'+options.rplbmb+'px!important}';

            }

            if( 'rplbpx' in options) {

                style += '.presentation-product-panel-lead-button a{padding-left:'+options.rplbpx+'px!important;padding-right:'+options.rplbpx+'px!important}';

            }

            if( 'rplbpy' in options) {

                style += '.presentation-product-panel-lead-button a{padding-top:'+options.rplbpy+'px!important;padding-bottom:'+options.rplbpy+'px!important}';

            }

            if( 'rplbr' in options) {

                style += '.presentation-product-panel-lead-button a{border-radius:'+options.rplbr+'px!important;}';

            }

            if( 'rplbbow' in options) {

                if( parseInt(options.rplbbow,10) > 0 ){

                    if( 'rplbboc' in options && 'rplbbot' in options ){

                        style += '.presentation-product-panel-lead-button a{border:'+options.rplbbow+'px '+options.rplbbot+' '+options.rplbboc+'!important;}';

                    }

                }

            }

            //HOVER

            if( 'hrplbbc' in options && 'hrplbo' in options ){

                var rgb = THEASYS.fn.hexToRgb(options.hrplbbc);

                if ( rgb ){

                    var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.hrplbo+')';

                    style += ' .presentation-product-panel-lead-button a:hover{background:'+rgba+'!important;}';

                }

            }

            if( 'hrplbtc' in options ) {

                style += '.presentation-product-panel-lead-button a:hover{color:'+options.hrplbtc+'!important}';

            }

            if( 'hrplbw' in options) {

                if( parseInt(options.hrplbw,10) > 0 ){

                    style += '.presentation-product-panel-lead-button a:hover{width:'+options.hrplbw+'%!important}';

                }

            }

            if( 'hrplbfs' in options ) {

                style += '.presentation-product-panel-lead-button a:hover{font-size:'+options.hrplbfs+'px!important}';

            }

            if( 'hrplbfw' in options ) {

                style += '.presentation-product-panel-lead-button a:hover{font-weight:'+options.hrplbfw+'!important}';

            }

            if( 'hrplbr' in options) {

                style += '.presentation-product-panel-lead-button a:hover{border-radius:'+options.hrplbr+'px!important;}';

            }

            if( 'hrplbbow' in options) {

                if( parseInt(options.hrplbbow,10) > 0 ){

                    if( 'hrplbboc' in options && 'hrplbbot' in options ){

                        style += '.presentation-product-panel-lead-button a:hover{border:'+options.hrplbbow+'px '+options.hrplbbot+' '+options.hrplbboc+'!important;}';

                    }

                }

            }



        }

    }

    $('#styles').html(style);

}

THEASYS.fn.clear_cao = function(instance_id){

    if( THEASYS.theme.popup_instance ){

        $('#fancybox-container-'+THEASYS.theme.popup_instance).removeClass('hidden');

    }

    $('#styles').html('');

    THEASYS.theme.popup_instance = 0;

}

THEASYS.theme.applyEditsOnTheFly = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'hotspots_use_theme_font':

                var value = ~~obj[k];

                THEASYS.renderer.vars.set('options.hotspots_use_theme_font',value);

                THEASYS.theme.applyCustomizations();

            break;

        }

    }

};

THEASYS.theme.applyCustomizations = function(obj){

    var options = THEASYS.renderer.vars.get('options');

    var style = '';

    if( 'hotspots_use_theme_font' in options ){

        if( ~~options.hotspots_use_theme_font ){

            style += '.popup-info-panel-display_info_panel{font-family: unset;}';
            style += '#presentation-product-panel{font-family: unset;}';

        } else {

            style += '.popup-info-panel-display_info_panel{font-family: Arial, sans-serif;}';
            style += '#presentation-product-panel{font-family: Arial, sans-serif;}';

        }

    }

    $('#theme_styles').html(style);

};

THEASYS.theme.closePopups = function(){

    $.fancybox.close(true);

};