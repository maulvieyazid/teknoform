/*
 *  Name : Maps
 *  Description : Displays google maps and / or custom maps
 *  Version : 0.0.3
*/

THEASYS.theme.autoLoadFunction('maps','init');

THEASYS.theme.modules.maps.initialized = 0;

THEASYS.theme.modules.maps.guiCreated = 0;

THEASYS.theme.modules.maps.map_gui_mode = 0;

THEASYS.theme.modules.maps.customMapPosition = {0:{x:0,y:0,scale:1}};

THEASYS.theme.modules.maps.customMarkerZoom = 2;

THEASYS.theme.modules.maps.init = function( ){

    var html = `
        <div id="map-wrapper" class="noselect">
            <div id="map">
            </div>
        </div>
    `;

    THEASYS.theme.prependHtml(html);

    $('head').append('<style id="maps_styles" rel="stylesheet" type="text/css"></style>');

    this.applyCustomizations();

    if( this.guiCreated ){

        return false;

    }

    var map_status = this.check_to_see_if_we_have_map();

    THEASYS.renderer.vars.set('hasMap',map_status);

    var custom_map_status = 0;

    var options = THEASYS.renderer.vars.get('options');

    if( 'maps_custom_position' in options && options.maps_custom_position ){

        this.customMapPosition = JSON.parse(options.maps_custom_position);

    }

    if( 'maps_custom_marker_z' in options && ~~options.maps_custom_marker_z ){

        this.customMarkerZoom = ~~options.maps_custom_marker_z;

    }

    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

    if( 'tour' in THEASYS.cache.obj.tours[tour_rnd] && !THEASYS.fn.is_empty(THEASYS.cache.obj.tours[tour_rnd].tour) ){

        if( ( 'floorplan' in THEASYS.cache.obj.tours[tour_rnd].tour ) && THEASYS.cache.obj.tours[tour_rnd].tour.floorplan ){

            custom_map_status = 1;

        }

        if( !parseInt( options.maps_custom_show, 10 ) ){

            custom_map_status = 0;

        }

    }

    if( map_status === 1 && custom_map_status === 0 ){

        this.map_gui_mode = 1;

    } else if( map_status === 0 && custom_map_status === 1 ){

        this.map_gui_mode = 2;

    } else if( map_status === 1 && custom_map_status === 1 ){

        this.map_gui_mode = 3;

    }

    if( this.map_gui_mode ){

        var viewer_wrapper = $('#viewer_wrapper');
        var viewer = $('#viewer');

        var map_icon = `
<svg version="1.1" viewBox="0 0 512 512">
  <g>
    <path d="m429.2,82.8c-46.2-46.3-107.8-71.8-173.2-71.8s-127,25.5-173.2,71.8-71.8,107.8-71.8,173.2 25.5,127 71.8,173.2 107.8,71.8 173.2,71.8 127-25.5 173.2-71.8 71.8-107.8 71.8-173.2-25.5-127-71.8-173.2zm49.6,162.2h-95c-0.9-37.8-6.2-74.2-15.5-106.5 18.1-9.3 35-21 50.5-34.8 35,37.4 57.3,86.8 60,141.3zm-211.8,22h94.9c-0.8,34.8-5.6,68.1-13.9,97.9-25.6-10.3-52.9-16.3-81-17.6v-80.3zm136-178.6c-12.8,11.3-26.8,20.9-41.6,28.9-3.8-10.6-8.1-20.6-12.9-30-9.5-18.8-20.3-34.2-32.2-46 32.5,9.1 62,25.4 86.7,47.1zm-136-52c22.9,5.1 44.5,26.2 61.9,60.6 4.7,9.3 8.9,19.2 12.6,29.7-23.5,9.7-48.6,15.4-74.5,16.7v-107zm81.1,111.4c8.2,29.6 12.9,62.7 13.7,97.3h-94.8v-79.6c28.2-1.3 55.5-7.4 81.1-17.7zm-103.1,97.2h-94.9c0.8-34.6 5.5-67.7 13.7-97.3 25.6,10.4 53,16.4 81.1,17.6v79.7zm.1-208.6v107c-25.9-1.3-51.1-7-74.5-16.7 3.7-10.5 7.9-20.4 12.6-29.7 17.4-34.4 39-55.5 61.9-60.6zm-49.3,4.9c-11.9,11.8-22.7,27.3-32.2,46-4.7,9.4-9,19.4-12.9,30-14.8-8-28.7-17.6-41.6-28.9 24.7-21.7 54.2-38 86.7-47.1zm-102.5,62.4c15.5,13.8 32.4,25.4 50.5,34.8-9.3,32.4-14.7,68.7-15.5,106.5h-95c2.7-54.5 25-103.9 60-141.3zm-60,163.3h95c0.9,38.1 6.3,74.6 15.7,107.1-18,9.3-34.9,20.8-50.3,34.6-35.3-37.5-57.7-87-60.4-141.7zm76.2,157c12.8-11.2 26.7-20.8 41.4-28.7 3.8,10.3 8,20.2 12.7,29.4 9.5,18.8 20.3,34.2 32.2,46.1-32.3-9.1-61.7-25.3-86.3-46.8zm135.6,51.6c-22.9-5.1-44.5-26.2-61.9-60.6-4.6-9.1-8.7-18.8-12.4-29.1 23.4-9.7 48.5-15.4 74.3-16.6v106.3zm-81-110.7c-8.3-29.8-13.1-63.1-13.9-97.9h94.9v80.3c-28.1,1.2-55.4,7.2-81,17.6zm103,110.7v-106.3c25.8,1.3 50.9,6.9 74.3,16.6-3.7,10.3-7.8,20-12.4,29.1-17.4,34.4-39,55.5-61.9,60.6zm49.3-4.9c11.9-11.8 22.7-27.3 32.2-46.1 4.7-9.2 8.9-19.1 12.7-29.4 14.7,7.9 28.6,17.5 41.4,28.7-24.6,21.6-54,37.8-86.3,46.8zm102.2-62c-15.4-13.7-32.3-25.3-50.3-34.6 9.4-32.5 14.8-69.1 15.7-107.1h95c-2.8,54.7-25.2,104.2-60.4,141.7z"/>
  </g>
</svg>
        `;

        var html = '<div id="map_button_wrapper"><span data-tooltip="Toggle Map" class="map"><span class="icon_map">'+map_icon+'</span></span></div>';

        viewer_wrapper.append(html);

        if( this.map_gui_mode === 3 ){

            var html = '  <div class="flex-container">';
            html += '   <div id="map_geo-wrapper" class="flex-item"></div>';
            html += '   <div id="map_resizer-wrapper" class="flex-item"></div>';
            html += '   <div id="map_custom-wrapper" class="flex-item">';
            html += '     <div id="map_custom-img-wrapper" style="height:100%">';

            html += '     <img src="" id="floorplan-img" alt="Map Custom Image" />';
            html += '     </div>';
            html += '     <div id="floorplan-img-pins"></div>';
            html += '     <div id="floorplan-radar" data-panorama="0"></div>';

            html += '   </div>';
            html += '  </div>';

            $('#map').html(html);

            var h = ( $(window).height() / 2 ) - ( $('#map_resizer-wrapper').height() / 2 );

            $('#map_geo-wrapper').css({height: h });
            $('#map_custom-wrapper').css({height: h });

            this.loadGeoMap();

            $('#map_resizer-wrapper').draggable({

                axis: "y",
                containment: "#map",
                drag: function( event, ui ) {

                    $('#map_geo-wrapper').css({ height: ui.offset.top });

                    //var map_height = $('#map').height();
                    var map_height = $(window).height();

                    var resizer_height = $('#map_resizer-wrapper').height();

                    $('#map_custom-wrapper').css({ height: ( map_height - ui.offset.top ) - resizer_height });

                    if( THEASYS.theme.modules.maps.map.loaded ){

                        var center = THEASYS.theme.modules.maps.map.map.getCenter();
                        google.maps.event.trigger(THEASYS.theme.modules.maps.map.map, "resize");
                        THEASYS.theme.modules.maps.map.map.setCenter(center);

                        THEASYS.theme.modules.maps.map.resize();

                    }

                    THEASYS.theme.modules.maps.customMap.adjustImage();
                    THEASYS.theme.modules.maps.customMap.adjustCustomMapPins();

                },

            });

        } else if( this.map_gui_mode === 1 ){

            var html = '  <div class="flex-container">';
               html += '   <div id="map_geo-wrapper" class="flex-item"></div>';
               html += '  </div>';

            $('#map').html(html);

            var h = $(window).height();

            $('#map_geo-wrapper').css({height: h });

            this.loadGeoMap();

        } else if( this.map_gui_mode === 2 ){

            var html = '  <div class="flex-container">';
            html += '   <div id="map_custom-wrapper" class="flex-item">';
            html += '     <div id="map_custom-img-wrapper" style="height:100%">';
            html += '       <img src="" id="floorplan-img" alt="Map Custom Image" />';
            html += '     </div>';
            html += '     <div id="floorplan-img-pins" class=""></div>';
            html += '     <div id="floorplan-radar" data-panorama="0"></div>';
            html += '   </div>';
            html += '  </div>';

            $('#map').html(html);

            var h = $(window).height();

            $('#map_geo-wrapper').css({height: h });

        }

        this.guiCreated = 1;

        if( this.map_gui_mode > 0 ){

            this.loadMapButton(map_status);

        }

    }

    THEASYS.renderer.event.on('fovChange',function(){

        THEASYS.theme.modules.maps.onFovChange();

    });

    THEASYS.renderer.event.on('processPanoramaAfter',function(action){

        var loadedOnce = THEASYS.renderer.vars.get('loadedOnce');

        if( loadedOnce ){

            //THEASYS.theme.modules.maps.init();
            THEASYS.theme.modules.maps.createMapRadar(action);

        }

    });

    THEASYS.renderer.event.on('panoramaToScene',function(action){

        var loadedOnce = THEASYS.renderer.vars.get('loadedOnce');

        if( loadedOnce ){

            THEASYS.theme.modules.maps.customMap.setCustomMapRadar(action);

        }

    });

    THEASYS.renderer.event.on('toggleVr',function( vr ){

        var isMobile = THEASYS.renderer.vars.get('device.isMobile');

        if( vr ){

            if( isMobile ){

                $('#map_button_wrapper').addClass('hidden');

                THEASYS.theme.modules.maps.toogle(1);

            }

        } else {

            if( isMobile ){

                $('#map_button_wrapper').removeClass('hidden');

            }

        }

    });

    THEASYS.renderer.event.sendOn('resize',function(){

        //return [ 'maps' , $('#map-wrapper').outerWidth() || 0 ];
        return $('#map-wrapper').outerWidth();
        //return { maps : $('#map-wrapper').outerWidth() || 0 };

    });

    THEASYS.renderer.event.on('resize',function(){

        if( THEASYS.theme.modules.maps.map_gui_mode === 1 ){

            var window_height = $(window).height();

            $('#map_geo-wrapper').css({height: window_height });

        }

        if( THEASYS.theme.modules.maps.map_gui_mode === 2 ){

            var window_height = $(window).height();

            $('#map_custom-wrapper').css({height: window_height });

        }

        if( THEASYS.theme.modules.maps.map_gui_mode === 3 ){

            $('#map_custom-img-wrapper').height($('#map').height());

            var window_height = $(window).height();
            var map_height = $('#map_geo-wrapper').height();
            var resizer_height = $('#map_resizer-wrapper').height();

            $('#map_custom-wrapper').css({height: window_height - ( map_height + resizer_height )  });

        }

        if( THEASYS.theme.modules.maps.map_gui_mode ){

            var map_button_wrapper = $('#map_button_wrapper');

            map_button_wrapper.css({

              top: ( $(window).height() - map_button_wrapper.outerHeight() ) / 2 ,

            });

        }

    });

    THEASYS.renderer.event.on('gyroscope',function( state ){

        if( !state ){

            THEASYS.theme.modules.maps.rotateCustomMapRadar();

            THEASYS.theme.modules.maps.setMapRadarOrientation();

        }

    });

    THEASYS.renderer.event.on('userMovePanorama',function( w ){

        if( w === 'in' || w === 'out' ){

            THEASYS.theme.modules.maps.setRadarMarkerWidth();

        }

    });

    THEASYS.renderer.event.on('goTo',function( ){

        THEASYS.theme.modules.maps.rotateCustomMapRadar();

    });

    THEASYS.renderer.event.on('render',function( ){

        var device = THEASYS.renderer.vars.get('device');
        var controls = THEASYS.renderer.vars.get('controls');

        if( device.isMobile && !THEASYS.fn.is_empty(controls) ){

            var dlon = 180 + controls.update();

            THEASYS.theme.modules.maps.rotateCustomMapRadar(dlon);

            THEASYS.theme.modules.maps.setRadarOrientation(dlon);

        }

    });

    this.initialized = true;

    if( map_status === 1 || custom_map_status === 1 ){

        if( ~~options.maps_opended ){

            //map_button_wrapper.find('.map').trigger('click');

            THEASYS.theme.modules.maps.toogle(false);

            THEASYS.theme.modules.maps.map.resize();

        }

    }

};

