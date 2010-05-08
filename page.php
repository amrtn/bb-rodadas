<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('../..//bb-load.php');
//bb_get_header();
?>
<?php if (page_exist()):?>
<h2><?=get_page_title()?></h2>
    <?=get_page_content()?>
<?php else:?>
<h2>Página no encontrada</h2>
<?php endif;?>
<?php
bb_get_footer();
?>