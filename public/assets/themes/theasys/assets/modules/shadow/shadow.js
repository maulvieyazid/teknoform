/*
 *  Name : Shadow
 *  Description : Displays a black transparent shadow on the top of the screen so elements such as menu can be visible
 *  Version : 0.0.3
*/

THEASYS.theme.autoLoadFunction('shadow','init');

THEASYS.theme.modules.shadow.initialized = false;

THEASYS.theme.modules.shadow.init = function( ){

    var html = `<div id="viewer_shadow"></div>`;

    THEASYS.theme.prependHtml(html,document.getElementById('viewer_wrapper'));

    var bg = THEASYS.vars.paths.static+'/themes/'+THEASYS.vars.theme+'/assets/modules/shadow/img/top-gradient.png';

    $('#viewer_shadow').css({

        'background': "url('"+bg+"') repeat-x bottom"

    });

    this.display();

    this.initialized = true;

    THEASYS.renderer.event.on('panoramaToScene',function(){

        THEASYS.theme.modules.shadow.display();

    });

    $('#viewer_shadow').on('click',function(){

        THEASYS.theme.exec('menu','closeOnActions');

    });

};

THEASYS.theme.modules.shadow.listenToEdits = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'menu_visible_shadow':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.menu_visible_shadow',value);

                if( !value ){

                    this.hide();

                } else {

                    this.show();

                }

            break;

        }

    }

};

THEASYS.theme.modules.shadow.display = function( ){

    var options = THEASYS.renderer.vars.get('options');

    if( ~~options.menu_visible ){

        this.show();

    } else {

        this.hide();

    }

};

THEASYS.theme.modules.shadow.show = function( ){

    var menu_visible_shadow = ~~THEASYS.renderer.vars.get('options.menu_visible_shadow');

    if( menu_visible_shadow ){

        //$('#viewer_shadow').stop().fadeIn(1000);
        $('#viewer_shadow').animate({opacity:1},500);

    }

};

THEASYS.theme.modules.shadow.hide = function( ){

    //$('#viewer_shadow').hide();
    $('#viewer_shadow').animate({opacity:0},500);

};