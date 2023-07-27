/*
 *  Name : Thumbnails Stack
 *  Description : Display a thumbnails stuck on the bottom
 *  Version : 0.0.3
*/

THEASYS.theme.autoLoadFunction('thumbnails','init');

THEASYS.theme.modules.thumbnails.initialized = false;

THEASYS.theme.modules.thumbnails.thumbnails_loaded = false;

THEASYS.theme.modules.thumbnails.init = function(){

            var toggle_icon = `
<svg version="1.1" x="0px" y="0px" viewBox="0 0 430.23 430.23">
        <g>
            <path d="M217.875,159.668c-24.237,0-43.886,19.648-43.886,43.886c0,24.237,19.648,43.886,43.886,43.886
                c24.237,0,43.886-19.648,43.886-43.886C261.761,179.316,242.113,159.668,217.875,159.668z M217.875,226.541
                c-12.696,0-22.988-10.292-22.988-22.988c0-12.696,10.292-22.988,22.988-22.988h0c12.696,0,22.988,10.292,22.988,22.988
                C240.863,216.249,230.571,226.541,217.875,226.541z"/>
            <path d="M392.896,59.357L107.639,26.966c-11.071-1.574-22.288,1.658-30.824,8.882c-8.535,6.618-14.006,16.428-15.151,27.167
                l-5.224,42.841H40.243c-22.988,0-40.229,20.375-40.229,43.363V362.9c-0.579,21.921,16.722,40.162,38.644,40.741
                c0.528,0.014,1.057,0.017,1.585,0.01h286.824c22.988,0,43.886-17.763,43.886-40.751v-8.359
                c7.127-1.377,13.888-4.224,19.853-8.359c8.465-7.127,13.885-17.22,15.151-28.212l24.033-212.114
                C432.44,82.815,415.905,62.088,392.896,59.357z M350.055,362.9c0,11.494-11.494,19.853-22.988,19.853H40.243
                c-10.383,0.305-19.047-7.865-19.352-18.248c-0.016-0.535-0.009-1.07,0.021-1.605v-38.661l80.98-59.559
                c9.728-7.469,23.43-6.805,32.392,1.567l56.947,50.155c8.648,7.261,19.534,11.32,30.825,11.494
                c8.828,0.108,17.511-2.243,25.078-6.792l102.922-59.559V362.9z M350.055,236.99l-113.894,66.351
                c-9.78,5.794-22.159,4.745-30.825-2.612l-57.469-50.678c-16.471-14.153-40.545-15.021-57.992-2.09l-68.963,50.155V149.219
                c0-11.494,7.837-22.465,19.331-22.465h286.824c12.28,0.509,22.197,10.201,22.988,22.465V236.99z M409.112,103.035
                c-0.007,0.069-0.013,0.139-0.021,0.208l-24.555,212.114c0.042,5.5-2.466,10.709-6.792,14.106c-2.09,2.09-6.792,3.135-6.792,4.18
                V149.219c-0.825-23.801-20.077-42.824-43.886-43.363H77.337l4.702-40.751c1.02-5.277,3.779-10.059,7.837-13.584
                c4.582-3.168,10.122-4.645,15.674-4.18l284.735,32.914C401.773,81.346,410.203,91.545,409.112,103.035z"/>
        </g>
</svg>
            `;

    var html = `

    <div id="thumbnails-wrapper">
        <div id="thumbnails-toggle-wrapper">
            <div id="thumbnails-toggle">
                <span class="icon_images">
                    ${toggle_icon}
                </span>
                <span id="thumbnails_current_panorama_title" class="current_panorama_title"></span>
            </div>
        </div>
        <div id="thumbnails-tooltip" class="arrow_box"></div>
        <div id="thumbnails" class="owl-carousel"></div>
    </div>

    `;

    THEASYS.theme.prependHtml(html,document.getElementById('viewer_wrapper'));

    THEASYS.api.engine.execute('get','thumbnails',null,function(data){

        var editing = THEASYS.renderer.vars.get('editing');

        var options = THEASYS.renderer.vars.get('options');

        if( !editing && ( 'thumbnails_enabled' in options) && !parseInt( options.thumbnails_enabled, 10 ) ){

            return false;

        }

        var thumbnails_wrapper = $('#thumbnails-wrapper');

        if( 'thumbnails' in data && data.thumbnails.length ){

            var html = '';

            var thumbnails_sticky_panorama_title = 0;

            if( 'thumbnails_sticky_panorama_title' in options ){

                thumbnails_sticky_panorama_title = ~~options.thumbnails_sticky_panorama_title;

            }

            var sticky_display = 0;

            for( var i = 0, n = data.thumbnails.length; i < n; i++ ){

                if( thumbnails_sticky_panorama_title ){

                    if( data.thumbnails[i].title === '' ){

                        sticky_display = 0;

                    } else {

                        sticky_display = 1;

                    }

                } else {

                    sticky_display = 0;

                }

                html +='<div class="item" data-rnd="'+data.thumbnails[i].rnd+'"><div class="sticky'+(sticky_display?'':' hidden')+'">'+data.thumbnails[i].title+'</div><img alt="'+data.thumbnails[i].title+'" data-title="'+data.thumbnails[i].title+'" src="'+data.thumbnails[i].image+'"></div>';

            }

            $('head').append('<style id="thumbnails_styles" rel="stylesheet" type="text/css"></style>');

            THEASYS.theme.modules.thumbnails.applyCustomizations();

            var thumbnails = $('#thumbnails');

            thumbnails.html(html);

            var nav_previous_icon = `
<svg version="1.1" x="0px" y="0px" viewBox="0 0 477.175 477.175">
    <path d="M145.188,238.575l215.5-215.5c5.3-5.3,5.3-13.8,0-19.1s-13.8-5.3-19.1,0l-225.1,225.1c-5.3,5.3-5.3,13.8,0,19.1l225.1,225
        c2.6,2.6,6.1,4,9.5,4s6.9-1.3,9.5-4c5.3-5.3,5.3-13.8,0-19.1L145.188,238.575z"/>
</svg>
            `;

            var nav_next_icon = `
<svg version="1.1" x="0px" y="0px" viewBox="0 0 477.175 477.175">
    <path d="M360.731,229.075l-225.1-225.1c-5.3-5.3-13.8-5.3-19.1,0s-5.3,13.8,0,19.1l215.5,215.5l-215.5,215.5
        c-5.3,5.3-5.3,13.8,0,19.1c2.6,2.6,6.1,4,9.5,4c3.4,0,6.9-1.3,9.5-4l225.1-225.1C365.931,242.875,365.931,234.275,360.731,229.075z
        "/>
</svg>`;

            thumbnails.owlCarousel({
                loop:false,
                pagination:false,
                lazyLoad:true,
                autoWidth:true,
                dots : false,
                margin:10,
                nav : true,
                navText:['<div class="nav-btn thumbnails-prev-slide">'+nav_previous_icon+'</div>','<div class="nav-btn thumbnails-next-slide">'+nav_next_icon+'</div>'],

            });

            thumbnails_wrapper.fadeIn();

            if( ( 'thumbnails_enabled' in options ) ){

                if( !~~options.thumbnails_enabled ){

                    thumbnails_wrapper.addClass('hidden');

                } else {

                    if( ( 'thumbnails_visible_by_default' in options ) && parseInt( options.thumbnails_visible_by_default, 10 ) ){

                        thumbnails_wrapper.addClass('thumbnails-active');

                        $('#copyright').addClass('hidden');

                    }

                }

            }

            $('#thumbnails-toggle').on('click',function(){

                THEASYS.theme.modules.thumbnails.toggleThumbnailsStack();

            });

            thumbnails.on('click','.item',function(e){

                e.preventDefault();

                var jthis = $(this);

                var rnd =  jthis.data('rnd') || '';

                if( rnd !== '' ){

                    THEASYS.renderer.fetchPanorama({

                        l : rnd

                    });

                    $('#thumbnails-tooltip').stop().fadeOut();

                    if( ~~options.thumbnails_close_on_action ){

                        thumbnails_wrapper.removeClass('thumbnails-active');

                    }

                    THEASYS.renderer.animateProcessObjects(100);

                }

                return false;

            });

            var thumbnailsHoverActions = 0;

            if( editing ){

                thumbnailsHoverActions = 1;

            } else {

                if( ( 'thumbnails_show_panorama_title_on_hover' in options ) && parseInt( options.thumbnails_show_panorama_title_on_hover, 10 ) ){

                    thumbnailsHoverActions = 1;

                }

            }

            if( thumbnailsHoverActions ){

                var thumbnails_tooltip = $('#thumbnails-tooltip');

                thumbnails.on('mouseover','img',function(){

                    if( ( 'thumbnails_show_panorama_title_on_hover' in options ) && parseInt( options.thumbnails_show_panorama_title_on_hover, 10 ) ){

                        var jthis = $(this), tooltip_text = jthis.data('title');
                        if( tooltip_text === '') return false;

                        var thumbnails_wrapper_height = $('#thumbnails-wrapper').outerHeight();

                        thumbnails_tooltip.html( tooltip_text ).css({

                            bottom : thumbnails_wrapper_height + 13,
                            left : jthis.offset().left,
                            width : jthis.width(),

                        }).stop().fadeIn(200);

                    }

                }).on('mouseleave','img',function(){

                    thumbnails_tooltip.stop().fadeOut(200);

                });

            }

            THEASYS.theme.modules.thumbnails.thumbnails_loaded = true;

            THEASYS.theme.modules.thumbnails.selectThumbnail();

        } else {

            thumbnails_wrapper.addClass('hidden');

        }

        $('#thumbnails-toggle-wrapper').animate({opacity:1},1000);

        THEASYS.renderer.event.on('loadedPanorama',function(){

            if( THEASYS.theme.modules.thumbnails.initialized ){

                THEASYS.theme.modules.thumbnails.selectThumbnail();

            }

        });

        THEASYS.renderer.event.on('resize',function(){

            var vr = THEASYS.renderer.vars.get('vr');
            var device = THEASYS.renderer.vars.get('device');

            if( device.isMobile ){

                var thumbnails_wrapper = $('#thumbnails-wrapper');

                if( thumbnails_wrapper.length ){

                    if( thumbnails_wrapper.hasClass('thumbnails-active') ){

                        var copyright_cloned = $('#copyright_cloned');

                        copyright_cloned.removeClass('hidden');

                    }

                }

            }

        });

        THEASYS.renderer.event.on('userAction',function(){

            THEASYS.theme.exec('menu','closeOnActions');

        });



        THEASYS.theme.modules.thumbnails.initialized = true;

    });

    THEASYS.renderer.event.on('toggleVr',function(vr){

        var isMobile = THEASYS.renderer.vars.get('device.isMobile');

        if( vr ){

            if( isMobile ){

                $('#thumbnails-wrapper').addClass('hidden');

            }

        } else {

            if( isMobile ){

                var thumbnails_wrapper = $('#thumbnails-wrapper');

                thumbnails_wrapper.removeClass('hidden');

                if( thumbnails_wrapper.length ){

                    if( thumbnails_wrapper.hasClass('thumbnails-active') ){

                        THEASYS.theme.exec('copyright','hide');

                    }

                }

            }

        }

    });

};

