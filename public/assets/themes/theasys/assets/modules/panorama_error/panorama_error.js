/*
 *  Name : panorama_error
 *  Description : Displays a screen with error messsage
 *  Version : 0.0.1
*/

//THEASYS.theme.autoLoadFunction('panorama_private','init');

THEASYS.theme.modules.panorama_error.initialized = false;

THEASYS.theme.modules.panorama_error.init = function( ){

    var logo = vars.paths.static+'/themes/'+vars.theme+'/assets/img/logo.png';

    var html = `
        <div id="panorama-error">
            <div class="logo">
                <a target="_blank" rel="noopener" href="${vars.url}"><img src="${logo}" alt="theasys.io logo"></a>
            </div>
            <div class="txt"></div>
        </div>
    `;

    THEASYS.theme.appendHtml(html);

    this.initialized = true;

    THEASYS.renderer.event.on('loadErrorScreen',function( msg ){

        THEASYS.theme.modules.panorama_error.load( msg );

    });

};

THEASYS.theme.modules.panorama_error.load = function( msg ){

    $('body').addClass('panorama-error-bg');

    var bg = THEASYS.vars.paths.static+'/themes/'+THEASYS.vars.theme+'/assets/modules/panorama_error/img/bg.jpg';

    $('body').css({

        'background' : 'url('+bg+') no-repeat center center fixed',
        'filter' : "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+bg+"', sizingMethod='scale')",
        '-ms-filter' : "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='"+bg+"', sizingMethod='scale')",
        'background-size' : 'cover',

    });

    $('#viewer').addClass('hidden');
    $('#viewer_menu').addClass('hidden');
    $('#panorama-error .txt').html(msg);

    THEASYS.theme.exec('loader','hide');

    $('#panorama-error').show();

};
