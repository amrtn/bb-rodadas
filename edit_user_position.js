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
        GEvent.addListener(map, "click", mapClickFunc);
        var centre = new GLatLng(lat, lng);
        map.setCenter(centre, 5);
        map.addOverlay(new GMarker(centre));
    }
}

function mapClickFunc(marker, point) {
    document.getElementById('lblLat').value = point.lat().toFixed(5);
    document.getElementById('lblLong').value = point.lng().toFixed(5);
    map.clearOverlays();
    map.addOverlay(new GMarker(point));
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

function submitClick(path) {
    var lat = document.getElementById("lblLat").value;
    var lon = document.getElementById("lblLong").value;
    var user = document.getElementById("uid") .value;
    var url = path+"/ajax/process_position.php?uid="+user+"&lat="+lat+"&lon="+lon;
    var target = document.getElementById("map_position_result");
    target.innerHTML = "<div id='map_loading'><img src='"+path+"/assets/ajax-loader.gif'/></div>"
    var ajax = AjaxMap();
    ajax.open("GET",url,true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
            target.innerHTML = ajax.responseText;
        }
    }
    ajax.send('')
}