THEASYS.theme.modules.thumbnails.api = function( action, key, value ){

    if( key === 'thumbnails' ){

        switch( action ){

            case'set':

                var val = -1;

                if( value !== undefined && value !== null && !isNaN(value) ){

                    val = parseInt(value,10);

                }

                this.toggleThumbnailsStack(val);

            break;

        }

    }

};

THEASYS.theme.modules.thumbnails.listenToEdits = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'thumbnails_enabled':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.thumbnails_enabled',value);

                if( value ){

                    $('#thumbnails-wrapper').removeClass('hidden');

                } else {

                    $('#thumbnails-wrapper').addClass('hidden');

                }

            break;

            case'thumbnails_show_panorama_title_on_hover':

                THEASYS.renderer.vars.set('options.thumbnails_show_panorama_title_on_hover',+obj[k]);

            break;

            case'thumbnails_sticky_panorama_title':

                THEASYS.renderer.vars.set('options.thumbnails_sticky_panorama_title',+obj[k]);

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.thumbnails_sticky_panorama_title',value);

                $('#thumbnails-wrapper').find('.item img').each(function(){

                    var jthis = $(this);

                    var title = jthis.data('title');

                    if( title === '' ){

                        jthis.parent().find('.sticky').addClass('hidden');

                    } else {

                        if( value ){

                            jthis.parent().find('.sticky').removeClass('hidden');

                        } else {

                            jthis.parent().find('.sticky').addClass('hidden');

                        }

                    }

                });

            break;

            case'thumbnails_visible_by_default':

                THEASYS.renderer.vars.set('options.thumbnails_visible_by_default',+obj[k]);

            break;

            case'thumbnails_close_on_action':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.thumbnails_close_on_action',value);

            break;

            case'thumbnails_auto_scroll_to_active':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.thumbnails_auto_scroll_to_active',value);

            break;

            case'thumbnails_tobc':
            case'thumbnails_totc':
            case'thumbnails_totp':
            case'thumbnails_tobr':
            case'thumbnails_toboa':
            case'thumbnails_tobo':
            case'thumbnails_topos':

            case'thumbnails_nbc':
            case'thumbnails_ntc':
            case'thumbnails_nbr':
            case'thumbnails_nboh':
            case'thumbnails_nbo':
            case'thumbnails_ns':
            case'thumbnails_np':

            case'thumbnails_cbc':
            case'thumbnails_ctc':
            case'thumbnails_cbr':
            case'thumbnails_cboa':
            case'thumbnails_cbo':
            case'thumbnails_cpos':

            case'thumbnails_bo':
            case'thumbnails_bc':
            case'thumbnails_imgbo':
            case'thumbnails_imgbr':
            case'thumbnails_sbo':
            case'thumbnails_sbc':
            case'thumbnails_sbr':
            case'thumbnails_stc':
            case'thumbnails_ttc':
            case'thumbnails_tbc':
            case'thumbnails_tbo':
            case'thumbnails_tbr':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.'+k,value);

                this.applyCustomizations();

            break;

        }

    }

};

