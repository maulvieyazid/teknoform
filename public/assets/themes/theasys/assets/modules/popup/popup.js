/*
 *  Name : Popup
 *  Description : Handles popups
 *  Version : 0.0.3
*/

//THEASYS.theme.autoLoadFunction('popup','init');

THEASYS.theme.modules.popup.initialized = false;

THEASYS.theme.modules.popup.init = function( ){

    this.initialized = true;

};

THEASYS.theme.modules.popup.close = function( ){

    if( this.initialized ){

        if( typeof $.fancybox !== 'undefined') {

            $.fancybox.close();

        }

    }

};

THEASYS.theme.modules.popup.closeAll = function( ){

    if( this.initialized ){

        if( typeof $.fancybox !== 'undefined') {

            $.fancybox.close(true);

        }

    }

};

THEASYS.theme.modules.popup.update = function( ){

    if( this.initialized ){

        if( typeof $.fancybox !== 'undefined') {

            var instance = $.fancybox.getInstance();

            if( instance ){

                instance.update();

            }

        }

    }

};

THEASYS.theme.modules.popup.next = function( ){

    if( this.initialized ){

        if( typeof $.fancybox !== 'undefined') {

            var instance = $.fancybox.getInstance();

            if( instance ){

                instance.next();

            }

        }

    }

};

THEASYS.theme.modules.popup.previous = function( ){

    if( this.initialized ){

        if( typeof $.fancybox !== 'undefined') {

            var instance = $.fancybox.getInstance();

            if( instance ){

                instance.previous();

            }

        }

    }

};