<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('ajax.inc.php');


global $bbdb;

function getInfoHtml($uid){

    $avatar_width = 100;
    $avatar_height = 100;
    $avatar_class = "avatar";
    
    $config = new avatarupload_config();
    $avatar_img = "";
    if ($a = avatarupload_get_avatar($uid,1,1))
    {
            $avatar_img = '<img src="'.$a[0].'" width="'.$avatar_width.'" height="'.$avatar_height.'" alt="'.$a[4].'" class="'.$class.'" />';
    }

    $user_name = get_user_name($uid);
    $profile_link =  get_user_profile_link($uid);
    


    $html = $avatar_img.'<div class="nombre_usuario"><b><a href="'.$profile_link.'">'.$user_name.'</a></b></div>';
    return $html;
}

$sql = "SELECT u.ID, p.lat, p.`long`
        FROM bb_users u
                INNER JOIN rod_userposition p ON u.ID = p.uid
        WHERE
                NOT lat IS NULL AND
                NOT `long` IS NULL;";

$positions = (array)$bbdb->get_results($sql);
if ($positions){
    foreach($positions as $latlon){
        $item['info_html'] = getInfoHtml($latlon->ID);
        $item['uid'] = $latlon->ID;
        $item['lat'] = $latlon->lat;
        $item['lon'] = $latlon->long;
        $result[] = $item;
    }
}





echo json_encode($result);
?>