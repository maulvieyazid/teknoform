/*
 *  Name : Automations
 *  Description : Handles automations
 *  Version : 0.0.3
*/

THEASYS.theme.modules.automations.initialized = false;

THEASYS.theme.modules.automations.timeout = false;

THEASYS.theme.modules.automations.status = 'end';

THEASYS.theme.modules.automations.obj = null;

THEASYS.theme.modules.automations.init = function( ){

    var html = `
    <div id="automation_lock_viewer">
        <div id="automation_play" class="hidden" title="Play Automation">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 477.886 477.886">
                <path d="M476.091,231.332c-1.654-3.318-4.343-6.008-7.662-7.662L24.695,1.804C16.264-2.41,6.013,1.01,1.8,9.442
                    c-1.185,2.371-1.801,4.986-1.8,7.637v443.733c-0.004,9.426,7.633,17.07,17.059,17.075c2.651,0.001,5.266-0.615,7.637-1.8
                    L468.429,254.22C476.865,250.015,480.295,239.768,476.091,231.332z M34.133,433.198V44.692l388.506,194.253L34.133,433.198z"/>
            </svg>
        </div>
        <div id="automation_next" title="Next Automation">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 792.033 792.033">
                <path d="M617.858,370.896L221.513,9.705c-13.006-12.94-34.099-12.94-47.105,0c-13.006,12.939-13.006,33.934,0,46.874
                    l372.447,339.438L174.441,735.454c-13.006,12.94-13.006,33.935,0,46.874s34.099,12.939,47.104,0l396.346-361.191
                    c6.932-6.898,9.904-16.043,9.441-25.087C627.763,386.972,624.792,377.828,617.858,370.896z"/>
            </svg>
        </div>
        <div id="automation_stop" title="End Automation">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001">
                <path d="M284.286,256.002L506.143,34.144c7.811-7.811,7.811-20.475,0-28.285c-7.811-7.81-20.475-7.811-28.285,0L256,227.717
                    L34.143,5.859c-7.811-7.811-20.475-7.811-28.285,0c-7.81,7.811-7.811,20.475,0,28.285l221.857,221.857L5.858,477.859
                    c-7.811,7.811-7.811,20.475,0,28.285c3.905,3.905,9.024,5.857,14.143,5.857c5.119,0,10.237-1.952,14.143-5.857L256,284.287
                    l221.857,221.857c3.905,3.905,9.024,5.857,14.143,5.857s10.237-1.952,14.143-5.857c7.811-7.811,7.811-20.475,0-28.285
                    L284.286,256.002z"/>
            </svg>
        </div>
    </div>
    `;

    THEASYS.theme.prependHtml(html);

    this.initialized = true;

    THEASYS.renderer.event.on('userAction',function( ){

        //console.log('userAction');

    });

    THEASYS.renderer.event.on('userGlobalAction',function( ){

        if( THEASYS.theme.modules.automations.obj ){

            if( 's' in THEASYS.theme.modules.automations.obj ){

                if( 'sua' in THEASYS.theme.modules.automations.obj.s ){

                    if( ~~THEASYS.theme.modules.automations.obj.s.sua ){

                        THEASYS.theme.modules.automations.end();

                    }

                }
            }
        }

    });

    THEASYS.renderer.event.on('automation_set',function( obj ){

        THEASYS.theme.modules.automations.obj = obj;

        if( !~~obj.s.dsb ){

            $('#automation_stop').addClass('hidden');

        }

    });

    THEASYS.renderer.event.on('automation_start',function( ){

        THEASYS.theme.modules.automations.status = 'start';

        $('#automation_next').addClass('disabled');

    });

    THEASYS.renderer.event.on('automation_item_complete',function( ){

        $('#automation_next').removeClass('disabled');

    });

    THEASYS.renderer.event.on('automation_end',function( ){

        THEASYS.theme.modules.automations.status = 'end';

        THEASYS.theme.modules.automations.lock_viewer_hide();

    });

    THEASYS.renderer.event.on('automation_running',function( ){

        THEASYS.theme.modules.automations.status = 'running';

    });


    THEASYS.renderer.event.on('automation_lock_viewer_show',function( mode ){

        if( mode === 'a' ){

            $('#automation_next').addClass('hidden');

        }

        THEASYS.theme.modules.automations.lock_viewer_show();

    });

    THEASYS.renderer.event.on('automation_lock_viewer_hide',function( state ){

        THEASYS.theme.modules.automations.lock_viewer_hide();

    });

    $('#automation_lock_viewer').on('mousemove',function(){

        //if( THEASYS.theme.modules.automations.status === 'running' ){

            $(this).css({opacity:0.7});

            if (THEASYS.theme.modules.automations.timeout !== undefined) {

                window.clearTimeout(THEASYS.theme.modules.automations.timeout);

            }

            THEASYS.theme.modules.automations.timeout = window.setTimeout(function () {

                $('#automation_lock_viewer').css({opacity:0});

            }, 1000);

        //}

    });

    $('#automation_stop').on('click',function(){

        THEASYS.theme.modules.automations.end();

    });

    $('#automation_next').on('click',function(){

        THEASYS.theme.modules.automations.next();

    });

};

THEASYS.theme.modules.automations.lock_viewer_show = function(){

    if( this.initialized ){

        $('#automation_lock_viewer').show();

    }

};

THEASYS.theme.modules.automations.lock_viewer_hide = function(){

    if( this.initialized ){

        $('#automation_lock_viewer').hide();

    }

};

THEASYS.theme.modules.automations.end = function(){

    if( this.initialized ){

        THEASYS.renderer.automations.end(true);

    }

};

THEASYS.theme.modules.automations.start = function(){

    if( this.initialized ){

        THEASYS.renderer.automations.start();

    }

};

THEASYS.theme.modules.automations.set = function( str ){

    if( this.initialized ){

        THEASYS.renderer.automations.set( str );

    }

};

THEASYS.theme.modules.automations.next = function(){

    if( this.initialized ){

        THEASYS.renderer.automations.next();

    }

};