THEASYS.theme.modules.maps.listenToEdits = function( obj ){

    for( var k in obj ){

        switch( k ){

            case'maps_close_on_actions':

                THEASYS.renderer.vars.set('options.maps_close_on_actions',+obj[k]);

            break;

            case'maps_geo_markers_show_panorama_title_on_hover':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.maps_geo_markers_show_panorama_title_on_hover',value);

                if( value ){

                    this.map.toggleMarkerTitles(1);

                } else {

                    this.map.toggleMarkerTitles(0);

                }

            break;

            case'maps_custom_markers_show_panorama_title_on_hover':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.maps_custom_markers_show_panorama_title_on_hover',value);

                if( value ){

                    this.customMap.customMapPinsTitles(1);

                } else {

                    this.customMap.customMapPinsTitles(0);

                }

            break;

            case'maps_custom_radar':

                var value = +obj[k];

                THEASYS.renderer.vars.set('options.maps_custom_radar',value);

                this.customMap.adjustCustomMapPins();

                this.customMap.rotateCustomMapRadar();

            break;

            case'maps_bc':
            case'maps_tobc':
            case'maps_totc':
            case'maps_tobo':
            case'maps_toboa':
            case'maps_tobr':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.'+k,value);

                this.applyCustomizations();

            break;

            case'maps_custom_radar_c':
            case'maps_custom_radar_o':
            case'maps_custom_radar_s':

            case'maps_custom_marker_o':
            case'maps_custom_marker_c':
            case'maps_custom_marker_z':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.'+k,value);

                if( k === 'maps_custom_marker_z' ){

                    this.customMap.adjustMarkerSize(value);

                }

                if( k === 'maps_custom_radar_s' ){

                    this.customMap.rotateCustomMapRadar();

                }

                if( k === 'maps_custom_radar_c' || k === 'maps_custom_radar_o' ){

                    this.customMap.createRadarElem();

                }

                this.applyCustomizations();

            break;

            case'maps_marker_o':
            case'maps_marker_c':
            case'maps_marker_s':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.'+k,value);

                var fillColor = THEASYS.renderer.vars.get('options.maps_marker_c');
                var fillOpacity = THEASYS.renderer.vars.get('options.maps_marker_o');
                var scale = THEASYS.renderer.vars.get('options.maps_marker_s');

                this.map.updateMarkerIcon({

                    fillColor : fillColor,

                    fillOpacity : parseFloat(fillOpacity,10),

                    scale : parseInt(scale,10),

                });

            break;

            case'maps_radar_c':
            case'maps_radar_o':
            case'maps_radar_s':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.'+k,value);

                var fillColor = THEASYS.renderer.vars.get('options.maps_radar_c');
                var fillOpacity = THEASYS.renderer.vars.get('options.maps_radar_o');
                var scale = THEASYS.renderer.vars.get('options.maps_radar_s');

                this.map.updateRadarIcon({

                    fillColor : fillColor,

                    fillOpacity : parseFloat(fillOpacity,10),

                    //scale : parseInt(scale,10),

                });

            break;

            case'maps_cluster_c':
            case'maps_cluster_tc':
            case'maps_cluster_o':

                var value = obj[k];

                THEASYS.renderer.vars.set('options.'+k,value);

                var backgroundColor = THEASYS.renderer.vars.get('options.maps_cluster_c');
                var textColor = THEASYS.renderer.vars.get('options.maps_cluster_tc');
                var opacity = THEASYS.renderer.vars.get('options.maps_cluster_o');

                this.map.updateClusterIcon({

                    backgroundColor : backgroundColor,

                    textColor : textColor,

                    opacity : parseFloat(opacity,10),

                });

            break;

        }

    }

};

