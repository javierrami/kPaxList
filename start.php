<?php

/**
 * This plugin search inside 
 *
 */

  elgg_register_event_handler('init', 'system', 'likes_init');


function likes_init(){

    elgg_extend_view('css/elgg', 'likes/css');
    elgg_extend_view('js/elgg', 'likes/js');

    // registered with priority < 500 so other plugins can remove likes
    elgg_register_plugin_hook_handler('register', 'menu:river', 'likes_river_menu_setup', 400);
    elgg_register_plugin_hook_handler('register', 'menu:entity', 'likes_entity_menu_setup', 400);

    $root = dirname(__FILE__);

    $root = str_replace("kPaxList", "kpax", $root);


    elgg_register_library('elgg:kpaxSrv', "$root/lib/kpaxSrv.php");
    elgg_load_library('elgg:kpaxSrv');

    $actions_base = elgg_get_plugins_path() . 'kPaxList/actions/likes';

    elgg_register_action('kPaxList/add', "$actions_base/add.php");
    elgg_register_action('kPaxList/delete', "$actions_base/delete.php");
    
}


