<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$user_position_path = bb_get_option('uri')."bb-plugins/rodadas";
function show_fullusermap($width,$height,$lat_center, $lon_center, $zoom) {
    global $user_position_path;
    $width = 600;
    $height = 400;
    ?>
    <script src="http://maps.google.com/maps?file=api&v=2&key=<?php echo GMAPS_KEY;?>" type="text/javascript"></script>
    <script type="text/javascript" src="http://gmaps-utility-library.googlecode.com/svn/trunk/markerclusterer/1.0/src/markerclusterer_packed.js"></script>
    <script type="text/javascript" src="<?php echo $user_position_path ?>/fullusermap.js"></script>
    <div id="fullusermap" style="width:<?php echo $width; ?>px;height:<?php echo $height;?>px;"></div>
    <script type="text/javascript">
        loadFullUserMap("<?php echo $user_position_path;?>",<?php echo $lat_center;?>,<?php echo $lon_center;?>,<?php echo $zoom;?>);
    </script>
    <?php
}



?>