THEASYS.theme.modules.maps.toogle = function( state ){

    var map_button_wrapper = $('#map_button_wrapper');

    var map = $('#map');

    var map_wrapper = $('#map-wrapper');

    var jthis = map_button_wrapper.find('.map');

    if( state !== undefined  ){

    } else {

        state = jthis.hasClass('selected');

    }

    var device = THEASYS.renderer.vars.get('device');

    if( device.isMobile ){

        this.map.current_size.width = 150;

    }

    map.css({

        width : this.map.current_size.width,

    });

    if( state ) {

        jthis.removeClass('selected');

        jthis.parent().removeClass('selected');

        map_wrapper.css('width','0px');

        this.adjustViewer();

        var draggableInstance = map_button_wrapper.draggable( "instance" );

        if( draggableInstance ){

            map_button_wrapper.draggable( "option", "disabled", true );

        }

    } else {

        jthis.addClass('selected');

        jthis.parent().addClass('selected');

        var draggableInstance = map_button_wrapper.draggable( "instance" );

        if(draggableInstance){

            map_button_wrapper.draggable( "option", "disabled", false );

        }

        $('#map_custom-wrapper').css({width:'100%'});

        map.css('width',this.map.current_size.width+'px');

        map_wrapper.css('width',this.map.current_size.width+'px');

        this.adjustViewer();

        this.customMap.loadCustomMap(this.customMapPosition,this.customMarkerZoom);

        this.customMap.adjustCustomMapPins();

    }

}

