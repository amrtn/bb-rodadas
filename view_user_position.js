/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


var map;
load();
function load(path) {
    if (GBrowserIsCompatible()) {
        var lat = document.getElementById('lblLat').value;
        var lng = document.getElementById('lblLong').value;
        map = new GMap2(document.getElementById('map_position'));
        map.enableScrollWheelZoom();
        map.addControl(new GLargeMapControl());
        map.addControl(new GMapTypeControl());
        var centre = new GLatLng(lat, lng);
        map.setCenter(centre, 5);
        map.addOverlay(new GMarker(centre));
    }
}

function AjaxMap()
{
        var xmlhttp=false;
        try
        {
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
                try
                {
                        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                } catch (E) {
                        xmlhttp = false;
                }
        }

        if (!xmlhttp && typeof XMLHttpRequest!='undefined')
        {
                xmlhttp = new XMLHttpRequest();
        }
        return xmlhttp;
}