THEASYS.theme.modules.thumbnails.selectThumbnail = function(){

    if( !THEASYS.theme.modules.thumbnails.thumbnails_loaded ){

        return false;

    }

    var thumbnails = $('#thumbnails');

    var obj = THEASYS.renderer.vars.get('obj');

    var thumbnails_current_panorama_title = ~~THEASYS.renderer.vars.get('options.thumbnails_current_panorama_title');

    var thumbnails_auto_scroll_to_active = ~~THEASYS.renderer.vars.get('options.thumbnails_auto_scroll_to_active');

    if( obj && ('rnd' in obj) && obj.rnd !== '' ){

        thumbnails.find('.item').removeClass('active');

        var item = thumbnails.find('.item[data-rnd="'+obj.rnd+'"]');

        if( thumbnails_auto_scroll_to_active ){

            var selected_index = 0;

            thumbnails.find('.item').each(function(index){

                var rnd = $(this).data('rnd');

                if( obj.rnd == rnd ){

                    selected_index = index;

                    return;

                }

            });

            thumbnails.trigger('to.owl.carousel', selected_index);

        }

        item.addClass('active');

        if( thumbnails_current_panorama_title ){

            var title = item.find('.sticky').html();

            if( title ){

                $('#thumbnails_current_panorama_title').html(title).removeClass('hidden');

            } else {

                $('#thumbnails_current_panorama_title').html(title).addClass('hidden');

            }

        } else {

            $('#thumbnails_current_panorama_title').addClass('hidden');

        }

    }

};

