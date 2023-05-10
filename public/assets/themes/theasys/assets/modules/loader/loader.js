/*
 *  Name : loader
 *  Description : Displays loading circle, used by renderer and others
 *  Version : 0.0.2
*/

THEASYS.theme.autoLoadFunction('loader','init');

THEASYS.theme.modules.loader.initialized = false;

THEASYS.theme.modules.loader.init = function( ){

    var style = this.style();

    var html = `
        <div id="panorama-loader" class="loading" style="${style}"></div>
    `;

    THEASYS.theme.appendHtml(html);

    this.initialized = true;

    THEASYS.renderer.event.on('loader',function( state ){

        if( state === 'show' ){

            THEASYS.theme.modules.loader.show();

        } else if( state === 'hide' ){

            THEASYS.theme.modules.loader.hide();

        }

    });

};

THEASYS.theme.modules.loader.listenToEdits = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'loader_toggle':

                if( $('#panorama-loader:visible').length ){

                    //THEASYS.renderer.event.trigger('loader','hide');
                    this.hide();

                } else {

                    //THEASYS.renderer.event.trigger('loader','show');
                    this.show();

                }

            break;

            case'loader_color':

                var value = obj[k];

                $('.loading').css({'border-color':value});

            break;

            case'loader_size':

                var value = parseInt(obj[k],10);

                $('.loading').css({'width':value+'px','height':value+'px','border-radius': value+'px','margin': '-'+(value/2)+'px 0 0 -'+(value/2)+'px'});

            break;

            case'loader_border_size':

                var value = parseInt(obj[k],10);

                $('.loading').css({'border-width': value+'px'});

            break;

            case'loader_duration':

                var value = parseFloat(obj[k],10);

                $('.loading').css({'animation-duration':value+'s'});

            break;

        }

    }

};

THEASYS.theme.modules.loader.style = function( ){

    if( !('options' in vars) ){

        return '';

    }

    var loader_options = [];

    //We get the options from the global vars object and not from renderer options
    //because options are parsed when renderer loaded once.

    //var options = THEASYS.renderer.vars.get('options');

    var options = vars.options;

    if( 'loader_color' in options ){

        loader_options.push('border-color:'+options.loader_color);

    }

    if( 'loader_size' in options ){

        loader_options.push('width:'+options.loader_size+'px');

        loader_options.push('height:'+options.loader_size+'px');

        loader_options.push('border-radius:'+options.loader_size+'px');

        loader_options.push('margin:-'+(parseInt(options.loader_size,10)/2)+'px 0 0 -'+(parseInt(options.loader_size,10)/2)+'px');

    }

    if( 'loader_border_size' in options ){

        loader_options.push('border-width:'+options.loader_border_size+'px');

    }

    if( 'loader_duration' in options ){

        loader_options.push('animation-duration:'+options.loader_duration+'s');

    }

    return loader_options.join(';');

};

THEASYS.theme.modules.loader.show = function( ){

    var device = THEASYS.renderer.vars.get('device');

    if( device.isMobile ){

        $('#panorama-loader').fadeIn();

    } else {

        $('#panorama-loader').fadeIn();

    }

};

THEASYS.theme.modules.loader.hide = function( ){

    $('#panorama-loader').hide();

};
