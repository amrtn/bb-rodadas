/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var map;
function loadFullUserMap(path,lat,lng,zoom) {
    if (GBrowserIsCompatible()) {

        map = new GMap2(document.getElementById('fullusermap'));
        map.enableScrollWheelZoom();
        map.addControl(new GLargeMapControl());
        map.addControl(new GMapTypeControl());
        var centre = new GLatLng(lat, lng);
        map.setCenter(centre, zoom);
        getPositionData(path,map);
        
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

function getPositionData(path,map) {
    var result = [];
    var url = path+"/ajax/users_position_json.php";
    var target = document.getElementById("map_position_result");
    var ajax = AjaxMap();
    ajax.open("GET",url,true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.onreadystatechange=function() {
        if (ajax.readyState==4) {
            result = eval(ajax.responseText);
            loadUserMarkers(result,map);
        }
    }
    ajax.send('')
}


function loadUserMarkers(data,map) {
    
    var markers = [];
    for (i=0; i<data.length; i++){
        var marker = createMarker(data[i].lat, data[i].lon, data[i].info_html)
        markers.push(marker);
    }
    var markerCluster = MarkerClusterer(map, markers);
}

function createMarker(lat, lon, html){
    var icon = new GIcon(G_DEFAULT_ICON);
    var marker = new GMarker(new GLatLng(lat,lon),{icon: icon});
    GEvent.addListener(marker,'click',function(){
        marker.openInfoWindowHtml(decodeURI(html));
    });
    return marker;
}