THEASYS.theme.modules.maps.adjustViewer = function(w){

    var width = 0;

    var map_button_wrapper = $('#map_button_wrapper');

    if( w ){

        width = w;

    } else {

        if( map_button_wrapper.find('.map').hasClass('selected') ){

            map_button_wrapper.css({left:$(window).width() - this.map.current_size.width - map_button_wrapper.outerWidth()});

        } else {


            map_button_wrapper.css({left:$(window).width() - map_button_wrapper.outerWidth()});

        }

    }

    THEASYS.renderer.resize();

    this.customMap.adjustCustomMapPins();

    this.customMap.adjustImage();

};

THEASYS.theme.modules.maps.setRadarMarkerWidth = function(){

    this.map.setRadarMarkerWidth();

};

THEASYS.theme.modules.maps.mapAutoShrink = function(){

    this.map.auto_shrink();

};

THEASYS.theme.modules.maps.rotateCustomMapRadar = function(dlon){

    if( dlon ){

        this.customMap.rotateCustomMapRadar(dlon);

    } else {

        this.customMap.rotateCustomMapRadar();

    }

};

THEASYS.theme.modules.maps.setRadarOrientation = function(dlon){

    if( this.map && this.map.radar_markers['radar']){

        var angle = parseInt( dlon + this.map.radar_markers['radar'].orientation, 10 );

        this.map.setRadarOrientation(angle);

    }

};

