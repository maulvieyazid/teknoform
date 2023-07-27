/*
 *  Name : hotspots_tooltip
 *  Description : Displays tooltip on hotspots hover and on mobile touch event
 *  Version : 0.0.3
*/

//THEASYS.theme.autoLoadFunction('hotspots_tooltip','init');

THEASYS.theme.modules.hotspots_tooltip.initialized = false;

THEASYS.theme.modules.hotspots_tooltip.last_displayed = null;

THEASYS.theme.modules.hotspots_tooltip.init = function( ){

    var html = `
        <div id="tooltips"></div>
    `;

    $('head').append('<style id="hotspots_tooltips_styles" rel="stylesheet" type="text/css"></style>');

    THEASYS.theme.appendHtml(html);

    if( THEASYS.renderer.vars.get('device.isMobile') ){

        $('#tooltips').addClass('mobile');

    }

    THEASYS.theme.modules.hotspots_tooltip.initialized = true;

    THEASYS.renderer.event.on('loadedOnce',function(){

        //THEASYS.theme.modules.hotspots_tooltip.applyCustomizations();

    });

    THEASYS.renderer.event.on('addHotspotTooltip',function(objId,text,type){

        THEASYS.theme.modules.hotspots_tooltip.createTooltip(objId,text);

    });

    THEASYS.renderer.event.on('panoramaPress',function(objId,top){

        THEASYS.theme.modules.hotspots_tooltip.show(objId,top);

    });

    THEASYS.renderer.event.on('panoramaMouseUp',function(event){

        THEASYS.theme.modules.hotspots_tooltip.hideAll();

    });

    THEASYS.renderer.event.on('hotspotIntersection',function(objId, event){

        var pos = THEASYS.renderer.getHotspotLocalPosition(objId,false);

        var options_hotspots_display_tooltips = THEASYS.renderer.vars.get('options.hotspots_display_tooltips');

        var device_isMobile = THEASYS.renderer.vars.get('device.isMobile');

        var objects_tooltip = THEASYS.renderer.vars.get('objects_tooltip');

        if( parseInt( options_hotspots_display_tooltips, 10) ){

            if( !device_isMobile ){

                if( objId in objects_tooltip && objects_tooltip[objId] && event ){

                    THEASYS.theme.modules.hotspots_tooltip.display(objId,event,pos);

                } else {

                }

            }

        }
    });

    THEASYS.renderer.event.on('noHotspotIntersection',function(){

        THEASYS.theme.modules.hotspots_tooltip.hideAll();

    });

};

THEASYS.theme.modules.hotspots_tooltip.display = function( objId, event, pos ){

    var elem = $('#tp_'+objId);

    var oXY = this.calcOffset(objId);

    var mode = parseInt(THEASYS.renderer.vars.get('options.hotspots_tooltips_m'),10);

    //if( mode === 1 ){

        //elem.css({top:pos.y + oXY.y,left:pos.x + oXY.x}).show().siblings().hide();

        //this.last_displayed = {objId:objId,top:pos.y,left:pos.x};

    //} else {

        elem.css({ left : event.offsetX + oXY.x, top : event.offsetY + oXY.y }).show().siblings().hide();

        this.last_displayed = {objId:objId,top:event.offsetY,left:event.offsetX};

    //}

};

THEASYS.theme.modules.hotspots_tooltip.displayLastDisplayed = function( ){

    if( this.last_displayed ){

        var elem = $('#tp_'+this.last_displayed.objId);

        var oXY = this.calcOffset(this.last_displayed.objId);

        elem.css({ left : this.last_displayed.left + oXY.x, top : this.last_displayed.top + oXY.y }).show();

    }

};

