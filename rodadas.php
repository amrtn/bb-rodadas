<?php
/*
Plugin Name: Rodadas
Plugin URI: http://rodadas.net/avo/bbrodadas
Description: Con este plugin rodadas es más listo
Author: Alvaro Martin
Version: 1.0
Author URI: http://rodadas.net/avo/
*/

/*
 *
 * bb_rodadas_get_post_readstate($pid, $uid) --> bool
 *
 * bb_rodadas_get_forum_unread_count($fid, $uid) --> int (número de posts no
 *                                                      leídos por el usuario en
 *                                                      el foro pasado como parámetro)
 *
 * bb_rodadas_get_post_list_unread_count($postlist, $uid) --> int
 *
 * bb_rodadas_set_post_read($pid, $uid)
 *
 * bb_rodadas_set_forum_read($fid, $uid)
 *
 *
 * TABLA en BD
 * ------------
 * bb_readstate
 *  * pid -> int -> id del post en bb_posts
 *  * uid -> int -> id del usuario en bb_users
 *  * date -> date -> fecha de lectura del post por el usuario
 * CREATE TABLE bb_readstate (pid INT NOT NULL, uid INT NOT NULL, date TIMESTAMP  NOT NULL DEFAULT NOW(), PRIMARY KEY (pid,uid))
 *
 * CREATE TABLE  `bbpress`.`rod_userposition` (
  `uid` int(11) NOT NULL,
  `lat` double NOT NULL default '0',
  `long` double NOT NULL default '0',
  `ubicacion` mediumtext,
  `usarmapa` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`uid`),
  KEY `rod_userposition_uid_idx` (`uid`),
  KEY `rod_userposition_lat_idx` (`lat`),
  KEY `rod_userposition_long_idx` (`long`),
  KEY `rod_userposition_usarmapa_idx` (`usarmapa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1
 */


 // google maps api key for http://192.168.9.181
// ABQIAAAAIcZoQCVZuqlQzhokQridkBSNZ6w0dVxZwyFs4zb6YzX9pzNLMhRCD3FphC0LOWbqpvJ_YzEFPHiOTg
// define(GMAPS_KEY,"ABQIAAAAIcZoQCVZuqlQzhokQridkBSNZ6w0dVxZwyFs4zb6YzX9pzNLMhRCD3FphC0LOWbqpvJ_YzEFPHiOTg");
//
// google maps api key for http://192.168.1.181
// ABQIAAAAIcZoQCVZuqlQzhokQridkBTGcMnEy0mLuqOSZTn9g3sctfWNzhRxhdZbSZOUjPnfEI8Kc8HCmYsUDQ
// define(GMAPS_KEY,"ABQIAAAAIcZoQCVZuqlQzhokQridkBTGcMnEy0mLuqOSZTn9g3sctfWNzhRxhdZbSZOUjPnfEI8Kc8HCmYsUDQ");
//
// google maps api key for http://www.rodadas.net
// ABQIAAAAIcZoQCVZuqlQzhokQridkBRKc_-lNaW2ygUbY6a6-ZDBClPfHBRnfQBw3fpcEP4OzTwMAwXBDZp7kw
define(GMAPS_KEY,"ABQIAAAAIcZoQCVZuqlQzhokQridkBRKc_-lNaW2ygUbY6a6-ZDBClPfHBRnfQBw3fpcEP4OzTwMAwXBDZp7kw");

require_once('gmap.php');
require_once('fullusermap.php');




add_action( 'bb_init', 'bb_rodadas_init');

function bb_rodadas_init() {
    add_action('post_form','bb_rodadas_previewpanel');
}

function bb_rodadas_get_post_readstate($pid, $uid) {
    global $bbdb;
    $sql = "SELECT count(*) FROM ".$bbdb->prefix."bb_readstate WHERE pid = ".$pid." AND uid = ".$uid."";
    $readcount = $bbdb->get_var($sql);
    if ($readcount == 0) {
        return false;
    } else {
        return true;
    }
}


function bb_rodadas_set_post_read($pid, $uid) {
    global $bbdb;
    $tbl = $bbdb->prefix . "bb_readstate";
    $sql = "INSERT INTO ".$tbl."(pid,uid) VALUES(".$pid.",".$uid.");";
}



function bb_rodadas_previewpanel() {

}






?>