THEASYS.theme.modules.maps.setMapRadarOrientation = function(){

    if( this.map && this.map.radar_markers['radar'] ){

        var lat = THEASYS.renderer.vars.get('lat');
        var lon = THEASYS.renderer.vars.get('lon');

        var xyz = THEASYS.fn.latLonToXYZ(parseFloat(lat,10),parseFloat(lon,10));

        var deg = THEASYS.fn.xyzToDeg(xyz.x,xyz.y,xyz.z);

        var angle = parseInt(deg+this.map.radar_markers['radar'].orientation,10);

        THEASYS.renderer.vars.set('current_orientation',angle);

        this.map.setRadarOrientation(angle);

    }

};

THEASYS.theme.modules.maps.onFovChange = function(){

    if( this.map && this.map.radar_markers['radar'] ){

        var lat = THEASYS.renderer.vars.get('lat');
        var lon = THEASYS.renderer.vars.get('lon');

        this.setRadarMarkerWidth();

        var latLon = THEASYS.fn.latLonToXYZ(parseFloat(lat,10),parseFloat(lon,10));

        var deg = THEASYS.fn.xyzToDeg(parseFloat(latLon.x,10),parseFloat(latLon.y,10),parseFloat(latLon.z,10));

        var angle = parseInt(deg+this.map.radar_markers['radar'].orientation,10);

        THEASYS.renderer.vars.set('current_orientation',angle);

        this.setRadarOrientation(angle);

    }

};


