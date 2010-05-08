<?php
define(POSITION_TABLE,"rod_userposition");


$user_position_path = bb_get_option('uri')."bb-plugins/rodadas";
function show_change_position_map($w,$h) {
    global $user, $user_position_path;

    // **  Control de Parámetros ** //

    // Altura y anchura del mapa configurable por parámetros GET 'w' y 'h'
    $map_width=$w;
    $map_height=$h;

    $latmap = 0;
    $longmap = 0;
    $latlong = get_user_position($user->ID);
    if ($latlong && count($latlong)) {
        $latmap = $latlong['lat'];
        $longmap = $latlong['lon'];
    }
    
    if (isset($lat) && isset($long)) {
        $latmap = $lat;
        $longmap = $long;
    }

    // Usuario
    $uid = $user->ID;


    ?>
    <style type="text/css">
        /* Mapped
        --------------------------------
        User location plugin with Google Maps */

        #user_location {background:#F6F6F6; padding:10px; margin:0px;}

        #map_position {margin:0px auto; clear:both;}

        #update_position {border:1px solid green;
                padding:2px;
                margin:10px 10% 0 0;
                text-transform:uppercase;
                font-size:10px;
                background:green;
                color:white;
                text-align:right;
                float:right;
                cursor: pointer;
        }


        #map_position_result {float:left; width:300px; margin:10px 0px 0px 10%; height:30px;}

        .save_ok {color:green; font-weight:bold;}
        .save_error {color:red; font-weight:bold; }
    </style>
    <fieldset>
    <legend>Dónde estoy</legend>
    <div id="user_location">
        <script src="http://maps.google.com/maps?file=api&v=2&key=<?php echo GMAPS_KEY;?>" type="text/javascript"></script>


        <div id="map_position" style="width: <?php echo $map_width;?>px; height: <?php echo $map_height;?>px"></div>
        <div id="map_help">
            <p>Esta es una información pública y opcional. Úsalo solo si quieres aparecer en el mapa de usuarios del foro. Busca el sitio donde vives y coloca el cachirulo rojo encima. Esta información se guardará cuando pulses el botón "Update Profile" al final de la página.</p>
            <p><strong>IMPORTANTE:</strong> Hasta que no guardes por primera vez no aparecerás en el mapa común. Por ahora una vez guardado el cachirulo no se puede borrar del todo :( Si quieres dejar de aparecer en el mapa colócate en Hawai o escríbenos.</p>
        </div>
        <div class="clear"></div>
        <div id="map_buttons">
            <input type="hidden" id="uid" name="uid" value="<?php if(isset($uid)) echo $uid;?>"/>
            <input type="hidden" id="lblLat" name="lat" value="<?php if(isset($latmap)) echo $latmap; else echo 0;?>"/>
            <input type="hidden" id="lblLong" name="lon" value="<?php if(isset($longmap)) echo $longmap; else echo 0;?>"/>
        </div>

        <div id="map_position_result"></div>
        <script type="text/javascript" src="<?php echo $user_position_path;?>/edit_user_position.js"></script>
        <div class="clear"></div>
    </div>
    </fieldset>
<?php


}


function show_position_map($w,$h) {
    global $user, $user_position_path;

    // **  Control de Parámetros ** //

    // Altura y anchura del mapa configurable por parámetros GET 'w' y 'h'
    $map_width=$w;
    $map_height=$h;

    $latmap = 0;
    $longmap = 0;
    $latlong = get_user_position($user->ID);
    if ($latlong && count($latlong)) {
        $latmap = $latlong['lat'];
        $longmap = $latlong['lon'];
    }

    if (isset($lat) && isset($long)) {
        $latmap = $lat;
        $longmap = $long;
    }

    // Usuario
    $uid = $user->ID;
    // Google Maps API Keys configured in rodadas.php
    ?>
    <style type="text/css">
        /* Mapped
        --------------------------------
        User location plugin with Google Maps */

        #user_location {background:#F6F6F6; padding:10px; margin:0px;}

        #map_position {margin:0px auto; clear:both;}
    </style>
    <fieldset>
    <legend>Dónde estoy</legend>
    <div id="user_location">
        <script src="http://maps.google.com/maps?file=api&v=2&key=<?php echo GMAPS_KEY;?>" type="text/javascript"></script>


        <div id="map_position" style="width: <?php echo $map_width;?>px; height: <?php echo $map_height;?>px"></div>
        <div class="clear"></div>
         <div id="map_buttons">
            <form id="user_location_form" action="http://localhost/foro/bb-plugins/rodadas/process_position.php" method="get">
                <input type="hidden" id="uid" name="uid" value="<?php if(isset($uid)) echo $uid;?>"/>
                <input type="hidden" id="lblLat" name="lat" value="<?php if(isset($latmap)) echo $latmap; else echo 0;?>"/>
                <input type="hidden" id="lblLong" name="lon" value="<?php if(isset($longmap)) echo $longmap; else echo 0;?>"/>
            </form>
        </div>
       
        <script type="text/javascript" src="<?php echo $user_position_path;?>/view_user_position.js"></script>
        <div class="clear"></div>
    </div>
    </fieldset>
<?php


}

function get_user_position($user_id) {
    global $bbdb, $bb_table_prefix;
    $sql = "SELECT lat, `long`
            FROM ".POSITION_TABLE."
            WHERE uid = ".$user_id."
            LIMIT 1";

    $position = $bbdb->get_results($sql);
    if ($position){

        $lat = $position[0]->lat;
        $lon = $position[0]->long;
        $result['lat'] = $lat;
        $result['lon'] = $lon;
    }
    return $result;
}
?>