THEASYS.theme.modules.hotspots_tooltip.calcOffset = function( objId ){

    var elem = $('#tp_'+objId);

    var elemW = elem.outerWidth();

    var elemH = elem.outerHeight();

    var offsetX = parseInt(THEASYS.renderer.vars.get('options.hotspots_tooltips_ox'),10);

    var posX = parseInt(THEASYS.renderer.vars.get('options.hotspots_tooltips_posx'),10);

    var oX = 0;

    if( posX === 0 ){

        oX = -(elemW/2) + offsetX;

    } else if( posX === 1 ){

        oX = offsetX;

    } else if( posX === -1 ){

        oX = -elemW - offsetX;

    }

    var offsetY = parseInt(THEASYS.renderer.vars.get('options.hotspots_tooltips_oy'),10);

    var posY = parseInt(THEASYS.renderer.vars.get('options.hotspots_tooltips_posy'),10);

    var oY = 0;

    if( posY === 0 ){

        oY = -(elemH/2) + offsetY;

    } else if( posY === 1 ){

        oY = offsetY;

    } else if( posY === -1 ){

        oY = -elemH - offsetY;

    }

    return {x:oX,y:oY};

};

THEASYS.theme.modules.hotspots_tooltip.show = function( objId, top ){

    $('#tp_'+objId).css({top:top}).show();

};

THEASYS.theme.modules.hotspots_tooltip.createTooltip = function( objId, text ){

    if( !document.getElementById('tp_'+objId) ){

        var tdiv = document.createElement('div');

        tdiv.id = 'tp_'+objId;

        tdiv.innerHTML = text;

        var theDiv = document.getElementById("tooltips");

        theDiv.appendChild(tdiv);

        THEASYS.renderer.vars.set('objects_tooltip.'+objId,text);

    }

};

THEASYS.theme.modules.hotspots_tooltip.hideAll = function( ){

    $('#tooltips').children().hide();

};

THEASYS.theme.modules.hotspots_tooltip.listenToEdits = function( obj ){

    this.displayLastDisplayed();

    for( var k in obj ){

        switch( k ){

            case'hotspots_tooltips_oy':
            case'hotspots_tooltips_ox':
            case'hotspots_tooltips_posx':
            case'hotspots_tooltips_posy':
            case'hotspots_tooltips_m':

                THEASYS.renderer.vars.set('options.'+k,parseInt(obj[k],10));

            break;

            case'hotspots_tooltips_py':
            case'hotspots_tooltips_px':
            case'hotspots_tooltips_s':
            case'hotspots_tooltips_br':
            case'hotspots_tooltips_o':
            case'hotspots_tooltips_bc':
            case'hotspots_tooltips_tc':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.'+k,value);

                this.applyCustomizations();

            break;

        }

    }

};

THEASYS.theme.modules.hotspots_tooltip.applyCustomizations = function(){

    var options = THEASYS.renderer.vars.get('options');

    var style = '';

    if( 'hotspots_tooltips_bc' in options && 'hotspots_tooltips_o' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.hotspots_tooltips_bc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.hotspots_tooltips_o+')';

            style += '#tooltips div{background:'+rgba+'!important;}';

        }

    }

    if( 'hotspots_tooltips_tc' in options ){

        style += '#tooltips div{color: '+options.hotspots_tooltips_tc+'!important;}';

    }

    if( 'hotspots_tooltips_br' in options ){

        style += '#tooltips div{border-radius: '+options.hotspots_tooltips_br+'%!important;}';

    }

    if( 'hotspots_tooltips_s' in options ){

        style += '#tooltips div{font-size: '+options.hotspots_tooltips_s+'px!important;}';

    }


    if( 'hotspots_tooltips_px' in options ){

        style += '#tooltips div{padding-left: '+options.hotspots_tooltips_px+'px;padding-right: '+options.hotspots_tooltips_px+'px;}';

    }

    if( 'hotspots_tooltips_py' in options ){

        style += '#tooltips div{padding-top: '+options.hotspots_tooltips_py+'px;padding-bottom: '+options.hotspots_tooltips_py+'px;}';

    }

    $('#hotspots_tooltips_styles').html(style);

};