THEASYS.theme.modules.thumbnails.toggleThumbnailsStack = function(state){

    var thumbnails_wrapper = $('#thumbnails-wrapper');

    if( state !== undefined ){

        if( isNaN(state) ){

            return false;

        }

        var state = parseInt(state,10);

        if( state === 1 ){

            thumbnails_wrapper.addClass('thumbnails-active');

        } else if( state === 0 ) {

            thumbnails_wrapper.removeClass('thumbnails-active');

        } else {

            thumbnails_wrapper.toggleClass('thumbnails-active');

        }

    } else {

        thumbnails_wrapper.toggleClass('thumbnails-active');

    }

    var copyright_viewer = THEASYS.renderer.vars.get('options.copyright_viewer');

    if( ~~copyright_viewer ){

        if( !thumbnails_wrapper.hasClass('thumbnails-active') ){

            window.requestTimeout(function() {

                THEASYS.theme.exec('copyright','toogleHidden');

            }, 800);

        } else {

            THEASYS.theme.exec('copyright','toogleHidden');

        }

    }

};

THEASYS.theme.modules.thumbnails.setThumbnailsStackTopPosition = function(state){

    if( !this.thumbnails_loaded ){

        return false;

    }

    var thumbnails_wrapper = $('#thumbnails-wrapper');

};