THEASYS.theme.modules.maps.createMapRadar = function(action){

    var hasMap = THEASYS.renderer.vars.get('hasMap');

    if( hasMap ) {

        var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');
        var id = THEASYS.renderer.vars.get('id');

        var lat = parseFloat( THEASYS.cache.obj.tours[tour_rnd].panoramas[id].latitude, 10 );
        var lng = parseFloat( THEASYS.cache.obj.tours[tour_rnd].panoramas[id].longitude, 10 );

        if( lat != 0 && lng != 0 ){

            var options_maps_geo_radar = THEASYS.renderer.vars.get('options.maps_geo_radar');

            if( ~~options_maps_geo_radar ){

                this.map.createRadarMarker( THEASYS.cache.obj.tours[tour_rnd].panoramas[id], action );

                THEASYS.renderer.event.on('updatePanoramaPosition',function(){

                    var current_position = THEASYS.renderer.vars.get('current_position');

                    var deg = THEASYS.fn.xyzToDeg(current_position.x,current_position.y,current_position.z);

                    var angle = parseInt(deg + THEASYS.theme.modules.maps.map.radar_markers['radar'].orientation,10);

                    THEASYS.renderer.vars.set('current_orientation', angle);

                    THEASYS.theme.modules.maps.map.setRadarOrientation(angle);

                });

            } else {

            }

        } else {

            THEASYS.fn.map.markers.removeAll( this.map.radar_markers );

        }

    }

};

THEASYS.theme.modules.maps.loadGeoMap = function(){

    var options = THEASYS.renderer.vars.get('options');
    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

    var atLeastOnePanoramaLat = 0;
    var atLeastOnePanoramaLng = 0;

    if(

    'tours' in THEASYS.cache.obj
    && THEASYS.cache.obj.tours
    && tour_rnd in THEASYS.cache.obj.tours
    && THEASYS.cache.obj.tours[tour_rnd]
    && 'tour' in THEASYS.cache.obj.tours[tour_rnd]
    && THEASYS.cache.obj.tours[tour_rnd].tour
    && 'panoramas' in THEASYS.cache.obj.tours[tour_rnd].tour

    ){

        for( var i in THEASYS.cache.obj.tours[tour_rnd].tour['panoramas'] ){

            var lat = parseFloat(THEASYS.cache.obj.tours[tour_rnd].tour['panoramas'][i].lat,10);
            var lng = parseFloat(THEASYS.cache.obj.tours[tour_rnd].tour['panoramas'][i].lng,10);

            if( lat != 0 && lng != 0 ){

                var hasGPSAtLeastOnePanorama = parseInt(THEASYS.renderer.vars.get('hasGPSAtLeastOnePanorama'),10);

                hasGPSAtLeastOnePanorama++

                THEASYS.renderer.vars.set('hasGPSAtLeastOnePanorama',hasGPSAtLeastOnePanorama);

                //_vars.hasGPSAtLeastOnePanorama++;

                atLeastOnePanoramaLat = lat;
                atLeastOnePanoramaLng = lng;

            }

        }

    }

    var obj = THEASYS.renderer.vars.get('obj');

    if( !this.map.loaded && obj ){

        var lat = parseFloat(obj.latitude,10);
        var lng = parseFloat(obj.longitude,10);
        var zoom = 10;

        if( lat == 0 || lng == 0 ){

            var lat = parseFloat(obj.tour_map_latitude,10);
            var lng = parseFloat(obj.tour_map_longitude,10);

            var zoom = parseInt(obj.tour_map_zoom,10);

            if( lat == 0 || lng == 0 ){

                lat = atLeastOnePanoramaLat;
                lng = atLeastOnePanoramaLng;

            }

            if( lat == 0 || lng == 0 ){

                return false;

            }

        }

        var nLatlng = new google.maps.LatLng(lat, lng);

        this.map.init('map_geo-wrapper',nLatlng,zoom,function(){

            var hasGPSAtLeastOnePanorama = THEASYS.renderer.vars.get('hasGPSAtLeastOnePanorama');

            if( !hasGPSAtLeastOnePanorama ){

                THEASYS.theme.modules.maps.map.createTourMarker(lat, lng);

            }

            var action_view = THEASYS.renderer.vars.get('action_view');

            THEASYS.theme.modules.maps.createMapRadar(action_view);

            THEASYS.theme.modules.maps.map.loaded = true;

        });

    }

  };

