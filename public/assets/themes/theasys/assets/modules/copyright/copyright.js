/*
 *  Name : Copyright
 *  Description : Displays theasys copyright logo
 *  Version : 0.0.1
*/

THEASYS.theme.autoLoadFunction('copyright','init');

THEASYS.theme.modules.copyright.initialized = false;

THEASYS.theme.modules.copyright.init = function( ){

    var logo = vars.paths.static+'/themes/'+vars.theme+'/assets/img/logo.png';

    var html = `
        <div id="copyright">
            <a target="_blank" rel="noopener" href="${vars.url}">
                <img src="${logo}" alt="theasys.io" width="100">
            </a>
        </div>
    `;

    THEASYS.theme.appendHtml(html,document.getElementById('viewer_wrapper'));

    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

    if( 'tour' in THEASYS.cache.obj.tours[tour_rnd] ){

        if( !THEASYS.fn.is_empty(THEASYS.cache.obj.tours[tour_rnd].tour) ){

            this.display();

            THEASYS.renderer.event.on('toggleVr',function(vr){

                var device = THEASYS.renderer.vars.get('device');

                if( !vr ){

                    if( device.isMobile ){

                        $('#copyright_cloned').hide();

                    }

                }

            });

            THEASYS.renderer.event.on('resize',function(vr){

                var vr = THEASYS.renderer.vars.get('vr');

                var device = THEASYS.renderer.vars.get('device');

                if( vr ){

                    if( device.isMobile ){

                        var w = $(window).width();

                        var copyright_cloned = $('#copyright_cloned');

                        if( !copyright_cloned.length ){

                            var copyright_cloned =  $('#copyright').clone();
                            copyright_cloned.attr("id", "copyright_cloned");
                            copyright_cloned.css({right : (w/2) + 10});
                            $('body').append(copyright_cloned);

                        } else {

                            copyright_cloned.css({right : (w/2) + 10});

                        }

                        var copyright_viewer = THEASYS.renderer.vars.get('options.copyright_viewer');

                        if( ~~copyright_viewer ){

                            copyright_cloned.show();

                        } else {

                            copyright_cloned.hide();

                        }

                        var copyright = $('#copyright');

                        if( copyright.length ){

                          copyright.removeClass('hidden');

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

                        $('#copyright_cloned').hide();

                    }

                }

            });

        }

    }

    THEASYS.theme.modules.copyright.initialized = true;

};

THEASYS.theme.modules.copyright.listenToEdits = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'copyright_viewer':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.copyright_viewer',value);

                THEASYS.theme.modules.copyright.addRemoveClassHidden(value);

                THEASYS.theme.modules.copyright.display();

                THEASYS.theme.exec('contextMenu','init');

            break;

            case'copyright_context_menu':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.copyright_context_menu',value);

                THEASYS.theme.exec('contextMenu','init');

            break;

            case'copyright_context_menu_title':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.copyright_context_menu_title',value);

                THEASYS.theme.exec('contextMenu','init');

            break;

            case'copyright_context_menu_url':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.copyright_context_menu_url',value);

                THEASYS.theme.exec('contextMenu','init');

            break;


        }

    }

};

THEASYS.theme.modules.copyright.display = function( ){

    var options = THEASYS.renderer.vars.get('options');

    var copyright_elem = $('#copyright');

    var displayCopyrightBool = 0;

    if( 'copyright_viewer' in options ){

        displayCopyrightBool = ~~options.copyright_viewer;

    }

    if( displayCopyrightBool ){

        //copyright_elem.removeClass('hidden');
        copyright_elem.animate({opacity:1},1000);

    } else {

        copyright_elem.addClass('hidden');

    }

    var copyright_elem_start_screen = $('#copyright_start_screen');

    if( 'autoplay' in options && !~~options.autoplay ){

        if( 'copyright_start_screen' in options ){

            if( ~~options.copyright_start_screen ) {

                //copyright_elem_start_screen.removeClass('hidden');

            }

        }

    }

};

THEASYS.theme.modules.copyright.check = function(){

    var copyright_elem = $('#copyright');

    var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

    var observer = new MutationObserver(function(mutations) {

        if( mutations.length ){

            window.location = self.fn.u('code-mutation');

        }

    });

    var target = copyright_elem[0];

    var config = { attributes: true, childList: true, characterData: true };

    observer.observe(target, config);

    var target_a = copyright_elem.find('a')[0];

    observer.observe(target_a, config);

    var target_img = copyright_elem.find('img')[0];

    observer.observe(target_img, config);

    var cInterval = setInterval(function(){

        if( !$('#copyright').length ){

            window.location = self.fn.u('code-mutation');

            clearInterval(cInterval);
        }

    }, 1000);

};

THEASYS.theme.modules.copyright.toogleHidden = function(){

    var copyright_elem = $('#copyright');

    if( copyright_elem ){

        copyright_elem.toggleClass('hidden');

    }

};

THEASYS.theme.modules.copyright.startScreenAddRemoveClassHidden = function(value){

    if( value ){

        $('#copyright_start_screen').removeClass('hidden');

    } else {

        $('#copyright_start_screen').addClass('hidden');

    }

};

THEASYS.theme.modules.copyright.addRemoveClassHidden = function(value){

    if( value ){

        $('#copyright').removeClass('hidden');

    } else {

        $('#copyright').addClass('hidden');

    }

};

THEASYS.theme.modules.copyright.hide = function(){

    var copyright_elem = $('#copyright');

    if( copyright_elem ){

        copyright_elem.addClass('hidden');

    }

};