THEASYS.theme.modules.thumbnails.applyCustomizations = function(){

    var options = THEASYS.renderer.vars.get('options');

    var style = '';

    if( 'thumbnails_bc' in options && 'thumbnails_bo' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.thumbnails_bc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.thumbnails_bo+')';

            style += '#thumbnails-wrapper{background:'+rgba+'!important;}';
            style += '#thumbnails-wrapper #thumbnails-tooltip{background:'+rgba+'!important;}';

        }

    }

    //sticky

    if( 'thumbnails_sbc' in options && 'thumbnails_sbo' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.thumbnails_sbc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.thumbnails_sbo+')';

            style += '#thumbnails .item .sticky{background:'+rgba+'!important;}';

        }

    }

    if( 'thumbnails_sbr' in options ){

        style += '#thumbnails .item .sticky{border-radius: '+options.thumbnails_sbr+'px!important;}';
    }


    if( 'thumbnails_stc' in options ){

        style += '#thumbnails .item .sticky{color:'+options.thumbnails_stc+'!important;}';

    }

    //tooltip

    if( 'thumbnails_tbc' in options && 'thumbnails_tbo' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.thumbnails_tbc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.thumbnails_tbo+')';

            style += '#thumbnails-wrapper #thumbnails-tooltip{background:'+rgba+'!important;}';
            style += '#thumbnails-tooltip.arrow_box:after{border-top-color:'+rgba+'!important;}';

        }

    }

    if( 'thumbnails_tbr' in options ){

        style += '#thumbnails-wrapper #thumbnails-tooltip{border-radius: '+options.thumbnails_tbr+'px!important;}';
    }


    if( 'thumbnails_ttc' in options ){

        style += '#thumbnails-wrapper #thumbnails-tooltip{color:'+options.thumbnails_ttc+'!important;}';

    }

    //toogle

    if( 'thumbnails_tobc' in options && 'thumbnails_tobo' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.thumbnails_tobc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.thumbnails_tobo+')';

            style += '#thumbnails-wrapper #thumbnails-toggle{background:'+rgba+'!important;}';

        }

    }

    if( 'thumbnails_tobc' in options && 'thumbnails_toboa' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.thumbnails_tobc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.thumbnails_toboa+')';

            style += '#thumbnails-wrapper:hover #thumbnails-toggle, #thumbnails-wrapper.thumbnails-active #thumbnails-toggle{background:'+rgba+'!important;}';

        }

    }

    if( 'thumbnails_topos' in options ){

        style += '#thumbnails-wrapper #thumbnails-toggle-wrapper{left: '+options.thumbnails_topos+'%!important;transform: translateX(-'+options.thumbnails_topos+'%)!important;}';


    }

    if( 'thumbnails_tobr' in options ){

        style += '#thumbnails-wrapper #thumbnails-toggle{border-radius: '+options.thumbnails_tobr+'px '+options.thumbnails_tobr+'px 0 0!important;}';

    }

    if( 'thumbnails_totc' in options ){

        style += '#thumbnails-wrapper #thumbnails-toggle{color: '+options.thumbnails_totc+'!important;}';
        style += '#thumbnails-toggle-wrapper .icon_images svg path{fill: '+options.thumbnails_totc+'!important;}';


    }

    if( 'thumbnails_totp' in options && ~~options.thumbnails_totp === 0 ){

        style += '#thumbnails-wrapper #thumbnails-toggle #thumbnails_current_panorama_title{margin: 2px 10px 0 0;}';
        style += '#thumbnails-wrapper #thumbnails-toggle {flex-direction: row-reverse;}';

    }

    //arrows

    if( 'thumbnails_nbc' in options && 'thumbnails_nbo' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.thumbnails_nbc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.thumbnails_nbo+')';

            style += '#thumbnails.owl-carousel .owl-nav .nav-btn svg{background:'+rgba+'!important;}';

        }

    }

    if( 'thumbnails_nbc' in options && 'thumbnails_nboh' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.thumbnails_nbc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.thumbnails_nboh+')';

            style += '#thumbnails.owl-carousel .owl-nav .nav-btn svg:hover{background:'+rgba+'!important;}';

        }

    }

    if( 'thumbnails_nbr' in options ){

        style += '#thumbnails.owl-carousel .owl-nav .nav-btn svg{border-radius: '+options.thumbnails_nbr+'px!important;}';

    }

    if( 'thumbnails_ntc' in options ){

        style += '#thumbnails.owl-carousel .owl-nav .nav-btn svg path{fill: '+options.thumbnails_ntc+'!important;}';

    }

    if( 'thumbnails_ns' in options ){

        style += '#thumbnails.owl-carousel .owl-nav .nav-btn svg{width: '+options.thumbnails_ns+'px!important;}';

    }

    if( 'thumbnails_np' in options ){

        style += '#thumbnails.owl-carousel .owl-nav .nav-btn svg{padding: '+options.thumbnails_np+'px!important;}';

    }

    //images

    if( 'thumbnails_imgbo' in options ){

        style += '#thumbnails .item{opacity: '+options.thumbnails_imgbo+';}';

    }

    if( 'thumbnails_imgbr' in options ){

        style += '#thumbnails .item{border-radius: '+options.thumbnails_imgbr+'%!important;}';

    }

    $('#thumbnails_styles').html(style);

};