THEASYS.theme.modules.maps.loadMapButton = function(map_status){

    var map_button_wrapper = $('#map_button_wrapper');
    var map = $('#map');
    var map_wrapper = $('#map-wrapper');

    var map_button_wrapper_is_dragging = false;

    map_button_wrapper.css({

        top: ( $(window).height() - map_button_wrapper.outerHeight() ) / 2 ,
        right: 0,
        display : 'block'

    });

    map_button_wrapper.on('click','.map',function(){

        if( map_button_wrapper_is_dragging ){

            map_button_wrapper_is_dragging = false;
            return false;

        }

        THEASYS.theme.modules.maps.toogle();

        if(map_status){

            THEASYS.theme.modules.maps.map.resize();

        }

    });

    var options = THEASYS.renderer.vars.get('options');

    var editing = THEASYS.renderer.vars.get('editing');

    var viewer = $('#viewer');

    if( editing ){

        viewer.on('click',function(){

            if( ~~options.maps_close_on_actions && map_button_wrapper.hasClass('selected') ){

                map_button_wrapper.find('.map').trigger('click');

            }

        });

    } else {

      if( ~~options.maps_close_on_actions ){

            viewer.on('click',function(){

                if( map_button_wrapper.hasClass('selected') ){

                    map_button_wrapper.find('.map').trigger('click');

                }

            });

        }

    }

    map_button_wrapper.draggable({

        axis: "x",
        containment: "body",

        start: function( event, ui ) {

            if( !THEASYS.theme.modules.maps.customMap.floorPlanLoaded ){

                THEASYS.theme.modules.maps.customMap.loadCustomMap(THEASYS.theme.modules.maps.customMapPosition,THEASYS.theme.modules.maps.customMarkerZoom);

            }

        },

        drag: function( event, ui ) {

            var width = $(window).width() - ui.position.left - $(this).outerWidth();

            map_button_wrapper_is_dragging = true;

            map.css({'width':width});
            map_wrapper.css({'width':width});

            if( THEASYS.theme.modules.maps.map.loaded ){

              var center = THEASYS.theme.modules.maps.map.map.getCenter();
              google.maps.event.trigger(THEASYS.theme.modules.maps.map.map, "resize");
              THEASYS.theme.modules.maps.map.map.setCenter(center);

              THEASYS.theme.modules.maps.map.resize();

            }

            THEASYS.theme.modules.maps.map.current_size.width = width;

            THEASYS.theme.modules.maps.customMap.adjustCustomMapPins();

            THEASYS.theme.modules.maps.adjustViewer();

        },

        stop: function( event, ui ) {

            window.setTimeout(function(){

                map_button_wrapper_is_dragging = false;

            },100);

        },

    });

};

