/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

var map;
jQuery(document).ready(function(){
    load();
    jQuery('form').submit(function(){
        submitClick();
    });
});

function load(path) {
    if (GBrowserIsCompatible()) {
        var lat = jQuery('#lblLat').val();
        var lng = jQuery('#lblLong').val();
        map = new GMap2(jQuery('#map_position').get(0));
        map.enableScrollWheelZoom();
        map.addControl(new GLargeMapControl());
        map.addControl(new GMapTypeControl());
        GEvent.addListener(map, "click", mapClickFunc);
        var centre = new GLatLng(lat, lng);
        map.setCenter(centre, 5);
        map.addOverlay(new GMarker(centre));
    }
}

function mapClickFunc(marker, point) {
    jQuery('#lblLat').val(point.lat().toFixed(5));
    jQuery('#lblLong').val(point.lng().toFixed(5));
    map.clearOverlays();
    map.addOverlay(new GMarker(point));
}



function submitClick() {
    var basepath = '../../bb-plugins/rodadas';
    var lat = jQuery('#lblLat').val();
    var lon = jQuery('#lblLong').val();
    var user = jQuery('#uid') .val();
    jQuery('#map_position_result').empty()
                            .append("<div id='map_loading'><img src='"+basepath+"/assets/ajax-loader.gif'/></div>");

    jQuery.ajax({
        'type': 'GET',
        'url': basepath+'/ajax/process_position.php' ,
        'data': {
            'uid': user, 
            'lat': lat,
            'lon': lon
        },
        'dataType': 'text',
        'success': function(data) {
            jQuery('#map_position_result').empty().append(data);
        }
    });
}



