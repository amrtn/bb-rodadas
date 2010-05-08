<?php

/*
Plugin Name: User Position
Plugin URI: http://rodadas.net/avo/bbrodadas
Description: Con este plugin rodadas es más listo
Author: Alvaro Martin
Version: 1.0
Author URI: http://rodadas.net/avo/
*/


require_once('ajax.inc.php');

$proc_res = rdd_process_position();

$body = '<div id="position_save_status" ';
if ($proc_res['ok'])
    $body .= ' class="save_ok"> <p>Posición Guardada</p>';
else
    $body .= ' class="save_error"> <p>Error: '.$proc_res['error_msg'].'</p>';
$body .= '</div>';

echo $body;
 
?>





<?php


function rdd_process_position(){
    global $bbdb, $bb_table_prefix;
    
    $result = rdd_check_params();
    if (!$result['ok'])
        return $result;

    //¿Existe el usuario en la tabla de localizaciones?
    $existe_usuario = $bbdb->get_var("SELECT COUNT(uid)  FROM ".POSITION_TABLE." WHERE uid = ".$result['uid']);
    if ($existe_usuario == 0) {
        // añadir entrada de localización
        $sql = "INSERT INTO ".POSITION_TABLE." (
                uid,lat,`long`,ubicacion,usarmapa
                ) VALUES (
                    ".$result['uid'].",".
                    $result['lat'].",".
                    $result['lon'].",'',true)";  
    } else {
        // modificar entrada de localización
        $sql = "UPDATE ".POSITION_TABLE." SET ".
                "lat = ".$result['lat'].",
                `long` = ".$result['lon']."
                WHERE uid=".$result['uid'];
    }
    $bbdb->query($sql);

    return $result;
}

function rdd_check_params() {
    $result['ok'] = true;
    $result['error_msg'] = '';

    // Comprobar que tenemos todos los parámetros
    if (isset($_GET['uid']) && is_numeric($_GET['uid'])){
        $uid = (int)$_GET['uid'];
        $result['uid'] = $uid;
    } else {
        $result['ok'] = false;
        $result['error_msg'] = 'No se ha indicado el usuario';
        return $result;
    }

    if (isset($_GET['lat']) && is_numeric($_GET['lat'])) {
        $lat = (double)$_GET['lat'];
        $result['lat'] = $lat;
    } else {
        $result['ok'] = false;
        $result['error_msg'] = 'No se ha indicado la latitud';
        return $result;
    }
    if (isset($_GET['lon']) && is_numeric($_GET['lon'])){
        $lon = (double)$_GET['lon'];
        $result['lon'] = $lon;
    }else {
        $result['ok'] = false;
        $result['error_msg'] = 'No se ha indicado la longitud';
        return $result;
    }


    // Comprobar que el usuario logueado en bbpress es el mismo que queremos
    // modificar
    $user_id = bb_get_current_user_info( 'id' );

    if ($user_id != $uid ) {
        $result['ok'] = false;
        $result['error_msg'] = 'Sólo se puede modificar la información del usuario actual';
        return $result;
    }
    return $result;
}




?>