THEASYS.theme.modules.maps.check_to_see_if_we_have_map = function(){

    var map_status = 0;

    var options = THEASYS.renderer.vars.get('options');
    var tour_rnd = THEASYS.renderer.vars.get('tour_rnd');

    if( 'tour' in THEASYS.cache.obj.tours[tour_rnd] && !THEASYS.fn.is_empty(THEASYS.cache.obj.tours[tour_rnd].tour) ){

        if( ( 'map_latitude' in THEASYS.cache.obj.tours[tour_rnd].tour && THEASYS.cache.obj.tours[tour_rnd].tour.map_latitude != 0 ) && ( 'map_longitude' in THEASYS.cache.obj.tours[tour_rnd].tour && THEASYS.cache.obj.tours[tour_rnd].tour.map_longitude != 0 ) ){

            map_status = 1;

        }

    }

    if( !map_status ){

        if( 'tour' in THEASYS.cache.obj.tours[tour_rnd] && !THEASYS.fn.is_empty(THEASYS.cache.obj.tours[tour_rnd].tour) ){

            if( 'panoramas' in THEASYS.cache.obj.tours[tour_rnd].tour && THEASYS.cache.obj.tours[tour_rnd].tour.panoramas.length > 0 ){

                for( var i = 0, l = THEASYS.cache.obj.tours[tour_rnd].tour.panoramas.length; i< l; i++ ){

                    if( THEASYS.cache.obj.tours[tour_rnd].tour.panoramas[i].lat != 0 && THEASYS.cache.obj.tours[tour_rnd].tour.panoramas[i].lng != 0 ){

                        map_status = 1;

                        break;

                    }

                }

            }

        }

    }

    if( map_status ){

        if( !parseInt( options.maps_geo_show, 10 ) ){

            map_status = 0;

        }

    }

    return map_status;

};

THEASYS.theme.modules.maps.applyCustomizations = function(){

    var options = THEASYS.renderer.vars.get('options');

    if( 'maps_marker_c' in options ){

        this.map.marker_icon.fillColor = options.maps_marker_c;

    }

    if( 'maps_marker_o' in options ){

        this.map.marker_icon.fillOpacity = parseFloat(options.maps_marker_o,10);

    }

    if( 'maps_marker_s' in options ){

        this.map.marker_icon.scale = parseInt(options.maps_marker_s,10);

    }

    if( 'maps_radar_c' in options ){

        this.map.radar_icon.fillColor = options.maps_radar_c;

    }

    if( 'maps_radar_o' in options ){

        this.map.radar_icon.fillOpacity = parseFloat(options.maps_radar_o,10);

    }

    if( 'maps_cluster_o' in options ){

        this.map.cluster_icon.opacity = parseFloat(options.maps_cluster_o,10);

    }

    if( 'maps_cluster_c' in options ){

        this.map.cluster_icon.backgroundColor = options.maps_cluster_c;

    }

    if( 'maps_cluster_tc' in options ){

        this.map.cluster_icon.textColor = options.maps_cluster_tc;

    }

    var style = '';

    if( 'maps_bc' in options ){

        style += '#map_custom-wrapper {background:'+options.maps_bc+'!important;}';

    }

    //toogle

    if( 'maps_tobc' in options && 'maps_tobo' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.maps_tobc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.maps_tobo+')';

            style += '#map_button_wrapper{background:'+rgba+'!important;}';

        }

    }

    if( 'maps_tobc' in options && 'maps_toboa' in options ){

        var rgb = THEASYS.fn.hexToRgb(options.maps_tobc);

        if ( rgb ){

            var rgba = 'rgba('+rgb.r+','+rgb.g+','+rgb.b+','+options.maps_toboa+')';

            style += '#map_button_wrapper:hover, #map_button_wrapper.selected{background:'+rgba+'!important;}';

        }

    }

    if( 'maps_totc' in options ){

        style += '#map_button_wrapper .icon_map svg path{fill: '+options.maps_totc+'!important;}';

    }

    if( 'maps_tobr' in options ){

        style += '#map_button_wrapper{border-radius: '+options.maps_tobr+'px 0 0 '+options.maps_tobr+'px!important;}';

    }

    if( 'maps_custom_marker_z' in options ){

        style += '#floorplan-img-pins span svg{width: '+(7 + (options.maps_custom_marker_z * 10))+'px!important; height: '+(19 + (options.maps_custom_marker_z * 10))+'px!important;}';

    }

    if( 'maps_custom_marker_c' in options ){

        style += '#floorplan-img-pins span svg{fill: '+options.maps_custom_marker_c+'!important;}';

    }

    if( 'maps_custom_marker_o' in options ){

        style += '#floorplan-img-pins span svg{opacity: '+options.maps_custom_marker_o+'!important;}';

    }


    $('#maps_styles').html(style);

};