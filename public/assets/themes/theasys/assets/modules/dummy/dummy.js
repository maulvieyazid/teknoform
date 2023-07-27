/*
 *  Name : Dummy
 *  Description : This is a dummy module, just for example.
 *  Author : John Barounis
 *  Version : 0.0.1
*/

//Which function to auto load when tour has loaded once.
THEASYS.theme.autoLoadFunction('dummy','init');

//A boolean variable so to see if module has been initialized.
THEASYS.theme.modules.dummy.initialized = false;

//Main function init
THEASYS.theme.modules.dummy.init = function( ){

    //Make the initialize to true so to know that init function run.
    THEASYS.theme.modules.dummy.initialized = true;

};

//This function is used from Theasys api to allow theme to interact from external sources.
THEASYS.theme.modules.dummy.api = function( action, key, value ){

    if( key === 'dummy' ){

        switch( action ){

            case'set':

            break;

        }

    }

};

//This function is used from Theasys dashboard page so to make changes on the fly.
THEASYS.theme.modules.dummy.listenToEdits = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'':

            break;

        }

    }

};
